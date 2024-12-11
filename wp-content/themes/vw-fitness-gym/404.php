<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package VW Fitness Gym
 */

get_header(); ?>

<main id="maincontent" role="main" class="content-vw">
	<div class="container">
		<div class="page-content">
	    	<h1><?php echo esc_html(get_theme_mod('vw_fitness_gym_404_page_title',__('404 Not Found','vw-fitness-gym')));?></h1>
			<p class="text-404"><?php echo esc_html(get_theme_mod('vw_fitness_gym_404_page_content',__('Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.','vw-fitness-gym')));?></p>
			<?php if( get_theme_mod('vw_fitness_gym_404_page_button_text','GO BACK') != ''){ ?>
				<div class="more-btn">
			        <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_theme_mod('vw_fitness_gym_404_page_button_text',__('GO BACK','vw-fitness-gym')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_fitness_gym_404_page_button_text',__('GO BACK','vw-fitness-gym')));?></span></a>
			    </div>
			<?php } ?>
		</div>
		<div class="clearfix"></div>
	</div>
</main>

<?php get_footer(); ?>