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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wp_user' );

/** Database password */
define( 'DB_PASSWORD', 'password' );

/** Database hostname */
define( 'DB_HOST', 'mariadb' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'iA5?}48dopl+MPe^y9_485gKK?+n({35Vr|oQc?nY7&`sT]yB6O4UT%_fr*p.l_O' );
define( 'SECURE_AUTH_KEY',   'O~N7V]yn7-MY%wvAXXN/E/Ba$)`FN]~dV0kte dFM4FI7PF$B!tkJyp{|M`p,<QP' );
define( 'LOGGED_IN_KEY',     '[.~vm9mECkK@+cwUqd$7 c)78Cabl,M{:ziT!9PC^#mXUvu!Lf0;piZDBkWK8K[k' );
define( 'NONCE_KEY',         '=A>M3Ni=7a`PM7J,)s(cmqS>NUQ;+UUxhR/3ftFW[tCi0@l6n11eN-EXKbDt@}iV' );
define( 'AUTH_SALT',         '0X)Dxt/ZTB#rz+;7Ijcb3oG&|!x(2?s $MH(ylf@1c#h.Gys~6Z<y1YoeY`~VY/t' );
define( 'SECURE_AUTH_SALT',  'dH2J@}EWr88p/kJz+Vzq|*#^+!=uGNlNz*@/wY0&1[9?K`0KX8A;wY5b|)D<)O]0' );
define( 'LOGGED_IN_SALT',    '{VusQW1ap)t9iHWUU;^C^@NnlQ=?ofz-5hHgs{)PO-b~wN~etlERm@2LTlZ,6_ 1' );
define( 'NONCE_SALT',        '/UZUS,ftQFd%5mn99>ij6I3Uw,Dpq<cue%rps o-ER7 n(!N[VX+<p-~VCgM)&$x' );
define( 'WP_CACHE_KEY_SALT', '9r$oDg::$.@fJHd Do(,J` N))OvrL|_S9BbSS~EV_M+:Y2|h&EvAOWXB=KpgEUJ' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
