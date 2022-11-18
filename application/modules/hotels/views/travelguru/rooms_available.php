<?php if (!empty($result)) { 
  $session_data = $this->session->userdata('hotel_search_data');
  // $rooms = $session_data['rooms'];
  $nights = $session_data['nights'];
  // $per_room_cost = round((($result->total_cost / $rooms) / $nights), 2);
  // echo '<pre>';print_r($result);exit;
  $inclusions = explode('||', $result->inclusion);
  $inclusion = rtrim($inclusions[0],', ');
  $inclusion2 = rtrim($inclusions[1],', ');
  $room_type = explode('-', $result->room_type);
?>
<div class="card-body card-list card-list-view box-shadow mb-2">
  <div class="row no-gutters">
    <div class="col-lg-3 col-md-4">
      <h6 class="card-title font14 mb-1"><?php echo rtrim($room_type[0], ' ') ?></h6>
      <?php if(!empty($rimage)){ ?>
      <img class="card-img-top" src="<?php echo $rimage ?>" alt="<?php echo $rimage; ?>" title="<?php echo $result->room_type ?>">
      <?php }else{ ?>
      <img class="card-img-top" src="<?php echo base_url() ?>public/img/noimage.jpg" alt="No Image">
      <?php } ?>
    </div>
    <div class="col-lg-9 col-md-8">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap align-content-around">
          <div class="">
            <h6 class="card-subtitle mt-0">Max Guests</h6>
            <ul>
              <li title="<?php echo $result->adult_max_occ ?> Adult(s)">
                <?php for($a=0;$a<$result->adult_max_occ;$a++){ ?>
                <i class="mdi mdi-human" style="font-size: 20px;"></i>
                <?php } ?>
              </li>
              <li title="<?php echo $result->child_max_occ ?> Child(ren)">
                <?php for($c=0;$c<$result->child_max_occ;$c++){ ?>
                <i class="mdi mdi-human-child" style="font-size: 20px;"></i>
                <?php } ?>
              </li>
            </ul>
          </div>
          <div class="" style="max-width: 40%;">
            <h6 class="card-subtitle mt-0">Inclusions</h6>
            <ul>
              <?php if($inclusion=='None' || empty($inclusion)){ echo '<li><i class="mdi mdi-check"></i> Room Only</li>';}else{ $inc=explode(',',$inclusion); foreach($inc as $val){ echo '<li><i class="mdi mdi-check"></i> '.trim($val).'</li>';} } ?>
            </ul>
            <ul>
              <?php $inc2=explode(',',$inclusion2); foreach($inc2 as $val2){ echo '<li><i class="mdi mdi-check"></i> '.trim($val2).'</li>';} ?>
            </ul>
          </div>
          <div class="">
            <h6 class="card-subtitle mt-0">Hightlights</h6>
            <ul>
              <?php if($result->cancel_policy == 'Free Cancellation') { ?>
              <li><i class="mdi mdi-checkbox-marked-outline"></i> Free Cancellation</li>
              <?php } else { ?>
              <li class="pophover">
                <i class="mdi mdi-multiplication"></i> Non Refundable <i class="mdi mdi-information pop-i"></i>
                <div class="pop-content from-right-top">
                  <?php echo $result->cancel_policy; ?>
                </div>
              </li>
              <?php }?>
              <li><i class="mdi mdi-coffee"></i> Free Breakfast</li>
              <li><i class="mdi mdi-wifi"></i> Free Wifi Internet</li>
            </ul>
          </div>
          <div class=" text-right">
            <h6 class="card-subtitle mt-0">Price for <?php echo $nights ?> Night(s)</h6>
            <h2 class="text-secondary"><i class="mdi mdi-currency-inr"></i> <?php echo number_format($result->total_cost) ?></h2>
            <a href="<?php echo site_url() ?>hotels/itinerary?callBackId=<?php echo  base64_encode('travelguru') ?>&hotelCode=<?php echo $result->hotel_code ?>&searchId=<?php echo $result->search_id ?>&sessionId=<?php echo $result->session_id ?>" class="btn btn-secondary">BOOK NOW <i class="mdi mdi-chevron-double-right"></i></a>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <?php if(!empty($result->rate_plan_description)){ ?>
        <div>
          <span class="badge badge-default" style="position: static;color: #fff;">DEAL APPLIED</span> <?php echo $result->rate_plan_description ?>
        </div>
        <?php } ?>
        <!-- <span><i class="mdi mdi-dumbbell"></i> GYM</span>
        <span><i class="mdi mdi-wifi"></i> WIFI</span>
        <span><i class="mdi mdi-television"></i> TV</span> -->
      </div>
    </div>
  </div>
</div>
<?php } ?>