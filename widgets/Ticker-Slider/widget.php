<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use Elementor\Widget_Base;
use Elementor\Group_Control_Background;

/**
 * Finest marquee text widget.
 *
 * Finest widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class Ticker_Slider extends Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve marquee text widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'ticker-item-slider';
    }
    /**
     * Get widget text.
     *
     * Retrieve marquee text widget text.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget text.
     */
    public function get_title()
    {
        return __('Ticker Slider', 'fbth-addons');
    }
    /**
     * Get widget icon.
     *
     * Retrieve marquee text widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-t-letter';
    }
    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the marquee text widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @since 2.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['fbth'];
    }
    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return ['ticker', 'ticker-slider', 'text', 'text'];
    }
    /**
     * Register marquee text widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        /**
         * section Tab
         */
        $this->section_slider_items();
        $this->slider_section_settings();
        /**
         * Style tab
         */
        $this->ticker_slider_image_style();
        $this->slider_designation_style();
        $this->slider_title_style();
        $this->slider_description_style();
        $this->ticker_slider_box_style();
    }

    /**
     * Summary of section_set_logo
     * @return void
     */
    protected function section_slider_items()
    {
        $this->start_controls_section(
            'section_set_logo',
            [
                'label' => __('Items', 'fbth-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,

            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'item_image',
            [
                'label' => esc_html__('Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'show_content',
            [
                'label' => esc_html__('Show Content', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'textdomain'),
                'label_off' => esc_html__('Hide', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'item_title',
            [
                'label' => esc_html__('Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Ella Simon', 'textdomain'),
                'condition' => [
                    'show_content' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tm_designation',
            [
                'label' => esc_html__('Designation', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Travel Vlogger', 'textdomain'),
                'condition' => [
                    'show_content' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'item_description',
            [
                'label' => esc_html__('Description', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Our visual designer lets you quickly an of drag and drop your own way to custom apps for both.'),
                'condition' => [
                    'show_content' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'item_list',
            [
                'label' => esc_html__('Item List', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_title' => esc_html__('Ella Simon', 'plugin-name'),
                        'tm_designation' => esc_html__('Travel Vlogger', 'plugin-name'),
                        'item_description' => esc_html__('Our visual designer lets you quickly an of drag and drop your own way to custom apps for both', 'plugin-name'),
                    ],
                ],
                'title_field' => '{{{ item_title }}}',
            ]
        );
        $this->end_controls_section();
    }


    /**
     * Summary of slider_section_settings
     * @return void
     */
    protected function slider_section_settings()
    {
        $this->start_controls_section(
            'slider_section_settings',
            [
                'label' => __('Slider Settings', 'fbth-addons'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'slider_item_gap',
            [
                'label' => esc_html__('Item Gap', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],

                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ticker-slider-item.slick-slide' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left:{{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'per_coulmn',
            [
                'label' => __('Slider Items', 'fbth-addons'),
                'type' => Controls_Manager::SELECT,
                'default'            => 2,
                'tablet_default'     => 2,
                'mobile_default'     => 1,
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
                    'size' => 1000,
                ],

            ]
        );

        $this->add_control(
            'show_rtl',
            [
                'label' => __('Rtl?', 'fbth-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'fbth-addons'),
                'label_off' => __('No', 'fbth-addons'),
                'return_value' => 'yes',
                'default' => 'no',
                'frontend_available' => true,
            ]
        );
        $this->add_control(
            'pause_on_hover',
            [
                'label' => __('Pause On Hover ?', 'fbth-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'fbth-addons'),
                'label_off' => __('No', 'fbth-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );
        $this->add_control(
            'vertical',
            [
                'label' => __('Vertical Mode?', 'fbth-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'fbth-addons'),
                'label_off' => __('No', 'fbth-addons'),
                'return_value' => 'yes',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        $this->end_controls_section();
    }

    /**
     * Summary of set_logo_style
     * @return void
     */
    protected function ticker_slider_image_style()
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

                ],
                'selectors'      => [
                    '{{WRAPPER}} .ticker-slider-img img' => 'width: {{SIZE}}{{UNIT}}',
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
                    '{{WRAPPER}} .ticker-slider-img img' => 'height: {{SIZE}}{{UNIT}}',
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
                    '{{WRAPPER}} .ticker-slider-img img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ticker-slider-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',

                ],
            ]
        );

        $this->add_responsive_control(
            'image_main_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ticker-slider-item .ticker-slider-img img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'show_img_box',
            [
                'label' => esc_html__('Show Image Box', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'textdomain'),
                'label_off' => esc_html__('Hide', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'img_box_options',
            [
                'label' => esc_html__('Image Box', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_img_box' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'img_bg_color',
            [
                'label' => esc_html__('Background Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ticker-slider-item .ticker-slider-img' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'show_img_box' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'box_width',
            [
                'label'          => __('Box Width', 'fbth'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'size_units'     => ['px', '%'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],

                ],
                'selectors'      => [
                    '{{WRAPPER}} .ticker-slider-item .ticker-slider-img' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'show_img_box' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'box_height',
            [
                'label'          => __('Height', 'fbth'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],

                'size_units'     => ['px', '%'],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .ticker-slider-item .ticker-slider-img' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'show_img_box' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'box_image_border',
                'selector'  => '{{WRAPPER}} .ticker-slider-item .ticker-slider-img',
                'separator' => 'before',
                'condition' => [
                    'show_img_box' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'image_box_radius',
            [
                'label'      => __('Box Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ticker-slider-item .ticker-slider-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'show_img_box' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'image_box_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ticker-slider-item .ticker-slider-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_img_box' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .ticker-slider-item .ticker-slider-img',
                'condition' => [
                    'show_img_box' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
    }

    /**
     * slider_title_style
     */
    protected function slider_title_style()
    {
        $this->start_controls_section(
            'tn_name',
            [
                'label' => __('Title', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'name_color',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ticker-slider-title h6' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tn_name_typo',
                'label'    => __('Typography', 'fbth'),
                'selector' => '{{WRAPPER}} .ticker-slider-title h6',
            ]
        );
        $this->add_responsive_control(
            'name_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .ticker-slider-title h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );
        $this->end_controls_section();
    }


    protected function slider_designation_style()
    {
        $this->start_controls_section(
            'tn_designation',
            [
                'label' => __('Designation', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'designation_color',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-slider-designation p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tn_designation_typo',
                'label'    => __('Typography', 'fbth'),
                'selector' => '{{WRAPPER}} .tm-slider-designation p',
            ]
        );

        $this->add_responsive_control(
            'designation_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .tm-slider-designation p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );
        $this->end_controls_section();
    }

    /**
     * slider_description_style
     *
     * @return void
     */
    protected function slider_description_style()
    {
        $this->start_controls_section(
            'description',
            [
                'label' => __('Description', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );
        $this->add_control(
            'dis_color',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ticker-slider-description p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dis_typo',
                'label'    => __('Typography', 'fbth'),
                'selector' => '{{WRAPPER}} .ticker-slider-description p',
            ]
        );

        $this->add_responsive_control(
            'dis_padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ticker-slider-description p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Summary of ticker_slider_box_style
     * @return void
     */
    protected function ticker_slider_box_style()
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
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .ticker-slider-item',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'tn_border',
                'selector'  => '{{WRAPPER}} .ticker-slider-item',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tn_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .ticker-slider-item',
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
                    '{{WRAPPER}} .ticker-slider-item' => 'text-align: {{VALUE}} !important;',
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
                    '{{WRAPPER}} .ticker-slider-item' => 'justify-content: {{VALUE}} !important;',
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
                    '{{WRAPPER}} .ticker-slider-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

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
                    '{{WRAPPER}} .ticker-slider-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

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
                'selector' => '{{WRAPPER}} .ticker-slider-item:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'tn_border_hover',
                'selector'  => '{{WRAPPER}} .ticker-slider-item:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tn_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .ticker-slider-item:hover',
            ]
        );
        $this->add_responsive_control(
            'border_radius_hover',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ticker-slider-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

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


        $slider_extraSetting = array(
            'vertical' => (!empty($settings['vertical']) && 'yes' === $settings['vertical']) ? true : false,
            'showrtl' => (!empty($settings['show_rtl']) && 'yes' === $settings['show_rtl']) ? true : false,
            'pauseonhover' => (!empty($settings['pause_on_hover']) && 'yes' === $settings['pause_on_hover']) ? true : false,
            'autoplaytimeout' => !empty($settings['autoplaytimeouts']['size']) ? $settings['autoplaytimeouts']['size'] : '1000',

            //this a responsive layout
            'per_coulmn' => (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 6,
            'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 4,
            'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 2
        );

        $jasondecode = wp_json_encode($slider_extraSetting);
        $this->add_render_attribute('ticker_item_slider', 'class', 'ticker-item-slider');
        $this->add_render_attribute('ticker_item_slider', 'data-settings', $jasondecode);

        // if (!is_array($settings['item_list'])) {
        //     return;
        // }
        if ($settings['item_list']) : ?>
            <div <?php echo $this->get_render_attribute_string('ticker_item_slider'); ?><?php echo 'yes' === $settings['show_rtl'] ? 'dir="rtl"' : '' ?>>
                <?php foreach ($settings['item_list'] as $item) { ?>
                    <div class="ticker-slider-item">
                        
                            <div class="ticker-slider-img">
                                <?php echo '<img src="' . esc_url($item['item_image']['url']) . '" alt="">'; ?>
                            </div>
                            <?php if ('yes' === $item['show_content']) { ?>
                                <div class="ticker-slider-content">
                                    <?php if ('' !== $item['item_title']) { ?>
                                        <div class="ticker-slider-title">
                                            <h6><?php echo esc_html($item['item_title']) ?></h6>
                                        </div>
                                    <?php } ?>


                                    <div class="tm-name-designation">
                                        <?php if ('' !== $item['tm_designation']) { ?>
                                            <div class="tm-slider-designation">
                                                <p><?php echo esc_html($item['tm_designation']) ?></p>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <?php if ('' !== $item['item_description']) { ?>
                                        <div class="ticker-slider-description">
                                            <p><?php echo esc_html($item['item_description']) ?></p>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>

                     


                    </div>
                <?php  } ?>
            </div>
        <?php endif; ?>
<?php }
}

$widgets_manager->register(new \Ticker_Slider());
