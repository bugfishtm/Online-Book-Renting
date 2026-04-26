/*
Copyright © 2024 Annpoint, s.r.o.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

-------------------------------------------------------------------------

NOTE: Requires the following acknowledgement (see also NOTICE):
This software includes DayPilot (https://www.daypilot.org).
*/

if (typeof DayPilot === 'undefined') {
    var DayPilot = {};
}

if (typeof DayPilot.Global === 'undefined') {
    DayPilot.Global = {};
}

(function(DayPilot) {
    'use strict';

    if (typeof DayPilot.Menu !== 'undefined' && DayPilot.Menu.def) {
        return;
    }

    var doNothing = function() {};

    var DayPilotMenu = {};

    DayPilotMenu.mouse = null;
    DayPilotMenu.menu = null;
    DayPilotMenu.handlersRegistered = false;
    DayPilotMenu.hideTimeout = null;
    DayPilotMenu.waitingSubmenu = null;

    DayPilot.Menu = function(items) {
        var menu = this;
        var initiatorAreaDiv = null;

        this.v = '2024.3.543-lite';
        this.zIndex = 120;  // more than 10,001 used by ModalPopupExtender
        //this.useShadow = true;
        this.cssClassPrefix = "menu_default";
        this.cssOnly = true;
        this.menuTitle = null;
        this.showMenuTitle = false;
        this.hideOnMouseOut = false;
        this.hideAfter = 200;
        this.theme = null;

        this.onShow = null;

        // hiding internal properties for angular
        this._state = function() {};
        //this._state.ref = null; // ref object, used for position

        if (items && DayPilot.isArray(items)) {
            this.items = items;
        }

        // angular change detection
        this.toJSON = function() {
            return null;
        };

        this.show = function(e, options) {
            options = options || {};

            var value = null;
            if (!e) {
                value = null;
            }
            else if (typeof e.id === 'string' || typeof e.id === 'number') {
                value = e.id;
            }
            else if (typeof e.id === 'function') {
                value = e.id();
            }
            else if (typeof e.value === 'function') {
                value = e.value();
            }

            if (typeof(DayPilot.Bubble) !== 'undefined') { // hide any bubble if active
                DayPilot.Bubble.hideActive();
            }

            if (!options.submenu) {
                DayPilotMenu.menuClean();
            }

            // clear old data
            this._state.submenu = null;

            if (DayPilotMenu.mouse === null) { // not possible to execute before mouse move (TODO)
                return;
            }

            if (!menu.cssOnly) {
                menu.cssOnly = true;
            }

            var source = null;
            if (e && e.isRow && e.$.row.task) {
                source = new DayPilot.Task(e.$.row.task, e.calendar);
                source.menuType = "resource";
            }
            else if (e && e.isEvent && e.data.task) {
                source = new DayPilot.Task(e, e.calendar);
            }
            else {
                source = e;
            }

            if (typeof menu.onShow === "function") {
                var args = {};
                args.source = source;
                args.menu = menu;
                args.preventDefault = function () {
                    args.preventDefault.value = true;
                };
                menu.onShow(args);
                if (args.preventDefault.value) {
                    return;
                }
            }

            var div = document.createElement("div");
            div.style.position = "absolute";
            div.style.top = "0px";
            div.style.left = "0px";
            div.style.display = 'none';
            div.style.overflow = 'hidden';
            div.style.zIndex = this.zIndex + 1;
            div.className = this._applyCssClass('main');
            div.onclick = function(ev) {
                ev.cancelBubble = true;
                this.parentNode.removeChild(this);
            };

            if (this.hideOnMouseOut) {
                div.onmousemove = function(ev) {
                    clearTimeout(DayPilotMenu.hideTimeout);
                };
                div.onmouseleave = function(ev) {
                    menu.delayedHide({"hideParent": true});
                };
            }

            if (!this.items || this.items.length === 0) {
                throw "No menu items defined.";
            }

            if (this.showMenuTitle) {
                var title = document.createElement("div");
                title.innerHTML = this.menuTitle;
                title.className = this._applyCssClass("title");
                div.appendChild(title);
            }

            for (var i = 0; i < this.items.length; i++) {
                var mi = this.items[i];
                var item = document.createElement("div");
                DayPilot.Util.addClass(item, this._applyCssClass("item"));
                if (mi.items) {
                    DayPilot.Util.addClass(item, this._applyCssClass("item_haschildren"));
                    DayPilot.Util.addClass(div, this._applyCssClass(("withchildren")));
                }

                if (typeof mi === 'undefined') {
                    continue;
                }

                if (mi.hidden) {
                    continue;
                }


                if (mi.text === '-') {
                    var separator = document.createElement("div");
                    separator.addEventListener("click", function(ev) {
                        ev.stopPropagation();
                    });

                    item.appendChild(separator);
                }
                else {
                    var link = document.createElement("a");
                    link.style.position = 'relative';
                    link.style.display = "block";

                    if (mi.cssClass) {
                        DayPilot.Util.addClass(link, mi.cssClass);
                    }

                    if (mi.disabled) {
                        DayPilot.Util.addClass(link, menu._applyCssClass("item_disabled"));
                    }
                    else {
                        if (mi.onclick || mi.onClick) {
                            link.item = mi;
                            link.onclick = (function(mi, link) {
                                return function (e) {
                                    if (typeof mi.onClick === "function") {
                                        var args = {};
                                        args.item = mi;
                                        args.source = link.source;
                                        args.originalEvent = e;
                                        args.preventDefault = function () {
                                            args.preventDefault.value = true;
                                        };
                                        mi.onClick(args);
                                        if (args.preventDefault.value) {
                                            return;
                                        }
                                    }
                                    if (mi.onclick) {
                                        mi.onclick.call(link, e);
                                    }
                                };
                            })(mi, link);

                            var assignTouchEnd = function(mi, link) {
                                return function(e) {
                                    e.stopPropagation();
                                    e.preventDefault();

                                    var cleanup = function() {
                                        window.setTimeout(function() {
                                            link.source.calendar.internal.touch.active = false;
                                        }, 500);
                                    };

                                    if (typeof mi.onClick === "function") {
                                        var args = {};
                                        args.item = mi;
                                        args.source = link.source;
                                        args.originalEvent = e;
                                        args.preventDefault = function() {
                                            args.preventDefault.value = true;
                                        };
                                        mi.onClick(args);
                                        if (args.preventDefault.value) {
                                            cleanup();
                                            return;
                                        }
                                    }

                                    if (mi.onclick) {
                                        mi.onclick.call(link, e);
                                    }

                                    DayPilotMenu.menuClean();
                                    cleanup();
                                };
                            };

                            DayPilot.reNonPassive(link, "touchstart", function(ev) {
                                ev.stopPropagation();
                                ev.preventDefault();

                                link.source.calendar.internal.touch.active = true;
                            });
                            DayPilot.reNonPassive(link, "touchend", assignTouchEnd(mi, link));

                            // link.ontouchend = assignTouchEnd(mi, link);
                        }


                        if (mi.items && !mi.disabled) {
                            var assign = function(mi, link) {
                                return function(ev) {
                                    ev.preventDefault();
                                    ev.stopPropagation();
                                    menu._showSubmenu(mi, link);
                                };
                            };
                            link.ontouchend = assign(mi, link);
                        }

                        if (mi.onclick) {
                            doNothing();
                        }
                        else if (mi.href) {
                            link.href = mi.href.replace(/\x7B0\x7D/gim, value); // for NavigateUrl actions, only for backwards compatibility
                            if (mi.target) {
                                link.setAttribute("target", mi.target);
                            }
                        }
                        else if (mi.command) {
                            var assign = function(mi, link) {
                                return function(e) {
                                    var source = link.source;
                                    var item = mi;
                                    item.action = item.action ? item.action : 'CallBack';
                                    var cal = source.calendar || source.root;

                                    if (source instanceof DayPilot.Link) {
                                        cal.internal.linkMenuClick(item.command, source, item.action);
                                        return;
                                    }
                                    else if (source instanceof DayPilot.Selection) {
                                        cal.internal.timeRangeMenuClick(item.command, source, item.action);
                                        return;
                                    }
                                    else if (source instanceof DayPilot.Event) {
                                        cal.internal.eventMenuClick(item.command, source, item.action);
                                        return;
                                    }
                                    else if (source instanceof DayPilot.Selection) {
                                        cal.internal.timeRangeMenuClick(item.command, source, item.action);
                                        return;
                                    }
                                    else if (source instanceof DayPilot.Task) {
                                        if (source.menuType === "resource") {
                                            cal.internal.resourceHeaderMenuClick(item.command, link.menuSource, item.action);
                                        }
                                        else {
                                            cal.internal.eventMenuClick(item.command, link.menuSource, item.action);
                                        }
                                        return;
                                    }
                                    else {
                                        switch (source.menuType) {  // TODO legacy, remove
                                            case 'resource':
                                                cal.internal.resourceHeaderMenuClick(item.command, source, item.action);
                                                return;
                                            case 'selection':  // fully replaced
                                                cal.internal.timeRangeMenuClick(item.command, source, item.action);
                                                return;
                                            default:  //  fully replaced
                                                cal.internal.eventMenuClick(item.command, source, item.action);
                                                return;
                                        }
                                    }

                                    e.preventDefault();
                                };
                            };
                            link.onclick = assign(mi, link);
                            link.ontouchend = assign(mi, link);
                        }

                    }


                    if (mi.items) {
                        link.addEventListener("click", function(ev) {
                            ev.stopPropagation();
                        });
                    }

                    link.source = source;
                    link.menuSource = e;

                    var span = document.createElement("span");
                    span.className = menu._applyCssClass("item_text");
                    span.innerHTML = DayPilot.Util.escapeTextHtml(mi.text, mi.html);
                    link.appendChild(span);

                    if (mi.image) {
                        var image = document.createElement("img");
                        image.src = mi.image;
                        image.style.position = 'absolute';
                        image.style.top = '0px';
                        image.style.left = '0px';

                        link.appendChild(image);
                    }

                    if (mi.icon) {
                        var icon = document.createElement("span");
                        icon.className = menu._applyCssClass("item_icon");

                        var iel = document.createElement("i");
                        iel.className = mi.icon;
                        icon.appendChild(iel);

                        link.appendChild(icon);
                    }

                    if (mi.symbol) {
                        var ns = "http://www.w3.org/2000/svg";
                        var svg = document.createElementNS(ns,"svg");
                        svg.setAttribute("width", "100%");
                        svg.setAttribute("height", "100%");
                        var use = document.createElementNS(ns,"use");
                        use.setAttribute("href", mi.symbol);
                        svg.appendChild(use);

                        var svgWrap = document.createElement("span");
                        svgWrap.className = menu._applyCssClass("item_symbol");
                        svgWrap.style.position = "absolute";
                        svgWrap.style.top = "0px";
                        svgWrap.style.left = "0px";
                        svgWrap.appendChild(svg);

                        link.appendChild(svgWrap);
                    }

                    var assignOnMouseOver = function(mi, link) {
                        return function() {
                            var source = link.source;
                            var item = mi;

                            var ws = DayPilotMenu.waitingSubmenu;
                            if (ws) {
                                if (ws.parent === item) {
                                    return;
                                }
                                else {
                                    clearTimeout(ws.timeout);
                                    DayPilotMenu.waitingSubmenu = null;
                                }
                            }

                            if (mi.disabled) {
                                return;
                            }

                            DayPilotMenu.waitingSubmenu = {};
                            DayPilotMenu.waitingSubmenu.parent = item;
                            DayPilotMenu.waitingSubmenu.timeout = setTimeout(function() {

                                DayPilotMenu.waitingSubmenu = null;

                                menu._showSubmenu(item, link);

                            }, 300);
                        };
                    };

                    link.onmouseover = assignOnMouseOver(mi, link);

                    item.appendChild(link);
                }

                div.appendChild(item);

            }

            var delayedDismiss = function(e) {
                window.setTimeout(function() {
                    DayPilotMenu.menuClean();
                    DayPilot.MenuBar.deactivate();
                }, 100);
            };

            div.onclick = delayedDismiss;
            div.ontouchend = delayedDismiss;

            div.onmousedown = function(e) {
                e = e || window.event;
                e.cancelBubble = true;
                if (e.stopPropagation)
                    e.stopPropagation();
            };
            div.oncontextmenu = function() {
                return false;
            };

            document.body.appendChild(div);
            menu._state.visible = true;
            menu._state.source = e;

            div.style.display = '';
            var height = div.offsetHeight;
            var width = div.offsetWidth;
            div.style.display = 'none';

            // don't show the menu outside of the visible window
            var windowHeight = document.documentElement.clientHeight;
            // required for ipad with zoom instead of document.documentElement.clientWidth
            var windowWidth = window.innerWidth;

            var windowMargin = (typeof options.windowMargin == "number") ? options.windowMargin : 5;

            (function showInitiator() {
                var initiator = options.initiator;
                // initiator = options.initiator;
                if (!initiator) {
                    return;
                }
                var div = initiator.div;
                var e = initiator.e;
                var area = initiator.area;

                var v = area.visibility || area.v || "Visible";
                var a = initiator.a;
                if (v !== "Visible") {
                    // make sure the source area is visible
                    a = DayPilot.Areas.createArea(div, e, area);
                    div.appendChild(a);
                    // will be used to remove it on hide
                    initiatorAreaDiv = a;
                }

                if (a) {
                    var abs = DayPilot.abs(a);
                    options.x = abs.x;
                    options.y = abs.y + abs.h + 2;
                }

            })();


            (function adjustPosition() {

                // don't show it exactly under the cursor
                var x = (typeof options.x === "number") ? options.x : DayPilotMenu.mouse.x + 1;
                var y = (typeof options.y === "number") ? options.y : DayPilotMenu.mouse.y + 1;

                var topOffset = document.body.scrollTop || document.documentElement.scrollTop;
                var leftOffset = document.body.scrollLeft || document.documentElement.scrollLeft;

                if (y - topOffset > windowHeight - height && windowHeight !== 0) {
                    var offsetY = y - topOffset - (windowHeight - height) + windowMargin;
                    div.style.top = (y - offsetY) + 'px';
                }
                else {
                    div.style.top = y + 'px';
                }

                if (options.align === "right") {
                    x -= width;
                }

                if (x - leftOffset > windowWidth - width && windowWidth !== 0) {
                    var offsetX = x - leftOffset - (windowWidth - width) + windowMargin;
                    div.style.left = (x - offsetX) + 'px';
                }
                else {
                    div.style.left = x + 'px';
                }
/*
                if (DayPilotMenu.mouse.clientY > windowHeight - height && windowHeight !== 0) {
                    var offsetY = DayPilotMenu.mouse.clientY - (windowHeight - height) + 5;
                    div.style.top = (y - offsetY) + 'px';
                }
                else {
                    div.style.top = y + 'px';
                }

                if (DayPilotMenu.mouse.clientX > windowWidth - width && windowWidth !== 0) {
                    var offsetX = DayPilotMenu.mouse.clientX - (windowWidth - width) + 5;
                    div.style.left = (x - offsetX) + 'px';
                }
                else {
                    div.style.left = x + 'px';
                }
*/
            })();

            if (options.parentLink) {

                var parent = options.parentLink;

                var verticalOffset = parseInt(new DayPilot.StyleReader(div).get("border-top-width"));

                var pos = DayPilot.abs(options.parentLink.parentNode);
                var x = pos.x + parent.offsetWidth;
                var y = pos.y - verticalOffset;

                if (x + width > windowWidth) {
                    x = Math.max(0, pos.x - width);
                }

                var docScrollTop = document.body.scrollTop + document.documentElement.scrollTop;
                if (y + height - docScrollTop > windowHeight) {
                    y = Math.max(0, windowHeight - height + docScrollTop);
                }

                div.style.left = x + "px";
                div.style.top = y + "px";

            }
            div.style.display = '';

            this.addShadow(div);
            this._state.div = div;

            if (!options.submenu) {
                DayPilot.Menu.active = this;
            }

            //this._initiator = null;

        };

        this._showSubmenu = function(item, link) {
            var mi = item;
            var source = link.source;

            if (menu._state.submenu && menu._state.submenu.item === item) {  // already visible
                return;
            }

            if (menu._state.submenu && menu._state.submenu.item !== item) {  // hide submenus of other items
                DayPilot.Util.removeClass(menu._state.submenu.link.parentNode, menu._applyCssClass("item_haschildren_active"));
                menu._state.submenu.menu.hide();
                menu._state.submenu = null;
            }

            if (!item.items) {  // no submenu for this item
                return;
            }

            var options = menu.cloneOptions();
            options.items = item.items;

            menu._state.submenu = {};
            menu._state.submenu.menu = new DayPilot.Menu(options);
            menu._state.submenu.menu._parentMenu = menu;
            menu._state.submenu.menu.show(source, {"submenu": true, "parentLink": link, "parentItem": mi});
            menu._state.submenu.item = item;
            menu._state.submenu.link = link;
            DayPilot.Util.addClass(link.parentNode, menu._applyCssClass("item_haschildren_active"));

        };

        this._applyCssClass = function(part) {
            var prefix = this.theme || this.cssClassPrefix;
            var sep = (this.cssOnly ? "_" : "");
            if (prefix) {
                return prefix + sep + part;
            }
            else {
                return "";
            }
        };

        this.cloneOptions = function() {
            return DayPilot.Util.copyProps(options, {}, ["cssClassPrefix", "theme", "hideAfter", "hideOnMouseOut", "zIndex"]);
        };

        this.hide = function(props) {
            props = props || {};

            if (this._state.submenu) {
                this._state.submenu.menu.hide();
            }

            var ws = DayPilotMenu.waitingSubmenu;
            if (ws) {
                DayPilotMenu.waitingSubmenu = null;
                clearTimeout(ws.timeout);
            }

            this.removeShadow();
            if (this._state.div && this._state.div.parentNode === document.body) {
                document.body.removeChild(this._state.div);
            }

/*
            if (this._initiator) {
                DayPilot.de(this._initiator);
                this._initiator = null;
            }
*/

            if (initiatorAreaDiv) {
                DayPilot.de(initiatorAreaDiv);
                initiatorAreaDiv = null;
            }

            menu._state.visible = false;
            menu._state.source = null;

            if (menu._parentMenu && props.hideParent) {
                menu._parentMenu.hide(props);
            }

            if (DayPilot.Menu.active === menu) {
                DayPilot.Menu.active = null;
            }

            if (typeof this.onHide === "function") {
                var args = {};
                this.onHide(args);
            }

        };

        this.delayedHide = function(props) {
            DayPilotMenu.hideTimeout = setTimeout(function() {
                menu.hide(props);
            }, menu.hideAfter);
        };

        this.cancelHideTimeout = function() {
            clearTimeout(DayPilotMenu.hideTimeout);
        };

        // detects the mouse position, use when creating menu right before opening (.show)
        this.init = function(ev) {
            DayPilotMenu.mouseMove(ev);
            return this;
        };

        // disabled
        this.addShadow = function(object) {};

        // disabled
        this.removeShadow = function() {
        /*    if (!this._state.shadows) {
                return;
            }

            for (var i = 0; i < this._state.shadows.length; i++) {
                document.body.removeChild(this._state.shadows[i]);
            }
            this._state.shadows = [];*/
        };


        var options = DayPilot.isArray(items) ? null : items;
        if (options) {
            for (var name in options) {
                this[name] = options[name];
            }
        }

    };

    DayPilot.MenuBar = function(id, options) {
        var menubar = this;

        options = options || {};

        this.items = [];
        this.theme = "menubar_default";
        this.windowMargin = 0;

        this.nav = {};
        this.elements = {};
        this.elements.items = DayPilot.list();

        this._active = null;
        this._initialized = false;

        for (var name in options) {
            this[name] = options[name];
        }

        this._cssClass = function(cl) {
            return this.theme + "_" + cl;
        };

        this._show = function() {
            this.nav.top = document.getElementById(id);

            var top = this.nav.top;
            top.className = this._cssClass("main");

            DayPilot.list(menubar.items).forEach(function(item) {
                var div = document.createElement("span");
                div.innerHTML = DayPilot.Util.escapeTextHtml(item.text, item.html);
                div.className = menubar._cssClass("item");
                if (item.cssClass) {
                    div.classList.add(item.cssClass);
                }
                div.data = item;
                div.onclick = function(e) {
                    if (menubar.active && menubar.active.item === item) {
                        menubar._hideActive();
                    }
                    else if (item.children) {
                        menubar._activate(div);
                        return;
                    }

                    if (typeof item.onClick === "function") {
                        var args = {};
                        args.item = item;
                        args.originalEvent = e;
                        item.onClick(args);
                    }
                };
                div.onmousedown = function(ev) {
                    ev.stopPropagation();
                };
                div.onmouseover = function() {
                    if (menubar.active && menubar.active.item !== item) {
                        menubar._activate(div);
                    }
                };

                top.appendChild(div);
                menubar.elements.items.push(div);
            });
        };

        this._hideActive = function() {
            var activeCss = menubar._cssClass("item_active");
            menubar.elements.items.forEach(function(div) {
                DayPilot.Util.removeClass(div, activeCss);
            });

            if (menubar.active && menubar.active.menu) {
                menubar.active.menu.hide();
            }
            menubar.active = null;
        };

        this._isActive = function(div) {
            if (!menubar.active) {
                return false;
            }
            return menubar.active.item === div.data;
        };

        this._activate = function(div) {
            if (menubar._isActive(div)) {
                return;
            }

            menubar._hideActive();

            var item = div.data;
            var a = menubar.active = {};
            a.item = item;
            a.div = div;

            var activeCss = menubar._cssClass("item_active");
            DayPilot.Util.addClass(div, activeCss);

            var abs = DayPilot.abs(div);

            if (item.children) {
                a.menu = new DayPilot.Menu({"items": item.children});
                // a.menu.show(null, { "x": abs.x + abs.w, "y": abs.y + abs.h, "align": item.align, "windowMargin": menubar.windowMargin});
                var x = abs.x;
                if (item.align === "right") {
                    x += abs.w;
                }
                a.menu.show(null, { "x": x, "y": abs.y + abs.h, "align": item.align, "windowMargin": menubar.windowMargin});
            }

            DayPilot.MenuBar.active = menubar;
        };

        this.init = function() {
            this._show();
            this._initialized = true;
            return this;
        };

        this.dispose = function() {
            if (!this._initialized) {
                return;
            }
            this.nav.top.innerHTML = "";
            this.elements.items = [];
        };

    };

    DayPilot.MenuBar.deactivate = function() {
        if (DayPilot.MenuBar.active) {
            DayPilot.MenuBar.active._hideActive();
            DayPilot.MenuBar.active = null;
        }
    };

    DayPilotMenu.menuClean = function() {
        if (typeof(DayPilot.Menu.active) === 'undefined')
            return;

        if (DayPilot.Menu.active) {
            DayPilot.Menu.active.hide();
            DayPilot.Menu.active = null;
        }

    };

    DayPilotMenu.mouseDown = function(ev) {
        if (typeof(DayPilotMenu) === 'undefined') {
            return;
        }
        DayPilotMenu.menuClean();

        DayPilot.MenuBar.deactivate();
    };

    DayPilotMenu.mouseMove = function(ev) {
        if (typeof(DayPilotMenu) === 'undefined') {
            return;
        }
        DayPilotMenu.mouse = DayPilotMenu.mousePosition(ev);
    };

    DayPilotMenu.touchMove = function(ev) {
        if (typeof(DayPilotMenu) === 'undefined') {
            return;
        }
        DayPilotMenu.mouse = DayPilotMenu.touchPosition(ev);
    };

    DayPilotMenu.touchStart = function(ev) {
        if (typeof(DayPilotMenu) === 'undefined') {
            return;
        }
        //DayPilotMenu.menuClean();
        DayPilotMenu.mouse = DayPilotMenu.touchPosition(ev);
    };

    DayPilotMenu.touchEnd = function(ev) {
        // do not call menuClean() here, it doesn't work with eventTapAndHoldHandling="ContextMenu"
        // DayPilotMenu.menuClean();
    };

    DayPilotMenu.touchPosition = function(ev) {
        if (!ev || !ev.touches) {
            return null;
        }
        var touch = ev.touches[0];
        var mouse = {};
        mouse.x = touch.pageX;
        mouse.y = touch.pageY;
        return mouse;
    };

    DayPilotMenu.mousePosition = function(e) {
        return DayPilot.mo3(null, e);
    };

    DayPilot.Menu.touchPosition = function(ev) {
        if (ev.touches) {
            DayPilotMenu.mouse = DayPilotMenu.touchPosition(ev);
        }
    };
    // publish the API

    DayPilot.Menu.hide = function(options) {
        options = options || {};

        if (options.calendar) {
            var active = DayPilot.Menu.active;
            if (active) {
                var source = active._state.source;
                if (source && source.calendar === options.calendar) {
                    DayPilotMenu.menuClean();
                }
            }
        }
        else {
            DayPilotMenu.menuClean();
        }
    };

    // current
    //DayPilot.Menu = DayPilotMenu.Menu;
    if (!DayPilotMenu.handlersRegistered && typeof document !== 'undefined') {
        DayPilot.re(document, 'mousemove', DayPilotMenu.mouseMove);
        DayPilot.re(document, 'mousedown', DayPilotMenu.mouseDown);
        DayPilot.re(document, 'touchmove', DayPilotMenu.touchMove);
        DayPilot.re(document, 'touchstart', DayPilotMenu.touchStart);
        DayPilot.re(document, 'touchend', DayPilotMenu.touchEnd);
        DayPilotMenu.handlersRegistered = true;
    }

    DayPilot.Menu.def = {};

})(DayPilot);
