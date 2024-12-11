<?php
/**
 * Hero Banner Section options
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */

// Add Hero Banner section
$wp_customize->add_section( 'biographyn_hero_banner_section',
	array(
		'title'             => esc_html__( 'Hero Banner','biographyn' ),
		'description'       => esc_html__( 'Hero Banner Section options.', 'biographyn' ),
		'panel'             => 'biographyn_front_page_panel',
	)
);

// Hero Banner content enable control and setting
$wp_customize->add_setting( 'biographyn_theme_options[hero_banner_section_enable]', 
	array(
		'default'			=> 	$options['hero_banner_section_enable'],
		'sanitize_callback' => 'biographyn_sanitize_switch_control',
	) 
);

$wp_customize->add_control( new Biographyn_Switch_Control( $wp_customize,
	'biographyn_theme_options[hero_banner_section_enable]',
		array(
			'label'             => esc_html__( 'Hero Banner Section Enable', 'biographyn' ),
			'section'           => 'biographyn_hero_banner_section',
			'on_off_label' 		=> biographyn_switch_options(),
		)
	)
);

// Hero Banner content enable control and setting
$wp_customize->add_setting( 'biographyn_theme_options[hero_banner_social_menu_enable]', 
	array(
		'default'			=> 	$options['hero_banner_social_menu_enable'],
		'sanitize_callback' => 'biographyn_sanitize_switch_control',
	) 
);

$wp_customize->add_control( new Biographyn_Switch_Control( $wp_customize,
	'biographyn_theme_options[hero_banner_social_menu_enable]',
		array(
			'label'             => esc_html__( 'Enable Social Menu', 'biographyn' ),
			'section'           => 'biographyn_hero_banner_section',
			'on_off_label' 		=> biographyn_switch_options(),
		)
	)
);

// hero_banner_sub title setting and control
$wp_customize->add_setting( 'biographyn_theme_options[hero_banner_title]',
	array(
		'default'       		=> $options['hero_banner_title'],
		'sanitize_callback'		=> 'sanitize_text_field',
		'transport'				=> 'postMessage',
	)
);
$wp_customize->add_control( 'biographyn_theme_options[hero_banner_title]',
    array(
		'label'      			=> esc_html__( 'Section Title', 'biographyn' ),
		'description'       => esc_html__( 'Separate the two words with space', 'biographyn' ),
		'section'    			=> 'biographyn_hero_banner_section',
		'type'		 			=> 'text',
		'active_callback'		=> 'biographyn_is_hero_banner_section_enable',
    )
);

// // Abort if selective refresh is not available.
// if ( isset( $wp_customize->selective_refresh ) ) {
//     $wp_customize->selective_refresh->add_partial( 'biographyn_theme_options[hero_banner_title]',
// 		array(
// 			'selector'            => '#biographyn_header_content_section .section-header span',
// 			'settings'            => 'biographyn_theme_options[hero_banner_title]',
// 			'container_inclusive' => false,
// 			'fallback_refresh'    => true,
// 			'render_callback'     => 'biographyn_hero_banner_title_partial',
// 		)
// 	);
// }

// hero_banner_sub title setting and control
$wp_customize->add_setting( 'biographyn_theme_options[hero_banner_dob]',
	array(
		'default'       		=> $options['hero_banner_dob'],
		'sanitize_callback'		=> 'sanitize_text_field',
		'transport'				=> 'postMessage',
	)
);
$wp_customize->add_control( 'biographyn_theme_options[hero_banner_dob]',
    array(
		'label'      			=> esc_html__( 'Date Of Birth', 'biographyn' ),
		'section'    			=> 'biographyn_hero_banner_section',
		'type'		 			=> 'text',
		'active_callback'		=> 'biographyn_is_hero_banner_section_enable',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'biographyn_theme_options[hero_banner_dob]',
		array(
			'selector'            => '#biographyn_header_content_section .entry-meta span',
			'settings'            => 'biographyn_theme_options[hero_banner_dob]',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'biographyn_hero_banner_dob_partial',
		)
	);
}

// hero_banner_sub title setting and control
$wp_customize->add_setting( 'biographyn_theme_options[hero_banner_dob_title]',
	array(
		'default'       		=> $options['hero_banner_dob_title'],
		'sanitize_callback'		=> 'sanitize_text_field',
		'transport'				=> 'postMessage',
	)
);
$wp_customize->add_control( 'biographyn_theme_options[hero_banner_dob_title]',
    array(
		'label'      			=> esc_html__( 'Date Of Birth Title', 'biographyn' ),
		'section'    			=> 'biographyn_hero_banner_section',
		'type'		 			=> 'text',
		'active_callback'		=> 'biographyn_is_hero_banner_section_enable',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'biographyn_theme_options[hero_banner_dob_title]',
		array(
			'selector'            => '#biographyn_header_content_section .entry-meta p',
			'settings'            => 'biographyn_theme_options[hero_banner_dob_title]',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'biographyn_hero_banner_dob_title_partial',
		)
	);
}


// hero_banner posts drop down chooser control and setting
$wp_customize->add_setting( 'biographyn_theme_options[hero_banner_content_page]', 
	array(
		'sanitize_callback' => 'biographyn_sanitize_page',
	)
);

$wp_customize->add_control( new Biographyn_Dropdown_Chooser( $wp_customize,
	'biographyn_theme_options[hero_banner_content_page]',
		array(
			'label'             => esc_html__( 'Select Page', 'biographyn'),
			'section'           => 'biographyn_hero_banner_section',
			'choices'			=> biographyn_page_choices(),
			'active_callback'	=> 'biographyn_is_hero_banner_section_enable',
		)
	)
);

//hero_banner separator
$wp_customize->add_setting('biographyn_theme_options[hero_banner_separator]',
	array(
		'sanitize_callback'      => 'biographyn_sanitize_html',
	)
);

$wp_customize->add_control(new Biographyn_Customize_Horizontal_Line($wp_customize,
	'biographyn_theme_options[hero_banner_separator]',
		array(
			'active_callback'       => 'biographyn_is_hero_banner_section_enable',
			'type'                  =>'hr',
			'section'               =>'biographyn_hero_banner_section',
		)
	)
);

// about btn title setting and control
$wp_customize->add_setting( 'biographyn_theme_options[hero_banner_content_title]',
	array(
		'default'			=> 	$options['hero_banner_content_title'],
		'sanitize_callback' => 'sanitize_text_field',
		'transport'			=> 'postMessage',
	)
);

$wp_customize->add_control( 'biographyn_theme_options[hero_banner_content_title]',
	array(
		'label'           	=> esc_html__( 'Content Title', 'biographyn' ),
		'section'        	=> 'biographyn_hero_banner_section',
		'active_callback' 	=> 'biographyn_is_hero_banner_section_enable',
		'type'				=> 'text',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'biographyn_theme_options[hero_banner_content_title]',
		array(
			'selector'            => '#biographyn_business_about_us .entry-header h2',
			'settings'            => 'biographyn_theme_options[hero_banner_content_title]',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'biographyn_hero_banner_content_title_partial',
		)
	);
}

// Add dropdown categories setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[hero_banner_content_multitple_page]',
    array(
        'sanitize_callback' => 'biographyn_sanitize_page_list',
    )
);

$wp_customize->add_control( new Biographyn_Dropdown_Multiple_Chooser( $wp_customize,
    'biographyn_theme_options[hero_banner_content_multitple_page]',
        array(
            'label'             => esc_html__( 'Select Multiple Page', 'biographyn' ),
            'section'           => 'biographyn_hero_banner_section',
            'type'              => 'dropdown_multiple_chooser',
            'choices'           =>  biographyn_page_choices(),
            'active_callback'   => 'biographyn_is_hero_banner_section_enable'
        )
    )
);


//hero_banner_btn_txt
$wp_customize->add_setting('biographyn_theme_options[hero_banner_know_more_txt]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'			=> 'postMessage',
        'default'           => $options['hero_banner_know_more_txt'],
    )
);

$wp_customize->add_control('biographyn_theme_options[hero_banner_know_more_txt]',
    array(
        'section'			=> 'biographyn_hero_banner_section',
        'label'				=> esc_html__( 'know More Text:', 'biographyn' ),
        'type'          	=>'text',
        'active_callback' 	=> 'biographyn_is_hero_banner_section_enable'
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'biographyn_theme_options[hero_banner_know_more_txt]',
		array(
			'selector'            => '#biographyn_header_content_section .scroll span',
			'settings'            => 'biographyn_theme_options[hero_banner_know_more_txt]',
			'fallback_refresh'    => true,
			'container_inclusive' => false,
			'render_callback'     => 'biographyn_hero_banner_know_more_txt_partial',
		) 
	);
}

//hero_banner_btn_txt
$wp_customize->add_setting('biographyn_theme_options[hero_banner_btn_txt]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'			=> 'postMessage',
        'default'           => $options['hero_banner_btn_txt'],
    )
);

$wp_customize->add_control('biographyn_theme_options[hero_banner_btn_txt]',
    array(
        'section'			=> 'biographyn_hero_banner_section',
        'label'				=> esc_html__( 'Scroll Down Button Text:', 'biographyn' ),
        'type'          	=>'text',
        'active_callback' 	=> 'biographyn_is_hero_banner_section_enable'
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'biographyn_theme_options[hero_banner_btn_txt]',
		array(
			'selector'            => '#biographyn_header_content_section .scroll a > span',
			'settings'            => 'biographyn_theme_options[hero_banner_btn_txt]',
			'fallback_refresh'    => true,
			'container_inclusive' => false,
			'render_callback'     => 'biographyn_hero_banner_btn_txt_partial',
		) 
	);
}

// hero_banner Excerpt length setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[hero_banner_excerpt_length]',
	array(
		'sanitize_callback' => 'biographyn_sanitize_number_range',
		'default'			=> $options['hero_banner_excerpt_length'],
	)
);

$wp_customize->add_control( 'biographyn_theme_options[hero_banner_excerpt_length]',
	array(
		'label'       		=> esc_html__( 'Excerpt Length', 'biographyn' ),
		'description' 		=> esc_html__( 'Total words to be displayed in hero banner section', 'biographyn' ),
		'section'     		=> 'biographyn_hero_banner_section',
		'type'        		=> 'number',
		'active_callback' 	=> 'biographyn_is_hero_banner_section_enable',
	)
);