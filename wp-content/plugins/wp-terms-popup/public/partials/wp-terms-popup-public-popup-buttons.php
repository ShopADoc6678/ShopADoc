<?php
/**
 * HTML for popup buttons.
 *
 * @link       https://linksoftwarellc.com
 * @since      2.0.0
 *
 * @package    Wp_Terms_Popup
 * @subpackage Wp_Terms_Popup/public/partials
 */
?>

<?php
    // Find Agree Button Text
    if ((get_post_meta($termspageid, 'terms_agreetxt', true)) != '') {
        $tagree = get_post_meta($termspageid, 'terms_agreetxt', true);
    } elseif (get_option('termsopt_agreetxt') != '') {
        $tagree = get_option('termsopt_agreetxt');
    } else {
        $tagree = __('I Agree', $this->plugin_name);
    }

    // Find Decline Button Text
    if ((get_post_meta($termspageid, 'terms_disagreetxt', true)) != '') {
        $tdisagree = get_post_meta($termspageid, 'terms_disagreetxt', true);
    } elseif (get_option('termsopt_disagreetxt') != '') {
        $tdisagree = get_option('termsopt_disagreetxt');
    } else {
        $tdisagree = __('I Do Not Agree', $this->plugin_name);
    }

    // Find Decline URL Redirect
    if ((get_post_meta($termspageid, 'terms_redirecturl', true)) != '') {
        $termsRedirectUrl = get_post_meta($termspageid, 'terms_redirecturl', true);
    } elseif (get_option('termsopt_redirecturl') && get_option('termsopt_redirecturl') != '') {
        $termsRedirectUrl = get_option('termsopt_redirecturl');
    } else {
        $termsRedirectUrl = 'https://www.google.com/';
    }
?>
                <form id="wptp-form" method="post">
                    <input type="hidden" id="wptp-popup-id" name="wptp_popup_id" value="<?php echo $termspageid; ?>" />
                    
                    <div class="tthebutton">
                        <input class="termsagree" name="wptp_agree" type="submit" value="<?php echo $tagree; ?>" />
                        <input class="termsdecline" type="button" onclick="window.location.replace('<?php echo $termsRedirectUrl ?>')" value="<?php echo $tdisagree; ?>" />
                    </div>
                </form>
