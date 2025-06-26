(function ($) {

    "use strict";

    // progress bar script starts
    function animatedProgressbar(id, type, value, strokeColor, trailColor, strokeWidth, strokeTrailWidth) {
        var triggerClass = '.fbth-progress-bar-' + id;
        if ('function' === typeof ldBar) {
            if ('line' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M0 10L100 10',
                    'aspect-ratio': 'none',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
            }
            if ('line-bubble' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M0 10L100 10',
                    'aspect-ratio': 'none',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
                $($('.fbth-progress-bar-' + id).find('.ldBar-label')).animate({
                    left: value + '%'
                }, 1000, 'swing');
            }
            if ('circle' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M50 10A40 40 0 0 1 50 90A40 40 0 0 1 50 10',
                    'stroke-dir': 'normal',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
            }
            if ('fan' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M10 90A40 40 0 0 1 90 90',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
            }
        }
    }

    var FBTHProgressBar = function ($scope, $) {
        var progressBarWrapper = $scope.find('[data-progress-bar]').eq(0);
        if ($.isFunction($.fn.waypoint)) {
            progressBarWrapper.waypoint(function () {
                var element = $(this.element),
                    id = element.data('id'),
                    type = element.data('type'),
                    value = element.data('progress-bar-value'),
                    strokeWidth = element.data('progress-bar-stroke-width'),
                    strokeTrailWidth = element.data('progress-bar-stroke-trail-width'),
                    color = element.data('stroke-color'),
                    trailColor = element.data('stroke-trail-color');
                animatedProgressbar(id, type, value, color, trailColor, strokeWidth, strokeTrailWidth);
                this.destroy();
            }, {
                offset: 'bottom-in-view'
            });
        }
    }
    // progress bar script ends


    // animated text script starts
    var FBTHAnimatedText = function ($scope, $) {

        var animatedWrapper = $scope.find('.fbth-typed-strings').eq(0),
            animateSelector = animatedWrapper.find('.fbth-animated-text-animated-heading'),
            animationType = animatedWrapper.data('heading_animation'),
            animationStyle = animatedWrapper.data('animation_style'),
            animationSpeed = animatedWrapper.data('animation_speed'),
            typeSpeed = animatedWrapper.data('type_speed'),
            startDelay = animatedWrapper.data('start_delay'),
            backTypeSpeed = animatedWrapper.data('back_type_speed'),
            backDelay = animatedWrapper.data('back_delay'),
            loop = animatedWrapper.data('loop') ? true : false,
            showCursor = animatedWrapper.data('show_cursor') ? true : false,
            fadeOut = animatedWrapper.data('fade_out') ? true : false,
            smartBackspace = animatedWrapper.data('smart_backspace') ? true : false,
            id = animateSelector.attr('id');

        if ('function' === typeof Typed) {
            if ('fbth-typed-animation' === animationType) {
                var typed = new Typed('#' + id, {
                    strings: animatedWrapper.data('type_string'),
                    loop: loop,
                    typeSpeed: typeSpeed,
                    backSpeed: backTypeSpeed,
                    showCursor: showCursor,
                    fadeOut: fadeOut,
                    smartBackspace: smartBackspace,
                    startDelay: startDelay,
                    backDelay: backDelay
                });
            }
        }


        if ($.isFunction($.fn.Morphext)) {
            if ('fbth-morphed-animation' === animationType) {
                $(animateSelector).Morphext({
                    animation: animationStyle,
                    speed: animationSpeed
                });
            }
        }
    }
    // animated text script ends

    var fbth_modal_popup = function ($scope, $) {

        $('.popup-menubar').on('click', function () {
            $('.fbth-addons-popup-content').addClass('show')
        })

        $('#offset-menu-close-btn').on('click', function () {
            $('.fbth-addons-popup-content').removeClass('show')
        });
    }

    /*---------------------------------------------------
                    video popup BUTTON
    ----------------------------------------------------*/
    var Fbth_Modal_Popup = function ($scope, $) {

        var modalWrapper = $scope.find('.fbth-modal').eq(0),
            modalOverlayWrapper = $scope.find('.fbth-modal-overlay'),
            modalItem = $scope.find('.fbth-modal-item'),
            modalAction = modalWrapper.find('.fbth-modal-image-action'),
            closeButton = modalWrapper.find('.fbth-close-btn');

        modalAction.on('click', function (e) {
            e.preventDefault();
            var modalOverlay = $(this).parents().eq(1).next();
            var modal = $(this).data('fbth-modal');

            var overlay = $(this).data('fbth-overlay');
            modalItem.css('display', 'block');
            setTimeout(function () {
                $(modal).addClass('active');
            }, 100);
            if ('yes' === overlay) {
                modalOverlay.addClass('active');
            }

        });

        closeButton.click(function () {
            var modalOverlay = $(this).parents().eq(3).next();
            var modalItem = $(this).parents().eq(2);
            modalOverlay.removeClass('active');
            modalItem.removeClass('active');

            var modal_iframe = modalWrapper.find('iframe'),
                $modal_video_tag = modalWrapper.find('video');

            if (modal_iframe.length) {
                var modal_src = modal_iframe.attr('src').replace('&autoplay=1', '');
                modal_iframe.attr('src', '');
                modal_iframe.attr('src', modal_src);
            }
            if ($modal_video_tag.length) {
                $modal_video_tag[0].pause();
                $modal_video_tag[0].currentTime = 0;
            }

        });

        modalOverlayWrapper.click(function () {
            var overlay_click_close = $(this).data('fbth_overlay_click_close');
            if ('yes' === overlay_click_close) {
                $(this).removeClass('active');
                $('.fbth-modal-item').removeClass('active');

                var modal_iframe = modalWrapper.find('iframe'),
                    $modal_video_tag = modalWrapper.find('video');

                if (modal_iframe.length) {
                    var modal_src = modal_iframe.attr('src').replace('&autoplay=1', '');
                    modal_iframe.attr('src', '');
                    modal_iframe.attr('src', modal_src);
                }
                if ($modal_video_tag.length) {
                    $modal_video_tag[0].pause();
                    $modal_video_tag[0].currentTime = 0;
                }
            }
        });
    }


    //Creative Button
    var FBTH_Creative_Button = function ($scope) {

        var btn_wrap = $scope.find('.fbth-creative-btn-wrap');
        var magnetic = btn_wrap.data('magnetic');
        var btn = btn_wrap.find('a.fbth-creative-btn');
        if ('yes' == magnetic) {
            btn_wrap.on('mousemove', function (e) {
                var x = e.pageX - (btn_wrap.offset().left + (btn_wrap.outerWidth() / 2));
                var y = e.pageY - (btn_wrap.offset().top + (btn_wrap.outerHeight() / 2));
                btn.css("transform", "translate(" + x * 0.3 + "px, " + y * 0.5 + "px)");
            });
            btn_wrap.on('mouseout', function (e) {
                btn.css("transform", "translate(0px, 0px)");
            });
        }
        //For expandable button style only
        var expandable = $scope.find('.fbth-eft--expandable');
        var text = expandable.find('.text');
        if (expandable.length > 0 && text.length > 0) {
            text[0].addEventListener("transitionend", function () {
                if (text[0].style.width) {
                    text[0].style.width = "auto";
                }
            });
            expandable[0].addEventListener("mouseenter", function (e) {
                e.currentTarget.classList.add('hover');
                text[0].style.width = "auto";
                var predicted_answer = text[0].offsetWidth;
                text[0].style.width = "0";
                window.getComputedStyle(text[0]).transform;
                text[0].style.width = "".concat(predicted_answer, "px");

            });
            expandable[0].addEventListener("mouseleave", function (e) {
                e.currentTarget.classList.remove('hover');
                text[0].style.width = "".concat(text[0].offsetWidth, "px");
                window.getComputedStyle(text[0]).transform;
                text[0].style.width = "";
            });
        }
    };

    // accordion script starts
    var fbthAccordion = function ($scope, $) {
        var accordionTitle = $scope.find('.fbth-accordion-title');

        var accmin = $scope.find('.fbth-accordion-single-item');

        accmin.each(function () {
            if ($(this).hasClass('yes')) {
                $(this).addClass('wraper-active');
            }
        });

        accordionTitle.each(function () {
            if ($(this).hasClass('active-default')) {
                $(this).addClass('active');
                $(this).next('.fbth-accordion-content').slideDown(300);
            }
        });

        // Remove multiple click event for nested accordion
        accordionTitle.unbind('click');

        //$accordionWrapper.children('.fbth-accordion-content').first().show();
        accordionTitle.click(function (e) {
            e.preventDefault();

            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).next().slideUp(400);
                $(this).parent().removeClass('wraper-active');

            } else {
                $(this).parent().parent().find('.fbth-accordion-title').removeClass('active');

                accmin.removeClass('wraper-active');

                $(this).parent('.yes').removeClass('wraper-active');

                $(this).parent().parent().find('.fbth-accordion-content').slideUp(300);

                $(this).parent().addClass('wraper-active');

                $(this).toggleClass('active');
                $(this).next().slideToggle(400);

            }
        });
    }
    // accordion script ends

    // animated text script starts
    var fbth_AnimatedText = function ($scope, $) {
        var animatedWrapper = $scope.find('.fbth-typed-strings').eq(0),
            animateSelector = animatedWrapper.find('.fbth-animated-text-animated-heading'),
            animationType = animatedWrapper.data('heading_animation'),
            animationStyle = animatedWrapper.data('animation_style'),
            animationSpeed = animatedWrapper.data('animation_speed'),
            typeSpeed = animatedWrapper.data('type_speed'),
            startDelay = animatedWrapper.data('start_delay'),
            backTypeSpeed = animatedWrapper.data('back_type_speed'),
            backDelay = animatedWrapper.data('back_delay'),
            loop = animatedWrapper.data('loop') ? true : false,
            showCursor = animatedWrapper.data('show_cursor') ? true : false,
            fadeOut = animatedWrapper.data('fade_out') ? true : false,
            smartBackspace = animatedWrapper.data('smart_backspace') ? true : false,
            id = animateSelector.attr('id');
        if ('function' === typeof Typed) {
            if ('fbth-typed-animation' === animationType) {
                var typed = new Typed('#' + id, {
                    strings: animatedWrapper.data('type_string'),
                    loop: loop,
                    typeSpeed: typeSpeed,
                    backSpeed: backTypeSpeed,
                    showCursor: showCursor,
                    fadeOut: fadeOut,
                    smartBackspace: smartBackspace,
                    startDelay: startDelay,
                    backDelay: backDelay
                });
            }
        }
        if ($.isFunction($.fn.Morphext)) {
            if ('fbth-morphed-animation' === animationType) {
                $(animateSelector).Morphext({
                    animation: animationStyle,
                    speed: animationSpeed
                });
            }
        }
    }
    /* Search widget js */
    var FBTH_Search_bos = function () {
        $('#search_icon').click(function () {
            $('.fbth-search-button-wrapper').show("slow");
            $('.fbth-search-overly').addClass('search-body-bg');
            $('.search-main-wrapper').addClass('cross-menu');
        });

        $('#cross_icon').click(function () {
            $('.fbth-search-button-wrapper').hide("slow");
            $('.fbth-search-overly').removeClass('search-body-bg');
            $('.search-main-wrapper').removeClass('cross-menu');
        });
    }

    var FBTH_Advance_Slide_Js = function ($scope, $) {
        var wrapper = $scope.find(".fbth--slide-content-wrap");
        if (wrapper.length === 0)
            return;
        var settings = wrapper.data('settings');
        wrapper.slick({
            infinite: true,
            speed: 900,
            slidesToShow: settings['per_coulmn'],
            slidesToScroll: 1,
            autoplay: settings['autoplay'],
            autoplaySpeed: settings['autoplaytimeout'],
            arrows: settings['nav'],
            draggable: settings['mousedrag'],
            dots: settings['dots'],
            lazyLoad: 'ondemand',
            dotsClass: "fbth-testimonial-slider-dot-list",
            swipe: true,
            vertical: settings['show_vertical'],
            appendArrows: '.team-slider-arrow',
            prevArrow: $('.prev'),
            nextArrow: $('.next'),
            responsive: [{
                breakpoint: 1600,
                settings: {
                    slidesToShow: settings['per_coulmn'],
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: settings['per_coulmn_tablet'],
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: settings['per_coulmn_mobile'],
                    slidesToScroll: 1,
                    vertical: false,
                },
            },
            ],
        });
    }

    var fbth_Testimonial_Js = function ($insurancepe, $) {
        var wrapper = $insurancepe.find(".fbth-testimonial-slider");
        if (wrapper.length === 0)
            return;
        var settings = wrapper.data('settings');
        wrapper.slick({
            infinite: true,
            speed: 900,
            slidesToShow: settings['per_coulmn'],
            slidesToScroll: 1,
            autoplay: settings['autoplay'],
            autoplaySpeed: settings['autoplaytimeout'],
            arrows: settings['nav'],
            draggable: settings['mousedrag'],
            dots: settings['dots'],
            lazyLoad: 'ondemand',
            dotsClass: "fbth-testimonial-slider-dot-list",
            swipe: true,
            vertical: settings['show_vertical'],
            appendArrows: '.team-slider-arrow',
            prevArrow: $('.prev'),
            nextArrow: $('.next'),
            responsive: [{
                breakpoint: 1600,
                settings: {
                    slidesToShow: settings['per_coulmn'],
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: settings['per_coulmn_tablet'],
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: settings['per_coulmn_mobile'],
                    slidesToScroll: 1,
                    vertical: false,
                },
            },
            ],
        });
    }

    var FBTH_Brand_Slider_Js = function ($scope, $) {
        var wrapper = $scope.find(".fbth-brand-carousel-wrap");
        if (wrapper.length === 0)
            return;
        var settings = wrapper.data('settings');
        wrapper.slick({
            infinite: true,
            slidesToShow: settings['per_coulmn'],
            slidesToScroll: 1,
            autoplay: settings['autoplay'],
            autoplaySpeed: settings['autoplaytimeout'],
            arrows: settings['nav'],
            draggable: settings['mousedrag'],
            dots: settings['dots'],
            lazyLoad: 'ondemand',
            centerMode: settings['center'],
            dotsClass: "brand-slick-slide-dot-list",
            swipe: true,
            appendArrows: '.brand-slider-arrow',
            prevArrow: $('.prev'),
            nextArrow: $('.next'),
            responsive: [{
                breakpoint: 1600,
                settings: {
                    slidesToShow: settings['per_coulmn'],
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: settings['per_coulmn_tablet'],
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: settings['per_coulmn_mobile'],
                    slidesToScroll: 1,
                    vertical: false,
                },
            },
            ],
        });
    }

    // price table
    var FBTH_Pricing_Table = function($scope, $) {
        $scope.find("[data-pricing-trigger]").on("click", function (e) {
            $scope.find(e.target).toggleClass("active");
            var target = $scope.find(e.target).attr("data-target");
            if ($scope.find(target).attr("data-value-active") == "monthly") {
                $scope.find(target).attr("data-value-active", "yearly");
            } else {
                $scope.find(target).attr("data-value-active", "monthly");
            }
        })
        // Classic tab switcher
        $scope.find("[data-pricing-tab-trigger]").on("click", function (e) {
            $scope.find('[data-pricing-tab-trigger]').removeClass("active");
            $scope.find(this).addClass("active");
            var target = $scope.find(e.target).attr("data-target");
            if ($scope.find(target).attr("data-value-active") == "monthly") {
                $scope.find(target).attr("data-value-active", "yearly");
            } else {
                $scope.find(target).attr("data-value-active", "monthly");
            }
        })
    }

    // Testimonial
    var FBTH_Testimonial = function ($scope, $) {

        if ($.fn.isotope) {
            var gridMas = $('.tm-masonary');

            gridMas.isotope({
                itemSelector: '.fbth-addons-post-widget-wrap',
                percentPosition: true,
                layoutMode: 'packery',
            }).resize();

            gridMas.imagesLoaded().progress(function () {
                gridMas.isotope()
            });
        }
    }

    /*
    *
    This code use Tab Widget
    *
    */
    var fbthTab = function ($scope, $) {
        $scope.find('ul.tabs li').on('click', function () {
            var tab_id = $(this).attr('data-tab');
            $scope.find('ul.tabs li').removeClass('current');
            $scope.find('.fbth-tabs-content-single').removeClass('current');
            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        })
        var modalWrapper = $scope.find('.fbth-tab'),
            modalOverlayWrapper = $scope.find('.fbth-tab-overlay'),
            modalItem = $scope.find('.fbth-tab-item'),
            modalAction = modalWrapper.find('.fbth-tab-image-action'),
            closeButton = modalWrapper.find('.fbth-close-btn');
            console.log(modalAction);
        modalAction.on('click', function (e) {
            e.preventDefault();
            var modalOverlay = $(this).parents().eq(1).next();
            var modal = $(this).data('fbth-tab');
            var overlay = $(this).data('fbth-overlay');
            modalItem.css('display', 'block');
            setTimeout(function () {
                $(modal).addClass('active');
            }, 100);
            if ('yes' === overlay) {
                modalOverlay.addClass('active');
            }

        });

        closeButton.click(function () {
            var modalOverlay = $(this).parents().eq(3).next();
            var modalItem = $(this).parents().eq(2);
            modalOverlay.removeClass('active');
            modalItem.removeClass('active');

            var modal_iframe = modalWrapper.find('iframe'),
                $modal_video_tag = modalWrapper.find('video');

            if (modal_iframe.length) {
                var modal_src = modal_iframe.attr('src').replace('&autoplay=1', '');
                modal_iframe.attr('src', '');
                modal_iframe.attr('src', modal_src);
            }
            if ($modal_video_tag.length) {
                $modal_video_tag[0].pause();
                $modal_video_tag[0].currentTime = 0;
            }

        });

        modalOverlayWrapper.click(function () {
            var overlay_click_close = $(this).data('fbth_overlay_click_close');
            if ('yes' === overlay_click_close) {
                $(this).removeClass('active');
                $('.fbth-tab-item').removeClass('active');

                var modal_iframe = modalWrapper.find('iframe'),
                    $modal_video_tag = modalWrapper.find('video');

                if (modal_iframe.length) {
                    var modal_src = modal_iframe.attr('src').replace('&autoplay=1', '');
                    modal_iframe.attr('src', '');
                    modal_iframe.attr('src', modal_src);
                }
                if ($modal_video_tag.length) {
                    $modal_video_tag[0].pause();
                    $modal_video_tag[0].currentTime = 0;
                }
            }
        });
    };
    var fbth_Adv_Tab = function ($insurancepe, $) {
        $insurancepe.find('ul.tabs li').on('click', function() {
            var tab_id = $(this).attr('data-tab');
            var $tab = $(this);
        
            if (!$tab.hasClass('current')) {
                $insurancepe.find('ul.tabs li').removeClass('current');
                $insurancepe.find('.fbth-tab-content-single').removeClass('current');
                $tab.addClass('current');
                $insurancepe.find("#" + tab_id).addClass('current');
            }
        })
        if ($.fn.magnificPopup) {
            $('.fbth-elm-edit').magnificPopup({
                type: 'iframe',
                mainClass: 'mfp-fade fbth-elm-edit-popup',
                callbacks: {
                    open: function () {
                        // Will fire when this exact popup is opened
                        // this - is Magnific Popup object
                    },
                    close: function () {
                        location.reload();
                    }
                    // e.t.c.
                }
            });
            
        }
    };

    var VideoGalleryHandler = function ($scope, $) {
        if ( 'undefined' == typeof $scope ) {
			return;
		}

		var selector = $scope.find( '.fbth-video-gallery-wrap' );
		var layout = selector.data( 'layout' );
		var action = selector.data( 'action' );

		if ( selector.length < 1 ) {
			return;
		}

		if ( 'lightbox' == action ) {
			$scope.find( '.fbth-vg__play_full' ).fancybox();
		} else if ( 'inline' == action ) {
			$scope.find( '.fbth-vg__play_full' ).on( 'click', function( e ) {
				e.preventDefault();
				var iframe 		= $( "<iframe/>" );
				var $this 		= $( this );
				var vurl 		= $this.data( 'url' );
				var overlay		= $this.closest( '.fbth-video-gallery-item' ).find( '.fbth-vg__overlay' );
				var wrap_outer = $this.closest( '.fbth-video__gallery-iframe' );

				iframe.attr( 'src', vurl );
				iframe.attr( 'frameborder', '0' );
				iframe.attr( 'allowfullscreen', '1' );
				iframe.attr( 'allow', 'autoplay;encrypted-media;' );

				wrap_outer.html( iframe );
				wrap_outer.attr( 'style', 'background:#000;' );
				overlay.hide();

			} );
		}

		// If Carousel is the layout.

    };

// Vertical Masonary Testimonial.

    var  Fbth_MarqueTestimonial_Js = function ($fbth, $) {
        if ($.fn.isotope) {

          var $gridMas = $('.vertical-testimonial-wrapper.layout-mode-masonry');
          var $grid = $('.vertical-testimonial-wrapper.layout-mode-normal');
          $('.vertical-testimonial-wrapper.layout-mode-masonry').masonry().resize()
          $grid.isotope({
            itemSelector: '.fbth-testimonial-item-wrap',
            percentPosition: true,
            layoutMode: 'fitRows',
          }).resize()

          $grid.imagesLoaded().progress(function () {
            $grid.isotope('layout')
          }).resize();

          $gridMas.isotope({
            itemSelector: '.fbth-testimonial-item-wrap',
            percentPosition: true,
            layoutMode: 'packery',
          })

          $gridMas.imagesLoaded().progress(function () {
            $gridMas.isotope('layout')
          });

          $grid.isotope().resize();
          $gridMas.isotope().resize();

          $(".pf-isotope-nav li").on('click', function () {
            $(".pf-isotope-nav li").removeClass("active");
            $(this).addClass("active");

            var selector = $(this).attr("data-filter");
            $gridMas.isotope({
              filter: selector,
              animationOptions: {
                duration: 750,
                easing: "linear",
                queue: false,
              }
            });

            var selector = $(this).attr("data-filter");
            $grid.isotope({
              filter: selector,
              animationOptions: {
                duration: 750,
                easing: "linear",
                queue: false,
              }
            });


          });

        }

      }


// slider

var sliderJS = function ($scope, $) {

    var slider_settings =  $scope.find('.fbth-slider-wrap').data().sliderSetting;
        console.log(slider_settings.autoplaytimeouts);
      $('.fbth-slider').owlCarousel({
          loop: slider_settings.slider_loop,
          autoplay:slider_settings.autoplay,
          autoplayTimeout:slider_settings.autoplaytimeouts,
          mouseDrag:slider_settings.mousedrag,
          margin: 0,
          dots: slider_settings.active_dots,
          nav: slider_settings.active_nav,
          navText: [slider_settings.prev_icon,slider_settings.next_icon],
          animateOut: 'fadeOut',
          responsive: {
              0: {
                  items: 1
              },
              600: {
                  items: 1
              },
              1000: {
                  items: 1
              }
          }
      });

  }

  /**
   * ticker slider
   */
  var ticker_slider_items = function( $scope, $) {
      var ticker_slider_item = $scope.find('.ticker-item-slider');

       if (ticker_slider_item.length === 0)
           return;
       var settings = ticker_slider_item.data('settings');
      
    ticker_slider_item.slick({
        dots: false,
		arrows: false,
		infinite: true,
		speed: settings['autoplaytimeout'],
		slidesToShow:settings['per_coulmn'],
        autoplaySpeed:0,
        autoplay: true,
        cssEase: 'linear',
        slidesToScroll: 1,
        centerMode: true,
        pauseOnHover: settings['pauseonhover'],
        adaptiveHeight: true,
        rtl: settings['showrtl'],
        vertical: settings['vertical'],
        lazyLoad: 'ondemand',
         responsive: [{
                breakpoint: 1600,
                settings: {
                    slidesToShow: settings['per_coulmn'],
                    slidesToScroll: 1,
                    centerMode:false
                },
            },
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: settings['per_coulmn_tablet'],
                    slidesToScroll: 1,
                    centerMode: false,
                    vertical:false
                },
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: settings['per_coulmn_mobile'],
                    slidesToScroll: 1,
                    vertical: false,
                    centerMode:false
                },
            },
        ],
    })
  }
    
    
/**
 * 
 * ticker-tm-slider
 * 
 */
  var ticker_tm_slider = function( $scope, $) {
      var ticker_tm_slider = $scope.find('.ticker-tm-slider');

       if (ticker_tm_slider.length === 0)
           return;
       var settings = ticker_tm_slider.data('settings');
      
    ticker_tm_slider.slick({
        dots: false,
		arrows: false,
		infinite: true,
		speed: settings['autoplaytimeout'],
		slidesToShow:settings['per_coulmn'],
        autoplaySpeed:0,
        autoplay: true,
        cssEase: 'linear',
        slidesToScroll: 1,
        centerMode:true,
        pauseOnHover: settings['pauseonhover'],
        adaptiveHeight: true,
        rtl: settings['showrtl'],
        vertical: settings['vertical'],
        lazyLoad: 'ondemand',
         responsive: [{
                breakpoint: 1600,
                settings: {
                    slidesToShow: settings['per_coulmn'],
                    slidesToScroll: 1,
                    centerMode:false
                },
            },
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: settings['per_coulmn_tablet'],
                    slidesToScroll: 1,
                    centerMode: false,
                    vertical:false
                },
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: settings['per_coulmn_mobile'],
                    slidesToScroll: 1,
                    vertical: false,
                    centerMode:false
                },
            },
        ],
    })
  }


  // Blog masonry
  
  var FBTH_addons_blog = function ($scope) {
    if ($.fn.isotope) {

        var $gridMas = $('.fbth-blog-wraper>.masonry');
        var $grid = $('.fbth-blog-wraper>.masonry');
        $grid.isotope().resize();
        $('.fbth-blog-wraper>.masonry').masonry().resize()
        $grid.isotope({
          itemSelector: '.fbth-blog-wraper>.masonry',
          percentPosition: true,
          layoutMode: 'fitRows',
        }).resize()

        $grid.imagesLoaded().progress(function () {
          $grid.isotope('layout')
        }).resize();

        $gridMas.isotope({
          itemSelector: '.fbth-blog-wraper>.masonry',
          percentPosition: true,
          layoutMode: 'packery',
        })

        $gridMas.imagesLoaded().progress(function () {
          $gridMas.isotope('layout')
        });

        $grid.isotope().resize();
        $gridMas.isotope().resize();

      }

}



var Blog_slider_Js = function ($scope) {
    var wrapper = $scope.find(".blog-slider");
    var id = $scope.data('id');
    // console.log(id);
    if (wrapper.length === 0)
        return;
    var settings = wrapper.data('settings');
    wrapper.slick({
        infinite: true,
        speed: 900,
        slidesToShow: settings['per_coulmn'],
        slidesToScroll: 1,
        autoplay: settings['autoplay'],
        autoplaySpeed: settings['autoplaytimeout'],
        arrows: true,
        draggable: settings['mousedrag'],
        dots: settings['dots'],
        centerPadding: '0',
        lazyLoad: 'ondemand',
        centerMode: settings['show_center_mode'],
        dotsClass: "blog-slider-dot-list",
        swipe: false,
        vertical: settings['show_vertical'],
        prevArrow: $('.prev-' + id),
        nextArrow: $('.next-' + id),
        responsive: [{
            breakpoint: 1600,
            settings: {
                slidesToShow: settings['per_coulmn'],
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 1025,
            settings: {
                slidesToShow: settings['per_coulmn_tablet'],
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: settings['per_coulmn_mobile'],
                slidesToScroll: 1,
                arrows: false,
                vertical: false,
            },
        },
        ],
    });
}


 // Main Menu
 var navMenu = function ($scope, $) {
    $('.fbth-mega-menu').closest('.elementor-container').addClass('megamenu-full-container');
    var count = 0;
    $(".main-navigation ul.navbar-nav>li.fbth-mega-menu>.sub-menu>li").each(function (index) {
        count++;
        if ($(this).is('li:last-child')) {
            $(this).parent().addClass('mg-column-' + count);
            count = 0;
        }
    });
    $('.main-navigation ul.navbar-nav>li').each(function (i, v) {
        $(v).find('a').contents().wrap('<span class="menu-item-text"/>')
    });
    $(".menu-item-has-children > a").append('<span class="dropdownToggle"><i aria-hidden="true" class="fas fa-angle-down"></i></span>');

    function navMenu() {
        $('.navbar.mobile-menu-style-1').closest('body').addClass('mobile-menu-style-1');
        $('.navbar.mobile-menu-style-2').closest('body').addClass('mobile-menu-style-2');
        $('.navbar.mobile-menu-style-3').closest('body').addClass('mobile-menu-style-3');

        if (jQuery('.fbth-main-menu-wrap').hasClass('menu-style-inline')) {
            if (jQuery(window).width() < 1025) {
                jQuery('.fbth-main-menu-wrap').addClass('menu-style-flyout');
                jQuery('.fbth-main-menu-wrap').removeClass('menu-style-inline');
            } else {
                jQuery('.fbth-main-menu-wrap').removeClass('menu-style-flyout');
                jQuery('.fbth-main-menu-wrap').addClass('menu-style-inline');
            }
            $(window).resize(function () {
                if (jQuery(window).width() < 1025) {
                    jQuery('.fbth-main-menu-wrap').addClass('menu-style-flyout');
                    jQuery('.fbth-main-menu-wrap').removeClass('menu-style-inline');
                } else {
                    jQuery('.fbth-main-menu-wrap').removeClass('menu-style-flyout');
                    jQuery('.fbth-main-menu-wrap').addClass('menu-style-inline');
                }
            })
        }
        // main menu toggleer icon (Mobile site only)
        $('[data-toggle="navbarToggler"]').on("click", function (e) {
            $('.navbar').toggleClass('active');
            $('.navbar-toggler-icon').toggleClass('active');
            $('body').toggleClass('offcanvas--open');

            e.stopPropagation();
            e.preventDefault();
        });
        $('.navbar-inner').on("click", function (e) {
            e.stopPropagation();
        });
        // Remove class when click on body
        $('body').on("click", function () {
            $('.navbar').removeClass('active');
            $('.navbar-toggler-icon').removeClass('active');
            $('body').removeClass('offcanvas--open');
        });
        $('.main-navigation ul.navbar-nav li.menu-item-has-children>a .dropdownToggle').on("click", function (e) {
            e.preventDefault();
            $(this).parent('a').siblings('.sub-menu').toggle();
            // $('ul.navbar-nav> li.menu-item-has-children> .sub-menu').not($(this).siblings()).not($(this).parents('.sub-menu')).hide();
            $(this).parent('a').parent('li').toggleClass('dropdown-active');
        })
    }
    navMenu();

}





    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/fbth-progress-bar.default', FBTHProgressBar);
        elementorFrontend.hooks.addAction("frontend/element_ready/fbth-main-menu.default", navMenu);
        elementorFrontend.hooks.addAction('frontend/element_ready/fbth-animated.default', FBTHAnimatedText);
        elementorFrontend.hooks.addAction('frontend/element_ready/fbth-advance-slide.default', FBTH_Advance_Slide_Js);
        elementorFrontend.hooks.addAction('frontend/element_ready/fbth-popup.default', fbth_modal_popup);
        elementorFrontend.hooks.addAction('frontend/element_ready/fbth-modal-popup.default', Fbth_Modal_Popup);
        elementorFrontend.hooks.addAction('frontend/element_ready/fbth-creative-button.default', FBTH_Creative_Button);
        elementorFrontend.hooks.addAction('frontend/element_ready/fbth-accordion.default', fbthAccordion);
        elementorFrontend.hooks.addAction('frontend/element_ready/fbth-animated.default', fbth_AnimatedText);
        elementorFrontend.hooks.addAction('frontend/element_ready/fbth-search-form.default', FBTH_Search_bos);
        elementorFrontend.hooks.addAction('frontend/element_ready/fbth-testimonial-loop.default', fbth_Testimonial_Js);
        elementorFrontend.hooks.addAction('frontend/element_ready/fbth-brand-carousel.default', FBTH_Brand_Slider_Js);
        elementorFrontend.hooks.addAction('frontend/element_ready/fbth-price-table.default', FBTH_Pricing_Table);
        elementorFrontend.hooks.addAction('frontend/element_ready/fbth-testimonial-loop.default', FBTH_Testimonial);
        elementorFrontend.hooks.addAction("frontend/element_ready/fbth-tab.default", fbthTab);
        elementorFrontend.hooks.addAction('frontend/element_ready/fbth-advance-tab.default', fbth_Adv_Tab);
        elementorFrontend.hooks.addAction('frontend/element_ready/fbth-video-testimonial.default', VideoGalleryHandler);
        elementorFrontend.hooks.addAction("frontend/element_ready/fbth-marque-testimonial.default", Fbth_MarqueTestimonial_Js);
        elementorFrontend.hooks.addAction("frontend/element_ready/slider.default", sliderJS);
        elementorFrontend.hooks.addAction("frontend/element_ready/ticker-item-slider.default", ticker_slider_items);
        elementorFrontend.hooks.addAction("frontend/element_ready/ticker-tm-slider.default", ticker_tm_slider);
        elementorFrontend.hooks.addAction("frontend/element_ready/fbth-addons-blog.default", FBTH_addons_blog);
        elementorFrontend.hooks.addAction("frontend/element_ready/fbth-addons-blog.default", Blog_slider_Js);
       

    });

})(jQuery);