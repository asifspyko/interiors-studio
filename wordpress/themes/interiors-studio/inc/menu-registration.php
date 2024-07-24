<?php

if ( ! function_exists( 'interiors_studio_register_nav_menu' ) ) {
  function interiors_studio_register_nav_menu(){
    register_nav_menus( array(
      'primary' => esc_html__( 'Primary', 'interiors-studio' ),
      'mobile' => esc_html__( 'Mobile', 'primaservice' ),
    ));
  }
  add_action( 'after_setup_theme', 'interiors_studio_register_nav_menu', 0 );
}
