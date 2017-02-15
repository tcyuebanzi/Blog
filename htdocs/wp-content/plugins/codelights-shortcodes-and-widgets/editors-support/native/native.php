<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * Native WordPress editor Shortcode Builder
 */

add_filter( 'mce_buttons', 'cl_mce_buttons' );
function cl_mce_buttons( $buttons ) {
	$index = array_search( 'wp_more', $buttons );
	if ( $index !== FALSE ) {
		array_splice( $buttons, $index + 1, 0, 'codelights' );
	} else {
		$buttons[] = 'codelights';
	}

	return $buttons;
}

add_filter( 'mce_external_plugins', 'cl_mce_external_plugins' );
function cl_mce_external_plugins( $mce_external_plugins ) {
	global $cl_uri;
	$mce_external_plugins['codelights'] = $cl_uri . '/editors-support/native/tinymce.js';

	return $mce_external_plugins;
}

add_action( 'admin_print_footer_scripts', 'cl_quicktags_button' );
function cl_quicktags_button() {
	if ( wp_script_is( 'quicktags' ) ) {
		echo '<script id="cl_quicktags">' . file_get_contents( dirname( __FILE__ ) . '/quicktags.js' ) . '</script>';
	}
}
