<?php

/**
 * Remove menu de Posts do Admin
 *
 * @return void
 */
function remove_menu_pages()
{
    remove_menu_page('edit-comments.php');
}

add_action('admin_menu', 'remove_menu_pages');

/**
 * Remove a exibição da versão do Wordpress no site
 *
 * @return void
 */
function remove_wp_version()
{
    return '';
}

add_filter('the_generator', 'remove_wp_version');

/**
 * Remove itens da dashboard
 *
 * @return void
 */
function remove_dashboard_meta()
{
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('dashboard_primary', 'dashboard', 'normal');
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    remove_action('welcome_panel', 'wp_welcome_panel');
    // remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
}

add_action('admin_init', 'remove_dashboard_meta');

/**
 * Remove WP Emoji
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

/**
 * Disable RSS
 */
remove_action('do_feed_rdf', 'do_feed_rdf', 10, 1);
remove_action('do_feed_rss', 'do_feed_rss', 10, 1);
remove_action('do_feed_rss2', 'do_feed_rss2', 10, 1);
remove_action('do_feed_atom', 'do_feed_atom', 10, 1);

/**
 * Remove RSS links from wp_head
 */
function remove_rss_from_wp_head()
{
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
}

add_action('wp_head', 'remove_rss_from_wp_head', 1);

/**
 * Remove XMLRPC
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Remove REST API (wp-json)
 */
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

/**
 * Remove Recent Coments style
 */
function remove_recent_comments_style()
{
    global $wp_widget_factory;

    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}

add_action('widgets_init', 'remove_recent_comments_style');

/**
 * Remove admin bar from site
 *
 * @return void
 */
function remove_admin_bar()
{
    show_admin_bar(false);
}

add_action('after_setup_theme', 'remove_admin_bar');
