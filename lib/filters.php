<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2016 Jean-Sebastien Morisset (http://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) 
	die( 'These aren\'t the droids you\'re looking for...' );

if ( ! class_exists( 'WpssoSsmFilters' ) ) {

	class WpssoSsmFilters {

		protected $p;

		public function __construct( &$plugin ) {
			$this->p =& $plugin;
			if ( $this->p->debug->enabled )
				$this->p->debug->mark();

			if ( $this->p->debug->enabled )
				$this->p->debug->log( 'adding template_redirect action for output_buffer_start' );
			add_action( 'template_redirect', array( &$this, 'output_buffer_start' ), -900000 );
		}

		public function output_buffer_start() {
			if ( $this->p->debug->enabled )
				$this->p->debug->log( 'output buffering started' );
			ob_start( array( 'WpssoSsmFilters', 'remove_schema_microdata' ) );
		}

		public static function remove_schema_microdata( $buffer ) {
			$time_start = microtime( true );

			// locate the body to remove schema microdata only in the body section
			$body_pos = stripos( $buffer, '<body ' );

			if ( $body_pos !== false ) {	// just in case

				// split the buffer to work on the body only
				$doc_head = substr( $buffer, 0, $body_pos - 1 );
				$doc_body = substr( $buffer, $body_pos );

				$pattern = array(
					'/[\s\n]*<(link|meta)(\s|[^>]+\s)itemprop=[\'"][^\'"]*[\'"][^>]*>[\s\n]*/im',
					'/(<[^>]*)\sitem(scope|type|prop)(=[\'"][^\'"]*[\'"])?([^>]*>)/im',
				);

				$replace = array(
					'',
					'$1$4',
				);

				// recurse to remove multiple attributes from the same HTML tag
				$total_count = 0;
				do {
					$doc_body = preg_replace( $pattern, $replace, $doc_body, -1, $count );
					$total_count += $count;
				} while ( $count > 0 );

				$time_stop = microtime( true );
				$time_diff = $time_stop - $time_start;

				// recombine and add timing stats
				return $doc_head.$doc_body.'<!-- '.__METHOD__.' = '.$total_count.
					' matches removed in '.sprintf( '%f secs', $time_diff ).' -->';

			} else return $buffer.'<!-- '.__METHOD__.' = '.$total_count.' body HTML tag not found -->';
		}
	}
}

?>
