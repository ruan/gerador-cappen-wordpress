<?php
/**
 * Custom Post Type
 *
 * Registra novos posts customizados no tema
 *
 * @param  string  $plural     - Nome no plural do Custom Post
 * @param  string  $singular   - Nome no singular do Custom Post
 * @param  string  $slug       - Url amigável do Custom Post
 * @param  string  $artigo     - Artigo do Custom Post (a - feminino, o - masculino)
 * @param  string  $capacidade - Capacidade do Custom Post (post, page)
 * @param  integer $ordem      - Ordem do menu administrativo do Custom Post
 * @param  string  $icone      - Ícone do menu administrativo do Custom Post
 * @param  string  $taxonomias - Taxonomias associadas ao Custom Post
 * @return void
 */
function custom_post_type($plural = "", $singular = "", $slug = "", $artigo = "", $capacidade = "", $ordem = 0, $icone = "", $taxonomias = "")
{
    $plural   = htmlentities($plural, ENT_QUOTES, "UTF-8");
    $singular = htmlentities($singular, ENT_QUOTES, "UTF-8");

    $labels = array(
        "name"               => _x($plural, "Post Type General Name", THEMETXTDOMAIN),
        "singular_name"      => _x($singular, "Post Type Singular Name", THEMETXTDOMAIN),
        "menu_name"          => __($plural, THEMETXTDOMAIN),
        "parent_item_colon"  => __("Post pai", THEMETXTDOMAIN),
        "all_items"          => __("Todos os posts", THEMETXTDOMAIN),
        "view_item"          => __("Ver post", THEMETXTDOMAIN),
        "add_new_item"       => __("Adicionar novo post", THEMETXTDOMAIN),
        "add_new"            => __("Novo post", THEMETXTDOMAIN),
        "edit_item"          => __("Editar post", THEMETXTDOMAIN),
        "update_item"        => __("Atualizar post", THEMETXTDOMAIN),
        "search_items"       => __("Procurar posts", THEMETXTDOMAIN),
        "not_found"          => __($artigo == "o" ? "Nenhum " . strtolower($singular) . " encontrado" : "Nenhuma " . strtolower($singular) . " encontrada", THEMETXTDOMAIN),
        "not_found_in_trash" => __("Nenhum post na lixeira", THEMETXTDOMAIN),
    );

    $rewrite = array(
        "slug"       => $slug,
        "with_front" => true,
        "pages"      => true,
        "feeds"      => true,
    );

    $args = array(
        "label"               => __($slug, THEMETXTDOMAIN),
        "description"         => __("Post", THEMETXTDOMAIN),
        "labels"              => $labels,
        "supports"            => array("title", "editor", "excerpt", "author", "thumbnail", "comments", "trackbacks", "revisions", "custom-fields", "page-attributes", "post-formats"),
        "taxonomies"          => $taxonomias,
        "hierarchical"        => true,
        "public"              => true,
        "show_ui"             => true,
        "show_in_menu"        => true,
        "show_in_nav_menus"   => true,
        "show_in_admin_bar"   => true,
        "menu_position"       => $ordem,
        "menu_icon"           => $icone,
        "can_export"          => true,
        "has_archive"         => false,
        "exclude_from_search" => false,
        "publicly_queryable"  => true,
        "query_var"           => $slug,
        "rewrite"             => $rewrite,
        "capability_type"     => $capacidade,
    );

    register_post_type($slug, $args);
}

/**
 * Remove Box
 *
 * Remove recursos do cadastro e edição de posts
 *
 * @return void
 */
function remove_box()
{
    remove_meta_box("content", "slides", "normal");
    remove_meta_box("authordiv", "slides", "normal");
    remove_meta_box("commentstatusdiv", "slides", "normal");
    remove_meta_box("commentsdiv", "slides", "normal");
    remove_meta_box("postcustom", "slides", "normal");
    remove_meta_box("revisionsdiv", "slides", "normal");
    remove_meta_box("slugdiv", "slides", "normal");
    remove_meta_box("trackbacksdiv", "slides", "normal");
    remove_meta_box("contentdiv", "slides", "normal");
}

add_action("admin_init", "remove_box");

/**
 * Register Custom Posts
 *
 * Adiciona os Custom Posts
 *
 * @return void
 */
function register_custom_posts()
{
    custom_post_type("Blog", "Blog", "blog", "o", "post", 2, "dashicons-welcome-write-blog", array());
}

add_action("init", "register_custom_posts");
