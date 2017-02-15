<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Needed assets, used by us_enqueue_assets function.
 *
 * Dev note: the same keys for styles and scripts should stand for the same element, as they are loaded together.
 */

global $cl_uri, $cl_version;

return array(

	/**
	 * Each style entry contains params for wp_enqueue_style function:
	 * $handle => array( $src, $deps, $ver, $media )
	 */
	'styles' => array(
		'font-awesome' => array( $cl_uri . '/vendor/font-awesome/font-awesome.min.css', array(), '4.5.0', 'all' ),
		'cl-core' => array( $cl_uri . '/css/cl-core.css', array(), $cl_version, 'all' ),
		'cl-counter' => array( $cl_uri . '/css/cl-counter.css', array( 'cl-core' ), $cl_version, 'all' ),
		'cl-flipbox' => array( $cl_uri . '/css/cl-flipbox.css', array( 'cl-core' ), $cl_version, 'all' ),
		'cl-ib' => array( $cl_uri . '/css/cl-ib.css', array( 'cl-core' ), $cl_version, 'all' ),
		'cl-itext' => array( $cl_uri . '/css/cl-itext.css', array( 'cl-core' ), $cl_version, 'all' ),
		'cl-popup' => array( $cl_uri . '/css/cl-popup.css', array( 'cl-core' ), $cl_version, 'all' ),
		'cl-review' => array( $cl_uri . '/css/cl-review.css', array(), $cl_version, 'all' ),
	),
	/**
	 * Each script entry contains params for wp_enqueue_script function:
	 * $handle => array( $src, $deps, $ver, $in_footer )
	 */
	'scripts' => array(
		'cl-core' => array( $cl_uri . '/js/cl-core.js', array( 'jquery' ), $cl_version, TRUE ),
		'cl-counter' => array( $cl_uri . '/js/cl-counter.js', array( 'cl-core' ), $cl_version, TRUE ),
		'cl-flipbox' => array( $cl_uri . '/js/cl-flipbox.js', array( 'cl-core' ), $cl_version, TRUE ),
		'cl-ib' => array( $cl_uri . '/js/cl-ib.js', array( 'cl-core' ), $cl_version, TRUE ),
		'cl-itext' => array( $cl_uri . '/js/cl-itext.js', array( 'cl-core' ), $cl_version, TRUE ),
		'cl-popup' => array( $cl_uri . '/js/cl-popup.js', array( 'cl-core' ), $cl_version, TRUE ),
	),

);
