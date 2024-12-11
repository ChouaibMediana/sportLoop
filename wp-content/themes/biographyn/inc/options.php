<?php
/**
 * Theme Palace options
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */

/**
 * List of pages for page choices.
 * @return Array Array of page ids and name.
 */
function biographyn_page_choices() {
    $pages = get_pages();
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'biographyn' );
    foreach ( $pages as $page ) {
        $choices[ $page->ID ] = $page->post_title;
    }
    return  $choices;
}

/**
 * List of posts for post choices.
 * @return Array Array of post ids and name.
 */
function biographyn_post_choices() {
    $posts = get_posts( array( 'numberposts' => -1 ) );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'biographyn' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    wp_reset_postdata();
    return  $choices;
}


/**
 * List of category for category choices.
 * @return Array Array of post ids and name.
 */
function biographyn_category_choices() {
    $tax_args = array(
        'hierarchical' => 0,
        'taxonomy'     => 'category',
    );
    $taxonomies = get_categories( $tax_args );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'biographyn' );
    foreach ( $taxonomies as $tax ) {
        $choices[ $tax->term_id ] = $tax->name;
    }
    return  $choices;
}

if ( ! function_exists( 'biographyn_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function biographyn_site_layout() {
        $biographyn_site_layout = array(
            'wide'          => esc_url( get_template_directory_uri() . '/assets/images/full.png' ),
            'frame-layout'  => esc_url( get_template_directory_uri() . '/assets/images/framed.png' ),
        );

        $output = apply_filters( 'biographyn_site_layout', $biographyn_site_layout );
        return $output;
    }
endif;

if ( ! function_exists( 'biographyn_selected_sidebar' ) ) :
    /**
     * Sidebars options
     * @return array Sidbar positions
     */
    function biographyn_selected_sidebar() {
        $biographyn_selected_sidebar = array(
            'sidebar-1'             => esc_html__( 'Default Sidebar', 'biographyn' ),
            'optional-sidebar'      => esc_html__( 'Optional Sidebar 1', 'biographyn' ),
        );

        $output = apply_filters( 'biographyn_selected_sidebar', $biographyn_selected_sidebar );

        return $output;
    }
endif;


if ( ! function_exists( 'biographyn_global_sidebar_position' ) ) :
    /**
     * Global Sidebar position
     * @return array Global Sidebar positions
     */
    function biographyn_global_sidebar_position() {
        $biographyn_global_sidebar_position = array(
            'right-sidebar' => esc_url( get_template_directory_uri() . '/assets/images/right.png' ),
            'no-sidebar'    => esc_url( get_template_directory_uri() . '/assets/images/full.png' ),
        );

        $output = apply_filters( 'biographyn_global_sidebar_position', $biographyn_global_sidebar_position );

        return $output;
    }
endif;


if ( ! function_exists( 'biographyn_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidbar positions
     */
    function biographyn_sidebar_position() {
        $biographyn_sidebar_position = array(
            'right-sidebar'         => esc_url( get_template_directory_uri() . '/assets/images/right.png' ),
            'no-sidebar'            => esc_url( get_template_directory_uri() . '/assets/images/full.png' ),
        );

        $output = apply_filters( 'biographyn_sidebar_position', $biographyn_sidebar_position );

        return $output;
    }
endif;

if ( ! function_exists( 'biographyn_pagination_options' ) ) :
    /**
     * Pagination
     * @return array site pagination options
     */
    function biographyn_pagination_options() {
        $biographyn_pagination_options = array(
            'numeric'   => esc_html__( 'Numeric', 'biographyn' ),
            'default'   => esc_html__( 'Default(Older/Newer)', 'biographyn' ),
        );

        $output = apply_filters( 'biographyn_pagination_options', $biographyn_pagination_options );

        return $output;
    }
endif;


if ( ! function_exists( 'biographyn_switch_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function biographyn_switch_options() {
        $arr = array(
            'on'        => esc_html__( 'Enable', 'biographyn' ),
            'off'       => esc_html__( 'Disable', 'biographyn' )
        );
        return apply_filters( 'biographyn_switch_options', $arr );
    }
endif;

if ( ! function_exists( 'biographyn_hide_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function biographyn_hide_options() {
        $arr = array(
            'on'        => esc_html__( 'Yes', 'biographyn' ),
            'off'       => esc_html__( 'No', 'biographyn' )
        );
        return apply_filters( 'biographyn_hide_options', $arr );
    }
endif;

if ( ! function_exists( 'biographyn_sortable_sections' ) ) :
    /**
     * List of sections Control options
     * @return array List of Sections control options.
     */
    function biographyn_sortable_sections() {
        $options = biographyn_get_theme_options();
  
        $sections = array(
            
            'hero_banner'               => esc_html__( 'Hero Banner', 'biographyn' ),
            'about_us'                  => esc_html__( 'About us', 'biographyn' ),
            'services'                  => esc_html__( 'Our Service', 'biographyn' ),
            'testimonial'               => esc_html__( 'Testimonial', 'biographyn' ),
            'connect'                   => esc_html__( 'Connect', 'biographyn' ),
        );
         
        return apply_filters( 'biographyn_sortable_sections', $sections );
    }
endif;
