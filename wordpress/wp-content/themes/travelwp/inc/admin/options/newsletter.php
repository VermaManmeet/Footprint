<?php
Redux::set_section( $opt_name, array(
	'title'  => esc_html__( 'Newsletter', 'travelwp' ),
	'icon'   => 'el el-envelope',
	'class' => travelwp_theme_options_extral_class('footer'),
	'fields' => array(
		array(
			'id'      => 'show_newsletter',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Newsletter', 'travelwp' ),
			'default' => 0,
			'on'      => 'Show',
			'off'     => 'Hide'
		),
		array(
			'id'       => 'bg_newsletter',
			'type'     => 'media',
			'title'    => esc_html__( 'Background Image', 'travelwp' ),
			'desc'     => esc_html__( 'Enter URL or Upload an image file as your background newsletter.', 'travelwp' ),
			'required' => array( 'show_newsletter', '=', '1' )

		),
		array(
			'id'       => 'bg_newsletter_color',
			'type'     => 'color_rgba',
			'title'    => esc_html__( 'Background  Mask', 'travelwp' ),
			'required' => array( 'show_newsletter', '=', '1' )
		),
		array(
			'id'          => 'text_color_newsletter',
			'type'        => 'color',
			'title'       => esc_html__( 'Text Color', 'travelwp' ),
			'default'     => '#fff',
			'transparent' => false,
			'required'    => array( 'show_newsletter', '=', '1' )
		),
		array(
			'id'       => 'before_newsletter',
			'type'     => 'text',
			'title'    => esc_html__( 'Before Title', 'travelwp' ),
			'default'  => 'To receive our best monthly deals',
			'required' => array( 'show_newsletter', '=', '1' )
		),
		array(
			'id'       => 'title_newsletter',
			'type'     => 'text',
			'title'    => esc_html__( 'Title', 'travelwp' ),
			'default'  => 'JOIN THE NEWSLETTER',
			'required' => array( 'show_newsletter', '=', '1' )
		),
		array(
			'id'       => 'shortcode_newsletter',
			'type'     => 'text',
			'title'    => esc_html__( 'Shortcode Form', 'travelwp' ),
			'required' => array( 'show_newsletter', '=', '1' )
		),
	)
) );
