<?php
$url_image_preview  = 'https://physcodewp.github.io/demo-data/travelwp/images';
$plugin_required    = array(
	'redux-framework',
	'woocommerce',
	'contact-form-7',
	//	'meta-box',
	'mailchimp-for-wp',
	'travel-booking'
);
$plugin_required_vc = array( 
	'js_composer'
);
$plugin_required_el = array(
	'elementor',
	'thim-elementor-kit'
);
$revolution         = array(
	'revslider'
);
return array(
	'demo-vc/home-1' => array(
		'title'            => 'Home 1 – Video Slider',
		'demo_url'         => 'https://travelwp.physcode.com/',
		'default_content'  => false,
		'plugins_required' => array_merge( $plugin_required, $revolution, $plugin_required_vc ),
		'thumbnail_url'    => $url_image_preview . '/home-1.jpg',
		'revsliders'       => array(
			'video_slider.zip'
		),
	),
	'demo-vc/home-2' => array(
		'title'            => 'Home 2 – Image Slider',
		'demo_url'         => 'https://travelwp.physcode.com/home-2/',
		'default_content'  => false,
		'plugins_required' => array_merge( $plugin_required, $revolution, $plugin_required_vc ),
		'thumbnail_url'    => $url_image_preview . '/home-2.png',
		'revsliders'       => array(
			'slider-home.zip'
		),
	),
	'demo-vc/home-3' => array(
		'title'            => 'Home 3 – Background Image',
		'demo_url'         => 'https://travelwp.physcode.com/home-3/',
		'default_content'  => false,
		'plugins_required' => array_merge( $plugin_required, $plugin_required_vc ),
		'thumbnail_url'    => $url_image_preview . '/home-3.png',
	),
	'demo-vc/home-4' => array(
		'title'            => 'Home 4',
		'demo_url'         => 'https://travelwp.physcode.com/home-4/',
		'default_content'  => false,
		'plugins_required' => array_merge( $plugin_required, $plugin_required_vc ),
		'thumbnail_url'    => $url_image_preview . '/home-4.png',
	),

	'demo-el/home-1' => array(
		'title'            => 'Home 1 – Video Slider',
		'demo_url'         => 'https://travelwp.physcode.com/demo-el/',
		'default_content'  => false,
		'plugins_required' => array_merge( $plugin_required, $revolution, $plugin_required_el ),
		'thumbnail_url'    => $url_image_preview . '/home-1.jpg',
		'revsliders'       => array(
			'video_slider.zip'
		),
	),
	'demo-el/home-2' => array(
		'title'            => 'Home 2 – Image Slider',
		'demo_url'         => 'https://travelwp.physcode.com/demo-el/home-2/',
		'default_content'  => false,
		'plugins_required' => array_merge( $plugin_required, $revolution, $plugin_required_el ),
		'thumbnail_url'    => $url_image_preview . '/home-2.png',
		'revsliders'       => array(
			'slider-home.zip'
		),
	),
	'demo-el/home-3' => array(
		'title'            => 'Home 3 – Background Image',
		'demo_url'         => 'https://travelwp.physcode.com/demo-el/home-3/',
		'default_content'  => false,
		'plugins_required' => array_merge( $plugin_required, $plugin_required_el ),
		'thumbnail_url'    => $url_image_preview . '/home-3.png',
	),
	'demo-el/home-4' => array(
		'title'            => 'Home 4',
		'demo_url'         => 'https://travelwp.physcode.com/home-4-el/',
		'default_content'  => false,
		'plugins_required' => array_merge( $plugin_required, $plugin_required_el ),
		'thumbnail_url'    => $url_image_preview . '/home-4.png',
	),
	'demo-el/home-5' => array(
		'title'            => 'Home 5',
		'demo_url'         => 'https://travelwp.physcode.com/main-demo',
		'default_content'  => false,
		'plugins_required' => array_merge($plugin_required, $plugin_required_el),
		'thumbnail_url'    => $url_image_preview . '/home-5.png',
	),
);
