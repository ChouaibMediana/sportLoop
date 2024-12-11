<?php
/**
 * Connect Section options
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */

// Add Connect section
$wp_customize->add_section( 'biographyn_connect_section', 
    array(
        'title'             => esc_html__( 'Connect','biographyn' ),
        'description'       => esc_html__( 'Connect  Section options.', 'biographyn' ),
        'panel'             => 'biographyn_front_page_panel',
    ) 
);

// Connect content enable control and setting
$wp_customize->add_setting( 'biographyn_theme_options[connect_section_enable]', 
    array(
        'default'			=> 	$options['connect_section_enable'],
        'sanitize_callback' => 'biographyn_sanitize_switch_control',
    ) 
);

$wp_customize->add_control( new Biographyn_Switch_Control( $wp_customize,
    'biographyn_theme_options[connect_section_enable]',
        array(
            'label'             => esc_html__( 'Connect Section Enable', 'biographyn' ),
            'section'           => 'biographyn_connect_section',
            'on_off_label' 		=> biographyn_switch_options(),
        ) 
    )
);

// connect section title control and setting
$wp_customize->add_setting( 'biographyn_theme_options[connect_section_title]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'			=> 	$options['connect_section_title'],
        'transport'			=>'postMessage'
    ) 
);

$wp_customize->add_control('biographyn_theme_options[connect_section_title]',
    array(
        'label'             => esc_html__( 'Section Title', 'biographyn' ),
        'section'           => 'biographyn_connect_section',
        'type'              => 'text',
        'active_callback'	=> 'biographyn_is_connect_section_enable',
    )
);

$wp_customize->selective_refresh->add_partial( 'biographyn_theme_options[connect_section_title]',
    array(
        'selector'            => '#biographyn_connect_section .section-title',
        'render_callback'     => 'biographyn_connect_section_partial_title',
    )
);

// connect section title control and setting
$wp_customize->add_setting( 'biographyn_theme_options[connect_section_subtitle]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'			=> 	$options['connect_section_subtitle'],
        'transport'			=>'postMessage'
    ) 
);

$wp_customize->add_control('biographyn_theme_options[connect_section_subtitle]',
    array(
        'label'             => esc_html__( 'Section Sub Title', 'biographyn' ),
        'section'           => 'biographyn_connect_section',
        'type'              => 'text',
        'active_callback'	=> 'biographyn_is_connect_section_enable',
    )
);

$wp_customize->selective_refresh->add_partial(
    'biographyn_theme_options[connect_section_subtitle]',
    array(
        'selector'            => '#biographyn_connect_section .section-subtitle',
        'render_callback'     => 'biographyn_connect_section_partial_title',
    )
);

// connect image setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[connect_image]',
	array(
		'sanitize_callback' => 'biographyn_sanitize_image'
	)
);

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
	'biographyn_theme_options[connect_image]',
		array(
			'label'       		=> esc_html__( 'Image', 'biographyn' ),
			'description' 		=> sprintf( esc_html__( 'Recommended size: %1$dpx x %2$dpx ', 'biographyn' ), 512, 520 ),
			'section'     		=> 'biographyn_connect_section',
			'active_callback'	=> 'biographyn_is_connect_section_enable',
		)
	)
);

//connect_btn_txt
$wp_customize->add_setting('biographyn_theme_options[connect_btn_txt]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'			=> 'postMessage',
        'default'           => $options['connect_btn_txt'],
    )
);

$wp_customize->add_control('biographyn_theme_options[connect_btn_txt]',
    array(
        'section'			=> 'biographyn_connect_section',
        'label'				=> esc_html__( 'Button Text:', 'biographyn' ),
        'type'          	=>'text',
        'active_callback' 	=> 'biographyn_is_connect_section_enable'
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'biographyn_theme_options[connect_btn_txt]',
		array(
			'selector'            => '#biographyn_connect_section div.read-more a.btn',
			'settings'            => 'biographyn_theme_options[connect_btn_txt]',
			'fallback_refresh'    => true,
			'container_inclusive' => false,
			'render_callback'     => 'biographyn_connect_btn_txt_partial',
		)
	);
}

// about btn link setting and control
$wp_customize->add_setting( 'biographyn_theme_options[connect_btn_link]',
	array(
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control( 'biographyn_theme_options[connect_btn_link]',
	array(
		'label'           	=> esc_html__( 'Button Link', 'biographyn' ),
		'section'        	=> 'biographyn_connect_section',
		'active_callback' 	=> 'biographyn_is_connect_section_enable',
		'type'				=> 'url',
	)
);