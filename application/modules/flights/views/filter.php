<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<!-- filtering js  -->

<!-- Jquery Slider Js -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/flight/filter.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/flight/sorting.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/flight/sorting_r.js"></script>
<script type="text/javascript">

    $(document).ready(function() 
    {
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
                
                $esl = $(this).attr("data-airline");
                console.log($esl);
			
            });	
		 
            $("#flightCount").text(flightCount);	
            $("#flightCount1").text(flightCount);	
		
            var prices = $(".FlightInfoBox").map(function() {
                return parseFloat($(this).attr('data-price'), 10);
            }).get();

            var highest = Math.max.apply(Math, prices);
            var lowest = Math.min.apply(Math, prices);
		      //alert(highest);alert(lowest);
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

                // console.log("airline");
                // console.log(airlineCode);
                if(typeof airlineCode=="undefined" || airlineCode=="") {}
                else
                {
                    AirlineString+='<label><input id="AirLine_space" class="AirLine" type="checkbox" value="'+airlineCode+'" checked="checked">&nbsp;<span class="airlines-name">'+airlineName+'</span><!--<span class="airlines-price pull-right"><i class="fa fa-rupee"></i> 23,456</span>--></label>';
                }				
            }
            $(".airlines").html(AirlineString);
			
            $(".flight-search-cntr").css("display","block");	
			
    });
	$(document).on("click", '.AirLine', function ($e) {
  			
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
 
		

</script>
<!--  filtering js  -->