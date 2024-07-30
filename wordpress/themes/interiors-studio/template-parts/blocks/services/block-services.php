<?php
  $blockRootClasses = 'services-block';

  if( !empty($block['align']) ) {
   $blockRootClasses .= ' align' . $block['align'];
  }

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';
?>

<?php if(have_rows('services')) : ?>
<section class="our-services py-80">
  <div class="container">
    <div class="row">
      <?php while(have_rows('services')): the_row(); ?>
      <div class="col-lg-4">
        <div class="our-services__block">
          <div class="our-services__block--inner bg-light">
            <?php 
            $title = get_sub_field('title');
            $description = get_sub_field('description');

            if ($title){
              echo '<h2>' . $title . '</h2>';
            }

            echo $description;
            ?>
      
          </div>
        </div>
      </div>
    <?php endwhile; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
  endif;
  require get_template_directory() . '/inc/block-end.php';
?>
