       <form data-action="roomrates/update_room_rates_ind/">
        <?php if($result->rate_type=='PRPN'){ ?>
          <div class="row">   
              <div class="form-group col-md-6">   
               <label class="strong">SL No : </label> 
             </div>        
             <div class="form-group col-md-6">   
            <?php echo $index; ?>
            </div>
            </div>
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
             <input name="min_adults_without_extra_bed" id="min_adults_without_extra_bed" type="text"  value="<?php echo $result->min_adults_without_extra_bed; ?>" placeholder="Min adults without extra bed" class="form-control checkzero Num" required="required" />
               </div> 
               </div>
                <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="max_adults_without_extra_bed">Max adults without extra bed: </label>  
                   </div>
               <div class="form-group col-md-6"> 
                 <input name="max_adults_without_extra_bed" id="max_adults_without_extra_bed" type="text"   value="<?php echo $result->max_adults_without_extra_bed; ?>"  placeholder="Max adults without extra bed" class="form-control checkzero Num" required="required" />
               </div> 
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="min_child_without_extra_bed">Min child without extra bed: </label>  
                     </div>
               <div class="form-group col-md-6"> 
                   <input name="min_child_without_extra_bed" id="min_child_without_extra_bed" type="text"   value="<?php echo $result->min_child_without_extra_bed; ?>"  placeholder="Min child without extra bed" class="form-control Num" required="required" />
               </div>
               </div>
                <div class="row"> 
                  <div class="form-group col-md-6">
                    <label class="strong" for="max_child_without_extra_bed">Max child without extra bed: </label>  
                     </div>
               <div class="form-group col-md-6"> 
                   <input name="max_child_without_extra_bed" id="max_child_without_extra_bed" type="text"  value="<?php echo $result->max_child_without_extra_bed; ?>" placeholder="Max child without extra bed"  class="form-control Num" required="required" />
               </div> 
            </div>
           <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="min_room_occupancy">Min room occupancy for this rate: </label>  
                   </div>
               <div class="form-group col-md-6"> 
              <input name="min_room_occupancy" id="min_room_occupancy"  type="text" value="<?php echo $result->min_room_occupancy; ?>"  class="form-control checkzero Num"  placeholder="Min room occupancy for this rate" required="required" />
               </div> 
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="max_room_occupancy">Max room occupancy for this rate: </label> 
                     </div>
               <div class="form-group col-md-6">  
                   <input name="max_room_occupancy" id="max_room_occupancy" type="text" value="<?php echo $result->max_room_occupancy; ?>"  class="form-control checkzero Num"    placeholder="Max room occupancy for this rate" required="required" />
               </div> 
            
           </div>
            <div class="row">
                <div class="form-group col-md-6">
                  <label class="strong" for="extra_bed_for_adults">Extra bed for adults: </label> 
                   </div>
               <div class="form-group col-md-6">  
                 <input name="extra_bed_for_adults" id="extra_bed_for_adults" type="text"  class="form-control Num"  value="<?php echo $result->extra_bed_for_adults; ?>" placeholder="Extra bed for adults" required="required" />
               </div> 
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="extra_bed_for_child">Extra bed for Child: </label> 
                     </div>
               <div class="form-group col-md-6">  
                   <input name="extra_bed_for_child" id="extra_bed_for_child" type="text"  class="form-control Num"  value="<?php echo $result->extra_bed_for_child; ?>" placeholder="Extra bed for Child" required="required" />
               </div> 
               </div>
                <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="extra_bed_for_adults_rate">Adults rate for Extra bed: </label>  
                   </div>
               <div class="form-group col-md-6"> 
                <input name="extra_bed_for_adults_rate" id="extra_bed_for_adults_rate" type="text"  value="<?php echo $result->extra_bed_for_adults_rate; ?>"  placeholder="Adults rate for Extra bed" class="form-control deciNum" required="required" />
               </div> 
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="extra_bed_for_child_rate">Child rate for Extra bed: </label>  
                     </div>
               <div class="form-group col-md-6"> 
                  <input name="extra_bed_for_child_rate" id="extra_bed_for_child_rate" type="text"  value="<?php echo $result->extra_bed_for_child_rate; ?>"  placeholder="Child rate for Extra bed" class="form-control deciNum" required="required" />
               </div> 
              </div>
            
                <div class="row">
                <div class="form-group col-md-12">
                     <label class="strong" for="cancellation_policy">Add Cancellation Policy: </label>                 
                 <textarea class="form-control" rows="5"  name="cancellation_policy" id="cancellation_policy" required="required" data-parsley-required="true" data-parsley-required-message="This field is required"><?php echo $result->cancellation_policy; ?></textarea>
               </div> 
           </div>
 <?php } else if($result->rate_type=='PPPN'){  ?>
           <div class="row">   
              <div class="form-group col-md-6">   
               <label class="strong" for="supplier_room_list_id">SL No : </label> 
             </div>        
             <div class="form-group col-md-6">   
            <?php echo $index; ?>
            </div>
            </div>
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
                <div class="row">
                <div class="form-group col-md-6">
              <label class="strong" for="child_rate">Child Rate: </label> 
              </div>
               <div class="form-group col-md-6"> 
             <input name="child_rate" id="child_rate"  value="<?php echo $result->child_rate; ?>" type="text"  class="form-control checkzero deciNum" placeholder="Child Rate" required="required" />
               </div>
               </div> 
                <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="min_room_occupancy">Min room occupancy for this rate: </label>  
                  </div>
                   <div class="form-group col-md-6">
                 <input name="min_room_occupancy" id="min_room_occupancy" type="text"  class="form-control checkzero Num" value="<?php echo $result->min_room_occupancy; ?>" placeholder="Min room occupancy for this rate" required="required" />
               </div>
               </div> 
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="max_room_occupancy">Max room occupancy for this rate: </label>  
                    </div>
                     <div class="form-group col-md-6">
                   <input name="max_room_occupancy" id="max_room_occupancy" type="text" value="<?php echo $result->max_room_occupancy; ?>"  class="form-control checkzero Num" placeholder="Max room occupancy for this rate" required="required" />
               </div> 
           </div>
           <div class="row">
                <div class="form-group col-md-12">
                     <label class="strong" for="cancellation_policy">Add Cancellation Policy: </label>                
                 <textarea class="form-control" rows="5"  name="cancellation_policy" id="cancellation_policy" required="required" data-parsley-required="true" data-parsley-required-message="This field is required"><?php echo $result->cancellation_policy; ?></textarea>
               </div> 
           </div>
 <?php } ?>
                 
      <div class="row">    
    <div class="form-group col-md-12"  align="center">   
     <input type="hidden" name="rate_type" id="rate_type" value="<?php echo $result->rate_type; ?>"/>   
         <input type="hidden" name="hotel_code" id="hotel_code" value="<?php echo $result->hotel_code; ?>"/>
         <input type="hidden" name="room_code" id="room_code" value="<?php echo $result->room_code; ?>"/>
         <input type="hidden" name="sup_room_details_id" id="sup_room_details_id" value="<?php echo $result->sup_room_details_id; ?>"/>
         <input type="hidden"  name="sup_hotel_room_rates_id" id="sup_hotel_room_rates_id" value="<?php echo $result->sup_hotel_room_rates_id; ?>"/>      
         <button class="btn btn-primary" type="button" onclick="update_editrate(this);">Update</button>
         <button class="btn btn-primary" type="button" onclick="cancel_editrate();">Cancel</button>
       </div> 
     </div>
     </form>

<script type="text/javascript">
CKEDITOR.replace('cancellation_policy');
CKEDITOR.config = {
  autoUpdateElement: true,
}

CKEDITOR.on('instanceReady', function(){
  $.each( CKEDITOR.instances, function(instance) {
    CKEDITOR.instances[instance].on("change", function(e) {
      for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
    });
  });
});
</script>