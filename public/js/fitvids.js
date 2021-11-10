! function(o) {
    "use strict";
    o.fn.fitVids = function(t) {
        var e, i, d = {
            customSelector: null,
            ignore: null
        };
        return document.getElementById("fit-vids-style") || (e = document.head || document.getElementsByTagName("head")[0], (i = document.createElement("div")).innerHTML = '<p>x</p><style id="fit-vids-style">.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>', e.appendChild(i.childNodes[1])), t && o.extend(d, t), this.each(function() {
            var t = ['iframe[src*="player.vimeo.com"]', 'iframe[src*="youtube.com"]', 'iframe[src*="youtube-nocookie.com"]', 'iframe[src*="kickstarter.com"][src*="video.html"]', "object", "embed"];
            d.customSelector && t.push(d.customSelector);
            var r = ".fitvidsignore";
            d.ignore && (r = r + ", " + d.ignore);
            var e = o(this).find(t.join(","));
            (e = (e = e.not("object object")).not(r)).each(function() {
                var t, e, i = o(this);
                0 < i.parents(r).length || "embed" === this.tagName.toLowerCase() && i.parent("object").length || i.parent(".fluid-width-video-wrapper").length || (i.css("height") || i.css("width") || !isNaN(i.attr("height")) && !isNaN(i.attr("width")) || (i.attr("height", 9), i.attr("width", 16)), t = ("object" === this.tagName.toLowerCase() || i.attr("height") && !isNaN(parseInt(i.attr("height"), 10)) ? parseInt(i.attr("height"), 10) : i.height()) / (isNaN(parseInt(i.attr("width"), 10)) ? i.width() : parseInt(i.attr("width"), 10)), i.attr("name") || (e = "fitvid" + o.fn.fitVids._count, i.attr("name", e), o.fn.fitVids._count++), i.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top", 100 * t + "%"), i.removeAttr("height").removeAttr("width"))
            })
        })
    }, o.fn.fitVids._count = 0
}(window.jQuery || window.Zepto);