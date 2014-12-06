/* ==================================================
//  ____  _     _   _            _   _          _____ _                              
// |  _ \(_)___| |_(_)_ __   ___| |_(_)_   ____|_   _| |__   ___ _ __ ___   ___  ___ 
// | | | | / __| __| | '_ \ / __| __| \ \ / / _ \| | | '_ \ / _ \ '_ ` _ \ / _ \/ __|
// | |_| | \__ \ |_| | | | | (__| |_| |\ V /  __/| | | | | |  __/ | | | | |  __/\__ \
// |____/|_|___/\__|_|_| |_|\___|\__|_| \_/ \___||_| |_| |_|\___|_| |_| |_|\___||___/
//
/* ================================================*/

$(document).ready(function(){

    if ($('body').hasClass('has-home-slider')) {
      //SETUP VARS
      var myLeft = $(".caption-wrapper").offset().left;
      var myTop = $(".caption-wrapper").offset().top;
      var captionHeight = $('.caption-wrapper').outerHeight();
      var myRight = myLeft + $(".caption-wrapper").outerWidth();
      var myBottom = myTop + $(".caption-wrapper").outerHeight();
      var sliderInnerLeft = $('#home-slider .holder').outerWidth();
      var viewportRight = $(window).width() + $(window).scrollLeft();
      var viewportBottom = $(window).height() + $(window).scrollTop();


      $('.controllers').css({'width':sliderInnerLeft, 'top':captionHeight/2});
      //SLIDER SYNC
      jQuery('#home-slider .carousel-control.left').click(function(x) { x.preventDefault(); jQuery('#home-slider').data('backstretch').prev(); });
      jQuery('#home-slider .carousel-control.right').click(function(x) { x.preventDefault(); jQuery('#home-slider').data('backstretch').next(); });

      $('#home-slider').on('slide.bs.carousel', function (event) {
        var direction = event.direction;
        if (direction == 'right') {
            jQuery('#home-slider').data('backstretch').prev();
        } else if (direction == 'left') {
          jQuery('#home-slider').data('backstretch').next();
        }
      })

      $(window).bind("load resize slid.bs.carousel", function() {
        var imageHeight = $(".active .holder").height();
        $(".controllers").height( imageHeight );
      });
    }

    //BACK TO TOP
    $('#back-to-top a').click(function(event) {
      event.preventDefault();
      $('html, body').animate({
        scrollTop: $("body").offset().top
      }, 500);
    }); 

    //CAROUSEL
    $('.carousel').carousel({
        interval: 8000
    });

    $('.owl-carousel').owlCarousel({
      navigation: true,
      navigationText: [
      "<span class='icon-arrowl'></span>",
      "<span class='icon-arrowr'></span>"
      ],
      pagination: false,
      autoPlay: 8000
    });

    $('.carousel-indicators li').click(function() {
        var li = $(this);
        var alreadySelected = li.hasClass('active');
        $('.carousel-indicators li').removeClass('active');
        li.addClass('active');
    });

    //ADD SLIDEDOWN ANIMATION TO DROPDOWN
    $('.navbar-default .navbar-nav > li.dropdown').hover(function() {
        $('ul.dropdown-menu', this).stop(true, true).slideDown('fast');
        $(this).addClass('open');
      }, function() {
        $('ul.dropdown-menu', this).stop(true, true).slideUp('fast');
        $(this).removeClass('open');
    });

    //NEAT VID EMBEDS
    $().prettyEmbed({ useFitVids: true });

    //REVIEW CIRCLES
    $('#review-score-circle').circliful();

    //TOOLTIPS
    $('.tooltip-me').tooltip();

    //NEWS TICKER
    $('.vticker').vTicker({
        speed: 500,
        pause: 8000,
        showItems: 1,
        animation: 'fade',
        mousePause: true,
        height: 0,
        direction: 'up'
    });
    
});

jQuery(function($) {
  $(document).ready( function() {
    //enabling stickUp on the '.navbar-wrapper' class
    $('#main-navigation').stickUp();
  });
});

/*-----------------------------------------------------------------------------------*/
/*  SEARCH BAR
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function($){
'use strict';
  jQuery('#search-wrapper, #search-wrapper input, #search-wrapper .close-trigger, #topbar-latest-posts-inner').hide();

  jQuery('a#search-trigger').click(function(e){
    e.preventDefault();
    var checkLatest = $('#topbar-latest-posts-inner').is(":hidden");

    if(checkLatest == true) {
      jQuery('#latest-trigger').slideUp(300);
      jQuery('#search-wrapper').slideDown(300, function() {
        var check=$(this).is(":hidden");
        if(check == true) {
            jQuery('#search-wrapper input').fadeOut(600);
        } else {          
          jQuery("#search-wrapper input").focus();
          jQuery('#search-wrapper input, .close-trigger').fadeIn(200);
        }
      });
    } else {
      jQuery('#topbar-latest-posts-inner').slideUp(300);
      jQuery('#search-wrapper').slideDown(300, function() {
        var check=$(this).is(":hidden");
        if(check == true) {
            jQuery('#search-wrapper input').fadeOut(600);
        } else {
          jQuery("#search-wrapper input").focus();
          jQuery('#search-wrapper input, .close-trigger').fadeIn(200);
        }
      });
    }

  });

  jQuery('#search-wrapper span.close-trigger').click(function(){
    jQuery('#search-wrapper').slideUp(300);
    var checkLatest = $('#topbar-latest-posts-inner').is(":hidden");
    if(checkLatest == true) {
      jQuery('#latest-trigger').slideDown(300);
    }
  });

  if ($("body").hasClass("top-widgets-open")) {
    jQuery('#latest-trigger').hide();
    jQuery('#topbar-latest-posts-inner').show(300);
    jQuery('#topbar-latest-posts span.close-trigger').click(function(){
      jQuery('#latest-trigger').slideDown(300);
      jQuery('#topbar-latest-posts-inner').slideUp(300);
    });
  }

  jQuery('#latest-trigger a').click(function(e){
      e.preventDefault();
      jQuery('#latest-trigger').slideUp(300);
      jQuery('#topbar-latest-posts-inner').slideDown(300, function() {
  });

  jQuery('#topbar-latest-posts span.close-trigger').click(function(){
    jQuery('#latest-trigger').slideDown(300);
    jQuery('#topbar-latest-posts-inner').slideUp(300);
  });

  });
});

/*-----------------------------------------------------------------------------------*/
/*  ANIMATE
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function($){
'use strict';
  var isMobileDevice = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
  if( !isMobileDevice ) {
    jQuery('.fade-up, .fade-down, .bounce-in, .flip-in, .fade-right, .fade-left').addClass('no-display');
    jQuery('.bounce-in').one('inview', function() { 
      jQuery(this).addClass('animated bounceIn appear');
    });
    jQuery('.flip-in').one('inview', function() { 
      jQuery(this).addClass('animated flipInY appear');
    });
    jQuery('.fade-up').one('inview', function() {
      jQuery(this).addClass('animated fadeInUp appear');
    });
    jQuery('.fade-down').one('inview', function() {
      jQuery(this).addClass('animated fadeInDown appear');
    });
    jQuery('.fade-right').one('inview', function() {
      jQuery(this).addClass('animated fadeInLeft appear');
    });
    jQuery('.fade-left').one('inview', function() {
      jQuery(this).addClass('animated fadeInRight appear');
    });
  }

  jQuery('.counter').counterUp({
    delay: 10,
    time: 1000
  });
});

/*-----------------------------------------------------------------------------------*/
/*  CONTACT FORM
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function($){
  'use strict';

  $('#contactform').submit(function(){
    var action = $(this).attr('action');
    $("#message").slideUp(750,function() {
    $('#message').hide();
    $('#submit').attr('disabled','disabled');
    $.post(action, {
      name: $('#name').val(),
      email: $('#email').val(),
      website: $('#website').val(),
      comments: $('#comments').val()
    },
      function(data){
        document.getElementById('message').innerHTML = data;
        $('#message').slideDown('slow');
        $('#submit').removeAttr('disabled');
        if(data.match('success') != null) $('#contactform').slideUp('slow');
        $(window).trigger('resize');
      }
    );
    });
    return false;
  });
  
});

/*-----------------------------------------------------------------------------------*/
/*  CUSTOM JS ERE
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function($){
  'use strict';

});