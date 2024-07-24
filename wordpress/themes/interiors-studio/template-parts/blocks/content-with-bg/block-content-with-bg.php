<?php
  $blockRootClasses = 'content-with-bg-block';

  if( !empty($block['align']) ) {
   $blockRootClasses .= ' align' . $block['align'];
  }

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';
?>

<section class="content-with-bg bg-secondary py-100">
  <div class="container">
    <div class="content-block content-block__sm text-center text-white">
      <h6 class="sub-heading mb-3 pb-1">who we are</h6>
      <h2>Aenean lacinia bibendum nulla sed consectetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
    </div>
  </div>
</section>


<?php
  endif;
  require get_template_directory() . '/inc/block-end.php';
?>
