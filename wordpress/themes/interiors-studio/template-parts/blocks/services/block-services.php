<?php
  $blockRootClasses = 'services-block';

  if( !empty($block['align']) ) {
   $blockRootClasses .= ' align' . $block['align'];
  }

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';
?>

<section class="our-services py-80">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="our-services__block">
          <div class="our-services__block--inner bg-light">
            <h2>Interior Design</h2>
            <ul>
              <li>construction drawings</li>
              <li>space planning</li>
              <li>material and lighting specifications</li>
              <li>construction administration</li>
              <li>site visits during construction process</li>
              <li>create presentations / mood boards</li>
              <li>either digitally or physically</li>
              <li>assist in digital renderings of future work</li>
              <li>yearly assessments of past projects or
                future work</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="our-services__block">
          <div class="our-services__block--inner bg-light">
            <h2>FFE Procurement</h2>
            <ul>
              <li>in house purchasing of furniture, fabric, accessories, artwork</li>
              <li>planning & budgeting</li>
              <li>curate artwork packages</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="our-services__block">
          <div class="our-services__block--inner bg-light">
            <h2>Warehousing, Delivering & Installation</h2>
            <ul>
              <li>manage and direct FFE installations</li>
              <li>coordinate replacement orders, etc.</li>
            </ul>
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
