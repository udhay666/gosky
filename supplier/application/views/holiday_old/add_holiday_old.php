<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">

<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/nestable/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Add Packages <span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Holidays</a></li>
              <li><a class="active" href="#">Add Holiday</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <span id="validation_error"></span>
    <input type="hidden" id="validation_status">
    <!-- page content -->
    <div class="pagecontent">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <ul class="wizard_steps">
          <li><a href="#step-1" data-toggle="tab"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>Basic Package Info</small></span></a></li>
          <li><a href="#step-2" data-toggle="tab"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Overview/Highlights</small></span></a></li>
          <li><a href="#step-3" data-toggle="tab"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Itinerary</small></span></a></li>
          <li><a href="#step-4" data-toggle="tab"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Includes/Excludes</small></span></a></li>
          <li><a href="#step-5" data-toggle="tab"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Important Info</small></span></a></li>
          <li><a href="#step-6" data-toggle="tab"><span class="step_no wizard-step">6</span><span class="step_descr">Step 6<br><small>Routing(Map)</small></span></a></li>
          <li><a href="#step-7" data-toggle="tab"><span class="step_no wizard-step">7</span><span class="step_descr">Step 7<br><small>Activities(Optional)</small></span></a></li>
          <li><a href="#step-8" data-toggle="tab"><span class="step_no wizard-step">8</span><span class="step_descr">Step 8<br><small>Attraction(Optional)</small></span></a></li>
          <li><a href="#step-9" data-toggle="tab"><span class="step_no wizard-step">9</span><span class="step_descr">Step 9<br><small>Images(Preview &amp; Save)</small></span></a></li>
          <!-- <li><a href="#tab1" data-toggle="tab">Personal Information <span class="badge badge-default pull-right wizard-step">1</span></a></li>
          <li><a href="#tab2" data-toggle="tab">Address<span class="badge badge-default pull-right wizard-step">2</span></a></li>-->
        </ul>
        <input type="hidden" name="insert_id" id="insert_id" value="">
        <div class="tab-content">
          <div class="tab-pane" id="step-1">
            <form class="step_form step1" steps="1" name="step1" role="form">
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Holiday Type :</label>
                  <div class="check_icon">
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="holiday_type" value="Private" checked><i></i> Private</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="holiday_type" value="Scheduled"><i></i> Scheduled(SIC)</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="holiday_type" value="Bespoke"><i></i> Bespoke</label>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="holiday_name">Holiday Name : </label>
                  <input name="holiday_name" id="holiday_name" type="text" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="holiday_code">Holiday Id : </label>
                  <input type="text" name="holiday_code" id="holiday_code" class="form-control" required>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-8">
                  <label class="strong">Theme : </label>
                  <ul class="check_width check_icon">
                    <?php if($theme) foreach($theme as $th) { ?>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value="<?php echo $th->theme_id;?>" checked="checked"><i></i> <?php echo $th->theme_name;?></label></li>
                    <?php } ?>
                  </ul>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="short_desc">Short Description : </label>
                  <textarea name="short_desc" id="short_desc" class="form-control" rows="5"></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-5">
                  <label class="strong">Accommodation Type : </label>
                  <ul class="check_width check_icon">
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="Economy(3.5)" checked="checked"><i></i> Economy(3.5)</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="Superior(4)" checked="checked"><i></i> Superior(4)</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="First class(5)" checked="checked"><i></i> First class(5)</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="Luxury(5+)" checked="checked"><i></i> Luxury(5+)</label></li>
                    <!-- <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="5" checked="checked"><i></i> 5 Star</label></li> -->
                  </ul>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Star Rating : </label>
                  <div class="starrr stars" style="display: block;"></div>
                  <input type="hidden" name="star_rating" value="" class="stars_input">
                  <span class="stars-count">0</span> Star(s)
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Physical Rating : </label>
                  <div class="starrr stars" style="display: block;"></div>
                  <input type="hidden" name="physical_rating" value="" class="stars_input">
                  <span class="stars-count">0</span> Star(s)
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-2">
                  <label class="strong" for="minChildAge">Min Child Age : </label>
                  <select name="minChildAge" id="minChildAge" class="form-control">
                    <?php for($i=0;$i<11;$i++){ ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="maxChildAge">Max Child Age : </label>
                  <select name="maxChildAge" id="maxChildAge" class="form-control">
                    <?php for($i=0;$i<20;$i++){ ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="minPaxOperating">Min Pax Operating : </label>
                  <select name="minPaxOperating" id="minPaxOperating" class="form-control">
                    <?php for($i=0;$i<20;$i++){ ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="maxPaxOperating">Max Pax Operating : </label>
                  <select name="maxPaxOperating" id="maxPaxOperating" class="form-control">
                    <?php for($i=0;$i<20;$i++){ ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong">Infant Allowed : </label>
                  <div class="check_icon">
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="infant_allowed" value="Yes" checked="checked"><i></i> YES</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="infant_allowed" value="No"><i></i> NO</label>
                  </div>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12 check_icon">
                  <label class="strong">Days of Operation : </label><br>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Monday" checked="checked"><i></i> Monday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Tuesday" checked="checked"><i></i> Tuesday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Wednesday" checked="checked"><i></i> Wednesday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Thursday" checked="checked"><i></i> Thursday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Friday" checked="checked"><i></i> Friday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Saturday" checked="checked"><i></i> Saturday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Sunday" checked="checked"><i></i> Sunday</label>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <div id="add_dates">
                    <div class="add_remove">
                      <label class="strong">Departure Date:</label>&nbsp;&nbsp;&nbsp;<i class="fa fa-plus btn btn-success btn-xs add-field"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-times btn btn-danger btn-xs remove-field"></i>
                    </div>
                    <div id="add_dates_wrapper" style="overflow:auto">
                      <div class="repeat-field" id="day_d1">
                        <input type="text" name="departure_date[]" class="date_range form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <div id="add_dates2">
                    <div class="add_remove">
                      <label class="strong">Day Closed:</label>&nbsp;&nbsp;&nbsp;<i class="fa fa-plus btn btn-success btn-xs add-field"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-times btn btn-danger btn-xs remove-field"></i>
                    </div>
                    <div id="add_dates_wrapper2" style="overflow:auto">
                      <div class="repeat-field" id="day_c1">
                        <input type="text" name="closed_dates[]" class="date_range form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="form-group col-md-4">
                  <label class="strong" for="departure_date">Departure Date : </label>
                  <input type="text" name="departure_date[]" id="departure_date" class="date_range form-control">
                </div> -->
                <div class="form-group col-md-4">
                  <label class="strong" for="city_covering">Cities/Towns Covering : </label><br>
                  <select name="city_covering[]" id="city_covering" class="select2_multiple form-control" multiple="multiple" required="">
                    <?php foreach($holiday_city as $city){ ?>
                    <option value="<?php echo $city->city_id ?>"><?php echo $city->city_name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="pp_price">Per Person Price : </label><br>
                  <input type="text" name="pp_price" id="pp_price" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="pick_up">Pick Up Point : </label><br>
                  <select name="pick_up[]" id="pick_up" class="select2_multiple form-control" multiple="multiple">
                    <?php foreach($holiday_city as $city){ ?>
                    <option value="<?php echo $city->city_id ?>"><?php echo $city->city_name ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="drop_off">Drop Off Point : </label><br>
                  <select name="drop_off[]" id="drop_off" class="select2_multiple form-control" multiple="multiple">
                    <?php foreach($holiday_city as $city){ ?>
                    <option value="<?php echo $city->city_id ?>"><?php echo $city->city_name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="operated_by">Operated By : </label>
                  <input type="text" name="operated_by" id="operated_by" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="operator_no">Operator Contact No : </label>
                  <input type="text" name="operator_no" id="operator_no" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="emergency_no">Emergency Contact No : </label>
                  <input type="text" name="emergency_no" id="emergency_no" class="form-control">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="resevatoin_no">Reservation Contact No : </label>
                  <input type="text" name="resevatoin_no" id="resevatoin_no" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="product_manager">Product Manager Contact No: </label>
                  <input type="text" name="product_manager" id="product_manager" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="duration">Holiday Duration : </label>
                  <select name="duration" id="duration" class="form-control">
                    <option value="2">2 Days / 1 Night</option>
                    <?php for($d=3;$d<32;$d++) { ?>
                    <option value="<?php echo $d ?>"><?php echo $d ?> Days / <?php echo $d-1 ?> Nights</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane" id="step-2">
            <form name="step2" class="step_form step2" steps="2" method="POST" role="form" enctype="multipart/form-data" data-parsley-validate>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Overview</label>
                  <textarea name="overview" class="form-control ckeditor" rows="3" cols="100" required></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Highlights</label>
                  <textarea name="highlights" class="form-control ckeditor" rows="3" cols="100" required></textarea>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane" id="step-3">
            <form class="step_form step3" steps="3" name="step3" method="POST" enctype="multipart/form-data" role="form" novalidate>
              <div id="itinerary_wrapper">
                <div class="add_remove text-right mb-5">
                  <a class="btn btn-success add-field fa fa-plus"> Add</a>
                  <a class="btn btn-danger remove-field fa fa-times"> Remove</a>
                </div>
                <div id="itinerary_field_wrapper">
                  <section class="boxs repeat-field" id="itinerary_1">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font">Day <span class="day_count">1</span></h1>
                      <ul class="controls custom_cntrl">
                        <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
                      </ul>
                    </div>
                    <div class="boxs-body">
                      <input type="hidden" name="day_count" id="day_count" value="1">
                      <div class="row border_row">
                        <div class="form-group col-sm-6 check_icon itinerary_destination_1">
                          <label class="strong">Destination:</label><br>
                          <div id="destination"></div>
                        </div>
                        <div class="form-group col-sm-6 check_icon itinerary_meals_1">
                          <label class="strong">Meals</label><br>
                          <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="itinerary_meals_1[]" class="flat" value="B" checked="checked"><i></i> Breakfast</label>
                          <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="itinerary_meals_1[]" class="flat" value="L" checked="checked"><i></i> Lunch</label>
                          <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="itinerary_meals_1[]" class="flat" value="D" checked="checked"><i></i> Dinner</label>
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-12">
                          <label class="strong">Description</label>
                          <textarea name="itinerary_description[]" id="itinerary_description" class="form-control ckeditor" rows="3" cols="100"></textarea>
                        </div>
                      </div>
                      <!-- <div class="row border_row min_height200">
                        <div class="col-md-12">
                          <label><strong>Gallery Image</strong></label><br>
                          <div class="messages2"></div>
                          <span class="btn btn-success fileinput-button">
                              <i class="glyphicon glyphicon-plus"></i>
                              <span>Add Multiple image...</span>
                              <input type="file" multiple="multiple" accept="image/*" class="form-control imageupload" name="uploadfile[]" /><br/>
                          </span>
                          <input type="hidden" name="id" class="package_id">
                          <input type="hidden" name="id_column" value="package_id">
                          <input type="hidden" name="table_name" value="holiday_itinerary_images">
                          <input type="hidden" name="column_name" value="gallery_img">
                          <input type="hidden" name="img_type" value="gallery">
                          <input type="hidden" name="upload_type" value="insert">
                          <input name="submit" value="Upload" class="btn btn-primary upload_now" />
                          <div class="row2 preview-image"></div>
                        </div>
                      </div> -->
                    </div>
                  </section>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane" id="step-4">
            <form class="step_form step4" steps="4" name="step4" role="form" enctype="multipart/form-data" novalidate>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="pkg_combined">Can be Combined with : </label><br>
                  <select name="pkg_combined[]" id="pkg_combined" class="select2_multiple form-control" multiple="multiple">
                    <?php foreach($holiday_packages as $pkg){ ?>
                    <option value="<?php echo $pkg->id ?>"><?php echo $pkg->holiday_name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Includes</label>
                  <textarea name="includes" class="form-control ckeditor" rows="3" cols="100"></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Excludes</label>
                  <textarea name="excludes" class="form-control ckeditor" rows="3" cols="100"></textarea>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane" id="step-5">
            <form class="step_form step5" steps="5" name="step5" role="form" enctype="multipart/form-data" data-parsley-validate>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Cancellation Policy</label>
                  <textarea name="cancellation_policy" class="form-control ckeditor" rows="3" cols="100"></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Child Policy</label>
                  <textarea name="child_policy" class="form-control ckeditor" rows="3" cols="100"></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Pet Policy</label>
                  <textarea name="pet_policy" class="form-control ckeditor" rows="3" cols="100"></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-6">
                  <label class="strong">Voltage</label>
                  <select name="voltage" class="form-control">
                    <option value="100V">100V</option>
                    <option value="250V">250V</option>
                  </select>
                </div>
                <div class="form-group col-sm-6">
                  <label class="strong">Currency</label>
                  <select name="currency" class="form-control">
                    <option value="Dollar">Dollar</option>
                    <option value="Euro">Euro</option>
                    <option value="Rupee">Rupee</option>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Passport/Visa</label>
                  <textarea name="passport_visa" class="form-control ckeditor" rows="3" cols="100"></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Medical Health</label>
                  <textarea name="medical_health" class="form-control ckeditor" rows="3" cols="100"></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Travel Insurance</label>
                  <textarea name="travel_insurance" class="form-control ckeditor" rows="3" cols="100"></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Weather</label>
                  <textarea name="weather" class="form-control ckeditor" rows="3" cols="100"></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Food and Dietary Requirements</label>
                  <textarea name="food_requirement" class="form-control ckeditor" rows="3" cols="100"></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Safety</label>
                  <textarea name="safety" class="form-control ckeditor" rows="3" cols="100"></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Clothing</label>
                  <textarea name="clothing" class="form-control ckeditor" rows="3" cols="100"></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Accommodation</label>
                  <textarea name="accomodation" class="form-control ckeditor" rows="3" cols="100"></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Insurance</label>
                  <textarea name="insurance" class="form-control ckeditor" rows="3" cols="100"></textarea>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane" id="step-6">
            <form class="step_form step6" steps="6" name="step6" role="form" enctype="multipart/form-data" novalidate>
              <div class="row">
                <div class="col-md-12">
                  <section class="boxs">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font">Sorting Location <small>(Drag and drop to the desired places)</small></h1>
                      <ul class="controls">
                        <li><a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span></a></li>
                      </ul>
                    </div>
                    <div class="boxs-body">
                      <!-- <ol class="col-sm-1 dd-list2 day_sl">
                        <li class="dd-item"><span>Day 1</span></li>
                      </ol> -->
                      <div class="row dd nestable-tree" id="nestable">
                        <ol id="transport" class="col-sm-5 dd-list"></ol>
                      </div>
                      <br/>
                      <div id="output"></div>
                    </div>
                  </section>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane" id="step-7">
            <form class="step_form step7" steps="7" name="step7" method="POST" enctype="multipart/form-data" role="form" novalidate>
              <div id="activity_wrapper">
                <div class="add_remove text-right mb-5">
                  <a class="btn btn-success add-field fa fa-plus"> Add</a>
                  <a class="btn btn-danger remove-field fa fa-times"> Remove</a>
                </div>
                <div id="activity_field_wrapper">
                  <section class="boxs repeat-field" id="activity_1">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font">Activity <span class="activity_count">1</span></h1>
                      <ul class="controls custom_cntrl">
                        <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
                      </ul>
                    </div>
                    <div class="boxs-body">
                      <input type="hidden" name="day_count" id="day_count" value="1">
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Activity Name</label>
                          <input type="text" name="activity_name[]" class="form-control">
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-12">
                          <label class="strong">Description</label>
                          <textarea name="activity_description[]" id="activity_description" class="form-control ckeditor" rows="3" cols="100"></textarea>
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Adult Cost</label>
                          <input type="text" name="activity_adult_cost[]" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Child Cost(Below 12 years)</label>
                          <input type="text" name="activity_child_cost[]" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Family Cost(2 Adults + 2 Children)</label>
                          <input type="text" name="activity_family_cost[]" class="form-control">
                        </div>
                      </div>
                      <div class="row border_row min_height200">
                        <div class="col-md-12">
                          <label><strong>Gallery Image</strong></label><br>
                          <div class="messages2"></div>
                          <span class="btn btn-success fileinput-button">
                              <i class="glyphicon glyphicon-plus"></i>
                              <span>Add Multiple image...</span>
                              <input type="file" multiple="multiple" accept="image/*" class="form-control imageupload" name="uploadfile[]" /><br/>
                          </span>
                          <input type="hidden" name="id" class="package_id">
                          <input type="hidden" name="id_column" value="package_id">
                          <input type="hidden" name="table_name" value="holiday_activity_images">
                          <input type="hidden" name="column_name" value="gallery_img">
                          <input type="hidden" name="img_type" value="gallery">
                          <input type="hidden" name="upload_type" value="insert">
                          <input name="submit" value="Upload" class="btn btn-primary upload_now" />
                          <div class="row2 preview-image"></div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane" id="step-8">
            <form class="step_form step8" steps="8" name="step8" method="POST" enctype="multipart/form-data" role="form" novalidate>
              <div id="attraction_wrapper">
                <div class="add_remove text-right mb-5">
                  <a class="btn btn-success add-field fa fa-plus"> Add</a>
                  <a class="btn btn-danger remove-field fa fa-times"> Remove</a>
                </div>
                <div id="attraction_field_wrapper">
                  <section class="boxs repeat-field" id="attraction_1">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font">Attraction <span class="attraction_count">1</span></h1>
                      <ul class="controls custom_cntrl">
                        <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
                      </ul>
                    </div>
                    <div class="boxs-body">
                      <input type="hidden" name="day_count" id="day_count" value="1">
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Attraction Name</label>
                          <input type="text" name="attraction_name[]" class="form-control">
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-12">
                          <label class="strong">Description</label>
                          <textarea name="attraction_description[]" id="attraction_description" class="form-control ckeditor" rows="3" cols="100"></textarea>
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Adult Cost</label>
                          <input type="text" name="attraction_adult_cost[]" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Child Cost(Below 12 years)</label>
                          <input type="text" name="attraction_child_cost[]" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Family Cost(2 Adults + 2 Children)</label>
                          <input type="text" name="attraction_family_cost[]" class="form-control">
                        </div>
                      </div>
                      <div class="row border_row min_height200">
                        <div class="col-md-12">
                          <label><strong>Gallery Image</strong></label><br>
                          <div class="messages2"></div>
                          <span class="btn btn-success fileinput-button">
                              <i class="glyphicon glyphicon-plus"></i>
                              <span>Add Multiple image...</span>
                              <input type="file" multiple="multiple" accept="image/*" class="form-control imageupload" name="uploadfile[]" /><br/>
                          </span>
                          <input type="hidden" name="id" class="package_id">
                          <input type="hidden" name="id_column" value="package_id">
                          <input type="hidden" name="table_name" value="holiday_attraction_images">
                          <input type="hidden" name="column_name" value="gallery_img">
                          <input type="hidden" name="img_type" value="gallery">
                          <input type="hidden" name="upload_type" value="insert">
                          <input name="submit" value="Upload" class="btn btn-primary upload_now" />
                          <div class="row2 preview-image"></div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane" id="step-9">
            <div class="row border_row min_height200">
              <div class="col-md-12">
                <?php echo form_open_multipart('upload/do_upload', array('class' => 'upload-image-form'));?>
                <label><strong>Thumbnail Image</strong></label><br>
                <div class="messages"></div>
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add image...</span>
                    <input type="file" accept="image/*" class="form-control imageupload" name="uploadfile[]" size="20" /><br/>
                </span>
                <input type="hidden" name="controller" value="holiday">
                <input type="hidden" name="id" class="package_id">
                <input type="hidden" name="id_column" value="id">
                <input type="hidden" name="table_name" value="holiday_packages">
                <input type="hidden" name="column_name" value="thumb_img">
                <input type="hidden" name="img_type" value="thumbnail">
                <input type="hidden" name="upload_type" value="update">
                <input type="submit" name="submit" value="Upload" class="btn btn-primary" />
                <div class="row2 preview-image"></div>
                <?php echo '</form>' ?>
              </div>
            </div>
            <div class="row border_row min_height200">
              <div class="col-md-12">
                <label><strong>Gallery Image</strong></label><br>
                <div class="messages2"></div>
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add Multiple image...</span>
                    <input type="file" multiple="multiple" accept="image/*" class="form-control imageupload" name="uploadfile[]" /><br/>
                </span>
                <input type="hidden" name="controller" value="holiday">
                <input type="hidden" name="id" class="package_id">
                <input type="hidden" name="id_column" value="package_id">
                <input type="hidden" name="table_name" value="holiday_package_images">
                <input type="hidden" name="column_name" value="gallery_img">
                <input type="hidden" name="img_type" value="gallery">
                <input type="hidden" name="upload_type" value="insert">
                <input type="submit" name="submit" value="Upload" class="btn btn-primary upload_now" />
                <div class="row2 preview-image"></div>
              </div>
            </div>
            <a id="previewid" href="#" target="_blank" class="fa fa-eye btn btn-default"> Preview</a>
          </div>
          <ul class="pager wizard">
            <li class="previous">
              <button class="btn btn-default">Previous</button>
            </li>
            <li class="next">
              <button class="btn btn-default">Next</button>
            </li>
            <li class="next finish" style="display:none;">
              <a href="<?php echo site_url() ?>holiday/holiday_list" class="btn btn-success">Finish</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- sctipts -->
  <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>

  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/wysihtml5-0.3.0.min.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/bootstrap-wysihtml5.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/adapters/jquery.js"></script>
  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript">
jQuery(function($) {
  var cloneCount = 2;
  $("#add_dates").each(function() {
    var $wrapper = $('#add_dates_wrapper', this);
    $(".add-field", $(this)).click(function(){
      var clone = $('#day_d1:first-child', $wrapper).clone(true).attr('id', 'day_d1'+ cloneCount++).insertAfter($('[id^=day_d1]:last'));
      // clone.find('input').val('').focus();
      clone.find(".date_range").each(function() {
        $(this).attr("id", "").removeData().off();
        $(this).find('.add-on').removeData().off();
        $(this).find('input').removeData().off();
        $(this).daterangepicker({
          autoApply: true,
          stepMonths: false,
          timePickerIncrement: 30,
          locale: {
              format: 'DD/MM/YYYY'
          }
        });
      });
      $('#add_dates_wrapper').css('height','100px');
      $('.repeat-field').css('margin-bottom','5px');
    });
    $('.remove-field', $(this)).click(function() {
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#day_d1'+cloneCount).remove();
      } else{
        return false;
      }
      if ($(this).parent().parent().find('.repeat-field').length < 3){
        $('#add_dates_wrapper').css('height','initial');
        $('.repeat-field').css('margin-bottom','3px');
      }
    });
  });
});

jQuery(function($) {
  var cloneCount = 2;
  $("#add_dates2").each(function() {
    var $wrapper = $('#add_dates_wrapper2', this);
    $(".add-field", $(this)).click(function(){
      var clone = $('#day_c1:first-child', $wrapper).clone(true).attr('id', 'day_c1'+ cloneCount++).insertAfter($('[id^=day_c1]:last'));
      // clone.find('input').val('').focus();
      clone.find(".date_range").each(function() {
        $(this).attr("id", "").removeData().off();
        $(this).find('.add-on').removeData().off();
        $(this).find('input').removeData().off();
        $(this).daterangepicker({
          autoApply: true,
          stepMonths: false,
          timePickerIncrement: 30,
          locale: {
              format: 'DD/MM/YYYY'
          }
        });
      });
      $('#add_dates_wrapper2').css('height','100px');
      $('.repeat-field').css('margin-bottom','5px');
    });
    $('.remove-field', $(this)).click(function() {
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#day_c1'+cloneCount).remove();
      } else{
        return false;
      }
      if ($(this).parent().parent().find('.repeat-field').length < 3){
        $('#add_dates_wrapper2').css('height','initial');
        $('.repeat-field').css('margin-bottom','3px');
      }
    });
  });
});
</script>
<script type="text/javascript"> 
  $(function() {
    var dateToday = new Date();
    $('.date_range').daterangepicker({
      //timePicker: true,
      minDate: dateToday,
      autoApply: true,
      stepMonths: false,
      timePickerIncrement: 30,
      locale: {
          format: 'DD/MM/YYYY'
      }
    });
  });
</script>
<script>
  $(document).ready(function() {
    $(".select2_multiple").select2({
      // maximumSelectionLength: 4,
      // placeholder: "With Max Selection limit 4",
      allowClear: true
    });
  });
</script>
<script>
  $(document).ready(function() {
    $(".stars").starrr();
    // $('.stars-existing').starrr({
    //   rating: 4
    // });
    $('.stars').on('starrr:change', function (e, value) {
      $(this).parent().find('.stars-count').html(value);
    });
    $('.stars').on('starrr:change', function (e, value) {
      $(this).parent().find('.stars_input').val(value);
    });
  });
</script>

<!--  Page Specific Scripts  --> 
<script type="text/javascript">
// $(window).load(function(){
  $('#rootwizard').bootstrapWizard({
    onTabShow: function(tab, navigation, index) {
      var $total = navigation.find('li').length;
      var $current = index+1;
      // If it's the last tab then hide the last button and show the finish instead
      if($current >= $total) {
          $('#rootwizard').find('.pager .next').hide();
          $('#rootwizard').find('.pager .finish').show();
          $('#rootwizard').find('.pager .finish').removeClass('disabled');
      } else {
          $('#rootwizard').find('.pager .next').show();
          $('#rootwizard').find('.pager .finish').hide();
      }
      CKEDITOR.instances[name];
    },
    onNext: function(tab, navigation, index) {
      var form = $('form[name="step'+ index +'"]');
      var steps = 'step'+index;
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } else {
        save_holiday(form,steps);
        CKEDITOR.instances[name];
        $("body,html").animate({
            scrollTop : 0
        }, 800);
        $vs = $('#validation_status').val();
        // alert($vs)
        if ($vs == 'true') {
            return false;
        }
      }
    },

    onTabClick: function(tab, navigation, index,currentIndex) {
      var form = $('form[name="step'+ (index+1) +'"]');
      var steps = 'step'+(index+1);
      var overview = CKEDITOR.instances['overview'].getData().replace(/<[^>]*>/gi, '').length;
      var highlights = CKEDITOR.instances['highlights'].getData().replace(/<[^>]*>/gi, '').length;
      var cancellation_policy = CKEDITOR.instances['cancellation_policy'].getData().replace(/<[^>]*>/gi, '').length;
      // alert(currentIndex);
      // alert(index);
      if((highlights == 0 || overview == 0) && currentIndex>1) {
          if(index==0){
            alert( 'Step 2 required' );
          } else if(overview == 0) {
            alert( 'Overview required' );
          } else if(highlights == 0) {
            alert( 'Highlights required' );
          }
          return false;
      }
      if(cancellation_policy == 0 && currentIndex>4) {
        if(index<4){
          alert( 'Step 5 required' );
        } else if(cancellation_policy == 0) {
          alert( 'Cancellation Policy required' );
        }
        return false;
      }
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } else{
        save_holiday(form,steps);
        CKEDITOR.instances[name];
        $vs = $('#validation_status').val();
        if ($vs == 'true') {
            return false;
        }
      }
    }
  });
// });
$('.next .btn, .previous .btn').on('click', function(e){
  CKEDITOR.instances[name];
});
function save_holiday(form,steps){
  // $('.next .btn').on('click', function(e){
    // e.preventDefault();
    // var _parent = $(this).parent().parent().parent().find('.tab-pane.active').find('.step_form');
    // var _steps = $(_parent).attr('steps');
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
    $ins_id = $("#insert_id").val();
    // alert(steps)
    // if(steps == 9){
      $href = '<?php echo str_replace('admin/', '', site_url()) ?>'+'holiday/holidaydetails/'+$ins_id;
      $('#previewid').attr('href', $href);
    // }
    
    // alert(_steps);
    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>holiday/save_holiday_'+steps+'/'+$ins_id,
      // data: $(_parent).serialize(),
      data: form.serialize(),
      dataType: 'json',
      success: function(data) {
        $("#insert_id").val(data.insert_id);
        $(".package_id").val(data.insert_id);
        $("#destination").html(data.destination);
        $("#transport").html(data.transport);
        $("#output").html(data.transport_output);
        $("#validation_error").html(data.validation_error);
        $("#validation_status").html(data.validation_status);
        $(".package_id").val(data.insert_id);
      }
    });
  // });
}
</script>
<script type="text/javascript">
jQuery(function($) {
  var cloneCount = 2;
  $("#itinerary_wrapper").each(function() {
    // e.preventDefault();
    var $wrapper = $('#itinerary_field_wrapper', this);
    $(".add-field", $(this)).click(function(e){
      // $('#itinerary_1').clone(true).attr('itinerary_1', 'repeat_1'+ cloneCount++).insertAfter($('[id^=itinerary_1]:last')).find('.day_count').html((cloneCount-1));
      var clone = $('#itinerary_1:first').clone(true).attr('id', 'itinerary_1'+ cloneCount++).insertAfter($('[id^=itinerary_1]:last'));

      clone.find('textarea').val('');
      clone.find('.day_count').html((cloneCount-1));
      clone.find('.preview-image img').remove();
      clone.find('.messages2 .alert').remove();
      clone.find('#day_count').val((cloneCount-1));
      clone.find('textarea.ckeditor').attr('id', 'itinerary_description'+(cloneCount-1));

      var editor = CKEDITOR.instances[name];
      if (editor) { editor.destroy(true); }
      CKEDITOR.replace('itinerary_description'+(cloneCount-1));

      $(this).parent().parent().find('#itinerary_1'+(cloneCount-1)).find('#cke_itinerary_description').css('display', 'none');

      clone.find('.itinerary_destination_1').find('.checkbox-custom2').find('input').attr('name', 'itinerary_destination_'+(cloneCount-1)+'[]');
      clone.find('.itinerary_meals_1').find('.checkbox-custom2').find('input').attr('name', 'itinerary_meals_'+(cloneCount-1)+'[]');
      // $( 'textarea.ckeditor' ).ckeditor();


    });
    $('.remove-field', $(this)).click(function(e) {
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#itinerary_1'+cloneCount).remove();
      }
    });
  }); 
});
jQuery(function($) {
  var cloneCount = 2;
  $("#activity_wrapper").each(function() {
    var $wrapper = $('#activity_field_wrapper', this);
    $(".add-field", $(this)).click(function(){
      var clone = $('#activity_1:first-child', $wrapper).clone(true).attr('id', 'activity_1'+ cloneCount++).insertAfter($('[id^=activity_1]:last'));

      clone.find('textarea').val('');
      clone.find('.preview-image img').remove();
      clone.find('.messages2 .alert').remove();
      clone.find('#day_count').val((cloneCount-1));
      clone.find('.activity_count').html((cloneCount-1));
      clone.find('textarea.ckeditor').attr('id', 'activity_description'+(cloneCount-1));

      var editor = CKEDITOR.instances[name];
      if (editor) { editor.destroy(true); }
      CKEDITOR.replace('activity_description'+(cloneCount-1));
      $(this).parent().parent().find('#activity_1'+(cloneCount-1)).find('#cke_activity_description').css('display', 'none');
    });
    $('.remove-field', $(this)).click(function() {
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#activity_1'+cloneCount).remove();
      }
    });
  });
});
jQuery(function($) {
  var cloneCount = 2;
  $("#attraction_wrapper").each(function() {
    var $wrapper = $('#attraction_field_wrapper', this);
    $(".add-field", $(this)).click(function(){
      var clone = $('#attraction_1:first-child', $wrapper).clone(true).attr('id', 'attraction_1'+ cloneCount++).insertAfter($('[id^=attraction_1]:last'));

      clone.find('textarea').val('');
      clone.find('.preview-image img').remove();
      clone.find('.messages2 .alert').remove();
      clone.find('#day_count').val((cloneCount-1));
      clone.find('.attraction_count').html((cloneCount-1));
      clone.find('textarea.ckeditor').attr('id', 'attraction_description'+(cloneCount-1));

      var editor = CKEDITOR.instances[name];
      if (editor) { editor.destroy(true); }
      CKEDITOR.replace('attraction_description'+(cloneCount-1));
      $(this).parent().parent().find('#attraction_1'+(cloneCount-1)).find('#cke_attraction_description').css('display', 'none');
    });
    $('.remove-field', $(this)).click(function() {
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#attraction_1'+cloneCount).remove();
      }
    });
  }); 
});
</script>

<!-- Required for images upload -->
<script type = "text/javascript" src = "//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script>
<script type="text/javascript">
if (window.File && window.FileList && window.FileReader) {
  $(".imageupload").on('change', function () {
       var countFiles = $(this)[0].files.length;
       var imgPath = $(this)[0].value;
       var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
       var image_holder = $(this).parent().parent().find(".preview-image");
       image_holder.empty();

      var files = !!this.files ? this.files : [];
      if (!files.length || !window.FileReader) return false; // no file selected, or no FileReader support

       if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
           if (typeof (FileReader) != "undefined") {
   
               for (var i = 0; i < countFiles; i++) {
   
                   var reader = new FileReader();
                   reader.onload = function (e) {
                      var file = e.target;
                      // $('<div class="priv_div" style="position:relative;display:inline-block"><img src="'+e.target.result+'" title="'+file.name+'" class="thumbimage" /><i class="fa fa-close delete_img"></i></div>').appendTo(image_holder);
                      // $(".delete_img").click(function(){
                      //   countFiles -= 1;
                      //   $(this).parent(".priv_div").remove();
                      //   $('.imageupload').val(countFiles);
                      // });
                       $("<img />", { "src": e.target.result, "class": "thumbimage" }).appendTo(image_holder);
                   }
   
                   image_holder.show();
                   reader.readAsDataURL($(this)[0].files[i]);
               }
   
           } else {
               alert("It doesn't supports");
           }
       } else {
           alert("Select Only images");
       }
  });
} else {
  alert("Your browser doesn't support to File API")
}
</script>
<script>
jQuery(document).ready(function($) {
    var options = {
        beforeSend: function(){
            // Replace this with your loading gif image
            // alert(this);
            $(".messages").html('<p><img src = "<?php echo base_url() ?>public/images/load.gif" class = "loader" /></p>');
        },
        complete: function(response){
            // Output AJAX response to the div container
            $(".messages").html(response.responseText);
            $('html, body').animate({scrollTop: $(".messages").offset().top-100}, 150);
            
        }
    };  
    // Submit the form
    $(".upload-image-form").ajaxForm(options);  
    return false; 
});
</script>

<script>
$('.upload_now').on('click', function(){
    var _parent = $(this).parent();
    var day_count = $(this).parent().parent().parent().find('#day_count').val();
    var id = _parent.find('input[name="id"]').val();
    var id_column = _parent.find('input[name="id_column"]').val();
    var table_name = _parent.find('input[name="table_name"]').val();
    var column_name = _parent.find('input[name="column_name"]').val();
    var img_type = _parent.find('input[name="img_type"]').val();
    var upload_type = _parent.find('input[name="upload_type"]').val();
    var edit = _parent.find('input[name="edit"]').val();

    var files = _parent.find('.imageupload').prop('files');
    var data = new FormData();
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        data.append('uploadfile[]', file, file.name);
    }
    data.append('controller', 'holiday');
    data.append('id', id);
    data.append('id_column', id_column);
    data.append('table_name', table_name);
    data.append('column_name', column_name);
    data.append('img_type', img_type);
    data.append('upload_type', upload_type);
    if(table_name == 'holiday_package_images'){
      data.append('day_count', '');
    } else{
      data.append('day_count', day_count);
    }

    $.ajax({
        type: 'POST',               
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: data,
        url: '<?php echo site_url(); ?>upload/do_upload',
        dataType : 'json',
        beforeSend: function(){
          _parent.find(".messages2").html('<p><img src = "<?php echo base_url() ?>public/images/load.gif" class = "loader" /></p>');
        },
        complete: function(response){
            _parent.find(".messages2").html(response.responseText);
            $('html, body').animate({scrollTop: _parent.find(".messages2").offset().top-100}, 150);
            // document.location.reload();
        }
    }); 
});

$(".delete_img").on('click',function(e){
  var _parent = $(this).parent().parent().parent();
  var table_name = _parent.find('input[name="table_name"]').val();
  e.preventDefault();
  var img_id = $(this).parent('.priv_div').attr('img_id');
  if (confirm('You are about to delete on saved image... Are you sure?')) {
    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>upload/delete_img',
      data: 'img_id='+img_id+'&table_name='+table_name,
      dataType: 'json',
      beforeSend: function(){
        _parent.find(".messages2").html('<p><img src = "<?php echo base_url() ?>public/images/load.gif" class = "loader" /></p>');
      },
      error: function(){
        _parent.find(".messages2").html('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>');
        document.location.reload();
      },
      complete: function(response){
        _parent.find(".messages2").html('<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>File Deleted Successfully.</div>');
            $('html, body').animate({scrollTop: _parent.find(".messages2").offset().top-100}, 150);
        document.location.reload();
      }
    });
  } else {
      return false;
  }
});
</script>

<script src="<?php echo base_url(); ?>public/js/vendor/nestable/jquery.nestable.js"></script> 
<script type="text/javascript">
$(window).load(function(){
  var updateOutput = function(e) {
    var list = e.length ? e : $(e.target), output = list.data('output');
    // if (window.JSON) {
    //   output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
    // } else {
    //   output.val('JSON browser support required.');
    // }
    $.ajax({
      method: "POST",
      url: "<?php echo site_url() ?>holiday/order_location",
      data: {list: list.nestable('serialize')},
      dataType: 'json',
      success: function(data) {
        // console.log(data.insert_id);
        $("#output").html(data.location);
      }
    }).fail(function(jqXHR, textStatus, errorThrown){
        alert("Unable to save new list order: " + errorThrown);
    });
  };

  // activate Nestable for list 1
  $('#nestable').nestable({
    group: 1
  }).on('change', updateOutput);

  // output initial serialised data
  // updateOutput($('#nestable').data('output', $('#nestable-output')));
  // updateOutput($('#nestable').data('output', $('#output')));
});
</script> 
