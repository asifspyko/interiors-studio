<?php

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if( !class_exists('acf_field_header_tag') ) :


class acf_field_header_tag extends acf_field {
	
	
	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function __construct( $settings ) {
		
		/*
		*  name (string) Single word, no spaces. Underscores allowed
		*/
		
		$this->name = 'header_tag';
		
		
		/*
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/
		
		$this->label = __('Header HTML Tag', 'acf-header_tag');
		
		
		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/
		
		$this->category = 'choice';
		
		
		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/
		
		$this->defaults = array(
			'initial_value'	=> 'p',
			'default_value'	=> 'h1',
		);
		
		
		/*
		*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
		*  var message = acf._e('header_tag', 'error');
		*/
		
		$this->l10n = array(
			'error'	=> __('Error! Please enter a higher value', 'acf-header_tag'),
		);
		
		
		/*
		*  settings (array) Store plugin settings (url, path, version) as a reference for later use with assets
		*/
		
		$this->settings = $settings;
		
		
		// do not delete!
    	parent::__construct();
    	
	}
	
	
	/*
	*  render_field_settings()
	*
	*  Create extra settings for your field. These are visible when editing a field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field_settings( $field ) {

		// default_value
		acf_render_field_setting( $field, array(
			'label'			=> __('Default Value','acf'),
			'instructions'	=> __('Default tag for this field instance','acf'),
			'type'			=> 'select',
			'name'			=> 'default_value',
			'choices'   => array(
				'p'	=> 'P',
				'h1'	=> 'H1',
				'h2'	=> 'H2',
				'h3'	=> 'H3',
				'h4'	=> 'H4',
				'h5'	=> 'H5',
				'h6'	=> 'H6',
				'div'	=> 'DIV'
			)
		));
		
		/*
		*  acf_render_field_setting
		*
		*  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
		*  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
		*
		*  More than one setting can be added by copy/paste the above code.
		*  Please note that you must also have a matching $defaults value for the field name (font_size)
		*/

	}
	
	
	
	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field (array) the $field being rendered
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field( $field ) {
		
		
		/*
		*  Review the data of $field.
		*  This will show what data is available
		*/
		
		//echo '<pre>';
		//	print_r( $field );
		//echo '</pre>';
		
		
		/*
		*  Create a simple text input using the 'font_size' setting.
		*/
		
		?>

		<select name='<?php echo esc_attr($field['name']) ?>'>
			<?php
				foreach( $this->get_tags() as $tag_key => $tag ) :
			?>
				
				<option <?php selected( $field['value'], $tag ) ?> value='<?php echo $tag ?>'><?php echo $tag_key ?></option>
			<?php endforeach; ?>
		</select>
		<?php
	}

	function get_tags() {
		$tags = array(
			'P'	=> 'p',
			'H1'	=> 'h1',
			'H2'	=> 'h2',
			'H3'	=> 'h3',
			'H4'	=> 'h4',
			'H5'	=> 'h5',
			'H6'	=> 'h6',
			'DIV' => 'div'
		);
		return $tags;
	}	
	
}

// initialize
new acf_field_header_tag( $this->settings );


// class_exists check
endif;

?>