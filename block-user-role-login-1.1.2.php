<?php

/*
Plugin Name: Block User Role Login
Description: A plugin to restrict user roles from logging in
Version: 1.1.2
Author: Altudo
Author URI: https://github.com/Zagaz
plugin URI: https://github.com/Zagaz/wordpress-block-login
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: block-user-role-login
Domain Path: /languages

*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define ( 'PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define ( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define ( 'PLUGIN_NAME', 'Block User Role Login' );
define ( 'PLUGIN_SLUG', 'block-user-role-login' );
define ( 'PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define ( 'PLUGIN_VERSION', '1.1.2' );

include PLUGIN_DIR . 'inc/load-text-domain.php';
include PLUGIN_DIR . 'inc/settings/settings.php';
include PLUGIN_DIR . 'inc/settings/settings-menu.php';
include PLUGIN_DIR . 'inc/plugin-main-function.php';












