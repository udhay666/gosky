<?php $this->load->view('header'); ?>
 <?php  $this->load->view('left_panel'); ?>
 <!-- <div class="mainpanel">-->
  <?php  $this->load->view('top_panel'); ?>


<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Create B2C User</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
			

							<form  id="basicForm" class="form-horizontal" action="<?php echo site_url(); ?>/b2c/create_user" enctype="multipart/form-data" method="post">

							<fieldset>

                            

                           <?php if(validation_errors() != ""){ ?>

                                <div class="alert alert-error">

                                    <button class="close" data-dismiss="alert" type="button">×</button>

                                    <?php echo validation_errors();?>

                                </div>

                            <?php } ?>

                                                       

                            <?php

							  	if($status == '1')

								{

								?>

								<div class="alert alert-success">

								<button class="close" data-dismiss="alert" type="button">×</button>

									<strong>Success!</strong>

									User Registration Successfully Created.

								</div>

								<?php 

								}

								else if($status == '2')

								{

								?>

                                <div class="alert alert-error">

								<button class="close" data-dismiss="alert" type="button">×</button>

									<strong>Error!</strong>

									User Registration Not Done. Please try after some time...

								</div>

								 <?php

								}

								?>

                               

                                <?php

							  	if(!empty($errors))

								{

								?>

								<div class="alert alert-error">

								<button class="close" data-dismiss="alert" type="button">×</button>

									<strong>Error!</strong>

									 <?php echo $errors;?>

								</div>

								<?php 

								}

								?>

                                

                                <legend>Login Information</legend>

                                

                              <div class="form-group warning">

								<label class="col-sm-3  control-label" for="focusedInput">Email-Id</label>

								<div class="col-sm-6">

								  <input class="form-control" id="focusedInput" type="email" name="user_email" value="<?php if( isset($user_email)) echo $user_email; ?>" required>

                                   <span class="help-inline">Login Email-Id / UserName</span>

                                  

								</div>

                                

							  </div>

                           

                              <div class="form-group">

								<label class="col-sm-3 control-label" for="disabledInput">Password</label>

								<div class="col-sm-6">

								  <input class="form-control" id="user_password" type="password" name="user_password" required>              

                                                      

								</div>

							  </div>                              

                                                          

                             <div class="form-group">

								<label class="col-sm-3 control-label" for="focusedInput">Confirm Password</label>



								<div class="col-sm-6">

								  <input class="form-control" id="focusedInput" type="password" name="passconf"  required>              

                                  <span class="help-inline">(Must be same with 'Password')</span>                     

								</div>

							  </div>

                                

                                <legend>User Information</legend>

                                

                              <div class="form-group warning">

								<label class="col-sm-3 control-label" for="focusedInput">User Number</label>

								<div class="col-sm-6">

                                <div class="input-append">

								  <input class="input-xlarge disabled" id="disabledInput" type="text" placeholder="SKPLXXXX format" disabled="">								 

                                   <span class="help-inline">(Automatically User No will be generated, Ex:- SKPL1234)</span>

								</div>

                                </div>

							  </div>

                                                                                      

                              <!--<div class="form-group">

								<label class="col-sm-3 control-label">User Profile Logo</label>

								<div class="col-sm-6">

									<div id="uniform-undefined" class="uploader">

										<input type="file" name="user_logo" size="19" style="opacity: 0;" required>

									<span class="filename" style="-moz-user-select: none;"></span>

									<span class="action" style="-moz-user-select: none;">Choose File</span>

									</div>

								</div>

							 </div>   -->

                                                       

							<legend>Personal Information</legend>

                            

							  <div class="form-group">

								<label class="col-sm-3 control-label" for="selectError3">Title</label>

								<div class="col-sm-6">

								  <select id="selectError3" name="title" required class="form-control">

									<option value="Mr">Mr.</option>

									<option value="Mrs">Mrs.</option>

									<option value="Dr">Dr.</option>

								 </select>

								</div>

							  </div>

                              

                              <div class="form-group">

								<label class="col-sm-3 control-label" for="focusedInput">First Name</label>



								<div class="col-sm-6">

								  <input class="form-control" id="focusedInput" type="text" name="first_name" value="<?php if( isset($first_name)) echo $first_name; ?>" required>                                   

								</div>

							  </div>

                              

                              <div class="form-group warning">

								<label class="col-sm-3 control-label" for="focusedInput">Middle Name</label>

								<div class="col-sm-6">

								  <input class="form-control" id="focusedInput" type="text" name="middle_name" value="<?php if( isset($middle_name)) echo $middle_name; ?>" />

                                   <span class="help-inline">(Optional)</span>

								</div>

							  </div>

                              

                              <div class="form-group">

								<label class="col-sm-3 control-label" for="focusedInput">Last Name</label>

								<div class="col-sm-6">

								  <input class="form-control" id="focusedInput" type="text" name="last_name" value="<?php if( isset($last_name)) echo $last_name; ?>" required>                                   

								</div>

							  </div>

                              

                              <div class="form-group">

								<label class="col-sm-3 control-label" for="focusedInput">Mobile Number</label>

								<div class="col-sm-6">

								  <input class="form-control" id="focusedInput" type="number" name="mobile_no" value="<?php if( isset($mobile_no)) echo $mobile_no; ?>" required>                                   

								</div>

							  </div>

                                                            

                               <div class="form-group">

								<label class="col-sm-3 control-label" for="focusedInput">Address</label>

								<div class="col-sm-6">

								  <textarea class="form-control" id="focusedInput" type="text" name="address" required><?php if( isset($address)) echo $address; ?></textarea>                                   

								</div>

							  </div>

                              

                               <div class="form-group">

								<label class="col-sm-3 control-label" for="focusedInput">Pin Code</label>

								<div class="col-sm-6">

								  <input class="form-control" id="focusedInput" type="text" name="pin_code" value="<?php if( isset($pin_code)) echo $pin_code; ?>" required>                                   

								</div>

							  </div>

                              

                              <div class="form-group">

								<label class="col-sm-3 control-label" for="focusedInput">City</label>

								<div class="col-sm-6">

								  <input class="form-control" id="focusedInput" type="text" name="city" value="<?php if( isset($city)) echo $city; ?>" required>                                   

								</div>

							  </div>

                              

                               <div class="form-group">

								<label class="col-sm-3 control-label" for="focusedInput">State</label>

								<div class="col-sm-6">

								  <input class="form-control" id="focusedInput" type="text" name="state"  value="<?php if( isset($state)) echo $state; ?>" required>                                   

								</div>

							  </div>

                              

                              <div class="form-group">

								<label class="col-sm-3 control-label" for="selectError2">Country</label>

								<div class="col-sm-6">

									<select  id="country" name="country" class="form-control" required>

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

                             

							<!-- <div class="form-actions">

								<button type="submit" class="btn btn-primary">Create User</button>

								<a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>

							  </div>-->

                               <div class="ln_solid"></div>
							  <div class="item form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<button type="submit" class="btn btn-primary">Create User</button>

								<a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
								</div>
							  </div>

							</fieldset>

						  </form>

						</div>

					</div>

				</div>

			</div>
          </div><!-- panel -->
         </div><!-- panel Defualt-->
       

 <?php  $this->load->view('footer'); ?>
 <script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>


<script>
  jQuery(document).ready(function(){
    
    jQuery("a[rel^='prettyPhoto']").prettyPhoto();
    
    //Replaces data-rel attribute to rel.
    //We use data-rel because of w3c validation issue
    jQuery('a[data-rel]').each(function() {
        jQuery(this).attr('rel', jQuery(this).data('rel'));
    });
    
  });
</script>

<script src="<?php echo base_url(); ?>public/js/jquery.validate.min.js"></script>

<script src="<?php echo base_url(); ?>public/js/custom.js"></script>
<script>
jQuery(document).ready(function(){
  
  // Basic Form
  jQuery("#basicForm").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    }
  });
  
  // Error Message In One Container
  jQuery("#basicForm2").validate({
	 errorLabelContainer: jQuery("#basicForm2 div.error")
  });
  
  // With Checkboxes and Radio Buttons
  jQuery("#basicForm3").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    }
  });
  
  // Validation with select boxes
  jQuery("#basicForm4").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    }
  });
  
  
});
</script>






















