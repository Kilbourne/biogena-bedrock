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
    var isfullImage = function() {
            return $('.background-slider .wp-post-image,.background-container .wp-post-image');
        },
        fullSliderSelector = '.background-slider,.background-container.specialita.double',
        isbigClaim = function() {
            return $('.post-type-archive-linee .background-container.specialita .big-claim,  .single-linee .background-container.specialita .big-claim');
        },
        ask = function() {
            return $('.post-type-archive-area-skin-care,.single-area-skin-care');
        },
        azienda = function() {
            return $('body.azienda');
        },
        osmin = 'osmin-linea-pediatrica',
        attiviSelector = function() {
            return $('.attivi');
        },
        isAccordion = function() {
            return $('body.single-prodotti,body.single-linee .single-product-wrapper,body.post-type-archive-linee .single-product-wrapper').length;
        },
        isSingleLinea = function() {
            return $('body.single-linee .single-linea').length;
        },
        bodyClasses = ['home', 'post-type-archive-linee', 'azienda', 'single-linee', 'single-area-skin-care', 'post-type-archive-area-skin-care', 'no-full-slider', 'page', 'search', 'error404', 'osmin-linea-pediatrica'];

    var downSlider, oldPostType, fullSlider, swiperAttivi, swiperProd, linkCallbackBusy = false,
        prodottoSingle, titles, boxreadinaction = false,
        safariBug = false,
        lang = {
            "it_IT": {
                'Leggi Tutto': 'Leggi Tutto',
                'Chiudi': 'Chiudi'
            },
            "en_GB": {
                'Leggi Tutto': "Read More",
                'Chiudi': "Close"
            }
        },
        breakpoints = {
            "palm": "screen and (max-width: 49.9375em)",
            "lap": "screen and (min-width: 50em) and (max-width: 63.9375em)",
            "lap-and-up": "screen and (min-width: 50em)",
            "portable": "screen and (max-width: 63.9375em)",
            "desk": "screen and (min-width: 64em)",
            "retina": "(-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi), (min-resolution: 2dppx)"
        };



    var lineeSliderOpt = function() {
            return swiperOptions({
                slides: 1,
                controlsPrefix: '.products'
            });
        },
        homeSlider = function() {
            return swiperOptions({
                slides: 1,
                controls: true,
                lazyNext: true,
                custom: 'homeCustom'
            });
        },
        downSliderOptions = function() {
            return swiperOptions({
                custom: 'autoplay',
                controlsPrefix: '.slider-patologie'
            });
        },
        downSliderHomeOptions = function() {
            return swiperOptions({
                controlsPrefix: '.slider-patologie-home'
            });
        },
        attiviSliderOptions = function() {
            return swiperOptions({
                custom: 'closeText',
                controlsPrefix: '.attivi-wrapper'
            });
        };
    var Sage = {
        // All pages
        'common': {
            init: function() {
                FastClick.attach(document.body);
                fullImage();
                $('body').on('click', 'a[href*="/area-skin-care/"],a[href*="/linee/"]', linkCallback);
                $('body').on('click', '.readmore1', readmoreCallback);
                $('body').on('mouseenter mouseleave', '.swiper-container-horizontal', stopAutoplayOnHover);
                $('body').on('click', '.attivo', readmoreAttiviCallback);
                $('body').on('click', '.boxx .readmore-box', boxReadMore);
                $('body').on('submit', 'form#loginform', biogena_ajax_login);
                enquire.register(breakpoints['lap-and-up'], {
                    match: callbackDesktop,
                    unmatch: callbackMobile
                });
                if (window.matchMedia(breakpoints['lap-and-up']).matches) {
                    callbackDesktop()
                } else {
                    callbackMobile()
                }

                //$(window).scroll(videoScroll);
                $(window).resize(_.debounce(responsiveMediaElement, 500));
                window.onpopstate = popstateCallback;
                var search = new UISearch(document.getElementById('sb-search'));
                responsiveMediaElement();
                popUp();
                osminMenu();
                secondSlider();
                accordion();
                postArchiveMenu();
            }
        }
    };

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

    function accordion() {
        if (isAccordion()) {

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
                };

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
                    var opens = $(accordionToggles).filter('.is-expanded');
                    if (opens.length && opens[0] !== thisQuestion) {
                        opens[0].classList.remove('is-expanded');
                        opens[0].classList.remove('is-collapsed');
                        var openAnswer = opens[0].parentNode.nextElementSibling;
                        openAnswer.classList.toggle('is-expanded');
                        openAnswer.classList.toggle('is-collapsed');
                        openAnswer.classList.toggle('animateIn');
                    }
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

    function attiviDesktopSlider() {
        var attivi = attiviSelector();
        if (attivi.length) {
            var attivo = attivi.find('.attivo');
            if (swiperAttivi instanceof Swiper) swiperAttivi.destroy(true, true);
            swiperAttivi = null;
            if ($('.attivi-wrapper .swiper-button,.attivi-wrapper .swiper-pagination').length) $('.attivi-wrapper .swiper-button,.attivi-wrapper .swiper-pagination').remove();
            attivi.removeClass('swiper-wrapper');
            attivo.removeClass('swiper-slide');
            if (attivo.length > 3) {
                if (swiperAttivi instanceof Swiper) {} else {
                    $('.attivi-wrapper').append('<div class="swiper-button swiper-button-prev"></div><div class="swiper-button swiper-button-next"></div><div class="swiper-pagination"></div>').append(function() {
                        attivi.addClass('swiper-wrapper');
                        attivo.addClass('swiper-slide');
                        swiperAttivi = new Swiper('.attivi-wrapper', attiviSliderOptions());
                    });
                }
            }
        }
    }

    function attiviMobileSlider() {
        var attivi = attiviSelector();
        if (attivi.length) {
            var attivo = attivi.find('.attivo');
            if (swiperAttivi instanceof Swiper) swiperAttivi.destroy(true, true);
            swiperAttivi = null;
            if ($('.attivi-wrapper .swiper-button,.attivi-wrapper .swiper-pagination').length) $('.attivi-wrapper .swiper-button,.attivi-wrapper .swiper-pagination').remove();
            attivi.removeClass('swiper-wrapper');
            $('.attivo').removeClass('swiper-slide');
            if (attivo.length > 1) {
                if (swiperAttivi instanceof Swiper) {} else {
                    $('.attivi-wrapper').append('<div class="swiper-button swiper-button-prev"></div><div class="swiper-button swiper-button-next"></div><div class="swiper-pagination"></div>').append(function() {
                        attivi.addClass('swiper-wrapper');
                        attivo.addClass('swiper-slide');

                        swiperAttivi = new Swiper('.attivi-wrapper', attiviSliderOptions());
                    });
                }
            }
        }
    }

    function bigClaim() {

        if (isbigClaim().length) {
            isbigClaim().fitText(4);
        } else {
            $('.big-claim').fitText(2);
        }
    }

    function bigClaimOff() {
        $(window).off('resize.fittext orientationchange.fittext');
    }

    function biogena_ajax_login(e) {

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
            data: {
                'action': 'ajax_login', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#loginform #user_login').val(),
                'password': $('form#loginform #user_pass').val(),
                'security': $('#security').val()
            },
            success: function(data) {

                if (data.loggedin === true) {
                    $.magnificPopup.instance.updateItemHTML();
                } else {
                    $('#loginform').append('<p style="color:red;" >' + data.message + '</p>');
                }
            }
        });
        e.preventDefault();
    }

    function boxMobile(){
      var clickB = $('.boxx.js-open .readmore-box'),
                textBody = clickB.parent(),
                wrapper = textBody.parent(),
                img=wrapper.children('img'),
                parag = textBody.children('p,.list-wrapper'),
                clickBox = wrapper.parent(),
                contentWrapper = clickBox.parent(),
                allBox = contentWrapper.children('.boxx'),
                otherBox = allBox.not(clickBox);
    contentWrapper.removeClass('auto-height');
    clickBox.removeClass('full-width');
    wrapper.toggleClass('now full open-apd left fadeIn');
    textBody.removeClass('fadeIn');
    otherBox.show();
}

function boxDesktop(){
              var clickB = $('.boxx.js-open .readmore-box'),
                textBody = clickB.parent(),
                wrapper = textBody.parent(),
                img=wrapper.children('img'),
                parag = textBody.children('p,.list-wrapper'),
                clickBox = wrapper.parent(),
                contentWrapper = clickBox.parent(),
                allBox = contentWrapper.children('.boxx'),
                otherBox = allBox.not(clickBox);
    contentWrapper.addClass('auto-height')
    clickBox.addClass('full-width')
    wrapper.toggleClass('now full open-apd left fadeIn');
    textBody.addClass('fadeIn');
    otherBox.hide();
}

    function boxReadMore(e) {
        if (!boxreadinaction) {
            boxreadinaction = true;

            var clickB = $(e.currentTarget),
                textBody = clickB.parent(),
                wrapper = textBody.parent(),
                img=wrapper.children('img'),
                parag = textBody.children('p,.list-wrapper'),
                clickBox = wrapper.parent(),
                contentWrapper = clickBox.parent(),
                allBox = contentWrapper.children('.boxx'),
                otherBox = allBox.not(clickBox);
            if (window.matchMedia("(max-width: 49.999em)").matches) {
                if (!clickBox.hasClass('js-open')) {
                    wrapper.add(img).addClass('transparent').not(img).delay(800).queue(function() {
                        wrapper.addClass('nobg');
                        parag.addClass('maxHeight padding-now now');
                        clickB.text(lang[window.wp_locale].Chiudi);
                        wrapper.toggleClass('transparent fadeIn');

                        $(this).dequeue();
                    });
                    clickBox.addClass('js-open');
                } else {
                    wrapper.toggleClass('transparent fadeIn').delay(800).queue(function() {


                        clickB.text(lang[window.wp_locale]['Leggi Tutto']);
                        wrapper.add(img).toggleClass('transparent fadeIn');
                        wrapper.removeClass('nobg');
                        parag.removeClass('padding-now');
                        $(this).dequeue();
                    }).delay(800).queue(function() {
                        parag.removeClass('now');
                        wrapper.add(img).removeClass(' fadeIn');
                        clickBox.removeClass('js-open');
                        $(this).dequeue();
                    });
                    parag.removeClass('maxHeight');
                }

            } else {

                if (!clickBox.hasClass('js-open')) {
                    textBody.add(img).addClass('transparent').not(img).delay(800).queue(function() {
                        wrapper.addClass('now full');



                        wrapper.addClass('open-pad');
                        parag.addClass('maxHeight padding-now');

                        $(this).dequeue();
                    }).delay(800).queue(function() {
                        clickB.text(lang[window.wp_locale].Chiudi);
                        textBody.toggleClass('transparent fadeIn');
                        contentWrapper.addClass('auto-height');
                        clickBox.addClass('full-width js-open');
                        otherBox.hide();

                        wrapper.removeClass('absolute  ');

                        $(this).dequeue();
                    });
                    if(wrapper.hasClass('left')){wrapper.removeClass('left');}
                    wrapper.addClass(' absolute  ');
//                    otherBox.children().children('img').hide();

                } else {
                    textBody.toggleClass('transparent fadeIn').delay(800).queue(function() {
                      contentWrapper.removeClass('auto-height');
                      parag.removeClass('maxHeight padding-now');
                      var aaa='full ';
                      if(clickBox.is('.box1,.box2,.box3')){ aaa='full absolute';}
                      wrapper.toggleClass(aaa);
                      clickBox.removeClass('full-width ');

otherBox.addClass('absolute');
otherBox.children().children('.flag-body,img').addClass('transparent');
otherBox.show(800);
                        $(this).dequeue();
                    }).delay(900).queue(function() {
                        wrapper.removeClass('open-pad');
                        wrapper.removeClass('absolute');
                        wrapper.toggleClass('  now  left ');
                        clickB.text(lang[window.wp_locale]['Leggi Tutto']);
                        textBody.add(img).add(otherBox.children().children('.flag-body,img')).toggleClass('transparent fadeIn');


                        $(this).dequeue();
                    }).delay(700).queue(function() {

                        allBox.removeClass('now');
                        otherBox.removeClass('absolute');
                        textBody.add(img).add(otherBox.children().children('.flag-body,img')).removeClass('fadeIn');
                        clickBox.removeClass('js-open');
                        $(this).dequeue();

                    });

                }
            }
        }
        boxreadinaction = false;
    }

    function callbackDesktop() {
        setTimeout(bigClaim,200);
        attiviMobileSlider();
        boxDesktop();
    }

    function callbackMobile() {
        bigClaimOff();
        attiviDesktopSlider();
        boxMobile();
    }

(function classieCreator() {

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

    })();
    function fullImage() {
        var fi = isfullImage();
        if (!!fi.length) {
            try {
                var success = true;
                try {
                    BackgroundCheck.set('images', '.background-slider .wp-post-image,.background-container .wp-post-image');
                } catch (e) {
                    success = false;
                    fi.imagesLoaded(function() {
                        BackgroundCheck.init({
                            targets: '.nav-primary',
                            images: '.background-slider .wp-post-image,.background-container .wp-post-image'
                        });
                    });
                }
                if (success) {
                    BackgroundCheck.set('images', '.background-slider .wp-post-image,.background-container .wp-post-image');
                }

            } catch (e) {}
            BackgroundCheck.refresh()
            var fs = $(fullSliderSelector);
            if (!!fs.length) {
                if (fullSlider instanceof Swiper) fullSlider.destroy(true, true);
                fullSlider = null;
                fullSlider = new Swiper(fullSliderSelector, homeSlider());
            }
        }
    }

    function kindAjax(URL, pop) {
        linkCallbackBusy = true;
        var index, checkPostType, postData, postType, menu, submenu, submenus,
            last = url(-1, URL),
            penultimate = url(-2, URL);
        checkPostType = findPostType();
        postData = checkPostType[0];
        postType = checkPostType[1];
        index = checkIndex();
        var keys = Object.keys(postData);
        var circleRpl = _.template($('#' + postType).text()),
            data = {
                first: postData[keys[index]],
                next: postData[keys[(index + 1) < keys.length ? index + 1 : 0]],
                prev: postData[keys[(index - 1) > -1 ? (index - 1) : keys.length - 1]]
            },
            aaa = circleRpl(data);
        prodottoSingle = data.first.prodotti.length === 1 ? data.first.prodotti[0].title : '';
        titles = data.first.title;
        var pageW = $('.page-wrapper>.content');
        pageW.children('.main').removeClass('newtemp').addClass('oldtemp');
        pageW.append('<main class="main newtemp" style="display:none;">' + aaa + '</main>');
        var newTemplate = pageW.children('.newtemp');
        newTemplate.children('.background-container').imagesLoaded(function() {
            pageW.children('.oldtemp').fadeOut('400', function() {

                newTemplate.fadeIn();
                $(this).remove();
                var body = $('body');
                body.removeClass(bodyClasses.join(' '));
                body.addClass('single-' + postType);

                if (postType === 'linee') body.addClass('no-full-slider');
                document.title = postData[keys[index]].title + " | Biogena";
                if (!!pop) {
                    history.pushState({
                            href: URL
                        },
                        document.title, URL
                    );
                }
                if (!safariBug) {
                    safariBug = true;
                }

                fullImage();

                menu = $('.' + postType);
                if (menu.length !== menu.add('.active').length) {
                    $('#menu-menu-1>.menu-item,#menu-mobile-menu>.menu-item').removeClass('active');
                    menu.addClass('active');
                }
                $('.sub-menu .menu-item').removeClass('active');
                menu.each(function(i, menu) {
                    submenus = $(menu).find('.sub-menu li');
                    submenu = submenus.slice(index, index + 1);
                    if (submenu.length !== submenu.add('.active').length) {

                        submenu.addClass('active');
                    }
                });

                if (window.matchMedia(breakpoints['lap-and-up']).matches) {
                    callbackDesktop()
                } else {
                    callbackMobile()
                }

                responsiveMediaElement();
                popUp();
                secondSlider();


                if (isSingleLinea()) {
                    titles = titles.replace(' ', '%20');
                    prodottoSingle = prodottoSingle.replace(' ', '%20');
                    var ajaxUrl = !window.ajaxurl ? ajax_login_object.ajaxurl : window.ajaxurl;
                    $.post(ajaxUrl, {
                        action: "get_template_single",
                        title: titles,
                        prodottoSingle: prodottoSingle
                    }, function(data) {
                        $('body.single-linee .single-linea').html(data);
                        accordion();
                    });
                }
                linkCallbackBusy = false;
            });
        });



        function findPostType() {
            return !!collegamenti[last] ? [collegamenti[last], last] : !!collegamenti[penultimate] ? [collegamenti[penultimate], penultimate] : null;
        }

        function checkIndex() {
            var keys = Object.keys(postData);
            var rightK = keys.filter(function(e) {
                return url(-1, postData[e].permalink) === last;
            })[0];
            var index = keys.indexOf(rightK);
            return index !== -1 ? index : 0;
        }


    }

    function linkCallback(e) {
        e.preventDefault();
        if (e.currentTarget.href.indexOf(osmin) > -1) {
            window.location = e.currentTarget.href;
        } else {
            if (linkCallbackBusy) return;
            kindAjax(e.currentTarget.href, true);
        }
    }

    function mobilecheck() {
        var check = false;
        (function(a) {
            if (/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true;
        })(navigator.userAgent || navigator.vendor || window.opera);
        return check;
    }

    function osminMenu() {
        if (document.location.toString().indexOf(osmin) > -1) {
            $('li.menu-prodotti,li.menu-products,.menu-linea-osmin,.menu-osmin-line').removeClass('active');
        }
    }

    function popstateCallback(event) {
        if (!!event.state) {
            kindAjax(event.state.href, false);
        } else if (safariBug) {

            document.location.reload();
        }
    }

    function popUp() {
        $('.ajax-popup-link,.page-template-archive .main > li > a').magnificPopup({
            type: 'ajax',
            tLoading: '<div class="cube1"></div><div class="cube2"></div>',
            closeOnContentClick: false,
            callbacks: {
                ajaxContentAdded: function(data) {

                    var otherLinks = $('.mfp-content .ajax-popup-link-r');
                    if (otherLinks.length) {
                        revursivePopup(otherLinks);
                    }

                },
                beforeOpen: function() {

                    $('.mfp-bg,.mfp-wrap ').remove();


                }
            }
        });
        $('.inline-popup-link').magnificPopup({
            type: 'inline'
        });
    }

    function postArchiveMenu() {
        if ($('body.post-type-archive').length) {
            var menusActive = $('.menu-item.active');
            menusActive.each(function(index, el) {
                var subItems = $(el).find('.sub-menu .menu-item');
                if (subItems.length) subItems.first().addClass('active');
            });
        }
    }

    function readmoreAttiviCallback(e) {
        $(e.currentTarget).find('.attivo-desc').slideToggle();
    }

    function readmoreCallback(e) {
        var text = $(e.currentTarget).text();
        if (text === lang[window.wp_locale]['Leggi Tutto']) {
            $(e.currentTarget).text(lang[window.wp_locale].Chiudi);
        } else {
            $(e.currentTarget).text(lang[window.wp_locale]['Leggi Tutto']);
        }
        $(e.currentTarget).siblings('p').slideToggle();
    }

    function responsiveMediaElement() {
        if (ask().length) {
            var subs = ask().find('.prevenzione,.lineas');
            var heights = subs.map(function() {
                return $(this).height();
            }).get();
            var maxHeight = Math.max.apply(null, heights);
            var minHeight = Math.min.apply(null, heights);
            if (maxHeight / minHeight > 1.8) {
                subs[0].parentElement.classList.add('horizont');
            }
        }
    }

    function revursivePopup(els) {
        els.magnificPopup({
            type: 'ajax',
            tLoading: '<div class="cube1"></div><div class="cube2"></div>',
            closeOnContentClick: false,
            callbacks: {
                ajaxContentAdded: function(data) {

                    var otherLinks = $('.mfp-content .ajax-popup-link-r');
                    if (otherLinks.length) {
                        revursivePopup(otherLinks);
                    }

                },
                beforeOpen: function() {
                    otherLinks.click(function() {
                        $('.mfp-bg,.mfp-wrap ').remove();
                    });

                }
            }
        });
    }

    function secondSlider() {
        if (downSlider instanceof Swiper) downSlider.destroy(true, true);
        downSlider = null;
        if ($('.slider-patologie-home').length) {
            downSlider = new Swiper('.slider-patologie', downSliderHomeOptions());
        } else if ($('.slider-patologie').length) {
            downSlider = new Swiper('.slider-patologie', downSliderOptions());
        }
        if ($('.products .swiper-wrapper').length) {
            if (swiperProd instanceof Swiper) swiperProd.destroy(true, true);
            swiperProd = null;
            swiperProd = new Swiper('.products', lineeSliderOpt());
        }
    }

    function stopAutoplayOnHover(e) {
        var ct = $(e.currentTarget),
            cond = ct.hasClass('slider-patologie') && !ct.hasClass('slider-patologie-home');
        if (e.handleObj.origType === 'mouseenter') {
            if (cond) {
                downSlider.stopAutoplay();
            }
        } else if (e.type === 'mouseleave') {
            if (cond) {
                downSlider.startAutoplay();
            }
        }

    }


    function swiperOptions(opts) {
        var options = {
            preloadImages: false,
            resizeReInit: true,
            lazyLoading: true,
            lazyLoadingOnTransitionStart: true,
            preventClicks:false,
              onTouchStart: function (){
    this.preventClicks = true;
  },
  onTouchMove: function (){
    this.preventClicks = false;
  },
  onTouchEnd: function (){
    var that=this;
    setTimeout(function(){that.preventClicks = true;},100);
  }
        };
        var pref = {
            slides: opts.slides || 'auto',
            controls: opts.controls || false,
            lazyNext: opts.lazyNext || false,
            custom: opts.custom || false,
            controlsPrefix: opts.controlsPrefix || ''
        };
        options.slidesPerView = pref.slides;
        if (options.slidesPerView === 'auto') options.watchSlidesVisibility = true;
        if (pref.controls === false) $.extend(true, options, {
            nextButton: pref.controlsPrefix + ' .swiper-button-next',
            prevButton: pref.controlsPrefix + ' .swiper-button-prev',
            pagination: pref.controlsPrefix + ' .swiper-pagination'
        });
        if (pref.lazyNext === false) options.lazyLoadingInPrevNext = true;
        if (pref.custom !== false) {
            if (pref.custom === 'homeCustom') {
                $.extend(true, options, {
                    autoplay: 7000,
                    loop: true,
                    onSlideChangeEnd: function() {
                        BackgroundCheck.refresh();
                    }
                });
            } else if (pref.custom === 'autoplay') {
                options.autoplay = 5000;
                options.autoplayDisableOnInteraction = true;
            } else if (pref.custom === 'closeText') {
                options.onSlideChangeEnd = function(swiper) {
                    $('.attivo-desc:visible').hide('400');
                };
            }
        };
        return options;
    }

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
                    self.inputEl.value = self.inputEl.value.replace(/^\s+|\s+$/g, '');

                    if (!classie.has(self.el, 'sb-search-open')) { // open it
                        ev.preventDefault();
                        self.open();
                    } else if (classie.has(self.el, 'sb-search-open') && /^\s*$/.test(self.inputEl.value)) { // close it
                        ev.preventDefault();
                        self.close();
                    }
                };

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
    };

    function videoScroll(e) {
        if (azienda().length) {
            var wy = window.scrollY || window.pageYOffset,
                wh = $(window).height(),
                video = $('video'),
                eo = video.offset().top,
                ea = video.height();
            if (wy < eo && (wy + wh) > (eo + (ea / 2))) {
                window.mejs.players.mep_0.play();
            }
        }
    }


})(jQuery); // Fully reference jQuery after this point.
