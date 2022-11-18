$(document).ready(function()
    {
        // console.log(123);
         $('#holidaypackagesearch').show();
         $(".hotel-search-cntr").css("display", "none");
         $i = 0;
        load_search_results();
        function load_search_results()
        { 
            $.ajax({
                url: siteUrl + 'holiday/fetch_results',
                data: '',
                dataType: 'json',
                type: 'POST',
                success: function(data)
                { 
                    // console.log(data);
                     if(data.holiday_search_result != null){ 
                     $('#holidaypackagesearch').hide();
                       }
                     $('#avail_holidays').html(data.holiday_search_result);
                      if(data.search_count>1){
                        $('#search_count').html(data.search_count+' Packages');
                        }
                        else{
                        $('#search_count').html(data.search_count+' Package');
                        }
                       setPriceSlider();
                      setdurSlider();
                      setratingSlider();
                       $(".holiday-search-cntr").css("display", "block");
                  }
            });
        }
    }); 
 $(document).on("click , change", '.budget-slider , .dur-slider , .temp-slider,.rating-slider', function($e) {
 filter();
 });
   $(document).on("change", '.custom-radio', function($e) {
 filter();
 });
$(document).on("click", '.Areas', function($e) {
    filter();
});



 $(document).on("click", '.reset_filter', function($e) 
 { 
    setPriceSlider();
    setdurSlider();
    setratingSlider();
    $(".category").find('.text-nicelabel:checked').each(function()
     { $(this).prop('checked', false); });
    $(".region").find('.text-nicelabel:checked').each(function()
     { $(this).prop('checked', false); });
    $(".theme").find('.text-nicelabel:checked').each(function()
     { $(this).prop('checked', false); });
    $(".month").find('.text-nicelabel:checked').each(function()
     { $(this).prop('checked', false); });
    $(".accordion-content").css("display","none");
     $('.accordion-heading').each(function () {
      $(this).find('span').removeClass('fa-angle-down').addClass('fa-angle-right');
     });   
    filter();
    
 });

$(document).on("click", '.HolidaySorting', function($e) 
 { 
     $order=$(this).attr("data-order");
     $sortBy=$(this).attr("rel");
    $(this).find('i').css("display", "block");
    $('.HolidaySorting').not(this).find('i').css("display", "none"); 
    $(this).find('.fa-long-arrow-down').toggleClass('fa-long-arrow-up');
          filter($sortBy,$order);
            if($order=="asc")
                $(this).attr("data-order",'desc');                    
            else
                $(this).attr("data-order",'asc');
 });
 function priceBudget(x)
{
            return x; 
}
function temperature(x)
{
            return x+"°C"; 
}
function duration(x)
{  
            return x+1+"Days";
}
function rating(x)
{
     return x+"☆"; 
}
