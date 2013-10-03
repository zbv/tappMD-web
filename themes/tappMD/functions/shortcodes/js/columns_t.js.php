<?php 

 
	require_once('../../../../../../wp-load.php');
	require_once('../../../../../../wp-admin/includes/admin.php');
	do_action('admin_init');
	
	if ( ! is_user_logged_in() )
		die('You must be logged in to access this script.');
	
?>

(function() {
	tinymce.create('tinymce.plugins.<?php echo $cscColumns->colsButton; ?>', {
		createControl : function(n, cm) {
			if(n=='<?php echo $cscColumns->colsButton; ?>'){
                var cols = cm.createListBox('<?php echo $cscColumns->colsButton; ?>List', {
                     title : 'Grid System',
                     onselect : function(value) {
                        if(value == 'row'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[row]Columns row[/row]');
                        }
						
                     	else if(value == 'span12'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[span12]Columns span12[/span12]');
                        }
						
						else if(value == 'span11'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[span11]Columns span11[/span11]');
                        }
						
                        else if(value == 'span10'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[span10]Columns span10[/span10]');
                        }
						
						else if(value == 'span9'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[span9]Columns span9[/span9]');
                        }
						
						else if(value == 'span8'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[span8]Columns span8[/span8]');
                        }
						
						else if(value == 'span7'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[span7]Columns span7[/span7]');
                        }
						
						else if(value == 'span6'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[span6]Columns span6[/span6]');
                        }
						
						else if(value == 'span5'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[span5]Columns span5[/span5]');
                        }
						
						else if(value == 'span4'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[span4]Columns span4[/span4]');
                        }
						
						else if(value == 'span3'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[span3]Columns span3[/span3]');
                        }
						
						else if(value == 'span2'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[span2]Columns span2[/span2]');
                        }
						
						else if(value == 'span1'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[span1]Columns span1[/span1]');
                        }
						
						else if(value == 'offset12'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[offset12]Columns offset12[/offset12]');
                        }
						
						else if(value == 'offset11'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[offset11]Columns offset11[/offset11]');
                        }
						
						else if(value == 'offset10'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[offset10]Columns offset10[/offset10]');
                        }
						
						else if(value == 'offset9'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[offset9]Columns offset9[/offset9]');
                        }
						
						else if(value == 'offset8'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[offset8]Columns offset8[/offset8]');
                        }
						
						else if(value == 'offset7'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[offset7]Columns offset7[/offset7]');
                        }
						
						else if(value == 'offset6'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[offset6]Columns offset6[/offset6]');
                        }
						
						else if(value == 'offset5'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[offset5]Columns offset5[/offset5]');
                        }
						
						else if(value == 'offset4'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[offset4]Columns offset4[/offset4]');
                        }
						
						else if(value == 'offset3'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[offset3]Columns offset3[/offset3]');
                        }
						
						else if(value == 'offset2'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[offset2]Columns offset2[/offset2]');
                        }
						
						else if(value == 'offset1'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[offset1]Columns offset1[/offset1]');
                        }
						
						else if(value == 'row_fluid'){
                         	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[row_fluid]Columns row_fluid[/row_fluid]');
                        }
						
						
                     }
                });
                
                cols.add('Col row', 'row');
                cols.add('Col span12', 'span12');
				cols.add('Col span11', 'span11');
				cols.add('Col span10', 'span10');
				cols.add('Col span9', 'span9');
				cols.add('Col span8', 'span8');
				cols.add('Col span7', 'span7');
				cols.add('Col span6', 'span6');
				cols.add('Col span5', 'span5');
				cols.add('Col span4', 'span4');
				cols.add('Col span3', 'span3');
				cols.add('Col span2', 'span2');
				cols.add('Col span1', 'span1');
                cols.add('-- Col offset--', '-');
				cols.add('Col offset12', 'offset12');
				cols.add('Col offset11', 'offset11');
				cols.add('Col offset10', 'offset10');
				cols.add('Col offset9', 'offset9');
				cols.add('Col offset8', 'offset8');
				cols.add('Col offset7', 'offset7');
				cols.add('Col offset6', 'offset6');
				cols.add('Col offset5', 'offset5');
				cols.add('Col offset4', 'offset4');
				cols.add('Col offset3', 'offset3');
				cols.add('Col offset2', 'offset2');
				cols.add('Col offset1', 'offset1');
				cols.add('Col row_fluid', 'row_fluid');

                return cols;
             }
             
             return null;
		},

	});

	// Register plugin
	tinymce.PluginManager.add('<?php echo $cscColumns->colsButton; ?>', tinymce.plugins.<?php echo $cscColumns->colsButton; ?>);
	
})();