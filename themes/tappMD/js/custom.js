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

/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});

/*
 *
 * TERMS OF USE - EASING EQUATIONS
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2001 Robert Penner
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 */

//Mobile jPanel Nav Menu

jQuery(document).ready(function($){
	
	var jPM = $.jPanelMenu();
	
	jPM.on();
});




/*
 * Superfish v1.4.8 - jQuery menu widget
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 * CHANGELOG: http://users.tpg.com.au/j_birch/plugins/superfish/changelog.txt
 */

;(function($){
	$.fn.superfish = function(op){

		var sf = $.fn.superfish,
			c = sf.c,
			$arrow = $(['<span class="',c.arrowClass,'"> &#187;</span>'].join('')),
			over = function(){
				var $$ = $(this), menu = getMenu($$);
				clearTimeout(menu.sfTimer);
				$$.showSuperfishUl().siblings().hideSuperfishUl();
			},
			out = function(){
				var $$ = $(this), menu = getMenu($$), o = sf.op;
				clearTimeout(menu.sfTimer);
				menu.sfTimer=setTimeout(function(){
					o.retainPath=($.inArray($$[0],o.$path)>-1);
					$$.hideSuperfishUl();
					if (o.$path.length && $$.parents(['li.',o.hoverClass].join('')).length<1){over.call(o.$path);}
				},o.delay);	
			},
			getMenu = function($menu){
				var menu = $menu.parents(['ul.',c.menuClass,':first'].join(''))[0];
				sf.op = sf.o[menu.serial];
				return menu;
			},
			addArrow = function($a){ $a.addClass(c.anchorClass).append($arrow.clone()); };
			
		return this.each(function() {
			var s = this.serial = sf.o.length;
			var o = $.extend({},sf.defaults,op);
			o.$path = $('li.'+o.pathClass,this).slice(0,o.pathLevels).each(function(){
				$(this).addClass([o.hoverClass,c.bcClass].join(' '))
					.filter('li:has(ul)').removeClass(o.pathClass);
			});
			sf.o[s] = sf.op = o;
			
			$('li:has(ul)',this)[($.fn.hoverIntent && !o.disableHI) ? 'hoverIntent' : 'hover'](over,out).each(function() {
				if (o.autoArrows) addArrow( $('>a:first-child',this) );
			})
			.not('.'+c.bcClass)
				.hideSuperfishUl();
			
			var $a = $('a',this);
			$a.each(function(i){
				var $li = $a.eq(i).parents('li');
				$a.eq(i).focus(function(){over.call($li);}).blur(function(){out.call($li);});
			});
			o.onInit.call(this);
			
		}).each(function() {
			var menuClasses = [c.menuClass];
			if (sf.op.dropShadows  && !($.browser.msie && $.browser.version < 7)) menuClasses.push(c.shadowClass);
			$(this).addClass(menuClasses.join(' '));
		});
	};

	var sf = $.fn.superfish;
	sf.o = [];
	sf.op = {};
	sf.IE7fix = function(){
		var o = sf.op;
		if ($.browser.msie && $.browser.version > 6 && o.dropShadows && o.animation.opacity!=undefined)
			this.toggleClass(sf.c.shadowClass+'-off');
		};
	sf.c = {
		bcClass     : 'sf-breadcrumb',
		menuClass   : 'sf-js-enabled',
		anchorClass : 'sf-with-ul',
		arrowClass  : 'sf-sub-indicator',
		shadowClass : 'sf-shadow'
	};
	sf.defaults = {
		hoverClass	: 'sfHover',
		pathClass	: 'overideThisToUse',
		pathLevels	: 1,
		delay		: 800,
		animation	: {opacity:'show'},
		speed		: 'normal',
		autoArrows	: true,
		dropShadows : true,
		disableHI	: false,		// true disables hoverIntent detection
		onInit		: function(){}, // callback functions
		onBeforeShow: function(){},
		onShow		: function(){},
		onHide		: function(){}
	};
	$.fn.extend({
		hideSuperfishUl : function(){
			var o = sf.op,
				not = (o.retainPath===true) ? o.$path : '';
			o.retainPath = false;
			var $ul = $(['li.',o.hoverClass].join(''),this).add(this).not(not).removeClass(o.hoverClass)
					.find('>ul').hide().css('visibility','hidden');
			o.onHide.call($ul);
			return this;
		},
		showSuperfishUl : function(){
			var o = sf.op,
				sh = sf.c.shadowClass+'-off',
				$ul = this.addClass(o.hoverClass)
					.find('>ul:hidden').css('visibility','visible');
			sf.IE7fix.call($ul);
			o.onBeforeShow.call($ul);
			$ul.animate(o.animation,o.speed,function(){ sf.IE7fix.call($ul); o.onShow.call($ul); });
			return this;
		}
	});

})(jQuery);

///////////////////////////////////////////////////////////////////////////////////////////////////////

/*
 * Adipoli jQuery Image Hover Plugin
 * http://jobyj.in/adipoli
 *
 * Copyright 2012, Joby Joseph
 * Free to use under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 */
(function(a){a.fn.adipoli=function(b){function g(a){var b=document.createElement("canvas");var c=b.getContext("2d");var d=new Image;d.src=a;b.width=d.width;b.height=d.height;c.drawImage(d,0,0);var e=c.getImageData(0,0,b.width,b.height);for(var f=0;f<e.height;f++){for(var g=0;g<e.width;g++){var h=f*4*e.width+g*4;var i=(e.data[h]+e.data[h+1]+e.data[h+2])/3;e.data[h]=i;e.data[h+1]=i;e.data[h+2]=i}}c.putImageData(e,0,0,0,0,e.width,e.height);return b.toDataURL()}function f(a){for(var b,c,d=a.length;d;b=parseInt(Math.random()*d),c=a[--d],a[d]=a[b],a[b]=c);return a}function e(b,c){var d=Math.round(b.width()/c.boxCols);var e=Math.round(b.height()/c.boxRows);for(var f=0;f<c.boxRows;f++){for(var g=0;g<c.boxCols;g++){if(g==c.boxCols-1){b.children(".adipoli-after").append(a('<div class="adipoli-box"></div>').css({opacity:0,left:d*g+"px",top:e*f+"px",width:b.width()-d*g+"px",height:e+"px",background:'url("'+b.children("img").attr("src")+'") no-repeat -'+(d+g*d-d)+"px -"+(e+f*e-e)+"px"}))}else{b.children(".adipoli-after").append(a('<div class="adipoli-box"></div>').css({opacity:0,left:d*g+"px",top:e*f+"px",width:d+"px",height:e+"px",background:'url("'+b.children("img").attr("src")+'") no-repeat -'+(d+g*d-d)+"px -"+(e+f*e-e)+"px"}))}}}}function d(b,c){for(var d=0;d<c.slices;d++){var e=Math.round(b.width()/c.slices);if(d==c.slices-1){b.children(".adipoli-after").append(a('<div class="adipoli-slice"></div>').css({left:e*d+"px",width:b.width()-e*d+"px",height:"0px",opacity:"0",background:'url("'+b.children("img").attr("src")+'") no-repeat -'+(e+d*e-e)+"px 0%"}))}else{b.children(".adipoli-after").append(a('<div class="adipoli-slice"></div>').css({left:e*d+"px",width:e+"px",height:"0px",opacity:"0",background:'url("'+b.children("img").attr("src")+'") no-repeat -'+(e+d*e-e)+"px 0%"}))}}}var c=a.extend({startEffect:"transparent",hoverEffect:"normal",imageOpacity:.5,animSpeed:300,fillColor:"#000",textColor:"#fff",overlayText:"",slices:10,boxCols:5,boxRows:3,popOutMargin:10,popOutShadow:10},b);a(this).one("load",function(){a(this).wrap(function(){return'<div class="adipoli-wrapper '+a(this).attr("class")+'" style="width:'+a(this).width()+"px; height:"+a(this).height()+'px;"/>'});a(this).parent().append('<div class="adipoli-before '+a(this).attr("class")+'" style="display:none;width:'+a(this).width()+"px; height:"+a(this).height()+'px;"><img src="'+a(this).attr("src")+'"/></div>');a(this).parent().append('<div class="adipoli-after '+a(this).attr("class")+'" style="display:none;width:'+a(this).width()+"px; height:"+a(this).height()+'px;"></div>');if(c.startEffect=="transparent"){a(this).hide();a(this).siblings(".adipoli-before").css({"-ms-filter":'"progid:DXImageTransform.Microsoft.Alpha(Opacity='+c.imageOpacity*100+')"',filter:"alpha(opacity="+c.imageOpacity*100+")","-moz-opacity":c.imageOpacity,"-khtml-opacity":c.imageOpacity,opacity:c.imageOpacity}).show()}else if(c.startEffect=="grayscale"){var b=a(this);b.hide();b.siblings(".adipoli-before").show();b.siblings(".adipoli-before").children("img").each(function(){this.src=g(this.src)})}else if(c.startEffect=="normal"){a(this).hide();a(this).siblings(".adipoli-before").show()}else if(c.startEffect=="overlay"){b=a(this);b.hide();a(this).siblings(".adipoli-before").html(c.overlayText).css({"-ms-filter":'"progid:DXImageTransform.Microsoft.Alpha(Opacity='+c.imageOpacity*100+')"',filter:"alpha(opacity="+c.imageOpacity*100+")","-moz-opacity":c.imageOpacity,"-khtml-opacity":c.imageOpacity,opacity:c.imageOpacity,background:c.fillColor,color:c.textColor}).fadeIn();b.show()}a(this).parent().bind("mouseenter",function(){if(c.hoverEffect=="normal"){var b=a(this);b.children(".adipoli-after").html('<img src="'+b.children("img").attr("src")+'"/>').fadeIn(c.animSpeed)}else if(c.hoverEffect=="popout"){b=a(this);var g=b.children("img").width();var h=b.children("img").height();b.children(".adipoli-after").html('<img src="'+b.children("img").attr("src")+'"/>');var i=b.children(".adipoli-after").children("img");i.width(g+2*c.popOutMargin);i.height(h+2*c.popOutMargin);b.children(".adipoli-after").width(g+2*c.popOutMargin);b.children(".adipoli-after").height(h+2*c.popOutMargin);b.children(".adipoli-after").css({left:"-"+c.popOutMargin+"px",top:"-"+c.popOutMargin+"px","box-shadow":"0px 0px "+c.popOutShadow+"px #000"}).show()}else if(c.hoverEffect=="sliceDown"||c.hoverEffect=="sliceDownLeft"||c.hoverEffect=="sliceUp"||c.hoverEffect=="sliceUpLeft"||c.hoverEffect=="sliceUpRandom"||c.hoverEffect=="sliceDownRandom"){a(this).children(".adipoli-after").show();d(a(this),c);var j=0;var k=0;var l=a(".adipoli-slice",a(this));if(c.hoverEffect=="sliceDownLeft"||c.hoverEffect=="sliceUpLeft")l=a(".adipoli-slice",a(this))._reverse();if(c.hoverEffect=="sliceUpRandom"||c.hoverEffect=="sliceDownRandom")l=f(a(".adipoli-slice",a(this)));l.each(function(){var b=a(this);if(c.hoverEffect=="sliceDown"||c.hoverEffect=="sliceDownLeft"){b.css({top:"0px"})}else if(c.hoverEffect=="sliceUp"||c.hoverEffect=="sliceUpLeft"){b.css({bottom:"0px"})}if(k==c.slices-1){setTimeout(function(){b.animate({height:"100%",opacity:"1.0"},c.animSpeed,"",function(){})},100+j)}else{setTimeout(function(){b.animate({height:"100%",opacity:"1.0"},c.animSpeed)},100+j)}j+=50;k++})}else if(c.hoverEffect=="sliceUpDown"||c.hoverEffect=="sliceUpDownLeft"){a(this).children(".adipoli-after").show();d(a(this),c);j=0;k=0;var m=0;l=a(".adipoli-slice",a(this));if(c.hoverEffect=="sliceUpDownLeft")l=a(".adipoli-slice",a(this))._reverse();l.each(function(){var b=a(this);if(k==0){b.css("top","0px");k++}else{b.css("bottom","0px");k=0}if(m==c.slices-1){setTimeout(function(){b.animate({height:"100%",opacity:"1.0"},c.animSpeed,"",function(){})},100+j)}else{setTimeout(function(){b.animate({height:"100%",opacity:"1.0"},c.animSpeed)},100+j)}j+=50;m++})}else if(c.hoverEffect=="fold"||c.hoverEffect=="foldLeft"){a(this).children(".adipoli-after").show();b=a(this);d(b,c);j=0;k=0;l=a(".adipoli-slice",b);if(c.hoverEffect=="foldLeft")l=a(".adipoli-slice",a(this))._reverse();l.each(function(){var b=a(this);var d=b.width();b.css({top:"0px",height:"100%",width:"0px"});if(k==c.slices-1){setTimeout(function(){b.animate({width:d,opacity:"1.0"},c.animSpeed,"",function(){})},100+j)}else{setTimeout(function(){b.animate({width:d,opacity:"1.0"},c.animSpeed)},100+j)}j+=50;k++})}else if(c.hoverEffect=="boxRandom"){a(this).children(".adipoli-after").show();b=a(this);e(b,c);var n=c.boxCols*c.boxRows;k=0;j=0;var o=f(a(".adipoli-box",b));o.each(function(){var b=a(this);if(k==n-1){setTimeout(function(){b.animate({opacity:"1"},c.animSpeed,"",function(){})},100+j)}else{setTimeout(function(){b.animate({opacity:"1"},c.animSpeed)},100+j)}j+=20;k++})}else if(c.hoverEffect=="boxRain"||c.hoverEffect=="boxRainReverse"||c.hoverEffect=="boxRainGrow"||c.hoverEffect=="boxRainGrowReverse"){a(this).children(".adipoli-after").show();b=a(this);e(b,c);n=c.boxCols*c.boxRows;k=0;j=0;var p=0;var q=0;var r=new Array;r[p]=new Array;o=a(".adipoli-box",b);if(c.hoverEffect=="boxRainReverse"||c.hoverEffect=="boxRainGrowReverse"){o=a(".adipoli-box",b)._reverse()}o.each(function(){r[p][q]=a(this);q++;if(q==c.boxCols){p++;q=0;r[p]=new Array}});for(var s=0;s<c.boxCols*2;s++){var t=s;for(var u=0;u<c.boxRows;u++){if(t>=0&&t<c.boxCols){(function(b,d,e,f,g){var h=a(r[b][d]);var i=h.width();var j=h.height();if(c.hoverEffect=="boxRainGrow"||c.hoverEffect=="boxRainGrowReverse"){h.width(0).height(0)}if(f==g-1){setTimeout(function(){h.animate({opacity:"1",width:i,height:j},c.animSpeed/1.3,"",function(){})},100+e)}else{setTimeout(function(){h.animate({opacity:"1",width:i,height:j},c.animSpeed/1.3)},100+e)}})(u,t,j,k,n);k++}t--}j+=100}}});a(this).parent().bind("mouseleave",function(){a(this).children(".adipoli-after").html("").hide()})}).each(function(){if(this.complete)a(this).load()});return a(this)};a.fn._reverse=[].reverse})(jQuery)

