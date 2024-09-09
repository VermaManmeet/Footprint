<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see           https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.6.3
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

$attachment_ids = 0;

if ( woo_check_versionl() < 3 ) {
	$attachment_ids = $product->get_gallery_attachment_ids();
} elseif ( woo_check_versionl() == 3 ) {
	$attachment_ids = $product->get_gallery_image_ids();
} else {
	$attachment_ids = $product->get_gallery_image_ids();
}

wp_enqueue_style( 'travelwp-swipebox' );
wp_enqueue_script( 'travelwp-swipebox' );
?>

<?php
echo '<div id="slider" class="flexslider"><ul class="slides">';

if ( has_post_thumbnail() ) {
	$attachment_count = count( $attachment_ids );
	$gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
	$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
	$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
		'title' => $props['title'],
		'alt'   => $props['alt'],
	) );
	echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><a href="%s" itemprop="image" class="swipebox" title="%s">%s</a></li>', $props['url'], $props['caption'], $image ), $post->ID );
} else {
	echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><img src="%s" alt="%s" /></li>', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'travelwp' ) ), $post->ID );
}
if ( $attachment_ids ) {
	foreach ( $attachment_ids as $attachment_id ) {
		$image_link = wp_get_attachment_url( $attachment_id );
		if ( !$image_link ) {
			continue;
		}
		$image_title   = esc_attr( get_the_title( $attachment_id ) );
		$image_caption = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );
		$image         = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ), 0, $attr = array(
			'title' => $image_title,
			'alt'   => $image_title
		) );
		echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><a href="%s" class="swipebox" title="%s">%s</a></li>', $image_link, $image_caption, $image ), $attachment_id, $post->ID );
	}
}
echo '</ul></div>';
?>
<div id="carousel" class="flexslider thumbnail_product">
	<ul class="slides"><?php
		if ( has_post_thumbnail() ) {
			$attachment_count = count( $attachment_ids );
			$gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
			$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
			$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_thumbnail' ), array(
				'title' => $props['title'],
				'alt'   => $props['alt'],
			) );
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li>%s</li>', $image ), $post->ID );
		} else {
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li><img src="%s" alt="%s" /></li>', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'travelwp' ) ), $post->ID );
		}
		if ( $attachment_ids ) {
			foreach ( $attachment_ids as $attachment_id ) {
				$image_link = wp_get_attachment_url( $attachment_id );
				if ( !$image_link ) {
					continue;
				}
				$image_title   = esc_attr( get_the_title( $attachment_id ) );
				$image_caption = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

				$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
					'title' => $image_title,
					'alt'   => $image_title
				) );
				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li>%s</li>', $image ), $attachment_id, $post->ID );
			}
		}
		?></ul>
</div>
