<?php
  // echo '<pre>';print_r($result);exit;
  $tripRating = rand(1,5);
  if(is_numeric($result->star)){
    $star = $result->star;
  }else{
    $star = 0;
  }
  $hotel_images = '';
  if ($result->image != '') {
    $hotel_images = explode('||', $result->image);
  }
  $facilities=$result->facility_list;//exit;
  // echo '<pre/>';print_r($facilities);exit;
  $WIFI = false;
  $Bar = false;
  $AC = false;
  $Restaurant = false;
  $Cafe = false;
  $RoomService = false;
  $Business = false;
  $Pool = false;
  $Gym = false;
  $Internet = false;
  $facVal = '';
  if (!empty($facilities)) {
    $faclist=explode(',',$facilities);
    foreach ($faclist as $fac) {
      $fcode = $fac;
      if ($fcode == 'Wi-fi' || $fcode == 'Internet Access') {
        $WIFI = true;
        $facVal .= $fcode . ',';
      }
      if ($fcode == 'Bar') {
        $Bar = true;
        $facVal .= $fcode . ',';
      }
      if ($fcode == 'AC') {
        $AC = true;
        $facVal .= $fcode . ',';
      }
      if ($fcode == 'Room Service') {
        $RoomService = true;
        $facVal .= $fcode . ',';
      }
      if ($fcode == 'Business') {
        $Business = true;
        $facVal .= $fcode . ',';
      }
      if ($fcode == 'Pool' || $fcode == 'Outdoor Pool (all year)') {
        $Pool = true;
        $facVal .= $fcode . ',';
      }
      if ($fcode == 'Gym') {
        $Gym = true;
        $facVal .= $fcode . ',';
      }
    }
  } else {
    $RoomService = true;
    $facVal .= 'WiFi,';
  }
  $session_data = $this->session->userdata('hotel_search_data');
  $rooms = $session_data['rooms'];
  $nights = $session_data['nights'];
  $avg_room_cost = round($result->total_cost,2);
  $per_room_cost = round((($result->total_cost / $rooms) / $nights), 2);
?>

<div class="row hotel-results-row searchHotel_box">
  <div class="col-lg-12 col-md-12 HotelInfoBox" data-price="<?php echo $result->total_cost ?>" data-star="<?php echo $star; ?>" data-hotel-name="<?php echo preg_replace("/[^a-z0-9_-]/i", " ", $result->hotel_name); ?>" data-trip-rating="<?php echo $tripRating; ?>" data-facilities="<?php echo $facVal; ?>">
    <div class="card card-list card-list-view">
      <div class="row no-gutters">
        <div class="col-lg-3 col-md-4">
          <span class="badge badge-default">
            <?php for($s=0;$s<$star;$s++) { ?>
            <i class="mdi mdi-star text-white"></i>
            <?php } ?>
          </span>
          <?php if (isset($hotel_images[0])) { ?>
          <img class="card-img-top" src="<?php echo $hotel_images[0]; ?>" alt="<?php echo $result->hotel_name; ?>">
          <?php } else { ?>
            <img class="card-img-top" src="<?php echo base_url() ?>public/img/noimage.jpg" alt="<?php echo $result->hotel_name; ?>">
          <?php } ?>
        </div>
        <div class="col-lg-9 col-md-8">
          <div class="card-body">
            <div class="row no-gutters">
              <div class="col-lg-9 col-md-9">
                <a href="javascript:;">
                  <h4 class="card-title"><?php echo $result->hotel_name; ?> <span class="star star<?php echo $star; ?>"></span></h4>
                </a>
                <h6 class="card-subtitle mb-2 text-muted"><i class="mdi mdi-map-marker"></i> <?php echo $result->location; ?>, <?php echo $session_data['cityName'] ?></h6>
                <!-- <h2 class="text-primary mb-0 mt-3">$130,000 <small>/month</small></h2> -->
              </div>
              <div class="col-lg-3 col-md-3 text-right">
                <h2 class="text-secondary"><i class="mdi mdi-currency-inr"></i> <?php echo number_format($avg_room_cost); ?></h2>
                <form name="frmHotelDetails" method="post" action="<?php echo site_url(); ?>hotels/details" target="_blank">
                  <input type="hidden" name="callBackId" value="<?php echo base64_encode('travelguru'); ?>" />
                  <input type="hidden" name="hotelCode" value="<?php echo $result->hotel_code; ?>" />
                  <input type="hidden" name="searchId" value="<?php echo $result->search_id; ?>" />
                  <button class="btn btn-secondary">SELECT ROOM <i class="mdi mdi-chevron-double-right"></i></button>
                </form>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <?php if ($Gym) { ?>
            <span><i class="mdi mdi-dumbbell"></i> GYM</span>
            <?php } ?>
            <?php if ($WIFI) { ?>
            <span><i class="mdi mdi-wifi"></i> WIFI</span>
            <?php } ?>
            <?php if ($AC) { ?>
            <span><i class="mdi mdi-television"></i> AC</span>
            <?php } ?>
            <?php if ($RoomService) { ?>
            <span><i class="mdi mdi-food"></i> Room Service</span>
            <?php } ?>
            <?php if ($Business) { ?>
            <span><i class="mdi mdi-briefcase-check"></i> Business Center</span>
            <?php } ?>
            <?php if ($Pool) { ?>
            <span><i class="mdi mdi-swim"></i> Pool</span>
            <?php } ?>
            <?php if ($Bar) { ?>
            <span><i class="mdi mdi-coffee"></i> Bar</span>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>