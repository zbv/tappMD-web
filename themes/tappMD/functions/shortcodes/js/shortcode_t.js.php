<?php 

 
	require_once('../../../../../../wp-load.php');
	require_once('../../../../../../wp-admin/includes/admin.php');
	do_action('admin_init');
	
	if ( ! is_user_logged_in() )
		die('You must be logged in to access this script.');
	
?>

(function() {
	tinymce.create('tinymce.plugins.<?php echo $cscShortcodes->shortcodesButton; ?>', {
		createControl : function(n, cm) {
			if(n=='<?php echo $cscShortcodes->shortcodesButton; ?>'){
                var cols = cm.createListBox('<?php echo $cscShortcodes->shortcodesButton; ?>List', {
                     title : 'Misk',
                     onselect : function(value) {
                     	if(value == 'dropcap'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[dropcap] [/dropcap]');
                        }
                        else if(value == 'button'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[button link="#" target="_blank" style="none, small, large, biglarge" title="Link Title"][/button]');
                        }
						
						else if(value == 'button_tb'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[button_tb link="#" target="_blank" style="none, btn-info, btn-primary, btn-success, btn-warning, btn-danger, btn-inverse, btn-large, btn-small, btn-mini, disabled" title="Link Title"][/button_tb]');
                        }
						
						else if(value == 'divider'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[divider]');
                        }
						
						else if(value == 'well_tb'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[well_tb][/well_tb]');
                        }
						
						else if(value == 'aside'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[aside] [/aside]');
                        }
                        else if(value == 'blockquote'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[blockquote] [/blockquote]');
                        }
						else if(value == 'tabgro'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[tabgroup] [tab title="First tab" id="tab1" class="active"] First Content [/tab] [tab title="Second Tab" id="tab2"] Second Content [/tab] [tab title="Third Tab" id="tab3"] Third Content [/tab] [/tabgroup]');
                        }
                        else if(value == 'toggle'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[toggle title="Toggle title"] [/toggle]');
                        }
                        else if(value == 'accordion'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[accordion title="Accordion title"] [/accordion][accordion title="Accordion title"] [/accordion][accordion title="Accordion title"] [/accordion]');
                        }
						else if(value == 'box'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[box style="none, info, note, confirm, error"] This is an message box (select style). [/box]');
							
						}
						else if(value == 'tb_label'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[tb_label style="none, label-warning, label-success, label-important, label-info, label-inverse"] Label Title. [/tb_label]');
                        }
						
						else if(value == 'tb_badges'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[tb_badges style="none, badge-success, badge-warning, badge-important, badge-info, badge-inverse"] Badge Title. [/tb_badges]');
                        }
						else if(value == 'clear'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[clear]');
                        }
                        
                        
                        else if(value == 'progress_bar'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[progress_bar style="progress-success" width="20%"][/progress_bar]');
                        }
                        
                        
						
						
						
						
						
						else if(value == 'icon_dribbble'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_dribbble link=# ][/icon_dribbble]');
                        }
						
						else if(value == 'icon_facebook2'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_facebook2 link=#][/icon_facebook2]');
                        }
						
						else if(value == 'icon_twitter2'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_twitter2 link=#][/icon_twitter2]');
                        }
						
						else if(value == 'icon_flickr'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_flickr link=#][/icon_flickr]');
                        }
                        
                        

						else if(value == 'icon_linkedin2'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_linkedin2 link=#][/icon_linkedin2]');
                        }
						
						else if(value == 'icon_vimeo'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_vimeo link=#][/icon_vimeo]');
                        }
						
						else if(value == 'icon_google'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_google link=#][/icon_google]');
                        }
                        
                        else if(value == 'icon_googleplus'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_googleplus link=#][/icon_googleplus]');
                        }
						
                         else if(value == 'icon_pinterest2'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_pinterest2 link=#][/icon_pinterest2]');
                        }
                        
                        else if(value == 'icon_instagram'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_instagram link=#][/icon_instagram]');
                        }
					
						else if(value == 'icon_delicious'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_delicious link=#][/icon_delicious]');
                        }
						else if(value == 'icon_digg'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_digg link=#][/icon_digg]');
                        }
						else if(value == 'icon_ember'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_ember link=#][/icon_ember]');
                        }
						else if(value == 'icon_forrst'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_forrst link=#][/icon_forrst]');
                        }
						else if(value == 'icon_last_fm'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_last_fm link=#][/icon_last_fm]');
                        }
						else if(value == 'icon_my_space'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_my_space link=#][/icon_my_space]');
                        }
						else if(value == 'icon_rss2'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_rss2 link=#][/icon_rss2]');
                        }
						
						else if(value == 'icon_apple'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_apple link=#][/icon_apple]');
                        }
						
						else if(value == 'icon_skype'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_skype link=#][/icon_skype]');
                        }
						
						else if(value == 'icon_stumbleupon'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_stumbleupon link=#][/icon_stumbleupon]');
                        }
						
						else if(value == 'icon_tumblr'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_tumblr link=#][/icon_tumblr]');
                        }
						
						else if(value == 'icon_you_tube'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_you_tube link=#][/icon_you_tube]');
                        }
						
						else if(value == 'icon_aim'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_aim link=#][/icon_aim]');
                        }
						
						else if(value == 'icon_behance'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_behance link=#][/icon_behance]');
                        }
						
						else if(value == 'icon_evernote'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_evernote link=#][/icon_evernote]');
                        }
						
						else if(value == 'icon_github2'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_github2 link=#][/icon_github2]');
                        }
						
						else if(value == 'icon_paypal'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_paypal link=#][/icon_paypal]');
                        }
						
						else if(value == 'icon_wordpress'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_wordpress link=#][/icon_wordpress]');
                        }
						
						else if(value == 'icon_yahoo'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_yahoo link=#][/icon_yahoo]');
                        }
						
						else if(value == 'icon_zerply'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_zerply link=#][/icon_zerply]');
                        }
						
                        else if(value == 'icon_blogger'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_blogger link=#][/icon_blogger]');
                        }
                        
                        else if(value == 'icon_cargo'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_cargo link=#][/icon_cargo]');
                        }
                        
                        
                        
                        else if(value == 'icon_deviantart'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_deviantart link=#][/icon_deviantart]');
                        }
                        
                        else if(value == 'icon_dopplr'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_dopplr link=#][/icon_dopplr]');
                        }
                        
                        else if(value == 'icon_gowalla'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_gowalla link=#][/icon_gowalla]');
                        }
                        
                        else if(value == 'icon_grooveshark'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_grooveshark link=#][/icon_grooveshark]');
                        }
                        
                        else if(value == 'icon_html5'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_html5 link=#][/icon_html5]');
                        }
                        
                        else if(value == 'icon_icloud'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_icloud link=#][/icon_icloud]');
                        }
                        
                        else if(value == 'icon_metacafe'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_metacafe link=#][/icon_metacafe]');
                        }
                        
                        else if(value == 'icon_mixx'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_mixx link=#][/icon_mixx]');
                        }
                        
                        else if(value == 'icon_myspace'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_myspace link=#][/icon_myspace]');
                        }
                        
                        else if(value == 'icon_netvibes'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_netvibes link=#][/icon_netvibes]');
                        }
                        
                        else if(value == 'icon_newsvine'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_newsvine link=#][/icon_newsvine]');
                        }
                        
                        else if(value == 'icon_orkut'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_orkut link=#][/icon_orkut]');
                        }
                        
                        else if(value == 'icon_picasa'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_picasa link=#][/icon_picasa]');
                        }
                        
                        else if(value == 'icon_plurk'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_plurk link=#][/icon_plurk]');
                        }
                        
                        else if(value == 'icon_posterous'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_posterous link=#][/icon_posterous]');
                        }
                        
                        else if(value == 'icon_reddit'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_reddit link=#][/icon_reddit]');
                        }
                        
                        else if(value == 'icon_technorati'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_technorati link=#][/icon_technorati]');
                        }
                        
                        else if(value == 'icon_yelp'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_yelp link=#][/icon_yelp]');
                        }
                        
                        else if(value == 'icon_zootool'){
                        	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon_zootool link=#][/icon_zootool]');
                        }
                        

                        
                        
                        
                        
						
                     }
                });
				
				cols.add('Dropcap', 'dropcap');
                cols.add('Button', 'button');
				cols.add('Divider', 'divider');
				cols.add('Aside', 'aside');
                cols.add('Blockquote', 'blockquote');
				cols.add('Tabs', 'tabgro');
                cols.add('Toggle', 'toggle');
                cols.add('Accordion', 'accordion');
                cols.add('Skills Progress bar', 'progress_bar');
				cols.add('Message Box', 'box');
				cols.add('Clear', 'clear');
                
                cols.add('-- Social icon--', '-');
                
                cols.add('dribbble', 'icon_dribbble');
				cols.add('facebook', 'icon_facebook2');
				cols.add('twitter', 'icon_twitter2');
				cols.add('flickr', 'icon_flickr');
				cols.add('linkedin', 'icon_linkedin2');
				cols.add('vimeo', 'icon_vimeo');
				cols.add('google', 'icon_google');
                cols.add('pinterest', 'icon_pinterest2');
				cols.add('instagram', 'icon_instagram');                 
                cols.add('googleplus', 'icon_googleplus');
				cols.add('delicious', 'icon_delicious');
				cols.add('digg', 'icon_digg');
				cols.add('ember', 'icon_ember');
				cols.add('forrst', 'icon_forrst');
				cols.add('last_fm', 'icon_last_fm');
				cols.add('my_space', 'icon_my_space');
				cols.add('rss', 'icon_rss2');
				cols.add('apple', 'icon_apple');
				cols.add('skype', 'icon_skype');
				cols.add('stumbleupon', 'icon_stumbleupon');
				cols.add('tumblr', 'icon_tumblr');
				cols.add('you_tube', 'icon_you_tube');
				cols.add('aim', 'icon_aim');
				cols.add('behance', 'icon_behance');
				cols.add('evernote', 'icon_evernote');
				cols.add('github', 'icon_github2');
				cols.add('paypal', 'icon_paypal');
				cols.add('wordpress', 'icon_wordpress');
				cols.add('yahoo', 'icon_yahoo');
				cols.add('zerply', 'icon_zerply');
                cols.add('blogger', 'icon_blogger');
				cols.add('cargo', 'icon_cargo');
                cols.add('deviantart', 'icon_deviantart');
                cols.add('dopplr', 'icon_dopplr');
                cols.add('gowalla', 'icon_gowalla');
                cols.add('grooveshark', 'icon_grooveshark');
                cols.add('html5', 'icon_html5');
                cols.add('icloud', 'icon_icloud');
                cols.add('metacafe', 'icon_metacafe');
                cols.add('mixx', 'icon_mixx');
                cols.add('myspace', 'icon_myspace');
                cols.add('netvibes', 'icon_netvibes');
                cols.add('newsvine', 'icon_newsvine');
                cols.add('orkut', 'icon_orkut');
                cols.add('picasa', 'icon_picasa');
                cols.add('plurk', 'icon_plurk');
                cols.add('posterous', 'icon_posterous');
                cols.add('reddit', 'icon_reddit');
                cols.add('technorati', 'icon_technorati');
                cols.add('yelp', 'icon_yelp');
                cols.add('zootool', 'icon_zootool');
                
                cols.add('-- Bootstrap--', '-');
				
				cols.add('Button TB', 'button_tb');
				cols.add('Label TB', 'tb_label');
				cols.add('Badge TB', 'tb_badges');
				cols.add('Well TB', 'well_tb');
				
				


                return cols;
             }
             
             return null;
		},

	});

	// Register plugin
	tinymce.PluginManager.add('<?php echo $cscShortcodes->shortcodesButton; ?>', tinymce.plugins.<?php echo $cscShortcodes->shortcodesButton; ?>);
	
})();