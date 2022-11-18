
    // function setPriceSlider()
    // {	
    //     var setPriceMin	=	parseFloat($("#setMinPrice").val());
    //     var setPriceMax	=	parseFloat($("#setMaxPrice").val());
    //     var currency	=	$("#setCurrency").val();
    //     callPriceSlider(setPriceMin,setPriceMax,currency);
    //     priceSorting();
    // }
    
    // function callPriceSlider(setPriceMin,setPriceMax,currency)
    // {
    //     $selector=$( "#priceSlider" );
    //     $output=$( "#priceSliderOutput");
    //     $minPrice=$("#minPrice");
    //     $maxPrice=$("#maxPrice");
    //     $selector.slider
    //     ({
    //         range: true,
    //         min: setPriceMin,
    //         max: setPriceMax,
    //         values: [setPriceMin, setPriceMax],
    //         slide: function(event, ui)
    //         {
    //             if(ui.values[0]+20>=ui.values[1])
    //             {
    //                 return false;
    //             }
    //             else
    //             {                
    //                 $output.html('<i class="mdi mdi-currency-inr"></i> '+ ui.values[ 0 ].toLocaleString() + " To <i class='mdi mdi-currency-inr'></i> "+ui.values[ 1 ].toLocaleString() );
    //                 $minPrice.val(ui.values[0]);
    //                 $maxPrice.val(ui.values[1]);                
    //             }
    //         }
    //     });
    //     $output.html('<i class="mdi mdi-currency-inr"></i> '+$selector.slider( "values", 0 ).toLocaleString() + " To <i class='mdi mdi-currency-inr'></i> "+ $selector.slider( "values",1).toLocaleString() );
    //     $minPrice.val($selector.slider( "values",0));
    //     $maxPrice.val($selector.slider( "values",1));
    // }




$(document).ready(function() {


    // var  minVal1 = document.getElementById('price-mi'). value;
    // var maxVal1 = document.getElementById('price-ma'). value;
    // var  minVal=minVal1;
    // var maxVal =maxVal1;
    var successHandler = function (data) {
        //alert('dsafdf');		
        // $('#rapid_fire_draft_loading').hide();
        $('#flights').html(data.flight_search_result);
    }

    var searcharray = $('#searcharray').val();
    var l = api_array.length;
    var siteUrl = "<?php print site_url(); ?>";
    $i = 0;
    search_availability($i);

    //these will basically execute at the same time:

    function search_availability($a) {
        // alert(api_array[$a]);
        /*for (var i = 0, l = api_array.length; i < l; i++) 
            {*/
        $.ajax({
            url: 'http://localhost/travelfreebuy.com/flights/flights_availabilty',
            data: 'callBackId=' + api_array[$a] + '&searcharray=' + searcharray,
            dataType: 'json',
            type: 'POST',
            success: function(data) {
               var sess = $('#sessionId').val(data.session_id);
            //    $.ajax({
            //     url: 'http://localhost/travelfreebuy.com/flights/fetch_results', 
            //     data: 'searcharray='+searcharray,                          
            //     dataType: 'json',               
            //     type: 'POST', 
            //     beforeSend: function () {
            //         // $(".loading-content").css("display","none");                    
            //     },                         
            //     success:  function (data) { 
            //         $(".loading-content").css("display","none");   
            //         $('#flightsresults').html(data.flights_search_result);

            //         //console.log('895');
            //     }
            // });

            // },
      
filter_data(1);
},
error: function(data) {
    //load_search_results();
    console.log('456');
}
});
}

    // function load_searchresults(){
    //     $sessionId = $('#sessionId').val();

    //     $.ajax({
    //         url: siteUrl+'flights/fetch_results', 
    //         data: 'searcharray='+searcharray,                          
    //         dataType: 'json',               
    //         type: 'POST', 
    //         // beforeSend: function()
    //         // {
    //         //     $(".flight-search-cntr").css("display","none");
    //         //     $('#rapid_fire_draft_loading').show();
    //         // },                         
    //         success:  successHandler
    //     });
    // }
        
    function filter_data(page)
    {
        $('.loading-content').html('<div id="loading" style="" ></div>');
      //var action = 'fetch_data';
       // var minimum_price = $('#hidden_minimum_price').val();
        //var maximum_price = $('#hidden_maximum_price').val();
           var fares = get_filter('faress');
            var stops = get_filter('stops');
            
            var brands =get_filter('brands');
            var min_depart = $('#min-depart').val();
            var max_depart = $('#max-depart').val();
            var min_arrive = $('#min-arrive').val();
            var max_arrive = $('#max-arrive').val();
            var minDuration = $('#minDuration').val();
            var maxDuration = $('#maxDuration').val();
            var minimum_price = $('#price-min').val();
            var maximum_price = $('#price-max').val();
            
            var delay = 2000;

            var datas={searcharray:searcharray,stops:stops, fares:fares,maxDuration:maxDuration,minDuration:minDuration,
                min_depart:min_depart,max_depart:max_depart,min_arrive:min_arrive,max_arrive:max_arrive,brands:brands,minimum_price:minimum_price,maximum_price:maximum_price};
            console.log(datas);
            console.log('fff');
            console.log(page);
            // ,brands:brands,min_depart:min_depart,max_depart:max_depart,min_arrive:min_arrive,max_arrive:max_arrive,minimum_price:minimum_price,maximum_price:maximum_price
        $.ajax({
            url:"http://localhost/travelfreebuy.com/flights/fetch_results",
            method:"POST",
            dataType:"JSON",
            data: datas,
            success:function(data)
            {
                setTimeout(function() {
                    delaySuccess(data);
                    
                  }, delay);
                  $(".loading-content").css("display","none"); 
                  var d=data.d;
                  console.log(d); 
                  $('#flights').html(data.flight_search_result); 
                 $('#flightsresultss').html(data.flights_search_result);  
            }
        })
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

   /* $(document).on('click', '.pagination li a', function(event){
        event.preventDefault();
        var page = $(this).data('ci-pagination-page');
        filter_data(page);
    });*/

    $('.common_selectorss').click(function(){
 
        filter_data(1);
    });
    
     $('#price-range').slider({
     
        range: true,
        min:0,
        max: 20000,
        values: [0, 20000],
        step:500,
        slide:function(event, ui)
        {
            var site_currency = 'INR';
            $('#price_show').html(site_currency + " " +ui.values[0] + ' - ' + ui.values[1]);
               
            $("#setMinPrice").text(site_currency + " " + ui.values[ 0 ]);
            $("#setMaxPrice").text( site_currency + " " +ui.values[ 1 ]);
            $('#price-min').val(ui.values[0]);
            $('#price-max').val(ui.values[1]);
            filter_data(1);
        }

    });

    $("#departure-range").slider({
    range: true,
    min: 0,
    max: 1440,
    step: 15,
    values: [0, 1440],
    slide: function (e, ui) {
        var hours1 = Math.floor(ui.values[0] / 60);
        var minutes1 = ui.values[0] - (hours1 * 60);

        if(hours1.toString().length == 1) hours1 = '0' + hours1;
            if(minutes1.toString().length == 1) minutes1 = '0' + minutes1;



        $('#set-min-depart').html(hours1 + ':' + minutes1);
        $('#min-depart').val(hours1 + ':' + minutes1);

        var hours2 = Math.floor(ui.values[1] / 60);
        var minutes2 = ui.values[1] - (hours2 * 60);
        if(hours2.toString().length == 1) hours2 = '0' + hours2;
            if(minutes2.toString().length == 1) minutes2 = '0' + minutes2;

        $('#set-max-depart').html(hours2 + ':' + minutes2);
        $('#max-depart').val(hours2 + ':' + minutes2);
        filter_data(1);
    }
});
        

     $("#arrive-range").slider({
    range: true,
    min: 0,
    max: 1440,
    step: 15,
    values: [0, 1440],
    slide: function (e, ui) {
        var hours1 = Math.floor(ui.values[0] / 60);
        var minutes1 = ui.values[0] - (hours1 * 60);

        /*if (hours1.length == 1) hours1 = '0' + hours1;
        if (minutes1.length == 1) minutes1 = '0' + minutes1;
        if (minutes1 == 0) minutes1 = '00';
        if (hours1 >= 12) {
            if (hours1 == 12) {
                hours1 = hours1;
                minutes1 = minutes1 + " PM";
            } else {
                hours1 = hours1 - 12;
                minutes1 = minutes1 + " PM";
            }
        } else {
            hours1 = hours1;
            minutes1 = minutes1 + " AM";
        }
        if (hours1 == 0) {
            hours1 = 12;
            minutes1 = minutes1;
        }*/
        if(hours1.toString().length == 1) hours1 = '0' + hours1;
            if(minutes1.toString().length == 1) minutes1 = '0' + minutes1;




        $('#set-min-arrive').html(hours1 + ':' + minutes1);
        $('#min-arrive').val(hours1 + ':' + minutes1);

        var hours2 = Math.floor(ui.values[1] / 60);
        var minutes2 = ui.values[1] - (hours2 * 60);

       /* if (hours2.length == 1) hours2 = '0' + hours2;
        if (minutes2.length == 1) minutes2 = '0' + minutes2;
        if (minutes2 == 0) minutes2 = '00';
        if (hours2 >= 12) {
            if (hours2 == 12) {
                hours2 = hours2;
                minutes2 = minutes2 + " PM";
            } else if (hours2 == 24) {
                hours2 = 11;
                minutes2 = "59 PM";
            } else {
                hours2 = hours2 - 12;
                minutes2 = minutes2 + " PM";
            }
        } else {
            hours2 = hours2;
            minutes2 = minutes2 + " AM";
        }*/
        if(hours2.toString().length == 1) hours2 = '0' + hours2;
            if(minutes2.toString().length == 1) minutes2 = '0' + minutes2;

        $('#set-max-arrive').html(hours2 + ':' + minutes2);
        $('#max-arrive').val(hours2 + ':' + minutes2);

        filter_data(1);
    }
});
        
        function renderDuration(ctime) {
        var data = minutesToHours(ctime)
        return data[0] + "h " + data[1] + "m";
    }
    // Duration Slider Initialize

$("#duration-range").slider({
    range: true,
    min: 0,
    max: 1020,
    step: 15,
    values: [100, 1020],
    slide: function (e, ui) {
        var hours1 = Math.floor(ui.values[0] / 60);
        var minutes1 = ui.values[0] - (hours1 * 60);
        if(hours1.toString().length == 1) hours1 = '0' + hours1;
            if(minutes1.toString().length == 1) minutes1 = '0' + minutes1;
        $('#setMinDuration').html(hours1 + ' hrs  ' + minutes1+' m');
        $('#minDuration').val(ui.values[0]);

        var hours2 = Math.floor(ui.values[1] / 60);
        var minutes2 = ui.values[1] - (hours2 * 60);
       
        if(hours2.toString().length == 1) hours2 = '0' + hours2;
        if(minutes2.toString().length == 1) minutes2 = '0' + minutes2;
        $('#setMaxDuration').html(hours2 + ' hrs ' + minutes2 +' m');
        $('#maxDuration').val(ui.values[1]);

        filter_data(1);
    }

    });
    

    $("#sort-box").change(function () {
        filter_data(true);
    }); 
});

