<?php

	add_action( 'widgets_init', 'csc_audio_widgets' );

	function csc_audio_widgets() {
		register_widget( 'csc_audio_widget' );
	}

	class csc_audio_widget extends WP_Widget {
	
		function csc_audio_widget() {
			$widget_ops = array( 'classname' => 'csc-audio-widget', 'description' => 'A widget to display your recent audio post.' );
			$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'csc-new-audio-widget' );
			$this->WP_Widget( 'csc-new-audio-widget', CSC_NAME .' Recent Audio', $widget_ops, $control_ops );
		}
		
		function widget( $args, $instance ) {
			extract( $args );

			$title = apply_filters('widget_title', $instance['title'] );
		
			echo $before_widget . "\n";
			if ( $title )
			echo $before_title . $title . $after_title . "\n";

			echo '<div class="row"><div class="span3">' . "\n";
			$query = new WP_Query( array( 'posts_per_page' => 1, 'post_format' => 'post-format-audio' ) );
			while ( $query->have_posts() ) : $query->the_post();
			

			$format = rwmb_meta( 'csc_post_audio_format' );
			$audio_file = rwmb_meta( 'csc_post_audio_file', 'type=file' );
			
			
			if($audio_file){
				
				foreach ( $audio_file as $info ){
				$file = $info['url'];
			    }
				
			}else{
				
				$file = rwmb_meta( 'csc_post_audio_link' );
				
				}
			
			
			echo csc_audio_player('file='.$file);
			

			
			endwhile; wp_reset_postdata();
			echo '</div></div>' . "\n";
		
			echo $after_widget . "\n\n";
		}
		

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );
			return $instance;
		}
		
		
		function form( $instance ) {
			
			$defaults = array( 
				'title' => 'Recent Audio',
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</p>
			
			<?php 
		}
	}
?>