<?php
/*
 Plugin Name: Gravity Forms Helper
 Plugin URI: https://github.com/whyisjake/Gravity-Forms-Helper
 Description: Allows for easy access to Gravity Forms data using a shortcode.
 Author: whyisjake
 Version: 0.5
 Author URI: http://jakespurlock.com/
 */

/**
 * The guts.
 *
 * This little guy controls and loads all that is the Gravity Forms Helper.
 *
 */
class Gravity_Forms_Helper {

	/**
	 * THE CONSTRUCT.
	 *
	 * All Hooks and Filter here.
	 * Anything else that needs to run when the class is instantiated, place them here.
	 * Maybe you'll get a cake if you do.
	 *
	 * @return  void
	 */
	public function __construct() {
		add_shortcode( 'gravity_forms_entry', array( $this, 'get_form' ) );
	}

	public function get_form( $atts ) {

		// Let's merge all of the attributes
		extract( shortcode_atts( array(
			'form'				=> 1,
			'field'				=> 1,
			'sanitize_callback'	=> 'wp_kses_post'
		), $atts ) );

		// Get the full form
		$lead = RGFormsModel::get_lead( $form );

		// Based on the field, pull the value from the index.
		$output = $lead[ $field ];

		//Sanitize the function, we'll use wp_kses_post as it is pretty broad, but we can change the filter if desired.
		return $sanitize_callback( $output );
	}

}

$form_helper = new Gravity_Forms_Helper();