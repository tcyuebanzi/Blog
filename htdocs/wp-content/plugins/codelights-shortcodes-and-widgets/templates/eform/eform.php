<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Output a single element's editing form
 *
 * @var $name string ELement name
 * @var $params array List of config-based params
 * @var $values array List of param_name => value
 * @var $field_name_fn callable Function to generate field string name based on param name
 * @var $field_name_pattern string Sprintf pattern to generate field string name (when $field_name_fn is not set)
 * @var $field_id_fn callable Function to generate field string ID based on param name
 * @var $field_id_pattern string Sprintf pattern to generate field string ID (when $field_id_fn is not set)
 */

// Validating and sanitizing input
global $cl_eform_index;
$field_name_pattern = isset( $field_name_pattern ) ? $field_name_pattern : '%s';
$field_id_pattern = isset( $field_id_pattern ) ? $field_id_pattern : ( 'cl_eform_' . $cl_eform_index . '_%s' );
$values = ( isset( $values ) AND is_array( $values ) ) ? $values : array();

// Validating, sanitizing and grouping params
$groups = array();
foreach ( $params as $param_name => &$param ) {
	$param['type'] = isset( $param['type'] ) ? $param['type'] : 'textfield';
	if ( $param['type'] == 'image' ) {
		$param['type'] = 'images';
		$param['multiple'] = FALSE;
	}
	if ( $param['type'] == 'html' AND $param_name != 'content' ) {
		// For VC-compatibility we may have only one wysiwyg field and it should be called content
		$param['type'] = 'textarea';
	}
	$param['classes'] = isset( $param['classes'] ) ? $param['classes'] : '';
	$param['std'] = isset( $param['std'] ) ? $param['std'] : '';
	// Filling missing values with standard ones
	if ( ! isset( $values[ $param_name ] ) ) {
		$values[ $param_name ] = $param['std'];
	}
	$group = isset( $param['group'] ) ? $param['group'] : __( 'General', 'codelights-shortcodes-and-widgets' );
	if ( ! isset( $groups[ $group ] ) ) {
		$groups[ $group ] = array();
	}
	$groups[ $group ][ $param_name ] = &$param;
}

$output = '<div class="cl-eform for_' . $name . '"><div class="cl-eform-h">';
if ( count( $groups ) > 1 ) {
	$group_index = 0;
	$output .= '<div class="cl-tabs">';
	$output .= '<div class="cl-tabs-list">';
	foreach ( $groups as $group => &$group_params ) {
		$output .= '<div class="cl-tabs-item' . ( $group_index ? '' : ' active' ) . '">' . $group . '</div>';
		$group_index++;
	}
	$output .= '</div>';
	$output .= '<div class="cl-tabs-sections">';
}

$group_index = 0;
foreach ( $groups as &$group_params ) {
	if ( count( $groups ) > 1 ) {
		$output .= '<div class="cl-tabs-section" style="display: ' . ( $group_index ? 'none' : 'block' ) . '">';
		$output .= '<div class="cl-tabs-section-h">';
	}
	foreach ( $group_params as $param_name => &$param ) {

		// Field params
		$field = array(
			'name' => isset( $field_name_fn ) ? call_user_func( $field_name_fn, $param_name ) : sprintf( $field_name_pattern, $param_name ),
			'id' => isset( $field_id_fn ) ? call_user_func( $field_id_fn, $param_name ) : sprintf( $field_id_pattern, $param_name ),
			'value' => $values[ $param_name ],
		);

		// Handle dynamical field visibility
		$field_is_shown = isset( $param['show_if'] ) ? cl_execute_show_if( $param['show_if'], $values ) : TRUE;

		$output .= '<div class="cl-eform-row type_' . $param['type'] . ' for_' . $param_name . ' ' . $param['classes'] . '"' . ( $field_is_shown ? '' : ' style="display: none"' ) . '>';
		if ( isset( $param['title'] ) AND ! empty( $param['title'] ) ) {
			$output .= '<div class="cl-eform-row-title">';
			$output .= '<label for="' . esc_attr( $field['id'] ) . '">' . $param['title'] . '</label>';
			$output .= '</div>';
		}
		$output .= '<div class="cl-eform-row-field">';

		if ( in_array( $param['type'], array( 'checkboxes', 'select' ) ) AND isset( $param['options'] ) ) {
			$field['options'] = $param['options'];
		}
		if ( $param['type'] == 'images' ) {
			$field['multiple'] = isset( $param['multiple'] ) ? $param['multiple'] : TRUE;
		}
		$output .= cl_get_template( 'eform/' . $param['type'], $field );

		$output .= '</div>';
		if ( isset( $param['description'] ) AND ! empty( $param['description'] ) ) {
			$output .= '<div class="cl-eform-row-description">' . $param['description'] . '</div>';
		}
		if ( isset( $param['show_if'] ) AND ! empty( $param['show_if'] ) ) {
			$output .= '<div class="cl-eform-row-showif"' . cl_pass_data_to_js( $param['show_if'] ) . '></div>';
		}
		$output .= '</div><!-- .cl-eform-row -->';
	}
	if ( count( $groups ) > 1 ) {
		$output .= '</div></div><!-- .cl-tabs-section -->';
	}
	$group_index++;
}

if ( count( $groups ) > 1 ) {
	$output .= '</div><!-- .cl-tabs-sections -->';
	$output .= '</div><!-- .cl-tabs -->';
}
$output .= '</div></div>';

echo $output;


