<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">

<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit Packages <span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Holidays</a></li>
              <li><a class="active" href="#">Edit Holiday</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <?php 
    $sess_msg = $this->session->flashdata('message');
    if(!empty($sess_msg)){
      $message = $sess_msg;
      $class = 'success';
    } else {
      $message = $error;
      $class = 'danger';
    }
    ?>
    <?php if($message){ ?>
    <br>
    <div class="alert alert-<?php echo $class ?>">
      <button class="close" data-dismiss="alert" type="button">×</button>
      <strong><?php echo ucfirst($class) ?>....!</strong>
      <?php echo $message; ?>
    </div>
    <?php } ?>
    <!-- page content -->
    <div class="pagecontent">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <ul class="wizard_steps nav nav-pills">
          <li class="active"><a href="<?php echo site_url() ?>holiday/edit_holiday?id=<?php echo $package_id ?>"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>Basic Tour Info</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step2?id=<?php echo $package_id ?>"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Overview/Highlights</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step3?id=<?php echo $package_id ?>"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Activities</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step4?id=<?php echo $package_id ?>"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Includes/Excludes</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step5?id=<?php echo $package_id ?>"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Important Info</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step6?id=<?php echo $package_id ?>"><span class="step_no wizard-step">6</span><span class="step_descr">Step 6<br><small>Meeting Points</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step7?id=<?php echo $package_id ?>"><span class="step_no wizard-step">7</span><span class="step_descr">Step 7<br><small>Images(Preview &amp; Save)</small></span></a></li> 
        </ul>
        
        <?php
        $themes = explode(',',$package_info->theme_id);
        $dest = explode(',', $package_info->destination);
        $acco_type = explode(',',$package_info->accomodation_type);
        $opp_day = explode(',',$package_info->operation_day);
        $close_date = explode('|',$package_info->closed_dates);
        $dep_date = explode('|',$package_info->departure_date);
        $city_cover = explode(',',$package_info->city_covering);
        $pick = explode(',',$package_info->pick_up);
        $drop = explode(',',$package_info->drop_off);
        $fromdate = str_replace('-', '/', $package_info->start_date);
        $todate = str_replace('-', '/', $package_info->end_date)
       
        ?>
         
        <div class="tab-content">
          <form action="<?php echo site_url() ?>holiday/update_all" method="post" class="step_form step1" steps="1" name="step1" role="form">
            <div class="tab-pane active" id="step-1">
              <input type="hidden" name="steps" value="1">
              <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $package_id ?>">
              <div class="row border_row">
                <!-- <div class="form-group col-md-4"> -->
                 <!--  <label class="strong">Holiday Type :</label>
                  <div class="check_icon">
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="holiday_type" value="Private" checked><i></i> Private</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="holiday_type" value="Scheduled"><i></i> Scheduled(SIC)</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="holiday_type" value="Bespoke"><i></i> Bespoke</label>
                  </div>
                </div> -->
                <div class="form-group col-md-4">
                  <label class="strong" for="holiday_name"> Holiday Name :</label>
                  <input name="holiday_name" id="holiday_name"  value="<?php echo $package_info->package_title ?>" type="text" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="holiday_code">Holiday Code : </label>
                  <input type="text" name="holiday_code" value="<?php echo $package_info->package_code ?>" id="holiday_code" class="form-control" required>
                </div>
            
              <!-- <div class="row border_row"> -->
                <div class="form-group col-md-4">
                  <label class="strong">Destination :</label>
                  <select class="select2_multiple form-control" id="desti" name="desti[]" data-placeholder="Select destination" multiple="multiple" required>
                    <option value=""></option>
                    <?php foreach($holiday_city as $city){ ?>
                    <option value="<?php echo $city->city_id;?>|<?php echo $city->country_id;?>|<?php echo $city->continent_id;?>" <?php foreach($dest as $des){ if($des == $city->city_id) echo 'selected'; }?>><?php echo $city->city_name ?></option>
                    <?php } ?>
                  </select>
                </div>
             </div>
              <div class="row border_row">
                <div class="form-group col-md-8">
                  <label class="strong">Theme : </label>
                  <ul class="check_width check_icon">
                     <?php if($theme) for($t=0;$t<count($theme);$t++) {  ?>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value="<?php echo $theme[$t]->theme_id;?>" <?php foreach($themes as $th){ echo $th == $theme[$t]->theme_id ? 'checked="checked"' : ''; } ?>><i></i> <?php echo $theme[$t]->theme_name;?></label></li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="short_desc">Short Description :</label>
                  <textarea name="short_desc" id="short_desc" class="form-control" rows="5" required><?php echo $package_info->short_desc ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-2">
                  <label class="strong">Package Rating :</label>
                  <div class="starrr stars" style="display: block;"></div>
                  <input type="hidden" name="star_rating" value="<?php echo $package_info->package_rating ?>" class="stars_input">
                  <span class="stars-count"><?php echo $package_info->package_rating ?></span> Star(s)
                </div>
               <!--  <div class="form-group col-md-4">
                  <label class="strong">Physical Rating : </label>
                  <div class="starrr stars" style="display: block;"></div>
                  <input type="hidden" name="physical_rating" value="" class="stars_input">
                  <span class="stars-count">0</span> Star(s)
                </div> 
              </div>-->
              <div class="form-group col-md-3">
                  <label class="strong" for="package_validity">Tour Validity :<?php echo $fromdate.' - '.$todate ?></label>
                  <input name="package_validity" value="<?php echo $fromdate.' - '.$todate ?>"  id="package_validity"  class="datepick form-control date_range" required>
                </div>
              <div class="form-group col-md-3">
                  <label class="strong" for="duration">Tour Duration :</label>
                  <!-- <input name="duration" id="duration" class="form-control" required=""> -->
                  <select name="duration" id="duration" class="form-control" required>
                    <option value="1Night + 2days" <?php if($package_info->duration == '1Night + 2days') echo 'selected' ?>>1Night + 2days</option>
                    <option value="2Night + 3days+" <?php if($package_info->duration == '2Night + 3days+') echo 'selected' ?>>2Night + 3days</option>
                    <option value="3Night + 4days" <?php if($package_info->duration == '3Night + 4days') echo 'selected' ?>>3Night + 4days</option>
                    <option value="4Night + 5days" <?php if($package_info->duration == '4Night + 5days') echo 'selected' ?>>4Night + 5days</option>
                    <option value="5Night + 6days" <?php if($package_info->duration == '5Night + 6days') echo 'selected' ?>>5Night + 6days</option>
                    <option value="6Night + 7days" <?php if($package_info->duration == '6Night + 7days') echo 'selected' ?>>6Night + 7days</option>
                    <option value="7Night + 8days" <?php if($package_info->duration == '7Night + 8days') echo 'selected' ?>>7Night + 8days</option>
                    <option value="8Night + 9days" <?php if($package_info->duration == '8Night + 9days') echo 'selected' ?>>8Night + 9days</option>
                    <option value="9Night + 10days" <?php if($package_info->duration == '9Night + 10days') echo 'selected' ?>>9Night + 10days</option>
                    <option value="10Night + 11days" <?php if($package_info->duration == '10Night + 11days') echo 'selected' ?>>10Night + 11days</option>
                    
                    <option value="11Night + 12days" <?php if($package_info->duration == '11Night + 12days') echo 'selected' ?>>11Night + 12days</option>
                    <option value="12Night + 13days" <?php if($package_info->duration == '12Night + 13days') echo 'selected' ?>>12Night + 13days</option>
                    <option value="13Night + 14days" <?php if($package_info->duration == '13Night + 14days') echo 'selected' ?>>13Night + 14days</option>
                    <option value="14Night + 15days" <?php if($package_info->duration == '14Night + 15days') echo 'selected' ?>>14Night + 15days</option>
                    <option value="15Night + 16days" <?php if($package_info->duration == '15Night + 16days') echo 'selected' ?>>15Night + 16days</option>
                    <option value="16Night + 17days" <?php if($package_info->duration == '16Night + 17days') echo 'selected' ?>>16Night + 17days</option>
                    <option value="17Night + 18days" <?php if($package_info->duration == '17Night + 18days') echo 'selected' ?>>17Night + 18days</option>
                    <option value="18Night + 19days" <?php if($package_info->duration == '18Night + 19days') echo 'selected' ?>>18Night + 19days</option>
                    <option value="19Night + 20days" <?php if($package_info->duration == '19Night + 20days') echo 'selected' ?>>19Night + 20days</option>
                    <option value="20Night + 21days" <?php if($package_info->duration == '20Night + 21days') echo 'selected' ?>>20Night + 21days</option>
                    <option value="21Night + 22days" <?php if($package_info->duration == '21Night + 22days') echo 'selected' ?>>21Night + 22days</option>
                    <option value="22Night + 23days" <?php if($package_info->duration == '22Night + 23days') echo 'selected' ?>>22Night + 23days</option>
                    <option value="23Night + 24days" <?php if($package_info->duration == '23Night + 24days') echo 'selected' ?>>23Night + 24days</option>
                    <option value="24Night + 25days" <?php if($package_info->duration == '24Night + 25days') echo 'selected' ?>>24Night + 25days</option>
                    <option value="25Night + 26days" <?php if($package_info->duration == '25Night + 26days') echo 'selected' ?>>25Night + 26days</option>
                    <option value="26Night + 27days" <?php if($package_info->duration == '26Night + 27days') echo 'selected' ?>>26Night + 27days</option>
                    <option value="27Night + 28days" <?php if($package_info->duration == '27Night + 28days') echo 'selected' ?>>27Night + 28days</option>
                    <option value="28Night + 29days" <?php if($package_info->duration == '28Night + 29days') echo 'selected' ?>>28Night + 29days</option>
                    <option value="29Night + 30days" <?php if($package_info->duration == '29Night + 30days') echo 'selected' ?>>29Night + 30days</option>
                    <option value="30Night + 31days" <?php if($package_info->duration == '30Night + 31days') echo 'selected' ?>>30Night + 31days</option>
                    <option value="31Night + 32days" <?php if($package_info->duration == '31Night + 32days') echo 'selected' ?>>31Night + 32days</option>
                    <option value="32Night + 33days" <?php if($package_info->duration == '32Night + 33days') echo 'selected' ?>>32Night + 33days</option>
                    <option value="33Night + 34days" <?php if($package_info->duration == '33Night + 34days') echo 'selected' ?>>33Night + 34days</option>
                    <option value="34Night + 35days" <?php if($package_info->duration == '34Night + 35days') echo 'selected' ?>>34Night + 35days</option>
                    <option value="35Night + 36days" <?php if($package_info->duration == '35Night + 36days') echo 'selected' ?>>35Night + 36days</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Child Allowed :</label>
                  <div class="check_icon">
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="child_allowed" value="Yes"  <?php if($package_info->child_allowed =='Yes') echo 'checked="checked"'; ?> checked="checked"><i></i> YES</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="child_allowed" value="No" <?php if($package_info->child_allowed =='No') echo 'checked="checked"'; ?>><i></i> NO</label>
                  </div>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-2 child_agereq" <?php if($package_info->child_allowed =='No') echo 'style="display:none"'; ?>>
                  <label class="strong" for="minChildAge">Min Child Age :</label>
                  <select name="minChildAge" id="minChildAge" class="form-control min_max_valid" data-type="min" required>
                    <?php for($i=1;$i<16;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->minChildAge==$i) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2 child_agereq" <?php if($package_info->child_allowed =='No') echo 'style="display:none"'; ?>>
                  <label class="strong" for="maxChildAge">Max Child Age :</label>
                  <select name="maxChildAge" id="maxChildAge" class="form-control min_max_valid" data-type="max" required>
                    <?php for($i=6;$i<16;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->maxChildAge==$i) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="minAdultAge">Min Adult Age :</label>
                  <select name="minAdultAge" id="minAdultAge" class="form-control min_max_valid" data-type="min_adult" required>
                    <?php for($i=12;$i<19;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->minAdultAge==$i) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="minPaxOperating">Min Persons Required :</label>
                  <select name="minPaxOperating" id="minPaxOperating" class="form-control min_max_valid" data-type="min" required>
                    <?php for($i=1;$i<14;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->minPaxOperating==$i) echo 'selected' ?>><?php echo $i ?> Adults</option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="maxPaxOperating">Max Persons Allowed :</label>
                  <select name="maxPaxOperating" id="maxPaxOperating" class="form-control min_max_valid" data-type="max" required>
                    <?php for($i=2;$i<15;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->maxPaxOperating==$i) echo 'selected' ?>><?php echo $i ?> Adults</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-3">
                  <label class="strong" for="trip_type">Trip Type :</label>
                  <select name="trip_type" id="trip_type" class="form-control select2_single" required>
                    <option value="">Select Trip</option>
                    <?php foreach($trip as $val) { ?>
                    <option value="<?php echo $val->type.'||'.$val->trip_group ?>"<?php if($package_info->trip_type == $val->type) echo 'selected' ?> ><?php echo $val->type ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong" for="age">Travellers age :</label>
                  <select name="age" id="age" class="form-control select2_single" required>
                    <option value="">Select Age</option>
                    <?php foreach($age as $val) { ?>
                    <option value="<?php echo $val->age ?>"<?php if($package_info->age_limit == $val->age) echo 'selected' ?> ><?php echo $val->age ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row">
              <div class="form-group col-md-2">
                  <label class="strong" for="pp_currency">Currency :</label>
                  <select name="currency_code" id="pp_currency" class="form-control select2_single" required>
                    <option value="">Select Currency</option>
                   <?php foreach($currency as $val2) { ?>
                    <option value="<?php echo $val2->currency_code ?>" <?php if($package_info->currency_code == $val2->currency_code) echo 'selected' ?>><?php echo $val2->currency_name ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
               <label class="strong" for="pp_price">Price Starting from :</label>
                  <input type="text" name="pp_price" id="pp_price" value="<?php echo $package_info->price ?>" class="form-control" required="">
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="discount_type">Discount Type :</label>
                  <select name="discount_type" id="discount_type" class="form-control">
                   <option value="0" <?php if($package_info->discount_type == 0) echo 'selected' ?>>None</option>
                    <option value="1" <?php if($package_info->discount_type == 1) echo 'selected' ?>>Fixed</option>
                    <option value="2" <?php if($package_info->discount_type == 2) echo 'selected' ?>>Percentage</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong" for="discount_price">Discount Price(percentage) :</label><br>
                  <input type="text"  name="discount_price" id="discount_price" value="<?php echo $package_info->discount_price ?>" class="form-control">
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="tax_amount">Tax Percentage :</label><br>
                  <input type="text"  name="tax_amount" id="tax_amount" value="<?php echo $package_info->tax_percentage ?>" class="form-control">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="operated_by">Tour Operated By <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" name="operated_by" id="operated_by" value="<?php echo $package_info->operated_by ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="operator_no">Operator Contact No <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" name="operator_no" id="operator_no" value="<?php echo $package_info->operator_no ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="emergency_no">Emergency Contact No <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" name="emergency_no" id="emergency_no"  value="<?php echo $package_info->emergency_no ?>"  class="form-control">
                </div>
              </div>
            <ul class="pager wizard">
              <input id="todo" type="hidden" name="todo">
              <li class="next">
                <button class="btn btn-success todo" value="1">Save and Continue</button>
              </li>
              <li class="first">
                <button class="btn btn-success todo" value="0" style="float: right;margin-right: 20px;">Save</button>
              </li>
            </ul>
          </form>
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
<base href="<?php echo base_url(); ?>">
<!--/ custom javascripts -->

<script type="text/javascript">
$('.todo').on('click', function(){
  var data = $(this).val();
  $('#todo').val(data);
});
</script>

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
              format: 'YYYY-MM-DD'
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
              format: 'YYYY-MM-DD'
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
    // timePicker: true,
    // minDate: dateToday,
    minDate: dateToday,
    startDate: '<?php echo $fromdate ?>',
    endDate: '<?php echo $todate ?>',
    autoApply: true,
    stepMonths: false,
    timePickerIncrement: 30,
    locale: {
        format: 'YYYY/MM/DD'
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
    $('.stars,physical').starrr({
      rating: '<?php echo $package_info->package_rating ?>'
    });
    $('.physical').starrr({
      rating: '<?php echo $package_info->physical_rating ?>'
    });
    $('.starrr').on('starrr:change', function (e, value) {
      $(this).parent().find('.stars-count').html(value);
      $(this).parent().find('.stars_input').val(value);
    });
  });
</script>

<!--  Page Specific Scripts  --> 
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
<!--/ Page Specific Scripts -->
