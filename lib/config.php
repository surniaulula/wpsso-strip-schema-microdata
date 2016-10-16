<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2016 Jean-Sebastien Morisset (http://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) 
	die( 'These aren\'t the droids you\'re looking for...' );

if ( ! class_exists( 'WpssoRsmConfig' ) ) {

	class WpssoRsmConfig {

		public static $cf = array(
			'plugin' => array(
				'wpssorsm' => array(
					'version' => '1.0.0-1',		// plugin version
					'opt_version' => '1',		// increment when changing default options
					'short' => 'WPSSO RSM',		// short plugin name
					'name' => 'WPSSO Remove Schema Microdata (WPSSO RSM)',
					'desc' => 'WPSSO extension to remove outdated template Schema Microdata and leave Schema JSON-LD markup untouched for Google and Bing.',
					'slug' => 'wpsso-remove-schema-microdata',
					'base' => 'wpsso-remove-schema-microdata/wpsso-remove-schema-microdata.php',
					'update_auth' => '',
					'text_domain' => 'wpsso-remove-schema-microdata',
					'domain_path' => '/languages',
					'img' => array(
						'icon_small' => 'images/icon-128x128.png',
						'icon_medium' => 'images/icon-256x256.png',
					),
					'url' => array(
						// wordpress
						'download' => 'https://wordpress.org/plugins/wpsso-remove-schema-microdata/',
						'review' => 'https://wordpress.org/support/view/plugin-reviews/wpsso-remove-schema-microdata?filter=5&rate=5#postform',
						'readme' => 'https://plugins.svn.wordpress.org/wpsso-remove-schema-microdata/trunk/readme.txt',
						'wp_support' => 'https://wordpress.org/support/plugin/wpsso-remove-schema-microdata',
						// surniaulula
						'update' => '',
						'purchase' => '',
						'changelog' => 'http://wpsso.com/extend/plugins/wpsso-remove-schema-microdata/changelog/',
						'codex' => 'http://wpsso.com/codex/plugins/wpsso-remove-schema-microdata/',
						'faq' => 'http://wpsso.com/codex/plugins/wpsso-remove-schema-microdata/faq/',
						'notes' => '',
						'feed' => 'http://wpsso.com/category/application/wordpress/wp-plugins/wpsso-remove-schema-microdata/feed/',
						'pro_support' => '',
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
			return self::$cf['plugin']['wpssorsm']['version'];
		}

		public static function set_constants( $plugin_filepath ) { 
			define( 'WPSSORSM_FILEPATH', $plugin_filepath );						
			define( 'WPSSORSM_PLUGINDIR', trailingslashit( realpath( dirname( $plugin_filepath ) ) ) );
			define( 'WPSSORSM_PLUGINSLUG', self::$cf['plugin']['wpssorsm']['slug'] );		// wpsso-remove-schema-microdata
			define( 'WPSSORSM_PLUGINBASE', self::$cf['plugin']['wpssorsm']['base'] );		// wpsso-remove-schema-microdata/wpsso-remove-schema-microdata.php
			define( 'WPSSORSM_URLPATH', trailingslashit( plugins_url( '', $plugin_filepath ) ) );
		}

		public static function require_libs( $plugin_filepath ) {

			require_once( WPSSORSM_PLUGINDIR.'lib/register.php' );
			require_once( WPSSORSM_PLUGINDIR.'lib/filters.php' );

			add_filter( 'wpssorsm_load_lib', array( 'WpssoRsmConfig', 'load_lib' ), 10, 3 );
		}

		public static function load_lib( $ret = false, $filespec = '', $classname = '' ) {
			if ( $ret === false && ! empty( $filespec ) ) {
				$filepath = WPSSORSM_PLUGINDIR.'lib/'.$filespec.'.php';
				if ( file_exists( $filepath ) ) {
					require_once( $filepath );
					if ( empty( $classname ) )
						return SucomUtil::sanitize_classname( 'wpssorsm'.$filespec, false );	// $underscore = false
					else return $classname;
				}
			}
			return $ret;
		}
	}
}

?>
