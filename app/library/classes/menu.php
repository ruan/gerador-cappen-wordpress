<?php
/**
 * Arquivo de declaração da classe menuTopoNav
 */
class menu extends Walker_Nav_Menu
{
    public function start_el(&$output, $item, $depth, $args)
    {
        // Variáveis globais
        global $wp_query;

        // Indentação
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        // Inicializa a variável de classes
        $class_names = $value = '';

        // Verifica se foi definida alguma classe
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $aditionalClass = empty($args->menu_class) ? "" : $args->menu_class;

        // Define as classes
        $class_names = in_array("current-menu-item", $item->classes) ? ' active' : '';

        // Verifica se os atributos foram informados
        $attributes  .= ! empty($item->target)     ? ' target="' . esc_attr($item->target) .'"' : '';
        $attributes  .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) .'"' : '';
        $attributes  .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url) .'"' : '';
        $description =  ! empty($item->description) ? '<span>' . esc_attr($item->description) . '</span>' : '';

        // Monta a saída do item
        $item_output = $args->before;
        // $item_output .= '<li class="' . $liClass .'">';
        $item_output .= '<a ' . $attributes . ' class="' . $aditionalClass . $class_names . '">';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= $description.$args->link_after;
        $item_output .= '</a>';

        // if ($args->walker->has_children != 1) {
        //     $item_output .= '</li>';
        // }

        $item_output .= $args->after;

        // Retorna o item formatado
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= "\n";
    }

    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent .= str_repeat("\t", $depth);
        $output .= "\n$indent<ul>\n";
    }

    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></li>\n";
    }
}
