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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'movies_kovtsuniak');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'D#pzFuo*yjoHIQFsKWAdrI4mV(/QI.iGFH$3#0{>l]g$N>Q{D9r-J~qNQjjELSkx');
define('SECURE_AUTH_KEY',  'Fq18]{5>&SYQzl?bzRp0`k@i}X(%60Uxv)b|qoD~Wsf(.mZT8jWQ*__LrHTp80Vp');
define('LOGGED_IN_KEY',    '4sQfp{:~Yb;y3YB#t@P>]]G<h},|<sie.)gJ<b}!z>D#@#Ajeph|@HF}UX&pP})@');
define('NONCE_KEY',        'Jl2FXQt5SD.N,0=86(ers#2|~<47 XPy=}v7!L;gxk.9e)E&cLV^T;={_CC0M:.3');
define('AUTH_SALT',        'GUSr5tuO+8C$!sbsATV`?2b&Ar_IZ$+XF3.3)2qW{a:DM;ey:b#buUtc.L+dkKlU');
define('SECURE_AUTH_SALT', '/0[--&w}oKRr:&N[-#FUx-.?u;&`,f7;se`<bukv.gr84;^:[d!!?gFCLu9*`$D3');
define('LOGGED_IN_SALT',   '3[#Xkuvj-HD-Qy&c8Hx$6f?he&oSa=kG_yIT;)Y-i-~SVG@354;)uU1~KTPs&IXS');
define('NONCE_SALT',       'IjJfo]O>J^K%U 1zM7g$i,e 18)!@=ISe:>*Rff^mgWEsMF%k8@V_ =x2*VyCU,S');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
