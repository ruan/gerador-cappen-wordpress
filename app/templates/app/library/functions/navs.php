<?php
/**
 * Register Navs
 *
 * Registra as posições do menus do tema{}
 *
 * @return void
 */
function theme_register_navs()
{
    // Menu
    register_nav_menu('menu', __('Menu'));
}

add_action("init", "theme_register_navs");
