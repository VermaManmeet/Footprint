<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package travelWP
 */
?>
</div><!-- #content -->

<div class="wrapper-footer<?php if ( travelwp_get_option( 'show_newsletter' ) == '1' ) {
	echo ' wrapper-footer-newsletter';
} ?>">
	<?php if ( is_active_sidebar( 'footer' ) ) : ?>
		<div class="main-top-footer">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div class="container wrapper-copyright">
		<div class="row">
			<div class="col-sm-6">
				<?php
				if ( travelwp_get_option( 'copyright_text' ) ) {
					echo '<div>' . travelwp_get_option( 'copyright_text' ) . '</div>';
				} else {
					echo '<div><p>' . esc_html__( 'Copyright &copy; 2023 Travel WP. All Rights Reserved.', 'travelwp' ) . '</p></div>';
				}
				?>
			</div> <!-- col-sm-3 -->
			<?php if ( is_active_sidebar( 'copyright' ) ) : ?>
				<div class="col-sm-6">
					<?php dynamic_sidebar( 'copyright' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

</div>
<?php
if ( travelwp_get_option( 'show_newsletter' ) == '1' ) {
	$travelwp_theme_options = travelwp_get_data_themeoptions();
	$bg_image               = $travelwp_theme_options['bg_newsletter'] ['url'] ? ' style="background-image: url(' . $travelwp_theme_options['bg_newsletter'] ['url'] . ')"' : '';
	$title                  = travelwp_get_option( 'before_newsletter' ) ? '<div class="title_subtitle">' . travelwp_get_option( 'before_newsletter' ) . '</div>' : '';
	$title                  .= travelwp_get_option( 'title_newsletter' ) ? '<h3 class="title_primary">' . travelwp_get_option( 'title_newsletter' ) . '</h3>' : '';
	$form                   = travelwp_get_option( 'shortcode_newsletter' ) ? do_shortcode( travelwp_get_option( 'shortcode_newsletter' ) ) : '';
	echo '<div class="wrapper-subscribe"' . $bg_image . '>
			<div class="subscribe_shadow"></div>
			<div class="form-subscribe parallax-section stick-to-bottom form-subscribe-full-width">
				<div class="shortcode_title text-white shortcode-title-style_1 margin-bottom-3x">
				' . $title . '
				<span class="line_after_title"></span>
				</div>
				<div class="form-subscribe-form-wrap">
					<aside class="mailchimp-container">' . $form . ' </aside>
				</div>
			</div>
		</div>
 	';
}
?>
</div>
<?php wp_footer();
?>
</body>
</html>