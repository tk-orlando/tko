/* ------------------------------------------------------------------------
	Class: prettyPhoto
	Use: Lightbox clone for jQuery
	Author: Stephane Caron (http://www.no-margin-for-errors.com)
	Version: 3.1.6
------------------------------------------------------------------------- */
(function($) {
	$.emgPhoto = {version: '3.1.6'};
	
	$.fn.emgPhoto = function(emg_settings) {
		emg_settings = jQuery.extend({
			hook: 'rel', /* the attribute tag to use for prettyPhoto hooks. default: 'rel'. For HTML5, use "data-rel" or similar. */
			animation_speed: 'normal', /* fast/slow/normal */
			ajaxcallback: function() {},
			slideshow: 5000, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			allow_expand: true, /* Allow the user to expand a resized image. true/false */
			default_width: 500,
			default_height: 344,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'emg_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			horizontal_padding: 10, /* The padding on each side of the picture */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
			overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			overlay_gallery_max: 500, /* Maximum number of pictures in the overlay gallery */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
			callback: function(){}, /* Called when prettyPhoto is closed */
			ie6_fallback: true,
			markup: '<div class="emg_pic_holder"> \
						<div class="ppt">&nbsp;</div> \
						<div class="emg_top"> \
							<div class="emg_left"></div> \
							<div class="emg_middle"></div> \
							<div class="emg_right"></div> \
						</div> \
						<div class="emg_content_container"> \
							<div class="emg_left"> \
							<div class="emg_right"> \
								<div class="emg_content"> \
									<div class="emg_loaderIcon"></div> \
									<div class="emg_fade"> \
										<a href="#" class="emg_expand" title="Expand the image">Expand</a> \
										<div class="emg_hoverContainer"> \
											<div class="emg_description"></div> \
											<div class="currentTextHolder">0/0</div> \
											<a class="emg_next" href="#">next</a> \
											<a class="emg_previous" href="#">previous</a> \
										</div> \
										<div id="emg_full_res"></div> \
										<div class="emg_details"> \
											<div class="emg_nav"> \
												<a href="#" class="emg_arrow_previous">Previous</a> \
												<a href="#" class="emg_arrow_next">Next</a> \
											</div> \
											<div class="emg_social">{emg_social}</div> \
											<a class="emg_close" href="#">Close</a> \
										</div> \
									</div> \
								</div> \
							</div> \
							</div> \
						</div> \
						<div class="emg_bottom"> \
							<div class="emg_left"></div> \
							<div class="emg_middle"></div> \
							<div class="emg_right"></div> \
						</div> \
					</div> \
					<div class="emg_overlay"></div>',
			gallery_markup: '<div class="emg_gallery"> \
								<a href="#" class="emg_arrow_previous">Previous</a> \
								<div> \
									<ul> \
										{gallery} \
									</ul> \
								</div> \
								<a href="#" class="emg_arrow_next">Next</a> \
							</div>',
			image_markup: '<img id="fullResImage" src="{path}" />',
			flash_markup: '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',
			quicktime_markup: '<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',
			iframe_markup: '<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',
			inline_markup: '<div class="emg_inline">{content}</div>',
			custom_markup: '',
			social_tools: '<div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="//www.facebook.com/plugins/like.php?locale=en_US&href={location_href}&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div>' /* html or false to disable */
		}, emg_settings);
		
		// Global variables accessible only by prettyPhoto
		var matchedObjects = this, percentBased = false, emg_dimensions, emg_open,
		
		// prettyPhoto container specific
		emg_contentHeight, emg_contentWidth, emg_containerHeight, emg_containerWidth,
		
		// Window size
		windowHeight = $(window).height(), windowWidth = $(window).width(),

		// Global elements
		emg_slideshow;
		
		doresize = true, scroll_pos = _get_scroll();
	
		// Window/Keyboard events
		$(window).unbind('resize.prettyphoto').bind('resize.prettyphoto',function(){ _center_overlay(); _resize_overlay(); });
		
		if(emg_settings.keyboard_shortcuts) {
			$(document).unbind('keydown.prettyphoto').bind('keydown.prettyphoto',function(e){
				if(typeof $emg_pic_holder != 'undefined'){
					if($emg_pic_holder.is(':visible')){
						switch(e.keyCode){
							case 37:
								$.emgPhoto.changePage('previous');
								e.preventDefault();
								break;
							case 39:
								$.emgPhoto.changePage('next');
								e.preventDefault();
								break;
							case 27:
								if(!settings.modal)
								$.emgPhoto.close();
								e.preventDefault();
								break;
						};
						// return false;
					};
				};
			});
		};
		
		/**
		* Initialize prettyPhoto.
		*/
		$.emgPhoto.initialize = function() {
			
			settings = emg_settings;
			
			if(settings.theme == 'emg_default') settings.horizontal_padding = 16;
			
			// Find out if the picture is part of a set
			theRel = $(this).attr(settings.hook);
			galleryRegExp = /\[(?:.*)\]/;
			isSet = (galleryRegExp.exec(theRel)) ? true : false;
			
			// Put the SRCs, TITLEs, ALTs into an array.
			emg_images = (isSet) ? jQuery.map(matchedObjects, function(n, i){ if($(n).attr(settings.hook).indexOf(theRel) != -1) return $(n).attr('href'); }) : $.makeArray($(this).attr('href'));
			emg_titles = (isSet) ? jQuery.map(matchedObjects, function(n, i){ if($(n).attr(settings.hook).indexOf(theRel) != -1) return ($(n).find('img').attr('alt')) ? $(n).find('img').attr('alt') : ""; }) : $.makeArray($(this).find('img').attr('alt'));
			emg_descriptions = (isSet) ? jQuery.map(matchedObjects, function(n, i){ if($(n).attr(settings.hook).indexOf(theRel) != -1) return ($(n).attr('title')) ? $(n).attr('title') : ""; }) : $.makeArray($(this).attr('title'));
			
			if(emg_images.length > settings.overlay_gallery_max) settings.overlay_gallery = false;
			
			set_position = jQuery.inArray($(this).attr('href'), emg_images); // Define where in the array the clicked item is positionned
			rel_index = (isSet) ? set_position : $("a["+settings.hook+"^='"+theRel+"']").index($(this));
			
			_build_overlay(this); // Build the overlay {this} being the caller
			
			if(settings.allow_resize)
				$(window).bind('scroll.prettyphoto',function(){ _center_overlay(); });
			
			
			$.emgPhoto.open();
			
			return false;
		}


		/**
		* Opens the prettyPhoto modal box.
		* @param image {String,Array} Full path to the image to be open, can also be an array containing full images paths.
		* @param title {String,Array} The title to be displayed with the picture, can also be an array containing all the titles.
		* @param description {String,Array} The description to be displayed with the picture, can also be an array containing all the descriptions.
		*/
		$.emgPhoto.open = function(event) {
			if(typeof settings == "undefined"){ // Means it's an API call, need to manually get the settings and set the variables
				settings = emg_settings;
				emg_images = $.makeArray(arguments[0]);
				emg_titles = (arguments[1]) ? $.makeArray(arguments[1]) : $.makeArray("");
				emg_descriptions = (arguments[2]) ? $.makeArray(arguments[2]) : $.makeArray("");
				isSet = (emg_images.length > 1) ? true : false;
				set_position = (arguments[3])? arguments[3]: 0;
				_build_overlay(event.target); // Build the overlay {this} being the caller
			}
			
			if(settings.hideflash) $('object,embed,iframe[src*=youtube],iframe[src*=vimeo]').css('visibility','hidden'); // Hide the flash

			_checkPosition($(emg_images).size()); // Hide the next/previous links if on first or last images.
		
			$('.emg_loaderIcon').show();
		
			if(settings.deeplinking)
				setHashtag();
		
			// Rebuild Facebook Like Button with updated href
			if(settings.social_tools){
				facebook_like_link = settings.social_tools.replace('{location_href}', encodeURIComponent(location.href)); 
				$emg_pic_holder.find('.emg_social').html(facebook_like_link);
			}
			
			// Fade the content in
			if($ppt.is(':hidden')) $ppt.css('opacity',0).show();
			$emg_overlay.show().fadeTo(settings.animation_speed,settings.opacity);

			// Display the current position
			$emg_pic_holder.find('.currentTextHolder').text((set_position+1) + settings.counter_separator_label + $(emg_images).size());

			// Set the description
			if(typeof emg_descriptions[set_position] != 'undefined' && emg_descriptions[set_position] != ""){
				$emg_pic_holder.find('.emg_description').show().html(unescape(emg_descriptions[set_position]));
			}else{
				$emg_pic_holder.find('.emg_description').hide();
			}
			
			// Get the dimensions
			movie_width = ( parseFloat(getParam('width',emg_images[set_position])) ) ? getParam('width',emg_images[set_position]) : settings.default_width.toString();
			movie_height = ( parseFloat(getParam('height',emg_images[set_position])) ) ? getParam('height',emg_images[set_position]) : settings.default_height.toString();
			
			// If the size is % based, calculate according to window dimensions
			percentBased=false;
			if(movie_height.indexOf('%') != -1) { movie_height = parseFloat(($(window).height() * parseFloat(movie_height) / 100) - 150); percentBased = true; }
			if(movie_width.indexOf('%') != -1) { movie_width = parseFloat(($(window).width() * parseFloat(movie_width) / 100) - 150); percentBased = true; }
			
			// Fade the holder
			$emg_pic_holder.fadeIn(function(){
				// Set the title
				(settings.show_title && emg_titles[set_position] != "" && typeof emg_titles[set_position] != "undefined") ? $ppt.html(unescape(emg_titles[set_position])) : $ppt.html('&nbsp;');
				
				imgPreloader = "";
				skipInjection = false;
				
				// Inject the proper content
				switch(_getFileType(emg_images[set_position])){
					case 'image':
						imgPreloader = new Image();

						// Preload the neighbour images
						nextImage = new Image();
						if(isSet && set_position < $(emg_images).size() -1) nextImage.src = emg_images[set_position + 1];
						prevImage = new Image();
						if(isSet && emg_images[set_position - 1]) prevImage.src = emg_images[set_position - 1];

						$emg_pic_holder.find('#emg_full_res')[0].innerHTML = settings.image_markup.replace(/{path}/g,emg_images[set_position]);

						imgPreloader.onload = function(){
							// Fit item to viewport
							emg_dimensions = _fitToViewport(imgPreloader.width,imgPreloader.height);

							_showContent();
						};

						imgPreloader.onerror = function(){
							alert('Image cannot be loaded. Make sure the path is correct and image exist.');
							$.emgPhoto.close();
						};
					
						imgPreloader.src = emg_images[set_position];
					break;
				
					case 'youtube':
						emg_dimensions = _fitToViewport(movie_width,movie_height); // Fit item to viewport
						
						// Regular youtube link
						movie_id = getParam('v',emg_images[set_position]);
						
						// youtu.be link
						if(movie_id == ""){
							movie_id = emg_images[set_position].split('youtu.be/');
							movie_id = movie_id[1];
							if(movie_id.indexOf('?') > 0)
								movie_id = movie_id.substr(0,movie_id.indexOf('?')); // Strip anything after the ?

							if(movie_id.indexOf('&') > 0)
								movie_id = movie_id.substr(0,movie_id.indexOf('&')); // Strip anything after the &
						}

						movie = 'http://www.youtube.com/embed/'+movie_id;
						(getParam('rel',emg_images[set_position])) ? movie+="?rel="+getParam('rel',emg_images[set_position]) : movie+="?rel=1";
							
						if(settings.autoplay) movie += "&autoplay=1";
					
						toInject = settings.iframe_markup.replace(/{width}/g,emg_dimensions['width']).replace(/{height}/g,emg_dimensions['height']).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,movie);
					break;
				
					case 'vimeo':
						emg_dimensions = _fitToViewport(movie_width,movie_height); // Fit item to viewport
					
						movie_id = emg_images[set_position];
						var regExp = /http(s?):\/\/(www\.)?vimeo.com\/(\d+)/;
						var match = movie_id.match(regExp);
						
						movie = 'http://player.vimeo.com/video/'+ match[3] +'?title=0&amp;byline=0&amp;portrait=0';
						if(settings.autoplay) movie += "&autoplay=1;";
				
						vimeo_width = emg_dimensions['width'] + '/embed/?moog_width='+ emg_dimensions['width'];
				
						toInject = settings.iframe_markup.replace(/{width}/g,vimeo_width).replace(/{height}/g,emg_dimensions['height']).replace(/{path}/g,movie);
					break;
				
					case 'quicktime':
						emg_dimensions = _fitToViewport(movie_width,movie_height); // Fit item to viewport
						emg_dimensions['height']+=15; emg_dimensions['contentHeight']+=15; emg_dimensions['containerHeight']+=15; // Add space for the control bar
				
						toInject = settings.quicktime_markup.replace(/{width}/g,emg_dimensions['width']).replace(/{height}/g,emg_dimensions['height']).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,emg_images[set_position]).replace(/{autoplay}/g,settings.autoplay);
					break;
				
					case 'flash':
						emg_dimensions = _fitToViewport(movie_width,movie_height); // Fit item to viewport
					
						flash_vars = emg_images[set_position];
						flash_vars = flash_vars.substring(emg_images[set_position].indexOf('flashvars') + 10,emg_images[set_position].length);

						filename = emg_images[set_position];
						filename = filename.substring(0,filename.indexOf('?'));
					
						toInject =  settings.flash_markup.replace(/{width}/g,emg_dimensions['width']).replace(/{height}/g,emg_dimensions['height']).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,filename+'?'+flash_vars);
					break;
				
					case 'iframe':
						emg_dimensions = _fitToViewport(movie_width,movie_height); // Fit item to viewport
				
						frame_url = emg_images[set_position];
						frame_url = frame_url.substr(0,frame_url.indexOf('iframe')-1);

						toInject = settings.iframe_markup.replace(/{width}/g,emg_dimensions['width']).replace(/{height}/g,emg_dimensions['height']).replace(/{path}/g,frame_url);
					break;
					
					case 'ajax':
						doresize = false; // Make sure the dimensions are not resized.
						emg_dimensions = _fitToViewport(movie_width,movie_height);
						doresize = true; // Reset the dimensions
					
						skipInjection = true;
						$.get(emg_images[set_position],function(responseHTML){
							toInject = settings.inline_markup.replace(/{content}/g,responseHTML);
							$emg_pic_holder.find('#emg_full_res')[0].innerHTML = toInject;
							_showContent();
						});
						
					break;
					
					case 'custom':
						emg_dimensions = _fitToViewport(movie_width,movie_height); // Fit item to viewport
					
						toInject = settings.custom_markup;
					break;
				
					case 'inline':
						// to get the item height clone it, apply default width, wrap it in the prettyPhoto containers , then delete
						myClone = $(emg_images[set_position]).clone().append('<br clear="all" />').css({'width':settings.default_width}).wrapInner('<div id="emg_full_res"><div class="emg_inline"></div></div>').appendTo($('body')).show();
						doresize = false; // Make sure the dimensions are not resized.
						emg_dimensions = _fitToViewport($(myClone).width(),$(myClone).height());
						doresize = true; // Reset the dimensions
						$(myClone).remove();
						toInject = settings.inline_markup.replace(/{content}/g,$(emg_images[set_position]).html());
					break;
				};

				if(!imgPreloader && !skipInjection){
					$emg_pic_holder.find('#emg_full_res')[0].innerHTML = toInject;
				
					// Show content
					_showContent();
				};
			});

			return false;
		};

	
		/**
		* Change page in the prettyPhoto modal box
		* @param direction {String} Direction of the paging, previous or next.
		*/
		$.emgPhoto.changePage = function(direction){
			currentGalleryPage = 0;
			
			if(direction == 'previous') {
				set_position--;
				if (set_position < 0) set_position = $(emg_images).size()-1;
			}else if(direction == 'next'){
				set_position++;
				if(set_position > $(emg_images).size()-1) set_position = 0;
			}else{
				set_position=direction;
			};
			
			rel_index = set_position;

			if(!doresize) doresize = true; // Allow the resizing of the images
			if(settings.allow_expand) {
				$('.emg_contract').removeClass('emg_contract').addClass('emg_expand');
			}

			_hideContent(function(){ $.emgPhoto.open(); });
		};


		/**
		* Change gallery page in the prettyPhoto modal box
		* @param direction {String} Direction of the paging, previous or next.
		*/
		$.emgPhoto.changeGalleryPage = function(direction){
			if(direction=='next'){
				currentGalleryPage ++;

				if(currentGalleryPage > totalPage) currentGalleryPage = 0;
			}else if(direction=='previous'){
				currentGalleryPage --;

				if(currentGalleryPage < 0) currentGalleryPage = totalPage;
			}else{
				currentGalleryPage = direction;
			};
			
			slide_speed = (direction == 'next' || direction == 'previous') ? settings.animation_speed : 0;

			slide_to = currentGalleryPage * (itemsPerPage * itemWidth);

			$emg_gallery.find('ul').animate({left:-slide_to},slide_speed);
		};


		/**
		* Start the slideshow...
		*/
		$.emgPhoto.startSlideshow = function(){
			if(typeof emg_slideshow == 'undefined'){
				$emg_pic_holder.find('.emg_play').unbind('click').removeClass('emg_play').addClass('emg_pause').click(function(){
					$.emgPhoto.stopSlideshow();
					return false;
				});
				emg_slideshow = setInterval($.emgPhoto.startSlideshow,settings.slideshow);
			}else{
				$.emgPhoto.changePage('next');	
			};
		}


		/**
		* Stop the slideshow...
		*/
		$.emgPhoto.stopSlideshow = function(){
			$emg_pic_holder.find('.emg_pause').unbind('click').removeClass('emg_pause').addClass('emg_play').click(function(){
				$.emgPhoto.startSlideshow();
				return false;
			});
			clearInterval(emg_slideshow);
			emg_slideshow=undefined;
		}


		/**
		* Closes prettyPhoto.
		*/
		$.emgPhoto.close = function(){
			if($emg_overlay.is(":animated")) return;
			
			$.emgPhoto.stopSlideshow();
			
			$emg_pic_holder.stop().find('object,embed').css('visibility','hidden');
			
			$('div.emg_pic_holder,div.ppt,.emg_fade').fadeOut(settings.animation_speed,function(){ $(this).remove(); });
			
			$emg_overlay.fadeOut(settings.animation_speed, function(){
				
				if(settings.hideflash) $('object,embed,iframe[src*=youtube],iframe[src*=vimeo]').css('visibility','visible'); // Show the flash
				
				$(this).remove(); // No more need for the prettyPhoto markup
				
				$(window).unbind('scroll.prettyphoto');
				
				clearHashtag();
				
				settings.callback();
				
				doresize = true;
				
				emg_open = false;
				
				delete settings;
			});
		};
	
		/**
		* Set the proper sizes on the containers and animate the content in.
		*/
		function _showContent(){
			$('.emg_loaderIcon').hide();

			// Calculate the opened top position of the pic holder
			projectedTop = scroll_pos['scrollTop'] + ((windowHeight/2) - (emg_dimensions['containerHeight']/2));
			if(projectedTop < 0) projectedTop = 0;

			$ppt.fadeTo(settings.animation_speed,1);

			// Resize the content holder
			$emg_pic_holder.find('.emg_content')
				.animate({
					height:emg_dimensions['contentHeight'],
					width:emg_dimensions['contentWidth']
				},settings.animation_speed);
			
			// Resize picture the holder
			$emg_pic_holder.animate({
				'top': projectedTop,
				'left': ((windowWidth/2) - (emg_dimensions['containerWidth']/2) < 0) ? 0 : (windowWidth/2) - (emg_dimensions['containerWidth']/2),
				width:emg_dimensions['containerWidth']
			},settings.animation_speed,function(){
				$emg_pic_holder.find('.emg_hoverContainer,#fullResImage').height(emg_dimensions['height']).width(emg_dimensions['width']);

				$emg_pic_holder.find('.emg_fade').fadeIn(settings.animation_speed); // Fade the new content

				// Show the nav
				if(isSet && _getFileType(emg_images[set_position])=="image") { $emg_pic_holder.find('.emg_hoverContainer').show(); }else{ $emg_pic_holder.find('.emg_hoverContainer').hide(); }
			
				if(settings.allow_expand) {
					if(emg_dimensions['resized']){ // Fade the resizing link if the image is resized
						$('a.emg_expand,a.emg_contract').show();
					}else{
						$('a.emg_expand').hide();
					}
				}
				
				if(settings.autoplay_slideshow && !emg_slideshow && !emg_open) $.emgPhoto.startSlideshow();
				
				settings.changepicturecallback(); // Callback!
				
				emg_open = true;
			});
			
			_insert_gallery();
			emg_settings.ajaxcallback();
		};
		
		/**
		* Hide the content...DUH!
		*/
		function _hideContent(callback){
			// Fade out the current picture
			$emg_pic_holder.find('#emg_full_res object,#emg_full_res embed').css('visibility','hidden');
			$emg_pic_holder.find('.emg_fade').fadeOut(settings.animation_speed,function(){
				$('.emg_loaderIcon').show();
				
				callback();
			});
		};
	
		/**
		* Check the item position in the gallery array, hide or show the navigation links
		* @param setCount {integer} The total number of items in the set
		*/
		function _checkPosition(setCount){
			(setCount > 1) ? $('.emg_nav').show() : $('.emg_nav').hide(); // Hide the bottom nav if it's not a set.
		};
	
		/**
		* Resize the item dimensions if it's bigger than the viewport
		* @param width {integer} Width of the item to be opened
		* @param height {integer} Height of the item to be opened
		* @return An array containin the "fitted" dimensions
		*/
		function _fitToViewport(width,height){
			resized = false;

			_getDimensions(width,height);
			
			// Define them in case there's no resize needed
			imageWidth = width, imageHeight = height;

			if( ((emg_containerWidth > windowWidth) || (emg_containerHeight > windowHeight)) && doresize && settings.allow_resize && !percentBased) {
				resized = true, fitting = false;
			
				while (!fitting){
					if((emg_containerWidth > windowWidth)){
						imageWidth = (windowWidth - 50);
						imageHeight = (height/width) * imageWidth;
					}else if((emg_containerHeight > windowHeight)){
						imageHeight = (windowHeight - 200);
						imageWidth = (width/height) * imageHeight;
					}else{
						fitting = true;
					};

					emg_containerHeight = imageHeight, emg_containerWidth = imageWidth;
				};
			

				
				if((emg_containerWidth > windowWidth) || (emg_containerHeight > windowHeight)){
					_fitToViewport(emg_containerWidth,emg_containerHeight)
				};
				
				_getDimensions(imageWidth,imageHeight);
			};
			
			return {
				width:Math.floor(imageWidth),
				height:Math.floor(imageHeight),
				containerHeight:Math.floor(emg_containerHeight),
				containerWidth:Math.floor(emg_containerWidth) + (settings.horizontal_padding * 2),
				contentHeight:Math.floor(emg_contentHeight),
				contentWidth:Math.floor(emg_contentWidth),
				resized:resized
			};
		};
		
		/**
		* Get the containers dimensions according to the item size
		* @param width {integer} Width of the item to be opened
		* @param height {integer} Height of the item to be opened
		*/
		function _getDimensions(width,height){
			width = parseFloat(width);
			height = parseFloat(height);
			
			// Get the details height, to do so, I need to clone it since it's invisible
			$emg_details = $emg_pic_holder.find('.emg_details');
			$emg_details.width(width);
			detailsHeight = parseFloat($emg_details.css('marginTop')) + parseFloat($emg_details.css('marginBottom'));
			
			$emg_details = $emg_details.clone().addClass(settings.theme).width(width).appendTo($('body')).css({
				'position':'absolute',
				'top':-10000
			});
			detailsHeight += $emg_details.height();
			detailsHeight = (detailsHeight <= 34) ? 36 : detailsHeight; // Min-height for the details
			$emg_details.remove();
			
			// Get the titles height, to do so, I need to clone it since it's invisible
			$emg_title = $emg_pic_holder.find('.ppt');
			$emg_title.width(width);
			titleHeight = parseFloat($emg_title.css('marginTop')) + parseFloat($emg_title.css('marginBottom'));
			$emg_title = $emg_title.clone().appendTo($('body')).css({
				'position':'absolute',
				'top':-10000
			});
			titleHeight += $emg_title.height();
			$emg_title.remove();
			
			// Get the container size, to resize the holder to the right dimensions
			emg_contentHeight = height + detailsHeight;
			emg_contentWidth = width;
			emg_containerHeight = emg_contentHeight + titleHeight + $emg_pic_holder.find('.emg_top').height() + $emg_pic_holder.find('.emg_bottom').height();
			emg_containerWidth = width;
		}
	
		function _getFileType(itemSrc){
			if (itemSrc.match(/youtube\.com\/watch/i) || itemSrc.match(/youtu\.be/i)) {
				return 'youtube';
			}else if (itemSrc.match(/vimeo\.com/i)) {
				return 'vimeo';
			}else if(itemSrc.match(/\b.mov\b/i)){ 
				return 'quicktime';
			}else if(itemSrc.match(/\b.swf\b/i)){
				return 'flash';
			}else if(itemSrc.match(/\biframe=true\b/i)){
				return 'iframe';
			}else if(itemSrc.match(/\bajax=true\b/i)){
				return 'ajax';
			}else if(itemSrc.match(/\bcustom=true\b/i)){
				return 'custom';
			}else if(itemSrc.substr(0,1) == '#'){
				return 'inline';
			}else{
				return 'image';
			};
		};
	
		function _center_overlay(){
			if(doresize && typeof $emg_pic_holder != 'undefined') {
				scroll_pos = _get_scroll();
				contentHeight = $emg_pic_holder.height(), contentwidth = $emg_pic_holder.width();

				projectedTop = (windowHeight/2) + scroll_pos['scrollTop'] - (contentHeight/2);
				if(projectedTop < 0) projectedTop = 0;
				
				if(contentHeight > windowHeight)
					return;

				$emg_pic_holder.css({
					'top': projectedTop,
					'left': (windowWidth/2) + scroll_pos['scrollLeft'] - (contentwidth/2)
				});
			};
		};
	
		function _get_scroll(){
			if (self.pageYOffset) {
				return {scrollTop:self.pageYOffset,scrollLeft:self.pageXOffset};
			} else if (document.documentElement && document.documentElement.scrollTop) { // Explorer 6 Strict
				return {scrollTop:document.documentElement.scrollTop,scrollLeft:document.documentElement.scrollLeft};
			} else if (document.body) {// all other Explorers
				return {scrollTop:document.body.scrollTop,scrollLeft:document.body.scrollLeft};
			};
		};
	
		function _resize_overlay() {
			windowHeight = $(window).height(), windowWidth = $(window).width();
			
			if(typeof $emg_overlay != "undefined") $emg_overlay.height($(document).height()).width(windowWidth);
		};
	
		function _insert_gallery(){
			if(isSet && settings.overlay_gallery && _getFileType(emg_images[set_position])=="image") {
				itemWidth = 52+5; // 52 beign the thumb width, 5 being the right margin.
				navWidth = (settings.theme == "facebook" || settings.theme == "emg_default") ? 50 : 30; // Define the arrow width depending on the theme
				
				itemsPerPage = Math.floor((emg_dimensions['containerWidth'] - 100 - navWidth) / itemWidth);
				itemsPerPage = (itemsPerPage < emg_images.length) ? itemsPerPage : emg_images.length;
				totalPage = Math.ceil(emg_images.length / itemsPerPage) - 1;

				// Hide the nav in the case there's no need for links
				if(totalPage == 0){
					navWidth = 0; // No nav means no width!
					$emg_gallery.find('.emg_arrow_next,.emg_arrow_previous').hide();
				}else{
					$emg_gallery.find('.emg_arrow_next,.emg_arrow_previous').show();
				};

				galleryWidth = itemsPerPage * itemWidth;
				fullGalleryWidth = emg_images.length * itemWidth;
				
				// Set the proper width to the gallery items
				$emg_gallery
					.css('margin-left',-((galleryWidth/2) + (navWidth/2)))
					.find('div:first').width(galleryWidth+5)
					.find('ul').width(fullGalleryWidth)
					.find('li.selected').removeClass('selected');
				
				goToPage = (Math.floor(set_position/itemsPerPage) < totalPage) ? Math.floor(set_position/itemsPerPage) : totalPage;

				$.emgPhoto.changeGalleryPage(goToPage);
				
				$emg_gallery_li.filter(':eq('+set_position+')').addClass('selected');
			}else{
				$emg_pic_holder.find('.emg_content').unbind('mouseenter mouseleave');
				// $emg_gallery.hide();
			}
		}
	
		function _build_overlay(caller){
			// Inject Social Tool markup into General markup
			if(settings.social_tools)
				facebook_like_link = settings.social_tools.replace('{location_href}', encodeURIComponent(location.href)); 

			settings.markup = settings.markup.replace('{emg_social}',''); 
			
			$('body').append(settings.markup); // Inject the markup
			
			$emg_pic_holder = $('.emg_pic_holder') , $ppt = $('.ppt'), $emg_overlay = $('div.emg_overlay'); // Set my global selectors
			
			// Inject the inline gallery!
			if(isSet && settings.overlay_gallery) {
				currentGalleryPage = 0;
				toInject = "";
				for (var i=0; i < emg_images.length; i++) {
					if(!emg_images[i].match(/\b(jpg|jpeg|png|gif)\b/gi)){
						classname = 'default';
						img_src = '';
					}else{
						classname = '';
						img_src = emg_images[i];
					}
					toInject += "<li class='"+classname+"'><a href='#'><img src='" + img_src + "' width='50' alt='' /></a></li>";
				};
				
				toInject = settings.gallery_markup.replace(/{gallery}/g,toInject);
				
				$emg_pic_holder.find('#emg_full_res').after(toInject);
				
				$emg_gallery = $('.emg_pic_holder .emg_gallery'), $emg_gallery_li = $emg_gallery.find('li'); // Set the gallery selectors
				
				$emg_gallery.find('.emg_arrow_next').click(function(){
					$.emgPhoto.changeGalleryPage('next');
					$.emgPhoto.stopSlideshow();
					return false;
				});
				
				$emg_gallery.find('.emg_arrow_previous').click(function(){
					$.emgPhoto.changeGalleryPage('previous');
					$.emgPhoto.stopSlideshow();
					return false;
				});
				
				$emg_pic_holder.find('.emg_content').hover(
					function(){
						$emg_pic_holder.find('.emg_gallery:not(.disabled)').fadeIn();
					},
					function(){
						$emg_pic_holder.find('.emg_gallery:not(.disabled)').fadeOut();
					});

				itemWidth = 52+5; // 52 beign the thumb width, 5 being the right margin.
				$emg_gallery_li.each(function(i){
					$(this)
						.find('a')
						.click(function(){
							$.emgPhoto.changePage(i);
							$.emgPhoto.stopSlideshow();
							return false;
						});
				});
			};
			
			
			// Inject the play/pause if it's a slideshow
			if(settings.slideshow){
				$emg_pic_holder.find('.emg_nav').prepend('<a href="#" class="emg_play">Play</a>')
				$emg_pic_holder.find('.emg_nav .emg_play').click(function(){
					$.emgPhoto.startSlideshow();
					return false;
				});
			}
			
			$emg_pic_holder.attr('class','emg_pic_holder ' + settings.theme); // Set the proper theme
			
			$emg_overlay
				.css({
					'opacity':0,
					'height':$(document).height(),
					'width':$(window).width()
					})
				.bind('click',function(){
					if(!settings.modal) $.emgPhoto.close();
				});

			$('a.emg_close').bind('click',function(){ $.emgPhoto.close(); return false; });


			if(settings.allow_expand) {
				$('a.emg_expand').bind('click',function(e){
					// Expand the image
					if($(this).hasClass('emg_expand')){
						$(this).removeClass('emg_expand').addClass('emg_contract');
						doresize = false;
					}else{
						$(this).removeClass('emg_contract').addClass('emg_expand');
						doresize = true;
					};
				
					_hideContent(function(){ $.emgPhoto.open(); });
			
					return false;
				});
			}
		
			$emg_pic_holder.find('.emg_previous, .emg_nav .emg_arrow_previous').bind('click',function(){
				$.emgPhoto.changePage('previous');
				$.emgPhoto.stopSlideshow();
				return false;
			});
		
			$emg_pic_holder.find('.emg_next, .emg_nav .emg_arrow_next').bind('click',function(){
				$.emgPhoto.changePage('next');
				$.emgPhoto.stopSlideshow();
				return false;
			});
			
			_center_overlay(); // Center it
		};

		if(!emg_alreadyInitialized && getHashtag()){
			emg_alreadyInitialized = true;
			
			// Grab the rel index to trigger the click on the correct element
			hashIndex = getHashtag();
			hashRel = hashIndex;
			hashIndex = hashIndex.substring(hashIndex.indexOf('/')+1,hashIndex.length-1);
			hashRel = hashRel.substring(0,hashRel.indexOf('/'));

			// Little timeout to make sure all the prettyPhoto initialize scripts has been run.
			// Useful in the event the page contain several init scripts.
			setTimeout(function(){ $("a["+emg_settings.hook+"^='"+hashRel+"']:eq("+hashIndex+")").trigger('click'); },50);
		}
		
		return this.unbind('click.prettyphoto').bind('click.prettyphoto',$.emgPhoto.initialize); // Return the jQuery object for chaining. The unbind method is used to avoid click conflict when the plugin is called more than once
	};
	
	function getHashtag(){
		var url = location.href;
		hashtag = (url.indexOf('#prettyPhoto') !== -1) ? decodeURI(url.substring(url.indexOf('#prettyPhoto')+1,url.length)) : false;

		if (hashtag){ hashtag = hashtag.replace(/<|>/g,''); }

		return hashtag;
	};
	
	function setHashtag(){
		if(typeof theRel == 'undefined') return; // theRel is set on normal calls, it's impossible to deeplink using the API
		location.hash = theRel + '/'+rel_index+'/';
	};
	
	function clearHashtag(){
		if ( location.href.indexOf('#prettyPhoto') !== -1 ) location.hash = "prettyPhoto";
	}
	
	function getParam(name,url){
	  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	  var regexS = "[\\?&]"+name+"=([^&#]*)";
	  var regex = new RegExp( regexS );
	  var results = regex.exec( url );
	  return ( results == null ) ? "" : results[1];
	}
	
})(jQuery);

var emg_alreadyInitialized = false; // Used for the deep linking to make sure not to call the same function several times.
