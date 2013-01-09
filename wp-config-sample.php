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

/**
 * Home & site URL.
 *
 * This will override the home/site URL settings
 * in the General Settings of wp-admin.
 */
define('WP_HOME', 'http://[shenanigans.local]');
define('WP_SITEURL', WP_HOME);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'owc2013');

/** MySQL database username */
define('DB_USER', 'owc');

/** MySQL database password */
define('DB_PASSWORD', 'owc');

/** MySQL hostname */
define('DB_HOST', '10.0.1.13');

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
define('AUTH_KEY',         'W<e3v}L,!+0PE+59!z=RxT,y(Mr=x`2eb9$gO6p*TlfK?NK-5Wwjh4drD&tNlYbU');
define('SECURE_AUTH_KEY',  'jL#_p>l|p|K+t$ +1>^-$x72II5+ISSPM!?Oll(~ZcU6~8Kadl;m<w9{1JH5 4P2');
define('LOGGED_IN_KEY',    'e.8|;vF*mQ B[!MZhpR,c0}I rTtf|Gm/C[}*Z8&)j%EdF3o3NvMF)YWh,|o1xYk');
define('NONCE_KEY',        '*]D6SxWWuE8]1Yc|+}Ud*^v8:Fzn9XC~DOg#5THp6a{-F::{&`[POMqwxHMC?C}w');
define('AUTH_SALT',        'z=Oie>.-,,+Bh3[j;?wxWUjXa~MjJpbrkY7e&^h?x:5!w;+xo3P)(!5CF.Tt:SFU');
define('SECURE_AUTH_SALT', '~kIID]:iwcw2+5{{8Jl)yI=%5!)+/dzBC=.J$sP+0i7@|b^abxs3F&L^{D18%~p-');
define('LOGGED_IN_SALT',   './d>lo3YtLbjAJk_jAViZAwD[2-[H0rotCDxlVkZ,~-8[4&+@{a% +nr-]=_7gR8');
define('NONCE_SALT',       ' ECz,-^tTC5^|a<4Hhf*FFt56z>r@5~3QY828&:,~!BLgcKOar^McBq-+Tzn0m8B');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'owc_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
