$(document).ready(function() {
 	// define a set of requests to perform - you could also provide each one		
	var successHandler = function (data) {
		$('#rapid_fire_draft_loading').hide();
		$('#result').append(data.car_search_result);

		$("#setMinPrice").val(data.min_price);
		$("#setMaxPrice").val(data.max_price);
		var total_result = $('.car_infoBox').length;
		// alert(total_result);
		$("#search_count").html(total_result);
		// Calling PriceSlider
		setPriceSlider();
	}

	// these will basically all execute at the same time:
	for (var i = 0, l = api_array.length; i < l; i++) {
		$.ajax({
			url: siteUrl+'cars/cars_availabilty',				
			data: 'callBackId='+api_array[i],
			dataType: 'json',				
			type: 'POST',
			beforeSend: function()
			{
				$(".flight-search-cntr").css("display","none");
				$('#rapid_fire_draft_loading').show();
			},
			success: successHandler
		});
	}
		   
		
	$(".Stop").click(function() {
		filter();
	});  
  
          
});


$(document).on("click", '.AirLine', function ($e) {		
	filter();
});

// flight details open					
$(document).on("click", '.results-row > .FlightInfoBox > .row', function($e){				
	$(this).parents('.results-row').find('.flight-details-Cntr').slideToggle('fast');
	$(this).parents('.results-row').find('.fa-arrow-down').toggleClass('fa-arrow-up');	
});
