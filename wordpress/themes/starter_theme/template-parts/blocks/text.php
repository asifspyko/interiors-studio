<?php
  $blockRootClasses = 'text-size-' . get_field('font_size') . ' text-' . get_field('text_color');

  if(get_field('disable_top_margin')) {
    $blockRootClasses .= ' mt-0-first-child ';
  }

  if(get_field('disable_bottom_margin')) {
    $blockRootClasses .= ' mb-0-last-child ';
  }

  if( !empty($block['align']) ) {
    if($block['align'] == 'wide' || $block['align'] == 'full' ) {
      $blockRootClasses .= ' align' . $block['align'];
    }
    else {
      $blockRootClasses .= ' text-' . $block['align'];
    }
  }

  $text_max_width = (get_field('settings_textwidth') || (get_field('settings_textwidth_mobile') || get_field('settings_textwidth_sm') || get_field('settings_textwidth_md') || get_field('settings_textwidth_lg') || get_field('settings_textwidth_xl'))) ? true : false;

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';
?>

<?php if($text_max_width): ?><div class="text-max-width"><?php endif; ?>

<?php the_field('text'); ?>

<?php if($text_max_width): ?></div><?php endif; ?>

<?php
  endif;
  require get_template_directory() . '/inc/block-end-self.php';
?>