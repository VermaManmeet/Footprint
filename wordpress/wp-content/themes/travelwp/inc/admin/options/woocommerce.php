<?php
Redux::set_section( $opt_name, array(
	'title'  => esc_html__( 'Woo Settings', 'travelwp' ),
	'id'     => 'woo_setting',
	'icon'   => 'el el-shopping-cart',
	'fields' => array(
		array(
			'id'    => 'info_woo_cat',
			'type'  => 'info',
			'class' => 'margin-btn-30 hide' . travelwp_theme_options_extral_class('archive-product', array('all', 'post_page')),
			'desc'  => sprintf(__('This Product is built by Thim Elementor Kit, you can edit and configure it in %s.', 'travelwp'), '<a href="' . admin_url('edit.php?post_type=thim_elementor_kit&thim_elementor_type=archive-product') . '" target="_blank">' . __('Thim Elementor Kit', 'travelwp') . '</a>'),
		),

		array(
			'id'    => 'info_woo_single',
			'type'  => 'info',
			'class' => 'hide' . travelwp_theme_options_extral_class('single-product'),
			'desc'  => sprintf(__('This Single Product is built by Thim Elementor Kit, you can edit and configure it in %s.', 'travelwp'), '<a href="' . admin_url('edit.php?post_type=thim_elementor_kit&thim_elementor_type=single-product') . '" target="_blank">' . __('Thim Elementor Kit', 'travelwp') . '</a>'),
		),
		array(
			'id'      => 'column_product',
			'type'    => 'select',
			'title'   => esc_html__( 'Column', 'travelwp' ),
			'class'   => travelwp_theme_options_extral_class('archive-product', array('all', 'post_page')),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4'
			),
			'default' => '3',
			'select2' => array( 'allowClear' => false )
		),
		array(
			'title'   => esc_html__( 'Number of Products/Tours per Page', 'travelwp' ),
			'id'      => 'woo_product_per_page',
			'type'    => 'spinner',
			'desc'    => esc_html__( 'Insert the number of posts to display per page.', 'travelwp' ),
			'default' => '9',
			'max'     => '100',
		),
	)
) );

Redux::set_section( $opt_name, array(
	'title'      => esc_html__( 'Archive Product', 'travelwp' ),
	'id'         => 'archive_woo_setting',
	'class'   => travelwp_theme_options_extral_class('archive-product', array('all', 'post_page')),
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'woo_cate_layout',
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
			'id'       => 'phys_woo_cate_hide_title',
			'type'     => 'checkbox',
			'subtitle' => esc_html__( 'Check this box to hide/unhide title' . 'travelwp' ),
			'default'  => false,
		),
		array(
			'title'    => esc_html__( 'Hide Breadcrumbs?', 'travelwp' ),
			'id'       => 'phys_woo_cate_hide_breadcrumbs',
			'default'  => 0,
			'type'     => 'checkbox',
			'subtitle' => esc_html__( 'Check this box to hide/unhide breadcrumbs', 'travelwp' ),
		),
		array(
			'title' => esc_html__( 'Background Heading', 'travelwp' ),
			'id'    => 'phys_woo_cate_top_image',
			'type'  => 'media',
			'desc'  => esc_html__( 'Enter URL or Upload an background heading file for header', 'travelwp' ),
		),
		array(
			'title'   => esc_html__( 'Background Heading Color', 'travelwp' ),
			'id'      => 'phys_woo_cate_heading_bg_color',
			'type'    => 'color_rgba',
			'default' => array(
				'color' => '#000',
				'alpha' => '1'
			),
		),
		array(
			'title'       => esc_html__( 'Text Color Heading', 'travelwp' ),
			'id'          => 'phys_woo_cate_heading_text_color',
			'type'        => 'color',
			'transparent' => false,
			'default'     => '#fff',
		),
	)
) );

Redux::set_section( $opt_name, array(
	'title'      => esc_html__( 'Single Product', 'travelwp' ),
	'id'         => 'single_woo_setting',
	'class'      => travelwp_theme_options_extral_class('single-product'),
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'woo_single_layout',
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
			'title'    => esc_html__( 'Hide Related Product', 'travelwp' ),
			'id'       => 'phys_woo_single_related_product',
			'type'     => 'checkbox',
			'subtitle' => esc_html__( 'Check this box to hide/show related Product', 'travelwp' ),
			'default'  => false,
		),
		array(
			'title'    => esc_html__( 'Hide Title', 'travelwp' ),
			'id'       => 'phys_woo_single_hide_title',
			'type'     => 'checkbox',
			'subtitle' => esc_html__( 'Check this box to hide/unhide title', 'travelwp' ),
			'default'  => 0,
		),
		array(
			'title'    => esc_html__( 'Hide Breadcrumbs?', 'travelwp' ),
			'id'       => 'phys_woo_single_hide_breadcrumbs',
			'default'  => 0,
			'type'     => 'checkbox',
			'subtitle' => esc_html__( 'Check this box to hide/unhide breadcrumbs', 'travelwp' ),
		),
		array(
			'title' => esc_html__( 'Background Heading', 'travelwp' ),
			'id'    => 'phys_woo_single_top_image',
			'type'  => 'media',
			'desc'  => esc_html__( 'Enter URL or Upload an background heading file for header', 'travelwp' ),
		),
		array(
			'title'   => esc_html__( 'Background Heading Color', 'travelwp' ),
			'id'      => 'phys_woo_single_heading_bg_color',
			'type'    => 'color_rgba',
			'default' => array(
				'color' => '#000',
				'alpha' => '1'
			),
		),
		array(
			'title'       => esc_html__( 'Text Color Heading', 'travelwp' ),
			'id'          => 'phys_woo_single_heading_text_color',
			'type'        => 'color',
			'transparent' => false,
			'default'     => '#fff',
		),
	)
) );
