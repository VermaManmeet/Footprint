<?php
/**
 * Tour Code
 *
 * @author        PhysCode
 * @package       Tp-tour-booking/Templates
 * @version       1.1.3
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $tb_settings;
$code = get_post_meta( get_the_ID(), '_tour_code', true );
?>

<div class="tour_code">
	<?php if ( $code != '' ): ?>
		<strong><?php echo esc_html__( 'Code:', 'travelwp' ) ?> </strong><?php echo esc_attr( $code ) ?>
	<?php endif ?>
</div>
