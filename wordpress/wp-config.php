<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'LB&)fUX:{E2t;oIE>n)b#b;+1m?+i=uo|3.hkyTnpT%j9ymMFXM-FIYjb&6(_IV.' );
define( 'SECURE_AUTH_KEY',  '#PNqg<|ms^dpiV^eZx;U[Q}a@D ^%2Q(upL &3TY6~}do)Y+%m%M[J0=%-3oMKdG' );
define( 'LOGGED_IN_KEY',    '1Y {ut/ /4v8xm[BmY5xxrW1UMEB!mxiZFvrX-5w8&x<is~<KrI{SHG>IPU1<<fQ' );
define( 'NONCE_KEY',        '`s:i7j?OHg]A5ENa1|?ddCeIQ*izP[~tVUo+:SssToS121!<HYZXs0@T|HKJfTgd' );
define( 'AUTH_SALT',        '|6_c=DaoNED[{Xfv/[c3|j(eIF(fisvzJoM8E_UlP#LTp9A^V0ay^v>Mj):VeIQ{' );
define( 'SECURE_AUTH_SALT', 'bs.jK[~f5`LaM%9b+$<k3uZm2_E8;,aglrkZAdb;xnlV#AejOp.||&I#VHydT~ c' );
define( 'LOGGED_IN_SALT',   '|SjL2bd`VLA9uZ4>O/O4ne9^0~rDO)_~j+W.*z:dalSzgzxaN>1).V3MKPI[yS7|' );
define( 'NONCE_SALT',       '+T@T9]AiKD-ht~dtr@:fa=55Cco,=3>D;0<A|4[?HE>S@=}R-TtrYDvy|-#EEqMM' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
