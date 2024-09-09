<?php
/**
 * Related Tours
 * @author: Physcode
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$posts_per_page = 3;
$terms          = get_the_terms( $product->get_id(), 'tour_phys');

if ( $terms ) {
	$term_ids = wp_list_pluck( $terms, 'term_id' );
	remove_all_filters( 'posts_orderby' );
	$option_related = array(
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => 1,
		//	'no_found_rows'       => 1,
		'posts_per_page'      => $posts_per_page,
		'order'               => 'DESC',
		'orderby'             => 'rand',
		'post__not_in'        => array( $product->get_id() ),
		'tax_query'           => array(
			array(
				'taxonomy' => 'tour_phys',
				'field'    => 'term_id',
				'terms'    => $term_ids,
				'operator' => 'IN',
			)
		),
	);

	if ( get_option( 'tour_expire_on_list' ) && get_option( 'tour_expire_on_list' ) == 'no' ) {
		$option_related['meta_query'] = array(
			array(
				'key'     => '_date_finish_tour',
				'compare' => '>=',
				'value'   => date( 'Y-m-d' ),
				'type'    => 'DATE',
			)
		);
	}
	$args_related = apply_filters( 'tb_related_tour_args', $option_related );

	$related_tour = new WP_Query( $args_related );

	$classes   = array();
	$classes[] = 'item-tour col-md-4 col-sm-6';

	if ( $related_tour->have_posts() ) : ?>

		<div class="related tours">

			<h2><?php esc_html_e( 'Related Tours', 'travelwp' ); ?></h2>
			<ul class="tours products wrapper-tours-slider">

				<?php while ( $related_tour->have_posts() ) : $related_tour->the_post(); ?>

					<li <?php post_class( $classes ) ?>>

						<?php tb_get_file_template( 'content-tour.php', false ); ?>

					</li>

				<?php endwhile; // end of the loop. ?>
			</ul>
		</div>

	<?php endif;

	wp_reset_postdata();
}
