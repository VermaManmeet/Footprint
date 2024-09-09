<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 4.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


global $product;
$travelwp_theme_options = travelwp_get_data_themeoptions();


// Ensure visibility
if ( empty( $product ) || !$product->is_visible() ) {
	return;
}

$column_product = 3;

if ( isset( $travelwp_theme_options['column_product'] ) && $travelwp_theme_options['column_product'] ) {
	$column_product = 12 / $travelwp_theme_options['column_product'];
}

// Extra post classes
$classes   = array();
$classes[] = 'item-tour col-md-' . $column_product . ' col-sm-6';
?>

<li <?php post_class( $classes ); ?>>
	<div class="item_border item-product">
		<div class="post_images">
			<?php
			/**
			 * woocommerce_before_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_open - 10
			 */

			do_action( 'woocommerce_before_shop_loop_item' );
			/**
			 * woocommerce_before_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title_price' );
			do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
		</div>
		<div class="wrapper_content">
			<?php
			/**
			 * woocommerce_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			//do_action( 'woocommerce_shop_loop_item_title' );
			the_title( sprintf( '<div class="post_title"><h4><a href="%s" rel="bookmark">', esc_url( get_permalink( get_the_ID() ) ) ), '</a></h4></div>' );

			if ( wc_get_product()->is_type( 'tour_phys' ) ) {
				$duration = get_post_meta( get_the_ID(), '_tour_duration', true );
				if ( $duration > 1 ) {
					echo '<span class="post_date">' . $duration . '</span>';
				}
			}

			/**
			 * woocommerce_after_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );

			/**
			 * woocommerce_after_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			?>
		</div>
		<div class="read_more">
			<?php
			do_action( 'woocommerce_item_rating' );
			do_action( 'woocommerce_after_shop_loop_item' ); ?>
		</div>
	</div>
</li>