$(document).ready(function()
{

	$(".busSorting").click(function()
	{	
		// alert("hi");	
	    $order=$(this).attr("data-order");
	    $sortBy=$(this).attr("rel");
	    $(this).find('i').css("display", "block");
    	$('.busSorting').not(this).find('i').css("display", "none"); 
   		$(this).find('.fa-long-arrow-down').toggleClass('fa-long-arrow-up');
   	    sortFlights($order,$sortBy,$(this));

	}); 
	
});

function sortFlights($order,$sortBy,curSel) {
    var flights = $('.results .searchbus_box').get();
    // alert(flights); exit;
    flights.sort(function(a,b) {
		if($sortBy=="data-busname") {
			// alert(11);
			// return false;
		    //============= To Check Non Numerical VAlues=====================
		    var keyA = $(a).find('.BusInfoBox').attr($sortBy);
		    var keyB = $(b).find('.BusInfoBox').attr($sortBy);
		} else {
		    //============= To Check Numerical VAlues=========================//
		    // alert(33);
		    // return false;
		    // var keyA = parseInt($(a).find('.BusInfoBox').attr($sortBy));
		    // var keyB = parseInt($(b).find('.BusInfoBox').attr($sortBy));
		    var keyA = parseFloat($(a).find('.BusInfoBox').attr($sortBy), 10);
		    var keyB = parseFloat($(b).find('.BusInfoBox').attr($sortBy), 10);
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
                
      var container=$('.results');    
    // var container = $('.searchbus_box');
    $.each(flights, function(i, ul)
    {
    	// container.append(ul);
	container.append(ul);
	
    });
    
    if($order=="asc")
	curSel.attr("data-order",'desc');                    
    else
	curSel.attr("data-order",'asc');
}