<?php

/**
 * Testimonials Section options
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */

// Add Testimonials section
$wp_customize->add_section('biographyn_testimonial_section',
    array(
        'title'         => esc_html__('Testimonials', 'biographyn'),
        'description'   => esc_html__('Testimonials Section options.', 'biographyn'),
        'panel'         => 'biographyn_front_page_panel',
    )
);

// Testimonials content enable control and setting
$wp_customize->add_setting('biographyn_theme_options[testimonial_section_enable]',
    array(
        'default'           => $options['testimonial_section_enable'],
        'sanitize_callback' => 'biographyn_sanitize_switch_control',
    )
);

$wp_customize->add_control(new Biographyn_Switch_Control($wp_customize,
    'biographyn_theme_options[testimonial_section_enable]',
        array(
            'label'         => esc_html__('Testimonials Section Enable', 'biographyn'),
            'section'       => 'biographyn_testimonial_section',
            'on_off_label'  => biographyn_switch_options(),
        )
    )
);

// testimonial title setting and control
$wp_customize->add_setting( 'biographyn_theme_options[testimonial_subtitle]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'			=> $options['testimonial_subtitle'],
		'transport'			=> 'postMessage',
	)
);

$wp_customize->add_control( 'biographyn_theme_options[testimonial_subtitle]',
	array(
		'label'           	=> esc_html__( 'Seciton Sub Title', 'biographyn' ),
		'section'        	=> 'biographyn_testimonial_section',
		'active_callback' 	=> 'biographyn_is_testimonial_section_enable',
		'type'				=> 'text',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'biographyn_theme_options[testimonial_subtitle]',
		array(
			'selector'            => '#biographyn_testimonial_section p.section-subtitle',
			'settings'            => 'biographyn_theme_options[testimonial_subtitle]',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'biographyn_testimonial_subtitle_partial',
		)
	);
}

// testimonial title setting and control
$wp_customize->add_setting( 'biographyn_theme_options[testimonial_title]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'			=> $options['testimonial_title'],
		'transport'			=> 'postMessage',
	)
);

$wp_customize->add_control( 'biographyn_theme_options[testimonial_title]',
	array(
		'label'           	=> esc_html__( 'Section Title', 'biographyn' ),
		'section'        	=> 'biographyn_testimonial_section',
		'active_callback' 	=> 'biographyn_is_testimonial_section_enable',
		'type'				=> 'text',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'biographyn_theme_options[testimonial_title]',
		array(
			'selector'            => '#biographyn_testimonial_section h2.section-title',
			'settings'            => 'biographyn_theme_options[testimonial_title]',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'biographyn_testimonial_title_partial',
		)
	);
}

$wp_customize->add_setting( 'biographyn_theme_options[testimonial_image]',
	array(
		'sanitize_callback' => 'biographyn_sanitize_image',
	)
);

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
	'biographyn_theme_options[testimonial_image]',
		array(
			'label'       		=> esc_html__( 'Background Image', 'biographyn' ),
			'description' 		=> sprintf( esc_html__( 'Recommended size: %1$dpx x %2$dpx ', 'biographyn' ), 1350, 385 ),
			'section'     		=> 'biographyn_testimonial_section',
			'active_callback'	=> 'biographyn_is_testimonial_section_enable',
		)
	)
);


for ($i = 1; $i <= $options['testimonial_posts_count']; $i++):

    // Testimonials posts drop down chooser control and setting
    $wp_customize->add_setting('biographyn_theme_options[testimonial_content_post_' . $i . ']',
        array(
            'sanitize_callback' => 'biographyn_sanitize_page',
        )
    );

    $wp_customize->add_control(new Biographyn_Dropdown_Chooser($wp_customize,
        'biographyn_theme_options[testimonial_content_post_' . $i . ']',
            array(
                'label'             => sprintf(esc_html__('Select Post : %d', 'biographyn'), $i),
                'section'           => 'biographyn_testimonial_section',
                'choices'           => biographyn_post_choices(),
                'active_callback'   => 'biographyn_is_testimonial_section_enable',
            )
        )
    );

    // Testimonial posts sub title control and setting
    $wp_customize->add_setting('biographyn_theme_options[testimonial_post_designation_' . $i . ']',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(new Biographyn_Dropdown_Chooser($wp_customize,
        'biographyn_theme_options[testimonial_post_designation_' . $i . ']',
            array(
                'label'             => sprintf(esc_html__('Select Designation : %d', 'biographyn'), $i),
                'section'           => 'biographyn_testimonial_section',
                'active_callback'   => 'biographyn_is_testimonial_section_enable',
                'type'              => 'text',
            )
        )
    );
    
    //testimonial separator
    $wp_customize->add_setting('biographyn_theme_options[testimonial_separator'. $i .']',
        array(
            'sanitize_callback'      => 'biographyn_sanitize_html',
        )
    );

    $wp_customize->add_control(new Biographyn_Customize_Horizontal_Line($wp_customize,
        'biographyn_theme_options[testimonial_separator'. $i .']',
            array(
                'active_callback'       => 'biographyn_is_testimonial_section_enable',
                'type'                  =>'hr',
                'section'               =>'biographyn_testimonial_section',
            )
        )
    );

endfor;
