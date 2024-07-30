<?php

// Turn on shortcodes for ACF textarea and text fields
function my_acf_format_value( $value, $post_id, $field ) {
    // run do_shortcode on all textarea values
    $value = do_shortcode($value);
    // return
    return $value;
}

add_filter('acf/format_value/type=textarea', 'my_acf_format_value', 10, 3);
add_filter('acf/format_value/type=text', 'my_acf_format_value', 10, 3);

// Load ACF image with support for lazy load (Lazy Loader plugin)
function acf_image($id, $size, $class) {
  if( $id ) {
    global $lazy_loader;
    if ( isset( $lazy_loader ) && $lazy_loader instanceof     FlorianBrinkmann\LazyLoadResponsiveImages\Plugin ) {
      echo $lazy_loader->filter_markup( wp_get_attachment_image( $id, $size, false, array( 'class' => $class )) );
    }
    else {
      echo wp_get_attachment_image( $id, $size, false, array( 'class' => $class ));
    }
  }
}

// Function for generating image from ID with various Lazy Loading options (support for Slick Carousel and Swiper included)
function image_from_id($id, $options = array() ) {
  $defaults = array(
    'size' => 'full',
    'lazyload' => 'lazysizes', // lazysizes / slick / swiper / none
    'class' => '',
    'preview' => false
  );

  $config = array_merge($defaults, $options);

  if( $id ) {
    if($config['preview']) {
      echo wp_get_attachment_image( $id, $config['size'], false, array( 'class' => $config['class'] ));
    }
    else {
      global $lazy_loader;
      // if Lazysizes plugin is installed in WP then apply it to the image
      if($config['lazyload'] == 'lazysizes') {
        if(isset( $lazy_loader ) && $lazy_loader instanceof FlorianBrinkmann\LazyLoadResponsiveImages\Plugin ) {
          echo $lazy_loader->filter_markup( wp_get_attachment_image( $id, $config['size'], false, array( 'class' => $config['class'] )) );
        }
        // Plugin is not isntalled. Load standard image
        else {
          echo wp_get_attachment_image( $id, $config['size'], false, array( 'class' => $config['class'] ));
        }
      }
      
      // Load standard image
      if($config['lazyload'] == 'none') {
        $classes = $config['class'] . ' skip-lazy';
        echo wp_get_attachment_image( $id, $config['size'], false, array( 'class' => $classes ));
      }
      
      // Load image prepared for lazyloading in the Slick carousel
      if($config['lazyload'] == 'slick') {
        $img_data = wp_get_attachment_image_src($id, $config['size']);
        $img_width = $img_data[1];
        $img_height = $img_data[2];
        $img_src = $img_data[0];
        $img_alt = get_post_meta($id, '_wp_attachment_image_alt', true);
        $classes = 'skip-lazy'; // to disable lazysizes plugin
        if(!empty($config['class'])) {
          $classes .= ' ' . $config['class'];
        }
        echo '<img data-lazy="' . $img_src . '" class="' . $classes . '"';
        if($img_width > 1) {
          echo ' width="' . $img_width . '"';
        }
        if($img_height > 1) {
          echo ' height="' . $img_height . '"';
        }
        if(!empty($img_alt)) {
          echo ' alt="' . $img_alt . '"';
        }
        echo '>';
      }

      // Load image prepared for lazyloading in the Swiper carousel
      if($config['lazyload'] == 'swiper') {
        $classes_swiper = 'skip-lazy swiper-lazy ' . $config['class'];
        $img_markup = wp_get_attachment_image( $id, $config['size'], false, array( 'class' => $classes_swiper ));
        $img_markup = str_replace('srcset=', 'data-srcset=', $img_markup);
        $img_markup = str_replace('src=', 'data-src=', $img_markup);
        echo $img_markup;
        echo '<div class="swiper-lazy-preloader"></div>';
      }
      if($config['lazyload'] == 'swiper-simple') {
        $img_data = wp_get_attachment_image_src($id, $config['size']);
        $img_width = $img_data[1];
        $img_height = $img_data[2];
        $img_src = $img_data[0];
        $img_alt = get_post_meta($id, '_wp_attachment_image_alt', true);
        $classes = 'skip-lazy swiper-lazy'; // skip-lazy to disable lazysizes plugin
        if(!empty($config['class'])) {
          $classes .= ' ' . $config['class'];
        }
        echo '<img data-src="' . $img_src . '" class="' . $classes . '"';
        if($img_width > 1) {
          echo ' width="' . $img_width . '"';
        }
        if($img_height > 1) {
          echo ' height="' . $img_height . '"';
        }
        if(!empty($img_alt)) {
          echo ' alt="' . $img_alt . '"';
        }
        echo '>';
        echo '<div class="swiper-lazy-preloader"></div>';
      }
    }
  }
}

// Generate background image markup with lazy load method on frontend and without it
// in the admin panel
function bg_img($url, $is_preview) {
  if($is_preview == true) { 
    echo 'style="background-image: url(' . $url . ')"';
  }
  else {
    echo 'data-bg="' . $url . '"';
  } 
}

// Generate image src markup with lazy load method on frontend and without it
// in the admin panel
function src_for_img($url, $is_preview) {
  if($is_preview == true) { 
    echo 'src="' . $url . '"';
  }
  else {
    echo 'data-src="' . $url . '"';
  } 
}

// Add underline option in the Full toolbar in the WYSIWYG field
if ( function_exists( 'get_field' ) ) {
  add_filter( 'acf/fields/wysiwyg/toolbars' , 'theme_toolbars'  );
  function theme_toolbars( $toolbars )
  {
    //INJECT/ADD AN OPTION INTO THE FULL TOOLBAR
    $toolbars['Full' ][1] = array_merge( array_slice( $toolbars['Full' ][1], 0, 3, true ), array( 'underline' ), array_slice( $toolbars['Full' ][1], 3, null, true ) );

    // return $toolbars - IMPORTANT!
    return $toolbars;
  }
}