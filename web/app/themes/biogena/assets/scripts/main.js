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
    var downSlider, oldPostType,fullSlider,
    downSliderOptions={
                    autoplay: 2000,
                    slidesPerView: 'auto',
                    autoplayDisableOnInteraction: true,
                    pagination:'.slideshow .navigation',
                    loop:true,
                    paginationClickable:true
                  ,nextButton: '.swiper-button-next',
                  prevButton: '.swiper-button-prev'
    },
    bodyClasses=['home','post-type-archive-linee','azienda','single-linee','single-area-skin-care','post-type-archive-area-skin-care','no-full-slider'];
    // Use this variable to set up the common and page specific functions. If you
    // rename this variable, you will also need to rename the namespace below.
    var Sage = {
        // All pages
        'common': {
            init: function() {
                if ($('.background-slider .wp-post-image,.background-container .wp-post-image').length) {
                    BackgroundCheck.init({
                        targets: '.nav-primary',
                        images: '.background-slider .wp-post-image,.background-container .wp-post-image'
                    });
                    if ($('.background-slider .wp-post-image').length) {
                        fullSlider = new Swiper('.background-slider', {
                            autoplay: 3500,
                            slidesPerView: 1,
                            autoplayDisableOnInteraction: true,
                            onSlideChangeEnd: function() {
                                BackgroundCheck.refresh();
                            }
                        });
                    }
                }

                $('body').on('click', 'a[href*="/area-skin-care/"],a[href*="/linee/"]', linkCallback);

                window.onpopstate = popstateCallback;
                var search = new UISearch(document.getElementById('sb-search'));

              if($('.slider-patologie').length)downSlider = new Swiper('.slider-patologie', downSliderOptions);
              //$('.content-wrapper>.flag-media>.flag-body').readmore();
            }
        },
        'single_prodotti': {
            init: function() {
                    (function() {
                        var d = document,
                            accordionToggles = d.querySelectorAll('.js-accordionTrigger'),
                            setAria,
                            setAccordionAria,
                            switchAccordion,
                            touchSupported = ('ontouchstart' in window),
                            pointerSupported = ('pointerdown' in window);

                        skipClickDelay = function(e) {
                            e.preventDefault();
                            e.currentTarget.click();
                        }

                        setAriaAttr = function(el, ariaType, newProperty) {
                            el.setAttribute(ariaType, newProperty);
                        };
                        setAccordionAria = function(el1, el2, expanded) {
                            switch (expanded) {
                                case "true":
                                    setAriaAttr(el1, 'aria-expanded', 'true');
                                    setAriaAttr(el2, 'aria-hidden', 'false');
                                    break;
                                case "false":
                                    setAriaAttr(el1, 'aria-expanded', 'false');
                                    setAriaAttr(el2, 'aria-hidden', 'true');
                                    break;
                                default:
                                    break;
                            }
                        };
                        //function
                        switchAccordion = function(e) {
                            e.preventDefault();
                            var thisAnswer = e.currentTarget.parentNode.nextElementSibling;
                            var thisQuestion = e.currentTarget;
                            if (thisAnswer.classList.contains('is-collapsed')) {
                                setAccordionAria(thisQuestion, thisAnswer, 'true');
                            } else {
                                setAccordionAria(thisQuestion, thisAnswer, 'false');
                            }
                            thisQuestion.classList.toggle('is-collapsed');
                            thisQuestion.classList.toggle('is-expanded');
                            thisAnswer.classList.toggle('is-collapsed');
                            thisAnswer.classList.toggle('is-expanded');

                            thisAnswer.classList.toggle('animateIn');
                        };
                        for (var i = 0, len = accordionToggles.length; i < len; i++) {
                            if (touchSupported) {
                                accordionToggles[i].addEventListener('touchstart', skipClickDelay, false);
                            }
                            if (pointerSupported) {
                                accordionToggles[i].addEventListener('pointerdown', skipClickDelay, false);
                            }
                            accordionToggles[i].addEventListener('click', switchAccordion, false);
                        }
                    })();
            }
        }
    }
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
    function popstateCallback(event) {
      if (!!event.state) {
          kindAjax(event.state.href,false);
      }else{

        document.location.reload()
      }
    };
    function linkCallback(e) {
        e.preventDefault();
        kindAjax(e.currentTarget.href,true);
    }

    function kindAjax(URL,pop) {
        var index, checkPostType,postData,postType,menu, submenu,submenus,
            last = url(-1, URL),
            penultimate = url(-2, URL);
            checkPostType = findPostType();
            postData = checkPostType[0];
            postType = checkPostType[1];
            index = checkIndex();
            template();
            var body=$('body');
            body.removeClass(bodyClasses.join(' '));
            body.addClass('single-'+postType);
            if(postType==='linee')body.addClass('no-full-slider');
            if(!!pop){
              history.pushState(
                { href:URL},
                "", URL
              );
            }
            if (fullSlider instanceof Swiper) fullSlider.destroy(true, true);
            fullSlider=null;
            if(postType!==oldPostType){
              oldPostType=postType;
              if(postType==='linee'){

              }
            }
            menu = $('.' + postType);
            if (menu.length !== menu.add('.active').length) {
                $('#menu-menu-1>.menu-item,#menu-mobile-menu.menu-item').removeClass('active');
                menu.addClass('active');
            }
            submenus = menu.find('.sub-menu li');
            submenu = submenus.slice(index , index + 1);
            if (submenu.length !== submenu.add('.active').length) {
                $('.sub-menu .menu-item').removeClass('active');
                submenu.addClass('active');
            }
            if ($('.background-slider .wp-post-image,.background-container .wp-post-image').length) {
              BackgroundCheck.set('images', '.background-slider .wp-post-image,.background-container .wp-post-image');
              BackgroundCheck.refresh();
            }
            if (downSlider instanceof Swiper) downSlider.destroy(true, true);
            downSlider=null;
            if($('.slider-patologie').length)downSlider = new Swiper('.slider-patologie', {                    autoplay: 2000,
                    slidesPerView: 'auto',
                    autoplayDisableOnInteraction: true,
                    pagination:'.slideshow .navigation',
                    loop:true,
                    paginationClickable:true});


        function findPostType() {
            return !!collegamenti[last] ? [collegamenti[last], last] : !!collegamenti[penultimate] ? [collegamenti[penultimate], penultimate] : null;
        }

        function checkIndex() {
            var keys  = Object.keys(postData)
            var rightK=keys.filter(function(e) {
                return url(-1, postData[e].permalink) === last;
            })[0]
            var index = keys.indexOf(rightK);
            return index !== -1 ? index : 0;
        }

        function template() {
            var keys  = Object.keys(postData)
            var circleRpl = _.template($('#'+postType).text()),
                data={
                    first:postData[keys[index]],
                    next:postData[keys[(index+1)<keys.length?index+1:0]] ,
                    prev:postData[keys[(index-1)>-1?(index-1):keys.length-1]]
                },
                aaa = circleRpl(data);
            $('.page-wrapper>.content>.main').html(aaa);
        }
    }
    (function(window) {

        'use strict';

        // class helper functions from bonzo https://github.com/ded/bonzo

        function classReg(className) {
            return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
        }

        // classList support for class management
        // altho to be fair, the api sucks because it won't accept multiple classes at once
        var hasClass, addClass, removeClass;

        if ('classList' in document.documentElement) {
            hasClass = function(elem, c) {
                return elem.classList.contains(c);
            };
            addClass = function(elem, c) {
                elem.classList.add(c);
            };
            removeClass = function(elem, c) {
                elem.classList.remove(c);
            };
        } else {
            hasClass = function(elem, c) {
                return classReg(c).test(elem.className);
            };
            addClass = function(elem, c) {
                if (!hasClass(elem, c)) {
                    elem.className = elem.className + ' ' + c;
                }
            };
            removeClass = function(elem, c) {
                elem.className = elem.className.replace(classReg(c), ' ');
            };
        }

        function toggleClass(elem, c) {
            var fn = hasClass(elem, c) ? removeClass : addClass;
            fn(elem, c);
        }

        var classie = {
            // full names
            hasClass: hasClass,
            addClass: addClass,
            removeClass: removeClass,
            toggleClass: toggleClass,
            // short names
            has: hasClass,
            add: addClass,
            remove: removeClass,
            toggle: toggleClass
        };

        // transport
        if (typeof define === 'function' && define.amd) {
            // AMD
            define(classie);
        } else {
            // browser global
            window.classie = classie;
        }

    })(window);;
    (function(window) {


        function mobilecheck() {
            var check = false;
            (function(a) {
                if (/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true
            })(navigator.userAgent || navigator.vendor || window.opera);
            return check;
        }

        // http://www.jonathantneal.com/blog/polyfills-and-prototypes/
        !String.prototype.trim && (String.prototype.trim = function() {
            return this.replace(/^\s+|\s+$/g, '');
        });

        function UISearch(el, options) {
            this.el = el;
            this.inputEl = el.querySelector('form > input.sb-search-input');
            this._initEvents();
        }

        UISearch.prototype = {
            _initEvents: function() {
                var self = this,
                    initSearchFn = function(ev) {
                        ev.stopPropagation();
                        // trim its value
                        self.inputEl.value = self.inputEl.value.trim();

                        if (!classie.has(self.el, 'sb-search-open')) { // open it
                            ev.preventDefault();
                            self.open();
                        } else if (classie.has(self.el, 'sb-search-open') && /^\s*$/.test(self.inputEl.value)) { // close it
                            ev.preventDefault();
                            self.close();
                        }
                    }

                this.el.addEventListener('click', initSearchFn);
                this.el.addEventListener('touchstart', initSearchFn);
                this.inputEl.addEventListener('click', function(ev) {
                    ev.stopPropagation();
                });
                this.inputEl.addEventListener('touchstart', function(ev) {
                    ev.stopPropagation();
                });
            },
            open: function() {
                var self = this;
                classie.add(this.el, 'sb-search-open');
                // focus the input
                if (!mobilecheck()) {
                    this.inputEl.focus();
                }
                // close the search input if body is clicked
                var bodyFn = function(ev) {
                    self.close();
                    this.removeEventListener('click', bodyFn);
                    this.removeEventListener('touchstart', bodyFn);
                };
                document.addEventListener('click', bodyFn);
                document.addEventListener('touchstart', bodyFn);
            },
            close: function() {
                this.inputEl.blur();
                classie.remove(this.el, 'sb-search-open');
            }
        }

        // add to global namespace
        window.UISearch = UISearch;

    })(window);
})(jQuery); // Fully reference jQuery after this point.
