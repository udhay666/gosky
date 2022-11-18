<?php $this->load->view('header'); ?>
<?php  $this->load->view('left_panel'); ?>
<?php  $this->load->view('top_panel'); ?>
    <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Create New Agent</h3>
              </div>
            </div>

       <div class="clearfix"></div>     
     <div class="row">	
       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create Agent</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br/>
					<form action="<?php echo site_url(); ?>/b2b/create_agent" method="post"  enctype="multipart/form-data"  class="form-horizontal form-label-left" novalidate>

                          <?php if(validation_errors() != '') {?>                              

                              <div class="alert alert-block alert-danger">

							  <a href="#" data-dismiss="alert" class="close">×</a>

							  <h4 class="alert-heading">Errors!</h4>

							  <?php echo validation_errors(); ?>  

							</div>

                          <?php } ?>

                          

                          <?php

							  	if($status == '1')

								{

								?>

								<div class="alert alert-block alert-success">

								 <a href="#" data-dismiss="alert" class="close">×</a>									

                                    <h4 class="alert-heading">Success!</h4>

									Agent Created Successfully.

								</div>

								<?php 

								}

								else if($status == '2')

								{

								?>                            

                                 <div class="alert alert-block alert-danger">

                                      <a href="#" data-dismiss="alert" class="close">×</a>

                                      <h4 class="alert-heading">Error!</h4>

                                      Agent Registration Not Done. Please try after some time...

								  </div>

								 <?php

								}

								?>

                               

                                <?php

							  	if(!empty($errors))

								{

								?>								

                                 <div class="alert alert-block alert-danger">

                                      <a href="#" data-dismiss="alert" class="close">×</a>

                                      <h4 class="alert-heading">Error!</h4>

                                       <?php echo $errors;?>

								  </div>

								<?php 

								}

								?>                         

                          

                            	<legend>Login Information</legend>

								<div class="item form-group">

									<label for="req" class="control-label col-md-3 col-sm-3 col-xs-12">Email-Id</label>								

                                    <div class="col-md-6 col-sm-6 col-xs-12">

								  <input class="form-control col-md-7 col-xs-12"  id="agent_email" type="email" name="agent_email" value="<?php if( isset($agent_email)) echo $agent_email; ?>" required>                                   

                                  <p class="help-block">Login Email-Id / UserName</p>

								</div>

								</div>

                                <div class="item form-group">

									<label for="pw3" class="control-label col-md-3 col-sm-3 col-xs-12">New Password</label>

									<div class="col-md-6 col-sm-6 col-xs-12">

										<input class="form-control col-md-7 col-xs-12" type="password" name="agent_password" id="agent_password" class="form-control col-md-7 col-xs-12"/>

									</div>

								</div>

								<div class="item form-group">

									<label for="pw4" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm password</label>

									<div class="col-md-6 col-sm-6 col-xs-12">

										<input class="form-control col-md-7 col-xs-12" type="password" name="passconf" id="passconf" class="form-control col-md-7 col-xs-12" equalTo="#agent_password" />

										<p class="help-block">Must match 'New Password'</p>

									</div>

								</div>

                               

                               <legend>Agency Information</legend>

                                

                                  <div class="item form-group">

									<label for="agentnumber" class="control-label col-md-3 col-sm-3 col-xs-12">Agent Number</label>

								<div class="col-md-6 col-sm-6 col-xs-12">                              

								  <input class="form-control col-md-7 col-xs-12" class="uneditable-input" type="text" placeholder="SKPLXXXX format" disabled="" />								                                  

                                <p class="help-block">(Automatically Agent No will be generated, Ex:- SKPL1234)</p>

                                </div>

							  </div>

                                <div class="item form-group">

									<label for="company" class="control-label col-md-3 col-sm-3 col-xs-12">Agency/Company Name</label>

									<div class="col-md-6 col-sm-6 col-xs-12">

										<input class="form-control col-md-7 col-xs-12" type="text" id="agency_name" class="required" name="agency_name" value="<?php if( isset($agency_name)) echo $agency_name; ?>" required />

									</div>

								</div>

								<div class="item form-group">

                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file2">Agency Logo</label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                        <div class="uploader" id="uniform-file2">

                                            <input  type="file" class="uniform" id="file2" name="agency_logo" size="19" style="opacitys: 0;" required="required" />

                                            <span class="filename" style="-moz-user-select: none;">No file selected</span>

                                            <span class="action" style="-moz-user-select: none;">Choose File</span>

                                        </div>

                                    </div>

                            	</div>

                                

								<div class="item form-group">

								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Currency">Currency</label>

								<div class="col-md-6 col-sm-6 col-xs-12">

									<select name="currency_type" class="form-control" required>

										<option value="">Select Currency</option>

										<optgroup label="Currency List">                                       

                                        <?php

											for($i=0;$i<count($currency_list);$i++) {?>

											<option value="<?php echo $currency_list[$i]->currency_code; ?>"><?php echo $currency_list[$i]->currency_code; ?>&nbsp;-&nbsp;<?php echo $currency_list[$i]->currency_name; ?></option>

										<?php }	?>										

										</optgroup>										

								  </select>

								</div>

							  </div>
							  <div class="form-group">
								<label class="col-sm-3 control-label" for="selectError2">Agent Type</label>
								<div class="col-sm-6">
									<select data-placeholder="Select Your Agent Type"  class="form-control" id="selectError2" data-rel="chosen" name="agent_type" required>
										<optgroup label="agent List">
											<option value="1" selected>B2b Agent</option>
											<option value="2">Corporate User</option>
										</optgroup>
									</select>
								</div>
							</div>
                              

                              <legend>Personal Information</legend>

                                

								 <div class="item form-group">

								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="selectError3">Title</label>

								<div class="col-md-6 col-sm-6 col-xs-12">

								  <select class="form-control" name="title" required>

									<option value="Mr">Mr.</option>

									<option value="Mrs">Mrs.</option>

									<option value="Dr">Dr.</option>

								 </select>

								</div>

							  </div>

                              

                              <div class="item form-group">

								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="focusedInput">First Name</label>



								<div class="col-md-6 col-sm-6 col-xs-12">

								  <input class="form-control col-md-7 col-xs-12" class="input-xlarge focused" id="first_name" type="text" name="first_name" value="<?php if( isset($first_name)) echo $first_name; ?>" required />                                   

								</div>

							  </div>

                              

                              <div class="item form-group">

								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="focusedInput">Middle Name</label>

								<div class="col-md-6 col-sm-6 col-xs-12">

								  <input class="form-control col-md-7 col-xs-12" id="middle_name" type="text" name="middle_name" value="<?php if( isset($middle_name)) echo $middle_name; ?>" />

                                   <p class="help-block">(Middle Name Optional)</p>

								</div>

                                

							  </div>

                              

                              <div class="item form-group">

								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="focusedInput">Last Name</label>

								<div class="col-md-6 col-sm-6 col-xs-12">

								  <input class="form-control col-md-7 col-xs-12" class="required" id="last_name" type="text" name="last_name" value="<?php if( isset($last_name)) echo $last_name; ?>" required>                                   

								</div>

							  </div>

                              

                              <div class="item form-group">

								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="focusedInput">Mobile Number</label>

								<div class="col-md-6 col-sm-6 col-xs-12">

								  <input class="form-control col-md-7 col-xs-12" class="required" id="mobile_no" type="number" name="mobile_no" value="<?php if( isset($mobile_no)) echo $mobile_no; ?>" required>                                   

								</div>

							  </div>

                              

                               <div class="item form-group">

								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="focusedInput">Office Number</label>

								<div class="col-md-6 col-sm-6 col-xs-12">

								  <input class="form-control col-md-7 col-xs-12" class="required" id="office_phone_no" type="number" name="office_phone_no" value="<?php if( isset($office_phone_no)) echo $office_phone_no; ?>" required>                                   

								</div>

							  </div>

                              

                            <div class="item form-group">

                                    <label for="pw5" class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">                                      

                                         <textarea rows="2" cols="45" class="form-control" id="address" name="address" required><?php if( isset($address)) echo $address; ?></textarea> 

                                    </div>

                             </div>                           

                          <div class="item form-group">

								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="focusedInput">Pin Code</label>

								<div class="col-md-6 col-sm-6 col-xs-12">

								  <input class="form-control col-md-7 col-xs-12" class="required" id="pin_code" type="text" name="pin_code" value="<?php if( isset($pin_code)) echo $pin_code; ?>" required>                                   

								</div>

							  </div>

                              

                              <div class="item form-group">

								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="focusedInput">City</label>

								<div class="col-md-6 col-sm-6 col-xs-12">

								  <input class="form-control col-md-7 col-xs-12" class="required" id="city" type="text" name="city" value="<?php if( isset($city)) echo $city; ?>" required>                                   

								</div>

							  </div>

                              

                               <div class="item form-group">

								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="focusedInput">State</label>

								<div class="col-md-6 col-sm-6 col-xs-12">

								  <input class="form-control col-md-7 col-xs-12" class="required" id="state" type="text" name="state"  value="<?php if( isset($state)) echo $state; ?>" required>                                   

								</div>

							  </div>

                              

                              <div class="item form-group">

								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="selectError2">Country</label>

								<div class="col-md-6 col-sm-6 col-xs-12">

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

                                  <!-- <div class="form-group">

								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="focusedInput">TAN Number</label>

								<div class="col-md-6 col-sm-6 col-xs-12">

								  <input class="form-control col-md-7 col-xs-12" class="required" id="city" type="text" name="tan_no" value="<?php if( isset($tan_no)) echo $tan_no; ?>" required>                                   

								</div>

							  </div> -->

                              

                               <div class="item form-group">

								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="focusedInput">PAN Number</label>

								<div class="col-md-6 col-sm-6 col-xs-12">

								  <input class="form-control col-md-7 col-xs-12" class="required" id="state" type="text" name="pan_no"  value="<?php if( isset($pan_no)) echo $pan_no; ?>" required>                                   

								</div>

							  </div>
								
							<div class="ln_solid"></div>
							  <div class="item form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<input  type="submit" class="btn btn-primary" value="Create Agent">
								</div>
							  </div>
						</form>
						</div>
					</div>	
				</div>	
			</div>	
		</div>	
</div>	

<?php  $this->load->view('footer');   ?>
