/*! Thrive Architect - 2019-06-28
* http://www.thrivethemes.com/
* Copyright (c) 2019 Thrive Themes */

"use strict";
var _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (e) {
    return typeof e
} : function (e) {
    return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
};
!function (l) {
    var h, v, n, u, f, a = {".js": [], ".json": [], ".css": [], ".html": []},
        c = "function" == typeof require ? require : null;
    return u = function (e) {
        var t = new Error("Could not find module '" + e + "'");
        return t.code = "MODULE_NOT_FOUND", t
    }, f = function (e, t, r) {
        var i, n;
        if ("function" == typeof e[t + r]) return t + r;
        for (i = 0; n = a[r][i]; ++i) if ("function" == typeof e[t + n]) return t + n;
        return null
    }, h = function (e, t, r, i, n, a) {
        var s, o, l, c, d, _;
        for ("." !== (s = (r = r.split("/")).pop()) && ".." !== s || (r.push(s), s = ""); null != (o = r.shift());) if (o && "." !== o && (".." === o ? (e = t.pop(), a = a.slice(0, a.lastIndexOf("/"))) : (t.push(e), e = e[o], a += "/" + o), !e)) throw u(i);
        if (s && "function" != typeof e[s] && ((_ = f(e, s, ".js")) || (_ = f(e, s, ".json")), _ || (_ = f(e, s, ".css")), _ || (_ = f(e, s, ".html")), _ ? s = _ : 2 !== n && "object" === _typeof(e[s]) && (t.push(e), e = e[s], a += "/" + s, s = "")), !s) return 1 !== n && e[":mainpath:"] ? h(e, t, e[":mainpath:"], i, 1, a) : h(e, t, "index", i, 2, a);
        if (!(d = e[s])) throw u(i);
        return d.hasOwnProperty("module") ? d.module.exports : (l = {}, d.module = c = {
            exports: l,
            id: a + "/" + s
        }, d.call(l, l, c, v(e, t, a)), c.exports)
    }, n = function (e, t, r, i) {
        var n, a = r, s = r.charAt(0), o = 0;
        if ("/" === s) {
            if (a = a.slice(1), !(e = l["/"])) {
                if (c) return c(r);
                throw u(r)
            }
            i = "/", t = []
        } else if ("." !== s) {
            if (n = a.split("/", 1)[0], !(e = l[n])) {
                if (c) return c(r);
                throw u(r)
            }
            i = n, t = [], (a = a.slice(n.length + 1)) || ((a = e[":mainpath:"]) ? o = 1 : (a = "index", o = 2))
        }
        return h(e, t, a, r, o, i)
    }, (v = function (t, r, i) {
        return function (e) {
            return n(t, [].concat(r), e, i)
        }
    })(l, [], "")
}({
    workspace: {
        editor: {
            js: {
                editor: {
                    src: {
                        "compat.js": function (e, t, r) {
                            var o;
                            o = jQuery, t.exports = {
                                dom_ready: function () {
                                    this.texts(), this.rows(), this.headings(), this.remove_inline_span_styles()
                                }, remove_inline_span_styles: function (e) {
                                    (e = e || TVE.Editor_Page.editor).find(TVE.ELEM.text).each(function () {
                                        o(this).find("span").each(function () {
                                            var e = o(this), t = !1, r = !1, i = !1, n = !1;
                                            700 === parseInt(e[0].style.fontWeight) && (t = !0), "italic" === e[0].style.fontStyle && (r = !0), -1 !== e[0].style.textDecoration.indexOf("underline") && (i = !0), -1 !== e[0].style.textDecoration.indexOf("line-through") && (n = !0), t && e.wrap("<strong></strong>"), r && e.wrap("<em></em>"), i && e.wrap("<u></u>"), n && e.wrap("<s></s>"), (t || r || i || n) && e.contents().unwrap()
                                        })
                                    })
                                }, texts: function (e) {
                                    (e = e || o("#tve_editor")).find(".thrv_text_element").not("div").removeClass("thrv_text_element"), e.find(".thrv-styled_list .thrv-inline-text").removeClass("thrv-inline-text").addClass("thrv-advanced-inline-text");
                                    for (var t = TVE.ELEM.text, r = TVE.ELEM.headings, i = [TVE.TEXT_INLINE, ".thrv_custom_html_shortcode *", ".tve_wp_shortcode *", ".thrive-shortcode-html *", ".tve_scT > ul", ".widget-title", ".wp-caption-text", "." + TVE.PostList.constants.TCB_SHORTCODE_CLASS], n = e.find(t).not(i.join(", ")), a = o(), s = void 0; n.length;) {
                                        for (a = s = n.first(); s.next().is(t);) a = a.add(a.next()), s = s.next();
                                        n = n.not(a), 1 === a.length && a.is(r) ? s.parents(TVE.TEXT_HEADINGS + "," + TVE.TEXT_BLOCK).length || a.wrap('<div class="thrv_wrapper thrv_heading"></div>') : s.closest(".thrv_text_element, .fr-element").length || a.wrapAll('<div class="thrv_wrapper thrv_text_element"></div>')
                                    }
                                    e.find(".thrv_text_element .thrv_text_element").children(0).unwrap(), (n = e.find(".thrv_tw_qs_button span span")).addClass("thrv-inline-text tve_editable"), e.find(".thrv_text_element .thrv_heading").children().unwrap(), e.find(".thrv_bullets_shortcode").addClass("thrv_text_element")
                                }, rows: function (e) {
                                    (e = e || o("#tve_editor")).find(".tcb-flex-row.thrv_wrapper").each(function (e, t) {
                                        var r = o(t);
                                        r.removeClass("thrv_wrapper"), r.wrap('<div class="thrv_wrapper thrv-columns"></div>')
                                    }), e.find(".tcb-flex-col").each(function () {
                                        var e = o(this), t = e.parent();
                                        e.children(".tcb-col").length || (e.children(".col-empty").remove(), e.children().not(".ui-resizable-handle").wrapAll('<div class="tcb-col"></div>')), t.hasClass("tve-flex-end") ? t.addClass("tcb-flex-end").removeClass("tve-flex-end") : t.hasClass("tve-flex-center") ? t.addClass("tcb-flex-center").removeClass("tve-flex-center") : t.hasClass("tve-flex-start") && t.removeClass("tve-flex-start")
                                    })
                                }, headings: function (e) {
                                    (e = e || o("#tve_editor")).find(".thrv_heading").each(function (e, t) {
                                        var r = jQuery(t);
                                        if (r.attr("data-tag")) return !0;
                                        r.html().match(/^<(h(\d{1}))/g) && r.attr("data-tag", RegExp.$1)
                                    })
                                }, insert_css_rule: function (e, t, r) {
                                    for (var i, n = 0; i = TVE.stylesheet.cssRules[n++];) if (i.selectorText === e) {
                                        t = i.style.cssText + t, TVE.stylesheet.deleteRule(n);
                                        break
                                    }
                                    TVE.stylesheet.insertRule(e + "{" + t + "}", r)
                                }, get_css_rules: function (e) {
                                    for (var t, r = 0; t = TVE.stylesheet.cssRules[r++];) if (t.type === CSSRule.STYLE_RULE && t.cssText && t.selectorText && -1 !== t.selectorText.indexOf('data-tve-custom-colour="' + e)) return t.cssText;
                                    return ""
                                }, conditionText: function (e) {
                                    return e.conditionText ? e.conditionText : e.cssText.match(/@media(.+?)\{/) ? RegExp.$1.trim() : ""
                                }
                            }
                        }, "drag.js": function (e, t, r) {
                            var u, b, i, n, a, c, d, s, f, o, l, _, v, h, V, p, g, m, E, T, y, x, w, C, S, R, A, k, L,
                                O;
                            u = jQuery, c = ".thrv_wrapper:not(.thrv_widget_menu *,.thrv_text_element,.tve_w_menu li,.canvas-mode,.thrv-styled_list *,.thrv-numbered_list *,.tve_no_drag,.symbol-edit-mode,.symbol-edit-mode *), .tve-draggable:not(.canvas-mode,.symbol-edit-mode), .tve_lp_header, .tve_lp_content, .tve_lp_footer, " + "ul,ol,address,blockquote,p".split(",").map(function (e) {
                                return ".thrv_text_element " + e
                            }).join(","), d = ".thrv_page_section, .thrv-page-section, .tve-page-section-in, .thrv-columns.tcb-elem-placeholder, .tcb-window-w, .tve_lp_content, .tve_more_tag, .tcb-pricing-table-box-container > .tcb-flex-col > .tcb-col > *", s = ".thrv-contact-form, .thrv-button-group, .tve-form, .thrv-content-block", l = o = f = null, h = v = !(_ = "tve_grabbed"), V = {}, u(), p = TVE.main.sidebar_extra.elements, g = r("./util/selectors"), m = function () {
                                return TVE.apply_filters("non_draggable", ".tve_no_drag, .thrive_leads_shortcode *, .thrive_ultimatum_shortcode *, .tve_faqB *, .tve_wp_shortcode *, .thrv_bullets_shortcode ul, .thrv_tw_qs *, .thrv_post_grid *, .thrv_custom_html_shortcode *, .thrv_widget *, .thrv_widget_menu *, .tve_w_menu, .tve_w_menu *, .thrive-shortcode-html *")
                            }, E = function () {
                                return TVE.apply_filters("draggable_elements", ".thrv_wrapper,.tve-draggable,.tve-cf-item,.tve-cf-submit,.tve_more_tag")
                            }, T = function () {
                                return TVE.apply_filters("droppable_targets", c)
                            }, y = function (e) {
                                return e.is(m())
                            }, x = function (e) {
                                return !!e.length && ("tve-drop-handle" === e[0].id || TVE.apply_filters("allow_dragenter", e.is(T()) && !e.is(".tve_wp_shortcode *"), e, f))
                            }, w = function (e) {
                                return e.is(TVE.apply_filters("dropzone_elements", ".tcb-replaceable-placeholder, .tve_colm, .tve_grt, .tve_faqC, td:not(.tcb-parent-placeholder-empty), th:not(.tcb-parent-placeholder-empty), .tve_reveal_container:not(.tcb-parent-placeholder-empty), .tve_scTC, .tcb-col, #tve_editor, .tve-cb:not(.tcb-parent-placeholder-empty), .tve_lp_content, .tve-page-section-in, .tcb-dropzone-element, .tve_editor_main_content"))
                            }, C = function (e, t) {
                                return !!(e && e.className && e.className.indexOf) && -1 !== e.className.indexOf(t)
                            }, S = function () {
                                var e = TVE.Editor_Page.editor.find(".tve_editor_main_content");
                                return e.length ? e : TVE.Editor_Page.editor
                            }, R = function () {
                                delete TVE.FLAGS.disable_menu_switch, TVE.main.toggle_navigation(!1);
                                var e = u("." + _);
                                e.removeAttr("draggable").removeClass(_), e.find(".fr-element").attr("contenteditable", !0)
                            }, k = A = null, L = {
                                init: function () {
                                    b = TVE.inner.$document, i = u(document.body), n = u("html"), l = this.page_scroll("tcb_lightbox" === tve_path_params.post_type ? "#tve-p-scroller" : "body"), b.add(TVE.$document).on("keydown", this.keydown).on("keyup", this.keyup).on("mousedown", E(), this.mousedown)
                                }, insert_from_parent: function (e) {
                                    TVE.Editor_Page.enable(), TVE.Editor_Page.blur(), this.fetch(e, this.get_available_target()), i.removeClass("tve-empty-placeholder"), TVE.do_action("tcb.element.insert", e)
                                }, keydown: function (e) {
                                    !v && e.ctrlKey && (v = !0), !h && e.altKey && (h = !0), TVE.do_action("tcb.editor.keydown", e)
                                }, keyup: function (e) {
                                    h = v = !1
                                }, mousedown: function (e) {
                                    if (TVE.state_manager.is_default() && !TVE.Editor_Page.is_disabled()) {
                                        var t, r = u(e.currentTarget);
                                        if (e.stopPropagation(), !y(r)) if (e.ctrlKey || e.metaKey || r.is("." + _)) {
                                            if (e.ctrlKey || e.metaKey) if (!r.parents("." + _).length && !r.find("." + _).length) return (t = r).hasClass(_) ? t.removeAttr("draggable").removeClass(_) : t.attr("draggable", !0).addClass(_), TVE.main.toggle_navigation(!0), TVE.main.switch_menu_to("multiple_select_elements"), TVE.FLAGS.disable_menu_switch = !0, TVE.Editor_Page.selection_manager.hide_all_icons(), TVE.froala.hide_toolbars(), TVE.froala.editor && TVE.froala.editor.events.trigger("blur"), !1
                                        } else R()
                                    }
                                }, clear_selection: function () {
                                    R()
                                }, body_class: function () {
                                    if (!TVE.apply_filters("tcb_drag_change_body_class", !0)) return !1;
                                    requestAnimationFrame(function () {
                                        i.addClass("tve-dragging")
                                    })
                                }, handle_mouseover: function (e) {
                                    return !(!TVE.allow_drag() || !TVE.state_manager.is_default()) && (!((t = e).is(m()) || !t.is(E())) && !e.is("." + _));
                                    var t
                                }, hide_handle: function () {
                                    TVE.ElementEditIcons.$drag_handle && TVE.ElementEditIcons.$drag_handle.hide(), TVE.ElementIcons.$drag_handle && TVE.ElementIcons.$drag_handle.hide()
                                }, editorActions: function (e) {
                                    TVE.do_action("drag_pre_init"), V.page_init();
                                    var t = TVE.Editor_Page.editor.find(E()).not(m()).addClass("tve-draggable");
                                    if (!TVE.BROWSER.mozilla) {
                                        var r = ".thrv_text_element,.thrv_heading,.thrv-styled_list,.thrv-numbered_list,.thrv-plain-text";
                                        TVE.BROWSER.chrome && (r += ",.thrv_responsive_video"), t.not(r).attr("draggable", "true")
                                    }
                                    return TVE.Editor_Page.editor.find(T()).addClass("tve-droppable"), e ? (k = e, TVE.Editor_Page.editor.off("dragenter.tcb dragleave.tcb dragover.tcb drop.tcb"), n.off("drop.tcb dragover.tcb"), k.off().add(V.$el).on("dragenter.tcb", this.dragenter).on("dragleave.tcb", this.dragleave).on("dragover.tcb", this.dragover).on("drop.tcb", this.drop)) : (k && k.off("dragenter.tcb dragleave.tcb dragover.tcb drop.tcb"), k = null, TVE.Editor_Page.editor.add(V.$el).off("dragenter.tcb dragleave.tcb dragover.tcb drop.tcb").on("dragenter.tcb", this.dragenter).on("dragleave.tcb", this.dragleave).on("dragover.tcb", this.dragover).on("drop.tcb", this.drop), i.off("dragstart.tcb").on("dragstart.tcb", ".tve-drag-handle," + E(), this.dragstart).off("dragend.tcb").on("dragend.tcb", ".tve-drag-handle," + E(), this.dragend), n.off("drop.tcb").on("drop.tcb", this.drop).off("dragover.tcb").on("dragover.tcb", this.dragover_body)), this.refresh()
                                }, get_available_target: function () {
                                    var e, t = u(".edit_mode");
                                    if (V.data("dir", "bottom"), 0 === t.length) {
                                        (t = TVE.Editor_Page.editor.find(".tve_editor_main_content").first()).length || (t = TVE.Editor_Page.editor), V.data("dir", "mid"), (e = t.children().last()).length && (t = e, V.data("dir", "bottom")), t = TVE.apply_filters("tcb.get_dropzone_target", t);
                                        var r = TVE.inner.$window.scrollTop();
                                        t.offset().top + t.height() > TVE.inner.$window.height() + r && u("html,body").animate({scrollTop: t.offset().top + t.height()})
                                    }
                                    return V.data("tt", t), t
                                }, dragstart: function (e) {
                                    if (a = u("#tcb-drag-img")[0], function () {
                                            if (TVE.state_manager.is_hover()) return !0;
                                            if ("desktop" !== TVE.main.device) return !0;
                                            var e = k && k.is(".canvas-mode");
                                            return "disabled" === TVE.Editor_Page.STATE && !e
                                        }()) return !1;
                                    if (TVE.froala.editor && TVE.froala.editor.core.hasFocus() && !u(e.target).is(".tve-froala.tve_grabbed")) return !1;
                                    if ((f = u(e.currentTarget)).hasClass("tve-drag-handle") && (f = L.get_dragged_target(f)), y(f)) return f = null, !1;
                                    (f = f.is(".tve_grabbed") ? u("." + _) : f).parent().is("a") && (f = f.parent()), TVE.state(TVE.STATE_DRAG), TVE.froala.disable(f), f.addClass("tve-dragged").removeClass("active_delete active_duplicate"), L.body_class(), e.stopPropagation(), e.originalEvent.dataTransfer.setData("text/plain", ""), e.originalEvent.dataTransfer.setDragImage(a, 25, -25), f.is(d) && (V.force_limit_vertical = !0), TVE.FLAGS.$dragged_element = f, TVE.FLAGS.$dragged_element_parent = f.parent(), TVE.do_action("tcb.dragstart", f);
                                    var t = f.closest(s);
                                    0 === t.length && u(s).addClass("tve-no-drop-inside"), o = !f.is(s) && 0 < t.length ? t : null
                                }, main_drag_start: function (e) {
                                    if (TVE.state(TVE.STATE_DRAG), u(s).addClass("tve-no-drop-inside"), L.body_class(), e.static_element) {
                                        var t = e.static_element;
                                        t.length && t.children().first().is(d) && (V.force_limit_vertical = !0)
                                    }
                                    TVE.FLAGS.$dragged_element = e, TVE.do_action("tcb.dragstart.main", e)
                                }, dragend: function (e) {
                                    TVE.state(TVE.STATE_DEFAULT), i.removeClass("tve-dragging"), u(".tve-dragged").removeClass("tve-dragged"), u(".tve-no-drop-inside").removeClass("tve-no-drop-inside"), A = o = f = null, V.reset(), l.hide(), void 0 !== e && !0 === e && (p.dragged_elem = null), TVE.FLAGS.$dragged_element && TVE.FLAGS.$dragged_element.jquery && TVE.FLAGS.$dragged_element.parent().hasClass("tcb-replaceable-placeholder") && (TVE.FLAGS.$dragged_element.parent().replaceWith(TVE.FLAGS.$dragged_element), TVE.FLAGS.$dragged_element.parent().removeClass("tcb-parent-placeholder-empty"), TVE.do_action("tcb.contentbox_placeholder.render", TVE.FLAGS.$dragged_element.parent())), TVE.FLAGS.$dragged_element_parent && TVE.main.trigger("after-element-removed", TVE.FLAGS.$dragged_element_parent), TVE.do_action("tcb.dragend"), delete TVE.FLAGS.$dragged_element, delete TVE.FLAGS.$dragged_element_parent
                                }, dragenter: function (e) {
                                    if ((f || p.dragged_elem) && "tve-drop-handle" !== e.target.id) {
                                        var t = TVE.apply_filters("tcb.dragenter.bubble", "", e);
                                        if ("boolean" == typeof t) return t;
                                        if (V.limit_vertical = V.force_limit_vertical, V.data("append", !1), "tve-drop-handle" === e.target.id) return !(L.cancel_dragleave = !0);
                                        if (!f || e.target !== f[0] && !u.contains(f[0], e.target)) {
                                            if (A = TVE.apply_filters("tcb.dragenter", u(e.target), e), e.originalEvent.dataTransfer.dropEffect = "copy", delete V.FORBID_MIDDLE, f && f.is(".thrv-page-section, .tcb-window-width") || p.dragged_elem && "section" === p.dragged_elem.type) {
                                                var r = S();
                                                (A = A.closest(r.children(c))).length ? V.FORBID_MIDDLE = !0 : A = r
                                            }
                                            var i;
                                            if ("tve_editor" === e.target.id) e.pageY < TVE.Editor_Page.editor.offset().top + 30 && (i = TVE.Editor_Page.editor.children(c)).length && (1 === i.length && "absolute" === i.css("position") || (A = i.first()));
                                            delete V.dropzone_element;
                                            var n, a, s, o = A.children(T());
                                            if (w(A) && (0 === o.length || 1 === o.length && "absolute" === o.css("position"))) return a = (n = A)[0].classList, s = a.contains("tve-page-section-in") || a.contains("tve-cb") || a.contains("tve_reveal_container"), (s = TVE.apply_filters("tcb.allow_drop_near", s, n)) ? (V.dropzone_element = !0, A.is(d) && (V.limit_vertical = !0)) : V.position_mid(A), !1;
                                            if (A.children(T()).length < 2 && !A.is(".thrv_wrapper.thrv_lead_generation") && (A = A.closest(T())), !x(A)) {
                                                var l = A.parents(T()).first();
                                                return l.length && u.contains(TVE.Editor_Page.editor, l) ? (e.target = l[0], (A = l).trigger(e), !1) : void(A = null)
                                            }
                                            return V.last_dir = null, e.preventDefault(), A.is(d) && (V.limit_vertical = !0), V.can_position_mid = !V.FORBID_MIDDLE && !C(A[0], "thrv_text_element") && w(A) && 0 === A.children(c).length, !1
                                        }
                                        A = null
                                    }
                                }, dragover: function (e) {
                                    var t;
                                    if ((e.preventDefault(), A) && (("tve-drop-handle" !== (t = A)[0].id && x(t) || V.dropzone_element) && !(f && u.contains(f[0], A[0]) || o && 0 === o.find(A).length))) return V.position(A, e), e.originalEvent.dataTransfer.dropEffect = "copy", TVE.do_action("tcb.dragover", A, V), !1
                                }, dragover_body: function (e) {
                                    if (TVE.do_action("tcb.dragover_body", e), V && V.data("tt")) return !1
                                }, dragleave: function (e) {
                                    return L.cancel_dragleave ? delete L.cancel_dragleave : V.last_dir = null, !1
                                }, drop: function (e) {
                                    return e.preventDefault(), e.stopPropagation(), !(!p.dragged_elem && !f || !V.data("tt") || !V.data("tt")[0]) && (!!TVE.apply_filters("allow_drop", !0, [p.dragged_elem || f, V]) && (f && u.contains(f[0], V.data("tt")[0]) ? void 0 : (i.removeClass("tve-dragging tve-empty-placeholder"), f && f.removeClass("tve-dragged"), V.hide(), l.hide(), p.dragged_elem ? L.fetch(p.dragged_elem, V.data("tt")) : (!0 !== h || TVE.main.EditMode.in_edit() || (f = f.clone()), L.insert(f, V.data("tt"))), TVE.do_action("tcb.element.dropped", {
                                        $source: p.dragged_elem ? p.dragged_elem.static_element : f,
                                        $destination: V.data("tt")
                                    }), f = null, L.dragend(), !1)))
                                }, bind_draggable: function (e) {
                                    var t = e.add(e.find(E())).filter(E()).not(m()).addClass("tve-draggable");
                                    TVE.BROWSER.mozilla || t.not(".thrv_text_element,.thrv_heading,.thrv-styled_list,.thrv-numbered_list").attr("draggable", "true"), e.add(e.find(T())).filter(T()).addClass("tve-droppable")
                                }, get_resize_class: function () {
                                    return "tcb-resized"
                                }, refresh: function () {
                                    TVE.BROWSER.mozilla || TVE.Editor_Page.editor.find("a,img").not(E()).attr("draggable", "false"), TVE.Editor_Page.editor.find("a.tcb-button-link").attr("draggable", "false"), O.bind(), u("#tve-drag-clone").remove(), S().addClass("tve_empty_dropzone")
                                }, fetch: function (e, t) {
                                    if (!1 === this.before_fetch(e, t)) return !1;
                                    t = TVE.apply_filters("tcb.change_target", t, V);
                                    var r = e.type;
                                    if (TVE.renderers[r]) return L.insert(TVE.renderers[r].render_default(), t, !1, !1, !0), !0;
                                    var i = TVE.main.static_element(r);
                                    if (i.length <= 0) return !1;
                                    var n = i.first().clone();
                                    return n.find(".tve_countdown_timer_evergreen").attr("data-id", "evergreen_" + Math.floor(1e4 * Math.random())), L.insert(n.html(), t, !1, !1, !0), !0
                                }, before_fetch: function (e, t) {
                                    var r = !0;
                                    return e.data && e.data.usertpl ? (this.load_template(e.data.key, t), r = !1) : e.type && (TVE.main.trigger("insert_element", e), e.prevent_insert && (r = !1)), r
                                }, after_fetch: function (e, t, r) {
                                    e.hasClass("thrv_content_container_shortcode") ? e.parent().addClass("tve_clearfix") : e.hasClass("thrv_countdown_timer") ? e.hasClass("tve_countdown_timer_evergreen") ? e.tve_countdown_timer_evergreen().update() : e.tve_countdown_timer().update() : e.hasClass("thrv_social_default") && TVE_Content_Builder.social.onDefaultInsert(e);
                                    var i = e.parent();
                                    i.hasClass("tcb-replaceable-placeholder") && (i.parent().removeClass("tcb-parent-placeholder-empty"), i.replaceWith(e)), TVE.apply_filters("element_drop", e)
                                }, insert: function (e, t, r, i, n) {
                                    r = void 0 !== r && r, i = void 0 !== i && i, TVE.Editor_Page.before_action(), TVE.Editor_Page.disable();
                                    var a = u(e);
                                    return r ? t.html(a) : i ? t.replaceWith(a) : this.insert_near(a, t, V.data("dir")), this.bind_draggable(a), void 0 !== n && n && L.after_fetch(a, t, V.data("dir")), L.after_drop(a, t, V.data("dir")), setTimeout(function () {
                                        TVE.Editor_Page.after_action(), L.refresh(), a.hasClass("tcb-elem-placeholder") ? a.children(".tcb-inline-placeholder-action").first().trigger("click") : n && (a.is(TVE.TEXT_ALL) ? TVE.froala.force_focus(a) : TVE.Editor_Page.selection_manager.select_element(a))
                                    }, 400), TVE.prevent_blur || (TVE.Editor_Page.enable(), TVE.Editor_Page.blur()), TVE.do_action("tcb.after-insert", a, t), a
                                }, after_drop: function (e, t, r) {
                                    var i = e[0];
                                    C(i, "thrv_social_default") ? TVE_Content_Builder.social.onDefaultDrop(e) : C(i, "tcb-window-width") || (TCB_Front.resizePageSection(), TVE.do_action("tcb_after_element_drop", e, t, r))
                                }, insert_near: function (e, t, r) {
                                    var i, n = e[0] === t[0];
                                    if (e.parent().hasClass("tcb-clear") && (e = e.parent()), t.parent().hasClass("tcb-clear") && (t = t.parent()), f && (i = e.parent()), t.is(".thrv_text_element *")) {
                                        var a = t.prevAll(), s = t.nextAll(), o = t.closest(".thrv_text_element"),
                                            l = o.attr("data-css");
                                        l = l ? ' data-css="' + l + '"' : "", "top" === V.data("dir") && a.length ? (u(a.get().reverse()).wrapAll('<div class="thrv_wrapper thrv_text_element"' + l + "></div>"), o.before(a.parent())) : "bottom" === V.data("dir") && s.length && (s.wrapAll('<div class="thrv_wrapper thrv_text_element"' + l + "></div>"), o.after(s.parent())), t = o
                                    }
                                    if ("mid" !== r && (t.parent("a[href]").length && (t = t.parent()), t.parent().closest("a[href]").length && e.find("a[href]").length)) return this.prevent_drop(t);
                                    switch (r) {
                                        case"mid":
                                            if (n) return;
                                            if (t.closest("a[href]").length && e.find("a[href]").length) return this.prevent_drop(t);
                                            t.append(e);
                                            break;
                                        case"top":
                                            if (n) return;
                                            t.before(e);
                                            break;
                                        case"bottom":
                                            if (n) return;
                                            t.after(e);
                                            break;
                                        case"right":
                                        case"left":
                                            var c, d, _, h = e.parent();
                                            if (n && 1 === h.children().length) return;
                                            if (C(t[0], "thrv-columns")) _ = (t = t.find(".tcb-flex-row").first()).children(".tcb-flex-col")["right" === r ? "last" : "first"](), d = "right" === r ? "after" : "before"; else if (C(t[0].parentNode.parentNode, "tcb-flex-col")) _ = t.closest(".tcb-flex-col"), d = "right" === r ? "after" : "before"; else {
                                                if (n) return;
                                                var v = t.next(".tcb-clear");
                                                t.wrap('<div class="thrv_wrapper thrv-columns tve-draggable"><div class="tcb-flex-row"></div></div>'), t.wrap('<div class="tcb-flex-col"></div>').wrap('<div class="tcb-col"></div>'), d = "right" === r ? "append" : "prepend", _ = t.closest(".tcb-flex-row"), v.length && t.after(v)
                                            }
                                            e.wrapAll('<div class="tcb-flex-col"></div>').wrapAll('<div class="tcb-col"></div>'), c = t.closest(".tcb-flex-row"), _[d](e.closest(".tcb-flex-col")), c.hasClass("tcb-resized") ? (c.removeClass("tcb-resized"), c.children().head_css({"max-width": ""}, "_ALL")) : -1 !== c[0].className.search("tve-flex-wrap-[d|t|m](?!-)") && e.parent().head_css_copy(_), c.children().removeClass("c-25 c-33 c-50 c-66 c-75")
                                    }
                                    e.addClass("tve-dropped"), setTimeout(function () {
                                        e.removeClass("tve-dropped")
                                    }, 200), this.ensure_column_placeholder(i), this.row_class(e.parents(".tcb-flex-row").first()), this.bind_draggable(e)
                                }, prevent_drop: function (e) {
                                    var t = e.closest("a[href]").children().first(),
                                        r = TVE.t.warning_link_inside_link.split("##split##");
                                    TVE.page_message(r[0] + '<strong>"' + TVE.get_element_name(t) + '"</strong>' + r[1], !0, 1e4)
                                }, after_clone: function (e, t) {
                                    this.bind_draggable(t), t.hasClass("thrv_social_default") && TVE_Content_Builder.social.onDefaultDrop(t), this.refresh(), TVE.main.trigger("after-element-cloned", e, t)
                                }, after_remove: function (e) {
                                    e.is(".thrv-content-block, .thrv-styled_list, .thrv-numbered_list") && 0 === e.find(g.get("mouseover")).length ? e.remove() : (L.ensure_column_placeholder(e), TVE.main.trigger("after-element-removed", e))
                                }, ensure_column_placeholder: function (e) {
                                    e && e.length && C(e[0], "tcb-flex-col") && 0 === e.children(".tcb-col").length && (e.children().not(".ui-resizable-handle").wrapAll('<div class="tcb-col"></div>'), this.row_class(e.parent(), !0))
                                }, remove_column: function (e) {
                                    var t = e.parent(), r = e.siblings().removeClass("c-25 c-33 c-50 c-66 c-75");
                                    e.is("a.tcb-col") && (t = e.closest(".tcb-flex-row"), e = e.closest(".tcb-flex-col")), e.remove(), 0 !== r.length ? (C(t[0], "tcb-resized") && (t.removeClass("tcb-resized"), r.head_css({"max-width": ""}, "_ALL")), this.row_class(t)) : t.parent().remove()
                                }, row_class: function (e, t) {
                                    if (e && e.jquery) {
                                        t = void 0 !== t && t;
                                        var r = e.children().length;
                                        e.parent().toggleClass("tcb-row-empty", r === e.find(".tcb-flex-col > .tcb-col:empty").children().length), t || (e.removeClass(function (e, t) {
                                            return t.split(" ").filter(function (e) {
                                                return -1 !== e.indexOf("tcb--cols--")
                                            }).join(" ")
                                        }).addClass("tcb--cols--" + r), 10 < r && e.addClass("tcb--cols--high"), this.resize_images(e))
                                    }
                                }, resize_images: function (e) {
                                    e.find(".tve_image_caption").each(function () {
                                        var e = parseInt(this.style.width), t = u(this), r = t.width();
                                        isNaN(e) || r < e && (t.css("width", r + "px"), t.find(".tve_image").css("width", r + "px"))
                                    })
                                }, load_template: function (e, r) {
                                    r.addClass("tcb-el-loading"), TVE.ajax("load_content_template", "post", {template_key: e}).done(function (e) {
                                        e = TVE.apply_filters("tcb.content_templates.data", e, r);
                                        var t = TVE.apply_filters("tcb_insert_content_template", u(e.html_code));
                                        t = TVE.Editor_Page.content_manager.process_saved_template(e.css_code, t, e.media_css, e.imports, !1, e.inline_rules), r.removeClass("tcb-el-loading"), L.insert(t, r, !1, !0), TVE.do_action("tcb.insert_content_template")
                                    }).always(function () {
                                        r.removeClass("tcb-el-loading")
                                    })
                                }, page_scroll: function (e) {
                                    void 0 === e && (e = "body");
                                    var i = u('<div id="tve_page_scroller_top" class="tve_window_drag_scroll"><span class="tve_arrow tve_icm tve-ic-caret-up"></span><div class="tve_drag_events"></div></div>').appendTo(e),
                                        n = u('<div id="tve_page_scroller_bottom" class="tve_window_drag_scroll"><span class="tve_arrow tve_icm tve-ic-caret-down"></span><div class="tve_drag_events"></div></div>').appendTo(e),
                                        t = i.add(n), r = null, a = u(e);

                                    function s(e, t) {
                                        if (void 0 === t && (t = !1), a.is(":animated")) return !0;
                                        var r = a.is("body") ? u(window).scrollTop() : a.scrollTop();
                                        return -1 == e ? (n.removeClass("tve_scroll_hide"), 0 === r ? i.addClass("tve_scroll_hide").removeClass("tve_drag_hover") : i.removeClass("tve_scroll_hide")) : (i.removeClass("tve_scroll_hide"), r + u(window).height() >= u("body").height() - 45 ? n.addClass("tve_scroll_hide").removeClass("tve_drag_hover") : n.removeClass("tve_scroll_hide")), t || a.animate({scrollTop: r + 120 * e}, 80, "linear"), !0
                                    }

                                    return a.is("body") && (a = u("body,html")), t.each(function () {
                                        var e = u(this).children(".tve_drag_events").first();
                                        e.on("dragenter", function () {
                                            var e = u(this).parent(), t = e.is(i) ? -1 : 1;
                                            clearInterval(r), t, r = setInterval(function () {
                                                s(t)
                                            }, 20), e.addClass("tve_drag_hover")
                                        }), e.on("dragleave", function () {
                                            clearInterval(r), u(this).parent().removeClass("tve_drag_hover")
                                        })
                                    }), s(-1, !0), {
                                        show: function () {
                                            t.show()
                                        }, hide: function () {
                                            clearInterval(r), t.removeClass("tve_drag_hover tve_scroll_hide")
                                        }
                                    }
                                }, get_selection_type: function (e) {
                                    var t = !1;
                                    return !!e.length && (e.each(function () {
                                        return !1 === t ? (t = u(this).data("tve-el-type"), !0) : t != u(this).data("tve-el-type") ? t = !1 : void 0
                                    }), t)
                                }, convert_old_columns: function (e) {
                                    var t = e.children(), r = "tcb-flex-row tcb--cols--" + t.length,
                                        i = "thrv_wrapper tve-draggable tve-droppable edit_mode", n = {
                                            tve_oth: "c-33",
                                            tve_tth: "c-66",
                                            tve_foc: "c-25",
                                            tve_tfo: "c-75",
                                            tve_twc: "c-50"
                                        };
                                    4 <= t.length || 2 === t.filter(".tve_twc,.tve_oth").length || t.each(function () {
                                        var r = this;
                                        u.each(n, function (e, t) {
                                            r.className = r.className.replace(e, t)
                                        })
                                    });
                                    var a = !1, s = !1;
                                    "0px" === e.css("margin-top") && (a = !0), "0px" === e.css("margin-bottom") && (s = !0), t.removeClass("tve_colm tve_df tve_ofo tve_fic tve_lst tve_foc tve_tfo tve_twc tve_oth tve_tth tve_thc").addClass("tcb-flex-col"), e.removeClass("thrv_columns tve_clearfix " + i).addClass(r).wrap('<div class="thrv-columns ' + i + '"></div>'), t.each(function () {
                                        u(this).children().wrapAll('<div class="tcb-col"></div>')
                                    }), a && (e.css("padding-top", "0px"), e.parent().css("margin-top", "0px")), s && (e.css("padding-bottom", "0px"), e.parent().css("margin-bottom", "0px")), O.bind(e)
                                }, position_resizables: function (e, t) {
                                    O.position_handles(e, t)
                                }, bind_element: function (e) {
                                    this.bind_draggable(e), O.bind(e)
                                }, get_dragged_target: function (e) {
                                    var t = TVE.ElementIcons.$drag_handle;
                                    return t.is(e) || (t = TVE.ElementEditIcons.$drag_handle), t.data("el")
                                }
                            }, O = {
                                position_handles: function (e, t) {
                                    void 0 === t && (t = parseInt(e.children(".tcb-flex-col").first().css("paddingLeft")));
                                    var r = 6 <= t ? (t - 6) / 2 + "px" : 0;
                                    e.find("> .tcb-flex-col > .ui-resizable-handle").css("padding", "0 " + r + " 0 " + r).css("marginLeft", 0 === r ? "-3px" : "").css("zIndex", 100)
                                }, bind: function (e) {
                                    e = e || TVE.Editor_Page.editor;
                                    var s, i, n, o = {}, l = {}, c = 15, d = null,
                                        _ = u("<span>", {class: "ui-resize-left"}),
                                        h = u("<span>", {class: "ui-resize-right"}), t = e.find(".tcb-flex-col");
                                    t.find(".ui-resizable-handle").remove(), t.each(function () {
                                        var e = u(this);
                                        e.data("ui-resizable") && e.resizable("destroy")
                                    }), t.resizable({
                                        handles: "e", start: function (e, t) {
                                            TVE.FLAGS.drag = !0, TVE.Editor_Page.before_action(), TVE.Editor_Page.editor.addClass("tcb-resizing"), i = t.element.parent(), s = i.width();
                                            var r = t.element.children(".ui-resizable-handle");
                                            n = i.children(".tcb-flex-col"), i.hasClass("tcb-resized") || (n.each(function () {
                                                var e = u(this);
                                                e.head_css({"max-width": e.outerWidth() / s * 100 + "%"})
                                            }), i.addClass("tcb-resized")), i.addClass("tcb-resizing"), r.before(_), r.after(h), c = parseInt(t.element.css("padding-left")), l = {left_column: t.element}, "desktop" === TVE.main.device && i.hasClass("tcb-row-reversed-desktop") || "tablet" === TVE.main.device && i.hasClass("tcb-row-reversed-tablet") || "mobile" === TVE.main.device && i.hasClass("tcb-row-reversed-mobile") ? l.right_column = t.element.prev() : l.right_column = t.element.next(), o = {
                                                elem: l.left_column.outerWidth() / s * 100,
                                                next: l.right_column.outerWidth() / s * 100
                                            }, d = null
                                        }, stop: function (e, t) {
                                            setTimeout(function () {
                                                TVE.Editor_Page.editor.removeClass("tcb-resizing"), TVE.Editor_Page.reposition_icons()
                                            }), d && (l.left_column.head_css({"max-width": d.elem + "%"}), l.right_column.head_css({"max-width": d.next + "%"})), l.left_column.css("width", "").css("height", ""), n.css({"max-width": ""}), i.removeClass("tcb-resizing"), TVE.FLAGS.drag = !1, l.left_column.find(".ui-resize-left, .ui-resize-right").remove(), L.resize_images(i), TVE.Editor_Page.after_action(), TVE.do_action("tcb.columns.resized", l)
                                        }, resize: function (e, t) {
                                            var r, i = (100 * (c + t.size.width) / s).toFixed(1),
                                                n = i - 5 * Math.floor(i / 5), a = i - (d ? d.elem : o.elem);
                                            return v && (i = 5 * parseInt(i / 5)), r = (o.next - i + o.elem).toFixed(1), v && (0 === n || 0 < a && 3 < n || a < 0 && 2 < n) || i * s / 100 <= 100 || r * s / 100 <= 100 || (l.left_column.css({"max-width": i + "%"}), l.right_column.css({"max-width": r + "%"}), d = {
                                                elem: i,
                                                next: r
                                            }, _.html(parseFloat(i).toFixed(v ? 0 : 1) + "%"), h.html(parseFloat(r).toFixed(v ? 0 : 1) + "%"), TVE.Editor_Page.reposition_icons()), !1
                                        }
                                    }), e.find(".tcb-flex-row").each(function () {
                                        O.position_handles(u(this))
                                    })
                                }
                            }, V.page_init = function () {
                                this.$el || (this.$el = u('<div id="tve-drop-handle"><div class="tve-drop-arrow" style="display:none"></div></div>').appendTo("body"), this.$arrow = this.$el.children(".tve-drop-arrow"), this.$marker = u('<div class="tve-drop-marker"><div class="m--top"></div><div class="m--right"></div><div class="m--bottom"></div><div class="m--left"></div></div>').appendTo("body"))
                            }, V.show = function () {
                                return this.$el[0].style.display = "block", this.$marker[0].style.display = "block", this
                            }, V.hide = function () {
                                return this.$el[0].style.display = "none", this.$marker[0].style.display = "none", this
                            }, V.data = function () {
                                return this.$el.data.apply(this.$el, arguments)
                            }, V.is = function () {
                                return this.$el.is.apply(this.$el, arguments)
                            }, V.reset = function () {
                                this.hide(), this.last_dir = null, this.$el.data("append", null), this.limit_vertical = null, this.force_limit_vertical = null, this.$el.data("tt", null), u(".tve-dragged-over").removeClass("tve-dragged-over")
                            }, V.position = function (e, t) {
                                var r, i, n, a, s, o, l, c, d, _, h, v, u, f, p = e.offset(), g = e.outerWidth(),
                                    m = e.outerHeight(), E = (s = {
                                        left: t.clientX,
                                        top: t.clientY,
                                        limit_vertical: e.limit_vertical
                                    }, o = p, l = g, c = m, d = s.left - o.left, _ = s.top - o.top + b.scrollTop(), v = .33 * l, u = _ * (h = l / c) < d, f = _ * h + d < l, V.dropzone_element && c / 4 < _ && _ < 3 * c / 4 && l / 4 < d && d < 3 * l / 4 ? "mid" : V.limit_vertical ? V.can_position_mid && c / 4 < _ && _ < 3 * c / 4 ? "mid" : _ < c / 2 ? "top" : "bottom" : v <= d && d < 2 * v ? _ < c / 2 ? "top" : "bottom" : u && f ? "top" : u && !f ? "right" : !u && f ? "left" : "bottom"),
                                    T = null;
                                if (this.last_dir === E) return this;
                                if ("mid" === E) return this.position_mid(e);
                                switch (this.data("tt", this.dropzone_element ? e.closest(".thrv_wrapper") : e), T || (T = V.data("tt")), "left" !== E && "right" !== E || !T.parents(".thrv_text_element").length || (g = (T = T.parents(".thrv_text_element").first()).outerWidth(), m = T.outerHeight(), p = T.offset()), this.last_dir = E, this.highlight_target(T, g, m, p), E) {
                                    case"top":
                                        r = g + 2, i = 9, n = p.top - 1, a = p.left - 1;
                                        break;
                                    case"right":
                                        r = 9, i = m + 2, n = p.top - 1, a = p.left + g - 9;
                                        break;
                                    case"bottom":
                                        r = g + 2, i = 9, n = p.top + m - 9, a = p.left - 1;
                                        break;
                                    case"left":
                                        r = 9, i = m + 2, n = p.top - 1, a = p.left - 1
                                }
                                this.$el.css({
                                    width: r + "px",
                                    height: i + "px",
                                    top: (n < 0 ? 0 : n) + "px",
                                    left: (a < 0 ? 0 : a) + "px",
                                    opacity: 1,
                                    display: "block"
                                }).data("dir", E)
                            }, V.position_mid = function (e) {
                                this.$el.data("tt", e), this.last_dir = "mid";
                                var t = e.offset();
                                this.$el.css({
                                    width: e.outerWidth(),
                                    height: 9,
                                    top: t.top + e.outerHeight() / 2 - 4.5,
                                    left: t.left,
                                    display: "block"
                                }).data("dir", "mid"), this.highlight_target(e, null, null, t)
                            }, V.highlight_target = function (e, t, r, i) {
                                t = t || e.outerWidth(), r = r || e.outerHeight();
                                var n = TVE.t["el_dir_" + this.last_dir] + " " + TVE.get_element_name(e.closest(g.elements));
                                if (t < 60 && "left" !== this.last_dir && "right" !== this.last_dir ? n = n.split(" ")[0] : r < 92 && ("left" === this.last_dir || "right" === this.last_dir) && (n = n.split(" ")[0]), u(".tve-dragged-over").removeClass("tve-dragged-over"), this.$el[0].className = "el-" + this.last_dir, this.$el[0].dataset.text = n, e[0].classList.add("tve-dragged-over"), this.$marker.css({
                                        display: "block",
                                        top: i.top + "px",
                                        left: i.left + "px"
                                    }), this.$marker.find(".m--top").css({width: t + 2 + "px"}), this.$marker.find(".m--right").css({
                                        height: r + 2 + "px",
                                        left: t + 1 + "px"
                                    }), this.$marker.find(".m--bottom").css({
                                        width: t + 2 + "px",
                                        top: r + 1 + "px"
                                    }), this.$marker.find(".m--left").css({height: r + 2 + "px"}), "mid" !== this.last_dir) {
                                    var a = {display: "", top: r / 2, left: t / 2, width: "", height: ""};
                                    t < 25 || r < 25 ? a.width = a.height = "16px" : (t < 50 || r < 50) && (a.width = a.height = Math.min(t, r) - 12 + "px"), "bottom" === this.last_dir && (a.top = 9 - a.top - 1), "right" === this.last_dir && (a.left = 9 - a.left - 1), a.top += "px", a.left += "px", this.$arrow.css(a)
                                } else this.$arrow[0].style.display = "none"
                            }, L.get_draggable_elements = E, t.exports = L
                        }, "editor-page.js": function (e, t, r) {
                            var c;
                            c = jQuery, t.exports = {
                                selection_manager: r("./util/selection-manager"),
                                content_manager: r("./util/content"),
                                STATE: "enabled",
                                editor: null,
                                event: null,
                                winWidth: null,
                                htmlOffset: null,
                                save_notification_timeout: null,
                                onDOMReady: function () {
                                    TVE.drag.init(), this.winWidth = c(window).width(), this.editor = TVE.apply_filters("editor_wrapper", c("#tve_editor")), this.$body = c("body"), TVE.apply_filters("before_editor_events"), this.bind_events(), TVE.apply_filters("main_ajax_callback"), TVE.main.editor_loaded(), TVE.apply_filters("editor_loaded_callback"), TVE.CONST.landing_page && this.landingPageInit()
                                },
                                bind_events: function () {
                                    this.editor.is(":empty") && this.$body.addClass("tve-empty-placeholder"), TVE.bind_global_events(), this.initEditorActions(), this.editor.off("click.tcbaction").on("click.tcbaction", ".tcb-click", function (e) {
                                        for (var t = this.getAttribute("data-fn"), r = TVE, i = t.split("."), n = window; r && i.length;) r = (n = r)[i.shift()];
                                        if ("function" == typeof r) return r.call(n, e)
                                    })
                                },
                                initEditorActions: function (e) {
                                    void 0 === e && (e = !1), this.editor = TVE.apply_filters("editor_wrapper", c("#tve_editor")), TVE.compat.dom_ready(), this.selection_manager.init(TVE.CONST.tcb_selection_root ? c(TVE.CONST.tcb_selection_root) : this.editor);
                                    var t = !1, r = !1;

                                    function i(e) {
                                        var t, r = e, i = c(r), n = {CSS_EXISTS: !0};
                                        return i.length || (i = c('<style type="text/css"></style>').appendTo(c("head")), -1 !== r.indexOf(".") && (r = r.substring(r.indexOf("."), r.length)), "." === r[0] ? i.attr("class", r.substring(1)) : i.attr("id", r.substring(1)), n.CSS_EXISTS = !1), (t = i[0]).styleSheet ? t.styleSheet.cssText = t.styleSheet.cssText + "" : t.appendChild(document.createTextNode("")), n.style = t, n
                                    }

                                    var n = i(TVE.apply_filters("css_style_selector", "style.tve_custom_style")),
                                        a = i("style.tve_global_style");
                                    if (n.CSS_EXISTS || (n.style.onload = function () {
                                            TVE.CSS_Rule_Cache.init(e), t = !0
                                        }), TVE.stylesheet = n.style.sheet, a.CSS_EXISTS || (a.style.onload = function () {
                                            TVE.USE_GLOBALSHEET = !0, TVE.CSS_Rule_Cache.init(e), r = !0, TVE.USE_GLOBALSHEET = !1
                                        }), TVE.globalsheet = a.style.sheet, TVE.BROWSER.mozilla) var s = setInterval(function () {
                                        try {
                                            TVE.stylesheet.cssRules, TVE.main.trigger("tve_stylesheet_loaded"), clearInterval(s), TVE.CSS_Rule_Cache.init(e), t = !0
                                        } catch (e) {
                                        }
                                    }, 100), o = setInterval(function () {
                                        try {
                                            TVE.globalsheet.cssRules, clearInterval(o), TVE.USE_GLOBALSHEET = !0, TVE.CSS_Rule_Cache.init(e), r = !0, TVE.USE_GLOBALSHEET = !1
                                        } catch (e) {
                                        }
                                    }, 100); else setTimeout(function () {
                                        t || TVE.CSS_Rule_Cache.init(e), r || (TVE.USE_GLOBALSHEET = !0, TVE.CSS_Rule_Cache.init(e), TVE.USE_GLOBALSHEET = !1)
                                    }, 500);
                                    var l = c(".thrv_countdown_timer");
                                    l.length && l.addClass("init_done").each(function () {
                                        c(this).hasClass("tve_countdown_timer_evergreen") ? c(this).tve_countdown_timer_evergreen().update() : c(this).tve_countdown_timer().update()
                                    }), TVE.drag.editorActions(), this.enableSaveWarning(), TVE.froala.init(), this.content_manager.prepare_content_for_editor()
                                },
                                blur: function (e) {
                                    TVE.froala.hide_toolbars(), e = void 0 === e || e, this.selection_manager.blur(e)
                                },
                                focus_element: function (e, t, r) {
                                    if (!TVE.allow_edit() || "enabled" !== this.STATE && !this.editor.find(".canvas-mode").length) return !1;
                                    if (!e.hasClass("edit_mode")) {
                                        TVE.$will_focus = e, this.blur(), TVE.do_action("tcb.element.before_focus", e), TVE.state(TVE.STATE_EDIT), e.addClass("edit_mode");
                                        var i = new c.Event("element_selected");
                                        if (i.is_mouse = t && t.originalEvent || r && r.emulate, TVE.main.element_selected(e, i), i.isDefaultPrevented()) return e.removeClass("edit_mode"), !1;
                                        setTimeout(function () {
                                            e.focus()
                                        }, 0), TVE.do_action("tcb.element.focus", e), delete TVE.$will_focus
                                    }
                                },
                                duplicate_element: function (e) {
                                    TVE.froala.disable(e);
                                    var t = e.parent().hasClass("tcb-clear") || e.parent("a[href]").length,
                                        r = t ? e.parent().clone() : e.clone();
                                    return t ? e.parent().after(r) : e.after(r), e.data("tve-el-type") && r.data("tve-el-type", e.data("tve-el-type")), r.add(r.children()).removeClass("edit_mode canvas-mode active_highlight active_delete on_hover active_duplicate"), TVE.drag.after_clone(e, r), r.is(TVE.Components.group.group_elements_classes) && r.find("[data-css]").addBack().each(function () {
                                        TVE.inner_$(this).head_css_clone()
                                    }), TVE.do_action("tcb.element.duplicate", e, r), this.reposition_icons(), this
                                },
                                save_element: function (e) {
                                    return TVE.ActiveElement = e, TVE.modal_open("save-elements", {element: TVE.ActiveElement}), !1
                                },
                                remove_element: function (e) {
                                    var t = e.parent();
                                    if (TVE.froala.disable(e), this.blur(!0), (t.hasClass("tcb-clear") || e.parent("a[href]").length) && (t = t.parent(), e = e.parent()), e.is(".thrv_tabs_shortcode > .tve_scT > ul li")) {
                                        var r = e.index();
                                        return e.remove(), t.parent().find(".tve_scTC").eq(r).remove(), t.children().length === r && r--, t.find("li").eq(r).click(), this
                                    }
                                    return t.is("ul,ol") && 1 === t.find("li").length ? t.parent().is(".thrv_bullets_shortcode") ? this.remove_element(t.parent()) : this.remove_element(t) : t.hasClass("thrv_toggle_shortcode") && 1 === t.children(".tve_faq").length ? this.remove_element(t) : (TVE.apply_filters("allow_remove", !0, [e]) && (e.hasClass("tcb-col") ? TVE.drag.remove_column(e.parent()) : (e.remove(), TVE.drag.after_remove(t)), this.editor.is(":empty") && this.$body.addClass("tve-empty-placeholder"), TVE.do_action("tcb.element.remove", e)), this)
                                },
                                is_disabled: function () {
                                    return "disabled" === this.STATE
                                },
                                disable: function () {
                                    this.selection_manager.hide_icons(), this.STATE = "disabled"
                                },
                                enable: function () {
                                    this.STATE = "enabled", TVE.remove_body_overlay(), c(this).trigger("editor.onenable")
                                },
                                disable_clicks: function (e) {
                                    var t = (e = void 0 === e ? {} : e).z_index_overlay || "100000";
                                    TVE.body_overlay({"z-index": t}), TVE.prevent_blur = !0, TVE.main.$("#tcb-editor-settings").addClass("tcb-disabled"), TVE.main.active_elem_nav_view && TVE.main.active_elem_nav_view.disable(), TVE.ActiveElement && (TVE.ElementEditIcons.hide_icons(), TVE.ElementIcons.hide_icons(), TVE.froala.hide_toolbars()), TVE.do_action("tcb.editor_page.disable_clicks", e)
                                },
                                enable_clicks: function (e) {
                                    e = void 0 === e ? {} : e, TVE.remove_body_overlay(), TVE.prevent_blur = !1, TVE.main.$("#tcb-editor-settings").removeClass("tcb-disabled"), TVE.main.active_elem_nav_view && TVE.main.active_elem_nav_view.enable(), TVE.ActiveElement && (TVE.ElementEditIcons.show_icons(TVE.ActiveElement), TVE.ActiveElement.is(TVE.TEXT_ALL) && TVE.froala.editor.events.focus()), TVE.do_action("tcb.editor_page.enable_clicks", e)
                                },
                                thriveShrtcodeConfig: function (t, e) {
                                    var r = "__CONFIG_" + e + "__";
                                    return {
                                        update: function (e, t) {
                                            var r = this.get();
                                            r[t] = e, this.save(r)
                                        }, save: function (e) {
                                            t.html(r + JSON.stringify(e).replace(/\\"/g, "_tve_quote_") + r)
                                        }, get: function () {
                                            var e = new RegExp(r, "g");
                                            return JSON.parse(t.html().replace(/_tveutf8_/g, "\\u").replace(e, "").replace(/\\\'/g, "'").replace(/_tve_quote_/g, '\\"'))
                                        }
                                    }
                                },
                                enableSaveWarning: function () {
                                    var e = this;
                                    TVE.CONST.tve_display_save_notification = parseInt(TVE.CONST.tve_display_save_notification), !TVE.CONST.tve_display_save_notification || this.save_notification_timeout || TVE.CONST.debug_mode || (this.save_notification_timeout = setInterval(function () {
                                        TVE.page_message('<strong>Reminder</strong><p>You have not saved your work for 10 minutes.</p><p>We recommend you perform a save to make sure you don\'t lose any work !</p><a id="tve-stop-saving-warning" class="button-link blue" href="javascript:void(0)">Stop reminding me for this work only !</a>', -1, 6e3), TVE.$("#tve-stop-saving-warning").click(function () {
                                            TVE.$notification.fadeOut(200), e.disableSaveWarning(), TVE.CONST.tve_display_save_notification = 0
                                        }), TVE.$notification.find(".tve-ic-close").click(function () {
                                            c(this).parent().fadeOut(200)
                                        })
                                    }, 6e5))
                                },
                                disableSaveWarning: function () {
                                    TVE.CONST.tve_display_save_notification = parseInt(TVE.CONST.tve_display_save_notification), TVE.CONST.tve_display_save_notification && (clearInterval(this.save_notification_timeout), this.save_notification_timeout = null)
                                },
                                save: function (t, r, e) {
                                    var i = {preventSave: !1};
                                    if (TVE.main.trigger("tve.tve_save_post", i), i.preventSave) return i.return;
                                    var n = this.content_manager.prepare_save_data(t, e), a = arguments,
                                        s = "save_post";
                                    TVE.CONST.save_post_action && (s = "save_post_external", n.external_action = TVE.CONST.save_post_action);
                                    var o = TVE.ajax(s, "post", n).done(function (e) {
                                        return "0" === String(e) ? (TVE.login_callback || (TVE.login_callback = TVE.Editor_Page.save.apply(TVE.Editor_Page, a)), void TVE.relogin()) : e.success ? (t && (e.revisions && TVE.RevisionManager.reset_revisions(e.revisions), TVE.page_message(TVE.t.AllChangesSaved)), void("function" == typeof r && r(e))) : TVE.page_message(e.message, !0, 5e3)
                                    }).always(function (e, t) {
                                        TVE.main.overlay("close")
                                    });
                                    return this.disableSaveWarning(), this.enableSaveWarning(), TVE.UndoManager && TVE.UndoManager.clear(), o
                                },
                                editor_content: function () {
                                    return c("<div></div>").html(this.editor.html()).find(".tve-dragged-over,.edit_mode, .active_duplicate, .on_hover").removeClass("tve-dragged-over edit_mode active_duplicate on_hover ").end().find(".tve_placeholder, .tve-ui-helper, .rangySelectionBoundary").remove().end().html()
                                },
                                before_action: function () {
                                    return window.content_before_action = this.editor_content(), window.content_editor_class = this.editor.attr("class"), this
                                },
                                after_action: function () {
                                    var e = window.content_before_action, t = window.content_editor_class,
                                        r = this.editor_content();

                                    function i(e) {
                                        this.editor.html(e), this.editor.attr("class", t), TVE.drag.refresh(), TCB_Front.refreshBackgroundYoutube(), TVE.do_action("tcb.editor.undo")
                                    }

                                    return TVE.UndoManager.add({
                                        undo: c.proxy(i, this, e),
                                        redo: c.proxy(i, this, r)
                                    }), this
                                },
                                get_custom_css: function (e) {
                                    var t = c("style#tve_head_custom_css");
                                    return 0 === t.length ? void 0 !== e && e ? "/** Insert your custom CSS rules here. **/" : "" : t.text()
                                },
                                add_custom_css: function (e) {
                                    var t = c("style#tve_head_custom_css");
                                    0 === t.length && (t = c('<style type="text/css" class="tve_user_custom_style" id="tve_head_custom_css"></style>').appendTo(c("head"))), t.text(e)
                                },
                                reposition_icons: function (e) {
                                    this.is_disabled() || (void 0 === e && (e = TVE.ActiveElement), e && 1 === e.length && TVE.ElementEditIcons.reposition_icons(e), e && 1 < e.length && TVE.ElementEditIcons.reposition_icons(TVE.getSelectedElement()))
                                },
                                landingPageInit: function () {
                                    TVE.main.on("element_selected", function () {
                                        TVE.ActiveElement.is("body.tve_lp") && function (e) {
                                            var t = {}, r = e[0].style;
                                            if (e.attr("style")) {
                                                var i = " !important";
                                                r.backgroundColor && (t["background-color"] = r.backgroundColor + i), r.backgroundImage && (t["background-image"] = r.backgroundImage + i), r.backgroundSize && (t["background-size"] = r.backgroundSize + i), r.backgroundAttachment && (t["background-attachment"] = r.backgroundAttachment + i), e.removeAttr("style"), TVE.SKIP_CSS_STATE = !0, e.head_css(t), TVE.SKIP_CSS_STATE = !1
                                            }
                                        }(TVE.ActiveElement)
                                    }), TVE.add_filter("tcb_save_post_data_before", function (e) {
                                        var t, r = TVE.CONST.tve_globals;
                                        return (t = TVE.inner.$body.attr("data-css")) && (r.body_css = t, delete r.lp_bg, delete r.lp_bgi, delete r.lp_bgp, delete r.lp_bga), e
                                    })
                                },
                                manual_refresh_components: function (e, t) {
                                    void 0 === e && (e = TVE.ActiveElement), TVE.state_manager.is_default() && (TVE.FLAGS.hover_element = !0, e.addClass("tve-state-hover"), TVE.main.update_components(t), TVE.FLAGS.hover_element = !1, e.removeClass("tve-state-hover")), TVE.main.update_components(t)
                                },
                                is_page_full_width: function () {
                                    return TVE.apply_filters("is_section_full_width", TVE.CONST.landing_page && "none" === TVE.Editor_Page.editor.css("max-width"))
                                }
                            }
                        }, "editor.js": function (e, t, r) {
                            var i;
                            i = jQuery, window.parent && (window.parent.child_context = window, function e() {
                                if (!window.parent.TVE || !window.parent.TCB_READY) return setTimeout(e, 100);
                                window.TVE = window.parent.TVE, TVE.inner = {
                                    window: window,
                                    document: document,
                                    jQuery: i,
                                    $window: i(window),
                                    $document: i(document)
                                }, i.extend(TVE, r("./util/general")), TVE.froala = r("./util/froala"), TVE.inner_$ = i, TVE.compat = r("./compat"), TVE.drag = r("./drag"), TVE.Editor_Page = r("./editor-page"), TVE.landing_fonts = r("./util/landing-fonts"), TVE.plugins = {table: r("./util/table/editor")}, i.extend(!0, TVE.CONST, tve_path_params), r("./util/jquery-plugins"), TVE.inner.$window.trigger("editor-included"), i(function () {
                                    TVE.inner.$body = i("body"), TVE.Editor_Page.onDOMReady(), TVE.inner.$window.trigger("tcb-ready"), TVE.main.trigger("tcb-ready"), TVE.do_action("tcb-ready")
                                })
                            }());
                            window.custom_font_classes = "", window.extra_font_classes = "", jQuery.each(tve_path_params.custom_fonts, function () {
                                custom_font_classes += (custom_font_classes ? " " : "") + this.font_class
                            }), window.TVE && TVE.CONST && TVE.CONST.tve_globals.extra_fonts && jQuery.each(TVE.CONST.tve_globals.extra_fonts, function () {
                                extra_font_classes += (extra_font_classes ? " " : "") + this.font_class
                            }), jQuery.fn.extend({
                                tve_color_selector: function (e) {
                                    return void 0 !== e ? e ? this.attr("data-tve-custom-colour", e) : this.removeAttr("data-tve-custom-colour") : this.attr("data-tve-custom-colour")
                                }, tve_countdown_timer: function () {
                                    var o = this, l = function (e, t) {
                                        if (e.empty(), t <= 99) e.prepend('<span class="part-1">' + t % 10 + "</span>"), e.prepend('<span class="part-2">' + Math.floor(t / 10) + "</span>"); else for (var r = 0; t;) r++, e.prepend('<span class="part-' + r + '">' + t % 10 + "</span>"), t = Math.floor(t / 10)
                                    };
                                    return {
                                        set: function (e, t) {
                                            o.attr("data-" + e, t), this.update()
                                        }, get: function (e) {
                                            return "_all" == e ? this.get("date") + "T" + this.get("hour") + ":" + this.get("min") + ":00" + this.get("timezone") : o.attr("data-" + e)
                                        }, update: function () {
                                            var e = new Date, t = new Date(this.get("_all"));
                                            o.find(".tve_t_text").hide().html(this.get("text")), o.find(".tve_t_part").show();
                                            var r, i = 0, n = 0, a = 0, s = 0;
                                            e < t && (i = Math.floor((t.getTime() - e.getTime()) / 1e3), n = Math.floor(i / 60), a = Math.floor(n / 60), s = Math.floor(a / 24), r = 2, i %= 60, n %= 60, a %= 24, 99 < s && (r = s.toString().length)), l(o.find(".tve_t_sec .t-digits"), i), l(o.find(".tve_t_min .t-digits"), n), l(o.find(".tve_t_hour .t-digits"), a), l(o.find(".tve_t_day .t-digits"), s), e < t && !o.data("dd") ? o.find(".tve_t_day .t-digits").css("min-width", r * o.find(".tve_t_sec .t-digits > span").first().outerWidth() + "px") : o.find(".tve_t_day .t-digits").css("min-width", "")
                                        }, align: function (e) {
                                            var t = o.children(".sc_timer_content");
                                            switch (t.css("margin-top", t.css("margin-top")), t.css("margin-bottom", t.css("margin-bottom")), e) {
                                                case"left":
                                                    t.removeClass("alignleft alignright aligncenter").addClass("alignleft");
                                                    break;
                                                case"center":
                                                    t.removeClass("alignleft alignright").addClass("tve_block_center");
                                                    break;
                                                case"right":
                                                    t.removeClass("alignleft alignright aligncenter").addClass("alignright");
                                                    break;
                                                case"none":
                                                    t.removeClass("alignleft alignright aligncenter").css("width", "auto")
                                            }
                                        }
                                    }
                                }, tve_countdown_timer_evergreen: function () {
                                    var o = jQuery(this), e = o.tve_countdown_timer(), l = function (e, t) {
                                        if (e.empty(), t <= 99) e.prepend('<span class="part-1">' + t % 10 + "</span>"), e.prepend('<span class="part-2">' + Math.floor(t / 10) + "</span>"); else for (var r = 0; t;) r++, e.prepend('<span class="part-' + r + '">' + t % 10 + "</span>"), t = Math.floor(t / 10)
                                    };
                                    return e.update = function () {
                                        var e = new Date, t = new Date;
                                        t.setTime(e.getTime() + 24 * parseInt(this.get("day")) * 3600 * 1e3 + 3600 * parseInt(this.get("hour")) * 1e3 + 60 * parseInt(this.get("min")) * 1e3 + 1e3 * parseInt(this.get("sec"))), o.find(".tve_t_text").hide().html(this.get("text")), o.find(".tve_t_part").show(), o.attr("data-id", "undefined" != typeof _ ? _.uniqueId("evergreen_") : "evergreen_" + parseInt(1e4 * Math.random()));
                                        var r, i = 0, n = 0, a = 0, s = 0;
                                        return e < t && (i = Math.floor((t.getTime() - e.getTime()) / 1e3), n = Math.floor(i / 60), a = Math.floor(n / 60), s = Math.floor(a / 24), r = 2, i %= 60, n %= 60, a %= 24, 99 < s && (r = s.toString().length)), l(o.find(".tve_t_sec .t-digits"), i), l(o.find(".tve_t_min .t-digits"), n), l(o.find(".tve_t_hour .t-digits"), a), l(o.find(".tve_t_day .t-digits"), s), e < t ? o.find(".tve_t_day .t-digits").css("min-width", r * o.find(".tve_t_sec .t-digits > span").first().outerWidth() + "px") : o.find(".tve_t_day .t-digits").css("min-width", ""), this
                                    }, e
                                }
                            })
                        }, util: {
                            "content.js": function (e, t, r) {
                                var T;
                                T = jQuery, t.exports = {
                                    TCB_CLS_PAT: ["thrv_", "tve-", "tve_", "tcb_", "tcb-", "thrv-", "img_style_", "mce-", "fr-", "ttfm"],
                                    cleanup_froala: function (e) {
                                        e.find(".tve-froala").each(function () {
                                            var e = T(this);
                                            if (!e.find(".tve-froala").length) {
                                                var t = e.find(".fr-element").last();
                                                if (t.length || (t = e.next(".fr-wrapper").find(".fr-element")), t.length && (e.html(t.html()).removeClass(function (e, t) {
                                                        return (t.match(/(^|\s)(fr-|tve-froal)\S+/g) || []).join(" ")
                                                    }), e.is("p") && (t.remove(), e.siblings(".fr-wrapper:empty, p:empty").remove())), e.is("p.wp-caption-text")) {
                                                    var r = e.children("div");
                                                    r.length || (r = e.next("div")), r.length && (r.attr("style") && e.attr("style", r.attr("style")), e.html(r.html()), r.remove())
                                                }
                                            }
                                        }), e.find(".fr-wrapper").each(function () {
                                            var e = T(this), t = e.children(".fr-element");
                                            T(this).replaceWith(t.length ? t.html() : e.html())
                                        })
                                    },
                                    get_stripped_content: function (e) {
                                        return e ? (e.find(".thrv_countdown_timer, .thrv-credit, .thrv-google-map-embedded-code, .thrv_disqus_comments, .tcb-post-list,.thrv_widget_menu, .thrv-fill-counter, .thrv_tw_qs, .thrv_social, .thrv_post_grid, .thrv-progress-bar, .thrv-rating, .thrv_contents_table, .thrv_responsive_video, .thrive_leads_shortcode, .thrive-quiz-builder-shortcode, .thrv_responsive_video, .thrv-button, .tve_more_tag, .thrv_lead_generation").remove(), e.html()) : ""
                                    },
                                    get_clean_content: function (e, t) {
                                        void 0 === e && (e = {}), t = t || TVE.Editor_Page.editor;
                                        var r = T("#pre-save-filter");
                                        r.length || (r = T('<div style="display:none" id="pre-save-filter"></div>').appendTo("body")), r.empty();
                                        var i = t.children(".tve_content_save").length ? t.children(".tve_content_save") : t;
                                        return r.html(i.html().replace(/<script type="text\/javascript">/g, '<script type="tcb/temp">')), e.keep_wp_shortcodes || r.find(".tve_shortcode_rendered").remove(), r.find(".tcb-remove-on-save, .ui-resizable-handle, .ui-resize-left, .ui-resize-right, .thrive-symbol-shortcode, .thrive-shortcode-html:not(.tve-custom-menu-type), grammarly-btn,.tve_custom_html_placeholder,.tve_dropzone,.rangySelectionBoundary, .tve_shortcode_overlay,.tve_shortcode_rendered script, .tcb-remove-on-save, .tve_post_grid_wrapper,.tve_widget_container,.gr-textarea-btn_status,.gr-textarea-btn, .tve-remove-auxiliary-content, .thrv_symbol.tcb-elem-placeholder").remove().end().find(".canvas-mode, .thrv_symbol, .edit_mode, .tve_merge_cells, .tve_merge_selected, .tve_active_hyperlink, .active_highlight, .active_delete, .active_duplicate, .tcb_bring_front").removeClass("edit_mode tve_merge_cells tve_merge_selected, tve_active_hyperlink active_highlight active_delete active_duplicate canvas-mode tve-element-overlay tcb_bring_front symbol-edit-mode").end().find(".tve_toggle_open").removeClass("tve_toggle_open").end().find(".tve_toggle_open_text").removeClass("tve_toggle_open_text").end().find(".tve_faqC").hide().end().find(".tve_oFaq").removeClass("tve_oFaq").end().find(".ui-resizable,.init_done,.ui-sortable,.ui-sortable-handle,.tve-draggable,.tve-droppable").removeClass("ui-resizable init_done ui-sortable ui-sortable-handle tve-draggable tve_grabbed tve-droppable").end().find("[contenteditable]").removeAttr("contenteditable").end().find("[draggable]").removeAttr("draggable").end().find("[data-gramm]").removeAttr("data-gramm data-gramm_id data-gramm_editor").filter(":empty").remove().end().end().find(".tve-state-hover,.tve-state-active").removeClass("tve-state-hover").end().find(".tve-m-expanded").removeClass("tve-m-expanded").end().find(".on_hover").removeClass("on_hover").end().find(".tve-triggered-icon").removeClass("tve-triggered-icon").end().find(".thrv_widget_menu").removeClass("tve-custom-menu-switch-icon-tablet tve-custom-menu-switch-icon-mobile").end().find(".expand-children").removeClass("expand-children").end().find('[data-css=""]').removeAttr("data-css").end().find(".tcb-mp").css("z-index", "").removeClass("tcb-mp").end().find("p").each(function () {
                                            void 0 !== this.className && 0 === this.className.toString().length && this.removeAttribute("class")
                                        }), this.cleanup_froala(r), r.find(".tve_more_tag").replaceWith('\x3c!--tvemorestart--\x3e<p class="tve_more_tag" id="more-' + TVE.CONST.post.ID + '"><span class="tve_no_edit">More...</span></p>\x3c!--tvemoreend--\x3e'), r.find("iframe.tcb-yt-bg").each(function () {
                                            T(this).replaceWith(T('<div id="' + this.id + '" class="tcb-yt-bg" data-url="' + this.getAttribute("data-url") + '" data-yt-id="' + this.getAttribute("data-yt-id") + '"></div>'))
                                        }), r.find(".tcb-replaceable-placeholder").each(function () {
                                            var e = T(this);
                                            e.parent().hasClass("tcb-parent-placeholder-empty") || e.remove()
                                        }), r.find("video > source").each(function (e, t) {
                                            t.getAttribute("type") && -1 !== t.getAttribute("type").indexOf("quicktime") && t.removeAttribute("type")
                                        }), (r = TVE.apply_filters("tcb_filter_html_before_save", r, t)).find("a[data-tcb-href]").each(function () {
                                            this.setAttribute("href", this.getAttribute("data-tcb-href"))
                                        }), this.stripped_content = this.get_stripped_content(r.clone()), r.html().replace(/<script type="tcb\/temp">/g, '<script type="text/javascript">')
                                    },
                                    get_stylesheet_rules: function () {
                                        var i,
                                            e = TVE.stylesheet.cssRules ? TVE.stylesheet.cssRules : TVE.stylesheet.rules,
                                            t = "", n = [], r = "", a = [], s = / (p|h1|h2|h3)$/,
                                            o = [".thrv_widget_menu"];

                                        function l(e, t) {
                                            t = t || "";
                                            var r = "";
                                            if (i = e.selectorText.replace(/(:hover|:active|:after|:focus|::after|:before|::before|::placeholder| strong)/g, ""), -1 !== n.indexOf(t + e.selectorText)) return "";
                                            if (function (e, t) {
                                                    for (var r, i = 0; r = o[i++];) if (-1 !== e.indexOf(r)) return !1;
                                                    return -1 === e.indexOf("data-css") && -1 === e.indexOf("data-tve-custom-colour") || !(!e.match(s) || -1 === t.indexOf("margin")) && jQuery(e.replace(s, "")).length
                                                }(i, e.cssText) || jQuery(i).length) {
                                                if (!jQuery.trim(e.cssText.replace(e.selectorText, "").replace(/\{(\s*)\}/g, ""))) return "";
                                                r += e.cssText, n.push(t + e.selectorText)
                                            }
                                            return r
                                        }

                                        for (var c = (e = TVE.apply_filters("tcb_css_rules_before", e)).length - 1; 0 <= c; c--) {
                                            var d = e[c];
                                            if (d.type !== CSSRule.IMPORT_RULE) if (d.type !== CSSRule.MEDIA_RULE) t = l(d) + t; else {
                                                r = "";
                                                for (var _, h = 0; _ = d.cssRules[h++];) r += l(_, d.media.item(0));
                                                r && (t = "@media " + d.media.item(0) + "{" + r + "}" + t)
                                            } else {
                                                var v = TVE.FontManager.read_font_name(d.cssText);
                                                TVE.FontManager.is_font_used(v, t) && void 0 === a[v] && (a[v] = 1, t = d.cssText + t)
                                            }
                                        }
                                        return t
                                    },
                                    get_global_rules: function (e) {
                                        var t = TVE.globalsheet.cssRules ? TVE.globalsheet.cssRules : TVE.globalsheet.rules,
                                            r = {}, i = [], n = [], a = TVE.CSS_Rule_Cache.getImports();

                                        function s(e, t) {
                                            t = t || "";
                                            var r = "";
                                            return e.selectorText.replace(/(:hover|:active|:after|:focus|::after|:before|::before|::placeholder| strong)/g, ""), -1 !== n.indexOf(t + e.selectorText) ? "" : jQuery.trim(e.cssText.replace(e.selectorText, "").replace(/\{(\s*)\}/g, "")) ? (r += e.cssText, n.push(t + e.selectorText), r) : ""
                                        }

                                        for (var o = 0; o < t.length; o++) {
                                            var l = t[o];
                                            if (l.type === CSSRule.MEDIA_RULE) for (var c, d = 0; c = l.cssRules[d++];) {
                                                var _ = s(c, l.media.item(0));
                                                if (!(0 < e.length && -1 < _.indexOf("tve-state-hover"))) {
                                                    if (-1 < _.indexOf(TVE.CONST.global_cls_prefix)) {
                                                        if (!_.match(e)) continue;
                                                        r[l.media.item(0)] || (r[l.media.item(0)] = []), r[l.media.item(0)].push(_)
                                                    }
                                                    if (c.style.getPropertyValue("font-family").length) {
                                                        var h = c.style.getPropertyValue("font-family").replace(/['"]+/g, "").trim();
                                                        if (!1 === TVE.FontManager.is_web_safe_font(h)) for (var v = 0; v < a.length; v++) -1 < a[v].indexOf(h.replace(/ /g, "+")) && -1 === i.indexOf(a[v]) && i.push(a[v])
                                                    }
                                                }
                                            }
                                        }
                                        return {css: r, fonts: i}
                                    },
                                    refresh_global_style_node: function () {
                                        var i = "", e = this.get_global_rules("");
                                        T.each(e.fonts, function (e, t) {
                                            i += t
                                        }), T.each(e.css, function (e, t) {
                                            i += "@media " + e + "{";
                                            for (var r = 0; r < t.length; r++) i += t[r].replace(/#tve_editor/g, "");
                                            i += "}"
                                        }), TVE.inner_$(".tve_global_style").html(i)
                                    },
                                    parse_element_classes: function (e) {
                                        var t = new RegExp(this.TCB_CLS_PAT.join("([^ ]*)|") + "([^ ]*)|" + TVE.thrv_custom_classes.join("|"), "g");
                                        return e ? T.trim(e.replace(t, "").replace("/S+/g", " ")) : ""
                                    },
                                    is_wp_content_tinymce_available: function () {
                                        return "undefined" != typeof tinymce && tinymce && tinymce.activeEditor && "tve_tinymce_shortcode" === tinymce.activeEditor.id && !tinymce.activeEditor.isHidden()
                                    },
                                    get_shotcode_tinymce_content: function () {
                                        if (!this.is_wp_content_tinymce_available()) {
                                            var e = jQuery("#tve_tinymce_shortcode").val();
                                            return wp && wp.editor && wp.editor.autop && (e = wp.editor.autop(e)), e
                                        }
                                        return tinymce.activeEditor.getContent()
                                    },
                                    set_shotcode_tinymce_content: function (e) {
                                        this.is_wp_content_tinymce_available() ? tinymce.activeEditor.setContent(e) : jQuery("#tve_tinymce_shortcode").val(e)
                                    },
                                    convert_script_tags: function (e) {
                                        e = e.replace("<\\/script", "<\\\\/script");
                                        var t = jQuery('<div class="tve_escaped_js">' + e + "</div>");
                                        return 0 === t.find("script").length && 0 === t.find("noscript") || (t.find("script").each(function () {
                                            var e = jQuery(this), t = "[tcb-script",
                                                r = jQuery('<code class="tve_js_placeholder"></code>');
                                            jQuery.each(this.attributes, function () {
                                                t += " " + this.name + '="' + this.value + '"'
                                            }), t += "]" + e.text() + "[/tcb-script]", r.text(t), e.replaceWith(r)
                                        }), t.find("noscript").each(function () {
                                            var e = jQuery(this), t = "[tcb-noscript",
                                                r = jQuery('<code class="tve_js_placeholder tve_noscript"></code>');
                                            jQuery.each(this.attributes, function () {
                                                t += " " + this.name + '="' + this.value + '"'
                                            }), t += "]" + e.text() + "[/tcb-noscript]", r.html(t), e.replaceWith(r)
                                        })), t.html()
                                    },
                                    revert_script_tags: function (e) {
                                        if (!jQuery.trim(e)) return "";
                                        var t = jQuery('<div class="tve_escaped_js">' + e + "</div>");
                                        return t.find(".tve_custom_html_placeholder,.tve_click").remove(), t.find(".tve_shortcode_overlay").remove(), 0 === t.find("code.tve_js_placeholder").length || t.find("code.tve_js_placeholder").each(function () {
                                            var e, t = jQuery(this),
                                                r = new RegExp("^\\[tcb-script([^\\]]*?)\\]([\\s\\S]*?)\\[/tcb-script\\]$", "g");
                                            e = t.find("script").length ? t.html() : t[t.hasClass("tve_noscript") ? "html" : "text"]().replace(r, "<script$1>$2<\/script>");
                                            var i = new RegExp("^\\[tcb-noscript([^\\]]*?)\\]([\\s\\S]*?)\\[/tcb-noscript\\]$", "g");
                                            e = e.replace(i, "<noscript$1>$2</noscript>"), t.hasClass("tve_noscript") && (e = jQuery("<textarea>").html(e).text());
                                            var n = jQuery(e);
                                            n.removeAttr("class className"), t.replaceWith(n)
                                        }), jQuery.trim(t.html())
                                    },
                                    prepare_save_data: function (e, t) {
                                        var r = this.get_clean_content({}, this.editor),
                                            i = this.get_stylesheet_rules(), n = {
                                                tve_content: r,
                                                tve_stripped_content: this.stripped_content,
                                                post_id: TVE.CONST.post_id,
                                                update: e,
                                                inline_rules: i,
                                                tve_custom_css: TVE.Editor_Page.get_custom_css(),
                                                tve_landing_page: TVE.CONST.landing_page ? TVE.CONST.landing_page : "",
                                                custom_font_classes: [],
                                                tve_globals: {},
                                                tve_global_scripts: TVE.CONST.tve_global_scripts ? TVE.CONST.tve_global_scripts : {},
                                                has_icons: 0,
                                                page_events: TVE.CONST.page_events
                                            };
                                        n = TVE.apply_filters("tcb_save_post_data_before", n), TVE.CONST.custom_post_data && T.each(TVE.CONST.custom_post_data, function (e, t) {
                                            n[e] = t
                                        }), TVE.CONST.tve_globals.js_sdk = [], TVE.Editor_Page.editor.find(".thrv_social").each(function () {
                                            TVE.CONST.tve_globals.js_sdk = TVE.CONST.tve_globals.js_sdk.concat(T(this).tve_social().getRequiredSDKs())
                                        }), TVE.CONST.social_fb_app_id && (n.social_fb_app_id = TVE.CONST.social_fb_app_id), 0 < TVE.Editor_Page.editor.find(".tve-fb-comments").length && -1 === TVE.CONST.tve_globals.js_sdk.indexOf("fb") && TVE.CONST.tve_globals.js_sdk.push("fb"), T.each(TVE.CONST.tve_globals, function (e, t) {
                                            e && (n.tve_globals[e] = t)
                                        }), custom_font_classes && T.each(custom_font_classes.split(" "), function (e, t) {
                                            (TVE.Editor_Page.editor.find("." + t).length || TVE.landing_fonts && TVE.landing_fonts.fontUsed(t)) && n.custom_font_classes.push(t)
                                        }), n.tve_globals.extra_fonts && T.each(n.tve_globals.extra_fonts, function (e, t) {
                                            TVE.Editor_Page.editor.find("." + t.font_class).length || TVE.landing_fonts && TVE.landing_fonts.fontUsed(t.font_class) ? t.ignore = 0 : t.ignore = 1
                                        }), void 0 !== t && T.each(t, function (e, t) {
                                            n[e] = t
                                        });
                                        var a = jQuery(".tve_sc_icon:not(.tve_sc_text)"), s = jQuery();
                                        if (n.tve_globals.used_icon_packs = [], a.length) {
                                            var o = [];
                                            if (TVE.CONST.tve_globals.extra_icons) for (var l, c = 0; l = TVE.CONST.tve_globals.extra_icons[c++];) if (l.icons && l.icons.length) {
                                                var d = a.filter("." + l.icons.join(",."));
                                                d.length && n.tve_globals.used_icon_packs.push(l["font-family"]), s = s.add(d), d.each(function () {
                                                    o.push(this.dataset.tveIcon)
                                                }), TVE.CONST.tve_globals.extra_icons[c - 1].icons = o
                                            }
                                            n.has_icons = a.length != s.length ? 1 : 0
                                        }
                                        var _ = T(".tve-fb-comments:visible");
                                        if (0 < _.length) {
                                            var h = _.attr("data-fb-moderator-ids");
                                            void 0 !== h && "" != h && (n.tve_globals.fb_comment_admins = JSON.stringify(h.split(";")))
                                        }
                                        return T(".tve_post_grid_masonry").length && (n.tve_has_masonry = 1), T(".tve_typefocus").length && (n.tve_has_typefocus = 1), (T(".tve_wistia_popover:visible").length || T(".tve_ea_thrive_wistia").length) && (n.tve_has_wistia_popover = 1), n = TVE.apply_filters("tcb_save_post_data_after", n)
                                    },
                                    process_saved_template: function (e, t, r, i, c) {
                                        var n = 5 < arguments.length && void 0 !== arguments[5] ? arguments[5] : "";
                                        if (t.find(".edit_mode").removeClass("edit_mode"), t.find(".tve_sc_icon").length && !jQuery("#thrive_icon_pack").length && TVE.CONST.icon_pack_css && jQuery('<link id="thrive_icon_pack" rel="stylesheet" type="text/css" href="' + TVE.CONST.icon_pack_css + '">').appendTo("head"), !jQuery.trim(e) && !r) return t;
                                        var a, s, o = t.wrapAll("<div></div>").parent();
                                        if (e = jQuery.trim(e)) for (var l = e.match(/[^{}]+(?=\})/g), d = e.match(/\[(.*?)\]([^\{]*)/g), _ = {}, h = d ? d.length : 0, v = 0; v < h; v++) {
                                            var u = d[v].match(/\[data-tve-custom-colour=([^0-9]{1,1})(\d+)('|")\]/);
                                            if (u && !(u.length < 3)) {
                                                var f = void 0 !== _["code" + u[2]] ? _["code" + u[2]] : (a = o.find('[data-tve-custom-colour="' + u[2] + '"]'), s = Math.floor(1e8 * Math.random() + 1), a.attr("data-tve-custom-colour", s), s),
                                                    p = d[v].replace(u[2], f);
                                                TVE.compat.insert_css_rule(p, l[v], TVE.stylesheet.cssRules.length), _["code" + u[2]] = f
                                            }
                                        }
                                        if (i && jQuery.each(i, function (e, t) {
                                                TVE.stylesheet.insertRule(t)
                                            }), r) {
                                            var g = function (e, t, r, i) {
                                                if (e === TVE.main.responsive.desktop.media && -1 !== t.indexOf(":hover")) {
                                                    var n = t.split(",").map(function (e) {
                                                        var t = e.replace(/^([^:]+):hover/g, "$1.tve-state-hover");
                                                        return t === e && (t = e.replace(/(\s+)([^:]+):hover/g, "$1.tve-state-hover$2")), t === e && (t = e.replace(/:hover/g, ".tve-state-hover")), t
                                                    }).join(",");
                                                    r.insertRule(n + i + "}", r.cssRules.length)
                                                }
                                            }, m = {};
                                            jQuery.each(r, function (n, e) {
                                                var a = (e = e.replace(/data-css='(.+?)'/g, 'data-css="$1"')).match(/[^{}]+(?=\})/g),
                                                    t = e.match(/([^\r\n{}]+)(,(?=[^}]*{)|\s*){/g);
                                                if (!a || !t || a.length !== t.length) return !0;
                                                var s = TVE.CSS_Rule_Cache.media_rule(n), o = void 0;
                                                t = t.map(jQuery.trim), a = a.map(jQuery.trim);
                                                for (var l, r = function (r, i) {
                                                    if (!a[i]) return "break";
                                                    r.includes("data-css=") || (r = TVE.apply_filters("tcb.content_selector_prefix", r), s.style_by_selector(r.replace("{", "").trim(), !1) || (s.insertRule(r + a[i] + "}", s.cssRules.length), g(n, r, s, a[i])));
                                                    var e = r.match(/tve-u-(.[^ "]*)/g);
                                                    T.each(e, function (e, t) {
                                                        m[o = t] = m[o] || TVE.CSS_Rule_Cache.generate_id(), r = r.replace(new RegExp("(" + o + ")", "g"), m[o]), r = jQuery.trim(r), r = TVE.apply_filters("tcb.content_selector_prefix", r), c && TVE.hasHeadCss(r.replace("{", "").trim(), !0, n) || (s.insertRule(r + a[i] + "}", s.cssRules.length), g(n, r, s, a[i]))
                                                    }), l = r
                                                }, i = 0; (l = t[i]) && "break" !== r(l, i); i++) ;
                                            }), T.each(m, function (e, t) {
                                                o.find('[data-css="' + e + '"]').attr("data-css", t), n = n.replace(new RegExp("(" + e + ")", "g"), t)
                                            })
                                        }
                                        if (0 < n.length) {
                                            var E = n.split("}");
                                            T.each(E, function (e, t) {
                                                0 < t.length && TVE.stylesheet.insertRule(t + "}", TVE.stylesheet.cssRules.length)
                                            })
                                        }
                                        return o.find(".thrv_widget_menu").each(function () {
                                            var e = T(this),
                                                t = TVE.Editor_Page.thriveShrtcodeConfig(e.find(".thrive-shortcode-config"), "widget_menu"),
                                                r = t.get();
                                            void 0 !== _ && T.each(["ul_attr", "top_link_attr", "link_attr", "trigger_attr"], function (e, t) {
                                                r[t] && _["code" + r[t]] && (r[t] = _["code" + r[t]])
                                            }), "undefined" != typeof id_map && r.head_css && id_map[r.head_css] && (r.head_css = id_map[r.head_css]), t.save(r)
                                        }), TVE.compat.texts(o), o.html()
                                    },
                                    insert_head_css: function (e, c) {
                                        var d = T('<style type="text/css"></style>').text(e).appendTo("head"),
                                            _ = TVE.ActiveElement ? TVE.ActiveElement.closest(".thrv_symbol") : T(),
                                            h = T.Deferred();
                                        return d[0].onload = function () {
                                            for (var e = TVE.apply_filters("css_rules_before_insert", d[0].sheet.cssRules, _), t = 0; t < e.length; t++) switch (e[t].type) {
                                                case CSSRule.IMPORT_RULE:
                                                    TVE.stylesheet.insertRule(e[t].cssText, 0);
                                                    break;
                                                case CSSRule.MEDIA_RULE:
                                                    for (var r = TVE.compat.conditionText(e[t]), i = TVE.CSS_Rule_Cache.media_rule(r), n = null, a = r === TVE.main.responsive.desktop.media, s = 0; s < e[t].cssRules.length; s++) {
                                                        var o = e[t].cssRules[s], l = null;
                                                        null !== (n = i.rule_index_by_selector(o.selectorText)) && i.deleteRule(n), i.insertRule(o.cssText, i.cssRules.length), a && null !== (l = TVE.CSS_Rule_Cache.generate_hover_state_css(o)) && i.insertRule(l, i.cssRules.length)
                                                    }
                                                    break;
                                                case CSSRule.STYLE_RULE:
                                                default:
                                                    TVE.stylesheet.insertRule(e[t].cssText, TVE.stylesheet.cssRules.length)
                                            }
                                            "function" == typeof c && c(d[0]), h.resolve(d[0]), d.remove()
                                        }, h.promise()
                                    },
                                    prepare_content_for_editor: function (e) {
                                        (e = e || TVE.inner_$("body")).find(".thrv_custom_html_shortcode").each(function () {
                                            var e = TVE.inner_$(this);
                                            e.height() <= 10 && 0 === e.find("img").length ? e.append('<div class="tve_shortcode_overlay"><span>No preview available.</span></div>') : e.find("iframe").length && e.append('<div class="tve_iframe_cover"></div>')
                                        })
                                    }
                                }
                            }, "froala.js": function (e, n, a) {
                                !function (c) {
                                    var d;
                                    TVE.TEXT_INLINE = ".tve_fg h1, .tve_fg h3, .tve_ca h3, .tve_ca h1, .tve_ca .tve_btnLink span, .tve_ts span, .tve_ct_title,.thrv_tw_quote p, .thrv_widget_menu .tve_menu_title, .wp-caption-text, .tve_btn_txt, .tve_btn_sec_txt, .tve_fg > .tve_line > h3, .tve_scT > ul > li > span, .tve_faqB h4, .thrv-inline-text, .thrv-advanced-inline-text,.tve_submit_container button, .thrv_tw_qs_button_text", TVE.TEXT_WITH_LINK = ".tcb-styled-list-icon-text, .tcb-numbered-list-text, .tcb-lg-consent .thrv-inline-text", TVE.TEXT_RAW = ".thrv_wrapper.thrv-plain-text", TVE.TEXT_HEADINGS = ".thrv_wrapper.thrv_heading", TVE.TEXT_BLOCK = ".thrv_wrapper.thrv_text_element", TVE.BLOCK_ELEMENTS = "h1,h2,h3,h4,h5,h6,p,address,blockquote,li,.thrv-inline-text,.thrv-advanced-inline-text,a,.tcb-plain-text";
                                    var i = a("./selectors"), h = {maintain_focus: !1},
                                        e = TVE.TEXT_ALL = TVE.TEXT_INLINE + "," + TVE.TEXT_RAW + "," + TVE.TEXT_HEADINGS + "," + TVE.TEXT_BLOCK,
                                        v = {
                                            default: ["bold", "italic", "underline", "strikeThrough", "paragraphFormat", "align-left", "align-center", "align-right", "align-justify", "formatUL", "formatOL", "tcbLink", "shortcode"],
                                            inline: ["bold", "italic", "underline", "strikeThrough"],
                                            raw: ["bold", "italic", "underline", "strikeThrough", "align-left", "align-center", "align-right", "align-justify", "tcbLink", "shortcode"],
                                            with_link: ["bold", "italic", "underline", "strikeThrough", "tcbLink", "shortcode", "align-left", "align-center", "align-right", "align-justify"]
                                        }, t = {};

                                    function u(e) {
                                        return c.proxy(t[e], t)
                                    }

                                    function r(e) {
                                        return e.find(".thrive-shortcode-content").attr("contenteditable", !1).wrap('<span class="thrive-inline-shortcode" contenteditable="false"></span>'), e
                                    }

                                    TVE.main.on("device_hide_element", function (e) {
                                        h.editor && h.editor.$tb && TVE.main.device.toLowerCase() === e.toLowerCase() && h.editor.$tb.hide()
                                    }), TVE.main.on("device_change", function () {
                                        TVE.ActiveElement && TVE.ActiveElement.is(TVE.TEXT_ALL) && !TVE.ActiveElement.is(":visible") && h.hide_toolbars()
                                    }), t.focus = function (e, t) {
                                        var r = (h.editor = t).$oel.is(TVE.TEXT_BLOCK + ",.thrv-inline-text,.thrv-advanced-inline-text," + TVE.TEXT_HEADINGS) ? t.$oel : t.$oel.closest(i.editable);
                                        t.$tb && t.$tb.show(), requestAnimationFrame(function () {
                                            r.hasClass("edit_mode") || (h.force_show_toolbar = !0, TVE.Editor_Page.focus_element(r), delete h.force_show_toolbar)
                                        })
                                    }, t.refresh = TVE._.debounce(function () {
                                        h.editor && TVE.main.update_components(["text", "click-tweet", "shadow", "animation"])
                                    }, 10), t.paste_afterCleanup = function (e, t, r) {
                                        return e.currentTarget.classList.contains("thrv-plain-text") && (r = '<div class="tcb-plain-text"> ' + t.clean.html(r, ["a", "p", "div", "span", "pre", "blockquote", "h1", "h2", "h3", "h4", "h5", "h6"], t.opts.pasteDeniedAttrs) + "</div>"), r
                                    }, t.paste_after = function (e, t) {
                                        e.currentTarget.classList.contains("thrv-plain-text") && t.$el.find("div").addClass("tcb-plain-text")
                                    }, t.commands_after = function (e, t, r, i, n) {
                                        switch (r) {
                                            case"paragraphFormat":
                                                t.$oel.is(TVE.TEXT_HEADINGS) && t.$oel.attr("data-tag", i.toLowerCase()), TVE.is_group_editing && (TVE.ActiveElement = TVE.ActiveElement.filter(".edit_mode")), TVE.Components.text.clear_formatting(), TVE.ActiveElement = TVE.ClickedElement;
                                                break;
                                            case"tcbParagraph":
                                                TVE.Components.text.clear_formatting()
                                        }
                                    }, t.blur = function (e, t) {
                                        TVE.do_action("tcb.froala.blur", e, t)
                                    }, t.undo_save_step = function (e, t) {
                                        TVE.UndoManager.add({
                                            undo: function () {
                                                return t && 1 < t.undo_index ? (t.events.focus(), t.undo.run()) : "_EXECUTE_NEXT_"
                                            }, redo: function () {
                                                return t && t.undo_index < t.undo_stack.length ? (t.events.focus(), t.undo.redo()) : "_EXECUTE_NEXT_"
                                            }
                                        })
                                    }, t.keydown = function (e, t, r) {
                                        if (r.keyCode === c.FE.KEYCODE.ENTER && (t.keys.ctrlKey(r) && !r.shiftKey ? TVE.main.trigger("ctrl-enter-pressed", r) : TVE.main.trigger("enter-pressed", r)), r.keyCode === c.FE.KEYCODE.BACKSPACE && TVE.main.trigger("backspace-pressed", r), r.keyCode === c.FE.KEYCODE.DELETE && TVE.main.trigger("delete-pressed", r), r.keyCode === c.FE.KEYCODE.TAB) {
                                            var i = TVE.inner_$(r.target);
                                            i.closest(".tve_table_cell").length && (TVE.do_action("tab-pressed", i), r.preventDefault(), r.stopPropagation())
                                        }
                                    }, t.tcb_before_delete = function (e) {
                                        TVE.main.trigger("before-delete-pressed", e)
                                    }, t.lnk_popup_show = function (e, t) {
                                        setTimeout(function () {
                                            t.popups.get("tcbLink.insert").find('.fr-link-attr[name="href"]').focus()
                                        }, 50)
                                    }, t.click = function (e, t, r) {
                                        return r.preventDefault(), !1
                                    }, h.init = function () {
                                        d = TVE.$("#main-fr-toolbar");
                                        try {
                                            localStorage.FEK = "cSXSE1LHAFJVCXCLS=="
                                        } catch (e) {
                                        }
                                        delete c.FE.SHORTCUTS_MAP[c.FE.KEYCODE.S];
                                        var l = TVE.apply_filters("tcb_froala_config", {});
                                        TVE.Editor_Page.editor.off("mouseenter.froala-editor").on("mouseenter.froala-editor", e, function (e) {
                                            var n = c(e.currentTarget);
                                            if (!0 !== TVE.apply_filters("tcb.froala.non_editable", !1, n)) {
                                                if (n.data("froala.editor")) return n;
                                                n.off("click").on("click", function (e) {
                                                    e.preventDefault()
                                                }).off("mousedown.prevent froala-focus").on("mousedown.prevent froala-focus", function (e) {
                                                    return !e.currentTarget.classList.contains("edit_mode") && h.editor && (h.editor.events.enableBlur(), h.editor.$el.trigger("blur")), TVE.state() !== TVE.STATE_DRAG && (!!TVE.state_manager.is_default() && (!!TVE.apply_filters("tcb.element.editable", !0, n) && (TVE.Views.Controls.DropPanel.close_all(), h.handleParentHoverLeave(n), void("mousedown" !== e.type || (t = c(e.target)).closest(".fr-element").length || (t.find(".fr-element").mousedown(), setTimeout(function () {
                                                        n.data("froala.editor").events.focus()
                                                    }))))));
                                                    var t
                                                });
                                                var r, t = n.is(TVE.TEXT_INLINE), i = n.is(TVE.TEXT_RAW),
                                                    a = n.is(TVE.TEXT_HEADINGS),
                                                    s = n.is(TVE.TEXT_WITH_LINK) ? v.with_link : t ? v.inline : v.default,
                                                    o = {
                                                        H1: "Heading 1",
                                                        H2: "Heading 2",
                                                        H3: "Heading 3",
                                                        H4: "Heading 4",
                                                        H5: "Heading 5",
                                                        H6: "Heading 6"
                                                    };
                                                c.extend(o, {
                                                    P: "Paragraph",
                                                    BLOCKQUOTE: "Blockquote",
                                                    PlainText: "PlainText"
                                                }), n.hasClass("wp-caption-text") && ((s = s.slice()).push("tcbLink"), s.push("align-left"), s.push("align-center"), s.push("align-right"), s.push("align-justify")), r = {
                                                    key: "cSXSE1LHAFJVCXCLS==",
                                                    enter: t ? null : i ? c.FroalaEditor.ENTER_DIV : c.FroalaEditor.ENTER_P,
                                                    multiLine: !t && !a,
                                                    multiLineEnableBR: a,
                                                    keepFormatOnDelete: !0,
                                                    placeholderText: "",
                                                    initOnClick: !0,
                                                    toolbarInline: !1,
                                                    typingTimer: 800,
                                                    toolbarContainer: d,
                                                    tooltips: !1,
                                                    tooltipContainer: TVE.$body,
                                                    htmlUntouched: !0,
                                                    htmlAllowedEmptyTags: ["i"],
                                                    toolbarButtons: s,
                                                    toolbarButtonsMD: s,
                                                    toolbarButtonsSM: s,
                                                    toolbarButtonsXS: s,
                                                    toolbarVisibleWithoutSelection: !0,
                                                    toolbarHideOnKeyup: !1,
                                                    toolbarFocusElement: !1,
                                                    paragraphFormat: o
                                                }, a && (r.htmlAllowedEmptyTags = TVE.ELEM.headings.split(",").concat(["textarea", "a", "iframe", "object", "video", "style", "script", ".fa"])), c.each(l, function (e, t) {
                                                    r[e] = t
                                                }), e.currentTarget.classList.add("tve-froala"), n.froalaEditor(r).on("froalaEditor.buttons.refresh", u("refresh")).on("froalaEditor.paste.after", u("paste_after")).on("froalaEditor.paste.afterCleanup", u("paste_afterCleanup")).on("froalaEditor.commands.after", u("commands_after")).on("froalaEditor.focus", u("focus")).on("froalaEditor.blur", u("blur")).on("froalaEditor.undo.saveStep", u("undo_save_step")).on("froalaEditor.keydown", u("keydown")).on("froalaEditor.tcb_before_delete", u("tcb_before_delete")).on("froalaEditor.click", u("click")).on("froalaEditor.popups.show.tcbLink.insert", u("lnk_popup_show")), n.on("froalaEditor.paste.beforeInsert", function (e, t, r) {
                                                    if (n.parents("div[data-link-wrap]").parent("a[href]").length && c(r).find("a[href]").length) {
                                                        var i = n.closest("a[href]").children().first();
                                                        return TVE.page_message(TVE.t.warning_link_pasted_inside_link + ": " + TVE.get_element_name(i), !0, 1e4), !1
                                                    }
                                                }), n.is(TVE.TEXT_BLOCK) || a ? n.off("click.tcb").on("click.tcb", function (e) {
                                                    e.stopPropagation()
                                                }) : t && (n.on("froalaEditor.initialized", function (e, t) {
                                                    t.events.on("drop", function () {
                                                        return !1
                                                    }, !0)
                                                }), n.on("froalaEditor.paste.beforeInsert", function (e, t, r) {
                                                    return c(r).children(TVE.BLOCK_ELEMENTS).not("a").contents().unwrap(), r.innerHTML
                                                }))
                                            }
                                        }), TVE.Editor_Page.editor.find(".thrive-shortcode-content").each(function () {
                                            var e = c(this);
                                            e.is(":empty") && e.html(e.attr("data-shortcode-name")), e.attr("contenteditable", !1).wrap('<span class="thrive-inline-shortcode" contenteditable="false"></span>')
                                        }), TVE.add_action("tcb_after_cloud_template", r), TVE.add_action("tcb.after_insert_symbol", r), TVE.add_filter("tcb_insert_content_template", r), TVE.add_filter("tcb_filter_html_before_save", h.formatInlineShortcodes), d.draggable({
                                            handle: ".fr-drag",
                                            containment: "body",
                                            start: function () {
                                                TVE.main.$container.addClass("overlay")
                                            },
                                            stop: function () {
                                                TVE.main.$container.removeClass("overlay"), d.css("width", "")
                                            }
                                        }), c.FE.DefineIconTemplate("font_awesome", '<svg class="tcb-icon" aria-hidden="true"><use xlink:href="#icon-[NAME]"></use></svg>');
                                        ["bold", "italic", "strikeThrough", "underline"].forEach(function (e) {
                                            c.extend(c.FE.ICONS[e], {NAME: c.FE.ICONS[e].NAME.replace(/-light$/, "") + "-light"})
                                        }), TVE.main.on("hover_state", function () {
                                            (h.maintain_focus = h.editor && h.editor.core.hasFocus()) && (h.editor.$el.blur(), h.hide_toolbars())
                                        }).on("default_state", function () {
                                            h.editor && h.maintain_focus && h.editor.events.focus()
                                        }), TVE.Editor_Page.editor.on("mousedown", ".tcb-replaceable-placeholder", function (e) {
                                            if (0 === e.button && TVE.state_manager.is_default()) {
                                                var t = c(e.currentTarget);
                                                return h.replace_placeholder(t), !1
                                            }
                                        })
                                    }, h.replace_placeholder = function (e) {
                                        e.parent().removeClass("tcb-parent-placeholder-empty");
                                        var t = c(TVE.main.$('#tve-static-elements [data-elem="text"]').html());
                                        TVE.do_action("tcb.froala.replace.placeholder", e, t), e.replaceWith(t), setTimeout(function () {
                                            h.force_focus(t, !1), setTimeout(function () {
                                                TVE.froala.editor.selection.ranges(0).selectNodeContents(TVE.froala.editor.$el.children()[0])
                                            })
                                        })
                                    }, h.disable = function (e) {
                                        1 < e.length ? e.add(e.find(".tve-froala")).each(function () {
                                            var e = c(this);
                                            e.data("froala.editor") && e.froalaEditor("destroy")
                                        }) : e.data("froala.editor") && e.froalaEditor("destroy")
                                    }, h.exec = function () {
                                        if (this.editor) {
                                            for (var e = arguments[0].split("."), t = this.editor, r = t; e.length && t[e[0]];) t = t[e.shift()], 1 < e.length && (r = t);
                                            t.apply(r, Array.prototype.slice.call(arguments, 1))
                                        }
                                    }, h.get_block_element = function () {
                                        return TVE.apply_filters("text_block_element", this.editor && this.editor.tcb && this.editor.tcb.getBlockElement() || TVE.ActiveElement)
                                    }, h.selectionIsFullBlock = function () {
                                        return this.editor.tcb.selectionIsFullBlock()
                                    }, h.has_selection = function () {
                                        return !(!this.editor || !this.editor.selection.text()) && this.editor.selection.element()
                                    }, h.get_selection_element = function () {
                                        if (!this.editor) return c();
                                        var e = this.editor.selection.element(), t = c(e).closest("span");
                                        return "span" !== e.tagName.toLowerCase() && t.length && (e = t[0]), e && e !== this.editor.$el[0] || (e = this.editor.tcb.getBlockElement()), c(e)
                                    }, h.get_css = function (e, t, r, i) {
                                        if (!this.editor && TVE.ActiveElement) return TVE.ActiveElement.css(e);
                                        void 0 === t && (t = !0);
                                        var n = this.get_selection_element();
                                        if (n[0]) {
                                            if ("string" == typeof e) return this.get_block_element()[0] !== n[0] && "span" === n[0].tagName.toLowerCase() && (i = ""), c(n).head_css(e, !1, r, t, i);
                                            var a = {};
                                            return _.each(e, function (e) {
                                                a[e] = n.style[e] || TVE.getComputedStyle(n, e)
                                            }), a
                                        }
                                    }, h.wrap_selection = function (e, t) {
                                        return !!this.editor && ((t = t || {}).class || (t.class = TVE.CSS_Rule_Cache.generate_id()), this.editor.format.apply(e || "span", t), c(this.editor.selection.element()))
                                    }, h.force_focus = function (e, t) {
                                        t = void 0 === t || t, e.data("froala.editor") || e.trigger("mouseenter");
                                        var r = e.data("froala.editor");
                                        r.$el.trigger("mousedown"), r.events.focus(), t && r.selection.ranges(0).selectNodeContents(r.$el.children()[0])
                                    }, h.hide_toolbars = function () {
                                        this.force_show_toolbar || TVE.$will_focus && TVE.$will_focus.is(TVE.TEXT_ALL) || (d.hide(), c(".fr-element").blur())
                                    }, h.handleParentHoverLeave = function (e) {
                                        e.parents(".thrv_wrapper").one("mouseleave", TVE._.debounce(function () {
                                            TVE.ActiveElement && TVE.main.update_components(["text"])
                                        }, 50))
                                    }, h.formatInlineShortcodes = function (e) {
                                        var i = "data-attr-", n = "data-option-";
                                        return e.find(".thrive-inline-shortcode").each(function () {
                                            var e = c(this), t = e.find(".thrive-shortcode-content"),
                                                r = t.data("shortcode");
                                            t.each(function () {
                                                c.each(this.attributes, function () {
                                                    this.name.startsWith(i) ? r += " " + this.name.replace(i, "") + "='" + this.value + "'" : this.name.startsWith(n) && (r += " " + this.name.replace(n, "") + "='" + this.value + "'")
                                                })
                                            }), t.attr("data-css", e.data("css")).attr("style", e.attr("style")).html("[" + r + "]"), e.replaceWith(e.html())
                                        }), e
                                    }, n.exports = h
                                }(jQuery)
                            }, "general.js": function (e, t, r) {
                                !function (x) {
                                    var e = {
                                        flag_modify_hover_selector: !0,
                                        ELEM: {
                                            headings: "h1,h2,h3,h4,h5,h6",
                                            text: "p:not(.tve_more_tag,.thrv-inline-text p),h1,h2,h3,h4,h5,h6,ol:not(.tcb-numbered-list),ul:not(.tcb-styled-list,.tcb-numbered-list,.thrv_bullets_shortcode ul),blockquote,address,pre"
                                        },
                                        FILTER_TYPES: {
                                            grayscale: "grayscale",
                                            blur: "blur",
                                            brightness: "grayscale",
                                            contrast: "grayscale",
                                            invert: "grayscale",
                                            saturate: "grayscale",
                                            sepia: "grayscale"
                                        },
                                        CSS_RULE_FIRST: "0",
                                        CSS_RULE_LAST: "1",
                                        STATE_DEFAULT: "default",
                                        STATE_EDIT: "edit",
                                        STATE_TINYMCE: "tinymce",
                                        STATE_DRAG: "drag",
                                        state: function (e) {
                                            return void 0 === e ? this.CUR_STATE : (e !== this.CUR_STATE && (TVE.main.trigger("exitstate_" + this.CUR_STATE, e), TVE.main.trigger("enterstate_" + e, this.CUR_STATE), x("body").toggleClass("tcb-edit-mode", e === this.STATE_EDIT), this.CUR_STATE = e), this)
                                        },
                                        allow_drag: function () {
                                            return !0
                                        },
                                        allow_tinymce: function () {
                                            return this.CUR_STATE === this.STATE_DEFAULT || this.CUR_STATE === this.STATE_TINYMCE
                                        },
                                        allow_edit: function () {
                                            return this.CUR_STATE === this.STATE_DEFAULT || this.CUR_STATE === this.STATE_EDIT || this.CUR_STATE === this.STATE_TINYMCE
                                        },
                                        store_active_element: function () {
                                            return TVE.ActiveElement && (this.$$stored_active_element = TVE.ActiveElement), this
                                        },
                                        restore_active_element: function () {
                                            return this.$$stored_active_element && (TVE.ActiveElement = this.$$stored_active_element, delete this.$$stored_active_element), this
                                        },
                                        getSelectedElement: function () {
                                            return TVE.ClickedElement || TVE.ActiveElement.filter(".edit_mode")
                                        },
                                        identifier: function (e) {
                                            return TVE.Elements && TVE.Elements[e] ? TVE.Elements[e].identifier : ""
                                        }
                                    };

                                    function w(e, t, r) {
                                        var i = r, n = "";
                                        return e && (i += '[data-css="' + e + '"]'), t ? (x.isArray(t) || (t = [t]), x.each(t, function (e) {
                                            n += (e ? ", " : "") + i + this
                                        }), n) : i
                                    }

                                    function v(e, t, r) {
                                        TVE.BROWSER.edge && (e = e.replace(/"/g, "'")), e = TVE.apply_filters("tcb.selector", e);
                                        for (var i, n = 0; i = this.cssRules[n++];) if (i.selectorText == e) return i.style;
                                        if (void 0 === t && (t = !0), t) {
                                            var a = this.cssRules.length;
                                            return this.insertRule(e + "{}", a), this.cssRules[a].style
                                        }
                                        return null
                                    }

                                    e.CUR_STATE = e.STATE_DEFAULT, x.fn.extend({
                                        head_css: function (d, _, h, s, v) {
                                            void 0 === h && (h = ""), void 0 === v && (v = ""), h = TVE.apply_filters("tcb_head_css_suffix", h, this), v = TVE.apply_filters("tcb_head_css_prefix", v, this);
                                            var n = x.isArray(d), u = this;
                                            if ("string" == typeof d || n) {
                                                var o = function (i, e) {
                                                    if (!h) return i.css(e);
                                                    if (x.isArray(h) && (x.each(h, function (e, t) {
                                                            var r = t.split("::")[0];
                                                            if (i.find(r).length) return h = r, !1
                                                        }), x.isArray(h) && (h = !1)), h && -1 !== h.indexOf("::")) {
                                                        var t = h.split("::"), r = ":" + t.pop();
                                                        if (t[0] && (i = i.find(t[0])), h = t[0], i.length) return s = !1, a(window.getComputedStyle(i[0], r), e, n)
                                                    }
                                                    return (h ? i.find(h) : i).css(e)
                                                }, a = function t(r, e, i) {
                                                    if (i) {
                                                        var n = {};
                                                        return e.forEach(function (e) {
                                                            n[e] = t(r, e, !1)
                                                        }), n
                                                    }
                                                    var a = r.getPropertyValue(e);
                                                    return !a && s && (a = o(u, e)), a
                                                };
                                                if (!this.length) return "";
                                                var e, t, r, i = this[0], l = i.dataset.css, c = !1;
                                                if (_ = _ || TVE.main.media_query_tpl(), e = TVE.CSS_Rule_Cache.media_rule(_), TVE.state_manager.is_hover() || TVE.FLAGS.hover_element) {
                                                    var f = TVE.apply_filters("hover_prefix_selector", "#tve_editor", u[0]) + " ";
                                                    if (TVE.USE_GLOBALSHEET) {
                                                        var p = TVE.getClassThatContains(u[0], TVE.CONST.global_cls_prefix) + ".tve-state-hover";
                                                        r = TVE.apply_filters("global_style_selector", w(!1, h, f + "." + p), p, f, u)
                                                    } else if (l) {
                                                        var g = w(l, h, v), m = g.split(", ");
                                                        if (TVE.state_manager.is_child()) {
                                                            var E = TVE.state_manager.get_parent(),
                                                                T = E.attr("data-css") ? '[data-css="' + E.attr("data-css") + '"]' : "",
                                                                b = -1 !== g.indexOf(f);
                                                            x.each(m, function (e, t) {
                                                                t = t.replace(f, ""), m[e] = (b ? f : "") + T + ".tve-state-hover " + t
                                                            })
                                                        } else {
                                                            var V;
                                                            V = u.attr("data-selector") ? "[" + u.attr("data-selector") + "]" : '[data-css="' + TVE.CSS_Rule_Cache.uniq_id(u) + '"]', x.each(m, function (e, t) {
                                                                if (TVE.ActiveElement && (TVE.ActiveElement.is(".thrv-content-box") || TVE.ActiveElement.is(".thrv-page-section"))) {
                                                                    var r = "";
                                                                    -1 !== t.indexOf(".thrv-content-box ") && (t = t.replace(".thrv-content-box ", ""), r = ".thrv-content-box"), m[e] = r + '[data-css="' + TVE.ActiveElement.attr("data-css") + '"].tve-state-hover ' + V
                                                                } else m[e] = V + ".tve-state-hover";
                                                                m[e] = m[e] + t.replace(V, ""), m[e] = f + m[e].replace(f, ""), m[e] = x.trim(m[e].replace(/([ ]{2,})/g, " "))
                                                            })
                                                        }
                                                        r = m.join(", ")
                                                    } else i.dataset.selector && (r = TVE.apply_filters("head_css_selector", {
                                                        suffix: h,
                                                        prefix: f,
                                                        selector: i.dataset.selector + TVE.state_manager.css_class(),
                                                        element: i
                                                    }).selector);
                                                    e && (t = e.style_by_selector(r, !1)) && (c = a(t, d, n)), !c && s && (c = o(u, d))
                                                } else if (l || i.dataset.selector || TVE.USE_GLOBALSHEET) {
                                                    if (TVE.USE_GLOBALSHEET) {
                                                        var y = TVE.getClassThatContains(i, TVE.CONST.global_cls_prefix);
                                                        r = TVE.apply_filters("global_style_selector", w(!1, h, v + "." + y), y, v, u)
                                                    } else r = i.dataset.selector ? TVE.apply_filters("head_css_selector", {
                                                        suffix: h,
                                                        prefix: v,
                                                        selector: i.dataset.selector,
                                                        element: i
                                                    }).selector : w(l, h, v);
                                                    r = r.replace(/(\s{2,})/g, " "), e && (t = e.style_by_selector(r, !1)) && (c = a(t, d, n))
                                                }
                                                return s && !c && (c = o(u, d)), c || (c = n ? {} : ""), c
                                            }
                                            return this.each(function () {
                                                var e, t = this.dataset.css;
                                                if (TVE.USE_GLOBALSHEET) {
                                                    var r = TVE.getClassThatContains(u, TVE.CONST.global_cls_prefix);
                                                    e = TVE.apply_filters("global_style_selector", w(!1, h, v + "." + r), r, v, u)
                                                } else if (this.dataset.selector) e = TVE.apply_filters("head_css_selector", {
                                                    suffix: h,
                                                    prefix: v,
                                                    selector: this.dataset.selector,
                                                    element: this
                                                }).selector; else {
                                                    if (TVE.apply_filters("tcb.generate_new_css_id", t, this)) {
                                                        var i = TVE.Editor_Page.editor.find('[data-css="' + t + '"]');
                                                        if (TVE.apply_filters("regenerate_css_id", 1 < i.length, t, i)) {
                                                            var n = TVE.CSS_Rule_Cache.generate_id();
                                                            this.setAttribute("data-css", n), TVE.head_css_copy(t, n), t = n
                                                        } else {
                                                            for (var a, s = TVE.main.all_media(), o = 0, l = TVE.getActiveStylesheet().key, c = 0; a = s[c++];) -1 !== TVE.CSS_Rule_Cache[l][a].cssText.indexOf(t) && o++;
                                                            TVE.apply_filters("set_new_css_id", 0 === o, t) && !x(this).data("keep-css_id") && (t = TVE.CSS_Rule_Cache.uniq_id(this, !0))
                                                        }
                                                    } else t = TVE.apply_filters("tcb.head_css_new_id", TVE.CSS_Rule_Cache.uniq_id(this));
                                                    e = w(t, h, v)
                                                }
                                                e = e.replace(/(\s{2,})/g, " "), TVE.head_css(e, d, _, this)
                                            })
                                        }, copy_styles_different_stylesheet: function (e, t, r) {
                                            for (var i, n = TVE.main.all_media(), a = 0; i = n[a++];) if (0 !== e[i].length) {
                                                for (var s = e[i].split("}"), o = 0; o < s.length; o++) if (0 !== s[o].length) for (var l = 0; l < t.length; l++) s[o] = s[o].split(t[l]).join(r[l]);
                                                for (var c = 0; c < s.length; c++) if (0 !== s[c].length) {
                                                    s[c] += "}", s[c] = TVE.apply_filters("tcb.copy_styles_different_stylesheet", s[c]);
                                                    var d = TVE.decodeCssRule(s[c]);
                                                    try {
                                                        TVE.write_css(d.selector, d.props, [i]), -1 < d.selector.indexOf(":hover") && TVE.write_css(d.selector.replace(":hover", ".tve-state-hover"), d.props, [i])
                                                    } catch (e) {
                                                        console.log(d.selector + "is not a valid selector")
                                                    }
                                                }
                                            }
                                        }, collect_head_css: function () {
                                            var e, t, r, i, n = {}, a = TVE.main.all_media(), s = "";
                                            if (this.add(this.find('[data-css^="tve-u-"], [data-selector], [' + TVE.CONST.global_cls_prefix + "]")).each(function () {
                                                    var e = TVE.getClassThatContains(this, TVE.CONST.global_cls_prefix) || this.getAttribute("data-css") || this.getAttribute("data-selector");
                                                    if (!e) return !0;
                                                    s += (s ? "|" : "") + e
                                                }), !s) return n;
                                            s = new RegExp("(" + s.replace(/([().[\]])/g, "\\$1") + ")", "g");
                                            for (var o, l = 0; o = a[l++];) {
                                                var c = TVE.CSS_Rule_Cache.media_rule(o);
                                                n[o] = "";
                                                for (var d, _ = 0; d = c.cssRules[_++];) d.selectorText.match(s) && (r = t = void 0, t = (e = d).selectorText.replace(/(:hover|:active|:after|::after|:before|::before|::placeholder)/g, ""), r = !1, i = / (p|h1|h2|h3)$/, jQuery(t).length && jQuery.trim(e.cssText.replace(e.selectorText, "").replace(/\{(\s*)\}/g, "")) && (r = !0), r || t.match(i) && -1 !== e.cssText.indexOf("margin") && (r = jQuery(t.replace(i, "")).length), r) && (n[o] += d.cssText)
                                            }
                                            return n
                                        }, color_selector: function (e) {
                                            return void 0 !== e ? e ? this.attr("data-tve-custom-colour", e) : this.removeAttr("data-tve-custom-colour") : this.attr("data-tve-custom-colour")
                                        }, head_css_clone: function () {
                                            return this.each(function () {
                                                var e = this.getAttribute("data-css");
                                                if (!e || 0 !== e.indexOf("tve-u-")) return !0;
                                                TVE.head_css_copy('[data-css="' + e + '"]', '[data-css="' + TVE.CSS_Rule_Cache.uniq_id(this, !0) + '"]')
                                            })
                                        }, head_css_copy: function (e) {
                                            e.jquery && (e = e[0]);
                                            var t = e.getAttribute("data-css");
                                            return t && 0 === t.indexOf("tve-u-") ? this.each(function () {
                                                TVE.head_css_copy('[data-css="' + t + '"]', '[data-css="' + TVE.CSS_Rule_Cache.uniq_id(this, !0) + '"]')
                                            }) : this
                                        }, tve_overlay: function () {
                                            var n = this,
                                                e = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : "";
                                            TVE.remove_element_overlay(), e = "tve-element-mask" + (e ? " " + e : "");
                                            var a = TVE.inner_$("<div></div>", {class: e}).add(TVE.inner_$("<div></div>", {class: e})).add(TVE.inner_$("<div></div>", {class: e})).add(TVE.inner_$("<div></div>", {class: e})),
                                                t = function () {
                                                    var e = n.offset(), t = n.outerWidth(), r = n.outerHeight(),
                                                        i = Math.max(TVE.inner.$body.outerHeight(!0), TVE.main.$container.outerHeight());
                                                    a[0].style.height = e.top + "px", a[1].style.top = e.top + "px", a[1].style.width = e.left + "px", a[1].style.height = r + "px", a[2].style.top = e.top + "px", a[2].style.left = e.left + t + "px", a[2].style.height = r + "px", a[3].style.top = e.top + r + "px", a[3].style.height = i - r - e.top + "px"
                                                };
                                            return t(), TVE.overlaySensor = new TVE.ResizeSensor(this[0], t), TVE.inner.$body.append(a), this
                                        }, removeClassContaining: function (r) {
                                            return TVE._.isRegExp(r) ? this.removeClass(function (e, t) {
                                                return (t.match(r) || []).join(" ")
                                            }) : this.removeClass(function (e, t) {
                                                return t.split(" ").filter(function (e) {
                                                    return -1 !== e.indexOf(r)
                                                }).join(" ")
                                            })
                                        }, mediaAttr: function (e, t) {
                                            var r = e;
                                            if (e = e + "-" + TVE.main.device.charAt(0), void 0 === t) {
                                                var i = TVE.main.media_rule_index(), n = this.attr(e), a = [];
                                                for (1 < i && a.push("tablet"), 0 < i && a.push("desktop"); void 0 === n && a.length;) n = this.attr(r + "-" + a.shift().charAt(0));
                                                return void 0 === n && (n = this.attr(r)), n
                                            }
                                            return this.attr(e, t)
                                        }, removeMediaAttr: function (e) {
                                            return e = e + "-" + TVE.main.device.charAt(0), this.removeAttr(e)
                                        }
                                    }), e.head_css = function (e, t, r, i) {
                                        r = "_ALL" === (r = r || TVE.main.media_query_tpl()) ? TVE.main.all_media() : [r];
                                        var n = !1;
                                        if (this.flag_modify_hover_selector && TVE.state_manager.is_hover()) {
                                            var a,
                                                s = TVE.apply_filters("hover_prefix_selector", "#tve_editor", i, e) + " ",
                                                o = e.split(", "), l = [];
                                            if (TVE.state_manager.is_child()) {
                                                var c = TVE.state_manager.get_parent(),
                                                    d = c.data("selector") ? c.data("selector") : '[data-css="' + TVE.CSS_Rule_Cache.uniq_id(c) + '"]',
                                                    _ = -1 !== e.indexOf(s);
                                                o = e.split(", "), x.each(o, function (e, t) {
                                                    t = t.replace(s, ""), l[e] = (_ ? s : "") + d + TVE.state_manager.css_class() + " " + t, o[e] = (_ ? s : "") + d + TVE.state_manager.get_pseudo() + " " + t
                                                })
                                            } else {
                                                var h;
                                                void 0 !== i && TVE.state_manager.needs_hover_state_parent(i) && x.each(TVE.ActiveElement, function (e, t) {
                                                    if (TVE.inner_$(t).find(i).length) return i = TVE.ActiveElement[e], !1
                                                }), i = (i = void 0 === i ? TVE.ActiveElement[0] : i).jquery ? i[0] : i, h = TVE.USE_GLOBALSHEET ? TVE.getClassThatContains(i, TVE.CONST.global_cls_prefix) : i.dataset.selector ? i.dataset.selector : '[data-css="' + TVE.CSS_Rule_Cache.uniq_id(i) + '"]', TVE.USE_GLOBALSHEET && 0 < jQuery(i).find('[data-tcb_hover_state_parent="1"]').length && e.trim() !== "." + h ? x.each(o, function (e, t) {
                                                    -1 !== (t = " " + t.replace(s, "")).indexOf(".thrv-content-box") && (t = t.replace(".thrv-content-box", ""));
                                                    var r = s, i = " " + t;
                                                    o[e] = TVE.remove_extra_spaces(r + "." + h + TVE.state_manager.get_pseudo() + i), l[e] = TVE.remove_extra_spaces(r + "." + h + TVE.state_manager.css_class() + i)
                                                }) : x.each(o, function (e, t) {
                                                    -1 !== (t = " " + t.replace(s, "")).indexOf(".thrv-content-box") && (t = t.replace(/(.thrv-content-box)/, "$1" + h)), -1 === t.indexOf(h) && (t = h + " " + t);
                                                    var r = t.split(h), i = r[0], n = r[1];
                                                    2 === r.length ? (i = s + i, o[e] = TVE.remove_extra_spaces(i + h + TVE.state_manager.get_pseudo() + n), l[e] = TVE.remove_extra_spaces(i + h + TVE.state_manager.css_class() + n)) : console.error("I was not expecting this situation, please solve it!!!!", t, h)
                                                }), n = !0
                                            }
                                            var v = TVE.apply_filters("hover_head_css_selector", {
                                                selector: o.join(", "),
                                                current_element: i,
                                                state_preview_selector: l.join(", ")
                                            });
                                            e = v.selector, a = v.state_preview_selector, TVE.write_css(a, t, r, n)
                                        }
                                        TVE.add_undo_step(e, t, r), n = TVE.apply_filters("tcb.force_important", n), TVE.write_css(e, t, r, n)
                                    }, e.add_undo_step = function (t, r, i) {
                                        if (TVE.SKIP_CSS_STATE) TVE.UNDO_RULES || (TVE.UNDO_RULES = TVE.head_css_get(t, r, i, !1)); else {
                                            TVE.UNDO_RULES && x.each(r, function (e, t) {
                                                if (void 0 === TVE.UNDO_RULES[e]) return delete TVE.UNDO_RULES, !1
                                            });
                                            var n = null;
                                            TVE.UndoManager.temp.get() && (n = TVE.UndoManager.temp.get(), TVE.UndoManager.temp.delete()), null === n && (n = TVE.UNDO_RULES || TVE.head_css_get(t, r, i, !1)), TVE.UndoManager.add({
                                                undo: function () {
                                                    var e = TVE.SKIP_CSS_STATE;
                                                    TVE.SKIP_CSS_STATE = !0, Array.isArray(n) ? n.forEach(function (e) {
                                                        TVE.head_css(t, e.rules, e._media)
                                                    }) : TVE.head_css(t, n, i), TVE.SKIP_CSS_STATE = e
                                                }, redo: function () {
                                                    var e = TVE.SKIP_CSS_STATE;
                                                    TVE.SKIP_CSS_STATE = !0, TVE.head_css(t, r, i), TVE.SKIP_CSS_STATE = e
                                                }
                                            }), delete TVE.UNDO_RULES
                                        }
                                    }, e.write_css = function (e, t, r, n, i) {
                                        function a(i) {
                                            x.each(t, function (e, t) {
                                                var r = "";
                                                "string" == typeof t && -1 !== t.indexOf("important") && (t = x.trim(t.replace(/!(\s*)important/, "")), r = "important"), t || i.removeProperty(e), n && (r = "important"), i.setProperty(e, t, r)
                                            })
                                        }

                                        if (void 0 === i && (i = TVE.CSS_RULE_FIRST), r) for (var s, o = 0; s = r[o++];) a(this.CSS_Rule_Cache.media_rule(s).style_by_selector(e, !0, i)); else a(this.CSS_Rule_Cache.stylesheet_rule().style_by_selector(e, !0, i));
                                        TVE.do_action("tcb.write_css", e, t, r)
                                    }, e.head_css_get = function (e, t, r, i) {
                                        var n = [];
                                        if (i) var a = x(e);

                                        function s(e, t) {
                                            var r = e ? e.getPropertyValue(t) : "";
                                            return r && "important" === e.getPropertyPriority(t) && (r += "!important"), !r && i && (r = a.css(t)), r
                                        }

                                        for (var o, l = 0; o = (r = "_ALL" === (r = r || TVE.main.media_query_tpl()) ? TVE.main.all_media() : Array.isArray(r) ? r : [r])[l++];) {
                                            var c = this.CSS_Rule_Cache.media_rule(o).style_by_selector(e, !1), d = {};
                                            x.isPlainObject(t) ? x.each(t, function (e, t) {
                                                d[e] = s(c, e), "string" == typeof t && -1 !== t.indexOf("important") && -1 === d[e].indexOf("important") && (d[e] += "!important")
                                            }) : Array.isArray(t) ? t.forEach(function (e) {
                                                d[e] = s(c, e)
                                            }) : "string" == typeof t && !(d = c ? c.getPropertyValue(t) : "") && i && (d = a.css(t)), n.push({
                                                media: o,
                                                rules: d
                                            })
                                        }
                                        return n.length ? 1 === n.length ? n.pop().rules : n : {}
                                    }, e.head_css_remove = function (a, e) {
                                        var s = this,
                                            o = 2 < arguments.length && void 0 !== arguments[2] && arguments[2];
                                        e = "_ALL" === (e = e || TVE.main.media_query_tpl()) ? TVE.main.all_media() : [e];
                                        var l = TVE._.isRegExp(a);
                                        e.forEach(function (e) {
                                            for (var t, r, i = s.CSS_Rule_Cache.media_rule(e), n = 0; (t = i.cssRules[n++]) && (r = t, !(!l && r.selectorText === a || !l && o && r.selectorText.includes(a) || l && a.exec(r.selectorText) && !(a.lastIndex = 0)) || (i.deleteRule(--n), o || l));) ;
                                        })
                                    }, e.head_css_copy = function (e, t, r) {
                                        if (e) {
                                            for (var i, n = TVE.main.all_media(), a = 0; i = n[a++];) for (var s = this.CSS_Rule_Cache.media_rule(i), o = s.cssRules.length, l = 0; l < o; l++) if (-1 !== s.cssRules[l].cssText.indexOf(e)) {
                                                var c = s.cssRules[l].cssText.split(e).join(t);
                                                "function" == typeof r && (c = r(c, s.cssRules[l])), s.insertRule(c, s.cssRules.length)
                                            }
                                            for (var d = TVE.getActiveStylesheet().sheet, _ = d.cssRules.length, h = 0; h < _; h++) {
                                                var v = d.cssRules[h];
                                                if (v.type === CSSRule.STYLE_RULE && -1 !== v.cssText.indexOf(e)) {
                                                    var u = v.cssText.split(e).join(t);
                                                    "function" == typeof r && (u = r(u, v)), d.insertRule(u, d.cssRules.length)
                                                }
                                            }
                                        }
                                    }, e.hasHeadCss = function (e, t) {
                                        for (var r, i = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : null, n = i ? [i] : TVE.main.all_media(), a = 0; r = n[a++];) for (var s, o = this.CSS_Rule_Cache.media_rule(r), l = 0; s = o.cssRules[l++];) if (t && s.selectorText === e || !t && -1 !== s.selectorText.indexOf(e)) return !0;
                                        return !1
                                    }, e.CSS_Rule_Cache = {
                                        page_index: Math.floor(1e5 * Math.random()), uniq_id: function (e, t) {
                                            void 0 === t && (t = !1), e.jquery && (e = e[0]);
                                            var r = e.getAttribute("data-css");
                                            return !t && r || (r = this.generate_id(), e.setAttribute("data-css", r)), r
                                        }, generate_id: function (e) {
                                            var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : 16;
                                            return void 0 === e && (e = "tve-u-"), e + ((new Date).getTime() + this.page_index++).toString(t)
                                        }, media_rule: function (e, t, r) {
                                            function i(e, t) {
                                                for (var r = 0; r < e.length; r++) if (-1 !== e.item(r).replace(/ /g, "").indexOf(t.replace(/ /g, ""))) return !0;
                                                return !1
                                            }

                                            r = r || "", void 0 === t && (t = TVE.main.media_rule_index());
                                            var n, a = !1, s = -1, o = 0, l = TVE.getActiveStylesheet(), c = l.sheet,
                                                d = l.key;
                                            if (this[d] || (this[d] = {}), !this[d][e]) {
                                                for (var _ = 0; _ < c.cssRules.length; _++) if ((n = c.cssRules[_]).type !== CSSRule.IMPORT_RULE) {
                                                    if (n.type === CSSRule.MEDIA_RULE && n.media && n.media.length && i(n.media, e)) {
                                                        a = !0, s = _, this[d][e] = n;
                                                        break
                                                    }
                                                } else o++;
                                                if (a) {
                                                    if (t + o < s) {
                                                        var h = this[d][e].cssText;
                                                        c.deleteRule(s), c.insertRule(h, t + o), this[d][e] = c.cssRules[t + o]
                                                    }
                                                } else (t += o) > c.cssRules.length && (t = c.cssRules.length), c.insertRule(r || "@media " + e + "{}", t), this[d][e] = c.cssRules[t];
                                                this[d][e].style_by_selector = v.bind(this[d][e]), this[d][e].rule_index_by_selector = function (e) {
                                                    TVE.BROWSER.edge && (e = e.replace(/"/g, "'"));
                                                    for (var t = 0; t < this.cssRules.length; t++) if (this.cssRules[t].selectorText === e) return t;
                                                    return null
                                                }.bind(this[d][e])
                                            }
                                            return this[d][e]
                                        }, stylesheet_rule: function () {
                                            var e = TVE.getActiveStylesheet().sheet;
                                            return e.style_by_selector = v.bind(e), e
                                        }, clear: function () {
                                            var r = this, i = TVE.getActiveStylesheet().key;
                                            x.each(TVE.main.responsive, function (e, t) {
                                                delete r[i][t.media]
                                            })
                                        }, init: function (e) {
                                            var r = this;
                                            void 0 === e && (e = !1), x.each(TVE.main.responsive, function (e, t) {
                                                r.media_rule(t.media, t.rule_index)
                                            });
                                            var t = this.media_rule(TVE.main.responsive.desktop.media);
                                            if (-1 !== t.cssText.indexOf(":hover")) for (var i = t.cssRules.length, n = null, a = 0; a < i; a++) null !== (n = this.generate_hover_state_css(t.cssRules[a])) && t.insertRule(n, t.cssRules.length);
                                            var s = TVE.getActiveStylesheet().sheet;
                                            if (e) for (var o, l = 0; o = s.cssRules[l];) o.type !== CSSRule.STYLE_RULE || -1 === o.selectorText.indexOf("data-tve-custom") ? l++ : (t.insertRule(o.cssText, t.cssRules.length), s.deleteRule(l));
                                            TVE.USE_GLOBALSHEET || TVE.main.trigger("stylesheet_loaded")
                                        }, insertImport: function (e) {
                                            TVE.getActiveStylesheet().sheet.insertRule('@import url("' + e + '")', 0)
                                        }, getImports: function () {
                                            var t = [];
                                            return TVE._.each(TVE.getActiveStylesheet().sheet.cssRules, function (e) {
                                                e.type === CSSRule.IMPORT_RULE && t.push(e.cssText)
                                            }), t
                                        }, removeRule: function (e) {
                                            TVE.getActiveStylesheet().sheet.cssRules[e] && TVE.getActiveStylesheet().sheet.deleteRule(e)
                                        }, toText: function (e) {
                                            for (var t, r = "", i = 0; t = TVE.getActiveStylesheet().sheet.cssRules[i++];) e ? t.type === e && (r += t.cssText) : r += t.cssText;
                                            return r
                                        }, cssToObject: function (e, a) {
                                            e.includes("{") && (e = e.replace(/[^{]+{([^}]+?)}/, "$1"));
                                            var s = {};
                                            return x.each(e.split(";"), function (e, t) {
                                                var r = t.split(":"), i = x.trim(r[0]), n = x.trim(r[1]);
                                                i && n && (s[i] = n + (a ? " !important" : ""))
                                            }), s
                                        }, objectToCss: function (e) {
                                            var r = 1 < arguments.length && void 0 !== arguments[1] && arguments[1],
                                                i = "";
                                            return x.each(e, function (e, t) {
                                                r && (t = t.replace("!important", "").trim() + " !important"), i += e + ":" + t + ";"
                                            }), i
                                        }, removeRuleByMatchingSelector: function (e, t) {
                                            var r = TVE.getActiveStylesheet().key;
                                            if (!this[r][e] || !t) return this;
                                            for (var i = 0, n = this[r][e].cssRules[i]; n;) n.selectorText.match(t) ? this[r][e].deleteRule(i) : i++, n = this[r][e].cssRules[i]
                                        }, reorderMediaRules: function () {
                                            var a = this, s = TVE.getActiveStylesheet().key;
                                            jQuery.each(TVE.main.responsive, function (e, t) {
                                                var r = a.media_rule(t.media), i = function (e) {
                                                    for (var t = 0; t < TVE.stylesheet.cssRules.length; t++) if (TVE.stylesheet.cssRules[t] === e) return t;
                                                    return null
                                                }(r);
                                                if (r) {
                                                    var n = r.cssText;
                                                    delete a[s][t.media], TVE.stylesheet.deleteRule(i), a.media_rule(t.media, function () {
                                                        for (var e = 0, t = 0; t < TVE.stylesheet.cssRules.length; t++) TVE.stylesheet.cssRules[t].type === CSSRule.IMPORT_RULE && e++;
                                                        return e
                                                    }() + t.rule_index, n)
                                                }
                                            })
                                        }, get_used_css_variables: function () {
                                            for (var e = TVE.getActiveStylesheet().sheet.cssRules, t = [], r = 0; r < e.length; r++) {
                                                var i = e[r];
                                                if (i.type === CSSRule.MEDIA_RULE && 0 < i.cssRules.length) for (var n = 0; n < i.cssRules.length; n++) {
                                                    var a = i.cssRules[n].cssText.match(/--tcb-(color|gradient)-[0-9a-zA-Z]*/g),
                                                        s = i.cssRules[n].selectorText.replace(":hover", "").replace(".tve-state-hover", "");
                                                    if (a && 0 < TVE.inner_$(s).length) for (var o = 0; o < a.length; o++) {
                                                        var l = TVE.getRawCssVariableName(a[o]);
                                                        -1 === t.indexOf(l) && t.push(l)
                                                    }
                                                }
                                            }
                                            return t
                                        }, generate_hover_state_css: function (e) {
                                            if (-1 !== e.selectorText.indexOf(":hover")) {
                                                var t = e.selectorText.split(":hover").join(".tve-state-hover");
                                                return e.cssText.replace(e.selectorText, t)
                                            }
                                            return null
                                        }, getCssForSelector: function (a) {
                                            var s = this,
                                                o = !(1 < arguments.length && void 0 !== arguments[1]) || arguments[1],
                                                l = {"@imports": []}, c = this.getImports(), d = "string" == typeof a,
                                                _ = {};
                                            return x.each(TVE.main.responsive, function (e, n) {
                                                l[n.media] = {}, x.each(s.media_rule(n.media).cssRules, function (e, t) {
                                                    if (d && t.selectorText.includes(a) || !d && a.exec(t.selectorText)) {
                                                        var r = s.cssToObject(t.cssText);
                                                        r["font-family"] && (i = r["font-family"].replace(/ /g, "+").replace(/['"]/g, ""), void 0 === _[i] && (_[i] = !0, c.some(function (e) {
                                                            if (e.includes(i)) return l["@imports"].push(e), !0
                                                        }))), o ? l[n.media][t.selectorText] = r : l[n.media] = r
                                                    }
                                                    var i;
                                                    d || (a.lastIndex = 0)
                                                })
                                            }), l
                                        }, getRulesForSelector: function (n) {
                                            var i = this, a = TVE._.isRegExp(n), s = [];
                                            return x.each(TVE.main.responsive, function (e, t) {
                                                var r = i.media_rule(t.media);
                                                x.each(r.cssRules, function (e, t) {
                                                    var r, i;
                                                    r = t, i = void 0, a ? (i = n.exec(r.selectorText), n.lastIndex = 0) : i = r.selectorText.includes(n), i && s.push(t)
                                                })
                                            }), s
                                        }, getImportCss: function (t) {
                                            var r = null;
                                            return TVE._.some(TVE.getActiveStylesheet().sheet.cssRules, function (e) {
                                                if (e.type === CSSRule.IMPORT_RULE && e.cssText.includes(t.replace(/ /g, "+").replace(/['"]/g, ""))) return r = e.cssText, !0
                                            }), r
                                        }
                                    }, e.remove_element_overlay = function () {
                                        TVE.overlaySensor && TVE.overlaySensor.disconnect(), delete TVE.overlaySensor, x(".tve-element-mask").remove()
                                    }, e.body_overlay = function (e) {
                                        if (e = void 0 === e ? {} : e, !x(".tve-background-overlay").length) {
                                            var t = x('<div class="tve-background-overlay"></div>').css(e);
                                            TVE.inner.$body.append(t)
                                        }
                                    }, e.remove_body_overlay = function () {
                                        x(".tve-background-overlay").remove()
                                    }, e.generateElementPreview = function (e, t, r, i) {
                                        var n = x('<div id="tcb-template-clone-elem" style="position: absolute; left: -8000px; bottom: -5000px;"></div>').append(e.clone());
                                        TVE.inner.jQuery("body").prepend(n), n.find("img").removeAttr("srcset"), TVE.inner.window.domtoimage.toBlob(n.children().first()[0], {
                                            style: {
                                                padding: "0",
                                                margin: "0",
                                                outline: "none"
                                            }
                                        }).then(function (e) {
                                            n.remove(), "function" == typeof r && (i.append("img_data", e, i.get("template_name") + ".png"), r(t, i))
                                        }).catch(function (e) {
                                            console.error("oops, something went wrong!", e), r(t, i)
                                        })
                                    }, t.exports = e
                                }(jQuery)
                            }, "jquery-plugins.js": function (e, t, r) {
                                jQuery.fn.tve_social = function () {
                                    var t = this, r = this.hasClass("thrv_social_default") ? "default" : "custom";
                                    return {
                                        getRequiredSDKs: function () {
                                            var e = [];
                                            return "default" === r && t.find(".tve_s_item").each(function () {
                                                e.push(e[this.getAttribute("data-s")])
                                            }), e
                                        }
                                    }
                                }
                            }, "landing-fonts.js": function (e, t, r) {
                                var n, i;
                                n = jQuery, i = {
                                    $main_menu: null, addToGlobals: function (e, t, r) {
                                        TVE.CONST.tve_globals.landing_fonts[e] = TVE.CONST.tve_globals.landing_fonts[e] || {}, TVE.CONST.tve_globals.landing_fonts[e][t] = r
                                    }, getSelectorMenu: function (e) {
                                        return this.$main_menu ? this.$main_menu.find('ul.tve_menu[data-selector="' + e + '"]') : null
                                    }, fontUsed: function (r) {
                                        if (!TVE.CONST.tve_globals.landing_fonts) return !1;
                                        var i = !1;
                                        return n.each(TVE.CONST.tve_globals.landing_fonts, function (e, t) {
                                            t.css_class !== r || (i = !0)
                                        }), i
                                    }
                                }, t.exports = i
                            }, "selection-manager.js": function (e, t, r) {
                                var n, a;
                                n = jQuery, t.exports = {
                                    selectors: r("./selectors"), $root: null, is_disabled: function () {
                                        var e = this.$root.find(".canvas-mode").length;
                                        return TVE.Editor_Page.is_disabled() && !e
                                    }, add_icons: function () {
                                        n(document).on("mousedown.tcb", n.proxy(this.click_blur, this)).on("keyup.tcb", n.proxy(this.keyup_blur, this)).on("mouseleave.tcb", ".tcb-action-icons", n.proxy(function (e) {
                                            TVE.state() === TVE.STATE_EDIT || e.relatedTarget && "path" === e.relatedTarget.tagName.toLowerCase() || this.hide_icons()
                                        }, this))
                                    }, hide_icons: function () {
                                        return TVE.ElementIcons.hide_icons(), this
                                    }, hide_edit_icons: function () {
                                        return TVE.ElementEditIcons.hide_icons(), this
                                    }, hide_all_icons: function () {
                                        return this.hide_icons().hide_edit_icons(), this
                                    }, show_icons: function (e) {
                                        return TVE.ElementIcons.show_icons(e), this
                                    }, show_edit_icons: function (e) {
                                        return TVE.ElementEditIcons.show_icons(e), this
                                    }, init: function (e) {
                                        this.add_icons(), this.$root = e;
                                        var t = this.selectors.get("editable");
                                        e.off("mouseenter.tcb mouseover.tcb mouseleave.tcb mousedown.tcb click.tcb").on("mouseover.tcb", this.selectors.get("mouseover"), n.proxy(this.mouseover, this)).on("mouseleave.tcb", this.selectors.get("mouseover"), n.proxy(this.mouseleave, this)).on("mousedown.tcb", n.proxy(this.prevent_focus, this)).on("click.tcb", t, n.proxy(this.element_click, this))
                                    }, blur: function (e) {
                                        if (!this.is_disabled()) {
                                            var t = n(".edit_mode");
                                            TVE.froala.editor && t.length && (TVE.froala.has_selection() && TVE.froala.editor.selection.clear(), TVE.froala.editor.popups.hideAll()), t.removeClass("edit_mode"), (e = void 0 === e || e) && this.hide_all_icons(), TVE.main.clear_focus(), TVE.do_action("tcb.focus.clear")
                                        }
                                    }, keyup_blur: function (e) {
                                        if (27 === e.which && !TVE.prevent_blur) {
                                            if (!TVE.ActiveElement && TVE.main.EditMode.in_edit()) return TVE.main.EditMode.exit();
                                            document.activeElement && document.activeElement.blur(), TVE.Editor_Page.blur()
                                        }
                                    }, click_blur: function (e) {
                                        var t = n(e.target);
                                        return !!(t.closest(".edit_mode").length || e.target.classList.contains("no-blur") || t.closest(".tve-froala").length || t.closest(".no-blur").length || TVE.prevent_blur || t.closest(this.selectors.get("editable")).not(".tve_lp").length || e.target.classList.contains("ui-resizable-handle")) || !1 !== TVE.apply_filters("tcb.click_blur", !0, t) && (TVE.Editor_Page.blur(), !0)
                                    }, element_click: function (e, t) {
                                        if (TVE.do_action("tcb.element.click", e, t), n(e.target).is(TVE.TEXT_ALL)) return !1;
                                        var r = n(e.currentTarget);
                                        if (n(e.target).closest(this.selectors.get("editable") + ",.thrv_text_element,.thrv_heading").attr("class") !== a && (TVE.Editor_Page.GLOBAL_PREVENT_FOCUS || window.getSelection && window.getSelection().toString())) return !1;
                                        if (e.target.classList.contains("ui-resizable-handle") || r.hasClass("symbol-edit-mode") && !r.is(".thrv_header, .thrv_footer")) return !1;
                                        if (!this.allow_state_selection(r)) return !0;
                                        if (e.target.classList.contains("tcb-click")) return !0;
                                        var i = r.children(".tcb-inline-placeholder-action");
                                        return !(i.length && i[0] !== e.target && !n.contains(i[0], e.target) || (e.preventDefault(), (!r.is(this.selectors.get("not_editable")) || (r = r.parents(".thrv_wrapper").not(this.selectors.get("not_editable")).first()).length) && (TVE.apply_filters("tcb.element.editable", !0, r) && TVE.Editor_Page.focus_element(r, e, t), 1)))
                                    }, prevent_focus: function (e) {
                                        if (n(e.target).is("input, textarea, select") && e.preventDefault(), a = n(e.target).closest(this.selectors.get("editable") + ",.thrv_text_element,.thrv_heading").attr("class"), !1 === TVE.apply_filters("tcb.prevent_focus", !0)) return !1
                                    }, mouseleave: function (e) {
                                        this.is_disabled() || e.relatedTarget && n(e.relatedTarget).closest("." + TVE.ElementIcons.className).length || (this.hide_icons(), TVE.do_action("tcb.element.mouseleave", e))
                                    }, mouseover: function (e) {
                                        if (this.is_disabled()) return !1;
                                        var t = n(e.currentTarget);
                                        return !this.allow_state_selection(t) || !!t.is(this.selectors.get("no_highlight")) || !e.target.classList.contains("ui-resizable-handle") && (TVE.state() !== TVE.STATE_EDIT || !t.hasClass("edit_mode")) && (this.hide_icons(), this.show_icons(t), t.hasClass("thrv-inline-text") || (TVE.main.EditMode.in_edit() && !t.is(TVE.main.EditMode.element()) && t.closest(TVE.main.EditMode.element()).trigger("mouseenter"), e.stopPropagation()), void TVE.do_action("tcb.element.mouseover", e, t))
                                    }, allow_state_selection: function (e) {
                                        if (TVE.state_manager.is_default()) return !0;
                                        var t = TVE._type(e);
                                        return TVE.Elements[t] && TVE.Elements[t][TVE.state_manager.get_state()]
                                    }, select_element: function (e) {
                                        var t = n.Deferred(), r = e.hasClass("tve-state-hover");
                                        return e.addClass("tve-state-hover"), e.trigger("click", {emulate: !0}), setTimeout(function () {
                                            r || e.removeClass("tve-state-hover"), e.trigger("mouseleave"), setTimeout(function () {
                                                t.resolve()
                                            }, 20)
                                        }, 10), t.promise()
                                    }
                                }
                            }, "selectors.js": function (e, t, r) {
                                t.exports = {
                                    editable: ".thrv_wrapper:not(.thrv_text_element, .thrv_heading), .tve_ts_o span, span.tve_ts_copy-aut, .tve_ts_copy-aut span .tve_btnLink span, .tve_ct_title, .thrv_tw_qs_button span span, .tve_editable, .thrv-inline-text, .thrv-advanced-inline-text, .thrv-styled-list-item, .sub-menu, .tve_faqB h4, .canvas-mode .tve_lg_input_container, .tcb-col, .tve-cf-item, .tve-form-item, .tve-cf-submit, .tve-form-submit, .tve-cf-item label, .tve-form-item label, .tve-cf-item .tve-cf-input, .tve-form-item .tve-form-input, .thrv_header, .thrv_footer",
                                    not_editable: ".tcb-not-editable, .tcb-not-editable *, .thrive_leads_shortcode *, .thrive-shortcode-html:not(.thrive-shortcode-html-editable), .thrive-shortcode-html:not(.thrive-shortcode-html-editable) *, .tve_custom_html_placeholder, .tve_custom_html_placeholder *, .thrv_custom_html_shortcode *, .thrv_post_grid *, .tve_no_edit, .tve_more_tag, .table_placeholder,  .table_placeholder *, .image_placeholder, .image_placeholder *, .borderless_placeholder, .borderless_placeholder *, .ui-datepicker-header *, .tve_wp_shortcode *, #tve_mce_holder *, .code_placeholder, .thrv_widget *, .tve_ts_o img,.thrv_lead_generation .thrv-columns,.thrv_lead_generation .tcb-col,.thrv_lead_generation:not(.canvas-mode) .thrv_icon,.thrv-contact-form .thrv-columns,.tve-m-trigger .thrv_icon",
                                    mouseover: ".thrv_wrapper:not(.canvas-mode .thrv-columns):not(.tve-m-trigger .thrv_icon), .tve_clearfix li,.sub-menu,.thrv_feature_grid .tve_gri > .tve_image,.tve_element_hover, p.tve_more_tag, .tcb-col, .tve_faqB h4, .tve_editable, .canvas-mode .tve_lg_input_container, .thrv-styled-list-item, .tve_faq, .tve-cf-item, .tve-form-item, .tve-cf-submit, .tve-form-submit, .tve-cf-item label, .tve-form-item label, .tve-cf-input, .tve-form-input",
                                    no_highlight: ".thrive-shortcode-html, .thrive_leads_shortcode *, .tcb-no-highlight,.thrv_lead_generation:not(.canvas-mode) .thrv_icon,.thrv_lead_generation .thrv-columns,.thrv_lead_generation:not(.canvas-mode) .tcb-col,.thrv-contact-form .thrv-columns",
                                    no_icons: ".tve_table_cell, .thrv_tw_quote p, .tve_p_lb_control, .tve_editor_main_content,.tve_lp_content, .tve_no_icons, .thrv_widget_menu .tve_menu_title, .tve_lg_input_container .thrv_icon,.thrive-shortcode-html, .thrive-shortcode-html *, .tve_faqB h4, .tve_editable,.tve_lead_generated_inputs_container .thrv-columns, .thrv_lead_generation .thrv_icon,.canvas-mode",
                                    no_clone: ".tve_gri .image_placeholder, .table_placeholder, .tcb-no-clone, .tve_no_duplicate, .tve_more_tag, .tcb-col, .thrv-inline-text, .thrv-advanced-inline-text, .thrv_header, .thrv_footer,.tve-cf-item, .tve-cf-submit, .tve-form-submit, .tve_lg_input_container",
                                    no_delete: ".tcb-no-delete, .thrv-inline-text, .thrv-advanced-inline-text,.tve-cf-item, .tve-cf-submit, .tve-form-submit, .tve_lg_input_container",
                                    no_save: ".tcb-no-save, .thrv_symbol, .thrv-inline-text, .tcb-col, .tve_lg_input_container, .thrv_custom_html_shortcode, .tve_wp_shortcode, .tve_more_tag,.thrive_leads_shortcode ,.thrive-quiz-builder-shortcode, .thrv_tvo_capture_testimonials, .thrv_tvo_display_testimonials, .thrive_ultimatum_shortcode,.thrv-comments, .thrv-styled-list-item, .tcb-numbered-list-number, .tve_scT, .tve_scT *, .thrv_ct_symbol, .thrv-lp-text, .tve_faq, .tve-cf-item, .tve-cf-submit, .thrv-content-block *",
                                    no_lock: ".thrv_wrapper, .thrv-styled-list-item, .thrv-inline-text, .tcb-col, .tve_more_tag, .tve_scT, .tve_scT *,.tve_lg_input_container",
                                    no_unlock: ".thrv_wrapper, .thrv-styled-list-item, .thrv-inline-text, .tcb-col, .tve_more_tag, .tve_scT, .tve_scT *,.tve_lg_input_container",
                                    elements: ".thrv_wrapper,.tcb-col,.tve_lg_input_container,.tve-cf-item,.tve-cf-submit",
                                    no_title: ".tcb-no-title,.thrv_widget_menu li",
                                    get: function (e) {
                                        var t = null, r = TVE.apply_filters("wrapper_selector", "");
                                        return void 0 !== this[e] && (t = TVE.apply_filters("selectors_" + e, this[e])), r && -1 === t.indexOf(r) && (t = r + " " + t.split(",").join("," + r + " ").replace(/\s\s+/g, " ")), t += ",.tcb-selector-" + e + ",.tcb-child-selector-" + e + " *"
                                    }
                                }
                            }, table: {
                                "cell-manager.js": function (e, t, r) {
                                    var o = r("./grid"), n = [], l = r("../../../../main/libs/element-snapshot");
                                    !function (s) {
                                        s.fn.extend({
                                            tve_rows: function () {
                                                return 0 === arguments.length ? parseInt(this.attr("data-rows")) : this.attr("data-rows", arguments[0])
                                            }, tve_cols: function () {
                                                return 0 === arguments.length ? parseInt(this.attr("data-cols")) : this.attr("data-cols", arguments[0])
                                            }
                                        });
                                        var e = {
                                            table: null,
                                            $el: null,
                                            buttons: null,
                                            drag: {
                                                mouse_down: !1,
                                                start_element: null,
                                                current_element: null,
                                                is_head: !1
                                            },
                                            mouse_move_cells: "> thead > tr > th:not(.tve_merge_disabled), > tbody > tr > td:not(.tve_merge_disabled)",
                                            head_cells: "> thead > tr > th",
                                            body_cells: "> tbody > tr > td",
                                            head: null,
                                            body: null,
                                            grid: null,
                                            init: function (e) {
                                                var t = !0;
                                                void 0 !== e && (t = !1, n = [], this.table = e), TVE.ElementEditIcons.hide_icons(), this.head = this.table.find("> thead"), this.body = this.table.find("> tbody"), this.$el = this.table.parent().addClass("canvas-mode"), this.table.addClass("tve_merge_cells").find("th, th *, td, td *").disableSelection(), this.buttons || (this.buttons = s("#tcb-table-panel")), TVE.Editor_Page.disable(), TVE.Editor_Page.GLOBAL_PREVENT_FOCUS = !0, TVE.main.switch_menu_to("custom", "table"), TVE.main.toggle_navigation(!0), this.showActionButtons(), this.bind(), this.table.tve_rows(0);
                                                var r = this.__head_grid = new o(this.head, !0),
                                                    i = this.__body_grid = new o(this.body, !0);
                                                (isNaN(this.table.tve_cols()) || isNaN(this.table.tve_rows())) && (this.table.tve_rows(r.getRowCount() + i.getRowCount()), this.table.tve_cols(Math.max(r.getColCount(), i.getColCount()))), t && n.length ? (s.each(n, function (e) {
                                                    0 === e ? this.cell.trigger("mousedown") : this.cell.trigger("mousemove")
                                                }), n[n.length - 1].cell.trigger("mouseup")) : this.enableButtons(this.table.data("selected-cells") || [])
                                            },
                                            showActionButtons: function () {
                                                this.buttons.show().find(".tcb-table-btn").off("click").on("click", s.proxy(this.onActionClick, this)).on("mousedown", function () {
                                                    return !1
                                                }), this.positionButtons()
                                            },
                                            positionButtons: function () {
                                                var e = this.$el.offset(),
                                                    t = TVE.Editor_Page.$body.offsetParent().offset(),
                                                    r = e.top - t.top;
                                                this.buttons.css({
                                                    left: e.left - t.left + "px",
                                                    top: r + "px",
                                                    width: this.$el.outerWidth()
                                                }).find(".below-element").css("top", this.$el.outerHeight() + "px"), this.buttons.find(".above-element").css("top", r < 25 ? -1 * (r + 20) + "px" : "auto")
                                            },
                                            saveSelection: function () {
                                                n = this.table.data("selected-cells") || []
                                            },
                                            clearSelection: function () {
                                                n = []
                                            },
                                            onActionClick: function (e) {
                                                var t = e.currentTarget.getAttribute("data-fn");
                                                if (this[t]) return this[t](e.currentTarget.getAttribute("data-arg") || null)
                                            },
                                            bind: function () {
                                                this.table.off().on("mousedown", this.head_cells + ", " + this.body_cells, jQuery.proxy(this.mouseDown, this)), this.table.on("mousemove", this.mouse_move_cells, jQuery.proxy(this.mouseOver, this)), this.table.on("mouseup", this.head_cells + ", " + this.body_cells, jQuery.proxy(this.mouseUp, this)), s(TVE.Editor_Page).bind("editor.onenable", jQuery.proxy(this.cancel, this))
                                            },
                                            mouseDown: function (e) {
                                                var t = s(e.currentTarget);
                                                return this.reset(), this.drag.mouse_down = !0, this.drag.start_element = t.addClass("tve_merge_selected"), t.is("td") ? (this.table.find(this.head_cells).addClass("tve_merge_disabled"), this.drag.is_head = !1) : (this.table.find(this.body_cells).addClass("tve_merge_disabled"), this.drag.is_head = !0), this.grid = new o(this.drag.is_head ? this.head : this.body, !1), this.grid.setStartCell(this.drag.start_element), !1
                                            },
                                            mouseUp: function (e) {
                                                this.drag.mouse_down = !1, !this.table.data("selected-cells") && this.grid && this.table.data("selected-cells", this.grid.getRange(this.drag.start_element, s(e.currentTarget))), this.table.find(".tve_merge_disabled").removeClass("tve_merge_disabled"), this.enableButtons(this.table.data("selected-cells"))
                                            },
                                            enableButtons: function (e) {
                                                if (this.buttons.find(".m-disable").prop("disabled", !0), this.$el.addClass("edit_mode").find(".edit_mode").removeClass("edit_mode"), TVE.main.switch_menu_to("custom", "table"), e && !(e.length < 1)) if (1 < e.length) this.buttons.find(".m-enable-more").prop("disabled", !1); else {
                                                    this.buttons.find(".m-enable-one").prop("disabled", !1);
                                                    var t = 2 < parseInt(e[0].cell.attr("rowspan") || 1) + parseInt(e[0].cell.attr("colspan") || 1);
                                                    this.buttons.find('[data-fn="split"]').prop("disabled", !t);
                                                    var r = e[0].cell;
                                                    this.select_element(r), r.__col = (this.head.find("> tr").length ? this.__head_grid : this.__body_grid).getCell(0, e[0].real_col), r.__row = r.parent().children("td,th").first(), 0 !== e[0].real_col && this.__body_grid.canMoveColumn(e[0], -1) && this.__head_grid.canMoveColumn(e[0], -1) || this.buttons.find(".move-left").prop("disabled", !0), e[0].real_col + e[0].colspan !== this.grid.grid[0].length && this.__body_grid.canMoveColumn(e[0], 1) && this.__head_grid.canMoveColumn(e[0], 1) || this.buttons.find(".move-right").prop("disabled", !0)
                                                }
                                            },
                                            select_element: function (e) {
                                                this.$el.removeClass("edit_mode").find("td,th").removeClass("edit_mode"), TVE.Editor_Page.focus_element(e)
                                            },
                                            mouseOver: function (e) {
                                                if (!this.drag.mouse_down) return !1;
                                                this.table.find("td,th").removeClass("tve_merge_selected"), this.drag.current_element = s(e.currentTarget);
                                                var t = this.grid.getRange(this.drag.start_element, this.drag.current_element);
                                                this.table.data("selected-cells", t), s.each(t, function () {
                                                    this.cell.addClass("tve_merge_selected").removeClass("edit_mode")
                                                })
                                            },
                                            reset: function (e) {
                                                (e = void 0 !== e && e) || this.table.find(".tve_merge_selected").removeClass("tve_merge_selected"), this.table.find(".tve_merge_disabled").removeClass("tve_merge_disabled"), this.table.data("selected-cells", null).data("selected-colspan", null).data("selected-rowspan", null), this.drag = {
                                                    mouse_down: !1,
                                                    start_element: null,
                                                    current_element: null,
                                                    is_head: !1
                                                }
                                            },
                                            cancel: function (e) {
                                                return e = void 0 !== e && e, this.buttons.hide(), this.reset(e), this.table.removeClass("tve_merge_cells tve_table_light").off().find("th, th *, td, td *").enableSelection(), this.$el.removeClass("canvas-mode"), s(TVE.Editor_Page).unbind("editor.onenable"), TVE.Editor_Page.enable(), delete TVE.Editor_Page.GLOBAL_PREVENT_FOCUS, this.select_element(this.$el), TVE.main.toggle_navigation(!1), this
                                            },
                                            merge: function () {
                                                var e = this;
                                                if (this.table.data("selected-cells")) {
                                                    var r = !0, i = s(), n = "", a = s();
                                                    jQuery.each(this.table.data("selected-cells"), function (e) {
                                                        if (0 === e) i = this.cell; else {
                                                            a = a.add(this.cell);
                                                            var t = this.cell.html();
                                                            t.includes("tcb-replaceable-placeholder") || (n += t, r = !1)
                                                        }
                                                    }), this.clearSelection(), this.cancel(), l(function () {
                                                        n = s(n), i.html().includes("tcb-replaceable-placeholder") && !r && i.empty(), i.attr({
                                                            rowspan: e.grid.selection_rowspan,
                                                            colspan: e.grid.selection_colspan
                                                        }).append(n), TVE.drag.bind_draggable(n), (1 < e.grid.selection_rowspan || 1 < e.grid.selection_colspan) && (TVE.Components.table.disable_sort(), e.table.removeClass("tve_make_sortable")), a.remove()
                                                    }, this.table), this.init()
                                                }
                                            },
                                            split: function () {
                                                if (this.table.data("selected-cells")) {
                                                    var e = this.table.data("selected-cells"), t = this.grid;
                                                    this.clearSelection(), this.cancel(), l(function () {
                                                        jQuery.each(e, function () {
                                                            if (1 == this.colspan && 1 == this.rowspan) return !0;
                                                            t.split(this)
                                                        })
                                                    }, this.table), this.init()
                                                }
                                            },
                                            addRow: function () {
                                                var e, t = this, r = this.table.tve_rows(), i = this.table.tve_cols();
                                                e = new o(0 === r ? this.head : this.body), this.saveSelection(), this.cancel(), l(function () {
                                                    t.table.tve_rows(r + 1), 0 !== i && (e.insertRow(e.grid.length - 1, "after", i), t.alternateColors())
                                                }, this.table), this.init()
                                            },
                                            addColumn: function () {
                                                var e = this, t = this.table.tve_rows(), r = this.table.tve_cols();
                                                this.saveSelection(), this.cancel(), l(function () {
                                                    e.table.tve_cols(r + 1), 0 !== t && (e.table.find("> thead > tr").length && new o(e.head).insertColumn(r - 1, "after", e.table.find("> thead > tr").length), e.table.find("> tbody > tr").length && new o(e.body).insertColumn(r - 1, "after", t - e.table.find("> thead > tr").length))
                                                }, this.table), this.init()
                                            },
                                            removeColumn: function () {
                                                var r = this;
                                                if (this.drag.start_element) {
                                                    var i = this.drag.start_element, n = this.drag.is_head;
                                                    this.clearSelection(), this.cancel(), l(function () {
                                                        var e = r.grid.selection_start.col, t = r.grid.removeColumn(i);
                                                        n ? new o(r.body).removeColumn(null, e, t) : new o(r.head).removeColumn(null, e, t), r.table.tve_cols(r.table.tve_cols() - t)
                                                    }, this.table), this.init()
                                                }
                                            },
                                            removeRow: function () {
                                                var t = this;
                                                if (this.drag.start_element) {
                                                    var r = this.drag.start_element, i = new o(r.parent().parent());
                                                    this.cancel(), this.clearSelection(), l(function () {
                                                        var e = i.removeRow(r);
                                                        t.table.tve_rows(t.table.tve_rows() - e), r.is("th") && (TVE.Components.table.disable_sort(), t.table.removeClass("tve_make_sortable")), t.alternateColors()
                                                    }, this.table), this.init()
                                                }
                                            },
                                            insertColumn: function (t) {
                                                var r = this;
                                                this.drag.start_element && (this.saveSelection(), this.cancel(), l(function () {
                                                    var e = r.grid["before" === t ? "selection_start" : "selection_end"].col;
                                                    r.table.tve_cols(r.table.tve_cols() + 1), 0 !== r.table.tve_rows() && (r.table.find("> thead > tr").length && new o(r.table.find("> thead")).insertColumn(e, t, r.table.find("> thead > tr").length), r.table.find("> tbody > tr").length && new o(r.table.find("> tbody")).insertColumn(e, t, r.table.tve_rows() - r.table.find("> thead > tr").length))
                                                }, this.table), this.init())
                                            },
                                            insertRow: function (e) {
                                                var t = this;
                                                if (this.drag.start_element) {
                                                    var r = this.grid["before" === e ? "selection_start" : "selection_end"];
                                                    this.saveSelection(), this.cancel(), l(function () {
                                                        t.table.tve_rows(t.table.tve_rows() + 1), 0 !== t.table.tve_cols() && t.grid.insertRow(r.row, e, t.table.tve_cols(), r.col)
                                                    }, this.table), this.init()
                                                }
                                            },
                                            _move: function (e) {
                                                var t = this.table.data("selected-cells")[0], r = new o(this.head),
                                                    i = new o(this.body), n = void 0, a = void 0;
                                                return this.saveSelection(), this.cancel(), l(function () {
                                                    n = r.moveColumn(t, e), a = i.moveColumn(t, e)
                                                }, this.table), this.init(), (this.drag.is_head ? n : a).trigger("mousedown").trigger("mousemove").trigger("mouseup"), !1
                                            },
                                            moveLeft: function () {
                                                this._move(-1)
                                            },
                                            moveRight: function () {
                                                this._move(1)
                                            },
                                            alternateColors: function () {
                                                if (this.table.hasClass("tve_table_alternating")) {
                                                    var i = this.body.find("tr.tve_odd").first().attr("data-tve-custom-colour"),
                                                        n = this.body.find("tr.tve_even").first().attr("data-tve-custom-colour");
                                                    this.body.find("tr").each(function (e, t) {
                                                        var r = s(t);
                                                        r.removeClass("tve_odd tve_even"), r.addClass(e % 2 == 0 ? "tve_odd" : "tve_even"), i && e % 2 == 0 && r.attr("data-tve-custom-colour", i), n && e % 2 != 0 && r.attr("data-tve-custom-colour", n)
                                                    })
                                                }
                                            }
                                        };
                                        t.exports = e
                                    }(jQuery)
                                }, "editor.js": function (e, t, r) {
                                    var i = r("./cell-manager");

                                    function n(e, t) {
                                        for (var r = "", i = "th" === e ? "Header" : "Cell", n = 0; n < t; n++) r += "<" + e + ' class="tve_table_cell tcb-parent-placeholder-empty"><div class="tcb-replaceable-placeholder">' + i + "</div></" + e + ">";
                                        return '<tr class="tve_table_row">' + r + "</tr>"
                                    }

                                    function a() {
                                        i.init()
                                    }

                                    var s = {
                                        cell_manager: function (e) {
                                            return TVE.main.on("after_undo_redo", a), i.init(e.find("> .tve_table"))
                                        }, build: function (e, t) {
                                            var r = '<table data-rows="' + e + '" data-cols="' + t + '" class="tve_table tcb-fixed tve_no_inner_border tve_no_border tve_table_flat">';
                                            r += "<thead>" + n("th", t) + "</thead>", r += "<tbody>";
                                            for (var i = 1; i < e; i++) r += n("td", t);
                                            return r += "</tbody></table>"
                                        }, refresh: function () {
                                            i.positionButtons()
                                        }, close_editor: function () {
                                            TVE.main.off("after_undo_redo", a), i.cancel()
                                        }
                                    };
                                    t.exports = s
                                }, "grid.js": function (e, t, r) {
                                    !function (f) {
                                        function h(e) {
                                            return e = e.jquery ? e[0] : e, parseInt(e.getAttribute("rowspan") || 1)
                                        }

                                        function v(e) {
                                            return e = e.jquery ? e[0] : e, parseInt(e.getAttribute("colspan") || 1)
                                        }

                                        function u(e) {
                                            return e ? '<th class="tve_table_cell"></th>' : '<td class="tve_table_cell"></td>'
                                        }

                                        function p(e, t) {
                                            var r = e.clone();
                                            if (t) {
                                                var i = r.is("th") ? "Header" : "Cell";
                                                r.html('<div class="tcb-replaceable-placeholder">' + i + "</div>")
                                            }
                                            return r
                                        }

                                        var e = function (e, t) {
                                            var o = [];
                                            e.find("> tr").each(function (s) {
                                                f(this).find("> td, > th").each(function (e) {
                                                    var t, r, i, n, a = f(this);
                                                    if (o[s]) for (; o[s][e];) e++;
                                                    for (i = h(this), n = v(this), r = s; r < s + i; r++) for (o[r] || (o[r] = []), t = e; t < e + n; t++) o[r][t] = {
                                                        cell: a,
                                                        rowspan: i,
                                                        colspan: n,
                                                        exists: r == s && t == e,
                                                        processed: !1,
                                                        real_row: s,
                                                        real_col: e
                                                    }
                                                })
                                            }), this.grid = o, this.startPos = null, this.selection_colspan = 1, this.selection_rowspan = 1, this.container = e, this.is_head = e.is("thead"), this.selection_start = {
                                                row: null,
                                                col: null
                                            }, this.selection_end = {
                                                row: null,
                                                col: null
                                            }, void 0 !== t && t && (e.parent().tve_rows(parseInt(e.parent().tve_rows()) + this.grid.length), this.grid[0] && this.grid[0].length && e.parent().tve_cols(this.grid[0].length))
                                        };
                                        e.prototype.getRange = function (e, t) {
                                            var r = this.startPos, i = this.getCellPosition(t);
                                            if (!r || !i) return f();
                                            var n, a = Math.min(r.x, i.x), s = Math.max(r.x, i.x),
                                                o = Math.min(r.y, i.y), l = Math.max(r.y, i.y), c = s, d = 0, _ = !1;
                                            for (d = 0; n = this.grid[d++];) for (var h, v = 0; h = n[v++];) h.processed = !1;
                                            do {
                                                for (_ = !1, d = a; d <= c;) d += (h = this.grid[d][o]).rowspan, h.processed || h.exists || 1 < h.colspan && (o = h.real_col, _ = !0, h.processed = !0);
                                                for (v = o; v <= l;) v += (h = this.grid[a][v]).colspan, h.processed || h.exists || 1 < h.rowspan && (a = h.real_row, _ = !0, h.processed = !0);
                                                for (d = a; d <= c; d++) for (v = o; v <= l; v++) (h = this.grid[d][v]).exists && !h.processed && (1 < h.colspan && h.colspan - 1 + v > l && (l = v + h.colspan - 1, _ = !0, h.processed = !0), 1 < h.rowspan && h.rowspan - 1 + d > c && (c = d + h.rowspan - 1, _ = !0, h.processed = !0))
                                            } while (_);
                                            var u = [];
                                            for (d = a; d <= c; d++) for (v = o; v <= l; v++) this.grid[d][v] && this.grid[d][v].exists && u.push(this.grid[d][v]);
                                            return this.selection_rowspan = c - a + 1, this.selection_colspan = l - o + 1, this.selection_start.row = a, this.selection_start.col = o, this.selection_end.row = c, this.selection_end.col = l, u
                                        }, e.prototype.getCellPosition = function (e) {
                                            for (var t = 0, r = this.grid.length; t < r; t++) for (var i = 0, n = this.grid[t].length; i < n; i++) if (this.grid[t][i].cell[0] === e[0]) return {
                                                x: t,
                                                y: i
                                            };
                                            return null
                                        }, e.prototype.setStartCell = function (e) {
                                            this.startPos = this.getCellPosition(e)
                                        }, e.prototype.split = function (e) {
                                            var t = null;
                                            e.cell.attr("colspan", 1).attr("rowspan", 1);
                                            for (var r = 1; r < e.colspan; r++) t = p(e.cell, !1), e.cell.after(t), TVE.drag.bind_draggable(t);
                                            if (1 != e.rowspan) for (var i = e.cell.parent(), n = e.real_row + 1; n < e.real_row + e.rowspan; n++) if (0 != (i = i.next("tr")).find("> td, > th").length) {
                                                for (var a = e.real_col - 1; 0 <= a; a--) if (this.grid[n][a].real_row == n) {
                                                    for (s = 0; s < e.colspan; s++) t = p(e.cell, !1), this.grid[n][a].cell.after(t), TVE.drag.bind_draggable(t);
                                                    break
                                                }
                                                if (0 == e.real_col || -1 == a) for (s = 0; s < e.colspan; s++) t = p(e.cell, !1), i.prepend(t), TVE.drag.bind_draggable(t)
                                            } else for (var s = 0; s < e.colspan; s++) t = p(e.cell, !1), i.append(t), TVE.drag.bind_draggable(t)
                                        }, e.prototype.removeColumn = function (e, t, r) {
                                            e && (r = v(e), t = this.getCellPosition(e).y);
                                            for (var i, n = 0; i = this.grid[n++];) for (var a = t; a < t + r; a++) {
                                                var s = i[a];
                                                1 == s.colspan || e && s.cell[0] === e[0] ? s.cell.remove() : s.real_col >= t && s.real_col + s.colspan <= t + r ? s.cell.remove() : 1 < s.colspan ? s.real_col <= t ? s.real_col + s.colspan >= t + r ? s.cell.attr("colspan", s.colspan - r) : s.cell.attr("colspan", Math.abs(t - s.real_col)) : s.cell.attr("colspan", s.real_col + s.colspan - t - r) : s.cell.remove()
                                            }
                                            return r
                                        }, e.prototype.removeRow = function (e) {
                                            for (var t = h(e), r = this.getCellPosition(e), i = f(), n = r.x; n <= r.x + t - 1; n++) for (var a = 0; a < this.grid[r.x].length; a++) {
                                                var s = this.grid[n][a];
                                                if (a != r.y && 1 != h(s.cell)) if (s.exists) if (h(s.cell) + n <= r.x + t) ; else {
                                                    var o = r.x + t - n,
                                                        l = p(s.cell, !1).attr("rowspan", h(s.cell) - o);
                                                    s.cell.attr("rowspan", o);
                                                    var c = e.parent().next(), d = r.x + t;
                                                    if (0 < c.length) {
                                                        0 == c.find("> td, > th").length && c.append(l);
                                                        for (var _ = s.real_col - 1; 0 <= _; _--) if (this.grid[d][_].real_row == d) {
                                                            this.grid[d][_].cell.after(l);
                                                            break
                                                        }
                                                        0 != s.real_col && -1 != _ || c.prepend(l)
                                                    }
                                                } else s.cell.attr("rowspan", h(s.cell) - 1), a += v(s.cell) - 1; else i = i.add(this.container.find("> tr:nth-child(" + (n + 1) + ")"))
                                            }
                                            return i.remove(), t
                                        }, e.prototype.insertColumn = function (e, t, r) {
                                            for (var i = u(this.is_head), n = this.grid[0] && this.grid[0].length, a = f(), s = 0; s < r; s++) {
                                                var o = n ? this.grid[s][e] : null;
                                                if (o) {
                                                    var l = p(o.cell, !0).attr("colspan", "1").attr("rowspan", "1"),
                                                        c = this.getRealRow(s), d = !1;
                                                    if (e != this.grid[0].length - 1 || "after" != t) if (0 != e || "before" != t) if (1 < o.colspan && ("after" == t && o.real_col + o.colspan - 1 > e ? (o.cell.attr("colspan", o.colspan + 1), d = !0) : "before" == t && o.real_col < e && (o.cell.attr("colspan", o.colspan + 1), d = !0)), d) s += o.rowspan - 1; else {
                                                        var _ = t;
                                                        if (null === (o = "after" == t ? this.getLastRealCell(s, e) : this.getNextRealCell(s, e)) && (o = "after" == t ? this.getNextRealCell(s, e) : this.getLastRealCell(s, e), _ = "after" == t ? "before" : "after"), null === o) {
                                                            c.append(l), a = a.add(l);
                                                            continue
                                                        }
                                                        o.cell[_](l), a = a.add(l)
                                                    } else c.prepend(l), a = a.add(l); else c.append(l), a = a.add(l)
                                                } else c = (c = this.container.find("> tr:nth-child(" + (s + 1) + ")")).length ? c : f('<tr class="tve_table_row"></tr>').appendTo(this.container), a = a.add(f(i)), c.append(a.last())
                                            }
                                            TVE.drag.bind_draggable(a)
                                        }, e.prototype.insertRow = function (e, t, r) {
                                            var i = u(this.is_head), n = f('<tr class="tve_table_row"></tr>');
                                            if (-1 !== e) {
                                                for (var a = this.getRealRow(e), s = f(), o = 0; o < r; o++) {
                                                    var l = this.grid[e][o], c = !1;
                                                    1 < l.rowspan && ("after" == t && l.real_row + l.rowspan - 1 > e ? (l.cell.attr("rowspan", l.rowspan + 1), c = !0) : "before" == t && l.real_row < e && (l.cell.attr("rowspan", l.rowspan + 1), c = !0)), c || (s = s.add(p(this.grid[e][o].cell, !0).attr({
                                                        rowspan: 1,
                                                        colspan: 1
                                                    })))
                                                }
                                                a[t](n.append(s)), TVE.Components.table.update_colors(), TVE.drag.bind_draggable(n)
                                            } else {
                                                for (var d = 0; d < r; d++) n.append(f(i));
                                                this.container.append(n)
                                            }
                                        }, e.prototype.getRealRow = function (e) {
                                            if (!this.grid[e]) return f();
                                            for (var t, r = 0; t = this.grid[e][r++];) if (t.real_row == e) return t.cell.parent();
                                            return this.container.find("tr:nth-child(" + ++e + ")")
                                        }, e.prototype.getLastRealCell = function (e, t) {
                                            if (!this.grid[e]) return null;
                                            for (var r = t; 0 <= r; r--) if (this.grid[e][r].real_row == e && this.grid[e][r].real_col == r) return this.grid[e][r];
                                            return null
                                        }, e.prototype.getNextRealCell = function (e, t) {
                                            if (!this.grid[e]) return null;
                                            for (var r = t, i = this.grid[e].length; r < i; r++) if (this.grid[e][r].real_row == e && this.grid[e][r].real_col == r) return this.grid[e][r];
                                            return null
                                        }, e.prototype.getRowCount = function () {
                                            return this.grid.length
                                        }, e.prototype.getColCount = function () {
                                            return this.grid[0] ? this.grid[0].length : 0
                                        }, e.prototype.getCell = function (e, t) {
                                            return this.grid[e][t].cell
                                        }, e.prototype.canMoveColumn = function (e, t) {
                                            var i = !0, n = e.real_col, a = n + t;
                                            return 0 < t && (a += e.colspan - 1), this.grid.some(function (e) {
                                                var t = e[n], r = e[a];
                                                if (r.exists !== t.exists && r.cell[0] !== t.cell[0] && r.colspan !== t.colspan) return !(i = !1)
                                            }), i
                                        }, e.prototype.moveColumn = function (e, t) {
                                            var s = e.real_col, o = s + t, l = e.real_row, c = f();
                                            return this.grid.forEach(function (e, t) {
                                                var r = e[s], i = e[o];
                                                if (i.exists && r.exists) {
                                                    var n = i.cell.clone(),
                                                        a = r.cell.clone().removeClass("tve_merge_selected edit_mode");
                                                    l === t && (c = a), i.cell.replaceWith(a), i.cell = a, r.cell.replaceWith(n), r.cell = n
                                                }
                                            }), c
                                        }, t.exports = e
                                    }(jQuery)
                                }
                            }
                        }
                    }
                }, main: {
                    libs: {
                        "element-snapshot.js": function (e, t, r) {
                            function l(e) {
                                var r = {html: e.html(), cls: e.attr("class"), style: e.attr("style"), data: {}};
                                return e.length && e[0].dataset && jQuery.each(e[0].dataset, function (e, t) {
                                    r.data[e] = t
                                }), r
                            }

                            function c(r, e) {
                                return r.length && e && (r.html(e.html).attr("class", e.cls).attr("style", e.style), jQuery.each(r.data(), function (e, t) {
                                    r.removeAttr("data-" + e)
                                }), jQuery.each(e.data, function (e, t) {
                                    r[0].dataset[e] = t
                                })), this
                            }

                            t.exports = function (e, t, r) {
                                var i, n = l(t), a = void 0, s = e.call(void 0 === r ? null : r);

                                function o() {
                                    a = l(t), TVE.UndoManager.add({
                                        undo: function () {
                                            c(t, n)
                                        }, redo: function () {
                                            c(t, a)
                                        }
                                    })
                                }

                                (i = s) && "function" == typeof i.then ? s.then(o) : o()
                            }
                        }
                    }
                }
            }
        }
    }
})("workspace/editor/js/editor/src/editor");