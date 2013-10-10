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

<?php
//Check to see if author has role author
if (is_singular()) {
    $author_id = get_queried_object()->post_author;
    }
    
    $userlevel = get_the_author_meta('user_level');
	if ($userlevel== 2) { ?>
<div class="row">
<div class="span3">
<aside id="csc_recentpost_widget-2" class="widget csc-recent-posts">
	<div class="widget-title">
		<h3>Resource Center</h3>
	</div>
		<ul class="w-recentpost expert_sidebar">

<?php
  
    $blogauthornice = get_the_author_meta('user_nicename');
	$blogauthorname = get_the_author_meta('nickname');
	$blogauthorid = get_the_author_meta('ID');
	echo '<li class="expert_sidebar bl-bg">';
	echo '<header class="entry-header"><h2 class="post-title-small"><a href="/profile/'. $blogauthornice . '" title="'. $blogauthorname .'">'. $blogauthorname .'</a></h2></header>';
	echo '<a href="/profile/'. $blogauthornice . '">'. get_avatar (get_the_author_meta('ID'), 120) .'</a>';
	global $post;
	$category = get_the_category($post->ID); 
	 $args=array(
		  'category__in' => wp_get_post_categories($post->ID),
		  'post__not_in' => array($post->ID),
	      'author' => $blogauthorid,
	      'post_type' => 'post',
	      'post_status' => 'publish',
	      'posts_per_page' => 2,
	      'orberby' => 'rand',
	      'caller_get_posts'=> 1
	    );
	    $my_query = null;
	    $my_query = new WP_Query($args);
	    if( $my_query->have_posts() ) {
	      //echo List of Posts
	      while ($my_query->have_posts()) : $my_query->the_post(); ?>
	        <p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
	        <?php endwhile;
	    }
 	echo '</li>'; ?>

</ul>
</aside>
</div>
</div>

<?php wp_reset_query(); 

	}?>

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