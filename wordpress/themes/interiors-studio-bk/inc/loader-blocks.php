<?php

// Add Custom Blocks Panel in Gutenberg
function custom_block_categories( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'project',
                'title' => __( 'interiors-studio', 'css-gutenberg-blocks' ),
            ),
        )
    );
}
add_filter( 'block_categories_all', 'custom_block_categories', 10, 2 );


function register_acf_block_types() {
    
  // Block Loop
  $blocks = [
    [
      'name'               => 'hero',
      'title'              => 'Hero',
      'category'           => ['custom-theme', 'interiors-studio', 'acf-theme' ],
      'block_preview_img'  => 'block.jpg'
    ],
    [
      'name'               => 'content-with-bg',
      'title'              => 'Content With Background',
      'category'           => ['custom-theme', 'interiors-studio', 'acf-theme' ],
      'block_preview_img'  => 'block.jpg'
    ],
    [
      'name'               => 'about-content',
      'title'              => 'About Content',
      'category'           => ['custom-theme', 'interiors-studio', 'acf-theme' ],
      'block_preview_img'  => 'block.jpg'
    ],
    [
      'name'               => 'content-with-image',
      'title'              => 'Content With Image',
      'category'           => ['custom-theme', 'interiors-studio', 'acf-theme' ],
      'block_preview_img'  => 'block.jpg'
    ],
    [
      'name'               => 'services',
      'title'              => 'Services',
      'category'           => ['custom-theme', 'interiors-studio', 'acf-theme' ],
      'block_preview_img'  => 'block.jpg'
    ],
    [
      'name'               => 'contact-us',
      'title'              => 'Contact Us',
      'category'           => ['custom-theme', 'interiors-studio', 'acf-theme' ],
      'block_preview_img'  => 'block.jpg'
    ],
    [
      'name'               => 'portfolio',
      'title'              => 'Portfolio',
      'category'           => ['custom-theme', 'interiors-studio', 'acf-theme' ],
      'block_preview_img'  => 'block.jpg'
    ],
    [
        'name'               => 'generic-content',
        'title'              => 'Generic Content',
        'category'           => ['custom-theme', 'interiors-studio', 'acf-theme' ],
        'block_preview_img'  => 'block.jpg'
      ],
    
  ];


  foreach ($blocks as $block ) {
    acf_register_block_type(array(
      'name'              => $block['name'],
      'title'             => sprintf(__('Interiors Studio %s', 'Interiors Studio '), $block['title']),
      'description'       => sprintf(__('Interiors Studio  %s block', 'Interiors Studio '), $block['title']),
      'render_template'   => "template-parts/blocks/{$block['name']}/block-{$block['name']}.php",
      'category'          => 'project',
      'icon'              => '',
      'align'             => 'full',
      'mode'              => 'preview',
      'supports'          => array(
          'align' => array('full'),
          'mode'  => false,
          'anchor' => true,
          'jsx' => true
      ),
      'enqueue_assets' 	=> function(){
        wp_enqueue_style('admin-acf-blocks', get_template_directory_uri() . '/assets/css/admin-acf-blocks.css', array(), filemtime(get_template_directory() . '/assets/css/admin-acf-blocks.css'));
      }
    ));
  }
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}

add_action('acf/validate_save_post', 'ct_validate_save_post', 5);
function ct_validate_save_post() {
  // bail early if no $_POST
  foreach ($_POST as $key => $value) {
    if (strpos($key, 'acf') === 0) {
      if (!empty($_POST[$key])) {
        acf_validate_values($_POST[$key], $key);
      }
    }
  }
}