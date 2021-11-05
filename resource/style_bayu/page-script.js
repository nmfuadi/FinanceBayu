var crrVal;
var CurrOPtext = "";
$(document).ready(function() {
    crrVal = localStorage.getItem("currencyval");
    //sessionStorage.setItem('countryLangChanged', 'false');

    if (crrVal == " " || crrVal == null) {
        crrVal = "IDR";
    }
    var getIPFun = ipLookUp();
    var getIP = getIPFun.country_code,
        siteEdition;
    localStorage.setItem("countryip", getIP);
    if (!localStorage.getItem("siteval")) {
        if (getIP == 'ID') {
            siteEdition = "en";
            crrVal = "IDR";
        } else {
            siteEdition = "en";
            crrVal = "IDR";
        }
        localStorage.setItem("siteval", siteEdition);
    } else {
        siteEdition = localStorage.getItem("siteval");
    }

    //LangRedirect(siteEdition);
    //getCurConversion(crrVal);
    $("input[name='Currency']").val(crrVal);
    localStorage.setItem("currencyval", crrVal);
    $("#currencySel").html(crrVal + " <i class='icon-angle-down'></i>");
    updateformcurrency(crrVal);
    if (crrVal == "IDR") {
        $(".myrpoints").hide();
    } else {
        $(".myrpoints").show();
    }
    $(".convert-currency a").click(function() {
        $(".convert-currency a").parent("li").removeClass("active");
        $(this).parent("li").addClass("active");
        var selectParent = $(this).parent("li").parent().attr("data-target");
        var currentCurrency = "";
        var currencyType = $(this).attr("data-value").toString();
        var CurrText = $(this).text();
        localStorage.setItem("currencyval", currencyType);
        $(selectParent).html(CurrText + " <i class='icon-angle-down'></i>");
        $("input[name='Currency']").val(currencyType);
        updateformcurrency(currencyType);
        //getCurConversion(currencyType);
        updateLink();
        if (currencyType == "IDR") {
            $(".myrpoints").hide();
        } else {
            $(".myrpoints").show();
        }
    });
    updateLink();
    updateLink1();

    function updateLink1() {
        $(".dyn-link1").each(function() {
            var cd = new Date();
            var mg = parseInt($(this).attr("data-startdate"));
            var NaNa = isNaN(mg);
            if (mg !== undefined && mg !== "" && !NaNa) {
                cd = new Date().addDays(mg);
            }
            var pd = parseInt($(this).attr("data-package"));
            var lu = $(this).attr("href");
            var sd = cd;
            var ed = sd.addDays(pd);
            sd = moment(sd).format("DD/MM/YYYY"); //formatDate(new Date(sd));
            ed = moment(ed).format("DD/MM/YYYY"); //formatDate(new Date(ed));
            crrVal = localStorage.getItem("currencyval")
            var d = 'DepartureDate';
            var r = 'ReturnDate';
            var cr = 'Currency';
            var du = updateQueryStringParameter(lu, d, sd);
            var ru = updateQueryStringParameter(du, r, ed);
            var cu = updateQueryStringParameter(ru, cr, crrVal);
            $(this).attr("href", cu);
        });
    }

    /*$(".dyn-link1").on("click", function() {

    // clevertap Tracking event
    var _this = $(this);
    var _closestSection = _this.closest("section");

    if (typeof clevertap === 'object') {
    //Modal onclick button event with properties 
    clevertap.event.push("H_Content_Clicked", {
    "ContentSection": _closestSection.find("h3.text-red").text(),
    "CardTitle": _this.find(".caption h4").text(),
    "Page": window.location.href
    });
    }
    });*/

});

function checksiteEdition(siteval) {
    $(".preloader").fadeOut();
}
// $(window).load(function() {
//     $(".preloader").fadeOut();
// });


function updateQueryStringParameter(uri, key, value) {
    var re = new RegExp("([?|&])" + key + "=.*?(&|#|$)", "i");
    if (uri.match(re)) {
        return uri.replace(re, '$1' + key + "=" + value + '$2');
    } else {
        var hash = '';
        if (uri.indexOf('#') !== -1) {
            hash = uri.replace(/.*#/, '#');
            uri = uri.replace(/#.*/, '');
        }
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        return uri + separator + key + "=" + value + hash;
    }
}

function updateLink() {
    $(".dyn-link").each(function() {
        var cd = new Date();
        //var mg = parseInt($(this).attr("data-startdate"));
        //var NaNa = isNaN(mg);
        //if(mg !== undefined && mg !== "" && !NaNa)
        //{
        //	cd = new Date().addDays(mg);
        //}
        var pd = parseInt($(this).attr("data-package"));
        var lu = $(this).attr("href");
        //var sd = cd;
        var sd = cd.addDays(1); //add manually
        var ed = sd.addDays(pd);
        sd = $.datepicker.formatDate("yy-mm-dd", new Date(sd));
        ed = $.datepicker.formatDate("yy-mm-dd", new Date(ed));
        crrVal = localStorage.getItem("currencyval")
        var d = 'DepartureDate';
        var r = 'ReturnDate';
        var cr = 'Currency';
        var du = updateQueryStringParameter(lu, d, sd);
        var ru = updateQueryStringParameter(du, r, ed);
        var cu = updateQueryStringParameter(ru, cr, crrVal);
        $(this).attr("href", cu);
    });
}

function updateformcurrency(getcrval) {
    $("input[name='Currency']").val(getcrval);
    $("input[name='Currency']").attr("data-value", getcrval);
}

function updatelangcurrency(getcrval) {
    $('#currency-slt .convert-currency li').removeClass("active");
    $('#currency-slt .convert-currency li').each(function() {
        var Fcurr = $(this).find("a").attr("data-value");
        if (Fcurr == getcrval) {
            $(this).addClass("active");
            var lngCrrtxt = $(this).find("a").text();
            $("#currencySel").html(lngCrrtxt + "<span class='icon im-angle-down'></span>");
        }
    })
}

//function getCurConversion(currencyType) {
//    var basecrr = "IDR";
//    //if (basecrr != currencyType) {
//    $(".prcr").text(currencyType);
//    getRate(basecrr, currencyType)
//        //}
//}

/*function getRate(from, to) {
    $.getJSON(domain + "api/currency-conversion/" + from + "/" + to, function(data) {
        parseExchangeRate(data);
    });
}
*/

function parseExchangeRate(data) {
    //var name = data.query.results.row.name;
    //var rate = parseFloat(data.query.results.row.rate, 10);
    if (data) {
        updateLink();
        var rate = parseFloat(data.conversionRate, 10);
        //var getcurAmt =  amount * rate;
        $(".currency-value").each(function() {
            var baseCurrency = $(this).attr("data-value").trim(); // should be IDR
            $(this).text(Math.round(baseCurrency * rate));
        });
    }
}


$(".currency-value").each(function() {
    var GetCurrtext = $(this).text();
    var EquPoints = GetCurrtext * 500;
    $(this).closest(".thumbnail").find(".myrpoints span").html(EquPoints);
    //$(".hotdeals .thumbnail").find(".myrpoints span").html(EquPoints);
});
// var GetCurrtext = $(".hotdeals .thumbnail").closest(".currency-value").text();
// var EquPoints = GetCurrtext * 500;
//$(".myrpoints span").html(EquPoints);
$("#language-slt li").click(function() {
    //$("#language-slt ul li").removeClass("active");
    var langId = $(this).attr("data-value");
    var countryip = localStorage.getItem('countryip'),
        curSiteEdition;
    $(this).addClass("active");
    console.log(langId);
    if (langId == "id") {
        curSiteEdition = "id";
    } else {
        curSiteEdition = "en";
    }
    localStorage.setItem("siteval", curSiteEdition);
    window.location.href = "/" + curSiteEdition;
    $("#language-slt").find(".dropdown-toggle").html("<span>" + $(this).find("a").text() + "</span> <span class='icon icon-angle-down'></span>");
});

/*---ipredirection---*/
// function ipLookUp() {
//     var countryData = "";

//     $.ajax({
//         url: 'http://ip-api.com/json',
//         global: false,
//         type: 'POST',
//         data: {},
//         async: false, //blocks window close
//         success: function(response) {
//             countryData = response;
//         }
//     });
//     if (countryData) {
//         return countryData;
//     }

// }
function ipLookUp() {
    var countryData = jQuery.ajax({
        url: 'https://freegeoip.app/json/',
        type: 'GET',
        async: false, //blocks window close
        dataType: 'json',
        success: function(response) {
            // example where I update content on the page.
            return response;
        }
    });

    if (countryData.responseJSON) {
        return countryData.responseJSON;
    }

};
// ipLookUp();

function LangRedirect(GetLang) {
    //console.log('GetLang', GetLang)
    var lang = GetLang;
    var locUrl = window.location;
    var domain = (window.location.host).toString();
    //locUrl.toString().lastIndexOf(domain);
    var lastIndex = locUrl.toString().lastIndexOf(domain) + domain.length + 1;
    //var lastIndex = locUrl.toString().lastIndexOf("/");
    var curLang = locUrl.toString().substring(lastIndex, lastIndex + 2);
    var pageUrl = locUrl.toString().substring(lastIndex + 2);

    var frgUrl = locUrl.toString().substr(0, lastIndex)
    var frgUrl1 = locUrl.toString().substr(lastIndex);
    var lastString = frgUrl1.substr(frgUrl1.length - 1, frgUrl1.length);
    var newUrl = "/" + lang + pageUrl; //frgUrl
    if (GetLang !== curLang) {
        javascript: window.location = newUrl;
    }
}

//Preloader Starts
$(window).on('load', function() {
    $(".preloader").fadeOut();
});