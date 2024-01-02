<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2016-2024 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoSsmSubmenuStripMicrodata' ) && class_exists( 'WpssoAdmin' ) ) {

	class WpssoSsmSubmenuStripMicrodata extends WpssoAdmin {

		public function __construct( &$plugin, $id, $name, $lib, $ext ) {

			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			$this->menu_id   = $id;
			$this->menu_name = $name;
			$this->menu_lib  = $lib;
			$this->menu_ext  = $ext;

			$this->menu_metaboxes = array(
				'settings' => _x( 'Strip Schema Microdata', 'metabox title', 'wpsso-strip-schema-microdata' ),
			);
		}

		/*
		 * Remove the "Change to View" button from this settings page.
		 */
		protected function add_form_buttons_change_show_options( &$form_button_rows ) {
		}

		public function show_metabox_settings( $obj, $mb ) {

			$tabs = array(
				'body_section' => _x( 'Body Section', 'metabox tab', 'wpsso-strip-schema-microdata' ),
				'head_section' => _x( 'Head Section', 'metabox tab', 'wpsso-strip-schema-microdata' ),
			);

			$this->show_metabox_tabbed( $obj, $mb, $tabs );
		}

		protected function get_table_rows( $page_id, $metabox_id, $tab_key = '', $args = array() ) {

			$table_rows = array();
			$match_rows = trim( $page_id . '-' . $metabox_id . '-' . $tab_key, '-' );

			switch ( $match_rows ) {

				case 'strip-microdata-settings-head_section':

					$table_rows[] = '' .
					$this->form->get_th_html( _x( 'Strip Duplicate HTML Meta Tags', 'option label', 'wpsso-strip-schema-microdata' ),
						$css_class = '', $css_id = 'ssm_' . $tab_key . '_meta_tags' ) .
					'<td>' . $this->form->get_checkbox( 'ssm_' . $tab_key . '_meta_tags' ) . '</td>';

					// No break.

				case 'strip-microdata-settings-body_section':

					$table_rows[] = '' .
					$this->form->get_th_html( _x( 'Strip "application/ld+json" Scripts', 'option label', 'wpsso-strip-schema-microdata' ),
						$css_class = '', $css_id = 'ssm_' . $tab_key . '_json_scripts' ) .
					'<td>' . $this->form->get_checkbox( 'ssm_' . $tab_key . '_json_scripts' ) . '</td>';

					$table_rows[] = '' .
					$this->form->get_th_html( _x( 'Strip Schema Microdata Attributes', 'option label', 'wpsso-strip-schema-microdata' ),
						$css_class = '', $css_id = 'ssm_' . $tab_key . '_schema_attr' ) .
					'<td>' . $this->form->get_checkbox( 'ssm_' . $tab_key . '_schema_attr' ) . '</td>';

					break;
			}

			return $table_rows;
		}
	}
}
