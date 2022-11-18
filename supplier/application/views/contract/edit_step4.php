<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link href="<?php echo base_url();?>public/js/bootstrap-timepicker.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
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
              <li><a class="active" href="<?php echo site_url() ?>contract/edit_step4?id=<?php echo $id ?>">Edit Contract Details</a></li>
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
          <form data-action="contract/update_step4/<?php echo $contract_id; ?>"  class="step_form step4" steps="4" name="step4" role="form">
            <input type="hidden" name="steps" value="4">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $id; ?>">
            <div class="tab-pane active" id="step-4">                 
              <div class="row border_row">
               <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat payment_type"   name="payment_type" value="PRE" required="required" <?php if($payment_credentials_info[0]->payment_type=='PRE'){echo 'checked="checked"';}?>>
              <i></i> This hotel is on PRE PAYMENT mode
              </label>               
              </div> 
                </div>
                <div class="row border_row">
                <div class="form-group col-md-2"></div>
                 <div class="form-group col-md-2"> <label class="strong">Payment Conditions :</label></div>
                 <div class="form-group col-md-2">
                  <label class="strong pull-right" >Payment on </label>
                  </div>
                   <div class="form-group col-md-3">
                 <input type="text" class="form-control Num" placeholder="Days"  name="pre_payment_days" value="<?php echo $payment_credentials_info[0]->pre_payment_days;?>" disabled="disabled"> 
                 </div>
                  <div class="form-group col-md-1">
                   <label class="strong">Days </label>
                 </div>
                 <div class="form-group col-md-2">
                    <select class="form-control" name="before_checkin"> 
                  <option value="Before" selected="selected">Before Checkin</option>
                   </select>
                 </div>
                 </div>               
              <div class="row border_row">              
              <div class="form-group col-md-6 check_icon">                 
            <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat payment_type"   name="payment_type" value="POST" <?php if(empty($payment_credentials_info[0]->payment_type)){echo 'checked="checked"';} else if($payment_credentials_info[0]->payment_type=='POST'){echo 'checked="checked"';}?>>
              <i></i> This hotel is on POST PAYMENT mode
              </label> 
          </div>                 
                </div>
                 <div class="row border_row">
                  <div class="form-group col-md-2">
                   <label class="strong">Payment Conditions : </label>
                  </div>
                   <div class="form-group col-md-3 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat single_reservation"   name="single_reservation" value="Single Reservation" checked="checked" required="required">
              <i></i> Single Reservation
              </label>               
              </div> 
                <div class="form-group col-md-2">
                <input type="text" class="form-control Num" placeholder="Days"  name="post_payment_days"  value="<?php echo $payment_credentials_info[0]->post_payment_days;?>"> 
                 </div>
                  <div class="form-group col-md-1">
                   <label class="strong">Days </label>
                 </div>
                 <div class="form-group col-md-2">
                    <select class="form-control" name="after_checkin">  
                    <option value="After" selected="selected">After Checkin</option>
                   </select>
                 </div>
                  <div class="form-group col-md-2 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="checkbox" class="flat period"   id="period" value="1">
              <i></i> For Period
              </label>               
              </div> 
           </div>
           <div class="row border_row" id="showperiod" style="display:none;" >
                   <h5 style="font-weight: bold;margin-left: 10px;" >Periods:</h5>
                     <div class="form-group col-md-4">  
                     <select name="period" class="form-control select2">
                       <option value="">Select</option>
                       <?php for($i=1;$i<=31;$i++){ ?>
                       <option value="<?php echo $i?>" <?php if($i==$payment_credentials_info[0]->period){echo "selected";}?>><?php echo $i;?></option>
                       <?php } ?>
                     </select> Every Month Payment Date(Note If Month has no 31st date than Month last date will be 30th, Exception february month last date consider as either 28 or 29 according to leap year)
                    </div> 
                  </div>  
                 <h5 style="margin-left: 10px;font-weight: bold;">Payment Details</h5>
                <div class="row border_row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4"><label class="strong">Account Name :</label> </div>
                 <div class="form-group col-md-4">
                  <input type="text" class="form-control"  name="account_name"   value="<?php echo $payment_credentials_info[0]->account_name;?>"required="required">
                 </div>                
                 </div>
                  <div class="row border_row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4"><label class="strong">Bank Name :</label> </div>
                 <div class="form-group col-md-4">
                  <input type="text" class="form-control" name="bank_name" value="<?php echo $payment_credentials_info[0]->bank_name;?>" required="required">
                 </div>                
                 </div>
                  <div class="row border_row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4"><label class="strong">Branch Office :</label> </div>
                 <div class="form-group col-md-4">
                  <input type="text" class="form-control"   name="branch_office"  value="<?php echo $payment_credentials_info[0]->branch_office;?>" required="required">
                 </div>                
                 </div>
                  <div class="row border_row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4"><label class="strong">Bank Address :</label> </div>
                 <div class="form-group col-md-4">
                  <textarea class="form-control"  rows="5" name="bank_address"  required="required"><?php echo $payment_credentials_info[0]->bank_address;?></textarea>
                 </div>                
                 </div>                
                  <div class="row border_row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4"><label class="strong">Account Number :</label> </div>
                 <div class="form-group col-md-4">
                  <input type="text" class="form-control"   name="account_number" value="<?php echo $payment_credentials_info[0]->account_number;?>" required="required">
                 </div>                
                 </div>
                  <div class="row border_row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4"><label class="strong">Swift Code :</label> </div>
                 <div class="form-group col-md-4">
                  <input type="text" class="form-control"   name="swift_code" value="<?php echo $payment_credentials_info[0]->swift_code;?>" required="required">
                 </div>                
                 </div>
                   <div class="row border_row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4"><label class="strong">IBAN :</label> </div>
                 <div class="form-group col-md-4">
                  <input type="text" class="form-control"   name="iban" value="<?php echo $payment_credentials_info[0]->iban;?>"  required="required">
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
  <script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/bootstrap-timepicker.min.js"></script>
   <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript">
 $(document).ready( function() {
  $("#period").click(function(){
    if($(this).prop("checked") == true){
       $("#showperiod").css("display","block");
       $("select[name='period']").val('').change();
     }
     else if($(this).prop("checked") == false){
       $("#showperiod").css("display","none");
       $("input[name='pre_payment_days']").val('');
     }
  })
 $(".payment_type").change(function()
    {
      if($(this).val()=='PRE'){ 
      $("input[name='pre_payment_days']").prop('disabled',false);
       $("input[name='before_checkin']").prop('disabled',false);  
       $("input[name='post_payment_days']").val('');  
       $("input[name='post_payment_days']").prop('disabled',true);
       $("select[name='after_checkin']").prop('disabled',true);
       $("#showperiod").css("display","none");
       $("input[name='pre_payment_days']").val('');
        $("#period").prop('checked',false);
       $("#period").prop('disabled',true);      
      } 
      else if($(this).val()=='POST'){      
       $("input[name='post_payment_days']").prop('disabled',false);
       $("input[name='after_checkin']").prop('disabled',false);
       $("#period").prop('disabled',false);
       $("input[name='pre_payment_days']").val('');
       $("input[name='pre_payment_days']").prop('disabled',true);
       $("select[name='before_checkin']").prop('disabled',true);  
       } 
    });
  });  
$('.todo').on('click', function(){
  $ins_id = $("#insert_id").val();   
  var todo=$(this).attr('value');
  var Num=/^(0|[1-9][0-9]*)$/;   
  var form = $('form[name="step4"]'); 
  $val=form.attr('data-action');
   $payment_type=$(".payment_type:checked").val();  
 if($payment_type=="PRE")
 {
  if($("input[name='pre_payment_days']").val()==''){
          alert("Enter No of Days");
        $("input[name='pre_payment_days']").val('');
        $("input[name='pre_payment_days']").focus();
           return false;
         }
  else if(!Num.test($("input[name='pre_payment_days']").val())){
          alert("Enter Only Numberic Value For Days");
          $("input[name='pre_payment_days']").val('');
         $("input[name='pre_payment_days']").focus();
           return false;
         }
 }
 else if($payment_type=="POST")
 {
  if($("input[name='post_payment_days']").val()==''){
          alert("Enter No of Days");
          $("input[name='post_payment_days']").val('');
          $("input[name='post_payment_days']").focus();
           return false;
         }
  else if(!Num.test($("input[name='post_payment_days']").val())){
          alert("Enter Only Numberic Value For Days");
          $("input[name='post_payment_days']").val('');
          $("input[name='post_payment_days']").focus();
           return false;
         }

   
    if($("#period").prop("checked") == true){
       if($("select[name='period']").val()==''){
        alert("Select Period Date");
        $("select[name='period']").focus();
        return false

       }
     }    

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
        alert(data.result);
      if(todo == 1){
          window.location.replace('<?php echo site_url();?>contract/edit_step5?id='+$ins_id);
        } else{
          window.location.replace('<?php echo site_url();?>contract/edit_step4?id='+$ins_id);
        }  
     
    }
 
    });
 }
});
</script>
<script type="text/javascript">
$('#timepicker1,#timepicker2').timepicker();
</script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<script type="text/javascript"> 
$(function() { 
   var dateToday = new Date();
  $('.selectdate').daterangepicker({  
    singleDatePicker: true,
    autoUpdateInput: false,
    showDropdowns: false,
   "minDate": dateToday,
    daysOfWeek: [
            "Su",
            "Mo",
            "Tu",
            "We",
            "Th",
            "Fr",
            "Sa"
        ],
     monthNames: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ],  
      locale: {
          cancelLabel: 'Clear',
           format: 'DD/MM/YYYY'
      }
  });

  $('.selectdate').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY'));
  });

  $('.selectdate').on('cancel.daterangepicker', function(ev, picker) {
       $(this).val('');
  });
});
</script>
<?php $this->load->view('contract/contract_footer'); ?>
<?php if($payment_credentials_info[0]->payment_type=='PRE'){ ?>
<script type="text/javascript">
       $("input[name='pre_payment_days']").prop('disabled',false);
       $("input[name='before_checkin']").prop('disabled',false);  
       $("input[name='post_payment_days']").val('');  
       $("input[name='post_payment_days']").prop('disabled',true);
       $("select[name='after_checkin']").prop('disabled',true);
       $("#showperiod").css("display","none");      
        $("#period").prop('checked',false);
       $("#period").prop('disabled',true);      
</script>
<?php } else if($payment_credentials_info[0]->payment_type=='POST'){ ?>
<script type="text/javascript">
     $("input[name='post_payment_days']").prop('disabled',false);
       $("input[name='after_checkin']").prop('disabled',false);
       $("#period").prop('disabled',false);
       $("input[name='pre_payment_days']").val('');
       $("input[name='pre_payment_days']").prop('disabled',true);
       $("select[name='before_checkin']").prop('disabled',true);   
       if($("select[name='period']").val()!=''){
            $("#period").prop("checked","true");
           $("#showperiod").css("display","block");
       }
           
</script>
<?php } ?>
<script>
$(document).ready(function() {
  $(".select2").select2({  
  });
});
</script>
