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
define( 'DB_NAME', 'caio' );

/** MySQL database username */
define( 'DB_USER', 'tyrone' );

/** MySQL database password */
define( 'DB_PASSWORD', 'password' );

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
define( 'AUTH_KEY',         '2%[]Kc)Qeo ~R4/@VbCFm9J;w7RH`^U,z$9m2jy9[C/oKdj&Az.QV<hA8kv*TNbb' );
define( 'SECURE_AUTH_KEY',  'i.}Y#Vw<diW3:]M>@al7O,A6(G#0H;)mYjkl0<@1[b0r/NRC-<p F(,/e$XV%|5&' );
define( 'LOGGED_IN_KEY',    '0 -Q9J8{tr,?_xzCRYAL$HXNyYC[2]xoJSOX7|$7!N4+>i-,uk}FfGEhTdx01?En' );
define( 'NONCE_KEY',        'F*$$Gh~n<pn &2w,X:#=xCR5)Z+CS<|-:OwIdx.{}Nap$(|:iH:C+#Q9:5R.4}s2' );
define( 'AUTH_SALT',        'SS@chv7O8FN+v+BxfPoK:.J6iLe}aGPEhb%FYAPdMO?>hw#nPqEgkv7R)Gc%|R5U' );
define( 'SECURE_AUTH_SALT', '%h3WXNAfgP8]S6TYyr+0Oni/IuGGc-Z*7Np 6OZ@c^6jk}Qw+xf))g%?(hem6eKa' );
define( 'LOGGED_IN_SALT',   'P@?)zK0eafbVgt/Sc~FxMsW2TQ$|=t{k8(KJePx=Fa7@8Z/e[Q>xpN[8-l`6L77g' );
define( 'NONCE_SALT',       '^tL&P/*mMbmzefu0b`%=a!9JThH`GP[j(M`m_=Mo1@Y2F`|fiF1W8bl^x.:GhiWN' );

define( 'FS_METHOD', 'direct' );

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

