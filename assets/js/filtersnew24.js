function setPriceSlider()
{	
    var setPriceMin	=	parseFloat($("#setMinPrice").val());
    var setPriceMax	=	parseFloat($("#setMaxPrice").val());
    var currency	=	$("#setCurrency").val();
    callPriceSlider(setPriceMin,setPriceMax,currency);
    priceSorting();
}

function callPriceSlider(setPriceMin,setPriceMax,currency)
{
    $selector=$( "#price-range" );
    // $output=$( ".slider-numbers-wrap");
    $setminprice2 = $("#setMinPrice2");
    $setmaxprice2 = $("#setMaxPrice2");
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
                // $output.html('<i class="mdi mdi-currency-inr"></i> '+ ui.values[ 0 ].toLocaleString() + " To <i class='mdi mdi-currency-inr'></i> "+ui.values[ 1 ].toLocaleString() );
                $setminprice2.html('INR '+ ui.values[ 0 ].toLocaleString());
                $setmaxprice2.html('INR '+ ui.values[ 1 ].toLocaleString());
                $minPrice.val(ui.values[0]);
                $maxPrice.val(ui.values[1]);                
            }
        }
    });
    $setminprice2.html('INR '+$selector.slider( "values", 0 ).toLocaleString());
    $setmaxprice2.html('INR '+$selector.slider( "values", 1 ).toLocaleString());
    $minPrice.val($selector.slider( "values",0));
    $maxPrice.val($selector.slider( "values",1));
}

function setTimeSlider()
{
    var setTimeMin=parseInt($("#setMinTime").val());
    var setTimeMax=parseInt($("#setMaxTime").val());
    callTimeSlider(setTimeMin,setTimeMax);
    priceSorting();
}

function callTimeSlider(setTimeMin,setTimeMax)
{
    $selector1=$( "#timeSlider" );
    $output1=$( "#timeSliderOutput");
    $minTime=$("#minTime");
    $maxTime=$("#maxTime");

    $selector1.slider
    ({
        range: true,
        min: setTimeMin,
        max: setTimeMax,
        values: [setTimeMin, setTimeMax],
        slide: function(event, ui)
        {
            if(ui.values[0]+5>=ui.values[1])
            {
                return false;
            }
            else
            {
                var hours1 = Math.floor(ui.values[0] / 60);
                var minutes1 = ui.values[0] - (hours1 * 60);				
				
                if (hours1.toString().length == 1) hours1 = '0' + hours1;
                if (minutes1.toString().length == 1) minutes1 = '0' + minutes1;
                if (minutes1 == 0) minutes1 = '00';
                if (hours1 >= 12) {
                    if (hours1 == 12) {
                        hours1 = hours1;
                        minutes1 = minutes1 + " PM";
                    } else if (hours1 == 24) {
                        hours1 = 11;
                        minutes1 = "59 PM";
                    } else {
                        hours1 = hours1 - 12;
                        minutes1 = minutes1 + " PM";
                    }
                } else {
                    hours1 = hours1;
                    minutes1 = minutes1 + " AM";
                }
                if (hours1 == 0) {
                    hours1 = 12;
                    minutes1 = minutes1;
                }
                if (hours1.toString().length == 1) hours1 = '0' + hours1;
		
                var hours2 = Math.floor(ui.values[1] / 60);
                var minutes2 = ui.values[1] - (hours2 * 60);
				
                if (hours2.toString().length == 1) hours2 = '0' + hours2;
                if (minutes2.toString().length == 1) minutes2 = '0' + minutes2;
                if (minutes2 == 0) minutes2 = '00';
                if (hours2 >= 12) {
                    if (hours2 == 12) {
                        hours2 = hours2;
                        minutes2 = minutes2 + " PM";
                    } else if (hours2 == 24) {
                        hours2 = 11;
                        minutes2 = "59 PM";
                    } else {
                        hours2 = hours2 - 12;
                        minutes2 = minutes2 + " PM";
                    }
                } else {
                    hours2 = hours2;
                    minutes2 = minutes2 + " AM";
                }
				
                if (hours2.toString().length == 1) hours2 = '0' + hours2;
						
                $output1.html(hours1+':'+minutes1+' To '+hours2+':'+minutes2);
                $("#minTime").val(ui.values[0]);
                $("#maxTime").val(ui.values[1]);		
            }
			
        }
		
    });    
   
    var hours1 = Math.floor($selector1.slider( "values", 0 )/60);
    var minutes1 = $selector1.slider( "values", 0 ) - (hours1 * 60);

    if (hours1.toString().length == 1) hours1 = '0' + hours1;
    if (minutes1.toString().length == 1) minutes1 = '0' + minutes1;
    if (minutes1 == 0) minutes1 = '00';
    if (hours1 >= 12) {
        if (hours1 == 12) {
            hours1 = hours1;
            minutes1 = minutes1 + " PM";
        } else if (hours1 == 24) {
            hours1 = 11;
            minutes1 = "59 PM";
        } else {
            hours1 = hours1 - 12;
            minutes1 = minutes1 + " PM";
        }
    } else {
        hours1 = hours1;
        minutes1 = minutes1 + " AM";
    }
    if (hours1 == 0) {
        hours1 = 12;
        minutes1 = minutes1;
    }

    var hours2 = Math.floor($selector1.slider( "values", 1 )/60);
    var minutes2 = $selector1.slider( "values", 1 ) - (hours2 * 60);

    if (hours2.toString().length == 1) hours2 = '0' + hours2;
    if (minutes2.toString().length == 1) minutes2 = '0' + minutes2;
    if (minutes2 == 0) minutes2 = '00';
    if (hours2 >= 12) {
        if (hours2 == 12) {
            hours2 = hours2;
            minutes2 = minutes2 + " PM";
        } else if (hours2 == 24) {
            hours2 = 11;
            minutes2 = "59 PM";
        } else {
            hours2 = hours2 - 12;
            minutes2 = minutes2 + " PM";
        }
    } else {
        hours2 = hours2;
        minutes2 = minutes2 + " AM";
    }
	
    $output1.html(hours1+':'+minutes1+' To '+hours2+':'+minutes2);
    $minTime.val($selector1.slider( "values",0));
    $maxTime.val($selector1.slider( "values",1));

}

function setDurationSlider()
{	
    var setDurationMin	=	parseInt($("#setMinDuration").val());
    var setDurationMax	=	parseInt($("#setMaxDuration").val());   
    callDurationSlider(setDurationMin,setDurationMax);
    priceSorting();
}

function callDurationSlider(setDurationMin,setDurationMax)
{
    $selector2=$( "#duration-range" );
    // $output2=$( "#durationSliderOutput" );
    $setMinDuration2 = $("#setMinDuration2");
    $setMaxDuration2 = $("#setMaxDuration2");
    $minDuration=$("#minDuration");
    $maxDuration=$("#maxDuration");
    $selector2.slider
    ({
        range: true,
        min: setDurationMin,
        max: setDurationMax,
        values: [setDurationMin, setDurationMax],
        slide: function(event, ui)
        {           				
            var hours1 = Math.floor(ui.values[0] / 60);			
            var hours2 = Math.floor(ui.values[1] / 60);	
            
            var minutes1 = ui.values[0] - (hours1 * 60);
            var minutes2 = ui.values[1] - (hours2 * 60);	
			
            // $output2.html(hours1+' hrs To '+hours2+' hrs');	
            $setMinDuration2.html(hours1+'h '+minutes1+'m');		
            $setMaxDuration2.html(hours2+'h '+minutes2+'m');		
            $("#minDuration").val(ui.values[0]);
            $("#maxDuration").val(ui.values[1]);	                
            
        }
    });  
	
    var hours11 = Math.floor($selector2.slider( "values", 0 )/60);		
    var hours21 = Math.floor($selector2.slider( "values", 1 )/60);

    var minutes11 = $selector2.slider( "values", 0 ) - (hours11 * 60);
    var minutes21 = $selector2.slider( "values", 1 ) - (hours21 * 60);
	
    // $output2.html(hours11+' hrs To '+hours21+' hrs');
    $setMinDuration2.html(hours11+'h '+minutes11+'m');		
    $setMaxDuration2.html(hours21+'h '+minutes21+'m');
    $minDuration.val($selector2.slider( "values",0));
    $maxDuration.val($selector2.slider( "values",1));
	
	
}

function priceSorting()
{
    $(".ui-slider").bind( "slidestop", function() 
    {		
        filter();
    });
}

function filter()
{    
    $minPr	=	parseFloat($("#minPrice").val());
    $maxPr	=	parseFloat($("#maxPrice").val());
    $minTime=	parseInt($("#minTime").val());
    $maxTime=	parseInt($("#maxTime").val());
    $minDuration=	parseInt($("#minDuration").val());
    $maxDuration=	parseInt($("#maxDuration").val());
		
    $stops=new Array;
    $AirLine=new Array;
    $faretype= new Array;
    $departCheck= new Array;
    $arrivCheck= new Array;

    $(".Stop:checked").each(function()
    {
        if($(this).prop("checked") == true) {
            $stopNum=$(this).val();
            $stops.push($stopNum); 
            
            
            // alert('stop');
            }
    });

    $(".faretype:checked").each(function()
    {
        if($(this).prop("checked") == true) {
            $farenum=$(this).val();
            $faretype.push($farenum); 
            }
    });

    //dout
    $(".AirLine:checked").each(function()
    {
        // console.log('checkok');
          if($(this).prop("checked") == true) {
        $airlineName=$(this).val();
        $AirLine.push($airlineName);
          }
    });

    $(".DepartTime:checked").each(function()
    {
        if($(this).prop("checked") == true) {
            $departNum = $(this).val();
            $departCheck.push($departNum); 
            }
    });

    $(".ArrivTime:checked").each(function()
    {
        if($(this).prop("checked") == true) {
            $arrivNum = $(this).val();
            $arrivCheck.push($arrivNum); 
            }
    });
$searcharray=$('#searcharray').val();
$sessionId = $("#sessionId").val();
  $.post(siteUrl+"flights/searchresult_ajax", { sessionId: ""+$sessionId, minPrice: ""+$minPr, maxPrice: ""+$maxPr,AirLine: ""+$AirLine, refund: ""+$faretype, departCheck: ""+$departCheck, arrivCheck: ""+$arrivCheck, stops: ""+$stops, maxDuration: ""+$maxDuration, minDuration: ""+$minDuration, searcharray: ""+$searcharray},
    function(data){
        $('.ajaxloading').hide();
        $('#flightsresults').html(data.flight_search_result);
      
    }, 'json');


}

