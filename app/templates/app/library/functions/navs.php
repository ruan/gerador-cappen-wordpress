<?php
/**
 * Register menu position
 */
function theme_register_navs()
{
    register_nav_menu('menu', __('Menu'));
}

add_action('init', 'theme_register_navs');
