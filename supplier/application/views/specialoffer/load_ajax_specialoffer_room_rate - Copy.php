       <form data-action="specialoffer/update_room_rates_ind/">
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
                <select name="min_adults_without_extra_bed" id="min_adults_without_extra_bed" class="form-control select3" required="required">
                    <option value="">Select Min adults without extra bed</option><?php for($i=1;$i<=$room_list[0]->minadult;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->min_adults_without_extra_bed==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
               </div>
                <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="max_adults_without_extra_bed">Max adults without extra bed: </label>  
                   </div>
               <div class="form-group col-md-6"> 
                 <select name="max_adults_without_extra_bed" id="max_adults_without_extra_bed" class="form-control select3" required="required">
                    <option value="">Select Max adults without extra bed</option><?php for($i=1;$i<=$room_list[0]->maxadult;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->max_adults_without_extra_bed==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="min_child_without_extra_bed">Min child without extra bed: </label>  
                     </div>
               <div class="form-group col-md-6"> 
              <select name="min_child_without_extra_bed" id="min_child_without_extra_bed" class="form-control select3" required="required">
                    <option value="">Select Min child without extra bed</option><?php for($i=0;$i<=$room_list[0]->minchild;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->min_child_without_extra_bed==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div>
               </div>
                <div class="row"> 
                  <div class="form-group col-md-6">
                    <label class="strong" for="max_child_without_extra_bed">Max child without extra bed: </label>  
                     </div>
               <div class="form-group col-md-6"> 
                <select name="max_child_without_extra_bed" id="max_child_without_extra_bed" class="form-control select3" required="required">
                    <option value="">Select Max child without extra bed</option><?php for($i=0;$i<=$room_list[0]->maxchild;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->max_child_without_extra_bed==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
            </div>
           <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="min_room_occupancy">Min room occupancy for this rate: </label>  
                   </div>
               <div class="form-group col-md-6">         
                 <select name="min_room_occupancy" id="min_room_occupancy" class="form-control select2" required="required">
                    <option value="">Select Min room occupancy for this rate</option>
                    <option value="1" <?php if($result->min_room_occupancy=='1'){ echo "selected"; }?>>1</option>
                     <?php for($i=2;$i<=$room_list[0]->maxperson;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->min_room_occupancy==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="max_room_occupancy">Max room occupancy for this rate: </label> 
                     </div>
               <div class="form-group col-md-6">  
               <select name="max_room_occupancy" id="max_room_occupancy" class="form-control select2" required="required">
                    <option value="">Select Max room occupancy for this rate</option>
                    <option value="1" <?php if($result->max_room_occupancy=='1'){ echo "selected"; }?>>1</option>
                     <?php for($i=2;$i<=$room_list[0]->maxperson;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->max_room_occupancy==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
           </div>
            <div class="row">
                <div class="form-group col-md-6">
                  <label class="strong" for="extra_bed_for_adults">Extra bed for adults: </label> 
                   </div>
               <div class="form-group col-md-6">  
               <input type="hidden" id="total_extrabed" value="<?php echo $room_list[0]->total_extrabed;?>">    
                <select name="extra_bed_for_adults" id="extra_bed_for_adults" class="form-control select3" required="required"> 
                    <option value="">Select Extra bed for Adults</option>
                    <?php for($i=0;$i<=$room_list[0]->extrabed_adults;$i++){?>
                    <option value="<?php echo $i;?>"  <?php if($result->extra_bed_for_adults==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="extra_bed_for_child">Extra bed for Child: </label> 
                     </div>
               <div class="form-group col-md-6">  
                  <select name="extra_bed_for_child" id="extra_bed_for_child" class="form-control select3" required="required"> 
                    <option value="">Select Extra bed for Child</option>
                    <?php for($i=0;$i<=$room_list[0]->extrabed_child;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->extra_bed_for_child==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
               </div>
                <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="extra_bed_for_adults_rate">Adults rate for Extra bed: </label>  
                   </div>
               <div class="form-group col-md-6"> 
                <input name="extra_bed_for_adults_rate" id="extra_bed_for_adults_rate" type="text"  value="<?php echo $result->extra_bed_for_adults_rate; ?>"  placeholder="Adults rate for Extra bed" class="form-control" required="required" />
               </div> 
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="extra_bed_for_child_rate">Child rate for Extra bed: </label>  
                     </div>
               <div class="form-group col-md-6"> 
                  <input name="extra_bed_for_child_rate" id="extra_bed_for_child_rate" type="text"  value="<?php echo $result->extra_bed_for_child_rate; ?>"  placeholder="Child rate for Extra bed" class="form-control" required="required" />
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
           <!--      <div class="row">
                <div class="form-group col-md-6">
              <label class="strong" for="child_rate">Child Rate: </label> 
              </div>
               <div class="form-group col-md-6"> 
             <input name="child_rate" id="child_rate"  value="<?php echo $result->child_rate; ?>" type="text"  class="form-control checkzero deciNum" placeholder="Child Rate" required="required" />
               </div>
               </div> --> 
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
                  <select name="min_room_occupancy" id="min_room_occupancy" class="form-control select2" required="required">
                    <option value="">Select Min room occupancy for this rate</option>
                    <option value="1" <?php if($result->min_room_occupancy=='1'){ echo "selected"; }?>>1</option>
                     <?php for($i=2;$i<=$room_list[0]->maxperson;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->min_room_occupancy==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div>
               </div> 
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="max_room_occupancy">Max room occupancy for this rate: </label>  
                    </div>
                     <div class="form-group col-md-6">              
                   <select name="max_room_occupancy" id="max_room_occupancy" class="form-control select2" required="required">
                    <option value="">Select Max room occupancy for this rate</option>
                    <option value="1" <?php if($result->max_room_occupancy=='1'){ echo "selected"; }?>>1</option>
                     <?php for($i=2;$i<=$room_list[0]->maxperson;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->max_room_occupancy==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
           </div>
            <div class="row">
                <div class="form-group col-md-6">
                  <label class="strong" for="extra_bed_for_adults">Extra bed for adults: </label> 
                   </div>
               <div class="form-group col-md-6">  
               <input type="hidden" id="total_extrabed" value="<?php echo $room_list[0]->total_extrabed;?>">    
                <select name="extra_bed_for_adults" id="extra_bed_for_adults" class="form-control select3" required="required"> 
                    <option value="">Select Extra bed for Adults</option>
                    <?php for($i=0;$i<=$room_list[0]->extrabed_adults;$i++){?>
                    <option value="<?php echo $i;?>"  <?php if($result->extra_bed_for_adults==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="extra_bed_for_child">Extra bed for Child: </label> 
                     </div>
               <div class="form-group col-md-6">  
                  <select name="extra_bed_for_child" id="extra_bed_for_child" class="form-control select3" required="required"> 
                    <option value="">Select Extra bed for Child</option>
                    <?php for($i=0;$i<=$room_list[0]->extrabed_child;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->extra_bed_for_child==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
               </div>
                <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="extra_bed_for_adults_rate">Adults rate for Extra bed: </label>  
                   </div>
               <div class="form-group col-md-6"> 
                <input name="extra_bed_for_adults_rate" id="extra_bed_for_adults_rate" type="text"  value="<?php echo $result->extra_bed_for_adults_rate; ?>"  placeholder="Adults rate for Extra bed" class="form-control" required="required" />
               </div> 
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="extra_bed_for_child_rate">Child rate for Extra bed: </label>  
                     </div>
               <div class="form-group col-md-6"> 
                  <input name="extra_bed_for_child_rate" id="extra_bed_for_child_rate" type="text"  value="<?php echo $result->extra_bed_for_child_rate; ?>"  placeholder="Child rate for Extra bed" class="form-control" required="required" />
               </div> 
              </div>
 <?php } ?>
  <div class="row  border_row"></div>
   <?php
      $dataarray=array('sup_hotel_room_rates_list_id'=>$result->sup_hotel_room_rates_list_id,'sup_hotel_id'=>$result->sup_hotel_id,'sup_room_details_id'=>$result->sup_room_details_id,'contract_id'=>$result->contract_id,'specialoffer_id'=>$result->specialoffer_id,'specialoffer_type'=>$result->specialoffer_type,'supplier_id'=>$result->supplier_id,'room_avail_date'=>$result->room_avail_date);
        $cancel_policy=$this->sup_specialoffer_hotel_room_cancellation_rates->check($dataarray);     
       $checked='';     
       if($cancel_policy[0]->cancel_rates_type=="non_refundable")
       {
          $checked='checked';
       }
    ?>
      <div class="row border_row">
              <div class="form-group col-md-6">
             <label class="strong">Cancellation Policy (Days Before and Rates)</label>  
            </div> 
            <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="checkbox" class="flat"  id="non_refundable"  name="non_refundable" value="non_refundable" <?php  echo $checked; ?>>
              <i></i> Non Refundable
              </label>               
              </div>              
             </div>
            <div id="add_policy_group">
            <div class="row  border_row policy_row">
             <div class="form-group col-md-6"></div>
            <div class="form-group col-md-6">
                <a href="#"  onclick="addPolicy(event);" class="btn btn-success btn-xs" data-original-title="Add Policy"><i class="fa fa-check"></i> Add Policy</a>
                <a href="#"  onclick="removePolicy(event);" class="btn btn-danger btn-xs" data-original-title="Delete Policy"><i class="fa fa-times"></i> Delete Policy</a>
              </div>
              </div>
            <div class="row  border_row policy_row">
            <div class="form-group col-md-3">
               <label class="strong">Cancellation Rate Type</label>  
               </div> 
              <div class="form-group col-md-3">
            <label class="strong">No of Days(Note : <span style="color: red;">Unique</span>)</label>  
            </div>
              <div class="form-group col-md-4">
                <label class="strong">Percentage / Individual Night Charge</label>  
              </div> 
            </div>
           <?php 
             if($checked=="") 
             {
               for($can=0;$can<count($cancel_policy)&&!empty($cancel_policy[0]);$can++)
             {
              ?>
      <div class="row  border_row policy_row">
              <div class="form-group col-md-3">
               <select name="cancel_rates_type[]" class="form-control cancel_rates_type" onchange="cancel_rates_type(this)" required="required">
                <option value="">Select</option>
                 <option value="percentage" <?php if($cancel_policy[$can]->cancel_rates_type=="percentage"){ echo 'selected'; } ?>>Percentage</option> 
                 <option value="fixed" <?php if($cancel_policy[$can]->cancel_rates_type=="fixed"){ echo 'selected'; } ?>>Individual Night Charge</option>
                 <option value="fullstay" <?php if($cancel_policy[$can]->cancel_rates_type=="fullstay"){ echo 'selected'; } ?>>Full Stay Charge</option>
               </select>
               </div> 
              <div class="form-group col-md-3">
                <input type="text" name="days_before[]"  class="form-control days_before"  placeholder="No of Days" value="<?php echo $cancel_policy[$can]->days_before_checkin;?>" required="required"/>
              </div>
              <div class="form-group col-md-3">
                <input type="<?php if($val[1]=="fullstay"){ echo 'hidden'; }else{ echo"text"; } ?>" name="cancel_rates[]"  class="form-control cancel_rates" value="<?php echo $cancel_policy[$can]->per_rate_charge;?>" placeholder="Percentage / Individual Night Charge" required="required"/>
              </div>                          
            </div> 
            <?php }}else { ?> 
            <div class="row  border_row policy_row">
              <div class="form-group col-md-3">
               <select name="cancel_rates_type[]" class="form-control cancel_rates_type" onchange="cancel_rates_type(this)" required="required">
                <option value="">Select</option>
                 <option value="percentage">Percentage</option> 
                 <option value="fixed">Individual Night Charge</option>
                 <option value="fullstay">Full Stay Charge</option>
               </select>
               </div> 
              <div class="form-group col-md-3">
                <input type="text" name="days_before[]"  class="form-control days_before"  placeholder="No of Days" required="required"/>
              </div>
              <div class="form-group col-md-3">
                <input type="text" name="cancel_rates[]"  class="form-control cancel_rates" placeholder="Percentage / Individual Night Charge" required="required"/>
              </div> 
            </div>
            <?php } ?>    
             </div>

       <?php if($result->specialoffer_id==1 && $result->specialoffer_type=="Discount"){ ?> 
             <div class="row border_row">
               <div class="form-group col-md-6"> 
                <label class="strong">Special Offer Type : Discount</label> 
               </div>
                <div class="form-group col-md-3"> 
                      <label class="strong">Enter Booking Code</label>
                       <input type="text" name="booking_code"  class="form-control"  placeholder="Enter Booking Code" value="<?php echo $result->booking_code;?>" required="required"/>
                   </div>
               </div>
               <div class="row border_row">
               <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat discount_rate_type"   name="discount_rate_type" value="net"  <?php if(empty($result->discount_rate_type)){echo 'checked="checked"';} else if($result->discount_rate_type=='net'){echo 'checked="checked"';}?>>
              <i></i> NET Discount 
              </label>               
              </div> 
              <div class="form-group col-md-6 check_icon">                 
            <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat discount_rate_type"   name="discount_rate_type" value="gross" <?php if($result->discount_rate_type=='gross'){echo 'checked="checked"';}?>>
              <i></i> GROSS Discount 
              </label>
               </div>                 
                </div>
                   <div class="row  border_row">
                <div class="form-group col-md-4"> 
                <label class="strong">Min number of Nights</label> 
               
                <input type="text" name="min_no_of_stay_day"  class="form-control Num"  placeholder="Min number of Nights" value="<?php echo $result->min_no_of_stay_day;?>" required="required"/>
               </div>
             
                <div class="form-group col-md-4"> 
                <label class="strong">Max number of Nights</label> 
                
                <input type="text" name="max_no_of_stay_day"  class="form-control Num"  placeholder="Max number of Nights" value="<?php echo $result->max_no_of_stay_day;?>" required="required"/>
               </div>             
                <div class="form-group col-md-4"> 
              <label class="strong">Enter Discount Percentage(%)</label>              
              <input type="text" name="discount_percentage"  class="form-control deciNum"  placeholder="Discount Percentage" value="<?php echo $result->discount_percentage;?>" required="required"/>
               </div>
             </div>
           <!--    <div class="row  border_row">
                <div class="form-group col-md-3"> 
                <label class="strong">Enter Discount Percentage(%)</label> 
                 </div>
                <div class="form-group col-md-3">
                <input type="text" name="discount_percentage"  class="form-control deciNum"  value="<?php echo $result->discount_percentage;?>" placeholder="Discount Percentage" required="required"/>
               </div>
             </div>  -->
            <?php }  else if($result->specialoffer_id==2 && $result->specialoffer_type=="Early bird"){ ?>             
             <div class="row border_row">
                   <div class="form-group col-md-3"> 
                      <label class="strong">Special Offer Type : Early Bird</label> 
                   </div>
                      <div class="form-group col-md-3"> 
                      <label class="strong">Enter Booking Code</label>
                       <input type="text" name="booking_code"  class="form-control"  placeholder="Enter Booking Code" value="<?php echo $result->booking_code;?>" required="required"/>
                   </div>
                </div> 
                 <div class="row border_row">
                  <div class="form-group col-md-3"></div> 
                  <div class="form-group col-md-3" id="prior_checkin">
                  <?php if($result->prior_day_type=="prior_checkin"){ ?>
                       <input type="text" name="prior_checkin"  class="form-control Num"  placeholder="No of Prior Checkin Days" value="<?php echo $result->prior_checkin;?>" required="required"/>
                  <?php } ?>
                  </div>
                  <div class="form-group col-md-6 check_icon">                 
                    <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                      <input type="radio" class="flat prior_day_type"   name="prior_day_type" value="prior_checkin" <?php if($result->prior_day_type=='prior_checkin'){echo 'checked="checked"';}?>>
                      <i></i> Prior Checkin Days
                  </label> 
                  </div>
                </div>

                <div class="row border_row">
                 <div class="form-group col-md-3"></div> 
                 <div class="form-group col-md-3" id="prior_checkin_date">
                  <?php if($result->prior_day_type=="prior_checkin_date"){ ?>
                   <input type="text" name="prior_checkin_date" onClick="priorcheckin_date()"  value="<?php echo $result->prior_checkin_date;?>" class="form-control"  placeholder="Select Prior Booking Date" required="required"/>
                    <?php } ?>
                 </div> 
                 <div class="form-group col-md-6 check_icon">                 
                      <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                           <input type="radio" class="flat prior_day_type" name="prior_day_type" value="prior_checkin_date" <?php if($result->prior_day_type=='prior_checkin_date'){echo 'checked="checked"';}?>>
                           <i></i> Select Prior Booking Date
                      </label>
                </div>
               </div>

              <div class="row border_row">
                <div class="form-group col-md-6" id="period">
                 <?php if($result->prior_day_type=="period"){ ?>
                  <label class="strong">Period : </label>
                  <div class="row" style="margin-left:1px;">
                    <div class="form-group col-md-6">
                       <input type="text" class="form-control period_selectdate" onClick="period_selectdate()" id="period_from_date" name="period_from_date" value="<?php echo $result->period_from_date;?>" placeholder="Select From Date" required="required">
                     </div>
                     <div class="form-group col-md-6">
                       <input type="text" class="form-control period_selectdate" onClick="period_selectdate()" id="period_to_date" name="period_to_date" value="<?php echo $result->period_to_date;?>"  placeholder="Select To Date" required="required">
                     </div>
                 </div>
                   <?php } ?>
                </div>  
                <div class="form-group col-md-6 check_icon">                 
                   <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                       <input type="radio" class="flat prior_day_type"   name="prior_day_type" value="period" <?php if($result->prior_day_type=='period'){echo 'checked="checked"';}?>>
                         <i></i> Select Prior Booking Period
                 </label>
                </div> 
              </div>




               <div class="row border_row">
               <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat discount_rate_type"   name="discount_rate_type" value="net" <?php if(empty($result->discount_rate_type)){echo 'checked="checked"';} else if($result->discount_rate_type=='net'){echo 'checked="checked"';}?>>
              <i></i> NET Discount 
              </label>               
              </div> 
              <div class="form-group col-md-6 check_icon">                 
            <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat discount_rate_type"   name="discount_rate_type" value="gross" <?php if($result->discount_rate_type=='gross'){echo 'checked="checked"';}?>>
              <i></i> GROSS Discount 
              </label>
               </div>                 
                </div>
              <div class="row  border_row">
                <div class="form-group col-md-3"> 
                <label class="strong">Enter Discount Percentage(%)</label> 
                 </div>
                <div class="form-group col-md-3">
                <input type="text" name="discount_percentage"  class="form-control deciNum" value="<?php echo $result->discount_percentage;?>" placeholder="Discount Percentage" required="required"/>
               </div>
             </div> 
            <?php } else if($result->specialoffer_id==3 && $result->specialoffer_type=="Stay Pay"){ ?> 
               <div class="row border_row">
                   <div class="form-group col-md-3"> 
                      <label class="strong">Special Offer Type :  Stay Pay</label> 
                   </div>
                      <div class="form-group col-md-3"> 
                      <label class="strong">Enter Booking Code</label>
                       <input type="text" name="booking_code"  class="form-control"  placeholder="Enter Booking Code" value="<?php echo $result->booking_code;?>" required="required"/>
                   </div>
                </div> 
               <div class="row border_row">
                  <div class="form-group col-md-3"></div> 
                  <div class="form-group col-md-3" id="prior_checkin">
                  <?php if($result->prior_day_type=="prior_checkin"){ ?>
                       <input type="text" name="prior_checkin"  class="form-control Num"  placeholder="No of Prior Checkin Days" value="<?php echo $result->prior_checkin;?>" required="required"/>
                  <?php } ?>
                  </div>
                  <div class="form-group col-md-6 check_icon">                 
                    <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                      <input type="radio" class="flat prior_day_type"   name="prior_day_type" value="prior_checkin" <?php if($result->prior_day_type=='prior_checkin'){echo 'checked="checked"';}?>>
                      <i></i> Prior Checkin Days
                  </label> 
                  </div>
                </div>

                <div class="row border_row">
                 <div class="form-group col-md-3"></div> 
                 <div class="form-group col-md-3" id="prior_checkin_date">
                  <?php if($result->prior_day_type=="prior_checkin_date"){ ?>
                   <input type="text" name="prior_checkin_date" onClick="priorcheckin_date()"  value="<?php echo $result->prior_checkin_date;?>" class="form-control"  placeholder="Select Prior Booking Date" required="required"/>
                    <?php } ?>
                 </div> 
                 <div class="form-group col-md-6 check_icon">                 
                      <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                           <input type="radio" class="flat prior_day_type" name="prior_day_type" value="prior_checkin_date" <?php if($result->prior_day_type=='prior_checkin_date'){echo 'checked="checked"';}?>>
                           <i></i> Select Prior Booking Date
                      </label>
                </div>
               </div>

              <div class="row border_row">
                <div class="form-group col-md-6" id="period">
                 <?php if($result->prior_day_type=="period"){ ?>
                  <label class="strong">Period : </label>
                  <div class="row" style="margin-left:1px;">
                    <div class="form-group col-md-6">
                       <input type="text" class="form-control period_selectdate" onClick="period_selectdate()" id="period_from_date" name="period_from_date" value="<?php echo $result->period_from_date;?>" placeholder="Select From Date" required="required">
                     </div>
                     <div class="form-group col-md-6">
                       <input type="text" class="form-control period_selectdate" onClick="period_selectdate()" id="period_to_date" name="period_to_date" value="<?php echo $result->period_to_date;?>"  placeholder="Select To Date" required="required">
                     </div>
                 </div>
                   <?php } ?>
                </div>  
                <div class="form-group col-md-6 check_icon">                 
                   <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                       <input type="radio" class="flat prior_day_type"   name="prior_day_type" value="period" <?php if($result->prior_day_type=='period'){echo 'checked="checked"';}?>>
                         <i></i> Select Prior Booking Period
                 </label>
                </div> 
              </div>

               <div class="row  border_row">
                <div class="form-group col-md-4"> 
                <label class="strong">Min number of stay days</label> 
                <input type="text" name="min_no_of_stay_day"  class="form-control Num" value="<?php echo $result->min_no_of_stay_day;?>" placeholder="Min number of stay days" required="required"/>
               </div>
                <div class="form-group col-md-4"> 
                <label class="strong">Max number of stay days</label> 
                <input type="text" name="max_no_of_stay_day"  class="form-control Num"  value="<?php echo $result->max_no_of_stay_day;?>" placeholder="Max number of stay days" required="required"/>
               </div>             
                <div class="form-group col-md-4"> 
                <label class="strong">No of free nights</label> 
                <input type="text" name="no_of_stay_free_nights"  class="form-control Num" value="<?php echo $result->no_of_stay_free_nights;?>" placeholder="No of free nights" required="required"/>
               </div>
             </div>
            <?php }  else if($result->specialoffer_id==4 && $result->specialoffer_type=="Supplement"){ ?> 
               <div class="row border_row">
               <div class="form-group col-md-6"> 
                <label class="strong">Special Offer Type : Supplement</label> 
               </div>
               </div>
              <div class="row border_row">
               <div class="form-group col-md-2">
                <label class="strong">Compulsory</label> 
               </div>
               <div class="form-group col-md-5 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat supplement_compulsory"   name="supplement_compulsory" value="Yes" <?php if(empty($result->supplement_compulsory)){echo 'checked="checked"';} else if($result->supplement_compulsory=='Yes'){echo 'checked="checked"';}?>>
              <i></i> Yes
              </label>               
              </div> 
              <div class="form-group col-md-5 check_icon">                 
            <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat supplement_compulsory"   name="supplement_compulsory" value="No" <?php if($result->supplement_compulsory=='No'){echo 'checked="checked"';}?>>
              <i></i> No 
              </label> 
          </div>                 
                </div>
                <div class="row  border_row">
                <div class="form-group col-md-3"> 
                <label class="strong">Type of Supplement</label> 
                 </div>
                <div class="form-group col-md-3">
                <select name="type_of_supplement" class="form-control select2" required="required">
                <option value="">Select Type of Supplement</option>
              <option value="extra_charge" <?php if($result->type_of_supplement=="extra_charge"){ echo 'selected';}?>> Extra Charges (on top of rate)</option>
              <option value="full_charge" <?php if($result->type_of_supplement=="full_charge"){ echo 'selected';}?>>Full Charge</option>
                </select>
               </div>              
             </div>
               <div class="row  border_row">
                <div class="form-group col-md-4"> 
                <label class="strong">Age limits for Supplement</label> 
                <input type="text" name="age_limit_for_supplement"  class="form-control Num"  value="<?php echo $result->age_limit_for_supplement;?>" placeholder="Age limits for supplement" required="required"/>
               </div>
                <div class="form-group col-md-4"> 
                <label class="strong">Supplement Rate</label>
                <input type="text" name="supplement_rate"  class="form-control deciNum"  value="<?php echo $result->supplement_rate;?>"  placeholder="Supplement Rate" required="required"/>
               </div>   
               </div>
               <div class="row  border_row">          
                <div class="form-group col-md-12"> 
                <label class="strong">Decription of Supplement</label> 
                <textarea name="supplement_desc" class="form-control" rows="5"  placeholder="Decription of Supplement" required="required"><?php echo $result->supplement_desc;?></textarea>
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
           <input type="hidden" name="specialoffer_id" value="<?php echo $result->specialoffer_id; ?>">
           <input type="hidden" name="specialoffer_type" value="<?php echo $result->specialoffer_type; ?>">  
           <input type="hidden" name="room_avail_date" value="<?php echo $result->room_avail_date; ?>">      
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
    $(".select3").select2({});  
  });
</script>
 <script type="text/javascript"> 
 $(document).ready( function() {
  if($("#non_refundable:checked").length!=0)
    {
       $("#add_policy_group").css('display','none');
       $(".cancel_rates").prop("required",false);
       $(".days_before").prop("required",false);
       $(".cancel_rates_type").prop("required",false);
    }
    else
    {
       $(".cancel_rates").prop("required",true);
       $(".days_before").prop("required",true);
       $(".cancel_rates_type").prop("required",true);
       $("#add_policy_group").css('display','block');
    } 
  
 $("#non_refundable").on('click', function(){
    if($("#non_refundable:checked").length!=0)
    {
       $("#add_policy_group").css('display','none');
       $(".cancel_rates").prop("required",false);
       $(".days_before").prop("required",false);
       $(".cancel_rates_type").prop("required",false);
    }
    else
    {
       $(".cancel_rates").prop("required",true);
       $(".days_before").prop("required",true);
       $(".cancel_rates_type").prop("required",true);
       $("#add_policy_group").css('display','block');
    }
 });
});
  function cancel_rates_type(t)
  {
    // alert("Hi "+$(t).val());
    var Num=/^(0|[1-9][0-9]*)$/;   
    var deciNum= /^[0-9]+(\.\d{1,3})?$/; 
    $cancel_rates=$(t).closest('.policy_row').find(".cancel_rates");
    $days_before=$(t).closest('.policy_row').find(".days_before");
    if($(t).val()=="percentage")
    { 
          $cancel_rates.prop('type','text'); 
          if(parseFloat($cancel_rates.val())>100)
          {
              // alert("Percentage Cann't be Greater Than 100 !!!!")
              $cancel_rates.val('');              
              $cancel_rates.focus();
          }
         if(!Num.test($days_before.val()))
         {
                // alert("Enter Numberic  Value for "+$days_before.attr('placeholder'));
                $days_before.val('');
                $days_before.focus();
                return false;
         }
         if(!deciNum.test($cancel_rates.val()))
         {
                // alert("Enter Either Numberic  or Decimal Value for "+$cancel_rates.attr('placeholder'));
                $cancel_rates.val('');
                $cancel_rates.focus();
                return false;
         }
    }
    else  if($(t).val()=="fixed")
    {
        $cancel_rates.prop('type','text');  
         if(!Num.test($days_before.val()))
         {
                // alert("Enter Numberic  Value for "+$days_before.attr('placeholder'));
                $days_before.val('');
                $days_before.focus();
                return false;
          }
         if(!deciNum.test($cancel_rates.val()))
         {
                // alert("Enter Either Numberic  or Decimal Value for "+$cancel_rates.attr('placeholder'));
                $cancel_rates.val('');
                $cancel_rates.focus();
                return false;
         }   
    }
    else  if($(t).val()=="fullstay")
    {
       $cancel_rates.val('0');
       $cancel_rates.prop('type','hidden');  
       if(!Num.test($days_before.val()))
       {
              // alert("Enter Numberic  Value for "+$days_before.attr('placeholder'));
              $days_before.val('');
              $days_before.focus();
              return false;
        }   
    }    
  }
</script>
<script type="text/javascript"> 
$(".prior_day_type").on('change',function(){
  $prior_day_type=$(this).val();

   $.ajax({
                    url: site_url + 'specialoffer/prior_day_type',
                    data: {prior_day_type:$prior_day_type},
                    dataType: 'json',
                    type: 'POST',                   
                    success: function(data)
                    {      
                          if(data.result != '') 
                          {  
                           if($prior_day_type=="prior_checkin")
                            {                              
                              $("#prior_checkin").html(data.result); 
                              $("#prior_checkin_date").html('');
                              $("#period").html(''); 
                            }
                            if($prior_day_type=="prior_checkin_date")
                            {
                              $("#prior_checkin").html(''); 
                              $("#prior_checkin_date").html(data.result);
                              $("#period").html('');  
                            }
                            if($prior_day_type=="period")
                            {
                              $("#prior_checkin").html(''); 
                              $("#prior_checkin_date").html('');
                              $("#period").html(data.result);
                            }     
                          
                          } 
                          else
                          {

                          }
                                               
                    }
               });  
 
});

 </script>
