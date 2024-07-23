<?php

if ( ! function_exists( 'starter_theme_register_nav_menu' ) ) {
  function starter_theme_register_nav_menu(){
    register_nav_menus( array(
      'primary' => esc_html__( 'Primary', 'project_name' ),
      'mobile' => esc_html__( 'Mobile', 'primaservice' ),
    ));
  }
  add_action( 'after_setup_theme', 'starter_theme_register_nav_menu', 0 );
}
