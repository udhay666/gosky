<?php $this->load->view('home/home_template/header');?>
<?php
  // $session_data = $this->session->userdata('hotel_search_data');
  $session_data = $searcharray;

  $city_arr = explode(',',$session_data['cityName']);
  $cityName = $city_arr[0];
  $cityCode = $session_data['cityCode'];
  $cityName2 = ucwords($session_data['cityName']);
  $adults_count = $session_data['adults_count'];
  $childs_count = $session_data['childs_count'];
  $rooms = $session_data['rooms'];
  $nights = $session_data['nights'];
//   $checkIn = date('j M, Y',strtotime(str_replace('/','-',$session_data['checkIn'])));
  $checkIn = date("D, d M'y",strtotime(str_replace('/','-',$session_data['checkIn'])));
  $checkOut = date('j M, Y',strtotime(str_replace('/','-',$session_data['checkOut'])));
?>
<style>
.tsc_pagination{
    display: inline-flex;
    list-style-type: none;
    text-align: center;
}
.tsc_pagination li:first-child{
margin: 10px;
}
/* .tsc_pagination .current a{
    background-color: #26ae7a;
    border-radius: 50px;
    color: white;
} */
.clearIcon{
    cursor: pointer;
    font-size: 18px;
    color: #555;
    position: absolute;
    right: 0;
    top: 0;
    line-height: 38px;
    z-index: 99;
}
#grid-view{
    width: 300px;
}
@media only screen and (max-width: 991px) {
#grid-view{
    width: 719px;
}
    
}

</style>
<section class="section-pagetop">
    <div class="container"> <!-- id="modify_search_details" -->
        <div class="row no-gutter">
            <div class="col-md-2 col-sm-4 col-xs-6">
                <p class="item-info">
                    <i class="material-icons"></i>
                    <span class="title">Destination</span>
                    <span class="val"><?php echo $cityName ?></span>
                    <input type="hidden" name="cityid" value="<?php echo $cityCode ?>" class="cityid" id="hotelcityid">
                </p> 
            </div> <!-- col // -->       
            <div class="col-md-2 col-sm-4 col-xs-6">
                <p class="item-info">
                    <i class="fa fa-globe" aria-hidden="true"></i>
                    <span class="title">Nationality</span>
                    <span class="val"><img style="max-width: 30px;" src="<?php echo base_url(); ?>assets/images/flags/30x20/in.png"></span>
                </p> 
            </div> <!-- col // -->     
            <div class="col-md-2 col-sm-4 col-xs-6">
                <p class="item-info">
                    <i class="material-icons"></i>
                    <span class="title">Check in</span>
                    <span class="val"><?php echo $checkIn; ?></span>
                </p> 
            </div> <!-- col // --> 
            <div class="col-md-2 col-sm-3 col-xs-6">
                <p class="item-info">
                    <i class="material-icons"></i>
                    <span class="title">Check out</span>
                    <span class="val"><?php echo $checkOut; ?></span>
                </p>
            </div> <!-- col // --> 
            <div class="col-md-1 col-sm-3 col-xs-4">
                <p class="item-info">
                    <i class="material-icons"></i>
                    <span class="title">Guests</span>
                    <span class="val"><b class="icon lg fa fa-male" title="" data-toggle="tooltip" data-original-title="Adults"></b>  <?php echo $adults_count.','; ?> <b class="icon sm fa fa-child" title="" data-toggle="tooltip" data-original-title="Childs"></b> <?php echo $childs_count; ?> <bb class="hidden-xs hidden-lg"></bb></span>
                </p>
            </div> <!-- col // --> 
            <div class="col-md-2 col-sm-3 col-xs-5">
                <div class="row no-gutter">
                    <p class="item-info col-xs-6">
                        <i class="material-icons"></i>
                        <span class="title">Rooms</span>
                        <span class="val"><?php echo $rooms; ?></span>
                    </p>
                    <p class="item-info col-xs-6"> 
                        <span class="title">Nights</span>
                        <span class="val"><?php echo $nights; ?></span>
                    </p>
                </div>
            </div>
            <div class="col-md-1 col-sm-3 col-xs-3">
                <a href="javascript:void(0);" class="btn btn-block btn-warning btn-modify"> Modify </a>
            </div> <!-- col // --> 
        </div> <!-- row// -->
    </div> <!-- container // -->
</section>

<section class="section-modify" style="display: none;">
    <div class="container">
        <div class="inner-block">
            <!-- -------- modify block -------- -->
            <!-- -----------------  HOTEL FORM -------------------- -->
            
    <form class="form-validatorbt" action="<?php echo site_url(); ?>hotel/search" autocomplete="on" role="form" method="POST" novalidate="true">
        <div class="gl__fieldset">
            <div class="gl__input-group gl__search">
                <div class="input-wrap form-group">
                    <i class="flaticon-big-bed-with-one-pillow"></i>
                    <input id="hotel_autocomplete" tabindex="1" type="text" name="city" value="Dubai, AE" placeholder="Destination name/Hotel" class="hotel_autocomplete ui-autocomplete-input" required="" autocomplete="off">
                    <input id="target_search" name="target_search" type="hidden" value="L|40601">
                </div>
            </div>
            
            <div class="gl__input-group gl__date">
                <div class="input-wrap form-group">
                    <i class="material-icons"></i>                 
                    <input type="text" id="hotel-daterange" required="required" name="hotel_daterange" placeholder="Check in - Check out" readonly="readonly" style="cursor:pointer;" tabindex="2">
                    <input type="hidden" id="hrange_checkin" required="required" name="check_in" value="11-03-2022">
                    <input type="hidden" id="hrange_checkout" required="required" name="check_out" value="12-03-2022">
                </div>
            </div>
            <div class="gl__input-group gl__guests">
                <div class="form-single-wrap" style="margin-bottom: 0px;">
                    <div class="input-wrap occupancy-change">
                        <i class="material-icons"></i>
                        <p class="input-static"><span id="occ-room-count" tabindex="4">1</span> Room, <span id="occ-adult-count">2</span> Adults, <span id="occ-child-count">0</span> Childs</p>
                        <i class="arrow material-icons"></i>                              
                    </div>
                    <div class="occupancy-dropdown" style="display:none;" role="menu">
                        <article class="row-sm room-count">
                            <label class="col-sm-8 col-xs-6 text-primary b">Rooms</label>
                            <div class="col-sm-4 col-xs-6">
                                <div class="input-group pull-right">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default number-spinner" data-field="room_count" data-type="minus"> <i class="fa fa-minus"></i></button>
                                    </span>
                                    <input type="text" class="form-control text-center spinner-value" name="room_count" id="room_count" value="1" max="4" min="1" readonly="readonly">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default number-spinner" data-field="room_count" data-type="plus"><i class="fa fa-plus"></i></button>
                                    </span>
                                </div> <!--  input-group number-spinner //  -->
                            </div> <!-- col// -->
                        </article>
                        <div id="rooms-repeat-block">
                                                            <div id="room-1">
                                        <h5 class="title"><i class="fa fa-hotel"></i>&nbsp;&nbsp;Room 1</h5>
                                        <div class="item-occupancy cfx" id="child-age-block-1">
                                            <div class="item-people">
                                                <label> <i class="fa fa-male"></i>  Adults</label>
                                                <select id="adults-1" class="form-control" onchange="countOccupancies()" name="adults1">
                                                    <option value="1">1</option>
                                                    <option selected="" value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                </select>
                                            </div>
                                            <div class="item-people">
                                                <label><i class="fa fa-child"></i> Childs</label>
                                                <select id="children-1" class="form-control" name="childs1" onchange="renderAgeDropdown(this, 1)">
                                                    <option selected="" value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </div>                                        
                                                                                </div> <!-- children-age-wrap // -->
                                    </div>

                                                        </div>
                        <p id="checkout-date-txt-block" class="small text-muted hide" style="margin-bottom: 5px;"><i class="fa fa-info-circle"></i>&nbsp;Age of Childs at&nbsp;<span class="b" id="checkout-date-txt"></span></p>
                        <!-- children-age-wrap // -->
                        <a href="javascript:;" class="btn btn-warning btn-block btn-ok text-uppercase"> ok </a>                    
                    </div> <!--  occupancy-dropdown end //  -->
                </div> <!--  form-single-wrap //  -->
            </div>
            <div class="gl__input-group gl__submit-button"><button class="btn btn-warning" type="submit">Modify search</button></div>
        </div>    
    </form>


    <script id="room-repeat-template" type="text/x-handlebars-template" defer="defer">
    <div id="room-{{roomNumber}}">
        <h5 class="title"><i class="fa fa-hotel"></i>&nbsp;&nbsp;Room {{roomNumber}}</h5>
        <div class="item-occupancy cfx" id="child-age-block-{{roomNumber}}">
            <div class="item-people">
                <label> <i class="fa fa-male"></i>  Adults</label>
                <select id='adults-{{roomNumber}}' class="form-control" onchange="countOccupancies()" name="adults{{roomNumber}}">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </div>
            <div class="item-people">
                <label><i class="fa fa-child"></i> Childs</label>
                <select id="children-{{roomNumber}}" class="form-control" name="childs{{roomNumber}}" onchange="renderAgeDropdown(this, {{roomNumber}})">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
            
        </div> <!-- children-age-wrap // -->
    </div>
    </script>

    <script id="child-age-repeat-template" type="text/x-handlebars-template" defer="defer">           
        <div class="item-people age-child" id="child-{{roomNumber}}-{{childNumber}}">
                    <label>Age {{childNumber}}</label>
            <select id="childage-{{roomNumber}}-{{childNumber}}" class="form-control" name="child_age{{roomNumber}}_{{childNumber}}">            
                <option value="0"><1</option>            
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                        </select>
        </div>
    </script>            <!-- -----------------  HOTEL FORM END// -------------------- -->
            </div>
        </div> <!-- container // -->
</section>
<?php //echo"<pre>"; print_r($searcharray);exit; ?>
    <section class="section-content">
        <div class="container" id="hotel-content">
            <div class="row-sm">
                <aside class="col-md-3 col-sm-12">                        
                    <figure class="btn-group btn-group-view swap-tiles" data-toggle="buttons" style="">
                        <label class="btn active" id="grid-view" onclick="changeView('#avail_hotels', this, 0)">
                            <input type="radio" checked=""> <i class="fa fa-bars"></i> List View                    </label>
                                           </label>
                    </figure>
                   
                    <div class="filter-wrap" id="filter-area">
                        <a href="#" class="btn-filter-close rotate-left btn btn-danger visible-sm visible-xs" style="position: fixed; right:-30px; top:50%"> × Close  filter</a>
                        <div id="filters-block">
<article class="panel panel-default">
        <header class="panel-heading"> 
            <h4 class="panel-title">Filter your results by</h4>
        </header> <!-- panel-heading// -->

        <div class="panel-body">
            <section id="hotel_name" class="mb30">                        
                <div class="clearfix mb10">
                    <h5 class="b">Search By Hotel Name</h5>                
                </div>
                <div class="panel-content">      
                    <div class="input-group">
                        <input name="hotelName" id="hotelName" class="form-control form-control-lg ui-autocomplete-input" type="text" placeholder="Any  Hotel" autocomplete="off">
                        <span class="input-group-btn">
                        <i class="fa fa-close clearIcon" style="display: none" id="clearIcon"></i>
                        </span>
                        <input id="hid" name="hid" type="hidden">
                        <span class="input-group-addon btn btn-warning white"> <i class="fa fa-search" style="margin: 0px"></i></span>
                    </div>
                </div>            
    </section>

        <section id="price-filter" class="mb30">                
            <div class="clearfix mb10">
                <h5 class="b">Price</h5>                
            </div>
            <div id="priceSlider" style="margin: 0px 8px;" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span></div>
            <div class="slider-numbers-wrap">
                <input type="hidden" id="minPrice" value="0">
                <input type="hidden" id="maxPrice" value="0">
                <span class="min-price-label pull-left">INR <span id="min-price-txt">0</span></span> <span class="max-price-label pull-right">INR <span id="max-price-txt">0</span></span>
                <div class="clearer"></div>
                <div id="price-range"></div>
            </div>
        </section> <!-- panel-body // -->

        <section id="rating-filter" class="mb30">
            <div class="clearfix">
                <h5 class="b pull-left">Star Rating</h5>
                <!-- <a class="show-all pull-right" href="javascript:;">Show all</a> -->
            </div>
            <div class="block-checkbox mt15">
            <?php for($s=1;$s<=5;$s++) { ?>
                <label class="block-checkbox-item refinement"><input type="checkbox" class="StarRating" name="star" id="stars-1" value="<?php echo $s; ?>"><span class="block-checkbox-text"><?php echo $s; ?>★ </span></label>                
                <?php } ?>
            </div>                             
        </section> <!-- panel-body // -->  
        <section>

        <section id="accommodation-type-filter" class="mb30">
            <div class="clearfix">
                <h5 class="b pull-left">Location</h5>
                <!-- <a class="show-all pull-right" href="javascript:;">Show all</a> -->
            </div>
            <br>
            <div id="location_search"  style="position:relative; top:0; left:0;" dir="ltr">            
              
                
              </div>                           
        </section> <!-- panel-body // -->  
        <section>


        

        



        





    </div>
</article>
</div>
                </div> 
            </aside><!-- col // -->
            <main class="col-md-9 col-sm-12">
        <header class="blok-header">     
            
                <h4 class="title pull-left"><i class="fa fa-bed pull-left visible-xs"></i> <span id="total-search-hotels">249</span> <span class="hidden-xs">Result Found</span></h4>
        </header> <!-- blok-header// -->
                <div id="hotel_result">
<section id="avail_hotels" style="">
    

</section> <!-- row// -->
<div id="pagination">
    
</div>
<section id="hotel-map-view" style="display: none; ">
    <address class="panel panel-default panel-map">
        <div class="" id="map-popwindow" style="display: none;"></div>
        <map id="hotels-map" style="width:100%; height:800px; background-color: #666; display: block; border-radius:5px;"></map>
    </address>
</section></div>
         
    
    <!-- loading state start -->
    <article class="loading-content" id="hotels">
                    <br/><br/><br/>
        <img src="<?php echo base_url('assets/icons/flights_icon/loading.gif');?>">
        <h3 class="text1">Searching for your hotel</h3>
        <h5 class="text2">One moment please ...</h5> 
        <h5 class="text2"> We are finding you the comfiest beds and the softest pillows with the best price ...</h5>
    </article>
                </article>
                <!-- loading state end// -->
            </main>

            <!-- col // -->
        </div><!--  row// -->

    </div> <!-- container // -->
    <br><br>
</section>
<input type="hidden" id="setMinPrice" value="0">
<input type="hidden" id="setMaxPrice" value="41324">
<input type="hidden" id="setCurrency" value="INR">
<input type="hidden" id="sessionId" value="<?php echo $this->session->session_id;?>">
<!-- for auto scroll -->
<input type="hidden" id="totalnohotels">
<input type="hidden" id="scrollajax" value="0">
<input type="hidden" id="siteUrl" value="<?php echo site_url(); ?>">

<input type="hidden" id="searcharray" value='<?php echo serialize($searcharray); ?>'>
<script type="text/javascript">
var api_array = <?php echo json_encode($api_list); ?>

</script>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/hwebservices.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/webservices.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/jqueryui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/autocomplete/hotels_city_list.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/hotel/filter.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/hotel/sorting.js"></script>


<!-- <script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/webservices.js"></script> -->

<script type="text/javascript">
   $('.filter-button').on('click', function(){
      $('.filter-button, .searchFiltersSection').toggleClass('open');
   });
   $('#mod-search-close, #modify-search-btn').click(function(){ 
      $('.modify-search').slideToggle('fast');
   });

   $(window).on('load', function(e){
      // $('#myModal').modal('show');
   });
</script>
<script>.tsc_pagination li
    $(".tsc_pagination li a").on('click', function(e){
    $(".tsc_pagination li .current").removeClass('current');
    $(this).parent().addClass('current'); 
    e.preventDefault();
});
</script>
<?php $this->load->view('home/home_template/footer');?>
