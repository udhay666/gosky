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
        <form action="<?php echo site_url();?>corporatesubadmin/update_profile" method="post"  enctype="multipart/form-data" class="" data-parsley-validate>
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
                    <input type="text" class="form-control" placeholder="<?php echo $agent_info->agent_email; ?>" disabled="">
                    <small class="small-font">(Corporate No will be generated, Ex:- MTPC1234)</small>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3"><label>Password:</label></div>
                  <div class="col-md-4">
                    <input type="text" placeholder="********" disabled="" class="form-control form-group">
                    <a href="<?php echo site_url();?>corporate/change_password" title="Click here to Reset Corporate password" data-rel="tooltip" class="btn btn-primary push-top-5"><i class="mdi mdi-undo"></i>Reset Password</a>
                    <small class="small-font">The password is hidden for security</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2">Agency Information :</div>
            <div class="white-container">
              <div class="row form-group">
                <div class="col-md-3">
                  <label>Corporate Number :</label>
                </div>
                <div class="col-md-4">
                  <input class="form-control" type="text" placeholder="<?php echo $agent_info->agent_no; ?>" disabled="">
                  <small class="small-font">(No permission to update Corporate Number)</small>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3"><label>Company Name<span class="red">*</span></label></div>
                <div class="col-md-4">
                  <input class="form-control" type="text" name="agency_name" value="<?php echo $agent_info->agency_name; ?>" required />
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3"><label>Company logo (100x100)</label></div>
                <div class="col-md-4">
                  <input type="file" name="agency_logo" class="" title="upload company logo" />
                </div>
              </div>
              <?php if(!empty($agent_info->agent_logo)){ ?>
              <div class="row form-group">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                  <img class="grayscale" alt="Corporate Logo" src="<?php echo base_url().'admin/'.$agent_info->agent_logo; ?>" height="100px" width="100px" align="middle">
                </div>
              </div>
              <?php } ?>
              <div class="row">
                <div class="col-md-3"><label>Website</label></div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="website" value="<?php echo $agent_info->website; ?>" placeholder="Your Website">
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
                <div class="col-md-3"><label>Your Telephone Number</label></div>
                <div class="col-md-4">
                  <input type="text" class="form-control" placeholder="Enter your office number" name="office_phone_no" value="<?php echo $agent_info->office_phone_no; ?>">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3"><label>Your Fax</label></div>
                <div class="col-md-4">
                  <input type="text" placeholder="Fax Address" class="form-control" name="fax" value="<?php echo $agent_info->fax; ?>">
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
            <div class="searchHdr2">GST Information</div>
            <div class="white-container">
              <div class="row form-group">
                <div class="col-md-3">
                  <label>GST Number :<span class="red"> *</span></label>
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control" required placeholder="GST Number" name="gstnumber"
                  value= "<?php echo $agent_info->gstnumber; ?>" >
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3">
                  <label>GST Company Name :<span class="red"> *</span></label>
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control" required placeholder="GST Company Name" name="gstcompany"
                  value= "<?php echo $agent_info->gstcompany; ?>" >
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3">
                  <label>GST Contact Mobile :<span class="red"> *</span></label>
                </div>
                <div class="col-md-4">
                  <input type="text" required class="form-control" name="gstmobile" value="<?php echo $agent_info->gstcontact; ?>" placeholder="GST Mobile" >
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3">
                  <label>GST Email :<span class="red"> *</span></label>
                </div>
                <div class="col-md-4">
                  <input type="text" required class="form-control " name="gstemail" value="<?php echo $agent_info->gstemail; ?>" placeholder="GST Email" >
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3">
                  <label>GST Address :<span class="red"> *</span></label>
                </div>
                <div class="col-md-4">
                  <input type="text" required class="form-control " name="gstaddress" value="<?php echo $agent_info->gstaddress; ?>" placeholder="GST Address" >
                </div>
              </div>
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                  <button type="submit" class="btn btn-secondary"><i class="mdi mdi-send"></i> Update</button>
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