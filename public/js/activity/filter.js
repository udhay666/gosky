/*
 jQuery UI Slider 
 */

function setPriceSlider()
{    
    var setPriceMin    =    parseFloat($("#setMinPrice").val());
    var setPriceMax    =    parseFloat($("#setMaxPrice").val());
    var currency    =    $("#setCurrency").val();
    callPriceSlider(setPriceMin,setPriceMax,currency);
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
                $output.html('<i class="mdi mdi-currency-inr"></i> '+ ui.values[ 0 ].toLocaleString() + " To <i class='mdi mdi-currency-inr'></i> "+ui.values[ 1 ].toLocaleString() );
                $minPrice.val(ui.values[0]);
                $maxPrice.val(ui.values[1]);                
            }
        }
    });
    $output.html('<i class="mdi mdi-currency-inr"></i> '+$selector.slider( "values", 0 ).toLocaleString() + " To <i class='mdi mdi-currency-inr'></i> "+ $selector.slider( "values",1).toLocaleString() );
    $minPrice.val($selector.slider( "values",0));
    $maxPrice.val($selector.slider( "values",1));
}

// function setTimeSlider()
// {
//     var setTimeMin=parseInt($("#setMinTime").val());
//     var setTimeMax=parseInt($("#setMaxTime").val());
//     callTimeSlider(setTimeMin,setTimeMax);
//     priceSorting();
// }

// function callTimeSlider(setTimeMin,setTimeMax)
// {
//     $selector1=$( "#timeSlider" );
//     $output1=$( "#timeSliderOutput");
//     $minTime=$("#minTime");
//     $maxTime=$("#maxTime");
    
//     $selector1.slider
//     ({
//         range: true,
//         min: setTimeMin,
//         max: setTimeMax,
//         values: [setTimeMin, setTimeMax],
//         slide: function(event, ui)
//         {
//             if(ui.values[0]+5>=ui.values[1])
//             {
//                 return false;
//             }
//             else
//             {
//                 var hours1 = Math.floor(ui.values[0] / 60);
//                 var minutes1 = ui.values[0] - (hours1 * 60);                
                
//                 if (hours1.toString().length == 1) hours1 = '0' + hours1;
//                 if (minutes1.toString().length == 1) minutes1 = '0' + minutes1;
//                 if (minutes1 == 0) minutes1 = '00';
//                 if (hours1 >= 12) {
//                     if (hours1 == 12) {
//                         hours1 = hours1;
//                         minutes1 = minutes1 + " PM";
//                     } else if (hours1 == 24) {
//                         hours1 = 11;
//                         minutes1 = "59 PM";
//                     } else {
//                         hours1 = hours1 - 12;
//                         minutes1 = minutes1 + " PM";
//                     }
//                 } else {
//                     hours1 = hours1;
//                     minutes1 = minutes1 + " AM";
//                 }
//                 if (hours1 == 0) {
//                     hours1 = 12;
//                     minutes1 = minutes1;
//                 }
//                 if (hours1.toString().length == 1) hours1 = '0' + hours1;
        
//                 var hours2 = Math.floor(ui.values[1] / 60);
//                 var minutes2 = ui.values[1] - (hours2 * 60);
                
//                 if (hours2.toString().length == 1) hours2 = '0' + hours2;
//                 if (minutes2.toString().length == 1) minutes2 = '0' + minutes2;
//                 if (minutes2 == 0) minutes2 = '00';
//                 if (hours2 >= 12) {
//                     if (hours2 == 12) {
//                         hours2 = hours2;
//                         minutes2 = minutes2 + " PM";
//                     } else if (hours2 == 24) {
//                         hours2 = 11;
//                         minutes2 = "59 PM";
//                     } else {
//                         hours2 = hours2 - 12;
//                         minutes2 = minutes2 + " PM";
//                     }
//                 } else {
//                     hours2 = hours2;
//                     minutes2 = minutes2 + " AM";
//                 }
                
//                 if (hours2.toString().length == 1) hours2 = '0' + hours2;
                        
//                 $output1.html(hours1+':'+minutes1+' To '+hours2+':'+minutes2);
//                 $("#minTime").val(ui.values[0]);
//                 $("#maxTime").val(ui.values[1]);        
//             }
            
//         }
        
//     });    
   
//     var hours1 = Math.floor($selector1.slider( "values", 0 )/60);
//     var minutes1 = $selector1.slider( "values", 0 ) - (hours1 * 60);

//     if (hours1.toString().length == 1) hours1 = '0' + hours1;
//     if (minutes1.toString().length == 1) minutes1 = '0' + minutes1;
//     if (minutes1 == 0) minutes1 = '00';
//     if (hours1 >= 12) {
//         if (hours1 == 12) {
//             hours1 = hours1;
//             minutes1 = minutes1 + " PM";
//         } else if (hours1 == 24) {
//             hours1 = 11;
//             minutes1 = "59 PM";
//         } else {
//             hours1 = hours1 - 12;
//             minutes1 = minutes1 + " PM";
//         }
//     } else {
//         hours1 = hours1;
//         minutes1 = minutes1 + " AM";
//     }
//     if (hours1 == 0) {
//         hours1 = 12;
//         minutes1 = minutes1;
//     }

//     var hours2 = Math.floor($selector1.slider( "values", 1 )/60);
//     var minutes2 = $selector1.slider( "values", 1 ) - (hours2 * 60);

//     if (hours2.toString().length == 1) hours2 = '0' + hours2;
//     if (minutes2.toString().length == 1) minutes2 = '0' + minutes2;
//     if (minutes2 == 0) minutes2 = '00';
//     if (hours2 >= 12) {
//         if (hours2 == 12) {
//             hours2 = hours2;
//             minutes2 = minutes2 + " PM";
//         } else if (hours2 == 24) {
//             hours2 = 11;
//             minutes2 = "59 PM";
//         } else {
//             hours2 = hours2 - 12;
//             minutes2 = minutes2 + " PM";
//         }
//     } else {
//         hours2 = hours2;
//         minutes2 = minutes2 + " AM";
//     }
    
//     $output1.html(hours1+':'+minutes1+' To '+hours2+':'+minutes2);
//     $minTime.val($selector1.slider( "values",0));
//     $maxTime.val($selector1.slider( "values",1));
    
    
// }

function setDurationSlider()
{    
    var setDurationMin    =    parseInt($("#setMinDuration").val());
    var setDurationMax    =    parseInt($("#setMaxDuration").val());   
    callDurationSlider(setDurationMin,setDurationMax);
    priceSorting();
}

function callDurationSlider(setDurationMin,setDurationMax)
{
    $selector2=$( "#durationSlider" );
    $output2=$( "#durationSliderOutput" );
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
            
            $output2.html(hours1+' hrs To '+hours2+' hrs');            
            $("#minDuration").val(ui.values[0]);
            $("#maxDuration").val(ui.values[1]);                    
            
        }
    });  
    
    var hours11 = Math.floor($selector2.slider( "values", 0 )/60);        
    var hours21 = Math.floor($selector2.slider( "values", 1 )/60);
    
    $output2.html(hours11+' hrs To '+hours21+' hrs');
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
    // alert(1);
    $minPr    =    parseFloat($("#minPrice").val());
    $maxPr    =    parseFloat($("#maxPrice").val());
    $vehicles=new Array;
    $(".vehicle:checked").each(function()
    {
        $vehicle=$(this).val();
        console.log($vehicle);
        $vehicles.push($vehicle);
    });
    
    var vehicleCount=0;
        $('.ActivityInfoBox').each(function()
        {
            $datavehicle=$(this).attr("data-vehiclecode");
            // console.log($vehicles);
            // console.log($datavehicle);
            $dataprice=parseFloat($(this).attr("data-price"));
         // console.log($dataprice);
            var vehicleShow=$.inArray($datavehicle,$vehicles)>=0?true:false;

         // console.log(vehicleShow);
                   
            //alert($dataprice); alert($datadeparture);alert(stopShow);alert(airlineShow);alert(refundShow);
            // if(($dataprice <= $maxPr && $dataprice >=  $minPr) && ($datadeparture<=$maxTime && $datadeparture>=$minTime) && stopShow && airlineShow && refundShow) {
            if(($dataprice <= $maxPr && $dataprice >=  $minPr) && vehicleShow )
            {
                vehicleCount++;
                $(this).parents(".searchactivity_box").show();
            }
            else
            {
                $(this).parents(".searchactivity_box").hide();
            }
            
        });    
    $("#vehicleCount").text(vehicleCount);        
    if(vehicleCount <= 0){
        $('.displayMsg').html('<div class="col-md-12"><div class="error" style="text-align:center;border: 1px solid #A1A1A1;border-radius: 5px;margin: 5px 0;">No result found for your given filter criteria. Please make another search.</div></div>');
    } else{
        $('.displayMsg').html('');
    }
}

