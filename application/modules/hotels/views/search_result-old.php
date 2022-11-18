<?php $this->load->view('home/home_template/header');?>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/jqueryui/jquery-ui.css"> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/style.css">
<?php
  // $session_data = $this->session->userdata('hotel_search_data');
  $session_data = $searcharray;
// print_r($searcharray);exit;
  $city_arr = explode(',',$session_data['cityName']);
  $cityName = $city_arr[0];
  $cityCode = $session_data['cityCode'];
  $cityName2 = ucwords($session_data['cityName']);
  $adults_count = $session_data['adults_count'];
  $childs_count = $session_data['childs_count'];
  $rooms = $session_data['rooms'];
  $nights = $session_data['nights'];
  $checkIn = date('j M, Y',strtotime(str_replace('/','-',$session_data['checkIn'])));
  $checkOut = date('j M, Y',strtotime(str_replace('/','-',$session_data['checkOut'])));
?>

<section class="section-padding">
   <div class="container">
      <div class="row filterResultContent">
         <div class="col-lg-3 col-md-3 flightResultsSection" >
            <div class="d-md-none d-lg-none filter-button"><i class="mdi mdi-filter-outline"></i></div>
            <div class="searchFiltersSection">
               <div class="card sidebar-card">
                  <div class="card-body">
                     <div class="mb-2" role="tab" id="heading1">
                        <h5 class="mb-0">
                        <a class="collapsed d-block" data-toggle="collapse" href="#collapse1" aria-expanded="false" aria-controls="collapse1">Hotel Name <i class="mdi mdi-arrow-down float-right"></i>
                        </a>
                     </h5>
                     </div>
                     <div id="collapse1" class="collapse show" role="tabpanel" aria-labelledby="heading1">

                        <div class="input-group">
                         <input type="text" name="hotelName" id="hotelName" class="form-control transparent-input" placeholder="Hotel Name">
                         <span class="input-group-btn">
                           <!-- <button type="button" class="btn btn-primary hotelNameSearch" style="height: 38px;border-radius: 0;">Go</button> -->
                           <i class="mdi mdi-close clearIcon" style="display: none" id="clearIcon"></i>
                         </span>
                       </div>
                     </div>
                  </div>
               </div>
               <div class="card sidebar-card">
                  <div class="card-body">
                     <div class="mb-2" role="tab" id="heading2">
                        <h5 class="mb-0">
                        <a class="collapsed d-block" data-toggle="collapse" href="#collapse2" aria-expanded="false" aria-controls="collapse2">Price Range <i class="mdi mdi-arrow-down float-right"></i>
                        </a>
                     </h5>
                     </div>
                     <div id="collapse2" class="collapse show" role="tabpanel" aria-labelledby="heading2">
                        <div class="clearfix mb-1">
                           <span type="text" class="range-value" id="price-start" style="float: left;"></span>
                           <span type="text" class="range-value range-value-end" id="price-end" style="float: right;"></span>
                        </div>
                        <div class="px-2">
                           <div id="priceSlider"></div>
                           <input type="hidden" name="minPrice" id="minPrice" class="autoSubmit"  />
                           <input type="hidden" name="maxPrice" id="maxPrice" class="autoSubmit"  />
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card sidebar-card">
                  <div class="card-body">
                     <div class="mb-2" role="tab" id="heading3">
                        <h5 class="mb-0">
                        <a class="collapsed d-block" data-toggle="collapse" href="#collapse3" aria-expanded="false" aria-controls="collapse3">Star Rating <i class="mdi mdi-arrow-down float-right"></i>
                        </a>
                     </h5>
                     </div>
                     <div id="collapse3" class="collapse show" role="tabpanel" aria-labelledby="heading3">
                        <ul class="star-filter">
                           <?php for($s=1;$s<=5;$s++) { ?>
                           <li class="StarRatingLi">
                              <label>
                                 <small><?php echo $s ?></small>
                                 <span class="mdi mdi-star"></span>
                                 <input type="checkbox" class="StarRating" name="star" value="<?php echo $s ?>">
                              </label>
                           </li>
                           <?php } ?>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-9 col-md-9">
          <div class="no-slider-form modify mb-3 bg-white py-2 px-2" style="border-radius: 4px;">
                     <?php $this->load->view('modify_search', $session_data); ?>
                  </div>
            <div class="row">
               <div class="col-lg-12 col-md-12">
                  <div class="card card-list card-list-view mb-2 bg-secondary" style="height: 45px">
                     <div class="row">
                        <div class="col-lg-12 col-md-12">
                           <div class="sortby card-body d-flex justify-content-between flex-wrap align-content-around pt-2 pb-2">
                              <div class="minwidth1"></div>
                              <div class="minwidth1">
                                 <a href="javascript:void(0);" title="Sort By Hotel Name" rel="data-hotel-name" data-order="asc" class="HotelSorting text-white">
                                    Hotel Name <i class="mdi mdi-sort-ascending"></i>
                                 </a>
                              </div>
                              <div class="minwidth2">
                                 <a href="javascript:void(0);" title="Sort By Star Rating" rel="data-star" data-order="asc" class="HotelSorting text-white">
                                    Star Rating <i class="mdi mdi-sort-ascending"></i>
                                 </a>
                              </div>
                              <div class="minwidth4">
                                 <a href="javascript:void(0);" title="Sort By Price" rel="data-price" data-order="asc" class="HotelSorting text-white">
                                    Price <i class="mdi mdi-sort-descending"></i>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="rapid_fire_draft_loading">
              <?php $this->load->view('blank') ?>
            </div>
            <div id="avail_hotels"></div>
            <!-- on scroll load -->
            <div class="ajaxloading" style="display:none">
              <?php $this->load->view('blank') ?>
            </div>
         </div>
      </div>
   </div>
</section>
<input type="hidden" id="setMinPrice" value="0">
<input type="hidden" id="setMaxPrice" value="41324">
<input type="hidden" id="setCurrency" value="INR">
<input type="hidden" id="sessionId" value="<?php echo $this->session->session_id;?>">
<!-- for auto scroll -->
<input type="hidden" id="totalnohotels">
<input type="hidden" id="scrollajax" value="0">

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelF" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="myModalLabelF">Air Fare Rules</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <h1 class="text-center"></h1>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
      </div> -->
    </div>
  </div>
</div>
<input type="hidden" id="searcharray" value='<?php echo serialize($searcharray); ?>'>
<?php $this->load->view('home/home_template/footer');?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/hwebservices.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/jqueryui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/autocomplete/hotels_city_list.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/hotel/filter.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/hotel/sorting.js"></script>

<script type="text/javascript">
var api_array = <?php echo json_encode($api_list); ?>
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/webservices.js"></script>

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