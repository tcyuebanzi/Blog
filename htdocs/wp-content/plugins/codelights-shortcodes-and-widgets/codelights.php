<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Plugin Name: SiteOrigin Widgets by CodeLights
 * Version: 1.1.4
 * Plugin URI: http://codelights.com/
 * Description: Flexible high-end shortcodes and widgets. Responsive, modern, SEO-optimized and easy-to-use. Also can work without SiteOrigin.
 * Author: CodeLights
 * Author URI: http://codelights.com/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: codelights-shortcodes-and-widgets
 */

// Global variables for plugin usage (global declaration is needed here for WP CLI compatibility)
global $cl_file, $cl_dir, $cl_uri, $cl_version;
$cl_file = __FILE__;
$cl_dir = plugin_dir_path( __FILE__ );
$cl_uri = plugins_url( '', __FILE__ );
$cl_version = preg_match( '~Version\: ([^\n]+)~', file_get_contents( __FILE__, NULL, NULL, 82, 150 ), $cl_matches ) ? $cl_matches[1] : FALSE;
unset( $cl_matches );

require $cl_dir . 'functions/helpers.php';
require $cl_dir . 'functions/shortcodes.php';

// Widgets
require $cl_dir . 'functions/class-cl-widget.php';

add_action( 'plugins_loaded', 'cl_plugins_loaded' );
function cl_plugins_loaded() {
	// Editors support
	global $cl_dir;
	require $cl_dir . 'editors-support/native/native.php';
	require $cl_dir . 'editors-support/siteorigin/siteorigin.php';
	// I18n support
	cl_maybe_load_plugin_textdomain();
}

// Ajax requests
if ( is_admin() AND isset( $_POST['action'] ) AND substr( $_POST['action'], 0, 3 ) == 'cl_' ) {
	require $cl_dir . 'functions/ajax.php';
}

add_action( 'wp_enqueue_scripts', 'cl_register_assets', 8 );
function cl_register_assets() {
	// Registering front-end assets from config/assets.php
	foreach ( array( 'style', 'script' ) as $type ) {
		foreach ( cl_config( 'assets.' . $type . 's', array() ) as $handle => $params ) {
			array_unshift( $params, $handle );
			call_user_func_array( 'wp_register_' . $type, $params );
		}
	}
}

// Load admin scripts and styles
add_action( 'admin_enqueue_scripts', 'cl_admin_enqueue_scripts', 5 );
function cl_admin_enqueue_scripts() {
	global $cl_uri, $post_type, $wp_scripts, $cl_version;

	wp_register_script( 'wp-color-picker-alpha', $cl_uri . '/vendor/wp-color-picker-alpha/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), $cl_version, '1.2.1' );
	wp_register_style( 'cl-editor', $cl_uri . '/admin/css/editor.css', array( 'wp-color-picker' ), $cl_version );
	wp_register_script( 'cl-editor', $cl_uri . '/admin/js/editor.js', array(
		'jquery-ui-sortable',
		'wp-color-picker-alpha',
	), $cl_version, TRUE );

	$screen = get_current_screen();
	$is_widgets = ( $screen->base == 'widgets' );
	$is_customizer = ( $screen->base == 'customize' );
	$is_content_editor = ( isset( $post_type ) AND post_type_supports( $post_type, 'editor' ) );

	// Extra JavaScript data
	$extra_js_data = 'if (window.$cl === undefined) window.$cl = {}; $cl.ajaxUrl = ' . wp_json_encode( admin_url( 'admin-ajax.php' ) ) . ";";
	if ( $is_content_editor ) {
		$extra_js_data .= '$cl.elements = ' . wp_json_encode( cl_config( 'elements', array() ) ) . ";\n";
	}
	$wp_scripts->add_data( 'cl-editor', 'data', $extra_js_data );

	if ( $is_widgets OR $is_customizer OR $is_content_editor ) {
		cl_enqueue_forms_assets();
	}

	if ( $is_customizer ) {
		wp_enqueue_style( 'cl-customizer', $cl_uri . '/admin/css/customizer.css', array(), $cl_version );
	}
}

function cl_enqueue_forms_assets() {
	wp_enqueue_style( 'cl-editor' );
	wp_enqueue_script( 'cl-editor' );

	if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}

	cl_maybe_load_wysiwyg();

	// TODO Remove when onDemand load will be ready
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker-alpha' );
	wp_enqueue_script( 'wplink' );
	wp_enqueue_style( 'editor-buttons' );

	do_action( 'cl_enqueue_forms_assets' );
}

add_action( 'customize_controls_print_styles', 'cl_customizer_icons_style' );
function cl_customizer_icons_style() {
	echo '<style type="text/css" id="cl_customizer_icons_style">';
	foreach ( cl_config( 'elements', array() ) as $name => $elm ) {
		if ( isset( $elm['icon'] ) AND ! empty( $elm['icon'] ) ) {
			echo '#available-widgets .widget-tpl[class*=" ' . $name . '"] .widget-title::before {';
			echo 'content: \'\';';
			echo '-webkit-background-size: 20px 20px;';
			echo 'background-size: 20px 20px;';
			echo 'background-image: url(' . $elm['icon'] . ');';
			echo '}';
		}
	}
	echo '}';
	echo '</style>';
}
