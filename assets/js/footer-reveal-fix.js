jQuery.noConflict();
jQuery(document).ready(function () {
    jQuery(function () {
        var widths = jQuery('#container-wrapper').width();
        jQuery('.footer').footerReveal({width: widths});
    });

    var windowh = jQuery(window).width();
    if (windowh == '1263') {
        var wids = jQuery('#container-wrapper').width();
        jQuery(".footer").css("width", wids);
    } else if (windowh == '985') {
        var widths = jQuery('#container-wrapper').width();
        var fullwidth = (widths - 1);
        jQuery(".footer").css("width", fullwidth);
    } else {
        var wid = jQuery('#container-wrapper').width();
        jQuery(".footer").css("width", wid);
    }
});