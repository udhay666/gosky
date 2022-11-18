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
                <li><a href="">Manage Supplements Room Rates</a></li>
                <li><a class="active" href="<?php echo site_url(); ?>supplements/add">Add Supplements Room Rates</a></li>
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
            <h1 class="custom-font">Add Supplements Room Rates</h1>
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
                 <label class="strong" for="room_id">Select Room: </label>
                <select class="form-control select2" name="room_id" id="room_id" required="required">
                   <option value="" selected="selected">Select Room</option>
                  
                 </select>
               </div> 
                <div class="form-group col-md-6">
                 <label class="strong" for="meal_plan">Supplements Applicable on Meal Plan: </label>
                <select class="form-control select2" name="meal_plan[]" id="meal_plan" multiple="multiple" required="required">                 
                  
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
                 <label class="strong" for="market">Select Market: </label>
                 <select class="form-control select2" name="market" id="market" required="required">
                   <option value="" selected="selected">Select Market</option>                
                 </select>
               </div>
            </div>
            <div class="row border_row">            
              <div class="form-group col-md-6" id="contractduration" style="display: none;">
                 <label class="strong" for="contract_duration">Contract Duration: </label>
                 <h5 id="contract_duration"></h5>
              </div>
            </div>

          <div class="row border_row">  
               <div class="form-group col-md-6">
                  <label class="strong" for="supplement_roomrate_type">Selete Supplement Room Rate Type : </label>
                  <select name="supplement_roomrate_type"  id="supplement_roomrate_type" class="form-control select2" required="required">
                    <option value="">Select Supplement Room Rate Type</option>
                    <?php for($i=0;$i<count($specialoffer_type);$i++){ ?>
                    <option value="<?php echo $specialoffer_type[$i]->id; ?>"><?php echo $specialoffer_type[$i]->type; ?></option>
                    <?php } ?>  
                  <option value="other">Other</option>                 
                  </select>
              </div>  

              <div class="form-group col-md-6">
                 <label class="strong" for="supplement_meal_plan">Select Supplements Meal Plan: </label>
                <select class="form-control select2" name="supplement_meal_plan" id="supplement_meal_plan" required="required">                  
                 </select>
              </div>

             </div>

          <div class="row border_row" id="spec_offer_supplement">
           <div class="form-group col-md-6"> 
             <label class="strong">Special Offer Applicable On Supplement Rates</label> 
             <select class="form-control select2" name="spec_offer_applicable_supplement" id="spec_offer_applicable_supplement" required="required">
               <option value="" selected="selected">Select Option</option>                
               <option value="Yes">Yes</option>                
               <option value="No">No</option>                
             </select>
           </div>                      
          </div>

           <div class="row  border_row">
            <div class="form-group col-md-2">
             <label class="strong">Enter Per Adult Rates</label>
            </div>            
              <div class="form-group col-md-2">
                 <label class="strong">Mandatory</label>   
              </div>
            </div>

              <div class="row  border_row">              
              
               <div class="form-group col-md-2">
               <input type="text" name="supplement_adult_rate"  class="form-control supplement_adult_rate" placeholder="Enter Per Adult Rates" required="required"/>
              </div>             
             
              <div class="form-group col-md-1 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat supplement_compulsory"   name="supplement_compulsory" value="Yes"  checked="checked">
              <i></i> Yes
              </label>               
              </div> 
              <div class="form-group col-md-1 check_icon">                 
            <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat supplement_compulsory"   name="supplement_compulsory" value="No">
              <i></i> No 
              </label>
               </div>
         
               </div>

                <div id="add_childagerates">
                  <div class="row border_row"> 
              <div class="form-group col-md-3">
              <label class="strong" for="child_rate">Per Child Rate ( Age : 0 - 11 ) </label>  
            <input type="text" name="supplement_child_rate[]"  class="form-control supplement_child_rate[]" placeholder="Enter Per Child Rates" required="required"/>
               </div>
             </div>
                </div>
                <div class="row border_row"> 
                 <div class="form-group col-md-12">
                  <label class="strong">Remarks : </label>
                  <textarea name="supplement_remarks" class="form-control" rows="3"></textarea>
                </div>
              </div>


           <div class="row border_row"> 
              <div class="form-group col-md-4"></div>               
               <div class="form-group col-md-2">
                 <input  class="btn btn-success todo" type="button" value="Add Supplements Room Rates" />
               </div>
             </div>         
          </form>
           <div id="existingrate"></div>
       </div>
     </section>
   </div>
 </div>
</div>
</section>

<div class="modal fade" id="loadroomratesajax" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 70px;">
  <div class="modal-dialog" style="width: 650px;">
    <div class="modal-content" >
    <div class="modal-body"> 
      <div class="row border_row">
            <div class="col-sm-12">
              <div  style="background-color: white;border-radius: 6px;color: #a01d26;font-size: 20px;font-weight: bold;padding-top:50px;padding-bottom: 50px" align="center">
                <span class="red">Please Wait...</span><br>
                <img align="top" alt="loading.. Please wait.." src="<?php echo base_url();?>public/images/load.gif" >
              </div>
           </div>
       </div>      
      </div>
    </div>
  </div>
</div>
<?php echo $this->load->view('data_tables_js'); ?>
 <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script>
 $('#hotel_id').val('').change();
  $(document).ready(function() {
    $(".select2").select2({});  
  });
</script>
<script type="text/javascript">
 $('#hotel_id').val('').change();
  $('#hotel_id').on('change', function(){
  $id = $(this).val();
  $.ajax({
    url: site_url+'supplements/get_hotel_details/',
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
    url: site_url+'supplements/get_market_details/',
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
    url: site_url+'supplements/get_mealplan_details/',
    data: {id:$id},
    dataType: 'json',
    type: 'POST',
    success: function(data) {   
      $("#meal_plan").html(data.meal_list); 
      $("#supplement_meal_plan").html(data.supplement_meal_list); 
      $("#add_childagerates").html(data.childagerateslist);
     }
  });     
});
</script>
<script>
  $(document).ready(function() {
    $(".select2").select2({});   
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
      $("#meal_plan").select2({
      placeholder: "Select Meal Plan", 
    }); 
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

<script type="text/javascript">
$('.todo').on('click', function(){
 var deciNum= /^[0-9]+(\.\d{1,3})?$/;
 var form = $('form');
       if(!deciNum.test($("input[name='supplement_adult_rate']").val())){
          alert("Enter Either Numberic  or Decimal Value For Adult Rates");
           $("input[name='supplement_adult_rate']").val('');
            $("input[name='supplement_adult_rate']").focus();
           return false;
         }

      $("input[name='supplement_child_rate[]']").each(function() {     
           if(!deciNum.test($(this).val())){
          alert("Enter Either Numberic  or Decimal Value For Child Rates");
           $(this).val('');
           $(this).focus();
           return false;
         }
        });    

 form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      }
      else
      {
      $.ajax({
              type: "POST",
              url: site_url + 'supplements/add_supplement_roomrate',
              data : form.serialize(),
              dataType : 'json',    
              success: function(data)
               {   
                alert(data.result);         
              }
            });
    }
     
});
</script>
<script type="text/javascript">
  function add_agerange(e) {
    e.preventDefault();
    if($('#add_agerange_group').find('.agerange_row').length < 5) {
       $.ajax({
                    url: '<?php echo site_url()?>supplements/addagerange',
                    data: '',
                    dataType: 'json',
                    type: 'POST',                   
                    success: function(data)
                    {      
                      $('#add_agerange_group').append(data.result);                                             
                    }
               });  
    
    }
    return false;
  }
  
  function remove_agerange(e) {   
    e.preventDefault();
    if($('#add_agerange_group').find('.agerange_row').length > 3) {
      $('#add_agerange_group').find('.agerange_row:last').remove();
    }
    return false;
  }
  $(document).ready(function(){
    $("#supplement_roomrate_type").change(function(){
      $supplement_roomrate_type=$("#supplement_roomrate_type").val();
     if($supplement_roomrate_type!='other')
      {   
        $("#spec_offer_applicable_supplement").prop('required',true);     
        $("#spec_offer_supplement").css("display","block");
       

      }
      else if($supplement_roomrate_type=='other'||$supplement_roomrate_type=='')
      {
         $("#spec_offer_applicable_supplement").prop('required',false); 
        $("#spec_offer_applicable_supplement").val('').change();
        $("#spec_offer_supplement").css("display","none");
      }
    });
  });
</script>