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

do_action( 'travelwp_banner_destination' );

$class_col = "col-sm-12 full-width";
if ( travelwp_get_option( 'phys_tour_destination_layout' ) == 'sidebar-right' ) {
	$class_col = "col-sm-9 alignleft";
}
if ( travelwp_get_option( 'phys_tour_destination_layout' ) == 'sidebar-left' ) {
	$class_col = 'col-sm-9 alignright';
}
$layout      = 'grid';
$item_layout = 'style_1';
$layout      = travelwp_get_option( 'phys_destination_layout_content' );
$item_layout = 'style_1';
$item_layout = travelwp_get_option( 'phys_style_item_destination' );
echo '<section class="content-area"><div class="container"><div class="row"><div class="site-main ' . $class_col . '">';

?>
<?php
	//tb_get_file_template( 'loop/result-count.php' );
  do_action( 'travelbooking_result_count' );

?>

<ul class="tours products wrapper-tours-slider content_tour_<?php echo esc_attr( $item_layout ); ?>">
	<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<li <?php post_class( travelwp_option_column_content( $layout, 'column_destination' ) ); ?>>
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

echo '</div>';
if ( $class_col != 'col-sm-12 full-width' ) {
	get_sidebar( 'tour' );
}
echo '</div></div></section>';

get_footer();
exit;
?>
