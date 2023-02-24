<?php 

// Add settings link on plugin page =========================
function user_role_restriction_add_settings_page( ) {
    add_options_page( 'Block Login', 
    'Block Login',
     'manage_options', 
     'user-role-restriction', 
     'user_role_restriction_settings_page' );
}

add_action( 'admin_menu', 'user_role_restriction_add_settings_page' );


// Register settings =======================================

function user_role_restriction_register_settings() {
    register_setting( 'user-role-restriction', 
    'user_role_restriction' );
}

add_action( 'admin_init', 'user_role_restriction_register_settings' );

// Settings page ===========================================

function user_role_restriction_settings_page() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    // Create default option
    if ( false == get_option( 'user_role_restriction' ) ) {
        $default = array(
            'redirection_url' => '',
        );
        add_option( 'user_role_restriction', $default );
    }

    $all_roles = get_editable_roles();
    $restricted_roles = get_option( 'user_role_restriction' );
    // Settings form
    include PLUGIN_DIR . 'inc/settings/settings-form.php';

}

// After submit the form, place a message sucess

function user_role_restriction_settings_page_message() {
    if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ) {
        add_settings_error( 'user-role-restriction', 'user-role-restriction', __( 'Settings Saved', 'user-role-restriction' ), 'updated' );
    }
    settings_errors( 'user-role-restriction' );
}
add_action( 'admin_notices', 'user_role_restriction_settings_page_message' );