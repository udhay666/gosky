<?php $this->load->view('home/header');?>
<!-- Popup Loader Css-->
<style type="text/css">
#rapid_fire_draft_loading {
background-color:#fff;
border-radius: 6px;
box-shadow: 0 3px 5px 0 #202020;
color: #09ABB1;
font-size: 15px;
font-weight: bold;
left: 36%;
padding: 15px;
position: fixed;
top: 16%;
z-index: 400;
margin-top: 75px;
width: 50%;
position:fixed;
height:288px;
text-align: center;
}
#rapid_fire_draft_loading img {
margin-left: 8px;
position:fixed;
text-align: center;
}
#rapid_fire_draft_ajax_loading {
background-color:#fff;
border-radius: 6px;
box-shadow: 0 3px 5px 0 #202020;
color: #09ABB1;
font-size: 15px;
font-weight: bold;
left: 36%;
padding: 15px;
position: fixed;
top: 16%;
z-index: 400;
margin-top: 75px;
width: 50%;
position:fixed;
height:288px;
text-align: center;
}
#rapid_fire_draft_ajax_loading img {
margin-left: 8px;
position:fixed;
text-align: center;
}
/*For Pagination Styles*/
ul.tsc_pagination { margin:4px 0; padding:0px; /* height:100%; */ overflow:hidden; font:12px 'Tahoma'; list-style-type:none; }
ul.tsc_pagination li { float:left; margin:0px; padding:0px; margin-left:5px; }
ul.tsc_pagination li a { color:black; display:block; text-decoration:none; padding:7px 10px 7px 10px; }
ul.tsc_paginationA li a { color:#FFFFFF; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; }
ul.tsc_paginationA01 li a { color:#474747; border:solid 1px #B6B6B6; padding:6px 9px 6px 9px; background:#E6E6E6; background:-moz-linear-gradient(top, #FFFFFF 1px, #F3F3F3 1px, #E6E6E6); background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #FFFFFF), color-stop(0.02, #F3F3F3), color-stop(1, #E6E6E6)); }
ul.tsc_paginationA01 li:hover a,
ul.tsc_paginationA01 li.current a { background:#FFFFFF; }

.StarRating{display: none;}
.star-label,.per_room_div,.total_div{cursor: pointer;}
.star-label.active-star{background: #dc371b;color: #fff;}
.star-label.active-star span i.fa.fa-star{color: #fff;}


.amenity,.Areas{
    cursor: pointer;
    -webkit-appearance: none;
    appearance: none;
    background: #e9e9e9;
    /* border-radius: 1px; */
    /* box-sizing: border-box; */
    outline: none !important;
    position: relative;
    box-sizing: content-box;
    width: 20px;
    height: 20px;
    border-width: 0;
    transition: all .3s linear;
        top: 4px;
  }
  .amenity:checked:after, .Areas:checked:after{
    content: "\2713";
    font-size: 18px;
    width: 20px;
    height: 20px;
    position: absolute;
    font-weight: bold;
    left: 62%;
    top: 42%;
    outline: none !important;
    -webkit-transform: translate(-50%,-50%);
    -moz-transform: translate(-50%,-50%);
    -ms-transform: translate(-50%,-50%);
    transform: translate(-50%,-50%);
  }
  .amenity:focus, .Areas:focus{
    outline: 0 none;
    box-shadow: none;
  }
  #rapid_fire_draft_ajax_loading2{
    left: 0;
    right: 0;
    padding: 15px;
    position: fixed;
    top: 0;
    padding-top: 100px;
    z-index: 400;
    height: 100%;
    background-color: rgba(230, 230, 230, 0.4);
}
</style>
<?php
  $session_data = $this->session->userdata('hotel_search_data');
  $city_arr = explode(',',$session_data['cityName']);
  // $city_arr2 = explode('||',$session_data['cityName']);
  $cityName = $city_arr[0];
  $cityCode=$session_data['cityCode'];
  // $cityName2 = ucwords($city_arr2[0]);
  $cityName2 = ucwords($session_data['cityName']);
  $adults_count = $session_data['adults_count'];
  $childs_count = $session_data['childs_count'];
  $rooms = $session_data['rooms'];
  $nights = $session_data['nights'];
  $checkIn = date('l j F, Y',strtotime(str_replace('/','-',$session_data['checkIn'])));
  $checkOut = date('l j F, Y',strtotime(str_replace('/','-',$session_data['checkOut'])));
  $journeyDate = date('Y-m-d',strtotime(str_replace('/','-',$session_data['checkIn'])));
//echo '<pre/>';print_r($session_data['childs_ages']);exit;
  ?>
  <?php
  /*
  Add day/week/month to a particular date
  @param1 yyyy-mm-dd
  @param1 integer
  by Saahil K on 2013-12-18
  */
  function addAndRemoveDate($date,$day,$action)//add days
  {
  $sum = strtotime(date("Y-m-d", strtotime("$date")) . " $action$day days");
  $dateTo=date('Y-m-d',$sum);
  return $dateTo;
  }
  ?>

<style type="text/css">
/*.hotel-img ol.bjqs-markers.h-centered {
    bottom: 22px;
}*/
</style>
<!-- Modify Search panel -->
<div class="bottomSection flightsContainer23 marginTop5aa">
  <div class="container">
    <div class="hotel-details">
      <div class="row">
        <div class="col-xs-12 search-filter">
          <ul class="search-details">
            <li class="trim-left" style="margin-left: 15px;"><label class="control-label" style="margin-top: 10px;color: rgb(220,55,27)"><?php echo $cityName2;?></label></li>
            <li class="trim-left"><label class="control-label">
              <span>Check-in: &nbsp;&nbsp;</span><?php echo $checkIn;?><br><span>Check-out:</span> <?php echo $checkOut;?>
            </label></li>
            <li class="trim-left"><label class="control-label">
              <span>Night(s): &nbsp;</span> <?php echo $nights;?><br><span>Room(s):</span> <?php echo $rooms;?>
            </label></li>
            <li class="trim-left"><label class="control-label" style="margin-top: 10px;">
              Passengers: <?php echo $adults_count;?> Adult(s), <?php echo $childs_count;?> Child(ren)<!-- , 1 Infant(s) -->
            </label></li>
            <li class="trim-left" style="float: right;margin-right: 10px;"><label class="control-label" style="margin-top: 8px;">
              <span class="btn btn-primary modify-search-btn" id="modify-search-btn"><i class="fa fa-search"></i> Modify search</span>
            </label></li>
          </ul>
        </div>
      </div>
      <?php $this->load->view('hotel_modify_search',$session_data);?>
    </div>
  </div>
</div>


<div class="flightCntr marginTop5aa">
  <div class="container">
    <div class="row paddingleft15">
      <!-- Filter Panel -->
      <div class="visible-xs filter-button"><i class="fa fa-filter"></i></div>
      <div class="col-md-3 white-bg2 searchFiltersSection" style="padding: 10px;">
        <div class="leftSearchFilter">
          <div class="" style="text-align: right;font-size: 12px;">RESET ALL</div>
          <ul class="left-search">
            <li> 
              <div class="row filter_toggle">
                <div class="col-md-12">
                  <img src="<?php echo base_url() ?>public/images/filter/price.png" style="float: left;margin-top: 1px;">
                  <span style="display:block;color: rgb(220,55,27); float: left;">Price</span>
                  <span class="toogle_span" style="cursor:pointer;display:block;float: right;">Hide</span>
                </div>
              </div>
               <input type="hidden" id="totalnohotels"  />
              <div class="left-search-cntr2">
                <div id="" style="font-weight: normal;margin-bottom: 8px;margin-top: 8px;">
                  <span id="priceSliderOutputmin" class="priceSliderOutputMin"></span>
                  <span id="priceSliderOutputmax" class="priceSliderOutputMax" style="float: right;"></span>
                </div>
                <div style="padding-left: 8px;padding-right: 10px;margin: 0px;">
                  <div id="priceSlider"  style="z-index:0;"></div>
                  <input type="hidden" name="minPrice" id="minPrice" class="autoSubmit"  />
                  <input type="hidden" name="maxPrice" id="maxPrice" class="autoSubmit"  />
                </div>
                <br>
                <div class="input-group">
                  <input type="text" class="form-control" name="" id="hotelName" placeholder="Search by Hotel Name" style="width: 100%;">
                  <span class="input-group-btn">
                      <button class="btn btn-default hotelNameSearch" type="button" style="padding: 6px 10px 7px 10px;"><span class="glyphicon glyphicon-search"></span></button>
                  </span>
                </div>
              </div>
            </li>
            <li>
              <div class="row filter_toggle">
                <div class="col-md-12">
                  <img src="<?php echo base_url() ?>public/images/filter/star-rating.png" style="float: left;margin-top: 1px;">
                  <!-- <i class="fa fa-star" style="float: left;top: 2px;position: relative;"></i> -->
                  <span style="display:block;color: rgb(220,55,27); float: left;margin-left: 2px;">Star Ratings</span>
                  <span class="toogle_span" style="cursor:pointer;display:block;float: right;">Hide</span>
                </div>
              </div>
              <div class="left-search-cntr2 airlines star-ratings" style="">
                <label class="star-label" style="">
                  <input type="checkbox" name="star" class="StarRating" value="1" />
                  <span class="">1</span>
                  <span class=""><i class="fa fa-star"></i></span>
                  <!-- <hr>
                  <span class="">84</span> -->
                </label>
                <label class="star-label" style="">
                  <input type="checkbox" name="star" class="StarRating" value="2" />
                  <span class="">2</span>
                  <span class=""><i class="fa fa-star"></i></span>
                  <!-- <hr>
                  <span class="">84</span> -->
                </label>
                <label class="star-label" style="">
                  <input type="checkbox" name="star" class="StarRating" value="3" />
                  <span class="">3</span>
                  <span class=""><i class="fa fa-star"></i></span>
                  <!-- <hr>
                  <span class="">84</span> -->
                </label>
                <label class="star-label" style="">
                  <input type="checkbox" name="star" class="StarRating" value="4" />
                  <span class="">4</span>
                  <span class=""><i class="fa fa-star"></i></span>
                  <!-- <hr>
                  <span class="">84</span> -->
                </label>
                <label class="star-label" style="border: none;">
                  <input type="checkbox" name="star" class="StarRating" value="5" />
                  <span class="">5</span>
                  <span class=""><i class="fa fa-star"></i></span>
                  <!-- <hr>
                  <span class="">84</span> -->
                </label>
              </div>
            </li>
            <li>
              <div class="row filter_toggle">
                <div class="col-md-12">
                  <img src="<?php echo base_url() ?>public/images/filter/amenities.png" style="float: left;">
                  <span style="display:block;color: rgb(220,55,27); float: left;margin-left: 2px;">Amenities</span>
                  <span class="toogle_span" style="cursor:pointer;display:block;float: right;">Hide</span>
                </div>
              </div>
              <div class="left-search-cntr2 amenities" style="padding: 0px;">
              <!--   <label style="font-size: 12px !important; position: relative;display: block;">
                  <span class="htl-amenities hourService"></span>
                  <span style="" class="label_c">24 Hour Check-in</span> 
                </label> -->
                <label style="font-size: 12px !important; position: relative;display: block;">
                  <input type="checkbox" name="amenity" class="amenity" value="AC">&nbsp;&nbsp;&nbsp;
                  <span class="htl-amenities airCondition"></span>
                  <span style="" class="label_c">Air Conditioning</span> 
                </label>
                  <label style="font-size: 12px !important; position: relative;display: block;">
                  <input type="checkbox" name="amenity" class="amenity" value="Bar">&nbsp;&nbsp;&nbsp;
                  <span class="htl-amenities bar"></span>
                  <span style="" class="label_c">Bar</span> 
                </label>
                <label style="font-size: 12px !important; position: relative;display: block;">
                <input type="checkbox" name="amenity" class="amenity" value="Business">&nbsp;&nbsp;&nbsp;
                  <span class="htl-amenities busiCenter"></span>
                  <span style="" class="label_c">Business Centre</span> 
                </label>
               <!--  <label style="font-size: 12px !important; position: relative;display: block;">
                  <span class="htl-amenities coffeShop"></span>
                  <span style="" class="label_c">Coffee Shop</span> 
                </label> -->
                <label style="font-size: 12px !important; position: relative;display: block;">
                <input type="checkbox" name="amenity" class="amenity" value="Gym">&nbsp;&nbsp;&nbsp;
                  <span class="htl-amenities gym"></span>
                  <span style="" class="label_c">Gym</span> 
                </label>
           <!--      <label style="font-size: 12px !important; position: relative;display: block;">
                  <span class="htl-amenities internetAccess"></span>
                  <span style="" class="label_c">Internet Access</span> 
                </label> -->
                <label style="font-size: 12px !important; position: relative;display: block;">
                  <input type="checkbox" name="amenity" class="amenity" value="Pool">&nbsp;&nbsp;&nbsp;
                  <span class="htl-amenities pool"></span>
                  <span style="" class="label_c">Pool</span> 
                </label>
              <!--   <label style="font-size: 12px !important; position: relative;display: block;">
                  <span class="htl-amenities restaurant"></span>
                  <span style="" class="label_c">Restaurant</span> 
                </label> -->
                <label style="font-size: 12px !important; position: relative;display: block;">
                  <input type="checkbox" name="amenity" class="amenity" value="Room Service">&nbsp;&nbsp;&nbsp;
                  <span class="htl-amenities roomService"></span>
                  <span style="" class="label_c">Room Service</span> 
                </label>
                <label style="font-size: 12px !important; position: relative;display: block;">
                <input type="checkbox" name="amenity" class="amenity" value="Wi-fi">&nbsp;&nbsp;&nbsp; 
                  <span class="htl-amenities wifi"></span>
                 <span style="" class="label_c">Wi-Fi Access</span> 
                </label>
              </div>
            </li>
            <li>
              <div class="row filter_toggle">
                <div class="col-md-12">
                  <img src="<?php echo base_url() ?>public/images/filter/localities.png" style="float: left;">
                  <span style="display:block;color: rgb(220,55,27); float: left;margin-left: 2px;">Localities</span>
                  <span class="toogle_span" style="cursor:pointer;display:block;float: right;">Hide</span>
                </div>
              </div>
              <div class="left-search-cntr2 localities Locations" style="padding: 0px;max-height:400px;overflow-y: auto;">
                <!-- <label>
                  <input class="localities_l" type="checkbox" value="0"  style=""/>
                  <span style="" class="label_l">Aerocity Hospitality District</span> 
                </label> -->
              </div>
            </li>
          </ul>
        </div>
      </div>
      <!-- End Filter panel -->
      <div class="col-md-9">
        <div class="hotelResultsCntr" style="padding: 0;background: inherit;border: none;margin-top: 10px;">
          <!-- Hotel header -->
          <div class="hotel-results-row htlResultRow2 headerRow2">
            <div class="row header" style="background: #e9e9e9;font-size: 12px;">
              <div class="col-md-12 hotel-sort-row">
              <ul class="row onway sort_result" style="font-size: 12px;">
                <li style="margin:0">
                  <span class="font12">Sort by:</span>
                </li>
                <li style="">
                  <a href="javascript:void(0);" title="Sort By Price" rel="data-price" data-order="desc" class="HotelSorting active">Price<i class="fa fa-arrow-down"></i></a>
                </li>
                <li>
                  <a href="javascript:void(0);" title="Sort By Hotel Name" rel="data-hotel-name" data-order="desc" class="HotelSorting">Hotel Name
                  <i class="fa fa-arrow-down"></i></a>
                </li>
                <li>
                  <a href="javascript:void(0);" title="Sort By Star Rating" rel="data-star" data-order="desc" class="HotelSorting">Star Rating
                  <i class="fa fa-arrow-down"></i></a>
                </li>
                <li>
                  <span class="font12">Price: </span><span class="font12 per_room_div">Per Room Per Night  &nbsp;&nbsp;|</span><span class="font12 total_div active">&nbsp;&nbsp; Total</span>
                </li>
              </ul>
              </div>
            </div>
          </div>
          <!-- <div id="pagination_up"> </div> -->
          <div id="avail_hotels" class="results htlResultRow searchhotel_box" style="padding: 0;background: inherit;border: none;">
            <div id="rapid_fire_draft_loading" style="display: none;" align="center">
              <p style="margin-top:10px;text-align: center"> Please wait a moment...We are looking for hotels in <?php echo $cityName;?> on <?php echo $checkIn;?> for <?php echo $nights;?>&nbsp;Night</p>
              <br>
              <img align="right" style="margin-left:-55px" alt="loading.. Please wait.." src="<?php echo base_url();?>public/img/ajax-circle-loader1.gif">
              <br>
            </div>
            
          </div>
          <input type="hidden" id="setMinPrice" value="0"/>
          <input type="hidden" id="setMaxPrice" value="0"/>
          <input type="hidden" id="setCurrency" value="INR" />
          <input type="hidden" id="sessionId" value="<?php echo $this->session->userdata('session_id');?>" />
          <!-- <div id="pagination_down"> </div> -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Loading panel -->
<div class="ajaxloading" style="display:none">
  <br>
  <div id="rapid_fire_draft_ajax_loading2"  align="center">
    <!-- Updating Results... Please wait a moment .... -->
    <br />
    <div>
      <img align="center" style="margin-top: 20px;" alt="loading.. Please wait.." src="<?php echo base_url();?>public/img/ajax-circle-loader1.gif" >
    </div>
  </div>
</div>
<input type="hidden" id="scrollajax" value="0" />
<!-- FOOTER -->
<?php //$this->load->view('home/footer');?>
<!-- <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-1.10.2.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>/public/js/parsley.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-ui.js"></script>

<!-- <script src="<?php echo base_url();?>public/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.jcarousel.min.js"></script>
<script src="<?php echo base_url();?>public/js/bjqs-1.3.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/filter.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/sorting.js"></script>
<script type="text/javascript">
  var api_array = <?php echo json_encode($api_list); ?>
</script>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/webservices.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/webservicesscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/customize.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/hotels_city_list.js"></script>

<script type="text/javascript">
  //search accordion
    $('.left-search > li > .filter_toggle').click(function(){
        var a = $(this).children('div').children('span.toogle_span').text();
        // $(this).children('.toogle_span').toggleClass('show_span');
        if(a == 'Hide') {
           $(this).children('div').children('span.toogle_span').text('Show');
           // $('.left-search li').css('margin-bottom', '20px');
       }
       else {
           $(this).children('div').children('span.toogle_span').text('Hide');
           // $('.left-search li').css('margin-bottom', '0px');
       }
        // alert(a);
        $(this).next('div').slideToggle('slow');
    });
</script>

<script type="text/javascript">
  $('.searchHotel_box').hover( function() {
    $('.searchHotel_box').removeClass('silver_border');
    $(this).addClass('silver_border');
    // alert(1);
  })

    $(document).ready(function() {
      $(".per_room_div").click(function() {
          $('.total_div').removeClass('active');
          $(this).addClass('active');
          $('.total_cost').hide();
          $('.per_room_cost').show();
   });
       $(".total_div").click(function() {
          $('.per_room_div').removeClass('active');
          $(this).addClass('active');
          $('.total_cost').show();
          $('.per_room_cost').hide();
   });
    });
  </script>

  <script type="text/javascript">
$(window).load(function(){
  //calculate equal height
  var Rheight  = $('.searchResultsSection').height();
  $('.searchFiltersSection').css('min-height', Rheight + 60);
});

$('.filter-button').on('click', function(){
  $('.filter-button, .searchFiltersSection').toggleClass('open');
});



</script>
