<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<script type="text/javascript">
 var site_url='<?php  echo site_url(); ?>';
 </script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
         
          <div class="page-bar br-5">
            <div class="form-group">
              <ul class="page-breadcrumb">
                <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a>Manage Supplements Room Rates</a></li>
                <li  class="active"><a>Edit Supplements Room Rates</a></li>
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
           <h4 class="custom-font"> Supplements Room Rates </h4>
           </div>
          <div class="boxs-body">         
           <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table2">
            <thead>
             <tr>  
              <th>SL No.</th>  
              <th>Room</th>
              <th>Availabel Dates</th>
              <th>Supplements<br>Room<br>Rate Type</th>
              <th>Per Adult Rate</th>
              <th>Per Child Rate</th>
              <th>Status</th>
              <th>Action</th>
              <th>Edit</th>          
              <th class="none">Mandatory</th>          
              <th class="none">Hotel</th>                
              <th class="none">Contract Number</th> 
              <th class="none">Supplements Applicable on Meal Plan</th>
              <th class="none">Supplements Meal Plan</th>
              <th class="none">Special Offer Applicable On Supplement Rates</th>
              <th class="none">Market</th>   
              <th class="none">Remarks</th>            
             </tr>
          </thead>
          <tbody>
            <?php if(!empty($roomrates)) { 
              for($i=0,$sl=0;$i<count($roomrates);$i++){  ?>
              <tr>
                <td><?php echo ($sl+1);  ?></td>
                 <td><?php echo $room_name;?></td>
                <td><?php echo date('d-m-Y',strtotime($roomrates[$i]->avail_date)); ?></td>              
                <td><?php echo $roomrates[$i]->supplement_roomrate_type; ?></td>
                <td><?php echo $roomrates[$i]->supplement_adult_rate; ?></td>
                <td>
                  <?php 
                    $child_rate_str='';
                   $child_rate=json_decode($roomrates[$i]->supplement_child_agerange_rate,true);
                    if(!empty($child_rate[0]))
                      {                    
                        foreach ($child_rate as $key => $value)
                        { 
                          $val=explode(':', $value);   
                          $val1=explode('||', $val[1]);   
                          $child_rate_str.="Age( ".$val1[0]." - ".$val1[1]." ) : ".$val[0].'<br>'; 
                        }
                      } 

                      echo $child_rate_str;
                  ?>
                    
                  </td>
                <td>    
                  <?php if($roomrates[$i]->status==1){ ?>  
                  <label class="label label-success">Active</label>
                    <?php } else { ?>
                     <label class="label label-danger">Inactive</label>
                    <?php } ?>
                </td>
                <td>
                   <?php if($roomrates[$i]->status==1){ ?>                  
                     <a class="btn btn-danger btn-xs" data-val="<?php echo site_url(); ?>supplements/set_status"  data-id="<?php echo $roomrates[$i]->id;?>"  data-status="0" onclick="return set_contract_status(this)"  title="Do you really want to this Supplements Rate  InActive"><i class="fa fa-times"></i> Inactive</a>
                      <?php } else { ?>
                      <a class="btn btn-success btn-xs" data-val="<?php echo site_url(); ?>supplements/set_status" data-id="<?php echo $roomrates[$i]->id;?>"  data-status="1" onclick="return set_contract_status(this)"   title="Do you really want to this Supplements Rate   Active" ><i class="fa fa-check"></i> Active</a>          
                    <?php } ?>
                  </td>
                 <td><a class="btn btn-info btn-xs" onclick="editrate(this)" data-val="supplements/edit_room_rates/" 
                   rateid="<?php echo $roomrates[$i]->id;?>" 
                   room_code="<?php echo $roomrates[$i]->room_code;?>"
                   hotel_code="<?php echo $roomrates[$i]->hotel_code;?>" 
                   hotel_id="<?php echo $roomrates[$i]->sup_hotel_id;?>" 
                   room_id="<?php echo $roomrates[$i]->sup_room_details_id;?>"
                   contract_id="<?php echo $roomrates[$i]->contract_id;?>"
                   supplement_roomrate_type_id="<?php echo $roomrates[$i]->supplement_roomrate_type_id;?>" >
                   <i class="fa fa-pencil"></i> Edit</a></td> 
           
                 <td><?php echo $roomrates[$i]->supplement_compulsory; ?></td>        
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
               <td class="none">
              <?php 
                    $supplement_meal_arrr=explode(',',$roomrates[$i]->supplement_meal_plan);
                    $supplement_meal_plan=array();
                    for($l=0;$l<count($supplement_meal_arrr)&&!empty($supplement_meal_arrr[0]);$l++)
                    {
                      $supplement_meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($supplement_meal_arrr[$l])->meal_plan;
                    }
                    $supplement_meal_plan_str=implode(' , ', $supplement_meal_plan);           
                    echo $supplement_meal_plan_str;
                    ?>  
              </td>
               <td class="none"><?php  echo $roomrates[$i]->spec_offer_applicable_supplement; ?></td>
                <td class="none"><?php  echo $roomrates[$i]->market; ?></td>
                <td class="none"><?php  echo $roomrates[$i]->supplement_remarks; ?></td>
              

               </tr>  
             <?php $sl++; } } ?>            
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
        <h3 class="modal-title" id="myModalLabel" style="font-weight: 900;">Edit <?php echo $room_name;?> Supplements Rate</h3>
      </div>
      <div class="modal-body" id="ratecontent">   
     
      </div>
    </div>
  </div>
</div>
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<script type="text/javascript">
function set_contract_status(t)
 {
    $val=t.getAttribute('data-val');
    $id=t.getAttribute('data-id');
    $status=t.getAttribute('data-status'); 
    $title=t.getAttribute('title');   
    if(confirm($title)){
      $.ajax({
              type: "POST",
              url: $val,
              data :{ id : $id, status: $status},
              dataType : 'json', 
               success: function(data) { 
                    alert(data.result)  
                        window.location.reload();  
               }
            });
    }
    else
    {
      return false;
    }
 }

 $('#modaleditrate').modal({backdrop: 'static', keyboard: false});
$('#modaleditrate').modal('hide');   

  function cancel_editrate(){  
    $("#ratecontent").html(''); 
    $('#modaleditrate').modal('hide');  
  }

function editrate(t){
    $val=t.getAttribute('data-val');
    $rateid=t.getAttribute('rateid');
    $room_code=t.getAttribute('room_code');
    $hotel_code=t.getAttribute('hotel_code');  
    $room_id=t.getAttribute('room_id');
    $hotel_id=t.getAttribute('hotel_id'); 
    $contract_id=t.getAttribute('contract_id');
    $supplement_roomrate_type_id=t.getAttribute('supplement_roomrate_type_id');

   
    $("#ratecontent").html('');
  $.ajax({
    url: site_url+$val,
    data: {rateid:$rateid,room_code:$room_code,hotel_code:$hotel_code,room_id:$room_id,contract_id:$contract_id,hotel_id:$hotel_id,supplement_roomrate_type_id:$supplement_roomrate_type_id},
    dataType: 'json',
    type: 'POST',
    success: function(data) {      
      if(data.edit_room_rates != null) {       
      $("#ratecontent").html(data.edit_room_rates);
      } 
     else{
         $("#ratecontent").html("Sorry No record found");
      }
    
      $('#modaleditrate').modal('show');    
    }
  });  

  }


 

</script>
