<?php 

// load text domain
if ( ! defined( 'WPINC' ) ) {
    die;
}

function block_user_role_login_load_textdomain() {
    load_plugin_textdomain( 'block-user-role-login', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}

add_action( 'plugins_loaded', 'block_user_role_login_load_textdomain' );

// If this file is called directly, abort.
