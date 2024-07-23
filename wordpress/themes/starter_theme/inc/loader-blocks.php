<?php

// Add Custom Blocks Panel in Gutenberg
function custom_block_categories( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'project',
                'title' => __( 'PROJECT_NAME', 'css-gutenberg-blocks' ),
            ),
        )
    );
}
add_filter( 'block_categories_all', 'custom_block_categories', 10, 2 );

function register_acf_block_types() {
    // register a testimonial block.
    // use "-" instead of "_" in the "name" to avoid ACF bug breaking JS addAction() function
    acf_register_block_type(array(
      'name'              => 'example',
      'title'             => __('Example'),
      'description'       => __('Example block'),
      'render_template'   => 'template-parts/blocks/example.php',
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
      'example'  => array(
        'attributes' => array(
          'mode' => 'preview',
          'data' => array(
            'block_preview_img'   => 'example.jpg'
          )
        )
      ),
      'enqueue_assets' 	=> function(){
        wp_enqueue_script( 'example', get_template_directory_uri() . '/assets/js/blocks/example.js', array('jquery'), filemtime(get_template_directory() . '/assets/js/blocks/example.js'), true );
        wp_enqueue_style( 'example', get_template_directory_uri() . '/assets/css/blocks/example.css', array(), filemtime(get_template_directory() . '/assets/css/blocks/example.css'));
      }
    ));
    acf_register_block_type(array(
      'name'              => 'container',
      'title'             => __('Container'),
      'description'       => __('Container block'),
      'render_template'   => 'template-parts/blocks/container.php',
      'category'          => 'project',
      'icon'              => '',
      'align'             => 'full',
      'mode'              => 'preview',
      'supports'          => array(
          'align' => array('full'),
          'mode'  => false,
          'anchor' => true,
          'jsx' => true
      )
    ));
    acf_register_block_type(array(
      'name'              => 'image-slider',
      'title'             => __('Image Slider'),
      'description'       => __('Image Slider block'),
      'render_template'   => 'template-parts/blocks/image-slider.php',
      'category'          => 'project',
      'icon'              => '',
      'align'             => '',
      'mode'              => 'preview',
      'supports'          => array(
          'align' => array('wide'),
          'mode'  => false,
          'anchor' => true,
          'jsx' => true
      ),
      'example'  => array(
        'attributes' => array(
          'mode' => 'preview',
          'data' => array(
            'block_preview_img'   => 'image-slider.jpg'
          )
        )
      ),
      'enqueue_assets' 	=> function(){
        wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/vendor/swiper.js', array('jquery'), filemtime(get_template_directory() . '/assets/js/vendor/swiper.js'), true );
        wp_enqueue_script( 'image-slider', get_template_directory_uri() . '/assets/js/blocks/image-slider.js', array('jquery'), filemtime(get_template_directory() . '/assets/js/blocks/image-slider.js'), true );
        wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/vendor/swiper.css', array(), filemtime(get_template_directory() . '/assets/css/vendor/swiper.css'));
      }
    ));
    acf_register_block_type(array(
      'name'              => 'accordion',
      'title'             => __('Accordion'),
      'description'       => __('Accordion block'),
      'render_template'   => 'template-parts/blocks/accordion.php',
      'category'          => 'project',
      'icon'              => '',
      'align'             => '',
      'mode'              => 'preview',
      'supports'          => array(
          'align' => array('full', 'wide'),
          'mode'  => false,
          'anchor' => true,
          'jsx' => true
      ),
      'example'  => array(
        'attributes' => array(
          'mode' => 'preview',
          'data' => array(
            'block_preview_img'   => 'accordion.jpg'
          )
        )
      ),
      'enqueue_assets' 	=> function(){
        wp_enqueue_script( 'accordion-block', get_template_directory_uri() . '/assets/js/blocks/accordion.js', array('jquery'), filemtime(get_template_directory() . '/assets/js/blocks/accordion.js'), true );
        wp_enqueue_style( 'accordion', get_template_directory_uri() . '/assets/css/blocks/accordion.css', array(), filemtime(get_template_directory() . '/assets/css/blocks/accordion.css'));
      }
    ));
    acf_register_block_type(array(
      'name'              => 'faq-accordion',
      'title'             => __('FAQ Accordion'),
      'description'       => __('FAQ Accordion block'),
      'render_template'   => 'template-parts/blocks/faq-accordion.php',
      'category'          => 'project',
      'icon'              => '',
      'align'             => '',
      'mode'              => 'preview',
      'supports'          => array(
          'align' => array('full', 'wide'),
          'mode'  => false,
          'anchor' => true,
          'jsx' => true
      ),
      'example'  => array(
        'attributes' => array(
          'mode' => 'preview',
          'data' => array(
            'block_preview_img'   => 'faq-accordion.jpg'
          )
        )
      ),
      'enqueue_assets' 	=> function(){
        wp_enqueue_script( 'faq-accordion-block', get_template_directory_uri() . '/assets/js/blocks/faq-accordion.js', array('jquery'), filemtime(get_template_directory() . '/assets/js/blocks/faq-accordion.js'), true );
        wp_enqueue_style( 'faq-accordion', get_template_directory_uri() . '/assets/css/blocks/faq-accordion.css', array(), filemtime(get_template_directory() . '/assets/css/blocks/faq-accordion.css'));
      }
    ));
    acf_register_block_type(array(
      'name'              => 'faq-masonry',
      'title'             => __('FAQ Masonry Grid'),
      'description'       => __('FAQ Masonry Grid block'),
      'render_template'   => 'template-parts/blocks/faq-masonry.php',
      'category'          => 'project',
      'icon'              => '',
      'align'             => '',
      'mode'              => 'preview',
      'supports'          => array(
          'align' => array('full', 'wide'),
          'mode'  => false,
          'anchor' => true,
          'jsx' => true
      ),
      'example'  => array(
        'attributes' => array(
          'mode' => 'preview',
          'data' => array(
            'block_preview_img'   => 'faq-masonry.jpg'
          )
        )
      ),
      'enqueue_assets' 	=> function(){
        wp_enqueue_script('masonry-layout', get_template_directory_uri() . '/assets/js/vendor/masonry-layout.js', array('jquery'), filemtime(get_template_directory() . '/assets/js/vendor/masonry-layout.js'), true);
        wp_enqueue_script( 'faq-masonry-block', get_template_directory_uri() . '/assets/js/blocks/faq-masonry.js', array('jquery'), filemtime(get_template_directory() . '/assets/js/blocks/faq-masonry.js'), true );
      }
    ));
    acf_register_block_type(array(
      'name'              => 'header',
      'title'             => __('Header'),
      'description'       => __('Header block'),
      'render_template'   => 'template-parts/blocks/header.php',
      'category'          => 'project',
      'icon'              => '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g class="nc-icon-wrapper"><path d="M5 8v6h10v24h6V14h10V8H5zm38 10H25v6h6v14h6V24h6v-6z"/></g></svg>',
      'align'             => '',
      'supports'          => array(
          'align' => array('wide'),
          'mode'  => false,
          'anchor' => true
      )
    ));
    acf_register_block_type(array(
      'name'              => 'text',
      'title'             => __('Text'),
      'description'       => __('Text block'),
      'render_template'   => 'template-parts/blocks/text.php',
      'category'          => 'project',
      'icon'              => '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g class="nc-icon-wrapper"><path d="M8 18h32v4H8zm0 8h20v4H8z"/></g></svg>',
      'align'             => '',
      'supports'          => array(
          'align' => array('wide', 'left', 'center', 'right'),
          'mode'  => false,
          'anchor' => true
      )
    ));
    acf_register_block_type(array(
      'name'              => 'button',
      'title'             => __('Button'),
      'description'       => __('Button block'),
      'render_template'   => 'template-parts/blocks/button.php',
      'category'          => 'project',
      'icon'              => '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g class="nc-icon-wrapper" fill="#111111"><path data-color="color-2" d="M24,18.343c-0.753,0.753-1.134,1.735-1.16,2.725c0.943,0.271,1.832,0.776,2.574,1.518 c2.34,2.34,2.34,6.146,0,8.485l-6.364,6.364c-2.34,2.34-6.146,2.34-8.485,0c-2.34-2.34-2.34-6.146,0-8.485l4.684-4.684 c-0.462-1.742-0.536-3.565-0.203-5.331c-0.326,0.254-0.645,0.522-0.945,0.822l-6.364,6.364c-3.899,3.899-3.899,10.243,0,14.142 s10.243,3.899,14.142,0l6.364-6.364c3.899-3.899,3.899-10.243,0-14.142c-1.006-1.006-2.176-1.747-3.423-2.234L24,18.343z"/> <path fill="#111111" d="M26.121,7.737l-6.364,6.364c-3.899,3.899-3.899,10.243,0,14.142c1.006,1.006,2.176,1.747,3.423,2.234 l0.82-0.82c0.755-0.755,1.128-1.738,1.148-2.728c-0.938-0.272-1.823-0.776-2.562-1.515c-2.34-2.34-2.34-6.146,0-8.485l6.364-6.364 c2.34-2.34,6.146-2.34,8.485,0c2.34,2.34,2.34,6.146,0,8.485l-4.689,4.689c0.464,1.744,0.528,3.568,0.195,5.336 c0.331-0.256,0.654-0.528,0.958-0.832l6.364-6.364c3.899-3.899,3.899-10.243,0-14.142S30.02,3.837,26.121,7.737z"/></g></svg>',
      'align'             => '',
      'supports'          => array(
          'align' => array('wide'),
          'mode'  => false,
          'anchor' => true
      )
    ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}
