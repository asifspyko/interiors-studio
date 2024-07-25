<?php
  $blockRootClasses = 'content-with-bg-block';

  if( !empty($block['align']) ) {
   $blockRootClasses .= ' align' . $block['align'];
  }

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';
?>

<section class="content-with-bg <?php the_field('background_color');?> py-100">
  <div class="container">
    <?php 

      $sub_title = get_field('sub_title');
      $title = get_field('title');
      $text_color = get_field('text_color');

      if ($sub_title || $title){
        echo '<div class="content-block content-block__sm text-center ' . $text_color . '">';

        if ($sub_title){
          echo '<h6 class="sub-heading mb-3 pb-1">' . $sub_title . '</h6>';
        }
        if ($title){
          echo '<h2>' . $title . '</h2>';
        }
        echo '</div>';
      }
    ?>
  
    </div>
  </div>
</section>


<?php
  endif;
  require get_template_directory() . '/inc/block-end.php';
?>
