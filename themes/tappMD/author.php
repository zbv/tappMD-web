<?php
get_header();
?>

<?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));?>

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
<h1><?php printf( __( 'Expert Profile : %s', 'csc-themewp' ), get_the_author(). '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

<?php $categorydesc = category_description(); if ( ! empty( $categorydesc ) ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . $categorydesc . '</div>' ); ?>
<?php rewind_posts(); ?>
</header>
</div>

<div class="span12">
<div class="row">
<section>

<?php wp_reset_query();?>


<div class="span3">

<div class="row">
	<div class="span3" id="author-share" style="text-align:center; padding-bottom:10px; padding-top:25px;">
        	<div style="width:200px; display: block; margin-left:auto; margin-right:auto;">
            <?php echo userphoto_the_author_photo(); ?>
            
            <ul class="socicon-2 pull-left author" style="padding-top:15px; margin-left:20px">

            <?php if (get_the_author_meta('twitter')) { ?>
            <li><a href="<?php echo get_the_author_meta('twitter'); ?>" class="soc-follow twitter"  title="<?php echo get_the_author_meta('display_name') ?> on twitter"></a></li>
            <?php } ?>
            
            <?php if (get_the_author_meta('facebook')) { ?>
            <li><a href="<?php echo get_the_author_meta('facebook'); ?>" class="soc-follow facebook"  title="<?php echo get_the_author_meta('display_name') ?> on facebook"></a></li>
            <?php } ?>
            
            <?php if (get_the_author_meta('google')) { ?>
            <li><a href="<?php echo get_the_author_meta('google'); ?>" class="soc-follow googleplus" title="<?php echo get_the_author_meta('display_name') ?> on google plus"></a></li>
            <?php } ?>
            
            <?php if (get_the_author_meta('linkedin')) { ?>
            <li><a href="<?php echo get_the_author_meta('linkedin'); ?>" class="soc-follow linkedin"  title="<?php echo get_the_author_meta('display_name') ?> on linkedin"></a></li>
            <?php } ?>

            <?php if (get_the_author_meta('feedburner')) { ?>
			<li><a href="<?php echo get_the_author_meta('feedburner'); ?>" class="soc-follow rss"  title="<?php echo get_the_author_meta('display_name') ?> rss" target="_blank"></a></li>
			<?php } ?>
                       
</ul>            
    	</div>
	</div>
</div>

<div class="row">
    <div class="span3">
    
    <div class="widget-title"><h3>tapp Stats</h3></div>         
                        
        <ul class="w-recentpost" style="margin-bottom:0;">
            <li class="rev_block" style="border-bottom:1px solid #E3E3E8; margin-bottom:5px; padding-bottom:10px; position:relative; overflow:hidden">                   
                    <header class="entry-header" style="padding-bottom:2px; border-bottom:1px solid #e3e3e8;">
                        <h2 class="post-title-small"><a href="#" title="Influence">Articles</a> </h2>
                    </header>
                
                <div class="entry-info" style="margin-top:5px;"> 
                    <span class="scorehomebig"><?php echo number_format_i18n( get_the_author_posts() ); ?></span>							
                        <span style="font-size:14px; font-style:normal !important;">Main Category : <?php if (get_the_author_meta('specialty')) {?>
       <a style="font-size:14px; font-style:normal !important;" href="#" title="<?php echo get_the_author_meta('specialty'); ?>"><?php echo get_the_author_meta('specialty'); ?>
			<?php } else { ?>
         	<?php } ?>    </a></span>
                </div>
            </li>
        </ul>
    
    </div>
</div> 

<!-- List The Author Categories -->
<div class="row">
	<div class="span3">
<aside id="csc_recentpost_widget-2" class="widget csc-recent-posts">
	<div class="widget-title">
		<h3>Recent Posts</h3>
	</div>
	
		<ul class="w-recentpost">
		 	
	<?php /* Start the Loop */ ?>
	
	<?php $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 10, 'author' => $curauth->ID) );
				while ( $loop->have_posts() ) : $loop->the_post(); 			
		

					 $thumb = get_post_thumbnail_id();
				     $image = wp_get_attachment_url($thumb, 'full');
                     $images = aq_resize($image, 90, 90 , true, true);?>
                   <li style="margin-bottom:10px; padding-bottom:5px;" class=" bl-bg">
                    <?php if(has_post_thumbnail()):?>
					<a href="<?php echo get_permalink() ?>" class="imageLeft"><img alt=""  src="<?php echo $images ?>" /></a>
                    <?php endif; ?> 
					<header class="entry-header"><h2 class="post-title-small"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2></header>
                   
                   <?php csc_post_info();?>
                
				<?php echo string_limit_words(get_the_excerpt(), 20); ?>
                    </li>
				<?php endwhile;?>
				
		</ul>
						
		</aside>		
	</div>
</div>
    
<!-- END List The Author Categories -->
              
<div class="row">
<div class="span3"> 
<?php 
$sidebar_archive = csc_option( 'csc_sidebar_archive') ;
dynamic_sidebar("Author Side Bar 1");
?>
</div>
</div>

</div>


<?php wp_reset_query();?>

<div class="span6">

	<div class="row">
        	<div class="span2">
            &nbsp;
            </div>
        	<div class="span4">
            <p>
            <button type="button" class="btn btn-primary">Follow</button>
            <button type="button" class="btn btn-info">Ask A Question</button>    
            <button type="button" class="btn btn-success"><span class="st_sharethis_custom" displayText="Your Text">Recommend</span>
</button> 	
			<?php if (get_the_author_meta('feedburner_username')) { ?>
            <a href="http://feedburner.google.com/fb/a/mailverify?uri=<?php echo get_the_author_meta('feedburner_username'); ?>&amp;loc=en_US" title="Subscribe to <?php echo get_the_author_meta('display_name') ?>" target="_blank"><button type="button" class="btn btn-warning">Subscribe</button></a>
            <?php } ?>
                    
            </p>
            </div>
    </div>
    
<div class="row">
    <div class="span6 divider-strip author">
            
    <h3 itemprop="author">About <span class="fn  org"><?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?></span></h3>
    </div>
	
    <div class="span6 author">
            
        <div class="author-bio"><?php echo $curauth->user_description; ?></div>
    
    </div>  

<div id="author-share" class="span6 author" style="margin-top:0; background:none; padding-top:0; padding-bottom:15px;">
<ul class="socicon-2 pull-right author" style="padding-top:0;">

<?php if (get_the_author_meta('twitter')) { ?>
            <li>
            <a href="<?php echo get_the_author_meta('twitter'); ?>" class="soc-follow twitter"  title="<?php echo get_the_author_meta('display_name') ?> on twitter"></a></li>
            <?php } ?>
            
            <?php if (get_the_author_meta('facebook')) { ?>
            <li><a href="<?php echo get_the_author_meta('facebook'); ?>" class="soc-follow facebook"  title="<?php echo get_the_author_meta('display_name') ?> on facebook"></a></li>
            <?php } ?>
            
            <?php if (get_the_author_meta('pinterest')) { ?>
            <li><a href="<?php echo get_the_author_meta('pinterest'); ?>" class="soc-follow pinterest" title="<?php echo get_the_author_meta('display_name') ?> on pinterest"></a></li>
            <?php } ?>
           
            <?php if (get_the_author_meta('google')) { ?>
            <li><a href="<?php echo get_the_author_meta('google'); ?>" class="soc-follow googleplus" title="<?php echo get_the_author_meta('display_name') ?> on google plus"></a></li>
            <?php } ?>

            <?php if (get_the_author_meta('linkedin')) { ?>
            <li><a href="<?php echo get_the_author_meta('linkedin'); ?>" class="soc-follow linkedin"  title="<?php echo get_the_author_meta('display_name') ?> on linkedin"></a></li>
            <?php } ?>

            <?php if (get_the_author_meta('youtube')) { ?>
            <li><a href="<?php echo get_the_author_meta('youtube'); ?>" class="soc-follow youtube" title="<?php echo get_the_author_meta('display_name') ?> on youtube" ></a></li>
            <?php } ?>
            
             <?php if (get_the_author_meta('feedburner')) { ?>
			<li><a href="<?php echo get_the_author_meta('feedburner'); ?>" class="soc-follow rss"  title="<?php echo get_the_author_meta('display_name') ?> rss" target="_blank"></a></li>
			<?php } ?>
                       
</ul>
</div>
<div class="divider-post span6" style="margin-bottom:15px;margin-top:0;"></div>

	<?php if (get_the_author_meta('media_reel')) { ?>
    <div class="span6 divider-strip author">
            
    <h3 itemprop="author">Media Reel For <span><?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?></span></h3>
    </div>
	
    <div class="span6 author">
        
        <p><iframe width="640" height="360" src="//www.youtube.com/embed/<?php echo get_the_author_meta('media_reel'); ?>?feature=player_embedded" frameborder="0" allowfullscreen></iframe></p>
    
    </div> 
    <div class="divider-post span6" style="margin-bottom:15px;margin-top:0;"></div>
    
    <?php } ?>
    
    <div class="span6 divider-strip author">
            
    <h3 itemprop="author">Visit <span><?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?></span></h3>
    </div>
    
    <div class="span3">
    
        <ul style="margin-left:0;font-size:13px; display:block;" class="vcard" itemscope itemtype="http://schema.org/Corporation">
        <?php if (get_the_author_meta('office-logo')) { ?>
            <li><img src="<?php echo get_the_author_meta('office-logo'); ?>" title="<?php echo get_the_author_meta('office-name'); ?>" style="margin-left:25px; max-width:165px;"></li>
            <?php } else { ?>
            <?php } ?>
           
		<?php if (get_the_author_meta('office-name')) { ?>
            <li style="margin-bottom:5px;"><h3><strong><span class="fn  org" itemprop="name"><?php echo get_the_author_meta('office-name'); ?></span> </strong></h3>
            </li>
            <?php } else { ?>
            <?php } ?> 
        </ul>
        
        <ul style="margin-left:0;font-size:13px; display:block;" class="adr" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    	
       <?php if (get_the_author_meta('office-address-num')) { ?>
            <li>
            	<p><?php echo get_the_author_meta('office-address-num'); ?> <?php echo get_the_author_meta('office-address-street'); ?><br />
            	<span class="locality" itemprop="addressLocality"><?php echo get_the_author_meta('office-city'); ?></span>, <span class="region" itemprop="addressRegion"><?php echo get_the_author_meta('office-state'); ?></span> <span class="postal-code" itemprop="postalCode"><?php echo get_the_author_meta('office-zip'); ?></span>
            	</p>
            </li>
            <?php } else { ?>
            <?php } ?> 
            
		<?php if (get_the_author_meta('office-phone')) {?>
        	<li style="margin-bottom:5px"><strong>Phone:</strong> <span class="tel" itemprop="telephone"><?php echo get_the_author_meta('office-phone'); ?></span></li>
         	<?php } else { ?>
         	<?php } ?> 
   		
		<?php if (get_the_author_meta('user_url')) {?>
        <li style="margin-bottom:5px"><strong>On The Web:</strong> <a href="<?php echo get_the_author_meta('user_url'); ?>" title="<?php echo get_the_author_meta('office-name'); ?>" target="_blank"><?php echo get_the_author_meta('user_url'); ?></a></li>
			<?php } else { ?>
         	<?php } ?>         
        </ul>
    </div>
    <div class="span3">
    
    <iframe width="300" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo get_the_author_meta('office-address-num'); ?>+<?php echo get_the_author_meta('office-address-street'); ?>+<?php echo get_the_author_meta('office-city'); ?>,+<?php echo get_the_author_meta('office-state'); ?>+<?php echo get_the_author_meta('office-zip'); ?>&amp;oe=UTF-8&amp;hnear=<?php echo get_the_author_meta('office-address-num'); ?>+<?php echo get_the_author_meta('office-address-street'); ?>+<?php echo get_the_author_meta('office-city'); ?>,+<?php echo get_the_author_meta('office-state'); ?>+<?php echo get_the_author_meta('office-zip'); ?>&amp;gl=us&amp;t=m&amp;ie=UTF8&amp;hq=&amp;z=14&amp;&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?q=<?php echo get_the_author_meta('office-address-num'); ?>+<?php echo get_the_author_meta('office-address-street'); ?>+<?php echo get_the_author_meta('office-city'); ?>,+<?php echo get_the_author_meta('office-state'); ?>+<?php echo get_the_author_meta('office-zip'); ?>&amp;oe=UTF-8&amp;hnear=<?php echo get_the_author_meta('office-address-num'); ?>+<?php echo get_the_author_meta('office-address-street'); ?>+<?php echo get_the_author_meta('office-city'); ?>,+<?php echo get_the_author_meta('office-state'); ?>+<?php echo get_the_author_meta('office-zip'); ?>&amp;gl=us&amp;t=m&amp;ie=UTF8&amp;hq=&amp;z=14&amp;source=embed" style="color:#0000FF;text-align:left">View Larger Map</a></small>
    
    </div>
    
    <div class="divider-post span6" style="margin-bottom:15px;margin-top:0;"></div>

    <div class="span6 divider-strip author">
            
    <h3 itemprop="author">Resource Centers Prescribed By <span><?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?></span></h3>
    </div>
    
    <!--Begin DIV ID Resource Centers-->
    <div class="span6" id="resource_centers">
    <aside id="csc_magazine-widget_bignews-3" class="widget csc_magazine_bignews">		

		<div class="row">

	<?php
	//Run The Query To Select Categories With Author Posts
	
            $author = get_query_var('author');
            $categories = $wpdb->get_results("
                SELECT DISTINCT(terms.term_id) as ID, terms.name, terms.slug, tax.description
                FROM $wpdb->posts as posts
                LEFT JOIN $wpdb->term_relationships as relationships ON posts.ID = relationships.object_ID
                LEFT JOIN $wpdb->term_taxonomy as tax ON relationships.term_taxonomy_id = tax.term_taxonomy_id
                LEFT JOIN $wpdb->terms as terms ON tax.term_id = terms.term_id
                WHERE 1=1 AND (
                    posts.post_status = 'publish' AND
                    posts.post_author = '$author' AND
                    tax.taxonomy = 'category' )
                ORDER BY terms.name ASC
            ");
            ?>

	<?php foreach($categories as $category) : ?>
		<!--Begin Title -->
        <div class="span6" style="position:relative">
          <div class="widget-title"><h3><?php echo $category->name.' '.$category->description; ?></h3></div> 
          
         <?php $category_id = $category->ID; ?>      
          	<a class="rss_cat" href="<?php CSC_BASE_URL ?>?feed=rss2&cat=<?php echo $category_id;?>"></a>
           	<a class="all_cat" href="<?php echo get_category_link( $category->ID ); ?>" title="View all posts filed under <?php echo $category->name ?>"></a>
    
	    
		</div>
		<!-- End Title -->
		
				 	<?php // The Query
                       		$catid = $category->ID;
							$authorid = $curauth->ID;
                       		$args = 'cat=' . $catid . '&orderby=date&order=ASC&posts_per_page=1&author=' . $authorid;
							$the_query = new WP_Query( $args );
							
							// The Loop
							if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) {
									$the_query->the_post(); ?>	
			 		
			 	<?php $thumb = get_post_thumbnail_id();?>
				<?php $image = wp_get_attachment_url($thumb, 'full'); ?>
                <?php if ( wp_is_mobile() ) {
						/* Resize Images For Display On mobile */
						$images = aq_resize($image, 320, 200 , true, true);
					} else {  
						$images = aq_resize($image, 200, 130 , true, true);
							}
					?>
					
         
		<!-- Begin post -->				
          <div class="span6" style="position:relative">

			 	<ul class="w-recentpost">
			 		
			 		
                <?php if ( wp_is_mobile() ) {
						/* Alignment For Mobile */
						?>
                        
                 <li style="margin-bottom:10px; padding:10px;" class=" bl-bg">
                 
                 <?php } else { ?>
                 
                 <li style="margin-bottom:10px; padding-bottom:15px; padding-left:5px;" class=" bl-bg">

				 <?php } ?>

               	<?php if(has_post_thumbnail()):?>
               	
               		<a href="<?php the_permalink(); ?>" class="imageLeft" title="<?php the_permalink(); ?>">
               			<img alt="<?php the_permalink(); ?>" src="<?php echo $images ?>">
               		</a>			
               		    
				<?php endif; ?> 
         
				<header class="entry-header">
                	<h2 class="post-title-small" style="margin-top:5px;">
                		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                </header>
                   
                   <div class="author_bignews" style="float: left;">
            		<?php echo userphoto_the_author_photo(); ?>
                   </div>
                   
					   <?php csc_post_info();?>
                
						<?php echo string_limit_words(get_the_excerpt(), 15); ?>
		                     
                     <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="entry-more"><?php _e('[...Read More] ', 'csc-themewp') ?> <i class="icon-circle-arrow-right"></i> </a>
                     </li>
                     
                     

 	
           </ul>
	    </div>
	    
	    <?php	}
							} else {
								// no posts found
							}
							/* Restore original Post Data */
							wp_reset_postdata();  ?>
			<?php endforeach; ?>
        </div>	
        
		</aside>
		
		
		
		</div><!--End DIV ID Resource Centers -->
    


</div>
</div>

<?php wp_reset_query();?>

<div class="span3">

<div class="row">
    <div class="span3">
    
    <style>
	.relateddoc{ display:inline-block;}
	.relateddoc ul, .widget .relateddoc ul {list-style-type: none;padding: 0;margin: 0;}
	.relateddoc ul li,.widget .relateddoc ul li {width: auto;float: left; margin: 0 2px 2px 0; padding:1px; background-color:#E5E4E4;}
	.relateddoc a, .relateddoc img{width: 56px; height: 56px;}
	.relateddoc a:hover img{opacity:.7;}
	.csc_latest_portfolio li{float: left; margin: 0 2px 2px 0; padding:1px; background-color:#E5E4E4;}
	</style>
    
    	<div class="widget-title"><h3>Related Experts</h3></div>         
			<div id="csc_relateddoc_widget-2" class="relateddoc">
            
              	<ul>
                
                    <?php contributors(); ?>
                   
       			</ul>
       		</div>    
    </div>
</div>

<div class="row">
<div class="span3">
<?php 
$sidebar_archive2 = csc_option( 'csc_sidebar_archive2') ;
 dynamic_sidebar("Author Side Bar 2");
?>

</div>
</div>

</div>


<?php wp_reset_query();?>

</section>
</div>
</div>
		
<?php get_footer(); ?>