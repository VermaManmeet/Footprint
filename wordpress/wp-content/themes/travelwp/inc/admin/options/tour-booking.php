<?php
Redux::set_section( $opt_name, array(
	'title' => esc_html__( 'Tour Setting', 'travelwp' ), 
	'icon'  => 'el el-calendar',
	'id'    => 'tour_setting',
	'fields' => array(
		array(
			'id'    => 'info_tour_cat', 
			'type'  => 'info',
			'class' => 'margin-btn-30 hide' . travelwp_theme_options_extral_class('archive-tour', array('all', 'post_page')),
			'desc'  => sprintf(__('This Archive Tour is built by Thim Elementor Kit, you can edit and configure it in %s.', 'travelwp'), '<a href="' . admin_url('edit.php?post_type=thim_elementor_kit&thim_elementor_type=archive-tour') . '" target="_blank">' . __('Thim Elementor Kit', 'travelwp') . '</a>'),
		),

		array(
			'id'    => 'info_tour_single',
			'type'  => 'info',
			'class' => 'hide' . travelwp_theme_options_extral_class('single-tour'),
			'desc'  => sprintf(__('This Single Tour is built by Thim Elementor Kit, you can edit and configure it in %s.', 'travelwp'), '<a href="' . admin_url('edit.php?post_type=thim_elementor_kit&thim_elementor_type=single-tour') . '" target="_blank">' . __('Thim Elementor Kit', 'travelwp') . '</a>'),
		),
	)
) );

Redux::set_section( $opt_name, array(
	'title'      => esc_html__( 'Archive Tour', 'travelwp' ), 
	'id'         => 'archive_tour_setting',
	'class'      => travelwp_theme_options_extral_class('archive-tour', array('all', 'post_page')),
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'phys_tour_layout_content',
			'type'    => 'select',
			'title'   => esc_html__( 'Layout content', 'travelwp' ), 
			'options' => array(
				'list' => esc_html__( 'List', 'travelwp' ),
				'grid' => esc_html__( 'Grid', 'travelwp' ),
			),
			'default' => 'grid',
		),
		array(
			'id'       => 'phys_style_item_tour',
			'type'     => 'select',
			'title'    => esc_html__( 'Content Style', 'travelwp' ),
			'options'  => array(
				'style_1' => esc_html__( 'Style 1', 'travelwp' ),
				'style_2' => esc_html__( 'Style 2', 'travelwp' ),
			),
			'required' => array( 'phys_tour_layout_content', '=', 'grid' ),
			'default'  => 'style_1',
			'select2'  => array( 'allowClear' => false )
		),
		array(
			'id'       => 'column_tour',
			'type'     => 'select',
			'title'    => esc_html__( 'Column', 'travelwp' ),
			'options'  => array(
				'2' => '2',
				'3' => '3',
				'4' => '4'
			),
			'required' => array( 'phys_tour_layout_content', '=', 'grid' ),
			'default'  => '3',
			'select2'  => array( 'allowClear' => false )
		),

		array(
			'id'      => 'phys_tour_cate_layout',
			'type'    => 'image_select',
			'title'   => esc_html__( 'Select Layout Default', 'travelwp' ),
			'options' => array(
				'full-content'  => array(
					'alt' => 'body-full',
					'img' => get_template_directory_uri() . '/images/layout/body-full.png'
				),
				'sidebar-left'  => array(
					'alt' => 'sidebar-left',
					'img' => get_template_directory_uri() . '/images/layout/sidebar-left.png'
				),
				'sidebar-right' => array(
					'alt' => 'sidebar-right',
					'img' => get_template_directory_uri() . '/images/layout/sidebar-right.png'
				),
			),
			'default' => 'sidebar-left'
		),
		array(
			'title'    => esc_html__( 'Hide Title', 'travelwp' ),
			'id'       => 'phys_tour_cate_hide_title',
			'type'     => 'checkbox',
			'subtitle' => esc_html__( 'Check this box to hide/unhide title', 'travelwp' ),
			'default'  => false,
		),
		array(
			'id'      => 'phys_tour_cate_description',
			'type'    => 'text',
			'title'   => esc_html__('Description', 'travelwp'),
			'subtitle' => esc_html__('The description is not prominent by default; however, some themes may show it.', 'travelwp'),
		),	
		array(
			'title'    => esc_html__( 'Hide Breadcrumbs?', 'travelwp' ),
			'id'       => 'phys_tour_cate_hide_breadcrumbs',
			'default'  => 0,
			'type'     => 'checkbox',
			'subtitle' => esc_html__( 'Check this box to hide/unhide breadcrumbs', 'travelwp' ),
		),
		array(
			'title' => esc_html__( 'Background Heading', 'travelwp' ),
			'id'    => 'phys_tour_cate_top_image',
			'type'  => 'media',
			'desc'  => esc_html__( 'Enter URL or Upload an background heading file for header', 'travelwp' ),
		),
		array(
			'title'   => esc_html__( 'Background Heading Color', 'travelwp' ),
			'id'      => 'phys_tour_cate_heading_bg_color',
			'type'    => 'color_rgba',
			'default' => array(
				'color' => '#000',
				'alpha' => '1'
			),
		),
		array(
			'title'       => esc_html__( 'Text Color Heading', 'travelwp' ),
			'id'          => 'phys_tour_cate_heading_text_color',
			'type'        => 'color',
			'transparent' => false,
			'default'     => '#fff',
		),
	)
) );

Redux::set_section( $opt_name, array(
	'title'      => esc_html__( 'Destination', 'travelwp' ),
	'id'         => 'destination_tour_setting',
	'class' => 'hide' . travelwp_theme_options_extral_class('archive-tour', array('all', 'post_page')),
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'phys_destination_layout_content',
			'type'    => 'select',
			'title'   => esc_html__( 'Layout content', 'travelwp' ),
			'options' => array(
				'list' => esc_html__( 'List', 'travelwp' ),
				'grid' => esc_html__( 'Grid', 'travelwp' ),
			),
			'default' => 'grid',
		),
		array(
			'id'       => 'phys_style_item_destination',
			'type'     => 'select',
			'title'    => esc_html__( 'Content Style', 'travelwp' ),
			'options'  => array(
				'style_1' => esc_html__( 'Style 1', 'travelwp' ),
				'style_2' => esc_html__( 'Style 2', 'travelwp' ),
			),
			'required' => array( 'phys_destination_layout_content', '=', 'grid' ),
			'default'  => 'style_1',
			'select2'  => array( 'allowClear' => false )
		),
		array(
			'id'       => 'column_destination',
			'type'     => 'select',
			'title'    => esc_html__( 'Column', 'travelwp' ),
			'options'  => array(
				'2' => '2',
				'3' => '3',
				'4' => '4'
			),
			'required' => array( 'phys_destination_layout_content', '=', 'grid' ),
			'default'  => '3',
			'select2'  => array( 'allowClear' => false )
		),
		array(
			'id'      => 'phys_tour_destination_layout',
			'type'    => 'image_select',
			'title'   => esc_html__( 'Select Layout Default', 'travelwp' ),
			'options' => array(
				'full-content'  => array(
					'alt' => 'body-full',
					'img' => get_template_directory_uri() . '/images/layout/body-full.png'
				),
				'sidebar-left'  => array(
					'alt' => 'sidebar-left',
					'img' => get_template_directory_uri() . '/images/layout/sidebar-left.png'
				),
				'sidebar-right' => array(
					'alt' => 'sidebar-right',
					'img' => get_template_directory_uri() . '/images/layout/sidebar-right.png'
				),
			),
			'default' => 'body-full'
		),
		array(
			'title'    => esc_html__( 'Hide Title', 'travelwp' ),
			'id'       => 'phys_tour_destination_hide_title',
			'type'     => 'checkbox',
			'subtitle' => esc_html__( 'Check this box to hide/unhide title', 'travelwp' ),
			'default'  => false,
		),
		array(
			'title'    => esc_html__( 'Hide Breadcrumbs?', 'travelwp' ),
			'id'       => 'phys_tour_destination_hide_breadcrumbs',
			'default'  => 0,
			'type'     => 'checkbox',
			'subtitle' => esc_html__( 'Check this box to hide/unhide breadcrumbs', 'travelwp' ),
		),
		array(
			'title' => esc_html__( 'Background Heading', 'travelwp' ),
			'id'    => 'phys_tour_destination_top_image',
			'type'  => 'media',
			'desc'  => esc_html__( 'Enter URL or Upload an background heading file for header', 'travelwp' ),
		),
		array(
			'title'   => esc_html__( 'Background Heading Color', 'travelwp' ),
			'id'      => 'phys_tour_destination_heading_bg_color',
			'type'    => 'color_rgba',
			'default' => array(
				'color' => '#000',
				'alpha' => '1'
			),
		),
		array(
			'title'       => esc_html__( 'Text Color Heading', 'travelwp' ),
			'id'          => 'phys_tour_destination_heading_text_color',
			'type'        => 'color',
			'transparent' => false,
			'default'     => '#fff',
		),
	)
) );

Redux::set_section( $opt_name, array(
	'title'      => esc_html__( 'Single Tour', 'travelwp' ),
	'id'         => 'single_tour_setting',
	'class'      => travelwp_theme_options_extral_class('single-tour'),
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'phys_tour_sticky_sidebar',
			'type'    => 'switch',
			'title'   => esc_html__( 'Sticky sidebar', 'travelwp' ),
			'default' => 0,
			'on'      => 'Enable',
			'off'     => 'Disable'
		),
		array(
			'id'      => 'phys_tour_single_content_style',
			'type'    => 'select',
			'title'   => esc_html__( 'Content Style', 'travelwp' ),
			'options' => array(
				'tab'  => esc_html__( 'Tab', 'travelwp' ),
				'list' => esc_html__( 'Scroll', 'travelwp' ),
			),
			'default' => 'tab',
			'select2' => array( 'allowClear' => false )
		),
		array(
			'title'    => esc_html__( 'Hide Category Tours', 'travelwp' ),
			'id'       => 'phys_hide_category_tour',
			'type'     => 'checkbox',
			'subtitle' => esc_html__( 'Check this box to hide/show category tour', 'travelwp' ),
			'default'  => false,
		),
		array(
			'title'    => esc_html__( 'Hide Related Tours', 'travelwp' ),
			'id'       => 'phys_hide_related_tour',
			'type'     => 'checkbox',
			'subtitle' => esc_html__( 'Check this box to hide/show related tour', 'travelwp' ),
			'default'  => false,
		),
		array(
			'title'    => esc_html__( 'Hide Title', 'travelwp' ),
			'id'       => 'phys_tour_single_hide_title',
			'type'     => 'checkbox',
			'subtitle' => esc_html__( 'Check this box to hide/unhide title', 'travelwp' ),
			'default'  => 0,
		),
		array(
			'title'    => esc_html__( 'Hide Breadcrumbs?', 'travelwp' ),
			'id'       => 'phys_tour_single_hide_breadcrumbs',
			'default'  => 0,
			'type'     => 'checkbox',
			'subtitle' => esc_html__( 'Check this box to hide/unhide breadcrumbs', 'travelwp' ),
		),
		array(
			'id'      => 'from_booking',
			'type'    => 'select',
			'title'   => esc_html__( 'Form Booking', 'travelwp' ),
			'options' => array(
				'show'         => esc_html__( 'Show Form Booking', 'travelwp' ),
				'hide'         => esc_html__( 'Hide Form Booking', 'travelwp' ),
				'both'         => esc_html__( 'Show Form Booking and Custom Form', 'travelwp' ),
				'another_from' => esc_html__( 'Show Custom Form', 'travelwp' ),
			),
			'default' => 'show',
			'select2' => array( 'allowClear' => false )
		),
		array(
			'id'    => 'another_from_shortcode',
			'type'  => 'text',
			'title' => esc_html__( 'Custom Form', 'travelwp' ),
			'desc'  => esc_html__( 'input shortcode or HTML', 'travelwp' ),

		),
		array(
			'id'       => 'layout_booking_enquiry',
			'type'     => 'select',
			'title'    => esc_html__( 'Layout Form booking and Send Enquiry', 'travelwp' ),
			'required' => array( 'from_booking', '=', 'both' ),
			'options'  => array(
				'default' => esc_html__( 'Default', 'travelwp' ),
				'tab'     => esc_html__( 'Tab', 'travelwp' )
			),
			'default'  => 'default',

		),

		array(
			'title' => esc_html__( 'Background Heading', 'travelwp' ),
			'id'    => 'phys_tour_single_top_image',
			'type'  => 'media',
			'desc'  => esc_html__( 'Enter URL or Upload an background heading file for header', 'travelwp' ),
		),
		array(
			'title'   => esc_html__( 'Background Heading Color', 'travelwp' ),
			'id'      => 'phys_tour_single_heading_bg_color',
			'type'    => 'color_rgba',
			'default' => array(
				'color' => '#000',
				'alpha' => '1'
			),
		),
		array(
			'title'       => esc_html__( 'Text Color Heading', 'travelwp' ),
			'id'          => 'phys_tour_single_heading_text_color',
			'type'        => 'color',
			'transparent' => false,
			'default'     => '#fff',
		),
	)
) );
