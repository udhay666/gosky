<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link href="<?php echo base_url();?>public/js/bootstrap-timepicker.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
  var site_url='<?php echo site_url(); ?>';
</script>
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
          $data['steps'] = '3';
          echo $this->load->view('contract/steps', $data);
        ?>
        <div class="tab-content">
          <form data-action="contract/update_step3/<?php echo $contract_id; ?>" class="step_form step3" steps="3" name="step3" role="form">
            <input type="hidden" name="steps" value="3">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $id ?>">
            <div class="tab-pane active" id="step-3">             
              <div class="row border_row">
               <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat rate_type"   name="rate_type" value="net" <?php if($contract_info[0]->rate_type=='net'){echo 'checked="checked"';}?>>
              <i></i> NET RATES 
              </label>               
              </div> 
              <div class="form-group col-md-6 check_icon">                 
            <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat rate_type"   name="rate_type" value="gross" <?php if(empty($contract_info[0]->rate_type)){echo 'checked="checked"';} else if($contract_info[0]->rate_type=='gross'){echo 'checked="checked"';}?>>
              <i></i> GROSS RATES 
              </label> 

          </div>                 
                </div>
               
                <div class="row border_row">
                <div class="form-group col-md-4"></div>
                 <div class="form-group col-md-4">
                   <label class="strong" for="commission">Please Specify your commission : </label>
                  <input type="text" value="<?php echo $contract_info[0]->commission;?>" class="form-control commission" id="commission"  name="commission">
                 </div>
                 <div class="form-group col-md-4">
                  <label class="strong" for="commission">Commission Type: </label>
                    <select class="form-control select2" name="commissiontype"> 
                     <option value="" selected="selected">Select</option>
                     <option value="percent">Percent</option>
                    <option value="percent">Fixed</option>
                     </select>
                 </div>
                 </div>
                  <div class="row border_row">
               
                <div class="form-group col-md-6 check_icon">  
                  <label class="strong">Vat Set Up :</label>               
            <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="checkbox" class="flat vat_applicable"   name="vat_applicable" id="vat_applicable" value="1" <?php if(!empty($contract_info[0]->vat_applicable)){echo 'checked="checked"';}?>>
              <i></i> Applicable for this hotel
              </label> 

          </div> 
          </div>
            <div class="row border_row">
               
                <div class="form-group col-md-6">  
                  <label class="strong">Vat value(%) :</label>               
            
              <input type="text" class="form-control" id="vat_percentage" value="<?php echo $contract_info[0]->vat_percentage;?>"  name="vat_percentage">
           

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
 <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/bootstrap-timepicker.min.js"></script>

  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript">
$('.todo').on('click', function(){
  $ins_id = $("#insert_id").val();   
  var todo=$(this).attr('value');
  var deciNum= /^[0-9]+(\.\d{1,3})?$/;
  var form = $('form[name="step3"]'); 
   $val=form.attr('data-action');  
   $rate_type=$(".rate_type:checked").val(); 
   if($rate_type=='gross'){
  if(!deciNum.test($("#commission").val())){
          alert("Enter Either Numberic  or Decimal Value For Commission");
           $('#commission').val('');
            $('#commission').focus();
           return false;
         }
  if($("select[name='commissiontype']").val()==''){
          alert("Select Commission Type");
           $("select[name='commissiontype']").val('');
            $("select[name='commissiontype']").focus();
           return false;
         }
       }
  if($("#vat_applicable:checked").val()==1)
  {
     if(!deciNum.test($("#vat_percentage").val())){
          alert("Enter Either Numberic  or Decimal Value For Vat value");
           $('#vat_percentage').val('');
            $('#vat_percentage').focus();
           return false;
         }
  }
  else
  {
    $("#vat_percentage").val('0');
  }
 
     form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } 
      else
      {  
   $.ajax({
      type: "POST",
      url: site_url + $val,
      data :form.serialize(),
      dataType : 'json', 
     success: function(data) {  
       if(todo == 1){
          window.location.replace('<?php echo site_url();?>contract/edit_step4?id='+$ins_id);
        } else{
          window.location.replace('<?php echo site_url();?>contract/edit_step3?id='+$ins_id);
        }  
  
     
    }
 
    });
 }
});
</script>
<script type="text/javascript">
 $(document).ready( function() {
  
 $(".rate_type").change(function()
    {
      if($(this).val()=='net'){ 
      $("input[name='commission']").val('');
      $("input[name='commission']").prop('disabled',true);    
      $("select[name='commissiontype']").val('').change();  
      $("select[name='commissiontype']").prop('disabled',true);
     
      } 
      else if($(this).val()=='gross'){      
     $("input[name='commission']").val('');
      $("input[name='commission']").prop('disabled',false);    
      $("select[name='commissiontype']").val('').change();  
      $("select[name='commissiontype']").prop('disabled',false);
       } 
    });
  }); 

</script>
<?php $this->load->view('contract/contract_footer'); ?>
<?php if($contract_info[0]->rate_type=='net'){ ?>
<script type="text/javascript">
    $("input[name='commission']").val('');
      $("input[name='commission']").prop('disabled',true);    
      $("select[name='commissiontype']").val('').change();  
      $("select[name='commissiontype']").prop('disabled',true);
</script>
<?php } ?>
<script>
$(document).ready(function() {
  $(".select2").select2({  
  });
});
</script>
