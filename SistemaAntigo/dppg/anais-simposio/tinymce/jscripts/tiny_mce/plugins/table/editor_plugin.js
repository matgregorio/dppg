(function (c) {
    var d = c.each;

    function b(f, g) {
        var h = g.ownerDocument, e = h.createRange(), j;
        e.setStartBefore(g);
        e.setEnd(f.endContainer, f.endOffset);
        j = h.createElement("body");
        j.appendChild(e.cloneContents());
        return j.innerHTML.replace(/<(br|img|object|embed|input|textarea)[^>]*>/gi, "-").replace(/<[^>]+>/g, "").length == 0
    }

    function a(G, F, J) {
        var f, K, C, o;
        s();
        o = F.getParent(J.getStart(), "th,td");
        if (o) {
            K = E(o);
            C = H();
            o = w(K.x, K.y)
        }
        function z(M, L) {
            M = M.cloneNode(L);
            M.removeAttribute("id");
            return M
        }

        function s() {
            var L = 0;
            f = [];
            d(["thead", "tbody", "tfoot"], function (M) {
                var N = F.select("> " + M + " tr", G);
                d(N, function (O, P) {
                    P += L;
                    d(F.select("> td, > th", O), function (V, Q) {
                        var R, S, T, U;
                        if (f[P]) {
                            while (f[P][Q]) {
                                Q++
                            }
                        }
                        T = h(V, "rowspan");
                        U = h(V, "colspan");
                        for (S = P; S < P + T; S++) {
                            if (!f[S]) {
                                f[S] = []
                            }
                            for (R = Q; R < Q + U; R++) {
                                f[S][R] = {part: M, real: S == P && R == Q, elm: V, rowspan: T, colspan: U}
                            }
                        }
                    })
                });
                L += N.length
            })
        }

        function w(L, N) {
            var M;
            M = f[N];
            if (M) {
                return M[L]
            }
        }

        function h(M, L) {
            return parseInt(M.getAttribute(L) || 1)
        }

        function j(L) {
            return F.hasClass(L.elm, "mceSelected") || L == o
        }

        function k() {
            var L = [];
            d(G.rows, function (M) {
                d(M.cells, function (N) {
                    if (F.hasClass(N, "mceSelected") || N == o.elm) {
                        L.push(M);
                        return false
                    }
                })
            });
            return L
        }

        function r() {
            var L = F.createRng();
            L.setStartAfter(G);
            L.setEndAfter(G);
            J.setRng(L);
            F.remove(G)
        }

        function e(L) {
            var M;
            c.walk(L, function (O) {
                var N;
                if (O.nodeType == 3) {
                    d(F.getParents(O.parentNode, null, L).reverse(), function (P) {
                        P = z(P, false);
                        if (!M) {
                            M = N = P
                        } else {
                            if (N) {
                                N.appendChild(P)
                            }
                        }
                        N = P
                    });
                    if (N) {
                        N.innerHTML = c.isIE ? "&nbsp;" : '<br _mce_bogus="1" />'
                    }
                    return false
                }
            }, "childNodes");
            L = z(L, false);
            L.rowSpan = L.colSpan = 1;
            if (M) {
                L.appendChild(M)
            } else {
                if (!c.isIE) {
                    L.innerHTML = '<br _mce_bogus="1" />'
                }
            }
            return L
        }

        function q() {
            var L = F.createRng();
            d(F.select("tr", G), function (M) {
                if (M.cells.length == 0) {
                    F.remove(M)
                }
            });
            if (F.select("tr", G).length == 0) {
                L.setStartAfter(G);
                L.setEndAfter(G);
                J.setRng(L);
                F.remove(G);
                return
            }
            d(F.select("thead,tbody,tfoot", G), function (M) {
                if (M.rows.length == 0) {
                    F.remove(M)
                }
            });
            s();
            row = f[Math.min(f.length - 1, K.y)];
            if (row) {
                J.select(row[Math.min(row.length - 1, K.x)].elm, true);
                J.collapse(true)
            }
        }

        function t(R, P, T, Q) {
            var O, M, L, N, S;
            O = f[P][R].elm.parentNode;
            for (L = 1; L <= T; L++) {
                O = F.getNext(O, "tr");
                if (O) {
                    for (M = R; M >= 0; M--) {
                        S = f[P + L][M].elm;
                        if (S.parentNode == O) {
                            for (N = 1; N <= Q; N++) {
                                F.insertAfter(e(S), S)
                            }
                            break
                        }
                    }
                    if (M == -1) {
                        for (N = 1; N <= Q; N++) {
                            O.insertBefore(e(O.cells[0]), O.cells[0])
                        }
                    }
                }
            }
        }

        function B() {
            d(f, function (L, M) {
                d(L, function (O, N) {
                    var R, Q, S, P;
                    if (j(O)) {
                        O = O.elm;
                        R = h(O, "colspan");
                        Q = h(O, "rowspan");
                        if (R > 1 || Q > 1) {
                            O.colSpan = O.rowSpan = 1;
                            for (P = 0; P < R - 1; P++) {
                                F.insertAfter(e(O), O)
                            }
                            t(N, M, Q - 1, R)
                        }
                    }
                })
            })
        }

        function p(T, Q, W) {
            var O, N, V, U, S, P, R, L, T, M;
            if (T) {
                pos = E(T);
                O = pos.x;
                N = pos.y;
                V = O + (Q - 1);
                U = N + (W - 1)
            } else {
                O = K.x;
                N = K.y;
                V = C.x;
                U = C.y
            }
            R = w(O, N);
            L = w(V, U);
            if (R && L && R.part == L.part) {
                B();
                s();
                R = w(O, N).elm;
                R.colSpan = (V - O) + 1;
                R.rowSpan = (U - N) + 1;
                for (P = N; P <= U; P++) {
                    for (S = O; S <= V; S++) {
                        T = f[P][S].elm;
                        if (T != R) {
                            M = c.grep(T.childNodes);
                            d(M, function (Y, X) {
                                if (Y.nodeName != "BR" || X != M.length - 1) {
                                    R.appendChild(Y)
                                }
                            });
                            F.remove(T)
                        }
                    }
                }
                q()
            }
        }

        function l(O) {
            var L, Q, N, P, R, S, M, T;
            d(f, function (U, V) {
                d(U, function (X, W) {
                    if (j(X)) {
                        X = X.elm;
                        R = X.parentNode;
                        S = z(R, false);
                        L = V;
                        if (O) {
                            return false
                        }
                    }
                });
                if (O) {
                    return !L
                }
            });
            for (P = 0; P < f[0].length; P++) {
                Q = f[L][P].elm;
                if (Q != N) {
                    if (!O) {
                        rowSpan = h(Q, "rowspan");
                        if (rowSpan > 1) {
                            Q.rowSpan = rowSpan + 1;
                            continue
                        }
                    } else {
                        if (L > 0 && f[L - 1][P]) {
                            T = f[L - 1][P].elm;
                            rowSpan = h(T, "rowspan");
                            if (rowSpan > 1) {
                                T.rowSpan = rowSpan + 1;
                                continue
                            }
                        }
                    }
                    M = e(Q);
                    M.colSpan = Q.colSpan;
                    S.appendChild(M);
                    N = Q
                }
            }
            if (S.hasChildNodes()) {
                if (!O) {
                    F.insertAfter(S, R)
                } else {
                    R.parentNode.insertBefore(S, R)
                }
            }
        }

        function g(M) {
            var N, L;
            d(f, function (O, P) {
                d(O, function (R, Q) {
                    if (j(R)) {
                        N = Q;
                        if (M) {
                            return false
                        }
                    }
                });
                if (M) {
                    return !N
                }
            });
            d(f, function (R, S) {
                var O = R[N].elm, P, Q;
                if (O != L) {
                    Q = h(O, "colspan");
                    P = h(O, "rowspan");
                    if (Q == 1) {
                        if (!M) {
                            F.insertAfter(e(O), O);
                            t(N, S, P - 1, Q)
                        } else {
                            O.parentNode.insertBefore(e(O), O);
                            t(N, S, P - 1, Q)
                        }
                    } else {
                        O.colSpan++
                    }
                    L = O
                }
            })
        }

        function n() {
            var L = [];
            d(f, function (M, N) {
                d(M, function (P, O) {
                    if (j(P) && c.inArray(L, O) === -1) {
                        d(f, function (S) {
                            var Q = S[O].elm, R;
                            R = h(Q, "colspan");
                            if (R > 1) {
                                Q.colSpan = R - 1
                            } else {
                                F.remove(Q)
                            }
                        });
                        L.push(O)
                    }
                })
            });
            q()
        }

        function m() {
            var M;

            function L(P) {
                var O, Q, N;
                O = F.getNext(P, "tr");
                d(P.cells, function (R) {
                    var S = h(R, "rowspan");
                    if (S > 1) {
                        R.rowSpan = S - 1;
                        Q = E(R);
                        t(Q.x, Q.y, 1, 1)
                    }
                });
                Q = E(P.cells[0]);
                d(f[Q.y], function (R) {
                    var S;
                    R = R.elm;
                    if (R != N) {
                        S = h(R, "rowspan");
                        if (S <= 1) {
                            F.remove(R)
                        } else {
                            R.rowSpan = S - 1
                        }
                        N = R
                    }
                })
            }

            M = k();
            d(M.reverse(), function (N) {
                L(N)
            });
            q()
        }

        function D() {
            var L = k();
            F.remove(L);
            q();
            return L
        }

        function I() {
            var L = k();
            d(L, function (N, M) {
                L[M] = z(N, true)
            });
            return L
        }

        function A(N, M) {
            var O = k(), L = O[M ? 0 : O.length - 1], P = L.cells.length;
            d(f, function (R) {
                var Q;
                P = 0;
                d(R, function (T, S) {
                    if (T.real) {
                        P += T.colspan
                    }
                    if (T.elm.parentNode == L) {
                        Q = 1
                    }
                });
                if (Q) {
                    return false
                }
            });
            if (!M) {
                N.reverse()
            }
            d(N, function (S) {
                var R = S.cells.length, Q;
                for (i = 0; i < R; i++) {
                    Q = S.cells[i];
                    Q.colSpan = Q.rowSpan = 1
                }
                for (i = R; i < P; i++) {
                    S.appendChild(e(S.cells[R - 1]))
                }
                for (i = P; i < R; i++) {
                    F.remove(S.cells[i])
                }
                if (M) {
                    L.parentNode.insertBefore(S, L)
                } else {
                    F.insertAfter(S, L)
                }
            })
        }

        function E(L) {
            var M;
            d(f, function (N, O) {
                d(N, function (Q, P) {
                    if (Q.elm == L) {
                        M = {x: P, y: O};
                        return false
                    }
                });
                return !M
            });
            return M
        }

        function v(L) {
            K = E(L)
        }

        function H() {
            var N, M, L;
            M = L = 0;
            d(f, function (O, P) {
                d(O, function (R, Q) {
                    var T, S;
                    if (j(R)) {
                        R = f[P][Q];
                        if (Q > M) {
                            M = Q
                        }
                        if (P > L) {
                            L = P
                        }
                        if (R.real) {
                            T = R.colspan - 1;
                            S = R.rowspan - 1;
                            if (T) {
                                if (Q + T > M) {
                                    M = Q + T
                                }
                            }
                            if (S) {
                                if (P + S > L) {
                                    L = P + S
                                }
                            }
                        }
                    }
                })
            });
            return {x: M, y: L}
        }

        function u(R) {
            var O, N, T, S, M, L, P, Q;
            C = E(R);
            if (K && C) {
                O = Math.min(K.x, C.x);
                N = Math.min(K.y, C.y);
                T = Math.max(K.x, C.x);
                S = Math.max(K.y, C.y);
                M = T;
                L = S;
                for (y = N; y <= L; y++) {
                    R = f[y][O];
                    if (!R.real) {
                        if (O - (R.colspan - 1) < O) {
                            O -= R.colspan - 1
                        }
                    }
                }
                for (x = O; x <= M; x++) {
                    R = f[N][x];
                    if (!R.real) {
                        if (N - (R.rowspan - 1) < N) {
                            N -= R.rowspan - 1
                        }
                    }
                }
                for (y = N; y <= S; y++) {
                    for (x = O; x <= T; x++) {
                        R = f[y][x];
                        if (R.real) {
                            P = R.colspan - 1;
                            Q = R.rowspan - 1;
                            if (P) {
                                if (x + P > M) {
                                    M = x + P
                                }
                            }
                            if (Q) {
                                if (y + Q > L) {
                                    L = y + Q
                                }
                            }
                        }
                    }
                }
                F.removeClass(F.select("td.mceSelected,th.mceSelected"), "mceSelected");
                for (y = N; y <= L; y++) {
                    for (x = O; x <= M; x++) {
                        F.addClass(f[y][x].elm, "mceSelected")
                    }
                }
            }
        }

        c.extend(this, {
            deleteTable: r,
            split: B,
            merge: p,
            insertRow: l,
            insertCol: g,
            deleteCols: n,
            deleteRows: m,
            cutRows: D,
            copyRows: I,
            pasteRows: A,
            getPos: E,
            setStartCell: v,
            setEndCell: u
        })
    }

    c.create("tinymce.plugins.TablePlugin", {
        init: function (f, g) {
            var e, k;

            function j(n) {
                var m = f.selection, l = f.dom.getParent(n || m.getNode(), "table");
                if (l) {
                    return new a(l, f.dom, m)
                }
            }

            function h() {
                f.getBody().style.webkitUserSelect = "";
                f.dom.removeClass(f.dom.select("td.mceSelected,th.mceSelected"), "mceSelected")
            }

            d([["table", "table.desc", "mceInsertTable", true], ["delete_table", "table.del", "mceTableDelete"], ["delete_col", "table.delete_col_desc", "mceTableDeleteCol"], ["delete_row", "table.delete_row_desc", "mceTableDeleteRow"], ["col_after", "table.col_after_desc", "mceTableInsertColAfter"], ["col_before", "table.col_before_desc", "mceTableInsertColBefore"], ["row_after", "table.row_after_desc", "mceTableInsertRowAfter"], ["row_before", "table.row_before_desc", "mceTableInsertRowBefore"], ["row_props", "table.row_desc", "mceTableRowProps", true], ["cell_props", "table.cell_desc", "mceTableCellProps", true], ["split_cells", "table.split_cells_desc", "mceTableSplitCells", true], ["merge_cells", "table.merge_cells_desc", "mceTableMergeCells", true]], function (l) {
                f.addButton(l[0], {title: l[1], cmd: l[2], ui: l[3]})
            });
            if (!c.isIE) {
                f.onClick.add(function (l, m) {
                    m = m.target;
                    if (m.nodeName === "TABLE") {
                        l.selection.select(m)
                    }
                })
            }
            f.onNodeChange.add(function (m, l, q) {
                var o;
                q = m.selection.getStart();
                o = m.dom.getParent(q, "td,th,caption");
                l.setActive("table", q.nodeName === "TABLE" || !!o);
                if (o && o.nodeName === "CAPTION") {
                    o = 0
                }
                l.setDisabled("delete_table", !o);
                l.setDisabled("delete_col", !o);
                l.setDisabled("delete_table", !o);
                l.setDisabled("delete_row", !o);
                l.setDisabled("col_after", !o);
                l.setDisabled("col_before", !o);
                l.setDisabled("row_after", !o);
                l.setDisabled("row_before", !o);
                l.setDisabled("row_props", !o);
                l.setDisabled("cell_props", !o);
                l.setDisabled("split_cells", !o);
                l.setDisabled("merge_cells", !o)
            });
            f.onInit.add(function (m) {
                var l, p, q = m.dom, n;
                e = m.windowManager;
                m.onMouseDown.add(function (r, s) {
                    if (s.button != 2) {
                        h();
                        p = q.getParent(s.target, "td,th");
                        l = q.getParent(p, "table")
                    }
                });
                q.bind(m.getDoc(), "mouseover", function (u) {
                    var s, r, t = u.target;
                    if (p && (n || t != p) && (t.nodeName == "TD" || t.nodeName == "TH")) {
                        r = q.getParent(t, "table");
                        if (r == l) {
                            if (!n) {
                                n = j(r);
                                n.setStartCell(p);
                                m.getBody().style.webkitUserSelect = "none"
                            }
                            n.setEndCell(t)
                        }
                        s = m.selection.getSel();
                        if (s.removeAllRanges) {
                            s.removeAllRanges()
                        } else {
                            s.empty()
                        }
                        u.preventDefault()
                    }
                });
                m.onMouseUp.add(function (A, B) {
                    var s, u = A.selection, C, D = u.getSel(), r, v, t, z;
                    if (p) {
                        if (n) {
                            A.getBody().style.webkitUserSelect = ""
                        }
                        function w(E, G) {
                            var F = new c.dom.TreeWalker(E, E);
                            do {
                                if (E.nodeType == 3 && c.trim(E.nodeValue).length != 0) {
                                    if (G) {
                                        s.setStart(E, 0)
                                    } else {
                                        s.setEnd(E, E.nodeValue.length)
                                    }
                                    return
                                }
                                if (E.nodeName == "BR") {
                                    if (G) {
                                        s.setStartBefore(E)
                                    } else {
                                        s.setEndBefore(E)
                                    }
                                    return
                                }
                            } while (E = (G ? F.next() : F.prev()))
                        }

                        C = q.select("td.mceSelected,th.mceSelected");
                        if (C.length > 0) {
                            s = q.createRng();
                            v = C[0];
                            z = C[C.length - 1];
                            w(v, 1);
                            r = new c.dom.TreeWalker(v, q.getParent(C[0], "table"));
                            do {
                                if (v.nodeName == "TD" || v.nodeName == "TH") {
                                    if (!q.hasClass(v, "mceSelected")) {
                                        break
                                    }
                                    t = v
                                }
                            } while (v = r.next());
                            w(t);
                            u.setRng(s)
                        }
                        A.nodeChanged();
                        p = n = l = null
                    }
                });
                m.onKeyUp.add(function (r, s) {
                    h()
                });
                if (m && m.plugins.contextmenu) {
                    m.plugins.contextmenu.onContextMenu.add(function (t, r, v) {
                        var w, u = m.selection, s = u.getNode() || m.getBody();
                        if (m.dom.getParent(v, "td") || m.dom.getParent(v, "th") || m.dom.select("td.mceSelected,th.mceSelected").length) {
                            r.removeAll();
                            if (s.nodeName == "A" && !m.dom.getAttrib(s, "name")) {
                                r.add({
                                    title: "advanced.link_desc",
                                    icon: "link",
                                    cmd: m.plugins.advlink ? "mceAdvLink" : "mceLink",
                                    ui: true
                                });
                                r.add({title: "advanced.unlink_desc", icon: "unlink", cmd: "UnLink"});
                                r.addSeparator()
                            }
                            if (s.nodeName == "IMG" && s.className.indexOf("mceItem") == -1) {
                                r.add({
                                    title: "advanced.image_desc",
                                    icon: "image",
                                    cmd: m.plugins.advimage ? "mceAdvImage" : "mceImage",
                                    ui: true
                                });
                                r.addSeparator()
                            }
                            r.add({
                                title: "table.desc",
                                icon: "table",
                                cmd: "mceInsertTable",
                                value: {action: "insert"}
                            });
                            r.add({title: "table.props_desc", icon: "table_props", cmd: "mceInsertTable"});
                            r.add({title: "table.del", icon: "delete_table", cmd: "mceTableDelete"});
                            r.addSeparator();
                            w = r.addMenu({title: "table.cell"});
                            w.add({title: "table.cell_desc", icon: "cell_props", cmd: "mceTableCellProps"});
                            w.add({title: "table.split_cells_desc", icon: "split_cells", cmd: "mceTableSplitCells"});
                            w.add({title: "table.merge_cells_desc", icon: "merge_cells", cmd: "mceTableMergeCells"});
                            w = r.addMenu({title: "table.row"});
                            w.add({title: "table.row_desc", icon: "row_props", cmd: "mceTableRowProps"});
                            w.add({title: "table.row_before_desc", icon: "row_before", cmd: "mceTableInsertRowBefore"});
                            w.add({title: "table.row_after_desc", icon: "row_after", cmd: "mceTableInsertRowAfter"});
                            w.add({title: "table.delete_row_desc", icon: "delete_row", cmd: "mceTableDeleteRow"});
                            w.addSeparator();
                            w.add({title: "table.cut_row_desc", icon: "cut", cmd: "mceTableCutRow"});
                            w.add({title: "table.copy_row_desc", icon: "copy", cmd: "mceTableCopyRow"});
                            w.add({
                                title: "table.paste_row_before_desc",
                                icon: "paste",
                                cmd: "mceTablePasteRowBefore"
                            }).setDisabled(!k);
                            w.add({
                                title: "table.paste_row_after_desc",
                                icon: "paste",
                                cmd: "mceTablePasteRowAfter"
                            }).setDisabled(!k);
                            w = r.addMenu({title: "table.col"});
                            w.add({title: "table.col_before_desc", icon: "col_before", cmd: "mceTableInsertColBefore"});
                            w.add({title: "table.col_after_desc", icon: "col_after", cmd: "mceTableInsertColAfter"});
                            w.add({title: "table.delete_col_desc", icon: "delete_col", cmd: "mceTableDeleteCol"})
                        } else {
                            r.add({title: "table.desc", icon: "table", cmd: "mceInsertTable"})
                        }
                    })
                }
                if (!c.isIE) {
                    function o() {
                        var r;
                        for (r = m.getBody().lastChild; r && r.nodeType == 3 && !r.nodeValue.length; r = r.previousSibling) {
                        }
                        if (r && r.nodeName == "TABLE") {
                            m.dom.add(m.getBody(), "p", null, '<br mce_bogus="1" />')
                        }
                    }

                    if (c.isGecko) {
                        m.onKeyDown.add(function (s, u) {
                            var r, t, v = s.dom;
                            if (u.keyCode == 37 || u.keyCode == 38) {
                                r = s.selection.getRng();
                                t = v.getParent(r.startContainer, "table");
                                if (t && s.getBody().firstChild == t) {
                                    if (b(r, t)) {
                                        r = v.createRng();
                                        r.setStartBefore(t);
                                        r.setEndBefore(t);
                                        s.selection.setRng(r);
                                        u.preventDefault()
                                    }
                                }
                            }
                        })
                    }
                    m.onKeyUp.add(o);
                    m.onSetContent.add(o);
                    m.onVisualAid.add(o);
                    m.onPreProcess.add(function (r, t) {
                        var s = t.node.lastChild;
                        if (s && s.childNodes.length == 1 && s.firstChild.nodeName == "BR") {
                            r.dom.remove(s)
                        }
                    });
                    o()
                }
            });
            d({
                mceTableSplitCells: function (l) {
                    l.split()
                }, mceTableMergeCells: function (m) {
                    var n, o, l;
                    l = f.dom.getParent(f.selection.getNode(), "th,td");
                    if (l) {
                        n = l.rowSpan;
                        o = l.colSpan
                    }
                    if (!f.dom.select("td.mceSelected,th.mceSelected").length) {
                        e.open({
                            url: g + "/merge_cells.htm",
                            width: 240 + parseInt(f.getLang("table.merge_cells_delta_width", 0)),
                            height: 110 + parseInt(f.getLang("table.merge_cells_delta_height", 0)),
                            inline: 1
                        }, {
                            rows: n, cols: o, onaction: function (p) {
                                m.merge(l, p.cols, p.rows)
                            }, plugin_url: g
                        })
                    } else {
                        m.merge()
                    }
                }, mceTableInsertRowBefore: function (l) {
                    l.insertRow(true)
                }, mceTableInsertRowAfter: function (l) {
                    l.insertRow()
                }, mceTableInsertColBefore: function (l) {
                    l.insertCol(true)
                }, mceTableInsertColAfter: function (l) {
                    l.insertCol()
                }, mceTableDeleteCol: function (l) {
                    l.deleteCols()
                }, mceTableDeleteRow: function (l) {
                    l.deleteRows()
                }, mceTableCutRow: function (l) {
                    k = l.cutRows()
                }, mceTableCopyRow: function (l) {
                    k = l.copyRows()
                }, mceTablePasteRowBefore: function (l) {
                    l.pasteRows(k, true)
                }, mceTablePasteRowAfter: function (l) {
                    l.pasteRows(k)
                }, mceTableDelete: function (l) {
                    l.deleteTable()
                }
            }, function (m, l) {
                f.addCommand(l, function () {
                    var n = j();
                    if (n) {
                        m(n);
                        f.execCommand("mceRepaint");
                        h()
                    }
                })
            });
            d({
                mceInsertTable: function (l) {
                    e.open({
                        url: g + "/table.htm",
                        width: 400 + parseInt(f.getLang("table.table_delta_width", 0)),
                        height: 320 + parseInt(f.getLang("table.table_delta_height", 0)),
                        inline: 1
                    }, {plugin_url: g, action: l ? l.action : 0})
                }, mceTableRowProps: function () {
                    e.open({
                        url: g + "/row.htm",
                        width: 400 + parseInt(f.getLang("table.rowprops_delta_width", 0)),
                        height: 295 + parseInt(f.getLang("table.rowprops_delta_height", 0)),
                        inline: 1
                    }, {plugin_url: g})
                }, mceTableCellProps: function () {
                    e.open({
                        url: g + "/cell.htm",
                        width: 400 + parseInt(f.getLang("table.cellprops_delta_width", 0)),
                        height: 295 + parseInt(f.getLang("table.cellprops_delta_height", 0)),
                        inline: 1
                    }, {plugin_url: g})
                }
            }, function (m, l) {
                f.addCommand(l, function (n, o) {
                    m(o)
                })
            })
        }
    });
    c.PluginManager.add("table", c.plugins.TablePlugin)
})(tinymce);