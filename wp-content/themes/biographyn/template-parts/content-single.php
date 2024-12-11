<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */
$options = biographyn_get_theme_options();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clear' ); ?>>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'biographyn' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'biographyn' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->


	<div class="entry-meta">
	<?php 
		if(! $options['single_post_hide_author']):
			echo biographyn_author();
		endif; 
		if (! $options['single_post_hide_date'] ) :
			biographyn_posted_on();
		endif;
		biographyn_single_categories();	biographyn_entry_footer(); 
	?>
	</div>

</article><!-- #post-## -->
