function assignhotelcity(t,linkStrId)
{
  $strarr=linkStrId.split('*');
  $('#hotcityName').val($.trim(t.innerHTML));
  $('#hotlinktype').val($strarr[0]);
  $('#hotdestiId').val($strarr[1]); 
  $("#hotdistdropdown").css("display", "none");
  $("#hotdistdropdownsearch").css("display", "none");
}
function hotelcityscrollfun($limit=25,$upto=0)
{
  $inval=$('#hotcityName').val(); 
  $activelink=$("ul#hoteltab li.active").attr("data-city-type");
  $activelink=$.trim($activelink);
  $("#hotdistdropdown").css("display", "inline"); 
  $("#hotdistdropdownsearch").css("display", "inline");
  if($inval){
    $str = siteUrl+"home/hotel_fullcity_list/"+$activelink+"/"+$limit+"/"+$upto+"/"+$inval; }
    else{
      $str = siteUrl+"home/hotel_fullcity_list/"+$activelink+"/"+$limit+"/"+$upto;
    }
      $encstr = encodeURI($str);
      $decstr = decodeURI($encstr);
              $.ajax({
          url: $decstr,
      success: function(result){
        if($activelink=="dom"){
          $("#hotel_dom").append(result);
        }
        else if($activelink=="int"){
          $("#hotel_int").append(result);
        }
       }
    });  
  }

function hotelcityfun($limit=25,$upto=0)
{  
  $("#hotel_dom").html('');
  $("#hotel_int").html('');
  $inval=$('#hotcityName').val(); 
  $activelink=$("ul#hoteltab li.active").attr("data-city-type");
  $activelink=$.trim($activelink);
  $("#hotdistdropdown").css("display", "inline"); 
  $("#hotdistdropdownsearch").css("display", "inline");
  if($inval){
    $str = siteUrl+"home/hotel_fullcity_list/"+$activelink+"/"+$limit+"/"+$upto+"/"+$inval; }
    else{
      $str = siteUrl+"home/hotel_fullcity_list/"+$activelink+"/"+$limit+"/"+$upto;
    }
    $encstr = encodeURI($str);
        $decstr = decodeURI($encstr);
              $.ajax({
          url: $decstr,
      success: function(result){
        if($activelink=="dom"){
          $("#hotel_dom").html(result);
        }
        else if($activelink=="int"){
          $("#hotel_int").html(result);
        }
       }
    });  
  }

   $(document).ready(function() {

    $("#hotcityName").keyup(function(){hotelcityfun();});
    $("#hotcityName").click(function(){hotelcityfun();});   
     $('#hotinfo').scroll(function(e){ 
     $limit=25;
     $upto=0;
     $scrollhotinfo=parseInt($('#hotinfo').scrollTop());
     $hotinfoheight=parseInt($('#hotinfo').height());
      if($scrollhotinfo>$hotinfoheight){
          $res=parseInt($scrollhotinfo/$hotinfoheight);
          $upto=25*$res; 
   hotelcityscrollfun($limit,$upto);
}
else
{
  hotelcityscrollfun($limit,$upto);
}
 
});
    $("#hotdistdropdown").on('click','li',function (){
      $limit=25;
      $upto=0;
      $("#hotel_dom").html('');
      $("#hotel_int").html('');
      $(this).parent().children().removeClass('active');
      $(this).parent().children().css('color', 'rgba(0,0,0,1.1)');
      $(this).addClass('active');
      $(this).css('color', 'rgba(255,255,255,.7)');
      $inval=$('#hotcityName').val();
      $activelink=$(this).attr("data-city-type");;
      $activelink=$.trim($activelink);
      $("#hotdistdropdown").css("display", "inline"); 
      $("#hotdistdropdownsearch").css("display", "inline");
      if($inval){
        $str = siteUrl+"home/hotel_fullcity_list/"+$activelink+"/"+$limit+"/"+$upto+"/"+$inval; }
        else{
          $str = siteUrl+"home/hotel_fullcity_list/"+$activelink+"/"+$limit+"/"+$upto;
        }
         $encstr = encodeURI($str);
             $decstr = decodeURI($encstr);
                $.ajax({
          url: $decstr,
          success: function(result){
            if($activelink=="dom"){
              $("#hotel_dom").html(result);
            }
            else if($activelink=="int"){
              $("#hotel_int").html(result);
            }
          }
        });  

      });
  });


