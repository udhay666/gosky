<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
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
							<li><a class="active" href="<?php echo site_url()?>room/add_room">Excursion Rates</a></li>
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
						<h1 class="custom-font"><?php echo $excursion_info->excursion_name ?></h1>
						<ul class="controls">
							<li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
						</ul>
					</div>
					<div class="boxs-body">
						<div class="pagecontent">
							<div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
								<div class="tab-content2">
									<form action="#" method="post" class="step_form step1" steps="1" name="step1" role="form" enctype="multipart/form-data">
										<input type="hidden" value="<?php echo $excursion_id ?>" name="excursion_id"/>
										<div class="tab-pane active" id="step-1">
											<div id="rates_wrapper">
												<div class="add_remove text-right mb-5">
													<div class="pull-left" style="font-size: 15px;font-weight: 700;">Add Rates :</div>
													<a class="btn btn-success add-field fa fa-plus"> Add</a>
													<a class="btn btn-danger remove-field fa fa-times"> Remove</a>
												</div>
												<div id="rates_field_wrapper">
													<section class="boxs repeat-field" id="rates_1">
														<div class="boxs-header dvd dvd-btm">
															<h1 class="custom-font"># <span class="counter">1</span></h1>
															<input type="hidden" name="counter[]" id="counter" value="1">
															<input type="hidden" name="total_day" id="counter2" value="1">
															<ul class="controls custom_cntrl">
																<li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-minus"></i></span> <span class="expand"><i class="fa fa-plus"></i></span> </a> </li>
															</ul>
														</div>
														<div class="boxs-body">
															<div class="row2">
																<div class="row border_row">
																	<div class="form-group col-md-4">
																		<label class="strong">Validaty Period (from and to):</label>
																		<input type="text" name="validity[]" class="date_range form-control" placeholder="Start Date - End Date" required>
																	</div>
																	<div class="form-group col-md-4">
																		<label class="strong">Adult Rates:</label>
																		<input name="adult_rates[]" value="" type="text" class="form-control" required="required">
																	</div>
																	<div class="form-group col-md-4">
																		<label class="strong">Child Rates:</label>
																		<input name="child_rates" value="" type="text" class="form-control" required="required">
																	</div>
																</div>
															</div>
														</div>
													</section>
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
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>

<!--  Custom JavaScripts  -->
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
jQuery(function($) {
  var cloneCount = 2;
  $("#rates_wrapper").each(function() {
    var $wrapper = $('#rates_field_wrapper', this);
    $(".add-field", $(this)).click(function(e){
      e.preventDefault();
      var dy = 'rates_'+(cloneCount-1);
      // var clone = $('#rates_1:first').clone(true).attr('id', 'rates_1'+ cloneCount++).insertAfter($('[id^=rates_1]:last'));
      var clone = $('#'+dy).clone(true, true).attr('id', 'rates_'+cloneCount++).insertAfter($('[id^='+dy+']'));

      clone.find('input[type="text"]').val('0');
      clone.find('.counter').html((cloneCount-1));
      clone.find('#counter').val((cloneCount-1));
      clone.find('#counter2').val((cloneCount-1));
      // clone.find('.date_range').val('Start Date - End Date');

      clone.find(".date_range").each(function() {
        var dateToday = new Date();
        $(this).attr("id", "").removeData().off();
        $(this).find('input').removeData().off();
        $(this).daterangepicker({
          minDate: dateToday,
          autoApply: true,
          stepMonths: false,
          timePickerIncrement: 30,
          locale: {
              format: 'DD/MM/YYYY'
          }
        });
        $(this).val('');
      });

    });
    $('.remove-field', $(this)).click(function(e) {
      e.preventDefault();
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#rates_'+cloneCount).remove();
      }
    });
  }); 
});
</script>
<script type="text/javascript"> 
$(function() {
  var dateToday = new Date();
  var dateval = $('.date_range').val();
  $('.date_range').daterangepicker({
    minDate: dateToday,
    autoApply: true,
    stepMonths: false,
    timePickerIncrement: 30,
    locale: {
        format: 'DD/MM/YYYY'
    }
  });
  if(dateval == ''){
    $('.date_range').val('');
  }
  // $('.date_range').val('Start Date - End Date');
});
</script>