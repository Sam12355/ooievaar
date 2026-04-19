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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          ' I3M|k0 Miu(op{I_ gE~=0^h{$oz/m8f-<xvVeNq2lnrac_7qXsP1IO~g5V5MIG' );
define( 'SECURE_AUTH_KEY',   '0D#RP-W]}{{h&h%C<VZ$u]*}N0(1|]5}BML$|`tBk}xXzRw/F$O}Cvk`/#[8}R`N' );
define( 'LOGGED_IN_KEY',     'n>,o]s;9I@,rxm0A>LWx|lj!^O*-i{gX)hw8?aJ_/}&CkP(~e/X:sWTU!GT{,HJ,' );
define( 'NONCE_KEY',         'Jzwdw%_LOIuduI[o{0kxe=jZLq-q5%@w!1A[r+;Ir0&V#Mv6f/Do>&S}k;+.`f@1' );
define( 'AUTH_SALT',         ')XnE9`]v>C%<1OP`std=)xpu:J-m#6x?+C2~+#1NKt/@[T{{E({eb[OZpF^sK4w~' );
define( 'SECURE_AUTH_SALT',  '@XTN_-_>!z7r)8B5h&i4<*=Lhmi{j7weZmGZ9Q%qrt?2I$Qm`|oq96(?c(B6ve~%' );
define( 'LOGGED_IN_SALT',    'm77v79DaYyWEqE3.t.$3LVG|}~dKgX8g+8wKdv?eI)0mAs2c j5dX!B?h7R`jW>8' );
define( 'NONCE_SALT',        'qAMGBL[)21AstEzMW^m@(aQ#_J5<0r-aVI^|7v@LIlI=ZimYC(94D_iPRc!=Sk=O' );
define( 'WP_CACHE_KEY_SALT', 'Jx+lFbV5^mVrDE@E!q/pCT`1yP>-4>2>F$^{6&f#^E^GT*0w|]O^o@f[%b9xM4oG' );


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
	define( 'WP_DEBUG', true );
	define( 'WP_DEBUG_LOG', true );
	define( 'WP_DEBUG_DISPLAY', true );
	@ini_set( 'display_errors', 1 );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
