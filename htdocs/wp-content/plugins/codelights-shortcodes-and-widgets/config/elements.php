<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

global $cl_uri;

return array(

	'cl-counter' => array(
		'title' => __( 'Stats Counter', 'codelights-shortcodes-and-widgets' ),
		'description' => __( 'Animated text with numbers', 'codelights-shortcodes-and-widgets' ),
		'category' => 'CodeLights',
		'icon' => $cl_uri . '/admin/img/cl-counter.png',
		'widget_php_class' => 'CL_Widget_Counter',
		'params' => array(
			'initial' => array(
				'title' => __( 'Initial Counter value', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'Initial string with all the prefixes, suffixes and decimal marks if needed.', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '0',
			),
			'final' => array(
				'title' => __( 'Final Counter value', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'Final value the way it should look like, when the animation ends.', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '100',
			),
			'title' => array(
				'title' => __( 'Counter Title', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '',
			),
			'duration' => array(
				'title' => __( 'Animation Duration', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'In milliseconds', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '3000',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'value_size' => array(
				'title' => __( 'Value Font Size', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '50',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'title_size' => array(
				'title' => __( 'Title Font Size', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '20',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'value_color' => array(
				'title' => __( 'Value Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'title_color' => array(
				'title' => __( 'Title Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'el_class' => array(
				'title' => __( 'Extra class name', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
		),
	),
	'cl-flipbox' => array(
		'title' => __( 'FlipBox', 'codelights-shortcodes-and-widgets' ),
		'description' => __( 'Two-sided content element, flipping on hover', 'codelights-shortcodes-and-widgets' ),
		'category' => 'CodeLights',
		'icon' => $cl_uri . '/admin/img/cl-flipbox.png',
		'widget_php_class' => 'CL_Widget_Flipbox',
		'params' => array(
			/**
			 * General
			 */
			'link_type' => array(
				'title' => __( 'Link', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'none' => __( 'No Link', 'codelights-shortcodes-and-widgets' ),
					'container' => __( 'Add link to the whole FlipBox', 'codelights-shortcodes-and-widgets' ),
					'btn' => __( 'Add link as a separate button', 'codelights-shortcodes-and-widgets' ),
				),
				'std' => 'none',
			),
			'link' => array(
				'title' => __( 'Link URL', 'codelights-shortcodes-and-widgets' ),
				'type' => 'link',
				'show_if' => array( 'link_type', 'in', array( 'container', 'btn' ) ),
			),
			'back_btn_label' => array(
				'title' => __( 'Button Label', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => 'READ MORE', // Not translatable
				'show_if' => array( 'link_type', '=', 'btn' ),
			),
			'back_btn_bgcolor' => array(
				'title' => __( 'Button Background Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'classes' => 'cl_col-sm-6 cl_column',
				'show_if' => array( 'link_type', '=', 'btn' ),
			),
			'back_btn_color' => array(
				'title' => __( 'Button Text Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'classes' => 'cl_col-sm-6 cl_column',
				'show_if' => array( 'link_type', '=', 'btn' ),
			),
			'animation' => array(
				'title' => __( 'Animation Type', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'cardflip' => __( 'Card Flip', 'codelights-shortcodes-and-widgets' ),
					'cubetilt' => __( 'Cube Tilt', 'codelights-shortcodes-and-widgets' ),
					'cubeflip' => __( 'Cube Flip', 'codelights-shortcodes-and-widgets' ),
					'coveropen' => __( 'Cover Open', 'codelights-shortcodes-and-widgets' ),
				),
				'classes' => 'cl_col-sm-6 cl_column',
			),
			'direction' => array(
				'title' => __( 'Animation Direction', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'n' => __( 'Up', 'codelights-shortcodes-and-widgets' ),
					'ne' => __( 'Up-Right', 'codelights-shortcodes-and-widgets' ),
					'e' => __( 'Right', 'codelights-shortcodes-and-widgets' ),
					'se' => __( 'Down-Right', 'codelights-shortcodes-and-widgets' ),
					's' => __( 'Down', 'codelights-shortcodes-and-widgets' ),
					'sw' => __( 'Down-Left', 'codelights-shortcodes-and-widgets' ),
					'w' => __( 'Left', 'codelights-shortcodes-and-widgets' ),
					'nw' => __( 'Up-Left', 'codelights-shortcodes-and-widgets' ),
				),
				'std' => 'w',
				'classes' => 'cl_col-sm-6 cl_column',
			),
			'duration' => array(
				'title' => __( 'Animation Duration', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'In milliseconds', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '500',
				'classes' => 'cl_col-sm-6 cl_column',
			),
			'easing' => array(
				'title' => __( 'Animation Easing', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'ease' => 'ease',
					'easeInOutExpo' => 'easeInOutExpo',
					'easeInOutCirc' => 'easeInOutCirc',
					'easeOutBack' => 'easeOutBack',
				),
				'std' => 'easeInOutSine',
				'classes' => 'cl_col-sm-6 cl_column',
			),
			/**
			 * Front Side
			 */
			'front_icon_type' => array(
				'title' => __( 'Icon to Display', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'none' => __( 'None', 'codelights-shortcodes-and-widgets' ),
					'font' => __( 'FontAwesome Icon', 'codelights-shortcodes-and-widgets' ),
					'image' => __( 'Custom Image', 'codelights-shortcodes-and-widgets' ),
				),
				'group' => __( 'Front Side', 'codelights-shortcodes-and-widgets' ),
			),
			'front_icon_name' => array(
				'title' => __( 'Icon Name', 'codelights-shortcodes-and-widgets' ),
				'description' => sprintf( __( '<a href="%s" target="_blank">FontAwesome</a> icon', 'codelights-shortcodes-and-widgets' ), 'http://fontawesome.io/icons/' ),
				'type' => 'textfield',
				'group' => __( 'Front Side', 'codelights-shortcodes-and-widgets' ),
				'show_if' => array( 'front_icon_type', '=', 'font' ),
			),
			'front_icon_size' => array(
				'title' => __( 'Icon Size', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '35',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Front Side', 'codelights-shortcodes-and-widgets' ),
				'show_if' => array( 'front_icon_type', '=', 'font' ),
			),
			'front_icon_style' => array(
				'title' => __( 'Icon Style', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'default' => __( 'Simple', 'codelights-shortcodes-and-widgets' ),
					'circle' => __( 'Circle Background', 'codelights-shortcodes-and-widgets' ),
					'square' => __( 'Square Background', 'codelights-shortcodes-and-widgets' ),
				),
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Front Side', 'codelights-shortcodes-and-widgets' ),
				'show_if' => array( 'front_icon_type', '=', 'font' ),
			),
			'front_icon_color' => array(
				'title' => __( 'Icon Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Front Side', 'codelights-shortcodes-and-widgets' ),
				'show_if' => array( 'front_icon_type', '=', 'font' ),
			),
			'front_icon_bgcolor' => array(
				'title' => __( 'Icon Background Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Front Side', 'codelights-shortcodes-and-widgets' ),
				'show_if' => array( 'front_icon_type', '=', 'font' ),
			),
			'front_icon_image' => array(
				'title' => __( 'Image', 'codelights-shortcodes-and-widgets' ),
				'type' => 'image',
				'group' => __( 'Front Side', 'codelights-shortcodes-and-widgets' ),
				'show_if' => array( 'front_icon_type', '=', 'image' ),
			),
			'front_icon_image_width' => array(
				'title' => __( 'Image Width', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'In pixels or percents', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '32px',
				'group' => __( 'Front Side', 'codelights-shortcodes-and-widgets' ),
				'show_if' => array( 'front_icon_type', '=', 'image' ),
			),
			'front_title' => array(
				'title' => __( 'Title', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => 'FlipBox Title', // Not translatable
				'admin_label' => TRUE,
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Front Side', 'codelights-shortcodes-and-widgets' ),
			),
			'front_title_size' => array(
				'title' => __( 'Title Font Size', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Front Side', 'codelights-shortcodes-and-widgets' ),
			),
			'front_desc' => array(
				'title' => __( 'Description', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textarea',
				'group' => __( 'Front Side', 'codelights-shortcodes-and-widgets' ),
			),
			'front_elmorder' => array(
				'title' => __( 'Elements Order', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'itd' => __( 'Icon', 'codelights-shortcodes-and-widgets' ) . ' / ' . __( 'Title', 'codelights-shortcodes-and-widgets' ) . ' / ' . __( 'Description', 'codelights-shortcodes-and-widgets' ),
					'tid' => __( 'Title', 'codelights-shortcodes-and-widgets' ) . ' / ' . __( 'Icon', 'codelights-shortcodes-and-widgets' ) . ' / ' . __( 'Description', 'codelights-shortcodes-and-widgets' ),
					'tdi' => __( 'Title', 'codelights-shortcodes-and-widgets' ) . ' / ' . __( 'Description', 'codelights-shortcodes-and-widgets' ) . ' / ' . __( 'Icon', 'codelights-shortcodes-and-widgets' ),
				),
				'group' => __( 'Front Side', 'codelights-shortcodes-and-widgets' ),
			),
			'front_bgcolor' => array(
				'title' => __( 'Background Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'group' => __( 'Front Side', 'codelights-shortcodes-and-widgets' ),
			),
			'front_textcolor' => array(
				'title' => __( 'Text Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'group' => __( 'Front Side', 'codelights-shortcodes-and-widgets' ),
			),
			'front_bgimage' => array(
				'title' => __( 'Background Image', 'codelights-shortcodes-and-widgets' ),
				'type' => 'image',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Front Side', 'codelights-shortcodes-and-widgets' ),
			),
			'front_bgimage_size' => array(
				'title' => __( 'Image Size', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => cl_image_sizes_select_values(),
				'std' => 'full',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Front Side', 'codelights-shortcodes-and-widgets' ),
			),
			/**
			 * Back Side
			 */
			'back_title' => array(
				'title' => __( 'Title', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => 'FlipBox Title', // Not translatable
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Back Side', 'codelights-shortcodes-and-widgets' ),
			),
			'back_title_size' => array(
				'title' => __( 'Title Font Size', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Back Side', 'codelights-shortcodes-and-widgets' ),
			),
			'back_desc' => array(
				'title' => __( 'Description', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textarea',
				'group' => __( 'Back Side', 'codelights-shortcodes-and-widgets' ),
			),
			'back_elmorder' => array(
				'title' => __( 'Elements Order', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'tdb' => __( 'Title', 'codelights-shortcodes-and-widgets' ) . ' / ' . __( 'Description', 'codelights-shortcodes-and-widgets' ) . ' / ' . __( 'Button (if exists)', 'codelights-shortcodes-and-widgets' ),
					'tbd' => __( 'Title', 'codelights-shortcodes-and-widgets' ) . ' / ' . __( 'Button (if exists)', 'codelights-shortcodes-and-widgets' ) . ' / ' . __( 'Description', 'codelights-shortcodes-and-widgets' ),
					'btd' => __( 'Button (if exists)', 'codelights-shortcodes-and-widgets' ) . ' / ' . __( 'Title', 'codelights-shortcodes-and-widgets' ) . ' / ' . __( 'Description', 'codelights-shortcodes-and-widgets' ),
				),
				'group' => __( 'Back Side', 'codelights-shortcodes-and-widgets' ),
			),
			'back_bgcolor' => array(
				'title' => __( 'Background Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'group' => __( 'Back Side', 'codelights-shortcodes-and-widgets' ),
			),
			'back_textcolor' => array(
				'title' => __( 'Text Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'group' => __( 'Back Side', 'codelights-shortcodes-and-widgets' ),
			),
			'back_bgimage' => array(
				'title' => __( 'Background Image', 'codelights-shortcodes-and-widgets' ),
				'type' => 'image',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Back Side', 'codelights-shortcodes-and-widgets' ),
			),
			'back_bgimage_size' => array(
				'title' => __( 'Image Size', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => cl_image_sizes_select_values(),
				'std' => 'full',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Back Side', 'codelights-shortcodes-and-widgets' ),
			),
			/**
			 * Custom
			 */
			'width' => array(
				'title' => __( 'Width', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'In pixels or percents', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '100%',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'height' => array(
				'title' => __( 'Height', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'Leave blank to use front height', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'valign' => array(
				'type' => 'checkboxes',
				'options' => array(
					'center' => __( 'Center-Align Content Vertically', 'codelights-shortcodes-and-widgets' ),
				),
				'std' => 'top',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'border_radius' => array(
				'title' => __( 'Border Radius', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '0',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'border_size' => array(
				'title' => __( 'Border Width', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '0',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'border_color' => array(
				'title' => __( 'Border Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'padding' => array(
				'title' => __( 'Padding', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'In pixels or percents', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '15%',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'el_class' => array(
				'title' => __( 'Extra class name', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
		),
	),
	'cl-ib' => array(
		'title' => __( 'Interactive Banner', 'codelights-shortcodes-and-widgets' ),
		'description' => __( 'Hoverable image with additional data', 'codelights-shortcodes-and-widgets' ),
		'category' => 'CodeLights',
		'icon' => $cl_uri . '/admin/img/cl-ib.png',
		'widget_php_class' => 'CL_Widget_Ib',
		'params' => array(
			/**
			 * Content
			 */
			'image' => array(
				'title' => __( 'Banner Image', 'codelights-shortcodes-and-widgets' ),
				'type' => 'image',
				'classes' => 'cl_col-sm-6 cl_column',
			),
			'size' => array(
				'title' => __( 'Image Size', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => cl_image_sizes_select_values(),
				'std' => 'large',
				'classes' => 'cl_col-sm-6 cl_column',
			),
			'title' => array(
				'title' => __( 'Title', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => 'Banner Title', // Not translatable
				'admin_label' => TRUE,
			),
			'desc' => array(
				'title' => __( 'Description', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textarea',
			),
			'link' => array(
				'title' => __( 'Link', 'codelights-shortcodes-and-widgets' ),
				'type' => 'link',
			),
			'animation' => array(
				'title' => __( 'Animation Type', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'melete' => 'Melete',
					'soter' => 'Soter',
					'phorcys' => 'Phorcys',
					'aidos' => 'Aidos',
					'caeros' => 'Caeros',
					'hebe' => 'Hebe',
					'aphelia' => 'Aphelia',
					'nike' => 'Nike',
				),
				'classes' => 'cl_col-sm-6 cl_column',
			),
			'easing' => array(
				'title' => __( 'Animation Easing', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'ease' => 'ease',
					'easeInOutExpo' => 'easeInOutExpo',
					'easeInOutCirc' => 'easeInOutCirc',
					'easeOutBack' => 'easeOutBack',
				),
				'std' => 'ease',
				'classes' => 'cl_col-sm-6 cl_column',
			),
			/**
			 * Style
			 */
			'bgcolor' => array(
				'title' => __( 'Background Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'std' => '#444444',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'textcolor' => array(
				'title' => __( 'Text Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'std' => '#ffffff',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'ratio' => array(
				'title' => __( 'Aspect Ratio', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'2x1' => '2x1 (' . __( 'Landscape', 'codelights-shortcodes-and-widgets' ) . ')',
					'3x2' => '3x2 (' . __( 'Landscape', 'codelights-shortcodes-and-widgets' ) . ')',
					'4x3' => '4x3 (' . __( 'Landscape', 'codelights-shortcodes-and-widgets' ) . ')',
					'1x1' => '1x1 (' . __( 'Square', 'codelights-shortcodes-and-widgets' ) . ')',
					'3x4' => '3x4 (' . __( 'Portrait', 'codelights-shortcodes-and-widgets' ) . ')',
					'2x3' => '2x3 (' . __( 'Portrait', 'codelights-shortcodes-and-widgets' ) . ')',
					'1x2' => '1x2 (' . __( 'Portrait', 'codelights-shortcodes-and-widgets' ) . ')',
				),
				'std' => '3x2',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'align' => array(
				'title' => __( 'Text Alignment', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'left' => __( 'Left', 'codelights-shortcodes-and-widgets' ),
					'center' => __( 'Center', 'codelights-shortcodes-and-widgets' ),
					'right' => __( 'Right', 'codelights-shortcodes-and-widgets' ),
				),
				'std' => 'center',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'width' => array(
				'title' => __( 'Width', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'In pixels or percents', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '100%',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'padding' => array(
				'title' => __( 'Padding', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'In pixels or percents', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '10%',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'el_class' => array(
				'title' => __( 'Extra class name', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			/**
			 * Typography
			 */
			'title_size' => array(
				'title' => __( 'Title Font Size', 'codelights-shortcodes-and-widgets' ),
				'description' => '',
				'type' => 'textfield',
				'std' => '30px',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Typography', 'codelights-shortcodes-and-widgets' ),
			),
			'desc_size' => array(
				'title' => __( 'Description Font Size', 'codelights-shortcodes-and-widgets' ),
				'description' => '',
				'type' => 'textfield',
				'std' => '16px',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Typography', 'codelights-shortcodes-and-widgets' ),
			),
			'title_mobile_size' => array(
				'title' => __( 'Title Font Size for Mobiles', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'This value will be applied when screen width is less than 600px', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '24px',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Typography', 'codelights-shortcodes-and-widgets' ),
			),
			'desc_mobile_size' => array(
				'title' => __( 'Description Size for Mobiles', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'This value will be applied when screen width is less than 600px', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '16px',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Typography', 'codelights-shortcodes-and-widgets' ),
			),
			'title_tag' => array(
				'title' => __( 'Title Tag Name', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'Used for SEO purposes', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'h1' => 'h1',
					'h2' => 'h2',
					'h3' => 'h3',
					'h4' => 'h4',
					'h5' => 'h5',
					'h6' => 'h6',
					'div' => 'div',
				),
				'std' => 'h4',
				'group' => __( 'Typography', 'codelights-shortcodes-and-widgets' ),
			),
		),
	),
	'cl-itext' => array(
		'title' => __( 'Interactive Text', 'codelights-shortcodes-and-widgets' ),
		'description' => __( 'Text with some dynamicatlly changing part', 'codelighs-shortcodes-and-widgets' ),
		'category' => 'CodeLights',
		'icon' => $cl_uri . '/admin/img/cl-itext.png',
		'widget_php_class' => 'CL_Widget_Itext',
		'params' => array(
			/**
			 * General
			 */
			'texts' => array(
				'title' => __( 'Text States', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'Each state from a new line', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textarea',
				'std' => 'We create great design' . "\n" . 'We create great websites' . "\n" . 'We create great code',
			),
			'dynamic_bold' => array(
				'title' => '',
				'type' => 'checkboxes',
				'options' => array(
					TRUE => __( 'Bold Dynamic Text', 'codelights-shortcodes-and-widgets' ),
				),
				'std' => TRUE,
			),
			'animation_type' => array(
				'title' => __( 'Animation Type', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'fadeIn' => __( 'Fade in the whole part', 'codelights-shortcodes-and-widgets' ),
					'flipInX' => __( 'Flip the whole part', 'codelights-shortcodes-and-widgets' ),
					'flipInXChars' => __( 'Flip character by character', 'codelights-shortcodes-and-widgets' ),
					'zoomIn' => __( 'Zoom in the whole part', 'codelights-shortcodes-and-widgets' ),
					'zoomInChars' => __( 'Zoom in character by character', 'codelights-shortcodes-and-widgets' ),
				),
				'std' => 'fadeIn',
			),
			/**
			 * Custom
			 */
			'font_size' => array(
				'title' => __( 'Font Size', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '50px',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'font_size_mobile' => array(
				'title' => __( 'Font Size for Mobiles', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'This value will be applied when screen width is less than 600px', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '30px',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'color' => array(
				'title' => __( 'Basic Text Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'dynamic_color' => array(
				'title' => __( 'Dynamic Text Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'align' => array(
				'title' => __( 'Text Alignment', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'left' => __( 'Left', 'codelights-shortcodes-and-widgets' ),
					'center' => __( 'Center', 'codelights-shortcodes-and-widgets' ),
					'right' => __( 'Right', 'codelights-shortcodes-and-widgets' ),
				),
				'std' => 'center',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'tag' => array(
				'title' => __( 'Tag Name', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'div' => 'div',
					'h1' => 'h1',
					'h2' => 'h2',
					'h3' => 'h3',
					'h4' => 'h4',
					'h5' => 'h5',
					'h6' => 'h6',
					'p' => 'p',
				),
				'std' => 'h2',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'duration' => array(
				'title' => __( 'Animation Duration', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'In milliseconds', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '300',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'delay' => array(
				'title' => __( 'Animation Delay', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'In seconds', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '5',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
			'el_class' => array(
				'title' => __( 'Extra class name', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'group' => __( 'Custom', 'codelights-shortcodes-and-widgets' ),
			),
		),
	),
	'cl-popup' => array(
		'title' => __( 'Modal Popup', 'codelights-shortcodes-and-widgets' ),
		'description' => __( 'Dialog box displayed above the page content', 'codelights-shortcodes-and-widgets' ),
		'category' => 'CodeLights',
		'icon' => $cl_uri . '/admin/img/cl-popup.png',
		'widget_php_class' => 'CL_Widget_Modal',
		'params' => array(
			/**
			 * General
			 */
			'title' => array(
				'title' => __( 'Popup Title', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '',
			),
			'content' => array(
				'title' => __( 'Popup Content', 'codelights-shortcodes-and-widgets' ),
				'type' => 'html',
				'std' => '',
			),
			/**
			 * Trigger
			 */
			'show_on' => array(
				'title' => __( 'Show Popup On', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'btn' => __( 'Button Click', 'codelights-shortcodes-and-widgets' ),
					'text' => __( 'Text Click', 'codelights-shortcodes-and-widgets' ),
					'image' => __( 'Image Click', 'codelights-shortcodes-and-widgets' ),
					'load' => __( 'Page Load', 'codelights-shortcodes-and-widgets' ),
				),
				'std' => 'btn',
				'group' => __( 'Trigger', 'codelights-shortcodes-and-widgets' ),
			),
			'btn_label' => array(
				'title' => __( 'Button / Text Label', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => 'READ MORE', // Not translatable
				'show_if' => array( 'show_on', 'in', array( 'btn', 'text' ) ),
				'group' => __( 'Trigger', 'codelights-shortcodes-and-widgets' ),
			),
			'btn_bgcolor' => array(
				'title' => __( 'Button Background Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'classes' => 'cl_col-sm-6 cl_column',
				'show_if' => array( 'show_on', '=', 'btn' ),
				'group' => __( 'Trigger', 'codelights-shortcodes-and-widgets' ),
			),
			'btn_color' => array(
				'title' => __( 'Button Text Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'classes' => 'cl_col-sm-6 cl_column',
				'show_if' => array( 'show_on', '=', 'btn' ),
				'group' => __( 'Trigger', 'codelights-shortcodes-and-widgets' ),
			),
			'image' => array(
				'title' => __( 'Image', 'codelights-shortcodes-and-widgets' ),
				'type' => 'image',
				'classes' => 'cl_col-sm-6 cl_column',
				'show_if' => array( 'show_on', '=', 'image' ),
				'group' => __( 'Trigger', 'codelights-shortcodes-and-widgets' ),
			),
			'image_size' => array(
				'title' => __( 'Image Size', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => cl_image_sizes_select_values(),
				'std' => 'large',
				'classes' => 'cl_col-sm-6 cl_column',
				'show_if' => array( 'show_on', '=', 'image' ),
				'group' => __( 'Trigger', 'codelights-shortcodes-and-widgets' ),
			),
			'text_size' => array(
				'title' => __( 'Text Size', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '',
				'classes' => 'cl_col-sm-6 cl_column',
				'show_if' => array( 'show_on', '=', 'text' ),
				'group' => __( 'Trigger', 'codelights-shortcodes-and-widgets' ),
			),
			'text_color' => array(
				'title' => __( 'Text Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'classes' => 'cl_col-sm-6 cl_column',
				'show_if' => array( 'show_on', '=', 'text' ),
				'group' => __( 'Trigger', 'codelights-shortcodes-and-widgets' ),
			),
			'align' => array(
				'title' => __( 'Button / Image / Text Alignment', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'left' => __( 'Left', 'codelights-shortcodes-and-widgets' ),
					'center' => __( 'Center', 'codelights-shortcodes-and-widgets' ),
					'right' => __( 'Right', 'codelights-shortcodes-and-widgets' ),
				),
				'std' => 'left',
				'show_if' => array( 'show_on', 'in', array( 'btn', 'image', 'text' ) ),
				'group' => __( 'Trigger', 'codelights-shortcodes-and-widgets' ),
			),
			'show_delay' => array(
				'title' => __( 'Popup Show Delay', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'In seconds', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '2',
				'show_if' => array( 'show_on', '=', 'load' ),
				'group' => __( 'Trigger', 'codelights-shortcodes-and-widgets' ),
			),
			/**
			 * Popup Style
			 */
			'size' => array(
				'title' => __( 'Popup Size', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					's' => __( 'Small', 'codelights-shortcodes-and-widgets' ),
					'm' => __( 'Medium', 'codelights-shortcodes-and-widgets' ),
					'l' => __( 'Large', 'codelights-shortcodes-and-widgets' ),
					'xl' => __( 'Huge', 'codelights-shortcodes-and-widgets' ),
					'f' => __( 'Fullscreen', 'codelights-shortcodes-and-widgets' ),
				),
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'paddings' => array(
				'type' => 'checkboxes',
				'options' => array(
					'none' => __( 'Remove white space around popup content', 'codelights-shortcodes-and-widgets' ),
				),
				'std' => 'default',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'animation' => array(
				'title' => __( 'Appearance Animation', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					// Inspired by http://tympanus.net/Development/ModalWindowEffects/
					'fadeIn' => __( 'Fade In', 'codelights-shortcodes-and-widgets' ),
					'scaleUp' => __( 'Scale Up', 'codelights-shortcodes-and-widgets' ),
					'scaleDown' => __( 'Scale Down', 'codelights-shortcodes-and-widgets' ),
					'slideTop' => __( 'Slide from Top', 'codelights-shortcodes-and-widgets' ),
					'slideBottom' => __( 'Slide from Bottom', 'codelights-shortcodes-and-widgets' ),
					'flipHor' => __( '3D Flip (Horizontal)', 'codelights-shortcodes-and-widgets' ),
					'flipVer' => __( '3D Flip (Vertical)', 'codelights-shortcodes-and-widgets' ),
				),
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'border_radius' => array(
				'title' => __( 'Border Radius', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => '0',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'overlay_bgcolor' => array(
				'title' => __( 'Overlay Background Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'std' => 'rgba(0,0,0,0.75)',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'title_bgcolor' => array(
				'title' => __( 'Header Background Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'std' => '#f2f2f2',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'title_textcolor' => array(
				'title' => __( 'Header Text Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'std' => '#666666',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'content_bgcolor' => array(
				'title' => __( 'Content Background Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'std' => '#ffffff',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'content_textcolor' => array(
				'title' => __( 'Content Text Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'std' => '#333333',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'el_class' => array(
				'title' => __( 'Extra class name', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
		),
	),
	'cl-review' => array(
		'title' => __( 'Testimonial', 'codelights-shortcodes-and-widgets' ),
		'description' => __( 'Client\'s review about a product or service', 'codelights-shortcodes-and-widgets' ),
		'category' => 'CodeLights',
		'icon' => $cl_uri . '/admin/img/cl-review.png',
		'widget_php_class' => 'CL_Widget_Review',
		'params' => array(
			/**
			 * General
			 */
			'quote' => array(
				'title' => __( 'Quote Text', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textarea',
				'std' => 'This product is really awesome!',
			),
			'author' => array(
				'title' => __( 'Author Name', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => 'John Smith',
				'classes' => 'cl_col-sm-6 cl_column',
			),
			'occupation' => array(
				'title' => __( 'Author Description', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => 'Head of ACME',
				'classes' => 'cl_col-sm-6 cl_column',
			),
			'avatar_image' => array(
				'title' => __( 'Author Photo', 'codelights-shortcodes-and-widgets' ),
				'type' => 'image',
				'classes' => 'cl_col-sm-6 cl_column',
			),
			'source' => array(
				'title' => __( 'Author Link', 'codelights-shortcodes-and-widgets' ),
				'type' => 'link',
				'classes' => 'cl_col-sm-6 cl_column',
			),
			'type' => array(
				'title' => __( 'Review Type', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'quote' => __( 'Quote Text Only', 'codelights-shortcodes-and-widgets' ),
					'doc' => __( 'With Scanned Document', 'codelights-shortcodes-and-widgets' ),
					'video' => __( 'With Video', 'codelights-shortcodes-and-widgets' ),
				),
			),
			'doc' => array(
				'title' => __( 'Scanned Document', 'codelights-shortcodes-and-widgets' ),
				'type' => 'image',
				'show_if' => array( 'type', '=', 'doc' ),
			),
			'video' => array(
				'title' => __( 'Video URL to Embed', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'std' => 'https://vimeo.com/146383727',
				'show_if' => array( 'type', '=', 'video' ),
			),
			'layout' => array(
				'title' => __( 'Quote Style', 'codelights-shortcodes-and-widgets' ),
				'type' => 'select',
				'options' => array(
					'clean' => __( 'Clean', 'codelights-shortcodes-and-widgets' ),
					'centered' => __( 'Centered', 'codelights-shortcodes-and-widgets' ),
					'balloon' => __( 'Speech Balloon', 'codelights-shortcodes-and-widgets' ),
					'framed' => __( 'Framed', 'codelights-shortcodes-and-widgets' ),
					'modern' => __( 'Modern', 'codelights-shortcodes-and-widgets' ),
				),
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'bg_color' => array(
				'title' => __( 'Background Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
				'show_if' => array( 'layout', 'in', array( 'balloon', 'framed', 'modern' ) ),
			),
			'text_color' => array(
				'title' => __( 'Text Color', 'codelights-shortcodes-and-widgets' ),
				'type' => 'color',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
				'show_if' => array( 'layout', 'in', array( 'balloon', 'framed', 'modern' ) ),
			),
			'quote_size' => array(
				'title' => __( 'Quote Text Size', 'codelights-shortcodes-and-widgets' ),
				'description' => '',
				'type' => 'textfield',
				'std' => '18px',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'author_size' => array(
				'title' => __( 'Author Text Size', 'codelights-shortcodes-and-widgets' ),
				'description' => '',
				'type' => 'textfield',
				'std' => '14px',
				'classes' => 'cl_col-sm-6 cl_column',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'italic' => array(
				'title' => '',
				'type' => 'checkboxes',
				'options' => array(
					TRUE => __( 'Make Quote Text italic', 'codelights-shortcodes-and-widgets' ),
				),
				'std' => TRUE,
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
			'el_class' => array(
				'title' => __( 'Extra class name', 'codelights-shortcodes-and-widgets' ),
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
				'group' => __( 'Style', 'codelights-shortcodes-and-widgets' ),
			),
		),
	),
);
