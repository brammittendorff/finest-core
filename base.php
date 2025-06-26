<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

final class FBTH_Extension
{

    const VERSION                   = '1.0.0';
    const MINIMUM_ELEMENTOR_VERSION = '2.6.0';
    const MINIMUM_PHP_VERSION       = '5.6';

    private static $_instance = null;

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {

        add_action('init', [$this, 'i18n']);
        add_action('plugins_loaded', [$this, 'init']);
    }

    public function i18n()
    {
        load_plugin_textdomain('fbth');
    }

    public function init()
    {
		if( true != get_option('elementor_unfiltered_files_upload')){
            update_option( 'elementor_unfiltered_files_upload', 1 );
        }
        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return;
        }
        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return;
        }

        //add_action( 'elementor/editor/after_enqueue_styles', array ( $this, 'pawelements_editor_styles' ) );
        add_action('elementor/widgets/register', [$this, 'init_widgets']);
        add_action('elementor/elements/categories_registered', [$this, 'register_new_category']);
        add_action('elementor/editor/after_enqueue_scripts', [$this, 'fbth_editor_scripts_js'], 100);
        add_action('wp_enqueue_scripts', array($this, 'fbth_register_frontend_styles'), 10);
        add_action('elementor/frontend/before_register_scripts', [$this, 'fbth_register_frontend_scripts']);
    }

    /**
     * Load Frontend Script
     *
     */
    public function fbth_register_frontend_scripts()
    {
        wp_enqueue_style(
            'fbth-addons-style',
            FBTH_ASSETS_PUBLIC . '/css/widget-style.css',
            null,
            FBTH_VERSION,
        );
        wp_enqueue_style(
            'extra-css-style',
            FBTH_ASSETS_PUBLIC . '/css/extra.css',
            null,
            FBTH_VERSION,
        );

        wp_enqueue_style(
            'custom-fonts',
            FBTH_ASSETS_PUBLIC . '/css/custom-fonts.css',
            null,
            FBTH_VERSION
        );
       
        wp_enqueue_style(
            'fbth-fonts',
            FBTH_ASSETS_PUBLIC . '/css/fd-icon.css',
            null,
            FBTH_VERSION
        );

        wp_enqueue_style(
            'creative-button',
            FBTH_ASSETS_PUBLIC . '/css/creative-button.css',
            null,
            FBTH_VERSION,
        );

        wp_enqueue_style(
            'inline-button',
            FBTH_ASSETS_PUBLIC . '/css/inline-button.css',
            null,
            FBTH_VERSION,
        );
        wp_enqueue_style(
            'grid-css',
            FBTH_ASSETS_PUBLIC . '/css/grid.css',
            null,
            FBTH_VERSION,
        );
        wp_enqueue_style(
            'fancybox',
            FBTH_ASSETS_PUBLIC . '/css/fancybox.min.css',
            null,
            FBTH_VERSION,
        );
        wp_enqueue_style(
            'fbth-cs-owl',
            FBTH_ASSETS_PUBLIC . '/css/owl.carousel.min.css',
            null,
            FBTH_VERSION,
        );
        wp_enqueue_style(
            'slick',
            FBTH_ASSETS_PUBLIC . '/css/slick.css',
            null,
            FBTH_VERSION,
        );

        // Add Finest Core MAP API
        $fbth_map = get_theme_mods('fbth_map_api_settings');
        $mapApi   = isset($fbth_map['fbth_map_api_settings']) ? $fbth_map['fbth_map_api_settings'] : 1;
        if ('1' !== $mapApi) {
            $api = sprintf('https://maps.googleapis.com/maps/api/js?key=%1$s&language=%2$s', $mapApi, 'en');
            wp_register_script('fbth-maps-api-input', $api, array(), '', false);
        }
        wp_enqueue_script(
            'fbth-maps-api-js',
            FBTH_ASSETS_PUBLIC . '/js/fbth-maps.js',
            ['jquery'],
            FBTH_VERSION,
            true
        );
        wp_enqueue_script(
            'typed',
            FBTH_ASSETS_PUBLIC . '/js/typed.min.js',
            ['jquery'],
            FBTH_VERSION,
            true
        );

        wp_enqueue_script(
            'fbth-slick',
            FBTH_ASSETS_PUBLIC . '/js/slick.min.js',
            ['jquery'],
            FBTH_VERSION,
            true
        );
        wp_enqueue_script(
            'fbth-js-owl',
            FBTH_ASSETS_PUBLIC . '/js/owl.carousel.min.js',
            ['jquery'],
            FBTH_VERSION,
            true
        );

        wp_enqueue_script(
            'isotope',
            FBTH_ASSETS_PUBLIC . '/js/isotope.pkgd.min.js',
            ['jquery'],
            FBTH_VERSION,
            true
        );
        wp_enqueue_script(
            'packery',
            FBTH_ASSETS_PUBLIC . '/js/packery-mode.pkgd.min.js',
            ['jquery'],
            FBTH_VERSION,
            true
        );
        wp_enqueue_script(
            'imagesloaded',
            FBTH_ASSETS_PUBLIC . '/js/imagesloaded.pkgd.min.js',
            ['jquery'],
            FBTH_VERSION,
            true
        );

        wp_enqueue_script(
            'fancybox',
            FBTH_ASSETS_PUBLIC . '/js/jquery.fancybox.min.js',
            ['jquery'],
            FBTH_VERSION,
            true
        );


        // widget js
        wp_enqueue_script(
            'fbth-addons-script',
            FBTH_ASSETS_PUBLIC . '/js/widget.js',
            array('jquery'),
            FBTH_VERSION,
            true
        );
    }

    public function fbth_editor_scripts_js()
    {

        wp_enqueue_script(
            'fbth-editor-script',
            FBTH_ASSETS_PUBLIC . '/js/editor.js',
            array('jquery'),
            FBTH_VERSION,
            true
        );
    }

    /**
     * Load Frontend Styles
     *
     */
    public function fbth_register_frontend_styles()
    {
        wp_enqueue_style(
            'themify-icons',
            FBTH_ASSETS_PUBLIC . '/vendor/themify-icons/themify-icons.css',
            null,
            FBTH_VERSION
        );

        wp_enqueue_script(
            'fbth-main',
            FBTH_ASSETS_PUBLIC . '/js/fbth-main.js',
            ['jquery'],
            FBTH_VERSION,
            true
        );
    }

    /**
     * Widgets Catgory
     *
     */
    public function register_new_category($manager)
    {
        $manager->add_category(
            'fbth',
            [
                'title' => __('Finest Core Elementor Helper  Addons', 'fbth'),
            ]
        );
    }

    public function admin_notice_minimum_php_version()
    {

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'fbth'),
            '<strong>' . esc_html__('Elementor Pawelements Extension', 'fbth') . '</strong>',
            '<strong>' . esc_html__('PHP', 'fbth') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function admin_notice_missing_main_plugin()
    {

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'fbth'),
            '<strong>' . esc_html__('Elementor fbth Extension', 'fbth') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'fbth') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function admin_notice_minimum_elementor_version()
    {

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'fbth'),
            '<strong>' . esc_html__('Elementor Finest Core Extension', 'fbth') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'fbth') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function init_widgets($widgets_manager)
    {

        /*
         * Extensions Include
         */
        // require_once FBTH_WIDGET_EXTENSIONS . 'custom-css.php'; // File missing
        require_once FBTH_WIDGET_EXTENSIONS . 'container-control.php';
        require_once FBTH_WIDGET_EXTENSIONS . 'css-transform.php';
        require_once FBTH_WIDGET_EXTENSIONS . 'custom-position.php';
        require_once FBTH_WIDGET_EXTENSIONS . 'floting-effect.php';

        //Include Widget files
        require_once FBTH_WIDGET_DIR . 'Heading/widget.php';
        require_once FBTH_WIDGET_DIR . 'BlogPost/widget.php';
        require_once FBTH_WIDGET_DIR . 'TextEditor/widget.php';
        require_once FBTH_WIDGET_DIR . 'Excerpt/widget.php';
        require_once FBTH_WIDGET_DIR . 'ContactForm7/widget.php';
        require_once FBTH_WIDGET_DIR . 'FeatureImage/widget.php';
        require_once FBTH_WIDGET_DIR . 'Breadcrumb/widget.php';
        require_once FBTH_WIDGET_DIR . 'Menu/widget.php';
        require_once FBTH_WIDGET_DIR . 'Logo/widget.php';
        require_once FBTH_WIDGET_DIR . 'Advance-Tab/widget.php';
        require_once FBTH_WIDGET_DIR . 'Tab/widget.php';
        require_once FBTH_WIDGET_DIR . 'IconBox/widget.php';
        require_once FBTH_WIDGET_DIR . 'DualHeading/widget.php';
        require_once FBTH_WIDGET_DIR . 'Popup/widget.php';
        require_once FBTH_WIDGET_DIR . 'ModalPopup/widget.php';
        require_once FBTH_WIDGET_DIR . 'CreativeButton/widget.php';
        require_once FBTH_WIDGET_DIR . 'PricingBox/widget.php';
        require_once FBTH_WIDGET_DIR . 'PriceTable/widget.php';
        require_once FBTH_WIDGET_DIR . 'PriceTableList/widget.php';
        require_once FBTH_WIDGET_DIR . 'Accordion/widget.php';
        require_once FBTH_WIDGET_DIR . 'AniamteText/widget.php';
        require_once FBTH_WIDGET_DIR . 'Search/widget.php';
        require_once FBTH_WIDGET_DIR . 'DualButton/widget.php';
        require_once FBTH_WIDGET_DIR . 'InlineButton/widget.php';
        require_once FBTH_WIDGET_DIR . 'GoogleMap/widget.php';
        require_once FBTH_WIDGET_DIR . 'Testimonial/widget.php';
        require_once FBTH_WIDGET_DIR . 'BrandSlider/widget.php';
        require_once FBTH_WIDGET_DIR . 'TeamMember/widget.php';
        require_once FBTH_WIDGET_DIR . 'Button/widget.php';
        require_once(FBTH_WIDGET_DIR . 'Slider/slider.php');
        require_once(FBTH_WIDGET_DIR . 'Ticker-Slider/widget.php');
        require_once(FBTH_WIDGET_DIR . 'Ticker-Testimonial-Slider/widget.php');
        require_once(FBTH_WIDGET_DIR . 'SignUp/widget.php');
        require_once(FBTH_WIDGET_DIR . 'SignIn/widget.php');
        require_once(FBTH_WIDGET_DIR . 'ResetPassword/widget.php');
    }
}
FBTH_Extension::instance();

/**
 * Add Font Group
 */
// add_filter('elementor/fonts/groups', function ($font_groups) {
//     $font_groups['finest_fonts'] = __('Finest Custom Fonts');
//     return $font_groups;
// });
// add_filter('elementor/fonts/additional_fonts', function ($additional_fonts) {
//     $additional_fonts['Outfit'] = 'finest_fonts';
//     return $additional_fonts;
// });


function fbth_add_file_types_to_uploads($file_types){
$new_filetypes = array();
$new_filetypes['svg'] = 'image/svg+xml';
$file_types = array_merge($file_types, $new_filetypes );
return $file_types;
}
add_action('upload_mimes', 'fbth_add_file_types_to_uploads');




