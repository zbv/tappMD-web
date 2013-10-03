<?php
global $post;

if( csc_option('csc_related') ): $related_no = csc_option('csc_related_number') ? csc_option('csc_related_number') : 3;
	
	global $post;

	
	$query_type = csc_option('csc_related_query') ;
	
	if( $query_type == 'author' ){
		$args=array('post__not_in' => array($post->ID),'posts_per_page'=> $related_no , 'author'=> get_the_author_meta( 'ID' ));
	}elseif( $query_type == 'tag' ){
		$tags = wp_get_post_tags($post->ID);
		$tags_ids = array();
		foreach($tags as $individual_tag) $tags_ids[] = $individual_tag->term_id;
		$args=array('post__not_in' => array($post->ID),'posts_per_page'=> $related_no , 'tag__in'=> $tags_ids );
	}
	else{
		$categories = get_the_category($post->ID);
		$category_ids = array();
		foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
		$args=array('post__not_in' => array($post->ID),'posts_per_page'=> $related_no , 'category__in'=> $category_ids );
	}		
	$related_query = new wp_query( $args );
	if( $related_query->have_posts() ) : $count=0;?>
    
	<div class="span6">
        
        <div class="widget-title" style="margin-top:20px;">
          <h3><?php _e( 'Related Posts' , 'csc-themewp' ); ?></h3>
        </div>
        
        
		<div class="row">
			<?php while ( $related_query->have_posts() ) : $related_query->the_post()?>
             <div class="span2" style="margin-bottom:15px">
				<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>		
                	
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php $thumb = get_post_thumbnail_id();?>
                        <?php $image = wp_get_attachment_url($thumb, 'full'); ?>
                        <?php $thumb = aq_resize($image, 190, 80 , true, true); ?>

                    <img src="<?php echo $thumb; ?>" style="margin-bottom:10px" />
                  </a>

				<?php endif; ?>	
                <header class="entry-header"><h2 class="post-title-small"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2></header>		
 
              </div>
			<?php endwhile;?>

		</div>
        
  </div>
	<?php	endif;

	wp_reset_query();
endif; ?>