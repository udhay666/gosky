var site_url = $("#siteUrl").val();
function setPriceSlider() {
  //alert("tsting");
  var setPriceMin = parseFloat($("#setMinPrice").val());
  var setPriceMax = parseFloat($("#setMaxPrice").val());
  var currency = $("#setCurrency").val();
  callPriceSlider(setPriceMin, setPriceMax, currency);
  priceSorting();
}

function setTripRatingSlider() {
  var setRatingMin = parseInt($("#setMinRating").val());
  var setRatingMax = parseInt($("#setMaxRating").val());
  callTripRatingSlider(setRatingMin, setRatingMax);
  priceSorting();
}

$(document).on("click", ".tbolistc", function ($e) {
  filter();
});

function callPriceSlider(setPriceMin, setPriceMax, currency) {
  // $selector=$( "#priceSlider" );
  // $output=$( "#priceSliderOutput");
  // $minPrice=$("#minPrice");
  // $maxPrice=$("#maxPrice");
  $selector = $("#priceSlider");
  $MinOutput2 = $("#min-price-txt");
  $MaxOutput2 = $("#max-price-txt");
  $MinOutput = $("#price-start");
  $MaxOutput = $("#price-end");
  $minPrice = $("#minPrice");
  $maxPrice = $("#maxPrice");
  $selector.slider({
    range: true,
    min: setPriceMin,
    max: setPriceMax,
    values: [setPriceMin, setPriceMax],
    slide: function (event, ui) {
      if (ui.values[0] + 20 >= ui.values[1]) {
        return false;
      } else {
        // $output.html(currency+' '+ ui.values[ 0 ] + "  Onwards  " );
        // $minPrice.val(ui.values[0]);
        // $maxPrice.val(ui.values[1]);
        $MinOutput.html(
          '<i class="mdi mdi-currency-inr"></i> ' +
            ui.values[0].toLocaleString()
        );
        $MaxOutput.html(
          "<i class='mdi mdi-currency-inr'></i> " +
            ui.values[1].toLocaleString()
        );
        $MinOutput2.html(ui.values[0].toLocaleString());
        $MaxOutput2.html(ui.values[1].toLocaleString());
        $minPrice.val(ui.values[0]);
        $maxPrice.val(ui.values[1]);
      }
    },
  });
  // $output.html(currency+' '+$selector.slider( "values", 0 ) + "  Onwards  " );
  // $minPrice.val($selector.slider( "values",0));
  // $maxPrice.val($selector.slider( "values",1));
  $MinOutput.html(
    '<i class="mdi mdi-currency-inr"></i> ' +
      $selector.slider("values", 0).toLocaleString()
  );
  $MaxOutput.html(
    "<i class='mdi mdi-currency-inr'></i> " +
      $selector.slider("values", 1).toLocaleString()
  );
  $MinOutput2.html($selector.slider("values", 0).toLocaleString());
  $MaxOutput2.html($selector.slider("values", 1).toLocaleString());
  $minPrice.val($selector.slider("values", 0));
  $maxPrice.val($selector.slider("values", 1));
}

function callTripRatingSlider(setRatingMin, setRatingMax) {
  $selector1 = $("#tripRatingSlider");
  $output1 = $("#tripRatingSliderOutput");
  $minRating = $("#minRating");
  $maxRating = $("#maxRating");
  $selector1.slider({
    range: true,
    min: setRatingMin,
    max: setRatingMax,
    values: [setRatingMin, setRatingMax],
    slide: function (event, ui) {
      $output1.html(ui.values[0] + "  To  " + ui.values[1]);
      $("#minRating").val(ui.values[0]);
      $("#maxRating").val(ui.values[1]);
    },
  });
  $output1.html(
    $selector1.slider("values", 0) + "  To  " + $selector1.slider("values", 1)
  );
  $minRating.val($selector1.slider("values", 0));
  $maxRating.val($selector1.slider("values", 1));
}

function priceSorting() {
  $(".ui-slider").bind("slidestop", function () {
    filter();
  });
}

function filter($sortBy, $order) {
  $(".ajaxloading").show();
  $minPr = parseFloat($("#minPrice").val());
  $maxPr = parseFloat($("#maxPrice").val());
  $minRt = parseInt($("#minRating").val());
  $maxRt = parseInt($("#maxRating").val());
  $hotelName = $("#hotelName").val();
  $sessionId = $("#sessionId").val();

  $located = new Array();
  $(".tbolistc:checked").each(function () {
    $locatedNum = $(this).val();
    $located.push($locatedNum);
  });

  $locatedShow = $located;
  if ($located.length === 0) {
    $locatedShow = "";
  }

  $stars = new Array();
  $(".StarRating:checked").each(function () {
    $starNum = $(this).val();
    $stars.push($starNum);
  });
  $areas = new Array();
  $(".Areas:checked").each(function () {
    $areasVal = $(this).val();
    $areas.push($areasVal);
  });
  $starShow = $stars;
  if ($stars.length === 0) {
    $starShow = "";
  }
  $locationShow = $areas;
  if ($areas.length === 0) {
    $locationShow = "";
  }
  $sort_data = "data-price";
  $sort_order = "asc";
  if (typeof $sortBy !== "undefined" && typeof $order !== "undefined") {
    $sort_data = $sortBy;
    $sort_order = $order;
  }

  $searcharray = $("#searcharray").val();
  $.post(
    site_url + "hotels/searchresult_ajax",
    {
      sessionId: "" + $sessionId,
      minPrice: "" + $minPr,
      maxPrice: "" + $maxPr,
      tbolistc: "" + $locatedShow,
      starRating: "" + $starShow,
      hotelName: "" + $hotelName,
      location: "" + $locationShow,
      sortBy: "" + $sort_data,
      order: "" + $sort_order,
      searcharray: "" + $searcharray,
    },
    function (data) {
      $(".ajaxloading").hide();
      $("#avail_hotels").html(data.hotels_search_result);
      $("#location_search").html(data.hotels_search_location);
      $("#pagination_up").html(data.paging);
      $("#pagination_down").html(data.paging);
    },
    "json"
  );
}

function filter_all($sortBy, $order) {
  $(".ajaxloading").show();
  $minPr = parseFloat($("#minPrice").val());
  $maxPr = parseFloat($("#maxPrice").val());
  $minRt = parseInt($("#minRating").val());
  $maxRt = parseInt($("#maxRating").val());
  $hotelName = "";
  $sessionId = $("#sessionId").val();
  $stars = new Array();
  $(".StarRating:checked").each(function () {
    $starNum = $(this).val();
    $stars.push($starNum);
  });
  $areas = new Array();
  $(".Areas:checked").each(function () {
    $areasVal = $(this).val();
    $areas.push($areasVal);
  });
  $starShow = $stars;
  if ($stars.length === 0) {
    $starShow = "";
  }
  $locationShow = $areas;
  if ($areas.length === 0) {
    $locationShow = "";
  }
  $sort_data = "data-price";
  $sort_order = "asc";
  if (typeof $sortBy !== "undefined" && typeof $order !== "undefined") {
    $sort_data = $sortBy;
    $sort_order = $order;
  }
  console.log($stars.length);
  console.log($stars);
  $searcharray = $("#searcharray").val();
  $.post(
    site_url + "hotels/searchresult_ajax",
    {
      sessionId: "" + $sessionId,
      minPrice: "" + $minPr,
      maxPrice: "" + $maxPr,
      starRating: "" + $starShow,
      hotelName: "" + $hotelName,
      location: "" + $locationShow,
      sortBy: "" + $sort_data,
      order: "" + $sort_order,
      searcharray: "" + $searcharray,
    },
    function (data) {
      $(".ajaxloading").hide();
      $("#avail_hotels").html(data.hotels_search_result);
      $("#pagination_up").html(data.paging);
      $("#pagination_down").html(data.paging);
      $("#hotelName").val("");
    },
    "json"
  );
}
