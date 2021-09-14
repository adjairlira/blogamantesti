<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'blogamantesti' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'm=Za)$?!y33SjrzAT6,Be>R66vL80qb)hE <: C^OuU1f0;Eq%oVc_5n+y=FzQj[' );
define( 'SECURE_AUTH_KEY',  ')-6-m4@Ip&F2u]E4*2Gni,,Bs`3;UI#IoeB!.&X8V&~wB7Uu;!->7vRA*5,zP#/M' );
define( 'LOGGED_IN_KEY',    'y:cqV2%H>{LJGfKk^h *|NryTC@1RoaR:SklWu%<UWA8T_bXZ0RiZd3J?OFC?/Lv' );
define( 'NONCE_KEY',        'w~o52AAy*iXM4O)r?3CiX8%j|]|{]NLXo56&QjH3r=95ucI%5/7C/oz<&S]*H;K3' );
define( 'AUTH_SALT',        'yy%4wi{?K=}Ku(!.dW$!Lx&D:AHMe>! %;0x/.;-Dj$MVJW8L!LyXVN,M~B&s4Ck' );
define( 'SECURE_AUTH_SALT', 'EG8RH%N~~b~.<U9[ sh4s^AKGuq,=n8yH^x/ZHaOWsDQ#{NuR6iouD4qbkwnsvz3' );
define( 'LOGGED_IN_SALT',   'En1@o`|f9sNI/|0^a|Zp={,1iLj>Pielv[4uGd7w*XE*Sak^>i!DLj[ 24w&N 3>' );
define( 'NONCE_SALT',       ')mr1N*I(6_NWy5SGoV9}:G0y2oo6ssk>gNR<0Nd&7`KZi2Jx,Vt0(i{Y5(,dL[~!' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
