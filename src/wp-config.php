<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'olabi');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'ETkT9!!rQol0_3As%U($vJz9qt!0lxMyB)|8~^X4bxR0o|#G1w$Btll%vB;NvCg/');
define('SECURE_AUTH_KEY',  '!I0zwxt~N%E!!_c#YWul9:;tz4T|e"_wNJf5^v~%P:HyZ*w~mGFrK6Y_V2f2FLDt');
define('LOGGED_IN_KEY',    'JM:AS#W/&bp|OrFhtW^?);~UUlT3?6(v%M:KOSs@Xa29pd^Ge@$o~Lzw2%6a@Z/*');
define('NONCE_KEY',        'n|kG39Xe5c_#K320oWDgstbYk9yQh2N|;9L5082d5Vq?OBA/HIXSm(71gs""F`)_');
define('AUTH_SALT',        'WBWqnx%b@zZT@?o_NVXCRO:Q^mXMTYh*5M88!d`m_(wZo?gMV109cOaM+/qvE*Gr');
define('SECURE_AUTH_SALT', 'GrPDFU:xU#S/z;@VE0*|SGQ!LHid!ojF)D*G)snw;g9cQ~J^Q!Szt7g!3+S;|+d4');
define('LOGGED_IN_SALT',   'GqQS~+Eh;O4Ypn/0Lt6SH89@ycB#A#n~8(kC7zW7xJyo~Jmag7H%&RV@"ZThfl78');
define('NONCE_SALT',       '%w|(_FLR)^b2TAwFPPaKmAWL+sVR+b4/T_jLddUva#3a%9:4#GIoL^kV9_nd72!#');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_qwr42p_';

/**
 * Limits total Post Revisions saved per Post/Page.
 * Change or comment this line out if you would like to increase or remove the limit.
 */
define('WP_POST_REVISIONS',  10);

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

define('EM_CONDITIONAL_RECURSIONS',3);	

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

