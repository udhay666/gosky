<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
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
              <li><a class="active" href="<?php echo site_url() ?>contract/edit_step2?id=<?php echo $id ?>">Edit Contract Details</a></li>
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
        <input type="hidden" name="insert_id" id="insert_id" value="1">
        <div class="tab-content">
       <div class="tab-pane active" id="step-2"> 
            <div class="row border_row">         
                <div class="form-group col-md-6">            
                 <a data-toggle="modal" data-target="#addnewseason" class="btn btn-info" name="add"><i class="fa fa-plus"></i> New Season</a>                
               </div> 
             </div>         
           <div class="row border_row">
            <table class="display nowrap" cellspacing="0" width="100%" id="table1">
             <thead>
              <tr>                
                <th>Code</th>
                <th>Name</th>
                <th>Periods</th> 
                <th>Action</th>                        
              </tr>
            </thead>
            <tbody>
              <tr>                
                <td>win12</td>
                <td>win12</td>
                <td>03-07-2017 - 03-08-2017<br>15-08-2017 - 15-09-2017</td>
                <td><a class="btn btn-info btn-xs" href="javascript:void(0)"><i class="fa fa-pencil" title="Edit this Season"></i></a>  <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Delete this Season"><i class="fa fa-times"></i></a></td>
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
 </div>
 </section>
</div>
</div>
</section>
<div class="modal fade" id="addnewseason" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ADD New Season</h4>
      </div>
      <div class="modal-body">
       <div class="row border_row">      
         <div class="form-group col-md-6">
      <label class="strong" for="season_code">Code : </label>
      <input type="text" class="form-control" name="season_code" required="required">
      </div>
        <div class="form-group col-md-6">
      <label class="strong" for="season_name">Name : </label>
      <input type="text" class="form-control" name="season_name" required="required">
      </div>

       </div>
     
   <div class="row border_row">
   <h5 style="font-weight: bold;margin-left: 10px;" >Periods:</h5>
     <div class="form-group col-md-6">    
     <input type="text"  class="form-control selectdate" name="season_start_date[]" required="required">
    </div>
    <div class="form-group col-md-6">
     
     <input type="text"  class="form-control selectdate" name="season_end_date[]" required="required">
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
  
<?php echo $this->load->view('data_tables_js'); ?>
  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<style>
.daterangepicker{z-index:1151 !important;}
</style>
<script type="text/javascript">
// $('.todo').on('click', function(){
//   var data = $(this).val();
//   $('#todo').val(data);
//   var form = $('form');   
//       form.parsley().validate();
//       if (!form.parsley().isValid()) {
//           return false;
//       }
// });

$('.todo').on('click', function(){
 $ins_id = $("#insert_id").val();   
window.location.replace('<?php echo site_url();?>contract/edit_step3?id='+$ins_id);
       
});
</script>
<script type="text/javascript"> 
  $(function() {
    var dateToday = new Date();
    $('.date_range').daterangepicker({
      //timePicker: true,
      minDate: dateToday,
      autoApply: true,
      stepMonths: false,
      timePickerIncrement: 30,
      locale: {
          format: 'DD/MM/YYYY'
      }
    });
   $('.singledate').daterangepicker({
        singleDatePicker : true,
         maxDate: dateToday,
        format : 'MM/DD/YYYY',
        startDate : moment().format('MM/DD/YYYY'),
        endDate : moment().format('MM/DD/YYYY')
   });

   $('.selectdate').daterangepicker({
        singleDatePicker : true,
         minDate: dateToday,
        format : 'DD-MM-YYYY',
        startDate : moment().format('DD-MM-YYYY'),       
   });
  });
</script>

