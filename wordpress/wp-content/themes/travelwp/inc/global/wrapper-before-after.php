<?php
if ( !function_exists( 'travelwp_wrapper_layout' ) ) :
	function travelwp_wrapper_layout() {
		global $travelwp_theme_options, $wp_query;
		$wrapper_layout = $cat_ID = '';
		$class_col      = 'col-sm-9 alignright';
		if ( get_post_type() == "product" ) {
			if ( wc_get_product()->is_type( 'tour_phys' ) ) {
				$prefix = 'phys_tour';
			} else {
				$prefix = 'woo';
			}
		} elseif ( get_query_var( 'tour_search' ) == 1 ) {
			$prefix = 'phys_tour';
		} else {
			if ( is_front_page() || is_home() ) {
				$prefix = 'archive_front_page';
			} else {
				$prefix = 'archive';
			}
		}
		if ( is_search() ) {
			$prefix = 'archive';
		}

		// get id category
		$cat_obj = $wp_query->get_queried_object();
		if ( isset( $cat_obj->term_id ) ) {
			$cat_ID = $cat_obj->term_id;
		}
		// get layout
		if ( is_page() || is_single() ) {
			if ( isset( $travelwp_theme_options[$prefix . '_single_layout'] ) ) {
				$wrapper_layout = $travelwp_theme_options[$prefix . '_single_layout'];
			}
			/***********custom layout*************/
			$wrapper_layout = get_post_meta( get_the_ID(), 'phys_custom_layout', true ) ? get_post_meta( get_the_ID(), 'layout', true ) : $wrapper_layout;
		} else {
			if ( isset( $travelwp_theme_options[$prefix . '_cate_layout'] ) ) {
				$wrapper_layout = $travelwp_theme_options[$prefix . '_cate_layout'];
			}
			/***********custom layout*************/

			$using_custom_layout = get_tax_meta( $cat_ID, 'phys_layout', true );
			if ( $using_custom_layout <> '' ) {
				$wrapper_layout = get_tax_meta( $cat_ID, 'phys_layout', true );
			}
		}

		if ( $wrapper_layout == 'full-content' ) {
			$class_col = "col-sm-12 full-width";
		}
		if ( $wrapper_layout == 'sidebar-right' ) {
			$class_col = "col-sm-9 alignleft";
		}
		if ( $wrapper_layout == 'sidebar-left' ) {
			$class_col = 'col-sm-9 alignright';
		}

		return $class_col;
	}
endif;
add_action( 'travelwp_wrapper_loop_start', 'travelwp_wrapper_loop_start',5 );

if ( !function_exists( 'travelwp_wrapper_loop_start' ) ) :
	function travelwp_wrapper_loop_start() {
		$class_col = travelwp_wrapper_layout();
		echo '<section class="content-area"><div class="container"><div class="row"><div class="site-main ' . $class_col . '">';
	}
endif;

add_action( 'travelwp_wrapper_loop_end', 'travelwp_wrapper_loop_end' ,5);

if ( !function_exists( 'travelwp_wrapper_loop_end' ) ) :
	function travelwp_wrapper_loop_end() {
		$class_col = travelwp_wrapper_layout();
		echo '</div>';
		if ( $class_col != 'col-sm-12 full-width' ) {
			if ( get_post_type() == "product" ) {
				if ( wc_get_product()->is_type( 'tour_phys' ) ) {
					get_sidebar( 'tour' );
				} else {
					get_sidebar( 'shop' );
				}
			} elseif ( get_query_var( 'tour_search' ) == 1 ) {
				get_sidebar( 'tour' );
			} else {
				get_sidebar();
			}
		}
		echo '</div></div></section>';
	}
endif;

// Heading Top
add_action( 'travelwp_wrapper_banner_heading', 'travelwp_wrapper_banner_heading', 5 );

if ( !function_exists( 'travelwp_wrapper_banner_heading' ) ) :
	function travelwp_wrapper_banner_heading() {
		global $wp_query, $travelwp_theme_options;
		/***********custom Top Images*************/
		$custom_title     = $bg_color = $phys_custom_heading = $cate_top_image_src = $front_title = $text_color = $cate_top_image_src = '';
		$hide_breadcrumbs = $hide_title = 0;

		$cat_obj = $wp_query->get_queried_object();
		$cat_ID  = isset( $cat_obj->term_id ) ? $cat_obj->term_id : "";

		if ( get_post_type() == "product" ) {
			if ( wc_get_product()->is_type( 'tour_phys' ) ) {
				$prefix       = 'phys_tour';
				$prefix_inner = '_cate_';
			} else {
				$prefix       = 'phys_woo';
				$prefix_inner = '_cate_';
			}
		} elseif ( get_query_var( 'tour_search' ) == 1 ) {
			$prefix       = 'phys_tour';
			$prefix_inner = '_cate_';
		} else {
			if ( is_front_page() || is_home() ) {
				$prefix       = 'phys';
				$prefix_inner = '_front_page_';
				if ( travelwp_get_option( $prefix . $prefix_inner . 'custom_title' ) ) {
					$front_title = travelwp_get_option( $prefix . $prefix_inner . 'custom_title' );
				}
			} else {
				$prefix       = 'phys_archive';
				$prefix_inner = '_cate_';
			}
		}
		// single and archive
		if ( is_page() || is_single() ) {
			$prefix_inner = '_single_';
		}
		// get data for theme customizer
		if ( travelwp_get_option( $prefix . $prefix_inner . 'heading_text_color' ) ) {
			$text_color = travelwp_get_option( $prefix . $prefix_inner . 'heading_text_color' );
		}

		if ( travelwp_get_option( $prefix . $prefix_inner . 'heading_bg_color' ) ) {
			$bg_color = $travelwp_theme_options[$prefix . $prefix_inner . 'heading_bg_color'] ['color'];
		}

		if ( travelwp_get_option( $prefix . $prefix_inner . 'top_image' ) ) {
			$cate_top_image_src = $travelwp_theme_options[$prefix . $prefix_inner . 'top_image']['url'];
		}
		if ( travelwp_get_option( $prefix . $prefix_inner . 'hide_title' ) ) {
			$hide_title = travelwp_get_option( $prefix . $prefix_inner . 'hide_title' );
		}

		if ( travelwp_get_option( $prefix . $prefix_inner . 'hide_breadcrumbs' ) ) {
			$hide_breadcrumbs = travelwp_get_option( $prefix . $prefix_inner . 'hide_breadcrumbs' );
		}

		if ( is_page() || is_single() ) {
			$using_custom_heading = get_post_meta( get_the_ID(), 'phys_user_featured_title', true );
			if ( $using_custom_heading ) {
				$hide_title       = get_post_meta( get_the_ID(), 'phys_hide_title', true );
				$hide_breadcrumbs = get_post_meta( get_the_ID(), 'phys_hide_breadcrumbs', true );
				$custom_title     = get_post_meta( get_the_ID(), 'phys_custom_title', true );
				$text_color_1     = get_post_meta( get_the_ID(), 'phys_text_color', true );
				if ( $text_color_1 <> '' ) {
					$text_color = $text_color_1;
				}
				$bg_color_1 = get_post_meta( get_the_ID(), 'phys_bg_color', true );
				if ( $bg_color_1 <> '' ) {
					$bg_color = $bg_color_1;
				}

				$cate_top_image = get_post_meta( get_the_ID(), 'phys_top_image', true );
				if ( $cate_top_image ) {
					$cate_top_images = wp_get_attachment_image_src( $cate_top_image, 'full' );
					if ( $cate_top_images ) {
						$cate_top_image_src = $cate_top_images[0];
					}
				}
			}
		} else {
			$phys_custom_heading = get_tax_meta( $cat_ID, 'phys_custom_heading', true );
			if ( $phys_custom_heading == 'custom' ) {
				$text_color_1 = get_tax_meta( $cat_ID, 'phys_cate_heading_text_color', true );
				$bg_color_1   = get_tax_meta( $cat_ID, 'phys_cate_heading_bg_color', true );
				if ( $text_color_1 != '#' ) {
					$text_color = $text_color_1;
				}
				if ( $bg_color_1 != '#' ) {
					$bg_color = $bg_color_1;
				}
				$hide_breadcrumbs_1 = get_tax_meta( $cat_ID, 'phys_cate_hide_breadcrumbs', true );
				$hide_title_1       = get_tax_meta( $cat_ID, 'phys_cate_hide_title', true );
				$cate_top_image     = get_tax_meta( $cat_ID, 'phys_cate_top_image', true );
				if ( $cate_top_image ) {
					$cate_top_image_src = $cate_top_image['url'];
				}
				if ( $hide_title_1 == 'on' ) {
					$hide_title = 1;
				}
				if ( $hide_breadcrumbs_1 != 'on' ) {
					$hide_breadcrumbs = 1;
				}
			}
		}

		$c_css_style = ( $text_color != '' ) ? 'color: ' . $text_color . ';' : '';
		$c_css_style .= ( $bg_color != '' ) ? 'background-color: ' . $bg_color . ';' : '';
		$c_css_style .= ( $cate_top_image_src != '' ) ? 'background-image:url( ' . $cate_top_image_src . ');' : '';
		$c_css       = ( $c_css_style != '' ) ? 'style="' . $c_css_style . '"' : '';
		?>
		<div class="top_site_main" <?php echo ent2ncr( $c_css ); ?>>
			<?php if ( $hide_title != '1' || $hide_breadcrumbs != '1' ) { ?>
				<div class="banner-wrapper container article_heading">
					<?php
					if ( $hide_breadcrumbs != '1' ) { ?>
						<div class="breadcrumbs-wrapper">
							<?php if ( get_post_type() == 'product' ) {

								if ( wc_get_product()->is_type( 'tour_phys' ) ) {
									travelwp_breadcrumbs();
								} else {
									$array = array(
										'before'      => '<li>',
										'after'       => '</li>',
										'wrap_before' => '<ul class="phys-breadcrumb">',
										'wrap_after'  => '</ul>',
									);
									woocommerce_breadcrumb( $array );
								}
							} elseif ( is_search() || is_tag() || is_author() || is_date() || is_day() || is_month() || is_year() || is_time() ) {

							} else {
								travelwp_breadcrumbs();
							}
							?>
						</div>
					<?php }

					if ( $hide_title != '1' ) {
						if ( is_single() ) {
							$typography = 'h2';
						} else {
							$typography = 'h1';
						}
						if ( ( is_page() || is_single() ) && get_post_type() != 'product' ) {
							if ( is_single() ) {
								$category = get_the_category();
								if ( count( $category ) ) {
									$category_id = get_cat_ID( $category[0]->cat_name );
									echo ' <' . $typography . ' class="heading_primary">' . get_category_parents( $category_id, false, " " );
									echo '</' . $typography . '>';
								} else {
									echo '<' . $typography . ' class="heading_primary">';
									echo ( $custom_title != '' ) ? $custom_title : get_the_title( get_the_ID() );
									echo '</' . $typography . '>';
								}
							} else {
								echo '<' . $typography . ' class="heading_primary">';
								echo ( $custom_title != '' ) ? $custom_title : get_the_title( get_the_ID() );
								echo '</' . $typography . '>';
							}
						} elseif ( get_post_type() == 'product' ) {
							$phys_tour_cate_description = '';
							echo '<' . $typography . ' class="heading_primary">';
							if ( wc_get_product()->is_type( 'tour_phys' ) ) {
								if ( is_tax() ) {
									echo single_term_title( '', false );
								} else {
									$page_current_id = get_option( Tour_Settings_Tab_Phys::$_tours_show_page_id );
									$phys_tour_cate_description .= travelwp_get_option('phys_tour_cate_description');
									//echo get_the_title( $page_current_id );
									echo ( $custom_title != '' ) ? $custom_title : get_the_title( $page_current_id );
								}
							} else {
								if ( $custom_title != '' ) {
									echo $custom_title;
								} else {
									woocommerce_page_title();
								}
							}
							echo '</' . $typography . '>';
							if (!empty($phys_tour_cate_description)) {
								echo wpautop($phys_tour_cate_description);
							}
						} elseif ( get_query_var( 'tour_search' ) == 1 ) {
							echo '<' . $typography . ' class="heading_primary">';
							echo esc_html__( 'Displaying Results for:', 'travelwp' ) . ' ' . get_query_var( 'name_tour' );
							echo '</' . $typography . '>';
						} elseif ( is_front_page() || is_home() ) {
							echo '<' . $typography . ' class="heading_primary">';
							$page_id = get_option( 'page_for_posts' );
							if ( $page_id <> 0 ) {
								echo get_the_title( $page_id );
							} else {
								echo ( $front_title != '' ) ? $front_title : esc_html__( 'Blog', 'travelwp' );
							}
							echo '</' . $typography . '>';
						} else {
							echo '<' . $typography . ' class="heading_primary">';
							the_archive_title();

							echo '</' . $typography . '>';
						}
					}
					?>
				</div>
			<?php } ?>
		</div>
		<?php
	}
endif;

// Heading Destination
add_action( 'travelwp_banner_destination', 'travelwp_banner_destination', 5 );

if ( !function_exists( 'travelwp_banner_destination' ) ) :
	function travelwp_banner_destination() {
		global $wp_query, $travelwp_theme_options;
		/***********custom Top Images*************/
		$bg_color         = $phys_custom_heading = $cate_top_image_src = $front_title = $text_color = $cate_top_image_src = '';
		$hide_breadcrumbs = $hide_title = 0;
		$cat_obj          = $wp_query->get_queried_object();
		$cat_ID           = isset( $cat_obj->term_id ) ? $cat_obj->term_id : "";
		$prefix           = 'phys_tour_destination_';

		// get data for theme customizer
		if ( travelwp_get_option( $prefix . 'heading_text_color' ) ) {
			$text_color = travelwp_get_option( $prefix . 'heading_text_color' );
		}

		if ( travelwp_get_option( $prefix . 'heading_bg_color' ) ) {
			$bg_color = $travelwp_theme_options[$prefix . 'heading_bg_color'] ['color'];
		}

		if ( travelwp_get_option( $prefix . 'top_image' ) ) {
			$cate_top_image_src = $travelwp_theme_options[$prefix . 'top_image']['url'];
		}
		if ( travelwp_get_option( $prefix . 'hide_title' ) ) {
			$hide_title = travelwp_get_option( $prefix . 'hide_title' );
		}

		if ( travelwp_get_option( $prefix . 'hide_breadcrumbs' ) ) {
			$hide_breadcrumbs = travelwp_get_option( $prefix . 'hide_breadcrumbs' );
		}
		$phys_custom_heading = get_tax_meta( $cat_ID, 'phys_destination_custom_heading', true );
		if ( $phys_custom_heading == 'custom' ) {
			$text_color_1       = get_tax_meta( $cat_ID, 'phys_destination_heading_text_color', true );
			$bg_color_1         = get_tax_meta( $cat_ID, 'phys_destination_heading_bg_color', true );
			$hide_title_1       = get_tax_meta( $cat_ID, 'phys_destination_hide_title', true );
			$hide_breadcrumbs_1 = get_tax_meta( $cat_ID, 'phys_destination_hide_breadcrumbs', true );
			if ( $text_color_1 != '#' ) {
				$text_color = $text_color_1;
			}
			if ( $bg_color_1 != '#' ) {
				$bg_color = $bg_color_1;
			}
			if ( $hide_title_1 == 'on' ) {
				$hide_title = 1;
			}
			if ( $hide_breadcrumbs_1 != 'on' ) {
				$hide_breadcrumbs = 1;
			}
			$cate_top_image = get_tax_meta( $cat_ID, 'phys_destination_top_image', true );
			if ( $cate_top_image ) {
				$cate_top_image_src = $cate_top_image['url'];
			}

		}

		$c_css_style = ( $text_color != '' ) ? 'color: ' . $text_color . ';' : '';
		$c_css_style .= ( $bg_color != '' ) ? 'background-color: ' . $bg_color . ';' : '';
		$c_css_style .= ( $cate_top_image_src != '' ) ? 'background-image:url( ' . $cate_top_image_src . ');' : '';
		//css background and color
		$c_css = ( $c_css_style != '' ) ? 'style="' . $c_css_style . '"' : '';
		?>
		<div class="top_site_main" <?php echo ent2ncr( $c_css ); ?>>
			<?php if ( $hide_title != '1' || $hide_breadcrumbs != '1' ) { ?>
				<div class="banner-wrapper-destination container article_heading text-center">
					<?php
					if ( $hide_title != 1 ) {
						echo '<h1 class="heading_primary">';
						the_archive_title();
						echo '</h1>';
						if ( get_the_archive_description() ) {
							echo '<div class="desc">' . get_the_archive_description() . '</div>';
						}
					}
					if ( $hide_breadcrumbs != 1 ) {
						echo '<div class="breadcrumbs-wrapper">';
						travelwp_breadcrumbs();
						echo '</div>';
					}
					?>
				</div>
			<?php } ?>
		</div>
		<?php
	}
endif;