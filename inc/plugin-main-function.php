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
    // if get_option( 'block_user_role_login' ) not exist create it
    if ( ! get_option( 'block_user_role_login' ) ) {
        
        $all_roles = get_editable_roles();
        // for each user role set default value
        foreach ( $all_roles as $key => $value ) {
            $option[$key] = "0";
        }
        // Dele from option array if item == administrator
        unset( $option['administrator'] );
        
        $option['redirection_url'] = '';
        add_option( 'block_user_role_login' );
        update_option( 'block_user_role_login', $option );

    
    }
   
   
   $option = get_option( 'block_user_role_login' );


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
    
    