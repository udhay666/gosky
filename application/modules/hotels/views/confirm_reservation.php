<?php $this->load->view('home/home_template/header');?>
<style type="text/css">
   
    .error
    {
        color: Red;
        visibility: hidden;
    }
</style>
<?php
  $pass_info    = $this->session->passenger_info;
  $session_data = unserialize($room_data->searcharray);
  $adults = $session_data['adults'];
  $childs = $session_data['childs'];

    $rooms = $session_data['rooms'];
    $nights = $session_data['nights'];
    if (!empty($room_data->hotel_image)) {
        $image_name = explode(',', $room_data->hotel_image);
    } else {
        $image_name = '';
    }
    $gttd = $image_name[0];

//print_r( $session_data );exit;
 //echo '<pre/>';print_r($room_data);exit;

?>

<section class="section-padding inner-page">
  <div class="container">
    <div class="row pt-5 pb-5">
      <div class="col-md-12 col-lg-12">
        <div class="form_wizard wizard_horizontal">
           <ul class="wizard_steps">
            <li class="active_step">
              <a href="javascript:;">
                <span class="step_no wizard-step"><i class="mdi mdi-check"></i></span>
                <span class="step_descr"></span>
              </a>
            </li>
            <li class="active_step">
              <a href="javascript:;">
                <span class="step_no wizard-step"></span>
                <span class="step_descr"></span>
              </a>
            </li>
            <li>
              <a href="javascript:;">
                <span class="step_no wizard-step"></span>
                <span class="step_descr"></span>
              </a>
            </li>
          </ul> 
        </div>
      </div>
    </div>
    <form name="booking" method="POST" action="<?php echo site_url() ?>razorpay/pay.php" >
    
    <input type="hidden" name="callBackId" value="<?php echo $pass_info['callBackId']; ?>" required />
    <input type="hidden" name="hotelCode" value="<?php echo $pass_info['hotelCode']; ?>" required />
    <input type="hidden" name="searchId" value="<?php echo $pass_info['searchId']; ?>" required />
    <input type="hidden" name="sessionId" value="<?php echo $pass_info['sessionId']; ?>" required />
    <input type="hidden" name="email" value="<?php echo $pass_info['user_email']; ?>" />
    <input type="hidden" name="user_mobile" value="<?php echo $pass_info['mobilecountryCode'].$pass_info['user_mobile']; ?>" class="form-control" required>
    <input type="hidden" name="service_type" value="1" />
      
      <input type="hidden" name="amount" id="amount" value="<?php echo $room_data->total_cost; ?>" />

      <div class="row">
        <div class="col-lg-8 col-md-8">
          <div class="itinerary-container box-shadow mb-3">
            <div class="bdTitle2">Your booking details</div>
            <div class="white-container">
              <div class="row">
                 <div class="col-lg-4 col-md-4">
                   <?php if ($gttd) { ?>
                  <img src="<?php echo $gttd; ?>" width="100%" height="170" alt="<?php echo $room_data->hotel_name; ?>" title="<?php echo $room_data->hotel_name; ?>" border="0" style="height: 170px;">
                  <?php } else { ?>
                  <img src="<?php echo base_url(); ?>public/img/noimage.jpg" width="100%" height="170" alt="No Image" border="0" style="height: 170px;">
                  <?php } ?>
                </div> 
                <div class="col-lg-8 col-md-8">
                  <div class="row2 hotel-details push-bottom-10">
                    <h3><?php echo ucwords(strtolower($room_data->hotel_name_unique)); ?> <span class="star star5"></span></h3>
                    <small><?php echo ucwords(strtolower($room_data->address)); ?></small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="login-box" class="itinerary-container box-shadow mb-3">
            <div class="bdTitle2">Contact Information</div>
            <div class="white-container">
              <div class="row" id="itinerary-login" >
                <div class="col-sm-12">
                  <p><b><i class="mdi mdi-hand-pointing-right"></i> Login to book faster</b> <a class="btn border-btn" href="#" data-toggle="modal" data-target="#modalLoginIntinerary" style="background: #fff;color: #4d74e0;border: 1px solid #4d74e0;"><i class="mdi mdi-account"></i> Account Login</a></p>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="border-line"></div>
                  </div>
                </div>
              </div>
              <div class="row form-group no-padding">
                <div class="col-sm-4">
                  <label>Email :</label>
                 <?php echo $pass_info['user_email'] ?>
                </div>
                <div class="col-sm-4">
                  <label>Mobile number :</label>
                   <?php echo $pass_info['user_mobile'] ?>
                </div>
                
                
              </div>
              <div class="row form-group no-padding">
                <div class="col-sm-4">
                  <label>City :</label>
                  <?php echo $pass_info['user_city'] ?>
                </div>
                <div class="col-sm-4">
                  <label>Pin Code :</label>
                 <?php echo $pass_info['user_pincode'] ?>
                </div>
                <div class="col-sm-4">
                  <label>Country :</label>
                   <?php echo $pass_info['user_country'] ?>
                </div>
              </div>
              <div class="row no-padding">
                <div class="col-sm-8">
                  <label>Address :</label>
                 <?php echo $pass_info['address'] ?>
                </div>
              </div>
              <div class="border-line"></div>
              <span class="input-info">Your booking details will be sent to this email address and mobile number.</span>
            </div>
          </div>
          <div class="itinerary-container box-shadow mb-3">
            <div class="bdTitle2">Traveller details</div>
            <div class="white-container">
            
              <div class="row form-group no-padding">
              <!-- <div class="col-sm-2">
                  <label class="invisible">Room</label>
                  <div class="bold">Room  :</div>
                </div> -->
                <div class="col-sm-4">
                  <label>Title:</label>
                    <?php echo $pass_info['adults_title'][0]." ". $pass_info['adults_fname'][0]." ".$pass_info['adults_lname'][0];?>
                </div>               
                 <?php if(!empty($pass_info['Pan_no'][0])){?>
                 <div class="col-sm-4">
                  <label>Pan number :</label>
                    <?php echo $pass_info['Pan_no'][0];?>
                </div> 
                <?php }?>
                <?php if(!empty($pass_info['Pass_no'][0])){?>
                  <div class="col-sm-4">
                  <label>Passport number</label>
                  
                  <?php echo $pass_info['Pass_no'][0];?>
            </div> 

                
                 
                <div class="col-sm-4">
                  <label>Passport Expiry Date</label>                  
                 
                  
                </div>

                <div class="col-sm-4">
                  <label>Month</label>                  
                 
                  
                </div>


                 <div class="col-sm-4">
                  <label>Year</label>                  
             
                  
                </div>
       <?php }?>           
              </div>
              

               
                 
              <!-- <div class="row form-group no-padding">
              <div class="col-sm-2">
                  <label class="invisible">Room</label>
                  <div class="bold">Room  :</div>
                </div>
                    <div class="col-sm-2">
                      <label>Title</label>
                      
                    </div>
                    <div class="col-sm-4">
                      <label>First name</label>
                      
                    </div>
                    <div class="col-sm-4">
                      <label>Last name</label>
                     
                    </div>
              </div> -->
                 
              <!-- <div class="border-line"></div> -->
              
               <div class="row">
                <div class="col-sm-12">
                  <div class="border-line"></div>
                 
                    
                    <input type="hidden" name="payment_type"  value="deposit" checked="checked">
                  
                  <input type="hidden" name="payment_type" value="payment" checked="checked">
                  <button type="submit" class="btn btn-secondary">Continue</button>
                 
                </div>
              </div>
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
                    <td><?php echo $rooms ?> x <?php echo $room_data->room_type ?></td>
                  </tr>
                
                 
                </tbody>
              </table>
              
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
                      <td><i class="mdi mdi-currency-inr"></i><?php echo number_format($room_data->total_cost - ($room_data->admin_markup + $room_data->payment_charge)); ?> </td>
                    </tr>
                    <tr>
                      <td>Service &amp; Fees</td>
                      <td><i class="mdi mdi-currency-inr"></i> <?php echo number_format($room_data->admin_markup + $room_data->payment_charge); ?>  </td>
                    </tr>
                  </tbody>
                </table>
                <table class="total-fare">
                  <tbody>
                    <tr>
                      <td>Total</td>
                      <td>
                        You Pay<br>
                        <b style="font-size: 22px;font-weight: 500;"><i class="mdi mdi-currency-inr"></i> <span class="grand_total"> <?php echo number_format($room_data->total_cost); ?></span></b>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!--   <div class="row small-padding">
        <div class="col-md-8">
           <div class="itinerary-container box-shadow mb-3">
           <div class="bdTitle2">Payment</div>
          <div class="white-container">
              <div class="row">
             
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="border-line"></div>
                 
                    
                    <input type="hidden" name="payment_type"  value="deposit" checked="checked">
                  
                  <input type="hidden" name="payment_type" value="payment" checked="checked">
                  <button type="submit" class="btn btn-secondary">Continue</button>
                 
                </div>
              </div>
             </div>
          </div> 
        </div>
      </div> -->
    </form>
  </div>
</section>
<?php exit;?>


<?php $this->load->view('home/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>