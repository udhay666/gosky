<?php $this->load->view('data_tables_css'); ?>
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
 <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
  var site_url='<?php echo site_url(); ?>';
</script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2><span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Contract</a></li>
              <li><a class="active" href="<?php echo site_url() ?>contract/edit_step2?id=<?php echo $id; ?>">Edit Contract Details</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
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
    <!-- page content -->
    <div class="pagecontent">
    <?php $this->load->view('contract/contract_summary');?>
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
       <?php
          $data['steps'] = '2';
          echo $this->load->view('contract/steps', $data);
        ?>
        <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $id; ?>">
        <div class="tab-content">
       <div class="tab-pane active" id="step-2"> 
            <div class="row border_row">         
                <div class="form-group col-md-6">            
                 <a data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#addnewseason" class="btn btn-info" name="add"><i class="fa fa-plus"></i> New Season</a>                
               </div> 
             </div>         
           <div class="row border_row">
              <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table1">
             <thead>
              <tr>                
                <th>Code</th>
                <th>Name</th>
                <th>Periods</th>
                <th>Status</th>  
                <th>Action</th>
                <th>Add Periods & Edit</th>                           
              </tr>
            </thead>
            <tbody>
              <?php if(!empty($season_info)){
              for($i=0;$i<count($season_info);$i++){ ?>
              <tr>                
                <td><?php echo $season_info[$i]->season_code; ?></td>
                <td><?php echo $season_info[$i]->season_name; ?></td>
                <td><?php echo $season_info[$i]->periods; ?></td>
                 <td id="status<?php echo ($i+1);?>"><?php echo ($season_info[$i]->status==1)?'<label class="label label-success">Active</label>':'<label class="label label-warning">InActive</label>';?></td>
                 <td id="action<?php echo ($i+1);?>">               
                   <?php if($season_info[$i]->status==1){ ?>                  
                     <a class="btn btn-warning btn-xs" data-name="<?php echo $season_info[$i]->season_code; ?>" data-id="<?php echo $season_info[$i]->id;?>"  data-status="0" data-val="contract/set_season_status"  onclick="return set_season_status(this)" data-index="<?php echo ($i+1); ?>"  title="Do you really want to Inactive this Season (<?php echo $season_info[$i]->season_code; ?>). ?"><i class="fa fa-times"></i> InActive</a>
                      <?php } else { ?>
                      <a class="btn btn-success btn-xs" data-name="<?php echo $season_info[$i]->season_code; ?>"  data-id="<?php echo $season_info[$i]->id;?>"  data-status="1" data-val="contract/set_season_status"  onclick="return set_season_status(this)" data-index="<?php echo ($i+1); ?>" title="Do you really want to Active this Season (<?php echo $season_info[$i]->season_code; ?>). ?"><i class="fa fa-check"></i> Active</a>          
                    <?php } ?>
                    </td>
                  <td>
                      <a class="btn btn-success btn-xs" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-val="<?php echo $season_info[$i]->id; ?>" onclick="addperiod(this)" data-target="#addperiod"><i class="fa fa-check" title="Add Periods For this Season"></i> Add Period</a>
                     <a class="btn btn-info btn-xs" data-val="contract/edit_contract_season" data-id="<?php echo $season_info[$i]->id;?>" onclick="editmodalcustom(this)" ><i class="fa fa-pencil" title="Edit this Season"></i> Edit</a>  
                  </td>
              </tr>
              <?php }} ?>             
            </tbody>
          </table>            
        </div>        
      </div>
      <ul class="pager wizard">
        <li class="next">
         <button class="btn btn-success todo">Next</button>
        </li>       
      </ul>
    </div> 
 </div>
 </div>
 </div>
 </section>
</div>
</div>
</section>
<!-- sctipts -->
  <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
  
<?php echo $this->load->view('data_tables_js'); ?>
  <!--  Custom JavaScripts  --> 
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript">
$('.todo').on('click', function(){
 $ins_id = $("#insert_id").val();   
window.location.replace('<?php echo site_url();?>contract/edit_step3?id='+$ins_id);       
});
</script>
<?php $this->load->view('contract/contract_footer'); ?>

