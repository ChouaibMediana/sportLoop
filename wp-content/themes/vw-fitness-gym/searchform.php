<?php
/**
 * The template for displaying search forms in VW Fitness Gym
 *
 * @package VW Fitness Gym
 */
?>

<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_attr_x( 'Search for:', 'label', 'vw-fitness-gym' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( get_theme_mod('vw_fitness_gym_search_placeholder', __('Search', 'vw-fitness-gym')) ); ?>" value="<?php echo esc_attr(get_search_query()) ?>" name="s">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button','vw-fitness-gym' ); ?>">
</form>