<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/modal.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<script type="text/javascript">
  var site_url='<?php echo site_url(); ?>';
</script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
         <!--  <h2></h2> -->
         <div class="page-bar  br-5">
          <ul class="page-breadcrumb">
            <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>             
            <li><a class="in Progress" href="<?php echo site_url() ?>contract/contract_list">Contract List</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <section class="boxs">
        <div class="boxs-header dvd dvd-btm">
          <h1 class="custom-font">Contracts Information</h1>
          <ul class="controls">           
            <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
          </ul>          
        </div>
         <div class="boxs-body">
         <a href="<?php echo site_url()?>contract/new_contract" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Contract</a>
         </div>
        <div class="boxs-body">
          <?php 
          $sess_msg = $this->session->flashdata('message');
          $errors_msg=$this->session->flashdata('errors_msg');
          if(!empty($sess_msg)){
            $message = $sess_msg;
            $class = 'success';
          }else if(!empty($errors_msg)){
            $message = $errors_msg;
            $class = 'danger';
          }
          else {
            $message = $error;
            $class = 'danger';
          }
          ?>
          <?php if($message){ ?>
               <div class="alert alert-<?php echo $class ?>">
            <button class="close" data-dismiss="alert" type="button">×</button>
            <strong><?php echo ucfirst($class) ?>....!</strong>
            <?php echo $message; ?>
          </div>
          <?php } ?>      
        </div> 
         <div class="boxs-body">
          <form action="<?php echo site_url()?>contract/contract_list" method="get" name="form1" role="form">
              <div class="row">                      
                <div class="form-group col-md-6">
                 <label class="strong" for="contract_number">Contract Number : </label>
                  <input name="contract_number" id="contract_number" value="<?php echo $contract_number; ?>" type="text" class="form-control">
                </div>
                 <div class="form-group col-md-6">
                 <label class="strong" for="hotel_name">Hotel Name : </label>               
                   <select name="hotel_code" id="hotel_code" class="form-control select2">
                   <option value="" selected="selected">Select Hotel</option>
                   <?php foreach($hotel_list as $val){?>
                   <option value="<?php echo $val->hotel_code;?>" <?php if($hotel_code==$val->hotel_code){echo "selected";}?>>
                     <?php echo $val->hotel_name;?>
                   </option>
                   <?php } ?>               
                  </select>
                </div>
                </div>
                 <div class="row">       
                <div class="form-group col-md-6">
                <label class="strong" for="status1">Contract Progress : </label>
                  <select name="status1" id="status1" class="form-control select2">
                   <option value="" selected="selected">Select Contract Progress</option>
                   <option value="1" <?php if($status1=='1'){echo "selected";}?>>Completed</option>
                    <option value="0" <?php if($status1=='0'){echo "selected";}?>>InProgress</option>        
                  </select>
                </div>
                <div class="form-group col-md-6">
                <label class="strong" for="status">Contract Status : </label>
                  <select name="status" id="status" class="form-control select2">
                   <option value="" selected="selected">Select Contract Status</option>
                   <option value="1" <?php if($status=='1'){echo "selected";}?>>Active</option>
                    <option value="0" <?php if($status=='0'){echo "selected";}?>>InActive</option>        
                  </select>
                </div>
                </div>
                 <div class="row">
                    <div class="form-group col-md-6">
                        <label class="strong">Created Date : </label>
                         <div class="row" style="margin-left:1px;"> 
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control created_selectdate" id="created_fromdate" name="created_fromdate" value="<?php echo $created_fromdate; ?>" placeholder="Select From Date">
                            </div>
                              <div class="form-group col-md-6">
                                 <input type="text" class="form-control created_selectdate" id="created_todate" name="created_todate"  value="<?php echo $created_todate; ?>" placeholder="Select To Date">
                              </div>
                          </div>
                  </div> 
                    <div class="form-group col-md-6">
                        <label class="strong">Expiry Date : </label>
                         <div class="row" style="margin-left:1px;"> 
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control selectdate" id="from_date" name="from_date"  value="<?php echo $from_date; ?>" placeholder="Select From Date">
                            </div>
                              <div class="form-group col-md-6">
                                 <input type="text" class="form-control selectdate" id="to_date" name="to_date"   value="<?php echo $to_date; ?>" placeholder="Select To Date">
                              </div>
                          </div>
                  </div>    
              </div>
              <div class="row">                     
              <div class="form-group col-md-12" align="center">
                 <input  class="btn btn-success" type="submit"  value="Search" />
               <input  class="btn btn-warning" type="button" id="resetbutton" value="Clear Filter" />
                </div>
                </div>
            </form> 
            </div>     
        <div class="boxs-body">       
        <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table1">
           <thead>
            <tr>                
              <th>SL. No.</th>
              <th>Contract_Number</th> 
              <th>Hotel Name</th>         
              <th>Action</th>
              <th>Status</th>
              <th>Edit/View Details</th>              
              <th class="none">Description</th>              
              <th class="none">Signed_Date</th>
              <th class="none">Start_Date</th>
              <th class="none">End_Date</th>
              <th class="none">Created_Date</th>
              <th class="none">Last_Updated_Date</th>  
              <th class="none">Markets</th> 
              <th class="none">Excluded Markets List</th>
              <th class="none">Comments</th>  
              <th class="none">File Download</th>                        
            </tr>
          </thead>
          <tbody>
          <?php if(!empty($contract_list)){
            for($i=0;$i<count($contract_list);$i++){
           ?>
            <tr>                
              <td><?php echo ($i+1);?></td>
              <td><?php echo $contract_list[$i]->contract_number;?></td>
              <td><?php echo $this->supplier_hotel_list->check(array('supplier_hotel_list_id'=>$contract_list[$i]->supplier_hotel_list_id))[0]->hotel_name;?></td>                          
              <td id="status<?php echo ($i+1);?>">             
                <?php if($contract_list[$i]->status==1){ ?>  
                <label class="label label-success">Active</label><a class="btn btn-warning btn-xs" data-name="<?php echo $contract_list[$i]->contract_number; ?>" data-id="<?php echo $contract_list[$i]->contract_id;?>"  data-status="0" data-val="contract/set_contract_status" data-status-id="<?php echo $contract_list[$i]->status1;?>"  onclick="return set_contract_status(this)" data-index="<?php echo ($i+1); ?>"  title="Do you really want to this Contract InActive (<?php echo $contract_list[$i]->contract_number; ?>). ?"><i class="fa fa-times"></i>InActive</a>
                      <?php } else { ?>
                      <label class="label label-warning">InActive</label><a class="btn btn-success btn-xs" data-name="<?php echo $contract_list[$i]->contract_number; ?>"  data-id="<?php echo $contract_list[$i]->contract_id;?>" data-status-id="<?php echo $contract_list[$i]->status1;?>"  data-status="1" data-val="contract/set_contract_status"  onclick="return set_contract_status(this)" data-index="<?php echo ($i+1); ?>" title="Do you really want to this Contract  In Active (<?php echo $contract_list[$i]->contract_number; ?>). ?"><i class="fa fa-check"></i>Active</a>          
                    <?php } ?>
                
              </td>                
              <td id="action<?php echo ($i+1);?>"> 
               <?php 
                if($contract_list[$i]->status1==1){ ?>  
               <label class="label label-success">Completed</label><a class="btn btn-warning btn-xs" data-name="<?php echo $contract_list[$i]->contract_number; ?>" data-id="<?php echo $contract_list[$i]->contract_id;?>"  data-status-id1="<?php echo $contract_list[$i]->status;?>"  data-status="0" data-val="contract/set_contract_status1"   onclick="return set_contract_status1(this)" data-index="<?php echo ($i+1); ?>"  title="Do you really want to this Contract In Progress (<?php echo $contract_list[$i]->contract_number; ?>). ?"><i class="fa fa-times"></i> In Progress</a>
                      <?php } else { ?>
                     <label class="label label-warning">In Progress</label><a class="btn btn-success btn-xs" data-name="<?php echo $contract_list[$i]->contract_number; ?>"  data-id="<?php echo $contract_list[$i]->contract_id;?>" data-status-id1="<?php echo $contract_list[$i]->status;?>" data-status="1" data-val="contract/set_contract_status1"  onclick="return set_contract_status1(this)" data-index="<?php echo ($i+1); ?>" title="Do you really want to this Contract Completed (<?php echo $contract_list[$i]->contract_number; ?>). ?"><i class="fa fa-check"></i> Completed</a>          
                    <?php } ?>
                  </td>
             <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>contract/edit_contract?id=<?php echo $contract_list[$i]->contract_id;?>"><i class="fa fa-pencil"></i> Edit/View Details</a></td>  
             
              <td class="none"><?php echo $contract_list[$i]->contract_desc;?></td>
              <td class="none"><?php echo date('d-m-Y',strtotime($contract_list[$i]->signed_date));?></td>
              <td class="none"><?php echo date('d-m-Y',strtotime($contract_list[$i]->start_date));?></td>
              <td class="none"><?php echo date('d-m-Y',strtotime($contract_list[$i]->end_date));?></td>  
               <td class="none"><?php echo date('d-m-Y',strtotime($contract_list[$i]->created_date));?></td> 
                <td class="none"><?php echo date('d-m-Y H:i:s',strtotime($contract_list[$i]->last_updated));?></td> 
              <td class="none"><?php echo str_replace('||','<br>',$contract_list[$i]->market_avail);?></td>   
               <td class="none"><?php echo str_replace('||','<br>',$contract_list[$i]->exclude_market);?></td>
               <td class="none">
               <?php 
              $dataarray=array('contract_id'=>$contract_list[$i]->contract_id,'supplier_id'=>$contract_list[$i]->supplier_id);
               $comment_info=$this->sup_contract_comment->check($dataarray);
                $file_info =$this->sup_contract_file->check($dataarray);
              if(!empty($comment_info)){
                 for($j=0;$j<count($comment_info);$j++){
                    echo '<br>'.($j+1).' :  '.$comment_info[$j]->comment.'<br>';                    
                       }
                   }  else { echo " No Comment"; }
                   ?>
               </td>
                <td class="none">
                <?php  if(!empty($file_info)){
                 for($k=0;$k<count($file_info);$k++){ ?>
                <?php echo '<br>'.($k+1).' :  ';?><a href="<?php echo base_url().'uploads/'.$file_info[$k]->supplier_id.'/'.$file_info[$k]->file_path;?>" download=""><?php echo $file_info[$k]->file_name; ?></a><br>
                <?php } }   else { echo " No File"; } ?>
                </td>
           </tr>
           <?php } } ?>
          
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
<script src="<?php echo base_url(); ?>public/js/vendor/custom/contractcustomize.js
"></script> 
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<script type="text/javascript"> 
$(function() { 
   var dateToday = new Date();
  $('.selectdate').daterangepicker({  
    autoUpdateInput: false,
    showDropdowns: true, 
    daysOfWeek: [
            "Su",
            "Mo",
            "Tu",
            "We",
            "Th",
            "Fr",
            "Sa"
        ],
     monthNames: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ],  
      locale: {
          cancelLabel: 'Clear',
           format: 'DD-MM-YYYY'
      }
  });

  $('.selectdate').on('apply.daterangepicker', function(ev, picker) {
      $('input[name="from_date"]').val(picker.startDate.format('DD-MM-YYYY'));
      $('input[name="to_date"]').val(picker.endDate.format('DD-MM-YYYY'));
  });

  $('.selectdate').on('cancel.daterangepicker', function(ev, picker) {
       $('input[name="from_date"]').val('');
      $('input[name="to_date"]').val('');
  });

   $('.created_selectdate').daterangepicker({  
    autoUpdateInput: false,
    showDropdowns: true, 
    daysOfWeek: [
            "Su",
            "Mo",
            "Tu",
            "We",
            "Th",
            "Fr",
            "Sa"
        ],
     monthNames: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ],  
      locale: {
          cancelLabel: 'Clear',
           format: 'DD-MM-YYYY'
      }
  });

  $('.created_selectdate').on('apply.daterangepicker', function(ev, picker) {
      $('input[name="created_fromdate"]').val(picker.startDate.format('DD-MM-YYYY'));
      $('input[name="created_todate"]').val(picker.endDate.format('DD-MM-YYYY'));
  });

  $('.created_selectdate').on('cancel.daterangepicker', function(ev, picker) {
       $('input[name="created_fromdate"]').val('');
      $('input[name="created_todate"]').val('');
  });
});
</script>
<script>
$(document).ready(function() {
  $(".select2").select2({});

   $("#resetbutton").click(function(){ 
      $("input[type='text']").val('');    
      $(".select2").val('');
      $(".select2").change();
      location.href='<?php echo site_url() ?>contract/contract_list';
    });
  });
   </script>



