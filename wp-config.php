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
define('DB_NAME', 'vlh_dev');

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
define('AUTH_KEY',         '&|;j}5PGLfE6`)=Y!fLw~[8x[JuKc6o j]uQsPW_bC*#tL&3a{LW9<Lo3V4!oHbR');
define('SECURE_AUTH_KEY',  'CyBtx4ddBvdLq#LdFftL3rGK|.]a_@F{zkI(X@:n=X.k6FZ*hc(*24ciu<nv&?1m');
define('LOGGED_IN_KEY',    'FNfJ-}.=`?FXK5PrlWK)t.+Lp.oBzYAPFm 92Xp|3c;!NH-Kje)2^ld45fzN;LMo');
define('NONCE_KEY',        'LEKB<C1:M313.:YRV=/(BsN>{QbwYR^gt}(6&@60N.eb16oqKzMW!M&}aR#VClj#');
define('AUTH_SALT',        '}rS[F+6*9^N8Y&Zqii*)yo_q_a Is !~$q7i/./V7qatbQ>(?/vPaFuP`i}aDgqn');
define('SECURE_AUTH_SALT', 'no07`$%U6lf3w%}Y@|[r~0)T.!:*31$Ue(/&UyfwGU>p}e/;K830@.?fHf%||Ad<');
define('LOGGED_IN_SALT',   '3]V`U%8dOZd}Y$w<;NzW`e,l6f6ydj7it{(y2CdABY;X],0*Ss:DI59aML$n$+WU');
define('NONCE_SALT',       '$(2nCr:uF6^a]]KfXLz3F{0F`r{P)iIb`BV>@UfQPM2Z!?p87,~ ]1~d%2I0pnhu');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'vlhDev_';

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
