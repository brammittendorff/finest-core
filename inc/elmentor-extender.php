<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
// Add Alignment Feature on counter
add_action('elementor/element/counter/section_title/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'fbth_section_extra',
        [
            'label' => __('Finest Base Extra', 'fbth'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_responsive_control(
        'fbth_counter_display',
        [
            'label' => esc_html__('Display Type', 'fbth'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'initial',
            'options' => [
                'initial'  => esc_html__('initial', 'fbth'),
                'block' => esc_html__('Block', 'fbth'),
                'flex' => esc_html__('Flex', 'fbth'),
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-counter' => 'display: {{VALUE}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'counter_width',
        [
            'label' => esc_html__('Counter Width', 'fbth'),
            'type' => \Elementor\Controls_Manager::SLIDER,
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
            'default' => [
                'unit' => '%',
                'size' => 50,
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-counter .elementor-counter-number-wrapper' => 'width: {{SIZE}}{{UNIT}};',
            ],
            
        ]
    );
    $element->add_responsive_control(
        'fbth_counter_align',
        [
            'label'     => __('Counter Alignment', 'fbth'),
            'type'      => \Elementor\Controls_Manager::CHOOSE,
            'options'   => [
                'left'   => [
                    'title' => __('Left', 'fbth'),
                    'icon'  => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'fbth'),
                    'icon'  => 'eicon-text-align-center',
                ],
                'right'  => [
                    'title' => __('Right', 'fbth'),
                    'icon'  => 'eicon-text-align-right',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-counter .elementor-counter-number-wrapper ' => 'text-align: {{VALUE}}; display: block;',
            ],
        ]
    );
    $element->add_responsive_control(
        'fbth_title_align',
        [
            'label'     => __('Title Alignment', 'fbth'),
            'type'      => \Elementor\Controls_Manager::CHOOSE,
            'options'   => [
                'left'    => [
                    'title' => __('Left', 'fbth'),
                    'icon'  => 'eicon-text-align-left',
                ],
                'center'  => [
                    'title' => __('Center', 'fbth'),
                    'icon'  => 'eicon-text-align-center',
                ],
                'right'   => [
                    'title' => __('Right', 'fbth'),
                    'icon'  => 'eicon-text-align-right',
                ],
                'justify' => [
                    'title' => __('Justified', 'fbth'),
                    'icon'  => 'eicon-text-align-justify',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-counter .elementor-counter-title ' => 'text-align: {{VALUE}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'fbth_counter_gap',
        [
            'label'     => __('Counter Gap', 'fbth'),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-counter .elementor-counter-number-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'suffix_prefix_color',
        [
            'label' => esc_html__('Prefix/Suffix Color', 'fbth'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-counter-number-suffix' => 'color: {{VALUE}}',
                '{{WRAPPER}} .elementor-counter-number-prefix' => 'color: {{VALUE}}',
            ],
        ]
    );
    $element->end_controls_section();
}, 10, 2);



// Add select dropdown control to button widget
add_action('elementor/element/image-box/section_style_content/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'fbth_section_extra',
        [
            'label' => __('Finest Base Extra', 'fbth'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_control(
        'fbth_img_hover_scale',
        [
            'label'     => __('Image Hover Scale', 'fbth'),
            'type'      => \Elementor\Controls_Manager::NUMBER,
            'min'       => 0,
            'max'       => 100,
            'step'      => 0.1,
            'selectors' => [
                '{{WRAPPER}} .elementor-image-box-img:hover' => 'transform: scale({{VALUE}});',
            ],
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name'     => 'fbth_image_hover_shadow',
            'label'    => __('Image Hover Shadow', 'fbth'),
            'selector' => '{{WRAPPER}}:hover .elementor-image-box-img',
        ]
    );
    $element->add_responsive_control(
        'fbth_image_margin',
        [
            'label'      => __('Image Margin', 'fbth'),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-image-box-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
            ],
        ]
    );
    $element->add_responsive_control(
        'fbth_title_padding',
        [
            'label'      => __('Content Padding', 'fbth'),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-image-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name'     => 'fbth_image_border',
            'label'    => __('Image Border', 'fbth'),
            'selector' => '{{WRAPPER}} .elementor-image-box-img img',
        ]
    );
    $element->end_controls_section();
}, 10, 2);

// Add select dropdown control to button widget
add_action('elementor/element/video/section_lightbox_style/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'section_extra',
        [
            'label' => __('Finest Base Extra', 'fbth-addons'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_control(
        'play_icon_bg',
        [
            'label'     => __('Icon Box Background Color', 'fbth-addons'),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-custom-embed-play'        => 'background-color: {{VALUE}}',
                '{{WRAPPER}} .elementor-custom-embed-play:before' => 'background-color: {{VALUE}}',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
                'show_play_icon'     => 'yes',
            ],
        ]
    );

    $element->add_responsive_control(
        'play_icon_before_size',
        [
            'label'     => __('Animation Size', 'fbth-addons'),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'default'   => [
                'size' => 0,
            ],
            'range'     => [
                'px' => [
                    'max'  => 200,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-custom-embed-play:before' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
                'show_play_icon'     => 'yes',
            ],
        ]
    );

    $element->add_control(
        'iamge_overly_color',
        [
            'label'     => __('Image Overlay Color', 'fbth-addons'),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-wrapper.elementor-open-lightbox:after' => 'background-color: {{VALUE}}',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
                'show_play_icon'     => 'yes',
            ],
        ]
    );

    $element->add_responsive_control(
        'iamge_overly_opacity',
        [
            'label'     => __('Opacity', 'fbth-addons'),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'default'   => [
                'size' => 0,
            ],
            'range'     => [
                'px' => [
                    'max'  => 1,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-wrapper.elementor-open-lightbox:after' => 'opacity: {{SIZE}};',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
            ],
        ]
    );
    $element->add_responsive_control(
        'play_icon_box_size',
        [
            'label'     => __('Icon Box Size', 'fbth-addons'),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 10,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-custom-embed-play' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
                'show_play_icon'     => 'yes',
            ],
        ]
    );

    $element->add_responsive_control(
        'image_width',
        [
            'label'     => __('Image Width', 'fbth-addons'),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'range'     => [
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
                '{{WRAPPER}} .elementor-custom-embed-image-overlay img' => 'width: {{SIZE}}{{UNIT}};',
            ],

        ]
    );

    $element->add_responsive_control(
        'image_height',
        [
            'label'     => __('Image Height', 'fbth-addons'),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'range'     => [
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
                '{{WRAPPER}} .elementor-custom-embed-image-overlay img' => 'height: {{SIZE}}{{UNIT}};',
            ],

        ]
    );

    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name'     => 'video_border',
            'label'    => __('Item Border', 'fbth-addons'),
            'selector' => '{{WRAPPER}}  .elementor-custom-embed-play',
        ]
    );

    $element->add_responsive_control(
        'overlay_radius',
        [
            'label'      => __('Image Oveerlay Radius', 'fbth-addons'),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-custom-embed-image-overlay img, {{WRAPPER}} .elementor-wrapper.elementor-open-lightbox:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition'  => [
                'show_image_overlay' => 'yes',
            ],
        ]
    );
    $element->end_controls_section();
}, 10, 2);

// icon box
add_action('elementor/element/icon-box/section_style_icon/after_section_start', function ($element, $args) {
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name'     => 'fbth_icon_box_border',
            'label'    => __('Item Border', 'fbth'),
            'selector' => '{{WRAPPER}} .elementor-icon-box-icon .elementor-icon',
        ]
    );

    $element->add_responsive_control(
        'icon_top_gap',
        [
            'label'     => __('Icon Gap', 'fbth-addons'),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range'     => [
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
                '{{WRAPPER}} .elementor-icon-box-icon .elementor-icon' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],

        ]
    );
}, 10, 2);
// button
add_action('elementor/element/button/section_style/after_section_start', function ($element, $args) {
    $element->add_control(
        'fbth_button_width',
        [
            'label'      => esc_html__('Width', 'fbth'),
            'type'       => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range'      => [
                'px' => [
                    'min'  => 0,
                    'max'  => 1000,
                    'step' => 1,
                ],
                '%'  => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .elementor-button' => 'min-width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'fbth_button_height',
        [
            'label'      => esc_html__('Height', 'fbth'),
            'type'       => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range'      => [
                'px' => [
                    'min'  => 0,
                    'max'  => 1000,
                    'step' => 1,
                ],
                '%'  => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .elementor-button' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'fbth_button_icon',
        [
            'label'     => esc_html__('Icon', 'fbth'),
            'type'      => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );
    $element->add_control(
        'fbth_btn_icon_size',
        [
            'label'      => esc_html__('Icon Size', 'fbth'),
            'type'       => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range'      => [
                'px' => [
                    'min'  => 0,
                    'max'  => 1000,
                    'step' => 1,
                ],
                '%'  => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .elementor-button-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .elementor-button-icon svg' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'fbth_btn_icon_gap',
        [
            'label'      => esc_html__('Icon Gap', 'fbth'),
            'type'       => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range'      => [
                'px' => [
                    'min'  => 0,
                    'max'  => 1000,
                    'step' => 1,
                ],
                '%'  => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .elementor-button-icon' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
}, 10, 2);
add_action('elementor/element/before_section_end', function ($element, $section_id, $args) {
    /** @var \Elementor\Element_Base $element */
    if ('section_background' === $section_id) {
        $element->add_control(
            'fbth_custom_bg_css',
            [
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'label'     => __('Custom CSS', 'fbth'),
                'selectors' => [
                    '{{WRAPPER}} ' => '{{VALUE}}',
                ],
            ]
        );
        $element->add_control(
            'fbth_rtl_css_on',
            [
                'label'        => __('RTL CSS', 'fbth'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'fbth'),
                'label_off'    => __('Hide', 'fbth'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $element->add_control(
            'fbth_custom_bg_css_rtl',
            [
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'label'     => __('Custom RTl CSS', 'fbth'),
                'selectors' => [
                    'body.rtl {{WRAPPER}} ' => '{{VALUE}}',
                ],
                'condition' => [
                    'fbth_rtl_css_on' => 'yes',
                ],
            ]
        );
    }
    //overly Slider Control
    if ('fbth_section_background_overlay' === $section_id) {
        $element->add_responsive_control(
            'fbth_custom_bg_overlay_css_slider',
            [
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'label'      => __('Width', 'fbth'),
                'size_units' => ['%', 'px'],
                'range'      => [
                    'px'      => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'       => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 0,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-background-overlay' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    }
    if ('fbth_section_background_overlay' === $section_id) {
        $element->add_responsive_control(
            'bc_padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-background-overlay'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .elementor-background-overlay' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
    }
    if ('fbth_section_background_overlay' === $section_id) {
        $element->add_control(
            'custom_bg_overlay_css',
            [
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'label'     => __('Custom CSS', 'fbth'),
                'selectors' => [
                    '{{WRAPPER}} > .elementor-background-overlay' => '{{VALUE}}',
                ],
            ]
        );
        $element->add_control(
            'fbth_overlaY_rtl_css_on',
            [
                'label'        => __('RTL CSS', 'fbth'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'fbth'),
                'label_off'    => __('Hide', 'fbth'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $element->add_control(
            'fbth_overlay_bg_css_rtl',
            [
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'label'     => __('Custom RTl CSS', 'fbth'),
                'selectors' => [
                    'body.rtl {{WRAPPER}} > .elementor-background-overlay' => '{{VALUE}}',
                ],
                'condition' => [
                    'overlaY_rtl_css_on' => 'yes',
                ],
            ]
        );
    }
}, 10, 3);
// Add Alignment Feature on counter
add_action('elementor/element/testimonial/section_style_testimonial_job/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'fbth_section_extra',
        [
            'label' => __('Finest Base Extra', 'fbth'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_responsive_control(
        'fbth_counter_gap',
        [
            'label'     => __('Content Gap', 'fbth'),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-testimonial-content ' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'fbth_name_gap',
        [
            'label'     => __('Name Gap', 'fbth'),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-testimonial-name ' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->end_controls_section();
}, 10, 2);
// Add Alignment Feature on counter
add_action('elementor/element/accordion/section_toggle_style_content/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'fbth_section_extra',
        [
            'label' => __('Finest Base Extra', 'fbth'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_control(
        'fbth_acc_item_border_hading',
        [
            'label'     => __('Content border', 'fbth'),
            'type'      => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name'     => 'fbth_acc_content_border',
            'label'    => __('Item Border', 'fbth'),
            'selector' => '{{WRAPPER}}  .elementor-tab-content',
        ]
    );
    $element->add_control(
        'fbth_more_options',
        [
            'label'     => __('Box border', 'fbth'),
            'type'      => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name'     => 'fbth_acc_border',
            'label'    => __('Item Border', 'fbth'),
            'selector' => '{{WRAPPER}}  .elementor-accordion-item',
        ]
    );
    $element->add_control(
        'fbth_acc_bg',
        [
            'label'     => __('Accordion Item Background Color', 'fbth'),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion-item ' => 'background-color: {{VALUE}}',
            ],
        ]
    );
    $element->add_responsive_control(
        'fbth_acc_radius',
        [
            'label'      => __('Item Border Radius', 'fbth'),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'fbth_acc_content_margin',
        [
            'label'      => __('Content Margin', 'fbth'),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'fbth_acc_paddingn',
        [
            'label'      => __('Item Padding', 'fbth'),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-accordion-item' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'fbth_acc_margin',
        [
            'label'      => __('Item Margin', 'fbth'),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->end_controls_section();
}, 10, 2);
// / Add select dropdown control to button widget
add_action('elementor/element/icon-list/section_icon_list/after_section_start', function ($element, $args) {
    $element->add_responsive_control(
        'icon_list_bg_color',
        [
            'label' => esc_html__('Background Color', 'fbth'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item' => 'background-color: {{VALUE}}',
            ],
        ]
    );
    $element->add_responsive_control(
        'icon_list_pading',
        [
            'label' => esc_html__('Padding', 'fbth'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $element->add_responsive_control(
        'icon_list_radius',
        [
            'label' => esc_html__('Radius', 'fbth'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'icon_list_gap',
        [
            'label' => esc_html__('List Gap Bottom', 'fbth'),
            'type' => \Elementor\Controls_Manager::SLIDER,
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
                '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item' => ' margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
}, 10, 2);
add_action('elementor/element/icon-list/section_icon_style/after_section_start', function ($element, $args) {
    $element->add_control(
        'fbth_icon_line_color',
        [
            'label'     => __('Line Color', 'fbth'),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon svg path' => 'fill: {{VALUE}};',
            ],
        ]
    );
    $element->add_control(
        'fbth_icon_bg_color',
        [
            'label'     => __('Background Color', 'fbth'),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon' => 'background-color: {{VALUE}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'fbth_iconlist_width',
        [
            'label'     => __('Width', 'fbth'),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon ' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'fbth_iconlist_height',
        [
            'label'     => __('Height', 'fbth'),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon ' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'fbth_iconlist_ border_radius',
        [
            'label'     => __('Border Radius', 'fbth'),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon ' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'fbth_icon_self_align_position',
        [
            'label'     => esc_html__('Icon Position', 'elementor'),
            'type'      => \Elementor\Controls_Manager::CHOOSE,
            'options'   => [
                'flex-start' => [
                    'title' => esc_html__('Top', 'elementor'),
                    'icon'  => 'eicon-align-start-v',
                ],
                'center'     => [
                    'title' => esc_html__('Center', 'elementor'),
                    'icon'  => 'eicon-align-center-v',
                ],
                'flex-end'   => [
                    'title' => esc_html__('End', 'elementor'),
                    'icon'  => 'eicon-align-end-v',
                ],
            ],
            'default'   => 'center',
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item' => 'align-items:{{VALUE}}',
            ],
        ]
    );
    $element->add_responsive_control(
        'fbth_iconlist_Icon_gap',
        [
            'label'     => __('Icon gap', 'fbth'),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon ' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
}, 10, 2);
add_action('elementor/element/icon-list/section_text_style/after_section_start', function ($element, $args) {

    $element->add_responsive_control(
        'text_align',
        [
            'label' => esc_html__('Text Alignment', 'fbth'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => esc_html__('Left', 'fbth'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'fbth'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => esc_html__('Right', 'fbth'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'left',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} span.elementor-icon-list-text' => 'text-align: {{VALUE}};',
            ],
        ]
    );

    $element->add_responsive_control(
        'text_width',
        [
            'label' => esc_html__('Text Width', 'elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
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
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'selectors' => [
                '{{WRAPPER}} span.elementor-icon-list-text' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $element->add_responsive_control(
        'fbth_icon_list_margin',
        [
            'label'      => __('Margin', 'fbth'),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-icon-list-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
}, 10, 2);
// social icon
add_action('elementor/element/social-icons/section_social_style/after_section_start', function ($element, $args) {
    $element->add_responsive_control(
        'fbth_icon_font_size',
        [
            'label'     => esc_html__('Icon Size', 'elementor'),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 6,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon i'   => 'font-size: {{SIZE}}{{UNIT}}',
                '{{WRAPPER}} .elementor-icon svg' => 'width: {{SIZE}}{{UNIT}}',
            ],
        ]
    );
}, 10, 2);

function fbth_stickyregister_controls($element, $args)
{
    $element->add_control(
        'fbth_sticky',
        [
            'label'              => __('Sticky', 'fbth'),
            'type'               => \Elementor\Controls_Manager::SELECT,
            'options'            => [
                'yes' => __('Yes', 'fbth'),
                'no'  => __('No', 'fbth'),
            ],
            'default'            => 'no',
            'separator'          => 'before',
            'prefix_class'       => 'FBTH-addons-sticky-',
            'frontend_available' => true,
            'render_type'        => 'template',
        ]
    );
}
add_action('elementor/element/section/section_effects/after_section_start', 'fbth_stickyregister_controls', 10, 2);
add_action('elementor/element/common/section_effects/after_section_start', 'fbth_stickyregister_controls', 10, 2);
add_action('elementor/element/before_section_end', function ($element, $section_id, $args) {
    /** @var \Elementor\Element_Base $element */
    if ('section_shape_divider' === $section_id) {
        $element->add_control(
            'fbth_animation_on',
            [
                'label'              => __('Animation', 'fbth'),
                'type'               => \Elementor\Controls_Manager::SELECT,
                'options'            => [
                    'no'              => __('None', 'fbth'),
                    'animation-one'   => __('Animation-one', 'fbth'),
                    'animation-two'   => __('Animation-two', 'fbth'),
                    'animation-three' => __('Animation-three', 'fbth'),
                ],
                'default'            => 'no',
                'separator'          => 'before',
                'prefix_class'       => 'fbth-custom-animation-',
                'frontend_available' => true,
                'render_type'        => 'template',
            ]
        );
    }
}, 10, 3);


// Text editor
add_action('elementor/element/text-editor/section_editor/before_section_end', function ($element, $args) {

    $element->add_control(
        'size',
        [
            'label' => esc_html__('Size', 'fbth'),
            'type' => Elementor\Controls_Manager::SELECT,
            'default' => 'default',
            'options' => [
                'default' => esc_html__('Default', 'fbth'),
                'small' => esc_html__('Small', 'fbth'),
                'medium' => esc_html__('Medium', 'fbth'),
                'large' => esc_html__('Large', 'fbth'),
                'xl' => esc_html__('XL', 'fbth'),
                'xxl' => esc_html__('XXL', 'fbth'),
            ],
            'prefix_class'       => 'fbth-size-',
        ]
    );
}, 10, 2);




// Extra Option for Skill bar percentage

add_action('elementor/element/progress/section_title/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'fbth_section_extra',
        [
            'label' => __('Percentage Position', 'fbth'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $element->add_responsive_control(
        'percentage_addons_position_type',
        array(
            'label' => __('Position Type', 'fbth'),
            'label_block' => true,
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => array(
                '' => __('Default', 'fbth'),
                'static' => __('Static', 'fbth'),
                'relative' => __('Relative', 'fbth'),
                'absolute' => __('Absolute', 'fbth'),
            ),
            'default' => '',
            'selectors' => array(
                '{{WRAPPER}} span.elementor-progress-percentage' => 'position:{{VALUE}};',
            ),
        )
    );
    $element->add_responsive_control(
        'percentage_addons_position_top',
        array(
            'label' => __('Top', 'fbth'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => array('px', 'em', '%'),
            'range' => array(
                'px' => array(
                    'min' => -2000,
                    'max' => 2000,
                    'step' => 1,
                ),
                '%' => array(
                    'min' => -100,
                    'max' => 100,
                    'step' => 1,
                ),
                'em' => array(
                    'min' => -150,
                    'max' => 150,
                    'step' => 1,
                ),
            ),
            'selectors' => array(
                '{{WRAPPER}} span.elementor-progress-percentage' => 'top:{{SIZE}}{{UNIT}};',
            ),
            'condition' => array(
                'percentage_addons_position_type' => array('relative', 'absolute'),
            ),
        )
    );
    $element->add_responsive_control(
        'percentage_addons_position_right',
        array(
            'label' => __('Right', 'fbth'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => array('px', 'em', '%'),
            'range' => array(
                'px' => array(
                    'min' => -2000,
                    'max' => 2000,
                    'step' => 1,
                ),
                '%' => array(
                    'min' => -100,
                    'max' => 100,
                    'step' => 1,
                ),
                'em' => array(
                    'min' => -150,
                    'max' => 150,
                    'step' => 1,
                ),
            ),
            'selectors' => array(
                '{{WRAPPER}} span.elementor-progress-percentage' => 'right:{{SIZE}}{{UNIT}};',
            ),
            'condition' => array(
                'percentage_addons_position_type' => array('relative', 'absolute'),
            ),
            'return_value' => '',
        )
    );
    $element->add_responsive_control(
        'percentage_addons_position_bottom',
        array(
            'label' => __('Bottom', 'fbth'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => array('px', 'em', '%'),
            'range' => array(
                'px' => array(
                    'min' => -2000,
                    'max' => 2000,
                    'step' => 1,
                ),
                '%' => array(
                    'min' => -100,
                    'max' => 100,
                    'step' => 1,
                ),
                'em' => array(
                    'min' => -150,
                    'max' => 150,
                    'step' => 1,
                ),
            ),
            'selectors' => array(
                '{{WRAPPER}} span.elementor-progress-percentage' => 'bottom:{{SIZE}}{{UNIT}};',
            ),
            'condition' => array(
                'percentage_addons_position_type' => array('relative', 'absolute'),
            ),
        )
    );
    $element->add_responsive_control(
        'percentage_addons_position_left',
        array(
            'label' => __('Left', 'fbth'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => array('px', 'em', '%'),
            'range' => array(
                'px' => array(
                    'min' => -2000,
                    'max' => 2000,
                    'step' => 1,
                ),
                '%' => array(
                    'min' => -100,
                    'max' => 100,
                    'step' => 1,
                ),
                'em' => array(
                    'min' => -150,
                    'max' => 150,
                    'step' => 1,
                ),
            ),
            'selectors' => array(
                '{{WRAPPER}} span.elementor-progress-percentage' => 'left:{{SIZE}}{{UNIT}};',
            ),
            'condition' => array(
                'percentage_addons_position_type' => array('relative', 'absolute'),
            ),
        )
    );
    $element->add_responsive_control(
        'percentage_addons_position_from_center',
        array(
            'label' => __('From Center', 'fbth'),
            'description' => __('Please avoid using "From Center" and "Left" options at the same time.', 'fbth'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => array('px', 'em', '%'),
            'range' => array(
                'px' => array(
                    'min' => -1000,
                    'max' => 1000,
                    'step' => 1,
                ),
                '%' => array(
                    'min' => -100,
                    'max' => 100,
                    'step' => 1,
                ),
                'em' => array(
                    'min' => -150,
                    'max' => 150,
                    'step' => 1,
                ),
            ),
            'selectors' => array(
                '{{WRAPPER}} span.elementor-progress-percentage' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
            ),
            'condition' => array(
                'percentage_addons_position_type' => array('relative', 'absolute'),
            ),
        )
    );

    $element->end_controls_section();
}, 10, 2);
