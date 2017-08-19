// these are labels for the days of the week
cal_days_labels = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

// these are human-readable month name labels, in order
cal_months_labels = ['January', 'February', 'March', 'April',
'May', 'June', 'July', 'August', 'September',
'October', 'November', 'December'];


// these are the days of the week for each month, in order
cal_days_in_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

// this is the current date
cal_current_date = new Date();

//The Calendar Call thi plugin first!
function Calendar(dataEvent, month, year) {
    this.dataEvent = dataEvent;
    this.month = (isNaN(month) || month == null) ? cal_current_date.getMonth() : month;
    this.year  = (isNaN(year) || year == null) ? cal_current_date.getFullYear() : year;
    this.html = '';
}

String.prototype.paddingLeft = function (paddingValue) {
    return String(paddingValue + this).slice(-paddingValue.length);
};

_generateCalendar = function(dataEvent, month, year)
{
    var dateNow = new Date();
    var dateCheck = new Date(year, month, 1);
    var startingDay = dateCheck.getDay();

    // find number of days in month
    var monthLength = cal_days_in_month[dateCheck.getMonth()];
    var monthLengthBefore = cal_days_in_month[(dateCheck.getMonth() - 1 < 0 ? 11 : dateCheck.getMonth() - 1)];

    // compensate for leap year
    // February only!
    if((year % 4 == 0 && year % 100 != 0) || year % 400 == 0){
        if (dateCheck.getMonth() == 1) {
            monthLength = 29;
        }
        if (dateCheck.getMonth() - 1 == 1) {
            monthLengthBefore = 29;
        }
    }

    var html = '<div class="calendar-header">'+ cal_months_labels[dateCheck.getMonth()] + ' ' + dateCheck.getFullYear() + '</div><div class="navigation">';
    // control to show back link
    if (dataEvent['canBack']) {
        monthBack = dateCheck.getMonth() - 1 < 0 ? 11 : dateCheck.getMonth() - 1;
        yearBack = monthBack == 11 ? dateCheck.getFullYear() - 1 : dateCheck.getFullYear();
        html += '<span class="calendar-nav" data-month="'+monthBack+'" data-year="'+yearBack+'">&lt; back</span>';
    }
    // control to sho next link
    if (dataEvent['canNext']) {
        monthNext = dateCheck.getMonth() + 1 == 12 ? 0 : dateCheck.getMonth() + 1;
        yearNext = monthNext == 0 ? dateCheck.getFullYear() + 1 : dateCheck.getFullYear();
        html += ' <span class="calendar-nav" data-month="'+monthNext+'" data-year="'+yearNext+'">next &gt;</span>';
    }
    html += '</div>';

    html += '<table class="table-calendar">';
    html += '<tr>';
    for(var i = 0; i <= 6; i++ ) {
        html += '<td class="table-calendar-header">';
        html += cal_days_labels[i];
        html += '</td>';
    }
    html += '</tr><tr>';

    // fill in the days
    var day = 1;
    // this loop is for weeks (rows)
    var dayAfter = 1;
    for (var i = 0; i < 6; i++) {
        // this loop is for weekdays (cells)
        for (var j = 0; j <= 6; j++) {
            var price = 0;
            var booked = "";
            var blocked = "";
            var renovation = "";
            var expired = "";
            var active = "";
            var monthName = "";

            if (day <= monthLength && (i > 0 || j >= startingDay)) {
                var dateTemp = day;
                var monthTemp = dateCheck.getMonth() + 1;
                var monthDiffTemp = dateCheck.getMonth();
                var yearTemp = dateCheck.getFullYear();

                if (day == 1) {
                    monthName = ' '+cal_months_labels[dateCheck.getMonth()];
                }
                day++;
            }
            else {
                if (i == 0) {
                    var dateTemp = (monthLengthBefore - startingDay + j + 1);
                    var monthTemp = dateCheck.getMonth() == 0 ? 11 : dateCheck.getMonth();
                    var monthDiffTemp = dateCheck.getMonth() - 1 < 0 ? 11 : dateCheck.getMonth() - 1;
                    var yearTemp = dateCheck.getMonth() -1 < 0 ? (dateCheck.getFullYear() - 1) : (dateCheck.getFullYear());
                } else {
                    var dateTemp = dayAfter;
                    var monthTemp = dateCheck.getMonth() + 2 > 12 ? (dateCheck.getMonth() + 2 > 13 ? 2 : 1) : dateCheck.getMonth() + 2;
                    var monthDiffTemp = dateCheck.getMonth() + 1 > 11 ? 0 : dateCheck.getMonth() + 1;
                    var yearTemp = dateCheck.getMonth() + 1 > 11 ? (dateCheck.getFullYear() + 1) : (dateCheck.getFullYear());

                    if (dayAfter == 1) {
                        monthName = ' '+cal_months_labels[(dateCheck.getMonth() + 1 > 11 ? 0 : dateCheck.getMonth() + 1)];
                    }
                    dayAfter++;
                }
            }
            var DateLoop = new Date(yearTemp, monthDiffTemp, dateTemp);
            var timeDiff = DateLoop.getTime() - dateNow.getTime();
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            if (diffDays < 0) {
                expired = "calendar-expired";
            }
            price = dataEvent['price'+DateLoop.getDay()];
            var isblocked= false;
            var temp = dataEvent['event'][monthTemp.toString().paddingLeft('00')+"-"+dateTemp.toString().paddingLeft('00')+"-"+yearTemp];
            if (typeof temp != 'undefined') {
                if (typeof temp.price != 'undefined') {
                    price = temp.price;
                }

                if (typeof temp.status != 'undefined') {
                    isblocked=true;
                    if (temp.status == "book") {
                        //add here! when add status
                        if(temp.description == "stay"){
                            booked = "calendar-booked";
                        }
                        if(temp.description == "in"){
                            booked = "calendar-booked-in"; 
                            active = "calendar-active";   
                        }
                        if(temp.description == "out"){
                            booked = "calendar-booked-out"; 
                            active = "calendar-active";   
                        }

                        expired = "";
                    }else if(temp.status == "block"){
                        blocked = "calendar-blocked"; 
                        active = "calendar-active"; 
                        expired = ""; 
                    } 
                    else {
                        if (expired == "") {
                            //renovation = "calendar-disabled";
                            renovation = "calendar-renovation";
                            active = "calendar-active";
                        }
                    }
                }
            }


            if (expired == "" && booked == "") {
                active = "calendar-active";
            }

            html += '<td class="cal_row"><div  draggable="true" class="containingBlock '+renovation+' '+booked+' '+ blocked +' '+ expired+' '+active+'" '+
                (renovation == "" ? (booked == "" ? (expired == "" ? (blocked == "" ? "title=\"Available\"" : "title=\"Blocked\"") : "title=\"Past Day\"") : "title=\"booked\"") : "title=\"Renovation\"")+' data-value="'+yearTemp+'-'+monthTemp.toString().paddingLeft('00')+'-'+dateTemp.toString().paddingLeft('00')+'">';
            
            if(isblocked){
                html += '<div class="day-in-out">'+dateTemp+monthName+'</div>';
                html += '<div class="price-in-out">'+parseFloat(price).format(2, 3, '.', ',')+'</div>';
            }else{
                html += '<div class="day">'+dateTemp+monthName+'</div>';
                html += '<div class="price">'+parseFloat(price).format(2, 3, '.', ',')+'</div>';
            }
            html += '</div></td>';
        }
        html += '</tr><tr>';
    }
    html += '</tr></table>';

    return html;
}

Calendar.prototype.generateHTML = function(){
	var html = "";
	html += _generateCalendar(this.dataEvent, this.month, this.year);

	this.html = html;
}

Calendar.prototype.next = function(){

}

Calendar.prototype.back = function(){

}

Calendar.prototype.getHTML = function() {
	return this.html;
}

Number.prototype.format = function(n, x, s, c) {
	var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
	num = this.toFixed(Math.max(0, ~~n));

	return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
};