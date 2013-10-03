<?php
/*
Template Name: Page Fullwidth
*/
get_header(); ?>
<div class="container slider-cont"> 
  <div class="row">

  <?php if( !rwmb_meta( 'csc_hide_above')):?>

<?php if (rwmb_meta('csc_banner_top_page')):?>

<div class="span12">

<?php 
		$csc_banner_top_margin ='';
		if (rwmb_meta('csc_banner_top_page_margin')){ 
		 $csc_banner_top_margin = 'margin-top:'.rwmb_meta('csc_banner_top_page_margin'); 
		}
		
		csc_banner_post('csc_banner_top_page' , '<div style="text-align:center;'. $csc_banner_top_margin .'">' , '</div>' ); 
		
		?>

</div>
<?php elseif (csc_option('csc_banner_page')):?>

<div class="span12">

<?php 
		$csc_banner_top_margin ='';
		if (csc_option('csc_banner_page_margin')){ 
		 $csc_banner_top_margin = 'margin-top:'.csc_option('csc_banner_page_margin'); 
		}
		
		csc_banner('csc_banner_page' , '<div style="text-align:center;'. $csc_banner_top_margin .'">' , '</div>' ); 
		
		?>

</div>

<?php else : ?>
<?php endif; ?>

<?php endif; ?>

          

					<?php get_template_part( '/partials/content','page-full' ); ?>

		


		
<?php get_footer(); ?>