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
    // if get_option( 'user_role_restriction' ) not exist create it
    if ( ! get_option( 'user_role_restriction' ) ) {
        
        // set default value
        
        // get all user roles and store in a variable
        
        $all_roles = get_editable_roles();
        // for each user role set default value
        foreach ( $all_roles as $key => $value ) {
            $option[$key] = false;
        }
        // Dele from option array if item == administrator
        unset( $option['administrator'] );
        
        $option['redirection_url'] = '';
        add_option( 'user_role_restriction' );
        update_option( 'user_role_restriction', $option );

    
    }
   
   
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
    
    add_action( 'admin_init', 'block_login_login_redirect', 10, 2 );
    
    