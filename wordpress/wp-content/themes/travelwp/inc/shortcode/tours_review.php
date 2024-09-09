<?php

vc_map(
	array(
		"name"     => esc_html__( "Tours Reviews", 'travelwp' ),
		"icon"     => "icon-ui-splitter-horizontal",
		"base"     => "tours_review",
		"category" => esc_html__( "Travelwp", 'travelwp' ),
		"params"   => array(
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Title", 'travelwp' ),
				"param_name"  => "title",
				'admin_label' => true,
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Order', 'travelwp' ),
				'param_name' => 'order',
				'std'        => 'desc',
				'value'      => array(
					esc_html__( 'DESC', 'travelwp' ) => 'desc',
					esc_html__( 'ASC', 'travelwp' )  => 'asc'
				)
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Review ID", 'travelwp' ),
				"param_name"  => "review_id",
				"value"       => "",
				"description" => esc_html__( 'Enter Review ID for shortcode (Note: divide ID with ",")', 'travelwp' ),
				'admin_label' => true,
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Item on row", 'travelwp' ),
				"param_name"  => "item_on_row",
				"value"       => "3",
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

function travelwp_shortcode_tours_review( $atts, $content = null ) {
	extract(
		shortcode_atts(
			array(
				'title'         => '',
				'review_id'     => '',
				'order'         => 'DESC',
				'item_on_row'   => '3',
				'el_class'      => '',
				'css_animation' => '',
 			), $atts
		)
	);
 	$physcode_animation = $el_class ? ' ' . $el_class : '';
	$physcode_animation .= travelwp_getCSSAnimation( $css_animation );

	$settings = array(
		'title'       => $title,
		'animation'   => $physcode_animation,
		'review_id'   => $review_id,
		'item_on_row' => $item_on_row,
		'order'       => $order,
		'css_shortcode' =>'shortcode-tour-reviews '
	);
	ob_start();

	travelwp_shortcode_template( array(
		'settings' => $settings
	), 'tours-review' );
	$html = ob_get_clean();

	return $html;
}
