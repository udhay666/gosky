$('.accommodation-select').click(function (e) { 
	$adults=0;
    $childs=0;
 	$childswithoutbed=0;
 	$infants=0;
 	$room_count=parseInt($('#rooms-q').val());
 	$single=0;
 	$twin=0;
 	$triple=0;
 	$room_no=0;
 	var room_arr=[];
 	$arrivaldate=$('#departureDate').val();
 	if($arrivaldate=='')
 	{
 		alert("Select Arrival Date");
 		$('#departureDate').focus();
 		return false;
 	}
 	$accom_type=$(this).val();
 	$holiday_id=$('#holiday_id').val();  
 
    if(!$(this).is(':checked')) {
  $('#priceheader').html(' <i class="fa fa-rupee"></i> '+'0');
                        $('#showaccom').hide();   
                        $('#accom').html('');
                        $('#showarrdate').hide();
                        $('#showdepartdate').hide();
                        $('#arrival').html('');
                        $('#subprice').html('<i class="fa fa-rupee"></i> '+'0');
                         $('#countid').hide();
                        $('#ad_count').html('');
                        $('#ch_count').html('');
                        $('#in_count').html('');
                     
                        // set input field
                        $('#adults_no').val('1');
                        $('#childs_no').val('0');
                        $('#childswithoutbedbed_no').val('0');
                        $('#infants_no').val('0');
                        $('#single_no').val('1');
                        $('#twin_no').val('0');
                        $('#triple_no').val('0');
                        $('#accom_type').val('');
                        $('#room_arr').val('');
                        $('#room_counts').val('');
                        $('#arrival_date').val('');
                        $('#depart_date').val('');
                        $('#total_cost').val('0');
                       
                    
  }
  else{
 	$('.accommodation-select').not(this).prop('checked', false);  
    $(".passdetails").each(function()
	{ 

		$adult=0;$child=0;$childwithoutbed=0;$infant=0;
		$adult=isNaN(parseInt($(this).find("input[name='adults[]']").val())) ? 0 : parseInt($(this).find("input[name='adults[]']").val());
        $child=isNaN(parseInt($(this).find("input[name='childs[]']").val())) ? 0 : parseInt($(this).find("input[name='childs[]']").val());
		$childwithoutbed=isNaN(parseInt($(this).find("input[name='childswithoutbed[]']").val())) ? 0 : parseInt($(this).find("input[name='childswithoutbed[]']").val());
		$infant=isNaN(parseInt($(this).find("input[name='infants[]']").val())) ? 0 : parseInt($(this).find("input[name='infants[]']").val());
		$adults+=$adult;
        $childs+=$child;
		$childswithoutbed+=$childwithoutbed;
		$infants+=$infant;
		if(($adult+$child)==1)
		{
		 	room_arr.push({
            type: 'single', 
            adults: $adult,
            childs:$child,
            childswithoutbed:$childwithoutbed,
            infants: $infant
        }); 
			$single+=1;	
		}
		if(($adult+$child)==2)
		{
			room_arr.push({
            type: 'twin', 
            adults: $adult,
            childs:$child,
            childswithoutbed:$childwithoutbed,
            infants: $infant
        }); 
			
			$twin+=1;	
		}
		if(($adult+$child)==3)
		{
			room_arr.push({
            type: 'triple', 
            adults: $adult,
            childs:$child,
            childswithoutbed:$childwithoutbed,
            infants: $infant
        });
			$triple+=1;	
		}
	 });

     $.ajax({
                url: siteUrl + 'holiday/pricecal',
                data: 'adults=' + $adults+
                '&childs='+$childs+
                '&childswithoutbed='+$childswithoutbed+
                '&infants='+$infants+
                '&room_count='+$room_count+
                '&single='+$single+
                '&twin='+$twin+
                '&triple='+$triple+
                '&accom_type='+$accom_type+
                '&arrivaldate='+$arrivaldate+
                '&holiday_id='+$holiday_id+
                '&room_arr='+JSON.stringify(room_arr),
                dataType: 'json',
                type: 'POST',
                success: function(data)
                {                   
                    if (data.results == 'success')
                    {   
                        var m_names = new Array("Jan", "Feb", "Mar", 
                                    "Apr", "May", "Jun", "Jul", "Aug", "Sep", 
                                    "Oct", "Nov", "Dec");
                        var numdays=parseInt($('#duration').val());
                        var arrivaldatet=data.arrivaldate;
                        var t=arrivaldatet.split('-');
                        var t2=m_names.indexOf(t[1]);
                        var depart = new Date(t[2],t2,t[0]);
                        depart.setDate(depart.getDate() + (numdays-1));
                        var departdatestr=depart.getDate()+"-"+m_names[depart.getMonth()]+"-"+depart.getFullYear();                    
                        $('#priceheader').html(' <i class="fa fa-rupee"></i> '+data.priceheader);
                    	$('#showaccom').show();   
                        $('#accom').html(data.accom_type);
                        $('#showarrdate').show();
                        $('#arrival').html(data.arrivaldate);                     
                        $('#showdepartdate').show();
                        $('#depart').html(departdatestr);
                        $('#subprice').html(' <i class="fa fa-rupee"></i> '+data.priceheader);
                         $('#countid').show(); rm_count
                        $('#ad_count').html(data.adults_no);
                        $('#ch_count').html(data.childs_no);
                        $('#ch1_count').html(data.childswithoutbed_no);
                        $('#in_count').html(data.infants_no);
                        $('#rm_count').html(data.room_counts);
                     
                        // set input field
                        $('#adults_no').val(data.adults_no);
                        $('#childs_no').val(data.childs_no);
                        $('#childswithoutbed_no').val(data.childswithoutbed_no);
                        $('#infants_no').val(data.infants_no);
                        $('#single_no').val(data.single_room);
                        $('#twin_no').val(data.twin_room);
                        $('#triple_no').val(data.triple_room);
                        $('#accom_type').val(data.accom_type);
                        $('#room_arr').val(data.room_arr);
                        $('#room_counts').val(data.room_counts);
                        $('#arrival_date').val(data.arrivaldate);
                        $('#depart_date').val(departdatestr);
                        $('#total_cost').val(data.sub_total);

                    }
                  
                }
            });
 }
 
});

$('.accommodation-selectfull').click(function () {  
$(this).find("input[type='radio']").prop('checked','checked');
$(this).find(".accommodation-select").triggerHandler('click');
});

 