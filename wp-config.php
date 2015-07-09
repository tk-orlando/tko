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
define('DB_NAME', 'tkodb');

/** MySQL database username */
define('DB_USER', 'tkodb');

/** MySQL database password */
define('DB_PASSWORD', 'PSn)3[8N65');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         'qtup8tmlxoizy5fqgrtivi9gz18ccohx7lneshuatntkrlzmtyhwtytnsawb7suc');
define('SECURE_AUTH_KEY',  'nlhqgmgz8o6orc9ujnpjdseqnezdlfkipeh5dcmlsrypjcf76kvwpae4ysicbnxb');
define('LOGGED_IN_KEY',    'feb6560jjobh0yc6xy0zgsztpbfsr7bbcsxmfexils5hnlcs5bbhvizuhtfkl0kw');
define('NONCE_KEY',        '2ejo1bw9uaqwafffaq0vxgmquoso4t8inchxfhc6auqbc0xcmbzmq3kkh29uraay');
define('AUTH_SALT',        'tr4igpp8jpjzygmj0zyi5ua7znzxnxogvagb9u18mzu1qmx9z8lwjtqshnxvsl6f');
define('SECURE_AUTH_SALT', 'fsxcytudcyz7rx8fpdfb16evraeln2hcxmlwak6ioypsy8u4yjf5ts5ambrecupb');
define('LOGGED_IN_SALT',   'gk7nvicmnibkqkjjttoknwahpe80yt4bfwi2ytfhodt9ky4zb4derpqosmqvgjoz');
define('NONCE_SALT',       'ekgqlpb7vfiahvesyw989gtfy7oozdfl66cd9vpccunnbvbdhvteh6ddvc4cp8jx');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mag_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
