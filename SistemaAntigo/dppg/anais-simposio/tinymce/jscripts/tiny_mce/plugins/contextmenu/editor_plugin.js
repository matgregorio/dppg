(function () {
    var a = tinymce.dom.Event, c = tinymce.each, b = tinymce.DOM;
    tinymce.create("tinymce.plugins.ContextMenu", {
        init: function (d) {
            var f = this, g;
            f.editor = d;
            f.onContextMenu = new tinymce.util.Dispatcher(this);
            d.onContextMenu.add(function (h, i) {
                if (!i.ctrlKey) {
                    if (g) {
                        h.selection.setRng(g)
                    }
                    f._getMenu(h).showMenu(i.clientX, i.clientY);
                    a.add(h.getDoc(), "click", function (j) {
                        e(h, j)
                    });
                    a.cancel(i)
                }
            });
            d.onRemove.add(function () {
                if (f._menu) {
                    f._menu.removeAll()
                }
            });
            function e(h, i) {
                g = null;
                if (i && i.button == 2) {
                    g = h.selection.getRng();
                    return
                }
                if (f._menu) {
                    f._menu.removeAll();
                    f._menu.destroy();
                    a.remove(h.getDoc(), "click", e)
                }
            }

            d.onMouseDown.add(e);
            d.onKeyDown.add(e)
        }, getInfo: function () {
            return {
                longname: "Contextmenu",
                author: "Moxiecode Systems AB",
                authorurl: "http://tinymce.moxiecode.com",
                infourl: "http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/contextmenu",
                version: tinymce.majorVersion + "." + tinymce.minorVersion
            }
        }, _getMenu: function (h) {
            var l = this, f = l._menu, i = h.selection, e = i.isCollapsed(), d = i.getNode() || h.getBody(), g, k, j;
            if (f) {
                f.removeAll();
                f.destroy()
            }
            k = b.getPos(h.getContentAreaContainer());
            j = b.getPos(h.getContainer());
            f = h.controlManager.createDropMenu("contextmenu", {
                offset_x: k.x + h.getParam("contextmenu_offset_x", 0),
                offset_y: k.y + h.getParam("contextmenu_offset_y", 0),
                constrain: 1
            });
            l._menu = f;
            f.add({title: "advanced.cut_desc", icon: "cut", cmd: "Cut"}).setDisabled(e);
            f.add({title: "advanced.copy_desc", icon: "copy", cmd: "Copy"}).setDisabled(e);
            f.add({title: "advanced.paste_desc", icon: "paste", cmd: "Paste"});
            if ((d.nodeName == "A" && !h.dom.getAttrib(d, "name")) || !e) {
                f.addSeparator();
                f.add({
                    title: "advanced.link_desc",
                    icon: "link",
                    cmd: h.plugins.advlink ? "mceAdvLink" : "mceLink",
                    ui: true
                });
                f.add({title: "advanced.unlink_desc", icon: "unlink", cmd: "UnLink"})
            }
            f.addSeparator();
            f.add({
                title: "advanced.image_desc",
                icon: "image",
                cmd: h.plugins.advimage ? "mceAdvImage" : "mceImage",
                ui: true
            });
            f.addSeparator();
            g = f.addMenu({title: "contextmenu.align"});
            g.add({title: "contextmenu.left", icon: "justifyleft", cmd: "JustifyLeft"});
            g.add({title: "contextmenu.center", icon: "justifycenter", cmd: "JustifyCenter"});
            g.add({title: "contextmenu.right", icon: "justifyright", cmd: "JustifyRight"});
            g.add({title: "contextmenu.full", icon: "justifyfull", cmd: "JustifyFull"});
            l.onContextMenu.dispatch(l, f, d, e);
            return f
        }
    });
    tinymce.PluginManager.add("contextmenu", tinymce.plugins.ContextMenu)
})();