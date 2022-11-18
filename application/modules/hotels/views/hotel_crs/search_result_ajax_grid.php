<?php
// echo '<pre>'; print_r($result);exit;
if ($result != '') {
    $session_data = $this->session->userdata('hotel_search_data');
    $rooms = $session_data['rooms'];
    $nights = $session_data['nights'];
    $childs_count = $session_data['childs_count'];
    $totalPriceAry[] = $result->total_cost;
    $currency = $result->xml_currency;

    $tripRating = rand(1, 5);
    if (is_numeric($result->star))
        $star = $result->star;
    else
        $star = 0;

    if ($result->image != '')
        $hotel_images = explode(',', $result->image);
    else
        $hotel_images = '';

    if($result->image_category){
        $img_category_code=explode(',',$result->image_category);
    }
    // $facilities = array();
    $facilities = explode(',',$result->hotel_facilities);
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
        foreach ($facilities as $fac) {
            $fcode = $fac;
            if ($fcode == 'Wireless Internet Access' || $fcode == 'Free Wireless Internet access (inroom)' || $fcode == 'Free Wireless Internet access') {
                $WIFI = true;
                $facVal .= $fcode . ',';
            }
            if ($fcode == 'Bar' || $fcode == 'Bar / Lounge') {
                $Bar = true;
                $facVal .= $fcode . ',';
            }
            if ($fcode == 'Air Conditioned' || $fcode == 'Air Condition in rooms') {
                $AC = true;
                $facVal .= $fcode . ',';
            }
            if ($fcode == 'Restaurant' || $fcode == 'Restaurant(s)') {
                $Restaurant = true;
                $facVal .= $fcode . ',';
            }
            if ($fcode == 'Tea/Coffee Making Facilities') {
                $Cafe = true;
                $facVal .= $fcode . ',';
            }
            if ($fcode == 'Room Service' || $fcode == '24 Hour Room Service') {
                $RoomService = true;
                $facVal .= $fcode . ',';
            }
            if ($fcode == 'Business Centre' || $fcode == 'Business services') {
                $Business = true;
                $facVal .= $fcode . ',';
            }
            if ($fcode == 'Swimming Pool' || $fcode == 'Outdoor Swimming Pool' || $fcode == 'Indoor Heated Swimming Pool') {
                $Pool = true;
                $facVal .= $fcode . ',';
            }
            if ($fcode == 'Gym' || $fcode == 'Fitness Center') {
                $Gym = true;
                $facVal .= $fcode . ',';
            }
            if ($fcode == 'Internet Access') {
                $Internet = true;
                $facVal .= $fcode . ',';
            }
        }
    } else {
        $RoomService = true;
        $facVal .= 'Room Service,';
    }
    $result->total_cost;
    $avg_room_cost = number_format(($result->org_amt / $nights)/$rooms,2);//exit;
    // $avg_room_cost = $result->total_cost;
 ?>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 item-service grid-item has-matchHeight" >
    <div class="thumb">
        <a href="#">
            <?php //if (!empty($hotel_images)) { ?>
            <!-- <img src="<?php echo $hotel_images[0]; ?>" width="450" height="417" alt="<?php echo $result->hotel_name; ?>" sizes="(max-width: 450px) 100vw, 450px"> -->
            <?php //} else { ?>
            <!-- <img src="<?php echo base_url(); ?>public/img/noimage.jpg" width="270" height="250" alt="No Image" sizes="(max-width: 450px) 100vw, 270px"> -->
            <img src="<?php echo base_url().'supplier/'.$hotel_images[0] ?>" width="600" height="250" alt="<?php echo $result->hotel_name; ?>" >
            <?php //} ?>
        </a>
        <ul class="icon-list icon-group booking-item-rating-stars">
            <?php for($s=0;$s<$star;$s++){ ?>
            <li><i class="fa fa-star"></i></li>
            <?php } ?>
        </ul>
    </div>
     <h4 class="title" ><a href="#" class="st-link c-main"><?php echo $result->hotel_name; ?></a></h4>
    <i class="input-icon field-icon fa" style="padding: 3px 0 0 0;"><img src="<?php echo base_url() ?>public/images/svg/ico_map.svg" width="15px" height="15px" style="vertical-align: initial; "></i> <?php echo $result->address; ?>
    <div class="section-footer">        
        <div class="price-wrapper" style="padding: 8px 0px 0px 0px">
            <i class="input-icon field-icon fa"><img src="<?php echo base_url() ?>public/images/svg/ico_thunder.svg" style="vertical-align: initial;"></i> From</span>
            <span class="price"><i class="fa fa-dollar"></i> <?php echo $avg_room_cost; ?></span><span class="unit"> /night</span>
        </div>
        <div class="service-review">
            <form name="frmHotelDetails" method="post" action="<?php echo site_url(); ?>hotels/details">
                <input type="hidden" name="callBackId" value="<?php echo base64_encode("$result->api"); ?>" />
                <input type="hidden" name="hotelCode" value="<?php echo $result->hotel_code; ?>" />
                <input type="hidden" name="searchId" value="<?php echo $result->search_id; ?>" />
                <button class="btn btn-primary">BOOK NOW <i class="fa fa-angle-double-right"></i></button>
            </form>
        </div>
    </div>
</div>
<?php } ?>