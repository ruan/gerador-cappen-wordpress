<?php
/**
 * Custom Taxonomy
 *
 * Registra novas taxonomias customizadas no tema
 *
 * @param  string  $plural     - Nome no plural da Taxonomy
 * @param  string  $singular   - Nome no sigular da Taxonomy
 * @param  string  $slug       - Url amigável da Taxonomy
 * @param  string  $artigo     - Artigo da Taxonomy (a - feminino, o - masculino)
 * @param  string  $post_types - Post Type que receberão a Taxonomy
 * @param  boolean $showAdmin  - Exibe ou não a Taxonomy no grid do Post Types
 * @return void
 */
function custom_taxonomy($plural = "", $singular = "", $slug = "", $artigo = "", $post_types = "", $showAdmin = false)
{
    $plural   = htmlentities($plural);
    $singular = htmlentities($singular);

    $labels = array(
        "name"                       => _x($plural, "Taxonomy General Name", THEMETXTDOMAIN),
        "singular_name"              => _x($singular, "Taxonomy Singular Name", THEMETXTDOMAIN),
        "menu_name"                  => __($plural, THEMETXTDOMAIN),
        "all_items"                  => __("Todas as opções", THEMETXTDOMAIN),
        "parent_item"                => __($singular . $artigo == "a" ? "mãe" : "pai" . ":", THEMETXTDOMAIN),
        "parent_item_colon"          => __($singular . $artigo == "a" ? "mãe" : "pai" . ":", THEMETXTDOMAIN),
        "new_item_name"              => __("Nova " . strtolower($singular), THEMETXTDOMAIN),
        "add_new_item"               => __("Adicionar nov". $artigo . " " . strtolower($singular), THEMETXTDOMAIN),
        "edit_item"                  => __("Editar " . strtolower($singular), THEMETXTDOMAIN),
        "update_item"                => __("Atualizar " . strtolower($singular), THEMETXTDOMAIN),
        "separate_items_with_commas" => __("Separar " . strtolower($plural) . " com vírgulas", THEMETXTDOMAIN),
        "search_items"               => __("Procurar " . strtolower($plural), THEMETXTDOMAIN),
        "add_or_remove_items"        => __("Adicionar ou remover " . strtolower($plural), THEMETXTDOMAIN),
        "choose_from_most_used"      => __("Selecione entre " . $artigo . "s " . strtolower($plural) . " mais utilizad" . $artigo . "s", THEMETXTDOMAIN),
    );

    $rewrite = array(
        "slug"         => $slug,
        "with_front"   => true,
        "hierarchical" => true,
    );

    $args = array(
        "labels"            => $labels,
        "hierarchical"      => true,
        "public"            => true,
        "show_ui"           => true,
        "show_admin_column" => $showAdmin,
        "show_in_nav_menus" => true,
        "show_tagcloud"     => true,
        "query_var"         => $slug,
        "rewrite"           => $rewrite,
    );

    register_taxonomy($slug, $post_types, $args);
}

/**
 * Register Taxonomies
 *
 * Adiciona as Taxonomies
 *
 * @return void
 */
function register_taxonomies()
{
    custom_taxonomy("Categorias", "Categoria", "categoria", "a", array("post"), true);
}

add_action("init", "register_taxonomies");

/**
 * Add Custom Types In Query
 *
 * Adiciona os custom post à pesquisa do Wordpress
 *
 * @param  mixed $query
 * @return void
 */
function add_custom_types_in_query($query = "")
{
    if ((is_tag() || is_category() || is_date()) && (empty($query->query_vars["suppress_filters"]))) {
        // Posts incluídos na pesquisa:
        $post_types = array(
            "page",
            "blog",
        );

        $query->set("post_type", $post_types);

        return $query;
    }
}

add_filter("pre_get_posts", "add_custom_types_in_query");
