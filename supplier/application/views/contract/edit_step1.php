<?php $this->load->view('data_tables_css'); ?>
<link href="<?php echo base_url(); ?>public/css/buttons.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">
<link href="<?php echo base_url();?>public/js/bootstrap-timepicker.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script type="text/javascript">
  var site_url='<?php echo site_url(); ?>';
</script>
<style type="text/css">
  .form-control[readonly]{
    background: white;
  }
</style>
<style type="text/css">

  .btn-file {
    position: relative;
    overflow: hidden;
  }
  .btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
  }
</style>
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2><!-- Edit Contract Details --> <span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a>Contract</a></li>
              <li><a class="active" href="<?php echo site_url() ?>contract/edit_step2?id=<?php echo $contract_id; ?>">Edit Contract Details</a></li>
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
    <div class="pagecontent">
      <?php $this->load->view('contract/contract_summary');?>
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <?php
          $data['steps'] = '1';        
          echo $this->load->view('contract/steps', $data);
        ?>
        <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $contract_id; ?>">
        <div class="tab-content">       
          <div class="tab-pane active" id="step-1"> 
            <div class="row border_row">         
                <div class="form-group col-md-6">                
                 <a data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#addfile" class="btn btn-info" name="add"><i class="fa fa-plus"></i> Add file</a>                
               </div> 
             </div>         
           <div class="row border_row">
            <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table1">
             <thead>           
              <tr>                
                <th>File</th>
                <th>Updated Time</th>
                <th>Description</th>                        
              </tr>             
            </thead>
            <tbody>
              <?php if(!empty($file_info)){
              for($i=0;$i<count($file_info);$i++){ ?>
              <tr>                
                <td><a href="<?php echo base_url().'uploads/'.$file_info[$i]->supplier_id.'/'.$file_info[$i]->file_path;?>" download=""><?php echo $file_info[$i]->file_name; ?></a></td>
                <td><?php echo $file_info[$i]->last_updated; ?></td>
                <td><?php echo $file_info[$i]->description; ?></td>
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
</section>
</div>
</div>
</div>
</section>




<!-- sctipts -->
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<!--  Custom JavaScripts  --> 
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script src="<?php echo base_url(); ?>public/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/buttons.flash.min.js
  "></script>
<script src="<?php echo base_url(); ?>public/js/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/pdfmake.min.js
"></script>
<script src="<?php echo base_url(); ?>public/js/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>public/js/buttons.html5.min.js
"></script>
<script src="<?php echo base_url(); ?>public/js/buttons.print.min.js
"></script>     
<script type="text/javascript">
 $('.todo').on('click', function(){
 $ins_id = $("#insert_id").val();   
window.location.replace('<?php echo site_url();?>contract/edit_step2?id='+$ins_id);
       
});
</script>
<?php $this->load->view('contract/contract_footer'); ?>



