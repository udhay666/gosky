<?php
//print_r($result);
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
        //print_r($hotel_images);

    $facilities = explode(',',$result->hotel_facilities);
   
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

    $avg_room_cost = number_format(($result->total_cost / $nights)/$rooms,2);//exit;
 
    ?>
<div class="hotels-list searchHotel_box">
      <div class="hotels-item bg-light shadow-md rounded p-3 HotelInfoBox" data-price="<?php echo $avg_room_cost; ?>" data-star="<?php echo $star; ?>" data-hotel-name="<?php echo preg_replace("/[^a-z0-9_-]/i", " ", $result->hotel_name); ?>" data-location="<?php echo $area; ?>">
        <div class="row">
          <div class="col-md-4">
            <?php if (!empty($hotel_images)) { ?>
              <a href="#"><img class="img-fluid rounded align-top" src="<?php echo base_url().'supplier/'.$hotel_images[0] ?>" alt="<?php echo $result->hotel_name; ?>" style="height: 135px;width: 200px;" ></a>
            <?php } else { ?>
              <a href="#"><img class="img-fluid rounded align-top" src="<?php echo base_url() ?>public/img/noimage.jpg" alt="<?php echo $result->hotel_name; ?>"></a>
            <?php } ?>
          </div>
          <div class="col-md-8 pl-3 pl-md-0 mt-3 mt-md-0">
              <div class="row no-gutters">
              <div class="col-sm-9">
              <h5><a href="#" class="text-dark text-5"><?php echo $result->hotel_name; ?></a></h5>
              <p class="mb-2">
                  <span class="star star<?php echo $star; ?>"></span>
              </p>
              <p class="mb-2">
                  <span class="text-black-50"><i class="fas fa-map-marker-alt"></i> <?php echo $result->address; ?> <?php echo $result->location; ?></span>
              </p>
              <!-- <?php if($result->review_rating != ''){ ?>
              <p class="reviews mb-2">
                  <span class="reviews-score px-2 py-1 rounded font-weight-600 text-light"> <?php //echo $result->review_rating; ?></span> <span class="font-weight-600">Excellent</span> 
              </p>
            <?php } ?> -->
              <!-- <p class="text-danger mb-0">Last Booked - 18 hours ago</p> -->
              <!-- <p class="text-danger mb-0"><i class="fas fa-map-marker-alt"></i> <?php //echo $result[0]->address; ?></p> -->
              </div>
              <div class="col-sm-3 text-right d-flex d-sm-block align-items-center">
                  <!-- <div class="text-success text-3 mb-0 mb-sm-1 order-2 ">16% Off!</div> -->
                  <!-- <div class="d-block text-3 text-black-50 mb-0 mb-sm-2 mr-2 mr-sm-0 order-1"><del class="d-block"><i class="mdi mdi-currency-inr"></i> <?php //echo number_format($total_cost); ?></del></div> -->
                  <div class="text-dark text-7 font-weight-500 mb-0 mb-sm-2 mr-2 mr-sm-0 order-0"><h4><i class="mdi mdi-currency-inr"></i> <?php
                  //echo number_format($result->total_cost );
                   echo number_format($avg_room_cost); ?></h4>
                  </div>
                  <!-- <div class="text-black-50 mb-0 mb-sm-2 order-3 d-none d-sm-block">1 Room/Night</div> -->
                  <?php $params=base64_encode('hotel_crs/'.$result->hotel_code.'/'.$result->search_id); ?>
                  <a href="<?php echo site_url(); ?>hotels/details/<?= $params; ?>" class="btn btn-sm btn-primary order-4 ml-auto">SELECT ROOM</a>
               </div>
          </div>
          </div>
        </div>
      </div>
    </div>
<?php  } ?>