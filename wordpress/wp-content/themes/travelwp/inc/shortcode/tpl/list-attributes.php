<?php
$attr_woo = $settings['attributes_woo'];
$data     = '';

$class_style = 'pain';
if ( $settings['style'] == 'style_1' ) {
	$data = ' data-dots="true"';
	if ( $settings['navigation'] ) {
		$data .= ' data-nav="' . $settings['navigation'] . '"';
	} else {
		$data .= ' data-nav="false"';
	}
	$item_on_row = $settings['item_on_row'];
	$data        .= ' data-responsive=\'{"0":{"items":1}, "480":{"items":2}, "768":{"items":' . ( $item_on_row - 2 ) . '}, "992":{"items":' . ( $item_on_row - 1 ) . '}, "1200":{"items":' . $item_on_row . '}}\'';
	$class_style = 'slider';
}
// check attributes remove
$taxonomies = get_object_taxonomies( 'product', 'objects' );
if ( empty( $taxonomies ) ) {
	return '';
}

$flag = false;

foreach ( $taxonomies as $tax ) {
	$tax_name = $tax->name;
	if ( 0 !== strpos( $tax_name, 'pa_' ) ) {
		continue;
	}
	if ( in_array( $tax_name, $attr_woo ) ) {
		$flag = true;
	}
}

//end check attributes remove
if ( count( $attr_woo ) > 0 && $flag == true ) {
	echo '<div class="row wrapper-tours-slider wrapper-tours-type-slider' . $settings['animation'] . '">
					<div class="tours-type-' . $class_style . '"' . $data . '>';
	$i = 1;
	foreach ( $attr_woo as $attr ) {
		$terms_off_attr = get_terms( $attr, 'number=' . $settings['limit'] );
		foreach ( $terms_off_attr as $term ) {
			$image_size = array( 370, 370 );
			if ( isset( $settings['thumbnail_size'] ) && $settings['thumbnail_size'] ) {
				$image_size = $settings['thumbnail_size'];
			}
			if ( $term ) {
				$class       = $count = $image_demo = '';
				$link_image  = get_tax_meta( $term->term_id, 'phys_tour_type_thumb', true ) ? get_tax_meta( $term->term_id, 'phys_tour_type_thumb', true ) : '';
				$text_color  = get_tax_meta( $term->term_id, 'phys_text_color', true ) ? get_tax_meta( $term->term_id, 'phys_text_color', true ) : '';
				$custom_link = get_tax_meta( $term->term_id, 'phys_custom_link', true ) ? get_tax_meta( $term->term_id, 'phys_custom_link', true ) : get_term_link( $term->slug, $attr );
				$css         = $text_color ? ' style="color:' . $text_color . '"' : '';
				$image_demo  = '';
				$count       = '<div class="count-attr">' . $term->count . ' ' . esc_html__( 'Tours', 'travelwp' ) . '</div>';
				if ( $settings['style'] == 'style_2' && $i == 1 ) {
					$class      = " width2x3";
					$image_size = array( 760, 370 );
					$image_demo = '-1';
				}

				$link_image_crop = get_template_directory_uri() . '/images/image-demo' . $image_demo . '.jpg';
				if ( $link_image ) {
					$image_crop      = wp_get_attachment_image_src( $link_image['id'], $image_size );
					if($image_crop){
						$link_image_crop = $image_crop[0];
					}
				}

				echo '<div class="tours_type_item' . $class . '">
						<a href="' . esc_url( $custom_link ) . '" title="' . $term->name . '" class="tours-type__item__image">
							<img src="' . esc_url( $link_image_crop ) . '" alt="' . $term->name . '">
						</a>
						<div class="content-item"' . $css . '>
						<div class="item__title">' . $term->name . '</div>';
				if ( ( isset( $settings['show_count'] ) && $settings['show_count'] == "yes" ) || $settings['style'] == 'style_2' ) {
					echo $count;
				}
				echo '</div></div>';
			}
			$i ++;
			if ( $i == 7 ) {
				$i = 1;
			}
		}
		$i ++;
		if ( $i == 7 ) {
			$i = 1;
		}
	}
	echo '</div></div>';
}

