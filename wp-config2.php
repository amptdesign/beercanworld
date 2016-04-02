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
define('DB_NAME', 'amptpro_wp4');

/** MySQL database username */
define('DB_USER', 'amptpro_wp4');

/** MySQL database password */
define('DB_PASSWORD', 'U~2A(n*wczjYpRgUwX(85&@4');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_HOME','http://bill.amptdesign.com');
define('WP_SITEURL','http://bill.amptdesign.com');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'bi0okaZQ9PaWcbMLG4Mxf81fBesUdBXCNOUWaJcDzJ6OfYwJ0aqBRlBzDoGBsgaZ');
define('SECURE_AUTH_KEY',  'd8S7OXWzgIv5Rw2t7mNFWEBSG6mmZ7ZqO66HZeLgi1Cm4g00A7BQP8rNCFLZP4jZ');
define('LOGGED_IN_KEY',    'dwYVl63683L5egGVXySlmWPDeJmIxfaO2Pacpr3zWIR8hrMRnqFNRECyQzefbpp3');
define('NONCE_KEY',        'XfeHbv24DRUdB2dZpEg0v9Im14vVbQ4Hm6dCxKlg2AIzxiAujNBRpNBKVP8u0jRq');
define('AUTH_SALT',        '8J58bVnn6DGGf7V9xNxOFRS9IptN2fGoVGS02JGmEfhodxK2PbxJVWZGBZ4GePes');
define('SECURE_AUTH_SALT', 'PB6lCkSC6LY50xKxkgY4R14csVZVeHf7xrs19SJQp9qxCxyVVMzuHnMzoiyBudP4');
define('LOGGED_IN_SALT',   'XGsIvDYN9qaMuyB6Sf28La4hIlFciguxrdydsU9CHpTU7Zof7FJDrPY6dPxC8iVc');
define('NONCE_SALT',       'g5tccXvtWqwXZFxdSuG4Wu3dwGXLxWolBUMmpW7Wv2VTJ0gzGV0BOmgEcFXzDsf3');

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
