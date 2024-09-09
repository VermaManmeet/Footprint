<?php

function woo_check_versionl() {
	global $woocommerce;

	return $woocommerce->version;
}

// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation
	unset( $enqueue_styles['woocommerce-layout'] );        // Remove the layout

	return $enqueue_styles;
}

// remove woocommerce_breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 30 );

add_action( 'woocommerce_after_shop_loop_item_title', 'add_product_description', 30 );
function add_product_description() {
	echo '<div class="description">';
	the_excerpt();
	echo '</div>';
}

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_before_shop_loop_item_title_price', 'woocommerce_template_loop_price', 20 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 5 );

add_action( 'woocommerce_item_rating', 'woocommerce_template_loop_rating', 5 );

/**
 * Breadcrumb
 *
 * @param $defaults
 *
 * @return mixed
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'travelwp_change_breadcrumb_delimiter' );
function travelwp_change_breadcrumb_delimiter( $defaults ) {
	$defaults['delimiter'] = '';

	return $defaults;
}

add_action( 'tour_booking_single_related', 'woocommerce_upsell_display', 20 );
add_action( 'tour_booking_single_share', 'tour_booking_single_share', 5 );

if ( ! function_exists( 'tour_booking_single_share' ) ) {
	function tour_booking_single_share() {
		global $travelwp_theme_options;
		$html = '<div class="tour-share">';
		$html .= '<ul class="share-social">';
		if ( isset( $travelwp_theme_options['social-sortable']['sharing_facebook'] ) && $travelwp_theme_options['social-sortable']['sharing_facebook'] == '1' ) {
			$html .= '<li><a target="_blank" class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=' . urlencode( get_permalink() ) . '" onclick=\'javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;\'><i class="fa fa-facebook"></i></a></li>';
		}
		if ( isset( $travelwp_theme_options['social-sortable']['sharing_twitter'] ) && $travelwp_theme_options['social-sortable']['sharing_twitter'] == 1 ) {
			$html .= '<li><a target="_blank" class="twitter" href="https://twitter.com/share?url=' . urlencode( get_permalink() ) . '&amp;text=' . esc_attr( get_the_title() ) . '" onclick=\'javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;\'><i class="fa flaticon-twitter"></i></a></li>';
		}
		if ( isset( $travelwp_theme_options['social-sortable']['sharing_pinterset'] ) && $travelwp_theme_options['social-sortable']['sharing_pinterset'] == 1 ) {
			$html .= '<li><a target="_blank" class="pinterest" href="http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;description=' . strip_tags( get_the_excerpt() ) . '&media=' . urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) ) . '" onclick=\'javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;\'><i class="fa fa-pinterest"></i></a></li>';
		}
		if ( isset( $travelwp_theme_options['social-sortable']['sharing_google'] ) && $travelwp_theme_options['social-sortable']['sharing_google'] == 1 ) {
			$html .= '<li><a target="_blank" class="googleplus" href="https://plus.google.com/share?url=' . urlencode( get_permalink() ) . '" onclick=\'javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;\'><i class="fa fa-google"></i></a></li>';
		}
		$html .= '</ul>';
		$html .= '</div>';
		printf( '%s', $html );
	}
}

if ( ! function_exists( 'travelwp_option_column_content' ) ) {
	function travelwp_option_column_content( $layout, $theme_option ) {
		$classes = array();
		if ( $layout == 'list' ) {
			$classes[] = 'item-list-tour col-md-12';
		} else {
			$column_product = 4;
			if ( travelwp_get_option( $theme_option ) ) {
				$column_product = 12 / travelwp_get_option( $theme_option );
			}
			$cat_obj = travelwp_get_wp_query()->get_queried_object();
			if ( isset( $cat_obj->term_id ) ) {
				$cat_ID                = $cat_obj->term_id;
				$custom_layout_content = get_tax_meta( $cat_ID, 'phys_layout_content', true );
				if ( $custom_layout_content == 'grid' ) {
					$custom_layout_content = get_tax_meta( $cat_ID, 'phys_layout_content_column', true );
					$column_product        = 12 / $custom_layout_content;
				}
			}
			$classes[] = 'item-tour col-md-' . $column_product . ' col-sm-6';
		}

		return $classes;
	}
}


/**
 * Custom current cart
 * @return array
 */
function travelwp_get_current_cart_info() {
	global $woocommerce;
	$items = '';
	if ( ! is_admin() ) {
		$items = count( $woocommerce->cart->get_cart() );
	}

	return array( $items, get_woocommerce_currency_symbol() );
}

if ( woo_check_versionl() < 3.0 ) {
	add_filter( 'add_to_cart_fragments', 'travelwp_add_to_cart_success_ajax' );
} else {
	add_filter( 'woocommerce_add_to_cart_fragments', 'travelwp_add_to_cart_success_ajax' );
}
function travelwp_add_to_cart_success_ajax( $count_cat_product ) {
	global $woocommerce;
	list( $cart_items ) = travelwp_get_current_cart_info();
	if ( $cart_items < 0 ) {
		$cart_items = '0';
	} else {
		$cart_items = $cart_items;
	}
	$count_cat_product['#header-mini-cart .wrapper-items-number'] = '<span class="wrapper-items-number">' . $cart_items . '</span>';

	return $count_cat_product;
}

// custom hook price style 2
if ( ! function_exists( 'travel_loop_item_title_price' ) ) {
	function travel_loop_item_title_price() {
		global $product;
		$price      = get_post_meta( get_the_ID(), '_regular_price', true );
		$price_sale = get_post_meta( get_the_ID(), '_sale_price', true );
		$from       = '';
		if ( $price != '' && $price_sale == '' ) {
			$from = '<span class="text">' . esc_html__( 'From', 'travelwp' ) . '</span>';
		}
		?>
		<?php if ( $price_html = $product->get_price_html() ) : ?>
			<span class="price">
				<?php echo ent2ncr( $from . $price_html ); ?>
			</span>
		<?php endif;
	}
}
add_action( 'travel_loop_item_title_price', 'travel_loop_item_title_price', 5 );

// custom hook ratting for shortcode review
if ( ! function_exists( 'travel_tours_renders_stars_rating' ) ) {
	function travel_tours_renders_stars_rating( $rating ) {
		$stars_html = '<div class="item_rating"><div class="star-rating" title="' . sprintf( esc_html__( 'Rated %s out of 5', 'travelwp' ), $rating ) . '">';
		$stars_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"></span>';
		$stars_html .= '</div></div>';
		printf( '%s', $stars_html );
	}
}


/**
 * Add action and add filter
 * Class travelwp_woocommerce_include
 */
class travelwp_woocommerce_include {
	public function __construct() {
		// paging number
		add_filter( 'loop_shop_per_page', array( $this, 'travelwp_loop_shop_per_page' ), 20 );
		add_filter( 'woocommerce_output_related_products_args', array( $this, 'travelwp_related_products_args' ) );
		add_action( 'widgets_init', array( $this, 'travelwp_override_woocommerce_widgets' ), 15 );
	}

	function travelwp_loop_shop_per_page( $cols ) {
		if ( travelwp_get_option( 'woo_product_per_page' ) ) {
			$cols = travelwp_get_option( 'woo_product_per_page' );
		} else {
			$cols = get_option( 'posts_per_page' );
		}

		return $cols;
	}


	function travelwp_related_products_args( $args ) {
		$args['posts_per_page'] = 3; // 4 related products

		return $args;
	}

	/**
	 * Override WooCommerce Widgets
	 */
	function travelwp_override_woocommerce_widgets() {
		if ( class_exists( 'WC_Widget_Cart' ) ) {
			unregister_widget( 'WC_Widget_Cart' );
			include_once( 'widgets/class-wc-widget-cart.php' );
			register_widget( 'Travelwp_Custom_WC_Widget_Cart' );
		}
	}
}

new travelwp_woocommerce_include();

add_action( 'init', 'travelwp_options_backend' );
function travelwp_options_backend() {
	if ( travelwp_get_option( 'phys_woo_single_related_product' ) == 1 ) {
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	}
}

add_filter( 'thim_kits/archive_product/query_args', 'travelwp_add_arg_query_widget_archive_product' );
function travelwp_add_arg_query_widget_archive_product( $query ) {
	if ( array_key_exists( 'tax_query', $query ) ) {
		$query['tax_query']['relation'] = 'AND';
		array_push( $query['tax_query'], array(
			array(
				'taxonomy' => 'product_type',
				'field'    => 'slug',
				'terms'    => array( 'simple', 'grouped', 'variable', 'external' ),
				'operator' => 'IN',
			),
		) );

	} else {
		$query['tax_query'] = array(
			array(
				'taxonomy' => 'product_type',
				'field'    => 'slug',
				'terms'    => array( 'simple', 'grouped', 'variable', 'external' ),
				'operator' => 'IN',
			),
		);
	}

	return $query;
}
