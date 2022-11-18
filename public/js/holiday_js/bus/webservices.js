$(document).ready(function()
{	

        // define a set of requests to perform - you could also provide each one		
        var successHandler = function (data) {

        	if(data.showalert){
        		alert('Return Journey Tickets are not available for the selected destination');
        		window.location.href = siteUrl;
        		exit;
        	}

        	$('#rapid_fire_draft_loading').hide();
        	$('#avail_bus').append(data.bus_search_result);                                            

        	var busCount=0;									
        	var data_bustype=new Array;
        	var data_busname=new Array;
        	$(".BusInfoBox").each(function() {
        		busCount++;
                // console.log(11);
        		data_bustype.push($(this).attr("data-bustype"));
        		data_busname.push($(this).attr("data-busname"));

        	});	
        	var prices = $(".BusInfoBox").map(function() {
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
        	if(busCount>1){
        		$("#busCount").text(busCount+' Buses');
            }
        	else{
        		$("#busCount").text(busCount+' Bus');
            }
            // console.log(busCount);
        	data_bustype = $.grep(data_bustype, function(v, k) {
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
					
					BusTypeString+= ' <input class="text-nicelabel" data-nicelabel=\'{"position_class": "text_radio", "checked_text":"'+buscode+'", "unchecked_text": "'+buscode+'"}\' type="checkbox"  value="'+buscode+'" checked="checked"/>';
				}
			}			
			for(var bi=0; bi < data_busname.length;bi++)
			{
				var busName=data_busname[bi];
				if(typeof busName == "undefined" && busName=="") {}
					else
					{
					// BusString+='<div class="leftLabels"><span><input class="busname_filter" type="checkbox" value="'+busName+'" checked="checked"> </span><label>'+busName+'</label></div>';
					BusString+= ' <input class="text-nicelabel" data-nicelabel=\'{"position_class": "text_radio", "checked_text":"'+busName+'", "unchecked_text": "'+busName+'"}\' type="checkbox"  value="'+busName+'" checked="checked"/>';
					
				}				
			}	
			$(".BusName").html(BusString); 			
			$(".BusType").html(BusTypeString); 	
			$('.custom-radio > input').nicelabel();		
			$(".busname_filter,.bustype_filter,.BusType,.BusName").change(function () {
				filter();
			});				
			setPriceSlider();
     
    }

        // these will basically all execute at the same time:
        for (var i = 0, l = api_array.length; i < l; i++) 
        {
        	$.ajax({
        		url: siteUrl+'bus/bus_availability',				
        		data: 'callBackId='+api_array[i],
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


$(document).on("click", '.AirLine', function ($e) {

	filter();
});
