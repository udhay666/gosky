<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link href="<?php echo base_url();?>public/js/bootstrap-timepicker.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2><span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Contract</a></li>
              <li><a class="active" href="<?php echo site_url() ?>contract/edit_step3?id=<?php echo $id ?>">Edit Contract Details</a></li>
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
     <?php $this->load->view('contract/contract_summary');?>
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <?php
          $data['steps'] = '4';
          echo $this->load->view('contract/steps', $data);
        ?>
        <div class="tab-content">
          <form action="" method="post" class="step_form step3" steps="4" name="step3" role="form">
            <input type="hidden" name="steps" value="4">
            <input type="hidden" name="insert_id" id="insert_id" value="1">
            <div class="tab-pane active" id="step-4">             
              <div class="row border_row">
               <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat rate_type"   name="rate_type" value="net">
              <i></i> NET RATES 
              </label>               
              </div> 
              <div class="form-group col-md-6 check_icon">                 
            <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat rate_type"   name="rate_type" value="gross" checked="checked">
              <i></i> GROSS RATES 
              </label> 

          </div>                 
                </div>
                 <div class="row border_row">
                  <div class="form-group col-md-4">
                  </div> 
                  <div class="form-group col-md-8">
                   <label class="strong" for="specialoffer_code">Please Specify your commission : </label>
                   
                   
                  </div> 
                 </div>
                <div class="row border_row">
                <div class="form-group col-md-4"></div>
                 <div class="form-group col-md-4">
                  <input type="text" class="form-control rate_percent"   name="rate_percent">
                 </div>
                 <div class="form-group col-md-4">
                    <select class="form-control select2" name="commissiontype" required="required">
                     <option value="">Select</option>
                     <option value="1">Percent</option>                                 
                   </select>
                 </div>
                 </div>
                  <div class="row border_row">
               
                <div class="form-group col-md-6 check_icon">  
                  <label class="strong">Vat Set Up :</label>               
            <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="checkbox" class="flat vat_applicable"   name="vat_applicable" value="1" checked="checked">
              <i></i> Applicable for this hotel
              </label> 

          </div> 
          </div>
            <div class="row border_row">
               
                <div class="form-group col-md-6">  
                  <label class="strong">Vat value(%) :</label>               
            
              <input type="text" class="form-control vat_percentage"   name="vat_percentage">
           

          </div> 
                  
                </div>
              </div>
              <ul class="pager wizard">
                <input id="todo" type="hidden" name="todo">
                <li class="next">
                  <button class="btn btn-success todo" value="1">Save and Continue</button>
                </li>
                <li class="first">
                  <button class="btn btn-success todo" value="0" style="float: right;margin-right: 20px">Save</button>
                </li>
              </ul>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
</div>
</section>
<!-- sctipts -->
  <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>

  <script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/bootstrap-timepicker.min.js"></script>

  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript">
// $('.todo').on('click', function(){
//   var data = $(this).val();
//   $('#todo').val(data);
//    var form = $('form');   
//       form.parsley().validate();
//       if (!form.parsley().isValid()) {
//           return false;
//       }
// });

$('.todo').on('click', function(){
  $ins_id = $("#insert_id").val();   
  var todo=$(this).attr('value');
        if(todo == 1){
          window.location.replace('<?php echo site_url();?>contract/edit_step5?id='+$ins_id);
        } else{
          window.location.replace('<?php echo site_url();?>contract/edit_step4?id='+$ins_id);
        }    
});
</script>
<script type="text/javascript">
$('#timepicker1,#timepicker2').timepicker();
</script>