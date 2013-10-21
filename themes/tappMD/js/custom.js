// JavaScript Document 
(function($){
    jQuery.fn.extend({
        csc_photostream: function(options) {
 
            var defaults = {
                user: '',
                limit: 15,
				social_network: ''
				
            };
            
			
			function create_html(data, container) {
				var feeds = data.feed;
				if (!feeds) {
					return false;
				}
				var html = '';		
				html += '<ul>';
					
				for (var i = 0; i < feeds.entries.length; i++) {
					var entry = feeds.entries[i];
					var content = entry.content;
					html += '<li>'+ content +'</li>'		
				}
					
				html += '</ul>';
					
				jQuery(container).html(html);
			
				jQuery(container).find("li").each(function(){
					pin_img_src = jQuery(this).find("img").attr("src");
					pin_url = "http://www.pinterest.com" + jQuery(this).find("a").attr("href");
					pin_desc = jQuery(this).find("p:nth-child(2)").html();
					pin_desc = pin_desc.replace("'", "`");
					jQuery(this).empty();
					jQuery(this).append("<a target='_blank' href='" + pin_url + "' title='" + pin_desc + "'><img src='" + pin_img_src + "' alt=''></a>");
					var img_w = jQuery(this).find("img").width();
					var img_h = jQuery(this).find("img").height();
					if (img_w < img_h){
						jQuery(this).find("img").addClass("portrait")
					}
					else {
						jQuery(this).find("img").addClass("landscape")
					}
				});
			};

            var options = jQuery.extend(defaults, options);
         
            return this.each(function() {
                  var o = options;
                  var obj = jQuery(this); 
				  
				  if (o.social_network == "dribbble") {
					  obj.append("<ul></ul>")
					  jQuery.getJSON("http://api.dribbble.com/players/" + o.user + "/shots.json?callback=?", function(data){
							jQuery.each(data.shots, function(i,shot){
								if (i < o.limit) {
								  var img_title = shot.title;
								  img_title = img_title.replace("'", "`")
								  var image = jQuery('<img/>').attr({src: shot.image_teaser_url, alt: img_title});
								  var url = jQuery('<a/>').attr({href: shot.url, target: '_blank', title: img_title});
								  var url2 = jQuery(url).append(image);
								  var li = jQuery('<li/>').append(url2);
								  jQuery("ul", obj).append(li);
								}
							});
							jQuery("li img", obj).each(function(){
								var img_w = jQuery(this).width();
								var img_h = jQuery(this).height();
								if (img_w < img_h){
									jQuery(this).addClass("portrait")
								}
								else {
									jQuery(this).addClass("landscape")
								}
							});	
					   });		  
				  }
				  if (o.social_network == "pinterest") {  
					var url = 'http://pinterest.com/' + o.user + '/feed.rss'
					var api = "http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&callback=?&q=" + encodeURIComponent(url);
					api += "&num=" + o.limit;
					api += "&output=json_xml";

				
					// Send request
					jQuery.getJSON(api, function(data){	
						// Check for error
						if (data.responseStatus == 200) {
							// Process the feeds
							create_html(data.responseData, obj);
				
							// Optional user callback function
							if (jQuery.isFunction(fn)) fn.call(this,$e);
							
						} else {
							alert("wrong user for pinterest");
				
						};
					});	
				  }
				  if (o.social_network == "flickr") { 
						obj.append("<ul></ul>")
						jQuery.getJSON("http://api.flickr.com/services/rest/?method=flickr.people.findByUsername&username=" + o.user+ "&format=json&api_key=85145f20ba1864d8ff559a3971a0a033&jsoncallback=?", function(data){
							var nsid = data.user.nsid;
							jQuery.getJSON("http://api.flickr.com/services/rest/?method=flickr.photos.search&user_id=" + nsid + "&format=json&api_key=85145f20ba1864d8ff559a3971a0a033&per_page=" + o.limit + "&page=1&extras=url_sq&jsoncallback=?", function(data){
								jQuery.each(data.photos.photo, function(i,img){
									var img_owner = img.owner;
									var img_title = img.title;
									var img_src = img.url_sq;
									var img_id = img.id;
									var img_url = "http://www.flickr.com/photos/" + img_owner + "/" + img_id;
									var image = jQuery('<img/>').attr({src: img_src, alt: img_title});
									var url = jQuery('<a/>').attr({href: img_url, target: '_blank', title: img_title});
									var url2 = jQuery(url).append(image);
									var li = jQuery('<li/>').append(url2);
									jQuery("ul", obj).append(li);
								})
						   });
					   });	

				  }
				  
				  if (o.social_network == "instagram") { 
						obj.append("<ul></ul>")
						var token = "188312888.f79f8a6.1b920e7f642b4693a4cb346162bf7154";						
						url =  "https://api.instagram.com/v1/users/search?q=" + o.user + "&access_token=" + token + "&count=1&callback=?";
						jQuery.getJSON(url, function(data){
						
							jQuery.each(data.data, function(i,shot){
								  var instagram_username = shot.username;
								  if (instagram_username == o.user){
									  var user_id = shot.id;
									  
									if (user_id != ""){	
										url =  "https://api.instagram.com/v1/users/" + user_id + "/media/recent/?access_token=" + token + "&count=" + o.limit + "&callback=?";
										jQuery.getJSON(url, function(data){
											jQuery.each(data.data, function(i,shot){
											  var img_src = shot.images.thumbnail.url;
											  var img_url = shot.link;

											  var img_title = "";
											  if (shot.caption != null){
											  img_title = shot.caption.text;
											  }
											  
											  var image = jQuery('<img/>').attr({src: img_src, alt: img_title});
											  var url = jQuery('<a/>').attr({href: img_url, target: '_blank', title: img_title});
											  var url2 = jQuery(url).append(image);
											  var li = jQuery('<li/>').append(url2);
											  jQuery("ul", obj).append(li);
						
											});
										});
									}   
								  }
							});
						});						
				  }  
				  
            });
        }
    });
})(jQuery);

jQuery(document).ready(function($) { 
        jQuery('#menu-top ul.menu,.menu-t').superfish({ 
            delay: 100,  
            animation:{height: 'show', opacity: 'show'},  
            speed:'normal',                         
            autoArrows:  false, 
            dropShadows: false,
			disableHI:true                         
        });
		
	});


jQuery(function(){
  
jQuery(".widget_nav_menu li > a,li.cat-item > a,.widget_archive li > a,.widget_meta li > a,.widget_pages li > a,.widget_meta li > a").each(function(index, element) {
	   jQuery(this).append('<i class="icon-chevron-right"></i>');

  });
  

jQuery("#map-cat li.cat-item a").each(function(index, element) {
	   jQuery(this).append('<i class="icon-folder-close-alt"></i>');

  });

 jQuery("#map-aut li a").each(function(index, element) {
	   jQuery(this).append('<i class="icon-pencil"></i>');

  });
  
  jQuery("ul.menu > li").each(function() {
    if (jQuery(this).has('ul').length) {
      jQuery(this).append('<i class="icon-angle-down"></i>');
    }
  }); 
  
 jQuery(".menu-t > li").each(function() {
    if (jQuery(this).has('ul').length) {
      jQuery(this).append('<i class="icon-angle-down"></i>');
    }
  }); 
  
  jQuery(".menu-t > li > ul > li").each(function() {
    if (jQuery(this).has('ul').length) {
      jQuery(this).append('<span class="indicator-right"></span>');
    }
  });

  
});

jQuery(function(){
	
	    var menu = jQuery('.menutopdefault'),
		pos = menu.offset();
		var logo = jQuery("header .logo img");
		var logoSmallHeight = 50;
		
		jQuery(window).scroll(function(){
			if(jQuery(this).scrollTop() > pos.top+menu.height() && menu.hasClass('default')){
				menu.fadeOut('fast', function(){
					jQuery(this).removeClass('default').addClass('fixed').fadeIn(1000);
					
				});
			} else if(jQuery(this).scrollTop() <= pos.top && menu.hasClass('fixed')){
				menu.fadeOut('fast', function(){
					jQuery(this).removeClass('fixed').addClass('default').fadeIn(1000);
				});
			}
		});

});

jQuery(document).ready(function($) {
$.noConflict();
jQuery.noConflict();


  // Menu Setting
  
  jQuery("ul.w-recentpost > li").each(function() {
    if (jQuery(this).has('iframe').length) {
      jQuery(this).find('div').hide();
    }
  });
  
  jQuery("ul.menu > li > ul > li > a").each(function(index, element) {
	   
	var desclink = jQuery(this).attr('title');
	jQuery(this).append('<em></em>');
	jQuery(this).find('em').text(desclink);
	

  });
  
  jQuery("ul.menu > li > ul > li > ul > li > a").each(function(index, element) {
	   
	var desclink = jQuery(this).attr('title');
	jQuery(this).append('<em></em>');
	jQuery(this).find('em').text(desclink);
	

  });
  

	
    var menuData = jQuery('nav#menu-top ul li');
    jQuery("li:has(ins)").addClass("data-color");
	var theColorIs = jQuery('ul#mainmenu').css("background-color");

    jQuery(menuData).hover(function () {

        if (jQuery(this).hasClass('data-color')) {

            var menuColor = jQuery(this).children('ins').text();
            var addData = jQuery(this).children('a');

            if (menuColor !== '') {
                jQuery(addData).css('background-color', '#' + menuColor);
                jQuery(addData).css('color', '#FFF');
                jQuery(this).find('ul.sub-menu li a').css('background-color', '#' + menuColor);
            }
        }

    }, function () {
        
        jQuery('nav#menu-top ul li a').css('background-color','#' + theColorIs);
		
        if (jQuery(this).hasClass('data-color')) {
			

			var menuColor = jQuery(this).children('ins').text();
            var addData = jQuery(this).children('a');

            if (!jQuery(this).parent('ul').hasClass('sub-menu')) {
                if (jQuery(this).hasClass('current-menu-item')) {
                    jQuery(addData).css('background-color', '#' + menuColor);
                } else if (jQuery(this).hasClass('current-category-ancestor')) {
                    jQuery(addData).css('background-color', '#' + menuColor);
                } else if (jQuery(this).hasClass('current-menu-parent')) {
                    jQuery(addData).css('background-color', '#' + menuColor);
                } else if (jQuery(this).hasClass('current-post-ancestor')) {
                    jQuery(addData).css('background-color', '#' + menuColor);
                } else {
                    jQuery(addData).css('background-color', theColorIs);
                    jQuery(addData).css('color', '#fff');
                }
            }
        }
    });
 
  //Reviews more
  
   jQuery('.over-more').click(function() {
   jQuery('#over-slide').slideToggle( 300 , function() {
   jQuery('#over-slide').find('.contbar').animate({width:'100%'},
    {
      easing: 'swing',
      duration: 700
    });
   });
   });

  // Topbar open / close & hover

  jQuery('.pagenavi').find('a,.current').addClass('button small');
  jQuery('.pagenavi').find('.current').addClass('button small blue');

  // Testimonials cycle 								

    jQuery('#testimonials').cycle({
        fx: 'scrollLeft',
        speed: 500,
        timeout: 3500,
        pause: 1,
        cleartypeNoBg: true,
		next:'.next-l', 
	    prev:'.prev-l'
    });
  

  //Carousel images

  jQuery('#Carousel1,#Carousel').carousel({
    interval: 2500
  });

  //Media element player

  jQuery('audio,video').mediaelementplayer({
    audioWidth: '100%',
    audioHeight: '30px',
    videoWidth: '100%',
    videoHeight: '100%'
  });

  jQuery('.video-port').mediaelementplayer();

   
   
  //prettyPhoto

  //jQuery("a[rel^='prettyPhoto']").prettyPhoto();


  //Toggle

  jQuery(".toggle-box").hide();
  jQuery(".open-block").toggle(function() {
    jQuery(this).addClass("active");
  },
  function() {
    jQuery(this).removeClass("active");
  });
  jQuery(".open-block").click(function() {
    jQuery(this).next(".toggle-box").slideToggle();
  });

  //Accordion

  jQuery('.accordion-box').hide();
  jQuery('.open-block-acc').click(function() {
    jQuery(".open-block-acc").removeClass("active");
    jQuery('.accordion-box').slideUp('normal');
    if (jQuery(this).next().is(':hidden') == true) {
      jQuery(this).next().slideDown('normal');
      jQuery(this).addClass("active");
    }
  });

  //Message box

  jQuery('.message-box').find('.closemsg').click(function() {
    jQuery(this).parent('.message-box').slideUp(500);
  });

 // Mobi Navigation

  jQuery("ul.menu-primary-navigation").find('li').hover(function() {
    jQuery(this).children("ul").stop(true, true).fadeIn(300);
  },
  function() {
    jQuery(this).children("ul").stop(true, true).fadeOut(200);
  });

  (function() {

    var $navResp = jQuery('nav').children('ul'),
    optionsList = '<option value="" selected>SITE MENU</option>';

    $navResp.find('li').each(function() {
      var $this = jQuery(this),
      $anchor = $this.children('a'),
      depth = $this.parents('ul').length - 1,
      indent = '';

      if (depth) {
        while (depth > 0) {
          indent += '--';
          depth--;
        }
      }

      optionsList += '<option value="' + $anchor.attr('href') + '">' + indent + ' ' + $anchor.text() + '</option>';
    }).end().after('<select class="menuselect">' + optionsList + '</select>');

    jQuery('.menuselect').on('change',
    function() {
      window.location = jQuery(this).find("option:selected").val();

    });

  })();


  jQuery('#submit').click(function() {
    jQuery('input.error-input, textarea.error-input').delay(300).animate({
      marginLeft: 0
    },
    100).animate({
      marginLeft: 10
    },
    100).animate({
      marginLeft: 0
    },
    100).animate({
      marginLeft: 10
    },
    100).animate({
      marginLeft: 0
    },
    100);
  });
  

	
	
	jQuery().UItoTop({ easingType: 'easeOutQuart' });
  

});

jQuery(document).ready(function($) {
jQuery.noConflict();
	 

jQuery(function() {  
  // Isotope
	  
	  var $container_two = jQuery('ul.portfolio');
	  $container_two.imagesLoaded( function(){
		$container_two.isotope({
			itemSelector : '.item-block',
			 transformsEnabled: false
		});	
	});
      
	  // onclick reinitialise the isotope script
	jQuery('#filters a').click(function(){
		
		jQuery('#filters a').removeClass('selected');
		jQuery(this).addClass('selected');
		
		var selector = jQuery(this).attr('data-option-value');
		$container_two.isotope({ filter: selector });
		
		return(false);
	});
	
	});
});

jQuery(function(){
                
    jQuery('.hov-anim').adipoli({
        'startEffect' : 'overlay',
        'hoverEffect' : 'sliceDown',
		'imageOpacity' : '0.3'
      });


});

/*
|--------------------------------------------------------------------------
| UItoTop jQuery Plugin 1.1
| http://www.mattvarone.com/web-design/uitotop-jquery-plugin/
|--------------------------------------------------------------------------
*/

(function($){
	$.fn.UItoTop = function(options) {

 		var defaults = {
			text: 'To Top',
			min: 200,
			inDelay:600,
			outDelay:400,
  			containerID: 'toTop',
			containerHoverID: 'toTopHover',
			scrollSpeed: 1200,
			easingType: 'linear'
 		};

 		var settings = $.extend(defaults, options);
		var containerIDhash = '#' + settings.containerID;
		var containerHoverIDHash = '#'+settings.containerHoverID;
		
		$('body').append('<a href="#" id="'+settings.containerID+'">'+settings.text+'</a>');
		$(containerIDhash).hide().click(function(){
			$('html, body').animate({scrollTop:0}, settings.scrollSpeed, settings.easingType);
			$('#'+settings.containerHoverID, this).stop().animate({'opacity': 0 }, settings.inDelay, settings.easingType);
			return false;
		})
		.prepend('<span id="'+settings.containerHoverID+'"></span>')
		.hover(function() {
				$(containerHoverIDHash, this).stop().animate({
					'opacity': 1
				}, 600, 'linear');
			}, function() { 
				$(containerHoverIDHash, this).stop().animate({
					'opacity': 0
				}, 700, 'linear');
			});
					
		$(window).scroll(function() {
			var sd = $(window).scrollTop();
			if(typeof document.body.style.maxHeight === "undefined") {
				$(containerIDhash).css({
					'position': 'absolute',
					'top': $(window).scrollTop() + $(window).height() - 50
				});
			}
			if ( sd > settings.min ) 
				$(containerIDhash).fadeIn(settings.inDelay);
			else 
				$(containerIDhash).fadeOut(settings.Outdelay);
		});

};
})(jQuery);

//jquery.csctip.js

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


//Application.js
// NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
// IT'S ALL JUST JUNK FOR OUR DOCS!
// ++++++++++++++++++++++++++++++++++++++++++

!function ($) {

  $(function(){

    var $window = $(window)

    // Disable certain links in docs
    $('section [href^=#]').click(function (e) {
      e.preventDefault()
    })

    // side bar
    setTimeout(function () {
      $('.bs-docs-sidenav').affix({
        offset: {
          top: function () { return $window.width() <= 980 ? 290 : 210 }
        , bottom: 270
        }
      })
    }, 100)

    // make code pretty
    window.prettyPrint && prettyPrint()

    // add-ons
    $('.add-on :checkbox').on('click', function () {
      var $this = $(this)
        , method = $this.attr('checked') ? 'addClass' : 'removeClass'
      $(this).parents('.add-on')[method]('active')
    })

    // add tipsies to grid for scaffolding
    if ($('#gridSystem').length) {
      $('#gridSystem').tooltip({
          selector: '.show-grid > [class*="span"]'
        , title: function () { return $(this).width() + 'px' }
      })
    }

    // tooltip demo
    $('.tooltip-demo').tooltip({
      selector: "a[data-toggle=tooltip]"
    })

    $('.tooltip-test').tooltip()
    $('.popover-test').popover()

    // popover demo
    $("a[data-toggle=popover]")
      .popover()
      .click(function(e) {
        e.preventDefault()
      })

    // button state demo
    $('#fat-btn')
      .click(function () {
        var btn = $(this)
        btn.button('loading')
        setTimeout(function () {
          btn.button('reset')
        }, 3000)
      })

    // carousel demo
    $('#myCarousel').carousel()

    // javascript build logic
    var inputsComponent = $("#components.download input")
      , inputsPlugin = $("#plugins.download input")
      , inputsVariables = $("#variables.download input")

    // toggle all plugin checkboxes
    $('#components.download .toggle-all').on('click', function (e) {
      e.preventDefault()
      inputsComponent.attr('checked', !inputsComponent.is(':checked'))
    })

    $('#plugins.download .toggle-all').on('click', function (e) {
      e.preventDefault()
      inputsPlugin.attr('checked', !inputsPlugin.is(':checked'))
    })

    $('#variables.download .toggle-all').on('click', function (e) {
      e.preventDefault()
      inputsVariables.val('')
    })

    // request built javascript
    $('.download-btn .btn').on('click', function () {

      var css = $("#components.download input:checked")
            .map(function () { return this.value })
            .toArray()
        , js = $("#plugins.download input:checked")
            .map(function () { return this.value })
            .toArray()
        , vars = {}
        , img = ['glyphicons-halflings.png', 'glyphicons-halflings-white.png']

    $("#variables.download input")
      .each(function () {
        $(this).val() && (vars[ $(this).prev().text() ] = $(this).val())
      })

      $.ajax({
        type: 'POST'
      , url: /\?dev/.test(window.location) ? 'http://localhost:3000' : 'http://bootstrap.herokuapp.com'
      , dataType: 'jsonpi'
      , params: {
          js: js
        , css: css
        , vars: vars
        , img: img
      }
      })
    })
  })

// Modified from the original jsonpi https://github.com/benvinegar/jquery-jsonpi
$.ajaxTransport('jsonpi', function(opts, originalOptions, jqXHR) {
  var url = opts.url;

  return {
    send: function(_, completeCallback) {
      var name = 'jQuery_iframe_' + jQuery.now()
        , iframe, form

      iframe = $('<iframe>')
        .attr('name', name)
        .appendTo('head')

      form = $('<form>')
        .attr('method', opts.type) // GET or POST
        .attr('action', url)
        .attr('target', name)

      $.each(opts.params, function(k, v) {

        $('<input>')
          .attr('type', 'hidden')
          .attr('name', k)
          .attr('value', typeof v == 'string' ? v : JSON.stringify(v))
          .appendTo(form)
      })

      form.appendTo('body').submit()
    }
  }
})

}(window.jQuery)


//Mobile jPanel Nav Menu

jQuery(document).ready(function($){
	
	var jPM = $.jPanelMenu();
	
	jPM.on();
});


