<?php

vc_map(
	array(
		"name"     => esc_html__( "Counter box", 'travelwp' ),
		"icon"     => "icon-ui-splitter-horizontal",
		"base"     => "counter",
		"category" => esc_html__( "Travelwp", 'travelwp' ),
		"params"   => array(
			array(
				'type'       => 'iconpicker',
				'heading'    => esc_html__( 'Icon', 'travelwp' ),
				'param_name' => 'icon_flaticon',
				'value'      => 'flaticon-airplane-4', // default value to backend editor admin_label
				'settings'   => array(
					'emptyIcon'    => false, // default true, display an "EMPTY" icon?
					'type'         => 'flaticon',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				)
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Value", 'travelwp' ),
				"param_name"  => "value",
				"value"       => "",
				'admin_label' => true,
				"description" => esc_html__( "Enter value for graph (Note: choose range from 0 to 100).", "travelwp" )
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Label value", 'travelwp' ),
				"param_name"  => "label_value",
				"value"       => "",
				'admin_label' => true,
				"description" => esc_html__( "Enter label for pie chart (Note: leaving empty will set value from \"Value\" field).", "travelwp" )
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Color text', 'travelwp' ),
				'param_name' => 'color_text',
				'value'      => '',
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
function travelwp_shortcode_counter( $atts, $content = null ) {
	$el_class = $physcode_animation = $value = $label_value =
	$css_animation = $icon_flaticon = $color_text = '';
	extract(
		shortcode_atts(
			array(
				'icon_flaticon' => 'flaticon-airplane-4',
				'value'         => '',
				'label_value'   => 'h3',
				'color_text'    => '',
				'el_class'      => '',
				'css_animation' => '',
			), $atts
		)
	);

	if ( $el_class ) {
		$physcode_animation .= ' ' . $el_class;
	}
	wp_enqueue_script( 'waypoints' );
	wp_enqueue_script( 'travelwp-counterup' );

	$physcode_animation .= travelwp_getCSSAnimation( $css_animation );
	$style = $color_text ? ' style="color:' . $color_text . '"' : '';

	$html = '<div class="stats_counter text-center' . $physcode_animation . '"' . $style . '>
				<div class="wrapper-icon">
					<i class="' . $icon_flaticon . '"></i>
				</div>
				<div class="stats_counter_number">' . $value . '</div>
				<div class="stats_counter_title">' . $label_value . '</div>
			</div>';

	return $html;
}

?>