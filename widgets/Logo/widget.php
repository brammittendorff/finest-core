<?php

namespace FBTH_Addons\Widgets;

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
class FBTH_Site_Logo extends \Elementor\Widget_Base
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
        return 'fbth-logo';
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
        return __('Site Logo', 'fbth');
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
        return 'fbth eicon-image';
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
            'section_layout',
            [
                'label' => __('Layout', 'fbth'),
            ]
        );

        $this->add_control(
            'logo_type',
            [
                'label' => __('Logo Type', 'fbth'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'dark',
                'options' => [
                    'dark'  => __('Dark', 'fbth'),
                    'white' => __('White', 'fbth'),
                    'custom' => __('Custom', 'fbth'),
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Choose logo', 'fbth'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'logo_type' => 'custom',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'logo_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'large',
                'condition' => [
                    'logo_type' => 'custom',
                ]
            ]
        );

        $this->add_responsive_control(
            'content_align',
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
                    '{{WRAPPER}} .fbth-site-logo' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => __('Image width', 'fbth'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fbth-site-logo img' => 'width: {{SIZE}}{{UNIT}};',
                ]

            ]
        );
        $this->end_controls_section();
    }

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
        <div class="fbth-site-logo content-align-<?php echo isset($settings['content_align']) ? $settings['content_align'] : 'left' ?>">
            <a href="<?php echo home_url(); ?>" class="fbth-site-logo-wrap">
                <?php
                echo "<span class='site-logo'>";
                if ('custom' == $settings['logo_type'] && $settings['image']['url']) {
                    echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image');
                } else {
                    echo $this->fbth_get_site_logo($settings['logo_type']);
                }
                echo '</span>'

                ?>
            </a>

        </div>
<?php

    }
    /**
     *
     *  fbth get logo
     *
     */
    public function fbth_get_site_logo($logo_type = 'dark')
    {
        $fbth = get_option('fbth');
        $logo = '';
        $logo_url = '';

        if ('dark' ==  $logo_type && isset($fbth['primary_logo']['url'])) {
            $logo = '<img src="' . esc_url($fbth['primary_logo']['url']) . '" alt="' . esc_attr(get_bloginfo('title')) . '" class="navbar-brand__regular dark-logo">';
        } elseif ('white' ==  $logo_type && isset($fbth['secondary_logo']['url'])) {
            $logo = '<img src="' . esc_url($fbth['secondary_logo']['url']) . '" alt="' . esc_attr(get_bloginfo('title')) . '" class="navbar-brand__regular dark-logo">';
        } else {
            if (has_custom_logo()) {
                $core_logo_id = get_theme_mod('custom_logo');
                $logo_url = wp_get_attachment_image_src($core_logo_id, 'full');
                $logo = '<img src="' . esc_url($logo_url[0]) . '" alt="' . esc_attr(get_bloginfo('title')) . '" class="navbar-brand__regular">';
            } else {
                $logo = '<h1 class="navbar-brand__regular">' . get_bloginfo('name') . '</h1>';
            }
        }

        return $logo;
    }
}
$widgets_manager->register(new \FBTH_Addons\Widgets\FBTH_Site_Logo());
