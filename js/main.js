/**
 * Javascript file for introducing some dynamic content into file.
 ***/
 jQuery(document).ready(function() {
    initializeAll();
 });

function initializeAll(args) {
    jQuery('#pWordCount').on('click', function() {
        jQuery('#errorMessagewordCount').css('display','none');
    });
}