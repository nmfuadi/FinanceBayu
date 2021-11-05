  var curPageUrl = document.URL;
  var paramId = curPageUrl.split("#");
  var includeInfant = false;

  if (paramId[1] == "success") {
      $(".notification-bar").addClass("notify-success");
      setTimeout(function() {
          $(".notification-bar").removeClass("notify-success")
      }, 5000);
  }
  $(".close-notify").click(function() {
      $(".notification-bar").removeClass("notify-success");
  });


  /*oneway roundtrip script*/
  $(".trip-opt").click(function() {
      var target = $(this).attr("data-target");
      var parent = $(this).attr("for");
      $(".radio-group label").removeClass("checked");
      if (parent == "roundTrip") {
          $(target).prop("disabled", false).removeClass("disabled").attr("data-validation", "required");
          $(this).addClass("checked");
      } else {
          $(target).prop("disabled", true).addClass("disabled").attr("data-validation", "");
          $(this).addClass("checked");
      }
  });
  /*oneway roundtrip script ends*/

  /*Add Persons Drop down*/
  $(document).on("click", ".btn-text-group .btn", function() {
      var dataRef = $(this).attr("data-ref")
      $(".btn-text-group .btn").removeClass("checked");
      $(this).addClass("checked");
      $("#bookingRef").val("");
      if (dataRef === "bookingReference") {
          $("#bookingRef").attr("placeholder", "Booking Reference (PNR)").attr("maxlength", "6");
          $("div[data-ref='class-change']").removeClass("clm2").addClass("clm1");
          $("div[data-ref='remove-class']").addClass("hide");
      } else if (dataRef === "malindoMiles") {
          $("#bookingRef").attr("placeholder", "Malindo Miles Number").attr("maxlength", "15");
          $("div[data-ref='class-change']").removeClass("clm1").addClass("clm2");
          $("div[data-ref='remove-class']").removeClass("hide");
      }
  });

  var triggerId = "";
  $(".addChildage").change(function() {
      var curRoom = $(this).attr("data-ref");
      var noOfChild = $(this).val();
      if (noOfChild > 0) {
          $(triggerId + " " + curRoom + "Childage").removeClass("hide");
          $(curRoom + " .childAge").addClass("hide");
          for (i = 1; i <= noOfChild; i++) {
              $(triggerId + " " + curRoom + " .child" + i).removeClass("hide");
          }
      } else {
          $(triggerId + " " + curRoom + "Childage, " + curRoom + " .childAge").addClass("hide");
      }
  });


  var langId = $(".add-persons").attr("data-lang");
  $(".add-rooms").click(function() {
      var curRoom = $(this).attr("data-rooms");
      var rooms = parseInt(curRoom);
      var maxRooms = parseInt($(this).attr("data-maxrooms"));
      if (rooms > 1 && rooms < maxRooms) {
          $(triggerId + " .remove-room").addClass("hide");
          $(this).attr("data-rooms", rooms + 1);
          $(triggerId + " .room" + rooms).removeClass("hide");
          $(triggerId + " .room" + rooms + " .remove-room").removeClass("hide");
      } else if (rooms >= maxRooms) {
          $(triggerId + " .remove-room").addClass("hide");
          $(triggerId + " .room" + rooms).removeClass("hide");
          $(this).attr("data-rooms", rooms + 1);
          $(this).addClass("hide");
          $(triggerId + " .room" + rooms + " .remove-room").removeClass("hide");
      }
      countRoomPersons(triggerId, langId)
  });
  $(".remove-room").click(function() {
      var curRoom = $(this).attr("data-ref");
      var previousRoom = $(this).attr("data-prevroom");
      var btnRoom = parseInt($(triggerId + " .add-rooms").attr("data-rooms"));

      $(curRoom).addClass("hide");
      $(triggerId + " .add-rooms").removeClass("hide");
      $(triggerId + " .add-rooms").attr("data-rooms", btnRoom - 1);
      $(".room" + previousRoom + " .remove-room").removeClass("hide");
      countRoomPersons(triggerId, langId);
  });

  $(".add-persons").click(function() {
      triggerId = $(this).attr("data-trigger");
      $(triggerId).toggleClass("hide");
  });
  $(".persons select[data-field]").change(function() {
      langId = $(".add-persons").attr("data-lang");
      countRoomPersons("." + roomRef, langId);
  });
  $(".label-input input[data-field]").change(function() {
      langId = $(".add-persons").attr("data-lang");
      countRoomPersons(triggerId, langId);
  });
  $(".close-dropdown").click(function() {
      var target = $(this).attr("data-target");
      //  $(target).removeClass("show");
      $(target).addClass("hide");
      $(this).closest(".custom-dropdown").removeClass("show");
  });

  /*===============*/
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
      //var HGetCurrRooms = $("#HpersonDropdown .add-rooms").attr("data-rooms") - 1;
      var GetTargetID = $(this).closest(".custom-dropdown").attr("id");
var GetCurrRooms = $(this).closest(".room-container");
      if (GetTargetID == "HpersonDropdown" || GetTargetID == "MHpersonDropdown") {
          var HGetCurrRooms = $(this).closest(".room-container");
          var HadultVal = parseInt($(HGetCurrRooms).find(".adult-count").val());
          var HchildVal = parseInt($(HGetCurrRooms).find(".child-count").val());
          var HTotalAduChild = HadultVal + HchildVal;
          var SetHChildmax = 9 - HadultVal;
          $(HGetCurrRooms).find(".child-count").attr("max", SetHChildmax);
          $(HGetCurrRooms).find(".infant").attr("max", HadultVal);
          if (HTotalAduChild >= 9) {
              setTimeout(function() {
                  $(HGetCurrRooms).find(".adult-count").closest('.input-group').find(".btn-increment").prop('disabled', true);
                  $(HGetCurrRooms).find(".child-count").closest('.input-group').find(".btn-increment").prop('disabled', true);
              }, 0)
          } else {
              setTimeout(function() {
                  $(HGetCurrRooms).find(".adult-count").closest('.input-group').find(".btn-increment").prop('disabled', false);
                  $(HGetCurrRooms).find(".child-count").closest('.input-group').find(".btn-increment").prop('disabled', false);
              }, 0)
          }
      }
	  if (GetTargetID == "FHpersonDropdown" || GetTargetID == "MFHpersonDropdown") {

              var FHadultVal = parseInt($(GetCurrRooms).find(".adult-count").val());
              var FHchildVal = parseInt($(GetCurrRooms).find(".child-count").val());
              var FHTotalAduChild = FHadultVal + FHchildVal;
              var SetFHChildmax = 15 - FHadultVal;
              // $(GetCurrRooms).find(".child-count").attr("max", SetFHChildmax);
              $(GetCurrRooms).find(".infant").attr("max", FHadultVal);
              $(".adult-count").closest('.input-group').find(".btn-increment").prop('disabled', false);
              $(".child-count").closest('.input-group').find(".btn-increment").prop('disabled', false);
              //$("#FHform .custom-dropdown .add-rooms").show();
              //   if (FHTotalAduChild >= 5) {
              //       setTimeout(function() {
              //           $(GetCurrRooms).find(".adult-count").closest('.input-group').find(".btn-increment").prop('disabled', true);
              //           $(GetCurrRooms).find(".child-count").closest('.input-group').find(".btn-increment").prop('disabled', true);
              //       }, 0)
              //       $(Addroombtn).hide();
              //   } else {
              //       setTimeout(function() {
              //           $(GetCurrRooms).find(".adult-count").closest('.input-group').find(".btn-increment").prop('disabled', false);
              //           $(GetCurrRooms).find(".child-count").closest('.input-group').find(".btn-increment").prop('disabled', false);
              //       }, 0)
              //       $(Addroombtn).show();
              //   }
          }
          if (GetTargetID == "FpersonDropdown") {
              var FadultVal = parseInt($(GetCurrRooms).find(".adult-count").val());
              if (FadultVal <= 3) {
                  $(GetCurrRooms).find(".infant").attr("max", FadultVal);
              }
          }
  })

  /*===============*/

  function countRoomPersons(target, lang) {
      var adultCount = 0;
      var childCount = 0;
      var infantCount = 0;
      var getformId = $(target).closest("form").attr('id');
      $("#" + getformId + " " + target + " .persons select[data-field]," + "#" + getformId + " " + target + " .room-container:not('.hide') .label-input input[data-field]").each(function() {

          var personType = $(this).attr("data-field");

          if (personType.toLowerCase() == 'adult') {
              adultCount += parseInt($(this).val());
          } else if (personType.toLowerCase() == 'child') {
              childCount += parseInt($(this).val());
          } else if (personType.toLowerCase() == 'infant' && includeInfant) {
              infantCount += parseInt($(this).val());
          }
      });

      var noOfRooms, roomField;
      if (target === ".fh_rooms") {
          //var getForm = $(target).closest("form").attr("id");
          noOfRooms = $(target + " .roomSel").val();
          //roomField = $(target+" .roomSel").attr("data-field");
      } else {
          noOfRooms = parseInt($(target + " .add-rooms").attr("data-rooms")) - 1;
          roomField = $(target + " .add-rooms").attr("data-field");
      }
      var lang = $("body").attr("data-culture");
      var totalRooms = noOfRooms;
      if (lang == "id-ID") {
          switch (target) {
              case "#tourpersonDropdown":
              case "#transferpersonDropdown":
                  noOfRooms = "";
                  break;
              default:
                  if (noOfRooms > 1) {
                      noOfRooms = noOfRooms + " Kamar,"
                  } else {
                      noOfRooms = noOfRooms + " Kamar,"
                  }
                  break;
          }
      } else if (lang == "en-US" || "en-HK" || "en-AU" || "en-CA" || "en-NZ") {
          switch (target) {
              case "#tourpersonDropdown":
              case "#transferpersonDropdown":
                  noOfRooms = "";
                  break;
              default:
                  if (noOfRooms > 1) {
                      noOfRooms = noOfRooms + " Room(s),"
                  } else {
                      noOfRooms = noOfRooms + " Room(s),"
                  }
                  break;
          }
      }

      var totalPerson = adultCount + childCount + infantCount;
      if (target != "#HpersonDropdown") {
          totalPerson = adultCount + childCount
      }


      var personsExceeds = false;
      var paxTextEn = " Traveler(s)";
      var paxTextCt = " 位旅客";
      var paxTextId = " Turis";
      //   if (totalPerson > 9) {
      //       if (target === "#transferpersonDropdown" || target === "MFHpersonDropdown" || target === "#MHpersonDropdown" || target === "#transferpersonDropdown") {
      //           $('#groupBook').modal("show");
      //       }
      //       personsExceeds = true;
      //   }
      //   if (totalPerson > 15) {
      //       if (target === "#FHpersonDropdown") {
      //           $('#groupBook').modal("show");
      //       }

      //       personsExceeds = true;
      //   }

      //   if (target === "#FHpersonDropdown" || target === "#FHpersonDropdown2" || target === "#FTpersonDropdown") {
      //       paxTextEn = " Passenger";
      //   }
      //   if (lang === "zh-CN") {
      //       if (totalPerson > 1) {
      //           totalPerson = totalPerson + paxTextCs;
      //       } else {
      //           totalPerson = totalPerson + paxTextCs;
      //       }
      //   } else {
      //       if (totalPerson > 1) {
      //           totalPerson = totalPerson + paxTextEn + "s";
      //       } else {
      //           totalPerson = totalPerson + paxTextEn;
      //       }
      //   }
      // if (totalPerson > 9) {
      //          if (target === "#FHpersonDropdown" || target === "#MFHpersonDropdown") {
      //              $('#groupBook').modal("show");
      //          }
      //          personsExceeds = true;
      //      }


      if (totalPerson >= 9) {

          if (target === "#FHpersonDropdown" || target === "#MFHpersonDropdown" || target === "#FpersonDropdown" || target === "#MFpersonDropdown") {
              $("#" + getformId + " .custom-dropdown .add-rooms").hide();
              //$('#groupBook').modal("show");
              $("#" + getformId + " .custom-dropdown .pax-val").removeClass("hide");
              setTimeout(function() {
                  $("#" + getformId + " .custom-dropdown").find(".adult-count").closest('.input-group').find(".btn-increment").prop('disabled', true);
                  $("#" + getformId + " .custom-dropdown").find(".child-count").closest('.input-group').find(".btn-increment").prop('disabled', true);

              })
          }

          personsExceeds = true;
      } else {
          if (target != "#FHpersonDropdown" || target != "#MFHpersonDropdown") {
              $("#" + getformId + " .custom-dropdown .add-rooms").show();
              $("#" + getformId + " .custom-dropdown .pax-val").addClass("hide");
              $("#" + getformId + " .custom-dropdown").find(".adult-count").closest('.input-group').find(".btn-increment").prop('disabled', false);
              $("#" + getformId + " .custom-dropdown").find(".child-count").closest('.input-group').find(".btn-increment").prop('disabled', false);
          }
      }

      // if (totalPerson >= 9) {
      //          if (target === "#FpersonDropdown" || target === "#transferpersonDropdown") {
      //              $("#" + getformId + " .custom-dropdown .pax-val").removeClass("hide")
      //          }
      //      } else {
      //          $("#" + getformId + " .custom-dropdown .pax-val").addClass("hide");
      //      }
      //	  


      //if (target === "#FHpersonDropdown" || target === "#FHpersonDropdown2" || target === "#FTpersonDropdown") {
      if (target === "#FpersonDropdown" || target === "#MFpersonDropdown" || target === "#FHpersonDropdown" || target === "#FHpersonDropdown2" || target === "#FTpersonDropdown" || target === "#HpersonDropdown" || target === "#tourpersonDropdown" || target === "#transferpersonDropdown" || target === "#MFHpersonDropdown") {
          paxTextEn = " Traveler(s)";
      }
      if (lang === "id-ID") {
          if (totalPerson > 1) {
              totalPerson = totalPerson + paxTextId;
          } else {
              totalPerson = totalPerson + paxTextId;
          }
      } else {
          if (totalPerson > 1) {
              //totalPerson = totalPerson + paxTextEn + "(s)";
              totalPerson = totalPerson + paxTextEn;
          } else {
              totalPerson = totalPerson + paxTextEn;
          }
      }

      $(roomField).val(totalRooms);
      if (totalRooms > 0) {
          $(".add-persons[data-trigger='" + target + "']").val(noOfRooms + " " + totalPerson);
      } else {
          $(".add-persons[data-trigger='" + target + "']").val(totalPerson);
      }

      aCount = adultCount;
      cCount = childCount;
      nRooms = parseInt(noOfRooms);
  }
  /*Add Persons Drop down ends*/

  /*Adult Infant script*/
  var adultCount;
  $(document).on("change", ".adult-count", function() {
      adultCount = $(this).val();
      var infantRef = $(this).attr("data-ref");
      $(infantRef).html("")
      if (adultCount > 2)
          adultCount = 2;
      for (i = 0; i <= adultCount; i++) {
          $(infantRef).append("<option value=" + i + ">" + i + "</option>")
      }
      countRoomPersons(triggerId, langId);
  });
  /*Adult Infant script ends*/

  /*Persons Drop down autohide*/
  $(document).click(function(event) {
      if (!$(event.target).closest('.custom-dropdown').length && !$(event.target).closest('.add-persons').length) {
          if ($('.custom-dropdown').is(":visible")) {
              $('.custom-dropdown').addClass("hide");
          }
      }
  });
  /*Persons Drop down autohide ends*/


  /*Main Menu Page selection script*/
  $(".navi .navbar-nav ul>li").each(function() {
      var activePage = $(this).hasClass("active");
      if (activePage) {
          $(this).parent().parent("li").addClass("active");
      }
  });
  /*Main Menu Page selection script ends*/

  /*Collapes Expand script*/
  $(".collapseClick").click(function() {
      var status = $(this).attr("data-status");
      if (status == "on") {
          $(this).text('Collapse');
          $(this).attr("data-status", "off").addClass("open");
      } else {
          $(this).text('Expand');
          $(this).attr("data-status", "on").removeClass("open");
      }
  });
  /*Collapes Expand script ends*/

  $(".collapseTogle").click(function() {
      var status = $(this).attr("data-status");
      var target = $(this).attr("data-target");
      var targetId = $(target).attr("id");
      var CurElt = $(this);
      $(target).each(function() {
          if (status == "on") {
              CurElt.text('Collapse all');
              CurElt.attr("data-status", "off").addClass("open");
              $(this).addClass("in").attr("aria-expanded", true).removeAttr("style");
              $("[href='#" + targetId + "']").removeClass("collapsed").attr("aria-expanded", true);
          } else {
              CurElt.text('Expand all');
              CurElt.attr("data-status", "on").removeClass("open");
              $(this).removeClass("in").attr("aria-expanded", false).css("height", "0px");
              $("[href='#" + targetId + "']").addClass("collapsed").attr("aria-expanded", false);
          }
      });

  });
  $("[data-toggle='collapse']").click(function() {
      var target = $(this).hasClass("collapseTogle");
      if (!target) {
          $(".collapseTogle").text('Expand all');
          $(".collapseTogle").attr("data-status", "on").removeClass("open");
      }
  });

  /*Highlight text on Search script*/
  $('.text-search').bind('keyup change', function(ev) {
      var searchTerm = $(this).val();
      $('.find-text').removeHighlight();
      if (searchTerm) {
          $('.find-text').highlight(searchTerm);
      }
  });
  /*Highlight text on Search script ends*/

  /*Popup Booking form script*/
  $(".updateForm").click(function() {
      var depcity = $(this).attr("data-depcity");
      var depcode = $(this).attr("data-depcode");
      var arrcity = $(this).attr("data-arrcity");
      var arrcode = $(this).attr("data-arrcode");
      var target = $(this).attr("data-target");
      //$(target+" #departCity, "+target+" #arrivalCity").removeAttr("data-ref");
      $(target + " #departCity").val(depcity + " (" + depcode + ")").next("input[type='hidden']").val(depcode);
      $(target + " #arrivalCity").val(arrcity + " (" + arrcode + ")").next("input[type='hidden']").val(arrcode);
      //updateArrivalList("#arrivalCity", depcode);
  });
  /*Popup Booking form script ends*/

  /*Smooth page Scroll script*/
  $('.smooth-scroll').click(function() {
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
          if (target.length) {
              $('html,body').animate({
                  scrollTop: target.offset().top
              }, 500);
              return false;
          }
      }
  });
  /*Smooth page Scroll script ends*/

  /*Escape Key press event script*/
  $(document).keyup(function(e) {
      if (e.keyCode == 27) {
          $('.modal').modal('hide');
      }
  });
  /*Escape Key press event script ends*/
  //var test = $('.main-menu').offset().top;
  //console.log(test)
  // browser window scroll (in pixels) after which the "back to top" link is shown
  var offset = 300,
      //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
      offset_opacity = 1200,
      //duration of the top scrolling animation (in ms)
      scroll_top_duration = 700,
      bodyOffset = 10,
      //formOffset = 79;
      homeTabOffset = 350;
  $header_to_top = $('.scroll-header, .inner-menu');
  $back_to_top = $('.cd-top');
  //$form_to_top = $('.floating');
  $home_tabs = $('.home-tabs');
  //grab the "back to top" link

  //hide or show the "back to top" link
  $(window).scroll(function() {
      ($(this).scrollTop() > offset) ? $back_to_top.addClass('cd-is-visible'): $back_to_top.removeClass('cd-is-visible cd-fade-out');
      ($(this).scrollTop() > bodyOffset) ? $header_to_top.addClass('fixed'): $header_to_top.removeClass('fixed');
      // ( $(this).scrollTop() > formOffset ) ? $form_to_top.addClass('fixed') : $form_to_top.removeClass('fixed');
      //console.log($(this).scrollTop())
      if ($(this).scrollTop() > homeTabOffset) {
          $home_tabs.addClass("fixed")
      } else {
          $home_tabs.removeClass("fixed")
      }
      //bodyOffset = $("body").offset();
      // console.log(bodyOffset)
  });

  //smooth scroll to top
  $back_to_top.on('click', function(event) {
      event.preventDefault();
      $('body,html').animate({
          scrollTop: 0,
      }, scroll_top_duration);
  });

  /* Menu highlight Script */


  /* Menu highlight Script */



  $(".bookingtab .nav-tabs li a[data-toggle='tab']").click(function() {
      var tabId = $(this).attr("href");
      var _bookingTab = $("#nav-tabs li");
      DevWidth = $(window).width();
      _bookingTab.removeClass("active");
      _bookingTab.each(function() {
          var getTabId = $(this).find("a[data-toggle='tab']").attr("href");
          if (getTabId == tabId) {
              $(this).addClass("active")
          }
      });
  });
  $(document.body).on("click", ".bookingtab a[data-toggle]", function(event) {
	  if ($(window).width() > 768) {
      location.hash = this.getAttribute("href");
	   
      gotopanel();
	   }
  });
    if ($(window).width() > 768) {
  if (location.hash) {
	 
      gotopanel(location.hash);
	   }
  }

  function gotopanel(getHashVal) {
	  if ($(window).width() > 768) {
      $('html, body').animate({
          scrollTop: $(".bookingtab").offset().top
      }, 800);
	  }
      if (getHashVal) {
          $('a[href="' + getHashVal + '"]').tab('show');
      }
  }

  $(window).on('popstate', function() {
      var anchor = location.hash || $(".bookingtab a[data-toggle=tab]").first().attr("href");
      $('a[href="' + anchor + '"]:not(.hashref)').tab('show');
  });
  $(window).on('hashchange', function() {
      var anchor = location.hash || $(".bookingtab a[data-toggle=tab]").first().attr("href");
      $('a[href="' + anchor + '"]:not(.hashref)').tab('show');
	  if ($(window).width() > 768) {
      $('html, body').animate({
          scrollTop: $(".bookingtab").offset().top
      }, 800);
	  }
  });
  var _treding = $(".trending-section");
  var _hotelWeLv = $(".hotelwelove-section");
  var _comboFD_HD = $(".destination-deals-section");
  var _featrdDesti = $(".featureddestinations");
  var _hotelDeals = $(".hotdeals");
//  if (DevWidth < 768) {
//      _comboFD_HD.hide();
//      _treding.css("display", "inline-block");
//  }

  function updatePageData(getTargetID) {
      _treding.hide();
      _hotelWeLv.hide();
      _featrdDesti.hide();
      _comboFD_HD.hide();
      _hotelDeals.hide();
      //   $('.slick-carousel').slick('slickGoTo', 1);
      //   $('.trending-section .row').slick('slickGoTo', 1);
      if (getTargetID == "#flight") {
          _treding.css("display", "inline-block");
      } else if (getTargetID == "#hotel") {
          _hotelWeLv.css("display", "inline-block");
      } else if (getTargetID == "#flighthotel") {
          _comboFD_HD.css("display", "inline-block");
          _featrdDesti.css("display", "inline-block");
      } else if (getTargetID == "#sightseeing") {
          _comboFD_HD.css("display", "inline-block");
          _hotelDeals.css("display", "inline-block");
      } else if (getTargetID == "#transfers") {
          _comboFD_HD.css("display", "inline-block");
          _hotelDeals.css("display", "inline-block");
      }
  }
  /* Menu highlight Script ends*/

  /*get query string parameter*/

  var departCity = GetURLParameter("dcity");
  var arrCity = GetURLParameter("acity");
  var departCode = GetURLParameter("dcode");
  var arrCode = GetURLParameter("acode");
  var updateCityExist = $(".update-city").length;
  if (updateCityExist && (departCity != "" && departCity != undefined)) {
      $(".update-city input#departCity").val(departCity.replace("%20", " ") + " (" + departCode + ")").next("input[type='hidden']").val(departCode);
      $(".update-city input#arrivalCity").val(arrCity.replace("%20", " ") + " (" + arrCode + ")").next("input[type='hidden']").val(arrCode);
      updateArrivalList("#arrivalCity", departCode);
  }
  //console.log(departCity+" : "+arrCity)
  function GetURLParameter(sParam) {
      var sPageURL = window.location.search.substring(1);
      var sURLVariables = sPageURL.split('&');
      for (var i = 0; i < sURLVariables.length; i++) {
          var sParameterName = sURLVariables[i].split('=');
          if (sParameterName[0] == sParam) {
              return sParameterName[1];
          }
      }
  }
  /*get query string parameter ends*/
  //});

  function gotop() {
      "use strict";
      if (document.documentElement.clientWidth > 767 && $('.flight-modifysearch').length !== 1) {
          $("html,body").animate({
              scrollTop: $(".booking-form").offset().top - 0
          }, 'slow');
      }
  }

  //Adding a class to the body if modal is visible in the iphone
  if (/iPhone/i.test(navigator.userAgent)) {
      document.querySelector('body').classList.add('iphone');
  }

  //Get Language and Referrer when home page loads
  $(document).ready(function() {
      // event with properties
      var selectedLang = $("body").data("culture");
      if (typeof clevertap === 'object') {
          clevertap.event.push("H_Page_Loaded", {
              "Language": selectedLang,
              "Referrer": document.referrer
          });
      }
  });