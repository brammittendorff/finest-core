<?php

/**
 * Tab
 *
 *
 * @since 1.0.0
 */

use Elementor\Controls_Manager;
use Elementor\DIVIDER;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class FBTHTab extends \Elementor\Widget_Base
{
    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'fbth-tab';
    }
    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Tab', 'fbth');
    }
    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-tabs';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
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
        return ['tabs', 'tab', 'fbth', 'acc'];
    }
    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Tabs', 'fbth'),
            ]
        );

        $this->add_control(
            'tab_style',
            [
                'label'     => __('Tab Style', 'fbth'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'style-one',
                'options'   => [
                    'style-one' => __('Style One', 'fbth'),
                    'style-two' => __('Style Two', 'fbth'),
                ],
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'fbth_tab_horizo_vertical',
            [
                'label'     => __('Tab Layout', 'fbth'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'horizontal',
                'options'   => [
                    'horizontal' => __('Horizontal', 'fbth'),
                    'vertical' => __('Vertical', 'fbth'),
                ],
                'separator' => 'after',
            ]
        );

        //Start Repetare Content  tab one
        $repeater = new Repeater();
        $repeater->add_control(
            'active_tabs',
            [
                'label'     => __('Active Item', 'fbth'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __('No', 'fbth'),
                'label_off' => __('yes', 'fbth'),
            ]
        );
        $repeater->add_control(
            'fbth_tab_icon_type',
            [
                'label' => esc_html__('Icon Type', 'demo-core'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'none' => [
                        'title' => esc_html__('None', 'demo-core'),
                        'icon' => 'eicon-editor-close',
                    ],
                    'number' => [
                        'title' => esc_html__('Number', 'demo-core'),
                        'icon' => 'eicon-number-field',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'demo-core'),
                        'icon' => 'eicon-icon-box',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'demo-core'),
                        'icon' => 'eicon-image-bold',
                    ],
                ],
                'default' => 'icon',
            ]
        );
        //content fields
        $repeater->add_control(
			'fbth_tab_number',
			[
				'label' => esc_html__( 'Number', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '01', 'textdomain' ),
                'condition' => [
                    'fbth_tab_icon_type' => 'number',
                ],
			]
		);
        $repeater->add_control(
            'list_icon',
            [
                'label'       => __('Icon', 'fbth'),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
                'condition' => [
                    'fbth_tab_icon_type' => 'icon',
                ],
            ]
        );
        $repeater->add_control(
			'fbth_tab_image',
			[
				'label' => esc_html__( 'Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'fbth_tab_icon_type' => 'image',
                ],
			]
		);
        $repeater->add_control(
            'button_text',
            [
                'label'       => __('Button Text', 'fbth'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'button_content',
            [
                'label'       => __('Button Content', 'fbth'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        // tab style on
        $repeater->add_control(
            'content_image',
            [
                'label' => esc_html__('Choose Image', 'plugin-name'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
			'show_tab_btn',
			[
				'label' => esc_html__( 'Show Tab Modal', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $repeater->add_control(
			'fbth_tab_type',
			[
				'label'   => __('Type of Modal', 'fbth'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'youtube',
				'options' => [
					'youtube'        => __('Youtube Video', 'fbth'),
					'vimeo'          => __('Vimeo Video', 'fbth'),
					'external-video' => __('Self Hosted Video', 'fbth'),
                ],
                'condition' => [
                    'show_tab_btn' => 'yes',
                ],
			]
		);
        $repeater->add_control(
			'fbth_tab_youtube_video_url',
			[

				'label'       => __('Provide Youtube Video URL', 'fbth'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://www.youtube.com/watch?v=b1lyIT1FvDo',
				'placeholder' => __('Place Youtube Video URL', 'fbth'),
				'title'       => __('Place Youtube Video URL', 'fbth'),
				'condition'   => [
					'fbth_tab_type' => 'youtube',
                    'show_tab_btn' => 'yes'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'fbth_tab_vimeo_video_url',
			[
				'label'       => __('Provide Vimeo Video URL', 'fbth'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://vimeo.com/347565673',
				'placeholder' => __('Place Vimeo Video URL', 'fbth'),
				'title'       => __('Place Vimeo Video URL', 'fbth'),
				'condition'   => [
					'fbth_tab_type' => 'vimeo'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'fbth_tab_external_video',
			[
				'label'      => __('External Video', 'fbth'),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'video',
				'dynamic' => [
					'active' => true,
				],
				'condition'  => [
					'fbth_tab_type' => 'external-video'
				]
			]
		);
        $repeater->add_control(
			'fbth_tab_btn_icon',
			[
				'label'       => __('Button Icon', 'fbth'),
				'label_block' => true,
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-play',
					'library' => 'fa-brands'
                ],
                'condition' => [
                    'show_tab_btn' => 'yes',
                ],
			]
		);
        //End Repeater Control field
        $this->add_control(
            'tab',
            [
                'label'        => __('Tab List', 'fbth'),
                'type'         => Controls_Manager::REPEATER,
                'fields'       => $repeater->get_controls(),
                'default'      => [
                    [

                        'button_text'      => __('Analytics', 'fbth'),
                        'active_tabs'       =>   'yes',
                        'list_icon'        => [
                            'value'   => 'fa fa-chart-pie',
                            'library' => 'fa-solid',
                        ],
                    ],

                    [

                        'button_text'      => __('Advertisement', 'fbth'),
                        'list_icon'        => [
                            'value'   => 'far fa-flag',
                            'library' => 'fa-solid',
                        ],
                    ],

                    [

                        'button_text'      => __('Sales Report', 'fbth'),
                        'list_icon'        => [
                            'value'   => 'fas fa-chart-line',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'button_title' => '{{{ button_text }}}',
                'condition' => [
                    'tab_style' => 'style-one',
                ]
            ]
        );
        //Start Repetare Content  tab Two
        $repeater_two = new Repeater();
        $repeater_two->add_control(
            'active_tabs',
            [
                'label'     => __('Active Item', 'fbth'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __('No', 'fbth'),
                'label_off' => __('yes', 'fbth'),
            ]
        );
        //content fields
        $repeater_two->add_control(
            'button_text_two',
            [
                'label'       => __('Button Text', 'fbth'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $repeater_two->add_control(
            'tab_imgae',
            [
                'label'     => __('Image', 'fbth'),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        // tab style two
        $repeater_two->add_control(
            'big_headding',
            [
                'label'       => __('Big Heading', 'fbth'),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater_two->add_control(
            'headding_tab_bar_one',
            [
                'label'     => __('Icon Box One', 'fbth'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'separator' => 'after',
            ]
        );

        $repeater_two->add_control(
            'list_icon',
            [
                'label'       => __('Icon', 'fbth'),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );
        $repeater_two->add_control(
            'tab_headding_one',
            [
                'label'       => __('Heading', 'fbth'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater_two->add_control(
            'tab_content_one',
            [
                'label'       => __('Content', 'fbth'),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater_two->add_control(
            'headding_tab_bar',
            [
                'label'     => __('Icon Box Two', 'fbth'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'separator' => 'after',
            ]
        );

        // box one
        $repeater_two->add_control(
            'list_icon_two',
            [
                'label'       => __('Icon Two', 'fbth'),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );
        $repeater_two->add_control(
            'tab_headding_two',
            [
                'label'       => __('Heading', 'fbth'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater_two->add_control(
            'tab_content_two',
            [
                'label'       => __('Content', 'fbth'),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tab_two',
            [
                'label'        => __('Tab List Two', 'fbth'),
                'type'         => Controls_Manager::REPEATER,
                'fields'       => $repeater_two->get_controls(),
                'default'      => [
                    [
                        'tab_imgae' => ['url' => Utils::get_placeholder_image_src()],
                        'big_headding'     => __('Best features for your project management.', 'fbth'),
                        'button_text_two'      => __('Project  Management', 'fbth'),
                        'tab_headding_one' => __('Manage Smartly', 'fbth'),
                        'tab_content_one'  => __('Create custom landing pages with FBTH', 'fbth'),
                        'list_icon'        => [
                            'value'   => 'fa fa-star',
                            'library' => 'fa-solid',
                        ],
                        'tab_headding_two' => __('Daily email reports', 'fbth'),
                        'tab_content_two'  => __('Create custom landing pages with FBTH', 'fbth'),
                        'active_tabs'       =>   'yes',
                        'list_icon_two'        => [
                            'value'   => 'fa fa-star',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'tab_imgae' => ['url' => Utils::get_placeholder_image_src()],
                        'big_headding'     => __('Best features for your project management.', 'fbth'),
                        'button_text_two'      => __('Task Management', 'fbth'),
                        'tab_headding_one' => __('Manage Smartly', 'fbth'),
                        'tab_content_one'  => __('Create custom landing pages with FBTH', 'fbth'),
                        'list_icon'        => [
                            'value'   => 'fa fa-star',
                            'library' => 'fa-solid',
                        ],
                        'tab_headding_two' => __('Daily email reports', 'fbth'),
                        'tab_content_two'  => __('Create custom landing pages with FBTH', 'fbth'),
                        'list_icon_two'        => [
                            'value'   => 'fa fa-star',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'tab_imgae' => ['url' => Utils::get_placeholder_image_src()],
                        'big_headding'     => __('Best features for your project management.', 'fbth'),
                        'button_text_two'      => __('Dark Mode', 'fbth'),
                        'tab_headding_one' => __('Manage Smartly', 'fbth'),
                        'tab_content_one'  => __('Create custom landing pages with FBTH', 'fbth'),
                        'list_icon'        => [
                            'value'   => 'fa fa-star',
                            'library' => 'fa-solid',
                        ],
                        'tab_headding_two' => __('Daily email reports', 'fbth'),
                        'tab_content_two'  => __('Create custom landing pages with FBTH', 'fbth'),
                        'list_icon_two'        => [
                            'value'   => 'fa fa-star',
                            'library' => 'fa-solid',
                        ],
                    ],

                ],
                'condition' => [
                    'tab_style' => 'style-two',
                ]
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
			'fbth_modal_setting_section',
			[
				'label' => __('Modal Settings', 'fbth')
			]
		);

		$this->add_control(
			'fbth_tab_overlay',
			[
				'label'        => __('Overlay', 'fbth'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'fbth'),
				'label_off'    => __('Hide', 'fbth'),
				'return_value' => 'yes',
				'default'      => 'yes'
			]

		);

		$this->add_control(
			'fbth_tab_overlay_click_close',
			[

				'label'     => __('Close While Clicked Outside', 'fbth'),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __('ON', 'fbth'),
				'label_off' => __('OFF', 'fbth'),
				'default'   => 'yes',
				'condition' => [
					'fbth_tab_overlay' => 'yes'
				]

			]

		);
        $this->add_responsive_control(

			'fbth_tab_video_width',

			[
				'label'        => __('Content Width', 'fbth'),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => ['px', '%'],
				'range'        => [
					'px'       => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 720
				],

				'selectors'    => [
					'{{WRAPPER}} .fbth-tab-item .fbth-tabs-content .fbth-tab-element iframe,
					{{WRAPPER}} .fbth-tab-item .fbth-tabs-content .fbth-video-hosted' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .fbth-tab-item' => 'width: {{SIZE}}{{UNIT}};'
				]

			]
		);

		$this->add_responsive_control(
			'fbth_tab_video_height',
			[

				'label'        => __('Content Height', 'fbth'),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => ['px', '%'],
				'range'        => [
					'px'       => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5

					],

					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],

				'default'      => [
					'unit'     => 'px',
					'size'     => 400

				],

				'selectors'    => [
					'{{WRAPPER}} .fbth-tab-item .fbth-tabs-content .fbth-tab-element iframe' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .fbth-tab-item' => 'height: {{SIZE}}{{UNIT}};'
				],

			]

		);

		$this->end_controls_section();

        //Icon
        $this->start_controls_section(
            'icon_style',
            [
                'label' => __('Icon', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'icon_style_tabs'
        );

        // normal
        $this->start_controls_tab(
            'tab_icon_normal_color',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-tab-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fbth-tab-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_color_stock',
            [
                'label'     => __('Stroke Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-tab-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fbth-tab-icon svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );


        $this->add_control(
            'icon_bg',
            [
                'label'     => __('Backround Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-tab-icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .style-two .fbth-tab-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => __('Size', 'fbth'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-tab-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .fbth-tab-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_box_width',
            [
                'label' => __('Icon Box Size', 'fbth'),
                'type' => Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .style-two .fbth-tab-icon' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .style-two .fbth-tab-icon ' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .style-two .fbth-tab-icon i' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tab_style' => 'style-two',
                ]
               
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'icon_box_active_border',
                'label'    => __( 'icon_box_border', 'fbth' ),
                'selector' => '{{WRAPPER}} .style-two .fbth-tab-icon',
                'condition' => [
                    'tab_style' => 'style-two',
                ]
            ]
        );
        $this->add_responsive_control(
            'border_radius',
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
                    '{{WRAPPER}} .style-two .fbth-tab-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'tab_style' => 'style-two',
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-tab-icon'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-tab-icon' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // active
        $this->start_controls_tab(
            'tab_icon_active_color',
            [
                'label' => __('Active', 'fbth'),
            ]
        );

        $this->add_control(
            'icon_color_active',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-menu ul li.current .fbth-tab-icon i,
                    {{WRAPPER}} .fbth--tab-menu ul li:hover .fbth-tab-icon i,
                    {{WRAPPER}} .fbth--tab-menu ul li.current .fbth-tab-icon svg path' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fbth--tab-menu ul li:hover .fbth-tab-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_color_active_stroke',
            [
                'label'     => __('stroke Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-menu ul li.current .fbth-tab-icon i,
                     {{WRAPPER}} .fbth--tab-menu ul li:hover .fbth-tab-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fbth--tab-menu ul li.current .fbth-tab-icon svg path,
                     {{WRAPPER}} .fbth--tab-menu ul li:hover .fbth-tab-icon svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        //Tab Number
        $this->start_controls_section(
            'tab_num_style',
            [
                'label' => __('Tab Number', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'tnum_style_tabs'
        );

        // normal
        $this->start_controls_tab(
            'tab_num_normal_color',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .fbth-tab-number span.tab-number',
			]
		);

        $this->add_control(
            'num_color',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-tab-number span.tab-number' => 'color: {{VALUE}}'
                ],
            ]
        );

        $this->add_responsive_control(
			'number_width',
			[
				'label' => esc_html__( 'Width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
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
					'unit' => 'px',
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .tab-list-content-icon .fbth-tab-number' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'number_height',
			[
				'label' => esc_html__( 'Height', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
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
					'unit' => 'px',
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .tab-list-content-icon .fbth-tab-number' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->add_control(
            'number_bg',
            [
                'label'     => __('Backround Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-list-content-icon .fbth-tab-number' => 'background-color: {{VALUE}}',
                ],
            ]
        );
      
        $this->add_responsive_control(
            'number_border_radius',
            [
                'label'      => __( 'Border Radius', 'fbth' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .tab-list-content-icon .fbth-tab-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                
            ]
        );

        $this->add_responsive_control(
            'number_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .tab-list-content-icon .fbth-tab-number'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // active
        $this->start_controls_tab(
            'tab_num_active_color',
            [
                'label' => __('Active', 'fbth'),
            ]
        );

        $this->add_control(
            'number_color_active',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-menu ul li.tab-link.current .fbth-tab-number span.tab-number' => 'color: {{VALUE}}',
                    
                ],
            ]
        );
        $this->add_control(
            'active_number_bg',
            [
                'label'     => __('Backround Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .current .tab-list-content-icon .fbth-tab-number' => 'background-color: {{VALUE}}',
                ],
            ]
        );
       
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        //Tab
        $this->start_controls_section(
            'menu_box_style',
            [
                'label' => __('Tab', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_responsive_control(
            'tab_width',
            [
                'label'      => __('Tab Width', 'fbth'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'unit' => 'px',
                ],
                'size_units' => ['px', '%', 'vw'],
                'range'      => [
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
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-menu ul.tabs' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );



        $this->add_responsive_control(
            'tab_align',
            [
                'label' => __(' Tab Align', 'fbth'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => __('Left', 'fbth'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('top', 'fbth'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'end' => [
                        'title' => __('Right', 'fbth'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .fbth-tab-row' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_text_align',
            [
                'label' => __(' Text Align', 'fbth'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => __('Left', 'fbth'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'fbth'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'end' => [
                        'title' => __('Right', 'fbth'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .tab-list-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_text_typo',
                'label'    => __('Title Typography', 'fbth'),
                'selector' => '{{WRAPPER}}  .fbth--tab-menu ul li',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_content_typo',
                'label'    => __('Content Typography', 'fbth'),
                'selector' => '{{WRAPPER}}  .fbth--tab-menu ul li p',
            ]
        );
        $this->start_controls_tabs(
            'style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'icon_',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => __('Title Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-menu ul li span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_content_color',
            [
                'label'     => __('Content Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-menu ul li p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'menu_bg',
            [
                'label'     => __('Backround Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-menu ul li' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'menu_border',
                'selector' => '{{WRAPPER}} .fbth--tab-menu ul li',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'menu_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .fbth--tab-menu ul li',
            ]
        );

        $this->add_responsive_control(
            'menu_content_margin',
            [
                'label'      => __('Content Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-menu ul li p'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth--tab-menu ul li p' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-menu ul li'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth--tab-menu ul li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_box_margin',
            [
                'label'      => __('Margin Item', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-menu ul li'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth--tab-menu ul li' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_box_margin_box',
            [
                'label'      => __('Margin Full Box', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-menu.style-two '          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth--tab-menu.style-two ' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_box_padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-menu ul li'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth--tab-menu ul li' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        // hover
        $this->start_controls_tab(
            'tn_bg_color_active',
            [
                'label' => __('Active', 'fbth'),
            ]
        );

        $this->add_control(
            'button_text_active_color',
            [
                'label'     => __('Title Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-menu ul li.current span, {{WRAPPER}} .fbth--tab-menu ul li.tab-link.current span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'menu_bg_active',
            [
                'label'     => __('Backround Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-menu ul li.tab-link.current' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'advance_box_bg',
                'label' => __('Advance Background', 'fbth'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .fbth--tab-menu ul li.tab-link.current',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'menu_border_active',
                'selector' => '{{WRAPPER}} .fbth--tab-menu ul li.tab-link.current',
                'condition' => [
                    'tab-style' => 'style-one',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'menu_shadow_active',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .fbth--tab-menu ul li.tab-link.current',
            ]
        );

        $this->add_responsive_control(
            'menu_border_radius_active',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-menu ul li.tab-link.current'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth--tab-menu ul li.tab-link.current' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_item_active_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-menu ul li.tab-link.current'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth--tab-menu ul li.tab-link.current' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /**
         * tab icon
         */

        $this->start_controls_section(
			'fbth_tab_icon_section',
			[
				'label' => __('Modal Icon', 'fbth'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->start_controls_tabs(
			'btn_icon_style_tabs'
		);

		$this->start_controls_tab(
			'fbth_tab_btn_icon_color_normal_tab',
			[
				'label' => esc_html__('Normal', 'fbth')
			]
		);

		$this->add_responsive_control(
			'fbth_tab_btn_icon_size',
			[

				'label'       => __('Icon Size', 'fbth'),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px'      => [
						'max' => 50
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .fbth-tab-modal-wrapper .fbth-tab-modal-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .fbth-modal-wrapper .fbth-tab-modal-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'fbth_tab_btn_icon_color_normal',
			[
				'label'     => __('Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .fbth-tab-modal-wrapper .fbth-tab-modal-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .fbth-modal-wrapper .fbth-tab-modal-icon svg' => 'stroke: {{VALUE}};'

				]

			]

		);

		$this->add_responsive_control(
			'fbth_tab_btn_icon_fixed_width',
			[

				'label'      => esc_html__('Width', 'fbth'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 100
				],
				'selectors'  => [
					'{{WRAPPER}} .fbth-tab-button' => 'width: {{SIZE}}{{UNIT}};'
				],
			]

		);



		$this->add_responsive_control(
			'fbth_tab_btn_icon_fixed_height',
			[

				'label'      => esc_html__('Height', 'fbth'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 100
				],
				'selectors'  => [
					'{{WRAPPER}} .fbth-tab-button' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'fbth_tab_btn_icon_background_normal',
			[
				'label'     => __('Background Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .fbth-tab-button' => 'background-color: {{VALUE}};'
				],
				
			]
		);
		$this->add_responsive_control(
			'fbth_tab_btn_icon_padding',
			[
				'label'        => __('Padding', 'fbth'),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => ['px', '%'],
				'selectors'    => [
					'{{WRAPPER}} .fbth-tab-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'               => 'fbth_tab_btn_icon_border_normal',
				'selector'           => '{{WRAPPER}} .fbth-tab-button'
			]
		);

		$this->add_responsive_control(
			'fbth_tab_btn_icon_radius',
			[
				'label'      => __('Border Radius', 'fbth'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '50',
					'right'  => '50',
					'bottom' => '50',
					'left'   => '50',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .fbth-tab-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab('fbth_tab_btn_icon_color_hover_tab', ['label' => esc_html__('Hover', 'fbth')]);
		$this->add_control(
			'fbth_tab_btn_icon_color_hover',
			[
				'label'     => __('Icon Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .fbth-tab-button .fbth-tab-image-action:hover span.fbth-midal-btn-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .fbth-tab-button .fbth-tab-image-action:hover span.fbth-midal-btn-icon svg' => 'stroke: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'fbth_tab_btn_icon_background_hover',
			[
				'label'     => __('Background Color', 'fbth'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .fbth-tab-button .fbth-tab-image-action:hover span.fbth-midal-btn-icon i' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .fbth-tab-button .fbth-tab-image-action:hover span.fbth-midal-btn-icon svg' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'fbth_tab_btn_icon_border_hover',
				'selector' => '{{WRAPPER}} .fbth-tab-wrapper span.fbth-midal-btn-icon:hover'
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

        //content and headding
        $this->start_controls_section(
            'discription_style',
            [
                'label' => __('Content', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // title
        $this->add_control(
            'title_headding',
            [
                'label'     => __('Title', 'fbth'),
                'type'      => \Elementor\Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'label'    => __('Typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth--tab-content h3',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-content h3'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth--tab-content h3' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        // title
        $this->add_control(
            'content_heading',
            [
                'label'     => __('Content', 'fbth'),
                'type'      => \Elementor\Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dis_typo',
                'label'    => __('Typography', 'fbth'),
                'selector' => '{{WRAPPER}}  .fbth--tab-content p',
            ]
        );
        $this->add_control(
            'dis_color',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'dis_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-content p'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth--tab-content p' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        //Headding
        $this->start_controls_section(
            'heading_style',
            [
                'label' => __('Heading', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tab_style' => 'style-two',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typo',
                'label'    => __('Typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-tab-big-heading h2',
            ]
        );
        $this->add_control(
            'heading_color',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-tab-big-heading h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-tab-big-heading h2'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-tab-big-heading h2' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        //Image
        $this->start_controls_section(
            'contentbox_style',
            [
                'label' => __('Content Box', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tab_style' => 'style-one',
                ]
            ]
        );
        $this->add_responsive_control(
            'contentbox_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-content'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth--tab-content' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'contentbox_padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-content'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth--tab-content' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        //Image
        $this->start_controls_section(
            'iamge_style',
            [
                'label' => __('Image', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_responsive_control(
            'iamge_align',
            [
                'label' => __('Align', 'fbth'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'fbth'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('top', 'fbth'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'fbth'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .tab-content-image.fbth-tab-image' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label'      => __('Width', 'fbth'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'unit' => 'px',
                ],
                'size_units' => ['px', '%', 'vw'],
                'range'      => [
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
                'selectors'  => [
                    '{{WRAPPER}} .fbth-tab-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'space',
            [
                'label'      => __('Max Width', 'fbth'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'unit' => 'px',
                ],
                'size_units' => ['px', '%', 'vw'],
                'range'      => [
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
                'selectors'  => [
                    '{{WRAPPER}} .fbth-tab-image img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'height',
            [
                'label'      => __('Height', 'fbth'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'unit' => '%',
                ],
                'size_units' => ['px', '%', 'vh'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-tab-image img' => 'height: {{SIZE}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .fbth-tab-image img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .fbth-tab-image img',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-tab-image img'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-tab-image img' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .fbth-tab-image img'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-tab-image img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .fbth-tab-image img',
            ]
        );
        $this->end_controls_section();

        //Tba Right
        $this->start_controls_section(
            'right_box',
            [
                'label' => __('Righit Content Box', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tab_style' => 'style-two',
                ]
            ]
        );

        $this->add_responsive_control(
            'right_content_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-tabs-content-iconbox'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-tabs-content-iconbox' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    //End Repetare Content
    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings();

        $tab_list = $settings['tab'];
        $tab_two = $settings['tab_two'];
        $tab_id = rand(1000, 100000);

        $this->add_render_attribute('fbth_tab_action', [

			'class'             => 'fbth-tab-image-action image-tab',
            'data-fbth-overlay' => esc_attr($settings['fbth_tab_overlay'])
		]);
        $this->add_render_attribute('fbth_tab_overlay', [

			'class'                         => 'fbth-tab-overlay',

			'data-fbth_overlay_click_close' => $settings['fbth_tab_overlay_click_close']

		]);
        $this->add_render_attribute('fbth_tab_item', 'class', 'fbth-tab-item');

		$this->add_render_attribute('fbth_tab_item', 'class', 'tab-vimeo');

		// $this->add_render_attribute('fbth_tab_item', 'class', $settings['fbth_tab_transition']);

		// $this->add_render_attribute('fbth_tab_item', 'class', $settings['fbth_tab_item']);

		// $this->add_render_attribute('fbth_tab_item', 'class', esc_attr('fbth-content-overflow-x-' . $settings['fbth_tab_overlay_overflow_x']));

		// $this->add_render_attribute('fbth_tab_item', 'class', esc_attr('fbth-content-overflow-y-' . $settings['fbth_tab_overlay_overflow_y']));

?>
        <div class="fbth--tab-wraper">
            <?php if ($settings['tab_style'] == 'style-one') : ?>
                <div class="row justify-content-center fbth-tab-row">
                    <div class="col-xxl-5 col-xl-5 col-lg-10 col-md-12">
                        <div class="fbth--tab-left">
                            <div class="fbth--tab-menu <?php echo esc_attr( $settings['fbth_tab_horizo_vertical'] ) ?>">
                                <ul class="tabs">
                                    <?php foreach ($tab_list as $key => $value) :
                                        $active = $value['active_tabs'] == 'yes' ? 'current' : '';
                                    ?>
                                        <li class="tab-link <?php echo esc_attr($active) ?>" data-tab="tab-<?php echo esc_attr($key . $tab_id) ?>">
                                        <?php if ( 'icon' == $value['fbth_tab_icon_type']) : ?>
                                            <div class="tab-list-content-icon">
                                                <div class="fbth-tab-icon">
                                                    <?php \Elementor\Icons_Manager::render_icon($value['list_icon'], ['aria-hidden' => 'true']); ?>
                                                 </div>
                                            </div>
                                            <?php endif; ?>
                                            <?php if ( 'image' == $value['fbth_tab_icon_type']) : ?>
                                            <div class="tab-list-content-icon">
                                                <div class="fbth-tab-img">
                                                    <?php echo '<img src="' . $value['fbth_tab_image']['url'] . '">'; ?>
                                                 </div>
                                            </div>
                                            <?php endif; ?>
                                            <?php if ( 'number' == $value['fbth_tab_icon_type']) : ?>
                                            <div class="tab-list-content-icon">
                                                <div class="fbth-tab-number">
                                                    <span class="tab-number" ><?php echo '0'.$value['fbth_tab_number']; ?></span>
                                                 </div>
                                            </div>
                                            <?php endif; ?>
                                            <div class="tab-list-content">
                                                <?php if ($value['button_text']) : ?>
                                                    <span><?php echo esc_html($value['button_text']); ?></span>
                                                <?php endif; ?>
                                                <?php if ($value['button_content']) : ?>
                                                    <div class="fbth-tab-list-content">
                                                        <p><?php echo esc_html($value['button_content']); ?></p>
                                                    </div>
                                                <?php endif; ?>

                                            </div>

                                        <?php endforeach;
                                    $key++ ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-7 col-xl-7 col-lg-10 col-md-12">
                        <div class="fbth--tab-right">
                            <?php foreach ($tab_list as $key => $value) :
                                $active = $value['active_tabs'] == 'yes' ? 'current' : '';
                            ?>
                                <div id="tab-<?php echo esc_attr($key . $tab_id) ?>" class="fbth-tabs-content-single animated fadeIn  <?php echo esc_attr($active) ?>">
                                   
                                    <div class="fbth--tab-content">
                                        <div class="tab-content-image fbth-tab-image">
                                            <?php echo wp_get_attachment_image($value['content_image']['id'], 'full'); ?>
                                            <!-- /.tab tab  -->
                                            <?php 
                                            if ('youtube' === $value['fbth_tab_type']) {

                                                $url = $value['fbth_tab_youtube_video_url'];
                                                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches);
                                                $youtube_id = $matches[1];

                                                }

                                                if ('vimeo' === $value['fbth_tab_type']) {
                                                $vimeo_url       = $value['fbth_tab_vimeo_video_url'];
                                                $vimeo_id_select = explode('/', $vimeo_url);
                                                $vidid           = explode('&', str_replace('https://vimeo.com', '', end($vimeo_id_select)));
                                                $vimeo_id        = $vidid[0];

                                                }
                                            ?>
                                            <?php if ( 'yes' == $value['show_tab_btn'] ): ?>
                                               
                                                <div class="fbth-tab">

                                                    <div class="fbth-tab-modal-wrapper">
                                                        <div class="fbth-tab-button">
                                                            <a href="#" <?php echo $this->get_render_attribute_string('fbth_tab_action'); ?> data-fbth-tab=<?php echo "#fbth-tab-".$tab_id.$key ?> >
                                                            <span class="fbth-tab-modal-icon">
                                                                <?php Icons_Manager::render_icon($value['fbth_tab_btn_icon'], ['aria-hidden' => 'true']); ?>
                                                            </span>
                                                            </a>
                                                        </div>

                                                        <div id="fbth-tab-<?php echo esc_attr( $tab_id.$key ); ?>" <?php echo $this->get_render_attribute_string('fbth_tab_item'); ?>>
                                                            <div class="fbth-tabs-content">
                                                                <div class="fbth-tab-element <?php echo esc_attr($value['fbth_tab_image_gallery_column']); ?>">

                                                                    <?php 

                                                                    if ('youtube' === $value['fbth_tab_type']) { ?>

                                                                        <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>" frameborder="0" allowfullscreen></iframe>

                                                                    <?php }

                                                                    if ('vimeo' === $value['fbth_tab_type']) { ?>

                                                                        <iframe id="vimeo-video" src="https://player.vimeo.com/video/<?php echo esc_attr($vimeo_id); ?>" frameborder="0" allowfullscreen></iframe>

                                                                    <?php }



                                                                    if ('external-video' === $value['fbth_tab_type']) { ?>

                                                                        <video class="fbth-video-hosted" src="<?php echo esc_url($value['fbth_tab_external_video']['url']); ?>" controls="" controlslist="nodownload">

                                                                        </video>

                                                                    <?php } ?>

                                                                    <div class="fbth-close-btn">

                                                                        <span></span>

                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div <?php echo $this->get_render_attribute_string('fbth_tab_overlay'); ?>></div>

                                                </div>
                                               
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;
                            $key++ ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- STYLE TWO -->
            <?php if ($settings['tab_style'] == 'style-two') : ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="fbth--tab-left">
                            <div class="fbth--tab-menu style-two">
                                <ul class="tabs">
                                    <?php foreach ($tab_two as $key => $value) :
                                        $active = $value['active_tabs'] == 'yes' ? 'current' : '';
                                    ?>
                                        <li class="tab-link <?php echo esc_attr($active) ?>" data-tab="tab-<?php echo esc_attr($key . $tab_id) ?>">

                                            <?php if ($value['button_text_two']) : ?>
                                                <span><?php echo esc_html($value['button_text_two']); ?></span>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach;
                                    $key++ ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fbth--tab-content-two-wrap <?php echo esc_html($settings['tab_style']) ?>">
                    <?php foreach ($tab_two as $key => $value) :
                        $active = $value['active_tabs'] == 'yes' ? 'current' : '';
                        $image = wp_get_attachment_image_url($value['tab_imgae']['id'], 'full');
                        if (!$image) {
                            $image = Utils::get_placeholder_image_src();
                        };
                    ?>
                        <div id="tab-<?php echo esc_attr($key . $tab_id) ?>" class="fbth-tabs-content-single animated fadeIn  <?php echo esc_attr($active) ?>">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="fbth-tab-image">
                                        <img src="<?php echo esc_url($image) ?>" alt="">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="fbth-tabs-content-iconbox">

                                        <div class="fbth-tab-big-heading">
                                            <h2><?php echo esc_html($value['big_headding']); ?></h2>
                                        </div>
                                        <div class="fbth--tab-content">
                                            <?php if ($value['list_icon']) : ?>
                                                <div class="fbth-tab-icon">
                                                    <?php \Elementor\Icons_Manager::render_icon($value['list_icon'], ['aria-hidden' => 'true']); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="fbth-icon-content">
                                                <h3><?php echo esc_html($value['tab_headding_one']) ?></h3>
                                                <?php echo fbth_get_meta($value['tab_content_one']); ?>
                                            </div>

                                        </div>
                                        <div class="fbth--tab-content">
                                            <?php if ($value['list_icon']) : ?>
                                                <div class="fbth-tab-icon">
                                                    <?php \Elementor\Icons_Manager::render_icon($value['list_icon_two'], ['aria-hidden' => 'true']); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="fbth-icon-content">
                                                <h3><?php echo esc_html($value['tab_headding_two']) ?></h3>
                                                <?php echo fbth_get_meta($value['tab_content_two']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                    $key++ ?>
                </div>
            <?php endif; ?>
        </div>
<?php
    }
}
$widgets_manager->register(new \FBTHTab());
