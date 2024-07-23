<?php
  $blockRootClasses = 'block-accordion default-block-spacing ';

  if( !empty($block['align']) ) {
    $blockRootClasses .= ' align' . $block['align'];
  }

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';

  $headerTag = (get_field('question_html_tag')) ? get_field('question_html_tag') : 'p';
?>

<?php if( have_rows('accordion') ): ?>
  <div class="c-accordion">
    <?php $counter = 1; while ( have_rows('accordion') ) : the_row(); ?>

      <div class="c-accordion__el">
        <<?php echo $headerTag; ?> class="c-accordion__subtitle<?php if($counter == 1): ?> c-accordion__subtitle--active<?php endif; ?>">
          <a href="#">
            <?php the_sub_field('header'); ?>

            <span class="c-accordion__plus">
              <svg width="28" height="28" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
            </span>
            <span class="c-accordion__minus">
              <svg width="28" height="28" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="minus" class="svg-inline--fa fa-minus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
            </span>
          </a>
        </<?php echo $headerTag; ?>>

        <div class="c-accordion__text<?php if($counter == 1): ?> c-accordion__text--active<?php endif; ?>" <?php if($counter > 1): ?> style="display: none;"<?php endif; ?>>
          <?php the_sub_field('text'); ?>
        </div>
      </div>

    <?php $counter++; endwhile; ?>
  </div>
<?php endif; ?>

<?php
  endif;
  require get_template_directory() . '/inc/block-end.php';
?>
