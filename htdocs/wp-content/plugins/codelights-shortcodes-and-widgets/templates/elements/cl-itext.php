<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Output a single Ineractive Banner element.
 *
 * @var $texts string newline-separated text states
 * @var $dynamic_bold bool Bold dynamic text?
 * @var $animation_type string Animation type: 'fadeIn' / 'flipInX' / 'flipInXChars' / 'zoomIn' / 'zoomInChars'
 * @var $font_size int Font size in pixels
 * @var $font_size_mobile int Font size for mobiles in pixels
 * @var $color string Basic text color
 * @var $dynamic_color string Changing part text color
 * @var $align string Text alignment: 'left' / 'center' / 'right'
 * @var $tag string Tag name: 'div' / 'h1' / 'h2' / 'h3' / 'p'
 * @var $duration string Animation duration in milliseconds
 * @var $delay string Animation delay in seconds
 * @var $el_class string Extra class name
 */

// Enqueuing the needed assets
wp_enqueue_style( 'cl-itext' );
wp_enqueue_script( 'cl-itext' );

// Main element classes, inner css and additional attributes
$classes = ' type_' . $animation_type . ' align_' . $align;
if ( $dynamic_bold ) {
	$classes .= ' dynamic_bold';
}

// Allows to use nbsps and other entities
$texts = html_entity_decode( $texts );

$texts_arr = explode( "\n", strip_tags( $texts ) );

$js_data = array(
	'duration' => intval( $duration ),
	'delay' => intval( floatval( $delay ) * 1000 ),
);
if ( ! empty( $dynamic_color ) ) {
	$js_data['dynamicColor'] = $dynamic_color;
}

if ( ! empty( $el_class ) ) {
	$classes .= ' ' . $el_class;
}

// Getting words and their delimiters to work on this level of abstraction
$_parts = array();
foreach ( $texts_arr as $index => $text ) {
	preg_match_all( '~[\w\-]+|[^\w\-]+~u', $text, $matches );
	$_parts[ $index ] = $matches[0];
}

// Getting the whole set of parts with all the intermediate values (part_index => part_states)
$groups = array();
foreach ( $_parts[0] as $part ) {
	$groups[] = array( $part );
}

for ( $i_index = count( $_parts ) - 1; $i_index > 0; $i_index-- ) {
	$f_index = isset( $_parts[ $i_index + 1 ] ) ? ( $i_index + 1 ) : 0;
	$initial = &$_parts[ $i_index ];
	$final = &$_parts[ $f_index ];
	// Counting arrays edit distance for the strings parts to find the common parts
	$dist = array();
	for ( $i = 0; $i <= count( $initial ); $i++ ) {
		$dist[ $i ] = array( $i );
	}
	for ( $j = 1; $j <= count( $final ); $j++ ) {
		$dist[0][ $j ] = $j;
		for ( $i = 1; $i <= count( $initial ); $i++ ) {
			if ( $initial[ $i - 1 ] == $final[ $j - 1 ] ) {
				$dist[ $i ][ $j ] = $dist[ $i - 1 ][ $j - 1 ];
			} else {
				$dist[ $i ][ $j ] = min( $dist[ $i - 1 ][ $j ], $dist[ $i ][ $j - 1 ], $dist[ $i - 1 ][ $j - 1 ] ) + 1;
			}
		}
	}
	for ( $i = count( $initial ), $j = count( $final ); $i > 0 OR $j > 0; $i--, $j-- ) {
		$min = $dist[ $i ][ $j ];
		if ( $i > 0 ) {
			$min = min( $min, $dist[ $i - 1 ][ $j ], ( $j > 0 ) ? $dist[ $i - 1 ][ $j - 1 ] : $min );
		}
		if ( $j > 0 ) {
			$min = min( $min, $dist[ $i ][ $j - 1 ] );
		}
		if ( $min >= $dist[ $i ][ $j ] ) {
			$groups[ $j - 1 ][ $i_index ] = $initial[ $i - 1 ];
			continue;
		}
		if ( $i > 0 AND $j > 0 AND $min == $dist[ $i - 1 ][ $j - 1 ] ) {
			// Modify
			$groups[ $j - 1 ][ $i_index ] = $initial[ $i - 1 ];
		} elseif ( $j > 0 AND $min == $dist[ $i ][ $j - 1 ] ) {
			// Remove
			$groups[ $j - 1 ][ $i_index ] = '';
			$i++;
		} elseif ( $min == $dist[ $i - 1 ][ $j ] ) {
			// Insert
			if ( $j == 0 ) {
				array_unshift( $groups, '' );
			} else {
				array_splice( $groups, $j, 0, '' );
			}
			$groups[ $j ] = array_fill( 0, count( $_parts ), '' );
			$groups[ $j ][ $i_index ] = $initial[ $i - 1 ];
			$j++;
		}
	}
	// Updating final parts
	$_parts[ $i_index ] = array();
	foreach ( $groups as $parts_group ) {
		$_parts[ $i_index ][] = $parts_group[ $i_index ];
	}
}

// Finding the dynamic parts and their animation indexes
$group_changes = array();
$nbsp_char = html_entity_decode( '&nbsp;' );
foreach ( $groups as $index => $group ) {
	$group_changes[ $index ] = array();
	for ( $i = 0; $i < count( $_parts ); $i++ ) {
		if ( $group[ $i ] != $group[ isset( $group[ $i + 1 ] ) ? ( $i + 1 ) : 0 ] OR $group[ $i ] === '' ) {
			$group_changes[ $index ][] = $i;
		}
		// HTML won't show spans with spaces at all, so replacing them with nbsps
		// A bit sophisticated check to speed up this frequent action
		if ( strlen( $group[ $i ] ) AND $group[ $i ][ 0 ] == ' ' AND preg_match( '~^ +$~u', $group[ $i ][ 0 ] ) ) {
			$groups[ $index ][ $i ] = str_replace( ' ', $nbsp_char, $group[ $i ] );
		}
	}
}

// Combining groups that are either static, or are changed at the same time
for ( $i = 1; $i < count( $group_changes ); $i++ ) {
	if ( $group_changes[ $i - 1 ] == $group_changes[ $i ] ) {
		// Combining with the previous element
		foreach ( $groups[ $i - 1 ] AS $index => $part ) {
			$groups[ $i - 1 ][ $index ] .= $groups[ $i ][ $index ];
		}
		array_splice( $groups, $i, 1 );
		array_splice( $group_changes, $i, 1 );
		$i--;
	}
}

$inline_css = cl_prepare_inline_css( array(
	'color' => $color,
	'font-size' => $font_size,
) );

$custom_css = '';
if ( ! empty( $font_size_mobile ) AND (int) $font_size_mobile != (int) $font_size ) {
	// Unique styled element number
	global $cl_custom_css_id;
	$cl_custom_css_id = isset( $cl_custom_css_id ) ? ( $cl_custom_css_id + 1 ) : 1;
	$custom_css .= '<style type="text/css">';
	$custom_css .= '@media only screen and (max-width: 599px) {';
	$custom_css .= '.cl_custom_css_' . $cl_custom_css_id . ' { font-size: ' . intval( $font_size_mobile ) . 'px !important; }';
	$custom_css .= '}';
	$custom_css .= '</style>';
	$classes .= ' cl_custom_css_' . $cl_custom_css_id;
}

$output = '<' . $tag . ' class="cl-itext' . $classes . '"' . $inline_css . cl_pass_data_to_js( $js_data ) . '>';
foreach ( $groups as $index => $group ) {
	ksort( $group );
	if ( empty( $group_changes[ $index ] ) ) {
		// Static part
		$output .= $group[0];
	} else {
		$output .= '<span class="cl-itext-part';
		// Animation classes (just in case site editor wants some custom styling for them)
		foreach ( $group_changes[ $index ] as $changesat ) {
			$output .= ' changesat_' . $changesat;
		}
		if ( in_array( '0', $group_changes[ $index ] ) ) {
			// Highlighting dynamic parts at start
			$output .= ' dynamic"' . cl_prepare_inline_css( array( 'color' => $dynamic_color ) );
		} else {
			$output .= '"';
		}
		$output .= cl_pass_data_to_js( $group ) . '>' . htmlentities( $group[0] ) . '</span>';
	}
}
$output .= '</' . $tag . '>';

$output .= $custom_css;

echo $output;
