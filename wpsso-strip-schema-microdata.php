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
 * Requires PHP: 7.2
 * Requires At Least: 5.4
 * Tested Up To: 6.1.1
 * Version: 2.15.1-rc.1
 *
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes and/or incompatible API changes (ie. breaking changes).
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 *
 * Copyright 2016-2023 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoAbstractAddOn' ) ) {

	require_once dirname( __FILE__ ) . '/lib/abstract/add-on.php';
}

if ( ! class_exists( 'WpssoSsm' ) ) {

	class WpssoSsm extends WpssoAbstractAddOn {

		public $filters;	// WpssoSsmFilters class object.

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

		public function init_objects() {

			$this->p =& Wpsso::get_instance();

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			if ( $this->get_missing_requirements() ) {	// Returns false or an array of missing requirements.

				return;	// Stop here.
			}

			$this->filters = new WpssoSsmFilters( $this->p, $this );
		}
	}

        global $wpssossm;

	$wpssossm =& WpssoSsm::get_instance();
}
