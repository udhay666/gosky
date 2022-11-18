$(document).ready(function()
{
	forwardDate();	
	$(".HotelSorting").click(function()
	{	
	    $(this).find('.fa-arrow-down').toggleClass('fa-arrow-up');	
	    $order=$(this).attr("data-order");
	    $sortBy=$(this).attr("rel");
	    //sortHotels($order,$sortBy,$(this));
            
            filter($sortBy,$order);
            
            if($order=="asc")
                $(this).attr("data-order",'desc');                    
            else
                $(this).attr("data-order",'asc');
	   	
	}); 	
	
	$(".StarRating").click(function()
	{
		filter();
	});
	
	$(".Amenities").click(function()
	{
		filter();
	});
        
        $(".hotelNameSearch").click(function()
	{
		filter();
	});
		
	/*$("#hotelName").keyup(function()
	{
        	// Retrieve the input field text and reset the count to zero
        	var filter = $(this).val(), count = 0;
       
        	var regex = new RegExp(filter, "i"); // Create a regex variable outside the loop statement

        	// Loop through the comment list
        	$(".HotelInfoBox").each(function(){			
			
            	// If the list item does not contain the text phrase fade it out
            	if ($(this).attr("data-hotel-name").search(regex) < 0) { // use the variable here
                	$(this).parents(".searchhotel_box").hide();

            	// Show the list item if the phrase matches and increase the count by 1
            	} else {
                	$(this).parents(".searchhotel_box").show();
                	count++;
            	}
        	});
			
			// Update the count
			$("#hotelCount").text(count);
			 //initPagination(count);
			
    	});*/
	
});

function sortHotels($order,$sortBy,curSel)
{
    var hotels = $('.results .searchhotel_box').get();
    hotels.sort(function(a,b)
    {
	if($sortBy=="data-hotel-name")
	{
	    //============= To Check Non Numerical VAlues=====================
	    var keyA = $(a).find('.HotelInfoBox').attr($sortBy);
	    var keyB = $(b).find('.HotelInfoBox').attr($sortBy);
	}
	else
	{
	    //============= To Check Numerical VAlues=========================
	    var keyA = parseFloat($(a).find('.HotelInfoBox').attr($sortBy));
	    var keyB = parseFloat($(b).find('.HotelInfoBox').attr($sortBy));
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
                
                
    var container = $('.results');
    $.each(hotels, function(i, ul)
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
		
		$("#dph1").val($dateString);
		
		document.searchHotels.submit();
		
    });
}
