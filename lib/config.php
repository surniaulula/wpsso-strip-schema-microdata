<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2016 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) 
	die( 'These aren\'t the droids you\'re looking for...' );

if ( ! class_exists( 'WpssoSsmConfig' ) ) {

	class WpssoSsmConfig {

		public static $cf = array(
			'plugin' => array(
				'wpssossm' => array(
					'version' => '1.0.2-1',		// plugin version
					'opt_version' => '1',		// increment when changing default options
					'short' => 'WPSSO SSM',		// short plugin name
					'name' => 'WPSSO Strip Schema Microdata (WPSSO SSM)',
					'desc' => 'WPSSO extension to remove outdated Schema Microdata, leaving the superior Schema JSON-LD markup untouched for Google and Bing.',
					'slug' => 'wpsso-strip-schema-microdata',
					'base' => 'wpsso-strip-schema-microdata/wpsso-strip-schema-microdata.php',
					'update_auth' => '',
					'text_domain' => 'wpsso-strip-schema-microdata',
					'domain_path' => '/languages',
					'img' => array(
						'icon_small' => 'images/icon-128x128.png',
						'icon_medium' => 'images/icon-256x256.png',
					),
					'url' => array(
						// wordpress
						'download' => 'https://wordpress.org/plugins/wpsso-strip-schema-microdata/',
						'forum' => 'https://wordpress.org/support/plugin/wpsso-strip-schema-microdata',
						'review' => 'https://wordpress.org/support/view/plugin-reviews/wpsso-strip-schema-microdata?filter=5&rate=5#postform',
						// github
						'readme_txt' => 'https://raw.githubusercontent.com/SurniaUlula/wpsso-strip-schema-microdata/master/readme.txt',
						// wpsso
						'latest' => 'https://wpsso.com/extend/plugins/wpsso-strip-schema-microdata/latest/',
						'update' => 'https://wpsso.com/extend/plugins/wpsso-strip-schema-microdata/update/',
						'changelog' => 'https://wpsso.com/extend/plugins/wpsso-strip-schema-microdata/changelog/',
						'codex' => 'https://wpsso.com/codex/plugins/wpsso-strip-schema-microdata/',
						'faq' => '',
						'notes' => '',
					),
					'lib' => array(
						// submenu items must have unique keys
						'submenu' => array (
						),
						'gpl' => array(
						),
					),
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

			require_once( WPSSOSSM_PLUGINDIR.'lib/register.php' );
			require_once( WPSSOSSM_PLUGINDIR.'lib/filters.php' );

			add_filter( 'wpssossm_load_lib', array( 'WpssoSsmConfig', 'load_lib' ), 10, 3 );
		}

		public static function load_lib( $ret = false, $filespec = '', $classname = '' ) {
			if ( $ret === false && ! empty( $filespec ) ) {
				$filepath = WPSSOSSM_PLUGINDIR.'lib/'.$filespec.'.php';
				if ( file_exists( $filepath ) ) {
					require_once( $filepath );
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
