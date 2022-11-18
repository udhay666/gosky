/*
 jQuery UI Slider 
 */

function setPriceSlider()
{	
    var setPriceMin	=	parseFloat($("#setMinPrice").val());
    var setPriceMax	=	parseFloat($("#setMaxPrice").val());
    var currency	=	$("#setCurrency").val();
    callPriceSlider(setPriceMin,setPriceMax,currency);
    priceSorting();
}

function setTripRatingSlider()
{	
    var setRatingMin	=	parseInt($("#setMinRating").val());
    var setRatingMax	=	parseInt($("#setMaxRating").val());
   
    callTripRatingSlider(setRatingMin,setRatingMax);
    priceSorting();
}

function callPriceSlider(setPriceMin,setPriceMax,currency)
{
    $selector=$( "#priceSlider" );
    $output=$( "#priceSliderOutput");
    $minPrice=$("#minPrice");
    $maxPrice=$("#maxPrice");
    $selector.slider
    ({
        range: true,
        min: setPriceMin,
        max: setPriceMax,
        values: [setPriceMin, setPriceMax],
        slide: function(event, ui)
        {
            if(ui.values[0]+20>=ui.values[1])
            {
                return false;
            }
            else
            {                
                $output.html(currency+' '+ ui.values[ 0 ] + "  To  "+currency+' '+ui.values[ 1 ] );
                $minPrice.val(ui.values[0]);
                $maxPrice.val(ui.values[1]);                
            }
        }
    });
    
    $output.html(currency+' '+$selector.slider( "values", 0 ) + "  To  "+currency+' '+ $selector.slider( "values",1) );
    $minPrice.val($selector.slider( "values",0));
    $maxPrice.val($selector.slider( "values",1));
}

function callTripRatingSlider(setRatingMin,setRatingMax)
{
    $selector1=$( "#tripRatingSlider" );
    $output1=$( "#tripRatingSliderOutput");
    $minRating=$("#minRating");
    $maxRating=$("#maxRating");
    $selector1.slider
    ({
        range: true,
        min: setRatingMin,
        max: setRatingMax,
        values: [setRatingMin, setRatingMax],
        slide: function(event, ui)
        {
            $output1.html(ui.values[ 0 ] + "  To  "+ui.values[ 1 ] );
			$("#minRating").val(ui.values[0]);
			$("#maxRating").val(ui.values[1]);
        }
    });
    
    $output1.html($selector1.slider( "values", 0 ) + "  To  "+$selector1.slider( "values",1) );
    $minRating.val($selector1.slider( "values",0));
    $maxRating.val($selector1.slider( "values",1));
}

function priceSorting()
{
    $(".ui-slider").bind( "slidestop", function() 
    {		
        filter();
    });
}

function filter($sortBy,$order)
{
    $('.ajaxloading').show();
    
    $minPr	=	parseFloat($("#minPrice").val());
    $maxPr	=	parseFloat($("#maxPrice").val());
	
    $minRt	=	parseInt($("#minRating").val());
    $maxRt	=	parseInt($("#maxRating").val());
    
    $hotelName	=	$("#hotelName").val();
    
    //$api	=	$("#api").val();
    $sessionId	=	$("#sessionId").val();
   
    $stars=new Array;	
    $(".StarRating:checked").each(function()
    {
        $starNum=$(this).val();
        $stars.push($starNum); 
    });
	
    /*$fac=new Array;	
    $(".Amenities:checked").each(function()
    {
        $facVal=$(this).val();
        $fac.push($facVal); 
    });*/
	
    $areas=new Array;	
    $(".Areas:checked").each(function()
    {
        $areasVal=$(this).val();
        $areas.push($areasVal); 
    });    
	
	//alert($areas);	
	
   /* var hotelCount=0;
    $(".HotelInfoBox").each(function()
    {		
        $dataprice=parseFloat($(this).attr("data-price"));
		$datarating=parseInt($(this).attr("data-trip-rating"));
		
		$datastar=$(this).attr("data-star");		
		var starShow=$.inArray($datastar, $stars)>=0?true:false;
		
		$dataarea=$(this).attr("data-location");		
		var areaShow=$.inArray($dataarea, $areas)>=0?true:false;
		
		$datafac = $(this).attr("data-facilities");
		$facarray = $datafac.split(',');
			
		$facShow = false;
		for (var i=0; i<($facarray.length-1); i++)
		{
			if($.inArray($facarray[i], $fac)>=0) 
			{
				$facShow = true;
        	}
		}
        	
		
        if(($dataprice<=$maxPr && $dataprice>=$minPr) && ($datarating<=$maxRt && $datarating>=$minRt) && starShow  && $facShow && areaShow)
        {
			hotelCount++;
            $(this).parents(".searchhotel_box").show();
        }
        else
        {
            $(this).parents(".searchhotel_box").hide();
        }
		
    });  
	
	$("#hotelCount").text(hotelCount);  
	 //initPagination(hotelCount);      */
    
        $starShow =  $stars;        
        if($stars.length === 0)
        {
            $starShow = '';
        }
        
        $locationShow =  $areas;        
        if($areas.length === 0)
        {
            $locationShow = '';
        }
        
        $sort_data = 'data-price';
        $sort_order = 'asc';
        if(typeof $sortBy !== 'undefined' && typeof $order !== 'undefined')
        {
            $sort_data = $sortBy;
            $sort_order = $order;
        }
         
         
       $.post(siteUrl+"hotels/searchresult_ajax", { sessionId: ""+$sessionId, minPrice: ""+$minPr, maxPrice: ""+$maxPr, starRating: ""+$starShow, hotelName: ""+$hotelName, location: ""+$locationShow, sortBy: ""+$sort_data, order: ""+$sort_order }, 
                    
                    function(data){
                        $('.ajaxloading').hide();
			$('#avail_hotels').html(data.hotels_search_result);
                        $('#pagination_up').html(data.paging);
                        $('#pagination_down').html(data.paging); 
                        
                     }, 'json');
	
}
