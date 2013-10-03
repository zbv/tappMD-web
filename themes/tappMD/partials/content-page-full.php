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

 <?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="span12">
<?php
the_content();
?>
	</div><!-- .entry-content -->

		<?php edit_post_link( __( 'Edit', 'csc-themewp' ), '<span class="edit-link">', '</span>' ); ?>
    
</article><!-- #post-<?php the_ID(); ?> -->
<?php endwhile; // end of the loop. ?>

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