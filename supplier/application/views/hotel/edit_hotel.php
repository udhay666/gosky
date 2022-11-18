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
          <h2>Edit Hotel ( Code : <?php echo $hotel_details[0]->hotel_code;?>)<span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Hotels</a></li>
              <li><a class="active" href="<?php echo site_url() ?>hotel/edit_hotel?id=<?php echo $hotel_id ?>">Edit Hotel</a></li>
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
        <?php
          $data['steps'] = '1';
          echo $this->load->view('hotel/steps', $data);       
        ?>
        <div class="tab-content">    
           <form class="step_form step1" steps="1" name="step1" role="form">
            <div class="tab-pane active" id="step-1">
              <input type="hidden" name="steps" value="1">
              <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $hotel_id ?>">
              <input type="hidden" id="refresh" value="no">
       <div class="row border_row">         
          <div class="form-group col-md-4">
                  <label class="strong" for="hotel_name">Hotel Name : </label>
                  <input name="hotel_name" id="hotel_name" value="<?php echo $hotel_details[0]->hotel_name;?>" type="text" class="form-control" required>
                </div>
               <div class="form-group col-md-4">
                  <label class="strong" for="hotel_property_type">Property Type : </label>
                  <select name="hotel_property_type"  id="hotel_property_type" class="form-control select2" required>
                    <option value="">Select Property Type</option>                   
                     <?php for($i=0;$i<count($propertytype);$i++){ ?>
                    <option value="<?php echo $propertytype[$i]->id; ?>" <?php if($hotel_details[0]->hotel_property_type==$propertytype[$i]->id){echo "selected";}?>><?php echo $propertytype[$i]->property_type; ?></option>
                    <?php } ?>                   
                  </select>
                </div>      
                <div class="form-group col-md-4">
                  <label class="strong">Module Permission : </label>
                  <select name="module_permission" class="form-control select2" required>
                    <option value="ALL" selected="selected">ALL</option>
                    <option value="B2B" <?php if($hotel_details[0]->module_permission=="B2B"){echo "selected";}?>>B2B</option>
                    <option value="B2C" <?php if($hotel_details[0]->module_permission=="B2C"){echo "selected";}?>>B2C</option>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Hotel Rating : </label>
                  <select name="hotel_star_rating" class="form-control select2" required>
                  <option value="">Select Rating</option>
                  <?php for($i=1;$i<=5;$i++){ ?>
                    <option value="<?php echo $i;?>" <?php if($i==$hotel_details[0]->hotel_star_rating){ echo 'selected'; } ?>><?php echo $i;?></option>
                    <?php } ?>                  
                  </select>               
                </div>                           
                 <div class="form-group col-md-8">
                  <label class="strong" for="hotel_city">Destinations : </label>
                  <input name="cityName" id="cityName"  type="text"  value="<?php echo $hotel_details[0]->hotel_city.', '.$hotel_details[0]->hotel_country;?>" class="form-control" required>         
                   <input name="hotel_city" id="hotel_city"  type="hidden" value="<?php echo $hotel_details[0]->hotel_city;?>" class="form-control" required>
                    <input name="hotel_country" id="hotel_country"  value="<?php echo $hotel_details[0]->hotel_country;?>" type="hidden" class="form-control" required>
                     <input name="cityid" id="cityid"  type="hidden"  value="<?php echo $hotel_details[0]->cityid;?>" class="form-control" required>
                   </div>          
              </div>          
              <div class="row border_row">
               <!--  <div class="form-group col-md-6">
                  <label class="strong">Res. Dep. E-Mail : </label>
                  <textarea name="email" class="form-control" rows="3" required><?php echo $hotel_details[0]->email;?></textarea>
                </div> -->
                <div class="form-group col-md-6">
                  <label class="strong">Address: </label>
                  <textarea name="address" class="form-control" rows="3" required><?php echo $hotel_details[0]->address;?></textarea>
                </div>
              </div>
              <div class="row border_row">             
                <div class="form-group col-md-6">
                  <label class="strong" for="room_count">Short Description : </label>
                  <textarea name="hotel_desc" class="form-control" rows="3" required><?php echo $hotel_details[0]->hotel_desc;?></textarea>
                </div>
              </div>
              <div class="row border_row">
            
             <!--    <div class="form-group col-md-8">
                  <label class="strong" for="release_day">Release Day : </label>  
                  <select name="release_day" id="release_day" class="form-control select2" required="required">
                       <option value="">Select</option>
                       <?php for($i=1;$i<=31;$i++){ ?>
                       <option value="<?php echo $i?>" <?php if($i==$hotel_details[0]->release_day){echo "selected";}?>><?php echo $i;?></option>
                       <?php } ?>
                     </select> 
                     <p>Release Day(Note If Month has no 31st date than Month last date will be 30th, Exception february month last date consider as either 28 or 29 according to leap year)</p>
                </div> -->
                <div class="form-group col-md-4">
                  <label class="strong">Currency : </label>
                  <select name="currency_type" class="form-control select2" required>
                   <option value="">Select Currency</option> 
                   <?php for($i=0;$i<count($currency);$i++){ ?>
                    <option value="<?php echo $currency[$i]->currency_code;?>" <?php if($hotel_details[0]->currency_type==$currency[$i]->currency_code){echo "selected";}?>><?php echo $currency[$i]->currency_code;?></option>
                    <?php } ?>                  
                  </select>
                </div>
             
              </div>
           
             
            </div>
            <ul class="pager wizard">
              <input id="todo" type="hidden" name="todo">
              <li class="next">
                <a class="btn btn-success todo" value="1">Save and Continue</a>
              </li>
              <li class="first">
                <a class="btn btn-success todo" value="0" style="float: right;margin-right: 20px">Save</a>
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
  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
   <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/wysihtml5-0.3.0.min.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/bootstrap-wysihtml5.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/adapters/jquery.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript">
$('.todo').on('click', function(){
  var todo = $(this).attr('value'); 
   $('#todo').val(todo);
    CKEDITOR.instances[name];
   var form = $('form[name="step1"]');   
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      }
      else{

    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
    $ins_id = $("#insert_id").val();
     var steps = 'step1';    
    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>hotel/update_'+steps+'/'+$ins_id,
      data: form.serialize(),
      dataType: 'json',
      success: function(data) {
        $("#insert_id").val(data.insert_id);
         $ins_id1 = $("#insert_id").val();     
        
        if(todo == '1'){
         location.href='<?php echo site_url();?>hotel/edit_step2?id='+$ins_id1;
        } else{
          location.href='<?php echo site_url();?>hotel/edit_hotel?id='+$ins_id1;
        }
      }
    });
}
      
});
</script>
<script>
$(document).ready(function() {
  $(".select2").select2({  
  });
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
  <script type="text/javascript">
  $(document).ready(function(e) {
    var $input = $('#refresh');  
    if($input.val() == 'yes'){
      location.reload(true);
    }else{
         $input.val('yes');
    }
  });
</script>