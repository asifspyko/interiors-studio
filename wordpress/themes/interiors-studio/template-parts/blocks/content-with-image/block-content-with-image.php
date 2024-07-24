<?php
  $blockRootClasses = 'content-with-image-block';

  if( !empty($block['align']) ) {
   $blockRootClasses .= ' align' . $block['align'];
  }

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';
?>

<section class="image-with-content">
  <div class="container-xl px-0">
    <div class="row g-0">
      <div class="col-lg-6">
        <div class="content-block">
          <div class="content-block__inner text-center">
            <h6 class="sub-heading">our process</h6>
            <h2>Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</h2>
            <div class="btn-wrapper">
              <a href="#" class="btn btn-outline-secondary">our services</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="image-wrapper">
          <div class="image-ratio image-ratio--square">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/image-with-content--home.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="image-with-content image-with-content__alt">
  <div class="container-xl px-0">
    <div class="row g-0">
      <div class="col-lg-6">
        <div class="content-block bg-secondary">
          <div class="content-block__inner text-white">
            <h6 class="sub-heading">our team</h6>
            <h2>Cras mattis consectetur purus sit amet.</h2>
            <p>The Interiors Studio, LLC is a Women-Owned Business Enterprise in Atlanta, Georgia specializing in
              commercial, hospitality and senior living interior design.  Our team of principals and project designers
              has a combined total of over 90 years of experience in commercial interior design and we are fortunate to
              have worked with talented architects and other design professionals on a variety of projects in many
              different locations.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="image-wrapper">
          <div class="image-ratio image-ratio--square">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/image-with-content--about.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php
  endif;
  require get_template_directory() . '/inc/block-end.php';
?>
