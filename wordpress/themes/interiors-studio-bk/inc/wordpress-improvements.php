<?php

// Allow SVG upload
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Page Slug Body Class
function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

// Removing word "Category" before category name
/*
add_filter( 'get_the_archive_title', function ( $title ) {
    if( is_category() ) {
        $title = sprintf( single_cat_title( '', false ) );
    }
    return $title;
});
*/

// German slugs
function transliterate_aeoeuess($title, $raw_title = NULL, $context = 'query') {
    // Hacky hook due to hacky core, see
    // http://core.trac.wordpress.org/ticket/16905

    if ($raw_title != NULL) {
        $title = $raw_title; // undo remove_accents
    }

    $title = str_replace('Ä', 'ae', $title);
    $title = str_replace('ä', 'ae', $title);
    $title = str_replace('Ö', 'oe', $title);
    $title = str_replace('ö', 'oe', $title);
    $title = str_replace('Ü', 'ue', $title);
    $title = str_replace('ü', 'ue', $title);
    $title = str_replace('ẞ', 'ss', $title);
    $title = str_replace('ß', 'ss', $title);

    if ($context == 'save') {
        $title = remove_accents($title); // redo remove_accents
    }

    return $title;
}
add_filter('sanitize_title', 'transliterate_aeoeuess', 5, 3);

// Hide admin Bar
// add_filter('show_admin_bar', '__return_false');

// Enable lazyload in the WYSIWYG field
// add_filter('acf/format_value/type=wysiwyg', 'format_value_wysiwyg', 10, 3);
// function format_value_wysiwyg( $value, $post_id, $field ) {
// 	$value = apply_filters( 'the_content', $value );
// 	return $value;
// }

// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {
    // Define the style_formats array
    $style_formats = array(
        // Each array child is a format with it's own settings
        array(
            'title' => 'Title',
            'selector' => 'p,h1,h2,h3,h4,h5,h6',
            'classes' => 'c-title',
            'wrapper' => true,
        )
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;

}

// Remove .hentry-class from HTML output
function remove_hentry_from_post_class_filter( $classes ) {
    $classes = str_replace('hentry', '', $classes);
    return $classes;
}

add_filter( 'post_class', 'remove_hentry_from_post_class_filter' );

// Make archive page link in menu active when user visits single post
/*
add_action('nav_menu_css_class', function ($classes, $item) {

  // Getting the current post details
  $post = get_queried_object();
  if (isset($post->post_type)) {
    if ($post->post_type == 'post') {
      $current_post_type_slug = get_permalink(get_option('page_for_posts'));
    } else {
      // Getting the post type of the current post
      $current_post_type = get_post_type_object(get_post_type($post->ID));
      $current_post_type_slug = $current_post_type->rewrite['slug'];
    }

    // Getting the URL of the menu item
    $menu_slug = strtolower(trim($item->url));

    // If the menu item URL contains the current post types slug add the current-menu-item class
    if($current_post_type_slug && strpos($menu_slug, strval($current_post_type_slug)) !== false) {
      $classes[] = 'current-menu-item';
    }
  }
  // Return the corrected set of classes to be added to the menu item
  return $classes;
}, 10, 2);
*/

// Remove information about site generator
remove_action('wp_head', 'wp_generator');
global $sitepress;
remove_action( 'wp_head', array( $sitepress, 'meta_generator_tag' ) );

// Custom colors in color picker
function my_acf_input_admin_footer() { ?>
<script type="text/javascript">
(function($) {
  acf.add_filter('color_picker_args', function( args, $field ){
    args.palettes = ['#FFFFFF', '#DB655E', '#4E4E56', '#B1938B'];
    return args;
  });
})(jQuery);
</script>
<?php }

add_action('acf/input/admin_footer', 'my_acf_input_admin_footer');

// Remove type="text/javascript" which is returning Warning in W3C Validator
add_filter('script_loader_tag', 'remove_type_attr', 10, 2);

function remove_type_attr($tag, $handle) {
  return preg_replace( "/type=['\"]text\/(javascript)['\"]/", '', $tag );
}

// Add "nocookie" To WordPress oEmbeded Youtube Videos
function jst_youtube_nocookie_oembed( $return ) {
  $return = str_replace( 'youtube', 'youtube-nocookie', $return );
  return $return;
}
add_filter( 'oembed_dataparse', 'jst_youtube_nocookie_oembed' );

// Add page slug to admin body class
function custom_admin_body_class( $classes ) {
    global $post;
    $cls = '';
    if ($post) {
        $cls = str_replace(".php","",get_page_template_slug());
    }
    return "$classes $cls";
}
add_filter( 'admin_body_class', __NAMESPACE__ .'\\custom_admin_body_class' );

// Remove dashicons in frontend for unauthenticated users
add_action( 'wp_enqueue_scripts', 'bs_dequeue_dashicons' );
function bs_dequeue_dashicons() {
    if ( ! is_user_logged_in() ) {
        wp_deregister_style( 'dashicons' );
    }
}

// Add reusable blocks to admin menu
function be_reusable_blocks_ui() {
    add_menu_page( __( 'Reusable Blocks', 'reusable-blocks-ui' ), __( 'Reusable Blocks', 'reusable-blocks-ui' ), 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22 );
}
add_action( 'admin_menu', 'be_reusable_blocks_ui' );

// Horizontal list of languages
function languages_list_panel(){
  $languages = icl_get_languages('skip_missing=0&orderby=code');
  if(!empty($languages)){
      echo '<ul class="flex m-0 p-0">';
      foreach($languages as $l){
          echo '<li class="mr-4">';
          if($l['country_flag_url']){
              if(!$l['active']) echo '<a href="'.$l['url'].'">';
              echo '<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'.$l['country_flag_url'].'" height="32" alt="'.$l['language_code'].'" width="32" class="js-lazyload-after-panel-open" />';
              if(!$l['active']) echo '</a>';
          }
          if(!$l['active']) echo '<a href="'.$l['url'].'">';
          if(!$l['active']) echo '</a>';
          echo '</li>';
      }
      echo '</ul>';
  }
}

// Fixing missing SVG file dimensions
add_filter( 'wp_get_attachment_image_src', 'fix_wp_get_attachment_image_svg', 10, 4 );

function fix_wp_get_attachment_image_svg($image, $attachment_id, $size, $icon) {
   if (is_array($image) && preg_match('/\.svg$/i', $image[0]) && $image[1] <= 1) {
       if(is_array($size)) {
           $image[1] = $size[0];
           $image[2] = $size[1];
       } elseif(($xml = simplexml_load_file($image[0])) !== false) {
           $attr = $xml->attributes();
           $viewbox = explode(' ', $attr->viewBox);
           $image[1] = isset($attr->width) && preg_match('/\d+/', $attr->width, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[2] : null);
           $image[2] = isset($attr->height) && preg_match('/\d+/', $attr->height, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[3] : null);
       } else {
           $image[1] = $image[2] = null;
       }
   }
   return $image;
} 