<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<?php $this->load->view('home/header');
$session_data = $this->session->search_details;
// print_r($session_data);
$user_mobile = $session_data['phone'];
$name = $session_data['name'];
$email = $session_data['email'];
$total_cost = $session_data['total_cost'];
$service_type = $session_data['service_type'];
$whatsapp = $session_data['whatsapp'];
$basefare = $flight_result->basefare;
$tax = $flight_result->tax;
$net_amount = $flight_result->net_amount;
 $segment_indicator = explode(',', $flight_result->segment_indicator);
    $operating_airlinecode = explode(',', $flight_result->operating_airlinecode);
    $operating_airlinename = explode(',', $flight_result->operating_airlinename);
    $operating_flightno = explode(',', $flight_result->operating_flightno);
    $operating_airportname_o = explode(',', $flight_result->operating_airportname_o);
    $operating_terminal_o = explode(',', $flight_result->operating_terminal_o);
    $operating_cityname_o = explode(',', $flight_result->operating_cityname_o);
    $operating_country_o = explode(',', $flight_result->operating_country_o);
    $operating_airportname_d = explode(',', $flight_result->operating_airportname_d);
    $operating_terminal_d = explode(',', $flight_result->operating_terminal_d);
    $operating_cityname_d = explode(',', $flight_result->operating_cityname_d);
    $operating_country_d = explode(',', $flight_result->operating_country_d);
    $operating_deptime = explode(',', $flight_result->operating_deptime);
    $operating_arritime = explode(',', $flight_result->operating_arritime);
    $nonrefundable = $flight_result->nonrefundable;
    $baggageinformation = $flight_result->baggageinformation;
  //print_r($flight_result);


?>

<section class="section-padding pt-0">
  <div class="container">
    <div class="row pt-5 pb-5">
      
    </div>
    <form name="booking" method="POST" 
    action="<?php echo site_url() ?>razorpay/pay.php" id="continueform" data-parsley-validate>
      
      <input type="hidden" name="callBackId" value="<?php echo base64_encode('tbo'); ?>" />
      <input type="hidden" name="searchId" id="searchId" value="<?php echo $flight_result->search_id; ?>" />
      <input type="hidden" name="email" value="<?php echo $email; ?>" />
      <input type="hidden" name="total_cost" value="<?php echo $total_cost; ?>" />
      <input type="hidden" name="service_type" value="<?php echo $service_type; ?>" />
      <input type="hidden" name="phone" value="<?php echo $user_mobile; ?>" />
      <input type="hidden" name="segmentkey" id="segmentkey" value="<?php echo $flight_result->segmentkey; ?>" />

      <?php if ($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true') { ?>
      <input type="hidden" name="searchId1" id="searchId1" value="<?php echo $flight_result_r->search_id; ?>" />
      <input type="hidden" name="segmentkey1" id="segmentkey1" value="<?php echo $flight_result_r->segmentkey; ?>" />
      <?php } ?>

      <div class="row">
        <div class="col-lg-12 col-md-12 box-parent one opened" style="margin-top: 15px;">
          <div class="card">
            <h5 class="mb-0 bdTitle2 one"><span>1</span> Confirm Booking <i class="mdi mdi-check"></i></h5>
            <div class="card-body middle-container">
              <div class="row no-gutters">
                <div class="col-lg-8 col-md-8">
                 <!--  <label class="badge badge-info px-2 py-1">Onward <i class="mdi mdi-airplane"></i></label> -->
                  <div class="itinerary-box">
                    <span class="flt-criteria d-block mr-2"> <?php echo current($operating_cityname_o);  ?>  →  <?php echo end($operating_cityname_d); ?>
                      
                     ( <?php echo $flight_result->operating_arritime?> → 
                      <?php echo $flight_result->operating_deptime?>)

                    </span>
                    <div class="card-title minwidth1">
                        
                        <small class="d-block"></small>
                    </div>
                   <div class="row no-padding form-group">
                    <div class="col-md-2 col-sm-4 col-xs-6">Adult Name</div>
                    <div class="col-md-4 col-sm-8 col-xs-6">
                      <?php echo $name ?>
                    </div>
                  </div>
                    <div class="row no-padding form-group">
                      <div class="col-md-2 col-sm-4 col-xs-6">Mobile Number</div>
                      <div class="col-md-4 col-sm-8 col-xs-6">
                        <?php echo $user_mobile ?>
                      </div>
                  </div>
                  <div class="row no-padding form-group">
                      <div class="col-md-2 col-sm-4 col-xs-6">WhatsApp Itinerary</div>
                      <div class="col-md-4 col-sm-8 col-xs-6">
                        <?php echo $whatsapp ?>
                      </div>
                  </div>
                   <div class="row no-padding form-group">
                      <div class="col-md-2 col-sm-4 col-xs-6">Email</div>
                      <div class="col-md-4 col-sm-8 col-xs-6">
                        <?php echo $email ?>
                      </div>
                  </div>
                  <div class="row no-padding form-group">
                      <div class="col-md-2 col-sm-4 col-xs-6">Fare Break Up</div>
                      <div class="col-md-4 col-sm-8 col-xs-6">
                        <?php echo number_format(round($basefare)); ?>
                      </div>
                  </div>
                  <div class="row no-padding form-group">
                      <div class="col-md-2 col-sm-4 col-xs-6">Taxes &amp; Fees</div>
                      <div class="col-md-4 col-sm-8 col-xs-6">
                        <?php echo number_format(round($tax)); ?>
                      </div>
                  </div>
                   <div class="row no-padding form-group">
                      <div class="col-md-2 col-sm-4 col-xs-6">Net Amount</div>
                      <div class="col-md-4 col-sm-8 col-xs-6">
                        <?php echo number_format(round($net_amount)); ?>
                      </div>
                  </div>
                  <div class="row no-padding form-group">
                      <div class="col-md-2 col-sm-4 col-xs-6">Total Cost</div>
                      <div class="col-md-4 col-sm-8 col-xs-6">
                        <?php echo number_format($total_cost) ?>
                      </div>
                  </div>
                   <?php if(!empty($baggageinformation)){ ?>
                   <div class="row no-padding form-group">
                      <div class="col-md-2 col-sm-4 col-xs-6">Baggage Info</div>
                      <div class="col-md-4 col-sm-8 col-xs-6">
                       <?php echo $baggageinformation; ?>
                      </div>
                  </div>
                    <?php } ?>
                <div class="row no-padding">
                <div class="col-md-12 col-lg-12"><button type="submit" class="btn btn-primary">CONTINUE</button></div>
                 </form>
                </div>
                  <?php
                 
                    $result_r = $flight_result_r;
                    $Origin = $result_r->origin;
                    $Destination = $flight_result->destination;
                    $fromCityName = $this->Tbo_Model->get_airport_cityname($Origin);
                    $toCityName = $this->Tbo_Model->get_airport_cityname($Destination);
                    $operating_airlinecode = explode(',', $result_r->operating_airlinecode);
                    $operating_airlinename = explode(',', $result_r->operating_airlinename);
                    $operating_flightno = explode(',', $result_r->operating_flightno);
                    
                  ?>
                  
             
            </div>
          </div>
        </div>
         
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>




<?php $this->load->view('home/footer'); ?>


