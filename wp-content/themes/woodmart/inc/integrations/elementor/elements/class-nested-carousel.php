<?php
/**
 * Nested carousel element.
 *
 * @package xts
 */

namespace XTS\Elementor;

use Elementor\Controls_Manager;
use  Elementor\Modules\NestedElements\Module as NestedElementsModule;
use Elementor\Modules\NestedElements\Base\Widget_Nested_Base;
use Elementor\Modules\NestedElements\Controls\Control_Nested_Repeater;
use Elementor\Plugin;
use Elementor\Repeater;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Nested_Carousel extends Widget_Nested_Base {
	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_nested_carousel';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Nested carousel', 'woodmart' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'wd-icon-nested-carousel';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'wd-elements' );
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'nested', 'carousel' );
	}

	public function show_in_panel(): bool {
		return Plugin::$instance->experiments->is_feature_active( NestedElementsModule::EXPERIMENT_NAME );
	}

	protected function slide_content_container( int $index ) {
		return array(
			'elType'   => 'container',
			'settings' => array(
				'_title'        => sprintf(
					// translators: %s Slide index.
					esc_html__( 'Slide #%s', 'woodmart' ),
					$index
				),
				'content_width' => 'full',
			),
		);
	}

	protected function get_default_children_elements() {
		return array(
			$this->slide_content_container( 1 ),
			$this->slide_content_container( 2 ),
			$this->slide_content_container( 3 ),
		);
	}

	protected function get_default_repeater_title_setting_key() {
		return 'slide_title';
	}

	protected function get_default_children_title() {
		return esc_html__( 'Slide #%d', 'woodmart' );
	}

	protected function get_default_children_placeholder_selector() {
		return '.wd-owl';
	}

	protected function get_html_wrapper_class() {
		return 'wd-nested-carousel';
	}

	/**
	 * Register the widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		/**
		 * General settings
		 */
		$this->start_controls_section(
			'general_section',
			array(
				'label' => esc_html__( 'General', 'woodmart' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'slide_title',
			array(
				'label'       => esc_html__( 'Slide title', 'woodmart' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Slide title', 'woodmart' ),
				'placeholder' => esc_html__( 'Slide title', 'woodmart' ),
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'slides',
			array(
				'label'       => esc_html__( 'Slides', 'woodmart' ),
				'type'        => Control_Nested_Repeater::CONTROL_TYPE,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'slide_title' => esc_html__( 'Slide #1', 'woodmart' ),
					),
					array(
						'slide_title' => esc_html__( 'Slide #2', 'woodmart' ),
					),
					array(
						'slide_title' => esc_html__( 'Slide #3', 'woodmart' ),
					),
				),
				'title_field' => '{{{ slide_title }}}',
				'button_text' => 'Add Slide',
			)
		);

		$this->end_controls_section();

		/**
		 * Carousel settings.
		 */
		$this->start_controls_section(
			'carousel_style_section',
			array(
				'label' => esc_html__( 'Carousel', 'woodmart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'slides_per_view',
			array(
				'label'       => esc_html__( 'Slides per view', 'woodmart' ),
				'description' => esc_html__( 'Set numbers of slides you want to display at the same time on slider\'s container for carousel mode.', 'woodmart' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => array(
					'size' => 1,
				),
				'size_units'  => '',
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 8,
						'step' => 1,
					),
				),
			)
		);

		$this->add_control(
			'slider_spacing',
			array(
				'label'   => esc_html__( 'Space between', 'woodmart' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					0  => esc_html__( '0 px', 'woodmart' ),
					2  => esc_html__( '2 px', 'woodmart' ),
					6  => esc_html__( '6 px', 'woodmart' ),
					10 => esc_html__( '10 px', 'woodmart' ),
					20 => esc_html__( '20 px', 'woodmart' ),
					30 => esc_html__( '30 px', 'woodmart' ),
				),
				'default' => 30,
			)
		);

		$this->add_control(
			'scroll_per_page',
			array(
				'label'        => esc_html__( 'Scroll per page', 'woodmart' ),
				'description'  => esc_html__( 'Scroll per page not per item. This affect next/prev buttons and mouse/touch dragging.', 'woodmart' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => esc_html__( 'Yes', 'woodmart' ),
				'label_off'    => esc_html__( 'No', 'woodmart' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'hide_pagination_control',
			array(
				'label'        => esc_html__( 'Hide pagination control', 'woodmart' ),
				'description'  => esc_html__( 'If "YES" pagination control will be removed.', 'woodmart' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'woodmart' ),
				'label_off'    => esc_html__( 'No', 'woodmart' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'hide_prev_next_buttons',
			array(
				'label'        => esc_html__( 'Hide prev/next buttons', 'woodmart' ),
				'description'  => esc_html__( 'If "YES" prev/next control will be removed', 'woodmart' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'woodmart' ),
				'label_off'    => esc_html__( 'No', 'woodmart' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'center_mode',
			array(
				'label'        => esc_html__( 'Center mode', 'woodmart' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'woodmart' ),
				'label_off'    => esc_html__( 'No', 'woodmart' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'wrap',
			array(
				'label'        => esc_html__( 'Slider loop', 'woodmart' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'woodmart' ),
				'label_off'    => esc_html__( 'No', 'woodmart' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'        => esc_html__( 'Slider autoplay', 'woodmart' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'woodmart' ),
				'label_off'    => esc_html__( 'No', 'woodmart' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'speed',
			array(
				'label'       => esc_html__( 'Slider speed', 'woodmart' ),
				'description' => esc_html__( 'Duration of animation between slides (in ms)', 'woodmart' ),
				'default'     => '5000',
				'type'        => Controls_Manager::NUMBER,
				'condition'   => array(
					'autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'scroll_carousel_init',
			array(
				'label'        => esc_html__( 'Init carousel on scroll', 'woodmart' ),
				'description'  => esc_html__( 'This option allows you to init carousel script only when visitor scroll the page to the slider. Useful for performance optimization.\'', 'woodmart' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'woodmart' ),
				'label_off'    => esc_html__( 'No', 'woodmart' ),
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();
	}

	public function get_owl_atts() {
		$settings = $this->get_settings_for_display();
		$owl_atts = array(
			'slides_per_view'         => isset( $settings['slides_per_view']['size'] ) && ! empty( $settings['slides_per_view']['size'] ) ? $settings['slides_per_view']['size'] : 1,
			'custom_sizes'            => $this->get_owl_custom_sizes(),
			'scroll_per_page'         => $settings['scroll_per_page'],
			'hide_pagination_control' => $settings['hide_pagination_control'],
			'hide_prev_next_buttons'  => $settings['hide_prev_next_buttons'],
			'center_mode'             => $settings['center_mode'],
			'wrap'                    => $settings['wrap'],
			'autoplay'                => $settings['autoplay'],
			'speed'                   => $settings['speed'],
		);

		if ( isset( $settings['slides_per_view_tablet']['size'] ) && ! empty( $settings['slides_per_view_tablet']['size'] ) ) {
			$owl_atts['slides_per_view_tablet'] = $settings['slides_per_view_tablet']['size'];
		}

		if ( isset( $settings['slides_per_view_mobile']['size'] ) && ! empty( $settings['slides_per_view_mobile']['size'] ) ) {
			$owl_atts['slides_per_view_mobile'] = $settings['slides_per_view_mobile']['size'];
		}

		return $owl_atts;
	}

	public function get_owl_custom_sizes() {
		$settings     = $this->get_settings_for_display();
		$custom_sizes = array();

		if ( isset( $settings['slides_per_view_tablet']['size'] ) && ! empty( $settings['slides_per_view_tablet']['size'] ) ) {
			$custom_sizes['tablet_landscape'] = $settings['slides_per_view_tablet']['size'];
			$custom_sizes['tablet']           = $settings['slides_per_view_tablet']['size'];
		}

		if ( isset( $settings['slides_per_view_mobile']['size'] ) && ! empty( $settings['slides_per_view_mobile']['size'] ) ) {
			$custom_sizes['mobile'] = $settings['slides_per_view_mobile']['size'];
		}

		if ( ! empty( $custom_sizes ) ) {
			$custom_sizes['desktop'] = isset( $settings['slides_per_view']['size'] ) && ! empty( $settings['slides_per_view']['size'] ) ? $settings['slides_per_view']['size'] : 1;
		}

		return $custom_sizes;
	}

	public function get_owl_items_per_slide_classes() {
		$settings        = $this->get_settings_for_display();
		$slides_per_view = isset( $settings['slides_per_view']['size'] ) && ! empty( $settings['slides_per_view']['size'] ) ? $settings['slides_per_view']['size'] : 1;
		$custom_sizes    = $this->get_owl_custom_sizes();

		$carousel_classes = woodmart_owl_items_per_slide(
			$slides_per_view,
			array(),
			false,
			false,
			$custom_sizes,
		);

		return $carousel_classes;
	}


	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings                   = $this->get_settings_for_display();
		$slides                     = $settings['slides'];
		$slide_content_html         = '';
		$carousel_container_classes = '';
		$owl_atts                   = $this->get_owl_atts();
		$owl_attributes             = woodmart_get_owl_attributes( $owl_atts );

		foreach ( $slides as $index => $item ) {
			// Slide content.
			ob_start();
			$this->print_child( $index );
			$slide_content = ob_get_clean();

			$slide_content_html .= $slide_content;
		}

		if ( 'yes' === $settings['scroll_carousel_init'] ) {
			woodmart_enqueue_js_library( 'waypoints' );
			$carousel_container_classes .= ' scroll-init';
		}

		$carousel_container_classes .= ' wd-carousel-spacing-' . $settings['slider_spacing'];

		woodmart_enqueue_inline_style( 'owl-carousel' );
		?>
		<div class="wd-nested-carousel">
            <div class="wd-carousel-container <?php echo esc_attr( $carousel_container_classes ); ?>" <?php echo $owl_attributes; // phpcs:ignore ?>>
				<div class="owl-carousel wd-owl <?php echo esc_attr( $this->get_owl_items_per_slide_classes() ); ?>">
					<?php echo $slide_content_html; // phpcs:ignore ?>
				</div>
			</div>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<#
			const getColSizes = desktopColumns => {
				const sizes = {
					'1': {
						'desktop'          : '1',
						'tablet'           : '1',
						'tablet_landscape' : '1',
						'mobile'           : '1',
					},
					'2': {
						'desktop'          : '2',
						'tablet'           : '2',
						'tablet_landscape' : '1',
						'mobile'           : '1',
					},
					'3': {
						'desktop'          : '3',
						'tablet'           : '3',
						'tablet_landscape' : '2',
						'mobile'           : '1',
					},
					'4': {
						'desktop'          : '4',
						'tablet'           : '4',
						'tablet_landscape' : '3',
						'mobile'           : '1',
					},
					'5': {
						'desktop'          : '5',
						'tablet'           : '4',
						'tablet_landscape' : '3',
						'mobile'           : '2',
					},
					'6': {
						'desktop'          : '6',
						'tablet'           : '4',
						'tablet_landscape' : '3',
						'mobile'           : '2',
					},
					'7': {
						'desktop'          : '7',
						'tablet'           : '4',
						'tablet_landscape' : '3',
						'mobile'           : '2',
					},
					'8': {
						'desktop'          : '8',
						'tablet'           : '4',
						'tablet_landscape' : '3',
						'mobile'           : '2',
					},
					'9': {
						'desktop'          : '9',
						'tablet'           : '4',
						'tablet_landscape' : '3',
						'mobile'           : '2',
					},
					'10': {
						'desktop'          : '10',
						'tablet'           : '4',
						'tablet_landscape' : '3',
						'mobile'           : '2',
					},
					'11': {
						'desktop'          : '11',
						'tablet'           : '4',
						'tablet_landscape' : '3',
						'mobile'           : '2',
					},
					'12': {
						'desktop'          : '12',
						'tablet'           : '4',
						'tablet_landscape' : '3',
						'mobile'           : '2',
					},
				}

				return sizes[desktopColumns];
			}

			const getOwlItemsNumbers = (slidesPerView, customSizes = {}) => {
				let items = getColSizes(slidesPerView);

				if ( '1' === items['desktop']  ) {
					items['mobile'] = '1';
				}

				if ( Object.keys(customSizes).length > 0 ) {
					let autoColumns = getColSizes( customSizes['desktop'] );

					if ( 'undefined' === typeof customSizes['tablet_landscape'] ) {
						customSizes['tablet_landscape'] = autoColumns['tablet_landscape'];
					}

					if ( 'undefined' === typeof customSizes['tablet'] ) {
						customSizes['tablet'] = autoColumns['tablet'];
					}

					if ( 'undefined' === typeof customSizes['mobile'] ) {
						customSizes['mobile'] = autoColumns['mobile'];
					}

					items = customSizes;
				}

				return items;
			}

			const owlItemsPerSlide = (slidesPerView, customSizes = {}) => {
				let classes = '';
				let items   = getOwlItemsNumbers(slidesPerView, customSizes);

				classes += `owl-items-lg-${items['desktop']}`;
				classes += ` owl-items-md-${items['tablet_landscape']}`;
				classes += ` owl-items-sm-${items['tablet']}`;
				classes += ` owl-items-xs-${items['mobile']}`;

				return classes;
			}

			const getOwlCustomSizes = settings => {
				let customSizes    = {};

				if ( settings['slides_per_view_tablet']['size'] ) {
					customSizes['tablet_landscape'] = settings['slides_per_view_tablet']['size'];
					customSizes['tablet']           = settings['slides_per_view_tablet']['size'];
				}

				if ( settings['slides_per_view_mobile']['size'] ) {
					customSizes['mobile'] = settings['slides_per_view_mobile']['size'];
				}

				if ( Object.keys(customSizes).length > 0 ) {
					customSizes['desktop'] = settings['slides_per_view']['size'] ? settings['slides_per_view']['size'] : 1;
				}

				return customSizes;
			}

			const getOwlAttributes = (atts) => {
				let defaultAtts = {
					'carousel_id'            : '5000',
					'speed'                  : '5000',
					'slides_per_view'        : '1',
					'slides_per_view_tablet' : 'auto',
					'slides_per_view_mobile' : 'auto',
					'wrap'                   : '',
					'loop'                   : false,
					'autoplay'               : 'no',
					'autoheight'             : 'no',
					'hide_pagination_control': '',
					'hide_prev_next_buttons' : '',
					'scroll_per_page'        : 'yes',
					'dragEndSpeed'           : 200,
					'center_mode'            : 'no',
					'custom_sizes'           : '',
					'sliding_speed'          : false,
					'animation'              : false,
					'content_animation'      : false,
					'post_type'              : '',
					'slider'                 : '',
					'library'                : 'owl',
					'css'                    : '',
				}

				atts         = {...defaultAtts, ...atts}
				let output = 'data-owl-carousel';

				Object.keys(atts).forEach((key)=> {
					let value = atts[key];

					if ( 'undefined' !== typeof defaultAtts[key] && defaultAtts[key] === value ) {
						delete atts[key];
					}
				});

				let slidesPerView = 'undefined' !== typeof atts['slides_per_view'] ? atts['slides_per_view'] : defaultAtts['slides_per_view'];
				let customSizes   = 'undefined' !== typeof atts['custom_sizes'] ? atts['custom_sizes'] : {};
				let items         = getOwlItemsNumbers( slidesPerView, customSizes );

				let excerpt = [
					'slides_per_view',
					'post_type',
					'custom_sizes',
					'loop',
					'carousel_id',
				];

				Object.keys(atts).forEach((key)=> {
					let value = atts[key];

					if ( excerpt.includes(key) ) {
						return;
					}

					output += ` data-${key}="${value}"`;
				});

				Object.keys(items).forEach((key)=> {
					let value = items[key];

					output += ` data-${key}="${value}"`;
				});

				return output
			}

			const getOwlItemsPerSlideClasses = settings => {
				let slidesPerView = settings['slides_per_view']['size'] ? settings['slides_per_view']['size'] : 1;
				let custom_sizes  = getOwlCustomSizes(settings)

				return owlItemsPerSlide(slidesPerView, custom_sizes);
			}

			const getOwlAtts = settings => {
				let owlAtts = {
					'slides_per_view'         : settings['slides_per_view']['size'] ? settings['slides_per_view']['size'] : 1,
					'custom_sizes'            : getOwlCustomSizes(settings),
					'scroll_per_page'         : settings['scroll_per_page'],
					'hide_pagination_control' : settings['hide_pagination_control'],
					'hide_prev_next_buttons'  : settings['hide_prev_next_buttons'],
					'center_mode'             : settings['center_mode'],
					'wrap'                    : settings['wrap'],
					'autoplay'                : settings['autoplay'],
					'speed'                   : settings['speed'],
				}

				if ( settings['slides_per_view_tablet']['size'] ) {
					owlAtts['slides_per_view_tablet'] = settings['slides_per_view_tablet']['size'];
				}

				if ( settings['slides_per_view_mobile']['size'] ) {
					owlAtts['slides_per_view_tablet'] = settings['slides_per_view_mobile']['size'];
				}

				return owlAtts;
			}
		#>
		<#
			view.addRenderAttribute( 'owlCarouselAttribute',{
				'class': [
					'owl-carousel',
					'wd-owl',
					getOwlItemsPerSlideClasses(settings)
				],
			});

			view.addRenderAttribute( 'owlCarouselContainerAttribute',{
				'class': [
					'wd-carousel-container',
					'yes' === settings['scroll_carousel_init'] ? 'scroll-init' : '',
					`wd-carousel-spacing-${settings['slider_spacing']}`
				],
			});

			let owlAtts       = getOwlAtts(settings);
			let owlAttributes = getOwlAttributes(owlAtts);
		#>
		<div class="wd-nested-carousel">
			<div {{{ view.getRenderAttributeString( 'owlCarouselContainerAttribute' ) }}} {{{ owlAttributes }}}>
				<div {{{ view.getRenderAttributeString( 'owlCarouselAttribute' ) }}}></div>
			</div>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Nested_Carousel() );
