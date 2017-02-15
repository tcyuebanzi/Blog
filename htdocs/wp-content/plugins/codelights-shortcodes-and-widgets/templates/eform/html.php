<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Output element's form html field
 *
 * @var $name string Form's field name
 * @var $id string Form's field ID
 * @var $value string Current value
 */

// We'll need 'codelights' JS configuration to init tinymce from JS
cl_maybe_load_wysiwyg();

$tinymce_settings = array(
	'textarea_name' => $name,
	'default_editor' => 'tinymce',
	'media_buttons' => TRUE,
	'wpautop' => FALSE,
	'editor_height' => 250,
	'tinymce' => array(
		'wp_skip_init' => TRUE,
	),
);

$tinymce_settings = apply_filters( 'cl_tinymce_settings', $tinymce_settings );

echo '<div class="cl-wysiwyg"' . cl_pass_data_to_js( $tinymce_settings ) . '>';

wp_editor( $value, $id, $tinymce_settings );

echo '</div>';
