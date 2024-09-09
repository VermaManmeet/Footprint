<?php
add_action( 'admin_enqueue_scripts', 'phys_admin_script_meta_box' );
/**
 * Enqueue script for handling actions with meta boxes
 *
 * @return void
 * @since 1.0
 */
function phys_admin_script_meta_box() {
	wp_enqueue_style( 'travelwp_admin', get_template_directory_uri() . '/assets/css/admin.css', array(), TRAVELWP_THEME_VERSION );
	$custom_css = '#meta-box-post-format-' . get_post_format() . '{display:block}';
	wp_add_inline_style( 'travelwp_admin', $custom_css );
	wp_enqueue_script( 'travelwp-meta-box', TRAVELWP_THEME_URI . '/assets/js/admin/meta-boxes.js', array( 'jquery' ), TRAVELWP_THEME_VERSION, true );
}

if ( function_exists( 'rwmb_meta' ) ) {
	add_filter( 'rwmb_meta_boxes', 'phys_register_meta_boxes' );
} else {
	add_filter( 'phys_add_meta_boxes', 'phys_register_meta_boxes' );
}

//add_filter( 'rwmb_meta_boxes', 'phys_register_meta_boxes' );
function phys_register_meta_boxes( $meta_boxes ) {
	$meta_boxes[] = array(
		'title'      => esc_html__( 'Post Format: Gallery', 'travelwp' ),
		'id'         => 'meta-box-post-format-gallery',
		'pages'      => array( 'post' ),
		'post_types' => array( 'post' ),
		'show'       => array(
			'post_format' => array( 'gallery' ),
		),

		'fields' => array(
			array(
				'name'             => esc_html__( 'Images', 'travelwp' ),
				'id'               => '_format_gallery_images',
				'type'             => 'image_advanced',
				'max_file_uploads' => 9999,
			),
		),
	);
	$meta_boxes[] = array(
		'title'      => esc_html__( 'Post Format: Video', 'travelwp' ),
		'id'         => 'meta-box-post-format-video',
		'pages'      => array( 'post' ),
		'post_types' => array( 'post' ),
		'show'       => array(
			'post_format' => array( 'video' ),
		),
		'fields'     => array(
			array(
				'name' => esc_html__( 'Video URL or Embeded Code', 'travelwp' ),
				'id'   => '_format_video_embed',
				'type' => 'textarea',
			),
		)
	);
	$meta_boxes[] = array(
		'title'      => esc_html__( 'Post Format: Audio', 'travelwp' ),
		'id'         => 'meta-box-post-format-audio',
		'pages'      => array( 'post' ),
		'post_types' => array( 'post' ),
		'show'       => array(
			'post_format' => array( 'audio' ),
		),
		'fields'     => array(
			array(
				'name' => esc_html__( 'Audio URL or Embeded Code', 'travelwp' ),
				'id'   => '_format_audio_embed',
				'type' => 'textarea',
			),
		)
	);
	$meta_boxes[] = array(
		'title'      => esc_html__( 'Post Format: Link', 'travelwp' ),
		'id'         => 'meta-box-post-format-link',
		'pages'      => array( 'post' ),
		'post_types' => array( 'post' ),
		'show'       => array(
			'post_format' => array( 'link' ),
		),
		'fields'     => array(
			array(
				'name' => esc_html__( 'URL', 'travelwp' ),
				'id'   => '_format_link_url',
				'type' => 'textfield',
			),
			array(
				'name' => esc_html__( 'Text', 'travelwp' ),
				'id'   => '_format_link_text',
				'type' => 'textfield',
			),
		)
	);
	// Display Settings
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Display Settings', 'travelwp' ),
		'pages'  => get_post_types(), // All custom post types
		'id'     => 'display-settings',
		'fields' => array(
			array(
				'name' => esc_html__( 'Featured Title Area?', 'travelwp' ),
				'id'   => 'heading_title',
				'type' => 'heading',
			),
			array(
				'name'  => esc_html__( 'User Featured Title?', 'travelwp' ),
				'id'    => 'phys_user_featured_title',
				'type'  => 'checkbox',
				'class' => 'checkbox-toggle',

			),
			array(
				'name'   => esc_html__( 'Custom Title', 'travelwp' ),
				'id'     => 'custom_title_subtitle',
				'type'   => 'heading',
				'hidden' => array( 'phys_user_featured_title', '=', false ),
				'before' => '<div style="margin-left: 25px; padding-left: 25px; border-width: 0 0 0 3px; border-style: solid; border-color: #ddd">',
			),
			array(
				'name'   => esc_html__( 'Hide Title', 'travelwp' ),
				'id'     => 'phys_hide_title',
				'type'   => 'checkbox',
				'class'  => 'checkbox-toggle reverse',
				'hidden' => array( 'phys_user_featured_title', '=', false ),
			),
			array(
				'name'   => esc_html__( 'Custom Title', 'travelwp' ),
				'id'     => 'phys_custom_title',
				'type'   => 'text',
				'hidden' => array( 'phys_user_featured_title', '=', false ),
				'desc'   => esc_html__( 'Leave empty to use post title', 'travelwp' ),
			),
			array(
				'name'   => esc_html__( 'Custom Heading Background', 'travelwp' ),
				'id'     => 'custom_headding_bg',
				'type'   => 'heading',
				'hidden' => array( 'phys_user_featured_title', '=', false ),
			),
			array(
				'name'             => esc_html__( 'Update images', 'travelwp' ),
				'id'               => 'phys_top_image',
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'hidden'           => array( 'phys_user_featured_title', '=', false ),
				'desc'             => esc_html__( 'This will overwrite page layout settings in Theme Options', 'travelwp' ),
			),
			array(
				'name'   => esc_html__( 'Background Color Featured', 'travelwp' ),
				'id'     => 'phys_bg_color',
				'type'   => 'color',
				'hidden' => array( 'phys_user_featured_title', '=', false ),
			),
			array(
				'name'   => esc_html__( 'Text Color Featured', 'travelwp' ),
				'id'     => 'phys_text_color',
				'type'   => 'color',
				'hidden' => array( 'phys_user_featured_title', '=', false ),

			),
			array(
				'name'   => esc_html__( 'Hide Breadcrumbs?', 'travelwp' ),
				'id'     => 'phys_hide_breadcrumbs',
				'type'   => 'checkbox',
				'hidden' => array( 'phys_user_featured_title', '=', false ),
				'after'  => '</div>',
			),

			array(
				'name' => esc_html__( 'Custom Layout', 'travelwp' ),
				'id'   => 'heading_layout',
				'type' => 'heading',
			),
			array(
				'name'  => esc_html__( 'Use Custom Layout?', 'travelwp' ),
				'id'    => 'phys_custom_layout',
				'type'  => 'checkbox',
				'class' => 'checkbox-toggle',
				'desc'  => esc_html__( 'This will overwrite page layout settings in Theme Options', 'travelwp' ),
			),
			array(
				'name'    => esc_html__( 'Select Layout', 'travelwp' ),
				'id'      => 'layout',
				'type'    => 'image_select',
				'std'     => 'sidebar-left',
				'hidden'  => array( 'phys_custom_layout', '=', false ),
				'options' => array(
					'full-content'  => TRAVELWP_THEME_URI . '/images/layout/body-full.png',
					'sidebar-left'  => TRAVELWP_THEME_URI . '/images/layout/sidebar-left.png',
					'sidebar-right' => TRAVELWP_THEME_URI . '/images/layout/sidebar-right.png',
				),
			),
		)
	);

	return $meta_boxes;
}

