<?php 

// Add settings link on plugin page =========================
function block_user_role_login_add_settings_page( ) {
    add_options_page( 'Block User Role Login', 
    'Block User Role Login',
     'manage_options', 
     'block-user-role-login', 
     'block_user_role_login_settings_page' );
}

add_action( 'admin_menu', 'block_user_role_login_add_settings_page' );


// Register settings =======================================

function block_user_role_login_register_settings() {
    register_setting( 'block-user-role-login', 
    'block_user_role_login' );
}

add_action( 'admin_init', 'block_user_role_login_register_settings' );

// Settings page ===========================================

function block_user_role_login_settings_page() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    // Create default option
    // make an associative array of all roles where every role is set to false
    $all_roles = get_editable_roles();
    $default = array();
    foreach ( $all_roles as $role_key => $role ) {
        $default[$role_key] = false;
    }
    // add the redirection url to the array
    $default['redirection_url'] = '';

    // if $default item == "administrator" then delete it
    if ( isset( $default['administrator'] ) ) {
        unset( $default['administrator'] );
    }


    if ( false == get_option( 'block_user_role_login' ) ) {

        add_option( 'block_user_role_login', $default );
    }


    // Settings form
    include PLUGIN_DIR . 'inc/settings/settings-form.php';

}

// After submit the form, place a message sucess

function block_user_role_login_settings_page_message() {
    if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ) {
        add_settings_error( 'block-user-role-login', 'block-user-role-login', __( 'Settings Saved', 'block-user-role-login' ), 'updated' );
    }
    settings_errors( 'block-user-role-login' );
}
add_action( 'admin_notices', 'block_user_role_login_settings_page_message' );