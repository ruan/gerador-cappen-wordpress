<?php
/**
 * Social Networks class
 */
class SocialNetworks extends WP_Widget
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $widget_ops = ['description' => __('Social Network', THEMETXTDOMAIN)];
        parent::__construct(false, __('Social Network', THEMETXTDOMAIN), $widget_ops);
    }

    /**
     * Build the widget
     *
     * @param  array $args
     * @param  array $instance
     * @return string
     */
    public function widget($args = [], $instance = [])
    {
        extract($args);

        $title = $instance['title'];
        $link = $instance['link'];
        $show = $instance['show'];

        if ($show) {
            echo $before_widget;

            echo '<a class="social-media__link" href="' . $link . '" aria-label="' . ucfirst($title) . '" target="_blank">';
                echo '<i class="fa fa-' . str_replace(' ', '-', mb_strtolower($title, 'UTF-8')) . '" aria-hidden="true"></i>';
            echo '</a>';

            echo $after_widget;
        }

        // Reset data
        wp_reset_postdata();
    }

    /**
     * Update the widget
     *
     * @param  array $new_instance
     * @param  array $old_instance
     * @return array
     */
    public function update($new_instance = [], $old_instance = [])
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['link'] = strip_tags($new_instance['link']);
        $instance['show'] = $new_instance['show'];

        return $instance;
    }

    /**
     * Build the form
     *
     * @param  array $instance
     * @return string
     */
    public function form($instance = [])
    {
        $title = !empty($instance['title']) ? esc_attr($instance['title']) : '';
        $link = !empty($instance['link']) ? esc_attr($instance['link']) : '';
        $show = !empty($instance['show']) ? $instance['show'] : '';
        $checked = ($show == 'true') ? 'checked' : ''; ?>

        <p>
            <input class="checkbox" type="checkbox" <?php echo $checked; ?> value="true" id="<?php echo $this->get_field_id('show'); ?>" name="<?php echo $this->get_field_name('show'); ?>" />
            <label for="<?php echo $this->get_field_id('show'); ?>"><?php _e('Show?'); ?></label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', THEMETXTDOMAIN); ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:', THEMETXTDOMAIN); ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('link'); ?>" value="<?php echo $link; ?>" id="<?php echo $this->get_field_id('link'); ?>" />
        </p>

<?php

    }
}

register_widget('SocialNetworks');
?>
