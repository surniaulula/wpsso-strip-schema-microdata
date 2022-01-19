<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2016-2022 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoSsmConfig' ) ) {

	class WpssoSsmConfig {

		public static $cf = array(
			'plugin' => array(
				'wpssossm' => array(			// Plugin acronym.
					'version'     => '2.13.0-rc.1',	// Plugin version.
					'opt_version' => '6',		// Increment when changing default option values.
					'short'       => 'WPSSO SSM',	// Short plugin name.
					'name'        => 'WPSSO Strip Schema Microdata',
					'desc'        => 'Remove Schema Microdata and RDFa from the webpage for better Google Rich Results using Schema JSON-LD markup.',
					'slug'        => 'wpsso-strip-schema-microdata',
					'base'        => 'wpsso-strip-schema-microdata/wpsso-strip-schema-microdata.php',
					'update_auth' => '',		// No premium version.
					'text_domain' => 'wpsso-strip-schema-microdata',
					'domain_path' => '/languages',

					/**
					 * Required plugin and its version.
					 */
					'req' => array(
						'wpsso' => array(
							'name'          => 'WPSSO Core',
							'home'          => 'https://wordpress.org/plugins/wpsso/',
							'plugin_class'  => 'Wpsso',
							'version_const' => 'WPSSO_VERSION',
							'min_version'   => '9.14.0-rc.1',
						),
					),

					/**
					 * URLs or relative paths to plugin banners and icons.
					 */
					'assets' => array(

						/**
						 * Icon image array keys are '1x' and '2x'.
						 */
						'icons' => array(
							'1x' => 'images/icon-128x128.png',
							'2x' => 'images/icon-256x256.png',
						),
					),

					/**
					 * Library files loaded and instantiated by WPSSO.
					 */
					'lib' => array(
						'submenu' => array(
							'ssm-general' => 'Strip Microdata',
						),
					),
				),
			),

			/**
			 * Additional add-on setting options.
			 */
			'opt' => array(
				'defaults' => array(

					/**
					 * Body section.
					 */
					'ssm_body_section_meta_tags'    => 0,
					'ssm_body_section_json_scripts' => 1,
					'ssm_body_section_schema_attr'  => 1,

					/**
					 * Head section.
					 */
					'ssm_head_section_meta_tags'    => 0,
					'ssm_head_section_json_scripts' => 0,
					'ssm_head_section_schema_attr'  => 0,
				),
			),
		);

		public static function get_version( $add_slug = false ) {

			$info =& self::$cf[ 'plugin' ][ 'wpssossm' ];

			return $add_slug ? $info[ 'slug' ] . '-' . $info[ 'version' ] : $info[ 'version' ];
		}

		public static function set_constants( $plugin_file ) {

			if ( defined( 'WPSSOSSM_VERSION' ) ) {	// Define constants only once.

				return;
			}

			$info =& self::$cf[ 'plugin' ][ 'wpssossm' ];

			/**
			 * Define fixed constants.
			 */
			define( 'WPSSOSSM_FILEPATH', $plugin_file );
			define( 'WPSSOSSM_PLUGINBASE', $info[ 'base' ] );	// Example: wpsso-strip-schema-microdata/wpsso-strip-schema-microdata.php.
			define( 'WPSSOSSM_PLUGINDIR', trailingslashit( realpath( dirname( $plugin_file ) ) ) );
			define( 'WPSSOSSM_PLUGINSLUG', $info[ 'slug' ] );	// Example: wpsso-strip-schema-microdata.
			define( 'WPSSOSSM_URLPATH', trailingslashit( plugins_url( '', $plugin_file ) ) );
			define( 'WPSSOSSM_VERSION', $info[ 'version' ] );
		}

		public static function require_libs( $plugin_file ) {

			require_once WPSSOSSM_PLUGINDIR . 'lib/filters.php';
			require_once WPSSOSSM_PLUGINDIR . 'lib/register.php';

			add_filter( 'wpssossm_load_lib', array( __CLASS__, 'load_lib' ), 10, 3 );
		}

		public static function load_lib( $success = false, $filespec = '', $classname = '' ) {

			if ( false !== $success ) {

				return $success;
			}

			if ( ! empty( $classname ) ) {

				if ( class_exists( $classname ) ) {

					return $classname;
				}
			}

			if ( ! empty( $filespec ) ) {

				$file_path = WPSSOSSM_PLUGINDIR . 'lib/' . $filespec . '.php';

				if ( file_exists( $file_path ) ) {

					require_once $file_path;

					if ( empty( $classname ) ) {

						return SucomUtil::sanitize_classname( 'wpssossm' . $filespec, $allow_underscore = false );
					}

					return $classname;
				}
			}

			return $success;
		}
	}
}
