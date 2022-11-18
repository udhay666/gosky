"use strict";
var pickup_info;
var codetype;
var pickup_codetype;
$(document).ready(function () {
  var departureDate = $("#transfer_dropoff_date");
  var departureTime = $("#transfer-to-timepicker");
  var arrivalDate = $("#transfer_pickup_date");
  var arrivalTime = $("#transfer-from-timepicker");

  var dropoff_name = $("input[name='dropoff_name']");


  //dropoff_name.attr("disabled", true);
  //dropoff_name.css("opacity", "0.5");


  departureDate.attr("disabled", true);
  departureDate.css("opacity", "0.5");
  departureTime.attr("disabled", true);
  departureTime.css("opacity", "0.5");
  if($('.switch input[type="checkbox"]').prop("checked") == true){
    dropoff_name.attr("disabled", false);
    dropoff_name.css("opacity", "1");

    departureDate.attr("disabled", false);
    departureDate.css("opacity", "1");

    departureTime.attr("disabled", false);
    departureTime.css("opacity", "1");
  }
  $('.switch input[type="checkbox"]').click(function () {
    if ($(this).prop("checked") == true) {
      if (pickup_codetype == 'AIR') {
        console.log("**"+pickup_codetype);
        departureDate.attr("disabled", false);
        departureDate.css("opacity", "1");
        departureTime.attr("disabled", false);
        departureTime.css("opacity", "1");
      } else {
        console.log(pickup_codetype);
        arrivalDate.attr("disabled", false);
        arrivalDate.css("opacity", "1");
        arrivalTime.attr("disabled", false);
        arrivalTime.css("opacity", "1");
      }

    } else if ($(this).prop("checked") == false) {
      if (pickup_codetype != 'AIR') {
        arrivalDate.attr("disabled", true);
        arrivalDate.css("opacity", "0.5");
        arrivalTime.attr("disabled", true);
        arrivalTime.css("opacity", "0.5");
      } else {
        departureDate.attr("disabled", true);
        departureDate.css("opacity", "0.5");
        departureTime.attr("disabled", true);
        departureTime.css("opacity", "0.5");
      }
    }
  });


  //Transfer Autocomplete Start
  var cache = {};
  $.widget("custom.catcomplete", $.ui.autocomplete, {
    _create: function () {
      this._super();
      this.widget().menu("option", "items", "> :not(.ui-autocomplete-category)");
    },
    _renderMenu: function (ul, items) {
      var currentCategory = "";
      $.each(items, function (index, item) {
        var li;
        var html;
        switch (item.category) {
          case 'Airport':
            html = '<span>' + item.label + ',</span>' + '<span>' + item.city + '</span>, <span>' + item.country + '</span>' + '<span class="hotel-count">' + item.codetype + '</span>';
            if (item.category != currentCategory) {
              ul.append("<li class='ui-autocomplete-category'>" + "<i class='fa fa-plane'></i>" + item.category + "</li>");
              currentCategory = item.category;
            }
            break;
          case 'Resort':
            html = '<span>' + item.label + ',</span>' + '<span>' + item.city + '</span>, <span>' + item.country + '</span>' + '<span class="hotel-count">' + item.codetype + '</span>';
            if (item.category != currentCategory) {
              ul.append("<li class='ui-autocomplete-category'>" + "<i class='fa fa-hotel'></i>" + item.category + "</li>");
              currentCategory = item.category;
            }
            break;
          case 'Port':
            html = '<span>' + item.label + ',</span>' + '<span>' + item.city + '</span>, <span>' + item.country + '</span>' + '<span class="hotel-count">' + item.codetype + '</span>';
            if (item.category != currentCategory) {
              ul.append("<li class='ui-autocomplete-category'>" + "<i class='fa fa-ship'></i>" + item.category + "</li>");
              currentCategory = item.category;
            }
            break;
          case 'Station':
            html = '<span>' + item.label + ',</span>' + '<span>' + item.city + '</span>, <span>' + item.country + '</span>' + '<span class="hotel-count">' + item.codetype + '</span>';
            if (item.category != currentCategory) {
              ul.append("<li class='ui-autocomplete-category'>" + "<i class='fa fa-train'></i>" + item.category + "</li>");
              currentCategory = item.category;
            }
            break;
          case 'Location':
            html = '<span>' + item.label + ',</span>' + '<span>' + item.city + '</span>, <span>' + item.country + '</span>' + '<span class="hotel-count">' + item.codetype + '</span>';
            if (item.category != currentCategory) {
              ul.append("<li class='ui-autocomplete-category'>" + "<i class='fa fa-map-marker'></i>" + item.category + "</li>");
              currentCategory = item.category;
            }
            break;
          case 'Bus Station':
            html = '<span>' + item.label + ',</span>' + '<span>' + item.city + '</span>, <span>' + item.country + '</span>' + '<span class="hotel-count">' + item.codetype + '</span>';
            if (item.category != currentCategory) {
              ul.append("<li class='ui-autocomplete-category'>" + "<i class='fa fa-bus'></i>" + item.category + "</li>");
              currentCategory = item.category;
            }
            break;
          case 'Hotel':
            html = '<span>' + item.label + ',</span>' + '<span>' + item.city + '</span>, <span>' + item.country + '</span>' + '<span class="hotel-count">' + item.codetype + '</span>';
            if (item.category != currentCategory) {
              ul.append("<li class='ui-autocomplete-category'>" + "<i class='fa fa-hotel'></i>" + item.category + "</li>");
              currentCategory = item.category;
            }
            break;
        }
        li = $("<li></li>")
          .data("ui-autocomplete-item", item)
          .append('<div>' + html + '</div>')
          .appendTo(ul);

        if (item.category) {
          li.attr("aria-label", item.category + " : " + item.label);
        }
      });
    }
  });
  $("#autocompletetransfer1").catcomplete({
    delay: 0,
    minLength: 0,
    source: function (request, response) {
      // var term = request.term;
      // if (term in cache) {
      //     response(cache[ term ]);
      //   return;
      // }
      $.getJSON(myconfig.site_url + "autocomplete/get_transferPickup", request, function (data, status, xhr) {
        // cache[ term ] = data;
        response(data);
      });
    },
    select: function (event, ui) {
      pickup_info = ui.item;
      pickup_codetype = ui.item.codetype;
      $(this).next("input[name='pickup_code']").val(ui.item.id);
      $('#pickup_typecode').val(ui.item.codetype+','+ui.item.id);

      dropoff_name.attr("disabled", false);
      dropoff_name.css("opacity", "1");
      if (pickup_codetype == 'RST' || pickup_codetype == 'GEO') {
        departureDate.attr("disabled", false);
        departureDate.css("opacity", "1");
        departureTime.attr("disabled", false);
        departureTime.css("opacity", "1");

        arrivalDate.attr("disabled", true);
        arrivalDate.css("opacity", "0.5");
        arrivalTime.attr("disabled", true);
        arrivalTime.css("opacity", "0.5");
      }else if (pickup_codetype == 'AIR' || pickup_codetype == 'PRT') {
        arrivalDate.attr("disabled", false);
        arrivalDate.css("opacity", "1");
        arrivalTime.attr("disabled", false);
        arrivalTime.css("opacity", "1");

        departureDate.attr("disabled", true);
        departureDate.css("opacity", "0.5");
        departureTime.attr("disabled", true);
        departureTime.css("opacity", "0.5");

      }

      if (event.keyCode !== 9) {
        var tabindex = parseInt($(this).attr('tabindex'));
        if (tabindex >= 0) {
          tabindex = tabindex + 1;
          $(this).closest('form').find('[tabindex=' + tabindex + ']').focus();
        }
      }
    }
  }).focus(function () {
    if (this.value == "") {
      $(this).catcomplete('search', '');
    }
  });


  $("#autocompletetransfer2").catcomplete({
    delay: 0,
    minLength: 0,

    source: function (request, response) {
      var pickup = $('#pickup_typecode').val();
      var result = pickup.split(",");
      var pickupCode = result[1];
      if(result[0] == 'RST'){
        var category = 'Resort';
      }else{
        var category = pickup_info.category;
      }
      // var term = request.term;
      // if (term in cache) {
      //      response(cache[ term ]);
      //      return;
      //   }
      $.getJSON(myconfig.site_url + "autocomplete/get_transferDropOff/" + pickupCode + "/" + category, request, function (data, status, xhr) {
        //   cache[ term ] = data;
        response(data);
      });
    },
    select: function (event, ui) {
      pickup_info = ui.item;
      codetype = ui.item.codetype;
      $(this).next("input[name='dropoff_code']").val(ui.item.id);
      $('#dropoff_typecode').val(ui.item.codetype+','+ui.item.id);

      if (event.keyCode !== 9) {
        var tabindex = parseInt($(this).attr('tabindex'));
        if (tabindex >= 0) {
          tabindex = tabindex + 1;
          $(this).closest('form').find('[tabindex=' + tabindex + ']').focus();
        }
      }
    }
  }).focus(function () {
    if (this.value == "") {
      $(this).catcomplete('search', '');
    }
  });

  //Transfer Autocomplete End

  $('#autocompletetransfer11').on('keydown.autocomplete', function () {
    $(this).autocomplete({
      source: myconfig.site_url + "autocomplete/get_transferPickup",
      minLength: 2, //search after two characters
      autoFocus: true, // first item will automatically be focused

      select: function (event, ui) {
        pickup_info = ui.item;
        codetype = ui.item.codetype;
        $(this).next('input').val(ui.item.id);
        $('#pickup_typecode').val(ui.item.codetype+','+ui.item.id);
        dropoff_name.attr("disabled", false);
        dropoff_name.css("opacity", "1");
        if (codetype != 'AIR') {
          departureDate.attr("disabled", false);
          departureDate.css("opacity", "1");
          departureTime.attr("disabled", false);
          departureTime.css("opacity", "1");

          arrivalDate.attr("disabled", true);
          arrivalDate.css("opacity", "0.5");
          arrivalTime.attr("disabled", true);
          arrivalTime.css("opacity", "0.5");

        }
      }
    })
  });

  $('#autocompletetransfer21').on('keydown.autocomplete', function () {
    var pickup = $('#pickup_typecode').val();
    var result = pickup.split(",");
    var pickupCode = result[1];
    var category = pickup_info.category;
    $(this).autocomplete({

      source: myconfig.site_url + "autocomplete/get_transferDropOff/" + pickupCode + "/" + category,
      minLength: 2, //search after two characters
      autoFocus: true, // first item will automatically be focused
      select: function (event, ui) {
        $(this).next('input').val(ui.item.id);
        $('#dropoff_typecode').val(ui.item.codetype+','+ui.item.id);
      }
    })
  });

  $(".input-checkbox").on('click', function (event) {
    event.stopPropagation();
    event.stopImmediatePropagation();
    $(this).parent().siblings().toggle();

    let input = $(this);
    let inputValue = input.val();
    let extraFixValues = inputValue.split("_");
    let extraFixValue = extraFixValues[1];

    let select = $(this).parent().siblings().children();


    if($(this).is(":checked")){


      let val = select.val();

      let output = extraFixValue * val;
      input.val(inputValue + "_" + val);
      let totalcost = parseFloat($("#totalCost").text());
      let extraCost = parseFloat($("#extraCost").text());
      $("#totalCost").text(totalcost + output);
      $("#extraCost").text(extraCost + output);


      select.on("change", function () {
        let value = $(this).val();
        let output = extraFixValue * value;
        let totalCost = parseFloat(totalcost) + output;
        extraCost = parseFloat(extraCost) + output;
        input.val(inputValue + "_" + value);
        $("#totalCost").text(totalCost);
        $("#extraCost").text(extraCost);
        console.log("total", baseCost);
      })
    } else {
      let value = select.val();
      var x= $("#totalCost").text() - (value * extraFixValue);
      var y= $("#extraCost").text() - (value * extraFixValue);
      $("#totalCost").text(x.toFixed(2));
      $("#extraCost").text(y.toFixed(2));
      console.log(inputValue);
      input.val(inputValue.substr(0,inputValue.lastIndexOf("_")));

      console.log(value)
    }


  });
});


function updatePrice(sel, unit_price, selector, units_id) {
  var total = sel.value * unit_price;
  $(selector).text(total);
  $(units_id).val(sel.value);
  console.log(units_id);
}



//Sort Elements
function sortTransfer() {
    var orderBy = $("#sort-box").find(':selected').data('order');
    var orderElement = $("#sort-box").find(':selected').val();

    
        var listSelector = $('#transfer-cars .item-result-wrap');
    
    listSelector.sort(function (a, b) {
        var contentA = '', contentB = '';
        switch (orderElement) {
            case 'price':
                contentA = parseInt($(a).data('price'));
                contentB = parseInt($(b).data('price'));
                break;            
        }
        if (orderBy == 'ASC') {
            return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
        } else {
            return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
        }
    });
    $("#transfer-cars").html(listSelector);
}


$(document).ready(function () {
	
	//Sort By lowest price
        $('#sort-box').prop("disabled", false).selectpicker('refresh'); //.change()
        sortTransfer(); // Sort with first level elements only

		 $('#sort-box').change(function () {
		 sortTransfer();
 });

  $('#traveler-form').validator({
    disable: true,
    focus: false,
  }).on('submit', function (e) {
    if (e.isDefaultPrevented()) {
      // handle the invalid form...
      return false;
    } else {
      // everything looks good!
      submit_flight_details('driver-block');
      return false;
    }
  });

  $('.check-type').click(function(){
    var type = $(this).val();
    var target = $('[product_type="'+ type +'"]');
    if($(this).is(":checked")){
      target.css("display", "block");
      console.log(target);
    }else {
      target.css("display", "none");
      console.log("unchecked");
    }
  });
});

function submit_flight_details(id) {
  activate_block(id);
  $('#passenger_name').html($('#salutation').val() + ' ' + $('#First_Name').val() + ' ' + $('#Last_Name').val());
  $('#passenger_address').html($('#addressLine1').val() + ' ' + $('#addressLine2').val());
  $('#passenger_phone').html($('#countryCode').val() + ' ' + $('#tpnumber').val());
  $('#passenger_email').html($('#Email').val());
  $.ajax({
    url: myconfig.site_url + 'transfer/submit_flight_details',
    type: "POST",
    global: false,
    data: $('form[name="submit_flight_details_form"]').serializeArray(),
    beforeSend: function () {
      $('#faremodel').modal({backdrop: 'static', keyboard: false, show: true});
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (typeof response.success !== 'undefined' && response.success === 1) {

        if (!$.isEmptyObject(response.ifrurl)) {
          console.log(1);
          //reloadIframeSource(response.ifrurl);
          $("#payment_creditcard").removeClass("hide");
          $('#paymentFrame').html(response.ifrurl);
        }
        if (!$.isEmptyObject(response.html)) {
          $("#payment-data").html(response.html);
        }

        var paynow = 'Pay Now ' + response.total;
        $('#checkin').val(paynow);
        $('#payButton').val(paynow);
        $("#deduct_amount").text(response.deposit_amount);

        if (typeof response.service_charge !== 'undefined') {
          console.log(3);
          $('#service_charge_rate').removeClass('hide').find('span').text(response.service_charge);
        }

        //window.location = response.url;
        //activate_block('driver-block');
        activate_block(id);
      } else {
        // window.location = '';
      }
    },
    complete: function () {
      $(".loading-content").fadeOut();
      $('#traveler-submit-btn').prop('disabled', false);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      $("#simple-msg").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus=' + textStatus + ', errorThrown=' + errorThrown + '</code></pre>');
    }
  });


}