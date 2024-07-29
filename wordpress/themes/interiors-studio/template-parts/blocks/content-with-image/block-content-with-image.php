<?php
  $blockRootClasses = 'content-with-image-block';

  if( !empty($block['align']) ) {
   $blockRootClasses .= ' align' . $block['align'];
  }

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';

  $padding = (get_field('padding')) ? 'image-with-content__alt' : '' ;
?>

<section class="image-with-content <?php echo $padding; ?>">
  <div class="container-xl px-0">
    <div class="row g-0">
      <?php

      $sub_title = get_field('sub_title');
      $title = get_field('title');
      $content = get_field('content');
      $button = get_field('button');

      $background_color = get_field('background_color');
      $text_color = get_field('text_color');
      $content_alignment = get_field('content_alignment');

      if ($sub_title || $title || $content || $button){
        echo '<div class="col-lg-6"><div class="content-block ' . $background_color . '"><div class="content-block__inner ' . $content_alignment . ' ' . $text_color . '">';

        if ($sub_title){
          echo '<h6 class="sub-heading">' . $sub_title . '</h6>';
        }
        if ($title){
          echo '<h2>' . $title . '</h2>';
        }
        if ($content){
          echo '<p>' . $content . '</p>';
        }
        if ($button){
          $target = ($button['target']) ? 'target="_blank"' : '';
          echo '<div class="btn-wrapper">';
          echo '<a href="' . $button['url'] . '" class="btn btn-outline-secondary" ' . $target . '>' . $button['title'] . '</a>';
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
