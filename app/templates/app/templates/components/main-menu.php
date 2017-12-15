<?php
  $defaults = [
    'theme_location' => 'menu',
    'menu' => '',
    'container' => '',
    'container_class' => '',
    'container_id' => '',
    'menu_class' => 'main-menu__link',
    'menu_id' => '',
    'echo' => true,
    'fallback_cb' => 'wp_page_menu',
    'before' => '',
    'after' => '',
    'link_before' => '',
    'link_after' => '',
    'items_wrap' => '<nav class="main-menu">%3$s</nav>',
    'depth' => 0,
    'walker' => new Menu(),
    'isMobile' => false,
  ];
  wp_nav_menu($defaults);
?>
