<?php

class redes_sociais extends WP_Widget
{
    /**
     * Exibe o widget
     */
    function redes_sociais()
    {
        $widget_ops = array('description' => __('Rede Social' , THEMETEXTDOMAIN));
        parent::WP_Widget(false, __('Rede Social', THEMETEXTDOMAIN), $widget_ops);
    }

    /**
     * Monta o widget
     */
    function widget($args, $instance)
    {
        // Extrai os argumentos
        extract($args);

        $title = $instance['title'];
        $link  = $instance['link'];
        $show  = $instance['show'];

        if ($show) {

            echo $before_widget;
?>
            <a class="social-media__link" href="<?= $link; ?>" aria-label="<?= ucfirst($title); ?>" target="_blank"><i class="fa fa-<?= str_replace(" ", "-", mb_strtolower($title, 'UTF-8')); ?>" aria-hidden="true"></i></a>
<?php
        }

        echo $after_widget;

        // Reset da pesquisa
        wp_reset_postdata();
    }

    /**
     * Atualiza o widget
     */
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['link']  = strip_tags($new_instance['link']);
        $instance['show']  = $new_instance['show'];

        return $instance;
    }

    /**
     * Formulário de atualização
     */
    function form($instance)
    {
        $title   = esc_attr($instance['title']);
        $link    = esc_attr($instance['link']);
        $show    = $instance['show'];
        $checked = ($show == 'true') ? 'checked' : '';
?>

        <p>
            <input class="checkbox" type="checkbox" <?php echo $checked; ?> value="true" id="<?php echo $this->get_field_id( 'show' ); ?>" name="<?php echo $this->get_field_name( 'show' ); ?>" />
            <label for="<?php echo $this->get_field_id('show'); ?>"><?php _e('Exibir?'); ?></label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Título:', THEMETEXTDOMAIN); ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:', THEMETEXTDOMAIN); ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('link'); ?>" value="<?php echo $link; ?>" id="<?php echo $this->get_field_id('link'); ?>" />
        </p>

<?php
    }
}

register_widget('redes_sociais');
?>
