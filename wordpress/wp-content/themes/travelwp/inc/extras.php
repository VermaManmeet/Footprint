<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package travelWP
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function travelwp_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( !is_singular() ) {
		$classes[] = 'hfeed';
	}
	if ( is_front_page() ) {
		if ( travelwp_get_option( 'transparent_menu_home' ) == '1' ) {
			$classes[] = ' transparent_home_page';
		}
	}
	if ( get_post_type() == 'product' ) {
		if ( wc_get_product()->is_type( 'tour_phys' ) && is_single() && ( travelwp_get_option( 'phys_tour_single_content_style' ) == 'list' ) ) {
			$classes[] = ' no-header-sticky';
		}
	}
	$travel_body_custom_class = travelwp_get_option('travel_body_custom_class');
	if (isset($travel_body_custom_class) && !empty($travel_body_custom_class)) {
		$classes[] = travelwp_get_option('travel_body_custom_class');
	}

	return $classes;
}

add_filter( 'body_class', 'travelwp_body_classes' ); 