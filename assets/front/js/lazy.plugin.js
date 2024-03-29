/*! jQuery & Zepto Lazy - All Plugins v1.7.10 - http://jquery.eisbehr.de/lazy - MIT&GPL-2.0 license - Copyright 2012-2018 Daniel 'Eisbehr' Kern */
!function(t) {
    function a(a, e, r, o) {
        o = o ? o.toUpperCase() : "GET";
        var i;
        "POST" !== o && "PUT" !== o || !a.config("ajaxCreateData") || (i = a.config("ajaxCreateData").apply(a, [e])),
        t.ajax({
            url: e.attr("data-src"),
            type: "POST" === o || "PUT" === o ? o : "GET",
            data: i,
            dataType: e.attr("data-type") || "html",
            success: function(t) {
                e.html(t),
                r(!0),
                a.config("removeAttribute") && e.removeAttr("data-src data-method data-type")
            },
            error: function() {
                r(!1)
            }
        })
    }
    t.lazy("ajax", function(t, e) {
        a(this, t, e, t.attr("data-method"))
    }),
    t.lazy("get", function(t, e) {
        a(this, t, e, "GET")
    }),
    t.lazy("post", function(t, e) {
        a(this, t, e, "POST")
    }),
    t.lazy("put", function(t, e) {
        a(this, t, e, "PUT")
    })
}(window.jQuery || window.Zepto),
function(t) {
    t.lazy(["av", "audio", "video"], ["audio", "video"], function(a, e) {
        var r = a[0].tagName.toLowerCase();
        if ("audio" === r || "video" === r) {
            var o = a.find("data-src")
              , i = a.find("data-track")
              , n = 0
              , c = function() {
                ++n === o.length && e(!1)
            }
              , s = function() {
                var a = t(this)
                  , e = a[0].tagName.toLowerCase()
                  , r = a.prop("attributes")
                  , o = t("data-src" === e ? "<source>" : "<track>");
                "data-src" === e && o.one("error", c),
                t.each(r, function(t, a) {
                    o.attr(a.name, a.value)
                }),
                a.replaceWith(o)
            };
            a.one("loadedmetadata", function() {
                e(!0)
            }).off("load error").attr("poster", a.attr("data-poster")),
            o.length ? o.each(s) : a.attr("data-src") ? (t.each(a.attr("data-src").split(","), function(e, r) {
                var o = r.split("|");
                a.append(t("<source>").one("error", c).attr({
                    src: o[0].trim(),
                    type: o[1].trim()
                }))
            }),
            this.config("removeAttribute") && a.removeAttr("data-src")) : e(!1),
            i.length && i.each(s)
        } else
            e(!1)
    })
}(window.jQuery || window.Zepto),
function(t) {
    t.lazy(["frame", "iframe"], "iframe", function(a, e) {
        var r = this;
        if ("iframe" === a[0].tagName.toLowerCase()) {
            var o = a.attr("data-error-detect");
            "true" !== o && "1" !== o ? (a.attr("src", a.attr("data-src")),
            r.config("removeAttribute") && a.removeAttr("data-src data-error-detect")) : t.ajax({
                url: a.attr("data-src"),
                dataType: "html",
                crossDomain: !0,
                xhrFields: {
                    withCredentials: !0
                },
                success: function(t) {
                    a.html(t).attr("src", a.attr("data-src")),
                    r.config("removeAttribute") && a.removeAttr("data-src data-error-detect")
                },
                error: function() {
                    e(!1)
                }
            })
        } else
            e(!1)
    })
}(window.jQuery || window.Zepto),
function(t) {
    t.lazy("noop", function() {}),
    t.lazy("noop-success", function(t, a) {
        a(!0)
    }),
    t.lazy("noop-error", function(t, a) {
        a(!1)
    })
}(window.jQuery || window.Zepto),
function(t) {
    function a(a, e, i) {
        var n = a.prop("attributes")
          , c = t("<" + e + ">");
        return t.each(n, function(t, a) {
            "srcset" !== a.name && a.name !== o || (a.value = r(a.value, i)),
            c.attr(a.name, a.value)
        }),
        a.replaceWith(c),
        c
    }
    function e(a, e, r) {
        var o = t("<img>").one("load", function() {
            r(!0)
        }).one("error", function() {
            r(!1)
        }).appendTo(a).attr("src", e);
        o.complete && o.load()
    }
    function r(t, a) {
        if (a) {
            var e = t.split(",");
            t = "";
            for (var r = 0, o = e.length; r < o; r++)
                t += a + e[r].trim() + (r !== o - 1 ? "," : "")
        }
        return t
    }
    var o = "data-src";
    t.lazy(["pic", "picture"], ["picture"], function(i, n) {
        if ("picture" === i[0].tagName.toLowerCase()) {
            var c = i.find(o)
              , s = i.find("data-img")
              , d = this.config("imageBase") || "";
            c.length ? (c.each(function() {
                a(t(this), "source", d)
            }),
            1 === s.length ? (s = a(s, "img", d),
            s.on("load", function() {
                n(!0)
            }).on("error", function() {
                n(!1)
            }),
            s.attr("src", s.attr(o)),
            this.config("removeAttribute") && s.removeAttr(o)) : i.attr(o) ? (e(i, d + i.attr(o), n),
            this.config("removeAttribute") && i.removeAttr(o)) : n(!1)) : i.attr("data-srcset") ? (t("<source>").attr({
                media: i.attr("data-media"),
                sizes: i.attr("data-sizes"),
                type: i.attr("data-type"),
                srcset: r(i.attr("data-srcset"), d)
            }).appendTo(i),
            e(i, d + i.attr(o), n),
            this.config("removeAttribute") && i.removeAttr(o + " data-srcset data-media data-sizes data-type")) : n(!1)
        } else
            n(!1)
    })
}(window.jQuery || window.Zepto),
function(t) {
    t.lazy(["js", "javascript", "script"], "script", function(t, a) {
        "script" === t[0].tagName.toLowerCase() ? (t.attr("src", t.attr("data-src")),
        this.config("removeAttribute") && t.removeAttr("data-src")) : a(!1)
    })
}(window.jQuery || window.Zepto),
function(t) {
    t.lazy("vimeo", function(t, a) {
        "iframe" === t[0].tagName.toLowerCase() ? (t.attr("src", "https://player.vimeo.com/video/" + t.attr("data-src")),
        this.config("removeAttribute") && t.removeAttr("data-src")) : a(!1)
    })
}(window.jQuery || window.Zepto),
function(t) {
    t.lazy(["yt", "youtube"], function(t, a) {
        if ("iframe" === t[0].tagName.toLowerCase()) {
            var e = /1|true/.test(t.attr("data-nocookie"));
            t.attr("src", "https://www.youtube" + (e ? "-nocookie" : "") + ".com/embed/" + t.attr("data-src") + "?rel=0&amp;showinfo=0"),
            this.config("removeAttribute") && t.removeAttr("data-src")
        } else
            a(!1)
    })
}(window.jQuery || window.Zepto);