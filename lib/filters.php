<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2016-2017 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoSsmFilters' ) ) {

	class WpssoSsmFilters {

		protected $p;
		protected $body_str = '<body ';

		public function __construct( &$plugin ) {
			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			if ( SucomUtil::get_const( 'DOING_AJAX' ) ) {
				// nothing to do
			} else {
				$this->p->util->add_plugin_filters( $this, array( 
					'messages_tooltip' => 2,		// tooltip messages filter
				) );

				// if we're stripping the head section of meta tags, make sure the 
				// wpsso mark meta tags are enabled and duplicate check is disabled
				if ( ! empty( $this->p->options['ssm_head_meta_tags'] ) ) {
					$this->p->util->add_plugin_filters( $this, array( 
						'check_post_head' => '__return_false',
						'add_meta_name_wpsso:mark' => '__return_true',
					) );
				}

				if ( $this->p->debug->enabled ) {
					$this->p->debug->log( 'adding template_redirect action for output_buffer_start' );
				}

				add_action( 'template_redirect', array( &$this, 'output_buffer_start' ), -900000 );
			}
		}

		public function output_buffer_start() {
			if ( $this->p->debug->enabled ) {
				$this->p->debug->log( 'output buffering started' );
			}
			ob_start( array( &$this, 'strip_schema_microdata' ) );
		}

		public function strip_schema_microdata( $buffer ) {

			if ( empty( $buffer ) ) {
				return $buffer;	// nothing to do (possible redirect)
			}

			// locate the body to remove schema microdata only in the body section
			$body_pos = stripos( $buffer, $this->body_str );

			if ( $body_pos !== false ) {	// just in case

				$time_start = microtime( true );
				$lca = $this->p->cf['lca'];
				$mt_found = 0;
				$mt_pattern_cache = null;
				$mt_replace_cache = null;

				// split the buffer to work on the head and body separately
				$doc = array(
					'head' => substr( $buffer, 0, $body_pos ),
					'body' => substr( $buffer, $body_pos ),
				);

				if ( stripos( substr( $doc['body'], strlen( $this->body_str ) ), $this->body_str ) !== false ) {	// just in case
					error_log( __METHOD__.' = exiting early: duplicate "'.$this->body_str.'" string found in '.
						$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].' webpage' );
					return $buffer.'<!-- '.__METHOD__.' = exiting early: duplicate "'.$this->body_str.'" string found in webpage -->';
				}

				// protect the wpsso meta tag code block
				if ( ! empty( $this->p->options['ssm_head_meta_tags'] ) ) {
					$placeholder = '<!-- placeholder for '.$lca.' meta tags -->';
					$mark_prefix = '<(!--[\s\n\r]+|meta[\s\n\r]+name="'.$lca.':mark:(begin|end)"[\s\n\r]+content=")';
					$mark_suffix = '([\s\n\r]+--|"[\s\n\r]*\/?)>';	// space and slash are optional for html optimizers
					$mt_found = preg_match( '/'.$mark_prefix.$lca.' meta tags begin'.$mark_suffix.'.*'.
						$mark_prefix.$lca.' meta tags end'.$mark_suffix.'/ums',	// enable utf8 functionality
							$doc['head'], $matches, PREG_OFFSET_CAPTURE );
	
					if ( $mt_found ) {
						$doc['mt_html'] = $matches[0][0];
						$doc['mt_pos'] = $matches[0][1];
						$doc['head'] = substr_replace( $doc['head'],
							$placeholder, $doc['mt_pos'], strlen( $doc['mt_html'] ) );
					}
				}

				$total_count = 0;
				$loop_iter = 0;

				foreach ( array( 'head', 'body' ) as $section ) {

					// check first as this initializes new pattern / replace arrays
					if ( ! empty( $this->p->options['ssm_'.$section.'_meta_tags'] ) ) {
						if ( $mt_pattern_cache === null ) {	// build this array once
							$mt_pattern_cache = array();
							$mt_replace_cache = array();
							foreach( array(
								'link' => array( 'rel' ),
								'meta' => array( 'name', 'property', 'itemprop' )
							) as $tag => $types ) {
								foreach( $types as $type ) {
									$names = array();
									foreach ( SucomUtil::preg_grep_keys( '/^add_'.$tag.'_'.$type.'_/',
										$this->p->options, false, '' ) as $name => $value ) {
										if ( ! empty( $value ) && $name !== 'generator' ) {
											$names[] = $name;
										}
									}
									if ( ! empty( $names ) ) {
										$mt_pattern_cache[] = '/[\s\n]*<'.$tag.'(\s|[^>]+\s)'.
											$type.'=[\'"]('.implode( '|', $names ).')[\'"][^>]*>[\s\n]*/imS';
										$mt_replace_cache[] = '';
									}
								}
							}
						}
						$pattern = $mt_pattern_cache;
						$replace = $mt_replace_cache;
					} else {
						$pattern = array();
						$replace = array();
					}

					if ( ! empty( $this->p->options['ssm_'.$section.'_schema_attr'] ) ) {
						$pattern[] = '/[\s\n]*<(link|meta)(\s|[^>]+\s)itemprop=[\'"][^\'"]*[\'"][^>]*>[\s\n]*/imS';
						$replace[] = '';

						$pattern[] = '/(<[^>]*)\sitem(scope|type|prop|id)(=[\'"][^\'"]*[\'"])?([^>]*>)/imS';
						$replace[] = '$1$4';
					}

					if ( ! empty( $this->p->options['ssm_'.$section.'_json_scripts'] ) ) {
						$pattern[] = '/<script type="application\/ld\+json">.*<\/script>/UimS';	// ungreedy
						$replace[] = '';
					}

					if ( ! empty( $pattern ) ) {	// just in case
						// recurse to remove multiple attributes from the same HTML tag
						do {
							$doc[$section] = preg_replace( $pattern, $replace, $doc[$section], -1, $count );
							$total_count += $count;
							$loop_iter++;
						} while ( $count > 0 && $loop_iter < 20 );	// max 20 loops, just in case
					}
				}

				if ( $mt_found ) {
					$doc['mt_pos'] = strpos( $doc['head'], $placeholder );
					if ( $doc['mt_pos'] !== false ) {
						$doc['head'] = substr_replace( $doc['head'],
							$doc['mt_html'], $doc['mt_pos'], strlen( $placeholder ) );
					}
				}

				$time_stop = microtime( true );
				$time_diff = $time_stop - $time_start;

				// recombine and add some activity stats
				return $doc['head'].$doc['body'].
					'<!-- '.__METHOD__.' v'.WpssoSsmConfig::get_version().' = '.
						$total_count.' matches removed in '.$loop_iter.' interations and '.
							sprintf( '%f secs', $time_diff ).' -->';

			} else {
				error_log( __METHOD__.' = nothing to do: "'.$this->body_str.'" string not found in '.
					$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].' webpage' );
				return $buffer.'<!-- '.__METHOD__.' = nothing to do: "'.$this->body_str.'" string not found in webpage -->';
			}
		}

		public function filter_messages_tooltip( $text, $idx ) {
			if ( strpos( $idx, 'tooltip-ssm_' ) !== 0 ) {
				return $text;
			}

			switch ( $idx ) {
				case ( strpos( $idx, 'tooltip-ssm_head_' ) === 0 ? true : false ):
					$section = 'head';
					break;
				case ( strpos( $idx, 'tooltip-ssm_body_' ) === 0 ? true : false ):
					$section = 'body';
					break;
			}

			switch ( $idx ) {
				case 'tooltip-ssm_head_meta_tags':
				case 'tooltip-ssm_body_meta_tags':
					if ( isset( $section ) ) {	// just in case
						$text = sprintf( __( 'Remove known duplicate / conflicting meta tags from the webpage %1$s section.',
							'wpsso-strip-schema-microdata' ), '<code>&amp;lt;'.$section.'&amp;gt;</code>' );
					}
					break;
				case 'tooltip-ssm_head_json_scripts':
				case 'tooltip-ssm_body_json_scripts':
					if ( isset( $section ) ) {	// just in case
						$text = sprintf( __( 'Remove <code>application/ld+json</code> scripts from the webpage %1$s section.',
							'wpsso-strip-schema-microdata' ), '<code>&amp;lt;'.$section.'&amp;gt;</code>' );
					}
					break;
				case 'tooltip-ssm_head_schema_attr':
				case 'tooltip-ssm_body_schema_attr':
					if ( isset( $section ) ) {	// just in case
						$text = sprintf( __( 'Remove Schema HTML attributes (itemscope, itemtype, itemprop, etc.) from the webpage %1$s section.',
							'wpsso-strip-schema-microdata' ), '<code>&amp;lt;'.$section.'&amp;gt;</code>' );
					}
					break;
			}

			return $text;
		}
	}
}

?>
