<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Output element's form image/images field
 *
 * @var $name string Form's field name
 * @var $id string Form's field ID
 * @var $value string Current value
 * @var $multiple bool Allow attach multiple images?
 */

$img_ids = empty( $value ) ? array() : array_map( 'intval', explode( ',', $value ) );
$multiple = ( ! isset( $multiple ) OR $multiple );

if ( $multiple ) {
	wp_enqueue_script( 'jquery-ui-sortable' );
}

$output = '<div class="cl-imgattach" data-multiple="' . intval( $multiple ) . '">';
$output .= '<ul class="cl-imgattach-list">';
foreach ( $img_ids as $img_id ) {
	$output .= '<li data-id="' . $img_id . '"><a href="javascript:void(0)" class="cl-imgattach-delete">&times;</a>' . wp_get_attachment_image( $img_id, 'thumbnail', TRUE ) . '</li>';
}
$output .= '</ul>';
$add_btn_title = $multiple ? __( 'Add images', 'codelights-shortcodes-and-widgets' ) : __( 'Add image', 'codelights-shortcodes-and-widgets' );
$output .= '<a href="javascript:void(0)" class="cl-imgattach-add" title="' . $add_btn_title . '">+</a>';
$output .= '<input type="hidden" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '" />';
$output .= '</div>';

echo $output;
