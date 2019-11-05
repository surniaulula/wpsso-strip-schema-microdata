<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2016-2019 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoSsmConfig' ) ) {

	class WpssoSsmConfig {

		public static $cf = array(
			'plugin' => array(
				'wpssossm' => array(			// Plugin acronym.
					'version'     => '2.0.2',	// Plugin version.
					'opt_version' => '3',		// Increment when changing default option values.
					'short'       => 'WPSSO SSM',	// Short plugin name.
					'name'        => 'WPSSO Strip Schema Microdata',
					'desc'        => 'Removes outdated Schema microdata from theme templates and leaves Schema JSON-LD untouched for better Google Rich Results.',
					'slug'        => 'wpsso-strip-schema-microdata',
					'base'        => 'wpsso-strip-schema-microdata/wpsso-strip-schema-microdata.php',
					'update_auth' => '',
					'text_domain' => 'wpsso-strip-schema-microdata',
					'domain_path' => '/languages',
					'req'         => array(
						'short'       => 'WPSSO Core',
						'name'        => 'WPSSO Core',
						'min_version' => '6.11.0',
					),
					'assets' => array(
						'icons' => array(
							'low'  => 'images/icon-128x128.png',
							'high' => 'images/icon-256x256.png',
						),
					),
					'lib' => array(
						'pro' => array(
						),
						'std' => array(
						),
						'submenu' => array(
							'ssm-general' => 'Strip Microdata',
						),
					),
				),
			),
			'opt' => array(						// options
				'defaults' => array(
					'ssm_head_meta_tags'    => 0,
					'ssm_head_json_scripts' => 0,
					'ssm_head_schema_attr'  => 0,
					'ssm_body_meta_tags'    => 0,
					'ssm_body_json_scripts' => 1,
					'ssm_body_schema_attr'  => 1,
				),
			),
		);

		public static function get_version( $add_slug = false ) {

			$info =& self::$cf[ 'plugin' ][ 'wpssossm' ];

			return $add_slug ? $info[ 'slug' ] . '-' . $info[ 'version' ] : $info[ 'version' ];
		}

		public static function set_constants( $plugin_filepath ) { 

			if ( defined( 'WPSSOSSM_VERSION' ) ) {	// Define constants only once.
				return;
			}

			$info =& self::$cf[ 'plugin' ][ 'wpssossm' ];

			/**
			 * Define fixed constants.
			 */
			define( 'WPSSOSSM_FILEPATH', $plugin_filepath );						
			define( 'WPSSOSSM_PLUGINBASE', $info[ 'base' ] );	// Example: wpsso-strip-schema-microdata/wpsso-strip-schema-microdata.php.
			define( 'WPSSOSSM_PLUGINDIR', trailingslashit( realpath( dirname( $plugin_filepath ) ) ) );
			define( 'WPSSOSSM_PLUGINSLUG', $info[ 'slug' ] );	// Example: wpsso-strip-schema-microdata.
			define( 'WPSSOSSM_URLPATH', trailingslashit( plugins_url( '', $plugin_filepath ) ) );
			define( 'WPSSOSSM_VERSION', $info[ 'version' ] );						
		}

		public static function require_libs( $plugin_filepath ) {

			require_once WPSSOSSM_PLUGINDIR . 'lib/filters.php';
			require_once WPSSOSSM_PLUGINDIR . 'lib/register.php';

			add_filter( 'wpssossm_load_lib', array( 'WpssoSsmConfig', 'load_lib' ), 10, 3 );
		}

		public static function load_lib( $ret = false, $filespec = '', $classname = '' ) {

			if ( false === $ret && ! empty( $filespec ) ) {

				$filepath = WPSSOSSM_PLUGINDIR . 'lib/' . $filespec . '.php';

				if ( file_exists( $filepath ) ) {

					require_once $filepath;

					if ( empty( $classname ) ) {
						return SucomUtil::sanitize_classname( 'wpssossm' . $filespec, $allow_underscore = false );
					} else {
						return $classname;
					}
				}
			}

			return $ret;
		}
	}
}
