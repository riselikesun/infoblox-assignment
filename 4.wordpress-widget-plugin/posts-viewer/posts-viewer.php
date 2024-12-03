<?php

/**
 * Plugin Name: Posts viewer
 * Description: A WordPress plugin to display recent posts from a specific category in a widget.
 * Version: 1.03
 * Author: Suraj Sharma
 * Author URI: https://riselike.com
 * License: GPLv3
 */

class Post_Viewer_Widget extends WP_Widget
{
    private int $postLimit;

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        // set view post limit to 5
        $this->postLimit = 5;

        $widget_ops = array(
            'classname' => 'post_viewer_widget',
            'description' => 'A widget displaying recent posts from a specific category',
        );
        parent::__construct('post_viewer_widget', 'Post Viewer', $widget_ops);
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        $category_id = $instance['category_id'];

        echo $args['before_widget'];

        $query_args = array(
            'post_type' => 'post',
            'cat' => $category_id,
            'posts_per_page' => $this->postLimit
        );

        $recent_posts = new WP_Query($query_args);

        if ($recent_posts->have_posts()) {
            echo '<ul>';
            while ($recent_posts->have_posts()) {
                $recent_posts->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No recent posts in this category.</p>';
        }

        echo $args['after_widget'];

        wp_reset_postdata();
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form($instance)
    {
        $category_id = ! empty($instance['category_id']) ? $instance['category_id'] : '';
?>
        <p>
            <label for="<?php echo $this->get_field_id('category_id'); ?>">Select Category:</label>
            <?php
            wp_dropdown_categories(array(
                'show_option_all' => 'All Categories',
                'name' => $this->get_field_name('category_id'),
                'id' => $this->get_field_id('category_id'),
                'selected' => $category_id,
                'hierarchical' => true,
                'show_count' => true,
                'hide_empty' => false,
            ));
            ?>
        </p>
<?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['category_id'] = strip_tags($new_instance['category_id']);

        return $instance;
    }
}

add_action('widgets_init', function () {
    register_widget('Post_Viewer_Widget');
});
