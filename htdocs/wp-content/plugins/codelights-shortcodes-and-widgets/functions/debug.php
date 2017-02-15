<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

function cl_write_debug( $value, $with_backtrace = FALSE ) {
	global $cl_dir;
	static $first = TRUE;
	$data = '';
	if ( $with_backtrace ) {
		$backtrace = debug_backtrace();
		array_shift( $backtrace );
		$data .= print_r( $backtrace, TRUE ) . ":\n";
	}
	ob_start();
	var_dump( $value );
	$data .= ob_get_clean() . "\n\n";
	file_put_contents( $cl_dir . 'debug.txt', $data, $first ? NULL : FILE_APPEND );
	$first = FALSE;
}
