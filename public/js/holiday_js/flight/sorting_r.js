$(document).ready(function()
{

	$(".FlightSorting").click(function()
	{		
		$(this).find('.fa-arrow-down').toggleClass('fa-arrow-up');	
		$order=$(this).attr("data-order");
		$sortBy=$(this).attr("rel");
		sortFlights($order,$sortBy,$(this));

	}); 	

	$(".FlightSorting_r").click(function()
	{		
		$(this).find('.fa-arrow-down').toggleClass('fa-arrow-up');	
		$order=$(this).attr("data-order");
		$sortBy=$(this).attr("rel");
		sortFlights_r($order,$sortBy,$(this));	   	
	});
	
});

function sortFlights($order,$sortBy,curSel)
{ 
	var flights = $('.onward-trip .searchflight_box').get();
	flights.sort(function(a,b)
	{
		if($sortBy=="data-airlinename")
		{
	    //============= To Check Non Numerical VAlues=====================
	    var keyA = $(a).find('.FlightInfoBox').attr($sortBy);
	    var keyB = $(b).find('.FlightInfoBox').attr($sortBy);
	}
	else
	{
	    //============= To Check Numerical VAlues=========================
	    var keyA = parseInt($(a).find('.FlightInfoBox').attr($sortBy));
	    var keyB = parseInt($(b).find('.FlightInfoBox').attr($sortBy));
	}
	if($order=="asc")
	{
		if (keyA < keyB) return -1;
		if (keyA > keyB) return 1;
	}
	else
	{
		if (keyA > keyB) return -1;
		if (keyA < keyB) return 1;
	}
	return 0;
});


	var container = $('.onward-trip');
	$.each(flights, function(i, ul)
	{ 
		container.append(ul);
	});

	if($order=="asc")
		curSel.attr("data-order",'desc');                    
	else
		curSel.attr("data-order",'asc');
}

function sortFlights_r($order,$sortBy,curSel)
{
	var flights = $('.return-trip .searchflight_box').get();
	flights.sort(function(a,b)
	{
		if($sortBy=="data-airlinename")
		{
	    //============= To Check Non Numerical VAlues=====================
	    var keyA = $(a).find('.FlightInfoBox').attr($sortBy);
	    var keyB = $(b).find('.FlightInfoBox').attr($sortBy);
	}
	else
	{
	    //============= To Check Numerical VAlues=========================
	    var keyA = parseInt($(a).find('.FlightInfoBox').attr($sortBy));
	    var keyB = parseInt($(b).find('.FlightInfoBox').attr($sortBy));
	}
	if($order=="asc")
	{
		if (keyA < keyB) return -1;
		if (keyA > keyB) return 1;
	}
	else
	{
		if (keyA > keyB) return -1;
		if (keyA < keyB) return 1;
	}
	return 0;
});


	var container = $('.return-trip');
	$.each(flights, function(i, ul)
	{
		container.append(ul);
	});

	if($order=="asc")
		curSel.attr("data-order",'desc');                    
	else
		curSel.attr("data-order",'asc');
}

function forwardDate()
{    

	$(".forwardDate").click(function()
	{
		$searchDate = $(this).attr('data-searchDate');

		/* $dateStringAry	=	$searchDate.split("-");
		$dateString	=	$dateStringAry[2]+"/"+$dateStringAry[1]+"/"+$dateStringAry[0]; */
		
		$("#dpf1").val($searchDate);

		$tripType=$("#tripType:checked").val();		
		if($tripType=='S')	  
		{	
			$("#tripTypeVal").val('S');			
		}
		else if($tripType=='R')
		{
			$("#tripTypeVal").val('R');	
		}

		//document.searchFlights.submit();
		if($('#flightmode').val() == 'dom') {
			$('#flight_dom').find('#searchFlights').submit();
		} else {
			$('#flight_dom').find('#searchFlights').submit();
			//$('#flight_int').find('#searchFlights').submit();
		}


	});
}
forwardDate();