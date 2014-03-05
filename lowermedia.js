jQuery(document).ready(function() {
var wide = jQuery('#one-page-masthead').css('width');
var calculate = parseInt(wide, 10)* 0.5;
jQuery('#one-page-masthead').css('height', calculate);
});