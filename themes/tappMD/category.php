<?php
get_header();
?>

<div class="container slider-cont"> 
  <div class="row">
  

<?php if (csc_option('csc_banner_page')):?>

<div class="span12">

<?php 
		$csc_banner_top_margin ='';
		if (csc_option('csc_banner_page_margin')){ 
		 $csc_banner_top_margin = 'margin-top:'.csc_option('csc_banner_page_margin'); 
		}
		
		csc_banner('csc_banner_page' , '<div style="text-align:center;'. $csc_banner_top_margin .'">' , '</div>' ); 
		
		?>

</div>

<?php endif; ?> 

<!-- Page Title -->
<div class="span12">
<header id="pagehead">

<h1 class="page-title"><?php $current_category = single_cat_title("", false);  echo $current_category; ?> Resource Center</h1>


</header>
</div>


<div class="span12">
<div class="row">
<section>

<?php wp_reset_query();?>

<?php if( csc_option('csc_sidebar_pos_cat') == 'left_right' ):?>

<div class="span3">

<div class="row">
<div class="span3">
<?php 
if (is_category()) {	
$category_id = get_query_var('cat') ;
$cat_sidebar = csc_option( 'csc_cat_'.$category_id ) ;
if( $cat_sidebar ){
dynamic_sidebar ( sanitize_title( $cat_sidebar ) ); 
}
else dynamic_sidebar("Sidebar One");
}
?>
</div>
</div>

</div>
<?php endif; ?>

<?php wp_reset_query();?>

<?php if( csc_option('csc_sidebar_pos_cat') == 'left'):?>

<div class="span3">

<div class="row">
<div class="span3">
<?php 
if (is_category()) {	
$category_id = get_query_var('cat') ;
$cat_sidebar = csc_option( 'csc_cat_'.$category_id ) ;
if( $cat_sidebar ){
dynamic_sidebar ( sanitize_title( $cat_sidebar ) ); 
}
else dynamic_sidebar("Sidebar One");
}
?>
</div>
</div>

</div>

<div class="span3">

<div class="row">
<div class="span3">
<?php 
if (is_category()) {	
$category_id = get_query_var('cat') ;
$cat_sidebar = csc_option( 'csc_cat_2_'.$category_id ) ;
if( $cat_sidebar ){
dynamic_sidebar ( sanitize_title( $cat_sidebar ) ); 
}
else dynamic_sidebar("Sidebar Two");
}
?>
</div>
</div>

</div>

<?php endif; ?>

<?php wp_reset_query();?>

<div class="span6" id="blog_page">
<div class="row">
<?php if (csc_option('csc_breadcrumbs')):?>
<div class="span6">
      <?php csc_include( 'breadcrumbs' ); ?>
</div>
<?php endif;?>

<?php if ( $paged < 2 ) : ?>

<?php if (csc_option('csc_cat_slider')):?>

<?php if(has_post_thumbnail()): ?>
<!-- slider begin here --> 


<!--slider flexiSlider-->

<?php  if ( csc_option('csc_flex_thum')) { ?>

<style>
#magflexslider.flexslider {margin: 0 0 102px 0;}
#magflexslider .flex-control-nav { bottom: -102px; height:100px;}
#magflexslider .flex-control-thumbs li { margin:0}
</style>

<?php } else{ ?>

<style>
#magflexslider .flexslider {margin:0 0 6px 0;}
#magflexslider .flex-control-nav { top:10px; right:10px;height:10px;}
</style>

<?php } ?>
<div class="span6">
<div class="flexslider" id="magflexslider" style="margin-top:0px;">

  <ul class="slides" style="margin-left:0; margin-bottom:0;">
  
<?php  $number = csc_option( 'csc_query_count' );
$current_category = single_cat_title("", false); 
					$category_id = get_cat_ID($current_category); 
					$cat_posts = new WP_Query('showposts='.$number.'&cat='.$category_id); 
					while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID;?> 
  
								<?php if(has_post_thumbnail()): ?>
                                    
                                    <?php $thumb = get_post_thumbnail_id();?>
									<?php $image = wp_get_attachment_url($thumb, 'full'); ?>
									<?php $image_thumb = wp_get_attachment_url($thumb, 'full'); ?>
                                    
                                    <?php 
									$slider_size_post = csc_option('csc_slider_height_cat');
									$images = aq_resize($image, 660, $slider_size_post , true, true); //resize & retain image proportions (soft crop)?>
                                    <?php $images_thumb = aq_resize($image_thumb, 149, 100 , true, true); //resize & retain image proportions (soft crop)?>
                                    
  
    <li data-thumb="<?php echo $images_thumb; ?>">
    
    <div style="position:relative;">
      <a href="<?php if (get_post_meta($post->ID, "csc_project_urlss", true)) { print get_post_meta($post->ID, "csc_project_urlss", true);} else { the_permalink(); } ?>" title="<?php the_title(); ?>"><img src="<?php echo $images; ?>" alt="<?php the_title(); ?>" /></a>
     
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

<!-- slider end here -->

<?php endif;?>
<?php endif;?>

<?php endif;?>

<div class="span6">	

   
			<div class="row" id="col2cat">	
				<?php /* Start the Loop */ 
				$cat_layout = csc_option('csc_cat_lay');
				?>
				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php //get_template_part( '/'.$cat_layout.'content', get_post_format() ); ?>
                    <?php get_template_part( '/partials/content', get_post_format() ); ?>

				<?php endwhile; ?>
				
				<?php /* Display navigation to next/previous pages when applicable */ ?>
				<?php if (  $wp_query->max_num_pages > 1 ) : ?>
					<div class="navigation span6">
                 <?php if(function_exists('pagenavi')) { pagenavi(); } ?>
                </div>
                <div class="divider"></div>
				<?php endif; ?>
              </div>
             </div>


</div>
</div>
<?php wp_reset_query();?>

<?php if( csc_option('csc_sidebar_pos_cat') == 'left_right' ):?>

<div class="span3">

<div class="row">
<div class="span3">
<?php 
if (is_category()) {	
$category_id = get_query_var('cat') ;
$cat_sidebar = csc_option( 'csc_cat_2_'.$category_id ) ;
if( $cat_sidebar ){
dynamic_sidebar ( sanitize_title( $cat_sidebar ) ); 
}
else dynamic_sidebar("Sidebar Two");
}
?>
</div>
</div>

</div>
<?php endif; ?>

<?php wp_reset_query();?>

<?php if( !csc_option('csc_sidebar_pos_cat') || csc_option('csc_sidebar_pos_cat') == 'right'):?>

<div class="span3">

<div class="row">
<div class="span3">
<?php 
if (is_category()) {	
$category_id = get_query_var('cat') ;
$cat_sidebar = csc_option( 'csc_cat_'.$category_id ) ;
if( $cat_sidebar ){
dynamic_sidebar ( sanitize_title( $cat_sidebar ) ); 
}
else dynamic_sidebar("Sidebar One");
}
?>
</div>
</div>

</div>

<div class="span3">

<div class="row">
<div class="span3">
<?php 
if (is_category()) {	
$category_id = get_query_var('cat') ;
$cat_sidebar = csc_option( 'csc_cat_2_'.$category_id ) ;
if( $cat_sidebar ){
dynamic_sidebar ( sanitize_title( $cat_sidebar ) ); 
}
else dynamic_sidebar("Sidebar Two");
}
?>
</div>
</div>

</div>

<?php endif; ?>

<?php wp_reset_query();?>

<?php if (csc_option('csc_banner_footer')):?>

<div class="span12">
<?php 
		$csc_banner_footer_margin ='';
		if (csc_option('csc_banner_footer_margin')){ 
		 $csc_banner_footer_margin = 'margin-top:'.csc_option('csc_banner_footer_margin'); 
		}
		
		csc_banner('csc_banner_footer' , '<div style="text-align:center;'. $csc_banner_footer_margin .'">' , '</div>' ); 
		
		?>
</div>

<?php endif; ?>

</section>
</div>
</div>
		
<?php get_footer(); ?>