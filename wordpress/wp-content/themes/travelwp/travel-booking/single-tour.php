<?php
/**
 * Single tour
 *
 * @author : Physcode
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header( 'shop' );

do_action( 'travelwp_wrapper_banner_heading' );

//do_action( 'travelwp_wrapper_loop_start' );
echo '<section class="content-area single-woo-tour"><div class="container">';

do_action( 'woocommerce_before_main_content' );

while ( have_posts() ) : the_post(); ?>
	<?php
	tb_get_file_template( 'content-single-tour.php' );
	?>
<?php endwhile;

do_action( 'woocommerce_after_main_content' );

echo '</div></section>';
//do_action( 'travelwp_wrapper_loop_end' );

get_footer( 'shop' );
exit;
?>
