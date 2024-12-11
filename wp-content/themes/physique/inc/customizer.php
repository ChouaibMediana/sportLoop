<?php
/**
 * Physique Theme Customizer
 *
 * @package Physique
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function physique_customize_register( $wp_customize ) {
	
	function physique_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
	
	$wp_customize->get_setting( 'blogname' )->tranport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->tranport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
	    'selector' => 'h1.site-title',
	    'render_callback' => 'physique_customize_partial_blogname',
	) );

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
	    'selector' => 'p.site-description',
	    'render_callback' => 'physique_customize_partial_blogdescription',
	) );

	/***************************************
	** Color Scheme
	***************************************/
	$wp_customize->add_setting('color_scheme', array(
		'default' => '#e94c23',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));

	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => __('Color Scheme','physique'),
			'description' => __('Select color from here.','physique'),
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);

	$wp_customize->add_setting('physiq_headerbg_color', array(
		'default' => '#111111',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'physiq_headerbg_color',array(
			'label' => __('Header Background color','physique'),
			'description'	=> __('Select background color for header.','physique'),
			'section' => 'colors',
			'settings' => 'physiq_headerbg_color'
		))
	);

	$wp_customize->add_setting('physiq_footer_color', array(
		'default' => '#262827',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'physiq_footer_color',array(
			'label' => __('Footer Background Color','physique'),
			'description' => __('Select background color for footer.','physique'),
			'section' => 'colors',
			'settings' => 'physiq_footer_color'
		))
	);
	
	/***************************************
	** Theme Setup Panel
	***************************************/
	$wp_customize->add_panel( 'physiq_theme_options', 
		array(
			'title'            => __( 'Theme Setup', 'physique' ),
			'description'      => __( 'Theme Modifications like theme texts and layout preferences can be done here', 'physique' ),
		) 
	);

	/***************************************
	** Social Media
	***************************************/
	$wp_customize->add_section(
        'physiq_tphead_info',
        array(
            'title' => __('Social Media Icons', 'physique'),
            'priority' => null,
			'description'	=> __('Add social media accounts link here.','physique'),
			'panel'         => 'physiq_theme_options',
        )
    );

	$wp_customize->add_setting('physiq_head_fb',array(
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('physiq_head_fb',array(
			'type'	=> 'url',
			'label'	=> __('Add Facebook link here.','physique'),
			'section'	=> 'physiq_tphead_info'
	));

	$wp_customize->add_setting('physiq_head_tw',array(
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('physiq_head_tw',array(
			'type'	=> 'url',
			'label'	=> __('Add Twitter link here.','physique'),
			'section'	=> 'physiq_tphead_info'
	));

	$wp_customize->add_setting('physiq_head_yt',array(
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('physiq_head_yt',array(
			'type'	=> 'url',
			'label'	=> __('Add Youtube link here.','physique'),
			'section'	=> 'physiq_tphead_info'
	));

	$wp_customize->add_setting('physiq_head_in',array(
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('physiq_head_in',array(
			'type'	=> 'url',
			'label'	=> __('Add Linkedin link here.','physique'),
			'section'	=> 'physiq_tphead_info'
	));

	$wp_customize->add_setting('physiq_head_pin',array(
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('physiq_head_pin',array(
			'type'	=> 'url',
			'label'	=> __('Add Pinterest link here.','physique'),
			'section'	=> 'physiq_tphead_info'
	));

	$wp_customize->add_setting('physiq_tphead_hide',array(
			'default' => true,
			'sanitize_callback' => 'physique_sanitize_checkbox',
			'capability' => 'edit_theme_options',
	));	 

	$wp_customize->add_control( 'physiq_tphead_hide', array(
		   'settings' => 'physiq_tphead_hide',
    	   'section'   => 'physiq_tphead_info',
    	   'label'     => __('Check this to hide social media icons.','physique'),
    	   'type'      => 'checkbox'
     ));

	/***************************************
	** Slider Section
	***************************************/
	$wp_customize->add_section(
        'physique_slider',
        array(
            'title' => __('Setup Slider', 'physique'),
            'priority' => null,
			'description'	=> __('Recommended image size (1600x900). Slider will work only when you select the static front page.','physique'),
			'panel'         => 'physiq_theme_options',			
        )
    );

    $wp_customize->add_setting('slide1',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('slide1',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide one:','physique'),
			'section'	=> 'physique_slider'
	));

	$wp_customize->add_setting('slide2',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('slide2',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide two:','physique'),
			'section'	=> 'physique_slider'
	));

	$wp_customize->add_setting('slide3',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('slide3',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide three:','physique'),
			'section'	=> 'physique_slider'
	));

	$wp_customize->add_setting('slide_more',array(
		'default'	=> __('Read More','physique'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('slide_more',array(
		'label'	=> __('Add slider link button text.','physique'),
		'section'	=> 'physique_slider',
		'setting'	=> 'slide_more',
		'type'	=> 'text'
	));
	
	$wp_customize->add_setting('physique_hide_slider',array(
		'default' => true,
		'sanitize_callback' => 'physique_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	)); 

	$wp_customize->add_control( 'physique_hide_slider', array(
	   'settings' => 'physique_hide_slider',
	   'section'   => 'physique_slider',
	   'label'     => __('Check this to hide slider.','physique'),
	   'type'      => 'checkbox'
    ));
	
	/***************************************
	** About Section
	***************************************/
	$wp_customize->add_section(
        'physiq_wel_section',
        array(
            'title' => __('Setup First Section', 'physique'),
            'priority' => null,
			'description'	=> __('Select page for homepage first section. This section will be displayed only when you select the static front page.','physique'),	
			'panel'         => 'physiq_theme_options',
        )
    );

    $wp_customize->add_setting('physiq_wel_sec',array(
		'default' => '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('physiq_wel_sec',array(
		'type'	=> 'dropdown-pages',
		'label'	=> __('Select page for this section','physique'),
		'section'	=> 'physiq_wel_section'
	));

	$wp_customize->add_setting('physiq_wel_more',array(
		'default'	=> __('','physique'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('physiq_wel_more',array(
		'label'	=> __('Add read more button text.','physique'),
		'section'	=> 'physiq_wel_section',
		'setting'	=> 'physiq_wel_more',
		'type'	=> 'text'
	));
	
	$wp_customize->add_setting('physiq_hide_wel',array(
		'default' => true,
		'sanitize_callback' => 'physique_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	)); 

	$wp_customize->add_control( 'physiq_hide_wel', array(
	   'settings' => 'physiq_hide_wel',
	   'section'   => 'physiq_wel_section',
	   'label'     => __('Check this to hide second section.','physique'),
	   'type'      => 'checkbox'
    ));

    /***************************************
	** Why Us Section
	***************************************/
	$wp_customize->add_section(
        'physiq_whyus_section',
        array(
            'title' => __('Setup Second Section', 'physique'),
            'priority' => null,
			'description'	=> __('Select pages for homepage second section. This section will be displayed only when you select the static front page.','physique'),
			'panel'         => 'physiq_theme_options',
        )
    );

    $wp_customize->add_setting('physiq_whyus_ttl',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiq_whyus_ttl',array(
		'type'	=> 'text',
		'label'	=> __('Add Section Title Here','physique'),
		'section'	=> 'physiq_whyus_section'
	));

    $wp_customize->add_setting('whyus1',array(
		'default' => '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('whyus1',array(
		'type'	=> 'dropdown-pages',
		'label'	=> __('Select page for first column','physique'),
		'section'	=> 'physiq_whyus_section'
	));

	$wp_customize->add_setting('whyus2',array(
		'default' => '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('whyus2',array(
		'type'	=> 'dropdown-pages',
		'label'	=> __('Select page for second column','physique'),
		'section'	=> 'physiq_whyus_section'
	));

	$wp_customize->add_setting('whyus3',array(
		'default' => '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('whyus3',array(
		'type'	=> 'dropdown-pages',
		'label'	=> __('Select page for third column','physique'),
		'section'	=> 'physiq_whyus_section'
	));

	$wp_customize->add_setting('whyus_more',array(
		'default'	=> __('','physique'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('whyus_more',array(
		'label'	=> __('Add read more button text.','physique'),
		'section'	=> 'physiq_whyus_section',
		'setting'	=> 'whyus_more',
		'type'	=> 'text'
	));
	
	$wp_customize->add_setting('physiq_hide_fsec',array(
		'default' => true,
		'sanitize_callback' => 'physique_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	)); 

	$wp_customize->add_control( 'physiq_hide_fsec', array(
	   'settings' => 'physiq_hide_fsec',
	   'section'   => 'physiq_whyus_section',
	   'label'     => __('Check this to hide section.','physique'),
	   'type'      => 'checkbox'
    ));
}
add_action( 'customize_register', 'physique_customize_register' );

function physique_css_func(){ ?>
<style>
	a,
	.tm_client strong,
	.postmeta a:hover,
	#sidebar ul li a:hover,
	.blog-post h3.entry-title,
	a.blog-more:hover,
	#commentform input#submit,
	input.search-submit,
	.blog-date .date,
	p.site-description,
	h2.section_title,
	.sitenav ul li.current_page_item a,
	.sitenav ul li a:hover, 
	.sitenav ul li.current_page_item ul li a:hover{
		color:<?php echo esc_attr(get_theme_mod('color_scheme','#e94c23'));?>;
	}
	h3.widget-title,
	.nav-links .current,
	.nav-links a:hover,
	p.form-submit input[type="submit"],
	.head-social,
	.social-icons:after,
	.head-social:after,
	.physique-slider .inner-caption .sliderbtn,
	.whyus-box .whyus-more,
	.read-more,
	.nivo-controlNav a{
		background-color:<?php echo esc_attr(get_theme_mod('color_scheme','#e94c23'));?>;
	}
	.social-icons:before{
		border-top-color:<?php echo esc_attr(get_theme_mod('color_scheme','#e94c23'));?>;
	}
	#header,
	.sitenav ul li.menu-item-has-children:hover > ul,
	.sitenav ul li.menu-item-has-children:focus > ul,
	.sitenav ul li.menu-item-has-children.focus > ul{
		background-color:<?php echo esc_attr(get_theme_mod('physiq_headerbg_color','#111111'));?>;
	}
	.copyright-wrapper{
		background-color:<?php echo esc_attr(get_theme_mod('physiq_footer_color','#262827'));?>;
	}
</style>
<?php }
add_action('wp_head','physique_css_func');

function physique_customize_preview_js() {
	wp_enqueue_script( 'physique-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}
add_action( 'customize_preview_init', 'physique_customize_preview_js' );