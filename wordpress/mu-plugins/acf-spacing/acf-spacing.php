<?php

/*
Plugin Name: Advanced Custom Fields: Spacing
Plugin URI: https://what.digital
Description: Adds a field to configure spacing.
Version: 1.0.0
Author: What.Digital
Author URI: https://what.digital
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if ( !class_exists('acf_plugin_section_styles') ) :

	class acf_plugin_section_styles {

		/*
		*  __construct
		*
		*  This function will setup the class functionality
		*
		*  @type	function
		*  @date	17/02/2016
		*  @since	1.0.0
		*
		*  @param	n/a
		*  @return	n/a
		*/

		function __construct() {

			// vars
			$this->settings = array(
				'version'	=> '1.0.0',
				'url'			=> WPMU_PLUGIN_URL . '/acf-spacing/',
				'path'		=> WPMU_PLUGIN_DIR . '/acf-spacing/'
			);


			// set text domain
			// https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
			load_plugin_textdomain( 'acf-section_styles', false, plugin_basename( dirname( __FILE__ ) ) . '/lang' );


			// include field
			add_action('acf/include_field_types', 	array($this, 'include_field_types')); // v5

		}

		/*
		*  include_field_types
		*
		*  This function will include the field type class
		*
		*  @type	function
		*  @date	17/02/2016
		*  @since	1.0.0
		*
		*  @param	$version (int) major ACF version. Defaults to false
		*  @return	n/a
		*/

		function include_field_types( $version = false ) {

			// include
			include_once('fields/acf-section_styles-v5.php');

		}

	}

	// initialize
	new acf_plugin_section_styles();

// class_exists check
endif;
