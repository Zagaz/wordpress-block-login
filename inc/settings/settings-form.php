<?php
$restricted_roles = get_option( 'user_role_restriction' );

?>
<div class="wrap">
        <h1><?php _e( "Block Login" , "user-role-restriction" )  ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'user-role-restriction' ); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"> <?php _e("Restricted User Roles" , "user-role-restriction"); ?> </th>
                    <td>
                        <?php foreach ( $all_roles as $role_key => $role ) : ?>
                            <?php if ( $role_key !== 'administrator' ) : ?>
                                <label>
                                    <input type="checkbox" name="user_role_restriction[<?php echo esc_attr( $role_key ); ?>]" value="1" <?php checked( isset( $restricted_roles[$role_key] ), true ); ?> />
                                    <?php echo esc_html( $role['name'] ); ?>
                                </label><br>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <!-- Insert more info --->
                        <small><?php _e('Select the user role(s) that you want to restrict from login.', 'user-role-restriction'); ?></small>

                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?php _e( "Redirection URL" , "user-role-restriction"  ) ?>
                        
                    </th>
                    <td>
                        <input type="text" name="user_role_restriction[redirection_url]" value="<?php echo esc_url( $restricted_roles['redirection_url'] ); ?>" placeholder="e.g: google.com" /> <br>
                        <small><?php _e('Leave it blank to redirect to the Home Page', 'user-role-restriction'); ?></small>
                      
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