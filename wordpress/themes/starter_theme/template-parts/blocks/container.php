<?php
  $blockRootClasses = 'alignfull relative blocks-container ';

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';
?>

  <InnerBlocks  />

<?php
  endif;
  require get_template_directory() . '/inc/block-end.php';
?>