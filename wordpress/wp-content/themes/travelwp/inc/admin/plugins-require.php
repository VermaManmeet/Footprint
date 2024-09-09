<?php
function travelwp_register_required_plugins( $plugins ) {
	$plugins = array(
		array(
			'name'        => esc_html__( 'Contact Form 7', 'travelwp' ),
			'slug'        => 'contact-form-7',
			'required'    => false,
			'description' => 'Just another contact form plugin. Simple but flexible'
		),
		// array(
		// 	'name'        => esc_html__( 'Easy Peasy MailChimp Ajax Form', 'travelwp' ),
		// 	'slug'        => 'easy-peasy-mailchimp-ajax-form',
		// 	'required'    => false,
		// 	'premium'     => true,
		// 	'description' => 'Easy Peasy MailChimp allows you to easily include an ajax powered mailchimp newsletter signup form into your website through widget or shortcode',
		// 	'icon'        => 'https://updates.physcode.com/wp-content/uploads/2023/11/easy-peasy-mailchimp-ajax-form.jpg',
		// ),
		array(
			'name'        => esc_html__( 'Redux Framework', 'travelwp' ),
			'slug'        => 'redux-framework',
			'required'    => true,
			'description' => 'Build better sites in WordPress fast!'
		),
		array(
			'name'        => esc_html__( 'WooCommerce', 'travelwp' ),
			'slug'        => 'woocommerce',
			'required'    => true,
			'description' => 'An eCommerce toolkit that helps you sell anything. Beautifully.',
			'icon'        => 'https://ps.w.org/woocommerce/assets/icon-256x256.gif'
		),
		array(
			'name'        => esc_html__( 'Instagram Feed', 'travelwp' ),
			'slug'        => 'instagram-feed',
			'required'    => false,
			'description' => 'Display beautifully clean, customizable, and responsive Instagram feeds.'
		),
		array(
			'name'        => esc_html__( 'Revolution Slider', 'travelwp' ),
			'slug'        => 'revslider',
			'required'    => false,
			'premium'     => true,
			'icon'        => 'https://plugins.thimpress.com/downloads/images/revslider.png',
			'description' => 'Slider Revolution - More than just a WordPress Slider'
		),
		array(
			'name'        => esc_html__( 'WPBakery', 'travelwp' ),
			'slug'        => 'js_composer',
			'premium'     => true,
			'icon'        => 'https://s3.envato.com/files/260579516/wpb-logo.png',
			'required'    => false,
			'description' => 'Drag and drop page builder for WordPress. Take full control over your WordPress site, build any layout you can imagine – no programming knowledge required.'
		),
		array(
			'name'        => esc_html__( 'Travel booking', 'travelwp' ),
			'slug'        => 'travel-booking',
			'premium'     => true,
			'required'    => true,
			'description' => 'Option for Tour',
			'icon'        => 'https://updates.physcode.com/wp-content/uploads/2023/12/travelbooking.jpg'
		),
		array(
			'name'     => esc_html__( 'Elementor', 'travelwp' ),
			'slug'     => 'elementor',
			'required' => false,
		),

		array(
			'name'     => esc_html__( 'Thim Elementor Kit', 'travelwp' ),
			'slug'     => 'thim-elementor-kit',
			'required' => false,
		),
		array(
			'name'     => esc_html__('MC4WP: Mailchimp for WordPress', 'travelwp'),
			'slug'     => 'mailchimp-for-wp',
			'required' => false,
			'icon'    => 'https://ps.w.org/mailchimp-for-wp/assets/icon-256x256.png'
		),

	);

	return $plugins;
}

add_filter( 'phys_core_get_all_plugins_require', 'travelwp_register_required_plugins' );
