<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'testing' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3307' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'reH&WR%P#GqJ|H@38N)~_y0I~,[oOwM%r!RSOA>Kh2<;tC]~#p:TK6>x{9+M?;w0' );
define( 'SECURE_AUTH_KEY',  '|zrWBs_r:,CAQ7]3;B;$CRAK1PfE/r1MKTE2>5NFVDF8eP4ILv=8o]]tg#vV,M*9' );
define( 'LOGGED_IN_KEY',    '(E^|$T!JH*>)!!BGu,?YN=+mn.GPAqM0BI]%`[3TtF4NXQ%VXv@FBvS}_1Vy.^q>' );
define( 'NONCE_KEY',        '&iGj8=k7?v._6z>7x3|yKB|AA|w4jq]u!PB8W%@m$I7MT8pF!;MFo4[Zx5EFe]*l' );
define( 'AUTH_SALT',        '+Fw~GJ>Fah/{?yD:Ni}b~pIIM.i^a6`#w~[+A|;N].]+y*V!F{{p6z85?^0YSuwt' );
define( 'SECURE_AUTH_SALT', 'R#%LAK*>XP^f!xnej=wmv0ggGw;Mt-  {B6e|1H {SQXmyBUl){fn(.3pRN0ynw@' );
define( 'LOGGED_IN_SALT',   'ER2r^B/|SaUS jngXYN6/u<-Z5DYF`LP:+m3%cPo%}#-lG8MqdbIJ-t?2;vBeXK{' );
define( 'NONCE_SALT',       '~3K7M:!;-#|78bmjU#F=rt}Gm~<w^(?4s2z^m8L:gm<a<UFY#E:,nNrE@W43,|U{' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
