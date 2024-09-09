<?php
vc_map(
	array(
		"name"     => esc_html__( "Gallery", 'travelwp' ),
		"icon"     => "icon-ui-splitter-horizontal",
		"base"     => "phys_gallery",
		"category" => esc_html__( "Travelwp", 'travelwp' ),
		"params"   => array(
			array(
				'type'        => 'attach_images',
				'heading'     => esc_html__( 'Input ID image', 'travelwp' ),
				'param_name'  => 'id_image',
				'admin_label' => true,
			),
			array(
				"type"        => "checkbox",
				"heading"     => esc_html__( "Show Filter", 'travelwp' ),
				"param_name"  => "filter",
				'admin_label' => true,
			),
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Column', 'travelwp' ),
				'param_name'  => 'column',
				'value'       => array(
					esc_html__( 'Two', 'travelwp' )   => '2',
					esc_html__( 'Three', 'travelwp' ) => '4',
					esc_html__( 'Four', 'travelwp' )  => '3',
				),
				'std'         => '4'
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
/**
 * Filter used to customize galleries output.
 *
 * @param string $empty
 * @param assoc  $atts gallery shortcode attributes
 *
 * @return string
 */
function travelwp_shortcode_phys_gallery( $atts, $content = null ) {
	$filter = $id_image = $el_class = $html = $column = $physcode_animation = $css_animation = '';
	extract(
		shortcode_atts(
			array(
				'id_image'      => '',
				'filter'        => '',
				'column'        => '4',
				'el_class'      => '',
				'css_animation' => '',
			), $atts
		)
	);
	if ( $el_class ) {
		$physcode_animation .= ' ' . $el_class;
	}
	$physcode_animation .= travelwp_getCSSAnimation( $css_animation );
	$settings           = array(
		'id_image'    => explode( ',', $id_image ),
		'animation'   => $physcode_animation,
		'filter'      => $filter,
		'column'      => $column,
		'images_size' => 'medium'
	);
	ob_start();

	travelwp_shortcode_template( array(
		'settings' => $settings
	), 'gallery' );

	$html = ob_get_clean();

	return $html;
}
