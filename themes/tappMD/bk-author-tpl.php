<?php

	get_header();

?>

<?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));?>

<div class="container_main">

	<div class="content_wrapper">

		<div class="column column3">

			<div class="content_item">

				<div class="wrapper">

					<div class="post_type standard">

						<h2 class="post_title">
                        
	<?php $curauthcreds=$curauth->certifications; ?>
		<?php if (!empty($curauthcreds)) { ?>
			<?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?>,  					<?php echo $curauthcreds; ?>
    	<?php } else {?>
    		<?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?>
		<?php } ?>                            

						</h2>
                        
     <div class="sideauthor">
    <?php echo get_avatar( $curauth->user_email, 80 ); ?>
    </div>
<ul class="author_social_networks">

	<?php if (!empty($curauth->google_plus)) {?>
	<li class="gplus"><a href="<?php echo $curauth->google_plus; ?>" rel="external nofollow me" target="_blank" title="Add <?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?> on Google Plus">GooglePlus</a></li>
	<?php }?>
    <?php if (!empty($curauth->facebook)) {?>
	<li class="facebook"><a href="<?php echo $curauth->facebook; ?>" rel="external nofollow" title="Like <?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?> on Facebook" target="_blank">Facebook</a></li>
	<?php }?>
    <?php if (!empty($curauth->twitter)) {?>
	<li class="twitter"><a href="https://twitter.com/<?php echo $curauth->twitter; ?>" rel="external nofollow" title="Follow <?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?> on Twitter" target="_blank">Twitter</a></li>
	<?php }?>
    <?php if (!empty($curauth->linkedIn)) {?>
	<li class="linkedin"><a href="<?php echo $curauth->linkedIn; ?>" rel="external nofollow"  title="Connect with <?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?>  on LinkedIN" target="_blank">LinkedIn</a></li>
	<?php }?>
    <?php if (!empty($curauth->youtube)) {?>    
    <li class="youtube"><a href="<?php echo $curauth->youtube; ?>" rel="external nofollow" title="Watch <?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?>'s posts on Youtube" target="_blank">YouTube</a></li>
    <?php }?>
 </ul> 
 <div class="clear"></div>
 </div></div></div>
 <div class="content_item">

				<div class="wrapper">

					<div class="post_type standard">
<h2 class="post_title">

About <?php echo $curauth->first_name; ?>

</h2>
<p>
	<?php echo $curauth->user_description; ?><br />  

</p>

<p>
<?php 	$userblog = get_active_blog_for_user( $curauth->ID );
		$userblog_url = $userblog->siteurl; ?>
						<div class="clear"></div>

				</div>
                </div>

			</div>

			<?php if (have_posts()) :  ?>
			   <?php while (have_posts()) : the_post(); ?>	
					

			<div class="content_item">

				<div class="wrapper">

					

					<div class="post_type standard">

						<h2 class="post_title">

							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>

						</h2>

						<div class="post_detail">

<span><?php _e('Category:', 'kleitheme'); ?></span> <?php echo get_the_category_list( ', ' ); ?>       <span><?php _e('Published on', 'kleitheme'); ?></span> <?php echo date('d M, Y', strtotime($post->post_date)); ?>

<br><?php the_tags(__('Tags: ', 'kleitheme'), ', ', ' '); ?>.

						</div>

						<?php 
		echo '<a href="'.get_permalink($post->ID).'" class="author_post_thumbnail">';				
		if( has_post_thumbnail() ){
			the_post_thumbnail(array(80,80),array('class'=>'author_post_thumbnail'));						}
		else{								
		echo '<img src="/wp-content/themes/coloredgrid_main/coloredgrid/resources/images/naturemade-gravatar.jpg" class="author_post_thumbnail"/>';							

			}	
			echo '</a>';
						?>


			<?php the_excerpt(); ?>


			<div class="readmore">

				<a href="<?php the_permalink(); ?>"><?php _e('Read more', 'kleitheme'); ?></a>

			</div>

						<div class="clear"></div>

					</div>

					

				</div>

			</div>
            

			<?php endwhile; ?>

			<?php endif; ?>

			<div class="content_item">

				<div class="pagination_container">

					<?php

			            pagination();

			        ?>

				</div>

			</div>

			

			<div style="display: none;">

				<?php next_posts_link(); ?>

				<?php previous_posts_link(); ?>

			</div>

			

		</div>
<?php get_sidebar(); ?>

		

	</div>

</div>



<div id="paginate_div" style="display: none;"></div>

</div>

<?php

	get_footer();

?>
