 
$(function () {
    'use strict';
    
    var win = $(window),
        html = $(document.documentElement),
        body = $(document.body);
    
    
    //-------------------------------PSEUDO LOADER -----------------------------
    //remove pseudo loader
    $('#loader-status').fadeOut();
    $('#preloader').delay(350).fadeOut('slow');
    body.delay(350).css({'overflow': 'visible'});
    
    //-------------------------------SCROLLING ANCHOR---------------------------
 
    //scroll to anchor element
    $('a[href*="#"]').click(function (e) {
        e.preventDefault();
        autoscroll($($(this).attr("href")));
    });
     
    window.location.hash && setLocationHash(window.location.hash);
   
    win.on('hashchange', function () {
        setLocationHash(this.location.hash);
    });
    
    function setLocationHash(hash) {
        if (typeof hash !== 'undefined') {
            if ($(hash).length > 0) {
                autoscroll(hash);
            }
        }
    }
    
    function autoscroll(element) {
        body.stop().animate({
            scrollTop: $(element).offset().top - $('header[id="nav-header-resume"]').find('nav').height() - 1
        }, 'slow');
    }
    
    //----------------------------------PROGRESS--------------------------------
    $('.skill-progress').bind('inview', function(event, visible, visiblePartX, visiblePartY) {
        if (visible) {
            $.each($('div.progress-bar'),function(){
                $(this).css('width', $(this).attr('aria-valuenow')+'%');
            });
            $(this).unbind('inview');
        }
    });

    
    //-----------------------------------POPUP----------------------------------
    $('.link-popup').magnificPopup({
        gallery: {
            enabled: true
        },
        removalDelay: 300,
        type: 'image'
    });
    
    
    //-------------------------------SCROLL TOP BTN-----------------------------
    win.scroll(function () {
        $(this).scrollTop()
            ? $('#toTop:hidden').stop(true, true).fadeIn()
            : $('#toTop').stop(true, true).fadeOut();
    });
    

    //-----------------------------------WOW------------------------------------
    new WOW({mobile: false}).init();
    
    
    
    //---------------------------------CONTACT----------------------------------
    var form = $('#contact-form'),
        contact_msg = $('#contact-msg'),
        ico = form.find('button[type="submit"] i');
                
    form.submit(function(e){
        e.preventDefault();
        
        ico.removeClass('fa-paper-plane');
        ico.addClass('fa-spinner fa-spin');
        
        $.ajax({
            url: __base__ + 'io/mail/',
            data: form.serialize(),
            method: 'post',
            success: contactSuccess,
            error: contactError
        });
    }); 
    
    function contactSuccess(data) {
        var type, msg;
        if(!data) { 
            type = 'success';
            msg = __local__['contact success'];
        } 
        else {
            type = 'warning';
            msg = __local__['contact warning'] + "<div>" + data + "</div>";
        }
        addContactAlert('alert-' + type, msg); 
        typeof grecaptcha !== 'undefined' &&  grecaptcha.reset();
    }
    
    function contactError () {
        addContactAlert('alert-danger', __local__['contact error']);
        typeof grecaptcha !== 'undefined' &&  grecaptcha.reset();
    }
    
    function addContactAlert(type, msg) {
        contact_msg.html(
            '<br>' + 
            $('#error-contact').html()
                .replace('{{type}}', type)
                .replace('{{msg}}', msg)
        );
        
        ico.removeClass('fa-spinner fa-spin');
        ico.addClass('fa-paper-plane');
    }
});
