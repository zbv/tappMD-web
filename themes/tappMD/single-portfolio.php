<?php
$ajax_portfolios = csc_option('csc_ajax_portfolios');
?>  

<?php if ($ajax_portfolios == 1)
 {
 get_template_part( '/partials/content','single-portfolio-ajax' ); 
 }
		   
else
{
get_template_part( '/partials/content','single-portfolio' );  
} 
?>


