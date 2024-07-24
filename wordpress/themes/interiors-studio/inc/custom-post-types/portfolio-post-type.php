<?php

function portfolio_post_type()
{
  $labels = array(
    'name' => __('Portfolio', 'interiors-studio'),
    'name_admin_bar' => __('Portfolio', 'interiors-studio'),
    'menu_name' => __('Portfolio', 'interiors-studio'),
    'singular_name' => __('Portfolio', 'interiors-studio'),
    'add_new' => __('Add New', 'Portfolio', 'interiors-studio'),
    'add_new_item' => __('Add New Portfolio', 'interiors-studio'),
    'new_item' => __('New', 'Portfolio', 'interiors-studio'),
    'edit_item' => __('Edit Portfolio', 'interiors-studio'),
    'view_items' => __('View Portfolio', 'interiors-studio'),
    'view_item' => __('View Portfolio', 'interiors-studio'),
    'search_items' => __('Search Portfolio', 'interiors-studio'),
    'all_items' => __('All Portfolio', 'interiors-studio'),
    'not_found' => __('No Portfolio found', 'interiors-studio'),
    'not_found_in_trash' => __('No Portfolio found in trash', 'interiors-studio'),
  );

  $ags = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => true,
    'has_archive' => true,
    'rewrite' => [
      'slug' => 'portfolio',
      'with_front' => true,
    ],
    'menu_position' => null,
    'exclude_from_search' => false,
    'show_in_rest' => false,
    'supports' => array('title', 'thumbnail', 'custom-fields', 'excerpt'),
  );

  register_post_type('portfolio', $ags);

}
add_action('init', 'portfolio_post_type', 0);