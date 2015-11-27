/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages




      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    'archive': {
      init: function() {
        var tplData=JSON.parse(collegamenti);
        function linkCallback(e){
                  e.preventDefault();

                  var href=e.currentTarget.href,
                  el = tplData.filter(function(e){return e.permalink===href})[0];
                  var index=tplData.indexOf(el);

                  var circleRpl = _.template($('#patologia').text()),
                  aaa=circleRpl({arrayC:tplData,index:index});

                  $('.main>.content').html(aaa);
                  var menu = $('#menu-item-524 .sub-menu a').filter(function(e){
                    return this.href===href;
                  })[0];
                  $('#menu-item-524 .sub-menu li').removeClass('active');
                  menu.parentElement.classList.add('active');
                             new Swiper('.slider-patologie', {
                  autoplay:2000
                  ,slidesPerView: 3
                  ,autoplayDisableOnInteraction:true
                  });


                  $('.down-nav .next>a,.down-nav .prev>a').click(linkCallback);
        }
        var circleRpl = _.template($('#patologia').text());

        $('.main>.content').append(circleRpl({arrayC:tplData,index:0}));
        var href=tplData[0].permalink;
        var menu = $('#menu-item-524 .sub-menu a').filter(function(e){
                    return this.href===href;
                  })[0];
                  $('#menu-item-524 .sub-menu li').removeClass('active');
                  menu.parentElement.classList.add('active');
                new Swiper('.slider-patologie', {

                  slidesPerView: 3
                  ,autoplayDisableOnInteraction:true
                  });

        $('.down-nav .next>a,.down-nav .prev>a').click(linkCallback);

                 function linkCallback1(e){
                  e.preventDefault();

                  var href=e.currentTarget.href,
                  el = tplData.filter(function(e){return e.permalink===href})[0];
                  var index=tplData.indexOf(el);

                  var circleRpl = _.template($('#patologia').text()),
                  aaa=circleRpl({arrayC:tplData,index:index});

                  $('.main>.content').html(aaa);
                  $('#menu-item-524 .sub-menu li').removeClass('active');
                  e.currentTarget.parentElement.classList.add('active');
                             new Swiper('.slider-patologie', {
                  autoplay:2000
                  ,slidesPerView: 3
                  ,autoplayDisableOnInteraction:true
                  });
                  $('#menu-item-524 .submenu li a').filter(function(e){
                    return e.href
                  })

                  $('.menu-item-524 .sub-menu a').click(linkCallback1);
        }
         $('.menu-item-524 .sub-menu a').click(linkCallback1);

            }
    },
        'single_aree_terapeutiche': {
      init: function() {
        var tplData=JSON.parse(collegamenti);
        function linkCallback(e){
                  e.preventDefault();

                  var href=e.currentTarget.href,
                  el = tplData.filter(function(e){return e.permalink===href})[0];
                  var index=tplData.indexOf(el);

                  var circleRpl = _.template($('#patologia').text()),
                  aaa=circleRpl({arrayC:tplData,index:index});

                  $('.main>.content').html(aaa);
                  var menu = $('#menu-item-524 .sub-menu a').filter(function(e){
                    return this.href===href;
                  })[0];
                  $('#menu-item-524 .sub-menu li').removeClass('active');
                  menu.parentElement.classList.add('active');
                             new Swiper('.slider-patologie', {
                  autoplay:2000
                  ,slidesPerView: 3
                  ,autoplayDisableOnInteraction:true
                  });


                  $('.down-nav .next>a,.down-nav .prev>a').click(linkCallback);
        }
        var circleRpl = _.template($('#patologia').text());
        var index=tplData.indexOf(tplData.filter(function(e){
          return e.permalink===document.location.toString();
        })[0]);
        $('.main>.content').append(circleRpl({arrayC:tplData,index:index}));
        var href=tplData[index].permalink;
        var menu = $('#menu-item-524 .sub-menu a').filter(function(e){
                    return this.href===href;
                  })[0];
                  $('#menu-item-524 .sub-menu li').removeClass('active');
                  menu.parentElement.classList.add('active');
                new Swiper('.slider-patologie', {

                  slidesPerView: 3
                  ,autoplayDisableOnInteraction:true
                  });

        $('.down-nav .next>a,.down-nav .prev>a').click(linkCallback);

                 function linkCallback1(e){
                  e.preventDefault();

                  var href=e.currentTarget.href,
                  el = tplData.filter(function(e){return e.permalink===href})[0];
                  var index=tplData.indexOf(el);

                  var circleRpl = _.template($('#patologia').text()),
                  aaa=circleRpl({arrayC:tplData,index:index});

                  $('.main>.content').html(aaa);
                  $('#menu-item-524 .sub-menu li').removeClass('active');
                  e.currentTarget.parentElement.classList.add('active');
                             new Swiper('.slider-patologie', {
                  autoplay:2000
                  ,slidesPerView: 3
                  ,autoplayDisableOnInteraction:true
                  });
                  $('#menu-item-524 .submenu li a').filter(function(e){
                    return e.href
                  })

                  $('.menu-item-524 .sub-menu a').click(linkCallback1);
        }
         $('.menu-item-524 .sub-menu a').click(linkCallback1);

            }
    },
    // Home page
    'home': {
      init: function() {
                    new Swiper('.background-slider', {
                  autoplay:3500
                  ,slidesPerView: 1
                  ,autoplayDisableOnInteraction:true
                  });
                              new Swiper('.slider-patologie', {
                  slidesPerView: 4
                  ,autoplayDisableOnInteraction:true
                  ,nextButton:'.swiper-button-next'
                  ,prevButton:'.swiper-button-prev'
          });

      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    },
      'single': {
      init: function() {
              new Swiper('.slider-patologie', {
                  autoplay:2000
                  ,slidesPerView: 3
                  ,autoplayDisableOnInteraction:true
          });
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);





})(jQuery); // Fully reference jQuery after this point.
