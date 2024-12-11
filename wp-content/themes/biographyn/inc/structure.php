<?php
/**
 * Theme Palace basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */

$options = biographyn_get_theme_options();  


if ( ! function_exists( 'biographyn_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since  Biographyn 1.0.0
	 */
	function biographyn_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;
add_action( 'biographyn_doctype', 'biographyn_doctype', 10 );


if ( ! function_exists( 'biographyn_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since  Biographyn 1.0.0
	 *
	 */
	function biographyn_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
		<?php endif;
	}
endif;
add_action( 'biographyn_before_wp_head', 'biographyn_head', 10 );

if ( ! function_exists( 'biographyn_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since  Biographyn 1.0.0
	 *
	 */
	function biographyn_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'biographyn' ); ?></a>
		<?php
	}
endif;
add_action( 'biographyn_page_start_action', 'biographyn_page_start', 10 );

if ( ! function_exists( 'biographyn_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since  Biographyn 1.0.0
	 *
	 */
	function biographyn_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'biographyn_page_end_action', 'biographyn_page_end', 10 );

if ( ! function_exists( 'biographyn_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since  Biographyn 1.0.0
	 *
	 */
	function biographyn_site_branding() {
		$options  = biographyn_get_theme_options();
		$header_txt_logo_extra = $options['header_txt_logo_extra'];	 ?>

		<header id="masthead" class="site-header" role="banner">
			<div class="wrapper">
				<div class="site-branding">
					<?php if ( in_array( $header_txt_logo_extra, array( 'show-all', 'logo-title', 'logo-tagline' ) ) && has_custom_logo()  ) : ?>
						<div class="site-logo">
							<?php the_custom_logo(); ?>
						</div>
					<?php endif; 

					if ( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title', 'show-all', 'tagline-only', 'logo-tagline' ) ) ) : ?>
						<div id="site-identity">
							<?php
							if( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title' ) )  ) {
								if ( biographyn_is_latest_posts() ) : ?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php else : ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php
								endif;
							} 
							if ( in_array( $header_txt_logo_extra, array( 'show-all', 'tagline-only', 'logo-tagline' ) ) ) {
								$description = get_bloginfo( 'description', 'display' );
								if ( $description || is_customize_preview() ) : ?>
									<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
								<?php
								endif; 
							} ?>
						</div>
					<?php endif; ?>
				</div>
				<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php _e( 'Primary Menu', 'biographyn' ); ?>">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" title="<?php _e( 'Primary Menu', 'biographyn' ); ?>">
						<span class="menu-label"><?php esc_html_e('Menu', 'biographyn')?></span>		
						<?php
							echo biographyn_get_svg( array( 'icon' => 'menu', 'class' => 'icon-menu' ) );
							echo biographyn_get_svg( array( 'icon' => 'close', 'class' => 'icon-menu' ) );
						?>
					</button>
					<?php 
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container' => 'div',
							'menu_class' => 'menu nav-menu',
							'menu_id' => 'primary-menu',
							'echo' => true,
							'fallback_cb' => 'biographyn_menu_fallback_cb',
							'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div>
		</header><!-- .header-->
<?php 
	}
endif;
add_action( 'biographyn_header_action', 'biographyn_site_branding', 10 );

if ( ! function_exists( 'biographyn_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since  Biographyn 1.0.0
	 *
	 */
	function biographyn_content_start() {
		?>
		<div id="content" class="site-content">
		<?php
	}
endif;
add_action( 'biographyn_content_start_action', 'biographyn_content_start', 10 );

if ( ! function_exists( 'biographyn_header_image' ) ) :
    /**
     * Header Image codes
     *
     * @since  Biographyn 1.0.0
     *
     */
    function biographyn_header_image() {
        if ( biographyn_is_frontpage() )
            return;
        $header_image = get_header_image();
        if ( is_singular() ) :
            $header_image = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : $header_image;
        endif;
        $options  = biographyn_get_theme_options();
        ?>

        <?php if( $options['banner_image_enable'] == true ): ?>

        <div id="page-site-header" class="relative" style="background-image: url('<?php echo esc_url( $header_image ); ?>');">
            <div class="overlay"></div>
            <div class="wrapper">
                <header class="page-header">
                    <?php biographyn_custom_header_banner_title(); ?>
                </header>
                <?php biographyn_add_breadcrumb(); ?>
            </div>
        </div><!-- #page-site-header -->

    <?php endif; ?>

        <?php if( $options['banner_image_enable'] == false ): ?>

        	<div id="page-site-header" class="relative">
            <div class="wrapper">
                <header class="page-header">
                    <?php biographyn_custom_header_banner_title(); ?>
                </header>
                <?php biographyn_add_breadcrumb(); ?>
            </div>
        </div><!-- #page-site-header -->

        <?php endif; ?>

        <?php
    }
endif;
add_action( 'biographyn_header_image_action', 'biographyn_header_image', 10 );

if ( ! function_exists( 'biographyn_add_breadcrumb' ) ) :
	/**
	 * Add breadcrumb.
	 *
	 * @since  Biographyn 1.0.0
	 */
	function biographyn_add_breadcrumb() {
		$options = biographyn_get_theme_options();

		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}
		
		// Bail if Home Page.
		if ( biographyn_is_frontpage() ) {
			return;
		}

		echo '<div id="breadcrumb-list" >';
				/**
				 * biographyn_simple_breadcrumb hook
				 *
				 * @hooked biographyn_simple_breadcrumb -  10
				 *
				 */
				do_action( 'biographyn_simple_breadcrumb' );
		echo '</div><!-- #breadcrumb-list -->';
	}
endif;

if ( ! function_exists( 'biographyn_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since  Biographyn 1.0.0
	 *
	 */
	function biographyn_content_end() {
		?>
        </div><!-- #content -->
		<?php
	}
endif;
add_action( 'biographyn_content_end_action', 'biographyn_content_end', 10 );

if ( ! function_exists( 'biographyn_footer_start' ) ) :
	/**
	 * Footer starts
	 *
	 * @since  Biographyn 1.0.0
	 *
	 */
	function biographyn_footer_start() {
		?>
		<footer id="colophon" class="site-footer" role="contentinfo">
			
		<?php
	}
endif;
add_action( 'biographyn_footer', 'biographyn_footer_start', 10 );

if ( ! function_exists( 'biographyn_footer_site_info' ) ) :
	/**
	 * Footer starts
	 *
	 * @since  Biographyn 1.0.0
	 *
	 */
	function biographyn_footer_site_info() {
		$options = biographyn_get_theme_options();

		$copyright_text = $options['copyright_text'];
		?>
		<span class="double-border-line"></span>
		<div class="site-info col-2">
			<div class="wrapper">
				<span>
				<?php 
					echo biographyn_santize_allow_tag( $copyright_text ); 
					if ( function_exists( 'the_privacy_policy_link' ) ) {
						the_privacy_policy_link( ' | ' );
					}
				?>
				</span>
				<span>
					<?php 
					if(has_nav_menu( 'social' )){
						wp_nav_menu( 
							array(
								'theme_location' => 'social',
								'container' => 'ul',
								'menu_class' => 'social-icons',
								'echo' => true,
								'depth' => 1,
								'link_before' => '<span class="screen-reader-text">',
								'link_after' => '</span>',
								'fallback_cb' => false,
							)
						);
					}
					?>
				</span>
			</div><!-- .wrapper -->    
		</div><!-- .site-info -->

		<?php
	}
endif;
add_action( 'biographyn_footer', 'biographyn_footer_site_info', 40 );

if ( ! function_exists( 'biographyn_footer_scroll_to_top' ) ) :
	/**
	 * Footer starts
	 *
	 * @since  Biographyn 1.0.0
	 *
	 */
	function biographyn_footer_scroll_to_top() {
		$options  = biographyn_get_theme_options();
		if ( true === $options['scroll_top_visible'] ) : ?>
			<div class="backtotop"><?php echo biographyn_get_svg( array( 'icon' => 'up' ) ); ?></div>
		<?php endif;
	}
endif;
add_action( 'biographyn_footer', 'biographyn_footer_scroll_to_top', 40 );
