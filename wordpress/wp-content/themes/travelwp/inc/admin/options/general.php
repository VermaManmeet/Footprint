<?php
$logo = get_template_directory_uri( 'template_directory' ) . '/images/';
// -> START Media Uploads

Redux::set_section( $opt_name, array(
	'title'  => esc_html__( 'General Settings', 'travelwp' ),
	'id'     => 'general_settings',
	'icon'   => 'el el-cogs',
	'fields' => array(
		array(
			'id'    => 'info_header',
			'type'  => 'info',
			'style' => 'info',
			'class' =>  'margin-btn-30 hide '.travelwp_theme_options_extral_class('header'),
			'desc'  => sprintf(__('This Header is built by Thim Elementor Kit, you can edit and configure it in %s.', 'travelwp'), '<a href="' . admin_url('edit.php?post_type=thim_elementor_kit&thim_elementor_type=header') . '" target="_blank">' . __('Thim Elementor Kit', 'travelwp') . '</a>'),
		),
		array(
			'id'      => 'travelwp_logo',   
			'type'    => 'media',
			'title'   => esc_html__( 'Header Logo', 'travelwp' ), 
			'desc'    => esc_html__( 'Enter URL or Upload an image file as your logo.', 'travelwp' ),
			'default' => array( 'url' => $logo . 'logo.png' ),
			'class' =>  travelwp_theme_options_extral_class('header'),
		),
		array(
			'id'      => 'travelwp_sticky_logo',
			'type'    => 'media',
			'title'   => esc_html__( 'Sticky Header Logo', 'travelwp' ),
			'desc'    => esc_html__( 'Enter URL or Upload an image file as your sticky logo.', 'travelwp' ),
			'default' => array( 'url' => $logo . 'logo_sticky.png' ),
			'class' => travelwp_theme_options_extral_class('header'),
		),
		array(
			'id'      => 'transparent_menu_home',
			'type'    => 'switch',
			'title'   => esc_html__( 'Transparent menu home page', 'travelwp' ),
			'default' => 0,
			'on'      => 'Yes',
			'off'     => 'No',
			'class' => travelwp_theme_options_extral_class('header'),
		),
		array(
			'id'       => 'logo_home_page',
			'type'     => 'media',
			'title'    => esc_html__( 'Logo Menu transparent', 'travelwp' ),
			'required' => array( 'transparent_menu_home', '=', '1' ),
			'class' =>  travelwp_theme_options_extral_class('header'),
		),
		array(
			'id'          => 'text_home_page',
			'type'        => 'color',
			'title'       => esc_html__( 'Text Color Menu transparent', 'travelwp' ),
			'default'     => '#fff',
			'transparent' => false,
			'required'    => array( 'transparent_menu_home', '=', '1' ),
			'class' =>  travelwp_theme_options_extral_class('header'),
		),
		array(
			'id'      => 'width_logo',
			'type'    => 'spinner',
			'title'   => esc_html__( 'Width logo', 'travelwp' ),
			'default' => '100',
			'min'     => '1',
			'step'    => '1',
			'max'     => '500',
			'class' =>  travelwp_theme_options_extral_class('header'),
		),
		array(
			'id'      => 'width_logo_mobile',
			'type'    => 'spinner',
			'title'   => esc_html__( 'Width logo mobile', 'travelwp' ),
			'default' => '100',
			'min'     => '1',
			'step'    => '1',
			'max'     => '500',
			'class' =>  travelwp_theme_options_extral_class('header'),
		),

		array(
			'id'      => 'disable_gutenberg',
			'type'    => 'switch',
			'title'   => esc_html__( 'Gutenberg on Widget', 'travelwp' ),
			'default' => 0,
			'on'      => 'Enable',
			'off'     => 'Disable',
		),
		array(
			'id'      => 'travel_body_custom_class',
			'type'    => 'text',
			'title'   => esc_html__('Body Custom Class', 'travelwp'),
		),	
 	)
) );



