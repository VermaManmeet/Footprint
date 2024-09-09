<?php
vc_map( array(
	"name"        => esc_html__( "Social Links", 'travelwp' ),
	"icon"        => "icon-ui-splitter-horizontal",
	"base"        => "social_link",
	"description" => "Social_link",
	"category"    => esc_html__( "Travelwp", 'travelwp' ),
	"params"      => array(
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "Face Url", "travelwp" ),
			"param_name" => "face_url",
		),
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "Twitter Url", "travelwp" ),
			"param_name" => "twitter_url",
		),
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "Google Url", "travelwp" ),
			"param_name" => "google_url",
		),
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "Dribble Url", "travelwp" ),
			"param_name" => "dribble_url",
		),
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "Linkedin Url", "travelwp" ),
			"param_name" => "linkedin_url",
		),
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "Instagram Url", "travelwp" ),
			"param_name" => "instagram_url",
		),
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "Youtube Url", "travelwp" ),
			"param_name" => "youtube_url",
		),
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "Behance Url", "travelwp" ),
			"param_name" => "behance_url",
		),
		array(
			"type"        => "textfield",
			"heading"     => esc_html__( "Extra class name", "travelwp" ),
			"param_name"  => "el_class",
			"description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "travelwp" ),
		),
		travelwp_vc_map_add_css_animation( true )
	)
) );

function travelwp_shortcode_social_link( $atts, $content = null ) {
	$physcode_animation = $css_animation = $el_class = $face_url = $twitter_url =
	$google_url = $html = $dribble_url = $linkedin_url = $instagram_url = $behance_url = $youtube_url = '';
	extract( shortcode_atts( array(
		'face_url'      => '',
		'twitter_url'   => '',
		'google_url'    => '',
		'dribble_url'   => '',
		'linkedin_url'  => '',
		'instagram_url' => '',
		'behance_url'   => '',
		'youtube_url'   => '',
		'el_class'      => '',
		'css_animation' => '',
	), $atts ) );
	if ( $el_class ) {
		$physcode_animation .= ' ' . $el_class;
	}
	$physcode_animation .= travelwp_getCSSAnimation( $css_animation );

	$html .= '<ul class="physcode_social_links' . $physcode_animation . '">';

	if ( $face_url != '' ) {
		$html .= '<li><a class="face" href="' . esc_url( $face_url ) . '" ><i class="fa fa-facebook"></i></a></li>';
	}
	if ( $twitter_url != '' ) {
		$html .= '<li><a class="twitter" href="' . esc_url( $twitter_url ) . '"  ><i class="fa flaticon-twitter"></i></a></li>';
	}
	if ( $google_url != '' ) {
		$html .= '<li><a class="google" href="' . esc_url( $google_url ) . '"  ><i class="fa fa-google-plus"></i></a></li>';
	}
	if ( $dribble_url != '' ) {
		$html .= '<li><a class="dribble" href="' . esc_url( $dribble_url ) . '"  ><i class="fa fa-dribbble"></i></a></li>';
	}
	if ( $linkedin_url != '' ) {
		$html .= '<li><a class="linkedin" href="' . esc_url( $linkedin_url ) . '"  ><i class="fa fa-linkedin"></i></a></li>';
	}

	if ( $instagram_url != '' ) {
		$html .= '<li><a class="instagram" href="' . esc_url( $instagram_url ) . '"  ><i class="fa fa-instagram"></i></a></li>';
	}
	if ( $youtube_url != '' ) {
		$html .= '<li><a class="youtube" href="' . esc_url( $youtube_url ) . '"  ><i class="fa fa-youtube"></i></a></li>';
	}
	if ( $behance_url != '' ) {
		$html .= '<li><a class="behance" href="' . esc_url( $behance_url ) . '"  ><i class="fa fa-behance"></i></a></li>';
	}
	$html .= '</ul>';

	return $html;
}
?>
