<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Registering and using all the needed CodeLighs shortcodes
 */
add_action( 'init', 'cl_register_shortcodes', 20 );
function cl_register_shortcodes() {
	$config = cl_config( 'elements', array() );
	foreach ( $config as $shortcode => $params ) {
		add_shortcode( $shortcode, 'cl_handle_shortcode' );
	}
}

function cl_handle_shortcode( $atts, $content, $shortcode ) {
	$atts = cl_shortcode_atts( $atts, $shortcode );

	$atts['content'] = $content;

	return cl_get_template( 'elements/' . $shortcode, $atts );
}
