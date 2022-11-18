<?php $this->load->view('header'); ?>
 <?php  $this->load->view('left_panel'); ?>
  <?php  $this->load->view('top_panel'); ?>

<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Change Password</h3>
              </div>
            </div>

            <div class="clearfix"></div>
	   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Change Password</small></h2>
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
		 <?php 

						if($status == '1')

						{

							?>

                        <div class="alert alert-block alert-success">

							  <a href="#" data-dismiss="alert" class="close">×</a>

							  <h4 class="alert-heading">Success!</h4>

							  Your Password Successfully Updated.

							</div>

                            <?php 

						}

						if($errors == '1')

						{

							?><div class="alert alert-block alert-danger">

							  <a href="#" data-dismiss="alert" class="close">×</a>

							  <h4 class="alert-heading">Failure!</h4>

							    Your Password not Updated. Please try after some time...

							</div>

                         <?php

						}

						else if($errors == '2')

						{

							?><div class="alert alert-block alert-danger">

							  <a href="#" data-dismiss="alert" class="close">×</a>

							  <h4 class="alert-heading">Failure!</h4>

							   Current Password is wrong. Please enter correct current password...

							</div>

                         <?php

						}

						?>

                        <?php if(validation_errors() != '') {?>                              

                              <div class="alert alert-block alert-danger">

							  <a href="#" data-dismiss="alert" class="close">×</a>

							  <h4 class="alert-heading">Errors!</h4>

							  <?php echo validation_errors(); ?>  

							</div>

                          <?php } ?> 
          <form id="basicForm" action="<?php echo site_url(); ?>/home/change_password" method="post" class="form-horizontal">
          <div class="panel panel-default">
             
              <div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Current Password <span class="asterisk">*</span></label>
                  <div class="col-sm-6">
                   <input type="text" id="req" class='form-control' name="cpassword" autocomplete="off" />
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label">
New Password
 <span class="asterisk">*</span></label>
                  <div class="col-sm-6">
                    <input type="password" name="password" class="form-control" id="pw3" placeholder="Type your Password..." required />
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label">Confirm password
</label>
                  <div class="col-sm-6">
                   <input type="password" name="passconf" id="pw4" class='form-control' equalTo="#pw3" autocomplete="off" required/>

					<p>Must match 'New Password'</p>
                  </div>
                </div>
				
                              </div>
							  
			  <!-- panel-body -->
					<div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button class="btn btn-primary">Submit</button>
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


 <?php  $this->load->view('footer'); ?>