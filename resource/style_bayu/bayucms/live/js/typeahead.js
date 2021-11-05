var emptyTemplate = [
    '<div class="empty-message">' +
    '<i class="fas icon-map-marker"></i>&nbsp;' +
    'No matching result found.' +
    '</div>'
];

var pendingTemplate = [
    '<div class="flight-result-ddr__item has-spinner">' +
    ' <img src="https://gqcms-res.s3.amazonaws.com/bayucms/staging/images/loader.gif" style="width:50px;" />' +
    '</div>'
];
var selectedLang = $(".CultureCode").val();

function suggestionTemplate() {
    $resultIcon = $('<i>').toggleClass('fas icon-map-marker', true);
    $cityName = $('<div>').toggleClass('name-city', true);
    $resultName = $('<span>').toggleClass('result-name', true).text(data.name);
    $resultCode = $('<b>').text(data.code).toggleClass('result-code text-black text-right', true);
    $cityName.append($resultName);
    $resultItem = $('<div>').toggleClass('flight-result-ddr__item', true);
    $resultItem.append($resultIcon, $cityName, $resultCode);
    return $resultItem;
}

$('#departCity, #arrivalCity, #fdepartCity, #farrivalCity, #tdepartCity, #trDepartCity,#crPickCity,#crDropCity,#cdfarrivalCity,#cdfdepartCity,#cdFHdepartCity,#cdFHarrivalCity,#cdtrDepartCity').typeahead({
    minLength: 1,
    highlight: true,
    input: $('.my-input'),
    hint: $('my-hint'),
    results: $('.my-results'),
    backdrop: {
        "background-color": "#fff"
    },
    backdropOnFocus: true,
}, {
    display: 'value',
    limit: Infinity,
    source: function(query, syncResults, asyncResults) {
        $.get(domain + "api/get-regions-and-airports?term=" + query + "&type=Airport" + "&CultureCode=" + selectedLang, function(data) {
            asyncResults(data)
        });
    },
    templates: {
        empty: emptyTemplate,
        suggestion: function(data) {

            $resultIcon = $('<i>').toggleClass('fas icon-map-marker', true);

            $cityName = $('<div>').toggleClass('name-city', true);
            //$NameCity = $('<p>').toggleClass('result-name', true);
            //$resultName = $('<p class="result-name"><span>' + data.name + ' (' + data.code + ')</span><span class="country-name">' + data.cityName + '</span></p>');
            $resultName = $('<p class="result-name"><span>' + data.name + ' </span><span class="country-name">' + data.countryName + '</span></p>');
            //$contryName = $('<span').toggleClass('', true).text(data.cityName);
            //$resultName = $NameCity.append($resultName).append($contryName);
            $resultCode = $('<b>').text(data.code).toggleClass('result-code text-black text-right', true);

            $cityName.append($resultName);

            $resultItem = $('<div>').toggleClass('flight-result-ddr__item', true);
            $resultItem.append($resultIcon, $cityName, $resultCode)

            return $resultItem;
        },
        footer: "<div class='tt-footer'><button class='tt-footer-btn' type='button'>Close <i class='icon-cross'></i></button></div>",
        pending: pendingTemplate
    }
});

// $('#HOnlyDest,#cdHOnlyDest').typeahead({
//     minLength: 1,
//     highlight: true
// }, {
//     display: 'value',
//     limit: Infinity,
//     source: function(query, syncResults, asyncResults) {
//         $.get(domain + "api/search-regions?term=" + query, function(data) {
//             asyncResults(data)
//         });
//     },
//     templates: {
//         empty: emptyTemplate,
//         header: '<h3 class="league-name">airports</h3>',
//         suggestion: function(data) {
//             $resultIcon = $('<i>').toggleClass('fas icon-map-marker', true);
//             $cityName = $('<div>').toggleClass('name-city', true);
//             $resultName = $('<span>').toggleClass('result-name', true).text(data.name + ", " + data.countryName);
//             $resultCode = $('<b>').text(data.cityCode).toggleClass('result-code text-right', true);
//             $cityName.append($resultName);
//             $resultItem = $('<div>').toggleClass('flight-result-ddr__item', true);
//             $resultItem.append($resultIcon, $cityName, $resultCode)
//             return $resultItem;
//         },
//         footer: "<div class='tt-footer'><button class='tt-footer-btn' type='button'>Close <i class='icon-cross'></i></button></div>",
//         pending: pendingTemplate
//     },

// });

$('#HOnlyDest').typeahead({
    minLength: 1,
    highlight: true,
    hint: true,
}, {
    limit: Infinity,
    name: 'hotels',
    displayKey: function(obj) {
        return obj.name;
    },
    source: function(query, syncResults, asyncResults) {
        $.get(domain + "api/search-regions?term=" + query + "&type=region" + "&CultureCode=" + selectedLang, function(data) {
            asyncResults(data);
        });
    },
    templates: {
        empty: emptyTemplate,
        header: "<h1 class='league-name'> DESTINATION/CITY</h1>",
        suggestion: function(data) {
            $resultIcon = $('<i>').toggleClass('fas icon-map-marker', true);
            $cityName = $('<div>').toggleClass('name-city', true);
            $resultName = $('<span>').toggleClass('result-name', true).text(data.name + ", " + data.countryName);
            $resultCode = $('<b>').text(data.cityCode).toggleClass('result-code text-right', true);
            $cityName.append($resultName);
            $resultItem = $('<div>').toggleClass('flight-result-ddr__item', true);
            $resultItem.append($resultIcon, $cityName, $resultCode)
            return $resultItem;
        },
        // footer: "<div class='tt-footer'><button class='tt-footer-btn' type='button'>Close <i class='icon-cross'></i></button></div>",
        //pending: pendingTemplate
    },
}, {
    display: 'name',
    limit: Infinity,
    source: function(query, syncResults, asyncResults) {
        $.get(domain + "api/search-regions?term=" + query + "&type=hotel" + "&CultureCode=" + selectedLang, function(data) {
            asyncResults(data);
        });
    },
    templates: {
        //  empty: emptyTemplate,
        header: "<h1 class='league-name'> PROPERTIES</h1>",
        suggestion: function(data) {
            $resultIcon = $('<i>').toggleClass('fas icon-map-marker', true);
            $cityName = $('<div>').toggleClass('name-city', true);
            $resultName = $('<span>').toggleClass('result-name', true).text(data.regionName + ', ' + data.name + ", " + data.countryName);
            $resultCode = $('<span>').text(data.destination).toggleClass('res-des text-left', true);
            // $resultCode = $('<b>').text(data.cityCode).toggleClass('result-code text-right', true);
            $cityName.append($resultName);
            $resultItem = $('<div>').toggleClass('flight-result-ddr__item', true);
            $resultItem.append($resultIcon, $cityName, $resultCode)
            return $resultItem;
        },
        // footer: "<div class='tt-footer'><button class='tt-footer-btn' type='button'>Close <i class='icon-cross'></i></button></div>",
        // pending: pendingTemplate

    }
}, {
    limit: Infinity,
    name: 'regions',
    displayKey: function(obj) {
        return obj.name;
    },
    source: function(query, syncResults, asyncResults) {
        $.get(domain + "api/search-regions?term=" + query + "&type=airport" + "&CultureCode=" + selectedLang, function(data) {
            asyncResults(data);
        });
    },
    templates: {
        //empty: emptyTemplate,
        header: "<h1 class='league-name'> AIRPORT/STATION</h1>",
        suggestion: function(data) {
            $resultIcon = $('<i>').toggleClass('fas icon-map-marker', true);
            $cityName = $('<div>').toggleClass('name-city', true);
            $resultName = $('<span>').toggleClass('result-name', true).text(data.name + ", " + data.countryName);
            $resultCode = $('<b>').text(data.cityCode).toggleClass('result-code text-right', true);

            $cityName.append($resultName);
            $resultItem = $('<div>').toggleClass('flight-result-ddr__item', true);
            $resultItem.append($resultIcon, $cityName, $resultCode)
            return $resultItem;
        },
        footer: "<div class='tt-footer'><button class='tt-footer-btn' type='button'>Close <i class='icon-cross'></i></button></div>",
        // pending: pendingTemplate
    }




});

$('#TOnlyDest,#cdTOnlyDest').typeahead({
    minLength: 1,
    highlight: true
}, {
    display: 'value',
    source: function(query, syncResults, asyncResults) {
        $.get(domain + "api/get-regions-and-airports?term=" + query + "&type=Region" + "&CultureCode=" + selectedLang, function(data) {
            asyncResults(data)
        });
    },
    templates: {
        empty: emptyTemplate,
        suggestion: function(data) {
            $resultIcon = $('<i>').toggleClass('fas icon-map-marker', true);

            $cityName = $('<div>').toggleClass('name-city', true);

            $resultName = $('<span>').toggleClass('result-name', true).text(data.name);
            $resultCode = $('<b>').text(data.code).toggleClass('result-code text-right', true);

            $cityName.append($resultName);

            $resultItem = $('<div>').toggleClass('flight-result-ddr__item', true);
            $resultItem.append($resultIcon, $cityName, $resultCode)

            return $resultItem;
        },
        footer: "<div class='tt-footer'><button class='tt-footer-btn' type='button'>Close <i class='icon-cross'></i></button></div>",
        pending: pendingTemplate
    }
});
$('#trDropLoc,#cdtrDropLoc').typeahead({
    minLength: 1,
    highlight: true
}, {
    display: 'value',
    limit: Infinity,
    source: function(query, syncResults, asyncResults) {
        $.get(domain + "api/search-regions?term=" + query + "&take=10&type=Hotel&airport=" + $('#TransferOnlyTo').val() + "&CultureCode=" + selectedLang, function(data) {
            asyncResults(data)
        });
    },
    templates: {
        empty: emptyTemplate,
        suggestion: function(data) {
            $resultIcon = $('<i>').toggleClass('fas icon-map-marker', true);

            $cityName = $('<div>').toggleClass('name-city', true);

            $resultName = $('<span>').toggleClass('result-name', true).text(data.name + ", " + data.regionName + ", " + data.countryName);
            $resultCode = $('<span>').text(data.destination).toggleClass('res-des text-left', true);

            $cityName.append($resultName);

            $resultItem = $('<div>').toggleClass('flight-result-ddr__item', true);
            $resultItem.append($resultIcon, $cityName, $resultCode)

            return $resultItem;
        },
        footer: "<div class='tt-footer'><button class='tt-footer-btn' type='button'>Close <i class='icon-cross'></i></button></div>",
        pending: pendingTemplate
    }
});

$('#trPickLoc,#cdtrPickLoc').typeahead({
    minLength: 1,
    highlight: true
}, {
    display: 'value',
    limit: Infinity,
    source: function(query, syncResults, asyncResults) {
        $.get(domain + "api/search-regions?term=" + query + "&associatedAirport=true&type=Hotel" + "&CultureCode=" + selectedLang, function(data) {
            asyncResults(data)
        });
    },
    templates: {
        empty: emptyTemplate,
        suggestion: function(data) {
            $resultIcon = $('<i>').toggleClass('fas icon-map-marker', true);

            $cityName = $('<div>').toggleClass('name-city', true);

            $resultName = $('<span>').toggleClass('result-name', true).text(data.name + ", " + data.regionName + ", " + data.countryName);
            $resultCode = $('<span>').text(data.destination).toggleClass('res-des text-left', true);

            $cityName.append($resultName);

            $resultItem = $('<div>').toggleClass('flight-result-ddr__item', true);
            $resultItem.append($resultIcon, $cityName, $resultCode)

            return $resultItem;
        },
        footer: "<div class='tt-footer'><button class='tt-footer-btn' type='button'>Close <i class='icon-cross'></i></button></div>",
        pending: pendingTemplate
    }
});

function iniPickCity(attrib) {
    $(attrib).typeahead({
        highlight: true,
        minLength: 0,
    }, {
        display: 'value',
        limit: Infinity,
        source: function(query, syncResults, asyncResults) {
            var cityCode = $('#cityCode').val(),
                cultureCode = $('#cultureCode').val();
            var formData = new FormData();
            formData.set('regionId', cityCode);
            formData.append('cultureCode', cultureCode);
            // $.post(domain + "api/get-airports-of-city?regionId=" + cityCode + "&cultureCode=" + cultureCode, function(data) {
            //     asyncResults(data);
            //     var formData = new FormData();
            //     formData.set('regionId', cityCode);
            //     formData.append('cultureCode', cultureCode);
            // });
            // $.post(domain + "api/get-airports-of-city", formData, function(data) {
            //     asyncResults(data);

            // });
            $.ajax({
                url: domain + "api/get-airports-of-city",
                type: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
            }).done(function(response) {
                asyncResults(response);
            });
        },
        templates: {
            empty: emptyTemplate,
            suggestion: function(data) {
                $resultIcon = $('<i>').toggleClass('fas icon-map-marker', true);

                $cityName = $('<div>').toggleClass('name-city', true);

                $resultName = $('<span>').toggleClass('result-name', true).text(data.name);

                $cityName.append($resultName);

                $resultItem = $('<div>').toggleClass('flight-result-ddr__item', true);
                $resultItem.append($resultIcon, $cityName)

                return $resultItem;
            },
            footer: "<div class='tt-footer'><button class='tt-footer-btn' type='button'>Close <i class='icon-cross'></i></button></div>",
            pending: pendingTemplate
        }

    });

}

$('.typeahead').bind('typeahead:select', function(ev, suggestion) {
    switch (ev.currentTarget.id) {
        case 'departCity':
            $('#deptFHid').val(suggestion.code);
            break;
        case 'cdFHdepartCity':
            var label = $(this).data('updatetrigger');
            $(label + " h2").html(suggestion.code);
            $(label + " label").html(suggestion.cityName);
            toggleXSDropdown($(this).data('trgettrigger'));
            $('#deptFHid').val(suggestion.code);
            break;
        case 'cdfarrivalCity':
            // $('#cdArrCity').val(suggestion.code);
            var label = $(this).data('updatetrigger');
            $(label + " h2").html(suggestion.code);
            $(label + " label").html(suggestion.cityName);
            toggleXSDropdown($(this).data('trgettrigger'));
            $('#arrFid').val(suggestion.code);
            break;
        case 'cdfdepartCity':
            var label = $(this).data('updatetrigger');
            $(label + " h2").html(suggestion.code);
            $(label + " label").html(suggestion.cityName);
            toggleXSDropdown($(this).data('trgettrigger'));
            $('#deptFid').val(suggestion.code);
            break;
        case 'cdFHarrivalCity':
            var label = $(this).data('updatetrigger');
            $(label + " h2").html(suggestion.code);
            $(label + " label").html(suggestion.cityName);
            toggleXSDropdown($(this).data('trgettrigger'));
            $('#arrFHid').val(suggestion.code);
            break;
        case 'arrivalCity':
            $('#arrFHid').val(suggestion.code);
            break;
        case 'fdepartCity':
            $('#deptFid').val(suggestion.code);
            break;
        case 'farrivalCity':
            $('#arrFid').val(suggestion.code);
            break;
        case 'HOnlyDest':
            {
                var parent = $("#" + ev.currentTarget.id).parent();
                $('#HCC').val(suggestion.code);
                if (suggestion.type === 'hotel') {
                    if (parent.has('#HotelCode').length) {
                        $('#HotelCode').val(suggestion.id);

                    } else {
                        var HotelCode = $('<input>').attr('name', 'HotelCode').attr('type', 'hidden').attr('id', 'HotelCode');
                        HotelCode.val(suggestion.id);
                        $(HotelCode).appendTo(parent);
                        $('#HCC').val(suggestion.regionIds[0]);
                    }
                } else {
                    if (parent.has('#HotelCode').length) {
                        parent.find('#HotelCode').remove();
                    }
                }
            }
            break;
        case 'cdHOnlyDest':
            {
                var parent = $("#" + ev.currentTarget.id).parent();
                $('#HCC').val(suggestion.code);
                var label = $(this).data('updatetrigger');
                toggleXSDropdown($(this).data('trgettrigger'));
                if (suggestion.type === 'hotel') {
                    $(label + " h2").html(suggestion.cityCode);
                    $(label + " label").html(suggestion.name);
                    if (parent.has('#HotelCode').length) {
                        $('#HotelCode').val(suggestion.id);
                    } else {
                        var HotelCode = $('<input>').attr('name', 'HotelCode').attr('type', 'hidden').attr('id', 'HotelCode');
                        HotelCode.val(suggestion.id);
                        $(HotelCode).appendTo(parent);
                    }
                } else {
                    $(label + " h2").html(suggestion.cityCode);
                    $(label + " label").html(suggestion.name);
                    if (parent.has('#HotelCode').length) {
                        parent.find('#HotelCode').remove();
                    }
                }
            }
            break;
        case 'TOnlyDest':
            {
                $('#TourOnlyTo').val(suggestion.code);
            }
            break;
        case 'cdTOnlyDest':
            {
                var label = $(this).data('updatetrigger');
                $(label + " h2").html(suggestion.code);
                $(label + " label").html(suggestion.name);
                toggleXSDropdown($(this).data('trgettrigger'));
                $('#TourOnlyTo').val(suggestion.code);
            }
            break;
        case 'trDepartCity':
            {

                $('#TransferOnlyTo').val(suggestion.code);
                $('#trDropLoc').prop('disabled', false);
            }
            break;
        case 'cdtrDepartCity':
            {
                var label = $(this).data('updatetrigger');
                $(label + " h2").html(suggestion.code);
                $(label + " label").html(suggestion.name);
                toggleXSDropdown($(this).data('trgettrigger'));
                $('#TransferOnlyTo').val(suggestion.code);
                $('#cdtrDropLoc').prop('disabled', false);
            }
            break;
        case 'trPickCity':
            {
                $('#TransferFromHotel').val(suggestion.code);
                $('#TransferOnlyTo').val(suggestion.code);
                $("#return-05,#cityCode").prop('disabled', true);
            }
            break;
        case 'cdtrPickCity':
            {
                var label = $(this).data('updatetrigger');
                $(label + " h2").html(suggestion.code);
                $(label + " label").html(suggestion.name);
                toggleXSDropdown($(this).data('trgettrigger'));
                $('#TransferFromHotel').val(suggestion.code);
            }
            break;
        case 'trPickLoc':
            {
                $('#TrSrchRegion').val('H:' + suggestion.id);
                $('#TrSrchCORDS').val(suggestion.latitude + ',' + suggestion.longitude);
                $('#cityCode').val(suggestion.cityCode);
                $('#trPickCity').typeahead('destroy');
                $('#trPickCity').val("");
                $('#cityCode').val(suggestion.regionIds[0]);
                iniPickCity('#trPickCity');
            }
            break;
        case 'cdtrPickLoc':
            {
                var label = $(this).data('updatetrigger');
                $(label + " h2").html(suggestion.cityCode);
                $(label + " label").html(suggestion.name);
                toggleXSDropdown($(this).data('trgettrigger'));
                $('#TrSrchRegionFromHotel').val('H:' + suggestion.id);
                $('#TrSrchCORDSFromHotel').val(suggestion.latitude + ',' + suggestion.longitude);
                $('#cityCode').val(suggestion.cityCode);
                $('#cdtrPickCity').typeahead('destroy');
                $('#cdtrPickCity').val("");
                iniPickCity('#cdtrPickCity');
            }
            break;
        case 'trDropLoc':
            {
                $('#TrSrchRegion').val('H:' + suggestion.id);
                $('#TrSrchCORDS').val(suggestion.latitude + ',' + suggestion.longitude);
            }
        case 'cdtrDropLoc':
            {
                var label = $(this).data('updatetrigger');
                $(label + " h2").html(suggestion.cityCode);
                $(label + " label").html(suggestion.name);
                toggleXSDropdown($(this).data('trgettrigger'));
                $('#TrSrchRegion').val('H:' + suggestion.id);
                $('#TrSrchCORDS').val(suggestion.latitude + ',' + suggestion.longitude);


            }
        case 'crPickCity':
            {
                if (!$('#dropDiffLoc').is(":checked")) {
                    $('#crFrom').val(suggestion.code);
                    $('#crTo').val(suggestion.code);
                } else {
                    $('#crFrom').val(suggestion.code);
                }
            }
        case 'crDropCity':
            {
                $('#crTo').val(suggestion.code);
            }
    }
    ev.target.value = suggestion.name;
    var fieldId = $(this).attr("id");
    if (fieldId == "trDropLoc" || fieldId == "trPickLoc") {
        $(this).typeahead('val', suggestion.name + ", " + suggestion.regionName + ", " + suggestion.countryName)
    } else if (fieldId == "HOnlyDest") {
        $(this).typeahead('val', suggestion.name + ", " + suggestion.countryName);
    } else {
        $(this).typeahead('val', suggestion.name);
    }


});

// $('.typeahead').bind('typeahead:active', function() {
//     $(this).val("");
//     $(this).typeahead('val', "");
//     $(".tt-menu").hide()
// })
$(".typeahead").click(function() {
    var typeaheadID = $(this).attr("id");
    //alert(typeaheadID);
    if (typeaheadID != "trPickCity") {
        $(this).val("");
        $(this).typeahead('val', "");
        $(".tt-menu").hide()
    }

});
$(function() {
    $("body").on("click", ".tt-footer-btn", function() {
        $(this).closest(".tt-menu").hide();
        $(this).closest(".tt-input").blur();
    })
})