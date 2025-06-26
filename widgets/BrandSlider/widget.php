<?php

namespace FBTH_Addons\Widgets;



if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

use \Elementor\Widget_Base;



class Scalo_Brand_Carousel extends Widget_Base
{

    public function get_name()
    {

        return 'fbth-brand-carousel';
    }

    public function get_title()
    {

        return esc_html__('Brand Carousel', 'fbth');
    }

    public function get_icon()
    {

        return 'eicon-lock-user';
    }

    public function get_categories()
    {

        return ['fbth'];
    }

    public function get_keywords()
    {

        return ['brand', 'partners', 'carousel', 'logo', 'company'];
    }

    protected function register_controls()
    {
        $this->genarel_section_info();
        $this->genarel_section_settings();
        $this->brand_section_style_image();
        $this->brand_arrows_navigation();
        $this->brand_dots_navigation();
    }

    /**
     * @Annotation genarel_section_info
     */
    protected function genarel_section_info()
    {
        $this->start_controls_section(
            'genarel_section_info',
            [
                'label' => __('Genarel', 'fbth'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs('_tab_brands');
        

        $repeater->add_control(
            'image',
            [
                'label' => __('Photo', 'fbth'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ image }}}',
                'default' => [
                    [
                        'image' => __('Brand Image', 'fbth'),
                    ]
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Undocumented genarel_section_settings
     *
     * @return void
     */
    protected function genarel_section_settings()
    {
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __('Settings', 'fbth'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay?', 'fbth'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'fbth'),
                'label_off' => __('No', 'fbth'),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __('Autoplay Speed', 'fbth'),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'step' => 100,
                'max' => 10000,
                'default' => 2000,
                'description' => __('Autoplay speed in milliseconds', 'fbth'),
                'condition' => [
                    'autoplay' => 'yes'
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __('Infinite Loop?', 'fbth'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'fbth'),
                'label_off' => __('No', 'fbth'),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'center',
            [
                'label' => __('Center Mode?', 'fbth'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'fbth'),
                'label_off' => __('No', 'fbth'),
                'return_value' => 'yes',
                'description' => __('Best works with odd number of slides (Slides To Show) and loop (Infinite Loop)', 'fbth'),
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => __('Enable Navigation', 'fbth'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'fbth'),
                'label_off' => __('No', 'fbth'),
                'return_value' => 'yes',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'dots',
            [
                'label' => __('Enable Dots', 'fbth'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'fbth'),
                'label_off' => __('No', 'fbth'),
                'return_value' => 'yes',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        $this->add_responsive_control(
            'per_coulmn',
            [
                'label' => __('Slider Items', 'fbth'),
                'type' => Controls_Manager::SELECT,
                'default'            => 6,
                'tablet_default'     => 4,
                'mobile_default'     => 2,
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                ],
                'frontend_available' => true,
            ]
        );
        $this->add_control(
            'arrow_prev_icon',
            [
                'label' => __('Previous Icon', 'brand'),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'navigation' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'arrow_next_icon',
            [
                'label' => __('Next Icon', 'brand'),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'navigation' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Undocumented function
     *brand_section_style_image
     * @return void
     */
    protected function brand_section_style_image()
    {
        $this->start_controls_section(
            'brand_section_style_image',
            [
                'label' => __('Image', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'slider_image_display_style',
            [
                'label' => esc_html__('Display', 'fbth'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'block'  => esc_html__('Block', 'fbth'),
                    'inline-block' => esc_html__('Inline-block', 'fbth'),
                    'flex' => esc_html__('Flex', 'fbth'),
                    'none' => esc_html__('None', 'fbth'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-brand-figure img' => 'display: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'image_width',
            [
                'label' => __('Width', 'fbth'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    '%' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 100,
                        'max' => 700,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-brand-figure' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label' => __('Height', 'fbth'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 700,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-brand-figure' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_spacing',
            [
                'label' => __('Bottom Spacing', 'fbth'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-brand-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label' => __('Padding', 'fbth'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-brand-figure > img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .fbth-brand-figure > img'
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => __('Border Radius', 'fbth'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-brand-figure > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .fbth-brand-figure > img'
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function brand_arrows_navigation()
    {
        $this->start_controls_section(
            'arrows_navigation',
            [
                'label' => __('Navigation - Arrow', 'fbth'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'navigation' => 'yes',
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
                    '{{WRAPPER}} .brand-slider-arrow button' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}}  button svg path' => 'stroke: {{VALUE}};',
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
                    '{{WRAPPER}}  button' => 'color: {{VALUE}};',
                    '{{WRAPPER}}  button svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label' => __('Background Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  button' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'arrow_shadow',
                'label' => __('Shadow', 'fbth'),
                'selector' => '{{WRAPPER}}  button ',
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
                    '{{WRAPPER}} ' => '{{VALUE}}: 0;',
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
                    '{{WRAPPER}} .brand-slider-arrow .prev' => 'top: {{SIZE}}{{UNIT}}; bottom:auto',
                    '{{WRAPPER}} .brand-slider-arrow .next' => 'top: {{SIZE}}{{UNIT}}; bottom:auto',
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
                    '{{WRAPPER}} .brand-slider-arrow .prev' => 'bottom: {{SIZE}}{{UNIT}} !important; top:auto',
                    '{{WRAPPER}} .brand-slider-arrow .next' => 'bottom: {{SIZE}}{{UNIT}} !important; top:auto',
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
                'label' => __('Horizontal Prev', 'happy-elementor-addons'),
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
                    '{{WRAPPER}}   .prev' => 'left: {{SIZE}}{{UNIT}}; right: auto !important;',
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
                'label' => __('Horizontal Next', 'happy-elementor-addons'),
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
                    '{{WRAPPER}} .brand-slider-arrow .next' => 'right: {{SIZE}}{{UNIT}} !important; left: auto !important;',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'space_between',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_gap_',
            [
                'label' => __('Arrow Gap', 'happy-elementor-addons'),
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
                    '{{WRAPPER}} .brand-slider-arrow .prev' => 'margin-right: {{SIZE}}{{UNIT}} !important; position: relative !important',
                    '{{WRAPPER}} .brand-slider-arrow .next ' => 'margin-right: 0 !important; position: relative !important',
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
                    '{{WRAPPER}} .brand-slider-arrow' => 'text-align: {{VALUE}};',
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
                    '{{WRAPPER}}  .brand-slider-arrow button i' => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}  .brand-slider-arrow button svg' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_size_box',
            [
                'label' => __('Box Size', 'fbth'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .brand-slider-arrow button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
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
                    '{{WRAPPER}} .brand-slider-arrow button' => 'line-height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]

        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_border',
                'label'    => __('Button border', 'fbth'),
                'selector' => '{{WRAPPER}} .brand-slider-arrow button',
            ]
        );

        $this->add_responsive_control(
            'arrows_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .brand-slider-arrow button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .brand-slider-arrow button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .brand-slider-arrow button:hover ' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .brand-slider-arrow button:hover svg path ' => 'stroke: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_fill_color',
            [
                'label' => __('Line Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .brand-slider-arrow button:hover ' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .brand-slider-arrow button:hover path' => 'fill: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_hover_color',
            [
                'label' => __('Background Color Hover', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .brand-slider-arrow button:hover ' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_hover_border',
                'label'    => __('Button border', 'fbth'),
                'selector' => '{{WRAPPER}} .brand-slider-arrow button:hover',
            ]
        );

        $this->add_responsive_control(
            'arrows_hover_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .brand-slider-arrow button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .brand-slider-arrow button:hover ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .brand-slider-arrow .slick-active' => 'color: {{VALUE}} !important;;',
                    '{{WRAPPER}} .brand-slider-arrow .slick-active svg path' => 'stroke: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_control(
            'arrow_active_fill_color',
            [
                'label' => __('Line Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .brand-slider-arrow .slick-active' => 'color: {{VALUE}} !important;;',
                    '{{WRAPPER}} .brand-slider-arrow .slick-active path' => 'fill: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_active_color',
            [
                'label' => __('Background Color Hover', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .brand-slider-arrow .slick-active ' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_active_border',
                'label'    => __('Button border', 'fbth'),
                'selector' => '{{WRAPPER}} .brand-slider-arrow .slick-active button',
            ]
        );

        $this->add_responsive_control(
            'arrows_active_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .brand-slider-arrow .slick-active button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .brand-slider-arrow .slick-active button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    /**
     * Undocumented function
     *brand_dots_navigation
     * @return void
     */
    protected function brand_dots_navigation()
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
                    '{{WRAPPER}} ul.brand-slick-slide-dot-list li' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} ul.brand-slick-slide-dot-list' => 'justify-content: {{VALUE}};',
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
                    '{{WRAPPER}} ul.brand-slick-slide-dot-list li' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} ul.brand-slick-slide-dot-list li' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} ul.brand-slick-slide-dot-list li ' => 'margin-right: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} ul.brand-slick-slide-dot-list li ' => 'margin-left: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} ul.brand-slick-slide-dot-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} ul.brand-slick-slide-dot-list' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} ul.brand-slick-slide-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} ul.brand-slick-slide-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} ul.brand-slick-slide-dot-list li.slick-active' => 'background-color: {{VALUE}}  !important;',
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
                    '{{WRAPPER}} ul.brand-slick-slide-dot-list li.slick-active' => 'width: {{SIZE}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} ul.brand-slick-slide-dot-list li.slick-active' => 'height: {{SIZE}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .brand-slider-arrow button' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}} .brand-slider-arrow button svg path' => 'stroke: {{VALUE}};',
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
                    '{{WRAPPER}} .brand-slider-arrow button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .brand-slider-arrow button svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label' => __('Background Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .brand-slider-arrow button' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'arrow_shadow',
                'label' => __('Shadow', 'fbth'),
                'selector' => '{{WRAPPER}} .brand-slider-arrow button ',
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
                    '{{WRAPPER}} .brand-slider-arrow' => '{{VALUE}}: 0;',
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
                    '{{WRAPPER}} .brand-slider-arrow' => 'top: {{SIZE}}{{UNIT}}; bottom:auto',
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
                    '{{WRAPPER}} .brand-slider-arrow' => 'bottom: {{SIZE}}{{UNIT}} !important; top:auto',
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
                'label' => __('Horizontal Prev', 'happy-elementor-addons'),
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
                    '{{WRAPPER}}  .brand-slider-arrow .prev' => 'left: {{SIZE}}{{UNIT}}; right: auto !important;',
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
                'label' => __('Horizontal Next', 'happy-elementor-addons'),
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
                    '{{WRAPPER}} .brand-slider-arrow .next' => 'right: {{SIZE}}{{UNIT}} !important; left: auto !important;',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'space_between',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_gap_',
            [
                'label' => __('Arrow Gap', 'happy-elementor-addons'),
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
                    '{{WRAPPER}} .brand-slider-arrow .prev' => 'margin-right: {{SIZE}}{{UNIT}} !important; position: relative !important',
                    '{{WRAPPER}} .brand-slider-arrow .next ' => 'margin-right: 0 !important; position: relative !important',
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
                    '{{WRAPPER}} .brand-slider-arrow' => 'text-align: {{VALUE}};',
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
                    '{{WRAPPER}}  .brand-slider-arrow button i' => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}  .brand-slider-arrow button svg' => 'width: {{SIZE}}{{UNIT}}',
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
                    '{{WRAPPER}} .brand-slider-arrow button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
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
                    '{{WRAPPER}} .brand-slider-arrow button' => 'line-height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]

        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_border',
                'label'    => __('Button border', 'fbth'),
                'selector' => '{{WRAPPER}} .brand-slider-arrow button',
            ]
        );

        $this->add_responsive_control(
            'arrows_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .brand-slider-arrow button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .brand-slider-arrow button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .brand-slider-arrow button:hover ' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .brand-slider-arrow button:hover svg path ' => 'stroke: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_fill_color',
            [
                'label' => __('Line Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .brand-slider-arrow button:hover ' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .brand-slider-arrow button:hover path' => 'fill: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_hover_color',
            [
                'label' => __('Background Color Hover', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .brand-slider-arrow button:hover ' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_hover_border',
                'label'    => __('Button border', 'fbth'),
                'selector' => '{{WRAPPER}} .brand-slider-arrow button:hover',
            ]
        );

        $this->add_responsive_control(
            'arrows_hover_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .brand-slider-arrow button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .brand-slider-arrow button:hover ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .brand-slider-arrow .slick-active' => 'color: {{VALUE}} !important;;',
                    '{{WRAPPER}} .brand-slider-arrow .slick-active svg path' => 'stroke: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_control(
            'arrow_active_fill_color',
            [
                'label' => __('Line Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .brand-slider-arrow .slick-active' => 'color: {{VALUE}} !important;;',
                    '{{WRAPPER}} .brand-slider-arrow .slick-active path' => 'fill: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_active_color',
            [
                'label' => __('Background Color Hover', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .brand-slider-arrow .slick-active ' => 'background-color: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_active_border',
                'label'    => __('Button border', 'fbth'),
                'selector' => '{{WRAPPER}} .brand-slider-arrow .slick-active button',
            ]
        );

        $this->add_responsive_control(
            'arrows_active_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .brand-slider-arrow .slick-active button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .brand-slider-arrow .slick-active button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .scalo-addons-post-widget-wrap' => 'padding-right: {{SIZE}}{{UNIT}}; padding-left: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .scalo-addons-post-widget-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-testimonial' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $slider_extraSetting = array(

            'loop' => (!empty($settings['loop']) && 'yes' === $settings['loop']) ? true : false,
            'dots' => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,
            'center' => (!empty($settings['center']) && 'yes' === $settings['center']) ? true : false,
            'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
            'navigation' => (!empty($settings['navigation']) && 'yes' === $settings['navigation']) ? true : false,
            'mousedrag' => (!empty($settings['mousedrag']) && 'yes' === $settings['mousedrag']) ? true : false,
            'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',

            //this a responsive layout
            'per_coulmn' => (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 6,
            'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 4,
            'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 2
        );

        $jasondecode = wp_json_encode($slider_extraSetting);
        $this->add_render_attribute('brand_version', 'class', 'fbth-brand-carousel-wrap');
        $this->add_render_attribute('brand_version', 'data-settings', $jasondecode);
        if (!is_array($settings['list'])) {
            return;
        }

?>

        <div <?php echo $this->get_render_attribute_string('brand_version'); ?>>

            <?php foreach ($settings['list'] as $index => $brand) :



            ?>
                <div class="brand-slick-slide">
                    <div class="fbth-brand-carousel-item">

                        <?php if ($brand['image']) : ?>
                            <div class="fbth-brand-figure">
                                <?php echo '<img src="' . $brand['image']['url'] . '">'; ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php
            endforeach;
            ?>
        </div>
        <?php if ('yes' == $settings['navigation']) : ?>
            <div class="brand-slider-arrow">
                <?php if (!empty($settings['arrow_prev_icon']['value'])) : ?>
                    <button type="button" class="brand-slick-prev prev slick-arrow slick-active">
                        <?php \Elementor\Icons_Manager::render_icon($settings['arrow_next_icon'], ['aria-hidden' => 'true']); ?>
                    </button>
                <?php endif; ?>
                <?php if (!empty($settings['arrow_next_icon']['value'])) : ?>
                    <button type="button" class="brand-slick-next next slick-arrow ">
                        <?php \Elementor\Icons_Manager::render_icon($settings['arrow_prev_icon'], ['aria-hidden' => 'true']); ?>
                    </button>
                <?php endif; ?>

            </div>
        <?php endif; ?>
<?php
    }
}

$widgets_manager->register(new \FBTH_Addons\Widgets\Scalo_Brand_Carousel());
