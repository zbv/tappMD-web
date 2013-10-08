<?php
/**
 * The default template for displaying content
 *
 */
?>

<article style="margin-top:0;" id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemprop="review" itemscope itemtype="http://schema.org/Review">
<div class="span6">

<div class="row">
<?php if (csc_option('csc_share_post_top')) : ?>
<?php if( !rwmb_meta( 'csc_hide_share_top')):?>
<div id="top_post_share">
<?php include CSC_BASE. 'share.php'; ?>
</div>
<?php	
endif;
endif;
?>
<script>
jQuery(document).ready(function($) {
jQuery("#disqus_thread").addClass("span6");
});
</script>

<div class="span6">

<?php if(has_post_thumbnail()): ?>

<?php $image_size_single_post = csc_option('csc_image_single_post_height');?>

<?php $thumb = get_post_thumbnail_id();?>
<?php $image = wp_get_attachment_url($thumb, 'full'); ?>
<?php $thumb = aq_resize($image, 630, $image_size_single_post , true, true); ?>

                <div class="row">
                 <div class="span6 post-img">
                  <a href="<?php echo $image ; ?>" rel="prettyPhoto" title="<?php the_title_attribute(); ?>" >
                    <img src="<?php echo $thumb; ?>" />
                    
                  </a>                 
                  </div>
                 </div>
<?php endif;?>

</div>


                        
                        

 <div class="span6 entry-info" style="margin-top:0px; margin-bottom:10px;"> 
            
 <!-- BEGIN POST META -->
&nbsp;&nbsp; <i class="icon-time"></i> <?php the_time('M j, Y'); ?>  	
                        <!-- Original Article Credits -->
                            <?php if ( get_post_meta($post->ID, 'og_author_uri', true) ) { ?>  
                        
                            <span>&nbsp;&nbsp; Written By: </span><a href="<?php echo get_post_meta($post->ID, 'og_author_uri', true); ?>" target="_blank" title="Author Bio for <?php echo get_post_meta($post->ID, 'og_author_text', true); ?>"><?php echo get_post_meta($post->ID, 'og_author_text', true); ?>&#44;&nbsp;</a>
                        
                            <?php } elseif ( get_post_meta($post->ID, 'og_author_text', true) ) { ?>   
                            
                            <span>&nbsp;&nbsp; Written By: </span><?php echo get_post_meta($post->ID, 'og_author_text', true); ?>&#44;&nbsp;
                            
                            <?php } else { }?>
                            
                            <?php if ( get_post_meta($post->ID, 'og_blog_uri', true) ) { ?>    
                            
                            <a href="<?php echo get_post_meta($post->ID, 'og_blog_uri', true); ?>" title="<?php the_title(); ?>, <?php echo get_post_meta($post->ID, 'og_blog_text', true); ?> " target="_blank"><?php echo get_post_meta($post->ID, 'og_blog_text', true); ?></a>
                            
                            <?php } elseif ( get_post_meta($post->ID, 'og_blog_text', true) ) { ?>
                            
                            <a href="#" title="<?php the_title(); ?>, <?php echo get_post_meta($post->ID, 'og_blog_text', true); ?> " target="_blank"><?php echo get_post_meta($post->ID, 'og_blog_text', true); ?></a>
                            
                            <?php } else { } ?>
                        <!-- /End Original Author Credits --> 	
                        
						<!-- Image Credit -->
                        <?php if ( get_post_meta($post->ID, 'og_image_uri', true) ) { ?>     
						<span style="float:right;">
                        Image Courtesy of: <a href="<?php echo get_post_meta($post->ID, 'og_image_uri', true); ?>" target="_blank" title="Original Image from <?php echo get_post_meta($post->ID, 'og_image_text', true); ?>"><?php echo get_post_meta($post->ID, 'og_image_text', true); ?></a></span>
                    
                    	<?php }?>
                        <!-- Image Credit -->
                        <br />
                                     
          <?php if ( 'post' == get_post_type() ) : ?>

				<?php twentyeleven_posted_on(); ?>
			
			<?php endif; ?>
            
            <?php if ( count( get_the_category() ) ) : ?>
			<?php printf( __( '%2$s', 'csc-themewp'), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
			<?php endif; ?>
            
        	<br />&nbsp;&nbsp; 
            
             			<?php $tags_list = get_the_tag_list( '', ', ' ); 
			if ( $tags_list ): ?>
			<?php printf( __( '<span class="%1$s"><i class="icon-tags"></i> </span> %2$s', 'csc-themewp' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
			<?php endif; ?> 
            <?php if ( comments_open() ) : ?>
			<span class="comments-link" style="margin:0 5px"> <i class="icon-comments"></i> <?php comments_popup_link( '<span class="%1$s"></span> 0', '<span class="%1$s"></span> 1', '<span class="%1$s"></span> %', 'comments-link', 'Comments are off for this post');; ?></span>
			<?php endif; // End if comments_open() ?>  
            <?php edit_post_link( __( 'Edit', 'csc-themewp' ), '<span class="edit-link" style="margin:0 5px">', '</span>' ); ?>
            



<?php if( rwmb_meta('csc_reviews_system') == 'percentage' && rwmb_meta('csc_reviews_act')):
			globalScore();
			global $totalscore;
            ?>
							
    <span class="p-rate"><i class="icon-trophy"></i> <?php echo $totalscore*10;?>%</span>							
<?php endif; ?>

<?php if( rwmb_meta('csc_reviews_system') == 'points' && rwmb_meta('csc_reviews_act')):
			globalScore();
			global $totalscore;
            ?>
							
	 <span class="p-rate"><i class="icon-trophy"></i> <?php echo $totalscore;?></span>							
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
   
</div>
 
<div class="span6">
 <header class="entry-header">
<h1 class="post-title entry-title" itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'csc-themewp' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
</h1>
                          
</header><!-- .entry-header -->
<div class="entry-content">



                        <?php 
						//we are using tapp-author-commentary.php from the plugin
						//remember to includ _wpb_ prefix for all custom fields
						if ( get_post_meta($post->ID, '_wpb_expert_feedback_text', true) ) { ?>     
  
                        <blockquote><p>
                        
						<?php $avatar = get_avatar( get_the_author_meta( 'user_email',$author->ID ), 80, '', get_the_author_meta( 'display_name', $author->ID ) ); ?>

						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php the_author_meta( 'display_name', $author->ID ); ?>" class="icon-4x pull-left icon-muted"><?php echo $avatar; ?></a>
						<small>Feedback from TappMD Expert<br /><strong><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></strong></small>
                         <strong><?php echo get_post_meta($post->ID, '_wpb_expert_heading_text', true); ?></strong><br />

						<?php echo get_post_meta($post->ID, '_wpb_expert_feedback_text', true); ?>
                        </p>
                        
                        </blockquote>

                    	<?php }?>
                        <!-- Expert Commentary -->	
                        
<?php if( rwmb_meta( 'csc_pos_reviews') == "top"):?>
<?php 
csc_include( 'reviews_top' ); 
?>
<?php endif; ?>


<?php
the_content();
?>

<?php if ( get_post_meta($post->ID, 'og_blog_uri', true) ) { ?> 
<span style="float:right;">   
                            
                           <strong><a href="<?php echo get_post_meta($post->ID, 'og_blog_uri', true); ?>" title="<?php the_title(); ?>, <?php echo get_post_meta($post->ID, 'og_blog_text', true); ?> " target="_blank">TAPP to read more. <i class="icon-circle-arrow-right"></i></a></strong> 
</span>                          
                            
                            <?php } ?>

</div><!-- .entry-content -->

</div>
<div class="navigation span6">
<style>
.pagenavi span {padding: 5px 10px 6px 10px;font-size: 12px;line-height: 12px; border:1px #e8e8e3 solid;}
.pagenavi a > span { margin-right:0px; margin-left:0px; padding:0; border:none !important;}
</style>
<?php 
$args = array(
 'before'           => '<div class="pagenavi">' . __('Pages : &nbsp;', 'csc-themewp'),
 'after'            => '</div>',
 'link_before'      => '<span>',
 'link_after'       => '</span>',
 'next_or_number'   => 'number',
 'pagelink'         => '%',
 'echo'             => 1 ); 

wp_link_pages( $args );
?>


</div>
<?php if( rwmb_meta( 'csc_pos_reviews') == "bottom"):?>
<?php 
csc_include( 'reviews' ); 
?>
<?php endif; ?>

</div>
</div>
<?php if( !rwmb_meta( 'csc_hide_share')):?>

<?php include CSC_BASE. 'share.php'; ?>

<?php	
endif;
?>

<?php if( !rwmb_meta( 'csc_hide_author') && !csc_option('csc_hide_author2')):?>
<div class="divider" style="margin:0;"></div>
<?php 
echo blog_author('blog_author_info');
?>
<style>
.author > ul.socicon-2 li{ margin-left:3px !important;}
</style>
<div id="author-share" class="span6 author" style="margin-top:0; background:none;padding-top:0 !important;">
<ul class="socicon-2 pull-right" style="margin-top:0; background:none;padding-top:0 !important;">
            <?php if (get_the_author_meta('twitter')) { ?>
            <li>
            <a href="<?php echo get_the_author_meta('twitter'); ?>" class="soc-follow twitter"  title="<?php echo get_the_author_meta('display_name') ?> on twitter"></a></li>
            <?php } else { ?>
            <?php } ?>
            
            <?php if (get_the_author_meta('facebook')) { ?>
            <li><a href="<?php echo get_the_author_meta('facebook'); ?>" class="soc-follow facebook"  title="<?php echo get_the_author_meta('display_name') ?> on facebook"></a></li>
            <?php } else { ?>
            <?php } ?>

            
            <?php if (get_the_author_meta('pinterest')) { ?>
            <li><a href="<?php echo get_the_author_meta('pinterest'); ?>" class="soc-follow pinterest" title="pinterest"></a></li>
            <?php } else { ?>
            <?php } ?>

            
            <?php if (get_the_author_meta('google')) { ?>
            <li><a href="<?php echo get_the_author_meta('google'); ?>" class="soc-follow googleplus" title="<?php echo get_the_author_meta('display_name') ?> on google plus"></a></li>
            <?php } else { ?>
            <?php } ?>
         
            <?php if (get_the_author_meta('linkedin')) { ?>
            <li><a href="<?php echo get_the_author_meta('linkedin'); ?>" class="soc-follow linkedin"  title="<?php echo get_the_author_meta('display_name') ?> on linkedin"></a></li>
            <?php } else { ?>
            <?php } ?>
            
            <?php if (get_the_author_meta('vimeo')) { ?>
            <li><a href="<?php echo get_the_author_meta('vimeo'); ?>" class="soc-follow vimeo"  title="<?php echo get_the_author_meta('display_name') ?> vimeo"></a></li>
            <?php } else { ?>
            <?php } ?>
            
            <?php if (get_the_author_meta('youtube')) { ?>
            <li><a href="<?php echo get_the_author_meta('youtube'); ?>" class="soc-follow youtube" title="<?php echo get_the_author_meta('display_name') ?> on youtube" ></a></li>
            <?php } else { ?>
            <?php } ?>
            
             <?php if (get_the_author_meta('feedburner')) { ?>
			<li><a href="<?php echo get_the_author_meta('feedburner'); ?>" class="soc-follow rss"  title="<?php echo get_the_author_meta('display_name') ?> rss" target="_blank"></a></li>
			<?php } ?>
                       
</ul>
</div>

<?php	
endif;
?>

<?php if( !csc_option('csc_hide_prev_next')):?>

<div class="divider-post span6" style="margin-bottom:0px;"></div>
<style>
ul.control-menu { margin:0px; margin-bottom:0px; margin-top:20px;}
ul.control-menu li{ max-width:50%}
ul.control-menu li a{ background: none !important; border:none !important; font-weight:700; font-size:15px; color:#868585 !important;}
ul.control-menu li a:hover{background: none;border:none;}
ul.control-menu .prev{ text-align:left; float:left; }
ul.control-menu .next{ text-align: right; float:right;}
ul.control-menu li.prev a { text-align:left; padding:0; }
ul.control-menu li.next a { text-align: right; padding:0; }
ul.control-menu li.prev a span{ font-weight:400; display:block; text-align:left;font-size:12px; margin-top:5px; color:#999999}
ul.control-menu li.next a span{ font-weight:400; display:block; text-align: right; font-size:12px; margin-top:5px;color:#999999}
</style>

<ul class="control-menu span6">
     <li class="prev"><?php be_next_post_link("%link", "<i class=\"icon-arrow-left\"></i> Prev <span>%title</span>", '', "", '') ?></li>
     <li class="next"><?php be_previous_post_link("%link", "Next <i class=\"icon-arrow-right\"></i> <span>%title</span>", '', "", '') ?></li>		
</ul> 

<?php	
endif;
?>

<?php if( !rwmb_meta( 'csc_hide_related')):?>

<?php 
if( csc_option('csc_related') ){
csc_include( 'related' ); 
}
?>

<?php	
endif;
?>
<?php if (rwmb_meta('csc_banner_bottom2_post')):?>

<div class="span6">

<?php 
		$csc_banner_bottom2_margin ='';
		if (rwmb_meta('csc_banner_bottom2_post_margin')){ 
		 $csc_banner_bottom2_margin = 'margin-top:'.rwmb_meta('csc_banner_bottom2_post_margin'); 
		}
		
		csc_banner_post('csc_banner_bottom2_post' , '<div style="text-align:center;'. $csc_banner_bottom2_margin .'">' , '</div>' ); 
		
		?>

</div>

<?php endif;?>
<div class="divider" style="margin-top:5px;"></div>
</article><!-- #post-<?php the_ID(); ?> -->
