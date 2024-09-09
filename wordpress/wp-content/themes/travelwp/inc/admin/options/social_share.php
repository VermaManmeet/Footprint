<?php
Redux::set_section( $opt_name, array(
	'title'  => esc_html__( 'Social Sharing', 'travelwp' ),
	'id'     => 'social_sharing',
	'icon'   => 'el el-group',
	'fields' => array(
		array(
			'id'      => 'social-sortable',
			'type'    => 'sortable',
			'title'   => '',
			'mode'    => 'checkbox',
			'options' => array(
				'sharing_facebook'  => esc_html__( 'Facebook', 'travelwp' ),
				'sharing_twitter'   => esc_html__( 'Twitter', 'travelwp' ),
				'sharing_google'    => esc_html__( 'Google Plus', 'travelwp' ),
				'sharing_pinterset' => esc_html__( 'Pinterest', 'travelwp' )
			),
			// For checkbox mode
			'default' => array(
				'sharing_facebook'  => true,
				'sharing_twitter'   => true,
				'sharing_google'    => true,
				'sharing_pinterset' => true
			),
		),
	)
) );