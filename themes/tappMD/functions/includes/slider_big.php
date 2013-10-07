<!-- slider begin here -->             
<?php $slider_size_post = csc_option('csc_slider_height');?>
<div id="slider_top" class="span12" style="padding-bottom:20px; height:<?php echo $slider_size_post ?>px !important">        
<?php
wp_reset_query();
global $post;
$reset_post = $post;

    $number = csc_option( 'csc_query_count' );
	$slider_query = csc_option( 'csc_query_set' );
	
	if( $slider_query == 'category_post' ){
		
		$posts =  csc_option( 'csc_query_post' );
		$args= array('posts_per_page'=> $number , 'cat' => $posts  );
		
    } elseif ( $slider_query  == 'category_slid'){
		
	  $args=array('post_type' => 'slider_csc','posts_per_page' => $number );
    
	} elseif ( $slider_query  == 'category_tags'){
		
		
		$tags = csc_option( 'csc_query_tags' );
		$args= array('posts_per_page'=> $number , 'tag_id' => $tags);
		
    
	} elseif ( $slider_query  == 'category_page'){
          
		$pages = explode (',' , csc_option( 'csc_query_page' ));
		$args= array('posts_per_page'=> $number , 'post_type' => 'page', 'post__in' => $pages  );

	} elseif ( $slider_query  == 'category_custom_post'){
          
		$pages = explode (',' , csc_option( 'csc_query_custom_post' ));
		$args= array('posts_per_page'=> $number , 'post_type' => 'post', 'post__in' => $pages  );

	}
	
	$featured_query = new WP_Query( $args );
?>


<!--slider flexiSlider-->

<?php  if ( csc_option('csc_flex_thum')) { ?>

<style type="text/css" media="all">
#magflexslider.flexslider {margin: 0 0 102px 0;}
#magflexslider .flex-control-nav { bottom: -102px; height:100px;}
#magflexslider .flex-control-thumbs li { margin:0}
</style>

<?php } else{ ?>

<style type="text/css" media="all">
#magflexslider .flexslider {margin:0 0 6px 0;}
#magflexslider .flex-control-nav { top:10px; right:10px;height:10px;}
#magflexslider.flexslider .slides > li.slideblock{height:<?php echo $slider_size_post ?>px !important}
#magflexslider.flexslider.big_slider .slider-caption a p{ margin-top:0; width:60%;}
</style>

<?php } ?>

<div class="flexslider big_slider" id="magflexslider">
<?php $title_badge = csc_option('csc_badge_tn');?>
<?php if ($title_badge):?>
<div class="cat-slider tops" style="position:absolute; top:0px; left:0px; z-index:999; padding:5px 10px;; font-size:20px; text-transform:uppercase; font-weight:700; color:#f8f8f8;"><?php echo $title_badge; ?></div>
<?php endif;?>
  <ul class="slides" style="margin-left:0; margin-bottom:0;height:<?php echo $slider_size_post ?>px !important">
  
  <?php while($featured_query->have_posts()): $featured_query->the_post(); ?>
  
								<?php if(has_post_thumbnail()): ?>
                                    
                                    <?php $thumb = get_post_thumbnail_id();?>
									<?php $image = wp_get_attachment_url($thumb, 'full'); ?>
									<?php $image_thumb = wp_get_attachment_url($thumb, 'full'); ?>
                                    
                                    <?php 
									$images = aq_resize($image, 1290, $slider_size_post , true, true); //resize & retain image proportions (soft crop)?>
                                    <?php $images_thumb = aq_resize($image_thumb, 149, 100 , true, true); //resize & retain image proportions (soft crop)?>
                                    
  
    <li data-thumb="<?php echo $images_thumb; ?>" class="slideblock">
    
    <div style="position:relative;">
      <a href="<?php if (get_post_meta($post->ID, "csc_project_urlss", true)) { print get_post_meta($post->ID, "csc_project_urlss", true);} else { the_permalink(); } ?>" title="<?php the_title(); ?>"><img src="<?php echo $images; ?>" alt="<?php the_title(); ?>" /></a>
       <?php  if ( csc_option('csc_cat_badge')) : ?>
      
                            <div class="cat-slider" style="position:absolute; bottom:5px; right:5px; z-index:999; padding:10px 7px 10px 7px; font-size:16px; color:#f8f8f8; text-transform:uppercase; opacity:0;">
							  
                              <?php $category = get_the_category();
                              if($category[0]){ echo '<a href="'.get_category_link($category[0]->term_id ).'" style="color:#f8f8f8;" >'.$category[0]->cat_name.'</a>';} ?>
                              </div>
                              
                              <?php endif;?>
      </div>
      

      <div class="slider-caption">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <h1><?php the_title(); ?></h1>
							<?php  if ( csc_option('csc_text_cap')) : ?>
							<p><?php echo string_limit_words(get_the_excerpt(), 20); ?></p>
                            <?php endif;?>

                    </a>
                    
	  </div>

      
    </li>
    
<?php endif; ?>
<?php endwhile; ?>

  </ul>
</div>
<script type="text/javascript">
	
jQuery(function() {
  
  jQuery('#magflexslider').flexslider({
    animation: "<?php echo csc_option('csc_flex_anim'); ?>",
	easing: "<?php echo csc_option('csc_flex_ea'); ?>", 
    direction: "<?php echo csc_option('csc_flex_dir'); ?>",  
    slideshowSpeed: <?php echo csc_option('csc_flex_pause'); ?>, 
    animationSpeed: <?php echo csc_option('csc_flex_spa'); ?>,           
    controlNav: "<?php if ( csc_option('csc_flex_thum')) { echo 'thumbnails';} else{ echo 'true'; } ?>",
    useCSS: false,
	pauseOnHover: true, 
	start: function(slider) {
		
		jQuery("#magflexslider .flex-active-slide").find('h1').animate({ left: '0px',opacity: 1},
											  {easing: 'easeOutExpo',
											  duration: 1500}
											  );
		jQuery("#magflexslider .flex-active-slide").find('p').animate({ bottom: '0px',opacity: 1},
											  {easing: 'easeOutExpo',
											  duration: 1500}
											  );
		jQuery("#magflexslider .flex-active-slide").find('.cat-slider').animate({ opacity: 1},
											  {easing: 'easeOutExpo',
											  duration: 1500}
											  );								  									  
       		
    	},
	after: function(slider) {

		 jQuery("#magflexslider .flex-active-slide").find('h1').animate({ left: '0px',opacity: 1},
											  {easing: 'easeOutExpo',
											  duration: 1500}
											  );
		jQuery("#magflexslider .flex-active-slide").find('p').animate({ bottom: '0px',opacity: 1},
											  {easing: 'easeOutExpo',
											  duration: 1500}
											  );
		jQuery("#magflexslider .flex-active-slide").find('.cat-slider').animate({ opacity: 1},
											  {easing: 'easeOutExpo',
											  duration: 1500}
											  );									  
      },
	  before: function(slider) {
        jQuery("#magflexslider .flex-active-slide").find('h1').animate({ left: '-650px',opacity: 1},
											  {easing: 'easeOutExpo',
											  duration: 1500}
											  );
		jQuery("#magflexslider .flex-active-slide").find('p').animate({ bottom: '-550px',opacity: 1},
											  {easing: 'easeOutExpo',
											  duration: 1500}
											  );
		jQuery("#magflexslider .flex-active-slide").find('.cat-slider').animate({opacity: 0},
											  {easing: 'easeOutExpo',
											  duration: 1500}
											  );									  
      }		
  });
  

});

</script>

</div>
<div class="clear"></div>
<?php $post = $reset_post;
wp_reset_query();?>
<!-- slider end here -->