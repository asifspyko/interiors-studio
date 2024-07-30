<?php
  $blockRootClasses = 'content-about-block';

  if( !empty($block['align']) ) {
   $blockRootClasses .= ' align' . $block['align'];
  }

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';
?>

<section class="about-description">
  <div class="container">
    <div class="row align-items-center">
      <?php
      if ($image = get_field('image')){
        echo '<div class="col-lg-4"> <div class="about-description__image"><div class="image-ratio image-ratio--square">';
        echo wp_get_attachment_image($image, 'full', false, ['class' => 'full']);
        echo '</div></div></div>';
      }

      if ($description = get_field('description')){
        echo ' <div class="col-lg-8"><div class="about-description__block">';
        echo '<p>' . $description . '</p>';
        echo '</div></div>';
      }
      ?>
    
    </div>
  </div>
</section>

<?php
  endif;
  require get_template_directory() . '/inc/block-end.php';
?>
