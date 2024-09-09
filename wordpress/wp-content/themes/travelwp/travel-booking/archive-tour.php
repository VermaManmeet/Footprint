<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * @author : Physcode
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();
if ( get_option( Tour_Settings_Tab_Phys::$_tours_show_page_id ) ) {
	$page_current_id = get_option( Tour_Settings_Tab_Phys::$_tours_show_page_id );

	do_action( 'travelwp_wrapper_banner_heading' );

	do_action( 'travelwp_wrapper_loop_start' );

	$layout      = 'grid';
	$item_layout = 'style_1';
	$layout      = travelwp_get_option( 'phys_tour_layout_content' );
	$item_layout = travelwp_get_option( 'phys_style_item_tour' );
	$cat_obj     = travelwp_get_wp_query()->get_queried_object();
	$cat_ID      = '';
	if ( isset( $cat_obj->term_id ) ) {
		$cat_ID = $cat_obj->term_id;
	}
	$custom_layout_content = get_tax_meta( $cat_ID, 'phys_layout_content', true );
	if ( $custom_layout_content <> '' ) {
		$layout = get_tax_meta( $cat_ID, 'phys_layout_content', true );
	}
	$custom_style_item = get_tax_meta( $cat_ID, 'phys_item_style', true );
	if ( $custom_style_item <> '' ) {
		$item_layout = get_tax_meta( $cat_ID, 'phys_item_style', true );
	}

	do_action( 'travelbooking_result_count' );

//	tb_get_file_template( 'loop/result-count.php' );

	?>

<ul class="tours products wrapper-tours-slider content_tour_<?php echo esc_attr( $item_layout ); ?>">
	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>
			<li <?php post_class( travelwp_option_column_content( $layout, 'column_tour' ) ); ?>>
				<?php
				if ( $layout == 'list' ) {
					tb_get_file_template( 'content-list.php', false );
				} else {
					if ( $item_layout == 'style_1' || $item_layout == '' ) {
						tb_get_file_template( 'content-tour.php', false );
					} elseif ( $item_layout == 'style_2' ) {
						tb_get_file_template( 'content-tour-2.php', false );
					}
				}
				?>
			</li>
		<?php endwhile; ?>
		</ul>
	<?php else: ?>

		<p class="woocommerce-info"><?php esc_html_e( 'No tours were found matching your selection.', 'travelwp' ); ?></p>

	<?php endif; ?>
	<?php

	travel_the_posts_navigation();

	do_action( 'travelwp_wrapper_loop_end' );
}
get_footer();
exit;
?>
