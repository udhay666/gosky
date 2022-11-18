$(function() {
	//autolist

     var checkinFj = $('.dp1').datepicker({
        minDate: 0,
        maxDate: '+12M',
        dateFormat: 'dd/mm/yy',
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > checkoutFr.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate());
            checkoutFr.setValue(newDate);
        }
     
        checkinFj.hide();
       // $('#dpf2')[0].focus();
    }).data('datepicker');
    var checkoutFr = $('.dp1').datepicker({
        minDate: 0,
        maxDate: '+12M',
        dateFormat: 'dd/mm/yy',
        onRender: function(date) {
            return date.valueOf() <= checkinFj.date.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        checkoutFr.hide();
    }).data('datepicker');

    searchautolist();
});

$(document).ready(function () {
    $('.quont-minus-m').each(function () {
        $(this).click(function () {
            var $input = $(this).parent().parent().find('input');
            var count = parseInt($input.val()) - 1;
            var count2 = parseInt($input.val());
            var min = $(this).parent().parent().find('input').attr('min');
            var max = $(this).parent().parent().find('input').attr('max');
            // alert(max);
            var adults = $('#adults-m').val();
            var childs = $('#childs-m').val();
            var infants = $('#infants-m').val();            
            count = count < 1 ? min : count;
            // alert(min);
            // alert(count);
            if(count == min) {
                if(min == 1){                  
                    if(parseInt(adults) > min){
                        var tot = parseInt(adults)+parseInt(childs)+parseInt(infants)-parseInt(count);
                        // alert('A1');
                    } else {
                        var tot = parseInt(adults)+parseInt(childs)+parseInt(infants);
                        // alert('A2');
                    }
                } else {
                    if(parseInt(childs) || parseInt(infants) > min){
                        var tot = parseInt(adults)+parseInt(childs)+parseInt(infants)-parseInt(count2);
                        // alert('B1');
                    } else {
                        var tot = parseInt(adults)+parseInt(childs)+parseInt(infants)-parseInt(count);
                        // alert('B2');
                    }  
                }
                
            } else {
                var tot = parseInt(adults)+parseInt(childs)+parseInt(infants)-1;
                // alert('C');
            }
            
            // alert(tot);
            $input.val(count);
            $('#noOfPassengers-m').val(tot);
            $input.change();
            return false;
        });
    });
    $('.quont-plus-m').each(function () {
        $(this).click(function () {
            var $input = $(this).parent().parent().find('input');
            // var count = parseInt($input.val()) + 1;
            var adults = $('#adults-m').val();
            var childs = $('#childs-m').val();
            var infants = $('#infants-m').val();
            var tot = parseInt(adults)+parseInt(childs)+parseInt(infants) + 1;
            // alert(tot);
            if(tot > 9){
                alert('You can select maximum 9 passengers');
                return false;
            }
            $input.val(parseInt($input.val()) + 1);
            $('#noOfPassengers-m').val(tot);
            $input.change();
            return false;
        });
    });

	$('.quont-remove').hide();
    $('.quont-remove').each(function () {
        $(this).click(function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            // var count = $input.val();
            var min = $(this).parent().find('input').attr('min');
            var max = $(this).parent().find('input').attr('max');
            count = count < min ? 1 : count;
            // alert(count);
            /*if(count == 2){
            	$top = 53;
            } else if(count == 3){
            	$top = 103;
            } else if(count == 4){
            	$top = 153;
            }*/
            count2 = parseInt(count)+1;
            if(count <= 4) {
	            $('.quont-add').show();
	        }
	        if(count == min){
	        	$('.quont-remove').hide();
	        } else {
	        	$('.quont-remove').show();
	        }
	        /*if(count == 1){
            	$top = 5;
            } if(count == 2){
            	$top = 53;
            } else if(count == 3){
            	$top = 103;
            } else if(count == 4){
            	$top = 153;
            }
            $('.icons-ar.move-icon').css('top', ''+$top+'px');*/
            
            // if(count < 2){
            $('.div'+count2).remove();
            // }
            // $('#room'+count2).hide();
            // $input2 = $('#room'+count2).find('input')
            // $input2.val(0);
            $input.val(count);
            $input.change();
            return false;
        });
    });
    $('.quont-add').each(function () {
        $(document).on('click','.quont-add', function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val())+1;
            var min = $(this).parent().find('input').attr('min');
            var max = $(this).parent().find('input').attr('max');
            count = count > 5 ? max : count;
            // alert(count);
            // $('#room'+count).show();
           	/*if(count == 1){
            	$top = 5;
            } else if(count == 2){
            	$top = 53;
            } else if(count == 3){
            	$top = 103;
            } else if(count == 4){
            	$top = 153;
            	$('.quont-add').hide();
            }*/
            $('.quont-remove').show();
            if(count < 5){
	            var newTextBoxDiv = $(document.createElement('div')).attr("class", 'row div'+count+'');
				newTextBoxDiv.html('<div class="col-sm-3"><div class="form-group input-icon"><input type="text" class="form-control search-field fromCity" name="fromCity[]" placeholder="From City" title="From City" autocomplete="off" style="background:#FFF;cursor: pointer;"  required /><label for="" style="display: inherit;"><i class="fa fa-map-marker"></i></label></div></div><div class="col-sm-3 padding-8"><div class="input-group input-icon tocity"><input type="text" class="form-control search-field toCity" name="toCity[]" placeholder="To City" title="To City" autocomplete="off" style="background:#FFF;cursor: pointer;" required /><label for="" style="display: inherit;"><i class="fa fa-map-marker"></i></label></div></div><div class="col-sm-2 padding-8"><div class="input-group input-icon" data-date-format="dd-mm-yyyy"><input type="text" name="departDate[]" class="form-control dp" placeholder="Departure" title="Journey Date" data-date-format="dd/mm/yyyy" style="background:#FFF;cursor: pointer;" autocomplete= "off" readonly=""><label for="" style="display: inherit;"><i class="fa fa-calendar"></i></label></div></div>');
	            newTextBoxDiv.appendTo("#extra-new-div");

            	// $('.icons-ar.move-icon').css('top', ''+$top+'px');
        	} else {
	            $('.quont-add').hide();         
	            return false;
	        }
            $input.val(count);
            $input.change();

            /* Clearable flight search input */ 
		    if( $('.fromCity').val() != '' ) $('.fromCity').addClass('x');
		    if( $('.toCity').val() != '' ) $('.toCity').addClass('x');

			// autolist
   			searchautolist(); 

	        var nowTemp = new Date();
	        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
	        var checkinDP = $('.dp').datepicker({
	            dateFormat: "dd/mm/yy",
	          onRender: function(date) {
	            return date.valueOf() < now.valueOf() ? 'disabled' : '';
	          }
	        }).on('changeDate', function(ev) {
	          checkinDP.hide();
	          $('.datepicker').hide();
	        }).data('datepicker');

	        return false;
	    });
    });

    $('.done2-m').on('click', function(){
        var adults = $('#adults-m').val();
        var childs = $('#childs-m').val();
        var infants = $('#infants-m').val();
        var tot = parseInt(adults)+parseInt(childs)+parseInt(infants);
        // alert(tot);
        $('#noOfPassengers-m').val(tot);
    });

    $('.done2-m').on('click', function(){
        $(this).parent().parent().parent().parent().parent('.dropdown-search').css('display', 'none');
    });

});

function searchautolist(){
    $(".fromCity").autocomplete({
      source: siteUrl+"home/flight_source_autolist",
        minLength: 2,
        autoFocus: true
       
    }); 
    $(".toCity").autocomplete({
      source: siteUrl+"home/flight_source_autolist",
        minLength: 2,
        autoFocus: true

    }); 
}

$("input[name='tripType']").change(function(){
	if($(this).val() == 'S'){ 
		$('#O-R-Trip').fadeIn('fast');
		// $('#dpf2Cntr').hide();
		$('#dpf2').prop('disabled', true);
		$('#dpf2').val('');
	    $('#M-Trip').hide();
	    $('.tripTypeVal').val('S');
	}
	if ($(this).val() == 'R'){
		$('#O-R-Trip').fadeIn('fast');
		$('#M-Trip').hide();
		 $('.tripTypeVal').val('R');
		// $('#dpf2Cntr').css('opacity','1');
		// $('#dpf2Cntr').fadeIn('fast');
		$('#dpf2').prop('disabled', false);					
	}
	else if($(this).val() == 'M'){
	    $('#O-R-Trip').hide();
	    $('#M-Trip').fadeIn('fast');
	    $('.tripTypeVal').val('M');
	}
});