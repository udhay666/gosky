<?php
	// echo '<pre>';print_r($session_data);exit;
if ($result != '') {
    // $session_data = $this->session->userdata('hotel_search_data');
    $session_data = unserialize($result->searcharray);
    $city_arr = explode(',',$session_data['cityName']);
    $cityName = $city_arr[0];
    $adults_count = $session_data['adults_count'];
    $childs_count = $session_data['childs_count'];
    $rooms = $session_data['rooms'];
    $nights = $session_data['nights'];
    $star = 0;
    $category = '';
    $currency = $result->currency;
    $star = $result->star;
    $address = $result->address;
    $hotel_image = $result->hotel_image;

    $total_cost = $result->total_cost;
    if (empty($result->location) || $result->location == '|') {
        $area = $cityName;
    } else {
        $area = str_replace('|', '', $result->location);
    }
// echo"<pre>";print_r($result);exit;
    ?>

<div class="row hotel-listing-item">
    <div class="HotelInfoBox" data-price="<?php echo $total_cost; ?>"  data-citycode="<?php echo $result->city_code; ?>"  data-hotelcode="<?php echo $result->hotel_code; ?>"     data-star="<?php echo $star; ?>" data-hotel-name="<?php echo preg_replace("/[^a-z0-9_-]/i", " ", $result->hotel_name); ?>" data-location="<?php echo $area; ?>">
        <div class="col-sm-4 col-xs-12 my-col">
            <div class="img-wrap"> 
                <?php $params=base64_encode('tbohotels/'.$result->hotel_code.'/'.$result->search_id); ?> 
                <a rel="nofollow" target="_blank" href="<?php echo base_url(); ?>hotel/details/<?= $params; ?>">
                <?php if($hotel_image=="https://b2b.tektravels.com/Images/HotelNA.jpg"){ $hotel_image = base_url()."assets/images/noimage-hotel.jpg"; }?>
                    <img data-src="<?php echo $hotel_image; ?>" src="<?php echo $hotel_image; ?>" onerror="this.onerror=null;this.src='https://asfartrip.com/public/assets/images/noimage-hotel.jpg';">
                </a>
            </div>
        </div>
        <div class="col-sm-5 col-xs-12 my-col">
            <h4 class="title text-uppercase b" style="margin-top: 5px;">
                <a rel="nofollow" target="_blank" href="<?php echo base_url(); ?>hotel/details/<?php echo $params; ?>">
                    <span class=" text-capitalize" style="margin-top: -4px;"></span> &nbsp;<?php echo $result->hotel_name; ?>
                </a>
            </h4>
            <div class="row-sm">
                <div class="col-sm-6 col-xs-6 ">

                    <p class="rate-bar">
                        <img class="img-rating" style="height: 25px;" src="<?php echo base_url(); ?>assets/images/stars/rating-<?php echo $star; ?>.png"> 
                    </p>  
                </div>
                <div class="col-sm-6 col-xs-6 ">
                    <!-- <img class="tripadvisor text-center" src="https://asfartrip.com/public/assets/images/stars/TA-119x20/TA-2.0.png" alt=""> -->
                </div>
            </div>
            <small> 
                <a style="text-decoration: underline;" rel="nofollow" target="_blank" href="<?php echo base_url(); ?>hotel/details/#street_modal"><i class="fa fa-map-marker"></i> <?php echo $result->address; ?> <?php echo $result->location; ?></a>
                <span class="txt_line__dot-separator"></span>
                <a style="text-decoration: underline;" rel="nofollow" target="_blank" href="<?php echo base_url(); ?>hotel/details/#street_modal"> Show on map</a>                
            </small>            
        </div>
        <div class="col-sm-3 my-col text-center">
            <div class="row-sm">
                <div class="col-xs-6 col-md-12 money-wrap">
                    <p class="price-note"><?php echo $rooms ?> Rooms, <?php echo $adults_count ?> Adults </p>
                    <h6 class="pay txt-green">Starting from</h6>
                    <span class="money">INR <span class="mount"><?php echo number_format($total_cost); ?></span></span>
                </div>
                <div class="col-xs-5 col-md-12 book-btn visible-lg">                
                    <a style="white-space: pre-wrap;" rel="nofollow" target="_blank" href="<?php echo base_url(); ?>hotels/details/<?= $params; ?>" class="btn btn-warning">Book Now ››</a><br>                    
                </div>
                <div class="col-xs-5 col-md-12  book-btn  money-wrap visible-xs">
                    <a style="white-space: pre-wrap;" rel="nofollow" href="<?php echo base_url(); ?>hotels/details/<?= $params; ?>" class="btn btn-warning">Book Now ››</a><br>                    
                </div>
            </div>
        </div>
    </div>
</div>

    


<?php  } ?>
