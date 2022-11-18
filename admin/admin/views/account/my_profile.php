<?php $this->load->view('header'); ?>
 <?php  $this->load->view('left_panel'); ?>
 <div class="mainpanel">
  <?php  $this->load->view('top_panel'); ?>


      <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>My Profile</h3>
              </div>
            </div>

            <div class="clearfix"></div>
     <div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>My Profile</small></h2>
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
        
     
          <form id="basicForm" action="<?php echo site_url();?>/home/update_profile" method="post" class="form-horizontal">
          <div class="panel panel-default">
              <div class="panel-body">
			  <div class="box-content">

                        <?php 

						if($status == '0')

						{

							?>

                        <div class="alert alert-block alert-success">

							  <a href="#" data-dismiss="alert" class="close">×</a>

							  <h4 class="alert-heading">Success!</h4>

							  Your Details Successfully Updated.

							</div>

                            <?php 

						}

						elseif($status == '1')

						{

							?><div class="alert alert-block alert-danger">

							  <a href="#" data-dismiss="alert" class="close">×</a>

							  <h4 class="alert-heading">Failure!</h4>

							   Your Profile Not Updated. Please provide correct information

							</div>

                         <?php

						}

						?>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Email-Id <span class="asterisk">*</span></label>
                  <div class="col-sm-6">
                   <input type="text" class="form-control" value="<?php echo $admin_info->login_email;?>" name="login_email" readonly class="uneditable-input" />

					 <p class="help-block">Login Email-Id / UserName</p>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label">Password <span class="asterisk">*</span></label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" value="******"  readonly class="uneditable-input" />
					<br/>
                      <a href="<?php echo site_url();?>/home/change_password" class="btn-danger btn" style="top: 1px;
position: relative;">New password</a>

					<p class="help-block">The password is hidden for security!</p>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label">Title <span class="asterisk">*</span></label>
                  <div class="col-sm-6">
                    <select id="select" name="title" class="form-control">

												<option value="Mr" <?php if($admin_info->title =='Mr') echo 'selected';?>>Mr.</option>

                                                <option value="Mrs" <?php if($admin_info->title =='Mrs') echo 'selected';?>>Mrs.</option>

                                                <option value="Dr" <?php if($admin_info->title =='Dr') echo 'selected';?>>Dr.</option>

											</select>
					
                  </div>
                </div>
				
                
                                      <div class="form-group">

											<label for="date" class="col-sm-3 control-label">First Name</label>

											<div class="controls">

												<div class="col-sm-6">

													<input  class="form-control" type="text"  id="first_name" value="<?php echo $admin_info->first_name;?>" name="first_name"  required/><span class="add-on"><i class="icon-user"></i></span>

												</div>

											</div>

										</div>

                                        <div class="form-group">

											<label for="date" class="col-sm-3 control-label">Middle Name</label>

											<div class="controls">

												<div class="col-sm-6">

													<input  class="form-control" type="text" id="middle_name" value="<?php echo $admin_info->middle_name;?>" name="middle_name" /><span class="add-on"><i class="icon-user"></i></span>                                                    

												</div>

                                                 <p class="help-block">(Middle Name Optional)</p>

											</div>                                           

										</div>

                                        <div class="form-group">

											<label for="date" class="col-sm-3 control-label">Last Name</label>

											<div class="controls">

												<div class="col-sm-6">

													<input  class="form-control" type="text" id="last_name" value="<?php echo $admin_info->last_name;?>" name="last_name" required /><span class="add-on"><i class="icon-user"></i></span>

												</div>

											</div>

										</div>

                                        <div class="form-group">

											<label for="date" class="col-sm-3 control-label">Mobile No</label>

											<div class="controls">

												<div class="col-sm-6">

													<input  class="form-control" type="text" name="mobile_no" id="mobile_no" value="<?php echo $admin_info->mobile_no; ?>" required /><span class="add-on"><i class="icon-home"></i></span>

												</div>

											</div>

										</div>

                                        

                                        <div class="form-group">

											<label for="date" class="col-sm-3 control-label">Address</label>

											<div class="controls">

												<div class="col-sm-6">													

                                                    <textarea class="form-control" rows="2" cols="45"  id="address" name="address" required><?php echo $admin_info->address; ?></textarea>                                                   

												</div>

											</div>

										</div>

                                        

                                        <div class="form-group">

											<label for="date" class="col-sm-3 control-label">Postal Code</label>

											<div class="controls">

												<div class="col-sm-6">

													<input  class="form-control" type="text" name="pin_code" id="pin_code" value="<?php echo $admin_info->pin_code; ?>" required />

												</div>

											</div>

										</div>

                                        <div class="form-group">

											<label for="date" class="col-sm-3 control-label">City</label>

											<div class="controls">

												<div class="col-sm-6">

													<input  class="form-control" type="text" name="city" id="city" value="<?php echo $admin_info->city; ?>" required />

												</div>

											</div>

										</div>

                                         <div class="form-group">

											<label for="date" class="col-sm-3 control-label">State</label>

											<div class="controls">

												<div class="col-sm-6">

													<input  class="form-control" type="text" name="state" id="state" value="<?php echo $admin_info->state; ?>" required />

												</div>

											</div>

										</div>

										

								

								

							</div>

							
					<div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button class="btn btn-primary" value="Update">Update</button>
                           <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                      </div>
	            
          </div><!-- panel -->
          </form>
          
          
        </div>

      </div>
    </div>
	
	</div>
 
</div>
</div>
</div>

 <?php  $this->load->view('footer'); ?>