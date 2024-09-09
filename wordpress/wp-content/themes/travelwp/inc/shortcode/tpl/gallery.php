<?php
$html = '';

// get attachments set
$queryArgs   = array(
	'post_status'    => 'inherit',
	'post_type'      => 'attachment',
	'posts_per_page' => - 1,
	'post_mime_type' => 'image',
	'order'          => 'DESC',
	'orderby'        => 'menu_order ID',
	'post__in'       => $settings['id_image'],
);
$attachments = get_posts( $queryArgs );

$gallery_images = array();
$category_media = array();
if ( $attachments ) {
	foreach ( $attachments as $attachment ) {
		$id_att            = $attachment->ID;
		$image_att_full    = wp_get_attachment_image_src( $id_att, 'full' );
		$image_custom_size = wp_get_attachment_image_src( $id_att, $settings['images_size'] );
		$link_full         = ! empty( $image_att_full[0] ) ? $image_att_full[0] : '';
		$image_medium_size = ! empty( $image_custom_size[0] ) ? $image_custom_size[0] : '';
		// categories
		$image_categories = array();
		$taxonomies       = get_the_terms( $id_att, 'media_category' );
		if ( $taxonomies ) {
			foreach ( $taxonomies as $taxonomy ) {
				$category_media[$taxonomy->slug]   = $taxonomy->name;
				$image_categories[$taxonomy->slug] = $taxonomy->name;
			}
		}

		$alt = get_post_meta( $id_att, '_wp_attachment_image_alt', true );

		$gallery_images[] = array(
			'link_full'         => $link_full,
			'image_medium_size' => $image_medium_size,
			'title'             => $attachment->post_title,
			'categories'        => $image_categories,
			'alt'               => $alt ? $alt : $attachment->post_title,
		);
	}
	wp_reset_postdata();
}

if ( ! $gallery_images ) {
	return '';
}
wp_enqueue_style( 'travelwp-swipebox' );
wp_enqueue_script( 'travelwp-swipebox' );
wp_enqueue_script( 'travelwp-isotope' );

$html .= '<div class="sc-gallery wrapper_gallery' . $settings['animation'] . '">';
// begin filter
if ( $settings['filter'] == true ) {
	$html .= '<div class="gallery-tabs-wrapper filters"><ul class="gallery-tabs">';
	$html .= '<li><a href="#" data-filter="*" class="filter active">' . esc_html__( 'all', 'travelwp' ) . '</a></li>';
	foreach ( $category_media as $cat_slug => $cat_name ) {
		$html .= '<li><a href="#" data-filter=".' . esc_attr( $cat_slug ) . '" class="filter">' . esc_html( $cat_name ) . '</a></li>';
	}
	$html .= '</ul></div>';
}

//end filter
// begin content
$html .= '<div class="row content_gallery">';
foreach ( $gallery_images as $image ) {
	$data_filters = '';
	if ( ! empty( $image['categories'] ) ) {
		foreach ( $image['categories'] as $slug => $name ) {
			$data_filters .= ' ' . $slug;
		}
	}
	$html .= '<div class="col-sm-' . $settings['column'] . ' gallery_item-wrap' . esc_attr( $data_filters ) . '">';
	$html .= '<a href="' . esc_url( $image['link_full'] ) . '" class="swipebox" title="' . esc_attr( $image['title'] ) . '">
					<img src="' . esc_url( $image['image_medium_size'] ) . '" alt="' . esc_attr( $image['alt'] ) . '">
					<span class="gallery-item"><h4 class="title">' . esc_html( $image['title'] ) . '</h4></span>
				</a>';
	$html .= '</div>';
}
wp_reset_postdata();
$html .= '</div>';
// end content
$html .= '</div>';

echo $html;
