<?php 

// load text domain
if ( ! defined( 'WPINC' ) ) {
    die;
}

function user_role_restriction_load_textdomain() {
    load_plugin_textdomain( 'user-role-restriction', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}

add_action( 'plugins_loaded', 'user_role_restriction_load_textdomain' );

// If this file is called directly, abort.
