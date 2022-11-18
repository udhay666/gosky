<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/nestable/css/style.css">
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
          <li><a href="<?php echo site_url() ?>holiday/edit_step5?id=<?php echo $package_id ?>"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Important Info</small></span></a></li>
          <li class="active"><a href="<?php echo site_url() ?>holiday/edit_step6?id=<?php echo $package_id ?>"><span class="step_no wizard-step">6</span><span class="step_descr">Step 6<br><small>Routing(Map)</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step7?id=<?php echo $package_id ?>"><span class="step_no wizard-step">7</span><span class="step_descr">Step 7<br><small>Activities(Optional)</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step8?id=<?php echo $package_id ?>"><span class="step_no wizard-step">8</span><span class="step_descr">Step 8<br><small>Attraction(Optional)</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step9?id=<?php echo $package_id ?>"><span class="step_no wizard-step">9</span><span class="step_descr">Step 9<br><small>Images(Preview &amp; Save)</small></span></a></li>
        </ul>
        <div class="tab-content">
          <form action="<?php echo site_url() ?>holiday/update_all" method="post"  class="step_form step6" steps="6" name="step6" role="form" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="steps" value="6">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $package_id ?>">
            <div class="tab-pane active" id="step-6">
              <div class="row">
                <div class="col-md-12">
                  <section class="boxs">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font">Sorting Location <small>(Drag and drop to the desired places)</small></h1>
                      <ul class="controls">
                        <li><a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span></a></li>
                      </ul>
                    </div>

                    <?php //echo '<pre>';print_r($transport_type);exit; ?>

                    <div class="boxs-body">
                      <!-- <ol class="col-sm-1 dd-list2 day_sl">
                        <?php for($i=0;$i<count($transport_type);$i++) { ?>
                        <li class="dd-item"><span>Day <?php echo  $i+1 ?></span></li>
                        <?php } ?>
                      </ol> -->
                      <div class="row dd nestable-tree" id="nestable">
                        <ol class="col-sm-5 dd-list">
                          <?php if(!empty($transport_type)){ ?>
                          <?php for($t=0;$t<count($transport_type);$t++){ ?>
                          <li class="dd-item" data-id="<?php echo $transport_type[$t]->location_from ?>" data-location="<?php $city_name = $this->holiday_city->get_iti_city($transport_type[$t]->location_from); echo $city_name[0]->city_name; ?>">
                            <div class="dd-handle"><?php $city_name = $this->holiday_city->get_iti_city($transport_type[$t]->location_from); echo $city_name[0]->city_name; ?></div>
                          </li>
                          <?php } ?>
                          <li class="dd-item" data-id="<?php echo end($transport_type)->location_to ?>" data-location="<?php $city_name = $this->holiday_city->get_iti_city(end($transport_type)->location_to); echo $city_name[0]->city_name; ?>">
                            <div class="dd-handle"><?php $city_name = $this->holiday_city->get_iti_city(end($transport_type)->location_to); echo $city_name[0]->city_name; ?></div>
                          </li>
                          <?php } ?>
                        </ol>
                      </div>
                      <br/>
                      <div id="output">
                        <?php if(!empty($transport_type)){ ?>
                        <?php for($i=0;$i<count($transport_type);$i++){ ?>
                          <div class="row trans_row">
                            <div class="col-sm-12">
                              <div class="col-sm-3">
                                <div class="col-sm-5">
                                  <!-- <?php echo $transport_type[$i]->location_from ?> -->
                                  <?php $city_name = $this->holiday_city->get_iti_city($transport_type[$i]->location_from); echo $city_name[0]->city_name; ?>
                                  <input type="hidden" name="location_from[]" value="<?php echo $transport_type[$i]->location_from ?>">
                                </div>
                                <div class="col-sm-2">→</div>
                                <div class="col-sm-5">
                                  <!-- <?php echo $transport_type[$i]->location_to ?> -->
                                  <?php $city_name = $this->holiday_city->get_iti_city($transport_type[$i]->location_to); echo $city_name[0]->city_name; ?>
                                  <input type="hidden" name="location_to[]" value="<?php echo $transport_type[$i]->location_to ?>">
                                </div>
                              </div>
                              <div class="col-sm-3">
                                <select name="transport_type[]" class="form-control">
                                  <option value="Flight" <?php echo $transport_type[$i]->transport_type == 'Flight' ? 'selected' : '' ?>>Flight</option>
                                  <option value="Bus" <?php echo $transport_type[$i]->transport_type == 'Bus' ? 'selected' : '' ?>>Bus</option>
                                  <option value="Train" <?php echo $transport_type[$i]->transport_type == 'Train' ? 'selected' : '' ?>>Train</option>
                                  <option value="Ship" <?php echo $transport_type[$i]->transport_type == 'Ship' ? 'selected' : '' ?>>Ship</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                        <?php } ?>
                      </div>
                    </div>
                  </section>
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
<script src="<?php echo base_url(); ?>public/js/vendor/nestable/jquery.nestable.js"></script> 
<script src="<?php echo base_url(); ?>public/js/main.js"></script>

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