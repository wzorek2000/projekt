<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'projekt' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'zaq1@WSX' );

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
define( 'AUTH_KEY',         's|.2?PQPdc@:j89gI 5kJyjR?f2Of`AHQL^IwG|sBohq4TCB(-Ejj)o,R{LU1a9,' );
define( 'SECURE_AUTH_KEY',  '@<ih`:&$pGau|t$QreK?B<wQC+|%-9{IRnqpvz1xh.rs_3ebLPETjt2UOQ+Ej=ko' );
define( 'LOGGED_IN_KEY',    'm`_F~fX*8uop~:d76^S)r*LSM%-KbNS4OK:GqQy2Zc9(G](NMza]pBVEy6HUW|Fi' );
define( 'NONCE_KEY',        '/k6m9r1/XC G>-e246q&@DJ!lU<h6zckHJZEY(kV?Eug(b+0mp92EPN^EZ9cVkI$' );
define( 'AUTH_SALT',        'NP/f}6JqmQOln;(f%Fcsnzp[Z4TM400T|G9tBmZ]*R-BACoH_=dlu%gN]qjFNyFG' );
define( 'SECURE_AUTH_SALT', 'xK*g vgR-/HYTai}f6QPN[g8WRD1Qmi=NFJf}/Gq4~8X=y.](n= fH.#4>)l4 ir' );
define( 'LOGGED_IN_SALT',   'B(Ss^+qa#V6*=/M/)n#TJ[VI0N1TqQkz6wM:)3hysT9 2,y{^}rfmL09AAd0EAph' );
define( 'NONCE_SALT',       'id#1m@Mr>xu[hy}FaieGiknz|Np|%!2v,1 9v<^iJ!=1?t,_Zu<`>S3l#rGi7Un_' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
