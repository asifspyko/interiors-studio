<?php
$hero = get_field('archive_hero', 'option');
$bg_color = $hero['background_color'];
$text_color = $hero['text_color'];
$content = $hero['content'];

if ($content) :
?>
<section class="content-with-bg py-80 archive-banner <?php echo $bg_color; ?>">
  <div class="container">
    <div class="content-block text-center <?php echo $text_color; ?>">
      <h3><?php echo $content; ?></h3>
  </div>  
    </div>
  </section>
  <?php endif; ?>
<section class="our-portfolio py-66">
<div class="container">
    <div class="row row-gutters-20">
    <?php
		$args = array(
		  'post_type' => 'portfolio',
		  'posts_per_page' => -1,
		  'meta_key' => 'content_excerpt', 
		  'orderby' => 'meta_value', 
		  'order' => 'DESC'
		);
    
		$portfolio = new WP_Query($args);
		if ($portfolio->have_posts()):
		   $number = 1;
			while ($portfolio->have_posts()): $portfolio->the_post() ;
			$portfolio_type = get_field('content_portfolio_type', get_the_ID());
		?>
      <div class="col-lg-4 col-md-6 py-3 my-1 portfolio-<?php echo $number; ?>">
        <div class="portfolio-block">
          <a href="<?php the_permalink(); ?>" class="image-wrapper">
          <?php if (has_post_thumbnail()): ?>
            <div class="image-ratio image-ratio--square">
            <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'full', false, ['class' => 'full']); ?>
            </div>
            <?php endif; ?>
            <figcaption class="image-caption text-white">
              <h3><?php the_title(); ?></h3>
              <?php if ($portfolio_type){
                echo '<p>' . $portfolio_type . '</p>';
              } ?>
             
            </figcaption>
          </a>
        </div>
      </div>
      <?php 
		$number++;
    endwhile;
    endif;
     ?>
    </div>
  </div>
</section>

