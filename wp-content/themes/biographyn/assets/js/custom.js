jQuery(document).ready(function($) {

    /*------------------------------------------------
                DECLARATIONS
    ------------------------------------------------*/
    
        var loader                  = $('#loader');
        var loader_container        = $('#preloader');
        var scroll                  = $(window).scrollTop();  
        var scrollup                = $('.backtotop');
        var dropdown_toggle         = $('.main-navigation button.dropdown-toggle');
        var primary_menu_toggle     = $('#masthead .menu-toggle');
        var secondary_menu_toggle   = $('#top-navigation .menu-toggle');
        var nav_menu                = $('#masthead ul.nav-menu');
        var secondary_menu          = $('#top-navigation ul.nav-menu');
    
    /*------------------------------------------------
                PRELOADER
    ------------------------------------------------*/
    
        loader_container.delay(1000).fadeOut();
        loader.delay(1000).fadeOut("slow");
    
    /*------------------------------------------------
                BACK TO TOP
    ------------------------------------------------*/
    
        $(window).scroll(function() {
            if ($(this).scrollTop() > 1) {
                scrollup.css({bottom:"25px"});
            } 
            else {
                scrollup.css({bottom:"-100px"});
            }
        });
    
        scrollup.click(function() {
            $('html, body').animate({scrollTop: '0px'}, 800);
            return false;
        });
    
    /*------------------------------------------------
                NAVIGATION
    ------------------------------------------------*/
    
        primary_menu_toggle.click(function(){
            nav_menu.slideToggle();
            $(this).toggleClass('active');
            $('#masthead .main-navigation').toggleClass('menu-open');
            $('.menu-overlay').toggleClass('active');
           
        });
    
        secondary_menu_toggle.click(function(){
            secondary_menu.slideToggle();
            $(this).toggleClass('active');
            $('#top-navigation .main-navigation').toggleClass('menu-open');
            $('.menu-overlay').toggleClass('active');
        });
    
        dropdown_toggle.click(function() {
            $(this).toggleClass('active');
           $(this).parent().find('.sub-menu').first().slideToggle();
        });
    
        $(window).scroll(function() {
            if ($(this).scrollTop() > 1) {
                $('.menu-sticky #masthead').addClass('nav-shrink');
            }
            else {
                $('.menu-sticky #masthead').removeClass('nav-shrink');
            }
        });
    
        
        $('.tabs li.search-menu .search-wrapper').click(function(event) {
            event.preventDefault();
            $(this).toggleClass('search-active');
            $('.tabs #search').fadeToggle();
            $('.tabs .search-field').focus();
        });
    
    
    /*------------------------------------------------
                SLICK SLIDER
    ------------------------------------------------*/

    $('.testimonial-slider').slick();
      
    /*--------------------------------------------------------------
     Keyboard Navigation
    ----------------------------------------------------------------*/
    if( $(window).width() < 1024 ) {
        $('#primary-menu').find("li").last().bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#masthead').find('.menu-toggle').focus();
            }
        });
    
        $('#secondary-menu').find("li").last().bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#top-navigation').find('.menu-toggle').focus();
            }
        });
    
        $('#primary-menu > li:last-child button:not(.active)').bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#masthead').find('.menu-toggle').focus();
            }
        });
    
        $('#secondary-menu > li:last-child button:not(.active)').bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#top-navigation').find('.menu-toggle').focus();
            }
        });
    
        $('#search').find("button").unbind('keydown');
    
    }
    else {
        $('#primary-menu').find("li").unbind('keydown');
        $('#secondary-menu').find("li").unbind('keydown');
    
        $('#search').find("button").bind( 'keydown', function(e) {
            var tabKey              = e.keyCode === 9;
            var shiftKey            = e.shiftKey;
    
            if( tabKey ) {
                e.preventDefault();
                $('#search').hide();
                $('.search-menu > a').removeClass('search-active').focus();
            }
    
            if( shiftKey && tabKey ) {
                e.preventDefault();
                $('#search').show();
                $('.main-navigation .search-field').focus();
                $('.search-menu > a').addClass('search-active');
            }
        });
    
        $('.search-menu > a').on('keydown', function (e) {
            var tabKey              = e.keyCode === 9;
            var shiftKey            = e.shiftKey;
            
            if( $('.search-menu > a').hasClass('search-active') ) {
                if ( shiftKey && tabKey ) {
                    e.preventDefault();
                    $('#search').hide();
                    $('.search-menu > a').removeClass('search-active').focus();
                }
            }
        });
    }
    
    $(window).resize(function() {
        if( $(window).width() < 1024 ) {
            $('#primary-menu').find("li").last().bind( 'keydown', function(e) {
                if( e.which === 9 ) {
                    e.preventDefault();
                    $('#masthead').find('.menu-toggle').focus();
                }
            });
    
            $('#secondary-menu').find("li").last().bind( 'keydown', function(e) {
                if( e.which === 9 ) {
                    e.preventDefault();
                    $('#top-navigation').find('.menu-toggle').focus();
                }
            });
    
            $('#primary-menu > li:last-child button:not(.active)').bind( 'keydown', function(e) {
                if( e.which === 9 ) {
                    e.preventDefault();
                    $('#masthead').find('.menu-toggle').focus();
                }
            });
    
            $('#secondary-menu > li:last-child button:not(.active)').bind( 'keydown', function(e) {
                if( e.which === 9 ) {
                    e.preventDefault();
                    $('#top-navigation').find('.menu-toggle').focus();
                }
            });
    
            $('#search').find("button").unbind('keydown');
    
        }
        else {
            $('#primary-menu').find("li").unbind('keydown');
            $('#secondary-menu').find("li").unbind('keydown');
    
            $('#search').find("button").bind( 'keydown', function(e) {
                var tabKey              = e.keyCode === 9;
                var shiftKey            = e.shiftKey;
    
                if( tabKey ) {
                    e.preventDefault();
                    $('#search').hide();
                    $('.search-menu > a').removeClass('search-active').focus();
                }
    
                if( shiftKey && tabKey ) {
                    e.preventDefault();
                    $('#search').show();
                    $('.main-navigation .search-field').focus();
                    $('.search-menu > a').addClass('search-active');
                }
            });
    
            $('.search-menu > a').on('keydown', function (e) {
                var tabKey              = e.keyCode === 9;
                var shiftKey            = e.shiftKey;
                
                if( $('.search-menu > a').hasClass('search-active') ) {
                    if ( shiftKey && tabKey ) {
                        e.preventDefault();
                        $('#search').hide();
                        $('.search-menu > a').removeClass('search-active').focus();
                    }
                }
            });
        }
    });
    
    primary_menu_toggle.on('keydown', function (e) {
        var tabKey    = e.keyCode === 9;
        var shiftKey  = e.shiftKey;
    
        if( primary_menu_toggle.hasClass('active') ) {
            if ( shiftKey && tabKey ) {
                e.preventDefault();
                nav_menu.slideUp();
                $('.main-navigation').removeClass('menu-open');
                $('.menu-overlay').removeClass('active');
                primary_menu_toggle.removeClass('active');
            };
        }
    });
    
    secondary_menu_toggle.on('keydown', function (e) {
        var tabKey    = e.keyCode === 9;
        var shiftKey  = e.shiftKey;
    
        if( secondary_menu_toggle.hasClass('active') ) {
            if ( shiftKey && tabKey ) {
                e.preventDefault();
                secondary_menu.slideUp();
                $('.main-navigation').removeClass('menu-open');
                $('.menu-overlay').removeClass('active');
                secondary_menu_toggle.removeClass('active');
            };
        }
    });
    
    /*------------------------------------------------
                    END JQUERY
    ------------------------------------------------*/
    
    });