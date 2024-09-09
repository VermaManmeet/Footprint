<?php
vc_map(
	array(
		"name"     => esc_html__( "Deals And Discounts", 'travelwp' ),
		"icon"     => "icon-ui-splitter-horizontal",
		"base"     => "deals_discounts",
		"category" => esc_html__( "Travelwp", 'travelwp' ),
		"params"   => array(
			array(
				"type"       => "textfield",
				"heading"    => esc_html__( "Heading", 'travelwp' ),
				"param_name" => "heading",
				"value"      => "",
			),
			array(
				"type"       => "textfield",
				"heading"    => esc_html__( "Text Discounts", 'travelwp' ),
				"param_name" => "text_discounts",
				"value"      => "",
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Description", 'travelwp' ),
				"param_name"  => "sub_heading",
				"value"       => "",
				"description" => esc_html__( "Description before heading", "travelwp" ),
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
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'color line', 'travelwp' ),
				'param_name' => 'line_color',
				'value'      => '',
			),
			array(
				"type"       => "datepicker",
				"heading"    => esc_html__( "End Date", 'travelwp' ),
				"param_name" => "end_date",
			),
			array(
				"type"       => "textfield",
				"heading"    => esc_html__( "Text button", 'travelwp' ),
				"param_name" => "text_button",
				"value"      => "GET TOUR",
			),

			array(
				'type'       => 'iconpicker',
				'heading'    => esc_html__( 'Icon button', 'travelwp' ),
				'param_name' => 'icon_flaticon',
				'value'      => 'flaticon-airplane-4', // default value to backend editor admin_label
				'settings'   => array(
					'emptyIcon'    => false, // default true, display an "EMPTY" icon?
					'type'         => 'flaticon',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				)
			),
			array(
				"type"       => "textfield",
				"heading"    => esc_html__( "Link button", 'travelwp' ),
				"param_name" => "link_button",
				"value"      => "#",
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
function travelwp_shortcode_deals_discounts( $atts, $content = null ) {
	$el_class = $physcode_animation = $heading = $heading_type = $text_discounts = $sub_heading = $text_button = $link_button =
	$heading_color = $line_color = $css_animation = $icon_flaticon = $end_date = '';
	extract(
		shortcode_atts(
			array(
				'heading'        => '',
				'text_discounts' => '',
				'heading_type'   => 'h3',
				'heading_color'  => '',
				'line_color'     => '',
				'sub_heading'    => '',
				'end_date'       => '',
				'text_button'    => 'GET TOUR',
				'icon_flaticon'  => 'flaticon-airplane-4',
				'link_button'    => '#',
				'el_class'       => '',
				'css_animation'  => '',
			), $atts
		)
	);
	$end_date = strtotime( $end_date );
	wp_enqueue_script( 'travelwp-comingsoon' );
	if ( $el_class ) {
		$physcode_animation .= ' ' . $el_class;
	}
	$physcode_animation .= travelwp_getCSSAnimation( $css_animation );
	$style_heading    = $heading_color ? ' style="color:' . $heading_color . '"' : '';
	$line_color_style = $line_color ? ' style="color:' . $line_color . '"' : '';
	$html             = ' <div class="discounts-tour' . $physcode_animation . '">';
	if ( $text_discounts ) {
		$text_discounts = ' <span> ' . $text_discounts . '</span>';
	}
	if ( $heading || $heading_type ) {
		$html .= '<' . $heading_type . $style_heading . ' class="discounts-title"> ' . $heading . $text_discounts . '</' . $heading_type . '>';
	}

	$html .= '<span class="line"' . $line_color_style . '></span>';
	if ( $sub_heading ) {
		$html .= '<p ' . $line_color_style . '>' . $sub_heading . '</p>';
	}
	$localization = esc_html__( 'days', 'travelwp' ) . ',' . esc_html__( 'hours', 'travelwp' ) . ',' . esc_html__( 'minutes', 'travelwp' ) . ',' . esc_html__( 'seconds', 'travelwp' );

	$html .= '<div class="row centered text-center deals-discounts"  data-year="' . date( "Y", $end_date ) . '" data-month="' . date( "m", $end_date ) . '" data-date="' . date( "d", $end_date ) . '" data-hour="' . date( "G", $end_date ) . '" data-min="' . date( "i", $end_date ) . '" data-sec="' . date( "s", $end_date ) . '" data-gmt="' . get_option( 'gmt_offset' ) . '" data-text="' . $localization . '"></div>';

	if ( $text_button && $link_button ) {
		$html .= '<div class="col-sm-12 text-center padding-top-2x">
				<a href="' . $link_button . '" class="icon-btn">
					<i class="' . $icon_flaticon . '"></i> ' . $text_button . '
				</a>
			</div>';
	}

	$html .= '</div> ';

	return $html;
}

?>