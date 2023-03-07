<?php 

function block_user_role_login_add_menu_page() {
    add_menu_page( 'Block User Role Login', 
                   'Block User Role Login',
                   'manage_options', 
                   'block-user-role-login', 
                   'block_user_role_login_settings_page', 
                   'dashicons-lock' ,
                );
}

add_action( 'admin_menu', 'block_user_role_login_add_menu_page' );

function block_user_role_login_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=block-user-role-login">Settings</a>';
    array_push( $links, $settings_link );
    return $links;
}

$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'block_user_role_login_settings_link' );