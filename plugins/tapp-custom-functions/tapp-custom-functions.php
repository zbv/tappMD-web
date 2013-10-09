<?php
/*
Plugin Name: tappMD Custom Functions
Description: Includes function customizations to Dashboard, Widgets, Profile fields, author information and more.
Version: 1.0
Author: Kyle Barkins
License: Public Domain
*/

// Remove wordpress version
remove_action('wp_head', 'wp_generator');  

// Remove wordpress version from RSS
function wpt_remove_version() {  
   return '';  
}  
add_filter('the_generator', 'wpt_remove_version');  

//Update dashboard widgets
function disable_default_dashboard_widgets() {  
    remove_meta_box('dashboard_right_now', 'dashboard', 'core');  
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');  
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  
    remove_meta_box('dashboard_plugins', 'dashboard', 'core');  
    remove_meta_box('dashboard_quick_press', 'dashboard', 'core');  
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');  
    remove_meta_box('dashboard_primary', 'dashboard', 'core');  
    //remove_meta_box('dashboard_secondary', 'dashboard', 'core');  
}  
add_action('admin_menu', 'disable_default_dashboard_widgets');  

//Update dashboard footer
function custom_footer () {
echo 'Thank you for the contribution to our network - <a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a>';
}
add_filter('admin_footer_text', 'custom_footer');

// Remove Help Tab
function hide_help() {
    echo '<style type="text/css">
            #contextual-help-link-wrap { display: none !important; }
          </style>';
}
add_action('admin_head', 'hide_help');

//Change Footer version
function change_footer_version() {
 	$site_title = get_bloginfo( 'name' );
 	$site_url = get_bloginfo( 'url' );
 	$site_description = get_bloginfo( 'description' );
  	return 'You are using <a href="'. $site_url .'">'. $site_title .'</a> Version 1.6';
}
add_filter( 'update_footer', 'change_footer_version', 9999 );

//Remove unused portion of profile pages
function hide_profile_fields( $contactmethods ) {
unset($contactmethods['aim']);
unset($contactmethods['jabber']);
unset($contactmethods['yim']);
return $contactmethods;
}
add_filter('user_contactmethods','hide_profile_fields',10,1);

//Remove admin color theme options
function admin_color_scheme() {
   global $_wp_admin_css_colors;
   $_wp_admin_css_colors = 0;
}
add_action('admin_head', 'admin_color_scheme');

//Add new profile entries
function my_new_contactmethods( $contactmethods ) {

//Add Feedburner
$contactmethods['feedburner'] = 'Feedbuner URL';
//Add Home Blog URL
$contactmethods['tapp_url'] = 'TappMD URL';
return $contactmethods;
}
add_filter('user_contactmethods','my_new_contactmethods',10,1);

//Allow HTML in Bio
remove_filter('pre_user_description', 'wp_filter_kses');  
add_filter( 'pre_user_description', 'wp_filter_post_kses' ); 
remove_filter('short_bio', 'wp_filter_kses');  
add_filter( 'short_bio', 'wp_filter_post_kses' ); 

//Rewrite author URL
function my_custom_author_base(){
$author_base = "profile" ; //Your desired author base.
global $wp_rewrite ;
$wp_rewrite->author_base = $author_base ;
$wp_rewrite->flush_rules() ;
}
add_action( 'init', 'my_custom_author_base', 0 ) ; 


/////////////////////////////////////////////////////////////////////////////////////////////////

add_action( 'show_user_profile', 'show_extra_profile_fields' );
add_action( 'edit_user_profile', 'show_extra_profile_fields' );
function show_extra_profile_fields( $user ) { ?>
	<h3>Social Networking</h3>
	<table class="form-table">
		<tr>
			<th><label for="twitter">Twitter URL</label></th>
			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
		<tr>
			<th><label for="facebook">Facebook URL</label></th>
			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
        
        
        <tr>
			<th><label for="pinterest">Pinterest URL</label></th>
			<td>
				<input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
		
        <tr>
			<th><label for="instagram">Instagram URL</label></th>
			<td>
				<input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
        
        <tr>
			<th><label for="google">Google + URL</label></th>
			<td>
				<input type="text" name="google" id="google" value="<?php echo esc_attr( get_the_author_meta( 'google', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
		<tr>
			<th><label for="linkedin">linkedIn URL</label></th>
			<td>
				<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
        
		<tr>
			<th><label for="youtube">YouTube URL</label></th>
			<td>
				<input type="text" name="youtube" id="youtube" value="<?php echo esc_attr( get_the_author_meta( 'youtube', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
		
		<tr>
			<th><label for="feedburner_username">Feedburner Feed Name</label></th>
			<td>
				<input type="text" name="feedburner_username" id="feedburner_username" value="<?php echo esc_attr( get_the_author_meta( 'feedburner_username', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please input the [name] of your feedburner feed i.e. http://feeds.feedburner.com/[name]</span>
			</td>
		</tr>

	</table>
    
    <h3>Certifications</h3>

	<table class="form-table">

		<tr>
			<th><label for="certifications">Personal Info</label></th>

			<td>
				<input type="text" name="certifications" id="certifications" value="<?php echo esc_attr( get_the_author_meta( 'certifications', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please list any certifications i.e. MD, PhD.</span>
			</td>
		</tr>
        <tr>
		<th><label for="specialty">Specialty</label></th>

			<td>
				<input type="text" name="specialty" id="specialty" value="<?php echo esc_attr( get_the_author_meta( 'specialty', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please add your specialty or area of expertise.  This will be the category your contributions are placed under.</span>
			</td>
		</tr>
        <tr>
		<th><label for="media_reel">Media Reel</label></th>

			<td>
				<input type="text" name="media_reel" id="media_reel" value="<?php echo esc_attr( get_the_author_meta( 'media_reel', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter the Video ID to your YouTube Video.</span>
			</td>
		</tr>
        <th><label for="short_bio">Short Bio</label></th>

			<td>
                
                <textarea name="short_bio" id="short_bio" rows="5" cols="30" value="<?php echo esc_attr( get_the_author_meta( 'short_bio', $user->ID ) ); ?>" class="regular-text" ><?php echo esc_attr( get_the_author_meta( 'short_bio', $user->ID ) ); ?></textarea>
                <br />
               <span class="description">Please enter a short Bio or intro about yourself. This will be used on posts and shortened teaser pages.</span>

			</td>
		</tr>

	</table>
    
    
     <h3>Hospital/Practice Contact Information</h3>

	<table class="form-table">
		<tr>
			<th><label for="office-name">Office/Practice Name</label></th>

			<td>
				<input type="text" name="office-name" id="office-name" value="<?php echo esc_attr( get_the_author_meta( 'office-name', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
        <tr>
		<tr>
			<th><label for="office-phone">Office Phone Number</label></th>

			<td>
				<input type="text" name="office-phone" id="office-phone" value="<?php echo esc_attr( get_the_author_meta( 'office-phone', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please use format XXX-XXX-XXXX or XXX.XXX.XXXX</span>
			</td>
		</tr>
        <tr>
		<th><label for="office-address">Office Address Number</label></th>

			<td>
				<input type="text" name="office-address-num" id="office-address-num" value="<?php echo esc_attr( get_the_author_meta( 'office-address-num', $user->ID ) ); ?>" class="regular-text" />
   			</td>
		</tr>
        <tr>
        
        <tr>
        <th><label for="office-address-street">Office Street</label></th>
         <td>
				<input type="text" name="office-address-street" id="office-address-street" value="<?php echo esc_attr( get_the_author_meta( 'office-address-street', $user->ID ) ); ?>" class="regular-text" />
   			</td>
        </tr>
          
		<th><label for="office-city">Office City</label></th>

			<td>
				<input type="text" name="office-city" id="office-city" value="<?php echo esc_attr( get_the_author_meta( 'office-city', $user->ID ) ); ?>" class="regular-text" />
   			</td>
		</tr>
        <tr>
		<th><label for="office-state">Office State</label></th>

			<td>
				<input type="text" name="office-state" id="office-state" value="<?php echo esc_attr( get_the_author_meta( 'office-state', $user->ID ) ); ?>" class="regular-text" />
   			</td>
		</tr>        
        <tr>
		<th><label for="office-zip">Office Zip</label></th>

			<td>
				<input type="text" name="office-zip" id="office-zip" value="<?php echo esc_attr( get_the_author_meta( 'office-zip', $user->ID ) ); ?>" class="regular-text" />
   			</td>
		</tr>                  
        <tr>
		<th><label for="office-logo">Office Logo URL</label></th>

			<td>
				<input type="text" name="office-logo" id="office-logo" value="<?php echo esc_attr( get_the_author_meta( 'office-logo', $user->ID ) ); ?>" class="regular-text" />
   			</td>
		</tr>
	</table>
<?php }

add_action( 'personal_options_update', 'save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_profile_fields' );
function save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) return false;
	update_user_meta( $user_id, 'google', $_POST['google'] );
	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
	update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
	update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
	update_user_meta( $user_id, 'flickr', $_POST['flickr'] );
	update_user_meta( $user_id, 'youtube', $_POST['youtube'] );
	update_user_meta( $user_id, 'vimeo', $_POST['vimeo'] );
	update_user_meta( $user_id, 'feedburner_username', $_POST['feedburner_username'] );
	update_user_meta( $user_id, 'instagram', $_POST['instagram'] );
	update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
	update_user_meta( $user_id, 'media_reel', $_POST['media_reel'] );
	update_user_meta( $user_id, 'certifications', $_POST['certifications'] );
	update_user_meta( $user_id, 'specialty', $_POST['specialty'] );
	update_user_meta( $user_id, 'short_bio', $_POST['short_bio'] );
	update_user_meta( $user_id, 'office-name', $_POST['office-name'] );	
	update_user_meta( $user_id, 'office-phone', $_POST['office-phone'] );
	update_user_meta( $user_id, 'office-address-num', $_POST['office-address-num'] );
	update_user_meta( $user_id, 'office-address-street', $_POST['office-address-street'] );
	update_user_meta( $user_id, 'office-city', $_POST['office-city'] );
	update_user_meta( $user_id, 'office-state', $_POST['office-state'] );
	update_user_meta( $user_id, 'office-zip', $_POST['office-zip'] );
	update_user_meta( $user_id, 'office-logo', $_POST['office-logo'] );
	
}

/////////////////////////////////
/* Tapp Custom Meta Boxes */
/////////////////////////////////


add_action( 'add_meta_boxes', 'cd_meta_box_add' );
function cd_meta_box_add()
{
	add_meta_box( 'og-author-meta', 'Original Article Meta', 'cd_meta_box_cb', 'post', 'side', 'high' );
}

function cd_meta_box_cb( $post )
{
	$values = get_post_custom( $post->ID );
	$og_author = isset( $values['og_author_text'] ) ? esc_attr( $values['og_author_text'][0] ) : '';
	$og_author_uri = isset( $values['og_author_uri'] ) ? esc_attr( $values['og_author_uri'][0] ) : '';
	$og_blog = isset( $values['og_blog_text'] ) ? esc_attr( $values['og_blog_text'][0] ) : '';
	$og_blog_uri = isset( $values['og_blog_uri'] ) ? esc_attr( $values['og_blog_uri'][0] ) : '';
	$og_image = isset( $values['og_image_text'] ) ? esc_attr( $values['og_image_text'][0] ) : '';
	$og_image_uri = isset( $values['og_image_uri'] ) ? esc_attr( $values['og_image_uri'][0] ) : '';
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>
	<p>Please Credit the Original Author and Blog as well as include a link to such.</p>
	<p>
		<label for="og_author_text">Source Author:</label><br>
		<input type="text" name="og_author_text" id="og_author_text" value="<?php echo $og_author; ?>" />
	</p>
	<p>
		<label for="og_author_uri">Author Bio URL:</label><br>
		<input type="text" name="og_author_uri" id="og_author_uri" value="<?php echo $og_author_uri; ?>" />
	</p>
	<p>
		<label for="og_blog_text">Source Blog:</label><br>
		<input type="text" name="og_blog_text" id="og_blog_text" value="<?php echo $og_blog; ?>" />
	</p>
	<p>
		<label for="og_blog_uri">Source URL:</label><br>
		<input type="text" name="og_blog_uri" id="og_blog_uri" value="<?php echo $og_blog_uri; ?>" />
	</p>
    	<p>
		<label for="og_image_text">Featured Image Source:</label><br>
		<input type="text" name="og_image_text" id="og_image_text" value="<?php echo $og_image; ?>" />
	</p>
	<p>
		<label for="og_image_uri">Featured Image URL:</label><br>
		<input type="text" name="og_image_uri" id="og_image_uri" value="<?php echo $og_image_uri; ?>" />
	</p>
	<?php	
}

add_action( 'save_post', 'cd_meta_box_save' );
function cd_meta_box_save( $post_id )
{
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	// now we can actually save the data
	$allowed = array( 
		'a' => array( // on allow a tags
			'href' => array() // and those anchors can only have href attribute
		)
	);
	
	// Make sure your data is set
	if( isset( $_POST['og_author_text'] ) )
		update_post_meta( $post_id, 'og_author_text', wp_kses( $_POST['og_author_text'], $allowed ) );
	if( isset( $_POST['og_author_uri'] ) )
		update_post_meta( $post_id, 'og_author_uri', wp_kses( $_POST['og_author_uri'], $allowed ) );
	if( isset( $_POST['og_blog_text'] ) )
		update_post_meta( $post_id, 'og_blog_text', wp_kses( $_POST['og_blog_text'], $allowed ) );
	if( isset( $_POST['og_blog_uri'] ) )
		update_post_meta( $post_id, 'og_blog_uri', wp_kses( $_POST['og_blog_uri'], $allowed ) );
	if( isset( $_POST['og_image_text'] ) )
		update_post_meta( $post_id, 'og_image_text', wp_kses( $_POST['og_image_text'], $allowed ) );
	if( isset( $_POST['og_image_uri'] ) )
		update_post_meta( $post_id, 'og_image_uri', wp_kses( $_POST['og_image_uri'], $allowed ) );
		
}

//add list of contributors
function contributors() {

global $wpdb;

$blogusers = get_users('role=author');

foreach ($blogusers as $user) {

$usernice = $user->user_nicename;

echo '<li>';
echo '<a href="/profile/'. $usernice . '">'. get_avatar ($user->ID) .'</a>';
echo '</li>';

}
}

//add list of contributors to header
function head_contributors() {

global $wpdb;

$blogusers = get_users('role=author');

foreach ($blogusers as $user) {

$usernice = $user->user_nicename;
$userspec = $user->specialty;
$userfirst = $user->first_name;
$userlast = $user->last_name;	
$usercert = $user->certifications;
$username = $user->nickname;


echo '<li><div class="teamer_member_tag"><div class="teamer_member_img">';
echo '<a href="/profile/'. $usernice . '">'. get_avatar ($user->ID) .'</a>';
echo '</div>';
echo '<div class="teamer_member_title">';
echo '<a href="/profile/'. $usernice . '"><h2>'. $username .'</h2></a>';
echo '<p>'. $userspec .'</p>';
echo '</div>';
echo '</div>';
echo '</li>';

}
}
?>