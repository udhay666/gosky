<?php
// echo '<pre>'; print_r($room_info); exit;
$session_data = $this->session->userdata('hotel_search_data');
// echo '<pre>'; print_r($room_info); exit;
$rooms = $session_data['rooms'];
// echo $rooms.'<pre>'.count($room_info); echo '<pre>'; print_r($room_info); exit;
$adults = $session_data['adults'];
$childs = $session_data['childs'];
$childs_ages = $session_data['childs_ages'];
$adults_count = $session_data['adults_count'];
$childs_count = $session_data['childs_count'];
$im = 0;
if (isset($room_info[0])) { ?>
<form action="<?php echo site_url(); ?>hotels/itinerary" method="post">
  <div class="row" style="margin-bottom: 2px;">
    <div class="col-md-12 text-right">
      <button type="submit" class="full-width icon-check btn btn-primary" data-animation-type="bounce" data-animation-duration="1">BOOK NOW</button>
    </div>
  </div>
  <div class="row">
  <div class="col-md-12">
  <?php // for ($t = 0; $t < $room_info[0]->room_count; $t++) {
  for ($t = 0; $t < $rooms; $t++) {
  $d = $t + 1; ?>
  <table class="table avail_rooms table-striped-column table-bordered"  >
    <thead>
      <tr bgcolor="#1b378a" style="color: #fff">
        <th>Room Type</th>   
        <th>Price</th>
        <th>Inclusion</th>
        <th>Confirmation</th>
      </tr>
    </thead>
    <tbody>
      <tr><td colspan="5" style="background:#ffc107"><b>Room <?php echo $d; ?></b></td></tr>
      <?php  $test=0;
      foreach ($room_info as $vale) {
        if($vale->room_runno == $t) {
          $room_details = $this->Hotelcrs_Model->get_hotel_room_by_code($vale->room_code); 

          $room_img = $this->Hotelcrs_Model->get_hotel_room_image_by_code($vale->room_code);
          $meal=explode(',', $vale->board_type);
          $mandatory_supplement_meal_plan=explode(',', $vale->mandatory_supplement_meal_plan);
          $meal_plan_arr=array();
          foreach ($meal as $val) 
          {         
            $meal_plan_arr[] = $this->Hotelcrs_Model->get_hotel_room_meal_plan($val);
          }   
          // foreach ($mandatory_supplement_meal_plan as $val) 
          // {         
          //   $meal_plan_arr[] = $this->Hotelcrs_Model->get_hotel_room_meal_plan($val);
          // } 
          // $meal_plan_arr=array_unique($meal_plan_arr);  
          if(!empty($meal_plan_arr)) {      
            $inclusion=implode("<br>", $meal_plan_arr);
          } else {
            $inclusion="";
          }
          $nonmandatory_supplementd = $vale->nonmandatory_supplement_meal_plan;
          $extrainclusion = '';
          if(!empty($nonmandatory_supplementd)){
            $nonmandatory_supplement_meal_plan = explode(',', $nonmandatory_supplementd);
            $extra_meal_plan_arr=array();
            foreach ($nonmandatory_supplement_meal_plan as $val) { 
              if(!in_array($val, $meal)) {       
                $extra_meal_plan_arr[] = $this->Hotelcrs_Model->get_hotel_room_meal_plan($val);
              }
            }
            $extra_meal_plan_arr=array_unique($extra_meal_plan_arr);  
            if(!empty($extra_meal_plan_arr)) {      
              $extrainclusion=implode(", ", $extra_meal_plan_arr);
            }  else {
              $extrainclusion="";
            }
          }

          if (!empty($room_img->gallery_img)) {
            $image_name =$room_img->gallery_img; }
            else {
              $image_name = '';}
              if($image_name!='') {
                // echo '<pre>';print_r($image_name);
                // echo '<pre>';print_r($vale->room_code);
                $imgdetail='<img src="'.base_url().'supplier/' . $image_name . '" width="150" height="100" alt="' . $vale->room_type . '" title="' . $vale->room_type . '" border="0" />';
              } else {
                $imgdetail='<img src="' . base_url() . 'public/img/noimage.jpg" width="150" height="100" alt="No Image" border="0" />';
              }
              if ($test == 0) {
                $checked = 'checked="checked"';
              } else {
                $checked = '';
              }
      ?>
      <tr>
        <td><?php echo $vale->room_name.' ( '.$vale->room_type.' )'.'<br>'.$imgdetail;  ?>
          <?php  if(!empty($extrainclusion)){ ?>
          <br>
          <?php  echo "Supplements ( ".$extrainclusion." )";  ?>
          <br>
          Supplements Charges  <?php echo $vale->xml_currency.' '.round($vale->nonmandatory_supplement_cost);
          if($set_currency!='USD'){
          $showRoom.= '<br>'.$set_currency.' '.round($vale->nonmandatory_supplement_cost * $set_curr_val);
          }  ?> &nbsp; &nbsp;
          <input type="checkbox" name="<?php echo $t.'_'.$vale->search_id.'_searchId'.'_nonmandatory_supplement_check'; ?>" class="for" value="<?php echo $vale->search_id."_Yes" ?>" <?php if($vale->nonmandatory_supplement_check=="Yes"){ echo "checked"; }?>>
          <?php } ?>
        </td> 
        <td> 
          <?php if($vale->conversation_id=="EARLYBIRD"||$vale->conversation_id=="STAYPAY"||$vale->conversation_id=="DISCOUNT"){ ?>
          <h6><?php echo ' " '.$vale->conversation_id.' "  OFFER APPLIED'; ?> </h6>
          <?php } ?>
          <span class="price" style="font-size: 12px;color: white;float: left;text-align: left;">
            <?php if($vale->conversation_id=="EARLYBIRD"||$vale->conversation_id=="STAYPAY"||$vale->conversation_id=="DISCOUNT"){ ?>
            <span class="striked-text"><?php echo $vale->xml_currency . ' ' .round(($vale->net_fare)); ?></span><br>
            <?php } ?>
            <span class="text-uppercase">Pay Only </span><?php echo $vale->xml_currency . ' ' .round(($vale->total_cost)); ?>
          </span>
          <br><br>
          Occupancy Details:<br/>
          <?php
          if($vale->adult>0)
          {
          echo $vale->adult.'  '.'adult(s)';
          }
          if($vale->child>0)
          { 
          echo ' &amp; '.$vale->child.'  '.'child(ren)';
          } 
          ?>
          <br/>
          <?php
          if($vale->adult_extrabed>0||$vale->child_extrabed>0){
          if($vale->adult_extrabed>0)
          { 
          echo $vale->adult_extrabed.'  '.'extrabed for adult(s)';
          } 
          if($vale->child_extrabed>0 && $vale->adult_extrabed>0)
          { 
          echo ' &amp;'; 
          } 
          if($vale->child_extrabed>0)
          {
          echo ' '.$vale->child_extrabed.'  '.' extrabed for child(ren)';
          } ?>
          <br/>
          <?php } ?>
          <?php if(!empty($vale->cancel_policy)||$vale->cancel_policy!=NULL) { ?>
          <div>
            <b>Cancellation Policies </b><i class="fa fa-info-circle"></i>
            <div class="info_div">
              <?php echo $vale->cancel_policy ?>
            </div>
          </div>
          <?php } ?>
        </td>
        <td>
          <?php echo $inclusion; ?>
        </td>              
        <td>
          <input type="hidden" name="callBackId" value="<?php echo base64_encode('hotel_crs') ?>">
          <input type="hidden" name="room_count" value="<?php echo $vale->room_count ?>">
          <input type="hidden" name="hotelCode" value="<?php echo $vale->hotel_code; ?>">
          <input type="hidden" name="sessionId" value="<?php echo $vale->session_id ?>">
          <div class="button-toggle">
            <input type="radio" name="<?php echo $t.'_searchId'; ?>" value="<?php echo $vale->search_id ?>" class="toggle-select" id="<?php echo $t.'_'.$vale->search_id; ?>" title="Select Room" <?php echo $checked?>>
            <label for="<?php echo $t.'_'.$vale->search_id ?>"></label>
          </div>
        </td>
      </tr>
      <?php
      $im++;
      $test++;
      }}} ?>
    </tbody>
  </table>
  </div>
  </div>
  </form>
<?php  } else { ?>
<div class="row" style="border: 1px solid #A1A1A1;border-radius: 5px;margin: 5px 0;"><div class="error" style="text-align:center;">Sorry, No Rooms are available. Search for another Hotel.</div></div>
<?php  }  ?>
<!-- </div> -->
<script type="text/javascript">
  var w = $(window).width();
  if(w > 768){
    var wid = w/3;
  } else {
    var wid = w/2;
  }
  $('.info_div').css('width', wid);
  $('.fa-info-circle').mouseover(function() {
    $(this).parent().find('.info_div').show();
    $(this).parent().css('position', 'relative');
  });
  $('.fa-info-circle').mouseleave(function() {
    $(this).parent().find('.info_div').hide();
  });
</script>