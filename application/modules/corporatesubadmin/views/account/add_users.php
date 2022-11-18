<?php $this->load->view('home/header'); ?>
<section class="section-padding inner-page">
  <div class="container">
    <?php $message = isset($message) ? $message : $this->session->flashdata('message'); ?>
    <?php if(!empty($message)) { ?>

    <div class="row">
      <div class="col-lg-12">
        <div class="alert alert-block alert-warning">
          <a href="#" data-dismiss="alert" class="close">×</a>
          <h5 class="mb-0 text-center text-danger"><?php echo $message; ?></h5>
        </div>
      </div>
    </div>
    <?php } ?>
    <div class="row">
      <div class="col-lg-12 col-md-12 mx-auto">
        <form action="<?php echo site_url();?>corporatesubadmin/add_users" method="post"  enctype="multipart/form-data" class="" data-parsley-validate> 
          <input type="hidden" name="agent_id" value="<?php echo $agent_info->agent_id; ?>" />
          <input type="hidden" name="agent_email" value="<?php echo $agent_info->agent_email; ?>" />
          <input type="hidden" name="agent_logo" value="<?php echo $agent_info->agent_logo; ?>" />
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2">Login Information :</div>
            <div class="white-container">
              <div class="col-md-12">
                <div class="row form-group">
                  <div class="col-md-3"><label>Email Address:</label></div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="admin_email" placeholder="<?php echo $agent_info->agent_email; ?>" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    <small class="small-font"></small>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3"><label>Password:</label></div>
                  <div class="col-md-4">
                    <input type="password" placeholder="********"  name="admin_password" class="form-control form-group" required>
                    <a href="<?php echo site_url();?>corporate/change_password" title="Click here to Reset Corporate password" data-rel="tooltip" class="btn btn-primary push-top-5"><i class="mdi mdi-undo"></i>Reset Password</a>
                    <small class="small-font">The password is hidden for security</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2">Contact Information :</div>
            <div class="white-container">
              <div class="row form-group">
                <div class="col-md-3"><label>Title<span class="red">*</span></label></div>
                <div class="col-md-4">
                  <select class="form-control" name="title" required >
                    <option value="Mr" <?php if($agent_info->title == 'Mr') echo 'selected'; ?>>Mr.</option>
                    <option value="Mrs" <?php if($agent_info->title == 'Mrs') echo 'selected'; ?>>Mrs.</option>
                    <option value="Ms" <?php if($agent_info->title == 'Ms') echo 'selected'; ?>>Ms.</option>
                    <option value="Dr" <?php if($agent_info->title == 'Dr') echo 'selected'; ?>>Dr.</option>
                  </select>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3"><label>First Name<span class="red">*</span></label></div>
                <div class="col-md-4">
                  <input class="form-control" type="text" name="first_name" value="<?php echo $agent_info->first_name; ?>" required />
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3"><label>Middle Name</label></div>
                <div class="col-md-4">
                  <input type="text" class="form-control" placeholder="Middle Name (Optional)" name="middle_name" value="<?php echo $agent_info->middle_name; ?>" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-3"><label>Last Name<span class="red">*</span></label></div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="last_name" value="<?php echo $agent_info->last_name; ?>" required />
                </div>
              </div>
            </div>
          </div>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2">Contact Information :</div>
            <div class="white-container">
              <div class="row form-group">
                <div class="col-md-3"><label>Your Address<span class="red">*</span></label></div>
                <div class="col-md-4">
                  <textarea rows="2" cols="45" class="form-control" name="address" required><?php echo $agent_info->address; ?></textarea>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3"><label>Your Mobile Number<span class="red">*</span></label></div>
                <div class="col-md-4">
                  <input type="text" class="form-control" placeholder="Enter your mobile number" name="mobile_no" value="<?php echo $agent_info->mobile_no; ?>" required>
                </div>
              </div>
              
              
              <div class="row form-group">
                <div class="col-md-3"><label>Your Postal/Zip Code<span class="red">*</span></label></div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="pin_code" value="<?php echo $agent_info->pin_code; ?>" required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3"><label>Your City<span class="red">*</span></label></div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="city" value="<?php echo $agent_info->city; ?>" required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3"><label>Your State<span class="red">*</span></label></div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="state"  value="<?php echo $agent_info->state; ?>" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3"><label>Your Country<span class="red">*</span></label></div>
                <div class="col-md-4">
                  <select class="form-control" name="country" required >
                    <option value="">-- Select Country --</option>
                    <?php for($i=0;$i<count($country_list);$i++) { ?>
                    <option value="<?php echo $country_list[$i]->name; ?>" <?php if($agent_info->country == $country_list[$i]->name) echo 'selected' ?>><?php echo $country_list[$i]->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
            </div>
          </div>
          <div class="itinerary-container box-shadow">
          <!--   <div class="searchHdr2">Permission</div> -->
            <div class="white-container">
              <!-- <div class="row form-group">
                <div class="col-md-3">                  
                </div>
                <div class="col-sm-6"><br/>
                 <?php   //foreach ($admin_priviliges as $mod) { ?>
                                                 <input type="checkbox"  name="privilages[]" id="<?php //echo 'mod'.$mod->privilege_id; ?>"  onClick="changeSubModulePrivilege('<?php //echo 'mod'.$mod->privilege_id; ?>')"
                                                  value="<?php //echo $mod->privilege_id; ?>"/> 
                                                 <?php //echo '<span class="text text-danger"><b>'.$mod->privilege_name.'</b></span></br>';
                                                        
                                                 /*$submodule_privilages=$this->Corporate_Model->get_admin_submodule_privilages($mod->privilege_id);*/

                                                         /*foreach($submodule_privilages as $sub_privilages){ */
                                                         ?>
                                                       <span class="<?php //echo 'submod'.$mod->privilege_id;?>"> &nbsp; &nbsp; &nbsp; &nbsp;<input type="checkbox" name="subprivilages[]"
                                                        value="<?php //echo $sub_privilages->submodule_privilege_id ; ?>"      id="<?php //echo 'submod'.$sub_privilages->submodule_privilege_id;  ?>" class='<?php //echo 'mod'.$mod->privilege_id;?>' onClick= "changePrivilege('<?php// echo 'mod'.$mod->privilege_id;?>');"/>
                <?php //echo '<small>'.$sub_privilages->submodule_privilege_name.'</small></br></span>';} } ?>
                </div -->
              </div>
              
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                  <button type="submit" class="btn btn-secondary"><i class="mdi mdi-send"></i> Add Sub Admin</button>
                  <a href="<?php echo site_url() ?>corporate/dashboard" title="Click here to go back" class="btn btn-danger"><i class="mdi mdi-undo"></i> Go Back</a>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php $this->load->view('home/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>