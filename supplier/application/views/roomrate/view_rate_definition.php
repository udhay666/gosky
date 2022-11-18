<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css"><link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
 var site_url='<?php  echo site_url(); ?>';
</script>
<?php 
$dataarray2=array('supplier_room_list_id'=>$room_id,'supplier_id'=>$this->supplier_id,'status'=>1);
  $room_mealplan_list=$this->supplier_room_list->check($dataarray2)[0]->mealplan; 
  $room_mealplan_list=explode(',', $room_mealplan_list);
  $mealplanlist=$this->glb_hotel_meal_plan->get(); 
  $mealplanlistnarr=array();
  for($i=0;$i<count($mealplanlist)&&!empty($mealplanlist);$i++)
  {
     $mealplanlistnarr[$mealplanlist[$i]->id]=$mealplanlist[$i]->meal_plan;
  }
  $mealplanlist =$mealplanlistnarr;  ?>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
         
          <div class="page-bar br-5">
            <div class="form-group">
              <ul class="page-breadcrumb">
                <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a href="#">Room</a></li>
                <li><a class="active" href="">Edit Room Rate</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font"> Hotel - <?php echo $hotel_name;?> <br>Edit <?php echo $room_name;?>  Rate</h1>
            <ul class="controls">         
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>
          <div class="boxs-body"> 
           <h4 style="margin-left: 10px;">Per Person Per Night (PPPN)</h4>      
           <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table1">
            <thead>
             <tr>  
              <th>SL No.</th>  
              <th>Room</th>
              <th>Availabel Dates</th>
              <th>Rate Type</th>
              <th>Adult Rate</th>
              <th>Child Rate</th>                       
              <th>Edit</th> 
              <th>Status</th>
              <th class="none">Adult Rate For Extra Bed</th>
              <th class="none">Child Rate For Extra Bed</th>     
              <th class="none">Extra Bed For Adults</th>
              <th class="none">Extra Bed For Chlid</th>         
              <th class="none">Min Room Occupancy</th>
              <th class="none">Max Room Occupancy</th>             
              <th class="none">Hotel</th>                
              <th class="none">Contract Number</th> 
              <th class="none">Meal Plan</th>
              <th class="none">Market</th> 
              <th class="none">Cancellation Policy (Currency <?php echo $currency_type;?>)</th> 
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($roomrates)) { 
              for($i=0,$k=1;$i<count($roomrates);$i++){  
               if($roomrates[$i]->rate_type=='PPPN'){     
                 ?>
                 <tr>
                  <td><?php echo $k++;  ?></td>
                  <td><?php echo $room_name; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($roomrates[$i]->room_avail_date)); ?></td>
                  <td><?php if($roomrates[$i]->rate_type=='PPPN'){echo 'Per Person Per Night';}else if($roomrates[$i]->rate_type=='PRPN'){echo ' Per Room Per Night';} ?></td>
                  <td><?php echo $roomrates[$i]->adult_rate; ?></td>
                  <td>   
                  <?php 
                      $child_rate=json_decode($roomrates[$i]->child_rate,true);                 
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
                 <td><a class="btn btn-info btn-xs" onclick="editrate(this)" data-val="roomrates/edit_room_rates/" 
                   rateid="<?php echo $roomrates[$i]->sup_hotel_room_rates_id;?>"
                   room_code="<?php echo $roomrates[$i]->room_code;?>"
                   hotel_code="<?php echo $roomrates[$i]->hotel_code;?>" 
                   hotel_id="<?php echo $roomrates[$i]->sup_hotel_id;?>" 
                   room_id="<?php echo $roomrates[$i]->sup_room_details_id;?>"
                   contract_id="<?php echo $roomrates[$i]->contract_id;?>" >
                   <i class="fa fa-pencil"></i> Edit</a></td> 
                <td>    
                  <?php if($roomrates[$i]->status==1){ ?>  
                  <label class="label label-success">Active</label>
                    <?php } else if($roomrates[$i]->status==0) { ?>
                     <label class="label label-danger">Inactive</label>
                    <?php } else if($roomrates[$i]->status==2) { ?>
                     <label class="label label-warning">Blocked</label>
                    <?php } ?>
                </td> 
                  <td class="none"><?php echo $roomrates[$i]->extra_bed_for_adults_rate; ?></td>
                     <td class="none"><?php echo $roomrates[$i]->extra_bed_for_child_rate; ?></td>
                     <td class="none"><?php echo $roomrates[$i]->extra_bed_for_adults; ?></td>
                     <td class="none"><?php echo $roomrates[$i]->extra_bed_for_child; ?></td>
                   
                   <td class="none"><?php echo $roomrates[$i]->min_room_occupancy; ?></td>
                   <td class="none"><?php echo $roomrates[$i]->max_room_occupancy; ?></td>
                   
                   <td class="none"><?php echo $hotel_name;?></td>                
                   <td class="none">
                    <?php  
                    echo $this->sup_contract->get_single($roomrates[$i]->contract_id)->contract_number;
                    ?>
                  </td> 
                  <td class="none">
                    <?php 
                    $meal_arrr=explode(',',$roomrates[$i]->meal_plan);
                    $meal_plan=array();
                    for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
                    {
                      $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
                    }
                    $meal_plan_str=implode(' , ', $meal_plan);           
                    echo $meal_plan_str;
                    ?>
                  </td> 
                  <td class="none"><?php  echo $roomrates[$i]->market; ?></td>  
                  <td class="none">
                    <?php
                    $dataarray=array('sup_hotel_room_rates_list_id'=>$roomrates[$i]->sup_hotel_room_rates_list_id,'sup_hotel_id'=>$roomrates[$i]->sup_hotel_id,'sup_room_details_id'=>$roomrates[$i]->sup_room_details_id,'contract_id'=>$roomrates[$i]->contract_id,'supplier_id'=>$roomrates[$i]->supplier_id,'room_avail_date'=>$roomrates[$i]->room_avail_date);
                    $cancel_policy=$this->sup_hotel_room_cancellation_rates->check($dataarray);
                    if(!empty($cancel_policy[0]))
                    {
                      for($can=0;$can<count($cancel_policy);$can++)
                      {
                       if($cancel_policy[$can]->cancel_rates_type=='non_refundable')
                       {
                         $cancel_policy_str='Non Refundable';
                       }
                       if($cancel_policy[$can]->cancel_rates_type=='fullstay')
                       {
                        $cancel_policy_str='Full Stay Charge';
                      }        
                      if($cancel_policy[$can]->cancel_rates_type=='fixed'){
                        $cancel_policy_str= $cancel_policy[$can]->days_before_checkin.' days Before CheckIn Date Cancellation Charges will be '.$cancel_policy[$can]->per_rate_charge;
                        $cancel_policy_str.=' '.$currency_type;
                      }
                      if($cancel_policy[$can]->cancel_rates_type=='percentage')
                      {
                        $cancel_policy_str= $cancel_policy[$can]->days_before_checkin.' days Before CheckIn Date Cancellation Charges will be '.$cancel_policy[$can]->per_rate_charge;
                        $cancel_policy_str.=' '.strtoupper($cancel_policy[$can]->cancel_rates_type);
                      }
                      echo '<br>'.$cancel_policy_str;
                    }
                  } 
                 ?></td> 
                </tr>  
                <?php } } } ?>            
              </tbody>
            </table>
          </div>
          <div class="boxs-body"> 
            <h4 style="margin-left: 10px;">Per Room Per Night (PRPN)</h4>        
            <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table2">
              <thead>
               <tr>  
                <th>SL No.</th>  
                <th>Room</th>
                <th>Availabel Dates</th>
                <th>Rate Type</th>           
                <th>Room Rate</th>                  
                <th>Edit</th>
                <th>Status</th>
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
                <th class="none">Cancellation Policy (Currency <?php echo $currency_type;?>)</th> 
              </tr>
            </thead>
            <tbody>
              <?php if(!empty($roomrates)) { 
                for($i=0,$k=1;$i<count($roomrates);$i++){ 
                 if($roomrates[$i]->rate_type=='PRPN'){      
                   ?>
                   <tr>
                    <td><?php echo $k++; ?></td>
                    <td><?php echo $room_name; ?></td>
                    <td><?php echo date('d-m-Y',strtotime($roomrates[$i]->room_avail_date)); ?></td>
                    <td><?php if($roomrates[$i]->rate_type=='PPPN'){echo 'Per Person Per Night';}else if($roomrates[$i]->rate_type=='PRPN'){echo ' Per Room Per Night';} ?></td>              
                    <td><?php echo $roomrates[$i]->room_rate; ?></td>
                    
                    <td><a class="btn btn-info btn-xs" onclick="editrate(this)" data-val="roomrates/edit_room_rates/" 
                     rateid="<?php echo $roomrates[$i]->sup_hotel_room_rates_id;?>"
                     room_code="<?php echo $roomrates[$i]->room_code;?>"
                     hotel_code="<?php echo $roomrates[$i]->hotel_code;?>" 
                     hotel_id="<?php echo $roomrates[$i]->sup_hotel_id;?>" 
                     room_id="<?php echo $roomrates[$i]->sup_room_details_id;?>"
                     contract_id="<?php echo $roomrates[$i]->contract_id;?>" >
                     <i class="fa fa-pencil"></i> Edit</a></td>
                    <td>    
                     <?php if($roomrates[$i]->status==1){ ?>  
                    <label class="label label-success">Active</label>
                      <?php } else if($roomrates[$i]->status==0) { ?>
                       <label class="label label-danger">Inactive</label>
                      <?php } else if($roomrates[$i]->status==2) { ?>
                       <label class="label label-warning">Blocked</label>
                      <?php } ?>
                    </td>  
                     <td class="none"><?php echo $roomrates[$i]->extra_bed_for_adults_rate; ?></td>
                     <td class="none"><?php echo $roomrates[$i]->extra_bed_for_child_rate; ?></td>
                     <td class="none"><?php echo $roomrates[$i]->extra_bed_for_adults; ?></td>
                     <td class="none"><?php echo $roomrates[$i]->extra_bed_for_child; ?></td>
                     <td class="none"><?php echo $roomrates[$i]->min_room_occupancy; ?></td>
                     <td class="none"><?php echo $roomrates[$i]->max_room_occupancy; ?></td>
                     <td class="none"><?php echo $roomrates[$i]->min_adults_without_extra_bed; ?></td>
                     <td class="none"><?php echo $roomrates[$i]->max_adults_without_extra_bed; ?></td> 
                     <td class="none"><?php echo $roomrates[$i]->min_child_without_extra_bed; ?></td>
                     <td class="none"><?php echo $roomrates[$i]->max_child_without_extra_bed; ?></td>
                     <td class="none"><?php echo $hotel_name;?></td>                
                     <td class="none">
                      <?php  
                      echo $this->sup_contract->get_single($roomrates[$i]->contract_id)->contract_number;
                      ?>
                    </td> 
                    <td class="none">
                      <?php 
                      $meal_arrr=explode(',',$roomrates[$i]->meal_plan);
                      $meal_plan=array();
                      for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
                      {
                        $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
                      }
                      $meal_plan_str=implode(' , ', $meal_plan);           
                      echo $meal_plan_str;
                      ?>
                    </td> 
                    <td class="none"><?php  echo $roomrates[$i]->market; ?></td>  
                    <td class="none">
                      <?php
                      $dataarray=array('sup_hotel_room_rates_list_id'=>$roomrates[$i]->sup_hotel_room_rates_list_id,'sup_hotel_id'=>$roomrates[$i]->sup_hotel_id,'sup_room_details_id'=>$roomrates[$i]->sup_room_details_id,'contract_id'=>$roomrates[$i]->contract_id,'supplier_id'=>$roomrates[$i]->supplier_id,'room_avail_date'=>$roomrates[$i]->room_avail_date);
                      $cancel_policy=$this->sup_hotel_room_cancellation_rates->check($dataarray);
                      if(!empty($cancel_policy[0]))
                      {
                        for($can=0;$can<count($cancel_policy);$can++)
                        {
                         if($cancel_policy[$can]->cancel_rates_type=='non_refundable')
                         {
                           $cancel_policy_str='Non Refundable';
                         }
                         if($cancel_policy[$can]->cancel_rates_type=='fullstay')
                         {
                          $cancel_policy_str='Full Stay Charge';
                        }        
                        if($cancel_policy[$can]->cancel_rates_type=='fixed'){
                          $cancel_policy_str= $cancel_policy[$can]->days_before_checkin.' days Before CheckIn Date Cancellation Charges will be '.$cancel_policy[$can]->per_rate_charge;
                          $cancel_policy_str.=' '.$currency_type;
                        }
                        if($cancel_policy[$can]->cancel_rates_type=='percentage')
                        {
                          $cancel_policy_str= $cancel_policy[$can]->days_before_checkin.' days Before CheckIn Date Cancellation Charges will be '.$cancel_policy[$can]->per_rate_charge;
                          $cancel_policy_str.=' '.strtoupper($cancel_policy[$can]->cancel_rates_type);
                        }
                        echo '<br>'.$cancel_policy_str;
                      }
                    } 
                    ?></td> 
                  </tr>  
                  <?php } } } ?>            
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>


  <div class="modal fade" id="modaleditrate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 70px;">
    <div class="modal-dialog" style="width: 650px;">
      <div class="modal-content" >
        <div class="modal-header">
          <button type="button" class="close" onclick="cancel_editrate();" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="modal-title" id="myModalLabel" style="font-weight: 900;">Edit <?php echo $room_name;?>  Rate</h3>
        </div>
        <div class="modal-body" id="ratecontent">   
         
        </div>
      </div>
    </div>
  </div>

  <?php echo $this->load->view('data_tables_js'); ?>
  <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/custom/customize.js"></script>
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
  <script type="text/javascript">
    function addPolicy(e) {
      e.preventDefault();
      if($('#add_policy_group').find('.policy_row').length < 11) {
        $('#add_policy_group').append('<div class="row  border_row policy_row">'+
          '<div class="form-group col-md-3">'+
          '<select name="cancel_rates_type[]" class="form-control cancel_rates_type" onchange="cancel_rates_type(this)" required="required">'+
          '<option value="">Select</option>'+
          '<option value="percentage">Percentage</option>'+ 
          '<option value="fixed">Individual Night Charge</option>'+
          '<option value="fullstay">Full Stay Charge</option>'+
          '</select>'+
          '</div>'+  
          '<div class="form-group col-md-3">'+          
          '<input type="text" name="days_before[]" class="form-control days_before"  placeholder="No of Days" required="required"/>'+
          '</div>'+
          '<div class="form-group col-md-3">'+
          '<input type="text" name="cancel_rates[]"  class="form-control cancel_rates"   placeholder="Percentage / Individual Night Charge" required="required"/>'+
          '</div>'+                                       
          '</div>');
      }
      return false;
    }
    function removePolicy(e) {
      e.preventDefault();
      if($('#add_policy_group').find('.policy_row').length > 3) {
        $('#add_policy_group').find('.policy_row:last').remove();
      }
      return false;
    }
  </script>

