$(function() {
			
	//World Wide Cars Locations List 
	$("#pickUpCity").autocomplete({
		source: siteUrl+"cars/akbar_cars_source_cities",
		minLength: 2,
		autoFocus: true,
		select: function (event, ui) {
			var val  = $(this).val(ui.item.take_val);
			$.ajax({
				type: 'post',
				url: siteUrl+"cars/akbar_cars_airport_cities",
				data: val,
				dataType: 'json',
				beforeSend: function() {

				},
				success: function(data) {
					// console.log(data);
					// $('#pickUpCity').val(data.CityName);
					$('#AirportName').html(data.airport_cities);
					$('#CityId').val(data.CityId);
				},
				error: function(data){
					alert('Request failed');
				}
			});
		},
		// open: function (event, ui) {
		// 	alert("changed!");
		// }
	});

	$("#LocationName").autocomplete({
		// source: siteUrl+"cars/akbar_cars_location_cities",
		source: function(request, response) {
            $.ajax({
                url: siteUrl+"cars/akbar_cars_location_cities",
                dataType: "json",
                data: {
                    term : request.term,
                    CityId : $("#CityId").val()
                },
                success: function(data) {
                    response(data);
                }
            });
        },
		minLength: 2,
		autoFocus: true,
	});

	$("#pickUpCity2").autocomplete({
		source: siteUrl+"cars/akbar_cars_source_cities",
		minLength: 2,
		autoFocus: true,
		select: function (event, ui) {
			var val  = $(this).val(ui.item.take_val);
			$.ajax({
				type: 'post',
				url: siteUrl+"cars/akbar_cars_local_packages",
				data: val,
				dataType: 'json',
				beforeSend: function() {

				},
				success: function(data) {
					$('#trip_packages').html(data.trip_packages);
					$('#CityId2').val(data.CityId);
				},
				error: function(data){
					alert('Request failed');
				}
			});
		},
	});

	$("#LocationName2").autocomplete({
		// source: siteUrl+"cars/akbar_cars_location_cities",
		source: function(request, response) {
            $.ajax({
                url: siteUrl+"cars/akbar_cars_location_cities",
                dataType: "json",
                data: {
                    term : request.term,
                    CityId : $("#CityId2").val()
                },
                success: function(data) {
                    response(data);
                }
            });
        },
		minLength: 2,
		autoFocus: true,
	});

	$("#pickUpCity3").autocomplete({
		source: siteUrl+"cars/akbar_cars_source_cities",
		minLength: 2,
		autoFocus: true,
		select: function (event, ui) {
			var val  = $(this).val(ui.item.take_val);
			$.ajax({
				type: 'post',
				url: siteUrl+"cars/akbar_cars_source_citiyId",
				data: val,
				dataType: 'json',
				beforeSend: function() {

				},
				success: function(data) {
					$('#CityId3').val(data.CityId);
				},
				error: function(data){
					alert('Request failed');
				}
			});
		},
	});
	// var CityId3 = $("#CityId3").val();
	$("#LocationName3").autocomplete({
		// source: siteUrl+"cars/akbar_cars_location_cities",
		source: function(request, response) {
            $.ajax({
                url: siteUrl+"cars/akbar_cars_location_cities",
                dataType: "json",
                data: {
                    term : request.term,
                    CityId : $("#CityId3").val()
                },
                success: function(data) {
                    response(data);
                }
            });
        },
		minLength: 2,
		autoFocus: true,
	});

	$("#OutstationCity").autocomplete({
		// source: siteUrl+"cars/akbar_cars_location_cities",
		source: function(request, response) {
			var TravelSubId2  = $('#TravelSubId2').val();
			var CityId3  = $('#CityId3').val();
            $.ajax({
                url: siteUrl+"cars/akbar_cars_outstation_cities/",
                dataType: "json",
                data: {
                    term : request.term,
                    CityId : CityId3,
                    TravelSubId2 : TravelSubId2,
                },
                success: function(data) {
                    response(data);
                }
            });
        },
		minLength: 2,
		autoFocus: true,
	});
				

});