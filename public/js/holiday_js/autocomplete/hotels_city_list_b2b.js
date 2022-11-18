$(function() {
			
//	//World Wide Hotels City List 
	$("#cityName").autocomplete({
		source: siteUrl+"b2b/hotels_city_list",
		minLength: 2,
		autoFocus: true
	});

//World Wide Hotels City List 
/*	$("#cityName").autocomplete({alert("hi");
		source: function(request, response) {
                        $.ajax({
                            url: siteUrl+ domain +"/hotels_city_list",
                            dataType: "json",
                            data: {
                                term: request.term,
                                is_domestic: $('input[name=hotelmode]:radio:checked').val()
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                    },
		minLength: 2,
		autoFocus: true
	});
	*/			

});