<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2020 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoSsmFiltersMessages' ) ) {

	class WpssoSsmFiltersMessages {

		private $p;	// Wpsso class object.

		/**
		 * Instantiated by WpssoSsmFilters->__construct().
		 */
		public function __construct( &$plugin ) {

			static $do_once = null;

			if ( true === $do_once ) {

				return;	// Stop here.
			}

			$do_once = true;

			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			if ( is_admin() ) {

				$this->p->util->add_plugin_filters( $this, array( 
					'messages_tooltip' => 2,
				) );
			}
		}

		public function filter_messages_tooltip( $text, $msg_key ) {

			if ( strpos( $msg_key, 'tooltip-ssm_' ) !== 0 ) {

				return $text;
			}

			switch ( $msg_key ) {

				case ( strpos( $msg_key, 'tooltip-ssm_head_' ) === 0 ? true : false ):

					$section = 'head';

					break;

				case ( strpos( $msg_key, 'tooltip-ssm_body_' ) === 0 ? true : false ):

					$section = 'body';

					break;
			}

			switch ( $msg_key ) {

				case 'tooltip-ssm_body_section_meta_tags':
				case 'tooltip-ssm_head_section_meta_tags':

					if ( isset( $section ) ) {	// Just in case.

						$text = sprintf( __( 'Remove known duplicate / conflicting meta tags from the webpage %1$s section.',
							'wpsso-strip-schema-microdata' ), '<code>&amp;lt;' . $section . '&amp;gt;</code>' );
					}

					break;

				case 'tooltip-ssm_body_section_json_scripts':
				case 'tooltip-ssm_head_section_json_scripts':

					if ( isset( $section ) ) {	// Just in case.

						$text = sprintf( __( 'Remove <code>application/ld+json</code> scripts from the webpage %1$s section.',
							'wpsso-strip-schema-microdata' ), '<code>&amp;lt;' . $section . '&amp;gt;</code>' );
					}

					break;

				case 'tooltip-ssm_body_section_schema_attr':
				case 'tooltip-ssm_head_section_schema_attr':

					if ( isset( $section ) ) {	// Just in case.

						$text = sprintf( __( 'Remove Schema HTML attributes (itemscope, itemtype, itemprop, etc.) from the webpage %1$s section.',
							'wpsso-strip-schema-microdata' ), '<code>&amp;lt;' . $section . '&amp;gt;</code>' );
					}

					break;
			}

			return $text;
		}
	}
}
