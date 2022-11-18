$(document).ready(function()
 {
     forwardDate();	
     
        // define a set of requests to perform - you could also provide each one		
        var successHandler = function (data) {
            
            $('#rapid_fire_draft_loading').hide();
            $('#result').html(data.flight_search_result);                       	
			
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
          
});


function forwardDate()
{    
    $(".forwardDate").click(function()
    {
		$searchDate = $(this).attr('data-searchDate');
					
		$dateStringAry	=	$searchDate.split("-");
		$dateString	=	$dateStringAry[2]+"/"+$dateStringAry[1]+"/"+$dateStringAry[0];
		
		$("#dpf1").val($dateString);
				
		$tripType=$("#tripType:checked").val();		
		if($tripType=='S')	  
		{	
			$("#tripTypeVal").val('S');			
		}
		else if($tripType=='R')
		{
			$("#tripTypeVal").val('R');	
		}
			
		document.searchFlights.submit();
		
    });
}
