<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Physique
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php if(is_singular() && pings_open()) { ?>
<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' )); ?>">
<?php } ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
	//wp_body_open hook from WordPress 5.2
	if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
?>
<a class="skip-link screen-reader-text" href="#sitemain">
	<?php _e( 'Skip to content', 'physique' ); ?>
</a>

<header id="header" class="header">
	<div class="wrapper">
		<div class="flexbox">
			<div class="head-left">
				<div class="site-logo">
					<?php if ( has_custom_logo() ) { ?>
						<div class="custom-logo">
							<?php physique_the_custom_logo(); ?>
						</div><!-- cutom logo -->
					<?php } ?>
					<div class="site-title-desc">
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo( 'name' )); ?></a>
						</h1>
						<?php
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) :
								echo '<p class="site-description">'.esc_html($description).'</p>';
							endif;
						?>
					</div><!-- site-title-desc -->
				</div><!-- site-logo -->
			</div>
			<div class="head-right">
				<div class="toggle">
					<a class="toggleMenu" href="#"><?php esc_html_e('Menu','physique'); ?></a>
				</div><!-- toggle --> 	
				<nav id="main-navigation" class="site-navigation primary-navigation sitenav" role="navigation">		
					<?php wp_nav_menu( array('theme_location' => 'primary') ); ?>
				</nav>
			</div><!-- header right -->
			
			<?php
				$physiqsclicn = get_theme_mod('physiq_tphead_hide','1');
				if( $physiqsclicn == '' ) {
					$physiqheadfb = get_theme_mod('physiq_head_fb');
					$physiqheadtw = get_theme_mod('physiq_head_tw');
					$physiqheadyt = get_theme_mod('physiq_head_yt');
					$physiqheadin = get_theme_mod('physiq_head_in');
					$physiqheadpi = get_theme_mod('physiq_head_pin');
		
					if( !empty( $physiqheadfb || $physiqheadtw || $physiqheadyt || $physiqheadin || $physiqheadpi ) ){ 
						echo '<div class="head-social"><div class="social-icons">';
							if( !empty( $physiqheadfb ) ){
								echo '<a href="'.esc_url( $physiqheadfb ).'" target="_blank" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
							}
							if( !empty( $physiqheadtw ) ){
								echo '<a href="'.esc_url( $physiqheadtw ).'" target="_blank" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
							}
							if( !empty( $physiqheadyt ) ){
								echo '<a href="'.esc_url( $physiqheadyt ).'" target="_blank" title="YouTube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>';
							}
							if( !empty( $physiqheadin ) ){
								echo '<a href="'.esc_url( $physiqheadin ).'" target="_blank" title="Linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';
							}
							if( !empty( $physiqheadpi ) ){
								echo '<a href="'.esc_url( $physiqheadpi ).'" target="_blank" title="Pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>';
							}
						echo '</div><!-- social --></div><!-- topbar left -->';
					}
				}
			?>			
			
		</div><!-- flexbox -->
	</div><!-- wrap -->
</header><!-- header -->