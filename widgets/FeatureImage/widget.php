<?php

namespace FBTH_Addons\Widgets;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

/**
 * Elementor image widget.
 *
 * Elementor widget that displays an image into the page.
 *
 * @since 1.0.0
 */
class FBTH_Featured_Image extends Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve image widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'fbth-feature-image';
    }
    /**
     * Get widget title.
     *
     * Retrieve image widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Featured Image', 'fbth');
    }
    /**
     * Get widget icon.
     *
     * Retrieve image widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'fbth eicon-featured-image';
    }
    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the image widget belongs to.
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
        return ['Feature image', 'photo', 'visual', 'featured'];
    }
    /**
     * Register image widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        $primary_color = get_theme_mod('primary_color');

        $this->start_controls_section(
            'section_image',
            [
                'label' => __('Image', 'fbth'),
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'     => __('Alignment', 'fbth'),
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
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_image',
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
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
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
                'selectors'      => [
                    '{{WRAPPER}} .elementor-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'space',
            [
                'label'          => __('Max Width', 'fbth'),
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
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
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
                'selectors'      => [
                    '{{WRAPPER}} .elementor-image img' => 'max-width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .elementor-image img' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .elementor-image img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'separator_panel_style',
            [
                'type'  => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );
        $this->start_controls_tabs('image_effects');
        $this->start_controls_tab(
            'normal',
            [
                'label' => __('Normal', 'fbth'),
            ]
        );
        $this->add_control(
            'opacity',
            [
                'label'     => __('Opacity', 'fbth'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image img' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'css_filters',
                'selector' => '{{WRAPPER}} .elementor-image img',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'hover',
            [
                'label' => __('Hover', 'fbth'),
            ]
        );
        $this->add_control(
            'opacity_hover',
            [
                'label'     => __('Opacity', 'fbth'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image:hover img' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'css_filters_hover',
                'selector' => '{{WRAPPER}} .elementor-image:hover img',
            ]
        );
        $this->add_control(
            'background_hover_transition',
            [
                'label'     => __('Transition Duration', 'fbth'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image img' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );
        $this->add_control(
            'hover_animation',
            [
                'label' => __('Hover Animation', 'fbth'),
                'type'  => Controls_Manager::HOVER_ANIMATION,
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .elementor-image img',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'fbth'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .elementor-image img',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_caption',
            [
                'label'     => __('Caption', 'fbth'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'caption_source!' => 'none',
                ],
            ]
        );
        $this->add_control(
            'caption_align',
            [
                'label'     => __('Alignment', 'fbth'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => __('Left', 'fbth'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => __('Center', 'fbth'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'fbth'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'fbth'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .widget-image-caption' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label'     => __('Text Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'default'   => $primary_color,
                'selectors' => [
                    '{{WRAPPER}} .widget-image-caption' => 'color: {{VALUE}};',
                ],

            ]
        );
        $this->add_control(
            'caption_background_color',
            [
                'label'     => __('Background Color', 'fbth'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .widget-image-caption' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'caption_typography',
                'selector' => '{{WRAPPER}} .widget-image-caption',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'caption_text_shadow',
                'selector' => '{{WRAPPER}} .widget-image-caption',
            ]
        );
        $this->add_responsive_control(
            'caption_space',
            [
                'label'     => __('Spacing', 'fbth'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .widget-image-caption' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    /**
     * Render image widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrapper', 'class', 'elementor-image');

        if (!empty($settings['shape'])) {
            $this->add_render_attribute('wrapper', 'class', 'elementor-image-shape-' . $settings['shape']);
        }

?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <?php the_post_thumbnail(get_the_Id(), 'full'); ?>
        </div>
<?php
    }
}
$widgets_manager->register(new \FBTH_Addons\Widgets\FBTH_Featured_Image());
