<?php
//about theme info
add_action( 'admin_menu', 'vw_fitness_gym_gettingstarted' );
function vw_fitness_gym_gettingstarted() {    	
	add_theme_page( esc_html__('About VW Fitness Gym', 'vw-fitness-gym'), esc_html__('About VW Fitness Gym', 'vw-fitness-gym'), 'edit_theme_options', 'vw_fitness_gym_guide', 'vw_fitness_gym_mostrar_guide');   
}

// Add a Custom CSS file to WP Admin Area
function vw_fitness_gym_admin_theme_style() {
   wp_enqueue_style('vw-fitness-gym-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/getstart/getstart.css');
   wp_enqueue_script('vw-fitness-gym-tabs', esc_url(get_template_directory_uri()) . '/inc/getstart/js/tab.js');
}
add_action('admin_enqueue_scripts', 'vw_fitness_gym_admin_theme_style');

//guidline for about theme
function vw_fitness_gym_mostrar_guide() { 
	//custom function about theme customizer
	$vw_fitness_gym_return = add_query_arg( array()) ;
	$vw_fitness_gym_theme = wp_get_theme( 'vw-fitness-gym' );
?>

<div class="wrap getting-started">
		<div class="getting-started__header">
	    	<div>
                <h2 class="tgmpa-notice-warning"></h2>
            </div>
			<div class="row">
				<div class="col-md-5 intro">
					<div class="pad-box">
						<h2><?php esc_html_e( 'Welcome to VW Fitness Gym ', 'vw-fitness-gym' ); ?></h2>
						
						<p class="version"><?php esc_html_e( 'Version', 'vw-fitness-gym' ); ?>: <?php echo esc_html($vw_fitness_gym_theme['Version']);?></p>
						<span class="intro__version"><?php esc_html_e( 'Congratulations! You are about to use the most easy to use and flexible WordPress theme.', 'vw-fitness-gym' ); ?>	
						</span>
    					
						<div class="powered-by">
							<p ><strong><?php esc_html_e( 'All our WordPress themes are modern, minimalist, 100% responsive, seo-friendly,feature-rich, and multipurpose that best suit designers, bloggers and other professionals who are working in the creative fields.', 'vw-fitness-gym' ); ?></strong></p>
													
						</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="pro-links">
				    	<a href="<?php echo esc_url( VW_FITNESS_GYM_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'vw-fitness-gym'); ?></a>
						<a href="<?php echo esc_url( VW_FITNESS_GYM_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Pro', 'vw-fitness-gym'); ?></a>
						<a href="<?php echo esc_url( VW_FITNESS_GYM_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'vw-fitness-gym'); ?></a>
					</div>
					<div class="install-plugins">
						<img src="<?php echo esc_url(get_template_directory_uri() . '/inc/getstart/images/responsive.png'); ?>" alt="" />
					</div>
				</div>
			</div>
			<h2 class="tg-docs-section intruction-title" id="section-4"><?php esc_html_e( '1). Setup VW Fitness Gym Theme', 'vw-fitness-gym' ); ?></h2>
			<div class="row">
				<div class="theme-instruction-block col-md-7">
					<div class="pad-box">
	                    <p><?php esc_html_e( 'VW fitness gym is something special when it comes to the WordPress themes in this area and since it came in the market, this free WP theme has been doing rounds for the fitness enthusiasts or the people who want to venture in this area of business. It is not just good for one aspect of body fitness but is a fine option for the personal trainers, health coach, yoga. Armed with the exclusive features like Bootstrap framework, threaded comments, custom menu, CTA, retina ready, fit coach, responsiveness and multipurpose nature, personalization and customization options, Post layout options, it is a fit choice for health experts, boot camps, sport club, Fitness Park, physiotherapist, powerlift, trainer , Gloves, Joint Wraps, Jumping Tr, body building, leisure center, gymnasiums, healthcare centres, pilates, multi martial arts MMA, bodybuilding, fitness institutes, spas, healthy diet, nutitionist, Battle Ropes, Exercise Mats, health counsellor, Diet Planner, Fitness Hoops, Fitness Trampolines, Art of living, Body Bars, Chest Expanders, Exercise Balls, fitness center, gym training, personal training, workout classes, health club, Exercise Bands & Tubes, Exercise Equipment Mats, fitness courses, clubs, health-related website, dieticians, wellness, indoor and outdoor exercise class, yoga studio websites, Gym Trainers, karate, dancing, nutrition, BMI calculator, fitness appointments workout, sportswear, Sports Instructor, sport activity, athlete, lifestyle, aerobics, boxing, sports, cross fit, spa, massage center, cardio, meditation, crossfit, gyms, fitness centres, zo-yoga classes, muscular, Rehabilitation, Sports therapy, exercise class, zumba dance class, Ayurveda training, spiritual class, Medical Clinic and health advisors. This theme is based on based on HTML5 & CSS3, Bootstrap4 latest version. VW fitness gym is not only SEO friendly but also Gutenberg ready and it has footer widgets, this provides it an upper edge in the market. It is in great demand since its inception especially for the fitness and aerobic centers or the weight loss centers and in case one is interested to open physiotherapy health consultancy, it is a good option without any doubt. It is not only stunning but animated as well apart from being translation ready and supports AR_ARABIC, DE_GERMAN, ES_SPANISH, FR_FRENCH, IT_ITALIAN, RU_RUSSIAN, ZH_CHINESE, TR_TURKISH languages, modern and luxurious making it a nice option for health consultants.', 'vw-fitness-gym' ); ?><p><br>
						<ol>
							<li><?php esc_html_e( 'Start','vw-fitness-gym'); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizing','vw-fitness-gym'); ?></a> <?php esc_html_e( 'your website.','vw-fitness-gym'); ?> </li>
							<li><?php esc_html_e( 'VW Fitness Gym','vw-fitness-gym'); ?> <a target="_blank" href="<?php echo esc_url( VW_FITNESS_GYM_FREE_THEME_DOC ); ?>"><?php esc_html_e( 'Documentation','vw-fitness-gym'); ?></a> </li>
						</ol>
                    </div>
              	</div>
				<div class="col-md-5">
					<div class="pad-box">
              			<img class="logo" src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png" alt="" />
              		 </div> 
              	</div>
            </div>
			<div class="col-md-12 text-block">
					<h2 class="dashboard-install-title"><?php esc_html_e( '2.) Premium Theme Information.','vw-fitness-gym'); ?></h2>
					<div class="row">
						<div class="col-md-7">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/inc/getstart/images/responsive1.png'); ?>" alt="">
							<div class="pad-box">
								<h3><?php esc_html_e( 'Pro Theme Description','vw-fitness-gym'); ?></h3>
	                    		<p class="pad-box-p"><?php esc_html_e( 'Gym WordPress theme is a theme of premium level and is in great demand since its inception in the market with acclaimed reviews from the global clients. It is a preferred choice for fitness, yoga, personal trainers, health experts, boot camps, weight loss, clubs, physiotherapy, wellness, workout, lifestyle, aerobics, boxing, sports, cross fit, spa, massage center, cardio, meditation, advisors. Being Gutenberg ready as well as SEO friendly, it has an upper edge in the market than its competitors. Gym WordPress theme is responsive as well as multifunctional making it a special choice for the gyms, fitness centers, yoga classes, weight loss centers, personal trainers, aerobics and workout centers. Use it for spa, health and wellness center, physiotherapy, health consultancy, and other fitness related sites. It is user-friendly with the personalization options as well as CTA [call to action] making it a special choice for the aerobics as well as workout centers.', 'vw-fitness-gym' ); ?><p>
	                    	</div>
						</div>
						<div class="col-md-5 install-plugin-right">
							<div class="pad-box">								
								<h3><?php esc_html_e( 'Pro Theme Features','vw-fitness-gym'); ?></h3>
								<div class="dashboard-install-benefit">
									<ul>
										<li><?php esc_html_e( 'One click demo importer','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Global color option','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Responsive design','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Favicon, logo, title, and tagline customization','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Advanced color options and color pallets','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( '100+ font family options','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Simple menu option','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'SEO friendly','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Pagination option','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Compatible with different WordPress famous plugins like contact form 7','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Enable-Disable options on all sections','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Well sanitized as per WordPress standards.','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Responsive Layout for All Devices','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Footer customization options','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Fully integrated with the latest font awesome','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Background image option','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Custom Page Templates','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Allow To Set Site Title, Tagline, Logo','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Sticky post & comment threads','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Section reordering','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Customizable home page','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Footer widgets & editor style','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Social media feature','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Slider with unlimited number of slides','vw-fitness-gym'); ?></li>

										<li><?php esc_html_e( 'Services section','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Product section','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Testimonial section','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Our team sectionShortcodes for the custom post typeShortcodes for the custom post type, hd images and video display','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Our popular classes, tagline, logo','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Our fitness classes','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Pricing plan table','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Classes time table','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Instagram feed','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Newsletter section','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Blog post section','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Contact page template','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Shortcodes for the custom post type','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Easily Customize WordPress Theme','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Change site title color','vw-fitness-gym'); ?></li>								
										<li><?php esc_html_e( 'Custom Widgets','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Advanced Theme Options','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Call to Action Buttons','vw-fitness-gym'); ?></li>								
										<li><?php esc_html_e( 'Regular Updates','vw-fitness-gym'); ?></li>	
										<li><?php esc_html_e( 'Full-width template','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Sidebar Widget Area','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Custom Google Fonts','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Custom Link Colors','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Home Page Sections','vw-fitness-gym'); ?></li>
										<li><?php esc_html_e( 'Custom Sections','vw-fitness-gym'); ?></li>								
										<li><?php esc_html_e( 'GPL Compatible','vw-fitness-gym'); ?></li>	
										<li><?php esc_html_e( 'Excellent Core Web Vitals','vw-fitness-gym'); ?></li>			
										<li><?php esc_html_e( 'Professional support','vw-fitness-gym'); ?></li>			

									</ul>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
		<div class="dashboard__blocks">
			<div class="row">
				<div class="col-md-3">
					<h3><?php esc_html_e( 'Get Support','vw-fitness-gym'); ?></h3>
					<ol>
						<li><a target="_blank" href="<?php echo esc_url( VW_FITNESS_GYM_SUPPORT ); ?>"><?php esc_html_e( 'Free Theme Support','vw-fitness-gym'); ?></a></li>
						<li><a target="_blank" href="<?php echo esc_url( VW_FITNESS_GYM_PRO_SUPPORT ); ?>"><?php esc_html_e( 'Premium Theme Support','vw-fitness-gym'); ?></a></li>
					</ol>
				</div>

				<div class="col-md-3">
					<h3><?php esc_html_e( 'Getting Started','vw-fitness-gym'); ?></h3>
					<ol>
						<li><?php esc_html_e( 'Start','vw-fitness-gym'); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizing','vw-fitness-gym'); ?></a> <?php esc_html_e( 'your website.','vw-fitness-gym'); ?> </li>
					</ol>
				</div>
				<div class="col-md-3">
					<h3><?php esc_html_e( 'Help Docs','vw-fitness-gym'); ?></h3>
					<ol>
						<li><a target="_blank" href="<?php echo esc_url( VW_FITNESS_GYM_FREE_THEME_DOC ); ?>"><?php esc_html_e( 'Free Theme Documentation','vw-fitness-gym'); ?></a></li>
						<li><a target="_blank" href="<?php echo esc_url( VW_FITNESS_GYM_PRO_DOC ); ?>"><?php esc_html_e( 'Premium Theme Documentation','vw-fitness-gym'); ?></a></li>
					</ol>
				</div>
				<div class="col-md-3">
					<h3><?php esc_html_e( 'Buy Premium','vw-fitness-gym'); ?></h3>
					<ol>
						<a href="<?php echo esc_url( VW_FITNESS_GYM_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Pro', 'vw-fitness-gym'); ?></a>
					</ol>
				</div>
			</div>
		</div>
</div>
<?php } ?>