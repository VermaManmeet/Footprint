<?php
/**
 * Shopping Cart Widget.
 *
 * Displays shopping cart widget.
 *
 * @package WooCommerce\Widgets
 * @version 2.3.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Widget cart class.
 */
class Travelwp_Custom_WC_Widget_Cart extends WC_Widget_Cart {

	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_shopping_cart';
		$this->widget_description = __( 'Display the customer shopping cart.', 'woocommerce' );
		$this->widget_id          = 'woocommerce_widget_cart';
		$this->widget_name        = __( 'Cart', 'woocommerce' );
		$this->settings           = array(
			'title'         => array(
				'type'  => 'text',
				'std'   => __( 'Cart', 'woocommerce' ),
				'label' => __( 'Title', 'woocommerce' ),
			),
			'hide_if_empty' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Hide if cart is empty', 'woocommerce' ),
			),
		);

		if ( is_customize_preview() ) {
			wp_enqueue_script( 'wc-cart-fragments' );
		}

		parent::__construct();
	}

	public function widget( $args, $instance ) {
		extract( $args );

//		if ( is_cart() || is_checkout() ) {
//			return;
//		}
		global $woocommerce;
		echo ent2ncr( $before_widget );
		$hide_if_empty = empty( $instance['hide_if_empty'] ) ? 0 : 1;
		$title         = $instance['title'];

		echo '<div class="minicart_hover" id="header-mini-cart">';

		list( $cart_items ) = travelwp_get_current_cart_info();

		if ( $title ) {
			echo '<span class="cart-title">' . $title . '</span>';
		}
		echo '<span class="cart-items-number"><i class="fa fa-fw fa-shopping-bag"></i>';
		echo '<span class="wrapper-items-number">' . $cart_items . '</span>';
 		echo '</span>';
 		echo '<div class="clear"></div>';
		echo '</div>';

		if ( $hide_if_empty ) {
			echo '<div class="hide_cart_widget_if_empty">';
		}
		// Insert cart widget placeholder - code in woocommerce.js will update this on page load
		echo '<div class="widget_shopping_cart_content" style="display: none;"></div>';
		if ( $hide_if_empty ) {
			echo '</div>';
		}
		echo ent2ncr( $after_widget );
	}

}
