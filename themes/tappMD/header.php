<?php
/*
 * @ Created by NORDiX http://www.wp-theme.pro
 */
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="apple-touch-fullscreen" content="yes" />

<title><?php
global $page, $paged;
wp_title( '|', true, 'right' );
bloginfo( 'name' );
$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) )
echo " | $site_description";
if ( $paged >= 2 || $page >= 2 )
echo ' | ' . sprintf( __( 'Page %s', 'csc-themewp' ), max( $paged, $page ) );
?></title>

<!-- Custom Header/Mobile Icons -->

		<link rel="apple-touch-icon" href="<?php echo csc_option('csc_72'); ?>">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo csc_option('csc_72'); ?>">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo csc_option('csc_114'); ?>">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo csc_option('csc_144'); ?>">
		<link rel="apple-touch-startup-image" sizes="2048x1496" href="<?php echo csc_option('csc_2048'); ?>">
		<link rel="apple-touch-startup-image" sizes="1536x2008" href="<?php echo csc_option('csc_1536'); ?>">
		<link rel="apple-touch-startup-image" sizes="1024x748" href="<?php echo csc_option('csc_1024'); ?>">
		<link rel="apple-touch-startup-image" sizes="768x1004" href="<?php echo csc_option('csc_768'); ?>">
		<link rel="apple-touch-startup-image" sizes="640x920" href="<?php echo csc_option('csc_640'); ?>">
		<link rel="apple-touch-startup-image" sizes="320x460" href="<?php echo csc_option('csc_320'); ?>">
        
<link rel="shortcut icon" href="<?php echo csc_option('csc_favicon'); ?>"/>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php wp_enqueue_script( 'jquery' ); ?>
<?php include CSC_BASE . 'typo.php'; ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<!--[if IE 8]> 
<link href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" rel= "stylesheet" media= "all" /> 
<![endif]-->
<?php wp_head();?>

<?php if (csc_option('csc_sharethis')) {?>
<!--Include ShareThis-->
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<?php if ( wp_is_mobile() ) { 
	/*Show Add To Home if Mobile */
	/* Don't Show ShareThis On mobile */
	?>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/add2home.css">
		<script src="<?php echo get_template_directory_uri(); ?>/js/add2home.js"></script> 

<?php } else { ?>
<script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>
<?php } ?>

<script type="text/javascript">stLight.options({publisher: "<?php echo csc_option('csc_sharethis')?>", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<script type="text/javascript">
	stLight.options({
		publisher:'<?php echo csc_option('csc_sharethis'); ?>',
                headerTitle:'<?php bloginfo( 'name' ); ?>'
	});
</script>

<?php } ?>

</head>

<body <?php body_class();?>>
        
<?php  
include CSC_BASE. 'css/typo-css.php'; 
if ( csc_option('auto_stylesheet') ) {
		wp_register_style( 'color_stylesheet', csc_option('auto_stylesheet'), array(), false, false, 'all' );
		wp_enqueue_style( 'color_stylesheet');
    }
?>
<?php csc_include( 'cat_set' );?>
 <div class="top-bar">
 <div class="container" style="position:relative;">
        
 <div class="row" style=" margin-left:-30px; margin-right:-30px; padding-top:5px; padding-bottom:5px;">
 
 <div class="span6" style="margin-left:30px;"><span style="color:#fff; float:left; margin-right:15px; margin-top:4px; font-size:12px !important;"><i class="icon-time"></i> <?php echo date("F j, Y");  ?></span>
   <?php $defaults = array(
	'theme_location'  => 'csc-theme-menu-top',
	'menu'            => '', 
	'container'       => 'div', 
	'container_class' => '', 
	'container_id'    => '',
	'menu_class'      => 'menu-t', 
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'csc_nav_fallback',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s </ul>',
	'depth'           => 0,
	'walker'          => ''
); ?>

<?php wp_nav_menu( $defaults ); ?>

  </div>
 
  <?php if ( csc_option('csc_social_top_page') ) {?>

  <div class="span6" id="top">
 <?php include CSC_BASE. 'socialize.php'; ?>
  </div>

 <?php } ?>
 
  
  
</div>
</div> 
</div>


<?php if (rwmb_meta('csc_banner_top')):?>
<div class="container-fluid">
 <div class="row-fluid">
  <div class="span12">
      <?php 
	  
		csc_banner_full('csc_banner_top' , '<div style="text-align:center;">' , '</div>' ); 
		
	  ?>
   </div>  
 </div>    
</div>
<?php endif;?>
     
<div class="container basis" style="position:relative; background:#ffffff;<?php if (csc_option('csc_page_margin')){ echo 'margin-top:'.csc_option('csc_page_margin'); }?>">
<?php 
if ( is_front_page() ) {?>
<?php if (csc_option('csc_hide_hotnews') && !csc_option('csc_below_hotnews')):?>

      <?php csc_include( 'top_news' ); ?>

<?php  endif;?>
<?php }?>


 <div class="row" style="margin-left:0;">

 
<!-- Main
================================================== -->

 
<div class="container" style="position:relative;">
<?php if ( wp_is_mobile() ) { 
//display mobile menu  ?>
<!--MOBILE NAV MENU -->
<div style="float:right; margin-bottom:5px;">
<a href="#" class="menu-trigger icon-reorder mobile-nav">&nbsp;</a>
        
	<nav style="display:none;">
		<?php $defaults = array(
            'theme_location'  => 'csc-theme-mobile-nav',
            'menu'            => '', 
            'container'       => '', 
            'container_class' => '', 
            'container_id'    => 'menu-mobile-nav',
            'menu_class'      => 'menu', 
            'menu_id'         => 'menu',
            'echo'            => true,
            'fallback_cb'     => 'csc_nav_fallback',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth'           => 0,
            'walker'          => new Color_Menu_Walker
        ); ?>
        
        <?php wp_nav_menu( $defaults ); ?>
                  
	</nav>	

</div>
<!-- /MOBILE NAV MENU -->
<?php } ?>
<!-- Logo / ads
================================================== -->
<header class="header">
<div class="row">


      <div class="span3" style=" <?php if (csc_option('csc_logo_m_t')){ echo 'margin-top:'.csc_option('csc_logo_m_t').';'; }?> <?php if (csc_option('csc_logo_m_b')){ echo 'margin-bottom:'.csc_option('csc_logo_m_b').';'; }?>">
              
      
      <?php if ( csc_option('csc_logo_theme') ) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" src="<?php echo csc_option('csc_logo_theme'); ?>" /></a>
                            
	<?php } else {?>
                            
       <div class="left logotext">                    
                            
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><h2><?php echo csc_option('csc_text_logo'); ?></h2></a>
        
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><h3><?php echo csc_option('csc_sub_logo'); ?></h3></a>
        
      </div>
      
      <?php }?>
                          
      </div>
      <div class="span9 banner_head_right">
      	<div class="Teamer  Teamer_Tapp">
		    <div class="teamer_wrapper">
		        <div class="teamer_content">
               		<ul>
                            <?php head_contributors(); ?>
                            
					</ul>
	        	</div>
	    	</div>
		</div>    
      
      </div>
</div>
<!-- Main menu
================================================== -->
<?php if ( wp_is_mobile() ) { 
echo '<div class="menutopdefault"></div>';

	/* Don't Show Main Nav On mobile */
} else { 

//begin desktop only view ?>
<div class="row menutopdefault default">
 <div class="span10">

<?php $defaults = array(
	'theme_location'  => 'csc-theme-menu-main',
	'menu'            => '', 
	'container'       => 'nav', 
	'container_class' => 'row', 
	'container_id'    => 'menu-top',
	'menu_class'      => 'menu span12', 
	'menu_id'         => 'mainmenu',
	'echo'            => true,
	'fallback_cb'     => 'csc_nav_fallback',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => new Color_Menu_Walker
); ?>

<?php wp_nav_menu( $defaults ); ?>

 </div>
 
</div>

<?php //end desktop view only
	} ?>

</header>

</div>