/*global jQuery */
/*!	
* Easy Media Gallery
*
* Copyright 2012, http://ghozylab.com/
* Released under the WTFPL license 
*
*/


jQuery(document).ajaxComplete(function(){
	InitializeSettings();
	});
	
jQuery(document).ready(function($) {
	InitializeSettings();
	});

function InitializeSettings(){
		
	var emgadelay;
	clearTimeout(emgadelay);
	setTimeout(emgadelay, 100);

	function emgadelay(){

/*--------------------------------------------------
	Hover Effect
---------------------------------------------------*/	
	(function( $, undefined ) {$.EmgHoverDir=function(e,t){this.$el=$(t);this._init(e)};$.EmgHoverDir.defaults={hoverDelay:0,reverse:false};$.EmgHoverDir.prototype={_init:function(e){this.options=$.extend(true,{},$.EmgHoverDir.defaults,e);this._loadEvents()},_loadEvents:function(){var e=this;this.$el.bind("mouseenter.emghoverdir, mouseleave.emghoverdir",function(t){var n=$(this),r=t.type,i=n.find("article"),s=e._getDir(n,{x:t.pageX,y:t.pageY}),o=e._getClasses(s);i.removeClass();if(r==="mouseenter"){i.hide().addClass(o.from);clearTimeout(e.tmhover);e.tmhover=setTimeout(function(){i.show(0,function(){$(this).addClass("da-animate").addClass(o.to)})},e.options.hoverDelay)}else{i.addClass("da-animate");clearTimeout(e.tmhover);i.addClass(o.from)}})},_getDir:function(e,t){var n=e.width(),r=e.height(),i=(t.x-e.offset().left-n/2)*(n>r?r/n:1),s=(t.y-e.offset().top-r/2)*(r>n?n/r:1),o=Math.round((Math.atan2(s,i)*(180/Math.PI)+180)/90+3)%4;return o},_getClasses:function(e){var t,n;switch(e){case 0:!this.options.reverse?t="da-slideFromTop":t="da-slideFromBottom";n="da-slideTop";break;case 1:!this.options.reverse?t="da-slideFromRight":t="da-slideFromLeft";n="da-slideLeft";break;case 2:!this.options.reverse?t="da-slideFromBottom":t="da-slideFromTop";n="da-slideTop";break;case 3:!this.options.reverse?t="da-slideFromLeft":t="da-slideFromRight";n="da-slideLeft";break}return{from:t,to:n}}};var logError=function(e){if(this.console){console.error(e)}};$.fn.emghoverdir=function(e){if(typeof e==="string"){var t=Array.prototype.slice.call(arguments,1);this.each(function(){var n=$.data(this,"emghoverdir");if(!n){logError("cannot call methods on emghoverdir prior to initialization; "+"attempted to call method '"+e+"'");return}if(!$.isFunction(n[e])||e.charAt(0)==="_"){logError("no such method '"+e+"' for emghoverdir instance");return}n[e].apply(n,t)})}else{this.each(function(){var t=$.data(this,"emghoverdir");if(!t){$.data(this,"emghoverdir",new $.EmgHoverDir(e,this))}})}return this}})( jQuery );


/*--------------------------------------------------
	Lightbox Auto Top/Bottom ( EMG Lightbox )
---------------------------------------------------*/
jQuery(function(){jQuery(window).scroll(function(){if(jQuery("#mbCenter").size()>0){var e=parseInt(jQuery(document).scrollTop());var t=jQuery("#mbCenter").offset();var n=parseInt(t.top+jQuery("#mbCenter").height()+90-e);var r=jQuery(window).height()-n;if(e<t.top-90){setTimeout(function(){jQuery("#mbCenter").stop().animate({top:jQuery(window).scrollTop()+340},500)},150)}if(r>1&&jQuery(window).height()<jQuery("#mbCenter").height()-90){setTimeout(function(){jQuery("#mbCenter").stop().animate({top:t.top+340},500)},150)}else if(r>1&&jQuery(window).height()>jQuery("#mbCenter").height()+90){setTimeout(function(){jQuery("#mbCenter").stop().animate({top:jQuery(window).scrollTop()+340},500)},150)}}})})


/*--------------------------------------------------
	Call Hover effect & Re-scan images ( Mootools )
---------------------------------------------------*/
jQuery(function($){
	$("div.da-thumbs").emghoverdir();
	
	if ( EasyFront.lightboxstyle=='emglb'){
		window.addEvent('domready',function(){
			Easymedia.scanPage();
			});
		}
});

//--------------------------------------------------	
		}   // End emgadelay 
//--------------------------------------------------

//--------------------------------------------------	
	}// End InitializeSettings 
//--------------------------------------------------


/*--------------------------------------------------

	ISOTOPE
---------------------------------------------------*/	
jQuery(function($){
	
		$.Emgisotope.prototype._getCenteredMasonryColumns = function() {
    		this.width = this.element.width();
    
   			var parentWidth = this.element.parent().width();
    
    		var colW = this.options.masonry && this.options.masonry.columnWidth ||

       				   this.$filteredAtoms.outerWidth(true) ||

                  		parentWidth;
    
    		var cols = Math.floor( parentWidth / colW );
    		cols = Math.max( cols, 1 );

    		this.masonry.cols = cols;

    		this.masonry.columnWidth = colW;
  		};
  
 	 
		$.Emgisotope.prototype._masonryReset = function() {
			
			this.masonry = {};
			
			this._getCenteredMasonryColumns();
    		var i = this.masonry.cols;
    		this.masonry.colYs = [];
   			while (i--) {
      			this.masonry.colYs.push( 0 );
    			}
  		};


		$.Emgisotope.prototype._masonryResizeChanged = function() {
			var prevColCount = this.masonry.cols;

    		this._getCenteredMasonryColumns();
    		return ( this.masonry.cols !== prevColCount );
  		};
  
  		$.Emgisotope.prototype._masonryGetContainerSize = function() {
    		var unusedCols = 0,
        		i = this.masonry.cols;
				
    		while ( --i ) {
      			if ( this.masonry.colYs[i] !== 0 ) {
        		break;
      		}
      		unusedCols++;
			
  		};
    
    	
		return {
          height : Math.max.apply( Math, this.masonry.colYs ),

          width : (this.masonry.cols - unusedCols) * this.masonry.columnWidth
        	};
  		};
 
	});


/*--------------------------------------------------
	StyleSwitcher script from  A List Apart
	Authored by Paul Sowden and Peter-Paul Koch
	http://www.alistapart.com/articles/alternate/
---------------------------------------------------*/
function easyActiveStyleSheet(e){var t,n,r;for(t=0;n=document.getElementsByTagName("link")[t];t++){if(n.getAttribute("rel").indexOf("style")!=-1&&n.getAttribute("title")){n.disabled=true;if(n.getAttribute("title")==e)n.disabled=false}}}function getActiveStyleSheet(){var e,t;for(e=0;t=document.getElementsByTagName("link")[e];e++){if(t.getAttribute("rel").indexOf("style")!=-1&&t.getAttribute("title")&&!t.disabled)return t.getAttribute("title")}return null}function getPreferredStyleSheet(){var e,t;for(e=0;t=document.getElementsByTagName("link")[e];e++){if(t.getAttribute("rel").indexOf("style")!=-1&&t.getAttribute("rel").indexOf("alt")==-1&&t.getAttribute("title"))return t.getAttribute("title")}return null}
easyActiveStyleSheet(EasyFront.defstyle);


/*--------------------------------------------------
	Load Thumbnails Properties
---------------------------------------------------*/
(function($) {
	
	var myFuncCalls = 0, loadEvery;
	
	$.fn.readyLoad = function(options) {
		
        settings = $.extend({
          'elementId' : '',
          'isPagination' : Number.NEGATIVE_INFINITY,
		  'isLazyload' : Number.NEGATIVE_INFINITY,
          'imageCount' : Number.POSITIVE_INFINITY,
        }, options);
		

		loadEvery = Math.min(Math.min(settings.imageCount, 5), 10);	
		return this.each(function() {
			
			var $self = $(this);
			var $ttl = $self.find("p");
			var $ttlup = $self.parent().find("p");
			var $elp = $self.parent();
			var $elpp = $self.parent().parent();
			var $elppp = $self.parent().parent().parent();
		
		if($ttl.hasClass("emgfittext") && $ttl.text().length>0){
			$ttl.fadeIn(1e3);
			}	else {
				$ttl.hide();
				}
		
		if($ttlup.hasClass("emgfittext") && $ttlup.text().length>0){
			$ttlup.fadeIn("fast");
			}	else {
				$ttlup.hide();
				}
			
			if($elpp.prev().hasClass("emg-badges")){
				$elpp.prev("span.emg-badges").fadeIn(2e3)
				}
				
				if($elp.prev().hasClass("emg-badges")){
					$elp.prev("span.emg-badges").fadeIn(2e3)
					}
					
					if($elpp.hasClass("preloaderview")){
						$elpp.removeClass("preloaderview")
						}
						
						if($elppp.hasClass("preloaderview")){
							$elppp.removeClass("preloaderview")
							}
						
					if ($.trim(settings.ispagination) != 1) {
						
						try {
								//console.log(loadEvery);
							// a little trick to increase gallery performance
							if ( myFuncCalls >= loadEvery ) {
								
								jQuery(".easycontainer-"+settings.elementId).emgisotope( 'reLayout' ); /* @since 1..5.1.7 */
								
								myFuncCalls = 0;
								
								}
								
								myFuncCalls++;
							
							} catch(e) {
								
								}
								
						}

				
			});
				
		 };
})(jQuery);


/*--------------------------------------------------
	Make LazyLoad Support Ajax
---------------------------------------------------*/
function loadImages(sel, pref, ispg, icont, islz ){
	
	if ( islz == 1 ) {
		
		jQuery(sel).lazy({
			bind: "event",
			attribute: "data-original",
			effect: "fadeIn",
			visibleOnly: false,
			enableThrottle: true,
			throttle: 250,
			effectTime: 900,
			threshold: 100,
			afterLoad: function(element) {
				//jQuery(element).readyLoad({ elementId: pref, isPagination: ispg, isLazyload: islz, imageCount: icont });
					element.after(jQuery(element).readyLoad({ elementId: pref, isPagination: ispg, isLazyload: islz, imageCount: icont }));

				}
			
			});
			
		} else {
		
			var imgLoad = emgimagesLoaded( jQuery(".pagwrap-"+pref+" .emglazy") );
			
			imgLoad.on( 'progress', function( instance, image ) {

			jQuery(image.img).readyLoad({ elementId: pref, isPagination: ispg, isLazyload: 0, imageCount: icont });
			
				});
			}

}