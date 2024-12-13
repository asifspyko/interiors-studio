<?php

// Current year shortcode
function current_year_shortcode()
{
  return date('Y');
}
add_shortcode('current_year', 'current_year_shortcode');

// Copyright year shortcode
function copyright_year_shortcode()
{
  $development_date = (get_field('website_creation_date', 'option')) ? get_field('website_creation_date', 'option') : '2022';
  if ($development_date == date('Y')) {
    return $development_date;
  } else {
    return $development_date . ' - ' . date('Y');
  }
}
add_shortcode('copyright_year', 'copyright_year_shortcode');

// Button shortcode
function button_shortcode($atts, $content = null, $code = "")
{
  $a = shortcode_atts(array(
    'url' => '#',
    'class' => '',
  ), $atts);
  return '<p><a class="btn ' . $a['class'] . '" href="' . $a['url'] . '">' . $content . '</a></p>';
}
add_shortcode('button', 'button_shortcode');

// SUP / SUB Shortcode
function sup_shortcode($atts, $content = null, $code = "")
{
  $a = shortcode_atts(array(), $atts);
  return '<sup>' . $content . '</sup>';
}
add_shortcode('sup', 'sup_shortcode');

function sub_shortcode($atts, $content = null, $code = "")
{
  $a = shortcode_atts(array(), $atts);
  return '<sub>' . $content . '</sub>';
}
add_shortcode('sub', 'sub_shortcode');

function share_shortcode()
{
  ob_start();
?>
  <div class="c-share-icons">
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="c-share-icons__icon c-share-icons__icon-facebook">
      <?php echo get_fontawesome_svg('fab fa-facebook-f'); ?>
      <p>Teilen</p>
    </a>

    <a href="https://twitter.com/intent/tweet/?url=<?php the_permalink() ?>" target="_blank" class="c-share-icons__icon c-share-icons__icon-twitter">
      <?php echo get_fontawesome_svg('fab fa-twitter'); ?>
      <p>Tweet</p>
    </a>

    <a href="mailto:?&subject=<?php the_title() ?>&body=<?php the_title() . '-' . the_permalink() ?>" target="_blank" class="c-share-icons__icon c-share-icons__icon-mail">
      <?php echo get_fontawesome_svg('fas fa-envelope'); ?>
      <p>Mail</p>
    </a>

    <a href="https://www.xing.com/social_plugins/share?url=<?php the_permalink() ?>" target="_blank" class="c-share-icons__icon c-share-icons__icon-xing">
      <?php echo get_fontawesome_svg('fab fa-xing'); ?>
    </a>

    <a href="whatsapp://send?<?php the_permalink() ?>" target="_blank" class="c-share-icons__icon c-share-icons__icon-whatsapp">
      <?php echo get_fontawesome_svg('fab fa-whatsapp'); ?>
    </a>
  </div>
<?php
  return ob_get_clean();
}
add_shortcode('goodshare', 'share_shortcode');
