<?php

require_once 'social-networks.php';

/**
 * Register positions for Widgets
 */
function custom_widgets($name = '', $id = '', $class = '', $description = '', $before_widget = '', $after_widget = '', $before_title = '', $after_title = '')
{
    $args = [
        'name' => __($name, THEMETXTDOMAIN),
        'id' => $id,
        'class' => $class,
        'description' => __($description, THEMETXTDOMAIN),
        'before_widget' => $before_widget,
        'after_widget' => $after_widget,
        'before_title' => $before_title,
        'after_title' => $after_title,
    ];

    register_sidebar($args);
}

/**
 * Add the widgets.
 */
function register_widgets()
{
    custom_widgets('Social Networks', 'widget-socialnetworks', '', 'Social Networks Widget', '', '', '', '');
}

add_action('init', 'register_widgets');
