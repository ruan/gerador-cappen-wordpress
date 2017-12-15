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
    add_theme_support('post-thumbnails', ['page', 'post', 'blog', 'statistics', 'say-no', 'slider', 'cta']);
}

/**
 * Post Thumbnails.
 *
 * Define thumbnail sizes
 */
function post_thumbnails()
{
    add_image_size('banner', 1900, 1080, true);
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
 * SVG support
 */
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
