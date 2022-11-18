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
          <li><a href="<?php echo site_url() ?>holiday/edit_holiday?id=<?php echo $package_id ?>"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>Basic Package Info</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step2?id=<?php echo $package_id ?>"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Overview/Highlights</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step3?id=<?php echo $package_id ?>"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Itinerary</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step4?id=<?php echo $package_id ?>"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Includes/Excludes</small></span></a></li>
          <li class="active"><a href="<?php echo site_url() ?>holiday/edit_step5?id=<?php echo $package_id ?>"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Important Info</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step6?id=<?php echo $package_id ?>"><span class="step_no wizard-step">6</span><span class="step_descr">Step 6<br><small>Routing(Map)</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step7?id=<?php echo $package_id ?>"><span class="step_no wizard-step">7</span><span class="step_descr">Step 7<br><small>Activities(Optional)</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step8?id=<?php echo $package_id ?>"><span class="step_no wizard-step">8</span><span class="step_descr">Step 8<br><small>Attraction(Optional)</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step9?id=<?php echo $package_id ?>"><span class="step_no wizard-step">9</span><span class="step_descr">Step 9<br><small>Images(Preview &amp; Save)</small></span></a></li>
        </ul>
        <div class="tab-content">
          <form action="<?php echo site_url() ?>holiday/update_all" method="post" class="step_form step5" steps="5" name="step5" role="form" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="steps" value="5">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $package_id ?>">
            <div class="tab-pane active" id="step-5">
                <div class="row border_row">
                  <div class="form-group col-sm-12">
                    <label class="strong">Cancellation Policy</label>
                    <textarea name="cancellation_policy" class="form-control ckeditor" rows="3" cols="100"><?php echo $package_info->cancellation_policy ?></textarea>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-sm-12">
                    <label class="strong">Child Policy</label>
                    <textarea name="child_policy" class="form-control ckeditor" rows="3" cols="100"><?php echo $package_info->child_policy ?></textarea>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-sm-12">
                    <label class="strong">Pet Policy</label>
                    <textarea name="pet_policy" class="form-control ckeditor" rows="3" cols="100"><?php echo $package_info->pet_policy ?></textarea>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-sm-6">
                    <label class="strong">Voltage</label>
                    <select name="voltage" class="form-control">
                      <option value="100V" <?php echo $package_info->voltage='100V'?'selected':'' ?>>100V</option>
                      <option value="250V" <?php echo $package_info->voltage='250V'?'selected':'' ?>>250V</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-6">
                    <label class="strong">Currency</label>
                    <select name="currency" class="form-control">
                      <option value="Dollar" <?php echo $package_info->currency='Dollar'?'selected':'' ?>>Dollar</option>
                      <option value="Euro" <?php echo $package_info->currency='Euro'?'selected':'' ?>>Euro</option>
                      <option value="Rupee" <?php echo $package_info->currency='Rupee'?'selected':'' ?>>Rupee</option>
                    </select>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-sm-12">
                    <label class="strong">Passport/Visa</label>
                    <textarea name="passport_visa" class="form-control ckeditor" rows="3" cols="100"><?php echo $package_info->passport_visa ?></textarea>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-sm-12">
                    <label class="strong">Medical Health</label>
                    <textarea name="medical_health" class="form-control ckeditor" rows="3" cols="100"><?php echo $package_info->medical_health ?></textarea>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-sm-12">
                    <label class="strong">Travel Insurance</label>
                    <textarea name="travel_insurance" class="form-control ckeditor" rows="3" cols="100"><?php echo $package_info->travel_insurance ?></textarea>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-sm-12">
                    <label class="strong">Weather</label>
                    <textarea name="weather" class="form-control ckeditor" rows="3" cols="100"><?php echo $package_info->weather ?></textarea>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-sm-12">
                    <label class="strong">Food and Dietary Requirements</label>
                    <textarea name="food_requirement" class="form-control ckeditor" rows="3" cols="100"><?php echo $package_info->food_requirement ?></textarea>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-sm-12">
                    <label class="strong">Safety</label>
                    <textarea name="safety" class="form-control ckeditor" rows="3" cols="100"><?php echo $package_info->safety ?></textarea>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-sm-12">
                    <label class="strong">Clothing</label>
                    <textarea name="clothing" class="form-control ckeditor" rows="3" cols="100"><?php echo $package_info->clothing ?></textarea>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-sm-12">
                    <label class="strong">Accommodation</label>
                    <textarea name="accomodation" class="form-control ckeditor" rows="3" cols="100"><?php echo $package_info->accomodation ?></textarea>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-sm-12">
                    <label class="strong">Insurance</label>
                    <textarea name="insurance" class="form-control ckeditor" rows="3" cols="100"><?php echo $package_info->insurance ?></textarea>
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
<!--/ custom javascripts -->
