<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'biographyn_excerpt_section',
	array(
		'title'             => esc_html__( 'Excerpt','biographyn' ),
		'description'       => esc_html__( 'Excerpt section options.', 'biographyn' ),
		'panel'             => 'biographyn_theme_options_panel',
	)
);


// long Excerpt length setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[long_excerpt_length]',
	array(
		'sanitize_callback' => 'biographyn_sanitize_number_range',
		'validate_callback' => 'biographyn_validate_long_excerpt',
		'default'			=> $options['long_excerpt_length'],
	)
);

$wp_customize->add_control( 'biographyn_theme_options[long_excerpt_length]',
	array(
		'label'       		=> esc_html__( 'Blog Page Excerpt Length', 'biographyn' ),
		'description' 		=> esc_html__( 'Total words to be displayed in archive page/search page.', 'biographyn' ),
		'section'     		=> 'biographyn_excerpt_section',
		'type'        		=> 'number',
		'input_attrs' 		=> array(
			'style'       => 'width: 80px;',
			'max'         => 100,
			'min'         => 5,
		),
	)
);
