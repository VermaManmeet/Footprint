<?php

add_filter( 'vc_iconpicker-type-flaticon', 'vc_iconpicker_type_flaticon' );

function vc_iconpicker_type_flaticon( $icons ) {
	$flaticon = array(
		array( 'flaticon-airplane' => 'flaticon airplane' ),
		array( 'flaticon-airplane-1' => 'flaticon airplane 1' ),
		array( 'flaticon-airplane-2' => 'flaticon airplane 2' ),
		array( 'flaticon-airplane-3' => 'flaticon airplane 3' ),
		array( 'flaticon-airplane-4' => 'flaticon airplane 4' ),
		array( 'flaticon-balloon' => 'flaticon balloon' ),
		array( 'flaticon-business' => 'flaticon business' ),
		array( 'flaticon-cart' => 'flaticon cart' ),
		array( 'flaticon-cart-1' => 'flaticon cart 1' ),
		array( 'flaticon-globe' => 'flaticon globe' ),
		array( 'flaticon-hotel' => 'flaticon hotel' ),
		array( 'flaticon-island' => 'flaticon island' ),
		array( 'flaticon-map' => 'flaticon map' ),
		array( 'flaticon-map-1' => 'flaticon map 1' ),
		array( 'flaticon-money' => 'flaticon money' ),
		array( 'flaticon-people' => 'flaticon people' ),
		array( 'flaticon-plans' => 'flaticon plans' ),
		array( 'flaticon-road' => 'flaticon road' ),
		array( 'flaticon-road-1' => 'flaticon road 1' ),
		array( 'flaticon-road-2' => 'flaticon road 2' ),
		array( 'flaticon-sand' => 'flaticon-sand' ),
		array( 'flaticon-ship' => 'flaticon-ship' ),
		array( 'flaticon-shipping' => 'flaticon-shipping' ),
		array( 'flaticon-skyscraper' => 'flaticon-skyscraper' ),
		array( 'flaticon-suitcase' => 'flaticon-suitcase' ),
		array( 'flaticon-ticket' => 'flaticon-ticket' ),
		array( 'flaticon-transport' => 'flaticon-transport' ),
		array( 'flaticon-transport-1' => 'flaticon transport 1' ),
		array( 'flaticon-transport-2' => 'flaticon transport 2' ),
		array( 'flaticon-transport-3' => 'flaticon transport 3' ),
		array( 'flaticon-transport-4' => 'flaticon transport 4' ),
		array( 'flaticon-transport-5' => 'flaticon transport 5' ),
		array( 'flaticon-transport-6' => 'flaticon transport 6' ),
		array( 'flaticon-travel' => 'flaticon travel' ),
		array( 'flaticon-travel-1' => 'flaticon travel 1' ),
		array( 'flaticon-travel-2' => 'flaticon travel 2' ),
		array( 'flaticon-travelling' => 'flaticon travelling' ),
		array( 'flaticon-yacht' => 'flaticon-yacht' )
	);

	return array_merge( $icons, $flaticon );
}

vc_map(
	array(
		"name"        => esc_html__( "Icon Box", 'travelwp' ),
		"icon"        => "icon-ui-splitter-horizontal",
		"base"        => "icon_box",
		"description" => "Heading",
		"category"    => esc_html__( "Travelwp", 'travelwp' ),
		"params"      => array(
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Icon library', 'travelwp' ),
				'value'       => array(
					esc_html__( 'Open Iconic', 'travelwp' )  => 'openiconic',
					esc_html__( 'Linecons', 'travelwp' )     => 'linecons',
					esc_html__( 'TravelWp', 'travelwp' )     => 'flaticon',
					esc_html__( 'Custom Image', 'travelwp' ) => 'custom_image',
				),
				'admin_label' => true,
				'param_name'  => 'type',
				'description' => esc_html__( 'Select icon library.', 'travelwp' ),
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => esc_html__( 'Icon', 'travelwp' ),
				'param_name'  => 'icon_openiconic',
				'value'       => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
				'settings'    => array(
					'emptyIcon'    => false, // default true, display an "EMPTY" icon?
					'type'         => 'openiconic',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency'  => array(
					'element' => 'type',
					'value'   => 'openiconic',
				),
				'description' => esc_html__( 'Select icon from library.', 'travelwp' ),
			),
			array(
				'type'       => 'iconpicker',
				'heading'    => esc_html__( 'Icon', 'travelwp' ),
				'param_name' => 'icon_flaticon',
				'value'      => 'flaticon-icon flaticon-icon-note', // default value to backend editor admin_label
				'settings'   => array(
					'emptyIcon'    => false, // default true, display an "EMPTY" icon?
					'type'         => 'flaticon',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'type',
					'value'   => 'flaticon',
				),
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => esc_html__( 'Icon', 'travelwp' ),
				'param_name'  => 'icon_linecons',
				'value'       => 'vc_li vc_li-heart', // default value to backend editor admin_label
				'settings'    => array(
					'emptyIcon'    => false, // default true, display an "EMPTY" icon?
					'type'         => 'linecons',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency'  => array(
					'element' => 'type',
					'value'   => 'linecons',
				),
				'description' => esc_html__( 'Select icon from library.', 'travelwp' ),
			),
			array(
				'type'        => 'attach_image',
				'heading'     => esc_html__( 'Upload Image', 'travelwp' ),
				'param_name'  => 'icon_custom_image',
				'value'       => '', // default value to backend editor admin_label
				'dependency'  => array(
					'element' => 'type',
					'value'   => 'custom_image',
				),
				'description' => esc_html__( 'Select image from media library.', 'travelwp' ),
			),
			array(
				"type"       => "textfield",
				"heading"    => esc_html__( "Font Size Icon", 'travelwp' ),
				"param_name" => "font_size",
				"value"      => "",
				"dependency" => Array( "element" => "type", "value" => array( 'openiconic', 'linecons', 'flaticon' ) ),
			),

			array(
				"type"       => "textfield",
				"heading"    => esc_html__( "Width Icon Box", 'travelwp' ),
				"param_name" => "width_icon",
				"value"      => "",
			),
			array(
				"type"       => "textfield",
				"heading"    => esc_html__( "Heading", 'travelwp' ),
				"param_name" => "heading",
				"value"      => "",
				"holder"     => "div"
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
				'std'         => 'h4'
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Heading color', 'travelwp' ),
				'param_name' => 'heading_color',
				'value'      => ''
			),
			array(
				'type'        => 'textarea',
				'heading'     => esc_html__( 'Description', 'travelwp' ),
				'param_name'  => 'content',
				'description' => esc_html__( 'Your description on heading', 'travelwp' ),
				'value'       => "",
			),
			array(
				"type"       => "colorpicker",
				"heading"    => esc_html__( "Description color", 'travelwp' ),
				"param_name" => "desc_color",
				"value"      => "",
			),
			array(
				"type"       => "textfield",
				"heading"    => esc_html__( "External link", "travelwp" ),
				"param_name" => "external_link",
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Link Target', 'travelwp' ),
				'param_name' => 'link_target',
				'value'      => array(
					esc_html__( 'Same window', 'travelwp' ) => '_self',
					esc_html__( 'New window', 'travelwp' )  => '_blank',
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Icon alignment', 'travelwp' ),
				'param_name'  => 'align',
				'value'       => array(
					esc_html__( 'Left', 'travelwp' )   => 'left',
					esc_html__( 'Right', 'travelwp' )  => 'right',
					esc_html__( 'Center', 'travelwp' ) => 'center',
				),
				'description' => esc_html__( 'Select icon alignment.', 'travelwp' ),
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Extra class name", "travelwp" ),
				"param_name"  => "el_class",
				"description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "travelwp" ),
			),
			travelwp_vc_map_add_css_animation( true )
		),
		'js_view'     => 'VcIconElementView_Backend',
	)
);

function travelwp_shortcode_icon_box( $atts, $content = null ) {
	$type = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_custom_image = $el_class = $icon_style = $align = $style_icon =
	$icon_entypo = $icon_linecons = $css_animation = $css = $physcode_animation = $heading = $heading_type = $heading_color =
	$font_size = $color_icon = $width_icon = $bg_icon = $style_content = $desc_color = $before_link = $after_link = '';
	extract(
		shortcode_atts(
			array(
				'type'              => 'openiconic',
				'icon_flaticon'     => 'flaticon-icon flaticon-icon-note',
				'icon_openiconic'   => 'vc-oi vc-oi-dial',
				'icon_typicons'     => 'typcn typcn-adjust-brightness',
				'icon_entypo'       => 'entypo-icon entypo-icon-note',
				'icon_linecons'     => 'vc_li vc_li-heart',
				'icon_custom_image' => '',
				'heading'           => '',
				'heading_type'      => 'h4',
				'heading_color'     => '',
				'align'             => 'left',
				'icon_style'        => '',
				'font_size'         => '',
				'width_icon'        => '',
				'desc_color'        => '',
				'external_link'     => '',
				'link_target'       => '_self',
				'el_class'          => '',
				'css_animation'     => '',
			), $atts
		)
	);
	if ( $el_class ) {
		$physcode_animation .= ' ' . $el_class;
	}
	$physcode_animation .= ' iconbox-' . $align;
	vc_icon_element_fonts_enqueue( $type );
	$iconClass = isset( ${"icon_" . $type} ) ? esc_attr( ${"icon_" . $type} ) : 'fa fa-adjust';
	if ( $type == 'custom_image' ) {
		$link = wp_get_attachment_image_src( $iconClass, 'full' );
	}
	if ( $external_link ) {
		$before_link = '<a href="' . $external_link . '" target="' . $link_target . '">';
		$after_link  = '</a>';
	}
	$physcode_animation .= travelwp_getCSSAnimation( $css_animation );

	$html = '<div class="widget-icon-box widget-icon-box-base' . $physcode_animation . '">';
	$html .= $before_link;
	$style_icon .= $font_size ? 'font-size:' . $font_size . 'px;' : '';
	if ( $type == 'custom_image' ) {
		$style_icon .= $width_icon ? 'width:' . $width_icon . 'px' : '';
	} else {
		$style_icon .= $width_icon ? 'width:' . $width_icon . 'px; height:' . $width_icon . 'px;line-height:' . $width_icon . 'px' : '';
	}
	if ( $align != 'center' ) {
		$style_content = $width_icon ? ' style="width:calc(100% - ' . $width_icon . 'px)"' : '';
	}
	$style_css = $style_icon ? ' style="' . $style_icon . '"' : '';

	$desc_color = $desc_color ? 'style="color:' . $desc_color . '"' : '';
	if ( $type == 'custom_image' ) {
		$html .= '<div class="box-icon icon-image ' . $icon_style . '"' . $style_css . '><img src="' . $link[0] . '" alt=""></div>';
	} else {
		$html .= '<div class="boxes-icon ' . $icon_style . '"' . $style_css . '><span class="inner-icon"><i class="vc_icon_element-icon ' . $iconClass . '"></i></span></div>';
	}
	if ( $content || $heading ) {
		$html .= '<div class="content-inner" ' . $style_content . '>';
	}
	if ( $heading && $heading_type ) {
		$style_heading = $heading_color ? ' style="color:' . $heading_color . '"' : '';
		$html .= '<div class="sc-heading article_heading"><' . $heading_type . $style_heading . ' class="heading__primary">' . $heading . '</' . $heading_type . '></div>';
	}
	if ( $content ) {
		$html .= '<div class="desc-icon-box" ' . $desc_color . '><div>' . ent2ncr( $content ) . '</div></div>';
	}
	if ( $content || $heading ) {
		$html .= '</div>';
	}
	$html .= $after_link;
	$html .= '</div>';

	return $html;
}

?>