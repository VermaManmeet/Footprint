<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package travelWP
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
	<?php if ( travelwp_get_option( 'opt-ace-editor-js' ) ) {
		echo travelwp_get_option( 'opt-ace-editor-js' );
	} ?>
</head>

<body <?php body_class(); ?>>
<?php if ( travelwp_get_option( 'show_preload' ) == '1' ) { ?>
	<div id="preload">
		<div class="preload-inner"></div>
	</div>
<?php } ?>
<?php
$class_header = travelwp_get_option( 'sticky_menu' ) == '1' ? ' sticky_header' : '';
$class_header .= travelwp_get_option( 'sticky_custom_menu' ) == '1' ? ' sticky_custom_menu' : '';
$boxed = travelwp_get_option( 'box_layout' ) == 'boxed' ? ' boxed-area' : '';
?>
<div class="wrapper-container<?php echo esc_attr( $boxed ); ?>">
	<header id="masthead" class="site-header affix-top <?php echo esc_attr( $class_header ) ?>">
		<?php if ( travelwp_get_option( 'top_bar' ) == '1' ) {
			get_template_part( 'inc/topbar' );
		} ?>
		<div class="navigation-menu">
			<div class="container">
				<?php
				if ( !class_exists( 'APMM_Class' ) ) {
					echo '<div class="menu-mobile-effect navbar-toggle button-collapse" data-activates="mobile-demo">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</div>';
				}
				?>
				<div class="width-logo sm-logo">
					<?php
					echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home">';
					if ( travelwp_get_option( 'transparent_menu_home' ) == '1' ) {
						if ( is_front_page() ) {
							do_action( 'travelwp_logo_home_page' );
						} else {
							do_action( 'travelwp_logo' );
						}
					} else {
						do_action( 'travelwp_logo' );
					}
					do_action( 'travelwp_sticky_logo' );
					echo '</a>';
					?>
				</div>
				<nav class="width-navigation">
					<?php get_template_part( 'inc/header/main-menu' ); ?>
				</nav>
			</div>
		</div>
	</header>
	<div class="site wrapper-content">