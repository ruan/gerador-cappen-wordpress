<?php
/**
 * Custom wp_title.
 */
function the_head_title()
{
    if (is_home()) {
        bloginfo('name');
        if (get_bloginfo('description')) {
            echo ' - ';
            bloginfo('description');
        }
    } elseif (is_category()) {
        $title = ucwords(single_cat_title('', false));
        echo $title . ' - ';
        bloginfo('name');
        if (get_bloginfo('description')) {
            echo ' - ';
            bloginfo('description');
        }
    } elseif (is_single()) {
        $title = get_page_by_path(get_post_type(get_the_ID()));
        single_post_title();
        echo ' - ';
        bloginfo('name');
        if (get_bloginfo('description')) {
            echo ' - ';
            bloginfo('description');
        }
    } elseif (is_tag()) {
        $title = ucwords(single_cat_title('', false));
        echo $title . ' - Tag - ';
        bloginfo('name');
        if (get_bloginfo('description')) {
            echo ' - ';
            bloginfo('description');
        }
    } elseif (is_page()) {
        if (get_the_title() != 'Home') {
            single_post_title();
            echo ' - ';
        }
        bloginfo('name');
        if (get_bloginfo('description')) {
            echo ' - ';
            bloginfo('description');
        }
    } elseif (is_archive()) {
        if (is_tax()) {
            $title = ucwords(single_cat_title('', false));
            echo $title . ' - Categoria - ';
            bloginfo('name');
            if (get_bloginfo('description')) {
                echo ' - ';
                bloginfo('description');
            }
        } else {
            $title = get_page_by_path(get_post_type(get_the_ID()));
            _e($title->post_title);
            echo ' - ';
            bloginfo('name');
            if (get_bloginfo('description')) {
                echo ' - ';
                bloginfo('description');
            }
        }
    } else {
        wp_title('-', true, 'right');
    }
}
