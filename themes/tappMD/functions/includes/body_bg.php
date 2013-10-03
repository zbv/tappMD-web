<?php
$images_bg_no ='';
$images_bg ='';
$bg_color_page ='';
$images_bg = rwmb_meta( 'csc_screenshot32', 'type=image' );
$bg_color_page = rwmb_meta( 'csc_bg_color_page', 'type=color' );
if (!empty ($images_bg))
{
foreach ( $images_bg as $image_no_res )
    {
   $images_bg_no = $image_no_res['full_url'];
    }
}

if ($images_bg_no && $bg_color_page !== '#'){ echo 'style="background:'.$bg_color_page.' url(' .$images_bg_no. ') fixed;"';}
elseif ($images_bg_no && $bg_color_page == '#'){ echo 'style="background: url(' .$images_bg_no. ') fixed;"';}
elseif ($images_bg_no){ echo 'style="background: url(' .$images_bg_no. ') fixed;"';}
elseif ($bg_color_page == '#'){$background = csc_option('csc_theme_background'); echo 'style="background: '.$background['color'].' url('.$background['image'].') '.$background['repeat'].' '.$background['position'].' '.$background['attachment'].' "';}
elseif ($bg_color_page){ echo 'style="background-color:'.$bg_color_page.'"';}
else{ $background = csc_option('csc_theme_background'); echo 'style="background: '.$background['color'].' url('.$background['image'].') '.$background['repeat'].' '.$background['position'].' '.$background['attachment'].' "';}; 
?>