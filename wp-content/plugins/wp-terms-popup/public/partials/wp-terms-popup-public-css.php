<?php
/**
 * CSS for popup.
 *
 * @link       https://linksoftwarellc.com
 * @since      2.0.0
 *
 * @package    Wp_Terms_Popup
 * @subpackage Wp_Terms_Popup/public/partials
 */
?>

<?php
    if (get_option('termsopt_opac')) {
        if (get_option('termsopt_opac') != '10') {
            $termsopacmoz = '0.'.get_option('termsopt_opac');
            $termsopac = '.'.get_option('termsopt_opac').'0';
            $termsopacfilter = get_option('termsopt_opac').'0';
        } elseif (get_option('termsopt_opac') == '10') {
            $termsopacmoz = '1.0';
            $termsopac = '1.0';
            $termsopacfilter = '100';
        }
    } else {
        $termsopacmoz = '0.8';
        $termsopac = '.80';
        $termsopacfilter = '80';
    }
?>
<style type="text/css">
<?php if (! isset($isshortcode) || $isshortcode != 1) : ?>body { overflow: hidden; }<?php endif; ?>
.tbrightcontent { position: fixed; top: 15%; left: 25%; width: 50%; height: 60%; padding: 16px; background-color: white; z-index: 9999999; overflow: auto; text-align: left; font-size: 15px; }
@media only screen and (max-width:991px) { .tbrightcontent { top: 10%; left: 10%; width: 80%; height: 80%; } }
@media only screen and (max-width:767px) { .tbrightcontent { top: 5%; left: 5%; width: 90%; height: 90%; } }
.tdarkoverlay { position: fixed; top: 0%; left: 0%; width: 100%; height: 100%; background-color: black; z-index: 9999998; -moz-opacity: <?php echo $termsopacmoz; ?>; opacity: <?php echo $termsopac; ?>; filter: alpha(opacity=<?php echo $termsopacfilter; ?>); }
<?php if (get_option('termsopt_javascript') == 1) : ?>.termspopupcontainer { height: 100%; background-position: center center; background-repeat: no-repeat; background-image: url(<?php echo plugins_url('wp-terms-popup/public/img/loading.gif'); ?>); }<?php endif; ?>
h3.termstitle { background: #C81F2C; color: #fff; text-align: center; padding: 1%; margin: -16px -16px 30px -16px !important; font-size: 1.2em; text-transform: capitalize; }
</style>