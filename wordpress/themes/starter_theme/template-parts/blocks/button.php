<?php
  $blockRootClasses = 'default-block-spacing ' . 'text-' . get_field('alignment') . ' ';

  if( !empty($block['align']) ) {
    $blockRootClasses .= ' align' . $block['align'];
  }

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';

  $alignment = get_field('alignment');

  if(get_field('mode') == 'one') {
    $button_text = get_field('button_text');

    if(get_field('button_type') == 'internal') {
      $link = get_field('button');
      $buttonLink = $link['url'];
      $button_text = $link['title'];
    }
    elseif(get_field('button_type') == 'external') {
      $buttonLink = get_field('url');
    }
    elseif(get_field('button_type') == 'file') {
      $buttonLink = get_field('linked_file');
    }
  }
  
?>

<?php if(get_field('mode') == 'one'): ?>
<a href="<?php echo $buttonLink; ?>" class="c-btn c-btn--<?php the_field('button_style'); ?>"<?php if(get_field('button_link_type') == 'file'): ?> download<?php endif; ?><?php if(get_field('open_link_in_new_the_window')): ?> target="_blank"<?php endif; ?>>
  <?php echo $button_text; ?>
</a>
<?php elseif(get_field('mode') == 'multi'): ?>
  <?php if( have_rows('buttons') ): ?>
    <?php while ( have_rows('buttons') ) : the_row(); ?>
      <?php
        $button_text = get_sub_field('button_text');

        if(get_sub_field('button_type') == 'internal') {
          $link = get_sub_field('button');
          $buttonLink = $link['url'];
          $button_text = $link['title'];
        }
        elseif(get_sub_field('button_type') == 'external') {
          $buttonLink = get_sub_field('url');
        }
        elseif(get_sub_field('button_type') == 'file') {
          $buttonLink = get_sub_field('linked_file');
        }
      ?>
      <a href="<?php echo $buttonLink; ?>" class="c-btn c-btn--<?php get_sub_field('button_style'); ?> <?php if($alignment == 'left'): ?>mr-2<?php elseif($alignment == 'center'): ?>mx-2<?php else: ?>ml-2<?php endif; ?>"<?php if(get_sub_field('button_link_type') == 'file'): ?> download<?php endif; ?><?php if(get_sub_field('open_link_in_new_the_window')): ?> target="_blank"<?php endif; ?>>
        <?php echo $button_text; ?>
      </a>
    <?php endwhile; ?>
  <?php endif; ?>
<?php endif; ?>

<?php
  endif;
  require get_template_directory() . '/inc/block-end.php';
?>