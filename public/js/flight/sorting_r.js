function sortFlights1(t,r,a){var i=$(".onward-trip .searchflight_box").get();i.sort(function(a,i){if("data-airlinename"==r)var s=$(a).find(".FlightInfoBox").attr(r),e=$(i).find(".FlightInfoBox").attr(r);else s=parseInt($(a).find(".FlightInfoBox").attr(r)),e=parseInt($(i).find(".FlightInfoBox").attr(r));if("asc"==t){if(s<e)return-1;if(s>e)return 1}else{if(s>e)return-1;if(s<e)return 1}return 0});var s=$(".onward-trip");$.each(i,function(t,r){s.append(r)}),"asc"==t?a.attr("data-order","desc"):a.attr("data-order","asc")}function sortFlights_r(t,r,a){var i=$(".return-trip .searchflight_box").get();i.sort(function(a,i){if("data-airlinename"==r)var s=$(a).find(".FlightInfoBox").attr(r),e=$(i).find(".FlightInfoBox").attr(r);else s=parseInt($(a).find(".FlightInfoBox").attr(r)),e=parseInt($(i).find(".FlightInfoBox").attr(r));if("asc"==t){if(s<e)return-1;if(s>e)return 1}else{if(s>e)return-1;if(s<e)return 1}return 0});var s=$(".return-trip");$.each(i,function(t,r){s.append(r)}),"asc"==t?a.attr("data-order","desc"):a.attr("data-order","asc")}function forwardDate(){$(".forwardDate").click(function(){$searchDate=$(this).attr("data-searchDate"),$("#dpf1").val($searchDate),$tripType=$("#dpf2Cntr").find("i"),$tripType.hasClass("clearIcon")?$("#tripTypeVal").val("R"):$("#tripTypeVal").val("S"),$("#O-R-Trip").submit()})}function forwardRDate(){$(".forwardRDate").click(function(){$searchDate=$(this).attr("data-searchDate"),$("#dpf2").val($searchDate),$tripType=$("#dpf2Cntr").find("i"),$tripType.hasClass("clearIcon")?$("#tripTypeVal").val("R"):$("#tripTypeVal").val("S"),$("#O-R-Trip").submit()})}$(document).ready(function(){forwardDate(),$(".FlightSorting1").click(function(){var t=$(this).find("i.mdi");t.hasClass("mdi-sort-descending")?(t.removeClass("mdi-sort-descending"),t.addClass("mdi-sort-ascending")):t.hasClass("mdi-sort-ascending")&&(t.removeClass("mdi-sort-ascending"),t.addClass("mdi-sort-descending")),$order=$(this).attr("data-order"),$sortBy=$(this).attr("rel"),sortFlights1($order,$sortBy,$(this))}),$(".FlightSorting_r").click(function(){var t=$(this).find("i.mdi");t.hasClass("mdi-sort-descending")?(t.removeClass("mdi-sort-descending"),t.addClass("mdi-sort-ascending")):t.hasClass("mdi-sort-ascending")&&(t.removeClass("mdi-sort-ascending"),t.addClass("mdi-sort-descending")),$order=$(this).attr("data-order"),$sortBy=$(this).attr("rel"),sortFlights_r($order,$sortBy,$(this))})}),forwardDate(),forwardRDate();