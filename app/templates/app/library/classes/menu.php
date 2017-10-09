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
        $class_names = $value = $item_output = $menu_title = '';

        // Check if any class was set
        $classes = empty($item->classes) ? [] : (array) $item->classes;

        // Check if class input has data
        $additionalClass = empty($args->menu_class) ? '' : $args->menu_class;

        // List all classes as array
        $class_names = apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth);

        // Transform array of classes into string
        $class_names = count($class_names) ? ' ' . join(' ', $class_names) : '';

        // Set active classe
        $class_names .= in_array('current-menu-item', $item->classes) ? ' active' : '';

        // Set item 'home' to point out get_home_url function
        $url = (stripos($item->url, 'home') !== false) ? get_home_url() : $item->url;

        // Load food item
        if (stripos($item->title, 'food') !== false) {
            $pageID = get_id_by_slug('home');
            $food = get_field('concessions_food', $pageID);
            $url = $food ?: '';
        }

        // Check if attributes was passed
        $attributes = !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($url) ? ' href="' . esc_attr($url) . '"' : '';
        $description = !empty($item->description) ? '<span>' . esc_attr($item->description) . '</span>' : '';

        if ($args->isMobile === true) {
            if ($item->title != 'Flag' && $args->walker->has_children != 1) {
                if ($depth > 0) {
                    // Get the parent item
                    $parent_menu = get_post($item->menu_item_parent);
                    if (!empty($parent_menu)) {
                        // Get the parent name
                        $menu_title = ' ' . $parent_menu->post_title;
                    }
                }

                // Build output with the items
                $item_output = $args->before;
                $item_output .= '<a class="' . $additionalClass . $class_names . '"' . $attributes . ' >';
                $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
                $item_output .= $menu_title . $description . $args->link_after;
                $item_output .= '</a>';
            }
        } else {
            // Do not include 'Flag' item to menu, it's just a limit for separate between left and right
            if ($item->title == 'Flag') {
                // Only break menu left-right when page is home
                if (is_front_page()) {
                    $item_output = '</ul><ul class="main-menu --right">';
                }
            } else {
                if ($depth > 0) {
                    $additionalClass = 'main-menu__submenu__link';
                }

                if ($args->walker->has_children == 1) {
                    $additionalClass .= ' --sub';
                }

                // Build output with the items
                $item_output = $args->before;
                $item_output .= '<li class="' . $additionalClass . $class_names . '">';

                if ($args->walker->has_children != 1) {
                    $item_output .= '<a ' . $attributes . ' >';
                }

                $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
                $item_output .= $description . $args->link_after;

                if ($args->walker->has_children != 1) {
                    $item_output .= '</a>';
                } else {
                    $item_output .= '<i class="fa fa-angle-down" aria-hidden="true"></i>';
                }

                if ($args->walker->has_children != 1) {
                    $item_output .= '</li>';
                }
            }
        }

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

        if ($args->isMobile === false) {
            $output .= "\n$indent<ul class=\"main-menu__submenu\">\n";
        }
    }

    public function end_lvl(&$output, $depth = 0, $args = [])
    {
        $indent = str_repeat("\t", $depth);

        if ($args->isMobile === false) {
            $output .= "$indent</ul></li>\n";
        }
    }
}
