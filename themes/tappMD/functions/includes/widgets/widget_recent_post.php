<?php
/*
 * Recent Posts
 */


add_action( 'widgets_init', 'csc_recentpost_widgets' );


function csc_recentpost_widgets() {
	register_widget( 'csc_Recentpost_Widget' );
}

class csc_recentpost_widget extends WP_Widget {


	
	function csc_Recentpost_Widget() {
	

		$widget_ops = array( 'classname' => 'csc-recent-posts', 'description' => 'A widget that displays recent posts in stacked format - horizontally longer.' );

		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'csc_recentpost_widget' );


		$this->WP_Widget( 'csc_recentpost_widget', CSC_NAME .'  Recent Posts', $widget_ops, $control_ops );
	}


	
	function widget( $args, $instance ) {
		extract( $args );

	
		$title = apply_filters('widget_title', $instance['title'] );
		$number = $instance['number'];
		

	
		echo $before_widget;

	
		if ( $title )
			echo $before_title . $title . $after_title;


		 ?>
		 	<ul class="w-recentpost">
			
				<?php $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $number) );
				while ( $loop->have_posts() ) : $loop->the_post(); 			
		


					 $thumb = get_post_thumbnail_id();
				     $image = wp_get_attachment_url($thumb, 'full');
                     $images = aq_resize($image, 90, 90 , true, true);?>
                   <li style="margin-bottom:10px; padding-bottom:5px;" class=" bl-bg">
                    <?php if(has_post_thumbnail()):?>
					<a href="<?php echo get_permalink() ?>" class="imageLeft"><img alt=""  src="<?php echo $images ?>" /></a>
                    <?php endif; ?> 
					<header class="entry-header"><h2 class="post-title-small"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2></header>
                   
                   <?php csc_post_info();?>
                
				<?php echo string_limit_words(get_the_excerpt(), 20); ?>
                    </li>
				<?php endwhile;?>
				
			
			</ul>
		<?php 

	
		echo $after_widget;
	}


	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;


		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );


		return $instance;
	}

	 
	function form( $instance ) {

		
		$defaults = array(
		'title' => 'Recent Posts',
		'number' => '5'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>


		<!-- Username: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo 'Number: '; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
		
	<?php
	}
}
?>