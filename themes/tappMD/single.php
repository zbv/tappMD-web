<?php
/*
*/
get_header();
wp_reset_query();
global $root; 
?>

<div class="container slider-cont"> 
  <div class="row">


<?php if (rwmb_meta('csc_banner_top_post')):?>

<div class="span12">

<?php 
		$csc_banner_top_margin ='';
		if (rwmb_meta('csc_banner_top_post_margin')){ 
		 $csc_banner_top_margin = 'margin-top:'.rwmb_meta('csc_banner_top_post_margin'); 
		}
		
		csc_banner_post('csc_banner_top_post' , '<div style="text-align:center;'. $csc_banner_top_margin .'">' , '</div>' ); 
		
		?>

</div>

<?php endif;?>


<div class="span12">
<div class="row">
<section>

<?php wp_reset_query();
///////////////////left right///////////////////
?>

<?php if( rwmb_meta( 'csc_sel_side_pos') != 'left' && rwmb_meta( 'csc_sel_side_pos') != 'right'):?>
<?php if( rwmb_meta( 'csc_sel_side_pos') == 'left_right' || csc_option('csc_sidebar_pos_single') == 'left_right' ):?>
<div class="span3">
<?php $name = get_post_meta($post->ID, 'sbg_selected_sidebar', true);?>
<div class="row">
<div class="span3">
<?php if (!empty($name[0])):?>
<?php dynamic_sidebar($name[0]);?>
<?php
elseif (csc_option('csc_def_spost_side')): ?>
<?php $side_default = csc_option('csc_def_spost_side');?>
<?php dynamic_sidebar('"'.$side_default.'"'); ?>
<?php 
else :
dynamic_sidebar("Sidebar One");?>
<?php endif; ?>
</div>
</div>
</div>
<?php endif; ?>
<?php endif; ?>

<?php wp_reset_query();
///////////////////left///////////////////
?>

<?php if( rwmb_meta( 'csc_sel_side_pos') != 'left_right' && rwmb_meta( 'csc_sel_side_pos') != 'right' ):?>
<?php if( csc_option('csc_sidebar_pos_single') == 'left' || rwmb_meta( 'csc_sel_side_pos') == 'left'):?>

<div class="span3">
<?php $name = get_post_meta($post->ID, 'sbg_selected_sidebar', true);?>
<div class="row">
<div class="span3">
<?php if (!empty($name[0])):?>
<?php dynamic_sidebar($name[0]);?>
<?php
elseif (csc_option('csc_def_spost_side')): ?>
<?php $side_default = csc_option('csc_def_spost_side');?>
<?php dynamic_sidebar('"'.$side_default.'"'); ?>
<?php 
else :
dynamic_sidebar("Sidebar One");?>
<?php endif; ?>
</div>
</div>
</div>
<?php wp_reset_query();?>
<div class="span3">
<?php $name2 = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement', true);?>
<div class="row">
<div class="span3">
<?php if (!empty($name2[0])):?>
<?php dynamic_sidebar($name2[0]);?>
<?php
elseif (csc_option('csc_def_spost_side2')): ?>
<?php $side_default2 = csc_option('csc_def_spost_side2');?>
<?php dynamic_sidebar('"'.$side_default2.'"'); ?>
<?php 
else :
dynamic_sidebar("Sidebar Two");?>
<?php endif; ?>
</div>
</div>
</div>

<?php endif; ?>
<?php endif; ?>

<?php wp_reset_query();
///////////////////end///////////////////
?>

<div class="span6" id="blog_page">
<div class="row">

<?php if (rwmb_meta('csc_banner_top2_post')):?>

<div class="span6" style="margin-bottom:40px;">

<?php 
		$csc_banner_top2_margin ='';
		if (rwmb_meta('csc_banner_top2_post_margin')){ 
		 $csc_banner_top2_margin = 'margin-top:'.rwmb_meta('csc_banner_top2_post_margin'); 
		}
		
		csc_banner_post('csc_banner_top2_post' , '<div style="text-align:center;'. $csc_banner_top2_margin .'">' , '</div>' ); 
		
		?>

</div>

<?php endif;?>
<?php global $post;
$reset_post = $post;?>
<?php 
setPostViews();
?>	
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<?php get_template_part( '/partials/content', 'single' ); ?>
					<?php comments_template( '/comments-temp.php'); ?>
<?php endwhile; ?>
<?php endif;?>
<?php $post = $reset_post;
wp_reset_query();?>


</div>
</div>


<?php 
///////////////////left right///////////////////
if( rwmb_meta( 'csc_sel_side_pos') != 'left' && rwmb_meta( 'csc_sel_side_pos') != 'right' ):?>
<?php if( rwmb_meta( 'csc_sel_side_pos') == 'left_right' || csc_option('csc_sidebar_pos_single') == 'left_right'):?>

<div class="span3">
<?php $name2 = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement', true);?>
<div class="row">
<div class="span3">
<?php if (!empty($name2[0])):?>
<?php dynamic_sidebar($name2[0]);?>
<?php
elseif (csc_option('csc_def_spost_side2')): ?>
<?php $side_default2 = csc_option('csc_def_spost_side2');?>
<?php dynamic_sidebar('"'.$side_default2.'"'); ?>
<?php 
else :
dynamic_sidebar("Sidebar Two");?>
<?php endif; ?>
</div>
</div>
</div>

<?php endif; ?>
<?php endif; ?>

<?php wp_reset_query();
///////////////////right///////////////////
?>

<?php if( rwmb_meta( 'csc_sel_side_pos') != 'left_right' && rwmb_meta( 'csc_sel_side_pos') != 'left'):?>
<?php if( rwmb_meta( 'csc_sel_side_pos') == 'right' || csc_option('csc_sidebar_pos_single') == 'right'):?>

<div class="span3">
<?php $name = get_post_meta($post->ID, 'sbg_selected_sidebar', true);?>
<div class="row">
<div class="span3">
<?php if (!empty($name[0])):?>
<?php dynamic_sidebar($name[0]);?>
<?php
elseif (csc_option('csc_def_spost_side')): ?>
<?php $side_default = csc_option('csc_def_spost_side');?>
<?php dynamic_sidebar('"'.$side_default.'"'); ?>
<?php 
else :
dynamic_sidebar("Sidebar One");?>
<?php endif; ?>
</div>
</div>
</div>
<?php wp_reset_query();?>
<div class="span3">
<?php $name2 = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement', true);?>
<div class="row">
<div class="span3">
<?php if (!empty($name2[0])):?>
<?php dynamic_sidebar($name2[0]);?>
<?php
elseif (csc_option('csc_def_spost_side2')): ?>
<?php $side_default2 = csc_option('csc_def_spost_side2');?>
<?php dynamic_sidebar('"'.$side_default2.'"'); ?>
<?php 
else :
dynamic_sidebar("Sidebar Two");?>
<?php endif; ?>
</div>
</div>
</div>

<?php endif; ?>
<?php endif;
///////////////////end///////////////////
 ?>

<?php 
wp_reset_query();

if (rwmb_meta('csc_banner_bottom_post')):?>

<div class="span12">
<?php 
		$csc_banner_top_margin ='';
		if (rwmb_meta('csc_banner_bottom_post_margin')){ 
		 $csc_banner_top_margin = 'margin-top:'.rwmb_meta('csc_banner_bottom_post_margin'); 
		}
		
		csc_banner_post('csc_banner_bottom_post' , '<div style="text-align:center;'. $csc_banner_top_margin .'">' , '</div>' ); 
		
		?>
</div>

<?php endif;?>

</section>
</div>
</div>	
<?php get_footer(); ?>