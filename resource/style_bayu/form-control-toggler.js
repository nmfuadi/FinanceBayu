function toggleTransferControls(transferType) {
    switch (transferType) {
        case "Return":
            {
                $('.fromAirport').show();
                $('.toAirport').hide();

                $.each($('.form-control.fromHotel'), function(key, element) {
                    $(element).attr('disabled', 'disabled');
                });

                $.each($('.form-control.toHotel'), function(key, element) {
                    $(element).removeAttr('disabled');
                });

                $.each($('.toAirport .form-control '), function(key, element) {
                    $(element).removeAttr('data-validation');
                });

                $.each($('.fromAirport .form-control '), function(key, element) {
                    $("#TFdpd2-date,#TFdpd2-time,#TFdpd1-date").prop('disabled', false);

                    if ($(element).hasClass('typeahead')) {
                        if ($(window).width() < 768) {
                            if ($(element).data('updatetrigger')) {
                                $(element).attr('data-validation', 'required');
                            } else {
                                return;
                            }
                        } else {
                            if (typeof $(element).data('updatetrigger') === "undefined") {
                                $(element).attr('data-validation', 'required');
                            } else {
                                return;
                            }
                        }
                    } else {
                        $(element).attr('data-validation', 'required');
                    }
                });

                $.each($('.trDepartOnly .form-control'), function(key, element) {
                    $(element).hasClass('hasDatepicker') ? $(element).datepicker("option", "disabled", false) : $(element).prop('disabled', false);
                });
                $.each($('.trArriveOnly .form-control'), function(key, element) {
                    $(element).hasClass('hasDatepicker') ? $(element).datepicker("option", "disabled", false) : $(element).prop('disabled', false);
                });
            }
            break;


        case "FromAirport":
            {
                $('.fromAirport').show();
                $('.toAirport').hide();
                //alert("From Airport");

                $.each($('.form-control.fromHotel'), function(key, element) {
                    $(element).attr('disabled', 'disabled');
                });

                $.each($('.form-control.toHotel'), function(key, element) {
                    $(element).removeAttr('disabled');
                });

                $.each($('.toAirport .form-control '), function(key, element) {
                    $(element).removeAttr('data-validation');
                });

                $.each($('.fromAirport:not(".trArriveOnly") .form-control '), function(key, element) {
                    $("#TFdpd1-date,#TFdpd1-time,#TFdpd2-time").prop('disabled', false);
                    $("#TFdpd2-date,#TFdpd3-date,#TFdpd3-time,#TFdpd3-Rtime").prop('disabled', true);

                    if ($(element).hasClass('typeahead')) {
                        if ($(window).width() < 768) {
                            if ($(element).data('updatetrigger')) {
                                $(element).attr('data-validation', 'required');
                            } else {
                                return;
                            }
                        } else {
                            if (typeof $(element).data('updatetrigger') === "undefined") {
                                $(element).attr('data-validation', 'required');
                            } else {
                                return;
                            }
                        }
                    } else {
                        $(element).attr('data-validation', 'required');
                    }
                });

                $.each($('.trArriveOnly .form-control'), function(key, element) {
                    // $(element).hasClass('hasDatepicker') ? $(element).datepicker("option", "disabled", false) : $(element).prop('disabled', false);
                    if ($(element).hasClass('hasDatepicker')) {
                        $(element).datepicker("option", "disabled", false)
                        getDefaultDates(new Date().addDays(2), "TFdpd1");
                    } else {
                        $(element).prop('disabled', false);
                    }
                });
                $.each($('.trDepartOnly .form-control, .trArriveOnly.fromAirport .form-control'), function(key, element) {
                    $(element).hasClass('hasDatepicker') ? $(element).datepicker("option", "disabled", true) : $(element).prop('disabled', true);
                });
            }
            break;
        case "ToAirport":
            {
                $('.fromAirport').hide();
                $('.toAirport').show();
                $.each($('.form-control.toHotel'), function(key, element) {
                    $(element).attr('disabled', 'disabled');
                });

                $.each($('.form-control.fromHotel'), function(key, element) {
                    $(element).removeAttr('disabled');
                });

                $.each($('.fromAirport .form-control '), function(key, element) {
                    $(element).removeAttr('data-validation');
                    // if( $(element).attr(type) !== "hidden") {
                    //     $(element).attr('disabled', 'disabled' );
                    // }

                });

                $.each($('.toAirport .form-control '), function(key, element) {
                    if ($(element).hasClass('typeahead')) {
                        if ($(window).width() < 768) {
                            if ($(element).data('updatetrigger')) {
                                $(element).attr('data-validation', 'required');
                            } else {
                                return;
                            }
                        } else {
                            if (typeof $(element).data('updatetrigger') === "undefined") {
                                $(element).attr('data-validation', 'required');
                            } else {
                                return;
                            }
                        }
                    } else {
                        $(element).attr('data-validation', 'required');
                    }
                });

                $.each($('.trArriveOnly .form-control'), function(key, element) {
                    //$(element).hasClass('hasDatepicker') ? $(element).datepicker("option", "disabled", true) : $(element).prop('disabled', true);

                    if ($(element).hasClass('hasDatepicker')) {
                        $(element).datepicker("option", "disabled", true);

                        getDefaultDates(new Date().addDays(2), "TFdpd1");
                    } else {
                        $(element).prop('disabled', true);

                    }
                });
                $.each($('.trDepartOnly .form-control'), function(key, element) {
                    // $(element).hasClass('hasDatepicker') ? $(element).datepicker("option", "disabled", false) : $(element).prop('disabled', false);
                    if ($(element).hasClass('hasDatepicker')) {
                        $(element).datepicker("option", "disabled", false);
                        $("#TFdpd2-date,#TFdpd2-time,#TFdpd1-date,#TFdpd1-time").prop('disabled', true);
                        $("#TFdpd3-date,#TFdpd3-time,#TFdpd3-Rtime").prop('disabled', false);
                        getDefaultDates(new Date().addDays(3), "TFdpd3");
                    } else {
                        $(element).prop('disabled', false);
                    }
                });
            }
            break;
    }
}

toggleTransferControls($('input[type=radio][name="TransferSearchInfo.TransferType"]').val());

$('input[type=radio][name="TransferSearchInfo.TransferType"]').change(function() {
    var TType = $(this).val();
    toggleTransferControls(TType);
});

function toggleCarRentalControls(isChecked) {
    $.each($('.dropFormCtrls .dropFormCtrl'), function(key, element) {
        $(element).hasClass('hasDatepicker') ? $(element).datepicker("option", "disabled", !isChecked) : $(element).prop('disabled', !isChecked);
    });
    if (!isChecked) {
        $('#crTo').val($('#crFrom').val());
        $('#crDropCity').removeAttr('data-validation');
    } else {
        $('#crDropCity').attr('data-validation', 'required');
    }
}

function toggleDriverAge(isChecked) {
    $('#crisDriverAge').val(isChecked);
    (isChecked) ? $('#crDriverAge').val("30"): $('#crDriverAge').val("0");
}

toggleDriverAge($('#driverAge').is(":checked"));
toggleCarRentalControls($('#dropDiffLoc').is(":checked"));

$('#dropDiffLoc').click(function() {
    toggleCarRentalControls($(this).is(":checked"));
});

$('#driverAge').click(function() {
    toggleDriverAge($(this).is(":checked"));
});

$('#hotelChk').click(function() {
    toggleHotelStay($(this).is(":checked"));
});

toggleHotelStay($('#hotelChk').is(":checked"));

function toggleHotelStay(isChecked) {
    if (isChecked) {
        $('#hotel-stay').show();
        $('#CheckOut').prop('disabled', false);
        $('#CheckIn').prop('disabled', false);
    } else {
        $('#hotel-stay').hide();
        $('#CheckOut').prop('disabled', true);
        $('#CheckIn').prop('disabled', true);
    }
}

function updateHotelStay(formID) {
    var startDate = $(formID).find('#dpd01').datepicker('getDate');
    var endDate = $(formID).find('#dpd02').datepicker('getDate');

    checkInStDate = startDate;
    checkInEndDate = new Date(endDate - 1);
    checkOutStDate = startDate.addDays(1);
    checkOutEndDate = endDate;

    var chkInCtrl = $('#dpd13'),
        chkOutCtrl = $('#dpd14');

    chkInCtrl.datepicker("option", "minDate", checkInStDate);
    chkInCtrl.datepicker("option", "maxDate", checkInEndDate);
    chkOutCtrl.datepicker("option", "minDate", checkOutStDate);
    chkOutCtrl.datepicker("option", "maxDate", checkOutEndDate);

}

$.each($('.add-persons'), function() {
    countRoomPersons($(this).data('trigger'), $(this).data('lang'));
});

$('#flightSearchForm input[type=radio][name="JourneyType"]').click(function() {
    var JType = parseInt($(this).val());
    toggleFlightJType(JType);
});

toggleFlightJType(parseInt($('#flightSearchForm input[type=radio][name="JourneyType"]').val()));

function toggleFlightJType(JType) {
    if (JType) {
        $("#dpd04").datepicker("option", "disabled", false);
        $("#dpd20").datepicker("option", "disabled", false);
    } else {
        $("#dpd04").datepicker("option", "disabled", true);
        $("#dpd20").datepicker("option", "disabled", true);
    }
}
$('#mflight input[type=radio][name="JourneyType"]').click(function() {
    var JType = parseInt($(this).val());
    toggleFlightModalJType(JType);
});

function toggleFlightModalJType(JType) {
    if (JType) {
        $("#dpd20").datepicker("option", "disabled", false);
    } else {
        $("#dpd20").datepicker("option", "disabled", true);
    }
}
$('.xs-typeahead-trigger').on('click', function() {
    var getid = $(this).attr("id");
    //alert(x + "," + y)
    var x, y;
    toggleXSDropdown($(this).data('trigger'), y, x);
});

var widWid = parseInt($(window).width());

if (widWid < 480) {

    $(".typeahead.tt-input").click(function() {
        var getid = $(this).attr("id");
        var element = document.getElementById(getid);
        var position = element.getBoundingClientRect();
        var x = position.left;
        var y = position.top;
        var getArSec = parseInt(widWid / 2)
        var getParent = $(this).closest(".twitter-typeahead");
        if (getArSec < x) {
            $(getParent).addClass("push-left");
            setTimeout(function() {
                $(getParent).find(".tt-menu").css("margin-left", "-" + (getArSec) + "px");
                $(getParent).find("pre").css("margin-left", "-40px");
            }, 100)
        }

    })
}

$('.close-typeahead-trigger').on('click', function() {
    toggleXSDropdown($(this).data('trgettrigger'));
    $("body").removeClass("list-visible");
});

$.each($('.xs-typeahead-trigger'), function() {
    // toggleXSDropdown($(this).data('trigger'));
});

function toggleXSDropdown(trigger, top, left) {
    var right = "inherit";
    $(trigger).toggle();
    $(trigger).find('.tt-input').focus();
    //$("body").addClass("list-visible");
    if ((widWid / 2) < left) {
        left = "inherit";
        right = "5px";
    } else {
        left = "5px"
    }
    //$(trigger).css({ "top": top + "px", "left": left, "right": right, "width": "300px", "margin-top": "50px", "height": "50vh" });
}