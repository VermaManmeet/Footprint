<?php
if ( ! defined( 'TRAVELWP_UPLOADS_FOLDER' ) ) {
	define( 'TRAVELWP_UPLOADS_FOLDER', trailingslashit( TRAVELWP_THEME_DIR ) . '/assets/css/' );
}
if ( ! defined( 'TRAVELWP_UPLOADS_URL' ) ) {
	define( 'TRAVELWP_UPLOADS_URL', trailingslashit( get_template_directory_uri() ) . '/assets/css/' );
}
if ( ! defined( 'TRAVELWP_FILE_NAME' ) ) {
	define( 'TRAVELWP_FILE_NAME', 'physcode_travelwp.css' ); 
}

function options_to_css() {

	$css = '';
	global $travelwp_theme_options; /* already initialised the Filesystem API previously */
	// put content
	$theme_options      = array(
		// hearder
		'width_logo'                => '1',
		'width_logo_mobile'         => '1',
		'bg_header_color'           => 'rgba',
		'bg_top_bar'                => 'rgba',
		'text_color_top_bar'        => '0',
		'link_color_top_bar'        => '0',
		'text_menu_color'           => '0',
		'text_home_page'            => '0',
		'font_size_main_menu'       => '1',
		'font_weight_main_menu'     => '0',
		'bg_sticky_menu'            => 'rgba',
		'text_color_sticky_menu'    => '0',
		'sub_menu_bg_color'         => '0',
		'sub_menu_text_color'       => '0',
		'sub_menu_text_hover_color' => '0',
		'mobile_menu_bg_color'      => '0',
		'mobile_menu_text_color'    => '0',
		'mobile_text_hover_color'   => '0',
		//styling
		'body_color_primary'        => '0',
		'body_color_second'         => '0',
		//			//typography
		'font_size_h1'              => '1',
		'font_weight_h1'            => '0',
		'font_size_h2'              => '1',
		'font_weight_h2'            => '0',
		'font_size_h3'              => '1',
		'font_weight_h3'            => '0',
		'font_size_h4'              => '1',
		'font_weight_h4'            => '0',
		'font_size_h5'              => '1',
		'font_weight_h5'            => '0',
		'font_size_h6'              => '1',
		'font_weight_h6'            => '0',
		//footer
		'bg_footer'                 => '0',
		'text_color_footer'         => '0',
		'text_font_size_footer'     => '1',
		'border_color_footer'       => '0',
		'title_color_footer'        => '0',
		'title_font_size_footer'    => '1',
		'bg_newsletter_color'       => 'rgba'
	);
	$theme_options_data = '';
	foreach ( $theme_options as $key => $val ) {
		if ( $val == '0' ) {
			$data = isset( $travelwp_theme_options[$key] ) ? $travelwp_theme_options[$key] : '';
		} elseif ( $val == '1' ) {
			$data = isset( $travelwp_theme_options[$key] ) ? $travelwp_theme_options[$key] . 'px' : '';
		} else {
			$data = isset( $travelwp_theme_options[$key][$val] ) ? $travelwp_theme_options[$key][$val] : '';
		}
		if($data){
			$theme_options_data .= "--phys-{$key}: {$data};\n";
			if ( $key == 'body_color_primary' || $key == 'body_color_second') {
				if (  $data[0] == '#' ) {
					list( $r, $g, $b ) = sscanf( $data, "#%02x%02x%02x" );
					$theme_options_data .= '--phys-' . $key . '_rgb: ' . $r . ',' . $g . ',' . $b . ';';
				} else {
					$rgba    = explode( ',', $data );
					$rgba_rr = explode( '(', $rgba['0'] );
					$theme_options_data     .= '--phys-' . $key . '_rgb: ' . $rgba_rr['1'] . ',' . $rgba['1'] . ',' . $rgba['2'] . ';';
				}
			}
		}
 //	        $theme_options_data .= "\${$key}: var(--phys-{$key},{$data});\n";
	}


	$theme_options_data .= !empty($travelwp_theme_options['font_body']['color'] ) ? '--phys-body_color:' . $travelwp_theme_options['font_body']['color'] . ';' : '--phys-body_color:#3333;';
	$theme_options_data .= !empty($travelwp_theme_options['font_body']['font-family'])  ? '--phys-body-font-family: ' . $travelwp_theme_options['font_body']['font-family'] . ',Helvetica,Arial,sans-serif;' : '--phys-body-font-family:Helvetica,Arial,sans-serif;';
	$theme_options_data .= !empty($travelwp_theme_options['font_body']['font-weight'])  ? '--phys-font_weight_body: ' . $travelwp_theme_options['font_body']['font-weight'] . ';' : '--phys-font_weight_body:Normal;';
	$theme_options_data .= !empty($travelwp_theme_options['font_body']['font-size'])  ? '--phys-body_font_size: ' . $travelwp_theme_options['font_body']['font-size'] . ';' : '--phys-body_font_size:13px;';
	$theme_options_data .= !empty($travelwp_theme_options['font_body']['line-height'])  ? '--phys-body_line_height: ' . $travelwp_theme_options['font_body']['line-height'] . ';' : '--phys-body_line_height:24px';
	// font heading
	$theme_options_data .= !empty($travelwp_theme_options['font_title']['font-family'])  ? '--phys-heading-font-family: ' . $travelwp_theme_options['font_title']['font-family'] . ',Helvetica,Arial,sans-serif;' : '--phys-heading-font-family:Helvetica,Arial,sans-serif;';
	$theme_options_data .= !empty($travelwp_theme_options['font_title']['color'])  ? '--phys-heading-color: ' . $travelwp_theme_options['font_title']['color'] . ';' : '--phys-heading-color:#333;';
	$theme_options_data .= !empty( $travelwp_theme_options['font_title']['font-weight']) ? '--phys-heading-font-weight: ' . $travelwp_theme_options['font_title']['font-weight'] . ';' : '--phys-heading-font-weight:Normal;';
	if ( $theme_options_data ) {
		$css .= ':root{' . preg_replace(
				array( '/\s*(\w)\s*{\s*/', '/\s*(\S*:)(\s*)([^;]*)(\s|\n)*;(\n|\s)*/', '/\n/', '/\s*}\s*/' ),
				array( '$1{ ', '$1$3;', "", '} ' ), $theme_options_data
			) . '}';
	}

	$background_color   =  isset( $travelwp_theme_options['body_background']['background-color']) && $travelwp_theme_options['body_background']['background-color'] ? ' background-color: ' . $travelwp_theme_options['body_background']['background-color'] : '';

	if ( $background_color ) {
		$css .= '.wrapper-content,.single-woo-tour .description_single .affix-sidebar,.wrapper-price-nights .price-nights-details{' . $background_color . '}
				.post_list_content_unit .post-list-content .post_list_meta_unit .sticky_post:after{border-color: transparent transparent ' . $travelwp_theme_options['body_background']['background-color'] . ' transparent;}
			';
	}
	if ( isset( $travelwp_theme_options['box_layout'] ) && $travelwp_theme_options['box_layout'] == 'boxed' ) {
		$background_image = '';
		if ( $travelwp_theme_options['body_background']['background-image'] ) {
			$background_image .= $travelwp_theme_options['body_background']['background-image'] ? 'background-image: url( ' . $travelwp_theme_options['body_background']['background-image'] . ');' : '';
		} elseif ( isset( $travelwp_theme_options['background_pattern'] ) ) {
			$background_image .= $travelwp_theme_options['background_pattern'] ? 'background-image: url( ' . $travelwp_theme_options['background_pattern'] . ');' : '';
		}
		$background_image .= $travelwp_theme_options['body_background']['background-repeat'] ? 'background-repeat: ' . $travelwp_theme_options['body_background']['background-repeat'] . ';' : '';
		$background_image .= $travelwp_theme_options['body_background']['background-size'] ? 'background-size: ' . $travelwp_theme_options['body_background']['background-size'] . ';' : '';
		$background_image .= $travelwp_theme_options['body_background']['background-attachment'] ? 'background-attachment: ' . $travelwp_theme_options['body_background']['background-attachment'] . ';' : '';
		$background_image .= $travelwp_theme_options['body_background']['background-position'] ? 'background-position: ' . $travelwp_theme_options['body_background']['background-position'] . ';' : '';
		if ( $background_image ) {
			$css .= 'body{' . $background_image . '}';
		}
	}
	// custom css
	if(isset($travelwp_theme_options['opt-ace-editor-css'])){
		$css .= $travelwp_theme_options['opt-ace-editor-css'];
	}
	$terms  = get_terms('tour_phys', array( 
		'pad_counts'         => 1,
		'show_counts'        => 1,
		'hierarchical'       => 1,
		'hide_empty'         => 1,
		'show_uncategorized' => 1,
		'orderby'            => 'name',
		'menu_order'         => false
	));
	$term_background = array();
	if (!is_wp_error($terms) && !empty($terms)) {
		foreach ($terms as $term) {
			$term_color =  get_term_meta($term->term_id, 'tour_phys_meta_key',true);
			if(!empty($term_color)){
			$term_background[] = '.term-' . esc_html($term->slug) . '{
				background	: ' . $term_color["tour_phys_background_color"]. '!important;
				color: ' . $term_color["tour_phys_text_color"] . '!important;
			}
			.term-' . esc_html($term->slug) . ':hover{	
    			opacity: 0.8;
			}';
			}
		}
	}
	$css .= esc_attr(implode(' ', $term_background));
	// var_dump($css);
	return $css;
}

