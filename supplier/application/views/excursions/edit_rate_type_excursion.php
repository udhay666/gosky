<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link href="<?php echo base_url();?>public/js/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/css/buttons.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
	<div class="page">
		<div class="row">
			<div class="col-md-12">
				<div class="pageheader">
					<div class="page-bar  br-5">
						<ul class="page-breadcrumb">
							<li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
							<li><a href="#">Excursions</a></li>
							<li><a class="active" href="<?php echo site_url()?>excursions/excursion_rates_list?id=<?php echo $excursion_id;?>">Excursion Rates Types</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php
		$sess_msg = $this->session->flashdata('message');
		$errors_msg = $this->session->flashdata('errors_msg');
		if(!empty($sess_msg)){
			$message = $sess_msg;
			$class = 'success';
		} else  if(!empty($errors_msg)){
			$message = $errors_msg;
			$class = 'danger';
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
			<div class="col-md-12">
				<section class="boxs">
					<div class="boxs-header dvd dvd-btm">
						<h1 class="custom-font"><?php echo $excursion_info[0]->excursion_name; ?></h1>
						<ul class="controls">
							<li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
						</ul>
					</div>
                  <div class="boxs-body">
                   <div class="pagecontent">
							<div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
								<div class="tab-content2">
									<form action="<?php echo site_url()?>excursions/update_rate_types" method="post" class="step_form step1" steps="1" name="step1" role="form" enctype="multipart/form-data">
										<div class="tab-pane active" id="step-1">
											<div class="row border_row">
												<div class="form-group col-md-4">
													<label class="strong" for="rate_types_name">Rate Types Name:</label>
													<input name="rate_types_name" id="rate_types_name" value="<?php echo $rate_types[0]->rate_types_name; ?>" type="text" class="form-control" required="required">
													<input type="hidden" name="id1" value="<?php echo $excursion_id; ?>">
												<input type="hidden" name="id" value="<?php echo $excursions_rate_types_id; ?>">
												</div>
												<div class="form-group col-md-4">
													<label class="strong" for="	duration_type">Duration Type:</label>
													<select name="duration_type" class="form-control select2" id="duration_type"  required="required">
													<option value="">Duration Type</option>
													<option value="Minutes" <?php 
													if($rate_types[0]->duration_type=='Minutes'){ echo 'selected'; } ?>>Minutes</option>
													<option value="Hour" <?php 
													if($rate_types[0]->duration_type=='Hour'){ echo 'selected'; } ?>>Hour</option>
													</select>
												</div>
												<div class="form-group col-md-4">
													<label class="strong" for="duration">Duration:</label>
													<input name="duration" id="duration" value="<?php echo $rate_types[0]->duration; ?>"  type="text" class="form-control" required>
												</div>
											</div>
											<div class="row border_row">
												<div class="form-group col-md-6">
													<label class="strong" for="description">Description:</label>
													<textarea name="description" class="form-control" rows="3" id="description" required><?php echo $rate_types[0]->description; ?></textarea>
													</div>
											      <div class="form-group col-md-3">
									                  <label class="strong">Check-in :</label>
									                  <div class="input-group">
									                    <input type="text" name="check_in" value="<?php echo $rate_types[0]->check_in; ?>" class="form-control datepicker" id="timepicker11" data-format="LT" required/>
									                    <label class="input-group-addon" for="timepicker11"><span class="glyphicon glyphicon-time"></span></label>
									                  </div>
									                </div>
									                <div class="form-group col-md-3">
									                  <label class="strong">Check-out :</label>
									                  <div class="input-group">
									                    <input type="text" name="check_out" value="<?php echo $rate_types[0]->check_out; ?>" class="form-control datepicker" data-format="LT" id="timepicker22"  required/>
									                    <label class="input-group-addon" for="timepicker22"><span class="glyphicon glyphicon-time"></span></label>
									                  </div>
									                </div>
									              </div>			
											      </div>
													<ul class="pager wizard">
														<li class="first">
															<button type="submit" class="btn btn-success todo" style="float: right;margin-right: 20px">Save</button>
														</li>
													</ul>
												</form>
											</div>
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
 <script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script type="text/javascript">
$('.todo').on('click', function(){
var data = $(this).val();
var durNum= /^[0-9]+(\:\d{1,2})?$/;
$('#todo').val(data);
var form = $('form');
form.parsley().validate();
if(!durNum.test($('#duration').val())){
          alert("Enter Either Numberic  or Time format Example 2:30");
           $('#duration').val('');
            $('#duration').focus();
           return false;
         }
if (!form.parsley().isValid()) {
return false;
}

});
</script>
<script>
$(document).ready(function() {
  $(".select2").select2({  
  });
});
</script>
<script type="text/javascript">
$('#timepicker1,#timepicker2').timepicker();
</script>
