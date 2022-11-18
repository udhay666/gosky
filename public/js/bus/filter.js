/*
#################################### jQuery UI Slider #######################################
###                                                                                       ###
###  Programmed By: PRASANNA, PRASANNAVVET@GMAIL.COM                                      ###
###  Powered By   :Travelpd.com, Bangalore, India.                                        ###
###                                                                                       ###
### ====================================================================================  ###
###  Copy this code to your application and call "setPriceSlider() function in  ready     ###
###  state.                                                                               ###
###                                                                                       ###   
### ::  Necessary hidden calls from integration page ::                                   ###
### Ex: <input type="hidden" id="setMinPrice" value="10" />                               ###
###         <input type="hidden" id="setMaxPrice" value="700" />                          ###
###         <input type="hidden" id="setCurrency" value="INR" />                          ###
###                                                                                       ###
#############################################################################################
*/

function setPriceSlider()
{   
    var setPriceMin=parseInt($("#setMinPrice").val());
    var setPriceMax=parseInt($("#setMaxPrice").val());
    var currency=$("#setCurrency").val();
    callPriceSlider(setPriceMin,setPriceMax,currency);
    priceSorting();
}

function callPriceSlider(setPriceMin,setPriceMax,currency) {
    $selector=$( "#priceSlider" );
    $output=$( "#priceSliderOutput");
    // $MinOutput=$( "#minpriceSliderOutput");
    // $MaxOutput=$( "#maxpriceSliderOutput");
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
                // $output.html(+ ui.values[ 0 ] + " to "+ui.values[ 1 ] );
                // $MinOutput.html(currency+' '+ ui.values[ 0 ]);
                // $MaxOutput.html(currency+' '+ui.values[ 1 ]);
                $output.html('<i class="mdi mdi-currency-inr"></i>'+ ui.values[ 0 ] .toLocaleString() + " To <i class='mdi mdi-currency-inr'></i>"+ui.values[ 1 ].toLocaleString() );
                $minPrice.val(ui.values[0]);
                $maxPrice.val(ui.values[1]);                
            }
        }
    });
    
    // $output.html(+$selector.slider( "values", 0 ) + " To "+ $selector.slider( "values",1) );
    // $MinOutput.html(currency+' '+$selector.slider( "values", 0 ));
    // $MaxOutput.html(currency+' '+$selector.slider( "values",1));
    $output.html('<i class="mdi mdi-currency-inr"></i>'+ $selector.slider("values", 0 ) .toLocaleString() + " To <i class='mdi mdi-currency-inr'></i>"+$selector.slider("values", 1).toLocaleString() );
    $minPrice.val($selector.slider( "values",0));
    $maxPrice.val($selector.slider( "values",1));
}

function setDepTimeSlider()
{
    var setTimeMin=parseInt($("#setMinTime").val(), 10);
    var setTimeMax=parseInt($("#setMaxTime").val(), 10);
    callDepTimeSlider(setTimeMin,setTimeMax);
    priceSorting();
}

function callDepTimeSlider(setTimeMin,setTimeMax)
{ 
    $selectorDep=$("#DepTimeSlider");
    $minDepOutput=$("#minDepTimeSliderOutput");
    $maxDepOutput=$("#maxDepTimeSliderOutput");
    $minDepTime=$("#minDepTime");
    $maxDepTime=$("#maxDepTime");
    // console.log($minDepTime);
    // console.log($maxDepTime);
    $selectorDep.slider
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
                // alert(hours1);alert(minutes1);
                // console.log(hours1);
                // console.log(hours2);
                $minDepOutput.html(hours1+':'+minutes1);
                $maxDepOutput.html(hours2+':'+minutes2);
                //$output1.html(hours1+':'+minutes1+' To '+hours2+':'+minutes2);
                $("#minDepTime").val(ui.values[0]);
                $("#maxDepTime").val(ui.values[1]);        
            }

        }

    });    

    var hours1 = Math.floor($selectorDep.slider( "values", 0 )/60);
    var minutes1 = $selectorDep.slider( "values", 0 ) - (hours1 * 60);

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

    var hours2 = Math.floor($selectorDep.slider( "values", 1 )/60);
    var minutes2 = $selectorDep.slider( "values", 1 ) - (hours2 * 60);

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
    $minDepOutput.html(hours1+':'+minutes1);
    $maxDepOutput.html(hours2+':'+minutes2);
    //$output1.html(hours1+':'+minutes1+' To '+hours2+':'+minutes2);
    $minDepTime.val($selectorDep.slider( "values",0));
    $maxDepTime.val($selectorDep.slider( "values",1));   
}

function setArrTimeSlider()
{
    var setTimeMin=parseInt($("#setMinTime").val(), 10);
    var setTimeMax=parseInt($("#setMaxTime").val(), 10);
    callArrTimeSlider(setTimeMin,setTimeMax);
    priceSorting();
}

function callArrTimeSlider(setTimeMin,setTimeMax)
{ 
    $selectorArr=$("#ArrTimeSlider");
    $minArrOutput=$("#minArrTimeSliderOutput");
    $maxArrOutput=$("#maxArrTimeSliderOutput");
    $minArrTime=$("#minArrTime");
    $maxArrTime=$("#maxArrTime");
    //console.log($minArrTime);
    
    $selectorArr.slider
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
                // alert(hours1);alert(minutes1);
                // console.log(hours1);
                // console.log(hours2);
                $minArrOutput.html(hours1+':'+minutes1);
                $maxArrOutput.html(hours2+':'+minutes2);
                //$output1.html(hours1+':'+minutes1+' To '+hours2+':'+minutes2);
                $("#minArrTime").val(ui.values[0]);
                $("#maxArrTime").val(ui.values[1]);        
            }

        }

    });    

    var hours1 = Math.floor($selectorArr.slider( "values", 0 )/60);
    var minutes1 = $selectorArr.slider( "values", 0 ) - (hours1 * 60);

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

    var hours2 = Math.floor($selectorArr.slider( "values", 1 )/60);
    var minutes2 = $selectorArr.slider( "values", 1 ) - (hours2 * 60);

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
    $minArrOutput.html(hours1+':'+minutes1);
    $maxArrOutput.html(hours2+':'+minutes2);
    //$output1.html(hours1+':'+minutes1+' To '+hours2+':'+minutes2);
    $minArrTime.val($selectorArr.slider("values",0));
    $maxArrTime.val($selectorArr.slider("values",1));   
}



function priceSorting(){
    $(".ui-slider").bind( "slidestop", function() {
        filter();
    });
}

function filter() {
    // alert(1);
    // $minPr=parseInt($("#minPrice").val());
    // $maxPr=parseInt($("#maxPrice").val());
    $minPr=parseFloat($("#minPrice").val(), 10);
    $maxPr=parseFloat($("#maxPrice").val(), 10);

    $minDep=parseInt($("#minDepTime").val(), 10);
    $maxDep=parseInt($("#maxDepTime").val(), 10);

    $minArr=parseInt($("#minArrTime").val(), 10);
    $maxArr=parseInt($("#maxArrTime").val(), 10);

    // console.log($minDep);
    // console.log($maxDep);
    // console.log($("#MinArrTime").val());
    // console.log($maxArr);
    //$stops=new Array;
    $BusName=new Array;
    $BusType=new Array;
    $BusDeparture=new Array;
    $BusArrival=new Array;
    $FareRule=new Array;
    // console.log($BusDeparture);
    
    $(".busname_filter:checked").each(function() {
        $busName=$(this).val();
        $BusName.push($busName);

    });
    $(".bustype_filter:checked").each(function() { 
        $busType=$(this).val();
        $BusType.push($busType);
    });
    
    $(".busdeparture_filter:checked").each(function() { 
        $busdeparture = $(this).val();
        $minDep = $(this).attr('data-depsort');
        $maxDep = $(this).attr('data-depsort');
        $BusDeparture.push($busdeparture);
    });
    console.log($busdeparture);

    /* $(".FareRule:checked").each(function()
    {
        $FareRule.push($(this).val());
    }); */

    $showallType=false;$showallbus=false;
    if($BusName.length==0){
     $showallbus=true; 
 }
 if($BusType.length==0){
     $showallType=true; 
 }
//console.log($showallbus);console.log($BusType);
 var busCount=0;
 $(".BusInfoBox").each(function() {
        // alert('asd');
        $databusname=$(this).attr("data-busname");
        $databustype=$(this).attr("data-bustype");
        $databusdeparture = parseInt($(this).attr("data-depsort"), 10);
        $databusarrival = parseInt($(this).attr("data-arrsort"), 10);
        $dataprice = parseFloat($(this).attr("data-price"), 10);
            // console.log($databusdeparture);

        if($showallbus==false){ 
            // console.log($showallbus);
            var BusNameShow = $.inArray($databusname, $BusName)>=0?true:false;
        }else{
            var BusNameShow=true;
        }
        if($showallType==false){
            // console.log($BusType);
            var BusTypeShow = $.inArray($databustype, $BusType)>=0?true:false;
        }else{
            var BusTypeShow=true;
        }

        var BusDepartureShow = $.inArray($databusdeparture, $BusDeparture)>=0?true:false;
        // console.log(BusDepartureShow);
        // if(($dataprice<=$maxPr && $dataprice>=$minPr) && BusNameShow && BusTypeShow && ($databusdeparture<=$maxDep && $databusdeparture>=$minDep) && ($databusarrival<=$maxArr && $databusarrival>=$minArr)) {
        //     busCount++;
        //      // console.log(1);
        //      $(this).parents(".searchbus_box").show();
        //  }
        //  else {
        //     // console.log(2);
        //     $(this).parents(".searchbus_box").hide();
        // }
        
        if(($dataprice<=$maxPr && $dataprice>=$minPr) && BusNameShow  && BusTypeShow) {
            busCount++;
             // console.log(1);
             $(this).parents(".searchbus_box").show();
         }
         else {
            // console.log(2);
            $(this).parents(".searchbus_box").hide();
        }
    });

 $("#flightCount").text(busCount);

    // $(".onwardRadio:visible:first,.returnRadio:visible:first").attr("checked","checked");
    // $(".onwardRadio:visible:first").trigger("click");
    // $(".returnRadio:visible:first").trigger("click");
    
    //triggerFirstFlights();
    
}

