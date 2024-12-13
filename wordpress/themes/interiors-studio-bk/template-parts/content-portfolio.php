<?php

$portfolio_id = get_the_ID();
$content = get_field('content', $portfolio_id);
$hero_image = $content['hero_image'];
$portfolio_type = $content['portfolio_type'];
$excerpt = $content['excerpt'];
$description = $content['description'];

$gallery = get_field('gallery', $portfolio_id);
// Using ACF repeater field for gallery images
$images = $gallery['images']; 
?>
<section class="hero hero--portfolio-detail">
  <?php
    if ($hero_image) {
      echo '<div class="hero-image">';
      echo wp_get_attachment_image($hero_image, 'full', false, ['class' => 'full']);
      echo '</div>';
    }
  ?>
  <div class="content-block text-white">
    <h2><?php the_title(); ?></h2>
    <?php if ($portfolio_type): ?>
      <h6><?php echo esc_html($portfolio_type); ?></h6>
    <?php endif; ?>
  </div>
</section>
<section class="portfolio-detail-gallery">
  <div class="container">
    <div class="description-block">
      <p class="copy-sm mb-4"><?php echo esc_html($excerpt); ?></p>
      <p><?php echo wp_kses_post($description); ?></p>
    </div>
    <div class="row row-gutters-10">
    <?php if ($images): ?>
    <div class="row row-gutters-10">
        <?php foreach ($images as $image): 
            // Get the image ID and full_width flag
            $image_id = $image['image'];
            $full_width = !empty($image['full_width']);
            
            // Get the image URL and alt text
            $image_data = wp_get_attachment_image_src($image_id, 'full');
            $image_url = $image_data[0];
            $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
        ?>
        <div class="col-md-<?php echo $full_width ? '12' : '6'; ?> py-2 my-1">
            <div class="gallery-image">
                <div class="image-ratio image-ratio--<?php echo $full_width ? '16-9' : 'square'; ?>">
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

    </div>
  </div>
</section>
