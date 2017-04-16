<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2016-2017 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) 
	die( 'These aren\'t the droids you\'re looking for...' );

if ( ! class_exists( 'WpssoSsmConfig' ) ) {

	class WpssoSsmConfig {

		public static $cf = array(
			'plugin' => array(
				'wpssossm' => array(
					'version' => '1.1.5',		// plugin version
					'opt_version' => '3',		// increment when changing default options
					'short' => 'WPSSO SSM',		// short plugin name
					'name' => 'WPSSO Strip Schema Microdata (WPSSO SSM)',
					'desc' => 'WPSSO extension to remove outdated / incomplete Schema Microdata, leaving the Google recommended Schema JSON-LD markup untouched.',
					'slug' => 'wpsso-strip-schema-microdata',
					'base' => 'wpsso-strip-schema-microdata/wpsso-strip-schema-microdata.php',
					'update_auth' => '',
					'text_domain' => 'wpsso-strip-schema-microdata',
					'domain_path' => '/languages',
					'req' => array(
						'short' => 'WPSSO',
						'name' => 'WordPress Social Sharing Optimization (WPSSO)',
						'min_version' => '3.40.13',
					),
					'img' => array(
						'icons' => array(
							'low' => 'images/icon-128x128.png',
							'high' => 'images/icon-256x256.png',
						),
					),
					'lib' => array(
						// submenu items must have unique keys
						'submenu' => array (
							'ssm-general' => 'Strip Microdata',	// general settings
						),
						'gpl' => array(
						),
						'pro' => array(
						),
					),
				),
			),
			'opt' => array(						// options
				'defaults' => array(
					'ssm_head_meta_tags' => 0,
					'ssm_head_json_scripts' => 0,
					'ssm_head_schema_attr' => 0,
					'ssm_body_meta_tags' => 0,
					'ssm_body_json_scripts' => 1,
					'ssm_body_schema_attr' => 1,
				),
			),
		);

		public static function get_version() { 
			return self::$cf['plugin']['wpssossm']['version'];
		}

		public static function set_constants( $plugin_filepath ) { 
			define( 'WPSSOSSM_FILEPATH', $plugin_filepath );						
			define( 'WPSSOSSM_PLUGINDIR', trailingslashit( realpath( dirname( $plugin_filepath ) ) ) );
			define( 'WPSSOSSM_PLUGINSLUG', self::$cf['plugin']['wpssossm']['slug'] );		// wpsso-strip-schema-microdata
			define( 'WPSSOSSM_PLUGINBASE', self::$cf['plugin']['wpssossm']['base'] );		// wpsso-strip-schema-microdata/wpsso-strip-schema-microdata.php
			define( 'WPSSOSSM_URLPATH', trailingslashit( plugins_url( '', $plugin_filepath ) ) );
		}

		public static function require_libs( $plugin_filepath ) {

			require_once WPSSOSSM_PLUGINDIR.'lib/register.php';
			require_once WPSSOSSM_PLUGINDIR.'lib/filters.php';

			add_filter( 'wpssossm_load_lib', array( 'WpssoSsmConfig', 'load_lib' ), 10, 3 );
		}

		public static function load_lib( $ret = false, $filespec = '', $classname = '' ) {
			if ( $ret === false && ! empty( $filespec ) ) {
				$filepath = WPSSOSSM_PLUGINDIR.'lib/'.$filespec.'.php';
				if ( file_exists( $filepath ) ) {
					require_once $filepath;
					if ( empty( $classname ) )
						return SucomUtil::sanitize_classname( 'wpssossm'.$filespec, false );	// $underscore = false
					else return $classname;
				}
			}
			return $ret;
		}
	}
}

?>
