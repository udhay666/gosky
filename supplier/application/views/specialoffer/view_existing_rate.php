 <form action="<?php echo site_url();?>specialoffer/add_duplicates_rates" id="add_duplicates_rates" method="post"> 
<div class="row border_row">         
               <div class="form-group col-md-2">
                 <input  class="btn btn-success" type="button" id="addexistingrate" value="Add Existing Rate" />
               </div> 
                <div class="form-group col-md-2">
                 <input  class="btn btn-success" type="button" id="hideexistingrate" value="Hide Existing Rate" />
               </div>              
</div> 
<div class="row border_row">
<?php if(!empty($existing_rate[0])&&$existing_rate[0]->specialoffer_id==1 && $existing_rate[0]->specialoffer_type=="Discount") { ?>
          
           <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="existing_ratetable1">
            <thead>
             <tr>  
              <th>Select</th>           
              <th>Dates</th>
              <th>Rate Type</th>
              <th>Adult Rate</th>
              <th>Child Rate</th>
              <th>Room Rate</th>  
              <th>Status</th>           
              <th class="none">Booking Code</th>              
              <th class="none">Adult Rate For Extra Bed</th>
              <th class="none">Child Rate For Extra Bed</th>     
              <th class="none">Extra Bed For Adults</th>
              <th class="none">Extra Bed For Chlid</th>
              <th class="none">Min Room Occupancy</th>
              <th class="none">Max Room Occupancy</th> 
              <th class="none">Min Adults Without Extra Bed</th>
              <th class="none">Max Adults Without Extra Bed</th>                
              <th class="none">Min Child Without Extra Bed</th>                
              <th class="none">Max Child Without Extra Bed</th>
              <th class="none">Meal Plan</th>                     
              <th class="none">Special Offer Type</th>
              <!-- <th class="none">Special Offer Applicable On Supplement</th> -->
              <th class="none">Discount Type</th>
              <th class="none">Min number of Nights</th>
              <th class="none">Max number of Nights</th>
              <th class="none">Discount Percentage(%)</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($existing_rate)) { 
              for($i=0,$sl=0;$i<count($existing_rate);$i++){  
              if($existing_rate[$i]->specialoffer_id==1 && $existing_rate[$i]->specialoffer_type=="Discount"){     
               ?>
              <tr>
                 <td>             
                    <input type="checkbox" class="rate_list" name="rate_list" value="<?php echo $existing_rate[$i]->sup_hotel_room_rates_list_id; ?>" onchange="check_existing_rate(this);">          
               </td>                
               <td><?php echo ' From '.date('d-m-Y',strtotime($existing_rate[$i]->from_date)).'<br> To '.date('d-m-Y',strtotime($existing_rate[$i]->to_date)).'<br> Last Updated Date and Time :<br>'.date('d-M-Y H:i:s',strtotime($existing_rate[$i]->last_updated));?>
               </td>
                <td><?php if($existing_rate[$i]->rate_type=='PPPN'){echo 'Per Person Per Night (PPPN)';}else if($existing_rate[$i]->rate_type=='PRPN'){echo ' Per Room Per Night ( PRPN )';} ?></td>
                <td><?php echo $existing_rate[$i]->adult_rate; ?></td>
                <td>   
                  <?php 
                      $child_rate=json_decode($existing_rate[$i]->child_rate,true);                 
                      if(!empty($child_rate[0]))
                      {                    
                        foreach ($child_rate as $key => $value)
                        { 
                          $val=explode('||', $value);   
                          $val1=explode('-', $val[0]);   
                          echo 'Age( '.$val[0].' ) '.$val[1].'<br>'; 
                        }
                      }
                    ?>
                 </td>   
                <td><?php echo $existing_rate[$i]->room_rate; ?></td>         
                <td>    
                  <?php if($existing_rate[$i]->status==1){ ?>  
                  <label class="label label-success">Active</label>
                    <?php } else if($existing_rate[$i]->status==0) { ?>
                     <label class="label label-danger">Inactive</label>
                    <?php } else if($existing_rate[$i]->status==2) { ?>
                     <label class="label label-warning">Blocked</label>
                    <?php } ?>
                </td> 
                  <td class="none"><?php echo $existing_rate[$i]->booking_code; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_adults_rate; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_child_rate; ?></td>
                 <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_adults; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_child; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->min_room_occupancy; ?></td>
               <td class="none"><?php echo $existing_rate[$i]->max_room_occupancy; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->min_adults_without_extra_bed; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->max_adults_without_extra_bed; ?></td> 
                <td class="none"><?php echo $existing_rate[$i]->min_child_without_extra_bed; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->max_child_without_extra_bed; ?></td>                   
            
               <td class="none">
              <?php 
                    $meal_arrr=explode(',',$existing_rate[$i]->meal_plan);
                    $meal_plan=array();
                    for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
                    {
                      $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
                    }
                    $meal_plan_str=implode(' , ', $meal_plan);           
                    echo $meal_plan_str;
                    ?>  
              </td> 
            
         
      <td class="none"><?php echo $existing_rate[$i]->specialoffer_type; ?></td> 
     <!-- <td class="none"><?php echo $existing_rate[$i]->supplement_compulsory; ?></td>  -->
      <td class="none">
         <?php   if($existing_rate[$i]->discount_rate_type=='net'){ 
          echo 'NET Discount';
           } if($existing_rate[$i]->discount_rate_type=='gross'){ 
           echo 'GROSS Discount';
         } ?>
      </td>
      <td class="none"><?php echo $existing_rate[$i]->min_no_of_stay_day; ?></td>
      <td class="none"><?php echo $existing_rate[$i]->max_no_of_stay_day; ?></td>
      <td class="none"><?php echo $existing_rate[$i]->discount_percentage;?></td>

              </tr>  
             <?php $sl++; } } } ?>            
           </tbody>
         </table>

<?php } else if(!empty($existing_rate[0])&&$existing_rate[0]->specialoffer_id==2 && $existing_rate[0]->specialoffer_type=="Early bird") { ?>
          
           <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="existing_ratetable1">
            <thead>
             <tr>  
              <th>Select</th>           
              <th>Dates</th>
              <th>Rate Type</th>
              <th>Adult Rate</th>
              <th>Child Rate</th>
              <th>Room Rate</th>
              <th>Status</th>             
              <th class="none">Booking Code</th>              
              <th class="none">Adult Rate For Extra Bed</th>
              <th class="none">Child Rate For Extra Bed</th>     
              <th class="none">Extra Bed For Adults</th>
              <th class="none">Extra Bed For Chlid</th>
              <th class="none">Min Room Occupancy</th>
              <th class="none">Max Room Occupancy</th> 
              <th class="none">Min Adults Without Extra Bed</th>
              <th class="none">Max Adults Without Extra Bed</th>                
              <th class="none">Min Child Without Extra Bed</th>                
              <th class="none">Max Child Without Extra Bed</th>
              <th class="none">Meal Plan</th>                     
              <th class="none">Special Offer Type</th>
              <!-- <th class="none">Special Offer Applicable On Supplement</th> -->
              <th class="none">Prior Days/Booking Date or Booking Periods</th>
              <th class="none">Discount Type</th>
              <th class="none">Discount Percentage(%)</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($existing_rate)) { 
              for($i=0,$sl=0;$i<count($existing_rate);$i++){  
              if($existing_rate[$i]->specialoffer_id==2 && $existing_rate[$i]->specialoffer_type=="Early bird"){     
               ?>
              <tr>
                 <td>             
                    <input type="checkbox" class="rate_list" name="rate_list" value="<?php echo $existing_rate[$i]->sup_hotel_room_rates_list_id; ?>" onchange="check_existing_rate(this);">          
               </td>                
               <td><?php echo ' From '.date('d-m-Y',strtotime($existing_rate[$i]->from_date)).'<br> To '.date('d-m-Y',strtotime($existing_rate[$i]->to_date)).'<br> Last Updated Date and Time :<br>'.date('d-M-Y H:i:s',strtotime($existing_rate[$i]->last_updated));?>
               </td>
                <td><?php if($existing_rate[$i]->rate_type=='PPPN'){echo 'Per Person Per Night (PPPN)';}else if($existing_rate[$i]->rate_type=='PRPN'){echo ' Per Room Per Night ( PRPN )';} ?></td>
                <td><?php echo $existing_rate[$i]->adult_rate; ?></td>
                <td>   
                  <?php 
                      $child_rate=json_decode($existing_rate[$i]->child_rate,true);                 
                      if(!empty($child_rate[0]))
                      {                    
                        foreach ($child_rate as $key => $value)
                        { 
                          $val=explode('||', $value);   
                          $val1=explode('-', $val[0]);   
                          echo 'Age( '.$val[0].' ) '.$val[1].'<br>'; 
                        }
                      }
                    ?>
                 </td>   
                <td><?php echo $existing_rate[$i]->room_rate; ?></td>         
               <td>    
                  <?php if($existing_rate[$i]->status==1){ ?>  
                  <label class="label label-success">Active</label>
                    <?php } else if($existing_rate[$i]->status==0) { ?>
                     <label class="label label-danger">Inactive</label>
                    <?php } else if($existing_rate[$i]->status==2) { ?>
                     <label class="label label-warning">Blocked</label>
                    <?php } ?>
                </td> 
                  <td class="none"><?php echo $existing_rate[$i]->booking_code; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_adults_rate; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_child_rate; ?></td>
                 <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_adults; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_child; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->min_room_occupancy; ?></td>
               <td class="none"><?php echo $existing_rate[$i]->max_room_occupancy; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->min_adults_without_extra_bed; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->max_adults_without_extra_bed; ?></td> 
                <td class="none"><?php echo $existing_rate[$i]->min_child_without_extra_bed; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->max_child_without_extra_bed; ?></td>                   
            
               <td class="none">
              <?php 
                    $meal_arrr=explode(',',$existing_rate[$i]->meal_plan);
                    $meal_plan=array();
                    for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
                    {
                      $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
                    }
                    $meal_plan_str=implode(' , ', $meal_plan);           
                    echo $meal_plan_str;
                    ?>  
              </td> 
            
         
      <td class="none"><?php echo $existing_rate[$i]->specialoffer_type; ?></td>
       <!-- <td class="none"><?php echo $existing_rate[$i]->supplement_compulsory; ?></td>  -->
      <td class="none">
      <?php 
              $special_str='';
              if($existing_rate[$i]->prior_day_type=="prior_checkin")
               {
                  $special_str.="\nNumber of Prior Checkin Days :".$existing_rate[$i]->prior_checkin;
               }
               if($existing_rate[$i]->prior_day_type=="prior_checkin_date")
               {
                  $special_str.="\nPrior Booking Date :".date('d-m-Y',strtotime($existing_rate[$i]->prior_checkin_date));
               }
               if($existing_rate[$i]->prior_day_type=="period")
               {
                  $special_str.="\nPrior Booking Period : From ".date('d-m-Y',strtotime($existing_rate[$i]->period_from_date)).' to '.date('d-m-Y',strtotime($existing_rate[$i]->period_to_date));
               }
      echo $special_str; ?></td>
      <td class="none">
         <?php   if($existing_rate[$i]->discount_rate_type=='net'){ 
          echo 'NET Discount';
           } if($existing_rate[$i]->discount_rate_type=='gross'){ 
           echo 'GROSS Discount';
         } ?>
      </td>
      <td class="none"><?php echo $existing_rate[$i]->discount_percentage;?></td>

              </tr>  
             <?php $sl++; } } } ?>            
           </tbody>
         </table>

<?php } else if(!empty($existing_rate[0])&&$existing_rate[0]->specialoffer_id==3 && $existing_rate[0]->specialoffer_type=="Stay Pay") { ?>
   <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="existing_ratetable2">
            <thead>
             <tr>  
              <th>Select</th>             
              <th>Dates</th>
              <th>Rate Type</th>
              <th>Adult Rate</th>
              <th>Child Rate</th>
              <th>Room Rate</th>  
              <th>Status</th>             
              <th class="none">Booking Code</th> 
              <th class="none">Adult Rate For Extra Bed</th>
              <th class="none">Child Rate For Extra Bed</th>     
              <th class="none">Extra Bed For Adults</th>
              <th class="none">Extra Bed For Chlid</th>
              <th class="none">Min Room Occupancy</th>
              <th class="none">Max Room Occupancy</th> 
              <th class="none">Min Adults Without Extra Bed</th>
              <th class="none">Max Adults Without Extra Bed</th>                
              <th class="none">Min Child Without Extra Bed</th>                
              <th class="none">Max Child Without Extra Bed</th> 
              <th class="none">Meal Plan</th>
              <th class="none">Special Offer Type</th>
            <!--   <th class="none">Special Offer Applicable On Supplement</th> -->
              <th class="none">Prior Days/Booking Date or Booking Periods</th>
              <th class="none">Min number of stay days</th>
              <th class="none">Max number of stay days</th>
              <th class="none">No of free nights</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($existing_rate)) { 
              for($i=0,$sl=0;$i<count($existing_rate);$i++){  
              if($existing_rate[$i]->specialoffer_id==3 && $existing_rate[$i]->specialoffer_type=="Stay Pay"){     
               ?>
              <tr>
                <td>             
                    <input type="checkbox" class="rate_list" name="rate_list" value="<?php echo $existing_rate[$i]->sup_hotel_room_rates_list_id; ?>" onchange="check_existing_rate(this);">          
               </td>    
               <td><?php echo ' From '.date('d-m-Y',strtotime($existing_rate[$i]->from_date)).'<br> To '.date('d-m-Y',strtotime($existing_rate[$i]->to_date)).'<br> Last Updated Date and Time :<br>'.date('d-M-Y H:i:s',strtotime($existing_rate[$i]->last_updated));?>
               </td>
                <td><?php if($existing_rate[$i]->rate_type=='PPPN'){echo 'Per Person Per Night ( PPPN )';}else if($existing_rate[$i]->rate_type=='PRPN'){echo ' Per Room Per Night ( PRPN )';} ?></td>
                <td><?php echo $existing_rate[$i]->adult_rate; ?></td>
                <td>   
                  <?php 
                      $child_rate=json_decode($existing_rate[$i]->child_rate,true);                 
                      if(!empty($child_rate[0]))
                      {                    
                        foreach ($child_rate as $key => $value)
                        { 
                          $val=explode('||', $value);   
                          $val1=explode('-', $val[0]);   
                          echo 'Age( '.$val[0].' ) '.$val[1].'<br>'; 
                        }
                      }
                    ?>
                 </td>   
                <td><?php echo $existing_rate[$i]->room_rate; ?></td>
                <td>    
                  <?php if($existing_rate[$i]->status==1){ ?>  
                  <label class="label label-success">Active</label>
                    <?php } else if($existing_rate[$i]->status==0) { ?>
                     <label class="label label-danger">Inactive</label>
                    <?php } else if($existing_rate[$i]->status==2) { ?>
                     <label class="label label-warning">Blocked</label>
                    <?php } ?>
                </td> 
                <td class="none"><?php echo $existing_rate[$i]->booking_code; ?></td>            
                <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_adults_rate; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_child_rate; ?></td>
                 <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_adults; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_child; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->min_room_occupancy; ?></td>
               <td class="none"><?php echo $existing_rate[$i]->max_room_occupancy; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->min_adults_without_extra_bed; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->max_adults_without_extra_bed; ?></td> 
                <td class="none"><?php echo $existing_rate[$i]->min_child_without_extra_bed; ?></td>
                <td class="none"><?php echo $existing_rate[$i]->max_child_without_extra_bed; ?></td>
               
               <td class="none">
              <?php 
                    $meal_arrr=explode(',',$existing_rate[$i]->meal_plan);
                    $meal_plan=array();
                    for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
                    {
                      $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
                    }
                    $meal_plan_str=implode(' , ', $meal_plan);           
                    echo $meal_plan_str;
                    ?>  
              </td> 
             
           
      <td class="none"><?php echo $existing_rate[$i]->specialoffer_type; ?></td>
       <!-- <td class="none"><?php echo $existing_rate[$i]->supplement_compulsory; ?></td>  -->
      <td class="none"><?php 
              $special_str='';
              if($existing_rate[$i]->prior_day_type=="prior_checkin")
               {
                  $special_str.="\nNumber of Prior Checkin Days :".$existing_rate[$i]->prior_checkin;
               }
               if($existing_rate[$i]->prior_day_type=="prior_checkin_date")
               {
                  $special_str.="\nPrior Booking Date :".date('d-m-Y',strtotime($existing_rate[$i]->prior_checkin_date));
               }
               if($existing_rate[$i]->prior_day_type=="period")
               {
                  $special_str.="\nPrior Booking Period : From ".date('d-m-Y',strtotime($existing_rate[$i]->period_from_date)).' to '.date('d-m-Y',strtotime($existing_rate[$i]->period_to_date));
               }
      echo $special_str; ?></td>
      <td class="none"><?php echo $existing_rate[$i]->min_no_of_stay_day; ?></td>
      <td class="none"><?php echo $existing_rate[$i]->max_no_of_stay_day; ?></td>
      <td class="none"><?php echo $existing_rate[$i]->no_of_stay_free_nights;?></td>

              </tr>  
             <?php  $sl++; } } } ?>            
           </tbody>
         </table>
  <?php } ?>

  </div>


  </div>
  </form>
 <script type="text/javascript">   
 function check_existing_rate(t)
 {
   $('.rate_list').not(t).prop('checked', false);     
 }
</script>
<script type="text/javascript">
$(document).ready(function() {
  $('#existing_ratetable1, #existing_ratetable2').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [{extend:'pageLength', className: "btn-primary"},{       
                      extend: 'excel',
                      text: 'Export Excel',
                      exportOptions: {
                        rows: { selected: true }                                                
                      },
                      className: "btn-success"
                    }],
                    lengthMenu: [
                    [5, 10, 25, 50, -1 ],
                    ['5 rows','10 rows', '25 rows', '50 rows', 'Show all' ]
                    ]
                  });
  $("#hideexistingrate").on('click',function(){
    $("#existingrate").html(''); 
  });
  $("#addexistingrate").on('click',function(){
   $rate_list=$(".rate_list:checked");
   if(parseInt($rate_list.length)==0)
   {
    alert("Select Any One Option From Below Rate List");
   }
   else
   {
      $("#add_duplicates_rates").submit();

   }

  });
  });

</script> 