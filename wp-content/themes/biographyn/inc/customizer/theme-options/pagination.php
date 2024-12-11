<?php
/**
 * pagination options
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'biographyn_pagination',
	array(
		'title'               	=> esc_html__('Pagination','biographyn'),
		'description'         	=> esc_html__( 'Pagination section options.', 'biographyn' ),
		'panel'               	=> 'biographyn_theme_options_panel',
	)
);

// Sidebar position setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[pagination_enable]',
	array(
		'sanitize_callback' 	=> 'biographyn_sanitize_switch_control',
		'default'             	=> $options['pagination_enable'],
	)
);

$wp_customize->add_control( new Biographyn_Switch_Control( $wp_customize,
	'biographyn_theme_options[pagination_enable]',
		array(
			'label'               	=> esc_html__( 'Pagination Enable', 'biographyn' ),
			'section'             	=> 'biographyn_pagination',
			'on_off_label' 			=> biographyn_switch_options(),
		)
	)
);

// Site layout setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[pagination_type]',
	array(
		'sanitize_callback'   	=> 'biographyn_sanitize_select',
		'default'             	=> $options['pagination_type'],
	)
);

$wp_customize->add_control( 'biographyn_theme_options[pagination_type]',
	array(
		'label'               	=> esc_html__( 'Pagination Type', 'biographyn' ),
		'section'             	=> 'biographyn_pagination',
		'type'                	=> 'select',
		'choices'			  	=> biographyn_pagination_options(),
		'active_callback'	  	=> 'biographyn_is_pagination_enable',
	)
);
