<?php
/**
 * Plugin Name:       Uxtheme Elements
 * Plugin URI:        https://bridhy.net/plugins/bridhy-elements/
 * Description:       Elements for Elementator
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      5.4
 * Author:            Kites.Dev
 * Author URI:        https://space.kites.dev/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       bridhy-elements
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) || die();

define( 'BRIDHY_ELEMENTS_VERSION', '1.10.3' );
define( 'BRIDHY_ELEMENTS__FILE__', __FILE__ );
define( 'BRIDHY_ELEMENTS_DIR_PATH', plugin_dir_path( BRIDHY_ELEMENTS__FILE__ ) );
define( 'BRIDHY_ELEMENTS_DIR_URL', plugin_dir_url( BRIDHY_ELEMENTS__FILE__ ) );
define( 'BRIDHY_ELEMENTS_ASSETS', trailingslashit( BRIDHY_ELEMENTS_DIR_URL . 'assets' ) );

define( 'BRIDHY_ELEMENTS_MINIMUM_ELEMENTOR_VERSION', '2.5.0' );

define( 'BRIDHY_ELEMENTS_THEME_API', 'b5d001c87b841fe208f248b7b2787bac1319a3a0' );

function bridhy_elements_init() {
    //require( BRIDHY_ELEMENTS_DIR_PATH . 'inc/functions.php' );

    // Check if Elementor installed and activated
    if ( !did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', 'bridhy_elementor_missing_notice' );
        return;
    }

    // Check for required Elementor version
    if ( !version_compare( ELEMENTOR_VERSION, BRIDHY_ELEMENTS_MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
        add_action( 'admin_notices', 'bridhy_required_elementor_version_missing_notice' );
        return;
    }

    require BRIDHY_ELEMENTS_DIR_PATH . 'files.php';
    \Uxtheme_Elements\Elementor\Base::instance();

    

}

add_action( 'admin_init', 'bridhy_elements_init' );

/**
 * Admin notice for elementor if missing
 *
 * @return void
 */
function bridhy_elementor_missing_notice() {
    $notice = sprintf(
        /* translators: 1: Plugin name 2: Elementor 3: Elementor installation link */
        __( '%1$s requires %2$s to be installed and activated to function properly. %3$s', 'bridhy-elements' ),
        '<strong>' . __( 'Uxtheme Elments', 'bridhy-elements' ) . '</strong>',
        '<strong>' . __( 'Elementor', 'bridhy-elements' ) . '</strong>',
        '<a href="' . esc_url( admin_url( 'plugin-install.php?s=Elementor&tab=search&type=term' ) ) . '">' . __( 'Please click on this link and install Elementor', 'bridhy-elements' ) . '</a>'
    );

    printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', $notice );
}

/**
 * Admin notice for required elementor version
 *
 * @return void
 */
function bridhy_required_elementor_version_missing_notice() {
    $notice = sprintf(
        /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
        esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'bridhy-elements' ),
        '<strong>' . esc_html__( 'Uxtheme Elments', 'bridhy-elements' ) . '</strong>',
        '<strong>' . esc_html__( 'Elementor', 'bridhy-elements' ) . '</strong>',
        BRIDHY_ELEMENTS_MINIMUM_ELEMENTOR_VERSION
    );

    printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', $notice );
}

use Elementor\Core\Settings\Page\Model;
use Elementor\Plugin;

// Retrieve the JSON code from the environment variable

function lib_init() {

    // $json_code = env('ELEMENTOR_SECTION_JSON');

    $json_code = '{"content":[{"id":"332dcbf1","settings":{"background_background":"classic","__globals__":{"background_color":"globals\/colors?id=fbth_primary"},"animation":"fadeInUp"},"elements":[{"id":"efd0473","settings":{"_column_size":100,"_inline_size":null},"elements":[{"id":"7b03053","settings":{"structure":"30","padding":{"unit":"px","top":"80","right":"0","bottom":"80","left":"0","isLinked":false},"padding_tablet":{"unit":"px","top":"40","right":"0","bottom":"20","left":"0","isLinked":false},"padding_mobile":{"unit":"px","top":"30","right":"0","bottom":"30","left":"0","isLinked":false}},"elements":[{"id":"55f0c1de","settings":{"_column_size":33,"_inline_size":null,"margin_tablet":{"unit":"px","top":"0","right":"0","bottom":"30","left":"0","isLinked":false},"margin_mobile":{"unit":"px","top":"0","right":"0","bottom":"0","left":"0","isLinked":false}},"elements":[{"id":"7a7eac3a","settings":{"ending_number":36,"suffix":"k+","title":"Satisfied global clients","typography_title_typography":"custom","typography_title_font_weight":"500","fbth_counter_align":"left","fbth_title_align":"left","fbth_counter_gap":{"unit":"px","size":15,"sizes":[]},"__globals__":{"title_color":"globals\/colors?id=fbth_neutral_2","number_color":"globals\/colors?id=fbth_white","typography_number_typography":"","typography_title_typography":""},"_margin_tablet":{"unit":"px","top":"0","right":"0","bottom":"0","left":"0","isLinked":true},"typography_title_font_size":{"unit":"px","size":18,"sizes":[]},"typography_title_line_height":{"unit":"px","size":28,"sizes":[]},"number_color":"#fff","typography_number_typography":"custom","typography_number_font_size_mobile":{"unit":"px","size":36,"sizes":[]},"typography_number_font_weight":"700","title_color":"#eaedf0","typography_number_font_size_tablet":{"unit":"px","size":60,"sizes":[]},"typography_number_line_height_tablet":{"unit":"em","size":1,"sizes":[]}},"elements":[],"isInner":false,"widgetType":"counter","elType":"widget"}],"isInner":true,"elType":"column"},{"id":"91484d4","settings":{"_column_size":33,"_inline_size":null,"margin_mobile":{"unit":"px","top":"15","right":"0","bottom":"15","left":"0","isLinked":false},"margin_tablet":{"unit":"px","top":"0","right":"0","bottom":"30","left":"0","isLinked":false}},"elements":[{"id":"3999fe20","settings":{"ending_number":79,"suffix":"%","title":"Download  total range","typography_number_typography":"custom","typography_number_font_weight":"700","typography_title_typography":"custom","typography_title_font_weight":"500","fbth_counter_align":"left","fbth_title_align":"left","fbth_counter_gap":{"unit":"px","size":15,"sizes":[]},"__globals__":{"title_color":"globals\/colors?id=fbth_neutral_2","number_color":"globals\/colors?id=fbth_white","typography_number_typography":"","typography_title_typography":""},"_margin_tablet":{"unit":"px","top":"0","right":"0","bottom":"0","left":"0","isLinked":true},"typography_number_font_size_mobile":{"unit":"px","size":36,"sizes":[]},"typography_title_font_size":{"unit":"px","size":18,"sizes":[]},"typography_title_line_height":{"unit":"px","size":28,"sizes":[]},"number_color":"#fff","title_color":"#eaedf0","typography_number_font_size_tablet":{"unit":"px","size":60,"sizes":[]},"typography_number_line_height_tablet":{"unit":"em","size":1,"sizes":[]}},"elements":[],"isInner":false,"widgetType":"counter","elType":"widget"}],"isInner":true,"elType":"column"},{"id":"33b8a121","settings":{"_column_size":33,"_inline_size":null},"elements":[{"id":"844f1c5","settings":{"ending_number":64,"suffix":"k+","title":"Finishing success projects","typography_number_typography":"custom","typography_number_font_weight":"700","typography_title_typography":"custom","typography_title_font_weight":"500","fbth_counter_align":"left","fbth_title_align":"left","fbth_counter_gap":{"unit":"px","size":15,"sizes":[]},"__globals__":{"title_color":"globals\/colors?id=fbth_neutral_2","number_color":"globals\/colors?id=fbth_white","typography_number_typography":"","typography_title_typography":""},"_margin_tablet":{"unit":"px","top":"0","right":"0","bottom":"0","left":"0","isLinked":true},"typography_number_font_size_mobile":{"unit":"px","size":36,"sizes":[]},"typography_title_font_size":{"unit":"px","size":18,"sizes":[]},"typography_title_line_height":{"unit":"px","size":28,"sizes":[]},"number_color":"#fff","title_color":"#eaedf0","typography_number_font_size_tablet":{"unit":"px","size":60,"sizes":[]},"typography_number_line_height_tablet":{"unit":"em","size":1,"sizes":[]}},"elements":[],"isInner":false,"widgetType":"counter","elType":"widget"}],"isInner":true,"elType":"column"}],"isInner":true,"elType":"section"}],"isInner":false,"elType":"column"}],"isInner":false,"elType":"section"}],"page_settings":[],"version":"0.4","title":"fact","type":"section"}';

    // Create a new Elementor section model
    $section_model = new Model( json_decode( $json_code, true ) );

    // Use the Elementor API to parse the JSON code and set the data for the section model

    // Use the render method to generate the HTML code for the section preview
    $html = $section_model->render();

    // Display the HTML code on your website
    echo $html;

    // var_dump( $elementor->frontend->get_builder_content_for_display( $json_data ) );
}

// add_action( 'init', 'lib_init' );
