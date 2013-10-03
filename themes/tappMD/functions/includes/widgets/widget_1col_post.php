<?php
/*
 *Magazine Bignews Widget
 */
add_action('widgets_init', 'csc_Magazine_1col_post_widgets');

function csc_Magazine_1col_post_widgets()
{
	register_widget('csc_1col_post_Widget');
}

class csc_1col_post_Widget extends WP_Widget {
	
	function csc_1col_post_Widget()
	{
		$widget_ops = array('classname' => 'csc_magazine_1col_post', 'description' => '1 Column recent posts widget.');

		$control_ops = array('width' => 255, 'height' => 350,'id_base' => 'csc_magazine-widget_1col_post');

		$this->WP_Widget('csc_magazine-widget_1col_post', CSC_NAME .' Recent Post 2', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$background = $instance['background'];
		$post_type = 'all';
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$show_image = isset($instance['show_image']) ? 'true' : 'false';
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

         <div class="span3" style="position:relative">
   
          <?php
			if($title) {
				echo $before_title.$title.$after_title;
			}
			?>
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
    
            </div>
         
			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts,
				'post_type' => $post_type_array,
				'cat' => $categories,
			));
			?>
			
			<div class="span3">
            <div class="row">
			<?php
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
             
				<?php $thumb = get_post_thumbnail_id();?>
				<?php $image = wp_get_attachment_url($thumb, 'full'); ?>
                <?php $images = aq_resize($image, 300, 100 , true, true);?>
                <?php $format = get_post_format();?>
                 <div class="span3 bl-bg">
                  <div class="row">

                <div class="span3">
                <div style="padding:0 15px;">
				<header class="entry-header"><h2 class="post-title top"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2></header>
                
                <?php csc_post_info();?>
                <?php if($show_image == 'true'): ?>
				<p><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php echo string_limit_words(get_the_excerpt(), 18); ?></a></p>
                <?php endif; ?>	

                </div>
                </div>
                
                </div>
                </div>		
                

			<?php endwhile; ?>

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
		$instance['show_image'] = $new_instance['show_image'];
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Recent Posts','background' => '', 'post_type' => 'all', 'categories' => 'all', 'posts' => 5, 'show_image'=>null );
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title :</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
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
			<label for="<?php echo $this->get_field_id('posts'); ?>">Number of posts</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
			
		</p>
        <p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_image'], 'on'); ?> id="<?php echo $this->get_field_id('show_image'); ?>" name="<?php echo $this->get_field_name('show_image'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_image'); ?>">Show content</label>
		</p>
		
		
	<?php }
}
?>