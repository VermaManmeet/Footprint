<?php
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( has_nav_menu( 'primary' ) ) {
	wp_nav_menu( array(
		'theme_location' => 'primary',
		'container'      => false,
		'menu_class'     => 'nav navbar-nav menu-main-menu side-nav',
		'menu_id'        => 'mobile-demo',
	) );
} else {
	wp_nav_menu( array(
		'theme_location' => '',
		'container'      => false,
	) );
}
?>
