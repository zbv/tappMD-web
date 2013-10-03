<?php
/**
 * The default template for displaying content
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="span6">

<div class="row">

<?php $image_post_heigh = csc_option('csc_image_post_height');?>
<?php if(has_post_thumbnail()): ?>

<div class="span3">

<?php $thumb = get_post_thumbnail_id();?>
<?php $image = wp_get_attachment_url($thumb, 'full'); ?>
<?php $thumb = aq_resize($image, 300, 190, true, true); ?>

                <div class="row">
                 <div class="span3 post-img news-infop">
                 <div class="post-format"><span></span></div>
                  <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'>
                <img class="alignleft" src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>"/></a>
                  </div>
                 </div>
 </div>
 
 <div class="span3">
 
 <?php else: ?>

<div class="span6">

 <?php endif; ?>
 
<header class="entry-header">
<h2 class="post-title post-cat"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'csc-themewp' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
</h2>                          
</header><!-- .entry-header -->
<?php csc_post_info();?>
<div class="entry-content" style="margin-top:0;">
<?php 
if ( csc_option('csc_auto_exc_len') ):

$auto_exc = csc_option('csc_auto_exc_len');

?>
<p><?php echo string_limit_words(get_the_excerpt(), $auto_exc);?> ...</p>

<?php else : ?>

<?php
global $more;
$more = 0;
?> 
<?php
the_content('...');
?>

<?php endif; ?>


</div><!-- .entry-content -->
<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="entry-more"><?php _e('Read More ', 'csc-themewp') ?> <i class="icon-circle-arrow-right"></i> </a>


</div>

<div class="span6" style="margin-bottom:15px;margin-top:0;"></div>


</div>
</div>



</article><!-- #post-<?php the_ID(); ?> -->
