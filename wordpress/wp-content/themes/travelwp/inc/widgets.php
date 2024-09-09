<?php
add_action( 'widgets_init', 'travelwp_social_load_widget' );

function travelwp_social_load_widget() {
	register_widget( 'travelwp_social_widget' );
	register_widget( 'travelwp_search_widget' );
	register_widget( 'travelwp_login_from_widget' );
	if ( class_exists( 'TravelBookingPhyscode' ) && class_exists( 'WooCommerce' ) ) {
		register_widget( 'travelwp_tour_widget' );
	}
}

class travelwp_social_widget extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget-socials',
			'description' => esc_html__( 'A widget that displays your social icons', 'travelwp' )
		);
		parent::__construct( 'travelwp_social_widget', 'TravelWP: Social Icons', $widget_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$facebook   = $instance['facebook'];
		$twitter    = $instance['twitter'];
		$googleplus = $instance['googleplus'];
		$instagram  = $instance['instagram'];
		$bloglovin  = $instance['bloglovin'];
		$youtube    = $instance['youtube'];
		$tumblr     = $instance['tumblr'];
		$pinterest  = $instance['pinterest'];

		/* Before widget (defined by themes). */
		echo ent2ncr( $before_widget );
		?>

		<div class="widget-social">
			<?php if ( $facebook ) : ?>
			<a href="http://facebook.com/<?php echo esc_attr( $facebook ); ?>" target="_blank">
					<i class="fa fa-facebook"></i></a><?php endif; ?>
			<?php if ( $twitter ) : ?>
			<a href="http://twitter.com/<?php echo esc_attr( $twitter ) ?>" target="_blank">
					<i class="fa flaticon-twitter"></i></a><?php endif; ?>
			<?php if ( $instagram ) : ?>
			<a href="http://instagram.com/<?php echo esc_attr( $instagram ); ?>" target="_blank">
					<i class="fa fa-instagram"></i></a><?php endif; ?>
			<?php if ( $pinterest ) : ?>
			<a href="http://pinterest.com/<?php echo esc_attr( $pinterest ); ?>" target="_blank">
					<i class="fa fa-pinterest"></i></a><?php endif; ?>
			<?php if ( $bloglovin ) : ?>
			<a href="http://bloglovin.com/<?php echo esc_attr( $bloglovin ); ?>" target="_blank">
					<i class="fa fa-heart"></i></a><?php endif; ?>
			<?php if ( $googleplus ) : ?>
			<a href="http://plus.google.com/<?php echo esc_attr( $googleplus ); ?>" target="_blank">
					<i class="fa fa-google-plus"></i></a><?php endif; ?>
			<?php if ( $tumblr ) : ?>
			<a href="http://<?php echo esc_attr( $tumblr ); ?>.tumblr.com/" target="_blank">
					<i class="fa fa-tumblr"></i></a><?php endif; ?>
			<?php if ( $youtube ) : ?>
			<a href="http://youtube.com/<?php echo esc_attr( $youtube ); ?>" target="_blank">
					<i class="fa fa-youtube-play"></i></a><?php endif; ?>
		</div>


		<?php

		/* After widget (defined by themes). */
		echo ent2ncr( $after_widget );
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */

		$instance['facebook']   = strip_tags( $new_instance['facebook'] );
		$instance['twitter']    = strip_tags( $new_instance['twitter'] );
		$instance['googleplus'] = strip_tags( $new_instance['googleplus'] );
		$instance['instagram']  = strip_tags( $new_instance['instagram'] );
		$instance['bloglovin']  = strip_tags( $new_instance['bloglovin'] );
		$instance['youtube']    = strip_tags( $new_instance['youtube'] );
		$instance['tumblr']     = strip_tags( $new_instance['tumblr'] );
		$instance['pinterest']  = strip_tags( $new_instance['pinterest'] );

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'facebook'   => 'physcode',
			'twitter'    => 'physcode',
			'instagram'  => 'physcode',
			'googleplus' => '',
			'bloglovin'  => '',
			'youtube'    => '',
			'pinterest'  => '',
			'tumblr'     => ''

		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_html_e( 'Facebook Name:', 'travelwp' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" value="<?php echo esc_attr( $instance['facebook'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_html_e( 'Twitter Name:', 'travelwp' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" value="<?php echo esc_attr( $instance['twitter'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php esc_html_e( 'Instagram Name:', 'travelwp' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" value="<?php echo esc_attr( $instance['instagram'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>"><?php esc_html_e( 'Pinterest Name:', 'travelwp' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" value="<?php echo esc_attr( $instance['pinterest'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'bloglovin' ) ); ?>"><?php esc_html_e( 'Bloglovin Name:', 'travelwp' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'bloglovin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bloglovin' ) ); ?>" value="<?php echo esc_attr( $instance['bloglovin'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'googleplus' ) ); ?>"><?php esc_html_e( 'Google Plus Name:', 'travelwp' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'googleplus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'googleplus' ) ); ?>" value="<?php echo esc_attr( $instance['googleplus'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>"><?php esc_html_e( 'Tumblr Name:', 'travelwp' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tumblr' ) ); ?>" value="<?php echo esc_attr( $instance['tumblr'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_html_e( 'Youtube Name:', 'travelwp' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" value="<?php echo esc_attr( $instance['youtube'] ); ?>" />
		</p>

		<?php
	}
}

class travelwp_search_widget extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget travel_search',
			'description' => esc_html__( 'A search form for your site.', 'travelwp' )
		);
		parent::__construct( 'travelwp_search_widget', 'TravelWP: Search', $widget_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		/* Before widget (defined by themes). */
		echo ent2ncr( $before_widget );
		?>
		<div class="search-toggler-unit">
			<div class="search-toggler">
				<i class="fa fa-search"></i>
			</div>
		</div>
		<div class="search-menu search-overlay search-hidden">
			<div class="closeicon"></div>
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
				<input type="search" class="search-field" placeholder="<?php echo esc_html__( 'Search ...', 'travelwp' ) ?>" value="" name="s" title="<?php echo esc_html__( 'Search for:', 'travelwp' ) ?>">
				<input type="submit" class="search-submit font-awesome" value="&#xf002;">
			</form>
			<div class="background-overlay"></div>
		</div>

		<?php

		/* After widget (defined by themes). */
		echo ent2ncr( $after_widget );
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		return $instance;
	}


	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array();
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<!-- Widget Title: Text Input -->
		<?php
	}
}

class travelwp_login_from_widget extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_login_form',
			'description' => esc_html__( 'from login and register', 'travelwp' )
		);
		parent::__construct( 'travelwp_login_register_from', 'TravelWP: Login & Register Popup', $widget_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$title_form_login    = $instance['title_form_login'];
		$title_form_register = $instance['title_form_register'];
		/* Before widget (defined by themes). */
		echo ent2ncr( $before_widget );
		$registration_enabled = get_option( 'users_can_register' );
 		if ( is_user_logged_in() ) {
			echo '<a href="' . wp_logout_url( get_permalink() ) . '">' . esc_html__( 'Logout', 'travelwp' ) . '</a>';
		} else {
			?>
			<span class="show_from login"><i class="fa fa-user"></i><?php esc_html_e( 'Login', 'travelwp' ) ?></span>
			<!-- Modal -->
			<div class="form_popup from_login" tabindex="-1">
				<div class="inner-form">
					<div class="closeicon"></div>
					<?php
					if ( $title_form_login ) {
						echo '<h3>' . $title_form_login . '</h3>';
					}
					?>
 						<form id="login" class="ajax-auth" action="login" method="post">
 							<p class="status"></p>
							<?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
							<p class="login-username">
								<label for="user_login"><?php esc_html_e('Username or Email Address','travelwp')?></label>
								<input type="text" name="username" id="username" class="required input" value="" size="20" autocomplete="off">
							 </p>
							 <p class="login-password">
								<label for="user_pass"><?php esc_html_e('Password','travelwp')?></label>
								 <input id="password" type="password" class="required" name="password" value="" size="20" autocomplete="off">
  							</p>
  							<p class="login-remember">
  							   	 <a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="<?php esc_html_e( 'Lost your password?', 'travelwp' ) ?>" class="lost-pass"><?php esc_html_e( 'Lost your password?', 'travelwp' ) ?></a>
 							</p>
							<p class="login-submit">
								<input type="submit" class="submit_button button button-primary" value="<?php esc_html_e( 'Log In', 'travelwp' ) ?>">
							</p>
   						</form>
 						<?php do_action( 'register_form' ); ?>
 				</div>
			</div>
			<?php if ( $registration_enabled == '1' ) {
 					?>
					<span class="register_btn"><?php esc_html_e( 'Register', 'travelwp' ) ?></span>
					<!-- Modal -->
					<div class="form_popup from_register" tabindex="-1">
						<div class="inner-form">
							<div class="closeicon"></div>
							<?php
							if ( $title_form_register ) {
								echo '<h3>' . $title_form_register . '</h3>';
							}
							?>
							<form id="register" class="ajax-auth"  action="register" method="post">
 								<p class="status"></p>
								<?php wp_nonce_field('ajax-register-nonce', 'signonsecurity'); ?>
								<p class="form-row">
									<label for="signonname"><?php esc_html_e( 'Username', 'travelwp' ); ?><span class="required">*</span></label>
									<input type="text" class="input required" name="signonname" id="signonname" value="" />
								</p>
								<p class="form-row">
									<label for="email"><?php esc_html_e( 'Email address', 'travelwp' ); ?><span class="required">*</span></label>
									<input type="email" class="input required" name="email" id="email" value="" />
								</p>
								<div style="left: -999em; position: absolute;">
									<label for="trap"><?php esc_html_e( 'Anti-spam', 'travelwp' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" autocomplete="off" />
								</div>

								<p class="form-row">
									<label for="signonpassword"><?php esc_html_e( 'Password', 'travelwp' ); ?>
										<span class="required">*</span></label>
									<input type="password" class="input required" name="signonpassword" id="signonpassword" />
								</p>
								<p class="form-row">
 									<input type="submit" class="button submit_button" value="<?php esc_html_e( 'Register', 'travelwp' ); ?>" />
								</p>

 							</form>
 							<?php do_action( 'register_form' ); ?>
						</div>
					</div>
				<?php
			}
		} ?>
		<div class="background-overlay"></div>
		<?php

		/* After widget (defined by themes). */
		echo ent2ncr( $after_widget );
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		/* Strip tags for title and name to remove HTML (important for text inputs). */

		$instance['title_form_login']    = strip_tags( $new_instance['title_form_login'] );
		$instance['title_form_register'] = strip_tags( $new_instance['title_form_register'] );

		return $instance;
	}


	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title_form_login'    => 'Login',
			'title_form_register' => 'Register',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title_form_login' ) ); ?>"><?php esc_html_e( 'Title Form Login:', 'travelwp' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'title_form_login' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_form_login' ) ); ?>" value="<?php echo esc_attr( $instance['title_form_login'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title_form_register' ) ); ?>"><?php esc_html_e( 'Title Form Register:', 'travelwp' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'title_form_register' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_form_register' ) ); ?>" value="<?php echo esc_attr( $instance['title_form_register'] ); ?>" />
		</p>
		<?php
	}
}

class travelwp_tour_widget extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_travel_tour',
			'description' => esc_html__( 'show tour', 'travelwp' )
		);
		parent::__construct( 'travelwp_tour_register', 'TravelWP: Special Tour', $widget_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$tour_cat     = $instance['tour_cat'];
		$orderby      = $instance['orderby'];
		$order        = $instance['order'];
		$tour_id      = $instance['tour_id'];
		$number_post  = $instance['number_post'];
		$display_mode = $instance['display_mode'];
		/* Before widget (defined by themes). */


		$query_args = array(
			'posts_per_page' => $number_post,
			'post_status'    => 'publish',
			'no_found_rows'  => 1,
			'order'          => $order == 'asc' ? 'asc' : 'desc',
			'post_type'      => array( 'product' ),
			'wc_query'       => 'tours'
		);
		if ( $tour_id ) {
			$tour_ids               = explode( ',', $tour_id );
			$query_args['post__in'] = $tour_ids;
		}
		$query_args['meta_query'] = array();

		if ( $tour_cat <> '' ) {
			$tour_cat_id             = explode( ',', $tour_cat );
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'tour_phys',
					'field'    => 'term_id',
					'terms'    => $tour_cat_id,
					'operator' => 'IN',
				)
			);
		} else {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'product_type',
					'field'    => 'slug',
					'terms'    => array( 'tour_phys' ),
					'operator' => 'IN',
				)
			);
		}
		switch ( $orderby ) {
			case 'price' :
				$query_args['meta_key'] = '_price';
				$query_args['orderby']  = 'meta_value_num';
				break;
			case 'rand' :
				$query_args['orderby'] = 'rand';
				break;
			case 'sales' :
				$product_ids_on_sale    = wc_get_product_ids_on_sale();
				$product_ids_on_sale[]  = 0;
				$query_args['post__in'] = $product_ids_on_sale;
				$query_args['meta_key'] = '_price';
				$query_args['orderby']  = 'meta_value_num';
				break;
			default :
				$query_args['orderby'] = 'date';
		}
		// tour expire
		if ( get_option( 'tour_expire_on_list' ) && get_option( 'tour_expire_on_list' ) == 'no' ) {
			$query_args['meta_query'] = array(
				array(
					'key'     => '_date_finish_tour',
					'compare' => '>=',
					'value'   => date( 'Y-m-d' ),
					'type'    => 'DATE',
				)
			);
		}
		$the_query = new WP_Query( $query_args );
		echo ent2ncr( $before_widget );
		echo '<div class="wrapper-special-tours">';
		if ( $the_query->have_posts() ) :
 			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				?>
				 <div class="inner-special-tours">
 					<?php
					/**
 					 * @hooked woocommerce_template_loop_product_link_open - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item' );

 					do_action( 'woocommerce_before_shop_loop_item_title' );

				woocommerce_template_loop_rating();
				the_title( sprintf( '<div class="post_title"><h3><a href="%s" rel="bookmark">', esc_url( get_permalink( get_the_ID() ) ) ), '</a></h3></div>' );
				echo '<div class="item_price">';
				do_action( 'woocommerce_before_shop_loop_item_title_price' );
				echo '</div>';
				echo '</div>';
 			endwhile;
 			// Reset Post Data
			wp_reset_postdata();
		endif;
 		echo '</div>';
		/* After widget (defined by themes). */
		echo ent2ncr( $after_widget );
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['tour_cat']     = strip_tags( $new_instance['tour_cat'] );
		$instance['orderby']      = strip_tags( $new_instance['orderby'] );
		$instance['order']        = strip_tags( $new_instance['order'] );
		$instance['tour_id']      = strip_tags( $new_instance['tour_id'] );
		$instance['number_post']  = strip_tags( $new_instance['number_post'] );
		$instance['display_mode'] = strip_tags( $new_instance['display_mode'] );

		return $instance;
	}

	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array(
			'tour_cat'     => '',
			'orderby'      => 'date',
			'order'        => 'desc',
			'tour_id'      => '',
			'number_post'  => '1',
			'display_mode' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$tour_cat = $instance['tour_cat'];
		$orderby  = $instance['orderby'];

		$args = array(
			'pad_counts'         => 1,
			'show_counts'        => 1,
			'hierarchical'       => 1,
			'hide_empty'         => 1,
			'show_uncategorized' => 1,
			'orderby'            => 'name',
			'menu_order'         => false
		);


		$terms      = get_terms( 'tour_phys', $args );
		$categories = array();
		foreach ( $terms as $term ) {
			$categories[$term->term_id] = $term->name;
		}
		?>
		<p>
			<label><?php echo esc_html__( 'Tour category', 'travelwp' ); ?></label>
			<select name="<?php echo ent2ncr( $this->get_field_name( 'tour_cat' ) ); ?>" class="widefat">
				<option value="" <?php selected( $tour_cat, '' ) ?>><?php echo esc_html__( 'Any', 'travelwp' ) ?></option>
				<?php if ( count( $categories ) ) {
					foreach ( $categories as $k => $cate ) {
						?>
						<option value="<?php echo esc_attr( $k ) ?>" <?php selected( $tour_cat, $k ) ?>><?php echo ent2ncr( $cate ) ?></option>
					<?php }
				} ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php echo esc_html__( "Order by", "travelwp" ) ?></label>
			<select name="<?php echo ent2ncr( $this->get_field_name( 'orderby' ) ); ?>" class="widefat">
				<option value="date" <?php selected( $orderby, 'date' ) ?>><?php echo esc_html__( 'Date', 'travelwp' ) ?></option>
				<option value="price" <?php selected( $orderby, 'price' ) ?>><?php echo esc_html__( 'Price', 'travelwp' ) ?></option>
				<option value="rand" <?php selected( $orderby, 'rand' ) ?>><?php echo esc_html__( 'Rand', 'travelwp' ) ?></option>
				<option value="sales" <?php selected( $orderby, 'rand' ) ?>><?php echo esc_html__( 'Sales', 'travelwp' ) ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php echo esc_html__( "Order", "travelwp" ) ?></label>
			<select name="<?php echo ent2ncr( $this->get_field_name( 'order' ) ); ?>" class="widefat">
				<option value="desc" <?php selected( $orderby, 'desc' ) ?>><?php echo esc_html__( 'DESC', 'travelwp' ) ?></option>
				<option value="asc" <?php selected( $orderby, 'asc' ) ?>><?php echo esc_html__( 'ASC', 'travelwp' ) ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tour_id' ) ); ?>"><?php esc_html_e( 'Tour ID', 'travelwp' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'tour_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tour_id' ) ); ?>" value="<?php echo esc_attr( $instance['tour_id'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number_post' ) ); ?>"><?php esc_html_e( 'Number Post', 'travelwp' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'number_post' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_post' ) ); ?>" value="<?php echo esc_attr( $instance['number_post'] ); ?>" />
		</p>
		<?php
	}
}

add_action( 'widgets_init', array( 'travelwp_Widget_Attributes', 'setup' ) );

class travelwp_Widget_Attributes {
	const VERSION = '0.2.2';

	/**
	 * Initialize plugin
	 */
	public static function setup() {
		if ( is_admin() ) {
			// Add necessary input on widget configuration form
			add_action( 'in_widget_form', array( __CLASS__, '_input_fields' ), 10, 3 );
			// Save widget attributes
			add_filter( 'widget_update_callback', array( __CLASS__, '_save_attributes' ), 10, 4 );
		} else {
			// Insert attributes into widget markup
			add_filter( 'dynamic_sidebar_params', array( __CLASS__, '_insert_attributes' ) );
		}
	}


	/**
	 * Inject input fields into widget configuration form
	 *
	 * @since   0.1
	 * @wp_hook action in_widget_form
	 *
	 * @param object $widget Widget object
	 *
	 * @return NULL
	 */
	public static function _input_fields( $widget, $return, $instance ) {
		$instance = self::_get_attributes( $instance );
		?>
		<p>
			<?php printf(
				'<label for="%s">%s</label>',
				esc_attr( $widget->get_field_id( 'widget-class' ) ),
				esc_html__( 'Extra Class', 'travelwp' )
			) ?>
			<?php
			printf(
				'<input type="text" class="widefat" id="%s" name="%s" value="%s" />',
				esc_attr( $widget->get_field_id( 'widget-class' ) ),
				esc_attr( $widget->get_field_name( 'widget-class' ) ),
				esc_attr( $instance['widget-class'] )
			);
			?>
		</p>
		<?php
		return null;
	}


	/**
	 * Get default attributes
	 *
	 * @since 0.1
	 *
	 * @param array $instance Widget instance configuration
	 *
	 * @return array
	 */
	private static function _get_attributes( $instance ) {
		$instance = wp_parse_args(
			$instance,
			array(
				'widget-class' => '',
			)
		);

		return $instance;
	}


	/**
	 * Save attributes upon widget saving
	 *
	 * @since   0.1
	 * @wp_hook filter widget_update_callback
	 *
	 * @param array  $instance     Current widget instance configuration
	 * @param array  $new_instance New widget instance configuration
	 * @param array  $old_instance Old Widget instance configuration
	 * @param object $widget       Widget object
	 *
	 * @return array
	 */
	public static function _save_attributes( $instance, $new_instance, $old_instance, $widget ) {
		$instance['widget-class'] = '';

		// Classes
		if ( !empty( $new_instance['widget-class'] ) ) {
			$instance['widget-class'] = apply_filters(
				'widget_attribute_classes',
				implode(
					' ',
					array_map(
						'sanitize_html_class',
						explode( ' ', $new_instance['widget-class'] )
					)
				)
			);
		} else {
			$instance['widget-class'] = '';
		}

		return $instance;
	}


	/**
	 * Insert attributes into widget markup
	 *
	 * @since  0.1
	 * @filter dynamic_sidebar_params
	 *
	 * @param array $params Widget parameters
	 *
	 * @return Array
	 */
	public static function _insert_attributes( $params ) {
		global $wp_registered_widgets;

		$widget_id  = $params[0]['widget_id'];
		$widget_obj = $wp_registered_widgets[$widget_id];

		if (
			!isset( $widget_obj['callback'][0] )
			|| !is_object( $widget_obj['callback'][0] )
		) {
			return $params;
		}

		$widget_options = get_option( $widget_obj['callback'][0]->option_name );
		if ( empty( $widget_options ) ) {
			return $params;
		}

		$widget_num = $widget_obj['params'][0]['number'];
		if ( empty( $widget_options[$widget_num] ) ) {
			return $params;
		}

		$instance = $widget_options[$widget_num];
		// Classes
		if ( !empty( $instance['widget-class'] ) ) {
			$params[0]['before_widget'] = preg_replace(
				'/class="/',
				sprintf( 'class="%s ', $instance['widget-class'] ),
				$params[0]['before_widget'],
				1
			);
		}

		return $params;
	}
}


// ajax register
function ajax_auth_init(){
 	wp_enqueue_script('validate-script', get_template_directory_uri() . '/assets/js/jquery.validate.min.js', array('jquery') );
 	wp_enqueue_script('ajax-auth-script', get_template_directory_uri() . '/assets/js/ajax-auth-script.js', array('jquery') );
    wp_localize_script( 'ajax-auth-script', 'ajax_auth_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => home_url(),
        'loadingmessage' => __('Sending user info, please wait...','travelwp')
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
	// Enable the user with no privileges to run ajax_register() in AJAX
	add_action( 'wp_ajax_nopriv_ajaxregister', 'ajax_register' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'ajax_auth_init');
}

function ajax_login(){
     // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );
   	// Call auth_user_login
	auth_user_login($_POST['username'], $_POST['password'],__('Login','travelwp'));
     die();
}

function ajax_register(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-register-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
  	$info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($_POST['username']) ;
    $info['user_pass'] = sanitize_text_field($_POST['password']);
	$info['user_email'] = sanitize_email( $_POST['email']);
 	// Register the user
    $user_register = wp_insert_user( $info );
 	if ( is_wp_error($user_register) ){
		$error  = $user_register->get_error_codes()	;
 		if(in_array('empty_user_login', $error))
			{echo json_encode(array('loggedin'=>false, 'message'=>$user_register->get_error_message('empty_user_login')));}
		elseif(in_array('existing_user_login',$error))
			{echo json_encode(array('loggedin'=>false, 'message'=>__('This username is already registered.','travelwp')));}
		elseif(in_array('existing_user_email',$error))
        {echo json_encode(array('loggedin'=>false, 'message'=>__('This email address is already registered.','travelwp')));}
    } else {
 		$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
		$message  = sprintf(__('New user registration on your site %s:','travelwp'), $blogname) . "\r\n\r\n";
		$message .= sprintf(__('Username: %s','travelwp'), $_POST['username'] ) . "\r\n\r\n";
		$message .= sprintf(__('E-mail: %s','travelwp'), $_POST['email'] ) . "\r\n";
  		$headers = sprintf(__('From: %1$s <%2$s>','travelwp'), $blogname, get_option('admin_email')) . "\r\n";;
		@wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration','travelwp'), $blogname), $message, $headers);

 		$message  = sprintf(esc_html__('Thanks for creating an account on %1$s Your username is %2$s','travelwp'), $blogname, $_POST['username']) . "\r\n";
 		$message .= sprintf(esc_html__('Password: %s','travelwp'), $_POST['password']) . "\r\n";
		$message .= wp_login_url() . "\r\n";

		wp_mail($_POST['email'],  __('Thank you for your registration','travelwp'), $message, $headers);

 	  	auth_user_login($info['nickname'], $info['user_pass'],__('Registration','travelwp'));
    }

    die();
}

function auth_user_login($user_login, $password, $login){
	$info = array();
    $info['user_login'] = $user_login;
    $info['user_password'] = $password;
    $info['remember'] = true;

	$user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
		echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.','travelwp')));
    } else {
		wp_set_current_user($user_signon->ID);
        echo json_encode(array('loggedin'=>true, 'message'=>__($login.' successful, redirecting...','travelwp')));
    }

	die();
}
