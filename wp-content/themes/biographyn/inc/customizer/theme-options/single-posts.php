<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'biographyn_single_post_section',
	array(
		'title'             => esc_html__( 'Single Post','biographyn' ),
		'description'       => esc_html__( 'Options to change the single posts globally.', 'biographyn' ),
		'panel'             => 'biographyn_theme_options_panel',
	)
);

// Archive date meta setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[single_post_hide_date]',
	array(
		'default'           => $options['single_post_hide_date'],
		'sanitize_callback' => 'biographyn_sanitize_switch_control',
	)
);

$wp_customize->add_control( new Biographyn_Switch_Control( $wp_customize,
	'biographyn_theme_options[single_post_hide_date]',
		array(
			'label'             => esc_html__( 'Hide Date', 'biographyn' ),
			'section'           => 'biographyn_single_post_section',
			'on_off_label' 		=> biographyn_hide_options(),
		)
	)
);

// Archive tag category setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[single_post_hide_pagination]',
	array(
		'default'           => $options['single_post_hide_pagination'],
		'sanitize_callback' => 'biographyn_sanitize_switch_control',
	)
);

$wp_customize->add_control( new Biographyn_Switch_Control( $wp_customize,
	'biographyn_theme_options[single_post_hide_pagination]',
		array(
			'label'             => esc_html__( 'Hide Pagination', 'biographyn' ),
			'section'           => 'biographyn_single_post_section',
			'on_off_label' 		=> biographyn_hide_options(),
		)
	)
);
