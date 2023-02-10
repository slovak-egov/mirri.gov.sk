$(function() { 
    var $circle, $this;
    //VIDEO HOVER
    $('.video_hover')   
        .on('mouseenter', function(){
            ishover = true;
            $this =  $(this);
            $circle = $(this).find('video').parent();
        })
        .on('mouseleave', function(event){
            ishover = false;
            $circle.removeAttr('style');
        })
        .on('mousemove', function(event){
            requestAnimationFrame(function(){
                rect = $this[0].getBoundingClientRect();
                offsetX = event.clientX - rect.left,
                offsetY  = event.clientY - rect.top;
                if(ishover) circleMove($circle, offsetX, offsetY); 
            });
        });

    function circleMove($circle, x, y){
        $circle.css('transform', 'translate(' + x/8 + 'px, ' + y/4 + 'px)')
    }

    $(window).on('resize.video', function(){
        if($(window).width() < 1101) {
            $('.video_hover video').each(function(){
                $(this).attr('autoplay', true);
                $(this)[0].play();
            });
                           
        } else {
            
            var is_playing = $(this)[0].currentTime > 0 || $(this)[0].readyState > $(this)[0].HAVE_CURRENT_DATA;
            $('.video_hover video').each(function(){
                if(is_playing) {
                    $(this)[0].pause();
                    $(this)[0].currentTime = 0;    
                }   
            });  
        }
    }).trigger('resize.video');
   
});
