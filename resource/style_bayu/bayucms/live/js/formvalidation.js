var isUSADest = false;
$(document).ready(function() {
    $("form .btn").prop("disabled", false).removeClass("loader-bar");
    $(".validateForm").submit(function(event) {
        // event.preventDefault(); 
        var formSuccess = true;
        var formId = $(this).attr("id");
        var paxValidate = true;
        $("#" + formId + " .childAge:not('.hide') [data-validation='optional'], #" + formId + " [data-validation='required']:not('.tt-hint')").each(function() {
            var fieldValue = $(this).val();
            //console.log($(this), fieldValue);
            if (fieldValue === "") {
                $(this).addClass("has-error");
                formSuccess = false;
            }
        });
        if (formId === "FHform" || formId === "tOnlyForm" || formId === "transferOnlyForm" || formId === "mfhpackage") {
            paxValidate = totalPaxValidation(formId, 15);
            //     //console.log(paxValidate);
            //     // if (!paxValidate) {
            //     //     formSuccess = false;
            //     // }
        }
        // if (formId !== crForm) {
        //     paxValidate = totalPaxValidation(formId, 9);
        // }
        if (formSuccess && paxValidate) {
            if (formId == "FHform") {
                // if ((USdepCity == "US" || USArrCity == "US") && !isUSADest) {
                //     $('#USvalidation').modal("show");
                //     // console.log($("#FHform").attr("action") + $("#FHform").serialize())
                //     return false;
                // } else if (isUSADest) {
                //     return true;
                // }
            }
            return true
        } else {
            return false;
        }
        //return formSuccess && paxValidate;

    });

    $(".continue-usa").click(function() {
        isUSADest = true;
        $('#FHform').trigger('submit');
    });

    function totalPaxValidation(formId, limitedMax) {
        //var personCount = 0;
        var totalPersons = 0;
        $("#" + formId + " .custom-dropdown .passenger-control[name^='PaxInfos[']:not(.infant)").each(function() {
            //personCount++;
            if (!$(this).closest('div.room-container').hasClass('hide')) {

                totalPersons += parseInt($(this).parent(".label-input").find(".input-group").children('input[type=text]').val());
                //if (!$(this).closest('div.custom-padding').hasClass('childAge')) {}
            }
        });
        if (totalPersons > limitedMax) {
            $('#groupBook').modal('show');
            return false;
        }
        return true;
    }
    // function totalPaxValidation(formId, limitedMax) {
    //     var personCount = 0;
    //     var totalPerson = 0;
    //     $("#" + formId + " .custom-dropdown select").each(function() {
    //         personCount++;
    //         if (!$(this).closest('div.room-container').hasClass('hide')) {
    //             if (!$(this).closest('div.custom-padding').hasClass('childAge')) {
    //                 totalPerson += parseInt($(this).children("option:selected").val());
    //             }
    //         }
    //     });
    //     if ($("#packageForm").hasClass('in')) {
    //         $("#" + formId + " .custom-dropdown-pop select.user").each(function() {
    //             personCount++;
    //             if ($(this).closest('div.persons').hasClass('visible')) {
    //                 totalPerson += parseInt($(this).val());
    //             }

    //         });
    //     }

    //     if (totalPerson > limitedMax) {
    //         $(this).addClass("error-field");
    //         if ($("#packageForm").hasClass("in")) {
    //             $("#packageForm").modal('hide');
    //         }
    //         $('#groupBook').modal('show');
    //     } else {
    //         $(this).removeClass("error-field");
    //         return true;
    //     }
    //     switch (formId) {
    //         case "hotelpack":
    //             break;
    //         case "hotelpop":
    //             break;
    //         default:
    //             if (totalPerson > limitedMax) {
    //                 $('#groupBook').modal("show");
    //                 return false;
    //             } else {
    //                 return true;
    //             }
    //     }
    // }
});