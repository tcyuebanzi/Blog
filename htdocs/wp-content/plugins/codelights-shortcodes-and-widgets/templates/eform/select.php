<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Output element's form dropdown field
 *
 * @var $name string Form's field name
 * @var $id string Form's field ID
 * @var $value string Current value
 * @var $options array List of value => title options
 */

if ( ! isset( $options ) OR empty( $options ) ) {
	$options = array();
}

$output = '<select name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '">';
foreach ( $options as $option => $title ) {
	$output .= '<option value="' . esc_attr( $option ) . '"' . selected( $value, $option, FALSE ) . '>' . $title . '</option>';
}
$output .= '</select>';

echo $output;
