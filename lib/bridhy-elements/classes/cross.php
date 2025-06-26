<?php

namespace FinestAddons\Includes;

use Elementor\Controls_Stack;
use Elementor\Utils;

if ( !defined( 'WPINC' ) ) {
    die;
}

/*
 * finest Cross Domain Copy Paste Feature
 */
if ( !class_exists( 'Finest_Addons_Cross_CP' ) ) {

    /**
     * Define Finest_Addons_Cross_CP class
     */
    class Finest_Addons_Cross_CP {

        /**
         * Class instance
         *
         * @var instance
         */
        private static $instance = null;

        /**
         * Initalize integration hooks
         *
         * @return void
         */
        public function __construct() {
            add_action( 'wp_ajax_finest_cross_cp_import', array( $this, 'cross_cp_fetch_content_data' ) );

            add_action( 'wp_ajax_get_section_data', [$this, 'get_section_data'] );
            add_action( 'wp_ajax_nopriv_get_section_data', [$this, 'get_section_data'] );


            // add_filter( 'elementor/widget/print_template', [$this, 'change_heading_js_template'], 10, 2);

            // add_filter( 'elementor/widget/render_content', [$this, 'change_heading_template'], 10, 12 );

            //  add_action( 'elementor/frontend/section/before_render', [$this, 'add_attributes_to_elements' ]  );

        }

 
        function add_attributes_to_elements( $element ) {
            if ( !$element->get_settings( 'finest_copy_json_data' ) ) {
                return;
            }
            $setting = $element->get_settings();

            var_dump( $setting['finest_copy_json_data'] );

            var_dump( "hello world" );
        }

        // function change_heading_template( $template, $widget ) {
        //     // $settings = $widget->get_settings();

        //     // var_dump($settings['finest_copy_json_data']);

        //     if($widget->get_name() == 'section' ){
        //         return $template.'hello01';
        //     }else{
        //         return $template.'hello02';
        //     }

        // }

        // function change_heading_js_template( $template, $widget ) {
        //     // $settings = $widget->get_settings();

        //     // var_dump($settings['finest_copy_json_data']);
        //     return $template.'hello';
        // }

        /**
         * Cross copy paste fetch data.
         *
         * @since  3.21.1
         */
        public static function cross_cp_fetch_content_data() {

            // check_ajax_referer( 'finest_cross_cp_import', 'nonce' );

            if ( !current_user_can( 'edit_posts' ) ) {
                wp_send_json_error(
                    __( 'Not a Valid', 'finest-addons-for-elementor' ),
                    403
                );
            }

            $media_import = isset( $_POST['copy_content'] ) ? wp_unslash( $_POST['copy_content'] ) : '';

            if ( empty( $media_import ) ) {
                wp_send_json_error( __( 'Empty Content.', 'finest-addons-for-elementor' ) );
            }

            $media_import = array( json_decode( $media_import, true ) );
            $media_import = self::cross_cp_import_elements_ids( $media_import );
            $media_import = self::cross_cp_import_copy_content( $media_import );

            wp_send_json_success( $media_import );
        }

        /**
         * Replace media element id with random id.
         *
         * @since  3.21.1
         *
         * @param object $media_import media to import.
         */
        protected static function cross_cp_import_elements_ids( $media_import ) {

            return \Elementor\Plugin::instance()->db->iterate_data(
                $media_import,
                function ( $element ) {
                    $element['id'] = Utils::generate_random_string();
                    return $element;
                }
            );

        }

        /**
         * Media import copy content.
         *
         * @since  3.21.1
         *
         * @param object $media_import media to import.
         */
        protected static function cross_cp_import_copy_content( $media_import ) {

            return \Elementor\Plugin::instance()->db->iterate_data(
                $media_import,
                function ( $element_data ) {
                    $elements = \Elementor\Plugin::instance()->elements_manager->create_element_instance( $element_data );

                    if ( !$elements ) {
                        return null;
                    }

                    return self::cross_cp_import_element( $elements );
                }
            );

        }

        /**
         * Start element copy content for media import.
         *
         * @since  3.21.1
         *
         * @param Controls_Stack $element element to import.
         */
        protected static function cross_cp_import_element( Controls_Stack $element ) {
            $get_element_instance = $element->get_data();
            $method               = 'on_import';

            if ( method_exists( $element, $method ) ) {
                $get_element_instance = $element->{$method}( $get_element_instance );
            }

            foreach ( $element->get_controls() as $get_control ) {
                $control_type = \Elementor\Plugin::instance()->controls_manager->get_control( $get_control['type'] );
                $control_name = $get_control['name'];

                if ( !$control_type ) {
                    return $get_element_instance;
                }

                if ( method_exists( $control_type, $method ) ) {
                    $get_element_instance['settings'][$control_name] = $control_type->{$method}( $element->get_settings( $control_name ), $get_control );
                }
            }

            return $get_element_instance;
        }

        /**
         * Returns the instance.
         *
         * @since  3.21.1
         * @return object
         *
         * @param array $shortcodes shortcodes.
         */
        public static function get_instance( $shortcodes = array() ) {

            if ( !isset( self::$instance ) ) {

                self::$instance = new self( $shortcodes );
            }

            return self::$instance;
        }

        public static function get_section_data() {
            /**
             * This check doesn't need any conditional block
             * when 3rd parameter (die) is true.
             */
            // check_ajax_referer( 'get_section_data', 'nonce' );

            $post_id    = isset( $_GET['post_id'] ) ? absint( $_GET['post_id'] ) : 0;
            $section_id = isset( $_GET['section_id'] ) ? $_GET['section_id'] : 0;

            if ( empty( $post_id ) || empty( $section_id ) ) {
                wp_send_json_error( 'Incomplete request' );
            }

            $is_built_with_elementor = \Elementor\Plugin::instance()->db->is_built_with_elementor( $post_id );

            if ( !$is_built_with_elementor ) {
                wp_send_json_error( 'Not built with elementor' );
            }

            $document       = \Elementor\Plugin::instance()->documents->get( $post_id );
            $elementor_data = $document ? $document->get_elements_data() : [];
            $data           = [];

            if ( !empty( $elementor_data ) ) {
                $data = wp_list_filter( $elementor_data, [
                    'id'     => $section_id,
                    'elType' => 'section',
                ] );

                $data = current( $data );

                if ( empty( $data ) ) {
                    wp_send_json_error( 'Section not found' );
                }
            }

            wp_send_json_success( $data );
        }

    }

}
