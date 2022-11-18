<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Add Hotel <span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Hotels</a></li>
              <li><a class="active" href="#">Add Hotel</a></li>
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
    <div class="pagecontent">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <ul class="wizard_steps">
          <li><a href="#step-1" data-toggle="tab"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>General</small></span></a></li>
          <li><a href="#step-2"  class="map_locater" data-toggle="tab"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Contact Info</small></span></a></li>
     

        <li><a href="#step-3"  data-toggle="tab"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Facilities / Check in - Check out</small></span></a></li>
          <li><a href="#step-4" data-toggle="tab"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Images</small></span></a></li>


            <li><a href="#step-5" data-toggle="tab"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Meta Info</small></span></a></li>
          <li><a href="#step-6" data-toggle="tab"><span class="step_no wizard-step">6</span><span class="step_descr">Step 6<br><small>Policies</small></span></a></li>

        </ul>
        <input type="hidden" name="insert_id" id="insert_id" value="">
        <div class="tab-content">
          <div class="tab-pane" id="step-1">
            <form class="step_form step1" steps="1" name="step1" role="form">
              <div class="row border_row">            
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_name">Hotel Name : </label>
                  <input name="hotel_name" id="hotel_name" value="<?php echo set_value('hotel_name'); ?>" type="text" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_property_type">Property Type : </label>
                  <select name="hotel_property_type"  id="hotel_property_type" class="form-control select2" required>
                    <option value="">Select Property Type</option>
                    <?php for($i=0;$i<count($propertytype);$i++){ ?>
                    <option value="<?php echo $propertytype[$i]->id; ?>"><?php echo $propertytype[$i]->property_type; ?></option>
                    <?php } ?>                   
                  </select>
                </div>
                 <div class="form-group col-md-4">
                  <label class="strong">Module Permission : </label>
                  <select name="module_permission" class="form-control select2" required>
                    <option value="ALL" selected="selected">ALL</option>
                    <option value="B2B">B2B</option>
                    <option value="B2C">B2C</option>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Hotel Rating : </label>
                  <select name="hotel_star_rating" class="form-control select2" required>
                  <option value="">Select Rating</option>
                  <?php for($i=1;$i<=5;$i++){ ?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php } ?>                  
                  </select>             
                </div>               
                 <div class="form-group col-md-8">
                  <label class="strong" for="hotel_city">Destinations : </label>
                  <input name="cityName" id="cityName"  type="text" class="form-control" required>         
                   <input name="hotel_city" id="hotel_city"  type="hidden" class="form-control" required>
                    <input name="hotel_country" id="hotel_country"  type="hidden" class="form-control" required>
                     <input name="cityid" id="cityid"  type="hidden" class="form-control" required>
                   </div>
              </div>
      
              <div class="row border_row">
               <!--  <div class="form-group col-md-4">
                  <label class="strong">Res. Dep. E-Mail : </label>
                  <textarea name="email" class="form-control" rows="3" required><?php echo set_value('email'); ?></textarea>
                </div> -->
                <div class="form-group col-md-4">
                  <label class="strong">Address: </label>
                  <textarea name="address" class="form-control" rows="3" required><?php echo set_value('address'); ?></textarea>
                </div>                        
                <div class="form-group col-md-4">
                  <label class="strong" for="room_count">Short Description : </label>
                  <textarea name="hotel_desc" class="form-control" rows="3" required><?php echo set_value('hotel_desc'); ?></textarea>
                </div>
              </div>
              <div class="row border_row">            
           <!--      <div class="form-group col-md-8">
                  <label class="strong" for="release_day">Release Day : </label>
                  <select name="release_day" id="release_day" class="form-control select2" required="required">
                       <option value="">Select</option>
                       <?php for($i=1;$i<=31;$i++){ ?>
                       <option value="<?php echo $i?>"><?php echo $i;?></option>
                       <?php } ?>
                     </select> 
                     <p>Release Day(Note If Month has no 31st date than Month last date will be 30th, Exception february month last date consider as either 28 or 29 according to leap year)</p>
                </div> -->
                <div class="form-group col-md-4">
                  <label class="strong">Currency : </label>
                  <select name="currency_type" class="form-control select2" required>
                  <option value="">Select Currency</option>
                  <?php for($i=0;$i<count($currency);$i++){ ?>
                    <option value="<?php echo $currency[$i]->currency_code;?>"><?php echo $currency[$i]->currency_code;?></option>
                    <?php } ?>                  
                  </select>
                </div>
                </div>
         
            </form>
          </div>
          <ul class="pager wizard">
            <li class="next">
              <button class="btn btn-success todo">Save and Continue</button>
            </li>
            <li class="first">
              <button class="btn btn-success todo" style="float: right;margin-right: 20px">Save</button>
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
  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
 <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/wysihtml5-0.3.0.min.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/bootstrap-wysihtml5.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/adapters/jquery.js"></script>


<script type="text/javascript">
// $(window).load(function(){
  $('#rootwizard').bootstrapWizard({
    onTabShow: function(tab, navigation, index) {
      var $total = navigation.find('li').length;
      var $current = index+1;
      // console.log($current);
      if($current == 2){
        show_map();
      }
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
      // alert(index);
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } else {
        save_hotel(form,steps, 1);
        // if(index=='2'){
        //   show_map();
        // }
        // CKEDITOR.instances[name];
        // $("body,html").animate({
        //     scrollTop : 0
        // }, 800);
      }
    },

    onFirst: function(tab, navigation, index) {
      index = 1;
      var form = $('form[name="step'+ index +'"]');
      var steps = 'step'+index;
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } else{
        save_hotel(form,steps, 0);
      }
    },

    onTabClick: function(tab, navigation, index) {
      var form = $('form[name="step'+ (index+1) +'"]');
      var steps = 'step'+(index+1);
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } else{
        save_hotel(form,steps, 2);
        CKEDITOR.instances[name];
      }
    }
  });
// });
$('.next .btn, .previous .btn').on('click', function(e){
  CKEDITOR.instances[name];
});
// function save_hotel1(form,steps){}
function save_hotel(form,steps,todo){
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
    $ins_id = $("#insert_id").val();
    // alert(_steps);
    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>hotel/save_'+steps+'/'+$ins_id,
      // data: $(_parent).serialize(),
      data: form.serialize(),
      dataType: 'json',
      success: function(data) {
        $("#insert_id").val(data.insert_id);
        if(todo == 1){
          window.location.replace('<?php echo site_url();?>hotel/edit_step2?id='+data.insert_id);
        } else{
          window.location.replace('<?php echo site_url();?>hotel/edit_hotel?id='+data.insert_id);
        }
      }
    });
  // });
}
</script>
<script>
$(document).ready(function() {
  $(".select2").select2({ });
});
</script>






<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css">
<script src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
  $("#cityName").autocomplete({
       source: "<?php echo site_url(); ?>hotel/citylist/",
       minLength: 2,
       autoFocus: true,
          select: function( event, ui ) {
      $("input[name='cityid']").val(''); 
      $("input[name='hotel_city']").val(''); 
      $("input[name='hotel_country']").val('');     
      $("input[name='cityid']").val(ui.item.id);  
      $("input[name='hotel_city']").val(ui.item.city_name);
      $("input[name='hotel_country']").val(ui.item.country_name);        
    }
   });
    });

</script>