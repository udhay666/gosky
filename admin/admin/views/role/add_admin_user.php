<?php $this->load->view('header'); ?>
<?php  $this->load->view('left_panel'); ?>
<?php  $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Create Sub-Admin User</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">

        

       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create Sub-Admin User</small></h2>
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

	         <form id="basicForm" class="form-horizontal" action="<?php echo site_url(); ?>/role/add_admin_user" enctype="multipart/form-data" method="post">

							<fieldset>

                            

                           <?php if(validation_errors() != ""){ ?>

                                <div class="alert alert-error">

                                    <button class="close" data-dismiss="alert" type="button">×</button>

                                    <?php echo validation_errors();?>

                                </div>

                            <?php } ?>

                               

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

								<label class="col-sm-3 control-label" for="focusedInput">Email-Id</label>

								<div class="col-sm-6">

								  <input   class="form-control" id="focusedInput" type="email" name="admin_email" value="<?php if( isset($admin_email)) echo $admin_email; ?>" required>

                                   <span class="help-inline">Login Email-Id / UserName</span>

                                  

								</div>

                                

							  </div>

                           

                              <div class="form-group">

								<label class="col-sm-3 control-label" for="disabledInput">Password</label>

								<div class="col-sm-6">

								  <input  class="form-control"  id="focusedInput" type="password" name="admin_password" required>              

                                                      

								</div>

							  </div>                              

                                                          

                             <div class="form-group warning">

								<label class="col-sm-3 control-label" for="focusedInput">Confirm Password</label>



								<div class="col-sm-6">

								  <input  class="form-control"  id="focusedInput" type="password" name="passconf" required>              

                                  <span class="help-inline">(Must be same with 'Password')</span>                     

								</div>

							  </div>

                              

                               <div class="form-group">

								<label class="col-sm-3 control-label" for="selectError3">Admin User Level</label>

								<div class="col-sm-6">

								  <select id="selectError1" name="role_id" class="form-control" required>

                                  	<option value="2">Select User Level </option>

									<option value="2">Sub Admin</option>								

								 </select>

								</div>

							  </div>

                                                         

							<legend>Personal Information</legend>

                            

							  <div class="form-group">

                  <label class="col-sm-3  control-label">Title <span class="asterisk">*</span></label>

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

								  <input  class="form-control"  id="focusedInput" type="text" name="first_name" value="<?php if( isset($first_name)) echo $first_name; ?>" required>                                   

								</div>

							  </div>

                              

                              <div class="form-group warning">

								<label class="col-sm-3 control-label" for="focusedInput">Middle Name</label>

								<div class="col-sm-6">

								  <input  class="form-control"  id="focusedInput" type="text" name="middle_name" value="<?php if( isset($middle_name)) echo $middle_name; ?>" />

                                   <span class="help-inline">(Optional)</span>

								</div>

							  </div>

                              

                              <div class="form-group">

								<label class="col-sm-3 control-label" for="focusedInput">Last Name</label>

								<div class="col-sm-6">

								  <input  class="form-control"  id="focusedInput" type="text" name="last_name" value="<?php if( isset($last_name)) echo $last_name; ?>" required>                                   

								</div>

							  </div>

                              

                              <div class="form-group">

								<label class="col-sm-3 control-label" for="focusedInput">Mobile Number</label>

								<div class="col-sm-6">

								  <input  class="form-control"  id="focusedInput" type="number" name="mobile_no" value="<?php if( isset($mobile_no)) echo $mobile_no; ?>" required>                                   

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

								  <input  class="form-control"  id="focusedInput" type="text" name="pin_code" value="<?php if( isset($pin_code)) echo $pin_code; ?>" required>                                   

								</div>

							  </div>

                              

                              <div class="form-group">

								<label class="col-sm-3 control-label" for="focusedInput">City</label>

								<div class="col-sm-6">

								  <input  class="form-control"  id="focusedInput" type="text" name="city" value="<?php if( isset($city)) echo $city; ?>" required>                                   

								</div>

							  </div>

                              

                               <div class="form-group">

								<label class="col-sm-3 control-label" for="focusedInput">State</label>

								<div class="col-sm-6">

								  <input  class="form-control"  id="focusedInput" type="text" name="state"  value="<?php if( isset($state)) echo $state; ?>" required>                                   

								</div>

							  </div>

                              

                              <div class="form-group">

								<label class="col-sm-3 control-label" for="selectError2">Country</label>

								<div class="col-sm-6">

									<select class="form-control" data-placeholder="Select Your Country" id="selectError3" data-rel="chosen" name="country" required>

										<option value=""></option>

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

								<label class="col-sm-3 control-label" for="selectError2">Permission</label>

								<div class="col-sm-6"><br/>

									<?php   foreach ($admin_priviliges as $mod) { ?>
                                                 <input type="checkbox"  name="privilages[]" id="<?php echo 'mod'.$mod->privilege_id; ?>"  onClick="changeSubModulePrivilege('<?php echo 'mod'.$mod->privilege_id; ?>')"
                                                  value="<?php echo $mod->privilege_id; ?>"/> 
                                                 <?php echo '<span class="text text-danger"><b>'.$mod->privilege_name.'</b></span></br>';
                                                        
                                                 $submodule_privilages=$this->Role_Model->get_admin_submodule_privilages($mod->privilege_id);

                                                         foreach($submodule_privilages as $sub_privilages){ 
                                                         ?>
                                                       <span class="<?php echo 'submod'.$mod->privilege_id;?>"> &nbsp; &nbsp; &nbsp; &nbsp;<input type="checkbox" name="subprivilages[]"
                                                        value="<?php echo $sub_privilages->submodule_privilege_id ; ?>" 		 id="<?php echo 'submod'.$sub_privilages->submodule_privilege_id;  ?>" class='<?php echo 'mod'.$mod->privilege_id;?>' onClick= "changePrivilege('<?php echo 'mod'.$mod->privilege_id;?>');"/>
								<?php	echo '<small>'.$sub_privilages->submodule_privilege_name.'</small></br></span>';} } ?>

								</div>

							  </div>  

                             <div class="ln_solid"></div>
							  <div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								  <button type="submit" class="btn btn-primary">Add Sub Admin</button>
								<a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
								</div>
							  </div>
							 

                               

							</fieldset>

						  </form>

          </div>

         </div>

        </div>



      </div>

    </div>
</div>
<script type="text/javascript">
	function changePrivilege(mod)
	{
		if($('.'+mod+''+':checked').length>0){
    		$('#'+mod+'').prop('checked', true);			
		}
		else 
		{		
			$('#'+mod+'').prop('checked', false);			
		}
	}

	function changeSubModulePrivilege(mod)
	{

		if($('.'+mod+''+':checked').length==0){
    		$('.'+mod+'').prop('checked', true);
    		$('.sub'+mod+'').show();		
		}
		else if($('#'+mod+'').prop('checked')==false)
		{
			$('.'+mod+'').prop('checked', false);
			$('.sub'+mod+'').hide();
		}
		
	}
</script>
<?php  $this->load->view('footer'); ?>










































