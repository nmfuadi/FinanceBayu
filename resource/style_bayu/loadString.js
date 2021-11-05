var _html = $("html");
var _body = $("body");
//language switch
var pathname = window.location.pathname.split("/");
var filename = pathname[1];


//Get Culture code from body set to all the form
var langCode = _body.data("lang");

//Initialize all the string 
var dictionary;
dictionary = {
    "en-US": {
		"STRING_CONTACTDETAILS": "Contact Details",
		"STRING_NAME": "Name",
		"STRING_NATIONALITY": "Nationality",
		"STRING_HOLIDAYDETAILS": "Holiday Details",
		"STRING_DATEOFTRAVEL": "Date Of Travel",
		"STRING_ADULT": "Adult",
		"STRING_CHILD": "Child",
		"STRING_ADDITIONALREQ": "Additional Requirements",
        "STRING_ROUNDTRIP": "Round Trip",
        "STRING_ONEWAY": "One-way",
        "STRING_LEAVINGFROM": "Leaving from",
        "STRING_CITYORAIRPORT": "City or Airport",
        "STRING_GOINGTO": "Going to",
        "STRING_LEAVINGON": "Leaving on",
        "STRING_RETURNINGON": "Returning on",
        "STRING_TRAVELERS": "Travelers",
        "STRING_PASSENGERS": "Passengers",
        "STRING_PERSON": "Person",
        "STRING_ADULTS": "Adults",
        "STRING_AGES12": "Ages (12+)",
        "STRING_CHILDREN": "Children",
        "STRING_AGES2TO11": "Ages (2-11)",
        "STRING_1STCHILDAGE": "Child 1 age",
        "STRING_2NDCHILDAGE": "Child 2 age",
        "STRING_3RDCHILDAGE": "Child 3 age",
        "STRING_4THCHILDAGE": "Child 4 age",
        "STRING_5THCHILDAGE": "Child 5 age",
        "STRING_6THCHILDAGE": "Child 6 age",
        "STRING_7THCHILDAGE": "Child 7 age",
        "STRING_8THCHILDAGE": "Child 8 age",
        "STRING_9THCHILDAGE": "Child 9 age",
        "STRING_INFANT": "Infants",
        "STRING_AGES0TO2": "Ages (0-2)",
        "STRING_CLOSE": "Close",
        "STRING_CLASS": "Class",
        "STRING_REMOVE": "Remove",
        "CABIN_CLASS": "Cabin Class",
        "STRING_ECONOMYCLASS": "Economy Class",
        "STRING_BUSINESSCLASS": "Business Class",
        "STRING_FIRSTCLASS": "First Class",
        "STRING_PREMIUMCLASS": "Premium Class",
        "STRING_PREMIUMECONOMYCLASS": "Premium Economy Class",
        "STRING_FIND": "Find",
        "STRING_BOOKFROMOVERETC": "Book From Over 360,0000 Hotel Options",
        "STRING_WHEREAREYOUWANTTOSTAY": "Where are you want to stay?",
        "STRING_CHOOSEADESTINATIONETC": "Choose a destination, property name or address....",
        "STRING_CHECKIN": "Check-in",
        "STRING_CHECKOUT": "Check-out",
        "STRING_1STROOMPAX": "Room 1",
        "STRING_2NDROOMPAX": "Room 2",
        "STRING_3RDROOMPAX": "Room 3",
        "STRING_4THROOMPAX": "Room 4",
        "STRING_5THROOMPAX": "Room 5",
        "STRING_SEARCH": "Search",
        "STRING_BUNDLEFLIGHTPLUSHOTELSAVE": "Bundle Flight + Hotel & Save",
        "STRING_BOOKACTIVITIESANDSIGHTSSEING": "Book Activities & Sightseeing Anywhere",
        "STRING_WHEREAREYOUGOING": "Where are you going?",
        "STRING_CHOOSEACITY": "Choose a City",
        "STRING_STARTDATE": "Start Date",
        "STRING_ENDDATE": "End Date",
        "STRING_RETURN": "Return",
        "STRING_ONEWAYFROMAIRPORT": "One-way From Airport",
        "STRING_AIRPORTHOTEL": "Airport-Hotel",
        "STRING_ONEWAYTOAIRPORT": "One-way To Airport",
        "STRING_HOTELAIRPORT": "Hotel-Airport",
        "STRING_WHATAIRPORTDOYOUARRIVEAT": "What airport do you arrive at?",
        "STRING_ARRIVALAIRPORT": "Arrival Airport",
        "STRING_WHEREWOULDYOULIKETOBEDROPOFF": "Where would you like to be drop off?",
        "STRING_DROPOFFLOCATION": "Drop Off Location",
        "STRING_HOTELNAMELOCATION": "Hotel name / Location...",
        "STRING_WHEREWOULDYOULIKETOBEPICKEDUP": "Where would you like to be picked up?",
        "STRING_PICKUPLOCATION": "Pick Up Location",
        "STRING_FLIGHTARRIVE": "Flight Arrive",
        "STRING_DEPARTON": "Depart on",
        "STRING_ROOMANDPASSENGERS": "Rooms and Passengers",
        "STRING_DONE": "Done",
        "STRING_ADDMOREROOMS": "Add More Rooms",
        "STRING_HOTELFORPARTOFMYTRIP": "I only need a hotel for part of my trip",
        "STRING_MAXIMUM15PAX": "You can only select a maximum of 15 passengers per booking",
        mr: "Mr",
        mrs: "Mrs",
        child: "Child",
        lname: "Family Name",
        fname: "First Name & Middle Name",
        clubNo: "Fortune Wings Club No.",
        packagePrice: "Package Price",
        paxdob: "Date of Birth (for child aged under 12)",
        day: "Day",
        month: "Month",
        year: "Year"
    },
    "id-ID": {
		"STRING_CONTACTDETAILS": "Detail Kontak",
		"STRING_NAME": "Nama",
		"STRING_NATIONALITY": "Warga Negara",
		"STRING_HOLIDAYDETAILS": "Detail Liburan",
		"STRING_DATEOFTRAVEL": "Tanggal Keberangkatan",
		"STRING_ADULT": "Dewasa",
		"STRING_CHILD": "Anak-anak",
		"STRING_ADDITIONALREQ": "Keterangan Tambahan",
        "STRING_ROUNDTRIP": "Pulang pergi",
        "STRING_ONEWAY": "Satu arah",
        "STRING_LEAVINGFROM": "Pergi dari",
        "STRING_CITYORAIRPORT": "Kota atau Bandara",
        "STRING_GOINGTO": "Berangkat ke",
        "STRING_LEAVINGON": "Pergi pada tanggal",
        "STRING_RETURNINGON": "Kembali pada tanggal",
        "STRING_TRAVELERS": "Turis",
        "STRING_PASSENGERS": "Passengers",
        "STRING_PERSON": "Person",
        "STRING_ADULTS": "Dewasa",
        "STRING_AGES12": "Usia (12+)",
        "STRING_CHILDREN": "Anak",
        "STRING_AGES2TO11": "Usia (2-11)",
        "STRING_1STCHILDAGE": "Anak Usia 1 tahun",
        "STRING_2NDCHILDAGE": "Anak Usia 2 tahun",
        "STRING_3RDCHILDAGE": "Anak Usia 3 tahun",
        "STRING_4THCHILDAGE": "Anak Usia 4 tahun",
        "STRING_5THCHILDAGE": "Anak Usia 5 tahun",
        "STRING_6THCHILDAGE": "Anak Usia 6 tahun",
        "STRING_7THCHILDAGE": "Anak Usia 7 tahun",
        "STRING_8THCHILDAGE": "Anak Usia 8 tahun",
        "STRING_9THCHILDAGE": "Anak Usia 9 tahun",
        "STRING_INFANT": "Bayi",
        "STRING_AGES0TO2": "Umur (0-2)",
        "STRING_CLOSE": "Tutup",
        "STRING_CLASS": "Kelas",
        "STRING_REMOVE": "Hapus",
        "CABIN_CLASS": "Kelas kabin",
        "STRING_ECONOMYCLASS": "Kelas Ekonomi",
        "STRING_BUSINESSCLASS": "Kelas Bisnis",
        "STRING_FIRSTCLASS": "Kelas Pertama",
        "STRING_PREMIUMCLASS": "Kelas Premium",
        "STRING_PREMIUMECONOMYCLASS": "Premium Economy Class",
        "STRING_FIND": "Temukan",
        "STRING_BOOKFROMOVERETC": "Pesan lebih dari 360.000 hotel pilihan",
        "STRING_WHEREAREYOUWANTTOSTAY": "Dimana anda ingin tinggal ?",
        "STRING_CHOOSEADESTINATIONETC": "Pilih destinasi,nama dan alamat properti....",
        "STRING_CHECKIN": "Masuk",
        "STRING_CHECKOUT": "Keluar",
        "STRING_1STROOMPAX": "Kamar 1",
        "STRING_2NDROOMPAX": "Kamar 2",
        "STRING_3RDROOMPAX": "Kamar 3",
        "STRING_4THROOMPAX": "Kamar 4",
        "STRING_5THROOMPAX": "Kamar 5",
        "STRING_SEARCH": "Pencarian",
        "STRING_BUNDLEFLIGHTPLUSHOTELSAVE": "Paket Penerbangan + Hotel & Diskon",
        "STRING_BOOKACTIVITIESANDSIGHTSSEING": "Pesan Aktifitas & Tur Kemana Saja",
        "STRING_WHEREAREYOUGOING": "Kemana Anda akan pergi?",
        "STRING_CHOOSEACITY": "Pilih kota",
        "STRING_STARTDATE": "Mulai tanggal",
        "STRING_ENDDATE": "Berakhir tanggal",
        "STRING_RETURN": "Kembali",
        "STRING_ONEWAYFROMAIRPORT": "Satu arah dari bandara",
        "STRING_AIRPORTHOTEL": "Bandara-Hotel",
        "STRING_ONEWAYTOAIRPORT": "Satu arah menuju bandara",
        "STRING_HOTELAIRPORT": "Hotel-Bandara",
        "STRING_WHATAIRPORTDOYOUARRIVEAT": "Di bandara mana kamu datang?",
        "STRING_ARRIVALAIRPORT": "Bandara Kedatangan",
        "STRING_WHEREWOULDYOULIKETOBEDROPOFF": "Dimana Anda ingin diturunkan?",
        "STRING_DROPOFFLOCATION": "Lokasi Pengantaran",
        "STRING_HOTELNAMELOCATION": "Nama Hotel / lokasi...",
        "STRING_WHEREWOULDYOULIKETOBEPICKEDUP": "Dimana Lokasi Penjemputan yang anda inginkan?",
        "STRING_PICKUPLOCATION": "Lokasi Penjemputan",
        "STRING_FLIGHTARRIVE": "Kedatangan",
        "STRING_DEPARTON": "Keberangkatan",
        "STRING_ROOMANDPASSENGERS": "Kamar dan turis",
        "STRING_DONE": "Selesai",
        "STRING_ADDMOREROOMS": "Tambah kamar",
        "STRING_HOTELFORPARTOFMYTRIP": "Saya hanya membutuhkan hotel untuk perjalanan saya",
        "STRING_MAXIMUM15PAX": "You can only select a maximum of 15 passengers per booking",
        mr: "Mr",
        mrs: "Mrs",
        child: "Child",
        lname: "Family Name",
        fname: "First Name & Middle Name",
        clubNo: "Fortune Wings Club No.",
        packagePrice: "Package Price",
        paxdob: "Date of Birth (for child aged under 12)",
        day: "Day",
        month: "Month",
        year: "Year"
    },

    "en-MY": {},

};
dictionary["en-MY"] = dictionary["en-US"];
// Get lang code
var _body = $('body');
var language = _body.data('culture');
_body.find(".cultureCode").val(language);
// if no lang
if (language !== "en-US") {
    setString(dictionary[language]);
}

//Text Translating function
function setString(languageObj) {

    // Get translated text
    $("[data-translate]").text(function() {
        var _this = $(this);
        var key = _this.data("translate");
        // Returning translated string      
        if (languageObj.hasOwnProperty(key)) {
            return languageObj[key];
        }
    });
}

//Set language key
function setkey(keyString) {
    return dictionary[language][keyString];
}

//Load transslate string to placeholder
$("input[data-translate]").each(function() {
    var _thisPH = $(this);
    var key = _thisPH.data("translate");
    if (_thisPH.hasClass("translateText")) {
        _thisPH.prop("value", dictionary[language][key]);
    } else {
        _thisPH.prop("placeholder", dictionary[language][key]);
    }
});

//This select option will take the each value of select option and append to front 
$('select option[data-translate="STRING_YEARS"]').each(function(index, element) {
    var _thisSelect = $(this);
    _thisSelect.text(element.value + " " + element.text);
});



//Language string for calender
//Ui datepicker

$.datepicker.regional['id-ID'] = {
    closeText: "Tutup <i class='icon-cross'></i>",
    prevText: '&#x3c;mundur',
    nextText: 'maju&#x3e;',
    currentText: 'hari ini',
    monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'
    ],
    monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
        'Jul', 'Agus', 'Sep', 'Okt', 'Nop', 'Des'
    ],
    dayNames: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
    dayNamesShort: ['Min', 'Sen', 'Sel', 'Rab', 'kam', 'Jum', 'Sab'],
    dayNamesMin: ['Mg', 'Sn', 'Sl', 'Rb', 'Km', 'jm', 'Sb'],
    weekHeader: 'Mg',
    dateFormat: 'dd/mm/yy',
    firstDay: 0, // The first day of the week, Sun = 0, Mon = 1, ...
    isRTL: false, // True if right-to-left language, false if left-to-right
    showMonthAfterYear: false, // True if the year select precedes month, false for month then year
    yearSuffix: "", // Additional text to append to the year in the month headers
    calTitle: ""

};



$.datepicker.regional['en-US'] = {
    closeText: "Close <i class='icon-cross'></i>" // Display text for close link
};

// $.datepicker.regional['ar-AE'] = {
//     closeText: "Ø¥ØºÙ„Ø§Ù‚", // Display text for close link
//     prevText: "&#x3C;Ø§Ù„Ø³Ø§Ø¨Ù‚", // Display text for previous month link
//     nextText: "Ø§Ù„ØªØ§Ù„ÙŠ&#x3E;", // Display text for next month link
//     currentText: "Ø§Ù„ÙŠÙˆÙ…", // Display text for current month link
//     monthNames: ["ÙŠÙ†Ø§ÙŠØ±", "ÙØ¨Ø±Ø§ÙŠØ±", "Ù…Ø§Ø±Ø³", "Ø£Ø¨Ø±ÙŠÙ„", "Ù…Ø§ÙŠÙˆ", "ÙŠÙˆÙ†ÙŠÙˆ", "ÙŠÙˆÙ„ÙŠÙˆ", "Ø£ØºØ³Ø·Ø³", "Ø³Ø¨ØªÙ…Ø¨Ø±", "Ø£ÙƒØªÙˆØ¨Ø±", "Ù†ÙˆÙÙ…Ø¨Ø±", "Ø¯ÙŠØ³Ù…Ø¨Ø±"], // Names of months for drop-down and formatting
//     monthNamesShort: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"], // For formatting
//     dayNames: ["Ø§Ù„Ø£Ø­Ø¯", "Ø§Ù„Ø§Ø«Ù†ÙŠÙ†", "Ø§Ù„Ø«Ù„Ø§Ø«Ø§Ø¡", "Ø§Ù„Ø£Ø±Ø¨Ø¹Ø§Ø¡", "Ø§Ù„Ø®Ù…ÙŠØ³", "Ø§Ù„Ø¬Ù…Ø¹Ø©", "Ø§Ù„Ø³Ø¨Øª"], // For formatting
//     dayNamesShort: ["Ø£Ø­Ø¯", "Ø§Ø«Ù†ÙŠÙ†", "Ø«Ù„Ø§Ø«Ø§Ø¡", "Ø£Ø±Ø¨Ø¹Ø§Ø¡", "Ø®Ù…ÙŠØ³", "Ø¬Ù…Ø¹Ø©", "Ø³Ø¨Øª"], // For formatting
//     dayNamesMin: ["Ø­", "Ù†", "Ø«", "Ø±", "Ø®", "Ø¬", "Ø³"], // Column headings for days starting at Sunday
//     weekHeader: "Ø£Ø³Ø¨ÙˆØ¹", // Column header for week of the year
//     dateFormat: "yy-mm-dd", // See format options on parseDate
//     firstDay: 0, // The first day of the week, Sun = 0, Mon = 1, ...
//     isRTL: true, // True if right-to-left language, false if left-to-right
//     showMonthAfterYear: false, // True if the year select precedes month, false for month then year
//     yearSuffix: "", // Additional text to append to the year in the month headers
//     calTitle: "",
// };



/*-----------------Translate form END-----------------*/