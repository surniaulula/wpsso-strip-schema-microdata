<?php
/*
 * Plugin Name: WPSSO Strip Schema Microdata
 * Plugin Slug: wpsso-strip-schema-microdata
 * Text Domain: wpsso-strip-schema-microdata
 * Domain Path: /languages
 * Plugin URI: https://wpsso.com/extend/plugins/wpsso-strip-schema-microdata/
 * Assets URI: https://surniaulula.github.io/wpsso-strip-schema-microdata/assets/
 * Author: JS Morisset
 * Author URI: https://wpsso.com/
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Description: Remove Schema Microdata and RDFa from the webpage for better Google Rich Results using Schema JSON-LD markup.
 * Requires Plugins: wpsso
 * Requires PHP: 7.4.33
 * Requires At Least: 5.9
 * Tested Up To: 6.7.0
 * Version: 3.3.0
 *
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes and/or incompatible API changes (ie. breaking changes).
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 *
 * Copyright 2016-2024 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoAbstractAddOn' ) ) {

	require_once dirname( __FILE__ ) . '/lib/abstract/add-on.php';
}

if ( ! class_exists( 'WpssoSsm' ) ) {

	class WpssoSsm extends WpssoAbstractAddOn {

		protected $p;	// Wpsso class object.

		private static $instance = null;	// WpssoSsm class object.

		public function __construct() {

			parent::__construct( __FILE__, __CLASS__ );
		}

		public static function &get_instance() {

			if ( null === self::$instance ) {

				self::$instance = new self;
			}

			return self::$instance;
		}

		public function init_textdomain() {

			load_plugin_textdomain( 'wpsso-strip-schema-microdata', false, 'wpsso-strip-schema-microdata/languages/' );
		}

		/*
		 * Called by Wpsso->set_objects() which runs at init priority 10.
		 */
		public function init_objects_preloader() {

			$this->p =& Wpsso::get_instance();

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			if ( $this->get_missing_requirements() ) {	// Returns false or an array of missing requirements.

				return;	// Stop here.
			}

			new WpssoSsmFilters( $this->p, $this );
		}
	}

	WpssoSsm::get_instance();
}
