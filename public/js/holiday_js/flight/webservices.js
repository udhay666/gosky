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
                            if(data.results == 'success') 
                            {                    
                                load_search_results();                                                   
                            }  
            			$a++;                
            			search_availability($a);                                

            		}
            	});
            	/*}*/
            }        


            function load_search_results() 
            {
			$.ajax({
				url: siteUrl+'flights/fetch_results',                           
				dataType: 'json',				
				type: 'POST',                          
				success:  function (data) 
				{    
					$('#result').html(data.flights_search_result);
					$('#result1').html(data.flights_search_result1);
					$('#pagination_up').html(data.paging);
					$('#pagination_down').html(data.paging);  

					$(".airlines").html(data.airlines);
					$(".departcodes").html(data.departcodes);
					$(".roundairline1").html(data.airlineround);

					$("#setMinPrice").val(data.min_price);	
					$("#setMaxPrice").val(data.max_price);

  niceactive();

                                // Calling PriceSlider
                                setPriceSlider();
                                 setTimeSlider();
                                 setTimeSlider_arr();  
                                 filter();          
                                // setDurationSlider(); 
                                // $order='asc';
                                // $sortBy='data-price';
                                // sortFlights($order,$sortBy,$('.FlightSorting')); 
                                // sortFlights_r($order,$sortBy,$('.FlightSorting'));          
                                
                                $('#rapid_fire_draft_loading').hide();       
                                $(".left-search-cntr").css("display","block");

                                $(".onwardRadio:first:visible").trigger("click");
                                $(".returnRadio:first:visible").trigger("click");
                                $(".searchflight_box_oneward:first:visible").addClass("silver_border");
                                $(".searchflight_box_return:first:visible").addClass("silver_border");
                                $(".priceInfoTotal").html(doTotal);
                                $(".priceInfoDock").fadeIn(1000);

//hide close
hideclose();

                            }
                        });

		}  
	
$(document).on("click", '.AirLine input', function ($e) {

	filter();

});
$(document).on("click", '.Dairport', function ($e) {

	filter();

});
$(document).on("click", '.Stop input', function ($e) {

	filter();

});
$(document).on("click", '.faretype input', function ($e) {

	filter();

});
$(document).on("click", '.topairline', function ($e) {

	filter();
});
});

function hideclose(){
       $('.open-flight-details').click(function(event){
      $(this).parents('.results-row').find('.flight-details-Cntr').slideToggle(500);
      $(this).parents('.results-row').find('.fa-arrow-down').toggleClass('fa-arrow-up');
      setTimeout(function(){
        var Rheight  = $('.searchResultsSection').height();
        $('.searchFiltersSection').css('min-height', Rheight + 60);
      },500);
  });
                                  
}

 $(document).on("click", '.reset_filter', function($e) 
 { 
   setPriceSlider();
     setTimeSlider();
     setTimeSlider_arr(); 
    $(".faretype").find('.text-nicelabel:checked').each(function()
     { $(this).prop('checked', false); });
    $(".Stop").find('.text-nicelabel:checked').each(function()
     { $(this).prop('checked', false); });
    $(".AirLine").find('.text-nicelabel:checked').each(function()
     { $(this).prop('checked', false); });
      
    filter();
    
 });