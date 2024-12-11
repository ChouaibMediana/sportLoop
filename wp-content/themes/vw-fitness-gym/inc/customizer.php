<?php
/**
 * VW Fitness Gym Theme Customizer
 *
 * @package VW Fitness Gym
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_fitness_gym_custom_controls() {

    load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'vw_fitness_gym_custom_controls' );

function vw_fitness_gym_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage'; 
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'blogname', array( 
		'selector' => '.logo .site-title a', 
	 	'render_callback' => 'vw_fitness_gym_customize_partial_blogname', 
	)); 

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array( 
		'selector' => 'p.site-description', 
		'render_callback' => 'vw_fitness_gym_customize_partial_blogdescription', 
	));

	//Homepage Settings
	$wp_customize->add_panel( 'vw_fitness_gym_homepage_panel', array(
		'title' => esc_html__( 'Homepage Settings', 'vw-fitness-gym' ),
		'panel' => 'vw_fitness_gym_panel_id',
		'priority' => 20,
	));

	//Topbar
	$wp_customize->add_section( 'vw_fitness_gym_topbar', array(
    	'title'      => __( 'Topbar Settings', 'vw-fitness-gym' ),
		'panel' => 'vw_fitness_gym_homepage_panel'
	) );

   	// Header Background color
	$wp_customize->add_setting('vw_fitness_gym_header_background_color', array(
		'default'           => '#191a1f',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_fitness_gym_header_background_color', array(
		'label'    => __('Header Background Color', 'vw-fitness-gym'),
		'section'  => 'vw_fitness_gym_topbar',
	)));

	$wp_customize->add_setting('vw_fitness_gym_header_img_position',array(
	  'default' => 'center top',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_header_img_position',array(
		'type' => 'select',
		'label' => __('Header Image Position','vw-fitness-gym'),
		'section' => 'vw_fitness_gym_topbar',
		'choices' 	=> array(
			'left top' 		=> esc_html__( 'Top Left', 'vw-fitness-gym' ),
			'center top'   => esc_html__( 'Top', 'vw-fitness-gym' ),
			'right top'   => esc_html__( 'Top Right', 'vw-fitness-gym' ),
			'left center'   => esc_html__( 'Left', 'vw-fitness-gym' ),
			'center center'   => esc_html__( 'Center', 'vw-fitness-gym' ),
			'right center'   => esc_html__( 'Right', 'vw-fitness-gym' ),
			'left bottom'   => esc_html__( 'Bottom Left', 'vw-fitness-gym' ),
			'center bottom'   => esc_html__( 'Bottom', 'vw-fitness-gym' ),
			'right bottom'   => esc_html__( 'Bottom Right', 'vw-fitness-gym' ),
		),
	));

	//Sticky Header
	$wp_customize->add_setting( 'vw_fitness_gym_sticky_header',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_sticky_header',array(
        'label' => esc_html__( 'Show / Hide Sticky Header','vw-fitness-gym' ),
        'section' => 'vw_fitness_gym_topbar'
    )));

    $wp_customize->add_setting('vw_fitness_gym_sticky_header_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_sticky_header_padding',array(
		'label'	=> __('Sticky Header Padding','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
        'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_fitness_gym_search_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_search_hide_show',array(
      'label' => esc_html__( 'Show / Hide Search','vw-fitness-gym' ),
      'section' => 'vw_fitness_gym_topbar'
    )));

    $wp_customize->add_setting('vw_fitness_gym_search_icon',array(
		'default'	=> 'fas fa-search',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_search_icon',array(
		'label'	=> __('Add Search Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_topbar',
		'setting'	=> 'vw_fitness_gym_search_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_fitness_gym_search_close_icon',array(
		'default'	=> 'fa fa-window-close',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_search_close_icon',array(
		'label'	=> __('Add Search Close Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_topbar',
		'setting'	=> 'vw_fitness_gym_search_close_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('vw_fitness_gym_search_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_search_font_size',array(
		'label'	=> __('Search Font Size','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_search_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_search_padding_top_bottom',array(
		'label'	=> __('Search Padding Top Bottom','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_search_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_search_padding_left_right',array(
		'label'	=> __('Search Padding Left Right','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_fitness_gym_search_border_radius', array(
		'default'              => "",
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_search_border_radius', array(
		'label'       => esc_html__( 'Search Border Radius','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_topbar',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_fitness_gym_search_placeholder',array(
       'default' => esc_html__('Search','vw-fitness-gym'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_fitness_gym_search_placeholder',array(
       'type' => 'text',
       'label' => __('Search Placeholder Text','vw-fitness-gym'),
       'section' => 'vw_fitness_gym_topbar'
    ));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_fitness_gym_phone_number', array( 
		'selector' => '#topbar .call-info', 
		'render_callback' => 'vw_fitness_gym_customize_partial_vw_fitness_gym_phone_number', 
	));

    $wp_customize->add_setting('vw_fitness_gym_phone_no_icon',array(
		'default'	=> 'fas fa-phone',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_phone_no_icon',array(
		'label'	=> __('Add Phone Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_topbar',
		'setting'	=> 'vw_fitness_gym_phone_no_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_fitness_gym_phone_number',array(
		'default'=> '',
		'sanitize_callback'	=> 'vw_fitness_gym_sanitize_phone_number'
	));
	$wp_customize->add_control('vw_fitness_gym_phone_number',array(
		'label'	=> __('Add Phone Number','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '+789 456 1230', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_email_icon',array(
		'default'	=> 'fas fa-envelope-open',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_email_icon',array(
		'label'	=> __('Add Email Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_topbar',
		'setting'	=> 'vw_fitness_gym_email_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_fitness_gym_email_address',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_email'
	));
	$wp_customize->add_control('vw_fitness_gym_email_address',array(
		'label'	=> __('Add Email Address','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( 'example@123.com', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_topbar',
		'type'=> 'text'
	));

	//Menus Settings
	$wp_customize->add_section( 'vw_fitness_gym_menu_section' , array(
    	'title' => __( 'Menus Settings', 'vw-fitness-gym' ),
		'priority'	=>	null,
		'panel'		=>	'vw_fitness_gym_homepage_panel'
	) );

	$wp_customize->add_setting('vw_fitness_gym_navigation_menu_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_navigation_menu_font_size',array(
		'label'	=> __('Menus Font Size','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_menu_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_navigation_menu_font_weight',array(
        'default' => 700,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_navigation_menu_font_weight',array(
        'type' => 'select',
        'label' => __('Menus Font Weight','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_menu_section',
        'choices' => array(
        	'100' => __('100','vw-fitness-gym'),
            '200' => __('200','vw-fitness-gym'),
            '300' => __('300','vw-fitness-gym'),
            '400' => __('400','vw-fitness-gym'),
            '500' => __('500','vw-fitness-gym'),
            '600' => __('600','vw-fitness-gym'),
            '700' => __('700','vw-fitness-gym'),
            '800' => __('800','vw-fitness-gym'),
            '900' => __('900','vw-fitness-gym'),
        ),
	) );

	// text trasform
	$wp_customize->add_setting('vw_fitness_gym_menu_text_transform',array(
		'default'=> 'Capitalize',
		'sanitize_callback'	=> 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_menu_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Menus Text Transform','vw-fitness-gym'),
		'choices' => array(
            'Uppercase' => __('Uppercase','vw-fitness-gym'),
            'Capitalize' => __('Capitalize','vw-fitness-gym'),
            'Lowercase' => __('Lowercase','vw-fitness-gym'),
        ),
		'section'=> 'vw_fitness_gym_menu_section',
	));

	$wp_customize->add_setting('vw_fitness_gym_header_menus_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_fitness_gym_header_menus_color', array(
		'label'    => __('Menus Color', 'vw-fitness-gym'),
		'section'  => 'vw_fitness_gym_menu_section',
	)));

	$wp_customize->add_setting('vw_fitness_gym_header_menus_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_fitness_gym_header_menus_hover_color', array(
		'label'    => __('Menus Hover Color', 'vw-fitness-gym'),
		'section'  => 'vw_fitness_gym_menu_section',
	)));

	$wp_customize->add_setting('vw_fitness_gym_header_submenus_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_fitness_gym_header_submenus_color', array(
		'label'    => __('Sub Menus Color', 'vw-fitness-gym'),
		'section'  => 'vw_fitness_gym_menu_section',
	)));

	$wp_customize->add_setting('vw_fitness_gym_header_submenus_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_fitness_gym_header_submenus_hover_color', array(
		'label'    => __('Sub Menus Hover Color', 'vw-fitness-gym'),
		'section'  => 'vw_fitness_gym_menu_section',
	)));

	//Social links
	$wp_customize->add_section(
		'vw_fitness_gym_social_links', array(
			'title'		=>	__('Social Links', 'vw-fitness-gym'),
			'priority'	=>	null,
			'panel'		=>	'vw_fitness_gym_homepage_panel'
		));

	$wp_customize->add_setting('vw_fitness_gym_social_icons',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_social_icons',array(
		'label' =>  __('Steps to setup social icons','vw-fitness-gym'),
		'description' => __('<p>1. Go to Dashboard >> Appearance >> Widgets</p>
			<p>2. Add Vw Social Icon Widget in Social Icon .</p>
			<p>3. Add social icons url and save.</p>','vw-fitness-gym'),
		'section'=> 'vw_fitness_gym_social_links',
		'type'=> 'hidden'
	));
	$wp_customize->add_setting('vw_fitness_gym_social_icon_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_social_icon_btn',array(
		'description' => "<a target='_blank' href='". admin_url('widgets.php') ." '>Setup Social Icons</a>",
		'section'=> 'vw_fitness_gym_social_links',
		'type'=> 'hidden'
	));
    
	//Slider
	$wp_customize->add_section( 'vw_fitness_gym_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'vw-fitness-gym' ),
    	'description' => "Free theme has 3 slides options, For unlimited slides and more options </br><a class='go-pro-btn' target='_blank' href='". esc_url(VW_FITNESS_GYM_GO_PRO) ." '>GET PRO</a>",
		'panel' => 'vw_fitness_gym_homepage_panel'
	) );

	$wp_customize->add_setting( 'vw_fitness_gym_slider_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_slider_hide_show',array(
      'label' => esc_html__( 'Show / Hide Slider','vw-fitness-gym' ),
      'section' => 'vw_fitness_gym_slidersettings'
    )));

    $wp_customize->add_setting('vw_fitness_gym_slider_type',array(
        'default' => 'Default slider',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	) );
	$wp_customize->add_control('vw_fitness_gym_slider_type', array(
        'type' => 'select',
        'label' => __('Slider Type','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_slidersettings',
        'choices' => array(
            'Default slider' => __('Default slider','vw-fitness-gym'),
            'Advance slider' => __('Advance slider','vw-fitness-gym'),
        ),
	));

	$wp_customize->add_setting('vw_fitness_gym_advance_slider_shortcode',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_advance_slider_shortcode',array(
		'label'	=> __('Add Slider Shortcode','vw-fitness-gym'),
		'section'=> 'vw_fitness_gym_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_fitness_gym_advance_slider'
	));

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_fitness_gym_slider_hide_show',array(
		'selector'        => '#slider .inner_carousel h1',
		'render_callback' => 'vw_fitness_gym_customize_partial_vw_fitness_gym_slider_hide_show',
	));

	for ( $count = 1; $count <= 3; $count++ ) {
		$wp_customize->add_setting( 'vw_fitness_gym_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_fitness_gym_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_fitness_gym_slider_page' . $count, array(
			'label'    => __( 'Select Slider Page', 'vw-fitness-gym' ),
			'description' => __('Slider image size (1500 x 650)','vw-fitness-gym'),
			'section'  => 'vw_fitness_gym_slidersettings',
			'type'     => 'dropdown-pages',
			'active_callback' => 'vw_fitness_gym_default_slider'
		) );
	}

	$wp_customize->add_setting('vw_fitness_gym_slider_button_text',array(
		'default'=> 'READ MORE',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_slider_button_text',array(
		'label'	=> __('Add Slider Button Text','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( 'READ MORE', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_fitness_gym_default_slider'
	));

	//content layout
	$wp_customize->add_setting('vw_fitness_gym_slider_content_option',array(
        'default' => 'Left',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Fitness_Gym_Image_Radio_Control($wp_customize, 'vw_fitness_gym_slider_content_option', array(
        'type' => 'select',
        'label' => __('Slider Content Layouts','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_slidersettings',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/slider-content1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/slider-content2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/slider-content3.png',
    ),	
        'active_callback' => 'vw_fitness_gym_default_slider'
    )));

    //Slider content padding
    $wp_customize->add_setting('vw_fitness_gym_slider_content_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_slider_content_padding_top_bottom',array(
		'label'	=> __('Slider Content Padding Top Bottom','vw-fitness-gym'),
		'description'	=> __('Enter a value in %. Example:20%','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '50%', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_fitness_gym_default_slider'
	));

	$wp_customize->add_setting('vw_fitness_gym_slider_content_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_slider_content_padding_left_right',array(
		'label'	=> __('Slider Content Padding Left Right','vw-fitness-gym'),
		'description'	=> __('Enter a value in %. Example:20%','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '50%', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_fitness_gym_default_slider'
	));

    //Slider excerpt
	$wp_customize->add_setting( 'vw_fitness_gym_slider_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_slidersettings',
		'type'        => 'range',
		'settings'    => 'vw_fitness_gym_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
		'active_callback' => 'vw_fitness_gym_default_slider'
	) );

	//Slider height
	$wp_customize->add_setting('vw_fitness_gym_slider_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_slider_height',array(
		'label'	=> __('Slider Height','vw-fitness-gym'),
		'description'	=> __('Specify the slider height (px).','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '500px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_fitness_gym_default_slider'
	));

	$wp_customize->add_setting( 'vw_fitness_gym_slider_speed', array(
		'default'  => 4000,
		'sanitize_callback'	=> 'vw_fitness_gym_sanitize_float'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_slider_speed', array(
		'label' => esc_html__('Slider Transition Speed','vw-fitness-gym'),
		'section' => 'vw_fitness_gym_slidersettings',
		'type'  => 'number',
		'active_callback' => 'vw_fitness_gym_default_slider'
	) );

	//Opacity
	$wp_customize->add_setting('vw_fitness_gym_slider_opacity_color',array(
      'default'              => 0.2,
      'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));

	$wp_customize->add_control( 'vw_fitness_gym_slider_opacity_color', array(
	'label'       => esc_html__( 'Slider Image Opacity','vw-fitness-gym' ),
	'section'     => 'vw_fitness_gym_slidersettings',
	'type'        => 'select',
	'settings'    => 'vw_fitness_gym_slider_opacity_color',
	'choices' => array(
      '0' =>  esc_attr('0','vw-fitness-gym'),
      '0.1' =>  esc_attr('0.1','vw-fitness-gym'),
      '0.2' =>  esc_attr('0.2','vw-fitness-gym'),
      '0.3' =>  esc_attr('0.3','vw-fitness-gym'),
      '0.4' =>  esc_attr('0.4','vw-fitness-gym'),
      '0.5' =>  esc_attr('0.5','vw-fitness-gym'),
      '0.6' =>  esc_attr('0.6','vw-fitness-gym'),
      '0.7' =>  esc_attr('0.7','vw-fitness-gym'),
      '0.8' =>  esc_attr('0.8','vw-fitness-gym'),
      '0.9' =>  esc_attr('0.9','vw-fitness-gym')
	),
	'active_callback' => 'vw_fitness_gym_default_slider'
	));

	$wp_customize->add_setting( 'vw_fitness_gym_slider_image_overlay',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
   ));
   	$wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_slider_image_overlay',array(
      	'label' => esc_html__( 'Show / Hide Slider Image Overlay','vw-fitness-gym' ),
      	'section' => 'vw_fitness_gym_slidersettings',
      	'active_callback' => 'vw_fitness_gym_default_slider'
   )));

   	$wp_customize->add_setting('vw_fitness_gym_slider_image_overlay_color', array(
		'default'           => '#191a1f',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_fitness_gym_slider_image_overlay_color', array(
		'label'    => __('Slider Image Overlay Color', 'vw-fitness-gym'),
		'section'  => 'vw_fitness_gym_slidersettings',
		'active_callback' => 'vw_fitness_gym_default_slider'
	)));

	$wp_customize->add_setting( 'vw_fitness_gym_slider_arrow_hide_show',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
	));
	$wp_customize->add_control( new vw_fitness_gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_slider_arrow_hide_show',array(
		'label' => esc_html__( 'Show / Hide Slider Arrows','vw-fitness-gym' ),
		'section' => 'vw_fitness_gym_slidersettings',
		'active_callback' => 'vw_fitness_gym_default_slider'
	)));

	$wp_customize->add_setting('vw_fitness_gym_slider_prev_icon',array(
		'default'	=> 'fas fa-angle-left',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_slider_prev_icon',array(
		'label'	=> __('Add Slider Prev Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_slidersettings',
		'setting'	=> 'vw_fitness_gym_slider_prev_icon',
		'type'		=> 'icon',
		'active_callback' => 'vw_fitness_gym_default_slider'
	)));

	$wp_customize->add_setting('vw_fitness_gym_slider_next_icon',array(
		'default'	=> 'fas fa-angle-right',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_slider_next_icon',array(
		'label'	=> __('Add Slider Next Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_slidersettings',
		'setting'	=> 'vw_fitness_gym_slider_next_icon',
		'type'		=> 'icon',
		'active_callback' => 'vw_fitness_gym_default_slider'
	)));
    
	//About Us section
	$wp_customize->add_section( 'vw_fitness_gym_about_section' , array(
    	'title'      => __( 'About us Settings', 'vw-fitness-gym' ),
    	'description' => "For more options of about section </br><a class='go-pro-btn' target='_blank' href='". esc_url(VW_FITNESS_GYM_GO_PRO) ." '>GET PRO</a>",
		'priority'   => null,
		'panel' => 'vw_fitness_gym_homepage_panel'
	) );

   	// About Background color
	$wp_customize->add_setting('vw_fitness_gym_about_background_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_fitness_gym_about_background_color', array(
		'label'    => __('About Background Color', 'vw-fitness-gym'),
		'section'  => 'vw_fitness_gym_about_section',
	)));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_fitness_gym_section_title', array( 
		'selector' => '#about-us h2', 
		'render_callback' => 'vw_fitness_gym_customize_partial_vw_fitness_gym_section_title',
	));

	$wp_customize->add_setting('vw_fitness_gym_section_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_section_title',array(
		'label'	=> __('Add Section Title','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( 'ABOUT US', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_about_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_sectio_sub_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_sectio_sub_title',array(
		'label'	=> __('Add Section Sub Title','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( 'WELCOME TO THE FITNESS', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_about_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_about_image',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,
       'vw_fitness_gym_about_image',
       array(
       'label' => __('Section Image','vw-fitness-gym'),
       'section' => 'vw_fitness_gym_about_section',
       'settings' => 'vw_fitness_gym_about_image',
    )));

    $categories = get_categories();
	$cat_post = array();
	$cat_post[]= 'select';
	$i = 0;	
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_fitness_gym_services',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vw_fitness_gym_sanitize_choices',
	));
	$wp_customize->add_control('vw_fitness_gym_services',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display services','vw-fitness-gym'),
		'description' => __('Image Size (70 x 70)','vw-fitness-gym'),
		'section' => 'vw_fitness_gym_about_section',
	));

	//Services excerpt
	$wp_customize->add_setting( 'vw_fitness_gym_services_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_services_excerpt_number', array(
		'label'       => esc_html__( 'Services Excerpt length','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_about_section',
		'type'        => 'range',
		'settings'    => 'vw_fitness_gym_services_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	// Our Classes Section
	$wp_customize->add_section('vw_fitness_gym_our_classes', array(
		'title'       => __('Our Classes Section', 'vw-fitness-gym'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-fitness-gym'),
		'priority'    => null,
		'panel'       => 'vw_fitness_gym_homepage_panel',
	));

	$wp_customize->add_setting('vw_fitness_gym_our_classes_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_our_classes_text',array(
		'description' => __('<p>1. More options for Our Classes section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Our Classes section.</p>','vw-fitness-gym'),
		'section'=> 'vw_fitness_gym_our_classes',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_fitness_gym_our_classes_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_our_classes_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_FITNESS_GYM_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_fitness_gym_our_classes',
		'type'=> 'hidden'
	));

	// Fitness Classes Section
	$wp_customize->add_section('vw_fitness_gym_fitness_classes', array(
		'title'       => __('Fitness Classes Section', 'vw-fitness-gym'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-fitness-gym'),
		'priority'    => null,
		'panel'       => 'vw_fitness_gym_homepage_panel',
	));

	$wp_customize->add_setting('vw_fitness_gym_fitness_classes_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_fitness_classes_text',array(
		'description' => __('<p>1. More options for Fitness Classes section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Fitness Classes section.</p>','vw-fitness-gym'),
		'section'=> 'vw_fitness_gym_fitness_classes',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_fitness_gym_fitness_classes_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_fitness_classes_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_FITNESS_GYM_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_fitness_gym_fitness_classes',
		'type'=> 'hidden'
	));

	// Workout Timing Section
	$wp_customize->add_section('vw_fitness_gym_working_time', array(
		'title'       => __('Workout Timing Section', 'vw-fitness-gym'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-fitness-gym'),
		'priority'    => null,
		'panel'       => 'vw_fitness_gym_homepage_panel',
	));

	$wp_customize->add_setting('vw_fitness_gym_working_time_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_working_time_text',array(
		'description' => __('<p>1. More options for Workout Timing section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Workout Timing section.</p>','vw-fitness-gym'),
		'section'=> 'vw_fitness_gym_working_time',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_fitness_gym_working_time_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_working_time_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_FITNESS_GYM_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_fitness_gym_working_time',
		'type'=> 'hidden'
	));

	// Fun Fact Section
	$wp_customize->add_section('vw_fitness_gym_fun_fact', array(
		'title'       => __('Fun Fact Section', 'vw-fitness-gym'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-fitness-gym'),
		'priority'    => null,
		'panel'       => 'vw_fitness_gym_homepage_panel',
	));

	$wp_customize->add_setting('vw_fitness_gym_fun_fact_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_fun_fact_text',array(
		'description' => __('<p>1. More options for Fun Fact section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Fun Fact section.</p>','vw-fitness-gym'),
		'section'=> 'vw_fitness_gym_fun_fact',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_fitness_gym_fun_fact_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_fun_fact_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_FITNESS_GYM_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_fitness_gym_fun_fact',
		'type'=> 'hidden'
	));

	// Our Products Section
	$wp_customize->add_section('vw_fitness_gym_our_products', array(
		'title'       => __('Our Products Section', 'vw-fitness-gym'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-fitness-gym'),
		'priority'    => null,
		'panel'       => 'vw_fitness_gym_homepage_panel',
	));

	$wp_customize->add_setting('vw_fitness_gym_our_products_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_our_products_text',array(
		'description' => __('<p>1. More options for Our Products section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Our Products section.</p>','vw-fitness-gym'),
		'section'=> 'vw_fitness_gym_our_products',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_fitness_gym_our_products_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_our_products_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_FITNESS_GYM_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_fitness_gym_our_products',
		'type'=> 'hidden'
	));

	// Pricing Plan Section
	$wp_customize->add_section('vw_fitness_gym_pricing_plan', array(
		'title'       => __('Pricing Plan Section', 'vw-fitness-gym'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-fitness-gym'),
		'priority'    => null,
		'panel'       => 'vw_fitness_gym_homepage_panel',
	));

	$wp_customize->add_setting('vw_fitness_gym_pricing_plan_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_pricing_plan_text',array(
		'description' => __('<p>1. More options for Pricing Plan section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Pricing Plan section.</p>','vw-fitness-gym'),
		'section'=> 'vw_fitness_gym_pricing_plan',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_fitness_gym_pricing_plan_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_pricing_plan_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_FITNESS_GYM_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_fitness_gym_pricing_plan',
		'type'=> 'hidden'
	));

	// Our Team Section
	$wp_customize->add_section('vw_fitness_gym_our_team', array(
		'title'       => __('Our Team Section', 'vw-fitness-gym'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-fitness-gym'),
		'priority'    => null,
		'panel'       => 'vw_fitness_gym_homepage_panel',
	));

	$wp_customize->add_setting('vw_fitness_gym_our_team_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_our_team_text',array(
		'description' => __('<p>1. More options for Our Team section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Our Team section.</p>','vw-fitness-gym'),
		'section'=> 'vw_fitness_gym_our_team',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_fitness_gym_our_team_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_our_team_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_FITNESS_GYM_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_fitness_gym_our_team',
		'type'=> 'hidden'
	));

	// Testimonial Section
	$wp_customize->add_section('vw_fitness_gym_testimonial', array(
		'title'       => __('Testimonial Section', 'vw-fitness-gym'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-fitness-gym'),
		'priority'    => null,
		'panel'       => 'vw_fitness_gym_homepage_panel',
	));

	$wp_customize->add_setting('vw_fitness_gym_testimonial_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_testimonial_text',array(
		'description' => __('<p>1. More options for Testimonial section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Testimonial section.</p>','vw-fitness-gym'),
		'section'=> 'vw_fitness_gym_testimonial',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_fitness_gym_testimonial_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_testimonial_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_FITNESS_GYM_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_fitness_gym_testimonial',
		'type'=> 'hidden'
	));

	// Our Blog Section
	$wp_customize->add_section('vw_fitness_gym_our_blog', array(
		'title'       => __('Our Blog Section', 'vw-fitness-gym'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-fitness-gym'),
		'priority'    => null,
		'panel'       => 'vw_fitness_gym_homepage_panel',
	));

	$wp_customize->add_setting('vw_fitness_gym_our_blog_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_our_blog_text',array(
		'description' => __('<p>1. More options for Our Blog section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Our Blog section.</p>','vw-fitness-gym'),
		'section'=> 'vw_fitness_gym_our_blog',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_fitness_gym_our_blog_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_our_blog_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_FITNESS_GYM_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_fitness_gym_our_blog',
		'type'=> 'hidden'
	));

	//Footer Text
	$wp_customize->add_section('vw_fitness_gym_footer',array(
		'title'	=> __('Footer Settings','vw-fitness-gym'),
		'description' => "For more options of footer section </br><a class='go-pro-btn' target='_blank' href='". esc_url(VW_FITNESS_GYM_GO_PRO) ." '>GET PRO</a>",
		'panel' => 'vw_fitness_gym_homepage_panel',
	));	

	$wp_customize->add_setting( 'vw_fitness_gym_footer_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ));
    $wp_customize->add_control( new vw_fitness_gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_footer_hide_show',array(
      'label' => esc_html__( 'Show / Hide Footer','vw-fitness-gym' ),
      'section' => 'vw_fitness_gym_footer'
    )));

	// font size
	$wp_customize->add_setting('vw_fitness_gym_button_footer_font_size',array(
		'default'=> 30,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_button_footer_font_size',array(
		'label'	=> __('Footer Heading Font Size','vw-fitness-gym'),
  		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'vw_fitness_gym_footer',
	));

	$wp_customize->add_setting('vw_fitness_gym_button_footer_heading_letter_spacing',array(
		'default'=> 1,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_button_footer_heading_letter_spacing',array(
		'label'	=> __('Heading Letter Spacing','vw-fitness-gym'),
  		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
	),
		'section'=> 'vw_fitness_gym_footer',
	));

	// text trasform
	$wp_customize->add_setting('vw_fitness_gym_button_footer_text_transform',array(
		'default'=> 'Capitalize',
		'sanitize_callback'	=> 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_button_footer_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Heading Text Transform','vw-fitness-gym'),
		'choices' => array(
      'Uppercase' => __('Uppercase','vw-fitness-gym'),
      'Capitalize' => __('Capitalize','vw-fitness-gym'),
      'Lowercase' => __('Lowercase','vw-fitness-gym'),
    ),
		'section'=> 'vw_fitness_gym_footer',
	));

	$wp_customize->add_setting('vw_fitness_gym_footer_heading_weight',array(
        'default' => 600,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_footer_heading_weight',array(
        'type' => 'select',
        'label' => __('Heading Font Weight','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_footer',
        'choices' => array(
        	'100' => __('100','vw-fitness-gym'),
            '200' => __('200','vw-fitness-gym'),
            '300' => __('300','vw-fitness-gym'),
            '400' => __('400','vw-fitness-gym'),
            '500' => __('500','vw-fitness-gym'),
            '600' => __('600','vw-fitness-gym'),
            '700' => __('700','vw-fitness-gym'),
            '800' => __('800','vw-fitness-gym'),
            '900' => __('900','vw-fitness-gym'),
        ),
	) );


   $wp_customize->add_setting('vw_fitness_gym_footer_template',array(
      'default'	=> esc_html('vw_fitness_gym-footer-one'),
      'sanitize_callback'	=> 'vw_fitness_gym_sanitize_choices'
  ));
  $wp_customize->add_control('vw_fitness_gym_footer_template',array(
          'label'	=> esc_html__('Footer style','vw-fitness-gym'),
          'section'	=> 'vw_fitness_gym_footer',
          'setting'	=> 'vw_fitness_gym_footer_template',
          'type' => 'select',
          'choices' => array(
              'vw_fitness_gym-footer-one' => esc_html__('Style 1', 'vw-fitness-gym'),
              'vw_fitness_gym-footer-two' => esc_html__('Style 2', 'vw-fitness-gym'),
              'vw_fitness_gym-footer-three' => esc_html__('Style 3', 'vw-fitness-gym'),
              'vw_fitness_gym-footer-four' => esc_html__('Style 4', 'vw-fitness-gym'),
              'vw_fitness_gym-footer-five' => esc_html__('Style 5', 'vw-fitness-gym'),
              )
  ));

	$wp_customize->add_setting('vw_fitness_gym_footer_background_color', array(
		'default'           => '#191a1f',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_fitness_gym_footer_background_color', array(
		'label'    => __('Footer Background Color', 'vw-fitness-gym'),
		'section'  => 'vw_fitness_gym_footer',
	)));

	$wp_customize->add_setting('vw_fitness_gym_footer_background_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'vw_fitness_gym_footer_background_image',array(
        'label' => __('Footer Background Image','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_footer'
	)));

	$wp_customize->add_setting('vw_fitness_gym_footer_img_position',array(
	  'default' => 'center center',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_footer_img_position',array(
		'type' => 'select',
		'label' => __('Footer Image Position','vw-fitness-gym'),
		'section' => 'vw_fitness_gym_footer',
		'choices' 	=> array(
			'left top' 		=> esc_html__( 'Top Left', 'vw-fitness-gym' ),
			'center top'   => esc_html__( 'Top', 'vw-fitness-gym' ),
			'right top'   => esc_html__( 'Top Right', 'vw-fitness-gym' ),
			'left center'   => esc_html__( 'Left', 'vw-fitness-gym' ),
			'center center'   => esc_html__( 'Center', 'vw-fitness-gym' ),
			'right center'   => esc_html__( 'Right', 'vw-fitness-gym' ),
			'left bottom'   => esc_html__( 'Bottom Left', 'vw-fitness-gym' ),
			'center bottom'   => esc_html__( 'Bottom', 'vw-fitness-gym' ),
			'right bottom'   => esc_html__( 'Bottom Right', 'vw-fitness-gym' ),
		),
	)); 

	// Footer
	$wp_customize->add_setting('vw_fitness_gym_img_footer',array(
		'default'=> 'scroll',
		'sanitize_callback'	=> 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_img_footer',array(
		'type' => 'select',
		'label'	=> __('Footer Background Attatchment','vw-fitness-gym'),
		'choices' => array(
            'fixed' => __('fixed','vw-fitness-gym'),
            'scroll' => __('scroll','vw-fitness-gym'),
        ),
		'section'=> 'vw_fitness_gym_footer',
	));

	$wp_customize->add_setting('vw_fitness_gym_footer_widgets_heading',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_footer_widgets_heading',array(
        'type' => 'select',
        'label' => __('Footer Widget Heading','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_footer',
        'choices' => array(
        	'Left' => __('Left','vw-fitness-gym'),
            'Center' => __('Center','vw-fitness-gym'),
            'Right' => __('Right','vw-fitness-gym')
        ),
	) );

	$wp_customize->add_setting('vw_fitness_gym_footer_widgets_content',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_footer_widgets_content',array(
        'type' => 'select',
        'label' => __('Footer Widget Content','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_footer',
        'choices' => array(
        	'Left' => __('Left','vw-fitness-gym'),
            'Center' => __('Center','vw-fitness-gym'),
            'Right' => __('Right','vw-fitness-gym')
        ),
	) );

	// footer padding
	$wp_customize->add_setting('vw_fitness_gym_footer_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_footer_padding',array(
		'label'	=> __('Footer Top Bottom Padding','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
      'placeholder' => __( '10px', 'vw-fitness-gym' ),
    ),
		'section'=> 'vw_fitness_gym_footer',
		'type'=> 'text'
	));

	// footer social icon
  	$wp_customize->add_setting( 'vw_fitness_gym_footer_icon',array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
  	$wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_footer_icon',array(
		'label' => esc_html__( 'Show / Hide Footer Social Icon','vw-fitness-gym' ),
		'section' => 'vw_fitness_gym_footer'
    ))); 

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_fitness_gym_footer_text', array( 
		'selector' => '#footer-2 .copyright p', 
		'render_callback' => 'vw_fitness_gym_customize_partial_vw_fitness_gym_footer_text', 
	));

	$wp_customize->add_setting( 'vw_fitness_gym_copyright_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ));
    $wp_customize->add_control( new vw_fitness_gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_copyright_hide_show',array(
      'label' => esc_html__( 'Show / Hide Copyright','vw-fitness-gym' ),
      'section' => 'vw_fitness_gym_footer'
    )));

	$wp_customize->add_setting('vw_fitness_gym_copyright_background_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_fitness_gym_copyright_background_color', array(
		'label'    => __('Copyright Background Color', 'vw-fitness-gym'),
		'section'  => 'vw_fitness_gym_footer',
	)));

	$wp_customize->add_setting('vw_fitness_gym_copyright_text_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_fitness_gym_copyright_text_color', array(
		'label'    => __('Copyright Text Color', 'vw-fitness-gym'),
		'section'  => 'vw_fitness_gym_footer',
	)));
	
	$wp_customize->add_setting('vw_fitness_gym_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_fitness_gym_footer_text',array(
		'label'	=> __('Copyright Text','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( 'Copyright 2019, .....', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_footer',
		'type'=> 'text'
	));	

	$wp_customize->add_setting('vw_fitness_gym_copyright_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_copyright_font_size',array(
		'label'	=> __('Copyright Font Size','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_copyright_font_weight',array(
	  'default' => 400,
	  'transport' => 'refresh',
	  'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_copyright_font_weight',array(
	    'type' => 'select',
	    'label' => __('Copyright Font Weight','vw-fitness-gym'),
	    'section' => 'vw_fitness_gym_footer',
	    'choices' => array(
	    	'100' => __('100','vw-fitness-gym'),
	        '200' => __('200','vw-fitness-gym'),
	        '300' => __('300','vw-fitness-gym'),
	        '400' => __('400','vw-fitness-gym'),
	        '500' => __('500','vw-fitness-gym'),
	        '600' => __('600','vw-fitness-gym'),
	        '700' => __('700','vw-fitness-gym'),
	        '800' => __('800','vw-fitness-gym'),
	        '900' => __('900','vw-fitness-gym'),
    ),
	));

	$wp_customize->add_setting('vw_fitness_gym_copyright_alingment',array(
        'default' => 'center',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Fitness_Gym_Image_Radio_Control($wp_customize, 'vw_fitness_gym_copyright_alingment', array(
        'type' => 'select',
        'label' => __('Copyright Alignment','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_footer',
        'settings' => 'vw_fitness_gym_copyright_alingment',
        'choices' => array(
            'left' => esc_url(get_template_directory_uri()).'/assets/images/copyright1.png',
            'center' => esc_url(get_template_directory_uri()).'/assets/images/copyright2.png',
            'right' => esc_url(get_template_directory_uri()).'/assets/images/copyright3.png'
    ))));

    $wp_customize->add_setting('vw_fitness_gym_copyright_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_copyright_padding_top_bottom',array(
		'label'	=> __('Copyright Padding Top Bottom','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_fitness_gym_hide_show_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_hide_show_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','vw-fitness-gym' ),
      	'section' => 'vw_fitness_gym_footer'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_fitness_gym_scroll_to_top_icon', array( 
		'selector' => '.scrollup i', 
		'render_callback' => 'vw_fitness_gym_customize_partial_vw_fitness_gym_scroll_to_top_icon', 
	));

    $wp_customize->add_setting('vw_fitness_gym_scroll_to_top_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_scroll_to_top_icon',array(
		'label'	=> __('Add Scroll to Top Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_footer',
		'setting'	=> 'vw_fitness_gym_scroll_to_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_fitness_gym_scroll_to_top_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_scroll_to_top_font_size',array(
		'label'	=> __('Icon Font Size','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_scroll_to_top_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_scroll_to_top_padding',array(
		'label'	=> __('Icon Top Bottom Padding','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_scroll_to_top_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_scroll_to_top_width',array(
		'label'	=> __('Icon Width','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_scroll_to_top_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_scroll_to_top_height',array(
		'label'	=> __('Icon Height','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_fitness_gym_scroll_to_top_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_scroll_to_top_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_footer',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_fitness_gym_scroll_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Fitness_Gym_Image_Radio_Control($wp_customize, 'vw_fitness_gym_scroll_top_alignment', array(
        'type' => 'select',
        'label' => __('Scroll To Top','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_footer',
        'settings' => 'vw_fitness_gym_scroll_top_alignment',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/layout3.png'
    ))));

	//Blog Post Settings
	$wp_customize->add_panel( 'vw_fitness_gym_blog_post_parent_panel', array(
		'title' => esc_html__( 'Blog Post Settings', 'vw-fitness-gym' ),
		'panel' => 'vw_fitness_gym_panel_id',
		'priority' => 20,
	));

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'vw_fitness_gym_post_settings', array(
		'title' => __( 'Post Settings', 'vw-fitness-gym' ),
		'panel' => 'vw_fitness_gym_blog_post_parent_panel',
	));

	//Blog layout
    $wp_customize->add_setting('vw_fitness_gym_blog_layout_option',array(
        'default' => 'Default',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
    ));
    $wp_customize->add_control(new VW_Fitness_Gym_Image_Radio_Control($wp_customize, 'vw_fitness_gym_blog_layout_option', array(
        'type' => 'select',
        'label' => __('Blog Layouts','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_post_settings',
        'choices' => array(
            'Default' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout2.png',
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout3.png',
    ))));

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_fitness_gym_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'	        
	) );
	$wp_customize->add_control('vw_fitness_gym_theme_options', array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-fitness-gym'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_post_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-fitness-gym'),
            'Right Sidebar' => __('Right Sidebar','vw-fitness-gym'),
            'One Column' => __('One Column','vw-fitness-gym'),
            'Three Columns' => __('Three Columns','vw-fitness-gym'),
            'Four Columns' => __('Four Columns','vw-fitness-gym'),
            'Grid Layout' => __('Grid Layout','vw-fitness-gym')
        ),
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_fitness_gym_toggle_postdate', array( 
		'selector' => '.post-main-box h2 a', 
		'render_callback' => 'vw_fitness_gym_customize_partial_vw_fitness_gym_toggle_postdate', 
	));

	$wp_customize->add_setting('vw_fitness_gym_toggle_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_toggle_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_post_settings',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_fitness_gym_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_toggle_postdate',array(
        'label' => esc_html__( 'Show / Hide Post Date','vw-fitness-gym' ),
        'section' => 'vw_fitness_gym_post_settings'
    )));

    $wp_customize->add_setting('vw_fitness_gym_toggle_author_icon',array(
		'default'	=> 'far fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_toggle_author_icon',array(
		'label'	=> __('Add Author Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_post_settings',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_fitness_gym_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_toggle_author',array(
		'label' => esc_html__( 'Show / Hide Author','vw-fitness-gym' ),
		'section' => 'vw_fitness_gym_post_settings'
    )));

    $wp_customize->add_setting('vw_fitness_gym_toggle_comments_icon',array(
		'default'	=> 'fas fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_toggle_comments_icon',array(
		'label'	=> __('Add Comments Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_post_settings',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_fitness_gym_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_toggle_comments',array(
		'label' => esc_html__( 'Show / Hide Comments','vw-fitness-gym' ),
		'section' => 'vw_fitness_gym_post_settings'
    )));

    $wp_customize->add_setting('vw_fitness_gym_toggle_time_icon',array(
		'default'	=> 'far fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_toggle_time_icon',array(
		'label'	=> __('Add Time Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_post_settings',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_fitness_gym_toggle_time',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_toggle_time',array(
		'label' => esc_html__( 'Show / Hide Time','vw-fitness-gym' ),
		'section' => 'vw_fitness_gym_post_settings'
    )));

    $wp_customize->add_setting( 'vw_fitness_gym_featured_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_featured_image_hide_show', array(
		'label' => esc_html__( 'Show / Hide Featured Image','vw-fitness-gym' ),
		'section' => 'vw_fitness_gym_post_settings'
    )));

    $wp_customize->add_setting( 'vw_fitness_gym_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_featured_image_border_radius', array(
		'label'       => esc_html__( 'Featured Image Border Radius','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_post_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_fitness_gym_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Featured Image Box Shadow','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_post_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Featured Image
	$wp_customize->add_setting('vw_fitness_gym_blog_post_featured_image_dimension',array(
	       'default' => 'default',
	       'sanitize_callback'	=> 'vw_fitness_gym_sanitize_choices'
	));
  	$wp_customize->add_control('vw_fitness_gym_blog_post_featured_image_dimension',array(
     'type' => 'select',
     'label'	=> __('Blog Post Featured Image Dimension','vw-fitness-gym'),
     'section'	=> 'vw_fitness_gym_post_settings',
     'choices' => array(
          'default' => __('Default','vw-fitness-gym'),
          'custom' => __('Custom Image Size','vw-fitness-gym'),
      ),
  	));

	$wp_customize->add_setting('vw_fitness_gym_blog_post_featured_image_custom_width',array(
			'default'=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
		));
	$wp_customize->add_control('vw_fitness_gym_blog_post_featured_image_custom_width',array(
			'label'	=> __('Featured Image Custom Width','vw-fitness-gym'),
			'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
			'input_attrs' => array(
	    'placeholder' => __( '10px', 'vw-fitness-gym' ),),
			'section'=> 'vw_fitness_gym_post_settings',
			'type'=> 'text',
			'active_callback' => 'vw_fitness_gym_blog_post_featured_image_dimension'
		));

	$wp_customize->add_setting('vw_fitness_gym_blog_post_featured_image_custom_height',array(
			'default'=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_blog_post_featured_image_custom_height',array(
			'label'	=> __('Featured Image Custom Height','vw-fitness-gym'),
			'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
			'input_attrs' => array(
	    'placeholder' => __( '10px', 'vw-fitness-gym' ),),
			'section'=> 'vw_fitness_gym_post_settings',
			'type'=> 'text',
			'active_callback' => 'vw_fitness_gym_blog_post_featured_image_dimension'
	));

    $wp_customize->add_setting( 'vw_fitness_gym_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_post_settings',
		'type'        => 'range',
		'settings'    => 'vw_fitness_gym_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_fitness_gym_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','vw-fitness-gym'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','vw-fitness-gym'),
		'section'=> 'vw_fitness_gym_post_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('vw_fitness_gym_blog_page_posts_settings',array(
        'default' => 'Into Blocks',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_blog_page_posts_settings',array(
        'type' => 'select',
        'label' => __('Display Blog Posts','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_post_settings',
        'choices' => array(
        	'Into Blocks' => __('Into Blocks','vw-fitness-gym'),
            'Without Blocks' => __('Without Blocks','vw-fitness-gym')
        ),
	) );

    $wp_customize->add_setting('vw_fitness_gym_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_excerpt_settings',array(
        'type' => 'select',
        'label' => __('Post Content','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_post_settings',
        'choices' => array(
        	'Content' => __('Content','vw-fitness-gym'),
            'Excerpt' => __('Excerpt','vw-fitness-gym'),
            'No Content' => __('No Content','vw-fitness-gym')
        ),
	) );

	$wp_customize->add_setting('vw_fitness_gym_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '[...]', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_post_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_fitness_gym_blog_pagination_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_blog_pagination_hide_show',array(
      'label' => esc_html__( 'Show / Hide Blog Pagination','vw-fitness-gym' ),
      'section' => 'vw_fitness_gym_post_settings'
    )));

	$wp_customize->add_setting( 'vw_fitness_gym_blog_pagination_type', array(
        'default'			=> 'blog-page-numbers',
        'sanitize_callback'	=> 'vw_fitness_gym_sanitize_choices'
    ));
    $wp_customize->add_control( 'vw_fitness_gym_blog_pagination_type', array(
        'section' => 'vw_fitness_gym_post_settings',
        'type' => 'select',
        'label' => __( 'Blog Pagination', 'vw-fitness-gym' ),
        'choices'		=> array(
            'blog-page-numbers'  => __( 'Numeric', 'vw-fitness-gym' ),
            'next-prev' => __( 'Older Posts/Newer Posts', 'vw-fitness-gym' ),
    )));

    // Button Settings
	$wp_customize->add_section( 'vw_fitness_gym_button_settings', array(
		'title' => __( 'Button Settings', 'vw-fitness-gym' ),
		'panel' => 'vw_fitness_gym_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_fitness_gym_button_text', array( 
		'selector' => '.post-main-box .more-btn a', 
		'render_callback' => 'vw_fitness_gym_customize_partial_vw_fitness_gym_button_text', 
	));

    $wp_customize->add_setting('vw_fitness_gym_button_text',array(
		'default'=> esc_html__('Read More','vw-fitness-gym'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_button_text',array(
		'label'	=> __('Add Button Text','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( 'Read More', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_button_settings',
		'type'=> 'text'
	));

	// font size button
	$wp_customize->add_setting('vw_fitness_gym_button_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_button_font_size',array(
		'label'	=> __('Button Font Size','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
      	'placeholder' => __( '10px', 'vw-fitness-gym' ),
    ),
    	'type'        => 'text',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'vw_fitness_gym_button_settings',
	));

	$wp_customize->add_setting( 'vw_fitness_gym_button_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_fitness_gym_button_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_button_padding_top_bottom',array(
		'label'	=> __('Padding Top Bottom','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_button_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_button_padding_left_right',array(
		'label'	=> __('Padding Left Right','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_button_settings',
		'type'=> 'text'
	));

	// text trasform
	$wp_customize->add_setting('vw_fitness_gym_button_text_transform',array(
		'default'=> 'Uppercase',
		'sanitize_callback'	=> 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_button_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Button Text Transform','vw-fitness-gym'),
		'choices' => array(
            'Uppercase' => __('Uppercase','vw-fitness-gym'),
            'Capitalize' => __('Capitalize','vw-fitness-gym'),
            'Lowercase' => __('Lowercase','vw-fitness-gym'),
        ),
		'section'=> 'vw_fitness_gym_button_settings',
	));

	// Related Post Settings
	$wp_customize->add_section( 'vw_fitness_gym_related_posts_settings', array(
		'title' => __( 'Related Posts Settings', 'vw-fitness-gym' ),
		'panel' => 'vw_fitness_gym_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_fitness_gym_related_post_title', array( 
		'selector' => '.related-post h3', 
		'render_callback' => 'vw_fitness_gym_customize_partial_vw_fitness_gym_related_post_title', 
	));

    $wp_customize->add_setting( 'vw_fitness_gym_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_related_post',array(
		'label' => esc_html__( 'Show / Hide Related Post','vw-fitness-gym' ),
		'section' => 'vw_fitness_gym_related_posts_settings'
    )));

    $wp_customize->add_setting('vw_fitness_gym_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_related_post_title',array(
		'label'	=> __('Add Related Post Title','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( 'Related Post', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('vw_fitness_gym_related_posts_count',array(
		'default'=> '3',
		'sanitize_callback'	=> 'vw_fitness_gym_sanitize_float'
	));
	$wp_customize->add_control('vw_fitness_gym_related_posts_count',array(
		'label'	=> __('Add Related Post Count','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '3', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_related_posts_settings',
		'type'=> 'number'
	));

	$wp_customize->add_setting( 'vw_fitness_gym_related_posts_excerpt_number', array(
		'default'              => 20,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_related_posts_excerpt_number', array(
		'label'       => esc_html__( 'Related Posts Excerpt length','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_related_posts_settings',
		'type'        => 'range',
		'settings'    => 'vw_fitness_gym_related_posts_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		), 
	) );

	// Single Posts Settings
	$wp_customize->add_section( 'vw_fitness_gym_single_blog_settings', array(
		'title' => __( 'Single Post Settings', 'vw-fitness-gym' ),
		'panel' => 'vw_fitness_gym_blog_post_parent_panel',
	));

  	$wp_customize->add_setting('vw_fitness_gym_single_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_single_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_single_blog_settings',
		'setting'	=> 'vw_fitness_gym_single_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_fitness_gym_single_postdate',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_single_postdate',array(
	    'label' => esc_html__( 'Show / Hide Date','vw-fitness-gym' ),
	   'section' => 'vw_fitness_gym_single_blog_settings'
	)));

	$wp_customize->add_setting('vw_fitness_gym_single_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_single_author_icon',array(
		'label'	=> __('Add Author Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_single_blog_settings',
		'setting'	=> 'vw_fitness_gym_single_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_fitness_gym_single_author',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_single_author',array(
	    'label' => esc_html__( 'Show / Hide Author','vw-fitness-gym' ),
	    'section' => 'vw_fitness_gym_single_blog_settings'
	)));

   	$wp_customize->add_setting('vw_fitness_gym_single_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_single_comments_icon',array(
		'label'	=> __('Add Comments Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_single_blog_settings',
		'setting'	=> 'vw_fitness_gym_single_comments_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_fitness_gym_single_comments',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_single_comments',array(
	    'label' => esc_html__( 'Show / Hide Comments','vw-fitness-gym' ),
	    'section' => 'vw_fitness_gym_single_blog_settings'
	)));

  	$wp_customize->add_setting('vw_fitness_gym_single_time_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_single_time_icon',array(
		'label'	=> __('Add Time Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_single_blog_settings',
		'setting'	=> 'vw_fitness_gym_single_time_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_fitness_gym_single_time',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
	) );

	$wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_single_time',array(
	    'label' => esc_html__( 'Show / Hide Time','vw-fitness-gym' ),
	    'section' => 'vw_fitness_gym_single_blog_settings'
	)));

	$wp_customize->add_setting( 'vw_fitness_gym_single_post_breadcrumb',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_single_post_breadcrumb',array(
		'label' => esc_html__( 'Show / Hide Breadcrumb','vw-fitness-gym' ),
		'section' => 'vw_fitness_gym_single_blog_settings'
    )));

    // Single Posts Category
  	$wp_customize->add_setting( 'vw_fitness_gym_single_post_category',array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
  	$wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_single_post_category',array(
		'label' => esc_html__( 'Show / Hide Category','vw-fitness-gym' ),
		'section' => 'vw_fitness_gym_single_blog_settings'
    )));

	$wp_customize->add_setting( 'vw_fitness_gym_toggle_tags',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_toggle_tags', array(
		'label' => esc_html__( 'Show / Hide Tags','vw-fitness-gym' ),
		'section' => 'vw_fitness_gym_single_blog_settings'
    )));

  	$wp_customize->add_setting( 'vw_fitness_gym_single_blog_post_navigation_show_hide',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_single_blog_post_navigation_show_hide', array(
		'label' => esc_html__( 'Show / Hide Post Navigation','vw-fitness-gym' ),
		'section' => 'vw_fitness_gym_single_blog_settings'
    )));

    $wp_customize->add_setting( 'vw_fitness_gym_singlepost_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_singlepost_image_box_shadow', array(
		'label'       => esc_html__( 'Single post Image Box Shadow','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_single_blog_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_fitness_gym_single_post_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_single_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','vw-fitness-gym'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','vw-fitness-gym'),
		'section'=> 'vw_fitness_gym_single_blog_settings',
		'type'=> 'text'
	));

	//navigation text
	$wp_customize->add_setting('vw_fitness_gym_single_blog_prev_navigation_text',array(
		'default'=> 'PREVIOUS',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_single_blog_prev_navigation_text',array(
		'label'	=> __('Post Navigation Text','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( 'PREVIOUS', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_single_blog_next_navigation_text',array(
		'default'=> 'NEXT',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_single_blog_next_navigation_text',array(
		'label'	=> __('Post Navigation Text','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( 'NEXT', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_single_blog_comment_title',array(
		'default'=> 'Leave a Reply',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_fitness_gym_single_blog_comment_title',array(
		'label'	=> __('Add Comment Title','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( 'Leave a Reply', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_single_blog_comment_button_text',array(
		'default'=> 'Post Comment',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_fitness_gym_single_blog_comment_button_text',array(
		'label'	=> __('Add Comment Button Text','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( 'Post Comment', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_single_blog_comment_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_single_blog_comment_width',array(
		'label'	=> __('Comment Form Width','vw-fitness-gym'),
		'description'	=> __('Enter a value in %. Example:50%','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '100%', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_single_blog_settings',
		'type'=> 'text'
	));

	// Grid layout setting
	$wp_customize->add_section( 'vw_fitness_gym_grid_layout_settings', array(
		'title' => __( 'Grid Layout Settings', 'vw-fitness-gym' ),
		'panel' => 'vw_fitness_gym_blog_post_parent_panel',
	));

  	$wp_customize->add_setting('vw_fitness_gym_grid_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_grid_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_grid_layout_settings',
		'setting'	=> 'vw_fitness_gym_grid_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_fitness_gym_grid_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_grid_postdate',array(
        'label' => esc_html__( 'Show / Hide Post Date','vw-fitness-gym' ),
        'section' => 'vw_fitness_gym_grid_layout_settings'
    )));

	$wp_customize->add_setting('vw_fitness_gym_grid_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_grid_author_icon',array(
		'label'	=> __('Add Author Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_grid_layout_settings',
		'setting'	=> 'vw_fitness_gym_grid_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_fitness_gym_grid_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_grid_author',array(
		'label' => esc_html__( 'Show / Hide Author','vw-fitness-gym' ),
		'section' => 'vw_fitness_gym_grid_layout_settings'
    )));

   	$wp_customize->add_setting('vw_fitness_gym_grid_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_grid_comments_icon',array(
		'label'	=> __('Add Comments Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_grid_layout_settings',
		'setting'	=> 'vw_fitness_gym_grid_comments_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_fitness_gym_grid_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_grid_comments',array(
		'label' => esc_html__( 'Show / Hide Comments','vw-fitness-gym' ),
		'section' => 'vw_fitness_gym_grid_layout_settings'
    )));

    $wp_customize->add_setting( 'vw_fitness_gym_grid_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
	));
  	$wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_grid_image_hide_show', array(
		'label' => esc_html__( 'Show / Hide Featured Image','vw-fitness-gym' ),
		'section' => 'vw_fitness_gym_grid_layout_settings'
  	)));

	$wp_customize->add_setting('vw_fitness_gym_grid_post_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_grid_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','vw-fitness-gym'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','vw-fitness-gym'),
		'section'=> 'vw_fitness_gym_grid_layout_settings',
		'type'=> 'text'
	));

	 $wp_customize->add_setting( 'vw_fitness_gym_grid_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_fitness_gym_grid_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_grid_layout_settings',
		'type'        => 'range',
		'settings'    => 'vw_fitness_gym_grid_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

    $wp_customize->add_setting('vw_fitness_gym_display_grid_posts_settings',array(
        'default' => 'Into Blocks',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_display_grid_posts_settings',array(
        'type' => 'select',
        'label' => __('Display Grid Posts','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_grid_layout_settings',
        'choices' => array(
        	'Into Blocks' => __('Into Blocks','vw-fitness-gym'),
            'Without Blocks' => __('Without Blocks','vw-fitness-gym')
        ),
	) );

	$wp_customize->add_setting('vw_fitness_gym_grid_button_text',array(
		'default'=> esc_html__('Read More','vw-fitness-gym'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_grid_button_text',array(
		'label'	=> esc_html__('Add Button Text','vw-fitness-gym'),
		'input_attrs' => array(
        'placeholder' => esc_html__( 'Read More', 'vw-fitness-gym' ),
      ),
		'section'=> 'vw_fitness_gym_grid_layout_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_grid_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_grid_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '[...]', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_grid_layout_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_grid_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_grid_excerpt_settings',array(
        'type' => 'select',
        'label' => esc_html__('Grid Post Content','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_grid_layout_settings',
        'choices' => array(
        	'Content' => esc_html__('Content','vw-fitness-gym'),
            'Excerpt' => esc_html__('Excerpt','vw-fitness-gym'),
            'No Content' => esc_html__('No Content','vw-fitness-gym')
        ),
	) );

	$wp_customize->add_setting( 'vw_fitness_gym_grid_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_grid_featured_image_border_radius', array(
		'label'       => esc_html__( 'Grid Featured Image Border Radius','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_grid_layout_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_fitness_gym_grid_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_grid_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Grid Featured Image Box Shadow','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_grid_layout_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Others Settings
	$wp_customize->add_panel( 'vw_fitness_gym_others_panel', array(
		'title' => esc_html__( 'Others Settings', 'vw-fitness-gym' ),
		'panel' => 'vw_fitness_gym_panel_id',
		'priority' => 20,
	));

	// Layout
	$wp_customize->add_section( 'vw_fitness_gym_left_right', array(
    	'title'      => esc_html__( 'General Settings', 'vw-fitness-gym' ),
		'panel' => 'vw_fitness_gym_others_panel'
	) );

	$wp_customize->add_setting('vw_fitness_gym_width_option',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Fitness_Gym_Image_Radio_Control($wp_customize, 'vw_fitness_gym_width_option', array(
        'type' => 'select',
        'label' => __('Width Layouts','vw-fitness-gym'),
        'description' => __('Here you can change the width layout of Website.','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_left_right',
        'choices' => array(
            'Full Width' => esc_url(get_template_directory_uri()).'/assets/images/full-width.png',
            'Wide Width' => esc_url(get_template_directory_uri()).'/assets/images/wide-width.png',
            'Boxed' => esc_url(get_template_directory_uri()).'/assets/images/boxed-width.png',
    ))));

	$wp_customize->add_setting('vw_fitness_gym_page_layout',array(
        'default' => 'One Column',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-fitness-gym'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-fitness-gym'),
            'Right Sidebar' => __('Right Sidebar','vw-fitness-gym'),
            'One Column' => __('One Column','vw-fitness-gym')
        ),
	) );

	$wp_customize->add_setting( 'vw_fitness_gym_single_page_breadcrumb',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_single_page_breadcrumb',array(
		'label' => esc_html__( 'Show / Hide Page Breadcrumb','vw-fitness-gym' ),
		'section' => 'vw_fitness_gym_left_right'
    )));

	//Wow Animation
	$wp_customize->add_setting( 'vw_fitness_gym_animation',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_animation',array(
        'label' => esc_html__( 'Show / Hide Animations','vw-fitness-gym' ),
        'description' => __('Here you can disable overall site animation effect','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_left_right'
    )));

	//Pre-Loader
	$wp_customize->add_setting( 'vw_fitness_gym_loader_enable',array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_loader_enable',array(
        'label' => esc_html__( 'Show / Hide Pre-Loader','vw-fitness-gym' ),
        'section' => 'vw_fitness_gym_left_right'
    )));

	$wp_customize->add_setting('vw_fitness_gym_preloader_bg_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_fitness_gym_preloader_bg_color', array(
		'label'    => __('Pre-Loader Background Color', 'vw-fitness-gym'),
		'section'  => 'vw_fitness_gym_left_right',
	)));

	$wp_customize->add_setting('vw_fitness_gym_preloader_border_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_fitness_gym_preloader_border_color', array(
		'label'    => __('Pre-Loader Border Color', 'vw-fitness-gym'),
		'section'  => 'vw_fitness_gym_left_right',
	)));

	$wp_customize->add_setting('vw_fitness_gym_preloader_bg_img',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'vw_fitness_gym_preloader_bg_img',array(
        'label' => __('Preloader Background Image','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_left_right'
	)));

	$wp_customize->add_setting('vw_fitness_gym_breadcrumbs_alignment',array(
        'default' => 'Left',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_breadcrumbs_alignment',array(
        'type' => 'select',
        'label' => __('Breadcrumbs Alignment','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_left_right',
        'choices' => array(
            'Left' => __('Left','vw-fitness-gym'),
            'Right' => __('Right','vw-fitness-gym'),
            'Center' => __('Center','vw-fitness-gym'),
        ),
	) );

    //404 Page Setting
	$wp_customize->add_section('vw_fitness_gym_404_page',array(
		'title'	=> __('404 Page Settings','vw-fitness-gym'),
		'panel' => 'vw_fitness_gym_others_panel',
	));	

	$wp_customize->add_setting('vw_fitness_gym_404_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_fitness_gym_404_page_title',array(
		'label'	=> __('Add Title','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '404 Not Found', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_404_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_fitness_gym_404_page_content',array(
		'label'	=> __('Add Text','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( 'Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_404_page_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_404_page_button_text',array(
		'label'	=> __('Add Button Text','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( 'GO BACK', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_404_page',
		'type'=> 'text'
	));

	//No Result Page Setting
	$wp_customize->add_section('vw_fitness_gym_no_results_page',array(
		'title'	=> __('No Results Page Settings','vw-fitness-gym'),
		'panel' => 'vw_fitness_gym_others_panel',
	));	

	$wp_customize->add_setting('vw_fitness_gym_no_results_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_fitness_gym_no_results_page_title',array(
		'label'	=> __('Add Title','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( 'Nothing Found', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_no_results_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_no_results_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_fitness_gym_no_results_page_content',array(
		'label'	=> __('Add Text','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_no_results_page',
		'type'=> 'text'
	));

	//Social Icon Setting
	$wp_customize->add_section('vw_fitness_gym_social_icon_settings',array(
		'title'	=> __('Social Icons Settings','vw-fitness-gym'),
		'panel' => 'vw_fitness_gym_others_panel',
	));	

	$wp_customize->add_setting('vw_fitness_gym_social_icon_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_social_icon_font_size',array(
		'label'	=> __('Icon Font Size','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_social_icon_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_social_icon_padding',array(
		'label'	=> __('Icon Padding','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_social_icon_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_social_icon_width',array(
		'label'	=> __('Icon Width','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_social_icon_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_social_icon_height',array(
		'label'	=> __('Icon Height','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_fitness_gym_social_icon_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_social_icon_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_social_icon_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Responsive Media Settings
	$wp_customize->add_section('vw_fitness_gym_responsive_media',array(
		'title'	=> __('Responsive Media','vw-fitness-gym'),
		'panel' => 'vw_fitness_gym_others_panel',
	));

    $wp_customize->add_setting( 'vw_fitness_gym_stickyheader_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_stickyheader_hide_show',array(
      'label' => esc_html__( 'Show / Hide Sticky Header','vw-fitness-gym' ),
      'section' => 'vw_fitness_gym_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_fitness_gym_resp_slider_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_resp_slider_hide_show',array(
      'label' => esc_html__( 'Show / Hide Slider','vw-fitness-gym' ),
      'section' => 'vw_fitness_gym_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_fitness_gym_sidebar_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_sidebar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Sidebar','vw-fitness-gym' ),
      'section' => 'vw_fitness_gym_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_fitness_gym_responsive_preloader_hide',array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_responsive_preloader_hide',array(
        'label' => esc_html__( 'Show / Hide Preloader','vw-fitness-gym' ),
        'section' => 'vw_fitness_gym_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_fitness_gym_resp_scroll_top_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_resp_scroll_top_hide_show',array(
      'label' => esc_html__( 'Show / Hide Scroll To Top','vw-fitness-gym' ),
      'section' => 'vw_fitness_gym_responsive_media'
    )));

    $wp_customize->add_setting('vw_fitness_gym_res_open_menu_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_res_open_menu_icon',array(
		'label'	=> __('Add Open Menu Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_responsive_media',
		'setting'	=> 'vw_fitness_gym_res_open_menu_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_fitness_gym_res_close_menus_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Fitness_Gym_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_fitness_gym_res_close_menus_icon',array(
		'label'	=> __('Add Close Menu Icon','vw-fitness-gym'),
		'transport' => 'refresh',
		'section'	=> 'vw_fitness_gym_responsive_media',
		'setting'	=> 'vw_fitness_gym_res_close_menus_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_fitness_gym_resp_menu_toggle_btn_bg_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_fitness_gym_resp_menu_toggle_btn_bg_color', array(
		'label'    => __('Toggle Button Bg Color', 'vw-fitness-gym'),
		'section'  => 'vw_fitness_gym_responsive_media',
	)));

    //Woocommerce settings
	$wp_customize->add_section('vw_fitness_gym_woocommerce_section', array(
		'title'    => __('WooCommerce Layout', 'vw-fitness-gym'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

    //Shop Page Featured Image
	$wp_customize->add_setting( 'vw_fitness_gym_shop_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_shop_featured_image_border_radius', array(
		'label'       => esc_html__( 'Shop Page Featured Image Border Radius','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_fitness_gym_shop_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_shop_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Shop Page Featured Image Box Shadow','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_fitness_gym_woocommerce_shop_page_sidebar', array( 'selector' => '.post-type-archive-product #sidebar', 
		'render_callback' => 'vw_fitness_gym_customize_partial_vw_fitness_gym_woocommerce_shop_page_sidebar', ) );

    //Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'vw_fitness_gym_woocommerce_shop_page_sidebar',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Show / Hide Shop Page Sidebar','vw-fitness-gym' ),
		'section' => 'vw_fitness_gym_woocommerce_section'
    )));

    $wp_customize->add_setting('vw_fitness_gym_shop_page_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_shop_page_layout',array(
        'type' => 'select',
        'label' => __('Shop Page Sidebar Layout','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_woocommerce_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-fitness-gym'),
            'Right Sidebar' => __('Right Sidebar','vw-fitness-gym'),
        ),
	) );

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_fitness_gym_woocommerce_single_product_page_sidebar', array( 'selector' => '.single-product #sidebar', 
		'render_callback' => 'vw_fitness_gym_customize_partial_vw_fitness_gym_woocommerce_single_product_page_sidebar', ) );

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'vw_fitness_gym_woocommerce_single_product_page_sidebar',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Show / Hide Single Product Sidebar','vw-fitness-gym' ),
		'section' => 'vw_fitness_gym_woocommerce_section'
    )));

   	$wp_customize->add_setting('vw_fitness_gym_single_product_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_single_product_layout',array(
        'type' => 'select',
        'label' => __('Single Product Sidebar Layout','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_woocommerce_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-fitness-gym'),
            'Right Sidebar' => __('Right Sidebar','vw-fitness-gym'),
        ),
	) );

    //Products per page
    $wp_customize->add_setting('vw_fitness_gym_products_per_page',array(
		'default'=> '9',
		'sanitize_callback'	=> 'vw_fitness_gym_sanitize_float'
	));
	$wp_customize->add_control('vw_fitness_gym_products_per_page',array(
		'label'	=> __('Products Per Page','vw-fitness-gym'),
		'description' => __('Display on shop page','vw-fitness-gym'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'vw_fitness_gym_woocommerce_section',
		'type'=> 'number',
	));

    //Products per row
    $wp_customize->add_setting('vw_fitness_gym_products_per_row',array(
		'default'=> '3',
		'sanitize_callback'	=> 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_products_per_row',array(
		'label'	=> __('Products Per Row','vw-fitness-gym'),
		'description' => __('Display on shop page','vw-fitness-gym'),
		'choices' => array(
            '2' => '2',
			'3' => '3',
			'4' => '4',
        ),
		'section'=> 'vw_fitness_gym_woocommerce_section',
		'type'=> 'select',
	));

	//Products padding
	$wp_customize->add_setting('vw_fitness_gym_products_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_products_padding_top_bottom',array(
		'label'	=> __('Products Padding Top Bottom','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_products_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_products_padding_left_right',array(
		'label'	=> __('Products Padding Left Right','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_woocommerce_section',
		'type'=> 'text'
	));

	//Products box shadow
	$wp_customize->add_setting( 'vw_fitness_gym_products_box_shadow', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_products_box_shadow', array(
		'label'       => esc_html__( 'Products Box Shadow','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Products border radius
    $wp_customize->add_setting( 'vw_fitness_gym_products_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_products_border_radius', array(
		'label'       => esc_html__( 'Products Border Radius','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_fitness_gym_products_btn_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_products_btn_padding_top_bottom',array(
		'label'	=> __('Products Button Padding Top Bottom','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_products_btn_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_products_btn_padding_left_right',array(
		'label'	=> __('Products Button Padding Left Right','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_fitness_gym_products_button_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_products_button_border_radius', array(
		'label'       => esc_html__( 'Products Button Border Radius','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Products Sale Badge
	$wp_customize->add_setting('vw_fitness_gym_woocommerce_sale_position',array(
        'default' => 'right',
        'sanitize_callback' => 'vw_fitness_gym_sanitize_choices'
	));
	$wp_customize->add_control('vw_fitness_gym_woocommerce_sale_position',array(
        'type' => 'select',
        'label' => __('Sale Badge Position','vw-fitness-gym'),
        'section' => 'vw_fitness_gym_woocommerce_section',
        'choices' => array(
            'left' => __('Left','vw-fitness-gym'),
            'right' => __('Right','vw-fitness-gym'),
        ),
	) );

	$wp_customize->add_setting('vw_fitness_gym_woocommerce_sale_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_woocommerce_sale_font_size',array(
		'label'	=> __('Sale Font Size','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_woocommerce_sale_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_woocommerce_sale_padding_top_bottom',array(
		'label'	=> __('Sale Padding Top Bottom','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_fitness_gym_woocommerce_sale_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_fitness_gym_woocommerce_sale_padding_left_right',array(
		'label'	=> __('Sale Padding Left Right','vw-fitness-gym'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-fitness-gym'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-fitness-gym' ),
        ),
		'section'=> 'vw_fitness_gym_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_fitness_gym_woocommerce_sale_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_fitness_gym_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_fitness_gym_woocommerce_sale_border_radius', array(
		'label'       => esc_html__( 'Sale Border Radius','vw-fitness-gym' ),
		'section'     => 'vw_fitness_gym_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

    //Related Products
	$wp_customize->add_setting( 'vw_fitness_gym_related_product_show_hide',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_fitness_gym_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Fitness_Gym_Toggle_Switch_Custom_Control( $wp_customize, 'vw_fitness_gym_related_product_show_hide',array(
        'label' => esc_html__( 'Show / Hide Related product','vw-fitness-gym' ),
        'section' => 'vw_fitness_gym_woocommerce_section'
    )));

    // Has to be at the top
	$wp_customize->register_panel_type( 'VW_Fitness_Gym_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'VW_Fitness_Gym_WP_Customize_Section' );
}

add_action( 'customize_register', 'vw_fitness_gym_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class VW_Fitness_Gym_WP_Customize_Panel extends WP_Customize_Panel {
	    public $panel;
	    public $type = 'vw_fitness_gym_panel';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;
	      return $array;
    	}
  	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  	class VW_Fitness_Gym_WP_Customize_Section extends WP_Customize_Section {
	    public $section;
	    public $type = 'vw_fitness_gym_section';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;

	      if ( $this->panel ) {
	        $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
	      } else {
	        $array['customizeAction'] = 'Customizing';
	      }
	      return $array;
    	}
  	}
}

// Enqueue our scripts and styles
function vw_fitness_gym_customize_controls_scripts() {
  wp_enqueue_script( 'customizer-controls', get_theme_file_uri( '/assets/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'vw_fitness_gym_customize_controls_scripts' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Fitness_Gym_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	*/
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Fitness_Gym_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(new VW_Fitness_Gym_Customize_Section_Pro($manager,'vw_fitness_gym_upgrade_pro_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'VW FITNESS GYM', 'vw-fitness-gym' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'vw-fitness-gym' ),
			'pro_url'  => esc_url('https://www.buywptemplates.com/products/fitness-gym-wordpress-theme'),
		)));

		$manager->add_section(new VW_Fitness_Gym_Customize_Section_Pro($manager,'vw_fitness_gym_get_started_link',array(
			'priority'	=> 1,
			'title'    => esc_html__( 'DOCUMENTATION', 'vw-fitness-gym' ),
			'pro_text' => esc_html__( 'DOCS',  'vw-fitness-gym' ),
			'pro_url'  => esc_url('https://demos.buywptemplates.com/demo/docs/free-fitness-gym/')
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-fitness-gym-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-fitness-gym-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Fitness_Gym_Customize::get_instance();