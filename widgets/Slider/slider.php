<?php

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class FbthSlider extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'slider';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Slider', 'fbth-hp');
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-slides';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['fbth'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Slider', 'fbth'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control('per_line', [
            'label'              => __('Columns', 'fbth'),
            'type'               => \Elementor\Controls_Manager::SELECT,
            'default'            => '4',
            'tablet_default'     => '6',
            'mobile_default'     => '12',
            'options'            => [
                '12' => '1 Column',
                '6'  => '2 Column',
                '4'  => '3 Column',
                '3'  => '4 Column',
                '8'  => '8 Column',
                '10'  => '10 Column',
                
                
            ],
            'frontend_available' => true,
        ]);
        $this->add_responsive_control(
            'gap_right',
            [
                'label'          => __('Gap Right', 'fbth-addons'),
                'type'           => \Elementor\Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .fbth-addons-post-widget-wrap' => 'padding: 0 {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .row' => 'margin-right: -{{SIZE}}{{UNIT}};margin-left: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'gap_bottom',
            [
                'label'          => __('Gap Bottom', 'fbth-addons'),
                'type'           => \Elementor\Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .fbth-addons-post-widget-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-addons-blog-wraper' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'row_box_align',
            [
                'label' => __('Row Alignment', 'fbth'),
                'type' =>  \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => __('Left', 'fbth'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'fbth'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => __('Right', 'fbth'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-content-row' => 'justify-content: {{VALUE}} !important;',
                ],
            ]
        );
        


        $slider = new \Elementor\Repeater();

        $slider->add_responsive_control(
            'slider_image',
            [
                'label' => __('Choose Slider Image', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $slider->add_control(
            'show_first_title',
            [
                'label' => __('Show First Title', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fbth-addons'),
                'label_off' => __('Hide', 'fbth-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $slider->add_control(
            'slider_title_one',
            [
                'label' => __('First Title', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Slider First Title', 'fbth-addons'),
                'label_block' => true,
                'condition' => [
                    'show_first_title' => 'yes'
                ]
            ]
        );
        $slider->add_control(
            'slider_title',
            [
                'label' => __('Title', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Slider Title', 'fbth-addons'),
                'label_block' => true,
            ]
        );

        $slider->add_control(
            'slider_content',
            [
                'label' => __('Slider Content', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Slider Content', 'fbth-addons'),
                'show_label' => false,
            ]
        );

        $slider->add_control(
            'show_btn',
            [
                'label' => __('Show Button', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fbth-addons'),
                'label_off' => __('Hide', 'fbth-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $slider->add_control(
            'btn_text',
            [
                'label' => __('Button Text', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Contact Us', 'fbth-addons'),
                'label_block' => true,
                'condition' => [
                    'show_btn' => 'yes'
                ]
            ]

        );

        $slider->add_control(
            'btn_link',
            [
                'label' => __('Button Url', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'fbth-addons'),
                'show_external' => true,
                'condition' => [
                    'show_btn' => 'yes'
                ]
            ]
        );

        $slider->add_control(
            'btn_icon',
            [
                'label' => __('Button Icon', 'text-domain'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-angle-right',
                    'library' => 'solid',
                ],
                'condition' => [
                    'show_btn' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => __('Repeater List', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $slider->get_controls(),
                'default' => [
                    [
                        'slider_one' => __('Title First', 'fbth-addons'),
                        'slider_title' => __('Title #1', 'fbth-addons'),
                        'slider_content' => __('Item content. Click the edit button to change this text.', 'fbth-addons'),
                    ],
                    [
                        'slider_one' => __('Title Second', 'fbth-addons'),
                        'slider_title' => __('Title #2', 'fbth-addons'),
                        'slider_content' => __('Item content. Click the edit button to change this text.', 'fbth-addons'),
                    ],
                ],
                'title_field' => '{{{ slider_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'slider_navigation',
            [
                'label' => __('Slider Settings', 'fbth'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'slider_loop',
            [
                'label' => __('Slider Loop', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('True', 'fbth-addons'),
                'label_off' => __('False', 'fbth-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('True', 'fbth-addons'),
                'label_off' => __('False', 'fbth-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'autoplaytimeouts',
            [
                'label' => esc_html__('Speeds', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 100000,
                        'step' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '',
                    'size' => 2000,
                ],
                'condition' => [
                    'autoplay' => 'yes',
                ],

            ]
        );

        $this->add_control(
            'mousedrag',
            [
                'label' => __('MouseDrag', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('True', 'fbth-addons'),
                'label_off' => __('False', 'fbth-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        
        $this->add_control(
            'active_nav',
            [
                'label' => __('Slider Nav', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('True', 'fbth-addons'),
                'label_off' => __('False', 'fbth-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'next_icon',
            [
                'label' => __('Next Icon', 'text-domain'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-angle-right',
                    'library' => 'solid',
                ],
                'condition' => [
                    'active_nav' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'prev_icon',
            [
                'label' => __('Prev Icon', 'text-domain'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-angle-left',
                    'library' => 'solid',
                ],
                'condition' => [
                    'active_nav' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'active_dots',
            [
                'label' => __('Slider Dots', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('True', 'fbth-addons'),
                'label_off' => __('False', 'fbth-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        /*Style Tab section start */

        //Background Style

        $this->start_controls_section(
            'bg_style',
            [
                'label' => __('Slider Background', 'fbth'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_bg',
                'label' => __('Background', 'fbth-addons'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .fbth-slider-single-item:after',
            ]
        );

        $this->add_responsive_control(
            'bg_after_radius',
            [
                'label' => __('Bg after Radius', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-single-item:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        //Background Style end





        $this->start_controls_section(
            'wrapper_style',
            [
                'label' => __('Slider Wrapper', 'fbth'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );



        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label' => __('Slider Wrapper Padding', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label' => __('Slider wrapper Margin', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'bg_wrapper_radius',
            [
                'label' => __('Wrapper bg Radius', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-single-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'align_arrow',
            [
                'label' => __('Alignment', 'fbth'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .fbth-slider-single-item' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();





        /*Style Heading section start */

        $this->start_controls_section(
            'heading_style',
            [
                'label' => __('Slider Heading', 'fbth'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );



        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' => __('Heading', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-slider-content h4',
            ]
        );
        $this->add_control(
            'heading_color',
            [
                'label' => __('Heading Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-content h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_padding',
            [
                'label' => __('Heading Padding', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-content h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'heading_margin',
            [
                'label' => __('Heading Margin', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography_2',
                'label' => __('Heading Two', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-slider-content h6',
            ]
        );
        $this->add_control(
            'heading_color_2',
            [
                'label' => __('Heading Two Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-content h6' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_padding_2',
            [
                'label' => __('Heading Two Padding', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-content h6' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'heading_margin_2',
            [
                'label' => __('Heading Two Margin', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-content h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );




        $this->end_controls_section();

        /*Style Heading section end */



        /*Style Content section start */

        $this->start_controls_section(
            'content_style',
            [
                'label' => __('Slider Content', 'fbth'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );



        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __('Content', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-slider-content p',
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label' => __('Content Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-content p' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Content Padding', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_margin',
            [
                'label' => __('Content Margin', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );



        $this->end_controls_section();

        /*Style Content section end */




        /*Style Button section start */

        $this->start_controls_section(
            'btn_style',
            [
                'label' => __('Button', 'fbth'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,

            ]
        );

        $this->start_controls_tabs(
            'btn_tabs'
        );

        /*Normal Tab part */

        $this->start_controls_tab(
            'btn_normal_tab',
            [
                'label' => __('Normal', 'plugin-name'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'label' => __('Button Typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-slider-btn',
            ]
        );

        $this->add_control(
            'btn_color',
            [
                'label' => __('Button Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_bg',
            [
                'label' => __('Button BG Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-btn' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_width',
            [
                'label' => __('Button Width', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,

                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'btn_height',
            [
                'label' => __('Button Height', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,

                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-btn' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_padding',
            [
                'label' => __('Button Padding', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_margin',
            [
                'label' => __('Button Margin', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'btn_radius',
            [
                'label' => __('Button Radius', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        /*Normal Tab part End*/


        /*Hover Tab part */

        $this->start_controls_tab(
            'btn_hover_tab',
            [
                'label' => __('Hover', 'plugin-name'),
            ]
        );
        $this->add_control(
            'btn_hover_color',
            [
                'label' => __('Button Text Hover Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_hover',
            [
                'label' => __('Button Hover BG Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-btn:hover' => 'background: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_tab();

        /*Hover Tab part End*/

        $this->end_controls_tabs();

        /*Button Tab main part End*/



        $this->end_controls_section();

        /*Style Button section end */



        /*Style Icon section start */

        $this->start_controls_section(
            'icon_style',
            [
                'label' => __('Button Icon', 'fbth'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,

            ]
        );

        /*Icon normal & hover tab section start */

        $this->start_controls_tabs(
            'item_tabs'
        );

        /*Normal Tab part */

        $this->start_controls_tab(
            'icon_normal_tab',
            [
                'label' => __('Normal', 'plugin-name'),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-btn i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => __('Icon Margin', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-btn i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-slider-btn svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );




        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'icon_typography',
                'label' => __('Icon Typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-slider-btn i',
            ]
        );



        $this->end_controls_tab();



        /*Normal Tab part End*/


        /*Hover Tab part */

        $this->start_controls_tab(
            'icon_hover_tab',
            [
                'label' => __('Hover', 'plugin-name'),
            ]
        );


        $this->add_control(
            'icon_hover_color',
            [
                'label' => __('Icon Hover Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-btn:hover i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fbth-slider-btn:hover svg path' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .fbth-slider-btn:hover svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_tab();

        /*Hover Tab part End*/



        $this->end_controls_tabs();

        /* Icon normal  & hover main tab end */

        $this->end_controls_section();

        /*Style Icon section end */



        /*Style Tab section End */




        /*Style Slider nav image section start */

        $this->start_controls_section(
            'nav_style',
            [
                'label' => __('Slider Nav', 'fbth'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );



        $this->start_controls_tabs(
            'nav_tabs'
        );
        /*Normal Tab part */
        $this->start_controls_tab(
            'item_normal_tab',
            [
                'label' => __('Normal', 'plugin-name'),
            ]
        );



        $this->add_responsive_control(
            'left_position',
            [
                'label' => __('Slider Nav left position', 'fbth-addons'),
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
                    '{{WRAPPER}} .owl-nav .owl-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'right_position',
            [
                'label' => __('Slider Nav Right position', 'fbth-addons'),
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
                    '{{WRAPPER}} .owl-nav .owl-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'prev_bottom_position',
            [
                'label' => __('Slider Nav Prev Bottom position', 'fbth-addons'),
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
                    '{{WRAPPER}} .owl-nav .owl-next' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'next_bottom_position',
            [
                'label' => __('Slider Nav Next Bottom position', 'fbth-addons'),
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
                    '{{WRAPPER}} .owl-nav .owl-prev' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'nav_bg',
            [
                'label' => __('Nav Icon BG', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-wrap .owl-nav button' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'nav_margin',
            [
                'label' => __('Nav Margin', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-wrap .owl-nav button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_padding',
            [
                'label' => __('Nav Padding', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-wrap .owl-nav button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'nav_icon_color',
            [
                'label' => __('Nav Icon Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-wrap .owl-nav i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'slider_icon_width',
            [
                'label' => __('Slider icon Size', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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

                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-wrap .owl-nav i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'slider_btn_width',
            [
                'label' => __('Slider Nav Button Width', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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

                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-wrap .owl-nav button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slider_btn_height',
            [
                'label' => __('Slider Nav Button Height', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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

                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-wrap .owl-nav button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        /*Normal Tab part End*/

        /*Hover Tab part */
        $this->start_controls_tab(
            'nav_hover_tab',
            [
                'label' => __('Hover', 'plugin-name'),
            ]
        );

        $this->add_control(
            'nav_bg_hover',
            [
                'label' => __('Nav Icon BG Hover', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-wrap .owl-nav button:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hover_nav_icon_color',
            [
                'label' => __('Nav Icon Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-slider-wrap .owl-nav button:hover i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /*Hover Tab part End*/
        /*Active Tab part */
        $this->start_controls_tab(
            'nav_active_tab',
            [
                'label' => __('Active', 'plugin-name'),
            ]
        );
        $this->end_controls_tab();
        /*Active Tab part End*/





        $this->end_controls_tabs();


        $this->end_controls_section();

        /*Style Slider nav image section end */

        $this->start_controls_section(
            'dots_style',
            [
                'label' => __('Slider Dots', 'fbth'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'dot_tabs'
        );


        /*Normal Tab part */
        $this->start_controls_tab(
            'dot_normal_tab',
            [
                'label' => __('Normal', 'plugin-name'),
            ]
        );

        $this->add_control(
            'dot_bg',
            [
                'label' => __('Dot BG Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-dots span' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'dot_width',
            [
                'label' => __('Dot Width', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,

                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .owl-dots span' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'dot_height',
            [
                'label' => __('Dot Height', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,

                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .owl-dots span' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __('Dot Border', 'fbth-addons'),
                'selector' => '{{WRAPPER}} .owl-dots span',
            ]
        );
        $this->add_responsive_control(
            'dot_radius',
            [
                'label' => __('Dot Radius', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .owl-dots span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dot_margin',
            [
                'label' => __('Dot Margin', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .owl-dots span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dot_left_position',
            [
                'label' => __('Slider Dot left position', 'fbth-addons'),
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
                    '{{WRAPPER}} .owl-dots' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dot_bottom_position',
            [
                'label' => __('Slider Dots Bottom position', 'fbth-addons'),
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
                    '{{WRAPPER}} .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );



        $this->end_controls_tab();
        /*Normal Tab part End*/


        /*Hover Tab part */
        $this->start_controls_tab(
            'dot_hover_tab',
            [
                'label' => __('Hover', 'plugin-name'),
            ]
        );

        $this->add_control(
            'dot_hover_bg',
            [
                'label' => __('Dot Hover BG Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-dots span:hover' => 'background: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_tab();
        /*Hover Tab part End*/



        /*Active Tab part */
        $this->start_controls_tab(
            'dot_active_tab',
            [
                'label' => __('Active', 'plugin-name'),
            ]
        );
        $this->add_control(
            'dot_active_bg',
            [
                'label' => __('Dot Active BG Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-dots .active span' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        /*Active Tab part End*/
        $this->end_controls_tabs();


        $this->end_controls_section();
    }






    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $enable_loop = 'yes' == $settings['slider_loop'] ? true : false;
        $autoplay = 'yes' == $settings['autoplay'] ? true : false;
        $mousedrag = 'yes' == $settings['mousedrag'] ? true : false;
        $enable_nav = 'yes' == $settings['active_nav'] ? true : false;
        $enable_dots = 'yes' == $settings['active_dots'] ? true : false;

        $slider_settings = [

            'next_icon' => $this->get_render_icon($settings['next_icon']),
            'prev_icon' => $this->get_render_icon($settings['prev_icon']),
            'slider_loop' => $enable_loop,
            'active_nav' => $enable_nav,
            'active_dots' => $enable_dots,
            'autoplay' => $autoplay,
            'mousedrag' => $mousedrag,
            
        ];

        $this->add_render_attribute(
            'slider_settings',
            [
                'data-slider-setting' => json_encode($slider_settings),
            ]
        );
        //gride class
        $grid_classes = [];
        $grid_classes[] = 'col-xl-' . $settings['per_line'];
        $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
        $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
        $grid_classes = implode(' ', $grid_classes);
        $this->add_render_attribute('sl_classes', 'class', [$grid_classes, 'fbth-addons-post-widget-wrap']);


?>


        <div class="fbth-slider-wrap" <?php echo $this->get_render_attribute_string('slider_settings'); ?>>

            <div class="fbth-slider owl-carousel owl-theme">

                <?php

                if ($settings['slides']) :

                    foreach ($settings['slides'] as $slide) :

                ?>

                        <div class="fbth-slider-single-item" style="background-image: url(<?php echo esc_url($slide['slider_image']['url']) ?>);">

                            <div class="container">

                                <div class="row fbth-slider-content-row">

                                    <div <?php echo $this->get_render_attribute_string('sl_classes'); ?>>

                                        <div class="fbth-slider-content">
                                            <h6 class="animated fadeInUp"><?php echo esc_html($slide['slider_title_one']) ?></h6>
                                            <h4 class="animated fadeInUp"><?php echo esc_html($slide['slider_title']) ?></h4>
                                            <p class="animated fadeInUp"><?php echo esc_html($slide['slider_content']) ?></p>
                                            <?php

                                            $target = $slide['btn_link']['is_external'] ? ' target="_blank"' : '';
                                            $nofollow = $slide['btn_link']['nofollow'] ? ' rel="nofollow"' : '';


                                            if ('yes' == $slide['show_btn']) {

                                                printf(
                                                    '<a href="%s" %s class="fbth-slider-btn btn">
                                                    <span class="fbth-slider-btn-text">%s</span> %s </a>',
                                                    $slide['btn_link']['url'],
                                                    $target . $nofollow,
                                                    esc_html($slide['btn_text']),
                                                    $this->get_render_icon($slide['btn_icon']),
                                                    

                                                );
                                            }

                                            ?>

                                        </div>

                                    </div>


                                </div>

                            </div>

                        </div>

                <?php

                    endforeach;
                endif;

                ?>

            </div>

        </div>


<?php

    }



    protected function get_render_icon($icon)
    {
        ob_start();
        \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']);

        return ob_get_clean();
    }
}

$widgets_manager->register(new \FbthSlider());
