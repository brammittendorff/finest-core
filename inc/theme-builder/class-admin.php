<?php

namespace FBTH\Elementor\ThemeBuilder;

defined('ABSPATH') || exit();

/**
 * Theme Builder generic functions
 *
 * @since 2.0.0
 */
class Admin
{
    /**
     * Construct Theme Builder generic functions
     *
     * @since 2.0.0
     */
    public function __construct()
    {
        //Add Theme Builde in Admin Menu
        add_action('admin_menu', [$this, 'register_admin_menu']);

        add_filter('views_edit-fbth-tb', [$this, 'admin_print_tabs']);
        add_filter('manage_fbth-tb_posts_columns', [$this, 'custom_columns']);
        add_filter('manage_fbth-tb_posts_custom_column', [$this, 'display_custom_columns']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts_and_style']);

        //display type in megamenu
        add_filter('wp_setup_nav_menu_item', function ($menu_item) {
            if ($menu_item->object === 'fbth-tb') {
                $menu_item->type_label = 'Theme Builder Mega Menu';
            }
            return $menu_item;
        });

        //Display only megamenu type in admin menu items
        add_filter('nav_menu_items_fbth-tb', [$this, 'filter_megamenu_in_menu']);
        add_filter('nav_menu_items_fbth-tb_recent', [$this, 'filter_megamenu_in_menu']);

        add_action('elementor/editor/after_enqueue_scripts', [$this, 'popup_extra_in_elementor']);

        // add_filter('script_loader_tag', [$this, 'add_type_attribute'] , 10, 3);

    }

    function popup_extra_in_elementor()
    {
?>
        <style>
            #elementor-notice-bar {
                display: none !important;
            }
        </style>
    <?php
    }

    /**
     * Keep only mega menu type in list
     *
     * @param array $menu_item
     * @return array
     * @since 2.0.0
     */
    function filter_megamenu_in_menu($menu_item)
    {
        $new_items = array();
        foreach ($menu_item as $item) {
            if (Common::get_the_type($item->ID) === 'mega menu') {
                $new_items[] = $item;
            }
        }
        return $new_items;
    }

    /**
     * Register Theme Builder admin menu
     *
     * @return void
     * @since 2.0.0
     */
    public function register_admin_menu()
    {
        $icon_url = plugins_url() . "/finest-core/assets/images/theme-builder.svg";
        $icon_url = apply_filters('fbth_theme_icon_url', $icon_url);

        $hook = add_menu_page(
            __('Theme Builder', 'fbth'),
            __('Theme Builder', 'fbth'),
            'manage_options',
            'edit.php?post_type=fbth-tb',
            '',
            $icon_url,
            3
        );
        add_action('load-' . $hook, function () {
            add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts_and_style']);
        });
    }

    function add_type_attribute($tag, $handle, $src)
    {
        // if not your script, do nothing and return original $tag
        if ('fbth-tb-manifest' == $handle) {
            $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
        }
        // change the script tag by adding type="module" and return it.
        return $tag;
    }

    /**
     * Theme builder style and scripts enqueue
     *
     * @param [type] $hook
     * @return void
     * @since 2.0.0
     */
    public function enqueue_scripts_and_style($hook)
    {
        global $typenow;

        if ($hook === 'edit.php' && $typenow === 'fbth-tb') {
            // $prefix = (  ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) || defined( 'FBTH_WIDGET' ) ) ? '' : '.min';
            wp_enqueue_script(
                'fbth-tb-manifest',
                FBTH_ASSETS_PUBLIC . '/js/manifest.js',
                [],
                filemtime(FBTH_WIDGET . 'assets/js/manifest.js'),
                true
            );
            wp_enqueue_script(
                'fbth-tb-vendor',
                FBTH_ASSETS_PUBLIC . '/js/vendor.js',
                ['fbth-tb-manifest'],
                filemtime(FBTH_WIDGET . 'assets/js/vendor.js'),
                true
            );
            wp_enqueue_script(
                'fbth-tb',
                FBTH_ASSETS_PUBLIC . '/js/theme-builder.js',
                ['fbth-tb-manifest'],
                filemtime(FBTH_WIDGET . 'assets/js/theme-builder.js'),
                true
            );

            wp_enqueue_style(
                'fbth-tb-styles',
                FBTH_ASSETS_PUBLIC . '/css/theme-builder.css',
                [],
                filemtime(FBTH_WIDGET . 'assets/css/theme-builder.css')
            );

            wp_enqueue_style(
                'fbth-admin',
                FBTH_ASSETS_PUBLIC . '/css/admin.css',
                [],
                filemtime(FBTH_WIDGET . 'assets/css/admin.css')
            );

            $admin_customizer = [];
            $data             = array(
                'conditions'       => \FBTH\Elementor\ThemeBuilder\Common::get_location_selections(),
                'wp_json'          => get_rest_url(null, 'uicore/v1'),
                'nonce'            => wp_create_nonce('wp_rest'),
                'scheme'           => 'dark',
                'admin_url'        => get_admin_url(get_current_blog_id(), 'post.php'),
                // 'settings'   => Settings::current_settings(), //FOR GLOBALS
                'admin_customizer' => isset($admin_customizer['admin_customizer']) ? $admin_customizer['admin_customizer'] : false,
                'to_color'         => isset($admin_customizer['to_color']) ? $admin_customizer['to_color'] : null,

            );

            wp_add_inline_script('fbth-tb', 'var fbth_data = ' . json_encode($data), 'before');
        }
    }

    /**
     * Print Admin Tabs
     *
     * @param [type] $views
     * @return void
     * @since 2.0.0
     */
    public function admin_print_tabs($views)
    {

        $current_type = '';
        $active_class = ' nav-tab-active';

        if (!empty($_REQUEST['tb_type'])) {
            $current_type = $_REQUEST['tb_type'];
            $active_class = '';
        }

        $url_args = [
            'post_type' => 'fbth-tb',
        ];

        $baseurl = add_query_arg($url_args, admin_url('edit.php'));

        $doc_types = array(
            '_type_header' => __('Header', 'fbth'),
            '_type_footer' => __('Footer', 'fbth'),
            '_type_mm'     => __('Mega Menu', 'fbth'),
            '_type_cs'    => __('Case Study', 'fbth'),
            '_type_job'    => __('Job', 'fbth'),
            '_type_service'    => __('Service', 'fbth'),
            // '_type_block'  => __( 'Block', 'fbth' ),
            // '_type_popup'  => __( 'Popup', 'fbth' ),
            // '_type_single' => __('Single', 'fbth'),
            // '_type_archive' => __('Archive', 'fbth'),

        );
    ?>

        <div id="fbth-tb-wrapp"></div>
        <div id="fbth-theme-builder-tabs" class="nav-tab-wrapper">
            <a class="nav-tab<?php echo $active_class; ?>" href="<?php echo $baseurl; ?>">
                <?php echo __('All', 'fbth'); ?>
            </a>
            <?php
            foreach ($doc_types as $type => $type_label) :
                $active_class = '';

                if ($current_type === $type) {
                    $active_class = ' nav-tab-active';
                }

                $type_url = add_query_arg('tb_type', $type, $baseurl);

                echo "<a class='nav-tab{$active_class}' href='{$type_url}'>{$type_label}</a>";
            endforeach;
            ?>
        </div>
<?php
        return $views;
    }

    /**
     * Add Custom Columns in admin view table
     *
     * @param [type] $columns
     * @return void
     * @since [currentVersion]
     */
    function custom_columns($columns)
    {
        $columns['type'] = 'Type';
        $columns['info'] = 'Info';

        return $columns;
    }

    /**
     * Admin Custom Columns view table content
     *
     * @param [type] $name
     * @return void
     * @since 2.0.0
     */
    function display_custom_columns($name)
    {
        global $post;

        switch ($name) {
            case 'type':
                echo Common::get_the_type($post->ID);
                break;
            case 'info':
                echo $this->get_item_info($post->ID);
                break;
        }
    }

    /**
     * Get post type
     *
     * @param string $default
     * @return void
     * @since 2.0.0
     */
    public function get_current_tab_group($default = '')
    {
        $current_tabs_group = $default;

        if (!empty($_REQUEST['tb_type'])) {
            $doc_type = \Elementor\Plugin::$instance->documents->get_document_type($_REQUEST['tb_type'], '');
            if ($doc_type) {
                $current_tabs_group = $doc_type::get_property('admin_tab_group');
            }
        } elseif (!empty($_REQUEST['tabs_group'])) {
            $current_tabs_group = $_REQUEST['tabs_group'];
        }

        return $current_tabs_group;
    }

    /**
     * Get Item Info to diplay in admin table
     *
     * @param int $post_id
     * @return void
     * @since 2.0.0
     */
    function get_item_info($post_id)
    {
        $type = Common::get_the_type($post_id);
        $info = '';

        if ($type === 'mega menu') {
            $settings = get_post_meta($post_id, 'tb_settings', true);
            $info     = '<b>Width:</b> ' . ucfirst($settings['width']);
            if ($settings['width'] == 'custom') {
                $info .= ' (' . $settings['widthCustom'] . 'px)';
            }
        } elseif ($type === 'block') {
            $info = '<input class="wp-ui-text-highlight code" type="text" onfocus="this.select();" readonly="readonly" value="[fbth-block id=&quot;' . $post_id . '&quot;]">';
        } else {
            $info = self::get_pretty_condition('include', $post_id) . '</br>' . self::get_pretty_condition('exclude', $post_id);
        }

        return $info;
    }

    /**
     * Get pretty condition to display in admin table
     *
     * @param string $type
     * @param [type] $post_id
     * @return void
     * @since 2.0.0
     */
    static function get_pretty_condition($type, $post_id)
    {

        $info    = null;
        $include = get_post_meta($post_id, 'tb_rule_' . $type, true);

        if (is_array($include)) {
            $lastKey = array_keys($include);
            $lastKey = \end($lastKey);
            $info .= '<b>' . ucfirst($type) . ': </b>';

            foreach ($include as $k => $rule) {
                // var_dump($rule['rule']['value']);
                if ($rule['rule']['value'] === 'specifics') {
                    $specific_pages = null;
                    if (isset($rule['specific']) && \is_array($rule['specific'])) {
                        $lastKey2 = array_keys($rule['specific']);
                        $lastKey2 = \end($lastKey2);
                        foreach ($rule['specific'] as $k2 => $specific) {
                            $specific_pages .= $specific['text'] . ($lastKey2 === $k2 ? null : ', ');
                        }

                        $info .= 'Specific (' . $specific_pages . ')' . ($lastKey2 === $k2 ? null : ', ');
                    }
                } elseif ($rule['rule']['value'] === 'special_cs') {
                    $specific_pages = null;
                    if (isset($rule['special_cs']) && \is_array($rule['special_cs'])) {
                        $lastKey2 = array_keys($rule['special_cs']);
                        $lastKey2 = \end($lastKey2);
                        foreach ($rule['special_cs'] as $k2 => $specific) {
                            $specific_pages .= $specific['text'] . ($lastKey2 === $k2 ? null : ', ');
                        }

                        $info .= 'Specific Case Study (' . $specific_pages . ')' . ($lastKey2 === $k2 ? null : ', ');
                    }
                } elseif ($rule['rule']['value'] === 'special_job') {
                    $specific_pages = null;
                    if (isset($rule['special_job']) && \is_array($rule['special_job'])) {
                        $lastKey2 = array_keys($rule['special_job']);
                        $lastKey2 = \end($lastKey2);
                        foreach ($rule['special_job'] as $k2 => $specific) {
                            $specific_pages .= $specific['text'] . ($lastKey2 === $k2 ? null : ', ');
                        }

                        $info .= 'Specific Job (' . $specific_pages . ')' . ($lastKey2 === $k2 ? null : ', ');
                    }
                } elseif ($rule['rule']['value'] === 'special_service') {
                    $specific_pages = null;
                    if (isset($rule['special_service']) && \is_array($rule['special_service'])) {
                        $lastKey2 = array_keys($rule['special_service']);
                        $lastKey2 = \end($lastKey2);
                        foreach ($rule['special_service'] as $k2 => $specific) {
                            $specific_pages .= $specific['text'] . ($lastKey2 === $k2 ? null : ', ');
                        }

                        $info .= 'Specific Service (' . $specific_pages . ')' . ($lastKey2 === $k2 ? null : ', ');
                    }
                } else {
                    $info .= $rule['rule']['name'] . ($lastKey === $k ? null : ', ');
                }
            }
        }
        return $info;
    }
}
new Admin();
