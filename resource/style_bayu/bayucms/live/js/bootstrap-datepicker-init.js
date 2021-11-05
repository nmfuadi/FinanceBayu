var allDisabledDates = [];
var _mainBody = $("body");
var _hotelStay = $('.hotel-staydates input[type="checkbox"]');
var noOfMonths = 1;
var langCode = $("body").attr("data-culture");

Date.prototype.addDays = function(days) {
    var dat = new Date(this.valueOf());
    dat.setDate(dat.getDate() + days);
    return dat;
};
// if ($(window).width() > 768) {
//     noOfMonths = 2;
// } else {
//     noOfMonths = 1;
// }
var dprID = ["#dpd01", "#dpd03", "#dpd05", "#dpd07", "#dpd09", "#dpd11", "#dpd13", "#dpd15", "#dpd17", "#dpd19"],
    arrID = ["#dpd02", "#dpd04", "#dpd06", "#dpd08", "#dpd10", "#dpd12", "#dpd14", "#dpd16", "#dpd18", "#dpd20"];
var sDateTitle = ["Leaving on", "Leaving on", "Check-in", "Start Date", "Flight Arrive", "Pick-up date", "Check In", "Leaving on", "Check-in", "Depart on"],
    eDateTitle = ["Returning on", "Returning on", "Check-out", "End Date", "Depart on", "Drop-off date", "Check Out", "Returning on", "Check-out"]
$.each(dprID, function(i) {
    dateQuery(dprID[i], arrID[i], sDateTitle[i], eDateTitle[i], new Date());
});
$("#dpd01, #dpd02, #dpd03, #dpd04, #dpd05, #dpd06, #dpd07, #dpd08, #dpd09, #dpd10, #dpd11, #dpd12, #dpd13, #dpd14, #dpd15, #dpd16").prop("readonly", true);

//dateQuery function where we set startdate and enddate
function dateQuery(startDateId, endDateId, sDateLbl, eDateLbl, startDate) {
    //Setting up default date value
    var date1;
    var date2;
    var firstdate, lastdate;
    firstdate = new Date();
    lastdate = new Date(moment().add(1, 'day'));

    //Initialize value
    var _dateSelected = false;
    var _startDateId = $(startDateId);
    var _endDateId = $(endDateId);
    var leftArrow = '<span class=\"icon icon-round-left-arrow\">';
    var rightArrow = '<span class=\"icon icon-round-right-arrow\">';

    _startDateId.datepicker($.extend({}, $.datepicker.regional[langCode], {
        timePicker: true,
        minDate: startDate,
        maxDate: new Date().addDays(365),
        dateFormat: "dd/mm/yy",
        numberOfMonths: noOfMonths,
        prevText: leftArrow,
        nextText: rightArrow,
        showButtonPanel: true,
        yearRange: "-2:+2",
        //closeText: "Close <i class='icon-cross'></i>",
        calTitle: sDateLbl,
        beforeShow: function(input, inst) {
            if (startDateId != "#dpd17") {
                _mainBody.addClass("list-visible");
            }
            var rect = input.getBoundingClientRect();
            if ($('.modal.in').length) {
                setTimeout(function() {
                    inst.dpDiv.css({ top: rect.top + 60, left: rect.left + 0 });
                }, 0);
            }
        },
        onSelect: function() {
            var _this = $(this);
            var pickedDate = _this.datepicker('getDate'); //the getDate method 
            var formID = _this.closest('form').prop('id');
            var dCity = $("#" + formID).find(".dprCode").val();
            var aCity = $("#" + formID).find(".arrCode").val();
            var eDate = $("#" + formID).find(".endDate");

            // alert(_this.datepicker('getDate'));
            var formattedDate = $.datepicker.formatDate("dd/mm/yy", pickedDate.addDays(1));

            _endDateId.datepicker("option", "minDate", formattedDate);
            date1 = pickedDate;

            // _startDateId.val(formatDate(pickedDate));

            //END DATE 
            // _endDateId.val(formatDate(pickedDate.addDays(1)));
            _endDateId.val(formattedDate);
            updateHiddenDate(_endDateId, pickedDate.addDays(1));

            _dateSelected = true;

            //Adding disable dates for the end date 
            if (endDateId === "#dpd04" || endDateId === "#dpd14") {
                if (dCity !== "" && aCity !== "") {
                    //disabledDATES(aCity, dCity, eDate);
                }
            }

            if ($(_startDateId).attr("id") === 'dpd01') {
                updateHotelStay("#" + formID);
                var checkIn = $('#dpd13').val();
                $("#CheckIn").val(moment(checkIn, "DD/MM/YYYY").format('YYYY-MM-DD'));
                var checkPut = $('#dpd14').val();
                $("#CheckOut").val(moment(checkPut, "DD/MM/YYYY").format('YYYY-MM-DD'));
            }

            updateHiddenDate(_startDateId, pickedDate);


            //Genarting Checkin and Checkout dates//Calling Checkin-out function when checkbox is enabled
            if (_hotelStay.is(":checked")) {
                //Genarting Checkin and Checkout dates
                // updateHotelDates.getDates($("#"+formID));

            }
        },
        onClose: function(selectedDate) {

            if (_dateSelected) {
                _dateSelected = false;
            }
            setTimeout(function() {
                _mainBody.removeClass("list-visible");
            }, 300)
        }
    }));

    //End date Selection
    _endDateId.datepicker($.extend({}, $.datepicker.regional[langCode], {
        dateFormat: "dd/mm/yy",
        minDate: startDate.addDays(1),
        maxDate: new Date().addDays(365),
        prevText: leftArrow,
        numberOfMonths: noOfMonths,
        nextText: rightArrow,
        showButtonPanel: true,
        //closeText: "Close <i class='icon-cross'></i>",
        calTitle: eDateLbl,
        beforeShow: function(input, inst) {
            _mainBody.addClass("list-visible");
            if (endDateId != "#dpd18") {
                _mainBody.addClass("list-visible");
            }
            var rect = input.getBoundingClientRect();
            if ($('.modal.in').length) {
                setTimeout(function() {
                    inst.dpDiv.css({ top: rect.top + 60, left: rect.left + 0 });
                }, 0);
            }
        },
        onClose: function(selectedDate) {
            var _thisonClose = $(this);
            var pickedDate = _thisonClose.datepicker('getDate'); //the getDate method 
            setTimeout(function() {
                _mainBody.removeClass("list-visible");
            }, 300)
        },
        onSelect: function(dateText, inst) {
            var _thisonSelect = $(this);
            var pickedDate = _thisonSelect.datepicker('getDate'); //the getDate method  
            date2 = _thisonSelect.datepicker('getDate');
            var formID = _thisonSelect.closest("form").attr('id');

            _endDateId.val($.datepicker.formatDate("dd/mm/yy", pickedDate));

            if ($(_endDateId).attr("id") === 'dpd02') {
                updateHotelStay("#" + formID);

            }

            updateHiddenDate(_endDateId, pickedDate);

            //Calling Checkin-out function when checkbox is enabled
            if (_hotelStay.is(":checked")) {
                //Genarting Checkin and Checkout dates
                //updateHotelDates.getDates($("#"+formID));

            }

        }
    }));
    _startDateId.datepicker("setDate", $.datepicker.formatDate("dd/mm/yy", firstdate));
    updateHiddenDate(_startDateId, firstdate);
    _endDateId.datepicker("setDate", $.datepicker.formatDate("dd/mm/yy", lastdate));
    updateHiddenDate(_endDateId, lastdate);
}

function updateHiddenDate(picker, date) {
    var target = "#" + $(picker).data('frmtdate');
    var formattedDate = $.datepicker.formatDate("yy-mm-dd", date);
    $(target).val(formattedDate);
}

//Get disable dates

var urlDate = domain + 'api/get-disabled-dates?from=';

//disabledDates - showing the disable dates based on the dpr city and arr city
//dCity = Departure selected city
//aCity = Arrival selected city
function disabledDATES(dCity, aCity, inputElement) {
    //Create array
    var alldisableDates = [];
    var fromto = dCity + aCity;
    if (!allDisabledDates[fromto]) {

        //Ajax call
        $.ajax({
            //Calling api
            url: urlDate + dCity + '&to=' + aCity,
            timeout: 2000, //2 second timeout 
        })

        //SUCCESS - get the disable dates
        //If it has disable dates it will show the disabled dates bfr date selection 
        .success(function(data) {
            var disableDates = data;

            //Getting Years
            $.each(disableDates.disabledDates, function(year, months) {
                //Getting Months
                $.each(months, function(month, dates) {
                    //Getting dates
                    $.each(dates, function(i, date) {
                        //Adding generate date value to array(alldisableDates) 
                        alldisableDates.push(new Date(year, (month - 1), date).getTime());
                    });
                });
            });

            allDisabledDates[fromto] = {};
            allDisabledDates[fromto].disabledDates = alldisableDates;
            allDisabledDates[fromto].data = data;
        })

        //FAIL -  show the default date
        .fail(function() {
            alldisableDates = [];
        })

        //ALWAYS -  Set the dates 
        .always(function(date) {
            applyminmaxDate(inputElement, alldisableDates, date);
        });

    } else {

        applyminmaxDate(inputElement, allDisabledDates[fromto].disabledDates, allDisabledDates[fromto].data);
    }
}

//Split date - Timezone format
function dateSplit(dateObj) {
    var arr = dateObj.split('-');
    return new Date(arr[0], arr[1] - 1, arr[2]);
}

//Applying Minimum and Maximum Date for both departure and return date
//targetId - Target field id
//disDatesArray - Disable dates
//data - Start date and date information
function applyminmaxDate(inputElement, alldisableDates, date) {
    var blockId = inputElement.prevObject["0"].id;
    var targeId = inputElement.selector;
    var packageId = $(targeId).attr('id');
    var calLoader = $("#" + blockId).find('.hasDatepicker');

    //Manual set of Start date and End date
    var defStart;
    var defEnd;

    //Start date and End date from API
    var apiStart;
    var apiEnd;

    //Check if API start date is empty or not
    if (!date.startDate) {
        //if it is empty, it loads startdate as today
        apiStart = new Date().addDays(2);
        apiEnd = new Date().addDays(365);
    } else {
        //if it is not empty, it loads API start and end date
        apiStart = dateSplit(date.startDate);
        apiEnd = dateSplit(date.endDate);
    }

    // Setting beforeShowDay as Option
    $(targeId).datepicker("option", "beforeShowDay", function(date) {
            return [alldisableDates.indexOf(date.getTime()) == -1];
        })
        .datepicker("option", "minDate", apiStart);

    if ($(targeId).hasClass("startdate")) {
        defStart = new Date().addDays(2);
        defEnd = new Date().addDays(365);
    }

    if ($(targeId).hasClass("enddate")) {
        var pickedDate = $("#" + blockId).find(".startdate").datepicker("getDate");
        defStart = pickedDate.addDays(1);
        defEnd = new Date().addDays(365);
    }

    //Start Date - Check the api date with default date to add "min date"
    if (apiStart <= defStart) {
        $(targeId).datepicker("option", "minDate", defStart);
    } else {
        $(targeId).datepicker("option", "minDate", apiStart);
    }

    //End Date - Check the api date with default date to add "max date"
    if (apiEnd >= defEnd) {
        $(targeId).datepicker("option", "maxDate", defEnd);
    } else {
        $(targeId).datepicker("option", "maxDate", apiEnd);
    }

    $(targeId).datepicker("option", "dateFormat", "dd/mm/yy");

    //Clearing loader when all updated
    FilterDropdown.loader(true, calLoader);
}

//Apply Disable dates 
function applyDisableDates(dCity, aCity, formID) {
    //find startdate and enddate element 
    var sDate = $(formID).find(".startdate");
    var eDate = $(formID).find(".enddate");

    //triggering disabledates ajax
    if (dCity !== "" && aCity !== "") {
        disabledDATES(dCity, aCity, sDate);
        disabledDATES(aCity, dCity, eDate);
    }
}



$(function() {
    $("#TFdpd1").datetimepicker($.extend({}, $.datepicker.regional[langCode], {
        numberOfMonths: 1,
        dateFormat: "dd/mm/yy",
        minDate: new Date(),
        maxDate: new Date().addDays(365),
        prevText: '<span class="icon icon-round-left-arrow">',
        nextText: '<span class="icon icon-round-right-arrow">',
        showButtonPanel: true,
        addSliderAccess: true,
        oneLine: true,
        sliderAccessArgs: { touchonly: false },
        timeText: timetext,
        beforeShow: function() {
            _mainBody.addClass("list-visible");
        },
        onSelect: function(dateText, inst) {
            var _this = $(this);
            var formID = _this.closest('form').prop('id');
            var selectedDateTime = _this.datetimepicker('getDate'); //the getDate method
            var selectedHours = selectedDateTime.getHours() < 10 ? "0" + selectedDateTime.getHours() : selectedDateTime.getHours();
            var selectedMins = selectedDateTime.getMinutes() < 10 ? "0" + selectedDateTime.getMinutes() : selectedDateTime.getMinutes();
            var pickedTime = selectedHours + ":" + selectedMins;
            var pickedDate = moment(selectedDateTime).format('YYYY-MM-DD');
            $("#TFdpd2").datepicker("option", "minDate", selectedDateTime.addDays(1));
            $("#TFdpd1-date").val(pickedDate);
            $("#TFdpd2-date").val(moment(selectedDateTime.addDays(1)).format('YYYY-MM-DD'));
            $("#TFdpd1-time").val(pickedTime);

        },
        onClose: function() {
            _mainBody.removeClass("list-visible");
        }
    }));


    $("#TFdpd2").datetimepicker($.extend({}, $.datepicker.regional[langCode], {
        numberOfMonths: 1,
        dateFormat: "dd/mm/yy",
        minDate: new Date().addDays(1),
        maxDate: new Date().addDays(365),
        prevText: '<span class="icon icon-round-left-arrow">',
        nextText: '<span class="icon icon-round-right-arrow">',
        showButtonPanel: true,
        oneLine: true,
        timeText: timetext,
        beforeShow: function() {
            _mainBody.addClass("list-visible");
        },
        onSelect: function(dateText, inst) {
            var _this = $(this);
            var formID = _this.closest('form').prop('id');
            var selectedDateTime = _this.datetimepicker('getDate'); //the getDate method
            var selectedHours = selectedDateTime.getHours() < 10 ? "0" + selectedDateTime.getHours() : selectedDateTime.getHours();
            var selectedMins = selectedDateTime.getMinutes() < 10 ? "0" + selectedDateTime.getMinutes() : selectedDateTime.getMinutes();
            var pickedTime = selectedHours + ":" + selectedMins;
            var pickedDate = moment(selectedDateTime).format('YYYY-MM-DD');
            $("#TFdpd2-date").val(pickedDate);
            $("#TFdpd2-time").val(pickedTime);
            var transferType = $('input[name="TransferInfo.ReturnTime"]:checked').val();
            if (transferType == "ToAirport") {
                $("#TFdpd1-date").val(moment(selectedDateTime.addDays(-2)).format('YYYY-MM-DD'));
                $("#TFdpd1-time").val(pickedTime);
            }

        },
        onClose: function() {
            _mainBody.removeClass("list-visible");
        }
    }));


    $("#TFdpd3").datetimepicker($.extend({}, $.datepicker.regional[langCode], {
        numberOfMonths: 1,
        dateFormat: "dd/mm/yy",
        minDate: new Date().addDays(1),
        maxDate: new Date().addDays(365),
        prevText: '<span class="icon icon-round-left-arrow">',
        nextText: '<span class="icon icon-round-right-arrow">',
        showButtonPanel: true,
        oneLine: true,
        timeText: timetext,
        beforeShow: function() {
            _mainBody.addClass("list-visible");
        },
        onSelect: function(dateText, inst) {
            var _this = $(this);
            var formID = _this.closest('form').prop('id');
            var selectedDateTime = _this.datetimepicker('getDate'); //the getDate method
            var selectedHours = selectedDateTime.getHours() < 10 ? "0" + selectedDateTime.getHours() : selectedDateTime.getHours();
            var selectedMins = selectedDateTime.getMinutes() < 10 ? "0" + selectedDateTime.getMinutes() : selectedDateTime.getMinutes();
            var pickedTime = selectedHours + ":" + selectedMins;
            var pickedDate = moment(selectedDateTime).format('YYYY-MM-DD');
            $("#TFdpd3-date").val(pickedDate);
            $("#TFdpd3-time,#TFdpd3-Rtime").val(pickedTime);
            var transferType = $('input[name="TransferInfo.ReturnTime"]:checked').val();
            if (transferType == "ToAirport") {
                $("#TFdpd1-date").val(moment(selectedDateTime.addDays(-2)).format('YYYY-MM-DD'));
                $("#TFdpd1-time").val(pickedTime);
            }

        },
        onClose: function() {
            _mainBody.removeClass("list-visible");
        }
    }));
});

if (language == "zh-CN") {
    var timetext = "时间"
} else {
    var timetext = "TIME"
}

getDefaultDates(new Date().addDays(2), "TFdpd1");
getDefaultDates(new Date().addDays(3), "TFdpd2");
getDefaultDates(new Date().addDays(4), "TFdpd3");

function getDefaultDates(date, elementId) {
    var currentHours = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
    var currentMins = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
    var defaultTime = currentHours + ":" + currentMins;
    var defaultDateTime = moment(date).format('DD/MM/YYYY') + " " + defaultTime;
    //var defaultDate = moment(date).format('DD/MM/YYYY');
    var defaultDate = moment(date).format('YYYY-MM-DD');
    $("#" + elementId).val(defaultDateTime);
    $("#" + elementId + "-date").val(defaultDate);
    $("#" + elementId + "-time").val(defaultTime);
    $("#" + elementId + "-Rtime").val(defaultTime);
}