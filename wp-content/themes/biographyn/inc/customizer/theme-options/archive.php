<?php
/**
 * Archive options
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */

// Add archive section
$wp_customize->add_section( 'biographyn_archive_section',
	array(
		'title'             => esc_html__( 'Blog/Archive','biographyn' ),
		'description'       => esc_html__( 'Archive section options.', 'biographyn' ),
		'panel'             => 'biographyn_theme_options_panel',
	)
);

// Your latest posts title setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[your_latest_posts_title]',
	array(
		'default'           => $options['your_latest_posts_title'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 'biographyn_theme_options[your_latest_posts_title]',
	array(
		'label'             => esc_html__( 'Your Latest Posts Title', 'biographyn' ),
		'description'       => esc_html__( 'This option only works if Static Front Page is set to "Your latest posts."', 'biographyn' ),
		'section'           => 'biographyn_archive_section',
		'type'				=> 'text',
		'active_callback'	=> function( $control ) {
			return !(
				biographyn_is_static_homepage_enable( $control )
			);
		}
	)
);

// features content type control and setting
$wp_customize->add_setting( 'biographyn_theme_options[blog_column]',
	array(
		'default'          	=> $options['blog_column'],
		'sanitize_callback' => 'biographyn_sanitize_select',
	)
);

$wp_customize->add_control( 'biographyn_theme_options[blog_column]',
	array(
		'label'             => esc_html__( 'Column Layout', 'biographyn' ),
		'section'           => 'biographyn_archive_section',
		'type'				=> 'select',
		'choices'			=> array( 
			'col-1'		=> esc_html__( 'One Column', 'biographyn' ),
			'col-2'		=> esc_html__( 'Two Column', 'biographyn' ),
		),
	)
);

// Archive tag category setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[hide_category]',
	array(
		'default'           => $options['hide_category'],
		'sanitize_callback' => 'biographyn_sanitize_switch_control',
	)
);

$wp_customize->add_control( new Biographyn_Switch_Control( $wp_customize,
	'biographyn_theme_options[hide_category]',
		array(
			'label'             => esc_html__( 'Hide Category', 'biographyn' ),
			'section'           => 'biographyn_archive_section',
			'on_off_label' 		=> biographyn_hide_options(),
		)
	)
);

