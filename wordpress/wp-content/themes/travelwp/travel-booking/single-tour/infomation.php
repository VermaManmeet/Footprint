<?php
/**
 * Information Tour
 */


$tabs = apply_filters( 'tour_booking_default_product_tabs', array() );

if ( !empty( $tabs ) ) :
	if ( travelwp_get_option( 'phys_tour_single_content_style' ) == 'list' ) {
		?>
		<div class="tabs-fixed-scroll no-fix-scroll">
			<div class="container">
				<div class="width70">
					<ul class="wc-tabs-scroll">
						<?php
						$i = 0;
						foreach ( $tabs as $key => $tab ) :
							$class = '';
							if ( $i == 0 ) {
								$class = ' class="active"';
							}
							?>
							<li class="<?php echo esc_attr( $key ); ?>_tab">
								<a href="#scroll-<?php echo esc_attr( $key ); ?>"<?php echo esc_attr( $class ); ?>><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
							</li>
							<?php
							$i ++;
						endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
		<?php foreach ( $tabs as $key => $tab ) : ?>
			<div class="list-content <?php echo esc_attr( $key ); ?>_list" id="scroll-<?php echo esc_attr( $key ); ?>">
				<h2 class="title-list-content"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></h2>
				<div class="content-inner"><?php call_user_func( $tab['callback'], $key, $tab ); ?></div>
			</div>
		<?php endforeach; ?>
	<?php } else {
		?>
		<div class="woocommerce-tabs wc-tabs-wrapper">
			<ul class="tabs wc-tabs" role="tablist">
				<?php foreach ( $tabs as $key => $tab ) : ?>
					<li class="<?php echo esc_attr( $key ); ?>_tab" role="presentation">
						<a href="#tab-<?php echo esc_attr( $key ); ?>" role="tab" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="tab-content">
				<?php foreach ( $tabs as $key => $tab ) : ?>
					<div role="tabpanel" class="tab-pane woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>">
						<?php call_user_func( $tab['callback'], $key, $tab ); ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php }

endif; ?>