<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package travelWP
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_list_content_unit' ); ?>>
	<?php do_action( 'travelwp_entry_top', 'full' ); ?>
	<div class="post-list-content">
		<div class="post_list_inner_content_unit">
			<?php
			the_title( '<h1 class="post_list_title">', '</h1>' );
			echo '<div class="wrapper-meta">';
			echo '<div class="date-time">' . get_the_date() . '</div>';
			$post_list_cats = get_the_category_list( ', ' );
			if ( $post_list_cats ) {
				printf( '<div class="post_list_cats">%1$s</div>', $post_list_cats );
			}
			echo '</div>';
			echo '<div class="post_list_item_excerpt">';
			the_content();
			echo '</div>';
			?>
		</div>
	</div>
</article><!-- #post-## -->
