<?php $this->load->view('home/home_template/header');?>
<?php 
  if(!empty($map['html'])) { echo $map['js']; }
  // $session_data = $this->session->userdata('hotel_search_data');
  $session_data = unserialize($hotel_temp_detail->searcharray);
  $city_arr = explode(',',$session_data['cityName']);
  // echo '<pre>';print_r($hotel_temp_detail);exit;
  $cityName = $city_arr[0];
  $adults_count = $session_data['adults_count'];
  $childs_count = $session_data['childs_count'];
  $rooms = $session_data['rooms'];
  $nights = $session_data['nights'];
  $checkIn = date('D, j M',strtotime(str_replace('/','-',$session_data['checkIn'])));
  $checkOut = date('D, j M',strtotime(str_replace('/','-',$session_data['checkOut'])));
  //echo '<pre/>';print_r($session_data['childs_ages']);exit;
if(empty($hotelDetails->HotelName)){
    $error = 'Booking failed or the price may be changed .Please Contact Admin';
    redirect('home/error_page/' . base64_encode($error));
}
?>         
         
<style>
.list-amenity li::before {
  position: absolute;
  top: -3px;
  left: 0;
  font-size: 18px;
  content: "";
  color: #26ae7a;
  font-family: "Material Icons";
  display: inline-block;
}
</style>

<!-- ========================= SECTION PAGETOP  ========================= -->
<section class="section-pagetop">
    <div class="container">
        <div class="timer-block pull-right">
            <i class="material-icons">&#xE425;</i>
            <small>Prices may change after</small>
            <big class="timer" id="booking-countdown">30:00</big>
        </div>
        <ol class="breadcrumb pull-left">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i></a></li>
            <li><a href="#">Hotels</a></li>
            <li><a href="#"><?php echo $cityName; ?></a></li>
            <li class="active"><?php echo $hotelDetails->HotelName; ?></li>
        </ol>

    </div> <!-- container // -->
</section> 
<!-- ========================= SECTION PAGETOP END // ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content">
    <div class="container">

        <header class="heading-top-hotel row-sm">
            <div class="col-md-7 col-sm-6">
                <h1 class="title"><?php echo $hotelDetails->HotelName.', '.$cityName;  ?> </h1>
                <address style="margin-bottom: 5px"><small> <i class="fa fa-map-marker"></i>  <?php echo $hotelDetails->Address;  ?></small></address>
                <div>
                                            <img style="height: 15px; width: auto; margin-right: 15px;" title="2" src="<?php echo base_url(); ?>assets/images/stars/rating-<?php echo $hotelDetails->StarRating  ?>.png">
                                                                <!-- <img style="height: 15px; width: auto" title="2.0" alt="tripadvisor" src="https://www.tripadvisor.com/img/cdsi/img2/ratings/traveler/2.0-47560-5.svg" class="ta-image" target="_blank"> -->
                                    </div>
            </div> <!-- col // -->
            <div class="col-md-3 col-sm-3">
                <p class="price-wrap  pull-right text-center">
                    <var class="price" id="min-price">                        
                    INR <?php echo number_format($hotel_temp_detail->total_cost); ?></var>
                    <small>1 Room For <?php echo $nights ?> Nights</small>
                </p>
            </div> <!-- col // -->	
            <div class="col-md-2 col-sm-3">
                <a href="javascript:;" class="btn btn-warning btn-block btn-lg book-now-scroll" id="book-now-scroll">Select Room</a>
                <small class="txt-green b show p5"> <em class="fa fa-check"></em> Best Price Guaranteed</small>
            </div> <!-- col // -->	
        </header> <!-- row, heading-top-hotel// -->

        <section class="panel panel-default p15">
            <div class="row-sm">
                <main class="col-sm-8">
                    <div id="hotel_gallery" style="display:none;">                                            
                    <?php  foreach($hotelDetails->images as $img) { ?> 
                        <img alt="" src=""  data-image="<?php echo $img ?>">                                
                        
                        <?php  } ?> 
                </div>

                </main><!-- col // -->
                <aside class="col-sm-4">
                    <link rel="stylesheet" href="https://api.tiles.mapbox.com/mapbox.js/v2.1.8/mapbox.css">
<style>
    .map-street-container{height: 100%}    
    @media only screen and (max-width: 992px) {
        .map-street-container{height: 50%}    
    }
</style>
<script src='https://api.tiles.mapbox.com/mapbox.js/v2.1.8/mapbox.js'></script>
<address class="wrap-map-sm">
    <div id="right-map-small" class="hidden-sm hidden-xs" style="width: 100%; height: 220px; display: none;" data-toggle="modal" data-target="#street_modal"></div>
    <div class="btn-views-wrap btn-group btn-group-sm" role="group" aria-label="...">
        <a href="#nearby_modal" data-toggle="modal" class="btn btn-default">Attractions</a>
        <a href="#street_modal" data-toggle="modal" class="btn btn-default">Map / Street view</a>
    </div>

</address> <!-- wrap-map-sm // -->
    <article class="panel-tab-places">
        <div class="blok-header"><h4 class="title">MAP VIEW</h4></div>
        
        
    </article> <!-- panel-tabs -->


<!-- Modal MAP VIEW -->
<div id="nearby_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nearby Attractions</h4>
            </div>
            <main class="modal-map-body" style="height: 600px;">
                <!-- ----------- map modal inner ----------- --> 
                <!-- Hotel Popup -->
                <div>
                    <div class="card-wrap" >
                        <article class="card item-hotel" style="z-index: 9999;">        
                            <div class="info-wrap">
                                <div class="title-wrap" style="max-height: 90px; height: auto">
                                                                            <small class="type"><img class="img-rating" src="<?php echo base_url(); ?>assets/images/stars/rating-<?php echo $hotelDetails->StarRating  ?>.png"/> </small>
                                                                        <h4 class="title"><?php echo $hotelDetails->HotelName; ?> </h4>                
                                </div>            
                            </div>
                            <div class="bottom-wrap cfx">
                                <div class="pull-right text-center">
                                    <button type="button" class="btn btn-warning pull-right" onclick="$('#book-now-scroll').click();" data-dismiss="modal" aria-label="Close" >Select Room</button>                  
                                </div>                                
                            </div>
                        </article>
                    </div>
                </div>  
                <!-- End: Hotel Popup -->
                <map id="map" style="background-color: #ccc; height: 600px; display: block;"></map>                
                <aside class="modal-map-filter">
                    <div class="hidden-xs">
                        <h4 class="h4">Distance From Hotel</h4>
                        <select class="distance-select form-control" name="distance" id="distance">
                            <option value="2">2 KM</option>
                            <option selected="selected" value="5">5 KM</option>
                            <option value="10">10 KM</option>
                            <option value="20">20 KM</option>
                        </select>
                    </div>
                    <div class="modal-filter-wrap" id="map-filters">
                                                    <div class="checkbox"> <label class="dist-bus"><input class="filter" type="checkbox" checked value="0"> <ins></ins> <i class="map-icon"></i> <span class="hidden-xs">Bus Stop</span></label></div>
                                                    <div class="checkbox"> <label class="dist-mosque"><input class="filter" type="checkbox" checked value="1"> <ins></ins> <i class="map-icon"></i> <span class="hidden-xs">Mosque</span></label></div>
                                                    <div class="checkbox"> <label class="dist-halal"><input class="filter" type="checkbox" checked value="2"> <ins></ins> <i class="map-icon"></i> <span class="hidden-xs">Halal Food</span></label></div>
                                                    <div class="checkbox"> <label class="dist-restaurant"><input class="filter" type="checkbox" checked value="3"> <ins></ins> <i class="map-icon"></i> <span class="hidden-xs">Other Food</span></label></div>
                                                    <div class="checkbox"> <label class="dist-metro"><input class="filter" type="checkbox" checked value="4"> <ins></ins> <i class="map-icon"></i> <span class="hidden-xs">Train Station</span></label></div>
                                                    <div class="checkbox"> <label class="dist-mall"><input class="filter" type="checkbox" checked value="5"> <ins></ins> <i class="map-icon"></i> <span class="hidden-xs">Shopping Mall</span></label></div>
                                                    <div class="checkbox"> <label class="dist-medical"><input class="filter" type="checkbox" checked value="6"> <ins></ins> <i class="map-icon"></i> <span class="hidden-xs">Medical Center</span></label></div>
                                                                                              
                </aside>
                <!-- ----------- map modal inner end//----------- -->
            </main> <!-- modal-body// -->
        </div> <!-- modal-content// -->
    </div> <!-- modal-dialog// -->
</div>
<!-- Modal MAP VIEW .end// -->


<!-- Modal STREET VIEW -->
<div id="street_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Map / Street view</h4>
            </div>
            <main class="modal-map-body row no-gutter" id="modal-street-body" style="height: 600px;">
                <!-- ----------- map modal inner ----------- -->
                <div class="map-street-container">
                    <map id="map-view" class="pull-left col-md-6 col-xs-12" style="height: 100%; border: 3px solid #fff;"></map>                                
                    <map id="steet-view" class="pull-left col-md-6 col-xs-12" style="height: 100%; border: 3px solid #fff;"></map>                
                </div>
                <!-- ----------- map modal inner end//----------- -->
            </main> <!-- modal-body// -->
        </div> <!-- modal-content// -->
    </div> <!-- modal-dialog// -->
</div>
<!-- Modal STREET VIEW .end// -->

<input type="hidden" id="siteUrl" value="<?= site_url(); ?>">

    <script type="text/javascript" defer="defer">
        var lat = "<?php  echo $hotelDetails->lat;?>";
     var long = "<?php  echo $hotelDetails->long;?>";
        L.mapbox.accessToken = 'pk.eyJ1IjoiYXNmYXJ0cmlwIiwiYSI6ImNpdjIydzBidzAwMDQydHBsY29kdzZkMTgifQ.FAz6x-XPzbK8z3byN1WqAg';
        var map = L.mapbox.map('map')
                .setView([lat, long], 14).addLayer(L.mapbox.tileLayer('examples.map-h67hf2ic')); //'examples.map-h67hf2ic'
        // Keep our place markers organized in a nice group.
        var overlays = L.layerGroup().addTo(map);
        $('#nearby_modal').on('shown.bs.modal', function () { // chooseLocation is the id of the modal.
            loadMarkers();
        });
        $("#distance").on("click", function () {
            loadMarkers();
        });
        //var layers = null;
        var cache = {};
        var layers = null;
        function loadMarkers() {
            map.invalidateSize();
            var distance = $("#distance").find(":selected").val();
            if (distance in cache) {
                layers = cache[ distance ];
                filterMarkers(layers);
            } else {
                $.getJSON('https://asfartrip.com/en/hotel/loadNearByLocations/' + lat + '/' + long + '/' + distance, function (data) {
                    cache[distance] = data;
                    layers = cache[ distance ];
                    filterMarkers(layers);
                });
            }
        }
        function filterMarkers() {
            // then remove any previously-displayed marker groups        
            overlays.clearLayers();
            L.marker(L.latLng(lat, long), {
                icon: L.icon({iconUrl: 'https://asfartrip.com/public/assets/images/icons/markers/hotel.png'})
            }).addTo(overlays);
            // Get the Selected Catgories
            var categories = [];
            $('#map-filters input:checked').each(function () {
                categories.push(parseInt($(this).val()));
            });
            //console.log(categories);
            $.each(layers, function (index, venues) {
                //console.log(index);            
                //if (index in categories) {
                if ($.inArray(parseInt(index), categories) !== -1 || categories.length === 0) {
                    //venues.forEach(function (venue) {
                    $.each(venues, function (index, venue) {
                        var latlng = L.latLng(venue.lat, venue.lng);
                        var marker = L.marker(latlng, {
                            icon: L.icon({
                                iconUrl: 'https://asfartrip.com/public/assets/images/icons/markers/' + venue.icon,
                                iconSize: [25, 35]
                            })
                        }).bindPopup('<div><h1>' + venue.name + '</h1><span class="skin-color">' + venue.distance + ' KM </span><small><a target="_blank" href="https://foursquare.com/v/' + venue.id + '">Photos</a></small></div>').addTo(overlays);
                    });
                }
            });
        }
        $('.filter').on("click", function () {
            filterMarkers();
        });
        function rightSmallMap() {
            var map_div = document.getElementById('right-map-small');
            map_div.style.display = "block";
            var rightMap = L.mapbox.map(map_div)
                    .setView([lat, long], 12).addLayer(L.mapbox.tileLayer('mapbox.streets')); //'mapbox.streets'        
            var overlays = L.layerGroup().addTo(rightMap);
            L.marker(L.latLng(lat, long), {
                icon: L.icon({iconUrl: 'https://asfartrip.com/public/assets/images/icons/markers/hotel.png'})
            }).addTo(overlays);
            rightMap.dragging.disable();
            rightMap.touchZoom.disable();
            rightMap.doubleClickZoom.disable();
            rightMap.scrollWheelZoom.disable();
        }
        rightSmallMap();
    </script>
    <script type="text/javascript" defer="defer">
        function initialize() {
            var fenway = {lat: lat, lng: long};
            var map = new google.maps.Map(document.getElementById('map-view'), {
                center: fenway,
                zoom: 14
            });
            var panorama = new google.maps.StreetViewPanorama(
                    document.getElementById('steet-view'), {
                position: fenway,
                pov: {
                    heading: 34,
                    pitch: 10
                }
            });
            var marker = new google.maps.Marker({
                position: fenway,
                map: map,
                icon: '<?php echo base_url(); ?>assets/images/icons/markers/hotel.png',
                animation: google.maps.Animation.DROP,
            });
            marker.addListener('click', toggleBounce);
            function toggleBounce() {
                if (marker.getAnimation() !== null) {
                    marker.setAnimation(null);
                } else {
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                }
            }
            map.setStreetView(panorama);
        }
        $('#street_modal').on('shown.bs.modal', function () {
            if (!$.trim($('#map-view').html()).length) {
                initialize();
            }
        });
    </script>
<script  async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOEMXVG0qMZ6nLR0kUTMoVwBP54BftWu4&language=en" type="text/javascript"></script>
                </aside><!-- col // -->
            </div><!--  row// -->
        </section> <!-- panel // -->

        <div class="row-sm">
            <main class="col-sm-12">
                <section class="panel panel-nav-tabs panel-info">
                    <header class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#hotel_facility" data-toggle="tab">Amenities</a></li>
                            <li><a href="#hotel_about" data-toggle="tab">Description</a></li>
                            <!-- <li><a href="#hotel_reviews" data-toggle="tab">Reviews</a></li> -->
                        </ul>
                    </header>
                    <div class="panel-body tab-content">
                    <?php if(!empty($hotelDetails->facilities)){ ?>
                     <article class="tab-pane fade in active" id="hotel_facility">
                         <ul class="list-amenity cfx">
                         <?php foreach($hotelDetails->facilities as $fac) { ?>
                                                                 <li class="col-sm-4"><?php echo $fac;?></li>
                         <?php } ?>
                                                                 
                                                         </ul>                                                        
                     </article> <!-- tab-pane// -->
                     <?php } ?>
                     <?php if(!empty($hotelDetails->Description)){ ?>
                     <article class="tab-pane fade" id="hotel_about">                            
                     <?php echo strip_tags(html_entity_decode($hotelDetails->Description));?>
                     </article> <!-- tab-pane// -->
                     <?php } ?>
                        
                        <article class="tab-pane fade" id="hotel_reviews">
                            <div class="text-center"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>
                        </article>   
                    </div> <!-- panel-body tab-content// -->
                </section> <!-- panel // -->


                <section class="panel panel-info" id="hotel-features">
                    <header class="panel-heading"> Available Rooms (<?php echo $hotelDetails->HotelName; ?>) </header>
                    <div class="rm-rates">
                  <!-- <h3 class="accordions-heading">Available Rooms</h3> -->
                  <div class="room-details white-container box-shadow" id="rooms_info">
                    <?php $this->load->view('hotels/blank');?>
                  </div>
               </div>
                    

                    <div class="panel-body relative min-h-400">
                        <div id="rooms-list"></div>
                        <article class="loading-content" style="display: none;">
    <img src="https://asfartrip.com/public/assets/images/misc/loading.gif">
    <h3 class="text1">Searching rooms for you</h3>
    <h5 class="text2">One moment please ...</h5> 
    <h5 class="text2"> We are finding you the comfiest beds and the softest pillows with the best price ...</h5>
</article>                        
                    </div>   <!-- panel-body // -->
                </section>

            </main> <!-- col// -->            
            <!-- col// -->
        </div> <!-- row// -->

    </div> <!-- container // -->
</section>
<!-- ========================= SECTION CONTENT END // ========================= -->

<!-- ========================= SECTION SIMILAR ========================= -->


<div class="modal fade" id="session_expire" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" oncontextmenu="return false;" onkeydown="return false;" onmousedown="return false;">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="https://asfartrip.com/public/assets/images/misc/session2.png">
                <h4 class="h4 text-primary">Page is not active during 30 minutes</h4>
                <p class="text-muted">Please click the search button,<br> we will give you new fresh information</p>                
                <p><button type="button" id="search_again" class="btn btn-warning"><i class="fa fa-search"></i> Search again</button></p>

            </div>
        </div>
    </div> <!-- modal-body// -->
</div><!-- ========================= SECTION SIMILAR ========================= -->
<script type="text/javascript">
    var callbackId = '<?php echo base64_encode($hotel_temp_detail->api);?>';
    var sessionId = '<?php echo $hotel_temp_detail->session_id;?>';
    var hotelId = '<?php echo $hotel_temp_detail->hotel_code;?>';
    var latitude = '<?php echo $hotelDetails->lat;?>';
    var longitude = '<?php echo $hotelDetails->long;?>';
    var searchId = '<?php echo $hotel_temp_detail->search_id;?>';
    var city = '<?php echo $cityName;?>';
    var contract = '';
</script>
<script src="<?php echo base_url(); ?>assets/js/availrooms.js"></script>

<script>
    
</script>

<script type="text/javascript" defer="defer">
    

    
    function loadCounter(time) {
        if (time === 0) {
            reloadWindowPopup(0);
            return;
        }
        var minutes = Math.floor(time / 60);
        var seconds = time % 60;
        var counter = new Date();
        counter.setMinutes(counter.getMinutes() + minutes);
        counter.setSeconds(counter.getSeconds() + seconds);
        $('#booking-countdown').countdown(counter, function (event) {
            $(this).html(event.strftime('%N:%S'));
        }).on('finish.countdown', function (event) {
            reloadWindowPopup(0);
        });
    }

    $(window).on('load', function () {
        //////////////////////// Unitegallery. plugins/unitegallery
        if ($("#hotel_gallery").length > 0) {  // check if element exists
            jQuery("#hotel_gallery").unitegallery({
                theme_enable_text_panel: false,
                gallery_autoplay: true,
                slider_enable_progress_indicator: false,
                slider_enable_play_button: false,
                thumb_round_corners_radius: 5,
                strippanel_handle_align: "bottom",
                strippanel_background_color: "#fff",
                gallery_height: 600,
                theme_enable_hidepanel_button: false,
                thumb_selected_border_color: "#EC6F23",
                strippanel_padding_buttons: 7,
                slider_control_zoom: false,
                gallery_images_preload_type: "minimal"
            });
        }
    });
</script>
<script type='text/javascript' src='https://asfartrip.com/public/assets/plugins/unitegallery/js/unitegallery-custom.js'></script> 
<link rel='stylesheet' href='https://asfartrip.com/public/assets/plugins/unitegallery/css/unite-gallery.css' type='text/css' /> 
<script type='text/javascript' src='https://asfartrip.com/public/assets/plugins/unitegallery/themes/default/ug-theme-default.js'></script> 
<link rel='stylesheet' href='https://asfartrip.com/public/assets/plugins/unitegallery/themes/default/ug-theme-default.css' type='text/css' />
<script src="https://asfartrip.com/public/assets/js/libs/handlebars-v4.0.11.js" defer="defer"></script>
<script src="https://asfartrip.com/public/assets/js/handlebars-func.js" defer="defer"></script>

<script src="https://asfartrip.com/public/assets/plugins/jquery.countdown.min.js" defer></script>
<script type="text/javascript" src="https://asfartrip.com/public/assets/compiled/7e6c320910cceaa229660061136530ae.min.js?v=30f9c44bab45f8356785ed029e60fb81"></script><script src="https://asfartrip.com/public/assets/js/libs/moment.min.js" defer></script>
<link href="https://asfartrip.com/public/assets/plugins/Lightpick/css/lightpick.css" rel="stylesheet">
<script src="https://asfartrip.com/public/assets/plugins/Lightpick/lightpick.js" defer></script>



<script>
    var sec         = 1800,
    countDiv    = document.getElementById("booking-countdown"),
    secpass,
    countDown   = setInterval(function () {
        'use strict';
        
        secpass();
    }, 1000);

function secpass() {
    'use strict';
    
    var min     = Math.floor(sec / 60),
        remSec  = sec % 60;
    
    if (remSec < 10) {
        
        remSec = '0' + remSec;
    
    }
    if (min < 10) {
        
        min = '0' + min;
    
    }
    countDiv.innerHTML = min + ":" + remSec;
    
    if (sec > 0) {
        
        sec = sec - 1;
        
    } else {
        
        clearInterval(countDown);
        
        countDiv.innerHTML = '00:00';
        alert("Page is not active during 30 minutes. Please Click the button, we will give you new fresh information.");
        window.location.href = "http://localhost/travelfreebuy.com";
    }
}


</script>
<?php $this->load->view('home/home_template/footer2');?>

  

   

    

