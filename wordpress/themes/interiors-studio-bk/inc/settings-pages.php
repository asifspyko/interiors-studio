<?php

// Options page for theme
add_action('acf/init', 'my_acf_op_init');

function my_acf_op_init() {
  if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
      'page_title'    => 'Site settings',
      'menu_title'    => 'Site settings',
      'menu_slug'     => 'theme-general-settings-parent',
      'capability'    => 'edit_posts',
      'redirect'      => true
    ));
    acf_add_options_page(array(
      'page_title'    => 'Main Settings',
      'menu_title'    => 'Main Settings',
      'menu_slug'     => 'theme-general-settings',
      'capability'    => 'edit_posts',
      'redirect'      => false,
      'parent_slug'   => 'theme-general-settings-parent'
    ));
    acf_add_options_page(array(
      'page_title'    => 'Rich Snippets',
      'menu_title'    => 'Rich Snippets',
      'menu_slug'     => 'theme-rich-snippets',
      'capability'    => 'edit_posts',
      'redirect'      => false,
      'icon_url'      => 'dashicons-code-standards',
      'parent_slug'   => 'theme-general-settings-parent'
    ));
  }
}
