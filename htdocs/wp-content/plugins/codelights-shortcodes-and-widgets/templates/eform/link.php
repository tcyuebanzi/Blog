<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Output element's form link field
 *
 * @var $name string Form's field name
 * @var $id string Form's field ID
 * @var $value string Current value
 */

// Loading tinymce-related components to output link dialog (part of _WP_Editors class)
cl_maybe_load_wysiwyg();
wp_enqueue_script( 'wplink' );
wp_enqueue_style( 'editor-buttons' );

$link = cl_parse_link_value( $value );

// Shortening the link
if ( strlen( $link['url'] ) > 60 ) {
	$link['url'] = substr_replace( $link['url'], '...', 28, strlen( $link['url'] ) - 57 );
}

$output = '<div class="cl-linkdialog">';
$output .= '<a class="cl-linkdialog-btn button button-default button-large" href="javascript:void(0)">' . __( 'Insert link', 'codelights-shortcodes-and-widgets' ) . '</a>';
$output .= '<span class="cl-linkdialog-url">' . $link['url'] . '</span>';
$output .= '<textarea name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '">' . esc_textarea( $value ) . '</textarea>';
$output .= '</div>';

echo $output;
