<?php
//Add info for Dashboard Admin
if ( ! function_exists( 'phys_travelwp_links_guide_user' ) ) {
	function phys_travelwp_links_guide_user() {
		return array(
			'docs'      => 'https://docs.physcode.com/travelwp-wordpress-theme-documentation/',
			'support'   => 'https://support.physcode.com/forums/forum/travelwp-wordpress-theme/',
			'knowledge' => 'https://support.physcode.com/knowledge-base/',
		);
	}
}
add_filter( 'phys_theme_links_guide_user', 'phys_travelwp_links_guide_user' );

/**
 * Link purchase theme.
 */
if ( ! function_exists( 'phys_travelwp_link_purchase' ) ) {
	function phys_travelwp_link_purchase() {
		return 'https://themeforest.net/item/travelwp-traveltour-booking-wordpress-theme/19029758';
	}
}
add_filter( 'phys_envato_link_purchase', 'phys_travelwp_link_purchase' );
if ( ! function_exists( 'phys_travelwp_theme_options_section' ) ) {
	function phys_travelwp_theme_options_section() {
		return array( 'general', 'header', 'display_setting', '', '', 'archive_settings', 'Post & Page Setting', 'woo_setting', '', '', '', 'Tour Settings', '', '', 'Social Sharing', 'Styling', 'Typography', 'Footer', 'Newsletter' );
	}
} 
add_filter( 'phys_theme_options_section', 'phys_travelwp_theme_options_section' );
add_filter('phys_name_theme_panel_active_customize', function () {
	return 'travelwp';
});
/**
 * Envato id.
 */
if ( ! function_exists( 'phys_travelwp_envato_item_id' ) ) {
	function phys_travelwp_envato_item_id() {
		return '19029758';
	}
}

add_filter( 'phys_envato_item_id', 'phys_travelwp_envato_item_id' );

add_filter( 'phys_prefix_folder_download_data_demo', function () {
	return 'travelwp';
} );


add_filter( 'phys_core_list_child_themes', 'phys_list_child_themes' );
function phys_list_child_themes() {
	return array(
		'travelwp-child' => array(
			'name'       => 'travelwp Child',
			'slug'       => 'travelwp-child',
			'screenshot' => 'https://physcodewp.github.io/demo-data/travelwp/child-themes/screenshot.png',
			'source'     => 'https://physcodewp.github.io/demo-data/travelwp/child-themes/travelwp-child.zip',
			'version'    => '1.0.0'
		),
	);
}

add_filter( 'phys_importer_basic_settings', 'phys_import_add_basic_settings' );
function phys_import_add_basic_settings($settings) {
	$settings[] = 'travelwp_theme_options';
	$settings[] = 'tours_show_page_id';
	$settings[] = 'tour_search_by_attributes'; 	 
	$settings[] = 'medium_size_w';
	$settings[] = 'medium_size_h';
	$settings[] = 'woocommerce_single_image_width';
	$settings[] = 'woocommerce_thumbnail_image_width';
	$settings[] = 'thim_enable_mega_menu';
	$settings[] = 'permalink_structure';
	$settings[] = 'thim_ekits_widget_settings';
	$settings[] = 'elementor_css_print_method';
	$settings[] = 'elementor_experiment-container';
	$settings[] = 'elementor_experiment-nested-elements';
	$settings[]	= 'elementor_google_font';
	$settings[]	= 'elementor_disable_typography_schemes';
	$settings[] = 'elementor_experiment-e_font_icon_svg';
	$settings[] = 'thim_ekits_advanced_settings';
	$settings[] = 'tour_enable_tour_review';
	$settings[] = 'location_option';
	for ( $i = 0; $i <= 100; $i ++ ) {
		$settings[] = 'tax_meta_' . $i;
	}
	$settings[] = 'sb_instagram_settings';
	return $settings;
}
add_filter( 'phys_importer_page_id_settings', 'phys_import_add_page_id_settings' );
function phys_import_add_page_id_settings( $settings ) {
	$settings[] = 'elementor_active_kit';

	return $settings;
}
// convert url in key
add_filter( 'phys_core_base_setting_convert_url', function () {
	return 'travelwp_theme_options'; 
} );
