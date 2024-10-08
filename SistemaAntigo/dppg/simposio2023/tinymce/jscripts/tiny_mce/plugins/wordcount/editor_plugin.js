(function () {
    tinymce.create("tinymce.plugins.WordCount", {
        block: 0,
        id: null,
        countre: null,
        cleanre: null,
        init: function (a, b) {
            var c = this, d = 0;
            c.countre = a.getParam("wordcount_countregex", /\S\s+/g);
            c.cleanre = a.getParam("wordcount_cleanregex", /[0-9.(),;:!?%#$�'"_+=\\\/-]*/g);
            c.id = a.id + "-word-count";
            a.onPostRender.add(function (f, e) {
                var g, h;
                h = f.getParam("wordcount_target_id");
                if (!h) {
                    g = tinymce.DOM.get(f.id + "_path_row");
                    if (g) {
                        tinymce.DOM.add(g.parentNode, "div", {style: "float: right"}, f.getLang("wordcount.words", "Words: ") + '<span id="' + c.id + '">0</span>')
                    }
                } else {
                    tinymce.DOM.add(h, "span", {}, '<span id="' + c.id + '">0</span>')
                }
            });
            a.onInit.add(function (e) {
                e.selection.onSetContent.add(function () {
                    c._count(e)
                });
                c._count(e)
            });
            a.onSetContent.add(function (e) {
                c._count(e)
            });
            a.onKeyUp.add(function (f, g) {
                if (g.keyCode == d) {
                    return
                }
                if (13 == g.keyCode || 8 == d || 46 == d) {
                    c._count(f)
                }
                d = g.keyCode
            })
        },
        _count: function (b) {
            var c = this, a = 0;
            if (c.block) {
                return
            }
            c.block = 1;
            setTimeout(function () {
                var d = b.getContent({format: "raw"});
                if (d) {
                    d = d.replace(/<.[^<>]*?>/g, " ").replace(/&nbsp;|&#160;/gi, " ");
                    d = d.replace(c.cleanre, "");
                    d.replace(c.countre, function () {
                        a++
                    })
                }
                tinymce.DOM.setHTML(c.id, a.toString());
                setTimeout(function () {
                    c.block = 0
                }, 2000)
            }, 1)
        },
        getInfo: function () {
            return {
                longname: "Word Count plugin",
                author: "Moxiecode Systems AB",
                authorurl: "http://tinymce.moxiecode.com",
                infourl: "http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/wordcount",
                version: tinymce.majorVersion + "." + tinymce.minorVersion
            }
        }
    });
    tinymce.PluginManager.add("wordcount", tinymce.plugins.WordCount)
})();