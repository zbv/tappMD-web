<?php if (csc_option('csc_share_port')) { ?>

<div class="row">

<div class="share span4" id="share_port" style="margin-top:0;">
<h3 style="margin-left:0; margin-top:6px">Share:</h3>

<ul class="socicon-2 right">

            <li><a href="http://www.twitter.com/share?url=<?php echo get_permalink(); ?>" class="soc-follow twitter"  title="twitter" target="_blank"></a></li>
            
            <li><a href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>&amp;t=<?php echo get_the_title(); ?>" class="soc-follow facebook"  title="facebook" target="_blank"></a></li>
          
            <?php $thumb = get_post_thumbnail_id();?>
<?php $image = wp_get_attachment_url($thumb, 'full'); ?>
<?php $thumb = aq_resize($image, 500, 500 , true, true); ?>

    
		    <li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo $thumb?>" class="soc-follow pinterest" target="_blank"></a></li>
          
            <li><a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo get_permalink(); ?>&amp;title=<?php echo get_the_title(); ?>" class="soc-follow linkedin"  title="linkedin" target="_blank"></a></li>
            
            <li><a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>&amp;title=<?php echo get_the_title(); ?>" class="soc-follow googleplus" title="googleplus" target="_blank"></a></li>
       
            
            <li><a href="http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink()) ?>&name=<?php echo urlencode(get_the_title()) ?>&description=<?php remove_filter ('the_excerpt', 'wpautop');  echo urlencode(the_excerpt()) ?>" class="soc-follow tumblr"  target="_blank"></a></li>
            
            
            
            </ul>

  </div> 
  </div>   
<?php } else { ?>
<?php } ?>