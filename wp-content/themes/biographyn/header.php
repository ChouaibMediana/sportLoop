<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Theme Palace
	 * @subpackage  Biographyn
	 * @since  Biographyn 1.0.0
	 */

	/**
	 * biographyn_doctype hook
	 *
	 * @hooked biographyn_doctype -  10
	 *
	 */
	do_action( 'biographyn_doctype' );

?>
<head>
<?php
	/**
	 * biographyn_before_wp_head hook
	 *
	 * @hooked biographyn_head -  10
	 *
	 */
	do_action( 'biographyn_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>
<?php
	/**
	 * biographyn_page_start_action hook
	 *
	 * @hooked biographyn_page_start -  10
	 *
	 */
	do_action( 'biographyn_page_start_action' ); 

	/**
	 * biographyn_loader_action hook
	 *
	 * @hooked biographyn_loader -  10
	 *
	 */
	do_action( 'biographyn_before_header' );

	/**
	 * biographyn_header_action hook
	 *
	 * @hooked biographyn_site_branding -  10
	 * @hooked biographyn_header_start -  20
	 * @hooked biographyn_site_navigation -  30
	 * @hooked biographyn_header_end -  50
	 *
	 */
	do_action( 'biographyn_header_action' );

	/**
	 * biographyn_content_start_action hook
	 *
	 * @hooked biographyn_content_start -  10
	 *
	 */
	do_action( 'biographyn_content_start_action' );

    /**
     * biographyn_header_image_action hook
     *
     * @hooked biographyn_header_image -  10
     *
     */
    do_action( 'biographyn_header_image_action' );
	
