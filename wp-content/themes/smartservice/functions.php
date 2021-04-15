<?php

//debug function for var_dump()
function debug($bug)
{
    echo '<pre style="padding: 15px; background: #000; display:block; width: 100%; color: #fff;">';
    var_dump($bug);
    echo '</pre>';
}

add_filter('the_generator', '__return_empty_string');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
add_filter('tiny_mce_plugins', 'disable_wp_emojis_in_tinymce');

//add_filter('show_admin_bar', '__return_false');


add_filter('pll_get_post_types', 'unset_cpt_pll', 10, 2);
function unset_cpt_pll($post_types, $is_settings)
{
    $post_types['acf-field-group'] = 'acf-field-group';
    $post_types['acf'] = 'acf';
    return $post_types;
}

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
add_theme_support('post-thumbnails');
add_filter('jpeg_quality', function () {
    return 100;
});

//add_action('login_enqueue_scripts', 'wpspec_custom_login_logo');


function disable_wp_emojis_in_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

remove_action('load-update-core.php', 'wp_update_plugins');
add_filter('pre_site_transient_update_plugins', create_function('$a', "return null;"));
wp_clear_scheduled_hook('wp_update_plugins');

// disable gutenberg editor
if ('disable_gutenberg') {
    add_filter('use_block_editor_for_post_type', '__return_false', 100);
    remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles');

    add_action('admin_init', function () {
        remove_action('admin_notices', ['WP_Privacy_Policy_Content', 'notice']);
        add_action('edit_form_after_title', ['WP_Privacy_Policy_Content', 'notice']);
    });
}


// svg upload
// add to wp-config string - define( 'ALLOW_UNFILTERED_UPLOADS', true );
add_filter('upload_mimes', 'svg_upload_allow');
function svg_upload_allow($mimes)
{
    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
}

// styles and scripts including
function load_theme_styles()
{
    wp_enqueue_style('style');

    if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false) {
        wp_enqueue_style('fontawesome', get_template_directory_uri() . '/fontawesome-free/css/all.min.css', array(), null, 'all');
    }

    wp_enqueue_style('my-styles', get_stylesheet_directory_uri() . '/css/styles.css', array(), time(), 'all');

//	wp_enqueue_script( 'jquery' );
    $js_directory_uri = get_template_directory_uri() . '/js/';

    wp_deregister_script('jquery');
    wp_register_script('jquery', ("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"), false, '3.5.1', true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('custom-script', $js_directory_uri . 'scripts.min.js', array('jquery'), time(), true);
}

add_action('wp_enqueue_scripts', 'load_theme_styles', 100);

// thumbnails sizes
add_theme_support('post-thumbnails');


add_image_size('logo-thumb', 165);
add_image_size('hero-thumb', 140);
add_image_size('gallery-thumb', 350, 233);
add_image_size('flags-thumb', 560);
add_image_size('bigest-thumb', 1920);

// acf option page include
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Налаштування теми',
        'menu_title' => esc_html__('Налаштування теми', 'themeoption'),
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Переклад Строк',
        'menu_title' => esc_html__('Переклад Строк', 'themeoption'),
        'parent_slug' => 'theme-general-settings'
    ));
}

// menu
class  Main_Submenu_Class extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $classes = array('sub-menu', 'list-unstyled', 'child-navigation');
        $class_names = implode(' ', $classes);
        $output .= "\n" . '<ul class="' . $class_names . '">' . "\n";
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        $id_field = $this->db_fields['id'];
        if (is_object($args[0]))
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0)
    {
        global $wp_query;

        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $class_names_arr = array();
        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array)$item->classes;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        $class_names_arr[] = esc_attr($class_names);
        $class_names_arr[] = 'menu-item-id-' . $item->ID;
        $span_act = "";
        if ($args->has_children) {
            $class_names_arr[] = 'has-child';
            if (in_array('current-menu-item', $classes)) {
                $class_names_arr[] = 'focus';
                $span_act = 'active';
            }
            if (in_array('current-menu-parent', $classes)) {
                $class_names_arr[] = 'focus';
                $span_act = 'active';
            }
            if (in_array('current-menu-ancestor', $classes)) {
                $class_names_arr[] = 'focus';
                $span_act = 'active';
            }


        }


        $class_names = ' class="' . implode(' ', $class_names_arr) . '"';
        $menu_locations = '';
        if (isset($args->menu_id)) {
            if ($args->menu_id != '') $menu_locations = $args->menu_id . '_';
        }

        $output .= $indent . '<li id="menu-item-' . $menu_locations . $item->ID . '"' . $value . $class_names . '>';
        $attributes = '';
        if ($item->url != '#') {
            $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
            $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
            $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
            $attributes .= !empty($item->url) ? ' href="' . $item->url . '"' : '';
        }

        $item_output = $args->before;
        $item_output .= '<div class="items"><a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID);
        $item_output .= $args->link_after;
        $item_output .= '</a>';
        if ($args->has_children) $item_output .= '<span data-from="menu-item-' . $menu_locations . $item->ID . '" class="show_sub_menu ' . $span_act . '"><i></i></span>';
        $item_output .= '</div>';

        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

// children menu func
function true_get_nav_menu_children_items($parent_id, $nav_menu_items, $dpth = true)
{
    $children = array();
    foreach ((array)$nav_menu_items as $nav_item) {
        if ($nav_item->menu_item_parent == $parent_id) {
            $children[] = $nav_item;

            // если вам не нужны дочерние всех уровней вложенности, то даже можете удалить следующие 5 строк кода
            if ($dpth) {
                if ($dch = get_nav_menu_item_children($nav_item->ID, $nav_menu_items))
                    $children = array_merge($children, $dch);
            }
        }
    }
    return $children;
}

function menulang_setup()
{
    load_theme_textdomain('themename', get_template_directory() . '/languages');
    register_nav_menus(array('header_menu' => __('Header Menu', 'themename')));
    register_nav_menus(array('footer_menu_left' => __('Footer Menu Left', 'themename')));
    register_nav_menus(array('footer_menu_center' => __('Footer Menu Center', 'themename')));
    register_nav_menus(array('footer_menu_right' => __('Footer Menu Right', 'themename')));
}

add_action('after_setup_theme', 'menulang_setup');

// sidebar register
function inspiry_theme_sidebars()
{
    register_sidebar(
        [
            'name' => __('header_widget', 'themename'),
            'id' => 'Header Widget',
            'description' => __('header_widget', 'themename'),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => ''
        ]
    );
}

add_action('widgets_init', 'inspiry_theme_sidebars');

// phone format for links
function phone_format($phone)
{
    $result = 'tel:+' . preg_replace("/\D+/", "", $phone);
    return $result;

//    call function <?php phone_format($phone)
}

// create post type
function create_post_type()
{
//post type
    $post_type_labels = array(
        'name' => esc_html__('Послуги', 'themename'),
        'singular_name' => esc_html__('Послуга', 'themename'),
        'add_new' => esc_html__('Додати послугу', 'themename'),
        'add_new_item' => esc_html__('Додати послугу', 'themename'),
        'edit_item' => esc_html__('Редагувати послугу', 'themename'),
        'new_item' => esc_html__('Нова послуга', 'themename'),
        'view_item' => esc_html__('Дивитись послугу', 'themename'),
        'search_items' => esc_html__('Шукати послугу', 'themename'),
        'not_found' => esc_html__('Не знайдено послуг', 'themename'),
        'parent_item_colon' => '',
    );
    $description = get_option(esc_html__('Додавання послуг'));
    $post_type_args = array(
        'labels' => apply_filters('inspiry_property_post_type_labels', $post_type_labels),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_icon' => 'dashicons-portfolio',
        'menu_position' => 26,
        'description' => $description,
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array(
            'slug' => apply_filters('inspiry_property_slug', 'service-pack'),
        ),
    );
    register_post_type('service-pack', $post_type_args);

    // taxonomy
    register_taxonomy('services_cats', array('service-pack'), array(
        'label' => 'Категорії послуг', // определяется параметром $labels->name
        'labels' => array(
            'name' => 'Категорії послуг',
            'singular_name' => 'Категорія послуг',
            'search_items' => 'Шукати категорія послуг',
            'all_items' => 'Всі категорії послуг',
            'parent_item' => 'Батьківська категорія послуг',
            'parent_item_colon' => 'Батьківська категорія послуг:',
            'edit_item' => 'Редагувати категорію послуг',
            'update_item' => 'Оновити категорію послуг',
            'add_new_item' => 'Додати категорію послуг',
            'new_item_name' => 'Нова категорія послуг',
            'menu_name' => 'Розділ категорії послуг',
        ),
        'description' => 'Категорії послуг', // описание таксономии
        'public' => true,
        'show_in_nav_menus' => false, // равен аргументу public
        'show_ui' => true, // равен аргументу public
        'show_tagcloud' => false, // равен аргументу show_ui
        'hierarchical' => true,
        'rewrite' => array('slug' => 'services_cats', 'hierarchical' => false, 'with_front' => false, 'feed' => false),
        'show_admin_column' => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    ));

    register_taxonomy('packages_flats', array('service-pack'), array(
        'label' => 'Кавртири пакети', // определяется параметром $labels->name
        'labels' => array(
            'name' => 'Квартири пакети',
            'singular_name' => 'Квартири пакети',
            'search_items' => 'Шукати Квартири пакети',
            'all_items' => 'Всі Квартири пакети',
            'parent_item' => 'Батьківська Квартири пакети',
            'parent_item_colon' => 'Батьківська Квартири пакети:',
            'edit_item' => 'Редагувати Квартири пакети',
            'update_item' => 'Оновити Квартири пакети',
            'add_new_item' => 'Додати Квартири пакети',
            'new_item_name' => 'Нова Квартири пакети',
            'menu_name' => 'Розділ Квартири пакети',
        ),
        'description' => 'Квартири пакети', // описание таксономии
        'public' => true,
        'show_in_nav_menus' => false, // равен аргументу public
        'show_ui' => true, // равен аргументу public
        'show_tagcloud' => false, // равен аргументу show_ui
        'hierarchical' => true,
        'rewrite' => array('slug' => 'packages_flats', 'hierarchical' => false, 'with_front' => false, 'feed' => false),
        'show_admin_column' => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    ));

    register_taxonomy('packages_home', array('service-pack'), array(
        'label' => 'Будинки пакети', // определяется параметром $labels->name
        'labels' => array(
            'name' => 'Будинки пакети',
            'singular_name' => 'Будинки пакети',
            'search_items' => 'Шукати Будинки пакети',
            'all_items' => 'Всі Будинки пакети',
            'parent_item' => 'Батьківська Будинки пакети',
            'parent_item_colon' => 'Батьківська Будинки пакети:',
            'edit_item' => 'Редагувати Будинки пакети',
            'update_item' => 'Оновити Будинки пакети',
            'add_new_item' => 'Додати Будинки пакети',
            'new_item_name' => 'Нова Будинки пакети',
            'menu_name' => 'Розділ Будинки пакети',
        ),
        'description' => 'Будинки пакети', // описание таксономии
        'public' => true,
        'show_in_nav_menus' => false, // равен аргументу public
        'show_ui' => true, // равен аргументу public
        'show_tagcloud' => false, // равен аргументу show_ui
        'hierarchical' => true,
        'rewrite' => array('slug' => 'packages_home', 'hierarchical' => false, 'with_front' => false, 'feed' => false),
        'show_admin_column' => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    ));

    register_taxonomy('packages_home', array('service-pack'), array(
        'label' => 'Будинки пакети', // определяется параметром $labels->name
        'labels' => array(
            'name' => 'Будинки пакети',
            'singular_name' => 'Будинки пакети',
            'search_items' => 'Шукати Будинки пакети',
            'all_items' => 'Всі Будинки пакети',
            'parent_item' => 'Батьківська Будинки пакети',
            'parent_item_colon' => 'Батьківська Будинки пакети:',
            'edit_item' => 'Редагувати Будинки пакети',
            'update_item' => 'Оновити Будинки пакети',
            'add_new_item' => 'Додати Будинки пакети',
            'new_item_name' => 'Нова Будинки пакети',
            'menu_name' => 'Розділ Будинки пакети',
        ),
        'description' => 'Будинки пакети', // описание таксономии
        'public' => true,
        'show_in_nav_menus' => false, // равен аргументу public
        'show_ui' => true, // равен аргументу public
        'show_tagcloud' => false, // равен аргументу show_ui
        'hierarchical' => true,
        'rewrite' => array('slug' => 'packages_home', 'hierarchical' => false, 'with_front' => false, 'feed' => false),
        'show_admin_column' => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    ));

    register_taxonomy('packages_home', array('service-pack'), array(
        'label' => 'Будинки пакети', // определяется параметром $labels->name
        'labels' => array(
            'name' => 'Будинки пакети',
            'singular_name' => 'Будинки пакети',
            'search_items' => 'Шукати Будинки пакети',
            'all_items' => 'Всі Будинки пакети',
            'parent_item' => 'Батьківська Будинки пакети',
            'parent_item_colon' => 'Батьківська Будинки пакети:',
            'edit_item' => 'Редагувати Будинки пакети',
            'update_item' => 'Оновити Будинки пакети',
            'add_new_item' => 'Додати Будинки пакети',
            'new_item_name' => 'Нова Будинки пакети',
            'menu_name' => 'Розділ Будинки пакети',
        ),
        'description' => 'Будинки пакети', // описание таксономии
        'public' => true,
        'show_in_nav_menus' => false, // равен аргументу public
        'show_ui' => true, // равен аргументу public
        'show_tagcloud' => false, // равен аргументу show_ui
        'hierarchical' => true,
        'rewrite' => array('slug' => 'packages_home', 'hierarchical' => false, 'with_front' => false, 'feed' => false),
        'show_admin_column' => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    ));

    register_taxonomy('packages_bussiness', array('service-pack'), array(
        'label' => 'Комирційні пакети', // определяется параметром $labels->name
        'labels' => array(
            'name' => 'Комирційні пакети',
            'singular_name' => 'Комирційні пакети',
            'search_items' => 'Шукати Комирційні пакети',
            'all_items' => 'Всі Комирційні пакети',
            'parent_item' => 'Батьківська Комирційні пакети',
            'parent_item_colon' => 'Батьківська Комирційні пакети:',
            'edit_item' => 'Редагувати Комирційні пакети',
            'update_item' => 'Оновити Комирційні пакети',
            'add_new_item' => 'Додати Комирційні пакети',
            'new_item_name' => 'Нова Комирційні пакети',
            'menu_name' => 'Розділ Комирційні пакети',
        ),
        'description' => 'Комирційні пакети', // описание таксономии
        'public' => true,
        'show_in_nav_menus' => false, // равен аргументу public
        'show_ui' => true, // равен аргументу public
        'show_tagcloud' => false, // равен аргументу show_ui
        'hierarchical' => true,
        'rewrite' => array('slug' => 'packages_bussiness', 'hierarchical' => false, 'with_front' => false, 'feed' => false),
        'show_admin_column' => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    ));

}

add_action('init', 'create_post_type');

add_action('wp_ajax_post_filter', 'post_filter_func');
add_action('wp_ajax_nopriv_post_filter', 'post_filter_func');

// ajax function
function post_filter_func()
{

    if (isset($_REQUEST)) {
        if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            $post_id = (isset($_REQUEST['postId'])) ? (int)$_REQUEST['postId'] : 0;

            if ($post_id === 0) {
                echo '';
            } else {
                $args = [
                    'post_type' => 'contacts',
                    'post__in' => [$post_id],
                    'post_status' => 'publish'
                ];

                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        $contacts = get_field('add_contact');

                        foreach ($contacts as $contact) { ?>
                            <div class="managers_result_row">
                                <h4 class="managers_result_name text_red"><?php echo $contact['k_name']; ?></h4>
                                <p class="managers_result_phone text_red">tel. <a class="text_red"
                                                                                  href="tel:<?php echo phone_format($contact['k_phone']); ?>"><?php echo $contact['k_phone']; ?></a>
                                </p>
                                <p class="managers_result_email text_red">e-mail. <a class="text_red"
                                                                                     href="mailto:<?php echo $contact['k_email']; ?>"><?php echo $contact['k_email']; ?></a>
                                </p>
                            </div>
                        <?php }
                    }
                }

                wp_reset_postdata();


            }
        }
    }
    wp_die();
}


function get_email()
{
    $emails = get_field('e-mails_sites', 'option');

    $out = '';
    if ($emails) {
        foreach ($emails as $email) {
            $out = '<a href="mailto: ' . $email['e-mail'] . '">' . $email['e-mail'] . '</a>';
        }
        return $out;
    }
    return;
}

function get_phone()
{
    $phones = get_field('site_phones', 'option');
    $out = '';
    if ($phones) {
        foreach ($phones as $phone) {
            $out = '<a href="' . phone_format($phone['phone']) . '">' . $phone['phone'] . '</a>';
        }
        return $out;
    }
    return;
}

function get_hero($is_class = '', $is_title = '')
{
    $id = get_the_ID();
    $background = get_the_post_thumbnail_url($id, 'full');

    $title = ($is_title !== '') ? $is_title : get_the_title();

    $class = ($is_class !== '') ? ' ' . $is_class : '';
    ?>
    <section class="page-hero<?php echo $class; ?>" style="background-image: url(<?php echo $background; ?>);">
        <div class="page-hero-ovelay"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 page-hero-wrapper">
                    <h1 class="h1 wow animated fadeInLeft"><?php echo $title; ?></h1>
                </div>
            </div>
        </div>

        <?php include_once 'templates/inside_svg.php'; ?>
    </section>
<?php }

// pagination
function theme_pagination($pages = '')
{

    global $paged;

    if (is_page_template('template-home.php')) {
        $paged = intval(get_query_var('page'));
    }

    if (empty($paged)) {
        $paged = 1;
    }

    $prev = $paged - 1;
    $next = $paged + 1;
    $range = 2; // only change it to show more links
    $show_items = ($range * 2) + 1;

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo "<div class='pagination'>";
        echo ($paged > 2 && $paged > $range + 1 && $show_items < $pages) ? "<a href='" . get_pagenum_link(1) . "' class='real-btn'>&laquo; " . __('First', 'framework') . "</a> " : "";
        echo ($paged > 1 && $show_items < $pages) ? "<a href='" . get_pagenum_link($prev) . "' class='real-btn' >&laquo; " . __('Previous', 'framework') . "</a> " : "";

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $show_items)) {
                echo ($paged == $i) ? "<span class='real-btn current' >" . $i . "</span> " : "<a href='" . get_pagenum_link($i) . "' class='real-btn'>" . $i . "</a> ";
            }
        }

        echo ($paged < $pages && $show_items < $pages) ? "<a href='" . get_pagenum_link($next) . "' class='real-btn' >" . __('Next', 'framework') . " &raquo;</a> " : "";
        echo ($paged < $pages - 1 && $paged + $range - 1 < $pages && $show_items < $pages) ? "<a href='" . get_pagenum_link($pages) . "' class='real-btn' >" . __('Last', 'framework') . " &raquo;</a> " : "";
        echo "</div>";
    }
}

add_action('add_meta_boxes', 'myplugin_add_custom_box');
function myplugin_add_custom_box(){
    $screens = array( 'service-pack' );
    add_meta_box( 'myplugin_sectionid', 'Ціна', 'myplugin_meta_box_callback', $screens, 'side' );
}

// HTML код блока
function myplugin_meta_box_callback( $post, $meta ){
    $screens = $meta['args'];

    // Используем nonce для верификации
//    wp_nonce_field( plugin_basename(__FILE__), 'myplugin_noncename' );

    // значение поля
    $value = get_post_meta( $post->ID, 'my_meta_key', 1 );

    // Поля формы для введения данных
    echo '<label for="services_price">' . __("Ціна послуги", 'services' ) . '</label> ';
    echo '<input type="number" id="services_price" name="services_price" value="'. $value .'" />';
}

## Сохраняем данные, когда пост сохраняется
add_action( 'save_post', 'myplugin_save_postdata' );
function myplugin_save_postdata( $post_id ) {
    // Убедимся что поле установлено.
    if ( ! isset( $_POST['services_price'] ) )
        return;

    // проверяем nonce нашей страницы, потому что save_post может быть вызван с другого места.
//    if ( ! wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename(__FILE__) ) )
//        return;

    // если это автосохранение ничего не делаем
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return;

    // проверяем права юзера
    if ( ! current_user_can( 'edit_post', $post_id ) )
        return;

    // Все ОК. Теперь, нужно найти и сохранить данные
    // Очищаем значение поля input.
    $my_data = sanitize_text_field( $_POST['services_price'] );

    // Обновляем данные в базе данных.
    update_post_meta( $post_id, 'my_meta_key', $my_data );
}