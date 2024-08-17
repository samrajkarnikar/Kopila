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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'e-commerce' );

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
define( 'AUTH_KEY',         'J=~/3X;OG#_yltTv5./{oTC0h;pr>;W$}?1VjnKAxxo;-thH<@~,h=l5kpCxIB4R' );
define( 'SECURE_AUTH_KEY',  'tIbuOYWiEC0@7yF6bRFmHi7!Swi[>Z#/aVOr:m5F8`KW&P3TnN;X#qy=cn|g&O?(' );
define( 'LOGGED_IN_KEY',    '4Khfz6cSe_;^-F MB9V[Se=`bI1H;NHY~nHQq61Jv0*cS:#)#-<1_2B NTQp&V}:' );
define( 'NONCE_KEY',        'AI?)L/J18G-mYeI6S|1tcaj|LKg%*m3*<p*WeyALTQ+($p4v&h^}7l^N?|*JG|x(' );
define( 'AUTH_SALT',        'q`CFX~Z$0y=.yZr=$^8+bO<VfqA;8hsIexHdL>=_Q%Kp0r9A6^*=]0K3Qvb3b@^X' );
define( 'SECURE_AUTH_SALT', 's-L*[bMb,*xY|4vP_)n#zc!])A*Uv%z>&X~ShA-AG@e}U}`;@+ F(&FtY,%z+Ka_' );
define( 'LOGGED_IN_SALT',   '|Z YV.m1ZPH*9)xMnMC`E{@1A<K@.P@*D.?b?9`!~&Y8.Oh35v/Ux1^JTWMKO~zF' );
define( 'NONCE_SALT',       'gQ]&s*AAjYxXgY(olL<~z^W<{3vaXZ-B>6]p@8%??G)/A<>*+X#VTLu&KbYoG;UN' );

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
