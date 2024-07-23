<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package PROJECT_NAME
 */

get_header(); ?>

<div id="primary" class="l-wrap">
	<main id="main" class="site-main py-8 sm:py-12 lg:py-35">
		<div class="bg-white min-h-full px-4 py-16 sm:px-6 sm:py-24 md:grid md:place-items-center lg:px-8">
			<div class="max-w-max mx-auto">
				<main class="sm:flex">
				  <p class="my-0 c-title c-title--large text-brand -mb-2 sm:mb-0">404</p>
          <div class="sm:ml-6">
            <div class="sm:border-l sm:border-gray-200 sm:pl-6">
              <h1 class="c-title c-title--large tracking-tight text-gray-800 mb-0"><?php the_field('404_page_main_header', 'option'); ?></h1>
              <p class="mt-1 text-16 sm:text-base text-gray-500 leading-tight"><?php the_field('404_page_description', 'option'); ?></p>
            </div>
            <div class="mt-6 sm:mt-8 mini:flex mini:space-x-3 sm:border-l sm:border-transparent sm:pl-6 text-left">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="c-btn c-btn--small inline-flex items-center mb-2">
                <?php esc_html_e( 'Back to homepage', 'project_name' ); ?>
              </a>

              <?php
                $link = get_field('404_additional_secondary_button', 'option');
                if( $link ): ?>
                <a class="c-btn c-btn--small bg-gray-400 hover:bg-gray-500 inline-flex items-center mb-2" href="<?php echo $link['url']; ?>" <?php if($link['target']): ?>target="<?php echo $link['target']; ?>"<?php endif; ?>><?php echo $link['title']; ?></a>
              <?php endif; ?>
            </div>
          </div>
				</main>
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
