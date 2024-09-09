<?php
$taxonomies                        = get_object_taxonomies( 'product', 'objects' );
$attribute_arr                     = array();
$attribute_arr['Select Attribute'] = '';
if ( empty( $taxonomies ) ) {
	return '';
}

foreach ( $taxonomies as $tax ) {
	$tax_name = $tax->name;
	if ( 0 !== strpos( $tax_name, 'pa_' ) ) {
		continue;
	}
	if ( ! in_array( $tax_name, $attribute_arr ) ) {
		$attribute_arr[$tax_name] = $tax_name;
	}
}

vc_map( array(
	"name"     => __( "Show tours of attribute", "travelwp" ),
	"base"     => "show_tours_of_attribute_woo",
	"class"    => "",
	"category" => __( "Travelwp", "travelwp" ),
	"params"   => array(
		array(
			'type'        => 'multi_dropdown',
			'heading'     => esc_html__( 'Select Attribute', 'travelwp' ),
			'param_name'  => 'attributes_woo',
			'value'       => $attribute_arr,
			"admin_label" => true,
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Limit', 'travelwp' ),
			'param_name' => 'limit',
			'value'      => '8',
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Style', 'travelwp' ),
			'param_name' => 'style',
			'std'        => 'style_1',
			'value'      => array(
				esc_html__( 'Style 1', 'travelwp' ) => 'style_1',
				esc_html__( 'Style 2', 'travelwp' ) => 'style_2'
			)
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Item on row', 'travelwp' ),
			'param_name' => 'item_on_row',
			'value'      => '5',
			"dependency" => array( "element" => "style", "value" => array( 'style_1' ) ),
		),
		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Show navigation', 'travelwp' ),
			'param_name' => 'navigation',
			"dependency" => array( "element" => "style", "value" => array( 'style_1' ) ),
		),
		array(
			"type"        => "textfield",
			"heading"     => esc_html__( "Extra class name", "travelwp" ),
			"param_name"  => "el_class",
			"description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "travelwp" ),
		),
	)
) );

function travelwp_shortcode_show_tours_of_attribute_woo( $atts, $content = null ) {
	extract(
		shortcode_atts(
			array(
				'attributes_woo' => '',
				'style'          => 'style_1',
				'navigation'     => '',
				'item_on_row'    => '5',
				'limit'          => '8',
				'el_class'       => '',
				'css_animation'  => '',
			), $atts
		)
	);
	$physcode_animation = $el_class ? ' ' . $el_class : '';

	$settings = array(
		'attributes_woo' => $attributes_woo ? explode( ',', $attributes_woo ) : '',
		'style'          => $style,
		'limit'          => $limit,
		'item_on_row'    => $item_on_row,
		'navigation'     => $navigation,
		'animation'      => $physcode_animation,
	);


	ob_start();

	travelwp_shortcode_template( array(
		'settings' => $settings
	), 'list-attributes' );

	$html = ob_get_clean();

	return $html;
}

?>
