<?php 

function user_role_restriction_add_menu_page() {
    add_menu_page( 'Block Login', 
                   'Block Login',
                   'manage_options', 
                   'user-role-restriction', 
                   'user_role_restriction_settings_page', 
                   'dashicons-lock' ,
                );
}

add_action( 'admin_menu', 'user_role_restriction_add_menu_page' );

function user_role_restriction_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=user-role-restriction">Settings</a>';
    array_push( $links, $settings_link );
    return $links;
}

$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'user_role_restriction_settings_link' );