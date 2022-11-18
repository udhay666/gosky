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
<link href="<?php echo base_url() ?>public/vendor/flexslider/flexslider.css" rel="stylesheet" type="text/css">
<!-- ========================= SECTION PAGETOP  ========================= -->
<section class="section-pagetop">
 <div class="container">
     <div class="timer-block pull-right">
         <i class="material-icons"></i>
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
             <h1 class="title"><?php echo $hotelDetails->HotelName.', '.$cityName;  ?>  </h1>
             <address style="margin-bottom: 5px"><small> <i class="fa fa-map-marker"></i>  <?php echo $hotelDetails->Address;  ?></small></address>
             <div>
                                         <img style="height: 15px; width: auto; margin-right: 15px;" title="3" src="<?php echo base_url(); ?>assets/images/stars/rating-<?php echo $hotelDetails->StarRating  ?>.png">
                                                             <!-- <img style="height: 15px; width: auto" title="3.0" alt="tripadvisor" src="https://www.tripadvisor.com/img/cdsi/img2/ratings/traveler/3.0-47560-5.svg" class="ta-image" target="_blank"> -->
                                 </div>
         </div> <!-- col // -->
         <div class="col-md-3 col-sm-3">
             <p class="price-wrap  pull-right text-center">
                 <var class="price" id="min-price">INR <?php echo number_format($hotel_temp_detail->total_cost); ?></var>
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
                    <!-- <div id="hotel_gallery" style="max-width: 900px; min-width: 150px; height: 533px; width: auto;" class="ug-gallery-wrapper ug-under-960 ug-theme-default">                                            
                    <?php // $h=0; foreach($hotelDetails->images as $img) { ?>        
                                            <div class="ug-overlay-disabled" style="display:none"></div><div class="ug-theme-panel" style="width: 800px; height: 118px; position: absolute; margin: 0px; left: 0px; top: 415px;"><div class="ug-default-button-fullscreen-single" style="position: absolute; margin: 0px; left: 748px; top: 0px;"></div><div class="ug-default-button-play-single ug-stop-mode" style="position: absolute; margin: 0px; left: 698px; top: 1px;"></div><div class="ug-strip-panel" style="background-color: rgb(255, 255, 255); width: 800px; height: 68px; position: absolute; margin: 0px; left: 0px; top: 50px;"><div class="ug-strip-arrow ug-strip-arrow-left ug-skin-default" style="height: 50px; position: absolute; margin: 0px; left: 0px; top: 10px;"><div class="ug-strip-arrow-tip" style="position: absolute; margin: 0px; left: 11px; top: 22px;"></div></div><div class="ug-strip-arrow ug-strip-arrow-right ug-skin-default" style="height: 50px; position: absolute; margin: 0px; left: 775px; top: 10px;"><div class="ug-strip-arrow-tip" style="position: absolute; margin: 0px; left: 11px; top: 22px;"></div></div><div class="ug-panel-handle-tip ug-skin-default" style="position: absolute; margin: 0px; left: 0px; top: 0px;"></div><div class="ug-thumbs-strip" style="height: 50px; width: 736px; position: absolute; margin: 0px; left: 32px; top: 10px;"><div class="ug-thumbs-strip-inner" style="height: 50px; width: 3378px; left: -975.063px;"><div class="ug-thumb-wrapper ug-thumb-generated" style="z-index: 1; width: 88px; height: 50px; border-radius: 5px; position: absolute; margin: 0px; left: 0px; top: 0px;"><div class="ug-thumb-loader ug-thumb-loader-dark" style="width: 88px; height: 50px; display: none;"></div><div class="ug-thumb-error" style="display: none; width: 88px; height: 50px;"></div>
                                            <img alt="<?php //echo $hotelDetails->HotelName ?>" src="<?php //echo $img ?>" style="opacity: 1; width: 88px; height: 59px; left: 0px; top: -4px;" class="ug-thumb-image">
                                            <div class="ug-thumb-border-overlay" style="width: 88px; height: 50px; border-radius: 5px; border-width: 0px; display: block; border-color: rgb(236, 111, 35); opacity: 1;"></div>
                                            <div class="ug-thumb-overlay" style="width: 88px; height: 50px; opacity: 1; background-color: rgba(0, 0, 0, 0.4);"></div></div>
                                            <div class="ug-thumb-wrapper ug-thumb-generated" style="z-index: <?php //echo $h+2; ?>; width: 88px; height: 50px; border-radius: 5px; position: absolute; margin: 0px; left: 94px; top: 0px;">
                                            <div class="ug-thumb-loader ug-thumb-loader-dark" style="width: 88px; height: 50px; display: none;"></div>
                                            <div class="ug-thumb-error" style="display: none; width: 88px; height: 50px;"></div>
                         <?php //$h++; } ?>                   
                    </div> -->

                    <div id="hotel_gallery" style="max-width: 900px; min-width: 150px; height: 533px; width: auto;" class="ug-gallery-wrapper ug-under-960 ug-theme-default">                                            
                                                                                    
                    <div class="ug-overlay-disabled" style="display:none"></div>
                    <div class="ug-theme-panel" style="width: 800px; height: 118px; position: absolute; margin: 0px; left: 0px; top: 415px;"><div class="ug-default-button-fullscreen-single" style="position: absolute; margin: 0px; left: 748px; top: 0px;"></div>
                    <div class="ug-default-button-play-single ug-stop-mode" style="position: absolute; margin: 0px; left: 698px; top: 1px;"></div>
                    <div class="ug-strip-panel" style="background-color: rgb(255, 255, 255); width: 800px; height: 68px; position: absolute; margin: 0px; left: 0px; top: 50px;"><div class="ug-strip-arrow ug-strip-arrow-left ug-skin-default ug-button-disabled" style="height: 50px; position: absolute; margin: 0px; left: 0px; top: 10px;"><div class="ug-strip-arrow-tip" style="position: absolute; margin: 0px; left: 11px; top: 22px;"></div></div>
                    <div class="ug-strip-arrow ug-strip-arrow-right ug-skin-default ug-button-disabled" style="height: 50px; position: absolute; margin: 0px; left: 775px; top: 10px;"><div class="ug-strip-arrow-tip" style="position: absolute; margin: 0px; left: 11px; top: 22px;"></div></div><div class="ug-panel-handle-tip ug-skin-default" style="position: absolute; margin: 0px; left: 0px; top: 0px;"></div><div class="ug-thumbs-strip" style="height: 50px; width: 736px; position: absolute; margin: 0px; left: 32px; top: 10px;"><div class="ug-thumbs-strip-inner" style="height: 50px; width: 652px; position: absolute; margin: 0px; left: 0px; top: 0px;"><div class="ug-thumb-wrapper ug-thumb-generated" style="z-index: 1; width: 88px; height: 50px; border-radius: 5px; position: absolute; margin: 0px; left: 0px; top: 0px;"><div class="ug-thumb-loader ug-thumb-loader-dark" style="width: 88px; height: 50px; display: none;"></div><div class="ug-thumb-error" style="display: none; width: 88px; height: 50px;"></div><img alt="" src="http://www.tboholidays.com//imageresource.aspx?img=FbrGPTrju5e5v0qrAGTD8pPBsj8/wYA59yZzciIrL6JD9kapBHAHEXROAplstEKau+iYWKvW8iLcNUn2gqQV2semAv8sU09+Omf2CGAg09bZOSiQjyG7JA==" style="opacity: 1; width: 89px; height: 50px; left: 0px; top: 0px;" class="ug-thumb-image"><div class="ug-thumb-border-overlay" style="width: 88px; height: 50px; border-radius: 5px; border-width: 0px; display: block; border-color: rgb(236, 111, 35); opacity: 1;"></div><div class="ug-thumb-overlay" style="width: 88px; height: 50px; opacity: 1; background-color: rgba(0, 0, 0, 0.4);"></div></div><div class="ug-thumb-wrapper ug-thumb-generated" style="z-index: 2; width: 88px; height: 50px; border-radius: 5px; position: absolute; margin: 0px; left: 94px; top: 0px;"><div class="ug-thumb-loader ug-thumb-loader-dark" style="width: 88px; height: 50px; display: none;"></div><div class="ug-thumb-error" style="display: none; width: 88px; height: 50px;"></div><img alt="" src="http://www.tboholidays.com//imageresource.aspx?img=FbrGPTrju5e5v0qrAGTD8pPBsj8/wYA59yZzciIrL6JD9kapBHAHEXROAplstEKau+iYWKvW8iLcNUn2gqQV2qyWgfjZLyVRRMLNDFJaf5BtnrLsJWVz1A==" style="opacity: 1; width: 89px; height: 50px; left: 0px; top: 0px;" class="ug-thumb-image"><div class="ug-thumb-border-overlay" style="width: 88px; height: 50px; border-radius: 5px; border-width: 0px; display: block; border-color: rgb(236, 111, 35); opacity: 1;"></div><div class="ug-thumb-overlay" style="width: 88px; height: 50px; opacity: 1; background-color: rgba(0, 0, 0, 0.4);"></div></div><div class="ug-thumb-wrapper ug-thumb-generated" style="z-index: 3; width: 88px; height: 50px; border-radius: 5px; position: absolute; margin: 0px; left: 188px; top: 0px;"><div class="ug-thumb-loader ug-thumb-loader-dark" style="width: 88px; height: 50px; display: none;"></div><div class="ug-thumb-error" style="display: none; width: 88px; height: 50px;"></div><img alt="" src="http://www.tboholidays.com//imageresource.aspx?img=FbrGPTrju5e5v0qrAGTD8pPBsj8/wYA59yZzciIrL6JD9kapBHAHEXROAplstEKau+iYWKvW8iLcNUn2gqQV2iuDWN4sbf9uaoXFScyNKr29qBkP835ZEw==" style="opacity: 1; width: 88px; height: 58px; left: 0px; top: -4px;" class="ug-thumb-image"><div class="ug-thumb-border-overlay" style="width: 88px; height: 50px; border-radius: 5px; border-width: 0px; display: block; border-color: rgb(236, 111, 35); opacity: 1;"></div><div class="ug-thumb-overlay" style="width: 88px; height: 50px; opacity: 1; background-color: rgba(0, 0, 0, 0.4);"></div></div><div class="ug-thumb-wrapper ug-thumb-generated ug-thumb-selected" style="z-index: 4; width: 88px; height: 50px; border-radius: 5px; position: absolute; margin: 0px; left: 282px; top: 0px;"><div class="ug-thumb-loader ug-thumb-loader-dark" style="width: 88px; height: 50px; display: none;"></div><div class="ug-thumb-error" style="display: none; width: 88px; height: 50px;"></div><img alt="" src="http://www.tboholidays.com//imageresource.aspx?img=FbrGPTrju5e5v0qrAGTD8pPBsj8/wYA59yZzciIrL6JD9kapBHAHEXROAplstEKau+iYWKvW8iLcNUn2gqQV2nG0s9rDuMEUg0PNF6ZIbfONUZ3qyUTNwA==" style="opacity: 1; width: 88px; height: 133px; left: 0px; top: -41px;" class="ug-thumb-image"><div class="ug-thumb-border-overlay" style="width: 88px; height: 50px; border-radius: 5px; border-width: 1px; display: block; border-color: rgb(236, 111, 35); opacity: 1;"></div><div class="ug-thumb-overlay" style="width: 88px; height: 50px; opacity: 0; background-color: rgba(0, 0, 0, 0.4);"></div></div><div class="ug-thumb-wrapper ug-thumb-generated" style="z-index: 5; width: 88px; height: 50px; border-radius: 5px; position: absolute; margin: 0px; left: 376px; top: 0px;"><div class="ug-thumb-loader ug-thumb-loader-dark" style="width: 88px; height: 50px; display: none;"></div><div class="ug-thumb-error" style="display: none; width: 88px; height: 50px;"></div><img alt="" src="http://www.tboholidays.com//imageresource.aspx?img=FbrGPTrju5e5v0qrAGTD8pPBsj8/wYA59yZzciIrL6JD9kapBHAHEXROAplstEKau+iYWKvW8iLcNUn2gqQV2g6faiPNnwl4ufCbWCJoQvLTZggA8tHWPA==" style="opacity: 1; width: 89px; height: 50px; left: 0px; top: 0px;" class="ug-thumb-image"><div class="ug-thumb-border-overlay" style="width: 88px; height: 50px; border-radius: 5px; border-width: 0px; display: block; border-color: rgb(236, 111, 35); opacity: 1;"></div><div class="ug-thumb-overlay" style="width: 88px; height: 50px; opacity: 1; background-color: rgba(0, 0, 0, 0.4);"></div></div><div class="ug-thumb-wrapper ug-thumb-generated" style="z-index: 6; width: 88px; height: 50px; border-radius: 5px; position: absolute; margin: 0px; left: 470px; top: 0px;"><div class="ug-thumb-loader ug-thumb-loader-dark" style="width: 88px; height: 50px; display: none;"></div><div class="ug-thumb-error" style="display: none; width: 88px; height: 50px;"></div><img alt="" src="http://www.tboholidays.com//imageresource.aspx?img=FbrGPTrju5e5v0qrAGTD8pPBsj8/wYA59yZzciIrL6JD9kapBHAHEXROAplstEKau+iYWKvW8iLcNUn2gqQV2radQB70mJD86wG7BCRGcjDERvdX/OJyaQ==" style="opacity: 1; width: 88px; height: 66px; left: 0px; top: -8px;" class="ug-thumb-image"><div class="ug-thumb-border-overlay" style="width: 88px; height: 50px; border-radius: 5px; border-width: 0px; display: block; border-color: rgb(236, 111, 35); opacity: 1;"></div><div class="ug-thumb-overlay" style="width: 88px; height: 50px; opacity: 1; background-color: rgba(0, 0, 0, 0.4);"></div></div><div class="ug-thumb-wrapper ug-thumb-generated" style="z-index: 7; width: 88px; height: 50px; border-radius: 5px; position: absolute; margin: 0px; left: 564px; top: 0px;"><div class="ug-thumb-loader ug-thumb-loader-dark" style="width: 88px; height: 50px; display: none;"></div><div class="ug-thumb-error" style="display: none; width: 88px; height: 50px;"></div><img alt="" src="http://www.tboholidays.com//imageresource.aspx?img=FbrGPTrju5e5v0qrAGTD8pPBsj8/wYA59yZzciIrL6JD9kapBHAHEXROAplstEKau+iYWKvW8iLcNUn2gqQV2u+3DsqpFf82/1gF+ARoq+oy/rDxY5/WDQ==" style="opacity: 1; width: 88px; height: 118px; left: 0px; top: -34px;" class="ug-thumb-image"><div class="ug-thumb-border-overlay" style="width: 88px; height: 50px; border-radius: 5px; border-width: 0px; display: block; border-color: rgb(236, 111, 35); opacity: 1;"></div><div class="ug-thumb-overlay" style="width: 88px; height: 50px; opacity: 1; background-color: rgba(0, 0, 0, 0.4);"></div></div></div></div></div></div><div class="ug-slider-wrapper" style="width: 800px; height: 465px; position: absolute; margin: 0px; left: 0px; top: 0px;"><div class="ug-slider-inner" style="height: 465px; top: 0px; left: -800px; width: 2400px;"><div class="ug-slide-wrapper ug-slide1" style="height: 465px; width: 800px; display: block; z-index: 2; position: absolute; margin: 0px; left: 1600px; top: 0px; opacity: 1;"><div class="ug-item-wrapper" style="width: 800px; height: 465px; top: 0px; left: 0px;"><img style="position: absolute; height: 465px; top: 0px; left: -13px; opacity: 1; width: 826px;" src="http://www.tboholidays.com//imageresource.aspx?img=FbrGPTrju5e5v0qrAGTD8pPBsj8/wYA59yZzciIrL6JD9kapBHAHEXROAplstEKau+iYWKvW8iLcNUn2gqQV2g6faiPNnwl4ufCbWCJoQvLTZggA8tHWPA==" width="826" height="465"></div><div class="ug-slider-preloader ug-loader1" style="position: absolute; margin: 0px; left: 385px; top: 218px; display: none; height: 30px; padding: 0px; width: 30px; opacity: 1;"></div><div class="ug-button-videoplay ug-type-square" style="display: none; position: absolute; margin: 0px; left: 357px; top: 200px;"></div></div><div class="ug-slide-wrapper ug-slide2" style="height: 465px; width: 800px; z-index: 2; position: absolute; margin: 0px; left: 0px; top: 0px; opacity: 1;"><div class="ug-item-wrapper" style="width: 800px; height: 465px; top: 0px; left: 0px;"><img style="position: absolute; height: 530px; top: -33px; left: 0px; opacity: 1; width: 800px; margin: 0px;" src="http://www.tboholidays.com//imageresource.aspx?img=FbrGPTrju5e5v0qrAGTD8pPBsj8/wYA59yZzciIrL6JD9kapBHAHEXROAplstEKau+iYWKvW8iLcNUn2gqQV2iuDWN4sbf9uaoXFScyNKr29qBkP835ZEw=="></div><div class="ug-slider-preloader ug-loader1" style="position: absolute; margin: 0px; left: 385px; top: 218px; display: none; height: 30px; padding: 0px; width: 30px; opacity: 1;"></div><div class="ug-button-videoplay ug-type-square" style="display: none; position: absolute; margin: 0px; left: 357px; top: 199px;"></div></div><div class="ug-slide-wrapper ug-slide3" style="height: 465px; width: 800px; display: block; opacity: 1; position: absolute; margin: 0px; left: 800px; top: 0px; z-index: 3;"><div class="ug-item-wrapper" style="width: 800px; height: 465px; top: 0px; left: 0px;"><img style="position: absolute; height: 1206px; top: -371px; left: 0px; opacity: 1; width: 800px; margin: 0px;" src="http://www.tboholidays.com//imageresource.aspx?img=FbrGPTrju5e5v0qrAGTD8pPBsj8/wYA59yZzciIrL6JD9kapBHAHEXROAplstEKau+iYWKvW8iLcNUn2gqQV2nG0s9rDuMEUg0PNF6ZIbfONUZ3qyUTNwA=="></div><div class="ug-slider-preloader ug-loader1" style="position: absolute; margin: 0px; left: 385px; top: 218px; display: none; height: 30px; padding: 0px; width: 30px; opacity: 1;"></div><div class="ug-button-videoplay ug-type-square" style="display: none; position: absolute; margin: 0px; left: 357px; top: 199px;"></div></div><div class="ug-videoplayer" style="display: none; width: 800px; height: 465px; position: absolute; margin: 0px; left: 0px; top: 0px;"><div class="ug-videoplayer-wrapper ug-videoplayer-youtube" style="display:none"><div id="hotel_gallery_youtube_inner"></div></div><div id="hotel_gallery_videoplayer_vimeo" class="ug-videoplayer-wrapper ug-videoplayer-vimeo" style="display:none"></div><div id="hotel_gallery_videoplayer_html5" class="ug-videoplayer-wrapper ug-videoplayer-html5"></div><div id="hotel_gallery_videoplayer_soundcloud" class="ug-videoplayer-wrapper ug-videoplayer-soundcloud"></div><div id="hotel_gallery_videoplayer_wistia" class="ug-videoplayer-wrapper ug-videoplayer-wistia"></div><div class="ug-videoplayer-button-close" style="position: absolute; margin: 0px; left: 736px; top: 0px;"></div></div></div><div class="ug-slider-control ug-arrow-left ug-skin-default" style="position: absolute; margin: 0px; left: 20px; top: 218px;"></div><div class="ug-slider-control ug-arrow-right ug-skin-default" style="position: absolute; margin: 0px; left: 765px; top: 218px;"></div><div class="ug-slider-control ug-zoompanel ug-skin-default" style="position: absolute; margin: 0px; left: 12px; top: 12px;"><div class="ug-zoompanel-button ug-zoompanel-plus"></div><div class="ug-zoompanel-button ug-zoompanel-minus"></div><div class="ug-zoompanel-button ug-zoompanel-return"></div></div></div></div>
                </main>
             <aside class="col-sm-4">
                 <link rel="stylesheet" href="https://api.tiles.mapbox.com/mapbox.js/v2.1.8/mapbox.css">
<style>
 .map-street-container{height: 100%}    
 @media only screen and (max-width: 992px) {
     .map-street-container{height: 50%}    
 }
</style>
<script src="https://api.tiles.mapbox.com/mapbox.js/v2.1.8/mapbox.js"></script>
<address class="wrap-map-sm">
 <div id="right-map-small" class="hidden-sm hidden-xs leaflet-container leaflet-fade-anim" style="width: 100%; height: 220px; display: block; position: relative;" data-toggle="modal" data-target="#street_modal" tabindex="0"><div class="leaflet-map-pane" style="transform: translate3d(0px, 0px, 0px);"><div class="leaflet-tile-pane"><div class="leaflet-layer"><div class="leaflet-tile-container"></div><div class="leaflet-tile-container"></div></div><div class="leaflet-layer"><div class="leaflet-tile-container"></div><div class="leaflet-tile-container"></div></div></div><div class="leaflet-objects-pane"><div class="leaflet-shadow-pane"></div><div class="leaflet-overlay-pane"></div><div class="leaflet-marker-pane"><img src="https://asfartrip.com/public/assets/images/icons/markers/hotel.png" class="leaflet-marker-icon leaflet-zoom-animated leaflet-clickable" tabindex="0" style="transform: translate3d(195px, 110px, 0px); z-index: 110;"></div><div class="leaflet-popup-pane"></div></div></div><div class="leaflet-control-container"><div class="leaflet-top leaflet-left"><div class="leaflet-control-zoom leaflet-bar leaflet-control"><a class="leaflet-control-zoom-in" href="#" title="Zoom in">+</a><a class="leaflet-control-zoom-out" href="#" title="Zoom out">-</a></div></div><div class="leaflet-top leaflet-right"><div class="leaflet-control-grid map-tooltip leaflet-control" style="display: none;"><a class="close" href="#" title="close">close</a><div class="map-tooltip-content"></div></div></div><div class="leaflet-bottom leaflet-left"><div class="mapbox-logo leaflet-control"></div></div><div class="leaflet-bottom leaflet-right"><div class="map-legends wax-legends leaflet-control" style="display: none;"></div><div class="leaflet-control-attribution leaflet-control leaflet-compact-attribution"></div></div></div></div>
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
             <button type="button" class="close" data-dismiss="modal">×</button>
             <h4 class="modal-title">Nearby Attractions</h4>
         </div>
         <main class="modal-map-body" style="height: 600px;">
             <!-- ----------- map modal inner ----------- --> 
             <!-- Hotel Popup -->
             <div>
                 <div class="card-wrap">
                     <article class="card item-hotel" style="z-index: 9999;">        
                         <div class="info-wrap">
                             <div class="title-wrap" style="max-height: 90px; height: auto">
                                                                         <small class="type"><img class="img-rating" src="<?php echo base_url(); ?>assets/images/stars/rating-<?php echo $hotelDetails->StarRating  ?>.png"> </small>
                                                                     <h4 class="title"><?php echo $hotelDetails->HotelName;  ?> </h4>                
                             </div>            
                         </div>
                         <div class="bottom-wrap cfx">
                             <div class="pull-right text-center">
                                 <button type="button" class="btn btn-warning pull-right" onclick="$('#book-now-scroll').click();" data-dismiss="modal" aria-label="Close">Select Room</button>                  
                             </div>                                
                         </div>
                     </article>
                 </div>
             </div>  
             <!-- End: Hotel Popup -->
             <map id="map" style="background-color: rgb(204, 204, 204); height: 600px; display: block; position: relative;" class="leaflet-container leaflet-fade-anim" tabindex="0"><div class="leaflet-map-pane" style="transform: translate3d(0px, 0px, 0px);"><div class="leaflet-tile-pane"><div class="leaflet-layer"><div class="leaflet-tile-container"></div><div class="leaflet-tile-container"></div></div><div class="leaflet-layer"><div class="leaflet-tile-container"></div><div class="leaflet-tile-container leaflet-zoom-animated"><img class="leaflet-tile" style="height: 256px; width: 256px; transform: translate3d(-48px, -61px, 0px);" src="https://b.tiles.mapbox.com/v4/examples.map-h67hf2ic/14/10708/7003.png?access_token=pk.eyJ1IjoiYXNmYXJ0cmlwIiwiYSI6ImNpdjIydzBidzAwMDQydHBsY29kdzZkMTgifQ.FAz6x-XPzbK8z3byN1WqAg"></div></div></div><div class="leaflet-objects-pane"><div class="leaflet-shadow-pane"></div><div class="leaflet-overlay-pane"></div><div class="leaflet-marker-pane"></div><div class="leaflet-popup-pane"></div></div></div><div class="leaflet-control-container"><div class="leaflet-top leaflet-left"><div class="leaflet-control-zoom leaflet-bar leaflet-control"><a class="leaflet-control-zoom-in" href="#" title="Zoom in">+</a><a class="leaflet-control-zoom-out" href="#" title="Zoom out">-</a></div></div><div class="leaflet-top leaflet-right"><div class="leaflet-control-grid map-tooltip leaflet-control" style="display: none;"><a class="close" href="#" title="close">close</a><div class="map-tooltip-content"></div></div></div><div class="leaflet-bottom leaflet-left"><div class="mapbox-logo leaflet-control"></div></div><div class="leaflet-bottom leaflet-right"><div class="map-legends wax-legends leaflet-control" style="display: none;"></div><div class="leaflet-control-attribution leaflet-control leaflet-compact-attribution"><a href="https://www.mapbox.com/about/maps/" target="_blank" title="Mapbox">© Mapbox</a> <a href="https://www.openstreetmap.org/about/" target="_blank" title="OpenStreetMap">© OpenStreetMap</a> <a class="mapbox-improve-map" href="https://www.mapbox.com/contribute/#/55.287/25.260/14" target="_blank" title="Improve this map">Improve this map</a></div></div></div></map>                
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
                                                 <div class="checkbox"> <label class="dist-bus"><input class="filter" type="checkbox" checked="" value="0"> <ins></ins> <i class="map-icon"></i> <span class="hidden-xs">Bus Stop</span></label></div>
                                                 <div class="checkbox"> <label class="dist-mosque"><input class="filter" type="checkbox" checked="" value="1"> <ins></ins> <i class="map-icon"></i> <span class="hidden-xs">Mosque</span></label></div>
                                                 <div class="checkbox"> <label class="dist-halal"><input class="filter" type="checkbox" checked="" value="2"> <ins></ins> <i class="map-icon"></i> <span class="hidden-xs">Halal Food</span></label></div>
                                                 <div class="checkbox"> <label class="dist-restaurant"><input class="filter" type="checkbox" checked="" value="3"> <ins></ins> <i class="map-icon"></i> <span class="hidden-xs">Other Food</span></label></div>
                                                 <div class="checkbox"> <label class="dist-metro"><input class="filter" type="checkbox" checked="" value="4"> <ins></ins> <i class="map-icon"></i> <span class="hidden-xs">Train Station</span></label></div>
                                                 <div class="checkbox"> <label class="dist-mall"><input class="filter" type="checkbox" checked="" value="5"> <ins></ins> <i class="map-icon"></i> <span class="hidden-xs">Shopping Mall</span></label></div>
                                                 <div class="checkbox"> <label class="dist-medical"><input class="filter" type="checkbox" checked="" value="6"> <ins></ins> <i class="map-icon"></i> <span class="hidden-xs">Medical Center</span></label></div>
                                                                                           
             </div></aside>
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
             <button type="button" class="close" data-dismiss="modal">×</button>
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

 <script type="text/javascript" defer="defer">
     var lat = <?php  echo $hotelDetails->lat;?>;
     var long = <?php  echo $hotelDetails->long;?>;
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
             icon: 'https://asfartrip.com/public/assets/images/icons/markers/hotel.png',
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
<script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOEMXVG0qMZ6nLR0kUTMoVwBP54BftWu4&amp;language=en" type="text/javascript"></script>
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
                     <article class="tab-pane fade" id="hotel_reviews">    <style>
     .review-box {padding: 10px; direction: ltr;}
     .review-box .heading {font-size: 14px;color: #01579B;text-transform: uppercase;font-weight: bold;margin-bottom: 10px;border-bottom: 1px solid #ccc;padding-bottom: 5px;}
     /*Rating Warp*/
     .rating-wrap{padding: 10px 5px; line-height: 15px;}
     .rating-wrap .title{float: left;display: inline-block;width: 90px;color: #006699;}
     .rating-wrap .progress{float: left; width: 50%; margin: 0;height: auto;border-radius: 10px;background-color: #f5f5f5;height: 15px;}    
     .rating-wrap num{font-size: 12px; margin-left: 15px;}
     /*Review wrap*/
     .review-wrap{border-bottom: 1px dotted #ccc;padding: 10px 5px;}
     .review-wrap:last-child {border: none;}
     .review-wrap .title{display: inline-block;;color: #006699;}
     .review-wrap num{font-size: 12px;float: right;}
     /* Cirlce Widget Review*/
     .ta-circle-widget{
         height: 175px;
         width: 175px;
         border-radius: 50%;
         border: 2px solid #5cb85c;
         overflow: hidden;
         text-align: center;
         padding: 3%;
         margin: 5% auto;
     }
     .ta-circle-widget span{
         display: block;
     }
     .ta-circle-widget .total-rating{
         font-size: 3em;
         color: #5cb85c;
         font-weight: bold;
     }
 </style>

 <div class="row">
     <div class="col-md-12">
             
     </div>
 </div>
 <hr>
 <div class="text-right">
     <span><a target="_blank" href="https://www.tripadvisor.com/UserReview-g295424-d306743-Palm_Beach_Hotel-Dubai_Emirate_of_Dubai.html?m=47560" rel="nofollow">Write your own review</a> |</span>
     <span><a target="_blank" href="https://www.tripadvisor.com/Hotel_Review-g295424-d306743-Reviews-Palm_Beach_Hotel-Dubai_Emirate_of_Dubai.html?m=47560" rel="nofollow">See all 171 reviews »</a></span>
 </div>
</article>   
                 </div> <!-- panel-body tab-content// -->
             </section> <!-- panel // -->


             <section class="panel panel-info" id="hotel-features">
                 <header class="panel-heading"> Available Rooms (<?php echo $hotelDetails->HotelName; ?>) </header>
                

                 <div class="panel-body relative min-h-400">
                     <div class="room-details white-container box-shadow" id="rooms_info">   
                     <?php //$this->load->view('hotels/blank');?>                     
     

 </div>
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

 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/unitegallery/js/unitegallery-custom.js"></script> 
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/unitegallery/css/unite-gallery.css" type="text/css"> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/unitegallery/themes/default/ug-theme-default.js"></script> 
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/unitegallery/themes/default/ug-theme-default.css" type="text/css">
<script src="https://asfartrip.com/public/assets/js/libs/handlebars-v4.0.11.js" defer="defer"></script>
<script src="https://asfartrip.com/public/assets/js/handlebars-func.js" defer="defer"></script>

<script src="https://asfartrip.com/public/assets/plugins/jquery.countdown.min.js" defer=""></script>
<script type="text/javascript" src="https://asfartrip.com/public/assets/compiled/7e6c320910cceaa229660061136530ae.min.js?v=30f9c44bab45f8356785ed029e60fb81"></script><script src="https://asfartrip.com/public/assets/js/libs/moment.min.js" defer=""></script>
<link href="https://asfartrip.com/public/assets/plugins/Lightpick/css/lightpick.css" rel="stylesheet">
<script src="https://asfartrip.com/public/assets/plugins/Lightpick/lightpick.js" defer=""></script>

<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/flexslider/jquery.flexslider-min.js"></script>
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
<script>
$(document).ready(function()
 {	
	$.ajax({
        type: 'POST',
        url: siteUrl+'hotels/rooms_availability',
        data: 'callBackId='+callbackId+'&sessionId='+sessionId+'&hotelCode='+hotelId+'&searchId='+searchId+'&contract='+contract,
        async: true,
        dataType: 'json',
        beforeSend:function()
        {				 

        },
        success: function(data)
        {								
            $("#rooms_info").html(data.rooms_result);
        },		  
        error:function(request, status, error)
        {				
            $("#rooms_info").html('<div class="row" style="border: 1px solid #A1A1A1;border-radius: 5px;margin: 5px 0;"><div class="error" style="text-align:center;">Sorry, No Rooms are available. Search for another Hotel.</div></div>');			
        }
	});
	$.ajax({
        type: 'POST',
        url: siteUrl+'hotels/nearby_hotels',
        data: 'callBackId='+callbackId+'&sessionId='+sessionId+'&hotelCode='+hotelId+'&latitude='+latitude+'&longitude='+longitude+'&city='+city,
        async: true,
        dataType: 'json',
        beforeSend:function()
        {				 
            $(".hotelloader").show();
        },
        success: function(data)
        {
            $(".hotelloader").hide();
            if(data.nearby_hotels != '')	
            {							
                $("#nearby_hotels").html(data.nearby_hotels);					
            }
            if(data.related_hotels != '')
            {
                $("#related_hotels").html(data.related_hotels);
            }		
        },		  
        error:function(request, status, error)
        {				
            $(".hotelloader").hide();		
        }
	});
});
$(document).on('click','.htl-ind-rm-dtls',function()
{
	$(this).parents('.htl-rm-detail').find('#htl-ind-details').slideToggle(600);
	$(this).find('i').toggleClass('fa-caret-up');
});
</script>
<!-- <script type="text/javascript" src="<?php echo base_url();?>public/js/hotel/rooms_avail.js"></script> -->

<!-- var sec         = 1800, -->
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
<?php $this->load->view('home/home_template/footer');?>