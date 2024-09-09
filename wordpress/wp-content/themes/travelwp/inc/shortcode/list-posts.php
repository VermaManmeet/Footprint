<?php
$args       = array(
	'pad_counts'         => 1,
	'show_counts'        => 1,
	'hierarchical'       => 1,
	'hide_empty'         => 1,
	'show_uncategorized' => 1,
	'orderby'            => 'name',
	'menu_order'         => false
);
$terms      = get_categories( $args );
$categories = array( esc_html__( 'All', 'travelwp' ) => 0 );
foreach ( $terms as $term ) {
	$categories[$term->name] = $term->term_id;
}

vc_map(
	array(
		"name"        => esc_html__( "List Post", 'travelwp' ),
		"icon"        => "icon-ui-splitter-horizontal",
		"base"        => "list_posts",
		"description" => "list posts",
		"category"    => esc_html__( "Travelwp", 'travelwp' ),
		"params"      => array(
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Heading', 'travelwp' ),
				'param_name' => 'heading',
				'value'      => '',
			),
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Heading type', 'travelwp' ),
				'param_name'  => 'heading_type',
				'value'       => array(
					esc_html__( 'H2', 'travelwp' ) => 'h2',
					esc_html__( 'H3', 'travelwp' ) => 'h3',
					esc_html__( 'H4', 'travelwp' ) => 'h4',
					esc_html__( 'H5', 'travelwp' ) => 'h5',
					esc_html__( 'H6', 'travelwp' ) => 'h6'
				),
				'std'         => 'h3',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'travelwp' ),
				'param_name' => 'style',
				'std'        => 'style_1',
				'value'      => array(
					esc_html__( 'Style 1', 'travelwp' ) => 'style_1',
					esc_html__( 'Style 2', 'travelwp' ) => 'style_2',
				)
			),
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Category', 'travelwp' ),
				'param_name'  => 'category',
				'value'       => $categories
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Limit', 'travelwp' ),
				'param_name' => 'limit',
				'value'      => '2',
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Post on row', 'travelwp' ),
				'param_name' => 'post_on_row',
				'value'      => '2',
				"dependency" => Array( "element" => "style", "value" => array( 'style_1' ) ),

			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Length Description', 'travelwp' ),
				'param_name' => 'length',
				'value'      => '10',
			),
			array(
				"type"        => "dropdown",
				"heading"     => esc_html__( "Display", "travelwp" ),
				"param_name"  => "display",
				"admin_label" => true,
				"value"       => array(
					esc_html__( "Random", "travelwp" )  => "random",
					esc_html__( "Popular", "travelwp" ) => "popular",
					esc_html__( "Recent", "travelwp" )  => "recent",
					esc_html__( "oldest", "travelwp" )  => "oldest"
				),
				"description" => esc_html__( "Select Orderby.", "travelwp" )
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Extra class name", "travelwp" ),
				"param_name"  => "el_class",
				"description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "travelwp" ),
			),
			travelwp_vc_map_add_css_animation( true )
		)
	)
);

function travelwp_shortcode_list_posts( $atts, $content = null ) {
	$travelwp_animation = $css_animation = $el_class = $category = $limit =
	$heading = $display = $heading_type = $post_on_row = $length = $style = '';
	extract(
		shortcode_atts(
			array(
				'category'      => '0',
				'heading_type'  => 'h2',
				'heading'       => '',
				'limit'         => '2',
				'post_on_row'   => '2',
				'length'        => '10',
				'style'         => 'style_1',
				'display'       => 'random',
				'el_class'      => '',
				'css_animation' => '',
			), $atts
		)
	);
	if ( $style == 'style_1' ) {
		$image_size = 'medium';
	} else {
		$image_size = 'thumbnail';
	}


	if ( $el_class ) {
		$travelwp_animation .= ' ' . $el_class;
	}
	$travelwp_animation .= travelwp_getCSSAnimation( $css_animation );
	$travelwp_animation .= ' list-post-' . $style;
	ob_start();

	$query_atts['posts_per_page'] = $limit;
	if ( $category ) {
		$cats_id                 = explode( ',', $category );
		$query_atts['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field'    => 'term_id',
				'terms'    => $cats_id
			)
		);
	}
	if ( $display == 'random' ) {
		$query_atts['orderby'] = 'rand';
	} elseif ( $display == 'popular' ) {
		$query_atts['orderby'] = 'comment_count';
	} elseif ( $display == 'recent' ) {
		$query_atts['orderby'] = 'post_date';
		$query_atts['order']   = 'DESC';
	} else {
		$query_atts['orderby'] = 'post_date';
		$query_atts['order']   = 'ASC';
	}
	$the_query = new WP_Query( $query_atts );
	if ( $the_query->have_posts() ) {
		echo '<div class="list-posts row ' . esc_attr( $travelwp_animation ) . '">';
		if ( $heading && $heading_type ) {
			echo '<div class="shortcode_title shortcode-title-' . $style . '">
						<' . $heading_type . ' class="title_primary">' . $heading . '</' . $heading_type . '>
						<span class="line_after_title"></span>
					</div>';
		}
		echo '<div class="row">';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			?>
			<div class="post_list_content_unit col-sm-<?php echo intval( 12 / $post_on_row ) ?>">
				<?php do_action( 'travelwp_entry_top', $image_size ); ?>
				<div class="post-list-content">
					<div class="post_list_inner_content_unit">
						<?php
						if ( has_post_format( 'link' ) ) {
							$url_link  = get_post_meta( get_the_ID(), '_format_link_url', true ) ? get_post_meta( get_the_ID(), '_format_link_url', true ) : get_the_permalink( get_the_ID() );
							$text_link = get_post_meta( get_the_ID(), '_format_link_text', true ) ? get_post_meta( get_the_ID(), '_format_link_text', true ) : the_title_attribute( 'echo=0' );
							echo '<h3 class="post_list_title"></h3><a href="' . esc_url( $url_link ) . '">' . $text_link . '</a></h3>';
						} else {
							the_title( sprintf( '<h3 class="post_list_title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
							echo '<div class="wrapper-meta">';
							echo '<div class="date-time">' . get_the_date() . '</div>';
							$post_list_cats = get_the_category_list( ', ' );
							if ( $post_list_cats ) {
								printf( '<div class="post_list_cats">%1$s</div>', $post_list_cats ); // WPCS: XSS OK.
							}
							echo '</div>';
						}


						if ( $length || $length != '0' ) {
							echo '<div class="post_list_item_excerpt">' . travelwp_excerpt( $length ) . '</div>';
						}
						?>
					</div>
				</div>
			</div>
			<?php
		}
		echo '</div>';
		echo '</div>';
	}
	// Reset Post Data
	wp_reset_postdata();
	$output = ob_get_clean();

	return $output;
}

?>
