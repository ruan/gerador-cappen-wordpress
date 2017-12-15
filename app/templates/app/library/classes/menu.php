<?php
/**
 * Menu class
 */
class Menu extends Walker_Nav_Menu
{
    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        // Global variable
        global $wp_query;

        // Identation
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        // Initialize class variable
        $class_names = $value = '';

        // Check if any class was set
        $classes = empty($item->classes) ? [] : (array) $item->classes;

        // Check if class input has data
        $aditionalClass = empty($args->menu_class) ? '' : $args->menu_class;

        // Set classes
        $class_names = in_array('current-menu-item', $item->classes) ? ' active' : '';

        // Set item 'home' to point out get_home_url function
        $url = (stripos($item->url, 'home') !== false) ? get_home_url() : $item->url;

        // Check if attributes was passed
        $attributes = !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($url) . '"' : '';
        $description = !empty($item->description) ? '<span>' . esc_attr($item->description) . '</span>' : '';

        if ($depth > 0) {
            $aditionalClass = 'main-menu__submenu__link';
        }
        if ($args->walker->has_children == 1) {
            $aditionalClass .= ' --sub';
        }

        // Build output with the items
        $item_output = $args->before;
        $item_output .= '<a class="' . $aditionalClass . $class_names . '" ' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= $description . $args->link_after;
        $item_output .= '</a>';

        $item_output .= $args->after;

        // Return the items
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el(&$output, $item, $depth = 0, $args = [])
    {
        $output .= "\n";
    }

    public function start_lvl(&$output, $depth = 0, $args = [])
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"main-menu__submenu\">\n";
    }

    public function end_lvl(&$output, $depth = 0, $args = [])
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></li>\n";
    }
}
