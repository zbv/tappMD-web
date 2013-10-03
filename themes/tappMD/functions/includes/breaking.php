<script type="text/javascript">

 setTimeout(function() {

 jQuery('.breaking-roll li').show();
 
 jQuery(function() {
		

	jQuery('.breaking-roll').carouFredSel({
		width: 1290,
		align: false,
		items: {
			width: 'variable',
			height: 30,
			visible: 1
		},
		scroll: {
			delay: 1000,
			easing: 'linear',
			items: 1,
			duration: 0.07,
			pauseDuration: 0,
			pauseOnHover: 'immediate'
		}
	});
		
		
	});	 
	 
 }, 2500);
		
	

	
</script>
<div class="row">
<div class="span12 breaking" style="position:relative; margin-top:10px; max-height:30px; overflow:hidden">
 <div class="row">
		<div class="breaking-title span2" style="padding:5px 0; color:#FFF;font-size:13px; text-align:center; font-weight:400;"><?php  echo csc_option('csc_title_break') ?></div>
        <div class="span10" style="margin-left:0;overflow:hidden !important">
        <ul class="breaking-roll" style="overflow:hidden">
        
		<?php
			global $post;
	$reset_post = $post;

			$cat_break = csc_option('csc_cat_break');
			$num_break = csc_option('csc_num_break');
			$args=array('category__in' => $cat_break,'posts_per_page'=> $num_break);
			
			$breaking_query = new wp_query( $args  );

			if( $breaking_query->have_posts() ) : $count=0; ?>
                 
			
			<?php while( $breaking_query->have_posts() ) : $breaking_query->the_post();	$count++;?>
            
             
				<li style="display:none">

                <a href="<?php the_permalink()?>" title="<?php the_title(); ?>" style="font-weight:400"><?php echo the_title(); ?></a>    
                       
                <span style="margin-left:5px; font-style:italic; font-size:11px; color:#999999"><?php the_time('g : i a'); ?></span>
                
                  <?php if( rwmb_meta('csc_reviews_system') == 'percentage' && rwmb_meta('csc_reviews_act')):
			globalScore();
			global $totalscore;
            ?>
							
    <span class="p-rate" style="margin-left:5px; font-style:italic; font-size:11px; color:#999999"><i class="icon-trophy"></i> <?php echo $totalscore*10;?>%</span>							
<?php endif; ?>

<?php if( rwmb_meta('csc_reviews_system') == 'points' && rwmb_meta('csc_reviews_act')):
			globalScore();
			global $totalscore;
            ?>
							
	 <span class="p-rate" style="margin-left:5px; font-style:italic; font-size:11px; color:#999999"><i class="icon-trophy"></i> <?php echo $totalscore;?></span>							
<?php endif; ?> 
<?php
			if( rwmb_meta('csc_reviews_system') == 'stars' && rwmb_meta('csc_reviews_act')):
			globalScore();
			global $totalscore;
			$starscore = $totalscore / 2;
            $starscore = round($starscore/.5)*.5;
            ?>
            <span class="stars-rate" style="background:none !important;"><img src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo $starscore ?>.png" alt="" style=" margin-left:5px;margin-top:-5px !important;" /></span>
            
			<?php endif; ?>   
								
                </li>
			<?php endwhile;?>
			
		<?php 
		$post = $reset_post;
		    wp_reset_query();
		endif; ?>
        </ul>
   
        </div>
        <?php $category_link = get_category_link( $cat_break );?>  
             <a class="all_break" href="<?php echo $category_link ;?>">&rarr;</a> 
</div>		
</div>
</div>