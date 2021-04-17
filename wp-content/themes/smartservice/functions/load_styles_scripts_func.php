<?php

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