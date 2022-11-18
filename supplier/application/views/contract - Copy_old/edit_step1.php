<?php $this->load->view('data_tables_css'); ?>
<link href="<?php echo base_url(); ?>public/css/buttons.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">
<link href="<?php echo base_url();?>public/js/bootstrap-timepicker.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
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
              <li><a href="#">Contract</a></li>
              <li><a class="active" href="#">Edit Contract Details</a></li>
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
        <ul class="wizard_steps">
          <li><a href="#step-1" data-toggle="tab"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>Files</small></span></a></li>
          <li><a href="#step-2"  class="map_locater" data-toggle="tab"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Seasons </small></span></a></li>     
          <li><a href="#step-3"  data-toggle="tab"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Target</small></span></a></li>
          <li><a href="#step-4" data-toggle="tab"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Types Of Rates</small></span></a></li>
          <li><a href="#step-5" data-toggle="tab"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Payment Condition</small></span></a></li>
          <li><a href="#step-6" data-toggle="tab"><span class="step_no wizard-step">6</span><span class="step_descr">Step 6<br><small>Comments</small></span></a></li>
        </ul>
        <input type="hidden" name="insert_id" id="insert_id" value="1">
        <div class="tab-content">       
          <div class="tab-pane" id="step-1"> 
            <div class="row border_row">         
                <div class="form-group col-md-6">                
                 <a data-toggle="modal" data-target="#addfile" class="btn btn-info" name="add"><i class="fa fa-plus"></i> Add file</a>                
               </div> 
             </div>         
           <div class="row border_row">
            <table class="display nowrap" cellspacing="0" width="100%" id="advanced-usage">
             <thead>
              <tr>                
                <th>File</th>
                <th>Updated Time</th>
                <th>Description</th>                        
              </tr>
            </thead>
            <tbody>
              <tr>                
                <td>Abc.txt</td>
                <td>03-07-2017</td>
                <td>ASDSASFSD Description</td>
              </tr>
            </tbody>
          </table>            
        </div>        
      </div>
      <ul class="pager wizard">
        <li class="next">
          <button class="btn btn-success todo">Save and Continue</button>
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
<div class="modal fade" id="addfile" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ADD File</h4>
      </div>
      <div class="modal-body">
       <div class="row border_row">
        <div class="form-group col-md-12">
         <label class="btn btn-primary btn-file">
          <i class="fa fa-plus"></i>Add file <input type="file"  required="required" style="display: none;"></label>&nbsp;&nbsp;           
       <span   id="filnamedescspan"><input type="hidden"  required="required"  id="filnamedesc"></span>
       </div>
     </div> 
   
   <div class="row border_row">
     <div class="form-group col-md-6">
      <label class="strong" for="specialoffer_type">Description : </label>
     <textarea name="contractfile_desc" class="form-control" rows="5" required="required"></textarea>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-success"><i class="fa fa-check"></i></button>
  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></button>
</div>
</div>
</div>
</div>
<!-- sctipts -->
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/wysihtml5-0.3.0.min.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/adapters/jquery.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyADPfKkRh8XYqiV5gPIzPW1CdXAbR7l9gE&libraries=places"></script>
<script src="<?php echo base_url(); ?>public/js/locationpicker.jquery.min.js"></script>
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
  jQuery(document).ready(function() {
    $('#advanced-usage').DataTable( {
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
  });
</script> 
<script type="text/javascript">
  $(document).on('change', ':file', function() {
    $("#filnamedescspan").html('');
    $("#filnamedesc").val('');
    var input = $(this),
    numFiles = input.get(0).files ? input.get(0).files.length : 1,
    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });
  $(document).ready( function() {
    $(':file').on('fileselect', function(event, numFiles, label) {
      // console.log(numFiles);
      // console.log(label);
      $("#filnamedescspan").html(label);
      $("#filnamedesc").val(label);
    });
  });
</script>      
<script type="text/javascript">
  $('#rootwizard').bootstrapWizard({
    onTabShow: function(tab, navigation, index) {
      var $total = navigation.find('li').length;
      var $current = index+1;     
      if($current == 2){
        show_map();
      }     
      if($current >= $total) {
        $('#rootwizard').find('.pager .next').hide();
        $('#rootwizard').find('.pager .finish').show();
        $('#rootwizard').find('.pager .finish').removeClass('disabled');
      } else {
        $('#rootwizard').find('.pager .next').show();
        $('#rootwizard').find('.pager .finish').hide();
      }
      CKEDITOR.instances[name];
    },
    onNext: function(tab, navigation, index) {   
      var steps = 'step'+index;   
        save_contract(steps, 1);
       
    },
    onFirst: function(tab, navigation, index) {
      index = 1;   
      var steps = 'step'+index;
      form.parsley().validate();
      if (!form.parsley().isValid()) {
        return false;
      } else{
        save_contract(steps, 0);
      }
    },
    onTabClick: function(tab, navigation, index) {      
      var steps = 'step'+(index+1);  
    }
  });
// });
$('.next .btn, .previous .btn').on('click', function(e){
  CKEDITOR.instances[name];
});
function save_contract(steps,todo){ 
  $ins_id = $("#insert_id").val();   
        if(todo == 1){
          window.location.replace('<?php echo site_url();?>contract/edit_step2?id='+$ins_id);
        } else{
          window.location.replace('<?php echo site_url();?>contract/edit_contract?id='+$ins_id);
        }    
}
</script>

