<?php
/**
 * travelWP functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/ 
 *
 * @package travelWP
 */

// Constants: Folder directories/uri's
define( 'TRAVELWP_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'TRAVELWP_THEME_URI', trailingslashit( get_template_directory_uri() ) );
define( 'TRAVELWP_THEME_VERSION', '2.0.9' );

/**
 * Theme Includes
 */

require_once TRAVELWP_THEME_DIR . '/inc/init.php';
//
if ( ( class_exists( 'PC' ) ) ) {
	deactivate_plugins( 'physc-vc-addon/physc-vc-addon.php' ); 
}
