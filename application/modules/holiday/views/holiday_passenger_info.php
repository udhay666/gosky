<?php $this->load->view('home/header');?>
<!-- PNotify CSS -->
<link href="<?php echo base_url(); ?>public/pnotify/pnotify.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/pnotify/pnotify.buttons.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/pnotify/pnotify.nonblock.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>public/js/form-wizard/form-wizard.css" rel="stylesheet">
<div id="wrapper">
<section id="title-section" class="title-section page">
  <section class="" id="holiday-title">
    <div class="row2">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard row2">
        <div class="col-sm-12">
          <ul class="wizard_steps nav nav-pills">
            <li><a href="#"><span class="step_no wizard-step">1</span><span class="step_descr">Your Tour</span></a></li>
            <li  class="active"><a href="#"><span class="step_no wizard-step">2</span><span class="step_descr">Select Accomodation</span></a></li>
            <li><a href="#"><span class="step_no wizard-step">3</span><span class="step_descr">Traveller Details</span></a></li>
            <li><a href="#"><span class="step_no wizard-step">4</span><span class="step_descr">Payment & Confirmation</span></a></li>
          <!--   <li><a href="#"><span class="step_no wizard-step">5</span><span class="step_descr">Confirmation</span></a></li> -->
          </ul>
        </div>
      </div>
    </div>

    <div class="col-sm-9 col-xs-12">
      <div class="col-sm-12 col-xs-12">
        <h1><?php echo $holidaydetails->package_title; ?></h1>
      </div>
      <div class="row2">
        <div class="col-sm-6 adults-drop-wrapper">
          <div class="form-group">
            <label class="sr-only">No of Guests</label>
            <div class="input-group">
              <label for="noOfPassengers" class="input-group-addon" style="border-radius: 0;border: 1px solid #253035;"><i class="fa fa-user" style="color:#253035" aria-hidden="true"></i> <!-- Passengers --></label>
              <input type="text" id="noOfPassengers" value="2" class="form-control passengers no-input" placeholder="Passengers" readonly style="background:#253035 !important;color: #fff;cursor: pointer !important;border: 1px solid #253035;" />
              <span class="rooms-text" style="color: #fff;top: 9px"><span id="total_rooms" style="font-size: 16px">1</span> Room(s)</span>
              <span class="passenger-text" style="color: #fff;top: 9px">Guest(s) |</span>
              <div class="adults-dropdown dropdown-menu select-passenger hide" style="width: 120%">
                <div class="col-sm-12">
                  <div class="row flexdiv room1 passdetails" id="room1">
                    <div class="">
                      <div class="form-group">
                        <label class="control-label">Rooms</label>
                        <!-- <input type="hidden" id="total_rooms" value="" /> -->
                        <div class="input-group">
                          <div class="passenger-inc-dec">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-minus2 btn-inc-dec" data-type="minus" data-field="quant[1]">
                              -
                              </button>
                            </span>
                            <input type="text" name="room_count" class="form-control input-number" value="1" min="1" max="4" id="rooms-q">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-plus2 btn-inc-dec" data-type="plus" data-field="quant[1]">
                              +
                              </button>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="">
                      <div class="form-group">
                        <label class="control-label" id="adultroom1">Adult</label>
                        <div class="input-group">
                          <div class="passenger-inc-dec">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec" data-type="minus" data-field="quant[1]">
                              -
                              </button>
                            </span>
                            <input type="text" name="adults[]" class="form-control input-number" value="2" min="1" max="3" id="adults-q">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec" data-type="plus" data-field="quant[1]">
                              +
                              </button>
                            </span>
                          </div>
                        </div>
                        <label class="control-label">(12+ yrs)</label>
                      </div>
                    </div>
                    <div class="">
                      <div class="form-group">
                        <label class="control-label" title="With Bed" id="childroom1">Child(With bed)</label>
                        <div class="input-group">
                          <div class="passenger-inc-dec">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec childs" data-type="minus" data-field="quant[1]">
                              -
                              </button>
                            </span>
                            <input type="text" name="childs[]" class="form-control input-number" value="0" min="0" max="2" id="childs-q">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec childs" data-type="plus" data-field="quant[1]">
                              +
                              </button>
                            </span>
                          </div>
                        </div>
                          <label class="control-label">(Below 12 yrs)</label>
                      </div>
                    </div>
                    <!-- Child Without Bed -->
                    <div class="">
                      <div class="form-group">
                        <label class="control-label" title="Without Bed" id="childwithoutbedroom1">Child(Without Bed)</label>
                        <div class="input-group">
                          <div class="passenger-inc-dec">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec childswithoutbed" data-type="minus" data-field="quant[1]">
                              -
                              </button>
                            </span>
                            <input type="text" name="childswithoutbed[]" class="form-control input-number" value="0" min="0" max="1" id="childswithoutbed-q">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec childswithoutbed" data-type="plus" data-field="quant[1]">
                              +
                              </button>
                            </span>
                          </div>
                        </div>
                          <label class="control-label">(Below 12 yrs)</label>
                       </div>
                    </div>
                    <!--  -->
                    <div class="">
                      <div class="form-group">
                        <label class="control-label" id="infantroom1">Infant</label>
                        <div class="input-group">
                          <i class="form-baby-icon eu-icon-baby-gray"></i>
                          <div class="passenger-inc-dec">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec" data-type="minus" data-field="quant[1]">
                              -
                              </button>
                            </span>
                            <input type="text" name="infants[]" class="form-control input-number" value="0" min="0" max="2" id="infants-q">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec" data-type="plus" data-field="quant[1]">
                              +
                              </button>
                            </span>
                          </div>
                        </div>
                          <label class="control-label">(0-2 yrs)</label>
                       </div>
                    </div>
                  </div>
                  <div class="row flexdiv room2 passdetails" id="room2" style="display: none;">
                    <div class="">
                      <div class="form-group">
                        <label class="control-label invisible">Rooms</label>
                        <div class="input-group">
                          <label class="control-label">Room 2</label>
                        </div>
                      </div>
                    </div>
                    <div class="">
                      <div class="form-group">
                        <label class="control-label" id="adultroom2">Adult</label>
                        <div class="input-group">
                          <div class="passenger-inc-dec">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec" data-type="minus" data-field="quant[1]">
                              -
                              </button>
                            </span>
                            <input type="text" name="adults[]" class="form-control input-number" value="0" min="1" max="3" id="adults-q2">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec" data-type="plus" data-field="quant[1]">
                              +
                              </button>
                            </span>
                          </div>
                        </div>
                        <label class="control-label">(12+ yrs)</label>                        
                      </div>
                    </div>
                    <div class="">
                      <div class="form-group">
                        <label class="control-label" title="With Bed" id="childroom2">Child(With bed)</label>
                        <div class="input-group">
                          <div class="passenger-inc-dec">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec childs" data-type="minus" data-field="quant[1]">
                              -
                              </button>
                            </span>
                            <input type="text" name="childs[]" class="form-control input-number" value="0" min="0" max="2" id="childs-q2">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec childs" data-type="plus" data-field="quant[1]">
                              +
                              </button>
                            </span>
                          </div>
                        </div>
                          <label class="control-label">(Below 12 yrs)</label>
                     </div>
                    </div>
                    <!-- Child Without Bed -->
                    <div class="">
                      <div class="form-group">
                        <label class="control-label" title="Without Bed" id="childwithoutbedroom2">Child(Without Bed)</label>
                        <div class="input-group">
                          <div class="passenger-inc-dec">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec childswithoutbed" data-type="minus" data-field="quant[1]">
                              -
                              </button>
                            </span>
                            <input type="text" name="childswithoutbed[]" class="form-control input-number" value="0" min="0" max="1" id="childswithoutbed-q2">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec childswithoutbed" data-type="plus" data-field="quant[1]">
                              +
                              </button>
                            </span>
                          </div>
                        </div>
                          <label class="control-label">(Below 12 yrs)</label>
                       </div>
                    </div>
                    <!--  -->
                    <div class="">
                      <div class="form-group">
                        <label class="control-label" id="infantroom2">Infant</label>
                        <div class="input-group">
                          <i class="form-baby-icon eu-icon-baby-gray"></i>
                          <div class="passenger-inc-dec">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec" data-type="minus" data-field="quant[1]">
                              -
                              </button>
                            </span>
                            <input type="text" name="infants[]" class="form-control input-number" value="0" min="0" max="2" id="infants-q2">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec" data-type="plus" data-field="quant[1]">
                              +
                              </button>
                            </span>
                          </div>
                        </div>
                         <label class="control-label">(0-2 yrs)</label>
                      </div>
                    </div>
                  </div>
                  <div class="row flexdiv room3 passdetails" id="room3" style="display: none;">
                    <div class="">
                      <div class="form-group">
                        <label class="control-label invisible">Rooms</label>
                        <div class="input-group">
                          <label class="control-label">Room 3</label>
                        </div>
                      </div>
                    </div>
                    <div class="">
                      <div class="form-group">
                        <label class="control-label" id="adultroom3">Adult</label>
                        <div class="input-group">
                          <div class="passenger-inc-dec">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec" data-type="minus" data-field="quant[1]">
                              -
                              </button>
                            </span>
                            <input type="text" name="adults[]" class="form-control input-number" value="0" min="1" max="3" id="adults-q3">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec" data-type="plus" data-field="quant[1]">
                              +
                              </button>
                            </span>
                          </div>
                        </div>
                        <label class="control-label">(12+ yrs)</label>
                       </div>
                    </div>
                    <div class="">
                      <div class="form-group">
                        <label class="control-label" title="With Bed" id="childroom3">Child(With bed)</label>
                        <div class="input-group">
                          <div class="passenger-inc-dec">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec childs" data-type="minus" data-field="quant[1]">
                              -
                              </button>
                            </span>
                            <input type="text" name="childs[]" class="form-control input-number" value="0" min="0" max="2" id="childs-q3">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec childs" data-type="plus" data-field="quant[1]">
                              +
                              </button>
                            </span>
                          </div>
                        </div>
                          <label class="control-label">(Below 12 yrs)</label>
                       </div>
                    </div>
                    <!-- Child Without Bed -->
                    <div class="">
                      <div class="form-group">
                        <label class="control-label" title="Without Bed" id="childwithoutbedroom3">Child(Without Bed)</label>
                        <div class="input-group">
                          <div class="passenger-inc-dec">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec childswithoutbed" data-type="minus" data-field="quant[1]">
                              -
                              </button>
                            </span>
                            <input type="text" name="childswithoutbed[]" class="form-control input-number" value="0" min="0" max="1" id="childswithoutbed-q3">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec childswithoutbed" data-type="plus" data-field="quant[1]">
                              +
                              </button>
                            </span>
                          </div>
                        </div>
                         <label class="control-label">(Below 12 yrs)</label>
                      </div>
                    </div>
                    <!--  -->
                    <div class="">
                      <div class="form-group">
                        <label class="control-label" id="infantroom3">Infant</label>
                        <div class="input-group">
                          <i class="form-baby-icon eu-icon-baby-gray"></i>
                          <div class="passenger-inc-dec">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec" data-type="minus" data-field="quant[1]">
                              -
                              </button>
                            </span>
                            <input type="text" name="infants[]" class="form-control input-number" value="0" min="0" max="2" id="infants-q3">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec" data-type="plus" data-field="quant[1]">
                              +
                              </button>
                            </span>
                          </div>
                        </div>
                         <label class="control-label">(0-2 yrs)</label>
                      </div>
                    </div>
                  </div>
                  <div class="row flexdiv room4 passdetails" id="room4"  style="display: none;">
                    <div class="">
                      <div class="form-group">
                        <label class="control-label invisible">Rooms</label>
                        <div class="input-group">
                          <label class="control-label">Room 4</label>
                        </div>
                      </div>
                    </div>
                    <div class="">
                      <div class="form-group">
                        <label class="control-label" id="adultroom4">Adult</label>
                        <div class="input-group">
                          <div class="passenger-inc-dec">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec" data-type="minus" data-field="quant[1]">
                              -
                              </button>
                            </span>
                            <input type="text" name="adults[]" class="form-control input-number" value="0" min="1" max="3" id="adults-q4">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec" data-type="plus" data-field="quant[1]">
                              +
                              </button>
                            </span>
                          </div>
                        </div>
                        <label class="control-label">(12+ yrs)</label>
                       </div>
                    </div>
                    <div class="">
                      <div class="form-group">
                        <label class="control-label" title="With Bed" id="childroom4">Child(With bed)</label>
                        <div class="input-group">
                          <div class="passenger-inc-dec">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec childs" data-type="minus" data-field="quant[1]">
                              -
                              </button>
                            </span>
                            <input type="text" name="childs[]" class="form-control input-number" value="0" min="0" max="2" id="childs-q4">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec childs" data-type="plus" data-field="quant[1]">
                              +
                              </button>
                            </span>
                          </div>
                        </div>
                         <label class="control-label">(Below 12 yrs)</label>
                       </div>
                    </div>
                    <!-- Child Without Bed -->
                    <div class="">
                      <div class="form-group">
                        <label class="control-label" title="Without Bed" id="childwithoutbedroom4">Child(Without Bed)</label>
                        <div class="input-group">
                          <div class="passenger-inc-dec">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec childswithoutbed" data-type="minus" data-field="quant[1]">
                              -
                              </button>
                            </span>
                            <input type="text" name="childswithoutbed[]" class="form-control input-number" value="0" min="0" max="1" id="childswithoutbed-q4">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec childswithoutbed" data-type="plus" data-field="quant[1]">
                              +
                              </button>
                            </span>
                          </div>
                        </div>
                        <label class="control-label">(Below 12 yrs)</label>
                     </div>
                    </div>
                    <!--  -->
                    <div class="">
                      <div class="form-group">
                        <label class="control-label" id="infantroom4">Infant</label>
                        <div class="input-group">
                          <i class="form-baby-icon eu-icon-baby-gray"></i>
                          <div class="passenger-inc-dec">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec" data-type="minus" data-field="quant[1]">
                              -
                              </button>
                            </span>
                            <input type="text" name="infants[]" class="form-control input-number" value="0" min="0" max="2" id="infants-q4">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec" data-type="plus" data-field="quant[1]">
                              +
                              </button>
                            </span>
                          </div>
                        </div>
                         <label class="control-label">(0-2 yrs)</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="rightalign">
                        <!-- <label class="control-label invisible">Child(12-24 Years)</label> -->
                        <button type="button" class="done2 btn btn-primary">Done</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label class="sr-only">Departure</label>
            <div class="input-group">
              <label class="input-group-addon" for="departureDate" style="border-radius: 0;border: 1px solid #253035;"><i class="fa fa-calendar" aria-hidden="true" style="color:#253035;"></i></label>
              <input name="departDate" type="text" id="departureDate" value="" class="form-control checkin hasDatepicker arr_date" placeholder="Arrival Date"  data-date-format="dd/mm/yyyy" readonly="readonly" style="background:#253035 !important;color: #fff;cursor: pointer;border: 1px solid #253035;">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-9 col-xs-12">  
      <div class="row2 margintop50">
        <!-- Service Section -->        
        <div class="mobile-horizontal-container" id="accommodations">
        <h2 style="margin-left: 21px;text-transform: uppercase;">Accommodation</h2>
          <div class="mobile-horizontal-row">         
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="max-width: 295px">
              <div class="service-item accommodation-selectfull" style="cursor: pointer;">
                <div class="service-icon">
                  <div id="service-inner">
                    <div class="service-r">
                      <span>3 STAR</span>
                    </div>
                  </div>
                </div>
                <h3>COMFORT</h3>
                <p> <?php if(!empty($holidaydetails->comfort))
                { echo $holidaydetails->comfort; } ?></p>
                <div class="card-bottom">
                  <div class="button-toggle">
                    <input type="radio" class="accommodation-select" id="accommodation-card-1" value="Comfort" <?php if($accom_type=="Comfort"){echo 'checked';}?>>
                    <label for="accommodation-card-1"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="max-width: 295px">
              <div class="service-item accommodation-selectfull" style="cursor: pointer;">
                <div class="service-icon">
                  <div id="service-inner">
                    <div class="service-r">
                      <span>4 STAR</span>
                    </div>
                  </div>
                </div>
                <h3>QUALITY</h3>
                <p> <?php if(!empty($holidaydetails->quality))
                { echo $holidaydetails->quality; } ?></p>
                <div class="card-bottom">
                  <div class="button-toggle">
                    <input type="radio" class="accommodation-select" id="accommodation-card-2" value="Quality" <?php if($accom_type=="Quality"){echo 'checked';}?>>
                    <label for="accommodation-card-2"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="max-width: 295px">
              <div class="service-item accommodation-selectfull" style="cursor: pointer;">
                <div class="service-icon">
                  <div id="service-inner">
                    <div class="service-r">
                      <span>5 STAR</span>
                    </div>
                  </div>
                </div>
                <h3>LUXURY</h3>
                <p><?php if(!empty($holidaydetails->luxury))
                { echo $holidaydetails->luxury; } ?>
                </p>
                <div class="card-bottom">
                  <div class="button-toggle">
                    <input type="radio" class="accommodation-select" id="accommodation-card-3" value="Luxury" <?php if($accom_type=="Luxury"){echo 'checked';}?>>
                    <label for="accommodation-card-3"></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Service Section -->
      </div>
    </div>
    <div class="col-sm-3 col-xs-12">
      <div id="booking-flibber" class="col-lg-4 col-md-3 container-booking container-booking-sticky package-booking sticktop" data-spy="affix" data-offset-top="225">
        <div class="booking-form">
          <header class="booking-form-header-summary">
            <div class="price">
              <span id="priceheader"><i class="fa fa-rupee"></i> 0</span>
            </div>
          </header>
          <form id="booking-side-form" method="post" action="<?php echo site_url(); ?>holiday/holiday_package_travellers_details" data-min="0" data-max="0">
            <input type="hidden"  name="holiday_id" id="holiday_id" value="<?php echo $holidaydetails->holiday_id; ?>">
            <input type="hidden"  name="adults_no" id="adults_no" value="1">
            <input type="hidden"  name="childs_no" id="childs_no" value="0">
            <input type="hidden"  name="childswithoutbed_no" id="childswithoutbed_no" value="0">
            <input type="hidden"  name="infants_no" id="infants_no" value="0">
            <input type="hidden"  name="single_no" id="single_no" value="1">
            <input type="hidden"  name="twin_no" id="twin_no" value="0">
            <input type="hidden"  name="triple_no" id="triple_no" value="0">
            <input type="hidden"  name="accom_type" id="accom_type" value="">
            <input type="hidden"  name="room_arr" id="room_arr" value="">
            <input type="hidden"  name="room_counts" id="room_counts" value="">
            <input type="hidden" name="arrival_date" id="arrival_date" value="">
            <input type="hidden" name="depart_date" id="depart_date" value="">
            <input type="hidden" name="total_cost" id="total_cost" value="1">
            <input type="hidden"  name="duration" id="duration" value="<?php echo ($holidaydetails->duration+1); ?>">
            <a  class="booking-find-link"><h4><?php echo $holidaydetails->package_title; ?></h4></a>
            <div class="mobile-hide2">
              <table width="100%">
                <tbody>
                  <tr id="showarrdate" style="display: none;">
                    <td>Arrival date</td>
                    <td><span data-source="date" id="arrival">07-Jan-2017</span></td>
                  </tr>
                  <tr>
                    <td>Duration</td>
                    <td><?php echo ($holidaydetails->duration)." Nights / ".($holidaydetails->duration+1)." Days";?></td>
                  </tr>
                  <tr id="showdepartdate" style="display: none;">
                    <td>Departure date</td>
                    <td><span data-source="date" id="depart">07-Jan-2017</span></td>
                  </tr>
                  <tr id="showaccom" style="display: none;">
                    <td>Accommodation</td>
                    <td><span data-source="accommodation" id="accom"></span></td>
                  </tr>
                </tbody>
              </table>
              <table width="100%" class="calculation" style="display: table;">
                <tbody id="countid" style="display: none;">
                  <tr data-rel="adult2" class="main-row" style="display: table-row;">
                    <td>No of Adults</td>
                    <td><span data-source="adults2" id="ad_count"></span></td>
                  </tr>
                  <tr data-rel="adult2" class="main-row" style="display: table-row;">
                    <td>No of Childs (With bed)</td>
                    <td><span data-source="adults2" id="ch_count"></span></td>
                  </tr>
                   <tr data-rel="adult2" class="main-row" style="display: table-row;">
                    <td>No of Childs (Without bed)</td>
                    <td><span data-source="adults2" id="ch1_count"></span></td>
                  </tr>
                  <tr data-rel="adult2" class="main-row" style="display: table-row;">
                    <td>No of Infants</td>
                    <td><span data-source="adults2" id="in_count"></span></td>
                  </tr>
                  <tr data-rel="adult2" class="main-row" style="display: table-row;">
                    <td>No of Rooms</td>
                    <td><span data-source="adults2" id="rm_count"></span></td>
                  </tr>
                  <!--  <tr data-rel="adult2" class="main-row" style="display: table-row;">
                                        <td>Per Adult(s) (Double):</td>
                                        <td><span data-source="price_adults2" id="ad_price">INR 2058</span></td>
                                        <td><span data-source="adults2" id="ad_count">(x6)</span></td>
                                    </tr>
                                    <tr data-rel="children" class="main-row" style="display: table-row;">
                                        <td>Per Children:</td>
                                        <td><span data-source="price_children">INR 1401</span></td>
                                        <td><span data-source="children">(x1)</span></td>
                  </tr> -->
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr data-rel="total" class="main-row">
                    <td>Subtotal:</td>
                    <td colspan="2" class="booking-form-subtotal"><price data-source="subprice" id="subprice"><i class="fa fa-rupee"></i> 0</price><span></span></td>
                  </tr>
                </tbody>
              </table>
              <button type="submit" name="go_to_travellers" onclick=" return go_to_traveller();" class="button-link green-light button-submit">
              Go to Travellers' details<span class="icon-chevron-right"></span></button>
            </div>
            <br>
          </form>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </section>
</section>
<?php $this->load->view('home/footer');?>
<style type="text/css">
#footerbar{
background: #fff url(<?php echo base_url(); ?>public/images/footerbar.png) no-repeat bottom center;
}
label{
font-weight: normal;
}
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>public/bootstrapdaterangepicker/moment.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/bootstrapdaterangepicker/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/bootstrapdaterangepicker/daterangepicker.css" />
<?php if(!empty($holidaydetails->duration)) /* { ?>
<script type="text/javascript">
$(function() {
var m_names = new Array("Jan", "Feb", "Mar",
"Apr", "May", "Jun", "Jul", "Aug", "Sep",
"Oct", "Nov", "Dec");
var start = new Date();
var curr_date = start.getDate();
var curr_month = start.getMonth();
var curr_year = start.getFullYear();
var end=new Date();
var days=<?php echo ($holidaydetails->duration+1); ?>;
end.setDate(end.getDate() + days);
$('.arr_date').daterangepicker({
"startDate": curr_date+"-"+m_names[curr_month]+"-"+curr_year,
"endDate": end.getDate()+"-"+m_names[end.getMonth()]+"-"+end.getFullYear(),
"opens": "center",
"dateLimit": {"days": days},
"ranges": {  },
"locale": { format: 'DD-MMM-YYYY' },
"minDate": curr_date+"-"+m_names[curr_month]+"-"+curr_year,
"maxDate":'<?php echo date("d-M-Y", strtotime($holidaydetails->end_date));?>'
});
});
</script>
<?php }  */ ?>
<?php
$enddate=date("Y-m-d", strtotime($holidaydetails->end_date));
$dateend=date_create($enddate);
date_sub($dateend,date_interval_create_from_date_string(($holidaydetails->duration+1)." days"));
$start_date=strtotime($holidaydetails->start_date);
$date_end=strtotime(date_format($dateend,"d-M-Y"));
$startdate=date("Y-m-d", $start_date);
$datestart=date_create($startdate);
// $today = strtotime('today UTC');
// $todaydate=date("Y-m-d", $today);
$today = strtotime("+15 days");
$todaydate=date("Y-m-d", $today);
$datetoday=date_create($todaydate);
 if ($start_date < $today && $date_end > $today)
    {
      $mindate=$datetoday;
    }
else if($start_date > $today && $date_end > $today)
    {
      $mindate=$datestart; 
    }
else{
    $mindate=''; 
} 

// echo '123'.date_format($dateend,"d-M-Y");
// echo $date_end;
?>
<script type="text/javascript">
<?php if($mindate!='') { ?>
$(function() {
var m_names = new Array("Jan", "Feb", "Mar",
"Apr", "May", "Jun", "Jul", "Aug", "Sep",
"Oct", "Nov", "Dec");
var d = new Date();
d.setDate(d.getDate() + 15);
var curr_date = d.getDate();
var curr_month = d.getMonth();
var curr_year = d.getFullYear();
$('.arr_date').daterangepicker({
singleDatePicker: true,
showDropdowns: false,
locale: {
format: 'DD-MMM-YYYY'
},
// minDate:curr_date+"-"+m_names[curr_month]+"-"+curr_year,
minDate:'<?php echo date_format($mindate,"d-M-Y");?>',
// maxDate:'<?php echo date("d-M-Y", strtotime($holidaydetails->end_date));?>',
maxDate:'<?php echo date_format($dateend,"d-M-Y");?>',
});
});
<?php } ?>

$(window).scroll(function () {
// distance from top of footer to top of document
footertotop = ($('#contact').position().top);
// distance user has scrolled from top, adjusted to take in height of sidebar (570 pixels inc. padding)
scrolltop = $(document).scrollTop()+570;
// difference between the two
difference = scrolltop-footertotop;
// if user has scrolled further than footer,
// pull sidebar up using a negative margin
if (scrolltop > footertotop) {
$('#booking-flibber').css('margin-top',  0-difference);
}
else  {
$('#booking-flibber').css('margin-top', 0);
}
});
</script>
<!-- PNotify  js-->
<script src="<?php echo base_url(); ?>public/pnotify/pnotify.js"></script>
<script src="<?php echo base_url(); ?>public/pnotify/pnotify.buttons.js"></script>
<script src="<?php echo base_url(); ?>public/pnotify/pnotify.nonblock.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/travellers.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/selecttraveller.js"></script>