<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package travelWP
 */

get_header();

do_action( 'travelwp_wrapper_banner_heading' );

do_action( 'travelwp_wrapper_loop_start' );

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/content', 'single' );

	the_post_navigation();

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.

do_action( 'travelwp_wrapper_loop_end' );

get_footer();
?>
