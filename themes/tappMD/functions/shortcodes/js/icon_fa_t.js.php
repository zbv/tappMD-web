<?php 

 
	require_once('../../../../../../wp-load.php');
	require_once('../../../../../../wp-admin/includes/admin.php');
	do_action('admin_init');
	
	if ( ! is_user_logged_in() )
		die('You must be logged in to access this script.');
	
?>

(function() {
	tinymce.create('tinymce.plugins.<?php echo $cscIconFAs->IconFAsButton; ?>', {
		createControl : function(n, cm) {
			if(n=='<?php echo $cscIconFAs->IconFAsButton; ?>'){
                var cols = cm.createListBox('<?php echo $cscIconFAs->IconFAsButton; ?>List', {
                     title : 'Icon FA',
                     onselect : function(value) {
                     	if(value == 'icon_glass'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_glass] [/icon_glass]');
                        }
						
                        else if(value == 'icon_music'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_music][/icon_music]');
                        }
						
						else if(value == 'icon_search'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_search][/icon_search]');
                        }
						
						else if(value == 'icon_envelope'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_envelope][/icon_envelope]');
                        }
						else if(value == 'icon_heart'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_heart][/icon_heart]');
                        }
						else if(value == 'icon_star'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_star][/icon_star]');
                        }
						else if(value == 'icon_star_empty'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_star_empty][/icon_star_empty]');
                        }
						else if(value == 'icon_user'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_user][/icon_user]');
                        }
						else if(value == 'icon_film'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_film][/icon_film]');
                        }
						else if(value == 'icon_th_large'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_th_large][/icon_th_large]');
                        }
						else if(value == 'icon_th'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_th][/icon_th]');
                        }
						else if(value == 'icon_th_list'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_th_list][/icon_th_list]');
                        }
						else if(value == 'icon_ok'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_ok][/icon_ok]');
                        }
						else if(value == 'icon_remove'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_remove][/icon_remove]');
                        }
						else if(value == 'icon_zoom_in'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_zoom_in][/icon_zoom_in]');
                        }
						else if(value == 'icon_zoom_out'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_zoom_out][/icon_zoom_out]');
                        }
						else if(value == 'icon_off'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_off][/icon_off]');
                        }
						else if(value == 'icon_signal'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_signal][/icon_signal]');
                        }else if(value == 'icon_search'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_search][/icon_search]');
                        }
						else if(value == 'icon_cog'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_cog][/icon_cog]');
                        }
						else if(value == 'icon_trash'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_trash][/icon_trash]');
                        }
						else if(value == 'icon_home'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_home][/icon_home]');
                        }
						else if(value == 'icon_file'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_file][/icon_file]');
                        }
						else if(value == 'icon_time'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_time][/icon_time]');
                        }
						else if(value == 'icon_road'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_road][/icon_road]');
                        }
						else if(value == 'icon_download_alt'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_download_alt][/icon_download_alt]');
                        }
						else if(value == 'icon_download'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_download][/icon_download]');
                        }
						else if(value == 'icon_upload'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_upload][/icon_upload]');
                        }
						else if(value == 'icon_inbox'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_inbox][/icon_inbox]');
                        }
						else if(value == 'icon_play_circle'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_play_circle][/icon_play_circle]');
                        }
						else if(value == 'icon_repeat'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_repeat][/icon_repeat]');
                        }
						else if(value == 'icon_refresh'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_refresh][/icon_refresh]');
                        }
						else if(value == 'icon_list_alt'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_list_alt][/icon_list_alt]');
                        }
						else if(value == 'icon_lock'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_lock][/icon_lock]');
                        }
						else if(value == 'icon_flag'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_flag][/icon_flag]');
                        }
						else if(value == 'icon_headphones'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_headphones][/icon_headphones]');
                        }
						else if(value == 'icon_volume_off'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_volume_off][/icon_volume_off]');
                        }
						else if(value == 'icon_volume_down'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_volume_down][/icon_volume_down]');
                        }
						else if(value == 'icon_volume_up'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_volume_up][/icon_volume_up]');
                        }
						else if(value == 'icon_qrcode'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_qrcode][/icon_qrcode]');
                        }
						else if(value == 'icon_barcode'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_barcode][/icon_barcode]');
                        }
						else if(value == 'icon_tag'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_tag][/icon_tag]');
                        }
						else if(value == 'icon_tags'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_tags][/icon_tags]');
                        }
						else if(value == 'icon_book'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_book][/icon_book]');
                        }
						else if(value == 'icon_bookmark'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_bookmark][/icon_bookmark]');
                        }
						else if(value == 'icon_print'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_print][/icon_print]');
                        }
						else if(value == 'icon_camera'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_camera][/icon_camera]');
                        }
						else if(value == 'icon_font'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_font][/icon_font]');
                        }
						else if(value == 'icon_bold'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_bold][/icon_bold]');
                        }
						else if(value == 'icon_italic'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_italic][/icon_italic]');
                        }
						else if(value == 'icon_text_height'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_text_height][/icon_text_height]');
                        }
						else if(value == 'icon_text_width'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_text_width][/icon_text_width]');
                        }
						else if(value == 'icon_align_left'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_align_left][/icon_align_left]');
                        }
						else if(value == 'icon_align_center'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_align_center][/icon_align_center]');
                        }
						else if(value == 'icon_align_right'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_align_right][/icon_align_right]');
                        }
						else if(value == 'icon_align_justify'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_align_justify][/icon_align_justify]');
                        }
						else if(value == 'icon_list'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_list][/icon_list]');
                        }
						else if(value == 'icon_indent_left'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_indent_left][/icon_indent_left]');
                        }
						else if(value == 'icon_indent_right'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_indent_right][/icon_indent_right]');
                        }
						else if(value == 'icon_facetime_video'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_facetime_video][/icon_facetime_video]');
                        }
						else if(value == 'icon_picture'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_picture][/icon_picture]');
                        }
						else if(value == 'icon_pencil'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_pencil][/icon_pencil]');
                        }
						else if(value == 'icon_map_marker'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_map_marker][/icon_map_marker]');
                        }
						else if(value == 'icon_adjust'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_adjust][/icon_adjust]');
                        }
						else if(value == 'icon_tint'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_tint][/icon_tint]');
                        }
						else if(value == 'icon_edit'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_edit][/icon_edit]');
                        }
						else if(value == 'icon_share'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_share][/icon_share]');
                        }
						else if(value == 'icon_check'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_check][/icon_check]');
                        }
						else if(value == 'icon_move'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_move][/icon_move]');
                        }
						
						else if(value == 'icon_step_backward'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_step_backward][/icon_step_backward]');
                        }
						
						else if(value == 'icon_fast_backward'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_fast_backward][/icon_fast_backward]');
                        }
						
						else if(value == 'icon_backward'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_backward][/icon_backward]');
                        }
						
						else if(value == 'icon_play'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_play][/icon_play]');
                        }
						
						else if(value == 'icon_pause'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_pause][/icon_pause]');
                        }
						
						else if(value == 'icon_stop'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_stop][/icon_stop]');
                        }
						
						else if(value == 'icon_forward'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_forward][/icon_forward]');
                        }
						
						else if(value == 'icon_fast_forward'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_fast_forward][/icon_fast_forward]');
                        }
						
						else if(value == 'icon_step_forward'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_step_forward][/icon_step_forward]');
                        }
						
						else if(value == 'icon_eject'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_eject][/icon_eject]');
                        }
						
						else if(value == 'icon_chevron_left'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_chevron_left][/icon_chevron_left]');
                        }
						
						else if(value == 'icon_chevron_right'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_chevron_right][/icon_chevron_right]');
                        }
						
						else if(value == 'icon_plus_sign'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_plus_sign][/icon_plus_sign]');
                        }
						
						else if(value == 'icon_minus_sign'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_minus_sign][/icon_minus_sign]');
                        }
						
						else if(value == 'icon_remove_sign'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_remove_sign][/icon_remove_sign]');
                        }
						
						else if(value == 'icon_ok_sign'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_ok_sign][/icon_ok_sign]');
                        }
						
						else if(value == 'icon_question_sign'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_question_sign][/icon_question_sign]');
                        }
						
						else if(value == 'icon_info_sign'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_info_sign][/icon_info_sign]');
                        }
						
						else if(value == 'icon_screenshot'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_screenshot][/icon_screenshot]');
                        }
						
						else if(value == 'icon_remove_circle'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_remove_circle][/icon_remove_circle]');
                        }
						
						else if(value == 'icon_ok_circle'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_ok_circle][/icon_ok_circle]');
                        }
						
						else if(value == 'icon_ban_circle'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_ban_circle][/icon_ban_circle]');
                        }
						
						else if(value == 'icon_arrow_left'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_arrow_left][/icon_arrow_left]');
                        }
						
						else if(value == 'icon_arrow_right'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_arrow_right][/icon_arrow_right]');
                        }
						
						else if(value == 'icon_arrow_up'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_arrow_up][/icon_arrow_up]');
                        }
						
						else if(value == 'icon_arrow_down'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_arrow_down][/icon_arrow_down]');
                        }
						
						else if(value == 'icon_share_alt'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_share_alt][/icon_share_alt]');
                        }
						
						else if(value == 'icon_resize_full'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_resize_full][/icon_resize_full]');
                        }
						
						else if(value == 'icon_resize_small'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_resize_small][/icon_resize_small]');
                        }
						
						else if(value == 'icon_plus'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_plus][/icon_plus]');
                        }
						
						else if(value == 'icon_minus'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_minus][/icon_minus]');
                        }
						
						else if(value == 'icon_asterisk'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_asterisk][/icon_asterisk]');
                        }
						
						else if(value == 'icon_exclamation_sign'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_exclamation_sign][/icon_exclamation_sign]');
                        }
						
						else if(value == 'icon_gift'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_gift][/icon_gift]');
                        }
						
						else if(value == 'icon_fire'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_fire][/icon_fire]');
                        }
						
						else if(value == 'icon_eye_open'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_eye_open][/icon_eye_open]');
                        }
						
						else if(value == 'icon_eye_close'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_eye_close][/icon_eye_close]');
                        }
						
						else if(value == 'icon_warning_sign'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_warning_sign][/icon_warning_sign]');
                        }
						
						else if(value == 'icon_plane'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_plane][/icon_plane]');
                        }
						
						else if(value == 'icon_calendar'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_calendar][/icon_calendar]');
                        }
						
						else if(value == 'icon_random'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_random][/icon_random]');
                        }
						
						else if(value == 'icon_comment'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_comment][/icon_comment]');
                        }
						
						else if(value == 'icon_magnet'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_magnet][/icon_magnet]');
                        }
						
						else if(value == 'icon_chevron_up'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_chevron_up][/icon_chevron_up]');
                        }
						
						else if(value == 'icon_chevron_down'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_chevron_down][/icon_chevron_down]');
                        }
						
						else if(value == 'icon_retweet'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_retweet][/icon_retweet]');
                        }
						
						else if(value == 'icon_shopping_cart'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_shopping_cart][/icon_shopping_cart]');
                        }
						
						else if(value == 'icon_folder_close'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_folder_close][/icon_folder_close]');
                        }
						
						else if(value == 'icon_folder_open'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_folder_open][/icon_folder_open]');
                        }
						
						else if(value == 'icon_resize_vertical'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_resize_vertical][/icon_resize_vertical]');
                        }
						
						else if(value == 'icon_resize_horizontal'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_resize_horizontal][/icon_resize_horizontal]');
                        }
						
						else if(value == 'icon_bar_chart'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_bar_chart][/icon_bar_chart]');
                        }
						
						else if(value == 'icon_twitter_sign'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_twitter_sign][/icon_twitter_sign]');
                        }
						
						else if(value == 'icon_facebook_sign'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_facebook_sign][/icon_facebook_sign]');
                        }
						
						else if(value == 'icon_camera_retro'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_camera_retro][/icon_camera_retro]');
                        }
						
						else if(value == 'icon_key'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_key][/icon_key]');
                        }
						
						else if(value == 'icon_cogs'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_cogs][/icon_cogs]');
                        }
						
						else if(value == 'icon_comments'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_comments][/icon_comments]');
                        }
						
						else if(value == 'icon_thumbs_up'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_thumbs_up][/icon_thumbs_up]');
                        }
						
						else if(value == 'icon_thumbs_down'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_thumbs_down][/icon_thumbs_down]');
                        }
						
						else if(value == 'icon_star_half'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_star_half][/icon_star_half]');
                        }
						
						else if(value == 'icon_heart_empty'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_heart_empty][/icon_heart_empty]');
                        }
						
						else if(value == 'icon_signout'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_signout][/icon_signout]');
                        }
						
						else if(value == 'icon_linkedin_sign'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_linkedin_sign][/icon_linkedin_sign]');
                        }
						
						else if(value == 'icon_pushpin'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_pushpin][/icon_pushpin]');
                        }
						
						else if(value == 'icon_external_link'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_external_link][/icon_external_link]');
                        }
						
						else if(value == 'icon_signin'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_signin][/icon_signin]');
                        }
						
						else if(value == 'icon_trophy'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_trophy][/icon_trophy]');
                        }
						
						else if(value == 'icon_github_sign'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_github_sign][/icon_github_sign]');
                        }
						
						else if(value == 'icon_upload_alt'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_upload_alt][/icon_upload_alt]');
                        }
						
						else if(value == 'icon_lemon'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_lemon][/icon_lemon]');
                        }
						
						else if(value == 'icon_phone'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_phone][/icon_phone]');
                        }
						
						else if(value == 'icon_check_empty'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_check_empty][/icon_check_empty]');
                        }
						
						else if(value == 'icon_bookmark_empty'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_bookmark_empty][/icon_bookmark_empty]');
                        }
						
						else if(value == 'icon_phone_sign'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_phone_sign][/icon_phone_sign]');
                        }
						
						else if(value == 'icon_twitter'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_twitter][/icon_twitter]');
                        }
						
						else if(value == 'icon_facebook'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_facebook][/icon_facebook]');
                        }
						
						else if(value == 'icon_github'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_github][/icon_github]');
                        }
						
						else if(value == 'icon_unlock'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_unlock][/icon_unlock]');
                        }
						
						else if(value == 'icon_credit_card'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_credit_card][/icon_credit_card]');
                        }
						
						else if(value == 'icon_rss'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_rss][/icon_rss]');
                        }
						
						else if(value == 'icon_hdd'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_hdd][/icon_hdd]');
                        }
						
						else if(value == 'icon_bullhorn'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_bullhorn][/icon_bullhorn]');
                        }
						
						else if(value == 'icon_bell'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_bell][/icon_bell]');
                        }
						
						else if(value == 'icon_certificate'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_certificate][/icon_certificate]');
                        }
						
						else if(value == 'icon_hand_right'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_hand_right][/icon_hand_right]');
                        }
						
						else if(value == 'icon_hand_left'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_hand_left][/icon_hand_left]');
                        }
						
						else if(value == 'icon_hand_up'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_hand_up][/icon_hand_up]');
                        }
						
						else if(value == 'icon_hand_down'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_hand_down][/icon_hand_down]');
                        }
						
						else if(value == 'icon_circle_arrow_left'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_circle_arrow_left][/icon_circle_arrow_left]');
                        }
						
						else if(value == 'icon_circle_arrow_right'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_circle_arrow_right][/icon_circle_arrow_right]');
                        }
						
						else if(value == 'icon_circle_arrow_up'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_circle_arrow_up][/icon_circle_arrow_up]');
                        }
						
						else if(value == 'icon_circle_arrow_down'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_circle_arrow_down][/icon_circle_arrow_down]');
                        }
						
						else if(value == 'icon_globe'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_globe][/icon_globe]');
                        }
						
						else if(value == 'icon_wrench'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_wrench][/icon_wrench]');
                        }
						
						else if(value == 'icon_tasks'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_tasks][/icon_tasks]');
                        }
						
						else if(value == 'icon_filter'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_filter][/icon_filter]');
                        }
						
						else if(value == 'icon_briefcase'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_briefcase][/icon_briefcase]');
                        }
						
						else if(value == 'icon_fullscreen'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_fullscreen][/icon_fullscreen]');
                        }
						
						else if(value == 'icon_group'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_group][/icon_group]');
                        }
						
						else if(value == 'icon_link'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_link][/icon_link]');
                        }
						
						else if(value == 'icon_cloud'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_cloud][/icon_cloud]');
                        }
						
						else if(value == 'icon_beaker'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_beaker][/icon_beaker]');
                        }
						
						else if(value == 'icon_cut'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_cut][/icon_cut]');
                        }
						
						else if(value == 'icon_copy'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_copy][/icon_copy]');
                        }
						
						else if(value == 'icon_paper_clip'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_paper_clip][/icon_paper_clip]');
                        }
						
						else if(value == 'icon_save'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_save][/icon_save]');
                        }
						
						else if(value == 'icon_sign_blank'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_sign_blank][/icon_sign_blank]');
                        }
						
						else if(value == 'icon_reorder'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_reorder][/icon_reorder]');
                        }
						
						else if(value == 'icon_list_ul'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_list_ul][/icon_list_ul]');
                        }
						
						else if(value == 'icon_list_ol'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_list_ol][/icon_list_ol]');
                        }
						
						else if(value == 'icon_strikethrough'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_strikethrough][/icon_strikethrough]');
                        }
						
						else if(value == 'icon_underline'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_underline][/icon_underline]');
                        }
						
						else if(value == 'icon_table'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_table][/icon_table]');
                        }
						
						else if(value == 'icon_magic'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_magic][/icon_magic]');
                        }
						
						else if(value == 'icon_truck'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_truck][/icon_truck]');
                        }
						
						else if(value == 'icon_pinterest'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_pinterest][/icon_pinterest]');
                        }
						
						else if(value == 'icon_pinterest_sign'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_pinterest_sign][/icon_pinterest_sign]');
                        }
						
						else if(value == 'icon_google_plus_sign'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_google_plus_sign][/icon_google_plus_sign]');
                        }
						
						else if(value == 'icon_google_plus'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_google_plus][/icon_google_plus]');
                        }
						
						else if(value == 'icon_money'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_money][/icon_money]');
                        }
						
						else if(value == 'icon_caret_down'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_caret_down][/icon_caret_down]');
                        }
						
						else if(value == 'icon_caret_up'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_caret_up][/icon_caret_up]');
                        }
						
						else if(value == 'icon_caret_left'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_caret_left][/icon_caret_left]');
                        }
						
						else if(value == 'icon_caret_right'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_caret_right][/icon_caret_right]');
                        }
						
						else if(value == 'icon_columns'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_columns][/icon_columns]');
                        }
						
						else if(value == 'icon_sort'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_sort][/icon_sort]');
                        }
						
						else if(value == 'icon_sort_down'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_sort_down][/icon_sort_down]');
                        }
						
						else if(value == 'icon_sort_up'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_sort_up][/icon_sort_up]');
                        }
						
						else if(value == 'icon_envelope_alt'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_envelope_alt][/icon_envelope_alt]');
                        }
						
						else if(value == 'icon_linkedin'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_linkedin][/icon_linkedin]');
                        }
						
						else if(value == 'icon_undo'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_undo][/icon_undo]');
                        }
						
						else if(value == 'icon_legal'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_legal][/icon_legal]');
                        }
						
						else if(value == 'icon_dashboard'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_dashboard][/icon_dashboard]');
                        }
						
						else if(value == 'icon_comment_alt'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_comment_alt][/icon_comment_alt]');
                        }
						
						else if(value == 'icon_bolt'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_bolt][/icon_bolt]');
                        }
						
						else if(value == 'icon_sitemap'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_sitemap][/icon_sitemap]');
                        }
						
						else if(value == 'icon_umbrella'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_umbrella][/icon_umbrella]');
                        }
						
						
						else if(value == 'icon_paste'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_paste][/icon_paste]');
                        }
						
						else if(value == 'icon_user_md'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_user_md][/icon_user_md]');
                        }
						
						
						
						
						
						
						
						
						
						
						
						
						else if(value == 'icon_dribbble'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_dribbble][/icon_dribbble]');
                        }
						
						else if(value == 'icon_facebook2'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_facebook2][/icon_facebook2]');
                        }
						
						else if(value == 'icon_twitter2'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_twitter2][/icon_twitter2]');
                        }
						
						else if(value == 'icon_flickr'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_flickr][/icon_flickr]');
                        }

						else if(value == 'icon_linkedin2'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_linkedin2][/icon_linkedin2]');
                        }
						
						else if(value == 'icon_vimeo'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_vimeo][/icon_vimeo]');
                        }
						
						else if(value == 'icon_google'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_google][/icon_google]');
                        }
						
						else if(value == 'icon_share_icon'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_share_icon][/icon_share_icon]');
                        }
						else if(value == 'icon_delicious'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_delicious][/icon_delicious]');
                        }
						else if(value == 'icon_digg'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_digg][/icon_digg]');
                        }
						else if(value == 'icon_ember'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_ember][/icon_ember]');
                        }
						else if(value == 'icon_forrst'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_forrst][/icon_forrst]');
                        }
						else if(value == 'icon_last_fm'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_last_fm][/icon_last_fm]');
                        }
						else if(value == 'icon_my_space'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_my_space][/icon_my_space]');
                        }
						else if(value == 'icon_quora'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_quora][/icon_quora]');
                        }
						else if(value == 'icon_rss2'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_rss2][/icon_rss2]');
                        }
						
						else if(value == 'icon_sharethis'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_sharethis][/icon_sharethis]');
                        }
						
						else if(value == 'icon_skype'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_skype][/icon_skype]');
                        }
						
						else if(value == 'icon_stumbleupon'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_stumbleupon][/icon_stumbleupon]');
                        }
						
						else if(value == 'icon_tumblr'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_tumblr][/icon_tumblr]');
                        }
						
						else if(value == 'icon_you_tube'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_you_tube][/icon_you_tube]');
                        }
						
						else if(value == 'icon_aim'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_aim][/icon_aim]');
                        }
						
						else if(value == 'icon_behance'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_behance][/icon_behance]');
                        }
						
						else if(value == 'icon_evernote'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_evernote][/icon_evernote]');
                        }
						
						else if(value == 'icon_github2'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_github2][/icon_github2]');
                        }
						
						else if(value == 'icon_paypal'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_paypal][/icon_paypal]');
                        }
						
						else if(value == 'icon_wordpress'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_wordpress][/icon_wordpress]');
                        }
						
						else if(value == 'icon_yahoo'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_yahoo][/icon_yahoo]');
                        }
						
						else if(value == 'icon_zerply'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_zerply][/icon_zerply]');
                        }
						
						
						
											
						
						
                     }
                });

				
				cols.add('glass', 'icon_glass');
                cols.add('music', 'icon_music');
				cols.add('search', 'icon_search');
				cols.add('envelope', 'icon_envelope');
				cols.add('heart', 'icon_heart');
				cols.add('star', 'icon_star');
				cols.add('star_empty', 'icon_star_empty');
				cols.add('user', 'icon_user');
				cols.add('film', 'icon_film');
				cols.add('th_large', 'icon_th_large');
				cols.add('th', 'icon_th');
				cols.add('th_list', 'icon_th_list');
				cols.add('ok', 'icon_ok');
				cols.add('remove', 'icon_remove');
				cols.add('zoom_in', 'icon_zoom_in');
				cols.add('zoom_out', 'icon_zoom_out');
				cols.add('off', 'icon_off');
				cols.add('signal', 'icon_signal');
				cols.add('cog', 'icon_cog');
				cols.add('trash', 'icon_trash');
				cols.add('home', 'icon_home');
				cols.add('file', 'icon_file');
				cols.add('time', 'icon_time');
				cols.add('road', 'icon_road');
				cols.add('download_alt', 'icon_download_alt');
				cols.add('download', 'icon_download');
				cols.add('upload', 'icon_upload');
				cols.add('inbox', 'icon_inbox');
				cols.add('play_circle', 'icon_play_circle');
				cols.add('repeat', 'icon_repeat');
				cols.add('refresh', 'icon_refresh');
				cols.add('list_alt', 'icon_list_alt');
				cols.add('lock', 'icon_lock');
				cols.add('flag', 'icon_flag');
				cols.add('headphones', 'icon_headphones');
				cols.add('volume_off', 'icon_volume_off');
				cols.add('volume_down', 'icon_volume_down');
				cols.add('volume_up', 'icon_volume_up');
				cols.add('qrcode', 'icon_qrcode');
				cols.add('barcode', 'icon_barcode');
				cols.add('tag', 'icon_tag');
				cols.add('tags', 'icon_tags');
				cols.add('book', 'icon_book');
				cols.add('bookmark', 'icon_bookmark');
				cols.add('print', 'icon_print');
				cols.add('camera', 'icon_camera');
				cols.add('font', 'icon_font');
				cols.add('bold', 'icon_bold');
				cols.add('italic', 'icon_italic');
				cols.add('text_height', 'icon_text_height');
				cols.add('text_width', 'icon_text_width');
				cols.add('align_left', 'icon_align_left');
				cols.add('align_center', 'icon_music');
				cols.add('align_center', 'icon_align_center');
				cols.add('align_right', 'icon_align_right');
				cols.add('align_justify', 'icon_align_justify');
				cols.add('list', 'icon_list');
				cols.add('indent_left', 'icon_indent_left');
				cols.add('indent_right', 'icon_indent_right');
				cols.add('picture', 'icon_picture');
				cols.add('pencil', 'icon_pencil');
				cols.add('map_marker', 'icon_map_marker');
				cols.add('adjust', 'icon_adjust');
				cols.add('tint', 'icon_tint');
				cols.add('edit', 'icon_edit');
				cols.add('share', 'icon_share');
				cols.add('check', 'icon_check');
				cols.add('move', 'icon_move');
				cols.add('step_backward', 'icon_step_backward');
				cols.add('fast_backward', 'icon_fast_backward');
				cols.add('backward', 'icon_backward');
				cols.add('play', 'icon_play');
				cols.add('pause', 'icon_pause');
				cols.add('stop', 'icon_stop');
				cols.add('forward', 'icon_forward');
				cols.add('fast_forward', 'icon_fast_forward');
				cols.add('step_forward', 'icon_step_forward');
				cols.add('eject', 'icon_eject');
				cols.add('chevron_left', 'icon_chevron_left');
				cols.add('chevron_right', 'icon_chevron_right');
				cols.add('plus_sign', 'icon_plus_sign');
				cols.add('minus_sign', 'icon_minus_sign');
				cols.add('remove_sign', 'icon_remove_sign');
				cols.add('ok_sign', 'icon_ok_sign');
				cols.add('question_sign', 'icon_question_sign');
				cols.add('info_sign', 'icon_info_sign');
				cols.add('screenshot', 'icon_screenshot');
				cols.add('remove_circle', 'icon_remove_circle');
				cols.add('ok_circle', 'icon_ok_circle');
				cols.add('ban_circle', 'icon_ban_circle');
				cols.add('arrow_left', 'icon_arrow_left');
				cols.add('arrow_right', 'icon_arrow_right');
				cols.add('arrow_up', 'icon_arrow_up');
				cols.add('arrow_down', 'icon_arrow_down');
				cols.add('share_alt', 'icon_share_alt');
				cols.add('resize_full', 'icon_resize_full');
				cols.add('resize_small', 'icon_resize_small');
				cols.add('plus', 'icon_plus');
				cols.add('minus', 'icon_minus');
				cols.add('asterisk', 'icon_asterisk');
				cols.add('exclamation_sign', 'icon_exclamation_sign');
				cols.add('gift', 'icon_gift');
				cols.add('fire', 'icon_fire');
				cols.add('eye_open', 'icon_eye_open');
				cols.add('eye_close', 'icon_eye_close');
				cols.add('warning_sign', 'icon_warning_sign');
				cols.add('plane', 'icon_plane');
				cols.add('calendar', 'icon_calendar');
				cols.add('random', 'icon_random');
				cols.add('comment', 'icon_comment');
				cols.add('magnet', 'icon_magnet');
				cols.add('chevron_up', 'icon_chevron_up');
				cols.add('chevron_down', 'icon_chevron_down');
				cols.add('retweet', 'icon_retweet');
				cols.add('shopping_cart', 'icon_shopping_cart');
				cols.add('folder_close', 'icon_folder_close');
				cols.add('folder_open', 'icon_folder_open');
				cols.add('resize_vertical', 'icon_resize_vertical');
				cols.add('resize_horizontal', 'icon_resize_horizontal');
				cols.add('bar_chart', 'icon_bar_chart');
				cols.add('twitter_sign', 'icon_twitter_sign');
				cols.add('facebook_sign', 'icon_facebook_sign');
				cols.add('camera_retro', 'icon_camera_retro');
				cols.add('key', 'icon_key');
				cols.add('cogs', 'icon_cogs');
				cols.add('comments', 'icon_comments');
				cols.add('thumbs_up', 'icon_thumbs_up');
				cols.add('thumbs_down', 'icon_thumbs_down');
				cols.add('star_half', 'icon_star_half');
				cols.add('heart_empty', 'icon_heart_empty');
				cols.add('signout', 'icon_signout');
				cols.add('linkedin_sign', 'icon_linkedin_sign');
				cols.add('pushpin', 'icon_pushpin');
				cols.add('external_link', 'icon_external_link');
				cols.add('signin', 'icon_signin');
				cols.add('trophy', 'icon_trophy');
				cols.add('github_sign', 'icon_github_sign');
				cols.add('upload_alt', 'icon_upload_alt');
				cols.add('lemon', 'icon_lemon');
				cols.add('phone', 'icon_phone');
				cols.add('check_empty', 'icon_check_empty');
				cols.add('bookmark_empty', 'icon_bookmark_empty');
				cols.add('phone_sign', 'icon_phone_sign');
				cols.add('twitter', 'icon_twitter');
				cols.add('facebook', 'icon_facebook');
				cols.add('github', 'icon_github');
				cols.add('unlock', 'icon_unlock');
				cols.add('credit_card', 'icon_credit_card');
				cols.add('rss', 'icon_rss');
				cols.add('hdd', 'icon_hdd');
				cols.add('bullhorn', 'icon_bullhorn');
				cols.add('bell', 'icon_bell');
				cols.add('certificate', 'icon_certificate');
				cols.add('hand_right', 'icon_hand_right');
				cols.add('hand_left', 'icon_hand_left');
				cols.add('hand_up', 'icon_hand_up');
				cols.add('hand_down', 'icon_hand_down');
				cols.add('circle_arrow_left', 'icon_circle_arrow_left');
				cols.add('circle_arrow_right', 'icon_circle_arrow_right');
				cols.add('circle_arrow_up', 'icon_circle_arrow_up');
				cols.add('circle_arrow_down', 'icon_circle_arrow_down');
				cols.add('globe', 'icon_globe');
				cols.add('wrench', 'icon_wrench');
				cols.add('tasks', 'icon_tasks');
				cols.add('filter', 'icon_filter');
				cols.add('briefcase', 'icon_briefcase');
				cols.add('fullscreen', 'icon_fullscreen');
				cols.add('group', 'icon_group');
				cols.add('link', 'icon_link');
				cols.add('cloud', 'icon_cloud');
				cols.add('beaker', 'icon_beaker');
				cols.add('cut', 'icon_cut');
				cols.add('copy', 'icon_copy');
				cols.add('paper_clip', 'icon_paper_clip');
				cols.add('save', 'icon_save');
				cols.add('sign_blank', 'icon_sign_blank');
				cols.add('reorder', 'icon_reorder');
				cols.add('list_ul', 'icon_list_ul');
				cols.add('list_ol', 'icon_list_ol');
				cols.add('strikethrough', 'icon_strikethrough');
				cols.add('underline', 'icon_underline');
				cols.add('table', 'icon_table');
				cols.add('magic', 'icon_magic');
				cols.add('truck', 'icon_truck');
				cols.add('pinterest', 'icon_pinterest');
				cols.add('pinterest_sign', 'icon_pinterest_sign');
				cols.add('google_plus_sign', 'icon_google_plus_sign');
				cols.add('google_plus', 'icon_google_plus');
				cols.add('money', 'icon_money');
				cols.add('caret_down', 'icon_caret_down');
				cols.add('caret_up', 'icon_caret_up');
				cols.add('caret_left', 'icon_caret_left');
				cols.add('caret_right', 'icon_caret_right');
				cols.add('columns', 'icon_columns');
				cols.add('sort', 'icon_sort');
				cols.add('sort_down', 'icon_sort_down');
				cols.add('sort_up', 'icon_sort_up');
				cols.add('envelope_alt', 'icon_envelope_alt');
				cols.add('linkedin', 'icon_linkedin');
				cols.add('undo', 'icon_undo');
				cols.add('legal', 'icon_legal');
				cols.add('dashboard', 'icon_dashboard');
				cols.add('comment_alt', 'icon_comment_alt');
				cols.add('bolt', 'icon_bolt');
				cols.add('sitemap', 'icon_sitemap');
				cols.add('umbrella', 'icon_umbrella');
				cols.add('paste', 'icon_paste');
				cols.add('user_md', 'icon_user_md');
				
				
				
				
				


                return cols;
             }
             
             return null;
		},

	});

	// Register plugin
	tinymce.PluginManager.add('<?php echo $cscIconFAs->IconFAsButton; ?>', tinymce.plugins.<?php echo $cscIconFAs->IconFAsButton; ?>);
	
})();