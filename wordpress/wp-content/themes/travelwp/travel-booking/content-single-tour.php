<?php
/**
 * Content Single Tour
 *
 * @author : Physcode
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//wp_enqueue_script( 'tour-booking-js-frontend');

do_action( 'tour_booking_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}
?>

	<div id="tour-<?php the_ID(); ?>" <?php post_class( 'tb_single_tour' ); ?>>
		<?php
		do_action( 'tour_booking_before_single_tour' );
		?>
		<div class="top_content_single row">
			<div class="images_single_left">
				<?php
				echo '<div class="title-single">';
				do_action( 'tour_booking_single_title' );
				do_action( 'tour_booking_single_code' );

				echo '</div>';
				echo '<div class="tour_after_title">';
				$duration = get_post_meta( get_the_ID(), '_tour_duration', true );
				if ( $duration ) {
					echo '<div class="meta_date">
						 <span>' . $duration . '</span>
					</div>';
				}

				if ( travelwp_get_option( 'phys_hide_category_tour' ) != '1' ) {
					echo '<div class="meta_values">
								<span>' . esc_html__( 'Category:', 'travelwp' ) . '</span>
								<div class="value">' . get_the_term_list( get_the_ID(), 'tour_phys', '', ', ', '' ) . '</div>
							</div>';
				}
				do_action( 'tour_booking_single_share' );
				echo '</div><div class="images">';

				do_action( 'tour_booking_single_gallery' );
				echo '</div>';
				?>
				<div class="clear"></div>
				<?php
				do_action( 'tour_booking_single_information' );
				if ( travelwp_get_option( 'phys_hide_related_tour' ) != '1' ) {
					do_action( 'tour_booking_single_related' );
				}
				$price_fix = '';
				if ( travelwp_get_option( 'phys_tour_single_content_style' ) == 'list' ) {
					$price_fix = ' sticky-price';
				}
				?>
			</div>
			<div class="summary entry-summary description_single">
				<div class="affix-sidebar<?php echo esc_attr( $price_fix ) ?>"<?php if ( travelwp_get_option( 'phys_tour_sticky_sidebar' ) == '1' ) {
					echo 'id="sticky-sidebar"';
				} ?>>
					<?php
					global $product;
					$date_finish_tour       = get_post_meta( get_the_ID(), '_date_finish_tour', true ) ? get_post_meta( get_the_ID(), '_date_finish_tour', true ) : 0;
					$date_now               = date( 'Y-m-d' );
					$show_booking           = false;
					$show_only_form_enquiry = get_post_meta( get_the_ID(), '_tour_show_only_form_enquiry', true ) ? get_post_meta( get_the_ID(), '_tour_show_only_form_enquiry', true ) : 0;
					if ( $date_finish_tour != 0 ) {
						$date_finish_tour_arr  = explode( '-', $date_finish_tour );
						$date_finish_tour_str  = $date_finish_tour_arr[0] . '-' . $date_finish_tour_arr[1] . '-' . $date_finish_tour_arr[2];
						$date_finish_tour_time = strtotime( $date_finish_tour_str );
						if ( strtotime( $date_now ) <= $date_finish_tour_time ) {
							$show_booking = true;
						}
					} else {
						$show_booking = true;
					}

					echo '<div class="entry-content-tour">';
					do_action( 'tour_booking_single_price' );
					echo '<div class="clear"></div>';

					if ( travelwp_get_option( 'from_booking' ) == 'show' || travelwp_get_option( 'from_booking' ) == '' ) {
						do_action( 'tour_booking_single_booking' );
					} elseif ( travelwp_get_option( 'from_booking' ) == 'both' ) {
						if ( travelwp_get_option( 'layout_booking_enquiry', 'default' ) == 'default' ) {
							do_action( 'tour_booking_single_booking' );
							if ( $show_only_form_enquiry == '0' ) {
								echo '<div class="form-block__title custom-form-title"><h4>' . esc_html__( 'Or', 'travelwp' ) . '</h4></div>';
								echo '<div class="custom_from">' . do_shortcode( travelwp_get_option( 'another_from_shortcode' ) ) . '</div>';
							} else {
								echo '<div class="another_from">' . do_shortcode( travelwp_get_option( 'another_from_shortcode' ) ) . '</div>';
							}
						} else {
							echo '
							<div class="group-from-booking"><ul class="nav-tabs-item" role="tablist">
								<li class="active"><a data-toggle="tab" href="#tab_form_booking" role="tab">' . esc_attr__( 'Booking Form', 'travelwp' ) . '</a></li>
								 <li><a  data-toggle="tab" href="#tab_form_enquiry" role="tab">' . esc_attr__( 'Enquiry Form', 'travelwp' ) . '</a></li>
							  </ul> ';

							echo '<div class="tab-content">';
							echo '<div class="tab-pane active" id="tab_form_booking" role="tabpanel">';
							do_action( 'tour_booking_single_booking' );
							echo '</div>';
							echo '<div class="tab-pane" id="tab_form_enquiry" role="tabpanel">' . do_shortcode( travelwp_get_option( 'another_from_shortcode' ) ) . '</div>';
							echo '</div></div>';

						}
					} elseif ( travelwp_get_option( 'from_booking' ) == 'another_from' ) {
						echo '<div class="another_from">' . do_shortcode( travelwp_get_option( 'another_from_shortcode' ) ) . '</div>';
					}
					echo '</div>';

					if ( is_active_sidebar( 'single_tour' ) ) {
						echo '<div class="widget-area align-left col-sm-3">';
						dynamic_sidebar( 'single_tour' );
						echo '</div>';
					}

					?>
				</div>
			</div>
		</div>
		<?php
		do_action( 'tour_booking_after_single_tour' );
		?>

	</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'tour_booking_after_single_product' ); ?>