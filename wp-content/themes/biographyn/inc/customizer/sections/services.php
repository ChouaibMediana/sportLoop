<?php
/**
 * Service Section options
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */

// Add Service section
$wp_customize->add_section( 'biographyn_services_section', 
	array(
		'title'             => esc_html__( 'Our Services','biographyn' ),
		'description'       => esc_html__( 'Our Services Section options.', 'biographyn' ),
		'panel'             => 'biographyn_front_page_panel',
	) 
);

// Service content enable control and setting
$wp_customize->add_setting( 'biographyn_theme_options[services_section_enable]', 
	array(
		'default'			=> 	$options['services_section_enable'],
		'sanitize_callback' => 'biographyn_sanitize_switch_control',
	) 
);

$wp_customize->add_control( new Biographyn_Switch_Control( $wp_customize,
	'biographyn_theme_options[services_section_enable]', 
		array(
			'label'             => esc_html__( 'Our Services Section Enable', 'biographyn' ),
			'section'           => 'biographyn_services_section',
			'on_off_label' 		=> biographyn_switch_options(),
		) 
	)
);

// services title setting and control
$wp_customize->add_setting( 'biographyn_theme_options[services_subtitle]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => $options['services_subtitle'],
        'transport'         => 'postMessage',
    )
);

$wp_customize->add_control( 'biographyn_theme_options[services_subtitle]',
    array(
        'label'             => esc_html__( 'Section Sub Title', 'biographyn' ),
        'section'           => 'biographyn_services_section',
        'type'              => 'text',
		'active_callback'	=> 'biographyn_is_services_section_enable'
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'biographyn_theme_options[services_subtitle]',
        array(
            'selector'            => '#biographyn_our_services .section-header p',
            'settings'            => 'biographyn_theme_options[services_subtitle]',
            'container_inclusive' => false,
            'fallback_refresh'    => true,
            'render_callback'     => 'biographyn_services_subtitle_partial',
        )
    );
}

// services title setting and control
$wp_customize->add_setting( 'biographyn_theme_options[services_title]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => $options['services_title'],
        'transport'         => 'postMessage',
    )
);

$wp_customize->add_control( 'biographyn_theme_options[services_title]',
    array(
        'label'             => esc_html__( 'Section Title', 'biographyn' ),
        'section'           => 'biographyn_services_section',
        'active_callback'   => 'biographyn_is_services_section_enable',
        'type'              => 'text',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'biographyn_theme_options[services_title]',
        array(
            'selector'            => '#biographyn_our_services .section-header h2',
            'settings'            => 'biographyn_theme_options[services_title]',
            'container_inclusive' => false,
            'fallback_refresh'    => true,
            'render_callback'     => 'biographyn_services_title_partial',
        )
    );
}

$wp_customize->add_setting( 'biographyn_theme_options[services_image]',
	array(
		'sanitize_callback' => 'biographyn_sanitize_image',
	)
);

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
	'biographyn_theme_options[services_image]',
		array(
			'label'       		=> esc_html__( 'Background Image', 'biographyn' ),
			'description' 		=> sprintf( esc_html__( 'Recommended size: %1$dpx x %2$dpx ', 'biographyn' ), 1350, 385 ),
			'section'     		=> 'biographyn_services_section',
			'active_callback'	=> 'biographyn_is_services_section_enable',
		)
	)
);


for($i = 1; $i <= $options['services_posts_count']; $i ++):
		
    // service pages drop down chooser control and setting
	$wp_customize->add_setting( 'biographyn_theme_options[services_content_page_'.$i.']',
		array(
			'sanitize_callback' => 'biographyn_sanitize_page',
		) 
	);

	$wp_customize->add_control( new Biographyn_Dropdown_Chooser( $wp_customize,
		'biographyn_theme_options[services_content_page_'.$i.']',
			array(
				'label'             => sprintf(esc_html__( 'Select Page : %d', 'biographyn'), $i ),
				'section'           => 'biographyn_services_section',
				'choices'			=> biographyn_page_choices(),
				'active_callback'	=> 'biographyn_is_services_section_enable',
			) 
		)
	);


    // biographyn_Customize_Horizontal_Line
    $wp_customize->add_setting('biographyn_theme_options[services_separator'. $i .']',
		array(
			'sanitize_callback'      => 'biographyn_sanitize_html',
		)
	);

    $wp_customize->add_control(new Biographyn_Customize_Horizontal_Line($wp_customize,
		'biographyn_theme_options[services_separator'. $i .']',
			array(
				'active_callback'       => 'biographyn_is_services_section_enable',
				'type'                  =>'hr',
				'section'               =>'biographyn_services_section',
			)
		)
	);

endfor;

// Service Excerpt length setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[services_excerpt_length]',
	array(
		'sanitize_callback' => 'biographyn_sanitize_number_range',
		'default'			=> $options['services_excerpt_length'],
	)
);

$wp_customize->add_control( 'biographyn_theme_options[services_excerpt_length]',
	array(
		'label'       		=> esc_html__( 'Excerpt Length', 'biographyn' ),
		'description' 		=> esc_html__( 'Total words to be displayed in Service section', 'biographyn' ),
		'section'     		=> 'biographyn_services_section',
		'type'        		=> 'number',
		'active_callback' 	=> 'biographyn_is_services_section_enable',
	)
);