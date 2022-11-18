
$(document).ready(function()
{
    var site_url = $('#siteUrl').val();
    $(".hotel-search-cntr").css("display", "none");
        // $('#rapid_fire_draft_loading').show();
        $('.loader').show();

        var searcharray=$('#searcharray').val();
        var l = api_array.length;

        $i = 0;
   
        var dataStore = [];
        for (var i = 0, l = api_array.length; i < l; i++)
        {
            $.ajax({
                url: site_url+'hotels/hotels_availability',
                data: 'callBackId=' + api_array[i]+'&searcharray='+searcharray,
                dataType: 'json',
                type: 'POST',
                beforeSend: function()
                {
                    $(".hotel-search-cntr").css("display", "none");
                    $('.loader').show();
                },
            //success: { load_search_results(i); },
            success: function(data)
            {
                // $(".loading-content").css("display","none"); 
                console.log('testsuccess');
                console.log(data);
                dataStore.push(data);
                load_search_results(i);  
            },
            error: function(jqXHR, error, errorThrown) {
                console.log('errormsg');
                console.log(jqXHR);

                //successHandler({'hotels_search_result': ''});
            }

        });
        }


        function load_search_results($a)
        { 
           if (dataStore.length == api_array.length) {

            var searcharray=$('#searcharray').val();

            $.ajax({
                url: site_url+'hotels/fetch_results',
                data: 'count=' + $a+'&searcharray='+searcharray,
                dataType: 'json',
                type: 'POST',
                success: function(data)
                {
                    if(data.hotels_search_result != null ){
                        // $('#rapid_fire_draft_loading').hide();
                        $(".loading-content").css("display","none");
                        $('.loader').hide();
                    }
                    $('#avail_hotels').html(data.hotels_search_result);
                    $('#location_search').html(data.hotels_search_location);

                    $('#pagination_up').html(data.paging);
                    $('#pagination_down').html(data.paging);
                    $('#pagination').html(data.paging);

                    $(".Locations").html(data.locations);

                    $("#setMinPrice").val(data.min_price);
                    $("#setMaxPrice").val(data.max_price);

                    // Calling PriceSlider
                    setPriceSlider();
                    $(".hotel-search-cntr").css("display", "block");
                    //setTripRatingSlider();

                    var data_fac = new Array;
                    $(".HotelInfoBox").each(function()
                    {
                        if ($(this).attr("data-facilities") != '') {
                            // $.merge(data_fac, $(this).attr("data-facilities").split(','));
                        }

                        // TO DISPLAY BEST PRICE
                        $leas = $(this).parent().find('.least').val();
                        $(this).parent().find('.leastdisp').html('GBP ' + $leas);
                    //data_fac=$(this).attr("data-facilities");
                    }); //alert(data_fac);
                    $fcnts = new Array;
                    data_fac = $.grep(data_fac, function(v, k)
                    {
                        if (typeof $fcnts[v] != 'undefined') {
                            $fcnts[v]++;
                        } else {
                            $fcnts[v] = 1;
                        }
                        return $.inArray(v, data_fac) === k;
                    });

                    var FacilitiesString = "";
                    for (var ai = 0; ai < data_fac.length; ai++)
                    {
                        var amenityName = data_fac[ai];
                        if (typeof amenityName == "undefined" || amenityName == "") {
                        }
                        else
                        {
                            FacilitiesString += '<label><input type="checkbox" name="amenities" class="Amenities" value="' + amenityName + '" />&nbsp;' + amenityName + '<span class="hotel_counts">' + $fcnts[amenityName] + '</span></label>';

                        //  FacilitiesString += '<label><input type="checkbox" name="amenities" class="Amenities" value="' + amenityName + '" />&nbsp;' + amenityName + '</span></label>';
                    }
                }
                $(".amenities").html(FacilitiesString);
            }
        });

}


}

});

$(document).on("click", '.Areas', function($e) {

    filter();
});



