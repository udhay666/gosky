<?php $this->load->view('home/header');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/style.css">
<?php
    // $session_data = $this->session->userdata('hotel_search_data');
    $session_data = unserialize($roomDetails->searcharray);
    $city_arr = explode(',', $session_data['cityName']);
    $cityName = $city_arr[0];

    $adults = $session_data['adults'];
    $childs = $session_data['childs'];
    // $childs_ages = $session_data['childs_ages'];
    // $adults_count = $session_data['adults_count'];
    // $childs_count = $session_data['childs_count'];

    $rooms = $session_data['rooms'];
    $nights = $session_data['nights'];

    $checkinStrTime = strtotime(str_replace('/', '-', $session_data['checkIn']));
    $checkoutStrTime = strtotime(str_replace('/', '-', $session_data['checkOut']));

    if (!empty($roomDetails->hotel_image)) {
        $image_name = explode(',', $roomDetails->hotel_image);
    } else {
        $image_name = '';
    }
    $gttd = $image_name[0];

    $user_mobile = '';
    $user_email = '';
    $user_city = '';
    $user_pincode = '';
    $address = '';
    $user_country = '';
    if($this->session->userdata('user_no')){
      $user_id = $this->session->userdata('user_id');
      $this->load->model('b2c/B2c_Model');
      $user_info = $this->B2c_Model->getUserInfo($user_id);
      $user_mobile = $user_info->mobile_no;
      $user_email = $user_info->user_email;
      $user_city = $user_info->city;
      $user_pincode = $user_info->pin_code;
      $address = $user_info->address;
      $user_country = $user_info->country;
    }

?>
<section class="section-padding inner-page">
  <div class="container">
    <div class="row pt-5 pb-5">
      <div class="col-md-12 col-lg-12">
        <div class="form_wizard wizard_horizontal">
          <ul class="wizard_steps">
            <li>
              <a href="javascript:;">
                <span class="step_no wizard-step">1</span>
                <span class="step_descr">Choose your rooms</span>
              </a>
            </li>
            <li class="active_step">
              <a href="javascript:;">
                <span class="step_no wizard-step">2</span>
                <span class="step_descr">Enter your details</span>
              </a>
            </li>
            <li>
              <a href="javascript:;">
                <span class="step_no wizard-step">3</span>
                <span class="step_descr">Secure your booking</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <form name="booking" method="POST" action="<?php echo site_url(); ?>hotels/reservation?callBackId=<?php echo base64_encode($roomDetails->api); ?>&hotelCode=<?php echo $roomDetails->hotel_code; ?>&searchId=<?php echo $search_id; ?>&sessionId=<?php echo $roomDetails->session_id; ?>" data-parsley-validate >
    
    <input type="hidden" name="callBackId" value="<?php echo base64_encode($roomDetails->api); ?>" required />
    <input type="hidden" name="hotelCode" value="<?php echo $roomDetails->hotel_code; ?>" required />
    <input type="hidden" name="searchId" value="<?php echo $roomDetails->search_id; ?>" required />
    <input type="hidden" name="sessionId" value="<?php echo $roomDetails->session_id; ?>" required />
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <div class="itinerary-container box-shadow mb-3">
            <div class="bdTitle2">Your booking details</div>
            <div class="white-container">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <?php if ($gttd) { ?>
                  <img src="<?php echo $gttd; ?>" width="100%" height="170" alt="<?php echo $roomDetails->hotel_name; ?>" title="<?php echo $roomDetails->hotel_name; ?>" border="0" style="height: 170px;">
                  <?php } else { ?>
                  <img src="<?php echo base_url(); ?>public/img/noimage.jpg" width="100%" height="170" alt="No Image" border="0" style="height: 170px;">
                  <?php } ?>
                </div>
                <div class="col-lg-8 col-md-8">
                  <div class="row2 hotel-details push-bottom-10">
                    <h3><?php echo ucwords(strtolower($roomDetails->hotel_name)); ?> <span class="star star5"></span></h3>
                    <small><?php echo ucwords(strtolower($roomDetails->address)); ?></small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="login-box" class="itinerary-container box-shadow mb-3">
            <div class="bdTitle2">Contact Information</div>
            <div class="white-container">
              <div class="row" id="itinerary-login" style="<?php if($this->session->userdata('user_no')){ echo 'display: none;'; } else { echo 'display: block;'; } ?>">
                <div class="col-sm-12">
                  <p><b><i class="mdi mdi-hand-pointing-right"></i> Login to book faster</b></p>
                  <!-- <button type="button" class="btn btn-facebook" onclick="facebookLogin()"><i class="mdi mdi-facebook"></i> Facebook Login</button> &nbsp; -->

                  <?php //include(APPPATH.'libraries/googlelogin/login.php'); ?>
                  <!-- <button type="button" class="btn btn-google" onclick="googleLogin('<?php echo filter_var($authUrl, FILTER_SANITIZE_URL); ?>','Google Login','450','600');"><i class="mdi mdi-google-plus"></i> Google Login</button> &nbsp; -->

                  <a class="btn border-btn" href="#" data-toggle="modal" data-target="#modalLoginIntinerary" style="background: #fff;color: #4d74e0;border: 1px solid #4d74e0;"><i class="mdi mdi-account"></i> Account Login</a>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="border-line"></div>
                  </div>
                </div>
              </div>
              <div class="row form-group no-padding">
                <div class="col-sm-4">
                  <label>Email</label>
                  <input type="email" name="user_email" value="<?php echo $user_email ?>" class="form-control" required>
                </div>
                <div class="col-sm-4">
                  <label>Mobile number</label>
                  <input type="text" name="user_mobile" value="<?php echo $user_mobile ?>" class="form-control" required>
                </div>
              </div>
              <div class="row form-group no-padding">
                <div class="col-sm-4">
                  <label>City</label>
                  <input type="text" name="user_city" value="<?php echo $user_city ?>" class="form-control">
                </div>
                <div class="col-sm-4">
                  <label>Pin Code</label>
                  <input type="text" name="user_pincode" value="<?php echo $user_pincode ?>" class="form-control">
                </div>
              
                <div class="col-sm-4">
                  <label>Country</label>
                  <select name="user_country" class="form-control">
                    <option value="">Select Country</option>
                    <?php foreach ($countries as $country) { ?>
                    <option value="<?php echo $country->name; ?>" <?php if($country->name == 'India') echo 'selected' ?>><?php echo $country->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row no-padding">
                <div class="col-sm-8">
                  <label>Address</label>
                  <textarea class="form-control" name="address"><?php echo $address ?></textarea>
                </div>
              </div>
              <div class="border-line"></div>
              <span class="input-info">Your booking details will be sent to this email address and mobile number.</span>
            </div>
          </div>
          <div class="itinerary-container box-shadow mb-3">
            <div class="bdTitle2">Traveller details</div>
            <div class="white-container">
              <?php for ($i = 0; $i < $rooms; $i++) { ?>
            <?php for ($a = 0; $a < $adults[$i]; $a++) { ?>
              <div class="row form-group no-padding">
              <div class="col-sm-2">
                  <label class="invisible">Room</label>
                  <div class="bold">Room <?php echo $i+1 ?> :</div>
                </div>
                <div class="col-sm-2">
                  <label>Title</label>
                  <select class="form-control" name="adults_title[]" required>
                    <option value="">Title</option>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Ms">Ms</option>
                  </select>
                </div>
                <div class="col-sm-3">
                  <label>First name</label>
                  <input type="text" name="adults_fname[]" class="form-control" required>
                </div>
                <div class="col-sm-2">
                  <label>Last name</label>
                  <input type="text" name="adults_lname[]" class="form-control" required>
                </div>
                <?php if($PANMandatory = 'true'){?>
                 <div class="col-sm-3">
                  <label>PAN Number</label>
                  <input type="text" name="user_pan[]" value="" class="form-control">
                </div>
              <?php }?>
              </div>
              <?php } ?>

               <?php if (array_key_exists($i, $childs) && $childs[$i] != '') { ?>
                  <?php for ($c = 0; $c < $childs[$i]; $c++) { ?>
                      <div class="row form-group no-padding">
                      <div class="col-sm-2">
                  <label class="invisible">Room</label>
                  <div class="bold">Room <?php echo $i+1 ?> :</div>
                </div>
                    <div class="col-sm-2">
                      <label>Title</label>
                      <select class="form-control" name="childs_title[]" required>
                        <option value="">Title</option>
                        <option value="Mr">Mstr</option>
                        <option value="Miss">Miss</option>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <label>First name</label>
                      <input type="text" name="childs_fname[]" class="form-control" required>
                    </div>
                    <div class="col-sm-2">
                      <label>Last name</label>
                      <input type="text" name="childs_lname[]" class="form-control" required>
                    </div>
                    <?php if($PANMandatory = 'true'){?>
                    <div class="col-sm-3">
                      <label> PAN Number</label>
                      <input type="text" name="child_pan[]" value="" class="form-control">
                    </div>
                    <?php }?>
                  </div>
                  <?php } ?>
                  <?php } ?>


              <?php } ?>
              <div class="border-line"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="itinerary-container box-shadow mb-3">
            <div class="bdTitle2">Your room details</div>
            <div class="white-container">
              <table class="rooms-table row2">
                <tbody>
                  <tr>
                    <td>
                      <div class="form-label">Check-in</div>
                      <table>
                        <tr>
                          <td style="font-size: 40px"><?php echo date('d', $checkinStrTime) ?></td>
                          <td style="font-size: 12px;padding-left: 15px;">
                            <?php echo date('l', $checkinStrTime) ?><br><?php echo date('M Y', $checkinStrTime) ?>
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td width="15%" style="font-size: 40px">
                      <i class="mdi mdi-chevron-right"></i>
                    </td>
                    <td>
                      <div class="form-label">Check-out</div>
                      <table>
                        <tr>
                          <td style="font-size: 40px"><?php echo date('d', $checkoutStrTime) ?></td>
                          <td style="font-size: 12px;padding-left: 15px;">
                            <?php echo date('l', $checkoutStrTime) ?><br><?php echo date('M Y', $checkoutStrTime) ?>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="border-line"></div>
              <table class="row2 rooms-table2">
                <tbody>
                  <tr>
                    <td width="30%">
                      <div class="form-label">Room :</div>
                    </td>
                    <td><?php echo $rooms ?> x <?php echo $roomDetails->room_type ?></td>
                  </tr>
                
                 
                </tbody>
              </table>
              <!-- <div class="imp_note_content" style="display: none;">
                <b class="text-danger">Notes: </b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim eveniet eos, excepturi natus officiis optio commodi dolores, ipsa nulla quam cum temporibus incidunt tenetur molestiae veniam id. Natus, reiciendis pariatur!
              </div> -->
            </div>
          </div>
          <div class="itinerary-container box-shadow mb-3">
            <div class="bdTitle2">Fare breakup</div>
            <div class="white-container">
              <div class="fare-breakup-hotel">
                <table>
                  <tbody>
                    <tr>
                      <td>Base Fare</td>
                      <td><i class="mdi mdi-currency-inr"></i> <?php echo number_format($total_cost - ($roomDetails->admin_markup + $roomDetails->payment_charge)); ?></td>
                    </tr>
                    <tr>
                      <td>Service &amp; Fees</td>
                      <td><i class="mdi mdi-currency-inr"></i>  <?php echo number_format($roomDetails->admin_markup + $roomDetails->payment_charge); ?></td>
                    </tr>
                  </tbody>
                </table>
                <table class="total-fare">
                  <tbody>
                    <tr>
                      <td>Total</td>
                      <td>
                        You Pay<br>
                        <b style="font-size: 22px;font-weight: 500;"><i class="mdi mdi-currency-inr"></i> <span class="grand_total">  <?php echo number_format($total_cost); ?></span></b>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row small-padding">
        <div class="col-md-8">
          <div class="itinerary-container box-shadow mb-3">
            <div class="bdTitle2">Payment</div>
            <div class="white-container">
              <div class="row">
                <div class="col-sm-12">
                  <div class="bold">Cancellation policy</div>
                  <div class="mb-2" style="line-height: 1.49;"><?php echo preg_replace( "/<br>/", "", $roomDetails->cancellation_policy ).'<br>'; ?></div>
                  <p class="mb-0">By proceeding you agree to ours <a href="<?php echo site_url() ?>cms/termsandconditions" class="text-info bold" target="_blank">Terms of Use</a> and <a href="<?php echo site_url() ?>cms/privacypolicy" class="text-info bold" target="_blank">Privacy Policy</a></p>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 text-right">
                  <div class="border-line"></div>
                  <?php if ($this->session->userdata('agent_logged_in')) {
                  if ($deposit_check_status == 1) { ?>
                    <h6 class="red">Your account lacks sufficient funds to complete this booking. You can use the <b>Deposit Management</b> option at the top to add balance to your account.</h6>
                    <input type="hidden" name="payment_type"  value="deposit" checked="checked">
                  <?php } } else { ?>
                  <input type="hidden" name="payment_type" value="payment" checked="checked">
                  <button type="submit" class="btn btn-secondary">Continue</button>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>

<div class="modal fade" id="modalLoginIntinerary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabelIntinerary">Sign In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" data-parsley-validate method="post">
          <div class="form-group">
            <label>Email <span class="text-danger">*</span></label>
            <p class="mb-1 text-danger" id="email_userlogin"></p>
            <input type="email" class="form-control form-group" name="user_email" data-parsley-trigger="change" id="sign_user_email" required>
          </div>
          <div class="form-group">
            <label>Password <span class="text-danger">*</span></label>
            <p class="mb-1 text-danger" id="pass_userlogin"></p>
            <input type="password" class="form-control" name="user_password" id="sign_user_password">
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-secondary btn-block btn-lg" id="userlogin_id">SIGN IN</button>
          </div>
        </form>
        <div>By proceeding you agree to ours <a href="<?php echo site_url() ?>cms/termsandconditions" target="_blank">Terms of use</a> and <a href="<?php echo site_url() ?>cms/privacypolicy" target="_blank">Privacy Policy.</a></div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('home/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>
<script type="text/javascript">
  $('.spcl_req').on('click', function(){
    $('.spcl_req_content').slideToggle();
  });
  $('.imp_note').on('click', function(){
    $('.imp_note_content').slideToggle();
  });
</script>
<!-- <script type="text/javascript">
  $('.pop-content').hide();
  $(document).on('mouseover', '.pophover .pop-i', function() {
    $(this).parent().find('.pop-content').show();
  });
  $(document).on('mouseleave', '.pophover .pop-i', function() {
    $(this).parent().find('.pop-content').hide();
  });
</script> -->

<script type="text/javascript">
  $(document).on('click', '.bdTitle2.active', function(e) {
    var _parents = $(this).parent().parent('.box-parent');
    var _input2 = $('.middle-container').find('.required');
    _input2.removeAttr('required');
    _parents.find('.required').attr('required','true');

    e.preventDefault();
    $(this).parent().parent().parent().find('.middle-container').hide();
    $(this).parent().find('.middle-container').show();
  });
</script>
<script type="text/javascript">
  var Num=/^(0|[1-9][0-9]*)$/;
  var NameTest=/^[a-zA-Z\s]+$/;
  var deciNum= /^[0-9]+(\.\d{1,3})?$/;
  window.Parsley.addValidator('num',  function (value, requirement) {
    return Num.test(value);
  }).addMessage('en', 'num', 'Enter Numberic Value');
  window.Parsley.addValidator('nametest',  function (value, requirement) {
    return NameTest.test(value);
  }).addMessage('en', 'nametest', 'Enter Only Alphabet');

  $('.continuebtn').on('click', function() {
    var $form = $('#continueform');
    var $dataid = $(this).attr('data-id');
    var $parents = $(this).parents('.box-parent');
    if($form.parsley().validate()) {
      // if($dataid == 'continuebtn1') {
      //   var _input = $parents.find('.required');
      //   _input.attr('required','true');
      // }
      var _input = $parents.find('.required');
      _input.attr('required','true');
      validateContainer($parents)
    } else {
      return false;
    }
  });

  function validateContainer($parents){
    console.log(11);
    if($parents.hasClass('one')){
      $('.box-parent.two').find('.required').attr('required','true');
    } else if($parents.hasClass('two')){
      $('.box-parent.three').find('.required').attr('required','true');
    } else if($parents.hasClass('three')){
      // $('.box-parent.four').find('.required').attr('required','true');
    }
    $parents.find('.bdTitle2').addClass('active');
    $parents.find('.middle-container').slideToggle();
    $parents.next('.box-parent').find('.middle-container').slideToggle();
    return false;
  }
</script>