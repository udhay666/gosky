$(document).ready(function()
    {	

        // define a set of requests to perform - you could also provide each one		
        var successHandler = function (data) {

        	// if(data.showalert){
        	// 	alert('Return Journey Tickets are not available for the selected destination');
        	// 	window.location.href = siteUrl;
        	// 	exit;
        	// }
					
            $('#rapid_fire_draft_loading').hide();
            // $('#avail_bus').append(data.bus_search_result);                                            
            $('#result').append(data.bus_search_result);                                            
			
			var busCount=0;									
			var data_bustype=new Array;
			var data_busname=new Array;
			$(".BusInfoBox").each(function() {
				busCount++;
				data_bustype.push($(this).attr("data-bustype"));
				data_busname.push($(this).attr("data-busname"));
				
			});	

			var prices = $(".BusInfoBox").map(function() {
				return parseFloat($(this).attr('data-price'), 10);
			}).get();
			var highest = Math.max.apply(Math, prices);
			var lowest = Math.min.apply(Math, prices);			
			if(highest > 0 && lowest > 0) {
				$("#setMinPrice").val(lowest);	
				$("#setMaxPrice").val(highest);	
			}
			else {
				$("#setMinPrice").val(0);	
				$("#setMaxPrice").val(0);
			}		

			var durations = $(".BusInfoBox").map(function() {
            return parseInt($(this).attr('data-depsort'), 10);
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


			
			$("#busCount").text(busCount);
			data_bustype = $.grep(data_bustype, function(v, k)
			{
				return $.inArray(v ,data_bustype) === k;
			});	
			data_busname = $.grep(data_busname, function(v, k)
			{
				return $.inArray(v ,data_busname) === k;
			});
			var BusString=BusTypeString="";
			for(var bi=0; bi < data_bustype.length;bi++)
			{
				var buscode=data_bustype[bi];

				if(typeof buscode !="undefined" || buscode !="") {
					// BusTypeString+='<div class="leftLabels"><span><input class="bustype_filter" type="checkbox" value="'+buscode+'" checked="checked"> </span><label>'+buscode+'</label></div>';
					// BusTypeString+='<li><label><input type="checkbox" class="bustype_filter" value="'+buscode+'">'+buscode+'</label></li>';
                BusTypeString+='<ul style="list-style-type: none;"><li class="airblock"><label class="checkbox-custom checkbox-custom-sm mb-2"><input class="bustype_filter" type="checkbox" value="'+buscode+'"><i></i><span class="bustype">'+buscode+'</span><span class="float-right"></span></label><a href="javascript:;" class="filter_only">Only</a></li></ul>';

				}
			}			
			for(var bi=0; bi < data_busname.length;bi++)
			{
				var busName=data_busname[bi];
				if(typeof busName == "undefined" && busName=="") {}
				else
				{
					// BusString+='<div class="leftLabels"><span><input class="busname_filter" type="checkbox" value="'+busName+'" checked="checked"> </span><label>'+busName+'</label></div>';
					// BusString+='<li><label><input type="checkbox" class="busname_filter" value="'+busName+'">'+busName+'</label></li>';
                BusString+='<ul style="list-style-type: none;"><li class="airblock"><label class="checkbox-custom checkbox-custom-sm mb-2"><input class="busname_filter" type="checkbox" value="'+busName+'" ><i></i><span class="busname">'+busName+'</span><span class="float-right"></span></label><a href="javascript:;" class="filter_only">Only</a></li></ul>';
					
				}				
			}
			
			$(".BusName").html(BusString);
			$(".BusType").html(BusTypeString);
			$(".busname_filter,.bustype_filter, .busdeparture_filter").change(function () {
				var _this = $(this);
				filter(_this);
			});				
			setPriceSlider();
			setDepTimeSlider();
			setArrTimeSlider();
        // do something			
			 
        /*$order='asc';
		$sortBy='data-price';
		sortFlights($order,$sortBy,$('.CarSorting'));*/
		
        /*var data_busname=new Array;
		var data_busnameNames=new Array;
					
		var carCount=0;						
		$(".BusInfoBox").each(function()
		{
			carCount++;
			data_busname.push($(this).attr("data-airline"));
			data_busnameNames.push($(this).attr("data-airlinename"));
			
		});	
		 
		$("#carCount").text(carCount);	
		$("#carCount1").text(carCount);	
		
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
		}*/
									
        // Calling PriceSlider
        //setPriceSlider();
			
        }

        // alert(1);
        var searcharray = $('#searcharray').val();
        // these will basically all execute at the same time:
        	
        for (var i = 0, l = api_array.length; i < l; i++) {
            $.ajax({
                url: siteUrl+'bus/bus_availability',				
                data: 'callBackId='+api_array[i]+'&searcharray='+searcharray,
                dataType: 'json',				
                type: 'POST',
                beforeSend: function()
                {
                    $(".flight-search-cntr").css("display","none");
                    $('#rapid_fire_draft_loading').show();
                },
               success: successHandler
			
            });
        }
		   
		
        $(".Stop").click(function()
        {
            filter();
        });  
  
          
    });


$(document).on("click", '.BusName', function ($e) {
  			
    filter();
});

$(document).on("click", '.BusType', function ($e) {
  			
    filter();
});

// flight details open					
$(document).on("click", '.results-row > .BusInfoBox > .row', function($e){				
    $(this).parents('.results-row').find('.flight-details-Cntr').slideToggle('fast');
    $(this).parents('.results-row').find('.fa-arrow-down').toggleClass('fa-arrow-up');	
});
