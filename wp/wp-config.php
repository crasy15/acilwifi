<?php
define( 'WP_CACHE', true );
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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'acilcolc_wp295' );

/** Database username */
define( 'DB_USER', 'acilcolc_wp295' );

/** Database password */
define( 'DB_PASSWORD', 'L.5-X@T70z4S[wp)' );

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
define( 'AUTH_KEY',         'o8ndzfuun23fyldyljnt9prfvvgzrlh0klrx6edjiiezvdol54bffaohe0oncjup' );
define( 'SECURE_AUTH_KEY',  'opwgzqkfi6c82gb9hqzqasy7clsmjbhbb8lopst1fbkpt0honbwg26v0l9smyvb2' );
define( 'LOGGED_IN_KEY',    'ket1bwc7rwnvourecb1b5wbgwjjnyo97egnddnxc3mrqbq8fq87gkwrgpivfacsf' );
define( 'NONCE_KEY',        'yim0smi4tnbu0egoqav1ko4xvjzuvyw5htylyejlr3uicoaepau2exjlsol8uamj' );
define( 'AUTH_SALT',        'qf1me4ec32gpn0gdodsxye802kuuuvcmzb31kjeeqvuxth8w0ub6itypw3takj0r' );
define( 'SECURE_AUTH_SALT', 'ulzcw6tuen6uykfdqwtny8vz2ujkdre7mjldnpbbd8uylrovfy4d4rkw2v9qjo4g' );
define( 'LOGGED_IN_SALT',   'g4ljawtu1qahsl3vkinsleknt5wja5r4dedohsifva9qsqzvpebgozevyviufndl' );
define( 'NONCE_SALT',       'n6tctgtrh8yfswiy8pxq1u6mtapcvwugregfkmkfdsngi1q8rcbflnl10vvavken' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpeu_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
