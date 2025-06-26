<?php

/**
 * Scalo Testimonial Normal Widget.
 *
 *
 * @since 1.0.0
 */

use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;
use  Elementor\utils;
use  Elementor\Group_Control_Typography;
use  Elementor\Group_Control_Box_Shadow;
use  Elementor\Group_Control_Background;
use  Elementor\Group_Control_Border;
use  Elementor\Repeater;
use  Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit;
}
// If this file is called directly, abort.
class Scalo_Testimonail_Loop extends Widget_Base
{
    public function get_name()
    {
        return 'fbth-testimonial-loop';
    }
    public function get_title()
    {
        return __('Testimonial', 'fbth');
    }
    public function get_icon()
    {
        return ('eicon-site-identity');
    }
    public function get_categories()
    {
        return ['fbth'];
    }
    public function get_script_depends()
    {
        return ['fbth-addons-script', 'fancybox'];
    }

    public function get_keywords()
    {
        return ['team', 'card', 'testimonial', 'membar', 'reviw', 'rating'];
    }
    protected function register_controls()
    {
        /**
         * @package content_section
         */
        $this->fbth_testimonial_section();
        $this->column_settings();
        $this->fbth_slider_settings();
        /**
         * @package style section
         */
        $this->section_image_style();
        $this->section_name_style();
        $this->section_designation_style();
        $this->section_description_style();
        $this->fbth_content_style();
        $this->fbth_user_style();
        $this->fbth_rating_style();
        $this->fbth_quote_style();
        $this->fbth_tm_bottom_style();
        $this->fbth_dots_navigation();
        $this->fbth_arrows_navigation();
        $this->fbth_box_style();
        $this->fbth_wrapper_style();
    }
    protected function fbth_rating_style()
    {
        $this->start_controls_section(
            'rating_style',
            [
                'label' => __('Rating Icon', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'rating_active_color',
            [
                'label'     => __('Active Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial__single i.active_color' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fbth-testimonial__single svg' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'rating_inactive_color',
            [
                'label'     => __('Inactive Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial__single span.inactive_color' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fbth-testimonial__single span.inactive_color svg' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'star_rating_size',
            [
                'label'          => __('Rating Size', 'fbth'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .fbth-testimonial__single span i' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-testimonial__single span svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'star_rating_space',
            [
                'label'      => __('Space Between Ratings', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-testimonial__single span i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-testimonial__single span i' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gap_rating',
            [
                'label'          => __('Gap', 'fbth'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .rating_area' => 'padding-top: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();
    }



    protected function fbth_quote_style()
    {
        $this->start_controls_section(
            '_quote_style',
            [
                'label' => __('Quote Icon', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_quoate' => 'yes'
                ],
            ]
        );
        $this->add_control(
            '_quote_color',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial__single .quote-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fbth-testimonial__single .quote-icon svg' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            '_quote_size',
            [
                'label'          => __('Quote Size', 'fbth'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .fbth-testimonial__single .quote-icon i' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-testimonial__single .quote-icon svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
                ],
            ]
        );
        $this->end_controls_section();
    }


    protected function section_description_style()
    {
        $this->start_controls_section(
            'description',
            [
                'label' => __('Description', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'desc_style_tabs'
        );
        $this->start_controls_tab(
            'desc_normal_tab',
            [
                'label' => esc_html__('Normal', 'textdomain'),
            ]
        );
        $this->add_responsive_control(
            'description_height',
            [
                'label' => esc_html__('Height', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .fbth-testimonial__decription' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'dis_color',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial__decription' => 'color: {{VALUE}}',
					 '{{WRAPPER}} .fbth-testimonial__decription p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'desc_bg_color',
            [
                'label' => esc_html__('Background Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial__decription' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dis_typo',
                'label'    => __('Typography', 'fbth'),
                'selectors' => [
					'{{WRAPPER}}  .fbth-testimonial__decription',
					'{{WRAPPER}}  .fbth-testimonial__decription p',
			  ],
            ]
        );
        $this->add_responsive_control(
            'dis_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'condition' => [
                    'testimonial_style' => 'style-three',
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .fbth-testimonial__decription' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .fbth-testimonial__decription' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'dis_border',
                'selector'  => '{{WRAPPER}} .fbth-testimonial__decription',
            ]
        );
        $this->add_responsive_control(
            'dis_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-testimonial__decription' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-testimonial__decription' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dis_padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-testimonial__decription' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-testimonial__decription' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'desc_hover_tab',
            [
                'label' => esc_html__('Hover', 'textdomain'),
            ]
        );

        $this->add_control(
            'dis_color_hover',
            [
                'label'     => __('Hover Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth--tn-single:hover .fbth-testimonial__decription' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function section_designation_style()
    {
        $this->start_controls_section(
            'tn_position',
            [
                'label' => __('Designation', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'tn_position_color',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial__position p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tn_position_color_hover',
            [
                'label'     => __('Hover Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial__single:hover .fbth-testimonial__position p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tn_position_typo',
                'label'    => __('Typography', 'fbth'),
                'selector' => '{{WRAPPER}}  .fbth-testimonial__position p',
            ]
        );
        $this->add_responsive_control(
            'tn_position_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-testimonial__position p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-testimonial__position p' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tn_position_padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-testimonial__position p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-testimonial__position p' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function section_name_style()
    {
        $this->start_controls_section(
            'tn_name',
            [
                'label' => __('Name', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'name_color',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-name' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'name_color_hover',
            [
                'label'     => __('Hover Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial__single:hover .tm-name' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tn_name_typo',
                'label'    => __('Typography', 'fbth'),
                'selector' => '{{WRAPPER}}  .tm-name',
            ]
        );
        $this->add_responsive_control(
            'name_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .tm-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .tm-name' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function section_image_style()
    {
        $this->start_controls_section(
            'image_style',
            [
                'label' => __('Image', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label'          => __('Width', 'fbth'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units'     => ['px', '%', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .fbth-testimonial__img img' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label'          => __('Height', 'fbth'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units'     => ['px', 'vh'],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .fbth-testimonial__img img' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'object-fit',
            [
                'label'     => __('Object Fit', 'fbth'),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'height[size]!' => '',
                ],
                'options'   => [
                    ''        => __('Default', 'fbth'),
                    'fill'    => __('Fill', 'fbth'),
                    'cover'   => __('Cover', 'fbth'),
                    'contain' => __('Contain', 'fbth'),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial__img img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .fbth-testimonial__img img',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-testimonial__img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    'body.rtl {{WRAPPER}} .fbth-testimonial__img img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}} !important;;',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-testimonial__img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-testimonial__img' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .fbth-testimonial__img img',
            ]
        );
        $this->end_controls_section();
    }


    protected function fbth_user_style()
    {
        $this->start_controls_section(
            'user_style',
            [
                'label' => __('User Box', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'user_style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'user_bg_color_normal',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'user_bg',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .testimonial-image-wrapper',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'user_border',
                'selector'  => '{{WRAPPER}} .testimonial-image-wrapper',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'user_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .testimonial-image-wrapper',
            ]
        );

        $this->add_responsive_control(
            'user_padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-image-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-image-wrapper' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'user_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-image-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-image-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // hover
        $this->start_controls_tab(
            'user_color_ct_hover',
            [
                'label' => __('Hover', 'fbth'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'user_bg_hover',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .testimonial-image-wrapper:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'user_border_hover',
                'selector'  => '{{WRAPPER}} .testimonial-image-wrapper:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'user_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .testimonial-image-wrapper:hover',
            ]
        );
        $this->add_responsive_control(
            'user_border_radius_hover',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-image-wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-image-wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function fbth_tm_bottom_style()
    {
        $this->start_controls_section(
            'tm_bottom_text',
            [
                'label' => __('Ratted Text', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );
        $this->start_controls_tabs(
            'rated_style_tabs'
        );
        $this->start_controls_tab(
            'review_normal_tab',
            [
                'label' => esc_html__('Normal', 'plugin-name'),
            ]
        );
        $this->add_control(
            'rated_text_color',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p.tm-bottom-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'btm_rated_typo',
                'label'    => __('Typography', 'fbth'),
                'selector' => '{{WRAPPER}} p.tm-bottom-text',
            ]
        );
        $this->add_control(
            'review_text',
            [
                'label'     => __('Review', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
            'btm_text_color',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p.tm-bottom-text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'btm_text_typo',
                'label'    => __('Typography', 'fbth'),
                'selector' => '{{WRAPPER}} p.tm-bottom-text',
            ]
        );
        $this->add_responsive_control(
            'btm_text_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} p.tm-bottom-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} p.tm-bottom-text' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'rated_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'plugin-name'),
            ]
        );

        $this->add_control(
            'btm_text_color_hover',
            [
                'label'     => __('Review Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p.tm-bottom-text:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btm_rated_color_hover',
            [
                'label'     => __('Rated Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p.tm-bottom-text:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function fbth_dots_navigation()
    {
        $this->start_controls_section(
            'dots_navigation',
            [
                'label' => __('Navigation - Dots', 'fbth'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dots' => 'yes'
                ],
            ]
        );
        $this->start_controls_tabs('_tabs_dots');

        $this->start_controls_tab(
            '_tab_dots_normal',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => __('Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-dot-list li' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_align',
            [
                'label' => __('Alignment', 'fbth'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'fbth'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'fbth'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'fbth'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-dot-list' => 'justify-content: {{VALUE}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'dots_box_width',
            [
                'label' => __('Width', 'fbth'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-dot-list li' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_box_height',
            [
                'label' => __('Height', 'fbth'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-dot-list li' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_margin',
            [
                'label'          => __('Gap Right', 'fbth'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .fbth-testimonial-slider-dot-list li ' => 'margin-right: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-testimonial-slider-dot-list li ' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dots_min_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dots_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-testimonial-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-testimonial-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_dots_active',
            [
                'label' => __('Active', 'fbth'),
            ]
        );
        $this->add_control(
            'dots_color_active',
            [
                'label' => __('Active Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-dot-list li.slick-active' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_dots_box_active_width',
            [
                'label' => __('Width', 'fbth'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-dot-list li.slick-active' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_dots_box_active_height',
            [
                'label' => __('Height', 'fbth'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-dot-list li.slick-active' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }
    protected function fbth_arrows_navigation()
    {
        $this->start_controls_section(
            'arrows_navigation',
            [
                'label' => __('Navigation - Arrow', 'fbth'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs('_tabs_arrow');

        $this->start_controls_tab(
            '_tab_arrow_normal',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __('Arrow Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow button' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow button svg path' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_color_fill',
            [
                'label' => __('Arrow Line Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow button svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label' => __('Background Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow button' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'arrow_shadow',
                'label' => __('Shadow', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-testimonial-slider-arrow button ',
            ]
        );

        $this->add_control(
            'arrow_position_toggle',
            [
                'label' => __('Position', 'fbth'),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'fbth'),
                'label_on' => __('Custom', 'fbth'),
                'return_value' => 'yes',
            ]
        );
        $this->start_popover();

        /*
Arrow Position
*/
        $start = is_rtl() ? __('Right', 'elementor') : __('Left', 'elementor');
        $end = !is_rtl() ? __('Right', 'elementor') : __('Left', 'elementor');

        /* tobol */
        $this->add_control(
            'offset_orientation_v',
            [
                'label' => __('Vertical Orientation', 'elementor'),
                'type' => Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'start',
                'options' => [
                    'top' => [
                        'title' => __('Top', 'elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'render_type' => 'ui',
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow' => '{{VALUE}}: 0;',
                ],

            ]
        );

        $this->add_responsive_control(
            'arrow_position_top',
            [
                'label' => __('Vertical', 'fbth'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'condition' => [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow' => 'top: {{SIZE}}{{UNIT}}; bottom:auto',
                ],
                'condition' => [
                    'offset_orientation_v' => 'top',
                ],
            ]
        );


        $this->add_responsive_control(
            'arrow_position_bottom',
            [
                'label' => __('Vertical', 'fbth'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'condition' => [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow' => 'bottom: {{SIZE}}{{UNIT}} !important; top:auto',
                ],
                'condition' => [
                    'offset_orientation_v' => 'bottom',
                ],
            ]
        );


        $this->add_control(
            'arrow_horizontal_position',
            [
                'label'             => __('Horizontal Position', 'fbth'),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'default',
                'options'           => [
                    'default'    =>   __('Default',    'fbth'),
                    'space_between'    =>   __('Space Between',    'fbth'),
                ],
                'separator' => 'after',
            ]
        );
        $this->add_responsive_control(
            'arrow_position_x_prev',
            [
                'label' => __('Horizontal Prev', 'fbth-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 2000,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .fbth-testimonial-slider-arrow .prev' => 'left: {{SIZE}}{{UNIT}}; right: auto !important;',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'space_between',
                ],

            ]
        );



        // default == arrow gap
        // space-between == left position, right position

        $this->add_responsive_control(
            'arrow_position_right',
            [
                'label' => __('Horizontal Next', 'fbth-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -2000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow .next' => 'right: {{SIZE}}{{UNIT}} !important; left: auto !important;',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'space_between',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_gap_',
            [
                'label' => __('Arrow Gap', 'fbth-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                    '%' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow .prev' => 'margin-right: {{SIZE}}{{UNIT}} !important; position: relative !important',
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow .next ' => 'margin-right: 0 !important; position: relative !important',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'default',
                ],
            ]
        );

        $this->add_responsive_control(
            'align_arrow',
            [
                'label' => __('Alignment', 'fbth'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'fbth'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'fbth'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'fbth'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'default',
                ],
            ]
        );

        $this->end_popover();

        $this->add_responsive_control(
            'arrow_icon_size',
            [
                'label' => __('Icon Size', 'fbth'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .fbth-testimonial-slider-arrow button i' => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}  .fbth-testimonial-slider-arrow button svg' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_size_box',
            [
                'label' => __('Size', 'fbth'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                ],
            ]

        );

        $this->add_responsive_control(
            'arrow_size_line_height',
            [
                'label' => __('Line Height', 'fbth'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow button' => 'line-height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]

        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_border',
                'label'    => __('Button border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-testimonial-slider-arrow button',
            ]
        );

        $this->add_responsive_control(
            'arrows_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-testimonial-slider-arrow button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_hover',
            [
                'label' => __('Hover', 'fbth'),
            ]
        );

        $this->add_control(
            'arrow_hover_color',
            [
                'label' => __('Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow button:hover ' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow button:hover svg path ' => 'stroke: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_fill_color',
            [
                'label' => __('Line Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow button:hover ' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow button:hover path' => 'fill: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_hover_color',
            [
                'label' => __('Background Color Hover', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow button:hover ' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_hover_border',
                'label'    => __('Button border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-testimonial-slider-arrow button:hover',
            ]
        );

        $this->add_responsive_control(
            'arrows_hover_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-testimonial-slider-arrow button:hover ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_active',
            [
                'label' => __('Active', 'fbth'),
            ]
        );

        $this->add_control(
            'arrow_active_color',
            [
                'label' => __('Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow .slick-active' => 'color: {{VALUE}} !important;;',
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow .slick-active svg path' => 'stroke: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_control(
            'arrow_active_fill_color',
            [
                'label' => __('Line Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow .slick-active' => 'color: {{VALUE}} !important;;',
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow .slick-active path' => 'fill: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_active_color',
            [
                'label' => __('Background Color Hover', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow .slick-active ' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_active_border',
                'label'    => __('Button border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-testimonial-slider-arrow .slick-active button',
            ]
        );

        $this->add_responsive_control(
            'arrows_active_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-testimonial-slider-arrow .slick-active button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-testimonial-slider-arrow .slick-active button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function fbth_slider_settings()
    {

        $this->start_controls_section(
            'fbth_slider_settings',
            [
                'label' => __('Slider Settings', 'fbth'),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_slider_settings' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'slider_gap_right',
            [
                'label'          => __('Gap Right', 'fbth'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .fbth-testimonial-slider .slick-slide' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-testimonial-slider .slick-list' => 'margin-right: -{{SIZE}}{{UNIT}};margin-left: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'per_coulmn',
            [
                'label' => __('Slider Items', 'fbth'),
                'type' => Controls_Manager::SELECT,
                'default'            => 4,
                'tablet_default'     => 2,
                'mobile_default'     => 1,
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ],
                'frontend_available' => true,
            ]
        );
        $this->add_control(
            'show_vertical',
            [
                'label' => __('Vertical Mode?', 'fbth'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fbth'),
                'label_off' => __('Hide', 'fbth'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'arrows',
            [
                'label' => __('Show arrows?', 'fbth'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fbth'),
                'label_off' => __('Hide', 'fbth'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'dots',
            [
                'label' => __('Show Dots?', 'fbth'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fbth'),
                'label_off' => __('Hide', 'fbth'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'mousedrag',
            [
                'label' => __('Show MouseDrag', 'fbth'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fbth'),
                'label_off' => __('Hide', 'fbth'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'label' => __('Auto Play?', 'fbth'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fbth'),
                'label_off' => __('Hide', 'fbth'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'loop',
            [
                'label' => __('Infinite Loop', 'fbth'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fbth'),
                'label_off' => __('Hide', 'fbth'),
                'return_value' => 'yes',
                'default' => 'true',
            ]
        );
        $this->add_control(
            'autoplaytimeout',
            [
                'label' => __('Autoplay Timeout', 'fbth'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'default' => '5000',
                'options' => [
                    '1000'  => __('1 Second', 'fbth'),
                    '2000'  => __('2 Second', 'fbth'),
                    '3000'  => __('3 Second', 'fbth'),
                    '4000'  => __('4 Second', 'fbth'),
                    '5000'  => __('5 Second', 'fbth'),
                    '6000'  => __('6 Second', 'fbth'),
                    '7000'  => __('7 Second', 'fbth'),
                    '8000'  => __('8 Second', 'fbth'),
                    '9000'  => __('9 Second', 'fbth'),
                    '10000' => __('10 Second', 'fbth'),
                    '11000' => __('11 Second', 'fbth'),
                    '12000' => __('12 Second', 'fbth'),
                    '13000' => __('13 Second', 'fbth'),
                    '14000' => __('14 Second', 'fbth'),
                    '15000' => __('15 Second', 'fbth'),
                ],
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'arrow_prev_icon',
            [
                'label' => __('Previous Icon', 'fbth'),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'arrow_next_icon',
            [
                'label' => __('Next Icon', 'fbth'),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function column_settings()
    {
        $this->start_controls_section(
            'column_settings',
            [
                'label' => __('Column Settings', 'fbth'),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_slider_settings!' => 'yes',
                ]
                
            ]
        );

        $this->add_responsive_control('per_line', [
            'label'              => __('Columns per row', 'fbth'),
            'type'               => Controls_Manager::SELECT,
            'default'            => '4',
            'tablet_default'     => '6',
            'tablet_extra'     => '6',
            'mobile_default'     => '12',
            'options'            => [
                '12' => '1',
                '6'  => '2',
                '4'  => '3',
                '3'  => '4',
            ],
            'frontend_available' => true,
        ]);

        $this->add_responsive_control(
            'item_gap_right',
            [
                'label'          => __('Gap Right', 'fbth'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .fbth-addons-post-widget-wrap' => 'padding-right: {{SIZE}}{{UNIT}}; padding-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .row' => 'margin-right: -{{SIZE}}{{UNIT}};margin-left: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_gap_bottom',
            [
                'label'          => __('Gap Bottom', 'fbth'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .fbth-addons-post-widget-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-testimonial' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function fbth_testimonial_section()
    {
        $this->start_controls_section(
            'fbth_testimonial_section',
            [
                'label' => __('General', 'fbth'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'testimonial_style',
            [
                'label'             => __('Testimonial Style', 'fbth'),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'style-one',
                'options'           => [
                    'style-one'    =>   __('Style 01', 'fbth'),
                    'style-two'    =>   __('Style 02', 'fbth'),
                    'style-three'    =>   __('Style 03', 'fbth'),
                    'style-four'    =>   __('Style 04', 'fbth'),
                    'style-five'    =>   __('Style 05', 'fbth'),
                    'style-six'    =>   __('Style 06', 'fbth'),

                ],
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'show_masonary',
            [
                'label' => esc_html__('Show Masonary', 'fbth'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'fbth'),
                'label_off' => esc_html__('Hide', 'fbth'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_slider_settings',
            [
                'label' => __('Slider Active', 'fbth'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'fbth'),
                'label_off' => __('No', 'fbth'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );


        $this->add_control(
            'show_quoate',
            [
                'label' => esc_html__('Show Quote', 'fbth'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'fbth'),
                'label_off' => esc_html__('Hide', 'fbth'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'quote_icon',
            [
                'label' => esc_html__('quote Icon', 'fbth'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-quote-left',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_quoate' => 'yes'
                ],
            ]
        );


        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'enable_rating_icon',
            [
                'label' => __('Enable Rating Icon', 'fbth'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fbth'),
                'label_off' => __('Hide', 'fbth'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'rating_icon',
            [
                'label' => __('Rating Icon', 'fbth'),
                'condition' => [
                    'enable_rating_icon' => 'yes'
                ],
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],

            ]
        );
        $repeater->add_control(
            'rating',
            [
                'label' => esc_html__('Testimonial Rating', 'rating_icon'),
                'type' => Controls_Manager::SELECT,
                'default' => '5',
                'options'   => [
                    '5'     => esc_html__('5', 'rating_icon'),
                    '4'     => esc_html__('4', 'rating_icon'),
                    '3'     => esc_html__('3', 'rating_icon'),
                    '2'     => esc_html__('2', 'rating_icon'),
                    '1'     => esc_html__('1', 'rating_icon'),
                ],
                'label_block' => true,
                'condition' => [
                    'enable_rating_icon' => 'yes'
                ]

            ]
        );

        $repeater->add_control(
            'fbth_testimonial_name',
            [
                'label' => esc_html__('Name', 'fbth'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Jenny', 'fbth'),
                'show_label' => true,
            ]
        );

        $repeater->add_control(
            'name_size',
            [
                'label' => esc_html__('Name Size', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h5',
            ]
        );
		
		 $repeater->add_control(
            'enable_name_img',
            [
                'label' => __('Enable verified Image', 'fbth'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fbth'),
                'label_off' => __('Hide', 'fbth'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );


        $repeater->add_control(
            'fbth_testimonial_verify_img',
            [
                'label' => esc_html__('Add Verify Images', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'enable_name_img' => 'yes'
                ]
            ]
        );
		
		
		   $repeater->add_control(
            'show_social_icon',
            [
                'label' => esc_html__('Show Social Icon', 'fbth'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'fbth'),
                'label_off' => esc_html__('Hide', 'fbth'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'social_icon',
            [
                'label' => esc_html__('Social Icon', 'fbth'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-quote-left',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_social_icon' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'     => __('Social Link', 'fbth'),
                'type'      => Controls_Manager::URL,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => [
                    'url' => '#',
                ],
                'condition' => [
                    'show_social_icon' => 'yes'
                ],
                'separator' => 'before',
            ]
        );
		

        $repeater->add_control(
            'fbth_testimonial_position',
            [
                'label' => esc_html__('Positions', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Co-Founder', 'plugin-name'),
                'show_label' => true,
            ]
        );

        $repeater->add_control(
            'position_size',
            [
                'label' => esc_html__('Positions Size', 'fbth'),
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
            'fbth_testimonial_content',
            [
                'label' => esc_html__('Content', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Create this account for myself secuse in the future. best site to earn.', 'plugin-name'),
                'show_label' => true,
            ]
        );
        $repeater->add_control(
            'size',
            [
                'label' => esc_html__('Description Size', 'fbth'),
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
            'enable_show_img',
            [
                'label' => __('Enable Image', 'fbth'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fbth'),
                'label_off' => __('Hide', 'fbth'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $repeater->add_control(
            'fbth_testimonial_user_img',
            [
                'label' => esc_html__('Add User Images', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'enable_show_img' => 'yes'
                ]
            ]
        );
		
		
		  $repeater->add_control(
            'enable_content_text',
            [
                'label' => __('Enable Text Editor', 'fbth'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fbth'),
                'label_off' => __('Hide', 'fbth'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'text_editor_text',
            [
                'label' => esc_html__('Text Editor', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '',
                'show_label' => true,
                'condition' => [
                    'enable_content_text' => 'yes'
                ]
            ]
        );


        $repeater->add_control(
            'enable_rated_text',
            [
                'label' => __('Enable Rated Text', 'fbth'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fbth'),
                'label_off' => __('Hide', 'fbth'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'rated_text',
            [
                'label' => esc_html__('Rating Text', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Rated 4.5/5'),
                'show_label' => true,
                'condition' => [
                    'enable_rated_text' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'rated_size',
            [
                'label' => esc_html__('Rated Size', 'fbth'),
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
                'condition' => [
                    'enable_rated_text' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'review_text',
            [
                'label' => esc_html__('Review Text', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('-from over 100 reviews'),
                'show_label' => true,
                'condition' => [
                    'enable_rated_text' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'review_size',
            [
                'label' => esc_html__('Review Size', 'fbth'),
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
                'condition' => [
                    'enable_rated_text' => 'yes'
                ]
            ]
        );
		$repeater->add_control(
            'logo_image',
            [
                'label' => __( 'Choose Logo Image', 'finisys' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'testimonial_list',
            [
                'label' => esc_html__('Testimonial List', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'fbth_testimonial_name' => esc_html__('Name', 'plugin-name'),
                        'fbth_testimonial_content' => esc_html__('Item content. Click the edit button to change this text.', 'plugin-name'),
                    ]
                ],
                'title_field' => '{{{ fbth_testimonial_name }}}',
            ]
        );
        $this->end_controls_section();
    }


    // content
    protected function fbth_content_style()
    {
        $this->start_controls_section(
            'content_style',
            [
                'label' => __('Content Box', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testimonial_style' => 'style-five',
                ],
            ]
        );
        $this->start_controls_tabs(
            'content_style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'ct_bg_color_normal',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ct_bg',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .style-five .testimonial-content',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'ct_border',
                'selector'  => '{{WRAPPER}} .style-five .testimonial-content',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'ct_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .style-five .testimonial-content',
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .style-five .testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .style-five .testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .style-five .testimonial-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .style-five .testimonial-content' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // hover
        $this->start_controls_tab(
            'bg_color_ct_hover',
            [
                'label' => __('Hover', 'fbth'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ct_bg_hover',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .style-five .testimonial-content:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'ct_border_hover',
                'selector'  => '{{WRAPPER}} .style-five .testimonial-content:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'ct_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .style-five .testimonial-content:hover',
            ]
        );
        $this->add_responsive_control(
            'ct_border_radius_hover',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .style-five .testimonial-content:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .style-five .testimonial-content:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function fbth_box_style()
    {
        $this->start_controls_section(
            'ts_style',
            [
                'label' => __('Box', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'tn_bg_color',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bg',
                'label' => __('Box Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .fbth-testimonial__single',
            ]
        );
        
        $this->add_control(
            'box_bg_2',
            [
                'label' => __('Background Color Two', 'fd-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-slide:nth-child(4n+1) .fbth-testimonial__single' => 'background: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'box_bg_3',
            [
                'label' => __('Background Color Three', 'fd-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-slide:nth-child(4n+2) .fbth-testimonial__single' => 'background: {{VALUE}}',
                ],
            ]
        );
       $this->add_control(
            'box_bg_4',
            [
                'label' => __('Background Color Four', 'fd-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-slide:nth-child(4n+3) .fbth-testimonial__single' => 'background: {{VALUE}}',
                ],
            ]
        );
         $this->add_control(
            'box_bg_5',
            [
                'label' => __('Background Color Five', 'fd-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-slide:nth-child(4n+4) .fbth-testimonial__single' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'tn_border',
                'selector'  => '{{WRAPPER}} .fbth-testimonial__single',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tn_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .fbth-testimonial__single',
            ]
        );
        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'fbth'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'fbth'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'fbth'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'fbth'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial__single' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_align',
            [
                'label' => __('Content Box Alignment', 'fbth'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'fbth'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'fbth'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'fbth'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial__bottom-meta' => 'justify-content: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-testimonial__single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-testimonial__single' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-testimonial__single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-testimonial__single' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // hover
        $this->start_controls_tab(
            'bg_color_hover',
            [
                'label' => __('Hover', 'fbth'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bg_hover',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .fbth-testimonial__single:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'tn_border_hover',
                'selector'  => '{{WRAPPER}} .fbth-testimonial__single:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tn_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .fbth-testimonial__single:hover',
            ]
        );
        $this->add_responsive_control(
            'border_radius_hover',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-testimonial__single:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-testimonial__single:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    protected function fbth_wrapper_style()
    {
        $this->start_controls_section(
            'wrapper_ts_style',
            [
                'label' => __('Wrapper', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'wrapper_style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'wrapper_tn_bg_color',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'wrapper_bg',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .fbth-testimonial',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'wrapper_tn_border',
                'selector'  => '{{WRAPPER}} .fbth-testimonial',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_tn_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .fbth-testimonial',
            ]
        );
        $this->add_responsive_control(
            'wrapper_align',
            [
                'label' => __('Alignment', 'fbth'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'fbth'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'fbth'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'fbth'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .fbth-testimonial' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_box_padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-testimonial' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wrapper_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // hover
        $this->start_controls_tab(
            'wrapper_bg_color_hover',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'wrapper_bg_hover',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .fbth-testimonial:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'wrapper_tn_border_hover',
                'selector'  => '{{WRAPPER}} .fbth-testimonial:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_tn_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .fbth-testimonial:hover',
            ]
        );
        $this->add_responsive_control(
            'wrapper_border_radius_hover',
            [
                'label'      => __('wrapper_Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-testimonial:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-testimonial:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $testimonial_style = $settings['testimonial_style'];
        $massnoay = '';
        if ('yes' == $settings['show_masonary']) {
            $massnoay = 'tm-masonary';
        } else {
            $massnoay = '';
        }
        $slider_extraSetting = array(
            'loop' => (!empty($settings['loop']) && 'yes' === $settings['loop']) ? true : false,
            'dots' => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,
            'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
            'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
            'show_vertical' => (!empty($settings['show_vertical']) && 'yes' === $settings['show_vertical']) ? true : false,
            'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',
            //this a responsive layout
            'per_coulmn' => (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 3,
            'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 2,
            'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 1
        );
        $jasondecode = wp_json_encode($slider_extraSetting);
        if (('yes' == $settings['show_slider_settings'])) {
            $this->add_render_attribute('testimonail_version', 'class', array('fbth-testimonial-slider', 't-style'));
            $this->add_render_attribute('testimonail_version', 'data-settings', $jasondecode);
        } else {
            $this->add_render_attribute('testimonail_version', 'class', array($testimonial_style, 'row g-0 justify-content-center', $massnoay));
            //gride class
            $grid_classes = [];
            $grid_classes[] = 'col-xl-' . $settings['per_line'];
            $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
            $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
            $grid_classes = implode(' ', $grid_classes);
            $this->add_render_attribute('tn_classes', 'class', [$grid_classes, 'fbth-addons-post-widget-wrap']);
        }

?>

        <?php
        if ($settings['testimonial_list']) {

        ?>
            <div class="fbth-testimonial">
                <div <?php echo $this->get_render_attribute_string('testimonail_version'); ?>>
                    <?php
                    $i = 1;
                    foreach ($settings['testimonial_list'] as $item) {
                        $ratting = $item['rating'];

                    ?>
                        <!-- Single Slider -->

                        <div <?php echo $this->get_render_attribute_string('tn_classes'); ?>>

                            <?php if ($testimonial_style) {
                                include('content/' . $testimonial_style . '.php');
                            } ?>
                        </div>

                <?php
                        $i++;
                    }
                }
                echo '</div>';
                echo '</div>';
                ?>
                <?php if ('yes' == $settings['show_slider_settings'] && 'yes' == $settings['arrows']) : ?>
                    <div class="fbth-testimonial-slider-arrow">
                        <?php if (!empty($settings['arrow_prev_icon']['value'])) : ?>
                            <button type="button" class="slick-prev prev slick-arrow slick-active">
                                <?php Icons_Manager::render_icon($settings['arrow_prev_icon'], ['aria-hidden' => 'true']); ?>
                            </button>
                        <?php endif; ?>
                        <?php if (!empty($settings['arrow_next_icon']['value'])) : ?>
                            <button type="button" class="slick-next next slick-arrow ">
                                <?php Icons_Manager::render_icon($settings['arrow_next_icon'], ['aria-hidden' => 'true']); ?>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
        <?php
    }
}
$widgets_manager->register(new \Scalo_Testimonail_Loop());
