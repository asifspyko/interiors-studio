<?php
$blockRootClasses = 'hero-block';

if (!empty($block['align'])) {
  $blockRootClasses .= ' align' . $block['align'];
}

require get_template_directory() . '/inc/block-start.php';
if (!$block_disabled && empty($block['data']['block_preview_img'])):

  if (!empty($block['data']['block_preview_img']))
    echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';

  $title = get_field('title');
  $button = get_field('button');

  ?>

  <section class="hero">
    <?php

    if ($image = get_field('image')) {
      echo '<div class="hero-image">';
      echo wp_get_attachment_image($image, 'full', false, ['class' => 'full']);
      echo '</div>';
    }

    if ($title || $button) {
      
      echo '<div class="container"><div class="content-block text-white">';
      if ($title) {
        echo '<h1>' . $title . '</h1>';
      }

      if ($button) {
        $target = ($button['target']) ? 'target="_blank"' : '';
        echo '<div class="btn-wrapper">';
        echo '<a href="' . $button['url'] . '" class="btn btn-outline-white" ' . $target . '>' . $button['title'] . '</a>';
        echo '</div>';
      }
      echo '</div></div>';
    }

    ?>
  </section>


  <?php
endif;
require get_template_directory() . '/inc/block-end.php';
?>