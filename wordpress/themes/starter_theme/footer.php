<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PROJECT_NAME
 */

?>

    </main>

    <footer class="js-footer bg-gray-300 py-8 text-center">
      <div class="l-wrap">
        <?php the_field('copyright_text', 'option'); ?>
      </div>
    </footer>

    <a href="#top" class="c-scroll-to-top">
      <svg viewBox="0 0 20 20" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
    </a>

    <div class="js-cover fixed inset-0 w-full h-full bg-gray-600 bg-opacity-25 z-20 transition-opacity duration-500 opacity-0 pointer-events-none" style="backdrop-filter: blur(3px);"></div>

  </div> <!-- /.l-outline -->

<nav class="js-nav fixed right-0 top-0 bottom-0 w-screen z-20 transition-all duration-300 transform -translate-y-full xs:translate-y-0 xs:translate-x-full bg-white xs:max-w-mobile-menu-xs">
  <div class="js-nav-wrap h-full">
    <div class="pt-5 lg:pt-5 h-full overflow-auto">
      <div class="h-full flex flex-col divide-y divide-gray-200 relative">
        <div class="min-h-0 flex-1 overflow-y-scroll js-main-menu-mobile-scroll">
          <?php if(function_exists('icl_object_id') && get_field('language_switcher_enabled', 'option')): ?>
          <div class="l-wrap mb-8">
            <?php echo languages_list_panel(); ?>
          </div>
          <?php endif; ?>

          <?php if(get_field('search_enabled', 'option')): ?>
            <div class="l-wrap mt-2 mb-8">
              <form action="/" method="get" class="relative">
                <input type="text" class="form-input pl-11" placeholder="<?php esc_html_e( 'Search...', 'project_name' ); ?>" name="s" id="search" value="<?php the_search_query(); ?>" />
                <svg class="absolute left-0 top-0 w-6 h-6 text-brand ml-3 mt-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </form>
            </div>
          <?php endif; ?>

          <div class="l-wrap">
            <?php
              wp_nav_menu(
                array (
                  'theme_location' => 'mobile',
                  'menu_class' => 'c-mobile-menu',
                  'container' => ''
                )
              );
            ?>
          </div>
        </div>
        <?php if(get_field('phone_number_enabled', 'option') || get_field('social_media_enabled', 'option')): ?>
        <div class="text-center w-full flex-shrink-0 bg-white relative bottom-inset-shadow">
          <?php if(get_field('phone_number_enabled', 'option')): ?>
            <div class="py-2">
              <a class="text-gray-600 text-20 hover:no-underline" href="tel:<?php the_field('phone_number_link', 'option'); ?>"><?php echo get_fontawesome_svg('fas fa-phone-alt'); ?> <?php the_field('phone_number', 'option'); ?></a>
            </div>
          <?php endif; ?>
          <?php if( have_rows('social_media_profiles', 'option') && get_field('social_media_enabled', 'option')): ?>
            <div class="border-t">
              <ul class="flex justify-center pt-2">
              <?php while ( have_rows('social_media_profiles', 'option') ) : the_row(); ?>
                <li class="ml-3">
                  <a class="bg-gray-600 w-10 h-10 text-white text-16 flex justify-center items-center rounded-full hover:bg-brand hover:text-white hover:no-underline" href="<?php the_sub_field('link'); ?>" <?php if(get_sub_field('open_in_the_new_window')): ?>target="_blank"<?php endif; ?>>
                    <?php echo get_fontawesome_svg(get_sub_field('icon')); ?>
                  </a>
                </li>
              <?php endwhile; ?>
              </ul>
            </div>
          <?php endif; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

  <?php wp_footer(); ?>
  <?php the_field('code_before_body_ending_tag', 'option'); ?>


</body>
</html>
