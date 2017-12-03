<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2017 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoSsmSubmenuSsmGeneral' ) && class_exists( 'WpssoAdmin' ) ) {

	class WpssoSsmSubmenuSsmGeneral extends WpssoAdmin {

		public function __construct( &$plugin, $id, $name, $lib, $ext ) {
			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			$this->menu_id = $id;
			$this->menu_name = $name;
			$this->menu_lib = $lib;
			$this->menu_ext = $ext;	// lowercase acronyn for plugin or extension
		}

		// called by the extended WpssoAdmin class
		protected function add_meta_boxes() {
			add_meta_box( $this->pagehook.'_general',
				_x( 'Strip Schema Microdata', 'metabox title', 'wpsso-strip-schema-microdata' ), 
					array( &$this, 'show_metabox_general' ), $this->pagehook, 'normal' );
		}

		public function show_metabox_general() {
			$metabox_id = 'general';
			$tabs = apply_filters( $this->p->cf['lca'].'_ssm_'.$metabox_id.'_tabs', array(
				'body' => _x( 'Body Section', 'metabox tab', 'wpsso-strip-schema-microdata' ),
				'head' => _x( 'Head Section', 'metabox tab', 'wpsso-strip-schema-microdata' ),
			) );
			$table_rows = array();
			foreach ( $tabs as $key => $title ) {
				$table_rows[$key] = array_merge( $this->get_table_rows( $metabox_id, $key ), 
					apply_filters( $this->p->cf['lca'].'_'.$metabox_id.'_'.$key.'_rows', array(), $this->form ) );
			}
			$this->p->util->do_metabox_tabs( $metabox_id, $tabs, $table_rows );
		}

		protected function get_table_rows( $metabox_id, $key ) {
			$table_rows = array();
			switch ( $metabox_id.'-'.$key ) {
				case 'general-head':
				case 'general-body':

					$table_rows[] = $this->form->get_th_html( _x( 'Duplicate HTML Meta Tags',
						'option label', 'wpsso-strip-schema-microdata' ), '', 'ssm_'.$key.'_meta_tags' ).
					'<td>'.$this->form->get_checkbox( 'ssm_'.$key.'_meta_tags' ).'</td>';

					$table_rows[] = $this->form->get_th_html( _x( 'Application/LD+JSON Scripts',
						'option label', 'wpsso-strip-schema-microdata' ), '', 'ssm_'.$key.'_json_scripts' ).
					'<td>'.$this->form->get_checkbox( 'ssm_'.$key.'_json_scripts' ).'</td>';

					$table_rows[] = $this->form->get_th_html( _x( 'Schema HTML Attributes',
						'option label', 'wpsso-strip-schema-microdata' ), '', 'ssm_'.$key.'_schema_attr' ).
					'<td>'.$this->form->get_checkbox( 'ssm_'.$key.'_schema_attr' ).'</td>';

					break;
			}
			return $table_rows;
		}
	}
}

