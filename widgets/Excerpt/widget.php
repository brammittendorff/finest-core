<?php

namespace FBTH_Addons\Widgets;

if (!defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class FBTH_Excerpt extends Widget_Base
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
        return 'fbth-excerpt';
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
        return __('Excerpt', 'fbth');
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
        return 'fbth eicon-post-excerpt';
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
        return ['excerpt', 'title', 'text', 'fbth'];
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

        $primary_color = get_theme_mod('primary_color');
        /**
         * Style tab
         */
        $this->start_controls_section(
            'general',
            [
                'label' => __('Content', 'fbth'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'fbth_align',
            [
                'label' => __('Align', 'fbth'),
                'type' => Controls_Manager::CHOOSE,
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .fbth-excerpt' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fbth_color',
            [
                'label' => __('Color', 'fbth'),
                'type' => Controls_Manager::COLOR,
                'default' => $primary_color,
                'selectors' => [
                    '{{WRAPPER}} .fbth-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fbth_typography',
                'label' => __('Typography', 'fbth'),
                'selector' => '{{WRAPPER}} .fbth-excerpt',
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

?>
         <?php 
		global $post;
		if( has_excerpt( $post->ID ) ): ?>
        <span class="fbth-excerpt">
            <?php the_excerpt() ?>
        </span>
<?php endif; ?>
<?php
    }
}
$widgets_manager->register(new \FBTH_Addons\Widgets\FBTH_Excerpt());
