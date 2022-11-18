$(document).ready(function() {	

        // define a set of requests to perform - you could also provide each one		
        // var successHandler = function (data) {
        	// alert(1);
        	// if(data.showalert){
        	// 	alert('Return Journey Tickets are not available for the selected destination');
        	// 	window.location.href = siteUrl;
        	// 	exit;
        	// }
					
            // $('#rapid_fire_draft_loading').hide();
            // $('#avail_bus').append(data.bus_search_result);                                          
			
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
					BusTypeString+='<li><label><input type="checkbox" class="bustype_filter" value="'+buscode+'">'+buscode+'</label></li>';
				}
			}			
			for(var bi=0; bi < data_busname.length;bi++)
			{
				var busName=data_busname[bi];
				if(typeof busName == "undefined" && busName=="") {}
				else
				{
					// BusString+='<div class="leftLabels"><span><input class="busname_filter" type="checkbox" value="'+busName+'" checked="checked"> </span><label>'+busName+'</label></div>';
					BusString+='<li><label><input type="checkbox" class="busname_filter" value="'+busName+'">'+busName+'</label></li>';
					
				}				
			}
			
			$(".BusName").html(BusString);
			$(".BusType").html(BusTypeString);
			$(".busname_filter,.bustype_filter, .busdeparture_filter").change(function () {
				var _this = $(this);
				// alert(1);
				filter();
			});				
			setPriceSlider();
			setDepTimeSlider();
			setArrTimeSlider();
			
        // }

        // for (var i = 0, l = api_array.length; i < l; i++) {
        //     $.ajax({
        //         url: siteUrl+'bus/bus_availability',				
        //         data: 'callBackId='+api_array[i],
        //         dataType: 'json',				
        //         type: 'POST',
        //         beforeSend: function()
        //         {
        //             $(".flight-search-cntr").css("display","none");
        //             $('#rapid_fire_draft_loading').show();
        //         },
        //         success: successHandler
        //     });
        // }
        // successHandler
		   
		
        $(".Stop").click(function()
        {
            filter();
        });  
  
          
    });


$(document).on("click", '.AirLine', function ($e) {		
    filter();
});

// flight details open					
$(document).on("click", '.results-row > .FlightInfoBox > .row', function($e){				
    $(this).parents('.results-row').find('.flight-details-Cntr').slideToggle('fast');
    $(this).parents('.results-row').find('.fa-arrow-down').toggleClass('fa-arrow-up');	
});
