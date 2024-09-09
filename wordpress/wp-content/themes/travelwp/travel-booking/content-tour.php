<?php
/**
 * Content tour
 * @author : Physcode
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="item_border">
	<div class="item_content">
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
			$terms = get_the_terms( get_the_ID(), 'tour_phys' );
			if ( $terms && !is_wp_error( $terms ) ) :
				echo '<div class="group-icon">';
				$i = 0;
				foreach ( $terms as $term ) {
					$link       = get_term_link( $term->term_id );
					$icon       = get_tax_meta( $term->term_id, 'phys_tour_type_icon', true );
					$icon_image = get_tax_meta( $term->term_id, 'phys_tour_type_image_icon', true );
					if ( $icon_image ) {
						if ( $i == 0 ) {
							$frist = ' class="frist"';
						} else {
							$frist = '';
						}
						echo '<a href="' . $link . '" data-toggle="tooltip" data-placement="top" title="' . $term->name . '"' . $frist . '><img src="' . $icon_image['url'] . '" alt="' . $term->name . '" class="icon-image"></a>';
					} else {
						if ( $icon != 'none' && $icon != '' ) {
							if ( $i == 0 ) {
								$frist = ' class="frist"';
							} else {
								$frist = '';
							}
							echo '<a href="' . $link . '" data-toggle="tooltip" data-placement="top" title="' . $term->name . '"' . $frist . '><i class="' . $icon . '"></i></a>';
						}
					}
					$i ++;
				}
				echo '</div>';
			endif; ?>
		</div>
		<div class="wrapper_content">
			<?php
			/**
			 * woocommerce_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			the_title( sprintf( '<div class="post_title"><h4><a href="%s" rel="bookmark">', esc_url( get_permalink( get_the_ID() ) ) ), '</a></h4></div>' );
			$duration = get_post_meta( get_the_ID(), '_tour_duration', true );
			if ( $duration ) {
				echo '<span class="post_date">' . $duration . '</span>';
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
	</div>
	<div class="read_more">
		<?php
		do_action( 'woocommerce_item_rating' );
		do_action( 'woocommerce_after_shop_loop_item' ); ?>
	</div>
</div>