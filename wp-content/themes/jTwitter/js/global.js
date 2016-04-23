
jQuery(function($){
    /*** search form ****/
    if (!$('#s').val())
        $('#s').val('Search');
    $('#s').focus(function(){
        if ($(this).val() == 'Search')
            $(this).val('');
    });
    $('#s').blur(function(){
        if ($(this).val() == '')
            $(this).val('Search');
    });
    $('#searchform span.glass').click(function(){
        $('#searchform').submit();
    });

    /**** tip bar ****/
    $('#tip .stop').click(function(){
        $('#tip').slideUp('slow');
        $('#bodyWrap').animate({
            'top': '-40'
        }, 'slow');
        $.get("/ajax.php?action=stopTip");
        return false;
    });
    $('#toolBar .start').click(function(){
        $('#tip').slideDown('slow');
        $('#bodyWrap').animate({
            'top': '0'
        }, 'slow');
        $.get("/ajax.php?action=startTip");
        return false;
    });

    /*** subpage item onclick ***/
    $('#mainContent #list .item').click(function(){
        if ($('#mainContent .switch').hasClass('on') && $(this).hasClass('slidable'))
        {
            $('.arrow', this).click();
        }
        else
        {
            window.location = $('.thumbnail', this).attr('href');
        }
    });
    $('#sliding #list .item').live('click', function(){
        window.location = $('.thumbnail', this).attr('href');
    });
    $('.tags a').click(function(){
        $('#sliding').remove();
    });


    // slider
    $(window).load(function() {
        $('#slider').nivoSlider({
    //        effect:'random', // Specify sets like: 'fold,fade,sliceDown'
    //        slices:15, // For slice animations
    //        boxCols: 8, // For box animations
    //        boxRows: 4, // For box animations
            animSpeed:800, // Slide transition speed
            pauseTime:5000 // How long each slide will show
    //        startSlide:0, // Set starting Slide (0 index)
    //        directionNav:true, // Next & Prev navigation
    //        directionNavHide:true, // Only show on hover
    //        controlNav:true, // 1,2,3... navigation
    //        controlNavThumbs:false, // Use thumbnails for Control Nav
    //        controlNavThumbsFromRel:false, // Use image rel for thumbs
    //        controlNavThumbsSearch: '.jpg', // Replace this with...
    //        controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
    //        keyboardNav:true, // Use left & right arrows
    //        pauseOnHover:true, // Stop animation while hovering
    //        manualAdvance:false, // Force manual transitions
    //        captionOpacity:0.8, // Universal caption opacity
    //        prevText: 'Prev', // Prev directionNav text
    //        nextText: 'Next', // Next directionNav text
    //        beforeChange: function(){}, // Triggers before a slide transition
    //        afterChange: function(){}, // Triggers after a slide transition
    //        slideshowEnd: function(){}, // Triggers after all slides have been shown
    //        lastSlide: function(){}, // Triggers when last slide is shown
    //        afterLoad: function(){} // Triggers when slider has loaded
        });
    });


    /** hightlight tag if it is tag page **/
    var url = window.location;
    var pathname = url.pathname.split('/');
    var path = pathname[1];
    var tag = pathname[2];
    if (path == 'portfolio_tags' || path == 'tag')
    {
        $('.tags a, .tagcloud a, .tagcloud strong').each(function(){
            if ($(this).html() == tag)
                $(this).css('background-color', '#FFFF99');
        });
    }
    else if (path = 'portfolios' && !tag)
    {
        $('.tagcloud a').each(function(){
            if ($(this).html() == 'ALL')
                $(this).css('background-color', '#FFFF99');
        });
    }



    /** innerfade **/
    $.get('/wp-content/themes/jTwitter/ajax.twitter.php', function(data){
        $('#sidebar .tweets .innerfade').html(data).innerfade({
            speed: 3000,
            timeout: 4000,
            type: 'sequence',
            containerheight: '4em'
        });
    });


    /*** quick view ***/

    $('#profileBox .switch').click(function(){
        $(this).toggleClass('on');
        if ($(this).hasClass('on'))
        {
            $.get("/ajax.php?action=turnOnSwitch", function(){
                $('#profileBox .switch span').html('On');
                $('#list .item:not(.unslidable)').addClass('slidable');
                $('#list .item:first:not(.unslidable) .arrow').click();
                $('#list .item .arrow').removeClass('hide');
            });
        }
        else
        {
            $.get("/ajax.php?action=turnOffSwitch", function(){
                $('#profileBox .switch span').html('Off');
                $('#list .item').removeClass('slidable on');
                $('#list .item:first .arrow').addClass('hide');
                $('#sliding').animate({
                    right: '500'
                });
                $('#sidebar').animate({
                opacity: 1.5
            });
            });
        }
        return false;
    });

    /**** sliding action ****/



    $('#mainContent #list .item .arrow').click(function(){

        var top = parseInt($('#sliding').css('top'), 10);
        var offset = $('#sliding').offset();

        var scrollTop = getScrollTop();
        var newTop = scrollTop > (offset.top - 105) ? (scrollTop - offset.top+105 + top) : top;
        $('#sliding').css('top', newTop+'px');

        // resize
        var newHeight = $(window).height() - 130 > $('#mainContent').height() ? $('#mainContent').height() - 20 : $(window).height() - 130;
        $('#sliding').css('height', newHeight);
        // resize sliding if it edges out mainContent
        var mainContentBottomY = $('#mainContent').offset().top + $('#mainContent').height();
        var slidingBottomY = $('#sliding').offset().top + $('#sliding').height() ;
        var bottomMargin = slidingBottomY > mainContentBottomY ? slidingBottomY - mainContentBottomY : 0;
        if (bottomMargin)
        {
            var newHeight = $(window).height() - 130 > $('#mainContent').height() ? $('#mainContent').height() - 20 : $(window).height() - 130;
            var newHeight = newHeight - bottomMargin-1;
            $('#sliding').css('height', newHeight);
        }
        else
            $('#sliding').css('height', newHeight);

        var $item = $(this).parent('.item');

        if (!$item.hasClass('slidable'))
            return false;

        var on = $item.hasClass('on');
        if (on)
        {
            // animate
            $('#sliding').animate({
                right: '500'
            }, function() {
                $(this).removeClass('on');
            });
            $('#sidebar').animate({
                opacity: 1
            });
            // remove class
            $('#list .item').removeClass('on');
        }
        else
        {
            $('#list .item').removeClass('on');
            // animate
            $('#sliding').animate({
                right: '0'
            }, function() {
                $(this).addClass('on');
            });
            $('#sidebar').animate({
                opacity: 0.15
            });

            $item.addClass('on');

            // ajax to fetch content
            var link = $('.thumbnail', $item).attr('href');
            fetchContent(link, $item);

            // sliding scroll to top
            $('#sliding').animate({
                'scrollTop': 0
            });
        }
        return false;
    });




    /**** resize silidng section ****/
    var top = parseInt($('#sliding').css('top'), 10);
    var offset = $('#sliding').offset();

    if (offset != null)
    {

        var scrollTop = getScrollTop();
        var newTop = scrollTop > (offset.top - 105) ? (scrollTop - offset.top+105 + top) : top;
        $('#sliding').css('top', newTop+'px');

        // resize
        var newHeight = $(window).height() - 130 > $('#mainContent').height() ? $('#mainContent').height() - 20 : $(window).height() - 130;
        newHeight = newHeight+10;
        $('#sliding').css('height', newHeight);
        // resize sliding if it edges out mainContent
        var mainContentBottomY = $('#mainContent').offset().top + $('#mainContent').height();
        var slidingBottomY = $('#sliding').offset().top + $('#sliding').height() ;
        var bottomMargin = slidingBottomY > mainContentBottomY ? slidingBottomY - mainContentBottomY : 0;
        if (bottomMargin)
        {
            var newHeight = $(window).height() - 125 > $('#mainContent').height() ? $('#mainContent').height() - 20 : $(window).height() - 125;
            var newHeight = newHeight - bottomMargin -1;
            $('#sliding').css('height', newHeight);
        }
        else
        {
            var newHeight = $(window).height() - 125 > $('#mainContent').height() ? $('#mainContent').height() - 20 : $(window).height() - 125;
            $('#sliding').css('height', newHeight);
        }

        $(window).scroll(function(){

            if ($('#sliding').hasClass('on'))
            {
                // resize
                var scrollTop = getScrollTop();
                var newTop = scrollTop > (offset.top - 105) ? (scrollTop - offset.top+105 + top) : top;
                $('#sliding').css('top', newTop+'px');

                // resize sliding if it edges out mainContent
                var mainContentBottomY = $('#mainContent').offset().top + $('#mainContent').height();
                var slidingBottomY = $('#sliding').offset().top + $('#sliding').height() ;
                var bottomMargin = slidingBottomY > mainContentBottomY ? slidingBottomY - mainContentBottomY : 0;
                if (bottomMargin)
                {
                    var newHeight = $(window).height() - 125 > $('#mainContent').height() ? $('#mainContent').height() - 20 : $(window).height() - 125;
                    var newHeight = newHeight - bottomMargin -1;
                    $('#sliding').css('height', newHeight);
                }
                else
                {
                    var newHeight = $(window).height() - 125 > $('#mainContent').height() ? $('#mainContent').height() - 20 : $(window).height() - 125;
                    $('#sliding').css('height', newHeight);
                }
            }
        });

        $(window).resize(function(){
            if ($('#sliding').hasClass('on'))
            {
                // resize
                var newHeight = $(window).height() - 125 > $('#mainContent').height() ? $('#mainContent').height() - 20 : $(window).height() - 125;
                $('#sliding').css('height', newHeight);

                // resize sliding if it edges out mainContent
                var mainContentBottomY = $('#mainContent').offset().top + $('#mainContent').height();
                var slidingBottomY = $('#sliding').offset().top + $('#sliding').height() ;
                var bottomMargin = slidingBottomY > mainContentBottomY ? slidingBottomY - mainContentBottomY : 0;
                if (bottomMargin)
                {
                    var newHeight = $(window).height() - 125 > $('#mainContent').height() ? $('#mainContent').height() - 20 : $(window).height() - 125;
                    var newHeight = newHeight - bottomMargin -1;
                    $('#sliding').css('height', newHeight);
                }
                else
                {
                    var newHeight = $(window).height() - 125 > $('#mainContent').height() ? $('#mainContent').height() - 20 : $(window).height() - 125;
                    $('#sliding').css('height', newHeight);
                }
            }
        });

    } // end of if
});



function adjustSlidingPosition()
{
    alert($('#sliding'));
}

function getScrollTop(){
    if(typeof pageYOffset!= 'undefined'){
        //most browsers
        return pageYOffset;
    }
    else{
        var B= document.body; //IE 'quirks'
        var D= document.documentElement; //IE with doctype
        D= (D.clientHeight)? D: B;
        return D.scrollTop;
    }
}


function fetchContent(link, $item)
{
    jQuery('#sliding .ajaxLoader').removeClass('hide');
    jQuery.ajax({
        url: link,
        cache: false,
        dataType: "html",
        success: function(data){
            var start = data.indexOf('<section id="mainContent">');
            start = start + '<section id="mainContent">'.length;
            var end = data.indexOf('<!-- end of #mainContent -->');
            end = end - '</section>'.length - 1;
            var mainContent = data.substr(start, end-start);
            // remove switch
            mainContent = mainContent.replace('<a href="#"  class="switch on">Quick View <span>On</span></a>', '');

            jQuery('#sliding .content').html(innerShiv(mainContent));

            jQuery('#sliding .ajaxLoader').addClass('hide');

            // nivo slider
        jQuery('#slider').nivoSlider({
    //        effect:'random', // Specify sets like: 'fold,fade,sliceDown'
    //        slices:15, // For slice animations
    //        boxCols: 8, // For box animations
    //        boxRows: 4, // For box animations
            animSpeed:800, // Slide transition speed
            pauseTime:5000 // How long each slide will show
    //        startSlide:0, // Set starting Slide (0 index)
    //        directionNav:true, // Next & Prev navigation
    //        directionNavHide:true, // Only show on hover
    //        controlNav:true, // 1,2,3... navigation
    //        controlNavThumbs:false, // Use thumbnails for Control Nav
    //        controlNavThumbsFromRel:false, // Use image rel for thumbs
    //        controlNavThumbsSearch: '.jpg', // Replace this with...
    //        controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
    //        keyboardNav:true, // Use left & right arrows
    //        pauseOnHover:true, // Stop animation while hovering
    //        manualAdvance:false, // Force manual transitions
    //        captionOpacity:0.8, // Universal caption opacity
    //        prevText: 'Prev', // Prev directionNav text
    //        nextText: 'Next', // Next directionNav text
    //        beforeChange: function(){}, // Triggers before a slide transition
    //        afterChange: function(){}, // Triggers after a slide transition
    //        slideshowEnd: function(){}, // Triggers after all slides have been shown
    //        lastSlide: function(){}, // Triggers when last slide is shown
    //        afterLoad: function(){} // Triggers when slider has loaded
        });
        }
    });

}
