<section>
<script>

jQuery(document).ready(function() { 

	 jQuery('#submit').click(function() {  
	 	
			// name validation
			
			var nameVal = jQuery("#fname").val();
			if(nameVal == '') {
				
				jQuery("#fname_error").html('');
				jQuery("#fname").after('<label class="error" id="fname_error">Please enter your first name.</label>').addClass("error-input");
				return false
			}
			else
			{
				jQuery("#fname_error").html('');
				jQuery("#fname").removeClass("error-input");
			}
			
			// name 2 validation
			
			var nameVal = jQuery("#lname").val();
			if(nameVal == '') {
				
				jQuery("#lname_error").html('');
				jQuery("#lname").after('<label class="error" id="lname_error">Please enter your last name.</label>').addClass("error-input");
				return false
			}
			else
			{
				jQuery("#lname_error").html('');
				jQuery("#lname").removeClass("error-input");
			}
			
			/// email validation
			
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			var emailaddressVal = jQuery("#email").val();
			
			if(emailaddressVal == '') {
				jQuery("#email_error").html('');
				jQuery("#email").after('<label class="error" id="email_error">Please enter your email address.</label>').addClass("error-input");
				return false
			}
			else if(!emailReg.test(emailaddressVal)) {
				jQuery("#email_error").html('');
				jQuery("#email").after('<label class="error" id="email_error">Enter a valid email address.</label>').addClass("error-input");
				return false
			 
			}
			else
			{
				jQuery("#email_error").html('');
				jQuery("#email").removeClass("error-input");
			}
			
			// message validation
			
			var nameVal = jQuery("#message").val();
			if(nameVal == '') {
				
				jQuery("#message_error").html('');
				jQuery("#message").after('<label class="error" id="message_error">Please enter your message.</label>').addClass("error-input");
				return false
			}
			else
			{
				jQuery("#message_error").html('');
				jQuery("#message").removeClass("error-input");
			}
			
			/////////////////////////////////////////
			
		
			jQuery.post("<?php echo get_template_directory_uri(); ?>/mail/contact.php?"+jQuery("#form").serialize(), {
		
			}, function(response){
			
			if(response==1)
			{   
			    
				jQuery("#after_submit").html('');
				jQuery('.sending').show();
				setTimeout(function() {

	            jQuery('.sending').hide();
                jQuery('#form').hide();
                jQuery(".mess").show().html('<h3>Thanks !</h3><h3>Your message has been sent.</h3>');
				
                jQuery('.mess').delay(3500).fadeOut(function() {
                   jQuery('#form').delay(4000).show();
				   change_captcha();
				   clear_form();
				  });

				},2500);
				
			}
			else
			{
				jQuery("#after_submit").html('');
				jQuery("#err_captcha").html('<span class="error" id="after_submit">Error ! invalid captcha code .</span>');
			}
			
			
		});
				
		return false;
	 });
	 
	 // refresh captcha
	 jQuery('img#refresh').click(function() {  
			
			change_captcha();
	 });
	 
	 function change_captcha()
	 {
	 	document.getElementById('captcha').src="<?php echo get_template_directory_uri(); ?>/mail/get_captcha.php?rnd=" + Math.random();
	 }
	 
	 function clear_form()
	 {
	 	jQuery("#fname").val('');
		jQuery("#lname").val('');
		jQuery("#email").val('');
		jQuery("#message").val('');
		jQuery("#phone").val('');
		jQuery("#code").val('');
	 }
});
 
 
 	
</script>
<!-- Google map
================================================== -->
<?php if ( csc_option('csc_ga_map') ) {?>
<div id="google_map" class="span12">
</div>
<?php } ?>
<div class="divider-strip"></div>
 
<div class="span6">

<div class="divider-strip">
<h3><?php _e('Send us mail', 'csc-themewp') ?></h3>
</div>

<!-- Contact form
================================================== -->

<div class="row">
      <form action="#" name="form" id="form">
      
      <input type="hidden" name="to" id="to" value="<?php echo csc_option('csc_mail_form'); ?>" />
       <div class="span4">
        <label><strong ><?php _e('First Name', 'csc-themewp'); ?></strong></label>
        <input type="text" class="span4 req-string" placeholder="Type something…" name="fname" id="fname">
        
        <label><strong ><?php _e('Last name', 'csc-themewp'); ?></strong></label>
        <input type="text" class="span4 req-string" placeholder="Type something…" name="lname" id="lname">
        </div>
        <div class="span4">
        <label><strong ><?php _e('Your email', 'csc-themewp'); ?></strong></label>
        <input type="text" class="span4 req-email" placeholder="Type something…" name="email" id="email">
        
        <label><strong ><?php _e('Your phone', 'csc-themewp'); ?></strong></label>
        <input type="text" class="span4" placeholder="Type something…" name="phone" id="phone">
        </div>
        <div class="span6" style="position:relative;">
        <label><strong ><?php _e('Your message', 'csc-themewp'); ?></strong></label>
        <textarea class="span6 req-string" rows="5" id="message" name="message"></textarea>
        </div>
        
        <div class="span6" style="margin-top:20px;">
        
        <div class="row" style="margin-bottom:20px;">
        
        <div class="span2">
		<img src="<?php echo get_template_directory_uri(); ?>/mail/get_captcha.php" alt="" id="captcha" />
        </div>
		<input class="span3" name="code" type="text" id="code">
        <a href="#" style="width:20px; cursor:pointer; margin-left:10px;"><img src="<?php echo get_template_directory_uri(); ?>/mail/refresh.png" alt="" id="refresh" style="margin-bottom:5px;"/></a>
        <div class="span6" id="err_captcha" style="text-align:center"></div>
        <div class="sending" style="text-align:center"><?php _e('send message...', 'csc-themewp'); ?></div>
	    </div>

        <button type="submit" class="button small" id="submit"><?php _e('Submit message', 'csc-themewp'); ?></button>
       
       </div>
       </form>
      <div class="mess center"></div>
 </div>  
</div>

<div class="span6">
<div class="divider-strip" style="margin-bottom:10px;">

<!--Contact info
================================================== -->

<h3><?php _e('Contact information', 'csc-themewp'); ?></h3>
</div>
<div class="row">
<div class="span6">
<ul style="margin-left:0;font-size:13px; display:block;">
<li style="margin-bottom:5px;"><?php echo csc_option('csc_location'); ?></li>
<li style="margin-bottom:5px"><?php echo csc_option('csc_phone'); ?></li>
<li style="margin-bottom:5px"><?php echo csc_option('csc_mail'); ?></li>
<li style="margin-bottom:5px"><?php echo csc_option('csc_web_site'); ?></li>
</ul>
</div>
</div>
<div class="row" id="social-contact">
<div class="span6" style="margin-top:23px;">
<?php include CSC_BASE.'socialize.php'; ?>
</div>
</div>
</div>



</section>