<?php $this->load->view('home/header');?>
<link href="<?php echo base_url(); ?>public/css/select2.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/js/form-wizard/form-wizard.css" rel="stylesheet">
<style type="text/css">
.section {
	 background-color: #fff; 
	 color: #1c1d22; 
}
.select2-close-mask{
    z-index: 2099;
}
.select2-dropdown{
    z-index: 3051;
}
</style>
<div id="wrapper">
<section id="pack-section" class="pack-section" style="background: #1c1d22;">
	<div class="row2">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard row2">
        <div class="col-sm-12">
          <ul class="wizard_steps nav nav-pills">
			<li><a href="#"><span class="step_no wizard-step">1</span><span class="step_descr">Your Tour</span></a></li>
			<li><a href="#"><span class="step_no wizard-step">2</span><span class="step_descr">Select Accomodation</span></a></li>
			<li class="active"><a href="#"><span class="step_no wizard-step">3</span><span class="step_descr">Traveller Details</span></a></li>
			<li><a href="#"><span class="step_no wizard-step">4</span><span class="step_descr">Payment & Confirmation</span></a></li>
			<!--   <li><a href="#"><span class="step_no wizard-step">5</span><span class="step_descr">Confirmation</span></a></li> -->
          </ul>
        </div>
      </div>
    </div>
	<form name="booking" method="POST" action="<?php echo base_url(); ?>index.php/holiday/confirm_booking" enctype='multipart/form-data' class="container traveller-details">
		<!-- Contact details -->
		<section id="home" class="shadow-box white-container container page" style="margin-top: 25px;">
			<section class="section">
				<h4><?php echo $holidaydetails->package_title; ?></h4>
				<h6><?php echo ($holidaydetails->duration)." Nights / ".($holidaydetails->duration+1)." Days";?></h6>
				<h5><i class="fa fa-address-card-o"></i> Contact Details</h5>
				<div class="bottom-line"></div>
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label" for="user_email">Email <span class="label-info">(For Booking Reference)</span></label>
							<input type="email" name="user_email" class="form-control" id="user_email" placeholder="Enter your Email" autocomplete="off"/>
							<input type="hidden" name="retval" id="retvalue" value="true"/>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label" for="user_mobile">Contact No <span class="label-info">(For Booking Reference)</span></label>
							<input type="text" name="user_mobile" class="form-control" id="user_mobile" placeholder="Enter your Mobile No" autocomplete="off"/>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label" for="user_city">City</label>
							<input type="text" name="user_city" class="form-control" placeholder="Enter your City" id="user_city" autocomplete="off"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label" for="user_pincode">Postal Code</label>
							<input type="text" name="user_pincode" class="form-control" placeholder="Enter your Postal Code" id="user_pincode" autocomplete="off"/>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label" for="user_state">State</label>
							<input type="text" name="user_state" class="form-control" placeholder="Enter your State" id="user_state" autocomplete="off"/>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label" for="user_country">Country</label>
							<select id="country" name="user_country" class="form-control">
								<option value="">Select Your Country</option>
								<optgroup label="Country List">
									<option value="India">India</option>
									<?php for($i=0;$i<count($country_list);$i++){?>
									<option value="<?php echo $country_list[$i]->name;?>"><?php echo $country_list[$i]->name;?></option>
									<?php } ?>
								</optgroup>
							</select>
							<span id="user_country" style="color: red;"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8">
						<div class="form-group">
							<label class="control-label" for="user_address">Address</label>
							<textarea class="form-control" name="address" placeholder="Enter your contact address" id="user_address" style="height: 80px;min-height: 80px;" autocomplete="off"></textarea>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label" for="user_comment">Comment</label>
							<textarea class="form-control" name="comment" id="user_comment" placeholder="Enter your Comment" style="height: 80px;min-height: 80px;" autocomplete="off"></textarea>
						</div>
					</div>
				</div>
			</section>
		</section>
		<!-- traveller details -->
		<section id="Traveller" class="shadow-box white-container container page">
			<section class="section">
				<h5><i class="fa fa-users"></i> Traveller Details</h5>
				<div class="bottom-line"></div>
				<div class="row2">
					<?php if($adults_no>0){ ?>
					<h6>1. Adult(s)</h6>
					<?php for($i=0;$i<$adults_no;$i++){ ?>
					<div class="row checkname">
						<div class="col-sm-12">
							<div class="col-sm-1 ">Adult <?php echo ($i+1);?></div>
							<div class="col-sm-2 form-group">
								<select class="form-control checktitle2" name="title[]" required="">
									<option value=""></option>
									<option value="Mr">Mr</option>
									<option value="Mrs">Mrs</option>
									<option value="Ms">Ms</option>
								</select>
								<span style="color: red;"></span>
							</div>
							<div class="col-sm-2 form-group">
								<input type="text" name="fname[]" class="form-control" placeholder="First Name" autocomplete="off"/>
							</div>
							<div class="col-sm-2 form-group">
								<input type="text" name="mname[]" class="form-control" placeholder="Middle Name" autocomplete="off"/>
							</div>
							<div class="col-sm-2 form-group">
								<input type="text" name="lname[]" class="form-control" placeholder="Last Name" autocomplete="off"/>
							</div>
							<!-- <div class="col-md-1 form-group">
									<select class="form-control" name="gender[]" style="padding-right: 0;padding-left: 10px;" >
											<option value="">Gender</option>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
									</select>
							</div> -->
							<div class="col-sm-3 form-group">
								<input type="text" name="dob[]" class="form-control adob_dp" placeholder="Date of Birth"   data-inputmask="'mask': '99/99/9999'" style="background: white;cursor: pointer;" autocomplete="off"/>
							</div>
							<input type="hidden" name="passengertype[]" value="adult">
						</div>
					</div>
					<?php } } ?>
				</div>
				<div class="row2">
					<?php if($childs_no>0){ ?>
					<h6>2. Child(s) (With Bed)</h6>
					<?php for($i=0;$i<$childs_no;$i++){ ?>
					<div class="row checkname">
						<div class="col-sm-12">
							<div class="col-sm-1">Child <?php echo ($i+1);?></div>
							<div class="col-sm-2 form-group">
								<select class="form-control checktitle2" name="title[]" required="">
									<option value=""></option>
									<option value="Mr">Mr</option>
									<option value="Mrs">Mrs</option>
									<option value="Ms">Ms</option>
								</select>
								<span style="color: red;"></span>
							</div>
							<div class="col-sm-2 form-group">
								<input type="text" name="fname[]" class="form-control" placeholder="First Name"  autocomplete="off"/>
							</div>
							<div class="col-sm-2 form-group">
								<input type="text" name="mname[]" class="form-control" placeholder="Middle Name" />
							</div>
							<div class="col-sm-2 form-group">
								<input type="text" name="lname[]" class="form-control" placeholder="Last Name" autocomplete="off"/>
							</div>
							<div class="col-sm-3 form-group">
								<input type="text" name="dob[]" class="form-control cdob_dp" placeholder="Date of Birth" data-inputmask="'mask': '99/99/9999'" style="background: white;cursor: pointer;" autocomplete="off"/>
							</div>
						</div>
						<input type="hidden" name="passengertype[]" value="child">
					</div>
					<?php } } ?>
				</div>
				<div class="row2">
					<?php if($childswithoutbed_no>0){ ?>
					<h6>Child(s) (Without Bed)</h6>
					<?php for($i=0;$i<$childswithoutbed_no;$i++){ ?>
					<div class="row checkname">
						<div class="col-sm-12">
							<div class="col-sm-1">Child <?php echo ($i+1);?></div>
							<div class="col-sm-2 form-group">
								<select class="form-control checktitle2" name="title[]" required="">
									<option value=""></option>
									<option value="Mr">Mr</option>
									<option value="Mrs">Mrs</option>
									<option value="Ms">Ms</option>
								</select>
								<span style="color: red;"></span>
							</div>
							<div class="col-sm-2 form-group">
								<input type="text" name="fname[]" class="form-control" placeholder="First Name"  autocomplete="off"/>
							</div>
							<div class="col-sm-2 form-group">
								<input type="text" name="mname[]" class="form-control" placeholder="Middle Name" />
							</div>
							<div class="col-sm-2 form-group">
								<input type="text" name="lname[]" class="form-control" placeholder="Last Name" autocomplete="off"/>
							</div>
							<div class="col-sm-3 form-group">
								<input type="text" name="dob[]" class="form-control cdob_dp" placeholder="Date of Birth" data-inputmask="'mask': '99/99/9999'" style="background: white;cursor: pointer;" autocomplete="off"/>
							</div>
						</div>
						<input type="hidden" name="passengertype[]" value="childwithoutbed">
					</div>
					<?php } } ?>
				</div>
				<div class="row2">
					<?php if($infants_no>0){ ?>
					<h6>3. Infant(s)</h6>
					<?php for($i=0;$i<$infants_no;$i++){ ?>
					<div class="row checkname">
						<div class="col-sm-12">
							<div class="col-sm-1 ">Infant <?php echo ($i+1);?></div>
							<div class="col-sm-2 form-group">
								<select class="form-control checktitle2" name="title[]" required="">
									<option value=""></option>
									<option value="Mr">Mr</option>
									<option value="Mrs">Mrs</option>
									<option value="Ms">Ms</option>
								</select>
								<span style="color: red;"></span>
							</div>
							<div class="col-sm-2 form-group">
								<input type="text" name="fname[]" class="form-control" placeholder="First Name"  autocomplete="off"/>
							</div>
							<div class="col-sm-2 form-group">
								<input type="text" name="mname[]" class="form-control" placeholder="Middle Name" autocomplete="off"/>
							</div>
							<div class="col-sm-2 form-group">
								<input type="text" name="lname[]" class="form-control" placeholder="Last Name" autocomplete="off"/>
							</div>
							<div class="col-sm-3 form-group">
								<input type="text" name="dob[]" class="form-control idob_dp" placeholder="Date of Birth" data-inputmask="'mask': '99/99/9999'" autocomplete="off" style="background: white;cursor: pointer;"/>
							</div>
							<input type="hidden" name="passengertype[]" value="infant">
						</div>
					</div>
					<?php } } ?>
				</div>
			</section>
		</section>
		<!-- Package details -->
		<section id="Package" class="shadow-box white-container container page">
			<section class="section">
				<h5><i class="fa fa-snowflake-o"></i> Package Details</h5>
				<div class="bottom-line"></div>
				<div class="row2 table-responsive ">
					<table align="" class="table table-striped table-bordered ">
						<tr>
							<th>Package Name</th>
							<th>Duration</th>
							<th>Arrival Date</th>
							<th>Departure Date</th>
							<th>Accommodation Type</th>
							<th>Room(s)</th>
							<th>Adult(s)</th>
							<th>Child(ren) (With Bed)</th>
							<th>Child(ren) Without Bed</th>
							<th>Infant(s)</th>
							<th>Total Cost</th>
						</tr>
						<tr>
							<td><?php echo $holidaydetails->package_title; ?></td>
							<td><?php echo ($holidaydetails->duration)." Nights / ".($holidaydetails->duration+1)." Days";?></td>
							<td><?php echo $arrival_date;?></td>
							<td><?php echo $depart_date; ?></td>
							<td><?php echo $accom_type;?></td>
							<td><?php echo $room_counts; ?></td>
							<td><?php echo $adults_no; ?></td>
							<td><?php echo $childs_no; ?></td>
							<td><?php echo $childswithoutbed_no; ?></td>
							<td><?php echo $infants_no; ?></td>
							<td><i class="fa fa-rupee"></i> <strong><?php echo moneyFormatIndia($total_cost); ?></strong></td>
						</tr>
					</table>
					<input type="hidden" name="package_title" value="<?php echo $holidaydetails->package_title; ?>" />
					<input type="hidden" name="package_code" value="<?php echo $holidaydetails->package_code; ?>" />
					<input type="hidden" name="holiday_duration" value="<?php echo ($holidaydetails->duration)." Nights / ".($holidaydetails->duration+1)." Days";?>" />
					<input type="hidden" name="arrival_date" value="<?php echo $arrival_date;?>" />
					<input type="hidden" name="depart_date" value="<?php echo $depart_date;?>" />
					<input type="hidden" name="accommodation_type" value="<?php echo $accom_type;?>" />
					<input type="hidden" name="room_no" value="<?php echo $room_counts; ?>" />
					<input type="hidden" name="single_room_no" value="<?php echo $single_no; ?>" />
					<input type="hidden" name="twin_room_no" value="<?php echo $twin_no; ?>" />
					<input type="hidden" name="triple_room_no" value="<?php echo $triple_no; ?>" />
					<input type="hidden" name="room_details" value='<?php echo ($room_details); ?>' />
					<input type="hidden" name="adults_no" value="<?php echo $adults_no; ?>" />
					<input type="hidden" name="childs_no" value="<?php echo $childs_no; ?>" />
					<input type="hidden" name="childswithoutbed_no" value="<?php echo $childswithoutbed_no; ?>" />
					<input type="hidden" name="infants_no" value="<?php echo $infants_no; ?>" />					
					<input type="hidden" id="original_cost" name="total_cost" value="<?php echo $total_cost;?>"/>
				</div>
				<?php if(!empty($room_arr)){ ?>
			 <div class="row" style="margin-top:10px"></div>
				<div class="row2 table-responsive ">
					<table align="" class="table table-striped table-bordered">
						<tr>
							<th colspan="2">Room(s)</th>
							<th colspan="2">Room Type</th>
							<th colspan="1">Adult(s)</th>
							<th colspan="2">Child(ren) (With Bed)</th>
							<th colspan="2">Child(ren) (Without Bed)</th>
							<th colspan="1">Infant(s)</th>
						</tr>
						<?php for($i=0;$i<count($room_arr);$i++){ ?>
						<tr>
							<td colspan="2">Room <?php echo ($i+1);?></td>
							<td colspan="2"><?php echo ucfirst($room_arr[$i]['type']).' '.'Sharing';?></td>
							<td colspan="1"><?php echo $room_arr[$i]['adults'];?></td>
							<td colspan="2"><?php echo $room_arr[$i]['childs'];?></td>
							<td colspan="2"><?php echo $room_arr[$i]['childswithoutbed'];?></td>
							<td colspan="1"><?php echo $room_arr[$i]['infants'];?></td>
						</tr>
						<?php } ?>
					</table>
				</div>
				<?php } ?>
			</section>
		</section>
		<!-- Holiday Promo Code -->
	<section class="shadow-box white-container container page">
	<section class="section">
	<h5><i class="fa fa-credit-card"></i> Promotional Code</h5>
	<div class="bottom-line"></div>
         <div class="row">
         <div class="col-sm-4">	            
		        <input type="text" id="promo_code" name="promo_code" placeholder="Enter Promotional Code" class="form-control" autocomplete="off" />			
			</div>
			 <div class="col-sm-2">
	         <a id="applypromo" class="btn btn-default">Apply</a>
	         </div>
		</div>
		<div class="row">
		<div class="col-xs-12"><span class="after_discount" style="color: #f24843;"> &nbsp;&nbsp; <span id="promo_alert"></span></span></div>
		</div>
		</section>
		</section>
		<!-- Payment details -->
		<section id="Payment" class="shadow-box white-container container page">
			<section class="section">
				<h5><i class="fa fa-credit-card"></i> Payment Details</h5>
				<div class="bottom-line"></div>
				<div class="row">
					<div class="col-xs-12">
						<h4><span>Total Cost</span> <span class="after_discount" style="color: #f24843;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <i class="fa fa-rupee"></i>&nbsp;<?php echo moneyFormatIndia($total_cost); ?></span></h4>
					</div>
					<div class="col-xs-12" id="discostdiv" style="display: none;">
						<h4><span>Discount </span> <span class="after_discount" style="color: #f24843;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <i class="fa fa-rupee"></i>&nbsp;<span id="discost"></span></span></h4>
					</div>
					<div class="col-xs-12"  id="grandcostdiv" style="display: none;">
						<h4><span>Grand Total</span> <span class="after_discount" style="color: #f24843;">&nbsp;&nbsp;  <i class="fa fa-rupee"></i>&nbsp;<span id="grandcost"></span></h4>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<label>
							<input type="hidden"  name="holiday_id"  value="<?php echo $holidaydetails->holiday_id; ?>">
							<input type="checkbox" name="termsagree" id="termsagree" /> I have read and agree to the terms and conditions. <span id="termsspan" style="font-size: 10px;"></span>
						</label>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-xs-12">
						<input type="hidden" name="pay_type" value="razorpay"/>
						<input type="submit" name="submit" id="travellersubmit" class="btn btn-default" value="Continue" style="margin-bottom:10px" />
					</div>
				</div>
			</section>
		</section>
	</form>
</section>
<?php $this->load->view('home/footer');?>
<style type="text/css">
	#footerbar {
		background: #1c1d22 url(../public/images/footerbar.png) no-repeat bottom center;
	}
	/*.select2-container--default .select2-selection--single,
	.select2-dropdown, .select2-container--default .select2-search--dropdown .select2-search__field {
	    background-color: #5a5a5a;
	    border: 1px solid #676767;
	    color: #fff;
	}*/
	/*.table-striped>tbody>tr:nth-child(odd)>td, .table-striped>tbody>tr:nth-child(odd)>th {
	    background-color: #5a5a5a;
	}
	.table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
	    border: 1px solid #676767;
	}*/
	input[type="text"],input[type="email"], input[type="password"], select, input[type="date"], textarea, select{
		height: 32px;
		font-size: 14px;
	}
	.form-control {
		height: 32px;
		padding: 5px 10px;
	}
	textarea:focus,.form-control:focus,
	select:focus {
		border-color: #a01d26;
		font-family: 'Montserrat', sans-serif;
		-webkit-box-shadow: 0 0 5px 1px #a01d26;
		box-shadow: 0 0 5px 1px #a01d26;
	}
</style>
<script src="<?php echo base_url(); ?>public/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/travellerdetailsvalidation.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#country").select2({
		placeholder: "Select Your Country",
		allowClear: true
	});
	$(".checktitle2").select2({
		placeholder: "Title",
	  	minimumResultsForSearch: -1
	});
});
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/bootstrapdaterangepicker/moment.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/bootstrapdaterangepicker/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/bootstrapdaterangepicker/daterangepicker.css" />
<!-- jquery.inputmask -->
<script src="<?php echo base_url(); ?>public/bootstrapdaterangepicker/jquery.inputmask.bundle.min.js"></script>
<!-- jquery.inputmask -->
<script>
	$(document).ready(function() {
		$(":input").inputmask();
	});
</script>
<script type="text/javascript">
$(function() {
var d = new Date();
$('.adob_dp').daterangepicker({
	singleDatePicker: true,
	showDropdowns: true,
	locale: {
		format: 'DD/MM/YYYY'
	},
startDate: '<?php echo date('d/m/Y', strtotime('-12 years')) ?>',
minDate:d.getDate()+"/"+(d.getMonth()+1)+"/"+(d.getFullYear()-110) ,
maxDate:d.getDate()+"/"+(d.getMonth()+1)+"/"+(d.getFullYear()-12),
});
$('.cdob_dp').daterangepicker({
	singleDatePicker: true,
	showDropdowns: true,
	locale: {
		format: 'DD/MM/YYYY'
	},
	startDate: '<?php echo date('d/m/Y', strtotime('-2 years')) ?>',
	minDate: (d.getDate()-1)+"/"+(d.getMonth()+1)+"/"+(d.getFullYear()-12),
	maxDate: d.getDate()+"/"+(d.getMonth()+1)+"/"+(d.getFullYear()-2),
});
$('.idob_dp').daterangepicker({
	singleDatePicker: true,
	showDropdowns: true,
	locale: {
		format: 'DD/MM/YYYY'
	},
	startDate: '<?php echo date('d/m/Y') ?>',
	minDate: d.getDate()+"/"+(d.getMonth()+1)+"/"+(d.getFullYear()-2),
	maxDate:  d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear(),
});
$('.ppi_dp').daterangepicker({
	singleDatePicker: true,
	showDropdowns: true,
	locale: {
		format: 'DD/MM/YYYY'
	},
	maxDate:  d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear(),
});
$('.ppe_dp').daterangepicker({
	singleDatePicker: true,
	showDropdowns: true,
	locale: {
		format: 'DD/MM/YYYY'
	},
	minDate:d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear(),
	maxDate: d.getDate()+"/"+(d.getMonth()+1)+"/"+(d.getFullYear()+45),
});
$('input[name="dob[]"]').val('');
});
</script>