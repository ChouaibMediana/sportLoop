<?php
/**
 * Customizer default options
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 * @return array An array of default values
 */

function biographyn_get_default_theme_options() {
	$theme_data = wp_get_theme();
	$biographyn_default_options = array(

		// Color Options
		'header_title_color'			    => '#fff',
		'header_tagline_color'			    => '#fff',
		'header_txt_logo_extra'			    => 'show-all',
		'colorscheme_hue'				    => '#d87b4d',
		'colorscheme'					    => 'default',
		'theme_version'						=> 'lite-version',
		'home_layout'						=> 'default-design',

		// typography Options
		'theme_typography' 				    => 'default',
		'body_theme_typography' 		    => 'default',
		
		// loader
		'loader_enable'         		    => (bool) false,
		'loader_icon'         			    => 'default',

		// breadcrumb
		'breadcrumb_enable'				    => (bool) true,
		'breadcrumb_separator'			    => '/',
				
		// homepage options
		'enable_frontpage_content' 			=> false,

		// layout 
		'site_layout'         			    => 'wide',
		'sidebar_position'         		    => 'right-sidebar',
		'post_sidebar_position' 		    => 'right-sidebar',
		'page_sidebar_position' 		    => 'right-sidebar',
		'menu_sticky'					    => (bool) false,
		'search_enable'					    => (bool) true,
		'topbar_enable'					    => (bool) true,

		// excerpt options
		'long_excerpt_length'               => 25,

		// pagination options
		'pagination_enable'         	    => (bool) true,
		'pagination_type'         		    => 'default',

		// footer options
		'copyright_text'           		    => esc_html__( 'Copyright © 2022 ', 'biographyn' ) . esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'biographyn' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_html( ucwords( $theme_data->get( 'Author' ) ) ) .'</a>',
		'scroll_top_visible'        	    => (bool) true,
		'footer_social_menu_enable'      	=> (bool) true,

		// reset options
		'reset_options'      			    => (bool) false,
		
		// homepage sections sortable
		'pro_sortable' 						=> 'hero_banner,about_us,services,testimonial,connect',

		'default_sortable' 			    	=> 'hero_banner,about_us,services,testimonial,connect',

		// blog/archive options
		'your_latest_posts_title' 		    => esc_html__( 'Blogs', 'biographyn' ),
		'archive_btn_txt' 		    		=> esc_html__( 'Read More', 'biographyn' ),
		'blog_column'						=> 'col-1',

		'banner_image_enable'				=> (bool) true,

		// single post theme options
		'single_post_hide_date' 		    => (bool) false,
		'single_post_hide_author'		    => (bool) false,
		'single_post_hide_category'		    => (bool) false,
		'single_post_hide_tags'			    => (bool) false,
		'single_post_hide_pagination'		=> (bool) false,
		'hide_category'			   			=> (bool) false,
		'hide_date'			   				=> (bool) false,

		/* Front Page */

		// top bar
		'social_menu_enable'					=> (bool) false,
		'cart_icon_enable'						=> (bool) false,
		
		// About
		'about_us_section_enable'			=> (bool) false,
		'about_us_excerpt_length'			=> 40,
		'about_us_content_type'			    => 'post',
		'about_us_title'					=> esc_html__( 'Welcome to World Best Business Company', 'biographyn' ),
		'about_us_sub_title'				=> esc_html__( 'About Us', 'biographyn' ),
		'about_us_btn_title'				=> esc_html__( 'Learn More', 'biographyn' ),
		'about_us_description'				=> esc_html__( 'Start-ups you might dive directly into the work. In less than a few hours you get the source files, a shared drive link, a few simple tasks and there you go — you will learn while working. Be ready to wait even for two or three weeks until you get to test, perform a study or move pixels. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'biographyn' ),

		// connect
		'connect_section_enable'			=> (bool) false,
		'connect_section_subtitle'          => esc_html__('Block our calendar via Google Meet','biographyn'),
		'connect_section_title'			    => esc_html__( 'Don\'t want to fill up a form', 'biographyn' ),
		'connect_btn_txt'			    	=> esc_html__( 'Connect Now', 'biographyn' ),

		// hero slider
		'hero_banner_section_enable'			=> (bool) false,
		'hero_banner_social_menu_enable'		=> (bool) true,
		'hero_banner_content_type'				=> 'post',
		'hero_banner_title'            	        => esc_html__('Bio Graphy','biographyn'),
		'hero_banner_content_title'            	=> esc_html__('Content','biographyn'),
		'hero_banner_btn_txt'            	    => esc_html__('Scroll Down','biographyn'),
		'hero_banner_dob'            	        => esc_html__('April 27, 1990','biographyn'),
		'hero_banner_dob_title'            	    => esc_html__('Date of Birth','biographyn'),
		'hero_banner_know_more_txt'             => esc_html__('Know More About Biographyn','biographyn'),
		'hero_banner_excerpt_length'		=> 40,
		
		//our service
		'services_section_enable'		    => (bool) false,
		'services_posts_count'			    => 3,
		'services_column'			 		=> 'col-3',
		'services_excerpt_length'			=> 10,
		'services_subtitle'					=> esc_html__( 'What we provide', 'biographyn' ),
		'services_title'					=> esc_html__( 'Our Working Process', 'biographyn' ),
		
		//testimonial
        'testimonial_section_enable'      	=> (bool) false,
		'testimonial_title'				  	=> esc_html__('What they  saying','biographyn'),
		'testimonial_subtitle'				  	=> esc_html__('Testimonials','biographyn'),
		'testimonial_btn_txt'				  	=> esc_html__('All Testimonials','biographyn'),
		'testimonial_content_type'        	=> 'post',
		'testimonial_posts_count'         	=> 5,

	);

	$output = apply_filters( 'biographyn_default_theme_options', $biographyn_default_options );

	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}