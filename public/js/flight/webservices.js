$(document).ready(function() {
    // alert('adsdd');
    // define a set of requests to perform - you could also provide each one		
    var successHandler = function (data) {
        //alert('dsafdf');		
        $('.loading-content').hide();
        $('#flightsresultss').html(data.flight_search_result);
        // $('#result1').html(data.flight_search_result1);
        //$("#result_count").html(data.total_result); 
        $(".selectedRoundFlights").removeClass("d-none")                     
                  
        // do something			
		 
        $order='asc';
        $sortBy='data-price';
        sortFlights($order,$sortBy,$('.FlightSorting'));
	
        var data_airline=new Array;
        var data_airlineNames=new Array;
				
        var flightCount=0;						
        $(".FlightInfoBox").each(function()
        {
            flightCount++;
            data_airline.push($(this).attr("data-airline"));
            data_airlineNames.push($(this).attr("data-airlinename"));
		
        });	
	 
        $("#flightCount").text(flightCount);	
        $("#flightCount1").text(flightCount);	
	
        var prices = $(".FlightInfoBox").map(function() {
            return parseFloat($(this).attr('data-price'), 10);
        }).get();

        var highest = Math.max.apply(Math, prices);
        var lowest = Math.min.apply(Math, prices);
	      
        if(highest > 0 && lowest > 0)
        {
            $("#setMinPrice").val(lowest);	
            $("#setMaxPrice").val(highest);	
        }
        else
        {
            $("#setMinPrice").val(0);	
            $("#setMaxPrice").val(0);
        }
	
        var durations = $(".FlightInfoBox").map(function() {
            return parseInt($(this).attr('data-duration'), 10);
        }).get();

        var maxDur = Math.max.apply(Math, durations);
        var minDur = Math.min.apply(Math, durations);
	
        if(minDur > 0 && maxDur > 0)
        {
            $("#setMinDuration").val(minDur);	
            $("#setMaxDuration").val(maxDur);
        }
        else
        {
            $("#setMinDuration").val(0);	
            $("#setMaxDuration").val(0);
        }
				
        // Calling PriceSlider & TimeSlider
        setPriceSlider();
        setTimeSlider();
        setDurationSlider();
	 
        data_airline = $.grep(data_airline, function(v, k)
        {			   
            return $.inArray(v ,data_airline) === k;
        });
		
        data_airlineNames = $.grep(data_airlineNames, function(v, k)
        {
            return $.inArray(v ,data_airlineNames) === k;
        });
	
        var AirlineString="";
        for(var ai=0;ai<data_airline.length;ai++)		
        {
            var airlineCode=data_airline[ai];
            var airlineName=data_airlineNames[ai];
            if(typeof airlineCode=="undefined" || airlineCode=="") {}
            else
            {
             //   AirlineString+='<li><input id="AirLine_space" class="AirLine" type="checkbox" value="'+airlineCode+'" checked="checked">&nbsp;<span class="airlines-name">'+airlineName+'</span><!--<span class="airlines-price pull-right"><i class="fa fa-rupee"></i> 23,456</span>--></li>';

                AirlineString+='<li class="airblock"><label class="checkbox-custom checkbox-custom-sm mb-2"><input class="AirLine" type="checkbox" value="'+airlineCode+'" checked="checked"><i></i><span class="airlines-name">'+airlineName+'</span><span class="float-right"></span></label><a href="javascript:;" class="filter_only">Only</a></li>';
            }				
        }
     
        $(".airlines").html(AirlineString);
        $(".onwardRadio:first:visible").trigger("click");
        $(".returnRadio:first:visible").trigger("click");
        $(".priceInfoTotal").html(doTotal());
		
        $(".flight-search-cntr").css("display","block");

        $('.filter_collapse').collapse("show");	
		
    }

    var searcharray=$('#searcharray').val();
    // these will basically all execute at the same time:
    for (var i = 0, l = api_array.length; i < l; i++) 
    {
        $.ajax({
            url: siteUrl+'flights/flights_availabilty',				
            data: 'callBackId='+api_array[i]+'&searcharray='+searcharray,
            dataType: 'json',				
            type: 'POST',
            beforeSend: function()
            {
                $(".flight-search-cntr").css("display","none");
                $('.loading-content').show();
            },
            // success: successHandler
            success: function (data){
                $.ajax({
                    url: siteUrl+'flights/fetch_results', 
                    data: 'searcharray='+searcharray,                          
                    dataType: 'json',               
                    type: 'POST', 
                    beforeSend: function()
                    {
                        $(".flight-search-cntr").css("display","none");
                        $('.loading-content').show();
                    },                         
                    success:  successHandler
                });

            }
		
        });
    }
	   
	
    $(".Stop").on('click', function() {
        filter();
    });
    $(".faretype").on('click', function(){
        filter();
    });
    $(".DepartTime").on('click', function(){

        $('.DepartTime').parent().removeClass('active');
        $(this).parent().addClass('active');
        if($('.DepartTime:checked').length > 1){
            $('.DepartTime:checked').prop('checked',false);
            $(this).prop("checked",true);
        } else{
            $(this).prop("checked",true);
        }
        
        filter();
    });

    
          
});


$(document).on("click", '.AirLine', function ($e) {
    if($('.AirLine:checked').length == $('.AirLine').length){
        $('#show_all').prop('checked',true);
    } else {
        $('#show_all:checked').prop('checked',false);
    }	
    filter();
});

$(document).on("click", '.filter_only', function ($e) {
    // console.log($('.AirLine:checked').length)
    if($('.AirLine:checked').length >= 1){
        $('#show_all:checked').prop('checked',false);
        $('.AirLine:checked').prop('checked',false);
        $(this).parent().find('.AirLine').prop("checked",true);
    } else{
        $('#show_all:checked').prop('checked',false);
        $(this).parent().find('.AirLine').prop("checked",true);
    }
    filter();
});


$(document).on('change','#show_all', function(){
  $('.AirLine').prop('checked', $(this).prop("checked"));
  if($('.AirLine:checked').length == $('.AirLine').length){
    // $('#checkhtml').html('Uncheck All');
  }else{
    // $('#checkhtml').html('Check All');
  }
  filter();
});

$("#reset_filter").click(function() {

    $(".Stop").each(function()
     { $(this).prop('checked', true); });

    $(".AirLine").each(function()
     { $(this).prop('checked', true); });
    $('#show_all').prop('checked',true);

     $(".faretype").each(function()
     { $(this).prop('checked', true); });

    $(".DepartTime").each(function() {
        $(this).prop('checked', true);
        $(this).parent().removeClass('active');
    });

    setPriceSlider();
    // setTimeSlider();

    filter();
    
 });

// flight details open					
/* $(document).on("click", '.results-row > .FlightInfoBox > .row', function($e){				
    $(this).parents('.results-row').find('.flight-details-Cntr').slideToggle('fast');
    $(this).parents('.results-row').find('.fa-arrow-down').toggleClass('fa-arrow-up');	
}); */
$(document).on("click", '.flight-search > li h4', function($e){				
    $(this).parents('li').find('.flight-search-cntr').slideToggle('fast');
    $(this).parents('li').find('.fa-caret-down').toggleClass('fa-caret-right');	
});