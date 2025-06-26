<?php

namespace FBTH_Addons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use \Elementor\Widget_Base;

class Price_Table_Two extends \Elementor\Widget_Base
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
        return 'fbth-price-table-list';
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
        return __('Pricing Table List', 'fbth');
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
        return 'eicon-price-table';
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
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function search_keyword()
    {
        return ['Price', 'pricing table', 'pricing'];
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
        /**
         * Content tab
         */
        $this->start_controls_section(
            'price_heading_content',
            [
                'label' => __('Price Heading', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control(
            'header_top_align',
            [
                'label'     => __('Align', 'fbth'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left' => [
                        'title' => __('Left', 'fbth'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __('top', 'fbth'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'fbth'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .pricing-heading' => 'text-align:{{VALUE}}',
                ],
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'pricing_type',
            [
                'label' => esc_html__('Pricing Type', 'fbth'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Free', 'fbth'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'price_icon',
            [
                'label' => esc_html__('Currency', 'fbth'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('$', 'fbth'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'price',
            [
                'label' => esc_html__('Price', 'fbth'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('30', 'fbth'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'month_year',
            [
                'label' => esc_html__('Month/Year', 'fbth'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Month', 'fbth'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'pricing_head_list',
            [
                'label' => esc_html__('Add Pricing', 'fbth'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'pricing_type' => esc_html__('Add Pricing Type', 'fbth'),
                        'price' => esc_html__('30', 'fbth'),
                        'month_year' => esc_html__('Month/Year', 'fbth'),
                    ],
                ],
                'title_field' => '{{{ pricing_type }}}',
            ]
        );
        $this->end_controls_section();
		
		  $this->start_controls_section(
            'button_wrapper',
            [
                'label' => __('Button', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
                'condition' => ['enable_button' => 'yes']

            ]
        );


        $this->end_controls_section();
		
		
		
        $this->start_controls_section(
            'feature_type',
            [
                'label' => __('Feature Type', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'enable_title',
            [
                'label' => __('Show Title', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fbth-addons'),
                'label_off' => __('Hide', 'fbth-addons'),
                'return_value' => 'title',
                'default' => 'no',
            ]
        );
        $repeater->add_control(
            'feature_text',
            [
                'label' => esc_html__('Feature Text', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title', 'fbth-addons'),
                'label_block' => true,
            ]
        );
        $repeater->add_responsive_control(
            'table_field_one',
            [
                'label' => __('Field One', 'fbth-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'separator' => 'before',
                'options' => [
                    'none'  => __('None', 'fbth-addons'),
                    'field_text_one'  => __('Text', 'fbth-addons'),
                    'field_icon_one' => __('Icon', 'fbth-addons'),
                ],
            ]
        );

        $repeater->add_control(
            'field_icon_one',
            [
                'label' => __('Icon', 'fbth-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'solid',
                ],
                'condition' => [
                    'table_field_one' => 'field_icon_one'
                ]
            ]
        );

        $repeater->add_control(
            'field_text_one',
            [
                'label' => __('Text', 'fbth-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'table_field_one' => 'field_text_one'
                ]
            ]
        );
        $repeater->add_responsive_control(
            'table_field_two',
            [
                'label' => __('Field Two', 'fbth-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'separator' => 'before',
                'options' => [
                    'none'  => __('None', 'fbth-addons'),
                    'field_text_two'  => __('Text', 'fbth-addons'),
                    'field_icon_two' => __('Icon', 'fbth-addons'),
                ],
            ]
        );

        $repeater->add_control(
            'field_icon_two',
            [
                'label' => __('Icon', 'fbth-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'solid',
                ],
                'condition' => [
                    'table_field_two' => 'field_icon_two'
                ]
            ]
        );

        $repeater->add_control(
            'field_text_two',
            [
                'label' => __('Text', 'fbth-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'table_field_two' => 'field_text_two'
                ]
            ]
        );
        $repeater->add_responsive_control(
            'table_field_three',
            [
                'label' => __('Field Three', 'fbth-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'separator' => 'before',
                'options' => [
                    'none'  => __('None', 'fbth-addons'),
                    'field_text_three'  => __('Text', 'fbth-addons'),
                    'field_icon_three' => __('Icon', 'fbth-addons'),
                ],
            ]
        );
        $repeater->add_control(
            'field_icon_three',
            [
                'label' => __('Icon', 'fbth-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'solid',
                ],
                'condition' => [
                    'table_field_three' => 'field_icon_three'
                ]
            ]
        );

        $repeater->add_control(
            'field_text_three',
            [
                'label' => __('Text', 'fbth-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'table_field_three' => 'field_text_three'
                ]
            ]
        );
        $repeater->add_responsive_control(
            'table_field_four',
            [
                'label' => __('Field Four', 'fbth-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'separator' => 'before',
                'options' => [
                    'none'  => __('None', 'fbth-addons'),
                    'field_text_four'  => __('Text', 'fbth-addons'),
                    'field_icon_four' => __('Icon', 'fbth-addons'),
                ],
            ]
        );

        $repeater->add_control(
            'field_icon_four',
            [
                'label' => __('Icon', 'fbth-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'solid',
                ],
                'condition' => [
                    'table_field_four' => 'field_icon_four'
                ]
            ]
        );

        $repeater->add_control(
            'field_text_four',
            [
                'label' => __('Text', 'fbth-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'table_field_four' => 'field_text_four'
                ]
            ]
        );
        $this->add_control(
            'feature_list_box',
            [
                'label' => esc_html__('Feature List', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'feature_text' => esc_html__('Title #1', 'fbth-addons'),
                    ],
                ],
                'title_field' => '{{{ feature_text }}}',
            ]
        );

        $this->end_controls_section();
        // Row
        $this->start_controls_section(
            'table_main_price',
            [
                'label' => __('Price Section', 'fbth-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'table_main_price_align',
            [
                'label'     => __('Align', 'fbth'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left' => [
                        'title' => __('Left', 'fbth'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __('top', 'fbth'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'fbth'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .pricing-header h3' => 'text-align:{{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'table_main_price_typography',
                'selector' => '{{WRAPPER}} .pricing-header h3',
            ]
        );

        $this->add_control(
            'table_main_price_color',
            [
                'label' => esc_html__('Price Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-header .price' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'table_main_price_padding',
            [
                'label' => __('Price Padding', 'fbth-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],

                'selectors' => [
                    '{{WRAPPER}} .pricing-header .price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-header .price' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'table_main_price_margin',
            [
                'label' => __('Price Margin', 'fbth-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],

                'selectors' => [
                    '{{WRAPPER}} .pricing-header .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-header .price' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'table_main_category_color',
            [
                'label' => esc_html__('Category Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .price-category' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'table_main_cat_typography',
                'selector' => '{{WRAPPER}} .price-category',
            ]
        );
        $this->add_responsive_control(
            'table_main_category_padding',
            [
                'label' => __('Cateogry Padding', 'fbth-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],

                'selectors' => [
                    '{{WRAPPER}} .pricing-header .price-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-header .price-category' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'table_main_category_margin',
            [
                'label' => __('Category Margin', 'fbth-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],

                'selectors' => [
                    '{{WRAPPER}} .pricing-header .price-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-header .price-category' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_control(
            'table_main_price_bg_color',
            [
                'label' => esc_html__('Background Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .pricing-heading' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'table_main_price_border_radius',
            [
                'label' => __('Border Radius', 'fbth-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-heading' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'table_main_price_width',
            [
                'label' => esc_html__('Wrapper Width', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-heading' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'table_main_wrapper_padding',
            [
                'label' => __('Wrapper Padding', 'fbth-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],

                'selectors' => [
                    '{{WRAPPER}} .pricing-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-heading' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'table_main_wrapper_margin',
            [
                'label' => __('Wrapper Margin', 'fbth-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],

                'selectors' => [
                    '{{WRAPPER}} .pricing-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-heading' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'table_main_price_border',
                'label' => __('Border', 'fbth-addons'),
                'selector' => '{{WRAPPER}} .pricing-heading',
            ]
        );
        $this->end_controls_section();

        // Main
        $this->start_controls_section(
            'table_main_heading',
            [
                'label' => __('Table Main Title', 'fbth-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'table_main_align',
            [
                'label'     => __('Align', 'fbth'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left' => [
                        'title' => __('Left', 'fbth'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __('top', 'fbth'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'fbth'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .table-main-title .pricing-list-heading' => 'text-align:{{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'table_main_heading_typography',
                'selector' => '{{WRAPPER}} .table-main-title .pricing-list-heading',
            ]
        );
        $this->add_responsive_control(
            'table_main_heading_width',
            [
                'label' => esc_html__('Wrapper Width', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .table-main-title .pricing-list-heading' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'table_main_heading_bg_color',
            [
                'label' => esc_html__('Background Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .table-main-title .pricing-list-heading' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'table_main_heading_color',
            [
                'label' => esc_html__(' Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .table-main-title .pricing-list-heading' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'table_main_heading_border_radius',
            [
                'label' => __('Border Radius', 'fbth-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .table-main-title .pricing-list-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .table-main-title .pricing-list-heading' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'table_main_heading_padding',
            [
                'label' => __('Padding', 'fbth-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    =>    [
                    'top' => '20',
                    'right' => '45',
                    'bottom' => '20',
                    'left' => '45'
                ],
                'selectors' => [
                    '{{WRAPPER}} .table-main-title .pricing-list-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .table-main-title .pricing-list-heading' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'table_main_heading_border',
                'label' => __('Border', 'fbth-addons'),
                'selector' => '{{WRAPPER}} .table-main-title .pricing-list-heading',
            ]
        );
        $this->end_controls_section();

        // heading
        $this->start_controls_section(
            'table_heading',
            [
                'label' => __('Table Head', 'fbth-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'table_head_align',
            [
                'label'     => __('Align', 'fbth'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left' => [
                        'title' => __('Left', 'fbth'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __('top', 'fbth'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'fbth'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list-heading' => 'text-align:{{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'table_heading_typography',
                'selector' => '{{WRAPPER}} .pricing-list-heading',
            ]
        );
        $this->add_responsive_control(
            'table_heading_width',
            [
                'label' => esc_html__('Wrapper Width', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-list-heading' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'table_heading_bg_color',
            [
                'label' => esc_html__('Background Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list-heading' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'table_heading_color',
            [
                'label' => esc_html__(' Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list-heading' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'table_heading_border_radius',
            [
                'label' => __('Border Radius', 'fbth-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-list-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-list-heading' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'table_heading_padding',
            [
                'label' => __('Padding', 'fbth-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    =>    [
                    'top' => '20',
                    'right' => '45',
                    'bottom' => '20',
                    'left' => '45'
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-list-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-list-heading' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'table_heading_border',
                'label' => __('Border', 'fbth-addons'),
                'selector' => '{{WRAPPER}} .pricing-list-heading',
            ]
        );
        $this->end_controls_section();
        
        
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
                    '{{WRAPPER}} .fbth-price-list-btn a' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .fbth-price-list-btn a' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Text Typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-price-list-btn a',
            ]
        );
        $this->add_control(
            'button_color',
            [
                'label' => __('Text Color', 'fbth'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-price-list-btn a' => 'color: {{VALUE}}',
                ],

            ]
        );
        $this->add_control(
            'button_background',
            [
                'label' => __('Background Color', 'fbth'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-price-list-btn a' => 'background-color: {{VALUE}}',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => __('Border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-price-list-btn a',
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'fbth'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    =>    [
                    'top' => '20',
                    'right' => '45',
                    'bottom' => '20',
                    'left' => '45'
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-price-list-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]
        );
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => __('Margin', 'fbth'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    =>    [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0'
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-price-list-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

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
                    '{{WRAPPER}} .fbth-price-list-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

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
                    '{{WRAPPER}} .fbth-price-list-btn span.btn-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fbth-price-list-btn span.btn-icon svg path' => 'stroke: {{VALUE}}',

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
                    '{{WRAPPER}} .fbth-price-list-btn span.btn-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-price-list-btn span.btn-icon svg' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .fbth-price-list-btn span.btn-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

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
                    '{{WRAPPER}} .fbth-price-list-btn:hover a' => 'color: {{VALUE}}',
                ],

            ]
        );
        $this->add_control(
            'button_hover_background',
            [
                'label' => __('Button Background Color', 'fbth'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-price-list-btn:hover a' => 'background-color: {{VALUE}}',
                ],

            ]
        );
        $this->add_control(
            'btn_icon_color_hover',
            [
                'label' => __('Icon Color', 'fbth'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-price-list-btn:hover span.btn-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fbth-price-list-btn:hover span.btn-icon svg path' => 'stroke: {{VALUE}}',


                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        
        // Main
        $this->start_controls_section(
            'table_content',
            [
                'label' => __('Table Content', 'fbth-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'table_content_align',
            [
                'label'     => __('Align', 'fbth'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left' => [
                        'title' => __('Left', 'fbth'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __('top', 'fbth'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'fbth'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list' => 'text-align:{{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'table_content_typography',
                'selector' => '{{WRAPPER}} .pricing-list',
            ]
        );
        $this->add_responsive_control(
            'table_content_width',
            [
                'label' => esc_html__('Width', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-list' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'table_content_height',
            [
                'label' => esc_html__('Height', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-list' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'table_content_bg_color',
            [
                'label' => esc_html__('Background Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'table_content_color',
            [
                'label' => esc_html__('Item Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'table_icon_color',
            [
                'label' => esc_html__('Icon Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'table_content_border_radius',
            [
                'label' => __('Border Radius', 'fbth-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-list' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'table_content_margin',
            [
                'label' => __('Margin', 'fbth-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],

                'selectors' => [
                    '{{WRAPPER}} .pricing-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-list' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );


        $this->add_responsive_control(
            'table_content_padding',
            [
                'label' => __('Padding', 'fbth-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    =>    [
                    'top' => '20',
                    'right' => '45',
                    'bottom' => '20',
                    'left' => '45'
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-list' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'table_content_border',
                'label' => __('Border', 'fbth-addons'),
                'selector' => '{{WRAPPER}} .pricing-list',
            ]
        );
        $this->end_controls_section();

        // Wrapper
        $this->start_controls_section(
            'wrapper',
            [
                'label' => __('Wrapper', 'fbth-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'table_wrapper_width',
            [
                'label' => esc_html__('Wrapper Width', 'fbth-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'table_wrapper_color',
            [
                'label' => esc_html__('Background Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'table_wrapper_border_radius',
            [
                'label' => __('Border Radius', 'fbth-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-table' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'table_wrapper_padding',
            [
                'label' => __('Padding', 'fbth-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    =>    [
                    'top' => '20',
                    'right' => '45',
                    'bottom' => '20',
                    'left' => '45'
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-table' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'Border',
                'label' => __('Border', 'fbth-addons'),
                'selector' => '{{WRAPPER}} .pricing-table',
            ]
        );
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
        $target = isset($settings['button_url']['is_external']) ? ' target="_blank"' : '';
        $nofollow = isset($settings['button_url']['nofollow']) ? ' rel="nofollow"' : '';
?>
        <div class="pricing-table-wrapper">
            <table class="pricing-table">
                <?php
                if ($settings['pricing_head_list']) {
                ?>
                    <thead class="heading-top">
                        <tr class="pricing-header heading-wrapper">
                            <th class="pricing-heading heading-empty"></th>
                            <?php
                            foreach ($settings['pricing_head_list'] as $item) {
                            ?>
                                <th class="pricing-heading">
                                    <p class="price-category"><?php echo $item['pricing_type']; ?></p>
                                    <h3 class="price">
                                        <span class="pricing-icon"><?php echo $item['price_icon'] ?></span>
                                        <span><?php echo $item['price']; ?></span>
                                        <span class="month-year"><?php echo $item['month_year']; ?></span>
                                    </h3>
                                    	  <?php if ('yes' == $settings['enable_button']) { ?>
                                        <div class="fbth-price-list-btn">
                                            <a <?php printf('href="%s" %s %s', $settings['button_url']['url'], $nofollow, $target) ?>>
                                                <?php echo $settings['button_text']; ?>
                                                <span class="btn-icon">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings["btn_icon"], ['aria-hidden' => 'true']); ?>
                                                </span>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </th>
                            <?php
                            }
                            ?>
                        </tr>
                    </thead>
                <?php
                }
                ?>

                <tbody class="single-pricing-body">
                    <?php

                    if ($settings['feature_list_box']) {
                        foreach ($settings['feature_list_box']  as $item) {

                    ?>
                            <tr class="pricing-feature table-main-<?php echo $item['enable_title'] ?>">
                                <th class="pricing-list-heading"><?php echo $item['feature_text']; ?></th>
                                <td class="pricing-list" data-label="<?php echo $settings['pricing_head_list'][0]['pricing_type']; ?>">
                                    <?php
                                    if (!empty($item["field_icon_one"]['value']) || !empty($item['field_text_one'])) {
                                        if ('field_text_one' == $item['table_field_one']) {
                                            echo esc_html($item['field_text_one']);
                                        } else {
                                            \Elementor\Icons_Manager::render_icon($item["field_icon_one"], ['aria-hidden' => 'true']);
                                        }
                                    }
                                    ?>

                                </td>
                                <td class="pricing-list" data-label="<?php
                                                                        if (isset($settings['pricing_head_list'][1]['pricing_type'])) {
                                                                            echo $settings['pricing_head_list'][1]['pricing_type'];
                                                                        }
                                                                        ?>">

                                    <?php
                                    if (!empty($item["field_icon_two"]['value']) || !empty($item['field_text_two'])) {

                                        if ('field_text_two' == $item['table_field_two']) {
                                            echo esc_html($item['field_text_two']);
                                        } else {
                                            \Elementor\Icons_Manager::render_icon($item["field_icon_two"], ['aria-hidden' => 'true']);
                                        }
                                    }
                                    ?>
                                </td>
                                <td class="pricing-list" data-label="<?php
                                                                        if (isset($settings['pricing_head_list'][2]['pricing_type'])) {
                                                                            echo $settings['pricing_head_list'][2]['pricing_type'];
                                                                        }
                                                                        ?>"
                                    >
                                    <?php
                                    if (!empty($item["field_icon_three"]['value']) || !empty($item['field_text_three'])) {

                                        if ('field_text_three' == $item['table_field_three']) {
                                            echo esc_html($item['field_text_three']);
                                        } else {
                                            \Elementor\Icons_Manager::render_icon($item["field_icon_three"], ['aria-hidden' => 'true']);
                                        }
                                    }
                                    ?>
                                </td>
                                <td class="pricing-list <?php if (empty($settings['pricing_head_list'][3]['pricing_type'])) { echo 'hide'; } ?>" data-label="<?php
                                                                        if (isset($settings['pricing_head_list'][3]['pricing_type'])) {
                                                                            echo $settings['pricing_head_list'][3]['pricing_type'];
                                                                        }
                                                                        ?>">
                                    <?php
                                    if (!empty($item["field_icon_four"]['value']) || !empty($item['field_text_four'])) {

                                        if ('field_text_four' == $item['table_field_four']) {
                                            echo esc_html($item['field_text_four']);
                                        } else {
                                            \Elementor\Icons_Manager::render_icon($item["field_icon_four"], ['aria-hidden' => 'true']);
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
<?php
    }
}

$widgets_manager->register(new \FBTH_Addons\Widgets\Price_Table_Two());
