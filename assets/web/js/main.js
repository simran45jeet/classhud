!function(e){"use strict";var n={init:function(){n.initDebouncedresize(),elementorFrontend.hooks.addAction("frontend/element_ready/gva-heading-block.default",n.elementHeadingBlock),elementorFrontend.hooks.addAction("frontend/element_ready/gva-testimonials.default",n.elementTestimonial),elementorFrontend.hooks.addAction("frontend/element_ready/gva-testimonials-carousel.default",n.elementTestimonial),elementorFrontend.hooks.addAction("frontend/element_ready/gva-posts.default",n.elementPosts),elementorFrontend.hooks.addAction("frontend/element_ready/gva-portfolio.default",n.elementPortfolio),elementorFrontend.hooks.addAction("frontend/element_ready/gva-gallery.default",n.elementGallery),elementorFrontend.hooks.addAction("frontend/element_ready/gva-events.default",n.elementEvents),elementorFrontend.hooks.addAction("frontend/element_ready/gva-brand.default",n.elementBrand),elementorFrontend.hooks.addAction("frontend/element_ready/gva-counter.default",n.elementCounter),elementorFrontend.hooks.addAction("frontend/element_ready/gva-services-group.default",n.elementServices),elementorFrontend.hooks.addAction("frontend/element_ready/gva-countdown.default",n.elementCountDown),elementorFrontend.hooks.addAction("frontend/element_ready/gva-video-carousel.default",n.elementVideoCarousel),elementorFrontend.hooks.addAction("frontend/element_ready/gva-user.default",n.elementUser),elementorFrontend.hooks.addAction("frontend/element_ready/gva-circle-progress.default",n.elementCircleProgress),elementorFrontend.hooks.addAction("frontend/element_ready/gva_icon_box_group.default",n.elementInitCarousel),elementorFrontend.hooks.addAction("frontend/element_ready/gva-content-carousel.default",n.elementInitCarousel),elementorFrontend.hooks.addAction("frontend/element_ready/gva-team.default",n.elementInitCarousel),elementorFrontend.hooks.addAction("frontend/element_ready/gva-product.default",n.elementInitCarousel),elementorFrontend.hooks.addAction("frontend/element_ready/gva-listings.default",n.elementInitCarousel),elementorFrontend.hooks.addAction("frontend/element_ready/gva-listings-banner-group.default",n.elementInitCarousel),elementorFrontend.hooks.addAction("frontend/element_ready/gva-listings-packages.default",n.elementInitCarousel),elementorFrontend.hooks.addAction("frontend/element_ready/gva_lt_item_gallery.default",n.elementInitCarousel),elementorFrontend.hooks.addAction("frontend/element_ready/gva_lt_item_rating_criteria.default",n.elementListingItemRatingCriteria),elementorFrontend.hooks.addAction("frontend/element_ready/column",n.elementColumn)},backend:function(){elementor.settings.page.addChangeCallback("fioxen_post_preview",n.handlePostPreview)},handlePostPreview:function(e){elementor.saver.update({onSuccess:function e(){window.location.reload()}}),window.location.reload()},initDebouncedresize:function(){var n,t,i=e.event;n=i.special.debouncedresize={setup:function(){e(this).on("resize",n.handler)},teardown:function(){e(this).off("resize",n.handler)},handler:function(e,a){var o=this,s=arguments,l=function(){e.type="debouncedresize",i.dispatch.apply(o,s)};t&&clearTimeout(t),a?l():t=setTimeout(l,n.threshold)},threshold:150}},elementColumn:function(n){if(n.hasClass("gv-sidebar-offcanvas")){var t='<div class="control-mobile">';t+='<a class="control-mobile-link" href="#"><i class="las la-bars"></i>Show Sidebar<a>',t+="</div>",n.append(t),t='<span class="filter-top"><a href="#" class="btn-close-filter"><i class="fas fa-times"></i></a></span>',n.children(".elementor-column-wrap, .elementor-widget-wrap").children(".elementor-widget-wrap").prepend(t)}var i=e("body"),a=n;e(n).find(".control-mobile, .btn-close-filter").on("click",function(e){e.preventDefault(),i.hasClass("open-el-sidebar-offcanvas")?(a.removeClass("open"),setTimeout(function(){i.removeClass("open-el-sidebar-offcanvas")},200)):(a.addClass("open"),i.addClass("open-el-sidebar-offcanvas"))})},elementPostArchive:function(e){var n=e.find(".post-masonry-style");n.imagesLoaded(function(){n.masonry({itemSelector:".item-masory",gutterWidth:0,columnWidth:1})})},elementTestimonial:function(e){var t=e.find(".init-carousel-swiper");n.initCarousel(t)},elementPosts:function(e){var t=e.find(".init-carousel-swiper");n.initCarousel(t)},elementServices:function(e){var t=e.find(".init-carousel-swiper");n.initCarousel(t)},elementPortfolio:function(t){var i=t.find(".init-carousel-swiper");n.initCarousel(i),e.fn.isotope&&e(".isotope-items").length&&e(".isotope-items").each(function(){e(this);var n=e(".portfolio-filter a"),t=e(this);t.isotope(),e(window).load(function(){t.isotope("layout")}),n.length>0&&n.on("click",function(i){i.preventDefault();var a=e(this);n.removeClass("active"),a.addClass("active"),t.isotope({filter:a.data("filter")})})})},elementGallery:function(e){var t=e.find(".init-carousel-swiper");n.initCarousel(t)},elementEvents:function(e){var t=e.find(".init-carousel-swiper");n.initCarousel(t)},elementBrand:function(e){var t=e.find(".init-carousel-swiper");n.initCarousel(t)},elementCounter:function(e){var n;e.find(".milestone-block").length},elementCountDown:function(n){e('[data-countdown="countdown"]').each(function(n,t){var i=e(this),a=i.data("date").split("-");i.gvaCountDown({TargetDate:a[0]+"/"+a[1]+"/"+a[2]+" "+a[3]+":"+a[4]+":"+a[5],DisplayFormat:'<div class="countdown-times"><div class="day">%%D%% <span class="label">Days</span> </div><div class="hours">%%H%% <span class="label">Hours</span> </div><div class="minutes">%%M%% <span class="label">Minutes</span> </div><div class="seconds">%%S%% <span class="label">Seconds</span></div></div>',FinishMessage:"Expired"})})},elementVideoCarousel:function(e){var t=e.find(".init-carousel-swiper");n.initCarousel(t)},elementHeadingBlock:function(e){if(e.find(".typed-effect").length){var n=e.find(".typed-effect").first(),t=n.data("strings"),i=n.attr("id");new Typed("#"+i,{typeSpeed:100,backSpeed:100,fadeOut:!0,loop:!0,strings:t.split(",")})}},elementInitCarousel:function(e){var t=e.find(".init-carousel-swiper");n.initCarousel(t)},initCarousel:function(n){var t=n.data("carousel");t=e.extend(!0,{items:3,items_lg:3,items_md:2,items_sm:2,items_xs:1,items_xx:1,space_between:30,effect:"slide",loop:1,speed:600,autoplay:1,autoplay_delay:6e3,autoplay_hover:0,navigation:1,pagination:1,pagination_type:"bullets",dynamic_bullets:0},t);var i=!1;t.autoplay&&(i={delay:t.autoplay_delay,disableOnInteraction:!1,pauseOnMouseEnter:t.autoplay_hover});var a=!1;t.pagination&&(a={el:n.parents(".swiper-slider-wrapper").find(".swiper-pagination")[0],type:t.pagination_type,clickable:!0,dynamicBullets:t.dynamic_bullets});var o=!1;t.navigation&&(o={nextEl:n.parents(".swiper-slider-wrapper").find(".swiper-nav-next")[0],prevEl:n.parents(".swiper-slider-wrapper").find(".swiper-nav-prev")[0],hiddenClass:"hidden"});let s=new Swiper(n[0],{loop:t.loop,spaceBetween:t.space_between,autoplay:i,speed:t.speed,grabCursor:!1,centeredSlides:!1,centeredSlidesBounds:!0,effect:t.effect,breakpoints:{0:{slidesPerView:1},560:{slidesPerView:t.items_xx},640:{slidesPerView:t.items_xs},768:{slidesPerView:t.items_sm},1024:{slidesPerView:t.items_md},1200:{slidesPerView:t.items_lg},1400:{slidesPerView:t.items}},pagination:a,navigation:o,observer:!0,observeParents:!0,slideVisibleClass:"item-active",watchSlidesVisibility:!0,on:{progress:function(){var t=n.find(".swiper-slide.item-active").length;n.find(".swiper-slide").removeClass("first"),n.find(".swiper-slide").removeClass("last"),n.find(".swiper-slide").removeClass("center");var i=0;5==t&&(i=1),n.find(".swiper-slide.item-active").each(function(n){n===i&&e(this).addClass("first"),n===i+1&&e(this).addClass("center"),n===t-(i+1)&&t>i+1&&e(this).addClass("last")})}}});t.autoplay_hover&&t.autoplay&&n.hover(function(){s.autoplay.stop()},function(){s.autoplay.start()})},elementCircleProgress:function(n){n.find(".circle-progress").appear(function(){n.find(".circle-progress").each(function(){let n=e(this);n.data("options"),n.circleProgress({startAngle:-Math.PI/2}).on("circle-animation-progress",function(n,t,i){e(this).find("strong").html(Math.round(100*i.toFixed(2).substr(1))+"<i>%</i>")})})})},elementListingItemRatingCriteria:function(n){n.find(".review__progress-bar").each(function(){var n=e(this);n.css("width",n.data("progress-max"))})}};e(window).on("elementor/frontend/init",n.init)}(jQuery);

/**default.js**/
(function($) {
    "use strict";
    var GaviasTheme = {
        init: function(){
            this.handleWindow();
            this.initResponsive();
            this.initCarousel();
            this.menuMobile();
            this.postMasonry();
            this.scrollTop();
            this.stickyMenu();
            this.dashboardPage();
            this.comment();
            this.other();
        },

        handleWindow: function(){
            var body = document.querySelector('body');
            if (window.innerWidth > body.clientWidth + 6) {
                body.classList.add('has-scrollbar');
                body.setAttribute('style', '--scroll-bar: ' + (window.innerWidth - body.clientWidth) + 'px');
            } else {
                body.classList.remove('has-scrollbar');
            }

            setTimeout(function(){
                    if($('body').hasClass('fioxen-body-loading')){
                  $('body').removeClass('fioxen-body-loading');
                  $('.fioxen-page-loading').fadeOut(50);
                    }
            }, 360);
        },
	 	
        initResponsive: function(){
            var _event = $.event,
            $special, resizeTimeout;
            $special = _event.special.debouncedresize = {
            setup: function () {
                $(this).on("resize", $special.handler);
            },
            teardown: function () {
                $(this).off("resize", $special.handler);
            },
            handler: function (event, execAsap) {
                var context = this,
                    args = arguments,
                    dispatch = function () {
                        event.type = "debouncedresize";
                        _event.dispatch.apply(context, args);
                    };
                if (resizeTimeout) {
                    clearTimeout(resizeTimeout);
                }
                execAsap ? dispatch() : resizeTimeout = setTimeout(dispatch, $special.threshold);
            },
            threshold: 150
            };
        },

        initCarousel: function(){
            var _default = {
                items: 3, 
                items_lg: 3,
                items_md: 2,
                items_sm: 2,
                items_xs: 1,
                items_xx: 1,
                space_between: 30,
                effect: 'slide',
                loop: 1,
                speed: 600,
                autoplay: 1,
                autoplay_delay: 6000,
                autoplay_hover: 0,
                navigation: 1,
                pagination: 1,
                pagination_type: 'bullets',
                dynamic_bullets: 0
            };

            $('.init-carousel-swiper-theme').each(function(){
                var $target = $(this);
                var settings = $target.data('carousel');

                settings = $.extend(!0, _default, settings);

                    //-- Autoplay
                var _autoplay = false;
                if(settings.autoplay){
                    _autoplay = {
                        delay: settings.autoplay_delay,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: settings.autoplay_hover,
                    }
                }
                    //-- Pagination 
                    var _pagination = false;
                    if(settings.pagination){
                            _pagination = {
                                    el: $target.parent().find('.swiper-pagination')[0],
                               type: settings.pagination_type,
                               clickable: true,
                                    dynamicBullets: false
                            }
                    }
                    //-- Navigation
                    var _navigation = false;
                    if(settings.navigation){
                            _navigation = {
                                    nextEl: $target.parents('.swiper-slider-wrapper').find('.swiper-nav-next')[0],
                            prevEl: $target.parents('.swiper-slider-wrapper').find('.swiper-nav-prev')[0],
                            hiddenClass: 'hidden'
                            }
                    }
                   // console.log($target[0]);
                    var swiper = new Swiper($target[0], {
                            loop: settings.loop,
                            spaceBetween: 30,
                            autoplay: _autoplay,
                            speed: settings.speed,
                            grabCursor: true,
                            breakpoints: {
                                    0: {
                                            slidesPerView: 1
                                    },
                                    390: {
                                  slidesPerView: settings.items_xx
                               },
                               640: {
                                    slidesPerView: settings.items_xs
                               },
                               768: {
                                  slidesPerView: settings.items_sm
                               },
                               1024: {
                                  slidesPerView: settings.items_md
                               },
                               1200: { // when window width is >= 1200px
                                  slidesPerView: settings.items_lg,
                               },
                               1400: { // when window width is >= 1200px
                                  slidesPerView: settings.items,
                               }
                            },
                            pagination: _pagination,
                            navigation: _navigation,
                       observer: true,  
            observeParents: true,
                    });

                if(settings.autoplay_hover && settings.autoplay){
                    $target.hover(function() {
                        swiper.autoplay.stop();
                    }, function() {
                       swiper.autoplay.start();
                    });
                }
            })
        },

	 	menuMobile: function(){
			$('.gva-offcanvas-content ul.gva-mobile-menu > li:has(ul)').addClass("has-sub");
			$('.gva-offcanvas-content ul.gva-mobile-menu > li:has(ul) > a').after('<span class="caret"></span>');
			$( document ).on('click', '.gva-offcanvas-content ul.gva-mobile-menu > li > .caret', function(e){
			  	e.preventDefault();
			  	var checkElement = $(this).next();
			  	$('.gva-offcanvas-content ul.gva-mobile-menu > li').removeClass('menu-active');
			  	$(this).closest('li').addClass('menu-active'); 
			  
			  	if((checkElement.is('.submenu-inner')) && (checkElement.is(':visible'))){
				 	$(this).closest('li').removeClass('menu-active');
				 	checkElement.slideUp('normal');
			  	}
		  		if((checkElement.is('.submenu-inner')) && (!checkElement.is(':visible'))){
			 		$('.gva-offcanvas-content ul.gva-mobile-menu .submenu-inner:visible').slideUp('normal');
			 		checkElement.slideDown('normal');
		  		}
		  		if (checkElement.is('.submenu-inner')){
			 		return false;
		  		} else {
			 		return true;  
		  		}   
			})

			$( document ).on( 'click', '.canvas-menu.gva-offcanvas > a.dropdown-toggle', function(e){
		  		e.preventDefault();
		  		var $style = $(this).data('canvas');
			  	if($('.gva-offcanvas-content' + $style).hasClass('open')){
				 	$('.gva-offcanvas-content' + $style).removeClass('open');
				 	$('#gva-overlay').removeClass('open');
				 	$('#wp-main-content').removeClass('blur');
			  	}else{
				 	$('.gva-offcanvas-content' + $style).addClass('open');
				 	$('#gva-overlay').addClass('open');
				 	$('#wp-main-content').addClass('blur');
			  	}
			});

			$( document ).on( 'click', '#gva-overlay, .top-canvas a.control-close-mm', function(e){
			  	e.preventDefault();
			  	$(this).removeClass('open');
			  	$('#gva-overlay').removeClass('open');
			  	$('.gva-offcanvas-content').removeClass('open');
			  	$('#wp-main-content').removeClass('blur');
			})
			$( document ).on( 'click', '.close-canvas', function(e) {
			  	e.preventDefault();
			  	$('.gva-offcanvas-content').removeClass('open');
			  	$('#gva-overlay').removeClass('open');
			  	$('#wp-main-content').removeClass('blur');
			})

    		if( ('ontouchstart' in window) || (navigator.msMaxTouchPoints > 0) || (navigator.MaxTouchPoints > 0) ) {
		      var link_id = '';
		      $('.gva-nav-menu .menu-item > a').on('click', function(e) {
		        e.preventDefault();
		        if ($(this).parent().find('.submenu-inner').length == 0) {   
		          	window.location.href = $(this).attr('href');
		          	return;
		        	}
		        	if ($(this).attr('data-link_id') == link_id) {         
		          	window.location.href = $(this).attr('href');
		          	return;
		        	}
		        	if($(window).width() < 1024){
		          	$('.gva-offcanvas-content ul.gva-mobile-menu > li').removeClass('menu-active');
		          	$('.gva-offcanvas-content ul.gva-mobile-menu .submenu-inner:visible').slideUp('normal');
		          	$(this).parent().find('> .submenu-inner').slideDown();
		          	$(this).closest('li').addClass('menu-active');
		        	}
		        	link_id = $(this).attr('data-link_id');
		        	e.preventDefault();
		        	return;
		      });
		   }
	 	},

	 	postMasonry: function(){
                        if( $('.post-masonry-style').length>0 ){
                            var $container = $('.post-masonry-style');
                            $container.imagesLoaded( function(){
                                    $container.masonry({
                                            itemSelector : '.item-masory',
                                            gutterWidth: 0,
                                            columnWidth: 1,
                                    }); 
                            });
                        }
	 	},

		scrollTop: function(){
			var offset = 300;
			var duration = 500;

			jQuery(window).scroll(function() {
			  	if (jQuery(this).scrollTop() > offset) {
				 	jQuery('.return-top').fadeIn(duration);
			  	} else {
				 	jQuery('.return-top').fadeOut(duration);
			  	}
			});

			$( document ).on('click', '.return-top', function(event){
			  	event.preventDefault();
			  	jQuery('html, body').animate({scrollTop: 0}, duration);
			  	return false;
			});
		},

	 	stickyMenu: function(){
		   
			if( $('.gv-sticky-menu').length > 0 ){
				$( ".gv-sticky-menu" ).wrap( "<div class='gv-sticky-wrapper'></div>" );
		      
		      $('.gv-sticky-wrapper').each(function(){
		      	var wrapper = $(this);
		      	var headerHeight = wrapper.find('.gv-sticky-menu').height();
			      $(window).on('scroll', function () {
			         if ($(window).scrollTop() > wrapper.offset().top) {
			            wrapper.addClass('is-fixed');
			            wrapper.css('height', headerHeight);
			         } else {
			            wrapper.removeClass('is-fixed');
			            wrapper.css('height', 'auto');
			         }
			      });
			   });
			   
		   }

	 		if($(document).width() < 1024){
		   	$('.gv-sticky-wrapper > .elementor-hidden-tablet').parent().css('display', 'none');
		   }else{
		   	$('.gv-sticky-wrapper > .elementor-hidden-tablet').parent().css('display', 'block');
		   }

		   $(window).on("debouncedresize", function( event ) {
		   	if($(document).width() < 1024){
		   		$('.gv-sticky-wrapper > .elementor-hidden-tablet').parent().css('display', 'none');
			   }else{
			   	$('.gv-sticky-wrapper > .elementor-hidden-tablet').parent().css('display', 'block');
			   }
		   });

	 	},

	 	dashboardPage: function(){
	 		var sidebar = $('.dashboard-sidebar');
                        if( sidebar.length>0){
                            //sidebar.mCustomScrollbar();
                            $('.job-control-mobile-sidebar').on('click', function(){
                                    var sidebar = '#job-manager-job-dashboard .dashboard-sidebar';
                                    if($(sidebar).hasClass('open')){
                                            $(sidebar).removeClass('open');
                                    }else{
                                            $(sidebar).addClass('open');
                                    }
                            });
                        }
	 	},

	 	progress_animation: function(){
                    if( $("[data-progress-animation]").length>0 ) {
                        $("[data-progress-animation]").each(function() {
                            var $this = $(this);

                            $this.appear(function() {
                              var delay = ($this.attr("data-appear-animation-delay") ? $this.attr("data-appear-animation-delay") : 1);
                              if(delay > 1) $this.css("animation-delay", delay + "ms");
                              setTimeout(function() { $this.animate({width: $this.attr("data-progress-animation")}, 800);}, delay);
                            }, {accX: 0, accY: -50});
                        });
                    }
	 	},

	 	comment: function(){
			var count = 0;
			var total = 0;
			$('#lt-comment-reviews').find('input.lt-review-val').each(function(){
			  var val = $(this).val();
			  if(val){
				 val = parseInt(val);
				 if(Number.isInteger(val)){
					total += val;
					count ++;
				 }  
			  }
			});
			var avg = total/count;
			$('#lt-comment-reviews').find('.avg-total-tmp .value').html(avg.toFixed(2));

			// Click to star
			$( '.select-review' ).on( 'click', '.star', function( event ) {
			  
			  $( this ).nextAll( '.star' ).removeClass( 'active' );
			  $( this ).prevAll( '.star' ).removeClass( 'active' );
			  $( this ).addClass( 'active' );
			  $( this ).parent().find( '.lt-review-val' ).attr( 'value', $( this ).attr( 'data-star' ) );

			  var count = 0;
			  var total = 0;
			  $('#lt-comment-reviews').find('input.lt-review-val').each(function(){
				 var val = $(this).val();
				 if(val){
					val = parseInt(val);
					if(Number.isInteger(val)){
					  total += val;
					  count ++;
					}  
				 }
			  });
			  var avg = total/count;
			  $('#lt-comment-reviews').find('.avg-total-tmp .value').html(avg.toFixed(2));

			});

			$( '.lt-review-val' ).each( function( index ) {
			  $( this ).parent( '.stars' ).find( 'span[data-star="' + $( this ).val() + '"]' ).trigger( 'click' );
			});


			$('.menu-my-account > a').on('click', function(){
			  var parent = $(this).parent();
			  if(parent.hasClass('open')){
				 parent.removeClass('open');
			  }else{
				 parent.addClass('open');
			  }
			});

		 },

		other: function(){

			$('.gva-user .login-account').on('click', function(){
			  	if($(this).hasClass('open')){
				 	$(this).removeClass('open');
			  	}else{
				 	$(this).addClass('open');
			  	}
			})
                        if( $('.popup-video').length > 0){ 
                            $('.popup-video').magnificPopup({
                                    type: 'iframe',
                                    fixedContentPos: false
                            });
                        }

			$( document ).on( 'click', '.yith-wcwl-add-button.show a', function() {
			  $(this).addClass('loading');
			});

			$(document).on('click', '.gva-search > a.control-search', function(){
				let _btn = $(this);
			  	if(_btn.hasClass('search-open')){
				 	_btn.parents('.gva-search').removeClass('open');
				 	_btn.removeClass('search-open');
			  	}else{
				 	_btn.parents('.gva-search').addClass('open');
				 	_btn.addClass('search-open');
				 	setTimeout(function(){ 
		            _btn.parent('.main-search').find('.gva-search input.input-search').first().focus(); 
		         }, 100);
			  	}
			});

			$(document).on('click', '.mini-cart-header .mini-cart', function(e){
				e.preventDefault();
				$(this).parent('.mini-cart-inner').addClass('open');
			});
			$(document).on('click', '.mini-cart-header .minicart-overlay', function(e){
				e.preventDefault();
				$(this).parent('.mini-cart-inner').removeClass('open');
			});

			$('.scroll-link[href*="#"]:not([href="#"])').click(function() {
		      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		        var target = $(this.hash);
		        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		        if (target.length) {
		          $('html, body').animate({
		            scrollTop: target.offset().top - 100
		          }, 1500);
		          return false;
		        }
		      }
		   });

			$('.fioxen-post-share.style-2 .btn-control-share').on('click', function(e){
				e.preventDefault();
				var wrapper = $(this).parents('.fioxen-post-share');
				if(wrapper.hasClass('open')){
					wrapper.removeClass('open');
				}else{
					wrapper.addClass('open');
				}
			});

			$('.gva-portfolio-grid .portfolio-filter').each(function(){
                            $(this).find('.btn-filter').each(function(){
                                let _btn = $(this);
                                let filter = _btn.attr('data-filter');
                                let items = _btn.parents('.gva-portfolio-grid').find('.isotope-items').first();
                                _btn.find('.count').first().html('[' + items.find('> ' + filter).length + ']');
                            });
			});

			var scrollToTop = function() {
		      var scrollTo = $('#wp-main-content').offset().top - 100;
		      $('html, body').stop().animate({
		         scrollTop: scrollTo
		      }, 400);
		   };

		}
	}

	$(window).on('load', function(){
      $(document).on('click', '.minicart-close', function(e){
         e.preventDefault();
         $(this).parents('.cart').removeClass('open');
      })

		if($('.product-single-inner .flex-control-nav').length){
			$('.product-single-inner .flex-control-nav').wrap('<div class="swiper-container product-thumbnail-swiper"></div>');
			$('.product-single-inner .flex-control-nav').after('<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>');
			$('.product-single-inner .flex-control-nav').addClass('swiper-wrapper');
			$('.product-single-inner .flex-control-nav > li').addClass('swiper-slide');
			var swiper = new Swiper('.product-single-inner .product-thumbnail-swiper', {
	        	pagination: '.swiper-pagination',
	        	slidesPerView: 'auto',
	        	paginationClickable: true,
	        	spaceBetween: 10,
	        	navigation: {
	        		nextEl: '.swiper-nav-next',
				   prevEl: '.swiper-nav-prev'
				},
	        	breakpoints: {
			  		0: {
			  			slidesPerView: 2
			  		},
			  		390: {
				      slidesPerView: 2
				   },
				   640: {
				   	slidesPerView: 3
				   },
				   768: {
				      slidesPerView: 4
				   },
				   1024: {
				      slidesPerView: 4
				   },
				   1400: { 
				      slidesPerView: 4,
				   }
			  	}
	    	});
		};
	});

  	$(document).ready(function(){
	 	GaviasTheme.init();
  	})

})(jQuery);


function error_message(meessage){
    // toastr.options = {
    //     "closeButton": false,
    //     "debug": false,
    //     "newestOnTop": false,
    //     "progressBar": true,
    //     "positionClass": "toastr-top-right",
    //     "preventDuplicates": false,
    //     "onclick": null,
    //     "showDuration": "300",
    //     "hideDuration": "1000",
    //     "timeOut": "5000",
    //     "extendedTimeOut": "1000",
    //     "showEasing": "swing",
    //     "hideEasing": "linear",
    //     "showMethod": "fadeIn",
    //     "hideMethod": "fadeOut"
    // };
    // toastr.error(meessage);
    $("#liveToast .toast-body").html(meessage);
    $("#liveToast").toast("show");
}
function success_message(meessage){
    // toastr.options = {
    //     "closeButton": false,
    //     "debug": false,
    //     "newestOnTop": false,
    //     "progressBar": true,
    //     "positionClass": "toastr-top-right",
    //     "preventDuplicates": false,
    //     "onclick": null,
    //     "showDuration": "300",
    //     "hideDuration": "1000",
    //     "timeOut": "5000",
    //     "extendedTimeOut": "1000",
    //     "showEasing": "swing",
    //     "hideEasing": "linear",
    //     "showMethod": "fadeIn",
    //     "hideMethod": "fadeOut"
    // };
    // toastr.success(meessage);
    $("#liveToast .toast-body").html(meessage);
    $("#liveToast").toast("show");
}

function commonAjx(pageUrl, replaceDivId, serializdeDivId, ajaxRespDivReplaceFrom, method, jsonObject, functionAfterSuccess, functionParms, functionAfterError, errorfunctionParms, fileFlag) {
    var $csrfToken = false;
    var $return = '';
    if (typeof csrf !== 'undefined') {
        $csrfToken = JSON.parse(getLocalStorageItem('csrf'));
        var tokenName = $csrfToken.name;
        var tokenValue = $csrfToken.hash;
    }
    var postData = '';
    if (typeof serializdeDivId !== 'undefined' && serializdeDivId != '') {
        var postData = $('#' + serializdeDivId + " :input").serialize();
    }
    method = (typeof method !== 'undefined' && method != '') ? method : 'POST';
    if (typeof jsonObject == 'object') {
        if (typeof fileFlag !== 'undefined' && fileFlag === true) {
            postData = jsonObject;
        } else {
            if (postData != '') {
                postData += '&';
            }
            postData += $.param(jsonObject);
        }
    }

    if ($csrfToken && method.toLowerCase() == 'post') {
        if (typeof postData == 'object' && fileFlag) {
            postData.append(tokenName, tokenValue);
        } else {
            if (postData != '') {
                postData += '&';
            }
            postData += tokenName + '=' + tokenValue;
        }
    }
    var contentType = 'application/x-www-form-urlencoded; charset=UTF-8';
    var processData = true;
    if (typeof fileFlag !== 'undefined' && fileFlag === true) {
        contentType = false;
        processData = false;
    }
    $.ajax({
        url: pageUrl,
        type: method,
        data: postData,
        contentType: contentType,
        processData: processData,
        beforeSend: function () {
            showLoadingDiv();
        }, success: function (respData) {
            hideLoadingDiv();
            if (typeof functionAfterSuccess == 'function') {
                if ($csrfToken) {
                    setLocalStorageItem('csrf', JSON.stringify(JSON.parse(respData).csrf));
                }
                functionAfterSuccess(respData, functionParms);
            } else if (typeof replaceDivId !== 'undefined' && replaceDivId != '') {
                if (typeof ajaxRespDivReplaceFrom !== 'undefined' && ajaxRespDivReplaceFrom != '') {
                    respData = $('#' + ajaxRespDivReplaceFrom, respData).html();
                }

                //console.log(respData);
                $('#' + replaceDivId).html(respData);
            } else {
                if ($csrfToken) {
                    setLocalStorageItem('csrf', JSON.stringify(JSON.parse(respData).csrf));
                }
            }

        }, error: function (error) {
            hideLoadingDiv();
            if (typeof functionAfterError == 'function') {
                functionAfterError(error, errorfunctionParms);
            }
        }
    });
}

function showLoadingDiv(){
    jQuery(".loader_div").removeClass("d-none");
}
function hideLoadingDiv(){
    jQuery(".loader_div").addClass("d-none");
}
function scrollToDiv(divId) {
    jQuery('html, body').animate({
        scrollTop: $(divId).offset().top - 80
    }, 800);
}

function show_loading_div() {
    jQuery('.loader_div').removeClass("d-none");
}
function hide_loading_div() {
    jQuery('.loader_div').addClass("d-none");
}
jQuery(function (){
    jQuery(document).on("change",":input[name=country]",function(){
      get_states( $(this).val() ); 
    }); 
    jQuery(document).on("change",":input[name=state]",function(){
       get_cities($(":input[name=country]").val(), $(this).val() ); 
    });
    jQuery(document).on("submit","form#kt_sign_in_form",function(e){
    	e.preventDefault();
    	ajax_login();
    });
    jQuery(document).on("submit","form#kt_lost_password",function(e){
    	e.preventDefault();
    	ajax_reset_password();
    });
    jQuery(document).on("submit","form#kt_set_password",function(e){
        e.preventDefault();
        ajax_set_password();
    });
    
    jQuery(document).on("click",".locate_me",function(e){
        e.preventDefault();
        getLocation();
    });
    jQuery(".preloader").addClass("d-none"); 
   
    jQuery(document).on("click",".toggle-password",function(){
       var $this = jQuery(this);
        var $password_field = jQuery("#"+jQuery(this).data("rel") );
        if ($password_field.attr("type") === "password") {
            $password_field.attr("type","text") ;
            $this.removeClass('fa-eye');
            $this.addClass('fa-eye-slash');
        } else {
            $password_field.attr("type","password");
            $this.removeClass('fa-eye-slash');
            $this.addClass('fa-eye');
        }
   });
   jQuery(document).on("change",".image-input  :input[type='file']",function(e){
        var $file = this.files[0];
        var $this = $(this);
        var $image_wrap = $(this).parent().parent().find(".image-input-wrapper")
        if ($file){
            var $reader = new FileReader();
            $reader.onload = function(event){
//                console.log(event.target.result);
//                console.log($image_wrap);
                $image_wrap.css({"background-image" : "url('"+event.target.result+"')"});
            }
            $reader.readAsDataURL($file);
        }
   });
   if( $(".review__progress-bar").length>0 ) {
        
        $(".review__progress-bar").each(function(){
            $(this).css({width:$(this).data("progress-max")})
        });
    
    }
});
//$(window).bind("load",function(){
//   jQuery(".preloader").addClass("d-none"); 
//});
function ajax_login() {
    commonAjx(base_url+"/users/signin", "", "kt_sign_in_form","", "post","",login_response);
}
function ajax_reset_password() {
    commonAjx(base_url+"/users/forgot_password", "", "kt_lost_password","", "post","",reset_password_response);
}
function ajax_set_password() {
    commonAjx(base_url+"/users/set_password", "", "kt_set_password","", "post","",set_password_response);
}

function login_response(response){
    var $resp = JSON.parse(response);
    if(	$resp.flag==1 ){
        success_message($resp.message);
        window.location.href=$resp.url;
    }else{
        error_message($resp.message);
    }
}
function reset_password_response(response){
    var $resp = JSON.parse(response);
    if( $resp.flag==1 ){
        success_message($resp.message);
        $("#form-ajax-lost-password-popup").modal("hide");
        $("#form-ajax-login-popup").modal("show");
    }else{
    error_message($resp.message);
    }
}


function set_password_response(response){
    var $resp = JSON.parse(response);
    if( $resp.flag==1 ){
        success_message($resp.message);
        $("#form-ajax-set-password").modal("hide");
        window.location.reload();
    }else{
        error_message($resp.message);
    }
}
function get_states(country_id){ 
    commonAjx(base_url+"/ajax/get_states", "", "",
"", "post",{country_id:country_id}, set_states);
}
function set_states(response){
    var $resp = JSON.parse(response);
    var $html = "";
    jQuery($resp.data).each(function($key,$state){
        $html+="<option value='"+$state.id+"'>"+$state.name+"</option>";
    });
    jQuery(":input[name='state'] option[value!='']").remove();
    jQuery(":input[name='state']");
    jQuery(":input[name='state']").append($html);
}
function get_cities(country_id,state_id,city_id){ 
    commonAjx(base_url+"/ajax/get_cities", "", "",
"", "post",{"country_id":country_id,"state_id":state_id,'city_id':city_id}, set_cities);
}
function set_cities(response){
    var $resp = JSON.parse(response);
    var $html = "";
    jQuery($resp.data).each(function($key,$cities){
        $html+="<option value='"+$cities.id+"' "+( ( typeof $cities.selected !="undefined" && $cities.selected==true ) ? "selected=''" :"" )+">"+$cities.name+"</option>";
    });
    jQuery(":input[name='city'] option[value!='']").remove();
    jQuery(":input[name='city']");
    jQuery(":input[name='city']").append($html);
}
/************location js function************/
var latitude = longitude = google_location = full_address = place_id = "";
var autocomplete;
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition,geoError);
    } else {
       // listing_location.innerHTML = "Geolocation is not supported by this browser, please input your location manually.";
    }
}

function geoError(err) {
    //listing_location.innerHTML = "We couldn't find location from your browser, please inout your location manually.";
    jQuery.ajax({
        url: base_url+'/ajax/getip_latlng',
    }).done(function(response) {
        response = JSON.parse(response);
        latitude = response.lat[0];
        longitude = response.lng[0];
        // lat = '30.91985889999999';
        // lng = '75.8632732';
        getGoogleAddress(latitude,longitude);
    });

  };
function showPosition(position) {
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;
    getGoogleAddress(latitude,longitude);
}

function getGoogleAddress(lat,lng) {
    city_name = google_location = full_address = postcode_address = street_name = temp_address = '';
    var addressArr = [];
    jQuery.ajax({
        url: base_url+"/ajax/latlng_detail",
        type:'POST',
        data:{"latitude":latitude,"longitude":longitude},
        success: function(response){
            resp = JSON.parse(response);
            resp_temp = resp.location.results[0];
            
            for (var i = 0; i < resp_temp.address_components.length; i++) {
                var val = resp_temp.address_components[i].long_name;
                full_address += (i == 0) ? '' + val : ',' + val;
                /*
                if( response.address_components[i].types[0]=='postal_code' ) {
                    postcode_address = response.address_components[i].long_name;
                    $('#postcode').val(postcode_address);
                }else if( response.address_components[i].types[0]=='country' ) {
                    country_name = response.address_components[i].long_name; 
                    country_code = response.address_components[i].short_name;

                }else if( response.address_components[i].types[0]=='administrative_area_level_1' ) {
                    state_name = response.address_components[i].long_name;
                }else if( response.address_components[i].types[0]=='administrative_area_level_2' ) {
                    city_name = response.address_components[i].long_name;
                    street_name += response.address_components[i].long_name+',';
                }
                */
            }
            place_id = resp_temp.place_id;    
            google_location = typeof resp_temp.formatted_address!="undefined" ? resp_temp.formatted_address : full_address;
            if( document.getElementById('autocompleteLocation') ) {
                document.getElementById('autocompleteLocation').value = google_location;
            }
            saveLocationLocally();
            if( typeof $function_after_location_set=="function" ){
            	$function_after_location_set();
            }

        }
    });
}

latitude = localStorage.getItem("latitude");
longitude = localStorage.getItem("longitude");
place_id = localStorage.getItem("place_id");
full_address = localStorage.getItem("full_address");
google_location = localStorage.getItem("google_location");
if( typeof latitude!="undefiend" && latitude!="" && latitude!=null && typeof longitude!="undefiend" && longitude!="" && longitude!=null  ) {
    show_location_values();
}


function initialize() {
    input = document.getElementById('autocompleteLocation');
    if( input ) {
        autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', fillInAddress);
    }
    
    
    
    if( typeof latitude!="undefiend" && latitude!="" && latitude!=null && typeof longitude!="undefiend" && longitude!="" && longitude!=null  ) {
        if( typeof $function_after_location_set=="function" ){
            $function_after_location_set();
        }
    }else{
        getLocation();
    }
}

function fillInAddress() {
    city_name = google_location = full_address = postcode_address = street_name = temp_address = '';
    var addressArr = [];
    var place = autocomplete.getPlace();
    for (var i = 0; i < place.address_components.length; i++) {
        
        full_address += (i == 0) ? '' + place.address_components[i].long_name : ',' + place.address_components[i].long_name;

        for (var j = 0; j < place.address_components[i].types.length; j++) {
            if (place.address_components[i].types[j] == "street_number") {
                addressArr['street_number'] = place.address_components[i].long_name;
            } else if (place.address_components[i].types[j] == "route") {
                addressArr['route'] = place.address_components[i].long_name;
            } else if (place.address_components[i].types[j] == "postal_code") {
                postcode_address = place.address_components[i].long_name;
            } else if (place.address_components[i].types[j] == "country") {
                country_code = place.address_components[i].short_name;
                country_name = place.address_components[i].long_name;
            } else if (place.address_components[i].types[j] == "administrative_area_level_2") {
                city_name = place.address_components[i].long_name;
            } else if (place.address_components[i].types[j] == "administrative_area_level_1") {
                state_name = place.address_components[i].long_name;
            }
        }
    }
    var geo_location = place.geometry.location;
    latitude = geo_location.lat();
    longitude = geo_location.lng();
    place_id = place.place_id;
    google_location = $('#autocompleteLocation').val();
    saveLocationLocally();
    if( typeof $function_after_location_set=="function" ){
        setTimeout($function_after_location_set(),500);
    	
    }
}
function saveLocationLocally() {
    if (typeof(Storage) !== "undefined") {
        localStorage.setItem("latitude",latitude);
        localStorage.setItem("longitude",longitude);
        localStorage.setItem("place_id",place_id);
        localStorage.setItem("full_address",full_address);
        localStorage.setItem("google_location",google_location);
    }
    show_location_values();
}
function show_location_values() {
    if( document.getElementById("full_address") )  {
        document.getElementById("full_address").value=full_address;
        document.getElementById("autocompleteLocation").value=google_location;
        document.getElementById("place_id").value=place_id;
        document.getElementById("longitude").value=longitude;
        document.getElementById("latitude").value=latitude;
    }

}


/************location js function************/

var navbar = document.getElementById("header_menu");
if( navbar ) {
    var stickyHeader = navbar.offsetTop;
    window.onscroll = function() {getMyStickyHeader()};
}
function getMyStickyHeader() {
    if (window.pageYOffset >= stickyHeader) {
        navbar.classList.add("stickyHeader")
    } else {
        navbar.classList.remove("stickyHeader");
    }
}
/**default.js**/