<?php

add_action( 'widgets_init', 'csc_google_widgets' );
function csc_google_widgets() {
	register_widget( 'csc_google_widget' );
}
class csc_google_widget extends WP_Widget {

	function csc_google_widget() {
		$widget_ops = array( 'classname' => 'csc_google-widget','description' => 'Follow Google+ widget.'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'csc_google-widget' );
		$this->WP_Widget( 'csc_google-widget',CSC_NAME .' Follow Google+', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$google_id = $instance['google_id'];

		echo $before_widget;
		if($instance['title']) {
			echo $before_title.$instance['title'].$after_title;
		} ?>
         <div class="row">
          <div class="span3" style="overflow:hidden;">
				
                <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
                <div class="g-plus" data-height="131" data-width="370" data-href="https://plus.google.com/<?php echo $google_id ?>"></div>
               
        </div>
       </div>
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['google_id'] = strip_tags( $new_instance['google_id'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 
		'title' => 'Follow Google+',
		'google_id'=> ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'google_id' ); ?>">Google ID : </label>
			<input id="<?php echo $this->get_field_id( 'google_id' ); ?>" name="<?php echo $this->get_field_name( 'google_id' ); ?>" value="<?php echo $instance['google_id']; ?>" class="widefat" type="text" />
            <small>Ex: 114704017394337192367</small>
		</p>


	<?php
	}
}
?>