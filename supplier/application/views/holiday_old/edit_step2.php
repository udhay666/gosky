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
          <li class="active"><a href="<?php echo site_url() ?>holiday/edit_step2?id=<?php echo $package_id ?>"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Overview/Highlights</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step3?id=<?php echo $package_id ?>"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Itinerary</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step4?id=<?php echo $package_id ?>"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Includes/Excludes</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step5?id=<?php echo $package_id ?>"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Important Info</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step6?id=<?php echo $package_id ?>"><span class="step_no wizard-step">6</span><span class="step_descr">Step 6<br><small>Routing(Map)</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step7?id=<?php echo $package_id ?>"><span class="step_no wizard-step">7</span><span class="step_descr">Step 7<br><small>Activities(Optional)</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step8?id=<?php echo $package_id ?>"><span class="step_no wizard-step">8</span><span class="step_descr">Step 8<br><small>Attraction(Optional)</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step9?id=<?php echo $package_id ?>"><span class="step_no wizard-step">9</span><span class="step_descr">Step 9<br><small>Images(Preview &amp; Save)</small></span></a></li>
        </ul>
        <div class="tab-content">
          <form action="<?php echo site_url() ?>holiday/update_all" method="post" name="step2" class="step_form step2" steps="2" method="POST" role="form" enctype="multipart/form-data">
            <div class="tab-pane active" id="step-2">
              <input type="hidden" name="steps" value="2">
              <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $package_id ?>">
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Overview</label>
                  <textarea name="overview" class="form-control ckeditor" rows="3" cols="100"><?php echo $package_info->overview ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Highlights</label>
                  <textarea name="highlights" class="form-control ckeditor" rows="3" cols="100"><?php echo $package_info->highlights ?></textarea>
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

  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/wysihtml5-0.3.0.min.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/bootstrap-wysihtml5.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/adapters/jquery.js"></script>

  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>

