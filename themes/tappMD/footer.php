
 </div>
 <div class="divider"></div>
</div>
<!-- boxed
================================================== -->
</div>
</div>

<!-- Footer
================================================== -->

<div class="footers">

<div class="container">



<div class="row" style="margin-left:0;">

<footer class="container" id="footers">

    <div class="row">
    
      <div class="span3">
        <?php dynamic_sidebar("Footer 1"); ?>
      </div>
      
      <div class="span3">
       <?php dynamic_sidebar("Footer 2"); ?>
      </div>
      
      <div class="span3">
        <?php dynamic_sidebar("Footer 3"); ?>
      </div>
      
      <div class="span3">
        <?php dynamic_sidebar("Footer 4"); ?>
      </div>
      
    </div>

  
  <div class="bottom_copy">

    <div class="row">
    
    <div class="span6 copy"><div style="margin-left:10px;">
	<?php if (csc_option('csc_copyright')) {
			echo csc_option('csc_copyright'); 
		} else {
		$url = home_url('/');
        echo '&copy;';
		echo date("Y");
		echo ' - <a href="'.$url.'">';
		echo  bloginfo( 'name' );
		echo '</a>';
		echo ' - All Rights Reserved';
		} ?>
        
    </div></div>
    <div class="span6">

<?php $defaults = array(
	'theme_location'  => 'csc-theme-menu-footer',
	'menu'            => '', 
	'container'       => 'div', 
	'container_class' => '', 
	'container_id'    => '',
	'menu_class'      => 'menu-f', 
	'menu_id'         => '',
	//'echo'            => false,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s </ul>',
	'depth'           => 1,
	'walker'          => ''
); ?>

<?php wp_nav_menu( $defaults ); ?>
     </div>
     
  </div>
  
</div>

</footer>

</div>
</div>

</div>

<?php //if ( wp_is_mobile() ) { ?>

	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.jpanelmenu.min.js"></script>
	
<?php // } ?>

 <?php wp_footer(); ?>
 

 <?php if ( csc_option('csc_ga_code') ) {?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo csc_option('csc_ga_code'); ?>']);
  _gaq.push(['_setDomainName', '<?php echo csc_option('csc_ga_domain'); ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php } if (csc_option('csc_sharethis')) {?>
<script type="text/javascript">stLight.options({publisher: "<?php echo csc_option('csc_sharethis') ?>", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<script>
var options={ "publisher": "<?php echo csc_option('csc_sharethis') ?>", "position": "left", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["twitter", "facebook", "pinterest", "linkedin", "googleplus", "email"]}};
var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
</script>
<?php } ?>
</body>
</html>