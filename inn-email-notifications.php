<?php
/**
* Plugin Name: WordPress Email Notifications
* Description: Manage e-mails from the WordPress CMS to be send from code
* Plugin URI: https://github.com/Jebble/wp-email-notifications
* Author: Jeffrey von Grumbkow
* Author URI: https://www.jebble.nl
* Version: 0.3.1
* License: GPL2
* Text Domain: jb_wpen
*/

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'JB_WPEN_DIR', plugin_dir_path( __FILE__ ) );

// TGMPA class is used for "Required plugins" messages.
require_once( JB_WPEN_DIR . 'lib/tgmpa/class-tgm-plugin-activation.php' );
require_once( JB_WPEN_DIR . 'lib/tgmpa/required-plugins.php' ); // Copy pasted file from TGMPA, needs clean up.


require_once( JB_WPEN_DIR . 'lib/post-types.php' ); // Setup custom post types
require_once( JB_WPEN_DIR . 'lib/classes/jb_wpen.class.php' ); // Class that handles the setting and sending of the email.
if ( is_admin() ) {
	require_once( JB_WPEN_DIR . 'lib/admin.php' ); // Admin pages, plugin settings
	require_once( JB_WPEN_DIR . 'lib/meta-box.php' ); // Meta boxes with metabox.io
}