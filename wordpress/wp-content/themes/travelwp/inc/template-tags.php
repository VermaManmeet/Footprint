<?php
if (!function_exists('travel_the_posts_navigation')) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 */
	function travel_the_posts_navigation() {
		// Don't print empty markup if there's only one page.
		if ($GLOBALS['wp_query']->max_num_pages < 2) {
			return;
		}
		$paged        = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
		$pagenum_link = html_entity_decode(get_pagenum_link());

		$query_args = array();
		$url_parts  = explode('?', $pagenum_link);

		if (isset($url_parts[1])) {
			wp_parse_str($url_parts[1], $query_args);
		}

		$pagenum_link = esc_url(remove_query_arg(array_keys($query_args), $pagenum_link));
		$pagenum_link = trailingslashit($pagenum_link) . '%_%';

		$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

		// Set up paginated links.
		@$links = paginate_links(array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $GLOBALS['wp_query']->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 1,
			'add_args'  => array_map('urlencode', $query_args),
			'prev_text' => '<i class="fa fa-long-arrow-left"></i>',
			'next_text' => '<i class="fa fa-long-arrow-right"></i>',
			'type'      => 'list'
		));
		if ($links) :
?>
			<div class="navigation paging-navigation" role="navigation">
				<?php echo ent2ncr($links); ?>
			</div>
		<?php
		endif;
	}
endif;

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package travelWP
 */

if (!function_exists('travelwp_posted_on')) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function travelwp_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date('c')),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date('c')),
			esc_html(get_the_modified_date())
		);

		$posted_on = sprintf(
			esc_html_x('Posted on %s', 'post date', 'travelwp'),
			'<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			esc_html_x('by %s', 'post author', 'travelwp'),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if (!function_exists('travelwp_posted_on_index')) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function travelwp_posted_on_index() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date('c')),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date('c')),
			esc_html(get_the_modified_date())
		);

		$posted_on = sprintf(
			esc_html_x('Posted on %s', 'post date', 'travelwp'),
			'<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			esc_html_x('by %s', 'post author', 'travelwp'),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if (!function_exists('travelwp_entry_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments. 
	 */
	function travelwp_entry_footer() {
		// Hide category and tag text for pages.
		if ('post' === get_post_type()) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(', ');
			if ($categories_list && travelwp_categorized_blog()) {
				printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'travelwp') . '</span>', $categories_list); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', ', ');
			if ($tags_list) {
				printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'travelwp') . '</span>', $tags_list); // WPCS: XSS OK.
			}
		}

		if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
			echo '<span class="comments-link">';
			/* translators: %s: post title */
			comments_popup_link(sprintf(wp_kses(__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'travelwp'), array('span' => array('class' => array()))), get_the_title()));
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__('Edit %s', 'travelwp'),
				the_title('<span class="screen-reader-text">"', '"</span>', false)
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */

if (!function_exists('travelwp_categorized_blog')) :
	function travelwp_categorized_blog() {
		if (false === ($all_the_cool_cats = get_transient('travelwp_categories'))) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			));

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count($all_the_cool_cats);

			set_transient('travelwp_categories', $all_the_cool_cats);
		}

		if ($all_the_cool_cats > 1) {
			// This blog has more than 1 category so travelwp_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so travelwp_categorized_blog should return false.
			return false;
		}
	}
endif;

/**
 * Flush out the transients used in travelwp_categorized_blog.
 */
function travelwp_category_transient_flusher() {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient('travelwp_categories');
}

add_action('edit_category', 'travelwp_category_transient_flusher');
add_action('save_post', 'travelwp_category_transient_flusher');

add_action('wp_ajax_travel_sc_blog', 'travel_sc_blog_callback');
add_action('wp_ajax_nopriv_travel_sc_blog', 'travel_sc_blog_callback');
function travel_sc_blog_callback() {
	$json = array(
		'success' => false,
		//'data' => $_POST,
	);
	$params    = htmlspecialchars_decode($_POST['params']);
	$params    = json_decode(str_replace('\\', '', $params), true);
	$default_args = array(
		'post_type'           => 'post',
		'posts_per_page'      => 4,
		'order'               => 'desc',
		'ignore_sticky_posts' => true,
	);
	if (isset($_POST['page'])) {
		$params['paged']     = $_POST['page'];
	}
	$args = wp_parse_args($params, $default_args);

	$query_vars = new WP_Query($params);

	ob_start();
	if ($query_vars->have_posts()) {
		while ($query_vars->have_posts()) {
			$query_vars->the_post();
			$class_item  = 'thim-ekits-post__article';
		?>
			<div <?php echo post_class(array($class_item)) ?>>
				<?php
				if (isset($_POST['templateid']) && !empty($_POST['templateid'])) {
					\Thim_EL_Kit\Utilities\Elementor::instance()->render_loop_item_content($_POST['templateid']);
				} else {
					get_template_part('template-parts/content');
				}
				?>
			</div>
<?php
		}
	}
	wp_reset_postdata();
	$html = ob_get_contents();
	ob_end_clean();
	wp_reset_postdata();
	$json['page'] = $params['paged'];
	$json['success'] = true;
	$json['data'] = $_POST;
	$json['content'] = $html;
	wp_send_json($json);
	wp_die();
}