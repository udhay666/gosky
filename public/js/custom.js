// onclick next element focus
function focusObj(obj,ev){
  var windowWidth = $(window).width();
  // alert(windowWidth);
  if(windowWidth > 425){
    if(ev == 'show'){
      obj.show();
    } else{
      obj.focus();
    }
  }
}


$(document).ready(function () {
    //datepicker code

    // var d = new Date();
    // var currDate = d.getDate();
    // var currDate2 = d.getDate()+1;
    // var currMonth = d.getMonth()+1;
    // var currYear = d.getFullYear();

    // var dateStr = currDate + "-" + currMonth + "-" + currYear;
    // var dateStr2 = currDate2 + "-" + currMonth + "-" + currYear;

    // $('#flightDepart,#hotelsCheckIn').val(dateStr);
    // $('#flightReturn,#hotelsCheckOut').val(dateStr2);

    $("input[name='tripType']").change(function(){
        $val = $(this).val();
        // alert($val);
        if($(this).val() == 'S'){
            $('#O-R-Trip').fadeIn('fast');
            // $('#dpf2Cntr').find('input').attr("disabled", true);
            $('#dpf2Cntr').hide();
            $('#multicity').hide();
            $('.tripTypeVal').val('S');
        }
        if($(this).val() == 'R'){

            $('#O-R-Trip').fadeIn('fast');
            $('#dpf2Cntr').fadeIn('fast');
            // $('#dpf2Cntr').find('input').removeAttr('disabled');
            $('#multicity').hide();
            $('.tripTypeVal').val('R');
        }
        else if($(this).val() == 'M'){
          $('#dpf2Cntr').find('input').removeAttr('disabled');
          $('#O-R-Trip').hide();
          $('#multicity').fadeIn('fast');
          $('.tripTypeVal').val('M');
        }
        
    });


});
$(document).ready(function() {
	"use strict";

	// ===========Hover Nav============	
		$('.navbar-nav li.dropdown').on('mouseenter', function(){ $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(500); })
		$('.navbar-nav li.dropdown').on('mouseleave', function(){ $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(500); });
	
	// ===========Select2============	
		$(document).ready(function() {
			$('.select2').select2();
		});

    //datepicker code
    var d = new Date();
    var currDate = d.getDate();
    // var currDate2 = d.getDate()+1;
    // var currDate2 = d.setDate(d.getDate() + 1);
    var nextD = new Date((new Date()).valueOf() + 1000*3600*24);
    var currDate2 = nextD.getDate();
    // console.log(d);
    // console.log(currDate2);
    var currMonth = d.getMonth()+1;
    var currMonth2 = nextD.getMonth()+1;
    var currYear = d.getFullYear();
    var currYear2 = nextD.getFullYear();

    // var dateStr = currDate + "/" + currMonth + "/" + currYear;
    // var dateStr2 = currDate2 + "/" + currMonth + "/" + currYear;
    var dateStr = ('0'+currDate).slice(-2)+'/'+('0'+currMonth).slice(-2) + '/'+currYear;
    var dateStr2 = ('0'+currDate2).slice(-2)+'/'+('0'+currMonth2).slice(-2) + '/'+currYear2;

    var dpf1 = $('#dpf1').val();
    if(dpf1 == ''){
      $('#dpf1').val(dateStr);
    }
    var dpf2 = $('#dpf2').val();
    if(dpf2 == ''){
      // $('#dpf2').val(dateStr2);
    }
   
    var dp = $('.dp').val();
    if(dp == ''){
      $('.dp').val(dateStr);
    }
    
    // Home search top destintions
    $('.top-search').find('a').on('click', function(){
      $(this).parent().find('a').removeClass('active');
      $(this).addClass('active');
      if($('#flights.tab-pane').hasClass('active')){
        var fromCity = $('#fromCity').val();
        var toCity = $('#toCity').val();
        if(fromCity.length != '' && toCity.length == ''){
          $('#toCity').val($(this).html());
        } else {
          $('#fromCity').val($(this).html());
        }
      }
      if($('#hotels.tab-pane').hasClass('active')){
        $('#destination2').val($(this).html());
      }
    });

    // Home Search tab switch
    $('.switch-tab').on('click', function(){
      // console.log($(this).html());
      if($(this).html() == 'Flights'){
        $('.top-search.hotels').hide();
        $('.top-search.flights').fadeIn('fast');
      }else if($(this).html() == 'Hotels'){
        $('.top-search.flights').hide();
        $('.top-search.hotels').fadeIn('fast');
      }
    })

    // back to top
    if ($('#back-top').length) {
        var scrollTrigger = 100, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-top').addClass('show');
                } else {
                    $('#back-top').removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('#back-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }

    

    // Modal over modal
    $('.close-first').click(function(e){
        e.preventDefault();
        var target = $(this).attr('data-target');
        $(this).parents('.modal').modal('hide').on('hidden.bs.modal', function (e) {
          $(target).modal('show');
          if ($('.modal:visible').length) {
            $('body').addClass('modal-open');
            $('body').css('padding-right', '0');
            $(target).css('padding-left', '0');
          }
          $(this).off('hidden.bs.modal'); // Remove the 'on' event binding
        });
    });


    /*var options = [];
    $( '.dropdown-menu.adults-dropdown a' ).on( 'click', function( event ) {
       var $target = $( event.currentTarget ),
           val = $target.attr( 'data-value' ),
           $inp = $target.find( 'input' ),
           idx;
       if ( ( idx = options.indexOf( val ) ) > -1 ) {
          options.splice( idx, 1 );
          setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
       } else {
          options.push( val );
          setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
       }
       $( event.target ).blur();  
       // console.log( options );
       return false;
    });*/

});