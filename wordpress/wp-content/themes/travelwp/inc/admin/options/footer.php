<?php
// footer
Redux::set_section( $opt_name, array(
	'title'  => esc_html__( 'Footer', 'travelwp' ),
	'id'     => 'footer',
	'icon'   => 'el el-graph',
	'fields' => array(
		array(
			'id'    => 'info_footer',
			'type'  => 'info',
			'class' => 'hide' . travelwp_theme_options_extral_class('footer'),
			'desc'  => sprintf(__('This Footer is built by Thim Elementor Kit, you can edit and configure it in %s.', 'travelwp'), '<a href="' . admin_url('edit.php?post_type=thim_elementor_kit&thim_elementor_type=footer') . '" target="_blank">' . __('Thim Elementor Kit', 'travelwp') . '</a>'),
		),
		array(
			'id'          => 'bg_footer',
			'type'        => 'color',
			'title'       => esc_html__( 'Background Color', 'travelwp' ),
			'default'     => '#414b4f',
			'transparent' => false,
			'class' => travelwp_theme_options_extral_class('footer'),
		),
		array(
			'id'          => 'text_color_footer',
			'type'        => 'color',
			'title'       => esc_html__( 'Text Color', 'travelwp' ),
			'default'     => '#ccc',
			'transparent' => false,
			'class' => travelwp_theme_options_extral_class('footer'),
		),

		array(
			'id'      => 'text_font_size_footer',
			'type'    => 'spinner',
			'title'   => esc_html__( 'Font Size (px)', 'travelwp' ),
			'default' => '13',
			'min'     => '1',
			'step'    => '1',
			'max'     => '50',
			'class' => travelwp_theme_options_extral_class('footer'),
		),

		array(
			'id'          => 'border_color_footer',
			'type'        => 'color',
			'title'       => esc_html__( 'Border Color', 'travelwp' ),
			'default'     => '#5b6366',
			'transparent' => false,
			'class' => travelwp_theme_options_extral_class('footer'),
		),

		array(
			'id'          => 'title_color_footer',
			'type'        => 'color',
			'title'       => esc_html__( 'Title Color', 'travelwp' ),
			'default'     => '#fff',
			'transparent' => false,
			'class' => travelwp_theme_options_extral_class('footer'),
		),
		array(
			'id'      => 'title_font_size_footer',
			'type'    => 'spinner',
			'title'   => esc_html__( 'Font Size Title (px)', 'travelwp' ),
			'default' => '18',
			'min'     => '1',
			'step'    => '1',
			'max'     => '50',
			'class' => travelwp_theme_options_extral_class('footer'),
		),
		array(
			'id'      => 'copyright_text',
			'type'    => 'editor',
			'title'   => esc_html__( 'Copyright Text', 'travelwp' ),
			'args'    => array(
				'wpautop' => false,
				'teeny'   => true
			),
			'default' => 'Copyright &copy; 2024 Travel WP. All Rights Reserved.',
			'class' => travelwp_theme_options_extral_class('footer'),
		),
	)
) );
