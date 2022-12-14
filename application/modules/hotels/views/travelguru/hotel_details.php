<?php $this->load->view('home/header');?>
<link href="<?php echo base_url() ?>public/vendor/flexslider/flexslider.css" rel="stylesheet" type="text/css">
<?php 
  if(!empty($map['html'])) { echo $map['js']; }
  $session_data = $this->session->userdata('hotel_search_data');
  $city_arr = explode(',',$session_data['cityName']);
  // echo '<pre>';print_r($hotelImages);exit;
  $cityName = $city_arr[0];
  $adults_count = $session_data['adults_count'];
  $childs_count = $session_data['childs_count'];
  $rooms = $session_data['rooms'];
  $nights = $session_data['nights'];
  $checkIn = date('D, j M',strtotime(str_replace('/','-',$session_data['checkIn'])));
  $checkOut = date('D, j M',strtotime(str_replace('/','-',$session_data['checkOut'])));
  //echo '<pre/>';print_r($session_data['childs_ages']);exit;
  $rating = 0;
  if(!empty($hotelReviews)) {
    foreach($hotelReviews as $hotelReview) {
      $rating += $hotelReview->overallrating;
    }
    $rating = ceil($rating/count($hotelReviews));
  }
?>
<section class="section-padding inner-page">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="form_wizard wizard_horizontal">
               <ul class="wizard_steps">
                  <li class="active_step">
                     <a href="javascript:;">
                        <span class="step_no wizard-step">1</span>
                        <span class="step_descr">Choose your rooms</span>
                     </a>
                  </li>
                  <li>
                     <a href="javascript:;">
                        <span class="step_no wizard-step">2</span>
                        <span class="step_descr">Enter your details</span>
                     </a>
                  </li>
                  <li>
                     <a href="javascript:;">
                        <span class="step_no wizard-step">3</span>
                        <span class="step_descr">Secure your booking</span>
                     </a>
                  </li>
               </ul>
            </div>
         </div>
      </div>
      <div class="row no-gutters mt-4">
         <div class="col-md-8">
            <div class="hotel-details">
               <h3><?php echo $hotelDetails->hotel_name.', '.$hotelDetails->city_name;  ?> <span class="star star4<?php echo $hotelDetails->star  ?>"></span></h3>
               <small>Location: <b><?php echo $hotelDetails->location;  ?></b> | <?php echo $hotelDetails->address;  ?>, | <a href="javascript:;" class="maps ajax-tabs" data-id="map"><i class="mdi mdi-map-marker"></i> <u>View Map</u></a></small>
            </div>
            <div class="row2 ajax-tab-content ajax-content" style="display: none;">
               <div class="loaddiv">
                  <div class='row2' id='loading' style='text-align: center;padding: 30px 0;'>
                     <div id='loader' style="margin: auto;left: 0;"></div>
                  </div>
               </div>
               <div class="resultdiv"></div>
               <div class="mapdiv" style="display: none;">
                  <iframe src = "https://maps.google.com/maps?q=<?php  echo $hotelDetails->latitude;?>,<?php  echo $hotelDetails->longitude;?>&hl=es;z=14&amp;output=embed" width="100%" height="180" frameborder="0" style="border:0" allowfullscreen></iframe>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="price-details">
               <a id="jump_rooms2" href="#htl-rooms" class="btn book-btn">Choose Room <span class="mdi mdi-chevron-down"></span></a>
            </div>
            <div class="price-details">
               <h2 class="price-tag">
               <small>from </small>
               <i class="mdi mdi-currency-inr"></i><span><?php echo number_format($hotelDetails->total_cost/$nights); ?></span>
               <small>for 2 Nights</small>
               </h2>
            </div>
         </div>
      </div>
      <div class="row mt-2">
         <div class="container fixed-tab">
            <div class="row">
               <div class="col-lg-12 col-md-12">
                  <div class="ajax-tab text-left">
                     <ul>
                        <li><a href="#htl-rooms" class="active">Rooms &amp; Rates</a></li>
                        <?php if(!empty($hotelDetails->description)){ ?>
                        <li><a href="#htl-desc">Hotel Description</a></li>
                        <?php } ?>
                        <?php if(!empty($hotelFacilities)){ ?>
                        <li><a href="#htl-amenities">Amenities</a></li>
                        <?php } ?>
                        <?php if(!empty($hotelDetails->description)){ ?>
                        <li><a href="#htl-policy">Hotel Policy</a></li>
                        <?php } ?>
                        <!-- <li><a href="#htl-reviews">Verified Guest Reviews</a></li> -->
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="white-container accordions-content box-shadow">
               <div class="row">
                  <div class="col-lg-8 col-md-8">
                     <!-- <div id="gallery-div" class="imgs-grid imgs-grid-7"></div> -->
                     <div id="slider" class="flexslider">
                        <ul class="slides">
                           <?php foreach($hotelImages as $img) { ?>
                           <li>
                              <img src="<?php echo $img->image_url ?>" alt="<?php echo $hotelDetails->hotel_name ?>" height="320" style="height: 320px">
                           </li>
                           <?php } ?>
                        </ul>
                     </div>
                     <div id="carousel" class="flexslider">
                        <ul class="slides">
                           <?php foreach($hotelImages as $timg) { ?>
                           <li>
                              <img src="<?php echo $timg->image_url ?>" alt="<?php echo $hotelDetails->hotel_name ?>" height="90" style="height: 90px">
                           </li>
                           <?php } ?>
                        </ul>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-4">
                     <div class="row2 mt-3">
                        <h6><i class="mdi mdi-clock"></i> Check-in : <small><?php echo $hotelDetails->time_checkin ?></small></h6>
                        <h6><i class="mdi mdi-clock"></i> Check-out : <small><?php echo $hotelDetails->time_checkout ?></small></h6>
                        <p>See <a id="jump_rooms2" class="blue-link" href="#htl-rooms"> <u>Room and Rates</u></a> for more details</p>
                     </div>
                     <hr>
                     <div class="row2">
                        <p><b>Featured Amenities <a id="jump_amenities2" class="blue-link" href="#htl-amenities"> <u>View More</u></a></b></p>
                        <ul class="htl-amenities">
                           <li class="active">
                              <button type="button" class="feature-btn"><i class="mdi mdi-dumbbell"></i></button>
                              <label class="control-label feature-label">Fitness Center</label>
                           </li>
                           <li class="active">
                              <button type="button" class="feature-btn"><i class="mdi mdi-wifi"></i></button>
                              <label class="control-label feature-label">Wifi</label>
                           </li>
                           <li class="active">
                              <button type="button" class="feature-btn"><i class="mdi mdi-coffee"></i></button>
                              <label class="control-label feature-label">Breakfast Services</label>
                           </li>
                           <li class="active">
                              <button type="button" class="feature-btn"><i class="mdi mdi-silverware-variant"></i></button>
                              <label class="control-label feature-label">Room Service</label>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="htl-rooms" class="detail-content room-details row mt-3">
         <div class="col-lg-12 col-md-12">
            <h3 class="accordions-heading">Rooms &amp; Rates <small>(<?php echo $nights; ?> nights: <?php echo $checkIn;?> - <?php echo $checkOut;?>) <!-- <a href="javascript:;" class="blue-link modifySearch">Change Dates</a> --></small><!--  <span class="fa fa-angle-down pull-right"></span> --></h3>
            <div class="accordions-content">
               <div class="change-rooms" style="display: block;">
                  <?php $this->load->view('modify_rates', $session_data) ?>
               </div>
               <div class="rm-rates">
                  <h3 class="accordions-heading">Available Rooms</h3>
                  <div class="room-details white-container box-shadow" id="rooms_info">
                    <?php $this->load->view('hotels/blank');?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php if(!empty($hotelDetails->description)){ ?>
      <div id="htl-desc" class="detail-content room-details row mt-3">
         <div class="col-lg-12 col-md-12">
            <h3 class="accordions-heading">Hotel Description</h3>
            <div class="white-container accordions-content box-shadow">
               <p class="mb-0"><?php echo strip_tags(html_entity_decode($hotelDetails->description));?></p>
            </div>
         </div>
      </div>
      <?php } ?>
      <?php if(!empty($hotelFacilities)){ ?>
      <div id="htl-amenities" class="detail-content row mt-3">
        <div class="col-lg-12 col-md-12">
          <h3 class="accordions-heading">Hotel Amenities</h3>
          <div class="white-container accordions-content box-shadow hotel-dtls-amenities">
            <?php if(!empty($general_facs)){ ?>
            <div class="row">
              <div class="col-lg-3 col-md-3">
                <h4>General</h4>
              </div>
              <div class="col-lg-9 col-md-9">
                <ul>
                  <?php foreach($general_facs as $gfac) { ?>
                  <li><span>??</span> <?php echo $gfac->description;?></li>
                  <?php } ?>
                </ul>
              </div>
            </div>
            <?php } ?>
            <?php if(!empty($services_facs)){ ?>
            <div class="row">
              <div class="col-lg-3 col-md-3">
                <h4>Services</h4>
              </div>
              <div class="col-lg-9 col-md-9">
                <ul>
                  <?php foreach($services_facs as $sfac) { ?>
                  <li><span>??</span> <?php echo $sfac->description;?></li>
                  <?php } ?>
                </ul>
              </div>
            </div>
            <?php } ?>
            <?php if(!empty($rooms_facs)){ ?>
            <div class="row">
              <div class="col-lg-3 col-md-3">
                <h4>Room Amenities</h4>
              </div>
              <div class="col-lg-9 col-md-9">
                <ul>
                  <?php foreach($rooms_facs as $rfac) { ?>
                  <li><span>??</span> <?php echo $rfac->description;?></li>
                  <?php } ?>
                </ul>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php } ?>
      <div id="htl-policy" class="detail-content row mt-3">
         <div class="col-lg-12 col-md-12">
            <h3 class="accordions-heading">Hotel Policy</h3>
            <div class="white-container accordions-content box-shadow">
               <div class="hotel-policies">
                  <div class="row">
                     <div class="col-lg-2 col-md-2 col-sm-6">
                        <h4>Check-in &amp; Check-out</h4>
                     </div>
                     <div class="col-lg-10 col-md-10 col-sm-6">
                        <p class="mb-0">Check-in: from <?php echo $hotelDetails->time_checkin ?> Check-out: before <?php echo $hotelDetails->time_checkout ?></p>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12 col-md-12">
                        <ul class="check-lists">
                           <li><i class="mdi mdi-check"></i> The primary guest must be at least 18 years of age to check into this hotel(s).</li>
                           <li><i class="mdi mdi-check"></i> As per Government regulations, It is mandatory for all guests above 18 years of age to carry a valid photo identity card & address proof at the time of check-in. In case, check-in is denied by the hotel(s) due to lack of required documents, you cannot claim for the refund & the booking will be considered as NO SHOW.</li>
                           <li><i class="mdi mdi-check"></i> Unless mentioned, the tariff does not include charges for optional room services (such as telephone calls, room service, mini bar, snacks, laundry extra bed etc.). In case, such additional charges are levied by the hotel(s), we shall not be held responsible for it.</li>
                           <li><i class="mdi mdi-check"></i> Extra bed can be accommodated with a folding cot or a mattress, subject to room size & availability.</li>
                           <li><i class="mdi mdi-check"></i> The hotel(s) reserves the right to decline accommodation to localites/same city residents. Travelguru.com will not be responsible for any check-in declined by the hotel(s) or any refunds due to the above mentioned reason.</li>
                           <li><i class="mdi mdi-check"></i> The hotelier may charge your Card/Account for additional cancellation charges, if any.</li>
                           <li><i class="mdi mdi-check"></i> All hotel(s) charge a compulsory Gala Dinner Supplement on Christmas and New Year's eve. Other special supplements may also be applicable during festival periods such as Dusshera, Diwali etc. Any such charge would have to be cleared directly at the hotel(s).</li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- <div id="htl-reviews" class="detail-content row mt-3">
         <div class="col-lg-12 col-md-12">
            <h3 class="accordions-heading">Guest Reviews</h3>
            <div class="white-container accordions-content box-shadow">
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis autem nostrum cupiditate, at temporibus molestiae ipsam, accusamus vel ratione, veritatis, dignissimos. Blanditiis facere dolorem eum, id natus corporis, veritatis sequi?
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel, omnis dolor, corrupti quos inventore alias possimus minus incidunt consequuntur pariatur veniam velit non sed et cumque illo, laborum rerum aspernatur.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio rerum magnam doloremque quidem, expedita eligendi, earum fugit vel quis quos maiores temporibus minima molestias cum in excepturi possimus ea aut!</p>
            </div>
         </div>
      </div> -->
   </div>
</section>

<?php $this->load->view('home/footer');?>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/flexslider/jquery.flexslider-min.js"></script>
<script type="text/javascript">
    var callbackId = '<?php echo base64_encode($hotelDetails->api);?>';
    var sessionId = '<?php echo $hotelDetails->session_id;?>';
    var hotelId = '<?php echo $hotelDetails->hotel_code;?>';
    var latitude = '<?php echo $hotelDetails->latitude;?>';
    var longitude = '<?php echo $hotelDetails->longitude;?>';
    var searchId = '<?php echo $searchId;?>';
    var city = '<?php echo $cityName;?>';
    var contract = '';
</script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/hotel/rooms_avail.js"></script>

<!-- <script type="text/javascript">
  $(document).ready(function() {
    $(".backtoresults").click(function() {
      document.searchHotels.submit();
    });
  });
  $(document).on("click", '.mapDiv', function ($e) {
    google.maps.event.trigger(map, 'resize');
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
</script> -->

<script type="text/javascript">
(function () {
  var $window = $(window), flexslider;
  function getGridSize() {
    return (window.innerWidth < 600) ? 3 : (window.innerWidth < 900) ? 4 : 4;
  }
  $window.on('load',function () {
    $('#carousel').flexslider({
      animation: "slide",
      animationLoop: false,
      touch: true,
      controlNav: false,
      keyboard: true,
      move: 0,
      prevText: '<i class="mdi mdi-chevron-left"></i>',
      nextText: '<i class="mdi mdi-chevron-right"></i>',
      slideshow: false,
      itemWidth: 205,
      itemMargin: 10,
      asNavFor: '#slider',
      minItems: getGridSize(), // use function to pull in initial value
      maxItems: getGridSize() // use function to pull in initial value
    });

    $('#slider').flexslider({
      animation: "slide",
      controlNav: false,
      prevText: '<i class="mdi mdi-chevron-left"></i>',
      nextText: '<i class="mdi mdi-chevron-right"></i>',
      animationLoop: false,
      slideshow: false,
      sync: "#carousel"
    });
  });
}());
</script>

<script type="text/javascript">
  var header = $(".fixed-tab");
  var posFromTop = header.offset().top;
  $(window).on("scroll", function(e) {
    var scrollTop = $(window).scrollTop();
    if(scrollTop > posFromTop) {
      header.addClass("fixed");
      $('.detail-content').addClass("fixed");
    } else {
      header.removeClass("fixed");
      $('.detail-content').removeClass("fixed");
    }
  });
</script>

<script type="text/javascript">
  $(document).ready(function () {
      $(document).on("scroll", onScroll);
      //smoothscroll
      $('.ajax-tab a[href^="#"], #jump_rooms2,#jump_reviews2,#jump_amenities2').on('click', function (e) {
          e.preventDefault();
          $(document).off("scroll");
          
          $('.ajax-tab a').each(function () {
              $(this).removeClass('active');
          })
          $(this).addClass('active');
        
          var target = this.hash;
          $target = $(target);
          $('html, body').stop().animate({
              'scrollTop': $target.offset().top
          }, 600, 'linear', function () {
              // window.location.hash = target;
              $(document).on("scroll", onScroll);
          });
      });
  });

  function onScroll(event){
    var scrollPos = $(document).scrollTop();
    $('.ajax-tab a').each(function () {
      var currLink = $(this);
      var refElement = $(currLink.attr("href"));
      var headerheight = $(".fixed-tab").height()+35;
      if (refElement.position().top - headerheight <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
          $('.ajax-tab ul li a').removeClass("active");
          currLink.addClass("active");
      }
      else{
          // currLink.removeClass("active");
      }
    });
  }
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $(".ajax-tabs").click(function() {
      $(".resultdiv").html('');
      var $html2 ='';
      var $this = $(this);
      var $dataId = $(this).attr('data-id');
      if($dataId == 'map') {
        $html2 = $('.mapdiv').html();
        $(".ajax-tabs").not('.maps').removeClass('active');
      }else{
        $html2 = '';
        $(".resultdiv").html('');
        $(".ajax-tabs").removeClass('active');
        return false;
      }
      // console.log($dataId);

      // $("#loaddiv").show();
      $(".ajax-content").hide();
      $(this).toggleClass('active');

      if($(this).hasClass('active')){
        $.ajax({
          // url: 'this.href',
          beforeSend: function() {
            $(".loaddiv").show();
            $this.parent().parent().parent().find(".ajax-content").show();
          },
          success: function(html) {
            // console.log($(this));
            $(".loaddiv").hide();
            $this.parent().parent().parent().find(".ajax-content").show();
            $(".resultdiv").html($html2);
          }
        });
      }
      return false;
    });
  });
</script>

<script type="text/javascript">
  $('.pop-content').hide();
  $(document).on('mouseover', '.pophover .pop-i', function() {
    $(this).parent().find('.pop-content').show();
  });
  $(document).on('mouseleave', '.pophover .pop-i', function() {
    $(this).parent().find('.pop-content').hide();
  });
</script>