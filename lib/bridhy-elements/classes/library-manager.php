<?php
namespace Uxtheme_Elements\Elementor;

use Elementor\Core\Common\Modules\Ajax\Module as Ajax;

defined( 'ABSPATH' ) || die();

class Library_Manager {

    protected static $source = null;

    public static function init() {
        add_action( 'elementor/editor/footer', [__CLASS__, 'print_template_views'] );
        add_action( 'elementor/ajax/register_actions', [__CLASS__, 'register_ajax_actions'] );
    }

    public static function print_template_views() {
        include_once BRIDHY_ELEMENTS_DIR_PATH . 'templates/template-library/templates.php';
    }

    public static function enqueue_assets() {
        wp_enqueue_style(
            'bridhy-elements-templates-library',
            BRIDHY_ELEMENTS_ASSETS . 'admin/css/template-library.min.css',
            [
                'elementor-editor',
            ],
            BRIDHY_ELEMENTS_VERSION
        );

        wp_enqueue_script(
            'bridhy-elements-templates-library',
            BRIDHY_ELEMENTS_ASSETS . 'admin/js/template-library.min.js',
            [
                'elementor-editor',
                'jquery-hover-intent',
            ],
            BRIDHY_ELEMENTS_VERSION,
            true
        );
    }

    /**
     * Undocumented function
     *
     * @return Library_Source
     */
    public static function get_source() {
        if ( is_null( self::$source ) ) {
            self::$source = new Library_Source();
        }

        return self::$source;
    }

    public static function register_ajax_actions( Ajax $ajax ) {
        $ajax->register_ajax_action( 'get_bridhy_theme_data', function ( $data ) {
            if ( !current_user_can( 'edit_posts' ) ) {
                throw new \Exception( 'Access Denied' );
            }

            if ( !empty( $data['editor_post_id'] ) ) {
                $editor_post_id = absint( $data['editor_post_id'] );

                if ( !get_post( $editor_post_id ) ) {
                    throw new \Exception( __( 'Post not found.', 'bridhy-elements' ) );
                }

                uxelements_elementor()->db->switch_to_post( $editor_post_id );
            }

            $result = self::get_uxelements_theme_data( $data );

            return $result;
        } );

        $ajax->register_ajax_action( 'get_bridhy_library_data', function ( $data ) {
            if ( !current_user_can( 'edit_posts' ) ) {
                throw new \Exception( 'Access Denied' );
            }

            if ( !empty( $data['editor_post_id'] ) ) {
                $editor_post_id = absint( $data['editor_post_id'] );

                if ( !get_post( $editor_post_id ) ) {
                    throw new \Exception( __( 'Post not found.', 'bridhy-elements' ) );
                }

                uxelements_elementor()->db->switch_to_post( $editor_post_id );
            }

            $result = self::get_uxelements_library_data( $data );

            return $result;
        } );

        $ajax->register_ajax_action( 'get_uxelements_template_data', function ( $data ) {
            if ( !current_user_can( 'edit_posts' ) ) {
                throw new \Exception( 'Access Denied' );
            }

            if ( !empty( $data['editor_post_id'] ) ) {
                $editor_post_id = absint( $data['editor_post_id'] );

                if ( !get_post( $editor_post_id ) ) {
                    throw new \Exception( __( 'Post not found', 'bridhy-elements' ) );
                }

                uxelements_elementor()->db->switch_to_post( $editor_post_id );
            }

            if ( empty( $data['template_id'] ) ) {
                throw new \Exception( __( 'Template id missing', 'bridhy-elements' ) );
            }

            $result = self::get_uxelements_template_data( $data );

            return $result;
        } );
    }

    public static function get_uxelements_template_data( array $args ) {
        $source = self::get_source();
        $data   = $source->get_data( $args );
        return $data;
    }

    /**
     * Get library data from cache or remote
     *
     * type_tags has been added in version 2.15.0
     *
     * @param array $args
     *
     * @return array
     */
    public static function get_uxelements_library_data( array $args ) {
        $source = self::get_source();

        if ( !empty( $args['sync'] ) ) {
            Library_Source::get_bridhy_library_data( true );
        }

        return [
            'templates' => $source->get_items(),
            'tags'      => $source->get_tags(),
            'type_tags' => $source->get_type_tags(),
        ];
    }

    /**
     * Get library data from cache or remote
     *
     * type_tags has been added in version 2.15.0
     *
     * @param array $args
     *
     * @return array
     */
    public static function get_uxelements_theme_data( array $data ) {
        $source = self::get_source();

        if ( !empty( $data['sync'] ) ) {
            Library_Source::get_bridhy_theme_data( $data, true );
        }

        return [
            'templates' => $source->get_themes( $data ),
        ];
    }
}

Library_Manager::init();
