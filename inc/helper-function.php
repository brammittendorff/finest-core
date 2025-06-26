<?php

/**
 * Get Pages
 *
 * @since 1.0
 *
 * @return array
 */


/**
 * Show cart contents / total Ajax
 */
add_filter('woocommerce_add_to_cart_fragments', 'stor_woocommerce_header_add_to_cart_fragment');

function stor_woocommerce_header_add_to_cart_fragment($fragments)
{

    ob_start();

?>
     <span class="cart-contents"><?php if ( !is_null(WC()->cart) ) {
         echo WC()->cart->get_cart_contents_count();
     } ?></span>

<?php
    $fragments['.cart-contents'] = ob_get_clean();
    return $fragments;
}





if ( ! function_exists( 'fbth_get_all_pages' ) ) {
    function fbth_get_all_pages($posttype = 'page')
    {
        $args = array(
            'post_type' => $posttype,
            'post_status' => 'publish',
            'posts_per_page' => -1
        );

        $page_list = array();
        if( $data = get_posts($args)){
            foreach($data as $key){
                $page_list[$key->ID] = $key->post_title;
            }
        }
        return  $page_list;
    }
}

/**
 * Meta Output
 *
 * @since 1.0
 *
 * @return array
 */
if ( ! function_exists( 'fbth_get_meta' ) ) {
    function fbth_get_meta( $data ) {
        global $wp_embed;
        $content = $wp_embed->autoembed( $data );
        $content = $wp_embed->run_shortcode( $content );
        $content = do_shortcode( $content );
        $content = wpautop( $content );
        return $content;
    }
}

/**
 * Get a list of all CF7 forms
 *
 * @return array
 */
if ( ! function_exists( 'fbth_get_cf7_forms' ) ) {
    function fbth_get_cf7_forms() {
        $forms = get_posts( [
            'post_type'      => 'wpcf7_contact_form',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ] );

        if ( ! empty( $forms ) ) {
            return wp_list_pluck( $forms, 'post_title', 'ID' );
        }
        return [];
    }
}
 /**
 * Check if contact form 7 is activated
 *
 * @return bool
 */
if ( ! function_exists( 'fbth_is_cf7_activated' ) ) {

    function fbth_is_cf7_activated() {
        return class_exists( 'WPCF7' );
    }
}

if ( ! function_exists( 'fbth_do_shortcode' ) ) {
    function fbth_do_shortcode( $tag, array $atts = array(), $content = null ) {
        global $shortcode_tags;
        if ( ! isset( $shortcode_tags[ $tag ] ) ) {
            return false;
        }
        return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
    }
}

function fbth_layout_content( $post_id ) {

    return Elementor\Plugin::instance()->frontend->get_builder_content( $post_id, true );
}

function fbth_cpt_slug_and_id( $post_type ) {
    $the_query = new WP_Query( array(
        'posts_per_page' => -1,
        'post_type'      => $post_type,
    ) );
    $cpt_posts = [];
    while ( $the_query->have_posts() ): $the_query->the_post();
        $cpt_posts[get_the_ID()] = get_the_title();
    endwhile;
    wp_reset_postdata();
    return $cpt_posts;
}

/**
 * Strip all the tags except allowed html tags
 */

function scalo_kses_basic( $string = '' ) {
	return wp_kses( $string, scalo_get_allowed_html_tags( 'basic' ) );
}

function scalo_get_allowed_html_tags( $level = 'basic' ) {
	$allowed_html = [
		'b' => [],
		'i' => [],
		'u' => [],
		's' => [],
		'br' => [],
		'em' => [],
		'del' => [],
		'ins' => [],
		'sub' => [],
		'sup' => [],
		'code' => [],
		'mark' => [],
		'small' => [],
		'strike' => [],
		'abbr' => [
			'title' => [],
		],
		'span' => [
			'class' => [],
		],
		'strong' => [],
	];
	return $allowed_html;
}


//  Blog post helper function 




/**
 * Meta Output
 *
 * @since 1.0
 *
 * @return array
 */
if (!function_exists('fbth_cpt_taxonomy_slug_and_name')) {

    function fbth_cpt_taxonomy_slug_and_name($taxonomy_name, $option_tag = false)
    {
        $taxonomyies = get_terms($taxonomy_name);
        if (true == $option_tag) {
            $cpt_terms = '';
            foreach ($taxonomyies as $category) {
                if (isset($category->slug) && isset($category->name)) {
                    $cpt_terms .= '<option value="' . esc_attr($category->slug) . '">' .  $category->name . '</option>';
                }
            }
            return $cpt_terms;
        }
        $cpt_terms = [];
        foreach ($taxonomyies as $category) {
            if (isset($category->slug) && isset($category->name)) {
                $cpt_terms[$category->slug] = $category->name;
            }
        }
        return $cpt_terms;
    }
}

if (!function_exists('fbth_cpt_taxonomy_id_and_name')) {
    function fbth_cpt_taxonomy_id_and_name($taxonomy_name)
    {
        $taxonomyies = get_terms($taxonomy_name);
        $cpt_terms = [];
        foreach ($taxonomyies as $category) {
            $cpt_terms[$category->term_id] = $category->name;
        }
        return $cpt_terms;
    }
}

if (!function_exists('fbth_cpt_author_slug_and_id')) {
    function fbth_cpt_author_slug_and_id($post_type)
    {
        $the_query = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => $post_type,
        ));
        $author_meta = [];
        while ($the_query->have_posts()) : $the_query->the_post();
            $author_meta[get_the_author_meta('ID')] = get_the_author_meta('display_name');
        endwhile;
        wp_reset_postdata();
        return array_unique($author_meta);
    }
}

if (!function_exists('fbth_cpt_slug_and_id')) {
    function fbth_cpt_slug_and_id($post_type)
    {
        $the_query = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => $post_type,
        ));
        $cpt_posts = [];
        while ($the_query->have_posts()) : $the_query->the_post();
            $cpt_posts[get_the_ID()] = get_the_title();
        endwhile;
        wp_reset_postdata();
        return $cpt_posts;
    }
}

if (!function_exists('fbth_get_meta_field_keys')) {

    function fbth_get_meta_field_keys($post_type, $field_name, $fild_type = "choices")
    {
        $the_query = new WP_Query(array(
            'posts_per_page' => 1,
            'post_type' => $post_type,
        ));

        $field_object = [];
        while ($the_query->have_posts()) : $the_query->the_post();
            $field_object = get_field_object($field_name)[$fild_type];
        endwhile;
        return $field_object;
        wp_reset_postdata();
    }
}

/**
 * Post orderby list
 */
if (!function_exists('fbth_get_post_orderby_options')) {
    function fbth_get_post_orderby_options()
    {
        $orderby = array(
            'ID' => 'Post ID',
            'author' => 'Post Author',
            'title' => 'Title',
            'date' => 'Date',
            'modified' => 'Last Modified Date',
            'parent' => 'Parent Id',
            'rand' => 'Random',
            'comment_count' => 'Comment Count',
            'menu_order' => 'Menu Order',
        );
        $orderby = apply_filters('it_post_orderby', $orderby);
        return $orderby;
    }
}

/**
 * Get Posts
 *
 * @since 1.0
 *
 * @return array
 */
if (!function_exists('fbth_get_all_posts')) {
    function fbth_get_all_posts($posttype)
    {
        $args = array(
            'post_type' => $posttype,
            'post_status' => 'publish',
            'posts_per_page' => -1
        );
        $post_list = array();
        if ($data = get_posts($args)) {
            foreach ($data as $key) {
                $post_list[$key->ID] = $key->post_title;
            }
        }
        return  $post_list;
    }
}

/**
 * Get Author list
 *
 * @since 1.0
 *
 * @return array
 */
if (!function_exists('fbth_get_authors')) {
    function fbth_get_authors()
    {
        $user_query = new \WP_User_Query(
            [
                'who' => 'authors',
                'has_published_posts' => true,
                'fields' => [
                    'ID',
                    'display_name',
                ],
            ]
        );
        $authors = [];
        foreach ($user_query->get_results() as $result) {
            $authors[$result->ID] = $result->display_name;
        }
        return $authors;
    }
}

/* FBTH Blog Post widget */

function fbth_get_current_user_display_name()
{
    $user = wp_get_current_user();
    $name = 'user';
    if ($user->exists() && $user->display_name) {
        $name = $user->display_name;
    }
    return $name;
}

function fbth_addons_cpt_taxonomy_slug_and_name($taxonomy_name, $option_tag = false)
{
    $taxonomyies = get_terms($taxonomy_name);
    if (true == $option_tag) {
        $cpt_terms = '';
        foreach ($taxonomyies as $category) {
            if (isset($category->slug) && isset($category->name)) {
                $cpt_terms .= '<option value="' . esc_attr($category->slug) . '">' . $category->name . '</option>';
            }
        }
        return $cpt_terms;
    }
    $cpt_terms = [];
    foreach ($taxonomyies as $category) {
        if (isset($category->slug) && isset($category->name)) {
            $cpt_terms[$category->slug] = $category->name;
        }
    }
    return $cpt_terms;
}
function fbth_addons_cpt_author_slug_and_id($post_type)
{
    $the_query = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type'      => $post_type,
    ));
    $author_meta = [];
    while ($the_query->have_posts()) : $the_query->the_post();
        $author_meta[get_the_author_meta('ID')] = get_the_author_meta('display_name');
    endwhile;
    wp_reset_postdata();
    return array_unique($author_meta);
}
function fbth_addons_cpt_slug_and_id($post_type)
{
    $the_query = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type'      => $post_type,
    ));
    $cpt_posts = [];
    while ($the_query->have_posts()) : $the_query->the_post();
        $cpt_posts[get_the_ID()] = get_the_title();
    endwhile;
    wp_reset_postdata();
    return $cpt_posts;
}


if (!function_exists('fbth_addons_comment_count')) :
    /**
     * Comment count
     */
    function fbth_addons_comment_count($clabel = 'Comment', $icon = '')
    {
        if (post_password_required() || !(comments_open() || get_comments_number())) {
            return;
        }
        ob_start();
?>
        <span class="fbth-addons-comment">
            <a href="<?php comments_link(); ?>">
                <span><?php echo $icon ?> <?php comments_number('0', '1', '%'); ?> <?php echo $clabel ?></span>
            </a>
        </span>


<?php
        return ob_get_clean();
    }
endif;
if (!function_exists('fbth_addons_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function fbth_addons_posted_by($label = 'by')
    {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x('%s', 'post author', 'fbth-addons'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );
        return '<span class="byline"> ' . $label . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;
if (!function_exists('fbth_addons_posted_date')) :
    /**
     * Prints HTML with meta information for the current date.
     */
    function fbth_addons_posted_date($icon = '')
    {
        $date_html = sprintf('<span class="post-date"> %s %s</span>', $icon, get_the_date());
        return $date_html;
    }
endif;
if (!function_exists('fbth_addons_posted_category')) :
    /**
     * Prints HTML with meta information for the current date.
     */
    function fbth_addons_posted_category($icon = '')
    {
        $post_cat = get_the_terms(get_the_ID(), 'category');
        $post_cat = join(', ', wp_list_pluck($post_cat, 'name'));
        $post_category = sprintf('<span class="category-list"> %s %s</span>', $icon, $post_cat);
        return $post_category;
    }
endif;
if (!function_exists('fbth_cpt_slug_and_id')) :
    function fbth_cpt_slug_and_id($post_type)
    {
        $the_query = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => $post_type,
        ));
        $cpt_posts = [];
        while ($the_query->have_posts()) : $the_query->the_post();
            $cpt_posts[get_the_ID()] = get_the_title();
        endwhile;
        wp_reset_postdata();
        return $cpt_posts;
    }
endif;
if (!function_exists('fbth_cpt_taxonomy_slug_and_name')) :
    function fbth_cpt_taxonomy_slug_and_name($taxonomy_name, $option_tag = false)
    {
        $taxonomyies = get_terms($taxonomy_name);
        if (true == $option_tag) {
            $cpt_terms = '';
            foreach ($taxonomyies as $category) {
                if (isset($category->slug) && isset($category->name)) {
                    $cpt_terms .= '<option value="' . esc_attr($category->slug) . '">' .  $category->name . '</option>';
                }
            }
            return $cpt_terms;
        }
        $cpt_terms = [];
        foreach ($taxonomyies as $category) {
            if (isset($category->slug) && isset($category->name)) {
                $cpt_terms[$category->slug] = $category->name;
            }
        }
        return $cpt_terms;
    }
endif;



/*
 * Check user Login and call this function
 */
global $user;
if ( empty( $user->ID ) ) {
    add_action( 'elementor/init', 'fbth_ajax_login_init' );
    add_action( 'elementor/init', 'fd_addons_ajax_register_init' );
}

/*
 * wp_ajax_nopriv Function
 */
function fbth_ajax_login_init() {
    add_action( 'wp_ajax_fbth_ajax_login', 'fbth_ajax_login' );
    add_action( 'wp_ajax_nopriv_fbth_ajax_login', 'fbth_ajax_login' );
}

/*
 * ajax login
 */
function fbth_ajax_login() {

    check_ajax_referer( 'ajax-login-nonce', 'security' );
    $user_data                     = array();
    $user_data['user_login']       = !empty( $_POST['username'] ) ? $_POST['username'] : "";
    $user_data['user_password']    = !empty( $_POST['password'] ) ? $_POST['password'] : "";
    $user_data['cf_user_password'] = !empty( $_POST['cf_password'] ) ? $_POST['cf_password'] : "";

    $user_data['remember'] = true;
    $user_signon           = wp_signon( $user_data, true );

    if ( is_wp_error( $user_signon ) ) {
        echo json_encode( ['loggeauth' => false, 'message' => esc_html__( 'Invalid username or password!', 'fd-addons' )] );
    } else {
        echo json_encode( ['loggeauth' => true, 'message' => esc_html__( 'Login Successfully', 'fd-addons' )] );
    }
    wp_die();
}

/*
 * wp_ajax_nopriv Register Function
 */
function fd_addons_ajax_register_init() {
    add_action( 'wp_ajax_nopriv_fd_addons_ajax_register', 'fd_addons_ajax_register' );
}

/*
 * Ajax Register Call back
 */
function fd_addons_ajax_register() {

    $user_data = array(
        'user_login'     => !empty( $_POST['reg_name'] ) ? $_POST['reg_name'] : "",
        'user_pass'      => !empty( $_POST['reg_password'] ) ? $_POST['reg_password'] : "",
        'cf_user_pass'   => !empty( $_POST['cf_reg_password'] ) ? $_POST['cf_reg_password'] : "",

        'reg_checkbox' => isset( $_POST['reg_checkbox'] )  && $_POST['reg_checkbox'] == 'true' ? true  : false ,

        'user_email'     => !empty( $_POST['reg_email'] ) ? $_POST['reg_email'] : "",
        'user_url'       => !empty( $_POST['reg_website'] ) ? $_POST['reg_website'] : "",
        'first_name'     => !empty( $_POST['reg_fname'] ) ? $_POST['reg_fname'] : "",
        'last_name'      => !empty( $_POST['reg_lname'] ) ? $_POST['reg_lname'] : "",
        'nickname'       => !empty( $_POST['reg_nickname'] ) ? $_POST['reg_nickname'] : "",
        'description'    => !empty( $_POST['reg_bio'] ) ? $_POST['reg_bio'] : "",
    );

    if ( fd_addons_validation_data( $user_data ) !== true ) {
        echo fd_addons_validation_data( $user_data );
    } else {
        $register_user = wp_insert_user( $user_data );
        if ( is_wp_error( $register_user ) ) {
            echo json_encode( ['registerauth' => false, 'message' => esc_html__( 'Something is wrong please check again!', 'fd-addons' )] );
        } else {
            echo json_encode( ['registerauth' => true, 'message' => esc_html__( 'Successfully Register', 'fd-addons' )] );
        }
    }
    wp_die();
}

// Register Data Validation
function fd_addons_validation_data( $user_data ) {

    $data = '';

    if ( empty( $user_data['user_login'] ) || empty( $_POST['reg_email'] ) || empty( $_POST['reg_password'] ) || empty( $_POST['cf_reg_password'] ) ) {
        return json_encode( ['registerauth' => false, 'message' => esc_html__( 'Username, Password and E-Mail are required', 'fd-addons' )] );
    }

    if ( !empty( $user_data['user_login'] ) ) {

        if ( 4 > strlen( $user_data['user_login'] ) ) {
            return json_encode( ['registerauth' => false, 'message' => esc_html__( 'Username too short. At least 4 characters is required', 'fd-addons' )] );
        }

        if ( username_exists( $user_data['user_login'] ) ) {
            return json_encode( ['registerauth' => false, 'message' => esc_html__( 'Sorry, that username already exists!', 'fd-addons' )] );
        }

        if ( !validate_username( $user_data['user_login'] ) ) {
            return json_encode( ['registerauth' => false, 'message' => esc_html__( 'Sorry, the username you entered is not valid', 'fd-addons' )] );
        }

    }

    if ( !empty( $user_data['user_pass'] ) && !empty( $user_data['cf_user_pass'] ) ) {
        if ( isset( $user_data['user_pass'] ) && $user_data['user_pass'] != $user_data['cf_user_pass'] ) {
            return json_encode( ['registerauth' => false, 'message' => esc_html__( 'The passwords do not match.', 'fd-addons' )] );
        }
    }

    if ( !$user_data['reg_checkbox'] ) {
        return json_encode( ['registerauth' => false, 'message' => esc_html__( 'You must accept our privacy policy and terms.', 'fd-addons' )] );
    }

    if ( !empty( $user_data['user_pass'] ) ) {
        if ( 5 > strlen( $user_data['user_pass'] ) ) {
            return json_encode( ['registerauth' => false, 'message' => esc_html__( 'Password length must be greater than 5', 'fd-addons' )] );
        }
    }

    if ( !empty( $user_data['user_email'] ) ) {
        if ( !is_email( $user_data['user_email'] ) ) {
            return json_encode( ['registerauth' => false, 'message' => esc_html__( 'Email is not valid', 'fd-addons' )] );
        }
        if ( email_exists( $user_data['user_email'] ) ) {
            return json_encode( ['registerauth' => false, 'message' => esc_html__( 'Email Already in Use', 'fd-addons' )] );
        }
    }

    if ( !empty( $user_data['user_url'] ) ) {
        if ( !filter_var( $user_data['user_url'], FILTER_VALIDATE_URL ) ) {
            return json_encode( ['registerauth' => false, 'message' => esc_html__( 'Website is not a valid URL', 'fd-addons' )] );
        }
    }
    return true;

};













