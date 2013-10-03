<?php
/*
 * Photostream Widget
 */

add_action( 'widgets_init', 'csc_photostream_widgets' );

function csc_photostream_widgets() {
	register_widget( 'csc_Photostream_Widget' );
}

class csc_photostream_widget extends WP_Widget {

	
	function csc_Photostream_Widget() {
	

		$widget_ops = array( 'classname' => 'csc-photostreamwidget', 'description' => 'A widget that displays your photostream Flickr, Dribbble, Pinterest, Instagram.' );

	
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'csc_photostream_widget' );

	
		$this->WP_Widget( 'csc_photostream_widget', CSC_NAME .' Photostreams', $widget_ops, $control_ops );
	}


	
	function widget( $args, $instance ) {
		extract( $args );


		$title = apply_filters('widget_title', $instance['title'] );
		$username = $instance['username'];
		$postcount = $instance['postcount'];
	    $type = $instance['type'];


		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

	
		 ?>
         <?php $ids = $args['widget_id'] ; ?>

              <div id="<?php echo $ids; ?>" class="photostream"></div>
              
              <script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('#<?php echo $ids; ?> .photostream').csc_photostream({user: '<?php echo $username ?>', 
				limit:<?php echo $postcount ?>, 
				social_network: '<?php echo $type ?>'});
			});	              
			</script>
	
		<?php 

		
		echo $after_widget;
	}


	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['postcount'] = $new_instance['postcount'];
	    $instance['type'] = $new_instance['type'];

	

		return $instance;
	}
	

	 
	function form( $instance ) {

		
	    $defaults = array(
		'title' => 'Photostream',
		'username' => 'envato',
		'postcount' => '10',
		'type' => 'flickr'
	    );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<!-- Username: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php echo 'Username: '; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
		</p>
        
        <p>
		<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of Photos:', 'csc-themewp') ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Photostream : ', 'csc-themewp') ?></label>
		<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
			<option <?php if ( 'flickr' == $instance['type'] ) echo 'selected="selected"'; ?>>flickr</option>
			<option <?php if ( 'pinterest' == $instance['type'] ) echo 'selected="selected"'; ?>>pinterest</option>
            <option <?php if ( 'dribbble' == $instance['type'] ) echo 'selected="selected"'; ?>>dribbble</option>
            <option <?php if ( 'instagram' == $instance['type'] ) echo 'selected="selected"'; ?>>instagram</option>
		</select>
	</p>
	
		
		
		
	<?php
	}
}
?>