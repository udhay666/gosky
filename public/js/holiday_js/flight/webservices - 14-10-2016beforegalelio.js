
/*$(document).ready(function()

 {

	 	// define a set of requests to perform - you could also provide each one		

		var successHandler = function (data) {

						

						$('#rapid_fire_draft_loading').hide();

						$('#result').append(data.flight_search_result);

                        //$("#result_count").html(data.total_result);                      

                      

			// do something			

			 

		$order='asc';

		$sortBy='data-price';

		sortFlights($order,$sortBy,$('.FlightSorting'));

		

		var data_airline=new Array;

		var data_airlineNames=new Array;

					

		var flightCount=0;						

		$(".FlightInfoBox").each(function()

		{

			flightCount++;

			data_airline.push($(this).attr("data-airline"));

			data_airlineNames.push($(this).attr("data-airlinename"));

			

		});	

		 

		$("#flightCount").text(flightCount);	

		$("#flightCount1").text(flightCount);	

		

		var prices = $(".FlightInfoBox").map(function() {

				return parseFloat($(this).attr('data-price'), 10);

		}).get();



		var highest = Math.max.apply(Math, prices);

		var lowest = Math.min.apply(Math, prices);

		

		if(highest > 0 && lowest > 0)

		{

			$("#setMinPrice").val(lowest);	

			$("#setMaxPrice").val(highest);	

		}

		else

		{

			$("#setMinPrice").val(0);	

			$("#setMaxPrice").val(0);

		}

		

		var durations = $(".FlightInfoBox").map(function() {

				return parseInt($(this).attr('data-duration'), 10);

		}).get();



		var maxDur = Math.max.apply(Math, durations);

		var minDur = Math.min.apply(Math, durations);

		

		if(minDur > 0 && maxDur > 0)

		{

			$("#setMinDuration").val(minDur);	

			$("#setMaxDuration").val(maxDur);

		}

		else

		{

			$("#setMinDuration").val(0);	

			$("#setMaxDuration").val(0);

		}

					

		// Calling PriceSlider & TimeSlider

		 setPriceSlider();

		 setTimeSlider();

		 setDurationSlider();

		 

		 data_airline = $.grep(data_airline, function(v, k)

		{			   

			return $.inArray(v ,data_airline) === k;

		});

			

		data_airlineNames = $.grep(data_airlineNames, function(v, k)

		{

			return $.inArray(v ,data_airlineNames) === k;

		});

		

		var AirlineString="";

		for(var ai=0;ai<data_airline.length;ai++)		

		{

			var airlineCode=data_airline[ai];

			var airlineName=data_airlineNames[ai];

			if(typeof airlineCode=="undefined" || airlineCode=="") {}

			else

			{

			AirlineString+='<label><input id="AirLine_space" class="AirLine" type="checkbox" value="'+airlineCode+'" checked="checked">&nbsp;<span class="airlines-name">'+airlineName+'</span><!--<span class="airlines-price pull-right"><i class="fa fa-rupee"></i> 23,456</span>--></label>';

			}				

		}

		$(".airlines").html(AirlineString);

			

		$(".left-search-cntr").css("display","block");	

			

		}



	// these will basically all execute at the same time:

	for (var i = 0, l = api_array.length; i < l; i++) 

	{

		$.ajax({

			url: siteUrl+'/flights/flights_availabilty',				

			data: 'callBackId='+api_array[i],

			dataType: 'json',				

			type: 'POST',

			beforeSend: function()

			{

				$(".left-search-cntr").css("display","none");

				$('#rapid_fire_draft_loading').show();

			},

			success: successHandler

			

		});

	}

		   

		

  $(".Stop").click(function()

  {

		filter();

  });  
       

});*/


$(document).ready(function()
{
	$(".left-search-cntr").css("display","none");
	$('#rapid_fire_draft_loading').show();


	var l = api_array.length;

	$i = 0;
	search_availability($i); 	

	   //these will basically execute at the same time:

	   function search_availability($a) 
	   {
            /*for (var i = 0, l = api_array.length; i < l; i++) 
            {*/
            	$.ajax({
            		url: siteUrl+'flights/flights_availabilty',			
            		data: 'callBackId='+api_array[$a],
            		dataType: 'json',				
            		type: 'POST',                          
            		success: function (data) 
            		{
            			$('#sessionId').val(data.session_id); 
            			var locoount=0;
            			if(data.galileo){
            				for(var ai=0;ai<data.loopcount;ai++)		

            				{
            					$.ajax({
            						url: siteUrl+'flights/updategalileo',			
            						data: 'count='+locoount,
            						dataType: 'json',				
            						type: 'POST',                          
            						success: function (data) 
            						{

            							if(data.results == 'success') 
            							{                    
            								load_search_results();                                                   
            							}     

            						}
            					});
            					locoount=locoount+15;
            				}
            			}else{

            			if($a == (l-1))
            			{                                   
            				load_search_results();                                   
            				return false;
            			}              

            			if(data.results == 'success') 
            			{                    
            				load_search_results();                                                   
            			}     
            		}
            			$a++;                
            			search_availability($a);                                

            		}
            	});
            	/*}*/
            }        


            function load_search_results() 
            {
            	$sessionId = $('#sessionId').val();   
			//alert($sessionId);
			$.ajax({
				url: siteUrl+'flights/fetch_results?session_id='+$sessionId,                           
				dataType: 'json',				
				type: 'POST',                          
				success:  function (data) 
				{    
					$('#result').html(data.flights_search_result);
					$('#result1').html(data.flights_search_result1);
					$('#pagination_up').html(data.paging);
					$('#pagination_down').html(data.paging);  

					$(".airlines").html(data.airlines);

					$("#setMinPrice").val(data.min_price);	
					$("#setMaxPrice").val(data.max_price);

                                // Calling PriceSlider
                                setPriceSlider();
                                setTimeSlider();
                                setDurationSlider();            
                                
                                $('#rapid_fire_draft_loading').hide();       
                                $(".left-search-cntr").css("display","block");

                                  $(".onwardRadio:first:visible").trigger("click");
  $(".returnRadio:first:visible").trigger("click");
  $(".priceInfoTotal span").html(doTotal);
  $(".priceInfoDock").fadeIn(1000);
                            }
                        });

		}  
		
		$(".Stop").click(function()
		{
			filter();
		});    

	});


// flight details open					

$(document).on('click','.details-row1, .open-flight-details, .oneway, .roundtrip',function(event){

	if(!$(event.target).hasClass('femail')){		

		$(this).parents('.results-row').find('.flight-details-Cntr').slideToggle('fast');

		$(this).parents('.results-row').find('.fa-arrow-down').toggleClass('fa-arrow-up');

	}

});


$(document).on("click", '.AirLine', function ($e) {

	filter();

});



