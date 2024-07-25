<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package interiors-studio
 */

 $footer_background = get_field('footer_background', 'option');
 $bg_image = '';
 
 if ($footer_background) {
  $bg_image = 'style="background-image:url('. $footer_background .')"';
 }
?>

  </main>
  <footer class="site-footer">
  <div class="site-footer__bg py-66" <?php echo $bg_image; ?>>
    <div class="container">
      <div class="row">

        <?php
        // Contct Info
        $contact_info = get_field('contact_info', 'option');
        if (!empty($contact_info)){
          echo '<div class="col-lg-6 footer-column"><div class="site-footer__links"><div class="site-footer__links--inner bg-white">';
          $title = $contact_info['title'];
          $sub_title = $contact_info['sub_title'];
          $phone = $contact_info['phone'];
          $email = $contact_info['email'];

          if ($title || $sub_title){
            echo '<h5 class="fw-bold mb-3">' . $title . ' <small>' . $sub_title . '</small></h5>';
          }
          if ($phone || $email){
            echo '<ul class="list-reset">';
            if ($phone){
              echo '<li><a href="tel:' . str_replace('-','',$phone) . '" class="anchor-block">';
              echo '<div class="icon-wrap adjust-icon">';
              get_template_part('template-parts/svgs/svg-icon', 'phone');
              echo '</div>';
              echo '<div class="text-wrapper">' . $phone . '</div></a></li>';
            }
            if ($email){
              echo '<li><a href="mailto:' . $email . '" class="anchor-block">';
              echo '<div class="icon-wrap adjust-icon">';
              get_template_part('template-parts/svgs/svg-icon', 'email');
              echo '</div>';
              echo '<div class="text-wrapper">' . $email . '</div></a></li>';
            }
            echo '</ul>';
          }
          echo '</div></div> </div>';
        }

        // Social Media
        if (!empty(get_field('social_profile', 'option'))){
          echo '<div class="col-lg-6 footer-column"><div class="site-footer__links"><div class="site-footer__links--inner bg-white">';
          if ( $title_profile = get_field('social_profile_title', 'option')) {
            echo '<h6>' . $title_profile . '</h6>';
          }
          // Social Media
          if (have_rows('social_media_profiles', 'option')) {
            echo '<ul class="list-reset">';

            while (have_rows('social_media_profiles', 'option')) {
              the_row();

              $icon = get_sub_field('icon');
              $name = get_sub_field('name');
              $link = get_sub_field('link');

              if (get_sub_field('open_in_the_new_window')) {
                $target = 'target="_blank"';
              }

              echo '<li><a href="' . esc_url($link) . '"' . $target . 'class="anchor-block">';
              echo '<div class="icon-wrap adjust-icon">' . get_template_part('template-parts/svgs/svg-icon', $icon) . '</div>';
              if ($name) {
                echo '<div class="text-wrapper">' . $name . '</div>';
              }
              echo '</a></li>';
            }

            echo '</ul>';
          }
          echo '</div></div></div>';
        }
        ?>

      </div>
    </div>
  </div>
  <?php
  $copyright_text = get_field('copyright_text', 'option');
   if ($copyright_text){
    echo '<div class="site-footer__copyright bg-light"><div class="container"><div class="copyright-text text-center">';
    echo '<p>' . $copyright_text . '</p>';
    echo '</div></div></div>';
   }
   ?>
</footer>

  <?php wp_footer(); ?>
  <?php the_field('code_before_body_ending_tag', 'option'); ?>


</body>
</html>
