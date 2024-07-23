<?php
  $blockRootClasses = 'default-block-spacing ';

  if( !empty($block['align']) ) {
   $blockRootClasses .= ' align' . $block['align'];
  }

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';
?>

<?php if( have_rows('image_slider') ): ?>
<div class="js-image-slider-wrap relative">
  <div class="js-image-slider swiper-container border-b border-main !pb-14 !lg:pb-11">
    <div class="swiper-wrapper">
      <?php while ( have_rows('image_slider') ) : the_row(); ?>
        <div class="swiper-slide">
          <figure>
            <?php image_from_id(get_sub_field('image'), array('size' => 'full', 'lazyload' => 'swiper', 'class' => 'w-full pb-3 sm:pb-2', 'preview' => $is_preview)); ?>
            <?php if(get_sub_field('caption')): ?>
              <figcaption class="p-reset leading-tight text-14 sm:text-16 pb-3 sm:pb-2">
                <?php the_sub_field('caption'); ?>
              </figcaption>
            <?php endif; ?>
          </figure>
        </div>
      <?php endwhile; ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>

  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>
<?php endif; ?>

<?php
  endif;
  require get_template_directory() . '/inc/block-end.php';
?>
