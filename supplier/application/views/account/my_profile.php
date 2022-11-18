<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>My Profile <span></span></h2>
          <div class="page-bar  br-5">
            <div class="form-group">
              <a href="<?php echo site_url() ?>home/change_password" class="btn btn-success" type="button"><i class="fa fa-list m-right-xs"></i> Change Password</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="pagecontent">
      <div class="row">
        <div class="col-md-12">
          <section class="boxs">
            <div class="boxs-header dvd dvd-btm">
              <h1 class="custom-font"><!-- <strong>Advanced</strong> Table --></h1>
              <ul class="controls">
                <li> <a role="button" tabindex="0" class="boxs-refresh"> <i class="fa fa-refresh"></i> </a> </li>
                <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
                <!-- <li> <a role="button" tabindex="0" class="boxs-fullscreen"> <i class="fa fa-expand"></i> </a> </li> -->
              </ul>
            </div>
            <div class="boxs-body">
            	<?php
              //print_r($edit_accomodation);exit;
              $sess_msg = $this->session->flashdata('message');
              if(!empty($sess_msg)){
                $message = $sess_msg;
                $class = 'success';
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
                <div class="col-md-6">
                  <div id="tableTools"></div>
                </div>
                <div class="col-md-6">
                  <div id="colVis"></div>
                </div>
              </div>
              <form action="<?php echo site_url(); ?>home/update_profile" method="post" class="" role="form" data-parsley-validate>
                <div class="row border_row">
                  <div class="form-group col-md-4">
                    <label><strong>Email:</strong></label>
                    <input type="text" class="form-control" value="<?php echo $supplier_info->supplier_email;?>" name="login_email" readonly />
                  </div>
                  <div class="form-group col-md-4">
                    <label><strong>Supplier No:</strong></label>
                    <input class="form-control" type="text" name="supplier_no" value="<?php echo $supplier_info->supplier_no; ?>" readonly>
                  </div>
                  <div class="form-group col-md-4">
                    <label><strong>Title:</strong></label>
                    <select name="title" class="form-control" required="">
						<option value="Mr" <?php if($supplier_info->title =='Mr') echo 'selected';?>>Mr.</option>
						<option value="Mrs" <?php if($supplier_info->title =='Mrs') echo 'selected';?>>Mrs.</option>
						<option value="Dr" <?php if($supplier_info->title =='Dr') echo 'selected';?>>Dr.</option>
					</select>
                  </div>
                </div>
                <div class="row border_row">
				  <div class="form-group col-md-4">
					<label><strong>First Name:</strong></label>
					<input class="form-control" type="text" value="<?php echo $supplier_info->first_name;?>" name="first_name"  required/>
				  </div>
				  <div class="form-group col-md-4">
                    <label><strong>Middle Name(Optional):</strong></label>
                    <input type="text" name="middle_name" class="form-control" value="<?php echo $supplier_info->middle_name; ?>" >
                  </div>
                  <div class="form-group col-md-4">
                    <label><strong>Last Name:</strong></label>
                    <input type="text" name="last_name" class="form-control" value="<?php echo $supplier_info->last_name; ?>" required>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-md-4">
                    <label for="holiday_city"><strong>Mobile No:</strong></label>
                    <input class="form-control" type="text" name="mobile_no" value="<?php echo $supplier_info->mobile_no; ?>" required />
                  </div>
                  <div class="form-group col-md-4">
                    <label for="holiday_city"><strong>Address:</strong></label>
                    <textarea class="form-control" rows="2" cols="45" name="address" required><?php echo $supplier_info->address; ?></textarea>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="pin_code"><strong>Pin Code:</strong></label>
                    <input class="form-control" type="text" name="pin_code" id="pin_code" value="<?php echo $supplier_info->pin_code; ?>" required />
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-md-4">
                    <label><strong>City:</strong></label>
                    <input class="form-control" type="text" name="city" value="<?php echo $supplier_info->city; ?>" required />
                  </div>
                  <div class="form-group col-md-4">
                    <label><strong>State:</strong></label>
                    <input  class="form-control" type="text" name="state" value="<?php echo $supplier_info->state; ?>" required />
                  </div>
                  <div class="form-group col-md-4">
                    <label><strong>Country:</strong></label>
                    <input  class="form-control" type="text" name="country" value="<?php echo $supplier_info->country; ?>" required />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-offset-11">
					  <button type="submit" class="btn btn-ef btn-ef-1 btn-ef-1-primary btn-ef-1a">Update</button>
					</div>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
