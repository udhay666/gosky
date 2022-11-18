<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">

<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
  var site_url='<?php echo site_url(); ?>';
</script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font">Manage Room Rate Status</h1>
            <ul class="controls">
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>
          <div class="boxs-body">
            <?php 
            $sess_msg = $this->session->flashdata('message');
            if(!empty($sess_msg)){
              $message = $sess_msg;
              $class = 'success';
            } else {
              $message = $error;
              $class = 'danger';
            }
            ?>
            <?php if($message){ ?>
            <br>
            <div class="alert alert-<?php echo $class ?>">
              <button class="close" data-dismiss="alert" type="button">×</button>
              <strong><?php echo ucfirst($class) ?>....!</strong>
              <?php echo $message; ?>
            </div>
            <?php } ?>
       
      
            <div class="row">         
            <h4 style="margin-left: 10px;">Normal Rate </h4>        
            <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table1">
              <thead>
               <tr>  
                <th>SL No.</th>  
                <th>Room</th>
                <th>Dates</th>
                <th>Rate Type</th>
                <th>Room Rate</th>                       
                <th>Adult Rate</th> 
                <th>Child Rate</th>                     
                <th>Status</th>
                <th>Action</th>  
                <th>Add Existing Rate</th>  
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
                <th class="none">Hotel</th>                
                <th class="none">Contract Number</th> 
                <th class="none">Meal Plan</th>
                <th class="none">Market</th>              
              </tr>
            </thead>
            <tbody>
              <?php if(!empty($normal_room_rate)) { 
                for($i=0,$k=1;$i<count($normal_room_rate);$i++){ 
               
                   ?>
                   <tr>
                    <td><?php echo $k++; ?></td>
                    <td><?php echo $room_name; ?></td>
                    <td><?php echo ' From '.date('d-m-Y',strtotime($normal_room_rate[$i]->from_date)).'<br> To '.date('d-m-Y',strtotime($normal_room_rate[$i]->to_date)).'<br> Last Updated Date and Time :<br>'.date('d-M-Y H:i:s',strtotime($normal_room_rate[$i]->last_updated));?>
                    </td>
                    <td><?php if($normal_room_rate[$i]->rate_type=='PPPN'){echo 'Per Person Per Night';}else if($normal_room_rate[$i]->rate_type=='PRPN'){echo ' Per Room Per Night';} ?></td>              
                    <td><?php echo $normal_room_rate[$i]->room_rate; ?></td>

                  <td><?php echo $normal_room_rate[$i]->adult_rate; ?></td>
                  <td>   
                  <?php 
                      $child_rate=json_decode($normal_room_rate[$i]->child_rate,true);                 
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
                 <?php if($normal_room_rate[$i]->status==1){ ?>  
                  <label class="label label-success">Active</label>
                    <?php } else { ?>
                     <label class="label label-danger">Inactive</label>
                    <?php } ?>
                  </td>
                  <td> 
                   <?php if($normal_room_rate[$i]->status==1){ ?>                  
                     <a class="btn btn-warning btn-xs"  data-id="<?php echo $normal_room_rate[$i]->sup_hotel_room_rates_list_id;?>"  data-status="0" data-val="room/set_normal_room_rate_status"  onclick="return set_room_rate_status(this)" data-index="<?php echo ($i+1); ?>"  title="Do you really want to this Room Rate InActive ?"><i class="fa fa-times"></i>InActive</a>
                      <?php } else { ?>                    
                        <a class="btn btn-success btn-xs"  data-id="<?php echo $normal_room_rate[$i]->sup_hotel_room_rates_list_id;?>"  data-status="1" data-val="room/set_normal_room_rate_status"  onclick="return set_room_rate_status(this)" data-index="<?php echo ($i+1); ?>"  title="Do you really want to this Room Rate Active ?"><i class="fa fa-check"></i>Active</a>          
                    <?php } ?>
                  </td>
                  <td>
                    <form name="frmHotelDetails" method="post" action="<?php echo site_url(); ?>roomrates/add_duplicates_rates" target="_blank">
                          <input type="hidden" name="rate_list" value="<?php echo $normal_room_rate[$i]->sup_hotel_room_rates_list_id; ?>" />
                          <button class="btn btn-info btn-xs" title="Add Existing Rate">Add Existing Rate</button>
                        </form>
                      </td>
                     <td class="none"><?php echo $normal_room_rate[$i]->extra_bed_for_adults_rate; ?></td>
                     <td class="none"><?php echo $normal_room_rate[$i]->extra_bed_for_child_rate; ?></td>
                     <td class="none"><?php echo $normal_room_rate[$i]->extra_bed_for_adults; ?></td>
                     <td class="none"><?php echo $normal_room_rate[$i]->extra_bed_for_child; ?></td>
                     <td class="none"><?php echo $normal_room_rate[$i]->min_room_occupancy; ?></td>
                     <td class="none"><?php echo $normal_room_rate[$i]->max_room_occupancy; ?></td>
                     <td class="none"><?php echo $normal_room_rate[$i]->min_adults_without_extra_bed; ?></td>
                     <td class="none"><?php echo $normal_room_rate[$i]->max_adults_without_extra_bed; ?></td> 
                     <td class="none"><?php echo $normal_room_rate[$i]->min_child_without_extra_bed; ?></td>
                     <td class="none"><?php echo $normal_room_rate[$i]->max_child_without_extra_bed; ?></td>
                     <td class="none"><?php echo $hotel_name;?></td>                
                     <td class="none">
                      <?php  
                      echo $this->sup_contract->get_single($normal_room_rate[$i]->contract_id)->contract_number;
                      ?>
                    </td> 
                    <td class="none">
                      <?php 
                      $meal_arrr=explode(',',$normal_room_rate[$i]->meal_plan);
                      $meal_plan=array();
                      for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
                      {
                        $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
                      }
                      $meal_plan_str=implode(' , ', $meal_plan);           
                      echo $meal_plan_str;
                      ?>
                    </td> 
                    <td class="none"><?php  echo $normal_room_rate[$i]->market; ?></td>  
                  
                  </tr>  
                  <?php  } } ?>            
                </tbody>
              </table>

                     <h4 class="custom-font"> Special Offer Type : Discount </h4>               
           <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table2">
            <thead>
             <tr>  
              <th>SL No.</th>  
              <th>Room</th>
              <th>Dates</th>
              <th>Rate Type</th>
              <th>Room Rate</th>
              <th>Adult Rate</th>             
              <th>Child Rate</th>                   
              <th>Status</th>
              <th>Action</th>  
              <th>Add Existing Rate</th>                
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
              <th class="none">Hotel</th>                
              <th class="none">Contract Number</th> 
              <th class="none">Meal Plan</th>
              <th class="none">Market</th>
              <th class="none">Special Offer Type</th>             
              <!-- <th class="none">Special Offer Applicable On Supplement</th> -->
              <th class="none">Discount Type</th>
              <th class="none">Min number of Nights</th>
              <th class="none">Max number of Nights</th>
              <th class="none">Discount Percentage(%)</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($specialoffer_room_rate)) { 
              for($i=0,$sl=0;$i<count($specialoffer_room_rate);$i++){  
              if($specialoffer_room_rate[$i]->specialoffer_id==1 && $specialoffer_room_rate[$i]->specialoffer_type=="Discount"){     
               ?>
              <tr>
                <td><?php echo ($sl+1);  ?></td>
                 <td><?php echo $room_name;?></td>
               <td><?php echo ' From '.date('d-m-Y',strtotime($specialoffer_room_rate[$i]->from_date)).'<br> To '.date('d-m-Y',strtotime($specialoffer_room_rate[$i]->to_date)).'<br> Last Updated Date and Time :<br>'.date('d-M-Y H:i:s',strtotime($specialoffer_room_rate[$i]->last_updated));?>
               </td>
                <td><?php if($specialoffer_room_rate[$i]->rate_type=='PPPN'){echo 'Per Person Per Night';}else if($specialoffer_room_rate[$i]->rate_type=='PRPN'){echo ' Per Room Per Night';} ?></td>
                <td><?php echo $specialoffer_room_rate[$i]->adult_rate; ?></td>
                <td>   
                  <?php 
                      $child_rate=json_decode($specialoffer_room_rate[$i]->child_rate,true);                 
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
                <td><?php echo $specialoffer_room_rate[$i]->room_rate; ?></td>

           
                <td>       
                 <?php if($specialoffer_room_rate[$i]->status==1){ ?>  
                  <label class="label label-success">Active</label>
                    <?php } else { ?>
                     <label class="label label-danger">Inactive</label>
                    <?php } ?>
                  </td>
                  <td> 
                   <?php if($specialoffer_room_rate[$i]->status==1){ ?>   
                    <a class="btn btn-warning btn-xs"  data-id="<?php echo $specialoffer_room_rate[$i]->sup_hotel_room_rates_list_id;?>"  data-status="0" data-val="room/set_specialoffer_room_rate_status"  onclick="return set_room_rate_status(this)" data-index="<?php echo ($i+1); ?>"  title="Do you really want to this Room Rate InActive ?"><i class="fa fa-times"></i>InActive</a>
                      <?php } else { ?>                    
                        <a class="btn btn-success btn-xs"  data-id="<?php echo $specialoffer_room_rate[$i]->sup_hotel_room_rates_list_id;?>"  data-status="1" data-val="room/set_specialoffer_room_rate_status"  onclick="return set_room_rate_status(this)" data-index="<?php echo ($i+1); ?>"  title="Do you really want to this Room Rate Active ?"><i class="fa fa-check"></i>Active</a>          
                    <?php } ?>
                  </td>
                   <td>
                    <form name="frmHotelDetails" method="post" action="<?php echo site_url(); ?>specialoffer/add_duplicates_rates" target="_blank">
                          <input type="hidden" name="rate_list" value="<?php echo $specialoffer_room_rate[$i]->sup_hotel_room_rates_list_id; ?>" />
                          <button class="btn btn-info btn-xs" title="Add Existing Rate">Add Existing Rate</button>
                        </form>
                      </td>
                  <td class="none"><?php echo $specialoffer_room_rate[$i]->booking_code; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->extra_bed_for_adults_rate; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->extra_bed_for_child_rate; ?></td>
                 <td class="none"><?php echo $specialoffer_room_rate[$i]->extra_bed_for_adults; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->extra_bed_for_child; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->min_room_occupancy; ?></td>
               <td class="none"><?php echo $specialoffer_room_rate[$i]->max_room_occupancy; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->min_adults_without_extra_bed; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->max_adults_without_extra_bed; ?></td> 
                <td class="none"><?php echo $specialoffer_room_rate[$i]->min_child_without_extra_bed; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->max_child_without_extra_bed; ?></td>
                 <td class="none"><?php echo $hotel_name;?></td>                
              <td class="none">
              <?php  
                 echo $this->sup_contract->get_single($specialoffer_room_rate[$i]->contract_id)->contract_number;
                   ?>
              </td> 
               <td class="none">
              <?php 
                    $meal_arrr=explode(',',$specialoffer_room_rate[$i]->meal_plan);
                    $meal_plan=array();
                    for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
                    {
                      $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
                    }
                    $meal_plan_str=implode(' , ', $meal_plan);           
                    echo $meal_plan_str;
                    ?>  
              </td> 
              <td class="none"><?php  echo $specialoffer_room_rate[$i]->market;?></td>  
         
      <td class="none"><?php echo $specialoffer_room_rate[$i]->specialoffer_type; ?></td> 
      <!-- <td class="none"><?php echo $specialoffer_room_rate[$i]->supplement_compulsory; ?></td>    -->
      <td class="none">
         <?php   if($specialoffer_room_rate[$i]->discount_rate_type=='net'){ 
          echo 'NET Discount';
           } if($specialoffer_room_rate[$i]->discount_rate_type=='gross'){ 
           echo 'GROSS Discount';
         } ?>
      </td>
      <td class="none"><?php echo $specialoffer_room_rate[$i]->min_no_of_stay_day; ?></td>
      <td class="none"><?php echo $specialoffer_room_rate[$i]->max_no_of_stay_day; ?></td>
      <td class="none"><?php echo $specialoffer_room_rate[$i]->discount_percentage;?></td>

              </tr>  
             <?php $sl++; } } } ?>            
           </tbody>
         </table>
         
           <h4 class="custom-font"> Special Offer Type : Early Bird </h4>               
           <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table3">
            <thead>
             <tr>  
              <th>SL No.</th>  
              <th>Room</th>
              <th>Dates</th>
              <th>Rate Type</th>             
              <th>Room Rate</th>
              <th>Adult Rate</th>
              <th>Child Rate</th>                  
              <th>Status</th>
              <th>Action</th>  
              <th>Add Existing Rate</th>  
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
              <th class="none">Hotel</th>                
              <th class="none">Contract Number</th> 
              <th class="none">Meal Plan</th>
              <th class="none">Market</th>           
              <th class="none">Special Offer Type</th>
              <!-- <th class="none">Special Offer Applicable On Supplement</th> -->
              <th class="none">Prior Days/Booking Date or Booking Periods</th>
              <th class="none">Discount Type</th>
              <th class="none">Discount Percentage(%)</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($specialoffer_room_rate)) { 
              for($i=0,$sl=0;$i<count($specialoffer_room_rate);$i++){  
              if($specialoffer_room_rate[$i]->specialoffer_id==2 && $specialoffer_room_rate[$i]->specialoffer_type=="Early bird"){     
               ?>
              <tr>
                <td><?php echo ($sl+1);  ?></td>
                 <td><?php echo $room_name;?></td>
               <td><?php echo ' From '.date('d-m-Y',strtotime($specialoffer_room_rate[$i]->from_date)).'<br> To '.date('d-m-Y',strtotime($specialoffer_room_rate[$i]->to_date)).'<br> Last Updated Date and Time :<br>'.date('d-M-Y H:i:s',strtotime($specialoffer_room_rate[$i]->last_updated));?>
               </td>
                <td><?php if($specialoffer_room_rate[$i]->rate_type=='PPPN'){echo 'Per Person Per Night';}else if($specialoffer_room_rate[$i]->rate_type=='PRPN'){echo ' Per Room Per Night';} ?></td>
                  <td><?php echo $specialoffer_room_rate[$i]->room_rate; ?></td>
                <td><?php echo $specialoffer_room_rate[$i]->adult_rate; ?></td>
                <td>   
                  <?php 
                      $child_rate=json_decode($specialoffer_room_rate[$i]->child_rate,true);                 
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
                 <?php if($specialoffer_room_rate[$i]->status==1){ ?>  
                  <label class="label label-success">Active</label>
                    <?php } else { ?>
                     <label class="label label-danger">Inactive</label>
                    <?php } ?>
                  </td>
                  <td> 
                   <?php if($specialoffer_room_rate[$i]->status==1){ ?>   
                    <a class="btn btn-warning btn-xs"  data-id="<?php echo $specialoffer_room_rate[$i]->sup_hotel_room_rates_list_id;?>"  data-status="0" data-val="room/set_specialoffer_room_rate_status"  onclick="return set_room_rate_status(this)" data-index="<?php echo ($i+1); ?>"  title="Do you really want to this Room Rate InActive ?"><i class="fa fa-times"></i>InActive</a>
                      <?php } else { ?>                    
                        <a class="btn btn-success btn-xs"  data-id="<?php echo $specialoffer_room_rate[$i]->sup_hotel_room_rates_list_id;?>"  data-status="1" data-val="room/set_specialoffer_room_rate_status"  onclick="return set_room_rate_status(this)" data-index="<?php echo ($i+1); ?>"  title="Do you really want to this Room Rate Active ?"><i class="fa fa-check"></i>Active</a>          
                    <?php } ?>
                  </td>
                   <td>
                    <form name="frmHotelDetails" method="post" action="<?php echo site_url(); ?>specialoffer/add_duplicates_rates" target="_blank">
                          <input type="hidden" name="rate_list" value="<?php echo $specialoffer_room_rate[$i]->sup_hotel_room_rates_list_id; ?>" />
                          <button class="btn btn-info btn-xs" title="Add Existing Rate">Add Existing Rate</button>
                        </form>
                      </td>
                  <td class="none"><?php echo $specialoffer_room_rate[$i]->booking_code; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->extra_bed_for_adults_rate; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->extra_bed_for_child_rate; ?></td>
                 <td class="none"><?php echo $specialoffer_room_rate[$i]->extra_bed_for_adults; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->extra_bed_for_child; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->min_room_occupancy; ?></td>
               <td class="none"><?php echo $specialoffer_room_rate[$i]->max_room_occupancy; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->min_adults_without_extra_bed; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->max_adults_without_extra_bed; ?></td> 
                <td class="none"><?php echo $specialoffer_room_rate[$i]->min_child_without_extra_bed; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->max_child_without_extra_bed; ?></td>
                 <td class="none"><?php echo $hotel_name;?></td>                
              <td class="none">
              <?php  
                 echo $this->sup_contract->get_single($specialoffer_room_rate[$i]->contract_id)->contract_number;
                   ?>
              </td> 
               <td class="none">
              <?php 
                    $meal_arrr=explode(',',$specialoffer_room_rate[$i]->meal_plan);
                    $meal_plan=array();
                    for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
                    {
                      $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
                    }
                    $meal_plan_str=implode(' , ', $meal_plan);           
                    echo $meal_plan_str;
                    ?>  
              </td> 
              <td class="none"><?php  echo $specialoffer_room_rate[$i]->market;?></td>  
         
      <td class="none"><?php echo $specialoffer_room_rate[$i]->specialoffer_type; ?></td>
     <!-- <td class="none"><?php echo $specialoffer_room_rate[$i]->supplement_compulsory; ?></td> -->
      <td class="none">
      <?php 
              $special_str='';
              if($specialoffer_room_rate[$i]->prior_day_type=="prior_checkin")
               {
                  $special_str.="\nNumber of Prior Checkin Days :".$specialoffer_room_rate[$i]->prior_checkin;
               }
               if($specialoffer_room_rate[$i]->prior_day_type=="prior_checkin_date")
               {
                  $special_str.="\nPrior Booking Date :".date('d-m-Y',strtotime($specialoffer_room_rate[$i]->prior_checkin_date));
               }
               if($specialoffer_room_rate[$i]->prior_day_type=="period")
               {
                  $special_str.="\nPrior Booking Period : From ".date('d-m-Y',strtotime($specialoffer_room_rate[$i]->period_from_date)).' to '.date('d-m-Y',strtotime($specialoffer_room_rate[$i]->period_to_date));
               }
      echo $special_str; ?></td>
      <td class="none">
         <?php   if($specialoffer_room_rate[$i]->discount_rate_type=='net'){ 
          echo 'NET Discount';
           } if($specialoffer_room_rate[$i]->discount_rate_type=='gross'){ 
           echo 'GROSS Discount';
         } ?>
      </td>
      <td class="none"><?php echo $specialoffer_room_rate[$i]->discount_percentage;?></td>

              </tr>  
             <?php $sl++; } } } ?>            
           </tbody>
         </table>
      
           <h4 class="custom-font"> Special Offer Type : Stay Pay </h4>
                
           <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table4">
            <thead>
             <tr>  
              <th>SL No.</th>  
              <th>Room</th>
              <th>Dates</th>
              <th>Rate Type</th>
              <th>Room Rate</th>                        
              <th>Adult Rate</th> 
              <th>Child Rate</th>                  
              <th>Status</th>
              <th>Action</th>  
              <th>Add Existing Rate</th>  
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
              <th class="none">Hotel</th>                
              <th class="none">Contract Number</th> 
              <th class="none">Meal Plan</th>
              <th class="none">Market</th>          
              <th class="none">Special Offer Type</th>
              <!-- <th class="none">Special Offer Applicable On Supplement</th> -->
              <th class="none">Prior Days/Booking Date or Booking Periods</th>
              <th class="none">Min number of stay days</th>
              <th class="none">Max number of stay days</th>
              <th class="none">No of free nights</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($specialoffer_room_rate)) { 
              for($i=0,$sl=0;$i<count($specialoffer_room_rate);$i++){  
              if($specialoffer_room_rate[$i]->specialoffer_id==3 && $specialoffer_room_rate[$i]->specialoffer_type=="Stay Pay"){     
               ?>
              <tr>
                <td><?php echo ($sl+1);  ?></td>
                 <td><?php echo $room_name;?></td>
               <td><?php echo ' From '.date('d-m-Y',strtotime($specialoffer_room_rate[$i]->from_date)).'<br> To '.date('d-m-Y',strtotime($specialoffer_room_rate[$i]->to_date)).'<br> Last Updated Date and Time :<br>'.date('d-M-Y H:i:s',strtotime($specialoffer_room_rate[$i]->last_updated));?>
               </td>
                <td><?php if($specialoffer_room_rate[$i]->rate_type=='PPPN'){echo 'Per Person Per Night';}else if($specialoffer_room_rate[$i]->rate_type=='PRPN'){echo ' Per Room Per Night';} ?></td>
                <td><?php echo $specialoffer_room_rate[$i]->room_rate; ?></td>
                <td><?php echo $specialoffer_room_rate[$i]->adult_rate; ?></td>
                <td>   
                  <?php 
                      $child_rate=json_decode($specialoffer_room_rate[$i]->child_rate,true);                 
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
                 <?php if($specialoffer_room_rate[$i]->status==1){ ?>  
                  <label class="label label-success">Active</label>
                    <?php } else { ?>
                     <label class="label label-danger">Inactive</label>
                    <?php } ?>
                  </td>
                  <td> 
                   <?php if($specialoffer_room_rate[$i]->status==1){ ?> 
                    <a class="btn btn-warning btn-xs"  data-id="<?php echo $specialoffer_room_rate[$i]->sup_hotel_room_rates_list_id;?>"  data-status="0" data-val="room/set_specialoffer_room_rate_status"  onclick="return set_room_rate_status(this)" data-index="<?php echo ($i+1); ?>"  title="Do you really want to this Room Rate InActive ?"><i class="fa fa-times"></i>InActive</a>
                      <?php } else { ?>                    
                        <a class="btn btn-success btn-xs"  data-id="<?php echo $specialoffer_room_rate[$i]->sup_hotel_room_rates_list_id;?>"  data-status="1" data-val="room/set_specialoffer_room_rate_status"  onclick="return set_room_rate_status(this)" data-index="<?php echo ($i+1); ?>"  title="Do you really want to this Room Rate Active ?"><i class="fa fa-check"></i>Active</a>          
                    <?php } ?>
                  </td>
                   <td>
                    <form name="frmHotelDetails" method="post" action="<?php echo site_url(); ?>specialoffer/add_duplicates_rates" target="_blank">
                          <input type="hidden" name="rate_list" value="<?php echo $specialoffer_room_rate[$i]->sup_hotel_room_rates_list_id; ?>" />
                          <button class="btn btn-info btn-xs" title="Add Existing Rate">Add Existing Rate</button>
                        </form>
                      </td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->booking_code; ?></td>            
                <td class="none"><?php echo $specialoffer_room_rate[$i]->extra_bed_for_adults_rate; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->extra_bed_for_child_rate; ?></td>
                 <td class="none"><?php echo $specialoffer_room_rate[$i]->extra_bed_for_adults; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->extra_bed_for_child; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->min_room_occupancy; ?></td>
               <td class="none"><?php echo $specialoffer_room_rate[$i]->max_room_occupancy; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->min_adults_without_extra_bed; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->max_adults_without_extra_bed; ?></td> 
                <td class="none"><?php echo $specialoffer_room_rate[$i]->min_child_without_extra_bed; ?></td>
                <td class="none"><?php echo $specialoffer_room_rate[$i]->max_child_without_extra_bed; ?></td>
                 <td class="none"><?php echo $hotel_name;?></td>                
              <td class="none">
              <?php  
                 echo $this->sup_contract->get_single($specialoffer_room_rate[$i]->contract_id)->contract_number;
                   ?>
              </td> 
               <td class="none">
              <?php 
                    $meal_arrr=explode(',',$specialoffer_room_rate[$i]->meal_plan);
                    $meal_plan=array();
                    for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
                    {
                      $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
                    }
                    $meal_plan_str=implode(' , ', $meal_plan);           
                    echo $meal_plan_str;
                    ?>  
              </td> 
              <td class="none"><?php  echo $specialoffer_room_rate[$i]->market;?></td>  
           
      <td class="none"><?php echo $specialoffer_room_rate[$i]->specialoffer_type; ?></td>
       <!-- <td class="none"><?php echo $specialoffer_room_rate[$i]->supplement_compulsory; ?></td> -->
      <td class="none"><?php 
              $special_str='';
              if($specialoffer_room_rate[$i]->prior_day_type=="prior_checkin")
               {
                  $special_str.="\nNumber of Prior Checkin Days :".$specialoffer_room_rate[$i]->prior_checkin;
               }
               if($specialoffer_room_rate[$i]->prior_day_type=="prior_checkin_date")
               {
                  $special_str.="\nPrior Booking Date :".date('d-m-Y',strtotime($specialoffer_room_rate[$i]->prior_checkin_date));
               }
               if($specialoffer_room_rate[$i]->prior_day_type=="period")
               {
                  $special_str.="\nPrior Booking Period : From ".date('d-m-Y',strtotime($specialoffer_room_rate[$i]->period_from_date)).' to '.date('d-m-Y',strtotime($specialoffer_room_rate[$i]->period_to_date));
               }
      echo $special_str; ?></td>
      <td class="none"><?php echo $specialoffer_room_rate[$i]->min_no_of_stay_day; ?></td>
      <td class="none"><?php echo $specialoffer_room_rate[$i]->max_no_of_stay_day; ?></td>
      <td class="none"><?php echo $specialoffer_room_rate[$i]->no_of_stay_free_nights;?></td>

              </tr>  
             <?php  $sl++; } } } ?>            
           </tbody>
         </table>
            </div>
        </section>
      </div>
    </div>
  </div>
</section>
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.js"></script>
<script>
function set_room_rate_status(t)
 {
    $val=t.getAttribute('data-val');
    $id=t.getAttribute('data-id');
    $status=t.getAttribute('data-status');
    $title=t.getAttribute('title');   
    $action='';  
  if(confirm($title)){
      $.ajax({
              type: "POST",
              url: site_url + $val,
              data :{ id : $id, status: $status},
              dataType : 'json', 
               success: function(data) { 
                   alert(data.result);
                   window.location.reload();  
               }
            });
    }
    else
    {
      return false;
    }
 }
</script>