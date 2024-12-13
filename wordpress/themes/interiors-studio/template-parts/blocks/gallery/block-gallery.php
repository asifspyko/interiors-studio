<?php
  $blockRootClasses = 'content-with-bg-block';

  if( !empty($block['align']) ) {
   $blockRootClasses .= ' align' . $block['align'];
  }

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';

  $images = get_field('gallery');
  if ($images) :
?>

<section class="our-gallery">
  <div class="container">
    <div class="our-gallery__grid grid">
     <?php foreach($images as $image) : ?>
      <div class="grid-item">
       <?php echo wp_get_attachment_image($image, '', false, ['class' => 'img-fluid']); ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php
  endif;
  endif;
  require get_template_directory() . '/inc/block-end.php';
?>
