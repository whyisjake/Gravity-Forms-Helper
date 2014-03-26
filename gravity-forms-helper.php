<?php
/*
 Plugin Name: Gravity Forms Helper
 Plugin URI: http://github.com/whyisjake/
 Description: Allows for easy access to Gravity Forms data using a shortcode.
 Author: whyisjake
 Version: 0.5
 Author URI: http://jakespurlock.com/
 */

/**
 * Gravity Forms!
 *
 * A class that will allow easy access to Gravity Forms data.
 *
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
		extract( shortcode_atts( array(
			'form'	=> 1,
			'field'	=> 1,
		), $atts ) );
		$lead = RGFormsModel::get_lead( $form );
		return $lead[ $field ];
	}

}

$form_helper = new Gravity_Forms_Helper();