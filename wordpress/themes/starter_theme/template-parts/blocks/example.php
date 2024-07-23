<?php
  $blockRootClasses = 'block-example alignfull default-block-spacing ';

  // Remove "alignfull" from line 2 and uncomment this code to enable
  // align settings for block
  // if( !empty($block['align']) ) {
  //   $blockRootClasses .= ' align' . $block['align'] . ' ';
  // }

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';

  // Example of the header tag
  $headerTag = (get_field('header_tag')) ? get_field('header_tag') : 'p';
?>

    <?php // Your block content is going here ?>
    <div class="font-bold text-center text-28 py-10 m-0">
      <?php the_field('example'); ?>
    </div>

    <div class="bg-red-300 text-center p-20">
      <InnerBlocks  />
    </div>

<?php
  endif;
  require get_template_directory() . '/inc/block-end.php';
?>
