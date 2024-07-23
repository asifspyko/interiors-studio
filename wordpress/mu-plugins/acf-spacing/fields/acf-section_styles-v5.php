<?php

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// check if class already exists
if ( !class_exists('acf_field_section_styles') ) :

  class acf_field_section_styles extends acf_field {

    /*
    *  __construct
    *
    *  This function will setup the field type data
    *
    *  @type  function
    *  @date  5/03/2014
    *  @since  5.0.0
    *
    *  @param  n/a
    *  @return  n/a
    */

    function __construct( $settings ) {

      $this->name = 'section_styles';
      $this->label = __( 'Spacing', 'acf-section_styles' );
      $this->category = apply_filters( 'acf_section_styles_category', 'Layout' );

      $this->l10n = array(
        'file_select_title'  => __( 'Select background image', 'acf-section_styles' ),
        'file_select_text'  => __( 'Select image', 'acf-section_styles' ),
      );

      $this->defaults = array(
        'margin_top'      => '',
        'margin_right'    => '',
        'margin_bottom'   => '',
        'margin_left'     => '',
        'padding_top'     => '',
        'padding_right'   => '',
        'padding_bottom'  => '',
        'padding_left'    => '',
      );

      $this->settings = $settings;

      // do not delete!
      parent::__construct();

    }


    /*
    *  render_field_settings()
    *
    *  Create extra settings for your field. These are visible when editing a field
    *
    *  @type  action
    *  @since  3.6
    *  @date  23/01/13
    *
    *  @param  $field (array) the $field being edited
    *  @return  n/a
    */

    function render_field_settings( $field ) {

      // Default margins
      acf_render_field_wrap(array(
        'label'          => __( 'Default Margins', 'acf-section_styles' ),
        'type'          => 'text',
        'name'          => 'margin_top',
        'prefix'        => $field['prefix'],
        'value'          => $field['margin_top'],
        'prepend'        => __( 'top', 'acf-section_styles' ),
        'wrapper'        => array(
          'data-name' => 'margin-wrapper'
        )
      ), 'tr');

      acf_render_field_wrap(array(
        'type'          => 'text',
        'name'          => 'margin_right',
        'prefix'        => $field['prefix'],
        'value'          => $field['margin_right'],
        'prepend'        => __( 'right', 'acf'),
        'wrapper'        => array(
          'data-append' => 'margin-wrapper'
        )
      ), 'tr');

      acf_render_field_wrap(array(
        'type'          => 'text',
        'name'          => 'margin_bottom',
        'prefix'        => $field['prefix'],
        'value'          => $field['margin_bottom'],
        'prepend'        => __( 'bottom', 'acf' ),
        'wrapper'        => array(
          'data-append' => 'margin-wrapper'
        )
      ), 'tr');

      acf_render_field_wrap(array(
        'type'          => 'text',
        'name'          => 'margin_left',
        'prefix'        => $field['prefix'],
        'value'          => $field['margin_left'],
        'prepend'        => __( 'left', 'acf' ),
        'wrapper'        => array(
          'data-append' => 'margin-wrapper'
        )
      ), 'tr');

      // Default padding
      acf_render_field_wrap(array(
        'label'          => __( 'Default Padding', 'acf-section_styles' ),
        'type'          => 'text',
        'name'          => 'padding_top',
        'prefix'        => $field['prefix'],
        'value'          => $field['padding_top'],
        'prepend'        => __( 'top', 'acf-section_styles' ),
        'wrapper'        => array(
          'data-name' => 'padding-wrapper'
        )
      ), 'tr');

      acf_render_field_wrap(array(
        'type'          => 'text',
        'name'          => 'padding_right',
        'prefix'        => $field['prefix'],
        'value'          => $field['padding_right'],
        'prepend'        => __( 'right', 'acf'),
        'wrapper'        => array(
          'data-append' => 'padding-wrapper'
        )
      ), 'tr');

      acf_render_field_wrap(array(
        'type'          => 'text',
        'name'          => 'padding_bottom',
        'prefix'        => $field['prefix'],
        'value'          => $field['padding_bottom'],
        'prepend'        => __( 'bottom', 'acf' ),
        'wrapper'        => array(
          'data-append' => 'padding-wrapper'
        )
      ), 'tr');

      acf_render_field_wrap(array(
        'type'          => 'text',
        'name'          => 'padding_left',
        'prefix'        => $field['prefix'],
        'value'          => $field['padding_left'],
        'prepend'        => __( 'left', 'acf' ),
        'wrapper'        => array(
          'data-append' => 'padding-wrapper'
        )
      ), 'tr');

    }

    /*
    *  render_field()
    *
    *  Create the HTML interface for your field
    *
    *  @param  $field (array) the $field being rendered
    *
    *  @type  action
    *  @since  3.6
    *  @date  23/01/13
    *
    *  @param  $field (array) the $field being edited
    *  @return  n/a
    */

    function render_field( $field ) {

      // if values are empty fetch defaults
      if ( empty( $field['value'] ) ) {
        $field['value']['margin_top'] = $field['margin_top'];
        $field['value']['margin_right'] = $field['margin_right'];
        $field['value']['margin_bottom'] = $field['margin_bottom'];
        $field['value']['margin_left'] = $field['margin_left'];
        $field['value']['padding_top'] = $field['padding_top'];
        $field['value']['padding_right'] = $field['padding_right'];
        $field['value']['padding_bottom'] = $field['padding_bottom'];
        $field['value']['padding_left'] = $field['padding_left'];
        }
      ?>

      <div class="acf-section-styles-container" tabindex="-1">

        <!-- Box Model -->
        <div class="acf-section-styles-box-model">
          <div class="acf-section-styles-margin acf-section-style-param">
            <!-- Margin -->
            <div class="acf-label">
              <label for="<?php echo $field['id']; ?>_margin"><?php _e( 'margin', 'acf-section_styles' ); ?></label>
            </div>

            <input id="<?php echo $field['id']; ?>_margin" class="top" placeholder="&ndash;" name="<?php echo esc_attr($field['name']) ?>[margin_top]" value="<?php if ( strlen( $field['value']['margin_top']) != 0 ) echo $field['value']['margin_top']; ?>" />
            <input class="right" placeholder="&ndash;" name="<?php echo esc_attr($field['name']) ?>[margin_right]" value="<?php if ( strlen( $field['value']['margin_right']) != 0 ) echo $field['value']['margin_right']; ?>" />
            <input class="bottom" placeholder="&ndash;" name="<?php echo esc_attr($field['name']) ?>[margin_bottom]" value="<?php if ( strlen( $field['value']['margin_bottom']) != 0 ) echo $field['value']['margin_bottom']; ?>" />
            <input class="left" placeholder="&ndash;" name="<?php echo esc_attr($field['name']) ?>[margin_left]" value="<?php if ( strlen( $field['value']['margin_left']) != 0 ) echo $field['value']['margin_left']; ?>" />
            <!-- End Margin -->

              <div id="<?php echo $field['id']; ?>_padding_container" class="acf-section-styles-padding acf-section-style-param"<?php if ( !empty( $field['value']['background_color'] ) ) echo ' style="background-color: ' . $field['value']['background_color'] . '"'; ?>>
                <!-- Padding -->
                  <div class="acf-label">
                    <label for="<?php echo $field['id']; ?>_padding"><?php _e( 'padding', 'acf-section_styles' ); ?></label>
                  </div>

                  <input id="<?php echo $field['id']; ?>_padding" class="top" placeholder="&ndash;" name="<?php echo esc_attr($field['name']) ?>[padding_top]" value="<?php if ( strlen( $field['value']['padding_top']) != 0 ) echo $field['value']['padding_top']; ?>" />
                  <input class="right" placeholder="&ndash;" name="<?php echo esc_attr($field['name']) ?>[padding_right]" value="<?php if ( strlen( $field['value']['padding_right']) != 0 ) echo $field['value']['padding_right']; ?>" />
                  <input class="bottom" placeholder="&ndash;" name="<?php echo esc_attr($field['name']) ?>[padding_bottom]" value="<?php if ( strlen( $field['value']['padding_bottom']) != 0 ) echo $field['value']['padding_bottom']; ?>" />
                  <input class="left" placeholder="&ndash;" name="<?php echo esc_attr($field['name']) ?>[padding_left]" value="<?php if ( strlen( $field['value']['padding_left']) != 0 ) echo $field['value']['padding_left']; ?>" />
                  <!-- End Padding -->

              </div> <!-- End .acf-section-styles-padding -->

          </div> <!-- End .acf-section-styles-margin -->

        </div>
        <!-- End Box Model -->

      </div> <!-- End .acf-section-styles-container -->
    <?php
    }


    /*
    *  input_admin_enqueue_scripts()
    *
    *  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
    *  Use this action to add CSS + JavaScript to assist your render_field() action.
    *
    *  @type  action (admin_enqueue_scripts)
    *  @since  3.6
    *  @date  23/01/13
    *
    *  @param  n/a
    *  @return  n/a
    */

    function input_admin_enqueue_scripts() {

      // vars
      $url = $this->settings['url'];
      $version = $this->settings['version'];

      // register & include JS
      wp_register_script( 'acf-input-section_styles', "{$url}assets/js/input.js", array('acf-input'), $version );
      wp_enqueue_script('acf-input-section_styles');

      // register & include CSS
      wp_register_style( 'acf-input-section_styles', "{$url}assets/css/input.css", array('acf-input'), $version );
      wp_enqueue_style('acf-input-section_styles');

    }

    /*
    *  format_value()
    *
    *  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
    *
    *  @type  filter
    *  @since  3.6
    *  @date  23/01/13
    *
    *  @param  $value (mixed) the value which was loaded from the database
    *  @param  $post_id (mixed) the $post_id from which the value was loaded
    *  @param  $field (array) the field array holding all the field options
    *
    *  @return  $value (mixed) the modified value
    */

    function format_value( $value, $post_id, $field ) {

      // bail early if no value
      if ( empty( $value ) ) return $value;

      // format margin value
      $value['margin'] = !empty( $value['margin_top'] ) ? $value['margin_top'] : '0';
      $value['margin'] .= ' ';  // space
      $value['margin'] .= !empty( $value['margin_right'] ) ? $value['margin_right'] : '0';
      $value['margin'] .= ' ';  // space
      $value['margin'] .= !empty( $value['margin_bottom'] ) ? $value['margin_bottom'] : '0';
      $value['margin'] .= ' ';  // space
      $value['margin'] .= !empty( $value['margin_left'] ) ? $value['margin_left'] : '0';

      // format padding value
      $value['padding'] = !empty( $value['padding_top'] ) ? $value['padding_top'] : '0';
      $value['padding'] .= ' ';  // space
      $value['padding'] .= !empty( $value['padding_right'] ) ? $value['padding_right'] : '0';
      $value['padding'] .= ' ';  // space
      $value['padding'] .= !empty( $value['padding_bottom'] ) ? $value['padding_bottom'] : '0';
      $value['padding'] .= ' ';  // space
      $value['padding'] .= !empty( $value['padding_left'] ) ? $value['padding_left'] : '0';

      return $value;
    }

    /*
    *  update_value()
    *
    *  This filter is applied to the $field before it is saved to the database
    *
    *  @type  filter
    *  @date  23/01/2013
    *  @since  3.6.0
    *
    *  @param  $field (array) the field array holding all the field options
    *  @return  $field
    */

    // function update_value( $value, $post_id, $field  ) {
    //
    //   $default_unit = apply_filters( 'acf_section_styles_default_unit', 'px' );
    //
    //   // if fields do not have a unit attached apply default unit
    //   $auto_append_unit_items = apply_filters( 'acf_section_styles_append_units', array(
    //     'margin_top',
    //     'margin_right',
    //     'margin_bottom',
    //     'margin_left',
    //     'padding_top',
    //     'padding_right',
    //     'padding_bottom',
    //     'padding_left'
    //   ) );
    //
    //   foreach ( $auto_append_unit_items as $i ) {
    //     if ( ctype_digit( $value[$i] ) ) {
    //       $value[$i] .= $default_unit;
    //     }
    //   }
    //
    //   return $value;
    //
    // }

  }

  // initialize
  new acf_field_section_styles( $this->settings );

// class_exists check
endif;
