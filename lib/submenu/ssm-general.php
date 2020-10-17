<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2020 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoSsmSubmenuSsmGeneral' ) && class_exists( 'WpssoAdmin' ) ) {

	class WpssoSsmSubmenuSsmGeneral extends WpssoAdmin {

		public function __construct( &$plugin, $id, $name, $lib, $ext ) {

			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			$this->menu_id   = $id;
			$this->menu_name = $name;
			$this->menu_lib  = $lib;
			$this->menu_ext  = $ext;
		}

		/**
		 * Called by WpssoAdmin->load_setting_page() after the 'wpsso-action' query is handled.
		 *
		 * Add settings page filter and action hooks.
		 */
		protected function add_plugin_hooks() {

			$this->p->util->add_plugin_filters( $this, array(
				'form_button_rows' => 1,	// Filter form buttons for this settings page only.
			) );
		}

		/**
		 * Remove the "Change to View" button from the settings page.
		 */
		public function filter_form_button_rows( $form_button_rows ) {

			if ( isset( $form_button_rows[ 0 ] ) ) {
				$form_button_rows[ 0 ] = SucomUtil::preg_grep_keys( '/^change_show_options/', $form_button_rows[ 0 ], $invert = true );
			}

			return $form_button_rows;
		}

		/**
		 * Called by the extended WpssoAdmin class.
		 */
		protected function add_meta_boxes() {

			$metabox_id      = 'general';
			$metabox_title   = _x( 'Strip Schema Microdata Settings', 'metabox title', 'wpsso-strip-schema-microdata' );
			$metabox_screen  = $this->pagehook;
			$metabox_context = 'normal';
			$metabox_prio    = 'default';
			$callback_args   = array(	// Second argument passed to the callback function / method.
			);

			add_meta_box( $this->pagehook . '_' . $metabox_id, $metabox_title,
				array( $this, 'show_metabox_general' ), $metabox_screen,
					$metabox_context, $metabox_prio, $callback_args );
		}

		public function show_metabox_general() {

			$metabox_id = 'ssm-general';

			$filter_name = SucomUtil::sanitize_hookname( $this->p->lca . '_' . $metabox_id . '_tabs' );

			$tabs = apply_filters( $filter_name, array(
				'body_section' => _x( 'Body Section', 'metabox tab', 'wpsso-strip-schema-microdata' ),
				'head_section' => _x( 'Head Section', 'metabox tab', 'wpsso-strip-schema-microdata' ),
			) );

			$table_rows = array();

			foreach ( $tabs as $tab_key => $title ) {

				$filter_name = SucomUtil::sanitize_hookname( $this->p->lca . '_' . $metabox_id . '_' . $tab_key . '_rows' );

				$table_rows[ $tab_key ] = array_merge(
					$this->get_table_rows( $metabox_id, $tab_key ), 
					(array) apply_filters( $filter_name, array(), $this->form )
				);
			}

			$this->p->util->metabox->do_tabbed( $metabox_id, $tabs, $table_rows );
		}

		protected function get_table_rows( $metabox_id, $tab_key ) {

			$table_rows = array();

			switch ( $metabox_id . '-' . $tab_key ) {

				case 'ssm-general-head_section':	// List first to fall through (ie. no break).

					$table_rows[] = '' .
					$this->form->get_th_html( _x( 'Strip Duplicate HTML Meta Tags', 'option label', 'wpsso-strip-schema-microdata' ),
						$css_class = '', $css_id = 'ssm_' . $tab_key . '_meta_tags' ) . 
					'<td>' . $this->form->get_checkbox( 'ssm_' . $tab_key . '_meta_tags' ) . '</td>';

					// No break.

				case 'ssm-general-body_section':

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
