<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Output a single Modal Popup element.
 *
 * @var $title string Modal title
 * @var $content string Modal HTML content
 * @var $show_on string Show modal on: 'btn' / 'image' / 'text' / 'load'
 * @var $btn_label string Button / Text label
 * @var $btn_bgcolor string Button background color
 * @var $btn_color string Button text color
 * @var $image int ID of the WP attachment image
 * @var $image_size string WordPress image thumbnail name
 * @var $text_size int Text size
 * @var $text_color string Text color
 * @var $align string Button / image / text alignment: 'left' / 'center' / 'right'
 * @var $show_delay int Modal box show delay (in ms)
 * @var $size string Modal box size: 's' / 'm' / 'l' / 'f'
 * @var $paddings bool Remove white space around popup content?
 * @var $animation string 'scaleUp' / 'slideRight' / 'slideBottom' / 'newspaper' / 'fall' / 'stickyTop' / 'stickyBottom' / 'flipHor' / 'flipVer' / 'scaleDown'
 * @var $border_radius int Border radius
 * @var $overlay_bgcolor string Overlay background color
 * @var $title_bgcolor string Title background color
 * @var $title_textcolor string Title text color
 * @var $content_bgcolor string Content background color
 * @var $content_textcolor string Content text color
 * @var $el_class string Extra class name
 */

// Enqueuing the needed assets
wp_enqueue_style( 'cl-popup' );
wp_enqueue_script( 'cl-popup' );

// Main element classes
$classes = ' align_' . $align;
if ( ! empty( $el_class ) ) {
	$classes .= ' ' . $el_class;
}

$output = '<div class="cl-popup' . $classes . '">';

// Trigger
if ( $show_on == 'image' AND ! empty( $image ) AND ( $image_html = wp_get_attachment_image( $image, $image_size ) ) ) {
	$output .= '<a href="javascript:void(0)" class="cl-popup-trigger type_image">' . $image_html . '</a>';
} elseif ( $show_on == 'text' ) {
	$output .= '<a href="javascript:void(0)" class="cl-popup-trigger type_text"';
	$output .= cl_prepare_inline_css( array(
		'font-size' => $text_size,
		'color' => $text_color,
	) );
	$output .= '>' . $btn_label . '</a>';
} elseif ( $show_on == 'load' ) {
	$output .= '<span class="cl-popup-trigger type_load" data-delay="' . intval( $show_delay ) . '"></span>';
} else/*if ( $show_on == 'btn' )*/ {
	$output .= '<a href="javascript:void(0)" class="cl-popup-trigger type_btn cl-btn"';
	$output .= cl_prepare_inline_css( array(
		'color' => $btn_color,
		'background-color' => $btn_bgcolor,
	) );
	$output .= '><span>' . $btn_label . '</span></a>';
}

// Overlay
$output .= '<div class="cl-popup-overlay"';
$output .= cl_prepare_inline_css( array(
	'background-color' => $overlay_bgcolor,
) );
$output .= '></div>';

// The part that will be shown
$output .= '<div class="cl-popup-wrap';
if ( ! empty( $el_class ) ) {
	$output .= ' ' . $el_class;
}
$output .= '">';
$box_classes = ' size_' . $size . ' animation_' . $animation;
if ( $paddings == 'none' ) {
	$box_classes .= ' paddings_none';
}
$output .= '<div class="cl-popup-box' . $box_classes . '"';
$output .= cl_prepare_inline_css( array(
	'border-radius' => $border_radius,
) );
$output .= '><div class="cl-popup-box-h">';

// Modal box title
if ( ! empty( $title ) ) {
	$output .= '<div class="cl-popup-box-title"';
	$output .= cl_prepare_inline_css( array(
		'color' => $title_textcolor,
		'background-color' => $title_bgcolor,
	) );
	$output .= '>' . $title . '</div>';
}

// Modal box content
$output .= '<div class="cl-popup-box-content"';
$output .= cl_prepare_inline_css( array(
	'color' => $content_textcolor,
	'background-color' => $content_bgcolor,
) );
$output .= '>' . do_shortcode( $content ) . '</div>';

$output .= '<div class="cl-popup-box-closer"';
if ( ! empty( $title ) ) {
	$output .= cl_prepare_inline_css( array(
		'color' => $title_textcolor,
	) );
}
$output .= '></div></div></div>';
$output .= '<div class="cl-popup-closer"></div>';
$output .= '</div>'; // .cl-popup-wrap

$output .= '</div>'; // .cl-popup

echo $output;
