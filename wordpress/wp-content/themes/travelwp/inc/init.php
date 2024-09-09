<?php
require get_template_directory() . '/inc/admin/options-config.php';

/**
 * Add action and add filter
 * Class travelwp_theme_include
 */
class travelwp_theme_include {
	public function __construct() {
		// Setup theme
		add_action( 'after_setup_theme', array( $this, 'travelwp_setup_theme' ) );
		//Process widget: add or remove
		add_action( 'widgets_init', array( $this, 'travelwp_widgets_init' ) );

		//Set the content width in pixels
		add_action( 'after_setup_theme', array( $this, 'travelwp_content_width' ), 0 );

		//Add Script
		add_action( 'wp_enqueue_scripts', array( $this, 'travelwp_init_scripts' ) );

		//Add Admin Script
		add_action( 'admin_head', array( $this, 'travelwp_admin_init_scripts' ) );

		// default image size


		//Remove filter and Add new filther
		remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
		add_filter( 'get_the_excerpt', array( $this, 'travelwp_wp_new_excerpt' ) );
		/********************travelwp_entry_top**********************/
		add_filter( 'wpcf7_support_html5_fallback', '__return_true' );
		add_filter( 'embed_oembed_html', array( $this, 'travelwp_custom_oembed_filter' ), 10, 4 );
		add_action( 'comment_post', array( $this, 'travelwp_tour_phys_rating_comment' ), 20 );
	}

	/**
	 * Override excerpt of post
	 *
	 * @param $text
	 *
	 * @return mixed|string|void
	 */
	public function travelwp_wp_new_excerpt( $text ) {
		global $travelwp_theme_options;
		$length = 55;
		if ( isset( $travelwp_theme_options['excerpt_length_blog'] ) && $travelwp_theme_options['excerpt_length_blog'] ) {
			$length = $travelwp_theme_options['excerpt_length_blog'];
		}
		if ( $text == '' ) {
			$text           = get_the_content( '' );
			$text           = strip_shortcodes( $text );
			$text           = apply_filters( 'the_content', $text );
			$text           = str_replace( ']]>', ']]>', $text );
			$text           = strip_tags( $text );
			$text           = nl2br( $text );
			$excerpt_length = apply_filters( 'excerpt_length', $length );
			$words          = explode( ' ', $text, $excerpt_length + 1 );
			if ( count( $words ) > $excerpt_length ) {
				array_pop( $words );
				array_push( $words, '' );
				$text = implode( ' ', $words );
			}
		}

		return $text;
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function travelwp_init_scripts() {
		wp_deregister_style( 'open-sans' );
		wp_deregister_style( 'font-awesome' );
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), TRAVELWP_THEME_VERSION );
		//		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), TRAVELWP_THEME_VERSION );
		wp_enqueue_style( 'font-awesome-5-all', get_template_directory_uri() . '/assets/css/all.min.css', array(), TRAVELWP_THEME_VERSION );
		wp_enqueue_style( 'font-awesome-4-shim', get_template_directory_uri() . '/assets/css/v4-shims.min.css', array(), TRAVELWP_THEME_VERSION );

		wp_enqueue_style( 'font-linearicons', get_template_directory_uri() . '/assets/css/font-linearicons.css', array(), TRAVELWP_THEME_VERSION );
		wp_register_style( 'travelwp-swipebox', get_template_directory_uri() . '/assets/css/swipebox.min.css', array(), TRAVELWP_THEME_VERSION );

		if ( is_rtl() ) {
			wp_enqueue_style( 'travelwp-style', get_template_directory_uri() . '/style-rtl.css', array(), TRAVELWP_THEME_VERSION );
		} else {
			wp_enqueue_style( 'travelwp-style', get_stylesheet_uri(), array(), TRAVELWP_THEME_VERSION );
		}

		wp_enqueue_style( 'physcode_travelwp', get_template_directory_uri() . '/assets/css/physcode_travelwp.css', array(), TRAVELWP_THEME_VERSION );
		wp_enqueue_style( 'travelwp-flaticon', get_template_directory_uri() . '/assets/css/flaticon.css', array(), TRAVELWP_THEME_VERSION );
		wp_add_inline_style(
			'travelwp-flaticon', options_to_css()
		);
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), TRAVELWP_THEME_VERSION, true );
		wp_enqueue_script( 'travelwp-vendors', get_template_directory_uri() . '/assets/js/vendors.js', array( 'jquery' ), TRAVELWP_THEME_VERSION, true );

		wp_register_script( 'travelwp-comingsoon', get_template_directory_uri() . '/assets/js/jquery.mb-comingsoon.min.js', array( 'jquery' ), TRAVELWP_THEME_VERSION, true );
		wp_register_script( 'travelwp-swipebox', get_template_directory_uri() . '/assets/js/jquery.swipebox.min.js', array( 'jquery' ), TRAVELWP_THEME_VERSION, true );
		wp_register_script( 'travelwp-isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array( 'jquery' ), TRAVELWP_THEME_VERSION, true );
		wp_register_script( 'travelwp-gallery', get_template_directory_uri() . '/assets/js/gallery.js', array( 'jquery' ), TRAVELWP_THEME_VERSION, true );
		wp_register_script( 'waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array( 'jquery' ), TRAVELWP_THEME_VERSION, true );
		wp_register_script( 'travelwp-counterup', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array( 'jquery' ), TRAVELWP_THEME_VERSION, true );
		wp_register_script( 'travelwp-typed', get_template_directory_uri() . '/assets/js/typed.min.js', array( 'jquery' ), TRAVELWP_THEME_VERSION, true );
		wp_enqueue_script( 'travelwp-theme', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery' ), TRAVELWP_THEME_VERSION, true );

	}

	/**
	 * Enqueue admin script.
	 */
	public function travelwp_admin_init_scripts() {
		wp_enqueue_style( 'travelwp-flaticon', get_template_directory_uri() . '/assets/css/flaticon.css' );
	}


	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	public function travelwp_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'travelwp' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Position on the left or right of content. It will not show on shop page.', 'travelwp' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Top bar left', 'travelwp' ),
				'id'            => 'top_bar_left',
				'description'   => esc_html__( 'Add widgets here.', 'travelwp' ),
				'before_widget' => '<aside id="%1$s" class="%2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Top bar right', 'travelwp' ),
				'id'            => 'top_bar_right',
				'description'   => esc_html__( 'Add widgets here.', 'travelwp' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Menu Right', 'travelwp' ),
				'id'            => 'menu_right',
				'description'   => '',
				'before_widget' => '<li id="%1$s" class="%2$s">',
				'after_widget'  => '</li>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer', 'travelwp' ),
				'id'            => 'footer',
				'description'   => esc_html__( 'Add widgets here.', 'travelwp' ),
				'before_widget' => '<aside id="%1$s" class="%2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Copyright Right', 'travelwp' ),
				'id'            => 'copyright',
				'description'   => esc_html__( 'Add widgets here.', 'travelwp' ),
				'before_widget' => '<aside id="%1$s" class="%2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar Shop', 'travelwp' ),
				'id'            => 'sidebar-shop',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Single Tours', 'travelwp' ),
				'id'            => 'single_tour',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	public function travelwp_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'travelwp_content_width', 640 );
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	public function travelwp_setup_theme() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on travelwp, use a find and replace
		 * to change 'travelwp' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'travelwp', TRAVELWP_THEME_DIR . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'woocommerce' );

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'phys-core' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'travelwp' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support(
			'post-formats', array(
				'image',
				'gallery',
				'video',
				'link',
			)
		);

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		//add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio', 'link' ) );
		$args = apply_filters(
			'travelwp_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		);
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', $args );
		add_theme_support( "custom-header", $args );
		function move_comment_field_to_bottom( $fields ) {
			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;

			return $fields;
		}

		add_filter( 'comment_form_fields', 'move_comment_field_to_bottom' );
		add_editor_style( trailingslashit( get_template_directory_uri() ) . '/assets/css/admin.css' );
	}

	public function travelwp_custom_oembed_filter( $html ) {
		$return = '<div class="video-container">' . $html . '</div>';

		return $return;
	}

	public function travelwp_tour_phys_rating_comment( $comment_id, $comment = null ) {
		$tour_rating = false;
		$meta_val    = get_comment_meta( $comment_id, 'rating', true );
		if ( $meta_val >= 0 ) {
			if ( ! $comment ) {
				$comment = get_comment( $comment_id );
			}
			$post_id = $comment ? $comment->comment_post_ID : null;
			if ( $post_id && 'product' === get_post_type( $post_id ) ) {
				$product = wc_get_product( $post_id );
				if ( $product && $product->is_type( 'tour_phys' ) ) {
					$tour_rating = 1;
				}
			}
		}

		if ( $tour_rating ) {
			add_comment_meta( $comment_id, 'tour_rating', 1, true );
		} else {
			$current_flag_value = get_comment_meta( $comment_id, 'tour_rating', true );
			if ( '' !== $current_flag_value ) {
				delete_comment_meta( $comment_id, 'tour_rating' );
			}
		}

		return $tour_rating;
	}
}

new travelwp_theme_include();
/**
 *
 * Remove section in customize
 */
function remove_styles_sections() {
	global $wp_customize;
	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
}

//Remove section in customize
add_action( 'customize_register', 'remove_styles_sections', 20 );

if ( ! function_exists( 'travelwp_excerpt' ) ) {
	function travelwp_excerpt( $limit ) {
		$text  = get_the_content( '' );
		$text  = strip_shortcodes( $text );
		$text  = str_replace( ']]>', ']]>', $text );
		$text  = strip_tags( $text );
		$text  = nl2br( $text );
		$words = explode( ' ', $text, $limit + 1 );
		if ( count( $words ) > $limit ) {
			array_pop( $words );
			array_push( $words, '' );
			$text = implode( ' ', $words );
		}

		return apply_filters( 'the_content', $text );

	}
}

if ( ! function_exists( 'travelwp_menu_right_item' ) ) {
	add_filter( 'wp_nav_menu_items', 'travelwp_menu_right_item', 10, 2 );
	function travelwp_menu_right_item( $items, $args ) {
		if ( $args->theme_location == 'primary' ) {
			if ( is_active_sidebar( 'menu_right' ) ) {
				$items .= '<li class="menu-right"><ul>';
				ob_start();
				dynamic_sidebar( 'menu_right' );
				$items .= ob_get_clean();
				$items .= '</ul></li>';
			}
		}

		return $items;
	}
}
/*
 * List Comment
 */

if ( ! function_exists( 'travelwp_comment' ) ) {
	function travelwp_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		if ( 'div' == $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo ent2ncr( $tag . ' ' ) ?><?php comment_class( 'description_comment' ) ?> id="comment-<?php comment_ID() ?>">
		<div class="wrapper-comment">
			<?php
			if ( $args['avatar_size'] != 0 ) {
				echo '<div class="wrapper_avatar">' . get_avatar( $comment, $args['avatar_size'] ) . '</div>';
			}
			?>
			<div class="comment-right">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'travelwp' ) ?></em>
				<?php endif; ?>

				<div class="comment-extra-info">
					<div
						class="author"><?php printf( '<span class="author-name"><i class="fa fa-user"></i> %s</span>', get_comment_author_link() ) ?></div>
					<div class="date" itemprop="commentTime">
						<i class="fa fa-calendar"></i> <?php printf( get_comment_date(), get_comment_time() ) ?></div>
					<?php edit_comment_link( esc_html__( 'Edit', 'travelwp' ), '', '' ); ?>

					<?php comment_reply_link(
						array_merge(
							$args, array(
								'add_below' => $add_below,
								'depth'     => $depth,
								'max_depth' => $args['max_depth']
							)
						)
					) ?>
				</div>

				<div class="content-comment">
					<?php comment_text() ?>
				</div>
			</div>
		</div>
		<?php
	}
}


function travelwp_get_wp_query() {
	global $wp_query;

	return $wp_query;
}

/**
 * Get ThemeOptions
 * @return array|mixed|void
 */
function travelwp_get_data_themeoptions() {
	global $travelwp_theme_options;

	return $travelwp_theme_options;
}

function travelwp_get_option( $name = '', $value_default = '' ) {
	$data = travelwp_get_data_themeoptions();
	if ( isset( $data[ $name ] ) ) {
		return $data[ $name ];
	} else {
		return $value_default;
	}
}

function travelwp_current_blog() {
	global $current_blog;

	return $current_blog;
}

function travelwp_theme_options_extral_class( $type, $rules = array( 'all' ) ) {
	if ( $type == 'archive-post' && count( $rules ) == 1 ) {
		$rules = array( 'all', 'post_categories', 'post_tags', 'post_tags', 'post_search', 'post_term', 'select_post_author' );
	}
	if ( class_exists( '\Thim_EL_Kit\Functions' ) ) {
		$build_el = \Thim_EL_Kit\Functions::instance()->get_conditions_by_type( $type );
		foreach ( $rules as $rule ) {
			if ( ! empty( $build_el[ $rule ] ) ) {
				return ' hidden';
			}
		}
	}

	return;
}

/*
 * Phys_CORE_PATH
 */
require TRAVELWP_THEME_DIR . '/inc/admin/installer/installer.php';

require TRAVELWP_THEME_DIR . '/inc/admin/phys-core-required.php';
/*
* breadcrumb
*/
require get_template_directory() . '/inc/breadcrumb.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * logo
 */
require get_template_directory() . '/inc/global/logo.php';

/**
 * Display Setting front end
 */
require_once get_template_directory() . '/inc/global/wrapper-before-after.php';

/**
 * Add WooCommerce Setting
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/woocommerce/woocommerce.php';
}

/**
 * shortcode
 */
if ( function_exists( 'vc_map' ) ) {
	require get_template_directory() . '/inc/shortcode.php';
} else {
	add_filter( 'phys_register_shortcode', function () {
		return array( 'travelwp' => [ 'itinerary' ] );
	} );
}

add_filter( 'the_content', 'travelwp_shortcodes_formatter' );
add_filter( 'widget_text', 'travelwp_shortcodes_formatter' );
function travelwp_shortcodes_formatter( $content ) {
	$block = join( "|", array( "itinerary" ) );
	// opening tag
	$rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );
	// closing tag
	$rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep );

	return $rep;
}

require get_template_directory() . '/inc/shortcode/itinerary.php';

require get_template_directory() . '/inc/elementor.php';
/**
 * add post format
 */
require get_template_directory() . '/inc/admin/post-format-ui/post-formats-front-end.php';

/**
 *
 */
require get_template_directory() . '/inc/admin/tax-meta.php';
require get_template_directory() . '/inc/admin/meta-boxes.php';

/**
 * widget
 */
require get_template_directory() . '/inc/widgets.php';

/*
	required plugin
*/

require get_template_directory() . '/inc/admin/plugins-require.php';

require get_template_directory() . '/inc/admin/options-var-css.php';

add_action( 'init', 'travelwp_add_excerpts_to_pages' );

function travelwp_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
	if ( travelwp_get_option( 'disable_gutenberg', 0 ) != 1 ) {
		// Disables the block editor from managing widgets in the Gutenberg plugin.
		add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
		// Disables the block editor from managing widgets.
		add_filter( 'use_widgets_block_editor', '__return_false' );
	}
}

//require get_template_directory() . '/inc/aq_resizer.php';
if ( ! function_exists( 'travelwp_custom_image_size' ) ) {

	function travelwp_custom_image_size( $img_size, $img_url ) {
		if ( $img_url ) {
			//			global $wpdb;
			//			$id           = $wpdb->get_var( "SELECT ID FROM {$wpdb->posts} WHERE guid='$img_url' AND post_type='attachment'" );
			$id = attachment_url_to_postid( $img_url );
			if ( $id ) {
				$img_url_crop = wp_get_attachment_image_src( $id, $img_size );

				return $img_url_crop[0];
			}
		}

		return;
	}
}

// Hard Crop
if ( false === get_option( "medium_crop" ) ) {
	add_option( "medium_crop", "1" );
} else {
	update_option( "medium_crop", "1" );
}
if ( false === get_option( "large_crop" ) ) {
	add_option( "large_crop", "1" );
} else {
	update_option( "large_crop", "1" );
}


/**
 * Disable VC Auto-update
 *
 */
function travelwp_vc_disable_update() {
	if ( function_exists( 'vc_license' ) && function_exists( 'vc_updater' ) && ! vc_license()->isActivated() ) {
		remove_filter( 'upgrader_pre_download', array( vc_updater(), 'preUpgradeFilter' ), 10 );
		remove_filter(
			'pre_set_site_transient_update_plugins', array(
				vc_updater()->updateManager(),
				'check_update'
			)
		);
	}
}

add_action( 'admin_init', 'travelwp_vc_disable_update', 9 );

if ( class_exists( 'YIKES_Custom_Product_Tabs_Display' ) ) {
	class YIKES_Custom_Product_Tabs_Display_Ext extends YIKES_Custom_Product_Tabs_Display {
		public function init() {
			// Add our custom product tabs section to the product page
			add_filter( 'tour_booking_default_product_tabs', array( $this, 'add_custom_product_tabs' ) );
		}
	}

	new YIKES_Custom_Product_Tabs_Display_Ext();
}


add_filter(
	'get_the_archive_title', function ( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_404() ) {
		$title = '404';
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_page() ) {
		$title = single_post_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( '%s', 'travelwp' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		if ( get_queried_object()->taxonomy == 'pa_destination' ) {
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( esc_html__( '%1$s %2$s', 'travelwp' ), single_term_title( '', false ), esc_html__( 'Tourist', 'travelwp' ) );
		} else {
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( esc_html__( '%1$s: %2$s', 'travelwp' ), $tax->labels->singular_name, single_term_title( '', false ) );
		}
	} elseif ( is_search() ) {
		$title = sprintf( esc_html__( 'Search Results for: %s', 'travelwp' ), '<span>' . get_search_query( '' ) . '</span>' );
	}

	return $title;
}
);

if ( ! function_exists( 'travelwp_shortcode_template' ) ) {
	function travelwp_shortcode_template( $args = array(), $template_name = 'base' ) {
		if ( is_array( $args ) && isset( $args ) ) {
			extract( $args );
		}

		if ( false === strpos( $template_name, '.php' ) ) {
			$template_name .= '.php';
		}

		$parent_path = get_template_directory() . '/inc/shortcode/tpl/' . $template_name;
		$child_path  = get_stylesheet_directory() . '/inc/shortcode/tpl/' . $template_name;

		if ( file_exists( $child_path ) ) {
			$template_path = $child_path;
		} elseif ( file_exists( $parent_path ) ) {
			$template_path = $parent_path;
		} else {
			_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_name ), '1.0.0' );

			return;
		}

		require $template_path;
	}
}
add_filter( 'get_the_archive_description', function ( $description ) {
	if ( class_exists( 'TravelBookingPhyscode' ) && \TravelPhysUtility::check_is_tour_archive() ) {
		$description = term_description();
		if ( ! is_tax() ) {
			$description = travelwp_get_option( 'phys_tour_cate_description' );
		}
	}

	return $description;
}, 10, 1 );


add_filter( 'thim-ekit/widgets/page-title', 'travelwp_add_page_title_tour' );
function travelwp_add_page_title_tour( $heading_title ) {
	if ( class_exists( 'TravelBookingPhyscode' ) ) {
		if ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {
			if ( \TravelPhysUtility::check_is_tour_archive() ) {
				$heading_title = esc_html( 'Tours', 'travelwp' );
			}
		}
		if ( is_product_taxonomy() && \TravelPhysUtility::check_is_tour_archive() ) {
			$term          = get_queried_object();
			$heading_title = $term->name;

		}
	}


	return $heading_title;
}

add_filter( 'thim_ekit_get_breadcrumb', 'travelwp_tour_breadcrumb', 10, 2 );
function travelwp_tour_breadcrumb( $crumbs, $object_class ) {
	foreach ( $crumbs as $key => $crumb ) {
		if ( get_post_type() == 'product' && class_exists( 'TravelBookingPhyscode' ) ) {
			$tour_id = get_option( \Tour_Settings_Tab_Phys::$_tours_show_page_id );
			if ( \TravelPhysUtility::check_is_tour_archive() ) {
				if ( is_home() && is_shop() ) {
					$crumbs[1][0] = get_the_title( $tour_id );
					$crumbs[1][1] = get_page_link( $tour_id );
				} elseif ( get_queried_object_id() ) {
					$crumbs[1][0] = get_the_title( $tour_id );
					$crumbs[1][1] = get_page_link( $tour_id );
					$crumbs[2][0] = get_queried_object()->name;
					$crumbs[2][1] = get_permalink( get_queried_object()->tetm_id );
				}
			} elseif ( is_single() && wc_get_product()->get_type() == 'tour_phys' ) {
				$crumbs[1][0] = get_the_title( $tour_id );
				$crumbs[1][1] = get_page_link( $tour_id );
				// $crumbs[2][0] = get_the_title( get_the_ID() );
				// $crumbs[2][1] = get_permalink( get_the_ID() );
			}
		}
	}

	return $crumbs;
}


if ( class_exists( '\Thim_EL_Kit\Functions' ) ) {
	$build_el = \Thim_EL_Kit\Functions::instance()->get_conditions_by_type( 'single-tour' );
	if ( ! empty( $build_el ) ) {
		add_filter( 'fields_tab_tour_booking', 'travel_booking_remove_fields_tab_tour', 1 );
	}
}
add_filter( 'breadcrumbs_hide_single_title', '__return_true' );

function travel_booking_remove_fields_tab_tour( $fields ) {
	unset( $fields["tour_show_only_form_enquiry"] );

	return $fields;
}
