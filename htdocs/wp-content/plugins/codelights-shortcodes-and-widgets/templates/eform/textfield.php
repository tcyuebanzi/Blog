<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Output element's form textfield field
 *
 * @var $name string Form's field name
 * @var $id string Form's field ID
 * @var $value string Current value
 */

$output = '<input type="text" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '"';
$output .= ' value="' . esc_attr( $value ) . '" />';

echo $output;
