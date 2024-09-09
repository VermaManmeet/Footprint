<?php
add_action( 'travelwp_logo', 'travelwp_logo', 1 );
// logo
if ( !function_exists( 'travelwp_logo' ) ) :
	function travelwp_logo() {
		global $travelwp_theme_options;
		if ( isset( $travelwp_theme_options['travelwp_logo'] ) && $travelwp_theme_options['travelwp_logo']['url'] <> '' ) {
			$url        = $travelwp_theme_options['travelwp_logo']['url'];
			$width      = isset( $travelwp_theme_options['travelwp_logo']['width']) ?  $travelwp_theme_options['travelwp_logo']['width'] : '';
			$height     = isset($travelwp_theme_options['travelwp_logo']['height']) ? $travelwp_theme_options['travelwp_logo']['height'] : '';
			$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
			echo '<img src="' . $url . '" alt="' . $site_title . '" width="' . $width . '" height="' . $height . '" class="logo_transparent_static"/>';
		} else {
			echo esc_attr( get_bloginfo( 'name' ) );
		}
	}
endif;

add_action( 'travelwp_logo_home_page', 'travelwp_logo_home_page', 1 );
// logo
if ( !function_exists( 'travelwp_logo_home_page' ) ) :
	function travelwp_logo_home_page() {
		global $travelwp_theme_options;
		if ( isset( $travelwp_theme_options['logo_home_page'] ) && $travelwp_theme_options['logo_home_page']['url'] <> '' ) {
			$url        = $travelwp_theme_options['logo_home_page']['url'];
			$width      =   isset($travelwp_theme_options['logo_home_page']['width']) ?$travelwp_theme_options['logo_home_page']['width'] : '';
			$height     = isset($travelwp_theme_options['logo_home_page']['height']) ? $travelwp_theme_options['logo_home_page']['height'] : '';
			$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
			echo '<img src="' . $url . '" alt="' . $site_title . '" width="' . $width . '" height="' . $height . '" class="logo_transparent_static"/>';
		} elseif ( isset( $travelwp_theme_options['travelwp_logo'] ) && $travelwp_theme_options['travelwp_logo']['url'] <> '' ) {
			$url        = $travelwp_theme_options['travelwp_logo']['url'];
			$width      = isset($travelwp_theme_options['travelwp_logo']['width']) ? $travelwp_theme_options['travelwp_logo']['width'] : '';
			$height     = isset($travelwp_theme_options['travelwp_logo']['height'])? $travelwp_theme_options['travelwp_logo']['height'] : '';
			$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
			echo '<img src="' . $url . '" alt="' . $site_title . '" width="' . $width . '" height="' . $height . '" class="logo_transparent_static"/>';
		} else {
			echo esc_attr( get_bloginfo( 'name' ) );
		}
	}
endif;

add_action( 'travelwp_sticky_logo', 'travelwp_sticky_logo', 1 );
// get sticky logo
if ( !function_exists( 'travelwp_sticky_logo' ) ) :
	function travelwp_sticky_logo() {
		global $travelwp_theme_options;
		if ( isset( $travelwp_theme_options['travelwp_sticky_logo'] ) && $travelwp_theme_options['travelwp_sticky_logo']['url'] <> '' ) {
			$url        = $travelwp_theme_options['travelwp_sticky_logo']['url'];
			$width      = isset($travelwp_theme_options['travelwp_sticky_logo']['width']) ? $travelwp_theme_options['travelwp_sticky_logo']['width'] : "";
			$height     = isset($travelwp_theme_options['travelwp_sticky_logo']['height']) ? $travelwp_theme_options['travelwp_sticky_logo']['height'] : '';
			$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
			echo '<img src="' . $url . '" alt="' . $site_title . '" width="' . $width . '" height="' . $height . '" class="logo_sticky"/>';
		} elseif ( isset( $travelwp_theme_options['travelwp_logo'] ) && $travelwp_theme_options['travelwp_logo']['url'] <> '' ) {
			$url        = $travelwp_theme_options['travelwp_logo']['url'];
			$width      = isset($travelwp_theme_options['travelwp_logo']['width']) ? $travelwp_theme_options['travelwp_logo']['width'] : '';
			$height     = isset($travelwp_theme_options['travelwp_logo']['height']) ? $travelwp_theme_options['travelwp_logo']['height'] : '';
			$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
			echo '<img src="' . $url . '" alt="' . $site_title . '" width="' . $width . '" height="' . $height . '" class="logo_sticky" />';
		}
	}
endif;
