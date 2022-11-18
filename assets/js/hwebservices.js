$(document).ready(function() {

    var successHandler = function (data) {
        //alert('dsafdf');		
        // $('#rapid_fire_draft_loading').hide();
        // $('#hotels').html(data.hotel_search_result);
        $(".loading-content").css("display","none");   
        $('#avail_hotels').html(data.hotels_search_result);
        $(".Locations").html(data.locations);

        $("#setMinPrice").val(data.min_price);
        $("#setMaxPrice").val(data.max_price);

        // Calling PriceSlider
        setPriceSlider();
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
            url: 'http://localhost/travelfreebuy.com/hotels/hotels_availability',
            data: 'callBackId=' + api_array[$a] + '&searcharray=' + searcharray,
            dataType: 'json',
            type: 'POST',
            success: function(data) {
               var sess = $('#sessionId').val(data.session_id);
               $.ajax({
                url: 'http://localhost/travelfreebuy.com/hotels/fetch_results', 
                data: 'count=' + $a+'&searcharray='+searcharray,                          
                dataType: 'json',               
                type: 'POST', 
                beforeSend: function () {
                    // $(".loading-content").css("display","none");                    
                },                         
                success:  successHandler
            });

            },
            error: function(data) {
                //load_search_results();
                console.log('456');
                console.log(data);
            }
        });
    }

    
        
});