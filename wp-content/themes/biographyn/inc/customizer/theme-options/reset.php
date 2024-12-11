<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'biographyn_reset_section',
	array(
		'title'             => esc_html__('Reset all settings','biographyn'),
		'description'       => esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'biographyn' ),
	)
);

// Add reset enable setting and control.
$wp_customize->add_setting( 'biographyn_theme_options[reset_options]',
	array(
		'default'           => $options['reset_options'],
		'sanitize_callback' => 'biographyn_sanitize_checkbox',
		'transport'			=> 'postMessage',
	)
);

$wp_customize->add_control( 'biographyn_theme_options[reset_options]',
	array(
		'label'             => esc_html__( 'Check to reset all settings', 'biographyn' ),
		'section'           => 'biographyn_reset_section',
		'type'              => 'checkbox',
	)
);
