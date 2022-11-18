<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/datepicker3.css">

<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">
<link href="<?php echo base_url();?>public/js/bootstrap-timepicker.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<style type="text/css">
  .form-control[readonly]{
    background: white;
  }
</style>
<script type="text/javascript">
  var site_url='<?php echo site_url();?>';
</script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">      
         <div class="page-bar  br-5">
          <ul class="page-breadcrumb">
            <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>  
            <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>              
            <li><a class="active" href="<?php echo site_url() ?>contract/new_contract">Add New Contract</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <section class="boxs">
        <div class="boxs-header dvd dvd-btm">
          <h1 class="custom-font">Add New Contract</h1>
          <ul class="controls">
            <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
          </ul>
        </div>
        <div class="boxs-body">
          <?php 
          $sess_msg = $this->session->flashdata('message');
          $errors_msg=$this->session->flashdata('errors_msg');
          if(!empty($sess_msg)){
            $message = $sess_msg;
            $class = 'success';
          }else if(!empty($errors_msg)){
            $message = $errors_msg;
            $class = 'danger';
          }
          else {
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
        </div>
        <div class="boxs-body">    
         <form action="<?php echo site_url();?>contract/add_contract" method="post" class="step_form step1" steps="1" name="step1" role="form">
          <div class="row">            
            <div class="form-group col-md-4">
             <label class="strong" for="hotels">Select Hotel: </label>
             <select class="form-control select2" id="hotels" name="hotel_id" required="required">
               <option value="" selected="selected">Select Hotel</option>
               <?php foreach($hotel_list as $val){?>
               <option value="<?php echo $val->supplier_hotel_list_id;?>">
                 <?php echo $val->hotel_name;?>
               </option>
               <?php } ?>
             </select>
           </div>
           <div class="form-group col-md-8">
            <label class="strong" for="contract_desc">Description : </label>
            <input name="contract_desc" id="contract_desc" value="<?php echo set_value('contract_desc'); ?>" type="text" class="form-control" required>
          </div>              
        </div>
        <div class="row">
          <div class="form-group col-md-4">
            <label class="strong" for="start_date">Start Date : </label>
            <input type="text" name="start_date" id="start_date" value="<?php echo set_value('start_date'); ?>" class="form-control selectdate" readonly="readonly" required>
          </div>
          <div class="form-group col-md-4">
            <label class="strong" for="end_date">End Date : </label>
            <input type="text" name="end_date" id="end_date" value="<?php echo set_value('end_date'); ?>" readonly="readonly" class="form-control selectdate" required>
          </div>
          <div class="form-group col-md-4">
            <label class="strong" for="signed_date">Signed Date : </label>
            <input type="text" name="signed_date" id="signed_date" value="<?php echo set_value('signed_date'); ?>"  readonly="readonly" class="form-control" required>
          </div>
        </div>             
        <div class="row">
         <div class="form-group col-md-4">
          <label class="strong" for="status">Status is : in Progress</label>
        </div>
      </div>
      <div class="row">
       <div class="form-group col-md-6 check_icon">
        <label class="strong">Market Availability : </label>
        <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="all_market" class="flat" value="All Markets" checked="checked" id="all_market"><i></i> All Markets</label> 
      </div>
    </div>
    <div class="row">
      <div  class="form-group col-md-2">
        <label class="strong" for="exclude_market">Select Include Market: </label>
      </div>
      <div  class="form-group col-md-6">
       <select class="form-control" name="market_avail[]" id="market_avail" multiple="multiple" style="width: 75%">
        <?php foreach($country as $val){?>
        <option value="<?php echo $val->name;?>">
         <?php echo $val->name;?>
       </option>
       <?php } ?>
     </select>
   </div>
 </div>
 <div class="row">
   <div class="form-group col-md-2">
    <a onclick="getmarketlist()" class="btn btn-success btn-xs">Exclude</a>
  </div>
  <div  class="form-group col-md-8" id="getmarketlist">
  </div>
</div>
<div class="row">
  <div class="form-group col-md-4">
   <p style="background: pink;color: red;text-align: center;">Note : * Start Date must be Less than End Date</p>
 </div>
 <div class="form-group col-md-8"> <button class="btn btn-success todo" style="float: right;margin-right: 20px">Save</button></div>
</div>           
</form>
</div>
</div>
</section>
</div>
</div>
</div>
</section>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script type="text/javascript">
  $('.todo').on('click', function(){
    var data = $(this).val();
    $('#todo').val(data);
    var form = $('form');   
    form.parsley().validate();
    if (!form.parsley().isValid()) {
      return false;
    }
  });
</script>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<script type="text/javascript">

  $(function() { 
   $('#signed_date').daterangepicker({
    singleDatePicker: true,
    autoUpdateInput: false,
    showDropdowns: true,  
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
      format: 'DD-MM-YYYY'
    }
  });

   $('#signed_date').on('apply.daterangepicker', function(ev, picker) {
    $('input[name="signed_date"]').val(picker.startDate.format('DD-MM-YYYY'));
    
  });

   $('#signed_date').on('cancel.daterangepicker', function(ev, picker) {
     $('input[name="signed_date"]').val('');
     
   });

   $('.selectdate').daterangepicker({  
    autoUpdateInput: false,
    showDropdowns: true,  
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
      format: 'DD-MM-YYYY'
    }
  });

   $('.selectdate').on('apply.daterangepicker', function(ev, picker) {
    $('input[name="start_date"]').val(picker.startDate.format('DD-MM-YYYY'));
    $('input[name="end_date"]').val(picker.endDate.format('DD-MM-YYYY'));
  });

   $('.selectdate').on('cancel.daterangepicker', function(ev, picker) {
     $('input[name="start_date"]').val('');
     $('input[name="end_date"]').val('');
   });
 });
</script>
<script type="text/javascript">
  function getmarketlist()
  { 
   if($("#all_market").prop("checked") == true){
     $.ajax({
      url: site_url+'contract/getmarketlist/',
      data: '',
      dataType: 'json',
      type: 'POST',
      success: function(data) {      
       $("#getmarketlist").html(data.result);
     }    
   }); 
   } 
 }
</script>
<script>
  $(document).ready(function() {
    $(".select2").select2({  
    });
  });
</script>
<script>
  $(document).ready(function() {
    $.fn.select2.amd.require(['select2/selection/search'], function (Search) {
      var oldRemoveChoice = Search.prototype.searchRemoveChoice;    
      Search.prototype.searchRemoveChoice = function () {
        oldRemoveChoice.apply(this, arguments);
        this.$search.val('');
      };
      $("#market_avail").select2({  
        placeholder: "Select Include Market"
      });
    });
  });
</script>
<script type="text/javascript">
 $(document).ready( function() {
  if($("#all_market").prop("checked") == true){
   $("#market_avail").prop('required',false); 
   $("#market_avail").val('').change();
   $("#market_avail").prop("disabled",true);
 }
 $("#all_market").change(function(){
  if($("#all_market").prop("checked") == true){
   $("#market_avail").prop('required',false);      
   $("#market_avail").val('').change();
   $("#market_avail").prop("disabled",true);
 }
 else if($("#all_market").prop("checked") == false){
  $("#market_avail").prop('required',true);    
  $("#getmarketlist").html('');
  $("#market_avail").val('').change();
  $("#market_avail").prop("disabled",false);
}
})
});
</script>