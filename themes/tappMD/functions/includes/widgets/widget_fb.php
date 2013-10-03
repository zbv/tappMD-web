<?php

add_action( 'widgets_init', 'csc_facebook_widgets' );
function csc_facebook_widgets() {
	register_widget( 'csc_facebook_widget' );
}
class csc_facebook_widget extends WP_Widget {

	function csc_facebook_widget() {
		$widget_ops = array( 'classname' => 'csc_facebook-widget','description' => 'Facebook Like widget.' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'csc_facebook-widget' );
		$this->WP_Widget( 'csc_facebook-widget',CSC_NAME .'  Facebook Like', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$page_url = $instance['page_url'];

		echo $before_widget;

		if ( $title ){
			echo $before_title . $title . $after_title;
		}
		?>    

	
				<iframe src="http://www.facebook.com/plugins/likebox.php?href=<?php echo urlencode($page_url) ?>&amp;width=300&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23E3E3E8&amp;stream=false&amp;header=false&amp;height=260" scrolling="no" frameborder="0" style="background:#ffffff; border: none; overflow:hidden; width:100%; height:260px; box-shadow:none !important;" allowTransparency="true"></iframe>
                
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['page_url'] = strip_tags( $new_instance['page_url'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 
		'title' =>'Like us on Facebook',
		'page_url'=> ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'page_url' ); ?>">Facebook URL : </label>
			<input id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" value="<?php echo $instance['page_url']; ?>" class="widefat" type="text" />
            <small>Ex: http://facebook.com/username/</small>
		</p>


	<?php
	}
}
?>