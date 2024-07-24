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

?>

  </main>
  <footer class="site-footer">
  <div class="site-footer__bg py-66">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 footer-column">
          <div class="site-footer__links">
            <div class="site-footer__links--inner bg-white">
              <h5 class="fw-bold mb-3">The Interiors Studio <small>Foley Design</small></h5>
              <ul class="list-reset">
                <li>
                  <a href="#" class="anchor-block">
                    <div class="icon-wrap adjust-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                          d="M16 2H8C7.46957 2 6.96086 2.21071 6.58579 2.58579C6.21071 2.96086 6 3.46957 6 4V20C6 20.5304 6.21071 21.0391 6.58579 21.4142C6.96086 21.7893 7.46957 22 8 22H16C16.5304 22 17.0391 21.7893 17.4142 21.4142C17.7893 21.0391 18 20.5304 18 20V4C18 3.46957 17.7893 2.96086 17.4142 2.58579C17.0391 2.21071 16.5304 2 16 2ZM16 4V5H8V4H16ZM16 7V17H8V7H16ZM8 20V19H16V20H8Z"
                          fill="#69CCE0" />
                      </svg>
                    </div>
                    <div class="text-wrapper">
                      404-400-2348
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#" class="anchor-block">
                    <div class="icon-wrap adjust-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                          d="M2 4V20H22V4H2ZM9.981 13.7L12 15.267L14.019 13.7L19.4 18H4.6L9.981 13.7ZM4 15.919V9.044L8.357 12.433L4 15.919ZM15.643 12.433L20 9.045V15.919L15.643 12.433ZM20 6V6.511L12 12.733L4 6.511V6H20Z"
                          fill="#69CCE0" />
                      </svg>
                    </div>
                    <div class="text-wrapper">
                      interiorsstudio@foleydesign.com
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-6 footer-column">
          <div class="site-footer__links">
            <div class="site-footer__links--inner bg-white">
            <?php 
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

                  echo '<li><a href="' . esc_url($link) . '"' . $target . 'class="anchor-block"">';
                  echo '<div class="icon-wrap adjust-icon">' . get_template_part('template-parts/svgs/svg-icon', $icon) . '</div>';
                  if ($name) {
                    echo '<div class="text-wrapper">' . $name . '</div>';
                  }
                  echo '</a></li>';
                }

                echo '</ul>';
              }
              ?>
             
              
             
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="site-footer__copyright bg-light">
    <div class="container">
      <div class="copyright-text text-center">
        <p>The Interiors Studio, LLC. 2024. All Rights Reserved.</p>
      </div>
    </div>
  </div>
</footer>

  <?php wp_footer(); ?>
  <?php the_field('code_before_body_ending_tag', 'option'); ?>


</body>
</html>
