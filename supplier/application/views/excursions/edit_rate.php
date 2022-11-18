<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<section id="content">
	<div class="page">
		<div class="row">
			<div class="col-md-12">
				<div class="pageheader">
					<div class="page-bar  br-5">
						<ul class="page-breadcrumb">
							<li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
							<li><a href="#">Excursions</a></li>
							<li><a class="active" href="<?php echo site_url()?>excursions/edit_rate/<?php echo $excursions_rate_types_id;?>/<?php echo $excursion_id;?>">Edit Excursion Rates</a></li>
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
									<form action="<?php echo site_url()?>excursions/get_excursion_rates_def" method="post" class="step_form step1" steps="1" name="step1" role="form" enctype="multipart/form-data">
										<div class="tab-pane active" id="step-1">
											<div class="row border_row">
												<div class="form-group col-md-3">
													<label class="strong" for="rate_types_name">Rate Types Name:</label>
													<?php echo $rate_types[0]->rate_types_name; ?>
													<input type="hidden" name="id1" value="<?php echo $excursion_id; ?>">
													<input type="hidden" name="id" value="<?php echo $excursions_rate_types_id; ?>">
												</div>
												<div class="form-group col-md-3">
													<label class="strong" for="from_date">From Date: </label>
													<input type="text" class="form-control selectdate" id="from_date" name="from_date" placeholder="Select From Date">
												</div>
												<div class="form-group col-md-3">
													<label class="strong" for="to_date">To Date: </label>
													<input type="text" class="form-control selectdate" id="to_date" name="to_date" placeholder="Select To Date">
													
												</div>
											</div>
											<div class="row">
											<div class="form-group col-md-3"></div>
												<div class="form-group col-md-3">
												    <input type="hidden" name="excursion_code" value="<?php echo $excursion_info[0]->excursion_code; ?>"/>
            											<input type="hidden" name="excursion_id" value="<?php echo $excursion_id; ?>"/>
													<button type="submit" class="btn btn-success">Submit</button>
													</div>
											</div>
										</div>
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
<script src="<?php echo base_url(); ?>public/js/main.js"></script>

<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>

<script type="text/javascript">
  $('input[name="from_date"]').prop('readonly', true); 
  $('input[name="to_date"]').prop('readonly', true);  
 $(".selectdate").click(function(){
   $('input[name="daterangepicker_start"]').prop('disabled', true); 
  $('input[name="daterangepicker_end"]').prop('disabled', true);  
  });
$(function() { 
 
   var dateToday = new Date();
  $('.selectdate').daterangepicker({  
    autoUpdateInput: false,
    showDropdowns: true,
     minDate: dateToday,
    format : 'DD-MM-YYYY',
    startDate : dateToday,  
    maxDays: 30,     
      locale: {
          cancelLabel: 'Clear'
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
});
</script>
