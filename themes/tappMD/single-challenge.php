<?php
/*
*/
get_header();
wp_reset_query();
global $root; 
?>

<div class="container slider-cont"> 
  <div class="row">


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

<?php global $post;
$reset_post = $post;?>
<?php 
setPostViews();
?>	
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					

<article style="margin-top:0;" id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemprop="review" itemscope itemtype="http://schema.org/Review">
<div class="span6">

<header class="entry-header">
<h1 class="post-title entry-title" itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'csc-themewp' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
</h1>
                          
</header><!-- .entry-header -->

<div class="row">
<?php if (csc_option('csc_share_post_top')) : ?>
<?php if( !rwmb_meta( 'csc_hide_share_top')):?>
<div id="top_post_share">
<?php include CSC_BASE. 'share.php'; ?>
</div>
<?php	
endif;
endif;
?>
<script>
jQuery(document).ready(function($) {
jQuery("#disqus_thread").addClass("span6");
});
</script>

<div class="span6">

<?php if(has_post_thumbnail()): ?>

<?php $image_size_single_post = csc_option('csc_image_single_post_height');?>

<?php $thumb = get_post_thumbnail_id();?>
<?php $image = wp_get_attachment_url($thumb, 'full'); ?>
<?php $thumb = aq_resize($image, 630, $image_size_single_post , true, true); ?>

                <div class="row">
                 <div class="span6 post-img">
                    <img src="<?php echo $thumb; ?>" />
                    
                  </div>
                 </div>
<?php endif;?>

</div>

 
<div class="span6">
 
<div class="entry-content">
                    
                     

<?php
the_content();
?>


</div><!-- .entry-content -->

</div>
<div class="navigation span6">
<style>
.pagenavi span {padding: 5px 10px 6px 10px;font-size: 12px;line-height: 12px; border:1px #e8e8e3 solid;}
.pagenavi a > span { margin-right:0px; margin-left:0px; padding:0; border:none !important;}
</style>
<?php 
$args = array(
 'before'           => '<div class="pagenavi">' . __('Pages : &nbsp;', 'csc-themewp'),
 'after'            => '</div>',
 'link_before'      => '<span>',
 'link_after'       => '</span>',
 'next_or_number'   => 'number',
 'pagelink'         => '%',
 'echo'             => 1 ); 

wp_link_pages( $args );
?>


</div>

</div>
</div>
<?php if( !rwmb_meta( 'csc_hide_share')):?>

<?php include CSC_BASE. 'share.php'; ?>

<?php	
endif;
?>

<?php if( !csc_option('csc_hide_prev_next')):?>

<div class="divider-post span6" style="margin-bottom:0px;"></div>
<style>
ul.control-menu { margin:0px; margin-bottom:0px; margin-top:20px;}
ul.control-menu li{ max-width:50%}
ul.control-menu li a{ background: none !important; border:none !important; font-weight:700; font-size:15px; color:#868585 !important;}
ul.control-menu li a:hover{background: none;border:none;}
ul.control-menu .prev{ text-align:left; float:left; }
ul.control-menu .next{ text-align: right; float:right;}
ul.control-menu li.prev a { text-align:left; padding:0; }
ul.control-menu li.next a { text-align: right; padding:0; }
ul.control-menu li.prev a span{ font-weight:400; display:block; text-align:left;font-size:12px; margin-top:5px; color:#999999}
ul.control-menu li.next a span{ font-weight:400; display:block; text-align: right; font-size:12px; margin-top:5px;color:#999999}
</style>

<ul class="control-menu span6">
     <li class="prev"><?php be_next_post_link("%link", "<i class=\"icon-arrow-left\"></i> Prev <span>%title</span>", '', "", '') ?></li>
     <li class="next"><?php be_previous_post_link("%link", "Next <i class=\"icon-arrow-right\"></i> <span>%title</span>", '', "", '') ?></li>		
</ul> 

<?php	
endif;
?>

<?php if( !rwmb_meta( 'csc_hide_related')):?>

<?php 
if( csc_option('csc_related') ){
csc_include( 'related' ); 
}
?>

<?php	
endif;
?>

<div class="divider" style="margin-top:5px;"></div>
</article><!-- #post-<?php the_ID(); ?> -->
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
wp_reset_query();?>

</section>
</div>
</div>	
<?php get_footer(); ?>