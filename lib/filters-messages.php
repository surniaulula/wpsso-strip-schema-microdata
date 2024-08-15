<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2016-2024 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoSsmFiltersMessages' ) ) {

	class WpssoSsmFiltersMessages {

		private $p;	// Wpsso class object.
		private $a;	// WpssoSsm class object.

		/*
		 * Instantiated by WpssoSsmFilters->__construct().
		 */
		public function __construct( &$plugin, &$addon ) {

			$this->p =& $plugin;
			$this->a =& $addon;

			$this->p->util->add_plugin_filters( $this, array(
				'messages_tooltip' => 2,
			) );
		}

		public function filter_messages_tooltip( $text, $msg_key ) {

			if ( strpos( $msg_key, 'tooltip-ssm_' ) !== 0 ) {

				return $text;
			}

			$opt_key = substr( $msg_key, strlen( 'tooltip-' ) );
			$def_val = $this->p->opt->get_defaults( $opt_key );
			$def_msg = $def_val ? __( 'This option is enabled by default.', 'wpsso-strip-schema-microdata' ) :
				__( 'This option is disabled by default.', 'wpsso-strip-schema-microdata' );

			switch ( $msg_key ) {

				case ( strpos( $msg_key, 'tooltip-ssm_head_' ) === 0 ? true : false ):

					$section = 'head';

					break;

				case ( strpos( $msg_key, 'tooltip-ssm_body_' ) === 0 ? true : false ):

					$section = 'body';

					break;
			}

			if ( isset( $section ) ) {	// Just in case.

				switch ( $msg_key ) {

					case 'tooltip-ssm_body_section_meta_tags':
					case 'tooltip-ssm_head_section_meta_tags':

						$text = sprintf( __( 'Remove known duplicate / conflicting meta tags from the webpage %1$s section.',
							'wpsso-strip-schema-microdata' ), '<code>&amp;lt;' . $section . '&amp;gt;</code>' ) . ' ';

						$text .= $def_msg;

						break;

					case 'tooltip-ssm_body_section_json_scripts':
					case 'tooltip-ssm_head_section_json_scripts':

						$text = sprintf( __( 'Remove <code>application/ld+json</code> scripts from the webpage %1$s section.',
							'wpsso-strip-schema-microdata' ), '<code>&amp;lt;' . $section . '&amp;gt;</code>' ) . ' ';

						$text .= $def_msg;

						break;

					case 'tooltip-ssm_body_section_schema_attr':
					case 'tooltip-ssm_head_section_schema_attr':

						$text = sprintf( __( 'Remove Schema microdata attributes (itemscope, itemtype, itemprop, etc.) from the webpage %1$s section.',
							'wpsso-strip-schema-microdata' ), '<code>&amp;lt;' . $section . '&amp;gt;</code>' ) . ' ';

						$text .= $def_msg;

						break;
				}
			}

			return $text;
		}
	}
}
