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
class Price_Table extends \Elementor\Widget_Base
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
        return 'fbth-price-table';
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
        return __('Pricing Table', 'fbth');
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

    public function get_keywords()
    {
        return ['price', 'package', 'product', 'plan', 'pricing', 'fbth'];
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
            'price_tabs',
            [
                'label' => __('Price Tabs', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'first_tab_title',
            [
                'label'   => __('First tab title', 'fbth'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html('Monthly '),
            ]
        );

        $this->add_control(
            'second_tab_title',
            [
                'label'   => __('Second tab title', 'fbth'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html('Yearly '),
            ]
        );

        $this->add_control(
            'price_show_offer',
            [
                'label' => esc_html__('Show Offer', 'fbth'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'your-plugin'),
                'label_off' => esc_html__('Hide', 'your-plugin'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'price_offer',
            [
                'label'   => __('Offer text', 'fbth'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html('Save 20% '),
                'condition' => [
                    'price_show_offer' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'switcher_style',
            [
                'label'   => __('Switcher Style', 'fbth'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'style-1' => __('Style 1', 'fbth'),
                    'style-2' => __('Style 2', 'fbth'),
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_align',
            [
                'label'     => __('Tab wrapper Align', 'fbth'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => __('Left', 'fbth'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __('top', 'fbth'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end'   => [
                        'title' => __('Right', 'fbth'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-tabs' => 'justify-content:{{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'price_tables',
            [
                'label' => __('Price tables', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control('per_line', [
            'label'              => __('Columns', 'omega-hp'),
            'type'               => \Elementor\Controls_Manager::SELECT,
            'default'            => '4',
            'tablet_default'     => '6',
            'mobile_default'     => '12',
            'options'            => [
                '12' => '1 Column',
                '6'  => '2 Column',
                '4'  => '3 Column',
                '3'  => '4 Column',
            ],
            'frontend_available' => true,
        ]);

        $this->add_responsive_control(
            'column_gap',
            [
                'label'      => __('Column Gap', 'fbth'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .pricing-box-wrap>div' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pricing-box-wrap'     => 'margion-left: -{{SIZE}}{{UNIT}}; margion-right: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_gap_bottom',
            [
                'label'          => __('Gap Bottom', 'omega'),
                'type'           => \Elementor\Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .fbth-pricing-item-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pricing-box-wrap' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

      
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'focused',
            [
                'label'        => __('Make it focsed', 'fbth'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('Not Focused', 'fbth'),
                'label_off'    => __('Focused', 'fbth'),
                'return_value' => 'focused',

            ]
        );
        $repeater->add_control(
            'price_show_icon',
            [
                'label' => esc_html__('Show Icon', 'fbth'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'your-plugin'),
                'label_off' => esc_html__('Hide', 'your-plugin'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $repeater->add_control(
            'price_icon',
            [
                'label' => esc_html__('Header Icon', 'fbth'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'price_show_icon' => 'yes'
                ],
            ]
        );
        $repeater->add_control(
            'title',
            [
                'label'   => __('Price title', 'fbth'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Personal',
            ]
        );
        $repeater->add_control(
            'price_sub_title',
            [
                'label' => esc_html__('Show Subtitle', 'fbth'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'your-plugin'),
                'label_off' => esc_html__('Hide', 'your-plugin'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $repeater->add_control(
            'price_subtitle_title',
            [
                'label'   => __('Price Sub title', 'fbth'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Personal',
                'condition' => [
                    'price_sub_title' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'price_badge',
            [
                'label' => __('Price Badge', 'fbth'),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'price_currency',
            [
                'label'   => __('Price Currency', 'fbth'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __('$', 'fbth'),
            ]
        );

        $repeater->add_control(
            'price_monthly',
            [
                'label'   => __('Montly Price', 'fbth'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __('99', 'fbth'),
            ]
        );

        $repeater->add_control(
            'price_duration_monthly',
            [
                'label'   => __('Montly Price Duration text', 'fbth'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __('per month', 'fbth'),
            ]
        );

        $repeater->add_control(
            'price_subtitle_monthly',
            [
                'label'   => __('Montly Price Subtitle', 'fbth'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __('billed monthly', 'fbth'),
            ]
        );

        $repeater->add_control(
            'price_yearly',
            [
                'label'   => __('Yearly  Price', 'fbth'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __('180', 'fbth'),
            ]
        );

        $repeater->add_control(
            'price_duration_yearly',
            [
                'label'   => __('Yearly Price Duration text', 'fbth'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __('per year', 'fbth'),
            ]
        );

        $repeater->add_control(
            'price_subtitle_yearly',
            [
                'label'   => __('Yearly Price Subtitle', 'fbth'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __('billed Yearly', 'fbth'),
            ]
        );
        $repeater->add_control(
            'features',
            [
                'label' => __('Features', 'fbth'),
                'type'  => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );

        $repeater->add_control(
            'show_btn',
            [
                'label'        => __('Show Button', 'fbth'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'fbth'),
                'label_off'    => __('Hide', 'fbth'),
                'default'      => 'true',
                'return_value' => 'true',
            ]
        );

        $repeater->add_control(
            'btn_icon',
            [
                'label'     => __('Button Icon', 'fbth'),
                'type'      => \Elementor\Controls_Manager::ICONS,
                'default'   => [
                    'value'   => '',
                    'library' => '',
                ],
            ]
        );

        $repeater->add_control(
            'button_label',
            [
                'label'     => __('Button text', 'fbth'),
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'default'   => 'Learn More',
                'condition' => [
                    'show_btn' => 'true',
                ],
            ]
        );

        $repeater->add_control(
            'button_url',
            [
                'label'     => __('Button URL', 'fbth'),
                'type'      => \Elementor\Controls_Manager::URL,
                'condition' => [
                    'show_btn' => 'true',
                ],
            ]

        );

        $repeater->add_control(
            'button_yearly_url',
            [
                'label'     => __('Button Yearly URL', 'fbth'),
                'type'      => \Elementor\Controls_Manager::URL,
                'condition' => [
                    'show_btn' => 'true',
                ],
            ]

        );

        $repeater->add_control(
            'bottom_info',
            [
                'label'   => __('Bottom Info', 'fbth'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'No credit card required',
            ]
        );

        $this->add_control(
            'pricing_list',
            [
                'label'       => __('Repeater List', 'fbth'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );





        $this->add_control(
            'fbth_addons_pricing_table_btn_wrapper_alignment',
            [
                'label'         => __('Button Wrapper Alignment', 'fbth'),
                'type'          => \Elementor\Controls_Manager::CHOOSE,
                'toggle'        => false,
                'default'        => 'center',
                'options'       => [
                    'start'      => [
                        'title' => __('Left', 'fbth'),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center'    => [
                        'title' => __('Center', 'fbth'),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'end'     => [
                        'title' => __('Right', 'fbth'),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-item .fbth-btn-wrapper' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'button_align',
            [
                'label'     => __('Button Align', 'fbth'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => __('Left', 'fbth'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __('top', 'fbth'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end'   => [
                        'title' => __('Right', 'fbth'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn' => 'justify-content:{{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_align',
            [
                'label'     => __('Price Align', 'fbth'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => __('Left', 'fbth'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __('top', 'fbth'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end'   => [
                        'title' => __('Right', 'fbth'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .fbth-price' => 'justify-content:{{VALUE}}',
                ],
            ]
        );


        $this->add_responsive_control(
            'content_align',
            [
                'label'     => __('Content Align', 'fbth'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => __('Left', 'fbth'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __('top', 'fbth'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end'   => [
                        'title' => __('Right', 'fbth'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align:{{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_align',
            [
                'label'     => __('Vertical Align', 'fbth'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => __('Top', 'fbth'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __('Cnter', 'fbth'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end'   => [
                        'title' => __('Bottom', 'fbth'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} #fbth-dynamic-deck' => 'align-items:{{VALUE}}',
                ],
            ]
        );



        /* Price button position start*/

        $this->add_responsive_control(
            'price_btn_position_type',
            array(
                'label' => __('Button Position', 'fbth'),
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
                    '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn' => 'position:{{VALUE}};',
                ),
            )
        );
        $this->add_responsive_control(
            'price_btn_position_top',
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
                    '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn' => 'top:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_btn_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_btn_position_right',
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
                    '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn' => 'right:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_btn_position_type' => array('relative', 'absolute'),
                ),
                'return_value' => '',
            )
        );
        $this->add_responsive_control(
            'price_btn_content_position_bottom',
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
                    '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn' => 'bottom:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_btn_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_btn_position_left',
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
                    '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn' => 'left:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_btn_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_btn_position_from_center',
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
                    '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
                ),
                'condition' => array(
                    'price_btn_position_type' => array('relative', 'absolute'),
                ),
            )
        );

        /* Price button position End*/



        /* Price title position start*/

        $this->add_responsive_control(
            'price_title_position_type',
            array(
                'label' => __('Price Title Position', 'fbth'),
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
                    '{{WRAPPER}} .fbth-price-wrap .fbth-pricing-title' => 'position:{{VALUE}};',
                ),
            )
        );
        $this->add_responsive_control(
            'price_title_content_position_top',
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
                    '{{WRAPPER}} .fbth-price-wrap .fbth-pricing-title' => 'top:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_title_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_title_content_position_right',
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
                    '{{WRAPPER}} .fbth-price-wrap .fbth-pricing-title' => 'right:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_title_position_type' => array('relative', 'absolute'),
                ),
                'return_value' => '',
            )
        );
        $this->add_responsive_control(
            'price_title_content_position_bottom',
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
                    '{{WRAPPER}} .fbth-price-wrap .fbth-pricing-title' => 'bottom:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_title_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_title_content_position_left',
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
                    '{{WRAPPER}} .fbth-price-wrap .fbth-pricing-title' => 'left:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_title_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_title_content_position_from_center',
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
                    '{{WRAPPER}} .fbth-price-wrap .fbth-pricing-title' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
                ),
                'condition' => array(
                    'price_title_position_type' => array('relative', 'absolute'),
                ),
            )
        );

        /* Price title position End*/


        /* Price position start*/

        $this->add_responsive_control(
            'price_content_position_type',
            array(
                'label' => __('Price Position Type', 'fbth'),
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
                    '{{WRAPPER}} .fbth-price-wrap .fbth-price' => 'position:{{VALUE}};',
                ),
            )
        );
        $this->add_responsive_control(
            'price_content_position_top',
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
                    '{{WRAPPER}} .fbth-price-wrap .fbth-price' => 'top:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_content_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_content_position_right',
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
                    '{{WRAPPER}} .fbth-price-wrap .fbth-price' => 'right:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_content_position_type' => array('relative', 'absolute'),
                ),
                'return_value' => '',
            )
        );
        $this->add_responsive_control(
            'price_content_position_bottom',
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
                    '{{WRAPPER}} .fbth-price-wrap .fbth-price' => 'bottom:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_content_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_content_position_left',
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
                    '{{WRAPPER}} .fbth-price-wrap .fbth-price' => 'left:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_content_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_content_position_from_center',
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
                    '{{WRAPPER}} .fbth-price-wrap .fbth-price' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
                ),
                'condition' => array(
                    'price_content_position_type' => array('relative', 'absolute'),
                ),
            )
        );

        /* Price position End*/

        /* Price subtitle position start*/

        $this->add_responsive_control(
            'price_subtitle_position_type',
            array(
                'label' => __('Price Subtitle Position', 'fbth'),
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
                    '{{WRAPPER}} .fbth-price-wrap .price-subtitle' => 'position:{{VALUE}};',
                ),
            )
        );
        $this->add_responsive_control(
            'price_subtitle_content_position_top',
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
                    '{{WRAPPER}} .fbth-price-wrap .price-subtitle' => 'top:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_subtitle_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_subtitle_content_position_right',
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
                    '{{WRAPPER}} .fbth-price-wrap .price-subtitle' => 'right:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_subtitle_position_type' => array('relative', 'absolute'),
                ),
                'return_value' => '',
            )
        );
        $this->add_responsive_control(
            'price_subtitle_content_position_bottom',
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
                    '{{WRAPPER}} .fbth-price-wrap .price-subtitle' => 'bottom:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_subtitle_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_subtitle_content_position_left',
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
                    '{{WRAPPER}} .fbth-price-wrap .price-subtitle' => 'left:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'price_subtitle_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'price_subtitle_content_position_from_center',
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
                    '{{WRAPPER}} .fbth-price-wrap .price-subtitle' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
                ),
                'condition' => array(
                    'price_subtitle_position_type' => array('relative', 'absolute'),
                ),
            )
        );

        /* Price subtitle position End*/



        $this->end_controls_section();
        /**
         * Header Icon
         */

        $this->start_controls_section(
            'pring_header_icon',
            [
                'label' => __('Header Icon', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'header_icon_width',
            [
                'label' => esc_html__('Font Size', 'fbth'),
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
                    '{{WRAPPER}} .fbth-pricing-icon svg ' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-pricing-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'header_iocn_color',
            [
                'label' => esc_html__('Icon Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fbth-pricing-icon svg' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'header_icon_gap',
            [
                'label' => esc_html__('Gap', 'fbth'),
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
                    '{{WRAPPER}} span.fbth-pricing-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        /**
         * Style tab
         */

        $this->start_controls_section(
            'pricing_tabs_tyle',
            [
                'label' => __('Pricing Tabs', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'toggle_wrap_padding',
            [
                'label'      => __('Toggle Wrapper padding', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-tab' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'switcher_style' => 'style-2',
                ],

            ]
        );
        $this->add_responsive_control(
            'toggle_margin',
            [
                'label'      => __('Toggle Margin', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-price-tabs-switcher' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'switcher_style' => 'style-1',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'toggle_border',
                'label'    => __('toggle_border', 'fbth'),
                'selector' => '{{WRAPPER}} #pricing-dynamic-deck--head a',
                'condition' => [
                    'switcher_style' => 'style-1',
                ],
            ]

        );

        $this->add_responsive_control(
            'toggle_border_radius',
            [
                'label'      => __('Toggle Border Radius', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} #pricing-dynamic-deck--head a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'switcher_style' => 'style-1',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tabs_title_typo',
                'label'    => __('Title typography', 'fbth'),
                'selector' => '{{WRAPPER}} .first-tabs-title,{{WRAPPER}} .second-tabs-title',
            ]
        );

        $this->add_control(
            'tabs_title_color',
            [
                'label'     => __('Title Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .first-tabs-title, {{WRAPPER}} .second-tabs-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tabs_title_active_color',
            [
                'label'     => __('Title Active Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .first-tabs-title.active, {{WRAPPER}} .second-tabs-title.active' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tabs_title_active_bg_color',
            [
                'label'     => __('Title Active Background Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .first-tabs-title.active, {{WRAPPER}} .second-tabs-title.active' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'switcher_style' => 'style-2',
                ],
            ]
        );

        $this->add_control(
            'switcher_divide',
            [
                'type'      => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    'switcher_style' => 'style-1',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'switcher_bg_color',
                'label'     => __('Switcher Background Color', 'fbth'),
                'types'     => ['classic', 'gradient'],
                'fields_options'  => [
                    'background'  => [
                        'default' => 'gradient'
                    ],
                ],
                'selector'  => '{{WRAPPER}} #pricing-dynamic-deck--head .btn-toggle',
            ]
        );

        $this->add_control(
            'switcher_bg_active_color',
            [
                'label'     => __('Switcher Active Background Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #pricing-dynamic-deck--head .btn-toggle.active' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'switcher_style' => 'style-1',
                ],
            ]
        );
        $this->add_control(
            'switcher_circle_color',
            [
                'label'     => __('Switcher Circle Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #pricing-dynamic-deck--head .btn-toggle span' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'switcher_style' => 'style-1',
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_title_padding',
            [
                'label' => __('Title Padding', 'upmedix'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '10',
                    'right'    => '10',
                    'bottom'   => '10',
                    'left'     => '10',
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-tabs.style-2 .fbth-pricing-tab a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'first_title_active_border_radius',
            [
                'label'      => __('First active title Border Radius', 'fbth'),
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
                    '{{WRAPPER}} .fbth-pricing-tabs.style-2 a.tabs-title.first-tabs-title.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'switcher_style' => 'style-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'second_title_active_border_radius',
            [
                'label'      => __('Second active title Border Radius', 'fbth'),
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
                    '{{WRAPPER}} .fbth-pricing-tabs.style-2 a.tabs-title.second-tabs-title.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'switcher_style' => 'style-2',
                ],
            ]
        );

        $this->add_control(
            'switcher_wrap_bg_active_color',
            [
                'label'     => __('Switcher Wraper Background Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-tabs.style-2 .fbth-pricing-tab' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'switcher_style' => 'style-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'wraper_box_active_border',
                'label'    => __('wraper_box_border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-tabs.style-2 .fbth-pricing-tab',
                'condition' => [
                    'switcher_style' => 'style-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'wraper_border_radius',
            [
                'label'      => __('Switcher Wraper Border Radius', 'fbth'),
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
                    '{{WRAPPER}} .fbth-pricing-tabs.style-2 .fbth-pricing-tab' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'switcher_style' => 'style-2',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_tabs_wraper',
                'label' => esc_html__('Switcher Wraper Box Shadow', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-tabs.style-2 .fbth-pricing-tab',
            ]
        );
        $this->add_responsive_control(
            'tile_tab_width',
            [
                'label' => __('Switcher Width', 'plugin-domain'),
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
                    '{{WRAPPER}} .fbth-pricing-tabs.style-2 .fbth-pricing-tab' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'switcher_style' => 'style-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'tile_tab_height',
            [
                'label' => __('Switcher Height', 'plugin-domain'),
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
                    '{{WRAPPER}} .fbth-pricing-tabs.style-2 .fbth-pricing-tab' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'switcher_style' => 'style-2',
                ],
            ]
        );

        $this->add_control(
            'shitcher_position',
            [
                'label' => __('Switcher Position', 'omega-ts'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'absolute'  => __('Absolute', 'omega-hp'),
                    'initial' => __('Initial', 'omega-hp'),
                    'fixed' => __('Fixed', 'omega-hp'),
                    'relative' => __('Relative', 'omega-hp'),
                    'default' => __('Default', 'omega-hp'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-tabs' => 'position: {{VALUE}}',
                ]
            ]
        );
        $this->add_responsive_control(
            'switcher_position_left',
            [
                'label' => __('Left', 'omega-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .fbth-pricing-tabs' => 'left: {{SIZE}}{{UNIT}} !important; right: auto !important;',
                ],
                'condition' => [
                    'shitcher_position' => 'absolute',
                ],
            ]
        );
        $this->add_responsive_control(
            'switcher_position_right',
            [
                'label' => __('Right', 'omega-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .fbth-pricing-tabs' => 'right: {{SIZE}}{{UNIT}} !important; left: auto !important;',
                ],
                'condition' => [
                    'shitcher_position' => 'absolute',
                ],
            ]
        );
        $this->add_responsive_control(
            'switcher_position_top',
            [
                'label' => __('Top', 'omega-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .fbth-pricing-tabs' => 'top: {{SIZE}}{{UNIT}} !important; button: auto !important;',
                ],
                'condition' => [
                    'shitcher_position' => 'absolute',
                ],
            ]
        );
        $this->add_responsive_control(
            'switcher_position_bottom',
            [
                'label' => __('Bottom', 'omega-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .fbth-pricing-tabs' => 'bottom: {{SIZE}}{{UNIT}} !important; top: auto !important;',
                ],
                'condition' => [
                    'shitcher_position' => 'absolute',
                ],
            ]
        );

        $this->add_responsive_control(
            'switcher_bottom_gap',
            [
                'label' => __('Bottom Gap', 'omega-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 55,
                        'max' => 1000,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-area .fbth-pricing-tabs' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_control(
            'offer_divide',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'offer_typo',
                'label'    => __('Offer typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-price-offer',
            ]
        );

        $this->add_control(
            'offer_color',
            [
                'label'     => __('Offer Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-price-offer' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'offer_bg_color',
            [
                'label'     => __('Offer Background Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-price-offer' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'offer_padding',
            [
                'label'      => __('Offer Text Padding', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-price-offer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'offer_radius',
            [
                'label'      => __('Offer Text Radius', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-price-offer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        //Price Badge

        $this->start_controls_section(
            'Price_Badge',
            [
                'label' => __('Price Badge', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'price_badge_style_tabs'
        );

        $this->start_controls_tab(
            'price_badge_normal_tab',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'badge_typo',
                'label'    => __('Badge Typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-badge',
            ]
        );

        $this->add_control(
            'badge_color',
            [
                'label'     => __('Badge Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-badge' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label'     => __('Badge Background Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-badge' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_radius',
            [
                'label'      => __('Badge Radius', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'    => '8',
                    'right'  => '8',
                    'bottom' => '8',
                    'left'   => '8',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_padding',
            [
                'label'      => __('Badge Padding', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_x_postion',
            [
                'label'      => __('Badge X Position', 'fbth'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-badge' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_y_postion',
            [
                'label'      => __('Badge Y Position', 'fbth'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-badge' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'price_badge_active_tab',
            [
                'label' => __('Active', 'fbth'),
            ]
        );

        $this->add_control(
            'badge_color_active',
            [
                'label'     => __('Badge Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item.focused .fbth-pricing-badge' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color_active',
            [
                'label'     => __('Badge Background Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item.focused .fbth-pricing-badge' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'Title_style',
            [
                'label' => __('Title', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'price_title_style_tabs'
        );

        $this->start_controls_tab(
            'price_title_normal_tab',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'label'    => __('Title typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __('Title Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'title_gap',
            [
                'label' => esc_html__('Title Gap', 'fbth'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'price_title_active_tab',
            [
                'label' => __('Active', 'fbth'),
            ]
        );
        $this->add_control(
            'title_color_active',
            [
                'label'     => __('Title Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item.focused .fbth-pricing-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // subtitel
        $this->start_controls_section(
            'subtitle_style',
            [
                'label' => __('Sub Title', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'price_subtitle_style_tabs'
        );

        $this->start_controls_tab(
            'price_subtitle_normal_tab',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'subtitle_typo',
                'label'    => __('subtitle typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-subtitle',
            ]
        );
        $this->add_control(
            'sub_title_color',
            [
                'label'     => __('subtitle Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );
		
		        $this->add_responsive_control(
            'pricing-subtitle-padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		
        $this->end_controls_tab();
        $this->start_controls_tab(
            'price_subtitle_active_tab',
            [
                'label' => __('Active', 'fbth'),
            ]
        );
        $this->add_control(
            'sub_title_color_active',
            [
                'label'     => __('subtitle Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item.focused .fbth-pricing-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        $this->start_controls_section(
            'price_style',
            [
                'label' => __('Price', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'price_style_tabs'
        );

        $this->start_controls_tab(
            'price_normal_tab',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'price_typo',
                'label'    => __('Price typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-area .fbth-pricing-item .fbth-price h2',
            ]
        );
        $this->add_control(
            'price_color',
            [
                'label'     => __('Price Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-area .fbth-pricing-item .fbth-price h2' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'price_currency_typo',
                'label'    => __('Price Currency Typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-area .fbth-pricing-item .fbth-price .price-currency',
            ]
        );
        $this->add_control(
            'price_currency_color',
            [
                'label'     => __('Currency Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-area .fbth-pricing-item .fbth-price .price-currency' => 'color: {{VALUE}}',
                ],
            ]
        );

        /* Separator */


        $this->add_control(
            'fbth_addons_pricing_table_price_box_separator',
            [
                'label'        => esc_html__('Enable Separator', 'fbth'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('ON', 'fbth'),
                'label_off'    => __('OFF', 'fbth'),
                'return_value' => 'yes',
                'default'      => 'yes'
            ]
        );

        $this->add_responsive_control(
            'fbth_addons_pricing_table_price_box_separator_height',
            [
                'label'     => esc_html__('Separator Height', 'fbth'),
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'default'   => '1',
                'selectors' => [
                    '{{WRAPPER}} .fbth-addons-price-bottom-separator' => 'height: {{VALUE}}px;'
                ],
                'condition' => [
                    'fbth_addons_pricing_table_price_box_separator' => 'yes'
                ]

            ]
        );

        $this->add_control(
            'fbth_addons_pricing_table_price_box_separator_color',
            [
                'label'     => esc_html__('Separator Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-addons-price-bottom-separator'  => 'background-color: {{VALUE}};'
                ],
                'condition' => [
                    'fbth_addons_pricing_table_price_box_separator' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'fbth_addons_pricing_table_price_box_separator_spacing',
            [
                'label'       => esc_html__('Separator Spacing', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-addons-price-bottom-separator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

                'condition'   => [
                    'fbth_addons_pricing_table_price_box_separator' => 'yes'
                ]
            ]
        );



        /* Separator end */





        $this->add_control(
            'dura_style_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'price_dur_typo',
                'label'    => __('Price Duration typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-price span.fbth-pricing-duration',
            ]
        );

        $this->add_control(
            'duration_color',
            [
                'label'     => __('Duration Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-duration' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_per_margin',
            [
                'label'      => __('Price Duration Margin', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-duration ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );



        $this->add_control(
            'subtitle_style_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'price_subtitle_typo',
                'label'    => __('Price Subtitle typography', 'fbth'),
                'selector' => '{{WRAPPER}} .price-subtitle',
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label'     => __('Subtitle Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'pricing_subtitle_border',
                'label'    => __('Price Border', 'fbth'),
                'selector' => '{{WRAPPER}} .price-subtitle',
            ]
        );

        $this->add_control(
            'price_wrap_bg_color',
            [
                'label'     => __('Price Wrap Backgrounr', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-price-wrap' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'pricing_wrap_border',
                'label'    => __('Price Border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-price-wrap',
            ]
        );

        $this->add_control(
            'price_toggle',
            [
                'label'        => __('Price Advanced Options', 'fbth'),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __('Default', 'fbth'),
                'label_on'     => __('Custom', 'fbth'),
                'return_value' => 'yes',
            ]
        );
        $this->start_popover();

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'        => 'pricing_border',
                'label'       => __('Price Border', 'fbth'),
                'label_block' => true,
                'selector'    => '{{WRAPPER}} .fbth-price',
            ]
        );
        $this->add_responsive_control(
            'price_currency_margin',
            [
                'label'      => __('Price Currency Margin', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .price-currency' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'price_subtitle_padding',
            [
                'label'      => __('Price Subtitle Padding', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .price-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'price_subtitle_gap',
            [
                'label'      => __('Price Subtitle Margin', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .price-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_padding',
            [
                'label'      => __('Price Padding', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'price_wrap_padding',
            [
                'label'      => __('Price Wrap Padding', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-price-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'price_wrap_gap',
            [
                'label'      => __('Price Gap', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-price h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();
        $this->end_controls_tab();
        $this->start_controls_tab(
            'price_active_tab',
            [
                'label' => __('Active', 'fbth'),
            ]
        );
        $this->add_control(
            'price_color_active',
            [
                'label'     => __('Price Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item.focused .fbth-price h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'fbth_addons_pricing_table_price_box_separator_color_active',
            [
                'label'     => esc_html__('Separator Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item.focused .fbth-addons-price-bottom-separator'  => 'background-color: {{VALUE}};'
                ],
                'condition' => [
                    'fbth_addons_pricing_table_price_box_separator' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'price_currency_color_active',
            [
                'label'     => __('Currency Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item.focused  .fbth-price .price-currency' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'duration_color_active',
            [
                'label'     => __('Duration Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item.focused .fbth-pricing-duration' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color_active',
            [
                'label'     => __('Subtitle Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item.focused .price-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'active_pricing_subtitle_border',
                'label'    => __('Price Subtitle Border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-item.focused .price-subtitle',
            ]
        );

        $this->add_control(
            'price_wrap_bg_color_active',
            [
                'label'     => __('Price Wrap Backgrounr', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item.focused  .fbth-price-wrap' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'pricing_wrap_border_active',
                'label'    => __('Price Border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-item.focused  .fbth-price-wrap',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        $this->start_controls_section(
            'feature_style',
            [
                'label' => __('Feature', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'featur_box_height',
            [
                'label' => esc_html__('Feature Height', 'fbth'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
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
                    '{{WRAPPER}} .fbth-pricing-features' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'price_features_style_tabs'
        );

        $this->start_controls_tab(
            'price_features_normal_tab',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'features_typo',
                'label'    => __('Features typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-features',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'features_strong_typo',
                'label'    => __('Features Strong typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-features strong',
            ]
        );

        $this->add_control(
            'features_color',
            [
                'label'     => __('Features Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-features' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'features_strong_color',
            [
                'label'     => __('Features Strong Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-features strong' => 'color: {{VALUE}}',
                ],
            ]
        );
     


        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'feature_border',
                'label'    => __( 'Feature Border', 'fbth' ),
                'selector' => '{{WRAPPER}} .fbth-pricing-features ul li',
                
            ]
        );


        $this->add_responsive_control(
            'features_align',
            [
                'label'     => __('Feature Align', 'fbth'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'start'   => [
                        'title' => __('Left', 'fbth'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('center', 'fbth'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'end'  => [
                        'title' => __('Right', 'fbth'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-features' => 'justify-content:{{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'features_text_align',
            [
                'label'     => __('Feature text Align', 'fbth'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'start'   => [
                        'title' => __('Left', 'fbth'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('center', 'fbth'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'end'  => [
                        'title' => __('Right', 'fbth'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-features ul li' => 'justify-content:{{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'feature_item_gap',
            [
                'label'      => __('Item gap', 'fbth'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-features p:not(:last-child),{{WRAPPER}} .fbth-pricing-features ul li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'feature_item_padding',
            [
                'label'      => __('Iteam Padding', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-features p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-pricing-features ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'feature_padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-features' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'feature_gap',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-features' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'price_features_active_tab',
            [
                'label' => __('Active', 'fbth'),
            ]
        );
        $this->add_control(
            'features_color_active',
            [
                'label'     => __('Features Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item.focused .fbth-pricing-features' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'features_strong_color_active',
            [
                'label'     => __('Features Strong Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item.focused .fbth-pricing-features strong' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'features_icon_color_active',
            [
                'label'     => __('Features Icon Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item.focused .fbth-pricing-features i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'featur_icon_option',
            [
                'label' => esc_html__('Icon Options', 'fbth'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_control(
            'fea_icon_color',
            [
                'label'     => __('Icon Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-features ul li i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fbth-pricing-features ul li svg path ' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'features_strong_icon_color',
            [
                'label'     => __('Icon Strong Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-features strong i' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .fbth-pricing-features strong svg path' => 'fill: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_responsive_control(
            'feature_icon_size',
            [
                'label'      => __('Icon Size', 'fbth'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-features ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-pricing-features p i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-pricing-features p img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-pricing-features li img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'feature_icon_gap',
            [
                'label'      => __('Icon Gap', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-features ul li i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-pricing-features p i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-pricing-features p img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-pricing-features li img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'button_style',
            [
                'label' => __('Button', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'button_style_tabs'
        );

        $this->start_controls_tab(
            'button_style_normal_tab',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );

        $this->add_control(
            'boxed_btn_color',
            [
                'label'     => __('Button Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'bottom_typography',
                'label'    => __('Typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn',
            ]
        );

        $this->add_control(
            'boxed_btn_background',
            [
                'label'     => __('Background Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'label'    => __('Border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_shadow',
                'label'    => __('Button Shadow', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn',
            ]
        );

        $this->add_responsive_control(
            'button_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_btn_width',
            [
                'label' => __('Button Width', 'plugin-domain'),
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
                    '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_btn_height',
            [
                'label' => __('Button Height', 'plugin-domain'),
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
                    '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => __('Button Padding', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label'      => __('Button Margin', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-item .fbth-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'btn_icon_typography',
                'label' => __('Icon Typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-btn-wrapper i',
            ]
        );
        $this->add_control(
            'btn_icon_color',
            [
                'label' => __('Icon Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-btn-wrapper i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_icon_hover_color',
            [
                'label' => __('Hover Icon Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item.focused .fbth-btn-wrapper i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fbth-pricing-item:hover .fbth-btn-wrapper i ' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fbth-pricing-item:hover .fbth-btn-wrapper svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_icon_margin',
            [
                'label' => __('Icon Margin', 'fbth'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-btn-wrapper i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-btn-wrapper svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_style_hover_tab',
            [
                'label' => __('Hover', 'fbth'),
            ]
        );

        $this->add_control(
            'fbth_addons_pricing_table_btn_hover_text_color',
            [
                'label'     => esc_html__('Text Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item:hover .fbth-btn' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'fbth_addons_pricing_table_btn_hover_bg_color',
            [
                'label'     => esc_html__('Background Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item:hover .fbth-btn' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'button_hover_border',
                'label'    => __('Border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-item:hover .fbth-btn',
            ]
        );
        $this->add_responsive_control(
            'button_hover_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-item:hover .fbth-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_hover_shadow',
                'label'    => __('Button Shadow', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-btn-wrapper .fbth-btn:hover',
            ]
        );

        $this->add_control(
            'btn_icon_hoverr_color',
            [
                'label' => __('Hover Icon  Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item:hover .fbth-btn i' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_tab();


        $this->start_controls_tab(
            'button_style_active_tab',
            [
                'label' => __('Active', 'fbth'),
            ]
        );

        $this->add_control(
            'btn_active_color',
            [
                'label'     => __('Button Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item.focused.fbth-pricing-item.focused  .fbth-btn-wrapper .fbth-btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'btn_active_background',
                'types'     => ['classic', 'gradient'],
                'fields_options'  => [
                    'background'  => [
                        'default' => 'gradient'
                    ],
                ],
                'selector'  => '{{WRAPPER}} .fbth-pricing-item.focused .fbth-btn-wrapper .fbth-btn',
            ]
        );

        $this->add_control(
            'btn_icon_active_color',
            [
                'label' => __('Active Icon Color', 'fbth'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item.focused .fbth-btn-wrapper i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fbth-pricing-item.focused .fbth-btn-wrapper svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'button_active_border',
                'label'    => __('Border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-item.focused .fbth-btn-wrapper .fbth-btn',
            ]
        );

        $this->add_control(
            'btn_hover_animation',
            [
                'label' => __('Hover Animation', 'fbth'),
                'type'  => \Elementor\Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_active_shadow',
                'label'    => __('Button Shadow', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-item.focused .fbth-btn-wrapper .fbth-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_active_hover_shadow',
                'label'    => __('Button Hover Shadow', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-item.focused .fbth-btn-wrapper .fbth-btn:hover',
            ]
        );

        $this->add_responsive_control(
            'button_active_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-item.focused .fbth-btn-wrapper .fbth-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'bottom_text',
            [
                'label' => __('Bottom Info', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'bottom_typo',
                'label'    => __('typography', 'fbth'),
                'selector' => '{{WRAPPER}} .pricing-bottom-info',
            ]
        );

        $this->add_control(
            'bottom_info_olor',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-bottom-info' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'bottom_info_gap',
            [
                'label'      => __('Gap', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}  .pricing-bottom-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'Box',
            [
                'label' => __('Box', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'box_height',
            [
                'label' => esc_html__('Box Height', 'fbth'),
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
                    '{{WRAPPER}} .fbth-pricing-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'style_tabs'
        );

        $this->start_controls_tab(
            'box_normal_tab',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );

        $this->add_control(
            'box_bg_color',
            [
                'label'     => __('Box Background Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label'    => __('Foucsed Box Shadow', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-item',

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => __('box_border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-item',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label'      => __('Box Radius', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __('Box Padding', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label'      => __('Box Margin', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'box_hover_tab',
            [
                'label' => __('Hover', 'fbth'),
            ]
        );

        $this->add_control(
            'box_hover_bg_color',
            [
                'label'     => __('Box Background Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_hover_shadow',
                'label'    => __('Hover Box Shadow', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-item:hover',

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_hover_border',
                'label'    => __('box_border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-item:hover',
            ]
        );

        $this->add_responsive_control(
            'box_hover_radius',
            [
                'label'      => __('Box Radius', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'box_active_tab',
            [
                'label' => __('Active', 'fbth'),
            ]
        );
        $this->add_control(
            'box_active_bg_color',
            [
                'label'     => __('Box Background Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-pricing-item.focused' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_active_shadow',
                'label'    => __('Foucsed Box Shadow', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-item.focused',

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_active_border',
                'label'    => __('box_border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-pricing-item.focused',
            ]
        );

        $this->add_responsive_control(
            'box_active_radius',
            [
                'label'      => __('Box Radius', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-pricing-item.focused' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
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
        $popular_post_key       = array();
        $popular_meta_value_num = array();
        $settings               = $this->get_settings_for_display();
        /* Grid Class */
        $grid_classes = [];
        $grid_classes[] = 'col-xl-' . $settings['per_line'];
        $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
        $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
        $grid_classes = implode(' ', $grid_classes);
        $this->add_render_attribute('pricing_gride_classes', 'class', [$grid_classes, 'col-lg-6 fbth-pricing-item-wrap']);
?>
        <?php
        if ($settings['pricing_list']) :
        ?>
            <div class="fbth-pricing-area pricing-style-classic">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="fbth-pricing-tabs <?php echo esc_attr($settings['switcher_style']) ?>">
                            <?php if ('style-2' == $settings['switcher_style']) : ?>
                                <div class="fbth-pricing-tab">
                                    <a href="javascript:" class="tabs-title first-tabs-title active" data-pricing-tab-trigger data-target="#fbth-dynamic-deck">
                                        <?php echo esc_html($settings['first_tab_title']); ?>
                                    </a>
                                    <a href="javascript:" class="tabs-title second-tabs-title" data-pricing-tab-trigger data-target="#fbth-dynamic-deck">
                                        <?php echo esc_html($settings['second_tab_title']); ?>
                                    </a>
                                </div>
                            <?php else : ?>
                                <span class="first-tabs-title"><?php echo $settings['first_tab_title'] ?></span>
                                <div class="fbth-price-tabs-switcher">
                                    <div id="pricing-dynamic-deck--head">
                                        <a href="javascript:" class="btn-toggle active mx-3" data-pricing-trigger data-target="#fbth-dynamic-deck"><span class="round"></span></a>
                                    </div>
                                </div>
                                <span class="second-tabs-title"><?php echo $settings['second_tab_title'] ?></span>
                            <?php endif; ?>
                            <?php if (!empty($settings['price_offer'])) : ?>
                                <span class="fbth-price-offer"><?php echo $settings['price_offer'] ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="row pricing-box-wrap justify-content-center" id="fbth-dynamic-deck" data-pricing-dynamic data-value-active="monthly">
                    <?php foreach ($settings['pricing_list'] as $pricing) : ?>
                        <div <?php echo $this->get_render_attribute_string('pricing_gride_classes'); ?>>
                            <div class="fbth-pricing-item <?php echo $pricing['focused'] ?>">
                                <!-- classic pricing -->
                                <div class="fbth-price-wrap">
                                    <?php if ('yes' === $pricing['price_show_icon']) : ?>
                                        <span class="fbth-pricing-icon"><?php \Elementor\Icons_Manager::render_icon($pricing['price_icon'], ['aria-hidden' => 'true']); ?></span>
                                    <?php endif; ?>
                                    <span class="fbth-pricing-title"><?php echo $pricing['title'] ?></span>
                                    <?php if ('yes' === $pricing['price_sub_title']) : ?>
                                        <span class="fbth-pricing-subtitle"><?php echo $pricing['price_subtitle_title'] ?></span>
                                    <?php endif; ?>
                                    <?php if ($pricing['price_badge']) : ?>
                                        <span class="fbth-pricing-badge"><?php echo $pricing['price_badge'] ?></span>
                                    <?phP endif; ?>
                                    <div class="fbth-price fbth-price-monthly d-flex align-items-center">
                                        <h2 class="dynamic-value" data-active="<?php echo $pricing['price_monthly'] ?>" data-monthly="<?php echo $pricing['price_monthly'] ?>" data-yearly="<?php echo $pricing['price_yearly'] ?>"><span class="price-currency"><?php echo esc_html($pricing['price_currency']) ?></span></h2>
                                        <span class="fbth-pricing-duration dynamic-value" data-active="<?php echo $pricing['price_duration_monthly'] ?>" data-monthly="<?php echo $pricing['price_duration_monthly'] ?>" data-yearly="<?php echo $pricing['price_duration_yearly'] ?>"></span>
                                    </div>
                                    <?php if ($pricing['price_subtitle_monthly'] || $pricing['price_subtitle_yearly']) : ?>
                                        <span class="price-subtitle dynamic-value" data-active="<?php echo esc_attr($pricing['price_subtitle_monthly']) ?>" data-monthly="<?php echo esc_attr($pricing['price_subtitle_monthly']) ?>" data-yearly="<?php echo esc_attr($pricing['price_subtitle_yearly']) ?>"></span>
                                    <?php endif; ?>
                                </div><!--  end of fbth-price-wrap  -->
                                <div class="fbth-pricing-head-filler"></div>
                                <?php
                                if ('yes' === $settings['fbth_addons_pricing_table_price_box_separator']) :
                                    echo '<div class="fbth-addons-price-bottom-separator"></div>';
                                endif;
                                ?>
                                <div class="fbth-pricing-features">
                                    <?php echo ($pricing['features']); ?>
                                </div>
                                <!-- minimal pricing -->
                                <?php
                                if ('true' == $pricing['show_btn']) :
                                    $m_target = !empty($pricing['button_url']['is_external']) ? ' target="_blank"' : '';
                                    $m_nofollow = !empty($pricing['button_url']['nofollow']) ? ' rel="nofollow"' : '';
                                    $y_target = !empty($pricing['button_yearly_url']['is_external']) ? ' target="_blank"' : '';
                                    $y_nofollow = !empty($pricing['button_yearly_url']['nofollow']) ? ' rel="nofollow"' : '';
                                ?>
                                    <div class="fbth-btn-wrapper">
                                        <a class="fbth-btn <?php printf('%s', esc_attr('elementor-animation-' . (!empty($settings['btn_hover_animation']) ? $settings['btn_hover_animation'] : ''))) ?>" href="<?php echo !empty($pricing['button_url']['url']) ? esc_url($pricing['button_url']['url']) : '#' ?>" <?php echo $m_nofollow . $m_target ?>><?php echo esc_html($pricing['button_label']) ?> <?php \Elementor\Icons_Manager::render_icon($pricing['btn_icon'], ['aria-hidden' => 'true']); ?></a>
                                    </div>
                                <?php endif; ?>
                                <?php if ('' != $pricing['bottom_info']) {
                                    printf('<span class="pricing-bottom-info">%s</span>', $pricing['bottom_info']);
                                } ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
<?php
    }
}

$widgets_manager->register(new \FBTH_Addons\Widgets\Price_Table());
