<?php
/**
 * HTML for popup.
 *
 * @link       https://linksoftwarellc.com
 * @since      2.0.0
 *
 * @package    Wp_Terms_Popup
 * @subpackage Wp_Terms_Popup/public/partials
 */
?>

<?php if ($termspageid) : ?>
<div id="wptp-css"><?php echo(get_option('termsopt_javascript') <> 1 ? $this->popup_css() : ''); ?></div>
<div id="tfade" class="tdarkoverlay"></div>
<div id="tlight" class="tbrightcontent">
	<div id="wptp-container" class="termspopupcontainer">
        <h3 class="termstitle"><?php echo(get_option('termsopt_javascript') <> 1 ? $this->title($termspageid) : '&nbsp;'); ?></h3>
		<div class="termscontentwrapper">
            <div id="wp-terms-popup-content"><?php echo(get_option('termsopt_javascript') <> 1 ? $this->content($termspageid) : ''); ?></div>
            <div id="wp-terms-popup-after-content"><?php do_action('wptp_popup_after_content', $termspageid); ?></div>
        </div>
	</div>
</div>
<?php endif; ?>