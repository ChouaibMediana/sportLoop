<?php
/**
 * Nested carousel shortcode.
 *
 * @package Elements
 */

if ( ! defined( 'WOODMART_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'woodmart_shortcode_nested_carousel' ) ) {
	/**
	 * Render nested carousel wrapper shortcode.
	 *
	 * @param array  $atts Shortcode attributes.
	 * @param string $content Inner content (shortcode).
	 *
	 * @return false|string
	 */
	function woodmart_shortcode_nested_carousel( $atts, $content ) {
		$custom_sizes = array();
		$atts         = shortcode_atts(
			array_merge(
				woodmart_get_owl_atts(),
				array(
					'woodmart_css_id'         => '',
					'css'                     => '',
					'slides_per_view'         => 1,
					'slides_per_view_tablet'  => '',
					'slides_per_view_mobile'  => '',
					'slider_spacing'          => 30,
					'scroll_per_page'         => '',
					'autoplay'                => '',
					'speed'                   => '',
					'hide_pagination_control' => '',
					'hide_prev_next_buttons'  => '',
					'center_mode'             => '',
					'wrap'                    => '',
					'scroll_carousel_init'    => 'no',
				)
			),
			$atts
		);

		if ( ! empty( $atts['slides_per_view_tablet'] ) && 'auto' !== $atts['slides_per_view_tablet'] ) {
			$custom_sizes['tablet_landscape'] = $atts['slides_per_view_tablet'];
			$custom_sizes['tablet']           = $atts['slides_per_view_tablet'];
		}

		if ( ! empty( $atts['slides_per_view_mobile'] ) && 'auto' !== $atts['slides_per_view_mobile'] ) {
			$custom_sizes['mobile'] = $atts['slides_per_view_mobile'];
		}

		if ( ! empty( $custom_sizes ) ) {
			$custom_sizes['desktop'] = $atts['slides_per_view'];
		}

		$atts['custom_sizes'] = $custom_sizes;

		$id               = 'wd-rs-' . $atts['woodmart_css_id'];
		$wrapper_classes  = apply_filters( 'vc_shortcodes_css_class', '', '', $atts );
		$wrapper_classes .= ' wd-wpb';

		if ( function_exists( 'vc_shortcode_custom_css_class' ) ) {
			$wrapper_classes .= ' ' . vc_shortcode_custom_css_class( $atts['css'] );
		}

		$carousel_container_classes = '';
		$owl_attributes             = woodmart_get_owl_attributes( $atts );
		$carousel_content_classes   = woodmart_owl_items_per_slide(
			$atts['slides_per_view'],
			array(),
			false,
			false,
			$custom_sizes,
		);

		ob_start();

		woodmart_enqueue_inline_style( 'owl-carousel' );

		if ( 'yes' === $atts['scroll_carousel_init'] ) {
			woodmart_enqueue_js_library( 'waypoints' );
			$carousel_container_classes .= ' scroll-init';
		}

		$carousel_container_classes .= ' wd-carousel-spacing-' . $atts['slider_spacing'];

		?>
			<div id="<?php echo esc_attr( $id ); ?>" class="wd-nested-carousel<?php echo esc_attr( $wrapper_classes ); ?>">
                <div class="wd-carousel-container <?php echo esc_attr( $carousel_container_classes ); ?>" <?php echo $owl_attributes; // phpcs:ignore ?>>
					<div class="owl-carousel wd-owl <?php echo esc_attr( $carousel_content_classes ); ?>">
						<?php echo do_shortcode( $content ); ?>
					</div>
				</div>
			</div>
		<?php

		return ob_get_clean();
	}
}

if ( ! function_exists( 'woodmart_shortcode_nested_carousel_item' ) ) {
	/**
	 * Render nested carousel item shortcode.
	 *
	 * @param array  $atts Shortcode attributes.
	 * @param string $content Inner content (shortcode).
	 *
	 * @return false|string
	 */
	function woodmart_shortcode_nested_carousel_item( $atts, $content ) {
		ob_start();

		?>
		<div class="wd-nested-carousel-item">
			<?php echo do_shortcode( $content ); ?>
		</div>
		<?php

		return ob_get_clean();
	}
}
