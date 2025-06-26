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
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}
class FBTH_Advanced_Tabs extends \Elementor\Widget_Base
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
        return 'fbth-advance-tab';
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
        return __('Advance Tabs', 'fbth');
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
        
        $this->section_content_tabs(); //function calling

        /**
         * Style tab
         */
        $this->start_controls_section(
            'tab_icon_style',
            [
                'label' => __('Tab Icon', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'icon_style_tabs'
        );
        $this->start_controls_tab(
            'icon_style_normal_tab',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label'     => __('Icon Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs .fbth-tab-icon'      => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tabs .fbth-tab-icon path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_fill_color',
            [
                'label'     => __('Icon Fill Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs .fbth-tab-icon path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_bg_color',
            [
                'label'     => __('Icon Background', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs .fbth-tab-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_gap',
            [
                'label'      => __('Icon gap', 'fbth'),
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
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tabs .fbth-tab-icon'          => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label'      => __('Icon Size', 'fbth'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 50,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tabs .fbth-tab-icon'     => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tabs .fbth-tab-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_box_size',
            [
                'label'      => __('Icon Box Size', 'fbth'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tabs .fbth-tab-icon' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}; display:inline-flex; align-items:center;justify-content:center',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_box_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .tabs .fbth-tab-icon'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'icon_style_hover_tab',
            [
                'label' => __('Hover', 'fbth'),
            ]
        );
        $this->add_control(
            'icon_hover_color',
            [
                'label'     => __('Icon Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs li:hover .fbth-tab-icon,{{WRAPPER}} .tabs li.current .fbth-tab-icon'      => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tabs li:hover .fbth-tab-icon path,{{WRAPPER}} .tabs li.current .fbth-tab-icon path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_fill_color_hover',
            [
                'label'     => __('Icon Fill Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs li:hover .fbth-tab-icon path,{{WRAPPER}} .tabs li.current .fbth-tab-icon path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_bg_color_hover',
            [
                'label'     => __('Icon Background', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs li:hover .fbth-tab-icon, {{WRAPPER}} .tabs li.current .fbth-tab-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'tab_link_style',
            [
                'label' => __('Tab Title', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'tabs_style_tabs'
        );
        $this->start_controls_tab(
            'tabs_style_normal_tab',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tabs_typography',
                'label'    => __('Typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth--tab-menu ul.tabs>li',
            ]
        );
        $this->add_control(
            'tabs_color',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-menu ul.tabs>li' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tabs_background',
            [
                'label'     => __('Background Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-menu ul.tabs>li' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tabs_border',
                'label'    => __('Border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth--tab-menu ul.tabs>li',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tabs_shadow',
                'label'    => __('Shadow', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth--tab-menu ul.tabs>li',
            ]
        );
        
        $this->add_responsive_control(
            'tabs_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-menu ul.tabs>li'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-menu ul.tabs>li'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth--tab-menu ul.tabs>li' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-menu ul.tabs>li'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tabs_style_hover_tab',
            [
                'label' => __('Hover', 'fbth'),
            ]
        );
        $this->add_control(
            'tabs_hover_color',
            [
                'label'     => __('Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-menu ul.tabs>li:hover,{{WRAPPER}} .fbth--tab-menu ul.tabs>li.current' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tabs_hover_background',
            [
                'label'     => __('Background Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-menu ul.tabs>li:hover,{{WRAPPER}} .fbth--tab-menu ul.tabs>li.current' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tabs_hover_border',
                'label'    => __('Border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth--tab-menu ul.tabs>li:hover,{{WRAPPER}} .fbth--tab-menu ul.tabs>li.current',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tabs_hover_shadow',
                'label'    => __('Tabs Shadow', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth--tab-menu ul.tabs>li:hover,{{WRAPPER}} .fbth--tab-menu ul.tabs>li.current',
            ]
        );
        $this->add_responsive_control(
            'tabs_hover_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-menu ul.tabs>li:hover,{{WRAPPER}} .fbth--tab-menu ul.tabs>li.current'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth--tab-menu ul.tabs>li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}
                    ;',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'tabs_wrap_style',
            [
                'label' => __('Tabs', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'tabs_justify_content',
            [
                'label' => __('Tab Align', 'fbth'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => __('Default', 'fbth'),
                    'flex-start' => __('Start', 'fbth'),
                    'center' => __('Center', 'fbth'),
                    'flex-end' => __('End', 'fbth'),
                    'space-between' => __('Space Between', 'fbth'),
                    'space-around' => __('Space Around', 'fbth'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-menu ul.tabs' => 'justify-content: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tabs_ul_background',
            [
                'label'     => __('Background Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-menu ul.tabs' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tabs_ul_shadow',
                'label'    => __('Shadow', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth--tab-menu ul.tabs',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tabs_ul_border',
                'label'    => __('Border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth--tab-menu ul.tabs',
            ]
        );
        $this->add_responsive_control(
            'tab_ul_width',
            [
                'label'      => __('Tab Width', 'fbth'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-menu-wrap'          => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_align',
            [
                'label'        => __('Tab Align', 'fbth'),
                'type'         => \Elementor\Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => __('Left', 'fbth'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('top', 'fbth'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'fbth'),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify'  => [
                        'title' => __('Right', 'fbth'),
                        'icon'  => 'fa fa-align-justify',
                    ],
                ],
                'devices'      => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-menu' => 'text-align: {{VALUE}}',
                ],
                'toggle'       => true,
            ]
        );
        $this->add_responsive_control(
            'tabs_ul_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-menu ul.tabs'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_ul_padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-menu ul.tabs'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .fbth--tab-menu ul.tabs' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_ul_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-menu ul.tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'tabs_content_style',
            [
                'label' => __('Content Box', 'fbth'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'tabs_content_background',
            [
                'label'     => __('Background Color', 'fbth'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fbth--tab-content-wrap' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tabs_content_shadow',
                'label'    => __('Shadow', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth--tab-content-wrap',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tabs_content_border',
                'label'    => __('Border', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth--tab-content-wrap',
            ]
        );
        $this->add_responsive_control(
            'tab_content_width',
            [
                'label'      => __('Width', 'fbth'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
					'unit' => '%',
					'size' => 100,
				],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-content-wrap'          => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_content_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-content-wrap'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_content_padding',
            [
                'label'      => __('Padding', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-content-wrap'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_content_margin',
            [
                'label'      => __('Margin', 'fbth'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fbth--tab-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    /**
     * section_content_tabs
     */
    protected function section_content_tabs() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Tabs', 'fbth'),
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
                'default' => 'no',
            ]
        );
        $repeater->add_control(
            'tab_icon',
            [
                'label'       => __('Tab Icon', 'fbth'),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tab_title',
            [
                'label'       => __('Tab Title', 'fbth'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'selected_template',
            [
                'label' => __('Select Template', 'fbth'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => fbth_cpt_slug_and_id('elementor_library'),
            ]
        );
        //End Repeater Control field
        $this->add_control(
            'tabs',
            [
                'label'        => __('Tab List', 'fbth'),
                'type'         => Controls_Manager::REPEATER,
                'fields'       => $repeater->get_controls(),
                'title_field' => '{{{ tab_title }}}',
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
?>
        <div class="fbth-tabs-wrapper">
            <div class="fbth--tab-menu-wrap">
                <div class="fbth--tab-menu">
                    <ul class="tabs">
                        <?php foreach ($settings['tabs'] as $value) :
                            $active = $value['active_tabs'] == 'yes' ? 'current' : '';
                            
                        ?>
                            <li class="tab-link <?php echo esc_attr($active) ?>" data-tab="tab-<?php echo esc_attr($value['_id']) ?>">
                                <?php if ($value['tab_icon']['value']) : ?>
                                    <div class="fbth-tab-icon">
                                        <?php \Elementor\Icons_Manager::render_icon($value['tab_icon'], ['aria-hidden' => 'true']); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($value['tab_title']) : ?>
                                    <span><?php echo esc_html($value['tab_title']); ?></span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="fbth--tab-content-wrap">
                <?php foreach ($settings['tabs'] as $value) :
                    $active = $value['active_tabs'] == 'yes' ? 'current' : '';
                    
                ?>
                    <div id="tab-<?php echo esc_attr($value['_id']) ?>" class="fbth-tab-content-single animated fadeIn
                        <?php echo esc_attr($active) ?>">
                        <?php
                        if( !empty($value['selected_template'])){
                           
                        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                            echo '<div class="fbth-elm-edit-wrap"><a href="' . \Elementor\Plugin::$instance->documents->get($value['selected_template'])->get_edit_url() . '" class="fbth-elm-edit">' . esc_html__('Edit Template', 'fbth') . '</a></div>';
                        }
                        ?>
                        <?php
                        echo fbth_layout_content($value['selected_template']); 
                            }
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
<?php
    }
}
$widgets_manager->register(new \FBTH_Advanced_Tabs());
