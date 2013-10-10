<?php
/*
Template Name: Home Magazine
 */
get_header(); ?>
<div class="container"> 
  <div class="row">
<?php if( !rwmb_meta( 'csc_hide_above')):?>

<?php if (rwmb_meta('csc_banner_top_page')):?>

<div class="span12">
<header id="pagehead">
<?php 
		$csc_banner_top_margin ='';
		if (rwmb_meta('csc_banner_top_page_margin')){ 
		 $csc_banner_top_margin = 'margin-top:'.rwmb_meta('csc_banner_top_page_margin'); 
		}
		
		csc_banner_post('csc_banner_top_page' , '<div style="text-align:center;'. $csc_banner_top_margin .'">' , '</div>' ); 
		
		?>
</header>
</div>
<?php elseif (csc_option('csc_banner_page')):?>

<div class="span12">
<header id="pagehead">
<?php 
		$csc_banner_top_margin ='';
		if (csc_option('csc_banner_page_margin')){ 
		 $csc_banner_top_margin = 'margin-top:'.csc_option('csc_banner_page_margin'); 
		}
		
		csc_banner('csc_banner_page' , '<div style="text-align:center;'. $csc_banner_top_margin .'">' , '</div>' ); 
		
		?>
</header>
</div>

<?php else : ?>
<?php endif; ?>

<?php endif; ?>

<div class="span12">

<?php if (csc_option('csc_hide_break')):?>

      <?php csc_include( 'breaking' ); ?>

<?php  endif;?>


<?php 
if ( is_front_page() ) {?>
<?php if (csc_option('csc_hide_hotnews') && csc_option('csc_below_hotnews')):?>

      <?php csc_include( 'top_news' ); ?>

<?php  endif;?>
<?php }?>


<div class="row">
<section>

<?php 

$tb_place = csc_option('csc_def_mag_block');

if (csc_option('csc_def_mag_block')&& csc_option('csc_def_mag_block')!='sliders'):?>
<?php csc_include( $tb_place ); ?>
<?php endif; ?>

<?php wp_reset_query();?>

<?php if( rwmb_meta( 'csc_sel_side_pos') != 'left' && rwmb_meta( 'csc_sel_side_pos') != 'right'):?>
<?php if( rwmb_meta( 'csc_sel_side_pos') == 'left_right' || csc_option('csc_sidebar_pos_page') == 'left_right' ):?>
<div class="span3">
<div class="row">
<div class="span3">
<aside id="csc_recentpost_widget-2" class="widget csc-recent-posts">
	<div class="widget-title">
		<h3>Expert Network</h3>
	</div>
		<ul class="w-recentpost expert_sidebar">

<?php
//displays all users with their avatar and their posts (titles)
$blogauthors = get_users('role=author');
if ($blogauthors) {
  foreach ($blogauthors as $blogauthor) {
    $blogauthornice = $blogauthor->user_nicename;
	$blogauthorname = $blogauthor->nickname;
	echo '<li class="expert_sidebar bl-bg">';
	echo '<header class="entry-header"><h2 class="post-title-small"><a href="/profile/'. $blogauthornice . '" title="'. $blogauthorname .'">'. $blogauthorname .'</a></h2></header>';
	echo '<a href="/profile/'. $blogauthornice . '">'. get_avatar ($blogauthor->ID, 120) .'</a>';
    $args=array(
      'author' => $blogauthor->ID,
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => 2,
      'caller_get_posts'=> 1
    );
    $my_query = null;
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
      //echo 'List of Posts for ' . user->user_firstname . ' ' . $user->user_lastname;
      while ($my_query->have_posts()) : $my_query->the_post(); ?>
        <p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
        <?php endwhile;
    }
  wp_reset_query();  // Restore global post data stomped by the_post().
  }
 echo '</li>';
}
?>
</ul>
</aside>
</div>
</div>


<div class="row">
<div class="span3">
<?php 
if (is_page()) {
$name = get_post_meta($post->ID, 'sbg_selected_sidebar', true);
$page_id = get_query_var('page_id');
$page_sidebar = csc_option( 'csc_page_'.$page_id ) ;
if (!empty($name[0])){
dynamic_sidebar($name[0]);
}
elseif( $page_sidebar ){
dynamic_sidebar ( sanitize_title( $page_sidebar ) ); 
}
else dynamic_sidebar("Sidebar One");
}
?>

</div>
</div>
</div>
<?php endif; ?>
<?php endif; ?>

<?php wp_reset_query();?>

<?php if( rwmb_meta( 'csc_sel_side_pos') != 'left_right'):?>
<?php if( csc_option('csc_sidebar_pos_page') == 'left' || rwmb_meta( 'csc_sel_side_pos') == 'left'):?>
<div class="span3">
<div class="row">
<div class="span3">
<?php 
if (is_page()) {
$name = get_post_meta($post->ID, 'sbg_selected_sidebar', true);
$page_id = get_query_var('page_id');
$page_sidebar = csc_option( 'csc_page_'.$page_id ) ;
if (!empty($name[0])){
dynamic_sidebar($name[0]);
}
elseif( $page_sidebar ){
dynamic_sidebar ( sanitize_title( $page_sidebar ) ); 
}
else dynamic_sidebar("Sidebar One");
}
?>
</div>
</div>
</div>
<?php wp_reset_query();?>
<div class="span3">
<div class="row">
<div class="span3">
<?php 
if (is_page()) {
$name2 = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement', true);
$page_id2 = get_query_var('page_id');
$page_sidebar2 = csc_option( 'csc_page_2_'.$page_id2 ) ;
if (!empty($name2[0])){
dynamic_sidebar($name2[0]);
}
elseif( $page_sidebar2 ){
dynamic_sidebar ( sanitize_title( $page_sidebar2 ) ); 
}
else dynamic_sidebar("Sidebar Two");
}
?>
</div>
</div>
</div>
<?php endif; ?>
<?php endif; ?>

<?php wp_reset_query();?>

<div class="span6" id="blog_page">
<div class="row">

<?php 

if (csc_option('csc_def_mag_block') == 'sliders'):?>

<?php csc_include( 'sliders' ); ?>

<?php endif; ?>

<div class="span6" id="magaz_page">
<?php 
 dynamic_sidebar("Home Magazine");
?>
</div>

</div>
</div>


<?php wp_reset_query();?>


<?php if( rwmb_meta( 'csc_sel_side_pos') != 'left' && rwmb_meta( 'csc_sel_side_pos') != 'right'):?>
<?php if( rwmb_meta( 'csc_sel_side_pos') == 'left_right' || csc_option('csc_sidebar_pos_page') == 'left_right'):?>
<div class="span3">
<div class="row">
<div class="span3">
<?php 
if (is_page()) {
$name2 = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement', true);
$page_id2 = get_query_var('page_id');
$page_sidebar2 = csc_option( 'csc_page_2_'.$page_id2 ) ;
if (!empty($name2[0])){
dynamic_sidebar($name2[0]);
}
elseif( $page_sidebar2 ){
dynamic_sidebar ( sanitize_title( $page_sidebar2 ) ); 
}
else dynamic_sidebar("Sidebar Two");
}
?>
</div>
</div>
</div>
<?php endif; ?>
<?php endif; ?>

<?php wp_reset_query();?>

<?php if( rwmb_meta( 'csc_sel_side_pos') != 'left_right'):?>
<?php if( !csc_option('csc_sidebar_pos_page') || csc_option('csc_sidebar_pos_page') == 'right' || rwmb_meta( 'csc_sel_side_pos') == 'right'):?>
<div class="span3">
<div class="row">
<div class="span3">
<?php 
if (is_page()) {
$name = get_post_meta($post->ID, 'sbg_selected_sidebar', true);
$page_id = get_query_var('page_id');
$page_sidebar = csc_option( 'csc_page_'.$page_id ) ;
if (!empty($name[0])){
dynamic_sidebar($name[0]);
}
elseif( $page_sidebar ){
dynamic_sidebar ( sanitize_title( $page_sidebar ) ); 
}
else dynamic_sidebar("Sidebar One");
}
?>
</div>
</div>
</div>
<?php wp_reset_query();?>
<div class="span3">
<div class="row">
<div class="span3">
<?php 
if (is_page()) {
$name2 = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement', true);
$page_id2 = get_query_var('page_id');
$page_sidebar2 = csc_option( 'csc_page_2_'.$page_id2 ) ;
if (!empty($name2[0])){
dynamic_sidebar($name2[0]);
}
elseif( $page_sidebar2 ){
dynamic_sidebar ( sanitize_title( $page_sidebar2 ) ); 
}
else dynamic_sidebar("Sidebar Two");
}
?>
</div>
</div>
</div>
<?php endif; ?>
<?php endif; ?>
<?php wp_reset_query();?>

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

<?php get_footer(); ?>