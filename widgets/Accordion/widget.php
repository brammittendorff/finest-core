<?php

namespace FBTH_Addons\Widgets;

if (!defined('ABSPATH')) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Control_Media;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Widget_Base;

class FBTH_Accordion extends Widget_Base
{

	public function get_name()
	{
		return 'fbth-accordion';
	}

	public function get_title()
	{
		return esc_html__('Accordion', 'fbth');
	}

	public function get_icon()
	{
		return 'fbth eicon-accordion';
	}


	public function get_keywords()
	{
		return ['acc', 'faq', 'accordion', 'tab'];
	}

	public function get_categories()
	{
		return ['fbth'];
	}

	protected function register_controls()
	{

		$primary_color = get_theme_mod('primary_color');
		$secondary_color = get_theme_mod('secondary_color');
		$accent_color = get_theme_mod('accent_color');


		/**
		 * Fd Addons Accordion Content Settings
		 */
		$this->start_controls_section(
			'fbth_section_exclusive_accordion_content_settings',
			[
				'label' => esc_html__('Contents', 'fbth')
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs('fbth_accordion_item_tabs');

		$repeater->start_controls_tab('fbth_accordion_item_content_tab', ['label' => __('Content', 'fbth')]);

		$repeater->add_control(
			'fbth_exclusive_accordion_default_active',
			[
				'label'        => esc_html__('Active as Default', 'fbth'),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);

		$repeater->add_control(
			'fbth_exclusive_accordion_icon_show',
			[
				'label'        => esc_html__('Enable Title Icon', 'fbth'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __('On', 'fbth'),
				'label_off'    => __('Off', 'fbth'),
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);

		$repeater->add_control(
			'fbth_exclusive_accordion_title_icon',
			[
				'label'       => __('Icon', 'fbth'),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => [
					'value'   => 'far fa-user',
					'library' => 'fa-regular'
				],
				'condition'   => [
					'fbth_exclusive_accordion_icon_show' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'fbth_exclusive_accordion_title',
			[
				'label'   => esc_html__('Title', 'fbth'),
				'type'    => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Accordion Title', 'fbth'),
				'dynamic' => ['active' => true]
			]
		);
		$repeater->add_control(
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
				'default' => 'h6',
				'toggle' => false,
			]
		);

		$repeater->add_control(
			'fbth_exclusive_accordion_content',
			[
				'label' => esc_html__('Description', 'fbth'),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__('“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare non sed est cursus. Vel hac convallis ipsum, facilisi odio pellentesque bibendum viverra tempus.”', 'fbth'),
			]
		);
		$repeater->add_control(
			'content_size',
			[
				'label' => esc_html__('Text Size', 'fbth'),
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

		$repeater->add_control(
			'fbth_accordion_show_read_more_btn',
			[
				'label'        => esc_html__('Enable Button.', 'fbth'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __('On', 'fbth'),
				'label_off'    => __('Off', 'fbth'),
				'default'      => 'no',
				'return_value' => 'yes',
				'separator'	   => 'before'
			]
		);

		$repeater->add_control(
			'fbth_accordion_read_more_btn_text',
			[
				'label'       => esc_html__('Button Text', 'fbth'),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__('See Details', 'fbth'),
				'default'     => esc_html__('See Details', 'fbth'),
				'condition'   => [
					'.fbth_accordion_show_read_more_btn' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'fbth_accordion_read_more_btn_url',
			[
				'label'         => esc_html__('Button Link', 'fbth'),
				'type'          => Controls_Manager::URL,
				'default'       => [
					'url'           => '#',
					'is_external'   => ''
				],
				'show_external'     => true,
				'placeholder'       => __('http://your-link.com', 'fbth'),
				'condition'     => [
					'.fbth_accordion_show_read_more_btn' => 'yes'
				]
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab('fbth_accordion_item_image_tab', ['label' => __('Image', 'fbth')]);

		$repeater->add_control(
			'fbth_accordion_image',
			[
				'label' => esc_html__('Choose Image', 'fbth'),
				'type'  => Controls_Manager::MEDIA
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab('fbth_accordion_item_style_tab', ['label' => __('Style', 'fbth')]);

		$repeater->add_control(
			'fbth_accordion_each_item_container_style',
			[
				'label' => esc_html__('Container', 'fbth'),
				'type'  => Controls_Manager::HEADING
			]
		);

		$repeater->add_control(
			'fbth_accordion_each_item_container_bg_color',
			[
				'label'     => __('Background Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.fbth-accordion-single-item' => 'background-color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
			'fbth_accordion_number_color',
			[
				'label'     => __('Number Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.fbth-accordion-single-item .fbth-accordion-number span' => 'color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
			'fbth_accordion_number_bg_color',
			[
				'label'     => __('Number Background Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.fbth-accordion-single-item .fbth-accordion-number span' => 'background-color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
			'fbth_accordion_each_item_title_style',
			[
				'label'     => esc_html__('Title', 'fbth'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'fbth_accordion_each_item_title_color',
			[
				'label'     => __('Text Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.fbth-accordion-single-item .fbth-accordion-title' => 'color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
			'fbth_accordion_each_item_title_bg_color',
			[
				'label'     => __('Background Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.fbth-accordion-single-item .fbth-accordion-title' => 'background-color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
			'fbth_accordion_each_item_title_hover_color',
			[
				'label'     => __('Hover Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.fbth-accordion-single-item .fbth-accordion-title:hover' => 'color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
			'fbth_accordion_each_item_title_hover_bg_color',
			[
				'label'     => __('Hover Background Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.fbth-accordion-single-item .fbth-accordion-title:hover' => 'background-color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
			'fbth_accordion_each_item_content_style',
			[
				'label'     => esc_html__('Content', 'fbth'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'fbth_accordion_each_item_container_border',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.fbth-accordion-single-item'
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'fbth_exclusive_accordion_tab',
			[
				'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default'	=> [
					[
						'fbth_exclusive_accordion_title'          => esc_html__('Accordion Title 1', 'fbth'),
						'fbth_exclusive_accordion_content'          => esc_html__('“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare non sed est cursus. Vel hac convallis ipsum.', 'fbth'),
						'fbth_exclusive_accordion_default_active' => 'yes'
					],
					[
						'fbth_exclusive_accordion_title' => esc_html__('Accordion Title 2', 'fbth'),
						'fbth_exclusive_accordion_content'          => esc_html__('“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare non sed est cursus. Vel hac convallis ipsum.', 'fbth')
					],
					[
						'fbth_exclusive_accordion_title' => esc_html__('Accordion Title 3', 'fbth'),
						'fbth_exclusive_accordion_content'          => esc_html__('“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare non sed est cursus. Vel hac convallis ipsum.', 'fbth')
					]
				],
				'title_field' => '{{fbth_exclusive_accordion_title}}'
			]
		);

		$this->add_control(
			'fbth_show_number',
			[
				'label'        => esc_html__('Show Number', 'fbth'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'fbth_exclusive_accordion_tab_title_show_active_inactive_icon',
			[
				'label'        => esc_html__('Show Active/Inactive Icon?', 'fbth'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'	   => 'before'
			]
		);

		$this->add_control(
			'icon_alignment',
			[
				'label' => esc_html__('Icon Alignment', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'plugin-name'),
						'icon' => 'eicon-text-align-left',
					],
					'right' => [
						'title' => esc_html__('Right', 'plugin-name'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'right',
				'toggle' => true,
			]
		);

		$this->add_control(
			'fbth_exclusive_accordion_tab_title_active_icon',
			[
				'label'       => __('Active Icon', 'fbth'),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-angle-up',
					'library' => 'fa-solid'
				],
				'condition'   => [
					'fbth_exclusive_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);

		$this->add_control(
			'fbth_exclusive_accordion_tab_title_inactive_icon',
			[
				'label'       => __('Inactive Icon', 'fbth'),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-angle-down',
					'library' => 'fa-solid'
				],
				'condition'   => [
					'fbth_exclusive_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Fd Addons Accordion Container Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'fbth_section_exclusive_accordions_container_style',
			[
				'label'	=> esc_html__('Container', 'fbth'),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);
		$this->start_controls_tabs('fbth_accordion_active_inactive_container_tabs');
		// normal state tab
		$this->start_controls_tab('fbth_accordion_container_style', ['label' => esc_html__('Normal', 'fbth')]);

		$this->add_control(
			'fbth_accordion_container_background_color',
			[
				'label'		=> esc_html__('Background Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'fbth_accordion_container_box_shadow',
				'selector' => '{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item'
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'fbth_exclusive_accordion_container_border',
				'selector' => '{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item'
			]
		);

		$this->add_responsive_control(
			'fbth_exclusive_accordion_container_padding',
			[
				'label'      => __('Padding', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'fbth_exclusive_accordion_container_margin',
			[
				'label'        => __('Margin', 'fbth'),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => ['px', '%'],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'fbth_exclusive_accordion_container_border_radius',
			[
				'label'      => __('Border Radius', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_tab();

		// hover state tab
		$this->start_controls_tab('fbth_accordion_container_style_hover', ['label' => esc_html__('Active', 'fbth')]);

		$this->add_control(
			'fbth_accordion_container_background_color_active',
			[
				'label'		=> esc_html__('Background Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item.wraper-active' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'fbth_accordion_container_box_shadow_active',
				'selector' => '{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item.wraper-active'
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'fbth_exclusive_accordion_container_border_active',
				'selector' => '{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item.wraper-active'
			]
		);
		$this->add_responsive_control(
			'fbth_exclusive_accordion_container_border_radius_active',
			[
				'label'      => __('Border Radius', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item.wraper-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'fbth_exclusive_accordion_container_margin_active',
			[
				'label'      => __('Margin', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item.wraper-active' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'fbth_exclusive_accordion_container_padding_active',
			[
				'label'      => __('Padding', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item.wraper-active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();



		    $this->start_controls_section(
			'fbth_accordion_child_style_section',
			[
				'label' => esc_html__('Child Item Style', 'fbth'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

			$this->add_responsive_control(
            'first_child_box_border_radius',
            [
                'label'      => __( 'First child Border Radius', 'fbth' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-accordion-single-item:first-child' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'
                ]
            ]
        );



		 $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'first_child_border',
                'label'    => __( 'first_child_border', 'fbth' ),
                'selector' => '{{WRAPPER}} .fbth-accordion-single-item:first-child',
            ]
        );
	

			$this->add_responsive_control(
            'last_child_box_border_radius',
            [
                'label'      => __( 'Last child Border Radius', 'fbth' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [ 
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-accordion-single-item:last-child' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'{{WRAPPER}} .fbth-accordion-single-item:last-child.wraper-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'
                ]
            ]
        );

	   $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'last_child_border',
                'label'    => __( 'last_child_border', 'fbth' ),
                'selector' => '{{WRAPPER}} .fbth-accordion-single-item:last-child',
				'selector' => '{{WRAPPER}} fbth-accordion-single-item:last-child.wraper-active',
            ]
        );
	



		$this->end_controls_section();

		$this->start_controls_section(
			'fbth_acc_number',
			[
				'label' => esc_html__('Number', 'fbth'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'            => 'fbth_number_typography',
				'selector'        => '{{WRAPPER}} .fbth-accordion-number span',
				'fields_options'  => [
					'font_weight' => [
						'default' => '600',
					]
				]
			]
		);
		$this->add_responsive_control(
			'fbth_number_size',
			[
				'label'        => __('Size', 'fbth'),
				'type'         => Controls_Manager::SLIDER,
				'range'        => [
					'px'       => [
						'min'  => 0,
						'max'  => 150,
						'step' => 1
					]
				],
				'selectors'    => [
					'{{WRAPPER}} .fbth-accordion-number span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'numbar_color',
			[
				'label'		=> esc_html__('Text Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> $accent_color,
				'selectors'	=> [
					'{{WRAPPER}} .fbth-accordion-number span' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'numbar_border',
				'label'                 => __('Border', 'fbth'),
				'selector'              => '{{WRAPPER}} .fbth-accordion-number span',
			]
		);
		$this->add_control(
			'numbar_background_color',
			[
				'label'		=> esc_html__('Background', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> $secondary_color,
				'selectors'	=> [
					'{{WRAPPER}} .fbth-accordion-number span' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'fbth_number_border_radius',
			[
				'label'      => __('Border Radius', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-number span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'fbth_number_margin',
			[
				'label'      => __('Margin', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-number span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'fbth_number_padding',
			[
				'label'      => __('Padding', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-number span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'fbth_section_exclusive_accordions_tab_style',
			[
				'label' => esc_html__('Title', 'fbth'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);


		$this->start_controls_tabs('fbth_exclusive_accordion_header_tabs');

		# Normal State Tab
		$this->start_controls_tab('fbth_exclusive_accordion_header_normal', ['label' => esc_html__('Normal', 'fbth')]);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'            => 'fbth_exclusive_accordion_title_typography',
				'selector'        => '{{WRAPPER}} .fbth-accordion-heading',
				'fields_options'  => [
					'font_weight' => [
						'default' => '600'
					]
				]
			]
		);

		$this->add_control(
			'fbth_exclusive_accordion_tab_text_color',
			[
				'label'		=> esc_html__('Text Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> $secondary_color,
				'selectors'	=> [
					'{{WRAPPER}} .fbth-accordion-heading' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'fbth_exclusive_accordion_tab_color',
			[
				'label'     => esc_html__('Background Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-accordion-heading' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'               => 'fbth_exclusive_accordion_title_border',
				'selector'           => '{{WRAPPER}} .fbth-accordion-heading'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'fbth_accordion_title_box_shadow',
				'selector' => '{{WRAPPER}} .fbth-accordion-heading'
			]
		);

		$this->add_responsive_control(
			'fbth_exclusive_accordion_title_padding',
			[
				'label'      => __('Padding', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'fbth_exclusive_accordion_title_margin',
			[
				'label'      => __('Margin', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'fbth_accordion_title_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_tab();

		#Hover State Tab
		$this->start_controls_tab('fbth_exclusive_accordion_header_hover', ['label' => esc_html__('Hover', 'fbth')]);
		$this->add_control(
			'fbth_exclusive_accordion_tab_text_color_hover',
			[
				'label'		=> esc_html__('Text Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .fbth-accordion-heading:hover' => 'color: {{VALUE}};',

				]
			]
		);

		$this->add_control(
			'fbth_exclusive_accordion_tab_color_bg_hover',
			[
				'label'		=> esc_html__('Background Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-accordion-heading:hover' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_tab();

		#Active State Tab
		$this->start_controls_tab('fbth_exclusive_accordion_header_active', ['label' => esc_html__('Active', 'fbth')]);
		$this->add_control(
			'fbth_exclusive_accordion_tab_text_color_active',
			[
				'label'		=> esc_html__('Text Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .fbth-accordion-title.active .fbth-accordion-heading' => 'color: {{VALUE}} !important;'
				]
			]
		);

		$this->add_control(
			'fbth_exclusive_accordion_tab_color_bg_active',
			[
				'label'		=> esc_html__('Background Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-accordion-title.active .fbth-accordion-heading' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'               => 'fbth_active_accordion_title_border',
				'selector'           => '{{WRAPPER}} .fbth-accordion-title.active .fbth-accordion-heading'
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Icon Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'fbth_accordion_tab_title_icon_style',
			[
				'label'	=> esc_html__('Title Icon', 'fbth'),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);

		$this->start_controls_tabs('fbth_accordion_title_icon_style_tabs');

		// normal state tab
		$this->start_controls_tab('fbth_accordion_title_icon_general_style', ['label' => esc_html__('Normal', 'fbth')]);

		$this->add_control(
			'fbth_accordion_tab_title_icon_color',
			[
				'label'		=> esc_html__('Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title span.fbth-tab-title-icon' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'fbth_accordion_tab_title_icon_bg_color',
			[
				'label'		=> esc_html__('Background Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title span.fbth-tab-title-icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'fbth_accordion_title_icon_border',
				'selector' => '{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title span.fbth-tab-title-icon'
			]
		);

		$this->add_responsive_control(
			'fbth_accordion_title_icon_size',
			[
				'label'        => __('Size', 'fbth'),
				'type'         => Controls_Manager::SLIDER,
				'range'        => [
					'px'       => [
						'min'  => 10,
						'max'  => 150,
						'step' => 2
					]
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 20
				],
				'selectors'    => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title span.fbth-tab-title-icon i' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'fbth_accordion_title_icon_width',
			[
				'label'    => esc_html__('Width', 'fbth'),
				'type'     => Controls_Manager::SLIDER,
				'default'  => [
					'size' => 20
				],
				'range'    => [
					'px'   => [
						'max' => 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title span.fbth-tab-title-icon' => 'width: {{SIZE}}px;'
				]
			]
		);


		$this->add_responsive_control(
			'fbth_accordion_title_icon_padding',
			[
				'label'      => __('Padding', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title span.fbth-tab-title-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'fbth_accordion_title_icon_margin',
			[
				'label'      => __('Margin', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title span.fbth-tab-title-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_tab();

		// active state tab
		$this->start_controls_tab('fbth_accordion_title_icon_active_style', ['label' => esc_html__('Active', 'fbth')]);

		$this->add_control(
			'fbth_accordion_title_icon_active_color',
			[
				'label'		=> esc_html__('Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title.active span.fbth-tab-title-icon i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'fbth_accordion_title_icon_active_bg_color',
			[
				'label'		=> esc_html__('Background Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title.active span.fbth-tab-title-icon' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->end_controls_section();

		$this->start_controls_section(
			'fbth_accordion_active_inactive_icon_style',
			[
				'label'     => esc_html__('Active/Inactive Icon', 'fbth'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'fbth_exclusive_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);



		$this->start_controls_tabs('fbth_accordion_active_inactive_icon_style_tabs');

		// normal state tab
		$this->start_controls_tab('fbth_accordion_general_style', ['label' => esc_html__('Normal', 'fbth')]);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'fbth_accordion_active_inactive_icon_border',
				'selector' => '{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title .fbth-active-inactive-icon'
			]
		);

		$this->add_control(
			'fbth_accordion_general_icon_color',
			[
				'label'		=> esc_html__('Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> $secondary_color,
				'selectors'	=> [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title .fbth-active-inactive-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title .fbth-active-inactive-icon svg' => 'color: {{VALUE}};',
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title .fbth-active-inactive-icon svg path' => 'fill: {{VALUE}};',

				]
			]
		);

		$this->add_control(
			'fbth_accordion_general_icon_bg_color',
			[
				'label'		=> esc_html__('Background Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title .fbth-active-inactive-icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'fbth_accordion_active_inactive_icon_size',
			[
				'label'        => esc_html__('Size', 'fbth'),
				'type'         => Controls_Manager::SLIDER,
				'range'        => [
					'px'       => [
						'min'  => 10,
						'max'  => 150,
						'step' => 2
					]
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 20
				],
				'selectors'    => [
					'{{WRAPPER}}  .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title .fbth-active-inactive-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title .fbth-active-inactive-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'fbth_accordion_active_inactive_icon_width',
			[
				'label'       => esc_html__( 'Width', 'fbth' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px'      => [
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title .fbth-active-inactive-icon' => 'width: {{SIZE}}px;'
				]
			]
		);
		$this->add_responsive_control(
			'fbth_accordion_active_inactive_icon_height',
			[
				'label'       => esc_html__( 'Height', 'fbth' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px'      => [
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title .fbth-active-inactive-icon' => 'height: {{SIZE}}px;'
				]
			]
		);
		$this->add_control(
			'fbth_accordion_active_inactive_icon_radius',
			[
				'label' => esc_html__( 'Border Radius', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title .fbth-active-inactive-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		


		$this->end_controls_tab();

		// active state tab
		$this->start_controls_tab('fbth_accordion_active_style', ['label' => esc_html__('Active', 'fbth')]);

		$this->add_control(
			'fbth_accordion_active_icon_color',
			[
				'label'		=> esc_html__('Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> $secondary_color,
				'selectors'	=> [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title.active .fbth-active-inactive-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title.active .fbth-active-inactive-icon svg' => 'color: {{VALUE}};',
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title.active .fbth-active-inactive-icon svg path' => 'fill: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'fbth_accordion_active_icon_bg_color',
			[
				'label'		=> esc_html__('Background Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-title.active .fbth-active-inactive-icon' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Fd Addons Accordion Content Style
		 * -------------------------------------------
		 */

		$this->start_controls_section(
			'fbth_section_accordion_tab_content_style_settings',
			[
				'label'	=> esc_html__('Content', 'fbth'),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'fbth_exclusive_accordion_content_typography',
				'selector' => '{{WRAPPER}} .fbth-accordion-single-item .fbth-accordion-text p'
			]
		);

		$this->add_control(
			'fbth_accordion_content_bg_color',
			[
				'label'		=> esc_html__('Background Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '',
				'selectors'	=> [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-content .fbth-accordion-content-wrapper .fbth-accordion-text p' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'fbth_accordion_content_text_color',
			[
				'label'		=> esc_html__('Text Color', 'fbth'),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> $primary_color,
				'selectors' => [
					'{{WRAPPER}} .fbth-accordion-single-item .fbth-accordion-text p' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                 => 'fbth_exclusive_accordion_content_border',
				'selector'             => '{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-content .fbth-accordion-content-wrapper .fbth-accordion-text p'
			]
		);
		$this->add_responsive_control(
			'fbth_accordion_content_padding',
			[
				'label'      => __('Padding', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-content .fbth-accordion-text p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'fbth_accordion_content_margin',
			[
				'label'      => __('Margin', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-single-item .fbth-accordion-text p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'fbth_accordion_content_border_radius',
			[
				'label'      => __('Border Radius', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-content .fbth-accordion-content-wrapper .fbth-accordion-text p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'fbth_section_accordion_tab_image_style',
			[
				'label'	=> esc_html__('Image', 'fbth'),
				'tab'	=> Controls_Manager::TAB_STYLE

			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'fbth_accordion_image_size',
				'label'   => esc_html__('Image Type', 'fbth'),
				'default' => 'medium'
			]
		);

		$this->add_control(
			'fbth_accordion_image_align',
			[
				'label'         => esc_html__('Image Position', 'fbth'),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'options'       => [
					'left'      => [
						'title' => esc_html__('Left', 'fbth'),
						'icon'  => 'eicon-angle-left'
					],
					'right'     => [
						'title' => esc_html__('Right', 'fbth'),
						'icon'  => 'eicon-angle-right'
					]
				],
				'default'       => 'right'
			]
		);

		$this->add_responsive_control(
			'fbth_accordion_image_padding',
			[
				'label'      => __('Padding', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20'
				],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'fbth_accordion_image_margin',
			[
				'label'      => __('Margin', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'fbth_accordion_details_btn_style_section',
			[
				'label' => esc_html__('Button', 'fbth'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->start_controls_tabs('fbth_accordion_details_button_style_tabs');

		// normal state tab
		$this->start_controls_tab('fbth_accordion_details_btn_normal', ['label' => esc_html__('Normal', 'fbth')]);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'fbth_accordion_details_btn_typography',
				'selector' => '{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-button a'
			]
		);

		$this->add_control(
			'fbth_accordion_details_btn_normal_text_color',
			[
				'label'     => esc_html__('Text Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-button a' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'fbth_accordion_details_btn_normal_bg_color',
			[
				'label'     => esc_html__('Background Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'default'   => $secondary_color,
				'selectors' => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-button a' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'fbth_accordion_details_button_shadow',
				'selector'  => '{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-button a'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'               => 'fbth_accordion_details_btn_border',
				'fields_options'     => [
					'border' 	     => [
						'default'    => 'solid'
					],
					'width'  	     => [
						'default'    => [
							'top'    => '1',
							'right'  => '1',
							'bottom' => '1',
							'left'   => '1'
						]
					],
					'color' 	     => [
						'default'    => $secondary_color
					]
				],
				'selector'           => '{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-button a'
			]
		);

		$this->add_responsive_control(
			'fbth_accordion_details_btn_padding',
			[
				'label'      => esc_html__('Padding', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'    => [
					'top'    => '15',
					'right'  => '40',
					'bottom' => '15',
					'left'   => '40'
				],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'fbth_accordion_details_btn_margin',
			[
				'label'      => esc_html__('Margin', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'    => [
					'top'    => '30',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'fbth_accordion_details_button_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);



		$this->end_controls_tab();

		// hover state tab
		$this->start_controls_tab('fbth_accordion_details_btn_hover', ['label' => esc_html__('Hover', 'fbth')]);

		$this->add_control(
			'fbth_accordion_details_btn_hover_text_color',
			[
				'label'     => esc_html__('Text Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'default'   => $secondary_color,
				'selectors' => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-button a:hover' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'fbth_accordion_details_btn_hover_bg_color',
			[
				'label'     => esc_html__('Background Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-button a:hover' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'fbth_accordion_details_btn_hover_border',
				'selector' => '{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-button a:hover'
			]
		);

		$this->add_responsive_control(
			'fbth_accordion_details_button_border_radius_hover',
			[
				'label'      => esc_html__('Border Radius', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-button a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'fbth_accordion_details_button_hover_shadow',
				'selector'  => '{{WRAPPER}} .fbth-accordion-items .fbth-accordion-single-item .fbth-accordion-button a:hover'
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


	    $this->start_controls_section(
			'fbth_accordion_box_style_section',
			[
				'label' => esc_html__('Box', 'fbth'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
            'box_wrapper_padding',
            [
                'label' => __('Box Padding', 'upmedix'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-accordion-items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


    $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'boxx_border',
                'label'    => __( 'boxx_border', 'fbth' ),
                'selector' => '{{WRAPPER}} .fbth-accordion-items',
            ]
        );
		$this->add_responsive_control(
            'box_border_radius',
            [
                'label'      => __( 'Border Radius', 'fbth' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-accordion-items' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


		$this->end_controls_section();

	}

	private function render_image($accordion, $settings)
	{
		$image_id   = $accordion['fbth_accordion_image']['id'];
		$image_size = $settings['fbth_accordion_image_size_size'];
		if ('custom' === $image_size) {
			$image_src = Group_Control_Image_Size::get_attachment_image_src($image_id, 'fbth_accordion_image_size', $settings);
		} else {
			$image_src = wp_get_attachment_image_src($image_id, $image_size);
			$image_src = $image_src[0];
		}

		return sprintf('<img src="%s" alt="' . Control_Media::get_image_alt($accordion['fbth_accordion_image']) . '" />', esc_url($image_src));
	}

	protected function render()
	{

		$settings   = $this->get_settings_for_display();

		$this->add_render_attribute('fbth_accordion_heading', 'class', 'fbth-accordion-heading');
		$this->add_render_attribute('fbth_accordion_details', 'class', 'fbth-accordion-text');
		$this->add_render_attribute('fbth_accordion_button', 'class', 'fbth-accordion-button');

		$i = 1;
		echo '<div class="fbth-accordion-items">';
		do_action('fbth_accordion_wrapper_before');
		foreach ($settings['fbth_exclusive_accordion_tab'] as $key => $accordion) :

			do_action('fbth_accordion_each_item_wrapper_before');



			$accordion_item_setting_key = $this->get_repeater_setting_key('fbth_exclusive_accordion_title', 'fbth_exclusive_accordion_tab', $key);

			$accordion_class = ['fbth-accordion-title'];

			if ($accordion['fbth_exclusive_accordion_default_active'] === 'yes') {
				$accordion_class[] = 'active-default';
			}

			$this->add_render_attribute($accordion_item_setting_key, 'class', $accordion_class);

			$has_image = !empty($accordion['fbth_accordion_image']['url']) ? 'yes' : 'no';
			$link_key  = 'link_' . $key;

			echo '<div class="fbth-accordion-single-item ' . $accordion['fbth_exclusive_accordion_default_active'] . '  elementor-repeater-item-' . esc_attr($accordion['_id']) . '">';

			echo '<div ' . $this->get_render_attribute_string($accordion_item_setting_key) . '>';
			if ($settings['fbth_show_number'] == 'yes') :
				echo '<div class="fbth-accordion-number">';
				echo '<span>';
				echo $i++;
				echo '</span>';
				echo '</div>';
			endif;

			if (!empty($accordion['fbth_exclusive_accordion_title_icon']['value']) && 'yes' === $accordion['fbth_exclusive_accordion_icon_show']) :
				echo '<span class="fbth-tab-title-icon">';
				Icons_Manager::render_icon($accordion['fbth_exclusive_accordion_title_icon'], ['aria-hidden' => 'true']);
				echo '</span>';
			endif;
			if ('yes' === $settings['fbth_exclusive_accordion_tab_title_show_active_inactive_icon'] && 'left' == $settings['icon_alignment']) :
				echo '<div class="fbth-active-inactive-icon ' . $settings['icon_alignment'] . '">';
				if (!empty($settings['fbth_exclusive_accordion_tab_title_active_icon']['value'])) {
					echo '<span class="fbth-active-icon">';
					Icons_Manager::render_icon($settings['fbth_exclusive_accordion_tab_title_active_icon'], ['aria-hidden' => 'true']);
					echo '</span>';
				}
				if (!empty($settings['fbth_exclusive_accordion_tab_title_inactive_icon']['value'])) {
					echo '<span class="fbth-inactive-icon">';
					Icons_Manager::render_icon($settings['fbth_exclusive_accordion_tab_title_inactive_icon'], ['aria-hidden' => 'true']);
					echo '</span>';
				}
				echo '</div>';
			endif;
			printf(
				'<%1$s %2$s>%3$s</%1$s>',
				tag_escape($accordion['title_tag']),
				$this->get_render_attribute_string('fbth_accordion_heading'),
				scalo_kses_basic($accordion['fbth_exclusive_accordion_title'])
			);

			if ('yes' === $settings['fbth_exclusive_accordion_tab_title_show_active_inactive_icon'] && 'right' == $settings['icon_alignment']) :
				echo '<div class="fbth-active-inactive-icon ' . $settings['icon_alignment'] . '">';
				if (!empty($settings['fbth_exclusive_accordion_tab_title_active_icon']['value'])) {
					echo '<span class="fbth-active-icon">';
					Icons_Manager::render_icon($settings['fbth_exclusive_accordion_tab_title_active_icon'], ['aria-hidden' => 'true']);
					echo '</span>';
				}
				if (!empty($settings['fbth_exclusive_accordion_tab_title_inactive_icon']['value'])) {
					echo '<span class="fbth-inactive-icon">';
					Icons_Manager::render_icon($settings['fbth_exclusive_accordion_tab_title_inactive_icon'], ['aria-hidden' => 'true']);
					echo '</span>';
				}
				echo '</div>';
			endif;
			echo '</div>';

			echo '<div class="fbth-accordion-content">';
			echo '<div class="fbth-accordion-content-wrapper has-image-' . esc_attr($has_image) . ' image-position-' . esc_attr($settings['fbth_accordion_image_align']) . '">';
			echo '<div ' . $this->get_render_attribute_string('fbth_accordion_details') . '>';
			echo '<p class=fbth-size-' . $accordion['content_size'] . ' >' . wp_kses_post($accordion['fbth_exclusive_accordion_content']) . '</p>';
			if ('yes' === $accordion['fbth_accordion_show_read_more_btn']) :
				if ($accordion['fbth_accordion_read_more_btn_url']['url']) {
					$this->add_render_attribute($link_key, 'href', esc_url($accordion['fbth_accordion_read_more_btn_url']['url']));
					if ($accordion['fbth_accordion_read_more_btn_url']['is_external']) {
						$this->add_render_attribute($link_key, 'target', '_blank');
					}
					if ($accordion['fbth_accordion_read_more_btn_url']['nofollow']) {
						$this->add_render_attribute($link_key, 'rel', 'nofollow');
					}
				}
				if (!empty($accordion['fbth_accordion_read_more_btn_text'])) :
					echo '<div ' . $this->get_render_attribute_string('fbth_accordion_button') . '>';
					echo '<a ' . $this->get_render_attribute_string($link_key) . '>';
					echo esc_html($accordion['fbth_accordion_read_more_btn_text']);
					echo '</a>';
					echo '</div>';
				endif;
			endif;
			echo '</div>';

			if (!empty($accordion['fbth_accordion_image']['url'])) {
				echo '<div class="fbth-accordion-image">';
				echo $this->render_image($accordion, $settings);
				echo '</div>';
			}

			echo '</div>';
			echo '</div>';
			echo '</div>';
			do_action('fbth_accordion_each_item_wrapper_after');
		endforeach;
		do_action('fbth_accordion_wrapper_after');
		echo '</div>';
	}
}
$widgets_manager->register(new \FBTH_Addons\Widgets\FBTH_Accordion());
