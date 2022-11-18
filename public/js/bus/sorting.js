$(document).ready(function()
{
	$(".FlightSorting").click(function()
	{		
	    $order=$(this).attr("data-order");
	    $sortBy=$(this).attr("rel");
	    sortFlights($order,$sortBy,$(this));
	}); 
	
});

function sortFlights($order,$sortBy,curSel)
{
    var flights = $('.searchbus_box').get();
    flights.sort(function(a,b)
    {
	if($sortBy=="data-busname")
	{
	    //============= To Check Non Numerical VAlues=====================
	    var keyA = $(a).find('.BusInfoBox').attr($sortBy);
	    var keyB = $(b).find('.BusInfoBox').attr($sortBy);
	}
	else
	{
	    //============= To Check Numerical VAlues=========================
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
                
                
    var container = $('.resultOnward');
    $.each(flights, function(i, ul)
    {
		container.append(ul);
    });
    // curSel.find('i.fa').addClass('fa-sort');
    if($order=="asc"){
		curSel.attr("data-order",'desc');
		// curSel.find('i.fa').removeClass('fa-sort');
		curSel.find('i.fa').removeClass('fa-sort-asc');
		curSel.find('i.fa').addClass('fa-sort-desc');
    } else{
		curSel.attr("data-order",'asc');
		// curSel.find('i.fa').removeClass('fa-sort');
		curSel.find('i.fa').removeClass('fa-sort-desc');
		curSel.find('i.fa').addClass('fa-sort-asc');
    }

}
