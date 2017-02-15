<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Output a single Ineractive Banner element.
 *
 * @var $image int ID of the WP attachment image
 * @var $size string WordPress image thumbnail name
 * @var $title string
 * @var $desc string
 * @var $link string URL of the overall element or button in a encoded link format
 * @var $animation string Animation type: 'melete' / 'soter' / 'phorcys' / 'aidos' / ...
 * @var $bgcolor string Background color
 * @var $textcolor string Text color
 * @var $ratio string Aspect ratio: '2x1' / '3x2' / '4x3' / '1x1' / '3x4' / '2x3' / '1x2'
 * @var $width string In pixels or percents: '100' / '100%'
 * @var $align string Text align: 'left' / 'center' / 'right'
 * @var $padding string In pixels or percents: '20px' / '10%'
 * @var $easing string Easing CSS class name
 * @var $el_class string Extra class name
 * @var $title_size string Title size in pixels
 * @var $desc_size string Description size in pixels
 * @var $title_mobile_size string Title size when window size is less than 600px
 * @var $desc_mobile_size string Description size when window size is less than 600px
 * @var $title_tag string Title tag name: 'h2' / 'h3' / 'h4' / 'h5' / 'div'
 */

// Enqueuing the needed assets
wp_enqueue_style( 'cl-ib' );
wp_enqueue_script( 'cl-ib' );

// Main element classes
$classes = ' animation_' . $animation . ' ratio_' . $ratio . ' align_' . $align;

// Altering whole element's div with anchor when it has a link
$tag = empty( $link ) ? 'div' : 'a';
$atts = empty( $link ) ? '' : cl_parse_link_value( $link, TRUE );

// Mobile css rules
$mobile_css_rules = array();

$title_html = '';
if ( ! empty( $title ) ) {
	if ( empty( $title_tag ) ) {
		$title_tag = 'div';
	}
	$title_html .= '<' . $title_tag . ' class="cl-ib-title"';
	$title_html .= cl_prepare_inline_css( array(
		'font-size' => $title_size,
	) );
	$title_html .= '>' . $title . '</' . $title_tag . '>';
	$classes .= ' with_title';
	if ( ! empty( $title_size ) AND ! empty( $title_mobile_size ) AND (int) $title_size != (int) $title_mobile_size ) {
		$mobile_css_rules['.cl-ib-title'] = 'font-size:' . intval( $title_mobile_size ) . 'px !important;';
	}
}

$desc_html = '';
if ( ! empty( $desc ) ) {
	$desc_html .= '<div class="cl-ib-desc"';
	$desc_html .= cl_prepare_inline_css( array(
		'font-size' => $desc_size,
	) );
	$desc_html .= '>' . $desc . '</div>';
	$classes .= ' with_desc';
	if ( ! empty( $desc_size ) AND ! empty( $desc_mobile_size ) AND (int) $desc_size != (int) $desc_mobile_size ) {
		$mobile_css_rules['.cl-ib-desc'] = 'font-size:' . intval( $desc_mobile_size ) . 'px !important;';
	}
}

// TODO Append properly styles from all the elemets to a single header-inserted css
$custom_css = '';
if ( ! empty( $mobile_css_rules ) ) {
	// Unique styled element number
	global $cl_custom_css_id;
	$cl_custom_css_id = isset( $cl_custom_css_id ) ? ( $cl_custom_css_id + 1 ) : 1;
	$classes .= ' cl_custom_css_' . $cl_custom_css_id;
	$custom_css .= '<style type="text/css">';
	$custom_css .= '@media only screen and (max-width: 599px) {';
	foreach ( $mobile_css_rules as $mobile_css_elm => $mobile_css_rule ) {
		$custom_css .= '.cl_custom_css_' . $cl_custom_css_id . ' ' . $mobile_css_elm . ' { ' . $mobile_css_rule . ' }';
	}
	$custom_css .= '}';
	$custom_css .= '</style>';
}

if ( ! empty( $el_class ) ) {
	$classes .= ' ' . $el_class;
}
$output = '<' . $tag . $atts . ' class="cl-ib' . $classes . '"';
$output .= cl_prepare_inline_css( array(
	'width' => $width,
	'background-color' => $bgcolor,
	'color' => $textcolor,
) );
$output .= '>';

$output .= '<div class="cl-ib-h easing_' . $easing . '">';
$img = wp_get_attachment_image_src( $image, $size );
if ( ! $img ) {
	// TODO set placeholder
	$img = array( '', 0, 0 );
} else {
	$img_alt = get_post_meta( $image, '_wp_attachment_image_alt', TRUE );
}
if ( ! isset( $img_alt ) OR empty( $img_alt ) ) {
	$img_alt = strip_tags( $title );
}
$output .= '<div class="cl-ib-image" style="background-image: url(' . esc_attr( $img[0] ) . ')">';
$output .= '<img src="' . esc_attr( $img[0] ) . '" ' . image_hwstring( $img[1], $img[2] ) . ' alt="' . esc_attr( $img_alt ) . '" />';
$output .= '</div>';
$output .= '<div class="cl-ib-content"';
$output .= cl_prepare_inline_css( array(
	'padding' => $padding,
) );
$output .= '><div class="cl-ib-content-h">' . $title_html . $desc_html . '</div></div>';
$output .= '</div>';
$output .= '</' . $tag . '>';

$output .= $custom_css;

echo $output;
