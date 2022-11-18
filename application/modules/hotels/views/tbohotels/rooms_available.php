<?php
$showRoom = '';$room_name = '';
$im = 0;
if (!empty($room_dyn_details)) {
  if (trim($room_comb_type) == 'OpenCombination') {
    $showRoom.='<form action="' . site_url() . 'hotels/itinerary" method="post">';
    for ($i = 0; $i < count($RoomIndex_comb); $i++) {
      $d = $i + 1;
      $test = 0;
      $showRoom .='<div class="col-md-12 avail_rooms"><div class="room-title'.$d.'">Room '.$d.'</div>';
      if(!empty($hotel_details->hotel_image)){
        $img = '<img class="card-img-top" src="'.$hotel_details->hotel_image.'" alt="'.$room_name.'" border="0" />';
      } else {
        $img = '<img class="card-img-top" src="'.base_url().'public/img/noimage.jpg" alt="'.$room_name.'" border="0" />';
      }
      for ($j = 0; $j < count($RoomIndex_comb[$i]); $j++) {
        for ($k = 0; $k < count($room_dyn_details); $k++) {
          if ($room_dyn_details[$k]->sequence_no == $RoomIndex_comb[$i][$j]) {

            if ($test == 0) {
              $checked = 'checked="checked"';
              $activeClass = 'activeone';
            } else {
              $checked = '';
              $activeClass = 'inactiveone';
            }

            if ($room_dyn_details[$k]->amenity_code== '') {
              $incl = '<li>&raquo; None</li>';
            } else {
              $incl = '<li>&raquo; '.rtrim($room_dyn_details[$k]->amenity_code,',').'</li>';
            }
            
            $showRoom .= '<div class="'.$activeClass.' rooms_loop card-body card-list card-list-view box-shadow mb-2"><div class="row no-gutters">';
            $showRoom .= '<input type="hidden" name="callBackId" value="'.base64_encode('tbohotels').'"><input type="hidden" name="hotelCode" value="' . $room_dyn_details[$k]->hotel_code . '"><input type="hidden" name="sessionId" value="' . $room_dyn_details[$k]->session_id . '"><input type="hidden" name="room_count" value="' . $room_dyn_details[$k]->room_count . '"><input type="hidden" name="combo_type" value="1">';

            $showRoom .= '<div class="col-lg-3 col-md-4">'.$img.'</div>';

            $showRoom .= '<div class="col-lg-9 col-md-8"><div class="card-body"><div class="d-flex justify-content-between flex-wrap align-content-around">';

            $showRoom .= '<div><h6 class="card-subtitle mt-0">Room Type</h6><ul><li>'.$room_dyn_details[$k]->room_type.'</li></ul></div>';
            $showRoom .= '<div><h6 class="card-subtitle mt-0">Inclusion</h6><ul>'.$incl.'<li></ul></div>';
            $showRoom .= '<div><h6 class="card-subtitle mt-0">Hightlights</h6><ul><li class="pophover"><i class="mdi mdi-multiplication"></i> Cancellation Policy <i class="mdi mdi-information pop-i"></i><div class="pop-content from-right-top">'.str_replace("#!#,", "<br>", $room_dyn_details[$k]->cancellation_policy).'</div></li></ul></div>';

            $showRoom .= '<input type="hidden" class="price-val" value="'.$room_dyn_details[$k]->total_cost.'"/><div class="text-right"><h2 class="text-secondary">'.$room_dyn_details[$k]->currency.' '.number_format($room_dyn_details[$k]->total_cost).'</h2><div class="button-toggle"><input type="radio" name="searchId'.$i.'" value="'.$room_dyn_details[$k]->search_id.'" class="toggle-select" id="searchId'.$k.$i.'" title="Select Room" '.$checked.'><label for="searchId'.$k.$i.'"></label></div></div>';

            $showRoom .='</div></div></div>';

            $showRoom .='</div></div>';

            $test++;
          }
        }
      }
      $showRoom .='</div>';
    }

    $showRoom .= '<div class="col-md-12 text-right"><h2 class="text-secondary">INR <span id="grand-total"></span></h2><button class="btn btn-primary"> BOOK NOW <i class="mdi mdi-chevron-double-right"></i></button></div>
    </form>';
    // $im++;
    // echo 'loop'.$RoomIndex_comb[$i][$j];
  } else {

    // echo 'entered';exit;
    for ($i = 0; $i < count($RoomIndex_comb); $i++) {
      $room_total_cost = 0;
      $room_name = '';$room_list = ''; $serach_comb_id = ''; $cancel_policy = ''; $incl = '';
      for ($j = 0; $j < count($RoomIndex_comb[$i]); $j++) {
        for ($k = 0; $k < count($room_dyn_details); $k++) {
          if ($room_dyn_details[$k]->sequence_no == $RoomIndex_comb[$i][$j]) {
            // echo '<prE>';print_r($room_dyn_details[$k]);
            $room_total_cost += $room_dyn_details[$k]->total_cost;
            $room_name .= $room_dyn_details[$k]->room_type.',';
            $room_list .= '<li>'.$room_dyn_details[$k]->room_type.'</li>';
            $serach_comb_id .= $room_dyn_details[$k]->search_id . ',';
            $cancel_policy .= $room_dyn_details[$k]->cancellation_policy . ',';
            if(!empty($room_dyn_details[$k]->amenity_code)){
              $incl .= '<li>&raquo; '.$room_dyn_details[$k]->amenity_code.'</li>';
            }
          }
        }
      }
      // echo '<prE>';print_r($hotel_details);exit;
      $session_data = unserialize($hotel_details->searcharray);
      // echo '<prE>';print_r($session_data);exit;
      $nights = $session_data['nights'];
      if(!empty($hotel_details->hotel_image)){
        $img = '<img class="card-img-top" src="'.$hotel_details->hotel_image.'" alt="'.$room_name.'" border="0" />';
      } else {
        $img = '<img class="card-img-top" src="'.base_url().'public/img/noimage.jpg" alt="'.$room_name.'" border="0" />';
      }
      // $cancellation_policy_new = str_replace("b2b","" ,$cancel_policy);
      $showRoom .= '<section class="room-type-wrap">
      <header class="room-heading">        
      <h4 class="title" style="list-style-type: none;">'.$room_list.'</h4>
      </header>
      <div class="row no-gutter"> 
      <section class="col-md-12">  
      <article class="item-room">
      <div class="row-sm"> 
      <div class="col-md-6 col-sm-12">
      <h4 class="title" style="list-style-type: none;">'.$room_list.'</h4>
      <p class="text-muted"> <i class="fa fa-users"></i> 1 Rooms, 2 Adults, 0 Children</p>
      <ul class="row-sm"></ul></div>
      <div class="col-md-6 col-sm-12">
      <div class="row-sm">
      <div class="col-xs-6 room-deal-wrap">
      <div>                                    
      <span data-toggle="popover" title="" class="htmltooltip text-muted" data-original-title="Cancellation Policy"><i class="fa fa-info-circle"></i> Non Refundable</span>
      <popover class="popper-content hide">
      <div class="htmltooltip-content small">                                    
      '.str_replace('#!#,','<br>',$cancel_policy).'
      </div> <!-- col.// -->
      <small>(Date and time is calculated based on local time of destination.)</small>
      </div>
      </popover>                                             
      </div> 
      <div class="col-xs-6 room-select-wrap">
      <var class="price">
      <span class="currency">'.$room_dyn_details[0]->currency.'</span>&nbsp;'.number_format($room_total_cost).'</var>  
      <form action="' . site_url() . 'hotels/itinerary" method="post">
      <input type="hidden" name="callBackId" value="' . base64_encode('tbohotels') . '">
      <input type="hidden" name="hotelCode" value="' . $hotel_details->hotel_code . '">
      <input type="hidden" name="sessionId" value="' . $hotel_details->session_id . '">
      <input type="hidden" name="searchId" value="' . $serach_comb_id . '">
      <input type="hidden" name="room_count" value="' . $hotel_details->room_count . '">
      <input type="hidden" name="combo_type" value="0">';

      
      $showRoom .= '<button class="btn btn-warning uppercase"> BOOK NOW <i class="mdi mdi-chevron-double-right"></i></button></div>';

     
      // $im++;
      // echo 'loop'.$RoomIndex_comb[$i][$j];
      $showRoom .='</form>
      </div> <!-- col.// -->
      </div> <!-- row.// -->
      </div>
      </div> <!-- row// -->
      </article> <!-- item-room// -->
      </section> <!-- col// -->
      </div> <!-- row// -->
      </section> ';
    }
  }
} else {
  $showRoom.='<div class="row" style="border: 1px solid #A1A1A1;border-radius: 5px;margin: 5px 0;"><div class="error" style="text-align:center;">Sorry, No Rooms are available. Search for another Hotel.</div></div>';
}
$showRoom.='</div>';
echo $showRoom; 
?>

<script type="text/javascript">
  $('.details-link').on('click', function(e){
    e.preventDefault();
    $(this).parent().parent().parent().parent().find('.details-content').slideToggle();
  });
</script>
<script type="text/javascript">
  // Show hide more rooms
  $('.rooms_loop').each(function(i){
    if(i>1){
      // $(this).addClass("more_rooms");
    }
  });
  $('.show-more').on('click', function(){
    var _html = $(this).html();
    if(_html == '<i class="fa fa-caret-right"></i> Show More'){
      $('.more_rooms').show();
      $(this).html('<i class="fa fa-caret-right"></i> Hide Rooms');
    } else if(_html == '<i class="fa fa-caret-right"></i> Hide Rooms'){
      $('.more_rooms').hide();
      $(this).html('<i class="fa fa-caret-right"></i> Show More');
    }
  });

  // total booing
  $('.toggle-select').each(function(i){
    
  });
</script>
<script type="text/javascript">
  $('.button-toggle').on('click', function(){
    $(this).closest('.avail_rooms').find('.rooms_loop').removeClass('activeone');
    $(this).closest('.avail_rooms').find('.rooms_loop').addClass('inactiveone');
    $(this).closest('.rooms_loop').removeClass('inactiveone');
    $(this).closest('.rooms_loop').addClass('activeone');
     $('#sel-price').html('');
    selected_rooms();
  });
  selected_rooms();
  function selected_rooms(){
    var total = 0;
    // var roomname = [];
    $('.activeone').each(function(){
      // roomname.push('<span class="comma_list">, </span>'+$(this).find('.room-name').html());
      total = parseFloat(total) + parseFloat($(this).find('.price-val').val().trim());
     
    });
      $('#grand-total').html(total);
      // $('#sel-room').html(roomname);
  }
</script>
<style type="text/css">
  /*#rooms_info .rooms_loop:nth-of-type(1n+11){
    display: none;
  }*/
  .more_rooms{
    display: none;
  }
  .inactiveone{
    /*display: none;*/
  }
</style>
