<?php
/**
 * Register new custom taxonomies into theme
 *
 * @param  string  $plural
 * @param  string  $singular
 * @param  string  $slug
 * @param  string  $article
 * @param  string  $post_types
 * @param  boolean $showAdmin
 * @return void
 */
function custom_taxonomy($plural = '', $singular = '', $slug = '', $article = '', $post_types = '', $showAdmin = false)
{
    $plural = htmlentities($plural);
    $singular = htmlentities($singular);

    $labels = [
        'name' => _x($plural, 'Taxonomy General Name', THEMETXTDOMAIN),
        'singular_name' => _x($singular, 'Taxonomy Singular Name', THEMETXTDOMAIN),
        'menu_name' => __($plural, THEMETXTDOMAIN),
        'all_items' => __('All ' . strtolower($plural), THEMETXTDOMAIN),
        'parent_item' => null,
        'parent_item_colon' => null,
        'new_item_name' => __('New ' . strtolower($singular), THEMETXTDOMAIN),
        'add_new_item' => __('Add new ' . strtolower($singular), THEMETXTDOMAIN),
        'edit_item' => __('Edit ' . strtolower($singular), THEMETXTDOMAIN),
        'update_item' => __('Update ' . strtolower($singular), THEMETXTDOMAIN),
        'separate_items_with_commas' => __('Separate ' . strtolower($plural) . ' with commas', THEMETXTDOMAIN),
        'search_items' => __('Search ' . strtolower($plural), THEMETXTDOMAIN),
        'add_or_remove_items' => __('Add or remove ' . strtolower($plural), THEMETXTDOMAIN),
        'choose_from_most_used' => __('Choose from the most used ' . strtolower($plural), THEMETXTDOMAIN),
    ];

    $rewrite = [
        'slug' => $slug,
        'with_front' => true,
        'hierarchical' => true,
    ];

    $args = [
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => $showAdmin,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'query_var' => $slug,
        'rewrite' => $rewrite,
    ];

    register_taxonomy($slug, $post_types, $args);
}

/**
 * Register Taxonomies.
 */
function register_taxonomies()
{
    // custom_taxonomy('Categorias', 'Categoria', 'categoria', 'a', ['post'], true);
}

add_action('init', 'register_taxonomies');

/**
 * Add Custom Types in queries.
 *
 * @param mixed $query
 */
function add_custom_types_in_query($query = '')
{
    if ((is_tag() || is_category() || is_date()) && (empty($query->query_vars['suppress_filters']))) {
        // Posts incluídos na pesquisa:
        $post_types = [
            'page',
            'blog',
        ];

        $query->set('post_type', $post_types);

        return $query;
    }
}

add_filter('pre_get_posts', 'add_custom_types_in_query');
