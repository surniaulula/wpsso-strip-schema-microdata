<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2016-2017 Jean-Sebastien Morisset (https://surniaulula.com/)
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

			if ( SucomUtil::get_const( 'DOING_AJAX' ) ) {
				// nothing to do
			} else {
				if ( $this->p->debug->enabled )
					$this->p->debug->log( 'adding template_redirect action for output_buffer_start' );
				add_action( 'template_redirect', array( &$this, 'output_buffer_start' ), -900000 );
			}
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
					'/<script type="application\/ld\+json">.*<\/script>/Uim',	// ungreedy
					'/[\s\n]*<(link|meta)(\s|[^>]+\s)itemprop=[\'"][^\'"]*[\'"][^>]*>[\s\n]*/im',
					'/(<[^>]*)\sitem(scope|type|prop)(=[\'"][^\'"]*[\'"])?([^>]*>)/im',
				);

				$replace = array(
					'',
					'',
					'$1$4',
				);

				// recurse to remove multiple attributes from the same HTML tag
				$removed_count = 0;
				$loop_iter = 0;
				do {
					$doc_body = preg_replace( $pattern, $replace, $doc_body, -1, $count );
					$removed_count += $count;
					$loop_iter++;
				} while ( $count > 0 && $loop_iter < 20 );	// max 20 loops, just in case

				$time_stop = microtime( true );
				$time_diff = $time_stop - $time_start;

				// recombine and add some activity stats
				return $doc_head.$doc_body.'<!-- '.__METHOD__.' = '.$removed_count.' matches removed in '.
					$loop_iter.' interations and '.sprintf( '%f secs', $time_diff ).' -->';

			} else {
				return $buffer.'<!-- '.__METHOD__.' = nothing to do: body HTML tag not found -->';
			}
		}
	}
}

?>
