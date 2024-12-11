<?php
/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
	 * Register block styles.
	 *
	 * @since Physique 1.0
	 *
	 * @return void
	 */
	function physique_register_block_styles() {
		// Columns: Overlap.
		register_block_style(
			'core/columns',
			array(
				'name'  => 'physique-columns-overlap',
				'label' => esc_html__( 'Overlap', 'physique' ),
			)
		);

		// Cover: Borders.
		register_block_style(
			'core/cover',
			array(
				'name'  => 'physique-border',
				'label' => esc_html__( 'Borders', 'physique' ),
			)
		);

		// Group: Borders.
		register_block_style(
			'core/group',
			array(
				'name'  => 'physique-border',
				'label' => esc_html__( 'Borders', 'physique' ),
			)
		);

		// Image: Borders.
		register_block_style(
			'core/image',
			array(
				'name'  => 'physique-border',
				'label' => esc_html__( 'Borders', 'physique' ),
			)
		);

		// Image: Frame.
		register_block_style(
			'core/image',
			array(
				'name'  => 'physique-image-frame',
				'label' => esc_html__( 'Frame', 'physique' ),
			)
		);

		// Latest Posts: Dividers.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'physique-latest-posts-dividers',
				'label' => esc_html__( 'Dividers', 'physique' ),
			)
		);

		// Latest Posts: Borders.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'physique-latest-posts-borders',
				'label' => esc_html__( 'Borders', 'physique' ),
			)
		);

		// Media & Text: Borders.
		register_block_style(
			'core/media-text',
			array(
				'name'  => 'physique-border',
				'label' => esc_html__( 'Borders', 'physique' ),
			)
		);

		// Separator: Thick.
		register_block_style(
			'core/separator',
			array(
				'name'  => 'physique-separator-thick',
				'label' => esc_html__( 'Thick', 'physique' ),
			)
		);

		// Social icons: Dark gray color.
		register_block_style(
			'core/social-links',
			array(
				'name'  => 'physique-social-icons-color',
				'label' => esc_html__( 'Dark gray', 'physique' ),
			)
		);
	}
	add_action( 'init', 'physique_register_block_styles' );
}
