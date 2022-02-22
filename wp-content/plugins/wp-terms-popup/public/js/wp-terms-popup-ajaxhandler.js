jQuery(document).ready( function($) {
    var wptp_popup_id = jQuery('#wptp-popup-id').val();
    var wptp_cookie = 'wptp_terms_' + wptp_popup_id;

    if (wptp_popup_id != undefined && wptp_read_cookie(wptp_cookie) != 'accepted') {
        // Temporarily Hide Form
        jQuery('#wptp-form').css('display', 'none');

        // Load Popup CSS
        jQuery.ajax({
            type: 'POST',
            url: wptp_ajax_object.ajaxurl,
            data: {

                action: 'wptp_ajaxhandler_css',
                termspageid: wptp_popup_id,
                wptp_nonce: wptp_ajax_object.ajax_nonce,

            }, 
            dataType: 'json',

            success: function(data, textStatus, XMLHttpRequest) {
                jQuery('#wptp-css').html('');
                jQuery('#wptp-css').append(data.css);
            },

            error: function(MLHttpRequest, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });

        // Load Popup Title and Content
        jQuery.ajax({
            type: 'POST',
            url: wptp_ajax_object.ajaxurl,
            data: {
                action: 'wptp_ajaxhandler_popup',
                termspageid: wptp_popup_id,
                wptp_nonce: wptp_ajax_object.ajax_nonce,
            }, 
            dataType: 'json',

            success: function(data, textStatus, XMLHttpRequest) {
                jQuery('.termspopupcontainer').css('background-image', 'none');

                jQuery('#wptp-form').css('display', 'block');

                jQuery('#wptp-container .termstitle').html('');
                jQuery('#wptp-container .termstitle').append(data.title);

                jQuery('#wptp-container #wp-terms-popup-content').html('');
                jQuery('#wptp-container #wp-terms-popup-content').append(data.content);
            },

            error: function(MLHttpRequest, textStatus, errorThrown) {
                jQuery('#wptp-form').css('display', 'block');
                console.log(errorThrown);
            }
        });
    }
    
    function wptp_read_cookie(cookie_name) {
        var nameEQ = cookie_name + "=";
        var ca = document.cookie.split(';');

        for (var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }

        return null;
    }
});