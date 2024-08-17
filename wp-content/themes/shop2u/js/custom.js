// Cart addButton

jQuery(document).ready(function($) {
    "use strict";

    // Assiccibility Ready
    var startTab = function(elem,first_focus,close_button){
        var tabbable = elem.find('select, input, textarea, button, a, [href],[tabindex]:not([tabindex="-1"])').filter(':visible');

        var firstTabbable = tabbable.first();
        var lastTabbable = tabbable.last();
        first_focus.focus();

        lastTabbable.on('keydown', function (e) {
            if ((e.which === 9 && !e.shiftKey)) {
                e.preventDefault();
                firstTabbable.focus();
            }
        });
        firstTabbable.on('keydown', function (e) {
            if ((e.which === 9 && e.shiftKey)) {
                e.preventDefault();
                lastTabbable.focus();
            }
        });

        elem.on('keyup', function (e) {
            if (e.keyCode === 27) {
                close_button.click();
            };
        });
    };

    function nav_menu_add_css(){
        var adminbar_height = $('#wpadminbar').length ? $('#wpadminbar').height() : 0;
        var sticky_height = $('.is_sticky_fixed').length ? $('.is_sticky_fixed').height() : 0;
        var topspace = adminbar_height + sticky_height;
        $('.nav-menu').css('top',topspace+'px');
    }

    $('.navbar-toggler').on('click', function(e){
        e.preventDefault();
        nav_menu_add_css();
        $('.nav-menu').addClass("show");
        $('.body-overlay').addClass('active');
        startTab($('.primary-menu'),$('.primary-menu-list > li:first-of-type a'),$('.navbar-close'));
    });
    $(window).on('scroll', function() {
        if ($(window).scrollTop() >= 250) {
            nav_menu_add_css();
        }else{
            nav_menu_add_css();
        }
    });
    $('.navbar-close').on('click', function(){
        $('.nav-menu').removeClass("show");
        $('.body-overlay').removeClass('active');
        $('.navbar-toggler').focus();
    });
    $('.body-overlay').on('click', function (){
       $(".nav-menu").removeClass("show");
       $('.body-overlay').removeClass('active');
       $('.navbar-toggler').focus();
    });

    $('.vertical-navigation-header').on('click', function(e){
        e.preventDefault();
       $('.vertical-navigation').toggleClass('vertical-menu_active');
       startTab($('.vertical-navigation'),$('.menu > li:first-of-type a'),$('.vertical-navigation-header'));
    });

    $('.vertical-menu .menu').find('li:has(ul) > a').each(function(){
        $('<button type="button" class="toggle-menu"><i class="fa fa-angle-down"></i></button>').insertAfter($(this));
    });

    // Cart Popup Show
    $('.right-card-show-btn').on('click', function(e){
        e.preventDefault();
        $('.header-navigation .right-header-card .cart_popup').toggleClass("show");
        startTab($('.cart_popup .woocommerce-cart-header'),$('.cart_popup .woocommerce-mini-cart > li:first-of-type a'),$('.cart-remove'));
    });
    $('.cart-remove').on('click', function(e){
        e.preventDefault();
        $('.header-navigation .right-header-card .cart_popup').toggleClass("show");
        $('.right-card-show-btn').focus();
    });
    $('.remove-cart-shadow').on('click', function(e){
        e.preventDefault();
        $('.header-navigation .right-header-card .cart_popup').toggleClass("show");
        $('.right-card-show-btn').focus();
    });

    $('.navbar-nav').find('.menu-item-has-children > a').each(function(){
        $('<button type="button" class="toggle-menu"><i class="fa fa-angle-down"></i></button>').insertAfter($(this));
    });

    // expands the dropdown menu on each click
     $('.toggle-menu').on('click', function(e) {
        e.preventDefault();
        $(this).parent('li').children('ul').stop(true, true).slideToggle(350);
        $(this).parent('li').toggleClass('current');
    });

    $('.sidebar .widget').find('.wp-block-heading').each(function(){
        var ele = $(this).addClass('title-box');
        var heading = ele.html();
        var str = '<div class="sidebar_widget_icon"><i class="fa fa-shopping-bag"></i></div><h5 class="widget_title">'+heading+'</h5>';
        ele.html(str);
    });

    $('.main-footer .widget.widget_block:has(.wp-block-heading)').each(function(){
        var ele = $(this).addClass('main-footer-title');
        var heading = ele.find('.wp-block-heading').addClass('widget_title');
        $('<div class="shipping-icon text-center"><i class="fa fa-shopping-basket"></i></div>').insertAfter(ele.find('.wp-block-heading'));
    });

    if ($(".is_sticky").length > 0) {
        $(window).on('scroll', function() {
            if ($(window).scrollTop() >= 250) {
                $('.is_sticky').addClass('is_sticky_fixed');
            }else{
                $('.is_sticky').removeClass('is_sticky_fixed');
            }
        });
    }

    // Browse Menu
    if( $('.vertical-menu ul.menu').children().length >= 7 ) {
        $(".vertical-menu").addClass("active");
        $(".vertical-menu ul.menu").append('<li class="menu-item other-menu"><a href="#" class="more-item"><i class="fa fa-plus-circle menu-icon"></i> <span>'+shop2u_settings.category_more_label+'</span></a></li>');
        $(".vertical-menu > ul.menu > li:not(.other-menu)").slice(0, 7).show();
        $(".more-item").on('click', function (e) {
            e.preventDefault();
            if (!$(".more-item").hasClass("active")) {
                $(".more-item").addClass("active");
                $('.more-item i').removeClass('fa-plus-circle').addClass("fa-minus-circle");
                $(".more-item").animate({display: "block"}, 500,
                    function () {
                        $(".vertical-menu > ul.menu > li:not(.other-menu):hidden").addClass('actived').slideDown(200);
                        if ($(".vertical-menu > ul.menu > li:not(.other-menu):hidden").length === 0) {
                            $(".more-item").html('<i class="fa fa-minus-circle menu-icon"></i> <span>'+shop2u_settings.category_no_more_label+'</span>');
                        }
                    }
                );
            } else {
                $(".more-item").removeClass("active");
                $(".more-item").animate({display: "none"}, 500,
                    function () {
                        if ($(".vertical-menu > ul.menu > li:not(.other-menu)").hasClass('actived')) {
                            $(".vertical-menu > ul.menu > li:not(.other-menu).actived").slice(0, 7).slideUp(200);
                            $(".more-item").html('<i class="fa fa-plus-circle menu-icon"></i> <span>'+shop2u_settings.category_more_label+'</span>');
                        }
                    }
                );
            }
        });
    }

    // Home Slider
    if ($(".sp-home-slider").length > 0) {
      var $owlHome = $('.sp-home-slider');
      $owlHome.owlCarousel({
          rtl: $("html").attr("dir") == 'rtl' ? true : false,
          items: 1,
          autoplay: false,
          autoplayTimeout: shop2u_settings.slider_speed,
          animateIn: shop2u_settings.slider_animation_start,
          animateOut: shop2u_settings.slider_animation_end,
          margin: 0,
          loop: true,
          dots: true,
          nav: true,
          navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
          singleItem: true,
          transitionStyle: "fade",
          touchDrag: true,
          mouseDrag: true,
          responsive: {
              0: {
                  nav: false
              },
              768: {
                  nav: true
              },
              992: {
                  nav: true
              }
          }
      });
    }

    $('.testimonial-carousel').owlCarousel({
        loop:true,
        margin:20,
        nav:false,
        dots:true,
        responsive:{
            0:{
                items:1
            },
            769:{
                items:1
            },
            1024:{
                items:2
            },
            2000:{
                items:2
            }
        }
    });

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim()
        if (all) {
          return [...document.querySelectorAll(el)]
        } else {
          return document.querySelector(el)
        }
    }

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = true) => {
        let selectEl = select(el, all)
        if (selectEl) {
          if (all) {
            selectEl.forEach(e => e.addEventListener(type, listener))
          } else {
            selectEl.addEventListener(type, listener)
          }
        }
    }

    /*** Recent Product Filters ***/
       
    window.addEventListener('load', () => {
        let section = select('#recent_products .products');
        if (section) {
          let sectionIsotope = new Isotope(section, {
            itemSelector: '.isotop_item',
            layoutMode: 'fitRows',
          });

          let sectionFilters = select('#recent_products .product-filters li', true);

          on('click', '#recent_products .product-filters li', function(e) {
            e.preventDefault();
            sectionFilters.forEach(function(el) {
              el.classList.remove('filter-active');
            });
            this.classList.add('filter-active');

            sectionIsotope.arrange({
              filter: this.getAttribute('data-filter')
            });
          }, true);
        }
    });

    // Back to top
      
    $('.go-top-btn').on('click', function (e) {
      $('html, body').animate({
        scrollTop: '0',
      },
        1200
      );
      e.preventDefault();
    });

    // Get a reference to the element you want to modify
    const backTotop = document.getElementById('back-to-top');

    // Function to add the class when scrolling
    function handleScroll() {
      if (window.scrollY > 100) {
        backTotop.classList.add('active'); // Add the 'active' class
      } else {
        backTotop.classList.remove('active'); // Remove the 'active' class
      }
    }

    // Add an event listener to the window for the scroll event
    window.addEventListener('scroll', handleScroll);

});