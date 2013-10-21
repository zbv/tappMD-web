<?php

//Display Login Image With No Link

function wpc_url_login(){
	return "#";
}
add_filter('login_headerurl', 'wpc_url_login');

// Custom WordPress Admin Color Scheme
function admin_css() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/css/admin.css' );
}
add_action('admin_print_styles', 'admin_css' );

// Custom WordPress Login Screen
function login_css() {
	wp_enqueue_style( 'login_css', get_template_directory_uri() . '/css/login.css' );
}
add_action('login_head', 'login_css');

function csc_check_WP_version(){
global $wp_version, $load_msg;
	if (version_compare($wp_version,"3.4.1","<"))
	{
		$load_msg = '<div id="notice" class="error highlight"><p><strong><h3>WORDPRESS VERSION ERROR - YOU ARE USING VERSION '.$wp_version.' ! </h3>This theme requires WordPress Version 3.4.1 or higher to run. Please upgrade your WordPress version!</strong> <br /><br /> Please see WordPress documentation : <a href="http://codex.wordpress.org/Upgrading_WordPress">How can I upgrade my WordPress version?</a><br /><br /></div>';
	}else{
		$load_msg = ""; 
	}
	
	return $load_msg;
}

if (version_compare(PHP_VERSION, '5.0.0', '<')) {
global $load_msg;

	$PHP_version_error = '<div id="notice" class="error"><p><strong><h3>THEME ERROR!</h3>This theme requires PHP Version 5 or higher to run. Please upgrade your php version!</strong> <br />You can contact your hosting provider to upgrade PHP version of your website.</p> </div>';
	if(is_admin()){	
		add_action('admin_notices','errorfunction');
	}else{
		echo $PHP_version_error;
		die;
	}
	
	function errorfunction(){
		global $PHP_version_error;
		echo $PHP_version_error;
	}
	
	return $load_msg;
}

if(csc_check_WP_version()){
	if(is_admin()){
		add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $load_msg, '"' ) . '";' ) );
	}
	else{
		exit($load_msg);
	} 
}else{
	
	global $pagenow;
	
		if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
			header( 'Location: '.admin_url().'admin.php?page=options-framework' ) ;
		}

}

/* Load the Theme Functions. */

////////////////////////////////////////////////////////////////////

if( ! defined('CSC_BASE' ) ) 
{ define( 'CSC_BASE', get_template_directory().'/' ); }

if( ! defined('CSC_BASE_URL' ) ) 
{ define( 'CSC_BASE_URL', get_template_directory_uri().'/' ); }

if( ! defined('CSC_BASE_CSS' ) ) 
{ define( 'CSC_BASE_CSS', get_stylesheet_directory_uri().'/' ); }

$themename = wp_get_theme();

if( ! defined('CSC_NAME' ) ) 
{ define( 'CSC_NAME', $themename ); }

function csc_include($template){
	require_once CSC_BASE.'functions/includes/'.$template.'.php';
}

function csc_include_w($widgets){
	require_once CSC_BASE.'functions/includes/widgets/'.$widgets.'.php';
}

///////////////////////////////////////////////////////////////////////


add_action('after_setup_theme', 'cscstudio_setup');

if ( ! function_exists( 'cscstudio_setup' ) ):

function cscstudio_setup() {
	
	register_nav_menu( 'csc-theme-menu-main', __( 'Main Navigation' , 'csc-theme') );
	register_nav_menu( 'csc-theme-menu-footer', __( 'Footer Navigation' , 'csc-theme') );
	register_nav_menu( 'csc-theme-menu-side', __( 'Side Navigation' , 'csc-theme') );
	register_nav_menu( 'csc-theme-menu-top', __( 'Top Navigation' , 'csc-theme') );
	register_nav_menu( 'csc-theme-mobile-nav', __( 'Mobile Navigation' , 'csc-theme') );

	wp_create_nav_menu( 'Main Navigation', array( 'slug' => 'csc-theme-menu-main' ) );
	wp_create_nav_menu( 'Top Navigation', array( 'slug' => 'csc-theme-menu-top' ) );
	wp_create_nav_menu( 'Side Navigation', array( 'slug' => 'csc-theme-menu-side' ) );
	wp_create_nav_menu( 'Footer Navigation', array( 'slug' => 'csc-theme-menu-footer' ) );
	wp_create_nav_menu( 'Mobile Navigation', array( 'slug' => 'csc-theme-mobile-nav' ) );

}
endif;

add_action('after_setup_theme', 'csc_languages_setup');
function csc_languages_setup(){
    load_theme_textdomain('csc-themewp', get_template_directory() . '/languages');
}

$shortname = 'csc';

function theme_csc_styles(){
	
wp_enqueue_style('prettyPhoto', get_template_directory_uri().'/css/prettyPhoto.css', false, false, 'all');
wp_enqueue_style('font-awesome', get_template_directory_uri().'/css/font-awesome.min.css', false, false, 'all');
wp_enqueue_style('flex-slider', get_template_directory_uri().'/css/flexslider.min.css', false, false, 'all');
wp_enqueue_style('mediaelementplayer', get_template_directory_uri().'/js/build/mediaelementplayer.min.css', false, false, 'all');
wp_enqueue_style('google-code-prettify', get_template_directory_uri().'/js/google-code-prettify/prettify.css', false, false, 'all');
wp_enqueue_style('tapp-style', get_template_directory_uri().'/css/tapp-style.css', false, false, 'all');
}
add_action('wp_enqueue_scripts', 'theme_csc_styles');

//////////////////////////////////////////////////////////////////////

add_action( 'wp_enqueue_scripts', 'theme_csc_scripts' );

function theme_csc_scripts() {

  wp_register_script( 'totop', get_template_directory_uri() . '/js/jquery.ui.totop.js', array('jquery'), '1.1', true);
  wp_register_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'),'', true);
  wp_register_script( 'easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'),'', true);
  wp_register_script( 'jquerycycle', get_template_directory_uri() . '/js/jquery.cycle.all.js', array('jquery'),'', true);
  wp_register_script( 'google-code-prettify', get_template_directory_uri() . '/js/google-code-prettify/prettify.js', array('jquery'),'', true);	
  wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'),'', true);
  wp_register_script( 'bootstrap-application', get_template_directory_uri() . '/js/application.js', array('jquery'),'', true);
  wp_register_script( 'mediaelement', get_template_directory_uri() . '/js/build/mediaelement-and-player.min.js', array('jquery'),'', true);
  wp_register_script( 'gmap3', get_template_directory_uri() . '/js/gmap3.min.js', array('jquery'),'', true);
  wp_register_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'),'', true);
  wp_register_script( 'flex', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'),'', true);
  wp_register_script( 'resp', get_template_directory_uri() . '/js/responsiveslides.min.js', array('jquery'),'', true);
  wp_register_script( 'csctip', get_template_directory_uri() . '/js/jquery.csctip.js', array('jquery'),'', true);
  wp_register_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery'),'', true);
  wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'),'', true);
  wp_register_script( 'custom', get_template_directory_uri() . '/js/custom.js', array('jquery'),'', true);

  wp_enqueue_script( 'totop');
  wp_enqueue_script( 'prettyPhoto');
  wp_enqueue_script( 'easing');
  wp_enqueue_script( 'jquerycycle');
  wp_enqueue_script( 'google-code-prettify');	
  wp_enqueue_script( 'bootstrap');
  wp_enqueue_script( 'bootstrap-application');
  wp_enqueue_script( 'mediaelement');
  wp_enqueue_script( 'isotope');
  wp_enqueue_script( 'flex');
  wp_enqueue_script( 'resp');
  wp_enqueue_script( 'superfish');
  wp_enqueue_script( 'modernizr');
  wp_enqueue_script( 'custom');


}

function mytheme_fonts() {
include CSC_BASE . 'typo.php';
$protocol = is_ssl() ? 'https' : 'http';
wp_enqueue_style( 'mytheme-allfonts', "$protocol://fonts.googleapis.com/css?family=$font_content:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|$font_title_pages:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|$font_title_page:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|$font_title_page2:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|$font_title_page3:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|$font_title_menu:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|$font_logo:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|$font_sub_logo:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|$font_title_body:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'" );
}
add_action( 'wp_enqueue_scripts', 'mytheme_fonts' );

///////////////////////////////////////////////////////////////

function getPostViews( $postID = '' ){

	global $post;
	if( empty($postID) ) $postID = $post->ID ;
	
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        $count = "0";
    }
    return $count;
}

function setPostViews() {

	global $post;
	$postID = $post->ID ;
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


/////////////////////////////////////////////////////////////////////////

if ( !function_exists( 'optionsframework_init' ) ) {


	if ( CSC_BASE_CSS == CSC_BASE ) {
		define('OPTIONS_FRAMEWORK_URL', CSC_BASE . 'framework/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', CSC_BASE_URL . 'framework/');

	} else {
		define('OPTIONS_FRAMEWORK_URL', CSC_BASE . 'framework/');
		define('OPTIONS_FRAMEWORK_DIRECTORY',  CSC_BASE_CSS . 'framework/');
	}

	require_once OPTIONS_FRAMEWORK_URL . 'options-framework.php';
	require_once OPTIONS_FRAMEWORK_URL . 'options-sb.php';

}

//////////////////////////////////////////////////////////////////////


if ( function_exists('register_sidebar') )
{
	$sidebar1 = array(
				  'Home Magazine',
				  'Sidebar One',
				  'Sidebar Two',
				  'Home Sidebar One',
				  'Home Sidebar Two',
				  'Post Side Bar 1',
				  'Post Side Bar 2',
				  'Author Side Bar 1',
				  'Author Side Bar 2',
				  'Category Side Bar 1',
				  'Category Side Bar 2',
				  'Footer 1',
				  'Footer 2', 
				  'Footer 3',
				  'Footer 4'
				  );
	
	$sidebar2 = csc_option('cscsidebar');
	
	$sidebars = array_merge( (array)$sidebar1, (array)$sidebar2);
	$sidebars = array_filter($sidebars);
	
	foreach ($sidebars as $sidebar)
	{
		register_sidebar(array(
		'name'=> $sidebar,
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3></div>'
		));
	}
}

//////////////////////////////////////////////////////////////////////

define( 'RWMB_URL', trailingslashit( CSC_BASE_URL. 'functions/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( CSC_BASE . 'functions/meta-box' ) );
require_once RWMB_DIR . 'meta-box.php';
require_once CSC_BASE. 'functions/meta-options.php';
require_once CSC_BASE. 'functions/theme-set.php';
require_once CSC_BASE. 'functions/aq_resizer.php';
require_once CSC_BASE. 'functions/previous-and-next-post.php';
require_once CSC_BASE. 'functions/multi-post-thumbnails.php';
define('SHORT', CSC_BASE . 'functions');
require_once CSC_BASE. 'functions/loop_widgets.php';
if(!class_exists('TwitterOAuth',false)) {
	require_once CSC_BASE.'functions/includes/twitteroauth/twitteroauth.php';
}
require_once CSC_BASE. 'functions/slider-csc.php';
require_once CSC_BASE. 'functions/shortcodes/columns.php';
require_once CSC_BASE. 'functions/shortcodes/misk.php';
require_once CSC_BASE. 'functions/shortcodes/icon_fa.php';
require_once CSC_BASE. 'functions/shortcodes/columns-t.php';
require_once CSC_BASE. 'functions/shortcodes/shortcode-t.php';
require_once CSC_BASE. 'functions/shortcodes/icon-fa-t.php';


//////////////////////////////////////////////////////////////////////

function csc_nav_fallback(){
	echo '<div>'.__( 'You can use WP menu builder to build menus' , 'csc-themewp' ).'</div>';
}

function my_widget_tag_cloud_args( $args ) {
	$args['number'] = 40;
	$args['largest'] = 12;
	$args['smallest'] = 14;
	$args['unit'] = 'px';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );


if ( function_exists( 'add_theme_support' ) )
    add_theme_support( 'automatic-feed-links' );


add_filter('widget_text', 'do_shortcode');
//////////////////////////////////////////////////////////////////////


if (class_exists('MultiPostThumbnails')) 
{ 
 $types = array('post','portfolio');
                foreach($types as $type) {
    new MultiPostThumbnails(array( 'label' => 'Secondary Image', 'id' => 'secondary-image', 'post_type' => $type ) ); 
    new MultiPostThumbnails(array( 'label' => 'Third Image', 'id' => 'third-image', 'post_type' => $type ) );
    new MultiPostThumbnails(array( 'label' => 'Fourth Image', 'id' => 'fourth-image', 'post_type' => $type ) );
    new MultiPostThumbnails(array( 'label' => 'Fifth Image', 'id' => 'fifth-image', 'post_type' => $type ) );
   
 }
}
 
function portfolio_thumbnail_url($pid){
	$image_id = get_post_thumbnail_id($pid);  
	$image_url = wp_get_attachment_image_src($image_id,'screen-shot');  
	return  $image_url[0];  
}

function custom_excerpt_length( $length ) {
	return 170;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


function string_limit_words($string, $word_limit)
{
       $words = explode(' ', $string, ($word_limit + 1));
       if(count($words) > $word_limit)
       array_pop($words);
       return implode(' ', $words);
}

function new_excerpt_more($more) {
     global $post;
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


function get_short_title($maxchar = 41){
	$title = get_the_title();
	if( iconv_strlen($title, 'utf-8') < $maxchar )
		return $title;
	$title = iconv_substr( $title, 0, $maxchar, 'utf-8' );
	$title = preg_replace('@(.*)\s[^\s]*$@s', '\\1 ...', $title);

	return $title;
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'blog-posts', 270, 200, true );
	add_image_size( 'portfolio_img_th', 300, 400, true );
	add_image_size( 'single_posts', 600, 600, true );
	add_image_size( 'home-slide', 940, 350, true );
	add_image_size( 'bg_slider', 112, 70, true );
	add_image_size('post-secondary-image-thumbnail', 1500, 1500, true);
}

function filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
 
add_filter('the_excerpt', 'filter_ptags_on_images');

///////////////////////////////////////////////////////////////////////////
function csc_wp_head()
{	
	global $paged;
	
	$head = '';
	
	if ( is_front_page() && $paged <= 1 ) {
		if ( csc_option('csc_seo_home_desc') <> '' ) {
			$head .= '<meta name="description" content="'. csc_option('csc_seo_home_desc') .'" />'."\n";
		}
		if ( csc_option('csc_seo_home_key') <> '' ) {
			$head .= '<meta name="keywords" content="'. csc_option('csc_seo_home_key') .'" />'."\n";
		}
	}
	
	echo $head;
}
if (csc_option('csc_seo_enable')) {
	add_action('wp_head', 'csc_wp_head');
}
//////////////////////////////////////////////////////////////////////////
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { 
$themename = wp_get_theme();
$themename = preg_replace("/\W/", "_", strtolower($themename) );
?>

<script type="text/javascript">
jQuery(document).ready(function() {
	

jQuery('.on-of').checkbox({empty:'<?php echo get_template_directory_uri(); ?>/framework/images/empty.png'});		

////////////////////////////////////////////////////////////////////

jQuery('#<?php echo $themename; ?>-csc_query_set-category_post').click(function() {
  		jQuery('#section-csc_query_post').fadeToggle(200);
		
		jQuery('#section-csc_query_portfolio,#section-csc_query_tags,#section-csc_query_page,#section-csc_query_custom_post').fadeOut(200);
	});
	
	if (jQuery('#<?php echo $themename; ?>-csc_query_set-category_post:checked').val() !== undefined) {
		jQuery('#section-csc_query_post').show();
	}
	

////////////////////////////////////////////////////////////////////

jQuery('#<?php echo $themename; ?>-csc_query_set-category_custom_post').click(function() {
  		jQuery('#section-csc_query_custom_post').fadeToggle(200);
		
		jQuery('#section-csc_query_portfolio,#section-csc_query_tags,#section-csc_query_page,#section-csc_query_post').fadeOut(200);
	});
	
	if (jQuery('#<?php echo $themename; ?>-csc_query_set-category_custom_post:checked').val() !== undefined) {
		jQuery('#section-csc_query_custom_post').show();
	}	

////////////////////////////////////////////////////////////////////
	
jQuery('#<?php echo $themename; ?>-csc_query_set-category_port').click(function() {
		
		jQuery('#section-csc_query_post,#section-csc_query_tags,#section-csc_query_page,#section-csc_query_custom_post').fadeOut(200);
	});
	

////////////////////////////////////////////////////////////////////
	
jQuery('#<?php echo $themename; ?>-csc_query_set-category_slid').click(function() {
		
		jQuery('#section-csc_query_post,#section-csc_query_tags,#section-csc_query_page,#section-csc_query_custom_post').fadeOut(200);
	});


////////////////////////////////////////////////////////////////////
	
jQuery('#<?php echo $themename; ?>-csc_query_set-category_tags').click(function() {
  		jQuery('#section-csc_query_tags').fadeToggle(200);
		
		jQuery('#section-csc_query_post,#section-csc_query_portfolio,#section-csc_query_page,#section-csc_query_custom_post').fadeOut(200);
	});
	
	if (jQuery('#<?php echo $themename; ?>-csc_query_set-category_tags:checked').val() !== undefined) {
		jQuery('#section-csc_query_tags').show();
	}
	
////////////////////////////////////////////////////////////////////
	
jQuery('#<?php echo $themename; ?>-csc_query_set-category_page').click(function() {
  		jQuery('#section-csc_query_page').fadeToggle(200);
		
		jQuery('#section-csc_query_post,#section-csc_query_tags,#section-csc_query_portfolio,#section-csc_query_custom_post').fadeOut(200);
	});
	
	if (jQuery('#<?php echo $themename; ?>-csc_query_set-category_page:checked').val() !== undefined) {
		jQuery('#section-csc_query_page').show();
	}

////////////////////////////////////////////////////////////////////
		
jQuery('#<?php echo $themename; ?>-csc_slider_type-nivo').click(function() {
	
  		jQuery('#section-nivo_csc_slices,#section-nivo_csc_speed,#section-nivo_csc_arr,#section-nivo_csc_effect,#section-nivo_csc_pause').fadeToggle(200);
		
		jQuery(' #section-csc_flex_anim, #section-csc_flex_dir, #section-csc_flex_ea, #section-csc_flex_pause, #section-csc_flex_spa').fadeOut(200);
		
	});
	
	if (jQuery('#<?php echo $themename; ?>-csc_slider_type-nivo:checked').val() !== undefined) {
		jQuery('#section-nivo_csc_slices,#section-nivo_csc_speed,#section-nivo_csc_arr,#section-nivo_csc_effect,#section-nivo_csc_pause').show();
		
		jQuery(' #section-csc_flex_anim, #section-csc_flex_dir, #section-csc_flex_ea, #section-csc_flex_pause, #section-csc_flex_spa').hide();
}	
	
////////////////////////////////////////////////////////////////////
		
jQuery('#<?php echo $themename; ?>-csc_slider_type-flex').click(function() {
	
  		jQuery('#section-nivo_csc_slices,#section-nivo_csc_speed,#section-nivo_csc_arr,#section-nivo_csc_effect,#section-nivo_csc_pause').fadeOut(200);
		
		jQuery(' #section-csc_flex_anim, #section-csc_flex_dir, #section-csc_flex_ea, #section-csc_flex_pause, #section-csc_flex_spa').fadeToggle(200);
	});
	
	if (jQuery('#<?php echo $themename; ?>-csc_slider_type-flex:checked').val() !== undefined) {
		
		jQuery('#section-nivo_csc_slices,#section-nivo_csc_speed,#section-nivo_csc_arr,#section-nivo_csc_effect,#section-nivo_csc_pause').hide();
		
		jQuery(' #section-csc_flex_anim, #section-csc_flex_dir, #section-csc_flex_ea, #section-csc_flex_pause, #section-csc_flex_spa').show();
}
////////////////////////slider two////////////////////////////////

jQuery('#<?php echo $themename; ?>-csc_query_set_2-category_post_2').click(function() {
  		jQuery('#section-csc_query_post_2').fadeToggle(200);
		
		jQuery('#section-csc_query_portfolio_2,#section-csc_query_tags_2,#section-csc_query_page_2,#section-csc_query_custom_post_2').fadeOut(200);
	});
	
	if (jQuery('#<?php echo $themename; ?>-csc_query_set_2-category_post_2:checked').val() !== undefined) {
		jQuery('#section-csc_query_post_2').show();
	}
	

////////////////////////////////////////////////////////////////////

jQuery('#<?php echo $themename; ?>-csc_query_set_2-category_custom_post_2').click(function() {
  		jQuery('#section-csc_query_custom_post_2').fadeToggle(200);
		
		jQuery('#section-csc_query_portfolio_2,#section-csc_query_tags_2,#section-csc_query_page_2,#section-csc_query_post_2').fadeOut(200);
	});
	
	if (jQuery('#<?php echo $themename; ?>-csc_query_set_2-category_custom_post_2:checked').val() !== undefined) {
		jQuery('#section-csc_query_custom_post_2').show();
	}	

////////////////////////////////////////////////////////////////////
	
jQuery('#<?php echo $themename; ?>-csc_query_set_2-category_port_2').click(function() {
		
		jQuery('#section-csc_query_post_2,#section-csc_query_tags_2,#section-csc_query_page_2,#section-csc_query_custom_post_2').fadeOut(200);
	});
	

////////////////////////////////////////////////////////////////////
	
jQuery('#<?php echo $themename; ?>-csc_query_set_2-category_slid_2').click(function() {
		
		jQuery('#section-csc_query_post_2,#section-csc_query_tags_2,#section-csc_query_page_2,#section-csc_query_custom_post_2').fadeOut(200);
	});


////////////////////////////////////////////////////////////////////
	
jQuery('#<?php echo $themename; ?>-csc_query_set_2-category_tags_2').click(function() {
  		jQuery('#section-csc_query_tags_2').fadeToggle(200);
		
		jQuery('#section-csc_query_post_2,#section-csc_query_portfolio_2,#section-csc_query_page_2,#section-csc_query_custom_post_2').fadeOut(200);
	});
	
	if (jQuery('#<?php echo $themename; ?>-csc_query_set_2-category_tags_2:checked').val() !== undefined) {
		jQuery('#section-csc_query_tags_2').show();
	}
	
////////////////////////////////////////////////////////////////////
	
jQuery('#<?php echo $themename; ?>-csc_query_set_2-category_page_2').click(function() {
  		jQuery('#section-csc_query_page_2').fadeToggle(200);
		
		jQuery('#section-csc_query_post_2,#section-csc_query_tags_2,#section-csc_query_portfolio_2,#section-csc_query_custom_post_2').fadeOut(200);
	});
	
	if (jQuery('#<?php echo $themename; ?>-csc_query_set_2-category_page_2:checked').val() !== undefined) {
		jQuery('#section-csc_query_page_2').show();
	}

////////////////////////////////////////////////////////////////////	
	
});
</script>

<?php }
?>