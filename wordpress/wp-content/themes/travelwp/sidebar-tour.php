<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package travelWP
 */

if ( !is_active_sidebar( 'sidebar-tour-phys' ) ) {
	return;
}
?>
<div class="widget-area align-left col-sm-3">
	<?php dynamic_sidebar( 'sidebar-tour-phys' ); ?>
</div><!-- #secondary -->