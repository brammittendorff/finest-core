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

use  Elementor\Group_Control_Typography;
use  Elementor\Group_Control_Box_Shadow;
use  Elementor\Group_Control_Background;
use  Elementor\Group_Control_Border;
use  Elementor\Plugin;

class FBTH_Login extends \Elementor\Widget_Base
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
        return 'fbth-login';
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
        return __('Sign In', 'fbth-hp');
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
            'user_login_form_content',
            [
                'label' => __('Login Form', 'fd-addons'),
            ]
        );

        $this->add_control(
            'fbth_form_show_password',
            [
                'label' => esc_html__('Show Password', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_off' => esc_html__('Hide', 'fd-addons'),
                'label_on' => esc_html__('Show', 'fd-addons'),
            ]
        );
        $this->add_control(
            'fbth_form_show_label',
            [
                'label' => esc_html__('Label', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_off' => esc_html__('Hide', 'fd-addons'),
                'label_on' => esc_html__('Show', 'fd-addons'),
            ]
        );

        $this->add_control(
            'fbth_form_show_customlabel',
            [
                'label' => esc_html__('Custom label', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Hide', 'fd-addons'),
                'label_on' => esc_html__('Show', 'fd-addons'),
                'condition' => [
                    'fbth_form_show_label' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'fbth_user_label',
            [
                'label'     => esc_html__('Username Label', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__('Username or Email', 'fd-addons'),
                'condition' => [
                    'fbth_form_show_label'   => 'yes',
                    'fbth_form_show_customlabel' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'fbth_user_placeholder',
            [
                'label'     => esc_html__('Username Placeholder', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__('Username or Email', 'fd-addons'),
                'condition' => [
                    'fbth_form_show_label'   => 'yes',
                    'fbth_form_show_customlabel' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'fbth_password_label',
            [
                'label'     => esc_html__('Password Label', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__('Password', 'fd-addons'),
                'condition' => [
                    'fbth_form_show_label'   => 'yes',
                    'fbth_form_show_customlabel' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'fbth_password_placeholder',
            [
                'label'     => __('Password Placeholder', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => __('Password', 'fd-addons'),
                'condition' => [
                    'fbth_form_show_label'   => 'yes',
                    'fbth_form_show_customlabel' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'redirect_page',
            [
                'label' => __('Redirect page after Login', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => __('No', 'fd-addons'),
                'label_on' => __('Yes', 'fd-addons'),
            ]
        );

        $this->add_control(
            'redirect_page_url',
            [
                'type'          => \Elementor\Controls_Manager::URL,
                'show_label'    => false,
                'show_external' => false,
                'separator'     => false,
                'placeholder'   => 'http://your-link.com/',
                'condition'     => [
                    'redirect_page' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'lost_password',
            [
                'label'     => esc_html__('Lost your password?', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_off' => esc_html__('Hide', 'fd-addons'),
                'label_on'  => esc_html__('Show', 'fd-addons'),
            ]
        );
        $this->add_control(
            'lostpass_link_text',
            [
                'label' => __('Lost Password Text', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Forgot Password?', 'fd-addons'),
                'label_block' => true,
                'condition'     => [
                    'lost_password' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'fbth_forget_button_existing_link',
            [
                'label'         => __('Select Reset Password Page ', 'fd_addons'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'options'       => fbth_get_all_pages(),
                'condition'     => [
                    'lost_password'     => 'yes',
                ],
                'multiple'      => false,
                'label_block'   => true,
            ]
        );
        $this->add_control(
            'remember_me',
            [
                'label'     => esc_html__('Remember Me', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_off' => esc_html__('Hide', 'fd-addons'),
                'label_on'  => esc_html__('Show', 'fd-addons'),
            ]
        );
        $this->add_control(
            'remember_me_heading',
            [
                'label' => __('Remember Me Text', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Remember Me', 'fd-addons'),
                'label_block' => true,
            ]
        );
        if (get_option('users_can_register')) {
            $this->add_control(
                'register_link',
                [
                    'label'     => esc_html__('Register', 'fd-addons'),
                    'type'      => \Elementor\Controls_Manager::SWITCHER,
                    'default'   => 'no',
                    'label_off' => esc_html__('Hide', 'fd-addons'),
                    'label_on'  => esc_html__('Show', 'fd-addons'),
                ]
            );

            $this->add_control(
                'register_text',
                [
                    'label' => __('Register Text', 'fd-addons'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __('All ready have account?', 'fd-addons'),
                    'label_block' => true,
                    'condition'     => [
                        'register_link' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'register_link_text',
                [
                    'label' => __('Register Link Text', 'fd-addons'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __('Create a free account', 'fd-addons'),
                    'label_block' => true,
                    'condition'     => [
                        'register_link' => 'yes',
                    ],
                ]
            );
        }

        $this->add_control(
            'fbth_reg_button_existing_link',
            [
                'label'         => __('Select Register Page ', 'fd_addons'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'options'       => fbth_get_all_pages(),
                'condition'     => [
                    'register_link'     => 'yes',
                ],
                'multiple'      => false,
                'label_block'   => true,
            ]
        );


        $this->add_control(
            'login_button_heading',
            [
                'label' => __('Login Button', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'login_button_text',
            [
                'label' => __('Button Text', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Login', 'fd-addons'),
                'label_block' => true,
            ]
        );


        $this->end_controls_section();

        // Style tab section

        $this->start_controls_section(
            'fbth_login_showpass_style',
            [
                'label' => __('Show Password', 'fd-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'fbth_form_show_password' => 'yes',
                ]
            ]

        );
        $this->add_responsive_control(
            'show-position-x',
            [
                'label' => __('Position X', 'fd-addons'),
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
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .toggle-password' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'showpass-position-y',
            [
                'label' => __('Position Y', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 0,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .toggle-password' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();



        $this->start_controls_section(
            'login_form_style_input',
            [
                'label' => __('Input', 'fd-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
            'login_form_input_text_color',
            [
                'label'     => __('Text Color', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper input'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'login_form_input_placeholder_color',
            [
                'label'     => __('Placeholder Color', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper input[type*="text"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .fbth-login-form-wrapper input[type*="text"]::-moz-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .fbth-login-form-wrapper input[type*="text"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .fbth-login-form-wrapperinput[type*="password"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .fbth-login-form-wrapper input[type*="password"]::-moz-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .fbth-login-form-wrapper input[type*="password"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .fbth-login-form-wrapperinput[type*="email"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .fbth-login-form-wrapper input[type*="email"]::-moz-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .fbth-login-form-wrapper input[type*="email"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'login_form_input_typography',
                'selector' => '{{WRAPPER}} .fbth-login-form-wrapper input',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'login_form_input_background',
                'label' => __('Background', 'fd-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .fbth-login-form-wrapper input',
            ]
        );

        $this->add_control(
            'login_form_input_height',
            [
                'label' => __('Height', 'fd-addons'),
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
                    'unit' => 'px',
                    'size' => 56,
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper input[type="text"],{{WRAPPER}} .fbth-login-form-wrapper input[type="password"]' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'login_form_input_border',
                'label' => __('Border', 'fd-addons'),
                'selector' => '{{WRAPPER}} .fbth-login-form-wrapper input',
            ]
        );

        $this->add_responsive_control(
            'login_form_input_border_radius',
            [
                'label' => esc_html__('Border Radius', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper input' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'login_form_input_margin',
            [
                'label' => __('Margin', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-login-form-wrapper input' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'login_form_input_padding',
            [
                'label' => __('Padding', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-login-form-wrapper input' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .fbth-login-form-wrapper input:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'field_focus_color',
            [
                'label'         => __('Color', 'fd-addons'),
                'type'             => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .fbth-login-form-wrapper input:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'login_form_input_border_focus',
                'label' => __('Border', 'fd-addons'),
                'selector' => '{{WRAPPER}} .fbth-login-form-wrapper input:focus',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // Label Style Start
        $this->start_controls_section(
            'login_form_style_label',
            [
                'label' => __('Label', 'fd-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'login_form_label_align',
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
                    '{{WRAPPER}} .fbth-login-form-wrapper label' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
            ]
        );

        $this->add_control(
            'login_form_label_text_color',
            [
                'label'     => __('Color', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper label'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .fbth-login-form-wrapper .login_register_text'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'login_form_label_typography',
                'selector' => '{{WRAPPER}} .fbth-login-form-wrapper label,{{WRAPPER}} .fbth-login-form-wrapper .login_register_text',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'login_form_label_background',
                'label' => __('Background', 'fd-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .fbth-login-form-wrapper label',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'login_form_label_border',
                'label' => __('Border', 'fd-addons'),
                'selector' => '{{WRAPPER}} .fbth-login-form-wrapper label',
            ]
        );

        $this->add_responsive_control(
            'login_form_label_margin',
            [
                'label' => __('Margin', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-login-form-wrapper label' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'login_form_label_padding',
            [
                'label' => __('Padding', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-login-form-wrapper label' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'login_form_label_border_radius',
            [
                'label' => esc_html__('Border Radius', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper label' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    'body.rtl {{WRAPPER}} .fbth-login-form-wrapper label' => 'border-radius: {{TOP}}px {{LEFT}}px {{BOTTOM}}px {{RIGHT}}px;',
                ],
            ]
        );
        $this->end_controls_section();

        // Rememberme section start
        $this->start_controls_section(
            'login_form_style_rememberme',
            [
                'label' => __('Remember Me Checkbox', 'fd-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'login_form_input_rememberme_typography',
                'selector' => '{{WRAPPER}} .fbth-login-form-wrapper form .log-remember label',
            ]
        );

        // $this->add_control(
        //     'login_form_input_rememberme_height',
        //     [
        //         'label' => __( 'Height', 'fd-addons' ),
        //         'type' => \Elementor\Controls_Manager::SLIDER,
        //         'size_units' => [ 'px', '%' ],
        //         'range' => [
        //             'px' => [
        //                 'min' => 0,
        //                 'max' => 200,
        //                 'step' => 1,
        //             ],
        //             '%' => [
        //                 'min' => 0,
        //                 'max' => 100,
        //             ],
        //         ],
        //         'default' => [
        //             'unit' => 'px',
        //             'size' => 20,
        //         ],
        //         'selectors' => [
        //             '{{WRAPPER}} .fbth-login-form-wrapper form .log-remember label input[type="checkbox"]' => 'height: {{SIZE}}{{UNIT}};',
        //         ],
        //     ]
        // );

        $this->add_responsive_control(
            'login_form_input_rememberme_margin',
            [
                'label' => __('Margin', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper form .log-remember label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    'body.rtl {{WRAPPER}} .fbth-login-form-wrapper form .log-remember label' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_control(
            'login_form_input_rememberme_color',
            [
                'label'     => __('Color', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper form .log-remember label'   => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section(); // Checkbox section end

        // foget password text
        $this->start_controls_section(
            'forget_forget_content',
            [
                'label' => __('Forget', 'fd-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'forget_typo',
                'selector' => '{{WRAPPER}} .forgetpassword',
            ]
        );
        $this->add_control(
            'forgetpass_color',
            [
                'label'     => __('Color', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .forgetpassword'   => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'forgetpass_margin',
            [
                'label' => __('Margin', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .forgetpassword' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .forgetpassword' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'forgetpass_positions',
            [
                'label' => __('Positions', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'Relative'  => __('Relative', 'fd-addons'),
                    'fixed' => __('Fixed', 'fd-addons'),
                    'absolute' => __('Absolute', 'fd-addons'),
                    'static' => __('Static', 'fd-addons'),
                    'none' => __('None', 'fd-addons'),
                ],
            ]
        );

        $this->add_responsive_control(
            'forgetpass-position-x',
            [
                'label' => __('Position X', 'fd-addons'),
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
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .forgetpassword' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'forgetpass_positions' => 'absolute',
                ]
            ]
        );

        $this->add_responsive_control(
            'forgetpass-position-y',
            [
                'label' => __('Position Y', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 0,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .forgetpassword' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'forgetpass_positions' => 'absolute',
                ]
            ]
        );

        $this->end_controls_section();

        // Registar Page text
        $this->start_controls_section(
            'forget_reg_content',
            [
                'label' => __('Register', 'fd-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'forget_reg_content_align',
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
                    '{{WRAPPER}} .finists-reg-link' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'reg_typo',
                'selector' => '
                {{WRAPPER}} .finists-reg-link, 
                {{WRAPPER}} .finists-reg-link a',
            ]
        );
        $this->add_control(
            'regtext_color',
            [
                'label'     => __('Color', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .finists-reg-link'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'regtext_a_color',
            [
                'label'     => __('Link Color', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .finists-reg-link a'   => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'regtext_margin',
            [
                'label' => __('Margin', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .finists-reg-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .finists-reg-link' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Submit Button
        $this->start_controls_section(
            'login_form_style_submit_button',
            [
                'label' => __('Submit Button', 'fd-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Button Tabs Start
        $this->start_controls_tabs('login_form_style_submit_tabs');

        // Start Normal Submit button tab
        $this->start_controls_tab(
            'login_form_style_submit_normal_tab',
            [
                'label' => __('Normal', 'fd-addons'),
            ]
        );

        $this->add_control(
            'login_form_submitbutton_text_color',
            [
                'label'     => __('Color', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'login_form_submitbutton_typography',
                'selector' => '{{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]',
            ]
        );

        $this->add_control(
            'login_form_submitbutton_background',
            [
                'label'     => __('Background Color', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]'   => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'login_form_button_shadow',
                'label' => __('Box Shadow', 'fd-addons'),
                'selector' => '{{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'login_form_submitbutton_border',
                'label' => __('Border', 'fd-addons'),
                'selector' => '{{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]',
            ]
        );

        $this->add_control(
            'login_form_submitbutton_height',
            [
                'label' => __('Height', 'fd-addons'),
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
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'login_form_submitbutton_width',
            [
                'label' => __('Weight', 'fd-addons'),
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
                    '{{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'login_form_submitbutton_border_radius',
            [
                'label' => esc_html__('Border Radius', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    'body.rtl {{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]' => 'border-radius: {{TOP}}px {{LEFT}}px {{BOTTOM}}px {{RIGHT}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'login_form_submitbutton_margin',
            [
                'label' => __('Margin', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'login_form_submitbutton_padding',
            [
                'label' => __('Padding', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab(); // Normal submit Button tab end

        // Start Hover Submit button tab
        $this->start_controls_tab(
            'login_form_style_submit_hover_tab',
            [
                'label' => __('Hover', 'fd-addons'),
            ]
        );

        $this->add_control(
            'login_form_submitbutton_hover_text_color',
            [
                'label'     => __('Color', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]:hover'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'login_form_submitbutton_hover_background',
                'label' => __('Background', 'fd-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]:hover',
            ]
        );

        $this->add_control(
            'login_form_submitbutton_hover_background',
            [
                'label'     => __('Background Color', 'fd-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]:hover'   => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'login_form_button_shadow_hover',
                'label' => __('Box Shadow Hover', 'fd-addons'),
                'selector' => '{{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'login_form_submitbutton_hover_border',
                'label' => __('Border', 'fd-addons'),
                'selector' => '{{WRAPPER}} .fbth-login-form-wrapper input[type="submit"]:hover',
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'hrtwo',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->end_controls_tab(); // Hover Submit Button tab End
        $this->end_controls_tabs(); // Button Tabs End



        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'fbth_login_form_style_section',
            [
                'label' => __('Box', 'fd-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'login_form_style_align',
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
                    '{{WRAPPER}} .fbth-login-form-wrapper' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'login_form_section_background',
                'label' => __('Background', 'fd-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .fbth-login-form-wrapper',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'login_form_section_box_shadow',
                'label' => __('Box Shadow', 'fd-addons'),
                'selector' => '{{WRAPPER}} .fbth-login-form-wrapper',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .fbth-login-form-wrapper',
            ]
        );

        $this->add_responsive_control(
            'login_form_section_radius',
            [
                'label' => __('Radius', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'login_form_section_margin',
            [
                'label' => __('Margin', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'login_form_section_padding',
            [
                'label' => __('Padding', 'fd-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-login-form-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-login-form-wrapper' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render($instance = [])
    {

        $settings   = $this->get_settings_for_display();

        $pages_link = get_permalink($settings['fbth_reg_button_existing_link']);
        $resetpage_link = get_permalink($settings['fbth_forget_button_existing_link']);

        //registar page
        $wp_default_link = wp_registration_url();
        if (!empty($pages_link)) {
            $button_link = $pages_link;
        } else {
            $button_link = $wp_default_link;
        };

        // reset page
        $wp_resetpage_link   = wp_lostpassword_url();
        if (!empty($resetpage_link)) {
            $reset_link = $resetpage_link;
        } else {
            $reset_link =  $wp_resetpage_link;
        };

        $current_url = remove_query_arg('fake_arg');


        $id = $this->get_id();
        $home_url = \home_url();

        if ($settings['redirect_page'] == 'yes' && !empty($settings['redirect_page_url']['url'])) {
            $redirect_url = $settings['redirect_page_url']['url'];
        } else {
            $redirect_url = $home_url;
        }

        $this->add_render_attribute('loginform_area_attr', 'class', 'fbth-login-form-wrapper');

        // Label Value
        $user_label = isset($settings['fbth_user_label']) ? $settings['fbth_user_label'] : __('Username', 'fd-addons');
        $user_placeholder = isset($settings['fbth_user_placeholder']) ? $settings['fbth_user_placeholder'] : __('Username', 'fd-addons');
        $pass_label = isset($settings['fbth_password_label']) ? $settings['fbth_password_label'] : __('Password', 'fd-addons');
        $pass_placeholder = isset($settings['fbth_password_placeholder']) ? $settings['fbth_password_placeholder'] : __('Password', 'fd-addons');

?>
        <div <?php echo $this->get_render_attribute_string('loginform_area_attr'); ?>>

            <div id="fbth_message_<?php echo esc_attr($id); ?>" class="fbth_message">&nbsp;</div>

            <?php
            if (is_user_logged_in() && !Plugin::instance()->editor->is_edit_mode()) {
                $current_user = wp_get_current_user();
                echo '<div class="fbth-user-login">' .
                    sprintf(__('You are Logged in as %1$s (<a href="%2$s">Logout</a>)', 'fd-addons'), $current_user->display_name, wp_logout_url($current_url)) .
                    '</div>';
                return;
            }
            ?>
            <form id="fbth_login_form_<?php echo esc_attr($id); ?>" action="formloginaction" method="post">
                <div id="fbth-form-fs">
                    <div class="form-field">
                        <?php
                        if ($settings['fbth_form_show_label'] == 'yes') {
                            echo sprintf('<label for="%1$s">%1$s</label>', $user_label);
                        }
                        ?>
                        <input type="text" id="login_username<?php echo esc_attr($id); ?>" name="login_username" placeholder="<?php echo esc_attr__($user_placeholder, 'fd-addons'); ?>">
                    </div>

                    <div class="form-field password-field position-relative">
                        <?php
                        if ($settings['fbth_form_show_label'] == 'yes') {
                            echo sprintf('<label for="%1$s">%1$s</label>', $pass_label);
                        }
                        ?>
                        <input type="password" id="login_password<?php echo esc_attr($id); ?>" name="login_password" placeholder="<?php echo esc_attr__($pass_placeholder, 'fd-addons'); ?>">
                        <?php if ($settings['fbth_form_show_password'] == 'yes') : ?>
                            <i class="toggle-password fas fa-fw fa-eye-slash"></i>
                        <?php endif; ?>
                        <?php if ($settings['lost_password'] == 'yes') : ?>
                            <a href="<?php echo esc_url($reset_link); ?>" class="fright forgetpassword position-<?php echo $settings['forgetpass_positions'] ?>"><?php echo $settings['lostpass_link_text'] ?></a>
                        <?php endif; ?>
                    </div>


                    <div class="log-remember">
                        <?php if ($settings['remember_me'] == 'yes') : ?>
                            <label class="lable-content" id="rememberme">
                                <span class="checkmark"></span>
                                <input name="rememberme" type="checkbox" id="rememberme" value="forever">
                                <?php if (!empty($settings['remember_me_heading'])) {
                                    echo esc_attr__($settings['remember_me_heading'], 'fd-addons');
                                } else {
                                    esc_html_e('Remember Me', 'fd-addons');
                                } ?>
                            </label>
                        <?php endif; ?>
                    </div>

                    <div class="form-field" id="form-footer">
                    <div class="sign-submit-btn">
                    <input type="submit" id="login_form_submit_<?php echo esc_attr__($id, 'fd-addons'); ?>" name="login_form_submit<?php echo $id; ?>" value="<?php if (!empty($settings['login_button_text'])) {
                                                                                                                                                                        echo esc_attr__($settings['login_button_text'], 'fd-addons');
                                                                                                                                                                    } else {
                                                                                                                                                                        esc_html_e('Login', 'fd-addons');
                                                                                                                                                                    } ?>">
                    </div>
                        <?php if (get_option('users_can_register') && $settings['register_link'] == 'yes') : ?>
                            <div class="finists-reg-link">
                                <span class="freg-text"><?php if (!empty($settings['register_text'])) {
                                                            echo esc_attr__(
                                                                $settings['register_text'],
                                                                'fd-addons'
                                                            );
                                                        } else {
                                                            esc_html_e('All ready have account?', 'fd-addons');
                                                        } ?></span>

                                <a href="<?php echo esc_url($button_link); ?>" class="login_register_text">
                                    <?php if (!empty($settings['register_link_text'])) {
                                        echo esc_attr__(
                                            $settings['register_link_text'],
                                            'fd-addons'
                                        );
                                    } else {
                                        esc_html_e('Create a free account', 'fd-addons');
                                    } ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
            </form>
        </div>
    <?php
        $this->fbth_login_check($settings['redirect_page'], $redirect_url, $id);
    }
    public function fbth_login_check($reddirectstatus, $redirect_url, $id)
    {
    ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                "use strict";
                var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
                var loadingmessage = '<?php echo esc_html__('Please wait...', 'fd-addons'); ?>';
                var login_form_id = 'form#fbth_login_form_<?php echo esc_attr($id); ?>';
                var login_button_id = '#login_form_submit_<?php echo esc_attr($id); ?>';
                var redirect = '<?php echo $reddirectstatus; ?>';

                $(login_button_id).on('click', function() {
                    $('.fbth-login-form-wrapper .fbth_message').css('display', 'block');
                    $('#fbth_message_<?php echo esc_attr($id); ?>').html('<span class="fbth_lodding_msg">' + loadingmessage + '</span>').fadeIn();

                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: ajaxurl,
                        data: {
                            'action': 'fbth_ajax_login',
                            'username': $(login_form_id + ' #login_username<?php echo esc_attr($id); ?>').val(),
                            'password': $(login_form_id + ' #login_password<?php echo esc_attr($id); ?>').val(),
                            'security': $(login_form_id + ' #security').val()
                        },
                        success: function(msg) {
                            if (msg.loggeauth == true) {
                                $('#fbth_message_<?php echo esc_attr($id); ?>').html('<div class="fbth_success_msg alert alert-success">' + msg.message + '</div>').fadeIn();
                                if (redirect === 'yes') {
                                    document.location.href = '<?php echo esc_url($redirect_url); ?>';
                                    console.log('ok');
                                } else {
                                    document.location.href = '<?php echo esc_url($redirect_url); ?>';
                                }
                            } else {
                                $('#fbth_message_<?php echo esc_attr($id); ?>').html('<div class="fbth_invalid_msg alert alert-danger">' + msg.message + '</div>').fadeIn();
                            }
                        }
                    });
                    return false;
                });
            });
        </script>
<?php 
    }
}
$widgets_manager->register(new FBTH_Login());
