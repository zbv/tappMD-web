<?php if (csc_option('csc_scroll_hotnews')):?>
<script type="text/javascript">

 setTimeout(function() {
	
	jQuery('.hot_top_news').slideDown(1500);
		
	jQuery(function() {
		

	jQuery('#hot-news').carouFredSel({
		width: 1290,
		align: false,
		prev: '#prevNav',
		next: '#nextNav',
		items: {
			width: 'variable',
			<?php if (!csc_option('csc_hotnews_style')):?>
			height: 124,
			<?php  endif;?>
			<?php if (csc_option('csc_hotnews_style')):?>
			height: 260,
			<?php  endif;?>
			visible: 1
		},
		scroll: {
			delay: 1000,
			easing: 'linear',
			items: 1,
			duration: 0.5,
			pauseDuration: 0,
			pauseOnHover: 'immediate'
		}
	});
		
		
	});
 }, 1500);	
</script>

<?php  endif;?>

<div class="row">
<div class="span12" style=" <?php if (!csc_option('csc_hotnews_style') == 'big'):?> max-height:120px;<?php else:  ?>max-height:220px;<?php  endif;?> overflow:hidden;margin-bottom: -20px;">
 <div class="row hot-news" style="position:relative">
 <?php if (csc_option('csc_scroll_hotnews')):?>
  <a id="nextNav" class="nextNav" href="#"></a>
  <a id="prevNav" class="prevNav" href="#"></a> 
<?php  endif;?>
 
<?php if (csc_option('csc_scroll_hotnews')):?>
 <div id="hot-news" class="span12">
<?php  endif;?>

		<?php
			global $post;
	$reset_post = $post;
			

			$cat_hotnews = csc_option('csc_cat_hotnews');
			$num_hotnews = csc_option('csc_num_hotnews');
			$args=array('category__in' => $cat_hotnews,'posts_per_page'=> $num_hotnews);
			
			$hotnews_query = new wp_query( $args  );

			if( $hotnews_query->have_posts() ) : $count=0; ?>
                 
			
			<?php while( $hotnews_query->have_posts() ) : $hotnews_query->the_post();	$count++;?>
            
             
				<div class="span3 hot_top_news" style=" padding-top:10px; padding-bottom:10px;margin-top:30px; <?php if (csc_option('csc_scroll_hotnews')):?> margin-left:0; margin-right:30px;display:none<?php  endif;?>">
                
                <?php if (!csc_option('csc_hotnews_style')):?>
                
                <?php  if(has_post_thumbnail()): ?>
                       
                        <?php $thumb = get_post_thumbnail_id();?>
				        <?php $image = wp_get_attachment_url($thumb, 'full'); ?>
                        <?php $images = aq_resize($image, 70, 70 , true, true);?>
						
						<div style="margin-right:10px; float:left;margin-left:5px;">

				          <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' ><img src="<?php echo $images; ?>" alt="<?php the_title(); ?>" /></a>
                          
                       </div>
				<?php endif;?>
                
                <?php endif;?>
                
                <?php if (csc_option('csc_hotnews_style') == 'big'):?>
                
                <?php  if(has_post_thumbnail()): ?>
                       
                        <?php $thumb = get_post_thumbnail_id();?>
				        <?php $image = wp_get_attachment_url($thumb, 'full'); ?>
                        <?php $images = aq_resize($image, 300, 110 , true, true);?>
						
						<div style="float:left; margin-bottom:15px;">

				          <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' ><img src="<?php echo $images; ?>" alt="<?php the_title(); ?>" /></a>
                          
                       </div>
				<?php endif;?>
                
                <?php endif;?>

                <h3 class="post-title-small" style="margin-left:10px"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h3>
                                
					<h3 class="challenge-title"><a href='<?php the_permalink(); ?>' title='Take The Challenge <?php the_title(); ?>'><i class="icon-trophy"></i> Take The Challenge </a></h3>
				
			
              </div> 
               
			<?php endwhile;?>
         <?php endif; ?>
         
<?php if (csc_option('csc_scroll_hotnews')):?>
 </div>
<?php  
$post = $reset_post;
		    wp_reset_query();
endif;?>
    
</div>		
</div>
</div>