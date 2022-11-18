<?php $this->load->view('home/home_template/header'); ?>
<section class="section-padding inner-page">
  <div class="container">
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
        <form action="<?php echo site_url();?>corporate/corporate_register" class="form-horizontal" method="post" enctype="multipart/form-data" data-parsley-validate>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2">Registration Information</div>
            <div class="white-container">
              <div class="row form-group">
                <div class="col-md-4">
                  <label>Email Address:<span class="red">*</span></label>
                </div>
                <div class="col-md-6">
                  <input type="email" class="form-control" placeholder="Enter Email Address" name="agent_email" required value="<?php if( isset($agent_email)) echo $agent_email; ?>" >
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4">
                  <label>Password:<span class="red">*</span></label>
                </div>
                <div class="col-md-6">
                  <input type="password" name="agent_password" required  placeholder="Password" class="form-control" >
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <label>Confirm Password:<span class="red">*</span></label>
                </div>
                <div class="col-md-6">
                  <input type="password" name="passconf" required class="form-control" placeholder="Confirm Password" >
                </div>
              </div>
            </div>
          </div>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2">User Information</div>
            <div class="white-container">
              <div class="row form-group">
                <div class="col-md-4">
                  <label>Corporate Name :<span class="red"> *</span></label>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" required  name="agency_name" value="<?php if( isset($agency_name)) echo $agency_name; ?>" placeholder="Enter Your Company Name">
                </div>
              </div>
              <!-- <div class="row">
                <div class="col-md-4">
                  <label>Agency Logo :</label>
                </div>
                <div class="col-md-6">
                  <input type="file" name="agency_logo" class="" title="upload company logo"/>
                </div>
              </div> -->
            </div>
          </div>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2">Personal Information</div>
            <div class="white-container">
              <div class="row form-group">
                <div class="col-md-4 ">
                  <label>Title :<span class="red"> *</span></label>
                </div>
                <div class="col-md-3">
                  <select class="form-control" required name="title" >
                    <option value="">Title</option>
                    <option value="Mr" <?php if( isset($title)) echo 'selected' ?>>Mr.</option>
                    <option value="Mrs" <?php if( isset($title)) echo 'selected' ?>>Mrs.</option>
                    <option value="Ms" <?php if( isset($title)) echo 'selected' ?>>Ms.</option>
                  </select>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4 ">
                  <label>First Name :<span class="red"> *</span></label>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" required  name="first_name" value="<?php if( isset($first_name)) echo $first_name; ?>" placeholder="Enter Your First Name" >
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4 ">
                  <label>Middle Name :</label>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Enter Your Middle Name (Optional)" name="middle_name" value="<?php if( isset($middle_name)) echo $middle_name; ?>" placeholder="Enter Your Middile Name">
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 ">
                  <label>Last Name :<span class="red"> *</span></label>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" required name="last_name" value="<?php if( isset($last_name)) echo $last_name; ?>" placeholder="Enter Your Last Name" />
                </div>
              </div>
            </div>
          </div>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2">Contact Information</div>
            <div class="white-container">
              <div class="row form-group">
                <div class="col-md-4">
                  <label>Your Address :<span class="red"> *</span></label>
                </div>
                <div class="col-md-6">
                  <textarea rows="2" cols="45" required class="form-control" name="address" placeholder="Enter Your Address"><?php if( isset($address)) echo $address; ?></textarea>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4">
                  <label>Your Mobile Number :<span class="red"> *</span></label>
                </div>
                <div class="col-md-3">
                  <input type="text" class="form-control" required placeholder="Enter your Mobile number" name="mobile_no"
                  value= "<?php  if( isset($mobile_no))  echo $mobile_no;  ?>" >
                </div>
                <div class="col-md-3">
                  <input type="text" class="form-control" placeholder="Enter your Office number" name="office_phone_no" value="<?php if( isset($office_phone_no)) echo $office_phone_no; ?>" >
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4">
                  <label>Your City :<span class="red"> *</span></label>
                </div>
                <div class="col-md-6">
                  <input type="text" required class="form-control" name="city" value="<?php if( isset($city)) echo $city; ?>" placeholder="Enter Your City" >
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4 ">
                  <label>Your Country :<span class="red"> *</span></label>
                </div>
                <div class="col-md-6">
                  <select class="form-control" name="country" required>
                    <option value="">-- Select Country --</option>
                    <?php
                    for($i=0;$i<count($country_list);$i++) {?>
                    <option value="<?php echo $country_list[$i]->name; ?>" <?php if(isset($country) && $country_list[$i]->name == $country) echo 'selected' ?>><?php echo $country_list[$i]->name; ?></option>
                    <?php }  ?>
                  </select>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4">
                  <label>Your State :<span class="red"> *</span></label>
                </div>
                <div class="col-md-6">
                  <input type="text" name="state" class="form-control" value="<?php if( isset($state)) echo $state; ?>" placeholder="Enter Your State" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <label>Your Postal/Zip Code :<span class="red"> *</span></label>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" value="<?php if( isset($pin_code)) echo $pin_code; ?>" placeholder="Enter Zip/Postal Code" name="pin_code" required>
                </div>
              </div>
            </div>
          </div>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2">GST Information</div>
            <div class="white-container">
              <div class="row form-group">
                <div class="col-md-4">
                  <label>GST Number :<span class="red"> *</span></label>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" required placeholder="GST Number" name="gstnumber"
                  value= "<?php if( isset($gstnumber))  echo $gstnumber;  ?>" >
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4">
                  <label>GST Company Name :<span class="red"> *</span></label>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" required placeholder="GST Company Name" name="gstcompany" value="<?php  if( isset($gstcompany))  echo $gstcompany;  ?>" >
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4">
                  <label>GST Contact Mobile :<span class="red"> *</span></label>
                </div>
                <div class="col-md-6">
                  <input type="text" required class="form-control" name="gstmobile" value="<?php if( isset($gstcontact)) echo $gstcontact; ?>" placeholder="GST Mobile" >
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4 ">
                  <label>GST Email :<span class="red"> *</span></label>
                </div>
                <div class="col-md-6">
                  <input type="text" required class="form-control" name="gstemail" value="<?php if( isset($gstemail)) echo $gstemail; ?>" placeholder="GST Email" >
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4 ">
                  <label>GST Address :<span class="red"> *</span></label>
                </div>
                <div class="col-md-6">
                  <input type="text" required class="form-control" name="gstaddress" value="<?php if( isset($gstaddress)) echo $gstaddress; ?>" placeholder="GST Address" >
                </div>
              </div>
              <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-secondary"><i class="mdi mdi-send"></i> SIGN UP</button>
                  <a href="<?php echo site_url() ?>corporate/login" title="Click here to go back" class="btn btn-danger"><i class="mdi mdi-undo"></i> Cancel</a>
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