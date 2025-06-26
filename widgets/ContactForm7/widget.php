<?php

namespace FBTH_Contact_Form\Widgets;

if (!defined('ABSPATH')) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use \Elementor\Icons_Manager;
use \Elementor\Utils;
use \Elementor\Widget_Base;


class FBTH_Contact_Form extends Widget_Base
{
    public function get_name()
    {
        return 'rrdevs-contact-form';
    }
    public function get_title()
    {
        return esc_html__('Contact Form 7', 'fbth');
    }
    public function get_icon()
    {
        return 'fbth eicon-email-field';
    }
    public function get_categories()
    {
        return ['fbth'];
    }
    public function get_keywords()
    {
        return ['Contact_Form_7', 'Form', 'Contact'];
    }
    protected function register_controls()
    {

        $primary_color = get_theme_mod('primary_color');
        $secondary_color = get_theme_mod('secondary_color');
        $accent_color = get_theme_mod('accent_color');

        $this->start_controls_section(
            '_section_cf7',
            [
                'label' => fbth_is_cf7_activated() ? __('Contact Form 7', 'fbth') : __('Notice', 'fbth'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        if (!fbth_is_cf7_activated()) {
            $this->add_control(
                'cf7_missing_notice',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf(
                        __('Hi, it seems %1$s is missing in your site. Please install and activate %1$s first.', 'Exeter'),
                        '<a href="https://wordpress.org/plugins/contact-form-7/" target="_blank" rel="noopener">Contact Form 7</a>'
                    ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                ]
            );
            $this->end_controls_section();
            return;
        }
        $this->add_control(
            'fbth_form_ts',
            [
                'label'     => __('Form List Or ShortCode', 'fbth'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'formlist',
                'options'   => [
                    'formlist'  => __('Form List', 'fbth'),
                    'shortcode' => __('Form ShortCode', 'fbth'),
                ],
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'form_id',
            [
                'label'       => __('Select Your Form', 'fbth'),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'options'     => ['' => __('', 'fbth')] + \fbth_get_cf7_forms(),
                'condition'   => [
                    'fbth_form_ts' => 'formlist',
                ],
            ]
        );
        $this->add_control(
            'contactform_shortecode',
            [
                'label'     => __('Enter your shortcode', 'fbth'),
                'type'      => Controls_Manager::TEXTAREA,
                'separator' => 'after',
                'condition' => [
                    'fbth_form_ts' => 'shortcode',
                ],
            ]
        );
        $this->end_controls_section();
        //form fields style
        $this->start_controls_section(
            '_section_fields_style',
            [
                'label' => __('Fields', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'field_typography',
                'label'    => __('Typography', 'fbth'),
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)',
            ]
        );
        //field focus
        $this->start_controls_tabs('tabs_field_state');
        $this->start_controls_tab(
            'tab_field_normal',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_control(
            'field_color',
            [
                'label'     => __('Text Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'default'   => $primary_color,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'response_field_color',
            [
                'label'     => __('Response Output Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'default'   => $primary_color,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-response-output' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'field_placeholder_color',
            [
                'label'     => __('Placeholder Text Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'default'   => $primary_color,
                'selectors' => [
                    '{{WRAPPER}} ::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-moz-placeholder'          => 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-ms-input-placeholder'     => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'field_bg_color',
            [
                'label'     => __('Background Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-radio):not(.wpcf7-checkbox):not(.wpcf7-acceptance)' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'field_border',
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-radio):not(.wpcf7-checkbox):not(.wpcf7-acceptance)',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'field_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-radio):not(.wpcf7-checkbox):not(.wpcf7-acceptance)',
            ]
        );
        $this->end_controls_tab();
        //f
        $this->start_controls_tab(
            'tab_field_focus',
            [
                'label' => __('Focus', 'fbth'),
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'field_focus_border',
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-radio):not(.wpcf7-checkbox):not(.wpcf7-acceptance):focus',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'field_focus_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-radio):not(.wpcf7-checkbox):not(.wpcf7-acceptance):focus',
            ]
        );
        $this->add_control(
            'field_focus_bg_color',
            [
                'label'     => __('Background Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-radio):not(.wpcf7-checkbox):not(.wpcf7-acceptance):focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'hr_one',
            [
                'type'  => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );
        $this->add_control(
            'popover-toggle',
            [
                'label'        => __('Field advanced option', 'fbth'),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __('Default', 'fbth'),
                'label_on'     => __('Custom', 'fbth'),
                'return_value' => 'yes',
            ]
        );
        $this->start_popover();
        $this->add_responsive_control(
            'wpcf7_field_height',
            [
                'label'      => __('Fields Height', 'fbth'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-radio):not(.wpcf7-checkbox):not(.wpcf7-acceptance),{{WRAPPER}} .ha-cf7-form input:not(.wpcf7-radio):not(.wpcf7-checkbox):not(.wpcf7-acceptance) ' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wpcf7_textarea_field_height',
            [
                'label'      => __('Textarea Height', 'fbth'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} textarea.wpcf7-textarea' => 'min-height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'field_width',
            [
                'label'          => __('Width', 'fbth'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-radio):not(.wpcf7-checkbox):not(.wpcf7-acceptance),{{WRAPPER}} .ha-cf7-form label' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'field_margin',
            [
                'label'      => __('Spacing Between', 'fbth'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-radio):not(.wpcf7-checkbox):not(.wpcf7-acceptance)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'spacing_between_top',
            [
                'label'      => __('Spacing Between', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-radio):not(.wpcf7-checkbox):not(.wpcf7-acceptance)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'field_padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-radio):not(.wpcf7-checkbox):not(.wpcf7-acceptance)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'field_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-radio):not(.wpcf7-checkbox):not(.wpcf7-acceptance)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'textarea_margin',
            [
                'label'      => __('Textarea Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}}  textarea.wpcf7-textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'textarea_border_radius',
            [
                'label'      => __('Textarea Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}}  textarea.wpcf7-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->end_popover();
        $this->end_controls_section();
        //start button label style
        $this->start_controls_section(
            'cf7-form-label',
            [
                'label' => __('Label', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'label_margin',
            [
                'label'      => __('Spacing Bottom', 'fbth'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'label_width',
            [
                'label'      => __('Width', 'fbth'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form label' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'hr3',
            [
                'type'  => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'label_typography',
                'label'    => __('Typography', 'fbth'),
                'selector' => '{{WRAPPER}} .wpcf7-form label',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'        => 'list_item_label_typography',
                'label'       => __('Radio Button Typography', 'fbth'),
                'selector'    => '{{WRAPPER}} .wpcf7-list-item-label',
                'description' => __('Chackbox or radio label typography.', 'fbth'),
            ]
        );
        $this->add_control(
            'label_color',
            [
                'label'     => __('Text Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'default'   => $secondary_color,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form label' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        //start button
        $this->start_controls_section(
            'section_layout_button',
            [
                'label' => __('Button', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_text',
                'label'    => __('Typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-contact-from [type=submit]',
            ]
        );
        // Button Position End
        $this->start_controls_tabs(
            'form_button_normals'
        );
        $this->start_controls_tab(
            'form_button_normal',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_control(
            'button_color',
            [
                'label'     => __('Button Background Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'default'   => $accent_color,
                'selectors' => [
                    '{{WRAPPER}} .fbth-contact-from [type=submit]' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_bg_color',
            [
                'label'     => __('Button Text Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .fbth-contact-from [type=submit]' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .fbth-contact-from [type=submit]',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'label'    => __('Border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-contact-from [type=submit]',
            ]
        );
        $this->add_control(
            'popover-toggle-icon',
            [
                'label'        => __('Icon Styles', 'fbth'),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __('Default', 'fbth'),
                'label_on'     => __('Custom', 'fbth'),
                'return_value' => 'yes',
            ]
        );


        $this->start_popover();
        $this->add_control(
            'icon_color',
            [
                'label'     => __('Icon Color', 'fbth'),
                'default'   => $accent_color,
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} button[type=submit] i, {{WRAPPER}} input[type=submit] i'      => 'color: {{VALUE}}',
                    '{{WRAPPER}} button [type=submit]:after'      => 'color: {{VALUE}}',
                    '{{WRAPPER}} button:hover:after'      => 'color: {{VALUE}}',
                    '{{WRAPPER}} button[type=submit] path, {{WRAPPER}} input[type=submit] path' => 'stroke: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_margin',
            [
                'label' => esc_html__('Margin', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} button[type=submit] i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} input[type=submit] i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} button[type=submit]:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_right_gap',
            [
                'label'      => __('Icon Gap', 'fbth-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-contact-from [type=submit]:after' => 'right: {{SIZE}}{{UNIT}} !important;', 
                ],
                
            ]
        );
        $this->add_responsive_control(
            'icon_size',
            [
                'label'          => __('Font Size', 'fbth'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} button[type=submit] i,{{WRAPPER}} input[type=submit] i,button[type=submit]:after ' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_fill_color',
            [
                'label'     => __('Icon Fill Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => $accent_color,
                'selectors' => [
                    '{{WRAPPER}} button[type=submit] path, {{WRAPPER}} input[type=submit] path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_popover();

        //button
        $this->add_control(
            'popover-toggle-button',
            [
                'label'        => __('Button advanced option', 'fbth'),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __('Default', 'fbth'),
                'label_on'     => __('Custom', 'fbth'),
                'return_value' => 'yes',
            ]
        );
        $this->start_popover();
        $this->add_responsive_control(
            'contact_form_addons_position_type',
            array(
                'label' => __('Position Type', 'fbth'),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => __('Default', 'fbth'),
                    'static' => __('Static', 'fbth'),
                    'relative' => __('Relative', 'fbth'),
                    'absolute' => __('Absolute', 'fbth'),
                ),
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} .fbth--contactform-wraper [type=submit]' => 'position:{{VALUE}};',
                ),
            )
        );
        $this->add_responsive_control(
            'contact_form_addons_position_top',
            array(
                'label' => __('Top', 'fbth'),
                'type' => Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .fbth--contactform-wraper [type=submit]' => 'top:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'contact_form_addons_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'contact_form_addons_position_right',
            array(
                'label' => __('Right', 'fbth'),
                'type' => Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .fbth--contactform-wraper [type=submit]' => 'right:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'contact_form_addons_position_type' => array('relative', 'absolute'),
                ),
                'return_value' => '',
            )
        );
        $this->add_responsive_control(
            'contact_form_addons_position_bottom',
            array(
                'label' => __('Bottom', 'fbth'),
                'type' => Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .fbth--contactform-wraper [type=submit]' => 'bottom:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'contact_form_addons_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'contact_form_addons_position_left',
            array(
                'label' => __('Left', 'fbth'),
                'type' => Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .fbth--contactform-wraper [type=submit]' => 'left:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'contact_form_addons_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'contact_form_addons_position_from_center',
            array(
                'label' => __('From Center', 'fbth'),
                'description' => __('Please avoid using "From Center" and "Left" options at the same time.', 'fbth'),
                'type' => Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .fbth--contactform-wraper [type=submit]' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
                ),
                'condition' => array(
                    'contact_form_addons_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_control(
            'hr_there',
            [
                'type'  => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );
        $this->add_responsive_control(
            'button_width',
            [
                'label'      => __('Width', 'fbth'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 150,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-contact-from [type=submit]' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_height',
            [
                'label'      => __('Height', 'fbth'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 150,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-contact-from [type=submit]' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-contact-from [type=submit]'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-contact-from [type=submit]' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-contact-from [type=submit]'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-contact-from [type=submit]' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-contact-from [type=submit]'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-contact-from [type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_popover();
        $this->end_controls_tab();


        //start hover tab tab
        $this->start_controls_tab(
            'form_button_hover',
            [
                'label' => __('Hover', 'fbth'),
            ]
        );
        $this->add_control(
            'button_hover',
            [
                'label'     => __('Background Color Hover', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'default'   => $secondary_color,
                'selectors' => [
                    '{{WRAPPER}} .fbth-contact-from [type=submit]:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_bg_hover',
            [
                'label'     => __('Text Color Hover', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .fbth-contact-from [type=submit]:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .fbth-contact-from [type=submit]:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_border_hover',
                'label'    => __('Border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-contact-from [type=submit]:hover',
            ]
        );


        $this->add_responsive_control(
            'h_icon_right_gap',
            [
                'label'      => __('Icon Gap Hover', 'fbth-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-contact-from [type=submit]:after' => 'right: {{SIZE}}{{UNIT}} !important;', 
                ],
                
            ]
        );

        $this->add_responsive_control(
            'h_icon_right_text_gap',
            [
                'label'      => __('Text Gap Hover', 'fbth-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
               
                'selectors'  => [
                    '{{WRAPPER}} .fbth--contactform-wraper:hover [type=submit]' => 'text-indent: {{SIZE}}{{UNIT}} !important;',
                    
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        //button
        
        $this->end_controls_section();
        //button end
        //Form Box
        $this->start_controls_section(
            '_form_box_style',
            [
                'label' => __('Box', 'fbth'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'form_box_align',
            [
                'label'     => __('Align', 'fbth'),
                'type'      => Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .fbth-contact-from' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .fbth--contactform-wraper input' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .fbth--contactform-wraper textarea' => 'text-align: {{VALUE}};',
                ],
                'toggle'    => true,
            ]
        );
        $this->add_control(
            'form_box_bg',
            [
                'label'     => __('Background', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-contact-from' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'form_border',
                'selector' => '{{WRAPPER}} .fbth-contact-from',
            ]
        );
        $this->add_responsive_control(
            'wpcf7_form_width',
            [
                'label'      => __('Form Width', 'fbth'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 2000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} form.wpcf7-form' => 'width:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_box_padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-contact-from'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-contact-from' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_box_border_redius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth-contact-from'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-contact-from' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'form_box_shadow',
                'label' => esc_html__('Box Shadow', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-contact-from',
            ]
        );
        $this->end_controls_section();
    }
    protected function render()
    {
        if (!fbth_is_cf7_activated()) {
            return;
        }
        $settings = $this->get_settings();
        $fbth_form_sl = $settings['fbth_form_ts'];
        $fbth_form_id = $settings['form_id'];
        $fbth_contactform_shortecode = $settings['contactform_shortecode'];
?>
        <?php if (!empty($fbth_form_id && $fbth_form_sl == 'formlist')) :
        ?>
            <div class="fbth--contactform-wraper  fbth-contact-from ">
                <?php
                echo fbth_do_shortcode('contact-form-7', [
                    'id' => $settings['form_id'],
                ]);
                ?>
            </div>
        <?php
        elseif ($fbth_form_sl == 'shortcode') :
        ?>
            <div class="fbth--contactform-wraper <?php echo esc_attr($fbth_form_bp) ?> fbth-contact-from">
                <?php echo fbth_get_meta($fbth_contactform_shortecode); ?>
            </div>
<?php
        endif;
    }
}
$widgets_manager->register(new \FBTH_Contact_Form\Widgets\FBTH_Contact_Form());
