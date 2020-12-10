<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2020 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoSsmFiltersUpgrade' ) ) {

	class WpssoSsmFiltersUpgrade {

		private $p;	// Wpsso class object.
		private $a;	// WpssoSsm class object.

		/**
		 * Instantiated by WpssoSsmFilters->__construct().
		 */
		public function __construct( &$plugin, &$addon ) {

			$this->p =& $plugin;
			$this->a =& $addon;

			$this->p->util->add_plugin_filters( $this, array( 
				'rename_options_keys'        => 1,
			) );
		}

		public function filter_rename_options_keys( $options_keys ) {

			$options_keys[ 'wpssossm' ] = array(
				5 => array(
					'ssm_body_meta_tags'    => 'ssm_body_section_meta_tags',
					'ssm_body_json_scripts' => 'ssm_body_section_json_scripts',
					'ssm_body_schema_attr'  => 'ssm_body_section_schema_attr',
					'ssm_head_meta_tags'    => 'ssm_head_section_meta_tags',
					'ssm_head_json_scripts' => 'ssm_head_section_json_scripts',
					'ssm_head_schema_attr'  => 'ssm_head_section_schema_attr',
				),
			);

			return $options_keys;
		}
	}
}
