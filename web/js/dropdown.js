(function (a) {
    a.fn.shImageSelectDropdown = function (f) {
        var b;
        b = a.extend(!0, {
            theme: "arrows",
            expandDirection: "down",
            dropdownEffect: {
                open: "",
                close: ""
            },
            easing: {
                open: "",
                close: ""
            },
            showText: !0,
            animationSpeed: {
                open: 0,
                close: 0
            },
            imageLimit: 3,
            additionalClass: "",
            skin: "light",
            callbacks: {
                onOpen: "",
                onClose: "",
                onSelect: ""
            }
        }, f);
        return this.each(function () {
            a(this).data("sh-image-select-dropdown", new g(a(this), b))
        })
    };
    var g = function (f, b) {
            var c, w, d, h, l, m, g, t, s, j, e = this;
            this.container = a("<div></div>").addClass("sh-img-dropdown-container");
            this.selectBox = a("<div></div>").addClass("sh-img-dropdown-box");
            this.selectBoxOverlay = a("<div></div>").addClass("sh-img-dropdown-box-overlay");
            this.underOverlayLayer = a("<div></div>").addClass("sh-img-dropdown-under-overlay");
            this.list = a("<div></div>").addClass("sh-img-dropdown-list");
            this.listContainer = a("<div></div>").addClass("sh-img-dropdown-list-container");
            this.listScreen = a("<div></div>").addClass("sh-img-dropdown-list-screen");
            var y;
            y = !0;
            this.open = function () {
                v(q.currentEffect.open, b.animationSpeed.open, A.onOpen, b.callbacks.onOpen)
            };
            this.close = function () {
                v(q.currentEffect.close, b.animationSpeed.close, A.onClose, b.callbacks.onClose)
            };
            this.select = function (a) {
                f.children().removeAttr("selected").filter('[class="' + a.attr("id") + '"]').attr("selected", "selected");
                f.triggerHandler("change");
                z(a, b.callbacks.onSelect)
            };
            var u = function (c) {
                    var n, d, r, q;
                    b.showText ? (r = function (a) {
                        a.children("img").stop().fadeTo(300, 0.6);
                        a.children(".sh-img-dropdown-textblock").stop().animate({
                            bottom: "5px"
                        }, "fast")
                    }, q = function (a) {
                        a.children("img").stop().fadeTo(300, 1);
                        a.children(".sh-img-dropdown-textblock").stop().animate({
                            bottom: "-100%"
                        }, "fast")
                    }, n = r, d = q) : (r = function (a) {
                        a.children("img").stop().fadeTo(300, 0.6)
                    }, q = function (a) {
                        a.children("img").stop().fadeTo(300, 1)
                    }, d = n = function () {});
                    var f = !1,
                        j = !1;
                    u = {
                        mouse: {
                            doMouseClickImageActions: function (b) {
                                b.preventDefault();
                                e.select(a(this).children("img").css("opacity", 1));
                                e.close()
                            },
                            doMouseOverImageActions: function () {
                                r(a(this))
                            },
                            doMouseOutImageActions: function () {
                                q(a(this))
                            }
                        },
                        touch: {
                            doTouchStartImageActions: function (b) {
                                var d = a(this),
                                    r = d.children("img");
                                b.preventDefault();
                                f = !0;
                                setTimeout(function () {
                                    c.draggingInEventsCycleFlag() || (f ? (n(d), j = !0) : (e.select(r.css("opacity", 1)), e.close()))
                                }, 200)
                            },
                            doTouchEndImageActions: function () {
                                f = !1;
                                j && (d(a(this)), j = !1)
                            }
                        },
                        toggleDropDownListVisibility: function () {
                            e.listContainer.is(":hidden") ? e.open() : e.close()
                        }
                    }
                },
                v = function (b, c, n, d) {
                    e.listContainer.stop().animate(b, c, n, function () {
                        a.shHelper.callCallback(d, e.container)
                    })
                },
                z = function (b, c) {
                    e.selectBox.empty().prepend(b.clone());
                    c && a.shHelper.callCallback(c, e.container)
                };
            l = b.expandDirection;
            var p = "sh-img-dropdown-direction-";
            m = "vertical-expand";
            d = "y";
            var k = "height";
            c = !1;
            var n = {};
            switch (b.expandDirection) {
            default:
                p += l;
                c = !0;
                break;
            case "up":
                p += l;
                c = !0;
                n = {
                    open: {
                        "margin-top": "-100%"
                    },
                    close: {
                        "margin-top": "0"
                    }
                };
                break;
            case "right":
                p += l;
                k = "width";
                d = "x";
                m = "horizontal-expand";
                break;
            case "left":
                p += l;
                k = "width";
                d = "x";
                n = {
                    open: {
                        "margin-left": "-100%"
                    },
                    close: {
                        "margin-left": "0"
                    }
                };
                m = "horizontal-expand";
                break;
            case "left-right":
                p += l;
                k = "width";
                d = "x";
                n = {
                    open: {
                        "margin-left": "-50%"
                    },
                    close: {
                        "margin-left": "0"
                    }
                };
                m = "horizontal-expand";
                break;
            case "up-down":
                p += l, c = !0, n = {
                    open: {
                        "margin-top": "-50%"
                    },
                    close: {
                        "margin-top": "0"
                    }
                }
            }
            l = p;
            g = d;
            t = k;
            s = c;
            j = n;
            d = b.theme;
            c = "sh-img-dropdown-theme-";
            k = {};
            n = [];
            switch (d) {
            case "minimal":
                c += d;
                k = {
                    mouseover: {
                        element: e.selectBoxOverlay,
                        handler: function () {
                            e.underOverlayLayer.stop().fadeTo(300, 1)
                        }
                    },
                    mouseout: {
                        element: e.selectBoxOverlay,
                        handler: function () {
                            e.underOverlayLayer.stop().fadeOut()
                        }
                    }
                };
                n.push({
                    container: e.container,
                    element: a("<div></div>").addClass(c + "-arrow")
                });
                break;
            default:
                c += d
            }
            d = c;
            h = k;
            c = b.skin;
            n = "sh-img-dropdown-";
            k = "light";
            switch (c) {
            case "dark":
                n += c;
                k = "dark";
                break;
            default:
                n += c
            }
            c = n;
            w = k;
            var q, r = {
                expand: {
                    open: {
                        height: "show",
                        width: "show"
                    },
                    close: {
                        height: "hide",
                        width: "hide"
                    }
                },
                "vertical-expand": {
                    open: {
                        height: "show"
                    },
                    close: {
                        height: "hide"
                    }
                },
                "horizontal-expand": {
                    open: {
                        width: "show"
                    },
                    close: {
                        width: "hide"
                    }
                },
                fade: {
                    open: {
                        opacity: "show"
                    },
                    close: {
                        opacity: "hide"
                    }
                }
            };
            q = {
                currentEffect: {},
                effectExists: function (a) {
                    return "string" === typeof a && a in r
                },
                getDefaultEffectProps: function () {
                    return r["vertical-expand"]
                },
                getEffectProps: function (a) {
                    var b = !1;
                    this.effectExists(a) && (b = r[a]);
                    return b
                },
                getEffectPropsFromObj: function (b) {
                    var c = this,
                        e = {};
                    a.each(b, function (a, b) {
                        "object" === typeof b ? e[a] = b : c.effectExists(b) && (e[a] = c.getEffectProps(b)[a])
                    });
                    return e
                },
                pushEffect: function (b) {
                    var c = {};
                    "string" === typeof b ? this.effectExists(b) && (b = this.getEffectProps(b), c.open = b.open, c.close = b.close) : "object" === typeof b && (c = this.getEffectPropsFromObj(b));
                    a.extend(this.currentEffect, c)
                }
            };
            var A, k = b.easing,
                B, C;
            "string" === typeof k ? B = C = k : "object" === typeof k && ("open" in k && (B = k.open), "close" in k && (C = k.close));
            A = {
                onOpen: B,
                onClose: C
            };
            var G, D, E, F;
            if (void 0 === y) {
                e.list.append(e.listScreen);
                e.listContainer.append(e.list);
                e.container.append(e.listContainer, e.selectBox, e.underOverlayLayer, e.selectBoxOverlay);
                f.hide().after(e.container);
                e.container.addClass(c).addClass(l).addClass(d).addClass(b.additionalClass);
                var H = "";
                f.children().each(function (b) {
                    var c = a("<img>");
                    c.attr({
                        src: a(this).data("image"),
                        id: "sh-img-dropdown-image-" + b,
                        alt: ""
                    });
                    e.list.append(c);
                    a(this).addClass(c.attr("id"));
                    a(this).is(":selected") && (H = c.attr("id"))
                });
                G = H;
                q.pushEffect(m);
                q.pushEffect(b.dropdownEffect);
                e.list.imagesLoaded(function (c) {
                    var n = 0,
                        d = 0,
                        r;
                    c.each(function (c) {
                        var r = a("<div></div>").addClass("sh-img-dropdown-image-wrapper"),
                            q = a("<div></div>").addClass("sh-img-dropdown-textblock");
                        q.text(f.children("." + a(this).attr("id")).text());
                        r.append(a(this), q);
                        0 === b.imageLimit || b.imageLimit > c ? (r.appendTo(e.listScreen), d += r[t]()) : r.appendTo(e.list);
                        n += r[t]()
                    });
                    e.list.css(t, n);
                    e.listScreen.css(t, d);
                    e.listContainer.css(t, d);
                    a.objectSize(j) && a.each(j, function (b, c) {
                        var n, d, r = {};
                        for (d in c) n = "margin-right" === d || "margin-left" === d ? "width" : "height";
                        r[d] = a.getPercentagePart(e.listContainer[n](), c[d]);
                        a.addToObject(q.currentEffect[b], r)
                    });
                    e.listContainer.shScrollbar({
                        axis: g,
                        skin: w,
                        contentElement: ".sh-img-dropdown-list"
                    });
                    E = e.listContainer.data("sh-scrollbar");
                    u(E);
                    s && (r = E.wrapper.width(), e.listContainer.css("width", "+=" + r));
                    e.listContainer.hide();
                    z(c.filter('[id="' + G + '"]'));
                    D = c.parent();
                    "ontouchstart" in document.documentElement ? (D.bind("touchstart", u.touch.doTouchStartImageActions).bind("touchend", u.touch.doTouchEndImageActions), F = "touchstart") : (D.bind("mouseover", u.mouse.doMouseOverImageActions).bind("mouseout", u.mouse.doMouseOutImageActions).bind("click", u.mouse.doMouseClickImageActions), F = "click");
                    e.selectBoxOverlay.bind(F, u.toggleDropDownListVisibility);
                    a.each(h, function (a, b) {
                        b.element.bind(a, b.handler)
                    })
                })
            }
        }
})(jQuery);
(function (a) {
    a.fn.shImageSelect = function (f) {
        var b;
        b = a.extend(!0, {
            mode: "checkbox",
            maxSelected: 0,
            axis: "y",
            imageLimit: {
                x: 3,
                y: 3
            },
            showText: !0,
            additionalClass: "",
            theme: "box",
            skin: "light",
            callbacks: {
                onSelect: "",
                onUnselect: "",
                onSelectedLimit: ""
            }
        }, f);
        return this.each(function () {
            a(this).attr("multiple") ? a(this).data("sh-image-select", new g(a(this), b)) : alert('You need to add "multiple" attribute to element')
        })
    };
    var g = function (f, b) {
            var c, w, d = this,
                h;
            this.wrapper = a("<div></div>").addClass("sh-img-select-wrapper");
            this.container = a("<div></div>").addClass("sh-img-select-container");
            this.screenContainer = a("<div></div>").addClass("sh-img-select-screen-container");
            this.select = function (a) {
                g.increment() && (f.children('[class="' + a.attr("id") + '"]').attr("selected", "selected").end().triggerHandler("change"), m(a, "select", b.callbacks.onSelect))
            };
            this.unselect = function (a) {
                g.decrement();
                f.children('[class="' + a.attr("id") + '"]').removeAttr("selected").end().triggerHandler("change");
                m(a, "unselect", b.callbacks.onUnselect)
            };
            h = !0;
            var l = function (c) {
                    var e;
                    e = "radio" === b.mode ?
                    function (b) {
                        b = b.children("img");
                        var c = b.attr("id"),
                            e = !1;
                        f.children("[selected]").each(function () {
                            var b = d.screenContainer.find('[id="' + a(this).attr("class") + '"]');
                            c != a(this).attr("class") ? d.unselect(b) : e = !0;
                            return e
                        });
                        e || d.select(b)
                    } : function (a) {
                        var b = a.children("img");
                        a.children(".sh-img-select-selected-layer").is(":visible") ? d.unselect(b) : d.select(b)
                    };
                    var j, h, g, k;
                    b.showText ? (g = function (a) {
                        a.children("img").stop().fadeTo(300, 0.6);
                        a.children(".sh-img-select-textblock").stop().animate({
                            bottom: "5px"
                        }, "fast")
                    }, k = function (a) {
                        a.children("img").stop().fadeTo(300, 1);
                        a.children(".sh-img-select-textblock").stop().animate({
                            bottom: "-100%"
                        }, "fast")
                    }, j = g, h = k) : (g = function (a) {
                        a.children("img").stop().fadeTo(300, 0.6)
                    }, k = function (a) {
                        a.children("img").stop().fadeTo(300, 1)
                    }, h = j = function () {});
                    var n = !1,
                        q = !1;
                    l = {
                        mouse: {
                            doMouseClickImageActions: function (b) {
                                b.preventDefault();
                                e(a(this))
                            },
                            doMouseOverImageActions: function () {
                                g(a(this))
                            },
                            doMouseOutImageActions: function () {
                                k(a(this))
                            }
                        },
                        touch: {
                            doTouchStartImageActions: function (b) {
                                var d = a(this);
                                b.preventDefault();
                                n = !0;
                                setTimeout(function () {
                                    c.draggingInEventsCycleFlag() || (n ? (j(d), q = !0) : e(d))
                                }, 200)
                            },
                            doTouchEndImageActions: function () {
                                n = !1;
                                q && (h(a(this)), q = !1)
                            }
                        }
                    }
                },
                m = function (b, c, e) {
                    b = b.parent().children(".sh-img-select-selected-layer");
                    "select" == c ? b.fadeTo("fast", t.selectedLayerOpacity) : b.fadeOut("fast");
                    e && a.shHelper.callCallback(e, d.container)
                },
                g = {
                    count: 0,
                    increment: function () {
                        if (this.isLimit()) return a.shHelper.callCallback(b.callbacks.onSelectedLimit, d.container), !1;
                        this.count++;
                        return !0
                    },
                    decrement: function () {
                        this.count--
                    },
                    isLimit: function () {
                        return 0 !== b.maxSelected && this.count >= b.maxSelected
                    }
                },
                t, s = b.theme;
            c = "sh-img-select-theme-";
            var j = 0.6;
            switch (s) {
            default:
                c += s;
                break;
            case "minimal":
                j = 1, c += s
            }
            t = {
                cssClass: c,
                selectedLayerOpacity: j
            };
            c = b.skin;
            j = "sh-img-select-";
            s = "light";
            switch (c) {
            case "dark":
                j += c;
                s = c;
                break;
            default:
                j += c, s = c
            }
            c = j;
            w = s;
            var e = [];
            void 0 === h ? (d.container.append(d.screenContainer), d.wrapper.append(d.container), f.hide().after(d.wrapper), d.wrapper.addClass(t.cssClass).addClass(c).addClass(b.additionalClass), f.children().each(function (b) {
                var c = a("<img>");
                b = "sh-img-select-image-" + b;
                d.container.append(c);
                c.attr({
                    src: a(this).data("image"),
                    id: b,
                    alt: ""
                });
                a(this).addClass(b);
                a(this).is(":selected") && (g.increment(), e.push(c))
            }), d.container.imagesLoaded(function (c) {
                var j = 0,
                    h = a("<div></div>").addClass("sh-img-select-screen"),
                    g = h,
                    p, k = 0,
                    n = b.imageLimit.x * b.imageLimit.y;
                c.each(function () {
                    var c = a("<div></div>").addClass("sh-img-select-image-wrapper"),
                        e = a("<div></div>").addClass("sh-img-select-textblock"),
                        q = a("<div></div>").addClass("sh-img-select-selected-layer");
                    j == b.imageLimit.x && (c.css("clear", "left"), j = 0);
                    if (!p || p.children().length == n) p = h.clone().appendTo(d.screenContainer), k += 1;
                    e.text(f.children("." + a(this).attr("id")).text());
                    c.append(a(this), e, q).appendTo(p);
                    1 == k && (g = p);
                    j += 1
                });
                c = c.parent();
                a.each(e, function (a, b) {
                    m(b, "select")
                });
                if ("y" == b.axis) d.screenContainer.children().css("clear", "both"), d.container.css({
                    "min-width": g.width(),
                    height: g.height()
                });
                else {
                    var q = 0;
                    d.container.css({
                        width: g.width(),
                        "min-height": g.height()
                    });
                    d.screenContainer.children().each(function () {
                        q += a(this).width()
                    });
                    d.screenContainer.css("width", q)
                }
                d.container.shScrollbar({
                    axis: b.axis,
                    skin: w,
                    contentElement: ".sh-img-select-screen-container"
                });
                l(d.container.data("sh-scrollbar"));
                "ontouchstart" in document.documentElement ? c.bind("touchstart", l.touch.doTouchStartImageActions).bind("touchend", l.touch.doTouchEndImageActions) : c.bind("click", l.mouse.doMouseClickImageActions).bind("mouseover", l.mouse.doMouseOverImageActions).bind("mouseout", l.mouse.doMouseOutImageActions)
            })) : alert("This script for dfdesign visitors only")
        }
})(jQuery);
(function (a) {
    a.fn.shScrollbar = function (f) {
        var b;
        b = a.extend(!0, {
            axis: "y",
            contentElement: "",
            skin: "light",
            scrollLength: 30
        }, f);
        return this.each(function () {
            var c = a(this).find(b.contentElement);
            c.length ? a(this).data("sh-scrollbar", new g(a(this), c, b)) : alert("Could'nt find content block.")
        })
    };
    var g = function (f, b, c) {
            this.wrapper = a("<div></div>").addClass("sh-scrollbar-wrapper");
            this.track = a("<div></div>").addClass("sh-scrollbar-track");
            this.slider = a("<div></div>").addClass("sh-scrollbar-slider");
            var g;
            this.draggingInEventsCycleFlag = function () {
                return h.draggingInEventsCycleFlag()
            };
            g = !0;
            var d = this,
                h, l = {
                    x: 0,
                    y: 0
                },
                m = !1,
                x = a.support.selectstart ? "selectstart" : "mousedown";
            h = {
                touch: {
                    makeDraggable: function (a) {
                        a.preventDefault();
                        m = !1;
                        l.y = a.originalEvent.touches[0].pageY;
                        l.x = a.originalEvent.touches[0].pageX;
                        v.stopDrifting();
                        v.saveSliderOffset()
                    },
                    dragging: function (a) {
                        var b = {
                            x: a.originalEvent.touches[0].pageX,
                            y: a.originalEvent.touches[0].pageY
                        };
                        a.stopPropagation();
                        m = !0;
                        t.adjust(b[c.axis]);
                        v.setNewOffsetTouch(b[c.axis] - l[c.axis]);
                        d.slider.addClass("sh-scrollbar-draggable")
                    },
                    stopDragging: function () {
                        var a = t.stop();
                        a.offset && (v.saveSliderOffset(), v.setNewOffsetTouchDrift(a.offset, a.animationSpeed));
                        d.slider.removeClass("sh-scrollbar-draggable")
                    }
                },
                mouse: {
                    makeDraggable: function (b) {
                        m = !1;
                        l.y = b.pageY;
                        l.x = b.pageX;
                        v.saveSliderOffset();
                        a(document).bind("mousemove", h.mouse.dragging).bind("mouseup", h.mouse.stopDragging).bind(x + ".disableSelection", function (a) {
                            a.preventDefault()
                        });
                        a(this).addClass("sh-scrollbar-draggable")
                    },
                    dragging: function (a) {
                        var b = {
                            x: a.pageX,
                            y: a.pageY
                        };
                        a.stopPropagation();
                        m = !0;
                        v.setNewOffsetMouseFire(b[c.axis] - l[c.axis])
                    },
                    stopDragging: function () {
                        a(document).unbind("mousemove", h.mouse.dragging).unbind("mouseup", h.mouse.stopDragging).unbind(x + ".disableSelection");
                        d.slider.removeClass("sh-scrollbar-draggable")
                    },
                    wheellScrolling: function (a, b) {
                        a.stopPropagation();
                        a.preventDefault();
                        v.setNewOffsetMouseScroll(b * c.scrollLength)
                    }
                },
                draggingInEventsCycleFlag: function () {
                    return m
                }
            };
            var t, s = 0,
                j = 0,
                e = 0,
                y = 0,
                u = "-";
            t = {
                adjust: function (b) {
                    var c = a.microtime(),
                        d = u;
                    b !== j && (0 > b - j && "+" === u ? u = "-" : 0 < b - j && "-" === u && (u = "+"));
                    d !== u && (e = c, s = b);
                    y = c;
                    j = b
                },
                stop: function () {
                    var b, c = 0;
                    b = 0;
                    var d = a.microtime();
                    e && (y && s && j && 0.07 > d - y) && (c = d - e, b = s > j ? s - j : j - s);
                    var d = !1,
                        g = "-" === u ? "-" : "",
                        c = b / c;
                    200 < c && 1E3 > c ? d = g + b : 1E3 <= c && (d = g + 9999);
                    return {
                        animationSpeed: c,
                        offset: d
                    }
                }
            };
            var v = function (a, c, d) {
                    var e, j, g, f = 0,
                        h = 0,
                        k = function (a) {
                            0 > a ? a = 0 : a > e && (a = e);
                            return a
                        },
                        l = function (d) {
                            d = k(d);
                            if (d !== f) {
                                var h = d;
                                b.css(c, -(g - j) * d / e);
                                a.slider.css(c, h);
                                f = d
                            }
                        },
                        m = function (a, b) {
                            var c, d;
                            c = -e * a / (g - j) + h;
                            c = k(c);
                            d = -(g - j) * c / e;
                            c !== f && ("function" === typeof b && b.call(null, d, c), f = c)
                        };
                    v = {
                        saveSliderOffset: function () {
                            h = f
                        },
                        setNewOffsetTouch: function (d) {
                            m(d, function (d, e) {
                                b.css(c, d);
                                a.slider.css(c, e)
                            })
                        },
                        setNewOffsetTouchDrift: function (d, e) {
                            m(d, function (d, j) {
                                var g = {},
                                    f = {};
                                g[c] = d;
                                f[c] = j;
                                a.slider.animate(f, e);
                                b.animate(g, e)
                            })
                        },
                        stopDrifting: function () {
                            a.slider.stop();
                            b.stop();
                            var d = a.slider.css(c);
                            f = "auto" === d ? 0 : parseInt(d)
                        },
                        setNewOffsetMouseScroll: function (a) {
                            a = f - a;
                            l(a)
                        },
                        setNewOffsetMouseFire: function (a) {
                            a += h;
                            l(a)
                        }
                    };
                    e = a.track[d]() - a.slider[d]();
                    j = a.container[d]();
                    g = a.contentBlock[d]()
                },
                z;
            switch (c.skin) {
            default:
                z = "sh-scrollbar-light";
                break;
            case "dark":
                z = "sh-scrollbar-dark"
            }
            var p, k;
            void 0 === g ? (b.css("position", "relative"), d.track.append(d.slider).appendTo(d.wrapper), d.wrapper.appendTo(f), "y" === c.axis ? (g = "sh-scrollbar-track-y", p = "height", k = "top") : (g = "sh-scrollbar-track-x", p = "width", k = "left"), d.wrapper.addClass(z).addClass(g), b[p]() <= f[p]() ? d.wrapper.remove() : (v({
                container: f,
                contentBlock: b,
                track: d.track,
                slider: d.slider
            }, k, p), "ontouchstart" in document.documentElement ? b.bind("touchstart", h.touch.makeDraggable).bind("touchmove", h.touch.dragging).bind("touchend", h.touch.stopDragging) : (b.mousewheel(h.mouse.wheellScrolling), d.slider.bind("mousedown", h.mouse.makeDraggable)))) : alert("This script for dfdesign visitors only")
        }
})(jQuery);
(function (a) {
    a.extend({
        shHelper: {
            callCallback: function (a, f, b) {
                if ("function" === typeof a) return a.call(f, b)
            }
        },
        addToObject: function (g, f) {
            a.each(f, function (a, c) {
                !1 === a in g && (g[a] = c)
            });
            return g
        },
        microtime: function () {
            return (new Date).getTime() / 1E3
        },
        objectSize: function (a) {
            var f = 0,
                b;
            for (b in a) a.hasOwnProperty(b) && f++;
            return f
        },
        getPercentagePart: function (a, f) {
            var b = parseInt(f.replace("%", ""));
            return a / 100 * b
        }
    })
})(jQuery);
(function (a) {
    function g(b) {
        var f = b || window.event,
            d = [].slice.call(arguments, 1),
            g = 0,
            l = 0,
            m = 0;
        b = a.event.fix(f);
        b.type = "mousewheel";
        f.wheelDelta && (g = f.wheelDelta / 120);
        f.detail && (g = -f.detail / 3);
        m = g;
        void 0 !== f.axis && f.axis === f.HORIZONTAL_AXIS && (m = 0, l = -1 * g);
        void 0 !== f.wheelDeltaY && (m = f.wheelDeltaY / 120);
        void 0 !== f.wheelDeltaX && (l = -1 * f.wheelDeltaX / 120);
        d.unshift(b, g, l, m);
        return (a.event.dispatch || a.event.handle).apply(this, d)
    }
    var f = ["DOMMouseScroll", "mousewheel"];
    if (a.event.fixHooks) for (var b = f.length; b;) a.event.fixHooks[f[--b]] = a.event.mouseHooks;
    a.event.special.mousewheel = {
        setup: function () {
            if (this.addEventListener) for (var a = f.length; a;) this.addEventListener(f[--a], g, !1);
            else this.onmousewheel = g
        },
        teardown: function () {
            if (this.removeEventListener) for (var a = f.length; a;) this.removeEventListener(f[--a], g, !1);
            else this.onmousewheel = null
        }
    };
    a.fn.extend({
        mousewheel: function (a) {
            return a ? this.bind("mousewheel", a) : this.trigger("mousewheel")
        },
        unmousewheel: function (a) {
            return this.unbind("mousewheel", a)
        }
    })
})(jQuery);
(function (a, g) {
    var f = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
    a.fn.imagesLoaded = function (b) {
        function c() {
            var c = a(t),
                e = a(s);
            h && (s.length ? h.reject(m, c, e) : h.resolve(m));
            a.isFunction(b) && b.call(d, m, c, e)
        }
        function w(b, d) {
            b.src === f || -1 !== a.inArray(b, x) || (x.push(b), d ? s.push(b) : t.push(b), a.data(b, "imagesLoaded", {
                isBroken: d,
                src: b.src
            }), l && h.notifyWith(a(b), [d, m, a(t), a(s)]), m.length === x.length && (setTimeout(c), m.unbind(".imagesLoaded")))
        }
        var d = this,
            h = a.isFunction(a.Deferred) ? a.Deferred() : 0,
            l = a.isFunction(h.notify),
            m = d.find("img").add(d.filter("img")),
            x = [],
            t = [],
            s = [];
        a.isPlainObject(b) && a.each(b, function (a, c) {
            if ("callback" === a) b = c;
            else if (h) h[a](c)
        });
        m.length ? m.bind("load.imagesLoaded error.imagesLoaded", function (a) {
            w(a.target, "error" === a.type)
        }).each(function (b, c) {
            var d = c.src,
                h = a.data(c, "imagesLoaded");
            if (h && h.src === d) w(c, h.isBroken);
            else if (c.complete && c.naturalWidth !== g) w(c, 0 === c.naturalWidth || 0 === c.naturalHeight);
            else if (c.readyState || c.complete) c.src = f, c.src = d
        }) : c();
        return h ? h.promise(d) : d
    }
})(jQuery);