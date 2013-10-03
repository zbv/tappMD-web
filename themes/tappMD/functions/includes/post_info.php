<i class="icon-time"></i> <?php the_time('M j, Y'); ?>             
          <?php if ( 'post' == get_post_type() ) : ?>

				<?php twentyeleven_posted_on(); ?>
			
			<?php endif; ?>
            
            <?php if ( count( get_the_category() ) ) : ?>
			<?php printf( __( '%2$s', 'csc-themewp'), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
			<?php endif; ?>
            
        	<br />
            
             			<?php $tags_list = get_the_tag_list( '', ', ' ); 
			if ( $tags_list ): ?>
			<?php printf( __( '<span class="%1$s"><i class="icon-tags"></i> </span> %2$s', 'csc-themewp' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
			<?php endif; ?> 
            <?php if ( comments_open() ) : ?>
			<span class="comments-link" style="margin:0 5px"> <i class="icon-comments"></i> <?php comments_popup_link( '<span class="%1$s"></span> 0', '<span class="%1$s"></span> 1', '<span class="%1$s"></span> %', 'comments-link', 'Comments are off for this post');; ?></span>
			<?php endif; // End if comments_open() ?>  
            <?php edit_post_link( __( 'Edit', 'csc-themewp' ), '<span class="edit-link" style="margin:0 5px">', '</span>' ); ?>