<?php
/*
Plugin Name: Finest Core
Plugin URI: https://github.com/brammittendorff/finest-core
Description: WARNING: This plugin is for internal use only. Do not use this plugin on your website. 
It is a specialized version created for specific requirements and may not work properly on other sites.
Use at your own risk - no support provided.
Version: 2.0.0
Author: Pescheck Development Team
Author URI: https://pescheck.io/
License: MIT
Text Domain: fbth
 */

if (!defined('ABSPATH')) {
    exit;
}

//Set plugin version constant.
define('FBTH_VERSION', '1.2.0');
/* Set constant path to the plugin directory. */
define('FBTH_WIDGET', trailingslashit(plugin_dir_path(__FILE__)));
// Plugin Function Folder Path
define('FBTH_WIDGET_INC', plugin_dir_path(__FILE__) . 'inc/');
define('FBTH_WIDGET_LIB', plugin_dir_path(__FILE__) . 'lib/');

// Plugin Extensions Folder Path
define('FBTH_WIDGET_EXTENSIONS', plugin_dir_path(__FILE__) . 'extensions/');

// Plugin Widget Folder Path
define('FBTH_WIDGET_DIR', plugin_dir_path(__FILE__) . 'widgets/');

// Assets Folder URL
define('FBTH_ASSETS_PUBLIC', plugins_url('assets', __FILE__));

// Assets Folder URL
define('FBTH_ASSETS_VERDOR', plugins_url('assets/vendor', __FILE__));

require_once FBTH_WIDGET_INC . 'helper-function.php';

//ThemeBuilder works only with Elementor
if (class_exists('\Elementor\Plugin')) {

    // require FBTH_WIDGET_INC . 'class-core.php'; //Elementor Incubator
    require FBTH_WIDGET_INC . 'theme-builder/class-common.php'; //Theme Builder generic functions
    require FBTH_WIDGET_INC . 'theme-builder/class-rule.php'; //Theme Builder generic functions
    require FBTH_WIDGET_INC . 'theme-builder/class-rest-api.php'; //Theme Builder generic functions
    require FBTH_WIDGET_INC . 'theme-builder/documents/class-base.php'; //Elementor Documnet Type
    require FBTH_WIDGET_INC . 'theme-builder/documents/class-single.php'; //Elementor Documnet Type
    if (is_admin()) {
        require_once FBTH_WIDGET_INC . 'theme-builder/class-admin.php';
    }
    if (!is_admin()) {
        require_once FBTH_WIDGET_INC . 'theme-builder/class-frontend.php'; //Frontend related functions
    }
}

require_once FBTH_WIDGET_INC . 'demo-setup.php';
require_once FBTH_WIDGET_INC . 'elmentor-extender.php';
require_once FBTH_WIDGET_INC . 'Metabox/header-footer.php';
require_once FBTH_WIDGET_INC . 'Metabox/nav.php';
require_once FBTH_WIDGET_INC . 'Classes/breadcrumb-class.php';
require_once FBTH_WIDGET_INC . 'Traits/creative-button-murkup.php';
require_once FBTH_WIDGET_INC . 'Traits/inline-button-murkup.php';
require_once FBTH_WIDGET_INC . 'Icon.php';


// require_once FBTH_WIDGET_LIB . 'ocdi/ocdi.php';
require_once FBTH_WIDGET_LIB . 'bridhy-elements/bridhy-elements.php';


require_once FBTH_WIDGET . 'base.php';



// Auto-update functionality removed - plugin is now open source
// Visit https://github.com/brammittendorff/finest-core for updates and support