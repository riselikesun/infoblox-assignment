<?php
/**
 * Plugin Name: Posts viewer
 * Description: A WordPress plugin to display recent posts from a specific category in a widget.
 * Version: 1.0
 * Author: Suraj Sharma
 * Author URI: https://riselike.com
 * License: GPLv3
 */

 class Post_Viewer_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'post_viewer_widget',
			'description' => 'A widget displaying recent posts from a specific category',
		);
		parent::__construct( 'post_viewer_widget', 'My Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Post_Viewer_Widget' );
});