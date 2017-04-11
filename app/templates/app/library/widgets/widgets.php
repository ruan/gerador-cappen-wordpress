<?php

require_once 'redes-sociais.php';

/**
 * Register Widgets
 *
 * Registra as posições dos Widgets do tema
 *
 * @return void
 */
function custom_widgets($name = "", $id = "", $class = "", $description = "", $before_widget = "", $after_widget = "", $before_title = "", $after_title = "")
{
    $args = array(
        'name'          => __($name, THEMETEXTDOMAIN),
        'id'            => $id,
        'class'         => $class,
        'description'   => __($description, THEMETEXTDOMAIN),
        'before_widget' => $before_widget,
        'after_widget'  => $after_widget,
        'before_title'  => $before_title,
        'after_title'   => $after_title,
    );

    register_sidebar($args);
}

/**
 * Adiciona os widgets
 *
 * @return void
 */
function register_widgets()
{
    custom_widgets("Redes Sociais", "widget-redessociais", "", "Widget das Redes Sociais", "", "", "", "");
}

add_action("init", "register_widgets");
