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




          new Swiper('.background-slider', {
                  autoplay:3500
                  ,slidesPerView: 1
                  ,autoplayDisableOnInteraction:true
          });



      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    'not_home': {
      init: function() {
                      // JavaScript to be fired on all pages
        if(collegamenti) var tplData=JSON.parse(collegamenti);

        function lastPart(URI){
          var parts = URI.split('/');
          return parts.pop() == '' ? parts[parts.length - 1] : parts.pop();
        }
        function searchIndex (URL){
          var href=lastPart(URL),
              index=tplData.indexOf(tplData.filter(function(e){
            return lastPart(e.permalink)===href;
          })[0]);
          return [href,index];
        }
        function template(index){
          var circleRpl = _.template($('#patologia').text()),
          aaa=circleRpl({arrayC:tplData,index:index});
          $('.main>.content').html(aaa);
        }
        function linkCallback(e){
          e.preventDefault();
          var data = searchIndex(e.currentTarget.href);
          template(data[1]);

          if (history) history.pushState({href : e.currentTarget.href },"",e.currentTarget.href);

          $('.menu-aree-terapeutiche .sub-menu li').removeClass('active');
          var menu = $('.menu-aree-terapeutiche .sub-menu a').filter(function(e){
            return lastPart(this.href)===data[0];
          })[0];
          menu.parentElement.classList.add('active');
                  new Swiper('.slider-patologie', {
                    autoplay:2000
                    ,slidesPerView: 3
                    ,autoplayDisableOnInteraction:true
                  });
                  $('.down-nav .next>a,.down-nav .prev>a,.menu-aree-terapeutiche .sub-menu a').click(linkCallback);
        }
        window.onpopstate = function(event) {
          if(event.state){
            var data = searchIndex(event.state.href);
            template(data[1]);

            $('.menu-aree-terapeutiche .sub-menu li').removeClass('active');
            var menu = $('.menu-aree-terapeutiche .sub-menu a').filter(function(e){
              return lastPart(this.href)===data[0];
            })[0];
            menu.parentElement.classList.add('active');
                    new Swiper('.slider-patologie', {
                      autoplay:2000
                      ,slidesPerView: 3
                      ,autoplayDisableOnInteraction:true
                    });
                    $('.down-nav .next>a,.down-nav .prev>a,.menu-aree-terapeutiche .sub-menu a').click(linkCallback);
          }
        };

        var index=tplData.indexOf(tplData.filter(function(e){
          return lastPart(e.permalink)===lastPart(document.location.toString());
        })[0]);
        index= index!==-1?index:0;
        var href=lastPart(tplData[index].permalink);
        var menu = $('.menu-aree-terapeutiche .sub-menu a').filter(function(e){
                    return lastPart(this.href)===href;
                  })[0];
            // $('.menu-aree-terapeutiche .sub-menu li').removeClass('active');
            menu.parentElement.classList.add('active');
            new Swiper('.slider-patologie', {
                  slidesPerView: 3
                  ,autoplayDisableOnInteraction:true
                  });

        $('.down-nav .next>a,.down-nav .prev>a,.menu-aree-terapeutiche .sub-menu a').click(linkCallback);

    }
  },
        'single_aree_terapeutiche': {
      init: function() {

            }
    },
    // Home page
    'home': {
      init: function() {


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
