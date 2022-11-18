<?php $this->load->view('home/header');?><?php  $session_data = $this->session->userdata('hotel_search_data');  // $city_arr = explode(',', $session_data['cityName']);  // $cityName = $city_arr[0];  // $adults = $session_data['adults'];  // $childs = $session_data['childs'];  // $childs_ages = $session_data['childs_ages'];  // $adults_count = $session_data['adults_count'];  // $childs_count = $session_data['childs_count'];  $rooms = $session_data['rooms'];  $nights = $session_data['nights'];  $checkinStrTime = strtotime(str_replace('/', '-', $session_data['checkIn']));  $checkoutStrTime = strtotime(str_replace('/', '-', $session_data['checkOut']));  //echo '<pre/>';print_r($session_data['childs_ages']);exit;  if (!empty($roomDetails->image)) {    $gttd = $roomDetails->image;  } else {    $gttd = false;  }  $coupon=0;  if($roomDetails->non_smoking){    $smkoing = 'Non Smoking';  } else {    $smkoing = 'Smoking';  }?><section class="section-padding inner-page">  <div class="container">    <div class="row pt-5 pb-5">      <div class="col-md-12 col-lg-12">        <div class="form_wizard wizard_horizontal">          <ul class="wizard_steps">            <li>              <a href="javascript:;">                <span class="step_no wizard-step">1</span>                <span class="step_descr">Choose your rooms</span>              </a>            </li>            <li class="active_step">              <a href="javascript:;">                <span class="step_no wizard-step">2</span>                <span class="step_descr">Enter your details</span>              </a>            </li>            <li>              <a href="javascript:;">                <span class="step_no wizard-step">3</span>                <span class="step_descr">Secure your booking</span>              </a>            </li>          </ul>        </div>      </div>    </div>    <form name="booking" action="<?php echo site_url(); ?>hotels/reservation?callBackId=<?php echo base64_encode($roomDetails->api); ?>&hotelCode=<?php echo $roomDetails->hotel_code; ?>&searchId=<?php echo $roomDetails->search_id; ?>&sessionId=<?php echo $roomDetails->session_id; ?>" method="POST" id="continueform" data-parsley-validate>      <input type="hidden" name="callBackId" value="<?php echo base64_encode($roomDetails->api); ?>" required>      <input type="hidden" name="hotelCode" value="<?php echo $roomDetails->hotel_code; ?>" required>      <input type="hidden" name="searchId" value="<?php echo $roomDetails->search_id; ?>" required>      <input type="hidden" name="sessionId" value="<?php echo $roomDetails->session_id; ?>" required>      <div class="row">        <div class="col-lg-8 col-md-8">          <div class="itinerary-container box-shadow mb-3">            <div class="bdTitle2">Your booking details</div>            <div class="white-container">              <div class="row">                <div class="col-lg-4 col-md-4">                  <?php if ($gttd) { ?>                  <img src="<?php echo $gttd; ?>" width="100%" height="170" alt="<?php echo $roomDetails->hotel_name; ?>" title="<?php echo $roomDetails->hotel_name; ?>" border="0" style="height: 170px;">                  <?php } else { ?>                  <img src="<?php echo base_url(); ?>public/img/noimage.jpg" width="100%" height="170" alt="No Image" border="0" style="height: 170px;">                  <?php } ?>                </div>                <div class="col-lg-8 col-md-8">                  <div class="row2 hotel-details push-bottom-10">                    <h3><?php echo ucwords(strtolower($roomDetails->hotel_name)); ?> <span class="star star5"></span></h3>                    <small><?php echo ucwords(strtolower($roomDetails->address)); ?></small>                  </div>                </div>              </div>            </div>          </div>          <div class="itinerary-container box-shadow mb-3">            <div class="bdTitle2">Contact Information</div>            <div class="white-container">              <!-- <div class="row">                <div class="col-sm-12">                  <h6 class="mb-1 d-inline-block"><i class="mdi mdi-hand-pointing-right"></i> Login to book faster</h6>                  <button type="button" class="btn border-btn" style="background: #fff;color: #4d74e0;border: 1px solid #4d74e0;"><i class="mdi mdi-lock"></i> Account Login</button>                </div>              </div>              <div class="border-line"></div> -->              <div class="row form-group no-padding">                <div class="col-sm-4">                  <label>Email</label>                  <input type="email" name="user_email" class="form-control" required>                </div>                <div class="col-sm-4">                  <label>Mobile number</label>                  <input type="text" name="user_mobile" class="form-control" required>                </div>              </div>              <div class="row form-group no-padding">                <div class="col-sm-4">                  <label>City</label>                  <input type="text" name="user_city" class="form-control">                </div>                <div class="col-sm-4">                  <label>Pin Code</label>                  <input type="text" name="user_pincode" class="form-control">                </div>                <div class="col-sm-4">                  <label>Country</label>                  <select name="user_country" class="form-control">                    <option value="">Select Country</option>                    <?php foreach ($countries as $country) { ?>                    <option value="<?php echo $country->name; ?>" <?php if($country->name == 'India') echo 'selected' ?>><?php echo $country->name; ?></option>                    <?php } ?>                  </select>                </div>              </div>              <div class="row no-padding">                <div class="col-sm-8">                  <label>Address</label>                  <textarea class="form-control" name="address"></textarea>                </div>              </div>              <div class="border-line"></div>              <span class="input-info">Your booking details will be sent to this email address and mobile number.</span>            </div>          </div>          <div class="itinerary-container box-shadow mb-3">            <div class="bdTitle2">Traveller details</div>            <div class="white-container">              <?php for ($i = 0; $i < $rooms; $i++) { ?>              <div class="row form-group no-padding">                <div class="col-sm-2">                  <label class="invisible">Room</label>                  <div class="bold">Room <?php echo $i+1 ?> :</div>                </div>                <div class="col-sm-2">                  <label>Title</label>                  <select class="form-control" name="adults_title[]" required>                    <option value="">Title</option>                    <option value="Mr">Mr</option>                    <option value="Mrs">Mrs</option>                    <option value="Ms">Ms</option>                  </select>                </div>                <div class="col-sm-4">                  <label>First name</label>                  <input type="text" name="adults_fname[]" class="form-control" required>                </div>                <div class="col-sm-4">                  <label>Last name</label>                  <input type="text" name="adults_lname[]" class="form-control" required>                </div>              </div>              <?php } ?>              <div class="border-line"></div>              <div class="row">                <div class="col-sm-12">                  <span class="bold">Any Special requests?</span>                  <div class="input-info">Special request can't be guaranteed. We will pass these requests to the hotels.</div>                  <a href="javascript:;" class="text-info spcl_req"><i class="mdi mdi-plus"></i> Add your special requests</a>                </div>                <div class="col-sm-5 spcl_req_content" style="display: none;">                  <input type="text" name="" class="form-control">                </div>              </div>            </div>          </div>        </div>        <div class="col-lg-4 col-md-4">          <div class="itinerary-container box-shadow mb-3">            <div class="bdTitle2">Your room details</div>            <div class="white-container">              <table class="rooms-table row2">                <tbody>                  <tr>                    <td>                      <div class="form-label">Check-in</div>                      <table>                        <tr>                          <td style="font-size: 40px"><?php echo date('d', $checkinStrTime) ?></td>                          <td style="font-size: 12px;padding-left: 15px;">                            <?php echo date('l', $checkinStrTime) ?><br><?php echo date('M Y', $checkinStrTime) ?>                          </td>                        </tr>                      </table>                      <div class="form-label">from <?php echo rtrim(rtrim($roomDetails->time_checkin, '00'), ':') ?></div>                    </td>                    <td width="15%" style="font-size: 40px">                      <i class="fa fa-angle-right"></i>                    </td>                    <td>                      <div class="form-label">Check-out</div>                      <table>                        <tr>                          <td style="font-size: 40px"><?php echo date('d', $checkoutStrTime) ?></td>                          <td style="font-size: 12px;padding-left: 15px;">                            <?php echo date('l', $checkoutStrTime) ?><br><?php echo date('M Y', $checkoutStrTime) ?>                          </td>                        </tr>                      </table>                      <div class="form-label">untill <?php echo rtrim(rtrim($roomDetails->time_checkout, '00'), ':') ?></div>                    </td>                  </tr>                </tbody>              </table>              <div class="border-line"></div>              <table class="row2 rooms-table2">                <tbody>                  <tr>                    <td width="30%">                      <div class="form-label">Room :</div>                    </td>                    <td><?php echo $rooms ?> x <?php echo $roomDetails->room_type ?>, <?php echo $smkoing ?> <a href="javascript:;" class="text-info"><u>Change room</u></a></td>                  </tr>                  <tr>                    <td>                      <div class="form-label">Max occupancy :</div>                    </td>                    <td><?php echo $roomDetails->adult_max_occ ?> Adult(s)<?php if($roomDetails->child_max_occ > 0) echo ', '.$roomDetails->child_max_occ.' Child(ren)' ?></td>                  </tr>                  <!-- <tr>                    <td>                      <div class="form-label">Policy :</div>                    </td>                    <td class="text-info"><?php //echo $roomDetails->cancel_policy ?></td>                  </tr> -->                  <!-- <tr>                    <td>                      <div class="form-label">Important Note :</div>                    </td>                    <td class="text-info"><i style="font-size: 20px;" class="fa fa-exclamation-circle imp_note" title="Click to show the details"></i></td>                  </tr> -->                </tbody>              </table>              <!-- <div class="imp_note_content" style="display: none;">                <b class="text-danger">Notes: </b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim eveniet eos, excepturi natus officiis optio commodi dolores, ipsa nulla quam cum temporibus incidunt tenetur molestiae veniam id. Natus, reiciendis pariatur!              </div> -->            </div>          </div>          <div class="itinerary-container box-shadow mb-3">            <div class="bdTitle2">Fare breakup</div>            <div class="white-container">              <div class="fare-breakup">                <table>                  <tbody>                    <tr>                      <td><?php echo $rooms ?> Room(s) x <?php echo $nights ?> Night(s)</td>                      <td><i class="mdi mdi-currency-inr"></i> <?php echo number_format($roomDetails->total_cost); ?></td>                    </tr>                    <tr>                      <td>Taxes &amp; Fees</td>                      <td><i class="mdi mdi-currency-inr"></i> <?php echo number_format($roomDetails->tax_to_send); ?></td>                    </tr>                    <?php if($roomDetails->discount > 0 && !empty($roomDetails->discount)){ ?>                    <tr>                      <td>Save on Today's Deals</td>                      <td style="color:#36c246;">- <i class="mdi mdi-currency-inr"></i> <?php echo number_format($roomDetails->discount); ?></td>                    </tr>                    <?php } ?>                  </tbody>                </table>                <table class="total-fare">                  <tbody>                    <tr>                      <td>Total</td>                      <td>                        You Pay<br>                        <b style="font-size: 22px;font-weight: 500;"><i class="mdi mdi-currency-inr"></i> <span class="grand_total"><?php echo number_format($roomDetails->total_cost-$roomDetails->discount); ?></span></b>                      </td>                    </tr>                  </tbody>                </table>              </div>            </div>          </div>        </div>      </div>      <div class="row small-padding">        <div class="col-md-8">          <div class="itinerary-container box-shadow mb-3">            <div class="bdTitle2">Payment</div>            <div class="white-container">              <div class="row">                <div class="col-sm-12">                  <div class="bold">Cancellation policy</div>                  <div class="mb-2" style="line-height: 1.49;"><?php echo $roomDetails->cancel_policy ?></div>                  <p class="mb-0">By proceeding you agree to ours <a href="javascript:;" class="text-info bold" target="_blank">Terms of Use</a> and <a href="javascript:;" class="text-info bold" target="_blank">Privacy Policy</a></p>                </div>              </div>              <div class="row">                <div class="col-sm-12 text-right">                  <div class="border-line"></div>                  <?php if ($this->session->userdata('agent_logged_in')) {                  if ($deposit_check_status == 1) { ?>                    <h6 class="red">Your account lacks sufficient funds to complete this booking. You can use the <b>Deposit Management</b> option at the top to add balance to your account.</h6>                    <input type="hidden" name="payment_type"  value="deposit" checked="checked">                  <?php } } else { ?>                  <input type="hidden" name="payment_type" value="payment" checked="checked">                  <button type="submit" class="btn btn-secondary">Continue</button>                  <?php } ?>                </div>              </div>            </div>          </div>        </div>      </div>    </form>  </div></section><?php $this->load->view('home/footer'); ?><script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script><script type="text/javascript">  $('.spcl_req').on('click', function(){    $('.spcl_req_content').slideToggle();  });  $('.imp_note').on('click', function(){    $('.imp_note_content').slideToggle();  });</script><!-- <script type="text/javascript">  $('.pop-content').hide();  $(document).on('mouseover', '.pophover .pop-i', function() {    $(this).parent().find('.pop-content').show();  });  $(document).on('mouseleave', '.pophover .pop-i', function() {    $(this).parent().find('.pop-content').hide();  });</script> --><script type="text/javascript">  $(document).on('click', '.bdTitle2.active', function(e) {    var _parents = $(this).parent().parent('.box-parent');    var _input2 = $('.middle-container').find('.required');    _input2.removeAttr('required');    _parents.find('.required').attr('required','true');    e.preventDefault();    $(this).parent().parent().parent().find('.middle-container').hide();    $(this).parent().find('.middle-container').show();  });</script><script type="text/javascript">  var Num=/^(0|[1-9][0-9]*)$/;  var NameTest=/^[a-zA-Z\s]+$/;  var deciNum= /^[0-9]+(\.\d{1,3})?$/;  window.Parsley.addValidator('num',  function (value, requirement) {    return Num.test(value);  }).addMessage('en', 'num', 'Enter Numberic Value');  window.Parsley.addValidator('nametest',  function (value, requirement) {    return NameTest.test(value);  }).addMessage('en', 'nametest', 'Enter Only Alphabet');  $('.continuebtn').on('click', function() {    var $form = $('#continueform');    var $dataid = $(this).attr('data-id');    var $parents = $(this).parents('.box-parent');    if($form.parsley().validate()) {      // if($dataid == 'continuebtn1') {      //   var _input = $parents.find('.required');      //   _input.attr('required','true');      // }      var _input = $parents.find('.required');      _input.attr('required','true');      validateContainer($parents)    } else {      return false;    }  });  function validateContainer($parents){    console.log(11);    if($parents.hasClass('one')){      $('.box-parent.two').find('.required').attr('required','true');    } else if($parents.hasClass('two')){      $('.box-parent.three').find('.required').attr('required','true');    } else if($parents.hasClass('three')){      // $('.box-parent.four').find('.required').attr('required','true');    }    $parents.find('.bdTitle2').addClass('active');    $parents.find('.middle-container').slideToggle();    $parents.next('.box-parent').find('.middle-container').slideToggle();    return false;  }</script>