<?php
/**
 * Customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */

if ( ! function_exists( 'biographyn_is_loader_enable' ) ) :
	/**
	 * Check if loader is enabled.
	 *
	 * @since  Biographyn 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function biographyn_is_loader_enable( $control ) {
		return $control->manager->get_setting( 'biographyn_theme_options[loader_enable]' )->value();
	}
endif;

if ( ! function_exists( 'biographyn_is_static_homepage_enable' ) ) :
	/**
	 * Check if static homepage is enabled.
	 *
	 * @since Biographyn 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function biographyn_is_static_homepage_enable( $control ) {
		return ( 'page' == $control->manager->get_setting( 'show_on_front' )->value() );
	}
endif;

if ( ! function_exists( 'biographyn_is_breadcrumb_enable' ) ) :
	/**
	 * Check if breadcrumb is enabled.
	 *
	 * @since  Biographyn 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function biographyn_is_breadcrumb_enable( $control ) {
		return $control->manager->get_setting( 'biographyn_theme_options[breadcrumb_enable]' )->value();
	}
endif;

if ( ! function_exists( 'biographyn_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since  Biographyn 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function biographyn_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'biographyn_theme_options[pagination_enable]' )->value();
	}
endif;

/**
 * Check if hero slider section is enabled.
 *
 * @since  Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_hero_banner_section_enable( $control ) {
	return ( $control->manager->get_setting( 'biographyn_theme_options[hero_banner_section_enable]' )->value() );
}

/**
 * Check if about_us section is enabled.
 *
 * @since Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_about_us_section_enable( $control ) {
	return ( $control->manager->get_setting( 'biographyn_theme_options[about_us_section_enable]' )->value() );
}

/**
 * Check if connect section is enabled.
 *
 * @since  Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_connect_section_enable( $control ) {
	return ( $control->manager->get_setting( 'biographyn_theme_options[connect_section_enable]' )->value() );
}

/**
 * Check if event section is enabled.
 *
 * @since  Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_event_section_enable( $control ) {
	return ( $control->manager->get_setting( 'biographyn_theme_options[event_section_enable]' )->value() );
}

/**
 * Check if event section content type is post.
 *
 * @since  Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_event_section_content_post_enable( $control ) {
	$content_type = $control->manager->get_setting( 'biographyn_theme_options[event_content_type]' )->value();
	return biographyn_is_event_section_enable( $control ) && ( 'post' == $content_type );
}

/**
 * Check if event section content type is page.
 *
 * @since  Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_event_section_content_page_enable( $control ) {
	$content_type = $control->manager->get_setting( 'biographyn_theme_options[event_content_type]' )->value();
	return biographyn_is_event_section_enable( $control ) && ( 'page' == $content_type );
}

/**
 * Check if event section content type is category.
 *
 * @since  Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_event_section_content_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'biographyn_theme_options[event_content_type]' )->value();
	return biographyn_is_event_section_enable( $control ) && ( 'category' == $content_type );
}

/**
 * Check if event section content type is event.
 *
 * @since  Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_event_section_content_event_enable( $control ) {
	$content_type = $control->manager->get_setting( 'biographyn_theme_options[event_content_type]' )->value();
	return biographyn_is_event_section_enable( $control ) && ( 'event' == $content_type );
}

/**
 * Check if event section content type is event_category.
 *
 * @since  Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_event_section_content_event_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'biographyn_theme_options[event_content_type]' )->value();
	return biographyn_is_event_section_enable( $control ) && ( 'event-category' == $content_type );
}

/**
 * Check if event separator section is enabled.
 *
 * @since  Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_event_section_separator_enable( $control ) {
    $content_type = $control->manager->get_setting( 'biographyn_theme_options[event_content_type]' )->value();
    return biographyn_is_event_section_enable( $control ) && !( 'category' == $content_type  || 'event-category' == $content_type );
}

/**
 * Check if service section is enabled.
 *
 * @since  Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_services_section_enable( $control ) {
	return ( $control->manager->get_setting( 'biographyn_theme_options[services_section_enable]' )->value() );
}


/**
 * Check if album section is enabled.
 *
 * @since Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_album_section_enable( $control ) {
	return ( $control->manager->get_setting( 'biographyn_theme_options[album_section_enable]' )->value() );
}

/**
 * Check if album section content type is page.
 *
 * @since Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_album_section_content_page_enable( $control ) {
	$content_type = $control->manager->get_setting( 'biographyn_theme_options[album_content_type]' )->value();
	return biographyn_is_album_section_enable( $control ) && ( 'page' == $content_type );
}

/**
 * Check if album section content type is post.
 *
 * @since Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_album_section_content_post_enable( $control ) {
	$content_type = $control->manager->get_setting( 'biographyn_theme_options[album_content_type]' )->value();
	return biographyn_is_album_section_enable( $control ) && ( 'post' == $content_type );
}

/**
 * Check if album section content type is custom.
 *
 * @since Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_album_section_content_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'biographyn_theme_options[album_content_type]' )->value();
	return biographyn_is_album_section_enable( $control ) && ( 'category' == $content_type );
}

/**
 * Check if album section content type is custom.
 *
 * @since Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_album_section_content_custom_enable( $control ) {
	$content_type = $control->manager->get_setting( 'biographyn_theme_options[album_content_type]' )->value();
	return biographyn_is_album_section_enable( $control ) && ( 'custom' == $content_type );
}

/**
 * Check if album separator section is enabled.
 *
 * @since  Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_album_section_separator_enable( $control ) {
    $content_type = $control->manager->get_setting( 'biographyn_theme_options[album_content_type]' )->value();
    return biographyn_is_album_section_enable( $control ) && !( 'recent' == $content_type || 'category' == $content_type ) ;
}
/**

 * Check if testimonial section is enabled.
 *
 * @since  Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_testimonial_section_enable( $control ) {
    return ( $control->manager->get_setting( 'biographyn_theme_options[testimonial_section_enable]' )->value() );
}
/**
 * Check if sponsor section is enabled.
 *
 * @since  Biographyn 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function biographyn_is_sponsor_section_enable( $control ) {
	return ( $control->manager->get_setting( 'biographyn_theme_options[sponsor_section_enable]' )->value() );
}
