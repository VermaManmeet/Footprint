<?php
$theme_data    = Phys_Theme_Manager::get_metadata();
$theme_name    = $theme_data['name'];
$purchase_link = $theme_data['purchase_link'];
?>
<div class="tc-registration-wrapper tc-base-middle" id="phys-core-product-registration">
    <div class="left">
        <h3 class="title"><?php esc_html_e( 'Product registration', 'phys-core' ); ?></h3>
        <div class="sub-title"><?php esc_html_e( 'You\'re almost finished!', 'phys-core' ); ?></div>
    </div>

    <div class="right">
		<?php Phys_Dashboard::get_template( 'partials/button-activate.php' ); ?>
    </div>

	<?php if ( $purchase_link ) : ?>
        <div class="purchase">
            <span><?php esc_html_e( 'Don\'t have direct license yet?', 'phys-core' ); ?></span>
            <a href="<?php echo esc_url( $purchase_link ); ?>" target="_blank"><?php printf( __( 'Purchase %s license', 'phys-core' ), $theme_name ); ?></a>.
        </div>
	<?php endif; ?>
</div>
