$(document).ready(function()
    {	
       //alert("test");
        // define a set of requests to perform - you could also provide each one		
        var successHandler = function(data) {
        //alert(data);		
        $('#rapid_fire_draft_loading').hide();
        $('#result').html(data.car_search_result);
        //console.log(data);
        // $('#result1').html(data.flight_search_result1);
        //$("#result_count").html(data.total_result); 
        // $(".selectedRoundFlights").removeClass("d-none")                     
                  
        // do something			
		 
        $order='asc';
        $sortBy='data-price';
        // sortFlights($order,$sortBy,$('.FlightSorting'));
	
        var data_vehicle=new Array;
        var data_vehiclecode=new Array;
				
        var transferCount=0;						
        $(".CarInfoBox").each(function()
        {
        	
        	var data= $(this).attr("data-vehicle");

        	// console.log(data);
            transferCount++;
            data_vehicle.push($(this).attr("data-vehicle"));
            data_vehiclecode.push($(this).attr("data-vehiclecode"));
		
        });	
	 
        $("#transferCount").text(transferCount);	
        // $("#flightCount1").text(flightCount);	
	
        var prices = $(".CarInfoBox").map(function() {
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
	
        var durations = $(".CarInfoBox").map(function() {
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
				
        // // Calling PriceSlider & TimeSlider
        setPriceSlider();
        // // setTimeSlider();
        setDurationSlider();
	 
        data_vehicle = $.grep(data_vehicle, function(v, k)
        {		
        	// alert(data_vehicle);	   
            return $.inArray(v ,data_vehicle) === k;
        });
		
        data_vehiclecode = $.grep(data_vehiclecode, function(v, k)
        {
            return $.inArray(v ,data_vehiclecode) === k;
        });
	
        var VehicleString="";
        for(var ai=0;ai<data_vehicle.length;ai++)		
        {
            var vehicleCode=data_vehiclecode[ai];
            var vehicleName=data_vehicle[ai];
            if(typeof vehicleCode=="undefined" || vehicleCode=="") {}
            else
            {
             //   AirlineString+='<li><input id="AirLine_space" class="AirLine" type="checkbox" value="'+airlineCode+'" checked="checked">&nbsp;<span class="airlines-name">'+airlineName+'</span><!--<span class="airlines-price pull-right"><i class="fa fa-rupee"></i> 23,456</span>--></li>';

                VehicleString+='<span class="airblock"><label class="checkbox-custom checkbox-custom-sm mb-2"><input class="vehicle" type="checkbox" value="'+vehicleCode+'" checked="checked"><i></i><span class="vehicle-name">'+vehicleName+'</span><span class="float-right"></span></label></span>';
            }				
        }
     // console.log(VehicleString);
        $(".vehicles").html(VehicleString);
        // $(".onwardRadio:first:visible").trigger("click");
        // $(".returnRadio:first:visible").trigger("click");
        // $(".priceInfoTotal").html(doTotal());
		
        // $(".flight-search-cntr").css("display","block");

        // $('.filter_collapse').collapse("show");	
		
    }

        // alert(1);
        var searcharray = $('#searcharray').val();
        // these will basically all execute at the same time:
        	
        for (var i = 0, l = api_array.length; i < l; i++) {
            $.ajax({
                url: siteUrl+'car/car_availability',				
                data: 'callBackId='+api_array[i]+'&searcharray='+searcharray,
                dataType: 'json',				
                type: 'POST',
                beforeSend: function()
                {
                    $(".flight-search-cntr").css("display","none");
                    $('#rapid_fire_draft_loading').show();
                },

                // success: successHandler
				success: function (data){ //console.log(data);
                $.ajax({
                    url: siteUrl+'car/fetch_results', 
                    data: 'searcharray='+searcharray,                          
                    dataType: 'json',               
                    type: 'POST', 
                    beforeSend: function()
                    {
                        $(".flight-search-cntr").css("display","none");
                        $('#rapid_fire_draft_loading').show();
                    },                         
                    success:  successHandler
                });

            }
            });
        }
		   
		
        // $(".Stop").click(function()
        // {
        //     filter();
        // });  
  
        
          
    });


$(document).on("click", '.vehicle', function ($e) {
   // alert("chknig");
  			
    filter();
});

// flight details open					
$(document).on("click", '.results-row > .TranferInfoBox > .row', function($e){				
    $(this).parents('.results-row').find('.flight-details-Cntr').slideToggle('fast');
    $(this).parents('.results-row').find('.fa-arrow-down').toggleClass('fa-arrow-up');	
});
