<?php

namespace Essential_Addons_Elementor\Pro\Skins;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

use \Elementor\Skin_Base;
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Icons_Manager;
use Essential_Addons_Elementor\Pro\Classes\Helper;
use Elementor\Plugin;

class Skin_Seven extends Skin_Base
{
    public function get_id()
    {
        return 'skin-seven';
    }

    public function get_title()
    {
        return __('Skin Seven', 'essential-addons-elementor');
    }

    protected function _register_controls_actions()
    {
        add_action('elementor/element/eael-advanced-menu/eael_advanced_menu_section_general/before_section_end', [$this, 'section_general']);
        add_action('elementor/element/eael-advanced-menu/eael_advanced_menu_section_style_menu/before_section_end', [$this, 'section_style_menu']);
        add_action('elementor/element/eael-advanced-menu/eael_advanced_menu_section_style_dropdown/before_section_end', [$this, 'section_style_dropdown']);
        add_action('elementor/element/eael-advanced-menu/eael_advanced_menu_section_style_top_level_item/before_section_end', [$this, 'section_style_top_level_item']);
        add_action('elementor/element/eael-advanced-menu/eael_advanced_menu_section_style_dropdown_item/before_section_end', [$this, 'section_style_dropdown_item']);
    }

    public function section_general(Widget_Base $widget)
    {
        $this->parent = $widget;

        $this->add_control(
            'eael_advanced_menu_layout',
            [
                'label' => esc_html__('Layout', 'essential-addons-elementor'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'horizontal' => __('Horizontal', 'essential-addons-elementor'),
                    'vertical' => __('Vertical', 'essential-addons-elementor'),
                ],
                'default' => 'vertical',

            ]
        );
    }

    public function section_style_menu(Widget_Base $widget)
    {
        $this->parent = $widget;

        $this->add_responsive_control(
            'eael_advanced_menu_background',
            [
                'label' => __('Background Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4caf50',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu-container' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu.eael-advanced-menu-horizontal' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'eael_advanced_menu_border',
                'label' => __('Border', 'essential-addons-elementor'),
                'selector' => '{{WRAPPER}} .eael-advanced-menu-container, {{WRAPPER}} .eael-advanced-menu.eael-advanced-menu-horizontal.eael-advanced-menu-responsive',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'eael_advanced_menu_box_shadow',
                'label' => __('Shadow', 'essential-addons-elementor'),
                'selector' => '{{WRAPPER}} .eael-advanced-menu-container',
            ]
        );

        $this->add_responsive_control(
			'eael_advanced_menu_section_padding',
			[
				'label' => esc_html__( 'Padding', 'essential-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [
                    '{{WRAPPER}}.eael-hamburger--not-responsive .eael-advanced-menu-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}.eael-hamburger--responsive .eael-advanced-menu-container .eael-nav-menu-wrapper .eael-advanced-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
    }

    public function section_style_dropdown(Widget_Base $widget)
    {
        $this->parent = $widget;

        $this->add_control(
            'eael_advanced_menu_dropdown_animation',
            [
                'label' => __('Animation', 'essential-addons-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'eael-advanced-menu-dropdown-animate-fade' => __('Fade', 'essential-addons-elementor'),
                    'eael-advanced-menu-dropdown-animate-to-top' => __('To Top', 'essential-addons-elementor'),
                    'eael-advanced-menu-dropdown-animate-zoom-in' => __('ZoomIn', 'essential-addons-elementor'),
                    'eael-advanced-menu-dropdown-animate-zoom-out' => __('ZoomOut', 'essential-addons-elementor'),
                ],
                'default' => 'eael-advanced-menu-dropdown-animate-to-top',
                'condition' => [
                    'skin_seven_eael_advanced_menu_layout' => ['horizontal'],
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_submenu_expand',
            [
                'label' => esc_html__('Expand Active Submenu', 'essential-addons-elementor'),
                'description' => sprintf( __('Expand submenu if it contains the active page', 'essential-addons-elementor') ),
                'type' => Controls_Manager::SWITCHER,
                'label_block' => false,
                'label_on' => __( 'Yes', 'essential-addons-elementor' ),
                'label_off' => __( 'No', 'essential-addons-elementor' ),
                'return_value' => 'block',
                'default' => 'none',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu-container li.current-menu-ancestor > ul' => 'display: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu-container li.current-menu-ancestor > ul li' => 'padding-left:20px'
                ],
                'condition' => [
                    'skin_seven_eael_advanced_menu_layout' => ['vertical'],
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_background',
            [
                'label' => __('Background Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#419544',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li ul' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'eael_advanced_menu_dropdown_border',
                'label' => __('Border', 'essential-addons-elementor'),
                'selector' => '{{WRAPPER}} .eael-advanced-menu li ul',
            ]
        );

        $this->add_responsive_control(
            'eael_advanced_menu_dropdown_border_radius',
            [
                'label' => __('Border Radius', 'essential-addons-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li ul' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'eael_advanced_menu_dropdown_padding',
            [
                'label' => __('Padding', 'essential-addons-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'eael_advanced_menu_dropdown_box_shadow',
                'label' => __('Shadow', 'essential-addons-elementor'),
                'selector' => '{{WRAPPER}} .eael-advanced-menu li ul',
            ]
        );
    }

    public function section_style_top_level_item(Widget_Base $widget)
    {
        $this->parent = $widget;

        $this->add_control(
            'eael_advanced_menu_item_alignment',
            [
                'label' => __('Alignment', 'essential-addons-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'eael-advanced-menu-align-left' => [
                        'title' => __('Left', 'essential-addons-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'eael-advanced-menu-align-center' => [
                        'title' => __('Center', 'essential-addons-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'eael-advanced-menu-align-right' => [
                        'title' => __('Right', 'essential-addons-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'eael-advanced-menu-align-left',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'eael_advanced_menu_item_typography',
                'label' => __('Typography', 'essential-addons-elementor'),
                'global' => [
	                'default' => Global_Typography::TYPOGRAPHY_PRIMARY
                ],
                'selector' => '{{WRAPPER}} .eael-advanced-menu li > a, .eael-advanced-menu-container .eael-advanced-menu-toggle-text',
                'fields_options' => [
                    'font_family' => [
                        'default' => 'Ubuntu',
                    ],
                    'font_size' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '14',
                        ],
                    ],
                    'font_weight' => [
                        'default' => '400',
                    ],
                    'line_height' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '60',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_divider_heading',
            [
                'label' => __('Divider', 'essential-addons-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_divider_color',
            [
                'label' => __('Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu.eael-advanced-menu-horizontal:not(.eael-advanced-menu-responsive) > li > a' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu-align-center .eael-advanced-menu.eael-advanced-menu-horizontal:not(.eael-advanced-menu-responsive) > li:first-child > a' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu-align-right .eael-advanced-menu.eael-advanced-menu-horizontal:not(.eael-advanced-menu-responsive) > li:first-child > a' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu.eael-advanced-menu-horizontal.eael-advanced-menu-responsive > li:not(:last-child) > a' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu.eael-advanced-menu-vertical > li:not(:last-child) > a' => 'border-color: {{VALUE}}',
                ],

            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_divider_width',
            [
                'label' => __('Width', 'essential-addons-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu.eael-advanced-menu-horizontal:not(.eael-advanced-menu-responsive) > li > a' => 'border-width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .eael-advanced-menu-align-center .eael-advanced-menu.eael-advanced-menu-horizontal:not(.eael-advanced-menu-responsive) > li:first-child > a' => 'border-width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .eael-advanced-menu-align-right .eael-advanced-menu.eael-advanced-menu-horizontal:not(.eael-advanced-menu-responsive) > li:first-child > a' => 'border-width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .eael-advanced-menu.eael-advanced-menu-horizontal.eael-advanced-menu-responsive > li:not(:last-child) > a' => 'border-width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .eael-advanced-menu.eael-advanced-menu-vertical > li:not(:last-child) > a' => 'border-width: {{SIZE}}{{UNIT}}',
                ],

            ]
        );

        $this->add_control(
			'eael_advanced_menu_item_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'essential-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu.eael-advanced-menu-horizontal:not(.eael-advanced-menu-responsive) > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} .eael-advanced-menu-align-center .eael-advanced-menu.eael-advanced-menu-horizontal:not(.eael-advanced-menu-responsive) > li:first-child > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} .eael-advanced-menu-align-right .eael-advanced-menu.eael-advanced-menu-horizontal:not(.eael-advanced-menu-responsive) > li:first-child > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} .eael-advanced-menu.eael-advanced-menu-horizontal.eael-advanced-menu-responsive > li:not(:last-child) > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} .eael-advanced-menu.eael-advanced-menu-vertical > li:not(:last-child) > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
			]
		);

        $this->add_control(
            'eael_advanced_menu_item_padding',
            [
                'label' => __('Item Padding', 'essential-addons-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'description' => __( "This controller is <b style='color: #c6c6c6;letter-spacing: .5px;'>deprecated</b>. Please use 'Padding' instead of 'Item Padding,' as this controller will be removed.", 'essential-addons-elementor' ),
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li a' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eael-advanced-menu.eael-advanced-menu-horizontal li ul li a' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
			'eael_advanced_menu_items_padding',
			[
				'label'      => esc_html__( 'Padding', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .eael-advanced-menu li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .eael-advanced-menu.eael-advanced-menu-horizontal li ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'eael_advanced_menu_item_margin',
			[
				'label'      => esc_html__( 'Margin', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .eael-advanced-menu li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .eael-advanced-menu.eael-advanced-menu-horizontal li ul li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'eael_advanced_menu_item_indicator_heading_0',
            [
                'label' => __('Dropdown Indicator', 'essential-addons-elementor'),
                'type' => Controls_Manager::HEADING,

            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_indicator',
            [
                'label' => __('Icon', 'essential-addons-elementor'),
                'type' => Controls_Manager::ICONS,
                'recommended' => [
                    'fa-solid' => [
                        'fas fa-angle-down',
                    ]
                ],
                'default' => [
                    'value' => 'fas fa-angle-down',
                    'library' => 'fa-solid',
                ],

            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_indicator_note_0',
            [
                'label' => __('Important Note', 'essential-addons-elementor'),
                'show_label' => false,
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('<div style="font-size: 11px;font-style:italic;line-height:1.4;color:#a4afb7;">Following options are only available in the <span style="color:#d30c5c"><strong>Small</strong></span> screens for <span style="color:#d30c5c"><strong>Horizontal</strong></span> Layout, and all screens for <span style="color:#d30c5c"><strong>Vertical</strong></span> Layout</div>', 'essential-addons-elementor'),
            ]
        );

        $this->add_control(
			'eael_advanced_menu_item_indicator_width',
			[
				'label'      => esc_html__( 'Icon Size', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu .eael-advanced-menu-indicator svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu.eael-advanced-menu-horizontal li a span svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu .eael-advanced-menu-indicator i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'eael_advanced_menu_item_indicator_margin',
            [
                'label'      => esc_html__( 'Margin', 'essential-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu .eael-advanced-menu-indicator svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu.eael-advanced-menu-horizontal li a span svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu .eael-advanced-menu-indicator i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('eael_advanced_menu_top_level_item');

        $this->start_controls_tab(
            'eael_advanced_menu_top_level_item_default',
            [
                'label' => __('Default', 'essential-addons-elementor'),
            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_color',
            [
                'label' => __('Text Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu-toggle-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_background',
            [
                'label' => __('Background Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li > a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_indicator_heading',
            [
                'label' => __('Dropdown Indicator', 'essential-addons-elementor'),
                'type' => Controls_Manager::HEADING,

            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_indicator_note',
            [
                'label' => __('Important Note', 'essential-addons-elementor'),
                'show_label' => false,
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('<div style="font-size: 11px;font-style:italic;line-height:1.4;color:#a4afb7;">Following options are only available in the <span style="color:#d30c5c"><strong>Small</strong></span> screens for <span style="color:#d30c5c"><strong>Horizontal</strong></span> Layout, and all screens for <span style="color:#d30c5c"><strong>Vertical</strong></span> Layout</div>', 'essential-addons-elementor'),
            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_indicator_color',
            [
                'label' => __('Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li .eael-advanced-menu-indicator i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu.eael-advanced-menu-horizontal li a span svg path' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu .eael-advanced-menu-indicator svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_indicator_background',
            [
                'label' => __('Background Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4caf50',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li .eael-advanced-menu-indicator' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_indicator_border',
            [
                'label' => __('Border Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li .eael-advanced-menu-indicator' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'eael_advanced_menu_top_level_item_hover',
            [
                'label' => __('Hover', 'essential-addons-elementor'),
            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_color_hover',
            [
                'label' => __('Text Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li:hover > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu li.current-menu-item > a.eael-item-active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu li.current-menu-ancestor > a.eael-item-active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_background_hover',
            [
                'label' => __('Background Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#419544',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li:hover > a' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu li.current-menu-item > a.eael-item-active' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu li.current-menu-ancestor > a.eael-item-active' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_indicator_hover_heading',
            [
                'label' => __('Dropdown Indicator', 'essential-addons-elementor'),
                'type' => Controls_Manager::HEADING,

            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_indicator_hover_note',
            [
                'label' => __('Important Note', 'essential-addons-elementor'),
                'show_label' => false,
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('<div style="font-size: 11px;font-style:italic;line-height:1.4;color:#a4afb7;">Following options are only available in the <span style="color:#d30c5c"><strong>Small</strong></span> screens for <span style="color:#d30c5c"><strong>Horizontal</strong></span> Layout, and all screens for <span style="color:#d30c5c"><strong>Vertical</strong></span> Layout</div>', 'essential-addons-elementor'),

            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_indicator_color_hover',
            [
                'label' => __('Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4caf50',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu.eael-advanced-menu-horizontal li > a:hover span i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu .eael-advanced-menu-indicator:hover i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu .eael-advanced-menu-indicator:hover svg path' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu.eael-advanced-menu-horizontal li a:hover span svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_indicator_background_hover',
            [
                'label' => __('Background Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li .eael-advanced-menu-indicator:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu li .eael-advanced-menu-indicator.eael-advanced-menu-indicator-open' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_item_indicator_border_hover',
            [
                'label' => __('Border Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li .eael-advanced-menu-indicator:hover' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu li .eael-advanced-menu-indicator.eael-advanced-menu-indicator-open' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
    }

    public function section_style_dropdown_item(Widget_Base $widget)
    {
        $this->parent = $widget;

        $this->add_control(
            'eael_advanced_menu_dropdown_item_divider_color',
            [
                'label' => __('Divider Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu.eael-advanced-menu-horizontal li ul li > a' => 'border-bottom-color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu.eael-advanced-menu-vertical li ul li > a' => 'border-bottom-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_indicator_heading_0',
            [
                'label' => __('Dropdown Indicator', 'essential-addons-elementor'),
                'type' => Controls_Manager::HEADING,

            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_indicator',
            [
                'label' => __('Icon', 'essential-addons-elementor'),
                'type' => Controls_Manager::ICONS,
                'recommended' => [
                    'fa-solid' => [
                        'fas fa-angle-down',
                    ]
                ],
                'default' => [
                    'value' => 'fas fa-angle-down',
                    'library' => 'fa-solid',
                ],

            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_indicator_note_0',
            [
                'label' => __('Important Note', 'essential-addons-elementor'),
                'show_label' => false,
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('<div style="font-size: 11px;font-style:italic;line-height:1.4;color:#a4afb7;">Following options are only available in the <span style="color:#d30c5c"><strong>Small</strong></span> screens for <span style="color:#d30c5c"><strong>Horizontal</strong></span> Layout, and all screens for <span style="color:#d30c5c"><strong>Vertical</strong></span> Layout</div>', 'essential-addons-elementor'),
            ]
        );

        $this->add_control(
			'eael_advanced_menu_dropdown_item_indicator_width',
			[
				'label'      => esc_html__( 'Icon Size', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu.eael-advanced-menu-horizontal li ul li a span svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu.eael-advanced-menu-horizontal ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .eael-advanced-menu li ul li .eael-advanced-menu-indicator' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'eael_advanced_menu_dropdown_item_indicator_margin',
            [
                'label'      => esc_html__( 'Margin', 'essential-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu.eael-advanced-menu-horizontal li ul li a span svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu.eael-advanced-menu-horizontal ul li i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_alignment',
            [
                'label' => __('Alignment', 'essential-addons-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'eael-advanced-menu-dropdown-align-left' => [
                        'title' => __('Left', 'essential-addons-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'eael-advanced-menu-dropdown-align-center' => [
                        'title' => __('Center', 'essential-addons-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'eael-advanced-menu-dropdown-align-right' => [
                        'title' => __('Right', 'essential-addons-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'eael-advanced-menu-dropdown-align-left',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'eael_advanced_menu_dropdown_item_typography',
                'label' => __('Typography', 'essential-addons-elementor'),
                'global' => [
	                'default' => Global_Typography::TYPOGRAPHY_PRIMARY
                ],
                'selector' => '{{WRAPPER}} .eael-advanced-menu li ul li > a',
                'fields_options' => [
                    'font_family' => [
                        'default' => 'Ubuntu',
                    ],
                    'font_size' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '13',
                        ],
                    ],
                    'font_weight' => [
                        'default' => '400',
                    ],
                    'line_height' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '50',
                        ],
                    ],
                ],
            ]
        );

        $this->start_controls_tabs('eael_advanced_menu_dropdown_item');

        $this->start_controls_tab(
            'eael_advanced_menu_dropdown_item_default',
            [
                'label' => __('Default', 'essential-addons-elementor'),
            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_color',
            [
                'label' => __('Text Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li ul li > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_background',
            [
                'label' => __('Background Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li ul li > a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_indicator_heading',
            [
                'label' => __('Dropdown Indicator', 'essential-addons-elementor'),
                'type' => Controls_Manager::HEADING,

            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_indicator_note',
            [
                'label' => __('Important Note', 'essential-addons-elementor'),
                'show_label' => false,
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('<div style="font-size: 11px;font-style:italic;line-height:1.4;color:#a4afb7;">Following options are only available in the <span style="color:#d30c5c"><strong>Small</strong></span> screens for <span style="color:#d30c5c"><strong>Horizontal</strong></span> Layout, and all screens for <span style="color:#d30c5c"><strong>Vertical</strong></span> Layout</div>', 'essential-addons-elementor'),
            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_indicator_color',
            [
                'label'     => __('Color', 'essential-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#4caf50',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li ul li .eael-advanced-menu-indicator i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu li ul li .eael-advanced-menu-indicator.eael-dropdown-indicator i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu.eael-advanced-menu-horizontal ul li i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu.eael-advanced-menu-horizontal li ul li a span svg path' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu.eael-advanced-menu-vertical .sub-menu .eael-dropdown-indicator svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_indicator_background',
            [
                'label' => __('Background Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li ul li .eael-advanced-menu-indicator' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_indicator_border',
            [
                'label' => __('Border Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4caf50',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li ul li .eael-advanced-menu-indicator' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'eael_advanced_menu_dropdown_item_hover',
            [
                'label' => __('Hover', 'essential-addons-elementor'),
            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_color_hover',
            [
                'label' => __('Text Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li ul li:hover > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu li ul li.current-menu-item > a.eael-item-active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu li ul li.current-menu-ancestor > a.eael-item-active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_background_hover',
            [
                'label' => __('Background Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#39833c',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li ul li:hover > a' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu li ul li.current-menu-item > a.eael-item-active' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu li ul li.current-menu-ancestor > a.eael-item-active' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_indicator_hover_heading',
            [
                'label' => __('Dropdown Indicator', 'essential-addons-elementor'),
                'type' => Controls_Manager::HEADING,

            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_indicator_hover_note',
            [
                'label' => __('Important Note', 'essential-addons-elementor'),
                'show_label' => false,
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('<div style="font-size: 11px;font-style:italic;line-height:1.4;color:#a4afb7;">Following options are only available in the <span style="color:#d30c5c"><strong>Small</strong></span> screens for <span style="color:#d30c5c"><strong>Horizontal</strong></span> Layout, and all screens for <span style="color:#d30c5c"><strong>Vertical</strong></span> Layout</div>', 'essential-addons-elementor'),

            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_indicator_color_hover',
            [
                'label' => __('Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu.eael-advanced-menu-horizontal li ul li a:hover i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu.eael-advanced-menu-vertical .eael-advanced-menu-indicator.eael-dropdown-indicator:hover i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu.eael-advanced-menu-horizontal li ul li a:hover span svg path' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu-container .eael-advanced-menu.eael-advanced-menu-vertical .eael-advanced-menu-indicator.eael-dropdown-indicator:hover svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_indicator_background_hover',
            [
                'label' => __('Background Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4caf50',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li ul li .eael-advanced-menu-indicator:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu li ul li .eael-advanced-menu-indicator.eael-advanced-menu-indicator-open' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eael_advanced_menu_dropdown_item_indicator_border_hover',
            [
                'label' => __('Border Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4caf50',
                'selectors' => [
                    '{{WRAPPER}} .eael-advanced-menu li ul li .eael-advanced-menu-indicator:hover' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .eael-advanced-menu li ul li .eael-advanced-menu-indicator.eael-advanced-menu-indicator-open' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
    }

    public function render()
    {
        $settings = $this->parent->get_settings();
        $menu_classes = ['eael-advanced-menu', $settings['skin_seven_eael_advanced_menu_dropdown_animation'], 'eael-advanced-menu-indicator', $settings['eael_advanced_menu_hamburger_menu_item_alignment'] ];
        $container_classes = ['eael-advanced-menu-container', $settings['skin_seven_eael_advanced_menu_item_alignment'], $settings['skin_seven_eael_advanced_menu_dropdown_item_alignment']];
        $hamburger_device = ! empty( $settings['eael_advanced_menu_dropdown'] ) ? esc_html( $settings['eael_advanced_menu_dropdown'] ) : esc_html( 'tablet' );

        if( \Elementor\Plugin::instance()->editor->is_edit_mode() ){
            $container_classes[] = 'eael-hamburger--not-responsive';
        }
        
        if ($settings['skin_seven_eael_advanced_menu_layout'] == 'horizontal') {
            $menu_classes[] = 'eael-advanced-menu-horizontal';
        } else {
            $menu_classes[] = 'eael-advanced-menu-vertical';
        }

        if (isset($settings['skin_seven_eael_advanced_menu_item_dropdown_indicator']) && $settings['skin_seven_eael_advanced_menu_item_dropdown_indicator'] == 'yes') {
            $menu_classes[] = 'eael-advanced-menu-indicator';
        }

        if (isset($settings['eael_advanced_menu_hamburger_icon'])) {
            ob_start();
            Icons_Manager::render_icon( $settings['eael_advanced_menu_hamburger_icon'], [ 'aria-hidden' => 'true' ] );
            $hamburger_icon = ob_get_clean();
            $this->parent->add_render_attribute( 'eael-advanced-menu', 'data-hamburger-icon', $hamburger_icon );
        }

        //For Vertical Menu
        if ( isset( $settings['skin_seven_eael_advanced_menu_item_indicator'] ) ) {
            ob_start();
            Icons_Manager::render_icon( $settings['skin_seven_eael_advanced_menu_item_indicator'], [ 'aria-hidden' => 'true' ] );
            $advanced_menu_indicator_icon = ob_get_clean();
	        $this->parent->add_render_attribute( 'eael-advanced-menu', 'data-indicator-class', $advanced_menu_indicator_icon );
        }

        //For Dropdown Menu
        if ( isset( $settings['skin_seven_eael_advanced_menu_dropdown_item_indicator'] ) ) {
            ob_start();
            Icons_Manager::render_icon( $settings['skin_seven_eael_advanced_menu_dropdown_item_indicator'], [ 'aria-hidden' => 'true' ] );
            $advanced_menu_dropdown_item_indicator = ob_get_clean();
	        $this->parent->add_render_attribute( 'eael-advanced-menu', 'data-dropdown-indicator-class', $advanced_menu_dropdown_item_indicator );
        }

        $this->parent->add_render_attribute('eael-advanced-menu', [
            'class' => implode(' ', array_filter($container_classes)),
            'data-hamburger-breakpoints' => wp_json_encode( Helper::get_breakpoint_dropdown_options() ),
            'data-hamburger-device' => $hamburger_device,
        ]);

        if ($settings['eael_advanced_menu_menu']) {
            $args = [
                'menu' => $settings['eael_advanced_menu_menu'],
                'menu_class' => implode(' ', array_filter($menu_classes)),
                'fallback_cb' => '__return_empty_string',
                'container' => false,
                'echo' => false
            ];

            //Check breakpoint form hamburger options
	        if ( ! empty( $hamburger_device ) && 'none' !== $hamburger_device ) {
		        if ( 'desktop' === $hamburger_device ) {
			        $breakpoints                     = method_exists( Plugin::$instance->breakpoints, 'get_breakpoints_config' ) ? Plugin::$instance->breakpoints->get_breakpoints_config() : [];
			        $eael_get_breakpoint_from_option = isset( $breakpoints['widescreen'] ) ? $breakpoints['widescreen']['value'] - 1 : 2400;
		        } else {
			        $eael_get_breakpoint_from_option = Plugin::$instance->breakpoints->get_breakpoints( $hamburger_device )->get_value();
		        }

		        echo "<style>
                        @media screen and (max-width: ". esc_html( $eael_get_breakpoint_from_option ) ."px) {
                            .eael-hamburger--". esc_html( $hamburger_device ) ." {
                                .eael-advanced-menu-horizontal,
                                .eael-advanced-menu-vertical {
                                    display: none;
                                }
                            }
                            .eael-hamburger--" . esc_html( $hamburger_device ) . " {
                                .eael-advanced-menu-container .eael-advanced-menu-toggle {
                                    display: block;
                                }
                            }
                        }
                    </style>";
	        }
            ?>
            <div <?php $this->parent->print_render_attribute_string( 'eael-advanced-menu' ); ?>>
                <?php echo wp_nav_menu( $args ); ?>
                <button class="eael-advanced-menu-toggle" aria-label="<?php esc_attr_e( 'Essential Addons Toggle Menu', 'essential-addons-elementor' ); ?>">
                    <?php Icons_Manager::render_icon( $settings['eael_advanced_menu_hamburger_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </button>
            </div>
            <?php
        }
    }
}
