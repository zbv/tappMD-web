<?php
/*
 *Magazine Bignews Widget
 */
add_action('widgets_init', 'csc_Magazine_1col_post_slider_widgets');

function csc_Magazine_1col_post_slider_widgets()
{
	register_widget('csc_1col_post_slider_Widget');
}

class csc_1col_post_slider_Widget extends WP_Widget {
	
	function csc_1col_post_slider_Widget()
	{
		$widget_ops = array('classname' => 'csc_magazine_1col_post_slider', 'description' => '1 Column recent posts slider.');

		$control_ops = array('width' => 255, 'height' => 350,'id_base' => 'csc_magazine-widget_1col_post_slider');

		$this->WP_Widget('csc_magazine-widget_1col_post_slider', CSC_NAME .' Post Slider', $widget_ops, $control_ops);
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
		echo '<style>#'.$ids.' .rslides_nav:hover,#'.$ids.' .rslides_nav.next:hover, #'.$ids.' .widget-title h3,#'.$ids.' a.all_cat:hover,#'.$ids.' a.rss_cat:hover,#'.$ids.' .scorehome,#'.$ids.' span.icon,#'.$ids.' .news-info div,#'.$ids.' .scorehomebig,#'.$ids.' h3.caption-static{ background-color:'.$background.';}</style>';
        echo '<style> #'.$ids.' .color_t{color:'.$background.' !important;}</style>'
		?>
 	
		<div class="row" style="position:relative;">

         <div class="span3" style="position:relative">
   
           <?php 
		 $id_rss = $categories;
		 $category_name_rss = get_cat_name( $id_rss );
		 $category_name_id = get_cat_ID($category_name_rss);
		 ?>
         <a class="rss_cat" style="right:45px;" href="<?php CSC_BASE_URL ?>?feed=rss2&cat=<?php echo $category_name_id;?>" ></a>
       
           <?php if($categories !== 'all') {

	         $id = $categories;
	         $category_link = get_category_link( $id );
	         $category_name = get_cat_name( $id );
			 
	?>
	<a class="all_cat" href="<?php echo $category_link ;?>" style="right:67px;" ></a>
    
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
            

			<div class="span3">
            <div class="row">
            
<style>
h3.caption-static{ position:absolute; bottom:10px; left:20px; padding:10px 9px 8px 9px; z-index:9999; font-weight:400}
h3.caption-static a{ color:#fff;font-weight:400}
</style>        
<ul class="rslides<?php echo $ids?>" style="overflow:hidden !important; height:212px;">	
            
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
<li>            
				<?php $thumb = get_post_thumbnail_id();?>
				<?php $image = wp_get_attachment_url($thumb, 'full'); ?>
                <?php $images = aq_resize($image, 300, 190 , true, true);?>
                <?php $format = get_post_format();?>
                 <div class="span3 bl-bg" style="position:relative;">
                  <div class="row">
                  
<h3 class="caption-static"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h3> 
<?php if ( has_post_format('image')|| !$format || has_post_format('gallery')):?>
                <?php if(has_post_thumbnail()): ?>
                <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="span3">
                <img class="alignleft" src="<?php echo $images; ?>" alt="<?php the_title(); ?>"/>
                </a>
                <?php endif?> 
<?php endif; ?> 
                  
<?php if ( has_post_format('video')):?>
                   <div class="span3">
                    <div class="row">
                   <?php $video = rwmb_meta( 'csc_video_format' );
		           $source = rwmb_meta( 'csc_video_id', 'type=text' );?>
 
	<?php if( $video == 'youtube') { ?>
			<iframe class="span3" height="190" src="http://www.youtube.com/embed/<?php echo $source;?>?rel=0" frameborder="0" allowfullscreen></iframe>
	<?php } elseif($video == 'vimeo') { ?>
		<iframe src="http://player.vimeo.com/video/<?php echo $source;?>?title=0&amp;byline=0&amp;portrait=0&amp;" class="span3" height="190" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	<?php } elseif($video == 'dialymotion') { ?>
		<iframe frameborder="0" class="span3" height="190" src="http://www.dailymotion.com/embed/video/<?php echo $source;?>?logo=0"></iframe>
	<?php } ?>
                  </div>
                  </div>
<?php endif?>            
                
                </div>
                </div>		
                
              </li>
			<?php endwhile; ?>
           </ul>
	    </div>
        </div>	
<script>
jQuery(function() {

  jQuery(".rslides<?php echo $ids?>").responsiveSlides({
  auto: true,             // Boolean: Animate automatically, true or false
  speed: 1000,            // Integer: Speed of the transition, in milliseconds
  timeout: 3000,          // Integer: Time between slide transitions, in milliseconds
  pager: false,           // Boolean: Show pager, true or false
  nav: true,             // Boolean: Show navigation, true or false
  random: false,          // Boolean: Randomize the order of the slides, true or false
  pause: true,           // Boolean: Pause on hover, true or false
  pauseControls: true,    // Boolean: Pause when hovering controls, true or false
  prevText: "",   // String: Text for the "previous" button
  nextText: "",       // String: Text for the "next" button
  maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
  navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
  manualControls: "",     // Selector: Declare custom pager navigation
  namespace: "rslides",   // String: Change the default namespace used
  before: function(){},   // Function: Before callback
  after: function(){}     // Function: After callback
});

});

</script>         
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
		
		
	<?php }
}
?>