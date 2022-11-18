<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<!-- <link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css"> -->
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/nestable/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <!-- <h2>Add Package <span></span></h2> -->
          <div class="page-bar br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="javascript:;">Holidays</a></li>
              <li><a class="active">Add Holiday</a></li>
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
          <li><a href="#step-1" data-toggle="tab"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>Basic Tour Info</small></span></a></li>
          <li><a href="#step-2" data-toggle="tab"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Overview &amp; Highlights</small></span></a></li>
          <li><a href="#step-3" data-toggle="tab"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Activities</small></span></a></li>
          <li><a href="#step-4" data-toggle="tab"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Includes &amp; Excludes</small></span></a></li>
          <li><a href="#step-5" data-toggle="tab"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Important Info</small></span></a></li>
          <li><a href="#step-6" data-toggle="tab"><span class="step_no wizard-step">6</span><span class="step_descr">Step 6<br><small>Meeting Points</small></span></a></li>
          <li><a href="#step-7" data-toggle="tab"><span class="step_no wizard-step">7</span><span class="step_descr">Step 7<br><small>Images <div class="backets_info">(Preview &amp; Save)</div></small></span></a></li>
          <!-- <li><a href="#tab1" data-toggle="tab">Personal Information <span class="badge badge-default pull-right wizard-step">1</span></a></li>
          <li><a href="#tab2" data-toggle="tab">Address<span class="badge badge-default pull-right wizard-step">2</span></a></li>-->
        </ul>
        <input type="hidden" name="insert_id" id="insert_id" value="">
        <div class="tab-content">
          <div class="tab-pane" id="step-1">
            <form class="step_form step1" steps="1" name="step1" role="form">
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
                  <label class="strong" for="holiday_name">Package Title :</label>
                  <input name="holiday_name" id="holiday_name" type="text" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="holiday_code">Package Code : </label>
                  <input type="text" name="holiday_code" id="holiday_code" class="form-control" required>
                </div>
            
              <!-- <div class="row border_row"> -->
                <div class="form-group col-md-4">
                  <label class="strong">Destination :</label>
                  <select class="select2_multiple form-control" id="desti" name="desti[]" data-placeholder="Select destination" multiple="multiple" required>
                    <option value=""></option>
                   <?php foreach($holiday_city as $city){ ?>
                    <option value="<?php echo $city->city_id;?>|<?php echo $city->country_id;?>|<?php echo $city->continent_id;?>"><?php echo $city->city_name ?></option>
                    <?php } ?>
                  </select>
                </div>
             </div>
             <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong">Theme :</label>
                  <ul class="check_width check_icon theme_group">
                    <?php if($theme) foreach($theme as $th) { ?>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value="<?php echo $th->theme_id;?>" required><i></i> <?php echo $th->theme_name;?></label></li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
               <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="short_desc">Short Description :</label>
                  <textarea name="short_desc" id="short_desc" class="form-control" rows="5" required></textarea>
                </div>
              </div>
               <div class="row border_row">
                <div class="form-group col-md-2">
                   <label class="strong">Package Rating : </label>
                  <div class="starrr stars" style="display: block;"></div>
                  <input type="hidden" name="star_rating" value="" class="stars_input">
                  <span class="stars-count">0</span> Star(s)
                </div>
              <div class="form-group col-md-3">
                  <label class="strong" for="package_validity">Tour Validity :</label>
                  <input name="package_validity" id="package_validity" class="datepick form-control date_range" required="">
                </div>
              <div class="form-group col-md-3">
                  <label class="strong" for="duration">Tour Duration :</label>
                  <!-- <input name="duration" id="duration" class="form-control" required=""> -->
                  <select name="duration" id="duration" class="form-control" required>
                    <option value="1Night + 2days">1Night + 2days</option>
                    <option value="2Night + 3days">2Night + 3days</option>
                    <option value="3Night + 4days">3Night + 4days</option>
                    <option value="4Night + 5days">4Night + 5days</option>
                    <option value="5Night + 6days">5Night + 6days</option>
                    <option value="6Night + 7days">6Night + 7days</option>
                    <option value="7Night + 8days">7Night + 8days</option>
                    <option value="8Night + 9days">8Night + 9days</option>
                    <option value="9Night + 10days">9Night + 10days</option>
                    <option value="10Night + 11days">10Night + 11days</option>
                    <option value="11Night + 12days">11Night + 12days</option>
                    <option value="12Night + 13days">12Night + 13days</option>
                    <option value="13Night + 14days">13Night + 14days</option>
                    <option value="14Night + 15days">14Night + 15days</option>
                    <option value="15Night + 16days">15Night + 16days</option>
                    <option value="16Night + 17days">16Night + 17days</option>
                    <option value="17Night + 18days">17Night + 18days</option>
                    <option value="18Night + 19days">18Night + 19days</option>
                    <option value="19Night + 20days">19Night + 20days</option>
                    <option value="20Night + 21days">20Night + 21days</option>
                    <option value="21Night + 22days">21Night + 22days</option>
                    <option value="22Night + 23days">22Night + 23days</option>
                    <option value="23Night + 24days">23Night + 24days</option>
                    <option value="24Night + 25days">24Night + 25days</option>
                    <option value="25Night + 26days">25Night + 26days</option>
                    <option value="26Night + 27days">26Night + 27days</option>
                    <option value="27Night + 28days">27Night + 28days</option>
                    <option value="28Night + 29days">28Night + 29days</option>
                    <option value="29Night + 30days">29Night + 30days</option>
                    <option value="30Night + 31days">30Night + 31days</option>
                    <option value="31Night + 32days">31Night + 32days</option>
                    <option value="32Night + 33days">32Night + 33days</option>
                    <option value="33Night + 34days">33Night + 34days</option>
                    <option value="34Night + 35days">34Night + 35days</option>
                    <option value="35Night + 36days">35Night + 36days</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Child Allowed :</label>
                  <div class="check_icon">
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="child_allowed" value="Yes" checked="checked"><i></i> YES</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="child_allowed" value="No"><i></i> NO</label>
                  </div>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-2 child_agereq">
                  <label class="strong" for="minChildAge">Min Child Age :</label>
                  <select name="minChildAge" id="minChildAge" class="form-control min_max_valid" data-type="min" required>
                    <?php for($i=1;$i<16;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($i==1) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2 child_agereq">
                  <label class="strong" for="maxChildAge">Max Child Age :</label>
                  <select name="maxChildAge" id="maxChildAge" class="form-control min_max_valid" data-type="max" required>
                    <?php for($i=6;$i<16;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($i==12) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="minAdultAge">Min Adult Age :</label>
                  <select name="minAdultAge" id="minAdultAge" class="form-control min_max_valid" data-type="min_adult" required>
                    <?php for($i=12;$i<19;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($i==13) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="minPaxOperating">Min Persons Required :</label>
                  <select name="minPaxOperating" id="minPaxOperating" class="form-control min_max_valid" data-type="min" required>
                    <?php for($i=1;$i<14;$i++){ ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?> Adults</option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="maxPaxOperating">Max Persons Allowed :</label>
                  <select name="maxPaxOperating" id="maxPaxOperating" class="form-control min_max_valid" data-type="max" required>
                    <?php for($i=2;$i<15;$i++){ ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?> Adults</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-3">
                  <label class="strong" for="trip_type">Trip Type :</label>
                  <select name="trip_type" id="trip_type" class="form-control select2_single" required>
                    <option value="">Select Triptype</option>
                    <?php foreach($trip as $val) { ?>
                    <option value="<?php echo $val->type.'||'.$val->trip_group ?>"><?php echo $val->type ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong" for="age">Travellers age :</label>
                  <select name="age" id="age" class="form-control select2_single" required>
                    <option value="">Select Age</option>
                    <?php foreach($age as $val) { ?>
                    <option value="<?php echo $val->age ?>"<?php if($val->age == '18-35') echo 'selected' ?> ><?php echo $val->age ?></option>
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
                    <option value="<?php echo $val2->currency_code ?>" <?php if($val2->currency_code == 'USD') echo 'selected' ?>><?php echo $val2->currency_name ?></option>
                    <?php } ?>
                  </select>
                </div>
               <!--  <div class="form-group col-md-2">
               <label class="strong" for="pp_price">Adult Price Starting from :</label>
                  <input type="text" name="pp_price" id="pp_price" class="form-control" required="">
                </div> -->
                <div class="form-group col-md-2">
                  <label class="strong" for="discount_type">Discount Type :</label>
                  <select name="discount_type" id="discount_type" class="form-control">
                    <option value="0" selected>None</option>
                    <option value="1">Fixed</option>
                    <option value="2">Percentage</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="discount_price">Discount Price :</label><br>
                  <input type="text" value="0" name="discount_price" id="discount_price" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label class="strong" for="tax_value">Tax Percentage :</label><br>
                  <input type="text" value="0" name="tax_value" id="tax_value" class="form-control">
                </div>
              </div>

               <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="operated_by">Tour Operated By <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" name="operated_by" id="operated_by" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="operator_no">Operator Contact No <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" name="operator_no" id="operator_no" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="emergency_no">Emergency Contact No <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" name="emergency_no" id="emergency_no" class="form-control">
                </div>
              </div>
            </form>
          </div>
           <ul class="pager wizard">
            <li class="next">
              <button class="btn btn-success todo" value="1" >Save and Continue</button>
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
<div class="modal fade" id="modalClosedResons" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form goingact="<?php echo site_url() ?>holiday/add_closed_rasons">
        <!-- <div class="modal-header">
          <h3 class="modal-title custom-font">I'm a modal!</h3>
        </div> -->
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <label class="strong">Closed Reason :</label>
              <div class="controls">
                <input type="text" name="closed_reason" class="form-control closed_reason" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer text-center">
          <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c br-50 ajax-submit"><i class="fa  fa-long-arrow-right"></i> Submit</button>
          <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c br-50" data-dismiss="modal"><i class="fa  fa-long-arrow-left"></i> Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
  

  
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
<!--  Custom JavaScripts  --> 
<script type="text/javascript">
  $('.todo').on('click', function(){
  var data = $(this).val();
  $('#todo').val(data);
});
</script>
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
      //timePicker: true,
      minDate: dateToday,
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
      return false;
      var form = $('form[name="step'+ (index+1) +'"]');
      var steps = 'step'+(index+1);
      // alert(currentIndex);
      // alert(index);
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } else{
        save_holiday(form,steps, 2);
      }
    }
  })
// });
$('.next .btn, .previous .btn').on('click', function(e){
  CKEDITOR.instances[name];
});
function save_holiday(form,steps,todo){

    $ins_id = $("#insert_id").val();
    
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
        //$("#transport").html(data.transport);
        //$("#output").html(data.transport_output);
        $("#validation_error").html(data.validation_error);
        $("#validation_status").html(data.validation_status);
        $(".package_id").val(data.insert_id);
        if(todo == 1){
          window.location.replace('<?php echo site_url();?>holiday/edit_holiday?id='+data.insert_id);
        } else {
          window.location.replace('<?php echo site_url();?>holiday/edit_step2?id='+data.insert_id);

        }
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

<script type="text/javascript">
$('input[type=radio][name=duration]').on('change', function(){
  var _val = this.value;
  if(_val == 'Multiple days'){
    $('.multiple_days').show('slow');
  } else{
    $('.multiple_days').hide('slow');
  }
});

$('input[type=radio][name=child_allowed]').on('change', function(){
  var _val = this.value;
  // alert(_val);
  if(_val == 'Yes'){
    $('.child_agereq').show('slow');
  } else{
    $('.child_agereq').hide('slow');
  }
});
</script>

<script type="text/javascript">
var previous;
$(".min_max_valid").on('focus', function () {
  previous = this.value;
}).change(function() {
  var current_attr = $(this).attr('data-type');
  var min_count = parseInt($('#minChildAge').val(),10);
  var max_count = parseInt($('#maxChildAge').val(),10);
  var max_adult_count = parseInt($('#minAdultAge').val(),10);
  var min_pax_count = parseInt($('#minPaxOperating').val(),10);
  var max_pax_count = parseInt($('#maxPaxOperating').val(),10);

  if(max_count < min_count){
    if(current_attr == 'min'){
      $('#minChildAge').val(previous);
    }else if(current_attr == 'max'){
      $('#maxChildAge').val(previous);
    }
    alert('Max Child Age should always be greater than Min Child Age');
  }
  if(max_adult_count < max_count){
    if(current_attr == 'min_adult'){
      $('#minAdultAge').val(previous);
    }
    alert('Min Adult Age should always be greater than Max Child Age');
  }
  if(max_pax_count < min_pax_count){
    if(current_attr == 'min'){
      $('#minPaxOperating').val(previous);
    }else if(current_attr == 'max'){
      $('#maxPaxOperating').val(previous);
    }
    alert('Max Pax Allowed should always be greater than Min Pax Required');
  }

  previous = this.value;
});
</script>