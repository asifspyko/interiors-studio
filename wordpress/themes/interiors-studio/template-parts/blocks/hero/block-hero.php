<?php
  $blockRootClasses = 'hero-block';

  if( !empty($block['align']) ) {
   $blockRootClasses .= ' align' . $block['align'];
  }

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';
?>

<section class="hero">
  <div class="hero-image">
    <img src="<?php echo  get_template_directory_uri(); ?>/assets/img/hero-home.png" alt="">
  </div>
  <div class="container">
    <div class="content-block text-white">
      <h1>Peachtree Hills Place</h1>
      <div class="btn-wrapper">
        <a href="#" class="btn btn-outline-white">View featured project</a>
      </div>
    </div>
  </div>
</section>


<?php
  endif;
  require get_template_directory() . '/inc/block-end.php';
?>
