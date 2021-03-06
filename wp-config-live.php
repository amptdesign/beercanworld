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
define('DB_NAME', 'i2252648_wp1');

/** MySQL database username */
define('DB_USER', 'i2252648_wp1');

/** MySQL database password */
define('DB_PASSWORD', 'O~EfQzROggzw[(SWPR.95~.1');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_HOME','http://www.beercanworld.com');
define('WP_SITEURL','http://www.beercanworld.com');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '2KBWdnqTquLDTprXZjovYZFiXRU6LjJGJffrmqs6Vccv2D1qldzXuqxSTbXTs5xA');
define('SECURE_AUTH_KEY',  'M20lewugCPEmYwhX6iBcNHZZJuxTImHngSK1QCylrtSmcLorK0LpmscNondmQMob');
define('LOGGED_IN_KEY',    'MoicVihszsb3cQQqw6QsbI3gbp1Ba9qm4zYzoB4zrxVBAuPsefSLmgTRWmYcU5Vl');
define('NONCE_KEY',        'ca2BFLyVR7P5Czsc0o7zi31WcDW4HHJNjDucowfKM67uF8tFQlxYYQq7gxLTnFqw');
define('AUTH_SALT',        'frqjxAAejMVGV6lWB6SddxyeCNFkh6WBqxsWNNUGX9SgvjMSqDiVeyaYwin86hdl');
define('SECURE_AUTH_SALT', 'A7JQoUVf25GPs2QQcM007gKu2N5UDuROnr3GlmAOGysWJpK4xqFX0IweCZQONhVp');
define('LOGGED_IN_SALT',   'aPDtOsfvGvCWx4AkLfI71GBW33OkAd4kUyw7V8wpuheLJMWmEg0sukMKbyrOe0EK');
define('NONCE_SALT',       'TnsPfPhZa7pRtAelrKbcNXCMJR42cviAlBlTMN5qc5LFZSCmwu1gCzs7CIR8L0ql');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


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
