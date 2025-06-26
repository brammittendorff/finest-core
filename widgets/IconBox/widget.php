<?php

namespace FBTH_Addons\Widgets;

if (!defined('ABSPATH')) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use \Elementor\Widget_Base;

class FBTH_Icon_Box extends Widget_Base
{

	public function get_name()
	{
		return 'fbth-icon-box';
	}

	public function get_title()
	{
		return esc_html__('Icon Box', 'fbth');
	}

	public function get_icon()
	{
		return 'fbth eicon-icon-box';
	}

	public function get_categories()
	{
		return ['fbth'];
	}

	public function get_keywords()
	{
		return ['info', 'box', 'icon'];
	}

	protected function register_controls()
	{

		$primary_color = get_theme_mod('primary_color');
		$secondary_color = get_theme_mod('secondary_color');
		$accent_color = get_theme_mod('accent_color');
		/**
		 * Content tab
		 */
		$this->content_section();
		$this->icon_section_style($primary_color, $secondary_color, $accent_color);
		$this->content_section_style($primary_color, $secondary_color);
		$this->content_button_style();
		$this->section_content_box_style();
	}

	// content section
	protected function content_section()
	{
		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Content', 'fbth'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'enable_button',
			[
				'label' => __('Show Button', 'fbth'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'fbth'),
				'label_off' => __('Hide', 'fbth'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label' => __('Icon type', 'fbth'),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'none'  => __('None', 'fbth'),
					'text'  => __('Text', 'fbth'),
					'icon' => __('Icon', 'fbth'),
					'image' => __('Image', 'fbth'),
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __('Icon', 'fbth'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' => ['icon_type' => 'icon']
			]
		);

		$this->add_control(
			'box_number',
			[
				'label' => __('Box Number', 'fbth'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'condition' => ['icon_type' => 'text']
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __('Choose Image', 'fbth'),
				'type' => Controls_Manager::MEDIA,

				'condition' => ['icon_type' => 'image']
			]
		);

		$this->add_responsive_control(
			'position',
			[
				'label' => __('Icon Position', 'elementor'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __('Left', 'elementor'),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __('Top', 'elementor'),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __('Right', 'elementor'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon[value]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'image[url]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'box_number',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' => __('Icon Align', 'elementor'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'start' => [
						'title' => __('Top', 'elementor'),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __('Center', 'elementor'),
						'icon' => 'fa fa-align-center',
					],
					'end' => [
						'title' => __('Right', 'elementor'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'toggle' => false,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon[value]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'image[url]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'box_number',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __('Title', 'fbth'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Secure & Fast Payment', 'fbth')
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label' => __('Title HTML Tag', 'happy-elementor-addons'),
				'type' => Controls_Manager::CHOOSE,
				'separator' => 'before',
				'options' => [
					'h1'  => [
						'title' => __('H1', 'happy-elementor-addons'),
						'icon' => 'eicon-editor-h1'
					],
					'h2'  => [
						'title' => __('H2', 'happy-elementor-addons'),
						'icon' => 'eicon-editor-h2'
					],
					'h3'  => [
						'title' => __('H3', 'happy-elementor-addons'),
						'icon' => 'eicon-editor-h3'
					],
					'h4'  => [
						'title' => __('H4', 'happy-elementor-addons'),
						'icon' => 'eicon-editor-h4'
					],
					'h5'  => [
						'title' => __('H5', 'happy-elementor-addons'),
						'icon' => 'eicon-editor-h5'
					],
					'h6'  => [
						'title' => __('H6', 'happy-elementor-addons'),
						'icon' => 'eicon-editor-h6'
					]
				],
				'default' => 'h2',
				'toggle' => false,
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __('Description', 'fbth'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __('The most secure and fast payment can be made through cyptrocurrency', 'fbth')
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

		$this->add_control(
			'btn_icon',
			[
				'label' => __('Button Icon', 'fbth'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __('Button Text', 'fbth'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Learn more', 'fbth'),
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->add_control(
			'button_url',
			[
				'label' => __('URL', 'fbth'),
				'type' =>  Controls_Manager::URL,
				

			]
		);


		$this->add_control(
			'button_align',
			[
				'label' => __('Button Align', 'fbth'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => __('Left', 'fbth'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('top', 'fbth'),
						'icon' => 'fa fa-align-center',
					],
					'end' => [
						'title' => __('Right', 'fbth'),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}}  .fbth-addons-rbtn' => 'justify-content: {{VALUE}};'
				],
			]
		);
		

		$this->add_control(
			'content_align',
			[
				'label' => __('Content Align', 'fbth'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'fbth'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('top', 'fbth'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'fbth'),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);

		$this->end_controls_section();
	}

	//icon_section_style
	protected function icon_section_style($primary_color, $secondary_color, $accent_color)
	{
		$this->start_controls_section(
			'icon_style',
			[
				'label' => __('Icon', 'fbth'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => ['icon_type!' => 'none']

			]
		);

		$this->add_responsive_control(
			'flex_wrap',
			[
				'label' => esc_html__('Flex Wrap', 'fbth'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'initial',
				'options' => [
					'initial'  => esc_html__('initial', 'fbth'),
					'wrap' => esc_html__('wrap', 'fbth'),
					'inherit' => esc_html__('inherit', 'fbth'),
				],
				'selectors' => [
					'{{WRAPPER}}  .fbth-addons-feature-box-item.fbth-addons-icon-position-left' => 'flex-wrap: {{VALUE}};'
				],

			]
		);



		$this->start_controls_tabs(
			'icon_hover_tabs'
		);

		$this->start_controls_tab(
			'icon_normal_tab',
			[
				'label' => __('Normal', 'fbth'),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_text_typo',
				'label' => __('Icon Text Typography', 'fbth'),
				'selector' => '{{WRAPPER}} .fbth-addons-feature-icon.icon-type-text',
				'condition' => ['icon_type' => 'text']
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __('Icon Size', 'fbth'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'desktop_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}}  .fbth-addons-feature-box-item .fbth-addons-feature-icon.icon-type-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .fbth-addons-feature-box-item .fbth-addons-feature-icon.icon-type-icon svg' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .fbth-addons-feature-box-item .fbth-addons-feature-icon.icon-type-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => 'icon',
				]
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __('Icon Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'default'   => $primary_color,
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-feature-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .fbth-addons-feature-icon svg' => 'color: {{VALUE}}',
					'{{WRAPPER}} .fbth-addons-feature-icon svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .fbth-addons-feature-box-item .icon-background-yes .fbth-addons-feature-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .fbth-addons-feature-icon.icon-type-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_color_fill',
			[
				'label' => __('Icon  Fill Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'default'   => $primary_color,
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-feature-icon svg path' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'enable_icon_box',
			[
				'label' => __('Enable Icon Box', 'fbth'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'fbth'),
				'label_off' => __('Hide', 'fbth'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_responsive_control(
			'icon_box_size',
			[
				'label' => __('Icon Box Size', 'fbth'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'desktop_default' => [
					'size' => 70,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}}  .fbth-addons-feature-box-item .icon-background-yes .fbth-addons-feature-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['enable_icon_box' => 'yes']
			]
		);
		$this->add_control(
			'icon_background',
			[
				'label' => __('Icon Background', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'default'   => $accent_color,
				'selectors' => [
					'{{WRAPPER}} .icon-background-yes .fbth-addons-feature-icon' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'enable_icon_box' => 'yes'
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => __('Icon Border Radius', 'fbth'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'	=>	[
					'top' => '50',
					'right' => '50',
					'bottom' => '50',
					'left' => '50'
				],
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-feature-box-item .icon-background-yes .fbth-addons-feature-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .fbth-addons-feature-box-item .fbth-addons-feature-icon.icon-type-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .fbth-addons-feature-box-item .icon-background-yes .fbth-addons-feature-icon' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
				'condition' => ['enable_icon_box' => 'yes']
			]
		);

		$this->add_responsive_control(
			'space_between_icon',
			[
				'label' => __('Gap', 'fbth'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-feature-icon-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .fbth-addons-feature-icon-wrap' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' => __('Icon Border', 'fbth'),
				'selector' => '{{WRAPPER}} .fbth-addons-feature-icon-wrap',
			]
		);
		$this->add_responsive_control(
			'space_gap_icon',
			[
				'label' => __('Padding', 'fbth'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} span.fbth-addons-feature-icon.icon-type-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow',
				'label' => __('Icon Shadow', 'fbth'),
				'selector' => '{{WRAPPER}} .fbth-addons-feature-icon',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => __('Hover', 'fbth'),
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label' => __('Icon Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .fbth-addons-feature-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}}:hover .fbth-addons-feature-icon svg' => 'color: {{VALUE}}',
					'{{WRAPPER}}:hover .fbth-addons-feature-icon svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}}:hover .fbth-addons-feature-icon.icon-type-text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon_color_fill_hover',
			[
				'label' => __('Icon  Stroke Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}}:hover .fbth-addons-feature-icon svg path' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_hover_background',
			[
				'label' => __('Icon Background', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'default'   => $secondary_color,
				'selectors' => [
					'{{WRAPPER}}:hover .icon-background-yes .fbth-addons-feature-icon' => 'background-color: {{VALUE}}',
				],
				'condition' => ['enable_icon_box' => 'yes']
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow_hover',
				'label' => __('Icon Shadow', 'fbth'),
				'selector' => '{{WRAPPER}}:hover .fbth-addons-feature-icon',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border_hover',
				'label' => __('Icon Border', 'fbth'),
				'selector' => '{{WRAPPER}}  .fbth-addons-feature-box-item:hover span.fbth-addons-feature-icon',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'icon_br',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label' => __('Image Width', 'fbth'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}}  .fbth-addons-feature-box-item .fbth-addons-feature-icon.icon-type-image img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .fbth-addons-feature-box-item .fbth-addons-feature-icon.icon-type-image' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => 'image'
				]
			]
		);
		$this->add_responsive_control(
			'image_height',
			[
				'label' => __('Image Height', 'fbth'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}}  .fbth-addons-feature-box-item .fbth-addons-feature-icon.icon-type-image img' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .fbth-addons-feature-box-item .fbth-addons-feature-icon.icon-type-image' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => 'image'
				]
			]
		);

		$this->end_controls_section();
	}

	//content_section_style
	protected function content_section_style($primary_color, $secondary_color)
	{
		$this->start_controls_section(
			'content_style',
			[
				'label' => __('Content', 'fbth'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'content_tabs'
		);

		$this->start_controls_tab(
			'content_normal_tab',
			[
				'label' => __('Normal', 'fbth'),
			]
		);

		$this->add_control(
			'title_br',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => ['enable_box_number' => 'yes']
			]
		);
		$this->add_responsive_control(
			'title_gap',
			[
				'label' => __('Title Gap', 'fbth'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'desktop_default' => [
					'size' => 0,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 0,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 0,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-feature-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __('Title Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'default'   => $secondary_color,
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-feature-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'label' => __('Title Typography', 'fbth'),
				'selector' => '{{WRAPPER}} .fbth-addons-feature-title',
			]
		);

		$this->add_control(
			'heading_bg',
			[
				'label' => __('Heading Background Color', 'fbth'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-feature-title' => 'background: {{VALUE}}',
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'title_border',
				'label'    => __('Title Border', 'fbth'),
				'selector' => '{{WRAPPER}} .fbth-addons-feature-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_box_shadow',
				'label' => __('Title Box Shadow', 'massmix-ts'),
				'selector' => '{{WRAPPER}} .fbth-addons-feature-title',
			]
		);

		$this->add_responsive_control(
			'title_border_radius',
			[
				'label'      => __('Title Border Radius', 'fbth'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .fbth-addons-feature-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __('Title Padding', 'upmedix'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-feature-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'desc_br',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'desscription_color',
			[
				'label' => __('Description Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'default'   => $primary_color,
				'selectors' => [
					'{{WRAPPER}} .fbth-iconbox-addons-feature-content p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __('Description Typography', 'fbth'),
				'selector' => '{{WRAPPER}} .fbth-iconbox-addons-feature-content p',
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __('Content Padding', 'fbth'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .fbth-iconbox-addons-feature-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_margin',
			[
				'label' => __('Content Margin', 'fbth'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .fbth-iconbox-addons-feature-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'content_hover_tab',
			[
				'label' => __('Hover', 'fbth'),
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => __('Title Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'default'   => $secondary_color,
				'selectors' => [
					'{{WRAPPER}}:hover .fbth-addons-feature-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'desscription_color_hover',
			[
				'label' => __('Description Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'default'   => $primary_color,
				'selectors' => [
					'{{WRAPPER}}:hover .fbth-iconbox-addons-feature-content p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Summary of content_button_style
	 * @return void
	 */
	protected function content_button_style()
	{
		$this->start_controls_section(
			'button_style',
			[
				'label' => __('Button', 'fbth'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->start_controls_tabs(
			'btn_style_tabs'
		);
		$this->start_controls_tab(
			'btn_style_normal_tab',
			[
				'label' => __('Normal', 'fbth'),
			]
		);
		$this->add_responsive_control(
			'btn_width',
			[
				'label' => __('Button width', 'fbth'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-rbtn a' => 'width: {{SIZE}}{{UNIT}};',
				],

			]
		);
		$this->add_responsive_control(
			'btn_height',
			[
				'label' => __('Button Height', 'fbth'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-rbtn a' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __('Text Typography', 'fbth'),
				'selector' => '{{WRAPPER}} .fbth-addons-rbtn a',
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => __('Text Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-rbtn a' => 'color: {{VALUE}}',
				],

			]
		);
		$this->add_control(
			'button_background',
			[
				'label' => __('Background Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-rbtn a' => 'background-color: {{VALUE}}',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_border',
				'label' => __('Border', 'fbth'),
				'selector' => '{{WRAPPER}} .fbth-addons-rbtn a',
			]
		);
		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __('Padding', 'fbth'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'	=>	[
					'top' => '20',
					'right' => '45',
					'bottom' => '20',
					'left' => '45'
				],
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-rbtn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]
		);
		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => __('Border Radius', 'fbth'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-rbtn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]
		);
		$this->add_control(
			'icon_options',
			[
				'label' => esc_html__('Icon Options', 'fbth'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'btn_icon_color',
			[
				'label' => __('Icon Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-rbtn span.btn-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .fbth-addons-rbtn span.btn-icon svg path' => 'stroke: {{VALUE}}',
					
				],
			]
		);
		$this->add_responsive_control(
			'btn_icon_size',
			[
				'label' => __('Button Icon Size', 'fbth'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .fbth-addons-rbtn span.btn-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .fbth-addons-rbtn span.btn-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->add_responsive_control(
			'btn_icon_gap',
			[
				'label' => __('Icon Gap', 'fbth'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-rbtn span.btn-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .fbth-addons-rbtn span.btn-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .fbth-addons-rbtn span.btn-icon svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'btn_style_hover_tab',
			[
				'label' => __('Hover', 'fbth'),
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => __('Button Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-rbtn:hover a' => 'color: {{VALUE}}',
				],

			]
		);
		$this->add_control(
			'btn_icon_color_hover',
			[
				'label' => __('Icon Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-rbtn:hover span.btn-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .fbth-addons-rbtn:hover span.btn-icon svg path' => 'fill: {{VALUE}}',
					
					
				],
			]
		);
		
		$this->add_control(
			'button_hover_background',
			[
				'label' => __('Button Background Color', 'fbth'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-rbtn:hover a' => 'background-color: {{VALUE}}',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_hvr_border',
				'label' => __('Border', 'fbth'),
				'selector' => '{{WRAPPER}} .fbth-addons-rbtn:hover a',
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	// section_content_box_style
	protected function section_content_box_style()
	{
		$this->start_controls_section(
			'section_content_box_style',
			[
				'label' => __('Box', 'fastland-hp'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'box_style_tabs'
		);

		$this->start_controls_tab(
			'box_style_normal_tab',
			[
				'label' => __('Normal', 'fastland-hp'),
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label'     => __('Box Backgroound Color', 'fastland-hp'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#C9C9C9',
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-feature-box-item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __('Box Shadow', 'fastland-hp'),
				'selector' => '{{WRAPPER}} .fbth-addons-feature-box-item',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __('Box Border', ''),
				'selector' => '{{WRAPPER}} .fbth-addons-feature-box-item',
			]
		);
		$this->add_responsive_control(
			'box-width',
			[
				'label' => __('Width', 'fbth'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .fbth-addons-feature-box-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box-height',
			[
				'label' => __('Height', 'fbth'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .fbth-addons-feature-box-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label'      => __('Box Radius', 'fastland-hp'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-addons-feature-box-item'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __('Box Padding', 'fastland-hp'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-addons-feature-box-item ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'box_style_hover_tab',
			[
				'label' => __('Hover', 'fastland-hp'),
			]
		);

		$this->add_control(
			'box_hover_bg_color',
			[
				'label'     => __('Box Backgroound Color', 'fastland-hp'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'defautl'   => '#233aff',
				'selectors' => [
					'{{WRAPPER}} .fbth-addons-feature-box-item:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_hover_radius',
			[
				'label'      => __('Box Radius', 'fastland-hp'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-addons-feature-box-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_hover_shadow',
				'label'    => __('Box Hover Shadow', 'fastland-hp'),
				'selector' => '{{WRAPPER}} .fbth-addons-feature-box-item:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'box_hover_border',
				'label'    => __('Box Border', ''),
				'selector' => '{{WRAPPER}} .fbth-addons-feature-box-item:hover ',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$target = isset($settings['button_url']['is_external']) ? ' target="_blank"' : '';
		$nofollow = isset($settings['button_url']['nofollow']) ? ' rel="nofollow"' : '';
		$this->add_inline_editing_attributes('title', 'none');
		$this->add_inline_editing_attributes('description', 'basic');
		$enable_iconb_box = ($settings['enable_icon_box']) ? 'yes' : 'no';
		$this->add_render_attribute('title', 'class', 'fbth-addons-feature-title');
		$this->add_render_attribute('description', 'class', 'fbth-size-' . $settings['size']);
?>

			<!-- box link  -->
			<?php if('yes' != $settings['enable_button'] && !empty($settings['button_url']['url'] )){
				echo '<a class="d-block" href="'.esc_url($settings['button_url']['url']).'" '.$nofollow. $target.'>';
			} ?>

		<div class="fbth-addons-feature-box-item <?php printf("fbth-addons-feature-icon-%s fbth-addons-icon-position-%s",  esc_attr($settings['content_align'] ?? ''), esc_attr($settings['position'] ?? '')) ?>">

			<?php if (!empty($settings["icon"]['value']) || !empty($settings['image']) || !empty($settings['box_number'])) : ?>
				<div class="fbth-addons-feature-icon-wrap <?php printf("icon-background-%s align-items-%s", esc_attr($enable_iconb_box), esc_attr($settings['icon_align'])) ?>">
					<span class="fbth-addons-feature-icon icon-type-<?php echo $settings['icon_type'] ?>">
						<?php
						if ('text' == $settings['icon_type']) {
						?>
							<?php echo esc_html($settings['box_number']); ?>
						<?php
						} elseif ('image' == $settings['icon_type']) {
							echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings);
						} else {
							\Elementor\Icons_Manager::render_icon($settings["icon"], ['aria-hidden' => 'true']);
						}

						?>
					</span>
				</div>
			<?php endif; ?>

			<div class="fbth-addons-feature-content-wrap">
				<div class="fbth-iconbox-addons-feature-content">
					<?php if (!empty($settings['title'])) :
						printf(
							'<%1$s %2$s>%3$s</%1$s>',
							tag_escape($settings['title_tag']),
							$this->get_render_attribute_string('title'),
							scalo_kses_basic($settings['title'])
						); ?>
					<?php endif; ?>

					<?php if (!empty($settings['description'])) : ?>
						<p <?php echo $this->get_render_attribute_string('description') ?>><?php echo $settings['description'] ?></p>
					<?php endif; ?>
				</div>
				<?php if ('yes' == $settings['enable_button']) { ?>
					<div class="fbth-addons-rbtn">
						<a <?php printf('href="%s" %s %s', $settings['button_url']['url'], $nofollow, $target) ?>>
							<?php echo $settings['button_text']; ?>
							<span class="btn-icon">
								<?php \Elementor\Icons_Manager::render_icon($settings["btn_icon"], ['aria-hidden' => 'true']); ?>
							</span>
						</a>
					</div>
				<?php } ?>

			</div>

		</div> 

			<!-- box link  -->
			<?php if('yes' != $settings['enable_button'] && !empty($settings['button_url']['url'] )){
			echo "</a>";
		}
		?>
			<!-- box link  -->
<?php
	}
	protected function content_template()
	{
	}
}
$widgets_manager->register(new \FBTH_Addons\Widgets\FBTH_Icon_Box());
