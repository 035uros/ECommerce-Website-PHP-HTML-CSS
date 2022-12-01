/*------------------------------------------------------------------------

GET VIEWPORT
THROTTLE
FULLHEIGHT
MAIN NAV MENU
OFF CANVAS MENU
FIXED ENABLED
HOME 1 SLIDESHOW
HOME 1 TESTIMONIAL SLIDER
HOME 2 SLIDESHOW
HOME 2 LATEST BLOG SLIDER
HOME 2 PRODUCT COUNTDOWN
HOME 3 SLIDESHOW
HOME 3 NEW TRENDING ITEM SLIDER
HOME 3 TESTIMONIAL SLIDER
HOME 3 LOGO BRAND SLIDER
HOME 4 SLIDESHOW
HOME 4 PRODUCT COUNTDOWN
HOME 4 WHAT HOTS SLIDER
HOME 5 SLIDESHOW
HOME 5 PRODUCT COUNTDOWN
HOME LOOKBOOK 1 SLIDESHOW
HOME LOOKBOOK 2 SLIDESHOW
HOME PARALLAX SLIDESHOW
THUMBNAIL EFFECT
PARALLAX
RATING
ENABLED RATING
FOOTER NAVIGATION
FULLHEIGHT ERROR PAGE
BACK TO TOP
DATA HREF
DATA PLACEHOLDER
SCRIPT DROPDOWN 1
SCRIPT DROPDOWN 2
PRODUCT DETAIL SLIDER
BLOG DETAIL SLIDER
TESTIMONIAL ABOUT SLIDER
INPUT QUANTITY PRODUCT DETAIL (SPINNER INPUT)
INPUT QUANTITY CART (SPINNER INPUT)
ONLY NUMERIC
FILTER
POST MANSORY
LIGHTBOX STYLE 1 - LIGHTBOX GALLERY
SLIDER RANGE
APPEAR
COUNTER
PROGRESS CIRCLE - PIE CHART - SHORTCODES
PROGRESS CIRCLE STYLE 2 - PIE CHART - SHORTCODES
FADE ANIMATION SLIDER - SHORTCODES
AUTO ANIMATION SLIDER - SHORTCODES
RANDOM SLIDER WITH TIMER - SHORTCODES
JPLAYER VIDEO 1 (HORIZONTAL TAB - SHORTCODES PAGE)
RESIZE HEIGHT
MAP CONTACT
ADD TO CART BUTTON
ADD TO WISHLIST BUTTON
DELETE PRODUCT
DIFFERENT ADDRESS (CHECKOUT PAGE)
CHOOSE METHOD PAYMENT (CHECKOUT PAGE)
SHOW NEWSLETTER

------------------------------------------------------------------------ */
/**/
/**/
/**/
$(document).ready(function() {
  /* --------------------------------------------------------------------- */
  /* GET VIEWPORT
  /* --------------------------------------------------------------------- */
  function getViewport() {
    var e = window;
    var a = 'inner';
    if (!('innerWidth' in window)) {
      a = 'client';
      e = document.documentElement || document.body;
    }
    return {
      width: e[a + 'Width'],
      height: e[a + 'Height']
    };
  }


  /* --------------------------------------------------------------------- */
  /* THROTTLE
  /* --------------------------------------------------------------------- */
  function throttle(func, time) {
    time || (time = 250);
    var wait = false;

    return function() {
      if (!wait) {
        func.call();
        wait = true;

        setTimeout(function() {
          wait = false;
        }, time);
      }
    }
  }


  /* --------------------------------------------------------------------- */
  /* FULLHEIGHT
  /* --------------------------------------------------------------------- */
  function fullHeight(elm) {
    if (!elm.length) return;
    
    var elmHeight = elm.outerHeight();
    var viewportHeight = getViewport().height;
    var bodyHeight = $('body').outerHeight();

    if (bodyHeight <= viewportHeight) {
      if (elmHeight < viewportHeight) {
        elm.css('height', viewportHeight);
      } else {
        elm.css('height', '');
      }
    }
  }


  /* --------------------------------------------------------------------- */
  /* MAIN NAV MENU
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.header .main-nav').length) return;

    // superfish menu
    $('.header .main-nav .sf-menu').superfish({
      cssArrows: false
    });

    // add class: .active
    $('.header .main-nav li.active').parents('li').addClass('active');
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* OFF CANVAS MENU
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.off-canvas-wrapper-left').length && !$('.off-canvas-wrapper-right').length) return;
    
    var scrollTopOldValue = 0;

    function closeOffCanvas() {
      var scrollTop = $(document.body).scrollTop();
      scrollTop !== 0 ? scrollTopOldValue = scrollTop : scrollTop = scrollTopOldValue;

      $('body').removeClass('off-canvas-show');

      setTimeout(function() {
        $('body').removeClass('has-off-canvas-left has-off-canvas-right');
        $('html').removeClass('mv-noscroll').css('top', '');
        $(document.body).scrollTop(scrollTop);
        fixedEnabled();
      }, 200);
    }

    // $('.header .main-nav').clone().prependTo('.off-canvas-left .off-canvas-body');

    // $('.off-canvas-left .main-nav .sf-menu').removeClass('sf-js-enabled');
    // $('.off-canvas-left .main-nav .sf-menu').addClass('expand-all').removeClass('sf-js-enabled'); // re-enable superfish menu !important

    $('.off-canvas-left .main-nav .sf-menu').superfish({
      cssArrows: false
    });

    $('body').append($('<div />').addClass('click-close-off-canvas off-canvas-overlay'));

    $('.click-btn-off-canvas-left').off('dbclick').on('click', function() {
      $('body').removeClass('has-off-canvas-right');
      
      var scrollTop = $(document.body).scrollTop();
      scrollTop !== 0 ? scrollTopOldValue = scrollTop : scrollTop = scrollTopOldValue;

      $('.off-canvas-left-wrapper').css({
        'top': scrollTop,
        'height': getViewport().height
      });

      if (!$('body').hasClass('has-off-canvas-left')) {
        $('html').css('top', -scrollTop).addClass('mv-noscroll');
        $('body').addClass('has-off-canvas-left off-canvas-show');
        $('.off-canvas-left-wrapper').css('height', getViewport().height);

        $(window).on('resize', function() {
          $('.off-canvas-left-wrapper').css('height', getViewport().height);
        });
      } else {
        $('body').removeClass('off-canvas-show');
        
        setTimeout(function() {
          $('body').removeClass('has-off-canvas-left');
          $('html').removeClass('mv-noscroll').css('top', '');
          $(document.body).scrollTop(scrollTop);
          fixedEnabled();
        }, 200);
      }
    });

    $('.click-btn-off-canvas-right').off('dbclick').on('click', function() {
      $('body').removeClass('has-off-canvas-left');
      
      var scrollTop = $(document.body).scrollTop();
      scrollTop !== 0 ? scrollTopOldValue = scrollTop : scrollTop = scrollTopOldValue;

      $('.off-canvas-right-wrapper').css({
        'top': scrollTop,
        'height': getViewport().height
      });

      if (!$('body').hasClass('has-off-canvas-right')) {
        $('html').css('top', -scrollTop).addClass('mv-noscroll');
        $('body').addClass('has-off-canvas-right off-canvas-show');
        $('.off-canvas-right-wrapper').css('height', getViewport().height);

        $(window).on('resize', function() {
          $('.off-canvas-right-wrapper').css('height', getViewport().height);
        });
      } else {
        $('body').removeClass('off-canvas-show');
        
        setTimeout(function() {
          $('body').removeClass('has-off-canvas-right');
          $('html').removeClass('mv-noscroll').css('top', '');
          $(document.body).scrollTop(scrollTop);
          fixedEnabled();
        }, 200);
      }
    });

    $('.click-close-off-canvas').off('dbclick').on('click', closeOffCanvas);
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* FIXED ENABLED
  /* --------------------------------------------------------------------- */
  function fixedEnabled() {
    if (!$('.mv-fixed-enabled').length) return;

    var navScroll_1 = $(document).scrollTop();
    var navHeight = $('.mv-fixed-enabled').height();
    var navFixedEnabled = $('.mv-fixed-enabled').offset().top + navHeight;

    function fixNavScroll() {
      var navScroll_2 = $(document).scrollTop();

      if (navScroll_2 > navFixedEnabled) {
        $('body').addClass('fixed-nav');
        $('.mv-site').css('padding-top', navHeight);
      } else {
        $('body').removeClass('fixed-nav');
        $('.mv-site').css('padding-top', '');
      }

      if (navScroll_2 > navScroll_1) {
        $('body').removeClass('fixed-nav-appear');
      } else {
        $('body').addClass('fixed-nav-appear');
      }

      navScroll_1 = $(document).scrollTop();
    }

    function scrollTopZero() {
      if ($(document).scrollTop() == 0) {
        $('body').removeClass('fixed-nav');
        $('.mv-site').css('padding-top', '');
      }
    }

    fixNavScroll();

    $(window).on('scroll resize', throttle(fixNavScroll, 100));
    $(window).on('scroll resize', scrollTopZero);
  };

  setTimeout(function() {
    fixedEnabled();
  }, 1000);


  /* --------------------------------------------------------------------- */
  /* HOME 1 SLIDESHOW
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#home-1-slideshow').length) return;

    $('#home-1-slideshow .mv-slider-wrapper').carouFredSel({
      infinite: true,
      circular: true,
      responsive: true,
      debug: false,

      scroll: {
        items: 1,
        duration: 600,
        pauseOnHover: 'resume',
        fx: 'scroll'
      },

      auto: {
        timeoutDuration: 6000,
        play: true
      },

      swipe: {
        onTouch: true,
        onMouse: true
      },

      prev: {
        button: '#home-1-slideshow-prev'
      },

      next: {
        button: '#home-1-slideshow-next'
      }
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* HOME 1 TESTIMONIAL SLIDER
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#home-1-testimonial-slider').length) return;

    $('#home-1-testimonial-slider .gallery-main').slick({
      asNavFor: '#home-1-testimonial-slider .gallery-thumbs',
      appendArrows: '#home-1-testimonial-slider .slick-slide-control .group-inner',
      nextArrow: '<button type="button" class="mv-btn mv-btn-style-3 slick-slide-next"><i class="fa fa-angle-right"></i></button>',
      prevArrow: '<button type="button" class="mv-btn mv-btn-style-3 slick-slide-prev"><i class="fa fa-angle-left"></i></button>',
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 6000,
      speed: 600,
      infinite: false,
      arrows: true,
      fade: false,
      touchThreshold: 30
    });

    $('#home-1-testimonial-slider .gallery-thumbs').slick({
      asNavFor: '#home-1-testimonial-slider .gallery-main',
      vertical: true,
      verticalSwiping: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      infinite: false,
      arrows: false,
      dots: false,
      centerMode: false,
      focusOnSelect: true,
      touchThreshold: 30
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* HOME 2 SLIDESHOW
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#home-2-slideshow').length) return;

    $('#home-2-slideshow .mv-slider-wrapper').carouFredSel({
      infinite: true,
      circular: true,
      responsive: true,
      debug: false,

      scroll: {
        items: 1,
        duration: 600,
        pauseOnHover: 'resume',
        fx: 'scroll'
      },

      auto: {
        timeoutDuration: 6000,
        // play: false
        play: true
      },

      swipe: {
        onTouch: true,
        onMouse: true
      }
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* HOME 2 LATEST BLOG SLIDER
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#home-2-latest-blog-slider').length) return;

    $('#home-2-latest-blog-slider .mv-slider-wrapper').carouFredSel({
      infinite: true,
      circular: true,
      responsive: true,
      debug: false,

      scroll: {
        items: 1,
        duration: 600,
        pauseOnHover: 'resume',
        fx: 'scroll'
      },

      auto: {
        timeoutDuration: 6000,
        play: false
        // play: true
      },

      swipe: {
        onTouch: true,
        onMouse: true
      },

      prev: {
        button: '#home-2-latest-blog-slider-prev'
      },

      next: {
        button: '#home-2-latest-blog-slider-next'
      }
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* HOME 2 PRODUCT COUNTDOWN
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#home-2-product-countdown').length) return;

    jQuery('#home-2-product-countdown').countDown({
      targetDate: {
        'day': 27,
        'month': 11,
        'year': 2018,
        'hour': 11,
        'min': 00,
        'sec': 00
      },
      omitWeeks: true
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* HOME 3 SLIDESHOW
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#home-3-slideshow').length) return;

    $('#home-3-slideshow .mv-slider-wrapper').carouFredSel({
      infinite: true,
      circular: true,
      responsive: true,
      debug: false,

      scroll: {
        items: 1,
        duration: 600,
        pauseOnHover: 'resume',
        fx: 'scroll'
      },

      auto: {
        timeoutDuration: 6000,
        // play: true,
        play: false
      },

      swipe: {
        onTouch: true,
        onMouse: true
      }
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* HOME 3 NEW TRENDING ITEM SLIDER
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#home-3-new-trending-item-slider').length) return;

    var swiper = new Swiper('#home-3-new-trending-item-slider .swiper-container', {
      scrollbar: '#home-3-new-trending-item-slider .swiper-scrollbar',
      scrollbarHide: false,
      scrollbarDraggable: true,
      slidesPerView: 'auto',
      centeredSlides: false,
      spaceBetween: 0,
      grabCursor: true
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* HOME 3 TESTIMONIAL SLIDER
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#home-3-testimonial-slider').length) return;

    $('#home-3-testimonial-slider .mv-slider-wrapper').carouFredSel({
      infinite: true,
      circular: true,
      responsive: true,
      debug: false,

      scroll: {
        items: 1,
        duration: 600,
        pauseOnHover: 'resume',
        fx: 'scroll'
      },

      auto: {
        timeoutDuration: 6000,
        // play: true,
        play: false
      },

      swipe: {
        onTouch: true,
        onMouse: true
      },

      prev: {
        button: '#home-3-testimonial-slider-prev'
      },

      next: {
        button: '#home-3-testimonial-slider-next'
      }
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* HOME 3 LOGO BRAND SLIDER
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#home-3-logo-brand-slider').length) return;

    $('#home-3-logo-brand-slider .mv-slider-wrapper').carouFredSel({
      infinite: true,
      circular: true,
      responsive: true,
      debug: false,

      items: {
        height: 'variable',
        visible: {
          min: 1,
          max: 5
        }
      },

      scroll: {
        items: null,
        duration: 600,
        pauseOnHover: 'resume',
        fx: 'scroll'
      },

      auto: {
        timeoutDuration: 6000,
        play: true
      },

      swipe: {
        onTouch: true,
        onMouse: true
      },

      prev: {
        button: '#home-3-logo-brand-slider-prev'
      },

      next: {
        button: '#home-3-logo-brand-slider-next'
      }
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* HOME 4 SLIDESHOW
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#home-4-slideshow').length) return;

    $('#home-4-slideshow .mv-slider-wrapper').carouFredSel({
      infinite: true,
      circular: true,
      responsive: true,
      debug: false,

      scroll: {
        items: 1,
        duration: 600,
        pauseOnHover: 'resume',
        fx: 'scroll'
      },

      auto: {
        timeoutDuration: 6000,
        // play: true
        play: false
      },

      swipe: {
        onTouch: true,
        onMouse: true
      },

      prev: {
        button: '#home-4-slideshow-prev'
      },

      next: {
        button: '#home-4-slideshow-next'
      }
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* HOME 4 PRODUCT COUNTDOWN
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#home-4-product-countdown').length) return;

    jQuery('#home-4-product-countdown').countDown({
      targetDate: {
        'day': 27,
        'month': 11,
        'year': 2018,
        'hour': 11,
        'min': 00,
        'sec': 00
      },
      omitWeeks: true
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* HOME 4 WHAT HOTS SLIDER
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#home-4-what-hots-slider').length) return;

    $('#home-4-what-hots-slider .mv-slider-wrapper').carouFredSel({
      infinite: true,
      circular: true,
      responsive: true,
      debug: false,

      scroll: {
        items: null,
        duration: 600,
        pauseOnHover: 'resume',
        fx: 'scroll'
      },

      items: {
        height: 'variable',
        visible: {
          min: 1,
          max: 4
        }
      },

      auto: {
        timeoutDuration: 6000,
        // play: true
        play: false
      },

      swipe: {
        onTouch: true,
        onMouse: true
      },

      prev: {
        button: '#home-4-what-hots-slider-prev'
      },

      next: {
        button: '#home-4-what-hots-slider-next'
      }
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* HOME 5 SLIDESHOW
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#home-5-slideshow').length) return;

    $('#home-5-slideshow .mv-slider-wrapper').carouFredSel({
      infinite: true,
      circular: true,
      responsive: true,
      debug: false,

      scroll: {
        items: 1,
        duration: 600,
        pauseOnHover: 'resume',
        fx: 'scroll'
      },

      auto: {
        timeoutDuration: 6000,
        // play: true
        play: false
      },

      swipe: {
        onTouch: true,
        onMouse: true
      },

      prev: {
        button: '#home-5-slideshow-prev'
      },

      next: {
        button: '#home-5-slideshow-next'
      }
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* HOME 5 PRODUCT COUNTDOWN
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#home-5-product-countdown').length) return;

    jQuery('#home-5-product-countdown').countDown({
      targetDate: {
        'day': 27,
        'month': 11,
        'year': 2018,
        'hour': 11,
        'min': 00,
        'sec': 00
      },
      omitWeeks: true
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* HOME LOOKBOOK 1 SLIDESHOW
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#home-lookbook-1-slideshow').length) return;

    $('#home-lookbook-1-slideshow .mv-slider-wrapper').carouFredSel({
      infinite: true,
      circular: true,
      responsive: true,
      debug: false,

      scroll: {
        items: 1,
        duration: 600,
        pauseOnHover: 'resume',
        fx: 'scroll'
      },

      auto: {
        timeoutDuration: 6000,
        // play: true
        play: false
      },

      swipe: {
        onTouch: true,
        onMouse: true
      }
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* HOME LOOKBOOK 2 SLIDESHOW
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#home-lookbook-2-slideshow').length) return;

    $('#home-lookbook-2-slideshow .mv-slider-wrapper').carouFredSel({
      infinite: true,
      circular: true,
      responsive: true,
      debug: false,

      scroll: {
        items: 1,
        duration: 600,
        pauseOnHover: 'resume',
        fx: 'scroll'
      },

      auto: {
        timeoutDuration: 6000,
        // play: true
        play: false
      },

      swipe: {
        onTouch: true,
        onMouse: true
      }
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* HOME PARALLAX SLIDESHOW
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#home-parallax-slideshow').length) return;

    $('#home-parallax-slideshow .mv-slider-wrapper').carouFredSel({
      infinite: true,
      circular: true,
      responsive: true,
      debug: false,

      scroll: {
        items: 1,
        duration: 600,
        pauseOnHover: 'resume',
        fx: 'scroll'
      },

      auto: {
        timeoutDuration: 6000,
        // play: true
        play: false
      },

      swipe: {
        onTouch: true,
        onMouse: true
      }
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* THUMBNAIL EFFECT
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.mv-effect-one-by-one').length) return;

    $('.mv-effect-one-by-one .mv-effect-item:first-child').addClass('active');

    function cycleActive(Wrapper, Item) {
      var active;

      $(Wrapper).find(Item).each(function() {
        $(this).hasClass('active') ? active = $(this) : ''; // if $(this) has class active: active = $(this)
      });

      var next = active.next();
      
      active.next().length <= 0 ? next = $(Wrapper).find(Item).first() : ''; // if run to last child: next = first child

      active.removeClass('active');
      next.addClass('active');
    }

    var step;
    var checkHover;

    $(document.body).on('mouseenter', '.mv-effect-one-by-one', function() {
      checkHover = true;
      var wrapper = $(this);
      var item = wrapper.find('.mv-effect-item');

      item.first().next().addClass('active');
      item.first().removeClass('active');

      if (checkHover) {
        step = setInterval(function() {
          cycleActive(wrapper, item);
        }, 1200);
      } else {
        window.clearInterval(step);
      }
    });

    $(document.body).on('mouseleave', '.mv-effect-one-by-one', function() {
      window.clearInterval(step);
      checkHover = false;
      $(this).find('.mv-effect-item').removeClass('active');
      $(this).find('.mv-effect-item').first().addClass('active');
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* PARALLAX
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.mv-parallax').length) return;

    $('.mv-parallax').parallax({
      speed: 0.3
    });

    setTimeout(function() {
      $(window).trigger('resize').trigger('scroll');
    }, 1000);

    $('.mv-parallax').appear();

    $(document.body).on('appear', '.mv-parallax', function() {
      $(window).trigger('resize').trigger('scroll');
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* RATING
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('[data-rate="true"]').length) return;

    $('[data-rate="true"]').each(function() {
      var score = $(this).data('score');
      $(this).find('.filled-stars').css('width', ''+ score*10*2 +'%');
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* ENABLED RATING
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.mv-rate.enabled-rating').length) return;

    function convertScoreToText(Score) {
      switch (Score) {
        case 1: return 'Hated it';
        case 2: return 'Disliked it';
        case 3: return 'It\'s OK';
        case 4: return 'Liked it';
        case 5: return 'Loved it';
      }
    }

    function printText(el) {
      var wrapper = el.closest('.mv-rate.enabled-rating');
      var score = wrapper.find('.item-rate.rated').length;
      wrapper.find('.rate-text').text(convertScoreToText(score));
      score == 0 ? wrapper.find('.rate-text').empty() : '';
    }

    $(document.body).on('click', '.mv-rate.enabled-rating .item-rate', function() {
      $(this).closest('.mv-rate.enabled-rating').find('.item-rate').removeClass('rate-on rated');
      $(this).prevAll().andSelf().addClass('rate-on rated');
      console.log($(this).index() + 1);
      $(this).closest('.mv-rate').find('.input-score-rate').val($(this).index() + 1);
      printText($(this));
    });

    $(document.body).on('mouseleave', '.mv-rate.enabled-rating .item-rate', function() {
      $(this).closest('.mv-rate.enabled-rating').find('.item-rate').removeClass('rate-on');
      $(this).closest('.mv-rate.enabled-rating').find('.item-rate.rated').addClass('rate-on');
      printText($(this));
    });

    $(document.body).on('mouseenter', '.mv-rate.enabled-rating .item-rate', function() {
      $(this).closest('.mv-rate.enabled-rating').find('.item-rate').removeClass('rate-on');
      $(this).prevAll().andSelf().addClass('rate-on');
      var score = $(this).index() + 1;
      $(this).closest('.mv-rate.enabled-rating').find('.rate-text').text(convertScoreToText(score));
    });

    // status-rated
    $('.mv-rate.enabled-rating').each(function() {
      var wrapper = $(this);
      var score = wrapper.find('.input-score-rate').val();
      var itemRate = $(this).find('.item-rate');

      if (score != 0 ) {
        wrapper.removeClass('enabled-rating').addClass('status-rated');
        wrapper.find('.rate-text').text(convertScoreToText(score));

        itemRate.each(function() {
          if ( ($(this).index() + 1) == score ) {
            $(this).prevAll().andSelf().addClass('rate-on rated');
          }
        });

        itemRate.on('click', function(event) {
          event.preventDefault();
          return false;
        });
      }
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* FOOTER NAVIGATION
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#footerNav').length) return;

    function footerNav() {
      $('.footer-title').on('click', function(e) {
        if (getViewport().width >= 992) {
          return false;
        } else {
          e.preventDefault();
        }
      });
    }

    footerNav();

    $(window).on('resize', footerNav);
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* FULLHEIGHT ERROR PAGE
  /* --------------------------------------------------------------------- */
  setTimeout(fullHeight($('.error-page-bg')), 500);

  $(window).on('resize', function() {
    fullHeight($('.error-page-bg'));
  });


  /* --------------------------------------------------------------------- */
  /* BACK TO TOP
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.mv-back-to-top').length) return;

    $(window).on('scroll', function() {
      $(this).scrollTop() > 220 ? $('.mv-back-to-top').addClass('on') : $('.mv-back-to-top').removeClass('on');
    });

    $(document.body).on('click', '.mv-back-to-top', function(event) {
      event.preventDefault();

      $('html, body').animate({
        scrollTop: 0,
        queue: false
      }, 500);

      return false;
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* DATA HREF
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('[data-mv-href]').length) return;

    $(document.body).on('click', '[data-mv-href]', function() {
      window.location = $(this).data('mv-href');
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* DATA PLACEHOLDER
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('[data-mv-placeholder]').length) return;

    $('[data-mv-placeholder]').each(function() {
      var placeholderContent = $(this).data('mv-placeholder');
      $(this).attr('placeholder', placeholderContent);

      $(this).on('focus', function() {
        $(this).attr('placeholder', '');
      });

      $(this).on('blur', function() {
        $(this).attr('placeholder', placeholderContent);
      });
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* SCRIPT DROPDOWN 1
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.script-dropdown-1').length) return;

    $(document.body).on('click', '.btn-dropdown', function() {
      var wrapper = $(this).closest('.script-dropdown-1');

      !wrapper.hasClass('open') ? wrapper.addClass('open') : wrapper.removeClass('open');
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* SCRIPT DROPDOWN 2
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.script-dropdown-2').length) return;

    $(document.body).on('mouseenter', '.script-dropdown-2', function() {
      $(this).addClass('open');
    });

    $(document.body).on('mouseleave', '.script-dropdown-2', function() {
      var dropdown = $(this);

      setTimeout(function() {
        dropdown.closest('.script-dropdown-2').removeClass('open');
      }, 200);
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* PRODUCT DETAIL SLIDER
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.product-detail-slider').length) return;

    $('.product-detail-slider .gallery-main').slick({
      asNavFor: '.product-detail-slider .gallery-thumbs',
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 6000,
      speed: 600,
      infinite: false,
      arrows: false,
      fade: false,
      touchThreshold: 30
    });

    $('.product-detail-slider .gallery-thumbs').slick({
      asNavFor: '.product-detail-slider .gallery-main',
      appendArrows: '.product-detail-slider .slick-slide-control',
      nextArrow: '<button type="button" class="mv-btn mv-btn-style-7 slick-slide-next"><i class="fa fa-angle-right"></i></button>',
      prevArrow: '<button type="button" class="mv-btn mv-btn-style-7 slick-slide-prev"><i class="fa fa-angle-left"></i></button>',
      slidesToShow: 5,
      slidesToScroll: 1,
      infinite: false,
      arrows: true,
      dots: false,
      centerMode: false,
      focusOnSelect: true,
      touchThreshold: 30
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* BLOG DETAIL SLIDER
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.blog-detail-slider').length) return;

    var idNum = 1;

    $('.blog-detail-slider').each(function() {
      $(this).attr('id', 'blogDetailSlider' + idNum);

      var id = $(this).attr('id').toString();

      idNum++;

      $('#'+ id +' .gallery-main').slick({
        asNavFor: '#'+ id +' .gallery-thumbs',
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 6000,
        speed: 600,
        infinite: false,
        arrows: false,
        fade: false,
        touchThreshold: 30
      });

      $('#'+ id +' .gallery-thumbs').slick({
        asNavFor: '#'+ id +' .gallery-main',
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: false,
        arrows: false,
        dots: false,
        centerMode: false,
        focusOnSelect: true,
        touchThreshold: 30
      });
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* TESTIMONIAL ABOUT SLIDER
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#testimonial-about-slider').length) return;

    $('#testimonial-about-slider .gallery-main').slick({
      asNavFor: '#testimonial-about-slider .gallery-thumbs',
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 6000,
      speed: 600,
      infinite: false,
      arrows: false,
      fade: false,
      touchThreshold: 30
    });

    $('#testimonial-about-slider .gallery-thumbs').slick({
      asNavFor: '#testimonial-about-slider .gallery-main',
      slidesToShow: 3,
      slidesToScroll: 1,
      infinite: false,
      arrows: false,
      dots: false,
      centerMode: false,
      focusOnSelect: true,
      touchThreshold: 30
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* INPUT QUANTITY PRODUCT DETAIL (SPINNER INPUT)
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.input-quantity-product-detail').length) return;

    $('.input-quantity-product-detail').each(function() {
      var inputQuantity = $(this);
      var minNum = 1;
      var maxNum = 999;

      var spinner = inputQuantity.spinner({
        numberFormat: 'n',
        min: minNum,
        max: maxNum,

        change: function() {
          $(this).val() < minNum ? $(this).val(minNum) : null;
          $(this).val() > maxNum ? $(this).val(maxNum) : null;
        }
      });
    });    
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* INPUT QUANTITY CART (SPINNER INPUT)
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.input-quantity-cart').length) return;

    $('.input-quantity-cart').each(function() {
      var inputQuantity = $(this);
      var wraper = inputQuantity.closest('.calculate-price-wrapper');
      var unit = wraper.find('.calculate-price-unit');
      var output = wraper.find('.calculate-price-output');
      var minNum = 1;
      var maxNum = 999;

      var outputNum = parseFloat(unit.text()) * parseFloat($(this).val());
      output.text(outputNum.toFixed(2));

      var spinner = inputQuantity.spinner({
        numberFormat: 'n',
        min: minNum,
        max: maxNum,

        change: function() {
          $(this).val() < minNum ? $(this).val(minNum) : null;
          $(this).val() > maxNum ? $(this).val(maxNum) : null;

          var outputNum = parseFloat(unit.text()) * parseFloat($(this).val());
          output.text(outputNum.toFixed(2));
        },
 
        stop: function() {
          var outputNum = parseFloat(unit.text()) * parseFloat($(this).val());
          output.text(outputNum.toFixed(2));
        }
      });
    });    
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* ONLY NUMERIC
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.mv-only-numeric').length) return;

    $('.mv-only-numeric').each(function() {
      $(this).on('keypress', function (e) {
        if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
      });
    });    
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* FILTER
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('[class*="mv-filter-style-"]').length) return;

    $('[class*="mv-filter-style-"]').each(function() {
      var filterButton = $(this).find('.filter-button');
      var filterList = $(this).find('.filter-list');
      var button = filterButton.find('button');
 
      var grid = filterList.isotope({
        itemSelector: '.filter-list .filter-item',
        layoutMode: 'fitRows'
      });

      button.each(function() {
        if ($(this).hasClass('active')) {
          grid.isotope({
            filter: $(this).data('filter')
          });
        }
      });

      button.on('click', function() {
        grid.isotope({
          filter: $(this).data('filter')
        });

        button.removeClass('active');
        $(this).addClass('active');
      });
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* POST MANSORY
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.mv-post-mansory-wrapper').length) return;

    $('.mv-post-mansory-wrapper').each(function() {
      $(this).isotope({
        itemSelector: '.mv-post-mansory-item'
      });
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* LIGHTBOX STYLE 1 - LIGHTBOX GALLERY
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.mv-lightbox-style-1').length) return;

    $('.mv-lightbox-style-1').each(function() {
      var wrapper = $(this);

      wrapper.magnificPopup({
        delegate: '.mv-lightbox-item',
        type: 'image',
        tLoading: 'Loading image #%curr%...',

        gallery: {
          enabled: true,
          navigateByImgClick: true,
          preload: [0, 1]
        },

        image: {
          tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',

          titleSrc: function(item) {
            var link = item.el.data('lightbox-href');
            var title = item.el.attr('title');
            return '<a class="text-uppercase" href="' + link + '">' + title + '</a>';
          }
        },

        callbacks: {
          open: function() {
            $('body').addClass('has-lightbox');
            $('.mfp-wrap').addClass('mv-lightbox-style-1-popup');
          },

          close: function() {
            $('body').removeClass('has-lightbox');
          }
        }
      });
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* SLIDER RANGE
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.mv-slider-range').length) return;

    $('.mv-slider-range').each(function() {
      var wrapper = $(this);
      var sliderRange = wrapper.find('.slider-range');
      var minValue = wrapper.find('.min-value');
      var maxValue = wrapper.find('.max-value');

      sliderRange.slider({
        range: true,
        min: 10,
        max: 5000,
        values : [10, 5000],
        slide: function (event, ui) {
          minValue.text(ui.values[0]);
          maxValue.text(ui.values[1]);
        }
      });

      minValue.text(sliderRange.slider('values', 0));
      maxValue.text(sliderRange.slider('values', 1));
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* APPEAR
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.mv-animated').length) return;

    $('.mv-animated').appear();

    $(document.body).on('appear', '.mv-animated', function() {
      $(this).addClass('go');
    });

    $(document.body).on('disappear', '.mv-animated', function() {
      $(this).removeClass('go');
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* COUNTER
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.mv-number-counter').length) return;

    $('.mv-number-counter').appear(); // require jquery-appear

    $(document.body).on('appear', '.mv-number-counter', function() {
      var counter = $(this);

      if (!counter.hasClass('count-complete')) {
        counter.countTo({
          speed: 1500,
          refreshInterval: 100,
          
          onComplete: function() {
            counter.addClass('count-complete');
          }
        });
      }
    });

    $(document.body).on('disappear', '.mv-number-counter', function() {
      $(this).removeClass('count-complete');
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* PROGRESS CIRCLE - PIE CHART - SHORTCODES
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.mv-progress-circle').length) return;

    $('.mv-progress-circle').asPieProgress({
      namespace: 'mv-progress-circle',

      classes: {
        svg: 'mv-progress-circle-svg',
        element: 'mv-progress-circle',
        number: 'mv-progress-circle-number'
      }
    });

    $('.mv-progress-circle').appear(); // require jquery-appear

    $(document.body).on('appear', '.mv-progress-circle', function() {
      $(this).asPieProgress('start');
    });

    $(document.body).on('disappear', '.mv-progress-circle', function() {
      $(this).asPieProgress('reset');
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* PROGRESS CIRCLE STYLE 2 - PIE CHART - SHORTCODES
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.mv-progress-circle-style-2').length) return;

    $('.mv-progress-circle-style-2').each(function() {
      var wrapper = $(this);
      var label = wrapper.find('.mv-progress-circle-label');
      var bgCopy = wrapper.find('.bg-copy');
      var barcolor = wrapper.find('[data-barcolor]').data('-barcolor');

      bgCopy.css('border-color', '' + barcolor + '');

      wrapper.on({
        mouseenter: function() {
          bgCopy.css('background-color', '' + barcolor + '');
          label.css('color', '' + barcolor + '');
        },

        mouseleave: function() {
          bgCopy.css('background-color', '');
          label.css('color', '');
        }
      });
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* FADE ANIMATION SLIDER - SHORTCODES
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#fade-animation-slider').length) return;

    $('#fade-animation-slider .mv-slider-wrapper').carouFredSel({
      infinite: true,
      circular: true,
      responsive: true,
      debug: false,

      scroll: {
        items: 1,
        duration: 600,
        pauseOnHover: 'resume',
        fx: 'fade'
      },

      auto: {
        timeoutDuration: 6000,
        play: true
      },

      swipe: {
        onTouch: true,
        onMouse: true
      },

      pagination: {
        container: '#fade-animation-slider-indicators'
      },

      prev: {
        button: '#fade-animation-slider-prev'
      },

      next: {
        button: '#fade-animation-slider-next'
      }
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* AUTO ANIMATION SLIDER - SHORTCODES
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#auto-animation-slider').length) return;

    $('#auto-animation-slider .mv-slider-wrapper').carouFredSel({
      infinite: true,
      circular: true,
      responsive: true,
      debug: false,

      scroll: {
        items: 1,
        duration: 600,
        pauseOnHover: 'resume',
        fx: 'scroll'
      },

      auto: {
        timeoutDuration: 6000,
        play: true
      },

      swipe: {
        onTouch: true,
        onMouse: true
      },
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* RANDOM SLIDER WITH TIMER - SHORTCODES
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#random-slider-with-timer').length) return;

    $('#random-slider-with-timer .mv-slider-wrapper').carouFredSel({
      infinite: true,
      circular: true,
      responsive: true,
      debug: false,

      items: {
        start: 'random'
      },

      scroll: {
        items: 1,
        duration: 600,
        pauseOnHover: 'resume',
        fx: 'scroll'
      },

      auto: {
        timeoutDuration: 6000,
        play: true,
        progress: {
          bar: '#random-slider-with-timer-timer'
        }
      },

      swipe: {
        onTouch: true,
        onMouse: true
      },

      pagination: {
        container: '#random-slider-with-timer-indicators'
      }
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* JPLAYER VIDEO 1 (HORIZONTAL TAB - SHORTCODES PAGE)
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#jplayer-video-1').length) return;

    $('#jplayer-video-1').jPlayer({
      ready: function() {
        $(this).jPlayer('setMedia', {
          m4v: 'http://www.jplayer.org/video/m4v/Big_Buck_Bunny_Trailer.m4v'
        })
      },

      size: {
        width: '100%',
        height: '100%'
      },

      swfPath: '../libs/jplayer/dist/jplayer',
      cssSelectorAncestor: '#jplayer-interface-video-1',
      supplied: 'm4v,'
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* RESIZE HEIGHT
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('[data-mv-resize-height]').length) return;

    $('[data-mv-resize-height]').each(function() {
      var height = $(this).data('mv-resize-height');

      $(this).on('click', function() {
        $(this).css({
          'max-height': height
        });
      });
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* MAP CONTACT
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('#mv-map-canvas').length) return;

    var latitude = $('#mv-map-canvas').data('latitude');
    var longitude = $('#mv-map-canvas').data('longitude');
    var address = $('#mv-map-canvas').data('address');

    var mapInfoBox =  '<div class="map-info-box">' +
                        '<div class="mv-dp-table align-middle w-auto">' +
                          '<div class="mv-dp-table-cell col-icon">' +
                            '<a href="http://maps.google.com/maps?q=loc:'+ latitude +','+ longitude +'", target="_blank" class="icon-home">'+ '<i class="fa fa-home mv-f-50"></i>' +'</a>' +
                          '</div>' +
                          '<div class="mv-dp-table-cell col-text">' + 
                            '<a href="http://maps.google.com/maps?q=loc:'+ latitude +','+ longitude +'", target="_blank">'+ address +'</a>' +
                          '</div>' +
                        '</div>' +
                      '</div>';

    function mapInitialize() {
      var myLatlng = new google.maps.LatLng(latitude, longitude)
      var mapOptions = {
        center: myLatlng,
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
        draggable: true
      };

      var map = new google.maps.Map(document.getElementById('mv-map-canvas'), mapOptions);

      var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        'icon': 'images/icon/icon_map_marker_3.png'
      });

      var infowindow = new google.maps.InfoWindow({
        content: mapInfoBox
      });

      infowindow.open(map, marker);

      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map, marker);
      });
    }

    mapInitialize();
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* ADD TO CART BUTTON
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.btn-add-to-cart').length) return;

    $(document.body).off('dbclick').on('click', '.btn-add-to-cart', function() {
      var post = $(this).closest('.post');
      var messageAction = post.find('.content-message .message-inner');
      var htmlString =  '<i class="fa fa-check mv-color-primary"></i> ';
      
      if ( !$(this).hasClass('active') ) {
        $(this).addClass('active');
        $(this).find('.btn-text').text('Dodaj u korpu');
        messageAction.html(htmlString).hide().fadeIn();
        document.getElementById('dodavanjeproizvoda').submit("dodajukorpu");
      } else {
        messageAction.html(htmlString).hide().fadeIn();
      }
    });
    
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* ADD TO WISHLIST BUTTON
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.btn-add-to-wishlist').length) return;

    $(document.body).off('dbclick').on('click', '.btn-add-to-wishlist', function() {
      var post = $(this).closest('.post');
      var messageAction = post.find('.content-message .message-inner');
      var htmlString =  '<i class="fa fa-check mv-color-primary"></i> 1 item added to wishlist. <a href="wishlist.html"><strong>View wishlist</strong></a>';

      if ( !$(this).hasClass('active') ) {
        $(this).addClass('active');
        messageAction.html(htmlString).hide().fadeIn();
      } else {
        messageAction.html(htmlString).hide().fadeIn();
      }
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* DELETE PRODUCT
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.btn-delete-product').length) return;

    $(document.body).on('click', '.btn-delete-product', function() {
      $(this).closest('.post').fadeOut(300, function() {
        $(this).remove();
      });
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* DIFFERENT ADDRESS (CHECKOUT PAGE)
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.form-different-address').length) return;

    $('.block-different-address').hide();
    
    function checkCheckbox(el) {
      if (el.prop('checked') == true) {
        $('.form-different-address input[type="text"]').removeAttr('disabled');
        $('.form-different-address input[type="email"]').removeAttr('disabled');
        $('.form-different-address select').removeAttr('disabled');
        $('.block-different-address').show();
      } else {
        $('.form-different-address input[type="text"]').attr('disabled', '');
        $('.form-different-address input[type="email"]').attr('disabled', '');
        $('.form-different-address select').attr('disabled', '');
        $('.block-different-address').hide();
      }
    }

    checkCheckbox($('.form-different-address .checkbox-different-address'));

    $('.form-different-address').on('change', '.checkbox-different-address', function() {
      checkCheckbox($(this));
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* CHOOSE METHOD PAYMENT (CHECKOUT PAGE)
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.method-payment-list').length) return;

    $('.method-payment-list .item').each(function() {
      var item = $(this);

      item.find('.radio-list input[type="radio"]').each(function() {
        $(this).prop('checked') == true ? item.addClass('active') : '';
      });
    });

    $('.btn-choose-method').off('dbclick').on('click', function() {
      var thisItem = $(this).closest('.item');

      $(this).closest('.method-payment-list').find('.item').removeClass('active');
      $(this).closest('.method-payment-list').find('.radio-list input[type="radio"]').prop('checked', false);

      if ( !thisItem.hasClass('active') ) {
        thisItem.addClass('active');
        thisItem.find('.radio-list .radio-children').eq(0).find('input[type="radio"]').prop('checked', true);
      } else {
        thisItem.removeClass('active');
      }
    });

    $('.method-payment-list .radio-list input[type="radio"]').on('change', function() {
      $('.method-payment-list').find('.item').removeClass('active');
      $(this).prop('checked') == true ? $(this).closest('.item').addClass('active') : '';
    });
  })(jQuery);


  /* --------------------------------------------------------------------- */
  /* SHOW NEWSLETTER
  /* --------------------------------------------------------------------- */
  (function($) {
    if (!$('.show-newsletter').length) return;

    // show popupNewsletter after 2 seconds
    setTimeout(function() {
      $('#popupNewsletter').modal('show');
    }, 2000);
  })(jQuery);


 
});

