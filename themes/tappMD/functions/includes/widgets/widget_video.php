<?php
/*
 * Video Widget
 */
add_action( 'widgets_init', 'csc_video_widgets' );


function csc_video_widgets() {
	register_widget( 'csc_Video_Widget' );
}

class csc_video_widget extends WP_Widget {

	
	function csc_Video_Widget() {
	

		$widget_ops = array( 'classname' => 'video-widget', 'description' => 'A widget that displays a video.' );

		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'csc_video_widget' );

		$this->WP_Widget( 'csc_video_widget', CSC_NAME .'  Video Widget', $widget_ops, $control_ops );
	}

	
	function widget( $args, $instance ) {
		extract( $args );


		$title = apply_filters('widget_title', $instance['title'] );
		$source = $instance['source'];
		$type = $instance['type'];
	
		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

		 ?>
         <div class="row"> 
        <?php if($type == 'Youtube') { ?>
		<iframe class="span3" height="200" src="http://www.youtube.com/embed/<?php echo $source;?>?rel=0" frameborder="0" 	allowfullscreen></iframe>
		<?php } elseif($type == 'Vimeo') { ?>
		<iframe src="http://player.vimeo.com/video/<?php echo $source;?>?title=0&amp;byline=0&amp;portrait=0&amp;" class="span3" height="200" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		<?php } elseif($type == 'Dialymotion') { ?>
		<iframe frameborder="0" class="span3" height="200" src="http://www.dailymotion.com/embed/video/<?php echo $source;?>?logo=0"></iframe>
		<?php } ?>
         </div>   
		<?php 

		echo $after_widget;
	}

	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['type'] = $new_instance['type'];
		$instance['source'] = strip_tags( $new_instance['source'] );



		return $instance;
	}

	 
	function form( $instance ) {


		$defaults = array(
		'title' => 'Widget Video',
		'source' => '',
		'type' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'source' ); ?>"><?php echo 'Source ID: '; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'source' ); ?>" name="<?php echo $this->get_field_name( 'source' ); ?>" value="<?php echo $instance['source']; ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>">Type :</label>
			<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
				<option <?php if ( 'Youtube' == $instance['type'] ) echo 'selected="selected"'; ?>>Youtube</option>
				<option <?php if ( 'Vimeo' == $instance['type'] ) echo 'selected="selected"'; ?>>Vimeo</option>
				<option <?php if ( 'Dialymotion' == $instance['type'] ) echo 'selected="selected"'; ?>>Dialymotion</option>
			</select>
		</p>
		
	<?php
	}
}
?>