var url = "/news";
var popWidth = (screen.availWidth).toString();
var popHeight = (screen.availHeight).toString();
var popAttributes = 'scrollbars=yes,location=yes,statusbar=yes,menubar=no,left=0,top=0,width=' + popWidth + ',height=' + popHeight + '';
var pop;
var chrome23gt = ($.browser.chrome && parseInt($.browser.version) >= 23);
var chrome_23_lock = false;
$(function () {
    $(".table_news").on('mousedown click', function (event) {
        return popunder(false, event)
    });
    $("a").on('mousedown click', function (event) {
        event.stopPropagation();
        return popunder($(this), event)
    });
    if ((urihash = window.location.hash.toString()) && urihash.indexOf('scrollTop') > -1) {
        $("body").scrollTop(urihash.substring(urihash.indexOf('scrollTop') + 10))
    }
});

function popunder(openlink, e) {
    var onlySetFocus = false;
    if (e.type == 'mousedown') {
        if (chrome23gt && (e.which == 1 || (e.which == 2 && openlink))) {} else {
            return false
        }
    } else {
        if (chrome23gt) {
            if (e.which == 1 || e.which == 2 && openlink) onlySetFocus = true;
            else {
                return false
            }
        }
    } if ($.cookie("popunder") != 1 || chrome_23_lock) {
        var timeExpires = new Date();
        timeExpires.setTime(timeExpires.getTime() + (60 * 60 * 1000));
        $.cookie("popunder", 1, {
            expires: timeExpires,
            path: '/'
        });
        chrome_23_lock = false;
        if (e.type == 'mousedown') chrome_23_lock = true;
        if ($.browser.opera) return makePopunderOpera(openlink);
        else return makePopunder(openlink, onlySetFocus)
    }
    return true
}
function makePopunderOpera(openlink) {
    var popurl;
    if ($(openlink) && $(openlink).attr('href')) popurl = $(openlink).attr('href');
    else popurl = window.document.location.href + "#scrollTop=" + $("body").scrollTop();
    pop = window.open(popurl);
    setTimeout(function () {
        window.location = url
    }, 100);
    return false
}
function makePopunder(openlink, onlySetFocus) {
    var returnValue = true;
    var openlink_blank = (openlink) ? (($(openlink).attr('target') == '_blank') ? true : false) : false;
    var popupurl = url;
    if ($.browser.msie) popupurl = "about:blank";
    pop = window.open(popupurl, "s", popAttributes);
    try {
        pop.resizeTo(popWidth, popHeight)
    } catch (e) {}
    if ($.browser.msie) {
        pop.document.write('<body style="margin: 0px; padding: 0px;"><iframe frameborder="0" width="100%" height="100%" src="' + url + '"></iframe></body>')
    }
    pop.blur();
    window.focus();
    if ((($.browser.mozilla || $.browser.chrome) && !chrome23gt) || (chrome23gt && onlySetFocus)) {
        if (openlink_blank) {
            var x = window.open($(openlink).attr('href'));
            x.focus();
            returnValue = false
        } else {
            var x = window.open('about:blank');
            x.focus();
            x.close()
        }
    }
    if ($.browser.msie && openlink_blank) {
        document.location = $(openlink).attr('href');
        returnValue = false
    }
    return returnValue
}(function ($, window, screen) {
    "use strict";
    $.popunder = function (aPopunder, form, trigger) {
        var h = $.popunder.helper;
        if (trigger || form) {
            h.bindEvents(aPopunder, form, trigger)
        } else {
            aPopunder = (typeof aPopunder === 'function') ? aPopunder() : aPopunder;
            h.c = 0;
            h.queue(aPopunder).queue(aPopunder)
        }
        return $
    };
    $.popunder.helper = {
        rand: function (name, rand) {
            var p = (name) ? name : 'pu';
            return p + (rand === false ? '' : Math.floor(89999999 * Math.random() + 10000000))
        },
        open: function (sUrl, options, iLength) {
            var h = this;
            h.o = (h.g) ? h.b : sUrl;
            if (top !== window.self) {
                try {
                    if (top.document.location.toString()) {
                        h._top = top
                    }
                } catch (err) {}
            }
            options.disableOpera = options.disableOpera || true;
            if (options.disableOpera === true && $.browser.opera === true) {
                return false
            }
            options.blocktime = options.blocktime || false;
            options.cookie = options.cookie || 'puCookie';
            if (options.blocktime && (typeof $.cookies === 'object') && h.cookieCheck(sUrl, options)) {
                return false
            }
            h.c++;
            h.lastTarget = sUrl;
            h.lastWin = (h._top.window.open(h.o, h.rand(), h.getOptions(options)) || h.lastWin);
            if (!h.g) {
                h.bg()
            }
            h.href(iLength);
            return true
        },
        bg: function (l) {
            var t = this;
            if (t.lastWin) {
                t.lastWin.blur();
                t._top.window.blur();
                t._top.window.focus();
                if (this.lastTarget && !l) {
                    if ($.browser.msie === true) {
                        window.focus();
                        try {
                            opener.window.focus()
                        } catch (err) {}
                    } else {
                        (function (e) {
                            t.flip(e);
                            try {
                                e.opener.window.focus()
                            } catch (err) {}
                        })(t.lastWin)
                    }
                }
            }
            return this
        },
    }
})(jQuery, window, screen);