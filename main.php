<?php

/* 
Plugin Name: Google Ad's for Ships On Camera
Plugin URI: https://github.com/fabiodev/ad-soc 
Description: widget that shows google ads 
Version: 0.1 
Author: Fábio Silva 
Author URI: https://github.com/fabiodev/ 
License: A "Slug" license name e.g. GPL2 
. 
Any other notes about the plugin go here 
. 
*/  


/**
 * Adds AdSoc_Widget widget.
 */
class AdSoc_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'ad_soc_widget', // Base ID
			'Ad_Soc', // Name
			array( 'description' => __( 'A Custom Ads Widget for SOC', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
			echo "<p style='text-align:center>".$instance['adContent']-"</p>";
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}

                if ( isset( $instance[ 'adContent' ] ) ) {
                        $adContent = $instance[ 'adContent' ];
                }
                else {
                        $adContent = __( 'New Ad', 'text_domain' );
                }

		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		<textarea style="width:100%" rows="5" id="<?php echo $this->get_field_id( 'adContent' ); ?>" name="<?php echo $this->get_field_name( 'adContent' );  ?>" type="text" value="<?php echo stripslashes( $adContent ); ?>"><?php echo stripslashes( $adContent ); ?></textarea>
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['adContent'] = ( ! empty( $new_instance['adContent'] ) ) ? stripslashes( $new_instance['adContent'] ) : '';

		return $instance;
	}

}//End of CLASS

// register AdSoc_Widget widget
function register_adsoc_widget() {
    register_widget( 'AdSoc_Widget' );
}
add_action( 'widgets_init', 'register_adsoc_widget' );


?>
