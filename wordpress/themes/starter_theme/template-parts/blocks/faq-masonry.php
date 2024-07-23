<?php
$blockRootClasses = 'block-faq-masonry default-block-spacing';

if (!empty($block['align'])) {
  $blockRootClasses .= ' align' . $block['align'];
}

require get_template_directory() . '/inc/block-start.php';
if (!$block_disabled && empty($block['data']['block_preview_img'])) :

  if (!empty($block['data']['block_preview_img'])) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';

  $headerTag = (get_field('header_tag')) ? get_field('header_tag') : 'p';
  $SmallheaderTag = (get_field('small_header_tag')) ? get_field('small_header_tag') : 'p';
  $headerTagEl = (get_field('question_html_tag')) ? get_field('question_html_tag') : 'p';
?>

  <div class="">
    <?php if(get_field('small_header')): ?>
      <<?php echo $SmallheaderTag; ?> class="c-title c-title--small text-brand text-center">
        <?php the_field('small_header'); ?>
      </<?php echo $SmallheaderTag; ?>>
    <?php endif; ?>

    <?php if(get_field('header')): ?>
      <<?php echo $headerTag; ?> class="c-title text-center">
        <?php the_field('header'); ?>
      </<?php echo $headerTag; ?>>
    <?php endif; ?>

  </div>

  <?php if (have_rows('accordion')) : ?>
    <div class="c-faq-masonry md:flex md:flex-wrap sm:-mx-3 js-masonry" itemscope itemtype="https://schema.org/FAQPage">
      <?php while (have_rows('accordion')) : the_row(); ?>

        <div class="c-faq-masonry__el bg-white sm:w-1/2 md:w-1/3 sm:px-3 pb-6 lg:pb-11" itemtype="https://schema.org/Question" itemscope itemprop="mainEntity">
          <div class="p-5 md:px-7 md:py-10 lg:px-11 lg:py-12 shadow-lg">
            <<?php echo $headerTagEl; ?> class="c-title c-title--small">
              <span itemprop="name">
                <?php the_sub_field('header'); ?>
              </span>
            </<?php echo $headerTag; ?>>

            <div class="c-faq-masonry__text" itemprop="acceptedAnswer" itemscope itemtype="https://schema.org/Answer">
              <div itemprop="text">
                <?php the_sub_field('text'); ?>
              </div>
            </div>
          </div>
        </div>

      <?php $counter++;
      endwhile; ?>
    </div>
  <?php endif; ?>

<?php
endif;
require get_template_directory() . '/inc/block-end.php';
?>