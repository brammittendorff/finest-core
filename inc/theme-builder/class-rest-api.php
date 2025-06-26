<?php

namespace FBTH\Elementor\ThemeBuilder;

defined('ABSPATH') || exit();

class Api
{

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'add_route']);
    }

    /**
     * Add routes
     */
    public function add_route()
    {
        register_rest_route('uicore/v1', 'specific-search/', [
            [
                'methods'             => 'POST',
                'permission_callback' => [$this, 'check_for_permission'],
                'callback'            => [$this, 'get_specific'],
                'show_in_index'       => false,
            ],
        ]);
        register_rest_route('uicore/v1', 'theme-builder/', [
            [
                'methods'             => 'POST',
                'permission_callback' => [$this, 'check_for_permission'],
                'callback'            => [$this, 'cp_handle'],
                'show_in_index'       => false,
            ],
        ]);
        register_rest_route('uicore/v1', 'theme-builder/(?P<id>\d+)', [
            [
                'methods'             => 'GET',
                'permission_callback' => [$this, 'check_for_permission'],
                'callback'            => [$this, 'cp_get_info'],
                'show_in_index'       => false,
            ],
        ]);
    }

    public function check_for_permission()
    {
        // return true;
        return current_user_can('manage_options');
    }
    /**
     * Do Admin Utility functions from 'admin' API endpoint
     *
     * @param \WP_REST_Request $request
     * @return array Action Response
     * @since 1.0.0
     */
    public function get_specific(\WP_REST_Request $request)
    {

        if ($request['term']) {

            $search_string = isset($request['term']) ? sanitize_text_field($request['term']) : '';
            $data          = array();
            $result        = array();

            $args = array(
                'public'   => true,
                '_builtin' => false,
            );

            $output     = 'names'; // names or objects, note names is the default.
            $operator   = 'and'; // also supports 'or'.
            $post_types = get_post_types($args, $output, $operator);

            unset($post_types['elementor-hf']); //Exclude EHF templates.

            $post_types['Posts'] = 'post';
            $post_types['Pages'] = 'page';

            foreach ($post_types as $key => $post_type) {
                $data = array();

                if (isset($request['isCS']) && $request['isCS']) {
                    if ($post_type != 'case-study') {
                        continue;
                    }
                }
                if (isset($request['isJob']) && $request['isJob']) {
                    if ($post_type != 'job') {
                        continue;
                    }
                }
                if (isset($request['isService']) && $request['isService']) {
                    if ($post_type != 'service') {
                        continue;
                    }
                }
                add_filter('posts_search', array($this, 'search_only_titles'), 10, 2);

                $query = new \WP_Query(
                    array(
                        's'              => $search_string,
                        'post_type'      => $post_type,
                        'posts_per_page' => -1,
                    )
                );

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        $title = get_the_title();
                        $title .= (0 != $query->post->post_parent) ? ' (' . get_the_title($query->post->post_parent) . ')' : '';
                        $id     = get_the_id();
                        $data[] = array(
                            'id'   => 'post-' . $id,
                            'text' => $title,
                        );
                    }
                }

                if (is_array($data) && !empty($data)) {
                    $result[] = array(
                        'label' => $key,
                        'value' => $data,
                    );
                }
            }

            $data = array();

            wp_reset_postdata();

            $args = array(
                'public' => true,
            );

            $output     = 'objects'; // names or objects, note names is the default.
            $operator   = 'or'; // also supports 'or'.
            $taxonomies = get_taxonomies($args, $output, $operator);

            foreach ($taxonomies as $taxonomy) {

                if (isset($request['isCS']) && $request['isCS']) {

                    if ($taxonomy->name != 'case-study-category' && $taxonomy->name != 'case-study-tag') {
                        continue;
                    }
                }
                if (isset($request['isJob']) && $request['isJob']) {

                    if ($taxonomy->name != 'job-category' && $taxonomy->name != 'job-tag') {
                        continue;
                    }
                }
                if (isset($request['isService']) && $request['isService']) {

                    if ($taxonomy->name != 'service-category' && $taxonomy->name != 'service-tag') {
                        continue;
                    }
                }

                $terms = get_terms(
                    $taxonomy->name,
                    array(
                        'orderby'    => 'count',
                        'hide_empty' => 0,
                        'name__like' => $search_string,
                    )
                );




                $data = array();

                $label = ucwords($taxonomy->label);

                if (!empty($terms)) {
                    foreach ($terms as $term) {
                        $term_taxonomy_name = ucfirst(str_replace('_', ' ', $taxonomy->name));

                        $data[] = array(
                            'id'   => 'tax-' . $term->term_id,
                            'text' => $term->name . ' archive page',
                        );

                        $data[] = array(
                            'id'   => 'tax-' . $term->term_id . '-single-' . $taxonomy->name,
                            'text' => 'All singulars from ' . $term->name,
                        );
                    }
                }

                if (is_array($data) && !empty($data)) {
                    $result[] = array(
                        'label' => $label,
                        'value' => $data,
                    );
                }
            }

            // return the result in json.
            return $result;
        }

        return array();
    }

    /**
     * Return search results only by post title.
     * This is only run from hfe_get_posts_by_query()
     *
     * @param  (string)   $search   Search SQL for WHERE clause.
     * @param  (WP_Query) $wp_query The current WP_Query object.
     *
     * @return (string) The Modified Search SQL for WHERE clause.
     */
    function search_only_titles($search, $wp_query)
    {
        if (!empty($search) && !empty($wp_query->query_vars['search_terms'])) {
            global $wpdb;

            $q = $wp_query->query_vars;
            $n = !empty($q['exact']) ? '' : '%';

            $search = array();

            foreach ((array) $q['search_terms'] as $term) {
                $search[] = $wpdb->prepare("$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like($term) . $n);
            }

            if (!is_user_logged_in()) {
                $search[] = "$wpdb->posts.post_password = ''";
            }

            $search = ' AND ' . implode(' AND ', $search);
        }

        return $search;
    }

    /**
     * Do Admin Utility functions from 'admin' API endpoint
     *
     * @param \WP_REST_Request $request
     * @return array Action Response
     * @since 1.0.0
     */
    public function cp_handle(\WP_REST_Request $request)
    {
        if (isset($request['id'])) {
            $args = [
                'ID'          => $request['id'],
                'post_title'  => $request['name'],
                'post_type'   => 'fbth-tb',
                'post_status' => 'publish',
            ];

            $post_id = wp_insert_post($args);

            if (is_wp_error($post_id)) {
                return;
            } else {
                wp_set_post_terms($post_id, ($request['type'] === 'mega menu') ? '_type_' . 'mm' : '_type_' . $request['type'], 'tb_type');
                // wp_set_post_terms($post_id, 'tb_type', ($request['type'] === 'mega menu') ? '_type_' .'mm' : '_type_' .$request['type']);

                //Save Settings based on type (width or display rules)
                if ($request['type'] === 'mega menu') {
                    $mm_settings = [
                        'width'       => $request['width'],
                        'widthCustom' => $request['widthCustom'],
                    ];
                    update_post_meta($post_id, 'tb_settings', wp_slash($mm_settings));
                } elseif ($request['type'] === 'popup') {
                    update_post_meta($post_id, 'tb_rule_include', wp_slash($request['rule']['include']));
                    update_post_meta($post_id, 'tb_rule_exclude', wp_slash($request['rule']['exclude']));
                    update_post_meta($post_id, 'tb_settings', wp_slash($request['popupSettings']));
                } else {
                    update_post_meta($post_id, 'tb_rule_include', wp_slash($request['rule']['include']));
                    update_post_meta($post_id, 'tb_rule_exclude', wp_slash($request['rule']['exclude']));
                    update_post_meta($post_id, 'tb_settings', wp_slash(['keep_default' => $request["keepDefault"]]));
                }

                return ['status' => 'success', 'id' => $post_id];
            }
        }
        return ['status' => 'error'];
    }

    /**
     * Do Admin Utility functions from 'admin' API endpoint
     *
     * @param \WP_REST_Request $request
     * @return array Action Response
     * @since 1.0.0
     */
    public function cp_get_info(\WP_REST_Request $request)
    {
        $post     = get_post((int) $request['id']);
        $type     = Common::get_the_type($post->ID);
        $settings = get_post_meta($post->ID, 'tb_settings', true);
        $include  = get_post_meta($post->ID, 'tb_rule_include', true);
        $exclude  = get_post_meta($post->ID, 'tb_rule_exclude', true);
        $response = array(
            'id'          => $post->ID,
            'name'        => $post->post_title,
            'type'        => $type,
            'rule'        => [
                'include' => $include ? $include : array(['rule' => '', 'specific' => '']),
                'exclude' => $exclude ? $exclude : [],
            ],
            'width'       => $settings['width'] ? $settings['width'] : null,
            'widthCustom' => $settings['widthCustom'] ? $settings['widthCustom'] : null,
            'keepDefault' => $settings['keep_default'] ? $settings['keep_default'] : null
        );
        if ($type === 'popup') {
            $response['popupSettings'] = $settings;
        }
        return $response;
    }
}
new Api();
