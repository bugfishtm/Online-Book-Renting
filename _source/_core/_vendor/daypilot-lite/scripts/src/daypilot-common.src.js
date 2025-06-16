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

(function() {

    if (typeof DayPilot.$ !== 'undefined') {
        return;
    }

    if (typeof DayPilot.Global === "undefined") {
        DayPilot.Global = {};
    }

    DayPilot.$ = function(id) {
      return document.getElementById(id);
    };

    Object.defineProperty(DayPilot, 'isKhtml', {
        get: function() { return typeof navigator !== "undefined" && navigator.userAgent && navigator.userAgent.indexOf("KHTML") !== -1; }
    });

    DayPilot.mo2 = function (target, ev){
        ev = ev || window.event;

        // IE
        if (typeof(ev.offsetX) !== 'undefined') {

            var coords = {x: ev.offsetX + 1, y:ev.offsetY  + 1};
            //document.title = "ie/doc:" + document.documentElement.scrollTop;

            if (!target) {
                return coords;
            }

            var current = ev.srcElement;
            while (current && current !== target) {
                if (current.tagName !== 'SPAN') { // hack for DayPilotMonth/IE, hour info on the right side of an event
		            coords.x += current.offsetLeft;
		            if (current.offsetTop > 0) {  // hack for http://forums.daypilot.org/Topic.aspx/879/move_event_bug
		                coords.y += current.offsetTop - current.scrollTop;
		            }
		        }

		        current = current.offsetParent;
	        }

	        if (current) {
		        return coords;
	        }
	        return null;
        }

        // FF
        if (typeof(ev.layerX) !== 'undefined') {

            var coords = {x:ev.layerX, y:ev.layerY, src: ev.target};

            if (!target) {
                return coords;
            }
	        var current = ev.target;

	        // find the positioned offsetParent, the layerX reference
	        while (current && current.style.position !== 'absolute' && current.style.position !== 'relative') {
	            current = current.parentNode;
	            if (DayPilot.isKhtml) { // hack for KHTML (Safari and Google Chrome), used in DPC/event moving
	                coords.y += current.scrollTop;
	            }
	        }

	        while (current && current !== target) {
		        coords.x += current.offsetLeft;
		        coords.y += current.offsetTop - current.scrollTop;
		        current = current.offsetParent;
	        }
	        if (current) {
		        return coords;
	        }

	        return null;
        }

        return null;
    };

    // mouse offset relative to the specified target
    DayPilot.mo3 = function(target, ev) {
        var coords;
        var page = DayPilot.page(ev);
        if (page) {
            if (target) {
                var abs = DayPilot.abs(target);
                if (!abs) {
                    throw new Error("no abs");
                    return null;
                }
                coords = {x: page.x - abs.x, y: page.y - abs.y};
            }
            else {
                coords = {x: page.x, y: page.y};
            }
        }
        else {
            coords = DayPilot.mo2(target, ev);
            if (!coords) {
                // throw new Error("no coords");
                return null;
            }
        }

        coords.shift = ev.shiftKey;
        coords.meta = ev.metaKey;
        coords.ctrl = ev.ctrlKey;
        coords.alt = ev.altKey;

        return coords;
    };

    DayPilot.browser = {};

    Object.defineProperty(DayPilot.browser, 'hover', {
        get: function() { return !window.matchMedia("(any-hover: none)").matches; }
    });

    DayPilot.touch = {};

    // returns pageX, pageY (calculated from clientX if pageX is not available)
    DayPilot.page = function(ev) {
        // required for chrome/android
        var target = ev.changedTouches && ev.changedTouches[0] ? ev.changedTouches[0] : ev;

        if (typeof target.pageX !== 'undefined') {
            return {x: target.pageX, y: target.pageY};
        }
        if (typeof ev.clientX !== 'undefined' && document.body && document.documentElement) {
            return {
                x: ev.clientX + document.body.scrollLeft + document.documentElement.scrollLeft,
                y: ev.clientY + document.body.scrollTop + document.documentElement.scrollTop
            };
        }
        // shouldn't happen
        return null;
    };

    // absolute element position on page
    DayPilot.abs = function(element, visible) {
        if (!element) {
            return null;
        }

        if (element.getBoundingClientRect) {
            var r = DayPilot.absBoundingClientBased(element);

            if (visible) {
                // use diff, absOffsetBased is not as accurate
                var full = DayPilot.absOffsetBased(element, false);
                var visible = DayPilot.absOffsetBased(element, true);

                r.x += visible.x - full.x;
                r.y += visible.y - full.y;
                r.w = visible.w;
                r.h = visible.h;
            }

            return r;
        }
        else {
            return DayPilot.absOffsetBased(element, visible);
        }

    };

    DayPilot.absBoundingClientBased = function(element) {
        var elemRect = element.getBoundingClientRect();

        return {
            // x: elemRect.left + window.scrollX,   // IE11 doesn't support this
            x: elemRect.left + window.pageXOffset,
            // y: elemRect.top + window.scrollY,   // IE11 doesn't support this
            y: elemRect.top + window.pageYOffset,
            w: element.clientWidth,
            h: element.clientHeight,
            toString: function() {
                return "x:" + this.x + " y:" + this.y + " w:" + this.w + " h:" + this.h;
            }
        };
    };


    // old implementation of absolute position
    // problems with adjacent float and margin-left in IE7
    // still the best way to calculate the visible part of the element
    DayPilot.absOffsetBased = function(element, visible) {
        var r = {
            x: element.offsetLeft,
            y: element.offsetTop,
            w: element.clientWidth,
            h: element.clientHeight,
            toString: function() {
                return "x:" + this.x + " y:" + this.y + " w:" + this.w + " h:" + this.h;
            }
        };

        while (element.offsetParent) {
            element = element.offsetParent;

            r.x -= element.scrollLeft;
            r.y -= element.scrollTop;

            if (visible) {  // calculates the visible part
                if (r.x < 0) {
                    r.w += r.x; // decrease width
                    r.x = 0;
                }

                if (r.y < 0) {
                    r.h += r.y; // decrease height
                    r.y = 0;
                }

                if (element.scrollLeft > 0 && r.x + r.w > element.clientWidth) {
                    r.w -= r.x + r.w - element.clientWidth;
                }

                if (element.scrollTop && r.y + r.h > element.clientHeight) {
                    r.h -= r.y + r.h - element.clientHeight;
                }
            }

            r.x += element.offsetLeft;
            r.y += element.offsetTop;

        }

        var pageOffset = DayPilot.pageOffset();
        r.x += pageOffset.x;
        r.y += pageOffset.y;

        return r;
    };

    DayPilot.isArray = function(o) {
        return Object.prototype.toString.call(o) === '[object Array]';
    };

    // distance of two points, works with x and y
    DayPilot.distance = function(point1, point2) {
        return Math.sqrt(Math.pow(point1.x - point2.x, 2) + Math.pow(point1.y - point2.y, 2));
    };

    DayPilot.sheet = function() {

        if (typeof window === "undefined") {
            // next.js server-side rendering
            var sheet = {};
            sheet.add = function() {};
            sheet.commit = function() {};
            return sheet;
        }

        var style = document.createElement("style");
        style.setAttribute("type", "text/css");
        if (!style.styleSheet) {   // ie
            style.appendChild(document.createTextNode(""));
        }

        var h = document.head || document.getElementsByTagName('head')[0];
        h.appendChild(style);

        var oldStyle = !! style.styleSheet; // old ie

        var sheet = {};
        sheet.rules = [];
        sheet.commit = function() {
            if (oldStyle) {
                style.styleSheet.cssText = this.rules.join("\n");
            }
        };

        sheet.add = function(selector, rules, index) {
            if (oldStyle) {
                this.rules.push(selector + "{" + rules + "\u007d");
                return;
            }
            if(style.sheet.insertRule) {
                if (typeof index === "undefined") {
                    index = style.sheet.cssRules.length;
                }
                style.sheet.insertRule(selector + "{" + rules + "\u007d", index);
            }
            else if (style.sheet.addRule) {
                style.sheet.addRule(selector, rules, index);
            }
        };
        return sheet;
    };

    DayPilot.gs = function(el, styleProp) {
        return window.getComputedStyle(el, null).getPropertyValue(styleProp) || "";
    };

    DayPilot.StyleReader = function(element) {

        this.get = function(property) {
            if (!element) {
                return null;
            }
            return DayPilot.gs(element, property);
        };

        this.getPx = function(property) {
            var val = this.get(property);
            if (val.indexOf("px") === -1) {
                return undefined;
            }
            else {
                return parseInt(val, 10);
            }
        };

    };

    // register the default themes
    (function() {
        if (DayPilot.Global.defaultCss) {
            return;
        }

        var sheet = DayPilot.sheet();

        sheet.add(".calendar_default_main", "border: 1px solid #c0c0c0; font-family: -apple-system,system-ui,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif; font-size: 13px;");
        sheet.add(".calendar_default_main *, .calendar_default_main *:before, .calendar_default_main *:after", "box-sizing: content-box;");  // bootstrap
        sheet.add(".calendar_default_rowheader_inner,.calendar_default_cornerright_inner,.calendar_default_corner_inner,.calendar_default_colheader_inner,.calendar_default_alldayheader_inner", "color: #333;background: #f3f3f3;");
        sheet.add(".calendar_default_cornerright_inner", "position: absolute;top: 0px;left: 0px;bottom: 0px;right: 0px;	border-bottom: 1px solid #c0c0c0;");
        sheet.add(".calendar_default_direction_rtl .calendar_default_cornerright_inner", "border-right: 1px solid #c0c0c0;");
        sheet.add(".calendar_default_rowheader_inner", "font-size: 16pt;text-align: right; position: absolute;top: 0px;left: 0px;bottom: 0px;right: 0px;border-right: 1px solid #c0c0c0;border-bottom: 1px solid #c0c0c0; padding: 3px;");
        sheet.add(".calendar_default_direction_rtl .calendar_default_rowheader_inner", "border-right: none;");
        sheet.add(".calendar_default_corner_inner", "position: absolute;top: 0px;left: 0px;bottom: 0px;right: 0px;border-right: 1px solid #c0c0c0;border-bottom: 1px solid #c0c0c0;");
        sheet.add(".calendar_default_direction_rtl .calendar_default_corner_inner", "border-right: none;");
        sheet.add(".calendar_default_rowheader_minutes", "font-size:10px;vertical-align: super;padding-left: 2px;padding-right: 2px;");
        sheet.add(".calendar_default_colheader_inner", "position: absolute;top: 0px;left: 0px;bottom: 0px;right: 0px;border-right: 1px solid #c0c0c0;border-bottom: 1px solid #c0c0c0; display: flex; align-items: center; justify-content: center; font-size: 13px;");
        sheet.add(".calendar_default_cell_inner", "position: absolute;top: 0px;left: 0px;bottom: 0px;right: 0px;border-right: 1px solid #ddd;border-bottom: 1px solid #ddd; background: #f9f9f9;");
        sheet.add(".calendar_default_cell_business .calendar_default_cell_inner", "background: #fff");
        sheet.add(".calendar_default_alldayheader_inner", "text-align: center;position: absolute;top: 0px;left: 0px;bottom: 0px;right: 0px;border-right: 1px solid #c0c0c0;border-bottom: 1px solid #c0c0c0;");
        sheet.add(".calendar_default_message", "opacity: 0.9; padding: 10px; color: #ffffff;background: #ffa216;");
        sheet.add(".calendar_default_alldayevent_inner,.calendar_default_event_inner", 'color: #333; border: 1px solid #999;'); // border-top: 4px solid #1066a8;
        sheet.add(".calendar_default_event_bar", "top: 0px;bottom: 0px;left: 0px;width: 6px;background-color: #9dc8e8;");
        sheet.add(".calendar_default_event_bar_inner", "position: absolute;width: 6px;background-color: #1066a8;");
        sheet.add(".calendar_default_alldayevent_inner,.calendar_default_event_inner", 'background: #fff;background: -webkit-gradient(linear, left top, left bottom, from(#ffffff), to(#eeeeee));background: -webkit-linear-gradient(top, #ffffff 0%, #eeeeee);background: -moz-linear-gradient(top, #ffffff 0%, #eeeeee);background: -ms-linear-gradient(top, #ffffff 0%, #eeeeee);background: -o-linear-gradient(top, #ffffff 0%, #eeeeee);background: linear-gradient(top, #ffffff 0%, #eeeeee);filter: progid:DXImageTransform.Microsoft.Gradient(startColorStr="#ffffff", endColorStr="#eeeeee");');
        sheet.add(".calendar_default_selected .calendar_default_event_inner", "background: #ddd;");
        sheet.add(".calendar_default_alldayevent_inner", "position: absolute;top: 2px;bottom: 2px;left: 2px;right: 2px;overflow:hidden;padding: 2px;margin-right: 1px; font-size: 13px;");
        sheet.add(".calendar_default_event_withheader .calendar_default_event_inner", "padding-top: 15px;");
        sheet.add(".calendar_default_event", "cursor: default;");
        sheet.add(".calendar_default_event_inner", "position: absolute;overflow: hidden;top: 0px;bottom: 0px;left: 0px;right: 0px;padding: 2px 2px 2px 8px; font-size: 13px;");
        sheet.add(".calendar_default_event_delete", "background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAALCAYAAACprHcmAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAadEVYdFNvZnR3YXJlAFBhaW50Lk5FVCB2My41LjExR/NCNwAAAI5JREFUKFNtkLERgCAMRbmzdK8s4gAUlhYOYEHJEJYOYOEwDmGBPxC4kOPfvePy84MGR0RJ2N1A8H3N6DATwSQ57m2ql8NBG+AEM7D+UW+wjdfUPgerYNgB5gOLRHqhcasg84C2QxPMtrUhSqQIhg7ypy9VM2EUZPI/4rQ7rGxqo9sadTegw+UdjeDLAKUfhbaQUVPIfJYAAAAASUVORK5CYII=) center center no-repeat; opacity: 0.6; cursor: pointer;");
        sheet.add(".calendar_default_event_delete:hover", "opacity: 1;-ms-filter: none;");
        sheet.add(".calendar_default_scroll_up", "background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAB3RJTUUH2wESDiYcrhwCiQAAAAlwSFlzAAAuIwAALiMBeKU/dgAAAARnQU1BAACxjwv8YQUAAACcSURBVHjaY2AgF9wWsTW6yGMlhi7OhC7AyMDQzMnBXIpFHAFuCtuaMTP+P8nA8P/b1x//FfW/HHuF1UQmxv+NUP1c3OxMVVhNvCVi683E8H8LXOY/w9+fTH81tF8fv4NiIpBRj+YoZtZ/LDUoJmKYhsVUpv0MDiyMDP96sIYV0FS2/8z9ICaLlOhvS4b/jC//MzC8xBG0vJeF7GQBlK0xdiUzCtsAAAAASUVORK5CYII=);");
        sheet.add(".calendar_default_scroll_down", "background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAALiMAAC4jAXilP3YAAACqSURBVChTY7wpam3L9J+xmQEP+PGPKZZxP4MDi4zI78uMDIwa2NT+Z2DYovrmiC+TI8OBP/8ZmEqwGvif4e8vxr+FIDkmEKH25vBWBgbG0+iK/zEwLtF+ffwOXCGI8Y+BoRFFIdC030x/WmBiYBNhpgLdswNJ8RSYaSgmgk39z1gPUfj/29ef/9rwhQTDHRHbrbdEbLvRFcGthkkAra/9/uMvhkK8piNLAgCRpTnNn4AEmAAAAABJRU5ErkJggg==);");
        sheet.add(".calendar_default_now", "background-color: red;");
        sheet.add(".calendar_default_now:before", "content: ''; top: -5px; border-width: 5px; border-color: transparent transparent transparent red; border-style: solid; width: 0px; height:0px; position: absolute; -moz-transform: scale(.9999);");
        sheet.add(".calendar_default_shadow_top", 'box-sizing: border-box; padding:2px;border:1px solid #ccc;background:#fff;background: -webkit-gradient(linear, left top, left bottom, from(#ffffff), to(#eeeeee));background: -webkit-linear-gradient(top, #ffffff 0%, #eeeeee);background: -moz-linear-gradient(top, #ffffff 0%, #eeeeee);background: -ms-linear-gradient(top, #ffffff 0%, #eeeeee);background: -o-linear-gradient(top, #ffffff 0%, #eeeeee);background: linear-gradient(top, #ffffff 0%, #eeeeee);filter: progid:DXImageTransform.Microsoft.Gradient(startColorStr="#ffffff", endColorStr="#eeeeee");');
        sheet.add(".calendar_default_shadow_bottom", 'box-sizing: border-box; padding:2px;border:1px solid #ccc;background:#fff;background: -webkit-gradient(linear, left top, left bottom, from(#ffffff), to(#eeeeee));background: -webkit-linear-gradient(top, #ffffff 0%, #eeeeee);background: -moz-linear-gradient(top, #ffffff 0%, #eeeeee);background: -ms-linear-gradient(top, #ffffff 0%, #eeeeee);background: -o-linear-gradient(top, #ffffff 0%, #eeeeee);background: linear-gradient(top, #ffffff 0%, #eeeeee);filter: progid:DXImageTransform.Microsoft.Gradient(startColorStr="#ffffff", endColorStr="#eeeeee");');
        sheet.add(".calendar_default_crosshair_vertical, .calendar_default_crosshair_horizontal, .calendar_default_crosshair_left, .calendar_default_crosshair_top", "background-color: gray; opacity: 0.2;");
        sheet.add(".calendar_default_loading", "background-color: orange; color: white; padding: 2px;");
        sheet.add(".calendar_default_scroll", "background-color: #f3f3f3;");
        sheet.add(".calendar_default_event_moving_source", "opacity: 0.5;");
        sheet.add(".calendar_default_shadow_inner", "box-sizing: border-box; background-color: #bbbbbb;border: 1px solid #888888;opacity: 0.5;height: 100%;");
        sheet.add(".calendar_default_shadow", "box-shadow: 0 2px 5px rgba(0,0,0,.2);");


        // menu
        sheet.add(".menu_default_main", "user-select:none; font-family: -apple-system,system-ui,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;font-size: 13px;border: 1px solid #dddddd;background-color: white;padding: 0px;cursor: default;background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAABCAIAAABG0om7AAAAKXRFWHRDcmVhdGlvbiBUaW1lAHBvIDEwIDUgMjAxMCAyMjozMzo1OSArMDEwMGzy7+IAAAAHdElNRQfaBQoUJAesj4VUAAAACXBIWXMAAA7DAAAOwwHHb6hkAAAABGdBTUEAALGPC/xhBQAAABVJREFUeNpj/P//PwO1weMnT2RlZAAYuwX/4oA3BgAAAABJRU5ErkJggg==);background-repeat: repeat-y;xborder-radius: 5px;-moz-box-shadow:0px 2px 3px rgba(000,000,000,0.3),inset 0px 0px 2px rgba(255,255,255,0.8);-webkit-box-shadow:0px 2px 3px rgba(000,000,000,0.3),inset 0px 0px 2px rgba(255,255,255,0.8);box-shadow:0px 2px 3px rgba(000,000,000,0.3),inset 0px 0px 2px rgba(255,255,255,0.8);");
        sheet.add(".menu_default_main, .menu_default_main *, .menu_default_main *:before, .menu_default_main *:after", "box-sizing: content-box;");
        sheet.add(".menu_default_title", "background-color: #f2f2f2;border-bottom: 1px solid gray;padding: 4px 4px 4px 37px;");
        sheet.add(".menu_default_main a", "padding: 2px 2px 2px 35px;color: black;text-decoration: none;cursor: default;");
        sheet.add(".menu_default_main.menu_default_withchildren a", "padding: 2px 35px 2px 35px;");
        sheet.add(".menu_default_main a img", "margin-left: 6px;margin-top: 2px;");
        sheet.add(".menu_default_item_text", "display: block;height: 20px;line-height: 20px; overflow:hidden;padding-left: 2px;padding-right: 20px; white-space: nowrap;");
        sheet.add(".menu_default_main a:hover", "background-color: #f3f3f3;");
        sheet.add(".menu_default_main div div", "border-top: 1px solid #dddddd;margin-top: 2px;margin-bottom: 2px;margin-left: 28px;");
        sheet.add(".menu_default_main a.menu_default_item_disabled", "color: #ccc");
        sheet.add(".menu_default_item_haschildren.menu_default_item_haschildren_active", 'background-color: #f3f3f3;');
        sheet.add(".menu_default_item_haschildren a:before", "content: ''; border-width: 5px; border-color: transparent transparent transparent #666; border-style: solid; width: 0px; height:0px; position: absolute; right: 5px; margin-top: 5px;");
        sheet.add(".menu_default_item_icon", "position: absolute; top:0px; left: 0px; padding: 2px 2px 2px 8px;");
        sheet.add(".menu_default_item a i", "height: 20px;line-height: 20px;");
        sheet.add(".menu_default_item .menu_default_item_symbol", "width: 18px; height: 18px; color: #999; margin-left: 6px;margin-top: 2px;");


        // menubar
        sheet.add(".menubar_default_main", "border-bottom: 1px solid #ccc; font-family: -apple-system,system-ui,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif; font-size: 13px; user-select:none;");
        sheet.add(".menubar_default_item", "display: inline-block;  padding: 6px 10px; cursor: default;");
        sheet.add(".menubar_default_item:hover", "background-color: #f2f2f2;");
        sheet.add(".menubar_default_item_active", "background-color: #f2f2f2;");


        sheet.add(".scheduler_default_selected .scheduler_default_event_inner", "background: #ddd;");
        sheet.add(".scheduler_default_main", "border: 1px solid #c0c0c0;font-family: -apple-system,system-ui,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif; font-size: 13px;");
        sheet.add(".scheduler_default_timeheader", "cursor: default;color: #333;");
        sheet.add(".scheduler_default_message", "opacity: 0.9;filter: alpha(opacity=90);padding: 10px; color: #ffffff;background: #ffa216;");
        sheet.add(".scheduler_default_timeheadergroup,.scheduler_default_timeheadercol", "color: #333;background: #f3f3f3;");
        sheet.add(".scheduler_default_rowheader,.scheduler_default_corner", "color: #333;background: #f3f3f3;");
        sheet.add(".scheduler_default_rowheader_inner", "position: absolute;left: 0px;right: 0px;top: 0px;bottom: 0px;border-right: 1px solid #eee;padding: 2px;");
        sheet.add(".scheduler_default_timeheadergroup, .scheduler_default_timeheadercol", "text-align: center;");
        sheet.add(".scheduler_default_timeheadergroup_inner", "position: absolute;left: 0px;right: 0px;top: 0px;bottom: 0px;border-right: 1px solid #c0c0c0;border-bottom: 1px solid #c0c0c0;");
        sheet.add(".scheduler_default_timeheadercol_inner", "position: absolute;left: 0px;right: 0px;top: 0px;bottom: 0px;border-right: 1px solid #c0c0c0;");
        sheet.add(".scheduler_default_divider", "background-color: #c0c0c0;");
        sheet.add(".scheduler_default_divider_horizontal", "background-color: #c0c0c0;");
        sheet.add(".scheduler_default_matrix_vertical_line", "background-color: #eee;");
        sheet.add(".scheduler_default_matrix_vertical_break", "background-color: #000;");
        sheet.add(".scheduler_default_matrix_horizontal_line", "background-color: #eee;");
        sheet.add(".scheduler_default_resourcedivider", "background-color: #c0c0c0;");
        sheet.add(".scheduler_default_shadow_inner", "background-color: #666666;opacity: 0.5;filter: alpha(opacity=50);height: 100%;xborder-radius: 5px;");
        sheet.add(".scheduler_default_event", "color:#333; font-size: 13px;");
        sheet.add(".scheduler_default_event_inner", "position:absolute;top:0px;left:0px;right:0px;bottom:0px;padding:5px 2px 2px 2px;overflow:hidden;border:1px solid #ccc;");
        sheet.add(".scheduler_default_event_bar", "top:0px;left:0px;right:0px;height:4px;background-color:#9dc8e8;");
        sheet.add(".scheduler_default_event_bar_inner", "position:absolute;height:4px;background-color:#1066a8;");
        sheet.add(".scheduler_default_event_inner", 'background:#fff;background: -webkit-gradient(linear, left top, left bottom, from(#ffffff), to(#eeeeee));background: -webkit-linear-gradient(top, #ffffff 0%, #eeeeee);background: -moz-linear-gradient(top, #ffffff 0%, #eeeeee);background: -ms-linear-gradient(top, #ffffff 0%, #eeeeee);background: -o-linear-gradient(top, #ffffff 0%, #eeeeee);background: linear-gradient(top, #ffffff 0%, #eeeeee);filter: progid:DXImageTransform.Microsoft.Gradient(startColorStr="#ffffff", endColorStr="#eeeeee");');
        sheet.add(".scheduler_default_event_float_inner", "padding:6px 2px 2px 8px;"); // space for arrow
        sheet.add(".scheduler_default_event_float_inner:after", 'content:"";border-color: transparent #666 transparent transparent;border-style:solid;border-width:5px;width:0;height:0;position:absolute;top:8px;left:-4px;');
        sheet.add(".scheduler_default_columnheader_inner", "font-weight: bold;");
        sheet.add(".scheduler_default_columnheader_splitter", "background-color: #666;opacity: 0.5;filter: alpha(opacity=50);");
        sheet.add(".scheduler_default_columnheader_cell_inner", "padding: 2px;");
        sheet.add(".scheduler_default_cell", "background-color: #f9f9f9;");
        sheet.add(".scheduler_default_cell.scheduler_default_cell_business", "background-color: #fff;");

        sheet.add(".navigator_default_main", "border-left: 1px solid #c0c0c0;border-right: 1px solid #c0c0c0;border-bottom: 1px solid #c0c0c0;background-color: white;color: #000000; box-sizing: content-box;");
        sheet.add(".navigator_default_main *, .navigator_default_main *:before, .navigator_default_main *:after", "box-sizing: content-box;");
        sheet.add(".navigator_default_month", "font-family: -apple-system,system-ui,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif; font-size: 12px;");
        sheet.add(".navigator_default_day", "color: black;");
        sheet.add(".navigator_default_weekend", "background-color: #f0f0f0;");
        sheet.add(".navigator_default_dayheader", "color: black;");
        sheet.add(".navigator_default_line", "border-bottom: 1px solid #c0c0c0;");
        sheet.add(".navigator_default_dayother", "color: gray;");
        sheet.add(".navigator_default_todaybox", "border: 1px solid red;");
        sheet.add(".navigator_default_title, .navigator_default_titleleft, .navigator_default_titleright", "border-top: 1px solid #c0c0c0;border-bottom: 1px solid #c0c0c0;color: #333;background: #f3f3f3;");
        sheet.add(".navigator_default_busy", "font-weight: bold;");
        sheet.add(".navigator_default_cell", "text-align: center;");
        sheet.add(".navigator_default_select .navigator_default_cell_box", "background-color: #FFE794; opacity: 0.5;");
        sheet.add(".navigator_default_title", "text-align: center;");
        sheet.add(".navigator_default_titleleft, .navigator_default_titleright", "text-align: center;");
        sheet.add(".navigator_default_dayheader", "text-align: center;");
        sheet.add(".navigator_default_weeknumber", "text-align: center; color: #999;");
        sheet.add(".navigator_default_cell_text", "cursor: pointer;");

        sheet.add(".month_default_main", "border: 1px solid #c0c0c0;font-family: -apple-system,system-ui,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif; font-size: 13px;color: #333;");
        sheet.add(".month_default_main *, .month_default_main *:before, .month_default_main *:after", "box-sizing: content-box;");
        sheet.add(".month_default_cell_inner", "border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;position: absolute;top: 0px;left: 0px;bottom: 0px;right: 0px;background-color: #f9f9f9;");
        sheet.add(".month_default_cell_business .month_default_cell_inner", "background-color: #fff;");
        sheet.add(".month_default_cell_header", "text-align: right; padding: 4px; box-sizing: border-box;");
        sheet.add(".month_default_header_inner", 'position: absolute;top: 0px;left: 0px;bottom: 0px;right: 0px;border-right: 1px solid #c0c0c0;border-bottom: 1px solid #c0c0c0;cursor: default;color: #333;background: #f3f3f3; overflow:hidden; display: flex; align-items: center; justify-content: center;');
        sheet.add(".month_default_message", 'padding: 10px;opacity: 0.9; color: #ffffff;background: #ffa216;');
        sheet.add(".month_default_event_inner", 'position: absolute;top: 0px;bottom: 0px;left: 1px;right: 1px;overflow:hidden;padding: 2px;padding-left: 10px;color: #333;background: #fff;background: linear-gradient(to bottom, #ffffff 0%, #eeeeee);border: 1px solid #999;border-radius: 0px;display: flex; align-items: center; font-size: 13px;');
        sheet.add(".month_default_event_continueright .month_default_event_inner", "border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-right-style: dotted;");
        sheet.add(".month_default_event_continueleft .month_default_event_inner", "border-top-left-radius: 0px;border-bottom-left-radius: 0px;border-left-style: dotted;");

        sheet.add(".month_default_event_bar", "top: 0px;bottom: 0px;left: 0px;width: 6px;");
        sheet.add(".month_default_event_bar_inner", "position: absolute;width: 6px;background-color: #1066a8;");
        sheet.add(".month_default_event_continueleft .month_default_event_bar", "display: none;");

        sheet.add(".month_default_selected .month_default_event_inner", "background: #ddd;");
        // sheet.add(".month_default_shadow_inner", "background-color: #666666;opacity: 0.5;height: 100%;");
        sheet.add(".month_default_event_delete", "background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAALCAYAAACprHcmAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAadEVYdFNvZnR3YXJlAFBhaW50Lk5FVCB2My41LjExR/NCNwAAAI5JREFUKFNtkLERgCAMRbmzdK8s4gAUlhYOYEHJEJYOYOEwDmGBPxC4kOPfvePy84MGR0RJ2N1A8H3N6DATwSQ57m2ql8NBG+AEM7D+UW+wjdfUPgerYNgB5gOLRHqhcasg84C2QxPMtrUhSqQIhg7ypy9VM2EUZPI/4rQ7rGxqo9sadTegw+UdjeDLAKUfhbaQUVPIfJYAAAAASUVORK5CYII=) center center no-repeat; opacity: 0.6; cursor: pointer;");
        sheet.add(".month_default_event_delete:hover", "opacity: 1;-ms-filter: none;");
        sheet.add(".month_default_event_timeleft", "color: #ccc; font-size: 8pt");
        sheet.add(".month_default_event_timeright", "color: #ccc; font-size: 8pt; text-align: right;");
        sheet.add(".month_default_loading", "background-color: orange; color: white; padding: 2px;");
        sheet.add(".month_default_shadow_inner", "box-sizing: border-box; background-color: #bbbbbb;border: 1px solid #888888;opacity: 0.5;height: 100%;");
        sheet.add(".month_default_shadow", "box-shadow: 0 2px 5px rgba(0,0,0,.2);");

        sheet.commit();

        DayPilot.Global.defaultCss = true;
    })();

    // document element
    DayPilot.doc = function() {
        var de = document.documentElement;
        return (de && de.clientHeight) ? de : document.body;
    };

    DayPilot.guid = function() {
        var S4 = function() {
            return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
        };
        return ("" + S4() + S4() + "-" + S4() + "-" + S4() + "-" + S4() + "-" + S4() + S4() + S4());
    };

    DayPilot.pageOffset = function() {
        if (typeof pageXOffset !== 'undefined') {
            return { x: pageXOffset, y: pageYOffset };
        }
        var d = DayPilot.doc();
        return { x: d.scrollLeft, y: d.scrollTop };
    };

    DayPilot.indexOf = function(array, object) {
        if (!array || !array.length) {
            return -1;
        }
        for (var i = 0; i < array.length; i++) {
            if (array[i] === object) {
                return i;
            }
        }
        return -1;
    };

    // all children
    DayPilot.ac = function(e, children) {
        if (!children) {
            var children = [];
        }
        for (var i = 0; e.children && i < e.children.length; i++) {
            children.push(e.children[i]);
            DayPilot.ac(e.children[i], children);
        }

        return children;
    };

    // remove from array
    DayPilot.rfa = function(array, object) {
        var i = DayPilot.indexOf(array, object);
        if (i === -1) {
            return;
        }
        array.splice(i, 1);
    };

    // mouse coords
    DayPilot.mc = function(ev){
        if(ev.pageX || ev.pageY){
	        return {x:ev.pageX, y:ev.pageY};
        }
        return {
	        x:ev.clientX + document.documentElement.scrollLeft,
	        y:ev.clientY + document.documentElement.scrollTop
        };
    };

    DayPilot.Stats = {};
    DayPilot.Stats.eventObjects = 0;
    DayPilot.Stats.dateObjects = 0;
    DayPilot.Stats.cacheHitsCtor = 0;
    DayPilot.Stats.cacheHitsParsing = 0;
    DayPilot.Stats.cacheHitsTicks = 0;

    DayPilot.re = function(el, ev, func) {
        if (!func) {
            return;
        }
        if (!ev) {
            return;
        }
        if (!el) {
            return;
        }
        el.addEventListener(ev, func, false);
    };

    DayPilot.rePassive = function(el, ev, func) {
        if (!func) {
            return;
        }
        if (!ev) {
            return;
        }
        if (!el) {
            return;
        }
        el.addEventListener(ev, func, {"passive": true});
    };

    DayPilot.reNonPassive = function(el, ev, func) {
        if (!func) {
            return;
        }
        if (!ev) {
            return;
        }
        if (!el) {
            return;
        }
        el.addEventListener(ev, func, {"passive": false});
    };

    // purge
    // thanks to http://javascript.crockford.com/memory/leak.html
    DayPilot.pu = function(d) {
        //var removed = [];
        //var start = new Date();
        var a = d.attributes, i, l, n;
        if (a) {
            l = a.length;
            for (i = 0; i < l; i += 1) {
                if (!a[i]) {
                    continue;
                }
                n = a[i].name;
                if (typeof d[n] === 'function') {
                    d[n] = null;
                }
            }
        }
        a = d.childNodes;
        if (a) {
            l = a.length;
            for (i = 0; i < l; i += 1) {
                var children = DayPilot.pu(d.childNodes[i]);
            }
        }
    };

    // delete element
    DayPilot.de = function(e) {
        if (!e) {
            return;
        }
        if (DayPilot.isArray(e)) {
            for (var i = 0; i < e.length; i++) {
                DayPilot.de(e[i]);
            }
            return;
        }
        e.parentNode && e.parentNode.removeChild(e);
    };

    // vertical scrollbar width
    DayPilot.sw = function(element) {
        if (!element) {
            return 0;
        }
        return element.offsetWidth - element.clientWidth;
    };

    // angular module
    DayPilot.am = function() {
        if (typeof angular === "undefined") {
            return null;
        }
        if (!DayPilot.am.cached) {
            DayPilot.am.cached = angular.module("daypilot", []);
        }
        return DayPilot.am.cached;
    };

    DayPilot.Selection = function (start, end, resource, root) {
        this.type = 'selection';
        this.start = start.isDayPilotDate ? start : new DayPilot.Date(start);
        this.end = end.isDayPilotDate ? end : new DayPilot.Date(end);
        this.resource = resource;
        this.root = root;

        this.toJSON = function(key) {
            var json = {};
            json.start = this.start;
            json.end = this.end;
            json.resource = this.resource;

            return json;
        };
    };

    /* XMLHttpRequest */

    DayPilot.request = function(url, callback, postData, errorCallback) {
        var req = DayPilot.createXmlHttp();
        if (!req) {
            return;
        }

        req.open("POST", url, true);
        req.setRequestHeader('Content-type', 'text/plain');
        req.onreadystatechange = function() {
            if (req.readyState !== 4)
                return;
            if (req.status !== 200 && req.status !== 304) {
                if (errorCallback) {
                    errorCallback(req);
                }
                else {
                    if (window.console) { console.log('HTTP error ' + req.status); }
                }
                return;
            }
            callback(req);
        };
        if (req.readyState === 4) {
            return;
        }
        if (typeof postData === 'object') {
            postData = JSON.stringify(postData);
        }
        req.send(postData);
    };

    DayPilot.ajax = function(params) {
        if (!params) {
            throw new DayPilot.Exception("Parameter object required.");
        }

        if (typeof params.url !== "string") {
            throw new DayPilot.Exception("The parameter object must have 'url' property.")
        }

        var req = DayPilot.createXmlHttp();
        if (!req) {
            throw new DayPilot.Exception("Unable to create XMLHttpRequest object");
        }

        var dataIsObject = typeof params.data === "object";

        var data = params.data;
        var method = params.method || (params.data ? "POST" : "GET");
        var success = params.success || function() {};
        var error = params.error || function() {};
        var url = params.url;
        var contentType = params.contentType || (dataIsObject ? "application/json" : "text/plain");
        var headers = params.headers || {};

        req.open(method, url, true);
        req.setRequestHeader('Content-type', contentType);

        // overriding the content-type is allowed
        DayPilot.Util.ownPropsAsArray(headers).forEach(function(item) {
            req.setRequestHeader(item.key, item.val);
        });

        req.onreadystatechange = function() {
            if (req.readyState !== 4) {
                return;
            }
            if (req.status !== 200 && req.status !== 201 && req.status !== 204 && req.status !== 304) {
                if (error) {
                    var args = {};
                    args.request = req;
                    error(args);
                }
                else {
                    if (window.console) { console.log('HTTP error ' + req.status); }
                }
                return;
            }
            var args = {};
            args.request = req;
            if (req.responseText) {
                args.data = JSON.parse(req.responseText);
            }
            success(args);
        };
        if (req.readyState === 4) {
            return;
        }
        if (dataIsObject) {
            data = JSON.stringify(data);
        }
        req.send(data);
    };

    DayPilot.createXmlHttp = function() {
        return new XMLHttpRequest();
    };

    DayPilot.Http = {};

    DayPilot.Http.ajax = function(params) {
        DayPilot.ajax(params);
    };

    /*
allowed params:
- headers
- contentType
 */
    DayPilot.Http.get = function(url, params) {
        params = params || {};
        return new Promise(function(resolve, reject) {
            var aparams = {};
            aparams.url = url;
            aparams.method = "GET";
            aparams.success = function(args) {
                resolve(args);
            };
            aparams.error = function(args) {
                reject(args);
            };
            aparams.contentType = params.contentType;
            aparams.headers = params.headers;

            DayPilot.ajax(aparams);
        });
    };

    DayPilot.Http.post = function(url, data, params) {
        params = params || {};
        return new Promise(function(resolve, reject) {
            var aparams = {};
            aparams.url = url;
            aparams.method = "POST";
            aparams.data = data;
            aparams.success = function(args) {
                resolve(args);
            };
            aparams.error = function(args) {
                reject(args);
            };
            aparams.contentType = params.contentType;
            aparams.headers = params.headers;

            DayPilot.ajax(aparams);
        });
    };

    DayPilot.Http.put = function(url, data, params) {
        params = params || {};
        return new Promise(function(resolve, reject) {
            var aparams = {};
            aparams.url = url;
            aparams.method = "PUT";
            aparams.data = data;
            aparams.success = function(args) {
                resolve(args);
            };
            aparams.error = function(args) {
                reject(args);
            };
            aparams.contentType = params.contentType;
            aparams.headers = params.headers;

            DayPilot.ajax(aparams);
        });
    };

    DayPilot.Http.delete = function(url, params) {
        params = params || {};
        return new Promise(function(resolve, reject) {
            var aparams = {};
            aparams.url = url;
            aparams.method = "DELETE";
            aparams.success = function(args) {
                resolve(args);
            };
            aparams.error = function(args) {
                reject(args);
            };
            aparams.contentType = params.contentType;
            aparams.headers = params.headers;

            DayPilot.ajax(aparams);
        });
    };

    DayPilot.Util = {};
    DayPilot.Util.addClass = function(object, name) {
        if (!object) {
            return;
        }
        if (!object.className) {
            object.className = name;
            return;
        }
        var already = new RegExp("(^|\\s)" + name + "($|\\s)");
        if (!already.test(object.className)) {
            object.className = object.className + ' ' + name;
        }
    };

    DayPilot.Util.removeClass = function(object, name) {
        if (!object) {
            return;
        }
        var already = new RegExp("(^|\\s)" + name + "($|\\s)");
        object.className = object.className.replace(already, ' ').replace(/^\s\s*/, '').replace(/\s\s*$/, '');  // trim spaces
    };

    DayPilot.Util.copyProps = function(source, target, props) {
        if (!target) {
            target = {};
        }
        if (!source) {
            return target;
        }
        if (typeof props === 'undefined') {
            for (var name in source) {
                if (source.hasOwnProperty(name) && typeof source[name] !== 'undefined') {
                    target[name] = source[name];
                }
            }
        }
        else {
            for (var i = 0; i < props.length; i++) {
                var name = props[i];
                if (typeof source[name] !== 'undefined') {
                    target[name] = source[name];
                }
            }
        }
        return target;
    };

    DayPilot.Util.ownPropsAsArray = function(object) {
        var result = [];

        if (!object) {
            return result;
        }

        for (var name in object) {
            if (object.hasOwnProperty(name)) {
                var item = {};
                item.key = name;
                item.val = object[name];
                result.push(item);
            }
        }

        return result;
    };

    DayPilot.Util.replaceCharAt = function(str, index, character) {
        return str.substr(0, index) + character + str.substr(index + character.length);
    };

    DayPilot.Util.isNullOrUndefined = function(val) {
        return val === null || typeof val === "undefined";
    };

    DayPilot.Util.escapeHtml = function(html) {
        var div = document.createElement("div");
        div.innerText = html;
        return div.innerHTML;
    };

    DayPilot.Util.escapeTextHtml = function(text, html) {
        if (!DayPilot.Util.isNullOrUndefined(html)) {
            return html;
        }
        if (DayPilot.Util.isNullOrUndefined(text)) {
            return "";
        }
        return DayPilot.Util.escapeHtml(text);
    };

    /* areas */

    DayPilot.Areas = {};

    /**
     * Attach active areas to a target div.
     * Works with "Visible", "TouchVisible" and "Hover" visibility
     */
    DayPilot.Areas.attach = function (div, e, options) {
        var options = options || {};
        var areas = options.areas;
        var allowed = options.allowed || function() { return true; };
        var offsetX = options.offsetX || 0;

        // permanently visible active areas
        areas = areasExtract(e, areas);

        if (!areas) {
            return;
        }

        if (!DayPilot.isArray(areas)) {
            return;
        }

        if (areas.length === 0) {
            return;
        }

        DayPilot.re(div, "mousemove", function(ev) {
            if (!div.active && !div.areasDisabled && allowed()) {
                DayPilot.Areas.showAreas(div, e, ev, areas, { "offsetX": offsetX, "eventDiv": options.eventDiv});
            }
        });
        DayPilot.re(div, "mouseleave", function(ev) {
            DayPilot.Areas.hideAreas(div, ev);
        });

        areas.forEach(function(area) {
            if (!DayPilot.Areas.isVisible(area)) {
                return;
            }
            var a = DayPilot.Areas.createArea(div, e, area, { "offsetX": offsetX, "eventDiv": options.eventDiv});
            div.appendChild(a);
        });
    };

    DayPilot.Areas.disable = function(div) {
        div.areasDisabled = true;
        Array.from(div.childNodes).filter(function(item) { return item.isActiveArea && !item.area.start; }).forEach(function(item) {
            item._originalDisplay = item.style.display;
            item.style.display = "none";
        });
    };

    DayPilot.Areas.enable = function(div) {
        div.areasDisabled = false;
        Array.from(div.childNodes).filter(function(item) { return item.isActiveArea && !item.area.start; }).forEach(function(item) {
            if (item._originalDisplay) {
                item.style.display = item._originalDisplay;
            }
            else {
                item.style.display = "";
            }
        });
    };

    DayPilot.Areas.remove = function(div) {
        var divs = Array.from(div.childNodes).filter(function(item) { return item.isActiveArea; });

        DayPilot.de(divs);
    };

    DayPilot.Areas.isVisible = function(area) {
        var v = area.visibility || area.v || "Visible";
        if (v === "Visible") {
            return true;
        }
        if (v === "TouchVisible") {
            if (!DayPilot.browser.hover) {
                return true;
            }
        }
        return false;
    };

    DayPilot.Areas.copy = function(areas) {
        if (!DayPilot.isArray(areas)) {
            return [];
        }

        return areas.map(function(area) {
            return DayPilot.Util.copyProps(area, {});
        });
    };

    /**
     * Extracts areas array from the source object, giving priority to a standalone areas object.
     * @param e
     * @param areas
     */
    var areasExtract = function(e, areas) {
        if (!DayPilot.isArray(areas)) {
            areas = e.areas;
            if (!areas) {
                if (e.cache) {
                    areas = e.cache.areas;
                }
                else if (e.data) {
                    areas = e.data.areas;
                }
            }
        }
        return areas;
    };


    DayPilot.Areas.showAreas = function(div, e, ev, areas, options) {
        if (DayPilot.Global.resizing) {
            return;
        }

        if (DayPilot.Global.moving) {
            return;
        }

        if (DayPilot.Global.selecting) {
            return;
        }

        if (div.active) {
            return;
        }

        if (!DayPilot.browser.hover) {
            return;
        }

        if (DayPilot.Areas.all && DayPilot.Areas.all.length > 0) {
            for (var i = 0; i < DayPilot.Areas.all.length; i++) {
                var d = DayPilot.Areas.all[i];
                if (d !== div) {
                    DayPilot.Areas.hideAreas(d, ev);
                }
            }
        }

        div.active = {};

        //var areas;
        if (!DayPilot.isArray(areas)) {
            areas = e.areas;
            if (!areas) {
                if (e.cache) {
                    areas = e.cache.areas;
                }
                else if (e.data) {
                    areas = e.data.areas;
                }
            }
        }

        if (!areas || areas.length === 0) {
            return;
        }

        if (div.areas && div.areas.length > 0) {
            return;
        }
        div.areas = [];

        for (var i = 0; i < areas.length; i++) {
            var area = areas[i];

            if (DayPilot.Areas.isVisible(area)) {
                continue;
            }

            var a = DayPilot.Areas.createArea(div, e, area, options);

            div.areas.push(a);
            div.appendChild(a);

            DayPilot.Areas.all.push(div);
        }
        div.active.children = DayPilot.ac(div);
    };

    /**
     *
     * @param div Target div element
     * @param e Source data object
     * @param area Area definition
     * @returns {Element}
     */
    DayPilot.Areas.createArea = function(div, e, area, options) {

        /*
        actions:
        - Default (equals not specified)
        - None (cancels bubbling to parent element)
        - ContextMenu
        - HoverMenu
        - ResizeStart
        - ResizeEnd
        - Move
        - excluded: JavaScript, Bubble
         */

        var options = options || {};
        var offsetX = options.offsetX || 0;
        var ediv = options.eventDiv || div;

        var a = document.createElement("div");
        a.isActiveArea = true;
        a.area = area;
        a.setAttribute("unselectable", "on");
        var w = area.w || area.width;
        var h = area.h || area.height;
        var css = area.cssClass || area.css || area.className;
        if (typeof area.style !== "undefined") {
            a.setAttribute("style", area.style);
        }
        a.style.position = "absolute";

        a.style.width = resolvePosVal(w);
        a.style.height = resolvePosVal(h);
        a.style.right = resolvePosVal(area.right);
        a.style.top = resolvePosVal(area.top);
        a.style.left = resolvePosVal(area.left);
        a.style.bottom = resolvePosVal(area.bottom);

        if (typeof area.html !== 'undefined' || typeof area.text !== "undefined") {
            // a.innerHTML = area.html || area.text;
            a.innerHTML = DayPilot.Util.escapeTextHtml(area.text, area.html);
        }
        else if (area.icon) {
            var iel = document.createElement("i");
            iel.className = area.icon;
            a.appendChild(iel);
        }
        else if (area.image) {
            var img = document.createElement("img");
            img.src = area.image;
            a.appendChild(img);
        }
        else if (area.symbol) {
            var ns = "http://www.w3.org/2000/svg";
            var svg = document.createElementNS(ns,"svg");
            svg.setAttribute("width", "100%");
            svg.setAttribute("height", "100%");
            var use = document.createElementNS(ns,"use");
            use.setAttribute("href", area.symbol);
            svg.appendChild(use);
            a.appendChild(svg);
        }

        if (css) {
            a.className = css;
        }
        if (area.toolTip) {
            a.setAttribute("title", area.toolTip);
        }
        if (area.backColor) {
            a.style.background = area.backColor;
        }
        if (area.background) {  // alias
            a.style.background = area.background;
        }
        if (area.fontColor) {
            a.style.color = area.fontColor;
        }
        if (area.padding) {
            a.style.padding = area.padding + "px";
            a.style.boxSizing = "border-box";
        }
        if (area.verticalAlignment) {
            a.style.display = "flex";
            switch (area.verticalAlignment) {
                case "center":
                    a.style.alignItems = "center";
                    break;
                case "top":
                    a.style.alignItems = "flex-start";
                    break;
                case "bottom":
                    a.style.alignItems = "flex-end";
                    break;
            }
        }
        if (area.horizontalAlignment) {
            a.style.display = "flex";
            switch (area.horizontalAlignment) {
                case "right":
                    a.style.justifyContent = "flex-end";
                    break;
                case "left":
                    a.style.justifyContent = "flex-start";
                    break;
                case "center":
                    a.style.justifyContent = "center";
                    break;
            }
        }

        if (area.action === "ResizeEnd" || area.action === "ResizeStart" || area.action === "Move") {
            if (e.calendar.isCalendar) {
                switch (area.action) {
                    case "ResizeEnd":
                        area.cursor = "s-resize";
                        area.dpBorder = "bottom";
                        break;
                    case "ResizeStart":
                        area.cursor = "n-resize";
                        area.dpBorder = "top";
                        break;
                    case "Move":
                        area.cursor = "move";
                        break;
                }
            }
            if (e.calendar.isScheduler || e.calendar.isMonth) {
                switch (area.action) {
                    case "ResizeEnd":
                        area.cursor = "e-resize";
                        area.dpBorder = "right";
                        break;
                    case "ResizeStart":
                        area.cursor = "w-resize";
                        area.dpBorder = "left";
                        break;
                    case "Move":
                        area.cursor = "move";
                        break;
                }
            }
            a.onmousemove = (function(div, e, area) {
                return function(ev) {

                    if (e.calendar.internal && e.calendar.internal.dragInProgress && e.calendar.internal.dragInProgress()) {  // resizing in progress
                        return;
                    }
                    ev.cancelBubble = true;

                    div.style.cursor = area.cursor;
                    if (area.dpBorder) {
                        div.dpBorder = area.dpBorder;
                    }
                };
            })(ediv, e, area);
            a.onmouseout = (function(div, e, area) {
                return function(ev) {
                    div.style.cursor = '';
                };
            })(ediv, e, area);
        }
        if ((area.action === "ResizeEnd" || area.action === "ResizeStart") && e.isEvent) {
            if (e.calendar.internal.touch) {
                var touchstart = (function(div, e, area) {
                    return function(ev) {
                        ev.cancelBubble = true;
                        var touch = e.calendar.internal.touch;
                        var t = ev.touches ? ev.touches[0] : ev;
                        var coords = {x: t.pageX, y: t.pageY };
                        // immediately
                        e.calendar.coords = touch.relativeCoords(ev);
                        touch.preventEventTap = true;
                        if (e.calendar.isScheduler) {
                            touch.startResizing(div, area.action === "ResizeEnd" ? "right" : "left");
                        }
                        else if (e.calendar.isCalendar) {
                            touch.startResizing(div, area.action === "ResizeEnd" ? "bottom" : "top", coords);
                        }

                    };
                })(ediv, e, area);
                DayPilot.rePassive(a, DayPilot.touch.start, touchstart);
                // a.addEventListener(DayPilot.touch.start, touchstart, {"passive": true});
            }
        }
        if (area.action === "ContextMenu" && e.isEvent) {
            if (e.calendar.internal.touch) {
                var touchstart = (function(div, e, area) {
                    return function(ev) {
                        ev.cancelBubble = true;
                        ev.preventDefault();

                        showContextMenu(div, e, area, ev);
                        var touch = e.calendar.internal.touch;
                        touch.preventEventTap = true;
                    };
                })(ediv, e, area);
                var touchend = (function(div, e, area) {
                    return function(ev) {
                        ev.cancelBubble = true;
                        ev.preventDefault();
                    };
                })(ediv, e, area);
                DayPilot.reNonPassive(a, DayPilot.touch.start, touchstart);
                DayPilot.reNonPassive(a, DayPilot.touch.end, touchend);
            }
        }
        if (area.action === "Bubble" && e.isEvent) {
            if (e.calendar.internal.touch) {
                var touchstart = (function(div, e, area) {
                    return function(ev) {
                        ev.cancelBubble = true;
                        ev.preventDefault();

                        var args = doOnClick(area, e, ev);
                        if (args.preventDefault.value) {
                            return;
                        }
                        showBubble(e, area, ev);
                        var touch = e.calendar.internal.touch;
                        touch.preventEventTap = true;

                        if (typeof area.onClicked === "function") {
                            area.onClicked(args);
                        }
                    };
                })(ediv, e, area);
                var touchend = (function(div, e, area) {
                    return function(ev) {
                        ev.cancelBubble = true;
                        ev.preventDefault();
                    };
                })(ediv, e, area);
                DayPilot.reNonPassive(a, DayPilot.touch.start, touchstart);
                DayPilot.reNonPassive(a, DayPilot.touch.end, touchend);
            }
        }
        if (area.action === "Move" && e.isEvent) {
            if (e.calendar.internal.touch) {
                var touchstart = (function(div, e, area) {
                    return function(ev) {
                        ev.cancelBubble = true;
                        var touch = e.calendar.internal.touch;
                        var t = ev.touches ? ev.touches[0] : ev;
                        var coords = {x: t.pageX, y: t.pageY };
                        // immediately
                        e.calendar.coords = touch.relativeCoords(ev);

                        // DayPilot.Global.movingAreaData = area.data;
                        if (DayPilot.Global && DayPilot.Global.touch) {
                            DayPilot.Global.touch.active = true;
                        }

                        touch.preventEventTap = true;
                        touch.startMoving(div, coords);
                    };
                })(ediv, e, area);
                DayPilot.rePassive(a, DayPilot.touch.start, touchstart);
                // a.addEventListener(DayPilot.touch.start, touchstart, {"passive": true});
            }
        }
        if (area.action === "Bubble" && e.isEvent) {
            a.onmousemove = (function(div, e, area) {
                return function(ev) {
                    if (area.bubble) {
                        area.bubble.showEvent(e, true);
                    }
                    else if (e.calendar.bubble) {
                        e.calendar.bubble.showEvent(e, true);
                    }
                };
            })(div, e, area);
            a.onmouseout = (function(div, e, area) {
                return function(ev) {
                    if (typeof DayPilot.Bubble !== "undefined") {
                        //DayPilot.Bubble.hideActive();
                        if (area.bubble) {
                            area.bubble.hideOnMouseOut();
                        }
                        else if (e.calendar.bubble) {
                            e.calendar.bubble.hideOnMouseOut();
                        }
                    }

                };
            })(div, e, area);
        }
        else if (area.action === "Bubble" && e.isRow) {
            a.onmousemove = (function(div, e, area) {
                return function(ev) {
                    if (area.bubble) {
                        area.bubble.showResource(e, true);
                    }
                    else if (e.calendar.resourceBubble) {
                        e.calendar.resourceBubble.showResource(e, true);
                    }
                };
            })(div, e, area);
            a.onmouseout = (function(div, e, area) {
                return function(ev) {
                    if (typeof DayPilot.Bubble !== "undefined") {
                        //DayPilot.Bubble.hideActive();
                        if (area.bubble) {
                            area.bubble.hideOnMouseOut();
                        }
                        else if (e.calendar.resourceBubble) {
                            e.calendar.resourceBubble.hideOnMouseOut();
                        }
                    }

                };
            })(div, e, area);
        }
        else if (area.action === "Bubble" && typeof DayPilot.Bubble !== "undefined" && area.bubble instanceof DayPilot.Bubble) {
            a.onmousemove = (function(div, e, area) {
                return function(ev) {
                    area.bubble.showHtml(null, null);
                };
            })(div, e, area);
            a.onmouseout = (function(div, e, area) {
                return function(ev) {
                    if (typeof DayPilot.Bubble !== "undefined") {
                        if (area.bubble) {
                            area.bubble.hideOnMouseOut();
                        }
                    }

                };
            })(div, e, area);
        }
        if (area.action === "HoverMenu") {
            a.onmousemove = (function(div, e, area) {
                return function(ev) {
                    var m = area.menu;
                    if (m && m.show) {
                        if (!m.visible) {
                            m.show(e);
                        }
                        else if (m.source && typeof m.source.id !== 'undefined' && m.source.id !== e.id) {
                            m.show(e);
                        }
                        m.cancelHideTimeout();
                    }
                };
            })(div, e, area);
            a.onmouseout = (function(div, e, area) {
                return function(ev) {
                    var m = area.menu;
                    if (!m) {
                        return;
                    }
                    if (m.hideOnMouseOver) {
                        m.delayedHide();
                    }
                };
            })(div, e, area);
        }
        if (area.action === "None") {
            var touchstart = (function(div, e, area) {
                return function(ev) {
                    var args = doOnClick(area, e, ev);

                    if (typeof area.onClicked === "function") {
                        area.onClicked(args);
                    }

                    ev.preventDefault();
                    ev.stopPropagation();
                };
            })(ediv, e, area);
            DayPilot.reNonPassive(a, DayPilot.touch.start, touchstart);
        }

        // prevent event moving
        a.onmousedown = (function(div, e, area) {
            return function(ev) {
                if (typeof area.onmousedown === 'function') { // obsolete, remove
                    area.onmousedown(ev);
                }

                if (typeof area.mousedown === 'function') { // internal
                    var args = {};
                    args.area = area;
                    args.div = div;
                    args.originalEvent = ev;
                    args.source = e;
                    area.mousedown(args);
                }

                if (area.action === "Move" && e.isRow) {
                    var row = e.$.row;
                    var startMoving = e.calendar.internal.rowStartMoving;

                    startMoving(row);
                }

                // cancel any bubble
                if (typeof DayPilot.Bubble !== "undefined") {
                    DayPilot.Bubble.hideActive();
                }

                if (area.action === "Move") {
                    DayPilot.Global.movingAreaData = area.data;
                }

                if (area.action === "Move" && e.isEvent) {
                    if (e.calendar.internal && e.calendar.internal.startMoving) {
                        e.calendar.internal.startMoving(div, ev);
                    }
                }

                var cancel = true;

                if (cancel) {
                    if (area.action === "Move" || area.action === "ResizeEnd" || area.action === "ResizeStart" || !area.action || area.action === "Default") {
                        return;
                    }
                    ev.preventDefault(); // prevents text selection on dragging
                    ev.cancelBubble = true;
                }
            };
        })(div, e, area);
        a.onclick = (function(div, e, area) {
            return function(ev) {
                var args = doOnClick(area, e, ev);

                if (args.preventDefault.value) {
                    return;
                }

                switch (area.action) {
                    case "ContextMenu":
                        showContextMenu(div, e, area, ev);
                        ev.cancelBubble = true;
                        break;
                    case "None":
                        ev.cancelBubble = true;
                        break;
                }

                if (typeof area.onClicked === "function") {
                    area.onClicked(args);
                }
            };
        })(div, e, area);

        if (typeof area.onMouseEnter === "function") {
            a.addEventListener("mouseenter", (function(div, e, area) {
                return function(ev) {
                    var args = {};
                    args.area = area;
                    args.source = e;
                    args.originalEvent = ev;
                    area.onMouseEnter(args);
                };
            })(div, e, area));
        }
        if (typeof area.onMouseLeave === "function") {
            a.addEventListener("mouseleave", (function(div, e, area) {
                return function(ev) {
                    var args = {};
                    args.area = area;
                    args.source = e;
                    args.originalEvent = ev;
                    area.onMouseLeave(args);
                };
            })(div, e, area));
        }

        function doOnClick(area, source, originalEvent) {
            var args = {};
            args.area = area;
            args.source = source;
            args.originalEvent = originalEvent;
            args.preventDefault = function() {
                args.preventDefault.value = true;
            };

            if (typeof area.onClick === "function") {
                area.onClick(args);
            }
            return args;
        }

        function showBubble(e, area, ev) {
            if (DayPilot.Bubble) {
                DayPilot.Bubble.touchPosition(ev);
            }

            if (e.calendar.bubble) {
                e.calendar.bubble.showEvent(e, true);
            }
        }

        function showContextMenu(div, e, area, ev) {
            if (DayPilot.Menu) {
                DayPilot.Menu.touchPosition(ev);
            }

            var m = area.contextMenu || area.menu;
            if (!(m instanceof DayPilot.Menu)) {
                if (e.isEvent && e.client.contextMenu()) {
                    m = e.client.contextMenu();
                }
                else if (e.isEvent && e.calendar.contextMenu) {
                    m = e.calendar.contextMenu;
                }
            }
            if (m && m.show) {
                var initiator = { "type": "area", "div": div, "e": e, "area": area, "a": a};
                m.show(e, { "initiator": initiator});
            }
        }

        function resolvePosVal(val) {
            if (typeof val === "string" && isNaN(val)) {
                return val;
            }
            else if (typeof val !== "undefined") {
                return val + "px";
            }
            return undefined;
        }

        return a;
    };

    DayPilot.Areas.all = [];

    DayPilot.Areas.hideAreas = function(div, ev) {
        if (!div) {
            return;
        }

        if (!div || !div.active) {
            return;
        }

        var active = div.active;
        var areas = div.areas;

        if (active && active.children) {
            if (ev) {
                var target = ev.toElement || ev.relatedTarget;
                if (~DayPilot.indexOf(active.children, target)) {
                    return;
                }
            }
        }

        if (!areas || areas.length === 0) {
            div.active = null;
            return;
        }

        DayPilot.de(areas);

        div.active = null;
        div.areas = [];

        DayPilot.rfa(DayPilot.Areas.all, div);

        active.children = null;
    };

    DayPilot.Areas.hideAll = function(ev) {
        if (!DayPilot.Areas.all || DayPilot.Areas.all.length === 0) {
            return;
        }
        for (var i = 0; i < DayPilot.Areas.all.length; i++) {
            DayPilot.Areas.hideAreas(DayPilot.Areas.all[i], ev);
        }

    };

    /* end of areas */

    DayPilot.Exception = function(msg) {
        return new Error(msg);
    };

    DayPilot.Locale = function(id, config) {
        this.id = id;
        this.dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        this.dayNamesShort = ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"];
        this.monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        this.datePattern = "M/d/yyyy";
        this.timePattern = "H:mm";
        this.dateTimePattern = "M/d/yyyy H:mm";
        this.timeFormat = "Clock12Hours";
        this.weekStarts = 0;

        if (config) {
            for (var name in config) {
                this[name] = config[name];
            }
        }
    };

    DayPilot.Locale.all = {};

    DayPilot.Locale.find = function(id) {
        if (!id) {
            return null;
        }
        var normalized = id.toLowerCase();
        if (normalized.length > 2) {
            normalized = DayPilot.Util.replaceCharAt(normalized, 2, '-');
        }
        return DayPilot.Locale.all[normalized];
    };

    DayPilot.Locale.register = function(locale) {
        DayPilot.Locale.all[locale.id] = locale;
    };

    DayPilot.Locale.register(new DayPilot.Locale('ca-es', {'dayNames':['diumenge','dilluns','dimarts','dimecres','dijous','divendres','dissabte'],'dayNamesShort':['dg','dl','dt','dc','dj','dv','ds'],'monthNames':['gener','febrer','març','abril','maig','juny','juliol','agost','setembre','octubre','novembre','desembre',''],'monthNamesShort':['gen.','febr.','març','abr.','maig','juny','jul.','ag.','set.','oct.','nov.','des.',''],'timePattern':'H:mm','datePattern':'dd/MM/yyyy','dateTimePattern':'dd/MM/yyyy H:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('cs-cz', {'dayNames':['neděle','pondělí','úterý','středa','čtvrtek','pátek','sobota'],'dayNamesShort':['ne','po','út','st','čt','pá','so'],'monthNames':['leden','únor','březen','duben','květen','červen','červenec','srpen','září','říjen','listopad','prosinec',''],'monthNamesShort':['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII',''],'timePattern':'H:mm','datePattern':'d. M. yyyy','dateTimePattern':'d. M. yyyy H:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('da-dk', {'dayNames':['søndag','mandag','tirsdag','onsdag','torsdag','fredag','lørdag'],'dayNamesShort':['sø','ma','ti','on','to','fr','lø'],'monthNames':['januar','februar','marts','april','maj','juni','juli','august','september','oktober','november','december',''],'monthNamesShort':['jan','feb','mar','apr','maj','jun','jul','aug','sep','okt','nov','dec',''],'timePattern':'HH:mm','datePattern':'dd-MM-yyyy','dateTimePattern':'dd-MM-yyyy HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('de-at', {'dayNames':['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],'dayNamesShort':['So','Mo','Di','Mi','Do','Fr','Sa'],'monthNames':['Jänner','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember',''],'monthNamesShort':['Jän','Feb','Mär','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Dez',''],'timePattern':'HH:mm','datePattern':'dd.MM.yyyy','dateTimePattern':'dd.MM.yyyy HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('de-ch', {'dayNames':['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],'dayNamesShort':['So','Mo','Di','Mi','Do','Fr','Sa'],'monthNames':['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember',''],'monthNamesShort':['Jan','Feb','Mrz','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Dez',''],'timePattern':'HH:mm','datePattern':'dd.MM.yyyy','dateTimePattern':'dd.MM.yyyy HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('de-de', {'dayNames':['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],'dayNamesShort':['So','Mo','Di','Mi','Do','Fr','Sa'],'monthNames':['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember',''],'monthNamesShort':['Jan','Feb','Mrz','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Dez',''],'timePattern':'HH:mm','datePattern':'dd.MM.yyyy','dateTimePattern':'dd.MM.yyyy HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('de-lu', {'dayNames':['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],'dayNamesShort':['So','Mo','Di','Mi','Do','Fr','Sa'],'monthNames':['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember',''],'monthNamesShort':['Jan','Feb','Mrz','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Dez',''],'timePattern':'HH:mm','datePattern':'dd.MM.yyyy','dateTimePattern':'dd.MM.yyyy HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('en-au', {'dayNames':['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],'dayNamesShort':['Su','Mo','Tu','We','Th','Fr','Sa'],'monthNames':['January','February','March','April','May','June','July','August','September','October','November','December',''],'monthNamesShort':['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec',''],'timePattern':'h:mm tt','datePattern':'d/MM/yyyy','dateTimePattern':'d/MM/yyyy h:mm tt','timeFormat':'Clock12Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('en-ca', {'dayNames':['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],'dayNamesShort':['Su','Mo','Tu','We','Th','Fr','Sa'],'monthNames':['January','February','March','April','May','June','July','August','September','October','November','December',''],'monthNamesShort':['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec',''],'timePattern':'h:mm tt','datePattern':'yyyy-MM-dd','dateTimePattern':'yyyy-MM-dd h:mm tt','timeFormat':'Clock12Hours','weekStarts':0}));
    DayPilot.Locale.register(new DayPilot.Locale('en-gb', {'dayNames':['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],'dayNamesShort':['Su','Mo','Tu','We','Th','Fr','Sa'],'monthNames':['January','February','March','April','May','June','July','August','September','October','November','December',''],'monthNamesShort':['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec',''],'timePattern':'HH:mm','datePattern':'dd/MM/yyyy','dateTimePattern':'dd/MM/yyyy HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('en-us', {'dayNames':['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],'dayNamesShort':['Su','Mo','Tu','We','Th','Fr','Sa'],'monthNames':['January','February','March','April','May','June','July','August','September','October','November','December',''],'monthNamesShort':['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec',''],'timePattern':'h:mm tt','datePattern':'M/d/yyyy','dateTimePattern':'M/d/yyyy h:mm tt','timeFormat':'Clock12Hours','weekStarts':0}));
    DayPilot.Locale.register(new DayPilot.Locale('es-es', {'dayNames':['domingo','lunes','martes','miércoles','jueves','viernes','sábado'],'dayNamesShort':['D','L','M','X','J','V','S'],'monthNames':['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre',''],'monthNamesShort':['ene.','feb.','mar.','abr.','may.','jun.','jul.','ago.','sep.','oct.','nov.','dic.',''],'timePattern':'H:mm','datePattern':'dd/MM/yyyy','dateTimePattern':'dd/MM/yyyy H:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('es-mx', {'dayNames':['domingo','lunes','martes','miércoles','jueves','viernes','sábado'],'dayNamesShort':['do.','lu.','ma.','mi.','ju.','vi.','sá.'],'monthNames':['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre',''],'monthNamesShort':['ene.','feb.','mar.','abr.','may.','jun.','jul.','ago.','sep.','oct.','nov.','dic.',''],'timePattern':'hh:mm tt','datePattern':'dd/MM/yyyy','dateTimePattern':'dd/MM/yyyy hh:mm tt','timeFormat':'Clock12Hours','weekStarts':0}));
    DayPilot.Locale.register(new DayPilot.Locale('eu-es', {'dayNames':['igandea','astelehena','asteartea','asteazkena','osteguna','ostirala','larunbata'],'dayNamesShort':['ig','al','as','az','og','or','lr'],'monthNames':['urtarrila','otsaila','martxoa','apirila','maiatza','ekaina','uztaila','abuztua','iraila','urria','azaroa','abendua',''],'monthNamesShort':['urt.','ots.','mar.','api.','mai.','eka.','uzt.','abu.','ira.','urr.','aza.','abe.',''],'timePattern':'H:mm','datePattern':'yyyy/MM/dd','dateTimePattern':'yyyy/MM/dd H:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('fi-fi', {'dayNames':['sunnuntai','maanantai','tiistai','keskiviikko','torstai','perjantai','lauantai'],'dayNamesShort':['su','ma','ti','ke','to','pe','la'],'monthNames':['tammikuu','helmikuu','maaliskuu','huhtikuu','toukokuu','kesäkuu','heinäkuu','elokuu','syyskuu','lokakuu','marraskuu','joulukuu',''],'monthNamesShort':['tammi','helmi','maalis','huhti','touko','kesä','heinä','elo','syys','loka','marras','joulu',''],'timePattern':'H:mm','datePattern':'d.M.yyyy','dateTimePattern':'d.M.yyyy H:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('fr-be', {'dayNames':['dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi'],'dayNamesShort':['di','lu','ma','me','je','ve','sa'],'monthNames':['janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre',''],'monthNamesShort':['janv.','févr.','mars','avr.','mai','juin','juil.','août','sept.','oct.','nov.','déc.',''],'timePattern':'HH:mm','datePattern':'dd-MM-yy','dateTimePattern':'dd-MM-yy HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('fr-ch', {'dayNames':['dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi'],'dayNamesShort':['di','lu','ma','me','je','ve','sa'],'monthNames':['janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre',''],'monthNamesShort':['janv.','févr.','mars','avr.','mai','juin','juil.','août','sept.','oct.','nov.','déc.',''],'timePattern':'HH:mm','datePattern':'dd.MM.yyyy','dateTimePattern':'dd.MM.yyyy HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('fr-fr', {'dayNames':['dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi'],'dayNamesShort':['di','lu','ma','me','je','ve','sa'],'monthNames':['janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre',''],'monthNamesShort':['janv.','févr.','mars','avr.','mai','juin','juil.','août','sept.','oct.','nov.','déc.',''],'timePattern':'HH:mm','datePattern':'dd/MM/yyyy','dateTimePattern':'dd/MM/yyyy HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('fr-lu', {'dayNames':['dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi'],'dayNamesShort':['di','lu','ma','me','je','ve','sa'],'monthNames':['janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre',''],'monthNamesShort':['janv.','févr.','mars','avr.','mai','juin','juil.','août','sept.','oct.','nov.','déc.',''],'timePattern':'HH:mm','datePattern':'dd/MM/yyyy','dateTimePattern':'dd/MM/yyyy HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('gl-es', {'dayNames':['domingo','luns','martes','mércores','xoves','venres','sábado'],'dayNamesShort':['do','lu','ma','mé','xo','ve','sá'],'monthNames':['xaneiro','febreiro','marzo','abril','maio','xuño','xullo','agosto','setembro','outubro','novembro','decembro',''],'monthNamesShort':['xan','feb','mar','abr','maio','xuño','xul','ago','set','out','nov','dec',''],'timePattern':'H:mm','datePattern':'dd/MM/yyyy','dateTimePattern':'dd/MM/yyyy H:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('it-it', {'dayNames':['domenica','lunedì','martedì','mercoledì','giovedì','venerdì','sabato'],'dayNamesShort':['do','lu','ma','me','gi','ve','sa'],'monthNames':['gennaio','febbraio','marzo','aprile','maggio','giugno','luglio','agosto','settembre','ottobre','novembre','dicembre',''],'monthNamesShort':['gen','feb','mar','apr','mag','giu','lug','ago','set','ott','nov','dic',''],'timePattern':'HH:mm','datePattern':'dd/MM/yyyy','dateTimePattern':'dd/MM/yyyy HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('it-ch', {'dayNames':['domenica','lunedì','martedì','mercoledì','giovedì','venerdì','sabato'],'dayNamesShort':['do','lu','ma','me','gi','ve','sa'],'monthNames':['gennaio','febbraio','marzo','aprile','maggio','giugno','luglio','agosto','settembre','ottobre','novembre','dicembre',''],'monthNamesShort':['gen','feb','mar','apr','mag','giu','lug','ago','set','ott','nov','dic',''],'timePattern':'HH:mm','datePattern':'dd.MM.yyyy','dateTimePattern':'dd.MM.yyyy HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('ja-jp', {'dayNames':['日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日'],'dayNamesShort':['日','月','火','水','木','金','土'],'monthNames':['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月',''],'monthNamesShort':['1','2','3','4','5','6','7','8','9','10','11','12',''],'timePattern':'H:mm','datePattern':'yyyy/MM/dd','dateTimePattern':'yyyy/MM/dd H:mm','timeFormat':'Clock24Hours','weekStarts':0}));
    DayPilot.Locale.register(new DayPilot.Locale('nb-no', {'dayNames':['søndag','mandag','tirsdag','onsdag','torsdag','fredag','lørdag'],'dayNamesShort':['sø','ma','ti','on','to','fr','lø'],'monthNames':['januar','februar','mars','april','mai','juni','juli','august','september','oktober','november','desember',''],'monthNamesShort':['jan','feb','mar','apr','mai','jun','jul','aug','sep','okt','nov','des',''],'timePattern':'HH:mm','datePattern':'dd.MM.yyyy','dateTimePattern':'dd.MM.yyyy HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('nl-nl', {'dayNames':['zondag','maandag','dinsdag','woensdag','donderdag','vrijdag','zaterdag'],'dayNamesShort':['zo','ma','di','wo','do','vr','za'],'monthNames':['januari','februari','maart','april','mei','juni','juli','augustus','september','oktober','november','december',''],'monthNamesShort':['jan','feb','mrt','apr','mei','jun','jul','aug','sep','okt','nov','dec',''],'timePattern':'HH:mm','datePattern':'d-M-yyyy','dateTimePattern':'d-M-yyyy HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('nl-be', {'dayNames':['zondag','maandag','dinsdag','woensdag','donderdag','vrijdag','zaterdag'],'dayNamesShort':['zo','ma','di','wo','do','vr','za'],'monthNames':['januari','februari','maart','april','mei','juni','juli','augustus','september','oktober','november','december',''],'monthNamesShort':['jan','feb','mrt','apr','mei','jun','jul','aug','sep','okt','nov','dec',''],'timePattern':'H:mm','datePattern':'d/MM/yyyy','dateTimePattern':'d/MM/yyyy H:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('nn-no', {'dayNames':['søndag','måndag','tysdag','onsdag','torsdag','fredag','laurdag'],'dayNamesShort':['sø','må','ty','on','to','fr','la'],'monthNames':['januar','februar','mars','april','mai','juni','juli','august','september','oktober','november','desember',''],'monthNamesShort':['jan','feb','mar','apr','mai','jun','jul','aug','sep','okt','nov','des',''],'timePattern':'HH:mm','datePattern':'dd.MM.yyyy','dateTimePattern':'dd.MM.yyyy HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('pt-br', {'dayNames':['domingo','segunda-feira','terça-feira','quarta-feira','quinta-feira','sexta-feira','sábado'],'dayNamesShort':['D','S','T','Q','Q','S','S'],'monthNames':['janeiro','fevereiro','março','abril','maio','junho','julho','agosto','setembro','outubro','novembro','dezembro',''],'monthNamesShort':['jan','fev','mar','abr','mai','jun','jul','ago','set','out','nov','dez',''],'timePattern':'HH:mm','datePattern':'dd/MM/yyyy','dateTimePattern':'dd/MM/yyyy HH:mm','timeFormat':'Clock24Hours','weekStarts':0}));
    DayPilot.Locale.register(new DayPilot.Locale('pl-pl', {'dayNames':['niedziela','poniedziałek','wtorek','środa','czwartek','piątek','sobota'],'dayNamesShort':['N','Pn','Wt','Śr','Cz','Pt','So'],'monthNames':['styczeń','luty','marzec','kwiecień','maj','czerwiec','lipiec','sierpień','wrzesień','październik','listopad','grudzień',''],'monthNamesShort':['sty','lut','mar','kwi','maj','cze','lip','sie','wrz','paź','lis','gru',''],'timePattern':'HH:mm','datePattern':'yyyy-MM-dd','dateTimePattern':'yyyy-MM-dd HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('pt-pt', {'dayNames':['domingo','segunda-feira','terça-feira','quarta-feira','quinta-feira','sexta-feira','sábado'],'dayNamesShort':['D','S','T','Q','Q','S','S'],'monthNames':['janeiro','fevereiro','março','abril','maio','junho','julho','agosto','setembro','outubro','novembro','dezembro',''],'monthNamesShort':['jan','fev','mar','abr','mai','jun','jul','ago','set','out','nov','dez',''],'timePattern':'HH:mm','datePattern':'dd/MM/yyyy','dateTimePattern':'dd/MM/yyyy HH:mm','timeFormat':'Clock24Hours','weekStarts':0}));
    DayPilot.Locale.register(new DayPilot.Locale('ro-ro', {'dayNames':['duminică','luni','marți','miercuri','joi','vineri','sâmbătă'],'dayNamesShort':['D','L','Ma','Mi','J','V','S'],'monthNames':['ianuarie','februarie','martie','aprilie','mai','iunie','iulie','august','septembrie','octombrie','noiembrie','decembrie',''],'monthNamesShort':['ian.','feb.','mar.','apr.','mai.','iun.','iul.','aug.','sep.','oct.','nov.','dec.',''],'timePattern':'H:mm','datePattern':'dd.MM.yyyy','dateTimePattern':'dd.MM.yyyy H:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('ru-ru', {'dayNames':['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],'dayNamesShort':['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],'monthNames':['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь',''],'monthNamesShort':['янв','фев','мар','апр','май','июн','июл','авг','сен','окт','ноя','дек',''],'timePattern':'H:mm','datePattern':'dd.MM.yyyy','dateTimePattern':'dd.MM.yyyy H:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('sk-sk', {'dayNames':['nedeľa','pondelok','utorok','streda','štvrtok','piatok','sobota'],'dayNamesShort':['ne','po','ut','st','št','pi','so'],'monthNames':['január','február','marec','apríl','máj','jún','júl','august','september','október','november','december',''],'monthNamesShort':['1','2','3','4','5','6','7','8','9','10','11','12',''],'timePattern':'H:mm','datePattern':'d.M.yyyy','dateTimePattern':'d.M.yyyy H:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('sv-se', {'dayNames':['söndag','måndag','tisdag','onsdag','torsdag','fredag','lördag'],'dayNamesShort':['sö','må','ti','on','to','fr','lö'],'monthNames':['januari','februari','mars','april','maj','juni','juli','augusti','september','oktober','november','december',''],'monthNamesShort':['jan','feb','mar','apr','maj','jun','jul','aug','sep','okt','nov','dec',''],'timePattern':'HH:mm','datePattern':'yyyy-MM-dd','dateTimePattern':'yyyy-MM-dd HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('tr-tr', {'dayNames':['Pazar','Pazartesi','Salı','Çarşamba','Perşembe','Cuma','Cumartesi'],'dayNamesShort':['Pz','Pt','Sa','Ça','Pe','Cu','Ct'],'monthNames':['Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık',''],'monthNamesShort':['Oca','Şub','Mar','Nis','May','Haz','Tem','Ağu','Eyl','Eki','Kas','Ara',''],'timePattern':'HH:mm','datePattern':'d.M.yyyy','dateTimePattern':'d.M.yyyy HH:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('uk-ua', {'dayNames':['неділя','понеділок','вівторок','середа','четвер',"п'ятниця",'субота'],'dayNamesShort':['Нд','Пн','Вт','Ср','Чт','Пт','Сб'],'monthNames':['січень','лютий','березень','квітень','травень','червень','липень','серпень','вересень','жовтень','листопад','грудень',''],'monthNamesShort':['Січ','Лют','Бер','Кві','Тра','Чер','Лип','Сер','Вер','Жов','Лис','Гру',''],'timePattern':'H:mm','datePattern':'dd.MM.yyyy','dateTimePattern':'dd.MM.yyyy H:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('zh-cn', {'dayNames':['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],'dayNamesShort':['日','一','二','三','四','五','六'],'monthNames':['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月',''],'monthNamesShort':['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月',''],'timePattern':'H:mm','datePattern':'yyyy/M/d','dateTimePattern':'yyyy/M/d H:mm','timeFormat':'Clock24Hours','weekStarts':1}));
    DayPilot.Locale.register(new DayPilot.Locale('zh-tw', {'dayNames':['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],'dayNamesShort':['日','一','二','三','四','五','六'],'monthNames':['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月',''],'monthNamesShort':['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月',''],'timePattern':'tt hh:mm','datePattern':'yyyy/M/d','dateTimePattern':'yyyy/M/d tt hh:mm','timeFormat':'Clock12Hours','weekStarts':0}));

    DayPilot.Locale.US = DayPilot.Locale.find("en-us");

    /**
     * Created on 2023-04-04.
     */

    DayPilot.Switcher = function(options) {

        var This = this;

        this._views = [];
        this._triggers = [];
        this._navigator = {};

        this.selectedClass = null;

        this._active = null;

        this._day = DayPilot.Date.today();

        this.onChange = null;
        this.onChanged = null;
        this.onSelect = null;

        this._navigator.updateMode = function (mode) {
            var control = This._navigator.control;
            if (!control) {
                return;
            }
            control.selectMode = mode;
            control.select(This._day);
        };

        this.addView = function (spec, options) {
            var element;
            if (typeof spec === 'string') {
                element = document.getElementById(spec);
                if (!element) {
                    throw "Element not found: " + spec;
                }
            }
            else {  // DayPilot object, DOM element
                element = spec;
            }

            var control = element;

            var view = {};
            view._isView = true;
            view._id = control.id;
            view.control = control;
            view._options = options || {};
            view._hide = function () {
                if (control.hide) {
                    control.hide();
                }
                else if (control.nav && control.nav.top) {
                    control.nav.top.style.display = 'none';
                }
                else {
                    control.style.display = 'none';
                }
            };
            view._sendNavigate = function(date) {
                var serverBased = (function() {
                    if (control.backendUrl) {  // ASP.NET MVC, Java
                        return true;
                    }
                    if (typeof WebForm_DoCallback === 'function' && control.uniqueID) {  // ASP.NET WebForms
                        return true;
                    }
                    return false;
                })();
                if (serverBased) {
                    if (control.commandCallBack) {
                        control.commandCallBack("navigate", { "day": date });
                    }
                }
                else {
                    control.startDate = date;
                    control.update();
                }
            };
            view._show = function () {
                This._hideViews();
                if (control.show) {
                    control.show();
                }
                else if (control.nav && control.nav.top) {
                    control.nav.top.style.display = '';
                }
                else {
                    control.style.display = '';
                }
            };
            view._selectMode = function () { // for navigator
                if (view._options.navigatorSelectMode) {
                    return view._options.navigatorSelectMode;
                }

                if (control.isCalendar) {
                    switch (control.viewType) {
                        case "Day":
                            return "day";
                        case "Week":
                            return "week";
                        case "WorkWeek":
                            return "week";
                        default:
                            return "day";
                    }
                }
                else if (control.isMonth) {
                    switch (control.viewType) {
                        case "Month":
                            return "month";
                        case "Weeks":
                            return "week";
                        default:
                            return "day";
                    }
                }
                return "day";
            };

            this._views.push(view);

            return view;
        };

        this.addTrigger = function (id, control) {
            var element;
            if (typeof id === 'string') {
                element = document.getElementById(id);
                if (!element) {
                    throw "Element not found: " + id;
                }
            }
            else {
                element = id;
            }

            var view = this._findViewByControl(control);
            if (!view) {
                view = this.addView(control);
            }

            var trigger = {};
            trigger._isTrigger = true;
            trigger._element = element;
            trigger._id = element.id;
            trigger._view = view;
            trigger._onClick = function (ev) {

                This.show(trigger);
                This._select(trigger);

                if (ev) {
                    ev.preventDefault ? ev.preventDefault() : ev.returnValue = false;
                }

            };

            DayPilot.re(element, 'click', trigger._onClick);

            this._triggers.push(trigger);

            return trigger;
        };

        // backwards compatibility
        this.addButton = this.addTrigger;

        this.select = function(id) {
            var trigger = this._findTriggerById(id);
            if (trigger) {
                trigger._onClick();
            }
            else if (this._triggers.length > 0) {
                this._triggers[0]._onClick();
            }
        };

        this._findTriggerById = function(id) {
            for (var i = 0; i < this._triggers.length; i++) {
                var trigger = this._triggers[i];
                if (trigger._id === id) {
                    return trigger;
                }
            }
            return null;
        };

        this._select = function(trigger) {
            if (!this.selectedClass) {
                return;
            }

            for (var i = 0; i < this._triggers.length; i++) {
                var s = this._triggers[i];
                DayPilot.Util.removeClass(s._element, this.selectedClass);
            }
            DayPilot.Util.addClass(trigger._element, this.selectedClass);
        };

        this.addNavigator = function (control) {
            //this.navigator = {};
            This._navigator.control = control;

            control.timeRangeSelectedHandling = "JavaScript";
            control.onTimeRangeSelected = function() {
                var start, end, day;
                if (control.api === 1) {
                    start = arguments[0];
                    end = arguments[1];
                    day = arguments[2];
                }
                else {
                    var args = arguments[0];
                    start = args.start;
                    end = args.end;
                    day = args.day;
                }
                This._day = day;

                navigate(start, end, day);

            };
        };

        this.show = function (el) {
            var view, trigger;
            if (el._isTrigger) {
                trigger = el;
                view = trigger._view;
            }
            else {
                view = el._isView ? el : this._findViewByControl(el);
                if (this._active === view) {
                    return;
                }
            }

            if (This.onSelect) {
                var args = {};
                args.source = trigger ? trigger._element : null;
                args.target = view.control;

                This.onSelect(args);
                // TODO add preventDefault
            }

            this._active = view;
            view._show();

            var mode = view._selectMode();
            This._navigator.updateMode(mode);

            //This.navigator.select(This.day);

            //This.active.sendNavigate(this.day);

            // this ensures first onChange call if single day = today is displayed
            var start = This._navigator.control.selectionStart;
            var end = This._navigator.control.selectionEnd.addDays(1);
            var day = This._navigator.control.selectionDay;
            navigate(start, end, day);
        };

        this._findViewByControl = function (control) {
            for (var i = 0; i < this._views.length; i++) {
                if (this._views[i].control === control) {
                    return this._views[i];
                }
            }
            return null;
        };

        this._hideViews = function () {
            //var controls = [dp_day, dp_week, dp_month];
            for (var i = 0; i < this._views.length; i++) {
                this._views[i]._hide();
            }
        };

        Object.defineProperty(this, "active", {
            get: function() {
                return This._active;
            }
        });

        this.events = {};

        this.events.load = function(url, success, error) {
            if (This._active && This._active.control) {
                This._active.control.events.load(url, success, error);
            }
            else {
                throw "DayPilot.Switcher.events.load(): Active view not found";
            }
        };

        this._previousArgs = null;

        this._init = function() {
            if (!options) {
                return;
            }

            for (var name in options) {
                if (name === "triggers") {
                    var triggers = options.triggers || [];
                    triggers.forEach(function(item) {
                        This.addTrigger(item.id, item.view);
                    });
                }
                else if (name === "navigator") {
                    This.addNavigator(options.navigator);
                }
                else {
                    This[name] = options[name];
                }
            }

        };

        this._init();

        function navigate(start, end, day) {
            var args = {};
            args.start = start;
            args.end = end;
            args.day = day;
            args.target = This._active.control;
            args.preventDefault = function() {
                this.preventDefault.value = true;
            };

            var previous = This._previousArgs;
            if (previous) {
                if (previous.start === args.start && previous.end === args.end && previous.day === args.day && previous.target === args.target) {
                    return;  // duplicate, no change
                }
            }

            This._previousArgs = args;

            if (typeof This.onChange === "function") {
                This.onChange(args);
                if (args.preventDefault.value) {
                    return;
                }
            }

            // backwards compatibility
            if (typeof This.onTimeRangeSelect === "function") {
                This.onTimeRangeSelect(args);
                if (args.preventDefault.value) {
                    return;
                }
            }

            This._active._sendNavigate(This._day);

            if (typeof This.onChanged === "function") {
                This.onChanged(args);
            }

            if (typeof This.onTimeRangeSelected === "function") {
                This.onTimeRangeSelected(args);
            }

        }

    };

    // DayPilot.Date START

    DayPilot.Duration = function(ticks) {
        var d = this;

        var day = 1000*60*60*24.0;
        var hour = 1000*60*60.0;
        var minute = 1000*60.0;
        var second = 1000.0;

        if (arguments.length === 2) {
            var start = arguments[0];
            var end = arguments[1];

            if (!(start instanceof DayPilot.Date) && (typeof start !== "string")) {
                throw "DayPilot.Duration(): Invalid start argument, DayPilot.Date expected";
            }
            if (!(end instanceof DayPilot.Date) && (typeof end !== "string")) {
                throw "DayPilot.Duration(): Invalid end argument, DayPilot.Date expected";
            }
            if (typeof start === "string") {
                start = new DayPilot.Date(start);
            }
            if (typeof end === "string") {
                end = new DayPilot.Date(end);
            }
            ticks = end.getTime() - start.getTime();
        }

        this.ticks = ticks;

        // caching, allows direct comparison
        if (DayPilot.Date.Cache.DurationCtor["" + ticks]) {
            return DayPilot.Date.Cache.DurationCtor["" + ticks];
        }
        DayPilot.Date.Cache.DurationCtor["" + ticks] = this;

        this.toString = function(pattern) {
            if (!pattern) {
                return d.days() + "." + d.hours() + ":" + d.minutes() + ":" + d.seconds() + "." + d.milliseconds();
            }

            var minutes = d.minutes();
            minutes = (minutes < 10 ? "0" : "") + minutes;

            // dumb replacement
            var result = pattern;
            result = result.replace("mm", minutes);
            result = result.replace("m", d.minutes());
            result = result.replace("H", d.hours());
            result = result.replace("h", d.hours());
            result = result.replace("d", d.days());
            result = result.replace("s", d.seconds());
            return result;
        };

        this.totalHours = function() {
            return d.ticks / hour;
        };

        this.totalDays = function() {
            return d.ticks / day;
        };

        this.totalMinutes = function() {
            return d.ticks / minute;
        };

        this.totalSeconds = function() {
            return d.ticks / second;
        };

        this.days = function() {
            return Math.floor(d.totalDays());
        };

        this.hours = function() {
            var hourPartTicks = d.ticks - d.days()*day;
            return Math.floor(hourPartTicks/hour);
        };

        this.minutes = function() {
            var minutePartTicks = d.ticks - Math.floor(d.totalHours()) * hour;
            return Math.floor(minutePartTicks/minute);
        };

        this.seconds = function() {
            var secondPartTicks = d.ticks - Math.floor(d.totalMinutes()) * minute;
            return Math.floor(secondPartTicks/second);
        };

        this.milliseconds = function() {
            return d.ticks % second;
        };

    };

    DayPilot.Duration.weeks = function(i) {
        return new DayPilot.Duration(i * 1000*60*60*24*7);
    };

    DayPilot.Duration.days = function(i) {
        return new DayPilot.Duration(i * 1000*60*60*24);
    };

    DayPilot.Duration.hours = function(i) {
        return new DayPilot.Duration(i * 1000*60*60);
    };

    DayPilot.Duration.minutes = function(i) {
        return new DayPilot.Duration(i * 1000*60);
    };

    DayPilot.Duration.seconds = function(i) {
        return new DayPilot.Duration(i * 1000);
    };

    // alias to DayPilot.Duration
    // disabled, doesn't work with caching
    DayPilot.TimeSpan = function() {

        throw "Please use DayPilot.Duration class instead of DayPilot.TimeSpan.";
        // DayPilot.Duration.apply(this, arguments);
    };
    try {
        DayPilot.TimeSpan.prototype = Object.create(DayPilot.Duration.prototype);  // make instanceof work
    }
    catch (e) {}  // doesn't work in IE8

    // DayPilot.TimeSpan.prototype.constructor = DayPilot.TimeSpan;  // not necessary, it's an alias, not an inherited class

    /* Date utils */

    // DayPilot.Date class
    /* Constructor signatures:

     -- new DayPilot.Date(date, isLocal)
     date - JavaScript Date object
     isLocal - true if the local time should be taken from date, otherwise GMT base is used

     -- new DayPilot.Date() - returns now, using local date

     -- new DayPilot.Date(string)
     string - date in ISO 8601 format, e.g. 2009-01-01T00:00:00

     */
    DayPilot.Date = function(date, readLocal) {

        if (date instanceof DayPilot.Date) { // it's already a DayPilot.Date object, return it (no copy)
            return date;
        }

        var ticks;

        if (DayPilot.Util.isNullOrUndefined(date)) {  // date not set, use NOW
            ticks = DayPilot.DateUtil.fromLocal().getTime();
            date = ticks;
        }

        var cache = DayPilot.Date.Cache.Ctor;
        if (cache[date]) {
            DayPilot.Stats.cacheHitsCtor += 1;
            return cache[date];
        }

        var isString = false;

        if (typeof date === "string") {
            ticks = DayPilot.DateUtil.fromStringSortable(date, readLocal).getTime();
            isString = true;
        }
        else if (typeof date === "number") {
            if (isNaN(date)) {
                throw "Cannot create DayPilot.Date from NaN";
            }
            ticks = date;
        }
        else if (date instanceof Date) {
            if (readLocal) {
                ticks = DayPilot.DateUtil.fromLocal(date).getTime();
            }
            else {
                ticks = date.getTime();
            }
        }
        else {
            throw "Unrecognized parameter: use Date, number or string in ISO 8601 format";
        }

        var value = ticksToSortable(ticks); // normalized value

        if (cache[value]) {
            return cache[value];
        }

        cache[value] = this;
        cache[ticks] = this;
        if (isString && value !== date  && DayPilot.DateUtil.hasTzSpec(date)) {  // don't cache strings with TZ spec
            cache[date] = this;
        }

        if (Object.defineProperty) {
            Object.defineProperty(this, "ticks", {
                get: function() { return ticks; }
            });
            Object.defineProperty(this, "value", {
                "value": value,
                "writable": false,
                "enumerable": true
            });
        }
        else {
            this.ticks = ticks;
            this.value = value;
        }

        if (DayPilot.Date.Config.legacyShowD) {
            this.d = new Date(ticks);
        }

        DayPilot.Stats.dateObjects += 1;
    };

    DayPilot.Date.Config = {};
    DayPilot.Date.Config.legacyShowD = false;

    DayPilot.Date.Cache = {};
    DayPilot.Date.Cache.Parsing = {};
    DayPilot.Date.Cache.Ctor = {};
    DayPilot.Date.Cache.Ticks = {};
    DayPilot.Date.Cache.DurationCtor = {};

    DayPilot.Date.Cache.clear = function() {
        DayPilot.Date.Cache.Parsing = {};
        DayPilot.Date.Cache.Ctor = {};
        DayPilot.Date.Cache.Ticks = {};
        DayPilot.Date.Cache.DurationCtor = {};
    };


    DayPilot.Date.prototype.addDays = function(days) {
        if (!days) {
            return this;
        }
        return new DayPilot.Date(this.ticks + days * 24 * 60 * 60 * 1000);
    };

    DayPilot.Date.prototype.addHours = function(hours) {
        if (!hours) {
            return this;
        }
        return this.addTime(hours * 60 * 60 * 1000);
    };

    DayPilot.Date.prototype.addMilliseconds = function(millis) {
        if (!millis) {
            return this;
        }
        return this.addTime(millis);
    };

    DayPilot.Date.prototype.addMinutes = function(minutes) {
        if (!minutes) {
            return this;
        }
        return this.addTime(minutes * 60 * 1000);
    };

    DayPilot.Date.prototype.addMonths = function(months) {
        if (!months) {
            return this;
        }

        var date = new Date(this.ticks);

        var y = date.getUTCFullYear();
        var m = date.getUTCMonth() + 1;

        if (months > 0) {
            while (months >= 12) {
                months -= 12;
                y++;
            }
            if (months > 12 - m) {
                y++;
                m = months - (12 - m);
            }
            else {
                m += months;
            }
        }
        else {
            while (months <= -12) {
                months += 12;
                y--;
            }
            if (m + months <= 0) {  //
                y--;
                m = 12 + m + months;
            }
            else {
                m = m + months;
            }
        }

        var d = new Date(date.getTime());
        d.setUTCDate(1);
        d.setUTCFullYear(y);
        d.setUTCMonth(m - 1);

        //var max = DayPilot.Date.daysInMonth(y, m);
        var max = new DayPilot.Date(d).daysInMonth();
        d.setUTCDate(Math.min(max, date.getUTCDate()));

        return new DayPilot.Date(d);
    };

    DayPilot.Date.prototype.addSeconds = function(seconds) {
        if (!seconds) {
            return this;
        }
        return this.addTime(seconds * 1000);
    };

    DayPilot.Date.prototype.addTime = function(ticks) {
        if (!ticks) {
            return this;
        }
        if (ticks instanceof DayPilot.Duration) {
            ticks = ticks.ticks;
        }
        return new DayPilot.Date(this.ticks + ticks);
    };

    DayPilot.Date.prototype.addYears = function(years) {
        var original = new Date(this.ticks);
        var d = new Date(this.ticks);
        var y = this.getYear() + years;
        var m = this.getMonth();

        d.setUTCDate(1);
        d.setUTCFullYear(y);
        d.setUTCMonth(m);

        //var max = DayPilot.Date.daysInMonth(y, m + 1);
        var max = new DayPilot.Date(d).daysInMonth();
        d.setUTCDate(Math.min(max, original.getUTCDate()));

        return new DayPilot.Date(d);
    };

    DayPilot.Date.prototype.dayOfWeek = function() {
        return new Date(this.ticks).getUTCDay();
    };

    DayPilot.Date.prototype.getDayOfWeek = function() {
        return new Date(this.ticks).getUTCDay();
    };

    DayPilot.Date.prototype.getDayOfYear = function() {
        var first = this.firstDayOfYear();
        return DayPilot.DateUtil.daysDiff(first, this) + 1;
    };

    DayPilot.Date.prototype.daysInMonth = function() {
        var date = new Date(this.ticks);
        var month = date.getUTCMonth() + 1;
        var year = date.getUTCFullYear();


        var m = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        if (month !== 2)
            return m[month - 1];
        if (year % 4 !== 0)
            return m[1];
        if (year % 100 === 0 && year % 400 !== 0)
            return m[1];
        return m[1] + 1;

    };

    DayPilot.Date.prototype.daysInYear = function() {
        var year = this.getYear();
        if (year % 4 !== 0) {
            return 365;
        }
        if (year % 100 === 0 && year % 400 !== 0) {
            return 365;
        }
        return 366;
    };

    DayPilot.Date.prototype.dayOfYear = function() {
        return Math.ceil((this.getDatePart().getTime() - this.firstDayOfYear().getTime()) / 86400000) + 1;
    };

    // not required, direct comparison can be used
    DayPilot.Date.prototype.equals = function(another) {
        if (another === null) {
            return false;
        }
        if (another instanceof DayPilot.Date) {
            return this === another;
        }
        else {
            throw "The parameter must be a DayPilot.Date object (DayPilot.Date.equals())";
        }
    };

    DayPilot.Date.prototype.firstDayOfMonth = function() {
        //var utc = DayPilot.Date.firstDayOfMonth(this.getYear(), this.getMonth() + 1);
        //return new DayPilot.Date(utc);

        var d = new Date();
        d.setUTCFullYear(this.getYear(), this.getMonth(), 1);
        d.setUTCHours(0);
        d.setUTCMinutes(0);
        d.setUTCSeconds(0);
        d.setUTCMilliseconds(0);
        return new DayPilot.Date(d);

    };

    DayPilot.Date.prototype.firstDayOfYear = function() {
        var year = this.getYear();
        var d = new Date();
        d.setUTCFullYear(year, 0, 1);
        d.setUTCHours(0);
        d.setUTCMinutes(0);
        d.setUTCSeconds(0);
        d.setUTCMilliseconds(0);
        return new DayPilot.Date(d);
    };

    DayPilot.Date.prototype.firstDayOfWeek = function(weekStarts) {
        var d = this;
        if (weekStarts instanceof DayPilot.Locale) {
            weekStarts = weekStarts.weekStarts;
        }
        else if (typeof weekStarts === "string" && DayPilot.Locale.find(weekStarts)) {
            var locale = DayPilot.Locale.find(weekStarts);
            weekStarts = locale.weekStarts;
        }
        else {
            weekStarts = weekStarts || 0;
        }

        var day = d.dayOfWeek();
        while (day !== weekStarts) {
            d = d.addDays(-1);
            day = d.dayOfWeek();
        }
        return new DayPilot.Date(d);
    };

    DayPilot.Date.prototype.getDay = function() {
        return new Date(this.ticks).getUTCDate();
    };

    DayPilot.Date.prototype.getDatePart = function() {
        var d = new Date(this.ticks);
        d.setUTCHours(0);
        d.setUTCMinutes(0);
        d.setUTCSeconds(0);
        d.setUTCMilliseconds(0);
        return new DayPilot.Date(d);
    };

    DayPilot.Date.prototype.getYear = function() {
        return new Date(this.ticks).getUTCFullYear();
    };

    DayPilot.Date.prototype.getHours = function() {
        return new Date(this.ticks).getUTCHours();
    };

    DayPilot.Date.prototype.getMilliseconds = function() {
        return new Date(this.ticks).getUTCMilliseconds();
    };

    DayPilot.Date.prototype.getMinutes = function() {
        return new Date(this.ticks).getUTCMinutes();
    };

    DayPilot.Date.prototype.getMonth = function() {
        return new Date(this.ticks).getUTCMonth();
    };

    DayPilot.Date.prototype.getSeconds = function() {
        return new Date(this.ticks).getUTCSeconds();
    };

    DayPilot.Date.prototype.getTotalTicks = function() {
        return this.getTime();
    };

    // undocumented
    DayPilot.Date.prototype.getTime = function() {
        return this.ticks;
    };

    DayPilot.Date.prototype.getTimePart = function() {
        var datePart = this.getDatePart();
        return DayPilot.DateUtil.diff(this, datePart);
    };

    DayPilot.Date.prototype.lastDayOfMonth = function() {
        //var utc = DayPilot.Date.lastDayOfMonth(this.getYear(), this.getMonth() + 1);
        //return new DayPilot.Date(utc);
        var d = new Date(this.firstDayOfMonth().getTime());
        var length = this.daysInMonth();
        d.setUTCDate(length);
        return new DayPilot.Date(d);
    };

    DayPilot.Date.prototype.weekNumber = function() {
        var first = this.firstDayOfYear();
        var days = (this.getTime() - first.getTime()) / 86400000;
        return Math.ceil((days + first.dayOfWeek() + 1) / 7);
    };

    // ISO 8601
    DayPilot.Date.prototype.weekNumberISO = function() {
        var thursdayFlag = false;
        var dayOfYear = this.dayOfYear();

        var startWeekDayOfYear = this.firstDayOfYear().dayOfWeek();
        var endWeekDayOfYear = this.firstDayOfYear().addYears(1).addDays(-1).dayOfWeek();
        //int startWeekDayOfYear = new DateTime(date.getYear(), 1, 1).getDayOfWeekOrdinal();
        //int endWeekDayOfYear = new DateTime(date.getYear(), 12, 31).getDayOfWeekOrdinal();

        if (startWeekDayOfYear === 0) {
            startWeekDayOfYear = 7;
        }
        if (endWeekDayOfYear === 0) {
            endWeekDayOfYear = 7;
        }

        var daysInFirstWeek = 8 - (startWeekDayOfYear);

        if (startWeekDayOfYear === 4 || endWeekDayOfYear === 4) {
            thursdayFlag = true;
        }

        var fullWeeks = Math.ceil((dayOfYear - (daysInFirstWeek)) / 7.0);

        var weekNumber = fullWeeks;

        if (daysInFirstWeek >= 4) {
            weekNumber = weekNumber + 1;
        }

        if (weekNumber > 52 && !thursdayFlag) {
            weekNumber = 1;
        }

        if (weekNumber === 0) {
            weekNumber = this.firstDayOfYear().addDays(-1).weekNumberISO(); //weekNrISO8601(new DateTime(date.getYear() - 1, 12, 31));
        }

        return weekNumber;

    };

    DayPilot.Date.prototype.toDateLocal = function() {
        var date = new Date(this.ticks);

        var d = new Date();
        d.setFullYear(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate());
        d.setHours(date.getUTCHours());
        d.setMinutes(date.getUTCMinutes());
        d.setSeconds(date.getUTCSeconds());
        d.setMilliseconds(date.getUTCMilliseconds());
        return d;

    };

    DayPilot.Date.prototype.toDate = function() {
        return new Date(this.ticks);
    };

    DayPilot.Date.prototype.toJSON = function() {
        return this.value;
    };

    // formatting and languages needed here
    DayPilot.Date.prototype.toString = function(pattern, locale) {
        if (!pattern) {
            return this.toStringSortable();
        }
        return new Pattern(pattern, locale).print(this);
    };

    DayPilot.Date.prototype.toStringSortable = function() {
        return ticksToSortable(this.ticks);
    };

    function ticksToSortable(ticks) {

        var cache = DayPilot.Date.Cache.Ticks;
        if (cache[ticks]) {
            DayPilot.Stats.cacheHitsTicks += 1;
            return cache[ticks];
        }

        var d = new Date(ticks);

        var millisecond;
        var ms = d.getUTCMilliseconds();

        if (ms === 0) {
            millisecond = "";
        }
        else if (ms < 10) {
            millisecond = ".00" + ms;
        }
        else if (ms < 100) {
            millisecond = ".0" + ms;
        }
        else {
            millisecond = "." + ms
        }

        var second = d.getUTCSeconds();
        if (second < 10)
            second = "0" + second;
        var minute = d.getUTCMinutes();
        if (minute < 10)
            minute = "0" + minute;
        var hour = d.getUTCHours();
        if (hour < 10)
            hour = "0" + hour;
        var day = d.getUTCDate();
        if (day < 10)
            day = "0" + day;
        var month = d.getUTCMonth() + 1;
        if (month < 10)
            month = "0" + month;
        var year = d.getUTCFullYear();

        if (year <= 0) {
            throw "The minimum year supported is 1.";
        }
        if (year < 10) {
            year = "000" + year;
        }
        else if (year < 100) {
            year = "00" + year;
        }
        else if (year < 1000) {
            year = "0" + year;
        }

        var result = year + "-" + month + "-" + day + 'T' + hour + ":" + minute + ":" + second + millisecond;
        cache[ticks] = result;
        return result;
    }

    /* static functions, return DayPilot.Date object */

    // returns null if parsing was not successful
    DayPilot.Date.parse = function(str, pattern, locale) {
        var p = new Pattern(pattern, locale);
        return p.parse(str);
    };

    var todayCount = 0;

    DayPilot.Date.today = function() {
        //return new DayPilot.Date().getDatePart();
        return new DayPilot.Date(DayPilot.DateUtil.localToday(), true);
    };

    DayPilot.Date.now = function() {
        return new DayPilot.Date();
    };

    DayPilot.Date.fromYearMonthDay = function(year, month, day) {
        month = month || 1;
        day = day || 1;

        var d = new Date(0);
        d.setUTCFullYear(year);
        d.setUTCMonth(month - 1);
        d.setUTCDate(day);
        return new DayPilot.Date(d);
    };

    DayPilot.DateUtil = {};

    /* internal functions, all operate with GMT base of the date object
     (except of DayPilot.DateUtil.fromLocal()) */

    DayPilot.DateUtil.fromStringSortable = function(string, readLocal) {
        /*
        Supported formats:
        2015-01-01
        2015-01-01T00:00:00
        2015-01-01T00:00:00.000
        2015-01-01T00:00:00Z
        2015-01-01T00:00:00.000Z
        2015-01-01T00:00:00+01:00
        2015-01-01T00:00:00.000+01:00

         */

        if (!string) {
            throw "Can't create DayPilot.Date from an empty string";
        }

        var len = string.length;
        var date = len === 10;
        var datetime = len === 19;
        var long = len > 19;

        if (!date && !datetime && !long) {
            throw "Invalid string format (use '2010-01-01' or '2010-01-01T00:00:00'): " + string;
        }

        if (DayPilot.Date.Cache.Parsing[string] && !readLocal) {
            DayPilot.Stats.cacheHitsParsing += 1;
            return DayPilot.Date.Cache.Parsing[string];
        }

        var year = string.substring(0, 4);
        var month = string.substring(5, 7);
        var day = string.substring(8, 10);

        var d = new Date(0);
        d.setUTCFullYear(year, month - 1, day);

        if (date) {
            /*
            d.setUTCHours(0);
            d.setUTCMinutes(0);
            d.setUTCSeconds(0);
            d.setUTCMilliseconds(0);
            */
            //result = d;
            DayPilot.Date.Cache.Parsing[string] = d;
            return d;
        }

        var hours = string.substring(11, 13);
        var minutes = string.substring(14, 16);
        var seconds = string.substring(17, 19);

        d.setUTCHours(hours);
        d.setUTCMinutes(minutes);
        d.setUTCSeconds(seconds);
        //d.setUTCMilliseconds(0);
        //result = d;

        if (datetime) {
            DayPilot.Date.Cache.Parsing[string] = d;
            return d;
        }

        var tzdir = string[19];

        var tzoffset = 0;

        if (tzdir === ".") {
            var ms = parseInt(string.substring(20, 23)); /// .000
            d.setUTCMilliseconds(ms);
            tzoffset = DayPilot.DateUtil.getTzOffsetMinutes(string.substring(23));
        }
        else {
            tzoffset = DayPilot.DateUtil.getTzOffsetMinutes(string.substring(19));
        }

        var dd = new DayPilot.Date(d);
        if (!readLocal) {
            dd = dd.addMinutes(-tzoffset);
        }

        d = dd.toDate(); // get UTC base

        DayPilot.Date.Cache.Parsing[string] = d;
        return d;
    };

    DayPilot.DateUtil.getTzOffsetMinutes = function(string) {
        if (DayPilot.Util.isNullOrUndefined(string) || string === "") {
            return 0;
        }
        if (string === "Z") {
            return 0;
        }

        var tzdir = string[0];

        var tzhours = parseInt(string.substring(1, 3));
        var tzminutes = parseInt(string.substring(4));
        var tzoffset = tzhours * 60 + tzminutes;

        if (tzdir === "-") {
            return -tzoffset;
        }
        else if (tzdir === "+") {
            return tzoffset;
        }
        else {
            throw "Invalid timezone spec: " + string;
        }
    };

    DayPilot.DateUtil.hasTzSpec = function(string) {
        if (string.indexOf("+")) {
            return true;
        }
        if (string.indexOf("-")) {
            return true;
        }
        return false;
    };


    // rename candidate: diffDays
    DayPilot.DateUtil.daysDiff = function(first, second) {
        (first && second) || (function() { throw "two parameters required"; })();

        first = new DayPilot.Date(first);
        second = new DayPilot.Date(second);

        if (first.getTime() > second.getTime()) {
            return null;
        }

        var i = 0;
        var fDay = first.getDatePart();
        var sDay = second.getDatePart();

        while (fDay < sDay) {
            fDay = fDay.addDays(1);
            i++;
        }

        return i;
    };

    DayPilot.DateUtil.daysSpan = function(first, second) {
        (first && second) || (function() { throw "two parameters required"; })();

        first = new DayPilot.Date(first);
        second = new DayPilot.Date(second);

        if (first.getTime() === second.getTime()) {
            return 0;
        }

        var diff = DayPilot.DateUtil.daysDiff(first, second);

        if (second.getTime() == second.getDatePart().getTime()) {
            diff--;
        }

        return diff;
    };

    DayPilot.DateUtil.diff = function(first, second) { // = first - second
        if (!(first && second && first.getTime && second.getTime)) {
            throw "Both compared objects must be Date objects (DayPilot.Date.diff).";
        }

        return first.getTime() - second.getTime();
    };

    // returns Date object
    DayPilot.DateUtil.fromLocal = function(localDate) {
        if (!localDate) {
            localDate = new Date();
        }

        var d = new Date();
        d.setUTCFullYear(localDate.getFullYear(), localDate.getMonth(), localDate.getDate());
        d.setUTCHours(localDate.getHours());
        d.setUTCMinutes(localDate.getMinutes());
        d.setUTCSeconds(localDate.getSeconds());
        d.setUTCMilliseconds(localDate.getMilliseconds());
        return d;
    };

    DayPilot.DateUtil.localToday = function() {
        var d = new Date();
        d.setHours(0);
        d.setMinutes(0);
        d.setSeconds(0);
        d.setMilliseconds(0);
        return d;
    };

    // rename candidate: toHourString
    DayPilot.DateUtil.hours = function(date, use12) {

        var minute = date.getUTCMinutes();
        if (minute < 10)
            minute = "0" + minute;


        var hour = date.getUTCHours();
        //if (hour < 10) hour = "0" + hour;

        if (use12) {
            var am = hour < 12;
            var hour = hour % 12;
            if (hour === 0) {
                hour = 12;
            }
            var suffix = am ? "AM" : "PM";
            return hour + ':' + minute + ' ' + suffix;
        }
        else {
            return hour + ':' + minute;
        }
    };

    DayPilot.DateUtil.max = function(first, second) {
        if (first.getTime() > second.getTime()) {
            return first;
        }
        else {
            return second;
        }
    };

    DayPilot.DateUtil.min = function(first, second) {
        if (first.getTime() < second.getTime()) {
            return first;
        }
        else {
            return second;
        }
    };

    var Pattern = function(pattern, locale) {
        if (typeof locale === "string") {
            locale = DayPilot.Locale.find(locale);
        }
        var locale = locale || DayPilot.Locale.US;
        var all = [
            {"seq": "yyyy", "expr": "[0-9]{4,4\u007d", "str": function(d) {
                    return d.getYear();
                }},
            {"seq": "yy", "expr": "[0-9]{2,2\u007d", "str": function(d) {
                    return d.getYear() % 100;
                }},
            {"seq": "mm", "expr": "[0-9]{2,2\u007d", "str": function(d) {
                    var r = d.getMinutes();
                    return r < 10 ? "0" + r : r;
                }},
            {"seq": "m", "expr": "[0-9]{1,2\u007d", "str": function(d) {
                    var r = d.getMinutes();
                    return r;
                }},
            {"seq": "HH", "expr": "[0-9]{2,2\u007d", "str": function(d) {
                    var r = d.getHours();
                    return r < 10 ? "0" + r : r;
                }},
            {"seq": "H", "expr": "[0-9]{1,2\u007d", "str": function(d) {
                    var r = d.getHours();
                    return r;
                }},
            {"seq": "hh", "expr": "[0-9]{2,2\u007d", "str": function(d) {
                    var hour = d.getHours();
                    var hour = hour % 12;
                    if (hour === 0) {
                        hour = 12;
                    }
                    var r = hour;
                    return r < 10 ? "0" + r : r;
                }},
            {"seq": "h", "expr": "[0-9]{1,2\u007d", "str": function(d) {
                    var hour = d.getHours();
                    var hour = hour % 12;
                    if (hour === 0) {
                        hour = 12;
                    }
                    return hour;
                }},
            {"seq": "ss", "expr": "[0-9]{2,2\u007d", "str": function(d) {
                    var r = d.getSeconds();
                    return r < 10 ? "0" + r : r;
                }},
            {"seq": "s", "expr": "[0-9]{1,2\u007d", "str": function(d) {
                    var r = d.getSeconds();
                    return r;
                }},
            {"seq": "MMMM", "expr": "[^\\s0-9]*", "str": function(d) {
                    var r = locale.monthNames[d.getMonth()];
                    return r;
                }, "transform" : function(input) {
                    var index = DayPilot.indexOf(locale.monthNames, input, equalsIgnoreCase);
                    if (index < 0) {
                        return null;
                    }
                    return index + 1;
                }},
            {"seq": "MMM", "expr": "[^\\s0-9]*", "str": function(d) {  // \u0073 = 's'
                    var r = locale.monthNamesShort[d.getMonth()];
                    return r;
                }, "transform" : function(input) {
                    var index = DayPilot.indexOf(locale.monthNamesShort, input, equalsIgnoreCase);
                    if (index < 0) {
                        return null;
                    }
                    return index + 1;
                }},
            {"seq": "MM", "expr": "[0-9]{2,2\u007d", "str": function(d) {
                    var r = d.getMonth() + 1;
                    return r < 10 ? "0" + r : r;
                }},
            {"seq": "M", "expr": "[0-9]{1,2\u007d", "str": function(d) {
                    var r = d.getMonth() + 1;
                    return r;
                }},
            {"seq": "dddd", "expr": "[^\\s0-9]*", "str": function(d) {
                    var r = locale.dayNames[d.getDayOfWeek()];
                    return r;
                }},
            {"seq": "ddd", "expr": "[^\\s0-9]*", "str": function(d) {
                    var r = locale.dayNamesShort[d.getDayOfWeek()];
                    return r;
                }},
            {"seq": "dd", "expr": "[0-9]{2,2\u007d", "str": function(d) {
                    var r = d.getDay();
                    return r < 10 ? "0" + r : r;
                }},
            {"seq": "%d", "expr": "[0-9]{1,2\u007d", "str": function(d) {
                    var r = d.getDay();
                    return r;
                }},
            {"seq": "d", "expr": "[0-9]{1,2\u007d", "str": function(d) {
                    var r = d.getDay();
                    return r;
                }},
            {"seq": "tt", "expr": "(AM|PM|am|pm)", "str": function(d) {
                    var hour = d.getHours();
                    var am = hour < 12;
                    return am ? "AM" : "PM";
                }, "transform" : function(input) {
                    return input.toUpperCase();
                }},
        ];

        var escapeRegex = function(text) {
            return text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
        };

        this.init = function() {
            this.year = this.findSequence("yyyy");
            this.month = this.findSequence("MMMM") || this.findSequence("MMM") || this.findSequence("MM") || this.findSequence("M");
            this.day = this.findSequence("dd") || this.findSequence("d");

            this.hours = this.findSequence("HH") || this.findSequence("H");
            this.minutes = this.findSequence("mm") || this.findSequence("m");
            this.seconds = this.findSequence("ss") || this.findSequence("s");

            this.ampm = this.findSequence("tt");
            this.hours12 = this.findSequence("hh") || this.findSequence("h");

            /*if (this.hours && this.ampm) {
                throw new DayPilot.Exception("'HH' and 'H' specifiers cannot be used in combination with 'tt'. Use 12-hour clock specifiers: 'hh' or 'h'.");
            }*/
        };

        this.findSequence = function(seq) {

            function defaultTransform(value) {
                return parseInt(value);
            }

            var index = pattern.indexOf(seq);
            if (index === -1) {
                return null;
            }
            return {
                "findValue": function(input) {
                    var prepared = escapeRegex(pattern);
                    var transform = null;
                    for (var i = 0; i < all.length; i++) {
                        var len = all[i].length;
                        var pick = (seq === all[i].seq);
                        //var expr = "";
                        var expr = all[i].expr;
                        if (pick) {
                            expr = "(" + expr + ")";
                            transform = all[i].transform;
                        }
                        prepared = prepared.replace(all[i].seq, expr);
                    }

                    prepared = "^" + prepared + "$";

                    try {
                        var r = new RegExp(prepared);
                        var array = r.exec(input);
                        if (!array) {
                            return null;
                        }
                        transform = transform || defaultTransform;  // parseInt is the default transform/parse function
                        return transform(array[1]);
                    }
                    catch (e) {
                        throw "unable to create regex from: " + prepared;
                    }
                }
            };
        };

        this.print = function(date) {
            // always recompiles the pattern

            var find = function(t) {
                for (var i = 0; i < all.length; i++) {
                    if (all[i] && all[i].seq === t) {
                        return all[i];
                    }
                }
                return null;
            };

            var eos = pattern.length <= 0;
            var pos = 0;
            var components = [];

            while (!eos) {
                var rem = pattern.substring(pos);
                var matches = /%?(.)\1*/.exec(rem);  // matches a sequence of identical characters, with an optional '%' preceding char
                if (matches && matches.length > 0) {
                    var match = matches[0];
                    var q = find(match);
                    if (q) {
                        components.push(q);
                    }
                    else {
                        components.push(match);
                    }
                    pos += match.length;
                    eos = pattern.length <= pos;
                }
                else {
                    eos = true;
                }
            }

            // resolve placeholders
            for (var i = 0; i < components.length; i++) {
                var c = components[i];
                if (typeof c !== 'string') {
                    components[i] = c.str(date);
                }
            }

            return components.join("");
        };



        this.parse = function(input) {

            var year = this.year.findValue(input);
            if (!year) {
                return null; // unparseable
            }

            var month = this.month.findValue(input);
            if (DayPilot.Util.isNullOrUndefined(month)) {
                return null;
            }
            if (month > 12 || month < 1) {
                return null;
            }
            var day = this.day.findValue(input);

            var daysInMonth = DayPilot.Date.fromYearMonthDay(year, month).daysInMonth();
            if (day < 1 || day > daysInMonth) {
                return null;
            }

            var hours = this.hours ? this.hours.findValue(input) : 0;
            var minutes = this.minutes ? this.minutes.findValue(input) : 0;
            var seconds = this.seconds ? this.seconds.findValue(input) : 0;

            var ampm = this.ampm ? this.ampm.findValue(input): null;

            if (this.ampm && this.hours12) {

                var hours12 = this.hours12.findValue(input);

                if (hours12 < 1 || hours12 > 12) {
                    return null;
                }

                if (ampm === "PM") {
                    if (hours12 === 12) {
                        hours = 12;
                    }
                    else {
                        hours = hours12 + 12;
                    }
                }
                else {
                    if (hours12 === 12) {
                        hours = 0;
                    }
                    else {
                        hours = hours12;
                    }
                }

            }

            if (hours < 0 || hours > 23) {
                return null;
            }

            if (minutes < 0 || minutes > 59) {
                return null;
            }

            if (seconds < 0 || seconds > 59) {
                return null;
            }

            var d = new Date();
            d.setUTCFullYear(year, month - 1, day);
            d.setUTCHours(hours);
            d.setUTCMinutes(minutes);
            d.setUTCSeconds(seconds);
            d.setUTCMilliseconds(0);

            return new DayPilot.Date(d);
        };

        this.init();

    };

    function equalsIgnoreCase(str1, str2) {
        if (DayPilot.Util.isNullOrUndefined(str1)) {
            return false;
        }
        if (DayPilot.Util.isNullOrUndefined(str2)) {
            return false;
        }
        return str1.toLocaleLowerCase() === str2.toLocaleLowerCase();
    }

    // DayPilot.Date END


    DayPilot.ColorUtil = {};

    function toHex(dec) {
        dec = Math.min(dec, 255);
        dec = Math.max(dec, 0);
        var str = dec.toString(16);
        return (dec < 16) ? "0" + str : str;
    }

    DayPilot.ColorUtil.hexToRgb = function(hex) {
        if (!/^#[0-9a-f]{6}$/i.test(hex)) {
            throw new DayPilot.Exception("Invalid color, only full hex color string accepted, eg. '#ffaaff'.");
        }
        hex = hex.replace("#", "");
        return {
            r: parseInt(hex.substring(0, 2), 16),
            g: parseInt(hex.substring(2, 4), 16),
            b: parseInt(hex.substring(4, 6), 16),
        };
    };

    DayPilot.ColorUtil.rgbToHex = function(rgb) {
        return "#" + toHex(rgb.r) + toHex(rgb.g) + toHex(rgb.b);
    };

    // pt in 255 base
    DayPilot.ColorUtil.adjustLuminance = function(rgb, pt) {
        return {
            r: rgb.r + pt,
            g: rgb.g + pt,
            b: rgb.b + pt
        };
    };

    DayPilot.ColorUtil.darker = function(hexColor, steps) {
        var src = DayPilot.ColorUtil.hexToRgb(hexColor);
        steps = steps || 1;
        var step = 17; // (0xbb - 0xaa = 17)
        var pt = steps * step;
        var target = DayPilot.ColorUtil.adjustLuminance(src, -pt);
        return DayPilot.ColorUtil.rgbToHex(target);
    };

    DayPilot.ColorUtil.lighter = function(hexColor, steps) {
        if (typeof steps !== "number") {
            steps = 1;
        }
        return DayPilot.ColorUtil.darker(hexColor, -steps);
    };


    DayPilot.ColorUtil.pl = function(hexColor) {
        var rgb = DayPilot.ColorUtil.hexToRgb(hexColor);
        var r = rgb.r / 255;
        var g = rgb.g / 255;
        var b = rgb.b / 255;
        var pl = Math.sqrt(0.299*r*r + 0.587*g*g + 0.114*b*b);
        return pl;
    };

    DayPilot.ColorUtil.contrasting = function(hexColor, light, dark) {
        var pl = DayPilot.ColorUtil.pl(hexColor);
        light = light || "#ffffff";
        dark = dark || "#000000";
        return pl > 0.5 ? dark : light;
    };


    DayPilot.Event = function(data, calendar, part) {
        var e = this;
        this.calendar = calendar;
        this.data = data ? data : {};
        this.part = part ? part : {};

        // backwards compatibility, still accepts id in "value"
        if (typeof this.data.id === 'undefined') {
            this.data.id = this.data.value;
        }

        var copy = {};
        var synced = ["id", "text", "start", "end", "resource"];

        this.isEvent = true;

        // internal
        this.temp = function() {
            if (copy.dirty) {
                return copy;
            }
            for (var i = 0; i < synced.length; i++) {
                copy[synced[i]] = e.data[synced[i]];
            }
            copy.dirty = true;
            return copy;

        };

        // internal
        this.copy = function() {
            var result = {};
            for (var i = 0; i < synced.length; i++) {
                result[synced[i]] = e.data[synced[i]];
            }
            return result;
        };

        this.commit = function() {
            if (!copy.dirty) {
                return;
            }

            for (var i = 0; i < synced.length; i++) {
                e.data[synced[i]] = copy[synced[i]];
            }

            copy.dirty = false;
        };

        this.dirty = function() {
            return copy.dirty;
        };

        this.id = function(val) {
            if (typeof val === 'undefined') {
                return e.data.id;
            }
            else {
                this.temp().id = val;
            }
        };
        // obsolete, use id() instead
        this.value = function(val) {
            if (typeof val === 'undefined') {
                return e.id();
            }
            else {
                e.id(val);
            }
        };
        this.text = function(val) {
            if (typeof val === 'undefined') {
                return e.data.text;
            }
            else {
                this.temp().text = val;
                this.client.innerHTML(val); // update the HTML automatically
            }
        };
        this.start = function(val) {
            if (typeof val === 'undefined') {
                return new DayPilot.Date(e.data.start);
            }
            else {
                this.temp().start = new DayPilot.Date(val);
            }
        };
        this.end = function(val) {
            if (typeof val === 'undefined') {
                return new DayPilot.Date(e.data.end);
            }
            else {
                this.temp().end = new DayPilot.Date(val);
            }
        };
        this.resource = function(val) {
            if (typeof val === 'undefined') {
                return e.data.resource;
            }
            else {
                this.temp().resource = val;
            }
        };
        this.partStart = function() {
            return new DayPilot.Date(this.part.start);
        };
        this.partEnd = function() {
            return new DayPilot.Date(this.part.end);
        };

        this.tag = function(field) {
            var values = e.data.tag;
            if (!values) {
                return null;
            }
            if (typeof field === 'undefined') {
                return e.data.tag;
            }
            var fields = e.calendar.tagFields;
            var index = -1;
            for (var i = 0; i < fields.length; i++) {
                if (field === fields[i])
                    index = i;
            }
            if (index === -1) {
                throw "Field name not found.";
            }
            //var tags = t.split('&');
            return values[index];
        };

        this.client = {};
        this.client.innerHTML = function(val) {
            if (typeof val === 'undefined') {
                var data = e.cache || e.data;
                var xssTextHtml = e.calendar && e.calendar.internal && e.calendar.internal.xssTextHtml;
                if (xssTextHtml) {
                    return xssTextHtml(data.text, data.html);
                }
                return DayPilot.Util.escapeTextHtml(data.text, data.html);

                /*
                                if (e.cache && typeof e.cache.html !== "undefined") {
                                    return e.cache.html;
                                }
                                if (typeof e.data.html !== "undefined") {
                                    return e.data.html;
                                }
                                return e.data.text;
                */
            }
            else {
                e.data.html = val;
            }
        };

        this.client.html = this.client.innerHTML;

        this.client.header = function(val) {
            if (typeof val === 'undefined') {
                return e.data.header;
            }
            else {
                e.data.header = val;
            }
        };

        this.client.cssClass = function(val) {
            if (typeof val === 'undefined') {
                if (e.cache && typeof e.cache.cssClass !== "undefined") {
                    return e.cache.cssClass;
                }
                return e.data.cssClass;
            }
            else {
                e.data.cssClass = val;
            }
        };
        this.client.toolTip = function(val) {
            if (typeof val === 'undefined') {
                if (e.cache && typeof e.cache.toolTip !== "undefined") {
                    return e.cache.toolTip;
                }
                return typeof e.data.toolTip !== 'undefined' ? e.data.toolTip : e.data.text;
            }
            else {
                e.data.toolTip = val;
            }
        };

        this.client.barVisible = function(val) {
            if (typeof val === 'undefined') {
                if (e.cache && typeof e.cache.barHidden !== "undefined") {
                    return !e.cache.barHidden;
                }
                return e.calendar.durationBarVisible && !e.data.barHidden;
            }
            else {
                e.data.barHidden = !val;
            }
        };

        this.client.backColor = function(val) {
            if (typeof val === 'undefined') {
                if (e.cache && typeof e.cache.backColor !== "undefined") {
                    return e.cache.backColor;
                }
                return typeof e.data.backColor !== "undefined" ? e.data.backColor : e.calendar.eventBackColor;
            }
            else {
                e.data.backColor = val;
            }
        };

        this.client.borderColor = function(val) {
            if (typeof val === 'undefined') {
                if (e.cache && typeof e.cache.borderColor !== "undefined") {
                    return e.cache.borderColor;
                }
                return typeof e.data.borderColor !== "undefined" ? e.data.borderColor : e.calendar.eventBorderColor;
            }
            else {
                e.data.borderColor = val;
            }
        };

        this.client.contextMenu = function(val) {
            if (typeof val === 'undefined') {
                if (e.oContextMenu) {
                    return e.oContextMenu;
                }
                var cm = e.cache ? e.cache.contextMenu : e.data.contextMenu;
            }
            else {
                e.oContextMenu = val;
            }
        };

        this.client.moveEnabled = function(val) {
            if (typeof val === 'undefined') {
                if (e.cache && typeof e.cache.moveDisabled !== "undefined") {
                    return !e.cache.moveDisabled;
                }

                return e.calendar.eventMoveHandling !== 'Disabled' && !e.data.moveDisabled;
            }
            else {
                e.data.moveDisabled = !val;
            }
        };

        this.client.resizeEnabled = function(val) {
            if (typeof val === 'undefined') {
                if (e.cache && typeof e.cache.resizeDisabled !== "undefined") {
                    return !e.cache.resizeDisabled;
                }
                return e.calendar.eventResizeHandling !== 'Disabled' && !e.data.resizeDisabled;
            }
            else {
                e.data.resizeDisabled = !val;
            }
        };

        this.client.clickEnabled = function(val) {
            if (typeof val === 'undefined') {
                if (e.cache && typeof e.cache.clickDisabled !== "undefined") {
                    return !e.cache.clickDisabled;
                }
                return e.calendar.eventClickHandling !== 'Disabled' && !e.data.clickDisabled;
            }
            else {
                e.data.clickDisabled = !val;
            }
        };

        this.client.rightClickEnabled = function(val) {
            if (typeof val === 'undefined') {
                if (e.cache && typeof e.cache.rightClickDisabled !== "undefined") {
                    return !e.cache.rightClickDisabled;
                }
                return e.calendar.eventRightClickHandling !== 'Disabled' && !e.data.rightClickDisabled;
            }
            else {
                e.data.rightClickDisabled = !val;
            }
        };

        this.client.deleteEnabled = function(val) {
            if (typeof val === 'undefined') {
                if (e.cache && typeof e.cache.deleteDisabled !== "undefined") {
                    return !e.cache.deleteDisabled;
                }
                return e.calendar.eventDeleteHandling !== 'Disabled' && !e.data.deleteDisabled;
            }
            else {
                e.data.deleteDisabled = !val;
            }
        };

        this.toJSON = function(key) {
            var json = {};
            json.value = this.id(); // still sending it with the old name
            json.id = this.id();
            json.text = this.text();
            json.start = this.start();
            json.end = this.end();
            json.tag = {};

            if (e.calendar && e.calendar.tagFields) {
                var fields = e.calendar.tagFields;
                for (var i = 0; i < fields.length; i++) {
                    json.tag[fields[i]] = this.tag(fields[i]);
                }
            }

            return json;
        };
    };

})();

/* JSON */
// thanks to http://www.json.org/js.html


// declares DayPilot.JSON.stringify()
DayPilot.JSON = {};

(function () {
    function f(n) {
        return n < 10 ? '0' + n : n;
    }

    if (typeof Date.prototype.toJSON2 !== 'function') {

        Date.prototype.toJSON2 = function (key) {
            return this.getUTCFullYear()   + '-' +
                         f(this.getUTCMonth() + 1) + '-' +
                         f(this.getUTCDate())      + 'T' +
                         f(this.getUTCHours())     + ':' +
                         f(this.getUTCMinutes())   + ':' +
                         f(this.getUTCSeconds())   + '';
        };

        String.prototype.toJSON =
        Number.prototype.toJSON =
        Boolean.prototype.toJSON = function (key) {
            return this.valueOf();
        };
    }

    var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
        escapeable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
        gap,
        indent,
        meta = {
            '\b': '\\b',
            '\t': '\\t',
            '\n': '\\n',
            '\f': '\\f',
            '\r': '\\r',
            '"' : '\\"',
            '\\': '\\\\'
        },
        rep;

    function quote(string) {
        escapeable.lastIndex = 0;
        return escapeable.test(string) ?
            '"' + string.replace(escapeable, function (a) {
                var c = meta[a];
                if (typeof c === 'string') {
                    return c;
                }
                return '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
            }) + '"' :
            '"' + string + '"';
    }

    function str(key, holder) {
        var i,
            k,
            v,
            length,
            mind = gap,
            partial,
            value = holder[key];
        if (value && typeof value === 'object' && typeof value.toJSON2 === 'function') {
            value = value.toJSON2(key);
        }
        else if (value && typeof value === 'object' && typeof value.toJSON === 'function' && !value.ignoreToJSON) {
            value = value.toJSON(key);
        }
        if (typeof rep === 'function') {
            value = rep.call(holder, key, value);
        }
        switch (typeof value) {
        case 'string':
            return quote(value);
        case 'number':
            return isFinite(value) ? String(value) : 'null';
        case 'boolean':
        case 'null':
            return String(value);
        case 'object':
            if (!value) {
                return 'null';
            }
            gap += indent;
            partial = [];
            if (typeof value.length === 'number' &&
                    !value.propertyIsEnumerable('length')) {
                length = value.length;
                for (i = 0; i < length; i += 1) {
                    partial[i] = str(i, value) || 'null';
                }
                v = partial.length === 0 ? '[]' :
                    gap ? '[\n' + gap +
                            partial.join(',\n' + gap) + '\n' +
                                mind + ']' :
                          '[' + partial.join(',') + ']';
                gap = mind;
                return v;
            }
            if (rep && typeof rep === 'object') {
                length = rep.length;
                for (i = 0; i < length; i += 1) {
                    k = rep[i];
                    if (typeof k === 'string') {
                        v = str(k, value);
                        if (v) {
                            partial.push(quote(k) + (gap ? ': ' : ':') + v);
                        }
                    }
                }
            } else {
                for (k in value) {
                    if (Object.hasOwnProperty.call(value, k)) {
                        v = str(k, value);
                        if (v) {
                            partial.push(quote(k) + (gap ? ': ' : ':') + v);
                        }
                    }
                }
            }
            v = (partial.length === 0) ? '{\u007D' :
                gap ? '{\n' + gap + partial.join(',\n' + gap) + '\n' +
                        mind + '\u007D' : '{' + partial.join(',') + '\u007D';
            gap = mind;
            return v;
        }
    }

    if (typeof DayPilot.JSON.stringify !== 'function') {
        DayPilot.JSON.stringify = function (value, replacer, space) {
            var i;
            gap = '';
            indent = '';
            if (typeof space === 'number') {
                for (i = 0; i < space; i += 1) {
                    indent += ' ';
                }
            } else if (typeof space === 'string') {
                indent = space;
            }
            rep = replacer;
            if (replacer && typeof replacer !== 'function' && (typeof replacer !== 'object' || typeof replacer.length !== 'number')) {
                throw new Error('JSON.stringify');
            }
            return str('', {'': value});
        };
    }

})();
