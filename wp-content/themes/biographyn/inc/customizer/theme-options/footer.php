<?php
/**
* Footer options
*
* @package Theme Palace
* @subpackage  Biographyn
* @since  Biographyn 1.0.0
*/

// Footer Section
$wp_customize->add_section( 'biographyn_section_footer',
	array(
		'title'      			=> esc_html__( 'Footer Options', 'biographyn' ),
		'priority'   			=> 900,
		'panel'      			=> 'biographyn_theme_options_panel',
		)
	);


// Topbar content enable control and setting
$wp_customize->add_setting( 'biographyn_theme_options[footer_social_menu_enable]',
	array(
		'default'			=> 	$options['footer_social_menu_enable'],
		'sanitize_callback' => 'biographyn_sanitize_switch_control',
	)
);
 
 $wp_customize->add_control( new Biographyn_Switch_Control( $wp_customize,
	'biographyn_theme_options[footer_social_menu_enable]',
		array(
			'label'             => esc_html__( 'Social Menu Enable', 'biographyn' ),
			'description'       => sprintf( '%1$s <a class="topbar-menu-trigger" href="#"> %2$s </a> %3$s', esc_html__( 'Note: To show social menu in footer.', 'biographyn' ), esc_html__( 'Click Here', 'biographyn' ), esc_html__( 'to create menu', 'biographyn' ) ),
			'section'           => 'biographyn_section_footer',
			'on_off_label' 		=> biographyn_switch_options(),
		)
	)
);
// scroll top visible
$wp_customize->add_setting( 'biographyn_theme_options[scroll_top_visible]',
	array(
		'default'       	=> $options['scroll_top_visible'],
		'sanitize_callback' => 'biographyn_sanitize_switch_control',
		)
	);

$wp_customize->add_control( new Biographyn_Switch_Control( $wp_customize,
	'biographyn_theme_options[scroll_top_visible]',
		array(																																																																																																																																																																																																																																																																																																																																																																																																																																																																																							
			'label'      		=> esc_html__( 'Display Scroll Top Button', 'biographyn' ),
			'section'    		=> 'biographyn_section_footer',
			'on_off_label' 		=> biographyn_switch_options(),
		)
	)
);

$wp_customize->add_setting( 'biographyn_theme_options[footer_hr]',
	array(
		'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control( new Biographyn_Customize_Horizontal_Line( $wp_customize,
	'biographyn_theme_options[footer_hr]',
		array(
			'section'         => 'biographyn_section_footer',
			'type'			  => 'hr',
		)
	)
);
