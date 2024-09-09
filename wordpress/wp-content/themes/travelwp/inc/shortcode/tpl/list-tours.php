<?php
$query_args = array(
	'posts_per_page' => $settings['limit'],
	'post_status'    => 'publish',
	'no_found_rows'  => 1,
	'order'          => $settings['order'] == 'asc' ? 'asc' : 'desc',
	'post_type'      => array( 'product' ),
	'wc_query'       => 'tours'
);
$query_args['meta_query'] = array();
if ( $settings['show'] == 'tour_cat' && $settings['tour_cat'] <> '' ) {
//	$tour_cat_id             = explode( ',', $settings['tour_cat'] );
	$query_args['tax_query'] = array(
		array(
			'taxonomy' => 'tour_phys',
			'field'    => $settings['term_by'],
			'terms'    => $settings['tour_cat'],
			'operator' => 'IN',
		)
	);
} else {
	$query_args['tax_query'] = array(
		array(
			'taxonomy' => 'product_type',
			'field'    => 'slug',
			'terms'    => array( 'tour_phys' ),
			'operator' => 'IN',
		)
	);
}
switch ( $settings['orderby'] ) {
	case 'price' :
		$query_args['meta_key'] = '_price';
		$query_args['orderby']  = 'meta_value_num';
		break;
	case 'rand' :
		$query_args['orderby'] = 'rand';
		break;
	case 'sales' :
		$product_ids_on_sale    = wc_get_product_ids_on_sale();
		$product_ids_on_sale[]  = 0;
		$query_args['post__in'] = $product_ids_on_sale;
		$query_args['meta_key'] = '_price';
		$query_args['orderby']  = 'meta_value_num';
		break;
	case 'menu_order' :
		$query_args['orderby'] = 'menu_order';
		break;
	default :
		$query_args['orderby'] = 'date';
}

echo '<div class="row wrapper-tours-slider' . $settings['animation'] . '">';
$the_query = new WP_Query( $query_args );

if ( $the_query->have_posts() ) :
	$data = '';
	if ( $settings['style'] == 'slider' ) {
		$data .= 'data-dots="true"';
 		if ( $settings['navigation'] ) {
			$data .= ' data-nav="' . $settings['navigation'] . '"';
		} else {
			$data .= ' data-nav="false"';
		}
		$data .= ' data-responsive=\'{"0":{"items":1}, "480":{"items":2}, "768":{"items":2}, "992":{"items":3}, "1200":{"items":' . $settings['tour_on_row'] . '}}\'';
	}

	echo '<div class="list_content content_tour_' . $settings['content_style'] . ' tours-type-' . $settings['style'] . '"' . $data . '>';
	$class_item = $settings['style'] == 'pain' ? ' col-sm-' . intval( 12 / $settings['tour_on_row'] ) : "";
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		echo '<div class="item-tour' . $class_item . '">';
		if ( $settings['content_style'] == 'style_1' ) {
			tb_get_file_template( 'content-tour.php', false );
		} elseif ( $settings['content_style'] == 'style_2' ) {
			tb_get_file_template( 'content-tour-2.php', false );
		}
		echo '</div>';
	endwhile;
	echo '</div>';
	// Reset Post Data
	wp_reset_postdata();
else :
	echo '<div class="message-info woocommerce-info">' . __( 'No tours were found matching your selection', 'travelwp' ) . '</div>';
endif;
echo '</div>';
