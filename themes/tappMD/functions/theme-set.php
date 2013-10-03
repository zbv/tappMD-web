<?php 

/////////////////////////////////////////////////////////////////////

class blogauthorGenerator {

function blog_author_info()	{

	$author_link = get_author_posts_url( get_the_author_meta( 'ID' ) );
	$author_name = get_the_author();
		$output = '<section style="padding-top:5px;">'.
	'<div class="span6"><div class="row">'.
	 
	 '<div class="span6 divider-strip author"><h3 itemprop="author">'.__('About the author &nbsp;&frasl;&nbsp;<span><a href="'.$author_link.'">','csc-themewp').$author_name.'</a></span></h3></div>'.
		'<div class="span1">'.get_avatar( get_the_author_meta('user_email'), '80' ).'</div>'.
		'<div class="span5">'.
			'<p>'.get_the_author_meta('short_bio').'</p>'.
		'</div>'.
	'</div></div><a style="display:none" href="https://plus.google.com/'.csc_option('csc_ga_id').'?rel=author">'.$author.'</a>'.
'</section>';
		return $output;
	}
	
}

function blog_author($function){
	global $_blogauthorGenerator;
	if($_blogauthorGenerator==NULL){
		$_blogauthorGenerator = new blogauthorGenerator;
	}
	$args = array_slice( func_get_args(), 1 );
	return call_user_func_array(array( &$_blogauthorGenerator, $function ), $args );
}



//////////////////////////////////////////////////////////////////////


function theme_queue_js(){
if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') )
  wp_enqueue_script( 'comment-reply' );
}
add_action('wp_print_scripts', 'theme_queue_js');

if ( ! function_exists( 'twentyeleven_comment' ) ) :

function twentyeleven_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'csc-themewp' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'csc-themewp' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'csc-themewp' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'csc-themewp' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'csc-themewp' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'csc-themewp' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'csc-themewp' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; 

if ( ! function_exists( 'twentyeleven_posted_on' ) ) :

function twentyeleven_posted_on() {
	printf( __( '<span class="sep">&nbsp;&nbsp; <i class="icon-user"></i>  Posted </span><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span> &nbsp;&nbsp; <i class="icon-folder-close"></i>  </span>', 'csc-themewp' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'csc-themewp' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

if ( ! function_exists( 'css_theme_posted_on' ) ) :

function css_theme_posted_on() {
	printf( __( '<span class="sep">Posted </span><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'csc-themewp' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'csc-themewp' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

//////////////////////////////////////////////////////////////////////

function my_search_form( $form ) {

    $form = '<form role="search" class="form-search row" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <div class="span3">
    <input class="input-medium search-query" type="text" value="' . get_search_query() . '" name="s" id="s" />
    </div>
    </form>';

    return $form;
}

add_filter( 'get_search_form', 'my_search_form' );

//////////////////////////////////////////////////////////////////////

function round_num($num, $to_nearest) {
   return floor($num/$to_nearest)*$to_nearest;
}

function pagenavi($before = '', $after = '') {
    global $wpdb, $wp_query;
    $pagenavi_options = array();
    $pagenavi_options['pages_text'] = ('Page %CURRENT_PAGE% of %TOTAL_PAGES%:');
    $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['first_text'] = ('First');
    $pagenavi_options['last_text'] = ('Last');
    $pagenavi_options['next_text'] = '&raquo;';
    $pagenavi_options['prev_text'] = '&laquo;';
    $pagenavi_options['dotright_text'] = '...';
    $pagenavi_options['dotleft_text'] = '...';
    $pagenavi_options['num_pages'] = 5; //continuous block of page numbers
    $pagenavi_options['always_show'] = 0;
    $pagenavi_options['num_larger_page_numbers'] = 0;
    $pagenavi_options['larger_page_numbers_multiple'] = 5;
 
    //If NOT a single Post is being displayed
    /*http://codex.wordpress.org/Function_Reference/is_single)*/
    if (!is_single()) {
        $request = $wp_query->request;
        $posts_per_page = intval(get_query_var('posts_per_page'));
        //Retrieve variable in the WP_Query class.
        /*http://codex.wordpress.org/Function_Reference/get_query_var*/
        $paged = intval(get_query_var('paged'));
        $numposts = $wp_query->found_posts;
        $max_page = $wp_query->max_num_pages;
        //empty - Determine whether a variable is empty
        if(empty($paged) || $paged == 0) {
            $paged = 1;
        }
 
        $pages_to_show = intval($pagenavi_options['num_pages']);
        $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
        $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
        $pages_to_show_minus_1 = $pages_to_show - 1;
        $half_page_start = floor($pages_to_show_minus_1/2);
        //ceil - Round fractions up (http://us2.php.net/manual/en/function.ceil.php)
        $half_page_end = ceil($pages_to_show_minus_1/2);
        $start_page = $paged - $half_page_start;
 
        if($start_page <= 0) {
            $start_page = 1;
        }
 
        $end_page = $paged + $half_page_end;
        if(($end_page - $start_page) != $pages_to_show_minus_1) {
            $end_page = $start_page + $pages_to_show_minus_1;
        }
        if($end_page > $max_page) {
            $start_page = $max_page - $pages_to_show_minus_1;
            $end_page = $max_page;
        }
        if($start_page <= 0) {
            $start_page = 1;
        }
 
        $larger_per_page = $larger_page_to_show*$larger_page_multiple;
        //round_num() custom function - Rounds To The Nearest Value.
        $larger_start_page_start = (round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
        $larger_start_page_end = round_num($start_page, 10) + $larger_page_multiple;
        $larger_end_page_start = round_num($end_page, 10) + $larger_page_multiple;
        $larger_end_page_end = round_num($end_page, 10) + ($larger_per_page);
 
        if($larger_start_page_end - $larger_page_multiple == $start_page) {
            $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
            $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
        }
        if($larger_start_page_start <= 0) {
            $larger_start_page_start = $larger_page_multiple;
        }
        if($larger_start_page_end > $max_page) {
            $larger_start_page_end = $max_page;
        }
        if($larger_end_page_end > $max_page) {
            $larger_end_page_end = $max_page;
        }
        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
            /*http://php.net/manual/en/function.str-replace.php */
            /*number_format_i18n(): Converts integer number to format based on locale (wp-includes/functions.php*/
            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
            echo $before.'<div class="pagenavi">'."\n";
 
            if(!empty($pages_text)) {
                echo '<span class="pages">'.$pages_text.'</span>';
            }
            //Displays a link to the previous post which exists in chronological order from the current post.
            /*http://codex.wordpress.org/Function_Reference/previous_post_link*/
            previous_posts_link($pagenavi_options['prev_text']);
 
            if ($start_page >= 2 && $pages_to_show < $max_page) {
                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
                //esc_url(): Encodes < > & " ' (less than, greater than, ampersand, double quote, single quote).
                /*http://codex.wordpress.org/Data_Validation*/
                //get_pagenum_link():(wp-includes/link-template.php)-Retrieve get links for page numbers.
                echo '<a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">1</a>';
                if(!empty($pagenavi_options['dotleft_text'])) {
                    echo '<span class="expand">'.$pagenavi_options['dotleft_text'].'</span>';
                }
            }
 
            if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
                for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
 
            for($i = $start_page; $i  <= $end_page; $i++) {
                if($i == $paged) {
                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
                    echo '<span class="current">'.$current_page_text.'</span>';
                } else {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
 
            if ($end_page < $max_page) {
                if(!empty($pagenavi_options['dotright_text'])) {
                    echo '<span class="expand">'.$pagenavi_options['dotright_text'].'</span>';
                }
                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
                echo '<a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$max_page.'</a>';
            }
            next_posts_link($pagenavi_options['next_text'], $max_page);
 
            if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
                for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
            echo '</div>'.$after."\n";
        }
    }
}

//////////////////////////////////////////////////////////////////////

function csc_curl_counter( $xml_url ) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $xml_url);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}


function csc_youtube( $channel_link ){
	$youtube_link = @parse_url($channel_link);

	if( $youtube_link['host'] == 'www.youtube.com' || $youtube_link['host']  == 'youtube.com' ){
		try {
			$youtube_name = substr(@parse_url($channel_link, PHP_URL_PATH), 6);
			$json = @csc_curl_counter("http://gdata.youtube.com/feeds/api/users/".$youtube_name."?alt=json");
			$data = json_decode($json, true); 
			$subs = $data['entry']['yt$statistics']['subscriberCount']; 
		} catch (Exception $e) {
			$subs = 0;
		}
		
		if( !empty($subs) && get_option( 'youtube_count') != $subs )
			update_option( 'youtube_count' , $subs );
			
		if( $subs == 0 && get_option( 'youtube_count') )
			$subs = get_option( 'youtube_count');
				
		elseif( $subs == 0 && !get_option( 'youtube_count') )
			$subs = 0;
			
		return $subs;
	}
}


function csc_vimeo( $page_link ) {
	$face_link = @parse_url($page_link);

	if( $face_link['host'] == 'www.vimeo.com' || $face_link['host']  == 'vimeo.com' ){
		try {
			$page_name = substr(@parse_url($page_link, PHP_URL_PATH), 10);
			@$data = @json_decode(csc_curl_counter( 'http://vimeo.com/api/v2/channel/' . $page_name  .'/info.json'));
		
			$vimeo = $data->total_subscribers;
		} catch (Exception $e) {
			$vimeo = 0;
		}

		if( !empty($vimeo) && get_option( 'vimeo_count') != $vimeo )
			update_option( 'vimeo_count' , $vimeo );
			
		if( $vimeo == 0 && get_option( 'vimeo_count') )
			$vimeo = get_option( 'vimeo_count');
				
		elseif( $vimeo == 0 && !get_option( 'vimeo_count') )
			$vimeo = 0;
			
		return $vimeo;
	}

}

function csc_dribbble( $page_link ) {
	$face_link = @parse_url($page_link);

	if( $face_link['host'] == 'www.dribbble.com' || $face_link['host']  == 'dribbble.com' ){
		try {
			$page_name = substr(@parse_url($page_link, PHP_URL_PATH), 1);
			@$data = @json_decode(csc_curl_counter( 'http://api.dribbble.com/' . $page_name));
		
			$dribbble = $data->followers_count;
		} catch (Exception $e) {
			$dribbble = 0;
		}

		if( !empty($dribbble) && get_option( 'dribbble_count') != $dribbble )
			update_option( 'dribbble_count' , $dribbble );
			
		if( $dribbble == 0 && get_option( 'dribbble_count') )
			$dribbble = get_option( 'dribbble_count');
				
		elseif( $dribbble == 0 && !get_option( 'dribbble_count') )
			$dribbble = 0;
			
		return $dribbble;
	}

}

function csc_followers_count() {
	try {
		$twitter_username 		= csc_option('csc_twitter_username');
		$consumer_key 			= csc_option('csc_twitter_consumer_key');
		$consumer_secret		= csc_option('csc_twitter_consumer_secret');
		$access_token 			= csc_option('csc_twitter_access_token');
		$access_token_secret 	= csc_option('csc_twitter_access_token_secret');
		
		function getConnectionWithAccessTokens($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
							  $twitterConnection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
		return $twitterConnection;
		}
		
		$twitterConnection = getConnectionWithAccessTokens( $consumer_key , $consumer_secret , $access_token , $access_token_secret	);
		$twitterData = $twitterConnection->get("https://api.twitter.com/1.1/users/show.json?screen_name=".$twitter_username);
		$twitter['page_url'] = 'http://www.twitter.com/'.$twitter_username;
		
		$twitter['followers_count'] = $twitterData->followers_count;
		
	} catch (Exception $e) {
		$twitter['page_url'] = 'http://www.twitter.com/'.$twitter_username;
		$twitter['followers_count'] = 0;
	}
	if( !empty( $twitter['followers_count'] ) &&  get_option( 'followers_count') != $twitter['followers_count'] )
		update_option( 'followers_count' , $twitter['followers_count'] );
		
	if( $twitter['followers_count'] == 0 && get_option( 'followers_count') )
		$twitter['followers_count'] = get_option( 'followers_count');
			
	elseif( $twitter['followers_count'] == 0 && !get_option( 'followers_count') )
		$twitter['followers_count'] = 0;
	
	return $twitter;
}

//////////////////////////////////////////////////////////////////////

?>
<?php function globalScore()
{	
global $post,$totalscore;

$i = 0;
$score = 0;
$scorecount = 0;
$reviewnum='10';

	while ($i <= ($reviewnum)) {
	
		${"score" . $i} = get_post_meta($post->ID, 'csc_criterion_'.$i.'_score', true);
		if (empty(${"score" .$i})) ${"score" .$i} = 0;
        ${"criteria" . $i} = get_post_meta($post->ID, 'csc_criterion_' . $i, true);
		${"scorebar" . $i} = ${"score" . $i} *10;
		if(!empty(${"criteria" . $i})) {
			$score += ${"score" . $i};
			$scorecount++;
		}
		$i++;
		}
		if ($scorecount && $scorecount != 0) {
			$totalscore = round($score/$scorecount, 1);
	    }
}

//////////////////////////////////////////////////////////////////////

function csc_post_info() {?>

<div class="news-info"><span class="p-day"><i class="icon-time"></i> <?php the_time('M j, Y'); ?></span>
<?php
if ( comments_open() ) :
?>
 <span class="p-comm"><i class="icon-comments"></i> <?php comments_number('0', '1', '%');?></span>
<?php
endif;
?>
<!--<span class="p-comm"><i class="icon-eye-open"></i> <?php // echo  getPostViews(); ?></span>-->
<?php if( rwmb_meta('csc_reviews_system') == 'percentage' && rwmb_meta('csc_reviews_act')):
			globalScore();
			global $totalscore;
            ?>
							
    <span class="p-rate"><i class="icon-trophy"></i> <?php echo $totalscore*10;?>%</span>							
<?php endif; ?>

<?php if( rwmb_meta('csc_reviews_system') == 'points' && rwmb_meta('csc_reviews_act')):
			globalScore();
			global $totalscore;
            ?>
							
	 <span class="p-rate"><i class="icon-trophy"></i> <?php echo $totalscore;?></span>							
<?php endif; ?> 
<?php
			if( rwmb_meta('csc_reviews_system') == 'stars' && rwmb_meta('csc_reviews_act')):
			globalScore();
			global $totalscore;
			$starscore = $totalscore / 2;
            $starscore = round($starscore/.5)*.5;
            ?>
            <span class="stars-rate" style="background:none !important;"><img src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo $starscore ?>.png" alt="" style=" margin-left:5px;margin-top:-5px !important;" /></span>
            
			<?php endif; ?>
</div>
<?php }?>
<?php
/*
Plugin Name: Demo Tax meta class
Plugin URI: http://en.bainternet.info
Description: Tax meta class usage demo
Version: 1.9.9
Author: Bainternet, Ohad Raz
Author URI: http://en.bainternet.info
*/
//include the main class file
require_once CSC_BASE. 'functions/Tax-meta-class/Tax-meta-class.php';
if (is_admin()){
  /* 
   * prefix of meta keys, optional
   */
  $prefix = 'ba_';
  /* 
   * configure your meta box
   */
  $config = array(
    'id' => 'demo_meta_box',          // meta box id, unique per meta box
    'title' => 'Demo Meta Box',          // meta box title
    'pages' => array('category'),        // taxonomy name, accept categories, post_tag and custom taxonomies
    'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'fields' => array(),            // list of meta fields (can be added by field arrays)
    'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your meta box
   */
  $my_meta =  new Tax_Meta_Class($config);
  /*
   * Add fields to your meta box
   */
  //text field
  //$my_meta->addText($prefix.'text_field_id',array('name'=> __('My Text ','tax-meta')));
  //textarea field
  //$my_meta->addTextarea($prefix.'textarea_field_id',array('name'=> __('My Textarea ','tax-meta')));
 // //checkbox field
 // $my_meta->addCheckbox($prefix.'checkbox_field_id',array('name'=> __('My Checkbox ','tax-meta')));
 //$my_meta->addSelect($prefix.'select_field_id',array('selectkey1'=>'Select Value1','selectkey2'=>'Select Value2'),array('name'=> __('My select ','tax-meta'), 'std'=> array('selectkey2')));
  //select field
 // $my_meta->addSelect($prefix.'select_field_id',array(), array('name'=> __('Custom Sidebar','tax-meta'), 'std'=> '','options' => csc_side_loop()));
  //radio field
 // $my_meta->addRadio($prefix.'radio_field_id',array('radiokey1'=>'Radio Value1','radiokey2'=>'Radio Value2'),array('name'=> __('My Radio Filed','tax-meta'), 'std'=> array('radionkey2')));
  //date field
 // $my_meta->addDate($prefix.'date_field_id',array('name'=> __('My Date ','tax-meta')));
  //Time field
  //$my_meta->addTime($prefix.'time_field_id',array('name'=> __('My Time ','tax-meta')));
  //Color field
  $my_meta->addColor($prefix.'color_field_id',array('name'=> __('Category Color ','tax-meta')));
  //Image field
  $my_meta->addImage($prefix.'image_field_id',array('name'=> __('Category Background Image ','tax-meta')));
  //file upload field
 // $my_meta->addFile($prefix.'file_field_id',array('name'=> __('My File ','tax-meta')));
  //wysiwyg field
  //$my_meta->addWysiwyg($prefix.'wysiwyg_field_id',array('name'=> __('My wysiwyg Editor ','tax-meta')));
  //taxonomy field
 // $my_meta->addTaxonomy($prefix.'taxonomy_field_id',array('taxonomy' => 'category'),array('name'=> __('My Taxonomy ','tax-meta')));
  //posts field
 // $my_meta->addPosts($prefix.'posts_field_id',array('args' => array('post_type' => 'page')),array('name'=> __('My Posts ','tax-meta')));
  
  /*
   * To Create a reapeater Block first create an array of fields
   * use the same functions as above but add true as a last param
   */
  
//  $repeater_fields[] = $my_meta->addText($prefix.'re_text_field_id',array('name'=> __('My Text ','tax-meta')),true);
//  $repeater_fields[] = $my_meta->addTextarea($prefix.'re_textarea_field_id',array('name'=> __('My Textarea ','tax-meta')),true);
//  $repeater_fields[] = $my_meta->addCheckbox($prefix.'re_checkbox_field_id',array('name'=> __('My Checkbox ','tax-meta')),true);
//  $repeater_fields[] = $my_meta->addImage($prefix.'image_field_id',array('name'=> __('My Image ','tax-meta')),true);
  
  /*
   * Then just add the fields to the repeater block
   */
  //repeater block
  //$my_meta->addRepeaterBlock($prefix.'re_',array('inline' => true, 'name' => __('This is a Repeater Block','tax-meta'),'fields' => $repeater_fields));
  /*
   * Don't Forget to Close up the meta box decleration
   */
  //Finish Meta Box Decleration
  $my_meta->Finish();
}

class Color_Menu_Walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth, $args)
    {
        $classes = empty ($item->classes) ? array() : (array)$item->classes;

        $class_names = join(
            ' '
            , apply_filters(
                'nav_menu_css_class'
                , array_filter($classes), $item
            )
        );

        !empty ($class_names)
            and $class_names = ' class="' . esc_attr($class_names) . '"';

        $output .= "<li id='menu-item-$item->ID' $class_names>";

        $attributes = '';

        !empty($item->attr_title)
            and $attributes .= ' title="' . esc_attr($item->attr_title) . '"';
        !empty($item->target)
            and $attributes .= ' target="' . esc_attr($item->target) . '"';
        !empty($item->xfn)
            and $attributes .= ' rel="' . esc_attr($item->xfn) . '"';
        !empty($item->url)
            and $attributes .= ' href="' . esc_attr($item->url) . '"';
        //!empty($item->description)
            //and $attributes .= ' data-type="' . esc_attr($item->description) . '"';


        $description = (!empty ($item->description) and 0 == $depth)

            ? '<ins class="data">' . esc_attr($item->description) . '</ins>' : '';

        $title = apply_filters('the_title', $item->title, $item->ID);

        $item_output = $args->before
            . "<a $attributes>"
            . $args->link_before
            . $title
            . '</a> '
            . $args->link_after
            . $description
            . $args->after;

        $output .= apply_filters(
            'walker_nav_menu_start_el'
            , $item_output
            , $item
            , $depth
            , $args
        );
    }
}
?>
<?php
//////////////////////////////////////////////////////////////////////

function csc_login_form( $login_only  = 0 ) {
	global $user_ID, $user_identity, $user_level;
	
	if ( $user_ID ) : ?>
		<?php if( empty( $login_only ) ): ?>
		<div id="user-login">
			<h3 ><?php _e( 'Welcome' , 'csc-themewp' ) ?> <?php echo $user_identity ?></h3>
			<span class="pull-left" style="margin-right:30px;"><?php echo get_avatar( $user_ID, $size = '80'); ?></span>
			<p><a href="<?php echo home_url() ?>/wp-admin/"><?php _e( 'Dashboard' , 'csc-themewp' ) ?> </a></p>
			<p><a href="<?php echo home_url() ?>/wp-admin/profile.php"><?php _e( 'Your Profile' , 'csc-themewp' ) ?> </a></p>
			<p><a href="<?php echo wp_logout_url(); ?>"><?php _e( 'Logout' , 'csc-themewp' ) ?> </a></p>
			
		</div>
		<?php endif; ?>
	<?php else: ?>
		<div id="login-form">
			<form action="<?php echo home_url() ?>/wp-login.php" method="post" style="margin-bottom:0;">
				<p id="log-username"><input class="span3 logininput" type="text" name="log" id="log" value="<?php _e( 'Username' , 'csc-themewp' ) ?>" onFocus="if (this.value == '<?php _e( 'Username' , 'csc-themewp' ) ?>') {this.value = '';}" onBlur="if (this.value == '') {this.value = '<?php _e( 'Username' , 'csc-themewp' ) ?>';}" style="width:286px;  -webkit-border-radius: 0px;-moz-border-radius: 0px;border-radius: 0px" /></p>
				<p id="log-pass"><input class="span3 logininput" type="password" name="pwd" id="pwd" value="<?php _e( 'Password' , 'csc-themewp' ) ?>" onFocus="if (this.value == '<?php _e( 'Password' , 'csc-themewp' ) ?>') {this.value = '';}" onBlur="if (this.value == '') {this.value = '<?php _e( 'Password' , 'csc-themewp' ) ?>';}" style="width:286px;  -webkit-border-radius: 0px;-moz-border-radius: 0px;border-radius: 0px"/></p>
				<input type="submit" name="submit" value="<?php _e( 'Login' , 'csc-themewp' ) ?>" class="btn" />
                <p class="forgetmenot" style="margin-top:15px; margin-bottom:0px">
				<label for="rememberme" style="margin-bottom:0px"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" style="margin-top:-3px !important; margin-right:5px !important" /><?php _e( 'Remember Me' , 'csc-themewp' ) ?></label>
                </p>
				<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
			</form>
		</div>
	<?php endif;
}
?>