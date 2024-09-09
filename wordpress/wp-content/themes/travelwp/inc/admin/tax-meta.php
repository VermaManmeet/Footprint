<?php
//get_template_part( 'inc/admin/Tax-meta-class/Tax-meta-class' );
if ( is_admin() && class_exists( 'Tax_Meta_Class' ) ) {
	if ( class_exists( 'WooCommerce' ) ) {
		WC_Post_types::register_taxonomies();
	}
	$prefix = 'phys_';

	function travelwp_my_meta( $my_meta ) {
		$prefix = 'phys_';
		$my_meta->addSelect(
			$prefix . 'layout', array(
			''              => esc_html__( 'Using in Theme Option', 'travelwp' ), 
			'full-content'  => esc_html__( 'No Sidebar', 'travelwp' ),
			'sidebar-left'  => esc_html__( 'Left Sidebar', 'travelwp' ),
			'sidebar-right' => esc_html__( 'Right Sidebar', 'travelwp' )
		),
			array( 'name' => esc_html__( 'Custom Layout ', 'travelwp' ), 'std' => array( '' ) )
		);
		$my_meta->addSelect(
			$prefix . 'custom_heading', array(
			''       => esc_html__( 'Using in Theme Option', 'travelwp' ),
			'custom' => esc_html__( 'Custom', 'travelwp' ),
		), array( 'name' => esc_html__( 'Custom Heading ', 'travelwp' ), 'std' => array( '' ), 'class' => 'toggle_custom' )
		);
		$my_meta->addImage( $prefix . 'cate_top_image', array( 'name' => esc_html__( 'Heading Background Image', 'travelwp' ), 'class' => 'show_custom' ) );
		$my_meta->addColor( $prefix . 'cate_heading_bg_color', array( 'name' => esc_html__( 'Heading Background Color', 'travelwp' ), 'class' => 'show_custom' ) );
		$my_meta->addColor( $prefix . 'cate_heading_text_color', array( 'name' => esc_html__( 'Heading Text Color', 'travelwp' ), 'class' => 'show_custom' ) );
		$my_meta->addCheckbox( $prefix . 'cate_hide_title', array( 'name' => esc_html__( 'Hide Title', 'travelwp' ), 'class' => 'show_custom' ) );
		$my_meta->addCheckbox( $prefix . 'cate_hide_breadcrumbs', array( 'name' => esc_html__( 'Hide Breadcrumbs?', 'travelwp' ), 'class' => 'show_custom' ) );
	}

	/*
		  * configure your meta box
		  */
	$config = array(
		'id'             => 'category__meta_box',
		// meta box id, unique per meta box
		'title'          => 'Category Meta Box',
		// meta box title
		'pages'          => array( 'category', 'post_tag', 'product_cat' ),
		// taxonomy name, accept categories, post_tag and custom taxonomies
		'context'        => 'normal',
		// where the meta box appear: normal (default), advanced, side; optional
		'fields'         => array(),
		// list of meta fields (can be added by field arrays)
		'local_images'   => false,
		// Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => false
		//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);

	$my_meta_post = new Tax_Meta_Class( $config );
	if (travelwp_theme_options_extral_class('archive-product', array('all', 'post_page')) != ' hidden') {
		travelwp_my_meta( $my_meta_post );
	}
	/*Add custom style*/
	$my_meta_post->Finish();

	// tour type
	$tour_type_config = array(
		'id'             => 'tour_type_meta_box',
		// meta box id, unique per meta box
		'title'          => 'Tour Type Meta Box',
		// meta box title
		'pages'          => array( 'tour_phys', 'hotel-taxonomy' ),
		// taxonomy name, accept categories, post_tag and custom taxonomies
		'context'        => 'normal',
		// where the meta box appear: normal (default), advanced, side; optional
		'fields'         => array(),
		// list of meta fields (can be added by field arrays)
		'local_images'   => false,
		// Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => false
		//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);

	$tour_type_meta = new Tax_Meta_Class( $tour_type_config );
	//	$tour_type_meta->addImage( $prefix . 'tour_type_thumb', array( 'name' => esc_html__( 'Thumbnail Image', 'travelwp' ) ) );
	$tour_type_meta->addIcon( $prefix . 'tour_type_icon', array( 'name' => esc_html__( 'Select Icon', 'travelwp' ) ) );
	$tour_type_meta->addImage( $prefix . 'tour_type_image_icon', array( 'name' => esc_html__( 'Custom Image Icon', 'travelwp' ) ) );
	if(travelwp_theme_options_extral_class('archive-tour', array('all', 'post_page')) != ' hidden'){
		$tour_type_meta->addSelect(
			$prefix . 'layout_content',
			array(
				''     => esc_html__('Using in Theme Option', 'travelwp'),
				'list' => esc_html__('List', 'travelwp'),
				'grid' => esc_html__('Grid', 'travelwp'),
			),
			array('name' => esc_html__('Custom Layout content', 'travelwp'), 'std' => array(''), 'class' => 'toggle_gird_custom')
		);
		$tour_type_meta->addSelect(
			$prefix . 'item_style',
			array(
				''        => esc_html__('Using in Theme Option', 'travelwp'),
				'style_1' => esc_html__('Style 1', 'travelwp'),
				'style_2' => esc_html__('Style 2', 'travelwp'),
			),
			array('name' => esc_html__('Custom Style content', 'travelwp'), 'std' => array(''), 'class' => 'show_column_custom')
		);
		$tour_type_meta->addSelect(
			$prefix . 'layout_content_column',
			array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
			),
			array('name' => esc_html__('Custom Layout content', 'travelwp'), 'std' => array(''), 'class' => 'show_column_custom')
		);
		travelwp_my_meta($tour_type_meta);
	}
	
	$tour_type_meta->Finish();


	// attribute
	$taxonomies    = get_object_taxonomies( 'product', 'objects' ); 
	$attribute_arr = array();
 	if ( empty( $taxonomies ) ) {
		return '';
	}

	foreach ( $taxonomies as $tax ) {
		$tax_name  = $tax->name;
		$tax_label = $tax->label;
		if ( 0 !== strpos( $tax_name, 'pa_' ) ) {
			continue;
		}
		if ( ! in_array( $tax_name, $attribute_arr ) ) {
			$attribute_arr[$tax_name] = $tax_name;
		}
	}

	$attribute_config = array(
		'id'             => 'tour_type_meta_box',
		// meta box id, unique per meta box
		'title'          => 'Tour Type Meta Box',
		// meta box title
		'pages'          => $attribute_arr,
		//'pages'          => array( 'pa_destination' ),
		// taxonomy name, accept categories, post_tag and custom taxonomies
		'context'        => 'normal',
		// where the meta box appear: normal (default), advanced, side; optional
		'fields'         => array(),
		// list of meta fields (can be added by field arrays)
		'local_images'   => false,
		// Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => false
		//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);

	$attribute_meta = new Tax_Meta_Class( $attribute_config );
	if (class_exists('Thim_EL_Kit')) {
		$attribute_meta->addTextarea($prefix . 'destination_content', array('name' => esc_html__('Shortcode Content', 'travelwp')));
	}
	if (travelwp_theme_options_extral_class('archive-tour', array( 'all','woo_attributes')) != ' hidden') {
		$attribute_meta->addSelect(
			$prefix . 'destination_custom_heading',
			array(
				''       => esc_html__('Using in Theme Option', 'travelwp'),
				'custom' => esc_html__('Custom', 'travelwp'),
			),
			array('name' => esc_html__('Custom Heading ', 'travelwp'), 'std' => array(''), 'class' => 'toggle_custom')
		);
		$attribute_meta->addImage( $prefix . 'destination_top_image', array( 'name' => esc_html__( 'Heading Background Image', 'travelwp' ), 'class' => 'show_custom' ) );
		$attribute_meta->addColor( $prefix . 'destination_heading_bg_color', array( 'name' => esc_html__( 'Heading Background Color', 'travelwp' ), 'class' => 'show_custom' ) );
		$attribute_meta->addColor( $prefix . 'destination_heading_text_color', array( 'name' => esc_html__( 'Heading Text Color', 'travelwp' ), 'class' => 'show_custom' ) );
		$attribute_meta->addCheckbox( $prefix . 'destination_hide_title', array( 'name' => esc_html__( 'Hide Title', 'travelwp' ), 'class' => 'show_custom' ) );
		$attribute_meta->addCheckbox( $prefix . 'destination_hide_breadcrumbs', array( 'name' => esc_html__( 'Hide Breadcrumbs?', 'travelwp' ), 'class' => 'show_custom' ) );
		
	}
	$attribute_meta->addImage($prefix . 'tour_type_thumb', array('name' => esc_html__('Thumbnail Image', 'travelwp')));
	$attribute_meta->addColor($prefix . 'text_color', array('name' => esc_html__('Text Color', 'travelwp')));
	$attribute_meta->addText($prefix . 'custom_link', array('name' => esc_html__('Custom Link', 'travelwp')));
	//$attribute_meta->addIcon( $prefix . 'tour_type_icon', array( 'name' => esc_html__( 'Select Icon', 'travelwp' ) ) );
	$attribute_meta->Finish();
}

if ( ! class_exists( 'Tax_Meta_Class' ) ) { 
	if ( ! function_exists( 'get_tax_meta' ) ) {
		function get_tax_meta( $term_id, $key, $multi = false ) {
			$t_id = ( is_object( $term_id ) ) ? $term_id->term_id : $term_id; 
			$m    = get_option( 'tax_meta_' . $t_id );
			if ( isset( $m[$key] ) ) {
				return $m[$key];
			} else {
				return '';
			}
		}
	}
}
