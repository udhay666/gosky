$(document).ready(function () {
    
var site_url = $('#siteUrl').val();
    var successHandler = function (data) {
        //alert('dsafdf');		
        $(".loading-content").css("display","none");   
        $("#flightsresults").html(data.flights_search_result);
        $("#flightsresults1").html(data.flights_search_result1);
        $(".selectedRoundFlights").removeClass("d-none");  

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
            return parseInt($(this).attr('data-flightduration'), 10);
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

                // console.log("airline");
                // console.log(airlineCode);
                if(typeof airlineCode=="undefined" || airlineCode=="") {}
                else
                {
                    // var siteUrl2 = site_url+"travelfreebuy.com/";
                    // AirlineString+='<label><input id="AirLine_space" class="AirLine" type="checkbox" value="'+airlineCode+'" >&nbsp;<span class="airlines-name">'+airlineName+'</span><!--<span class="airlines-price pull-right"><i class="fa fa-rupee"></i> 23,456</span>--></label>';
                    AirlineString +=
											'<div class="checkbox"><label><input type="checkbox" name="airline" id="AirLine_space" class="AirLine" value="' +
											airlineCode +
											'" checked><ins></ins><span class="img-wrap"><img src="' +
											site_url +
											"public/AirlineLogo/" +
											airlineCode +
											'.gif"></span><span class="text-wrap airlines-name"> ' +
											airlineName +
											'</span></label> <a href="javascript:;" class="badge-lists filter_only">Only</a></div>';
                }				
            }
            $(".airlines").html(AirlineString);
            $(".onwardRadio:first:visible").trigger("click");
            $(".returnRadio:first:visible").trigger("click");
            $(".priceInfoTotal").html(doTotal());
			
            $(".flight-search-cntr").css("display","block");
    }

    var searcharray = $('#searcharray').val();
    var l = api_array.length;
    
    // var siteUrl = "<?php print site_url(); ?>";
    $i = 0;
    search_availability($i);

    //these will basically execute at the same time:

    function search_availability($a) {
        // alert(api_array[$a]);
        // for (var i = 0, l = api_array.length; i < l; i++) {
            $.ajax({
                url: site_url + 'flights/flights_availabilty',
                data: 'callBackId=' + api_array[$a] + '&searcharray=' + searcharray,
                dataType: 'json',
                type: 'POST',
                success: function (data) {
                    var sess = $('#sessionId').val(data.session_id);
                    $.ajax({
                        url: site_url + 'flights/fetch_results',
                        data: 'searcharray=' + searcharray,
                        dataType: 'json',
                        type: 'POST',
                        beforeSend: function () {
                            // $(".loading-content").css("display","none");                    
                        },
                        success: successHandler
                    });

                },
                error: function (data) {
                    //load_search_results();
                    console.log('456');
                }
            });
        // }
    }

    

        $(document).on("click", '.AirLine', function ($e) {
            if($('.AirLine:checked').length == $('.AirLine').length){
                $('#show_all').prop('checked',true);
                // console.log('456');
            } else {
                $('#show_all:checked').prop('checked',false);
                // console.log('123456');
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
    
        $(".Stop").click(function()
            {
                filter();
                // alert('stop clicked');
            });
    
            $(".faretype").click(function()
            {
                filter();
                // alert('stop clicked');
            });
    
            $(".DepartTime").click(function()
            {
                filter();
                // alert('stop clicked');
            });
    
            $(".ArrivTime").click(function()
            {
                filter();
                // alert('stop clicked');
            });

            $(document).on("click", '.filter_only', function ($e) {
                // console.log($('.AirLine:checked').length)
                if ($('.AirLine:checked').length >= 1) {
                    console.log('tets');
                    $('#show_all:checked').prop('checked',false);
                    $(".AirLine:checked").prop("checked", false);
                    
                    $(this).parent().find('.AirLine').prop("checked",true);
                } else{
                    $('#show_all:checked').prop('checked',false);
                    $(this).parent().find('.AirLine').prop("checked",true);
                }
                filter();
            });
        

});


		