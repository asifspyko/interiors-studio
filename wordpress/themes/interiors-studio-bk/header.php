<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package interiors-studio
 */

?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php the_field('code_in_header_area', 'option'); ?>
<?php wp_head(); ?>
<script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script> <?php /* Detect if JavaScript is enabled and change class in html element */ ?>
<?php theme_rich_snippets(); ?>
</head>

<body <?php if(defined('WP_DEBUG') && true === WP_DEBUG) { body_class('show-screen-size'); } else { body_class(); } ?>>
<?php the_field('code_after_body_opening_tag', 'option'); ?>
<!--[if lt IE 11]>
<div class="browserupgrade"><?php the_field('notice_for_outdated_browsers', 'option'); ?></div>
<![endif]-->

<div class="l-outline">

<header class="site-header">
  <div class="container">
    <nav class="navbar navbar-expand-lg p-0">
      <div class="row align-items-center flex-grow-1">
        <div class="col-lg-4 col-8">
          <a href="<?php echo get_site_url(); ?>" class="site-logo d-block">
            <?php get_template_part('template-parts/svgs/svg-icon', 'logo'); ?>
          </a>
        </div>
        <div class="col-lg-8 col-4">
          <div class="navbar--inner d-flex align-items-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#siteNavigation"
              aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span></span>
              <span></span>
              <span></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end w-100" id="siteNavigation">
              <div class="navbar-nav-wrapper h-100">
                <?php
                  if (has_nav_menu('primary')) {
                    echo wp_nav_menu(
                      [
                        'theme_location' => 'primary',
                        'menu_class' => 'navbar-nav',
                        'container' => 'ul'
                      ]
                    );
                  }
                ?>
              </div>
            </div>
            <?php
             // Social Media
          if (have_rows('social_media_profiles', 'option')) {
            echo '<div class="social-icons"> <ul class="list-reset d-flex">';

            while (have_rows('social_media_profiles', 'option')) {
              the_row();

              $icon = get_sub_field('icon');
              $link = get_sub_field('link');

              if (get_sub_field('open_in_the_new_window')) {
                $target = 'target="_blank"';
              }

              echo '<li><a href="' . esc_url($link) . '"' . $target . 'class="adjust-icon">';
              echo get_template_part('template-parts/svgs/svg-icon', $icon);
              echo '</a></li>';
            }

            echo '</ul></div>';
          }
          ?>

            
          </div>
        </div>
      </div>
    </nav>
  </div>
</header>


  <main id="content" class="relative">