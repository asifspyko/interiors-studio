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
<?php wp_head(); ?>
<script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script> <?php /* Detect if JavaScript is enabled and change class in html element */ ?>
</head>

<body <?php body_class('show-screen-size'); ?>>

<div class="l-outline">
  <main id="content">

