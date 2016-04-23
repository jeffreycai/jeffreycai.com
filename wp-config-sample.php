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
define('DB_NAME', 'jeffreycai.com');

/** MySQL database username */
define('DB_USER', 'jeffreycai.com');

/** MySQL database password */
define('DB_PASSWORD', 'BdV2PP43VxfCUxcN');

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
define('AUTH_KEY',         '?e+[JpMJyG??a}=!oczhvE0h)iU?fcXClm[Gb4!l|HDw=7-3ESwBVIo2Z[0ny+q~');
define('SECURE_AUTH_KEY',  'L%[BnLcGf>+cdzwGkLSg:YM%zW86Rvc @5{H8~8Ii&D]wMO-$ r*wm(HZ*yrIu2p');
define('LOGGED_IN_KEY',    '{mDM6mQd&K0%3P9,h&#[5dyZINcD 7!QBR4!4tQZ~f9 7.v-(^?S`p/h/M]rx5Pb');
define('NONCE_KEY',        'QrFhW_ueQc jppDdxv$I_O{V{)fD+=(=mS<Ay-]t1Ba1J;-fcJ(jQ)9aakOR&f=z');
define('AUTH_SALT',        'nJ:$U)M&IlNk ^H7%6!|>T#u^dr+jfyP98D7fnZY^z%ndfHhe{r}apeC{n{&WTe7');
define('SECURE_AUTH_SALT', 'ztWWd@}O+>PeNiEB|>*@o]KWHUXl,OL%fL[6*dn|+irFd--+-W_#iyN5xz*rfwY=');
define('LOGGED_IN_SALT',   'w.T% t0-R#`O/>Ar-?Z); I~({]2-AX=_]y%M-9WGM!|T]In-w %rh`F6Fk]X_#)');
define('NONCE_SALT',       'p>+vs+5|Jwp0;yJk^lfl|eh|6t&~E$MY+ <55<O<fi/*J;)BiqiiP4uv~[Vv$}UN');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

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
