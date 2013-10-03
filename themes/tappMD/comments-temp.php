

<?php
	
	function csc_comment($comment, $args, $depth) {

    $isByAuthors = false;

    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthors = true;
    }

    $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     
     <div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
     
     <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
     
      <?php echo get_avatar($comment,$size='45'); ?>
      
      <div class="comment-author vcard">
         <?php printf(__('%s <i class="icon-comment-alt"></i>','csc-themewp'), get_comment_author_link()); ?> 
		 <?php if($isByAuthors) { ?><span class="author-tag"><?php _e('Author <i class="icon-certificate"></i>', 'csc-themewp'); ?></span><?php } ?>
      </div>

      <div class="comment-meta">
	  	<?php printf(__('%1$s', 'csc-themewp'), get_comment_date()); ?>
      </div>
      
      <div class="comment-inner">
      
	  	<?php if ($comment->comment_approved == '0') : ?>
         <em class="moderation"><?php _e('Your comment is awaiting moderation.', 'csc-themewp'); ?></em>
         <br />
      	<?php endif; ?>
  
   		<?php comment_text() ?>
        
      </div>
      
     </div>

<?php
}
?>
<?php if ( comments_open() ) : ?>
<div class="comments-wrapper span6" id="comments">
    <div class="row">
       <div class="span6" style="background:#E3E3E8;text-align:center;height: 1px;margin-top:20px; margin-bottom:20px;display:inline-block">
        <div class="row">
        <h4 style="background:#fff; display: inline; padding:0 15px; position:relative; top:-10px;font-weight:700; font-size:16px" >
		<?php 
		$num_comments = get_comments_number(); 	
		comments_number( __( 'No Comments', 'csc-themewp' ), __('One Comment', 'csc-themewp'), __('% Comments', 'csc-themewp') );
		?>
    	</h4>
        </div>
        </div>
        </div>
        
         <?php
		if ($num_comments != 0) { 
		?>
			<ul class="commentlist">
				<?php wp_list_comments( 'type=comment&callback=csc_comment' ); ?>
			</ul>
		<?php 
		} 
		?>
		<div class="clear"></div>
        <div class="blog-comment-pagination clearfix">	
		<?php paginate_comments_links( array('prev_text' => __('<span>&laquo;</span> Previous', 'csc-themewp'), 'next_text' => __('Next <span>&raquo;</span>', 'csc-themewp'))); ?>
	</div>
		     
        
<div id="respond" class="row">	  
<!-- Comment form
================================================== -->
<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<div class="span6">
<h4 id="respond-title">
<?php _e('You must be <a href="'.wp_login_url( get_permalink() ).'">logged in</a> to post a comment.', 'csc-themewp'); ?>
</h4>
</div> 
<?php else : ?>

 <div class="span6">
		<h4 id="respond-title">
			<?php comment_form_title( __('Leave a Comment', 'csc-themewp'), __('Leave a Comment to %s', 'csc-themewp') ); ?>
        </h4>
	
		<div class="cancel-comment-reply">
			<?php cancel_comment_reply_link(); ?>
		</div>
 </div> 

      <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        
        <?php if ( is_user_logged_in() ) : ?>
		<div class="span3">
			<p><?php printf(__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'csc-themewp'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'csc-themewp').'">', '</a>'); ?></p></div>
		
			<?php else : ?>
      
       <div class="span3">

        <label for="author"><?php _e('First Name', 'csc-themewp'); ?> <small><?php _e("<i class=\"icon-asterisk\"></i>", 'csc-themewp'); ?></small></label>
        <input type="text" class="span3 req-string required requiredField" placeholder="Type something…" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" tabindex="1">
        
        <label><?php _e('Last Name', 'csc-themewp'); ?> </label>
        <input type="text" class="span3 req-string" placeholder="Type something…" name="lname" id="lname">


        <label for="email"><?php _e('Email', 'csc-themewp'); ?> <small><?php _e("<i class=\"icon-asterisk\"></i>", 'csc-themewp'); ?></small></label>
        <input class=" span3 required requiredField email" placeholder="Type something…" type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" tabindex="2" >
        
        <label for="url"><?php _e('Website', 'csc-themewp'); ?></label>
        <input type="text"  class="span3" name="url" id="url" placeholder="Type something…" value="<?php echo esc_attr($comment_author_url); ?>" tabindex="3" />

        </div>
        
        <?php endif; ?>
        <div class="span6" style="position:relative;">

        <label><?php _e('Your message', 'csc-themewp'); ?> <small><?php _e("<i class=\"icon-asterisk\"></i>", 'csc-themewp'); ?></small></label>
        <textarea class="req-string" rows="5" name="comment" id="comment" style="width:96%; margin-bottom:20px;"></textarea>
        <button type="submit" class="button small" id="submit"><?php _e('Submit Comment', 'csc-themewp'); ?></button>

       </div>
       
       <?php comment_id_fields(); ?>
            

			<?php do_action('comment_form', $post->ID); ?>
            
            
      </form>

<?php endif; ?>
</div>

</div>	
 <?php else : 
	if ( ! comments_open() ) :
?>


       <div class="span6" style="background:#E3E3E8;text-align:center;height: 1px;margin-top:20px; margin-bottom:20px;display:inline-block">
        <div class="row">
        <h4 style="background:#fff; display: inline; padding:0 15px; position:relative; top:-10px;font-weight:700; font-size:16px" >
		<?php _e( 'Comments are closed.', 'csc-themewp' ); ?>
    	</h4>
        </div>
        </div>
   
    
	<?php endif; ?>
<?php endif; ?>