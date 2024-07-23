<?php
/*
  Template Name: Template for development
*/
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package PROJECT_NAME
 */

get_header('for-development'); ?>

<div class="border-t-dev-gap border-b-dev-gap border-gray-400">
	<div class="l-blocks-wrap">
			<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', 'page' );
				endwhile;
			?>
	</div>
</div>

<?php get_footer('for-development'); ?>