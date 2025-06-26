<?php

namespace FBTH_Addons\Widgets\Elementor;

if (!defined('ABSPATH')) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

class FBTH_Animated_Text extends Widget_Base
{
	public function get_name()
	{
		return 'fbth-animated';
	}
	public function get_title()
	{
		return esc_html__('Animated Text', 'fbth');
	}
	public function get_icon()
	{
		return 'fbth eicon-animated-headline';
	}
	public function get_categories()
	{
		return ['fbth'];
	}
	public function get_keywords()
	{
		return ['fbth', 'fancy', 'heading', 'animate', 'animation'];
	}
	protected function register_controls()
	{
		$secondary_color = get_theme_mod('secondary_color');
		$accent_color = get_theme_mod('accent_color');
		/*
	    * Animated Text Content
	    */
		$this->start_controls_section(
			'fbth_section_animated_text_content',
			[
				'label' => esc_html__('Content', 'fbth')
			]
		);
		$this->add_control(
			'fbth_animated_text_before_text',
			[
				'label'   => esc_html__('Before Text', 'fbth'),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__('This is', 'fbth'),
				'dynamic'     => ['active' => true],
			]
		);
		$this->add_control(
			'fbth_animated_text_animated_heading',
			[
				'label'       => esc_html__('Animated Text', 'fbth'),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Enter your animated text with comma separated.', 'fbth'),
				'description' => __('<b>Write animated heading with comma separated. Example: Exclusive, Addons, Elementor</b>', 'fbth'),
				'default'     => esc_html__('FBTH, Addons, Elementor', 'fbth'),
				'dynamic'     => ['active' => true]
			]
		);
		$this->add_control(
			'fbth_animated_text_after_text',
			[
				'label'   => esc_html__('After Text', 'fbth'),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__('For You.', 'fbth'),
				'dynamic'     => ['active' => true],
			]
		);
		$this->add_control(
			'fbth_animated_text_animated_heading_tag',
			[
				'label'   => esc_html__('HTML Tag', 'fbth'),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'h3',
				'toggle'  => false,
				'options' => [
					'h1'  => [
						'title' => __('H1', 'fbth'),
						'icon'  => 'eicon-editor-h1'
					],
					'h2'  => [
						'title' => __('H2', 'fbth'),
						'icon'  => 'eicon-editor-h2'
					],
					'h3'  => [
						'title' => __('H3', 'fbth'),
						'icon'  => 'eicon-editor-h3'
					],
					'h4'  => [
						'title' => __('H4', 'fbth'),
						'icon'  => 'eicon-editor-h4'
					],
					'h5'  => [
						'title' => __('H5', 'fbth'),
						'icon'  => 'eicon-editor-h5'
					],
					'h6'  => [
						'title' => __('H6', 'fbth'),
						'icon'  => 'eicon-editor-h6'
					]
				]
			]
		);
		$this->add_control(
			'fbth_animated_text_animated_heading_alignment',
			[
				'label'   => esc_html__('Alignment', 'fbth'),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => true,
				'options' => [
					'left'   => [
						'title' => __('Left', 'fbth'),
						'icon'  => 'eicon-text-align-left'
					],
					'center' => [
						'title' => __('Center', 'fbth'),
						'icon'  => 'eicon-text-align-center'
					],
					'right'  => [
						'title' => __('Right', 'fbth'),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default' => 'left',
				'selectors'     => [
					'{{WRAPPER}} .fbth-animated-text-align' => 'text-align: {{VALUE}};'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text Container Style
	    */
		$this->start_controls_section(
			'fbth_section_animated_text_animation_tyle',
			[
				'label' => esc_html__('Animation', 'fbth'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'fbth_animated_text_animated_heading_animated_type',
			[
				'label'   => esc_html__('Animation Type', 'fbth'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fbth-typed-animation',
				'options' => [
					'fbth-typed-animation'   => __('Typed', 'fbth'),
					'fbth-morphed-animation' => __('Animate', 'fbth')
				]
			]
		);
		$this->add_control(
			'fbth_animated_text_animated_heading_animation_style',
			[
				'label'   => esc_html__('Animation Style', 'fbth'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fadeIn',
				'options' => [
					'fadeIn'            => __('Fade In', 'fbth'),
					'fadeInUp'          => __('Fade In Up', 'fbth'),
					'fadeInDown'        => __('Fade In Down', 'fbth'),
					'fadeInLeft'        => __('Fade In Left', 'fbth'),
					'fadeInRight'       => __('Fade In Right', 'fbth'),
					'zoomIn'            => __('Zoom In', 'fbth'),
					'zoomInUp'          => __('Zoom In Up', 'fbth'),
					'zoomInDown'        => __('Zoom In Down', 'fbth'),
					'zoomInLeft'        => __('Zoom In Left', 'fbth'),
					'zoomInRight'       => __('Zoom In Right', 'fbth'),
					'slideInDown'       => __('Slide In Down', 'fbth'),
					'slideInUp'         => __('Slide In Up', 'fbth'),
					'slideInLeft'       => __('Slide In Left', 'fbth'),
					'slideInRight'      => __('Slide In Right', 'fbth'),
					'bounce'            => __('Bounce', 'fbth'),
					'bounceIn'          => __('Bounce In', 'fbth'),
					'bounceInUp'        => __('Bounce In Up', 'fbth'),
					'bounceInDown'      => __('Bounce In Down', 'fbth'),
					'bounceInLeft'      => __('Bounce In Left', 'fbth'),
					'bounceInRight'     => __('Bounce In Right', 'fbth'),
					'flash'             => __('Flash', 'fbth'),
					'pulse'             => __('Pulse', 'fbth'),
					'rotateIn'          => __('Rotate In', 'fbth'),
					'rotateInDownLeft'  => __('Rotate In Down Left', 'fbth'),
					'rotateInDownRight' => __('Rotate In Down Right', 'fbth'),
					'rotateInUpRight'   => __('rotate In Up Right', 'fbth'),
					'rotateIn'          => __('Rotate In', 'fbth'),
					'rollIn'            => __('Roll In', 'fbth'),
					'lightSpeedIn'      => __('Light Speed In', 'fbth')
				],
				'condition' => [
					'fbth_animated_text_animated_heading_animated_type' => 'fbth-morphed-animation'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text Settings
	    */
		$this->start_controls_section(
			'fbth_section_animated_text_settings',
			[
				'label' => esc_html__('Settings', 'fbth'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'fbth_animated_text_animation_speed',
			[
				'label'     => __('Animation Speed', 'fbth'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 100,
				'max'       => 10000,
				'condition' => [
					'fbth_animated_text_animated_heading_animated_type' => 'fbth-morphed-animation'
				]
			]
		);
		$this->add_control(
			'fbth_animated_text_type_speed',
			[
				'label'   => __('Type Speed', 'fbth'),
				'type'    => Controls_Manager::NUMBER,
				'default' => 60,
				'min'     => 10,
				'max'     => 200,
				'step'    => 10,
				'condition' => [
					'fbth_animated_text_animated_heading_animated_type' => 'fbth-typed-animation'
				]
			]
		);
		$this->add_control(
			'fbth_animated_text_start_delay',
			[
				'label'     => __('Start Delay', 'fbth'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 1000,
				'max'       => 10000,
				'condition' => [
					'fbth_animated_text_animated_heading_animated_type' => 'fbth-typed-animation'
				]
			]
		);
		$this->add_control(
			'fbth_animated_text_back_type_speed',
			[
				'label'     => __('Back Type Speed', 'fbth'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 60,
				'min'       => 10,
				'max'       => 200,
				'step'      => 10,
				'condition' => [
					'fbth_animated_text_animated_heading_animated_type' => 'fbth-typed-animation'
				]
			]
		);
		$this->add_control(
			'fbth_animated_text_back_delay',
			[
				'label'     => __('Back Delay', 'fbth'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 1000,
				'max'       => 10000,
				'condition' => [
					'fbth_animated_text_animated_heading_animated_type' => 'fbth-typed-animation'
				]
			]
		);
		$this->add_control(
			'fbth_animated_text_loop',
			[
				'label'        => __('Loop', 'fbth'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('ON', 'fbth'),
				'label_off'    => __('OFF', 'fbth'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'fbth_animated_text_animated_heading_animated_type' => 'fbth-typed-animation'
				]
			]
		);
		$this->add_control(
			'fbth_animated_text_show_cursor',
			[
				'label'        => __('Show Cursor', 'fbth'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('ON', 'fbth'),
				'label_off'    => __('OFF', 'fbth'),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'fbth_animated_text_animated_heading_animated_type' => 'fbth-typed-animation'
				]
			]
		);
		$this->add_control(
			'fbth_animated_text_fade_out',
			[
				'label'        => __('Fade Out', 'fbth'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('ON', 'fbth'),
				'label_off'    => __('OFF', 'fbth'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'fbth_animated_text_animated_heading_animated_type' => 'fbth-typed-animation'
				]
			]
		);
		$this->add_control(
			'fbth_animated_text_smart_backspace',
			[
				'label'        => __('Smart Backspace', 'fbth'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('ON', 'fbth'),
				'label_off'    => __('OFF', 'fbth'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'fbth_animated_text_animated_heading_animated_type' => 'fbth-typed-animation'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text pre animated Text Style
		*/
		$this->start_controls_section(
			'fbth_pre_animated_text_style',
			[
				'label'     => esc_html__('Pre Animated text', 'fbth'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'fbth_animated_text_before_text!' => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'fbth_pre_animated_text_typography',
				'fields_options'   => [
					'font_size'    => [
						'default'  => [
							'unit' => 'px',
							'size' => 30
						]
					],
					'font_weight'  => [
						'default'  => '600'
					]
				],
				'selector' => '{{WRAPPER}} .fbth-animated-text-pre-heading',
			]
		);
		$this->add_control(
			'fbth_pre_animated_text_color',
			[
				'label'     => esc_html__('Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'default'   => $secondary_color,
				'selectors' => [
					'{{WRAPPER}} .fbth-animated-text-pre-heading' => 'color: {{VALUE}}'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text animated Text Style
	    */
		$this->start_controls_section(
			'fbth_animated_text_style',
			[
				'label' => esc_html__('Animated text', 'fbth'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'fbth_animated_text_typography',
				'fields_options'   => [
					'font_size'    => [
						'default'  => [
							'unit' => 'px',
							'size' => 30
						]
					],
					'font_weight'  => [
						'default'  => '600'
					]
				],
				'selector' => '{{WRAPPER}} .fbth-animated-text-animated-heading, {{WRAPPER}} span.typed-cursor'
			]
		);
		$this->add_control(
			'fbth_animated_text_color',
			[
				'label'     => esc_html__('Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'default'   => $accent_color,
				'selectors' => [
					'{{WRAPPER}} .fbth-animated-text-animated-heading, {{WRAPPER}} span.typed-cursor' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'fbth_animated_text_spacing',
			[
				'label'      => __('Spacing', 'fbth'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default'    => [
					'unit'   => 'px',
					'size'   => 8
				],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 50
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .fbth-animated-text-animated-heading' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text post animated Text Style
	    */
		$this->start_controls_section(
			'fbth_post_animated_text_style',
			[
				'label'     => esc_html__('Post Animated text', 'fbth'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'fbth_animated_text_after_text!' => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'fbth_post_animated_text_typography',
				'fields_options'   => [
					'font_size'    => [
						'default'  => [
							'unit' => 'px',
							'size' => 30
						]
					],
					'font_weight'  => [
						'default'  => '600'
					]
				],
				'selector' => '{{WRAPPER}} .fbth-animated-text-post-heading'
			]
		);
		$this->add_control(
			'fbth_post_animated_text_color',
			[
				'label'     => esc_html__('Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'default'   => $secondary_color,
				'selectors' => [
					'{{WRAPPER}} .fbth-animated-text-post-heading' => 'color: {{VALUE}}'
				]
			]
		);
		$this->end_controls_section();
	}
	protected function render()
	{
		$settings      = $this->get_settings_for_display();
		$id            = substr($this->get_id_int(), 0, 3);
		$type_heading  = explode(',', $settings['fbth_animated_text_animated_heading']);
		$before_text   = $settings['fbth_animated_text_before_text'];
		$heading_text  = $settings['fbth_animated_text_animated_heading'];
		$after_text    = $settings['fbth_animated_text_after_text'];
		$heading_tag   = $settings['fbth_animated_text_animated_heading_tag'];
		$heading_align = $settings['fbth_animated_text_animated_heading_alignment'];
		$this->add_render_attribute('fbth_typed_animated_string', 'class', 'fbth-typed-strings');
		$this->add_render_attribute(
			'fbth_typed_animated_string',
			[
				'data-type_string'       => esc_attr(json_encode($type_heading)),
				'data-heading_animation' => esc_attr($settings['fbth_animated_text_animated_heading_animated_type'])
			]
		);
		if ($settings['fbth_animated_text_animated_heading_animated_type'] === 'fbth-typed-animation') {
			$this->add_render_attribute(
				'fbth_typed_animated_string',
				[
					'data-type_speed'      => esc_attr($settings['fbth_animated_text_type_speed']),
					'data-back_type_speed' => esc_attr($settings['fbth_animated_text_back_type_speed']),
					'data-loop'            => esc_attr($settings['fbth_animated_text_loop']),
					'data-show_cursor'     => esc_attr($settings['fbth_animated_text_show_cursor']),
					'data-fade_out'        => esc_attr($settings['fbth_animated_text_fade_out']),
					'data-smart_backspace' => esc_attr($settings['fbth_animated_text_smart_backspace']),
					'data-start_delay'     => esc_attr($settings['fbth_animated_text_start_delay']),
					'data-back_delay'      => esc_attr($settings['fbth_animated_text_back_delay'])
				]
			);
		}
		if ($settings['fbth_animated_text_animated_heading_animated_type'] === 'fbth-morphed-animation') {
			$this->add_render_attribute(
				'fbth_typed_animated_string',
				[
					'data-animation_style' => esc_attr($settings['fbth_animated_text_animated_heading_animation_style']),
					'data-animation_speed' => esc_attr($settings['fbth_animated_text_animation_speed'])
				]
			);
		}
		$this->add_render_attribute(
			'fbth_animated_text_animated_heading',
			[
				'id'    => 'fbth-animated-text-' . $id,
				'class' => 'fbth-animated-text-animated-heading'
			]
		);
		$this->add_render_attribute('fbth_animated_text_before_text', 'class', 'fbth-animated-text-pre-heading');
		$this->add_inline_editing_attributes('fbth_animated_text_before_text');
		$this->add_render_attribute('fbth_animated_text_after_text', 'class', 'fbth-animated-text-post-heading');
		$this->add_inline_editing_attributes('fbth_animated_text_after_text');
		echo '<div class="fbth-animated-text-align">';
		do_action('fbth_animated_text_wrapper_before');
		echo '<' . esc_attr($heading_tag) . ' ' . $this->get_render_attribute_string('fbth_typed_animated_string') . '>';
		do_action('fbth_animated_text_content_before');
		$before_text ? printf('<span ' . $this->get_render_attribute_string('fbth_animated_text_before_text') . '>%s</span>', wp_kses_post($before_text)) : '';
		if ('fbth-typed-animation' === $settings['fbth_animated_text_animated_heading_animated_type']) {
			echo '<span id="fbth-animated-text-' . esc_attr($id) . '" class="fbth-animated-text-animated-heading"></span>';
		}
		if ('fbth-morphed-animation' === $settings['fbth_animated_text_animated_heading_animated_type']) {
			echo '<span ' . $this->get_render_attribute_string('fbth_animated_text_animated_heading') . '>' . wp_kses_post($heading_text) . '</span>';
		}
		$after_text ? printf('<span ' . $this->get_render_attribute_string('fbth_animated_text_after_text') . '>%s</span>', wp_kses_post($after_text)) : '';
		do_action('fbth_animated_text_content_after');
		echo '</' . esc_attr($heading_tag) . '>';
		do_action('fbth_animated_text_wrapper_after');
		echo '</div>';
	}
}
$widgets_manager->register(new \FBTH_Addons\Widgets\Elementor\FBTH_Animated_Text());
