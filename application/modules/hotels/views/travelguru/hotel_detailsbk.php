<?php $this->load->view('home/header');?>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/slider/thumbnail-slider.css"> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/slider/pgwslideshow.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/hotels.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/hotels_resp.css">
<style type="text/css">
  #rooms_info>.row:first-child .htl-rm-detail {
    margin-top: 0;
  }
  .pgwSlideshow .ps-current > ul {
    margin-left: -40px;
  }
  .pgwSlideshow .ps-current > ul > li img {
    height: inherit;
  }
</style>
<?php if(!empty($map['html'])) { echo $map['js']; }?>
<?php
  $session_data = $this->session->userdata('hotel_search_data');
    $city_arr = explode(',',$session_data['cityName']);
  //echo '<pre>';print_r($hotelFacilities);exit;
    $cityName = $city_arr[0];
  $adults_count = $session_data['adults_count'];
  $childs_count = $session_data['childs_count'];
  $rooms = $session_data['rooms'];
    $nights = $session_data['nights'];
  $checkIn = date('D, j M',strtotime(str_replace('/','-',$session_data['checkIn'])));
  $checkOut = date('D, j M',strtotime(str_replace('/','-',$session_data['checkOut'])));
  $journeyDate = date('Y-m-d',strtotime(str_replace('/','-',$session_data['checkIn'])));
//echo '<pre/>';print_r($session_data['childs_ages']);exit;
  $rating = 0;
  if(!empty($hotelReviews)) {
  foreach($hotelReviews as $hotelReview) {
  $rating += $hotelReview->overallrating;
  }
  $rating = ceil($rating/count($hotelReviews));
  }
  ?>
<div class="bottomSection flightsContainer23 marginTop5aa htel-det-up" style="    padding-bottom: 0;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="white-container marginTop5" style="margin-bottom: 0">
          <div class="row search-criteria">
            <div class="col-md-2 col-sm-3 col-xs-4">
              <span>City</span>
              <span class="font12"><?php echo $cityName; ?></span>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-4">
              <span>Check-In</span>
              <span class="font12"><?php echo $checkIn;?></span>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-4">
              <span>Check-Out</span>
              <span class="font12"><?php echo $checkOut;?></span>
            </div>
            <div class="col-md-1 col-sm-3 col-xs-4">
              <span>Night(s)</span>
              <span class="font12"><?php echo $nights;?></span>
            </div>
            <div class="col-md-1 col-sm-3 col-xs-4">
              <span>Room(s)</span>
              <span class="font12"><?php echo $rooms;?></span>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-4">
              <span>No.of People</span>
              <span class="font12"><?php echo $adults_count;?> Adult(s) , <?php echo $childs_count;?> Children</span>
            </div>
            <div class="col-md-2  col-sm-3 col-xs-4">
               <span class="btn btn-primary modify-search-btn" id="modify-search-btn"><i class="fa fa-search"></i> Modify search</span>
            </div>
          </div>
        </div>
        <?php $this->load->view('hotels/hotel_modify_search',$session_data);?>
      </div>
    </div>
  </div>
</div>
<?php if(!empty($hotelDetails)) { ?>
<div class="bottomSection flightsContainer23 marginTop5aa htel-det">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="">
          <div class="white-container22">
            <div class="row hotel-header">
              <div class="col-md-12">
                <div class="hotel-details5">
                  <div class="pull-left">
                    <span class="font20"><?php echo ucwords(strtolower($hotelDetails->hotel_name));?>, <?php echo ucwords(strtolower($hotelDetails->city_name));?></span>
                    <span class="star star<?php echo $hotelDetails->star;?>"></span><br>
                     <?php echo ucwords(strtolower($hotelDetails->address));?>
                     <br>
                  </div>
                  <div class="price_book pull-right">
                    <div class="price_block pricing">
                      <p class="htl-rm-price2"><span><i class="fa fa-rupee"></i> <?php echo number_format($hotelDetails->total_cost);?></span></p>
                      <p class="room-night"><strong >All inclusive price </strong> <span>for Per Room/Night</span></p>
                    </div>
                    <div class="price_block selecting">
                      <button href="#rooms_info" data-toggle="tab" id="book_button" class="btn btn-primary">SELECT ROOM</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="room-menu">
              <ul class="nav nav-tabs">
                <li class="active"><a id="jump_photos" href="#htl-photos">Photos &amp; Map</a></li>
                <li><a id="jump_rooms" href="#htl-rooms">Rooms</a></li>
                <li><a id="jump_desc" href="#htl-desc">Hotel Overview</a></li>
                <li><a id="jump_amenities" href="#htl-amenities">Amenities</a></li>
                <li><a id="jump_similar" href="#htl-similar">Similar Hotels</a></li>
               <!--  <li><a id="jump_policies" href="#htl-policies">Hotel Policy</a></li> -->
              </ul>
            </div>
          </div>
          <div class="white-container" id="htl-photos">
            <div class="row">
              <div class="col-md-7">
                <!-- <div class="font20 margin-t-b-15">Hotel Gallery</div> -->
                  <ul class="pgwSlideshow">
                   <?php if ($hotelImages != '') {
                  foreach ($hotelImages as $img) { ?>
                  <li><img src="<?php echo $img->image_url; ?>" /></li>
                  <?php } ?>
                  <?php } ?>
                  </ul>
              </div>
              <div class="col-md-5">
                <!-- <div class="font20 margin-t-b-15">Hotel Map</div> -->
                <?php echo $map['html']; ?>
              </div>
            </div>
          </div>
          <div id="htl-rooms">
            <div class="font20 margin-t-b-15">Rooms</div>
            <div class="htl-tabs-cntr marginTop15">
              <div class="tab-content">
                <div class="tab-pane active" id="htl-overview">
                  <!-- <h3>Room Details</h3> -->
                  <div class="hotel-room-row">
                    <div id="rooms_info22">
                      <div class="row">
                        <div class="htl-rm-detail2" id="rooms_info">
                          <div style="text-align:center" align="center"><img align="top" alt="loading.. Please wait.." src="<?php echo base_url();?>/public/img/ajax-circle-loader.gif" /></div>
                          <div class="row htl-ind-details" id="htl-ind-details">
                            <div class="col-md-12">
                              <p> </p>
                            </div>
                          </div>
                        </div>
                        <h4 class="light-blue-text text-right" style="margin-bottom: 0px;"><label class="hide-more-rooms"><i class="fa fa-arrow-down"></i> More Rooms</label></h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="htl-desc">
            <div class="font20 margin-t-b-15">Hotel Overview</div>
            <div class="white-container">
              <div class="row">
                <div class="col-md-12">
                  <span><?php echo $hotelDetails->description; ?>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div id="htl-amenities">
            <div class="font20 margin-t-b-15">HOTEL AMENITIES</div>
            <div class="white-container">
              <div class="row">
                <div class="col-md-12 htl-type3">
                  <ul>
                    <?php foreach($hotelFacilities as $fac) { ?>
                    <li><i class="fa fa-check" aria-hidden="true"></i> <?php echo $fac->description;?></li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div id="htl-similar">
            <div class="font20 margin-t-b-15">Similar Hotels</div>
            <div class="white-container">
              <div class="row" id="nearby_hotels">
                <div class="col-md-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="searchHdr2"><?php echo $hotelDetails->hotel_name;?></div>
                    </div>
                  </div>
                  <div class="row" >
                    <div class="col-md-12 htl-type2">
                      <?php
                      if(!empty($hotelDetails->image) && isset($hotelDetails->image)) {
                        $image_name = $hotelDetails->image;
                          $gttd = $image_name;
                      ?>
                      <img src="<?php echo $gttd;?>" width="110" height="110" alt="<?php echo $hotelDetails->room_type;?>" title="<?php echo $hotelDetails->room_type;?>" border="0" />
                      <?php }else { ?>
                      <img src="" width="110" height="110" alt="No Image" border="0" />
                      <?php } ?>
                      <div class="htl-type-dtls">
                        <div class="row">
                          <div class="col-md-12 htlDetailsCntr">
                            <!-- <div class="htlname"><?php echo $hotelDetails->hotel_name;?></div> -->
                            <div class="htlprice"><i class="fa fa-rupee" style="font-size:24px"></i><?php echo number_format($hotelDetails->total_cost);?></div>
                            <div class="htlreview"><span class="star star<?php echo $hotelDetails->star ?>"></span></div>
                            <div class="htllocation"><i class="fa fa-map-marker"></i> Area: <?php echo $hotelDetails->location  ?></div>
                          <a href="#"><button class="btn btn-primary">  VIEW DETAILS</button></a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div style="text-align:center" align="center" class="hotelloader"><img align="top" alt="loading.. Please wait.." src="<?php echo base_url();?>public/img/ajax-loader-bar.gif" /></div>
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php $this->load->view('home/footer');?>
<script type="text/javascript" src="<?php echo base_url();?>public/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-ui.js"></script>
<script src="<?php echo base_url();?>public/js/customize.js"></script>
<!-- Rooms Availability List-->
<script type="text/javascript">
    var callbackId = '<?php echo base64_encode($hotelDetails->api);?>';
    var sessionId = '<?php echo $hotelDetails->session_id;?>';
    var hotelId = '<?php echo $hotelDetails->hotel_code;?>';
    var latitude = '<?php echo $hotelDetails->latitude;?>';
    var longitude = '<?php echo $hotelDetails->longitude;?>';
    var searchId = '<?php echo $searchId;?>';
    var city = '<?php echo $cityName;?>';
    var contract = '';
    //alert(searchId);
    </script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/hotel/rooms_avail.js"></script>
<!-- Hotels Cities AutoComplete List-->
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/jquery-ui.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/hotels_city_list.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/slider/pgwslideshow.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var pgwSlideshow = $('.pgwSlideshow').pgwSlideshow();
    // pgwSlideshow.startSlide();
    // pgwSlideshow.reload({
    //   // autoSlide: true,
    //   transitionEffect : 'fading',
    //   // adaptiveDuration : 5000,
    //   // maxHeight : 500
    // });
});
$("#jump_photos,#jump_desc,#jump_rooms,#jump_amenities,#jump_similar,#jump_policies").on("click", function( e ) {
    e.preventDefault();
    $("body, html").animate({
      scrollTop: $($(this).attr('href')).offset().top
    }, 1000);   
});
</script>
<!-- Form Submit -->
<script type="text/javascript">
  $(document).ready(function() {
    $(".backtoresults").click(function() {
      document.searchHotels.submit();
    });
  });
  $(document).on("click", '.mapDiv', function ($e) {
    google.maps.event.trigger(map, 'resize');
  });
</script>
<script>
$("#book_button").on("click", function(e) {
    //alert('hi');
    e.preventDefault();
    $("body, html").animate({
        scrollTop: $($(this).attr('href')).offset().top - 15
    }, 600);
});
</script>
<script type="text/javascript">
$('.hide-more-rooms').on('click', function() {
    var _text = $(this).text();
    if(_text == ' More Rooms'){
    $(this).html('<i class="fa fa-arrow-up"></i> Hide Rooms');
    $('.rooms_loop+.rooms_loop').show("slide", { direction: "down" }, 500);
  } else{
      $(this).html('<i class="fa fa-arrow-down"></i> More Rooms');
      $('.rooms_loop+.rooms_loop').hide("slide", { direction: "down" }, 500);
  }
});
</script>