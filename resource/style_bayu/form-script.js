var roomRef = "";
$(document).ready(function() {
    $(".validate").submit(function() {
        var formSuccess = true;
        var formId = $(this).attr("id");
        var paxValidate = true;
        $("#" + formId + ".validate [data-validation='required']").each(function() {
            var fieldValue = $(this).val();

            var fieldType = $(this).attr("data-type");
            formSuccess = true;

            //var test = isNumeric(elmVal);
            //alert(fieldValue)
            if (fieldValue == "") {
                $(this).parent(".form-group").removeClass("has-success");
                $(this).parent(".form-group").addClass("has-error");
                formSuccess = false;
                return false;
            } else {
                if (validateType(fieldType, fieldValue)) {
                    $(this).parent(".form-group").addClass("has-success");
                    $(this).parent(".form-group").removeClass("has-error");
                } else {
                    $(this).parent(".form-group").addClass("has-error");
                    $(this).parent(".form-group").removeClass("has-success");
                    formSuccess = false;
                    return false;
                }
            }
        });

        paxValidate = totalPaxValidation(formId, 9);
        if (!paxValidate) {
            formSuccess = false;
        }

        if (formSuccess) {
            return true;
        } else
            return false;

    });

    function validateType(type, fieldValue) {
        if (type == "email") {
            var emailreg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return fieldValue.match(emailreg);
        } else if (type == "string") {
            var stringreg = /^[a-zA-Z\s]*$/;
            return fieldValue.match(stringreg);
        } else if (type == "numString") {
            var strnumreg = /^[a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/;
            return fieldValue.match(strnumreg);
        } else if (type == "number") {
            var numreg = /^[0-9\b]+$/;
            return fieldValue.match(numreg);
        } else if (type == "dropdown") {
            if (fieldValue == 0)
                return false;
            else
                return true;
        } else if (type == "any") {
            return true;
        }
    }
    $('.nav-tabs li a[data-toggle="tab"], .navbar-nav li a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        var paxdropIsVisible = $(".custom-dropdown").is(":visible");
        if (paxdropIsVisible) {
            $(".custom-dropdown").addClass("hide");
        }
    });
    /*-----Passenger spinner control-------*/
    $(".passenger-control").inputSpinner({
        decrementButton: "<i class='icon-minus-outline'></i>", // button text
        incrementButton: "<i class='icon-add-outline'></i>",
        buttonsClass: "btn-primary",
        buttonsWidth: "2.5rem",
    });
    $.each($('.passenger-control'), function() {
        $(this).trigger("change")
    });

    function disableSpinnerButtons(element) {
        var min, max, value;
        min = element.attr('min');
        max = element.attr('max');
        value = element.val();

        var addButton = element.closest('.label-input').find('.input-group').children('.input-group-append').find('.btn'),
            subButton = element.closest('.label-input').find('.input-group').children('.input-group-prepend').find('.btn')

        if (value >= max) {
            addButton.attr('disabled', 'disabled');
        } else if (value <= min) {
            subButton.attr('disabled', 'disabled');
        } else {
            addButton.removeAttr('disabled');
            subButton.removeAttr('disabled');
        }
    }

    $(".passenger-control").on("change", function() {
            disableSpinnerButtons($(this));
        })
        /*-----Passenger spinner control-------*/
    $(".roomSel").change(function() {
        var dataRef = $(this).attr("data-ref");
        roomRef = dataRef;
        var noOfrooms = $(this).val();
        var getFormID = $(this).closest("form").attr('id');
        $("#" + dataRef + " .room-selection").removeClass("visible");
        $(".room-adult").val("0");
        $(".adult").attr("data-ref");
        //alert(dataRef);
        if (noOfrooms > 1) {
            $("#" + dataRef + ".hidden-panel").addClass("show");
            $("#" + getFormID + " .room1title").removeClass("hide");
        } else {
            $("#" + dataRef + ".hidden-panel").removeClass("show");
            $("#" + getFormID + " .room1title").addClass("hide");
        }
        for (i = 2; i <= noOfrooms; i++) {
            $("#" + dataRef + " .room" + i).addClass("visible");
            var roomAdultId = $("#" + dataRef + " .room" + i).children().find(".adult").attr("data-ref");
            $("#" + roomAdultId).val("1");

        }
        for (i = 5; i > noOfrooms; i--) {
            $("#childAge" + i).removeClass("visible");
        }
        var langId = $(".add-persons").attr("data-lang");
        countRoomPersons("." + roomRef, langId);
    });
    $(".children").change(function() {
        var dataRef = $(this).attr("data-ref");
        var noOfchild = $(this).val();
        $("#" + dataRef + ".chidAgeSel").removeClass("visible");
        $("#" + dataRef + ".chidAgeSel .form-group").hide();
        if (noOfchild >= 1) {
            $("#" + dataRef).addClass("visible")
            for (i = 1; i <= noOfchild; i++) {
                $("#" + dataRef + ".chidAgeSel .form-group.child" + i).show();
            }
        }
    });
    $(".city-search").click(function() {
        var cityCode = $(this).attr("data-code");
        var cityName = $(this).attr("data-name");
        $("#myModalLabel span").text(cityName);
        $("#AutodepCity option").removeAttr("selected");
        $("#AutodepCity option").each(function() {
            var selVal = $(this).val();
            if (selVal == cityCode) {
                $(this).attr("selected", "selected");
            }
        });
    });
    $(".adult").change(function() {
        var adultRef = $(this).attr("data-ref");
        var noOfadult = $(this).val();
        $("#" + adultRef).val(noOfadult);
    });

    $(".close-pop").click(function() {
        var dataRef = $(this).attr("data-ref");
        $("#" + dataRef).removeClass("show");
        $("body").removeClass("overflow-hide");
    });

    $(".toggle-menu").click(function() {
        $("#main_menu").slideToggle();
    });
    $(".trigger-tab").click(function() {
        var triggerHref = $(this).attr("href");
        var triggerTarget = triggerHref.substring(1, triggerHref.length);
        $("[data-tabid='" + triggerTarget + "']").click();
    });
    $(".updateForm").click(function() {
        var CityName = $(this).attr("data-city");
        var CityCode = $(this).attr("data-code");
        var hotelCode = $(this).attr("data-hcode");
        var dataTarget = $(this).attr("data-target");
        $(dataTarget + " .modal-title label").text(CityName);
        if (dataTarget == "#hotelFormPopup") {
            $(dataTarget + " #arrCity1 option").text(CityName).val(CityCode);
        } else {
            $(dataTarget + " #hotelcode").val(hotelCode)
            $(dataTarget + " #PHC").val(CityName)
            $(dataTarget + " #PHCC").val(CityCode);
            $(dataTarget + " #PHC").attr('disabled', 'disabled');
        }

        if (dataTarget == "#hotelFormPopupOnlyHotel") {
            $(dataTarget + " #arrCity1 option").text(CityName).val(CityCode);
            $(dataTarget + " #PHC").val(CityName)
            $(dataTarget + " #PHCC").val(CityCode);
            $(dataTarget + " #PHC").attr('disabled', 'disabled');
            $(dataTarget + " #hotelCurrency option").text($(dataTarget + " #hotelpackpopup input[name='Currency']").val()).val($(dataTarget + " #hotelpackpopup input[name='Currency']").val());
        }
    });

    $(".updateArrForm").click(function() {
        var arrCityName = $(this).attr("arr-city");
        var arrCityCode = $(this).attr("arr-code");
        var dataTarget = $(this).attr("data-target");
        var numberOfCity = $(this).attr("data-noc");
        $(dataTarget + " #arrCity1").html();
        if (dataTarget === "#arrivalCityForm") {
            $(dataTarget + " #arrCity1").append("<option value=" + arrCityCode + ">" + arrCityName + " (" + arrCityCode + ")</option>");
            $(dataTarget + " #PHC").val(arrCityName + " (" + arrCityCode + ")")
            $(dataTarget + " #PHCC").val(arrCityCode);
        }
    });
    $(".updateMultiArrForm").click(function() {
        var dataTarget = $(this).attr("data-target");
        var numberOfCity = $(this).attr("data-noc");
        $(dataTarget + " #arrCity1").html("");
        for (i = 1; i <= numberOfCity; i++) {
            var arrCityName = $(this).attr("arr-city" + i);
            var arrCityCode = $(this).attr("arr-code" + i);
            if (dataTarget === "#arrivalCityForm") {
                $(dataTarget + " #arrCity1").append("<option value=" + arrCityCode + ">" + arrCityName + " (" + arrCityCode + ")</option>");
                $(dataTarget + " #PHC").val(arrCityName + " (" + arrCityCode + ")")
                $(dataTarget + " #PHCC").val(arrCityCode);
            }
        }
    });
    $(".updateMultiDeptForm").click(function() {
        var dataTarget = $(this).attr("data-target");
        var numberOfCity = $(this).attr("data-noc");
        var arrCityName = $(this).attr("arr-city");
        var arrCityCode = $(this).attr("arr-code");
        var hotelcode = $(this).attr("hotel-code");
        $('.hotelcode').val(hotelcode);
        $(dataTarget + " #depCity1").html("");

        for (i = 1; i <= numberOfCity; i++) {
            var dptCityName = $(this).attr("dpt-city" + i);
            var dptCityCode = $(this).attr("dpt-code" + i);
            if (dataTarget === "#packageForm") {
                $(dataTarget + " #depCity1").append("<option value=" + dptCityCode + ">" + dptCityName + " (" + dptCityCode + ")</option>");
            }
        }
        $(dataTarget + " #arrCity1 option").text(arrCityName + " (" + arrCityCode + ")").val(arrCityCode);
    });

    $(".updateFlightPopupForm").click(function() {
        var depcity = $(this).attr("dpt-city");
        var depcode = $(this).attr("dpt-code");
        var arrcity = $(this).attr("arr-city");
        var arrcode = $(this).attr("arr-code");
        var target = $(this).attr("data-target");
        $(target + " #FdepartCity").val(depcity + " (" + depcode + ")").next("input[type='hidden']").val(depcode);
        $(target + " #FarrivalCity").val(arrcity + " (" + arrcode + ")").next("input[type='hidden']").val(arrcode);
    });
    $(".updateMultiDept_ArrForm").click(function() {
        var dataTarget = $(this).attr("data-target");
        var dptnumberOfCity = $(this).attr("data-deptnoc");
        var arrnumberOfCity = $(this).attr("data-arrnoc");
        //var arrCityName = $(this).attr("arr-city");
        //var arrCityCode = $(this).attr("arr-code");
        $(dataTarget + " #depCity1").html("");
        $(dataTarget + " #arrCity1").html("");
        $(dataTarget + " #fedepCity1").html("");
        $(dataTarget + " #fearrCity1").html("");
        for (i = 1; i <= dptnumberOfCity; i++) {
            var dptCityName = $(this).attr("dpt-city" + i);
            var dptCityCode = $(this).attr("dpt-code" + i);;
            if (dataTarget === "#hotelFormPopup" || dataTarget === "#FEformPopup") {
                $(dataTarget + " #depCity1").append("<option value=" + dptCityCode + ">" + dptCityName + " (" + dptCityCode + ")</option>");
                $(dataTarget + " #fedepCity1").append("<option value=" + dptCityCode + ">" + dptCityName + " (" + dptCityCode + ")</option>");
            }
        }
        for (i = 1; i <= arrnumberOfCity; i++) {
            var arrCityName = $(this).attr("arr-city" + i);
            var arrCityCode = $(this).attr("arr-code" + i);
            if (dataTarget === "#hotelFormPopup" || dataTarget === "#FEformPopup") {

                $(dataTarget + " #arrCity1").append("<option value=" + arrCityCode + ">" + arrCityName + " (" + arrCityCode + ")</option>");
                $(dataTarget + " #fearrCity1").append("<option value=" + arrCityCode + ">" + arrCityName + " (" + arrCityCode + ")</option>");
            }
        }
        //$(dataTarget + " #arrCity1 option").text(arrCityName + " (" + arrCityCode + ")").val(arrCityCode);
    });
    $(".updateFormFromTo").click(function() {
        var depCityName = $(this).attr("depart-city");
        var depCityCode = $(this).attr("depart-code");
        var arrCityName = $(this).attr("arr-city");
        var arrCityCode = $(this).attr("arr-code");
        var hotelCode = $(this).attr("data-hcode");
        var dataTarget = $(this).attr("data-target");
        $(dataTarget + " .modal-title label").text(arrCityName);
        /*google tracking code*/
        var gaCat = $(this).attr("data-catagory");
        var gaAct = $(this).attr("data-action");
        var gaLbl = $(this).attr("data-label");
        if (gaCat !== undefined && gaAct !== undefined && gaLbl !== undefined) {
            $(dataTarget + " .modal-footer .btn").attr("onClick", "ga('send', 'event', { eventCategory: '" + gaCat + "', eventAction: '" + gaAct + "', eventLabel: '" + gaLbl + "'});");
        }
        /*google tracking code ends*/

        var sDate = $(this).attr("data-sdate");
        var eDate = $(this).attr("data-edate");
        var packageDays = $(this).attr("data-package");
        var dateStart = [];
        var dateEnd = [];
        if ((sDate === undefined || sDate === "") && (eDate === undefined || eDate === "") && (packageDays === undefined || packageDays === "")) {
            dateQuery("#dpd07", "#dpd08", new Date().addDays(1));
            dateQuery("#dpd09", "#dpd10", new Date().addDays(1));
            dateQuery("#dpd11", "#dpd12", new Date().addDays(1));
        } else {
            var a = new Date().addDays(1);
            var b = new Date().addDays(365);
            var c;
            //alert(sDate+" top "+eDate+" ");
            if (sDate !== undefined && sDate !== "") {
                dateStart = sDate.split("-");
                a = new Date(dateStart[2], (parseInt(dateStart[1]) - 1), dateStart[0]);
            }
            if (eDate !== undefined && eDate !== "") {
                //alert(eDate);
                dateEnd = eDate.split("-");
                b = new Date(dateEnd[2], (parseInt(dateEnd[1]) - 1), dateEnd[0]);
            }
            dateQuery("#dpd07", "#dpd08", a);
            dateQuery("#dpd09", "#dpd10", a);
            dateQuery("#dpd11", "#dpd12", a);
            if (packageDays !== undefined && packageDays !== "") {
                $("#dpd07").val(formatDate2(a.addDays(parseInt(packageDays) - 2)));
                $("#dpd09").val(formatDate2(a.addDays(parseInt(packageDays) - 2)));
                $("#dpd11").val(formatDate2(a.addDays(parseInt(packageDays) - 2)));

                $("#dpd08").val(formatDate2(a.addDays(parseInt(packageDays))));
                $("#dpd10").val(formatDate2(a.addDays(parseInt(packageDays))));
                $("#dpd12").val(formatDate2(a.addDays(parseInt(packageDays))));
            }
        }
        if (dataTarget == "#packageForm") {
            $(dataTarget + " #arrCity1 option").text(arrCityName).val(arrCityCode);
            //updateDepartureList(CityCode)
        } else {
            $(dataTarget + " #hotelcode").val(hotelCode);
            $(dataTarget + " #PHC").val(arrCityName);
            $(dataTarget + " #PHCC").val(arrCityCode);
            $(dataTarget + " #PHC").attr('disabled', 'disabled');
        }

        if (dataTarget == "#hotelFormPopup") {
            $(dataTarget + " #arrCity1 option").text(arrCityName).val(arrCityCode);
            $(dataTarget + " #depCity1 option").text(depCityName).val(depCityCode);
            $(dataTarget + " #PHC").val(arrCityName);
            $(dataTarget + " #PHCC").val(arrCityCode);
            $(dataTarget + " #PHC").attr('disabled', 'disabled');
            // applyDisableDates(depCityCode, depCityCode, dataTarget);
            $(dataTarget + " #hotelCurrency option").text($(dataTarget + " #hotelpackpopup input[name='Currency']").val()).val($(dataTarget + " #hotelpackpopup input[name='Currency']").val());
        }


        // clevertap Tracking event
        var _this = $(this);
        var _closestSection = _this.closest("section");

        if (typeof clevertap === 'object') {
            //Modal onclick button event with properties 
            clevertap.event.push("H_Content_Clicked", {
                "ContentSection": _closestSection.find(".text-red").text(),
                "CardTitle": arrCityName,
                "Page": window.location.href
            });
        }

    });

    // $("#arrCity, #depCity").select2();

    $('.banner .bookingtab .nav-tabs>li>a').click(function() {
        if ($(window).width() < 600) {
            $('.bookingtab').addClass('bookingtab600');
        }
    });
    // if ($(window).width() < 600) {

    //     $(".bookingtab .tab-content .tab-pane").removeClass("active");
    //     $(".bookingtab .tab-content .tab-pane").removeClass("in");

    // }

});

function formatDate2(date) {
    var d = date;
    var curr_date = d.getDate();
    var curr_month = d.getMonth();
    curr_month++;
    var curr_year = d.getFullYear();
    if (curr_date < 10)
        curr_date = "0" + curr_date;
    if (curr_month < 10)
        curr_month = "0" + curr_month;
    return curr_date + "/" + curr_month + "/" + curr_year;
}

function open(elem) {
    //console.log("open triggered")
    if (document.createEvent) {
        var e = document.createEvent("MouseEvents");
        e.initMouseEvent("mousedown", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
        elem[0].dispatchEvent(e);
    } else if (element.fireEvent) {
        elem[0].fireEvent("onmousedown");
    }
}