(function($) {
	
	"use strict";
	
/* ==========================================================================
   ieViewportFix - fixes viewport problem in IE 10 SnapMode and IE Mobile 10
   ========================================================================== */
   
	function ieViewportFix() {
	
		var msViewportStyle = document.createElement("style");
		
		msViewportStyle.appendChild(
			document.createTextNode(
				"@-ms-viewport { width: device-width; }"
			)
		);

		if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
			
			msViewportStyle.appendChild(
				document.createTextNode(
					"@-ms-viewport { width: auto !important; }"
				)
			);
		}
		
		document.getElementsByTagName("head")[0].
				appendChild(msViewportStyle);

	}

/* ==========================================================================
   exists - Check if an element exists
   ========================================================================== */		
	
	function exists(e) {
		return $(e).length > 0;
	}

/* ==========================================================================
   isTouchDevice - return true if it is a touch device
   ========================================================================== */

	function isTouchDevice() {
		return !!('ontouchstart' in window) || ( !! ('onmsgesturechange' in window) && !! window.navigator.maxTouchPoints);
	}

/* ==========================================================================
   setDimensionsPieCharts
   ========================================================================== */
	
	function setDimensionsPieCharts() {

		$(".pie-chart").each(function() {

			var $t = $(this);
			var n = $t.parent().width();
			var r = $t.attr("data-barSize");
			
			if (n < r) {
				r = n;
			}
			
			$t.css("height", r);
			$t.css("width", r);
			$t.css("line-height", r + "px");
			
			$t.find("i").css({
				"line-height": r + "px",
				"font-size": r / 3
			});
			
		});

	}

/* ==========================================================================
   animatePieCharts
   ========================================================================== */

	function animatePieCharts() {

		if(typeof $.fn.easyPieChart != 'undefined'){

			$(".pie-chart:in-viewport").each(function() {
	
				var $t = $(this);
				var n = $t.parent().width();
				var r = $t.attr("data-barSize");
				
				if (n < r) {
					r = n;
				}
				
				$t.easyPieChart({
					animate: 1300,
					lineCap: "square",
					lineWidth: $t.attr("data-lineWidth"),
					size: r,
					barColor: $t.attr("data-barColor"),
					trackColor: $t.attr("data-trackColor"),
					scaleColor: "transparent",
					onStep: function(from, to, percent) {
						$(this.el).find('.pie-chart-percent span').text(Math.round(percent));
					}
	
				});
				
			});
			
		}

	}

/* ==========================================================================
   animateMilestones
   ========================================================================== */

	function animateMilestones() {

		$(".milestone:in-viewport").each(function() {
			
			var $t = $(this);
			var	n = $t.find(".milestone-value").attr("data-stop");
			var	r = parseInt($t.find(".milestone-value").attr("data-speed"));
				
			if (!$t.hasClass("already-animated")) {
				$t.addClass("already-animated");
				$({
					countNum: $t.find(".milestone-value").text()
				}).animate({
					countNum: n
				}, {
					duration: r,
					easing: "linear",
					step: function() {
						$t.find(".milestone-value").text(Math.floor(this.countNum));
					},
					complete: function() {
						$t.find(".milestone-value").text(this.countNum);
					}
				});
			}
			
		});

	}

/* ==========================================================================
   animateProgressBars
   ========================================================================== */

	function animateProgressBars() {

		$(".progress-bar .progress-bar-outer:in-viewport").each(function() {
			
			var $t = $(this);
			
			if (!$t.hasClass("already-animated")) {
				$t.addClass("already-animated");
				$t.animate({
					width: $t.attr("data-width") + "%"
				}, 2000);
			}
			
		});

	}

/* ==========================================================================
   enableParallax
   ========================================================================== */

	function enableParallax() {

		if(typeof $.fn.parallax != 'undefined'){
			
			$('.parallax').each(function() {
	
				var $t = $(this);
				$t.addClass("parallax-enabled");
				$t.parallax("49%", 0.3, false);
	
			});
			
		}

	}

/* ==========================================================================
   handleMobileMenu 
   ========================================================================== */		

	var MOBILEBREAKPOINT = 979;

	function handleMobileMenu() {

		if ($(window).width() > MOBILEBREAKPOINT) {
			
			$("#mobile-menu").hide();
			$("#mobile-menu-trigger").removeClass("mobile-menu-opened").addClass("mobile-menu-closed");
		
		} else {
			
			if (!exists("#mobile-menu")) {
				
				$("#menu").clone().attr({
					id: "mobile-menu",
					"class": "fixed"
				}).insertAfter("#header");
				
				$("#mobile-menu > li > a, #mobile-menu > li > ul > li > a").each(function() {
					var $t = $(this);
					if ($t.next().hasClass('sub-menu') || $t.next().is('ul') || $t.next().is('.sf-mega')) {
						$t.append('<span class="fa fa-angle-down mobile-menu-submenu-arrow mobile-menu-submenu-closed"></span>');
					}
				});
			
				$(".mobile-menu-submenu-arrow").click(function(event) {
					var $t = $(this);
					if ($t.hasClass("mobile-menu-submenu-closed")) {
						$t.parent().siblings("ul").slideDown(300);
						$t.parent().siblings(".sf-mega").slideDown(300);
						$t.removeClass("mobile-menu-submenu-closed fa-angle-down").addClass("mobile-menu-submenu-opened fa-angle-up");
					} else {
						$t.parent().siblings("ul").slideUp(300);
						$t.parent().siblings(".sf-mega").slideUp(300);
						$t.removeClass("mobile-menu-submenu-opened fa-angle-up").addClass("mobile-menu-submenu-closed fa-angle-down");
					}
					event.preventDefault();
				});
				
				$("#mobile-menu li, #mobile-menu li a, #mobile-menu ul").attr("style", "");
				
			}
			
		}

	}

/* ==========================================================================
   showHideMobileMenu
   ========================================================================== */

	function showHideMobileMenu() {
		
		$("#mobile-menu-trigger").click(function(event) {
			
			var $t = $(this);
			var $n = $("#mobile-menu");
			
			if ($t.hasClass("mobile-menu-opened")) {
				$t.removeClass("mobile-menu-opened").addClass("mobile-menu-closed");
				$n.slideUp(300);
			} else {
				$t.removeClass("mobile-menu-closed").addClass("mobile-menu-opened");
				$n.slideDown(300);
			}
			event.preventDefault();
			
		});
		
	}

/* ==========================================================================
   handleBackToTop
   ========================================================================== */
   
   function handleBackToTop() {
	   
		$('#back-to-top').click(function(){
			$('html, body').animate({scrollTop:0}, 'slow');
			return false;
		});
   
   }
   	
/* ==========================================================================
   showHidebackToTop
   ========================================================================== */	
	
	function showHidebackToTop() {
	
		if ($(window).scrollTop() > $(window).height() / 2 ) {
			$("#back-to-top").removeClass('gone');
			$("#back-to-top").addClass('visible');
		} else {
			$("#back-to-top").removeClass('visible');
			$("#back-to-top").addClass('gone');
		}
	
	}

/* ==========================================================================
   handleVideoBackground
   ========================================================================== */
   
	var min_w = 0; 					
	var video_width_original = 1920;
	var video_height_original = 1080;
	var vid_ratio = 1920/1080;
   
	function handleVideoBackground() {
	   
		$('.fullwidth-section .fullwidth-section-video').each(function(i){

			var $sectionWidth = $(this).closest('.fullwidth-section').outerWidth();
			var $sectionHeight = $(this).closest('.fullwidth-section').outerHeight();
			
			$(this).width($sectionWidth);
			$(this).height($sectionHeight);

			// calculate scale ratio
			var scale_h = $sectionWidth / video_width_original;
			var scale_v = $sectionHeight / video_height_original; 
			var scale = scale_h > scale_v ? scale_h : scale_v;

			// limit minimum width
			min_w = vid_ratio * ($sectionHeight+20);
			
			if (scale * video_width_original < min_w) {scale = min_w / video_width_original;}
					
			$(this).find('video').width(Math.ceil(scale * video_width_original +2));
			$(this).find('video').height(Math.ceil(scale * video_height_original +2));
			
		});

	}

/* ==========================================================================
   handleSearch
   ========================================================================== */
   
	function handleSearch() {
	
		var inputWidth = '240px',
			inputWidthReturn = '34px';
			
		$('#custom-search-form #s').focus(function () {
			//clear the text in the box.
			$(this).val(function () {
				$(this).addClass('open').attr('placeholder', 'type and press enter...');
			}),
			//animate the box
			$(this).animate({
				width: inputWidth
			}, "fast");
		});
		$('#custom-search-form #s').blur(function () {
			$(this).removeClass('open').animate({
				width: inputWidthReturn
			}, "fast");
			$(this).attr('placeholder', '').val('');
		});
		 
	 }

/* ==========================================================================
   handleShowMap
   ========================================================================== */
	 
	  function handleShowMap() {
	   
	   $('#show-contact').hide();
	   
	   $('#show-map').click(function(event){
		   event.preventDefault();
		   $('.map-content-wrapper').fadeOut(300);
		   $('#show-map').fadeOut(300);
		   $('#show-contact').fadeIn(300);
	   });
	   
	   $('#show-contact').click(function(event){
		   event.preventDefault();
		   $('.map-content-wrapper').fadeIn(300);
		   $('#show-contact').fadeOut(300);
		   $('#show-map').fadeIn(300);
	   });
	   
   }
   	
	
/* ==========================================================================
   When document is ready, do
   ========================================================================== */
   
	$(document).ready(function() {			   
		
		ieViewportFix();
		
		setDimensionsPieCharts();
		
		animatePieCharts();
		animateMilestones();
		animateProgressBars();

		if (!isTouchDevice()) {
			enableParallax();
		}
		
		handleMobileMenu();
		showHideMobileMenu();
		
		handleBackToTop();
		showHidebackToTop();
		
		handleVideoBackground();
		
		handleSearch();
		handleShowMap();
		
	});

/* ==========================================================================
   When the window is scrolled, do
   ========================================================================== */
   
	$(window).scroll(function() {				   
		
		animateMilestones();
		animatePieCharts();
		animateProgressBars();
		
		showHidebackToTop();

	});

/* ==========================================================================
     Portfolio
     ========================================================================== */

    $('.portfolio-item-description').each(function(index, element){
        $(element).css('top', (90 - ( $(element).find('.portfolio-title').height() / $(element).parent('.portfolio-item:first').height() * 100)).toString() + '%' );

        $(element).parent().mouseenter(function(){
            $(element).css('top', (75 - (($(element).find('.text-highlight').height() + $(element).find('.portfolio-title').height()) / $(element).parent('.portfolio-item:first').height() * 100)).toString() + '%' );
        }).mouseleave(function(){
            $(element).css('top', (90 - ( $(element).find('.portfolio-title').height() / $(element).parent('.portfolio-item:first').height() * 100)).toString() + '%' );
        });
    });




/* ==========================================================================
   When the window is resized, do
   ========================================================================== */
   
	$(window).resize(function() {
		
		handleMobileMenu();
		handleVideoBackground();
		
	});

    var styles = [
        {
            "stylers": [
                {"saturation": -75},
                {"hue": "#004a60"}
            ]
        }

    ];
    var options = {
        scrollwheel: false,
        mapTypeControlOptions: {
            mapTypeIds: ['Styled']
        },
        center: new google.maps.LatLng(-22.947388999999998, -43.18808119999999),
        zoom: 16,
        disableDefaultUI: false,
        mapTypeId: 'Styled'
    };
    var div = document.getElementById('map');
    var map = new google.maps.Map(div, options);

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(-22.947388999999998, -43.18808119999999),
        map: map
    });

    marker.setIcon('http://loading.olabi.co/wp-content/themes/pearl-wp/layout/images/olabi-pin.png');

    var contentString = '<span style="color:black;">Barão de Lucena, 85A - Botafogo</span>';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
    });

    infowindow.open(map,marker);

    var styledMapType = new google.maps.StyledMapType(styles, {name: 'Styled'});
    map.mapTypes.set('Styled', styledMapType);




/* ==========================================================================
   Home – lista de eventos
   ========================================================================== */

	$('.eventos-lista .evento-container').eq(0).children('.evento-item').addClass('hover');
	$('.eventos-lista .evento-image').eq(0).show();
	$('.eventos-lista .evento-item').hover(function() {
   		$(this).addClass('hover');
   		$(this).parent().siblings().children('.evento-item').removeClass('hover');
   		$(this).parent().children('.evento.image').hide();
   		$(this).parent().children('.evento-image').show();
   		$(this).parent().siblings().children('.evento-image').hide();
	})

	$('.evento-container').click(function() {
		window.location = $(this).data('link');
	})


})(window.jQuery);

// non jQuery scripts below