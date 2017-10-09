<?php
/**
 * Theme Setup.
 *
 * Initialize theme functions when its loaded
 */
function theme_setup()
{
    // Text Domain
    add_filter('init', 'custom_textdomain');

    // Theme Support
    add_filter('init', 'theme_support');

    // Post Thumbnails
    add_filter('init', 'post_thumbnails');

    // Image Sizes
    add_filter('intermediate_image_sizes_advanced', 'remove_image_sizes');
}

add_action('after_setup_theme', 'theme_setup');

/**
 * Text Domain.
 *
 * Create the theme domain
 */
function custom_textdomain()
{
    // Textdomain
    load_theme_textdomain('vacation', get_template_directory_uri() . '/languages');
}

/**
 * Theme Support.
 *
 * Load theme resources
 */
function theme_support()
{
    // Post Formats
    add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat']);

    // Content Width
    add_theme_support('content-width', 1920);

    // Feed Links
    add_theme_support('automatic-feed-links');

    // Custom Header
    add_theme_support(
        'custom-header',
        [
            'width' => 1920,
            'height' => 630,
            'uploads' => true,
            'default-text-color' => '#343434',
        ]
    );

    // Custom Background
    add_theme_support(
        'custom-background',
        [
            'default-color' => '',
            'default-image' => '',
            'default-repeat' => '',
            'default-position-x' => '',
            'wp-head-callback' => '_custom_background_cb',
            'admin-head-callback' => '',
            'admin-preview-callback' => '',
        ]
    );

    // Pots Thumbnails
    add_theme_support('post-thumbnails', ['page', 'post', 'events']);
}

/**
 * Post Thumbnails.
 *
 * Define thumbnail sizes
 */
function post_thumbnails()
{
    add_image_size('post-thumb', 325, 217, true);
    add_image_size('hero-home', 1440, 654, true);
    add_image_size('hero-internal', 1440, 392, true);
    add_image_size('gallery', 1375, 735, true);
    add_image_size('happenings-large', 1920, 1280, true);
    add_image_size('happenings-thumb', 410, 500, true);
}

/**
 * Remove Image Sizes.
 *
 * Remove thumbnail sizes
 *
 * @param string $sizes
 */
function remove_image_sizes($sizes = '')
{
    // unset($sizes['thumbnail']);
    unset($sizes['medium']);
    unset($sizes['large']);

    return $sizes;
}

/**
 * Get the id of a page/post types by slug
 *
 * @param  string $page_slug
 * @param  string $slug_page_type
 * @return null|integer
 */
function get_id_by_slug($page_slug = '', $slug_page_type = 'page')
{
    $find_page = get_page_by_path($page_slug, OBJECT, $slug_page_type);

    return $find_page ? $find_page->ID : null;
}

/**
 * Get all attachment informations
 *
 * @param  integer $attachment_id
 * @return array
 */
function wp_get_attachment($attachment_id = 0)
{
    $attachment = get_post($attachment_id);

    return [
        'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink($attachment->ID),
        'src' => $attachment->guid,
        'title' => $attachment->post_title,
    ];
}

/**
 * List all items from menu
 *
 * @param  string $menuName
 * @return array
 */
function wp_get_menu_array($menuName = "")
{
    $listMenu = wp_get_nav_menu_items($menuName);

    $menu = [];

    foreach ($listMenu as $m) {
        $menu[$m->ID] = [];
        $menu[$m->ID]['ID'] = $m->ID;
        $menu[$m->ID]['title'] = $m->title;
        $menu[$m->ID]['url'] = $m->url;

        if (empty($m->menu_item_parent)) {
            $menu[$m->ID]['children'] = [];
        } else {
            $menu[$m->menu_item_parent]['children'][$m->ID] = $menu[$m->ID];
        }
    }

    return $menu;
}

/**
 * Search in multidimensional array
 *
 * @param  string $value
 * @param  string $item
 * @param  array  $array
 * @return mixed
 */
function multiSearch($value = "", $item = "", $array = [])
{
    foreach ($array as $key => $val) {
        if ($val['title'] === $value) {
            return $array[$key][$item];
        }
    }

    return null;
}

/**
 * Add columns to events post list
 *
 * @param string $columns
 */
function add_acf_columns_to_events($columns = '')
{
    return array_merge($columns, array(
        'date' => __('Published Date'),
        'event_datetime' => __('Event Date'),
        'event_type' => __('Type'),
    ));
}
add_filter('manage_events_posts_columns', 'add_acf_columns_to_events');

/**
 * Add columns to events post list
 *
 * @param  string  $column
 * @param  integer $post_id
 * @return string
 */
function events_custom_column($column = '', $post_id = 0)
{
    switch($column) {
        case 'event_datetime':
            echo get_post_meta($post_id, 'event_datetime', true);
            break;
        case 'event_type':
            $type = get_post_meta($post_id, 'event_type', true);
            echo ($type == 'home' ? 'Home Game day' : ($type == 'away' ? 'Away Game day' : 'Non Game day'));
            break;
    }
}
add_action ('manage_events_posts_custom_column', 'events_custom_column', 10, 2);

/**
 * Add option to sort custom fields
 *
 * @param  string $columns
 * @return array
 */
function sortable_events_column($columns = "")
{
    $columns['event_datetime'] = 'event_datetime';
    $columns['event_type'] = 'event_type';

    return $columns;
}
add_filter('manage_edit-events_sortable_columns', 'sortable_events_column');

/**
 * Order by custom field
 *
 * @param  string $query
 * @return void
 */
function sort_events_by_meta_value($query = "")
{
    global $pagenow;

    if (is_admin() && $pagenow == 'edit.php' &&
        isset($_GET['post_type']) && $_GET['post_type'] == 'events')  {
        $query->query_vars['meta_key'] = 'event_datetime';
        $query->query_vars['orderby'] = 'meta_value';
        $query->query_vars['order'] = 'desc';
    }
}
add_filter('parse_query', 'sort_events_by_meta_value');

add_action('wp_ajax_events_posts_json', 'events_posts_json');
add_action('wp_ajax_nopriv_events_posts_json', 'events_posts_json');
function events_posts_json()
{
    $date = $_GET['date'] ?: date('Y-m');

    $args = [
        'post_type' => 'events',
        'post_parent' => 0,
        'posts_per_page' => -1,
        'orderby' => 'meta_value',
        'order' => 'asc',
        'meta_key' => 'event_datetime',
        'meta_query' => [
            [
                'key' => 'event_datetime',
                'value' => $date,
                'compare' => 'LIKE',
            ]
        ],
    ];

    $eventsByYearMonth = new WP_Query($args);

    $jsonData = [];

    if ($eventsByYearMonth->have_posts()) {
        while ($eventsByYearMonth->have_posts()) {
            $eventsByYearMonth->the_post();
            $image = has_post_thumbnail() ? $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'happenings-thumb') : '';

            $jsonData[] = [
                'id' => get_the_ID(),
                'permalink' => get_permalink($post->ID),
                'title' => get_the_title(),
                'subtitle' => get_field('event_subtitle', $post->ID),
                'description' => get_field('event_description', $post->ID),
                'type' => get_field('event_type', $post->ID),
                'datetime' => get_field('event_datetime', $post->ID),
                'place' => get_field('event_place', $post->ID),
                'url' => get_field('event_reserve_url', $post->ID),
                'featured_image' => $image ? $image[0] : '',
            ];
        }

        wp_reset_postdata();
    }

    echo wp_send_json($jsonData); exit;
}

add_action('wp_ajax_events_posts_max_date_json', 'events_posts_max_date_json');
add_action('wp_ajax_nopriv_events_posts_max_date_json', 'events_posts_max_date_json');
function events_posts_max_date_json()
{
    $args = [
        'post_type' => 'events',
        'post_parent' => 0,
        'posts_per_page' => 1,
        'orderby' => 'meta_value',
        'order' => 'desc',
        'meta_key' => 'event_datetime'
    ];

    $eventsMaxDate = new WP_Query($args);

    $jsonData = [];

    if ($eventsMaxDate->have_posts()) {
        while ($eventsMaxDate->have_posts()) {
            $eventsMaxDate->the_post();

            $jsonData = [
                'datetime' => get_field('event_datetime', $post->ID),
            ];
        }

        wp_reset_postdata();
    }

    echo wp_send_json($jsonData); exit;
}
