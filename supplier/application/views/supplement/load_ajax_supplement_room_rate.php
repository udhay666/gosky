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
                    <label class="strong" for="meal_plan">Supplements Applicable on Meal Plan: </label>  
                     </div>
               <div class="form-group col-md-6"> 
                <?php 
                    $meal_arrr=explode(',',$result->meal_plan);
                    $meal_plan=array();
                    for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
                    {
                      $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
                    }
                    $meal_plan_str=implode(' , ', $meal_plan);           
                    echo $meal_plan_str;
                    ?>               
              
               </div>
               </div>


              <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="meal_plan">Supplements Meal Plan: </label>  
                     </div>
               <div class="form-group col-md-6"> 
                 <?php 
                    $supplement_meal_arrr=explode(',',$result->supplement_meal_plan);
                    $supplement_meal_plan=array();
                    for($l=0;$l<count($supplement_meal_arrr)&&!empty($supplement_meal_arrr[0]);$l++)
                    {
                      $supplement_meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($supplement_meal_arrr[$l])->meal_plan;
                    }
                    $supplement_meal_plan_str=implode(' , ', $supplement_meal_plan);           
                    echo $supplement_meal_plan_str;
                    ?>           
               </div>
               </div>

              <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong">Market: </label>  
                     </div>
               <div class="form-group col-md-6"> 
                 <?php  echo $result->market; ?>           
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

            <?php 
                $child_rate=json_decode($result->supplement_child_agerange_rate,true);                 
                if(!empty($child_rate[0]))
                {                    
                  foreach ($child_rate as $key => $value)
                  { 
                    $val=explode(':', $value);   
                    $val1=explode('||', $val[1]);
              ?>
                <div class="row">
                <div class="form-group col-md-6">
              <label class="strong" for="supplement_child_rate">Child Rate ( Age : <?php echo $val1[0].' - '.$val1[1]; ?> ) </label> 
              </div>  
               <div class="form-group col-md-6"> 
             <input name="supplement_child_rate[]"  type="text"  class="form-control" placeholder="Enter Per Child Rates" value="<?php echo $val[0]; ?>" required="required" />
               </div>
               </div>
               <?php } }?>
            
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

              <div class="row border_row"> 
                 <div class="form-group col-md-12">
                  <label class="strong">Remarks : </label>
                  <textarea name="supplement_remarks" class="form-control" rows="3"><?php echo $result->supplement_remarks; ?></textarea>
                </div>
              </div>
         
      <div class="row">    
    <div class="form-group col-md-12"  align="center">   
  
         <input type="hidden" name="hotel_code" id="hotel_code" value="<?php echo $result->hotel_code; ?>"/>
         <input type="hidden" name="room_code" id="room_code" value="<?php echo $result->room_code; ?>"/>
         <input type="hidden" name="id" value="<?php echo $result->id; ?>"/>
         <input type="hidden" name="sup_room_details_id" id="sup_room_details_id" value="<?php echo $result->sup_room_details_id; ?>"/>
      
        <input type="hidden" name="contract" value="<?php echo $result->contract_id ?>"><input type="hidden" name="hotel_id" value="<?php echo $result->sup_hotel_id; ?>">   
         <input type="hidden" name="meal_plan" value="<?php echo $result->meal_plan; ?>">     
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


