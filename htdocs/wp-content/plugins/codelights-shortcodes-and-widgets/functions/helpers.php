<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Load plugin's textdomain
 *
 * @param string $domain
 * @param string $path Relative path to seek in the plugin
 *
 * @return bool
 */
function cl_maybe_load_plugin_textdomain( $domain = 'codelights-shortcodes-and-widgets', $path = 'lang' ) {
	if ( is_textdomain_loaded( $domain ) ) {
		return TRUE;
	}
	global $cl_dir;

	return load_plugin_textdomain( $domain, FALSE, basename( $cl_dir ) . '/' . $path );
}

/**
 * Load and return some specific config or it's part
 *
 * @param string $path <config_name>[.<name1>[.<name2>[...]]]
 *
 * @oaram mixed $default Value to return if no data is found
 *
 * @return mixed
 */
function cl_config( $path, $default = NULL ) {
	global $cl_dir;
	// Caching configuration values in a inner static value within the same request
	static $configs = array();
	// Defined paths to configuration files
	$path = explode( '.', $path );
	$config_name = $path[0];
	if ( ! isset( $configs[ $config_name ] ) ) {
		cl_maybe_load_plugin_textdomain();
		$config_path = $cl_dir . 'config/' . $config_name . '.php';
		$config = require $config_path;
		$configs[ $config_name ] = apply_filters( 'cl_config_' . $config_name, $config );
	}
	$value = $configs[ $config_name ];
	for ( $i = 1; $i < count( $path ); $i++ ) {
		if ( is_array( $value ) AND isset( $value[ $path[ $i ] ] ) ) {
			$value = $value[ $path[ $i ] ];
		} else {
			$value = $default;
			break;
		}
	}

	return $value;
}

/**
 * Load and output the template
 *
 * @param string $template Template path
 * @param array $vars Variables that should be passed to the template
 */
function cl_load_template( $template, $vars = NULL ) {
	global $cl_dir;

	$vars = apply_filters( 'cl_template_vars:' . $template, $vars );
	if ( is_array( $vars ) AND ! empty( $vars ) ) {
		extract( $vars );
	}

	do_action( 'cl_before_template:' . $template, $vars );
	if ( ! file_exists( $cl_dir . 'templates/' . $template . '.php' ) ) {
		wp_die( 'File not found: ' . $cl_dir . 'templates/' . $template . '.php' );
	}
	include $cl_dir . 'templates/' . $template . '.php';
	do_action( 'cl_after_template:' . $template, $vars );
}

/**
 * Get and return the template output
 *
 * @param string $template Template path
 * @param array $vars Variables that should be passed to the template
 *
 * @return string Template output
 */
function cl_get_template( $template, $vars = NULL ) {
	ob_start();
	cl_load_template( $template, $vars );

	return ob_get_clean();
}

/**
 * Combine user attributes with config-based attributes and fill in defaults when needed.
 *
 * @param array $atts User attributes
 * @param string $shortcode The shortcode
 *
 * @return array Result
 */
function cl_shortcode_atts( $atts, $shortcode ) {

	// We need to extract shortcodes pairs from the config, so storing them within app execution for productivity
	global $cl_shortcode_pairs;

	if ( ! isset( $cl_shortcode_pairs ) ) {
		$cl_shortcode_pairs = array();
	}

	if ( ! isset( $cl_shortcode_pairs[ $shortcode ] ) ) {
		$cl_shortcode_pairs[ $shortcode ] = array();
		foreach ( cl_config( 'elements.' . $shortcode . '.params', array() ) as $param_name => $param ) {
			if ( ! isset( $param_name ) ) {
				continue;
			}
			if ( isset( $param['std'] ) ) {
				$cl_shortcode_pairs[ $shortcode ][ $param_name ] = $param['std'];
			} elseif ( $param['type'] == 'select' AND isset( $param['options'] ) AND is_array( $param['options'] ) ) {
				$cl_shortcode_pairs[ $shortcode ][ $param_name ] = key( $param['options'] );
			} else {
				$cl_shortcode_pairs[ $shortcode ][ $param_name ] = '';
			}
		}
	}

	return shortcode_atts( $cl_shortcode_pairs[ $shortcode ], $atts, $shortcode );
}

/**
 * Parsing vc_link field type properly
 *
 * @param string $value
 * @param bool $as_string Return prepared anchor attributes string instead of array
 *
 * @return mixed
 */
function cl_parse_link_value( $value, $as_string = FALSE ) {
	$result = array( 'url' => '', 'title' => '', 'target' => '' );
	$params_pairs = explode( '|', $value );
	if ( ! empty( $params_pairs ) ) {
		foreach ( $params_pairs as $pair ) {
			$param = explode( ':', $pair, 2 );
			if ( ! empty( $param[0] ) && isset( $param[1] ) ) {
				$result[ $param[0] ] = trim( rawurldecode( $param[1] ) );
			}
		}
	}

	if ( $as_string ) {
		$string = '';
		foreach ( $result as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$string .= ' ' . ( ( $attr == 'url' ) ? 'href' : $attr ) . '="' . esc_attr( $value ) . '"';
			}
		}

		return $string;
	}

	return $result;
}

/**
 * Load WordPress TinyMCE wysiwyg editor configuration
 * The configration will be available in JavaScript: tinyMCEPreInit.mceInit['codelights']
 */
function cl_maybe_load_wysiwyg() {
	global $cl_html_editor_loaded;
	if ( ! isset( $cl_html_editor_loaded ) OR ! $cl_html_editor_loaded ) {
		$screen = get_current_screen();
		if ( $screen !== NULL AND $screen->base == 'customize' ) {
			cl_load_wysiwyg();
		} else {
			// Support for 3-rd party plugins that customize mce_buttons during the admin_head action
			add_action( 'admin_head', 'cl_load_wysiwyg', 50 );
		}
		$cl_html_editor_loaded = TRUE;
	}
}

function cl_load_wysiwyg() {
	if ( ! class_exists( '_WP_Editors' ) ) {
		require( ABSPATH . WPINC . '/class-wp-editor.php' );
	}
	_WP_Editors::editor_settings( 'codelights', _WP_Editors::parse_settings( 'content', array(
		'dfw' => TRUE,
		'tabfocus_elements' => 'insert-media-button',
		'editor_height' => 360,
	) ) );
}

/**
 * Prepare a proper icon classname from user's custom input
 *
 * @param string $icon_class
 *
 * @return string
 */
function cl_prepare_icon_class( $icon_class ) {
	if ( substr( $icon_class, 0, 3 ) != 'fa-' ) {
		$icon_class = 'fa-' . $icon_class;
	}

	return 'fa ' . $icon_class;
}

/**
 * Prepare a proper inline-css string from given css proper
 *
 * @param array $props
 * @param bool $style_attr
 *
 * @return string
 */
function cl_prepare_inline_css( $props, $style_attr = TRUE ) {
	$result = '';
	foreach ( $props as $prop => $value ) {
		if ( empty( $value ) ) {
			continue;
		}
		switch ( $prop ) {
			// Properties that can be set either in percents or in pixels
			case 'width':
			case 'padding':
				if ( is_string( $value ) AND strpos( $value, '%' ) !== FALSE ) {
					$result .= $prop . ':' . floatval( $value ) . '%;';
				} else {
					$result .= $prop . ':' . intval( $value ) . 'px;';
				}
				break;
			// Properties that can be set only in pixels
			case 'height':
			case 'font-size':
			case 'line-height':
			case 'border-width':
			case 'border-radius':
				$result .= $prop . ':' . intval( $value ) . 'px;';
				break;
			// Properties that need vendor prefixes
			case 'transition-duration':
				if ( ! preg_match( '~^(\d+ms)|(\d{0,2}(\.\d+)?s)$~', $value ) ) {
					$value = ( ( strpos( $value, '.' ) !== FALSE ) ? intval( ( floatval( $value ) * 1000 ) ) : intval( $value ) ) . 'ms';
				}
				$result .= '-webkit-' . $prop . ':' . $value . ';' . $prop . ':' . $value . ';';
				break;
			// Properties with image values
			case 'background-image':
				if ( is_numeric( $value ) ) {
					$image = wp_get_attachment_image_src( $value, 'full' );
					if ( $image ) {
						$result .= $prop . ':url("' . $image[0] . '");';
					}
				} else {
					$result .= $prop . ':url("' . $value . '");';
				}
				break;
			// All other properties
			default:
				$result .= $prop . ':' . $value . ';';
				break;
		}
	}
	if ( $style_attr AND ! empty( $result ) ) {
		$result = ' style="' . esc_attr( $result ) . '"';
	}

	return $result;
}

/**
 * Get image size information as an array
 *
 * @param string $size_name
 *
 * @return array
 */
function cl_get_intermediate_image_size( $size_name ) {
	global $_wp_additional_image_sizes;
	if ( isset( $_wp_additional_image_sizes[ $size_name ] ) ) {
		// Getting custom image size
		return $_wp_additional_image_sizes[ $size_name ];
	} else {
		// Getting standard image size
		return array(
			'width' => get_option( "{$size_name}_size_w" ),
			'height' => get_option( "{$size_name}_size_h" ),
			'crop' => get_option( "{$size_name}_crop" ),
		);
	}
}

/**
 * Get image size values for selector
 *
 * @param array $size_names List of size names
 *
 * @return array
 */
function cl_image_sizes_select_values( $size_names = array( 'large', 'medium', 'thumbnail', 'full' ) ) {
	$image_sizes = array();
	// For translation purposes
	$size_titles = array(
		'large' => __( 'Large', 'codelights-shortcodes-and-widgets' ),
		'medium' => __( 'Medium', 'codelights-shortcodes-and-widgets' ),
		'thumbnail' => __( 'Thumbnail', 'codelights-shortcodes-and-widgets' ),
		'full' => __( 'Full Size', 'codelights-shortcodes-and-widgets' ),
	);
	foreach ( $size_names as $size_name ) {
		$size_title = isset( $size_titles[ $size_name ] ) ? $size_titles[ $size_name ] : ucwords( $size_name );
		if ( $size_name != 'full' ) {
			// Detecting size
			$size = cl_get_intermediate_image_size( $size_name );
			$size_title .= ' - ' . ( ( $size['width'] == 0 ) ? __( 'Any', 'codelights-shortcodes-and-widgets' ) : $size['width'] );
			$size_title .= 'x';
			$size_title .= ( $size['height'] == 0 ) ? __( 'Any', 'codelights-shortcodes-and-widgets' ) : $size['height'];
			$size_title .= ' (' . ( $size['crop'] ? __( 'cropped', 'codelights-shortcodes-and-widgets' ) : __( 'not cropped', 'codelights-shortcodes-and-widgets' ) ) . ')';
		}
		$image_sizes[ $size_name ] = $size_title;
	}

	return apply_filters( 'cl_image_sizes_select_values', $image_sizes );
}

/**
 * Transform some variable to elm's onclick attribute, so it could be obtained from JavaScript as:
 * var data = elm.onclick()
 *
 * @param mixed $data Data to pass
 *
 * @return string Element attribute ' onclick="..."'
 */
function cl_pass_data_to_js( $data ) {
	return ' onclick=\'return ' . str_replace( "'", '&#39;', json_encode( $data ) ) . '\'';
}

/**
 * Parse hex color value and return red, green and blue integer values in a single array
 *
 * @param string $hex
 *
 * @return array
 */
function cl_hex_to_rgb( $hex ) {
	$hex = preg_replace( '~[^0-9a-f]+~', '', $hex );
	if ( strlen( $hex ) == 3 ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}
	if ( strlen( $hex ) != 6 ) {
		return array( 255, 255, 255 );
	}

	return array( hexdec( $hex[0] . $hex[1] ), hexdec( $hex[2] . $hex[3] ), hexdec( $hex[4] . $hex[5] ) );
}

/**
 * Get hex form of rgb color values
 *
 * @param array $rgb Red, green and blue integer values within a single array
 *
 * @return string
 */
function cl_rgb_to_hex( $rgb ) {
	return sprintf( '#%02x%02x%02x', $rgb[0], $rgb[1], $rgb[2] );
}

/**
 * Transform array to data attribute
 *
 * @param array $data Data to pass
 *
 * @return string Element attribute 'data-param_settings="{values}"'
 */
function cl_array_to_data_js( $data ) {
	return str_replace( '"', '&quot;', json_encode( $data ) );
}

/**
 * Checks if the field visibility condition is true
 *
 * Note: at any possible syntax error we choose to show the field so it will be functional anyway.
 *
 * @param array $condition Showing condition
 * @param array $values
 *
 * @return bool
 */
function cl_execute_show_if( $condition, &$values ) {
	if ( ! is_array( $condition ) OR count( $condition ) < 3 ) {
		// Wrong condition
		$result = TRUE;
	} elseif ( in_array( strtolower( $condition[1] ), array( 'and', 'or' ) ) ) {
		// Complex or / and statement
		$result = cl_execute_show_if( $condition[0], $values );
		$index = 2;
		while ( isset( $condition[ $index ] ) ){
			$condition[ $index - 1 ] = strtolower( $condition[ $index - 1 ] );
			if ( $condition[ $index - 1 ] == 'and' ) {
				$result = ( $result AND cl_execute_show_if( $condition[ $index ], $values ) );
			} elseif ( $condition[ $index - 1 ] == 'or' ) {
				$result = ( $result OR cl_execute_show_if( $condition[ $index ], $values ) );
			}
			$index = $index + 2;
		}
	} else {
		if ( ! isset( $values[ $condition[0] ] ) ) {
			return TRUE;
		}
		$value = $values[ $condition[0] ];
		if ( $condition[1] == '=' ) {
			$result = ( $value == $condition[2] );
		} elseif ( $condition[1] == '!=' OR $condition[1] == '<>' ) {
			$result = ( $value != $condition[2] );
		} elseif ( $condition[1] == 'in' ) {
			$result = ( ! is_array( $condition[2] ) OR in_array( $value, $condition[2] ) );
		} elseif ( $condition[1] == 'not in' ) {
			$result = ( ! is_array( $condition[2] ) OR ! in_array( $value, $condition[2] ) );
		} elseif ( $condition[1] == '<=' ) {
			$result = ( $value <= $condition[2] );
		} elseif ( $condition[1] == '<' ) {
			$result = ( $value < $condition[2] );
		} elseif ( $condition[1] == '>' ) {
			$result = ( $value > $condition[2] );
		} elseif ( $condition[1] == '>=' ) {
			$result = ( $value >= $condition[2] );
		} else {
			$result = TRUE;
		}
	}

	return $result;
}
