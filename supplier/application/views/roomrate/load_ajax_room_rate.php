       <form data-action="roomrates/update_room_rates_ind/">
               <?php if($result->rate_type=='PRPN'){ ?>
     
            <div class="row">   
              <div class="form-group col-md-6">   
               <label class="strong">Availabel Dates : </label> 
             </div>        
             <div class="form-group col-md-6">   
            <?php echo date('d-m-Y',strtotime($result->room_avail_date)); ?>
            </div>
            </div>
            <div class="row">
             <div class="form-group col-md-6">
              <label class="strong" for="room_rate">Add Room Rate: </label>
               </div>
               <div class="form-group col-md-6">   
             <input name="room_rate" id="room_rate" type="text"  value="<?php echo $result->room_rate; ?>" placeholder="Add Room Rate" class="form-control checkzero deciNum" required="required" />
               </div> 
              </div>
               <div class="row">
                <div class="form-group col-md-6">
              <label class="strong" for="min_adults_without_extra_bed">Min adults without extra bed: </label>  
               </div>
               <div class="form-group col-md-6">
                <?php echo $result->min_adults_without_extra_bed; ?>
               </div>
          
               </div>
                <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="max_adults_without_extra_bed">Max adults without extra bed: </label>  
                   </div>
                  <div class="form-group col-md-6">
                <?php echo $result->max_adults_without_extra_bed; ?>
               </div>
          
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="min_child_without_extra_bed">Min child without extra bed: </label>  
                     </div>
                  <div class="form-group col-md-6">
                <?php echo $result->min_child_without_extra_bed; ?>
               </div>
             
               </div>
                <div class="row"> 
                  <div class="form-group col-md-6">
                    <label class="strong" for="max_child_without_extra_bed">Max child without extra bed: </label>  
                     </div>
                <div class="form-group col-md-6">
                <?php echo $result->max_child_without_extra_bed; ?>
               </div>
            </div>
           <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="min_room_occupancy">Min room occupancy for this rate: </label>  
                   </div>
              <div class="form-group col-md-6">
                <?php echo $result->min_room_occupancy; ?>
               </div>
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="max_room_occupancy">Max room occupancy for this rate: </label> 
                     </div>
              <div class="form-group col-md-6">
                <?php echo $result->max_room_occupancy; ?>
               </div>
           </div>
            <div class="row">
                <div class="form-group col-md-6">
                  <label class="strong" for="extra_bed_for_adults">Extra bed for adults: </label> 
                   </div>
               <div class="form-group col-md-6">
                <?php echo $result->extra_bed_for_adults; ?>
               </div>
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="extra_bed_for_child">Extra bed for Child: </label> 
                     </div>
              <div class="form-group col-md-6">
                <?php echo $result->extra_bed_for_child; ?>
               </div>
               </div>
                <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="extra_bed_for_adults_rate">Adults rate for Extra bed: </label>  
                   </div>
               <div class="form-group col-md-6"> 
                <?php if($result->extra_bed_for_adults>0){?>
                <input name="extra_bed_for_adults_rate" id="extra_bed_for_adults_rate" type="text"  value="<?php echo $result->extra_bed_for_adults_rate; ?>"  placeholder="Adults rate for Extra bed" class="form-control" required="required" />
                <?php } else { echo "0"; } ?>
               </div> 
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="extra_bed_for_child_rate">Child rate for Extra bed: </label>  
                     </div>
               <div class="form-group col-md-6"> 
                 <?php if($result->extra_bed_for_child>0){?>
                  <input name="extra_bed_for_child_rate" id="extra_bed_for_child_rate" type="text"  value="<?php echo $result->extra_bed_for_child_rate; ?>"  placeholder="Child rate for Extra bed" class="form-control" required="required" />
                  <?php } else {echo "0"; } ?>
               </div> 
                <div class="form-group col-md-6">
                    <label class="strong" for="extra_bed_for_child_rate">Status: </label>  
                </div>
               <div class="form-group col-md-6"> 
                  <input name="status" id="status" type="text"  value="<?php echo $result->status; ?>"  placeholder="Child rate for Extra bed" class="form-control" required="required" />
               </div> 
              </div>
 <?php } else if($result->rate_type=='PPPN'){  ?>        
             <div class="row">   
              <div class="form-group col-md-6">   
               <label class="strong">Availabel Dates : </label> 
             </div>        
             <div class="form-group col-md-6">   
            <?php echo date('d-m-Y',strtotime($result->room_avail_date)); ?>
            </div>
            </div>
           <div class="row">
             <div class="form-group col-md-6">
              <label class="strong" for="adult_rate">Adult Rate: </label>  
              </div>
               <div class="form-group col-md-6">
             <input name="adult_rate" id="adult_rate" value="<?php echo $result->adult_rate; ?>" type="text"  class="form-control checkzero deciNum" placeholder="Adult Rate" required="required" />
             </div>
               </div> 
      
                   <?php 
                $child_rate=json_decode($result->child_rate,true);                 
                if(!empty($child_rate[0]))
                {                    
                  foreach ($child_rate as $key => $value)
                  { 
                    $val=explode('||', $value);   
                    $val1=explode('-', $val[0]);   
              ?>
                <div class="row">
                <div class="form-group col-md-6">
              <label class="strong" for="child_rate">Child Rate ( Age : <?php echo $val1[0].' - '.$val1[1]; ?> ) </label> 
              </div>  
               <div class="form-group col-md-6"> 
             <input name="child_rate[]" id="child_rate" type="text"  class="form-control checkzero deciNum" placeholder="Child Rate" value="<?php echo $val[1]; ?>" required="required" />
               </div>
               </div>
               <?php } } else { ?>
                  <div class="row">
                <div class="form-group col-md-6">
              <label class="strong" for="child_rate">Child Rate ( Age : <?php echo $val1[0].' - '.$val1[1]; ?> ) </label> 
              </div>  
               <div class="form-group col-md-6"> 
              <label class="strong" for="child_rate">Child Rate ( Age : 0 - 11 ) </label>  
             <input name="child_rate[]" id="child_rate" type="text"  class="form-control checkzero deciNum" placeholder="Child Rate" value="<?php echo $result->child_rate; ?>" required="required" />
               </div>
               </div>
               <?php  } ?>           
              <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="min_room_occupancy">Min room occupancy for this rate: </label>  
                  </div>
                <div class="form-group col-md-6">
                <?php echo $result->min_room_occupancy; ?>
               </div>
               </div> 
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="max_room_occupancy">Max room occupancy for this rate: </label>  
                    </div>
              <div class="form-group col-md-6">
                <?php echo $result->max_room_occupancy; ?>
               </div>
           </div>
            <div class="row">
                <div class="form-group col-md-6">
                  <label class="strong" for="extra_bed_for_adults">Extra bed for adults: </label> 
                   </div>
          <div class="form-group col-md-6">
                <?php echo $result->extra_bed_for_adults; ?>
               </div>
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="extra_bed_for_child">Extra bed for Child: </label> 
                     </div>
         <div class="form-group col-md-6">
                <?php echo $result->extra_bed_for_child; ?>
               </div>
               </div>
                  <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="extra_bed_for_adults_rate">Adults rate for Extra bed: </label>  
                   </div>
               <div class="form-group col-md-6"> 
                <?php if($result->extra_bed_for_adults>0){?>
                <input name="extra_bed_for_adults_rate" id="extra_bed_for_adults_rate" type="text"  value="<?php echo $result->extra_bed_for_adults_rate; ?>"  placeholder="Adults rate for Extra bed" class="form-control" required="required" />
                <?php } else { echo "0"; } ?>
               </div> 
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="extra_bed_for_child_rate">Child rate for Extra bed: </label>  
                     </div>
               <div class="form-group col-md-6"> 
                 <?php if($result->extra_bed_for_child>0){?>
                  <input name="extra_bed_for_child_rate" id="extra_bed_for_child_rate" type="text"  value="<?php echo $result->extra_bed_for_child_rate; ?>"  placeholder="Child rate for Extra bed" class="form-control" required="required" />
                  <?php } else {echo "0"; } ?>
               </div> 
               <div class="form-group col-md-6">
                    <label class="strong" for="extra_bed_for_child_rate">Status: </label>  
                </div>
               <div class="form-group col-md-6"> 
                  <input name="status" id="status" type="text"  value="<?php echo $result->status; ?>"  placeholder="Child rate for Extra bed" class="form-control" required="required" />
               </div>
              </div>
 <?php } ?> 



                 
      <div class="row">    
    <div class="form-group col-md-12"  align="center">   
     <input type="hidden" name="rate_type" id="rate_type" value="<?php echo $result->rate_type; ?>"/>   
         <input type="hidden" name="hotel_code" id="hotel_code" value="<?php echo $result->hotel_code; ?>"/>
         <input type="hidden" name="room_code" id="room_code" value="<?php echo $result->room_code; ?>"/>
         <input type="hidden" name="sup_hotel_room_rates_list_id" value="<?php echo $result->sup_hotel_room_rates_list_id; ?>"/>
         <input type="hidden" name="sup_room_details_id" id="sup_room_details_id" value="<?php echo $result->sup_room_details_id; ?>"/>
         <input type="hidden"  name="sup_hotel_room_rates_id" id="sup_hotel_room_rates_id" value="<?php echo $result->sup_hotel_room_rates_id; ?>"/>   
        <input type="hidden" name="contract" value="<?php echo $result->contract_id ?>"><input type="hidden" name="hotel_id" value="<?php echo $result->sup_hotel_id; ?>">
        
           <input type="hidden" name="market" value="<?php echo $result->market; ?>">
            <input type="hidden" name="meal_plan" value="<?php echo $result->meal_plan; ?>">          
           <input type="hidden" name="room_avail_date" value="<?php echo $result->room_avail_date; ?>">      
         <button class="btn btn-primary" type="button" onclick="update_editrate(this);">Update</button>
         <button class="btn btn-primary" type="button" onclick="cancel_editrate();">Cancel</button>
       </div> 
     </div>
     </form>
