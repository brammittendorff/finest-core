<?php

namespace FBTH\Widgets\Elementor;

if (!defined('ABSPATH')) exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use FBTH\Elementor\Traits\Button_Markup;



class FBTH_Creative_Button extends Widget_Base
{

	use Button_Markup;

	/**
	 * Get widget name.
	 */
	public function get_name()
	{
		return 'fbth-creative-button';
	}
	/**
	 * Get widget title.
	 */
	public function get_title()
	{
		return __('Creative Button', 'fbth');
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon()
	{
		return 'fbth eicon-button';
	}

	/**
	 * Get widget category.
	 */
	public function get_categories()
	{
		return ['fbth'];
	}

	public function get_keywords()
	{
		return ['button', 'btn', 'advance', 'link', 'creative', 'creative-button', 'fbth'];
	}

	/**
	 * Register widget content controls
	 */
	protected function register_controls()
	{
		$primary_color = get_theme_mod('primary_color');
		$secondary_color = get_theme_mod('secondary_color');
		$accent_color = get_theme_mod('accent_color');

		$this->start_controls_section(
			'_section_button',
			[
				'label' => __('Creative Button', 'fbth'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'btn_style',
			[
				'label'   => __('Style', 'fbth'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hermosa',
				'options' => [
					'hermosa'   => __('Hermosa', 'fbth'),
					'montino'   => __('Montino', 'fbth'),
					'iconica'   => __('Iconica', 'fbth'),
					'symbolab'   => __('Symbolab', 'fbth'),
					'estilo'   => __('Estilo', 'fbth'),
				],
			]
		);

		$this->add_control(
			'estilo_effect',
			[
				'label'   => __('Effects', 'fbth'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dissolve',
				'options' => [
					'dissolve'   => __('Dissolve', 'fbth'),
					'slide-down'   => __('Slide In Down', 'fbth'),
					'slide-right'   => __('Slide In Right', 'fbth'),
					'slide-x'   => __('Slide Out X', 'fbth'),
					'cross-slider'   => __('Cross Slider', 'fbth'),
					'slide-y'   => __('Slide Out Y', 'fbth'),
				],
				'condition' => [
					'btn_style' => 'estilo'
				]
			]
		);

		$this->add_control(
			'symbolab_effect',
			[
				'label'   => __('Effects', 'fbth'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'back-in-right',
				'options' => [
					'back-in-right'   => __('Back In Right', 'fbth'),
					'back-in-left'   => __('Back In Left', 'fbth'),
					'back-out-right'   => __('Back Out Right', 'fbth'),
					'back-out-left'   => __('Back Out Left', 'fbth'),
				],
				'condition' => [
					'btn_style' => 'symbolab'
				]
			]
		);

		$this->add_control(
			'iconica_effect',
			[
				'label'   => __('Effects', 'fbth'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'slide-in-down',
				'options' => [
					'slide-in-down'   => __('Slide In Down', 'fbth'),
					'slide-in-top'   => __('Slide In Top', 'fbth'),
					'slide-in-right'   => __('Slide In Right', 'fbth'),
					'slide-in-left'   => __('Slide In Left', 'fbth'),
				],
				'condition' => [
					'btn_style' => 'iconica'
				]
			]
		);

		$this->add_control(
			'montino_effect',
			[
				'label'   => __('Effects', 'fbth'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'winona',
				'options' => [
					'winona'   => __('Winona', 'fbth'),
					'rayen'   => __('Rayen', 'fbth'),
					'aylen'   => __('Aylen', 'fbth'),
					'wapasha'   => __('Wapasha', 'fbth'),
					'nina'   => __('Nina', 'fbth'),
					'antiman'   => __('Antiman', 'fbth'),
					'sacnite'   => __('Sacnite', 'fbth'),
				],
				'condition' => [
					'btn_style' => 'montino'
				]
			]
		);

		$this->add_control(
			'hermosa_effect',
			[
				'label'   => __('Effects', 'fbth'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'exploit',
				'options' => [
					'exploit'   => __('Exploit', 'fbth'),
					'upward'   => __('Upward', 'fbth'),
					'newbie'   => __('Newbie', 'fbth'),
					'render'   => __('Render', 'fbth'),
					'reshape'   => __('Reshape', 'fbth'),
					'expandable'   => __('Expandable', 'fbth'),
					'downhill'   => __('Downhill', 'fbth'),
					'bloom'   => __('Bloom', 'fbth'),
					'roundup'   => __('Roundup', 'fbth'),
				],
				'condition' => [
					'btn_style' => 'hermosa'
				]
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __('Text', 'fbth'),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => 'Button Text',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'button_link',
			array(
				'label'         => __('Link', 'fbth'),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __('https://your-link.com', 'fbth'),
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => true,
				),
			)
		);

		$this->add_control(
			'icon',
			[
				'label' => __('Icon', 'fbth'),
				'description' => __('Please set an icon for the button.', 'fbth'),
				'label_block' => false,
				'type' => Controls_Manager::ICONS,
				'skin' => 'inline',
				'exclude_inline_options' => ['svg'],
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'symbolab',
								],
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'iconica',
								],
							],
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'expandable',
								],
							],
						]
					]
				],
			]
		);

		$this->add_responsive_control(
			'align_x',
			[
				'label' => __('Alignment', 'fbth'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __('Left', 'fbth'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __('Center', 'fbth'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __('Right', 'fbth'),
						'icon' => 'eicon-h-align-right',
					]
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'magnetic_enable',
			[
				'label'        => __('Magnetic Effect', 'fbth'),
				'type'         => Controls_Manager::SWITCHER,
				'label_block'  => false,
				'return_value' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'threshold',
			[
				'label' => __('Threshold', 'fbth'),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 30,
				'condition' => [
					'magnetic_enable' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .fbth-creative-btn' => 'margin: {{VALUE}}px;',
				],
			]
		);

		$this->end_controls_section();




		/**
		 * Style section for Estilo, Symbolab, Iconica
		 *
		 * @return void
		 */

		$this->start_controls_section(
			'_estilo_symbolab_iconica_style_section',
			[
				'label' => __('Common', 'fbth'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_item_width',
			[
				'label' => __('Size', 'fbth'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fbth-creative-btn.fbth-eft--downhill' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .fbth-creative-btn.fbth-eft--roundup' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .fbth-creative-btn.fbth-eft--roundup .progress' => 'width: calc({{SIZE}}{{UNIT}} - (({{SIZE}}{{UNIT}} / 100) * 20) ); height:auto;',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'roundup',
								],
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'downhill',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
							],
						]
					]
				]
			]
		);

		$this->add_responsive_control(
			'button_icon_size',
			[
				'label' => __('Icon Size', 'fbth'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .fbth-creative-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'symbolab',
								],
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'iconica',
								],
							],
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'expandable',
								],
							],
						]
					]
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __('Typography', 'fbth'),
				'selector' => '{{WRAPPER}} .fbth-creative-btn',
				'scheme' => Typography::TYPOGRAPHY_4,
			]
		);

		$this->add_control(
			'size',
			[
				'label' => esc_html__('Size', 'fbth'),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__('Default', 'fbth'),
					'small' => esc_html__('Small', 'fbth'),
					'medium' => esc_html__('Medium', 'fbth'),
					'large' => esc_html__('Large', 'fbth'),
					'xl' => esc_html__('XL', 'fbth'),
					'xxl' => esc_html__('XXL', 'fbth'),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'default' => $accent_color,
				'exclude' => ['color'], //remove border color
				'selector' => '{{WRAPPER}} .fbth-creative-btn, {{WRAPPER}} .fbth-creative-btn.fbth-eft--bloom div',
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '!=',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '!=',
									'value' => '',
								],
							],
						]
					]
				]
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => __('Border Radius', 'fbth'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .fbth-creative-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .fbth-creative-btn.fbth-stl--hermosa.fbth-eft--bloom div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_hermosa_roundup_stroke_width',
			[
				'label' => __('Stroke Width', 'fbth'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fbth-creative-btn.fbth-eft--roundup' => '--fbth-ctv-btn-stroke-width: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
							],
						]
					]
				]
			]
		);


		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __('Padding', 'fbth'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .fbth-creative-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .fbth-creative-btn.fbth-stl--iconica > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .fbth-creative-btn.fbth-stl--montino.fbth-eft--winona > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .fbth-creative-btn.fbth-stl--montino.fbth-eft--winona::after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .fbth-creative-btn.fbth-stl--montino.fbth-eft--rayen > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .fbth-creative-btn.fbth-stl--montino.fbth-eft--rayen::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .fbth-creative-btn.fbth-stl--montino.fbth-eft--nina' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .fbth-creative-btn.fbth-stl--montino.fbth-eft--nina::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .fbth-creative-btn.fbth-stl--hermosa.fbth-eft--bloom span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);

		$conditions = [
			'terms' => [
				[
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'hermosa_effect',
							'operator' => '!=',
							'value' => 'roundup',
						],
					],
				],
				[
					'terms' => [
						[
							'name' => 'btn_style',
							'operator' => '!=',
							'value' => '',
						],
					],
				]
			]
		];
		$this->start_controls_tabs('_tabs_button');

		$this->start_controls_tab(
			'_tab_button_normal',
			[
				'label' => __('Normal', 'fbth'),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __('Text Color', 'fbth'),
				'default' => '#000',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-creative-btn-wrap .fbth-creative-btn' => '--fbth-ctv-btn-txt-clr: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => __('Background Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'default' => $accent_color,
				'selectors' => [
					'{{WRAPPER}} .fbth-creative-btn-wrap .fbth-creative-btn' => '--fbth-ctv-btn-bg-clr: {{VALUE}}',
				],
				'conditions' => $conditions,
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' => __('Border Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'default' => $accent_color,
				'selectors' => [
					'{{WRAPPER}} .fbth-creative-btn-wrap .fbth-creative-btn' => '--fbth-ctv-btn-border-clr: {{VALUE}} ',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '!=',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '!=',
									'value' => '',
								],
								[
									'name' => 'button_border_border',
									'operator' => '!=',
									'value' => '',
								],
							],
						]
					]
				]
			]
		);

		$this->add_control(
			'button_roundup_circle_color',
			[
				'label' => __('Circle Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-creative-btn-wrap .fbth-creative-btn.fbth-eft--roundup' => '--fbth-ctv-btn-border-clr: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
							],
						]
					]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .fbth-creative-btn'
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tabs_button_hover',
			[
				'label' => __('Hover', 'fbth'),
			]
		);

		$this->add_control(
			'button_hover_text_color',
			[
				'label' => __('Text Color', 'fbth'),
				'default' => '#fff',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-creative-btn-wrap .fbth-creative-btn' => '--fbth-ctv-btn-txt-hvr-clr: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => __('Background Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'default' => $secondary_color,
				'selectors' => [
					'{{WRAPPER}} .fbth-creative-btn-wrap .fbth-creative-btn' => '--fbth-ctv-btn-bg-hvr-clr: {{VALUE}}',
				],
				'conditions' => $conditions,
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __('Border Color v', 'fbth'),
				'default' => $secondary_color,
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-creative-btn-wrap .fbth-creative-btn' => '--fbth-ctv-btn-border-hvr-clr: {{VALUE}}',
					'{{WRAPPER}} .fbth-creative-btn.fbth-stl--hermosa.fbth-eft--exploit:hover' => 'border-color: {{VALUE}} ',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '!=',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '!=',
									'value' => '',
								],
								[
									'name' => 'button_border_border',
									'operator' => '!=',
									'value' => '',
								],
							],
						]
					]
				]
			]
		);

		$this->add_control(
			'button_hover_roundup_circle_color',
			[
				'label' => __('Circle Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-creative-btn-wrap .fbth-creative-btn.fbth-eft--roundup' => '--fbth-ctv-btn-border-hvr-clr: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
							],
						]
					]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .fbth-creative-btn:hover'
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute('wrap', 'data-magnetic', $settings['magnetic_enable'] ? $settings['magnetic_enable'] : 'no');
		$this->{'render_' . $settings['btn_style'] . '_markup'}($settings);
	}
}
$widgets_manager->register(new \FBTH\Widgets\Elementor\FBTH_Creative_Button());
