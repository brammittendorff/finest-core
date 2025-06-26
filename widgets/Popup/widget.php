<?php

/**
 * Slider Widget.
 *
 *
 * @since 1.0.0
 */

namespace FBTH\Widgets\Elementor;

use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;
use  Elementor\utils;
use  Elementor\Group_Control_Typography;
use  Elementor\Group_Control_Box_Shadow;
use  Elementor\Group_Control_Background;
use  Elementor\Group_Control_Border;
use  Elementor\Repeater;
use  Elementor\Icons_Manager;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class FBTH_Popup extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'fbth-popup';
    }

    public function get_title()
    {
        return __('Popup', 'fbth');
    }

    public function get_icon()
    {
        return ' fbth eicon-menu-bar';
    }

    public function get_categories()
    {
        return ['fbth'];
    }

    public function get_keywords()
    {
        return ['popup', 'video', 'primary-menu', 'menu', 'modal', 'fbth'];
    }

    protected function register_controls()
    {

        $secondary_color = get_theme_mod('secondary_color');
        $accent_color = get_theme_mod('accent_color');

        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Popup Content', 'fbth'),
            ]
        );

        $this->add_control(
            'popup_selected_template',
            [
                'label' => __('Select Template', 'fbth'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => fbth_cpt_slug_and_id('elementor_library'),
            ]
        );

        $this->add_control(
            'fbth_popup_button_icon',
            [
                'label' => __('Open Icon', 'fbth'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-bars',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'fbth_popup_button_icon_close',
            [
                'label' => __('Close Icon', 'fbth'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'far fa-window-close',
                    'library' => 'fa-solid',
                ],
            ]
        );
        $this->end_controls_section();
        // box
        $this->start_controls_section(
            'modal_box',
            [
                'label' => __('Box', 'fbth'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'box_bg',
            [
                'label' => __('Box Background', 'fbth'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth-addons-popup-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label'    => __('Shadow', 'techex-hp'),
                'selector' => '{{WRAPPER}} .techex-btn',
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label' => __('Margin', 'upmedix'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-addons-popup-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-addons-popup-content' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_border_radius',
            [
                'label' => __('Border Radius', 'upmedix'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-addons-popup-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-addons-popup-content' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label' => __('Padding', 'upmedix'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .fbth-addons-popup-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth-addons-popup-content' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'open_content_section',
            [
                'label' => __('Open Icon', 'fbth'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //normal hover style
        $this->start_controls_tabs(
            'open_style_tabs'
        );

        // normal
        $this->start_controls_tab(
            'icon_open_normal',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_control(
            'open_icon_color',
            [
                'label' => __('Icon Color', 'fbth'),
                'type' => Controls_Manager::COLOR,
                'default' => $secondary_color,
                'selectors' => [
                    '{{WRAPPER}} .popup-menubar i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .popup-menubar path' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} .popup-menubar path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'open_icon_bg_color',
            [
                'label' => __('Icon Background Color', 'fbth'),
                'type' => Controls_Manager::COLOR,
                'default' => $accent_color,
                'selectors' => [
                    '{{WRAPPER}} .popup-menubar' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_open_size',
            [
                'label' => __('Icon Size', 'fbth'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .popup-menubar i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .popup-menubar svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'open_icon_margin',
            [
                'label'          => __('Margin', 'fbth'),
                'type'           => Controls_Manager::DIMENSIONS,
                'selectors'      => [
                    '{{WRAPPER}} .popup-menubar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'open_icon_padding',
            [
                'label'          => __('Padding', 'fbth'),
                'type'           => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'      => [
                    '{{WRAPPER}} .popup-menubar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'open_icon_border_radius',
            [
                'label'          => __('Border Radius', 'fbth'),
                'type'           => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'      => [
                    '{{WRAPPER}} .popup-menubar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        // Hover
        $this->start_controls_tab(
            'icon_open_hover',
            [
                'label' => __('Hover', 'fbth'),
            ]
        );

        $this->add_control(
            'open_icon_hovercolor',
            [
                'label' => __('Hover Icon Color', 'fbth'),
                'type' => Controls_Manager::COLOR,
                'default' => $accent_color,
                'selectors' => [
                    '{{WRAPPER}} .popup-menubar:hover i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .popup-menubar:hover path' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} .popup-menubar:hover path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'open_icon_hover_bg_color',
            [
                'label' => __('Hover Icon Background Color', 'fbth'),
                'type' => Controls_Manager::COLOR,
                'default' => $secondary_color,
                'selectors' => [
                    '{{WRAPPER}} .popup-menubar:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'close_content_section',
            [
                'label' => __('Close Icon', 'fbth'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //normal hover style
        $this->start_controls_tabs(
            'close_style_tabs'
        );

        // normal
        $this->start_controls_tab(
            'icon_close_normal',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_control(
            'icon_close_size',
            [
                'label' => __('Icon Size', 'fbth'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #offset-menu-close-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} #offset-menu-close-btn svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'close_icon_color',
            [
                'label' => __('Icon Color', 'fbth'),
                'type' => Controls_Manager::COLOR,
                'default' => $secondary_color,
                'selectors' => [
                    '{{WRAPPER}} #offset-menu-close-btn i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} #offset-menu-close-btn path' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} #offset-menu-close-btn path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'close_icon_bg_color',
            [
                'label' => __('Icon Color', 'fbth'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #offset-menu-close-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'close_icon_margin',
            [
                'label'          => __('Margin', 'fbth'),
                'type'           => Controls_Manager::DIMENSIONS,
                'selectors'      => [
                    '{{WRAPPER}} #offset-menu-close-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'close_icon_padding',
            [
                'label'          => __('Padding', 'fbth'),
                'type'           => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'      => [
                    '{{WRAPPER}} #offset-menu-close-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'close_icon_border_radius',
            [
                'label'          => __('Border Radius', 'fbth'),
                'type'           => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'      => [
                    '{{WRAPPER}} #offset-menu-close-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_close_hover',
            [
                'label' => __('Hover', 'fbth'),
            ]
        );
        $this->add_control(
            'close_icon_hover_color',
            [
                'label' => __('Hover Icon Color', 'fbth'),
                'type' => Controls_Manager::COLOR,
                'default' => $secondary_color,
                'selectors' => [
                    '{{WRAPPER}} #offset-menu-close-btn:hover i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} #offset-menu-close-btn:hover path' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} #offset-menu-close-btn:hover path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'close_icon_hover_bg_color',
            [
                'label' => __('Hover Icon Background Color', 'fbth'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #offset-menu-close-btn:hover' => 'background-color: {{VALUE}}',
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
?>
        <div class="fbth-addons-popup-content-wraper">


            <div class="fbth-addons-popup-content">
                <span id="offset-menu-close-btn">
                    <?php Icons_Manager::render_icon($settings['fbth_popup_button_icon_close'], ['aria-hidden' => 'true']); ?>
                </span>
                <?php echo fbth_layout_content($settings['popup_selected_template']); ?>
            </div>

            <div class="fbth-addons-popup">
                <span class="popup-menubar">
                    <?php Icons_Manager::render_icon($settings['fbth_popup_button_icon'], ['aria-hidden' => 'true']); ?>
                </span>
            </div>

        </div>

<?php
    }
}
$widgets_manager->register(new \FBTH\Widgets\Elementor\FBTH_Popup());
