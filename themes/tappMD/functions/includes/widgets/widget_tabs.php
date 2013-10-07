<?php
/*
 * Tabs Widget
 */


add_action( 'widgets_init', 'csc_tabs_widgets' );

function csc_tabs_widgets() {
	register_widget( 'csc_Tabs_Widget' );
}

class csc_tabs_widget extends WP_Widget {


	
	function csc_Tabs_Widget() {
	

		$widget_ops = array( 'classname' => 'csc-tab-widget', 'description' => 'A widget that displays Tabs ( Popular post,Comments, Tags ).' );


		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'csc_tabs_widget' );

	
		$this->WP_Widget( 'csc_tabs_widget', CSC_NAME .'  Tabs Widget', $widget_ops, $control_ops );
	}


	function widget( $args, $instance ) {
		extract( $args );


		$title = apply_filters('widget_title', $instance['title'] );
		$tab1 = $instance['tab1'];
		$tab2 = $instance['tab2'];
		$tab3 = $instance['tab3'];
		$tab4 = $instance['tab4'];
		
		$posts = $instance['posts'];
		$comments = $instance['comments'];
		$tags_count = $instance['tags'];
		$show_popular_posts = isset($instance['show_popular_posts']) ? 'true' : 'false';
		$show_rec_posts = isset($instance['show_rec_posts']) ? 'true' : 'false';
		$show_comments = isset($instance['show_comments']) ? 'true' : 'false';
		$show_tags = isset($instance['show_tags']) ? 'true' : 'false';


		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

		 ?>
         
         <?php $ids = $args['widget_id'] ;?>
         
          <script type="text/javascript">
                           jQuery(document).ready(function($){
                         
                              jQuery("#<?php echo $ids ?> li:first").addClass('active');
							  jQuery("#tabs<?php echo $ids ?> .tab-pane:first").removeClass('fade').addClass('in active');
							  
                          });
                      </script>
         
        <div class="row">
        <div class="span3">
        
        <style type="text/css" media="all">
		ul#<?php echo $ids ?> { border:none !important}
		</style>
        
         <ul class="nav nav-tabs" id="<?php echo $ids ?>">
            <?php if($show_popular_posts == 'true'): ?><li><a href="#tab1<?php echo $ids; ?>" data-toggle="tab"><?php echo $tab1; ?></a></li><?php endif; ?>
            <?php if($show_rec_posts == 'true'): ?><li><a href="#tab2<?php echo $ids; ?>" data-toggle="tab"><?php echo $tab2; ?></a></li><?php endif; ?>
            <?php if($show_comments == 'true'): ?><li><a href="#tab3<?php echo $ids; ?>" data-toggle="tab"><?php echo $tab3; ?></a></li><?php endif; ?>
            <?php if($show_tags == 'true'): ?><li><a href="#tab4<?php echo $ids; ?>" data-toggle="tab"><?php echo $tab4; ?></a></li><?php endif; ?>        
          </ul>
          <div class="tab-content" id="tabs<?php echo $ids ?>">
          
          <?php if($show_popular_posts == 'true'): ?>
          
            <div class="tab-pane fade" id="tab1<?php echo $ids; ?>">
            
            <ul class="w-recentpost">
                        
                <?php 
				$popular_posts = new WP_Query('meta_key=post_views_count&orderby=meta_value_num&order=DESC&ignore_sticky_posts=1&showposts='.$posts );
				 if($popular_posts->have_posts()):
					while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
                    
                    
		


					<?php $thumb = get_post_thumbnail_id();?>
				    <?php $image = wp_get_attachment_url($thumb, 'full'); ?>
                     <?php $images = aq_resize($image, 90, 90 , true, true);?>

					
					<li style="margin-bottom:10px; padding-bottom:5px;" class=" bl-bg">
					<?php if(has_post_thumbnail()):?>
					<a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>"><img alt="<?php the_title(); ?>"  class="imageLeft" src="<?php echo $images ?>" style="padding-left:5px;"/></a>
					<?php endif; ?>
					<header class="entry-header"><h2 class="post-title-small"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2></header>
                     <?php csc_post_info();?>					
					</li>
					
            <?php 
				 endwhile; 
				endif;
				
			?>
                  </ul>
              
            </div>
            
             <?php 
				endif;
				
			?>
            
            <?php if($show_rec_posts == 'true'): ?>
          
            <div class="tab-pane fade" id="tab2<?php echo $ids; ?>">
            
            <ul class="w-recentpost">
                        
                <?php 
				$rec_posts = new WP_Query('ignore_sticky_posts=1&posts_per_page='.$posts);
				 if($rec_posts->have_posts()):
					while($rec_posts->have_posts()): $rec_posts->the_post(); ?>
		


					<?php $thumb = get_post_thumbnail_id();?>
				    <?php $image = wp_get_attachment_url($thumb, 'full'); ?>
                     <?php $images = aq_resize($image, 90, 90 , true, true);?>

					
					<li style="margin-bottom:10px; padding-bottom:5px;" class=" bl-bg">
					<?php if(has_post_thumbnail()):?>
					<a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>"><img alt="<?php the_title(); ?>"  class="imageLeft" src="<?php echo $images ?>" style="padding-left:5px;"/></a>
					<?php endif; ?>
					<header class="entry-header"><h2 class="post-title-small"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2></header>
                     <?php csc_post_info();?>
                     </li>
					
            <?php 
				 endwhile; 
				endif;
				
			?>
                  </ul>
              
            </div>
            
             <?php 
				endif;
				
			?>
            
            <?php if($show_comments == 'true'): ?>
            
            <div class="tab-pane fade" id="tab3<?php echo $ids; ?>">
            
            <ul class="w-recentpost">
             
             <?php if($show_comments == 'true'): ?>
				
					<?php
					$number = $instance['comments'];
					global $wpdb;
					$recent_comments = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,110) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $number";
					$the_comments = $wpdb->get_results($recent_comments);
					foreach ($the_comments as $comment) { ?>
                    <li style="border-bottom:1px solid #E3E3E8; margin-bottom:15px; padding-bottom:5px;">
						<div class="pull-left imageLeft">
							<?php echo get_avatar($comment, '70'); ?>
                           </div> 
                           
							<header class="entry-header"><h2 class="post-title-small"><a  href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> on <?php echo $comment->post_title; ?>"><?php echo string_limit_words(strip_tags($comment->com_excerpt), 10); ?>...</a></h2></header>
                            
                            <div><?php //echo css_theme_posted_on() ?></div>
                            <div><?php echo strip_tags($comment->comment_author); ?> </div> 
					
                    </li>
					<?php } ?>
			
				<?php endif; ?>
            </ul>
              
            </div>
            <?php endif; ?>
            
            <?php if($show_tags == 'true'): ?>
            
            <div class="tab-pane fade" id="tab4<?php echo $ids; ?>">
            <div class="tagcloud" id="tag_gl">
             <?php
				$number_tag = $instance['tags'];
				$args_tb = array(
    'smallest' => 14, 
    'largest' => 16,
    'unit'  => 'px', 
    'number'  => $number_tag,  
    'format'  => 'flat' );
				
				wp_tag_cloud( $args_tb );
		 	
		 				?>
              </div>
            </div>
           <?php endif; ?>
           
           
          </div>
          
          </div>
          </div>

      

		<?php 

		echo $after_widget;
	}

	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tab1'] = strip_tags( $new_instance['tab1'] );
		$instance['tab2'] = strip_tags( $new_instance['tab2'] );
		$instance['tab3'] = strip_tags( $new_instance['tab3'] );
		$instance['tab4'] = strip_tags( $new_instance['tab4'] );
		
		$instance['posts'] = $new_instance['posts'];
		$instance['comments'] = $new_instance['comments'];
		$instance['tags'] = $new_instance['tags'];
		$instance['show_popular_posts'] = $new_instance['show_popular_posts'];
		$instance['show_rec_posts'] = $new_instance['show_rec_posts'];
		$instance['show_comments'] = $new_instance['show_comments'];
		$instance['show_tags'] = $new_instance['show_tags'];
	

		return $instance;
	}
	

	 
	function form( $instance ) {


		$defaults = array(
		'title' => 'Widget Tabs',
		'tab1' => 'Popular',
		'tab2' => 'Recent',
		'tab3' => 'Comments',
		'tab4' => 'Tags',
		'posts' => 5, 'comments' => '5', 'tags' => 20, 'show_popular_posts' => 'on', 'show_rec_posts' => 'on', 'show_comments' => 'on', 'show_tags' =>  'on'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<!-- Username: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tab1' ); ?>"><?php echo 'Tab 1 Title: '; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab1' ); ?>" name="<?php echo $this->get_field_name( 'tab1' ); ?>" value="<?php echo $instance['tab1']; ?>" />
		</p>

		<!-- Username: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tab2' ); ?>"><?php echo 'Tab 2 Title: '; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab2' ); ?>" name="<?php echo $this->get_field_name( 'tab2' ); ?>" value="<?php echo $instance['tab2']; ?>" />
		</p>

		<!-- Username: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tab3' ); ?>"><?php echo 'Tab 3 Title: '; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab3' ); ?>" name="<?php echo $this->get_field_name( 'tab3' ); ?>" value="<?php echo $instance['tab3']; ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'tab4' ); ?>"><?php echo 'Tab 4 Title: '; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab4' ); ?>" name="<?php echo $this->get_field_name( 'tab4' ); ?>" value="<?php echo $instance['tab4']; ?>" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id('posts'); ?>">Number of posts:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('comments'); ?>">Number of comments:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('comments'); ?>" name="<?php echo $this->get_field_name('comments'); ?>" value="<?php echo $instance['comments']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('tags'); ?>">Number of tags:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>" value="<?php echo $instance['tags']; ?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_popular_posts'], 'on'); ?> id="<?php echo $this->get_field_id('show_popular_posts'); ?>" name="<?php echo $this->get_field_name('show_popular_posts'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_popular_posts'); ?>">Show popular posts</label>
		</p>
        <p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_rec_posts'], 'on'); ?> id="<?php echo $this->get_field_id('show_rec_posts'); ?>" name="<?php echo $this->get_field_name('show_rec_posts'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_rec_posts'); ?>">Show recent posts</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_comments'], 'on'); ?> id="<?php echo $this->get_field_id('show_comments'); ?>" name="<?php echo $this->get_field_name('show_comments'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_comments'); ?>">Show comments</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_tags'], 'on'); ?> id="<?php echo $this->get_field_id('show_tags'); ?>" name="<?php echo $this->get_field_name('show_tags'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_tags'); ?>">Show tags</label>
		</p>

		
	<?php
	}
}
?>