/**
 * Emphaino Scripts
 *
 * @package Emphaino
 * @since Emphaino 1.0
 */

jQuery(window).load(function(){
    jQuery('#footer-widgets, #the-sidebar').masonry({
    	itemSelector: '.widget',
    	gutterWidth: 20,
    	isAnimated: true
    });

    jQuery('#dynamic-grid').masonry({
	    itemSelector: '.hentry',
    	isAnimated: true
    });

 });

jQuery().ready(function( jQuery ) {
    jQuery(".wp-caption").width(function() {
        return jQuery('img', this).width();
    });
    jQuery(".gallery-caption").width(function() {
        galleryIcon = jQuery(this).prev('.gallery-icon');
        return jQuery('img', galleryIcon).width();
    });
});

jQuery(document).ready(function(){
    jQuery(".entry-content").fitVids();

    jQuery(window).scroll(function() {
        if( jQuery(this).scrollTop() > 200 ) {
            jQuery('.back-to-top').fadeIn(200);
        }
        else {
            jQuery('.back-to-top').fadeOut(200);
        }
    });

    jQuery('.back-to-top').click(function() {
        event.preventDefault();
        jQuery('body').animate({scrollTop: 0}, 300);
    });

});

/* PINEDROP modifications */
jQuery(document).ready(function(){
    /* prepend 'Select languages..' header to home page dropdown */
    jQuery('header[data-active-language="none"] select').prepend('<option id="select-language-option">- Select language -</option>');

    jQuery('header[data-active-language]').each(function(){
        var active_language = jQuery(this).attr('data-active-language');
        jQuery('#oflanguage option:selected').prop('selected', false);
        jQuery('#oflanguage option').filter(function(){
          return jQuery(this).text() == active_language;
        }).prop('selected', true);
    });

    /* select 'Audio' radio button on home page to prevent showing all resource types for all languages */
    jQuery('header[data-active-language="none"] input[value="ava"]').prop('checked', true);

    if (window.location.href.indexOf("?post_types=") > 0) {
      jQuery('header[data-active-language] input[value="ava"]').prop('checked', true); 
    }

    /* remove 'All languages' option from individual language pages */
    jQuery('header[data-active-language!="none"][data-active-language!="all"] select > option:first-child').remove();

    /* move 'All' post types to end of list */
    var $ul = jQuery('header[data-active-language!="none"][data-active-language!="all"] .searchandfilter > div > ul > li:nth-child(2) ul');
    $ul.children(':first').appendTo($ul);
});
