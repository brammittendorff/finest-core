<?php

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly
/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */

use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use  Elementor\Group_Control_Background;

class FBTH_Pass extends \Elementor\Widget_Base
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
        return 'fbth-reset-pass';
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
        return __('Reset Password', 'fbth-addons');
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
        return 'eicon-lock-user';
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
            'section_lost_password',
            [
                'label'         => __('Form', 'fd-addons'),
            ]
        );

        $this->add_control(
            'show_message',
            [
                'label'         => __('Show Message', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::SWITCHER,
                'default'         => 'yes',
            ]
        );

        $this->add_control(
            'message',
            [
                'label'           => __('Message', 'fd-addons'),
                'type'            => \Elementor\Controls_Manager::TEXTAREA,
                'default'        => __('Please enter your username or email address. You will receive a link to create a new password via email.', 'fd-addons'),
                'condition'        => [
                    'show_message' => 'yes'
                ],
                'dynamic'         => ['active' => true],
            ]
        );

        $this->add_control(
            'label_heading',
            [
                'label'         => __('Label', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::HEADING,
                'separator'     => 'before',
            ]
        );

        $this->add_control(
            'show_label',
            [
                'label'         => __('Show Label', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::SWITCHER,
                'default'         => 'yes',
            ]
        );

        $this->add_control(
            'user_label',
            [
                'label'         => __('Username', 'fd-addons'),
                'type'            => \Elementor\Controls_Manager::TEXT,
                'default'        => __('Username or Email', 'fd-addons'),
                'label_block' => true,
                'condition'        => [
                    'show_label' => 'yes'
                ],
                'dynamic'         => ['active' => true],
            ]
        );

        $this->add_control(
            'placeholder_heading',
            [
                'label'         => __('Placeholders', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::HEADING,
                'separator'     => 'before',
            ]
        );

        $this->add_control(
            'show_placeholders',
            [
                'label'         => __('Show Placeholders', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::SWITCHER,
                'default'         => 'yes',
            ]
        );

        $this->add_control(
            'user_placeholder',
            [
                'label'         => __('Username', 'fd-addons'),
                'type'            => \Elementor\Controls_Manager::TEXT,
                'default'        => __('Username or Email Address', 'fd-addons'),
                'label_block' => true,
                'condition'        => [
                    'show_placeholders' => 'yes'
                ],
                'dynamic'         => ['active' => true],
            ]
        );

        $this->add_control(
            'submit_heading',
            [
                'label'         => __('Submit Button', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::HEADING,
                'separator'     => 'before',
            ]
        );

        $this->add_control(
            'submit_text',
            [
                'label'         => __('Text', 'fd-addons'),
                'type'            => \Elementor\Controls_Manager::TEXT,
                'default'        => __('Get New Password', 'fd-addons'),
                'dynamic'         => ['active' => true],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'login_heading',
            [
                'label'         => __('Login Link', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::HEADING,
                'separator'     => 'before',
            ]
        );

        $this->add_control(
            'show_login',
            [
                'label'         => __('Show Link', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::SWITCHER,
                'default'         => 'yes',
            ]
        );

        $this->add_control(
            'login_text',
            [
                'label'         => __('Text', 'fd-addons'),
                'type'            => \Elementor\Controls_Manager::TEXT,
                'default'        => __('Back to the Login Page', 'fd-addons'),
                'label_block' => true,
                'dynamic'         => ['active' => true],
            ]
        );

        $this->add_control(
            'login_link',
            [
                'label'           => __('Link', 'fd-addons'),
                'type'            => \Elementor\Controls_Manager::URL,
                'placeholder'     => __('https://your-link.com', 'fd-addons'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_login_content',
            [
                'label'         => __('Additional Options', 'fd-addons'),
            ]
        );

        $this->add_control(
            'redirect_after_lost_password',
            [
                'label'         => __('Redirect After Login', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::SWITCHER,
                'default'         => 'off',
            ]
        );

        $this->add_control(
            'redirect_url',
            [
                'type'             => \Elementor\Controls_Manager::URL,
                'show_label'     => false,
                'show_external' => false,
                'separator'     => false,
                'placeholder'     => 'http://your-link.com/',
                'description'     => __('Note: Because of security reasons, you can ONLY use your current domain here.', 'fd-addons'),
                'condition'     => [
                    'redirect_after_lost_password' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_logged_in_message',
            [
                'label'         => __('Logged in Message', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::SWITCHER,
                'default'         => 'yes',
                'label_off'     => __('Hide', 'fd-addons'),
                'label_on'         => __('Show', 'fd-addons'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_label_style',
            [
                'label'         => __('Label', 'fd-addons'),
                'tab'             => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'             => 'label_typo',
                'selector'         => '{{WRAPPER}} .fd-addons-form label',
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label'         => __('Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'label_spacing',
            [
                'label'         => __('Spacing', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::SLIDER,
                'range'         => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'             => 'label_text_shadow',
                'selector'         => '{{WRAPPER}} .fd-addons-form label',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_message_style',
            [
                'label'         => __('Message Box', 'fd-addons'),
                'tab'             => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
		
		  $this->add_responsive_control(
            'message_form_style_align',
            [
                'label' => __('Alignment', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'fd-addons'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'fd-addons'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'fd-addons'),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'fd-addons'),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} p.fd-addons-form-message' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'message_background',
            [
                'label'         => __('Background Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form-message' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'message_color',
            [
                'label'         => __('Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form-message' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'             => 'message_typo',
                'selector'         => '{{WRAPPER}} .fd-addons-form-message',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'             => 'message_border',
                'label'         => __('Border', 'fd-addons'),
                'selector'         => '{{WRAPPER}} .fd-addons-form-message',
            ]
        );

        $this->add_responsive_control(
            'message_border_radius',
            [
                'label'         => __('Border Radius', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'     => ['px', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'message_padding',
            [
                'label'         => __('Padding', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'     => ['px', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'             => 'message_box_shadow',
                'selector'         => '{{WRAPPER}} .fd-addons-form-message',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_field_style',
            [
                'label'         => __('Field', 'fd-addons'),
                'tab'             => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_field_style');

        $this->start_controls_tab(
            'tab_field_normal',
            [
                'label'         => __('Normal', 'fd-addons'),
            ]
        );

        $this->add_control(
            'field_background',
            [
                'label'         => __('Background Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-input' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'field_color',
            [
                'label'         => __('Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-input' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'field_placeholder_color',
            [
                'label'         => __('Placeholder Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-input::-webkit-input-placeholder' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fd-addons-form .fd-addons-input::-moz-placeholder'          => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fd-addons-form .fd-addons-input:-ms-input-placeholder'      => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'             => 'field_typo',
                'selector'         => '{{WRAPPER}} .fd-addons-form .fd-addons-input',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'             => 'field_box_shadow',
                'selector'         => '{{WRAPPER}} .fd-addons-form .fd-addons-input',
            ]
        );
        $this->add_responsive_control(
            'input_width',
            [
                'label'      => __('Width', 'fd-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-input' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'input_height',
            [
                'label'      => __('Height', 'fd-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-input' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'             => 'field_border',
                'label'         => __('Border', 'fd-addons'),
                'selector'         => '{{WRAPPER}} .fd-addons-form .fd-addons-input',
            ]
        );


        $this->add_responsive_control(
            'field_border_radius',
            [
                'label'         => __('Border Radius', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'     => ['px', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_padding',
            [
                'label'         => __('Padding', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'     => ['px', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_margin',
            [
                'label'         => __('Margin', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'     => ['px', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_field_hover',
            [
                'label'         => __('Hover', 'fd-addons'),
            ]
        );

        $this->add_control(
            'field_hover_background',
            [
                'label'         => __('Background Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-input:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'field_hover_color',
            [
                'label'         => __('Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-input:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'field_hover_border_color',
            [
                'label'         => __('Border Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-input:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_field_focus',
            [
                'label'         => __('Focus', 'fd-addons'),
            ]
        );

        $this->add_control(
            'field_focus_background',
            [
                'label'         => __('Background Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-input:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'field_focus_color',
            [
                'label'         => __('Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-input:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'field_focus_border_color',
            [
                'label'         => __('Border Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-input:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();



        $this->end_controls_section();

        $this->start_controls_section(
            'section_button_style',
            [
                'label'         => __('Button', 'fd-addons'),
                'tab'             => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label'         => __('Normal', 'fd-addons'),
            ]
        );

        $this->add_control(
            'button_background',
            [
                'label'         => __('Background Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-buttons .fd-addons-submit .fd-addons-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'         => __('Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-buttons .fd-addons-submit .fd-addons-button' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'             => 'button_typo',
                'selector'         => '{{WRAPPER}} .fd-addons-form .fd-addons-buttons .fd-addons-button',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'             => 'button_box_shadow',
                'selector'         => '{{WRAPPER}} .fd-addons-form .fd-addons-buttons .fd-addons-button',
            ]
        );
        $this->add_responsive_control(
            'button_width',
            [
                'label'      => __('Width', 'fd-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-buttons .fd-addons-button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_height',
            [
                'label'      => __('Height', 'fd-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-buttons .fd-addons-button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'             => 'button_border',
                'label'         => __('Border', 'fd-addons'),
                'selector'         => '{{WRAPPER}} .fd-addons-form .fd-addons-buttons .fd-addons-button',
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label'         => __('Border Radius', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'     => ['px', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-buttons .fd-addons-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label'         => __('Margin', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'     => ['px', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-buttons .fd-addons-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'         => __('Padding', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'     => ['px', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-buttons .fd-addons-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label'         => __('Hover', 'fd-addons'),
            ]
        );

        $this->add_control(
            'button_hover_background',
            [
                'label'         => __('Background Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-buttons .fd-addons-submit .fd-addons-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label'         => __('Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-buttons .fd-addons-submit .fd-addons-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label'         => __('Border Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-buttons .fd-addons-submit .fd-addons-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'             => 'button_hover_box_shadow',
                'selector'         => '{{WRAPPER}} .fd-addons-form .fd-addons-buttons .fd-addons-submit .fd-addons-button:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        



        $this->end_controls_section();

        $this->start_controls_section(
            'section_link_style',
            [
                'label'         => __('Login Link', 'fd-addons'),
                'tab'             => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_link_style');

        $this->start_controls_tab(
            'tab_link_normal',
            [
                'label'         => __('Normal', 'fd-addons'),
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label'         => __('Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-link a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_link_hover',
            [
                'label'         => __('Hover', 'fd-addons'),
            ]
        );

        $this->add_control(
            'link_hover_color',
            [
                'label'         => __('Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-link a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'             => 'link_typo',
                'selector'         => '{{WRAPPER}} .fd-addons-form .fd-addons-link a',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_privacy_link_style',
            [
                'label'         => __('Privacy Policy', 'fd-addons'),
                'tab'             => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_privacy_link_style');

        $this->start_controls_tab(
            'tab_privacy_link_normal',
            [
                'label'         => __('Normal', 'fd-addons'),
            ]
        );

        $this->add_control(
            'privacy_link_color',
            [
                'label'         => __('Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-privacy a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_privacy_link_hover',
            [
                'label'         => __('Hover', 'fd-addons'),
            ]
        );

        $this->add_control(
            'privacy_link_hover_color',
            [
                'label'         => __('Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fd-addons-form .fd-addons-privacy a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'             => 'privacy_link_typo',
                'selector'         => '{{WRAPPER}} .fd-addons-form .fd-addons-privacy a',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'fbth_login_form_style_section',
            [
                'label' => __('Box', 'fd-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'reset_form_style_align',
            [
                'label' => __('Alignment', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'fd-addons'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'fd-addons'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'fd-addons'),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'fd-addons'),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-reset-button' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'reset_form_section_background',
                'label' => __('Background', 'fd-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .fbth-reset-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'reset_form_section_box_shadow',
                'label' => __('Box Shadow', 'fd-addons'),
                'selector' => '{{WRAPPER}} .fbth-reset-button',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .fbth-reset-button',
            ]
        );

        $this->add_responsive_control(
            'reset_form_section_radius',
            [
                'label' => __('Radius', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-reset-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'reset_form_section_margin',
            [
                'label' => __('Margin', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-reset-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'reset_form_section_padding',
            [
                'label' => __('Padding', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-reset-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings                 = $this->get_settings_for_display();
        $current_url             = remove_query_arg('fake_arg');
        $show_login             = 'yes' === $settings['show_login'];

        if ('yes' === $settings['redirect_after_lost_password'] && !empty($settings['redirect_url']['url'])) {
            $redirect_url = $settings['redirect_url']['url'];
        } else {
            $redirect_url = $current_url;
        }

        if (is_user_logged_in() && !\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            if ('yes' === $settings['show_logged_in_message']) {
                $current_user = wp_get_current_user();

                echo '<div class="fd-addons-login">' .
                    sprintf(__('You are Logged in as %1$s (<a href="%2$s">Logout</a>)', 'fd-addons'), $current_user->display_name, wp_logout_url($current_url)) .
                    '</div>';
            }

            return;
        }

        // Field
        $this->add_render_attribute('user_label', 'for', 'fd-addons_user_lost_password');
        $this->add_render_attribute('user_input', [
            'type'    => 'text',
            'name'    => 'user_login',
            'id'    => 'fd-addons_user_lost_password',
            'class' => [
                'fd-addons-username',
                'fd-addons-input',
            ],
        ]);

        // Placeholders
        if ($settings['show_placeholders']) {
            $this->add_render_attribute('user_input', 'placeholder', $settings['user_placeholder']);
        }

        // Login link
        if (!empty($settings['login_link']['url'])) {
            $this->add_render_attribute('login_link', 'href', $settings['login_link']['url']);

            if ($settings['login_link']['is_external']) {
                $this->add_render_attribute('login_link', 'target', '_blank');
            }

            if ($settings['login_link']['nofollow']) {
                $this->add_render_attribute('login_link', 'rel', 'nofollow');
            }
        } else {
            $this->add_render_attribute('login_link', 'href', wp_login_url($redirect_url));
        }

        // Register/login
        $this->add_render_attribute('buttons', [
            'class' => [
                'fd-addons-buttons',
                'clr',
            ],
        ]);

        $this->add_render_attribute('submit', 'class', 'fd-addons-submit');

        if ($settings['show_message']) {
            echo '<p class="fd-addons-form-message">' . $settings['message'] . '</p>';
        } ?>
        <div class="fbth-reset-button">
            <form class="fd-addons-form" method="post" action="<?php echo wp_lostpassword_url(); ?>">
                <p class="fd-addons-username">
                    <?php
                    if ($settings['show_label']) {
                        echo '<label ' . $this->get_render_attribute_string('user_label') . '>' . $settings['user_label'] . '</label>';
                    }

                    echo '<input ' . $this->get_render_attribute_string('user_input') . ' size="1">'; ?>
                </p>

                <?php do_action('lostpassword_form'); ?>

                <div <?php echo $this->get_render_attribute_string('buttons'); ?>>
                    <div <?php echo $this->get_render_attribute_string('submit'); ?>>
                        <input type="submit" class="fd-addons-button" value="<?php echo esc_attr($settings['submit_text']); ?>" />
                    </div>
                </div>

                <?php
                if ($show_login) {
                    echo '<div class="fd-addons-link">';
                    echo '<a ' . $this->get_render_attribute_string('login_link') . '>' . $settings['login_text'] . '</a>';
                    echo '</div>';
                } ?>

            
                <input type="hidden" name="redirect_to" value="<?php echo esc_url($redirect_url); ?>" />
                <input type="hidden" name="action" value="lostpassword" />
            </form>
        </div>

<?php
    }
}
$widgets_manager->register(new FBTH_Pass());
