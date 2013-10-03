<?php 
function wpse_Colorpicker(){ 
    wp_enqueue_style( 'wp-color-picker');
    wp_enqueue_script( 'wp-color-picker');
}
add_action('admin_enqueue_scripts', 'wpse_Colorpicker');
?>
<?php 
csc_include_w( 'magazine_bignews' );
csc_include_w( 'magazine_slider_post' );
csc_include_w( 'magazine_video_home' );
csc_include_w( 'magazine_1column_and_small' );
csc_include_w( 'magazine_1column' );
csc_include_w( 'magazine_1column_and_slider' );
csc_include_w( 'magazine_2column' );
csc_include_w( 'magazine_2column_small' );
csc_include_w( 'magazine_carousel' );
csc_include_w( 'magazine_latest_images' );
csc_include_w( 'widget_1col_post' );
csc_include_w( 'widget_1col_slider' );
//csc_include_w( 'widget_flickr' );
//csc_include_w( 'widget_video' );
//csc_include_w( 'widget_google' );
csc_include_w( 'widget_fb' );
//csc_include_w( 'widget_audio' );
//csc_include_w( 'widget_ads' );
csc_include_w( 'widget_counter' );
csc_include_w( 'widget_l_images' );
//csc_include_w( 'widget_top_reviews' );
csc_include_w( 'widget_recent_post' );
csc_include_w( 'widget_tabs' );
csc_include_w( 'widget_tweets' );
csc_include_w( 'widget_login' );
//csc_include_w( 'magazine_top_reviews' );
?>