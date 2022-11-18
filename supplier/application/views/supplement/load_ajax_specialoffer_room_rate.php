       <form data-action="supplements/update_room_rates_ind/">        
            <div class="row">   
              <div class="form-group col-md-6">   
               <label class="strong">Availabel Dates : </label> 
             </div>        
             <div class="form-group col-md-6">   
            <?php echo date('d-m-Y',strtotime($result->avail_date)); ?>
            </div>
            </div>
            <div class="row">
             <div class="form-group col-md-6">
              <label class="strong" for="supplement_roomrate_type">Supplements Room Rate Type </label>
               </div>
               <div class="form-group col-md-6">   
              <?php echo $result->supplement_roomrate_type; ?>
               </div> 
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="meal_plan">Meal Plan: </label>  
                     </div>
               <div class="form-group col-md-6"> 
              <select class="form-control select2" name="meal_plan[]" id="meal_plan" multiple="multiple" required="required">
                 <?php 
                    $meal_plan=explode(',',$result->meal_plan);
                  foreach($room_mealplan_list as $val){?>
                   <option value="<?php echo $val;?>"  <?php if(in_array($val, $meal_plan)){ echo 'selected';}?>><?php echo $mealplan[$val];?></option>
                   <?php } ?>  
                  </select>
               </div>
               </div>
               <div class="row">
                <div class="form-group col-md-6">
              <label class="strong" for="supplement_adult_rate">Per Adult Rate: </label>  
               </div>
               <div class="form-group col-md-6">        
                <input type="text" name="supplement_adult_rate"  class="form-control supplement_adult_rate deciNum checkzero" placeholder="Enter Per Adult Rates"  value="<?php echo $result->supplement_adult_rate; ?>" required="required"/>
               </div> 
               </div>
                <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="supplement_child_rate">Per Child Rate: </label>  
                   </div>
               <div class="form-group col-md-6"> 
                   <input type="text" name="supplement_child_rate"  class="form-control supplement_child_rate deciNum" placeholder="Enter Per Child Rates" value="<?php echo $result->supplement_child_rate; ?>" required="required"/>
               </div> 
               </div>
                <div class="row">
                  <div class="form-group col-md-6">
                  <label class="strong" for="supplement_child_rate">Select Child Min Age limits: </label>  
                   </div>
                 <div class="form-group col-md-6">
                <select name="supplement_child_min_age" id="supplement_child_min_age" class="form-control select2" required="required">
                    <option value="">Select Child Min Age limits</option>
                   <?php for($i=0;$i<12;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->supplement_child_min_age==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select> 
              </div>
            </div>
            <div class="row">
             <div class="form-group col-md-6">
                  <label class="strong" for="supplement_child_rate">Select Child Max Age limits: </label>  
                   </div>

              <div class="form-group col-md-6">
                <select name="supplement_child_max_age" id="supplement_child_max_age" class="form-control select2" required="required">
                    <option value="">Select Child Max Age limits</option>
                   <?php for($i=1;$i<12;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->supplement_child_max_age==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select> 
              </div>
            </div>
            
                <div class="row"> 
                  <div class="form-group col-md-6">
                    <label class="strong" for="max_child_without_extra_bed">Mandatory: </label>  
                     </div>
                <div class="form-group col-md-3 check_icon">                 
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                <input type="radio" class="flat supplement_compulsory"   name="supplement_compulsory" value="Yes"  <?php if($result->supplement_compulsory=='Yes'){echo 'checked="checked"';}?>>
                <i></i> Yes
                </label>               
                </div> 
                <div class="form-group col-md-3 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                <input type="radio" class="flat supplement_compulsory"   name="supplement_compulsory"  value="No" <?php if($result->supplement_compulsory=='No'){echo 'checked="checked"';}?>>
                <i></i> No 
                </label>
               </div> 
            </div>
         
      <div class="row">    
    <div class="form-group col-md-12"  align="center">   
  
         <input type="hidden" name="hotel_code" id="hotel_code" value="<?php echo $result->hotel_code; ?>"/>
         <input type="hidden" name="room_code" id="room_code" value="<?php echo $result->room_code; ?>"/>
         <input type="hidden" name="id" value="<?php echo $result->id; ?>"/>
         <input type="hidden" name="sup_room_details_id" id="sup_room_details_id" value="<?php echo $result->sup_room_details_id; ?>"/>
      
        <input type="hidden" name="contract" value="<?php echo $result->contract_id ?>"><input type="hidden" name="hotel_id" value="<?php echo $result->sup_hotel_id; ?>">        
           <input type="hidden" name="supplement_roomrate_type_id" value="<?php echo $result->supplement_roomrate_type_id; ?>">
           <input type="hidden" name="supplement_roomrate_type" value="<?php echo $result->supplement_roomrate_type; ?>">  
           <input type="hidden" name="avail_date" value="<?php echo $result->avail_date; ?>">      
         <button class="btn btn-primary" type="button" onclick="update_editrate(this);">Update</button>
         <button class="btn btn-primary" type="button" onclick="cancel_editrate();">Cancel</button>
       </div> 
     </div>
     </form>

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

   function update_editrate(t)
  {
    var Num=/^(0|[1-9][0-9]*)$/;   
    var deciNum= /^[0-9]+(\.\d{1,3})?$/;
    var form =$(t.form);
    $val=t.form.getAttribute('data-action');
  
     if(!deciNum.test($("input[name='supplement_adult_rate']").val())){
          alert("Enter Either Numberic  or Decimal Value For Adult Rates");
           $("input[name='supplement_adult_rate']").val('');
            $("input[name='supplement_adult_rate']").focus();
           return false;
         }
       if(!deciNum.test($("input[name='supplement_child_rate']").val())){
          alert("Enter Either Numberic  or Decimal Value For Child Rates");
           $("input[name='supplement_child_rate']").val('');
            $("input[name='supplement_child_rate']").focus();
           return false;
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
          data : form.serialize(),
          dataType : 'json',    
          success: function(data)
          {          
              if(data.success != '')
              {  
              $("#ratecontent").html("Successfully Updated");
              setTimeout( function()  {
               $('#modaleditrate').modal('show'); }, 1000);      
               window.location.reload();
               } 
               else
               {
                 $("#ratecontent").html("Try after sometimes...");
                  setTimeout( function()  {
                 $('#modaleditrate').modal('show'); }, 1000);      
                 window.location.reload();
               }      
          }
         });
    }
 }
</script>


