 <form action="<?php echo site_url();?>roomrates/add_duplicates_rates" id="add_duplicates_rates" method="post"> 
<div class="row border_row">         
               <div class="form-group col-md-2">
                 <input  class="btn btn-success" type="button" id="addexistingrate" value="Add Existing Rate" />
               </div> 
                <div class="form-group col-md-2">
                 <input  class="btn btn-success" type="button" id="hideexistingrate" value="Hide Existing Rate" />
               </div>              
</div> 
<div class="row border_row">
<h4 style="margin-left: 10px;">Per Person Per Night (PPPN)</h4>
            <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="existing_ratetable1">
             <thead>           
              <tr>
                <th>Select</th> 
                <th>Dates</th>                 
                <th>Adult Rate</th>
                <th>Child Rate</th>
                <th>Meal Plan</th>
                <th>Min room occupancy</th> 
                <th>Max room occupancy</th> 
                <th>Status</th>
                <th class="none">Extra bed for Adults</th>
                <th class="none">Extra bed for Child</th> 
                <th class="none">Adults rate for Extra bed</th>
                <th class="none">Child rate for Extra bed</th> 
                                    
              </tr>             
            </thead>
            <tbody>
              <?php 
              for($i=0;$i<count($existing_rate)&&!empty($existing_rate[0]);$i++)
              { 
              if($existing_rate[$i]->rate_type=='PPPN')  { ?>
              <tr>                
                <td>             
                    <input type="checkbox" class="rate_list" name="rate_list" value="<?php echo $existing_rate[$i]->sup_hotel_room_rates_list_id; ?>" onchange="check_existing_rate(this);">          
               </td>
               <td>
                <?php echo 'From '.date('d-M-Y',strtotime($existing_rate[$i]->from_date)).' <br> To'.date('d-M-Y',strtotime($existing_rate[$i]->to_date)).'<br>Last Update Time : <br>'.date('d-M-Y H:i:s',strtotime($existing_rate[$i]->last_updated));?>
                </td>
                <td><?php echo $existing_rate[$i]->adult_rate;?></td>
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
                 <td>
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
                <td><?php echo $existing_rate[$i]->min_room_occupancy;?></td>
                <td><?php echo $existing_rate[$i]->max_room_occupancy;?></td>
                <td>    
                  <?php if($existing_rate[$i]->status==1){ ?>  
                  <label class="label label-success">Active</label>
                    <?php } else if($existing_rate[$i]->status==0) { ?>
                     <label class="label label-danger">Inactive</label>
                    <?php } else if($existing_rate[$i]->status==2) { ?>
                     <label class="label label-warning">Blocked</label>
                    <?php } ?>
                </td> 
                <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_adults;?></td>
                <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_child;?></td>
                <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_adults_rate;?></td>
                <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_child_rate;?></td>
             
              </tr>
              <?php } } ?>
            </tbody>
          </table>            
  </div>

<div class="row border_row">
<h4 style="margin-left: 10px;">Per Room Per Night (PRPN)</h4>
            <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="existing_ratetable2">
             <thead>           
              <tr>
                <th>Select.</th>
                <th>Dates</th>                              
                <th>Room Rate</th>
                <th>Meal Plan</th>
                <th>Status</th>
                <th>Min adults without extra bed</th>
                <th>Max adults without extra bed</th> 
                <th>Min Child without extra bed</th> 
                <th class="none">Max Child without extra bed</th>
                <th class="none">Min room occupancy</th> 
                <th class="none">Max room occupancy</th> 
                <th class="none">Extra bed for Adults</th>
                <th class="none">Extra bed for Child</th> 
                <th class="none">Adults rate for Extra bed</th>
                <th class="none">Child rate for Extra bed</th> 
                
                                           
              </tr>             
            </thead>
            <tbody>
              <?php
              for($i=0;$i<count($existing_rate)&&!empty($existing_rate[0]);$i++)
                {  
               if($existing_rate[$i]->rate_type=='PRPN')  { ?>
              <tr>                
               <td>             
                    <input type="checkbox" class="rate_list" name="rate_list" value="<?php echo $existing_rate[$i]->sup_hotel_room_rates_list_id; ?>" onchange="check_existing_rate(this);">          
               </td>
               <td>
                <?php echo 'From '.date('d-M-Y',strtotime($existing_rate[$i]->from_date)).' <br> To'.date('d-M-Y',strtotime($existing_rate[$i]->to_date)).'<br>Last Update Time : <br>'.date('d-M-Y H:i:s',strtotime($existing_rate[$i]->last_updated));?>
                </td>
                <td><?php echo $existing_rate[$i]->room_rate;?></td>
                 <td>
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
                  <td>    
                  <?php if($existing_rate[$i]->status==1){ ?>  
                  <label class="label label-success">Active</label>
                    <?php } else if($existing_rate[$i]->status==0) { ?>
                     <label class="label label-danger">Inactive</label>
                    <?php } else if($existing_rate[$i]->status==2) { ?>
                     <label class="label label-warning">Blocked</label>
                    <?php } ?>
                </td> 
                <td><?php echo $existing_rate[$i]->min_adults_without_extra_bed;?></td>
                <td><?php echo $existing_rate[$i]->max_adults_without_extra_bed;?></td>
                <td><?php echo $existing_rate[$i]->min_child_without_extra_bed;?></td>
                <td class="none"><?php echo $existing_rate[$i]->max_child_without_extra_bed;?></td>
                <td class="none"><?php echo $existing_rate[$i]->min_room_occupancy;?></td>
                <td class="none"><?php echo $existing_rate[$i]->max_room_occupancy;?></td>
                <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_adults;?></td>
                <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_child;?></td>
                <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_adults_rate;?></td>
                <td class="none"><?php echo $existing_rate[$i]->extra_bed_for_child_rate;?></td>
                
              </tr>
              <?php } } ?>
            </tbody>
          </table>            
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