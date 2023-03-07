<?php
$restricted_roles = get_option( 'block_user_role_login' );

?>
<div class="wrap">
        <h1><?php _e( "Block User Role Login" , "block-user-role-login" )  ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'block-user-role-login' ); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"> <?php _e("Restricted User Roles" , "block-user-role-login"); ?> </th>
                    <td>
                        <?php foreach ( $all_roles as $role_key => $role ) : ?>
                            <?php if ( $role_key !== 'administrator' ) : ?>
                                <label>
                                    <input type="checkbox" name="block_user_role_login[<?php echo esc_attr( $role_key ); ?>]" value="1" <?php
                                     // checked( isset( $restricted_roles[$role_key] ), true);
                                     //checked( isset( $restricted_roles[$role_key] ), true);
                                     echo isset( $restricted_roles[$role_key] ) ? 'checked' : '';
                                    
                                    ?> />
                                    <?php echo esc_html( $role['name'] ); ?>
                                </label><br>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <!-- Insert more info --->
                        <small><?php _e('Select the user role(s) that you want to restrict from login.', 'block-user-role-login'); ?></small>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?php _e( "Redirection URL" , "block-user-role-login"  ) ?>
                        
                    </th>
                    <td>
                        <input type="text" name="block_user_role_login[redirection_url]" value="<?php echo esc_url( $restricted_roles['redirection_url'] ); ?>" placeholder="e.g: google.com" /> <br>
                        <small><?php _e('Leave it blank to redirect to the Home Page', 'block-user-role-login'); ?></small>
                      
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