<?php
/**
* Customizer validation functions
*
* @package Theme Palace
* @subpackage  Biographyn
* @since  Biographyn 1.0.0
*/
if ( ! function_exists( 'biographyn_validate_services_posts_count' ) ) :
    function biographyn_validate_services_posts_count( $validity, $value ){
           $value = intval( $value );
       if ( empty( $value ) || ! is_numeric( $value ) ) {
           $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'biographyn' ) );
       } elseif ( $value < 1 ) {
           $validity->add( 'min_no_of_posts', esc_html__( 'Minimum no of posts is 1', 'biographyn' ) );
       } elseif ( $value > 12 ) {
           $validity->add( 'max_no_of_posts', esc_html__( 'Maximum no of posts is 12', 'biographyn' ) );
       }
       return $validity;
    }
  endif;

if ( ! function_exists( 'biographyn_validate_long_excerpt' ) ) :
    function biographyn_validate_long_excerpt( $validity, $value ){
        $value = intval( $value );
        if ( empty( $value ) || ! is_numeric( $value ) ) {
            $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'biographyn' ) );
        } elseif ( $value < 5 ) {
            $validity->add( 'min_no_of_words', esc_html__( 'Minimum no of words is 5', 'biographyn' ) );
        } elseif ( $value > 100 ) {
            $validity->add( 'max_no_of_words', esc_html__( 'Maximum no of words is 100', 'biographyn' ) );
        }
        return $validity;
    }
endif;

if ( ! function_exists( 'biographyn_validate_testimonial_count' ) ) :
    function biographyn_validate_testimonial_count( $validity, $value ){
           $value = intval( $value );
       if ( empty( $value ) || ! is_numeric( $value ) ) {
           $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'biographyn' ) );
       } elseif ( $value < 3 ) {
           $validity->add( 'min_no_of_posts', esc_html__( 'Minimum no of posts is 3', 'biographyn' ) );
       } elseif ( $value > 9 ) {
           $validity->add( 'max_no_of_posts', esc_html__( 'Maximum no of posts is 9', 'biographyn' ) );
       }
       return $validity;
    }
endif;

if ( ! function_exists( 'biographyn_validate_hero_banner_count' ) ) :
    function biographyn_validate_hero_banner_count( $validity, $value ){
           $value = intval( $value );
       if ( empty( $value ) || ! is_numeric( $value ) ) {
           $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'biographyn' ) );
       } elseif ( $value < 1 ) {
           $validity->add( 'min_no_of_posts', esc_html__( 'Minimum no of posts is 1', 'biographyn' ) );
       } elseif ( $value > 10 ) {
           $validity->add( 'max_no_of_posts', esc_html__( 'Maximum no of posts is 10', 'biographyn' ) );
       }
       return $validity;
    }
endif;

if ( ! function_exists( 'biographyn_validate_sponsor_count' ) ) :
    function biographyn_validate_sponsor_count( $validity, $value ){
           $value = intval( $value );
       if ( empty( $value ) || ! is_numeric( $value ) ) {
           $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'biographyn' ) );
       } elseif ( $value < 1 ) {
           $validity->add( 'min_no_of_posts', esc_html__( 'Minimum no of posts is 1', 'biographyn' ) );
       } elseif ( $value > 5 ) {
           $validity->add( 'max_no_of_posts', esc_html__( 'Maximum no of posts is 5', 'biographyn' ) );
       }
       return $validity;
    }
endif;

if ( ! function_exists( 'biographyn_validate_shop_count' ) ) :
    function biographyn_validate_shop_count( $validity, $value ){
           $value = intval( $value );
       if ( empty( $value ) || ! is_numeric( $value ) ) {
           $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'biographyn' ) );
       } elseif ( $value < 3) {
           $validity->add( 'min_no_of_posts', esc_html__( 'Minimum no of posts is 3', 'biographyn' ) );
       } elseif ( $value > 12 ) {
           $validity->add( 'max_no_of_posts', esc_html__( 'Maximum no of posts is 12', 'biographyn' ) );
       }
       return $validity;
    }
endif;