<?php

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
    register_nav_menus(array('footer_menu' => __('Footer Menu', 'themename')));
}

add_action('after_setup_theme', 'menulang_setup');