/* Created by Artisteer v4.0.0.55648 */
/*jshint forin:true, noarg:true, noempty:true, eqeqeq:true, bitwise:true, strict:true, undef:true, curly:true, browser:true, jquery:false */
/*global jQuery */

// css helper
(function ($) {
    'use strict';
    var data = [
        { str: navigator.userAgent, sub: 'Chrome', ver: 'Chrome', name: 'chrome' },
        { str: navigator.vendor, sub: 'Apple', ver: 'Version', name: 'safari' },
        { prop: window.opera, ver: 'Opera', name: 'opera' },
        { str: navigator.userAgent, sub: 'Firefox', ver: 'Firefox', name: 'firefox' },
        { str: navigator.userAgent, sub: 'MSIE', ver: 'MSIE', name: 'ie' }
    ];
    var v = function (s, n) {
        var i = s.indexOf(data[n].ver);
        return (i !== -1) ? parseInt(s.substring(i + data[n].ver.length + 1), 10) : '';
    };
    for (var n = 0; n < data.length; n++) {
        if ((data[n].str && (data[n].str.indexOf(data[n].sub) !== -1)) || data[n].prop) {
            $('html').addClass(data[n].name + ' ' + data[n].name + v(navigator.userAgent, n) || v(navigator.appVersion, n));
            break;
        }
    }
})(jQuery);

jQuery(function ($) {
    'use strict';
    var i, j, k, l, m;
    if (!$.browser.msie || parseInt($.browser.version, 10) !== 9) {
        return;
    }

    var splitByTokens = function (str, startToken, endToken, last) {
        if (!last) {
            last = false;
        }
        var startPos = str.indexOf(startToken);
        if (startPos !== -1) {
            startPos += startToken.length;
            var endPos = last ? str.lastIndexOf(endToken) : str.indexOf(endToken, startPos);

            if (endPos !== -1 && endPos > startPos) {
                return str.substr(startPos, endPos - startPos);
            }
        }
        return '';
    };

    var splitWithBrackets = function (str, token, brackets) {
        /*jshint nonstandard:true */
        if (!token) {
            token = ',';
        }
        if (!brackets) {
            brackets = '()';
        }
        var bracket = 0;
        var startPos = 0;
        var result = [];
        if (brackets.lenght < 2) {
            return result;
        }
        var pos = 0;
        while (pos < str.length) {
            var ch = str[pos];
            if (ch === brackets[0]) {
                bracket++;
            }
            if (ch === brackets[1]) {
                bracket--;
            }
            if (ch === token && bracket < 1) {
                result.push(str.substr(startPos, pos - startPos));
                startPos = pos + token.length;
            }
            pos++;
        }
        result.push(str.substr(startPos, pos - startPos));
        return result;
    };

    var byteToHex = function (d) {
        var hex = Number(d).toString(16);
        while (hex.length < 2) {
            hex = "0" + hex;
        }
        return hex;
    };

    for(i = 0; i < document.styleSheets.length; i++) {
        var s = document.styleSheets[i];
        var r = [s];
        for (j = 0; j < s.imports.length; j++) {
            r.push(s.imports[j]);
        }
        for(j = 0; j < r.length; j++) {
            s = r[j];
            var n = [];
            for (k = 0; k < s.rules.length; k++) {
                var css = s.rules[k].cssText || s.rules[k].style.cssText;
                if (!css) {
                    continue;
                }
                var value = splitByTokens(css, '-svg-background:', ';');
                if (value === '') {
                    continue;
                }
                var values = splitWithBrackets(value);
                for (l = 0; l < values.length; l++) {
                    var g = splitByTokens(values[l], 'linear-gradient(', ')', true);
                    if (g === '') {
                        continue;
                    }
                    var args = splitWithBrackets(g);
                    if (args.length < 3) {
                        continue;
                    }
                    var direction = 'x1="0%" y1="0%" ' + (args[0].trim() === 'left' ? 'x2="100%" y2="0%"' : 'x2="0%" y2="100%"');
                    var stops = '';
                    for (m = 1; m < args.length; m++) {
                        var stopValues = splitWithBrackets(args[m].trim(), ' ');
                        if (stopValues.length < 2) {
                            continue;
                        }
                        var stopColor = stopValues[0].trim();
                        var stopOpacity = 1;
                        var colorRgba = splitByTokens(stopColor, 'rgba(', ')', true);
                        if (colorRgba !== "") {
                            var rgba = colorRgba.split(',');
                            if (rgba.length < 4) {
                                continue;
                            }
                            stopColor = '#' + byteToHex(rgba[0]) + byteToHex(rgba[1]) + byteToHex(rgba[2]);
                            stopOpacity = rgba[3];
                        }
                        stops += '<stop offset="' + stopValues[1].trim() + '" stop-color="' + stopColor + '" stop-opacity="' + stopOpacity + '"/>';
                    }
                    values[l] = values[l].replace('linear-gradient(' + g + ')', 'url(data:image/svg+xml,' + escape('<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1 1" preserveAspectRatio="none"><linearGradient id="g" gradientUnits="userSpaceOnUse" ' + direction + '>' + stops + '</linearGradient><rect x="0" y="0" width="1" height="1" fill="url(#g)" /></svg>') + ')');
                }
                n.push({ s: s.rules[k].selectorText, v: 'background: ' + values.join(",") });
            }
            for (k = 0; k < n.length; k++) {
                s.addRule(n[k].s, n[k].v);
            }
        }
    }

});


jQuery(function ($) {
    'use strict';
    if (!$.browser.msie || parseInt($.browser.version, 10) > 7) {
        return;
    }
    $('ul.art-hmenu>li:not(:first-child)').each(function () { $(this).prepend('<span class="art-hmenu-separator"> </span>'); });
    if (!$.browser.msie || parseInt($.browser.version, 10) > 6) {
        return;
    }
    $('ul.art-hmenu li').each(function () {
        this.j = $(this);
        this.UL = this.j.children('ul:first');
        if (this.UL.length === 0) {
            return;
        }
        this.A = this.j.children('a:first');
        this.onmouseenter = function () {
            this.j.addClass('art-hmenuhover');
            this.UL.addClass('art-hmenuhoverUL');
            this.A.addClass('art-hmenuhoverA');
        };
        this.onmouseleave = function() {
            this.j.removeClass('art-hmenuhover');
            this.UL.removeClass('art-hmenuhoverUL');
            this.A.removeClass('art-hmenuhoverA');
        };
    });
});

jQuery(function ($) {
    'use strict';
    $("ul.art-hmenu a:not([href])").attr('href', '#').click(function (e) { e.preventDefault(); });
});


jQuery(function ($) {
    'use strict';
    if (!$.browser.msie) {
        return;
    }
    var ieVersion = parseInt($.browser.version, 10);
    if (ieVersion > 7) {
        return;
    }

    /* Fix width of submenu items.
    * The width of submenu item calculated incorrectly in IE6-7. IE6 has wider items, IE7 display items like stairs.
    */
    $.each($("ul.art-hmenu ul"), function () {
        var maxSubitemWidth = 0;
        var submenu = $(this);
        var subitem = null;
        $.each(submenu.children("li").children("a"), function () {
            subitem = $(this);
            var subitemWidth = subitem.outerWidth();
            if (maxSubitemWidth < subitemWidth) {
                maxSubitemWidth = subitemWidth;
            }
        });
        if (subitem !== null) {
            var subitemBorderLeft = parseInt(subitem.css("border-left-width"), 10) || 0;
            var subitemBorderRight = parseInt(subitem.css("border-right-width"), 10) || 0;
            var subitemPaddingLeft = parseInt(subitem.css("padding-left"), 10) || 0;
            var subitemPaddingRight = parseInt(subitem.css("padding-right"), 10) || 0;
            maxSubitemWidth -= subitemBorderLeft + subitemBorderRight + subitemPaddingLeft + subitemPaddingRight;
            submenu.children("li").children("a").css("width", maxSubitemWidth + "px");
        }
    });

    if (ieVersion > 6) {
        return;
    }
    $("ul.art-hmenu ul>li:first-child>a").css("border-top-width", "px");
});
jQuery(function () {
    'use strict';
    setHMenuOpenDirection({
        container: "div.art-sheet",
        defaultContainer: "#art-main",
        menuClass: "art-hmenu",
        leftToRightClass: "art-hmenu-left-to-right",
        rightToLeftClass: "art-hmenu-right-to-left"
    });
});

var setHMenuOpenDirection = (function($) {
    'use strict';
    return (function(menuInfo) {
        var defaultContainer = $(menuInfo.defaultContainer);
        defaultContainer = defaultContainer.length > 0 ? defaultContainer = $(defaultContainer[0]) : null;

        $("ul." + menuInfo.menuClass + ">li>ul").each(function () {
            var submenu = $(this);
            var submenuWidth = submenu.outerWidth();
            var submenuLeft = submenu.offset().left;

            var mainContainer = submenu.parents(menuInfo.container);
            mainContainer = mainContainer.length > 0 ? mainContainer = $(mainContainer[0]) : null;

            var container = mainContainer || defaultContainer;
            if (container !== null) {
                var containerLeft = container.offset().left;
                var containerWidth = container.outerWidth();

                if (submenuLeft + submenuWidth >= containerLeft + containerWidth) {
                    /* right to left */
                    submenu.addClass(menuInfo.rightToLeftClass).find("ul").addClass(menuInfo.rightToLeftClass);
                } else if (submenuLeft <= containerLeft) {
                    /* left to right */
                    submenu.addClass(menuInfo.leftToRightClass).find("ul").addClass(menuInfo.leftToRightClass);
                }
            }
        });
    });
})(jQuery);


jQuery(window).load(function () {
    'use strict';
    var sheet = jQuery(".art-sheet");
    var sheetLeft = sheet.offset().left;
    var sheetWidth = sheet.width();
    var styleStr = "";
    var style = jQuery("<style></style>").appendTo('head');
    style = document.styleSheets[document.styleSheets.length - 1];

    jQuery(".art-hmenu>li").each(function(i, v) {
        var itm = jQuery(this);
        var subm = itm.children("ul");
        if (subm.length === 0) {
            return;
        }

        var lw = 0, rw = 0;
        if (typeof subm.attr("data-ext-l") !== "undefined" && typeof subm.attr("data-ext-r") !== "undefined") {
            lw = parseInt(subm.attr("data-ext-l"), 10) + 3;
            rw = parseInt(subm.attr("data-ext-r"), 10) + 3;
            itm.addClass("ext-r").addClass("ext-l");
        } else {
            var ltr = !subm.hasClass("art-hmenu-right-to-left");
            itm.addClass(ltr ? "ext-r" : "ext-l");
        }

        var shadow = 3;
        if (subm.length > 0) {
            var lnk = itm.children("a");
            var lnkWidth = lnk.outerWidth();
            itm.css("width", Math.round(parseFloat(lnkWidth, 10)) + "px");
            var menubarMargin = 4 * 2; // margin * 2 sides
            var menubarBorder = 0 * 2; // border 1 side
            var submWidth = subm.width() + shadow + menubarMargin + menubarBorder;
            var w = submWidth - lnkWidth;
            jQuery("<div class=\"ext-m\"></div>").insertBefore(lnk);
            if (w < 0) {
                var submA = subm.children("li").children("a");
                var pL = parseInt(submA.css("padding-left").replace("px", ""), 10) || 0;
                var pR = parseInt(submA.css("padding-right").replace("px", ""), 10) || 0;
                var bL = parseInt(submA.css("border-left").replace("px", ""), 10) || 0;
                var bR = parseInt(submA.css("border-right").replace("px", ""), 10) || 0;
                subm.children("li").children("a").css("width", (lnkWidth - pL - pR - bL - bR) + "px");
                submWidth = subm.width() + shadow + menubarMargin + menubarBorder;
                w = submWidth - lnkWidth;
            }
            jQuery("<div class=\"ext-l\" style=\"width: " + (lw > 0 ? lw : Math.round(parseFloat(w, 10))) + "px;\"></div>").insertBefore(lnk);
            jQuery("<div class=\"ext-r\" style=\"width: " + (rw > 0 ? rw : Math.round(parseFloat(w, 10))) + "px;\"></div>").insertBefore(lnk);
            itm.addClass("ext");
            if (style !== null && typeof style.insertRule !== "undefined") {
                var cls = "art-hmenu-item-" + i;
                var selector = "ul.art-hmenu>li." + cls + ":hover>ul:before";
                var r = submWidth;
                var b = subm.height() + (shadow * 2) + menubarBorder + menubarMargin;
                var rule = "clip: rect(7px, " + Math.round(parseFloat(r, 10)) + "px, " + Math.round(parseFloat(b, 10)) + "px, -" + shadow + "px);";
                itm.addClass(cls);
                var rulesLen = style.cssRules === null ? 0 : style.cssRules.length;
                style.insertRule(selector + '{' + rule + '}', rulesLen);
            }
        }
    });
});

jQuery(function ($) {
    'use strict';

    if ($.browser.msie && parseInt($.browser.version, 10) < 8) {
        $(window).bind('resize', function() {
            var c = $('div.art-content');
            var s = c.parent().children('.art-layout-cell:not(.art-content)');
            var w = 0;
            c.hide();
            s.each(function() { w += $(this).outerWidth(true); });
            c.w = c.parent().width(); c.css('width', c.w - w + 'px');
            c.show();
        });
    }

    $(window).trigger('resize');
});

var artButtonSetup = (function ($) {
    'use strict';
    return (function (className) {
        $.each($("a." + className + ", button." + className + ", input." + className), function (i, val) {
            var b = $(val);
            if (!b.hasClass('art-button')) {
                b.addClass('art-button');
            }
            if (b.is('input')) {
                b.val(b.val().replace(/^\s*/, '')).css('zoom', '1');
            }
            b.mousedown(function () {
                var b = $(this);
                b.addClass("active");
            });
            b.mouseup(function () {
                var b = $(this);
                if (b.hasClass('active')) {
                    b.removeClass('active');
                }
            });
            b.mouseleave(function () {
                var b = $(this);
                if (b.hasClass('active')) {
                    b.removeClass('active');
                }
            });
        });
    });
})(jQuery);
jQuery(function () {
    'use strict';
    artButtonSetup("art-button");
});

jQuery(function($) {
    'use strict';
    $('form.art-search>input[type="submit"]').attr('value', '');
});

var Control = (function ($) {
    'use strict';
    return (function () {
        this.init = function(label, callback) {
            label.mouseleave(function () {
              $(this).removeClass('hovered').removeClass('active');
            });
            label.mouseover(function () {
              $(this).addClass('hovered').removeClass('active');
            });
            label.mousedown(function (event) {
              if (event.which !== 1) {
                  return;
              }
              $(this).addClass('active').removeClass('hovered');
            });
            label.mouseup(function (event) {
              if (event.which !== 1) {
                  return;
              }
              callback.apply(this);
              $(this).removeClass('active').addClass('hovered');
            });
        };
    });
})(jQuery);


var fixRssIconLineHeight = (function (className) {
    'use strict';
    jQuery("." + className).css("line-height", jQuery("." + className).height() + "px");
});

jQuery(function ($) {
    'use strict';
    var rssIcons = $(".art-rss-tag-icon");
    if (rssIcons.length){
        fixRssIconLineHeight("art-rss-tag-icon");
        if ($.browser.msie && parseInt($.browser.version, 10) < 9) {
            rssIcons.each(function () {
                if ($.trim($(this).html()) === "") {
                    $(this).css("vertical-align", "middle");
                }
            });
        }
    }
});
/**
* @license 
* jQuery Tools 1.2.6 Mousewheel
* 
* NO COPYRIGHTS OR LICENSES. DO WHAT YOU LIKE.
* 
* http://flowplayer.org/tools/toolbox/mousewheel.html
* 
* based on jquery.event.wheel.js ~ rev 1 ~ 
* Copyright (c) 2008, Three Dub Media
* http://threedubmedia.com 
*
* Since: Mar 2010
* Date:  
*/
(function ($) {
    'use strict';
    $.fn.mousewheel = function (fn) {
        return this[fn ? "bind" : "trigger"]("wheel", fn);
    };

    // special event config
    $.event.special.wheel = {
        setup: function () {
            $.event.add(this, wheelEvents, wheelHandler, {});
        },
        teardown: function () {
            $.event.remove(this, wheelEvents, wheelHandler);
        }
    };

    // events to bind ( browser sniffed... )
    var wheelEvents = !$.browser.mozilla ? "mousewheel" : // IE, opera, safari
        "DOMMouseScroll" + ($.browser.version < "1.9" ? " mousemove" : ""); // firefox

    // shared event handler
    function wheelHandler(event) {
        /*jshint validthis:true*/
        
        switch (event.type) {

            // FF2 has incorrect event positions
            case "mousemove":
                return $.extend(event.data, { // store the correct properties
                    clientX: event.clientX, clientY: event.clientY,
                    pageX: event.pageX, pageY: event.pageY
                });

                // firefox
            case "DOMMouseScroll":
                $.extend(event, event.data); // fix event properties in FF2
                event.delta = -event.detail / 3; // normalize delta
                break;

            // IE, opera, safari
            case "mousewheel":
                event.delta = event.wheelDelta / 120;
                break;
        }

        event.type = "wheel"; // hijack the event
        return $.event.handle.call(this, event, event.delta);
    }

})(jQuery);


var ThemeLightbox = (function ($) {
    'use strict';
    return (function () {
        var current;
        var images = $("img.art-lightbox");

        var b = $("body");

        this.init = function (ctrl) {
            $("img.art-lightbox").live("click", { _ctrl: ctrl }, function (e) {

                if (e.data._ctrl === true && !e.ctrlKey) {
                    return;
                }

                reload();
                current = images.index(this);
                show(this);
            });

            $(".arrow.left:not(.disabled)").live("click", function () {
                move(current - 1);
            });

            $(".arrow.right:not(.disabled)").live("click", function () {
                move(current + 1);
            });

            $("img.active").live("click", function () {
                move(current + 1);
            });

            $(".close").live("click", function () {
                close();
            });
        };

        function show(src) {
            var d = $('<div id="art-lightbox-bg"><div class="close"><div class="cw"> </div><div class="ccw"> </div></div></div>');

            var img = $('<img class="art-lightbox-image active" alt="" src="' + getFullImgSrc($(src).attr("src")) + '" />');

            resizeOnLoad(img);
            img.appendTo(b);
            showArrows();

            showLoader(true);

            img.load(function () {
                showLoader(false);
                d.appendTo(b).height(Math.max(document.documentElement.scrollHeight, document.body.scrollHeight));
            });

            img.error(function () {
                showLoader(false);
                d.appendTo(b).height(Math.max(document.documentElement.scrollHeight, document.body.scrollHeight));

                //showError(true);
                img.attr("src", $(src).attr("src"));
            });
            d.click(close);
            bindMouse($(".arrow").add(img).add(d));
        }

        function reload() {
            images = $("img.art-lightbox");
        }

        function move(index) {
            if (index < 0 || index >= images.length) {
                return;
            }

            showError(false);

            current = index;

            $("img.art-lightbox-image:not(.active)").remove();

            var active = $("img.active");

            var target = $('<img class="art-lightbox-image" alt="" src="' + getFullImgSrc($(images[current]).attr("src")) + '" />');

            resizeOnLoad(target);
            active.after(target);

            showArrows();
            showLoader(true);

            bindMouse($("#art-lightbox-bg").add(target));

            target.load(function () {
                showLoader(false);

                active.removeClass("active");
                target.addClass("active");
            });

            target.error(function () {
                showLoader(false);

                //showError(true);
                active.removeClass("active");
                target.addClass("active");
                target.attr("src", $(images[current]).attr("src"));
            });
        }

        function showArrows() {
            if ($(".arrow").length === 0) {
                b.append($('<div class="arrow left"><div class="arrow-t ccw"> </div><div class="arrow-b cw"> </div></div>').css("top", $(window).height() / 2 - 40));

                b.append($('<div class="arrow right"><div class="arrow-t cw"> </div><div class="arrow-b ccw"> </div></div>').css("top", $(window).height() / 2 - 40));
            }

            if (current === 0) {
                $(".arrow.left").addClass("disabled");
            } else {
                $(".arrow.left").removeClass("disabled");
            }

            if (current === images.length - 1) {
                $(".arrow.right").addClass("disabled");
            } else {
                $(".arrow.right").removeClass("disabled");
            }
        }

        function showError(enable) {
            if (enable) {
                b.append($('<div class="lightbox-error">The requested content cannot be loaded.<br/>Please try again later.</div>')
                        .css({ "top": $(window).height() / 2 - 60, "left": $(window).width() / 2 - 170 }));
            } else {
                $(".lightbox-error").remove();
            }
        }

        function showLoader(enable) {
            if (!enable) {
                $(".loading").remove();
            }
            else {
                $('<div class="loading"> </div>').css({ "top": $(window).height() / 2 - 16, "left": $(window).width() / 2 - 16 }).appendTo(b);
            }
        }

        var close = function () {
            $("#art-lightbox-bg, .art-lightbox-image, .arrow, .lightbox-error").remove();
        };

        function resizeOnLoad(img) {
            var width = $(window).width();
            var height = $(window).height();

            img.load(function () {
                var imgHeight = $(this).height();

                var imgWidth = $(this).width();

                // additional space is needed for the next|prev items and border around the images
                if (height < (imgHeight + 10) || width < (imgWidth + 410)) {
                    var hScale = imgWidth / (width - 410);
                    var vScale = imgHeight / (height - 100);

                    var scale = Math.max(vScale, hScale);

                    imgWidth = imgWidth / scale;
                    imgHeight = imgHeight / scale;

                    img.width(imgWidth);
                    img.height(imgHeight);
                }

                img.css({ "top": (height / 2 - imgHeight / 2) - 5, "left": (width / 2 - imgWidth / 2 - 5) });
            });

            return img;
        }

        function bindMouse(img) {
            img.unbind("wheel").mousewheel(function (event, delta) {
                delta = delta > 0 ? 1 : -1;
                move(current + delta);
                event.preventDefault();
            });

            img.mousedown(function (e) {
                // close on middle button click
                if (e.which === 2) {
                    close();
                }
                e.preventDefault();
            });
        }

        function getFullImgSrc(src) {
            var webArchiveRegex = new RegExp("http://www.[A-z0-9-]+-image.com/.webarchive/");
            if ((src.indexOf("http://") === 0 || src.indexOf("https://") === 0) && !webArchiveRegex.test(src)) {
                return src;
            }

            var fileName = src.substring(0, src.lastIndexOf('.'));
            var ext = src.substring(src.lastIndexOf('.'));
            src = fileName + "-large" + ext;

            return src;
        }

    });
})(jQuery);
jQuery(function () {
    'use strict';
    new ThemeLightbox().init();
});
(function($) {
    'use strict';
    // transition && transitionEnd && browser prefix
    $.support.transition = (function() {
        var thisBody = document.body || document.documentElement,
            thisStyle = thisBody.style,
            support = thisStyle.transition !== undefined ||
                thisStyle.WebkitTransition !== undefined ||
                thisStyle.MozTransition !== undefined ||
                thisStyle.MsTransition !== undefined ||
                thisStyle.OTransition !== undefined;
        return support && {
            event: (function() {
                var e = "TransitionEnd";
                if ($.browser.opera) {
                    e = parseInt($.browser.version, 10) >= 12 ? "otransitionend" : "oTransitionEnd";
                } else if ($.browser.mozilla) {
                    e = "transitionend";
                } else if ($.browser.webkit) {
                    e = "webkitTransitionEnd";
                }
                return e;
            })(),
            prefix: (function() {
                var result;
                $.each($.browser, function(key, value) {
                    if (key === "version") {
                        return true;
                    }
                    return (result = {
                        opera: "-o-",
                        mozilla: "-moz-",
                        webkit: "-webkit-",
                        msie: "-ms-"
                    }[key]) ? false : true;
                });
                return result || "";
            })()
        };
    })();

    window.BackgroundHelper = function () {
        var slides = [];
        var direction = "next";
        var motion = "horizontal";
        var width = 0;
        var height = 0;
        var transitionDuration = "";

        this.init = function(motionType, dir, duration) {
            direction = dir;
            motion = motionType;
            slides = [];
            width = 0;
            height = 0;
            transitionDuration = duration;
        };

        this.processSlide = function(element) {
            width = element.outerWidth();
            height = element.outerHeight();
            var pos = [];

            var bgPosition = element.css("background-position");
            var positions = bgPosition.split(",");
            $.each(positions, function (i) {
                var position = $.trim(this);
                var point = position.split(" ");
                if (point.length > 1) {
                    var x = parseInt(point[0], 10);
                    var y = parseInt(point[1], 10);
                    pos.push({ x: x, y: y });
                }
            });

            slides.push({
                "images": element.css("background-image"),
                "positions": pos
            });
            element.css("background-image", "none");
        };

        this.setBackground = function(element, items) {
            var bg = [];
            $.each(items, function (i, o) {
                bg.push(o.images);
            });
            element.css({
                "background-image": bg.join(", "),
                "background-repeat": "no-repeat"
            });
        };

        this.setPosition = function(element, items) {
            var pos = [];
            $.each(items, function(i, o) {
                pos.push(o.positions);
            });
            element.css({
                "background-position": pos.join(", ")
            });
        };

        this.current = function(index) {
            return slides[index] || null;
        };

        this.next = function(index) {
            var next;
            if (direction === "next") {
                next = (index + 1) % slides.length;
            } else {
                next = index - 1;
                if (next < 0) {
                    next = slides.length - 1;
                }
            }
            return slides[next];
        };

        this.items = function(prev, next, move) {
            var prevItem = { x: 0, y: 0 };
            var nextItem = { x: 0, y: 0 };
            var isDirectionNext = direction === "next";
            if (motion === "horizontal") {
                nextItem.x = isDirectionNext ? width : -width;
                nextItem.y = 0;
                if (move) {
                    prevItem.x += isDirectionNext ? -width : width;
                    nextItem.x += isDirectionNext ? -width : width;
                }
            } else if (motion === "vertical") {
                nextItem.x = 0;
                nextItem.y = isDirectionNext ? height : -height;
                if (move) {
                    prevItem.y += isDirectionNext ? -height : height;
                    nextItem.y += isDirectionNext ? -height : height;
                }
            }
            var result = [ ];
            if (!!prev) {
                result.push({ images: prev.images, positions: getCssPositions(prev.positions, prevItem) });
            }
            if (!!next) {
                result.push({ images: next.images, positions: getCssPositions(next.positions, nextItem) });
            }
            
            if (direction === "next") {
                result.reverse();
            }

            return result;
        };

        this.transition = function(container, on) {
            container.css($.support.transition.prefix + "transition", on ? transitionDuration + " ease-in-out background-position" : "");
        };
        
        function getCssPositions(positions, offset) {
            var result = [];
            if (positions === undefined) {
                return "";
            }
            offset.x = offset.x || 0;
            offset.y = offset.y || 0;
            for (var i = 0; i < positions.length; i++) {
                result.push((positions[i].x + offset.x) + "px " + (positions[i].y + offset.y) + "px");
            }
            return result.join(", ");
        }
    };


    var Slider = function (element, settings) {

        var interval = null;
        var active = false;
        var children = element.find(".active").parent().children();
        var last = false;
        var running = false;

        this.settings = $.extend({ }, {
            "animation": "horizontal",
            "direction": "next",
            "speed": 600,
            "pause": 2500,
            "auto": true,
            "repeat": true,
            "navigator": null,
            "clickevents": true,
            "hover": true,
            "helper": null
        }, settings);

        this.move = function (direction, next) {
            var activeItem = element.find(".active"),
                nextItem = next || activeItem[direction](),
                innerDirection = this.settings.direction === "next" ? "forward" : "back",
                reset = direction === "next" ? "first" : "last",
                moving = interval,
                slider = this, tmp;

            active = true;

            if (moving) { this.stop(true); }

            if (!nextItem.length) {
                nextItem = element.find(".art-slide-item")[reset]();
                if (!this.settings.repeat) { last = true; active = false; return; }
            }

            if ($.support.transition) {
                nextItem.addClass(this.settings.direction);
                tmp = nextItem.get(0).offsetHeight;
                
                activeItem.addClass(innerDirection);
                nextItem.addClass(innerDirection);
                
                element.trigger("beforeSlide", children.length);
                
                element.one($.support.transition.event, function () {
                    nextItem.removeClass(slider.settings.direction)
                        .removeClass(innerDirection)
                        .addClass("active");
                    activeItem.removeClass("active")
                        .removeClass(innerDirection);
                    active = false;
                    setTimeout(function () {
                        element.trigger("afterSlide", children.length);
                    }, 0);
                });
            } else {
                element.trigger("beforeSlide", children.length);
                
                activeItem.removeClass("active");
                nextItem.addClass("active");
                active = false;
                
                element.trigger("afterSlide", children.length);
            }

            this.navigate(nextItem);

            if (moving) { this.start(); }
        };

        this.navigate = function (position) {
            var index = children.index(position);
            $(this.settings.navigator).children().removeClass("active").eq(index).addClass("active");
        };

        this.to = function (index) {
            var activeItem = element.find(".active"),
                children = activeItem.parent().children(),
                activeIndex = children.index(activeItem),
                slider = this;

            if (index > (children.length - 1) || index < 0) {
                return;
            }

            if (active) {
                return element.one("afterSlide", function () {
                    slider.to(index);
                });
            }
            
            if (activeIndex === index) {
                return;
            }

            this.move(index > activeIndex ? "next" : "prev", $(children[index]));
        };

        this.next = function () {
            if (!active) {
                if (last) { this.stop(); return;  }
                this.move("next");
            }
        };

        this.prev = function () {
            if (!active) {
                if (last) { this.stop(); return; }
                this.move("prev");
            }
        };

        this.start = function (force) {
            if (!!force) {
                setTimeout($.proxy(this.next, this), 10);
            }
            interval = setInterval($.proxy(this.next, this), this.settings.pause);
            running = true;
        };

        this.stop = function (pause) {
            clearInterval(interval);
            interval = null;
            running = !!pause;
        };

        this.active = function () {
            return running;
        };

        this.moving = function () {
            return active;
        };
        
        this.navigate(children.filter(".active"));

        if (this.settings.clickevents) {
            $(this.settings.navigator).on("click", "a", { slider: this }, function (event) {
                var activeIndex = children.index(children.filter(".active"));
                var index = $(this).parent().children().index($(this));
                if (activeIndex !== index) {
                    event.data.slider.to(index);
                }
                event.preventDefault();
            });
        }
        
        if (this.settings.hover) {
            var slider = this;
            element.add(this.settings.navigator)
                   .add(element.siblings(".art-shapes")).hover(function () {
                if (element.is(":visible") && !last) { slider.stop(true); }
            }, function () {
                if (element.is(":visible") && !last) { slider.start(); }
            });
        }
    };

    $.fn.slider = function (arg) {
        return this.each(function () {
            var element = $(this),
                data = element.data("slider"),
                options = typeof arg === "object" && arg;

            if (!data) {
                data = new Slider(element, options);
                element.data("slider", data);
            }
            
            if (typeof arg === "string" && data[arg]) {
                data[arg]();
            } else if (data.settings.auto) {
                data.start();
            }
        });
    };

})(jQuery);




jQuery(function($) {
    'use strict';
    var slideContainer = $(".art-slidecontainerheader"), tmp;

    if ($.fn.slider && slideContainer.length) {
        var inner = $(".art-slider-inner", slideContainer);
        var helper = null;
        
        
        inner.children().eq(0).addClass("active");
        slideContainer.slider({
            pause: 2000,
            speed: 1000,
            repeat: true,
            animation: "fade",
            direction: "next",
            navigator: ".art-slidenavigatorheader",
            helper: helper
                    });
    }
});

jQuery(window).bind("resize", function () {
    'use strict';
    if (jQuery(".art-header-inner").length === 0) {
        return;
    }
    var sheetWidth = jQuery(".art-sheet").width();
    var sheetLeft = jQuery(".art-sheet").offset().left;
    jQuery("header.art-header .art-shapes").children().each(function () {
        var object = jQuery(this);
        var objectLeft = sheetWidth * parseFloat(object.attr("data-left")) / 100 + sheetLeft;
        object.css("left", objectLeft + "px");
    });
});

jQuery(function () {
    'use strict';
    jQuery(window).trigger("resize");
});
