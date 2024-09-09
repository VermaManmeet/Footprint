<?php
vc_map(
	array(
		"name"        => esc_html__( "Heading", 'travelwp' ),
		"icon"        => "icon-ui-splitter-horizontal",
		"base"        => "heading",
		"description" => "Heading",
		"category"    => esc_html__( "Travelwp", 'travelwp' ),
		"params"      => array(
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Description", 'travelwp' ),
				"param_name"  => "sub_heading",
				"value"       => "",
				"description" => esc_html__( "Description before heading", "travelwp" ),
			),
			array(
				"type"       => "textfield",
				"heading"    => esc_html__( "Heading", 'travelwp' ),
				"param_name" => "heading",
				"value"      => "",
			),
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Heading type', 'travelwp' ),
				'param_name'  => 'heading_type',
				'value'       => array(
					esc_html__( 'H2', 'travelwp' ) => 'h2',
					esc_html__( 'H3', 'travelwp' ) => 'h3',
					esc_html__( 'H4', 'travelwp' ) => 'h4',
					esc_html__( 'H5', 'travelwp' ) => 'h5',
					esc_html__( 'H6', 'travelwp' ) => 'h6'
				),
				'std'         => 'h3'
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Heading color', 'travelwp' ),
				'param_name' => 'heading_color',
				'value'      => '',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'travelwp' ),
				'param_name' => 'style',
				'std'        => 'style_1',
				'value'      => array(
					esc_html__( 'Style 1', 'travelwp' ) => 'style_1',
					esc_html__( 'Style 2', 'travelwp' ) => 'style_2',
					esc_html__( 'Style 3', 'travelwp' ) => 'style_3'
				)
			),

			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'color line', 'travelwp' ),
				'param_name' => 'line_color',
				'value'      => '',
				"dependency" => Array( "element" => "style", "value" => array( 'style_1' ) ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Link', 'travelwp' ),
				'param_name' => 'link_url',
				'value'      => '',
				"dependency" => Array( "element" => "style", "value" => array( 'style_2', 'style_3' ) ),
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Extra class name", "travelwp" ),
				"param_name"  => "el_class",
				"description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "travelwp" ),
			),
			travelwp_vc_map_add_css_animation( true )
		)
	)
);
function travelwp_shortcode_heading( $atts, $content = null ) {
	$sub_heading = $heading = $heading_type = $heading_color = $link_url =
	$css_animation = $el_class = $physcode_animation = $line_color = $style = '';
	extract(
		shortcode_atts(
			array(
				'heading'       => '',
				'heading_type'  => 'h3',
				'heading_color' => '',
				'line_color'    => '',
				'sub_heading'   => '',
				'style'         => 'style_1',
				'link_url'      => '',
				'el_class'      => '',
				'css_animation' => '',
			), $atts
		)
	);
	if ( $el_class ) {
		$physcode_animation .= ' ' . $el_class;
	}
	$before_link = $after_link = '';
	$physcode_animation .= travelwp_getCSSAnimation( $css_animation );
	$physcode_animation .= ' shortcode-title-' . $style;
	$style_heading    = $heading_color ? ' style="color:' . $heading_color . '"' : '';
	$line_color_style = $line_color ? ' style="color:' . $line_color . '"' : '';
	$html             = '<div class="shortcode_title' . $physcode_animation . '"' . $style_heading . '>';
	if ( $link_url ) {
		$before_link = '<a href="' . $link_url . '">';
		$after_link  = '</a>';
	}
	if ( $style == 'style_2' || $style == 'style_3' ) {
		$html .= '<' . $heading_type . ' class="title_primary">' . $heading . '</' . $heading_type . '>';
	}
	if ( $sub_heading ) {
		$html .= '<div class="title_subtitle">' . $before_link . $sub_heading . $after_link . '</div>';
	}

	if ( $style == 'style_1' ) {
		$html .= '<' . $heading_type . ' class="title_primary">' . $heading . '</' . $heading_type . '>';
		$html .= '<span class="line_after_title"' . $line_color_style . '></span>';
	}

	$html .= '</div>';

	return $html;
}

?>