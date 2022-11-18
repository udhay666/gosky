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

function callPriceSlider(setPriceMin,setPriceMax,currency)
{
    $selector=$( "#priceSlider" );
    $output=$( "#priceSliderOutput");
    $outputmax=$( "#priceSliderOutputmax");
    
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
                $output.html('<i class="fa fa-rupee"></i> '+ ui.values[ 0 ].toLocaleString());
                $outputmax.html("<i class='fa fa-rupee'></i> "+ui.values[ 1 ].toLocaleString());
                $minPrice.val(ui.values[0]);
                $maxPrice.val(ui.values[1]);                
            }
        }
    });
    $output.html('<i class="fa fa-rupee"></i> '+$selector.slider( "values", 0 ).toLocaleString());
    $outputmax.html("<i class='fa fa-rupee'></i> "+ $selector.slider( "values",1).toLocaleString());
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
    $output1=$( "#timeSliderOutputMin");
    $output1max=$( "#timeSliderOutputMax");
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
						//alert(hours1);alert(minutes1);
                $output1.html(hours1+':'+minutes1);
                $output1max.html(hours2+':'+minutes2);
                //$output1.html(hours1+':'+minutes1+' To '+hours2+':'+minutes2);
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
    //alert(hours1);alert(minutes1);
	$output1.html(hours1+':'+minutes1);
    $output1max.html(hours2+':'+minutes2);
    //$output1.html(hours1+':'+minutes1+' To '+hours2+':'+minutes2);
    $minTime.val($selector1.slider( "values",0));
    $maxTime.val($selector1.slider( "values",1));	
}

function setTimeSlider_arr()
{
    var setTimeMin=parseInt($("#setMinTime").val());
    var setTimeMax=parseInt($("#setMaxTime").val());
    callTimeSlider_arr(setTimeMin,setTimeMax);
    priceSorting();
}

function callTimeSlider_arr(setTimeMin,setTimeMax)
{
    $selector1=$( "#timeSlider_arr" );
    $output1a=$( "#timeSliderOutputMina");
    $output1maxa=$( "#timeSliderOutputMaxa");
    $minTimea=$("#minTimea");
    $maxTimea=$("#maxTimea");
    
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
                        
                $output1a.html(hours1+':'+minutes1);
                $output1maxa.html(hours2+':'+minutes2);
                
                $("#minTimea").val(ui.values[0]);
                $("#maxTimea").val(ui.values[1]);        
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
    
    $output1a.html(hours1+':'+minutes1);
    $output1maxa.html(hours2+':'+minutes2);
    //$output1.html(hours1+':'+minutes1+' To '+hours2+':'+minutes2);
    $minTimea.val($selector1.slider( "values",0));
    $maxTimea.val($selector1.slider( "values",1));   
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
    $selector2=$( "#durationSlider" );
    $output2=$( "#durationSliderOutputMin");
    $output2max=$( "#durationSliderOutputMax");
    
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
			
            //$output2.html(hours1+' hrs To '+hours2+' hrs');
            $output2.html(hours1+' hrs');
            $output2max.html(hours2+' hrs');			
            $("#minDuration").val(ui.values[0]);
            $("#maxDuration").val(ui.values[1]);	                
            
        }
    });  
	
    var hours11 = Math.floor($selector2.slider( "values", 0 )/60);		
    var hours21 = Math.floor($selector2.slider( "values", 1 )/60);
	
    //$output2.html(hours11+' hrs To '+hours21+' hrs');
    $output2.html(hours11+' hrs');
    $output2max.html(hours21+' hrs');            
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
    $minTimea=   parseInt($("#minTimea").val());
    $maxTimea=   parseInt($("#maxTimea").val());
    $minDuration=	parseInt($("#minDuration").val());
    $maxDuration=	parseInt($("#maxDuration").val());
		
    $stops=new Array;
    $AirLine=new Array;
    $faretype= new Array;
    $Dairport=new Array;
    $topairline='';
        
    $(".Stop:checked").each(function()
    {
        $stopNum=$(this).val();
        $stops.push($stopNum); 
    });
    $(".faretype:checked").each(function()
    {
        $farenum=$(this).val();
        $faretype.push($farenum); 
    });
    //alert($faretype);
    $(".AirLine:checked").each(function()
    {
        $airlineName=$(this).val();
        $AirLine.push($airlineName);
    });
     $(".Dairport:checked").each(function()
    {
        $departName=$(this).val();
        $Dairport.push($departName);
    });
    
    var flightCount=0;
	    
    $sort_data = 'data-price';
    $sort_order = 'asc';
    if(typeof $sortBy !== 'undefined' && typeof $order !== 'undefined')
    {
        $sort_data = $sortBy;
        $sort_order = $order;
    } 
    $(".topairline:checked").each(function()
       {
        $topairline=$(this).val();
      });     
    $('.ajaxloading').show();
    $.post(siteUrl+"flights/searchresult_ajaxint", { sessionId: ""+$sessionId, minPrice: ""+$minPr, maxPrice: ""+$maxPr, stops: ""+$stops, airlines: ""+$AirLine, minTime: ""+$minTime, maxTime: ""+$maxTime, sortBy: ""+$sort_data, order: ""+$sort_order, topairline: ""+$topairline, faretype: ""+$faretype, minTimea: ""+$minTimea, maxTimea: ""+$maxTimea }, 
        
        function(data){
            $('.ajaxloading').hide();
            $('#result').html(data.flights_search_result);
            $('#result1').html(data.flights_search_result1);
            $('#pagination_up').html(data.paging);
            $('#pagination_down').html(data.paging); 
            
        }, 'json');       

    //alert(flightCount);
    $("#flightCount1").html(flightCount);        
	
}

$(".forwardDate").click(function()
    {
        $searchDate = $(this).attr('data-searchDate');
       
        $dateStringAry  =   $searchDate.split("-");
        $dateString =   $dateStringAry[2]+"/"+$dateStringAry[1]+"/"+$dateStringAry[0];
        
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

$(".forwardDateret").click(function()
    {
        $searchDate = $(this).attr('data-searchDate');
       
        $dateStringAry  =   $searchDate.split("-");
        $dateString =   $dateStringAry[2]+"/"+$dateStringAry[1]+"/"+$dateStringAry[0];
        
       $("#dpf2").val($dateString);
     
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
