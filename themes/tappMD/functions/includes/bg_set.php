<?php
$images_bg_no ='';
$images_bg ='';
$bg_color_page =''; 

$slide_bg_show = rwmb_meta( 'csc_bg_slide_show', 'type=checkbox' );
$slide_bg_delay = rwmb_meta( 'csc_bg_slide_delay', 'type=text' );

$images = rwmb_meta( 'csc_overlay_bg');
$over_bg = $images;
?>
 
<?php if ($images_bg){?>

<?php 
} else if ($slide_bg_show){ ?>

<script type="text/javascript">
jQuery( function() {
	
	jQuery.vegas( 'slideshow', { 
        backgrounds:[ <?php  
$metas = rwmb_meta( 'csc_screenshot3', 'type=image' );
foreach ( $metas as $meta )
{
print_r( '{ src:\''.$meta['full_url'].'\'},');
}
?>],
fade: 500,
delay: <?php if ($slide_bg_delay){ echo $slide_bg_delay;}else{ echo '3000';} ?>,
valign:'center', 
align:'center' 
     })('overlay', {
	src:'<?php echo get_template_directory_uri(); ?>/images/overlays/<?php echo $over_bg; ?>.png',
	opacity:0.5
  });

});
</script>

  
 <?php } else {?>
 
 <?php 

 $images_bg ='';
 $images = rwmb_meta( 'csc_screenshot3', 'type=image' );
if (!empty ($images))
{
 foreach ( $images as $imagess )
    {
   $images_bg = $imagess['full_url'];
    }
}
 ?> 
<?php if ($images = rwmb_meta( 'csc_screenshot3', 'type=image' ) || $over_bg > 0)
{ ?>
<script type="text/javascript">
jQuery( function() {
	
  jQuery.vegas({
    src:'<?php echo $images_bg; ?>',
	fade:500, // milliseconds,
	valign:'center', // top, center, bottom or %
    align:'center' // left, center, right or %
	
  })('overlay', {
	src:'<?php echo get_template_directory_uri(); ?>/images/overlays/<?php echo $over_bg; ?>.png',
	opacity:0.5
  });
  
});
</script>
<?php }?>
 
<?php }?>