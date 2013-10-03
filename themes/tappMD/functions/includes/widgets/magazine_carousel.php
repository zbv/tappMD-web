<?php
/*
 *Magazine Widget 4
 */
add_action('widgets_init', 'csc_magazine_carousel_widgets');

function csc_magazine_carousel_widgets()
{
	register_widget('csc_magazine_carousel');
}

class csc_magazine_carousel extends WP_Widget {
	
	function csc_magazine_carousel()
	{
		$widget_ops = array('classname' => 'csc_magazine_carousel_1', 'description' => 'Magazine carousel recent post widget.');

		$control_ops = array('width' => 250, 'height' => 350,'id_base' => 'csc_magazine_carousel_widget');

		$this->WP_Widget('csc_magazine_carousel_widget', CSC_NAME .' Magazine Carousel', $widget_ops, $control_ops);

	}
	
	function widget($args, $instance)
	{	
		extract($args);
		echo $before_widget;
		$title = $instance['title'];
		$background = $instance['background'];
		$post_type = $instance['post_type'];
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		
		?>
		<?php
			$post_types = get_post_types();
			unset($post_types['page'],$post_types['reviews'],$post_types['product'],$post_types['portfolio'],$post_types['slider_csc'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
						
			if($post_type == 'all') {
				$post_type_array = $post_types;
			} else {
					$post_type_array = $post_type;
					}	
			if($categories != 'all') {
				$categories_array = array($categories);
			}
		?>
        
        <?php 
		$ids = $args['widget_id'] ;
		echo '<style> #'.$ids.' .widget-title h3,#'.$ids.' .flex-control-paging li a.flex-active,#'.$ids.' a.all_cat:hover,#'.$ids.' a.rss_cat:hover,#'.$ids.' .scorehome,#'.$ids.' span.icon,#'.$ids.' .news-info div,#'.$ids.' .scorehomebig{ background-color:'.$background.';}</style>';
        echo '<style> #'.$ids.' .color_t{color:'.$background.' !important;}</style>'
		?>
        <div class="row">
        
		<?php
		$recent_posts = new WP_Query(array( 'showposts' => $posts, 'post_type' => $post_type_array, 'cat' => $categories,));
		if($recent_posts->found_posts >= 3):
			if($title) {?>
				
        
           <div class="span6" style="position:relative">
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
			}
			$id_s = $args['widget_id'] ;
			?>
            <script type="text/javascript">
			 // Can also be used with $(document).ready()
jQuery(function() {
  jQuery('#flexslider<?php echo $id_s ?>').flexslider({
    animation: "slide",
    //animationLoop: false,
	directionNav: false,
    itemWidth: 152,
    itemMargin: 5,
    minItems: 2,
    maxItems: 4
  });
});
			</script>
            <div class="span6">
            <style>
			#flexslider<?php echo $id_s ?> .flex-control-nav{ top:-43px; right:46px}
			#flexslider<?php echo $id_s ?> .flex-control-nav li{ margin:0; margin-left:3px;}
			#flexslider<?php echo $id_s ?> .flex-control-paging li a{ border-radius:0; box-shadow:none !important; background-color:#d4d4d8;}
			#flexslider<?php echo $id_s ?> .slides li {height:230px !important; max-height:230px !important}
			</style>
			<div class="flexslider" id="flexslider<?php echo $id_s ?>">
					<ul class="slides">
						<?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
                        
                       <?php  if(has_post_thumbnail()): ?>
                       
                        <?php $thumb = get_post_thumbnail_id();?>
				        <?php $image = wp_get_attachment_url($thumb, 'full'); ?>
                        <?php $images = aq_resize($image, 152, 90 , true, true);?>
						
						<li style="margin-right:5px;">

				          <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' ><img src="<?php echo $images; ?>" alt="<?php the_title(); ?>" /></a>
                          <header class="entry-header" style="margin-top:10px;"><h2 class="post-title-small" style="font-size:14px !important;"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2></header>
                          <?php csc_post_info();?>
				          <p><?php echo string_limit_words(get_the_excerpt(), 9); ?></p>
                
						</li>
						<?php endif;?>
						<?php endwhile; ?>
					</ul>
				</div>
                </div>
		<?php endif; ?>
        </div>
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['background'] = strip_tags($new_instance['background']);
		$instance['post_type'] = $new_instance['post_type'];
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Carousel','background' => '', 'post_type' => 'all', 'categories' => 'all', 'posts' => 6);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
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
	<?php }
}
?>