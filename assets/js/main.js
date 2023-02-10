/* global jQuery */
(function ($, root) {

	'use strict';
	
	//load styles or no
	var layoutVersion = 'graphic'
	var remodalItem = null
	
	try {
		layoutVersion = localStorage.getItem('vicepremier-layout');
		
		if(layoutVersion == null) {
			localStorage.setItem('vicepremier-layout', 'graphic');
			layoutVersion = 'graphic';
		}
		
		switch(layoutVersion) {
			case 'text':
				$('link[rel="stylesheet"]').prop('disabled', true);
				var $change = $('#change_graphic_layout');
				var tmpTitle = $change.html();
				$change.html($change.data('temp-title'));
				$change.data('temp-title', tmpTitle);
				$('#premier-image').hide();
				break;
			case 'graphic':
				$('link[rel="stylesheet"]').prop('disabled', false);
				$('#premier-image').show();
				break;
		}
    } catch(e) {
        console.log('Browser not supporting localstorage');
    }

	
	/* ****************************************************************** */
	/* Prepare main object
	/* ****************************************************************** */
	
		var VICEPREMIER = window.VICEPREMIER || {};
		VICEPREMIER.ready = {};
		
	/* ****************************************************************** */
	/* CHANGE GRAPHIC LAYOUT
	/* ****************************************************************** */
	
		VICEPREMIER.ready.layout_version = function() {
			$('#switch_to_graphic').on('click', function(e) {
				try {
					localStorage.setItem('vicepremier-layout', 'graphic');
					
					$('link[rel="stylesheet"]').prop('disabled', false);
					
					var $change = $('#change_graphic_layout');
					var tmpTitle = $change.html();
					$change.html($change.data('temp-title'));
					$change.data('temp-title', tmpTitle);
					$('#premier-image').show();

					layoutVersion = 'graphic'
			    } catch(e) {
			        console.log('Browser not supporting localstorage');
			    }
			})
			
			$('#change_graphic_layout').on('click', function(e) {
				try {
					layoutVersion = localStorage.getItem('vicepremier-layout');
					
					if(layoutVersion == null) {
						localStorage.setItem('vicepremier-layout', 'graphic');
						layoutVersion = 'graphic';
					}
					
					switch(layoutVersion) {
						case 'graphic':
							localStorage.setItem('vicepremier-layout', 'text');
							$('link[rel="stylesheet"]').prop('disabled', true);
							$('#premier-image').hide();
							break;
						case 'text':
							localStorage.setItem('vicepremier-layout', 'graphic');
							$('link[rel="stylesheet"]').prop('disabled', false);
							$('#premier-image').show();
							break;
					}
					var $change = $('#change_graphic_layout');
					var tmpTitle = $change.html();
					$change.html($change.data('temp-title'));
					$change.data('temp-title', tmpTitle);
			    } catch(e) {
			        console.log('Browser not supporting localstorage');
			    }
			})
		};
		
	/* ****************************************************************** */
	/* CREATE BACKGROUND IMAGE FROM ATTR
	/* ****************************************************************** */
	
		VICEPREMIER.ready.bg_image_from_attr = function() {
			$( "[data-image-src]" ).each(function() {
	          var attr = $(this).attr('data-image-src');
	
	          if (typeof attr !== typeof undefined && attr !== false) {
	              $(this).css('background', "url('"+attr+"')");
	          }
	
	        });
		};
		
	/* ****************************************************************** */
	/* CREATE CUSTOM CAPTCHA
	/* ****************************************************************** */
	
		VICEPREMIER.ready.create_custom_captcha = function() {
			$('.captcha-row').each(function(e) {
				var captchaData = $(this).find('.captcha span')
				
				var x = Math.floor((Math.random() * 20) + 1);
				var y = Math.floor((Math.random() * 20) + 1);
				
				$(captchaData[0]).html(captchaValues[x]);
				$(captchaData[1]).html(captchaValues[y]);
			})
		};
		
	/* ****************************************************************** */
	/* VALIDATE FORM ON SEND
	/* ****************************************************************** */
	
		VICEPREMIER.ready.form_send = function() {
			$.validator.addMethod('telefon_SK', function (value) { 
				if(value == "") 
					return true;
				else 
			    	return /^[+]?[()/0-9. -]{9,}$/.test(value); 
			}, 'Please enter a valid phone.');
			
			
			$('#kontakt-form').validate( {
				rules: {
					meno: "required",
					ulica: "required",
					cislo: "required",
					mesto: "required",
					psc: {
						required: true,
						minlength: 5,
						maxlength: 6
					},
					/*telefon: {
						telefon_SK: true,
					},
					mail: {
						email: true
					},*/
					sposob: "required",
					vec: "required",
					ziadost: "required",
					captcha: "required"
				},
				messages: {
					meno: {
						required: requiredText
					},
					ulica: {
						required: requiredText
					},
					cislo: {
						required: requiredText
					},
					mesto: {
						required: requiredText
					},
					psc: {
						required: requiredText
					},
					sposob: {
						required: requiredText
					},
					vec: {
						required: requiredText
					},
					ziadost: {
						required: requiredText
					}
				},
				submitHandler: function(form) {
					form = this.currentForm
					
			    	/*if(!$('#gdpr1').prop('checked')) {
			    		alert('Prosím vyjadrite súhlas so spracovaním osobných údajov');
			    		return false;
			    	}*/
					/*if($(form).find('input[type="file"]').length) {
						var $input = $(form).find('input[type="file"]')
						var sizeInKB = $input[0].files[0].size/1024;
						var sizeLimit= 5120;
						$input.addClass('valid')
						console.log($input, sizeInKB, sizeLimit)
						if (sizeInKB >= sizeLimit) {
							$input.removeClass('valid').addClass('invalid')
						    $(form).find('.warning').addClass('show');
		    				return false
						}
					}*/
				    if($(form).find('.captcha-row').length) {
						var captcha = $(form).find('.captcha-row .captcha span')
						
						var userCaptcha = $(form).find('.captcha-row input');
						
						var x = $.inArray($(captcha[0]).html(), captchaValues)
						var y = $.inArray($(captcha[1]).html(), captchaValues)
						
						if((x >= 0) && (y >= 0)) {
							x += 1
							y += 1
							
							if(Number(userCaptcha.val()) == (Number(x) + Number(y))) {
								$(userCaptcha).removeClass('invalid').addClass('valid')
					    		form.submit();
							} else {
								$(form).find('.warning').addClass('show');
								$(userCaptcha).removeClass('valid').addClass('invalid')
								return false
							}
						} else {
							return false
						}
					} else {
				    	form.submit();
					}
			    },
			    invalidHandler: function(event, validator) {
			    	$('form').find('.warning').addClass('show');
			    }
			})
			
			$('#udalost').validate( {
				rules: {
					meno: "required",
					priezvisko: "required",
					ulica: "required",
					mesto: "required",
					psc: {
						required: true,
						minlength: 5,
						maxlength: 6
					},
					/*telefon: {
						telefon_SK: true,
					},
					mail: {
						email: true
					},*/
					sprava: "required",
					captcha: "required",
					/*gdpr1: {
						required: true
					},
					gdpr2: {
						required: true
					}*/
				},
				messages: {
					meno: {
						required: requiredText
					},
					priezvisko: {
						required: requiredText
					},
					ulica: {
						required: requiredText
					},
					mesto: {
						required: requiredText
					},
					psc: {
						required: requiredText
					},
					sprava: {
						required: requiredText
					}
				},
				submitHandler: function(form) {
					form = this.currentForm
					
				    if($(form).find('.captcha-row').length) {
						var captcha = $(form).find('.captcha-row .captcha span')
						
						var userCaptcha = $(form).find('.captcha-row input');
						
						var x = $.inArray($(captcha[0]).html(), captchaValues)
						var y = $.inArray($(captcha[1]).html(), captchaValues)
						
						if((x >= 0) && (y >= 0)) {
							x += 1
							y += 1
							
							if(Number(userCaptcha.val()) == (Number(x) + Number(y))) {
								$(userCaptcha).removeClass('invalid').addClass('valid')
					    		form.submit();
							} else {
								$(form).find('.warning').addClass('show');
								$(userCaptcha).removeClass('valid').addClass('invalid')
								return false
							}
						} else {
							return false
						}
					} else {
				    	form.submit();
					}
			    },
			    invalidHandler: function(event, validator) {
			    	$('form').find('.warning').addClass('show');
			    	console.log(event)
			    }
            })
            
            $('#work-form').validate( {
				rules: {
					mail: {
                        required: true,
						email: true
					},
					captcha: "required",
					gdpr1: {
						required: true
					},
					gdpr2: {
						required: true
					}
					
				},
				messages: {
					mail: {
						required: requiredText
					}
				},
				submitHandler: function(form) {
					form = this.currentForm
					
					if($('#work-form').find('input[id^=position_]:checked').length == 0) {
						$(form).find('#warning-work').addClass('show')
						return false
					} else {
						$(form).find('#warning-work').removeClass('show')
					}

				    if($(form).find('.captcha-row').length) {
						var captcha = $(form).find('.captcha-row .captcha span')
						
						var userCaptcha = $(form).find('.captcha-row input');
						
						var x = $.inArray($(captcha[0]).html(), captchaValues)
						var y = $.inArray($(captcha[1]).html(), captchaValues)
						
						if((x >= 0) && (y >= 0)) {
							x += 1
							y += 1
							
							if(Number(userCaptcha.val()) == (Number(x) + Number(y))) {
								$(userCaptcha).removeClass('invalid').addClass('valid')
					    		form.submit();
							} else {
								$(form).find('#warning').addClass('show');
								$(userCaptcha).removeClass('valid').addClass('invalid')
								return false
							}
						} else {
							return false
						}
					} else {
				    	form.submit();
					}
			    },
			    invalidHandler: function(event, validator) {
			    	$('form').find('.warning').addClass('show');
			    	console.log(event)
			    }
			})
			
		};
		
	/* ****************************************************************** */
	/* CAROUSELS
	/* ****************************************************************** */
	
		VICEPREMIER.ready.carousels = function() {
			
			// articles carousel
			var articleSwiper = new Swiper('.articles-carousel .swiper-container',{
				noSwiping: true,
				speed: 1600,
				noSwipingClass: 'no-swipe',
			});
			
			// main carousel
			var swiper = new Swiper('.main-carousel .swiper-container', {
				slidesPerView: 1,
				spaceBetween: 20,
				pagination: {
					el: '.main-carousel .swiper-pagination',
					clickable: true
				},
				autoplay: {
					delay: 3000,
					disableOnInteraction: true,
				},
				a11y: {
					paginationBulletMessage: 'Prejsť na slajd č. {{index}}',
				}
			});
			
			$('.articles-carousel .-nav li').click(function(){
				
				var clickedSlide    = $(this),
				    clickedSlideNum = clickedSlide.index();
				
				if(clickedSlide.hasClass('active')) {
					return false;
				} else {
					
					clickedSlide.closest('.-nav').find('li').removeClass('active');
					clickedSlide.addClass('active');
					articleSwiper.slideTo( clickedSlideNum,1000,false );
					
				}
				
			})
			
		};
		
	/* ****************************************************************** */
	/* NICE SELECT
	/* ****************************************************************** */
	
		VICEPREMIER.ready.niceSelect = function() {
			
			$('.select').niceSelect();
		
		};	
		
	/* ****************************************************************** */
	/* HREF JUMP
	/* ****************************************************************** */
	
		VICEPREMIER.ready.hrefJump = function() {
			function visible(element) {
				return $.expr.filters.visible(element) && !$(element).parents().addBack().filter(function() {
					return $.css(this, 'visibility') === 'hidden';
				}).length;
			}
		
			function focusable(element, isTabIndexNotNaN) {
				var map, mapName, img, nodeName = element.nodeName.toLowerCase();
				if ('area' === nodeName) {
					map = element.parentNode;
					mapName = map.name;
					if (!element.href || !mapName || map.nodeName.toLowerCase() !== 'map') {
						return false;
					}
					img = $('img[usemap=#' + mapName + ']')[0];
					return !!img && visible(img);
				}
				return (/input|select|textarea|button|object/.test(nodeName) ?
					!element.disabled :
					'a' === nodeName ?
						element.href || isTabIndexNotNaN :
						isTabIndexNotNaN) &&
					// the element and all of its ancestors must be visible
					visible(element);
			}
		
			$.extend($.expr[':'], {
				focusable: function(element) {
					return focusable(element, !isNaN($.attr(element, 'tabindex')));
				}
			});

			$('.data-focus').on('click', function (e) {
				e.preventDefault()
				$($(this).attr('href')).find(':focusable').first().focus();
			})
		
		};	
		
	/* ****************************************************************** */
	/* MATCH HEIGHT
	/* ****************************************************************** */
	
		VICEPREMIER.ready.matchHeight = function() {
			
			$('.related .posts-list > ul > li').matchHeight({
				byRow: true,
				property: 'height',
				target: null,
				remove: false
			});
		
		};	
		
	/* ****************************************************************** */
	/* FANCYBOX
	/* ****************************************************************** */
	
		$('[data-fancybox="gallery"]').fancybox({
			loop : false,
			thumbs : {
				autoStart: true,
			    hideOnClose: true, 
			    parentEl: ".fancybox-container", 
			    axis: "x"
			},
			buttons: [
			    "zoom",
			    // "share",
			    // "slideShow",
			    // "fullScreen",
			    // "download",
			    "thumbs",
			    "close"
			  ],
		})	
		
	/* ****************************************************************** */
	/* SEARCH
	/* ****************************************************************** */
	
		VICEPREMIER.ready.search = function() {
			
			$('#formSend').click(function(e){
				if(layoutVersion === 'graphic') {
					e.preventDefault()
					e.stopPropagation()
					

					if(($('input[name=search]').val().length > 0) && ($('.site-search').hasClass('active'))){
						$('form.search').submit()
					} else {
						$('.site-search').toggleClass('active').find('input').stop().fadeToggle(400,"linear");
						$('.site-search input[name=search]').focus()
					}
				}
			})
		
		};	
		
	/* ****************************************************************** */
	/* SUB NAV
	/* ****************************************************************** */
	
		VICEPREMIER.ready.subNav = function() {
			
			$('.small-nav .menu-item-has-children > a').click(function(){
				$(this).closest('li').toggleClass('active').children('ul').stop().slideToggle();
				

				if($(this).closest('li').hasClass('active')) {
					$(this).closest('li').find('> a[aria-expanded]').attr('aria-expanded', 'true')
				} else  {
					$(this).closest('li').find('> a[aria-expanded]').attr('aria-expanded', 'false')
				}

				return false;
				
			});
		
		};	
		
	/* ****************************************************************** */
	/* NEWS REDIRECT
	/* ****************************************************************** */
	
		VICEPREMIER.ready.aktuality = function() {
			
			$('#select-aktuality').on('change', function(e){
				e.preventDefault();
				
				window.location.href = $(this).val()
			});
		
		};
		
	/* ****************************************************************** */
	/* YOTUBE BLOCK
	/* ****************************************************************** */
	
		VICEPREMIER.ready.youtube_block = function() {
			
			$('.youtube[data-href]').each(function(e) {
				var $youtubeBlock = $(this).parent()
				
				var $iframe = $('<iframe/>', {
					src: $(this).data('href'),
					allowfullscreen: ''
				})
				
				$youtubeBlock.html($iframe)
			})
		
		};
		

		
	/* ****************************************************************** */
	/* SEARCH EXPORT
	/* ****************************************************************** */
		VICEPREMIER.ready.news = function() {
	    	$('#wp-admin-bar-generate-search a').on('click', function(e) {
	    	    var element = $('<div/>')
	    	    
	    	    element.css({
	    	        'position': 'fixed',
	    	        'width': '100vw',
	    	        'height': '100vh',
	    	        'cursor': 'wait',
	    	        'background': 'rgba(255,255,255,.65)',
	    	        'top': '0',
	    	        'left': '0',
	    	        'z-index': '100000'
	    	    })
	    	    
	    	    $('body').append(element)
	    	    
	    		e.preventDefault()
	    		
	    		$.ajax({
	    		    url: $(this).prop('href')
	    		}).done(function(data) {
	    		    element.remove()
	                if(data == '1') {
	                    alert('Úspešne vyexportované!')
	                } else {
	                    alert('Export sa nepodaril!')
	                }
	    		}).error(function(data) {
	    		    element.remove()
	                alert('Export sa nepodaril!')
	    		})
	    	})
		}
		
	/* ****************************************************************** */
	/* MAIN NAV
	/* ****************************************************************** */
	
		VICEPREMIER.ready.mainNav = function() {
			
			function hideMenu() {
				$('#site-nav nav  a').removeClass('active');
				$('.menu-item-has-children').removeClass('active')
				$('#site-nav nav .-mega-widget li').removeClass('active')
				$('#site-nav .megamenu').removeClass('open');
				$('#site-nav').removeClass('menu-open');
				$('.hamburger').removeClass('is-active');
				$('#header').removeClass('menuOpen');
				$('*[aria-expanded=true]').attr('aria-expanded', 'false')
				$('.-mega-widget .-title').removeClass('open').next('ul').slideUp();
				$('.-mega-widget .menu-item-has-children > a').closest('li').removeClass('active').children('ul').slideUp();
				$('#site-nav nav > ul > li.menu-item-has-children > a').next('.megamenu').stop().slideUp()
			}

			// hamburger
			$('.hamburger').click(function(){
				$(this).toggleClass('is-active');
				$('#site-nav').stop().slideToggle(900);
				
				return false;
				
			})
			
			$('.backBttn').click(function(){
				$(this).closest('.megamenu').removeClass('open').closest('#site-nav').removeClass('menu-open').find('.menu-item-has-children.active').removeClass('active');
			})
			
			$('#site-nav nav > ul > li.menu-item-has-children > a').click(function(){
				
				if (Modernizr.mq('only screen and (min-width: 1281px)')) {
					$(this).parent().siblings('.menu-item-has-children').find('a').removeClass('active').next('.megamenu').slideUp()
					$('*[aria-expanded=true]').attr('aria-expanded', 'false')
				}
				
				$(this).toggleClass('active');
				
				var megamenu = $(this).next('.megamenu');
				
				if (Modernizr.mq('only screen and (min-width: 1281px)')) {
					megamenu.stop().slideToggle(900);
				} else {
					megamenu.toggleClass('open').closest('.menu-item-has-children').toggleClass('active').closest('#site-nav').toggleClass('menu-open');
				}

				if($('#site-nav  nav>ul>.menu-item-has-children>a').hasClass('active')) {
					$('#site-nav  nav>ul>.menu-item-has-children>a').attr('aria-expanded', 'true')
					$('#header').addClass('menuOpen');
				} else  {
					$('#header').removeClass('menuOpen');
				}
				
				return false;
			})
			
			$('.-mega-widget .menu-item-has-children > a').click(function(){
				var clickedLink = $(this);
				
				clickedLink.closest('li').toggleClass('active').children('ul').slideToggle();

				if(clickedLink.closest('li').hasClass('active')) {
					clickedLink.closest('li').find('> a[aria-expanded]').attr('aria-expanded', 'true')
				} else  {
					clickedLink.closest('li').find('> a[aria-expanded]').attr('aria-expanded', 'false')
				}
				
				return false;
			})
			
			$('.-mega-widget .-title').click(function(){
				if (Modernizr.mq('only screen and (max-width: 767px)')) {
					$(this).toggleClass('open').next('ul').slideToggle();
				}
			})

			$(document).keyup(function(e) {
				if (e.key === "Escape") { 
					if((remodalItem  !== null) && (remodalItem.getState() === 'closing')) {
						$('a[data-remodal-target=filter]').focus();
					} else {
						hideMenu()
					}
					
					if($(':focus').attr('name') === 'search') {
						if(layoutVersion === 'graphic') {
							e.preventDefault()
							e.stopPropagation()
							
		
							$('input[name=search]').val('')

							$('.site-search').toggleClass('active').find('input').stop().fadeToggle(400,"linear");
							$('#formSend').focus()
						}
					}
			   }
		   });

		   $(document).ready(function() {

				$(document).on("click",'#header.menuOpen~.shadow', function(e) {
					hideMenu()
				})

				$( window ).resize(function() {
					hideMenu()

					
				})



				$('.replaced-image').find('img').each(function(){
					var imgClass = (this.height < ($(this).parent().outerHeight())) ? 'wide' : 'tall';
					$(this).removeClass('wide').removeClass('tall').addClass(imgClass);
				})

				remodalItem = $('[data-remodal-id=filter]').remodal();
			})
		};	
		
		
	/* ****************************************************************** */
	/* Run functions on ready
	/* ****************************************************************** */
	
		$( document ).ready(function() {
			
			for (var function_name in VICEPREMIER.ready) {
				if (VICEPREMIER.ready.hasOwnProperty(function_name)) {
			        VICEPREMIER.ready[function_name]();
			    }
			}

			$('.replaced-image').find('img').each(function(){
				var imgClass = (this.height < ($(this).parent().outerHeight())) ? 'wide' : 'tall';
				$(this).addClass(imgClass);
			})

			$('img.icon-alternative').on('mouseenter mouseleave', function() {
				var oldSrc = $(this).attr('src')
				var newSrc = $(this).attr('data-hover-image')

				$(this).attr('src', newSrc)
				$(this).attr('data-hover-image', oldSrc)
			});

			$('.small-nav a[aria-expanded=true').closest('li').addClass('active')

			$('.swiper-pagination span[aria-label]').each(function(i,e) {
				var numSlide = $(e).attr('aria-label').replace( /^\D+/g, '');
				numSlide = Number(numSlide)

				if(!isNaN(numSlide)) {
					numSlide--

					var slide = $('*[data-tag-c' + numSlide + ']');

					if(slide.length) {
						$(this).attr('aria-label', $(slide).attr('data-tag-c' + numSlide))
					}
				}
			})

			if(typeof getUrlParameter('thank') !== 'undefined') {
				$('.success-info').removeClass('hidden');
			}
		})

		$(window).keypress(function(e) {
			if (e.which === 32) {
				
				if($("*[tabindex]:focus").length) {
					$("*[tabindex]:focus").click()
				}
				
			}


		});

		function getUrlParameter(sParam) {
			var sPageURL = window.location.search.substring(1),
				sURLVariables = sPageURL.split('&'),
				sParameterName,
				i;
		
			for (i = 0; i < sURLVariables.length; i++) {
				sParameterName = sURLVariables[i].split('=');
		
				if (sParameterName[0] === sParam) {
					return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
				}
			}
		};

})(jQuery, this);