<?php
  $blockRootClasses = 'content-about-block';

  if( !empty($block['align']) ) {
   $blockRootClasses .= ' align' . $block['align'];
  }

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';
?>

<section class="about-description">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-4">
        <div class="about-description__image">
          <div class="image-ratio image-ratio--square">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about-description-image.png" alt="">
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="about-description__block">
          <p>Our services include conceptual design, facility assessment, programming, space planning, coordination with
            architects and engineers, design documents, construction administration and furniture, artwork and window
            treatment design, procurement and installation.
            Our philosophy is to create interior spaces which coordinate with and enhance the overall architectural
            character of a building, to provide enjoyable and functional areas for users and residents, and to
            prioritize attention to our clients' vision, budget and schedule. 
            Our focus on a team approach has been key to successful projects and long term relationships with clients,
            architects, engineers, contractors, facility managers and staff. </p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
  endif;
  require get_template_directory() . '/inc/block-end.php';
?>
