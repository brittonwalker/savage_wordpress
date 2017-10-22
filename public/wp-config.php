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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'scotchbox' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'C=Mf9[0]2zKGC_ BtCbLJL],4ANT[:jk~5[KG:(-.C@og[eI`k~_Wwqr3xJAUogJ' );
define( 'SECURE_AUTH_KEY',  'r.(?_GXJN:1T^Z%.L=tO)g,Go~B@CVUi~SNgXcyDLF_z5h&stB|^KuP+Y|E|z^jA' );
define( 'LOGGED_IN_KEY',    'D3sw7,DYM,T.~B0^Q^#CUpk+oCGO:%C`5sE;?@*-+zp&>A#%#@H&#>}8qz]VX;Ti' );
define( 'NONCE_KEY',        ':T}eO{[PR~gz2RU#2BAjE|w5@I?)HH3MJM}xByzdvn;aitPg.k%bYP[k)hWoBU};' );
define( 'AUTH_SALT',        '@u)zaP1a2 *JTw oVJ}+$=/A PghSi8mN?MPdLO5=h:bW30)wLNY7){y`Rq[e.W>' );
define( 'SECURE_AUTH_SALT', 'g1j~?*>pH!{[conW?7$m[Gb_Lr<L|q&SqGHy}|50<t^hh^4UFnFXK~s3y@6R{4tp' );
define( 'LOGGED_IN_SALT',   'WkCc_O*rSp,_Y3:,! eg$LkeM3=S-lXD`8X`BbqEJ_sy:A.e`B8?@u[yMQ8QRz:@' );
define( 'NONCE_SALT',       ',#hkse4]m!+!tTd>U9j; sg{KsHO~AIy-Yi$vN!,I7Vn}c0KYXz4s#:3cm?X_ena' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

define( 'WP_DEBUG', true );


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
