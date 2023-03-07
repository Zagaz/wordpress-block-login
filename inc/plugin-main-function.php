<?php 
if ( ! defined( 'WPINC' ) ) {
    die;
}

// This is the main function of the plugin that will be called when the plugin is activated


function block_user_role_login(  ) {
    // get current user
    $user = wp_get_current_user();
    // get user role
    $user_role = $user->roles[0];
    $option = get_option( 'user_role_restriction' );
    $redirectOption = $option['redirection_url'];
    $redirect = (string)$redirectOption;

    
    // sanitize $redirect
    $redirect = filter_var( $redirect, FILTER_SANITIZE_URL );
    $redirect = str_replace( 'http://', '', $redirect );
    $redirect = str_replace( 'https://', '', $redirect );
    $redirect = str_replace( 'www.', '', $redirect );
    
    
    if ($redirect == '') {
        $url = home_url();
    } else{
        $url = "http://" . $redirect;
    }
    
    if ( isset( $option[$user_role] ) ) {
        wp_logout(  );
        wp_redirect( $url );
        exit;
    }
    
    }
    
    add_action( 'admin_init', 'block_user_role_login', 10, 2 );
    
    