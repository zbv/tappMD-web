<?php
get_header();
?>
<div class="container slider-cont"> 
  <div class="row">
  
 <?php if (csc_option('csc_banner_page')):?>

<div class="span12">

<?php 
		$csc_banner_top_margin ='';
		if (csc_option('csc_banner_page_margin')){ 
		 $csc_banner_top_margin = 'margin-top:'.csc_option('csc_banner_page_margin'); 
		}
		
		csc_banner('csc_banner_page' , '<div style="text-align:center;'. $csc_banner_top_margin .'">' , '</div>' ); 
		
		?>

</div>

<?php endif; ?> 

<!-- Page Title -->
<div class="span12">
<header id="pagehead">
<?php the_post(); ?>


					<h1 class="page-title">
						<?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily Archives : <span>%s</span>' , 'csc-themewp'), get_the_date() ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly Archives : <span>%s</span>' , 'csc-themewp'), get_the_date( 'F Y' ) ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly Archives : <span>%s</span>', 'csc-themewp' ), get_the_date( 'Y' ) ); ?>
						<?php else : ?>
							<?php _e( 'Blog Archives',  'csc-themewp' ); ?>
						<?php endif; ?>
					</h1>


				<?php rewind_posts(); ?>

</header>
</div>




<div class="span12">
<div class="row">
<section>

<?php wp_reset_query();?>

<?php if( csc_option('csc_sidebar_pos_arc') == 'left_right' ):?>

<div class="span3">

<div class="row">
<div class="span3">
<?php 
$sidebar_archive = csc_option( 'csc_sidebar_archive') ;
if( $sidebar_archive ){
dynamic_sidebar ( sanitize_title( $sidebar_archive ) ); 
}
else dynamic_sidebar("Sidebar One");
?>
</div>
</div>

</div>
<?php endif; ?>

<?php wp_reset_query();?>

<?php if( csc_option('csc_sidebar_pos_arc') == 'left'):?>

<div class="span3">

<div class="row">
<div class="span3">
<?php 
$sidebar_archive = csc_option( 'csc_sidebar_archive') ;
if( $sidebar_archive ){
dynamic_sidebar ( sanitize_title( $sidebar_archive ) ); 
}
else dynamic_sidebar("Sidebar One");
?>
</div>
</div>

</div>

<div class="span3">

<div class="row">
<div class="span3">
<?php 
$sidebar_archive2 = csc_option( 'csc_sidebar_archive2') ;
if( $sidebar_archive2 ){
dynamic_sidebar ( sanitize_title( $sidebar_archive2 ) ); 
}
else dynamic_sidebar("Sidebar Two");
?>
</div>
</div>

</div>

<?php endif; ?>

<?php wp_reset_query();?>

<div class="span6" id="blog_page">

<?php if (csc_option('csc_breadcrumbs')):?>
<div class="row">
<div class="span6">
      <?php csc_include( 'breadcrumbs' ); ?>
</div>
</div>
<?php endif;?>

<div class="row" id="col2cat">



				
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php get_template_part( '/partials/content', get_post_format() ); ?>

				<?php endwhile; ?>
				
				<?php /* Display navigation to next/previous pages when applicable */ ?>
				<?php if (  $wp_query->max_num_pages > 1 ) : ?>
					<div class="navigation span6">
                 <?php if(function_exists('pagenavi')) { pagenavi(); } ?>
                </div>
                <div class="divider"></div>
				<?php endif; ?>


</div>
</div>

<?php wp_reset_query();?>

<?php if( csc_option('csc_sidebar_pos_arc') == 'left_right' ):?>

<div class="span3">

<div class="row">
<div class="span3">
<?php 
$sidebar_archive2 = csc_option( 'csc_sidebar_archive2') ;
if( $sidebar_archive2 ){
dynamic_sidebar ( sanitize_title( $sidebar_archive2 ) ); 
}
else dynamic_sidebar("Sidebar Two");
?>
</div>
</div>

</div>
<?php endif; ?>

<?php wp_reset_query();?>

<?php if( !csc_option('csc_sidebar_pos_arc') || csc_option('csc_sidebar_pos_arc') == 'right'):?>

<div class="span3">

<div class="row">
<div class="span3">
<?php 
$sidebar_archive = csc_option( 'csc_sidebar_archive') ;
if( $sidebar_archive ){
dynamic_sidebar ( sanitize_title( $sidebar_archive ) ); 
}
else dynamic_sidebar("Sidebar One");
?>
</div>
</div>

</div>

<div class="span3">

<div class="row">
<div class="span3">
<?php 
$sidebar_archive2 = csc_option( 'csc_sidebar_archive2') ;
if( $sidebar_archive2 ){
dynamic_sidebar ( sanitize_title( $sidebar_archive2 ) ); 
}
else dynamic_sidebar("Sidebar Two");
?>
</div>
</div>

</div>

<?php endif; ?>

<?php wp_reset_query();?>

<?php if (csc_option('csc_banner_footer')):?>

<div class="span12">
<?php 
		$csc_banner_footer_margin ='';
		if (csc_option('csc_banner_footer_margin')){ 
		 $csc_banner_footer_margin = 'margin-top:'.csc_option('csc_banner_footer_margin'); 
		}
		
		csc_banner('csc_banner_footer' , '<div style="text-align:center;'. $csc_banner_footer_margin .'">' , '</div>' ); 
		
		?>
</div>

<?php endif; ?>

</section>
</div>
</div>
		
<?php get_footer(); ?>