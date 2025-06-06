<?php

namespace Essential_Addons_Elementor\Pro\Elements;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use Elementor\Repeater;
use \Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use \Essential_Addons_Elementor\Classes\Helper;
use \Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Logo Carousel Widget
 */
class Logo_Carousel extends Widget_Base {

	/**
	 * Retrieve logo carousel widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'eael-logo-carousel';
	}

	/**
	 * Retrieve logo carousel widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Logo Carousel', 'essential-addons-elementor' );
	}

	/**
	 * Retrieve the list of categories the logo carousel widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'essential-addons-elementor' ];
	}

	public function get_keywords() {
		return [
			'logo carousel',
			'logo slider',
			'ea image carousel',
			'ea image slider',
			'ea logo carousel',
			'logo slider',
			'ea logo slider',
			'image slider',
			'ea image slider',
			'media slider',
			'media carousel',
			'ea',
			'essential addons',
		];
	}

	protected function is_dynamic_content():bool {
        return false;
    }

	public function has_widget_inner_wrapper(): bool {
        return ! Helper::eael_e_optimized_markup();
    }

	public function get_custom_help_url() {
		return 'https://essential-addons.com/elementor/docs/logo-carousel/';
	}

	/**
	 * Retrieve logo carousel widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eaicon-logo-carousel';
	}

	/**
	 * Get style dependencies.
	 *
	 * Retrieve the list of style dependencies the widget requires.
	 *
	 * @return array Widget style dependencies.
	 */
	public function get_style_depends(): array {
		return [ 'e-swiper' ];
	}

	/**
	 * Register logo carousel widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function register_controls() {

		/*-----------------------------------------------------------------------------------*/
		/*    CONTENT TAB
		/*-----------------------------------------------------------------------------------*/

		/**
		 * Content Tab: Logo Carousel
		 */
		$this->start_controls_section(
			'section_logo_carousel',
			[
				'label' => __( 'Logo Carousel', 'essential-addons-elementor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'logo_carousel_slide',
			[
				'label'   => __( 'Upload Logo Image', 'essential-addons-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'ai' => [
					'active' => false,
				],
			]
		);

		$repeater->add_control(
			'logo_title',
			[
				'label'   => __( 'Title', 'essential-addons-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'ai' => [
					'active' => false,
				],
			]
		);

		$repeater->add_control(
            'hide_logo_title',
            [
                'label'        => esc_html__( 'Hide Title ?', 'essential-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

		$repeater->add_control(
			'logo_alt',
			[
				'label'   => __( 'Alt Text', 'essential-addons-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'ai' => [
					'active' => false,
				],
			]
		);

		$repeater->add_control(
            'eael_logo_carousel_tooltip',
            [
                'label'        => esc_html__( 'Enable Tooltip?', 'essential-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => false,
            ]
        );

        $repeater->add_control(
            'eael_logo_carousel_tooltip_content',
            [
                'label'     => esc_html__( 'Tooltip Content', 'essential-addons-elementor' ),
                'type'      => Controls_Manager::TEXTAREA,
                'dynamic'   => ['active' => true],
                'default'   => __( "I'm a awesome tooltip!!", 'essential-addons-elementor' ),
                'condition' => [
                    'eael_logo_carousel_tooltip' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'eael_logo_carousel_tooltip_side',
            [
                'label'     => esc_html__( 'Tooltip Side', 'essential-addons-elementor' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'essential-addons-elementor' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'top'    => [
                        'title' => __( 'Top', 'essential-addons-elementor' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'essential-addons-elementor' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                    'bottom' => [
                        'title' => __( 'Bottom', 'essential-addons-elementor' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default'   => 'top',
                'condition' => [
                    'eael_logo_carousel_tooltip' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'eael_logo_carousel_tooltip_trigger',
            [
                'label'     => esc_html__( 'Tooltip Trigger', 'essential-addons-elementor' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => [
                    'hover' => __( 'Hover', 'essential-addons-elementor' ),
                    'click' => __( 'Click', 'essential-addons-elementor' ),
                ],
                'default'   => 'hover',
                'condition' => [
                    'eael_logo_carousel_tooltip' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'eael_logo_carousel_tooltip_animation',
            [
                'label'     => esc_html__( 'Tooltip Animation', 'essential-addons-elementor' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => [
                    'fade'  => __( 'Fade', 'essential-addons-elementor' ),
                    'grow'  => __( 'Grow', 'essential-addons-elementor' ),
                    'swing' => __( 'Swing', 'essential-addons-elementor' ),
                    'slide' => __( 'Slide', 'essential-addons-elementor' ),
                    'fall'  => __( 'Fall', 'essential-addons-elementor' ),
                ],
                'default'   => 'fade',
                'condition' => [
                    'eael_logo_carousel_tooltip' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'pricing_item_tooltip_animation_duration',
            [
                'label'     => esc_html__( 'Animation Duration', 'essential-addons-elementor' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 300,
                'condition' => [
                    'eael_logo_carousel_tooltip' => 'yes',
                ],
                'ai' => [
					'active' => false,
				],
            ]
        );

        $repeater->add_control(
            'eael_pricing_table_toolip_arrow',
            [
                'label'        => esc_html__( 'Tooltip Arrow', 'essential-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'eael_logo_carousel_tooltip' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'eael_logo_carousel_tooltip_theme',
            [
                'label'     => esc_html__( 'Tooltip Theme', 'essential-addons-elementor' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => [
                    'default'    => __( 'Default', 'essential-addons-elementor' ),
                    'noir'       => __( 'Noir', 'essential-addons-elementor' ),
                    'light'      => __( 'Light', 'essential-addons-elementor' ),
                    'punk'       => __( 'Punk', 'essential-addons-elementor' ),
                    'shadow'     => __( 'Shadow', 'essential-addons-elementor' ),
                    'borderless' => __( 'Borderless', 'essential-addons-elementor' ),
                ],
                'default'   => 'noir',
                'separator'   => 'after',
                'condition' => [
                    'eael_logo_carousel_tooltip' => 'yes',
                ],
            ]
        );

		$repeater->add_control(
			'link',
			[
				'name'        => 'link',
				'label'       => __( 'Link', 'essential-addons-elementor' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => 'https://www.your-link.com',
				'default'     => [
					'url' => '',
				],
			]
		);

		$default_values = [];
		for( $i = 1; $i < 6; $i ++ ){
			$default_values [] = [
				'logo_title'          => __( 'Logo Image ', 'essential-addons-elementor' ) . $i,
				'logo_carousel_slide' => [ 'url' => Utils::get_placeholder_image_src() ],
				'hide_logo_title'     => 'yes'
			];
		}

		$this->add_control(
			'carousel_slides',
			[
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'default'     => $default_values,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ logo_title }}}',
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'   => __( 'Title HTML Tag', 'essential-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h4',
				'options' => [
					'h1'   => __( 'H1', 'essential-addons-elementor' ),
					'h2'   => __( 'H2', 'essential-addons-elementor' ),
					'h3'   => __( 'H3', 'essential-addons-elementor' ),
					'h4'   => __( 'H4', 'essential-addons-elementor' ),
					'h5'   => __( 'H5', 'essential-addons-elementor' ),
					'h6'   => __( 'H6', 'essential-addons-elementor' ),
					'div'  => __( 'div', 'essential-addons-elementor' ),
					'span' => __( 'span', 'essential-addons-elementor' ),
					'p'    => __( 'p', 'essential-addons-elementor' ),
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Content Tab: Carousel Settings
		 */
		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => __( 'Carousel Settings', 'essential-addons-elementor' ),
			]
		);

		$this->add_control(
			'carousel_effect',
			[
				'label'       => __( 'Effect', 'essential-addons-elementor' ),
				'description' => __( 'Sets transition effect', 'essential-addons-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'slide',
				'options'     => [
					'slide'     => __( 'Slide', 'essential-addons-elementor' ),
					'fade'      => __( 'Fade', 'essential-addons-elementor' ),
					'cube'      => __( 'Cube', 'essential-addons-elementor' ),
					'coverflow' => __( 'Coverflow', 'essential-addons-elementor' ),
					'flip'      => __( 'Flip', 'essential-addons-elementor' ),
				],
			]
		);

		$this->add_responsive_control(
			'items',
			[
				'label'          => __( 'Visible Items', 'essential-addons-elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [ 'size' => 3 ],
				'tablet_default' => [ 'size' => 2 ],
				'mobile_default' => [ 'size' => 1 ],
				'frontend_available' => true,
				'range'          => [
					'px' => [
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					],
				],
				'size_units'     => '',
				'condition'      => [
					'carousel_effect' => [ 'slide', 'coverflow' ],
				],
				'separator'      => 'before',
			]
		);

		$this->add_responsive_control(
			'margin',
			[
				'label'      => __( 'Items Gap', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [ 'size' => 10 ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'size_units' => '',
				'condition'  => [
					'carousel_effect' => [ 'slide', 'coverflow' ],
				],
			]
		);

		$this->add_control(
			'slider_speed',
			[
				'label'       => __( 'Slider Speed', 'essential-addons-elementor' ),
				'description' => __( 'Duration of transition between slides (in ms)', 'essential-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [ 'size' => 400 ],
				'range'       => [
					'px' => [
						'min'  => 100,
						'max'  => 10000,
						'step' => 1,
					],
				],
				'size_units'  => '',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => __( 'Autoplay', 'essential-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'essential-addons-elementor' ),
				'label_off'    => __( 'No', 'essential-addons-elementor' ),
				'return_value' => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'enable_marquee',
			[
				'label'        => __( 'Enable Marquee', 'essential-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'essential-addons-elementor' ),
				'label_off'    => __( 'No', 'essential-addons-elementor' ),
				'default'      => 'no',
				'return_value' => 'yes',
				'condition'    => [
					'autoplay' => 'yes',
					'carousel_effect' => [ 'slide', 'coverflow' ],
				],
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'      => __( 'Autoplay Speed', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [ 'size' => 2000 ],
				'range'      => [
					'px' => [
						'min'  => 500,
						'max'  => 5000,
						'step' => 1,
					],
				],
				'size_units' => '',
				'condition'  => [
					'autoplay' => 'yes',
					'enable_marquee!' => 'yes',
				],
			]
		);

		$this->add_control(
			'infinite_loop',
			[
				'label'        => __( 'Infinite Loop', 'essential-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'essential-addons-elementor' ),
				'label_off'    => __( 'No', 'essential-addons-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'        => __( 'Pause On Hover', 'essential-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'essential-addons-elementor' ),
				'label_off'    => __( 'No', 'essential-addons-elementor' ),
				'return_value' => 'yes',
				'condition'    => [
					'autoplay' => 'yes',
					'enable_marquee!' => 'yes',
				],
			]
		);

		$this->add_control(
			'grab_cursor',
			[
				'label'        => __( 'Grab Cursor', 'essential-addons-elementor' ),
				'description'  => __( 'Shows grab cursor when you hover over the slider', 'essential-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Show', 'essential-addons-elementor' ),
				'label_off'    => __( 'Hide', 'essential-addons-elementor' ),
				'return_value' => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'navigation_heading',
			[
				'label'     => __( 'Navigation', 'essential-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control( 
			'eael_marquee_warning_text', 
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => __( 'Arrows & Dots are not available on <strong>Marquee</stong> Mode.', 'essential-addons-elementor' ),
                'content_classes' => 'eael-warning',
                'condition'       => [
                    'autoplay' => 'yes',
                    'enable_marquee' => 'yes',
                    'carousel_effect' => [ 'slide', 'coverflow' ],
                ],
            ]
        );

		$this->add_control(
			'arrows',
			[
				'label'        => __( 'Arrows', 'essential-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'essential-addons-elementor' ),
				'label_off'    => __( 'No', 'essential-addons-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'dots',
			[
				'label'        => __( 'Dots', 'essential-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'essential-addons-elementor' ),
				'label_off'    => __( 'No', 'essential-addons-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'direction',
			[
				'label'     => __( 'Direction', 'essential-addons-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => [
					'left'  => __( 'Left', 'essential-addons-elementor' ),
					'right' => __( 'Right', 'essential-addons-elementor' ),
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		/*-----------------------------------------------------------------------------------*/
		/*    STYLE TAB
		/*-----------------------------------------------------------------------------------*/

		/**
		 * Style Tab: Logos
		 */
		$this->start_controls_section(
			'section_logos_style',
			[
				'label' => __( 'Logos', 'essential-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'logo_bg',
				'label'    => __( 'Button Background', 'essential-addons-elementor' ),
				'types'    => [ 'none', 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .eael-lc-logo',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'logo_border',
				'label'       => __( 'Border', 'essential-addons-elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .eael-lc-logo',
			]
		);

		$this->add_control(
			'logo_border_radius',
			[
				'label'      => __( 'Border Radius', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .eael-lc-logo, {{WRAPPER}} .eael-lc-logo img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'logo_padding',
			[
				'label'      => __( 'Padding', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .eael-lc-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_logos_style' );

		$this->start_controls_tab(
			'tab_logos_normal',
			[
				'label' => __( 'Normal', 'essential-addons-elementor' ),
			]
		);

		$this->add_control(
			'grayscale_normal',
			[
				'label'        => __( 'Grayscale', 'essential-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'essential-addons-elementor' ),
				'label_off'    => __( 'No', 'essential-addons-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'opacity_normal',
			[
				'label'     => __( 'Opacity', 'essential-addons-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eael-logo-carousel img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'logo_shadow',
				'label'    => __( 'Shadow', 'essential-addons-elementor' ),
				'selector' => '{{WRAPPER}} .eael-lc-logo img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_logos_hover',
			[
				'label' => __( 'Hover', 'essential-addons-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'logo_hover_bg',
				'label'    => __( 'Logo Background', 'essential-addons-elementor' ),
				'types'    => [ 'none', 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .eael-lc-logo:hover',
			]
		);

		$this->add_control(
			'grayscale_hover',
			[
				'label'        => __( 'Grayscale', 'essential-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'essential-addons-elementor' ),
				'label_off'    => __( 'No', 'essential-addons-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'opacity_hover',
			[
				'label'     => __( 'Opacity', 'essential-addons-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eael-logo-carousel .swiper-slide:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'logo_hover_shadow',
				'label'    => __( 'Shadow', 'essential-addons-elementor' ),
				'selector' => '{{WRAPPER}} .eael-lc-logo:hover img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Style Tab: Title
		 */
		$this->start_controls_section(
			'section_logo_title_style',
			[
				'label' => __( 'Title', 'essential-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Color', 'essential-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .eael-logo-carousel-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_spacing',
			[
				'label'      => __( 'Margin Top', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .eael-logo-carousel-title' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'essential-addons-elementor' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT
				],
				'selector' => '{{WRAPPER}} .eael-logo-carousel-title',
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Arrows
		 */
		$this->start_controls_section(
			'section_arrows_style',
			[
				'label'     => __( 'Arrows', 'essential-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'arrows' => 'yes',
				],
			]
		);

		$this->add_control(
			'arrow_previous',
			[
				'label'            => __( 'Choose Previous Arrow', 'essential-addons-elementor' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'arrow',
				'default'          => [
					'value'   => 'fas fa-angle-left',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'arrow_new',
			[
				'label'            => __( 'Choose Next Arrow', 'essential-addons-elementor' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'arrow',
				'default'          => [
					'value'   => 'fas fa-angle-right',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_responsive_control(
			'arrows_size',
			[
				'label'      => __( 'Arrows Size', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [ 'size' => '22' ],
				'range'      => [
					'px' => [
						'min'  => 15,
						'max'  => 100,
						'step' => 1,
					],
				],
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-container-wrap .swiper-button-next, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .swiper-container-wrap .eael-logo-carousel-svg-icon'                                                => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .swiper-container-wrap .swiper-button-next svg, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_position',
			[
				'label'      => __( 'Arrow Position', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					],
				],
				'size_units' => [ '%' ],
				'default'    => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-container-wrap .swiper-button-next, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'left_arrow_position',
			[
				'label'      => __( 'Align Left Arrow', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 40,
						'step' => 1,
					],
				],
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-container-wrap .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'right_arrow_position',
			[
				'label'      => __( 'Align Right Arrow', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 40,
						'step' => 1,
					],
				],
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-container-wrap .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_arrows_style' );

		$this->start_controls_tab(
			'tab_arrows_normal',
			[
				'label' => __( 'Normal', 'essential-addons-elementor' ),
			]
		);

		$this->add_control(
			'arrows_bg_color_normal',
			[
				'label'     => __( 'Background Color', 'essential-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .swiper-container-wrap .swiper-button-next, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'arrows_color_normal',
			[
				'label'     => __( 'Color', 'essential-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
                    '{{WRAPPER}} .swiper-container-wrap .swiper-button-next, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .swiper-container-wrap .swiper-button-next svg, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'arrows_border_normal',
				'label'       => __( 'Border', 'essential-addons-elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .swiper-container-wrap .swiper-button-next, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev',
			]
		);

		$this->add_control(
			'arrows_border_radius_normal',
			[
				'label'      => __( 'Border Radius', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-container-wrap .swiper-button-next, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_arrows_hover',
			[
				'label' => __( 'Hover', 'essential-addons-elementor' ),
			]
		);

		$this->add_control(
			'arrows_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'essential-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .swiper-container-wrap .swiper-button-next:hover, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'arrows_color_hover',
			[
				'label'     => __( 'Color', 'essential-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
                    '{{WRAPPER}} .swiper-container-wrap .swiper-button-next:hover, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .swiper-container-wrap .swiper-button-next:hover svg, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'arrows_border_color_hover',
			[
				'label'     => __( 'Border Color', 'essential-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .swiper-container-wrap .swiper-button-next:hover, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'arrows_padding',
			[
				'label'      => __( 'Padding', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-container-wrap .swiper-button-next, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Dots
		 */
		$this->start_controls_section(
			'section_dots_style',
			[
				'label'     => __( 'Pagination: Dots', 'essential-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'dots' => 'yes',
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label'     => __( 'Position', 'essential-addons-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'inside'  => __( 'Inside', 'essential-addons-elementor' ),
					'outside' => __( 'Outside', 'essential-addons-elementor' ),
				],
				'default'   => 'outside',
				'condition' => [
					'dots' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'dots_size',
			[
				'label'      => __( 'Size', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => 2,
						'max'  => 40,
						'step' => 1,
					],
				],
				'size_units' => '',
				'selectors'  => [
					'{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'dots' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'dots_spacing',
			[
				'label'      => __( 'Spacing', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 30,
						'step' => 1,
					],
				],
				'size_units' => '',
				'selectors'  => [
					'{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullet' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'dots' => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_dots_style' );

		$this->start_controls_tab(
			'tab_dots_normal',
			[
				'label'     => __( 'Normal', 'essential-addons-elementor' ),
				'condition' => [
					'dots' => 'yes',
				],
			]
		);

		$this->add_control(
			'dots_color_normal',
			[
				'label'     => __( 'Color', 'essential-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullet' => 'background: {{VALUE}};',
				],
				'condition' => [
					'dots' => 'yes',
				],
			]
		);

		$this->add_control(
			'active_dot_color_normal',
			[
				'label'     => __( 'Active Color', 'essential-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullet-active' => 'background: {{VALUE}};',
				],
				'condition' => [
					'dots' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'dots_border_normal',
				'label'       => __( 'Border', 'essential-addons-elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullet',
				'condition'   => [
					'dots' => 'yes',
				],
			]
		);

		$this->add_control(
			'dots_border_radius_normal',
			[
				'label'      => __( 'Border Radius', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'dots' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'dots_padding',
			[
				'label'              => __( 'Padding', 'essential-addons-elementor' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', 'em', '%' ],
				'allowed_dimensions' => 'vertical',
				'placeholder'        => [
					'top'    => '',
					'right'  => 'auto',
					'bottom' => '',
					'left'   => 'auto',
				],
				'selectors'          => [
					'{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullets' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'          => [
					'dots' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_dots_hover',
			[
				'label'     => __( 'Hover', 'essential-addons-elementor' ),
				'condition' => [
					'dots' => 'yes',
				],
			]
		);

		$this->add_control(
			'dots_color_hover',
			[
				'label'     => __( 'Color', 'essential-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullet:hover' => 'background: {{VALUE}};',
				],
				'condition' => [
					'dots' => 'yes',
				],
			]
		);

		$this->add_control(
			'dots_border_color_hover',
			[
				'label'     => __( 'Border Color', 'essential-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullet:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'dots' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	/**
	 * Render logo carousel widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'logo-carousel-wrap', 'class', 'swiper-container-wrap eael-logo-carousel-wrap' );

		$this->add_render_attribute( 'logo-carousel', 'class', 'swiper swiper-8 eael-logo-carousel' );
		$this->add_render_attribute( 'logo-carousel', 'class', 'swiper-container-' . esc_attr( $this->get_id() ) );
		$this->add_render_attribute( 'logo-carousel', 'data-pagination', '.swiper-pagination-' . esc_attr( $this->get_id() ) );
		$this->add_render_attribute( 'logo-carousel', 'data-arrow-next', '.swiper-button-next-' . esc_attr( $this->get_id() ) );
		$this->add_render_attribute( 'logo-carousel', 'data-arrow-prev', '.swiper-button-prev-' . esc_attr( $this->get_id() ) );

		if ( $settings['dots_position'] ) {
			$this->add_render_attribute( 'logo-carousel-wrap', 'class', 'swiper-container-wrap-dots-' . $settings['dots_position'] );
		}

		if ( $settings['direction'] == 'right' ) {
			$this->add_render_attribute( 'logo-carousel', 'dir', 'rtl' );
		}

		if ( $settings['grayscale_normal'] == 'yes' ) {
			$this->add_render_attribute( 'logo-carousel', 'class', 'grayscale-normal' );
		}

		if ( $settings['grayscale_hover'] == 'yes' ) {
			$this->add_render_attribute( 'logo-carousel', 'class', 'grayscale-hover' );
		}

        if ( method_exists( Plugin::$instance->breakpoints, 'get_breakpoints_config' ) && ! empty( $breakpoints = Plugin::$instance->breakpoints->get_breakpoints_config() ) ) {
            foreach ( $breakpoints as $key => $breakpoint ){
                if ($breakpoint['is_enabled']) {
                    if (!empty($settings['items_'.$key]['size'])) {
                        $this->add_render_attribute('logo-carousel', 'data-items-'.$key, $settings['items_'.$key]['size']);
                    }
                    if (!empty($settings['margin_'.$key]['size'])) {
                        $this->add_render_attribute('logo-carousel', 'data-margin-'.$key, $settings['margin_'.$key]['size']);
                    }
                }
            }
        }
		if ( ! empty( $settings['items']['size'] ) ) {
			$this->add_render_attribute( 'logo-carousel', 'data-items', $settings['items']['size'] );
		}
		if ( ! empty( $settings['margin']['size'] ) ) {
			$this->add_render_attribute( 'logo-carousel', 'data-margin', $settings['margin']['size'] );
		}
		if ( $settings['carousel_effect'] ) {
			$this->add_render_attribute( 'logo-carousel', 'data-effect', $settings['carousel_effect'] );
		}
		if ( ! empty( $settings['slider_speed']['size'] ) ) {
			$this->add_render_attribute( 'logo-carousel', 'data-speed', $settings['slider_speed']['size'] );
		}

		if( 'yes' === $settings['enable_marquee'] ){
			$this->add_render_attribute( 'logo-carousel', 'data-autoplay', '0' );
			$this->add_render_attribute( 'logo-carousel', 'class', 'eael-marquee-carousel' );
		}
		else if ( $settings['autoplay'] == 'yes' && ! empty( $settings['autoplay_speed']['size'] ) ) {
			$this->add_render_attribute( 'logo-carousel', 'data-autoplay', $settings['autoplay_speed']['size'] );
		} else {
			$this->add_render_attribute( 'logo-carousel', 'data-autoplay', '999999' );
		}

		if ( $settings['pause_on_hover'] == 'yes' ) {
			$this->add_render_attribute( 'logo-carousel', 'data-pause-on-hover', 'true' );
		}

		if ( $settings['infinite_loop'] == 'yes' ) {
			$this->add_render_attribute( 'logo-carousel', 'data-loop', '1' );
		}
		if ( $settings['grab_cursor'] == 'yes' ) {
			$this->add_render_attribute( 'logo-carousel', 'data-grab-cursor', '1' );
		}
		if ( $settings['arrows'] == 'yes' ) {
			$this->add_render_attribute( 'logo-carousel', 'data-arrows', '1' );
		}
		?>
        <div <?php $this->print_render_attribute_string( 'logo-carousel-wrap' ); ?>>
            <div <?php $this->print_render_attribute_string( 'logo-carousel' ); ?>>
                <div class="swiper-wrapper">
					<?php
					$i = 1;
					foreach ( $settings['carousel_slides'] as $index => $item ):
						if ( $item['logo_carousel_slide'] ): ?>
                            <div class="swiper-slide">
                                <div class="eael-lc-logo-wrap">
									<?php 
										$this->add_render_attribute( "eael_lc_logo_{$i}", [
											'id'    => 'eael-lc-logo-' . $item['_id'],
											'class' => "eael-lc-logo",
										] );

										if( "yes" === $item['eael_logo_carousel_tooltip'] ){
											$this->add_render_attribute(
												"eael_lc_logo_{$i}",
												[
													'class' => 'eael-lc-tooltip',
													'title' => Helper::eael_wp_kses($item['eael_logo_carousel_tooltip_content']),
												]
											);

											if ($item['eael_logo_carousel_tooltip_side']) {
												$this->add_render_attribute("eael_lc_logo_{$i}", 'data-side', $item['eael_logo_carousel_tooltip_side']);
											}
						
											if ($item['eael_logo_carousel_tooltip_trigger']) {
												$this->add_render_attribute("eael_lc_logo_{$i}", 'data-trigger', $item['eael_logo_carousel_tooltip_trigger']);
											}
						
											if ($item['eael_logo_carousel_tooltip_animation']) {
												$this->add_render_attribute("eael_lc_logo_{$i}", 'data-animation', $item['eael_logo_carousel_tooltip_animation']);
											}
						
											if (!empty($item['pricing_item_tooltip_animation_duration'])) {
												$this->add_render_attribute("eael_lc_logo_{$i}", 'data-animation_duration', $item['pricing_item_tooltip_animation_duration']);
											}
						
											if (!empty($item['eael_pricing_table_toolip_arrow'])) {
												$this->add_render_attribute("eael_lc_logo_{$i}", 'data-arrow', $item['eael_pricing_table_toolip_arrow']);
											}
						
											if (!empty($item['eael_logo_carousel_tooltip_theme'])) {
												$this->add_render_attribute("eael_lc_logo_{$i}", 'data-theme', $item['eael_logo_carousel_tooltip_theme']);
											}
										}
									?>
                                    <div <?php $this->print_render_attribute_string( "eael_lc_logo_{$i}" )?>>
										<?php
										if ( ! empty( $item['logo_carousel_slide']['url'] ) ) {

											$is_linked = false;
											if ( ! empty( $item['link']['url'] ) ) {
												$is_linked = true;
												$this->add_link_attributes( "eael_logo_url_{$i}", $item['link'] );
											}

											if ( $is_linked ) {
												echo '<a ' . $this->get_render_attribute_string( "eael_logo_url_{$i}" ) . '>';
											}

											echo '<img class="eael-lc-img-src" src="' . esc_url( $item['logo_carousel_slide']['url'] ) . '" alt="' . esc_html( $item['logo_alt'] ) . '">';

											if ( $is_linked ) {
												echo '</a>';
											}
										}
										?>
                                    </div>
									<?php
									if ( ! empty( $item['logo_title'] ) && 'yes' !== $item['hide_logo_title'] ) {
										$title_tag = Helper::eael_validate_html_tag( $settings['title_html_tag'] );
										echo '<' . esc_html( $title_tag ) . ' class="eael-logo-carousel-title">';
										if ( ! empty( $item['link']['url'] ) ) {
											echo '<a '; $this->print_render_attribute_string( 'logo-link' . $i ); echo '>';
										}
										echo wp_kses( $item['logo_title'], Helper::eael_allowed_icon_tags() );
										if ( ! empty( $item['link']['url'] ) ) {
											echo '</a>';
										}
										echo '</' . esc_html( $title_tag ) . '>';
									}
									?>
                                </div>
                            </div>
						<?php
						endif;
						$i ++;
					endforeach;
					?>
                </div>
            </div>
			<?php

			if( 'yes' !== $settings['enable_marquee'] ){
				$this->render_dots();
				$this->render_arrows();
			}
			?>
        </div>
		<?php
	}

	/**
	 * Render logo carousel dots output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render_dots() {
		$settings = $this->get_settings_for_display();

		if ( $settings['dots'] == 'yes' ) { ?>
            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination-<?php echo esc_attr( $this->get_id() ); ?>"></div>
		<?php }
	}

	/**
	 * Render logo carousel arrows output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render_arrows() {
		$settings = $this->get_settings_for_display();

		if ( $settings['arrows'] == 'yes' ) { ?>
			<?php
			if ( isset( $settings['__fa4_migrated']['arrow_new'] ) || empty( $settings['arrow'] ) ) {
				$arrow = Helper::get_render_icon( $settings['arrow_new'] );
			} else {
                $arrow = '<i class="<?php echo esc_attr( $settings["arrow"] ); ?>"></i>';
			}
			?>
            <!-- Add Arrows -->
            <div class="swiper-button-next swiper-button-next-<?php echo esc_attr( $this->get_id() ); ?>">
				<?php if ( isset( $arrow['url'] ) ): ?>
                    <img class="eael-logo-carousel-svg-icon" src="<?php echo esc_url( $arrow['url'] ); ?>"
                         alt="<?php echo esc_attr( get_post_meta( $arrow['id'], '_wp_attachment_image_alt', true ) ); ?>">
				<?php else:
                    echo wp_kses( $arrow, Helper::eael_allowed_icon_tags() );
                endif; ?>
            </div>
            <div class="swiper-button-prev swiper-button-prev-<?php echo esc_attr( $this->get_id() ); ?>">
				<?php if ( isset( $settings['arrow_previous']['value']['url'] ) ): ?>
                    <img class="eael-logo-carousel-svg-icon"
                         src="<?php echo esc_url( $settings['arrow_previous']['value']['url'] ); ?>"
                         alt="<?php echo esc_attr( get_post_meta( $settings['arrow_previous']['value']['id'], '_wp_attachment_image_alt', true ) ); ?>">
				<?php
                    elseif ( !empty($settings['arrow_previous']) ):
                        \Elementor\Icons_Manager::render_icon( $settings['arrow_previous'] );
                else: ?>
                    <i class="<?php echo esc_attr( $settings['arrow_previous']['value'] ); ?>"></i>
				<?php endif; ?>
            </div>
		<?php }
	}
}
