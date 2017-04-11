<?php
/**
 * Theme Setup
 *
 * Inicializa as funções do tema quando o mesmo é carregado
 *
 * @return void
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
 * Text Domain
 *
 * Cria o domínio do tema
 *
 * @return void
 */
function custom_textdomain()
{
    // Textdomain
    load_theme_textdomain('vacation', get_template_directory_uri() . '/languages');
}

/**
 * Theme Support
 *
 * Carrega os recurso do tema
 *
 * @return void
 */
function theme_support()
{
    // Post Formats
    add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

    // Content Width
    add_theme_support('content-width', 1920);

    // Feed Links
    add_theme_support('automatic-feed-links');

    // Custom Header
    add_theme_support(
        'custom-header',
        array(
            'width'              => 1920,
            'height'             => 630,
            'uploads'            => true,
            'default-text-color' => '#343434'
        )
    );

    // Custom Background
    add_theme_support(
        'custom-background',
        array(
            'default-color'          => '',
            'default-image'          => '',
            'default-repeat'         => '',
            'default-position-x'     => '',
            'wp-head-callback'       => '_custom_background_cb',
            'admin-head-callback'    => '',
            'admin-preview-callback' => ''
        )
    );

    // Pots Thumbnails
    add_theme_support('post-thumbnails', array('page', 'post', 'blog'));
}

/**
 * Post Thumbnails
 *
 * Define os tamanhos dos thumbnails do tema
 *
 * @return void
 */
function post_thumbnails()
{
    add_image_size( 'post-thumb', 325, 217, true );
}

/**
 * Remove Image Sizes
 *
 * Remove os tamanhos de thumbnails padrão do Wordpress
 *
 * @param  string $sizes
 * @return void
 */
function remove_image_sizes($sizes = "")
{
    // unset($sizes['thumbnail']);
    unset($sizes['medium']);
    unset($sizes['large']);

    return $sizes;
}

function get_id_by_slug($page_slug, $slug_page_type = 'page')
{
    $find_page = get_page_by_path($page_slug, OBJECT, $slug_page_type);

    return $find_page ? $find_page->ID : null;
}

function dataExtenso($data) {
    $ano = substr($data, 0, 4);
    $mes = substr($data, 5, 2);
    $dia = substr($data, 8, 2);

    $mesExtenso = array(
        "Janeiro",
        "Fevereiro",
        "Março",
        "Abril",
        "Maio",
        "Junho",
        "Julho",
        "Agosto",
        "Setembro",
        "Outubro",
        "Novembro",
        "Dezembro",
    );

    return $dia . " de " . $mesExtenso[$mes-1] . " de " . $ano;
}

function pagination($pages = "", $range = 4)
{
    $showitems = ($range * 2) + 1;

    global $paged;

    if (empty($paged)) $paged = 1;

    if ($pages == '') {
        global $wp_query;

        $pages = $wp_query->max_num_pages;

        if ( ! $pages) {
            $pages = 1;
        }
    }

    $current = $paged;

    if (1 != $pages) {
        echo "<div class=\"paginacao\">";

        if ($paged == $pages) $paged = $paged - 5;
        if ($paged < 1) $paged = 1;

        for ($i = $paged; $i <= $pages; $i++) {
            if (1 != $pages && ( ! ($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems)) {
                if ($current == $i) {
                    echo "<a href=\"javascript:;\" class=\"paginacao__item\">" . $i . "</a>";
                } else {
                    if ($i == $paged+4 && $paged != $pages) {
                        echo '<a href="javascript:;" class="paginacao__item --periodo">...</a>';
                        echo "<a href=\"" . get_pagenum_link($pages) . "\" class=\"paginacao__item\">" . $pages . "</a>";
                    } else {
                        echo "<a href=\"" . get_pagenum_link($i) . "\" class=\"paginacao__item\">" . $i . "</a>";
                    }
                }
            }
        }

        echo "</div>";
    }
}

function getImgLink($html)
{
    $result = preg_match_all('<img.*src=("[^"]+").*>', $html, $matches, PREG_SET_ORDER);
    $imagens = array();

    if (count($matches) > 0) {
        foreach ($matches as $match) {
            $img = str_replace('"', '', $match[1]);
            $imagens[] = $img;
        }
    }

    return $imagens;
}

function wp_get_attachment($attachment_id)
{
    $attachment = get_post($attachment_id);

    return array(
        'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink($attachment->ID),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
}

function getTimeAgo($timestamp = "")
{
    date_default_timezone_set('America/Recife');

    $txt = '';
    $segundo = time() - $timestamp;
    $minuto = (int) ($segundo / 60);
    $hora = (int) ($minuto / 60);
    $dia = (int) ($hora / 24);
    $semanas = (int) ($dia / 7);
    $meses = (int) ($dia / 30);
    $ano = (int) ($dia / 365);

    if ($ano >= 1) {
        $txt = $ano . ' ' . ($ano > 1 ? 'anos' : 'ano');
    } else if ($meses >= 1) {
        $txt = $meses . ' ' . ($meses > 1 ? 'meses' : 'mês');
    } else if ($semanas >= 1) {
        $txt = $semanas . ' ' . ($semanas > 1 ? 'semanas' : 'semana');
    } else if ($dia >= 1) {
        $txt = $dia . ' ' . ($dia > 1 ? 'dias' : 'dia');
    } else if ($hora >= 1) {
        $txt = $hora . ' ' . ($hora > 1 ? 'horas' : 'hora');
    } else if ($minuto >= 1) {
        $txt = $minuto . ' ' . ($minuto > 1 ? 'minutos' : 'minuto');
    } else {
        $txt = $segundos . ' ' . ($segundos > 1 ? 'segundos' : 'segundo');
    }

    if (!is_null($txt)) {
        $txt .= ' atrás';
    }

    return $txt;
}

function curlRequest($url = "")
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}
