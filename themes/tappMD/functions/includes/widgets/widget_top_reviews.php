<?php
/*
 * Reviews Posts
 */


add_action( 'widgets_init', 'csc_reviews_widgets' );


function csc_reviews_widgets() {
	register_widget( 'csc_Reviews_Widget' );
}

class csc_reviews_widget extends WP_Widget {


	
	function csc_Reviews_Widget() {
	

		$widget_ops = array( 'classname' => 'csc-reviews-posts', 'description' => 'A widget that displays top reviews posts.' );

		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'csc_reviews_widget' );


		$this->WP_Widget( 'csc_reviews_widget', CSC_NAME .'  Top Reviews Posts', $widget_ops, $control_ops );
	}


	
	function widget( $args, $instance ) {
		extract( $args );

	
		$title = $instance['title'];
		$post_type = 'all';
		$categories = $instance['categories'];
		$posts_v = $instance['posts_v'];
		
		echo $before_widget;

        
		$post_types = get_post_types();
		unset($post_types['page'],$post_types['portfolio'],$post_types['slider_csc'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
		
		if($post_type == 'all') {
			$post_type_array = $post_types;
		} else {
			$post_type_array = $post_type;
		}

	
		if ( $title )
			echo $before_title . $title . $after_title;


		 ?>
         
       
            <?php 
				$popular_posts = new WP_Query('meta_key=post_views_count&orderby=meta_value_num&order=DESC&ignore_sticky_posts=1&cat='.$categories.'&showposts='.$posts_v );
				  ?>
            
<ul class="w-recentpost" style="margin-bottom:0;">
			
				<?php
				
				$i=1;

				if($popular_posts->have_posts()):
					while($popular_posts->have_posts()): $popular_posts->the_post();		
		        ?>
                    <li class="rev_block" style="border-bottom:1px solid #E3E3E8; margin-bottom:5px; padding-bottom:10px; position:relative; overflow:hidden">
                    <?php echo "<span class=\"top-num\">" . $i . "</span>";
					$i++;
					?>
                   
					<header class="entry-header" style="margin-left:40px;padding-bottom:2px; border-bottom:1px solid #e3e3e8;"><h2 class="post-title-small"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a> <?php
			if( rwmb_meta('csc_reviews_system') == 'stars' && rwmb_meta('csc_reviews_act')):
			globalScore();
			global $totalscore;
			$starscore = $totalscore / 2;
            $starscore = round($starscore/.5)*.5;
            ?>
            <span><img src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo $starscore ?>.png" alt="" style="margin-bottom:0px; margin-left:5px" /></span>
			<?php endif; ?></h2></header>
                    
                    
					<div class="entry-info" style="margin-left:40px; margin-top:5px;"> 
				

					
<?php if( rwmb_meta('csc_reviews_system') == 'percentage' && rwmb_meta('csc_reviews_act')):
			globalScore();
			global $totalscore;
            ?>
							
    <span class="scorehomebig"><?php echo $totalscore*10;?>%</span>							
<?php endif; ?>

<?php if( rwmb_meta('csc_reviews_system') == 'points' && rwmb_meta('csc_reviews_act')):
			globalScore();
			global $totalscore;
            ?>
							
	 <span class="scorehomebig"><?php echo $totalscore;?></span>							
<?php endif; ?> 
					
			
            <?php if($categories !== 'all') {

	         $id = $categories;
	         $category_link = get_category_link( $id );
	         $category_name = get_cat_name( $id );?>
			 <span style="font-size:14px; font-style:normal !important;"><?php _e('In Category : ', 'csc-themewp') ?><a style="font-size:14px; font-style:normal !important;" href="<?php echo $category_link ;?>" ><?php echo $category_name;?></a></span>
					<?php }else{?>
                    		
			<?php if ( count( get_the_category() ) ) : ?>
			<?php _e('In Category : ', 'csc-themewp') ?><span style="font-size:14px; font-style:normal !important; margin-left:5px;"><?php printf( __( '%2$s', 'csc-themewp'), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?></span>
			<?php endif; 
					}?>		
      
                    </div>
                    </li>
                 

                    
				 <?php 
				 endwhile; 
				endif;
				
			?>
				
			
			</ul>
		<?php 

	
		echo $after_widget;
	}


	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['post_type'] = 'all';
		$instance['categories'] = $new_instance['categories'];
		$instance['posts_v'] = $new_instance['posts_v'];
		//$instance['show_image'] = $new_instance['show_image'];
		return $instance;
	}

	 
	function form( $instance ) {

		
		
		$defaults = array('title' => 'Top Reviews', 'post_type' => 'all', 'categories' => 'all', 'posts_v' => 5 );
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title :</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>">Filter by Category :</label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('posts_v'); ?>">Number of posts</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts_v'); ?>" name="<?php echo $this->get_field_name('posts_v'); ?>" value="<?php echo $instance['posts_v']; ?>" />
			
		</p>
		
        
		
	<?php
	}
}
?>