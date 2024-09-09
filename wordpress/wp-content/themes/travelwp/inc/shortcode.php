<?php
if ( class_exists( 'WooCommerce' ) ) {
	WC_Post_types::register_taxonomies();
}
if ( ! function_exists( 'travelwp_vc_map_add_css_animation' ) ) {
	function travelwp_vc_map_add_css_animation( $label = true ) {
		$data = array(
			'type'        => 'animation_style',
			'heading'     => __( 'CSS Animation', 'travelwp' ),
			'param_name'  => 'css_animation',
			'admin_label' => $label,
			'value'       => '',
			'settings'    => array(
				'type'   => 'in',
				'custom' => array(
					array(
						'label'  => __( 'Default', 'travelwp' ),
						'values' => array(
							__( 'Top to bottom', 'travelwp' )      => 'top-to-bottom',
							__( 'Bottom to top', 'travelwp' )      => 'bottom-to-top',
							__( 'Left to right', 'travelwp' )      => 'left-to-right',
							__( 'Right to left', 'travelwp' )      => 'right-to-left',
							__( 'Appear from center', 'travelwp' ) => 'appear',
						),
					),
				),
			),
			'description' => __( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'travelwp' ),
		);


		return apply_filters( 'travelwp_vc_map_add_css_animation', $data, $label );
	}
}

if ( ! function_exists( 'travelwp_getCSSAnimation' ) ) {
	function travelwp_getCSSAnimation( $css_animation ) {
		$output = '';
		if ( '' !== $css_animation && 'none' !== $css_animation ) {
			wp_enqueue_script( 'vc_waypoints' );
			wp_enqueue_style( 'vc_animate-css' );
			$output = ' wpb_animate_when_almost_visible wpb_' . $css_animation . ' ' . $css_animation;
		}

		return $output;
	}
}

// Link to shortcodes
require_once get_template_directory() . '/inc/shortcode/heading.php';
require_once get_template_directory() . '/inc/shortcode/icon_box.php';
require_once get_template_directory() . '/inc/shortcode/social-links.php';
require_once get_template_directory() . '/inc/shortcode/list-posts.php';
require_once get_template_directory() . '/inc/shortcode/deals-discounts.php';
require_once get_template_directory() . '/inc/shortcode/counter.php';
require_once get_template_directory() . '/inc/shortcode/list-info.php';
require_once get_template_directory() . '/inc/shortcode/gallery.php';
require_once get_template_directory() . '/inc/shortcode/banner-typed.php';

if ( class_exists( 'TravelBookingPhyscode' ) && class_exists( 'WooCommerce' ) ) {
	add_action( 'init', 'travelwp_register_shortcode' );
	function travelwp_register_shortcode() {
		require_once get_template_directory() . '/inc/shortcode/list-tours.php';
		require_once get_template_directory() . '/inc/shortcode/tours_review.php';
		require_once get_template_directory() . '/inc/shortcode/search_tour.php';
		require_once get_template_directory() . '/inc/shortcode/list-attributes.php';
	}
}

// register short code
if ( function_exists( 'Register_Physcode_Vc_Addon' ) ) {
	Register_Physcode_Vc_Addon(
		'travelwp',
		array(
			'heading',
			'icon_box',
			'social_link',
			'list_posts',
			'deals_discounts',
			'counter',
			'list_info',
			'list_tours',
			'tours_review',
			'booking_tour',
			'phys_gallery',
			'show_tours_of_attribute_woo',
			'banner_typed'
		)
	);
}

add_filter( 'phys_register_shortcode', 'travelwp_register_elements' );

if ( ! function_exists( 'travelwp_register_elements' ) ) {
	/**
	 * @param $elements
	 *
	 * @return array prefix and element
	 *
	 */
	function travelwp_register_elements() {

		// elements want to add
		$elements = array(
			'travelwp' => array(
				'heading',
				'icon_box',
				'social_link',
				'list_posts',
				'deals_discounts',
				'counter',
				'list_info',
				'list_tours',
				'tours_review',
				'booking_tour',
				'phys_gallery',
				'show_tours_of_attribute_woo',
				'banner_typed',
				'itinerary'
			)
		);

		return $elements;
	}
}
