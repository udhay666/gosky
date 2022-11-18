<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link href="<?php echo base_url(); ?>public/css/buttons.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
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
                <li><a href="#">Excursion</a></li>
                <li><a class="active">Edit Excursion Rates</a></li>
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
            <h1 class="custom-font">Edit Excursion Rate</h1>
            <ul class="controls">         
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>
          <div class="boxs-body">         
          <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table1">
            <thead>
             <tr>  
              <th>SL No.</th>          
              <th>Availabel Dates</th>
              <th>Availabel Booking</th>
              <th>Adult Price</th>
              <th>Child Price</th>                               
              <th>Status</th>
              <th>Action</th>
              <th>Edit</th>                
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($excursion_rates)) { 
              for($i=0;$i<count($excursion_rates);$i++){
                  if(($i+1)%2==0)
                  {
                    $cls="trevenedit";
                  }
                  else
                  {
                     $cls="troddedit";
                  }
               ?>
              <tr id="tr<?php echo $i+1; ?>" class="<?php echo $cls; ?>">
                <td><?php echo $i+1; ?></td>
                <td><?php echo date('d-m-Y',strtotime($excursion_rates[$i]->excursion_avail_date)); ?></td>
                <td><?php echo $excursion_rates[$i]->available_booking; ?></td>
                <td id="adult<?php echo $i+1; ?>"><?php echo $excursion_rates[$i]->adult_price; ?></td>
                <td id="child<?php echo $i+1; ?>">
                <?php
                $child_price=json_decode($excursion_rates[$i]->child_price,true);
                if(!empty($child_price[0]))
                {
                  foreach ($child_price as $key => $value)
                    { 
                          $val=explode('||', $value);
                          $val1=explode('-', $val[0]);
                          $val2=explode(':', $val[1]);
                          $val3=explode('-', $val2[0]);
                          echo 'Age ('.$val1[0].'-'.$val1[1].') & Height( '.$val3[0].' Cm -'.$val3[1].' Cm ) : '.$val2[1].'<br>';
                    
                    } 
                }   
                ?>
                </td>
              
                <td id="status<?php echo ($i+1);?>">
                  <?php if($excursion_rates[$i]->status==1){ ?>
                  <label class="label label-success">Active</label>
                  <?php } else { ?>
                  <label class="label label-warning">Inactive</label>
                  <?php } ?>
                </td>
              <td id="action<?php echo ($i+1);?>"> <?php  if($excursion_rates[$i]->status==1){ ?> 
                 <a class="btn btn-warning btn-xs"  data-id="<?php echo $excursion_rates[$i]->sup_excursion_rate_id;?>"  data-status="0" data-val="excursions/set_excursionrate_status"  onclick="return set_excursionrate_status(this)" data-index="<?php echo ($i+1); ?>"  title="Do you really want to Inactive this Excursion Rate. ?"><i class="fa fa-times"></i> Inactive</a>
               <?php } else { ?>
                 <a class="btn btn-success btn-xs"   data-id="<?php echo $excursion_rates[$i]->sup_excursion_rate_id;?>"  data-status="1" data-val="excursions/set_excursionrate_status"  onclick="return set_excursionrate_status(this)" data-index="<?php echo ($i+1); ?>" title="Do you really want to Active this Excursion Rate. ?"><i class="fa fa-check"></i> Active</a>   
                <?php }   ?>
               </td>
               <td><a class="btn btn-info btn-xs" onclick="editrate(this)" data-val="<?php echo $excursion_rates[$i]->sup_excursion_rate_id.'/'.$excursion_rates[$i]->rate_code.'/'.$excursion_rates[$i]->excursion_code.'/'.$excursion_rates[$i]->supplier_id.'/'.$excursion_rates[$i]->excursions_rate_types_id.'/'.($i+1);?>"><i class="fa fa-pencil"></i> Edit</a></td>       
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


<div class="modal fade" id="modaleditrate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 70px;">
  <div class="modal-dialog" style="width: 450px;">
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" onclick="cancel_editrate();" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel" style="font-weight: 900;">Edit Room Rate</h3>
      </div>
      <div class="modal-body" id="ratecontent">   
     
      </div>
    </div>
  </div>
</div>
<?php echo $this->load->view('data_tables_js'); ?>
   <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/main.js"></script>

  <script src="<?php echo base_url(); ?>public/js/vendor/custom/excursioncustomize.js"></script>
 