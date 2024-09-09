<?php
$pattern_url = get_template_directory_uri() . '/images/patterns/';

Redux::set_section( $opt_name, array(
	'title'  => esc_html__( 'Styling', 'travelwp' ),
	'icon'   => 'el el-icon-pencil',
	'fields' => array(
		array(
			"title" => esc_html__( "Preloading", "travelwp" ),
			"type"  => "switch",
			"id"    => "show_preload",
			"std"   => 1,
			"on"    => esc_html__( "show", "travelwp" ),
			"off"   => esc_html__( "hide", "travelwp" ),
		),
		array(
			'id'      => 'box_layout',
			'type'    => 'select',
			'title'   => esc_html__( 'Layout', 'travelwp' ),
			'options' => array(
				'boxed' => esc_html__( 'Boxed', 'travelwp' ),
				'wide'  => esc_html__( 'Wide', 'travelwp' ),
			),
			'default' => 'wide',
			'select2' => array( 'allowClear' => false )
		),
		array(
			'id'       => 'background_pattern',
			'type'     => 'image_select',
			'title'    => esc_html__( 'Background Pattern', 'travelwp' ),
			'subtitle' => esc_html__( 'select background pattern', 'travelwp' ),
			'options'  => array(
				$pattern_url . 'pattern1.jpg'  => array(
					'alt' => 'pattern1',
					'img' => $pattern_url . 'pattern1.jpg'
				),
				$pattern_url . 'pattern2.png'  => array(
					'alt' => 'pattern2',
					'img' => $pattern_url . 'pattern2.png'
				),
				$pattern_url . 'pattern3.png'  => array(
					'alt' => 'pattern3',
					'img' => $pattern_url . 'pattern3.png'
				),
				$pattern_url . 'pattern4.png'  => array(
					'alt' => 'pattern4',
					'img' => $pattern_url . 'pattern4.png'
				),
				$pattern_url . 'pattern5.png'  => array(
					'alt' => 'pattern5',
					'img' => $pattern_url . 'pattern5.png'
				),
				$pattern_url . 'pattern6.png'  => array(
					'alt' => 'pattern6',
					'img' => $pattern_url . 'pattern6.png'
				),
				$pattern_url . 'pattern7.png'  => array(
					'alt' => 'pattern7',
					'img' => $pattern_url . 'pattern7.png'
				),
				$pattern_url . 'pattern8.png'  => array(
					'alt' => 'pattern8',
					'img' => $pattern_url . 'pattern8.png'
				),
				$pattern_url . 'pattern9.png'  => array(
					'alt' => 'pattern9',
					'img' => $pattern_url . 'pattern9.png'
				),
				$pattern_url . 'pattern10.png' => array(
					'alt' => 'pattern10',
					'img' => $pattern_url . 'pattern10.png'
				),
			),
		),
		array(
			'id'          => 'body_background',
			'type'        => 'background',
			'color'       => false,
			'title'       => esc_html__( 'Body Background', 'travelwp' ),
			'subtitle'    => esc_html__( 'Body background with image, color, etc.', 'travelwp' ),
			'transparent' => false,
			'default'     => array(
				'background-color' => '#f2f2f2'
			),
		),
		array(
			'id'          => 'body_color_primary',
			'type'        => 'color',
			'title'       => esc_html__( 'Theme Primary Color', 'travelwp' ),
			'default'     => '#ffb300',
			'transparent' => false
		),
		array(
			'id'          => 'body_color_second',
			'type'        => 'color',
			'title'       => esc_html__( 'Theme Second Color', 'travelwp' ),
			'default'     => '#26BDF7',
			'transparent' => false
		),
	)
) );