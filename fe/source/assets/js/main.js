//INTERSECTION
!function(){"use strict";if("object"==typeof window)if("IntersectionObserver"in window&&"IntersectionObserverEntry"in window&&"intersectionRatio"in window.IntersectionObserverEntry.prototype)"isIntersecting"in window.IntersectionObserverEntry.prototype||Object.defineProperty(window.IntersectionObserverEntry.prototype,"isIntersecting",{get:function(){return 0<this.intersectionRatio}});else{var g=window.document,e=[];t.prototype.THROTTLE_TIMEOUT=100,t.prototype.POLL_INTERVAL=null,t.prototype.USE_MUTATION_OBSERVER=!0,t.prototype.observe=function(e){if(!this._observationTargets.some(function(t){return t.element==e})){if(!e||1!=e.nodeType)throw new Error("target must be an Element");this._registerInstance(),this._observationTargets.push({element:e,entry:null}),this._monitorIntersections(),this._checkForIntersections()}},t.prototype.unobserve=function(e){this._observationTargets=this._observationTargets.filter(function(t){return t.element!=e}),this._observationTargets.length||(this._unmonitorIntersections(),this._unregisterInstance())},t.prototype.disconnect=function(){this._observationTargets=[],this._unmonitorIntersections(),this._unregisterInstance()},t.prototype.takeRecords=function(){var t=this._queuedEntries.slice();return this._queuedEntries=[],t},t.prototype._initThresholds=function(t){var e=t||[0];return Array.isArray(e)||(e=[e]),e.sort().filter(function(t,e,n){if("number"!=typeof t||isNaN(t)||t<0||1<t)throw new Error("threshold must be a number between 0 and 1 inclusively");return t!==n[e-1]})},t.prototype._parseRootMargin=function(t){var e=(t||"0px").split(/\s+/).map(function(t){var e=/^(-?\d*\.?\d+)(px|%)$/.exec(t);if(!e)throw new Error("rootMargin must be specified in pixels or percent");return{value:parseFloat(e[1]),unit:e[2]}});return e[1]=e[1]||e[0],e[2]=e[2]||e[0],e[3]=e[3]||e[1],e},t.prototype._monitorIntersections=function(){this._monitoringIntersections||(this._monitoringIntersections=!0,this.POLL_INTERVAL?this._monitoringInterval=setInterval(this._checkForIntersections,this.POLL_INTERVAL):(n(window,"resize",this._checkForIntersections,!0),n(g,"scroll",this._checkForIntersections,!0),this.USE_MUTATION_OBSERVER&&"MutationObserver"in window&&(this._domObserver=new MutationObserver(this._checkForIntersections),this._domObserver.observe(g,{attributes:!0,childList:!0,characterData:!0,subtree:!0}))))},t.prototype._unmonitorIntersections=function(){this._monitoringIntersections&&(this._monitoringIntersections=!1,clearInterval(this._monitoringInterval),this._monitoringInterval=null,o(window,"resize",this._checkForIntersections,!0),o(g,"scroll",this._checkForIntersections,!0),this._domObserver&&(this._domObserver.disconnect(),this._domObserver=null))},t.prototype._checkForIntersections=function(){var h=this._rootIsInDom(),c=h?this._getRootRect():r();this._observationTargets.forEach(function(t){var e=t.element,n=_(e),o=this._rootContainsTarget(e),i=t.entry,r=h&&o&&this._computeTargetAndRootIntersection(e,c),s=t.entry=new a({time:window.performance&&performance.now&&performance.now(),target:e,boundingClientRect:n,rootBounds:c,intersectionRect:r});i?h&&o?this._hasCrossedThreshold(i,s)&&this._queuedEntries.push(s):i&&i.isIntersecting&&this._queuedEntries.push(s):this._queuedEntries.push(s)},this),this._queuedEntries.length&&this._callback(this.takeRecords(),this)},t.prototype._computeTargetAndRootIntersection=function(t,e){if("none"!=window.getComputedStyle(t).display){for(var n,o,i,r,s,h,c,a,u=_(t),l=m(t),d=!1;!d;){var p=null,f=1==l.nodeType?window.getComputedStyle(l):{};if("none"==f.display)return;if(l==this.root||l==g?(d=!0,p=e):l!=g.body&&l!=g.documentElement&&"visible"!=f.overflow&&(p=_(l)),p&&(n=p,o=u,void 0,i=Math.max(n.top,o.top),r=Math.min(n.bottom,o.bottom),s=Math.max(n.left,o.left),h=Math.min(n.right,o.right),a=r-i,!(u=0<=(c=h-s)&&0<=a&&{top:i,bottom:r,left:s,right:h,width:c,height:a})))break;l=m(l)}return u}},t.prototype._getRootRect=function(){var t;if(this.root)t=_(this.root);else{var e=g.documentElement,n=g.body;t={top:0,left:0,right:e.clientWidth||n.clientWidth,width:e.clientWidth||n.clientWidth,bottom:e.clientHeight||n.clientHeight,height:e.clientHeight||n.clientHeight}}return this._expandRectByRootMargin(t)},t.prototype._expandRectByRootMargin=function(n){var t=this._rootMarginValues.map(function(t,e){return"px"==t.unit?t.value:t.value*(e%2?n.width:n.height)/100}),e={top:n.top-t[0],right:n.right+t[1],bottom:n.bottom+t[2],left:n.left-t[3]};return e.width=e.right-e.left,e.height=e.bottom-e.top,e},t.prototype._hasCrossedThreshold=function(t,e){var n=t&&t.isIntersecting?t.intersectionRatio||0:-1,o=e.isIntersecting?e.intersectionRatio||0:-1;if(n!==o)for(var i=0;i<this.thresholds.length;i++){var r=this.thresholds[i];if(r==n||r==o||r<n!=r<o)return!0}},t.prototype._rootIsInDom=function(){return!this.root||i(g,this.root)},t.prototype._rootContainsTarget=function(t){return i(this.root||g,t)},t.prototype._registerInstance=function(){e.indexOf(this)<0&&e.push(this)},t.prototype._unregisterInstance=function(){var t=e.indexOf(this);-1!=t&&e.splice(t,1)},window.IntersectionObserver=t,window.IntersectionObserverEntry=a}function a(t){this.time=t.time,this.target=t.target,this.rootBounds=t.rootBounds,this.boundingClientRect=t.boundingClientRect,this.intersectionRect=t.intersectionRect||r(),this.isIntersecting=!!t.intersectionRect;var e=this.boundingClientRect,n=e.width*e.height,o=this.intersectionRect,i=o.width*o.height;this.intersectionRatio=n?Number((i/n).toFixed(4)):this.isIntersecting?1:0}function t(t,e){var n,o,i,r=e||{};if("function"!=typeof t)throw new Error("callback must be a function");if(r.root&&1!=r.root.nodeType)throw new Error("root must be an Element");this._checkForIntersections=(n=this._checkForIntersections.bind(this),o=this.THROTTLE_TIMEOUT,i=null,function(){i=i||setTimeout(function(){n(),i=null},o)}),this._callback=t,this._observationTargets=[],this._queuedEntries=[],this._rootMarginValues=this._parseRootMargin(r.rootMargin),this.thresholds=this._initThresholds(r.threshold),this.root=r.root||null,this.rootMargin=this._rootMarginValues.map(function(t){return t.value+t.unit}).join(" ")}function n(t,e,n,o){"function"==typeof t.addEventListener?t.addEventListener(e,n,o||!1):"function"==typeof t.attachEvent&&t.attachEvent("on"+e,n)}function o(t,e,n,o){"function"==typeof t.removeEventListener?t.removeEventListener(e,n,o||!1):"function"==typeof t.detatchEvent&&t.detatchEvent("on"+e,n)}function _(t){var e;try{e=t.getBoundingClientRect()}catch(t){}return e?(e.width&&e.height||(e={top:e.top,right:e.right,bottom:e.bottom,left:e.left,width:e.right-e.left,height:e.bottom-e.top}),e):r()}function r(){return{top:0,bottom:0,left:0,right:0,width:0,height:0}}function i(t,e){for(var n=e;n;){if(n==t)return!0;n=m(n)}return!1}function m(t){var e=t.parentNode;return e&&11==e.nodeType&&e.host?e.host:e&&e.assignedSlot?e.assignedSlot.parentNode:e}}();

/* http://benalman.com/projects/jquery-throttle-debounce-plugin/ */
(function(b,c){var $=b.jQuery||b.Cowboy||(b.Cowboy={}),a;$.throttle=a=function(e,f,j,i){var h,d=0;if(typeof f!=="boolean"){i=j;j=f;f=c}function g(){var o=this,m=+new Date()-d,n=arguments;function l(){d=+new Date();j.apply(o,n)}function k(){h=c}if(i&&!h){l()}h&&clearTimeout(h);if(i===c&&m>e){l()}else{if(f!==true){h=setTimeout(i?k:l,i===c?e-m:e)}}}if($.guid){g.guid=j.guid=j.guid||$.guid++}return g};$.debounce=function(d,e,f){return f===c?a(d,e,false):a(d,f,e!==false)}})(this);

$(function() { 

    var $window = $(window),
        $html   = $('html'),
        $body   = $('body'),
        st      = $window.scrollTop(),
        lastScrollTop = 0,  
        $header = $('.header_inner'),
        header_height = $('.header_inner').height(),
        is_scrolled   = false,
        ww            = $window.width(),
        wh            = $window.height(),
        animdelay_time  = 150,
        animdelay_count = 0,
        animdelay;  
    
    //OBSERVER    
    var observer = new window.IntersectionObserver(function(entries, self) {   
        entries.forEach(function (entry) { 
                
            if (entry.isIntersecting) {   
                if((entry.intersectionRatio == 1 && $(entry.target).hasClass('observe_full')) || !$(entry.target).hasClass('observe_full')) {
                    $(entry.target).addClass('intersecting');                    
                    if($(entry.target).hasClass('observe-count') && !$(entry.target).hasClass('anim_delay')) countup($(entry.target));
                    self.unobserve(entry.target);  
                    
                    if(entry.intersectionRatio == 1 && $(entry.target).hasClass('observe_full')){
                        $('.observe_sub', $(entry.target)).each(function(){
                            observer.observe($(this)[0]);    
                        });                        
                    }

                    if($(entry.target).hasClass('anim_delay')) {
                        clearTimeout(animdelay);   
                        animdelay_count++;
                        if($(entry.target).hasClass('observe-count')) {
                            setTimeout(function(){
                                countup($(entry.target))
                            }, (animdelay_count*animdelay_time) + ($(entry.target).data('animdelay-offset') || 0));
                        } else {
                            $(entry.target).css('animation-delay', (animdelay_count*animdelay_time) + ($(entry.target).data('animdelay-offset') || 0) + 'ms'); 
                        }               
                        animdelay = setTimeout(function(){
                            animdelay_count = 0;    
                        },20);
                    }
                }
            }
        }); 
    }, {"threshold": [0,1]});   
    
    $('.observe').each(function(){
        if($(this).hasClass('observe-count')) $(this).html('0'); 
        observer.observe($(this)[0]);    
    });

    //COUNT UP
    function countup($elm){
        new CountUp(
                $elm[0], 
                0,
                $elm.data('countup-num'),
                $elm.data('countup-dec'), 
                $elm.data('countup-dur'),
                {
                    decimal : $elm.data('countup-comma') || ',', 
                    separator : $elm.data('countup-sep') || '', 
                    useEasing : false
                }
            )
        .start();    
    } 

    //WIN RESIZE    
    $window
        .on( 'resize.resizing', $.debounce( 250, true, function(e){
            $body.addClass( 'resizing' );        
        }))
        .on( 'resize.resizing', $.debounce( 250, false, function(e){
            $body.removeClass( 'resizing' );
        }));

    //WIN SCROLL
    $window.on('resize', function(){
        wh = $window.height(); 
        ww = $window.width();
        header_height = $header.height();
    }).trigger('resize'); 
    
    //WIN SCROLL
    $window.on('scroll', function(){
        st = $window.scrollTop();    
        if(st < 0) st = 0;      
        scrolled();
        
        if (st > lastScrollTop || st == 0){
            $body.removeClass('scrollup');     
        } else {
            if((st - lastScrollTop) < -5) {
                $body.addClass('scrollup');    
            }                    
        }
        
        if(st > header_height){
            if(!$body.hasClass('fixheader')) {
                $header.addClass('notransition');             
                $body.addClass('fixheader');
                $header[0].offsetHeight; 
                $header.removeClass('notransition');   
            }
        } else {
            $body.removeClass('fixheader');
        }            
        lastScrollTop = st;       
    }).trigger('scroll');  
    
    //TOGGLE MENU
    $('.toggle-menu').on('click', function(e){
        e.preventDefault();
        $html.toggleClass('menuopen');
    });  

    //TOGGLE POPUP
    $('.toggle-popup').on('click', function(e){
        e.preventDefault();
        $html.toggleClass('popupopen');
    });  

    if($('[data-popup-onload="true"]').length) $html.toggleClass('popupopen');

    //SIDE NAV
    $('.sidemenu').each(function(){
        var $anchors = $('.has-submenu > a', $(this)),
            $button  = $('.sidemenu_button', $(this)),
            $list    = $('.sidemenu_list', $(this));
        
        $anchors.on('click', function(e){
            e.preventDefault();
            var $li = $(this).closest('li');
            if($li.hasClass('expanded')) {
                $li.removeClass('expanded');
                $li.find('> ul').stop().slideUp(300, function(){
                    $(this).removeClass('opened').removeAttr('style');
                });
            } else {
                $li.addClass('expanded');
                $li.find('> ul').stop().slideDown(300, function(){
                    $(this).addClass('opened').removeAttr('style');
                });
            }
        });  

        $button.on('click', function(e){          
            if($button.hasClass('expanded')) {
                $button.removeClass('expanded');
                $list.stop().slideUp(300, function(){
                    $(this).removeClass('opened').removeAttr('style');
                });
            } else {
                $button.addClass('expanded');
                $list.stop().slideDown(300, function(){
                    $(this).addClass('opened').removeAttr('style');
                });
            }
        });  
    });

    //VIDEO HOVER
    $('.video_hover')
        .on('mouseenter', function(e){
            clearTimeout($(this)[0].videotimer);
            var $video = $(this).find('video');
            $video[0].play();
        })
        .on('mouseleave', function(e){
            clearTimeout($(this)[0].videotimer);
            var $video = $(this).find('video');
            $(this)[0].videotimer = setTimeout(function(){
                var is_playing = $video[0].currentTime > 0 || $video[0].readyState > $video[0].HAVE_CURRENT_DATA;
                if(is_playing) {
                    $video[0].pause();
                    $video[0].currentTime = 0;    
                }                
            }, 300);
        });

    //FOCUS SELECT
    $('[data-toggle-parent-class]').on('click', function(e){
        e.preventDefault();
        $(this).parent().toggleClass($(this).data('toggle-parent-class'));
    });

    //SCROLLED
    function scrolled(){  
        if($window.scrollTop() > 0){
            if(!is_scrolled) {
                is_scrolled = true;
                $body.addClass('scrolled');
            }
        } else {
            if(is_scrolled) {
                is_scrolled = false;  
                $body.removeClass('scrolled');              
            }                 
        }   
    }
   
    //SLIDER
    $('.slider-custom').each(function(){
        var $this = $(this);     
       
        if($this.hasClass('slider-img-preload')) {
            preload($('img', $this).map(function(){return $(this).attr('src')}), 0, function(){
                console.log('done');
                createSlider($this);
            });    
        } else {
            createSlider($this);
        }        
    });      

    //CLICKERs   
    $('.clicker').clicker(); 
    
    //PAGE ANCHORS
    $('.topmenu a, [data-scrollto]').on('click', function(e) {    
        $html.removeClass('menuopen');                                 
    });  
    
    //FOCUS SELECT
    $('.focus_select').on('focus', function(){
        $(this).trigger('select');
    })
    .on('mouseup', function (e) {     
        e.preventDefault();
    });   
    
    //ADD GMAP     
    if($('.map.init').length) {
        var script = document.createElement('script');          
        script.src = BASE_URL_ASSETS + 'js/location.js';
        document.body.appendChild(script);   
    }    

    //GALLERY
    $(document).on('click','[data-pswp-index]',function(event){
        var data = $(this).closest('[data-pswp-gallery]').data('pswp-gallery');
        event.preventDefault();

        var options = {                                     
                index: $(this).data('pswp-index'),
                bgOpacity: 0.85,
                showHideOpacity: true, 
                history:false
            };

        var $pswp = $('.pswp')[0];
        var gallery = new PhotoSwipe($pswp, PhotoSwipeUI_Default, data, options);
            gallery.init();
    });     

    //SVG ANIM
    $('.svganim').each(function(){
        var $this = $(this);
        $this.find('path:not(.ignore)').each(function(){
            var elm = $(this)[0];
            elm.setAttribute('style', 'stroke-dasharray:'+elm.getTotalLength()+';stroke-dashoffset:'+elm.getTotalLength())
        })      
        $this.addClass('ready');
    });
   
});

//CREATE SLIDER
function createSlider($this) {

    if($this.hasClass('slider-ready')) {         
        return false;
    }

    var obj     = {},
        $par    = $this.parent();
        options = {                
            loop: true,
            speed: 1000,
            slidesPerView: 'auto',
            spaceBetween: 0             
        },
        optionsFade = {
            effect: 'fade'
        },
        optionsCenter = {
            centeredSlides: true,
        },
        settings_obj = $this.data('swiper-settings');
    
    $.extend( true, obj, options );

    if(typeof settings_obj === 'object' && settings_obj !== null) {

        $.extend( true, obj, settings_obj );
    
        if(settings_obj.fade) {
            $.extend( true, obj, optionsFade );
        }  
        
        if(settings_obj.center) {
            $.extend( true, obj, optionsCenter );
        }
    }

    //PARALLAX
    if(obj.parallax) {
        obj.grabCursor = true,            
        obj.watchSlidesProgress  = true;
        obj.on = {
            progress: function(){
                let swiper = this;
                for (let i = 0; i < swiper.slides.length; i++) {
                let slideProgress = swiper.slides[i].progress,
                    innerOffset = swiper.width * .5,
                    innerTranslate = slideProgress * innerOffset;
                
                swiper.slides[i].querySelector(".para-move").style.transform =
                    "translateX(" + innerTranslate + "px)";
                }
            },
            touchStart: function() {
                let swiper = this;
                for (let i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = "";
                }
            },
            setTransition: function(swiper, transition) {
                
                for (let i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = transition + "ms";                        
                    swiper.slides[i].querySelector(".para-move").style.transition = transition + "ms";
                }
            }
        };         
    }     

    if(obj.pagination) {
        obj.pagination.clickable = true;
    }

    if(obj.closestNextEl) {
        obj.navigation = {"nextEl": $(obj.closestNextEl, $par)[0], "prevEl": $(obj.closestPrevEl, $par)[0]};
    }                

    //INIT SLIDER
    var slider = new Swiper($this[0], obj);
    $this
        .addClass('slider-ready')
        .data('swiper', slider);

    $this.trigger('swiperready');

    if(obj.svgcircle) {
        var $svgcircle = $(obj.svgcircle), delay = 5000;

        if(obj.autoplay) delay = obj.autoplay.delay;
        $svgcircle.css('animation-duration', ((delay) + 1000)  + 'ms');
        $svgcircle.addClass('drawcircle');   

        slider.on('slideChange', function () {
            $svgcircle.removeClass('drawcircle'); 
            $svgcircle.outerHeight();
            $svgcircle.addClass('drawcircle');   
        });
    }

    if(obj.pauseHover) {
        var $elmpause = $this;

        if(obj.pauseHoverElm) {
            $elmpause = $(obj.pauseHoverElm);
        }

        $elmpause
            .on('mouseenter', function(){
                slider.autoplay.stop();            
            })
            .on('mouseleave', function(){
                slider.autoplay.start();              
            });
    }

    if(obj.buttons) {
        var $buttons = $(obj.buttons);

        $buttons.eq(0).addClass('active');

        if(obj.autoplay && obj.autoplay.delay) {
            $buttons.find('.icon_circle_circle circle:last-child').css('animation-duration', obj.autoplay.delay + 'ms')    
        }

        $buttons.on('click', function(e) {    
            e.preventDefault();
            var $this = $(this);
            if(!$this.hasClass('active')) {                
                slider.slideTo($buttons.index($(this))+1);
                if(obj.autoplay) slider.autoplay.start();   
            }        
        });

        slider.on('slideChange', function (v) {
            $buttons.removeClass('active');
            $buttons.eq(v.realIndex).addClass('active');
        });
      
    }

    if(obj.youtube) {
      
        $(obj.youtube).addClass('loading');

        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        window.onYouTubeIframeAPIReady = function(){

            var $players = $this.find('iframe')
                players = [];

            $players.each(function(){
                var player = new YT.Player(this);
                players.push(player);                
            });
            
            slider.on('slideChange', function () {
                $.each(players,function(i, v){                    
                    v.pauseVideo(); 
                });       
            });

            $(obj.youtube).removeClass('loading');
        }
    }

    if(obj.fraction) {
        $(obj.fraction).html( leadingeZero(slider.realIndex + 1) + '/<span>' + leadingeZero(slider.slides.length) + '</span>' );
        slider.on('slideChange', function () {
            slider.on('slideChangeTransitionStart', function () {
                $(obj.fraction).html( leadingeZero(slider.realIndex + 1) + '/<span>' + leadingeZero(slider.slides.length) + '</span>' );
            });            
        });
    }

    if(obj.progresswatch) {
        slider.on('paginationUpdate', function (s, e) {
            if(slider.virtualSize > slider.width) $(e).addClass('show').removeClass('hide');
            else $(e).addClass('hide').removeClass('show');  
        });
        if(slider.virtualSize > slider.width) $(slider.pagination.el).addClass('show').removeClass('hide');
        else $(slider.pagination.el).addClass('hide').removeClass('show');    
    }

}  


function leadingeZero(n){
    return n > 9 ? "" + n: "0" + n;
}

//PRELOAD
function preload(imageArray, index, callback) {
    index = index || 0;    
    if (imageArray && imageArray.length > index) {
        var img = new Image ();
        img.onload = function() {
            preload(imageArray, index + 1, callback);
        }
        img.src = imageArray[index];
    } else {   
        if (typeof callback == 'function') { 
            callback(); 
        }
    }
}

function randomIntFromInterval(min, max) { // min and max included 
    return Math.floor(Math.random() * (max - min + 1) + min)
}

/*CLICKER PLUGIN*/
(function($) {

    $.fn.clicker = function(method) {   
             
        this.each(function() {       
            create_clicker($(this));
        });

        function create_clicker($elm) {

            $elm.on('click.clicker', function(e){             
                e.preventDefault();

                var cd  = 'cdone',
                    cm  = this.dataset.class || 'cactive',
                    par = this.parentNode,
                    rcp = function(event){
                        if(!par.contains(event.target)){                
                            par.classList.remove(cm);
                            par.classList.remove(cd);
                            document.removeEventListener('mousedown', rcp);               
                        }                         
                    };  
            
                if(par.classList.contains(cm)) {
                    par.classList.remove(cm);
                    par.classList.remove(cd);
                    document.removeEventListener('mousedown', rcp);
                } else {
                    par.classList.add(cm);
                    par.offsetHeight;
                    par.classList.add(cd);
                    document.addEventListener('mousedown', rcp);

                    if($elm.data('focus')) {                        
                        $( $elm.data('focus') ).focus();    
                    }
                }  
            });  
        }
    }

}(jQuery));

function create_range() {
    var arr = [];
    for (let i=0; i<=1.0; i+= 0.01) {
        arr.push(i);
    }
    return arr;
} 

(function($) {

    // Matches trailing non-space characters.
    var chop = /(\s*\S+|\s)$/;
  
    // Matches the first word in the string.
    var start = /^(\S*)/;
  
    // Return a truncated html string.  Delegates to $.fn.truncate.
    $.truncate = function(html, options) {
      return $('<div></div>').append(html).truncate(options).html();
    };
  
    // Truncate the contents of an element in place.
    $.fn.truncate = function(options) {
      if ($.isNumeric(options)) options = {length: options};
      var o = $.extend({}, $.truncate.defaults, options);
  
      return this.each(function() {
        var self = $(this);
  
        if (o.noBreaks) self.find('br').replaceWith(' ');
  
        var text = self.text();
        var excess = text.length - o.length;
  
        if (o.stripTags) self.text(text);
  
        // Chop off any partial words if appropriate.
        if (o.words && excess > 0) {
          var truncated = text.slice(0, o.length).replace(chop, '').length;
  
          if (o.keepFirstWord && truncated === 0) {
            excess = text.length - start.exec(text)[0].length - 1;
          } else {
            excess = text.length - truncated - 1;
          }
        }
  
        if (excess < 0 || !excess && !o.truncated) return;
  
        // Iterate over each child node in reverse, removing excess text.
        $.each(self.contents().get().reverse(), function(i, el) {
          var $el = $(el);
          var text = $el.text();
          var length = text.length;
  
          // If the text is longer than the excess, remove the node and continue.
          if (length <= excess) {
            o.truncated = true;
            excess -= length;
            $el.remove();
            return;
          }
  
          // Remove the excess text and append the ellipsis.
          if (el.nodeType === 3) {
            // should we finish the block anyway?
            if (o.finishBlock) {
              $(el.splitText(length)).replaceWith(o.ellipsis);
            } else {
              $(el.splitText(length - excess - 1)).replaceWith(o.ellipsis);
            }
            return false;
          }
  
          // Recursively truncate child nodes.
          $el.truncate($.extend(o, {length: length - excess}));
          return false;
        });
      });
    };
  
    $.truncate.defaults = {
  
      // Strip all html elements, leaving only plain text.
      stripTags: false,
  
      // Only truncate at word boundaries.
      words: false,
  
      // When 'words' is active, keeps the first word in the string
      // even if it's longer than a target length.
      keepFirstWord: false,
  
      // Replace instances of <br> with a single space.
      noBreaks: false,
  
      // if true always truncate the content at the end of the block.
      finishBlock: false,
  
      // The maximum length of the truncated html.
      length: Infinity,
  
      // The character to use as the ellipsis.  The word joiner (U+2060) can be
      // used to prevent a hanging ellipsis, but displays incorrectly in Chrome
      // on Windows 7.
      // http://code.google.com/p/chromium/issues/detail?id=68323
      ellipsis: '\u2026' // '\u2060\u2026'
  
    };
  
  })(jQuery);

//https://github.com/inorganik/CountUp.js
!function(a,t){"function"==typeof define&&define.amd?define(t):"object"==typeof exports?module.exports=t(require,exports,module):a.CountUp=t()}(this,function(a,t,n){var e=function(a,t,n,e,i,r){for(var o=0,s=["webkit","moz","ms","o"],m=0;m<s.length&&!window.requestAnimationFrame;++m)window.requestAnimationFrame=window[s[m]+"RequestAnimationFrame"],window.cancelAnimationFrame=window[s[m]+"CancelAnimationFrame"]||window[s[m]+"CancelRequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(a,t){var n=(new Date).getTime(),e=Math.max(0,16-(n-o)),i=window.setTimeout(function(){a(n+e)},e);return o=n+e,i}),window.cancelAnimationFrame||(window.cancelAnimationFrame=function(a){clearTimeout(a)});var u=this;u.options={useEasing:!0,useGrouping:!0,separator:",",decimal:".",easingFn:null,formattingFn:null};for(var l in r)r.hasOwnProperty(l)&&(u.options[l]=r[l]);""===u.options.separator&&(u.options.useGrouping=!1),u.options.prefix||(u.options.prefix=""),u.options.suffix||(u.options.suffix=""),u.d="string"==typeof a?document.getElementById(a):a,u.startVal=Number(t),u.endVal=Number(n),u.countDown=u.startVal>u.endVal,u.frameVal=u.startVal,u.decimals=Math.max(0,e||0),u.dec=Math.pow(10,u.decimals),u.duration=1e3*Number(i)||2e3,u.formatNumber=function(a){a=a.toFixed(u.decimals),a+="";var t,n,e,i;if(t=a.split("."),n=t[0],e=t.length>1?u.options.decimal+t[1]:"",i=/(\d+)(\d{3})/,u.options.useGrouping)for(;i.test(n);)n=n.replace(i,"$1"+u.options.separator+"$2");return u.options.prefix+n+e+u.options.suffix},u.easeOutExpo=function(a,t,n,e){return n*(-Math.pow(2,-10*a/e)+1)*1024/1023+t},u.easingFn=u.options.easingFn?u.options.easingFn:u.easeOutExpo,u.formattingFn=u.options.formattingFn?u.options.formattingFn:u.formatNumber,u.version=function(){return"1.7.1"},u.printValue=function(a){var t=u.formattingFn(a);"INPUT"===u.d.tagName?this.d.value=t:"text"===u.d.tagName||"tspan"===u.d.tagName?this.d.textContent=t:this.d.innerHTML=t},u.count=function(a){u.startTime||(u.startTime=a),u.timestamp=a;var t=a-u.startTime;u.remaining=u.duration-t,u.options.useEasing?u.countDown?u.frameVal=u.startVal-u.easingFn(t,0,u.startVal-u.endVal,u.duration):u.frameVal=u.easingFn(t,u.startVal,u.endVal-u.startVal,u.duration):u.countDown?u.frameVal=u.startVal-(u.startVal-u.endVal)*(t/u.duration):u.frameVal=u.startVal+(u.endVal-u.startVal)*(t/u.duration),u.countDown?u.frameVal=u.frameVal<u.endVal?u.endVal:u.frameVal:u.frameVal=u.frameVal>u.endVal?u.endVal:u.frameVal,u.frameVal=Math.round(u.frameVal*u.dec)/u.dec,u.printValue(u.frameVal),t<u.duration?u.rAF=requestAnimationFrame(u.count):u.callback&&u.callback()},u.start=function(a){return u.callback=a,u.rAF=requestAnimationFrame(u.count),!1},u.pauseResume=function(){u.paused?(u.paused=!1,delete u.startTime,u.duration=u.remaining,u.startVal=u.frameVal,requestAnimationFrame(u.count)):(u.paused=!0,cancelAnimationFrame(u.rAF))},u.reset=function(){u.paused=!1,delete u.startTime,u.startVal=t,cancelAnimationFrame(u.rAF),u.printValue(u.startVal)},u.update=function(a){cancelAnimationFrame(u.rAF),u.paused=!1,delete u.startTime,u.startVal=u.frameVal,u.endVal=Number(a),u.countDown=u.startVal>u.endVal,u.rAF=requestAnimationFrame(u.count)},u.printValue(u.startVal)};return e});
