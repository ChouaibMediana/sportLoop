<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */

/**
 * biographyn_footer_primary_content hook
 *
 * @hooked biographyn_add_subscribe_section -  10
 *
 */
do_action( 'biographyn_footer_primary_content' );

/**
 * biographyn_content_end_action hook
 *
 * @hooked biographyn_content_end -  10
 *
 */
do_action( 'biographyn_content_end_action' );

/**
 * biographyn_content_end_action hook
 *
 * @hooked biographyn_footer_start -  10
 * @hooked biographyn_Footer_Widgets->add_footer_widgets -  20
 * @hooked biographyn_footer_site_info -  40
 * @hooked biographyn_footer_end -  100
 *
 */
do_action( 'biographyn_footer' );

/**
 * biographyn_page_end_action hook
 *
 * @hooked biographyn_page_end -  10
 *
 */
do_action( 'biographyn_page_end_action' ); 

?>

<?php wp_footer(); ?>

</body>
</html>
