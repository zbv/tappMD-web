<?php 

add_action( 'widgets_init', 'csc_mag_latest_image_widgets' );

function csc_mag_latest_image_widgets() {
	register_widget( 'csc_mag_latest_image_Widget' );
}

class csc_mag_latest_image_widget extends WP_Widget {

	
	function csc_mag_latest_image_Widget() {

		$widget_ops = array( 'classname' => 'csc-mag_latest_image_widget', 'description' => 'A widget that displays latest post image.' );


		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'csc_mag_latest_image_widget' );

		$this->WP_Widget( 'csc_mag_latest_image_widget', CSC_NAME .'  Magazine Post Images', $widget_ops, $control_ops );
	}


	function widget( $args, $instance ) {
		extract( $args );


		$title = apply_filters('widget_title', $instance['title'] );
		$background = $instance['background'];
		$num_item = $instance['num_item'];

		

		echo $before_widget;
		 ?>
         <?php 
		$ids = $args['widget_id'] ;
		echo '<style> #'.$ids.' .widget-title h3,#'.$ids.' a.all_cat:hover,#'.$ids.' a.rss_cat:hover,#'.$ids.' .scorehome,#'.$ids.' span.icon,#'.$ids.' .news-info div,#'.$ids.' .scorehomebig{ background-color:'.$background.';}</style>';
        echo '<style> #'.$ids.' .color_t{color:'.$background.' !important;}</style>'
		?>
            	<div class="row">
                
                
                 <div class="span6" style="position:relative">
			<?php
			if($title) {
				echo $before_title.$title.$after_title;
			}
			?>
            </div>
                 
            	<?php 
            	$i = 100;
				global $post;
            	$loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' =>  $num_item) );
				
				while ( $loop->have_posts() ) : $loop->the_post(); 
				
			
			if(has_post_format('video')) 
			{
				$format_icon = 'format-video';
			}
			else if (has_post_format('audio'))
			{
				$format_icon = 'format-audio';
			}
			else if (has_post_format('gallery'))
			{
				$format_icon = 'format-gallery';
			}
			else if (has_post_format('image'))
			{
				$format_icon = 'format-image';
			}
			else if (has_post_format('aside'))
			{
				$format_icon = 'format-aside';
			}
			else {
				$format_icon = 'format-standard';
			}
			
						
					if(has_post_thumbnail()): 
					
					$thumb = get_post_thumbnail_id();
					$image = wp_get_attachment_url($thumb, 'full');
					$images = aq_resize($image, 190, 80 , true, true);

					echo '<div class="span2 '.$format_icon.'" style="margin-bottom:10px;"><div class="row">';
					echo '<a href="'.get_permalink().'" class="post-format-s span2"><span></span><img src="'.$images.'" alt="" title="'.get_the_title().'" /></a>';
					echo '</div></div>';
					$i++;
					
                    endif; 			
				endwhile; ?>
				
               </div>
		<?php 


		echo $after_widget;
	}


	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;


		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['background'] = strip_tags($new_instance['background']);
		$instance['num_item'] = $new_instance['num_item'];




		return $instance;
	}
	

	 
	function form( $instance ) {


		$defaults = array(
		'title' => 'Latest Post Images',
		'background' => '',
		'num_item' => '4'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
        
        <script>
jQuery(document).ready(function($){
    $('#<?php echo $this->get_field_id('background'); ?>').wpColorPicker();
});
</script>
        
        <p>
	  <label for="<?php echo $this->get_field_id('background'); ?>"><?php _e('Widget Color :', 'csc-themewp') ?></label>
        </p> 
        <p>
      <input class="widefat" id="<?php echo $this->get_field_id('background'); ?>" name="<?php echo $this->get_field_name('background'); ?>" type="text" value="<?php if($instance['background']) { echo $instance['background']; } else { echo ''; } ?>" >

	</p>
        
<p>
		<label for="<?php echo $this->get_field_id( 'num_item' ); ?>"><?php _e('Number of Item:', 'csc-themewp') ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'num_item' ); ?>" name="<?php echo $this->get_field_name( 'num_item' ); ?>" value="<?php echo $instance['num_item']; ?>" />
	</p>
		
		
	<?php
	}
}
?>