<?php $this->load->view('home/home_template/header'); ?>

<style>

.content_new {
  max-width: 800px;
  margin: auto;
  background: white;
  padding: 10px;

}

.itinerary_style{
  margin-top: 82px;
}

</style>
<div class="content_new">
<section class="section-padding inner-page">

<div class="container main" >
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
      <form action="<?php echo site_url();?>b2c/update_profile" method="post"  enctype="multipart/form-data" class="" data-parsley-validate>
        
      <input type="hidden" name="user_id" value="<?php echo $user_info->user_id; ?>" />
        <input type="hidden" name="user_email" value="<?php echo $user_info->user_email; ?>" />
        <div class="itinerary-container itinerary_style" >
          <hr>
             <div > <h3>Login Information </h3></div>
             <hr>
              <div class="white-container">
                <div class="row form-group">
                  <div class="col-md-3">Email Address:</div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="<?php echo $user_info->user_email; ?>" disabled="">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">Password:</div>
                  <div class="col-md-4">
                    <input type="text" placeholder="********" disabled="" class="form-control form-group">
                    <a href="<?php echo site_url();?>b2c/change_password" title="Click here to Reset Agent password" data-rel="tooltip" class="btn btn-primary push-top-5"><i class="mdi mdi-undo"></i>Reset Password</a>
                    <small class="small-font">The password is hidden for security</small>
                  </div>
                </div>
              </div>
         </div>
        <div class="itinerary-container box-shadow">
          <div class="searchHdr2">Personal Information :</div>
          <div class="white-container">
            <div class="row form-group">
              <div class="col-md-3">Title<span class="red">*</span> </div>
              <div class="col-md-4">
                <select class="form-control" name="title" required >
                  <option value="Mr" <?php if($user_info->title == 'Mr') echo 'selected'; ?>>Mr.</option>
                  <option value="Mrs" <?php if($user_info->title == 'Mrs') echo 'selected'; ?>>Mrs.</option>
                  <option value="Ms" <?php if($user_info->title == 'Ms') echo 'selected'; ?>>Ms.</option>
                  <option value="Dr" <?php if($user_info->title == 'Dr') echo 'selected'; ?>>Dr.</option>
                </select>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-3">First Name<span class="red">*</span></div>
              <div class="col-md-4">
                <input class="form-control" type="text" name="first_name" value="<?php echo $user_info->first_name; ?>" required />
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-3">Middle Name</div>
              <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Middle Name (Optional)" name="middle_name" value="<?php echo $user_info->middle_name; ?>" />
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">Last Name<span class="red">*</span> </div>
              <div class="col-md-4">
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user_info->last_name; ?>" required />
              </div>
            </div>
          </div>
        </div>
        <div class="itinerary-container box-shadow">
          <div class="searchHdr2">Contact Information :</div>
          <div class="white-container">
            <div class="row form-group">
              <div class="col-md-3">Your Address<span class="red">*</span> </div>
              <div class="col-md-4">
                <textarea rows="2" cols="45" class="form-control" id="address" name="address" required><?php echo $user_info->address; ?></textarea>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-3">Your Mobile Number<span class="red">*</span> </div>
              <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Enter your mobile number" id="mobile_no" name="mobile_no" value="<?php echo $user_info->mobile_no; ?>" required>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-3">Your Postal/Zip Code<span class="red">*</span> </div>
              <div class="col-md-4">
                <input type="text" class="form-control" id="pin_code" name="pin_code" value="<?php echo $user_info->pin_code; ?>" required>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-3">Your City<span class="red">*</span> </div>
              <div class="col-md-4">
                <input type="text" class="form-control" id="city" name="city" value="<?php echo $user_info->city; ?>" required>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-3">Your State<span class="red">*</span> </div>
              <div class="col-md-4">
                <input type="text" class="form-control" id="state" name="state"  value="<?php echo $user_info->state; ?>" required>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-3">Your Country<span class="red">*</span> </div>
              <div class="col-md-4">
                <select class="form-control" name="country" required >
                  <option value="">-- Select Country --</option>
                  <?php for($i=0;$i<count($country_list);$i++) { ?>
                  <option value="<?php echo $country_list[$i]->name; ?>" <?php if($user_info->country == $country_list[$i]->name) echo 'selected' ?>><?php echo $country_list[$i]->name; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3"> &nbsp; <span class="red"></span> </div>
              <div class="col-md-4">
                <button type="submit" class="btn btn-secondary"><i class="mdi mdi-send"></i> Submit</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</section>

</div>
<?php $this->load->view('home/home_template/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>

