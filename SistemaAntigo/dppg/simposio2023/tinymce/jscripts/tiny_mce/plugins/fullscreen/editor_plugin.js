(function () {
    var a = tinymce.DOM;
    tinymce.create("tinymce.plugins.FullScreenPlugin", {
        init: function (c, d) {
            var e = this, f = {}, b;
            e.editor = c;
            c.addCommand("mceFullScreen", function () {
                var h, i = a.doc.documentElement;
                if (c.getParam("fullscreen_is_enabled")) {
                    if (c.getParam("fullscreen_new_window")) {
                        closeFullscreen()
                    } else {
                        a.win.setTimeout(function () {
                            tinymce.dom.Event.remove(a.win, "resize", e.resizeFunc);
                            tinyMCE.get(c.getParam("fullscreen_editor_id")).setContent(c.getContent({format: "raw"}), {format: "raw"});
                            tinyMCE.remove(c);
                            a.remove("mce_fullscreen_container");
                            i.style.overflow = c.getParam("fullscreen_html_overflow");
                            a.setStyle(a.doc.body, "overflow", c.getParam("fullscreen_overflow"));
                            a.win.scrollTo(c.getParam("fullscreen_scrollx"), c.getParam("fullscreen_scrolly"));
                            tinyMCE.settings = tinyMCE.oldSettings
                        }, 10)
                    }
                    return
                }
                if (c.getParam("fullscreen_new_window")) {
                    h = a.win.open(d + "/fullscreen.htm", "mceFullScreenPopup", "fullscreen=yes,menubar=no,toolbar=no,scrollbars=no,resizable=yes,left=0,top=0,width=" + screen.availWidth + ",height=" + screen.availHeight);
                    try {
                        h.resizeTo(screen.availWidth, screen.availHeight)
                    } catch (g) {
                    }
                } else {
                    tinyMCE.oldSettings = tinyMCE.settings;
                    f.fullscreen_overflow = a.getStyle(a.doc.body, "overflow", 1) || "auto";
                    f.fullscreen_html_overflow = a.getStyle(i, "overflow", 1);
                    b = a.getViewPort();
                    f.fullscreen_scrollx = b.x;
                    f.fullscreen_scrolly = b.y;
                    if (tinymce.isOpera && f.fullscreen_overflow == "visible") {
                        f.fullscreen_overflow = "auto"
                    }
                    if (tinymce.isIE && f.fullscreen_overflow == "scroll") {
                        f.fullscreen_overflow = "auto"
                    }
                    if (tinymce.isIE && (f.fullscreen_html_overflow == "visible" || f.fullscreen_html_overflow == "scroll")) {
                        f.fullscreen_html_overflow = "auto"
                    }
                    if (f.fullscreen_overflow == "0px") {
                        f.fullscreen_overflow = ""
                    }
                    a.setStyle(a.doc.body, "overflow", "hidden");
                    i.style.overflow = "hidden";
                    b = a.getViewPort();
                    a.win.scrollTo(0, 0);
                    if (tinymce.isIE) {
                        b.h -= 1
                    }
                    n = a.add(a.doc.body, "div", {
                        id: "mce_fullscreen_container",
                        style: "position:" + (tinymce.isIE6 || (tinymce.isIE && !a.boxModel) ? "absolute" : "fixed") + ";top:0;left:0;width:" + b.w + "px;height:" + b.h + "px;z-index:200000;"
                    });
                    a.add(n, "div", {id: "mce_fullscreen"});
                    tinymce.each(c.settings, function (j, k) {
                        f[k] = j
                    });
                    f.id = "mce_fullscreen";
                    f.width = n.clientWidth;
                    f.height = n.clientHeight - 15;
                    f.fullscreen_is_enabled = true;
                    f.fullscreen_editor_id = c.id;
                    f.theme_advanced_resizing = false;
                    f.save_onsavecallback = function () {
                        c.setContent(tinyMCE.get(f.id).getContent({format: "raw"}), {format: "raw"});
                        c.execCommand("mceSave")
                    };
                    tinymce.each(c.getParam("fullscreen_settings"), function (l, j) {
                        f[j] = l
                    });
                    if (f.theme_advanced_toolbar_location === "external") {
                        f.theme_advanced_toolbar_location = "top"
                    }
                    e.fullscreenEditor = new tinymce.Editor("mce_fullscreen", f);
                    e.fullscreenEditor.onInit.add(function () {
                        e.fullscreenEditor.setContent(c.getContent());
                        e.fullscreenEditor.focus()
                    });
                    e.fullscreenEditor.render();
                    e.fullscreenElement = new tinymce.dom.Element("mce_fullscreen_container");
                    e.fullscreenElement.update();
                    e.resizeFunc = tinymce.dom.Event.add(a.win, "resize", function () {
                        var m = tinymce.DOM.getViewPort(), k = e.fullscreenEditor, j, l;
                        j = k.dom.getSize(k.getContainer().firstChild);
                        l = k.dom.getSize(k.getContainer().getElementsByTagName("iframe")[0]);
                        k.theme.resizeTo(m.w - j.w + l.w, m.h - j.h + l.h)
                    })
                }
            });
            c.addButton("fullscreen", {title: "fullscreen.desc", cmd: "mceFullScreen"});
            c.onNodeChange.add(function (h, g) {
                g.setActive("fullscreen", h.getParam("fullscreen_is_enabled"))
            })
        }, getInfo: function () {
            return {
                longname: "Fullscreen",
                author: "Moxiecode Systems AB",
                authorurl: "http://tinymce.moxiecode.com",
                infourl: "http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/fullscreen",
                version: tinymce.majorVersion + "." + tinymce.minorVersion
            }
        }
    });
    tinymce.PluginManager.add("fullscreen", tinymce.plugins.FullScreenPlugin)
})();