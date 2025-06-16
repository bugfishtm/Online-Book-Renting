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
