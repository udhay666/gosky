  
        <form data-action='contract/update_contract/<?php echo $contract_id;?>'>
          <div class="row">            
            <div class="form-group col-md-12">
              <label class="strong" for="contract_number">Contract Number : <?php echo $contract_info[0]->contract_number; ?> </label>            
            </div>
            </div>
              <div class="row">            
            <div class="form-group col-md-12">
              <label class="strong" for="contract_number">Hotel Name : <?php echo $this->supplier_hotel_list->check(array('supplier_hotel_list_id'=>$contract_info[0]->supplier_hotel_list_id))[0]->hotel_name;?> </label>            
            </div>
            </div>
           <div class="row">     
            <div class="form-group col-md-8">
              <label class="strong" for="contract_desc">Description : </label>
              <input name="contract_desc" id="contract_desc" value="<?php echo $contract_info[0]->contract_desc; ?>" type="text" class="form-control" required>
            </div>              
          </div>
          <div class="row">
            <div class="form-group col-md-4">
              <label class="strong" for="start_date">Start Date : </label>
              <input type="text"  name="start_date" id="start_date" value="<?php echo  date('m/d/Y',strtotime($contract_info[0]->start_date)); ?>" class="form-control selectdate" readonly="readonly" required>
            </div>
            <div class="form-group col-md-4">
              <label class="strong" for="end_date">End Date : </label>
              <input type="text" name="end_date"  id="end_date" value="<?php echo  date('m/d/Y',strtotime($contract_info[0]->end_date)); ?>" readonly="readonly" class="form-control selectdate" required>
            </div>
            <div class="form-group col-md-4">
              <label class="strong" for="signed_date">Signed Date : </label>
              <input type="text" name="signed_date"   id="signed_date" value="<?php echo  date('m/d/Y',strtotime($contract_info[0]->signed_date)); ?>"  readonly="readonly" class="form-control" required>
            </div>
          </div>             
          <div class="row">
           <div class="form-group col-md-4">
            <label class="strong" for="status">Status is : <?php if($contract_info[0]->status1=='0'){ echo "in Progress"; } else if($contract_info[0]->status1=='1'){ echo "Completed"; } ?>
          </div>
          </div>
          <div class="row"> 
           <?php $market_avail=''; 
           if(!empty($contract_info[0]->market_avail)) { 
                $market_avail=explode('||',$contract_info[0]->market_avail);
                }?>      
          <div class="form-group col-md-8 check_icon">
            <label class="strong">Market Availability : </label>
            <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="all_market" id="all_market" class="flat" value="All Markets"  <?php if($contract_info[0]->market_avail=='All Markets'){ echo 'checked="true"';}?>><i></i> All Markets</label> 
          </div>
        </div>
          <div class="row">
          <div  class="form-group col-md-6">
          <label class="strong" for="exclude_market">Select Include Market: </label>
          </div>
          </div>
           <div class="row">
           <div  class="form-group col-md-12">
          
           <select class="form-control" name="market_avail[]" id="market_avail" multiple="multiple" style="width: 75%">
          <?php foreach($country as $val){?>
           <option value="<?php echo $val->name;?>" <?php if(in_array($val->name, $market_avail)){ echo 'selected';}?>>
             <?php echo $val->name;?>
           </option>
           <?php } ?>
         </select>
         </div>
           </div>
          <div class="row">          
           <div class="form-group col-md-2">
          <a  onclick="getmarketlist()" class="btn btn-success btn-xs">Exclude</a>
            </div>     
            
        </div>
        <div class="row">
          
            <div  class="form-group col-md-12" id="getmarketlist">
            <?php 
               if(!empty($contract_info[0]->exclude_market)) { 
                $excludemarket=explode('||',$contract_info[0]->exclude_market);
            if(!empty($excludemarket[0])){ ?>
         <label class="strong" for="exclude_market1">Select Exclude Market: </label> <select class="form-control" name="exclude_market[]" id="exclude_market1" multiple="multiple" style="width: 75%">       
            <?php foreach($country as $val){?>
           <option value="<?php echo $val->name;?>" <?php if(in_array($val->name, $excludemarket)){ echo 'selected';}?>>
             <?php echo $val->name;?>
           </option>
           <?php } ?>
         </select>
            <?php } } ?>
            </div>
        </div>
         <div class="row">
          <div class="form-group col-md-12">
            <p style="background: pink;color: red;text-align: center;">Note : * Start Date must be less than End Date</p>
          </div>
          </div>
        <div class="row">
        <div class="form-group col-md-12" align="center">
          <input type="hidden" id="contract_id" value="<?php echo $contract_id; ?>"/>
     
         <button class="btn btn-primary" type="button" onclick="update_editcontract(this);">Update</button>
         <button class="btn btn-primary" type="button" onclick="cancel_editcontract();">Cancel</button>
          </div>
       </div>
       </form>   
 
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

<style>
.daterangepicker{z-index:1151 !important;}
</style>  
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
  $("#exclude_market1").select2({  
    placeholder: "Select Exclude Market"
  });
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
   