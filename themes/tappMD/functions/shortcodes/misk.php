<?php

function csc_progress_bar($atts, $content = null) {
	extract( shortcode_atts( array( "style" => '',"width" => '20%' ), $atts));
	
	$code = '
				<div class="progress progress-striped active '.do_shortcode($style).'" >
					<div class="bar" style="width: '.do_shortcode($width).'" ></div>
				</div>
	';
	return $code;
}
add_shortcode('progress_bar', 'csc_progress_bar');

function csc_social_icon( $atts, $content ){
do_shortcode( $content );
if( is_array( $GLOBALS['socicon'] ) ){
	foreach( $GLOBALS['socicon'] as $soc ){
		$socicon[] = '<li><a class="'.$soc['class'].'" href="#">'.$soc['title'].'</a></li>';
	}	
		$return = '<ul class="socicon">'.implode( $socicon ).'</ul>';
	}
	return $return;
}
add_shortcode( 'social_link', 'csc_social_icon' );


function csc_dropcap($atts, $content = null){
	return '<span class="dropcap">' . do_shortcode($content) . '</span>';
	}
add_shortcode("dropcap", "csc_dropcap");	


function csc_divider($atts, $content = null) {

	return '<div class="divider"> </div>';
}
add_shortcode('divider', 'csc_divider');

function csc_well_tb($atts, $content = null) {

	return '<div class="well">' . do_shortcode($content) .'</div>';
}
add_shortcode('well_tb', 'csc_well_tb');


function csc_aside($atts, $content = null) {

	return '<span class="aside">' . do_shortcode($content) . '</span>';
}
add_shortcode('aside', 'csc_aside');


function csc_blockquote($atts, $content = null) {

	return '<blockquote>' . do_shortcode($content) . '</blockquote>';
}
add_shortcode('blockquote', 'csc_blockquote');



function csc_tab_group( $atts, $content ){
$GLOBALS['tab_count'] = 0;

do_shortcode( $content );

if( is_array( $GLOBALS['tabs'] ) ){
	foreach( $GLOBALS['tabs'] as $tab ){
		
		$tabs[] = '<li class="'.$tab['class'].'"><a href="#'.$tab['id'].'" data-toggle="tab">'.$tab['title'].'</a></li>';
		$panes[] = '<div id="'.$tab['id'].'" class="tab-pane fade in '.$tab['class'].'">'.$tab['content'].'</div>';
		
	}	
		$return = "\n".'<ul class="nav nav-tabs">'.implode( "\n", $tabs ).'</ul>'."\n".' <div class="tab-content">'.implode( "\n", $panes ).'</div>'."\n";
	}
	return $return;
}
add_shortcode( 'tabgroup', 'csc_tab_group' );

function csc_tab( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => '',
	'id' => '',
	'class' => ''
	), $atts));

	$x = $GLOBALS['tab_count'];
	
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'id' => sprintf( $id, $GLOBALS['tab_count'] ), 'class' => sprintf( $class, $GLOBALS['tab_count'] ), 'content' =>  $content );

	$GLOBALS['tab_count']++;
}
add_shortcode( 'tab', 'csc_tab' );




function csc_box($atts, $content = null){
	extract(shortcode_atts(array(
	"style" => 'none',
	), $atts));
	return '
	<div class="message-box '.$style.'">'.do_shortcode($content).'<span class="closemsg"></span></div>';
	}
add_shortcode("box", "csc_box");


function csc_tb_label($atts, $content = null){
	extract(shortcode_atts(array(
	"style" => 'none',
	'title' => 'Label Title',
	), $atts));
	return '
	<span class="label '.$style.'">'.do_shortcode($content).'</span>';
	}
add_shortcode("tb_label", "csc_tb_label");	


function csc_tb_badges($atts, $content = null){
	extract(shortcode_atts(array(
	"style" => 'none',
	'title' => 'Badge Title',
	), $atts));
	return '
	<span class="badge '.$style.'">'.do_shortcode($content).'</span>';
	}
add_shortcode("tb_badges", "csc_tb_badges");

function csc_button($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => 'Button Title',
		'target'	=> '',
        'link' => '#',
		'style' => 'none'
    ), $atts));
	
	
	$output = '<a target="'.$target.'" href="' . $link . '" class="button '.$style.'">' . $title . '</a>';
    
    return $output;
}
add_shortcode('button', 'csc_button');


function csc_button_tb($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => 'Button Title',
        'link' => '#',
		'target'	=> '',
		'style' => 'none'
    ), $atts));
	
	$output = '<a target="'.$target.'" href="' . $link . '" class="btn '.$style.'">' . $title . '</a>';
    
    return $output;
}
add_shortcode('button_tb', 'csc_button_tb');


function csc_clear($atts, $content = null){
	return '<div class="clear"></div>';
}
add_shortcode("clear", "csc_clear");


function csc_toggle($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'title' => false
	), $atts));
	return '<div class="toggle-block"><span class="open-block"><a href="#">' . $title . '</a></span><div class="toggle-box">' . do_shortcode(trim($content)) . '</div></div>';
}
add_shortcode('toggle', 'csc_toggle');

function csc_accordion($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'title' => false
	), $atts));
	return '<div class="open-block-acc"><span>' . $title . '</span></div><div class="accordion-box">' . do_shortcode(trim($content)) . '</div>';
}
add_shortcode('accordion', 'csc_accordion');





/////////////////////////////////////////////////////////////////////////////


function csc_icon_dribbble($atts, $content = null) {
    extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow dribbble"></a>';
    
    return $output;
}
add_shortcode("icon_dribbble", "csc_icon_dribbble");



function csc_icon_facebook2($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow facebook"></a>';
    
    return $output;
	}
add_shortcode("icon_facebook2", "csc_icon_facebook2");

function csc_icon_twitter2($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow twitter"></a>';
    
    return $output;
	}
add_shortcode("icon_twitter2", "csc_icon_twitter2");

function csc_icon_flickr($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow flickrs"></a>';
    
    return $output;
	}
add_shortcode("icon_flickr", "csc_icon_flickr");

function csc_icon_linkedin2($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow linkedin"></a>';
    
    return $output;
	}
add_shortcode("icon_linkedin2", "csc_icon_linkedin2");

function csc_icon_vimeo($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow vimeo"></a>';
    
    return $output;
	}
add_shortcode("icon_vimeo", "csc_icon_vimeo");

function csc_icon_google($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow google"></a>';
    
    return $output;
	}
add_shortcode("icon_google", "csc_icon_google");

function csc_icon_googleplus($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow googleplus"></a>';
    
    return $output;
	}
add_shortcode("icon_googleplus", "csc_icon_googleplus");

function csc_icon_apple($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow apple"></a>';
    
    return $output;
	}
add_shortcode("icon_apple", "csc_icon_apple");

function csc_icon_delicious($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow delicious"></a>';
    
    return $output;
	}
add_shortcode("icon_delicious", "csc_icon_delicious");

function csc_icon_digg($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow digg"></a>';
    
    return $output;
	}
add_shortcode("icon_digg", "csc_icon_digg");

function csc_icon_ember($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow ember"></a>';
    
    return $output;
	}
add_shortcode("icon_ember", "csc_icon_ember");

function csc_icon_forrst($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow forrst"></a>';
    
    return $output;
	}
add_shortcode("icon_forrst", "csc_icon_forrst");

function csc_icon_last_fm($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow lastfm"></a>';
    
    return $output;
	}
add_shortcode("icon_last_fm", "csc_icon_last_fm");

function csc_icon_my_space($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow my-space"></a>';
    
    return $output;
	}
add_shortcode("icon_my_space", "csc_icon_my_space");


function csc_icon_rss2($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow rss"></a>';
    
    return $output;
	}
add_shortcode("icon_rss2", "csc_icon_rss2");


function csc_icon_skype($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow skype"></a>';
    
    return $output;
	}
add_shortcode("icon_skype", "csc_icon_skype");

function csc_icon_stumbleupon($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow stumbleupon"></a>';
    
    return $output;
	}
add_shortcode("icon_stumbleupon", "csc_icon_stumbleupon");

function csc_icon_tumblr($atts, $content = null){
  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow tumblr"></a>';
    
    return $output;
	}
add_shortcode("icon_tumblr", "csc_icon_tumblr");

function csc_icon_you_tube($atts, $content = null){
  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow youtube"></a>';
    
    return $output;
	}
add_shortcode("icon_you_tube", "csc_icon_you_tube");

function csc_icon_aim($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow aim"></a>';
    
    return $output;
	}
add_shortcode("icon_aim", "csc_icon_aim");

function csc_icon_behance($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow behance"></a>';
    
    return $output;
	}
add_shortcode("icon_behance", "csc_icon_behance");

function csc_icon_evernote($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow evernote"></a>';
    
    return $output;
	}
add_shortcode("icon_evernote", "csc_icon_evernote");

function csc_icon_github2($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow github"></a>';
    
    return $output;
	}
add_shortcode("icon_github2", "csc_icon_github2");

function csc_icon_paypal($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow paypal"></a>';
    
    return $output;
	}
add_shortcode("icon_paypal", "csc_icon_paypal");

function csc_icon_wordpress($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow wordpress"></a>';
    
    return $output;
	}
add_shortcode("icon_wordpress", "csc_icon_wordpress");

function csc_icon_yahoo($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow yahoo"></a>';
    
    return $output;
	}
add_shortcode("icon_yahoo", "csc_icon_yahoo");

function csc_icon_zerply($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow zerply"></a>';
    
    return $output;
	}
add_shortcode("icon_zerply", "csc_icon_zerply");

////////////////////////////////////////////////////////////////////////////
function csc_icon_blogger($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow blogger"></a>';
    
    return $output;
	}
add_shortcode("icon_blogger", "csc_icon_blogger");

function csc_icon_cargo($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow cargo"></a>';
    
    return $output;
	}
add_shortcode("icon_cargo", "csc_icon_cargo");



function csc_icon_deviantart($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow deviantart"></a>';
    
    return $output;
	}
add_shortcode("icon_deviantart", "csc_icon_deviantart");

function csc_icon_dopplr($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow dopplr"></a>';
    
    return $output;
	}
add_shortcode("icon_dopplr", "csc_icon_dopplr");

function csc_icon_gowalla($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow gowalla"></a>';
    
    return $output;
	}
add_shortcode("icon_gowalla", "csc_icon_gowalla");

function csc_icon_grooveshark($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow grooveshark"></a>';
    
    return $output;
	}
add_shortcode("icon_grooveshark", "csc_icon_grooveshark");

function csc_icon_html5($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow html5"></a>';
    
    return $output;
	}
add_shortcode("icon_html5", "csc_icon_html5");

function csc_icon_icloud($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow icloud"></a>';
    
    return $output;
	}
add_shortcode("icon_icloud", "csc_icon_icloud");

function csc_icon_metacafe($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow metacafe"></a>';
    
    return $output;
	}
add_shortcode("icon_metacafe", "csc_icon_metacafe");

function csc_icon_mixx($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow mixx"></a>';
    
    return $output;
	}
add_shortcode("icon_mixx", "csc_icon_mixx");

function csc_icon_myspace($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow myspace"></a>';
    
    return $output;
	}
add_shortcode("icon_myspace", "csc_icon_myspace");

function csc_icon_netvibes($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow netvibes"></a>';
    
    return $output;
	}
add_shortcode("icon_netvibes", "csc_icon_netvibes");

function csc_icon_newsvine($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow newsvine"></a>';
    
    return $output;
	}
add_shortcode("icon_newsvine", "csc_icon_newsvine");

function csc_icon_orkut($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow orkut"></a>';
    
    return $output;
	}
add_shortcode("icon_orkut", "csc_icon_orkut");

function csc_icon_picasa($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow picasa"></a>';
    
    return $output;
	}
add_shortcode("icon_picasa", "csc_icon_picasa");

function csc_icon_plurk($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow plurk"></a>';
    
    return $output;
	}
add_shortcode("icon_plurk", "csc_icon_plurk");

function csc_icon_posterous($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow posterous"></a>';
    
    return $output;
	}
add_shortcode("icon_posterous", "csc_icon_posterous");

function csc_icon_reddit($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow reddit"></a>';
    
    return $output;
	}
add_shortcode("icon_reddit", "csc_icon_reddit");

function csc_icon_technorati($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow technorati"></a>';
    
    return $output;
	}
add_shortcode("icon_technorati", "csc_icon_technorati");

function csc_icon_yelp($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow yelp"></a>';
    
    return $output;
	}
add_shortcode("icon_yelp", "csc_icon_yelp");

function csc_icon_zootool($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow zootool"></a>';
    
    return $output;
	}
add_shortcode("icon_zootool", "csc_icon_zootool");

function csc_icon_pinterest2($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow pinterest"></a>';
    
    return $output;
	}
add_shortcode("icon_pinterest2", "csc_icon_pinterest2");

function csc_icon_instagram($atts, $content = null){
	  extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
	
	$output = '<a href="'.$link.'" class="soc-follow instagram"></a>';
    
    return $output;
	}
add_shortcode("icon_instagram", "csc_icon_instagram");


?>