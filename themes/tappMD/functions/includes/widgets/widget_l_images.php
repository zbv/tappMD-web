<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
 * Latest Images Post
 */


add_action( 'widgets_init', 'csc_latest_image_widgets' );

function csc_latest_image_widgets() {
	register_widget( 'csc_latest_image_Widget' );
}

class csc_latest_image_widget extends WP_Widget {

	
	function csc_latest_image_Widget() {

		$widget_ops = array( 'classname' => 'csc-latest_image_widget', 'description' => 'A widget that displays latest post image.' );


		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'csc_latest_image_widget' );

		$this->WP_Widget( 'csc_latest_image_widget', CSC_NAME .' Latest post images', $widget_ops, $control_ops );
	}


	function widget( $args, $instance ) {
		extract( $args );


		$title = apply_filters('widget_title', $instance['title'] );
		$num_item = $instance['num_item'];

		

		echo $before_widget;


		if ( $title )
			echo $before_title . $title . $after_title;


		 ?>
            	<ul class="csc_latest_portfolio"> 
            	<?php 
            	$i = 100;
				global $post;
            	$loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' =>  $num_item) );
				
				while ( $loop->have_posts() ) : $loop->the_post(); 
						
					if(has_post_thumbnail()): 
					
					$thumb = get_post_thumbnail_id();
					$image = wp_get_attachment_url($thumb, 'full');
					$images = aq_resize($image, 56, 56 , true, true);

					echo '<li class="latest_portfolio_image" id="latest_portfolio_image'.$i.'">';
					echo '<a href="'.get_permalink().'" ><img src="'.$images.'" alt="" title="'.get_the_title().'" /></a>';
					echo '</li>';
					$i++;
					
                    endif; 			
				endwhile; ?>
				</ul>
		<?php 


		echo $after_widget;
	}


	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;


		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_item'] = $new_instance['num_item'];




		return $instance;
	}
	

	 
	function form( $instance ) {


		$defaults = array(
		'title' => 'Latest Post Images',
		'num_item' => '10'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
        
<p>
		<label for="<?php echo $this->get_field_id( 'num_item' ); ?>"><?php _e('Number of Item:', 'csc-themewp') ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'num_item' ); ?>" name="<?php echo $this->get_field_name( 'num_item' ); ?>" value="<?php echo $instance['num_item']; ?>" />
	</p>
		
		
	
<?php 	}
}
?>