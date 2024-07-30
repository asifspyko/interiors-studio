<?php
  $blockRootClasses = 'contact-block';

  if( !empty($block['align']) ) {
   $blockRootClasses .= ' align' . $block['align'];
  }

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';
?>

<section class="our-portfolio py-66">
  <div class="container">
    <div class="row row-gutters-20">
      <div class="col-lg-4 col-md-6 py-3 my-1">
        <div class="portfolio-block">
          <a href="#" class="image-wrapper">
            <div class="image-ratio image-ratio--square">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/portfolio-image--1.png" alt="">
            </div>
            <figcaption class="image-caption text-white">
              <h3>Project name</h3>
              <p>project type</p>
            </figcaption>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 py-3 my-1">
        <div class="portfolio-block">
          <a href="#" class="image-wrapper">
            <div class="image-ratio image-ratio--square">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/portfolio-image--1.png" alt="">
            </div>
            <figcaption class="image-caption text-white">
              <h3>Project name</h3>
              <p>project type</p>
            </figcaption>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 py-3 my-1">
        <div class="portfolio-block">
          <a href="#" class="image-wrapper">
            <div class="image-ratio image-ratio--square">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/portfolio-image--1.png" alt="">
            </div>
            <figcaption class="image-caption text-white">
              <h3>Project name</h3>
              <p>project type</p>
            </figcaption>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 py-3 my-1">
        <div class="portfolio-block">
          <a href="#" class="image-wrapper">
            <div class="image-ratio image-ratio--square">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/portfolio-image--1.png" alt="">
            </div>
            <figcaption class="image-caption text-white">
              <h3>Project name</h3>
              <p>project type</p>
            </figcaption>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 py-3 my-1">
        <div class="portfolio-block">
          <a href="#" class="image-wrapper">
            <div class="image-ratio image-ratio--square">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/portfolio-image--1.png" alt="">
            </div>
            <figcaption class="image-caption text-white">
              <h3>Project name</h3>
              <p>project type</p>
            </figcaption>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 py-3 my-1">
        <div class="portfolio-block">
          <a href="#" class="image-wrapper">
            <div class="image-ratio image-ratio--square">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/portfolio-image--1.png" alt="">
            </div>
            <figcaption class="image-caption text-white">
              <h3>Project name</h3>
              <p>project type</p>
            </figcaption>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>



<?php
  endif;
  require get_template_directory() . '/inc/block-end.php';
?>
