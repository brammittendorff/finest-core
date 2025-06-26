<?php
/**
 * Plugin base class
 *
 * @package Uxtheme_Elements
 */
namespace Uxtheme_Elements\Elementor;

defined( 'ABSPATH' ) || die();

class Base {

    private static $instance = null;

    public $appsero = null;

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
            self::$instance->init();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action( 'init', [$this, 'i18n'] );
    }

    public function i18n() {
        load_plugin_textdomain(
            'bridhy-elements-addons',
            false,
            dirname( plugin_basename( BRIDHY_ELEMENTS__FILE__ ) ) . '/i18n/'
        );
    }

    public function init() {
        $this->include_files();
        do_action( 'bridhyelements_loaded' );
    }

    public function include_files() {

        include_once BRIDHY_ELEMENTS_DIR_PATH . 'func.php';

        include_once BRIDHY_ELEMENTS_DIR_PATH . 'classes/assets-manager.php';

        if ( is_user_logged_in() ) {
            // include_once( BRIDHY_ELEMENTS_DIR_PATH . 'classes/cross.php' );
            include_once BRIDHY_ELEMENTS_DIR_PATH . 'classes/library-manager.php';
            include_once BRIDHY_ELEMENTS_DIR_PATH . 'classes/library-source.php';
        }
    }

}
