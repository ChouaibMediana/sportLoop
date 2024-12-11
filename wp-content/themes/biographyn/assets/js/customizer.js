/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

 ( function( $ ) {


	const biographyn_section_lists = { 
		
		hero_banner : 'biographyn_header_content_section',
		about_us : 'biographyn_about_section',
		services : 'biographyn_our_services',
		testimonial : 'biographyn_testimonial_section',
		connect : 'biographyn_connect_section',

	};

	Object.keys(biographyn_section_lists).forEach( biographyn_homepage_scroll_preview );

    function biographyn_homepage_scroll_preview(item, index) {
    	// Collect information from customize-controls.js about which panels are opening.
		wp.customize.bind( 'preview-ready', function() {
			
			// Initially hide the theme option placeholders on load.
			$( '.panel-placeholder' ).hide();
			wp.customize.preview.bind( item, function( data ) {
				// Only on the front page.
				if ( ! $( 'body' ).hasClass( 'home' ) ) {
					return;
				}

				// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
				if ( true === data.expanded ) {
					var scroll = $('#'+ biographyn_section_lists[item]);
					if(scroll.length){
						$('html, body').animate({
							'scrollTop' : scroll.position().top
						});
					}
				} 
			});

		});
 	}

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
			}
		} );
	} );

	// Header title color.
	wp.customize( 'biographyn_theme_options[header_title_color]', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Header tagline color.
	wp.customize( 'biographyn_theme_options[header_tagline_color]', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Color scheme.
	wp.customize( 'biographyn_theme_options[colorscheme]', function( value ) {
		value.bind( function( to ) {

			// Update color body class.
			$( 'body' )
				.removeClass( 'colors-light colors-dark colors-custom' )
				.addClass( 'colors-' + to );
		});
	});

	// Custom color hue.
	wp.customize( 'biographyn_theme_options[colorscheme_hue]', function( value ) {
		value.bind( function( to ) {

			// Update custom color CSS
			var style = $( '#custom-theme-colors' ),
			    color = style.data( 'color' ),
			    css = style.html();
			css = css.split( color ).join( to );
			style.html( css )
			     .data( 'color', to );
		} );
	} );

	//custom field real time refresh
	
	wp.customize( 'biographyn_theme_options[topbar_bg_color]', function( value ) {
		value.bind( function( to ) {
			$( '#top-navigation' ).css( 'background-color', to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[topbar_social_icon_color]', function( value ) {
		value.bind( function( to ) {
			$( '#top-navigation .social-icons li a svg' ).css( 'fill', to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[topbar_menu_item_color]', function( value ) {
		value.bind( function( to ) {
			$( '#top-navigation .main-navigation ul.nav-menu > li > a, #top-navigation .main-navigation ul.nav-menu > li.current-menu-item > a' ).css( 'color', to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[topbar_seperator_color]', function( value ) {
		value.bind( function( to ) {
			$( '#top-navigation' ).css( 'border-bottom', '1px solid' + to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[menu_bg_color]', function( value ) {
		value.bind( function( to ) {
			$( '#masthead' ).css( 'background-color', to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[menu_item_color]', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation ul#primary-menu li.current-menu-item > a, .main-navigation ul.nav-menu > li > a' ).css( 'color', to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[gallery_section_bg_color]', function( value ) {
		value.bind( function( to ) {
			$( '#blogendar_gallery_slider_section' ).css( 'background-color', to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[footer_bg_color]', function( value ) {
		value.bind( function( to ) {
			$( '#colophon' ).css( 'background-color', to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[footer_social_icon_color]', function( value ) {
		value.bind( function( to ) {
			$( '#colophon .social-icons li a svg' ).css( 'fill', to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[footer_widgets_hr_color]', function( value ) {
		value.bind( function( to ) {
			$( '#colophon .footer-logo-wrapper' ).css( 'border-bottom', '1px solid' + to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[footer_widgets_title_color]', function( value ) {
		value.bind( function( to ) {
			$( '#colophon .widget-title' ).css( 'color', to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[footer_widgets_content_color]', function( value ) {
		value.bind( function( to ) {
			$( '#colophon a, #colophon p, #colophon li' ).css( 'color', to );
		} );
	} );

	wp.customize( 'biographyn_theme_options[footer_hr_color]', function( value ) {
		value.bind( function( to ) {
			$( '#colophon .site-info' ).css( 'border-top', '1px solid' + to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[copyright_text_color]', function( value ) {
		value.bind( function( to ) {
			$( '#colophon .site-info span' ).css( 'color', to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[back_to_top_color]', function( value ) {
		value.bind( function( to ) {
			$( '.backtotop' ).css( 'background-color', to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[banner_image_overlay_color]', function( value ) {
		value.bind( function( to ) {
			$( '#page-site-header .overlay' ).css( 'background-color', to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[banner_bg_color]', function( value ) {
		value.bind( function( to ) {
			$( '#page-site-header' ).css( 'background-color', to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[breadcrumb_title_color]', function( value ) {
		value.bind( function( to ) {
			$( '#page-site-header .page-title, #breadcrumb-list .trail-items li' ).css( 'color', to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[breadcrumb_path_color]', function( value ) {
		value.bind( function( to ) {
			$( '#breadcrumb-list .trail-items li a' ).css( 'color', to );
		} );
	} );
	
	wp.customize( 'biographyn_theme_options[breadcrumb_alignment]', function( value ) {
		value.bind( function( to ) {
			$( '#page-site-header .wrapper' ).css( 'text-align', to );
		} );
	} );

} )( jQuery );
