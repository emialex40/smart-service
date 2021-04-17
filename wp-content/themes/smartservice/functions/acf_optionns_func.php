<?php

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
