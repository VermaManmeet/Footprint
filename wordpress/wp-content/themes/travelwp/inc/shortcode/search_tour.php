<?php
vc_map(
	array(
		"name"        => esc_html__( "Search Tours", 'travelwp' ),
		"icon"        => "icon-ui-splitter-horizontal",
		"base"        => "booking_tour",
		"description" => "Show tour",
		"category"    => esc_html__( "Travelwp", 'travelwp' ),
		"params"      => array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'travelwp' ),
				'param_name' => 'style',
				'std'        => 'style_1',
				'value'      => array(
					esc_html__( 'Style 1', 'travelwp' ) => 'style_1',
					esc_html__( 'Style 2', 'travelwp' ) => 'style_2'
				)
			),
			array(
				"type"        => "checkbox",
				"heading"     => esc_html__( "Hide Tour Name", 'travelwp' ),
				"param_name"  => "hide_tour_name",
				'admin_label' => false,
			),
			array(
				"type"        => "checkbox",
				"heading"     => esc_html__( "Hide Tour Type", 'travelwp' ),
				"param_name"  => "hide_tour_tyle",
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
function travelwp_shortcode_booking_tour( $atts, $content = null ) {
	$el_class = $css_animation = $style = $hide_tour_tyle = $hide_tour_name = '';
	extract(
		shortcode_atts(
			array(
				'style'          => 'style_1',
				'hide_tour_tyle' => '',
				'hide_tour_name' => '',
				'el_class'       => '',
				'css_animation'  => '',
			), $atts
		)
	);
	ob_start();
	$taxonomy_tour_type      = 'tour_phys'; // taxonomy slug
	$tour_terms              = get_terms( $taxonomy_tour_type );
	$select_option_tour_type = '';

	foreach ( $tour_terms as $term ) {
		$select_option_tour_type .= '<option value="' . $term->slug . '">' . $term->name . '</option>';
	}

	$option_attribute_to_search = get_option( 'tour_search_by_attributes' );
	$el_search_by_attribute     = '';
	if ( is_array( $option_attribute_to_search ) ) {
		foreach ( $option_attribute_to_search as $attribute_to_search ) {
			$tax_attribute      = get_taxonomy( $attribute_to_search );
			$terms_of_attribute = get_terms( $attribute_to_search );
			if ( ( !empty( $terms_of_attribute ) && !is_wp_error( $terms_of_attribute ) ) && count( $terms_of_attribute ) > 0 ) {
				$el_search_by_attribute .= '<li class="hb-form-field">';
				$el_search_by_attribute .= '<div class="hb-form-field-select">';
				if ( $style == 'style_2' ) {
					if ( $tax_attribute->name == 'pa_destination' ) {
						$el_search_by_attribute .= '<label>' . esc_html__( 'Where', 'travelwp' ) . '</label>';
					} elseif ( $tax_attribute->name == 'pa_month' ) {
						$el_search_by_attribute .= '<label>' . esc_html__( 'When', 'travelwp' ) . '</label>';
					} else {
						$el_search_by_attribute .= '<label>' . esc_html__( 'Choose', 'travelwp' ) . ' ' . $tax_attribute->label . '</label>';
					}
				}
				$el_search_by_attribute .= '<select name="tourtax[' . $attribute_to_search . ']">';
				$el_search_by_attribute .= '<option value="0">' . esc_html__( $tax_attribute->labels->singular_name, 'travelwp' ) . '</option>';
				foreach ( $terms_of_attribute as $term ) {
					$el_search_by_attribute .= '<option value="' . $term->slug . '">' . $term->name . '</option>';
				}
				$el_search_by_attribute .= '</select>';
				$el_search_by_attribute .= '</div>';
				$el_search_by_attribute .= '</li>';
			}
		}
	}
	$travelwp_animation = $el_class ? ' ' . $el_class : '';
	$travelwp_animation .= travelwp_getCSSAnimation( $css_animation );
	$travelwp_animation .= ' travel-booking-' . $style;
	$link_tours         = add_query_arg( 'page_id', get_option( Tour_Settings_Tab_Phys::$_tours_show_page_id ), home_url() );
	$lang               = isset( $_GET['lang'] ) ? $_GET['lang'] : '';
	$input_lang         = '<input type="hidden" name="lang" value="' . $lang . '">';
	echo '<div class="hotel-booking-search travel-booking-search ' . $travelwp_animation . '">
				<form name="hb-search-form" action="' . $link_tours . '"  id="tourBookingFormSearch" method="GET">
					<ul class="hb-form-table">';
	if ( $style == 'style_1' ) {
		if ( $hide_tour_name != 'true' ) {
			echo '<li class="hb-form-field">
			<div class="hb-form-field-input">
				<input type="text" name="name_tour" value="" placeholder="' . esc_html__( 'Tour name', 'travelwp' ) . '">
			</div>
		</li>';
		}
		echo '<input type="hidden" name="tour_search" value="1">';
		if ( $hide_tour_tyle != 'true' ) {
			echo '<li class="hb-form-field">
				<div class="hb-form-field-select">
					<select name="tourtax[tour_phys]">
					<option value="0">' . esc_html__( 'Tour Type', 'travelwp' ) . '</option>
					' . $select_option_tour_type . '
					</select>
				</div>
			</li>';
		}


		echo $el_search_by_attribute . '
		<li class="hb-submit">
			<button type="submit">' . esc_html__( 'Search Tours', 'travelwp' ) . '</button>
		</li>';
	} else {
		if ( $hide_tour_name != 'true' ) {
			echo '<li class="hb-form-field">
				<div class="hb-form-field-input">
					<label>' . esc_html__( 'Anything', 'travelwp' ) . '</label>
					<input type="text" name="name_tour" value="" placeholder="' . esc_html__( 'Tour Name, Destination', 'travelwp' ) . '">
				</div>
			</li>';
		}
		echo '<input type="hidden" name="tour_search" value="1">';
		if ( $hide_tour_tyle != 'true' ) {
			echo '<li class="hb-form-field">
					<div class="hb-form-field-select">
						<label>' . esc_html__( 'You like', 'travelwp' ) . '</label>
						<select name="tourtax[tour_phys]">
						<option value="0">' . esc_html__( 'Tour Type', 'travelwp' ) . '</option>
						' . $select_option_tour_type . '
						</select>
					</div>
				</li>';
		}
		echo $el_search_by_attribute . '
		<li class="hb-submit">
			<button type="submit">' . esc_html__( 'Search', 'travelwp' ) . '</button>
		</li>';
	}


	echo '</ul>' . $input_lang . '
			</form></div>';
	$content = ob_get_clean();

	return $content;
}
?>