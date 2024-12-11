<?php
/**
 * Layout options
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'biographyn_layout',
	array(
		'title'               => esc_html__('Layout','biographyn'),
		'description'         => esc_html__( 'Layout section options.', 'biographyn' ),
		'panel'               => 'biographyn_theme_options_panel',
	)
);

// Site layout setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[site_layout]',
	array(
		'sanitize_callback'   => 'biographyn_sanitize_select',
		'default'             => $options['site_layout'],
	)
);

$wp_customize->add_control(  new Biographyn_Custom_Radio_Image_Control ( $wp_customize,
	'biographyn_theme_options[site_layout]',
		array(
			'label'               => esc_html__( 'Site Layout', 'biographyn' ),
			'section'             => 'biographyn_layout',
			'choices'			  => biographyn_site_layout(),
		)
	)
);

// Sidebar position setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[sidebar_position]',
	array(
		'sanitize_callback'   => 'biographyn_sanitize_select',
		'default'             => $options['sidebar_position'],
	)
);

$wp_customize->add_control(  new Biographyn_Custom_Radio_Image_Control ( $wp_customize,
	'biographyn_theme_options[sidebar_position]',
		array(
			'label'               => esc_html__( 'Global Sidebar Position', 'biographyn' ),
			'section'             => 'biographyn_layout',
			'choices'			  => biographyn_global_sidebar_position(),
		)
	)
);

// Post sidebar position setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[post_sidebar_position]',
	array(
		'sanitize_callback'   => 'biographyn_sanitize_select',
		'default'             => $options['post_sidebar_position'],
	)
);

$wp_customize->add_control(  new Biographyn_Custom_Radio_Image_Control ( $wp_customize,
	'biographyn_theme_options[post_sidebar_position]',
		array(
			'label'               => esc_html__( 'Posts Sidebar Position', 'biographyn' ),
			'section'             => 'biographyn_layout',
			'choices'			  => biographyn_sidebar_position(),
		)
	)
);

// Post sidebar position setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[page_sidebar_position]',
	array(
		'sanitize_callback'   => 'biographyn_sanitize_select',
		'default'             => $options['page_sidebar_position'],
	)
);

$wp_customize->add_control( new Biographyn_Custom_Radio_Image_Control( $wp_customize,
	'biographyn_theme_options[page_sidebar_position]',
		array(
			'label'               => esc_html__( 'Pages Sidebar Position', 'biographyn' ),
			'section'             => 'biographyn_layout',
			'choices'			  => biographyn_sidebar_position(),
		)
	)
);