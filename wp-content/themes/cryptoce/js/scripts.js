(function ($) {
  $(document).ready(function () {
    "use strict";


    // TAB
    $(".tab-nav li").on('click', function (e) {
      $(".tab-item").hide();
      $(".tab-nav li").removeClass('active');
      $(this).addClass("active");
      var selected_tab = $(this).find("a").attr("href");
      $(selected_tab).stop().show();
      return false;
    });


    // LOGO HOVER
    $(".site-menu ul li").hover(function () {
        $('.site-menu ul li').not(this).css({
          "opacity": "1"
        });
      },
      function () {
        $('.site-menu ul li').not(this).css({
          "opacity": "1"
        });
      });


    // HAMBURGER MENU
    "use strict";

    var main = function() {
      $('.hamburger-menu').click(function() {
        $('.side-widget').animate({
            left: "0px"}, 200,function() {
                
                $(document).on("click.menu",function(event) {
                    var target = $(event.target);   console.log(target);
                    if (!target.closest(".side-widget").length || target.closest(".closed").length) {
                        closeMenu(function() {
                            $(document).off("click.menu");
                        });
                    }           
                })  
            
            });
      });
    
    
      
        function closeMenu(callback) {  
            $('.side-widget').animate({
              left: "-100%"}, 200);
              $('.hamburger-menu').show();
           if ($.isFunction(callback)) callback();
        }    
      
            
    };
    
    $(document).ready(main);

    // PAGE TRANSITION
    $('body a').on('click', function (e) {

      var target = $(this).attr('target');
      var fancybox = $(this).data('fancybox');
      var url = this.getAttribute("href");
      if (target != '_blank' && typeof fancybox == 'undefined' && url.indexOf('') < 0) {


        e.preventDefault();
        var url = this.getAttribute("href");
        if (url.indexOf('') != -1) {
          var hash = url.substring(url.indexOf('#'));


          if ($('body ' + hash).length != 0) {
            $('.page-transition').removeClass("active");


          }
        } else {
          $('.page-transition').toggleClass("active");
          setTimeout(function () {
            window.location = url;
          }, 1000);

        }
      }
    });


  });
  // END DOCUMENT READY

  // DATA BACKGROUND IMAGE
  var pageSection = $("*");
  pageSection.each(function (indx) {
    if ($(this).attr("data-background")) {
      $(this).css("background", "url(" + $(this).data("background") + ")");
    }
  });



  // DATA BACKGROUND COLOR
  var pageSection = $("*");
  pageSection.each(function (indx) {
    if ($(this).attr("data-background")) {
      $(this).css("background", $(this).data("background"));
    }
  });


  // WOW ANIMATION 
  wow = new WOW({
    animateClass: 'animated',
    offset: 0
  });
  wow.init();


  // CAROUSEL CLASSES SLIDER
  var swiper = new Swiper('.carousel-classes', {
    slidesPerView: '3',
    spaceBetween: 10,
    loop: 'true',
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
	   breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 15,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
    }
  });


  // MAIN SLIDER
  var swiper = new Swiper('.main-slider', {
    slidesPerView: '1',
    speed: 1500,
    loop: true,
    effect: 'coverflow',
    coverflowEffect: {
      rotate: 30,
      slideShadows: false,
    },
    autoplay: {
      delay: 3500,
      disableOnInteraction: false,
    },
    navigation: {
      prevEl: '.button-prev',
      nextEl: '.button-next',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });


  // COUNTER
  $(document).scroll(function () {
    $('.odometer').each(function () {
      var parent_section_postion = $(this).closest('section').position();
      var parent_section_top = parent_section_postion.top;
      if ($(document).scrollTop() > parent_section_top - 300) {
        if ($(this).data('status') == 'yes') {
          $(this).html($(this).data('count'));
          $(this).data('status', 'no');
        }
      }
    });
  });


  // PRELOADER
  $(window).load(function () {
    $("body").addClass("page-loaded");
  });


})(jQuery);

