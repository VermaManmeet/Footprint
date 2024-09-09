<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}
vc_map(
	array(
		"name"     => esc_html__( "Banner Typed", 'travelwp' ),
		"icon"     => "icon-ui-splitter-horizontal",
		"base"     => "banner_typed",
		"category" => esc_html__( "Travelwp", 'travelwp' ),
		"params"   => array(
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Heading before Typed", 'travelwp' ),
				"param_name"  => "heading",
				"value"       => "",
				'admin_label' => true,
			),
			array(
				'type'       => 'param_group',
				'heading'    => esc_html__( 'Add Typed', 'travelwp' ),
				'param_name' => 'string_text',
				'params'     => array(
					array(
						"type"        => "textfield",
						"heading"     => esc_html__( "Text", 'travelwp' ),
						"param_name"  => "description",
						"value"       => esc_html__( "Add Text", 'travelwp' ),
						'admin_label' => true,
					),
				),
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Heading color', 'travelwp' ),
				'param_name'  => 'heading_color',
				'value'       => '',
				'admin_label' => true,
			),

			array(
				"type"       => "textfield",
				"heading"    => esc_html__( "Description", 'travelwp' ),
				"param_name" => "description",
				"value"      => "",
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Description color', 'travelwp' ),
				'param_name'  => 'description_color',
				'value'       => '',
				'admin_label' => true,
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

function travelwp_shortcode_banner_typed( $atts, $content = null ) {
	$heading = $heading_color = $typing_color = $description = $description_color = $string_text = $css_animation = $el_class = '';
	extract(
		shortcode_atts(
			array(
				'heading'           => '',
				'heading_color'     => '',
				'typing_color'      => '',
				'string_text'       => urlencode(
					json_encode(
						array(
							array(
								'description' => 'Add Text',
							),
						)
					)
				),
				'description'       => '',
				'description_color' => '',
				'el_class'          => '',
				'css_animation'     => '',
			), $atts
		)
	);

	$physcode_animation = $el_class ? ' ' . $el_class : '';
	$physcode_animation .= travelwp_getCSSAnimation( $css_animation );
	wp_enqueue_script( 'travelwp-typed' );
	$html = '<div class="banner-typed' . $physcode_animation . '">';

	$string_text = $string_text ? json_decode( urldecode( $string_text ) ) : array();
	if ( count( $string_text ) ) {
		$i     = 0;
		$texts = '';
		foreach ( $string_text as $item ) {
			$texts .= ' data-strings' . $i . ' = "' . addslashes( $item->description ) . '"';
			$i ++;
		}
		$heading_color = $heading_color ? ' style="color:' . $heading_color . '"' : '';
 		$html .= '<h2 class="phys-typingEffect"' . $heading_color . '>
					' . $heading . ' ' . '<span class="phys-typingTextEffect" ' . $texts . ' data-type-speed="100"></span>
 				</h2>';
	}
	if ( $description ) {
		$description_color = $description_color ? ' style="color:' . $description_color . '"' : '';
		$html .= '<p class="desc"' . $description_color . '>' . $description . '</p>';
	}

	$html .= '</div>';

	return $html;
}