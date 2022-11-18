$(document).ready(function(){
    var counter = 2;

    $("#addMore_2").click(function () {

	 
	 	$counter = $('#citygroup_1').val(); 
	 	
 		if($counter >= 5)
		{						
			$('#addMore_2').hide();          
            return false;
 		}   

 	var newTextBoxDiv = $(document.createElement('div')).attr("class", 'input_fields_container');
 	//console.log(newTextBoxDiv);
  	newTextBoxDiv.html('<div class="col-md-12 form-group">' +
 	'<input type="text" value="" name="dropofftype[]"  class="form-control text-truncate" placeholder="Destination" autocomplete="off" onclick="this.select();" style="margin-left: -1em;width: 95%;margin-top: 6px;">' +
	
	'<div class="col-md-6 form-group">'+
	'<a href="javascript:void(0);" id="removeCity_1" class="removeCity_1"><b>Remove</b></a></div>');

 	newTextBoxDiv.appendTo("#dynamic_field_1");
     
 		$counter++;	
		
		$('#citygroup_1').val($counter); 	
		
  		$("input[name='dropofftype'],input[name='dropofftype[]']").autocomplete({
		source: siteUrl+"/home/car_city_list",
		minLength: 2,
		autoFocus: true
	});	
		
	});    
  });

  $(document).on('click','.removeCity_1', function() {
	  $counter = $('#citygroup_1').val();
		  	  
       $(this).parent().parent().remove();	  
	  
	  if($counter <= 6)
	  {
		  $counter = $counter-1;
		  $('#addMore_2').fadeIn('fast');
		 
	  }	  
	  
	  $('#citygroup_1').val($counter); 
	   
   });
  
 
   
