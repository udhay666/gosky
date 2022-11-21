<?php
// echo '<pre>';print_r($session_data);exit;
if ($result != '') {
    // $session_data = $this->session->userdata('hotel_search_data');
    $session_data = unserialize($result->searcharray);
    $city_arr = explode(',', $session_data['cityName']);
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
    <div class="HotelInfoBox" data-price="<?php echo $total_cost; ?>" data-citycode="<?php echo $result->city_code; ?>" data-hotelcode="<?php echo $result->hotel_code; ?>" data-star="<?php echo $star; ?>" data-hotel-name="<?php echo preg_replace("/[^a-z0-9_-]/i", " ", $result->hotel_name); ?>" data-location="<?php echo $area; ?>">
        <div class="row border_card mb-3 mainbg_color card_style hotel-listing-item">
            <div class="col-sm-12 col-md-3">
                <div class="">
                    <?php $params = base64_encode('tbohotels/' . $result->hotel_code . '/' . $result->search_id); ?>
                    <?php $nohotel_image = base_url() . "assets/images/noimage-hotel.jpg";
                    if ($hotel_image == "https://b2b.tektravels.com/Images/HotelNA.jpg") {
                        $hotel_image = base_url() . "assets/images/noimage-hotel.jpg";
                    } ?>
                    <span class="ht_img"><img src="<?php echo $hotel_image; ?>" alt="Hotel-Image" onerror="this.onerror=null; this.src='<?= $nohotel_image?>'"></span>


                </div>
            </div>
            <div class="col-sm-12 col-md-5 res_margin">
                <div>
                    <h3 class="ht_name_fx"><span class="ht_name_span"><?php echo $result->hotel_name; ?></span>
                        <span class="start_icon2">
                            <?php for ($i = 0; $i < $star; $i++) { ?>
                                <i class="fa fa-star"></i>
                            <?php
                            } ?>

                        </span>
                    </h3>
                    <h6 class="ht_name_fx ht_location"><span><i class="fa fa-map-marker"></i></span><span><?php echo $result->address; echo $result->location; ?></span></h6>
                    <h6 class="ht_name_fx ht_location" style="color: #000;"></h6>

                    <!-- <div class="ht_name_fx mb-3"> <span class="amnities"><i class="fa fa-broom"></i> Room service</span>
                        <span class="amnities"><i class="fa fa-swimmer"></i> Pool</span><span class="amnities"><i class="fa fa-utensils"></i> Restaurent</span>
                        <span class="amnities"><i class="fa fa-wifi"></i> Wifi</span>
                        <span class="amnities"><i class="fa fa-dumbbell"></i> Gym</span>
                    </div>
                    <span class="freebf mt-3"><i class="fas fa-mug-hot"></i> Free breakfast</span> -->
                </div>
            </div>
            <div class="col-1">
            </div>
            <div class="col-sm-12 col-md-3">
                <div class="ht_price_btnfx">
                    <h4 class="price">₹ <?php echo number_format($total_cost); ?> </h4>

                    <span class="btn_det_fx">
                        <a href="<?php echo base_url(); ?>hotels/details/<?php echo $params; ?>" class="btn-sm  btn_font">Select Room</a>


                    </span>
                </div>
            </div>

        </div>
    </div>


<?php  } ?>