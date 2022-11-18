           <form data-action="excursions/update_excursion_rates/">
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
               <label class="strong" for="supplier_room_list_id">Availabel Dates : </label> 
             </div>        
             <div class="form-group col-md-6">   
            <?php echo date('d-m-Y',strtotime($result->excursion_avail_date)); ?>
            </div> 
          </div>
            <div class="row">   
              <div class="form-group col-md-6">   
               <label class="strong" for="supplier_room_list_id">Availabel Booking : </label> 
             </div>        
             <div class="form-group col-md-6">   
            <?php echo $result->available_booking; ?>
            </div> 
          </div>
            <div class="row">   
              <div class="form-group col-md-6">   
               <label class="strong" for="adult_price">Adult Price : </label> 
             </div>        
             <div class="form-group col-md-6">   
              <input type="text"  class="form-control deciNum checkzero" name="adult_price" value="<?php echo $result->adult_price; ?>" required="required">
            </div> 
          </div>
            <?php
                $child_price=json_decode($result->child_price,true);
                if(!empty($child_price[0]))
                {
                foreach ($child_price as $key => $value)
                  { 
                        $val=explode('||', $value);
                        $val1=explode('-', $val[0]);
                        $val2=explode(':', $val[1]);
                        $val3=explode('-', $val2[0]);                  
               ?>
          <div class="row">   
            <div class="form-group col-md-6">   
              <label class="strong">Child Age( <?php echo $val1[0].' - '.$val1[1];?> ) 
                    <br/>Height( <?php echo $val3[0].' Cm  - '.$val3[1];?> Cm )</label>
           </div>        
           <div class="form-group col-md-6">   
            <input type="text"  class="form-control deciNum checkzero" name="child_price[]" value="<?php echo $val2[1]; ?>" required="required">
          </div> 
        </div>  
        <?php }} ?>                 
      <div class="row">    
    <div class="form-group col-md-12"  align="center">
         <input type="hidden" name="excursion_id" value="<?php echo $result->excursion_id; ?>"/>
           <input type="hidden" name="excursion_code" value="<?php echo $result->excursion_code; ?>"/>
         <input type="hidden" name="rate_code" value="<?php echo $result->rate_code; ?>"/>
         <input type="hidden" name="excursions_rate_types_id" value="<?php echo $result->excursions_rate_types_id; ?>"/>
         <input type="hidden" name="sup_excursion_rate_id" value="<?php echo $result->sup_excursion_rate_id; ?>"/>
         <input type="hidden" name="index" value="<?php echo $index; ?>"/>
         <button class="btn btn-primary" type="button" onclick="update_editrate(this);">Update</button>
         <button class="btn btn-primary" type="button" onclick="cancel_editrate();">Cancel</button>
       </div> 
     </div>
     </form>

