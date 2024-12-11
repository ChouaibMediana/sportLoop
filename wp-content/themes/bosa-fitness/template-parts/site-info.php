<?php
/**
 * Template part for displaying site info
 *
 * @package Bosa Fitness 1.0.0
 */

?>

<div class="site-info">
	<?php echo wp_kses_post( html_entity_decode( esc_html__( 'Copyright &copy; ' , 'bosa-fitness' ) ) );
		echo esc_html( date( 'Y' ) );
		printf( esc_html__( ' Bosa Fitness. Powered by', 'bosa-fitness' ) );
	?>
	<a href="<?php echo esc_url( __( '//bosathemes.com', 'bosa-fitness' ) ); ?>" target="_blank">
		<?php
			printf( esc_html__( 'Bosa Themes', 'bosa-fitness' ) );
		?>
	</a>
</div><!-- .site-info -->