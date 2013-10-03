<?php
get_header(); ?>
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
<div class="row">


 <div class="span6">
				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title not-mes" style="font-size:100px; font-weight:700; line-height:120px; text-shadow:1px 1px 0 #ccc"><?php _e( 'Oops ! 404 !', 'csc-themewp' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p style="font-size:18px; font-weight:400; text-shadow:1px 1px 0 #ccc"><?php _e( "404 error, couldn't find the content you were looking for.", 'csc-themewp' ); ?></p>
						
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->
                
             
</div>
<div class="span6">
<div class="row">

                    <div class="span6">
                    <article style="margin-top:0;">
                        
                        
                        <div class="clear"></div>
                        <p style="font-size:20px; font-weight:700; line-height:20px; margin-top:30px">
                        <?php _e('Please check out other posts:', 'csc-themewp'); ?>
                        </p>
                            
                    </article>
                    </div>
                    <?php
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$count_post = csc_option('csc_count_post_page');
$wp_query->query('posts_per_page='.$count_post.'&paged='.$paged);
while ($wp_query->have_posts()) : $wp_query->the_post();
?>
<div class="span6">
<article id="post-<?php the_ID(); ?>" style="padding:10px 20px; background:#f8f8f8; margin-bottom:30px;">

                <?php $thumb = get_post_thumbnail_id();?>
				<?php $image = wp_get_attachment_url($thumb, 'full'); ?>
                <?php $images = aq_resize($image, 90 , 90 , true, true);?>
                <?php if(has_post_thumbnail()): ?>
                <img class="alignleft" src="<?php echo $images; ?>" alt="<?php the_title(); ?>" style="margin-top:10px; margin-bottom:1px"/>
                <?php endif; ?> 
                
                                <h4 class="post_title" style="font-weight:700"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                                <p><?php echo string_limit_words(get_the_excerpt(), 31); ?></p>
                                   <div class="entry-info">              
          <?php if ( 'post' == get_post_type() ) : ?>

				<?php twentyeleven_posted_on(); ?>
			
			<?php endif; ?>
            
             <?php if ( count( get_the_category() ) ) : ?>
			<?php printf( __( '%2$s', 'csc-themewp'), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
			<?php endif; ?>
            
        
             			<?php $tags_list = get_the_tag_list( '', ', ' ); 
			if ( $tags_list ): ?>
			<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'csc-themewp' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
			<?php endif; ?> 
            <?php if ( comments_open() ) : ?>
			<span class="comments-link"><?php comments_popup_link( '<span class="%1$s">Comments</span> 0', '<span class="%1$s">Comments</span> 1', '<span class="%1$s">Comments</span> %', 'comments-link', 'Comments are off for this post');; ?></span>
			<?php endif; // End if comments_open() ?>  

            </div>
                            
                             </article>					
                   </div>
<?php endwhile; ?>


<?php $wp_query = null; $wp_query = $temp;?>
                    <?php wp_link_pages(); ?>



</div>
</div>

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
		
		csc_banner('csc_banner_footer' , '<div style="text-align:center;'. $csc_banner_footer_margin .'">' , '</div>' )
		
		?>
</div>

<?php endif; ?>

</section>
</div>
</div>
		
<?php get_footer(); ?>