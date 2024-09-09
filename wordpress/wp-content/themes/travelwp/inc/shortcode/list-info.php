<?php
vc_map(
	array(
		"name"     => esc_html__( "List information", 'travelwp' ),
		"icon"     => "icon-ui-splitter-horizontal",
		"base"     => "list_info",
		"category" => esc_html__( "Travelwp", 'travelwp' ),
		"params"   => array(
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Heading", 'travelwp' ),
				"param_name"  => "heading_item",
				"value"       => "",
				"admin_label" => true,

			),
			array(
				'type'       => 'param_group',
				'heading'    => esc_html__( 'Add info', 'travelwp' ),
				'param_name' => 'item_info',
				'value'      => '',
				'params'     => array(
					array(
						"type"        => "textfield",
						"heading"     => esc_html__( "Icon", "travelwp" ),
						"param_name"  => "icon",
						"description" => esc_html__( "using fontawesome: EX: fa-home", "travelwp" ),
					),
					array(
						"type"        => "textfield",
						"heading"     => esc_html__( "Label", 'travelwp' ),
						"param_name"  => "label",
						"value"       => "",
						"admin_label" => true,
					),
					array(
						"type"       => "textarea",
						"heading"    => esc_html__( "Content", 'travelwp' ),
						"param_name" => "content",
						"value"      => "",
					),
				),
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
function travelwp_shortcode_list_info( $atts, $content = null ) {
	$el_class = $physcode_animation = $item_info = $label_value = $html = $heading_item =
	$css_animation = $icon_flaticon = $color_text = '';
	extract(
		shortcode_atts(
			array(
				'heading_item'  => '',
				'item_info'     => '',
				'el_class'      => '',
				'css_animation' => '',
			), $atts
		)
	);

	if ( $el_class ) {
		$physcode_animation .= ' ' . $el_class;
	}
	$physcode_animation .= travelwp_getCSSAnimation( $css_animation );
	$item_info = $item_info ? json_decode( urldecode( $item_info ) ) : array();
	$html .= '<div class="pages_content' . $physcode_animation . '">';
	$html .= $heading_item ? '<h4>' . $heading_item . '</h4>' : '';
	if ( count( $item_info ) ) {
		$html .= '<div class="contact_infor"><ul>';
		foreach ( $item_info as $item ) {
			$html .= '<li>';
			$icon = $item->icon ? '<i class="fa ' . $item->icon . '"></i>' : '';
			$html .= '<label>' . $icon . $item->label . '</label>';
			$html .= '<div class="des">' . $item->content . '</div>';
			$html .= '</li>';
		}
		$html .= '</ul></div>';
	}
	$html .= '</div>';

	return $html;
}