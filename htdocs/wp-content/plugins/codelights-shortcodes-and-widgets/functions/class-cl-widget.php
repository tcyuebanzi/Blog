<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

class CL_Widget extends WP_Widget {

	/**
	 * @param string $id_base
	 */
	public function __construct( $id_base ) {

		// Widget's ID is defined by it's class name
		$this->config = cl_config( 'elements.' . $id_base );

		if ( ! is_array( $this->config ) OR ! isset( $this->config['params'] ) OR ! is_array( $this->config['params'] ) ) {
			if ( WP_DEBUG ) {
				wp_die( 'Config for widget ' . $id_base . ' is not found' );
			}

			return;
		}

		// Adding Widget Title param to the beginning
		$this->config['params'] = array_merge( array(
			'_widget_title' => array(
				'title' => __( 'Widget Title', 'codelights-shortcodes-and-widgets' ),
				'type' => 'textfield',
			),
		), $this->config['params'] );

		$name = $this->config['title'];
		if ( isset( $this->config['category'] ) AND ! empty( $this->config['category'] ) ) {
			$name = '(' . $this->config['category'] . ') ' . $name;
		}

		parent::__construct( $id_base, $name, array(
			'classname' => 'widget-' . $id_base,
			'description' => $this->config['description'],
		), array(
			'width' => 500,
		) );
	}

	/**
	 * Output the settings update form.
	 *
	 * @param array $instance Current settings.
	 *
	 * @return string Form's output marker that could be used for further hooks
	 */
	public function form( $instance ) {

		cl_load_template( 'eform/eform', array(
			'name' => $this->id_base,
			'params' => $this->config['params'],
			'values' => $instance,
			'field_name_fn' => array( $this, 'get_field_name' ),
			'field_id_fn' => array( $this, 'get_field_id' ),
		) );

		return 'clform';
	}

	/**
	 * Echo the widget content.
	 *
	 * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( isset( $instance['_widget_title'] ) AND ! empty( $instance['_widget_title'] ) ) {
			echo $args['before_title'] . $instance['_widget_title'] . $args['after_title'];
		}
		$instance = cl_shortcode_atts( $instance, $this->id_base );
		cl_load_template( 'elements/' . $this->id_base, $instance );
		echo $args['after_widget'];
	}

}

// Initializing widgets
add_action( 'widgets_init', 'cl_widgets_init' );
function cl_widgets_init() {
	global $wp_widget_factory;
	$config = cl_config( 'elements', array() );
	foreach ( $config as $name => $elm ) {
		if ( ! isset( $elm['widget_php_class'] ) OR empty( $elm['widget_php_class'] ) ) {
			$elm['widget_php_class'] = 'CL_Widget_' . ucfirst( preg_replace( '~^cl\-~', '', $name ) );
		}
		if ( ! class_exists( $elm['widget_php_class'] ) ) {
			// Creating virtual empty class
			$wp_widget_factory->widgets[ $elm['widget_php_class'] ] = new CL_Widget( $name );
		} else {
			$wp_widget_factory->register( $elm['widget_php_class'] );
		}
	}
}

