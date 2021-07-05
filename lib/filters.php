<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2016-2021 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoSsmFilters' ) ) {

	class WpssoSsmFilters {

		private $p;	// Wpsso class object.
		private $a;	// WpssoSsm class object.

		private $body_start_tag = '<body ';	// A body HTML tag followed by a space (assuming one or more attributes).
		private $msgs;				// WpssoSsmFiltersMessages class object.
		private $upg;				// WpssoSsmFiltersUpgrade class object.

		/**
		 * Instantiated by WpssoSsm->init_objects().
		 */
		public function __construct( &$plugin, &$addon ) {

			static $do_once = null;

			if ( true === $do_once ) {

				return;	// Stop here.
			}

			$do_once = true;

			$this->p =& $plugin;
			$this->a =& $addon;

			$min_int    = SucomUtil::get_min_int();
			$is_admin   = is_admin() ? true : false;
			$doing_ajax = defined( 'DOING_AJAX' ) ? DOING_AJAX : false;

			require_once WPSSOSSM_PLUGINDIR . 'lib/filters-upgrade.php';

			$this->upg = new WpssoSsmFiltersUpgrade( $plugin, $addon );

			if ( ! $doing_ajax ) {

				if ( $is_admin ) {

					require_once WPSSOSSM_PLUGINDIR . 'lib/filters-messages.php';

					$this->msgs = new WpssoSsmFiltersMessages( $plugin, $addon );
				}

				/**
				 * If we're stripping the head section of meta tags, disable the duplicate check feature (no use
				 * checking if we're removing duplicates).
				 */
				if ( ! empty( $this->p->options[ 'ssm_head_section_meta_tags' ] ) ) {

					$this->p->util->add_plugin_filters( $this, array( 
						'check_post_head' => '__return_false',
					) );
				}

				/**
				 * If we're stripping the head section of meta tags or json scripts, make sure the wpsso mark meta
				 * tags are enabled.
				 */
				if ( ! empty( $this->p->options[ 'ssm_head_section_meta_tags' ] ) ||
					! empty( $this->p->options[ 'ssm_head_section_json_scripts' ] ) ) {

					$this->p->util->add_plugin_filters( $this, array( 
						'add_meta_name_wpsso:mark' => '__return_true',
					) );
				}

				if ( $this->p->debug->enabled ) {

					$this->p->debug->log( 'adding template_redirect action for output_buffer_start' );
				}

				add_action( 'template_redirect', array( $this, 'output_buffer_start' ), $min_int );
			}
		}

		public function output_buffer_start() {

			if ( $this->p->debug->enabled ) {

				$this->p->debug->log( 'output buffering started' );
			}

			ob_start( array( $this, 'strip_schema_microdata' ) );
		}

		public function strip_schema_microdata( $buffer ) {

			if ( empty( $buffer ) || is_feed() ) {

				return $buffer;
			}

			$log_prefix = __METHOD__ . ' v' . WpssoSsmConfig::get_version();

			/**
			 * Return early if there's no "<body " start tag.
			 */
			if ( ( $body_start_pos = stripos( $buffer, $this->body_start_tag ) ) === false ) {

				/**
				 * We have an <html> tag, but no <body> tag - log an error.
				 */
				if ( false !== stripos( $buffer, '<html' ) ) {

					if ( ! SucomUtil::get_const( 'WPSSOSSM_ERROR_LOG_DISABLE' ) ) {

						error_log( $log_prefix . ' = nothing to do: "' . $this->body_start_tag . '" ' . 
							'string not found in WordPress \'template_redirect\' buffer for ' .
								$_SERVER[ 'SERVER_NAME' ] . $_SERVER[ 'REQUEST_URI' ] );
					}

					if ( ! SucomUtil::get_const( 'WPSSOSSM_ERROR_COMMENT_DISABLE' ) ) {

						$buffer .= '<!-- ' . $log_prefix . ' = nothing to do: "' . $this->body_start_tag . '" ' .
							'string not found in webpage -->';
					}
				}

				return $buffer;

			} else {

				$mtime_start      = microtime( $get_float = true );
				$mt_mark_matched  = 0;
				$mt_pattern_cache = null;
				$mt_replace_cache = null;

				/**
				 * Split the buffer to work on the head and body separately.
				 */
				$doc = array(
					'head' => substr( $buffer, 0, $body_start_pos ),
					'body' => substr( $buffer, $body_start_pos ),
				);

				if ( false !== stripos( substr( $doc[ 'body' ], strlen( $this->body_start_tag ) ), $this->body_start_tag ) ) {

					if ( ! SucomUtil::get_const( 'WPSSOSSM_ERROR_LOG_DISABLE' ) ) {

						error_log( $log_prefix . ' = exiting early: duplicate "' . $this->body_start_tag . '"' . 
							'string found in WordPress \'template_redirect\' buffer for ' . 
								$_SERVER[ 'SERVER_NAME' ] . $_SERVER[ 'REQUEST_URI' ] );
					}

					if ( ! SucomUtil::get_const( 'WPSSOSSM_ERROR_COMMENT_DISABLE' ) ) {

						return $buffer . '<!-- ' . $log_prefix . ' = exiting early: duplicate "' . $this->body_start_tag . '" ' . 
							'string found in webpage -->';
					}
				}

				/**
				 * Protect the wpsso meta tag code block.
				 */
				if ( ! empty( $this->p->options[ 'ssm_head_section_meta_tags' ] ) || ! empty( $this->p->options[ 'ssm_head_section_json_scripts' ] ) ) {

					$mt_placeholder = '<!-- placeholder for ' . WPSSO_DATA_ID . ' -->';	// Since WPSSO Core v8.35.0.

					$mt_mark_preg = $this->p->head->get_mt_data( 'begin-end-preg' );	// Since WPSSO Core v8.35.0.

					$mt_mark_matched = preg_match( $mt_mark_preg, $doc[ 'head' ], $matches, PREG_OFFSET_CAPTURE );

					if ( $mt_mark_matched ) {

						$doc[ 'mt_html' ] = $matches[ 0 ][ 0 ];
						$doc[ 'mt_pos' ]  = $matches[ 0 ][ 1 ];
						$doc[ 'head' ]    = substr_replace( $doc[ 'head' ], $mt_placeholder, $doc[ 'mt_pos' ], strlen( $doc[ 'mt_html' ] ) );
					}
				}

				$total_count = 0;
				$loop_iter   = 0;

				foreach ( array( 'head', 'body' ) as $section ) {

					/**
					 * Remove Meta Tags.
					 *
					 * Check first as this initializes new pattern / replace arrays.
					 */
					if ( ! empty( $this->p->options[ 'ssm_' . $section . '_section_meta_tags' ] ) ) {

						if ( null === $mt_pattern_cache ) {	// Build this array once.

							$mt_pattern_cache = array();
							$mt_replace_cache = array();

							foreach( array(
								'link' => array( 'rel' ),
								'meta' => array( 'name', 'property', 'itemprop' )
							) as $tag => $types ) {

								foreach( $types as $type ) {

									$names = array();

									foreach ( SucomUtil::preg_grep_keys( '/^add_' . $tag . '_' . $type . '_/',
										$this->p->options, false, '' ) as $name => $value ) {

										if ( ! empty( $value ) && $name !== 'generator' ) {

											$names[] = $name;
										}
									}

									if ( ! empty( $names ) ) {

										$mt_pattern_cache[] = '/[\s\n]*<' . $tag . '(\s|[^>]+\s)' . 
											$type . '=[\'"](' . implode( '|', $names ) . ')[\'"][^>]*>[\s\n]*/imS';

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

					/**
					 * Remove Schema Microdata and RDFa Markup.
					 */
					if ( ! empty( $this->p->options[ 'ssm_' . $section . '_section_schema_attr' ] ) ) {

						$pattern[] = '/[\s\n]*<(link|meta)(\s|[^>]+\s)itemprop=[\'"][^\'"]*[\'"][^>]*>[\s\n]*/imS';
						$replace[] = '';

						$pattern[] = '/(<[^>]*)\s(itemscope|itemtype|itemprop|itemid|typeof|vocab)(=[\'"][^\'"]*[\'"])?([^>]*>)/imS';
						$replace[] = '$1$4';
					}

					/**
					 * Remove JSON Scripts.
					 */
					if ( ! empty( $this->p->options[ 'ssm_' . $section . '_section_json_scripts' ] ) ) {

						/**
						 * U = Inverts the "greediness" of quantifiers so that they are not greedy by default.
						 * i = Letters in the pattern match both upper and lower case letters. 
						 * s = A dot metacharacter in the pattern matches all characters, including newlines.
						 * S = When a pattern is used several times, spend more time analyzing it to speed up matching.
						 *
						 * See http://php.net/manual/en/reference.pcre.pattern.modifiers.php.
						 */
						$pattern[] = '/<script\b[^>]*type=["\']application\/ld\+json["\'][^>]*>.*<\/script>/UisS';
						$replace[] = '';
					}

					if ( ! empty( $pattern ) ) {	// Just in case.

						/**
						 * Recurse to remove multiple attributes from the same HTML tag.
						 */
						do {
							$doc[ $section ] = preg_replace( $pattern, $replace, $doc[ $section ], -1, $count );

							$total_count += $count;

							$loop_iter++;

						} while ( $count > 0 && $loop_iter < 20 );	// Max 20 loops, just in case.
					}
				}

				if ( $mt_mark_matched ) {

					if ( false !== ( $doc[ 'mt_pos' ] = strpos( $doc[ 'head' ], $mt_placeholder ) ) ) {

						$doc[ 'head' ] = substr_replace( $doc[ 'head' ], '<!-- wpsso ssm preserved markup begin -->' . "\n" .
							$doc[ 'mt_html' ] . "\n" . '<!-- wpsso ssm preserved markup end -->', $doc[ 'mt_pos' ],
								strlen( $mt_placeholder ) );
					}
				}

				$mtime_total = microtime( $get_float = true ) - $mtime_start;

				if ( ! SucomUtil::get_const( 'WPSSOSSM_INFO_COMMENT_DISABLE' ) ) {

					return $doc[ 'head' ] . $doc[ 'body' ] . 
						'<!-- ' . $log_prefix . ' = ' . $total_count . ' matches removed in ' . 
							$loop_iter . ' iterations and ' . sprintf( '%f secs', $mtime_total ) . ' -->';
				}

				return $doc[ 'head' ] . $doc[ 'body' ];
			}
		}
	}
}
