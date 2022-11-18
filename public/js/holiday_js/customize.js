$(function(){
    //$('.spl-offers').niceScroll();
    // jQuery('#mycarouselspl').jcarousel({
    //     auto: 3,
    //     wrap: 'last',
    //     scroll: 1
    // });
    // jQuery('#mycarouselspl-2').jcarousel({
    //     auto: 3,
    //     wrap: 'last',
    //     scroll: 1
    // });
    // jQuery('#mycarouselspl-3').jcarousel({
    //     auto: 3,
    //     wrap: 'last',
    //     scroll: 1
    // });
    // jQuery('#mycarousel').jcarousel({
    //     auto: 4,
    //     wrap: 'last',
    //     scroll: 1
    // });
    $('#mobMenu').click(function(){
        $('.mobNav').slideToggle('fast');
    });
    //range slider
    $( "#price-range" ).slider({
        range: true,
        min: 0,
        max: 500,
        values: [ 75, 450 ],
        slide: function( event, ui ) {
            $( "#price-start" ).val( "$" + ui.values[ 0 ]);
            $( "#price-end" ).val("$" + ui.values[ 1 ] );
        }
    });
    $('#time-range').slider({
        range: true,
        min: 0,
        max: 1440,
        step: 15,
        values: [ 0, 1440 ],
        slide: function( event, ui ) {
            var hours1 = Math.floor(ui.values[0] / 60);
            var minutes1 = ui.values[0] - (hours1 * 60);
            if(hours1.length < 10) hours1= '0' + hours;
            if(minutes1.length < 10) minutes1 = '0' + minutes;
            if(minutes1 == 0) minutes1 = '00';
            var hours2 = Math.floor(ui.values[1] / 60);
            var minutes2 = ui.values[1] - (hours2 * 60);
            if(hours2.length < 10) hours2= '0' + hours;
            if(minutes2.length < 10) minutes2 = '0' + minutes;
            if(minutes2 == 0) minutes2 = '00';
            $('#time-start').val(hours1+':'+minutes1);
            $('#time-end').val(hours2+':'+minutes2 );
        }
    });
    $( "#dur-range" ).slider({
        range: true,
        min: 12,
        max: 41,
        values: [ 12, 41 ],
        slide: function( event, ui ) {
            $( "#dur-start" ).val(ui.values[ 0 ] + ' hours');
            $( "#dur-end" ).val(ui.values[ 1 ] + ' hours');
        }
    });
    $( "#rating-range" ).slider({
        range: true,
        min: 0,
        max: 5,
        values: [ 0, 5 ],
        slide: function( event, ui ) {
            $( "#rating-start" ).val('Rating ' + ui.values[ 0 ]);
            $( "#rating-end" ).val('Rating ' + ui.values[ 1 ]);
        }
    });
    $('#return-range').slider({
        range: true,
        min: 0,
        max: 1440,
        step: 15,
        values: [ 0, 1440 ],
        slide: function( event, ui ) {
            var hours1 = Math.floor(ui.values[0] / 60);
            var minutes1 = ui.values[0] - (hours1 * 60);
            if(hours1.length < 10) hours1= '0' + hours;
            if(minutes1.length < 10) minutes1 = '0' + minutes;
            if(minutes1 == 0) minutes1 = '00';
            var hours2 = Math.floor(ui.values[1] / 60);
            var minutes2 = ui.values[1] - (hours2 * 60);
            if(hours2.length < 10) hours2= '0' + hours;
            if(minutes2.length < 10) minutes2 = '0' + minutes;
            if(minutes2 == 0) minutes2 = '00';
            $('#return-start').val(hours1+':'+minutes1);
            $('#return-end').val(hours2+':'+minutes2 );
        }
    });
    $( "#layover-range" ).slider({
        range: true,
        min: 0,
        max: 22,
        values: [ 0, 22 ],
        slide: function( event, ui ) {
            $( "#layover-start" ).val(ui.values[ 0 ] + ' hours');
            $( "#layover-end" ).val(ui.values[ 1 ] + ' hours' );
        }
    });
    $( "#price-start" ).val( "$" + $( "#price-range" ).slider( "values", 0 ));
    $( "#price-end" ).val("$" + $( "#price-range" ).slider( "values", 1 ));
    $( "#time-start" ).val('Any time');
    $( "#time-end" ).val('');
    $( "#dur-start" ).val($( "#dur-range" ).slider( "values", 0 ) + ' hours');
    $( "#dur-end" ).val($( "#dur-range" ).slider( "values", 1 ) + ' hours');
    $( "#rating-start" ).val('Any Rating');
    //$( "#rating-end" ).val(' Rating' + $( "#rating-range" ).slider( "values", 1 ));
    $( "#return-start" ).val('Any time');
    $( "#return-end" ).val('');
    $( "#layover-start" ).val($( "#layover-range" ).slider( "values", 0 ) + ' hours');
    $( "#layover-end" ).val($( "#layover-range" ).slider( "values", 1 ) + ' hours');
    //search accordion
    $('.left-search > li > h4').click(function(){
        $(this).children('i').toggleClass('fa-caret-right')
        $(this).next('div').slideToggle('slow');
    });
    //tabs
    $(".searchtabs > ul > li > a").click(function(e) {
        var activeTab = "#" + $(this).attr("id");
        var activeTabContent = "#tab_content_" + activeTab.substring(1, activeTab.length);
        $(".tab_content").css("display", "none");
        $(activeTabContent).css("display", "block");
        $(".searchtabs > ul > li a").removeClass("active");
        $(activeTab).addClass("active");
        return false;
    });
    //tabs
    $('#myTab a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
    //datepicker code
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    //date picker for Holidays
    var checkinHD = $('#dphd').datepicker({
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        checkinHD.hide();
    }).data('datepicker');
    //date picker for bus
    var checkinB1 = $('#dpb1').datepicker({
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        // checkinB1.hide();
 if (ev.date.valueOf() > checkinB2.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkinB2.setValue(newDate);
        }
        checkinB1.hide();
        $('#dpf2')[0].focus();
    }).data('datepicker');
    var checkinB2 = $('#dpb2').datepicker({
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        // checkinB2.hide();
         if (ev.date.valueOf() < checkinB1.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() - 1);
            checkinB1.setValue(newDate);
        }
        checkinB2.hide();
    }).data('datepicker');
    //date picker for flights
    var checkinF = $('#dpf1').datepicker({
        format: 'dd/mm/yyyy',
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > checkoutF.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkoutF.setValue(newDate);
        }
        checkinF.hide();
        $('#dpf2')[0].focus();
    }).data('datepicker');
    var checkoutF = $('#dpf2').datepicker({
        format: 'dd/mm/yyyy',
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
         if (ev.date.valueOf() < checkinF.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() - 1);
            checkinF.setValue(newDate);
        }
        checkoutF.hide();
    }).data('datepicker');


    // Itenary page datepicker
    var nowTemp2 = new Date();

    nowTemp2.setFullYear(nowTemp2.getFullYear()-12);

    // alert(nowTemp2.getDate());

    var now2 = new Date(nowTemp2.getFullYear(), nowTemp2.getMonth(), nowTemp2.getDate(), 0, 0, 0, 0);
   /* var adob_dp = $('.adob_dp').datepicker({
        startDate: now2,
        onRender: function(date) {
            // alert(date);
            return date.valueOf() > now2.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        adob_dp.hide();
        $('.datepicker').hide();
    }).data('datepicker');
    var nowTemp3 = new Date();
    nowTemp3.setFullYear(nowTemp3.getFullYear()-2);
    var now3 = new Date(nowTemp3.getFullYear(), nowTemp3.getMonth(), nowTemp3.getDate(), 0, 0, 0, 0);
    var cdob_dp = $('.cdob_dp').datepicker({
        onRender: function(date) {
            return date.valueOf() > now3.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        cdob_dp.hide();
        $('.datepicker').hide();
    }).data('datepicker');
    var idob_dp = $('.idob_dp').datepicker({
        onRender: function(date) {
            return date.valueOf() < now3.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        idob_dp.hide();
        $('.datepicker').hide();
    }).data('datepicker');   
    var ppi_dp = $('.ppi_dp').datepicker({
        onRender: function(date) {
            return date.valueOf() > now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        ppi_dp.hide();
        $('.datepicker').hide();
    }).data('datepicker');
    var ppe_dp = $('.ppe_dp').datepicker({
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        ppe_dp.hide();
        $('.datepicker').hide();
    }).data('datepicker'); */




    //date picker for hotels

      var checkinHo = $('#dph1').datepicker({
        format: 'dd/mm/yyyy',
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > checkoutHo.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkoutHo.setValue(newDate);
          
        }
        checkinHo.hide();
        $('#dph2')[0].focus();
    }).data('datepicker');
    var checkoutHo = $('#dph2').datepicker({
        format: 'dd/mm/yyyy',
        onRender: function(date) {
            return date.valueOf() < now.valueOf()+1 ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
         if (ev.date.valueOf() < checkinHo.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() - 1);
            checkinHo.setValue(newDate);
        }
        checkoutHo.hide();
    }).data('datepicker');




// 

   /* var checkinHi = $('#dph1').datepicker({
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > checkoutHo.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkoutHo.setValue(newDate);
        }
        checkinHi.hide();
        $('#dph2')[0].focus();
    }).data('datepicker');
    var checkoutHo = $('#dph2').datepicker({
        onRender: function(date) {
            return date.valueOf() <= now.date.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() < checkinHi.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() - 1);
            checkinHi.setValue(newDate);
        }
        checkoutHo.hide();
    }).data('datepicker'); */

  /*  // date picker for holiday
    var checkinH = $('#dphh1').datepicker({
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > checkoutH.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkoutH.setValue(newDate);
        }
        checkinH.hide();
        $('#dph2')[0].focus();
    }).data('datepicker');
    var checkoutH = $('#dph2').datepicker({
        onRender: function(date) {
            return date.valueOf() <= checkinH.date.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        checkoutH.hide();
    }).data('datepicker');
 var checkincustomdatepicker = $('.customdatepicker').datepicker({
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        checkincustomdatepicker.hide();
    }).data('datepicker');
*/


 // 
    
    $("input[name='car']").change(function(){
        $('.duration label').removeClass('active');
        $(this).parent('label').addClass('active');
        $('#dpb2Cntr').slideToggle(0);
    });
    $("input[name='tripType']").change(function(){
        $('.duration label').removeClass('active');
        $(this).parent('label').addClass('active');
        if($(this).val() == 'S'){
            $('#O-R-Trip').fadeIn('fast');
            $('#dpf2Cntr, #multicity').hide();
        }
        if($(this).val() == 'R'){
            $('#O-R-Trip, #dpf2Cntr').fadeIn('fast');
            $('#multicity').hide();
        }
        else if($(this).val() == 'M'){
            $('#O-R-Trip').hide();
            $('#multicity').fadeIn('fast');
        }
    });
    // flight details open
    $('.details-row, .oneway, .roundtrip').click(function(event){
        if(!$(event.target).hasClass('femail')){
            $(this).parents('.results-row').find('.flight-details-Cntr').slideToggle('fast');
            $(this).parents('.results-row').find('.fa-arrow-down').toggleClass('fa-arrow-up');
        }
    });
    //hotel individual details
    $('.htl-ind-rm-dtls').click( function(){
        $(this).parents('.htl-rm-detail').find('#htl-ind-details').slideToggle(600);
        $(this).find('i').toggleClass('fa-caret-up');
    });
    $('#mod-search-close, #modify-search-btn').click(function(){
        $('.modify-search').slideToggle('fast');
    });
  $("select#room_count").change(function() {
        $total_rooms = $('#total_rooms').val();
        $room = $(this).val();
        for (r = 2; r <= $total_rooms; r++)
        {
            if (r <= $room)
            {
                $('#room' + r).show();
                // $('.flexrow').css('display', 'flex');
                $('#room' + r).addClass('cust-disp');
            //$('#room'+r).fadeIn('fast');
            }
            else if (r > $room)
            {
                 $('#room' + r).removeClass('cust-disp');
                $('#room' + r).hide();
            //$('#room'+r).fadeOut('fast');
            }
        }
    });
        $('.selectchildAge').change(function() {//alert("hi");
            $(this).parents('.flexrow').addClass('cust-disp');
            if ($(this).val() == '1') {
                // $('.row.flexrow').find('.htl-childAge1').removeClass('age1label');
                $(this).parent('.htl-selectChild').parent('.row').find('.htl-age').hide();
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-age').css('visibility', 'hidden');
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-age').css('display', 'block');
                $(this).parent('.htl-selectChild').parent('.row').find('.htl-childAge1').show();
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-childAge1').css('visibility', 'visible');
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-childAge1').css('display', 'block');
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-childAge1').addClass('age1label');
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-childAge2').removeClass('age2label');
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-childAge3').removeClass('age3label');
            }
            if ($(this).val() == '2') {
                // $('.row.flexrow').find('.htl-childAge1').removeClass('age1label');
                // $('.row.flexrow').find('.htl-childAge2').removeClass('age2label');
                $(this).parent('.htl-selectChild').parent('.row').find('.htl-age').hide();
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-age').css('visibility', 'hidden');
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-age').css('display', 'block');
                $(this).parent('.htl-selectChild').parent('.row').find('.htl-childAge1, .htl-childAge2').show();
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-childAge1, .htl-childAge2').css('visibility', 'visible');
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-childAge1, .htl-childAge2').css('display', 'block');
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-childAge1').addClass('age1label');
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-childAge2').addClass('age2label');
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-childAge3').removeClass('age3label');
            }
            if ($(this).val() == '3') {
                // $('.row.flexrow').find('.htl-childAge1').removeClass('age1label');
                // $('.row.flexrow').find('.htl-childAge2').removeClass('age2label');
                // $('.row.flexrow').find('.htl-childAge3').removeClass('age3label');
                $(this).parent('.htl-selectChild').parent('.row').find('.htl-age').show();
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-age').show().css('visibility', 'visible');
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-childAge1').addClass('age1label');
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-childAge2').addClass('age2label');
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-childAge3').addClass('age3label');
            }
            if ($(this).val() == '0') {
                $(this).parent('.htl-selectChild').parent('.row').find('.htl-age').hide();
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-age').css('visibility', 'hidden');
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-age').css('display', 'block');
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-childAge1').removeClass('age1label');
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-childAge2').removeClass('age2label');
                $(this).parent('.htl-selectChild').parent('.row.flexrow').find('.htl-childAge3').removeClass('age3label');
            }
        });
});
// Flighs Search Form on submit call
$(document).on('click','#searchFlightsBtn',function()
{
    $type=$("#tripType:checked").val();
    if($type=='S')
    {
        $("#tripTypeVal").val('S');
    }
    else if($type=='R')
    {
        $("#tripTypeVal").val('R');
    }
    else if($type=='M')
    {
        $("#tripTypeVal").val('M');
    }
$("#offcanvas-toggle-main").on('click', function(){
    // alert(22);
    $('html').toggleClass('open-menu');
});
});