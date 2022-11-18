<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<script type="text/javascript">
  var site_url='<?php echo site_url();?>';
  var base_url='<?php echo base_url();?>';  
</script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <div class="page-bar br-5">
            <div class="form-group">
              <ul class="page-breadcrumb">
                <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a href="">Manage Room Allotment</a></li>
                <li><a class="active" href="<?php echo site_url(); ?>roomsallotment/add">Add Room Allotment</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font">Add Room Allotment</h1>
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
               <div class="alert alert-<?php echo $class ?>">
            <button class="close" data-dismiss="alert" type="button">×</button>
            <strong><?php echo ucfirst($class) ?>....!</strong>
            <?php echo $message; ?>
          </div>
          <?php } ?>      
        </div> 
          <div class="boxs-body">  
        <form>    
              <div class="row border_row"> 
                <div class="form-group col-md-6">
                 <label class="strong" for="hotel_id">Select Hotel: </label>
                 <select class="form-control select2" name="hotel_id" id="hotel_id" required="required">
                   <option value="" selected="selected">Select Hotel</option>
                   <?php foreach($hotel_list as $val){?>
                   <option value="<?php echo $val->supplier_hotel_list_id;?>">
                     <?php echo $val->hotel_name;?>
                   </option>
                   <?php } ?>
                 </select>
               </div> 
              <div class="form-group col-md-6">
                 <label class="strong" for="contract">Select Contract: </label>
                <select class="form-control select2" name="contract" id="contract" required="required">
                   <option value="" selected="selected">Select Contract</option>
                
                 </select>
               </div>                              
              
               </div>
              <div class="row border_row">  
                  <div class="form-group col-md-6">
                <label class="strong">Period : </label>
                 <div class="row" style="margin-left:1px;"> 
                <div class="form-group col-md-6">
                <input type="text" class="form-control selectdate" id="from_date" name="from_date" placeholder="Select From Date" required="required">
                </div>
                 <div class="form-group col-md-6">
                 <input type="text" class="form-control selectdate" id="to_date" name="to_date" placeholder="Select To Date" required="required">
               </div>
              </div>
              </div>
              <div class="form-group col-md-6">
                 <label class="strong" for="room_id">Select Room: </label>
                <select class="form-control select2" name="room_id" id="room_id" required="required">
                   <option value="" selected="selected">Select Room</option>
                  
                 </select>
               
              
               </div>                            
              <!--   <div class="form-group col-md-6">
                 <label class="strong" for="market">Select Market: </label>
                 <select class="form-control select2" name="market" id="market" required="required">
                   <option value="" selected="selected">Select Market</option>                
                 </select>
               </div> -->
               </div>
              <div class="row border_row"> 
                <div class="form-group col-md-6">
                 <label class="strong" for="room_allotment_type">Select Allotment Type: </label>
                 <select class="form-control select2" name="room_allotment_type" id="room_allotment_type" required="required">
                 <option value="">Select Allotment Type</option> 
                 <option value="freesell">Free Sale(No Limit)</option>
                 <option value="stopsell">Stop Sale</option>
                 <option value="quantity">Quantity</option>
                 </select>
               </div> 
              <div class="form-group col-md-6" id="rooms_allotment" style="display: none;">
                 <label class="strong" for="contract">Enter Number of rooms: </label>
                 <input type="text" class="form-control" id="rooms_available" name="rooms_available" placeholder="Enter Number of rooms" value="0" required="required">
               </div>                              
              
               </div>
                <div class="row border_row">  
            <!--   <div class="form-group col-md-6">
                 <label class="strong" for="meal_plan">Select Meal Plan: </label>
                <select class="form-control select2" name="meal_plan" id="meal_plan" required="required">
                   <option value="" selected="selected">Select Meal Plan</option>
                  
                 </select>
              </div> -->
              <div class="form-group col-md-6" id="contractduration" style="display: none;">
                 <label class="strong" for="meal_plan">Contract Duration: </label>
                 <h5 id="contract_duration"></h5>
              </div>
             </div>
               <div class="row border_row"> 
              <div class="form-group col-md-6 check_icon">                 
               <!--  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="checkbox" class="flat"   name="duplicate" value="duplicate">
              <i></i> Duplicate Existing Rate
              </label>      -->          
              </div> 
               <div class="form-group col-md-2">
                 <input  class="btn btn-success todo" type="button" value="Add Room Allotment" />
               </div>
             </div>
          </form>
       </div>
     </section>
   </div>
 </div>
</div>
</section>
<?php echo $this->load->view('data_tables_js'); ?>
 <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/custom/customize.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<script>
 $('#hotel_id').val('').change();
  $(document).ready(function() {
    $(".select2").select2({});  
  });
</script>
<script type="text/javascript">
  $('#room_allotment_type').on('change', function(){
  $allotment_type = $(this).val();
  if($allotment_type=='freesell')
  {
    $("#rooms_available").val('-1');   
    $("#rooms_allotment").css('display','none');
  
  }
   if($allotment_type=='stopsell')
  {
    $("#rooms_available").val('0');   
     $("#rooms_allotment").css('display','none');
  
  }
   if($allotment_type=='quantity')
  {
    $("#rooms_available").val('');   
     $("#rooms_allotment").css('display','block');
  
  }
   
});
</script>
<script type="text/javascript">
$('.todo').on('click', function(){
  var Num=/^(0|[1-9][0-9]*)$/;
 $allotment_type =  $('#room_allotment_type').val();
  var form = $('form');
  // $val=form.getAttribute('data-action');
 form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      }
         if(!Num.test($("#rooms_available").val())&&$allotment_type=='quantity'){
          alert("Enter Numberic Value For Number of rooms");
           $('#rooms_available').val('');
           $('#rooms_available').focus();
           return false;
         } 
 
    if(parseInt($("#rooms_available").val())==0&&$allotment_type=='quantity') {  
   alert("Number of rooms should be greater than zero !!!");
           $('#rooms_available').val('');
           $('#rooms_available').focus();
           return false;
   }  
         
      else
      {
        // form.submit();
         $.ajax({
      type: "POST",
      url: site_url + 'roomsallotment/add_rooms_allotment',
      data : form.serialize(),
      dataType : 'json',    
      success: function(data) {      
    
      alert(data.result);
    
     
     }
     });
      }
 
     
});
</script>
<script type="text/javascript">
  $('#hotel_id').on('change', function(){
  $id = $(this).val();
  $.ajax({
    url: site_url+'roomsallotment/get_hotel_details/',
    data: {id:$id},
    dataType: 'json',
    type: 'POST',
    success: function(data) {   
      $("#contract").html(data.contract_list);      
      $("#room_id").html(data.room_list);
      }
  });     
});
</script>
<script type="text/javascript">
  $('#contract').on('change', function(){
   $("#contract_duration").html(''); 
   $("#contractduration").css('display','none');
  $id = $(this).val();
  $.ajax({
    url: site_url+'roomsallotment/get_market_details/',
    data: {id:$id},
    dataType: 'json',
    type: 'POST',
    success: function(data) {   
      $("#market").html(data.market_list); 
      if(data.contract_duration!=''){
        $("#contract_duration").html(data.contract_duration); 
        $("#contractduration").css('display','block');
      }  
     
      }
  });     
});
</script>
<script type="text/javascript">
  $('#room_id').on('change', function(){
  $id = $(this).val();
  $.ajax({
    url: site_url+'roomsallotment/get_mealplan_details/',
    data: {id:$id},
    dataType: 'json',
    type: 'POST',
    success: function(data) {   
      $("#meal_plan").html(data.meal_list);   
     }
  });     
});
</script>
<script type="text/javascript"> 
$(function() { 
   var dateToday = new Date();
  $('.selectdate').daterangepicker({  
    autoUpdateInput: false,
    showDropdowns: true,
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
           format: 'DD-MM-YYYY'
      }
  });

  $('.selectdate').on('apply.daterangepicker', function(ev, picker) {
      $('input[name="from_date"]').val(picker.startDate.format('DD-MM-YYYY'));
      $('input[name="to_date"]').val(picker.endDate.format('DD-MM-YYYY'));
  });

  $('.selectdate').on('cancel.daterangepicker', function(ev, picker) {
       $('input[name="from_date"]').val('');
      $('input[name="to_date"]').val('');
  });
});
</script>