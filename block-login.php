<?php
/*
Plugin Name: Block Login 
Description: A plugin to restrict user roles from logging in
Version: 1.0.1
Author: Zagaz
Author URI: https://github.com/Zagaz
plugin URI: https://github.com/Zagaz/wordpress-block-login
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: user-role-restriction
*/

function user_role_restriction_add_settings_page( ) {
    add_options_page( 'Block Login', 
    'Block Login',
     'manage_options', 
     'user-role-restriction', 
     'user_role_restriction_settings_page' );
}

add_action( 'admin_menu', 'user_role_restriction_add_settings_page' );


// make a page setings on the main menu with a locker as icon

function user_role_restriction_register_settings() {
    register_setting( 'user-role-restriction', 
    'user_role_restriction' );
}
add_action( 'admin_init', 'user_role_restriction_register_settings' );

function user_role_restriction_settings_page() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    // Create default option
    if ( !get_option( 'user_role_restriction' ) ) {
        $default = array(
            'redirection_url' => '',
        );
        add_option( 'user_role_restriction', $default );
    }


    $all_roles = get_editable_roles();
    $restricted_roles = get_option( 'user_role_restriction' );
    ?>
    <div class="wrap">
        <h1>Block Login</h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'user-role-restriction' ); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Restricted User Roles</th>
                    <td>
                        <?php foreach ( $all_roles as $role_key => $role ) : ?>
                            <?php if ( $role_key !== 'administrator' ) : ?>
                                <label>
                                    <input type="checkbox" name="user_role_restriction[<?php echo esc_attr( $role_key ); ?>]" value="1" <?php checked( isset( $restricted_roles[$role_key] ), true ); ?> />
                                    <?php echo esc_html( $role['name'] ); ?>
                                </label><br>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Redirection URL</th>
                    <td>
                        <input type="text" name="user_role_restriction[redirection_url]" value="<?php echo esc_url( $restricted_roles['redirection_url'] ); ?>" placeholder="e.g: google.com" /> <br>
                        <small>Leave blank to redirect to the Home Page</small>
                    </td>
                </tr>
                <tr>
                <td>
                        
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function block_login_login_redirect(  ) {
// get current user
$user = wp_get_current_user();
// get user role
$user_role = $user->roles[0];
if ( !get_option( 'user_role_restriction' ) ) {
    $default = array(
        'redirection_url' => '',
    );
    add_option( 'user_role_restriction', $default );
}
$option = get_option( 'user_role_restriction' );
$redirectOption = $option['redirection_url'];
$redirect = (string) $redirectOption;

// Sanitization
$redirect = str_replace('http://', '', $redirect);
$redirect = str_replace('https://', '', $redirect);
$redirect = str_replace('www.', '', $redirect);


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

