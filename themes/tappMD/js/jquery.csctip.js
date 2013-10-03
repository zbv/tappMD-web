jQuery(function() {

	
	var hash = window.location.hash.substr(1);
	hash = hash.replace(/%20/gi,' ');
	var y=0;
	jQuery('a.itemload').each(function(){
		var i=0;
		var $this = jQuery(this);							 
		var dataAjax = $this.attr('data-ajax');
		var itemHref = $this.attr('href');
		
		if(hash==dataAjax){
		
			if (y < 1) {
				jQuery(this).addClass('active');
				jQuery('html, body').animate({scrollTop: jQuery(".top_portfolio").parent().offset().top}, 1000, function() {
					if (i < 1) { 
						jQuery(this).addClass('active');
						loadAjaxitem(itemHref);
						jQuery("a[rel^='prettyPhoto']").prettyPhoto();
					}
					i++;
				});
			}
			y++;
		}											
	});
		
	
	jQuery("body").on("click", '.itemload', function() {
		var i=0;
		
		jQuery('a.itemload').removeClass('active');
		jQuery(this).addClass('active');					   					   
			
		var $this = jQuery(this);	
		var dataAjax = $this.attr('data-ajax');
		var itemHref = $this.attr('href');
		
		if(window.location.hash.substr(1) == dataAjax) { 
			jQuery('html, body').animate({scrollTop: jQuery(".top_portfolio").parent().offset().top}, 1000);
		} else {
			window.location.hash = dataAjax;	
			jQuery('html, body').animate({scrollTop: jQuery(".top_portfolio").parent().offset().top}, 1000, function() {
				
				if (i < 1) {
					jQuery('#pagecontent').slideUp(1000, 'easeInOutExpo', function() {
						loadAjaxitem(itemHref);
						jQuery("a[rel^='prettyPhoto']").prettyPhoto();
					});
				}
				i++;
			});
		}
		return(false);
	});
	

		
	function loadAjaxitem(itemHref) {
		
		jQuery('.loader').fadeIn(100);
		
		var loadAjaxData = itemHref;
		var deletestring = 'http://'+window.location.host+window.location.pathname;
		var analyticspath = itemHref.replace(deletestring, '');
		if (_gaq) {
			_gaq.push(['_trackPageview', analyticspath]);
		}
		
		jQuery('#pageloader').delay(1000).queue(function() {
			jQuery(this).load(loadAjaxData, function() {
				jQuery('#pagecontent').slideDown(1000, 'easeInOutExpo', function() {
					jQuery('.loader').fadeOut(1000);
					jQuery("a[rel^='prettyPhoto']").prettyPhoto();
				});	
			});
			jQuery(this).dequeue();
		});
		
				

	}
	
	

});
