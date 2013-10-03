

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