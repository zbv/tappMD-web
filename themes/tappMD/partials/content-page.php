<?php
/**
 * The template used for displaying page content in page.php
 */
?>

<div class="span12">
<div class="row">
<section>

<?php wp_reset_query();?>

<?php if( rwmb_meta( 'csc_sel_side_pos') != 'left' && rwmb_meta( 'csc_sel_side_pos') != 'right'):?>
<?php if( rwmb_meta( 'csc_sel_side_pos') == 'left_right' || csc_option('csc_sidebar_pos_page') == 'left_right' ):?>
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

<?php if (csc_option('csc_breadcrumbs')):?>
<div class="span6">
      <?php csc_include( 'breadcrumbs' ); ?>
</div>
<?php endif;?>

 <?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                 

	<div class="span6">
    
    
    <h1 class="post-title entry-title" itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'csc-themewp' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>


<?php  
the_content();
?>
	</div><!-- .entry-content -->

		<?php edit_post_link( __( 'Edit', 'csc-themewp' ), '<span class="edit-link">', '</span>' ); ?>
    
</article><!-- #post-<?php the_ID(); ?> -->
<?php endwhile; // end of the loop. ?>

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