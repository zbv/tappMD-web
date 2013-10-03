<?php
/**
 * The template used for displaying page content in page.php
 */
?>


<div class="span12">
<div class="row">


<section>

<div class="span12" id="blog_page">
<div class="row">
<?php if (csc_option('csc_breadcrumbs')):?>
<div class="span12">
      <?php csc_include( 'breadcrumbs' ); ?>
</div>
<?php endif;?>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
		
		<article id="sitemap-list" style="margin-top:0">
        <div class="span12">
        
				<div class="row">
					
<?php $argsp = array(
	'title_li'     => '',
	'link_before'  => '<i class="icon-file" style="margin-right:7px;"></i>',
); ?>
						<div class="span3">
							<h2><?php _e('Pages','csc-themewp'); ?></h2>
							<ul style="margin-left:0px;"><?php wp_list_pages($argsp); ?></ul>
						</div> 

<?php $argsc = array(
	'title_li'     => '',
); ?>
							
						<div class="span3">
							<h2><?php _e('Categories','csc-themewp'); ?></h2>
							<ul id="map-cat" style="margin-left:0px;"><?php wp_list_categories($argsc); ?></ul>
						</div> 
							
						<div class="span3">
							<h2><?php _e('Tags','csc-themewp'); ?></h2>
							<ul style="margin-left:0px;">
								<?php $tags = get_tags();
								if ($tags) {
									foreach ($tags as $tag) {
										echo '<li><a href="' . get_tag_link( $tag->term_id ) . '"><i class="icon-tag" style="margin-right:7px;"></i>' . $tag->name . '</a></li> ';
									}
								} ?>
							</ul>
						</div> 
														
						<div class="span3">
							<h2><?php _e('Authors','csc-themewp'); ?></h2>
							<ul id="map-aut" style="margin-left:0px;"><?php wp_list_authors('optioncount=1&exclude_admin=0'); ?></ul>
						</div>
					
						
					<?php edit_post_link( __( 'Edit', 'csc-themewp' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
			
          
          </div>  
		</article>
		<?php endwhile; ?>







</div>
</div>

<?php if( !rwmb_meta( 'csc_hide_below')):?>

<?php if (rwmb_meta('csc_banner_bottom_page')):?>

<div class="span12">
<?php 
		$csc_banner_top_margin ='';
		if (rwmb_meta('csc_banner_bottom_page_margin')){ 
		 $csc_banner_top_margin = 'margin-top:'.rwmb_meta('csc_banner_bottom_page_margin'); 
		}
		
		csc_banner_post('csc_banner_bottom_page' , '<div style="text-align:center;'. $csc_banner_top_margin .'">' , '</div>' ); 
		
		?>
</div>
<?php elseif (csc_option('csc_banner_footer')):?>

<div class="span12">
<?php 
		$csc_banner_footer_margin ='';
		if (csc_option('csc_banner_footer_margin')){ 
		 $csc_banner_footer_margin = 'margin-top:'.csc_option('csc_banner_footer_margin'); 
		}
		
		csc_banner('csc_banner_footer' , '<div style="text-align:center;'. $csc_banner_footer_margin .'">' , '</div>' ); 
		
		?>
</div>

<?php else : ?>
<?php endif; ?>

<?php endif; ?>

</section>
</div>
</div>