<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Load elements list HTML to choose from
 */
add_action( 'wp_ajax_cl_get_elist_html', 'ajax_cl_get_elist_html' );
function ajax_cl_get_elist_html() {
	cl_load_template( 'elist', array() );

	// We don't use JSON to reduce data size
	die;
}

/**
 * Load shortcode builder elements forms
 */
add_action( 'wp_ajax_cl_get_ebuilder_html', 'ajax_cl_get_ebuilder_html' );
function ajax_cl_get_ebuilder_html() {
	$template_vars = array(
		'titles' => array(),
		'body' => '',
	);

	// Loading all the forms HTML
	foreach ( cl_config( 'elements', array() ) as $name => $elm ) {
		$template_vars['titles'][ $name ] = isset( $elm['title'] ) ? $elm['title'] : $name;
		$template_vars['body'] .= cl_get_template( 'eform/eform', array(
			'name' => $name,
			'params' => $elm['params'],
			'field_id_pattern' => 'cl_ebuilder_eform_' . $name . '_%s',
		) );
	}

	cl_load_template( 'ebuilder', $template_vars );

	// TODO Allow on-demand assets loading
//	wp_print_styles();
//	wp_print_scripts();

	// We don't use JSON to reduce data size
	die;
}
