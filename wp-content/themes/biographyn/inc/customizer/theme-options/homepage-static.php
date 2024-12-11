<?php
/**
* Homepage (Static ) options
*
* @package Theme Palace
* @subpackage Biographyn
* @since Biographyn 1.0.0
*/

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[enable_frontpage_content]',
	array(
		'sanitize_callback'   => 'biographyn_sanitize_checkbox',
		'default'             => $options['enable_frontpage_content'],
	)
);

$wp_customize->add_control( 'biographyn_theme_options[enable_frontpage_content]',
	array(
		'label'       	=> esc_html__( 'Enable Content', 'biographyn' ),
		'description' 	=> esc_html__( 'Check to enable content on static front page only.', 'biographyn' ),
		'section'     	=> 'static_front_page',
		'type'        	=> 'checkbox',
		'active_callback' => 'biographyn_is_static_homepage_enable',
	)
);