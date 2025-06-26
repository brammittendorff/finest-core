<?php

namespace FBTH\Elementor\ThemeBuilder;

defined('ABSPATH') || exit();

/**
 * Theme Builder generic functions
 *
 * @since 2.0.0
 */
class Rule
{

    /**
     * Instance
     *
     * @since  1.0.0
     *
     * @var $instance
     */
    private static $instance;

    /**
     * Meta Option
     *
     * @since  1.0.0
     *
     * @var $meta_option
     */
    private static $meta_option;

    /**
     * Current page type
     *
     * @since  1.0.0
     *
     * @var $current_page_type
     */
    private static $current_page_type = null;

    /**
     * CUrrent page data
     *
     * @since  1.0.0
     *
     * @var $current_page_data
     */
    private static $current_page_data = array();

    /**
     * User Selection Option
     *
     * @since  1.0.0
     *
     * @var $user_selection
     */
    private static $user_selection;

    /**
     * Location Selection Option
     *
     * @since  1.0.0
     *
     * @var $location_selection
     */
    private static $location_selection;

    /**
     * Initiator
     *
     * @since  1.0.0
     */
    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Constructor
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        add_action('admin_action_edit', array($this, 'initialize_options'));
    }

    /**
     * Initialize member variables.
     *
     * @return void
     */
    public function initialize_options()
    {
        self::$location_selection = Common::get_location_selections();
    }

    /**
     * Checks for the display condition for the current page/
     *
     * @param  int   $post_id Current post ID.
     * @param  array $rules   Array of rules Display on | Exclude on.
     *
     * @return boolean      Returns true or false depending on if the $rules match for the current page and the layout is to be displayed.
     */
    public function parse_layout_display_condition($post_id, $rules)
    {
        $display           = false;
        $current_post_type = get_post_type($post_id);

        if (is_array($rules) && !empty($rules)) {
            foreach ($rules as $key => $rule) {

                if (strrpos($rule['rule']['value'], 'all') !== false) {
                    $rule_case = 'all';
                } else {
                    $rule_case = $rule['rule']['value'];
                }

                switch ($rule_case) {
                    case 'basic-global':
                        $display = true;
                        break;

                    case 'basic-page':
                        if (is_page()) {
                            $display = true;
                        }
                        break;

                    case 'basic-single':
                        if (is_single()) {
                            $display = true;
                        }
                        break;
                    case 'basic-portfolio':
                        if (is_singular('portfolio')) {
                            $display = true;
                        }
                        break;

                    case 'basic-cs':
                        if (is_singular('case-study')) {
                            $display = true;
                        }
                        break;

                    case 'basic-job':
                        if (is_singular('job')) {
                            $display = true;
                        }
                        break;
                    case 'basic-service':
                        if (is_singular('service')) {
                            $display = true;
                        }
                        break;

                    case 'basic-archives':
                        if (is_archive()) {
                            $display = true;
                        }
                        break;

                    case 'special-404':
                        if (is_404()) {
                            $display = true;
                        }
                        break;

                    case 'special-search':
                        if (is_search()) {
                            $display = true;
                        }
                        break;

                    case 'special-blog':
                        if (is_home()) {
                            $display = true;
                        }
                        break;

                    case 'special-front':
                        if (is_front_page()) {
                            $display = true;
                        }
                        break;

                    case 'special-date':
                        if (is_date()) {
                            $display = true;
                        }
                        break;

                    case 'special-author':
                        if (is_author()) {
                            $display = true;
                        }
                        break;

                    case 'special-woo-shop':
                        // var_dump('ok');
                        if (function_exists('is_shop') && is_shop()) {
                            $display = true;
                        }
                        break;

                    case 'all':
                        $rule_data = explode('|', $rule);

                        $post_type     = isset($rule_data[0]) ? $rule_data[0] : false;
                        $archieve_type = isset($rule_data[2]) ? $rule_data[2] : false;
                        $taxonomy      = isset($rule_data[3]) ? $rule_data[3] : false;
                        if (false === $archieve_type) {
                            $current_post_type = get_post_type($post_id);

                            if (false !== $post_id && $current_post_type == $post_type) {
                                $display = true;
                            }
                        } else {
                            if (is_archive()) {
                                $current_post_type = get_post_type();
                                if ($current_post_type == $post_type) {
                                    if ('archive' == $archieve_type) {
                                        $display = true;
                                    } elseif ('taxarchive' == $archieve_type) {
                                        $obj              = get_queried_object();
                                        $current_taxonomy = '';
                                        if ('' !== $obj && null !== $obj) {
                                            $current_taxonomy = $obj->taxonomy;
                                        }

                                        if ($current_taxonomy == $taxonomy) {
                                            $display = true;
                                        }
                                    }
                                }
                            }
                        }
                        break;

                    case 'specifics':
                        if (isset($rule['specific']) && is_array($rule['specific'])) {
                            foreach ($rule['specific'] as $specific_page) {
                                $specific_page = isset($specific_page['id']) ? $specific_page['id'] : $specific_page;
                                $specific_data = explode('-', $specific_page);

                                $specific_post_type = isset($specific_data[0]) ? $specific_data[0] : false;
                                $specific_post_id   = isset($specific_data[1]) ? $specific_data[1] : false;
                                if ('post' == $specific_post_type) {
                                    if ($specific_post_id == $post_id) {
                                        $display = true;
                                    }
                                } elseif (isset($specific_data[2]) && ('single' == $specific_data[2]) && 'tax' == $specific_post_type) {
                                    if (is_singular()) {
                                        $term_details = get_term($specific_post_id);

                                        if (isset($term_details->taxonomy)) {
                                            $has_term = has_term((int) $specific_post_id, $term_details->taxonomy, $post_id);

                                            if ($has_term) {
                                                $display = true;
                                            }
                                        }
                                    }
                                } elseif ('tax' == $specific_post_type) {
                                    $tax_id = get_queried_object_id();
                                    if ($specific_post_id == $tax_id) {
                                        $display = true;
                                    }
                                }
                            }
                        }
                        break;

                    case 'special_cs':

                        if (isset($rule['special_cs']) && is_array($rule['special_cs'])) {
                            foreach ($rule['special_cs'] as $special_cs_page) {
                                $special_cs_page = isset($special_cs_page['id']) ? $special_cs_page['id'] : $special_cs_page;
                                $special_cs_data = explode('-', $special_cs_page);

                                $special_cs_post_type = isset($special_cs_data[0]) ? $special_cs_data[0] : false;
                                $special_cs_post_id   = isset($special_cs_data[1]) ? $special_cs_data[1] : false;
                                if ('post' == $special_cs_post_type) {
                                    if ($special_cs_post_id == $post_id) {
                                        $display = true;
                                    }
                                } elseif (isset($special_cs_data[2]) && ('single' == $special_cs_data[2]) && 'tax' == $special_cs_post_type) {
                                    if (is_singular()) {
                                        $term_details = get_term($special_cs_post_id);

                                        if (isset($term_details->taxonomy)) {
                                            $has_term = has_term((int) $special_cs_post_id, $term_details->taxonomy, $post_id);

                                            if ($has_term) {
                                                $display = true;
                                            }
                                        }
                                    }
                                } elseif ('tax' == $special_cs_post_type) {
                                    $tax_id = get_queried_object_id();
                                    if ($special_cs_post_id == $tax_id) {
                                        $display = true;
                                    }
                                }
                            }
                        }
                        break;

                    case 'special_job':

                        if (isset($rule['special_job']) && is_array($rule['special_job'])) {
                            foreach ($rule['special_job'] as $special_job_page) {
                                $special_job_page = isset($special_job_page['id']) ? $special_job_page['id'] : $special_job_page;
                                $special_job_data = explode('-', $special_job_page);

                                $special_job_post_type = isset($special_job_data[0]) ? $special_job_data[0] : false;
                                $special_job_post_id   = isset($special_job_data[1]) ? $special_job_data[1] : false;
                                if ('post' == $special_job_post_type) {
                                    if ($special_job_post_id == $post_id) {
                                        $display = true;
                                    }
                                } elseif (isset($special_job_data[2]) && ('single' == $special_job_data[2]) && 'tax' == $special_job_post_type) {
                                    if (is_singular()) {
                                        $term_details = get_term($special_job_post_id);

                                        if (isset($term_details->taxonomy)) {
                                            $has_term = has_term((int) $special_job_post_id, $term_details->taxonomy, $post_id);

                                            if ($has_term) {
                                                $display = true;
                                            }
                                        }
                                    }
                                } elseif ('tax' == $special_job_post_type) {
                                    $tax_id = get_queried_object_id();
                                    if ($special_job_post_id == $tax_id) {
                                        $display = true;
                                    }
                                }
                            }
                        }
                        break;

                        case 'special_service':

                            if (isset($rule['special_service']) && is_array($rule['special_service'])) {
                                foreach ($rule['special_service'] as $special_service_page) {
                                    $special_service_page = isset($special_service_page['id']) ? $special_service_page['id'] : $special_service_page;
                                    $special_service_data = explode('-', $special_service_page);
                            
                                    $special_service_post_type = isset($special_service_data[0]) ? $special_service_data[0] : false;
                                    $special_service_post_id   = isset($special_service_data[1]) ? $special_service_data[1] : false;
                                    if ('post' == $special_service_post_type) {
                                        if ($special_service_post_id == $post_id) {
                                            $display = true;
                                        }
                                    } elseif (isset($special_service_data[2]) && ('single' == $special_service_data[2]) && 'tax' == $special_service_post_type) {
                                        if (is_singular()) {
                                            $term_details = get_term($special_service_post_id);
                            
                                            if (isset($term_details->taxonomy)) {
                                                $has_term = has_term((int) $special_service_post_id, $term_details->taxonomy, $post_id);
                            
                                                if ($has_term) {
                                                    $display = true;
                                                }
                                            }
                                        }
                                    } elseif ('tax' == $special_service_post_type) {
                                        $tax_id = get_queried_object_id();
                                        if ($special_service_post_id == $tax_id) {
                                            $display = true;
                                        }
                                    }
                                }
                            }
                            break;

                    default:
                        break;
                }

                if ($display) {
                    break;
                }
            }
        }

        return $display;
    }

    /**
     * Get current page type
     *
     * @since  1.0.0
     *
     * @return string Page Type.
     */
    public function get_current_page_type()
    {
        if (null === self::$current_page_type) {
            $page_type  = '';
            $current_id = false;

            if (is_404()) {
                $page_type = 'is_404';
            } elseif (is_search()) {
                $page_type = 'is_search';
            } elseif (is_archive()) {
                $page_type = 'is_archive';
                if (is_category() || is_tag() || is_tax()) {
                    $page_type = 'is_tax';
                } elseif (is_date()) {
                    $page_type = 'is_date';
                } elseif (is_author()) {
                    $page_type = 'is_author';
                } elseif (function_exists('is_shop') && is_shop()) {
                    $page_type = 'is_woo_shop_page';
                }
            } elseif (is_home()) {
                $page_type = 'is_home';
            } elseif (is_front_page()) {
                $page_type  = 'is_front_page';
                $current_id = get_the_id();
            } elseif (is_page()) {
                $page_type  = 'is_page';
                $current_id = get_the_id();
            } elseif (is_singular('post')) {
                $page_type  = 'is_single';
                $current_id = get_the_id();
            } elseif (is_singular('portfolio')) {
                $page_type  = 'is_portfolio';
                $current_id = get_the_id();
            } elseif (is_singular('case-study')) {
                $page_type  = 'is_cs_global';
                $current_id = get_the_id();
            } elseif (is_singular('job')) {
                $page_type  = 'is_job_global';
                $current_id = get_the_id();
            }elseif (is_singular('service')) {
                $page_type  = 'is_service_global';
                $current_id = get_the_id();
            } elseif (is_singular('product')) {
                $page_type  = 'is_product';
                $current_id = get_the_id();
            } elseif (is_singular('case-study')) {
                $page_type  = 'is_cs';
                $current_id = get_the_id();
            } elseif (is_singular('job')) {
                $page_type  = 'is_job';
                $current_id = get_the_id();
            }elseif (is_singular('service')) {
                $page_type  = 'is_service';
                $current_id = get_the_id();
            } else {
                $current_id = get_the_id();
            }

            self::$current_page_data['ID'] = $current_id;
            self::$current_page_type       = $page_type;
        }

        return self::$current_page_type;
    }

    /**
     * Get posts by conditions
     *
     * @since  1.0.0
     * @param  string $post_type Post Type.
     * @param  array  $option meta option name.
     *
     * @return object  Posts.
     */
    public function get_posts_by_conditions($option)
    {
        global $wpdb;
        global $post;

        $post_type = 'fbth-tb';

        if (is_array(self::$current_page_data) && isset(self::$current_page_data[$post_type])) {
            return self::$current_page_data[$post_type];
        }

        $current_page_type                   = $this->get_current_page_type();

        self::$current_page_data[$post_type] = array();

        $option['current_post_id'] = self::$current_page_data['ID'];
        $current_post_type         = esc_sql(get_post_type());
        $current_post_id           = false;
        $q_obj                     = get_queried_object();

        // var_dump($option);
        $include = isset($option['include']) ? esc_sql($option['include']) : '';

        $query = "SELECT p.ID, pm.meta_value FROM {$wpdb->postmeta} as pm
					INNER JOIN {$wpdb->posts} as p ON pm.post_id = p.ID
					WHERE pm.meta_key = '{$include}'
					AND p.post_type = '{$post_type}'
					AND p.post_status = 'publish'";

        $orderby = ' ORDER BY p.post_date DESC';

        /* Entire Website */
        $meta_args = "pm.meta_value LIKE '%\"basic-global\"%'";
        switch ($current_page_type) {
            case 'is_404':
                $meta_args .= " OR pm.meta_value LIKE '%\"special-404\"%'";
                break;
            case 'is_search':
                $meta_args .= " OR pm.meta_value LIKE '%\"special-search\"%'";
                break;
            case 'is_archive':
            case 'is_tax':
            case 'is_date':
            case 'is_author':
                $meta_args .= " OR pm.meta_value LIKE '%\"basic-archives\"%'";
                $meta_args .= " OR pm.meta_value LIKE '%\"{$current_post_type}|all|archive\"%'";

                if ('is_tax' == $current_page_type && (is_category() || is_tag() || is_tax())) {
                    if (is_object($q_obj)) {
                        $meta_args .= " OR pm.meta_value LIKE '%\"{$current_post_type}|all|taxarchive|{$q_obj->taxonomy}\"%'";
                        $meta_args .= " OR pm.meta_value LIKE '%\"tax-{$q_obj->term_id}\"%'";
                    }
                } elseif ('is_date' == $current_page_type) {
                    $meta_args .= " OR pm.meta_value LIKE '%\"special-date\"%'";
                } elseif ('is_author' == $current_page_type) {
                    $meta_args .= " OR pm.meta_value LIKE '%\"special-author\"%'";
                }
                break;
            case 'is_home':
                $meta_args .= " OR pm.meta_value LIKE '%\"special-blog\"%'";
                break;
            case 'is_front_page':
                $current_id      = esc_sql(get_the_id());
                $current_post_id = $current_id;
                $meta_args .= " OR pm.meta_value LIKE '%\"special-front\"%'";
                $meta_args .= " OR pm.meta_value LIKE '%\"{$current_post_type}|all\"%'";
                $meta_args .= " OR pm.meta_value LIKE '%\"post-{$current_id}\"%'";
                break;
            case 'is_page':
                $current_id      = esc_sql(get_the_id());
                $current_post_id = $current_id;
                $meta_args .= " OR pm.meta_value LIKE '%\"basic-page\"%'";
                $meta_args .= " OR pm.meta_value LIKE '%\"{$current_post_type}|all\"%'";
                $meta_args .= " OR pm.meta_value LIKE '%\"post-{$current_id}\"%'";
                break;
            case 'is_single':
                $current_id      = esc_sql(get_the_id());
                $current_post_id = $current_id;
                $meta_args .= " OR pm.meta_value LIKE '%\"basic-single\"%'";
                $meta_args .= " OR pm.meta_value LIKE '%\"{$current_post_type}|all\"%'";
                $meta_args .= " OR pm.meta_value LIKE '%\"post-{$current_id}\"%'";
                break;
            case 'is_portfolio':
                $current_id      = esc_sql(get_the_id());
                $current_post_id = $current_id;
                $meta_args .= " OR pm.meta_value LIKE '%\"basic-portfolio\"%'";
                $meta_args .= " OR pm.meta_value LIKE '%\"{$current_post_type}|all\"%'";
                $meta_args .= " OR pm.meta_value LIKE '%\"post-{$current_id}\"%'";

                $taxonomies = get_object_taxonomies($q_obj->post_type);
                $terms      = wp_get_post_terms($q_obj->ID, $taxonomies);

                foreach ($terms as $key => $term) {
                    $meta_args .= " OR pm.meta_value LIKE '%\"tax-{$term->term_id}-single-{$term->taxonomy}\"%'";
                }

                break;

            case 'is_job_global':

                $current_id      = esc_sql(get_the_id());
                $current_post_id = $current_id;

                $meta_args .= " OR pm.meta_value LIKE '%\"basic-job\"%'";
                $meta_args .= " OR pm.meta_value LIKE '%\"{$current_post_type}|all\"%'";
                $meta_args .= " OR pm.meta_value LIKE '%\"post-{$current_id}\"%'";

                $taxonomies = get_object_taxonomies($q_obj->post_type);
                $terms      = wp_get_post_terms($q_obj->ID, $taxonomies);

                foreach ($terms as $key => $term) {
                    $meta_args .= " OR pm.meta_value LIKE '%\"tax-{$term->term_id}-single-{$term->taxonomy}\"%'";
                }

                break;

             

            case 'is_cs_global':
                $current_id      = esc_sql(get_the_id());
                $current_post_id = $current_id;
                $meta_args .= " OR pm.meta_value LIKE '%\"basic-cs\"%'";
                $meta_args .= " OR pm.meta_value LIKE '%\"{$current_post_type}|all\"%'";
                $meta_args .= " OR pm.meta_value LIKE '%\"post-{$current_id}\"%'";

                $taxonomies = get_object_taxonomies($q_obj->post_type);
                $terms      = wp_get_post_terms($q_obj->ID, $taxonomies);

                foreach ($terms as $key => $term) {
                    $meta_args .= " OR pm.meta_value LIKE '%\"tax-{$term->term_id}-single-{$term->taxonomy}\"%'";
                }

                break;

                case 'is_service_global':

                    $current_id      = esc_sql(get_the_id());
                    $current_post_id = $current_id;
    
                    $meta_args .= " OR pm.meta_value LIKE '%\"basic-service\"%'";
                    $meta_args .= " OR pm.meta_value LIKE '%\"{$current_post_type}|all\"%'";
                    $meta_args .= " OR pm.meta_value LIKE '%\"post-{$current_id}\"%'";
    
                    $taxonomies = get_object_taxonomies($q_obj->post_type);
                    $terms      = wp_get_post_terms($q_obj->ID, $taxonomies);
    
                    foreach ($terms as $key => $term) {
                        $meta_args .= " OR pm.meta_value LIKE '%\"tax-{$term->term_id}-single-{$term->taxonomy}\"%'";
                    }
    
                    break;

            case 'is_woo_shop_page':
                $current_id      = get_option('woocommerce_shop_page_id');
                $current_post_id = $current_id;

                $meta_args .= " OR pm.meta_value LIKE '%\"special-woo-shop\"%'";
                break;
            case 'is_product':
                $current_id      = get_the_ID();
                $current_post_id = $current_id;

                $meta_args .= " OR pm.meta_value LIKE '%\"special-woo-product\"%'";
                break;

            case 'is_cs':
                $current_id      = get_the_ID();
                $current_post_id = $current_id;

                $meta_args .= " OR pm.meta_value LIKE '%\"special_cs\"%'";
                break;
            case 'is_job':
                $current_id      = get_the_ID();
                $current_post_id = $current_id;

                $meta_args .= " OR pm.meta_value LIKE '%\"special_job\"%'";
                break;
            case 'is_service':
                $current_id      = get_the_ID();
                $current_post_id = $current_id;

                $meta_args .= " OR pm.meta_value LIKE '%\"special_service\"%'";
                break;
            case '':
                $current_post_id = get_the_id();
                break;
        }

        // Ignore the PHPCS warning about constant declaration.
        // @codingStandardsIgnoreStart
        $posts = $wpdb->get_results($query . ' AND (' . $meta_args . ')' . $orderby);
        // @codingStandardsIgnoreEnd
        foreach ($posts as $local_post) {
            self::$current_page_data[$post_type][$local_post->ID] = array(
                'id'       => $local_post->ID,
                'location' => unserialize($local_post->meta_value),
            );
        }

        $option['current_post_id'] = $current_post_id;

        $this->remove_exclusion_rule_posts($post_type, $option);

        // echo '<pre>';
        // var_dump(self::$current_page_data[$post_type]);
        // echo '</pre>';
        return self::$current_page_data[$post_type];
    }

    /**
     * Remove exclusion rule posts.
     *
     * @since  1.0.0
     * @param  string $post_type Post Type.
     * @param  array  $option meta option name.
     */
    public function remove_exclusion_rule_posts($post_type, $option)
    {
        $exclusion       = isset($option['exclude']) ? $option['exclude'] : '';
        $current_post_id = isset($option['current_post_id']) ? $option['current_post_id'] : false;

        foreach (self::$current_page_data[$post_type] as $c_post_id => $c_data) {

            $exclusion_rules = get_post_meta($c_post_id, $exclusion, true);

            $is_exclude = $this->parse_layout_display_condition($current_post_id, $exclusion_rules);
            // var_dump( $current_post_id );
            if ($is_exclude) {
                unset(self::$current_page_data[$post_type][$c_post_id]);
            }
        }
    }
}
Rule::get_instance();
//DO LIKE THIS FOR ALL!!!

// get_option( 'woocommerce_shop_page_id' );
// get_option( 'woocommerce_cart_page_id' );
// get_option( 'woocommerce_checkout_page_id' );
// get_option( 'woocommerce_pay_page_id' );
// get_option( 'woocommerce_thanks_page_id' );
// get_option( 'woocommerce_myaccount_page_id' );
// get_option( 'woocommerce_edit_address_page_id' );
// get_option( 'woocommerce_view_order_page_id' );
// get_option( 'woocommerce_terms_page_id' );

// var_dump(get_post_meta( 13932, 'tb_rule_include' ));