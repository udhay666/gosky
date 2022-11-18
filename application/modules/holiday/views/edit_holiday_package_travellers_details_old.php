<?php $this->load->view('home/header');
 $pass_info = $this->session->userdata('passenger_info'); 
?>
   <link href="<?php echo base_url(); ?>public/css/select2.min.css" rel="stylesheet">
<!-- <div id="wrapper" style="background: #e5e2e2"> -->
<style type="text/css">
.section {
   background-color: #fff; 
   color: #1c1d22; 
}
</style>
<div id="wrapper">
<section id="pack-section" class="pack-section" style="background: #253035">
  <form name="booking" method="POST" action="<?php echo base_url(); ?>index.php/holiday/confirm_booking" enctype='multipart/form-data' class="container traveller-details">
    <!-- Contact details -->
    <section id="home" class="shadow-box white-container container page">
      <section class="section">
        <h4><?php echo $pass_info['package_title']; ?></h4>
        <h6><?php echo $pass_info['holiday_duration'];?></h6>
        <h5><i class="fa fa-address-card-o"></i> Contact Details</h5>
        <div class="bottom-line"></div>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label" for="user_email">Email <span class="label-info">(For Booking Reference)</span></label>
              <input type="email" name="user_email" class="form-control" id="user_email"   value="<?php echo $pass_info['user_email'];?>" autocomplete="off"/>
              <input type="hidden" name="retval" id="retvalue" value="true"/>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label" for="user_mobile">Contact No <span class="label-info">(For Booking Reference)</span></label>
              <input type="text" name="user_mobile" class="form-control" id="user_mobile"  value="<?php echo $pass_info['user_mobile'];?>" autocomplete="off"/>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label" for="user_city">City</label>
              <input type="text" name="user_city" class="form-control" placeholder="Enter your City"  id="user_city" value="<?php echo $pass_info['user_city'];?>" autocomplete="off"/>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label" for="user_pincode">Postal Code</label>
              <input type="text" name="user_pincode" class="form-control" placeholder="Enter your Postal Code" id="user_pincode" value="<?php echo $pass_info['user_pincode'];?>" autocomplete="off" />
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label" for="user_state">State</label>
              <input type="text" name="user_state" class="form-control" placeholder="Enter your State"  id="user_state" value="<?php echo $pass_info['user_state'];?>" autocomplete="off"/>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label" for="user_country">Country</label>
               <select  id="country" name="user_country" class="form-control">
                <option value="">Select Your Country</option>
                <optgroup label="Country List">
                <option value="India" <?php if($pass_info['user_country']=='India'){echo 'Selected'; } ?>>India</option>
                  <?php for($i=0;$i<count($country_list);$i++){?>
                  <option value="<?php echo $country_list[$i]->name;?>" <?php if($country_list[$i]->name==$pass_info['user_country']){echo 'Selected'; } ?>><?php echo $country_list[$i]->name;?></option>
                  <?php } ?>
                </optgroup>
              </select>  
              <span id="user_country" style="color: red;"></span>        
            </div>
          </div>         
        </div>
        <div class="row">
         <div class="col-sm-8">
            <div class="form-group">
              <label class="control-label" for="user_address">Address</label>
              <textarea class="form-control" name="address" placeholder="Enter your contact address" id="user_address"  style="height: 103px;min-height: 103px;" autocomplete="off"><?php echo $pass_info['address'];?></textarea>
            </div>
          </div>          
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label" for="user_comment">Comment</label>
              <textarea class="form-control" name="comment" id="user_comment" placeholder="Enter your Comment"  style="height: 103px;min-height: 103px;" autocomplete="off"autocomplete="off"><?php echo $pass_info['comment'];?></textarea>
            </div>
          </div>
        </div>
      </section>
    </section>
    <!-- traveller details -->
    <section id="Traveller" class="shadow-box white-container container page">
      <section class="section">
        <h5><i class="fa fa-users"></i> Traveller Details</h5>
        <div class="bottom-line"></div>
        <div class="row2">
          <?php $i=0;
          if($pass_info['adults_no']>0){ ?>
          <h6>1. Adult(s)</h6>
          <?php for($k=0;$i<$pass_info['adults_no']&&($pass_info['passengertype'][$i]=='adult');$i++,$k++){ ?>
          <div class="row checkname">
            <div class="col-sm-12">
              <div class="col-sm-1 ">Adult <?php echo ($k+1);?></div>
              <div class="col-sm-2 form-group">
                <select class="form-control checktitle" name="title[]" style="padding-right: 0;padding-left: 10px;">
                  <option value="">Title</option>
                  <option value="Mr" <?php if($pass_info['title'][$i]=='Mr'){echo 'Selected';}?>>Mr</option>
                  <option value="Mrs" <?php if($pass_info['title'][$i]=='Mrs'){echo 'Selected';}?>>Mrs</option>
                  <option value="Ms" <?php if($pass_info['title'][$i]=='Ms'){echo 'Selected';}?>>Ms</option>
                </select> 
                <span style="color: red;"></span>
              </div>
              <div class="col-sm-2 form-group">
          <input type="text" name="fname[]" class="form-control" placeholder="First Name"  value="<?php echo $pass_info['fname'][$i];?>" autocomplete="off"/>
              </div>
              <div class="col-sm-2 form-group">
                <input type="text" name="mname[]" class="form-control" placeholder="Middle Name" value="<?php echo $pass_info['mname'][$i];?>" autocomplete="off"/>
              </div>
              <div class="col-sm-2 form-group">
                <input type="text" name="lname[]" class="form-control" placeholder="Last Name"  value="<?php echo $pass_info['lname'][$i];?>" autocomplete="off"/>
              </div>
                <div class="col-sm-3 form-group">
                <input type="text" name="dob[]" class="form-control adob_dp" placeholder="Date of Birth" data-inputmask="'mask': '99/99/9999'"  value="<?php echo $pass_info['dob'][$i];?>" autocomplete="off" style="background: white;cursor: pointer;"/>
              </div>
              <input type="hidden" name="passengertype[]" value="adult">
            </div>
          </div>
          <?php } } ?>
        </div>
        <div class="row2">
          <?php if($pass_info['childs_no']>0){ ?>
          <h6>2. Child(s)</h6>
          <?php for($k=0;$k<$pass_info['childs_no']&&($pass_info['passengertype'][$i]=='child');$i++,$k++){ ?>
          <div class="row checkname">
            <div class="col-sm-12">
              <div class="col-sm-1">Child <?php echo ($k+1);?></div>
              <div class="col-sm-2 form-group">
                <select class="form-control checktitle" name="title[]" style="padding-right: 0;padding-left: 10px;">
                  <option value="">Title</option>
                  <option value="Mr" <?php if($pass_info['title'][$i]=='Mr'){echo 'Selected';}?>>Mr</option>
                  <option value="Mrs" <?php if($pass_info['title'][$i]=='Mrs'){echo 'Selected';}?>>Mrs</option>
                  <option value="Ms" <?php if($pass_info['title'][$i]=='Ms'){echo 'Selected';}?>>Ms</option>
                </select>
              <span style="color: red;"></span>
              </div>
              <div class="col-sm-2 form-group">
                <input type="text" name="fname[]" class="form-control" placeholder="First Name"    value="<?php echo $pass_info['fname'][$i];?>" autocomplete="off"/>
              </div>
              <div class="col-sm-2 form-group">
                <input type="text" name="mname[]" class="form-control" placeholder="Middle Name" value="<?php echo $pass_info['mname'][$i];?>" autocomplete="off"/>
              </div>
              <div class="col-sm-2 form-group">
                <input type="text" name="lname[]" class="form-control" placeholder="Last Name" value="<?php echo $pass_info['lname'][$i];?>" autocomplete="off"/>
              </div>
              <div class="col-sm-3 form-group">
                <input type="text" name="dob[]" class="form-control cdob_dp" placeholder="Date of Birth" data-inputmask="'mask': '99/99/9999'" value="<?php echo $pass_info['dob'][$i];?>" autocomplete="off"   readonly style="background: white;cursor: pointer;"/>
              </div>
              <input type="hidden" name="passengertype[]" value="child">
            </div>
            </div>
          <?php } } ?>
        </div>
        <div class="row2">
          <?php if($pass_info['infants_no']>0){ ?>
          <h6>3. Infant(s)</h6>
          <?php for($k=0;$k<$pass_info['infants_no']&&($pass_info['passengertype'][$i]=='infant');$i++,$k++){ ?>
          <div class="row checkname">
            <div class="col-sm-12">
              <div class="col-sm-1 ">Infant <?php echo ($k+1);?></div>
              <div class="col-sm-2 form-group">
               <select class="form-control checktitle" name="title[]" style="padding-right: 0;padding-left: 10px;">
                  <option value="">Title</option>
                  <option value="Mr" <?php if($pass_info['title'][$i]=='Mr'){echo 'Selected';}?>>Mr</option>
                  <option value="Mrs" <?php if($pass_info['title'][$i]=='Mrs'){echo 'Selected';}?>>Mrs</option>
                  <option value="Ms" <?php if($pass_info['title'][$i]=='Ms'){echo 'Selected';}?>>Ms</option>
                </select>
                <span style="color: red;"></span>
              </div>
              <div class="col-sm-2 form-group">
                <input type="text" name="fname[]" class="form-control" placeholder="First Name"  value="<?php echo $pass_info['fname'][$i];?>"  />
              </div>
              <div class="col-sm-2 form-group">
                <input type="text" name="mname[]" class="form-control" placeholder="Middle Name"   value="<?php echo $pass_info['mname'][$i];?>" autocomplete="off"/>
              </div>
              <div class="col-sm-2 form-group">
                <input type="text" name="lname[]" class="form-control" placeholder="Last Name"   value="<?php echo $pass_info['lname'][$i];?>" autocomplete="off"/>
              </div>
              <div class="col-sm-3 form-group">
                <input type="text" name="dob[]" class="form-control idob_dp" placeholder="Date of Birth" data-inputmask="'mask': '99/99/9999'"    value="<?php echo $pass_info['dob'][$i];?>" autocomplete="off" style="background: white;cursor: pointer;"/>
              </div>
              <input type="hidden" name="passengertype[]" value="infant">
             </div>
          </div>
          <?php } } ?>
        </div>
      </section>
    </section>
    <!-- Package details -->
    <section id="Package" class="shadow-box white-container container page">
      <section class="section">
        <h5><i class="fa fa-snowflake-o"></i> Package Details</h5>
        <div class="bottom-line"></div>
        <div class="row2">
          <table align="right" style="width:100%;" class="table table-striped table-bordered">
            <tr>
              <th>Package Name</th>
              <th>Duration</th>
              <th>Arrival Date</th>
              <th>Departure Date</th>
              <th>Accommodation Type</th>
              <th>Room(s)</th>
              <th>Adult(s)</th>
              <th>Child(ren)</th>
              <th>Infant(s)</th>
              <th>Total Cost</th>
            </tr>         
            <tr>
              <td><?php echo $pass_info['package_title']; ?></td>
              <td><?php echo $pass_info['holiday_duration'];?></td>
              <td><?php echo $pass_info['arrival_date'];?></td>
               <td><?php echo $pass_info['depart_date'];?></td>
              <td><?php echo $pass_info['accommodation_type'];?></td>
              <td><?php echo $pass_info['room_no']; ?></td>
              <td><?php echo $pass_info['adults_no']; ?></td>
              <td><?php echo $pass_info['childs_no']; ?></td>
              <td><?php echo $pass_info['infants_no']; ?></td>
              <td><i class="fa fa-rupee"></i> <strong><?php echo $pass_info['total_cost']; ?></strong></td>
            </tr> 
          </table>
         <input type="hidden" name="package_title" value="<?php echo $pass_info['package_title']; ?>" />
          <input type="hidden" name="holiday_duration" value="<?php echo $pass_info['holiday_duration'];?>" />
          <input type="hidden" name="arrival_date" value="<?php echo $pass_info['arrival_date'];?>" />
          <input type="hidden" name="depart_date" value="<?php echo $pass_info['depart_date'];?>" />
          <input type="hidden" name="accommodation_type" value="<?php echo $pass_info['accommodation_type'];?>" />
          <input type="hidden" name="room_no" value="<?php echo $pass_info['room_no']; ?>" />
          <input type="hidden" name="single_room_no" value="<?php echo $pass_info['single_room_no']; ?>" />
          <input type="hidden" name="twin_room_no" value="<?php echo $pass_info['twin_room_no']; ?>" />
          <input type="hidden" name="triple_room_no" value="<?php echo $pass_info['triple_room_no']; ?>" />
          <input type="hidden" name="room_details" value='<?php echo $pass_info['room_details']; ?>' />
          <input type="hidden" name="adults_no" value="<?php echo $pass_info['adults_no']; ?>" />
          <input type="hidden" name="childs_no" value="<?php echo $pass_info['childs_no']; ?>" />
          <input type="hidden" name="infants_no" value="<?php echo $pass_info['infants_no']; ?>" />
          <input type="hidden" name="total_cost" value="<?php echo $pass_info['total_cost'];?>"/>
        </div>
        <?php
         $room_arr=json_decode($pass_info['room_details'],true); 
         if(!empty($room_arr)){ ?>
        <div class="row" style="margin-top:10px"></div>
       <table align="right" style="width:100%;" class="table table-striped table-bordered">
         <tr>
            <th colspan="2">Room(s)</th>
            <th colspan="2">Room Type</th>
            <th colspan="2">Adult(s)</th>
            <th colspan="2">Child(ren)</th>
            <th colspan="2">Infant(s)</th>
          </tr>         
          <?php for($i=0;$i<count($room_arr);$i++){ ?>
          <tr>
            <td colspan="2">Room <?php echo ($i+1);?></td>
            <td colspan="2"><?php echo ucfirst($room_arr[$i]['type']).' '.'Sharing';?></td>
            <td colspan="2"><?php echo $room_arr[$i]['adults'];?></td>
            <td colspan="2"><?php echo $room_arr[$i]['childs'];?></td>
            <td colspan="2"><?php echo $room_arr[$i]['infants'];?></td>
          </tr>
          <?php } ?>  
        </table>
        <?php } ?>
      </section>
    </section>
    <!-- Payment details -->
    <section id="Payment" class="shadow-box white-container container page">
      <section class="section">
        <h5><i class="fa fa-credit-card"></i>Payment Details</h5>
        <div class="bottom-line"></div>
        <div class="row">
          <div class="col-xs-12">
          <h4><span>Total Cost</span> <span class="after_discount" style="color: #f24843;">&nbsp;&nbsp;  <i class="fa fa-rupee"></i>&nbsp;<?php echo moneyFormatIndia($pass_info['total_cost']); ?></span></h4>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <label>
              <input type="hidden"  name="holiday_id"  value="<?php echo $pass_info['holiday_id']; ?>">
             <input type="checkbox" name="termsagree" id="termsagree" /> I have read and agree to the terms and conditions. <span id="termsspan" style="font-size: 10px;"></span>
            </label>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-xs-12">
            <input type="hidden" name="pay_type" value="razorpay"/>
            <input type="submit" name="submit" id="travellersubmit" class="btn btn-default" value="Continue" style="margin-bottom:10px" />
          </div>
        </div>
      </section>
      </section>
      </form>
      </section>
      </div>
      
    

<?php $this->load->view('home/footer');?>
<style type="text/css">
.off_placeholder::-webkit-input-placeholder {
      color: red;
  }
#footerbar {
    background: #e5e2e2 url(../public/images/footerbar.png) no-repeat bottom center;
}
input[type="text"],input[type="email"], input[type="password"], select, input[type="date"], textarea, select{
    height: 32px;
    font-size: 14px;
}
.form-control {
    height: 32px;
    padding: 5px 10px;
}
</style>

<script src="<?php echo base_url(); ?>public/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/travellerdetailsvalidation.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
   $("#country").select2({
          placeholder: "Select Your Country",
          allowClear: true
        });
  });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/bootstrapdaterangepicker/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/bootstrapdaterangepicker/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/bootstrapdaterangepicker/daterangepicker.css" />
  <!-- jquery.inputmask -->
    <script src="<?php echo base_url(); ?>public/bootstrapdaterangepicker/jquery.inputmask.bundle.min.js"></script>  
 <!-- jquery.inputmask -->
    <script>
      $(document).ready(function() {
        $(":input").inputmask();
      });
    </script>
<script type="text/javascript">
  $(function() { 
    var d = new Date(); 
    $('.adob_dp').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      locale: {
        format: 'DD/MM/YYYY'
      }, 
      startDate: '<?php echo date('d/m/Y', strtotime('-12 years')) ?>',
      minDate:d.getDate()+"/"+(d.getMonth()+1)+"/"+(d.getFullYear()-110) ,     
      maxDate:d.getDate()+"/"+(d.getMonth()+1)+"/"+(d.getFullYear()-12),
    });

    $('.cdob_dp').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      locale: {
        format: 'DD/MM/YYYY'
      },  
      startDate: '<?php echo date('d/m/Y', strtotime('-2 years')) ?>',            
      minDate: (d.getDate()-1)+"/"+(d.getMonth()+1)+"/"+(d.getFullYear()-12),
      maxDate: d.getDate()+"/"+(d.getMonth()+1)+"/"+(d.getFullYear()-2),
    });
    $('.idob_dp').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true, 
      locale: {
        format: 'DD/MM/YYYY'
      }, 
      startDate: '<?php echo date('d/m/Y') ?>',                
      minDate: d.getDate()+"/"+(d.getMonth()+1)+"/"+(d.getFullYear()-2),
      maxDate:  d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear(),
    });
    $('.ppi_dp').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true, 
      locale: {
        format: 'DD/MM/YYYY'
      },             
      maxDate:  d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear(),
    });
    $('.ppe_dp').daterangepicker({

      singleDatePicker: true,
      showDropdowns: true, 
      locale: {
        format: 'DD/MM/YYYY'
      },               
      minDate:d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear(),
      maxDate: d.getDate()+"/"+(d.getMonth()+1)+"/"+(d.getFullYear()+45),
    }); 
  });
</script>