(function( $ ) {
// NAVIGATION CALLBACK
var physique_ww = jQuery(window).width();
jQuery(document).ready(function() { 
jQuery(".sitenav li a").each(function() {
if (jQuery(this).next().length > 0) {
jQuery(this).addClass("parent");
};
})
jQuery(".toggleMenu").click(function(e) { 
e.preventDefault();
jQuery(this).toggleClass("active");
jQuery(".sitenav").slideToggle('fast');
});
physique_adjustMenu();
})

// navigation orientation resize callbak
jQuery(window).bind('resize orientationphysique', function() {
physique_ww = jQuery(window).width();
physique_adjustMenu();
});

var physique_adjustMenu = function() {
if (physique_ww < 1000) {
jQuery(".toggleMenu").css("display", "block");
if (!jQuery(".toggleMenu").hasClass("active")) {
jQuery(".sitenav").hide();
} else {
jQuery(".sitenav").show();
}
jQuery(".sitenav li").unbind('mouseenter mouseleave');
} else {
jQuery(".toggleMenu").css("display", "none");
jQuery(".sitenav").show();
jQuery(".sitenav li").removeClass("hover");
jQuery(".sitenav li a").unbind('click');
jQuery(".sitenav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
jQuery(this).toggleClass('hover');
});
}
}

jQuery(document).ready(function() {
if( jQuery( '#slider' ).length > 0 ){
jQuery('.nivoSlider').nivoSlider({
effect:'fade',
animSpeed: 500,
pauseTime: 3000,
startSlide: 0,
directionNav: true,
controlNav: true,
pauseOnHover:false,
});
}
});
})( jQuery );