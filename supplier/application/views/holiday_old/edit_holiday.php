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
          <li class="active"><a href="<?php echo site_url() ?>holiday/edit_holiday?id=<?php echo $package_id ?>"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>Basic Package Info</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step2?id=<?php echo $package_id ?>"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Overview/Highlights</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step3?id=<?php echo $package_id ?>"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Itinerary</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step4?id=<?php echo $package_id ?>"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Includes/Excludes</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step5?id=<?php echo $package_id ?>"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Important Info</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step6?id=<?php echo $package_id ?>"><span class="step_no wizard-step">6</span><span class="step_descr">Step 6<br><small>Routing(Map)</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step7?id=<?php echo $package_id ?>"><span class="step_no wizard-step">7</span><span class="step_descr">Step 7<br><small>Activities(Optional)</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step8?id=<?php echo $package_id ?>"><span class="step_no wizard-step">8</span><span class="step_descr">Step 8<br><small>Attraction(Optional)</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step9?id=<?php echo $package_id ?>"><span class="step_no wizard-step">9</span><span class="step_descr">Step 9<br><small>Images(Preview &amp; Save)</small></span></a></li>
        </ul>
        <?php
        $themes = explode(',',$package_info->themes);
        $acco_type = explode(',',$package_info->accomodation_type);
        $opp_day = explode(',',$package_info->operation_day);
        $close_date = explode('|',$package_info->closed_dates);
        $dep_date = explode('|',$package_info->departure_date);
        $city_cover = explode(',',$package_info->city_covering);
        $pick = explode(',',$package_info->pick_up);
        $drop = explode(',',$package_info->drop_off);
        // echo '<pre>'; print_r($themes);exit;
        ?>
        <div class="tab-content">
          <form action="<?php echo site_url() ?>holiday/update_all" method="post" class="step_form step1" steps="1" name="step1" role="form">
            <div class="tab-pane active" id="step-1">
              <input type="hidden" name="steps" value="1">
              <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $package_id ?>">
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Holiday Type :</label>
                  <div class="check_icon">
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="holiday_type" value="Private" <?php if($package_info->holiday_type =='Private') echo 'checked="checked"'; ?>><i></i> Private</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="holiday_type" value="Scheduled" <?php if($package_info->holiday_type =='Scheduled') echo 'checked="checked"'; ?>><i></i> Scheduled(SIC)</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="holiday_type" value="Bespoke" <?php if($package_info->holiday_type =='Bespoke') echo 'checked="checked"'; ?>><i></i> Bespoke</label>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="holiday_name">Holiday Name : </label>
                  <input name="holiday_name" value="<?php echo $package_info->holiday_name ?>" id="holiday_name" type="text" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="holiday_code">Holiday Id : </label>
                  <input type="text" name="holiday_code" value="<?php echo $package_info->holiday_code ?>" id="holiday_code" class="form-control" readonly required>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-8">
                  <label class="strong">Theme : </label>
                  <ul class="check_width check_icon">
                    <?php if($theme) for($t=0;$t<count($theme);$t++) { ?>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value="<?php echo $theme[$t]->theme_id;?>" <?php foreach($themes as $th){ echo $th == $theme[$t]->theme_id ? 'checked="checked"' : ''; } ?>><i></i> <?php echo $theme[$t]->theme_name;?></label></li>
                    <?php } ?>
                  </ul>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="short_desc">Short Description : </label>
                  <textarea name="short_desc" id="short_desc" class="form-control" rows="5"><?php echo $package_info->short_desc ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-5">
                  <label class="strong">Accommodation Type : </label>
                  <ul class="check_width check_icon">
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="Economy(3.5)" <?php foreach($acco_type as $acc) if($acc =='Economy(3.5)') echo 'checked="checked"'; ?>><i></i> Economy(3.5)</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="Superior(4)" <?php foreach($acco_type as $acc) if($acc =='Superior(4)') echo 'checked="checked"'; ?>><i></i> Superior(4)</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="First class(5)" <?php foreach($acco_type as $acc) if($acc =='First class(5)') echo 'checked="checked"'; ?>><i></i> First class(5)</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="Luxury(5+)" <?php foreach($acco_type as $acc) if($acc =='Luxury(5+)') echo 'checked="checked"'; ?>><i></i> Luxury(5+)</label></li>
                    <!-- <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="5" <?php foreach($acco_type as $acc) if($acc ==5) echo 'checked="checked"'; ?>><i></i> 5 Star</label></li> -->
                  </ul>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Star Rating : </label>
                  <div class="starrr stars" style="display: block;"></div>
                  <input type="hidden" name="star_rating" value="<?php echo $package_info->star_rating ?>" class="stars_input">
                  <span class="stars-count"><?php echo $package_info->star_rating ?></span> Star(s)
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Physical Rating : </label>
                  <div class="starrr physical" style="display: block;"></div>
                  <input type="hidden" name="physical_rating" value="<?php echo $package_info->physical_rating ?>" class="stars_input">
                  <span class="stars-count"><?php echo $package_info->physical_rating ?></span> Star(s)
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-2">
                  <label class="strong" for="minChildAge">Min Child Age : </label>
                  <select name="minChildAge" id="minChildAge" class="form-control">
                    <?php for($i=0;$i<11;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->minChildAge==$i) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="maxChildAge">Max Child Age : </label>
                  <select name="maxChildAge" id="maxChildAge" class="form-control">
                    <?php for($i=0;$i<20;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->maxChildAge==$i) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="minPaxOperating">Min Pax Operating : </label>
                  <select name="minPaxOperating" id="minPaxOperating" class="form-control">
                    <?php for($i=0;$i<20;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->minPaxOperating==$i) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="maxPaxOperating">Max Pax Operating : </label>
                  <select name="maxPaxOperating" id="maxPaxOperating" class="form-control">
                    <?php for($i=0;$i<20;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php echo $i ?>" <?php if($package_info->maxPaxOperating==$i) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong">Infant Allowed : </label>
                  <div class="check_icon">
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="infant_allowed" value="Yes" <?php if($package_info->infant_allowed =='Yes') echo 'checked="checked"'; ?>><i></i> YES</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="infant_allowed" value="No" <?php if($package_info->infant_allowed =='No') echo 'checked="checked"'; ?>><i></i> NO</label>
                  </div>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12 check_icon">
                  <label class="strong">Days of Operation : </label><br>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Monday" <?php foreach($opp_day as $opp) if($opp =='Monday') echo 'checked="checked"'; ?>><i></i> Monday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Tuesday" <?php foreach($opp_day as $opp) if($opp =='Tuesday') echo 'checked="checked"'; ?>><i></i> Tuesday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Wednesday" <?php foreach($opp_day as $opp) if($opp =='Wednesday') echo 'checked="checked"'; ?>><i></i> Wednesday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Thursday" <?php foreach($opp_day as $opp) if($opp =='Thursday') echo 'checked="checked"'; ?>><i></i> Thursday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Friday" <?php foreach($opp_day as $opp) if($opp =='Friday') echo 'checked="checked"'; ?>><i></i> Friday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Saturday" <?php foreach($opp_day as $opp) if($opp =='Saturday') echo 'checked="checked"'; ?>><i></i> Saturday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Sunday" <?php foreach($opp_day as $opp) if($opp =='Sunday') echo 'checked="checked"'; ?>><i></i> Sunday</label>
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
                        <input type="text" value="<?php echo $dep_date[0] ?>" name="departure_date[]" class="date_range form-control">
                      </div>
                      <?php for($d=1;$d<count($dep_date);$d++){ ?>
                      <div class="repeat-field" id="day_d1<?php echo $d+9 ?>">
                        <input type="text" value="<?php echo $dep_date[$d] ?>" name="departure_date[]" class="date_range form-control">
                      </div>
                      <?php } ?>
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
                        <input type="text" value="<?php echo $close_date[0] ?>" name="closed_dates[]" class="date_range form-control">
                      </div>
                      <?php for($d=1;$d<count($close_date);$d++){ ?>
                      <div class="repeat-field" id="day_c1<?php echo $d+9 ?>">
                        <input type="text" value="<?php echo $close_date[$d] ?>" name="closed_dates[]" class="date_range form-control">
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="city_covering">Cities/Towns Covering : </label><br>
                  <select name="city_covering[]" id="city_covering" class="select2_multiple form-control" multiple="multiple" required="">
                    <?php foreach($holiday_city as $city){ ?>
                    <option value="<?php echo $city->city_id ?>" <?php foreach($city_cover as $cc) if($cc==$city->city_id) echo 'selected' ?>><?php echo $city->city_name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <!-- <div class="form-group col-md-4">
                  <label class="strong" for="pkg_combined">Can be Combined with : </label><br>
                  <select name="pkg_combined[]" id="pkg_combined" class="select2_multiple form-control" multiple="multiple">
                    <?php foreach($holiday_packages as $pkg){ ?>
                    <option value="<?php echo $pkg->id ?>" <?php foreach($pkgs as $pk) if($pk==$pkg->id) echo 'selected' ?>><?php echo $pkg->holiday_name ?></option>
                    <?php } ?>
                  </select>
                </div> -->
                <div class="form-group col-md-4">
                  <label class="strong" for="pp_price">Per Person Price : </label><br>
                  <input type="text" value="<?php echo $package_info->pp_price ?>" name="pp_price" id="pp_price" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="pick_up">Pick Up Point : </label><br>
                  <select name="pick_up[]" id="pick_up" class="select2_multiple form-control" multiple="multiple">
                    <?php foreach($holiday_city as $city){ ?>
                    <option value="<?php echo $city->city_id ?>" <?php foreach($pick as $pu) if($pu==$city->city_id) echo 'selected' ?>><?php echo $city->city_name ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="drop_off">Drop Off Point : </label><br>
                  <select name="drop_off[]" id="drop_off" class="select2_multiple form-control" multiple="multiple">
                    <?php foreach($holiday_city as $city){ ?>
                    <option value="<?php echo $city->city_id ?>" <?php foreach($drop as $do) if($do==$city->city_id) echo 'selected' ?>><?php echo $city->city_name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="operated_by">Operated By : </label>
                  <input type="text" value="<?php echo $package_info->operated_by ?>" name="operated_by" id="operated_by" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="operator_no">Operator Contact No : </label>
                  <input type="text" value="<?php echo $package_info->operator_no ?>" name="operator_no" id="operator_no" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="emergency_no">Emergency Contact No : </label>
                  <input type="text" value="<?php echo $package_info->emergency_no ?>" name="emergency_no" id="emergency_no" class="form-control">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="resevatoin_no">Reservation Contact No : </label>
                  <input type="text" value="<?php echo $package_info->resevatoin_no ?>" name="resevatoin_no" id="resevatoin_no" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="product_manager_no">Product Manager Contact No : </label>
                  <input type="text" value="<?php echo $package_info->product_manager_no ?>" name="product_manager_no" id="product_manager_no" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="duration">Holiday Duration : </label>
                  <select name="duration" id="duration" class="form-control">
                    <option value="2" <?php if($package_info->duration==2) echo 'selected' ?>>2 Days / 1 Night</option>
                    <?php for($d=3;$d<32;$d++) { ?>
                    <option value="<?php echo $d ?>" <?php if($package_info->duration==$d) echo 'selected' ?>><?php echo $d ?> Days / <?php echo $d-1 ?> Nights</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <ul class="pager wizard">
              <li class="next finish">
                <button type="submit" class="btn btn-success">Update</button>
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
    // minDate: dateToday,
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
    $('.stars,physical').starrr({
      rating: '<?php echo $package_info->star_rating ?>'
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
