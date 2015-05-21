<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'universal-beta');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'cEK9e.jQ2zCb!N+j(.+(Rz^[m@v6el26y7QI~cW`|/js[@>!MV[R%M|$(Z+)2E3@');
define('SECURE_AUTH_KEY',  'wOF+w|b#kn#+wA(iJ*Cw6( RFb`e4KwKdR8@|=*-j9Si4X`zLQj/:eNq1rnN+ja<');
define('LOGGED_IN_KEY',    'T7@J}}{I+S@_6O8+1|6`LF!;c?VV;-A;p*bP#f-h0m@4Dj(+rY>:uuJI}uav3-@B');
define('NONCE_KEY',        'iey~`!yI+lretX[z`/$Q;s9(j$@K8!k6HQ4ED+a|A.Rz0G:QOqP&[yH_dQv9=gsM');
define('AUTH_SALT',        'ee|Ul%-jJ|e0_>^8 ]M01@pu|~O.;O3JH5GQ7b/pso}.$O>=^l||GY3+kk.|^?e`');
define('SECURE_AUTH_SALT', 'ADwprX^OLIFV@6q-8zonntOr a[[7/VZOtwBsRJ+)ZW$ae&)z_N:^$o(A@VS+Ph0');
define('LOGGED_IN_SALT',   'O3)TZte-phae.:{!rAp])7<[bB/nPhOn-w[AOvnKIx}],?;HQw J~D#)E+VKUA%x');
define('NONCE_SALT',       'Ids$=^OKf-=x=]TD*8LnU<cZ7twp&2zA!R5;)UXC~j6K V!B>@kqzLJ c.Ko MY0');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
