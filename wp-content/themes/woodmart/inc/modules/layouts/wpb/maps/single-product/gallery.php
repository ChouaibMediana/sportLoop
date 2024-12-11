<?php
/**
 * Gallery map.
 *
 * @package Woodmart
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'woodmart_get_vc_map_single_product_gallery' ) ) {
	/**
	 * Gallery map.
	 */
	function woodmart_get_vc_map_single_product_gallery() {
		return array(
			'base'        => 'woodmart_single_product_gallery',
			'name'        => esc_html__( 'Product gallery', 'woodmart' ),
			'category'    => woodmart_get_tab_title_category_for_wpb( esc_html__( 'Single product elements', 'woodmart' ), 'single_product' ),
			'description' => esc_html__( 'Featured image and product gallery', 'woodmart' ),
			'icon'        => WOODMART_ASSETS . '/images/vc-icon/sp-icons/sp-gallery.svg',
			'params'      => array(
				array(
					'type'       => 'woodmart_css_id',
					'param_name' => 'woodmart_css_id',
				),

				array(
					'heading'     => esc_html__( 'Thumbnails position', 'woodmart' ),
					'type'        => 'dropdown',
					'param_name'  => 'thumbnails_position',
					'description' => esc_html__( 'Set your thumbnails display or leave default set from Theme Settings.', 'woodmart' ),
					'value'       => array(
						esc_html__( 'Inherit from Theme Settings', 'woodmart' ) => 'inherit',
						esc_html__( 'Left (vertical position)', 'woodmart' ) => 'left',
						esc_html__( 'Bottom (horizontal carousel)', 'woodmart' ) => 'bottom',
						esc_html__( 'Carousel (2 columns)', 'woodmart' ) => 'carousel_two_columns',
						esc_html__( 'Centered', 'woodmart' ) => 'centered',
						esc_html__( 'Without', 'woodmart' ) => 'without',
						esc_html__( 'Grid', 'woodmart' ) => 'bottom_column',
						esc_html__( 'Bottom (2 columns)', 'woodmart' ) => 'bottom_grid',
						esc_html__( 'Combined grid (1:2:1)', 'woodmart' ) => 'bottom_combined',
						esc_html__( 'Combined grid (2:3:2)', 'woodmart' ) => 'bottom_combined_2',
						esc_html__( 'Combined grid', 'woodmart' ) => 'bottom_combined_3',
					),
				),

				array(
					'heading'          => esc_html__( 'Grid columns', 'woodmart' ),
					'type'             => 'wd_select',
					'param_name'       => 'grid_columns',
					'style'            => 'select',
					'selectors'        => array(
						'{{WRAPPER}} .wd-grid' => array(
							'--wd-col: {{VALUE}};',
						),
					),
					'devices'          => array(
						'desktop' => array(
							'value' => '',
						),
						'tablet'  => array(
							'value' => '',
						),
						'mobile'  => array(
							'value' => '',
						),
					),
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'woodmart' ) => '',
						esc_html__( '1', 'woodmart' ) => '1',
						esc_html__( '2', 'woodmart' ) => '2',
						esc_html__( '3', 'woodmart' ) => '3',
						esc_html__( '4', 'woodmart' ) => '4',
						esc_html__( '5', 'woodmart' ) => '5',
						esc_html__( '6', 'woodmart' ) => '6',
					),
					'dependency'       => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'bottom_column', 'bottom_grid' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Columns gap', 'woodmart' ),
					'type'             => 'wd_slider',
					'param_name'       => 'grid_columns_gap',
					'selectors'        => array(
						'{{WRAPPER}} .wd-grid' => array(
							'--wd-gap: {{VALUE}}{{UNIT}};',
						),
					),
					'devices'          => array(
						'desktop' => array(
							'value' => '',
							'unit'  => 'px',
						),
						'tablet'  => array(
							'value' => '',
							'unit'  => 'px',
						),
						'mobile'  => array(
							'value' => '',
							'unit'  => 'px',
						),
					),
					'range'            => array(
						'px' => array(
							'min'  => 0,
							'max'  => 200,
							'step' => 1,
						),
					),
					'generate_zero'    => true,
					'dependency'       => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'bottom_column', 'bottom_grid', 'bottom_combined', 'bottom_combined_2', 'bottom_combined_3' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Carousel on tablet', 'woodmart' ),
					'type'             => 'dropdown',
					'param_name'       => 'carousel_on_tablet',
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'woodmart' ) => 'inherit',
						esc_html__( 'Enable', 'woodmart' ) => 'enable',
						esc_html__( 'Disable', 'woodmart' ) => 'disable',
					),
					'dependency'       => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'bottom_column', 'bottom_grid', 'bottom_combined', 'bottom_combined_2', 'bottom_combined_3' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Carousel on mobile', 'woodmart' ),
					'type'             => 'dropdown',
					'param_name'       => 'carousel_on_mobile',
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'woodmart' ) => 'inherit',
						esc_html__( 'Enable', 'woodmart' ) => 'enable',
						esc_html__( 'Disable', 'woodmart' ) => 'disable',
					),
					'dependency'       => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'bottom_column', 'bottom_grid', 'bottom_combined', 'bottom_combined_2', 'bottom_combined_3' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Carousel pagination in main gallery', 'woodmart' ),
					'type'             => 'dropdown',
					'param_name'       => 'pagination_main_gallery',
					'value'            => array(
						esc_html__( 'Inherit', 'woodmart' ) => 'inherit',
						esc_html__( 'Enable', 'woodmart' ) => 'enable',
						esc_html__( 'Disable', 'woodmart' ) => 'disable',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'type'             => 'woodmart_button_set',
					'heading'          => esc_html__( 'Thumbnails per slide', 'woodmart' ),
					'param_name'       => 'thumbnails_bottom_columns_tabs',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'woodmart' ) => 'desktop',
						esc_html__( 'Tablet', 'woodmart' ) => 'tablet',
						esc_html__( 'Mobile', 'woodmart' ) => 'mobile',
					),
					'default'          => 'desktop',
					'dependency'       => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'bottom', 'left' ),
					),
					'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
				),

				array(
					'type'          => 'dropdown',
					'param_name'    => 'thumbnails_left_vertical_columns',
					'value'         => array(
						esc_html__( 'Inherit from Theme Settings', 'woodmart' ) => 'inherit',
						esc_html__( 'Default', 'woodmart' ) => 'default',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					),
					'std'           => 'inherit',
					'dependency'    => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'left' ),
					),
					'wd_dependency' => array(
						'element' => 'thumbnails_bottom_columns_tabs',
						'value'   => array( 'desktop' ),
					),
				),

				array(
					'type'             => 'dropdown',
					'param_name'       => 'thumbnails_bottom_columns_desktop',
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'woodmart' ) => 'inherit',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					),
					'std'              => 'inherit',
					'dependency'       => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'bottom' ),
					),
					'wd_dependency'    => array(
						'element' => 'thumbnails_bottom_columns_tabs',
						'value'   => array( 'desktop' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),

				array(
					'type'             => 'dropdown',
					'param_name'       => 'thumbnails_bottom_columns_tablet',
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'woodmart' ) => 'inherit',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					),
					'std'              => 'inherit',
					'dependency'       => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'bottom', 'left' ),
					),
					'wd_dependency'    => array(
						'element' => 'thumbnails_bottom_columns_tabs',
						'value'   => array( 'tablet' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),

				array(
					'type'             => 'dropdown',
					'param_name'       => 'thumbnails_bottom_columns_mobile',
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'woodmart' ) => 'inherit',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					),
					'std'              => 'inherit',
					'dependency'       => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'bottom', 'left' ),
					),
					'wd_dependency'    => array(
						'element' => 'thumbnails_bottom_columns_tabs',
						'value'   => array( 'mobile' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),

				array(
					'heading'    => esc_html__( 'CSS box', 'woodmart' ),
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
					'type'       => 'css_editor',
					'param_name' => 'css',
				),
				woodmart_get_vc_responsive_spacing_map(),
			),
		);
	}
}

add_filter( 'vc_autocomplete_woodmart_single_product_gallery_product_id_callback', 'woodmart_productIdAutocompleteSuggester_new', 10, 1 );
add_filter( 'vc_autocomplete_woodmart_single_product_gallery_product_id_render', 'woodmart_productIdAutocompleteRender', 10, 1 );
