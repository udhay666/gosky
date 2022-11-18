<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">

<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">
<link href="<?php echo base_url();?>public/js/bootstrap-timepicker.min.css" rel="stylesheet">

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
				<li><a class="active" href="<?php echo site_url()?>room/edit_excursion/<?php echo $excursion_id?>">Edit Excursion</a></li>
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
			<h1 class="custom-font">Edit Excursion</h1>
			<ul class="controls">
				<li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
			</ul>
		</div>
		<div class="boxs-body">
			<div class="pagecontent">
				<div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
					<div class="tab-content2">
						<form action="<?php echo site_url()?>excursions/update_excursion" method="post" class="step_form step1" steps="1" name="step1" role="form" enctype="multipart/form-data">
							<div class="tab-pane active" id="step-1">
								<h5 style="font-weight: bold;">Select Basis of Excursion</h5>
								<div class="row border_row">
									<div class="form-group col-md-3 check_icon">                 
										<label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
											<input type="radio" class="flat excursion_type"   
											name="excursion_type" value="Private" <?php if($excursion_info->excursion_type=="Private"){ echo 'checked="checked"'; }?>  required="required">
											<i></i>Private
										</label>               
									</div>  
									<div class="form-group col-md-3 check_icon">                 
										<label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
											<input type="radio" class="flat excursion_type"   
											name="excursion_type" value="Sharing" <?php if($excursion_info->excursion_type=="Sharing"){ echo 'checked="checked"'; }?> required="required">
											<i></i> Sharing
										</label>               
									</div>
									<div class="form-group col-md-6"></div>
								</div>
								<div class="row border_row">
									<div class="form-group col-md-8">
										<label class="strong" for="excursion_name">Excursion Name:</label>
										<input name="excursion_name" id="excursion_name" value="<?php echo $excursion_info->excursion_name; ?>" type="text" class="form-control" required="required">
										<input type="hidden" name="id" value="<?php echo $excursion_info->excursion_id; ?>">
									</div>
									<div class="form-group col-md-4">
										<label class="strong" for="	excursion_category">Excursion Category:</label>										
										<select name="excursion_category" class="form-control select2" id="excursion_category" required="required">
											<option value="">Select Category</option>
											<?php foreach($categories as $val){?>
											<option value="<?php echo $val->category_id; ?>" <?php if($excursion_info->excursion_category==$val->category_id){ echo "selected"; }?>><?php echo $val->category; ?></option>
											<?php } ?>
										</select>
									</div>											
								</div>
								<div class="row border_row">
									<div class="form-group col-md-3">
										<label class="strong">Rating : </label>
										<select name="star_rating" class="form-control select2" required>
											<option value="">Select Rating</option>
											<?php for($i=1;$i<=5;$i++){ ?>
											<option value="<?php echo $i;?>" <?php if($i==$excursion_info->star_rating){ echo 'selected'; } ?>><?php echo $i;?></option>
											<?php } ?>                  
										</select>
									</div>
									<div class="form-group col-md-3">
										<label class="strong">Currency : </label>
										<select name="currency" class="form-control select2" required>
											<option value="">Select Currency</option>
											<?php for($i=0;$i<count($currency);$i++){ ?>
											<option value="<?php echo $currency[$i]->currency_code;?>" <?php if($currency[$i]->currency_code==$excursion_info->currency){ echo 'selected'; } ?>><?php echo $currency[$i]->currency_code;?></option>
											<?php } ?>                  
										</select>
									</div>

									<div class="form-group col-md-6">
										<label class="strong" for="cityName">City : </label>
										<input name="cityName" id="cityName"  type="text" value="<?php echo $excursion_info->cityName; ?>" class="form-control" required>         
										<input name="city" id="city"  type="hidden" value="<?php echo $excursion_info->city; ?>" class="form-control" required>
										<input name="country" id="country"  type="hidden" value="<?php echo $excursion_info->country; ?>"  class="form-control" required>
										<input name="cityid" id="cityid"  type="hidden" value="<?php echo $excursion_info->cityid; ?>" class="form-control" required>
									</div>										
								</div>
								 <div id="add_agerange_group">
						            <div class="row  border_row agerange_row">
							             <div class="form-group col-md-3">
							             <label class="strong">Select Children Age Range & Enter Height</label></div>
							            <div class="form-group col-md-3">
							                <a href="#"  onclick="add_agerange(event);" class="btn btn-success btn-xs" data-original-title="Add Age Range & Height"><i class="fa fa-check"></i> Add Age Range <br/>& Height</a>
							            </div>
							                 <div class="form-group col-md-3">
							               <a href="#"  onclick="remove_agerange(event);" class="btn btn-danger btn-xs" data-original-title="Delete Age Range & Height"><i class="fa fa-times"></i> Delete Age Range <br/>& Height</a>
							            </div>
						              </div>
									<div class="row  border_row agerange_row">
										<div class="form-group col-md-3">
											<label class="strong">Children Min Age Limit : </label>
										</div>
										<div class="form-group col-md-3">
											<label class="strong">Children Max Age Limit : </label>
										</div> 
										<div class="form-group col-md-3">
										<label class="strong" for="childminheightlimit">Children Min Height Limit (cm) : </label> 
										</div> 
										<div class="form-group col-md-3">
											<label class="strong" for="childmaxheightlimit">Children Max Height Limit (cm) : </label> 
										</div>              
									</div>
									<?php $child_age_range_and_height=json_decode($excursion_info->child_age_range_and_height,true); 
									if(!empty($child_age_range_and_height[0])){
										foreach ($child_age_range_and_height as $key => $value) { 
											$val=explode('||', $value);
											$val1=explode('-', $val[0]);
											$val2=explode('-', $val[1]);


											?>
											<div class="row  border_row agerange_row">
												<div class="form-group col-md-3">             
													<select name="childageminlimit[]" class="form-control select2" required="true">
														<option value="">Select</option>
														<?php for($i=0;$i<=12;$i++){ ?>
														<option value="<?php echo $i; ?>" <?php if($val1[0]==$i){echo 'selected';}?>><?php echo $i; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="form-group col-md-3">
													<select name="childagemaxlimit[]" class="form-control select2" required="true">
														<option value="">Select</option>
														<?php for($i=1;$i<=12;$i++){ ?>
														<option value="<?php echo $i; ?>" <?php if($val1[1]==$i){echo 'selected';}?>><?php echo $i; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="form-group col-md-3">
													<input type="text" class="form-control" name="childminheightlimit[]" placeholder="Enter Height In Cm" value="<?php echo $val2[0];?>" required="true">			
												</div>
												<div class="form-group col-md-3">
													<input type="text" class="form-control" name="childmaxheightlimit[]" placeholder="Enter Height In Cm" value="<?php echo $val2[1];?>" required="true">			
												</div>
											</div>  
											<?php } } else { ?> 
											<div class="row  border_row agerange_row">
												<div class="form-group col-md-3">             
													<select name="childageminlimit[]" class="form-control select2" required="true">
														<option value="">Select</option>
														<?php for($i=0;$i<=12;$i++){ ?>
														<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="form-group col-md-3">
													<select name="childagemaxlimit[]" class="form-control select2" required="true">
														<option value="">Select</option>
														<?php for($i=1;$i<=12;$i++){ ?>
														<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="form-group col-md-3">
													<input type="text" class="form-control" name="childminheightlimit[]" placeholder="Enter Height In Cm" required="true">			
												</div>
												<div class="form-group col-md-3">
													<input type="text" class="form-control" name="childmaxheightlimit[]" placeholder="Enter Height In Cm" required="true">			
												</div>
											</div>  
											<?php } ?>       
										</div>

										<div class="row border_row">
											<div class="form-group col-md-3">
												<label class="strong" for="maxperson">Max Persons : </label>
												<input name="maxperson" id="maxperson"  type="number" class="form-control" min="1" step="1"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  value="<?php echo $excursion_info->maxperson; ?>" title="Numbers only" required>
											</div>
											<div class="form-group col-md-3">
												<label class="strong" for="no_of_booking">No of Booking : </label>
												<input name="no_of_booking"  min="1"  step="1"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' title="Numbers only" id="no_of_booking"  type="number" class="form-control" value="<?php echo $excursion_info->no_of_booking; ?>" required>
											</div>
										</div>   
										<div class="row border_row">
											<div class="form-group col-md-6">
												<label class="strong">Res. Dep. E-Mail : </label>
												<textarea name="email" class="form-control" rows="3" required><?php echo $excursion_info->email; ?></textarea>
											</div>
											<div class="form-group col-md-6">
												<label class="strong">Address: </label>
												<textarea name="address" class="form-control" rows="3" required><?php echo $excursion_info->address; ?></textarea>
											</div>
										</div>
										<div class="row border_row">
											<div class="form-group col-md-6">
												<label class="strong">Place Near By : </label>
												<textarea name="nearby" class="form-control" rows="3" required><?php echo $excursion_info->nearby; ?></textarea>
											</div>
											<div class="form-group col-md-6">
												<label class="strong">Contact No: </label>
												<textarea name="contact_no" class="form-control" rows="3" required><?php echo $excursion_info->contact_no; ?></textarea>
											</div>
										</div>

										<div class="row border_row">
											<div class="form-group col-md-12">
												<label class="strong" for="overview">Overview:</label>
												<textarea name="overview" class="form-control" data-parsley-required="true" data-parsley-required-message="This field is required" rows="3" id="overview" required="required"><?php echo $excursion_info->overview; ?></textarea>
											</div>
										</div>
										<div class="row border_row">
											<div class="form-group col-md-12">
												<label class="strong" for="highlight">Highlights:</label>
												<textarea name="highlight" class="form-control" data-parsley-required="true" data-parsley-required-message="This field is required" rows="3" id="highlight" required="required"><?php echo $excursion_info->highlight; ?></textarea>
											</div>
										</div>
										<div class="row border_row">
											<div class="form-group col-md-6">
												<label class="strong" for="inclusions">Inclusions:</label>
												<textarea name="inclusions" class="form-control" data-parsley-required="true" data-parsley-required-message="This field is required" rows="2" id="inclusions" required="required"><?php echo $excursion_info->inclusions; ?></textarea>
											</div>
											
											<div class="form-group col-md-6">
												<label class="strong" for="exclusions">Exclusions:</label>
												<textarea name="exclusions" class="form-control" rows="2" id="exclusions" data-parsley-required="true" data-parsley-required-message="This field is required" required="required"><?php echo $excursion_info->exclusions; ?></textarea>
											</div>
										</div>

										<div class="row border_row">
											<div class="form-group col-md-12">
												<label class="strong" for="important_info">Important & Voucher info:</label>
												<textarea name="important_info" class="form-control" rows="2" id="important_info" required="required" data-parsley-required="true" data-parsley-required-message="This field is required"><?php echo $excursion_info->important_info; ?></textarea>
											</div>
										</div>

										<div class="row border_row">
											<div class="form-group col-md-12">
												<label class="strong" for="additional_info">Additional info:</label>
												<textarea name="additional_info" class="form-control" rows="5" id="additional_info" required="required" data-parsley-required="true" data-parsley-required-message="This field is required"><?php echo $excursion_info->additional_info; ?></textarea>
											</div>
										</div>
										
										<div class="row border_row">
											<div class="form-group col-md-12">
												<label class="strong" for="cancellation_policy">Cancellation Policy:</label>
												<textarea name="cancellation_policy" class="form-control" rows="5" id="cancellation_policy" required="required" data-parsley-required="true" data-parsley-required-message="This field is required"><?php echo $excursion_info->cancellation_policy; ?></textarea>
											</div>
										</div>

										<div class="row border_row">
											<div class="form-group col-md-12">
												<label class="strong" for="schedule">Schedule :</label>
												<textarea name="schedule" class="form-control" rows="5"  data-parsley-required="true" data-parsley-required-message="This field is required" id="schedule" required="required"><?php echo $excursion_info->schedule; ?></textarea>
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

<script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/wysihtml5-0.3.0.min.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/adapters/jquery.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap-timepicker.min.js"></script>
<!--  Custom JavaScripts  --> 
<script src="<?php echo base_url(); ?>public/js/main.js"></script>

<script>
$(document).ready(function() {
	$(".select2").select2({  
	});
});
</script>

<script type="text/javascript">
$('.todo').on('click', function(){
	var data = $(this).val();
	$('#todo').val(data);
	var form = $('form');
	var deciNum= /^[0-9]+(\.\d{1,3})?$/;
	$child_type=$(".child_type:checked").val();  
	if($child_type=="AGE")
	{
		if($("select[name='childageminlimit']").val()==''){
			alert("Select Children Min Age Limit");      
			$("select[name='childageminlimit']").focus();
			return false;
		}
		if($("select[name='childagemaxlimit']").val()==''){
			alert("Select Children Max Age Limit");      
			$("select[name='childagemaxlimit']").focus();
			return false;
		}
		else if(parseInt($("select[name='childageminlimit']").val())>parseInt($("select[name='childagemaxlimit']").val())){
			alert("Children Min Age Should be Less than  Children Max Age");         
			$("select[name='childageminlimit']").focus();
			return false;
		}
	}
	else if($child_type=="HEIGHT")
	{
		if($("input[name='childheightlimit']").val()==''){
			alert("Enter Children Height Limit");
			$("input[name='childheightlimit']").val('');
			$("input[name='childheightlimit']").focus();
			return false;
		}
		else if(!deciNum.test($("input[name='childheightlimit']").val())){
			alert("Enter Either Numberic  or Decimal Value For Children Height Limit");
			$("input[name='childheightlimit']").val('');
			$("input[name='childheightlimit']").focus();
			return false;
		}
	}
	form.parsley().validate();
	if (!form.parsley().isValid()) {
		return false;
	}
});
</script>

<!-- Required for images upload -->
<script type="text/javascript">
if (window.File && window.FileList && window.FileReader) {
	$(".imageupload").on('change', function () {
		var countFiles = $(this)[0].files.length;
		var imgPath = $(this)[0].value;
		var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
		var image_holder = $(this).parent().parent().find(".preview-image");
		image_holder.empty();

		var files = !!this.files ? this.files : [];
if (!files.length || !window.FileReader) return false; // no file selected, or no FileReader support

if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
if (typeof (FileReader) != "undefined") {
	
	for (var i = 0; i < countFiles; i++) {
		
		var reader = new FileReader();
		reader.onload = function (e) {
			var file = e.target;
			$("<img />", { "src": e.target.result, "class": "thumbimage" }).appendTo(image_holder);
		}
		
		image_holder.show();
		reader.readAsDataURL($(this)[0].files[i]);
	}
	
} else {
	alert("It doesn't supports");
}
} else {
alert("Select Only images");
}
});
} else {
	alert("Your browser doesn't support to File API")
}
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
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css">
<script src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$("#cityName").autocomplete({
		source: "<?php echo site_url(); ?>hotel/citylist/",
		minLength: 2,
		autoFocus: true,
		select: function( event, ui ) {
			$("input[name='cityid']").val(''); 
			$("input[name='city']").val(''); 
			$("input[name='country']").val('');     
			$("input[name='cityid']").val(ui.item.id);  
			$("input[name='city']").val(ui.item.city_name);
			$("input[name='country']").val(ui.item.country_name);        
		}
	});
});

</script>
<script type="text/javascript">
CKEDITOR.replace('overview');
CKEDITOR.replace('highlight');
CKEDITOR.replace('inclusions');
CKEDITOR.replace('exclusions');
CKEDITOR.replace('important_info');
CKEDITOR.replace('additional_info'); 
CKEDITOR.replace('schedule');
CKEDITOR.replace('cancellation_policy');
CKEDITOR.config = {
	autoUpdateElement: true,
}

CKEDITOR.on('instanceReady', function(){
	$.each( CKEDITOR.instances, function(instance) {
		CKEDITOR.instances[instance].on("change", function(e) {
			for ( instance in CKEDITOR.instances )
				CKEDITOR.instances[instance].updateElement();
		});
	});
});
</script>

<script type="text/javascript">
$(document).ready( function() {
	$(".child_type").change(function()
	{
		if($(this).val()=='AGE'){     
			$("select[name='childageminlimit']").val('').change();
			$("select[name='childageminlimit']").prop('disabled',false);  
			$("select[name='childagemaxlimit']").val('').change(); 
			$("select[name='childagemaxlimit']").prop('disabled',false);
			$("input[name='childheightlimit']").val('');      
			$("input[name='childheightlimit']").prop('disabled',true);
		} 
		else if($(this).val()=='HEIGHT'){    
			$("select[name='childageminlimit']").val('').change();  
			$("select[name='childageminlimit']").prop('disabled',true); 
			$("select[name='childagemaxlimit']").val('').change(); 
			$("select[name='childagemaxlimit']").prop('disabled',true);      
			$("input[name='childheightlimit']").val('');  
			$("input[name='childheightlimit']").prop('disabled',false);      
		} 
	});
});  

</script>
<?php if($excursion_info->child_type=='HEIGHT'){?> 
<script type="text/javascript">
$("select[name='childageminlimit']").val('').change();  
$("select[name='childageminlimit']").prop('disabled',true); 
$("select[name='childagemaxlimit']").val('').change(); 
$("select[name='childagemaxlimit']").prop('disabled',true);     
</script>
<?php } else if($excursion_info->child_type=='AGE'){    ?>
<script type="text/javascript">     
$("input[name='childheightlimit']").val('');      
$("input[name='childheightlimit']").prop('disabled',true);
</script>  
<?php    } else{ ?>
<script type="text/javascript">     
$("input[name='childheightlimit']").val('');      
$("input[name='childheightlimit']").prop('disabled',true);
</script> 
<?php } ?>

<script type="text/javascript">
  function add_agerange(e) {
    e.preventDefault();
    if($('#add_agerange_group').find('.agerange_row').length < 5) {
       $.ajax({
                    url: '<?php echo site_url()?>excursions/addagerange',
                    data: '',
                    dataType: 'json',
                    type: 'POST',                   
                    success: function(data)
                    {      
                      $('#add_agerange_group').append(data.result);                                             
                    }
               });  
    
    }
    return false;
  }
  
  function remove_agerange(e) {   
    e.preventDefault();
    if($('#add_agerange_group').find('.agerange_row').length > 3) {
      $('#add_agerange_group').find('.agerange_row:last').remove();
    }
    return false;
  }
</script>