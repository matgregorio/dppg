(function () {
    var c = tinymce.each, d = null, a = {
        paste_auto_cleanup_on_paste: true,
        paste_block_drop: false,
        paste_retain_style_properties: "none",
        paste_strip_class_attributes: "mso",
        paste_remove_spans: false,
        paste_remove_styles: false,
        paste_remove_styles_if_webkit: true,
        paste_convert_middot_lists: true,
        paste_convert_headers_to_strong: false,
        paste_dialog_width: "450",
        paste_dialog_height: "400",
        paste_text_use_dialog: false,
        paste_text_sticky: false,
        paste_text_notifyalways: false,
        paste_text_linebreaktype: "p",
        paste_text_replacements: [[/\u2026/g, "..."], [/[\x93\x94\u201c\u201d]/g, '"'], [/[\x60\x91\x92\u2018\u2019]/g, "'"]]
    };

    function b(e, f) {
        return e.getParam(f, a[f])
    }

    tinymce.create("tinymce.plugins.PastePlugin", {
        init: function (e, f) {
            var g = this;
            g.editor = e;
            g.url = f;
            g.onPreProcess = new tinymce.util.Dispatcher(g);
            g.onPostProcess = new tinymce.util.Dispatcher(g);
            g.onPreProcess.add(g._preProcess);
            g.onPostProcess.add(g._postProcess);
            g.onPreProcess.add(function (j, k) {
                e.execCallback("paste_preprocess", j, k)
            });
            g.onPostProcess.add(function (j, k) {
                e.execCallback("paste_postprocess", j, k)
            });
            e.pasteAsPlainText = false;
            function i(l, j) {
                var k = e.dom;
                g.onPreProcess.dispatch(g, l);
                l.node = k.create("div", 0, l.content);
                g.onPostProcess.dispatch(g, l);
                l.content = e.serializer.serialize(l.node, {getInner: 1});
                if ((!j) && (e.pasteAsPlainText)) {
                    g._insertPlainText(e, k, l.content);
                    if (!b(e, "paste_text_sticky")) {
                        e.pasteAsPlainText = false;
                        e.controlManager.setActive("pastetext", false)
                    }
                } else {
                    if (/<(p|h[1-6]|ul|ol)/.test(l.content)) {
                        g._insertBlockContent(e, k, l.content)
                    } else {
                        g._insert(l.content)
                    }
                }
            }

            e.addCommand("mceInsertClipboardContent", function (j, k) {
                i(k, true)
            });
            if (!b(e, "paste_text_use_dialog")) {
                e.addCommand("mcePasteText", function (k, j) {
                    var l = tinymce.util.Cookie;
                    e.pasteAsPlainText = !e.pasteAsPlainText;
                    e.controlManager.setActive("pastetext", e.pasteAsPlainText);
                    if ((e.pasteAsPlainText) && (!l.get("tinymcePasteText"))) {
                        if (b(e, "paste_text_sticky")) {
                            e.windowManager.alert(e.translate("paste.plaintext_mode_sticky"))
                        } else {
                            e.windowManager.alert(e.translate("paste.plaintext_mode_sticky"))
                        }
                        if (!b(e, "paste_text_notifyalways")) {
                            l.set("tinymcePasteText", "1", new Date(new Date().getFullYear() + 1, 12, 31))
                        }
                    }
                })
            }
            e.addButton("pastetext", {title: "paste.paste_text_desc", cmd: "mcePasteText"});
            e.addButton("selectall", {title: "paste.selectall_desc", cmd: "selectall"});
            function h(s) {
                var m, q, k, l = e.selection, p = e.dom, r = e.getBody(), j;
                if (e.pasteAsPlainText && (s.clipboardData || p.doc.dataTransfer)) {
                    s.preventDefault();
                    i({content: (s.clipboardData || p.doc.dataTransfer).getData("Text").replace(/\r?\n/g, "<br />")});
                    return
                }
                if (p.get("_mcePaste")) {
                    return
                }
                m = p.add(r, "div", {id: "_mcePaste", "class": "mcePaste"}, '\uFEFF<br _mce_bogus="1">');
                if (r != e.getDoc().body) {
                    j = p.getPos(e.selection.getStart(), r).y
                } else {
                    j = r.scrollTop
                }
                p.setStyles(m, {position: "absolute", left: -10000, top: j, width: 1, height: 1, overflow: "hidden"});
                if (tinymce.isIE) {
                    k = p.doc.body.createTextRange();
                    k.moveToElementText(m);
                    k.execCommand("Paste");
                    p.remove(m);
                    if (m.innerHTML === "\uFEFF") {
                        e.execCommand("mcePasteWord");
                        s.preventDefault();
                        return
                    }
                    i({content: m.innerHTML});
                    return tinymce.dom.Event.cancel(s)
                } else {
                    function o(n) {
                        n.preventDefault()
                    }

                    p.bind(e.getDoc(), "mousedown", o);
                    p.bind(e.getDoc(), "keydown", o);
                    q = e.selection.getRng();
                    m = m.firstChild;
                    k = e.getDoc().createRange();
                    k.setStart(m, 0);
                    k.setEnd(m, 1);
                    l.setRng(k);
                    window.setTimeout(function () {
                        var t = "", n = p.select("div.mcePaste");
                        c(n, function (v) {
                            var u = v.firstChild;
                            if (u && u.nodeName == "DIV" && u.style.marginTop && u.style.backgroundColor) {
                                p.remove(u, 1)
                            }
                            c(p.select("div.mcePaste", v), function (w) {
                                p.remove(w, 1)
                            });
                            c(p.select("span.Apple-style-span", v), function (w) {
                                p.remove(w, 1)
                            });
                            c(p.select("br[_mce_bogus]", v), function (w) {
                                p.remove(w)
                            });
                            t += v.innerHTML
                        });
                        c(n, function (u) {
                            p.remove(u)
                        });
                        if (q) {
                            l.setRng(q)
                        }
                        i({content: t});
                        p.unbind(e.getDoc(), "mousedown", o);
                        p.unbind(e.getDoc(), "keydown", o)
                    }, 0)
                }
            }

            if (b(e, "paste_auto_cleanup_on_paste")) {
                if (tinymce.isOpera || /Firefox\/2/.test(navigator.userAgent)) {
                    e.onKeyDown.add(function (j, k) {
                        if (((tinymce.isMac ? k.metaKey : k.ctrlKey) && k.keyCode == 86) || (k.shiftKey && k.keyCode == 45)) {
                            h(k)
                        }
                    })
                } else {
                    e.onPaste.addToTop(function (j, k) {
                        return h(k)
                    })
                }
            }
            if (b(e, "paste_block_drop")) {
                e.onInit.add(function () {
                    e.dom.bind(e.getBody(), ["dragend", "dragover", "draggesture", "dragdrop", "drop", "drag"], function (j) {
                        j.preventDefault();
                        j.stopPropagation();
                        return false
                    })
                })
            }
            g._legacySupport()
        }, getInfo: function () {
            return {
                longname: "Paste text/word",
                author: "Moxiecode Systems AB",
                authorurl: "http://tinymce.moxiecode.com",
                infourl: "http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/paste",
                version: tinymce.majorVersion + "." + tinymce.minorVersion
            }
        }, _preProcess: function (i, f) {
            var l = this.editor, k = f.content, q = tinymce.grep, p = tinymce.explode, g = tinymce.trim, m, j;

            function e(h) {
                c(h, function (o) {
                    if (o.constructor == RegExp) {
                        k = k.replace(o, "")
                    } else {
                        k = k.replace(o[0], o[1])
                    }
                })
            }

            if (/class="?Mso|style="[^"]*\bmso-|w:WordDocument/i.test(k) || f.wordContent) {
                f.wordContent = true;
                e([/^\s*(&nbsp;)+/gi, /(&nbsp;|<br[^>]*>)+\s*$/gi]);
                if (b(l, "paste_convert_headers_to_strong")) {
                    k = k.replace(/<p [^>]*class="?MsoHeading"?[^>]*>(.*?)<\/p>/gi, "<p><strong>$1</strong></p>")
                }
                if (b(l, "paste_convert_middot_lists")) {
                    e([[/<!--\[if !supportLists\]-->/gi, "$&__MCE_ITEM__"], [/(<span[^>]+(?:mso-list:|:\s*symbol)[^>]+>)/gi, "$1__MCE_ITEM__"]])
                }
                e([/<!--[\s\S]+?-->/gi, /<(!|script[^>]*>.*?<\/script(?=[>\s])|\/?(\?xml(:\w+)?|img|meta|link|style|\w:\w+)(?=[\s\/>]))[^>]*>/gi, [/<(\/?)s>/gi, "<$1strike>"], [/&nbsp;/gi, "\u00a0"]]);
                do {
                    m = k.length;
                    k = k.replace(/(<[a-z][^>]*\s)(?:id|name|language|type|on\w+|\w+:\w+)=(?:"[^"]*"|\w+)\s?/gi, "$1")
                } while (m != k.length);
                if (b(l, "paste_retain_style_properties").replace(/^none$/i, "").length == 0) {
                    k = k.replace(/<\/?span[^>]*>/gi, "")
                } else {
                    e([[/<span\s+style\s*=\s*"\s*mso-spacerun\s*:\s*yes\s*;?\s*"\s*>([\s\u00a0]*)<\/span>/gi, function (o, h) {
                        return (h.length > 0) ? h.replace(/./, " ").slice(Math.floor(h.length / 2)).split("").join("\u00a0") : ""
                    }], [/(<[a-z][^>]*)\sstyle="([^"]*)"/gi, function (u, h, t) {
                        var v = [], o = 0, r = p(g(t).replace(/&quot;/gi, "'"), ";");
                        c(r, function (s) {
                            var w, y, z = p(s, ":");

                            function x(A) {
                                return A + ((A !== "0") && (/\d$/.test(A))) ? "px" : ""
                            }

                            if (z.length == 2) {
                                w = z[0].toLowerCase();
                                y = z[1].toLowerCase();
                                switch (w) {
                                    case"mso-padding-alt":
                                    case"mso-padding-top-alt":
                                    case"mso-padding-right-alt":
                                    case"mso-padding-bottom-alt":
                                    case"mso-padding-left-alt":
                                    case"mso-margin-alt":
                                    case"mso-margin-top-alt":
                                    case"mso-margin-right-alt":
                                    case"mso-margin-bottom-alt":
                                    case"mso-margin-left-alt":
                                    case"mso-table-layout-alt":
                                    case"mso-height":
                                    case"mso-width":
                                    case"mso-vertical-align-alt":
                                        v[o++] = w.replace(/^mso-|-alt$/g, "") + ":" + x(y);
                                        return;
                                    case"horiz-align":
                                        v[o++] = "text-align:" + y;
                                        return;
                                    case"vert-align":
                                        v[o++] = "vertical-align:" + y;
                                        return;
                                    case"font-color":
                                    case"mso-foreground":
                                        v[o++] = "color:" + y;
                                        return;
                                    case"mso-background":
                                    case"mso-highlight":
                                        v[o++] = "background:" + y;
                                        return;
                                    case"mso-default-height":
                                        v[o++] = "min-height:" + x(y);
                                        return;
                                    case"mso-default-width":
                                        v[o++] = "min-width:" + x(y);
                                        return;
                                    case"mso-padding-between-alt":
                                        v[o++] = "border-collapse:separate;border-spacing:" + x(y);
                                        return;
                                    case"text-line-through":
                                        if ((y == "single") || (y == "double")) {
                                            v[o++] = "text-decoration:line-through"
                                        }
                                        return;
                                    case"mso-zero-height":
                                        if (y == "yes") {
                                            v[o++] = "display:none"
                                        }
                                        return
                                }
                                if (/^(mso|column|font-emph|lang|layout|line-break|list-image|nav|panose|punct|row|ruby|sep|size|src|tab-|table-border|text-(?!align|decor|indent|trans)|top-bar|version|vnd|word-break)/.test(w)) {
                                    return
                                }
                                v[o++] = w + ":" + z[1]
                            }
                        });
                        if (o > 0) {
                            return h + ' style="' + v.join(";") + '"'
                        } else {
                            return h
                        }
                    }]])
                }
            }
            if (b(l, "paste_convert_headers_to_strong")) {
                e([[/<h[1-6][^>]*>/gi, "<p><strong>"], [/<\/h[1-6][^>]*>/gi, "</strong></p>"]])
            }
            j = b(l, "paste_strip_class_attributes");
            if (j !== "none") {
                function n(r, o) {
                    if (j === "all") {
                        return ""
                    }
                    var h = q(p(o.replace(/^(["'])(.*)\1$/, "$2"), " "), function (s) {
                        return (/^(?!mso)/i.test(s))
                    });
                    return h.length ? ' class="' + h.join(" ") + '"' : ""
                }

                k = k.replace(/ class="([^"]+)"/gi, n);
                k = k.replace(/ class=(\w+)/gi, n)
            }
            if (b(l, "paste_remove_spans")) {
                k = k.replace(/<\/?span[^>]*>/gi, "")
            }
            f.content = k
        }, _postProcess: function (h, j) {
            var g = this, f = g.editor, i = f.dom, e;
            if (j.wordContent) {
                c(i.select("a", j.node), function (k) {
                    if (!k.href || k.href.indexOf("#_Toc") != -1) {
                        i.remove(k, 1)
                    }
                });
                if (b(f, "paste_convert_middot_lists")) {
                    g._convertLists(h, j)
                }
                e = b(f, "paste_retain_style_properties");
                if ((tinymce.is(e, "string")) && (e !== "all") && (e !== "*")) {
                    e = tinymce.explode(e.replace(/^none$/i, ""));
                    c(i.select("*", j.node), function (n) {
                        var o = {}, l = 0, m, p, k;
                        if (e) {
                            for (m = 0; m < e.length; m++) {
                                p = e[m];
                                k = i.getStyle(n, p);
                                if (k) {
                                    o[p] = k;
                                    l++
                                }
                            }
                        }
                        i.setAttrib(n, "style", "");
                        if (e && l > 0) {
                            i.setStyles(n, o)
                        } else {
                            if (n.nodeName == "SPAN" && !n.className) {
                                i.remove(n, true)
                            }
                        }
                    })
                }
            }
            if (b(f, "paste_remove_styles") || (b(f, "paste_remove_styles_if_webkit") && tinymce.isWebKit)) {
                c(i.select("*[style]", j.node), function (k) {
                    k.removeAttribute("style");
                    k.removeAttribute("_mce_style")
                })
            } else {
                if (tinymce.isWebKit) {
                    c(i.select("*", j.node), function (k) {
                        k.removeAttribute("_mce_style")
                    })
                }
            }
        }, _convertLists: function (h, f) {
            var j = h.editor.dom, i, m, e = -1, g, n = [], l, k;
            c(j.select("p", f.node), function (u) {
                var r, v = "", t, s, o, q;
                for (r = u.firstChild; r && r.nodeType == 3; r = r.nextSibling) {
                    v += r.nodeValue
                }
                v = u.innerHTML.replace(/<\/?\w+[^>]*>/gi, "").replace(/&nbsp;/g, "\u00a0");
                if (/^(__MCE_ITEM__)+[\u2022\u00b7\u00a7\u00d8o]\s*\u00a0*/.test(v)) {
                    t = "ul"
                }
                if (/^__MCE_ITEM__\s*\w+\.\s*\u00a0{2,}/.test(v)) {
                    t = "ol"
                }
                if (t) {
                    g = parseFloat(u.style.marginLeft || 0);
                    if (g > e) {
                        n.push(g)
                    }
                    if (!i || t != l) {
                        i = j.create(t);
                        j.insertAfter(i, u)
                    } else {
                        if (g > e) {
                            i = m.appendChild(j.create(t))
                        } else {
                            if (g < e) {
                                o = tinymce.inArray(n, g);
                                q = j.getParents(i.parentNode, t);
                                i = q[q.length - 1 - o] || i
                            }
                        }
                    }
                    c(j.select("span", u), function (w) {
                        var p = w.innerHTML.replace(/<\/?\w+[^>]*>/gi, "");
                        if (t == "ul" && /^[\u2022\u00b7\u00a7\u00d8o]/.test(p)) {
                            j.remove(w)
                        } else {
                            if (/^[\s\S]*\w+\.(&nbsp;|\u00a0)*\s*/.test(p)) {
                                j.remove(w)
                            }
                        }
                    });
                    s = u.innerHTML;
                    if (t == "ul") {
                        s = u.innerHTML.replace(/__MCE_ITEM__/g, "").replace(/^[\u2022\u00b7\u00a7\u00d8o]\s*(&nbsp;|\u00a0)+\s*/, "")
                    } else {
                        s = u.innerHTML.replace(/__MCE_ITEM__/g, "").replace(/^\s*\w+\.(&nbsp;|\u00a0)+\s*/, "")
                    }
                    m = i.appendChild(j.create("li", 0, s));
                    j.remove(u);
                    e = g;
                    l = t
                } else {
                    i = e = 0
                }
            });
            k = f.node.innerHTML;
            if (k.indexOf("__MCE_ITEM__") != -1) {
                f.node.innerHTML = k.replace(/__MCE_ITEM__/g, "")
            }
        }, _insertBlockContent: function (l, h, m) {
            var f, j, g = l.selection, q, n, e, o, i, k = "mce_marker";

            function p(t) {
                var s;
                if (tinymce.isIE) {
                    s = l.getDoc().body.createTextRange();
                    s.moveToElementText(t);
                    s.collapse(false);
                    s.select()
                } else {
                    g.select(t, 1);
                    g.collapse(false)
                }
            }

            this._insert('<span id="' + k + '"></span>', 1);
            j = h.get(k);
            f = h.getParent(j, "p,h1,h2,h3,h4,h5,h6,ul,ol,th,td");
            if (f && !/TD|TH/.test(f.nodeName)) {
                j = h.split(f, j);
                c(h.create("div", 0, m).childNodes, function (r) {
                    q = j.parentNode.insertBefore(r.cloneNode(true), j)
                });
                p(q)
            } else {
                h.setOuterHTML(j, m);
                g.select(l.getBody(), 1);
                g.collapse(0)
            }
            while (n = h.get(k)) {
                h.remove(n)
            }
            n = g.getStart();
            e = h.getViewPort(l.getWin());
            o = l.dom.getPos(n).y;
            i = n.clientHeight;
            if (o < e.y || o + i > e.y + e.h) {
                l.getDoc().body.scrollTop = o < e.y ? o : o - e.h + 25
            }
        }, _insert: function (g, e) {
            var f = this.editor, i = f.selection.getRng();
            if (!f.selection.isCollapsed() && i.startContainer != i.endContainer) {
                f.getDoc().execCommand("Delete", false, null)
            }
            f.execCommand(tinymce.isGecko ? "insertHTML" : "mceInsertContent", false, g, {skip_undo: e})
        }, _insertPlainText: function (j, x, v) {
            var t, u, l, k, r, e, p, f, n = j.getWin(), z = j.getDoc(), s = j.selection, m = tinymce.is, y = tinymce.inArray, g = b(j, "paste_text_linebreaktype"), o = b(j, "paste_text_replacements");

            function q(h) {
                c(h, function (i) {
                    if (i.constructor == RegExp) {
                        v = v.replace(i, "")
                    } else {
                        v = v.replace(i[0], i[1])
                    }
                })
            }

            if ((typeof(v) === "string") && (v.length > 0)) {
                if (!d) {
                    d = ("34,quot,38,amp,39,apos,60,lt,62,gt," + j.serializer.settings.entities).split(",")
                }
                if (/<(?:p|br|h[1-6]|ul|ol|dl|table|t[rdh]|div|blockquote|fieldset|pre|address|center)[^>]*>/i.test(v)) {
                    q([/[\n\r]+/g])
                } else {
                    q([/\r+/g])
                }
                q([[/<\/(?:p|h[1-6]|ul|ol|dl|table|div|blockquote|fieldset|pre|address|center)>/gi, "\n\n"], [/<br[^>]*>|<\/tr>/gi, "\n"], [/<\/t[dh]>\s*<t[dh][^>]*>/gi, "\t"], /<[a-z!\/?][^>]*>/gi, [/&nbsp;/gi, " "], [/&(#\d+|[a-z0-9]{1,10});/gi, function (i, h) {
                    if (h.charAt(0) === "#") {
                        return String.fromCharCode(h.slice(1))
                    } else {
                        return ((i = y(d, h)) > 0) ? String.fromCharCode(d[i - 1]) : " "
                    }
                }], [/(?:(?!\n)\s)*(\n+)(?:(?!\n)\s)*/gi, "$1"], [/\n{3,}/g, "\n\n"], /^\s+|\s+$/g]);
                v = x.encode(v);
                if (!s.isCollapsed()) {
                    z.execCommand("Delete", false, null)
                }
                if (m(o, "array") || (m(o, "array"))) {
                    q(o)
                } else {
                    if (m(o, "string")) {
                        q(new RegExp(o, "gi"))
                    }
                }
                if (g == "none") {
                    q([[/\n+/g, " "]])
                } else {
                    if (g == "br") {
                        q([[/\n/g, "<br />"]])
                    } else {
                        q([/^\s+|\s+$/g, [/\n\n/g, "</p><p>"], [/\n/g, "<br />"]])
                    }
                }
                if ((l = v.indexOf("</p><p>")) != -1) {
                    k = v.lastIndexOf("</p><p>");
                    r = s.getNode();
                    e = [];
                    do {
                        if (r.nodeType == 1) {
                            if (r.nodeName == "TD" || r.nodeName == "BODY") {
                                break
                            }
                            e[e.length] = r
                        }
                    } while (r = r.parentNode);
                    if (e.length > 0) {
                        p = v.substring(0, l);
                        f = "";
                        for (t = 0, u = e.length; t < u; t++) {
                            p += "</" + e[t].nodeName.toLowerCase() + ">";
                            f += "<" + e[e.length - t - 1].nodeName.toLowerCase() + ">"
                        }
                        if (l == k) {
                            v = p + f + v.substring(l + 7)
                        } else {
                            v = p + v.substring(l + 4, k + 4) + f + v.substring(k + 7)
                        }
                    }
                }
                j.execCommand("mceInsertRawHTML", false, v + '<span id="_plain_text_marker">&nbsp;</span>');
                window.setTimeout(function () {
                    var h = x.get("_plain_text_marker"), B, i, A, w;
                    s.select(h, false);
                    z.execCommand("Delete", false, null);
                    h = null;
                    B = s.getStart();
                    i = x.getViewPort(n);
                    A = x.getPos(B).y;
                    w = B.clientHeight;
                    if ((A < i.y) || (A + w > i.y + i.h)) {
                        z.body.scrollTop = A < i.y ? A : A - i.h + 25
                    }
                }, 0)
            }
        }, _legacySupport: function () {
            var f = this, e = f.editor;
            e.addCommand("mcePasteWord", function () {
                e.windowManager.open({
                    file: f.url + "/pasteword.htm",
                    width: parseInt(b(e, "paste_dialog_width")),
                    height: parseInt(b(e, "paste_dialog_height")),
                    inline: 1
                })
            });
            if (b(e, "paste_text_use_dialog")) {
                e.addCommand("mcePasteText", function () {
                    e.windowManager.open({
                        file: f.url + "/pastetext.htm",
                        width: parseInt(b(e, "paste_dialog_width")),
                        height: parseInt(b(e, "paste_dialog_height")),
                        inline: 1
                    })
                })
            }
            e.addButton("pasteword", {title: "paste.paste_word_desc", cmd: "mcePasteWord"})
        }
    });
    tinymce.PluginManager.add("paste", tinymce.plugins.PastePlugin)
})();