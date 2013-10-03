<div class="span12" style="margin-bottom:20px;">

<div class="row">			
<?php 
wp_reset_query();
global $post;
	$reset_post = $post;
            $categorys = get_post_meta(get_the_ID(), 'csc_mag_st_page', true);
			$recent_posts = new WP_Query('showposts=7&cat='.$categorys); 



			$count = 1; 
			while($recent_posts->have_posts()): $recent_posts->the_post();
			
			 ?>
            
                <?php if($count == 1): ?>
                
				<div class="span6 stb_l">
                
                <?php  if(has_post_thumbnail()): ?>
                       
                        <?php $thumb = get_post_thumbnail_id();?>
				        <?php $image = wp_get_attachment_url($thumb, 'full'); ?>
                        <?php $images = aq_resize($image, 630, 381 , true, true);?>
						

				          <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' ><img class="hov-anim" src="<?php echo $images; ?>" alt="<?php the_title(); ?>" /></a>
                          

                <?php endif;?>

                <h3 class="caption-static"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h3> 
                
              </div> 
              
              <?php else: ?>
             
              <div class="span2 stb_r">
                
                <?php  if(has_post_thumbnail()): ?>
                       
                        <?php $thumb = get_post_thumbnail_id();?>
				        <?php $image = wp_get_attachment_url($thumb, 'full'); ?>
                        <?php $images = aq_resize($image, 219, 190 , true, true);?>
						

				          <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' ><img class="hov-anim" src="<?php echo $images; ?>" alt="<?php the_title(); ?>" /></a>
                          

                <?php endif;?>
                
                <h3 class="caption-static smalls"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h3>
                
              </div> 
              
              <?php endif; ?>
              
               
			<?php $count++;endwhile;
			$post = $reset_post;
		    wp_reset_query();
			?>
            
</div>
</div>
			