<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package interiors-studio
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function interiors_studio_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'interiors_studio_body_classes' );

function add_custom_class_to_menu_items($items) {
    foreach ($items as $item) {
        $item->classes[] = 'nav-item'; // Add your custom class here
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'add_custom_class_to_menu_items');

function add_custom_class_to_menu_links($atts, $item, $args) {
    // Add your custom class here
    $atts['class'] = isset($atts['class']) ? $atts['class'] . ' nav-link' : 'nav-link';
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_custom_class_to_menu_links', 10, 3);
