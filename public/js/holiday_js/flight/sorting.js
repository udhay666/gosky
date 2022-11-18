$(document).ready(function()
{
	$(".FlightSorting").click(function()
	{	console.log('testing');
		$(this).find('.fa-arrow-down').toggleClass('fa-arrow-up');
		$order=$(this).attr("data-order");
		$sortBy=$(this).attr("rel");
		sortFlights($order,$sortBy,$(this));
            //filter($sortBy,$order);
            if($order=="asc")
            	$(this).attr("data-order",'desc');
            else
            	$(this).attr("data-order",'asc');

        });	

	$(".FlightSorting1").click(function()
	{	console.log('testing');
		$(this).find('.fa-arrow-down').toggleClass('fa-arrow-up');
		$order=$(this).attr("data-order");
		$sortBy=$(this).attr("rel");
		sortFlightsr1($order,$sortBy,$(this));
            //filter($sortBy,$order);
            if($order=="asc")
            	$(this).attr("data-order",'desc');
            else
            	$(this).attr("data-order",'asc');

        });	

	$(".FlightSorting_r").click(function()
	{	console.log('testing');
		$(this).find('.fa-arrow-down').toggleClass('fa-arrow-up');
		$order=$(this).attr("data-order");
		$sortBy=$(this).attr("rel");
		sortFlightsr2($order,$sortBy,$(this));
            //filter($sortBy,$order);
            if($order=="asc")
            	$(this).attr("data-order",'desc');
            else
            	$(this).attr("data-order",'asc');

        });	
	
	
});
function sortFlightsr2($order,$sortBy,curSel)
{
	
var flights = $('.resultreturn .searchflight_box1').get();
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


var container = $('.resultreturn');
$.each(flights, function(i, ul)
{
	container.append(ul);
});


if($order=="asc")
	curSel.attr("data-order",'desc');                    
else
	curSel.attr("data-order",'asc');

}

function sortFlightsr1($order,$sortBy,curSel)
{ //alert('asd');

var flights = $('.resultOnward .searchflight_box').get();
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


function sortFlights($order,$sortBy,curSel)
{ //alert('asd');

var flights = $('.resultOnward1 .searchflight_box1').get();
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


var container = $('.resultOnward1');
$.each(flights, function(i, ul)
{
	container.append(ul);
});


if($order=="asc")
	curSel.attr("data-order",'desc');                    
else
	curSel.attr("data-order",'asc');
}

