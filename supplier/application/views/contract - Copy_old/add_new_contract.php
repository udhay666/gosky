<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
  var siteUrl='<?php echo site_url();?>';
</script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">      
         <div class="page-bar  br-5">
          <ul class="page-breadcrumb">
            <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>             
            <li><a class="active" href="<?php echo site_url() ?>contract/new_contract">Add New Contract</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <section class="boxs">
        <div class="boxs-header dvd dvd-btm">
          <h1 class="custom-font">Add New Contract</h1>
          <ul class="controls">
            <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
          </ul>
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
          <br>
          <div class="alert alert-<?php echo $class ?>">
            <button class="close" data-dismiss="alert" type="button">×</button>
            <strong><?php echo ucfirst($class) ?>....!</strong>
            <?php echo $message; ?>
          </div>
          <?php } ?>      
        </div>
        <div class="boxs-body">    
         <form class="step_form step1" steps="1" name="step1" role="form">
          <div class="row">            
            <div class="form-group col-md-4">
              <label class="strong" for="contract_number">Contract Number : </label>
              <input name="contract_number" id="contract_number" value="<?php echo set_value('contract_number'); ?>" type="text" class="form-control" required>
            </div>
            <div class="form-group col-md-8">
              <label class="strong" for="contract_desc">Description : </label>
              <input name="contract_desc" id="contract_desc" value="<?php echo set_value('contract_desc'); ?>" type="text" class="form-control" required>
            </div>              
          </div>
          <div class="row">
            <div class="form-group col-md-4">
              <label class="strong" for="start_date">Start Date : </label>
              <input type="text" name="start_date" id="start_date" value="<?php echo set_value('start_date'); ?>" class="selectdate form-control" required>
            </div>
            <div class="form-group col-md-4">
              <label class="strong" for="end_date">End Date : </label>
              <input type="text" name="end_date" id="end_date" value="<?php echo set_value('end_date'); ?>" class="selectdate form-control" required>
            </div>
            <div class="form-group col-md-4">
              <label class="strong" for="signed_date">Signed Date : </label>
              <input type="text" name="signed_date" id="signed_date" value="<?php echo set_value('signed_date'); ?>" class="selectdate form-control" required>
            </div>
          </div>             
          <div class="row">
           <div class="form-group col-md-4">
            <label class="strong" for="status">Status is : </label>
            <select name="status"  id="status" class="form-control" readonly="readonly" required disabled="disabled">
              <option value="0" selected>in Progress</option>
            </select>
          </div>
          <div class="row">
          </div>
          <div class="form-group col-md-8 check_icon">
            <label class="strong">Market Availability : </label>
            <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="market" class="flat" value="all" checked="checked" readonly="readonly" disabled="disabled"><i></i> All Markets</label> 
            <br>
            <a href="javascript:void(0)" style="text-decoration: underline;">Exclude</a></div>
        </div>
        <div class="row">
          <div class="form-group col-md-4">
           <p style="background: pink;color: red;text-align: center;">Note : * Start Date must be greater than End Date</p>
         </div>
         <div class="form-group col-md-8"> <button class="btn btn-success todo" style="float: right;margin-right: 20px">Save</button></div>
       </div>           
     </form>
   </div>
 </div>
</section>
</div>
</div>
</div>
</section>
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script type="text/javascript">
  $('.todo').on('click', function(){
    var data = $(this).val();
    $('#todo').val(data);
    var form = $('form');   
    form.parsley().validate();
    if (!form.parsley().isValid()) {
      return false;
    }
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