/*
#################################### jQuery UI Slider #######################################
### 											  ###
###  Programmed By: PRASANNA, PRASANNAVVET@GMAIL.COM                                        	  ###
###  Powered By   :Travelpd.com, Bangalore, India.                         				  ###
### 											  ###
### ====================================================================================  ###
###  Copy this code to your application and call "setPriceSlider() function in  ready     ###
###  state.                                                                               ###
### 											  ###	
###	::  Necessary hidden calls from integration page ::                                   ###
###	Ex: <input type="hidden" id="setMinPrice" value="10" />                               ###
###         <input type="hidden" id="setMaxPrice" value="700" />                          ###
###         <input type="hidden" id="setCurrency" value="INR" />                          ###
### 											  ###
#############################################################################################
*/

function setPriceSlider()
{	
    var setPriceMin=parseInt($("#setMinPrice").val());
    var setPriceMax=parseInt($("#setMaxPrice").val());
    // var currency=$("#setCurrency").val();
    var currency    =  "₹";
    callPriceSlider(setPriceMin,setPriceMax,currency);
    priceSorting();
}

function callPriceSlider(setPriceMin,setPriceMax,currency)
{
    $selector=$( "#priceSlider" );
    $output=$( "#priceSliderOutput");
    $minPrice=$("#minPrice");
    $maxPrice=$("#maxPrice");
    $minPrice2=$("#minPrice2");
    $maxPrice2=$("#maxPrice2");
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
                $output.html(currency+' '+ ui.values[ 0 ] + "  To  "+currency+' '+ui.values[ 1 ] );
                $minPrice.val(ui.values[0]);
                $maxPrice.val(ui.values[1]);  
                $minPrice2.html(currency+' '+ui.values[0]);
                $maxPrice2.html(currency+' '+ui.values[1]);              
            }
        }
    });
    
    // $output.html(+$selector.slider( "values", 0 ) + " To "+ $selector.slider( "values",1) );
    $output.html(currency+' '+$selector.slider( "values", 0 ) + "  To  "+currency+' '+ $selector.slider( "values",1) );
    $minPrice.val($selector.slider( "values",0));
    $maxPrice.val($selector.slider( "values",1));
    $minPrice2.html(currency+' '+$selector.slider( "values",0));
    $maxPrice2.html(currency+' '+$selector.slider( "values",1));
}

function setTimeSlider()
{
    var setTimeMin=parseInt($("#setMinTime").val());
    var setTimeMax=parseInt($("#setMaxTime").val());
    callTimeSlider(setTimeMin,setTimeMax);
    priceSorting();
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
// alert($sortBy+" "+$order); 
$minPr=parseInt($("#minPrice").val());
$maxPr=parseInt($("#maxPrice").val());

    //$stops=new Array;
    $BusName=new Array;
    $BusType=new Array;
    $FareRule=new Array;
    /* 
    $(".Stop:checked").each(function()
    {
        $stopNum=$(this).val();
        $stops.push($stopNum); 
    }); */ 
    
    // $(".busname_filter:checked").each(function()
    // { //alert('asd');
    //     $busName=$(this).val();
    //     $BusName.push($busName);
    // });

    $(".BusName").find('.text-nicelabel:checked').each(function()
    {
        $busName=$(this).val();
        $BusName.push($busName);
    });
    //   $(".bustype_filter:checked").each(function()
    // { 
    //     $busType=$(this).val();
    //     $BusType.push($busType);
    // });
    $(".BusType").find('.text-nicelabel:checked').each(function()
    {
       $busType=$(this).val();
       $BusType.push($busType);
   });
    
    /* $(".FareRule:checked").each(function()
    {
        $FareRule.push($(this).val());
    }); */
    var busCount=0;
    $(".BusInfoBox").each(function()
    {

      $databusname=$(this).attr("data-busname");
      $databustype=$(this).attr("data-bustype");
      $dataprice=parseInt($(this).attr("data-price"));

      var busShow=$.inArray($databusname, $BusName)>=0?true:false;
      var busShow1=$.inArray($databustype, $BusType)>=0?true:false;


      if(($dataprice<=$maxPr && $dataprice>=$minPr) && busShow && busShow1)
       {   
         busCount++;
         $(this).parents(".searchbus_box").show();             
        }         
        else
         {
        $(this).parents(".searchbus_box").hide();
       }

});  
    if(busCount>1)
        $("#busCount").text(busCount+' Buses');
    else
        $("#busCount").text(busCount+' Bus');

    $("#flightCount").text(busCount);
    
    $(".onwardRadio:visible:first,.returnRadio:visible:first").attr("checked","checked");
    $(".onwardRadio:visible:first").trigger("click");
    $(".returnRadio:visible:first").trigger("click");
    
    //triggerFirstFlights();

    //sortingbusresult($sortBy,$order);

}

