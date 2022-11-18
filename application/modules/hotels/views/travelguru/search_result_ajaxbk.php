<?php
  // echo '<pre>';print_r($result);exit;
  $session_data = $this->session->userdata('hotel_search_data');
  $rooms = $session_data['rooms'];
  $nights = $session_data['nights'];
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
  $avg_room_cost = round($result->total_cost,2);
  $per_room_cost = round((($result->total_cost / $rooms) / $nights), 2);
?>

<!-- <div class="htlResultRow searchhotel_box" style="padding: 0;background: inherit;border: none;"> -->
<div class="hotel-results-row searchHotel_box silver_borderold"  style="background:#fff; margin-bottom: 20px;">
  <div class="row HotelInfoBox" data-price="<?php echo $result->total_cost ?>" data-star="<?php echo $star; ?>" data-hotel-name="<?php echo preg_replace("/[^a-z0-9_-]/i", " ", $result->hotel_name); ?>" data-trip-rating="<?php echo $tripRating; ?>" data-facilities="<?php echo $facVal; ?>">
    <div class="col-md-12">
      <ul class="row onway hotel_result" style="padding-top: 15px;padding-bottom: 15px;font-size: 12px;">
        <li class="hotel-img col-md-2  col-xs-6" style="width: 190px;">
          <?php if (isset($hotel_images[1])) { ?>
          <div id="banner-slide3_<?php echo $result->search_id; ?>">
            <ul class="bjqs">
             <?php foreach($hotel_images as $key=>$img){ ?>
             <li><img src="<?php echo $img; ?>" width="170" height="130" alt="<?php echo $result->hotel_name; ?>" title="<?php echo $result->hotel_name; ?>" border="0" /></li>
             <?php
             if($key==4){
              break;
            }
          } 
          ?>
        </ul>
      </div>
      <?php } elseif(isset($hotel_images[0])) { ?>
      <img src="<?php echo $hotel_images[0]; ?>" width="170" height="130" alt="<?php echo $result->hotel_name; ?>" border="0" />
      <?php }else{ ?>
      <img src="<?php echo base_url(); ?>public/img/noimage.jpg" width="170" height="130" alt="No Image" border="0" />
      <?php } ?>
    </li>
    <li class="col-md-7 htlRightSection col-xs-6" style="">
      <div class="htlDetailsCntr">
        <div class="htlname"><?php echo ucwords(strtolower(preg_replace("/[^a-z0-9_-]/i", " ", $result->hotel_name))); ?></div>
       <span class="star star<?php echo $star;?> marginTop5"></span>
        

        <div class="htllocation marginTop5"> <i class="fa fa-map-marker"></i> <?php echo $result->location; ?> <!-- <span>&nbsp;|&nbsp; Map</span> --></div>

        <span class="marginTop5">
          <?php if ($RoomService) { ?>
          <!--     <span title="Room Service Available" class="htl-amenities hourService active"></span> --> 
          <span title="Room Service Available" class="htl-amenities roomService active" ></span>
          <?php } ?>

          <?php if ($AC) { ?>
          <span title="AC Available" class="htl-amenities airCondition active"></span>
          <?php } ?>
          <?php if ($Bar) { ?>
          <span title="Bar Available" class="htl-amenities bar active"></span>
          <?php } ?>
          <?php if ($Business) { ?>
          <span title="Business Center Available" class="htl-amenities busiCenter active"></span>
          <?php } ?>
                 <!--  <?php if ($Cafe) { ?>
                    <span title="Cafe Available" class="htl-amenities coffeShop active"></span>
                  <?php } else { ?>
                    <span title="Cafe Unavailable" class="htl-amenities coffeShop"></span>
                    <?php } ?> -->
                    <?php if ($Gym) { ?>
                    <span title="Gym Available" class="htl-amenities gym active"></span>
                    <?php } ?>
                    <?php //if ($Internet) { ?>
                    <!-- <span title="Internet Available" class="htl-amenities internetAccess active"></span> -->
                    <?php  // } else { ?>
                    <!-- <span title="Internet Unavailable" class="htl-amenities internetAccess"></span> -->
                    <?php // } ?>
                    <?php if ($Pool) { ?>
                    <span title="Pool Available" class="htl-amenities pool active"></span>
                    <?php } ?>
                  <!--   <span title="Restaurant Available" class="htl-amenities restaurant active"></span>
                    <span title="Restaurant Unavailable" class="htl-amenities restaurant"></span>
                  -->
                  
                  <?php if ($WIFI) { ?>
                  <span title="Wifi Available" class="htl-amenities wifi active"></span>
                  <?php } ?>
                </span>
              </div>
            </li>
            <li class="col-md-2" style="margin-top: 30px;">
              <span class="airprice total_cost" style="font-weight: bold;font-size: 18px;">
                <i class="fa fa-rupee"></i> <?php echo number_format($avg_room_cost); ?>
                <!-- <br> -->
               <!-- <i class="fa fa-rupee"></i> <?php //echo number_format($result->org_amt); ?> -->
              </span>
              <span class="airprice per_room_cost" style="font-weight: bold;font-size: 18px;display:none">
                  <i class="fa fa-rupee"></i> <?php echo number_format($per_room_cost); ?>
             </span>
             <form name="frmHotelDetails" method="post" action="<?php echo site_url(); ?>hotels/details">
                <input type="hidden" name="callBackId" value="<?php echo base64_encode('travelguru'); ?>" />
                <input type="hidden" name="hotelCode" value="<?php echo $result->hotel_code; ?>" />
                <input type="hidden" name="searchId" value="<?php echo $result->search_id; ?>" />
                <button class="btn btn-primary" style="margin-top: 8px;">Select Room</button>
              </form>
            </li>
            <!-- <li class="col-md-2 htl-book">
            </li> -->
          </ul>
        </div>
      </div>
    </div>
    <!-- </div> -->

    <script class="secret-source">
      jQuery(document).ready(function($) {
        var id = '<?php echo $result->search_id; ?>';
        $('#banner-slide3_'+id).bjqs({
          animtype      : 'slide',
          height        : 139,
          width         : 160,
          responsive    : true,
          showmarkers : false
      // randomstart   : true
    });

      });
    </script>