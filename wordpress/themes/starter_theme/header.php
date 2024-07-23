<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PROJECT_NAME
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

  <header class="js-header sticky left-0 top-0 w-full z-40 transform transition-all duration-500  header-visual-styles" data-behavior-when-scrolling-down="<?php the_field('header_behavior_when_scrolling_down', 'option'); ?>">
    <div class="l-wrap">
      <div class="flex justify-between items-center">
        <a class="block w-40 flex-1 text-header font-bold text-16 lg:text-25 hover:no-underline hover:text-header" href="<?php echo esc_url( home_url( '/' ) ); ?>">
          PROJECT_NAME
        </a>
        
        <div class="flex items-center">
          <div class="hidden sm:block">
            <?php
              wp_nav_menu(
                array (
                  'theme_location' => 'primary',
                  'menu_class' => 'c-hor-menu',
                  'container' => ''
                )
              );
            ?>
          </div>
          <div class="ml-4 flex items-center sm:!hidden z-50">
            <button class="js-menu-toggle hamburger hamburger--spin focus:outline-none h-[21px]" type="button">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
            </button> 
          </div>
        </div>
        
      </div>
    </div>
  </header>

  <main id="content" class="relative">