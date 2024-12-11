<?php
/**
 * About Section options
 *
 * @package Theme Palace
 * @subpackage Biographyn
 * @since Biographyn 1.0.0
 */

// Add About section
$wp_customize->add_section( 'biographyn_about_us_section',
	array(
		'title'             => esc_html__( 'About Us','biographyn' ),
		'description'       => esc_html__( 'About Section options.', 'biographyn' ),
		'panel'             => 'biographyn_front_page_panel',
	)
);

// About content enable control and setting
$wp_customize->add_setting( 'biographyn_theme_options[about_us_section_enable]',
	array(
		'default'			=> 	$options['about_us_section_enable'],
		'sanitize_callback' => 'biographyn_sanitize_switch_control',
	)
);

$wp_customize->add_control( new Biographyn_Switch_Control( $wp_customize,
	'biographyn_theme_options[about_us_section_enable]',
		array(
			'label'             => esc_html__( 'About Section Enable', 'biographyn' ),
			'section'           => 'biographyn_about_us_section',
			'on_off_label' 		=> biographyn_switch_options(),
		)
	)
);

// about btn title setting and control
$wp_customize->add_setting( 'biographyn_theme_options[about_us_sub_title]',
	array(
		'default'			=> 	$options['about_us_sub_title'],
		'sanitize_callback' => 'sanitize_text_field',
		'transport'			=> 'postMessage',
	)
);

$wp_customize->add_control( 'biographyn_theme_options[about_us_sub_title]',
	array(
		'label'           	=> esc_html__( 'Section Sub Title', 'biographyn' ),
		'section'        	=> 'biographyn_about_us_section',
		'active_callback' 	=> 'biographyn_is_about_us_section_enable',
		'type'				=> 'text',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'biographyn_theme_options[about_us_sub_title]',
		array(
			'selector'            => '#biographyn_about_section p.section-subtitle',
			'settings'            => 'biographyn_theme_options[about_us_sub_title]',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'biographyn_about_us_sub_title_partial',
		)
	);
}

// long Excerpt length setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[about_us_excerpt_length]',
	array(
		'sanitize_callback' => 'biographyn_sanitize_number_range',
		'validate_callback' => 'biographyn_validate_long_excerpt',
		'default'			=> $options['about_us_excerpt_length'],
	)
);

$wp_customize->add_control( 'biographyn_theme_options[about_us_excerpt_length]',
	array(
		'label'       		=> esc_html__( 'Excerpt Length', 'biographyn' ),
		'description' 		=> esc_html__( 'Total description words to be displayed in about posts.', 'biographyn' ),
		'section'     		=> 'biographyn_about_us_section',
		'active_callback' 	=> 'biographyn_is_about_us_section_enable',
		'type'        		=> 'number',
		'input_attrs' 		=> array(
			'style'       => 'width: 80px;',
			'max'         => 100,
			'min'         => 1,
		),
	)
);

// about posts drop down chooser control and setting
$wp_customize->add_setting( 'biographyn_theme_options[about_us_content_page]',
	array(
		'sanitize_callback' => 'biographyn_sanitize_page',
	)
);

$wp_customize->add_control( new Biographyn_Dropdown_Chooser( $wp_customize,
	'biographyn_theme_options[about_us_content_page]',
		array(
			'label'             => esc_html__( 'Select Page', 'biographyn' ),
			'section'           => 'biographyn_about_us_section',
			'choices'			=> biographyn_page_choices(),
			'active_callback'	=> 'biographyn_is_about_us_section_enable',
		)
	)
);


// about btn title setting and control
$wp_customize->add_setting( 'biographyn_theme_options[about_us_btn_title]',
	array(
		'default'			=> 	$options['about_us_btn_title'],
		'sanitize_callback' => 'sanitize_text_field',
		'transport'			=> 'postMessage',
	)
);

$wp_customize->add_control( 'biographyn_theme_options[about_us_btn_title]',
	array(
		'label'           	=> esc_html__( 'Button Label', 'biographyn' ),
		'section'        	=> 'biographyn_about_us_section',
		'active_callback' 	=> 'biographyn_is_about_us_section_enable',
		'type'				=> 'text',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'biographyn_theme_options[about_us_btn_title]',
		array(
			'selector'            => '#biographyn_about_section a.btn',
			'settings'            => 'biographyn_theme_options[about_us_btn_title]',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'biographyn_about_us_btn_title_partial',
		)
	);
}

// Add dropdown categories setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[about_us_content_multitple_page]',
    array(
        'sanitize_callback' => 'biographyn_sanitize_page_list',
    )
);

$wp_customize->add_control( new Biographyn_Dropdown_Multiple_Chooser( $wp_customize,
    'biographyn_theme_options[about_us_content_multitple_page]',
        array(
            'label'             => esc_html__( 'Select Multiple Page', 'biographyn' ),
            'section'           => 'biographyn_about_us_section',
            'type'              => 'dropdown_multiple_chooser',
            'choices'           =>  biographyn_page_choices(),
            'active_callback'   => 'biographyn_is_about_us_section_enable'
        )
    )
);