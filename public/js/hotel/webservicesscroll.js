$(document).ready(function()
{
   $(".hotel-search-cntr").css("display","none");
   $('#rapid_fire_draft_loading').show();
   var l = api_array.length;
   $i = 0;
   search_availability($i); 	
	// these will basically execute at the same time:
  var dataStore = [];
   function search_availability($a) 
   {
            /*for (var i = 0, l = api_array.length; i < l; i++) 
            {*/
                $.ajax({
                    url: siteUrl+'hotels/hotels_availability',			
                    data: 'callBackId='+api_array[$a],
                    dataType: 'json',				
                    type: 'POST',                          
                    success: function (data) 
                    {    dataStore.push(data);                          
                        if($a == (l-1))
                        {                                   
                            load_search_results();
                                    //$('#rapid_fire_draft_loading').hide();
                                    return false;
                                }              

                                if(data.results == 'success') 
                                {                    
                                    load_search_results();                                                   
                                }     
                                $a++;                
                                search_availability($a);                                
                                
                            }
                        });
                /*}*/
            }        

            function load_search_results() 
            {
                if (dataStore.length == api_array.length) {
             $.ajax({
                url: siteUrl+'hotels/fetch_results',                           
                dataType: 'json',				
                type: 'POST',                          
                success:  function (data) 
                {                               
                    $('#avail_hotels').html(data.hotels_search_result); 

                    $('#pagination_up').html(data.paging);
                    $('#pagination_down').html(data.paging);  

                    $(".Locations").html(data.locations);

                    $("#setMinPrice").val(data.min_price);	
                    $("#setMaxPrice").val(data.max_price);
                    $("#totalnohotels").val(data.noofhotels);

                                // Calling PriceSlider
                                setPriceSlider();
                                //setTripRatingSlider();             
                                
                                $('#rapid_fire_draft_loading').hide();       
                                $(".hotel-search-cntr").css("display","block");
                            }
                        });
         }

         }     

     });

$(document).on("click", '.Areas', function ($e) {
	filter();
});
$(document).on("click", '.amenity', function ($e) {
    filter();
});

//SCROLLING
function testing(){
    alert($(window).scrollTop());
    alert($(document).height());
    alert($(window).height());
}
$(window).scroll(function(){

    if ($(window).scrollTop() == $(document).height() - $(window).height()){

        $tot=$("#totalnohotels").val();        
        var pagenum = parseInt($(".pagenum:last").val()) + 15;
         // console.log($tot);
         // console.log(pagenum);
         if($tot>pagenum){

            $valuu=$('#scrollajax').val();
            if($valuu==0){
                doSomething(pagenum);
            }
        }
    }   
});


function doSomething($offet)
{
    $('#scrollajax').val(1);
    $('.ajaxloading').show();

    $minPr  =   parseFloat($("#minPrice").val());
    $maxPr  =   parseFloat($("#maxPrice").val());
    
    $minRt  =   parseInt($("#minRating").val());
    $maxRt  =   parseInt($("#maxRating").val());
    
    $hotelName  =   $("#hotelName").val();
    
    //$api  =   $("#api").val();
    $sessionId  =   $("#sessionId").val();

    $stars=new Array;   
    $(".StarRating:checked").each(function()
    {
        $starNum=$(this).val();

        $stars.push($starNum); 

    });
    $areas=new Array;   
    $(".Areas:checked").each(function()
    {
        $areasVal=$(this).val();
        $areas.push($areasVal); 
    });    
    $starShow =  $stars;        
    if($stars.length === 0)
    {
        $starShow = '';
    }

    $locationShow =  $areas;        
    if($areas.length === 0)
    {
        $locationShow = '';
    }

    $sort_data = 'data-price';
    $sort_order = 'asc';
    if(typeof $sortBy !== 'undefined' && typeof $order !== 'undefined')
    {
        $sort_data = $sortBy;
        $sort_order = $order;
    }

    $amenity=new Array;  
    $(".amenity:checked").each(function()
    {
        $fac_val=$(this).val();
        $amenity.push($fac_val); 
    }); 
    $amenity_list =  $amenity;        
    if($amenity.length === 0)
    {
        $amenity_list = '';
    }
    if(typeof $offset == 'undefined')
    {
        $offset = '';
    }
    $.post(siteUrl+"hotels/searchresult_ajax/"+$offet+"/1", { sessionId: ""+$sessionId, minPrice: ""+$minPr, maxPrice: ""+$maxPr, starRating: ""+$starShow, hotelName: ""+$hotelName, location: ""+$locationShow,amenity:""+$amenity_list }, 
        function(data){
            $('.ajaxloading').hide();
            $('#avail_hotels').append(data.hotels_search_result);
            $('#pagination_up').html(data.paging);
            $('#pagination_down').html(data.paging); 
            $order='asc';
            $sortBy='data-price';
            sortHotels($order,$sortBy,$('.HotelSorting'));
            $('#scrollajax').val(0);
        }, 'json');

    
}




