<?php
/*
 *Magazine Widget 3
 */
add_action('widgets_init', 'csc_Magazine_2_column_widgets');

function csc_Magazine_2_column_widgets()
{
	register_widget('csc_2_Magazine_Widget');
}

class csc_2_Magazine_Widget extends WP_Widget {
	
	function csc_2_Magazine_Widget()
	{
		$widget_ops = array('classname' => 'csc_magazine_2', 'description' => '2 Column magazine recent posts widget.');

		$control_ops = array('width' => 250, 'height' => 350,'id_base' => 'csc_magazine-widget_2');

		$this->WP_Widget('csc_magazine-widget_2', CSC_NAME .' Magazine 2 Col', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$background = $instance['background'];
		$post_type = 'all';
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$show_image2 = isset($instance['show_image2']) ? 'true' : 'false';

		$title_2 = $instance['title_2'];
		$background_2 = $instance['background_2'];
		$post_type_2 = 'all';
		$categories_2 = $instance['categories_2'];
		$posts_2 = $instance['posts_2'];
		$show_image3 = isset($instance['show_image3']) ? 'true' : 'false';
		
		echo $before_widget;
		?>
		
		<?php
		$post_types = get_post_types();
		unset($post_types['page'],$post_types['reviews'],$post_types['product'],$post_types['portfolio'],$post_types['slider_csc'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
		
		if($post_type == 'all') {
			$post_type_array = $post_types;
		} else {
			$post_type_array = $post_type;
		}
		?>
        <?php 
		$ids = $args['widget_id'] ;
		echo '<style> #'.$ids.' .widget-title h3,#'.$ids.' a.all_cat:hover,#'.$ids.' a.rss_cat:hover,#'.$ids.' .scorehome,#'.$ids.' span.icon,#'.$ids.' .news-info div,#'.$ids.' .scorehomebig{ background-color:'.$background.';}</style>';
        echo '<style> #'.$ids.' .color_t{color:'.$background.' !important;}</style>'
		?>
		
            
		
        <div class="row">
        
        <div class="span3">
        
           <div class="row">
           
            <div class="span3" style="position:relative">
		<?php 
		 $id_rss = $categories;
		 $category_name_rss = get_cat_name( $id_rss );
		 $category_name_id = get_cat_ID($category_name_rss);
		 ?>
         <a class="rss_cat" href="<?php CSC_BASE_URL ?>?feed=rss2&cat=<?php echo $category_name_id;?>" ></a>
           <?php if($categories !== 'all') {

	         $id = $categories;
	         $category_link = get_category_link( $id );
	         $category_name = get_cat_name( $id );
			 
	?>
	<a class="all_cat" href="<?php echo $category_link ;?>" ></a>
    
	<?php 	} ?>
			<?php
			if($title) {
				echo $before_title.$title.$after_title;
			}
			?>
            </div>
			
			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts,
				'post_type' => $post_type_array,
				'cat' => $categories,
			));
			?>
			<?php 
			$counter = 1; 
			while($recent_posts->have_posts()): $recent_posts->the_post(); 
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
			?>
            
			<?php if($counter == 1): ?>
            
            
            <div class="span3 bl-bg <?php echo $format_icon; ?>">
            
			<?php $thumb = get_post_thumbnail_id();?>
				<?php $image = wp_get_attachment_url($thumb, 'full'); ?>
                <?php $images = aq_resize($image, 300, 180 , true, true);?>
                
				<?php if(has_post_thumbnail()): ?>
                <div class="row">
				<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="span3">
               
                <img class="alignleft" src="<?php echo $images; ?>" alt="<?php the_title(); ?>"/></a>
                </div>
				<?php endif?> 
                   
                     <?php if ( has_post_format('video')):?>

                    <div class="row" style="margin-bottom:10px;">
                   
                   
                   <?php $video = rwmb_meta( 'csc_video_format' );
		           $source = rwmb_meta( 'csc_video_id', 'type=text' );?>
 
	<?php if( $video == 'youtube') { ?>
			<iframe class="span3" height="180" src="http://www.youtube.com/embed/<?php echo $source;?>?rel=0" frameborder="0" allowfullscreen></iframe>
	<?php } elseif($video == 'vimeo') { ?>
		<iframe src="http://player.vimeo.com/video/<?php echo $source;?>?title=0&amp;byline=0&amp;portrait=0&amp;" class="span3" height="180" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	<?php } elseif($video == 'dialymotion') { ?>
		<iframe frameborder="0" class="span3" height="180" src="http://www.dailymotion.com/embed/video/<?php echo $source;?>?logo=0"></iframe>
	<?php } ?>
                  </div>

                   <?php endif?>     
				
                
				<div style="padding:0 15px;">
				<header class="entry-header"><h2 class="post-title top"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2></header>
                <?php csc_post_info();?>
				<p><?php echo string_limit_words(get_the_excerpt(), 29); ?>...</p>
                <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="entry-more"><?php _e('Read More ', 'csc-themewp') ?> <i class="icon-circle-arrow-right"></i> </a>
                </div>
		    
                       
			</div>
            
			<?php else: ?>
            
			<?php if($show_image2 == 'true'): ?>
            
			<div class="span3 bl-bg <?php echo $format_icon; ?>" style="margin-bottom:10px; padding-top:10px;">
				
                <?php $thumb = get_post_thumbnail_id();?>
				<?php $image = wp_get_attachment_url($thumb, 'full'); ?>
                <?php $images = aq_resize($image, 90, 90 , true, true);?>
				<?php if(has_post_thumbnail()): ?>	
				<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="pull-left"><img class="alignleft" style="margin-bottom:5px;" src="<?php echo $images; ?>" alt="<?php the_title(); ?>" /></a>
				<?php endif; ?>	
				
					<header class="entry-header"><h2 class="post-title-small"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2></header>
                    <?php csc_post_info();?>
                    <p><?php echo string_limit_words(get_the_excerpt(), 11); ?></p>
					
             </div>
            
			<?php endif; ?>
            
			<?php if($show_image2 == 'false'): ?>
            
             <div class="span3 bl-bg <?php echo $format_icon; ?>" style="margin-bottom:10px; padding-top:10px;">

				<div style="padding:0 15px;">
					<header class="entry-header"><h2 class="post-title-small"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2></header>
                    <?php csc_post_info();?>
                    <p><?php echo string_limit_words(get_the_excerpt(), 11); ?></p>
				</div>  	
             </div>        
            
			<?php endif; ?>
            
			<?php endif; ?>
			<?php $counter++; endwhile; ?>
            
             </div>
           </div> 
		
		
		<?php
		$post_types = get_post_types();
		unset($post_types['page'],$post_types['reviews'],$post_types['product'],$post_types['portfolio'],$post_types['slider_csc'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
		
		if($post_type_2 == 'all') {
			$post_type_2_array = $post_types;
		} else {
			$post_type_2_array = $post_type;
		}
		?>
        
        <?php 
		$ids = $args['widget_id'] ;
		echo '<style>  #'.$ids.' .pull-col .widget-title h3,#'.$ids.' a.all_cat.color_2:hover,#'.$ids.' a.rss_cat.color_2:hover,#'.$ids.' .scorehome.color_2,#'.$ids.' span.icon.color_2,#'.$ids.' .news-info div.color_2,#'.$ids.' .scorehomebig.color_2{ background-color:'.$background_2.';}</style>';
        echo '<style> #'.$ids.' .color_t.color_2{color:'.$background_2.' !important;}</style>'
		?>
		
	     <div class="span3">
              <div class="row">
              <div class="span3 pull-col" style="position:relative">
         
         <?php 
		 $id_rss_2 = $categories_2;
		 $category_name_rss_2 = get_cat_name( $id_rss_2 );
		 $category_name_id_2 = get_cat_ID($category_name_rss_2);
		 ?>
         <a class="rss_cat color_2" href="<?php CSC_BASE_URL ?>?feed=rss2&cat=<?php echo $category_name_id_2;?>" ></a>
         
           <?php if($categories_2 !== 'all') {

	         $id = $categories_2;
	         $category_link_2 = get_category_link( $id );
	         $category_name_2 = get_cat_name( $id );
			 
	?>
	<a class="all_cat color_2" href="<?php echo $category_link_2 ;?>" ></a>
    
	<?php 	} ?>
			<?php
			if($title) {
				echo $before_title.$title_2.$after_title;
			}
			?>
    
            </div>
			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts_2,
				'post_type' => $post_type_2_array,
				'cat' => $categories_2,
			));
			?>			
			<?php $counter = 1; while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
			<?php
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
			?>

            
			<?php if($counter == 1): ?>
            

            <div class="span3 bl-bg <?php echo $format_icon; ?>">
            
			<?php $thumb = get_post_thumbnail_id();?>
				<?php $image = wp_get_attachment_url($thumb, 'full'); ?>
                <?php $images = aq_resize($image, 300, 180 , true, true);?>
                
				<?php if(has_post_thumbnail()): ?>
                <div class="row">
				<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="span3">
               
                <img class="alignleft" src="<?php echo $images; ?>" alt="<?php the_title(); ?>"/></a>
                </div>
				<?php endif?> 
                   
                     <?php if ( has_post_format('video')):?>

                    <div class="row" style="margin-bottom:10px;">
                   
                   
                   <?php $video = rwmb_meta( 'csc_video_format' );
		           $source = rwmb_meta( 'csc_video_id', 'type=text' );?>
 
	<?php if( $video == 'youtube') { ?>
			<iframe class="span3" height="180" src="http://www.youtube.com/embed/<?php echo $source;?>?rel=0" frameborder="0" allowfullscreen></iframe>
	<?php } elseif($video == 'vimeo') { ?>
		<iframe src="http://player.vimeo.com/video/<?php echo $source;?>?title=0&amp;byline=0&amp;portrait=0&amp;" class="span3" height="180" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	<?php } elseif($video == 'dialymotion') { ?>
		<iframe frameborder="0" class="span3" height="180" src="http://www.dailymotion.com/embed/video/<?php echo $source;?>?logo=0"></iframe>
	<?php } ?>
                  </div>

                   <?php endif?>     
				
                
				<div style="padding:0 15px;">
				<header class="entry-header"><h2 class="post-title top"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2></header>
                <?php csc_post_info();?>
				<p><?php echo string_limit_words(get_the_excerpt(), 29); ?>...</p>
                <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="entry-more"><?php _e('Read More ', 'csc-themewp') ?> <i class="icon-circle-arrow-right"></i> </a>
                </div>
		    
                       
			</div>
            
            
			<?php else: ?>
            
			<?php if($show_image3 == 'true'): ?>
            
			<div class="span3 bl-bg <?php echo $format_icon; ?>" style="margin-bottom:10px; padding-top:10px;">
				
                <?php $thumb = get_post_thumbnail_id();?>
				<?php $image = wp_get_attachment_url($thumb, 'full'); ?>
                <?php $images = aq_resize($image, 90, 90 , true, true);?>
				<?php if(has_post_thumbnail()): ?>	
				<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="pull-left"><img class="alignleft" style="margin-bottom:5px;" src="<?php echo $images; ?>" alt="<?php the_title(); ?>" /></a>
				<?php endif; ?>	
				
					<header class="entry-header"><h2 class="post-title-small"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2></header>
                    <?php csc_post_info();?>
                    <p><?php echo string_limit_words(get_the_excerpt(), 11); ?></p>
					
             </div>
            
			<?php endif; ?>
            
			<?php if($show_image3 == 'false'): ?>
            
               <div class="span3 bl-bg <?php echo $format_icon; ?>" style="margin-bottom:10px; padding-top:10px;">

				<div style="padding:0 15px;">
					<header class="entry-header"><h2 class="post-title-small"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2></header>
                    <?php csc_post_info();?>
                    <p><?php echo string_limit_words(get_the_excerpt(), 11); ?></p>
				</div>  	
             </div>     
            
			<?php endif; ?>
            
			<?php endif; ?>
			<?php $counter++; endwhile; ?>
         
          </div>
         </div>   
			
		</div>
        
        
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['background'] = strip_tags($new_instance['background']);
		$instance['post_type'] = 'all';
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		$instance['show_image2'] = $new_instance['show_image2'];
		
		$instance['title_2'] = $new_instance['title_2'];
		$instance['background_2'] = strip_tags($new_instance['background_2']);
		$instance['post_type_2'] = 'all';
		$instance['categories_2'] = $new_instance['categories_2'];
		$instance['posts_2'] = $new_instance['posts_2'];
		$instance['show_image3'] = $new_instance['show_image3'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Recent Posts','background' => '','background_2' => '', 'post_type' => 'all', 'categories' => 'all', 'posts' => 4, 'show_image2'=> null , 'title_2' => 'Recent Posts', 'post_type_2' => 'all', 'categories_2' => 'all', 'posts_2' => 4,'show_image3'=> null );
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<h3>Column One</h3>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
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
			<label for="<?php echo $this->get_field_id('categories'); ?>">Filter by Category:</label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>">Number of posts:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
		</p>
        <p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_image2'], 'on'); ?> id="<?php echo $this->get_field_id('show_image2'); ?>" name="<?php echo $this->get_field_name('show_image2'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_image2'); ?>">Show thumbnail image</label>
		</p>
		
		<h3 style='margin-top: 40px;'>Column Two</h3>
		
		<p>
			<label for="<?php echo $this->get_field_id('title_2'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title_2'); ?>" name="<?php echo $this->get_field_name('title_2'); ?>" value="<?php echo $instance['title_2']; ?>" />
		</p>
        
        <script>
jQuery(document).ready(function($){
    $('#<?php echo $this->get_field_id('background_2'); ?>').wpColorPicker();
});
</script>
        
        <p>
	  <label for="<?php echo $this->get_field_id('background_2'); ?>"><?php _e('Widget Color :', 'csc-themewp') ?></label>
        </p> 
        <p>
      <input class="widefat" id="<?php echo $this->get_field_id('background_2'); ?>" name="<?php echo $this->get_field_name('background_2'); ?>" type="text" value="<?php if($instance['background_2']) { echo $instance['background_2']; } else { echo ''; } ?>" >

	</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('categories_2'); ?>">Filter by Category:</label> 
			<select id="<?php echo $this->get_field_id('categories_2'); ?>" name="<?php echo $this->get_field_name('categories_2'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories_2']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories_2']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posts_2'); ?>">Number of posts:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts_2'); ?>" name="<?php echo $this->get_field_name('posts_2'); ?>" value="<?php echo $instance['posts_2']; ?>" />
		</p>
        <p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_image3'], 'on'); ?> id="<?php echo $this->get_field_id('show_image3'); ?>" name="<?php echo $this->get_field_name('show_image3'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_image3'); ?>">Show thumbnail image</label>
		</p>
	<?php }
}
?>