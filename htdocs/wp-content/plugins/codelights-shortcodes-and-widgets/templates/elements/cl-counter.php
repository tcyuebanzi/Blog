<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Output a single flipbox element.
 *
 * @var $initial string The initial string
 * @var $final string The final string
 * @var $duration string Animation duration: '100ms' / '200ms' / ... / '1200ms'
 * @var $animation string Digits animation type: 'none' / 'slideup' / 'slidedown'
 * @var $title string
 * @var $value_size string Font size
 * @var $title_size string Title size
 * @var $value_color string Value color
 * @var $title_color string Title color
 * @var $el_class string Extra class name
 */

// Enqueuing the needed assets
wp_enqueue_style( 'cl-counter' );
wp_enqueue_script( 'cl-counter' );

// Element classes and attributes
$classes = '';
$atts = '';

if ( ! empty( $duration ) ) {
	$atts .= ' data-duration="' . esc_attr( $duration ) . '"';
}

// Finding numbers positions in both initial and final strings
$pos = array();
foreach ( array( 'initial', 'final' ) as $key ) {
	$pos[ $key ] = array();
	// In this array we'll store the string's character number, where primitive changes from letter to number or back
	preg_match_all( '~(\(\-?\d+([\.,\'· ]\d+)*\))|(\-?\d+([\.,\'· ]\d+)*)~u', $$key, $matches, PREG_OFFSET_CAPTURE );
	foreach ( $matches[0] as $match ) {
		$pos[ $key ][] = $match[1];
		$pos[ $key ][] = $match[1] + strlen( $match[0] );
	}
};

// Making sure we have the equal number of numbers in both strings
if ( count( $pos['initial'] ) != count( $pos['final'] ) ) {
	// Not-paired numbers will be treated as letters
	if ( count( $pos['initial'] ) > count( $pos['final'] ) ) {
		$pos['initial'] = array_slice( $pos['initial'], 0, count( $pos['final'] ) );
	} else/*if ( count( $positions['initial'] ) < count( $positions['final'] ) )*/ {
		$pos['final'] = array_slice( $pos['final'], 0, count( $pos['initial'] ) );
	}
}

// Position boundaries
foreach ( array( 'initial', 'final' ) as $key ) {
	array_unshift( $pos[ $key ], 0 );
	$pos[ $key ][] = strlen( $$key );
}

if ( ! empty( $el_class ) ) {
	$classes .= ' ' . $el_class;
}

$output = '<div class="cl-counter' . $classes . '"' . $atts . '>';
$output .= '<div class="cl-counter-value"';
$output .= cl_prepare_inline_css( array(
	'color' => $value_color,
	'font-size' => $value_size,
) );
$output .= '>';

// Determining if we treat each part as a number or as a letter combination
for ( $index = 0, $length = count( $pos['initial'] ) - 1; $index < $length; $index++ ) {
	$part_type = ( $index % 2 ) ? 'number' : 'text';
	$part_initial = substr( $initial, $pos['initial'][ $index ], $pos['initial'][ $index + 1 ] - $pos['initial'][ $index ] );
	$part_final = substr( $final, $pos['final'][ $index ], $pos['final'][ $index + 1 ] - $pos['final'][ $index ] );
	$output .= '<span class="cl-counter-value-part type_' . $part_type . '" data-final="' . esc_attr( $part_final ) . '">' . $part_initial . '</span>';
}

$output .= '</div>';
if ( ! empty( $title ) ) {
	$output .= '<div class="cl-counter-title"';
	$output .= cl_prepare_inline_css( array(
		'color' => $title_color,
		'font-size' => $title_size,
	) );
	$output .= '>' . $title . '</div>';
}
$output .= '</div>';
echo $output;
