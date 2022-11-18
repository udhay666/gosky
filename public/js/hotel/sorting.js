$(document).ready(function() {
	// forwardDate();
	$(".HotelSorting").click(function() {
		var sort_icon = $(this).find('i.mdi');
		if(sort_icon.hasClass('mdi-sort-descending')){
			sort_icon.removeClass('mdi-sort-descending');
			sort_icon.addClass('mdi-sort-ascending');
		}else if(sort_icon.hasClass('mdi-sort-ascending')){
			sort_icon.removeClass('mdi-sort-ascending');
			sort_icon.addClass('mdi-sort-descending');
		}
		$('.HotelSorting').removeClass('active');
		$(this).addClass('active');
		// $(this).find('.fa-arrow-down').toggleClass('fa-arrow-up');
		$order=$(this).attr("data-order");
		$sortBy=$(this).attr("rel");
		//sortHotels($order,$sortBy,$(this));
		filter($sortBy,$order);
		if($order=="asc")
			$(this).attr("data-order",'desc');
		else
			$(this).attr("data-order",'asc');
	});

	$(".StarRating").click(function() {
		$(this).parent().parent().toggleClass('active');
		filter();
	});

	$(".Amenities").click(function() {
		filter();
	});

	$(".hotelNameSearch").click(function() {
		filter();
	});
});

function sortHotels($order,$sortBy,curSel) {
	var hotels = $('.results .searchhotel_box').get();
	hotels.sort(function(a,b) {
		if($sortBy=="data-hotel-name") {
			//============= To Check Non Numerical VAlues=====================
			var keyA = $(a).find('.HotelInfoBox').attr($sortBy);
			var keyB = $(b).find('.HotelInfoBox').attr($sortBy);
		} else {
			//============= To Check Numerical VAlues=========================
			var keyA = parseFloat($(a).find('.HotelInfoBox').attr($sortBy));
			var keyB = parseFloat($(b).find('.HotelInfoBox').attr($sortBy));
		}
		if($order=="asc") {
			if (keyA < keyB) return -1;
			if (keyA > keyB) return 1;
		} else {
			if (keyA > keyB) return -1;
			if (keyA < keyB) return 1;
		}
		return 0;
	});
	var container = $('.results');
	$.each(hotels, function(i, ul) {
		container.append(ul);
	});
	if($order=="asc")
		curSel.attr("data-order",'desc');
	else
		curSel.attr("data-order",'asc');
}
function forwardDate() {
	$(".forwardDate").click(function() {
		$searchDate = $(this).attr('data-searchDate');
		$dateStringAry	=	$searchDate.split("-");
		$dateString	=	$dateStringAry[2]+"/"+$dateStringAry[1]+"/"+$dateStringAry[0];
		$("#dph1").val($dateString);
		document.searchHotels.submit();
	});
}