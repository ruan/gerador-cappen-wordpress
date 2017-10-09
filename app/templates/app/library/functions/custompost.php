<?php
/**
 * Register new custom post types into theme
 *
 * @param  string  $plural
 * @param  string  $singular
 * @param  string  $slug
 * @param  string  $article
 * @param  string  $capability
 * @param  integer $order
 * @param  string  $icon
 * @param  string  $taxonomies
 * @return void
 */
function custom_post_type($plural = '', $singular = '', $slug = '', $article = '', $capability = '', $order = 0, $icon = '', $taxonomies = '')
{
    $plural = htmlentities($plural, ENT_QUOTES, 'UTF-8');
    $singular = htmlentities($singular, ENT_QUOTES, 'UTF-8');

    $labels = [
        'name' => _x($plural, 'Post Type General Name', THEMETXTDOMAIN),
        'singular_name' => _x($singular, 'Post Type Singular Name', THEMETXTDOMAIN),
        'menu_name' => __($plural, THEMETXTDOMAIN),
        'parent_item_colon' => __('Parent Post', THEMETXTDOMAIN),
        'all_items' => __('All posts', THEMETXTDOMAIN),
        'view_item' => __('View post', THEMETXTDOMAIN),
        'add_new_item' => __('Add new post', THEMETXTDOMAIN),
        'add_new' => __('New post', THEMETXTDOMAIN),
        'edit_item' => __('Edit post', THEMETXTDOMAIN),
        'update_item' => __('Update post', THEMETXTDOMAIN),
        'search_items' => __('Search posts', THEMETXTDOMAIN),
        'not_found' => __('No ' . strtolower($singular) . ' found', THEMETXTDOMAIN),
        'not_found_in_trash' => __('No post found in trash', THEMETXTDOMAIN),
    ];

    $rewrite = [
        'slug' => $slug,
        'with_front' => true,
        'pages' => true,
        'feeds' => true,
    ];

    $args = [
        'label' => __($slug, THEMETXTDOMAIN),
        'description' => __('Post', THEMETXTDOMAIN),
        'labels' => $labels,
        'supports' => ['title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats'],
        'taxonomies' => $taxonomies,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => $order,
        'menu_icon' => $icon,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'query_var' => $slug,
        'rewrite' => $rewrite,
        'capability_type' => $capability,
    ];

    register_post_type($slug, $args);
}

/**
 * Remove Box.
 *
 * Remove feature from add and edit of posts
 */
function remove_box()
{
    remove_meta_box('content', 'slides', 'normal');
    remove_meta_box('authordiv', 'slides', 'normal');
    remove_meta_box('commentstatusdiv', 'slides', 'normal');
    remove_meta_box('commentsdiv', 'slides', 'normal');
    remove_meta_box('postcustom', 'slides', 'normal');
    remove_meta_box('revisionsdiv', 'slides', 'normal');
    remove_meta_box('slugdiv', 'slides', 'normal');
    remove_meta_box('trackbacksdiv', 'slides', 'normal');
    remove_meta_box('contentdiv', 'slides', 'normal');
}

add_action('admin_init', 'remove_box');

/**
 * Register Custom Posts.
 */
function register_custom_posts()
{
    //custom_post_type("Hours", "Hour", "hours", "the", "post", 2, "dashicons-clock", array());
}

add_action('init', 'register_custom_posts');
