<?php
$args  = array(
	'pad_counts'         => 1,
	'show_counts'        => 1,
	'hierarchical'       => 1,
	'hide_empty'         => 1,
	'show_uncategorized' => 1,
	'orderby'            => 'name',
	'menu_order'         => false
);
$terms = get_terms( 'tour_phys', $args );

$tour_cat                         = array();
$tour_cat['Select Tour Category'] = '';
if ( is_wp_error( $terms ) ) {
} else {
	if ( empty( $terms ) ) {
	} else {
		foreach ( $terms as $term ) {
			$tour_cat[$term->name] = $term->term_id;
		}
	}
}

vc_map(
	array(
		"name"        => esc_html__( "List Tours", 'travelwp' ),
		"icon"        => "icon-ui-splitter-horizontal",
		"base"        => "list_tours",
		"description" => "Show tour",
		"category"    => esc_html__( "Travelwp", 'travelwp' ),
		"params"      => array(
			array(
				"type"        => "dropdown",
				"heading"     => esc_html__( "Show", "travelwp" ),
				"param_name"  => "show",
				"admin_label" => true,
				"value"       => array(
					esc_html__( "All Tour", "travelwp" )      => "",
					esc_html__( "Tour Category", "travelwp" ) => "tour_cat",
				),
			),
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Tour Type', 'travelwp' ),
				'param_name'  => 'tour_cat',
				'value'       => $tour_cat,
				"dependency"  => array( "element" => "show", "value" => array( "tour_cat" ) ),
			),
			array(
				"type"        => "dropdown",
				"heading"     => esc_html__( "Order by", "travelwp" ),
				"param_name"  => "orderby",
				"admin_label" => true,
				"value"       => array(
					esc_html__( "Date", "travelwp" )        => "date",
					esc_html__( "Price", "travelwp" )       => "price",
					esc_html__( "Random", "travelwp" )      => "rand",
					esc_html__( "On-sale", "travelwp" )     => "sales",
					esc_html__( "Sort custom", "travelwp" ) => "menu_order"
				),
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
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Content Style', 'travelwp' ),
				'param_name' => 'content_style',
				'std'        => 'style_1',
				'value'      => array(
					esc_html__( 'Style 1', 'travelwp' ) => 'style_1',
					esc_html__( 'Style 2', 'travelwp' ) => 'style_2'
				)
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Layout', 'travelwp' ),
				'param_name' => 'style',
				'std'        => 'pain',
				'value'      => array(
					esc_html__( 'Pain', 'travelwp' )   => 'pain',
					esc_html__( 'Slider', 'travelwp' ) => 'slider'
				)
			),

			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Show navigation', 'travelwp' ),
				'param_name' => 'navigation',
				"dependency" => array( "element" => "style", "value" => array( 'slider' ) ),
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Limit", 'travelwp' ),
				"param_name"  => "limit",
				"value"       => "6",
				'description' => esc_html__( 'Tour number will be shown.', 'travelwp' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Tour on row', 'travelwp' ),
				'param_name' => 'tour_on_row',
				'value'      => '3',
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

function travelwp_shortcode_list_tours( $atts, $content = null ) {
	extract(
		shortcode_atts(
			array(
				'tour_cat'      => '',
 				'show'          => '',
				'content_style' => 'style_1',
				'style'         => 'pain',
				'limit'         => 6,
				'tour_on_row'   => 3,
				'orderby'       => 'date',
				'order'         => 'desc',
				'el_class'      => '',
				'navigation'    => '',
				'css_animation' => '',
			), $atts
		)
	);
	$travelwp_animation = $el_class ? ' ' . $el_class : '';
	$travelwp_animation .= travelwp_getCSSAnimation( $css_animation );

	$settings = array(
		'tour_cat'      => $tour_cat ? explode( ',', $tour_cat ) : '',
		'show'          => $show,
 		'content_style' => $content_style,
		'style'         => $style,
		'limit'         => $limit,
		'tour_on_row'   => $tour_on_row,
		'orderby'       => $orderby,
		'order'         => $order,
		'navigation'    => $navigation,
		'animation'     => $travelwp_animation,
		'term_by'       => 'term_id' // category select by ID
	);
	ob_start();

	travelwp_shortcode_template( array(
		'settings' => $settings
	), 'list-tours' );

	$html = ob_get_clean();

	return $html;
}
