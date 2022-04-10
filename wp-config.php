<?php

/**

 * The base configuration for WordPress

 *

 * The wp-config.php creation script uses this file during the installation.

 * You don't have to use the web site, you can copy this file to "wp-config.php"

 * and fill in the values.

 *

 * This file contains the following configurations:

 *

 * * Database settings

 * * Secret keys

 * * Database table prefix

 * * ABSPATH

 *

 * @link https://wordpress.org/support/article/editing-wp-config-php/

 *

 * @package WordPress

 */


// ** Database settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'bitnami_wordpress' );


/** Database username */

define( 'DB_USER', 'bn_wordpress' );


/** Database password */

define( 'DB_PASSWORD', '523ae6e131019758cd96d46515f09994b5e8d446b854a25c085bd3eec6d9d3db' );


/** Database hostname */

define( 'DB_HOST', 'localhost:3306' );


/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );


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

define( 'AUTH_KEY',         '2Y]n2mWFKS`B%pQ9(lqRW`-c6czC%Dsg#L2-Pc6qNC@L,N8U+vC;*9Y?cqun:f3-' );

define( 'SECURE_AUTH_KEY',  'OSr7Q{VPK&nP4xOfMW*=1?jGl::k:!V0;]nG$@8:/E9<~9EE#oFazX?75Wh_UsjJ' );

define( 'LOGGED_IN_KEY',    'EF~fp9WhAh^lL5REn<nw|0;?}n_b3pU6%2kN@WDI8qZr=TiB;Z^R`4T0F?7,x@t_' );

define( 'NONCE_KEY',        'fD64XFOhi g;*]g!X*XWT2`r7I)3uT!85EndJ?l^Z_X%}P)vOF^d[qY&BRA|Z^eT' );

define( 'AUTH_SALT',        'da-L$Q_C(k5Y1!1Nwq6;|s`uR!5P{Xe;5(AXMKJ)0fK<Epho4dEO!(E{311+@+{A' );

define( 'SECURE_AUTH_SALT', 'eWZU47Uu_}Y}b@&@7=`gn?0+@5L<^4sDI/c=pai0o_AzMLajK=9~ &T%C!BCMPA=' );

define( 'LOGGED_IN_SALT',   'B]$J5#W(?;e3Y3xY86]]5bKcw@,64khJPH!ot@zlcR$t2tkL!!}B}zYo.jv3&.)D' );

define( 'NONCE_SALT',       'p4CCTYZpL>s%o[Uv9tfVz rUONtMd /Ay5H8ni:;J_FFw1,pVvSe)US3C?=-gpjW' );


/**#@-*/


/**

 * WordPress database table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

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

 * @link https://wordpress.org/support/article/debugging-in-wordpress/

 */

define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
