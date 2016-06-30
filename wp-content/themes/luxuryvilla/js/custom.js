(function ($) {
"use strict";


/* bwmap */
function gg_bwmap_init() {
	if($('#bwmap').length > 0){
		$( '#bwmap' ).each(function(){

			var $this    = $(this),
			latitude     = $this.attr('data-latitude'),
			longitude    = $this.attr('data-longitude'),
			infow        = $this.attr('data-infow'),
			infowtitle   = $this.attr('data-infowtitle'),
			infowcontent = $this.attr('data-infowcontent'),
			mapzoom      = $this.attr('data-zoom');

			var map;
        	var bwmap = new google.maps.LatLng(latitude, longitude);

        	function initialize() {

	            var mapOptions = {
	                zoom: 14,
	                scrollwheel: false,
	                center: bwmap,
	                mapTypeId: google.maps.MapTypeId.ROADMAP,
	          		styles : [{featureType:'all',stylers:[{saturation:-100},{gamma:0.0}]}]
	            };

	            map = new google.maps.Map(document.getElementById('bwmap'),
	                mapOptions);

	            var marker = new google.maps.Marker({
					position: bwmap,
					map: map
				});

	            if (infow =='use_infow') {
					var contentString = '<div id="content">'+
				      '<div id="siteNotice">'+
				      '</div>'+
				      '<h1 id="firstHeading" class="firstHeading">' + infowtitle + '</h1>'+
				      '<div id="bodyContent">'+
				      '<p>' + infowcontent + '</p>'+
				      '</div>'+
				      '</div>';

		            var infowindow = new google.maps.InfoWindow({
					    content: contentString
					});

		            google.maps.event.addListener(marker, 'click', function() {
						infowindow.open(map,marker);
					});
				}

	        }

        google.maps.event.addDomListener(window, 'load', initialize);

		});
	}
}

function gg_isotope_init() {
	if($('.el-grid:not(.owl-carousel)').length > 0){
	    
	    var layout_modes = {
	        fitrows: 'fitRows',
	        masonry: 'masonry'
	    }
	    
	    jQuery('.gg_posts_grid, .gg_rooms').each(function() {
	    	
			var $container  = jQuery(this);
			var $thumbs     = $container.find('.el-grid:not(.owl-carousel)');
			var layout_mode = $thumbs.attr('data-layout-mode');
			var $imgs = $thumbs.find('img.lazy');
			
			if($('body').hasClass('gg-lazyload-on')) {
				if($imgs.length > 0) {
				    $imgs.lazyload({
				        effect: "fadeIn",
				        threshold : 200,
				        failure_limit: Math.max($imgs.length - 1, 0),
				    });
				}
			}
			
			$thumbs.imagesLoaded( function() {
		        $thumbs.isotope({
		            // options
		            itemSelector : '.isotope-item',
		            layoutMode : (layout_modes[layout_mode]==undefined ? 'fitRows' : layout_modes[layout_mode]),
		            onLayout: function () {
			            $(window).trigger("scroll");
			        }
		        });
	        })
	        

	        if( $container.find('.categories_filter').length ){
		        $container.find('.categories_filter a').data('isotope', $thumbs).click(function(e){
		            e.preventDefault();
		            var $thumbs = jQuery(this).data('isotope');
		            jQuery(this).parent().parent().find('.active').removeClass('active');
		            jQuery(this).parent().addClass('active');
		            $thumbs.isotope({filter: jQuery(this).attr('data-filter')});
		        });
		    }

	        jQuery(window).bind('load scroll resize', function() {
				$thumbs.isotope('layout');
	        });

	    });
	}
}

/* Magnific */
function gg_magnific_init() {
	if($('.el-grid, article.post figure.effect-sadie figcaption, .owl-carousel.has_magnific, .wpb_image_grid.has_magnific, .wpb_single_image.has_magnific').length > 0){
		$( '.el-grid, article.post figure.effect-sadie figcaption, .owl-carousel.has_magnific, .wpb_image_grid.has_magnific, .wpb_single_image.has_magnific' ).each(function(){
			$(this).magnificPopup({
				delegate: 'a.lightbox-el',
				type: 'image',
				gallery: {
		            enabled: true
		        },
				callbacks: {
				    elementParse: function(item) {
				      if(item.el.context.className == 'lightbox-el link-wrapper lightbox-video') {
				         item.type = 'iframe';
				      } else {
				         item.type = 'image';
				      }
				    }
				}
			});
		});
	}
}

/* OwlCarousel */
function gg_owlcarousel_init() {
	if($('.owl-carousel').length > 0){
		$( '.owl-carousel' ).each(function(){

			var $this            = $(this),
			slidesPerView        = $this.attr('data-slides-per-view'),
			singleItemData       = $this.attr('data-single-item') == "true" ? true : false,
			mouseDragData        = $this.attr('data-mouse-drag') == "true" ? true : false,
			transitionSlide      = $this.attr('data-transition-slide'),
			navigationData       = $this.attr('data-navigation-owl') == "true" ? true : false,
			paginationData       = $this.attr('data-pagination-owl') == "true" ? true : false,
			lazyloadData         = $this.attr('data-lazyload') == "true" ? true : false,
			autoplayData         = '',
			autoplayDataBgImages = $this.attr('data-autoplay-bg-images'),
			rewindData           = $this.attr('data-rewind') == "true" ? true : false,
			speedData            = $this.attr('data-speed'),
			pagColor             = $this.attr('data-pag-color'),
			cID                  = $this.attr('data-c-id'),
			heightData           = $this.attr('data-height') == "true" ? true : false,
			afterInitData        = $this.attr('data-afterinit') == "navColor" ? navColor : '';

			if ($this.attr('data-autoplay') == "true") {
				autoplayData = 5000; 
			} else if ($this.attr('data-autoplay') == "false") {
				autoplayData = false; 
			} else {
				autoplayData = $this.attr('data-autoplay');
			}

			$this.owlCarousel({
				items: slidesPerView,
				navigation: navigationData,
				pagination : paginationData,
				lazyLoad : lazyloadData,
			    navigationText: [
					"<i class='arrow_carrot-left_alt2'></i>",
					"<i class='arrow_carrot-right_alt2'></i>"
					],
			    
			    singleItem : singleItemData,
			    mouseDrag : mouseDragData,
			    transitionStyle : transitionSlide, //fade, backSlide, goDown, scaleUp
			    autoPlay : autoplayData,
			    rewindNav : rewindData,
			    slideSpeed : speedData,
			    autoHeight : heightData,
			    addClassActive : true,
			    afterInit : mainSlideshow,
			    afterMove : mainSlideshow
		  	});
			
			//MainSlideshow logic
			function mainSlideshow(elem){
			    var current = this.currentItem;
				var id = elem.find(".owl-item").eq(current).find(".cbp-bislideshow").attr('id');
				if (id != undefined) {
					$('#' + id).cbpBGSlideshow({
						interval: autoplayDataBgImages
					});
				}
			}

	        // set Custom event for NEXT custom control
	        $(".custom-property-nav.next").click(function () {
	            $this.trigger('owl.next');
	        });

	        // set Custom event for PREV custom control
	        $(".custom-property-nav.prev").click(function () {
	            $this.trigger('owl.prev');
	        });

		});

	}
}

/* Counter */
function gg_counter_init(){
	if($('.counter').length > 0){
		jQuery('.counter-holder').waypoint(function() {
			$('.counter').each(function() {
				if(!$(this).hasClass('initialized')){
					$(this).addClass('initialized');
					var $this = $(this),
					countToNumber = $this.attr('data-number'),
					refreshInt = $this.attr('data-interval'),
					speedInt = $this.attr('data-speed');

					$(this).countTo({
						from: 0,
						to: countToNumber,
						speed: speedInt,
						refreshInterval: refreshInt
					});
				}
			});
		}, { offset: '85%' });
	}
}

/* Parallax */
function gg_parallax_init() {
if($('body:not(.luxuryvilla-agent-devices) .parallax-container').length){
			var $scroll = 0;
		    $(window).scroll(function() {
				"use strict";
				$scroll = $(window).scrollTop();
			});
			$('body:not(.luxuryvilla-agent-devices) .parallax-container').each(function() {
				var $self = $(this);
				var section_height = $self.attr('parallax-data-height');
				$self.height(section_height);
				var rate = (section_height / $(document).height()) * 0.7;
				
				var distance = $scroll - $self.offset().top + 104;
				var bpos = - (distance * rate);
				$self.css({'background-position': '0 0', 'background-attachment': 'fixed' });
				$(window).bind('scroll', function() {
					var distance = $scroll - $self.offset().top + 104;
					var bpos = - (distance * rate);
					$self.css({'background-position': 'center ' + bpos  + 'px', 'background-attachment': 'fixed' });
				});
			});
		return this;
	}
}

/* Video background */
function gg_video_background_init() {
if($('body:not(.luxuryvilla-agent-devices) .video-container').length){
		$('body:not(.luxuryvilla-agent-devices) .video-container').each(function() {
			var $this  = $(this),
			height     = $this.attr('video-data-height'),
			video_mp4  = $this.attr('video-data-mp4'),
			video_webm = $this.attr('video-data-webm'),
			video_ogv  = $this.attr('video-data-ogv'),
			unique_id = 1 + Math.floor(Math.random() * 10);

			$(this).css('height', height).prepend('<div class="video-background "></div><div class="video-main-controls controls-'+unique_id+'"></div>');

			jQuery(".video-background").videobackground({
				videoSource: [
					[video_mp4, "video/mp4"],
					[video_webm, "video/webm"],
					[video_ogv, "video/ogg"]
				],
				controlPosition: ".video-main-controls.controls-"+unique_id+"", 
				resize: false, 
				loop: true,
				muted: true
			});

		});
	}
}

$(document).ready(function () {

	gg_owlcarousel_init();
    gg_magnific_init();
    gg_counter_init();
    gg_isotope_init();
    gg_bwmap_init();
    gg_parallax_init();
    gg_video_background_init();

    //Placeholder function for IE9
    $('input, textarea').placeholder();

    //If the rooms module is in a tab reload isotope when the tab is active
    if( $('.gg_rooms').parents('.wpb_tab').length == 1 ) {
	
        $('.ui-tabs').on('tabsactivate', function (event, ui) {
          
          var tabid = ui.newPanel.attr('id');
          var index = ui.newTab.index();

          if ($('#'+tabid).has(".gg_rooms").length > 0) {
            gg_isotope_init();
          }

        });
    }

    //new tabs logic
    if( $('.gg_rooms').parents('.vc_tta-tabs').length == 1 ) {
        $( '[data-vc-tab]' ).on( 'show.vc.tab', function ( e ) {
            var href = $(e.target).attr('href');
            if ( $(href).find('.gg_rooms').length > 0 ) {
            	gg_isotope_init();
            }
        } );
    }

	//Dynamically assign height
	function sizeContent() {
		    // First you forcibly request the scroll bars to hidden regardless if they will be needed or not.
			$('body').css('overflow', 'hidden');

			// Take the measures.
			var wpadminbar 		   = 0,
				quickreservation   = 0,
				header             = 0,
				subheader          = 0,
				footer             = 0,
				areas_map_controls = 0,
				bodyborder         = 30;


			//Get header height
			if($('header.site-header').length > 0){
				if($('body').hasClass('gg-has-vertical-menu')) {
					header = 0;
				} else {
					header = $('header.site-header').height();
				}
			}
			//Get subheader height
			if($('#subheader').length > 0){
				subheader = $('#subheader').outerHeight();
			}
			//Get footer height
			if($('footer.site-footer').length > 0){
				footer = $('footer.site-footer').outerHeight();
			}
			//Get areas map control height
			if($('#areas-map-controls').length > 0){
				areas_map_controls = 86;
			}
			//Get wpadmin bar height
			if ($("#wpadminbar")[0]){
				wpadminbar = 32;
			}
			//Get quick reservation height
			if($('#quick-reservation').length > 0){
				quickreservation = $('#quick-reservation').outerHeight();
			}

			var heightNoScrollBars       = $(window).height() - header - subheader - footer  - areas_map_controls  - wpadminbar - quickreservation - bodyborder;
			var widthNoScrollBars        = $(window).width();
			var heightNoScrollBarsFooter = heightNoScrollBars + footer;

			// Set the overflow css property back to it's original value (default is auto)
			$('body').css('overflow', 'auto');

			if ($(window).width() > 992) {

				if($('body').hasClass('gg-homepage-var1')) {
					$(".owl-item").css("height", heightNoScrollBars);
				}
				if($('body').hasClass('gg-homepage-var2')) {
					$(".owl-item").css("height", heightNoScrollBarsFooter);
				}

				if($('body').hasClass('gg-homepage-var3')) {
					$(".homepage-var3-property-holder, #cbp-bi-homepage-var3 li").css("height", $(window).height() - bodyborder - wpadminbar );
				}

				if($('body').hasClass('gg-homepage-var4')) {
					$(".homepage-var3-property-holder, #cbp-bi-homepage-var3 li").css("height", $(window).height() - bodyborder - wpadminbar );
				}

				if($('body').hasClass('gg-homepage-var5')) {
					var count_element = $('.homepage-var5-property').length;

					$("#homepage-var5-gallery-owl .owl-item, #homepage-var5-prop-owl").css("height", $(window).height() - bodyborder - wpadminbar - footer );
					$("#homepage-var5-prop-owl .owl-item").css("height", 100/count_element + "%" );
				}

				if($('body').hasClass('gg-has-vertical-menu')) {
					$("header.site-header.sidebar").css("height", $(window).height() - wpadminbar );
					$("header.site-header.sidebar").css("margin-top", wpadminbar );
				}

				if($('body').hasClass('single-property_cpt')) {
					$(".single-property-content:not(.gg-sans-overflow), .single-property-gallery:not(.gg-sans-overflow)").css("height", heightNoScrollBarsFooter);
				}
			} else {

				// Get on screen image
				var screenImage = $(".cbp-bislideshow li img");
				
				// Create new offscreen image to test
				var theImage    = new Image();
				theImage.src    = screenImage.attr("src");
				
				// Get accurate measurements from that.
				var oldWidth    = theImage.width;
				var oldHeight   = theImage.height;

				var newHeight 	= $(window).width() / oldWidth * oldHeight;
				//Set the same height of the image on the gallery placeholder
				$(".slideshow-property-gallery, .single-property-gallery").css("height", newHeight );

				
			}

			if ( $(window).width() < 992 ) {
				
				if($('body').hasClass('gg-homepage-var3')) {
					$("header.site-header.sidebar").css("height", "auto" );
					$("header.site-header.sidebar").css("margin-top", "0" );
					// Set the height of the property holder as tall as the screen
					$(".homepage-var3-property-holder").css("height", $(window).height() - $('header.site-header').height() - bodyborder - wpadminbar );
					$("#cbp-bi-homepage-var3 li").css("height", $(window).height() - $('header.site-header').height() - bodyborder - wpadminbar );
				}

				if($('body').hasClass('gg-homepage-var4')) {
					$("header.site-header.sidebar").css("height", "auto" );
					$("header.site-header.sidebar").css("margin-top", "0" );
					// Set the height of the property holder as tall as the screen
					$(".homepage-var3-property-holder").css("height", $(window).height() - $('header.site-header').height() - bodyborder - wpadminbar );

				}

				if($('body').hasClass('gg-homepage-var5')) {
					var count_element = $('.homepage-var5-property').length;

					$("header.site-header.sidebar, .slideshow-property-gallery").css("height", "auto" );
					$("header.site-header.sidebar").css("margin-top", "0" );

					$("#homepage-var5-gallery-owl .owl-item, #homepage-var5-prop-owl").css("height", $(window).height() - $('header.site-header').height() - bodyborder - wpadminbar );
					$("#homepage-var5-prop-owl .owl-item").css("height", 100/count_element + "%" );

				}
			}
	}
	

	$(window).resize(function() {
		sizeContent();
	})
	
	sizeContent();


	//jPlayer - Rezize the contatiner correctly
    if(jQuery().jPlayer && jQuery('.jp-interface').length){
		jQuery('.jp-interface').each(function(){ 
			var playerwidth = jQuery(this).width();	
			var newwidth = playerwidth - 220;
			jQuery(this).find('.jp-progress-container').css({ width: newwidth+'px' });
		});
	}
   
	// here for the submit button of the comment reply form
	$( '#submit, input[type="button"], input[type="reset"], input[type="submit"]' ).addClass( 'btn btn-primary' );	
	
	$( 'table#wp-calendar' ).addClass( 'table table-striped');

	$( 'table' ).not('.variations').addClass( 'table');

	$( 'form' ).not('.variations_form').addClass( 'table');

	$('form').attr('role', 'form');

	var inputs = $('input, textarea')
            .not(':input[type=button], :input[type=submit], :input[type=reset]');

	$(inputs).each(function() {
	    $(this).addClass('form-control');
	});


	// Reservation Form	
    //jQueryUI - Datepicker
    if (jQuery().datepicker) {

        var nowTemp = new Date();
		var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
		
		//Get the WPML class
		var langClass = '';
		var body_wpml_class = $('body').attr("class").match(/calendar-[\w-]*\b/);
		var lang = 'en';

		if (body_wpml_class) {
			langClass = body_wpml_class.toString();
			lang = langClass.slice(-2);
		}
		
		$('#checkin').datepicker({
			startDate: now, 
			language: lang,
			todayHighlight: true,
			autoclose: true
		}).on('changeDate', function(e){
		$('#checkout').datepicker({ 
			autoclose: true,
			language: lang
		}).datepicker('setStartDate', e.date);
			$('#checkout').focus();
		});
		 
		// var checkin = $('#checkin').datepicker({
		//   onRender: function(date) {
		//     return date.valueOf() < now.valueOf() ? 'disabled' : '';
		//   }
		// }).on('changeDate', function(ev) {
		//   if (ev.date.valueOf() > checkout.date.valueOf()) {
		//     var newDate = new Date(ev.date)
		//     newDate.setDate(newDate.getDate() + 1);
		//     checkout.setValue(newDate);
		//   }
		//   checkin.hide();
		//   $('#checkout')[0].focus();
		// }).data('datepicker');
		// var checkout = $('#checkout').datepicker({
		//   onRender: function(date) {
		//     return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
		//   }
		// }).on('changeDate', function(ev) {
		//   checkout.hide();
		// }).data('datepicker');

    }

	//Select - Minimalect
    if(jQuery('select:not(#gg_property_select_form)').length){
		jQuery('select:not(#gg_property_select_form)').each(function(){ 

			var $this             = $(this);
			var attr              = $(this).attr('name');
			var first_option 	  = $("option:first-child");  
			var first_option_name = $(this).find(first_option).text();
			var selectPlaceholder = null;

			//alert(first_option_name);

			//if( attr == 'archive-dropdown') {
				//selectPlaceholder = 'Select Month';
			//} else {
				//selectPlaceholder = null;
			//}

			$this.minimalect({
		        searchable: false,
		        placeholder: first_option_name
		    });

		});
	}

    $(".categories_filter a[data-toggle^='collapse'], .categories_filter a[data-filter^='*']").on('click', function (e) {
		$('.collapse.in').not($(this).data("target")).collapse('hide');
	});
	
	
	function vertical_sidebar_init() {
		if( $('body').hasClass('gg-homepage-var3') || $('body').hasClass('gg-homepage-var4') || $('body').hasClass('gg-homepage-var5') || $('body').hasClass('gg-has-vertical-menu') ) {
			// Hide the footer if browser height is low
			var window_height = $(window).height();

			var logo_height = $('.logo-wrapper').height();

			var menu_locate = $('#main-menu');
			var menu_pos = menu_locate.position();
			var menu_height = menu_locate.height();
			var menu_base = menu_height + menu_pos.top;

			var footer_locate = $('.slideshow-sidebar.slideshow-vertical');
			var footer_height = footer_locate.height();
			var footer_pos = footer_locate.position();
			var footer_top = footer_pos.top;

			var space_remaining = ( window_height - logo_height - menu_base ) - 60 ;

			if (space_remaining < footer_height) {
				$('.slideshow-sidebar.slideshow-vertical').removeClass('slideshow-sidebar-fixed').addClass('slideshow-sidebar-scroll');
			}

			if (space_remaining > footer_height) {
				$('.slideshow-sidebar.slideshow-vertical').addClass('slideshow-sidebar-fixed').removeClass('slideshow-sidebar-scroll');
			}

			$("header.site-header.sidebar").getNiceScroll().resize();
		}
	}

	$(window).resize(function() {
		vertical_sidebar_init();
	});

	//Nice scroll
	if ( $(window).width() > 768 && !$('body').hasClass('luxuryvilla-agent-devices')) {
	    $(".single-property-content:not(.gg-sans-overflow), header.site-header.sidebar").niceScroll({
			cursorwidth:4,
			cursorborder:0,
			cursorcolor:"#f3f3f3",
			cursorborderradius: 0,
			touchbehavior: false,
			autohidemode: "scroll"
		});
	}

	vertical_sidebar_init();

	$('.dropdown').on('shown.bs.dropdown', function () {
	  vertical_sidebar_init();
	})

	$('.dropdown').on('hidden.bs.dropdown', function () {
	  vertical_sidebar_init();
	})

	//Add a mention for pace to know when the dom is ready
	$('body').prepend('<div id="gg-dom-loaded"></div>');

	//Slideshow
	if($('.cbp-bislideshow').length) {
		$('.cbp-bislideshow').each(function() {
			$(this).cbpBGSlideshow();
		});
	}

});

})(jQuery);