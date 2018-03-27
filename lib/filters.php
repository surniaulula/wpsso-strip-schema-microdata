<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2016-2018 Jean-Sebastien Morisset (https://wpsso.com/)
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

				if ( is_admin() ) {
					$this->p->util->add_plugin_filters( $this, array( 
						'messages_tooltip' => 2,		// tooltip messages filter
					) );
				}

				/**
				 * If we're stripping the head section of meta tags, make sure the wpsso mark meta tags
				 * are enabled and the duplicate check feature is disabled (no use checking if we're
				 * removing duplicates).
				 */
				if ( ! empty( $this->p->options['ssm_head_meta_tags'] ) ) {

					$this->p->util->add_plugin_filters( $this, array( 
						'check_post_head' => '__return_false',		// redundant since we are removing duplicates
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

			if ( empty( $buffer ) || is_feed() ) {
				return $buffer;
			}

			$log_prefix = __METHOD__.' v'.WpssoSsmConfig::get_version();

			/**
			 * Return early if there's no <body> tag.
			 */
			if ( ( $body_pos = stripos( $buffer, $this->body_str ) ) === false ) {

				/**
				 * We have an <html> tag, but no <body> tag - log an error.
				 */
				if ( stripos( $buffer, '<html' ) !== false ) {

					if ( ! SucomUtil::get_const( 'WPSSOSSM_ERROR_LOG_DISABLE' ) ) {
						error_log( $log_prefix.' = nothing to do: "'.$this->body_str.'" '.
							'string not found in WordPress \'template_redirect\' buffer for '.
								$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] );
					}
	
					if ( ! SucomUtil::get_const( 'WPSSOSSM_ERROR_COMMENT_DISABLE' ) ) {
						$buffer += '<!-- '.$log_prefix.' = nothing to do: "'.$this->body_str.'" '.
							'string not found in webpage -->';
					}
				}

				return $buffer;

			} else {

				$time_start = microtime( true );
				$mt_mark_matched = 0;
				$mt_pattern_cache = null;
				$mt_replace_cache = null;

				// split the buffer to work on the head and body separately
				$doc = array(
					'head' => substr( $buffer, 0, $body_pos ),
					'body' => substr( $buffer, $body_pos ),
				);

				if ( stripos( substr( $doc['body'], strlen( $this->body_str ) ), $this->body_str ) !== false ) {

					if ( ! SucomUtil::get_const( 'WPSSOSSM_ERROR_LOG_DISABLE' ) ) {
						error_log( $log_prefix.' = exiting early: duplicate "'.$this->body_str.'"'.
							'string found in WordPress \'template_redirect\' buffer for '.
								$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] );
					}

					if ( ! SucomUtil::get_const( 'WPSSOSSM_ERROR_COMMENT_DISABLE' ) ) {
						return $buffer.'<!-- '.$log_prefix.' = exiting early: duplicate "'.$this->body_str.'" '.
							'string found in webpage -->';
					}
				}

				// protect the wpsso meta tag code block
				if ( ! empty( $this->p->options['ssm_head_meta_tags'] ) ) {

					$mt_placeholder = '<!-- placeholder for '.$this->p->lca.' meta tags -->';
					$mt_mark_matched = preg_match( $this->p->head->get_mt_mark( 'preg' ), $doc['head'], $matches, PREG_OFFSET_CAPTURE );
	
					if ( $mt_mark_matched ) {
						$doc['mt_html'] = $matches[0][0];
						$doc['mt_pos'] = $matches[0][1];
						$doc['head'] = substr_replace( $doc['head'], $mt_placeholder, $doc['mt_pos'], strlen( $doc['mt_html'] ) );
					}
				}

				$total_count = 0;
				$loop_iter = 0;

				foreach ( array( 'head', 'body' ) as $section ) {

					// check first as this initializes new pattern / replace arrays
					if ( ! empty( $this->p->options['ssm_'.$section.'_meta_tags'] ) ) {

						if ( null === $mt_pattern_cache ) {	// build this array once

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

				if ( $mt_mark_matched ) {
					if ( ( $doc['mt_pos'] = strpos( $doc['head'], $mt_placeholder ) ) !== false ) {
						$doc['head'] = substr_replace( $doc['head'], '<!-- wpsso ssm preserved block begin -->' . "\n" .
							$doc['mt_html'] . "\n" . '<!-- wpsso ssm preserved block end -->', $doc['mt_pos'], strlen( $mt_placeholder ) );
					}
				}

				$time_stop = microtime( true );
				$time_diff = $time_stop - $time_start;

				if ( ! SucomUtil::get_const( 'WPSSOSSM_INFO_COMMENT_DISABLE' ) ) {
					return $doc['head'].$doc['body'].
						'<!-- '.$log_prefix.' = '.$total_count.' matches removed in '.
							$loop_iter.' interations and '.sprintf( '%f secs', $time_diff ).' -->';
				} else {
					return $doc['head'].$doc['body'];
				}
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
