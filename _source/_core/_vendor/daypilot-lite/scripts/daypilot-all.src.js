var DayPilot = {};/*
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

(function() {

    var doNothing = function() {};

    if (typeof DayPilot.Calendar !== 'undefined' && DayPilot.Calendar.events) {
        return;
    }

    var DayPilotCalendar = {};

    // internal selecting
    DayPilotCalendar.selectedCells = [];
    DayPilotCalendar.topSelectedCell = null;
    DayPilotCalendar.bottomSelectedCell = null;
    DayPilotCalendar.selecting = false;
    DayPilotCalendar.column = null;
    DayPilotCalendar.firstSelected = null;
    DayPilotCalendar.firstMousePos = null;

    // internal resizing
    DayPilotCalendar.originalMouse = null;
    DayPilotCalendar.originalHeight = null;
    DayPilotCalendar.originalTop = null;
    DayPilotCalendar.resizing = null;
    DayPilotCalendar.globalHandlers = false;

    // internal moving
    DayPilotCalendar.moving = null;

    // helpers
    DayPilotCalendar.register = function(calendar) {
        if (!DayPilotCalendar.registered) {
            DayPilotCalendar.registered = [];
        }
        var r = DayPilotCalendar.registered;

        for (var i = 0; i < r.length; i++) {
            if (r[i] === calendar) {
                return;
            }
        }
        r.push(calendar);
    };

    DayPilotCalendar.unregister = function (calendar) {
        var a = DayPilotCalendar.registered;
        if (!a) {
            return;
        }

        var i = DayPilot.indexOf(a, calendar);
        if (i === -1) {
            return;
        }
        a.splice(i, 1);
    };

    DayPilotCalendar.getCellsAbove = function(cell) {
        var array = [];
        var c = DayPilotCalendar.getColumn(cell);

        var tr = cell.parentNode;

        var select = null;
        while (tr && select !== DayPilotCalendar.firstSelected) {
            select = tr.getElementsByTagName("td")[c];
            array.push(select);
            tr = tr.previousSibling;
            while (tr && tr.tagName !== "TR") {
                tr = tr.previousSibling;
	        }
        }
        return array;
    };

    DayPilotCalendar.getCellsBelow = function(cell) {
        var array = [];
        var c = DayPilotCalendar.getColumn(cell);
        var tr = cell.parentNode;

        var select = null;
        while (tr && select !== DayPilotCalendar.firstSelected) {
            select = tr.getElementsByTagName("td")[c];
            array.push(select);
            tr = tr.nextSibling;
            while (tr && tr.tagName !== "TR") {
                tr = tr.nextSibling;
	        }
        }
        return array;
    };

    DayPilotCalendar.getColumn = function(cell) {
        var i = 0;
        while (cell.previousSibling) {
            cell = cell.previousSibling;
            if (cell.tagName === "TD") {
                i++;
	    }
        }
        return i;
    };

    DayPilotCalendar.gUnload = function (ev) {

        if (!DayPilotCalendar.registered) {
            return;
        }
        var r = DayPilotCalendar.registered;

        for (var i = 0; i < r.length; i++) {
            var c = r[i];
            c.dispose();

            DayPilotCalendar.unregister(c);
        }

    };

    DayPilotCalendar.gMouseUp = function (ev){

        if (DayPilotCalendar.resizing) {
            if (!DayPilotCalendar.resizingShadow) {
                DayPilotCalendar.resizing.style.cursor = 'default';
                document.body.style.cursor = 'default';
                DayPilotCalendar.resizing = null;
                DayPilot.Global.resizing = null;
                return;
            }

            var dpEvent = DayPilotCalendar.resizing.event;
            var height = DayPilotCalendar.resizingShadow.clientHeight + 4;
            var top = DayPilotCalendar.resizingShadow.offsetTop;
            var border = DayPilotCalendar.resizing.dpBorder;

            // stop resizing on the client
            DayPilotCalendar.deleteShadow(DayPilotCalendar.resizingShadow);
            DayPilotCalendar.resizingShadow = null;
            DayPilotCalendar.resizing.style.cursor = 'default';
            dpEvent.calendar.nav.top.style.cursor = 'auto';
            //document.body.style.cursor = 'default';
            DayPilotCalendar.resizing.onclick = null; // will be re-created anyway

            DayPilotCalendar.resizing = null;
            DayPilot.Global.resizing = null;

            dpEvent.calendar._eventResizeDispatch(dpEvent, height, top, border);
        }
        else if (DayPilotCalendar.moving) {
            if (!DayPilotCalendar.movingShadow) {
                DayPilotCalendar.moving = null;
                DayPilot.Global.moving = null;
	            document.body.style.cursor = 'default';
	            return;
            }

            var top = DayPilotCalendar.movingShadow.offsetTop;
            var dpEvent = DayPilotCalendar.moving.event;

            DayPilotCalendar.deleteShadow(DayPilotCalendar.movingShadow);
            DayPilot.Util.removeClass(DayPilotCalendar.moving, dpEvent.calendar._prefixCssClass("_event_moving_source"));

            var newColumnIndex = DayPilotCalendar.movingShadow.column;

            // stop moving on the client
            DayPilotCalendar.moving = null;
            DayPilot.Global.moving = null;
            DayPilotCalendar.movingShadow = null;
	        //document.body.style.cursor = 'default';
            dpEvent.calendar.nav.top.style.cursor = 'auto';

            dpEvent.calendar._eventMoveDispatch(dpEvent, newColumnIndex, top, ev);
        }
        else if (DayPilotCalendar.selecting && DayPilotCalendar.topSelectedCell !== null) {
            var calendar = DayPilotCalendar.selecting.calendar;
            DayPilotCalendar.selecting = false;

            var sel = calendar.getSelection();

            calendar._timeRangeSelectedDispatch(sel.start, sel.end, sel.resource);
            if (calendar.timeRangeSelectedHandling !== "Hold" && calendar.timeRangeSelectedHandling !== "HoldForever") {
                doNothing();
            }
        }
        else {
            DayPilotCalendar.selecting = false;
        }


    };

    DayPilotCalendar.deleteShadow = function(shadow) {
        if (!shadow) {
            return;
        }
        if (!shadow.parentNode) {
            return;
        }

        shadow.parentNode.removeChild(shadow);
    };

    DayPilotCalendar.moveShadow = function(column) {
        var shadow = DayPilotCalendar.movingShadow;
        var parent = shadow.parentNode;

        parent.style.display = 'none';

        shadow.parentNode.removeChild(shadow);
        column.firstChild.appendChild(shadow);
        shadow.style.left = '0px';

        parent.style.display = '';

        shadow.style.width = (DayPilotCalendar.movingShadow.parentNode.offsetWidth + 1) + 'px';
    };

    DayPilotCalendar.Calendar = function(id, options) {

        var isConstructor = false;
        if (this instanceof DayPilotCalendar.Calendar && !this.__constructor) {
            isConstructor = true;
            this.__constructor = true;
        }

        if (!isConstructor) {
            throw "DayPilot.Calendar() is a constructor and must be called as 'var c = new DayPilot.Calendar(id);'";
        }

        var calendar = this;
        this.uniqueID = null;
        this.isCalendar = true;

        this.v = '2024.3.543-lite';
        this.id = id;
        this.clientName = id;

        this.cache = {};
        this.cache.pixels = {};

        this.elements = {};
        this.elements.events = [];
        this.elements.selection = [];

        this.nav = {};

        this.afterRender = function() {};

        this.fasterDispose = true;

        this.angularAutoApply = false;
        this.api = 2;
        this.businessBeginsHour = 9;
        this.businessEndsHour = 18;
        this.cellHeight = 30;
        this.columnMarginRight = 5;
        this.columnsLoadMethod = "GET";
        this.contextMenu = null;
        this.days = 1;
        this.durationBarVisible = true;
        this.eventsLoadMethod = "GET";
        this.headerDateFormat = null;   // uses locale.dateFormat by default
        this.headerHeight = 30;
        this.headerTextWrappingEnabled = false;
        this.height = 300;
        this.heightSpec = 'BusinessHours';
        this.hideUntilInit = true;
        this.hourWidth = 60;
        this.initScrollPos = 'Auto';
        this.loadingLabelHtml = null;
        this.loadingLabelText = "Loading...";
        this.loadingLabelVisible = true;
        this.locale = "en-us";
        this.showToolTip = true;
        this.startDate = new DayPilot.Date().getDatePart();
        this.cssClassPrefix = "calendar_default";
        this.theme = null;
        this.timeFormat = 'Auto';
        this.viewType = "Days";
        this.visible = true;
        this.xssProtection = "Enabled";

        this.headerClickHandling = "Enabled";
        this.eventClickHandling = 'Enabled';
        this.eventResizeHandling = 'Update';
        this.eventRightClickHandling = 'ContextMenu';
        this.eventMoveHandling = 'Update';
        this.eventDeleteHandling = "Disabled";
        this.timeRangeSelectedHandling = 'Enabled';

        this.onBeforeCellRender = null;
        this.onBeforeEventRender = null;
        this.onBeforeHeaderRender = null;

        this.onEventClick = null;
        this.onEventClicked = null;
        this.onEventDelete = null;
        this.onEventDeleted = null;
        this.onEventMove = null;
        this.onEventMoved = null;
        this.onEventResize = null;
        this.onEventResized = null;
        this.onEventRightClick = null;
        this.onEventRightClicked = null;
        this.onHeaderClick = null;
        this.onHeaderClicked = null;
        this.onTimeRangeSelect = null;
        this.onTimeRangeSelected = null;

        this._disposed = false;

        this.clearSelection = function() {
            DayPilotCalendar.topSelectedCell = null;
            DayPilotCalendar.bottomSelectedCell = null;
            this._hideSelection();
        };

        this._hideSelection = function() {
            DayPilot.de(calendar.elements.selection);
            calendar.elements.selection = [];
            calendar.nav.activeSelection = null;
        };

        this.cleanSelection = this.clearSelection;

        this._postBack2 = function(action, data, parameters) {
            var envelope = {};
            envelope.action = action;
            envelope.parameters = parameters;
            envelope.data = data;
            envelope.header = this._getCallBackHeader();

            var commandstring = "JSON" + DayPilot.JSON.stringify(envelope);
            __doPostBack(calendar.uniqueID, commandstring);
        };

        this._callBack2 = function(action, data, parameters) {

            if (this.callbackTimeout) {
                window.clearTimeout(this.callbackTimeout);
            }

            this.callbackTimeout = window.setTimeout(function() {
                calendar.loadingStart();
            }, 100);

            var envelope = {};

            envelope.action = action;
            envelope.parameters = parameters;
            envelope.data = data;
            envelope.header = this._getCallBackHeader();

            var commandstring = "JSON" + DayPilot.JSON.stringify(envelope);
            if (this.backendUrl) {
                DayPilot.request(this.backendUrl, this._callBackResponse, commandstring, this.ajaxError);
            }
            else if (typeof WebForm_DoCallback === 'function') {
                WebForm_DoCallback(this.uniqueID, commandstring, this._updateView, this.clientName, this.onCallbackError, true);
            }
        };

        this.onCallbackError = function(result, context) {
            alert("Error!\r\nResult: " + result + "\r\nContext:" + context);
        };

        this.dispose = function() {


            var c = calendar;

            if (c._disposed) {
                return;
            }
            c._disposed = true;

            clearInterval(c._visibilityInterval);

            c._deleteEvents();
            c.nav.scroll.root = null;

            DayPilot.pu(c.nav.loading);

            c._disposeMain();
            c._disposeHeader();

            c.nav.select = null;
            c.nav.cornerRight = null;
            c.nav.scrollable = null;
            c.nav.zoom = null;
            c.nav.loading = null;
            c.nav.header = null;
            c.nav.hourTable = null;
            c.nav.scrolltop = null;
            c.nav.scroll.onscroll = null;
            c.nav.scroll = null;
            c.nav.main = null;
            c.nav.message = null;
            c.nav.messageClose = null;
            c.nav.top = null;

            DayPilotCalendar.unregister(c);
        };

        this.disposed = function() {
            return this._disposed;
        };

        this._registerDispose = function() {
            this.nav.top.dispose = this.dispose;
        };

        this._callBackResponse = function(response) {
            calendar._updateView(response.responseText);
        };

        this._getCallBackHeader = function() {
            var h = {};

            h.control = "dpc";
            h.id = this.id;
            h.v = this.v;

            h.days = calendar.days;
            h.startDate = calendar.startDate;
            h.heightSpec = calendar.heightSpec;
            h.businessBeginsHour = calendar.businessBeginsHour;
            h.businessEndsHour = calendar.businessEndsHour;
            h.hashes = calendar.hashes;

            // h.backColor = calendar.cellBackColor;
            h.timeFormat = calendar.timeFormat;
            h.viewType = calendar.viewType;
            h.locale = calendar.locale;

            return h;
        };

        this._createShadow = function(object, copyText) {
            var parentTd = object.parentNode;
            while (parentTd && parentTd.tagName !== "TD") {
                parentTd = parentTd.parentNode;
            }

            var shadow = document.createElement('div');
            shadow.setAttribute('unselectable', 'on');
            shadow.style.position = 'absolute';
            shadow.style.width = (object.offsetWidth) + 'px';
            shadow.style.height = (object.offsetHeight) + 'px';
            shadow.style.left = (object.offsetLeft) + 'px';
            shadow.style.top = (object.offsetTop) + 'px';
            shadow.style.boxSizing = "border-box";
            shadow.style.zIndex = 101;

            // shadow.style.backgroundColor = "#aaaaaa";
            // shadow.style.opacity = 0.5;
            // shadow.style.filter = "alpha(opacity=50)";
            // shadow.style.border = '2px solid #aaaaaa';

            shadow.className = calendar._prefixCssClass("_shadow");

            var inner = document.createElement("div");
            inner.className = calendar._prefixCssClass("_shadow_inner");
            shadow.appendChild(inner);

            if (copyText && false) {  // disabled
                shadow.style.overflow = 'hidden';
                shadow.style.fontSize = object.style.fontSize;
                shadow.style.fontFamily = object.style.fontFamily;
                shadow.style.color = object.style.color;
                shadow.innerHTML = object.data.client.html();
            }

            /*
            shadow.style.MozBorderRadius = "5px";
            shadow.style.webkitBorderRadius = "5px";
            shadow.style.borderRadius = "5px";
            */

            parentTd.firstChild.appendChild(shadow);

            return shadow;
        };


        this._resolved = {};
        this._resolved.locale = function() {
            var found = DayPilot.Locale.find(calendar.locale);
            if (!found) {
                return DayPilot.Locale.US;
            }
            return found;
        };

        this._resolved.timeFormat = function() {
            if (calendar.timeFormat !== 'Auto') {
                return calendar.timeFormat;
            }
            return this.locale().timeFormat;
        };

        this._resolved._xssProtectionEnabled = function() {
            return calendar.xssProtection !== "Disabled";
        };

        this._resolved._weekStarts = function() {
            if (calendar.weekStarts === 'Auto') {
                var locale = resolved.locale();
                if (locale) {
                    return locale.weekStarts;
                }
                else {
                    return 0; // Sunday
                }
            }
            else {
                return calendar.weekStarts || 0;
            }
        };

        var resolved = this._resolved;

        this._updateView = function(result, context) {

            if (result && result.indexOf("$$$") === 0) {
                if (window.console) {
                    console.log("Error received from the server side: " + result);
                }
                else {
                    throw "Error received from the server side: " + result;
                }
                return;
            }

            var result = JSON.parse(result);

            if (result.CallBackRedirect) {
                document.location.href = result.CallBackRedirect;
                return;
            }

            if (result.UpdateType === "None") {
                calendar.loadingStop();
                calendar._show();
                return;
            }

            calendar._deleteEvents();

            if (result.UpdateType === "Full") {

                calendar.columns = result.Columns;

                // properties
                calendar.days = result.Days;
                calendar.startDate = new DayPilot.Date(result.StartDate);
                calendar.heightSpec = result.HeightSpec ? result.HeightSpec : calendar.heightSpec;
                calendar.businessBeginsHour = result.BusinessBeginsHour ? result.BusinessBeginsHour : calendar.businessBeginsHour;
                calendar.businessEndsHour = result.BusinessEndsHour ? result.BusinessEndsHour : calendar.businessEndsHour;
                calendar.headerDateFormat = result.HeaderDateFormat ? result.HeaderDateFormat : calendar.headerDateFormat;
                calendar.viewType = result.ViewType; //
                calendar.backColor = result.BackColor ? result.BackColor : calendar.backColor;
                calendar.eventHeaderVisible = result.EventHeaderVisible ? result.EventHeaderVisible : calendar.eventHeaderVisible;
                calendar.timeFormat = result.TimeFormat ? result.TimeFormat : calendar.timeFormat;
                calendar.locale = result.Locale ? result.Locale : calendar.locale;

                calendar._prepareColumns();
            }

            // hashes
            if (result.Hashes) {
                for (var key in result.Hashes) {
                    calendar.hashes[key] = result.Hashes[key];
                }
            }

            calendar.events.list = result.Events;
            calendar._loadEvents();
            calendar._updateHeaderHeight();

            if (result.UpdateType === "Full") {
                calendar._drawHeader();
                calendar._drawMain();
                calendar._drawHourTable();
                calendar._updateHeight();
            }

            calendar._show();

            calendar._drawEvents();
            calendar.clearSelection();

            calendar.afterRender(result.CallBackData, true);

            calendar.loadingStop();

        };

        this._durationHours = function() {
            return this._duration() / (3600 * 1000);
        };

        this._businessHoursSpan = function() {
                if (this.businessBeginsHour > this.businessEndsHour) {
                    return 24 - this.businessBeginsHour + this.businessEndsHour;
                }
                else {
                    return this.businessEndsHour - this.businessBeginsHour;
                }
        };

        this._rowCount = function() {
            return this._duration() / (60 * 60 * 1000 / 2);
        };

        // in ticks
        this._duration = function() {
            var dHours = 0;

            if (this.heightSpec === 'BusinessHoursNoScroll') {
                dHours = this._businessHoursSpan();
            }
            else {
                dHours = 24;
            }
            return dHours * 60 * 60 * 1000; // return ticks
        };

        this._visibleStart = function() {
            if (this.heightSpec === 'BusinessHoursNoScroll') {
                return this.businessBeginsHour;
            }
            return 0;
        };



        this._api2 = function() {
            return calendar.api === 2;
        };

        this.eventClickCallBack = function(e, data) {
            this._callBack2('EventClick', data, e);
        };

        this.eventClickPostBack = function(e, data) {
            this._postBack2('EventClick', data, e);
        };

        this._eventClickDispatch = function (ev) {
            var thisDiv = this;

            var e = thisDiv.event;

            if (calendar._api2()) {

                var args = {};
                args.e = e;
                args.originalEvent = ev;
                args.meta = ev.metaKey;
                args.ctrl = ev.ctrlKey;
                args.control = calendar;
                args.preventDefault = function() {
                    this.preventDefault.value = true;
                };

                if (typeof calendar.onEventClick === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onEventClick(args);
                    });
                    if (args.preventDefault.value) {
                        return;
                    }
                }

                switch (calendar.eventClickHandling) {
                    case 'CallBack':
                        calendar.eventClickCallBack(e);
                        break;
                    case 'PostBack':
                        calendar.eventClickPostBack(e);
                        break;
                    case 'ContextMenu':
                        var menu = e.client.contextMenu();
                        if (menu) {
                            menu.show(e);
                        }
                        else {
                            if (calendar.contextMenu) {
                                calendar.contextMenu.show(e);
                            }
                        }
                        break;
                }

                if (typeof calendar.onEventClicked === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onEventClicked(args);
                    });
                }
            }
            else {
                switch (calendar.eventClickHandling) {
                    case 'PostBack':
                        calendar.eventClickPostBack(e);
                        break;
                    case 'CallBack':
                        calendar.eventClickCallBack(e);
                        break;
                    case 'JavaScript':
                        calendar.onEventClick(e);
                        break;
                }
            }

        };

        this._eventRightClickDispatch = function(ev) {

            var e = this.event;

            if (ev.stopPropagation) {
                ev.stopPropagation();
            }

            if (!e.client.rightClickEnabled()) {
                return false;
            }

            var args = {};
            args.e = e;
            args.preventDefault = function() {
                this.preventDefault.value = true;
            };

            if (typeof calendar.onEventRightClick === 'function') {
                calendar.onEventRightClick(args);
                if (args.preventDefault.value) {
                    return false;
                }
            }

            switch (calendar.eventRightClickHandling) {
                case 'ContextMenu':
                    var menu = e.client.contextMenu();
                    if (menu) {
                        menu.show(e);
                    }
                    else {
                        if (calendar.contextMenu) {
                            calendar.contextMenu.show(this.event);
                        }
                    }
                    break;
            }

            if (typeof calendar.onEventRightClicked === 'function') {
                calendar.onEventRightClicked(args);
            }


            if (ev.preventDefault) {
                ev.preventDefault();
            }
            return false;
        };


        this.eventDeleteCallBack = function(e, data) {
            this._callBack2('EventDelete', data, e);
        };

        this.eventDeletePostBack = function(e, data) {
            this._postBack2('EventDelete', data, e);
        };

        this._eventDeleteDispatch = function (e) {
            if (calendar._api2()) {

                var args = {};
                args.e = e;
                args.control = calendar;
                args.preventDefault = function() {
                    this.preventDefault.value = true;
                };

                if (typeof calendar.onEventDelete === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onEventDelete(args);
                    });
                    if (args.preventDefault.value) {
                        return;
                    }
                }

                switch (calendar.eventDeleteHandling) {
                    case 'CallBack':
                        calendar.eventDeleteCallBack(e);
                        break;
                    case 'PostBack':
                        calendar.eventDeletePostBack(e);
                        break;
                    case 'Update':
                        calendar.events.remove(e);
                        break;
                }

                if (typeof calendar.onEventDeleted === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onEventDeleted(args);
                    });
                }
            }
            else {
                switch (calendar.eventDeleteHandling) {
                    case 'PostBack':
                        calendar.eventDeletePostBack(e);
                        break;
                    case 'CallBack':
                        calendar.eventDeleteCallBack(e);
                        break;
                    case 'JavaScript':
                        calendar.onEventDelete(e);
                        break;
                }
            }

        };

        this.eventResizeCallBack = function(e, newStart, newEnd, data) {
            if (!newStart)
                throw 'newStart is null';
            if (!newEnd)
                throw 'newEnd is null';

            var params = {};
            params.e = e;
            params.newStart = newStart;
            params.newEnd = newEnd;

            this._callBack2('EventResize', data, params);
        };

        this.eventResizePostBack = function(e, newStart, newEnd, data) {
            if (!newStart)
                throw 'newStart is null';
            if (!newEnd)
                throw 'newEnd is null';

            var params = {};
            params.e = e;
            params.newStart = newStart;
            params.newEnd = newEnd;

            this._postBack2('EventResize', data, params);
        };

        this._eventResizeDispatch = function (e, shadowHeight, shadowTop, border ) {
            var _startOffset = 1;

            var newStart = new Date();
            var newEnd = new Date();

            var start = e.start();
            var end = e.end();

            if (border === 'top') {
                var day = start.getDatePart();
                var step = Math.floor((shadowTop - _startOffset) / calendar.cellHeight);
                var minutes = step * 30;
                var ts = minutes * 60 * 1000;
                var visibleStartOffset = calendar._visibleStart() * 60 * 60 * 1000;

                newStart = day.addTime(ts + visibleStartOffset);
                newEnd = e.end();

            }
            else if (border === 'bottom') {
                var day = end.getDatePart();
                var step = Math.floor((shadowTop + shadowHeight - _startOffset) / calendar.cellHeight);
                var minutes = step * 30;
                var ts = minutes * 60 * 1000;
                var visibleStartOffset = calendar._visibleStart() * 60 * 60 * 1000;

                newStart = start;
                newEnd = day.addTime(ts + visibleStartOffset);
            }

            if (calendar._api2()) {
                // API v2
                var args = {};

                args.e = e;
                args.control = calendar;
                args.newStart = newStart;
                args.newEnd = newEnd;
                args.preventDefault = function() {
                    this.preventDefault.value = true;
                };

                if (typeof calendar.onEventResize === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onEventResize(args);
                    });
                    if (args.preventDefault.value) {
                        return;
                    }
                }

                switch (calendar.eventResizeHandling) {
                    case 'PostBack':
                        calendar.eventResizePostBack(e, newStart, newEnd);
                        break;
                    case 'CallBack':
                        calendar.eventResizeCallBack(e, newStart, newEnd);
                        break;
                    case 'Update':
                        e.start(newStart);
                        e.end(newEnd);
                        calendar.events.update(e);
                        break;
                }

                if (typeof calendar.onEventResized === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onEventResized(args);
                    });
                }
            }
            else {
                switch (calendar.eventResizeHandling) {
                    case 'PostBack':
                        calendar.eventResizePostBack(e, newStart, newEnd);
                        break;
                    case 'CallBack':
                        calendar.eventResizeCallBack(e, newStart, newEnd);
                        break;
                    case 'JavaScript':
                        calendar.onEventResize(e, newStart, newEnd);
                        break;
                }
            }
        };

        this.eventMovePostBack = function(e, newStart, newEnd, newResource, data) {
            if (!newStart)
                throw 'newStart is null';
            if (!newEnd)
                throw 'newEnd is null';

            var params = {};
            params.e = e;
            params.newStart = newStart;
            params.newEnd = newEnd;

            this._postBack2('EventMove', data, params);
        };

        this.eventMoveCallBack = function(e, newStart, newEnd, newResource, data) {
            if (!newStart)
                throw 'newStart is null';
            if (!newEnd)
                throw 'newEnd is null';

            var params = {};
            params.e = e;
            params.newStart = newStart;
            params.newEnd = newEnd;

            this._callBack2('EventMove', data, params);
        };

        this._eventMoveDispatch = function (e, newColumnIndex, shadowTop, ev) {
            var _startOffset = 1;
            var step = Math.floor((shadowTop - _startOffset) / calendar.cellHeight);

            var boxStart = step * 30 * 60 * 1000;
            var start = e.start();
            var end = e.end();
            var day = new Date();

            if (start instanceof DayPilot.Date) {
                start = start.toDate();
            }
            day.setTime(Date.UTC(start.getUTCFullYear(), start.getUTCMonth(), start.getUTCDate()));

            var startOffset = start.getTime() - (day.getTime() + start.getUTCHours() * 3600 *1000 + Math.floor(start.getUTCMinutes()/30)*30*60*1000 );
            var length = end.getTime() - start.getTime();

            var newColumn = this._columns[newColumnIndex];
            var newResource = newColumn.id;

            var date = newColumn.start.getTime();
            var newStartUTC = new Date();
            newStartUTC.setTime(date + boxStart + startOffset);

            var newStart = new DayPilot.Date(newStartUTC);

            var newEnd = newStart.addTime(length);


            if (calendar._api2()) {
                // API v2
                var args = {};

                args.e = e;
                args.newStart = newStart;
                args.newEnd = newEnd;
                args.newResource = newResource;
                args.ctrl = ev.ctrlKey;
                args.shift = ev.shiftKey;
                args.control = calendar;
                args.preventDefault = function() {
                    this.preventDefault.value = true;
                };

                if (typeof calendar.onEventMove === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onEventMove(args);
                    });
                    if (args.preventDefault.value) {
                        return;
                    }
                }

                switch (calendar.eventMoveHandling) {
                    case 'PostBack':
                        calendar.eventMovePostBack(e, newStart, newEnd, newColumn.id);
                        break;
                    case 'CallBack':
                        calendar.eventMoveCallBack(e, newStart, newEnd, newColumn.id);
                        break;
                    case 'Update':
                        e.start(newStart);
                        e.end(newEnd);
                        e.resource(newResource);
                        calendar.events.update(e);
                        break;
                }

                if (typeof calendar.onEventMoved === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onEventMoved(args);
                    });
                }
            }
            else {
                switch (calendar.eventMoveHandling) {
                    case 'PostBack':
                        calendar.eventMovePostBack(e, newStart, newEnd, newColumn.id);
                        break;
                    case 'CallBack':
                        calendar.eventMoveCallBack(e, newStart, newEnd, newColumn.id);
                        break;
                    case 'JavaScript':
                        calendar.onEventMove(e, newStart, newEnd, newColumn.id, false);
                        break;
                }
            }

        };

        this.timeRangeSelectedPostBack = function(start, end, resource, data) {

            var range = {};
            range.start = start;
            range.end = end;

            this._postBack2('TimeRangeSelected', data, range);
        };

        this.timeRangeSelectedCallBack = function(start, end, resource, data) {

            var range = {};
            range.start = start;
            range.end = end;

            this._callBack2('TimeRangeSelected', data, range);
        };

        this._timeRangeSelectedDispatch = function (start, end, resource) {

            // make sure it's DayPilot.Date
            start = new DayPilot.Date(start);
            end = new DayPilot.Date(end);

            if (this._api2()) {
                var args = {};
                args.start = start;
                args.end = end;
                args.resource = resource;
                args.control = calendar;
                args.preventDefault = function() {
                    this.preventDefault.value = true;
                };

                if (typeof calendar.onTimeRangeSelect === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onTimeRangeSelect(args);
                    });
                    if (args.preventDefault.value) {
                        return;
                    }
                }

                // now perform the default builtin action
                switch (calendar.timeRangeSelectedHandling) {
                    case 'PostBack':
                        calendar.timeRangeSelectedPostBack(start, end);
                        break;
                    case 'CallBack':
                        calendar.timeRangeSelectedCallBack(start, end);
                        break;
                }

                if (typeof calendar.onTimeRangeSelected === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onTimeRangeSelected(args);
                    });
                }
            }
            else {
                switch (calendar.timeRangeSelectedHandling) {
                    case 'PostBack':
                        calendar.timeRangeSelectedPostBack(start, end);
                        break;
                    case 'CallBack':
                        calendar.timeRangeSelectedCallBack(start, end);
                        break;
                    case 'JavaScript':
                        calendar.onTimeRangeSelected(start, end);
                        break;
                }
            }
        };

        this._onCellMousedown = function(ev) {

            if (DayPilotCalendar.selecting) {
                return;
            }

            if (calendar.timeRangeSelectedHandling === "Disabled") {
                return;
            }

            var button = ev.which;
            if (button !== 1 && button !== 0) {  // Khtml says first button is 0
                return;
            }

            DayPilotCalendar.firstMousePos = DayPilot.mc(ev);
            DayPilotCalendar.selecting = {};
            DayPilotCalendar.selecting.calendar = calendar;
            if (DayPilotCalendar.selectedCells) {
                calendar.clearSelection();
                DayPilotCalendar.selectedCells = [];
            }
            DayPilotCalendar.column = DayPilotCalendar.getColumn(this);
            DayPilotCalendar.selectedCells.push(this);
            DayPilotCalendar.firstSelected = this;

            DayPilotCalendar.topSelectedCell = this;
            DayPilotCalendar.bottomSelectedCell = this;

            calendar._activateSelection();

            return false;
        };

        this._activateSelection = function() {
            var selection = this.getSelection();

            (function activateSelectionNew() {

                var first = DayPilotCalendar.topSelectedCell;
                var last = DayPilotCalendar.bottomSelectedCell;

                // var columnIndex = first.parentNode.cells.indexOf(first);

                var columnIndex = (function() {
                    // it's the new div cell
                    if (first.data) {
                        return first.data.x;
                    }

                    var cells = first.parentNode.cells;
                    for (var i = 0; i < cells.length; i++) {
                        if (cells[i] === first) {
                            return i;
                        }
                    }
                    return -1;
                })();

                var col = calendar._columns[columnIndex];

                if (!col) {
                    return;
                }

                var colStart = col.start;

                var top = calendar.getPixels(first.start, colStart).boxTop;
                var bottom = calendar.getPixels(last.end, colStart).boxBottom;
                var height = bottom - top;

                var div = (function() {
                    if (calendar.nav.activeSelection) {
                        return calendar.nav.activeSelection;
                    }
                    var div = document.createElement("div");
                    div.setAttribute("unselectable", "on");
                    // div.style.zIndex = calendar._shadowZindex;
                    div.style.position = "absolute";
                    div.style.left = "0px";
                    div.style.width = "100%";

                    var inner = document.createElement("div");
                    inner.setAttribute("unselectable", "on");
                    inner.className = calendar._prefixCssClass("_shadow_inner");

                    div.appendChild(inner);

                    calendar.nav.events.rows[0].cells[columnIndex].selection.appendChild(div);
                    calendar.elements.selection.push(div);
                    calendar.nav.activeSelection = div;

                    return div;
                })();

                // reset
                div.className = calendar._prefixCssClass("_shadow");
                div.firstChild.innerHTML = "";

                // position
                div.style.top = top + "px";
                div.style.height = height + "px";

            })();
        };

        this._mousemove = function(ev) {

            if (typeof (DayPilotCalendar) === 'undefined') {
                return;
            }

            if (!DayPilotCalendar.selecting) {
                return;
            }

            var mousePos = DayPilot.mc(ev);

            var thisColumn = DayPilotCalendar.getColumn(this);
            if (thisColumn !== DayPilotCalendar.column) {
                return;
            }

            // clean
            calendar.clearSelection();

            // new selected cells
            if (mousePos.y < DayPilotCalendar.firstMousePos.y) {
                DayPilotCalendar.selectedCells = DayPilotCalendar.getCellsBelow(this);
                DayPilotCalendar.topSelectedCell = DayPilotCalendar.selectedCells[0];
                DayPilotCalendar.bottomSelectedCell = DayPilotCalendar.firstSelected;
            }
            else {
                DayPilotCalendar.selectedCells = DayPilotCalendar.getCellsAbove(this);
                DayPilotCalendar.topSelectedCell = DayPilotCalendar.firstSelected;
                DayPilotCalendar.bottomSelectedCell = DayPilotCalendar.selectedCells[0];
            }

            calendar._activateSelection();
        };

        this.getSelection = function() {
            var start = DayPilotCalendar.topSelectedCell.start;
            var end = DayPilotCalendar.bottomSelectedCell.end;
            var resource = DayPilotCalendar.topSelectedCell.resource;

            return new DayPilot.Selection(start, end, resource, calendar);
        };

        this._getColumnForPixels = function(x) {

            if (x < 0) {
                return null;
            }

            var i = 0;
            var cells = calendar.nav.events.rows[0].cells;

            for (var j = 0; j < cells.length; j++) {
                var cell = cells[j];
                var width = cell.offsetWidth;
                i += width;
                if (x < i) {
                    return j;
                }
            }
            return null;
        };

        this._table = {};
        this._table.getCellCoords = function() {
            var result = {};
            result.x = 0;
            result.y = 0;

            if (!calendar.coords) {
                return null;
            }

            result.x = calendar._getColumnForPixels(calendar.coords.x);

            var _startOffset = 0;
            var row = Math.floor((calendar.coords.y - _startOffset) / calendar.cellHeight);
            result.y = row;

            if (result.x < 0) {
                return null;
            }

            return result;
        };

        this.columns = {};
        this.columns.list = [];

        this.columns.load = function(url, success, error) {

            if (!url) {
                throw new DayPilot.Exception("columns.load(): 'url' parameter required");
            }

            var onError = function(args) {
                var largs = {};
                largs.exception = args.exception;
                largs.request = args.request;

                if (typeof error === 'function') {
                    error(largs);
                }
            };

            var onSuccess = function(args) {
                var r = args.request;
                var data;

                // it's supposed to be JSON
                try {
                    data = JSON.parse(r.responseText);
                }
                catch (e) {
                    var fargs = {};
                    fargs.exception = e;
                    onError(fargs);
                    return;
                }

                if (DayPilot.isArray(data)) {
                    var sargs = {};
                    sargs.preventDefault = function() {
                        this.preventDefault.value = true;
                    };
                    sargs.data = data;
                    if (typeof success === "function") {
                        success(sargs);
                    }

                    if (sargs.preventDefault.value) {
                        return;
                    }

                    calendar.columns.list = data;
                    if (calendar._initialized) {
                        calendar.update();
                    }
                }
            };

            var usePost = calendar.columnsLoadMethod && calendar.columnsLoadMethod.toUpperCase() === "POST";

            if (usePost) {
                DayPilot.ajax({
                    "method": "POST",
                    "url": url,
                    "success": onSuccess,
                    "error": onError
                });
            }
            else {
                DayPilot.ajax({
                    "method": "GET",
                    "url": url,
                    "success": onSuccess,
                    "error": onError
                });
            }
        };


        this._prepareColumns = function() {
            var columns;
            if (calendar.viewType !== "Resources") {
                columns = this._createDaysViewColumns();
            }
            else {
                columns = calendar.columns.list;
            }

            this._columns = [];
            for (var i = 0; i < columns.length; i++) {
                var c = this._activateColumn(columns[i]);
                this._columns.push(c);
            }
        };

        this._activateColumn = function(column) {

/*
            if (column.Start) {
                column.start = column.Start;
                column.html = column.InnerHTML;
                column.name = column.Name;
            }
*/
            var result = {};
            result.name = column.name;
            result.html = column.html;
            result.id = column.id;
            result.toolTip = column.toolTip;
            result.data = column;

            if (column.start) {
                result.start = new DayPilot.Date(column.start);
            }
            else {
                result.start = new DayPilot.Date(calendar.startDate);
            }

            result.putIntoBlock = function(ep) {

                for (var i = 0; i < this.blocks.length; i++) {
                    var block = this.blocks[i];
                    if (block.overlapsWith(ep.part.top, ep.part.height)) {
                        block.events.push(ep);
                        block.min = Math.min(block.min, ep.part.top);
                        block.max = Math.max(block.max, ep.part.top + ep.part.height);
                        return i;
                    }
                }

                // no suitable block found, create a new one
                var block = [];
                block.lines = [];
                block.events = [];

                block.overlapsWith = function(start, width) {
                    var end = start + width - 1;

                    if (!(end < this.min || start > this.max - 1)) {
                        return true;
                    }

                    return false;
                };
                block.putIntoLine = function (ep) {
                    var thisCol = this;

                    for (var i = 0; i < this.lines.length; i++) {
                        var line = this.lines[i];
                        if (line.isFree(ep.part.top, ep.part.height)) {
                            line.push(ep);
                            return i;
                        }
                    }

                    var line = [];
                    line.isFree = function(start, width) {
                        var end = start + width - 1;
                        var max = this.length;

                        for (var i = 0; i < max; i++) {
                            var e = this[i];
                            if (!(end < e.part.top || start > e.part.top + e.part.height - 1)) {
                                return false;
                            }
                        }

                        return true;
                    };

                    line.push(ep);

                    this.lines.push(line);

                    return this.lines.length - 1;

                };

                block.events.push(ep);
                block.min = ep.part.top;
                block.max = ep.part.top + ep.part.height;

                this.blocks.push(block);

                return this.blocks.length - 1;

            };

            result.putIntoLine = function(ep) {
                var thisCol = this;

                for (var i = 0; i < this.lines.length; i++) {
                    var line = this.lines[i];
                    if (line.isFree(ep.part.top, ep.part.height)) {
                        line.push(ep);
                        return i;
                    }
                }

                var line = [];
                line.isFree = function(start, width) {
                    var end = start + width - 1;
                    var max = this.length;

                    for (var i = 0; i < max; i++) {
                        var e = this[i];
                        if (!(end < e.part.top || start > e.part.top + e.part.height - 1)) {
                            return false;
                        }
                    }

                    return true;
                };

                line.push(ep);

                this.lines.push(line);

                return this.lines.length - 1;
            };

            return result;

        };

        this._createDaysViewColumns = function() {
            var columns = [];

            var start = this.startDate.getDatePart();

            var days = this.days;
            switch (this.viewType) {
                case "Day":
                    days = 1;
                    break;
                case "Week":
                    days = 7;
                    var weekStarts = resolved._weekStarts();
                    start = start.firstDayOfWeek(weekStarts);
                    break;
                case "WorkWeek":
                    days = 5;
                    start = start.firstDayOfWeek(1); // Monday
                    break;
            }

            if (this.heightSpec === 'BusinessHoursNoScroll') {
                start = start.addHours(this.businessBeginsHour);
            }

            for (var i = 0; i < days; i++) {

                var format = calendar.headerDateFormat ? calendar.headerDateFormat : resolved.locale().datePattern;

                var column = {};
                column.start = start.addDays(i);
                column.name = column.start.toString(format, resolved.locale());

                columns.push(column);
            }

            return columns;
        };

        this.visibleStart = function() {
            if (calendar.viewType === "Resources") {
                if (calendar._columns.length === 0) {
                    return DayPilot.Date.today();
                }
                var dates = calendar._columns.map(function(column) {
                    return column.start.getTime();
                });
                var min = Math.min.apply(null, dates);
                return new DayPilot.Date(min);
            }
            return this._columns[0].start;
        };

        this.visibleEnd = function() {
            if (calendar.viewType === "Resources") {
                if (calendar._columns.length === 0) {
                    return DayPilot.Date.today().addDays(1);
                }
                var dates = calendar._columns.map(function(column) {
                    return column.start.getTime();
                });
                var max = Math.max.apply(null, dates);
                return new DayPilot.Date(max).addDays(1);
            }
            var max = this._columns.length - 1;
            return this._columns[max].start.addDays(1);
        };


        this._prefixCssClass = function(part) {
            var prefix = this.theme || this.cssClassPrefix;
            if (prefix) {
                return prefix + part;
            }
            else {
                return "";
            }
        };

        this._deleteEvents = function() {

            if (this.elements.events) {

                for (var i = 0; i < this.elements.events.length; i++) {
                    var div = this.elements.events[i];

                    var object = div.event;
                    if (object) {
                        object.calendar = null;
                    }

                    div.onclick = null;
                    div.onclickSave = null;
                    div.onmouseover = null;
                    div.onmouseout = null;
                    div.onmousemove = null;
                    div.onmousedown = null;

                    if (div.firstChild && div.firstChild.firstChild && div.firstChild.firstChild.tagName && div.firstChild.firstChild.tagName.toUpperCase() === 'IMG') {
                        var img = div.firstChild.firstChild;
                        img.onmousedown = null;
                        img.onmousemove = null;
                        img.onclick = null;

                    }

                    div.helper = null;
                    div.data = null;
                    div.event = null;

                    DayPilot.de(div);
                }
            }
            this.elements.events = [];
        };

        this._drawEvent = function(e) {
            /*

            supported e.data properties:
            * text
            * html
            * cssClass
            * backColor
            * barColor
            * barBackColor
            * toolTip
            * barHidden
            * borderColor
            * fontColor

             */


            var data = e.cache || e.data;

            var main = this.nav.events;

            var rounded = true;
            var radius = true;
            var pixels = false;

            // var borderColor = this.eventBorderColor;

            var div = document.createElement("div");
            div.style.position = 'absolute';
            div.style.left = e.part.left + '%';
            div.style.top = (e.part.top) + 'px';
            div.style.width = e.part.width + '%';
            div.style.height = Math.max(e.part.height, 2) + 'px';
            div.style.overflow = 'hidden';

            // TODO unify
            div.data = e;
            div.event = e;

            div.unselectable = 'on';
            div.style.MozUserSelect = 'none';
            div.style.KhtmlUserSelect = 'none';

            div.className = this._prefixCssClass("_event");

            if (data.cssClass) {
                DayPilot.Util.addClass(div, data.cssClass);
            }

            if (calendar.showToolTip && e.client.toolTip()) {
                div.title = e.client.toolTip();
            }

            div.isFirst = e.part.start.getTime() === e.start().getTime();
            div.isLast = e.part.end.getTime() === e.end().getTime();

            div.onclick = this._eventClickDispatch;
            DayPilot.re(div, "contextmenu", this._eventRightClickDispatch);

            div.onmouseout = function(ev) {
                if (div.deleteIcon) {
                    div.deleteIcon.style.display = "none";
                }
            };

            div.onmousemove = function (ev) {
                // const
                var resizeMargin = 5;

                if (typeof(DayPilotCalendar) === 'undefined') {
                    return;
                }

                // position
                var offset = DayPilot.mo3(div, ev);
                if (!offset) {
                    return;
                }

                if (DayPilotCalendar.resizing || DayPilotCalendar.moving) {
                    return;
                }

                if (div.deleteIcon) {
                    div.deleteIcon.style.display = "";
                }

                var isLastPart = this.isLast;

                if (offset.y <= resizeMargin && e.client.resizeEnabled()) {
                    this.style.cursor = "n-resize";
                    this.dpBorder = 'top';
                }
                else if (this.offsetHeight - offset.y <= resizeMargin && e.client.resizeEnabled()) {
                    if (isLastPart) {
                        this.style.cursor = "s-resize";
                        this.dpBorder = 'bottom';
                    }
                    else {
                        this.style.cursor = 'not-allowed';
                    }
                }
                else if (!DayPilotCalendar.resizing && !DayPilotCalendar.moving) {
                    if (calendar.eventClickHandling !== 'Disabled') {
                        this.style.cursor = 'pointer';
                    }
                    else {
                        this.style.cursor = 'default';
                    }
                }

            };

            div.onmousedown = function (ev) {
                var button = ev.which || ev.button;

                if ((this.style.cursor === 'n-resize' || this.style.cursor === 's-resize') && button === 1) {
                    // set
                    DayPilotCalendar.resizing = this;
                    DayPilot.Global.resizing = this;
                    DayPilotCalendar.originalMouse = DayPilot.mc(ev);
                    DayPilotCalendar.originalHeight = this.offsetHeight;
                    DayPilotCalendar.originalTop = this.offsetTop;

                    calendar.nav.top.style.cursor = this.style.cursor;

                }
                else if (button === 1 && e.client.moveEnabled()) {
                    DayPilotCalendar.moving = this;
                    DayPilot.Global.moving = this;
                    DayPilotCalendar.moving.event = this.event;
                    var helper = DayPilotCalendar.moving.helper = {};
                    helper.oldColumn = calendar._columns[this.data.part.dayIndex].id;
                    DayPilotCalendar.originalMouse = DayPilot.mc(ev);
                    DayPilotCalendar.originalTop = this.offsetTop;

                    var offset = DayPilot.mo3(this, ev);
                    if (offset) {
                        DayPilotCalendar.moveOffsetY = offset.y;
                    }
                    else {
                        DayPilotCalendar.moveOffsetY = 0;
                    }

                    // cursor
                    //document.body.style.cursor = 'move';
                    calendar.nav.top.style.cursor = 'move';
                }

                return false;
            };

            var inner = document.createElement("div");
            inner.setAttribute("unselectable", "on");
            inner.className = calendar._prefixCssClass("_event_inner");
            inner.innerHTML = e.client.html();

            if (data.borderColor === "darker" && data.backColor) {
                inner.style.borderColor = DayPilot.ColorUtil.darker(data.backColor, 2);
            }
            else {
                inner.style.borderColor = data.borderColor;
            }

            if (data.backColor) {
                inner.style.background = data.backColor;
            }

            if (data.fontColor) {
                inner.style.color = data.fontColor;
            }

            div.appendChild(inner);

            // TODO
            if (e.client.barVisible()) {
                var height = e.part.height - 2;
                var barTop =  100 * e.part.barTop / height; // %
                var barHeight = Math.ceil(100 * e.part.barHeight / height); // %

                var bar = document.createElement("div");
                bar.setAttribute("unselectable", "on");
                bar.className = this._prefixCssClass("_event_bar");
                bar.style.position = "absolute";

                if (data.barBackColor) {
                    bar.style.backgroundColor = data.barBackColor;
                }

                var barInner = document.createElement("div");
                barInner.setAttribute("unselectable", "on");
                barInner.className = this._prefixCssClass("_event_bar_inner");
                barInner.style.top = barTop + "%";
                if (0 < barHeight && barHeight <= 1) {
                    barInner.style.height = "1px";
                }
                else {
                    barInner.style.height = barHeight + "%";
                }

                if (data.barColor) {
                    barInner.style.backgroundColor = data.barColor;
                }

                bar.appendChild(barInner);
                div.appendChild(bar);
            }

            if (e.client.deleteEnabled()) {
                var del = document.createElement("div");
                del.style.position = "absolute";
                del.style.right = "2px";
                del.style.top = "2px";
                del.style.width = "17px";
                del.style.height = "17px";
                del.className = calendar._prefixCssClass("_event_delete");
                del.onmousedown = function(ev) {
                    ev.stopPropagation();
                };
                del.onclick = function(ev) {
                    ev.stopPropagation();
                    var e = this.parentNode.event;
                    if (e) {
                        calendar._eventDeleteDispatch(e);
                    }
                };
                del.style.display = "none";
                div.deleteIcon = del;
                div.appendChild(del);
            }

            // areas
            var areas = data.areas ? DayPilot.Areas.copy(data.areas) : [];

/*            var col = calendar._columnsBottom[e.part.dayIndex];

            areas.forEach(function(area) {
                if (area.start) {
                    area.top = calendar._getPixels(new DayPilot.Date(area.start), col.start).top - e.part.top - calendar._autoHiddenPixels();
                }
                if (area.end) {
                    area.bottom = e.part.top + e.part.height - calendar._getPixels(new DayPilot.Date(area.end), col.start).top - calendar._autoHiddenPixels();
                }
            });

            if (e.client.deleteEnabled()) {
                areas.push({"action":"JavaScript","v":"Hover","w":17,"h":17,"top":2,"right":2, "css": calendar._prefixCssClass("_event_delete"),"js":function(e) { calendar._eventDeleteDispatch(e); } });
            }*/

            DayPilot.Areas.attach(div, e, {"areas": areas});

            if (main.rows[0].cells[e.part.dayIndex]) { // temporary fix for multirow header, but won't hurt later
                var wrapper = main.rows[0].cells[e.part.dayIndex].firstChild;
                wrapper.appendChild(div);

                calendar._makeChildrenUnselectable(div);

                //var e = new DayPilotCalendar.Event(div, calendar);
            }

            if (typeof calendar.onAfterEventRender === 'function') {
                var args = {};
                args.e = div.event;
                args.div = div;

                calendar.onAfterEventRender(args);
            }

            calendar.elements.events.push(div);
        };

        this._makeChildrenUnselectable = function(el) {
            var c = (el && el.childNodes) ? el.childNodes.length : 0;
            for (var i = 0; i < c; i++) {
                try {
                    var child = el.childNodes[i];
                    if (child.nodeType === 1) {
                        child.unselectable = 'on';
                        this._makeChildrenUnselectable(child);
                    }
                }
                catch (e) {
                }
            }
        };

        this._drawEvents = function() {

            //var start = new Date();

            for (var i = 0; i < this._columns.length; i++) {
                var col = this._columns[i];
                if (!col.blocks) {
                    continue;
                }

                for (var m = 0; m < col.blocks.length; m++) {
                    var block = col.blocks[m];
                    for (var j = 0; j < block.lines.length; j++) {
                        var line = block.lines[j];

                        for(var k = 0; k < line.length; k++) {
                            var e = line[k];

                            e.part.width = 100 / block.lines.length;
                            e.part.left = e.part.width * j;

                            var isLastBlock = (j === block.lines.length - 1);
                            if (!isLastBlock) {
                                e.part.width = e.part.width * 1.5;
                            }

                            this._drawEvent(e);
                        }
                    }
                }
            }

            //var end = new Date();
            //var diff = end.getTime() - start.getTime();
        };

        this._drawTop = function() {

            //this.nav.top = document.getElementById(this.id);
            this.nav.top.innerHTML = '';

            DayPilot.Util.addClass(this.nav.top, this._prefixCssClass("_main"));

            this.nav.top.style.MozUserSelect = 'none';
            this.nav.top.style.KhtmlUserSelect = 'none';
            this.nav.top.style.position = 'relative';
            this.nav.top.style.width = this.width ? this.width : '100%';

            if (this.hideUntilInit) {
                this.nav.top.style.visibility = 'hidden';
            }

            if (!this.visible) {
                this.nav.top.style.display = "none";
            }

            this.nav.scroll = document.createElement("div");
            this.nav.scroll.style.height = this._getScrollableHeight() + "px";

            if (this.heightSpec === 'BusinessHours') {
                this.nav.scroll.style.overflow = "auto";
            }
            else
            {
                this.nav.scroll.style.overflow = "hidden";
            }

            this.nav.scroll.style.position = "relative";

            var header = this._drawTopHeaderDiv();
            this.nav.top.appendChild(header);

            // fixing the column alignment bug
            // solved thanks to http://stackoverflow.com/questions/139000/div-with-overflowauto-and-a-100-wide-table-problem
            this.nav.scroll.style.zoom = 1;

            var wrap = this._drawScrollable();
            this.nav.scrollable = wrap.firstChild;
            this.nav.scroll.appendChild(wrap);
            this.nav.top.appendChild(this.nav.scroll);

            this.nav.scrollLayer = document.createElement("div");
            this.nav.scrollLayer.style.position = 'absolute';
            this.nav.scrollLayer.style.top = '0px';
            this.nav.scrollLayer.style.left = '0px';
            this.nav.top.appendChild(this.nav.scrollLayer);

            this.nav.loading = document.createElement("div");
            this.nav.loading.style.position = 'absolute';
            this.nav.loading.style.top = '0px';
            this.nav.loading.style.left = (this.hourWidth + 5) + "px";
            // this.nav.loading.style.backgroundColor = this.loadingLabelBackColor;
            // this.nav.loading.style.fontSize = this.loadingLabelFontSize;
            // this.nav.loading.style.fontFamily = this.loadingLabelFontFamily;
            // this.nav.loading.style.color = this.loadingLabelFontColor;
            // this.nav.loading.style.padding = '2px';
            this.nav.loading.innerHTML = calendar._xssTextHtml(calendar.loadingLabelText, calendar.loadingLabelHtml);
            this.nav.loading.style.display = 'none';

            this.nav.top.appendChild(this.nav.loading);

        };

        // used during full update
        this._drawHourTable = function() {
            // clear old hour table
            if (!this.fasterDispose) DayPilot.pu(this.nav.hourTable);
            this.nav.scrollable.rows[0].cells[0].innerHTML = '';
            this.nav.hourTable = this._createHourTable();
            this.nav.scrollable.rows[0].cells[0].appendChild(this.nav.hourTable);
        };

        // used during initial load only
        this._drawScrollable = function() {
            var zoom = document.createElement("div");
            zoom.style.zoom = 1;
            zoom.style.position = 'relative';
            // zoom.onmousemove = calendar._mousemove;

            var table = document.createElement("table");

            table.cellSpacing = "0";
            table.cellPadding = "0";
            table.border = "0";
            table.style.border = "0px none";
            table.style.width = "100%";
            table.style.position = 'absolute';

            var r = table.insertRow(-1);

            var c;
            c = r.insertCell(-1);
            c.valign = "top";
            c.style.padding = '0px';
            c.style.border = '0px none';

            this.nav.hourTable = this._createHourTable();
            c.appendChild(this.nav.hourTable);

            c = r.insertCell(-1);
            c.valign = "top";
            c.width = "100%";
            c.style.padding = '0px';
            c.style.border = '0px none';

            var wrap = document.createElement("div");
            wrap.style.position = "relative";
            c.appendChild(wrap);

            wrap.appendChild(this._createEventsAndCells());
            wrap.appendChild(this._createEventsTable());

            zoom.appendChild(table);

            this.nav.zoom = zoom;

            return zoom;
        };

        this._createEventsAndCells = function() {
            var table = document.createElement("table");

            table.cellPadding = "0";
            table.cellSpacing = "0";
            table.border = "0";
            table.style.width = "100%";
            table.style.border = "0px none";
            table.style.tableLayout = 'fixed';

            this.nav.main = table;
            this.nav.events = table;

            return table;
        };

        this._createEventsTable = function() {
            var table = document.createElement("table");

            //table.style.position = "absolute";
            table.style.top = "0px";
            table.cellPadding = "0";
            table.cellSpacing = "0";
            table.border = "0";
            table.style.position = "absolute";
            table.style.width = "100%";
            table.style.border = "0px none";
            table.style.tableLayout = 'fixed';
            //table.setAttribute("events", "true");

            this.nav.events = table;
            var create = true;
            var columns = this._columns;
            var cl = columns.length;

            var r = (create) ? table.insertRow(-1) : table.rows[0];

            for (var j = 0; j < cl; j++) {
                var c = (create) ? r.insertCell(-1) : r.cells[j];

                if (create) {

                    c.style.padding = '0px';
                    c.style.border = '0px none';
                    c.style.height = '0px';
                    c.style.overflow = 'visible';
                    if (!calendar.rtl) {
                        c.style.textAlign = 'left';
                    }

                    // withpct
                    //c.style.width = (100.0 / columns.length) + "%";

                    var div = document.createElement("div");
                    div.style.marginRight = calendar.columnMarginRight + "px";
                    div.style.position = 'relative';
                    div.style.height = '1px';
                    div.style.marginTop = '-1px';

                    var selection = document.createElement("div");
                    c.selection = selection;

                    c.appendChild(div);
                    c.appendChild(selection);

                }
            }

            return table;
        };

        this._createHourTable = function() {
            var table = document.createElement("table");
            table.cellSpacing = "0";
            table.cellPadding = "0";
            table.border = "0";
            table.style.border = '0px none';
            table.style.width = this.hourWidth + "px";
            table.oncontextmenu = function() { return false; };

            var hours = calendar._durationHours();
            for (var i = 0; i < hours; i++) {
                this._createHourRow(table, i);
            }

            return table;

        };

        this._createHourRow = function(table, i) {
            var height = (this.cellHeight * 2);

            var r = table.insertRow(-1);
            r.style.height = height + "px";

            var c = r.insertCell(-1);
            c.valign = "bottom";
            c.unselectable = "on";
            c.style.cursor = "default";
            c.style.padding = '0px';
            c.style.border = '0px none';

            var frame = document.createElement("div");
            frame.style.position = "relative";
            frame.className = this._prefixCssClass("_rowheader");
            frame.style.width = this.hourWidth + "px";
            frame.style.height = (height) + "px";
            frame.style.overflow = 'hidden';
            frame.unselectable = 'on';

            var block = document.createElement("div");
            block.className = this._prefixCssClass("_rowheader_inner");
            block.unselectable = "on";

            var text = document.createElement("div");
            text.unselectable = "on";

            var start = this.startDate.addHours(i).addHours(calendar._visibleStart());
            var hour = start.getHours();

            var am = hour < 12;
            var timeFormat = resolved.timeFormat();
            if (timeFormat === "Clock12Hours") {
                hour = hour % 12;
                if (hour === 0) {
                    hour = 12;
                }
            }

            text.innerHTML = hour;

            var span = document.createElement("span");
            span.unselectable = "on";
            span.className = this._prefixCssClass("_rowheader_minutes");

            var sup;
            if (timeFormat === "Clock12Hours") {
                if (am) {
                    sup = "AM";
                }
                else {
                    sup = "PM";
                }
            }
            else {
                sup = "00";
            }

            span.innerHTML = sup;

            text.appendChild(span);

            block.appendChild(text);

            frame.appendChild(block);

            c.appendChild(frame);
        };

        this._getScrollableHeight = function() {
            switch (this.heightSpec) {
                case "Full":
                    return (24 * 2 * this.cellHeight);
                case "BusinessHours":
                    var dHours = this._businessHoursSpan();
                    return dHours * this.cellHeight * 2;
                case "BusinessHoursNoScroll":
                    var dHours = this._businessHoursSpan();
                    return dHours * this.cellHeight * 2;
                default:
                    throw "DayPilot.Calendar: Unexpected 'heightSpec' value.";

            }
        };

        this._updateCorner = function() {
            var parent = calendar.nav.corner ? calendar.nav.corner.parentNode : null;
            if (!parent) {
                return;
            }

            parent.innerHTML = '';

            var corner = this._drawCorner();
            parent.appendChild(corner);
            calendar.nav.corner = corner;

        };

        this._drawTopHeaderDiv = function() {
            var header = document.createElement("div");
            header.style.overflow = "auto";

            var table = document.createElement("table");
            table.cellPadding = "0";
            table.cellSpacing = "0";
            table.border = "0";
            table.style.width = "100%";
            table.style.borderCollapse = 'separate';
            table.style.border = "0px none";

            var r = table.insertRow(-1);

            // corner
            var c = r.insertCell(-1);
            c.style.padding = '0px';
            c.style.border = '0px none';

            var corner = this._drawCorner();
            c.appendChild(corner);
            this.nav.corner = corner;

            // top header
            c = r.insertCell(-1);

            c.style.width = "100%";
            c.valign = "top";
            c.style.position = 'relative';  // ref point
            c.style.padding = '0px';
            c.style.border = '0px none';

            this.nav.header = document.createElement("table");
            this.nav.header.cellPadding = "0";
            this.nav.header.cellSpacing = "0";
            this.nav.header.border = "0";
            this.nav.header.width = "100%";
            this.nav.header.style.tableLayout = "fixed";
            this.nav.header.oncontextmenu = function() { return false; };

            var scrollbar = this.nav.scroll.style.overflow !== 'hidden';
            c.appendChild(this.nav.header);

            if (scrollbar) {
                c = r.insertCell(-1);
                c.unselectable = "on";

                var inside = document.createElement("div");
                inside.unselectable = "on";
                inside.style.position = "relative";
                inside.style.width = "16px";
                inside.style.height = this.headerHeight + "px";
                inside.className = this._prefixCssClass("_cornerright");

                var inner = document.createElement("div");
                inner.className = this._prefixCssClass('_cornerright_inner');
                inside.appendChild(inner);

                c.appendChild(inside);

                this.nav.cornerRight = inside;
            }

            header.appendChild(table);

            return header;

        };

        this._drawCorner = function() {
            var wrap = document.createElement("div");
            wrap.style.position = 'relative';
            wrap.className = this._prefixCssClass("_corner");
            wrap.style.width = this.hourWidth + "px";
            wrap.style.height = this.headerHeight + "px";
            wrap.oncontextmenu = function() { return false; };

            var corner = document.createElement("div");
            corner.unselectable = "on";
            corner.className = this._prefixCssClass("_corner_inner");

            wrap.appendChild(corner);

            return wrap;
        };

        this._disposeMain = function()  {
            var table = this.nav.main;
            table.root = null;
            table.onmouseup = null;

            for (var y = 0; y < table.rows.length; y++) {
                var r = table.rows[y];
                for (var x = 0; x < r.cells.length; x++) {
                    var c = r.cells[x];
                    c.root = null;

                    c.onmousedown = null;
                    c.onmousemove = null;
                    c.onmouseout = null;
                    c.onmouseup = null;
                }
            }

            if (!this.fasterDispose) DayPilot.pu(table);
        };

        // draw time cells
        this._drawMain = function() {

            //DayPilotCalendar.selectedCells = [];
            var cols = [];
            var dates = [];

            var table = this.nav.main;
            var step = 30 * 60 * 1000;
            var rowCount = this._rowCount();

            var columns = calendar._columns;
            //var create = !this.tableCreated || columns.length !== table.rows[0].cells.length || rowCount !== table.rows.length; // redraw only if number of columns changes
            var create = true;

            if (table) {
                this._disposeMain();
            }

            while (table && table.rows && table.rows.length > 0 && create) {
                if (!this.fasterDispose) {
                    DayPilot.pu(table.rows[0]);
                }
                table.deleteRow(0);
            }

            this.tableCreated = true;

            var cl = columns.length;

            var events = this.nav.events;
            while (events && events.rows && events.rows.length > 0 && create) {
                if (!this.fasterDispose) {
                    DayPilot.pu(events.rows[0]);
                }
                events.deleteRow(0);
            }

            var cl = columns.length;

            var r = (create) ? events.insertRow(-1) : events.rows[0];

            for (var j = 0; j < cl; j++) {
                var c = (create) ? r.insertCell(-1) : r.cells[j];

                if (create) {

                    c.style.padding = '0px';
                    c.style.border = '0px none';
                    c.style.height = '0px';
                    c.style.overflow = 'visible';
                    if (!calendar.rtl) {
                        c.style.textAlign = 'left';
                    }

                    // withpct
                    //c.style.width = (100.0 / columns.length) + "%";

                    var div = document.createElement("div");
                    div.style.marginRight = calendar.columnMarginRight + "px";
                    div.style.position = 'relative';
                    div.style.height = '1px';
                    div.style.marginTop = '-1px';

                    var selection = document.createElement("div");
                    selection.style.position = "relative";
                    c.selection = selection;

                    c.appendChild(div);
                    c.appendChild(selection);

                }
            }

            for (var i = 0; i < rowCount; i++) {
                var r = (create) ? table.insertRow(-1) : table.rows[i];

                if (create) {
                    r.style.MozUserSelect = 'none';
                    r.style.KhtmlUserSelect = 'none';
                }

                for (var j = 0; j < cl; j++) {
                    var col = this._columns[j];

                    var c = (create) ? r.insertCell(-1) : r.cells[j];

                    // always update
                    c.start = col.start.addTime(i * step);
                    c.end = c.start.addTime(step);
                    c.resource = col.id;

                    c.onmousedown = this._onCellMousedown;
                    // c.onmousemove = this._mousemove;
                    c.onmouseup = function() {
                        return false;
                    };

                    c.onclick = function() {
                        return false;
                    };

                    if (create) {
                        c.root = this;

                        c.style.padding = '0px';
                        c.style.border = '0px none';
                        c.style.verticalAlign = 'top';
                        c.style.height = calendar.cellHeight + 'px';
                        c.style.overflow = 'hidden';
                        c.unselectable = 'on';

                        var div = document.createElement("div");
                        div.unselectable = 'on';
                        div.style.height = calendar.cellHeight + "px";
                        div.style.position = "relative";
                        div.className = this._prefixCssClass("_cell");

                        var business = this._isBusinessCell(c.start, c.end);

                        var properties = {
                            "business": business,
                            "text": null,
                            "html": null,
                            "cssClass": null,
                            "backColor": null,
                            "backImage": null,
                            "backRepeat": null,
                        };

                        (function() {
                            if (typeof calendar.onBeforeCellRender === 'function') {
                                var args = {};
                                args.cell = {
                                    "start": c.start,
                                    "end": c.end,
                                    "resource": c.resource,
                                    "properties": properties
                                };
                                calendar.onBeforeCellRender(args);
                            }
                        })();


                        if (properties.business) {
                            DayPilot.Util.addClass(div, calendar._prefixCssClass("_cell_business"));
                        }

                        if (properties.cssClass) {
                            DayPilot.Util.addClass(div, properties.cssClass);
                        }

                        var inner = document.createElement("div");
                        inner.setAttribute("unselectable", "on");
                        inner.className = this._prefixCssClass("_cell_inner");

                        var html = DayPilot.Util.escapeTextHtml(properties.text, properties.html);
                        if (html) {
                            inner.innerHTML = html;
                        }

                        if (properties.backColor) {
                            inner.style.backgroundColor = properties.backColor;
                        }

                        if (properties.backImage) {
                            inner.style.backgroundImage = "url(" + properties.backImage + ")";
                        }

                        if (properties.backRepeat) {
                            inner.style.backgroundRepeat = properties.backRepeat;
                        }

                        div.appendChild(inner);
                        c.appendChild(div);

                        c.appendChild(div);

                    }
                }
            }

            table.root = this;

            calendar.nav.scrollable.onmousemove = function(ev) {
                var ref = calendar.nav.scrollable;
                calendar.coords = DayPilot.mo3(ref, ev);

                var mousePos = DayPilot.mc(ev);

                if (DayPilotCalendar.resizing) {
                    if (!DayPilotCalendar.resizingShadow) {
                        DayPilotCalendar.resizingShadow = calendar._createShadow(DayPilotCalendar.resizing, false, calendar.shadow);
                    }

                    var _step = calendar.cellHeight;
                    var _startOffset = 1;
                    var delta = (mousePos.y - DayPilotCalendar.originalMouse.y);

                    // TODO: clear
                    if (DayPilotCalendar.resizing.dpBorder === 'bottom') {
                        var newHeight = Math.floor(((DayPilotCalendar.originalHeight + DayPilotCalendar.originalTop + delta) + _step / 2) / _step) * _step - DayPilotCalendar.originalTop + _startOffset;

                        if (newHeight < _step)
                            newHeight = _step;

                        var max = calendar.nav.main.clientHeight;
                        if (DayPilotCalendar.originalTop + newHeight > max)
                            newHeight = max - DayPilotCalendar.originalTop;

                        // DayPilotCalendar.resizingShadow.style.height = (newHeight - 4) + 'px';
                        DayPilotCalendar.resizingShadow.style.height = (newHeight) + 'px';
                    }
                    else if (DayPilotCalendar.resizing.dpBorder === 'top') {
                        var newTop = Math.floor(((DayPilotCalendar.originalTop + delta - _startOffset) + _step / 2) / _step) * _step + _startOffset;

                        if (newTop < _startOffset) {
                            newTop = _startOffset;
                        }

                        if (newTop > DayPilotCalendar.originalTop + DayPilotCalendar.originalHeight - _step) {
                            newTop = DayPilotCalendar.originalTop + DayPilotCalendar.originalHeight - _step;
                        }

                        // var newHeight = DayPilotCalendar.originalHeight - (newTop - DayPilotCalendar.originalTop) - 4;
                        var newHeight = DayPilotCalendar.originalHeight - (newTop - DayPilotCalendar.originalTop);

                        if (newHeight < _step) {
                            newHeight = _step;
                        }
                        else {
                            DayPilotCalendar.resizingShadow.style.top = newTop + 'px';
                        }

                        DayPilotCalendar.resizingShadow.style.height = (newHeight) + 'px';
                    }
                }
                else if (DayPilotCalendar.moving) {

                    if (!calendar.coords) {
                        return;
                    }

                    if (!DayPilotCalendar.movingShadow) {

                        var minDistance = 3;
                        var mousePos = DayPilot.mc(ev);
                        var distance = Math.abs(mousePos.x - DayPilotCalendar.originalMouse.x) + Math.abs(mousePos.y - DayPilotCalendar.originalMouse.y);
                        if (distance <= minDistance) {
                            return;
                        }
                        // fixes the ie8 bug (incorrect offsetX and offsetY causes flickering during move if there are inline elements in the event
                        DayPilotCalendar.movingShadow = calendar._createShadow(DayPilotCalendar.moving, true, calendar.shadow);
                        DayPilotCalendar.movingShadow.style.width = (DayPilotCalendar.movingShadow.parentNode.offsetWidth + 1) + 'px';
                    }

                    var _step = calendar.cellHeight;
                    var _startOffset = 1;

                    var offset = DayPilotCalendar.moveOffsetY;
                    if (!offset) {
                        offset = _step / 2; // for external drag
                    }

                    var newTop = Math.floor(((calendar.coords.y - offset - _startOffset) + _step / 2) / _step) * _step + _startOffset;

                    if (newTop < _startOffset) {
                        newTop = _startOffset;
                    }

                    var main = calendar.nav.events;
                    var max = calendar.nav.main.clientHeight + _startOffset;

                    var height = parseInt(DayPilotCalendar.movingShadow.style.height);  // DayPilotCalendar.moving.data.height
                    if (newTop + height > max) {
                        newTop = max - height;
                    }

                    DayPilot.Util.addClass(DayPilotCalendar.moving, calendar._prefixCssClass("_event_moving_source"));

                    DayPilotCalendar.movingShadow.parentNode.style.display = 'none';
                    DayPilotCalendar.movingShadow.style.top = newTop + 'px';
                    DayPilotCalendar.movingShadow.parentNode.style.display = '';

                    var colWidth = main.clientWidth / main.rows[0].cells.length;
                    var column = Math.floor((calendar.coords.x - 45) / colWidth);

                    if (column < 0) {
                        column = 0;
                    }

                    if (column < main.rows[0].cells.length && column >= 0 && DayPilotCalendar.movingShadow.column !== column) {
                        DayPilotCalendar.movingShadow.column = column;
                        DayPilotCalendar.moveShadow(main.rows[0].cells[column]);
                    }
                }
                else if (DayPilotCalendar.selecting) {

                    var mousePos = DayPilot.mc(ev);

                    var cellcoords = calendar._table.getCellCoords();
                    var x = DayPilotCalendar.column;
                    var cell = calendar.nav.main.rows[cellcoords.y].cells[x];


                    // clean
                    // calendar.clearSelection();

                    // new selected cells
                    if (mousePos.y < DayPilotCalendar.firstMousePos.y) {
                        DayPilotCalendar.selectedCells = DayPilotCalendar.getCellsBelow(cell);
                        DayPilotCalendar.topSelectedCell = DayPilotCalendar.selectedCells[0];
                        DayPilotCalendar.bottomSelectedCell = DayPilotCalendar.firstSelected;
                    }
                    else {
                        DayPilotCalendar.selectedCells = DayPilotCalendar.getCellsAbove(cell);
                        DayPilotCalendar.topSelectedCell = DayPilotCalendar.firstSelected;
                        DayPilotCalendar.bottomSelectedCell = DayPilotCalendar.selectedCells[0];
                    }

                    calendar._activateSelection();

                }
            };
            calendar.nav.scrollable.style.display = '';
        };

        this._isBusinessCell = function(start, end) {
            if (this.businessBeginsHour < this.businessEndsHour)
            {
                return !(start.getHours() < this.businessBeginsHour || start.getHours() >= this.businessEndsHour || start.getDayOfWeek() === 6 || start.getDayOfWeek() === 0);
            }

            if (start.getHours() >= this.businessBeginsHour)
            {
                return true;
            }

            if (start.getHours() < this.businessEndsHour)
            {
                return true;
            }

            return false;
        };

        this._disposeHeader = function() {
            var table = this.nav.header;
            if (table && table.rows) {
                for(var y = 0; y < table.rows.length; y++) {
                    var r = table.rows[y];
                    for (var x = 0; x < r.cells.length; x++) {
                        var c = r.cells[x];
                        c.onclick = null;
                        c.onmousemove = null;
                        c.onmouseout = null;
                    }
                }
            }
            if (!this.fasterDispose) DayPilot.pu(table);
        };

        this._drawHeaderRow = function(create) {

            // column headers
            var r = (create) ? this.nav.header.insertRow(-1) : this.nav.header.rows[0];

            var columns = this._columns;

            var len = columns.length;

            function drawHeaderCell(i) {
                var data = columns[i];

                var cell = (create) ? r.insertCell(-1) : r.cells[i];
                cell.data = data;

                cell.style.overflow = 'hidden';
                cell.style.padding = '0px';
                cell.style.border = '0px none';
                cell.style.height = (calendar.headerHeight) + "px";

                cell.onclick = calendar._headerClickDispatch;

                var div = (create) ? document.createElement("div") : cell.firstChild;
                var inner;

                if (create) {
                    div.unselectable = 'on';
                    div.style.MozUserSelect = 'none';
                    div.style.cursor = 'default';
                    div.style.position = 'relative';
                    div.className = calendar._prefixCssClass('_colheader');
                    div.style.height = calendar.headerHeight + "px";

                    if (!calendar.headerTextWrappingEnabled) {
                        div.style.whiteSpace = 'nowrap';
                    }

                    inner = document.createElement("div");
                    inner.className = calendar._prefixCssClass('_colheader_inner');
                    inner.unselectable = 'on';

                    div.appendChild(inner);
                    cell.appendChild(div);
                }
                else {
                    inner = div.firstChild;
                }

                var args = {};
                args.header = {};
                args.header.cssClass = null;
                args.header.verticalAlignment = "center";
                args.column = calendar._createColumn(data, calendar);

                if (typeof calendar.onBeforeHeaderRender === 'function') {
                    DayPilot.Util.copyProps(data, args.header, ['id', 'start', 'name', 'html', 'backColor', 'toolTip', 'areas']);
                    calendar.onBeforeHeaderRender(args);
                    DayPilot.Util.copyProps(args.header, data, ['html', 'backColor', 'toolTip', 'areas', 'cssClass', 'verticalAlignment']);
                }

                if (data.toolTip) {
                    inner.title = data.toolTip;
                }

                if (data.cssClass) {
                    DayPilot.Util.addClass(div, data.cssClass);
                }

                if (data.backColor) {
                    inner.style.background = data.backColor;
                }

                if (data.areas) {
                    DayPilot.Areas.attach(div, data);
                }

                var va = data.verticalAlignment;
                if (va) {
                    inner.style.display = "flex";
                    switch (va) {
                        case "center":
                            inner.style.alignItems = "center";
                            break;
                        case "top":
                            inner.style.alignItems = "flex-start";
                            break;
                        case "bottom":
                            inner.style.alignItems = "flex-end";
                            break;
                    }
                }

                var text = div.firstChild;
                text.innerHTML = calendar._xssTextHtml(data.name, data.html);
            }

            for (var i = 0; i < len; i++) {
                drawHeaderCell(i);
            }
        };

        this._headerClickDispatch = function(ev) {

            var handling = calendar.headerClickHandling;

            if (handling === "Disabled") {
                return;
            }

            var data = this.data;
            var c = calendar._createColumn(data);

            var args = {};
            args.header = {};
            args.header.id = data.id;
            args.header.name = data.name;
            args.header.start = data.start;
            args.column = c;
            args.originalEvent = ev;
            args.shift = ev.shiftKey;
            args.ctrl = ev.ctrlKey;
            args.meta = ev.metaKey;

            args.preventDefault = function() {
                this.preventDefault.value = true;
            };

            if (typeof calendar.onHeaderClick === 'function') {
                calendar.onHeaderClick(args);
                if (args.preventDefault.value) {
                    return;
                }
            }

            if (typeof calendar.onHeaderClicked === 'function') {
                calendar.onHeaderClicked(args);
            }

        };

        this._createColumn = function(data) {
            return new DayPilot.CalendarColumn(data, calendar);
        };

        this._widthUnit = function() {
            if (this.width && this.width.indexOf("px") !== -1) {
                return "Pixel";
            }
            return "Percentage";
        };

        this._drawHeader = function() {

            var header = this.nav.header;
            var create = true;

            var columns = this._columns;
            var len = columns.length;

            while (this.headerCreated && header && header.rows && header.rows.length > 0 && create) {
                if (!this.fasterDispose) DayPilot.pu(header.rows[0]);
                header.deleteRow(0);
            }

            this.headerCreated = true;

            if (!create) {
                // corner
                var corner = calendar.nav.corner;
                if (!this.fasterDispose) DayPilot.pu(corner.firstChild);
            }

            this._drawHeaderRow(create);
        };

        this.loadingStart = function() {
            if (this.loadingLabelVisible) {
                this.nav.loading.innerHTML = this.loadingLabelText;
                this.nav.loading.style.top = (this.headerHeight + 5) + "px";
                this.nav.loading.style.display = '';
            }
        };

        this.commandCallBack = function(command, data) {
            var params = {};
            params.command = command;
            this._callBack2('Command', data, params);
        };

        this.loadingStop = function(msg) {
            if (this.callbackTimeout) {
                window.clearTimeout(this.callbackTimeout);
            }

            this.nav.loading.style.display = 'none';
        };

        this._enableScrolling = function() {

            var scrollDiv = this.nav.scroll;

            if (!scrollDiv.onscroll) {
                scrollDiv.onscroll = function() {
                    calendar._saveScrollHour();
                };
            }

            var scrollpos = (typeof this._config.scrollpos !== 'undefined') ? this._config.scrollpos : this.initScrollPos;

            if (!scrollpos) {
                return;
            }


            if (scrollpos === 'Auto') {
                if (this.heightSpec === "BusinessHours") {
                    scrollpos = 2 * this.cellHeight * this.businessBeginsHour;
                }
                else {
                    scrollpos = 0;
                }
            }

            scrollDiv.root = this;

            // initial position
            if (scrollDiv.scrollTop === 0) {
                scrollDiv.scrollTop = scrollpos;
            }
        };

        this.callbackError = function (result, context) {
            alert("Error!\r\nResult: " + result + "\r\nContext:" + context);
        };

        this._fixScrollHeader = function() {
            var w = DayPilot.sw(this.nav.scroll);
            var d = this.nav.cornerRight;
            if (d) {
                d.style.width = w + 'px';
            }
        };

        this._registerGlobalHandlers = function() {
            if (!DayPilotCalendar.globalHandlers) {
                DayPilotCalendar.globalHandlers = true;
                DayPilot.re(document, 'mouseup', DayPilotCalendar.gMouseUp);
                DayPilot.re(window, 'unload', DayPilotCalendar.gUnload);
            }
        };

        this.events = {};
        //this.events.list = [];

        this.events.add = function(e) {

            var data = null;
            if (e instanceof DayPilot.Event) {
                data = e.data;
            }
            else if (typeof e === "object") {
                data = e;
            }
            else {
                throw "DayPilot.Calendar.events.add() expects an object or DayPilot.Event instance.";
            }

            if (!calendar.events.list) {
                calendar.events.list = [];
            }

            calendar.events.list.push(data);
            calendar._update({"eventsOnly": true});
            calendar._angular.notify();
        };


        this.events.find = function(id) {
            if (!calendar.events.list) {
                return null;
            }

            if (typeof id === "function") {
                var fn = id;
                for (var i = 0; i < calendar.events.list.length; i++) {
                    var e = new DayPilot.Event(calendar.events.list[i], calendar);
                    if (fn(e)) {
                        return e;
                    }
                }
                return null;
            }

            for (var i = 0; i < calendar.events.list.length; i++) {
                var data = calendar.events.list[i];
                if (data.id === id) {
                    return new DayPilot.Event(data, calendar);
                }
            }
            return null;
        };

        this.events.update = function(e) {
            if (e instanceof DayPilot.Event) {
                e.commit();
            }
            else if (typeof e === "object") {
                var target = calendar.events.find(e.id);
                if (target) {
                    var index = DayPilot.indexOf(calendar.events.list, target.data);
                    calendar.events.list.splice(index, 1, e);
                }
            }

            calendar._update({"eventsOnly": true});
            calendar._angular.notify();
        };

        this.events.remove = function(e) {
            var data;
            if (e instanceof DayPilot.Event) {
                data = e.data;
            }
            else if (typeof e === "object") {
                var target = calendar.events.find(e.id);
                if (target) {
                    data = target.data;
                }
            }
            else if (typeof e === "string" || typeof e === "number") {
                var target = calendar.events.find(e);
                if (target) {
                    data = target.data;
                }
            }

            var index = DayPilot.indexOf(calendar.events.list, data);
            calendar.events.list.splice(index, 1);
            calendar._update({"eventsOnly": true});
            calendar._angular.notify();
        };

      this.events.load = function(url, success, error) {
        var onError = function(args) {
          var largs = {};
          largs.exception = args.exception;
          largs.request = args.request;

          if (typeof error === 'function') {
            error(largs);
          }
        };

        var onSuccess = function(args) {
          var r = args.request;
          var data;

          // it's supposed to be JSON
          try {
            data = JSON.parse(r.responseText);
          }
          catch (e) {
            var fargs = {};
            fargs.exception = e;
            onError(fargs);
            return;
          }

          if (DayPilot.isArray(data)) {
            var sargs = {};
            sargs.preventDefault = function() {
              this.preventDefault.value = true;
            };
            sargs.data = data;
            if (typeof success === "function") {
              success(sargs);
            }

            if (sargs.preventDefault.value) {
              return;
            }

            calendar.events.list = data;
            if (calendar._initialized) {
                calendar._update({"eventsOnly": true});
            }
          }
        };

        var usePost = calendar.eventsLoadMethod && calendar.eventsLoadMethod.toUpperCase() === "POST";

        if (usePost) {
          DayPilot.Http.ajax({
            "method": "POST",
            "data": { "start": calendar.visibleStart().toString(), "end": calendar.visibleEnd().toString()},
            "url": url,
            "success": onSuccess,
            "error": onError
          });
        }
        else {
          var fullUrl = url;
          var queryString = "start=" + calendar.visibleStart().toString() + "&end=" + calendar.visibleEnd().toString();
          if (fullUrl.indexOf("?") > -1) {
            fullUrl += "&" + queryString;
          }
          else {
            fullUrl += "?" + queryString;
          }

          DayPilot.Http.ajax({
            "method": "GET",
            "url": fullUrl,
            "success": onSuccess,
            "error": onError
          });
        }

      };

        this._updateTheme = function() {
            // manually update theme for elements that are not redrawn during update
            //return;

            var needsUpdate = calendar.nav.top.className !== calendar._prefixCssClass("_main");

            if (!needsUpdate) {
                return;
            }

            calendar.nav.top.className = calendar._prefixCssClass("_main");
            var corner = calendar.nav.corner;
            corner.className = calendar._prefixCssClass("_corner");
            corner.firstChild.className = calendar._prefixCssClass("_corner_inner");

            var cr = calendar.nav.cornerRight;
            if (cr) {
                cr.className = calendar._prefixCssClass("_cornerright");
                cr.firstChild.className = calendar._prefixCssClass("_cornerright_inner");
            }
        };

        this.update = function(options) {

            if (calendar._disposed) {
                throw new DayPilot.Exception("You are trying to update a DayPilot.Calendar instance that has been disposed.");
            }

            calendar._loadOptions(options);
            calendar._update();
        };

        this._update = function(args) {

            if (!this._initialized) {
                return;
            }

            var args = args || {};
            var full = !args.eventsOnly;

            calendar._prepareVariables();
            calendar._deleteEvents();

            // reset after drag and drop/deleting
            calendar.nav.top.style.cursor = "auto";

            // calendar._show();

            if (full) {
                calendar._prepareColumns();
                calendar._drawHeader();
                calendar._drawMain();
                calendar._drawHourTable();
                calendar._updateHeight();
                calendar._updateCorner();
                calendar._fixScrollHeader();
                calendar._updateTheme();

                calendar._restoreScrollHour();
            }

            calendar._loadEvents();
            calendar._updateHeaderHeight();

            calendar._drawEvents();
            calendar.clearSelection();

            if (this.visible) {
                this.show();
            }
            else {
                this.hide();
            }
        };


        this._specialHandling = null;
        this._loadOptions = function(options) {
            if (!options) {
                return;
            }
            var specialHandling = {
                "events": {
                    "preInit": function() {
                        var events = this.data || [];
                        if (DayPilot.isArray(events.list)) {
                            calendar.events.list = events.list;
                        }
                        else {
                            calendar.events.list = events;
                        }
                    }
                },
                "columns": {
                    "preInit": function() {
                        calendar.columns.list = this.data;
                    }
                }
            };
            this._specialHandling = specialHandling;

            for (var name in options) {
                if (specialHandling[name]) {
                    var item = specialHandling[name];
                    item.data = options[name];
                    if (item.preInit) {
                        item.preInit();
                    }
                }
                else {
                    calendar[name] = options[name];
                }
            }

        };

        this._postInit = function() {
            var specialHandling = this._specialHandling;
            for (var name in specialHandling) {
                var item = specialHandling[name];
                if (item.postInit) {
                    item.postInit();
                }
            }
        };

        this._loadTop = function() {
            if (this.id && this.id.tagName) {
                this.nav.top = this.id;
            }
            else if (typeof this.id === "string") {
                this.nav.top = document.getElementById(this.id);
                if (!this.nav.top) {
                    throw "DayPilot.Calendar: The placeholder element not found: '" + id + "'.";
                }
            }
            else {
                throw "DayPilot.Calendar() constructor requires the target element or its ID as a parameter";
            }
        };

        this._cache = {};
        this._cache.events = [];

        this._doBeforeEventRender = function(i) {
            var cache = this._cache.events;
            var data = this.events.list[i];
            var evc = {};

            // make a copy
            for (var name in data) {
                evc[name] = data[name];
            }

            if (typeof this.onBeforeEventRender === 'function') {
                var args = {};
                args.control = calendar;
                args.data = evc;
                this.onBeforeEventRender(args);
            }

            cache[i] = evc;

        };

        this._loadEvents = function() {

            var events = this.events.list;

            calendar._cache.events = [];

            if (!events) {
                return;
            }

            if (!DayPilot.isArray(events)) {
                throw new DayPilot.Exception("DayPilot.Calendar.events.list expects an array object. You supplied: " + (typeof events));
            }

            var length = events.length;
            var duration = 24 * 60 * 60 * 1000;

            this.cache.pixels = {};

            var loadCache = [];

            this.scrollLabels = [];

            this.minStart = 10000;
            this.maxEnd = 0;

            for (var i = 0; i < length; i++) {
                var e = events[i];
                var edata = e;

                if (typeof edata !== "object") {
                    throw new DayPilot.Exception("Event data item must be an object");
                }
                if (!edata.start) {
                    throw new DayPilot.Exception("Event data item must specify 'start' property");
                }
                if (!edata.end) {
                    throw new DayPilot.Exception("Event data item must specify 'end' property");
                }

                if (edata instanceof DayPilot.Event) {
                    throw new DayPilot.Exception("DayPilot.Calendar: DayPilot.Event object detected in events.list array. Use raw event data instead.");
                }

                e.start = new DayPilot.Date(e.start);
                e.end = new DayPilot.Date(e.end);
            }

            if (typeof this.onBeforeEventRender === 'function') {
                for (var i = 0; i < length; i++) {
                    this._doBeforeEventRender(i);
                }
            }

            for(var i = 0; i < this._columns.length; i++) {

                var scroll = {};
                scroll.minEnd = 1000000;
                scroll.maxStart = -1;
                this.scrollLabels.push(scroll);

                var col = this._columns[i];
                col.events = [];
                col.lines = [];
                col.blocks = [];

                var colStart = new DayPilot.Date(col.start);
                var colStartTicks = colStart.getTime();
                var colEnd = colStart.addTime(duration);
                var colEndTicks = colEnd.getTime();

                for (var j = 0; j < length; j++) {
                    if (loadCache[j]) {
                        continue;
                    }

                    var e = events[j];

                    var start = e.start;
                    var end = e.end;

                    var startTicks = start.getTime();
                    var endTicks = end.getTime();

                    if (endTicks < startTicks) {  // skip invalid events
                        continue;
                    }

                    // belongs here
                    var belongsHere = !(endTicks <= colStartTicks || startTicks >= colEndTicks);
                    if (calendar.viewType === "Resources") {
                        belongsHere = belongsHere && col.id === e.resource;
                    }

                    if (belongsHere) {
                        var ep = new DayPilot.Event(e, calendar); // event part
                        ep.part.dayIndex = i;
                        ep.part.start = colStartTicks < startTicks ? e.start : colStart;
                        ep.part.end = colEndTicks > endTicks ? e.end : colEnd;

                        var partStartPixels = this.getPixels(ep.part.start, col.start);
                        var partEndPixels = this.getPixels(ep.part.end, col.start);

                        var top = partStartPixels.top;
                        var bottom = partEndPixels.top;

                        // events in the hidden areas
                        if (top === bottom && (partStartPixels.cut || partEndPixels.cut)) {
                            continue;
                        }

                        var boxBottom = partEndPixels.boxBottom;

                        ep.part.top = Math.floor(top / this.cellHeight) * this.cellHeight + 1;
                        ep.part.height = Math.max(Math.ceil(boxBottom / this.cellHeight) * this.cellHeight - ep.part.top, this.cellHeight - 1) + 1;
                        ep.part.barTop = Math.max(top - ep.part.top - 1, 0);  // minimum 0
                        ep.part.barHeight = Math.max(bottom - top - 2, 1);  // minimum 1

                        var start = ep.part.top;
                        var end = ep.part.top + ep.part.height;

                        if (start > scroll.maxStart) {
                            scroll.maxStart = start;
                        }
                        if (end < scroll.minEnd) {
                            scroll.minEnd = end;
                        }

                        if (start < this.minStart) {
                            this.minStart = start;
                        }
                        if (end > this.maxEnd) {
                            this.maxEnd = end;
                        }
                        col.events.push(ep);

                        if (typeof this.onBeforeEventRender === 'function') {
                            ep.cache = this._cache.events[j];
                        }

                        if (ep.part.start.getTime() === startTicks && ep.part.end.getTime() === endTicks) {
                            loadCache[j] = true;
                        }
                    }
                }

            }


            // sort events inside rows
            for (var i = 0; i < this._columns.length; i++) {
                var col = this._columns[i];
                col.events.sort(this._eventComparer);

                // put into lines
                for (var j = 0; j < col.events.length; j++) {
                    var e = col.events[j];
                    col.putIntoBlock(e);
                }

                for (var j = 0; j < col.blocks.length; j++) {
                    var block = col.blocks[j];
                    block.events.sort(this._eventComparer);
                    for (var k = 0; k < block.events.length; k++ ) {
                        var e = block.events[k];
                        block.putIntoLine(e);
                    }
                }
            }
        };

        this._eventComparer = function(a, b) {
            if (!a || !b || !a.start || !b.start) {
                return 0; // no sorting, invalid arguments
            }

            var byStart = a.start().getTime() - b.start().getTime();
            if (byStart !== 0) {
                return byStart;
            }

            var byEnd = b.end().getTime() - a.end().getTime(); // desc
            return byEnd;
        };

        this.debug = function(msg, append) {
            if (!this.debuggingEnabled) {
                return;
            }

            if (!calendar.debugMessages) {
                calendar.debugMessages = [];
            }
            calendar.debugMessages.push(msg);

            if (typeof console !== 'undefined') {
                console.log(msg);
            }
        };

        this.getPixels = function(date, start) {
            if (!start) start = this.startDate;

            var startTicks = start.getTime();
            var ticks = date.getTime();

            var cache = this.cache.pixels[ticks + "_" + startTicks];
            if (cache) {
                return cache;
            }

            startTicks = start.getTime();

            var boxTicks = 30 * 60 * 1000;
            var topTicks = ticks - startTicks;
            var boxOffsetTicks = topTicks % boxTicks;

            var boxStartTicks = topTicks - boxOffsetTicks;
            var boxEndTicks = boxStartTicks + boxTicks;
            if (boxOffsetTicks === 0) {
                boxEndTicks = boxStartTicks;
            }

            // it's linear scale so far
            var result = {};
            result.cut = false;
            result.top = this._ticksToPixels(topTicks);
            result.boxTop = this._ticksToPixels(boxStartTicks);
            result.boxBottom = this._ticksToPixels(boxEndTicks);

            this.cache.pixels[ticks + "_" + startTicks] = result;

            return result;
        };

        this._ticksToPixels = function(ticks) {
            return Math.floor( (this.cellHeight * ticks) / (1000 * 60 * 30) );
        };

        this._prepareVariables = function() {
            this.startDate = new DayPilot.Date(this.startDate).getDatePart();
        };

        this._updateHeaderHeight = function() {
            if (this.nav.corner) {
                this.nav.corner.style.height = this.headerHeight + "px";
            }
        };

        this._updateHeight = function() {
            var sh = this._getScrollableHeight();
            if (this.nav.scroll && sh > 0) {
                this.nav.scroll.style.height = sh + "px";
            }
        };

        this._angular = {};
        this._angular.scope = null;
        this._angular.notify = function() {
            if (calendar._angular.scope) {
                calendar._angular.scope["$apply"]();
            }
        };
        this._angular.apply = function(f) {
            // autoapply has been disabled
            f();

            /*
            if (calendar.angularAutoApply && calendar._angular.scope) {
                calendar._angular.scope["$apply"](f);
            }
            else {
                f();
            }
            */
        };

        this._saveScrollHour = function() {
            if (!calendar.nav.scroll) {
                return;
            }
            var top = calendar.nav.scroll.scrollTop;
            var pos = top / (2*calendar.cellHeight);
            calendar._config.scrollHour = pos;
        };

        this._restoreScrollHour = function() {
            var scrollpos = 0;
            if (typeof calendar._config.scrollHour === "number") {
                scrollpos = 2 * calendar.cellHeight * calendar._config.scrollHour;
                //calendar._config.scrollHour = null;
            }
            else {
                if (calendar.initScrollPos === 'Auto') {
                    if (this.heightSpec === "BusinessHours") {
                        scrollpos = 2 * this.cellHeight * this.businessBeginsHour;
                    }
                    else {
                        scrollpos = 0;
                    }
                }
            }

            calendar.nav.scroll.scrollTop = scrollpos;
        };

        this._loadFromServer = function() {
            // make sure it has a place to ask
            if (this.backendUrl || typeof WebForm_DoCallback === 'function') {
                return (typeof calendar.events.list === 'undefined') || (!calendar.events.list);
            }
            else {
                return false;
            }
        };

        this._show = function() {
            if (this.nav.top.style.visibility === 'hidden') {
                this.nav.top.style.visibility = 'visible';
            }
        };

        this.show = function() {
            calendar.visible = true;
            calendar.nav.top.style.display = '';
            this._fixScrollHeader();
        };

        this.hide = function() {
            calendar.visible = false;
            calendar.nav.top.style.display = 'none';
        };
        this._initShort = function() {
            this._prepareVariables();
            this._prepareColumns();
            this._drawTop();
            this._drawHeader();
            this._drawMain();
            this._fixScrollHeader();
            this._enableScrolling();
            this._registerGlobalHandlers();
            DayPilotCalendar.register(this);

            this._waitForVisibility();
            this._callBack2('Init');
        };

        this._config = {};

        this._saveConfig = function() {
            this._config.themes = [];
            this._config.themes.push(this.theme || this.cssClassPrefix);
        };

        this._clearThemes = function() {
            var themes = this._config.themes;
            for (var i = 0; i < themes.length; i++) {
                var theme = themes[i];
                DayPilot.Util.removeClass(this.nav.top, theme + "_main");
            }
            this._config.themes = [];
        };

        this._doAfterRender = function() {
            this.afterRender(null, false);
            if (typeof this.onAfterRender === "function") {
                var args = {};
                args.isCallBack = false;
                this.onAfterRender(args);
            }
        };

        this._doInit = function() {
            if (typeof this.onInit === "function" && !this._onInitCalled) {
                this._onInitCalled = true;
                var args = {};
                this.onInit(args);
            }
        };

        this._visible = function() {
            var el = calendar.nav.top;
            if (!el) {
                return false;
            }
            return el.offsetWidth > 0 && el.offsetHeight > 0;
        };

        this._waitForVisibility = function() {
            var visible = calendar._visible;

            if (!visible()) {
                calendar._visibilityInterval = setInterval(function() {
                    if (visible()) {
                        calendar._enableScrolling();
                        calendar._fixScrollHeader();
                        clearInterval(calendar._visibilityInterval);
                    }
                }, 100);
            }
        };

        this._xssTextHtml = function(text, html) {

            if (calendar._resolved._xssProtectionEnabled()) {
                return DayPilot.Util.escapeTextHtml(text, html);
            }

            if (!DayPilot.Util.isNullOrUndefined(html)) {
                return html;
            }
            if (DayPilot.Util.isNullOrUndefined(text)) {
                return "";
            }
            return text;
        };


        this.internal = {};
        this.internal.loadOptions = calendar._loadOptions;
        this.internal.xssTextHtml = calendar._xssTextHtml;

        this.init = function() {
            this._loadTop();

            var loadFromServer = this._loadFromServer();

            this._saveConfig();

            if (loadFromServer) {
                this._initShort();
                return;
            }

            this._prepareVariables();
            this._prepareColumns();

            this._loadEvents();

            this._drawTop();
            this._drawHeader();
            this._drawMain();

            this._show();

            this._fixScrollHeader();
            this._enableScrolling();
            this._registerGlobalHandlers();
            DayPilotCalendar.register(this);

            if (this.events) { // are events available?
                this._updateHeaderHeight();
                this._drawEvents();
            }

            this._doAfterRender();
            this._doInit();
            this._waitForVisibility();
            this._initialized = true;

            return this;
        };

        this.Init = this.init;

        this._loadOptions(options);
    };

    DayPilot.CalendarColumn = function(col, calendar) {
        var column = this;

        column.id = col.id;
        column.name = col.name;
        column.data = col.data;
        column.start = new DayPilot.Date(col.start);
        column.calendar = calendar;

        column.toJSON = function() {
            var json = {};
            json.id = this.id;
            if (this.start) {
                json.start = this.start.toString();
            }
            json.name = this.name;
            return json;
        };
    };


    // publish the API
    DayPilot.Calendar = DayPilotCalendar.Calendar;

    // jQuery plugin
    if (typeof jQuery !== 'undefined') {
        (function( $ ){
            $.fn.daypilotCalendar = function(options) {
                var first = null;
                var j = this.each(function() {
                    if (this.daypilot) { // already initialized
                        return;
                    };

                    var daypilot = new DayPilot.Calendar(this.id);
                    this.daypilot = daypilot;
                    for (name in options) {
                        daypilot[name] = options[name];
                    }
                    daypilot.init();
                    if (!first) {
                        first = daypilot;
                    }
                });
                if (this.length === 1) {
                    return first;
                }
                else {
                    return j;
                }
            };
        })( jQuery );
    }

    (function registerAngularModule() {

        var app = DayPilot.am();

        if (!app) {
            return;
        }

        app.directive("daypilotCalendar", ['$parse', function($parse) {
//        app.directive("daypilotCalendar", function() {
            return {
                "restrict": "E",
                "template": "<div></div>",
                "replace": true,
                "link": function (scope, element, attrs) {

                    var calendar = new DayPilot.Calendar(element[0]);
                    calendar._angular.scope = scope;
                    calendar.init();

                    var oattr = attrs["id"];
                    if (oattr) {
                        scope[oattr] = calendar;
                    }

                    // save DayPilot.Calendar object in the specified variable
                    var pas = attrs["publishAs"];
                    if (pas) {
                        var getter = $parse(pas);
                        var setter = getter.assign;
                        setter(scope, calendar);
                    }

                    // bind event handlers from attributes starting with "on"
                    for (var name in attrs) {
                        if (name.indexOf("on") === 0) {  // event handler
                            (function(name) {
                                calendar[name] = function(args) {
                                    var f = $parse(attrs[name]);
                                    scope["$apply"](function() {
                                        f(scope, {"args": args});
                                    });
                                };
                            })(name);
                        }
                    }

                    var watch = scope["$watch"];
                    var config = attrs["config"] || attrs["daypilotConfig"];
                    var events = attrs["events"] || attrs["daypilotEvents"];

                    watch.call(scope, config, function (value) {
                        //var bbOld = calendar.businessBeginsHour;

                        for (var name in value) {
                            calendar[name] = value[name];
                        }
                        calendar.update();
                        calendar._doInit();
                    }, true);

                    watch.call(scope, events, function(value) {
                        //var calendar = element.data("calendar");
                        calendar.events.list = value;
                        calendar.update();
                    }, true);

                }
            };
        }]);
    })();

})();
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

    if (typeof DayPilot.DatePicker !== 'undefined' && DayPilot.DatePicker.close) {
        return;
    }

    DayPilot.DatePicker = function(properties) {
        this.v = '2024.3.543-lite';
        var navigatorId = "navigator_" + new Date().getTime();
        var This = this;

        this.onShow = null;
        this.onTimeRangeSelect = null;
        this.onTimeRangeSelected = null;
        // this.dateFormat = null;

        this.prepare = function() {
            this.locale = "en-us";
            this.target = null;
            this.targetAlignment = "left";
            this.resetTarget = true;
            this.pattern = this._resolved.locale().datePattern;    // "M/d/yyyy"
            this.theme = "navigator_default";
            this.patterns = [];
            this.zIndex = null;

            // load settings
            if (properties) {
                for (var name in properties) {
                    this[name] = properties[name];
                }
            }

        };

        this.init = function() {

            this.date = new DayPilot.Date(this.date);

            var value = this._readFromTarget();

            if (this.resetTarget && !value) {
                this._writeToTarget(this.date);
            }
            else if (!this.resetTarget) {
                This.date = value;
            }

            var target = this._element();
            if (target) {
                target.addEventListener("input", function() {
                    This.date = This._readFromTarget();
                    if (This.date) {
                        This.navigator.select(This.date, {dontNotify: true});
                    }
                });
            }

            document.addEventListener("mousedown", function() {
                This.close();
            });

            return this;

        };

        this.close = function() {
            if (!this._visible) {
                return;
            }

            this._visible = false;

            if (this.navigator) {
                this.navigator.dispose();
            }
            this.div.innerHTML = '';
            if (this.div && this.div.parentNode === document.body) {
                document.body.removeChild(this.div);
            }
        };

        this.setDate = function(date) {
            this.date = new DayPilot.Date(date);
            this._writeToTarget(this.date);
        };

        this._readFromTarget = function() {
            // recognized targets: input (value), other DOM elements (innerHTML)
            var element = this._element();

            if (!element) {
                return this.date;
            }

            var value = null;
            if (element.tagName === "INPUT") {
                value = element.value;
            }
            else {
                value = element.innerText;
            }

            if (!value) {
                return null;
            }

            var date = DayPilot.Date.parse(value, This.pattern);
            for (var i = 0; i < This.patterns.length; i++) {
                if (date) {
                    return date;
                }
                date = DayPilot.Date.parse(value, This.patterns[i]);
            }

            return date;
        };

        this._writeToTarget = function(date) {
            var element = this._element();

            if (!element) {
                return;
            }

            var value = date.toString(This.pattern, This.locale);
            if (element.tagName === "INPUT") {
                element.value = value;
            }
            else {
                element.innerHTML = value;
            }

        };

        this._resolved = {};
        this._resolved.locale = function() {
            return DayPilot.Locale.find(This.locale);
        };

        /*        this._resolved.dateFormat = function() {
                    if (typeof This.dateFormat === "string") {
                        return This.dateFormat;
                    }
                    return This._resolved.locale().datePattern;
                }*/

        this._element = function() {
            var id = this.target;
            // accept DOM element or id (string)
            var element = (id && id.nodeType && id.nodeType === 1 ) ? id : document.getElementById(id);
            return element;
        };

        Object.defineProperty(this, "visible", {
            get: function() { return This._visible; }
        });

        this.show = function() {

            if (this._visible) {
                return;
            }

            var element = this._element();
            var navigator = this.navigator;

            var navigator = new DayPilot.Navigator(navigatorId);
            navigator.api = 2;
            navigator.cssOnly = true;
            navigator.theme = This.theme;
            navigator.weekStarts = "Auto";
            navigator.locale = This.locale;
            navigator.onTimeRangeSelected = function(args) {
                This.date = args.start;

                var start = args.start.addTime(navigator._pickerTimePart);
                var value = start.toString(This.pattern, This.locale);

                var args = {};
                args.start = start;
                args.date = start;
                args.preventDefault = function() {
                    this.preventDefault.value = true;
                };

                if (typeof This.onTimeRangeSelect ===  'function') {
                    This.onTimeRangeSelect(args);
                    if (args.preventDefault.value) {
                        return;
                    }
                }

                This._writeToTarget(value);
                This.close();

                if (typeof This.onTimeRangeSelected === 'function') {
                    This.onTimeRangeSelected(args);
                }
            };

            this.navigator = navigator;

            var position = DayPilot.abs(element);
            var height = element.offsetHeight;

            var align = This.targetAlignment;

            var div = document.createElement("div");
            div.style.position = "absolute";

            if (align === "left") {
                div.style.left = position.x + "px";
            }


            div.style.top = (position.y + height) + "px";
            if (This.zIndex) {
                div.style.zIndex = This.zIndex;
            }

            var nav = document.createElement("div");
            nav.id = navigatorId;
            div.appendChild(nav);

            div.addEventListener("mousedown", function(ev) {
                var ev = ev || window.event;
                ev.cancelBubble = true;
                ev.stopPropagation && ev.stopPropagation();
            });

            document.body.appendChild(div);

            this.div = div;

            var selected = This._readFromTarget() || new DayPilot.Date().getDatePart();

            navigator.startDate = selected;
            navigator._pickerTimePart = selected.getTimePart();
            // navigator.selectionStart = selected.getDatePart();
            navigator.selectionDay = selected.getDatePart();
            navigator.init();

            if (align === "right") {
                var left = (position.x + element.offsetWidth - navigator.nav.top.offsetWidth);
                div.style.left = left + "px";
            }

            this._visible = true;
            if (this.onShow) {
                this.onShow();
            }
        };

        this.prepare(); // prepare only called once, in the constructor
        this.init();
    };

})();
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

v3.15.0
https://modal.daypilot.org/

*/

if (typeof(DayPilot) === 'undefined') {
    DayPilot = {};
}

(function(DayPilot) {
    'use strict';

    // modal.js  -> 1482

    if (DayPilot.ModalStatic) {
        return;
    }

    DayPilot.ModalStatic = {};

    DayPilot.ModalStatic.list = [];

    // hide the last one
    DayPilot.ModalStatic.hide = function() {
        if (this.list.length > 0) {
            var last = this.list.pop();
            if (last) {
                last.hide();
            }
        }
    };

    DayPilot.ModalStatic.remove = function(modal) {
        var list = DayPilot.ModalStatic.list;
        for (var i = 0; i < list.length; i++) {
            if (list[i] === modal) {
                list.splice(i, 1);
                return;
            }
        }
    };

    DayPilot.ModalStatic.close = function(result) {
        DayPilot.ModalStatic.result(result);
        DayPilot.ModalStatic.hide();
    };

    DayPilot.ModalStatic.result = function(r) {
        var list = DayPilot.ModalStatic.list;
        if (list.length > 0) {
            list[list.length - 1].result = r;
        }
    };

    DayPilot.ModalStatic.displayed = function(modal) {
        var list = DayPilot.ModalStatic.list;
        for (var i = 0; i < list.length; i++) {
            if (list[i] === modal) {
                return true;
            }
        }
        return false;
    };

    DayPilot.ModalStatic.stretch = function() {
        if (this.list.length > 0) {
            var last = this.list[this.list.length - 1];
            if (last) {
                last.stretch();
            }
        }
    };

    DayPilot.ModalStatic.last = function() {
        var list = DayPilot.ModalStatic.list;
        if (list.length > 0) {
            return list[list.length - 1];
        }
        return null;
    };

    var Sheet = function() {

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
            try {
                if (oldStyle) {
                    style.styleSheet.cssText = this.rules.join("\n");
                }
            }
            catch (e) {
                //alert("Error registering the built-in stylesheet (IE stylesheet limit reached). Stylesheet count: " + document.styleSheets.length);
            }
        };

        sheet.add = function(selector, rules, index) {
            if (oldStyle) {
                this.rules.push(selector + "{" + rules + "\u007d");
                return;
            }
            if(style.sheet.insertRule) {  // normal browsers, ie9+
                if (typeof index === "undefined") {
                    index = style.sheet.cssRules.length;
                }
                style.sheet.insertRule(selector + "{" + rules + "\u007d", index);
            }
            else if (style.sheet.addRule) {
                style.sheet.addRule(selector, rules, index);
            }
            else {
                throw "No CSS registration method found";
            }
        };
        return sheet;
    };

    var iconCalendar = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjxzdmcKICAgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIgogICB3aWR0aD0iMTAiCiAgIGhlaWdodD0iMTUiCj4KICA8ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwLDUpIj4KICAgIDxyZWN0CiAgICAgICBzdHlsZT0iZmlsbDojY2NjY2NjO2ZpbGwtb3BhY2l0eToxO3N0cm9rZTpub25lO3N0cm9rZS13aWR0aDoxLjM4MDM3MzM2O3N0cm9rZS1saW5lY2FwOmJ1dHQ7c3Ryb2tlLWxpbmVqb2luOnJvdW5kO3N0cm9rZS1taXRlcmxpbWl0OjQ7c3Ryb2tlLWRhc2hhcnJheTpub25lO3N0cm9rZS1vcGFjaXR5OjEiCiAgICAgICBpZD0icmVjdDE5MjgiCiAgICAgICB3aWR0aD0iOS45MTUzMDYxIgogICAgICAgaGVpZ2h0PSIxMS4zNjkzNyIKICAgICAgIHg9IjAuMTE3MTg3NSIKICAgICAgIHk9Ii0zLjAwOTk5NTciCiAgICAgICByeT0iMS4zMTE4NTA1IiAvPgogICAgPHJlY3QKICAgICAgIHN0eWxlPSJmaWxsOiNjY2NjY2M7ZmlsbC1vcGFjaXR5OjE7c3Ryb2tlOm5vbmU7c3Ryb2tlLXdpZHRoOjEuNTk4MTQwMTI7c3Ryb2tlLWxpbmVjYXA6YnV0dDtzdHJva2UtbGluZWpvaW46cm91bmQ7c3Ryb2tlLW1pdGVybGltaXQ6NDtzdHJva2UtZGFzaGFycmF5Om5vbmU7c3Ryb2tlLW9wYWNpdHk6MSIKICAgICAgIGlkPSJyZWN0MTkzMCIKICAgICAgIHdpZHRoPSIxLjUzNDQxMzYiCiAgICAgICBoZWlnaHQ9IjIuMjE5ODI1IgogICAgICAgeD0iMi4xNTU4NDgzIgogICAgICAgeT0iLTQuMzkzNzAwMSIKICAgICAgIHJ5PSIwLjY3MTc4OTE3IiAvPgogICAgPHJlY3QKICAgICAgIHJ5PSIwLjI5NjAxNDciCiAgICAgICB5PSItMS4xNjU4NDY2IgogICAgICAgeD0iMS41MjM5NTA2IgogICAgICAgaGVpZ2h0PSIxLjgyOTkwOTEiCiAgICAgICB3aWR0aD0iMS44MzQyMjUxIgogICAgICAgaWQ9InJlY3QxOTQ4IgogICAgICAgc3R5bGU9ImZpbGw6I2ZmZmZmZjtmaWxsLW9wYWNpdHk6MTtzdHJva2U6bm9uZTtzdHJva2Utd2lkdGg6MS40MjE4OTE5MztzdHJva2UtbGluZWNhcDpidXR0O3N0cm9rZS1saW5lam9pbjpyb3VuZDtzdHJva2UtbWl0ZXJsaW1pdDo0O3N0cm9rZS1kYXNoYXJyYXk6bm9uZTtzdHJva2Utb3BhY2l0eToxIiAvPgogICAgPHJlY3QKICAgICAgIHJ5PSIwLjY3MTc4OTE3IgogICAgICAgeT0iLTQuMzkzNzAwMSIKICAgICAgIHg9IjYuNDUyNzIzNSIKICAgICAgIGhlaWdodD0iMi4yMTk4MjUiCiAgICAgICB3aWR0aD0iMS41MzQ0MTM2IgogICAgICAgaWQ9InJlY3QyMDAzIgogICAgICAgc3R5bGU9ImZpbGw6I2NjY2NjYztmaWxsLW9wYWNpdHk6MTtzdHJva2U6bm9uZTtzdHJva2Utd2lkdGg6MS41OTgxNDAxMjtzdHJva2UtbGluZWNhcDpidXR0O3N0cm9rZS1saW5lam9pbjpyb3VuZDtzdHJva2UtbWl0ZXJsaW1pdDo0O3N0cm9rZS1kYXNoYXJyYXk6bm9uZTtzdHJva2Utb3BhY2l0eToxIiAvPgogICAgPHJlY3QKICAgICAgIHN0eWxlPSJmaWxsOiNmZmZmZmY7ZmlsbC1vcGFjaXR5OjE7c3Ryb2tlOm5vbmU7c3Ryb2tlLXdpZHRoOjEuNDIxODkxOTM7c3Ryb2tlLWxpbmVjYXA6YnV0dDtzdHJva2UtbGluZWpvaW46cm91bmQ7c3Ryb2tlLW1pdGVybGltaXQ6NDtzdHJva2UtZGFzaGFycmF5Om5vbmU7c3Ryb2tlLW9wYWNpdHk6MSIKICAgICAgIGlkPSJyZWN0MjAwNSIKICAgICAgIHdpZHRoPSIxLjgzNDIyNTEiCiAgICAgICBoZWlnaHQ9IjEuODI5OTA5MSIKICAgICAgIHg9IjQuMjE5MjYzMSIKICAgICAgIHk9Ii0xLjE2NTg0NjYiCiAgICAgICByeT0iMC4yOTYwMTQ3IiAvPgogICAgPHJlY3QKICAgICAgIHJ5PSIwLjI5NjAxNDciCiAgICAgICB5PSItMS4xNjU4NDY2IgogICAgICAgeD0iNi45OTI3MDA2IgogICAgICAgaGVpZ2h0PSIxLjgyOTkwOTEiCiAgICAgICB3aWR0aD0iMS44MzQyMjUxIgogICAgICAgaWQ9InJlY3QyMDA3IgogICAgICAgc3R5bGU9ImZpbGw6I2ZmZmZmZjtmaWxsLW9wYWNpdHk6MTtzdHJva2U6bm9uZTtzdHJva2Utd2lkdGg6MS40MjE4OTE5MztzdHJva2UtbGluZWNhcDpidXR0O3N0cm9rZS1saW5lam9pbjpyb3VuZDtzdHJva2UtbWl0ZXJsaW1pdDo0O3N0cm9rZS1kYXNoYXJyYXk6bm9uZTtzdHJva2Utb3BhY2l0eToxIiAvPgogICAgPHJlY3QKICAgICAgIHN0eWxlPSJmaWxsOiNmZmZmZmY7ZmlsbC1vcGFjaXR5OjE7c3Ryb2tlOm5vbmU7c3Ryb2tlLXdpZHRoOjEuNDIxODkxOTM7c3Ryb2tlLWxpbmVjYXA6YnV0dDtzdHJva2UtbGluZWpvaW46cm91bmQ7c3Ryb2tlLW1pdGVybGltaXQ6NDtzdHJva2UtZGFzaGFycmF5Om5vbmU7c3Ryb2tlLW9wYWNpdHk6MSIKICAgICAgIGlkPSJyZWN0MjAxMyIKICAgICAgIHdpZHRoPSIxLjgzNDIyNTEiCiAgICAgICBoZWlnaHQ9IjEuODI5OTA5MSIKICAgICAgIHg9IjEuNTIzOTUwNiIKICAgICAgIHk9IjEuODAyOTAzNCIKICAgICAgIHJ5PSIwLjI5NjAxNDciIC8+CiAgICA8cmVjdAogICAgICAgcnk9IjAuMjk2MDE0NyIKICAgICAgIHk9IjEuODAyOTAzNCIKICAgICAgIHg9IjQuMjE5MjYzMSIKICAgICAgIGhlaWdodD0iMS44Mjk5MDkxIgogICAgICAgd2lkdGg9IjEuODM0MjI1MSIKICAgICAgIGlkPSJyZWN0MjAxNSIKICAgICAgIHN0eWxlPSJmaWxsOiNmZmZmZmY7ZmlsbC1vcGFjaXR5OjE7c3Ryb2tlOm5vbmU7c3Ryb2tlLXdpZHRoOjEuNDIxODkxOTM7c3Ryb2tlLWxpbmVjYXA6YnV0dDtzdHJva2UtbGluZWpvaW46cm91bmQ7c3Ryb2tlLW1pdGVybGltaXQ6NDtzdHJva2UtZGFzaGFycmF5Om5vbmU7c3Ryb2tlLW9wYWNpdHk6MSIgLz4KICAgIDxyZWN0CiAgICAgICBzdHlsZT0iZmlsbDojZmZmZmZmO2ZpbGwtb3BhY2l0eToxO3N0cm9rZTpub25lO3N0cm9rZS13aWR0aDoxLjQyMTg5MTkzO3N0cm9rZS1saW5lY2FwOmJ1dHQ7c3Ryb2tlLWxpbmVqb2luOnJvdW5kO3N0cm9rZS1taXRlcmxpbWl0OjQ7c3Ryb2tlLWRhc2hhcnJheTpub25lO3N0cm9rZS1vcGFjaXR5OjEiCiAgICAgICBpZD0icmVjdDIwMTciCiAgICAgICB3aWR0aD0iMS44MzQyMjUxIgogICAgICAgaGVpZ2h0PSIxLjgyOTkwOTEiCiAgICAgICB4PSI2Ljk5MjcwMDYiCiAgICAgICB5PSIxLjgwMjkwMzQiCiAgICAgICByeT0iMC4yOTYwMTQ3IiAvPgogICAgPHJlY3QKICAgICAgIHJ5PSIwLjI5NjAxNDciCiAgICAgICB5PSI0LjczMjU5MDciCiAgICAgICB4PSIxLjU2MzAxMzEiCiAgICAgICBoZWlnaHQ9IjEuODI5OTA5MSIKICAgICAgIHdpZHRoPSIxLjgzNDIyNTEiCiAgICAgICBpZD0icmVjdDIwMTkiCiAgICAgICBzdHlsZT0iZmlsbDojZmZmZmZmO2ZpbGwtb3BhY2l0eToxO3N0cm9rZTpub25lO3N0cm9rZS13aWR0aDoxLjQyMTg5MTkzO3N0cm9rZS1saW5lY2FwOmJ1dHQ7c3Ryb2tlLWxpbmVqb2luOnJvdW5kO3N0cm9rZS1taXRlcmxpbWl0OjQ7c3Ryb2tlLWRhc2hhcnJheTpub25lO3N0cm9rZS1vcGFjaXR5OjEiIC8+CiAgICA8cmVjdAogICAgICAgc3R5bGU9ImZpbGw6I2ZmZmZmZjtmaWxsLW9wYWNpdHk6MTtzdHJva2U6bm9uZTtzdHJva2Utd2lkdGg6MS40MjE4OTE5MztzdHJva2UtbGluZWNhcDpidXR0O3N0cm9rZS1saW5lam9pbjpyb3VuZDtzdHJva2UtbWl0ZXJsaW1pdDo0O3N0cm9rZS1kYXNoYXJyYXk6bm9uZTtzdHJva2Utb3BhY2l0eToxIgogICAgICAgaWQ9InJlY3QyMDIxIgogICAgICAgd2lkdGg9IjEuODM0MjI1MSIKICAgICAgIGhlaWdodD0iMS44Mjk5MDkxIgogICAgICAgeD0iNC4yNTgzMjU2IgogICAgICAgeT0iNC43MzI1OTA3IgogICAgICAgcnk9IjAuMjk2MDE0NyIgLz4KICAgIDxyZWN0CiAgICAgICByeT0iMC4yOTYwMTQ3IgogICAgICAgeT0iNC43MzI1OTA3IgogICAgICAgeD0iNy4wMzE3NjMxIgogICAgICAgaGVpZ2h0PSIxLjgyOTkwOTEiCiAgICAgICB3aWR0aD0iMS44MzQyMjUxIgogICAgICAgaWQ9InJlY3QyMDIzIgogICAgICAgc3R5bGU9ImZpbGw6I2ZmZmZmZjtmaWxsLW9wYWNpdHk6MTtzdHJva2U6bm9uZTtzdHJva2Utd2lkdGg6MS40MjE4OTE5MztzdHJva2UtbGluZWNhcDpidXR0O3N0cm9rZS1saW5lam9pbjpyb3VuZDtzdHJva2UtbWl0ZXJsaW1pdDo0O3N0cm9rZS1kYXNoYXJyYXk6bm9uZTtzdHJva2Utb3BhY2l0eToxIiAvPgogIDwvZz4KPC9zdmc+Cg==";
    var iconExpand = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjxzdmcKICAgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIgogICB3aWR0aD0iMTAiCiAgIGhlaWdodD0iMTUiCj4KICA8ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwLDUpIj4KICAgIDxwYXRoCiAgICAgICBpZD0icGF0aDMxNzMiCiAgICAgICBzdHlsZT0iZmlsbDpub25lO3N0cm9rZTojOTk5OTk5O3N0cm9rZS13aWR0aDoxLjg1MTk2ODUzO3N0cm9rZS1saW5lY2FwOnJvdW5kO3N0cm9rZS1saW5lam9pbjpyb3VuZDtzdHJva2UtbWl0ZXJsaW1pdDo0O3N0cm9rZS1kYXNoYXJyYXk6bm9uZSIKICAgICAgIGQ9Ik0gMC45NTQxNDgzOCwwLjY4MTYwMzEgNS4wMzkwNjI1LDUuNDExNTM4NiA5LjEyMzk3NjYsMC42ODE2MDMxIgogICAgICAgIC8+CiAgPC9nPgo8L3N2Zz4K";

    var sheet = new Sheet();
    sheet.add(".modal_default_main", "border: 10px solid #ccc; max-width: 90%;");
    sheet.add(".modal_default_main:focus", "outline: none;");
    sheet.add(".modal_default_content", "padding: 10px 0px;");
    sheet.add(".modal_default_inner", "padding: 20px;");
    sheet.add(".modal_default_input", "padding: 10px 0px;");
    sheet.add(".modal_default_buttons", "margin-top: 10px;");
    sheet.add(".modal_default_buttons", "padding: 10px 0px;");
    sheet.add(".modal_default_form_item", "padding: 10px 0px; position: relative;");
    sheet.add(".modal_default_form_item_level1", "border-left: 2px solid #ccc; margin-left: 10px; padding-left: 20px;");
    sheet.add(".modal_default_form_item.modal_default_form_title", "font-size: 1.5rem; font-weight: bold;");
    sheet.add(".modal_default_form_item input[type=text]", "width: 100%; box-sizing: border-box;");
    sheet.add(".modal_default_form_item textarea", "width: 100%; height: 200px; box-sizing: border-box;");
    sheet.add(".modal_default_form_item input[type=select]", "width: 100%; box-sizing: border-box;");
    sheet.add(".modal_default_form_item label", "display: block;");
    sheet.add(".modal_default_form_item select", "width: 100%; box-sizing: border-box;");
    sheet.add(".modal_default_form_item_label", "margin: 2px 0px;");
    sheet.add(".modal_default_form_item_image img", "max-width: 100%; height: auto;");

    sheet.add(".modal_default_form_item_invalid", "");
    sheet.add(".modal_default_form_item_invalid_message", "position: absolute; right: 0px; top: 9px; background-color: red; color: #ffffff; padding: 2px; border-radius: 2px;");

    sheet.add(".modal_default_background", "opacity: 0.5; background-color: #000;");
    sheet.add(".modal_default_ok", "padding: 3px; width: 80px;");
    sheet.add(".modal_default_cancel", "padding: 3px; width: 80px;");

    sheet.add(".modal_default_form_item_date", "position: relative;");
    sheet.add(".modal_default_form_item_date:after", "content: ''; position: absolute; right: 7px; top: 50%; margin-top: 3px; width: 10px; height: 15px; background-image:url(" + iconCalendar + ")");

    if (typeof navigator !== "undefined" && navigator.userAgent.indexOf("Edge") !== -1) {
        sheet.add(".modal_default_form_item_date input::-ms-clear", "display: none;");
    }

    sheet.add(".modal_default_form_item_scrollable_scroll", "width: 100%; height: 200px; box-sizing: border-box; border: 1px solid #ccc; overflow-y: auto;");
    sheet.add(".modal_default_form_item_scrollable_scroll_content", "padding: 5px;");

    sheet.add(".modal_default_form_item_searchable", "position: relative;");
    sheet.add(".modal_default_form_item_searchable_icon", "");
    sheet.add(".modal_default_form_item_searchable_icon:after", "content:''; position: absolute; right: 5px; top: 50%; margin-top: -8px; width: 10px; height: 15px; background-image:url(" + iconExpand + ");");
    sheet.add(".modal_default_form_item_searchable_list", "box-sizing: border-box; border: 1px solid #999; max-height: 150px; overflow-y: auto;");
    sheet.add(".modal_default_form_item_searchable_list_item", "background: white; padding: 2px; cursor: default;");
    sheet.add(".modal_default_form_item_searchable_list_item_highlight", "background: #ccc;");

    sheet.add(".modal_default_form_item_time", "position: relative;");
    sheet.add(".modal_default_form_item_time_icon", "");
    sheet.add(".modal_default_form_item_time_icon:after", "content:''; position: absolute; right: 5px; top: 50%; margin-top: -8px; width: 10px; height: 15px; background-image:url(" + iconExpand + ");");
    sheet.add(".modal_default_form_item_time_list", "box-sizing: border-box; border: 1px solid #999; max-height: 150px; overflow-y: auto;");
    sheet.add(".modal_default_form_item_time_list_item", "background: white; padding: 2px; cursor: default;");
    sheet.add(".modal_default_form_item_time_list_item_highlight", "background: #ccc;");

    sheet.add(".modal_default_form_item_datetime_parent", "display: flex;");
    sheet.add(".modal_default_form_item_datetime .modal_default_form_item_time_main", "margin-left: 5px;");
    sheet.add(".modal_default_form_item_datetime input[type='text'].modal_default_input_date ", "");

    sheet.add(".modal_default_form_item_tabular_main", "margin-top: 10px;");
    sheet.add(".modal_default_form_item_tabular_table", "display: table; width: 100%; xbackground-color: #fff; border-collapse: collapse;");
    sheet.add(".modal_default_form_item_tabular_tbody", "display: table-row-group;");
    sheet.add(".modal_default_form_item_tabular_row", "display: table-row;");
    sheet.add(".modal_default_form_item_tabular_row.modal_default_form_item_tabular_header", "");  // used to be bold
    sheet.add(".modal_default_form_item_tabular_cell.modal_default_form_item_tabular_rowaction", "padding: 0px; width: 23px;");  // _delete: width + marginLeft
    sheet.add(".modal_default_form_item_tabular_cell", "display: table-cell; border: 0px; padding: 2px 2px 2px 0px; cursor: default; vertical-align: bottom;");
    sheet.add(".modal_default_form_item_tabular_header .modal_default_form_item_tabular_cell", "padding-left: 0px; padding-bottom: 0px;");
    sheet.add(".modal_default_form_item_tabular_table input[type=text], .modal_default_form_item_tabular_table input[type=number]", "width:100%; box-sizing: border-box;");
    sheet.add(".modal_default_form_item_tabular_table select", "width:100%; height:100%; box-sizing: border-box;");
    sheet.add(".modal_default_form_item_tabular_plus", "display: inline-block; background-color: #ccc; color: white; width: 20px; height: 20px; border-radius: 10px; box-sizing: border-box; position: relative; margin-left: 3px; margin-top: 3px; cursor: pointer;");
    sheet.add(".modal_default_form_item_tabular_plus:after", "content: ''; position: absolute; left: 5px; top: 5px; width: 10px; height: 10px;   background-image: url(\"data:image/svg+xml;base64,PHN2ZyB3aWR0aD0nMTAnIGhlaWdodD0nMTAnIHhtbG5zPSdodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2Zyc+PHBhdGggZD0nTSA1LjAgMC41IEwgNS4wIDkuNSBNIDAuNSA1LjAgTCA5LjUgNS4wJyBzdHlsZT0nZmlsbDpub25lO3N0cm9rZTojZmZmZmZmO3N0cm9rZS13aWR0aDoyO3N0cm9rZS1saW5lam9pbjpyb3VuZDtzdHJva2UtbGluZWNhcDpidXR0JyAvPjwvc3ZnPg==\")");
    sheet.add(".modal_default_form_item_tabular_delete", "display: inline-block; background-color: #ccc; color: white; width: 20px; height: 20px; border-radius: 10px; box-sizing: border-box; position: relative; margin-left: 3px; margin-top: 3px; cursor: pointer;");
    sheet.add(".modal_default_form_item_tabular_delete:after", "content: ''; position: absolute; left: 5px; top: 5px; width: 10px; height: 10px;   background-image: url(\"data:image/svg+xml;base64,PHN2ZyB3aWR0aD0nMTAnIGhlaWdodD0nMTAnIHhtbG5zPSdodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2Zyc+PHBhdGggZD0nTSAwLjUgMC41IEwgOS41IDkuNSBNIDAuNSA5LjUgTCA5LjUgMC41JyBzdHlsZT0nZmlsbDpub25lO3N0cm9rZTojZmZmZmZmO3N0cm9rZS13aWR0aDoyO3N0cm9rZS1saW5lam9pbjpyb3VuZDtzdHJva2UtbGluZWNhcDpidXR0JyAvPjwvc3ZnPg==\")");
    sheet.add(".modal_default_form_item_tabular_disabled .modal_default_form_item_tabular_plus", "display: none;");
    sheet.add(".modal_default_form_item_tabular_plus_max.modal_default_form_item_tabular_plus", "display: none;");
    sheet.add(".modal_default_form_item_tabular_disabled .modal_default_form_item_tabular_delete", "visibility: hidden;");
    sheet.add(".modal_default_form_item_tabular_empty", "height: 1px; margin: 5px 23px 5px 0px; background-color: #ccc;");
    sheet.add(".modal_default_form_item_tabular_spacer .modal_default_form_item_tabular_cell", "padding: 0px;");

    sheet.add(".modal_min_main", "border: 1px solid #ccc; max-width: 90%;");
    sheet.add(".modal_min_background", "opacity: 0.5; background-color: #000;");
    sheet.add(".modal_min_ok", "padding: 3px 10px;");
    sheet.add(".modal_min_cancel", "padding: 3px 10px;");


    sheet.add(".navigator_modal_main", "border-left: 1px solid #c0c0c0;border-right: 1px solid #c0c0c0;border-bottom: 1px solid #c0c0c0;background-color: white;color: #000000; box-sizing: content-box;");
    sheet.add(".navigator_modal_main *, .navigator_modal_main *:before, .navigator_modal_main *:after", "box-sizing: content-box;");
    sheet.add(".navigator_modal_month", "font-size: 11px;");
    sheet.add(".navigator_modal_day", "color: black;");
    sheet.add(".navigator_modal_weekend", "background-color: #f0f0f0;");
    sheet.add(".navigator_modal_dayheader", "color: black;");
    sheet.add(".navigator_modal_line", "border-bottom: 1px solid #c0c0c0;");
    sheet.add(".navigator_modal_dayother", "color: gray;");
    sheet.add(".navigator_modal_todaybox", "border: 1px solid red;");
    sheet.add(".navigator_modal_title, .navigator_modal_titleleft, .navigator_modal_titleright", 'border-top: 1px solid #c0c0c0;border-bottom: 1px solid #c0c0c0;color: #333;background: #f3f3f3;');
    sheet.add(".navigator_modal_busy", "font-weight: bold;");
    sheet.add(".navigator_modal_cell", "text-align: center;");
    sheet.add(".navigator_modal_select .navigator_modal_cell_box", "background-color: #FFE794; opacity: 0.5;");
    sheet.add(".navigator_modal_title", "text-align: center;");
    sheet.add(".navigator_modal_titleleft, .navigator_modal_titleright", "text-align: center;");
    sheet.add(".navigator_modal_dayheader", "text-align: center;");
    sheet.add(".navigator_modal_weeknumber", "text-align: center;");
    sheet.add(".navigator_modal_cell_text", "cursor: pointer;");

    sheet.commit();

    DayPilot.Modal = function(options) {

        // default values
        this.autoFocus = true;
        this.focus = null; // field to be focused - field id as string or {id, value}
        this.autoStretch = true;  // height will be increased automatically to avoid scrollbar, until this.maxHeight is reached
        this.autoStretchFirstLoadOnly = false;
        this.className = null;
        this.theme = "modal_default";
        this.disposeOnClose = true;
        this.dragDrop = true;
        this.loadingHtml = null;
        this.maxHeight = null; // if not set, it will stretch until the bottom space is equal to this.top
        this.scrollWithPage = true;  // modal window will scroll with the page
        this.useIframe = true; // only for showHtml()
        this.zIndex = 99999;

        this.left = null;  // will be centered if null
        this.width = 600;
        this.top = 20;
        this.height = 200;  // see also autoStretch
        this.locale = null; // used for DayPilot.Modal.form() items with "date" type

        // event handler
        this.closed = null;
        this.onClose = null;
        this.onClosed = null;
        this.onShow = null;

        // internal
        var This = this;
        this.id = '_' + new Date().getTime() + 'n' + (Math.random() * 10);
        this._registered = false;

        // drag&drop
        this._start = null;
        this._coords = null;

        this.showHtml = function(html) {

            if (DayPilot.ModalStatic.displayed(this)) {
                throw "This modal dialog is already displayed.";
            }

            if (!this.div) {
                this._create();
            }
            this._update();

            if (this.useIframe) {
                var delayed = function(p, innerHTML) {
                    return function() {
                        p.setInnerHTML(p.id + "iframe", innerHTML);
                    };
                };

                window.setTimeout(delayed(this, html), 0);
            }
            else {
                if (html.nodeType) {
                    this.div.appendChild(html);
                }
                else {
                    this.div.innerHTML = html;
                }
            }

            this._update();
            this._register();
            this._doShow();

        };

        this.showUrl = function(url) {

            if (DayPilot.ModalStatic.displayed(this)) {
                throw "This modal dialog is already displayed.";
            }

            //this.useIframe = true; // forced

            if (this.useIframe) {
                if (!this.div) {
                    this._create();
                }

                var loadingHtml = this.loadingHtml;
                if (loadingHtml) {
                    this.iframe.src = "about:blank";
                    this.setInnerHTML(this.id + "iframe", loadingHtml);
                }

                this.re(this.iframe, "load", this._onIframeLoad);

                this.iframe.src = url;
                //this.iframe.contentWindow.modal = This;

                this._update();
                this._register();
                this._doShow();
            }
            else {
                This._ajax({
                    "url": url,
                    "success": function(args) {
                        var html = args.request.responseText;
                        This.showHtml(html);
                    },
                    "error": function(args) {
                        This.showHtml("Error loading the modal dialog");
                    }
                });
            }

        };

        this._doShow = function() {
            if (typeof This.onShow === "function") {
                var args = {};
                args.root = This._body();
                args.modal = This;
                This.onShow(args);
            }
        };

        this._body = function() {
            return This.iframe ? This.iframe.contentWindow.document : This.div;
        };

        this._ajax = function(object) {
            var req = new XMLHttpRequest();
            if (!req) {
                return;
            }

            var method = object.method || "GET";
            var success = object.success || function() {};
            var error = object.error || function() {};
            var data = object.data;
            var url = object.url;

            req.open(method, url, true);
            req.setRequestHeader('Content-type', 'text/plain');
            req.onreadystatechange = function() {
                if (req.readyState !== 4)
                    return;
                if (req.status !== 200 && req.status !== 304) {
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
                success(args);
            };
            if (req.readyState === 4) {
                return;
            }
            if (typeof data === 'object') {
                data = JSON.stringify(data);
            }
            req.send(data);
        };

        this._update = function() {

            delete this.result;

            var win = window;
            var doc = document;

            var scrollY = win.pageYOffset ? win.pageYOffset : ((doc.documentElement && doc.documentElement.scrollTop) ? doc.documentElement.scrollTop : doc.body.scrollTop);

            var height = function() {
                return This._windowRect().y;
            };

            //this.hideDiv.style.height = height() + "px";
            if (this.theme) {
                this.hideDiv.className = this.theme + "_background";
            }
            if (this.zIndex) {
                this.hideDiv.style.zIndex = this.zIndex;
            }
            this.hideDiv.style.display = '';

            window.setTimeout(function() {
                if (This.hideDiv) {
                    This.hideDiv.onclick = function() {
                        This.hide({"backgroundClick": true});
                    };
                }
            }, 500);

            if (this.theme) {
                this.div.className = this.theme + "_main";
            }
            else {
                this.div.className = "";
            }

            if (this.className) {
                this.div.className += " " + this.className;
            }
            if (this.left) {
                this.div.style.left = this.left + "px";
            }
            else {
                this.div.style.marginLeft = '-' + Math.floor(this.width / 2) + "px";  // '-45%'
            }
            this.div.style.position = 'absolute';
            this.div.style.boxSizing = "content-box";
            this.div.style.top = (scrollY + this.top) + 'px';
            this.div.style.width = this.width + 'px';  // '90%'
            if (this.zIndex) {
                this.div.style.zIndex = this.zIndex;
            }

            if (this.height) {
                if (this.useIframe || !this.autoStretch) {
                    this.div.style.height = this.height + 'px';
                }
                else {
                    this.div.style.height = '';
                }
            }
            if (this.useIframe && this.height) {
                this.iframe.style.height = (this.height) + 'px';
            }

            this.div.style.display = '';

            this._updateHorizontal();

            // make sure it's there just once
            DayPilot.ModalStatic.remove(this);
            DayPilot.ModalStatic.list.push(this);

            /*
            if (this.iframe) {
            this.iframe.onload = null;
            }
            */
        };

        this._onIframeLoad = function() {
            This.iframe.contentWindow.modal = This;
            if (This.autoStretch) {
                This.stretch();
            }
        };

        this.stretch = function() {
            var height = function() {
                return This._windowRect().y;
            };

            var width = function() {
                return This._windowRect().x;
            };


            if (this.useIframe) {
                // width first
                var maxWidth = width() - 40;  // fixed 20px margin
                for (var w = this.width; w < maxWidth && this._hasHorizontalScrollbar(); w += 10) {
                    //this.iframe.style.width = (w) + 'px';
                    this.div.style.width = w + 'px';
                    this.div.style.marginLeft = '-' + Math.floor(w / 2) + "px";  //
                }

                // height
                var maxHeight = this.maxHeight || height() - 2 * this.top;
                for (var h = this.height; h < maxHeight && this._hasVerticalScrollbar(); h += 10) {
                    this.iframe.style.height = (h) + 'px';
                    this.div.style.height = h + 'px';
                }

                if (this.autoStretchFirstLoadOnly) {
                    this.ue(this.iframe, "load", this._onIframeLoad);
                }
            }
            else {
                this.div.style.height = '';
            }


        };

        this._hasHorizontalScrollbar = function() {
            var document = this.iframe.contentWindow.document;
            var root = document.compatMode === 'BackCompat' ? document.body : document.documentElement;

            var scrollWidth = root.scrollWidth;
            var children = document.body.children;
            for (var i = 0; i < children.length; i++) {
                var bottom = children[i].offsetLeft + children[i].offsetWidth;
                scrollWidth = Math.max(scrollWidth, bottom);
            }

            var isHorizontalScrollbar = scrollWidth > root.clientWidth;
            return isHorizontalScrollbar;

        };

        this._hasVerticalScrollbar = function() {
            var document = this.iframe.contentWindow.document;
            var root = document.compatMode === 'BackCompat' ? document.body : document.documentElement;

            var scrollHeight = root.scrollHeight;
            var children = document.body.children;
            for (var i = 0; i < children.length; i++) {
                var bottom = children[i].offsetTop + children[i].offsetHeight;
                scrollHeight = Math.max(scrollHeight, bottom);
            }

            var isVerticalScrollbar =  scrollHeight > root.clientHeight;
            //var isHorizontalScrollbar = root.scrollWidth > root.clientWidth;
            return isVerticalScrollbar;
        };

        this._windowRect = function() {
            var doc = document;

            if (doc.compatMode === "CSS1Compat" && doc.documentElement && doc.documentElement.clientWidth) {
                var x = doc.documentElement.clientWidth;
                var y = doc.documentElement.clientHeight;
                return { x: x, y: y };
            }
            else {
                var x = doc.body.clientWidth;
                var y = doc.body.clientHeight;
                return { x: x, y: y };
            }
        };

        this._register = function() {
            if (this._registered) {
                return;
            }
            this.re(window, 'resize', this._onWindowResize);
            this.re(window, 'scroll', this._onWindowScroll);

            if (this.dragDrop) {
                this.re(document, 'mousemove', this._onMouseMove);
                this.re(document, 'mouseup', this._onMouseUp);
            }
            this._registered = true;
        };

        this._unregister = function() {
            this.ue(window, 'resize', this._onWindowResize);
            this.ue(window, 'scroll', this._onWindowScroll);
            if (this.dragDrop) {
                this.ue(document, 'mousemove', this._onMouseMove);
                this.ue(document, 'mouseup', this._onMouseUp);
            }
            this._registered = false;
        };

        this._onDragStart = function(e) {
            if (e.target !== This.div) {
                return;
            }
            e.preventDefault();
            This.div.style.cursor = "move";
            This._maskIframe();
            This._coords = This.mc(e || window.event);
            This._start = { x: This.div.offsetLeft, y: This.div.offsetTop };

        };

        this._onMouseMove = function(e) {
            if (!This._coords) {
                return;
            }

            var e = e || window.event;
            var now = This.mc(e);

            var x = now.x - This._coords.x;
            var y = now.y - This._coords.y;

            //This.iframe.style.display = 'none';
            This.div.style.marginLeft = '0px';
            This.div.style.top = (This._start.y + y) + "px";
            This.div.style.left = (This._start.x + x) + "px";

        };

        this._onMouseUp = function(e) {
            // no drag&drop
            if (!This._coords) {
                return;
            }
            //This.iframe.style.display = '';
            This._unmaskIframe();
            This.div.style.cursor = null;

            This._coords = null;
        };

        this._maskIframe = function() {
            if (!this.useIframe) {
                return;
            }

            var opacity = 80;

            var mask = document.createElement("div");
            mask.style.backgroundColor = "#ffffff";
            mask.style.filter = "alpha(opacity=" + opacity + ")";
            mask.style.opacity = "0." + opacity;
            mask.style.width = "100%";
            mask.style.height = this.height + "px";
            mask.style.position = "absolute";
            mask.style.left = '0px';
            mask.style.top = '0px';

            this.div.appendChild(mask);
            this.mask = mask;
        };

        this._unmaskIframe = function() {
            if (!this.useIframe) {
                return;
            }

            this.div.removeChild(this.mask);
            this.mask = null;
        };

        this._onWindowResize = function() {
            This._updateTop();
            This._updateHorizontal();
        };

        this._onWindowScroll = function() {
            This._updateTop();
        };

        this._updateHorizontal = function() {
            if (This.left) {
                return;
            }

            if (!This.div) {
                return;
            }

            var width = This.div.offsetWidth;
            This.div.style.marginLeft = '-' + Math.floor(width / 2) + "px";  // '-45%'
        };

        this._updateTop = function() {
            if (!This.hideDiv) {
                return;
            }
            if (!This.div) {
                return;
            }
            if (This.hideDiv.style.display === 'none') {
                return;
            }
            if (This.div.style.display === 'none') {
                return;
            }

            var scrollY = This._parent.scrollY();


            //This.hideDiv.style.height = height() + "px";
            if (!This.scrollWithPage) {
                This.div.style.top = (scrollY + This.top) + 'px';
            }
        };

        this._parent = {};
        this._parent.container = function() {
            return This.container || document.body;
        };
        this._parent.scrollY = function() {
            var c = This._parent.container();
            if (c === document.body) {
                return window.pageYOffset ? window.pageYOffset : ((document.documentElement && document.documentElement.scrollTop) ? document.documentElement.scrollTop : document.body.scrollTop);
            }
            else {
                return c.scrollTop;
            }
        };

        // already available in common.js but this file should be standalone
        this.re = function(el, ev, func) {
            if (el.addEventListener) {
                el.addEventListener(ev, func, false);
            } else if (el.attachEvent) {
                el.attachEvent("on" + ev, func);
            }
        };

        // unregister event
        this.ue = function(el, ev, func) {
            if (el.removeEventListener) {
                el.removeEventListener(ev, func, false);
            } else if (el.detachEvent) {
                el.detachEvent("on" + ev, func);
            }
        };

        // mouse coords
        this.mc = function(ev) {
            if (ev.pageX || ev.pageY) {
                return { x: ev.pageX, y: ev.pageY };
            }
            return {
                x: ev.clientX + document.documentElement.scrollLeft,
                y: ev.clientY + document.documentElement.scrollTop
            };
        };

        // absolute element position on page
        this.abs = function(element) {
            var r = {
                x: element.offsetLeft,
                y: element.offsetTop
            };

            while (element.offsetParent) {
                element = element.offsetParent;
                r.x += element.offsetLeft;
                r.y += element.offsetTop;
            }

            return r;
        };

        this._create = function() {

            var container = This._parent.container();
            var isRoot = container === document.body;
            var position = isRoot ? "fixed" : "absolute";

            var hide = document.createElement("div");
            hide.id = this.id + "hide";
            hide.style.position = position;
            hide.style.left = "0px";
            hide.style.top = "0px";
            hide.style.right = "0px";
            hide.style.bottom = "0px";
            hide.oncontextmenu = function() { return false; };
            hide.onmousedown = function() { return false; };  // prevent selecting

            container.appendChild(hide);

            var div = document.createElement("div");
            div.id = this.id + 'popup';
            div.style.position = position;
            div.style.left = '50%';
            div.style.top = '0px';
            div.style.backgroundColor = 'white';
            div.style.width = "50px";
            div.style.height = "50px";
            if (this.dragDrop) {
                div.onmousedown = this._onDragStart;
            }
            div.addEventListener("keydown", function(e) {
                // prevent interaaction with the document using keyboard
                e.stopPropagation();
            });

            var defaultHeight = 50;

            var iframe = null;
            if (this.useIframe) {
                iframe = document.createElement("iframe");
                iframe.id = this.id + "iframe";
                iframe.name = this.id + "iframe";
                iframe.frameBorder = '0';
                iframe.style.width = '100%';
                iframe.style.height = defaultHeight + 'px';
                div.appendChild(iframe);
            }

            container.appendChild(div);

            this.div = div;
            this.iframe = iframe;
            this.hideDiv = hide;
        };

        this.setInnerHTML = function(id, innerHTML) {
            var frame = window.frames[id];

            var doc = frame.contentWindow || frame.document || frame.contentDocument;
            if (doc.document) {
                doc = doc.document;
            }

            if (doc.body == null) {       // null in IE
                doc.write("<body></body>");
            }

            if (innerHTML.nodeType) {
                doc.body.appendChild(innerHTML);
            }
            else {
                doc.body.innerHTML = innerHTML;
            }

            if (This.autoStretch) {
                if (!This.autoStretchFirstLoadOnly || !This._stretched) {
                    This.stretch();
                    This._stretched = true;
                }
            }
        };

        this.close = function(result) {
            this.result = result;
            this.hide();
        };

        this.closeSerialized = function() {
            var ref = This._body();
            var fields = ref.querySelectorAll("input, textarea, select");
            var result = {};
            for (var i = 0; i < fields.length; i++) {
                var field = fields[i];
                var name = field.name;
                if (!name) {
                    continue;
                }
                var value = field.value;
                /*if (field.picker) {
                    value = field.picker.date ? field.picker.date.toString() : null;
                }
                else*/ /*if (field.table) {
                    value = field.table.save();
                }
                else*/ /*if (field.searchable) {
                    value = field.searchable.selected && field.searchable.selected.id;
                }
                else *//*if (field.tagName === "SELECT") {
                    var option = field.options[field.selectedIndex];
                    if (option && typeof option._originalValue !== "undefined") {
                        value = option._originalValue;
                    }
                }
                else*/ /*if (field.type === "radio") {
                    if (!field.checked) {
                        continue;
                    }
                    value = field._originalValue;
                }
                else*/ /*if (field.type === "checkbox") {
                    value = field.checked;
                }*/
                result[name] = value;
            }
            This.close(result);
        };

        this.hide = function(options) {

            options = options || {};

            var args = {};
            args.backgroundClick = !!options.backgroundClick;
            args.result = this.result;
            args.canceled = typeof this.result === "undefined";
            args.preventDefault = function() {
                this.preventDefault.value = true;
            };

            if (typeof this.onClose === "function") {
                this.onClose(args);
                if (args.preventDefault.value) {
                    return;
                }
            }

            if (this.div) {
                this.div.style.display = 'none';
                this.hideDiv.style.display = 'none';
                if (!this.useIframe) {
                    this.div.innerHTML = null;
                }
            }

            // return focus to the main window (Firefox)
            window.focus();

            //DayPilot.ModalStatic = null;
            DayPilot.ModalStatic.remove(this);

            if (typeof this.onClosed === "function") {
                this.onClosed(args);
            }
            else if (this.closed) {
                this.closed();
            }

            delete this.result;

            if (this.disposeOnClose) {

                This._unregister();

                This._de(This.div);
                This._de(This.hideDiv);

                This.div = null;
                This.hideDiv = null;
                This.iframe = null;
            }
        };

        this._de = function(e) {
            if (!e) {
                return;
            }
            e.parentNode && e.parentNode.removeChild(e);
        };

        this._applyOptions = function() {
            if (!options) {
                return;
            }

            for (var name in options) {
                this[name] = options[name];
            }
        };

        this._applyOptions();

    };

    DayPilot.Modal.alert = function(message, options) {
        options = options || {};
        options.height = options.height || 40;
        options.useIframe = false;

        var okText = options.okText || "OK";
        var cancelText = options.cancelText || "Cancel";

        return DayPilot.getPromise(function(success, failure) {
            options.onClosed = function(args) {
                success(args);
                /*
                if (typeof args.result === "undefined") {
                    failure(args);
                }
                else {

                }*/
            };

            var modal = new DayPilot.Modal(options);

            var div = document.createElement("div");
            div.className = modal.theme + "_inner";
            // div.style.padding = "10px";

            var text = document.createElement("div");
            text.className = modal.theme + "_content";
            text.innerHTML = message;

            var buttons =  document.createElement("div");
            buttons.className = modal.theme + "_buttons";
            // buttons.style.margin = "10px 0px";

            var buttonOK = document.createElement("button");
            buttonOK.innerText = okText;
            buttonOK.className = modal.theme + "_ok";
            buttonOK.onclick = function(e) {
                DayPilot.ModalStatic.close("OK");
            };

            buttons.appendChild(buttonOK);

            div.appendChild(text);
            div.appendChild(buttons);

            //var buttons = "<div style='margin: 10px 0px'><button onclick='parent.DayPilot.ModalStatic.close();' autofocus>OK</button></div>";

            modal.showHtml(div);

            if (modal.autoFocus) {
                buttonOK.focus();
            }
        });

    };

    DayPilot.Modal.confirm = function(message, options) {
        options = options || {};
        options.height = options.height || 40;
        options.useIframe = false;

        var okText = options.okText || "OK";
        var cancelText = options.cancelText || "Cancel";

        return DayPilot.getPromise(function(success, failure) {
            options.onClosed = function(args) {
                success(args);
            };

            var modal = new DayPilot.Modal(options);

            var div = document.createElement("div");
            div.className = modal.theme + "_inner";
            // div.style.padding = "10px";

            var text = document.createElement("div");
            text.className = modal.theme + "_content";
            text.innerHTML = message;

            var buttons =  document.createElement("div");
            buttons.className = modal.theme + "_buttons";
            // buttons.style.margin = "10px 0px";

            var buttonOK = document.createElement("button");
            buttonOK.innerText = okText;
            buttonOK.className = modal.theme + "_ok";
            buttonOK.onclick = function(e) {
                DayPilot.ModalStatic.close("OK");
            };

            var space = document.createTextNode(" ");

            var buttonCancel = document.createElement("button");
            buttonCancel.innerText = cancelText;
            buttonCancel.className = modal.theme + "_cancel";
            buttonCancel.onclick = function(e) {
                DayPilot.ModalStatic.close();
            };

            buttons.appendChild(buttonOK);
            buttons.appendChild(space);
            buttons.appendChild(buttonCancel);

            div.appendChild(text);
            div.appendChild(buttons);

            modal.showHtml(div);

            if (modal.autoFocus) {
                buttonOK.focus();
            }

        });
    };


    DayPilot.Modal.prompt = function(message, defaultValue, options) {
        if (typeof defaultValue === "object") {
            options = defaultValue;
            defaultValue = "";
        }

        options = options || {};
        options.height = options.height || 40;
        options.useIframe = false;

        var okText = options.okText || "OK";
        var cancelText = options.cancelText || "Cancel";

        var inputText = defaultValue || "";

        return DayPilot.getPromise(function(success, failure) {
            options.onClosed = function(args) {
                success(args);
            };

            var modal = new DayPilot.Modal(options);

            var div = document.createElement("div");
            div.className = modal.theme + "_inner";

            var text = document.createElement("div");
            text.className = modal.theme + "_content";
            text.innerHTML = message;

            var inputs = document.createElement("div");
            inputs.className = modal.theme + "_input";
            //inputs.style.margin = "10px 0px";

            var input = document.createElement("input");
            input.value = inputText;
            input.style.width = "100%";
            input.onkeydown = function(e) {
                var letcontinue = false;
                switch (e.keyCode) {
                    case 13:
                        modal.close(this.value);
                        break;
                    case 27:
                        modal.close();
                        break;
                    default:
                        letcontinue = true;
                        break;
                }
                if (!letcontinue) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            };

            inputs.appendChild(input);

            var buttons =  document.createElement("div");
            buttons.className = modal.theme + "_buttons";
            //buttons.style.margin = "10px 0px";

            var buttonOK = document.createElement("button");
            buttonOK.innerText = okText;
            buttonOK.className = modal.theme + "_ok";
            buttonOK.onclick = function(e) {
                modal.close(input.value);
            };

            var space = document.createTextNode(" ");

            var buttonCancel = document.createElement("button");
            buttonCancel.innerText = cancelText;
            buttonCancel.className = modal.theme + "_cancel";
            buttonCancel.onclick = function(e) {
                modal.close();
            };

            buttons.appendChild(buttonOK);
            buttons.appendChild(space);
            buttons.appendChild(buttonCancel);


            div.appendChild(text);
            div.appendChild(inputs);
            div.appendChild(buttons);

            modal.showHtml(div);

            if (modal.autoFocus) {
                input.focus();
            }

        });
    };

    var isArray = function(arg) {
        return Object.prototype.toString.call(arg) === '[object Array]';
    };

    function setPathValue(target, path, value) {
        var iodot = path.indexOf(".");
        if (iodot === -1) {
            if (path !== "__proto__" && path !== "constructor") {
                target[path] = value;
            }
            return;
        }
        var segment = path.substring(0, iodot);
        if (segment === "__proto__" || segment === "constructor") {
            return;
        }
        var remainder = path.substring(iodot + 1);
        var child = target[segment];
        if (typeof child !== "object" || child === null) {
            target[segment] = {};
            child = target[segment];
        }
        setPathValue(child, remainder, value);
    }

    // form = array of items
    // data = object with properties
    // options = standard modal properties
    // DayPilot.Modal.form([]);  // form only - new data
    // DayPilot.Modal.form({});  // data only - automatic form
    //
    DayPilot.Modal.form = function(form, data, options) {
        if (arguments.length === 1) {
            var arg = form;
            var isa = isArray(arg);

            if (isa) {
                data = {};
            }
            else if (typeof arg === "object") {
                data = form;
                form = [];
                for (var name in data) {
                    var item = {};
                    item.name = name;
                    item.id = name;
                    form.push(item);
                }
            }
            else {
                throw "Invalid DayPilot.Modal.form() parameter";
            }

        }

        // make a copy
        var opts = {};
        for (var name in options) {
            opts[name] = options[name];
        }

        // options = options || {};
        opts.height = opts.height || 40;
        opts.useIframe = false;

        /*        if (typeof opts.autoFocus === "undefined") {
                    opts.autoFocus = false;
                }*/

        var okText = opts.okText || "OK";
        var cancelText = opts.cancelText || "Cancel";

        // var message = opts.message || "";

        return DayPilot.getPromise(function(success, failure) {
            opts.onClosed = function(args) {

                if (args.result) {
                    // deep copy
                    var mergedResult = JSON.parse(JSON.stringify(data));

                    // unflatten
                    for (var name in args.result) {
                        setPathValue(mergedResult, name, args.result[name]);
                    }
                    args.result = mergedResult;
                }

                success(args);
            };

            var modal = new DayPilot.Modal(opts);

            var div = document.createElement("div");
            div.className = modal.theme + "_inner";

            var inputs = document.createElement("div");
            inputs.className = modal.theme + "_input";

            var f = new Form({
                theme: modal.theme,
                form: form,
                data: data,
                zIndex: modal.zIndex,
                locale: modal.locale,
                plugins: modal.plugins,
                onKey: function(args) {
                    switch (args.key) {
                        case "Enter":
                            // modal.closeSerialized();
                            // modal.close(f.serialize());
                            if (f.validate()) {
                                modal.close(f.serialize());
                            }
                            break;
                        case "Escape":
                            modal.close();
                            break;
                    }
                },
                onChange: function(args) {
                    if (typeof modal.onChange === "function") {
                        modal.onChange(args);
                    }
                }
            });
            var el = f.create();

            inputs.append(el);

            var buttons =  document.createElement("div");
            buttons.className = modal.theme + "_buttons";

            var buttonOK = document.createElement("button");
            buttonOK.innerText = okText;
            buttonOK.className = modal.theme + "_ok";

            if (opts.okDisabled) {
                buttonOK.disabled = true;
            }
            buttonOK.onclick = function(e) {
                if (f.validate()) {
                    modal.close(f.serialize());
                }
                // modal.closeSerialized();
            };

            var space = document.createTextNode(" ");

            var buttonCancel = document.createElement("button");
            buttonCancel.innerText = cancelText;
            buttonCancel.className = modal.theme + "_cancel";
            buttonCancel.onclick = function(e) {
                modal.close();
            };
            buttonCancel.onmousedown = function(e) {
                f.canceling = true;
            };

            buttons.appendChild(buttonOK);
            buttons.appendChild(space);
            buttons.appendChild(buttonCancel);


            // div.appendChild(text);
            div.appendChild(inputs);
            div.appendChild(buttons);

            modal.showHtml(div);

            modal.div.setAttribute("tabindex", "-1");
            modal.div.addEventListener("keydown", function(e) {
                switch (e.keyCode) {
                    case 27:
                        modal.close();
                        break;
                    case 13:
                        if (f.validate()) {
                            modal.close(f.serialize());
                        }
                        // modal.closeSerialized();
                        break;
                }
            });

            if (modal.focus) {
                var toBeFocused = null;
                if (typeof modal.focus === "object") {
                    var id = modal.focus.id;
                    var value = modal.focus.value;
                    toBeFocused = f.findViewById(id, value);
                }
                else if (typeof modal.focus === "string") {
                    toBeFocused = f.findViewById(modal.focus)
                }
                if (toBeFocused) {
                    toBeFocused.focus();
                }
            }
            else {
                var first = f.firstFocusable();
                if (modal.autoFocus && first) {
                    first.focus();
                }
                else {
                    modal.div.focus();
                }
            }

        });
    };

    DayPilot.Modal.close = function(result) {
        var opener = DayPilot.Modal.opener();
        if (!opener) {
            return;
        }
        opener.close(result);
    };

    DayPilot.Modal.stretch = function(result) {
        var opener = DayPilot.Modal.opener();
        if (!opener) {
            throw "Unable to find the opener DayPilot.Modal instance.";
        }
        opener.stretch();
    };

    DayPilot.Modal.closeSerialized = function() {
        var last = DayPilot.Modal.opener() || DayPilot.ModalStatic.last();
        if (last) {
            last.closeSerialized();
        }
    };

    DayPilot.Modal.opener = function() {
        if (typeof DayPilot !== "undefined" && typeof DayPilot.ModalStatic !== "undefined" && DayPilot.ModalStatic.list.length > 0) {
            return DayPilot.ModalStatic.list[DayPilot.ModalStatic.list.length - 1];
        }
        return parent && parent.DayPilot && parent.DayPilot.ModalStatic && parent.DayPilot.ModalStatic.list[parent.DayPilot.ModalStatic.list.length - 1];
    };

    DayPilot.Modal.Experimental = {};
    DayPilot.Modal.Experimental.Form = Form;

    if (typeof DayPilot.getPromise === "undefined") {
        DayPilot.getPromise = function(f) {
            if (typeof Promise !== 'undefined') {
                return new Promise(f);
            }

            DayPilot.Promise = function(f) {
                var p = this;

                this.then = function(onFulfilled, onRejected) {
                    onFulfilled = onFulfilled || function() {};
                    onRejected = onRejected || function() {};
                    f(onFulfilled, onRejected);
                    return DayPilot.getPromise(f);
                };

                this['catch'] = function(onRejected) {
                    p.then(null, onRejected);
                    return DayPilot.getPromise(f);
                };
            };

            return new DayPilot.Promise(f);

        };
    }

    // end of modal.js

    // form.js -> 2877

    var Form = function (options) {

        // properties
        this.form = [];
        this.data = {};
        this.theme = "form_default";
        this.zIndex = 99999;
        this.locale = "en-us";
        this.plugins = {};

        // events
        this.onKey = null;

        // state
        this._rows = [];
        this._newRows = null;
        this.canceling = false;

        this._validationTimeouts = [];

        // view
        this._views = [];
        this._div = null;

        options = options || {};

        for (var name in options) {
            this[name] = options[name];
        }
    };

    Form.prototype.create = function () {
        this.load();
        this.render();

        return this._div;
    };

    Form.prototype.render = function () {
        var form = this;
        this._div = document.createElement("div");
        this._rows.forEach(function (row) {
            form.createView(row);
        });
        this.applyState();
    };

    Form.prototype.createView = function (row) {
        var theme = this.theme;
        var form = this;

        var div = document.createElement("div");
        div.className = theme + "_form_item " + theme + "_form_item_level" + row.level;
        if (!row.interactive && row.type === "title") {
            /*
                  if (row.type === "title") {
                    div.className += " " + theme + "_form_title";
                  }
            */
            div.className += " " + theme + "_form_title";
        }
        else {
            div.className += " " + theme + "_form_item_" + row.type;
        }
        if (row.data.cssClass) {
            div.className += " " + row.data.cssClass;
        }

        if (!row.isValue) {
            var label = document.createElement("div");
            label.className = theme + "_form_item_label";
            label.innerText = row.text;
            div.appendChild(label);
        }

        var interactive = this.createInteractive(row);
        interactive.onInput = function(options) {
            options = options || {};
            form._validateInteractive(interactive, {
                "debounce": !options.immediate
            });
            if (typeof form.onChange === "function") {
                var args = {};
                args.result = form.serialize();
                form.onChange(args);
            }
        };
        interactive.onBlur = function() {
            if (!form.canceling) {
                form._validateInteractive(interactive);
            }
        };
        interactive.apply(row);
        interactive._div = div;
        interactive.row = row;

        if (interactive.element) {
            div.appendChild(interactive.element);
        }

        this._views.push(interactive);

        this._div.appendChild(div);

    };

    Form.prototype.validate = function() {
        var form = this;
        var valid = true;
        this._views.forEach(function(interactive) {
            var iv = form._validateInteractive(interactive);
            valid = valid && iv;
        });
        return valid;
    };

    Form.prototype._validateInteractive = function(interactive, options) {
        options = options || {};
        var debounce = options.debounce;
        var silent = options.silent;


        var row = interactive.row;
        var valid = true;

        var onValidate = typeof row.data.onValidate === "function" ? row.data.onValidate : null;
        var validate = typeof  row.data.validate === "function" ? row.data.validate : null;  // legacy

        var validateHandler = onValidate || validate;

        if (validateHandler) {

            var args = {};
            args.valid = true;
            args.value = interactive.save()[row.field];
            args.message = "Error";
            args.values = this.serialize();  // legacy
            args.result = this.serialize();

            validateHandler(args);

            var cssClassInvalid = this.theme + "_form_item_invalid";
            var cssClassMessage = this.theme + "_form_item_invalid_message";
            if (args.valid) {
                clearTimeout(this._validationTimeouts[row.field]);

                if (interactive._errorMsg) {
                    interactive._errorMsg.remove();
                    interactive._errorMsg = null;
                }
                interactive._div.classList.remove(cssClassInvalid);
            }
            else {

                function showInvalid() {
                    if (interactive._errorMsg) {
                        interactive._errorMsg.remove();
                        interactive._errorMsg = null;
                    }

                    interactive._div.classList.add(cssClassInvalid);
                    var msg = document.createElement("div");
                    msg.classList.add(cssClassMessage);
                    msg.innerText = args.message;

                    interactive._errorMsg = msg;

                    interactive._div.appendChild(msg);
                }

                if (!silent) {
                    if (debounce) {

                        var debounceDelay = 1000;

                        clearTimeout(this._validationTimeouts[row.field]);

                        this._validationTimeouts[row.field] = setTimeout(function() {
                            showInvalid();
                        }, debounceDelay);
                    }
                    else {
                        showInvalid();
                    }

                }

            }
            valid = args.valid;
        }
        return valid;
    };

    Form.prototype.load = function () {
        // transform this.form + this.data into state (_rows)
        var t = this;
        this.form.forEach(function (item) {
            t.processFormItem(item, 0);
        });

        var flat;
        // sanity check (especially for circular references)
        try {
            var stringified = JSON.stringify(this.data);
            var rebuilt = JSON.parse(stringified);
            flat = flatten(rebuilt);
        }
        catch (e) {
            throw new Error("The 'data' object is not serializable (it may contain circular dependencies): " + e);
        }

        // set values
        for (var name in flat) {
            this.setValue(name, flat[name]);
        }

        // set state depending on values
        // this.updateDependentState();
    };

    Form.prototype.setValue = function (name, value) {
        this._rows.forEach(function (row) {
            row.applyValue(name, value);
        });
    };

    Form.prototype.updateDependentState = function () {
        var form = this;
        var enabled = [true];

        var source = this._newRows ? this._newRows : this._rows;

        source.forEach(function (row) {

            var updatedRow = form.updateState(row, {
                enabled: enabled[row.level] && !row.data.disabled
            });

            if (updatedRow.isValue) {
                enabled[updatedRow.level + 1] = updatedRow.enabled && updatedRow.checked;
            }
        });
    };

    Form.prototype.processFormItem = function (item, level) {
        var form = this;
        var type = this.getFieldType(item);

        var rows = [];

        if (type === "radio") {

            if (item.name) {
                var row = new RowModel();
                row.field = item.id;
                row.data = item;
                row.level = level;
                row.type = "label";
                row.interactive = false;
                row.text = item.name;
                form._rows.push(row);
                rows.push(row);
            }

            item.options.forEach(function (option) {
                var row = new RowModel();
                row.field = item.id;
                row.data = option;
                row.level = level;
                row.type = type;
                row.isValue = true;
                row.text = option.name;
                row.resolved = option.id;
                form._rows.push(row);
                rows.push(row);

                if (option.children) {
                    option.children.forEach(function (child) {
                        var childRows = form.processFormItem(child, level + 1);
                        rows = rows.concat(childRows);
                    })
                }
            });
        }
        else if (type === "title") {
            var row = new RowModel();
            row.field = item.id;
            row.data = item;
            row.level = level;
            row.type = type;
            row.interactive = false;
            row.text = item.name;
            form._rows.push(row);
            rows.push(row);
        }
        else if (type === "image") {
            var row = new RowModel();
            row.isValue = true;
            row.field = item.id;
            row.data = item;
            row.level = level;
            row.type = type;
            row.interactive = false;
            row.text = null;
            form._rows.push(row);
            rows.push(row);
        }
        else if (type === "html") {
            var row = new RowModel();
            row.isValue = true;
            row.field = item.id;
            row.data = item;
            row.level = level;
            row.type = type;
            row.interactive = false;
            row.text = null;
            form._rows.push(row);
            rows.push(row);
        }
        else if (type === "scrollable") {
            var row = new RowModel();
            row.isValue = true;
            row.field = item.id;
            row.data = item;
            row.level = level;
            row.type = type;
            row.interactive = false;
            row.text = null;
            form._rows.push(row);
            rows.push(row);
        }
        else {
            var row = new RowModel();
            row.field = item.id;
            row.data = item;
            row.level = level;
            row.type = type;
            row.text = item.name;
            row.children = [];
            form._rows.push(row);
            rows.push(row);
        }

        if (type === "checkbox") {
            row.isValue = true;
            row.resolved = true;

            if (item.children) {
                item.children.forEach(function (child) {
                    var childRows = form.processFormItem(child, level + 1);
                    rows = rows.concat(childRows);
                })
            }
        }

        return rows;

    };

    Form.prototype.doOnKey = function (key) {
        if (typeof this.onKey === "function") {
            var args = {
                key: key
            };
            this.onKey(args);
        }
    };

    Form.prototype.createInteractive = function (row) {
        var form = this;
        var views = {
            "label": function () {
                return new Interactive();
            },
            "title": function () {
                return new Interactive();
            },
            "image": function() {
                var interactive = new Interactive();

                var image = document.createElement("img");
                image.src = row.data.image;

                interactive.element = image;

                return interactive;
            },
            "html": function() {
                var interactive = new Interactive();

                var div = document.createElement("div");
                if (typeof row.data.text === "string") {
                    div.innerText = row.data.text;
                }
                else if (typeof row.data.html === "string") {
                    div.innerHTML = row.data.html;
                }

                interactive.element = div;

                return interactive;
            },
            "scrollable": function() {
                var interactive = new Interactive();

                var scroll = document.createElement("div");
                scroll.className = form.theme + "_form_item_scrollable_scroll";

                if (row.data.height) {
                    scroll.style.height = row.data.height + "px";
                }

                var div = document.createElement("div");
                div.className = form.theme + "_form_item_scrollable_scroll_content";
                if (typeof row.data.text === "string") {
                    div.innerText = row.data.text;
                }
                else if (typeof row.data.html === "string") {
                    div.innerHTML = row.data.html;
                }

                scroll.appendChild(div);

                interactive.element = scroll;

                return interactive;
            },
            "text": function () {
                var interactive = new Interactive();
                interactive.apply = function (row) {
                    interactive.row = row;

                    var input = interactive.element;
                    input.value = row.value;
                    input.disabled = !row.enabled;
                };

                var input = document.createElement("input");
                input.name = row.field;
                input.type = "text";
                input.autocomplete = "off";
                input.onkeydown = function (e) {
                    var letcontinue = false;
                    switch (e.keyCode) {
                        case 13:
                            form.doOnKey("Enter");
                            break;
                        case 27:
                            form.doOnKey("Escape");
                            break;
                        default:
                            letcontinue = true;
                            break;
                    }
                    if (!letcontinue) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                };

                input.oninput = function(e) {
                    interactive.onInput();
                };
                input.onblur = function(e) {
                    interactive.onBlur();
                }

                interactive.element = input;
                interactive.canFocus = function() {
                    return !interactive.element.disabled;
                };
                interactive.focus = function () {
                    interactive.element.focus();
                    interactive.element.setSelectionRange(0, interactive.element.value.length);
                };
                interactive.save = function() {
                    var result = {};
                    result[row.field] = input.value;
                    return result;
                };

                return interactive;
            },
            "textarea": function () {
                var interactive = new Interactive();
                interactive.apply = function (row) {
                    interactive.row = row;

                    var input = interactive.element;
                    input.value = row.value;
                    input.disabled = !row.enabled;
                };

                var textarea = document.createElement("textarea");
                textarea.name = row.field;
                if (row.data.height) {
                    textarea.style.height = row.data.height + "px";
                }
                // input.type = "text";
                textarea.onkeydown = function (e) {
                    var letcontinue = false;
                    switch (e.keyCode) {
                        case 13:
                            // form.doOnKey("Enter");
                            if (e.ctrlKey || e.metaKey) {
                                form.doOnKey("Enter");
                            }
                            letcontinue = false;
                            break;
                        case 27:
                            form.doOnKey("Escape");
                            break;
                        default:
                            letcontinue = true;
                            break;
                    }
                    if (!letcontinue) {
                        // e.preventDefault();
                        e.stopPropagation();
                    }
                };

                textarea.oninput = function(e) {
                    interactive.onInput();
                };
                textarea.onblur = function(e) {
                    interactive.onBlur();
                }

                interactive.element = textarea;
                interactive.canFocus = function() {
                    return !interactive.element.disabled;
                };
                interactive.focus = function () {
                    interactive.element.focus();
                    interactive.element.setSelectionRange(0, 0);
                };
                interactive.save = function() {
                    var result = {};
                    result[row.field] = textarea.value;
                    return result;
                };

                return interactive;
            },
            "date": function () {
                var interactive = new Interactive();
                interactive.apply = function (row) {
                    interactive.row = row;
                    var input = interactive.element;
                    var picker = interactive.picker;

                    if (row.data.dateFormat) {
                        picker.pattern = row.data.dateFormat;
                    }
                    var locale = row.data.locale || form.locale;
                    if (locale) {
                        picker.locale = locale;
                    }

                    input.disabled = !row.enabled;

                    picker.date = new DayPilot.Date(row.value);
                    var formatted = new DayPilot.Date(row.value).toString(row.data.dateFormat || picker.pattern, picker.locale);
                    input.value = formatted;
                };

                var input = document.createElement("input");
                input.name = row.field;

                var picker = new DayPilot.DatePicker({
                    target: input,
                    theme: "navigator_modal",
                    zIndex: form.zIndex + 1,
                    resetTarget: false,
                    targetAlignment: "left",
                    onTimeRangeSelect: function(args) {
                        interactive.onInput({"immediate": true});
                    }
                });

                // required for serialization - to get the normalized value
                input.picker = picker;
                input.className = form.theme + "_input_date";
                input.type = "text";
                input.onkeydown = function (e) {
                    var letcontinue = false;
                    switch (e.keyCode) {
                        case 13:  // enter
                            if (picker.visible) {
                                picker.close();
                            } else {
                                form.doOnKey("Enter");
                            }
                            break;
                        case 27: // escape
                            if (picker.visible) {
                                picker.close();
                            } else {
                                form.doOnKey("Escape");
                            }
                            break;
                        case 9:  // tab
                            picker.close();
                            letcontinue = true;
                            break;
                        default:
                            letcontinue = true;
                            break;
                    }
                    if (!letcontinue) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                };

                input.onfocus = function () {
                    picker.show();
                };

                input.onclick = function () {
                    picker.show();
                };

                /*
                        input.onblur = function () {
                          // input.picker.close();
                        };
                */

                input.oninput = function(e) {
                    interactive.onInput();
                };
                input.onblur = function(e) {
                    interactive.onBlur();
                }

                interactive.element = input;
                interactive.picker = picker;
                interactive.canFocus = function() {
                    return !interactive.element.disabled;
                };
                interactive.focus = function () {
                    interactive.element.focus();
                };
                interactive.save = function() {
                    var value = picker.date ? picker.date.toString() : null;
                    var result = {};
                    result[row.field] = value;
                    return result;
                };
                return interactive;
            },
            "time": function () {
                return form._createInteractiveTime(row);
            },
            "datetime": function() {
                return form._createInteractiveDateTime(row);
            },
            "select": function () {
                var interactive = new Interactive();
                interactive.apply = function (row) {
                    interactive.row = row;
                    var select = interactive.element;

                    select.value = row.value;
                    select.disabled = !row.enabled;
                };

                var select = document.createElement("select");
                select.name = row.field;

                if (row.data.options && row.data.options.forEach) {
                    row.data.options.forEach(function (i) {
                        var option = document.createElement("option");
                        option.innerText = i.name || i.id;
                        option.value = i.id;
                        option._originalValue = i.id;
                        select.appendChild(option);
                    });
                }

                select.onchange = function(e) {
                    interactive.onInput({"immediate": true});
                };
                select.onblur = function(e) {
                    interactive.onBlur();
                };

                interactive.element = select;
                interactive.canFocus = function() {
                    return !interactive.element.disabled;
                };
                interactive.focus = function () {
                    interactive.element.focus();
                };
                interactive.save = function() {
                    var value = null;
                    var option = select.options[select.selectedIndex];
                    if (option && typeof option._originalValue !== "undefined") {
                        value = option._originalValue;
                    }
                    var result = {};
                    result[row.field] = value;
                    return result;
                };

                return interactive;

            },
            "searchable": function () {
                var interactive = new Interactive();
                interactive.apply = function (row) {
                    interactive.row = row;
                    var searchable = interactive.searchable;

                    searchable.disabled = !row.enabled;
                    searchable.select(row.value);
                };

                var searchable = new Searchable({
                    data: row.data.options || [],
                    name: row.field,
                    theme: form.theme + "_form_item_searchable",
                    listZIndex: form.zIndex + 1,
                    // disabled: !row.enabled
                    onSelect: function(args) {
                        if (args.ui) {
                            interactive.onInput({"immediate": true});
                        }
                    }
                });

                var element = searchable.create();

                interactive.element = element;
                interactive.searchable = searchable;
                interactive.canFocus = function() {
                    return !interactive.searchable.disabled;
                };
                interactive.focus = function () {
                    interactive.searchable.focus();
                };
                interactive.save = function() {
                    var value = searchable.selected && searchable.selected.id;
                    var result = {};
                    result[row.field] = value;
                    return result;
                };

                return interactive;
            },
            "radio": function () {
                var interactive = new Interactive();
                interactive.apply = function (row) {
                    interactive.row = row;
                    var radio = interactive.radio;

                    radio.checked = row.checked;
                    radio.disabled = !row.enabled;
                };

                var label = document.createElement("label");

                var radio = document.createElement("input");
                radio.type = "radio";
                radio.name = row.field;
                radio._originalValue = row.resolved;

                radio.onchange = function (ev) {
                    // activation only

                    var row = interactive.row;
                    form.findRowsByField(row.field).forEach(function (row) {
                        form.updateState(row, {
                            checked: false
                        });
                    });
                    form.updateState(row, {
                        checked: true
                    });

                    form.applyState();

                    interactive.onInput({"immediate": true});
                };

                radio.onblur = function(e) {
                    interactive.onBlur();
                };

                label.appendChild(radio);

                var text = document.createTextNode(row.text);
                label.append(text);

                interactive.element = label;
                interactive.radio = radio;
                interactive.canFocus = function() {
                    return false;
                };
                interactive.focus = function () {
                    interactive.radio.focus();
                }
                interactive.save = function() {
                    if (!radio.checked) {
                        return {};
                    }
                    var value = radio._originalValue;
                    var result = {};
                    result[row.field] = value;
                    return result;
                };

                return interactive;
            },
            "checkbox": function () {
                var interactive = new Interactive();
                interactive.apply = function (row) {
                    interactive.row = row;
                    var checkbox = interactive.checkbox;

                    checkbox.checked = row.checked;
                    checkbox.disabled = !row.enabled;
                };

                var label = document.createElement("label");

                var checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.name = row.field;
                checkbox._originalValue = row.resolved;

                checkbox.onchange = function (ev) {
                    var row = interactive.row;
                    form.updateState(row, {
                        checked: this.checked
                    });
                    form.applyState();

                    interactive.onInput({"immediate": true});
                };

                checkbox.onblur = function(e) {
                    interactive.onBlur();
                };

                label.appendChild(checkbox);

                var text = document.createTextNode(row.text);
                label.append(text);

                interactive.element = label;
                interactive.checkbox = checkbox;
                interactive.canFocus = function() {
                    return false;
                };
                interactive.focus = function () {
                    interactive.checkbox.focus();
                }
                interactive.save = function() {
                    var value = checkbox.checked;
                    var result = {};
                    result[row.field] = value;
                    return result;
                };

                return interactive;
            },
            "table": function() {
                var interactive = new Interactive();
                interactive.apply = function (row) {
                    interactive.row = row;
                    var table = interactive.table;

                    table.disabled = !row.enabled;
                    table.load(row.value || []);

                    /*
                              if (row.value) {
                                table.load(row.value);
                              }
                    */
                };

                var table = new Table({
                    name: row.field,
                    // form: row.data.columns,
                    form: form,
                    theme: form.theme + "_form_item_tabular",
                    item: row.data,
                    onInput: function(args) {
                        interactive.onInput();
                    }
                });

                var element = table.create();

                interactive.element = element;
                interactive.table = table;
                interactive.canFocus = function() {
                    // return !interactive.table.disabled;
                    return false;
                };
                interactive.focus = function () {
                    interactive.table.focus();
                };
                interactive.save = function() {
                    var value = table.save();
                    var result = {};
                    result[row.field] = value;
                    return result;
                };

                return interactive;
            }
        };
        if (form.plugins && form.plugins[row.type]) {
            return form.plugins[row.type](row);
        }
        return views[row.type]();
    };

    Form.prototype._createInteractiveTime = function(row) {
        var form = this;
        var interactive = new Interactive();
        interactive.apply = function (row) {
            interactive.row = row;
            var searchable = interactive.searchable;

            searchable.disabled = !row.enabled;
            searchable.select(row.value);
        };

        var data = [];

        var interval = row.data.timeInterval || 15;  // allowed values: 1, 5, 10, 15, 20, 30, 60
        var allowedIntervals = [1, 5, 10, 15, 20, 30, 60];
        if (!allowedIntervals.includes(interval)) {
            interval = 15;
        }
        var perHour = 60 / interval;

        var localeStr = row.data.locale || form.locale;
        var locale = DayPilot.Locale.find(localeStr) || DayPilot.Locale.US;

        var date = DayPilot.Date.today();

        for (var i = 0; i < 24*perHour; i++) {
            var time = date.addMinutes(interval*i);
            var item = {};
            item.name = time.toString(row.data.timeFormat || locale.timePattern, locale);
            item.id = time.toString("HH:mm");
            data.push(item);
        }

        var searchable = new Searchable({
            data: data,
            name: row.field,
            theme: form.theme + "_form_item_time",
            listZIndex: form.zIndex + 1,
            strategy: "startsWith",
            // disabled: !row.enabled
            onSelect: function(args) {
                if (args.ui) {
                    interactive.onInput({"immediate": true});
                }
            }
        });

        var element = searchable.create();

        interactive.element = element;
        interactive.searchable = searchable;
        interactive.canFocus = function() {
            return !interactive.searchable.disabled;
        };
        interactive.focus = function () {
            interactive.searchable.focus();
        };
        interactive.save = function() {
            var value = searchable.selected && searchable.selected.id;
            var result = {};
            result[row.field] = value;
            return result;
        };

        return interactive;

    };

    Form.prototype._createInteractiveDateTime = function(row) {
        var form = this;
        var interactive = new Interactive();
        interactive.apply = function (row) {
            interactive.row = row;
            var searchable = interactive.searchable;

            searchable.disabled = !row.enabled;

            var timePart = new DayPilot.Date(row.value).toString("HH:mm");

            searchable.select(timePart);

            var input = interactive.dateInput;
            var picker = interactive.picker;

            if (row.data.dateFormat) {
                picker.pattern = row.data.dateFormat;
            }
            var localeStr = row.data.locale || form.locale;
            if (localeStr) {
                var locale = DayPilot.Locale.find(localeStr) || DayPilot.Locale.US;
                picker.locale = localeStr;
                picker.pattern = locale.datePattern;
            }

            input.disabled = !row.enabled;

            picker.date = new DayPilot.Date(row.value);
            var formatted = new DayPilot.Date(row.value).toString(row.data.dateFormat || picker.pattern, picker.locale);
            input.value = formatted;

        };

        var dateElement = (function createDatePicker() {
            var input = document.createElement("input");
            input.name = row.field;

            var picker = new DayPilot.DatePicker({
                target: input,
                theme: "navigator_modal",
                zIndex: form.zIndex + 1,
                resetTarget: false,
                targetAlignment: "left",
                onTimeRangeSelect: function(args) {
                    interactive.onInput({"immediate": true});
                }
            });

            // required for serialization - to get the normalized value
            input.picker = picker;
            input.className = form.theme + "_input_date";
            input.type = "text";
            input.onkeydown = function (e) {
                var letcontinue = false;
                switch (e.keyCode) {
                    case 13:  // enter
                        if (picker.visible) {
                            picker.close();
                        } else {
                            form.doOnKey("Enter");
                        }
                        break;
                    case 27: // escape
                        if (picker.visible) {
                            picker.close();
                        } else {
                            form.doOnKey("Escape");
                        }
                        break;
                    case 9:  // tab
                        picker.close();
                        letcontinue = true;
                        break;
                    default:
                        letcontinue = true;
                        break;
                }
                if (!letcontinue) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            };

            input.onfocus = function () {
                picker.show();
            };

            input.onclick = function () {
                picker.show();
            };

            input.oninput = function(e) {
                interactive.onInput();
            };
            input.onblur = function(e) {
                interactive.onBlur();
            }

            interactive.dateInput = input;
            interactive.picker = picker;

            return input;
        })();


        var timeElement = (function createTimePicker() {
            var data = [];

            var interval = row.data.timeInterval || 15;  // allowed values: 1, 5, 10, 15, 20, 30, 60
            var allowedIntervals = [1, 5, 10, 15, 20, 30, 60];
            if (!allowedIntervals.includes(interval)) {
                interval = 15;
            }
            var perHour = 60 / interval;

            var localeStr = row.data.locale || form.locale;
            var locale = DayPilot.Locale.find(localeStr) || DayPilot.Locale.US;

            var date = DayPilot.Date.today();

            for (var i = 0; i < 24*perHour; i++) {
                var time = date.addMinutes(interval*i);
                var item = {};
                item.name = time.toString(row.data.timeFormat || locale.timePattern, locale);
                item.id = time.toString("HH:mm");
                data.push(item);
            }

            var searchable = new Searchable({
                data: data,
                name: row.field,
                theme: form.theme + "_form_item_time",
                listZIndex: form.zIndex + 1,
                strategy: "startsWith",
                // disabled: !row.enabled
                onSelect: function(args) {
                    if (args.ui) {
                        interactive.onInput({"immediate": true});
                    }
                }
            });

            interactive.searchable = searchable;
            return searchable.create();

        })();


        var element = document.createElement("div");
        element.className = form.theme + "_form_item_datetime_parent";
        element.appendChild(dateElement);
        element.appendChild(timeElement);

        interactive.element = element;
        interactive.canFocus = function() {
            return !interactive.searchable.disabled;
        };
        interactive.focus = function () {
            interactive.dateInput.focus();
        };
        interactive.save = function() {
            var timeValue = interactive.searchable.selected && interactive.searchable.selected.id;
            var dateValue = interactive.picker.date ? interactive.picker.date.toString() : null;

            var date = new DayPilot.Date(dateValue).getDatePart();
            var value = DayPilot.Date.parse(date.toString("yyyy-dd-MM ") + timeValue, "yyyy-dd-MM HH:mm");

            var result = {};
            result[row.field] = value;
            return result;

        };

        return interactive;

    };

    Form.prototype.findRowsByField = function (field) {
        return this._rows.filter(function (row) {
            return row.field === field;
        });
    };

    // ooptional value param applies to radio which can have multiple views, one for each value
    Form.prototype.findViewById = function (id, value) {
        return this._views.find(function (v) {
            if (v.row.field === id) {
                if (v.row.type === "radio") {
                    return v.row.resolved === value;
                } else {
                    return true;
                }
            }
            return false;
        });
    };

    Form.prototype.firstFocusable = function () {
        return this._views.find(function (v) {
            return v.canFocus && v.canFocus();
        });
    };

    Form.prototype.updateState = function (row, props) {
        var source = this._newRows ? this._newRows : this._rows;
        var index = source.indexOf(row);
        this._newRows = source.map(function (srow) {
            if (srow !== row) {
                return srow;
            }
            // our row
            if (row.propsEqual(props)) {
                return row;
            }
            var cloned = row.clone();
            for (var name in props) {
                cloned[name] = props[name];
            }
            return cloned;
        });
        return this._newRows[index];
    };

    // dirty row received, a member of _newRows
    Form.prototype.updateInteractive = function (row) {
        var index = this._newRows.indexOf(row);
        this._views[index].apply(row);
    };

    Form.prototype.applyState = function () {
        var form = this;

        this.updateDependentState();

        if (!this._newRows) {
            return;
        }

        var dirtyRows = this._newRows.filter(function (row, i) {
            return form._rows[i] !== row;
        });

        dirtyRows.forEach(function (row) {
            form.updateInteractive(row);
        });

        this._rows = this._newRows;

        this._newRows = null;
    };

    Form.prototype.getFieldType = function (item) {

        var known = ["text", "date", "select", "searchable", "radio", "checkbox", "table", "title", "image", "html", "textarea", "scrollable", "time", "datetime"];
        if (known.indexOf(item.type) !== -1) {
            return item.type;
        }

        if (item.type && this.plugins && this.plugins[item.type]) {
            return item.type;
        }

        if (item.image) {
            return "image";
        }

        if (item.html || item.text) {
            return "html";
        }

        if (!item.id) {
            return "title";
        }

        if (item.options) {
            return "searchable";
        }

        if (item.dateFormat) {
            return "date";
        }

        if (item.columns) {
            return "table";
        }

        return "text";
    };

    Form.prototype.serialize = function() {
        var result = {};

        this._views.forEach(function(interactive) {
            var out = interactive.save();
            for (var name in out) {
                result[name] = out[name];
            }
        });

        return result;
    };

    var RowModel = function () {
        this.id = this.guid();
        this.field = null;
        this.data = null;
        this.type = null;
        this.level = 0;
        this.enabled = true;
        this.value = null;
        this.text = null;

        this.interactive = true;

        this.isValue = false;
        this.checked = false;
        this.resolved = null;  // value resolves to
    };

    RowModel.prototype.clone = function () {
        var rm = new RowModel();
        for (var name in this) {
            if (name === "id") {
                continue;
            }
            rm[name] = this[name];
        }
        return rm;
    };

    RowModel.prototype.propsEqual = function (props) {
        for (var name in props) {
            if (this[name] !== props[name]) {
                return false;
            }
        }
        return true;
    };

    RowModel.prototype.guid = function () {
        var S4 = function () {
            return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
        };
        return ("" + S4() + S4() + "-" + S4() + "-" + S4() + "-" + S4() + "-" + S4() + S4() + S4());
    };

    RowModel.prototype.applyValue = function (name, value) {
        if (this.field !== name) {
            return;
        }
        this.value = value;
        if (this.isValue && value === this.resolved) {
            this.checked = true;
        }
    };

    var Interactive = function () {
        // this.row = row;
        this.element = null;

        // only used for autofocus
        this.canFocus = function() {
            return false;
        };
        this.apply = function (row) {
        };
        this.focus = function () {
        };
        this.save = function() {
            return {};
        }
    };

    function flatten(object, result, prefix) {
        result = result || {};
        prefix = prefix || "";
        for (var name in object) {
            var src = object[name];
            if (typeof src === "object") {
                if (Object.prototype.toString.call(src) === '[object Array]') {
                    result[prefix + name] = src;
                }
                else if (src && src.toJSON) {
                    result[prefix + name] = src.toJSON();
                }
                else {
                    flatten(src, result, prefix + name + ".");
                }
            }
            else {
                result[prefix + name] = src;
            }
        }
        return result;
    }

    // end of form.js

    // searchable.js -> 3265
    var Searchable = function(options) {

        // properties
        this.data = [];
        this.name = null;
        this.theme = "searchable_default";
        this._disabled = false;
        this.listZIndex = 100000;


        // events
        this.onSelect = null;

        // state
        this._selected = null;
        this._highlighted = null;
        this._collapsed = false;
        // this._focused = false;
        // this._filter = null;

        // view
        this._input = null;
        this._list = null;
        this._options = [];
        this._hidden = null;

        options = options || {};

        var t = this;

        var specialHandling = {
            "selected": {
                post: function(val) {
                    if (typeof val === "object" && val.id) {
                        t._selected = val;
                    }
                    else if (typeof val === "string" || typeof val === "number") {
                        t.select(val);
                    }
                }
            }
        };

        Object.defineProperty(this, "selected", {
            get: function() {
                return this._selected;
            },
        });

        Object.defineProperty(this, "disabled", {
            get: function() {
                return this._disabled;
            },
            set: function(val) {
                this._disabled = val;
                if (this._input) {
                    this._input.disabled = val;
                    if (val) {
                        // verify
                        this._cancel();
                    }
                }
            }
        });

        for (var name in options) {
            if (!specialHandling[name]) {
                this[name] = options[name];
            }
        }

        for (var name in options) {
            if (specialHandling[name]) {
                specialHandling[name].post(options[name]);
            }
        }

    };

    Searchable.prototype.select = function(id) {
        this._selected = this.data.find(function(item) { return item.id === id });
        this._doOnSelect(false);
        return this;
    };


    Searchable.prototype.create = function() {
        var component = this;
        var t = this;

        var div = document.createElement("div");
        div.className = this.theme + "_main";
        div.style.position = "relative";

        var icon = document.createElement("div");
        icon.className = this.theme + "_icon";
        icon.style.position = "absolute";
        icon.style.right = "0";
        icon.style.top = "0";
        icon.style.bottom = "0";
        icon.style.width = "20px";
        icon.addEventListener("mousedown", function(ev) {
            ev.preventDefault();
            if (component._collapsed) {
                component.focus();
                expand();
            }
            else {
                cancel();
                collapse();
            }
        });

        var list = document.createElement("div");
        list.className = this.theme + "_list";
        list.style.display = "none";
        list.style.position = "absolute";
        list.style.zIndex = this.listZIndex;

        var hidden = document.createElement("input");
        hidden.type = "hidden";
        hidden.name = this.name;
        hidden.searchable = t;
        this._hidden = hidden;

        var input = document.createElement("input");
        input.type = "text";
        input.className = this.theme + "_input";
        input.disabled = this._disabled;
        input.addEventListener("click", function(ev) {
            // console.log("click");
            expand();
        });
        input.addEventListener("focus", function(ev) {
            // do not call expand() here, the readonly status has to stay
            // input.value = "";
            // console.log("focus");
            filter("all");
        });
        input.addEventListener("input", function(ev) {
            filter();
        });
        input.addEventListener("blur", function(ev) {
            input.removeAttribute("readonly");
            cancel();
        });

        input.addEventListener("keydown", function(ev) {
            if (component._collapsed) {
                if (ev.key === "Enter") {
                    return;
                }
                if (ev.key === "Esc" || ev.key === "Escape") {
                    return;
                }
                expand();
            }

            if (ev.key === "ArrowDown") {
                var index = t._options.indexOf(t._highlighted);
                if (index + 1 < t._options.length) {
                    t._highlighted = t._options[index + 1];
                }
                updateHiglight();
            } else if (ev.key === "ArrowUp") {
                var index = t._options.indexOf(t._highlighted);
                if (index - 1 >= 0) {
                    t._highlighted = t._options[index - 1];
                }
                updateHiglight();
            } else if (ev.key === "Enter") {
                if (component._highlighted) {
                    ev.stopPropagation();
                    selectOption(component._highlighted);
                }
                else {
                    ev.stopPropagation();
                    // t._cancel();
                    cancel();
                    collapse();
                }
            } else if (ev.key === "Esc" || ev.key === "Escape") {
                ev.stopPropagation();
                cancel();
                collapse();
            }
        });
        this._input = input;
        this._list = list;

        if (!this._selected) {
            this._selected = this.data[0];
            if (this._selected) {
                input.value = this._selected.name;
            }
        }

        function filter(strategy) {
            // component._collapsed = false;

            var defaultStrategy = component.strategy;
            if (component.strategy !== "includes" && component.strategy !== "startsWith") {
                defaultStrategy = "includes";
            }

            strategy = strategy || defaultStrategy || "includes";

            list.style.display = "";
            list.style.top = input.offsetHeight + "px";
            list.style.left = "0px";
            list.style.width = input.offsetWidth + "px";
            list.innerHTML = "";

            // allow scrollbar access
            list.addEventListener("mousedown", function(ev) {
                ev.preventDefault();
            });

            component._highlighted = null;

            component._options = [];

            var first = null;

            component.data.forEach(function(item) {

                var name = item.name || item.id;

                if (strategy === "includes") {
                    if (name.toLowerCase().indexOf(input.value.toLowerCase()) === -1) {
                        return;
                    }
                }
                else if (strategy === "startsWith") {
                    if (name.toLowerCase().indexOf(input.value.toLowerCase()) !== 0) {
                        return;
                    }
                }
                else if (strategy === "all") {
                    // don't skip
                }


                var option = document.createElement("div");
                option.className = component.theme + "_list_item";
                option.innerText = name;

                option.item = item;

                if (item === component._selected) {
                    component._highlighted = option;
                }
                if (!first) {
                    first = option;
                }

                // "mousedown" goes before blur, "click" goes after
                option.addEventListener("mousedown", function(ev) {
                    selectOption(option);
                    ev.preventDefault();
                });

                option.addEventListener("mousemove", function(ev) {
                    if (component._highlighted === option) {
                        return;
                    }
                    component._highlighted = option;
                    updateHiglight({dontScroll: true});
                });

                list.appendChild(option);

                component._options.push(option);
            });

            if (!component._highlighted) {
                component._highlighted = first;
            }
            updateHiglight();
        }

        function updateHiglight(options) {
            options = options || {};
            var scrollIntoView = !options.dontScroll;

            // redo, avoid selectors
            var previous = document.querySelectorAll("." + component.theme + "_list_item_highlight");
            previous.forEach(function(p) {
                p.className = p.className.replace(component.theme + "_list_item_highlight", "");
            });

            if (component._highlighted) {
                component._highlighted.className += " " + component.theme + "_list_item_highlight";

                if (scrollIntoView && !isScrolledIntoView(component._highlighted, list)) {
                    component._highlighted.scrollIntoView();
                }
            }
        }

        function isScrolledIntoView(target, viewport) {
            var tRect = target.getBoundingClientRect();
            var vRect = viewport.getBoundingClientRect();
            return tRect.top >= vRect.top && tRect.bottom <= vRect.bottom;
        }

        function selectOption(option) {
            var item = option.item;

            // input.value = option.innerText;
            component._selected = item;
            component._doOnSelect(true);
            hide();
            collapse();
        }

        function cancel() {
            component._cancel();
        }

        function hide() {
            component._hide();
        }

        function collapse() {
            component._collapsed = true;
            input.setAttribute("readonly", "readonly");
            input.focus();
        }

        function expand() {
            component._collapsed = false;
            input.removeAttribute("readonly");
            // input.value = "";
            input.select();
            filter("all");
        }

        div.appendChild(input);
        div.appendChild(icon);
        div.appendChild(hidden);
        div.appendChild(list);
        return div;
    };

    Searchable.prototype._cancel = function() {
        this._hide();
        if (!this._selected) {
            this._input.value = "";
            // not sure about this:
            this._doOnSelect(true);
        } else {
            this._input.value = this._selected.name;
        }
        // collapse();
    }

    Searchable.prototype.focus = function() {
        // this._input.focus();

        this._collapsed = true;
        this._input.setAttribute("readonly", "readonly");
        this._input.focus();
        this._cancel();
    };

    Searchable.prototype._hide = function() {
        this._list.style.display = "none";
    };

    Searchable.prototype._doOnSelect = function(byUser) {
        this._hidden.value = this.selected ? this.selected.id : null;
        if (this._selected) {
            this._input.value = this._selected.name;
        }
        else {
            this._input.value = "";
        }

        if (typeof this.onSelect === "function") {
            var args = {
                control: this,
                ui: byUser
            };
            this.onSelect(args);
        }
    };

    // end of searchable.js

    // table.js -> 3641
    var Table = function(options) {

        this.form = null; // Form instance
        this.item = null; // table def from form
        this.data = null;
        this.name = null;
        this.theme = "edit_table_default";
        this.onInput = null;

        this.nav = {};

        this._activeEdit = null;
        this._rows = [];

        options = options || {};

        for (var name in options) {
            this[name] = options[name];
        }

    };

    Table.prototype.create = function() {
        var table = this;

        var div = document.createElement("div");
        div.className = this.theme + "_main";
        div.style.position = "relative";

        var hidden = document.createElement("input");
        hidden.type = "hidden";
        hidden.name = table.name;
        hidden.table = this;
        div.appendChild(hidden);

        var tableElement = document.createElement("div");
        tableElement.className = this.theme + "_table";
        var header = this._createHeader();
        tableElement.appendChild(header);

        var spacerRow = table._createRowState({});
        spacerRow.spacer = true;
        var spacer = this._renderRow(spacerRow);
        // spacer.style.visibility = "hidden";
        spacer.classList.add(table.theme + "_spacer");
        tableElement.appendChild(spacer);

        var body = document.createElement("div");
        body.className = table.theme + "_tbody";
        tableElement.appendChild(body);

        div.appendChild(tableElement);

        var after = document.createElement("div");
        div.appendChild(after);

        this.nav.body = body;
        this.nav.table = tableElement;
        this.nav.main = div;
        this.nav.after = after;

        var add = document.createElement("div");
        var plus = document.createElement("span");
        plus.className = this.theme + "_plus";

        plus.addEventListener("click", function(ev) {
            if (table.disabled) {
                return;
            }

            var generate = table.item.onNewRow;
            var value = {};
            if (typeof generate === "function") {
                var args = {};
                args.result = table.form.serialize();
                args.value = {};
                generate(args);
                value = args.value;
            }

            var row = table._createRowState(value);
            table._rows.push(row);
            table._render();
            table._doOnInput();
        });

        this.nav.plus = plus;

        add.appendChild(plus);
        div.appendChild(add);

        return div;
    };

    Table.prototype._createHeader = function() {
        var table = this;
        var row = document.createElement("div");
        row.classList.add(this.theme + "_row");
        row.classList.add(this.theme + "_header");
        this.item.columns.forEach(function(item) {
            var cell = document.createElement("div");
            cell.classList.add(table.theme + "_cell");
            cell.innerText = item.name;
            row.appendChild(cell);
        });
        return row;
    };

    Table.prototype._maxRowsReached = function() {
        var max = this.item.max || 0;
        if (max && this._rows.length >= max) {
            return true;
        }
        return false;
    };

    Table.prototype.save = function() {
        var table = this;
        var data = [];

        table._rows.forEach(function(row) {
            var item = {};
            row.cells.forEach(function(cell) {
                item[cell.id] = cell.value;
            });
            data.push(item);
        });

        return data;
    };

    Table.prototype.load = function(data) {
        var table = this;

        var isArray = Object.prototype.toString.call(data) === '[object Array]';
        if (!isArray) {
            throw new Error("Array expected");
        }

        this.data = data;

        this._createState();
        this._render();
    };

    Table.prototype._updateCss = function() {
        if (this.disabled) {
            this.nav.main.classList.add(this.theme + "_disabled");
        }
        else {
            this.nav.main.classList.remove(this.theme + "_disabled");
        }

        var maxReached = this._maxRowsReached();
        if (maxReached) {
            this.nav.plus.classList.add(this.theme + "_plus_max");
        }
        else {
            this.nav.plus.classList.remove(this.theme + "_plus_max");
        }
    };

    Table.prototype._createState = function() {
        var table = this;
        this._rows = [];
        this.data.forEach(function(dataRow) {
            var row = table._createRowState(dataRow);
            table._rows.push(row);
        });
    };

    Table.prototype._removeRow = function(row) {
        var table = this;

        var index = table._rows.indexOf(row);
        table._rows.splice(index, 1);
    };

    Table.prototype._createRowState = function(dataRow) {
        var table = this;

        var row = {};
        row.data = dataRow;
        row.cells = [];

        table.item.columns.forEach(function(formItem) {
            var id = formItem.id;
            var value = dataRow[id];

            var type = table._formItemType(formItem);
            if (typeof value === "undefined") {
                if (type === "text") {
                    value = "";
                }
                else if (type === "number") {
                    value = 0;
                }
                else if (type === "select") {
                    var options = formItem.options;
                    value = options && options[0].id;
                }
            }

            var cell = {};
            cell.id = id;
            cell.value = value;
            cell.type = type;
            cell.data = formItem;
            row.cells.push(cell);
        });

        return row;
    };

    Table.prototype._formItemType = function(formItem) {
        var type = formItem.type;
        if (!type) {
            if (formItem.options) {
                type = "select";
            }
            else {
                type = "text";
            }
        }
        return type;
    };

    Table.prototype._render = function() {

        var table = this;
        this.nav.body.innerHTML = "";
        this.nav.after.innerHTML = "";

        this._rows.forEach(function(row) {
            var el = table._renderRow(row);
            table.nav.body.appendChild(el);
        });

        if (this._rows.length === 0) {
            var el = table._renderEmpty();
            table.nav.after.appendChild(el);
        }

        this._updateCss();
    };

    Table.prototype._renderEmpty = function() {
        var div = document.createElement("div");
        div.className = this.theme + "_empty";

        return div;
    };

    Table.prototype._renderRow = function(row) {
        var table = this;
        var el = document.createElement("div");
        el.className = table.theme + "_row";

        row.cells.forEach(function(cell) {

            var cellEl = document.createElement("div");
            cellEl.className = table.theme + "_cell";
            var interactive = table._renderCell(cell);

            if (row.spacer) {
                var wrap = document.createElement("div");
                wrap.style.height = "0px";
                wrap.style.overflow = "hidden";
                wrap.appendChild(interactive);

                cellEl.appendChild(wrap);
            }
            else {
                cellEl.appendChild(interactive);

            }

            el.appendChild(cellEl);
        });

        var cell = document.createElement("div");
        cell.classList.add(table.theme + "_cell");
        cell.classList.add(table.theme + "_rowaction");

        var span = document.createElement("span");
        span.className = this.theme + "_delete";

        span.addEventListener("click", function(ev) {
            if (table.disabled) {
                return;
            }
            table._removeRow(row);
            table._render();
            table._doOnInput();
        });

        if (!row.spacer) {
            cell.appendChild(span);
        }


        el.appendChild(cell);

        return el;
    };

    Table.prototype._doOnInput = function() {
        var table = this;
        if (typeof table.onInput === "function") {
            var args = {}
            table.onInput(args);
        }
    };

    Table.prototype._renderCell = function(cell) {
        var table = this;
        var type = cell.type;
        if (type === "text" || type === "number") {
            var input = document.createElement("input");
            input.type = type;
            if (table.disabled) {
                input.disabled = true;
            }
            if (cell.value) {
                input.value = cell.value;
            }
            input.addEventListener("keyup", function(ev) {
                if (type === "number") {
                    cell.value = Number(this.value);
                }
                else {
                    cell.value = this.value;
                }
                table._doOnInput();
            });
            return input;
        }
        else if (type === "select") {
            var select = document.createElement("select");
            if (table.disabled) {
                select.disabled = true;
            }

            cell.data.options.forEach(function(item) {
                var option = document.createElement("option");
                option.innerText = item.name;
                option.value = item.id;
                option._originalValue = item.id;

                select.appendChild(option);

                if (cell.value === item.id) {
                    option.setAttribute("selected", true);
                }
            });

            select.addEventListener("change", function(ev) {
                var option = select.options[select.selectedIndex];
                if (option && typeof option._originalValue !== "undefined") {
                    cell.value = option._originalValue;
                }
                table._doOnInput();
            });

            return select;
        }

        throw new Error("Unsupported item type: " + type);
    };

    Table.prototype.focus = function() {
    };

    // end of table.js

})(DayPilot);
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

(function() {

    var doNothing = function() { };

    if (typeof DayPilot.Month !== 'undefined' && DayPilot.Month.events) {
        return;
    }

    var DayPilotMonth = {};

    DayPilotMonth.Month = function(placeholder, options) {
        this.v = '2024.3.543-lite';
        this.nav = {};

        var calendar = this;

        this.id = placeholder;
        this.isMonth = true;

        // this.angularAutoApply = false;
        this.api = 2;
        this.backendUrl = null;
        this.cellHeaderHeight = 24;
        this.cellHeight = 100; // default cell height is 100 pixels (it's a minCellHeight, it will be extended if needed)
        this.cellMarginBottom = 0;
        this.contextMenu = null;
        this.cssClassPrefix = "month_default";
        this.eventBarVisible = true;
        this.eventHeight = 25;
        this.eventsLoadMethod = "GET";
        this.headerHeight = 30;
        this.hideUntilInit = true;
        this.lineSpace = 1;
        this.locale = "en-us";
        this.showToolTip = true;
        this.startDate = new DayPilot.Date(); // today
        this.theme = null;
        this.visible = true;
        this.weekStarts = "Auto";
        this.width = '100%'; // default width is 100%
        this.xssProtection = "Enabled";

        this.afterRender = function() { };

        this.cellHeaderClickHandling = "Enabled";
        this.eventClickHandling = "Enabled";
        this.eventDeleteHandling = "Disabled";
        this.eventMoveHandling = "Update";
        this.eventResizeHandling = "Update";
        this.eventRightClickHandling = "ContextMenu";
        this.headerClickHandling = "Enabled";
        this.timeRangeSelectedHandling = "Enabled";

        this.onCellHeaderClick = null;
        this.onCellHeaderClicked = null;
        this.onEventClick = null;
        this.onEventClicked = null;
        this.onEventDelete = null;
        this.onEventDeleted = null;
        this.onEventMove = null;
        this.onEventMoved = null;
        this.onEventResize = null;
        this.onEventResized = null;
        this.onEventRightClick = null;
        this.onEventRightClicked = null;
        this.onTimeRangeSelect = null;
        this.onTimeRangeSelected = null;

        this.onBeforeEventRender = null;
        this.onBeforeCellRender = null;

        this.cellEvents = [];

        this.elements = {};
        this.elements.events = [];

        this.cache = {};

        this._disposed = false;

        this._updateView = function(result, context) {

            var result = JSON.parse(result);

            if (result.CallBackRedirect) {
                document.location.href = result.CallBackRedirect;
                return;
            }

            if (result.UpdateType === "None") {
                calendar.fireAfterRenderDetached(result.CallBackData, true);
                return;
            }

            calendar.events.list = result.Events;

            if (result.UpdateType === "Full") {

                // properties
                calendar.startDate = result.StartDate;
                // calendar.headerBackColor = result.HeaderBackColor ? result.HeaderBackColor : calendar.headerBackColor;
                // calendar.backColor = result.BackColor ? result.BackColor : calendar.backColor;
                // calendar.nonBusinessBackColor = result.NonBusinessBackColor ? result.NonBusinessBackColor : calendar.nonBusinessBackColor;
                calendar.timeFormat = result.TimeFormat ? result.TimeFormat : calendar.timeFormat;
                if (typeof result.WeekStarts !== 'undefined') { calendar.weekStarts = result.WeekStarts; } // number, can be 0

                calendar.hashes = result.Hashes;
            }

            calendar._deleteEvents();
            calendar._prepareRows();
            calendar._loadEvents();

            if (result.UpdateType === "Full") {
                calendar._clearTable();
                calendar._drawTable();
            }
            calendar._updateHeight();

            calendar.show();

            calendar._drawEvents();

            calendar.fireAfterRenderDetached(result.CallBackData, true);

        };

        this.fireAfterRenderDetached = function(data, isCallBack) {
            var afterRenderDelayed = function(data, isc) {
                return function() {
                    if (calendar.afterRender) {
                        calendar.afterRender(data, isc);
                    }
                };
            };

            window.setTimeout(afterRenderDelayed(data, isCallBack), 0);
        };

        this.lineHeight = function() {
            return this.eventHeight + this.lineSpace;
        };

        this.events = {};
        //this.events.list = [];

        this.events.add = function(e) {

            var data = null;
            if (e instanceof DayPilot.Event) {
                data = e.data;
            }
            else if (typeof e === "object") {
                data = e;
            }
            else {
                throw "DayPilot.Month.events.add() expects an object or DayPilot.Event instance.";
            }

            // e.calendar = calendar;

            if (!calendar.events.list) {
                calendar.events.list = [];
            }

            calendar.events.list.push(data);
            calendar.update();
            calendar._angular.notify();
        };

        this.events.find = function(id) {
            if (!calendar.events.list) {
                return null;
            }

            if (typeof id === "function") {
                var fn = id;
                for (var i = 0; i < calendar.events.list.length; i++) {
                    var e = new DayPilot.Event(calendar.events.list[i], calendar);
                    if (fn(e)) {
                        return e;
                    }
                }
                return null;
            }

            for (var i = 0; i < calendar.events.list.length; i++) {
                var data = calendar.events.list[i];
                if (data.id === id) {
                    return new DayPilot.Event(data, calendar);
                }
            }
            return null;
        };

        this.events.update = function(e) {
            if (e instanceof DayPilot.Event) {
                e.commit();
            }
            else if (typeof e === "object") {
                var target = calendar.events.find(e.id);
                if (target) {
                    var index = DayPilot.indexOf(calendar.events.list, target.data);
                    calendar.events.list.splice(index, 1, e);
                }
            }

            calendar.update();
            calendar._angular.notify();
        };

        this.events.remove = function(e) {
            var data;
            if (e instanceof DayPilot.Event) {
                data = e.data;
            }
            else if (typeof e === "object") {
                var target = calendar.events.find(e.id);
                if (target) {
                    data = target.data;
                }
            }
            else if (typeof e === "string" || typeof e === "number") {
                var target = calendar.events.find(e);
                if (target) {
                    data = target.data;
                }
            }

            var index = DayPilot.indexOf(calendar.events.list, data);
            calendar.events.list.splice(index, 1);
            calendar.update();
            calendar._angular.notify();
        };

        this.events.load = function(url, success, error) {
            var onError = function (args) {
                var largs = {};
                largs.exception = args.exception;
                largs.request = args.request;

                if (typeof error === 'function') {
                    error(largs);
                }
            };

            var onSuccess = function (args) {
                var r = args.request;
                var data;

                // it's supposed to be JSON
                try {
                    data = JSON.parse(r.responseText);
                }
                catch (e) {
                    var fargs = {};
                    fargs.exception = e;
                    onError(fargs);
                    return;
                }

                if (DayPilot.isArray(data)) {
                    var sargs = {};
                    sargs.preventDefault = function () {
                        this.preventDefault.value = true;
                    };
                    sargs.data = data;
                    if (typeof success === "function") {
                        success(sargs);
                    }

                    if (sargs.preventDefault.value) {
                        return;
                    }

                    calendar.events.list = data;
                    if (calendar._initialized) {
                        calendar.update();
                    }
                }
            };

            var usePost = calendar.eventsLoadMethod && calendar.eventsLoadMethod.toUpperCase() === "POST";

            if (usePost) {
                DayPilot.Http.ajax({
                    "method": "POST",
                    "data": {"start": calendar.visibleStart().toString(), "end": calendar.visibleEnd().toString()},
                    "url": url,
                    "success": onSuccess,
                    "error": onError
                });
            }
            else {
                var fullUrl = url;
                var queryString = "start=" + calendar.visibleStart().toString() + "&end=" + calendar.visibleEnd().toString();
                if (fullUrl.indexOf("?") > -1) {
                    fullUrl += "&" + queryString;
                }
                else {
                    fullUrl += "?" + queryString;
                }

                DayPilot.Http.ajax({
                    "method": "GET",
                    "url": fullUrl,
                    "success": onSuccess,
                    "error": onError
                });
            }
        };

        this.update = function(options) {

            calendar._loadOptions(options);

            if (!this._initialized) {
                return;
            }

            if (calendar._disposed) {
                throw new DayPilot.Exception("You are trying to update a DayPilot.Month instance that has been disposed.");
            }

            if (!this.cells) {
                return;
            }

            var full = true;

            calendar._deleteEvents();
            calendar._prepareRows();
            calendar._loadEvents();

            if (full) {
                calendar._clearTable();
                calendar._drawTable();
            }
            calendar._updateHeight();
            calendar._show();
            calendar._drawEvents();

            if (this.visible) {
                this.show();
            }
            else {
                this.hide();
            }
        };

        this._specialHandling = null;
        this._loadOptions = function(options) {
            if (!options) {
                return;
            }
            var specialHandling = {
                "events": {
                    "preInit": function() {
                        var events = this.data || [];
                        if (DayPilot.isArray(events.list)) {
                            calendar.events.list = events.list;
                        }
                        else {
                            calendar.events.list = events;
                        }
                    }
                }
            };
            this._specialHandling = specialHandling;

            for (var name in options) {
                if (specialHandling[name]) {
                    var item = specialHandling[name];
                    item.data = options[name];
                    if (item.preInit) {
                        item.preInit();
                    }
                }
                else {
                    calendar[name] = options[name];
                }
            }

        };

        this._postInit = function() {
            var specialHandling = this._specialHandling;
            for (var name in specialHandling) {
                var item = specialHandling[name];
                if (item.postInit) {
                    item.postInit();
                }
            }
        };

        this._cache = {};
        this._cache.events = [];

        this._doBeforeEventRender = function(i) {
            var cache = this._cache.events;
            var data = this.events.list[i];
            var evc = {};

            // make a copy
            for (var name in data) {
                evc[name] = data[name];
            }

            if (typeof this.onBeforeEventRender === 'function') {
                var args = {};
                args.control = calendar;
                args.data = evc;
                this.onBeforeEventRender(args);
            }

            cache[i] = evc;

        };

        this._loadEvents = function() {
            var events = this.events.list;

            if (!events) {
                return;
            }

            if (!DayPilot.isArray(events)) {
                throw new DayPilot.Exception("DayPilot.Month.events.list expects an array object. You supplied: " + (typeof events));
            }

            if (typeof this.onBeforeEventRender === 'function') {
                for (var i = 0; i < events.length; i++) {
                    this._doBeforeEventRender(i);
                }
            }

            // prepare rows and columns
            for (var x = 0; x < events.length; x++) {
                var data = events[x];

                if (typeof data !== "object") {
                    throw new DayPilot.Exception("Event data item must be an object");
                }
                if (!data.start) {
                    throw new DayPilot.Exception("Event data item must specify 'start' property");
                }
                if (!data.end) {
                    throw new DayPilot.Exception("Event data item must specify 'end' property");
                }

                var start = new DayPilot.Date(data.start);
                var end = new DayPilot.Date(data.end);
                if (start.getTime() > end.getTime()) { // skip invalid events, zero duration allowed
                    continue;
                }
                for (var i = 0; i < this.rows.length; i++) {
                    var row = this.rows[i];
                    var ep = new DayPilot.Event(data, this);
                    if (row.belongsHere(ep)) {
                        row.events.push(ep);

                        if (typeof this.onBeforeEventRender === 'function') {
                            ep.cache = this._cache.events[x];
                        }
                    }
                }
            }

            // arrange events into lines
            for (var ri = 0; ri < this.rows.length; ri++) {
                var row = this.rows[ri];
                row.events.sort(this._eventComparer);

                for (var ei = 0; ei < this.rows[ri].events.length; ei++) {
                    var ev = row.events[ei];
                    var colStart = row.getStartColumn(ev);
                    var colWidth = row.getWidth(ev);
                    var line = row.putIntoLine(ev, colStart, colWidth, ri);
                }
            }
        };


        this._deleteEvents = function() {
            for (var i = 0; i < this.elements.events.length; i++) {
                var e = this.elements.events[i];
                e.event = null;
                e.click = null;
                e.parentNode.removeChild(e);
            }

            this.elements.events = [];

        };

        this._drawEvents = function() {
            //this.cache.events = {};  // reset DayPilotMonth.Event object cache

            this._drawEventsRows();
        };

        this._drawEventsRows = function() {
            this.elements.events = [];

            // draw events
            for (var ri = 0; ri < this.rows.length; ri++) {
                var row = this.rows[ri];

                for (var li = 0; li < row.lines.length; li++) {
                    var line = row.lines[li];

                    for (var pi = 0; pi < line.length; pi++) {
                        this._drawEvent(line[pi]);
                    }
                }
            }

        };

        this._eventComparer = function(a, b) {
            if (!a || !b || !a.start || !b.start) {
                return 0; // no sorting, invalid arguments
            }

            var byStart = a.start().getTime() - b.start().getTime();
            if (byStart !== 0) {
                return byStart;
            }

            var byEnd = b.end().getTime() - a.end().getTime(); // desc
            return byEnd;
        };

        this.drawShadow = function(x, y, line, width, offset, e) {

            if (!offset) {
                offset = 0;
            }

            var remains = width;

            this.shadow = {};
            this.shadow.list = [];
            this.shadow.start = { x: x, y: y };
            this.shadow.width = width;

            // something before the first day
            var hidden = y * 7 + x - offset;
            if (hidden < 0) {
                //document.title = hidden + ' ' + new Date();
                remains += hidden;
                x = 0;
                y = 0;
            }

            var remainingOffset = offset;
            while (remainingOffset >= 7) {
                y--;
                remainingOffset -= 7;
            }
            if (remainingOffset > x) {
                var plus = 7 - this.getColCount();
                if (remainingOffset > (x + plus)) {
                    y--;
                    x = x + 7 - remainingOffset;
                }
                else {
                    remains = remains - remainingOffset + x;
                    x = 0;
                }
            }
            else {
                x -= remainingOffset;
            }

            if (y < 0) {
                y = 0;
                x = 0;
            }

            var cursor = null;
            if (DayPilotMonth.resizingEvent) {
                cursor = 'w-resize';
            }
            else if (DayPilotMonth.movingEvent) {
                cursor = "move";
            }

            this.nav.top.style.cursor = cursor;

            while (remains > 0 && y < this.rows.length) {
                var drawNow = Math.min(this.getColCount() - x, remains);
                var row = this.rows[y];


                var top = this.getRowTop(y);
                var height = row.getHeight();

                var shadow = document.createElement("div");
                shadow.setAttribute("unselectable", "on");
                shadow.style.position = 'absolute';
                shadow.style.left = (this.getCellWidth() * x) + '%';
                shadow.style.width = (this.getCellWidth() * drawNow) + '%';
                shadow.style.top = (top) + 'px';
                shadow.style.height = (height) + 'px';
                shadow.style.cursor = cursor;
                shadow.classList.add(calendar._prefixCssClass("_shadow"));

                var inside = document.createElement("div");
                inside.setAttribute("unselectable", "on");
                shadow.appendChild(inside);

                inside.style.position = "absolute";
                inside.style.top = "0px";
                inside.style.right = "0px";
                inside.style.left = "0px";
                inside.style.bottom = "0px";
                inside.classList.add(calendar._prefixCssClass("_shadow_inner"));

                // inside.style.backgroundColor = "#aaaaaa";
                // inside.style.opacity = 0.5;
                // inside.style.filter = "alpha(opacity=50)";
                //inside.style.border = '2px solid #aaaaaa';
                /*
                if (e) {
                    inside.style.overflow = 'hidden';
                    inside.style.fontSize = this.eventFontSize;
                    inside.style.fontFamily = this.eventFontFamily;
                    inside.style.color = this.eventFontColor;
                    inside.innerHTML = e.client.html();
                }
                */

                this.nav.top.appendChild(shadow);
                this.shadow.list.push(shadow);

                remains -= (drawNow + 7 - this.getColCount());
                x = 0;
                y++;
            }

        };

        this.clearShadow = function() {
            if (this.shadow) {
                for (var i = 0; i < this.shadow.list.length; i++) {
                    this.nav.top.removeChild(this.shadow.list[i]);
                }
                this.shadow = null;
                this.nav.top.style.cursor = '';
            }
        };

        this.getEventTop = function(row, line) {
            var top = this.headerHeight;
            for (var i = 0; i < row; i++) {
                top += this.rows[i].getHeight();
            }
            top += this.cellHeaderHeight; // space on top
            top += line * this.lineHeight();
            return top;
        };

        this.getDateFromCell = function(x, y) {
            //return DayPilot.Date.addDays(this.firstDate, y * 7 + x);
            return this.firstDate.addDays(y * 7 + x);
        };

        this._drawEvent = function(e) {
            /*

            supported properties:
            * cssClass
            * backColor
            * borderColor
            * barColor
            * barHidden
            * fontColor
            * html
            * toolTip
            *
            * clickEnabled
             */

            var data = e.cache || e.data;

            //var ev = eventPart.event;
            var row = e.part.row;
            var line = e.part.line;
            var colStart = e.part.colStart;
            var colWidth = e.part.colWidth;

            var left = this.getCellWidth() * (colStart);
            var width = this.getCellWidth() * (colWidth);
            var top = this.getEventTop(row, line);

            var div = document.createElement("div");
            div.setAttribute("unselectable", "on");
            div.style.height = this.eventHeight + 'px';
            div.className = this._prefixCssClass("_event");

            if (data.cssClass) {
                DayPilot.Util.addClass(div, data.cssClass);
            }

            if (!e.part.startsHere) {
                DayPilot.Util.addClass(div, this._prefixCssClass("_event_continueleft"));
            }

            if (!e.part.endsHere) {
                DayPilot.Util.addClass(div, this._prefixCssClass("_event_continueright"));
            }

            div.event = e;

            div.style.width = width + '%';
            div.style.position = 'absolute';
            div.style.left = left + '%';
            div.style.top = top + 'px'; // plus space on top

            if (this.showToolTip && e.client.toolTip()) {
                div.title = e.client.toolTip();
            }

            div.onclick = calendar._eventClickDispatch;
            div.oncontextmenu = calendar._onEventContextMenu;
            div.onmousedown = function(ev) {
                ev = ev || window.event;
                var button = ev.which || ev.button;

                ev.cancelBubble = true;
                if (ev.stopPropagation) {
                    ev.stopPropagation();
                }

                if (button === 1) {

                    DayPilotMonth.movingEvent = null;
                    if (this.style.cursor === 'w-resize' || this.style.cursor === 'e-resize') {
                        var resizing = {};
                        resizing.start = {};
                        resizing.start.x = colStart;
                        resizing.start.y = row;
                        resizing.event = div.event;
                        resizing.width = DayPilot.DateUtil.daysSpan(resizing.event.start(), resizing.event.end()) + 1;
                        resizing.direction = this.style.cursor;
                        DayPilotMonth.resizingEvent = resizing;
                    }
                    else if (this.style.cursor === 'move' || e.client.moveEnabled()) {
                        calendar.clearShadow();

                        var coords = DayPilot.mo3(calendar.nav.top, ev);
                        if (!coords) {
                            return;
                        }

                        var cell = calendar.getCellBelowPoint(coords.x, coords.y);

                        var hidden = DayPilot.DateUtil.daysDiff(e.start(), calendar.rows[row].start);
                        var offset = (cell.y * 7 + cell.x) - (row * 7 + colStart);
                        if (hidden) {
                            offset += hidden;
                        }

                        var moving = {};
                        moving.start = {};
                        moving.start.x = colStart;
                        moving.start.y = row;
                        moving.start.line = line;
                        moving.offset = calendar.eventMoveToPosition ? 0 : offset;
                        moving.colWidth = colWidth;
                        moving.event = div.event;
                        moving.coords = coords;
                        DayPilotMonth.movingEvent = moving;

                    }

                }
            };

            div.onmousemove = function(ev) {
                if (typeof (DayPilotMonth) === 'undefined') {
                    return;
                }

                if (DayPilotMonth.movingEvent || DayPilotMonth.resizingEvent) {
                    return;
                }

                // position
                var offset = DayPilot.mo3(div, ev);
                if (!offset) {
                    return;
                }

                if (div.deleteIcon) {
                    div.deleteIcon.style.display = "";
                }

                var resizeMargin = 6;

                if (offset.x <= resizeMargin && e.client.resizeEnabled()) {
                    if (e.part.startsHere) {
                        div.style.cursor = "w-resize";
                        div.dpBorder = 'left';
                    }
                    else {
                        div.style.cursor = 'not-allowed';
                    }
                }
                else if (div.clientWidth - offset.x <= resizeMargin && e.client.resizeEnabled()) {
                    if (e.part.endsHere) {
                        div.style.cursor = "e-resize";
                        div.dpBorder = 'right';
                    }
                    else {
                        div.style.cursor = 'not-allowed';
                    }
                }
                else if (e.client.clickEnabled()) {
                    div.style.cursor = "pointer";
                }
                else {
                    div.style.cursor = 'default';
                }

            };

            div.onmouseleave = function(ev) {
                if (div.deleteIcon) {
                    div.deleteIcon.style.display = "none";
                }
                div.style.cursor = '';
            };

            div.onmouseenter = function(ev) {
                if (div.deleteIcon) {
                    div.deleteIcon.style.display = "";
                }
            };

            var inner = document.createElement("div");
            inner.setAttribute("unselectable", "on");
            inner.className = this._prefixCssClass("_event_inner");

            if (data.borderColor === "darker" && data.backColor) {
                inner.style.borderColor = DayPilot.ColorUtil.darker(data.backColor, 2);
            }
            else {
                inner.style.borderColor = data.borderColor;
            }

            if (data.backColor) {
                inner.style.background = data.backColor;
            }

            if (data.fontColor) {
                inner.style.color = data.fontColor;
            }


            inner.innerHTML = e.client.html();

            div.appendChild(inner);

            if (e.client.barVisible()) {

                var bar = document.createElement("div");
                bar.setAttribute("unselectable", "on");
                bar.className = this._prefixCssClass("_event_bar");
                bar.style.position = "absolute";

                var barInner = document.createElement("div");
                barInner.setAttribute("unselectable", "on");
                barInner.className = this._prefixCssClass("_event_bar_inner");
                barInner.style.top = "0%";
                barInner.style.height = "100%";

                if (data.barColor) {
                    barInner.style.backgroundColor = data.barColor;
                }

                bar.appendChild(barInner);
                div.appendChild(bar);
            }


            if (e.client.deleteEnabled()) {
                var dheight = 18;
                var dwidth = 18;
                var dtop = Math.floor(calendar.eventHeight / 2 - dheight / 2);

                var del = document.createElement("div");
                del.style.position = "absolute";
                del.style.right = "2px";
                del.style.top = dtop + "px";
                del.style.width = dwidth + "px";
                del.style.height = dheight + "px";
                del.className = calendar._prefixCssClass("_event_delete");
                del.onmousedown = function(ev) {
                    ev.stopPropagation();
                };
                del.onclick = function(ev) {
                    ev.stopPropagation();
                    var e = this.parentNode.event;
                    if (e) {
                        calendar._eventDeleteDispatch(e);
                    }
                };
                del.style.display = "none";
                div.deleteIcon = del;
                div.appendChild(del);
            }

            // areas
            var areas = data.areas ? DayPilot.Areas.copy(data.areas) : [];
            DayPilot.Areas.attach(div, e, {"areas": areas});

            if (typeof calendar.onAfterEventRender === 'function') {
                var args = {};
                args.e = div.event;
                args.div = div;

                calendar.onAfterEventRender(args);
            }

            this.elements.events.push(div);

            this.nav.events.appendChild(div);
        };


        // returns DayPilot.Date object
        this.lastVisibleDayOfMonth = function() {
            return  this.startDate.lastDayOfMonth();
        };

        this._prepareRows = function() {

            if (typeof this.startDate === 'string') {
                this.startDate = new DayPilot.Date(this.startDate);
            }
            this.startDate = this.startDate.firstDayOfMonth();

            this.firstDate = this.startDate.firstDayOfWeek(this.getWeekStart());

            var firstDayOfMonth = this.startDate;

            var rowCount;

            var lastVisibleDayOfMonth = this.lastVisibleDayOfMonth();
            var count = DayPilot.DateUtil.daysDiff(this.firstDate, lastVisibleDayOfMonth) + 1;
            rowCount = Math.ceil(count / 7);

            this.days = rowCount * 7;

            this.rows = [];
            for (var x = 0; x < rowCount; x++) {
                var r = {};
                r.start = this.firstDate.addDays( x * 7);  // start point
                r.end = r.start.addDays(this.getColCount()); // end point
                r.events = []; // collection of events
                r.lines = []; // collection of lines
                r.index = x; // row index
                r.minHeight = this.cellHeight; // default, can be extended during events loading
                r.calendar = this;

                r.belongsHere = function(ev) {
                    if (ev.end().getTime() === ev.start().getTime() && ev.start().getTime() === this.start.getTime()) {
                        return true;
                    }
                    return !(ev.end().getTime() <= this.start.getTime() || ev.start().getTime() >= this.end.getTime());
                };

                r.getPartStart = function(ev) {
                    return DayPilot.DateUtil.max(this.start, ev.start());
                };

                r.getPartEnd = function(ev) {
                    return DayPilot.DateUtil.min(this.end, ev.end());
                };

                r.getStartColumn = function(ev) {
                    var partStart = this.getPartStart(ev);
                    return DayPilot.DateUtil.daysDiff(this.start, partStart);
                };

                r.getWidth = function(ev) {
                    return DayPilot.DateUtil.daysSpan(this.getPartStart(ev), this.getPartEnd(ev)) + 1;
                };

                r.putIntoLine = function(ev, colStart, colWidth, row) {
                    var thisRow = this;

                    for (var i = 0; i < this.lines.length; i++) {
                        var line = this.lines[i];
                        if (line.isFree(colStart, colWidth)) {
                            line.addEvent(ev, colStart, colWidth, row, i);
                            return i;
                        }
                    }

                    var line = [];
                    line.isFree = function(colStart, colWidth) {
                        var free = true;

                        for (var i = 0; i < this.length; i++) {
                            if (!(colStart + colWidth - 1 < this[i].part.colStart || colStart > this[i].part.colStart + this[i].part.colWidth - 1)) {
                                free = false;
                            }
                        }

                        return free;
                    };

                    line.addEvent = function(ep, colStart, colWidth, row, index) {
                        //var eventPart = {};
                        //eventPart.event = ev;
                        ep.part.colStart = colStart;
                        ep.part.colWidth = colWidth;
                        ep.part.row = row;
                        ep.part.line = index;
                        ep.part.startsHere = thisRow.start.getTime() <= ep.start().getTime();
                        //if (confirm('r.start: ' + thisRow.start + ' ev.Start: ' + ev.Start)) thisRow = null;
                        ep.part.endsHere = thisRow.end.getTime() >= ep.end().getTime();

                        this.push(ep);
                    };

                    line.addEvent(ev, colStart, colWidth, row, this.lines.length);

                    this.lines.push(line);

                    return this.lines.length - 1;
                };

                r.getStart = function() {
                    var start = 0;
                    for (var i = 0; i < calendar.rows.length && i < this.index; i++) {
                        start += calendar.rows[i].getHeight();
                    }
                };

                r.getHeight = function() {
                    return Math.max(this.lines.length * calendar.lineHeight() + calendar.cellHeaderHeight + calendar.cellMarginBottom, this.calendar.cellHeight);
                };

                this.rows.push(r);
            }

            //this.endDate = DayPilot.Date.addDays(this.firstDate, rowCount * 7);
            this.endDate = this.firstDate.addDays(rowCount * 7);
        };

        this.visibleStart = function() {
            return calendar.firstDate;
        };

        this.visibleEnd = function() {
            return calendar.endDate;
        };

        this.getHeight = function() {
            var height = this.headerHeight;
            for (var i = 0; i < this.rows.length; i++) {
                height += this.rows[i].getHeight();
            }
            return height;
        };

        this.getWidth = function(start, end) {
            var diff = (end.y * 7 + end.x) - (start.y * 7 + start.x);
            return diff + 1;
        };

        this.getMinCoords = function(first, second) {
            if ((first.y * 7 + first.x) < (second.y * 7 + second.x)) {
                return first;
            }
            else {
                return second;
            }
        };

        this._prefixCssClass = function(part) {
            var prefix = this.theme || this.cssClassPrefix;
            if (prefix) {
                return prefix + part;
            }
            else {
                return "";
            }
        };

        this._drawTop = function() {
            var relative = this.nav.top;
            //this.nav.top = relative;
            relative.setAttribute("unselectable", "on");
            relative.style.MozUserSelect = 'none';
            relative.style.KhtmlUserSelect = 'none';
            relative.style.WebkitUserSelect = 'none';
            relative.style.position = 'relative';
            if (this.width) {
                relative.style.width = this.width;
            }
            relative.style.height = this.getHeight() + 'px';
            relative.onselectstart = function(e) { return false; }; // prevent text cursor in Chrome during drag&drop


            if (this.hideUntilInit) {
                relative.style.visibility = 'hidden';
            }

            if (!this.visible) {
                relative.style.display = "none";
            }

            relative.className = this._prefixCssClass("_main");

            var cells = document.createElement("div");
            this.nav.cells = cells;
            cells.style.position = "absolute";
            cells.style.left = "0px";
            cells.style.right = "0px";
            cells.setAttribute("unselectable", "on");
            relative.appendChild(cells);

            var events = document.createElement("div");
            this.nav.events = events;
            events.style.position = "absolute";
            events.style.left = "0px";
            events.style.right = "0px";
            events.setAttribute("unselectable", "on");
            relative.appendChild(events);

            relative.onmousemove = function(ev) {

                if (DayPilotMonth.resizingEvent) {
                    var coords = DayPilot.mo3(calendar.nav.top, ev);

                    if (!coords) {
                        return;
                    }

                    var cell = calendar.getCellBelowPoint(coords.x, coords.y);
                    calendar.clearShadow();
                    var resizing = DayPilotMonth.resizingEvent;

                    var original = resizing.start;
                    var width, start;

                    if (resizing.direction === 'w-resize') {
                        start = cell;

                        var endDate = resizing.event.end();
                        //if (DayPilot.Date.getDate(endDate).getTime() === endDate.getTime()) {
                        if (endDate.getDatePart() === endDate) {
                            endDate = endDate.addDays(-1);
                        }

                        var end = calendar.getCellFromDate(endDate);
                        width = calendar.getWidth(cell, end);
                    }
                    else {
                        start = calendar.getCellFromDate(resizing.event.start());
                        width = calendar.getWidth(start, cell);
                    }

                    if (width < 1) {
                        width = 1;
                    }

                    calendar.drawShadow(start.x, start.y, 0, width);

                }
                else if (DayPilotMonth.movingEvent) {
                    var coords = DayPilot.mo3(calendar.nav.top, ev);

                    if (!coords) {
                        return;
                    }

                    // not actually moved, Chrome bug
                    if (coords.x === DayPilotMonth.movingEvent.coords.x && coords.y === DayPilotMonth.movingEvent.coords.y) {
                        return;
                    }

                    var minDistance = 3;
                    var distance = Math.abs(coords.x - DayPilotMonth.movingEvent.coords.x) + Math.abs(coords.y - DayPilotMonth.movingEvent.coords.y);
                    if (distance <= minDistance) {
                        return;
                    }

                    var cell = calendar.getCellBelowPoint(coords.x, coords.y);

                    calendar.clearShadow();

                    var event = DayPilotMonth.movingEvent.event;
                    var offset = DayPilotMonth.movingEvent.offset;
                    var width = calendar.cellMode ? 1 : DayPilot.DateUtil.daysSpan(event.start(), event.end()) + 1;

                    if (width < 1) {
                        width = 1;
                    }
                    calendar.drawShadow(cell.x, cell.y, 0, width, offset, event);
                }
                else if (DayPilotMonth.timeRangeSelecting) {
                    var coords = DayPilot.mo3(calendar.nav.top, ev);

                    if (!coords) {
                        return;
                    }

                    var cell = calendar.getCellBelowPoint(coords.x, coords.y);

                    calendar.clearShadow();

                    var start = DayPilotMonth.timeRangeSelecting;

                    var startIndex = start.y * 7 + start.x;
                    var cellIndex = cell.y * 7 + cell.x;

                    var width = Math.abs(cellIndex - startIndex) + 1;

                    if (width < 1) {
                        width = 1;
                    }

                    var shadowStart = startIndex < cellIndex ? start : cell;

                    DayPilotMonth.timeRangeSelecting.from = { x: shadowStart.x, y: shadowStart.y };
                    DayPilotMonth.timeRangeSelecting.width = width;
                    DayPilotMonth.timeRangeSelecting.moved = true;

                    calendar.drawShadow(shadowStart.x, shadowStart.y, 0, width, 0, null);

                }

            };

            //this.nav.top.appendChild(this.vsph);
        };

        this._updateHeight = function() {
            this.nav.top.style.height = this.getHeight() + 'px';

            for (var x = 0; x < this.cells.length; x++) {
                for (var y = 0; y < this.cells[x].length; y++) {
                    this.cells[x][y].style.top = this.getRowTop(y) + 'px';
                    this.cells[x][y].style.height = this.rows[y].getHeight() + 'px';
                }
            }
        };

        this.getCellBelowPoint = function(x, y) {
            var columnWidth = Math.floor(this.nav.top.clientWidth / this.getColCount());
            var column = Math.min(Math.floor(x / columnWidth), this.getColCount() - 1);

            var row = null;

            var height = this.headerHeight;
            var relativeY = 0;
            for (var i = 0; i < this.rows.length; i++) {
                var baseHeight = height;
                height += this.rows[i].getHeight();
                if (y < height) {
                    relativeY = y - baseHeight;
                    row = i;
                    break;
                }
            }
            if (row === null) {
                row = this.rows.length - 1; // might be a pixel below the last line
            }

            var cell = {};
            cell.x = column;
            cell.y = row;
            cell.relativeY = relativeY;

            return cell;
        };

        this.getCellFromDate = function(date) {
            var width = DayPilot.DateUtil.daysDiff(this.firstDate, date);
            var cell = { x: 0, y: 0 };
            while (width >= 7) {
                cell.y++;
                width -= 7;
            }
            cell.x = width;
            return cell;
        };

        this._drawTable = function() {

            var table = document.createElement("div");
            table.oncontextmenu = function() { return false; };
            this.nav.cells.appendChild(table);

            this.cells = [];

            for (var x = 0; x < this.getColCount(); x++) {

                this.cells[x] = [];
                var headerProperties = null;

                var header = document.createElement("div");
                header.setAttribute("unselectable", "on");
                header.style.position = 'absolute';

                header.style.left = (this.getCellWidth() * x) + '%';
                header.style.width = (this.getCellWidth()) + '%';
                header.style.top = '0px';
                header.style.height = (this.headerHeight) + 'px';

                var dayIndex = x + this.getWeekStart();
                if (dayIndex > 6) {
                    dayIndex -= 7;
                }

                header.className = this._prefixCssClass("_header");

                var inner = document.createElement("div");
                inner.setAttribute("unselectable", "on");
                inner.innerHTML = resolved.locale().dayNames[dayIndex];

                header.appendChild(inner);

                inner.style.position = "absolute";
                inner.style.top = "0px";
                inner.style.bottom = "0px";
                inner.style.left = "0px";
                inner.style.right = "0px";
                inner.className = this._prefixCssClass("_header_inner");

                inner.innerHTML = resolved.locale().dayNames[dayIndex];

                table.appendChild(header);

                for (var y = 0; y < this.rows.length; y++) {
                    this._drawCell(x, y, table);
                }

            }

        };

        this._clearTable = function() {

            // clear event handlers
            for (var x = 0; x < this.cells.length; x++) {
                for (var y = 0; y < this.cells[x].length; y++) {
                    this.cells[x][y].onclick = null;
                }
            }

            this.nav.cells.innerHTML = '';

        };

        this._api2 = function() {
            return calendar.api === 2;
        };
        this._drawCell = function(x, y, table) {

            var row = this.rows[y];
            var d = this.firstDate.addDays(y * 7 + x);

            var date = d.getDay();
            var headerHtml = null;
            if (date === 1) {
                headerHtml = resolved.locale().monthNames[d.getMonth()] + ' ' + date;
            }
            else {
                headerHtml = "" + date;
            }
            var business = !calendar.isWeekend(d);

            var args = {};
            args.control = calendar;
            args.cell = {};
            args.cell.start = d;
            args.cell.end = d.addDays(1);
            args.cell.properties = {
                "headerHtml": headerHtml,
                "backColor": null,
                "business": business,
                "html": null
            };
            if (typeof calendar.onBeforeCellRender === "function") {
                calendar.onBeforeCellRender(args);
            }

            var props = args.cell.properties;

            var cell = document.createElement("div");
            cell.setAttribute("unselectable", "on");
            cell.style.position = 'absolute';
            cell.style.cursor = 'default';
            cell.style.left = (this.getCellWidth() * x) + '%';
            cell.style.width = (this.getCellWidth()) + '%';
            cell.style.top = (this.getRowTop(y)) + 'px';
            cell.style.height = (row.getHeight()) + 'px';
            cell.className = this._prefixCssClass("_cell");

            if (props.business) {
                var business = this._prefixCssClass("_cell_business");
                DayPilot.Util.addClass(cell, business);
            }

            var previousMonth = this.startDate.addMonths(-1).getMonth();
            var nextMonth = this.startDate.addMonths(1).getMonth();

            var thisMonth = this.startDate.getMonth();

            var inner = document.createElement("div");
            inner.setAttribute("unselectable", "on");
            cell.appendChild(inner);

            inner.style.position = "absolute";
            inner.style.left = "0px";
            inner.style.right = "0px";
            inner.style.top = "0px";
            inner.style.bottom = "0px";
            inner.className = this._prefixCssClass("_cell_inner");

            if (props.backColor) {
                inner.style.backgroundColor = args.cell.properties.backColor;
            }

            cell.onmousedown = function(e) {
                if (calendar.timeRangeSelectedHandling !== 'Disabled') {
                    calendar.clearShadow();
                    DayPilotMonth.timeRangeSelecting = { "root": calendar, "x": x, "y": y, "from": { x: x, y: y }, "width": 1 };
                }
            };

            cell.onclick = function() {

                var single = function(d) {
                    var start = new DayPilot.Date(d);
                    var end = start.addDays(1);
                    calendar._timeRangeSelectedDispatch(start, end);
                };

                if (calendar.timeRangeSelectedHandling !== 'Disabled') {
                    single(d);
                    return;
                }

            };

            var day = document.createElement("div");
            day.setAttribute("unselectable", "on");
            day.style.height = this.cellHeaderHeight + "px";
            day.className = this._prefixCssClass("_cell_header");

            day.onclick = function(ev) {

                if (calendar.cellHeaderClickHandling !== "Enabled") {
                    return;
                }

                ev.stopPropagation();

                var args = {};
                args.control = calendar;
                args.start = d;
                args.end = d.addDays(1);
                args.preventDefault = function() {
                    this.preventDefault.value = true;
                };

                if (typeof calendar.onCellHeaderClick === "function") {
                    calendar.onCellHeaderClick(args);
                    if (args.preventDefault.value) {
                        return;
                    }
                }

                if (typeof calendar.onCellHeaderClicked === "function") {
                    calendar.onCellHeaderClicked(args);
                }

            };

            day.innerHTML = props.headerHtml;

            inner.appendChild(day);

            if (props.html) {
                var html = document.createElement("div");
                html.style.height = (row.getHeight() - this.cellHeaderHeight) + 'px';
                html.style.overflow = 'hidden';
                html.innerHTML = props.html;
                inner.appendChild(html);
            }

            this.cells[x][y] = cell;

            table.appendChild(cell);
        };

        this.getWeekStart = function() {
            if (calendar.weekStarts === 'Auto') {
                var locale = resolved.locale();
                if (locale) {
                    return locale.weekStarts;
                }
                else {
                    return 0; // Sunday
                }
            }
            else {
                return calendar.weekStarts || 0;
            }
            return resolved.locale().weekStarts;
        };

        this.getColCount = function() {
            return 7;
        };

        this.getCellWidth = function() {
            return 14.285;
        };

        this.getRowTop = function(index) {
            var top = this.headerHeight;
            for (var i = 0; i < index; i++) {
                top += this.rows[i].getHeight();
            }
            return top;
        };

        this._callBack2 = function(action, data, parameters) {

            var envelope = {};

            envelope.action = action;
            envelope.parameters = parameters;
            envelope.data = data;
            envelope.header = this._getCallBackHeader();

            var commandstring = "JSON" + DayPilot.JSON.stringify(envelope);

            if (this.backendUrl) {
                DayPilot.request(this.backendUrl, this._callBackResponse, commandstring, this.ajaxError);
            }
        };

        this._callBackResponse = function(response) {
            calendar._updateView(response.responseText);
        };

        this._getCallBackHeader = function() {
            var h = {};
            h.control = "dpm";
            h.id = this.id;
            h.v = this.v;

            h.visibleStart = new DayPilot.Date(this.firstDate);
            h.visibleEnd = h.visibleStart.addDays(this.days);

            h.startDate = calendar.startDate;
            // h.headerBackColor = this.headerBackColor;
            // h.backColor = this.backColor;
            // h.nonBusinessBackColor = this.nonBusinessBackColor;
            h.timeFormat = this.timeFormat;
            h.weekStarts = this.weekStarts;

            return h;
        };

        this.eventClickCallBack = function(e, data) {
            this._callBack2('EventClick', data, e);
        };

        this._eventClickDispatch = function(e) {

            DayPilotMonth.movingEvent = null;
            DayPilotMonth.resizingEvent = null;

            var div = this;

            var e = e || window.event;
            var ctrlKey = e.ctrlKey;

            e.cancelBubble = true;
            if (e.stopPropagation) {
                e.stopPropagation();
            }

            calendar.eventClickSingle(div, e);
        };


        this.eventClickSingle = function(div, ev) {
            var e = div.event;
            if (!e) {
                return;
            }
            if (!e.client.clickEnabled()) {
                return;
            }

            if (calendar._api2()) {

                var args = {};
                args.e = e;
                args.control = calendar;
                args.div = div;
                args.originalEvent = ev;
                args.meta = ev.metaKey;
                args.ctrl = ev.ctrlKey;
                args.preventDefault = function() {
                    this.preventDefault.value = true;
                };

                if (typeof calendar.onEventClick === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onEventClick(args);
                    });
                    if (args.preventDefault.value) {
                        return;
                    }
                }

                switch (calendar.eventClickHandling) {
                    case 'CallBack':
                        calendar.eventClickCallBack(e);
                        break;
                    case 'ContextMenu':
                        var menu = e.client.contextMenu();
                        if (menu) {
                            menu.show(e);
                        }
                        else {
                            if (calendar.contextMenu) {
                                calendar.contextMenu.show(e);
                            }
                        }
                        break;                }

                if (typeof calendar.onEventClicked === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onEventClicked(args);
                    });
                }
            }
            else {
                switch (calendar.eventClickHandling) {
                    case 'CallBack':
                        calendar.eventClickCallBack(e);
                        break;
                    case 'JavaScript':
                        calendar.onEventClick(e);
                        break;
                }
            }
        };

        this._onEventContextMenu  = function() {
            var e = this;
            calendar._eventRightClickDispatch(e.event);
            return false;
        };

        this._eventRightClickDispatch = function(e) {

            this.event = e;

            if (!e.client.rightClickEnabled()) {
                return false;
            }

            var args = {};
            args.e = e;
            args.preventDefault = function() {
                this.preventDefault.value = true;
            };

            if (typeof calendar.onEventRightClick === 'function') {
                calendar.onEventRightClick(args);
                if (args.preventDefault.value) {
                    return;
                }
            }

            switch (calendar.eventRightClickHandling) {
                case 'ContextMenu':
                    var menu = e.client.contextMenu();
                    if (menu) {
                        menu.show(e);
                    }
                    else {
                        if (calendar.contextMenu) {
                            calendar.contextMenu.show(this.event);
                        }
                    }
                    break;
            }

            if (typeof calendar.onEventRightClicked === 'function') {
                calendar.onEventRightClicked(args);
            }


            return false;
        };


        this._eventDeleteDispatch = function (e) {
            if (calendar._api2()) {

                var args = {};
                args.e = e;
                args.control = calendar;
                args.preventDefault = function() {
                    this.preventDefault.value = true;
                };

                if (typeof calendar.onEventDelete === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onEventDelete(args);
                    });
                    if (args.preventDefault.value) {
                        return;
                    }
                }

                switch (calendar.eventDeleteHandling) {
                    case 'CallBack':
                        calendar.eventDeleteCallBack(e);
                        break;
                    case 'PostBack':
                        calendar.eventDeletePostBack(e);
                        break;
                    case 'Update':
                        calendar.events.remove(e);
                        break;
                }

                if (typeof calendar.onEventDeleted === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onEventDeleted(args);
                    });
                }
            }
            else {
                switch (calendar.eventDeleteHandling) {
                    case 'PostBack':
                        calendar.eventDeletePostBack(e);
                        break;
                    case 'CallBack':
                        calendar.eventDeleteCallBack(e);
                        break;
                    case 'JavaScript':
                        calendar.onEventDelete(e);
                        break;
                }
            }

        };

        this.eventDeleteCallBack = function(e, data) {
            this._callBack2('EventDelete', data, e);
        };

        this.eventDeletePostBack = function(e, data) {
            this._postBack2('EventDelete', data, e);
        };

        this.eventMoveCallBack = function(e, newStart, newEnd, data, position) {
            if (!newStart)
                throw 'newStart is null';
            if (!newEnd)
                throw 'newEnd is null';

            var params = {};
            params.e = e;
            params.newStart = newStart;
            params.newEnd = newEnd;
            params.position = position;

            this._callBack2('EventMove', data, params);
        };

        this._eventMoveDispatch = function(e, x, y, offset, ev, position) {

            var startOffset = e.start().getTimePart();

            var endDate = e.end().getDatePart();
            if (endDate.getTime() !== e.end().getTime()) {
                endDate = endDate.addDays(1);
            }
            var endOffset = DayPilot.DateUtil.diff(e.end(), endDate);

            var boxStart = this.getDateFromCell(x, y);
            boxStart = boxStart.addDays(-offset);
            var width = DayPilot.DateUtil.daysSpan(e.start(), e.end()) + 1;

            var boxEnd = boxStart.addDays(width);

            var newStart = boxStart.addTime(startOffset);
            var newEnd = boxEnd.addTime(endOffset);

            if (calendar._api2()) {
                // API v2
                var args = {};

                args.e = e;
                args.control = calendar;
                args.newStart = newStart;
                args.newEnd = newEnd;
                args.ctrl = ev.ctrlKey;
                args.shift = ev.shiftKey;
                args.preventDefault = function() {
                    this.preventDefault.value = true;
                };

                if (typeof calendar.onEventMove === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onEventMove(args);
                    });
                    if (args.preventDefault.value) {
                        return;
                    }
                }

                switch (calendar.eventMoveHandling) {
                    case 'CallBack':
                        calendar.eventMoveCallBack(e, newStart, newEnd);
                        break;
                    case 'Update':
                        e.start(newStart);
                        e.end(newEnd);
                        calendar.events.update(e);
                        break;
                }

                if (typeof calendar.onEventMoved === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onEventMoved(args);
                    });
                }
            }
            else {
                switch (calendar.eventMoveHandling) {
                    case 'CallBack':
                        calendar.eventMoveCallBack(e, newStart, newEnd);
                        break;
                    case 'JavaScript':
                        calendar.onEventMove(e, newStart, newEnd);
                        break;
                }
            }
        };

        this.eventResizeCallBack = function(e, newStart, newEnd, data) {
            if (!newStart)
                throw 'newStart is null';
            if (!newEnd)
                throw 'newEnd is null';

            var params = {};
            params.e = e;
            params.newStart = newStart;
            params.newEnd = newEnd;

            this._callBack2('EventResize', data, params);
        };

        this._eventResizeDispatch = function(e, start, width) {
            var startOffset = e.start().getTimePart();

            var endDate = e.end().getDatePart();
            if (endDate.getTime() !== e.end().getTime()) {
                endDate = endDate.addDays(1);
            }
            var endOffset = DayPilot.DateUtil.diff(e.end(), endDate);

            var boxStart = this.getDateFromCell(start.x, start.y);
            //var width = DayPilot.Date.daysSpan(e.start(), e.end()) + 1;
            var boxEnd = boxStart.addDays(width);

            var newStart = boxStart.addTime(startOffset);
            var newEnd = boxEnd.addTime(endOffset);

            if (calendar._api2()) {
                // API v2
                var args = {};

                args.e = e;
                args.control = calendar;
                args.newStart = newStart;
                args.newEnd = newEnd;
                args.preventDefault = function() {
                    this.preventDefault.value = true;
                };

                if (typeof calendar.onEventResize === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onEventResize(args);
                    });

                    if (args.preventDefault.value) {
                        return;
                    }
                }

                switch (calendar.eventResizeHandling) {
                    case 'CallBack':
                        calendar.eventResizeCallBack(e, newStart, newEnd);
                        break;
                    case 'Update':
                        e.start(newStart);
                        e.end(newEnd);
                        calendar.events.update(e);
                        break;
                }

                if (typeof calendar.onEventResized === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onEventResized(args);
                    });
                }
            }
            else {
                switch (calendar.eventResizeHandling) {
                    case 'CallBack':
                        calendar.eventResizeCallBack(e, newStart, newEnd);
                        break;
                    case 'JavaScript':
                        calendar.onEventResize(e, newStart, newEnd);
                        break;
                }
            }

        };


        this.timeRangeSelectedCallBack = function(start, end, data) {

            var range = {};
            range.start = start;
            range.end = end;

            this._callBack2('TimeRangeSelected', data, range);
        };

        this._timeRangeSelectedDispatch = function(start, end) {
            if (this._api2()) {
                var args = {};
                args.control = calendar;
                args.start = start;
                args.end = end;
                args.preventDefault = function() {
                    this.preventDefault.value = true;
                };

                if (typeof calendar.onTimeRangeSelect === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onTimeRangeSelect(args);
                    });

                    if (args.preventDefault.value) {
                        return;
                    }
                }

                // now perform the default builtin action
                switch (calendar.timeRangeSelectedHandling) {
                    case 'CallBack':
                        calendar.timeRangeSelectedCallBack(start, end);
                        break;
                }

                if (typeof calendar.onTimeRangeSelected === 'function') {
                    calendar._angular.apply(function() {
                        calendar.onTimeRangeSelected(args);
                    });
                }
            }
            else {
                switch (calendar.timeRangeSelectedHandling) {
                    case 'CallBack':
                        calendar.timeRangeSelectedCallBack(start, end);
                        break;
                    case 'JavaScript':
                        calendar.onTimeRangeSelected(start, end);
                        break;
                }
            }
        };

        this._angular = {};
        this._angular.scope = null;
        this._angular.notify = function() {
            if (calendar._angular.scope) {
                calendar._angular.scope["$apply"]();
            }
        };
        this._angular.apply = function(f) {
            f();

            /*
            if (calendar.angularAutoApply && calendar._angular.scope) {
                calendar._angular.scope["$apply"](f);
            }
            else {
                f();
            }*/
        };

        this.clearSelection = function() {
            calendar.clearShadow();
        };

        this.commandCallBack = function(command, data) {

            var params = {};
            params.command = command;

            this._callBack2('Command', data, params);
        };

        this.isWeekend = function(date) {
            date = new DayPilot.Date(date);

            var sunday = 0;
            var saturday = 6;

            if (date.dayOfWeek() === sunday) {
                return true;
            }
            if (date.dayOfWeek() === saturday) {
                return true;
            }
            return false;
        };

        this._resolved = {};
        this._resolved.locale = function() {
            var found = DayPilot.Locale.find(calendar.locale);
            if (!found) {
                return DayPilot.Locale.US;
            }
            return found;
        };

        this._resolved._xssProtectionEnabled = function() {
            return calendar.xssProtection !== "Disabled";
        };


        var resolved = this._resolved;

        this.debug = function(msg, append) {
            if (!this.debuggingEnabled) {
                return;
            }

            if (!calendar.debugMessages) {
                calendar.debugMessages = [];
            }
            calendar.debugMessages.push(msg);

            if (typeof console !== 'undefined') {
                console.log(msg);
            }
        };

        this.dispose = function() {
            var c = calendar;

            if (c._disposed) {
                return;
            }
            c._disposed = true;

            c._deleteEvents();

            c.nav.top.removeAttribute("style");
            c.nav.top.removeAttribute("class");
            c.nav.top.innerHTML = '';
            c.nav.top.dp = null;

            c.nav.top.onmousemove = null;
            c.nav.top = null;

        };

        this.disposed = function() {
            return this._disposed;
        };

        this._registerGlobalHandlers = function() {
            if (!DayPilotMonth.globalHandlers) {
                DayPilotMonth.globalHandlers = true;
                DayPilot.re(document, 'mouseup', DayPilotMonth.gMouseUp);
            }
        };

        this.loadFromServer = function() {
            // make sure it has a place to ask
            if (this.backendUrl || typeof WebForm_DoCallback === 'function') {
                return (typeof calendar.events.list === 'undefined') || (!calendar.events.list);
            }
            else {
                return false;
            }

        };

        this._show = function() {
            if (this.nav.top.style.visibility === 'hidden') {
                this.nav.top.style.visibility = 'visible';
            }
        };

        this.show = function() {
            calendar.visible = true;
            calendar.nav.top.style.display = '';
        };

        this.hide = function() {
            calendar.visible = false;
            calendar.nav.top.style.display = 'none';
        };

        this._loadTop = function() {
            if (this.id && this.id.tagName) {
                this.nav.top = this.id;
            }
            else if (typeof this.id === "string") {
                this.nav.top = document.getElementById(this.id);
                if (!this.nav.top) {
                    throw "DayPilot.Month: The placeholder element not found: '" + id + "'.";
                }
            }
            else {
                throw "DayPilot.Month() constructor requires the target element or its ID as a parameter";
            }
        };

        this._initShort = function() {

            this._prepareRows();
            this._drawTop();
            this._drawTable();
            this._registerGlobalHandlers();
            this._callBack2('Init'); // load events
        };

        this._xssTextHtml = function(text, html) {

            if (calendar._resolved._xssProtectionEnabled()) {
                return DayPilot.Util.escapeTextHtml(text, html);
            }

            if (!DayPilot.Util.isNullOrUndefined(html)) {
                return html;
            }
            if (DayPilot.Util.isNullOrUndefined(text)) {
                return "";
            }
            return text;
        };

        this.internal = {};
        this.internal.loadOptions = this._loadOptions;
        this.internal.xssTextHtml = calendar._xssTextHtml;

        this.init = function() {
            this._loadTop();

            var loadFromServer = this.loadFromServer();

            if (loadFromServer) {
                this._initShort();
                return;
            }

            this._prepareRows();
            this._loadEvents();
            this._drawTop();
            this._drawTable();
            this._show();
            this._drawEvents();

            this._registerGlobalHandlers();

            this.fireAfterRenderDetached(null, false);

            this._initialized = true;

            return this;
        };

        this.Init = this.init;

        // API compatibility (common)
        Object.defineProperty(this, 'durationBarVisible', { get: function() { return calendar.eventBarVisible; } });

        this._loadOptions(options);
    };

    DayPilotMonth.gMouseUp = function(ev) {

        if (DayPilotMonth.movingEvent) {
            var src = DayPilotMonth.movingEvent;

            if (!src.event) {
                return;
            }
            if (!src.event.calendar) {
                return;
            }
            if (!src.event.calendar.shadow) {
                return;
            }
            if (!src.event.calendar.shadow.start) {
                return;
            }

            // load ref
            var calendar = DayPilotMonth.movingEvent.event.calendar;
            var e = DayPilotMonth.movingEvent.event;
            var start = calendar.shadow.start;
            var position = calendar.shadow.position;
            var offset = DayPilotMonth.movingEvent.offset;

            // cleanup
            calendar.clearShadow();
            DayPilotMonth.movingEvent = null;

            var ev = ev || window.event;

            // fire the event
            calendar._eventMoveDispatch(e, start.x, start.y, offset, ev, position);

            ev.cancelBubble = true;
            if (ev.stopPropagation) {
                ev.stopPropagation();
            }
            DayPilotMonth.movingEvent = null;
            return false;
        }
        else if (DayPilotMonth.resizingEvent) {
            var src = DayPilotMonth.resizingEvent;

            if (!src.event) {
                return;
            }
            if (!src.event.calendar) {
                return;
            }
            if (!src.event.calendar.shadow) {
                return;
            }
            if (!src.event.calendar.shadow.start) {
                return;
            }

            // load ref
            var calendar = DayPilotMonth.resizingEvent.event.calendar;

            var e = DayPilotMonth.resizingEvent.event;
            var start = calendar.shadow.start;
            var width = calendar.shadow.width;

            // cleanup
            calendar.clearShadow();
            DayPilotMonth.resizingEvent = null;

            // fire the event
            calendar._eventResizeDispatch(e, start, width);

            ev.cancelBubble = true;
            DayPilotMonth.resizingEvent = null;
            return false;
        }
        else if (DayPilotMonth.timeRangeSelecting) {
            if (DayPilotMonth.timeRangeSelecting.moved) {
                var sel = DayPilotMonth.timeRangeSelecting;
                var calendar = sel.root;

                var start = new DayPilot.Date(calendar.getDateFromCell(sel.from.x, sel.from.y));
                var end = start.addDays(sel.width);
                calendar._timeRangeSelectedDispatch(start, end);

                calendar.clearShadow();
            }
            DayPilotMonth.timeRangeSelecting = null;
        }
    };

    // publish the API

    // current
    DayPilot.Month = DayPilotMonth.Month;

    // experimental jQuery bindings
    if (typeof jQuery !== 'undefined') {
        (function($) {
            $.fn.daypilotMonth = function(options) {
                var first = null;
                var j = this.each(function() {
                    if (this.daypilot) { // already initialized
                        return;
                    };

                    var daypilot = new DayPilot.Month(this.id);
                    this.daypilot = daypilot;
                    for (name in options) {
                        daypilot[name] = options[name];
                    }
                    daypilot.Init();
                    if (!first) {
                        first = daypilot;
                    }
                });
                if (this.length === 1) {
                    return first;
                }
                else {
                    return j;
                }
            };
        })(jQuery);
    }

    (function registerAngularModule() {

        var app = DayPilot.am();

        if (!app) {
            return;
        }

        app.directive("daypilotMonth", ['$parse', function($parse) {
            return {
                "restrict": "E",
                "template": "<div></div>",
                "replace": true,
                "link": function (scope, element, attrs) {

                    var calendar = new DayPilot.Month(element[0]);
                    calendar._angular.scope = scope;
                    calendar.init();

                    var oattr = attrs["id"];
                    if (oattr) {
                        scope[oattr] = calendar;
                    }

                    // save DayPilot.Calendar object in the specified variable
                    var pas = attrs["publishAs"];
                    if (pas) {
                        var getter = $parse(pas);
                        var setter = getter.assign;
                        setter(scope, calendar);
                    }

                    // bind event handlers from attributes starting with "on"
                    for (var name in attrs) {
                        if (name.indexOf("on") === 0) {  // event handler
                            (function(name) {
                                calendar[name] = function(args) {
                                    var f = $parse(attrs[name]);
                                    scope["$apply"](function() {
                                        f(scope, {"args": args});
                                    });
                                };
                            })(name);
                        }
                    }

                    var watch = scope["$watch"];
                    var config = attrs["config"] || attrs["daypilotConfig"];
                    var events = attrs["events"] || attrs["daypilotEvents"];

                    //var watch = scope["$watch"];

                    watch.call(scope, config, function (value) {
                        for (var name in value) {
                            calendar[name] = value[name];
                        }
                        calendar.update();
                    }, true);

                    watch.call(scope, events, function(value) {
                        calendar.events.list = value;
                        calendar.update();
                    }, true);

                }
            };
        }]);
    })();


    if (typeof Sys !== 'undefined' && Sys.Application && Sys.Application.notifyScriptLoaded) {
        Sys.Application.notifyScriptLoaded();
    }


})();
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

(function() {

    if (typeof DayPilot.Navigator !== 'undefined' && DayPilot.Navigator.nav) {
        return;
    }

    var DayPilotNavigator = {};
    DayPilot.Navigator = function(id, options) {
        this.v = '2024.3.543-lite';
        var calendar = this;
        this.id = id;
        this.api = 2;
        this.isNavigator = true;

        this.autoFocusOnClick = true;
        this.weekStarts = 'Auto'; // 0 = Sunday, 1 = Monday, ... 'Auto' = according to locale
        this.selectMode = 'Day'; // day/week/month/none
        this.titleHeight = 30;
        this.dayHeaderHeight = 30;
        this.bound = null;
        this.cellWidth = 30;
        this.cellHeight = 30;
        this.cssClassPrefix = "navigator_default";
        this.freeHandSelectionEnabled = false;
        this.selectionStart = new DayPilot.Date().getDatePart();  // today
        this.selectionEnd = null;
        this.selectionDay = null;
        this.showMonths = 1;
        this.skipMonths = 1;
        this.command = "navigate";
        this.year = new DayPilot.Date().getYear();
        this.month = new DayPilot.Date().getMonth() + 1;
        this.showWeekNumbers = false;
        this.weekNumberAlgorithm = 'Auto';
        this.rowsPerMonth = 'Six';  // Six, Auto
        this.orientation = "Vertical";
        this.locale = "en-us";
        this.rtl = false;
        this.visible = true;

        this.timeRangeSelectedHandling = "Bind";
        this.visibleRangeChangedHandling = "Enabled";

        this.onVisibleRangeChange = null;
        this.onVisibleRangeChanged = null;
        this.onTimeRangeSelect = null;
        this.onTimeRangeSelected = null;

        this.nav = {};

        this._cache = {};

        this._prepare = function() {

            this.root.dp = this;

            this.root.className = this._prefixCssClass('_main');

            if (this.orientation === "Horizontal") {
                this.root.style.width = this.showMonths * (resolved.cellWidth() * 7 + this._weekNumberWidth()) + 'px';
                this.root.style.height = (this.cellHeight*6 + this.titleHeight + this.dayHeaderHeight) + 'px';
            }
            else {
                this.root.style.width = (resolved.cellWidth() * 7 + this._weekNumberWidth()) + 'px';
            }
            //this.root.style.height = (this.showMonths*(this.cellHeight*6 + this.titleHeight + this.dayHeaderHeight)) + 'px';

            if (this.rtl) {
                this.root.style.direction = "rtl";
            }

            this.root.style.position = "relative";

            if (!this.visible) {
                this.root.style.display = "none";
            }

            var vsph = document.createElement("input");
            vsph.type = 'hidden';
            vsph.name = calendar.id + "_state";
            vsph.id = vsph.name;
            //vsph.value = result.VsUpdate;
            this.root.appendChild(vsph);
            this.state = vsph;

            if (!this.startDate) {
                if (this.selectionDay) {
                    this.startDate = new DayPilot.Date(this.selectionDay).firstDayOfMonth();
                }
                else {
                    this.startDate = DayPilot.Date.fromYearMonthDay(this.year, this.month);
                }
            }
            else { // make sure it's the first day
                this.startDate = new DayPilot.Date(this.startDate).firstDayOfMonth();
            }

            this.calendars = [];
            this.selected = [];
            this.months = [];
        };

        this._api2 = function() {
            return calendar.api === 2;
        };

        this._clearTable = function() {
            // TODO do something smarter here
            this.root.innerHTML = '';
        };

        this._prefixCssClass = function(part) {
            var prefix = this.theme || this.cssClassPrefix;
            if (prefix) {
                return prefix + part;
            }
            else {
                return "";
            }
        };

        this._addClass = function(object, name) {
            var fullName = this._prefixCssClass("_" + name);
            DayPilot.Util.addClass(object, fullName);
        };

        this._removeClass = function(object, name) {
            var fullName = this._prefixCssClass("_" + name);
            DayPilot.Util.removeClass(object, fullName);
        };

        this._drawTable = function(j, showLinks) {
            var month = {};
            month.cells = [];
            month.days = [];
            month.weeks = [];

            var startDate = this.startDate.addMonths(j);

            var showBefore = showLinks.before;
            var showAfter = showLinks.after;

            var firstOfMonth = startDate.firstDayOfMonth();
            var first = firstOfMonth.firstDayOfWeek(resolved.weekStarts());

            var last = firstOfMonth.addMonths(1);
            var days = DayPilot.DateUtil.daysDiff(first, last);

            var rowCount = (this.rowsPerMonth === "Auto") ? Math.ceil(days / 7) : 6;
            month.rowCount = rowCount;
            var today = (new DayPilot.Date()).getDatePart();

            var width = resolved.cellWidth() * 7 + this._weekNumberWidth();
            month.width = width;
            var height = this.cellHeight * rowCount + this.titleHeight + this.dayHeaderHeight;
            month.height = height;

            var main = document.createElement("div");
            main.style.width = (width) + 'px';
            main.style.height = (height) + 'px';


            if (this.orientation === "Horizontal") {
                main.style.position = "absolute";
                main.style.left = (width * j) + "px";
                main.style.top = "0px";

                month.top = 0;
                month.left = width * j;
            }
            else {
                main.style.position = 'relative';

                var above = j > 0 ? calendar.months[j - 1].top + calendar.months[j - 1].height : 0;
                month.top = above;

                month.left = 0;
            }

            main.className = this._prefixCssClass('_month');
            main.style.cursor = 'default';
            main.style.MozUserSelect = 'none';
            main.style.KhtmlUserSelect = 'none';
            main.style.WebkitUserSelect = 'none';

            main.month = month;

            this.root.appendChild(main);

            var totalHeaderHeight = this.titleHeight + this.dayHeaderHeight;

            // title left
            var tl = document.createElement("div");
            tl.style.position = 'absolute';
            tl.style.left = '0px';
            tl.style.right = '0px';  // rtl
            tl.style.top = '0px';
            tl.style.width = resolved.cellWidth() + 'px';
            tl.style.height = this.titleHeight + 'px';
            tl.style.lineHeight = this.titleHeight + 'px';
            //tl.style.textAlign = 'left';
            tl.setAttribute("unselectable", "on");
            tl.className = this._prefixCssClass('_titleleft');
            if (showLinks.left) {
                tl.style.cursor = 'pointer';
                tl.innerHTML = "<span>&lt;</span>";
                tl.onclick = this._clickLeft;
            }
            main.appendChild(tl);
            this.tl = tl;

            // title center
            var ti = document.createElement("div");
            ti.style.position = 'absolute';
            ti.style.left = resolved.cellWidth() + 'px';
            ti.style.top = '0px';
            ti.style.width = (resolved.cellWidth() * 5 + this._weekNumberWidth()) + 'px';
            ti.style.height = this.titleHeight + 'px';
            ti.style.lineHeight = this.titleHeight + 'px';
            //ti.style.textAlign = 'center';
            ti.setAttribute("unselectable", "on");
            ti.className = this._prefixCssClass('_title');
            ti.innerHTML = resolved.locale().monthNames[startDate.getMonth()] + ' ' + startDate.getYear();
            main.appendChild(ti);
            this.ti = ti;

            // title right
            var tr = document.createElement("div");
            tr.style.position = 'absolute';
            tr.style.left = (resolved.cellWidth() * 6 + this._weekNumberWidth()) + 'px';
            tr.style.right = (resolved.cellWidth() * 6 + this._weekNumberWidth()) + 'px';  // rtl
            tr.style.top = '0px';
            tr.style.width = resolved.cellWidth() + 'px';
            tr.style.height = this.titleHeight + 'px';
            tr.style.lineHeight = this.titleHeight + 'px';
            //tr.style.textAlign = 'right';
            tr.setAttribute("unselectable", "on");
            tr.className = this._prefixCssClass('_titleright');
            if (showLinks.right) {
                tr.style.cursor = 'pointer';
                tr.innerHTML = "<span>&gt;</span>";
                tr.onclick = this._clickRight;
            }
            main.appendChild(tr);
            this.tr = tr;


            var xOffset = this._weekNumberWidth();
            if (this.showWeekNumbers) {
                for (var y = 0; y < rowCount; y++) {
                    var day = first.addDays(y * 7);
                    var weekNumber = null;
                    switch (this.weekNumberAlgorithm) {
                        case "Auto":
                            weekNumber = (resolved.weekStarts() === 1) ? day.weekNumberISO() : day.weekNumber();
                            break;
                        case "US":
                            weekNumber = day.weekNumber();
                            break;
                        case "ISO8601":
                            weekNumber = day.weekNumberISO();
                            break;
                        default:
                            throw "Unknown weekNumberAlgorithm value.";
                    }

                    var dh = document.createElement("div");
                    dh.style.position = 'absolute';
                    dh.style.left = (0) + 'px';
                    dh.style.right = (0) + 'px';
                    dh.style.top = (y * this.cellHeight + totalHeaderHeight) + 'px';
                    dh.style.width = resolved.cellWidth() + 'px';
                    dh.style.height = this.cellHeight + 'px';
                    dh.style.lineHeight = this.cellHeight + 'px';
                    //dh.style.textAlign = 'right';
                    dh.setAttribute("unselectable", "on");
                    dh.className = this._prefixCssClass('_weeknumber');
                    //dh.innerHTML = "<span style='margin-right: 2px'>" + weekNumber + "</span>";
                    dh.innerHTML = "<span>" + weekNumber + "</span>";
                    main.appendChild(dh);
                    month.weeks.push(dh);
                }
            }


            for (var x = 0; x < 7; x++) {
                month.cells[x] = [];

                // day header
                var dh = document.createElement("div");
                dh.style.position = 'absolute';
                dh.style.left = (x * resolved.cellWidth() + xOffset) + 'px';
                dh.style.right = (x * resolved.cellWidth() + xOffset) + 'px';  // rtl
                dh.style.top = this.titleHeight + 'px';
                dh.style.width = resolved.cellWidth() + 'px';
                dh.style.height = this.dayHeaderHeight + 'px';
                dh.style.lineHeight = this.dayHeaderHeight + 'px';
                //dh.style.textAlign = 'right';
                dh.setAttribute("unselectable", "on");
                dh.className = this._prefixCssClass('_dayheader');
                dh.innerHTML = "<span>" + this._getDayName(x) + "</span>";
                main.appendChild(dh);
                month.days.push(dh);

                for (var y = 0; y < rowCount; y++) {
                    var day = first.addDays(y * 7 + x);

                    var isSelected = this._isSelected(day) && this._selectModeLowerCase() !== 'none';
                    var isCurrentMonth = day.firstDayOfMonth() === startDate;
                    var isPrevMonth = day < startDate;
                    var isNextMonth = day >= startDate.addMonths(1);

                    if (this._selectModeLowerCase() === "month") {
                        isSelected = isSelected && isCurrentMonth;
                    }
                    else if (this._selectModeLowerCase() === "day") {
                        isSelected = isSelected && (isCurrentMonth || (showBefore && isPrevMonth) || (showAfter && isNextMonth));
                    }
                    else if (this._selectModeLowerCase() === "week") {
                        //var sd = this.selectionDay || this.selectionStart;
                        var isSelectionCurrentMonth = day.firstDayOfMonth() === startDate;
                        isSelected = isSelected && (isSelectionCurrentMonth || (showBefore && isPrevMonth) || (showAfter && isNextMonth));
                    }

                    var dc = document.createElement("div");
                    month.cells[x][y] = dc;

                    var cellPos = calendar._cellRelativeCoords(x, y);
                    var left = cellPos.x;
                    var top = cellPos.y;

                    dc.day = day;
                    dc.x = x;
                    dc.y = y;
                    dc.left = left;
                    dc.top = top;
                    dc.isCurrentMonth = isCurrentMonth;
                    dc.isNextMonth = isNextMonth;
                    dc.isPrevMonth = isPrevMonth;
                    dc.showBefore = showBefore;
                    dc.showAfter = showAfter;
                    dc.className = this._prefixCssClass((isCurrentMonth ? '_day' : '_dayother'));
                    calendar._addClass(dc, "cell");
                    if (day.getTime() === today.getTime() && isCurrentMonth) {
                        this._addClass(dc, 'today');
                    }
                    if (day.dayOfWeek() === 0 || day.dayOfWeek() === 6) {
                        this._addClass(dc, 'weekend');
                    }

                    dc.style.position = 'absolute';
                    dc.style.left = (left) + 'px';
                    dc.style.right = (left) + 'px';  // rtl
                    dc.style.top = (top) + 'px';
                    dc.style.width = resolved.cellWidth() + 'px';
                    dc.style.height = this.cellHeight + 'px';
                    dc.style.lineHeight = this.cellHeight + 'px'; // vertical alignment
                    //dc.style.textAlign = 'right';
                    //dc.style.border = '1px solid white';

                    var inner = document.createElement("div");
                    inner.style.position = 'absolute';
                    inner.className = (day.getTime() === today.getTime() && isCurrentMonth) ? this._prefixCssClass('_todaybox') : this._prefixCssClass('_daybox');
                    calendar._addClass(inner, "cell_box");
                    //inner.style.boxSizing = "border-box";
                    inner.style.left = '0px';
                    inner.style.top = '0px';
                    inner.style.right = '0px';
                    inner.style.bottom = '0px';
                    //inner.style.width = (this.cellWidth - 2) + 'px';
                    //inner.style.height = (this.cellHeight - 2) + 'px';
                    dc.appendChild(inner);

                    /*
                    if (isCurrentMonth) {
                    dc.style.cursor = 'pointer';
                    }
                    */

                    var cell = null;
                    if (this.cells && this.cells[day.toStringSortable()]) {
                        cell = this.cells[day.toStringSortable()];
                    }

                    if (typeof calendar.onBeforeCellRender === "function") {
                        var args = {};
                        args.cell = cell || {};
                        args.cell.day = day;
                        args.cell.isCurrentMonth = isCurrentMonth;
                        args.cell.isToday = day.getTime() === today.getTime() && isCurrentMonth;
                        args.cell.isWeekend = day.dayOfWeek() === 0 || day.dayOfWeek() === 6;
                        if (cell) {
                            args.cell.html = cell.html || day.getDay();
                            args.cell.cssClass = cell.css;
                        }
                        else {
                            args.cell.html = day.getDay();
                            args.cell.cssClass = null;
                        }

                        calendar.onBeforeCellRender(args);

                        cell = args.cell;
                    }

                    if (cell) {
                        DayPilot.Util.addClass(dc, cell.cssClass || cell.css);
                    }

                    //var span = null;
                    if (isCurrentMonth || (showBefore && isPrevMonth) || (showAfter && isNextMonth)) {
                        var text = document.createElement("div");
                        text.innerHTML = day.getDay();
                        text.style.position = "absolute";
                        text.style.left = '0px';
                        text.style.top = '0px';
                        text.style.right = '0px';
                        text.style.bottom = '0px';
                        calendar._addClass(text, "cell_text");

                        // dc.style.cursor = 'pointer';
                        dc.isClickable = true;

                        if (cell && cell.html) {
                            text.innerHTML = cell.html;
                        }

                        dc.appendChild(text);
                    }


                    dc.setAttribute("unselectable", "on");

                    dc.onclick = this._cellClick;

                    main.appendChild(dc);

                    if (isSelected) {
                        calendar._cellSelect(main, x, y);
                        this.selected.push(dc);
                    }

                }
            }

            var line = document.createElement("div");
            line.style.position = 'absolute';
            line.style.left = '0px';
            line.style.top = (totalHeaderHeight - 2) + 'px';
            line.style.width = (resolved.cellWidth() * 7 + this._weekNumberWidth()) + 'px';
            line.style.height = '1px';
            line.style.fontSize = '1px';
            line.style.lineHeight = '1px';
            line.className = this._prefixCssClass("_line");

            main.appendChild(line);
            this.months.push(month);
        };

        this._cellRelativeCoords = function(x, y) {
            var totalHeaderHeight = this.titleHeight + this.dayHeaderHeight;
            var xOffset = this._weekNumberWidth();
            var left = x * resolved.cellWidth() + xOffset;
            var top = y * this.cellHeight + totalHeaderHeight;

            return {
                "x": left,
                "y": top
            };

        };

        this._cellSelect = function(main, x, y) {
            var div = main.month.cells[x][y];

            calendar._addClass(div, 'select');

            /*
            if (div.selectDiv) {
                return;
            }

            var xOffset = this._weekNumberWidth();
            var totalHeaderHeight = this.titleHeight + this.dayHeaderHeight;

            // overlay select
            var od = document.createElement("div");
            od.style.position = 'absolute';
            od.style.left = (x * this.cellWidth + xOffset) + 'px';
            od.style.top = (y * this.cellHeight + totalHeaderHeight) + 'px';
            od.style.width = this.cellWidth + 'px';
            od.style.height = this.cellHeight + 'px';
            od.className = calendar._prefixCssClass("_selected_overlay");

            div.selectDiv = od;

            main.appendChild(od);
            */
        };

        this._cellUnselect = function(main, x, y) {
            var div = main.month.cells[x][y];

            calendar._removeClass(div, 'select');

            /*
            DayPilot.de(div.selectDiv);
            div.selectDiv = null;
            */
        };

        this._weekNumberWidth = function() {
            if (this.showWeekNumbers) {
                return resolved.cellWidth();
            }
            return 0;
        };

        this._updateFreeBusy = function() {
            if (!this.items) {
                return;
            }

            for (var j = 0; j < this.showMonths; j++) {
                for (var x = 0; x < 7; x++) {
                    for (var y = 0; y < 6; y++) {
                        var cell = this.months[j].cells[x][y];
                        if (!cell) {
                            continue;
                        }
                        if (this.items[cell.day.toStringSortable()] === 1) {
                            this._addClass(cell, 'busy');
                            this._removeClass(cell, 'free');
                        }
                        else {
                            this._removeClass(cell, 'busy');
                            this._addClass(cell, 'free');
                        }
                    }
                }
            }
        };

        this._saveState = function() {
            var s = {};
            s.startDate = calendar.startDate;
            s.selectionStart = calendar.selectionStart;
            s.selectionEnd = calendar.selectionEnd.addDays(1);
            calendar.state.value = JSON.stringify(s);
        };

        this._selectModeLowerCase = function() {
            var selectMode = this.selectMode || "";
            return selectMode.toLowerCase();
        };

        this._adjustSelection = function() {

            var input = this.selectionDay || this.selectionStart;  // selectionDay is preferred
            if (!input) {
                input = DayPilot.Date.today();
            }
            input = new DayPilot.Date(input);  // make sure it's DayPilot.Date

            // ignores selectionEnd
            // uses selectMode
            switch (this._selectModeLowerCase()) {
                case 'day':
                    this.selectionStart = input;
                    this.selectionDay = input;
                    this.selectionEnd = input;
                    break;
                case 'week':
                    this.selectionDay = input;
                    this.selectionStart = input.firstDayOfWeek(resolved.weekStarts());
                    this.selectionEnd = this.selectionStart.addDays(6);
                    break;
                case 'month':
                    this.selectionDay = input;
                    this.selectionStart = input.firstDayOfMonth();
                    this.selectionEnd = this.selectionStart.lastDayOfMonth();
                    break;
                case 'none':
                    this.selectionEnd = input;
                    break;
                default:
                    throw "Unknown selectMode value.";
            }

        };

        this._postponedSelect = null;

        // options.dontFocus, options.dontNotify
        this.select = function(a1, a2, a3) {

            var a2IsDate = a2 && (a2 instanceof DayPilot.Date || typeof a2 === "string");
            var a2IsOptions = (a2 && typeof a2 === "object") || typeof a2 === "boolean";

            var date1 = a1;
            var date2 = a2IsDate ? a2 : null;
            var options = a2IsOptions ? a2 : a3;

            if (!this._initialized) {
                this._postponedSelect = {
                    "date1": date1,
                    "date2": date2,
                    "options": options
                };
                return;
            }

            var focus = true;
            var notify = true;  // fire the timeRangeSelected event

            if (options && typeof options === "object") {
                if (options.dontFocus) {
                    focus = false;
                }
                if (options.dontNotify) {
                    notify = false;
                }
            }
            else if (typeof options === "boolean") {
                focus = !options;
            }

            var originalStart = this.selectionStart;
            var originalEnd = this.selectionEnd;

            this.selectionStart = new DayPilot.Date(date1).getDatePart();
            this.selectionDay = this.selectionStart;

            var startChanged = false;
            if (focus) {

                var newStart = this.startDate;
                if (this.selectionStart < this._activeStart() || this.selectionStart >= this._activeEnd()) {
                    newStart = this.selectionStart.firstDayOfMonth();
                }

                if (newStart.toStringSortable() !== this.startDate.toStringSortable()) {
                    startChanged = true;
                }

                this.startDate = newStart;
            }

            if (date2 && calendar.freeHandSelectionEnabled) {
                calendar.selectionEnd = new DayPilot.Date(date2);
            }
            else {
                this._adjustSelection();
            }

            // redraw
            this._clearTable();
            this._prepare();
            this._drawMonths();
            this._updateFreeBusy();
            this._saveState();

            if (notify && (!originalStart.equals(this.selectionStart) || !originalEnd.equals(this.selectionEnd))) {
                //alert('time range');
                this._timeRangeSelectedDispatch();
            }

            if (startChanged) {
                //alert('visible range');
                this._visibleRangeChangedDispatch();
            }
        };

        this.update = function(options) {

            calendar._loadOptions(options);

/*
            if (!calendar._initialized) {
                throw new DayPilot.Exception("You are trying to update a DayPilot.Navigator instance that hasn't been initialized yet.");
            }
*/
            if (!this._initialized) {
                return;
            }

            if (calendar._disposed) {
                throw new DayPilot.Exception("You are trying to update a DayPilot.Navigator instance that has been disposed.");
            }

            calendar._clearCache();

            var os = {
                "day": calendar.selectionDay,
                "start": calendar.selectionStart,
                "end": calendar.selectionEnd
            };

            calendar._update();

            if (os.start !== calendar.selectionStart || os.end != calendar.selectionEnd || os.day !== calendar.selectionDay) {
                calendar._timeRangeSelectedDispatch();
            }
        };

        this._update = function () {
            // redraw
            this._clearTable();
            this._prepare();
            this._adjustSelection();
            this._drawMonths();
            this._loadEvents();
            this._updateFreeBusy();
            this._saveState();

            if (this.visible) {
                this.show();
            }
            else {
                this.hide();
            }
        };

        this._clearCache = function()  {
            calendar._cache = {};
        };

        this._specialHandling = null;
        this._loadOptions = function(options) {
            if (!options) {
                return;
            }
            var specialHandling = {
                "events": {
                    "preInit": function() {
                        var events = this.data || [];
                        if (DayPilot.isArray(events.list)) {
                            calendar.events.list = events.list;
                        }
                        else {
                            calendar.events.list = events;
                        }
                    }
                }
            };
            this._specialHandling = specialHandling;

            for (var name in options) {
                if (specialHandling[name]) {
                    var item = specialHandling[name];
                    item.data = options[name];
                    if (item.preInit) {
                        item.preInit();
                    }
                }
                else {
                    calendar[name] = options[name];
                }
            }

        };

        this._postInit = function() {
            var specialHandling = this._specialHandling;
            for (var name in specialHandling) {
                var item = specialHandling[name];
                if (item.postInit) {
                    item.postInit();
                }
            }
        };


        this._callBack2 = function(action, data, parameters) {
            var envelope = {};
            envelope.action = action;
            envelope.parameters = parameters;
            envelope.data = data;
            envelope.header = this._getCallBackHeader();

            var commandstring = "JSON" + JSON.stringify(envelope);

            var context = null;
            if (this.backendUrl) {
                DayPilot.request(this.backendUrl, this._callBackResponse, commandstring, this._ajaxError);
            }
            else {
                WebForm_DoCallback(this.uniqueID, commandstring, this._updateView, context, this.callbackError, true);
            }

        };

        this._ajaxError = function(req) {
            if (typeof calendar.onAjaxError === 'function') {
                var args = {};
                args.request = req;
                calendar.onAjaxError(args);
            }
            else if (typeof calendar.ajaxError === 'function') { // backwards compatibility
                calendar.ajaxError(req);
            }
        };

        this._callBackResponse = function(response) {
            calendar._updateView(response.responseText);
        };

        this._postBack2 = function(action, data, parameters) {
            var envelope = {};
            envelope.action = action;
            envelope.parameters = parameters;
            envelope.data = data;
            envelope.header = this._getCallBackHeader();

            var commandstring = "JSON" + JSON.stringify(envelope);
            __doPostBack(calendar.uniqueID, commandstring);
        };

        this._getCallBackHeader = function() {
            var h = {};
            h.v = this.v;
            h.startDate = this.startDate;
            h.selectionStart = this.selectionStart;
            h.showMonths = this.showMonths;
            return h;
        };

        this._listen = function(action, data) {
            if (action === 'refresh') {
                this._visibleRangeChangedDispatch();
            }
        };

        this._getDayName = function(i) {
            var x = i + resolved.weekStarts();
            if (x > 6) {
                x -= 7;
            }
            return resolved.locale().dayNamesShort[x];

        };

        this._isSelected = function(date) {
            if (this.selectionStart === null || this.selectionEnd === null) {
                return false;
            }

            if (this.selectionStart.getTime() <= date.getTime() && date.getTime() <= this.selectionEnd.getTime()) {
                return true;
            }

            return false;
        };

        this._getMonthFromCoords = function(coords) {
            var month = 0;
            //debugger;
            for (var i = 0; i < calendar.months.length; i++) {
                var m = calendar.months[i];
                if (!m) {
                    return null;
                }
                if (coords.x < m.left || m.width < coords.x ) {
                    return null;
                }

                var height = calendar.months[i].height;
                if (m.top <= coords.y && coords.y < m.top + m.height) {
                    return i;
                }
            }
            return null;

        };

        this._getPosition = function(ev) {

            var coords = DayPilot.mo3(calendar.nav.top, ev);

            var monthIndex = calendar._getMonthFromCoords(coords);
            if (monthIndex === null) {
                return null;
            }
            var month = calendar.months[monthIndex];

            var totalHeaderHeight = this.titleHeight + this.dayHeaderHeight;
            if (month.top <= coords.y && coords.y < month.top + totalHeaderHeight) {
                return {
                    "month": monthIndex,
                    "x": 0,
                    "y": 0,
                    "coords": coords,
                    "header": true
                };
            }

            for (var x = 0; x < month.cells.length; x++) {
                for (var y = 0; y < month.cells[x].length; y++) {
                    var cell = month.cells[x][y];
                    var top = cell.top + month.top;
                    var left = cell.left + month.left;
                    if (left <= coords.x && coords.x < left + calendar.cellWidth) {
                        if (top <= coords.y && coords.y < top + calendar.cellHeight) {
                            return {
                                "month": monthIndex,
                                "x": x,
                                "y": y,
                                "coords": coords
                            };
                        }
                    }
                }
            }

            return null;
        };

        this._onTopMouseDown = function(ev) {
            var freeHandSelection = calendar.freeHandSelectionEnabled;
            if (!freeHandSelection) {
                return;
            }
            var start = calendar._getPosition(ev);
            if (start && !start.header) {
                ps.start = start;
            }
            var cell = calendar.months[start.month].cells[start.x][start.y];

            ev.preventDefault();

        };

        this._onTopMouseMove = function(ev) {
            if (!ps.start) {
                return;
            }
            var end = calendar._getPosition(ev);
            if (ps.end) {
                ps.end = end;
            }
            else if (end) {
                var requiredDistance = 3;
                var distance = DayPilot.distance(ps.start.coords, end.coords);

                if (distance > requiredDistance) {
                    ps.end = end;
                }
            }

            if (ps.end) {
                ps.clear();
                ps.draw();
            }
            //ps.end = end;
        };

        this._preselection = {};
        var ps = this._preselection;
        ps.start = null;

        ps.drawCell = function(pos) {
            var month = calendar.months[pos.month];

            var cellPos = calendar._cellRelativeCoords(pos.x, pos.y);

            var top = month.top + cellPos.y;
            var left = month.left + cellPos.x;

            var div = document.createElement("div");
            div.style.position = "absolute";
            div.style.left = left + "px";
            div.style.top = top + "px";
            div.style.height = calendar.cellHeight + "px";
            div.style.width = calendar.cellWidth + "px";
            div.style.backgroundColor = "#ccc";
            div.style.opacity = 0.5;
            div.style.cursor = "default";

            calendar.nav.preselection.appendChild(div);
            ps.cells.push(div);
        };

        ps.clear = function() {
            if (!ps.cells) {
                return;
            }

            for(var i = 0; i < ps.cells.length; i++) {
                calendar.nav.preselection.removeChild(ps.cells[i]);
            }
            ps.cells = [];
        };

        ps.draw = function() {
            var ordered = ps.ordered();

            var position = new Position(ordered.start);
            var end = ordered.end;

            if (!end) {
                return;
            }

            if (end === ps.end && end.header) {
                if (end.month > 0) {
                    end.month -= 1;
                    var month = calendar.months[end.month];
                    end.x = 6;
                    end.y = month.rowCount - 1;
                }
            }

            ps.cells = [];

            while (!position.is(end)) {
                ps.drawCell(position);
                var next = new Position(position).next();
                if (!next) {
                    return;
                }
                position.month = next.month;
                position.x = next.x;
                position.y = next.y;
            }

            // the last one
            ps.drawCell(position);

        };

        ps.ordered = function() {
            //var position = new Position(start);
            var start = ps.start;
            var end = ps.end;

            var result = {};
            if (!end || new Position(start).before(end)) {
                result.start = start;
                result.end = end;
            }
            else {
                result.start = end;
                result.end = start;
            }
            return result;
        };

        var Position = function(month, x, y) {

            if (month instanceof Position) {
                return month;
            }
            if (typeof month === "object") {
                var ref = month;
                this.month = ref.month;
                this.x = ref.x;
                this.y = ref.y;
            }
            else {
                this.month = month;
                this.x = x;
                this.y = y;
            }
            this.is = function(ref) {
                return this.month === ref.month && this.x === ref.x && this.y === ref.y;
            };

            this.next = function() {
                var start = this;
                if (start.x < 6) {
                    return {
                        "month": start.month,
                        "x": start.x + 1,
                        "y": start.y
                    };
                }
                var month = calendar.months[start.month];
                if (start.y < month.rowCount - 1) {
                    return {
                        "month": start.month,
                        "x": 0,
                        "y": start.y + 1
                    };
                }
                if (start.month < calendar.months.length - 1) {
                    return {
                        "month": start.month + 1,
                        "x": 0,
                        "y": 0
                    };
                }
                return null;
            };

            this.visible = function() {
                var cell = this.cell();
                if (cell.isCurrentMonth) {
                    return true;
                }
                if (cell.isPrevMonth && cell.showBefore) {
                    return true;
                }
                if (cell.isNextMonth && cell.showAfter) {
                    return true;
                }
                return false;
            };

            this.nextVisible = function() {
                var pos = this;
                while (!pos.visible()) {
                    var next = pos.next();
                    if (!next) {
                        return null;
                    }
                    pos = new Position(next);
                }
                return pos;
            };

            this.previous = function() {
                var start = this;
                if (start.x > 0) {
                    return {
                        "month": start.month,
                        "x": start.x - 1,
                        "y": start.y
                    };
                }
                var month = calendar.months[start.month];
                if (start.y > 0) {
                    return {
                        "month": start.month,
                        "x": 6,
                        "y": start.y - 1
                    };
                }
                if (start.month > 0) {
                    var m = calendar.months[start.month - 1];
                    return {
                        "month": start.month - 1,
                        "x": 6,
                        "y": m.rowCount - 1
                    };
                }
                return null;

            };

            this.previousVisible = function() {
                var pos = this;
                while (!pos.visible()) {
                    var previous = pos.previous();
                    if (!previous) {
                        return null;
                    }
                    pos = new Position(previous);
                }
                return pos;
            };

            this.cell = function() {
                return calendar.months[this.month].cells[this.x][this.y];
            };

            this.date = function() {
                return this.cell().day;
            };

            this.before = function(ref) {
                var thisDate = this.date();
                var refDate = new Position(ref).date();
                return thisDate < refDate;
            };
        };


        this._cellClick = function(ev) {
            var main = this.parentNode;
            var month = this.parentNode.month;

            var x = this.x;
            var y = this.y;
            var day = month.cells[x][y].day;

            if (!month.cells[x][y].isClickable) {
                return;
            }

            calendar.clearSelection();

            calendar.selectionDay = day;

            var day = calendar.selectionDay;
            switch (calendar._selectModeLowerCase()) {
                case 'none':
                    //var s = month.cells[x][y];
                    calendar.selectionStart = day;
                    calendar.selectionEnd = day;
                    break;
                case 'day':
                    if (calendar.autoFocusOnClick) {
                        var start = day;
                        if (day < calendar._activeStart() ||
                            day >= calendar._activeEnd()) {
                            calendar.select(day);
                            return;
                        }
                    }

                    var s = month.cells[x][y];
                    calendar._cellSelect(main, x, y);
                    //calendar._addClass(s, 'select');
                    calendar.selected.push(s);
                    calendar.selectionStart = s.day;
                    calendar.selectionEnd = s.day;

                    break;
                case 'week':
                    if (calendar.autoFocusOnClick) {
                        var start = month.cells[0][y].day;
                        var end = month.cells[6][y].day;
                        if (start.firstDayOfMonth() === end.firstDayOfMonth()) {
                            if (start < calendar._activeStart() ||
                                end >= calendar._activeEnd()) {
                                calendar.select(day);
                                return;
                            }
                        }
                    }
                    for (var j = 0; j < 7; j++) {
                        calendar._cellSelect(main, j, y);
                        //calendar._addClass(month.cells[j][y], 'select');
                        calendar.selected.push(month.cells[j][y]);
                    }
                    calendar.selectionStart = month.cells[0][y].day;
                    calendar.selectionEnd = month.cells[6][y].day;

                    break;
                case 'month':
                    if (calendar.autoFocusOnClick) {
                        var start = day;
                        if (day < calendar._activeStart() ||
                            day >= calendar._activeEnd()) {
                            calendar.select(day);
                            return;
                        }
                    }

                    var start = null;
                    var end = null;
                    for (var y = 0; y < 6; y++) {
                        for (var x = 0; x < 7; x++) {
                            var s = month.cells[x][y];
                            if (!s) {
                                continue;
                            }
                            if (s.day.getYear() === day.getYear() && s.day.getMonth() === day.getMonth()) {
                                calendar._cellSelect(main, x, y);
                                //calendar._addClass(s, 'select');
                                calendar.selected.push(s);
                                if (start === null) {
                                    start = s.day;
                                }
                                end = s.day;
                            }
                        }
                    }
                    calendar.selectionStart = start;
                    calendar.selectionEnd = end;
                    break;
                default:
                    throw 'unknown selectMode';
            }

            calendar._saveState();

            calendar._timeRangeSelectedDispatch();
        };

        this._timeRangeSelectedDispatch = function(options) {
            var start = calendar.selectionStart;
            var end = calendar.selectionEnd.addDays(1);
            var days = DayPilot.DateUtil.daysDiff(start, end);
            var day = calendar.selectionDay;

            options = options || {};


            if (calendar._api2()) {

                var args = {};
                args.start = start;
                args.end = end;
                args.day = day;
                args.days =  days;
                args.mode = options.mode || calendar.selectMode;
                args.preventDefault = function() {
                    this.preventDefault.value = true;
                };

                if (typeof calendar.onTimeRangeSelect === 'function') {
                    calendar.onTimeRangeSelect(args);
                    if (args.preventDefault.value) {
                        return;
                    }
                }

                // now perform the default builtin action
                switch (calendar.timeRangeSelectedHandling) {
                    case 'Bind':
                        if (typeof bound === "object") {
                            var selection = {};
                            selection.start = start;
                            selection.end = end;
                            selection.days = days;
                            selection.day = day;
                            bound.commandCallBack(calendar.command, selection);
                        }
                        break;
                    case 'None':
                        break;
                    case 'PostBack':
                        calendar.timeRangeSelectedPostBack(start, end, day);
                        break;
                }

                if (typeof calendar.onTimeRangeSelected === 'function') {
                    calendar.onTimeRangeSelected(args);
                }

            }
            else {
                switch (calendar.timeRangeSelectedHandling) {
                    case 'Bind':
                        if (typeof bound === "object") {
                            var selection = {};
                            selection.start = start;
                            selection.end = end;
                            selection.days = days;
                            selection.day = day;
                            bound.commandCallBack(calendar.command, selection);
                        }
                        break;
                    case 'JavaScript':
                        calendar.onTimeRangeSelected(start, end, day);
                        break;
                    case 'None':
                        break;
                    case 'PostBack':
                        calendar.timeRangeSelectedPostBack(start, end, day);
                        break;
                }
            }


        };

        this.timeRangeSelectedPostBack = function(start, end, data, day) {
            var params = {};
            params.start = start;
            params.end = end;
            params.day = day;

            this._postBack2('TimeRangeSelected', data, params);
        };

        this._clickRight = function(ev) {
            calendar._moveMonth(calendar.skipMonths);
        };

        this._clickLeft = function(ev) {
            calendar._moveMonth(-calendar.skipMonths);
        };

        this._moveMonth = function(i) {
            this.startDate = this.startDate.addMonths(i);
            this._clearTable();
            this._prepare();
            this._drawMonths();

            this._saveState();

            this._visibleRangeChangedDispatch();
            this._updateFreeBusy();
        };

        this._activeStart = function() {
            return calendar.startDate.firstDayOfMonth();
        };

        this._activeEnd = function() {
            return calendar.startDate.firstDayOfMonth().addMonths(this.showMonths);
        };

        this.visibleStart = function() {
            return calendar.startDate.firstDayOfMonth().firstDayOfWeek(resolved.weekStarts());
        };

        this.visibleEnd = function() {
            return calendar.startDate.firstDayOfMonth().addMonths(this.showMonths - 1).firstDayOfWeek(resolved.weekStarts()).addDays(42);
        };

        this._visibleRangeChangedDispatch = function() {
            var start = this.visibleStart();
            var end = this.visibleEnd();

            if (calendar._api2()) {

                var args = {};
                args.start = start;
                args.end = end;
                args.preventDefault = function() {
                    this.preventDefault.value = true;
                };

                if (typeof calendar.onVisibleRangeChange === 'function') {
                    calendar.onVisibleRangeChange(args);
                    if (args.preventDefault.value) {
                        return;
                    }
                }

                // now perform the default builtin action
                switch (this.visibleRangeChangedHandling) {
                    case "CallBack":
                        this.visibleRangeChangedCallBack(null);
                        break;
                    case "PostBack":
                        this.visibleRangeChangedPostBack(null);
                        break;
                    case "Disabled":
                        break;
                }

                if (typeof calendar.onVisibleRangeChanged === 'function') {
                    calendar.onVisibleRangeChanged(args);
                }

            }
            else {
                switch (this.visibleRangeChangedHandling) {
                    case "CallBack":
                        this.visibleRangeChangedCallBack(null);
                        break;
                    case "PostBack":
                        this.visibleRangeChangedPostBack(null);
                        break;
                    case "JavaScript":
                        this.onVisibleRangeChanged(start, end);
                        break;
                    case "Disabled":
                        break;
                }
            }

            /*
                        switch (this.visibleRangeChangedHandling) {
                            case "CallBack":
                                this.visibleRangeChangedCallBack(null);
                                break;
                            case "PostBack":
                                this.visibleRangeChangedPostBack(null);
                                break;
                            case "JavaScript":
                                this.onVisibleRangeChanged(start, end);
                                break;
                            case "Disabled":
                                break;
                        }
                        */
        };


        this.visibleRangeChangedCallBack = function(data) {
            var parameters = {};
            this._callBack2("Visible", data, parameters);
        };

        this.visibleRangeChangedPostBack = function(data) {
            var parameters = {};
            this._postBack2("Visible", data, parameters);
        };

        this._updateView = function(result, context) {
            var result = JSON.parse(result);
            calendar.items = result.Items;
            calendar.cells = result.Cells;

            if (calendar.cells) {
                calendar.update();
            }
            else {
                calendar._updateFreeBusy();
            }
        };

        this._drawMonths = function() {
            for (var j = 0; j < this.showMonths; j++) {
                var showLinks = this._getShowLinks(j);
                this._drawTable(j, showLinks);
            }

            this.root.style.height = this._getHeight() + "px";

            this.nav.preselection = document.createElement("div");
            this.nav.preselection.style.position = "absolute";
            this.nav.preselection.style.left = "0px";
            this.nav.preselection.style.top = "0px";
            this.root.appendChild(this.nav.preselection);

            /*
            var div = document.createElement("div");
            div.style.clear = "left";
            div.style.height = "0px";
            div.style.width = "0px";
            this.root.appendChild(div);
            */

        };


        this._getHeight = function() {
            if (this.orientation === "Horizontal") {
                var max = 0;
                for (var i = 0; i < this.months.length; i++) {
                    var month = this.months[i];
                    if (month.height > max) {
                        max = month.height;
                    }
                }
                return max;
            }
            else {
                var total = 0;
                for (var i = 0; i < this.months.length; i++) {
                    var month = this.months[i];
                    //total += this.showMonths*(this.cellHeight*month.rowCount + this.titleHeight + this.dayHeaderHeight);
                    total += month.height;
                }
                return total;
            }
        };

        this._getShowLinks = function(j) {
            if (this.internal.showLinks) {
                return this.internal.showLinks;
            }

            var showLinks = {};
            showLinks.left = (j === 0);
            showLinks.right = (j === 0);
            showLinks.before = j === 0;
            showLinks.after = j === this.showMonths - 1;

            if (this.orientation === "Horizontal") {
                showLinks.right = (j === this.showMonths - 1);
            }

            return showLinks;
        };

        // not used at the moment - no internal changes to data

        this._angular = {};
        this._angular.scope = null;
        this._angular.notify = function() {
            if (calendar._angular.scope) {
                calendar._angular.scope["$apply"]();
            }
        };

        this.internal = {};
        this.internal.loadOptions = calendar._loadOptions;
        // ASP.NET
        this.internal.initialized = function() {
            return calendar._initialized;
        };

        this._resolved = {};
        var resolved = this._resolved;

        resolved.locale = function() {
            return DayPilot.Locale.find(calendar.locale);
        };

        resolved.weekStarts = function() {
            if (calendar.weekStarts === 'Auto') {
                var locale = resolved.locale();
                if (locale) {
                    return locale.weekStarts;
                }
                else {
                    return 0; // Sunday
                }
            }
            else {
                return calendar.weekStarts;
            }
        };

        resolved.cellWidth = function() {
            if (calendar._cache.cellWidth) {
                return calendar._cache.cellWidth;
            }
            var width = calendar._getDimensionsFromCss("_cell_dimensions").width;
            if (!width) {
                width = calendar.cellWidth;
            }
            calendar._cache.cellWidth = width;
            return width;
        };

        this.clearSelection = function() {
            for (var j = 0; j < this.selected.length; j++) {
                //this._removeClass(this.selected[j], 'select');
                var div = this.selected[j];
                calendar._cellUnselect(div.parentNode, div.x, div.y);
            }
            this.selected = [];
        };

        this._isShortInit = function() {
            // make sure it has a place to ask
            if (this.backendUrl) {
                return (typeof calendar.items === 'undefined') || (!calendar.items);
            }
            else {
                return false;
            }
        };

        this.events = {};

        this._loadEvents = function() {
            if (!DayPilot.isArray(this.events.list)) {
                return;
            }

            this.items = {};

            for(var i = 0; i < this.events.list.length; i++) {
                var e = this.events.list[i];
                if (e.hidden) {
                    continue;
                }
                var days = this._eventDays(e);
                for(var name in days) {
                    this.items[name] = 1;
                }
            }
        };

        this._getDimensionsFromCss = function(className) {
            var div = document.createElement("div");
            div.style.position = "absolute";
            div.style.top = "-2000px";
            div.style.left = "-2000px";
            div.className = this._prefixCssClass(className);

            var container = calendar.root || document.body;

            container.appendChild(div);
            var height = div.offsetHeight;
            var width = div.offsetWidth;
            container.removeChild(div);

            var result = {};
            result.height = height;
            result.width = width;
            return result;
        };

        this._eventDays = function(e) {
            var start = new DayPilot.Date(e.start);
            var end = new DayPilot.Date(e.end);

            var days = {};

            var d = start.getDatePart();
            while (d.getTime() <= end.getTime()) {
                days[d.toStringSortable()] = 1;
                d = d.addDays(1);
            }

            return days;
        };

        this.show = function() {
            calendar.visible = true;
            calendar.root.style.display = '';
        };

        this.hide = function() {
            calendar.visible = false;
            calendar.root.style.display = 'none';
        };

        this._loadTop = function() {
            if (this.id && this.id.tagName) {
                this.nav.top = this.id;
            }
            else if (typeof this.id === "string") {
                this.nav.top = document.getElementById(this.id);
                if (!this.nav.top) {
                    throw "DayPilot.Navigator: The placeholder element not found: '" + id + "'.";
                }
            }
            else {
                throw "DayPilot.Navigator() constructor requires the target element or its ID as a parameter";
            }

            this.root = this.nav.top;

        };

        this.init = function() {
            this._loadTop();

            if (this.root.dp) { // already initialized
                return;
            }

            this._adjustSelection();
            this._prepare();
            this._drawMonths();
            this._loadEvents();
            this._updateFreeBusy();
            this._registerDispose();
            this._registerTopHandlers();
            this._registerGlobalHandlers();

            //this.select(this.selectionStart);

            var loadFromServer = this._isShortInit();
            if (loadFromServer) {
                this._visibleRangeChangedDispatch(); // TODO change to "Init"?
            }
            this._initialized = true;
            this._postInit();

            if (this._postponedSelect) {
                var params = this._postponedSelect;
                this.select(params.date1, params.date2, params.options);
                this._postponedSelect = null;
            }

            return this;
        };

        this._registerTopHandlers = function() {
            calendar.nav.top.onmousedown = this._onTopMouseDown;
            calendar.nav.top.onmousemove = this._onTopMouseMove;
        };

        this._registerGlobalHandlers = function() {
            DayPilot.re(document, 'mouseup', calendar._gMouseUp);
        };

        this._gMouseUp = function(ev) {
            if (ps.start && ps.end) {
                var coords = DayPilot.mo3(calendar.nav.top, ev);

                // click, cancel
                if (coords.x === ps.start.coords.x && coords.y === ps.start.coords.y) {
                    ps.start = null;
                    ps.clear();
                    return;
                }

                ps.clear();

                var ordered = ps.ordered();

                ordered.start = new Position(ordered.start).nextVisible();
                ordered.end = new Position(ordered.end).previousVisible();


                calendar.selectionDay = new Position(ordered.start).date();
                calendar.selectionStart = calendar.selectionDay;
                calendar.selectionEnd = new Position(ordered.end).date();

                ps.start = null;
                ps.end = null;

                // redraw
                calendar._clearTable();
                calendar._prepare();
                calendar._drawMonths();
                calendar._updateFreeBusy();
                calendar._saveState();

                var notify = true;
                if (notify) {
                    calendar._timeRangeSelectedDispatch({"mode": "FreeHand"});
                }

            }

            // clear in either case
            ps.start = null;
            ps.end = null;

        };

        this.dispose = function() {
            var c = calendar;

            if (!c.root) {
                return;
            }

            c.root.removeAttribute("style");
            c.root.removeAttribute("class");
            c.root.dp = null;
            c.root.innerHTML = null;
            c.root = null;

            c._disposed = true;

        };

        this._registerDispose = function() {
            //var root = document.getElementById(id);
            this.root.dispose = this.dispose;
        };

        this.Init = this.init;

        this._loadOptions(options);
    };

    //  jQuery plugin
    if (typeof jQuery !== 'undefined') {
        (function($) {
            $.fn.daypilotNavigator = function(options) {
                var first = null;
                var j = this.each(function() {
                    if (this.daypilot) { // already initialized
                        return;
                    };

                    var daypilot = new DayPilot.Navigator(this.id);
                    this.daypilot = daypilot;
                    for (var name in options) {
                        daypilot[name] = options[name];
                    }
                    daypilot.Init();
                    if (!first) {
                        first = daypilot;
                    }
                });
                if (this.length === 1) {
                    return first;
                }
                else {
                    return j;
                }
            };
        })(jQuery);
    }

    // AngularJS plugin
    (function registerAngularModule() {
        var app = DayPilot.am();

        if (!app) {
            return;
        }


        app.directive("daypilotNavigator", ['$parse', function($parse) {
            return {
                "restrict": "E",
                "template": "<div id='{{id}}'></div>",
                "compile": function compile(element, attrs) {
                    element.replaceWith(this["template"].replace("{{id}}", attrs["id"]));

                    return function link(scope, element, attrs) {
                        var calendar = new DayPilot.Navigator(element[0]);
                        calendar._angular.scope = scope;
                        calendar.init();

                        var oattr = attrs["id"];
                        if (oattr) {
                            scope[oattr] = calendar;
                        }

                        // save DayPilot.Calendar object in the specified variable
                        var pas = attrs["publishAs"];
                        if (pas) {
                            var getter = $parse(pas);
                            var setter = getter.assign;
                            setter(scope, calendar);
                        }

                        // bind event handlers from attributes starting with "on"
                        for (var name in attrs) {
                            if (name.indexOf("on") === 0) {  // event handler
                                var apply = DayPilot.Util.shouldApply(name);

                                if (apply) {
                                    (function(name) {
                                        calendar[name] = function(args) {
                                            var f = $parse(attrs[name]);
                                            scope["$apply"](function() {
                                                f(scope, {"args": args});
                                            });
                                        };
                                    })(name);
                                }
                                else {
                                    (function(name) {
                                        calendar[name] = function(args) {
                                            var f = $parse(attrs[name]);
                                            f(scope, {"args": args});
                                        };
                                    })(name);
                                }

                            }
                        }

                        var watch = scope["$watch"];
                        var config = attrs["config"] || attrs["daypilotConfig"];
                        var events = attrs["events"] || attrs["daypilotEvents"];

                        watch.call(scope, config, function (value, oldVal) {
                            for (var name in value) {
                                calendar[name] = value[name];
                            }
                            calendar.update();
                        }, true);

                        watch.call(scope, events, function(value) {
                            calendar.events.list = value;
                            calendar._loadEvents();
                            calendar._updateFreeBusy();
                        }, true);

                    };
                }
            };
        }]);

    })();

    if (typeof Sys !== 'undefined' && Sys.Application && Sys.Application.notifyScriptLoaded) {
        Sys.Application.notifyScriptLoaded();
    }


})();
