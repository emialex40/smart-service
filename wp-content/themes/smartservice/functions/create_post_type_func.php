<?php

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
        'supports' => array('title', 'thumbnail'),
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
        'show_in_nav_menus' => true, // равен аргументу public
        'show_ui' => true, // равен аргументу public
        'show_tagcloud' => false, // равен аргументу show_ui
        'hierarchical' => true,
        'rewrite' => array('slug' => 'services_cats', 'hierarchical' => false, 'with_front' => false, 'feed' => false),
        'show_admin_column' => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    ));

    // flats
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

    // houses
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
        'label' => 'Комерційні пакети', // определяется параметром $labels->name
        'labels' => array(
            'name' => 'Комерційні пакети',
            'singular_name' => 'Комерційні пакети',
            'search_items' => 'Шукати Комерційні пакети',
            'all_items' => 'Всі Комерційні пакети',
            'parent_item' => 'Батьківська Комерційні пакети',
            'parent_item_colon' => 'Батьківська Комерційні пакети:',
            'edit_item' => 'Редагувати Комерційні пакети',
            'update_item' => 'Оновити Комерційні пакети',
            'add_new_item' => 'Додати Комерційні пакети',
            'new_item_name' => 'Нова Комерційні пакети',
            'menu_name' => 'Розділ Комерційні пакети',
        ),
        'description' => 'Комерційні пакети', // описание таксономии
        'public' => true,
        'show_in_nav_menus' => false, // равен аргументу public
        'show_ui' => true, // равен аргументу public
        'show_tagcloud' => false, // равен аргументу show_ui
        'hierarchical' => true,
        'rewrite' => array('slug' => 'packages_bussiness', 'hierarchical' => false, 'with_front' => false, 'feed' => false),
        'show_admin_column' => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    ));

    $post_type_labels = array(
        'name' => esc_html__('Команда', 'themename'),
        'singular_name' => esc_html__('Команда', 'themename'),
        'add_new' => esc_html__('Додати', 'themename'),
        'add_new_item' => esc_html__('Додати', 'themename'),
        'edit_item' => esc_html__('Редагувати', 'themename'),
        'new_item' => esc_html__('Нова', 'themename'),
        'view_item' => esc_html__('Дивитись', 'themename'),
        'search_items' => esc_html__('Шукати', 'themename'),
        'not_found' => esc_html__('Не знайдено', 'themename'),
        'parent_item_colon' => '',
    );
    $description = get_option(esc_html__('Додати члена коанди'));
    $post_type_args = array(
        'labels' => apply_filters('inspiry_property_post_type_labels', $post_type_labels),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_icon' => 'dashicons-businessman',
        'menu_position' => 27,
        'description' => $description,
        'supports' => array('title', 'editor','thumbnail'),
        'rewrite' => array(
            'slug' => apply_filters('inspiry_property_slug', 'team'),
        ),
    );
    register_post_type('team', $post_type_args);

}

add_action('init', 'create_post_type');
