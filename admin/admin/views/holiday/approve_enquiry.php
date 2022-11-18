<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<div class="mainpanel">
<?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
	<!-- content goes here -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Approve Holiday Enqiry</h4>
					<!-- <div class="panel-btns">
						<a href="#" class="panel-close">&times;</a>
						<a href="#" class="minimize">&minus;</a>
					</div> -->
			</div>
			<div class="panel-body">
				<div class="row-fluid">
					<div class="span12">
						<div class="box" style="height: 100%;border: 1px solid #ffff; background-color: #ffff;">
			<div class="box-content">
				<form  id="basicForm" class="form-horizontal" action="<?php echo site_url(); ?>/holiday/add_booking_reports" enctype="multipart/form-data" method="post">
				<fieldset>
				<?php if(validation_errors() != ""){ ?>
					<div class="alert alert-error">
						<button class="close" data-dismiss="alert" type="button">×</button>
						<?php echo validation_errors();?>
					</div>
					<?php } ?>
												
					<?php
					if($status == '2')
					{
					?>
					<div class="alert alert-success">
						<button class="close" data-dismiss="alert" type="button">×</button>
						<strong>Success!</strong>
						User Registration Successfully Created.
					</div>
					<?php
					}
					else if($status == '1')
					{
					?>
					<div class="alert alert-error">
						<button class="close" data-dismiss="alert" type="button">×</button>
						<strong>Error!</strong>
						User Registration Not Done. Please try after some time...
					</div>
					<?php } ?>
												
					<?php
						if(!empty($errors))
					{ ?>
					<div class="alert alert-error">
						<button class="close" data-dismiss="alert" type="button">×</button>
						<strong>Error!</strong>
						<?php echo $errors;?>
						</div>
					<?php } ?>	
					<input type="hidden" name="id" value="<?php echo $holiday_enquiry->id?>">				
					<input type="hidden" name="uniqueRefNo" value="<?php echo $holiday_enquiry->uniqueRefNo?>">				
					<input type="hidden" name="invoice_number" value="<?php echo $holiday_enquiry->invoice_number?>">				
					<input type="hidden" name="user_id" value="<?php echo $holiday_enquiry->user_id?>">				
					<input type="hidden" name="agent_id" value="<?php echo $holiday_enquiry->agent_id?>">				
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">Package Name<span style="color:red;">*</span></label>
						<div class="col-sm-6">
							<input class="form-control" id="focusedInput" type="text" name="package_title" value="<?php echo $holiday_enquiry->package_title?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">Package Validity<span style="color:red;">*</span></label>
						<div class="col-sm-6">
							<input class="form-control" id="focusedInput" type="text" name="package_validity" value="<?php echo $holiday_enquiry->package_validity?>"  required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">User Comment<span style="color:red;">*</span></label>
						<div class="col-sm-6">
							<input class="form-control" id="focusedInput" type="text" name="comments" value="<?php echo $holiday_enquiry->comments?>"  required>
						</div>
					</div>
					<div class="form-group warning">
						<label class="col-sm-3 control-label" for="focusedInput">Title</label>
						<div class="col-sm-6">
							<select name="title" id="used_type" class="form-control" required>
							<option value="Mr">Mr</option>
							<option value="Mrs">Mrs</option>
							<option value="Ms">Ms</option>
						</select>
						</div>
					</div>						
					<div class="form-group warning">
						<label class="col-sm-3 control-label" for="focusedInput">First Name</label>
						<div class="col-sm-6">
							<input class="form-control" id="focusedInput" type="text" name="fname" value="<?php echo $holiday_enquiry->fname?>">
						</div>
					</div>
					<div class="form-group warning">
						<label class="col-sm-3 control-label" for="focusedInput">Middle Name</label>
						<div class="col-sm-6">
							<input class="form-control" id="focusedInput" type="text" name="mname" value="<?php echo $holiday_enquiry->middle_name?>">
						</div>
					</div>
					<div class="form-group warning">
						<label class="col-sm-3 control-label" for="focusedInput">Last Name</label>
						<div class="col-sm-6">
							<input class="form-control" id="focusedInput" type="text" name="lname" value="<?php if( isset($holiday_enquiry->lname)) echo $holiday_enquiry->lname;  ?>">
						</div>
					</div>	
					<div class="form-group warning">
						<label class="col-sm-3 control-label" for="focusedInput">Adults No</label>
						<div class="col-sm-6">
							<input class="form-control" id="focusedInput" type="text" name="Adults" value="<?php if( isset($holiday_enquiry->Adults)) echo $holiday_enquiry->Adults;  ?>">
						</div>
					</div>	
					<div class="form-group warning">
						<label class="col-sm-3 control-label" for="focusedInput">Child No</label>
						<div class="col-sm-6">
							<input class="form-control" id="focusedInput" type="text" name="Child" value="<?php if( isset($holiday_enquiry->Child)) echo $holiday_enquiry->Child;  ?>">
						</div>
					</div>	
					<div class="form-group warning">
						<label class="col-sm-3 control-label" for="focusedInput">Infant No</label>
						<div class="col-sm-6">
							<input class="form-control" id="focusedInput" type="text" name="Infant" value="<?php if( isset($holiday_enquiry->Infant)) echo $holiday_enquiry->Infant;  ?>">
						</div>
					</div>	
					<div class="form-group warning">
						<label class="col-sm-3 control-label" for="focusedInput">Address</label>
						<div class="col-sm-6">
							 <textarea rows="2" cols="45" class="form-control" name="address" required><?php if( isset($holiday_enquiry->address1)) echo $holiday_enquiry->address1;  ?></textarea> 
						</div>
					</div>					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">Phone<span style="color:red;">*</span></label>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="phone" value="<?php echo $holiday_enquiry->phone?>" required>
						</div>
					</div>
												
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">Email<span style="color:red;">*</span></label>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="email" value="<?php echo $holiday_enquiry->email?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">City<span style="color:red;">*</span></label>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="city" value="<?php if( isset($holiday_enquiry->city)) echo $holiday_enquiry->city; ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">State<span style="color:red;">*</span></label>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="state" value="<?php if( isset($holiday_enquiry->state)) echo $holiday_enquiry->state; ?>" required>
						</div>
					</div>	
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">Country<span style="color:red;">*</span></label>
						<div class="col-sm-6">
							<select class="form-control" id="country" name="country" required>
                              <option value="">Select Your Country</option>
                              <optgroup label="Country List">
                                 <?php
                                    for($i=0;$i<count($country_list);$i++) {?>
                                 <option value="<?php echo $country_list[$i]->name; ?>"><?php echo $country_list[$i]->name; ?></option>
                                 <?php }	?>										
                              </optgroup>
                           </select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">Pin Code<span style="color:red;">*</span></label>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="pincode" value="<?php if( isset($holiday_enquiry->pincode)) echo $holiday_enquiry->pincode; ?>" required>
						</div>
					</div>	
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">Arrival date<span style="color:red;">*</span></label>
						<div class="col-sm-6">
							 <input class="form-control" type="text" id="dph1" name="arrivaledate" autocomplete= "off"  required />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">Departure date<span style="color:red;">*</span></label>
						<div class="col-sm-6">
							 <input class="form-control" type="text" id="dph2" name="departuredate" autocomplete= "off"  required />
						</div>
					</div>							
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">Price</label>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="price" value="<?php echo $holiday_enquiry->price?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">Tax</label>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="tax" value="<?php if( isset($holiday_enquiry->tax)) echo $holiday_enquiry->tax; ?>">
						</div>
					</div>
					<div class="form-group warning">
	                  <label class="col-sm-3 control-label" for="focusedInput">Received Amount</label>
	                <div class="col-sm-6">
	                  <input class="form-control" id="focusedInput" type="text" name="received_amount" value="">
	                </div>
	              </div>       
	              <div class="form-group">
	                <label class="col-sm-3 control-label" for="focusedInput">Balance Amount</label>           
	                <div class="col-sm-6 ">
	                  <input class="form-control" id="focusedInput" type="text" name="balance_amount"  required>
	                </div>
	              </div>   
	               <div class="form-group">
	                <label class="col-sm-3 control-label" for="focusedInput">Pending</label>           
	                <div class="col-sm-6 ">
	                  <input class="form-control" id="focusedInput" type="text" name="pending"  required>
	                </div>
	              </div>           
					<label class="col-sm-3 control-label"></label>
					<div class="col-sm-6 form-actions">
						<!-- <input type="submit" name="submit" class="btn btn-primary" value="Create Coupon"/> -->
						<button type="submit" class="btn btn-primary">Approve pre booking</button>
						<a href="<?php echo site_url(); ?>/holiday/holiday_pre_booking_report" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Go Back</a>
					</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
</div><!-- panel -->
</div><!-- panel Defualt-->
</div><!-- col-md-6 -->
</div>
</div><!-- contentpanel -->
<!-- end of content -->
</div>
<?php echo $this->load->view('footer'); ?>
<script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/custom.js"></script>
<script src="<?php echo base_url(); ?>public/js/admin/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>public/js/daterange/moment.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/daterange/daterangepicker.js"></script>


<script type="text/javascript">
$('#used_type').on('change', function(){
	// alert('hii');
if($(this).val() == 'Multiple'){
$('#multi_data').show();
}
else if($(this).val() == 'Single'){
$('#multi_data').hide();
} 
});
</script>

<script type="text/javascript">
$('#dph1').daterangepicker({
singleDatePicker: true,
autoUpdateInput:false,
locale: {
format: 'YYYY-MM-DD'
}
});
$('#dph1').on('apply.daterangepicker', function(ev, picker) {
$('#dph1').val(picker.startDate.format('YYYY-MM-DD'));
});
</script>

<script type="text/javascript">
$('#dph2').daterangepicker({
singleDatePicker: true,
autoUpdateInput:false,
locale: {
format: 'YYYY-MM-DD'
}
});
$('#dph2').on('apply.daterangepicker', function(ev, picker) {
$('#dph2').val(picker.startDate.format('YYYY-MM-DD'));
});
</script>