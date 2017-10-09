<?php

$defaults = [
    'theme_location' => 'menu',
    'menu' => '',
    'container' => '',
    'container_class' => '',
    'container_id' => '',
    'menu_class' => 'menu-mobile__link',
    'menu_id' => '',
    'echo' => true,
    'fallback_cb' => 'wp_page_menu',
    'before' => '',
    'after' => '',
    'link_before' => '',
    'link_after' => '',
    'items_wrap' => '<nav class="menu-mobile"><a class="menu-mobile__btn-close" href="javascript:;"></a><h2 class="menu-mobile__title">brickhouse tavern</h2>%3$s</nav>',
    'depth' => 0,
    'walker' => new Menu(),
    'isMobile' => true,
];

wp_nav_menu($defaults);
