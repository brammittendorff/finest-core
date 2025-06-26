<?php

namespace FBTH\Widgets\Elementor;

if (!defined('ABSPATH')) exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use FBTH\Elementor\Traits\FBTH_Inline_Button_Markup;

class FBTH_Inline_Button extends Widget_Base
{
	use FBTH_Inline_Button_Markup;
	/**
	 * Get widget name.
	 */
	public function get_name()
	{
		return 'fbth-inline-button';
	}
	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('Inline Button', 'fbth-addons');
	}
	/**
	 * Get widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-button';
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
		return ['link', 'hover', 'animation', 'fbth', 'inline'];
	}
	/**
	 * Register widget content controls
	 */
	protected function register_controls()
	{
		$this->start_controls_section(
			'_section_title',
			[
				'label' => __('Button Content', 'fbth-addons'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'animation_style',
			[
				'label'   => __('Animation Style', 'fbth-addons'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'carpo',
				'options' => [
					'carpo'   => __('Carpo', 'fbth-addons'),
					'carme'   => __('Carme', 'fbth-addons'),
					'dia'     => __('Dia', 'fbth-addons'),
					'eirene'  => __('Eirene', 'fbth-addons'),
					'elara'   => __('Elara', 'fbth-addons'),
					'ersa'    => __('Ersa', 'fbth-addons'),
					'helike'  => __('Helike', 'fbth-addons'),
					'herse'   => __('Herse', 'fbth-addons'),
					'io'      => __('Io', 'fbth-addons'),
					'iocaste' => __('Iocaste', 'fbth-addons'),
					'kale'    => __('Kale', 'fbth-addons'),
					'leda'    => __('Leda', 'fbth-addons'),
					'metis'   => __('Metis', 'fbth-addons'),
					'mneme'   => __('Mneme', 'fbth-addons'),
					'thebe'   => __('Thebe', 'fbth-addons'),
				],
			]
		);
		$this->add_control(
			'link_text',
			[
				'label'       => __('Title', 'fbth-addons'),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __('Inline Button', 'fbth-addons'),
				'placeholder' => __('Type Link Title', 'fbth-addons'),
				'dynamic'     => [
					'active' => true,
				],
			]
		);
		$this->add_responsive_control(
			'link_align',
			[
				'label' => __('Alignment', 'fbth-addons'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'fbth-addons'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'fbth-addons'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __('Right', 'fbth-addons'),
						'icon' => 'eicon-text-align-right',
					]
				],
				'default' => 'left',
				'toggle' => true,
				'selectors_dictionary' => [
					'left' => 'justify-content: flex-start',
					'center' => 'justify-content: center',
					'right' => 'justify-content: flex-end',
				],
				'selectors' => [
					'{{WRAPPER}} .fbth_content__item' => '{{VALUE}}'
				]
			]
		);
		$this->add_control(
			'link_url',
			[
				'label'         => __('Link', 'fbth-addons'),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __('https://your-link.com', 'fbth-addons'),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => false,
					'nofollow'    => true,
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'_section_media_style',
			[
				'label' => __('Button Content', 'fbth-addons'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => __('Content Box Padding', 'fbth-addons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .fbth_content__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => __('Link Color', 'fbth-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-link' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label'     => __('Link Hover Color', 'fbth-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-link:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __('Typography', 'fbth-addons'),
				'selector' => '{{WRAPPER}} .fbth-link',
				'scheme'   => Typography::TYPOGRAPHY_2,
			]
		);
		$this->end_controls_section();
	}
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		self::{'render_' . $settings['animation_style'] . '_markup'}($settings);
	}
}
$widgets_manager->register(new \FBTH\Widgets\Elementor\FBTH_Inline_Button());
