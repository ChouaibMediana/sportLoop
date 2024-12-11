<?php
/**
* Partial functions
*
* @package Theme Palace
* @subpackage  Biographyn
* @since  Biographyn 1.0.0
*/

// blog btn title
if ( ! function_exists( 'biographyn_copyright_text_partial' ) ) :
    function biographyn_copyright_text_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['copyright_text'] );
    }
endif;

// about_us_sub_title
if ( ! function_exists( 'biographyn_about_us_sub_title_partial' ) ) :
    function biographyn_about_us_sub_title_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['about_us_sub_title'] );
    }
endif;

// about_us_description
if ( ! function_exists( 'biographyn_about_us_description_partial' ) ) :
    function biographyn_about_us_description_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['about_us_description'] );
    }
endif;

// about_us_title
if ( ! function_exists( 'biographyn_about_us_title_partial' ) ) :
    function biographyn_about_us_title_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['about_us_title'] );
    }
endif;

// about_us_btn_title
if ( ! function_exists( 'biographyn_about_us_btn_title_partial' ) ) :
    function biographyn_about_us_btn_title_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['about_us_btn_title'] );
    }
endif;

// hero_banner_title
if ( ! function_exists( 'biographyn_hero_banner_title_partial' ) ) :
    function biographyn_hero_banner_title_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['hero_banner_title'] );
    }
endif;

// hero_banner_dob
if ( ! function_exists( 'biographyn_hero_banner_dob_partial' ) ) :
    function biographyn_hero_banner_dob_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['hero_banner_dob'] );
    }
endif;

// hero_banner_content_title
if ( ! function_exists( 'biographyn_hero_banner_content_title_partial' ) ) :
    function biographyn_hero_banner_content_title_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['hero_banner_content_title'] );
    }
endif;

// hero_banner_dob_title
if ( ! function_exists( 'biographyn_hero_banner_dob_title_partial' ) ) :
    function biographyn_hero_banner_dob_title_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['hero_banner_dob_title'] );
    }
endif;

// hero_banner_know_more_txt
if ( ! function_exists( 'biographyn_hero_banner_know_more_txt_partial' ) ) :
    function biographyn_hero_banner_know_more_txt_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['hero_banner_know_more_txt'] );
    }
endif;

// hero_banner_btn_txt
if ( ! function_exists( 'biographyn_hero_banner_btn_txt_partial' ) ) :
    function biographyn_hero_banner_btn_txt_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['hero_banner_btn_txt'] );
    }
endif;


// services_subtitle selective refresh
if ( ! function_exists( 'biographyn_services_subtitle_partial' ) ) :
    function biographyn_services_subtitle_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['services_subtitle'] );
    }
endif;

// services_title selective refresh
if ( ! function_exists( 'biographyn_services_title_partial' ) ) :
    function biographyn_services_title_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['services_title'] );
    }
endif;

// testimonial_subtitle selective refresh
if ( ! function_exists( 'biographyn_testimonial_subtitle_partial' ) ) :
    function biographyn_testimonial_subtitle_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['testimonial_subtitle'] );
    }
endif;

// testimonial_title selective refresh
if ( ! function_exists( 'biographyn_testimonial_title_partial' ) ) :
    function biographyn_testimonial_title_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['testimonial_title'] );
    }
endif;

// testimonial_btn_txt selective refresh
if ( ! function_exists( 'biographyn_testimonial_btn_txt_partial' ) ) :
    function biographyn_testimonial_btn_txt_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['testimonial_btn_txt'] );
    }
endif;

// connect_section_title selective refresh
if ( ! function_exists( 'biographyn_connect_section_title_partial' ) ) :
    function biographyn_connect_section_title_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['connect_section_title'] );
    }
endif;

// connect_section_subtitle selective refresh
if ( ! function_exists( 'biographyn_connect_section_subtitle_partial' ) ) :
    function biographyn_connect_section_subtitle_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['connect_section_subtitle'] );
    }
endif;

// connect_btn_txt selective refresh
if ( ! function_exists( 'biographyn_connect_btn_txt_partial' ) ) :
    function biographyn_connect_btn_txt_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['connect_btn_txt'] );
    }
endif;

// sponsor_title selective refresh
if ( ! function_exists( 'biographyn_sponsor_title_partial' ) ) :
    function biographyn_sponsor_title_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['sponsor_title'] );
    }
endif;

// sponsor_description selective refresh
if ( ! function_exists( 'biographyn_sponsor_description_partial' ) ) :
    function biographyn_sponsor_description_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['sponsor_description'] );
    }
endif;

// archive_btn_txt selective refresh
if ( ! function_exists( 'biographyn_archive_btn_txt_partial' ) ) :
    function biographyn_archive_btn_txt_partial() {
        $options = biographyn_get_theme_options();
        return esc_html( $options['archive_btn_txt'] );
    }
endif;