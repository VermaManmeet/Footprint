<?php
// css custom
Redux::set_section( $opt_name, array(
	'title'  => esc_html__( 'Custom Css', 'travelwp' ),
	'id'     => 'custom_css',
	'icon'   => 'el el-css',
	'fields' => array(
		array(
			'id'       => 'opt-ace-editor-css',
			'type'     => 'ace_editor',
			'title'    => esc_html__( 'CSS Code', 'travelwp' ),
			'subtitle' => esc_html__( 'Paste your CSS code here.', 'travelwp' ),
			'mode'     => 'css',
			'theme'    => 'monokai',
			'default'  => ".custom_class{\n   margin: 0 auto;\n}"
		),
		array(
			'id'       => 'opt-ace-editor-js',
			'type'     => 'ace_editor',
			'title'    => esc_html__( 'JS Code', 'travelwp' ),
			'subtitle' => esc_html__( 'Paste your JS code here.', 'travelwp' ),
			'mode'     => 'javascript',
			'theme'    => 'chrome',
			'default'  => ""
		),
	)
) );