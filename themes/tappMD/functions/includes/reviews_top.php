<?php
globalScore();
global $post,$totalscore;

if(rwmb_meta('csc_reviews_act')): ?>

<div class="span3 topreviews" style="margin:0 20px 0 0; float:left;">
<div class="row">
               
<div class="span3">
<?php if(get_post_meta($post->ID, 'csc_overall_score_title', true)):   ?>        
<div class="widget-title" style=" margin-bottom:10px">
<h3><?php echo get_post_meta($post->ID, 'csc_overall_score_title', true); ?></h3>
</div>
<?php endif?>
<style>
.overall-score-criterion ul li{ list-style:none !important;}
.overall-score h1{ font-weight:700 !important; color:#fff !important;font-size:18px;text-align:center; margin:10px;}
.overall-score h3{ font-weight:700 !important; margin-left:20px; padding:10px 0;}
.overall-score a { border:none !important;}
.over-more{ top:13px !important;}
</style>

<?php 
//points system
if( rwmb_meta('csc_reviews_system') == 'points' ): ?>


<style>
.overall-score-criterion ul li{ border-bottom: none !important; min-height:28px; list-style:none !important;}
</style>

<div class="row" id="over-slide">
			<div class="span3 overall-score-criterion">
            
                    <ul>	
							<?php if(get_post_meta($post->ID, 'csc_criterion_1', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_1', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_1_score', true) ?></span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_1_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
							<?php if(get_post_meta($post->ID, 'csc_criterion_2', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_2', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_2_score', true) ?></span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_2_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
							<?php if(get_post_meta($post->ID, 'csc_criterion_3', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_3', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_3_score', true)?></span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_3_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
							<?php if(get_post_meta($post->ID, 'csc_criterion_4', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_4', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_4_score', true) ?></span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_4_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
							<?php if(get_post_meta($post->ID, 'csc_criterion_5', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_5', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_5_score', true) ?></span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_5_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
                            <?php if(get_post_meta($post->ID, 'csc_criterion_6', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_6', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_6_score', true) ?></span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_6_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
                            <?php if(get_post_meta($post->ID, 'csc_criterion_7', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_7', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_7_score', true) ?></span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_7_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
                            <?php if(get_post_meta($post->ID, 'csc_criterion_8', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_8', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_8_score', true) ?></span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_8_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
                            <?php if(get_post_meta($post->ID, 'csc_criterion_9', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_9', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_9_score', true) ?></span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_9_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
                            <?php if(get_post_meta($post->ID, 'csc_criterion_10', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_10', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_10_score', true) ?></span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_10_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
						</ul>
					</div>
                    

   <div class="span3 overall-score">
    <div class="row">
                     
                     
                     <span style="display:none" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing" class="entry-title"><span itemprop="name"><?php the_title(); ?></span></span>
                     <span style="display:none" itemprop="reviewBody"><?php  the_excerpt(); ?></span>
                     <meta itemprop="datePublished" content="<?php the_time( 'Y-m-d' ); ?>" />

                     <div class="span3" style="position:relative" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                    
                     <meta itemprop="worstRating" content = "1"/>
                     <meta itemprop="bestRating" content = "10"/>
                     <span style="display:none" itemprop="ratingValue" class="rating points"><?php echo $totalscore ?></span>
                     <span style="display:none" class="updated"><?php the_time( 'Y-m-d' ); ?></span>
                     
                     <h2><?php echo $totalscore ?> <?php echo get_post_meta($post->ID, 'csc_overall_text', true); ?></h2>

                     </div>
    </div>
   </div>				

                    
                    <?php if(get_post_meta($post->ID, 'csc_overall_score_summary', true)): ?>
                    <div class="span3" style="background-color:#f8f8f8">
                    <div class="row">
                     
                     
                     <div class="span3 overall-summary" style=" padding-right:0; padding-left:0;" itemprop="description"><?php echo get_post_meta($post->ID, 'csc_overall_score_summary', true); ?>
                     </div>
					
                     </div>
                     </div>
                     <?php endif; ?>
                     <span style="display:none" itemprop="reviewRating"><?php echo $totalscore ?></span>	
        <span style="display:none" itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php the_author_posts_link(); ?></span></span>
			
	</div>
</div>

<?php endif; 
// end
?>

<?php 
//stars system
if( rwmb_meta('csc_reviews_system') == 'stars' ): ?>
<?php 
$starscore1 = get_post_meta($post->ID, 'csc_criterion_1_score', true) / 2;
$starscore1 = round($starscore1/.5)*.5;

$starscore2 = get_post_meta($post->ID, 'csc_criterion_2_score', true) / 2;
$starscore2 = round($starscore2/.5)*.5;

$starscore3 = get_post_meta($post->ID, 'csc_criterion_3_score', true) / 2;
$starscore3 = round($starscore3/.5)*.5;

$starscore4 = get_post_meta($post->ID, 'csc_criterion_4_score', true) / 2;
$starscore4 = round($starscore4/.5)*.5;

$starscore5 = get_post_meta($post->ID, 'csc_criterion_5_score', true) / 2;
$starscore5 = round($starscore5/.5)*.5;

$starscore6 = get_post_meta($post->ID, 'csc_criterion_6_score', true) / 2;
$starscore6 = round($starscore6/.5)*.5;

$starscore7 = get_post_meta($post->ID, 'csc_criterion_7_score', true) / 2;
$starscore7 = round($starscore7/.5)*.5;

$starscore8 = get_post_meta($post->ID, 'csc_criterion_8_score', true) / 2;
$starscore8 = round($starscore8/.5)*.5;

$starscore9 = get_post_meta($post->ID, 'csc_criterion_9_score', true) / 2;
$starscore9 = round($starscore9/.5)*.5;

$starscore10 = get_post_meta($post->ID, 'csc_criterion_10_score', true) / 2;
$starscore10 = round($starscore10/.5)*.5;

$starscore = $totalscore / 2;
$starscore = round($starscore/.5)*.5;
?>
<style>
.overall-score-criterion ul li{padding:12px 0 4px !important; min-height:28px;}
.overall-score h2 img{ padding:0; margin:0 !important; margin-right:10px !important; padding-bottom:0px;}
.over-more{ top:14px !important;}
</style>
<div class="row">
				
<div class="span3">
<div class="row" id="over-slide">

			<div class="span3 overall-score-criterion">
            
                    <ul>	
							<?php if(get_post_meta($post->ID, 'csc_criterion_1', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_1', true); ?></h4>
                            <span class="score"><img src="<?php echo get_template_directory_uri(); ?>/images/stars/big_<?php echo $starscore1 ?>.png" alt="" /></span>
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
							<?php if(get_post_meta($post->ID, 'csc_criterion_2', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_2', true); ?></h4>
                            <span class="score"><img src="<?php echo get_template_directory_uri(); ?>/images/stars/big_<?php echo $starscore2 ?>.png" alt="" /></span>
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
							<?php if(get_post_meta($post->ID, 'csc_criterion_3', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_3', true); ?></h4>
                            <span class="score"><img src="<?php echo get_template_directory_uri(); ?>/images/stars/big_<?php echo $starscore3 ?>.png" alt="" /></span>
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
							<?php if(get_post_meta($post->ID, 'csc_criterion_4', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_4', true); ?></h4>
                            <span class="score"><img src="<?php echo get_template_directory_uri(); ?>/images/stars/big_<?php echo $starscore4 ?>.png" alt="" /></span>
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
                            <?php if(get_post_meta($post->ID, 'csc_criterion_5', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_5', true); ?></h4>
                            <span class="score"><img src="<?php echo get_template_directory_uri(); ?>/images/stars/big_<?php echo $starscore5 ?>.png" alt="" /></span>
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
                            <?php if(get_post_meta($post->ID, 'csc_criterion_6', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_6', true); ?></h4>
                            <span class="score"><img src="<?php echo get_template_directory_uri(); ?>/images/stars/big_<?php echo $starscore6 ?>.png" alt="" /></span>
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
                            <?php if(get_post_meta($post->ID, 'csc_criterion_7', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_7', true); ?></h4>
                            <span class="score"><img src="<?php echo get_template_directory_uri(); ?>/images/stars/big_<?php echo $starscore7 ?>.png" alt="" /></span>
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
                            <?php if(get_post_meta($post->ID, 'csc_criterion_8', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_8', true); ?></h4>
                            <span class="score"><img src="<?php echo get_template_directory_uri(); ?>/images/stars/big_<?php echo $starscore8 ?>.png" alt="" /></span>
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
                            <?php if(get_post_meta($post->ID, 'csc_criterion_9', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_9', true); ?></h4>
                            <span class="score"><img src="<?php echo get_template_directory_uri(); ?>/images/stars/big_<?php echo $starscore9 ?>.png" alt="" /></span>
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
                            <?php if(get_post_meta($post->ID, 'csc_criterion_10', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_10', true); ?></h4>
                            <span class="score"><img src="<?php echo get_template_directory_uri(); ?>/images/stars/big_<?php echo $starscore10 ?>.png" alt="" /></span>
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
						</ul>
					</div>
                    
                    
   <div class="span3 overall-score">
    <div class="row">

                     
                     <span style="display:none" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing" class="entry-title"><span itemprop="name"><?php the_title(); ?></span></span>
                     <span style="display:none" itemprop="reviewBody"><?php  the_excerpt(); ?></span>
                     <meta itemprop="datePublished" content="<?php the_time( 'Y-m-d' ); ?>" />

                     <div class="span3" style="position:relative" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                    
                     <meta itemprop="worstRating" content = "1"/>
                     <meta itemprop="bestRating" content = "5"/>
                     <span style="display:none" itemprop="ratingValue" class="rating points"><?php echo $starscore ?></span>
                     <span style="display:none" class="updated"><?php the_time( 'Y-m-d' ); ?></span>
                     
                     <h2><img src="<?php echo get_template_directory_uri(); ?>/images/stars/big_<?php echo $starscore ?>.png" alt="" /> <?php echo get_post_meta($post->ID, 'csc_overall_text', true); ?></h2>
                     

                     </div>
    </div>
   </div>
                    
                     <?php if(get_post_meta($post->ID, 'csc_overall_score_summary', true)): ?>
                    <div class="span3" style="background-color:#f8f8f8">
                    <div class="row">
                     
                     
                     <div class="span3 overall-summary" style=" padding-right:0; padding-left:0;" itemprop="description"><?php echo get_post_meta($post->ID, 'csc_overall_score_summary', true); ?>
                     </div>
					
                     </div>
                     </div>
                     <?php endif; ?>
                     <span style="display:none" itemprop="reviewRating"><?php echo $starscore ?></span>	
        <span style="display:none" itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php the_author_posts_link(); ?></span></span>
                 </div>
              </div>
                    
                     
                     
			
	</div>
</div>

<?php endif; 
//stars end
?>
<?php 
//percent system
if( rwmb_meta('csc_reviews_system') == 'percentage' ): ?>


<style>
.overall-score-criterion ul li{ border-bottom: none !important; min-height:28px; list-style:none !important;}
</style>

<div class="row" id="over-slide">
			<div class="span3 overall-score-criterion">
            
                    <ul>	
							<?php if(get_post_meta($post->ID, 'csc_criterion_1', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_1', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_1_score', true)*10 ?>%</span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_1_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
							<?php if(get_post_meta($post->ID, 'csc_criterion_2', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_2', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_2_score', true)*10 ?>%</span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_2_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
							<?php if(get_post_meta($post->ID, 'csc_criterion_3', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_3', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_3_score', true)*10 ?>%</span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_3_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
							<?php if(get_post_meta($post->ID, 'csc_criterion_4', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_4', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_4_score', true)*10 ?>%</span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_4_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
							<?php if(get_post_meta($post->ID, 'csc_criterion_5', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_5', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_5_score', true)*10 ?>%</span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_5_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
                            <?php if(get_post_meta($post->ID, 'csc_criterion_6', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_6', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_6_score', true)*10 ?>%</span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_6_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
                            <?php if(get_post_meta($post->ID, 'csc_criterion_7', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_7', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_7_score', true)*10 ?>%</span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_7_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
                            <?php if(get_post_meta($post->ID, 'csc_criterion_8', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_8', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_8_score', true)*10 ?>%</span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_8_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
                            <?php if(get_post_meta($post->ID, 'csc_criterion_9', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_9', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_9_score', true)*10 ?>%</span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_9_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
                            <?php if(get_post_meta($post->ID, 'csc_criterion_10', true)): ?>
                            <li>
							<h4><?php echo get_post_meta($post->ID, 'csc_criterion_10', true); ?></h4>
                            <span class="score"><?php echo get_post_meta($post->ID, 'csc_criterion_10_score', true)*10 ?>%</span>
                            
                            <div class="clear"></div>
                            
                            <div class="contbar progress progress-striped active">
                            <div class="bar" style="width:<?php echo get_post_meta($post->ID, 'csc_criterion_10_score', true)*10 ?>%"></div>
                            </div>
                            <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
							<?php endif; ?>
                            
						</ul>
					</div>
                    
                    

   <div class="span3 overall-score">
    <div class="row">
                     
                     
                     <span style="display:none" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing" class="entry-title"><span itemprop="name"><?php the_title(); ?></span></span>
                     <span style="display:none" itemprop="reviewBody"><?php  the_excerpt(); ?></span>
                     <meta itemprop="datePublished" content="<?php the_time( 'Y-m-d' ); ?>" />

                     <div class="span3" style="position:relative" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                    
                     <meta itemprop="worstRating" content = "1"/>
                     <meta itemprop="bestRating" content = "100"/>
                     <span style="display:none" itemprop="ratingValue" class="rating points"><?php echo $totalscore*10 ?>%</span>
                     <span style="display:none" class="updated"><?php the_time( 'Y-m-d' ); ?></span>
                     
                     <h2><?php echo $totalscore*10 ?>% <?php echo get_post_meta($post->ID, 'csc_overall_text', true); ?></h2>

                     </div>
    </div>
   </div>				

                    
                    
                    <?php if(get_post_meta($post->ID, 'csc_overall_score_summary', true)): ?>
                    <div class="span3" style="background-color:#f8f8f8">
                    <div class="row">
                     
                     
                     <div class="span3 overall-summary" style=" padding-right:0; padding-left:0;"  itemprop="description"><?php echo get_post_meta($post->ID, 'csc_overall_score_summary', true); ?>
                     </div>
					
                     </div>
                     </div>
                     <?php endif; ?>
                     <span style="display:none" itemprop="reviewRating"><?php echo $totalscore*10 ?>%</span>	
        <span style="display:none" itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php the_author_posts_link(); ?></span></span>
			
	</div>
</div>

<?php endif; 
// end
?>


</div>
</div>

<?php endif; ?>