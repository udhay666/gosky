$(document).ready(function()
{
	forwardDate();	
	$(".CarSorting").click(function()
	{		
		$(this).parent().find('i.fa').hide();
		$(this).find('i.fa').show();
		$(this).find('.fa-long-arrow-down').toggleClass('fa-long-arrow-up');
	    $order=$(this).attr("data-order");
	    $sortBy=$(this).attr("rel");
	    sortFlights($order,$sortBy,$(this));
	   	
	}); 	
	
});

function sortFlights($order,$sortBy,curSel)
{
    var flights = $('.resultOnward .car_infoBox').get();
    flights.sort(function(a,b)
    {
	if($sortBy=="data-name")
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
                
                
    var container = $('.resultOnward');
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
