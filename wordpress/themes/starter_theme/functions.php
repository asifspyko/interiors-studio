<?php
/**
 * PROJECT_NAME functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package PROJECT_NAME
 */

// Inline Font Awesome SVG files instead of Webfont (performance improvement)
require get_template_directory() . '/inc/fontawesome-svg.php';

// Menu registration (available in Appearance menu item)
require get_template_directory() . '/inc/menu-registration.php';

// WordPress functionality setup
require get_template_directory() . '/inc/wordpress-functionality-setup.php';

// AJAX Load More
require get_template_directory() . '/inc/ajax-load-more.php';

// Enqueue scripts and styles
require get_template_directory() . '/inc/scripts-and-styles.php';

// Settings Pages
require get_template_directory() . '/inc/settings-pages.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Custom functions that act independently of the theme templates.
require get_template_directory() . '/inc/extras.php';

// WordPress improvements - SVG support, slug in body class,
require get_template_directory() . '/inc/wordpress-improvements.php';

// Additional image sizes
require get_template_directory() . '/inc/image-sizes.php';

// Helper functions - Generate phone number, remove protocol from link, excerpt,
// content, create slug from string
require get_template_directory() . '/inc/helper-functions.php';

// Shortcodes - current year, copyright year,
require get_template_directory() . '/inc/shortcodes.php';

// Favicon
require get_template_directory() . '/inc/favicon-inject.php';

// ACF improvements and compatibility functions
require get_template_directory() . '/inc/acf-improvements.php';

// Gutenberg Blocks Loader
require get_template_directory() . '/inc/loader-blocks.php';

// Gutenberg helper functions like spacing calculations, visibility etc.
require get_template_directory() . '/inc/gutenberg-helper-functions.php';

// Rich Snippets
require get_template_directory() . '/inc/rich-snippets.php';