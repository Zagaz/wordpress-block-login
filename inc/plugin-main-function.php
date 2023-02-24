<?php 
if ( ! defined( 'WPINC' ) ) {
    die;
}

// This is the main function of the plugin that will be called when the plugin is activated


function block_login_login_redirect(  ) {
    // get current user
    $user = wp_get_current_user();
    // get user role
    $user_role = $user->roles[0];
    $option = get_option( 'user_role_restriction' );
    $redirectOption = $option['redirection_url'];
    $redirect = (string)$redirectOption;
    
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
    
    add_action( 'admin_init', 'block_login_login_redirect', 10, 2 );
    
    