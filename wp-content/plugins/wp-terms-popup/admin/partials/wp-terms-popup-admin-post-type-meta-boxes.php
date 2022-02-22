<?php
/**
 * HTML for post type meta boxes.
 *
 * @link       https://linksoftwarellc.com
 * @since      2.0.0
 *
 * @package    Wp_Terms_Popup
 * @subpackage Wp_Terms_Popup/admin/partials
 */
?>
<?php wp_nonce_field('post-type-meta-boxes', 'terms_popupmeta_nonce'); ?>
<table class="wptp-meta-box">
    <tbody>
        <tr>
            <td><?php _e('Agree Button Text', $this->plugin_name); ?></td>
            <td><input type="text" name="terms_agreetxt" size="20" value="<?php echo $meta_terms_agreetxt; ?>"></td>
        </tr>
        
        <tr>
            <td><?php _e('Decline Button Text', $this->plugin_name); ?></td>
            <td><input type="text" name="terms_disagreetxt" size="20" value="<?php echo $meta_termsopt_terms_disagreetxt; ?>"></td>
        </tr>
        
        <tr class="has-help">
            <td><?php _e('Decline URL Redirect', $this->plugin_name); ?></td>
            <td>
                <input type="text" name="terms_redirecturl" size="45" value="<?php echo $meta_termsopt_redirecturl; ?>"><br>
                <small><?php _e('This URL is the website users will be sent to if they click the Decline button.', $this->plugin_name); ?></small>
            </td>
        </tr>
    </tbody>
</table>