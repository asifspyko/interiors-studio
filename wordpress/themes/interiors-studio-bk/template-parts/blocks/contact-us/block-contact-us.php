<?php
  $blockRootClasses = 'contact-block';

  if( !empty($block['align']) ) {
   $blockRootClasses .= ' align' . $block['align'];
  }

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';
?>

<section class="contact-us">
  <div class="container-xl px-0">
    <div class="row g-0">
      <?php

      $title = get_field('title'); 
      $select_form = get_field('select_form'); 
      $address = get_field('address'); 

      $background_color = get_field('background_color'); 
      $text_color = get_field('text_color'); 
      
      if ($title || $select_form || $address){
        echo '<div class="col-lg-6"><div class="contact-us__form ' . $background_color . '"><div class="contact-us__form__inner ' . $text_color . '">';

        echo '<div class="form-wrapper">';
        if ($title){
          echo '<div class="title-block"><h2>' . $title . '</h2></div>';
        }
        if ($select_form){
          echo do_shortcode('[contact-form-7 id="' . $select_form . '"]');
        }
        echo '</div>';

        if ($address){
          echo '<div class="location-block text-white">';
          echo '<div class="icon-wrap">';
          get_template_part('template-parts/svgs/svg-icon', 'address');
          echo '</div>';
          echo '<div class="text-wrapper"><p>' . $address . '</p></div>';
          echo '</div>';
        }
        
        echo '</div></div></div>';
      }

      if ($image = get_field('image')){
        echo '<div class="col-lg-6"><div class="image-wrapper"><div class="image-ratio image-ratio--square">';
        echo wp_get_attachment_image($image, 'full', false, ['class' => 'full']);
        echo '</div></div></div>';
      }
      ?>
    </div>
  </div>
</section>


<?php
  endif;
  require get_template_directory() . '/inc/block-end.php';
?>
