<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<?php $this->load->view('home/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/style.css">
<?php
    $sess_data = unserialize($flight_result->searcharray);
    $sess_origin = $sess_data['fromCity'];
    $sess_origincity = explode(' -', $sess_origin);
    $sess_desti = $sess_data['toCity'];
    $sess_desticity = explode(' -', $sess_desti);
    $sess_departDate = $sess_data['departDate'];
    $sess_returnDate = $sess_data['returnDate'];

    $Origin = $flight_result->origin;
    $Destination = $flight_result->destination;
    $isdomestic = $flight_result->isdomestic;
    $fromCityName = $this->Tripjack_Model->get_airport_cityname($Origin);
    $toCityName = $this->Tripjack_Model->get_airport_cityname($Destination);
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
    if ($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true') {
        $baser = $flight_result_r->basefare;
        $taxr = $flight_result_r->tax+$flight_result_r->admin_markup+$flight_result_r->agent_markup+$flight_result_r->payment_charge;
        $convinience_feer = $flight_result_r->payment_charge;
        $totalr = $flight_result_r->total_amount;
        $agentmmarkr = $flight_result_r->agent_markup;
    } else {
        $baser = 0;
        $taxr = 0;
        $convinience_feer = 0;
        $totalr = 0;
        $agentmmarkr = 0;
    }
    $basefare = $flight_result->basefare + $baser;
    $tax = $flight_result->tax+$flight_result->admin_markup+$flight_result->agent_markup+$flight_result->payment_charge + $taxr;

    $convinience_fee = $flight_result->payment_charge + $convinience_feer;
    $total_amount = $flight_result->total_amount + $totalr;
    $currency = $flight_result->currency;
    $agent_markup = $flight_result->agent_markup + $agentmmarkr;

    ///Special Request
    // $error_rs = $ssrresponsex->Response->Error->ErrorCode;
    $lcc = $flight_result->islcc;
    // echo $lcc;
    // echo '<pre>'; print_r($ssrresponsex->Response);exit;
    if ($lcc == 0) {
        // $baggage_rs = $ssrresponsex->Response->Baggage;
        //$meal_rs = $ssrresponsex->Response->Meal;
        $baggage_rs = '';
        $meal_rs = '';
        if(!empty($meal_rs)) {
            $meal_options = '<option data-price="0" value='.$meal_rs[0]->Code.' selected>No Meal</option>';
            for ($i=0; $i < (count($meal_rs)-1) ; $i++) { 
                $meal_options .= '<option data-price="'.$meal_rs[$i+1]->Price.'" value='.$meal_rs[$i+1]->Code.'>'.$meal_rs[$i+1]->AirlineDescription.' - INR '.$meal_rs[$i+1]->Price.'</option>';
            }
        }
        if(!empty($baggage_rs)) {
            $baggage_options = '<option data-price="0" value='.$baggage_rs[0]->Code.' selected>No Baggage</option>';
            for ($i=0; $i < (count($baggage_rs)-1); $i++) {
                $baggage_options .= '<option data-price="'.$baggage_rs[$i+1]->Price.'" value='.$baggage_rs[$i+1]->Code.'>'.$baggage_rs[$i+1]->Weight.' KG - INR '.$baggage_rs[$i+1]->Price.'</option>';
            }
        }
    } else {
        //$baggage_rs = $ssrresponsex->Response->Baggage[0];
        //$meal_rs = $ssrresponsex->Response->MealDynamic[0];
        $meal_rs = $baggage_rs='';
        if(!empty($meal_rs)) {
            $meal_options = '<option data-price="0" value='.$meal_rs[0]->Code.' selected>No Meal</option>';
            for ($i=0; $i < (count($meal_rs)-1) ; $i++) { 
                $meal_options .= '<option data-price="'.$meal_rs[$i+1]->Price.'" value='.$meal_rs[$i+1]->Code.'>'.$meal_rs[$i+1]->AirlineDescription.' - INR '.$meal_rs[$i+1]->Price.'</option>';
            }
        }

        if(!empty($baggage_rs)) {
            $baggage_options = '<option data-price="0" value='.$baggage_rs[0]->Code.' selected>No Baggage</option>';
            for ($i=0; $i < (count($baggage_rs)-1); $i++) {
                $baggage_options .= '<option data-price="'.$baggage_rs[$i+1]->Price.'" value='.$baggage_rs[$i+1]->Code.'>'.$baggage_rs[$i+1]->Weight.' KG - INR '.$baggage_rs[$i+1]->Price.'</option>';
            }
        }
    }

    // echo '<pre>'; print_r($ssrresponsex->Response->Meal);//exit;
    // echo '3<pre>'; print_r($meal_options);exit;
    $gstallowed=$gstmandatory=true;
    if($flight_result->gstallowed=='1'){
      $gstallowed=true;
    }
    if($flight_result->gstmandatory=='1'){
      $gstmandatory=true;
    }

    $dobnationality=0;
    $pass_info = $this->session->userdata('passenger_info');

?>
<section class="section-padding pt-0">
  <div class="container">
    <div class="row pt-5 pb-5">
      <div class="col-md-12 col-lg-12">
        <div class="form_wizard wizard_horizontal">
          <ul class="wizard_steps">
            <li class="active_step">
              <a href="javascript:;">
                <span class="step_no wizard-step"><i class="mdi mdi-check"></i></span>
                <span class="step_descr">Itinerary</span>
              </a>
            </li>
            <li class="active_step">
              <a href="javascript:;">
                <span class="step_no wizard-step">2</span>
                <span class="step_descr">Travellers</span>
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
    <form name="booking" method="POST" action="<?php echo site_url() ?>flights/payment_process" id="continueform" data-parsley-validate>
      <input type="hidden" name="callBackId" value="<?php echo base64_encode('tbo'); ?>" />
      <input type="hidden" name="searchId" id="searchId" value="<?php echo $flight_result->search_id; ?>" />
      <input type="hidden" name="segmentkey" id="segmentkey" value="<?php echo $flight_result->segmentkey; ?>" />
      <div class="row">
        <div class="col-lg-12 col-md-12 box-parent one opened">
          <div class="card">
            <h5 class="mb-0 bdTitle2 one"><span>1</span> Itinerary <i class="mdi mdi-check"></i></h5>
            <div class="card-body itinerary-container middle-container">
              <div class="row no-gutters">
                <div class="col-lg-8 col-md-8">
                <label class="badge badge-info px-2 py-1">Onward <i class="mdi mdi-airplane"></i></label>
                  <span class="flt-criteria d-block mr-2"> <?php echo current($operating_cityname_o);  ?> →   <?php echo end($operating_cityname_d); ?> ( <?php echo date('j M Y', strtotime($this->Tripjack_Model->getDate_TimeFromDateTime($operating_deptime[0], 'date'))); ?>)</span>
                  <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { 
                    if($operating_airlinecode[$j] =='I5'){
                        $dobnationality=1;
                      }
                  ?>
                   <?php if ($segment_indicator[$j] == '1') { ?>

                  <div class="d-flex justify-content-between flex-wrap align-content-around text-center pr-2 itinerary-box mt-3">
                    <div class="card-title minwidth1">
                      <img src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[$j]; ?>.gif" alt="flight logo">
                      <small class="d-block"><?php echo $operating_airlinename[$j]; ?> <?php echo $operating_airlinecode[$j]; ?> - <?php echo $operating_flightno[$j]; ?></small>
                    </div>
                    <div class="card-title minwidth2"> 
                    <?php echo $operating_cityname_o[$j];  ?>                   
                    <small class="d-block">
                    <?php
                      $dep = explode('T', $operating_deptime[$j]);
                      $dep[1] = substr($dep[1], 0, -3);
                      echo $dep[1]; 
                    ?></small>
                    <small class="d-block"><?php echo date('j M Y', strtotime($this->Tripjack_Model->getDate_TimeFromDateTime($operating_deptime[$j], 'date'))); ?></small><small class="d-block"><?php echo $this->Flights_Model->get_airport_name($operating_airportname_o[$j]); ?>, <?php if ($operating_terminal_o[$j] != '') echo $operating_terminal_d[$j]; ?></small></div>

                    <div class="card-title minwidth1"><i class="mdi mdi-clock d-block"></i> 
                    <?php  if($j==0){ ?> 
                      <span class="flight-dur"><?php echo floor($flight_result->duration / 60).'h:'.($flight_result->duration - floor($flight_result->duration / 60) * 60).'m';   ?></span>
                      <?php } ?>
                    </div>

                    <div class="card-title minwidth2">
                    <?php echo $operating_cityname_d[$j]; ?>
                    <small class="d-block">
                      <?php
                      $dep = explode('T', $operating_arritime[$j]);
                      $dep[1] = substr($dep[1], 0, -3);
                      echo $dep[1]; 
                      ?>
                    </small>
                    <small class="d-block"><?php echo date('j M Y', strtotime($this->Tripjack_Model->getDate_TimeFromDateTime($operating_arritime[$j], 'date'))); ?></small><small class="d-block"><?php echo $this->Flights_Model->get_airport_name($operating_airportname_d[$j]); ?>,<?php  if ($operating_terminal_o[$j] != '') echo $operating_terminal_d[$j]; ?></small></div>
                  </div>
                  <?php } ?>
                  <?php } ?>


                  <!-- DOMESTIC ROUNDTRIP -->
                  <?php
                  if ($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true') {
                      $result_r = $flight_result_r;
                      $Origin = $result_r->origin;
                      $Destination = $flight_result->destination;
                      $fromCityName = $this->Tripjack_Model->get_airport_cityname($Origin);
                      $toCityName = $this->Tripjack_Model->get_airport_cityname($Destination);
                      $operating_airlinecode = explode(',', $result_r->operating_airlinecode);
                      $operating_airlinename = explode(',', $result_r->operating_airlinename);
                      $operating_flightno = explode(',', $result_r->operating_flightno);
                      $operating_airportname_o = explode(',', $result_r->operating_airportname_o);
                      $operating_terminal_o = explode(',', $result_r->operating_terminal_o);
                      $operating_cityname_o = explode(',', $result_r->operating_cityname_o);
                      $operating_country_o = explode(',', $result_r->operating_country_o);
                      $operating_airportname_d = explode(',', $result_r->operating_airportname_d);
                      $operating_terminal_d = explode(',', $result_r->operating_terminal_d);
                      $operating_cityname_d = explode(',', $result_r->operating_cityname_d);
                      $operating_country_d = explode(',', $result_r->operating_country_d);
                      $operating_deptime = explode(',', $result_r->operating_deptime);
                      $operating_arritime = explode(',', $result_r->operating_arritime);

///Special Request
// echo '<pre>'; print_r($ssrresponsex1->Response);exit;
                      //$error_rs_r = $ssrresponsex1->Response->Error->ErrorCode;
                      $lcc = $result_r->islcc;
                     
                      ?>
                      <label class="badge badge-info px-2 py-1 mt-4">Return <i class="mdi mdi-airplane"></i></label>
                  <span class="flt-criteria d-block mr-2"> <?php echo current($operating_cityname_o);  ?> →   <?php echo end($operating_cityname_d); ?> ( <?php echo date('j M Y', strtotime($this->Tripjack_Model->getDate_TimeFromDateTime($operating_deptime[0], 'date'))); ?>)</span>
                  <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { ?>
                   <?php if ($segment_indicator[$j] == '1') { ?>

                  <div class="d-flex justify-content-between flex-wrap align-content-around text-center pr-2 itinerary-box mt-3">
                    <div class="card-title minwidth1">
                      <img src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[$j]; ?>.gif" alt="flight logo">
                      <small class="d-block"><?php echo $operating_airlinename[$j]; ?> <?php echo $operating_airlinecode[$j]; ?> - <?php echo $operating_flightno[$j]; ?></small>
                    </div>
                    <div class="card-title minwidth2"> 
                    <?php echo $operating_cityname_o[$j];  ?>                   
                    <small class="d-block">
                    <?php
                      $dep = explode('T', $operating_deptime[$j]);
                      $dep[1] = substr($dep[1], 0, -3);
                      echo $dep[1]; 
                    ?></small>
                    <small class="d-block"><?php echo date('j M Y', strtotime($this->Tripjack_Model->getDate_TimeFromDateTime($operating_deptime[$j], 'date'))); ?></small><small class="d-block"><?php echo $this->Flights_Model->get_airport_name($operating_airportname_o[$j]); ?>, <?php if ($operating_terminal_o[$j] != '') echo $operating_terminal_d[$j]; ?></small></div>

                    <div class="card-title minwidth1"><i class="mdi mdi-clock d-block"></i> 
                    <?php  if($j==0){ ?> 
                      <span class="flight-dur"><?php echo floor($flight_result->duration / 60).'h:'.($flight_result->duration - floor($flight_result->duration / 60) * 60).'m';   ?></span>
                      <?php } ?>
                    </div>

                    <div class="card-title minwidth2">
                    <?php echo $operating_cityname_d[$j]; ?>
                    <small class="d-block">
                      <?php
                      $dep = explode('T', $operating_arritime[$j]);
                      $dep[1] = substr($dep[1], 0, -3);
                      echo $dep[1]; 
                      ?>
                    </small>
                    <small class="d-block"><?php echo date('j M Y', strtotime($this->Tripjack_Model->getDate_TimeFromDateTime($operating_arritime[$j], 'date'))); ?></small><small class="d-block"><?php echo $this->Flights_Model->get_airport_name($operating_airportname_d[$j]); ?>,<?php  if ($operating_terminal_o[$j] != '') echo $operating_terminal_d[$j]; ?></small></div>
                  </div>
                  <?php } ?>
                  <?php } ?>
                    <?php } ?>

                </div>
                <div class="col-lg-4 col-md-4">
                  <div class="fare-breakup pl-2">
                    <span class="flt-criteria d-block">Fare breakup</span>
                    <table>
                      <tbody>
                        <tr>
                          <td>Base fare</td>
                          <td>INR  <?php echo number_format(round($basefare)); ?></td>
                        </tr>
                        <tr>
                          <td>Taxes &amp; Fees</td>
                          <td>INR <?php echo number_format(round($tax)); ?></td>
                        </tr>
                        <tr>
                          <td>Total</td>
                          <td>INR <?php echo number_format($total_amount); ?></td>
                        </tr>
                        <tr>
                          <td>
                            <a class="checkRules" href="#" data-toggle="modal" data-target="#modalCheckRules" data-searchid=""><strong><i class="mdi mdi-format-list-bulleted"></i> Fare Rules</strong></a>
                          </td>
                          <td><label class="badge badge-success px-2 py-1"><?php if ($nonrefundable == '1') echo 'REFUNDABLE'; else echo 'NON REFUNDABLE'; ?></label></td>
                        </tr>
                        <?php if(!empty($baggageinformation)){ ?>
                        <tr>
                          <td>Baggage Info</td>
                          <td>Weight: <?php echo $baggageinformation; ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row no-padding mt-4">
                <div class="col-md-2 col-sm-4 col-xs-6">Your email address</div>
                <div class="col-md-4 col-sm-8 col-xs-6">
                  <!-- <input type="email" name="user_email" class="form-control required" data-parsley-trigger="change" required> -->
                  <?php echo $pass_info['user_email'];?>
                </div>
                <!-- <div class="col-md-4 col-sm-8 col-xs-6">
                  <button type="button" data-id="continuebtn1" class="btn btn-primary continuebtn py-2">Continue <i class="mdi mdi-chevron-double-right"></i></button>
                </div> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 box-parent two closed">
          <div class="card">
            <h5 class="mb-0 bdTitle2 two"><span>2</span> Travellers <i class="mdi mdi-check"></i></h5>
            <div class="card-body itinerary-container middle-container pax-details">
              <div class="row">
                <div class="control-group col-lg-6 col-md-6">
                  <div class="controls">Make sure the names you enter match the way they appear on your passport.</div>
                </div>
                <div class="control-group col-lg-6 col-md-6 text-right">
                  <div class="controls">
                    <a href="<?php echo site_url(); ?>flights/muiti_itinerary?callBackId=<?php echo base64_encode('tbo'); ?>&searchId=<?php echo $flight_result->search_id; ?>&segmentkey=<?php echo $flight_result->segmentkey; ?>">Edit details</a>
                  </div>
                </div>
              </div>
              <?php for ($a = 0; $a < $flight_result->adults; $a++) { ?>
              <div class="BkdtrvlrDtls">
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">Adult <?php echo $a + 1; ?></div>
                  <div class="col-md-10 col-sm-9 col-xs-8 form-group">
                    <!-- <select class="form-control required" name="adultTitle[]">
                      <option value="">Title</option>
                      <option value="Mr">Mr</option>
                      <option value="Mrs">Mrs</option>
                      <option value="Ms">Ms</option>
                    </select> -->
                    <?php echo $pass_info['adultTitle'][$a];?> <?php echo $pass_info['adultFName'][$a];?> <?php echo $pass_info['adultLName'][$a];?>
                  </div>
                  <!-- <div class="col-md-3 col-sm-3 col-xs-4 form-group">
                    <input type="text" name="adultFName[]" class="form-control required" placeholder="First Name" id="adultf<?= $a ?>"  data-parsley-trigger="change" data-parsley-pattern="^[A-Za-z]*$"/>
                    
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-4 form-group">
                    <input type="text" name="adultLName[]" class="form-control required" placeholder="Last Name" data-parsley-trigger="change" data-parsley-pattern="^[A-Za-z]*$" data-parsley-notequalto="#adultf<?= $a ?>"/>
                    
                  </div> -->
                </div>
              
                <?php if($flight_result->isdomestic=='false' || $dobnationality==1){  ?>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Date of Birth</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <?php echo $pass_info['adultDOBDate'][$a].'/'.$pass_info['adultDOBMonth'][$a].'/'.$pass_info['adultDOBYear'][$a];?>
                    <!-- <select class="form-control required" name="adultDOBDate[]">
                      <option value="">Day</option>
                      <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select> -->
                  </div>
                  <!-- <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="adultDOBMonth[]">
                      <option value="">Month</option>
                      <?php for ($ag = 1; $ag <= 12; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6">
                    <select class="form-control required" name="adultDOBYear[]">
                      <option value="">Year</option>
                      <?php for ($ag = 1930; $ag <= (date('Y') - 12); $ag++) {?>
                      <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                      <?php }?>
                    </select>
                  </div> -->
                </div>

                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Nationality</div>
                  <div class="col-md-4 col-sm-8 col-xs-6 form-group">
                    <!-- <select class="form-control required" name="adultPPNationality[]">
                      <option value="">Nationality</option>
                      <?php foreach($country_list as $con) {?>
                      <option value="<?php echo $con->iso2;?>"><?php echo $con->name;?></option>
                      <?php } ?>
                    </select> -->
                    <?php echo $pass_info['adultPPNationality'][$a];?>
                  </div>
                </div>
                <?php } ?>
                <?php if($flight_result->isdomestic=='false'){  ?>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Passport Number</div>
                  <div class="col-md-4 col-sm-8 col-xs-6 form-group">
                    <!-- <input type="text" name="adultPPNo[]" class="form-control required" placeholder="Passport Number" /> -->
                    <?php echo $pass_info['adultPPNo'][$a];?>
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Passport Issue Date</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <!-- <select class="form-control required" name="adultPPIDate[]">
                      <option value="">Day</option>
                      <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select> -->
                    <?php echo $pass_info['adultPPIDate'][$a].'/'.$pass_info['adultPPIMonth'][$a].'/'.$pass_info['adultPPIYear'][$a];?>
                  </div>
                  <!-- <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="adultPPIMonth[]">
                      <option value="">Month</option>
                      <?php for ($ag = 1; $ag <= 12; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6">
                    <select class="form-control required" name="adultPPIYear[]">
                      <option value="">Year</option>
                      <?php for ($ag = 2000; $ag <= (date('Y')); $ag++) {?>
                      <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                      <?php }?>
                    </select>
                  </div> -->
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Passport Expiry Date</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <!-- <select class="form-control required" name="adultPPEDate[]">
                      <option value="">Day</option>
                      <?php for ($ap = 1; $ap <= 31; $ap++) { ?>
                      <option value="<?php echo str_pad($ap, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ap, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select> -->
                    <?php echo $pass_info['adultPPEDate'][$a].'/'.$pass_info['adultPPEMonth'][$a].'/'.$pass_info['adultPPEYear'][$a];?>
                  </div>
                  <!-- <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="adultPPEMonth[]">
                      <option value="">Month</option>
                      <?php for ($ag = 1; $ag <= 12; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="adultPPEYear[]">
                      <option value="">Year</option>
                      <?php for ($ag = date('Y'); $ag <= (date('Y') + 200); $ag++) {?>
                      <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                      <?php }?>
                    </select>
                  </div> -->
                </div>
                <div class="row no-padding form-group">
                  <div class="col-md-2 col-sm-4 col-xs-6">Passport Issue Country</div>
                  <div class="col-md-4 col-sm-8 col-xs-6">
                    <!-- <select class="form-control required" name="adultPPICountry[]">
                      <option value="">Place of Issue</option>
                      <?php foreach ($country_list as $con) {?>
                      <option value="<?php echo $con->iso2; ?>"><?php echo $con->name; ?></option>
                      <?php }?>
                    </select> -->
                    <?php echo $pass_info['adultPPICountry'][$a];?>
                  </div>
                </div>
                <?php } ?>
              </div>
              <?php }?>
              <?php if($flight_result->childs != 0) {?>
              <?php for ($c = 0; $c < $flight_result->childs; $c++) { ?>
              <div class="BkdtrvlrDtls">
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">Child <?php echo $c + 1; ?></div>
                  <div class="col-md-10 col-sm-9 col-xs-8 form-group">
                    <!-- <select class="form-control required" name="childTitle[]">
                      <option value="">Title</option>
                      <option value="Mstr">Mstr</option>
                      <option value="Miss">Miss</option>
                    </select> -->
                    <?php echo $pass_info['childTitle'][$c];?> <?php echo $pass_info['childFName'][$c];?> <?php echo $pass_info['childLName'][$c];?>
                  </div>
                  <!-- <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                    <input type="text" name="childFName[]" class="form-control required" placeholder="First Name" id="childf<?= $c ?>" data-parsley-trigger="change" data-parsley-pattern="^[A-Za-z]*$" />
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                    <input type="text" name="childLName[]" class="form-control required" placeholder="Last Name" data-parsley-trigger="change" data-parsley-pattern="^[A-Za-z]*$" data-parsley-notequalto="#childf<?= $c ?>" />
                  </div> -->
                </div>
                <?php if($flight_result->isdomestic=='false' || $dobnationality==1){  ?>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Date of Birth</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <!-- <select class="form-control required" name="childDOBDate[]">
                      <option value="">Day</option>
                      <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select> -->
                    <?php echo $pass_info['childDOBDate'][$c].'/'.$pass_info['childDOBMonth'][$c].'/'.$pass_info['childDOBYear'][$c];?>
                  </div>
                  <!-- <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="childDOBMonth[]">
                      <option value="">Month</option>
                      <?php for ($ag = 1; $ag <= 12; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6">
                    <select class="form-control required" name="childDOBYear[]">
                      <option value="">Year</option>
                      <?php for ($ag = (date('Y') - 11); $ag <= (date('Y') - 2); $ag++) {?>
                      <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                      <?php }?>
                    </select>
                  </div> -->
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Nationality</div>
                  <div class="col-md-4 col-sm-8 col-xs-6 form-group">
                    <!-- <select class="form-control required" name="childPPNationality[]">
                      <option value="">Nationality</option>
                      <?php foreach($country_list as $con) {?>
                      <option value="<?php echo $con->iso2;?>"><?php echo $con->name;?></option>
                      <?php } ?>
                    </select> -->
                    <?php echo $pass_info['childPPNationality'][$c];?>
                  </div>
                </div>
                <?php } ?>
                <?php if($flight_result->isdomestic=='false'){  ?>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Passport Number</div>
                  <div class="col-md-4 col-sm-8 col-xs-6 form-group">
                    <!-- <input type="text" name="childPPNo[]" class="form-control required" placeholder="Passport Number" /> -->
                    <?php echo $pass_info['childPPNo'][$c];?>
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Passport Issue Date</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <!-- <select class="form-control required" name="childPPIDate[]">
                      <option value="">Day</option>
                      <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select> -->
                    <?php echo $pass_info['childPPIDate'][$c].'/'.$pass_info['childPPIMonth'][$c].'/'.$pass_info['childPPIYear'][$c];?>
                  </div>
                  <!-- <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="childPPIMonth[]">
                      <option value="">Month</option>
                      <?php for ($ag = 1; $ag <= 12; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6">
                    <select class="form-control required" name="childPPIYear[]">
                      <option value="">Year</option>
                      <?php for ($ag = (date('Y') - 11); $ag <= (date('Y')); $ag++) {?>
                      <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                      <?php }?>
                    </select>
                  </div> -->
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Passport Expiry Date</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <!-- <select class="form-control required" name="childPPEDate[]">
                      <option value="">Day</option>
                      <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select> -->
                    <?php echo $pass_info['childPPEDate'][$c].'/'.$pass_info['childPPEMonth'][$c].'/'.$pass_info['childPPEYear'][$c];?>
                  </div>
                  <!-- <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="childPPEMonth[]">
                      <option value="">Month</option>
                      <?php for ($ag = 1; $ag <= 12; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="childPPEYear[]">
                      <option value="">Year</option>
                      <?php for ($ag = date('Y'); $ag <= (date('Y') + 200); $ag++) {?>
                      <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                      <?php }?>
                    </select>
                  </div> -->
                </div>
                <div class="row no-padding form-group">
                  <div class="col-md-2 col-sm-4 col-xs-6">Passport Issue Country</div>
                  <div class="col-md-4 col-sm-8 col-xs-6">
                    <!-- <select class="form-control required" name="childPPICountry[]">
                      <option value="">Place of Issue</option>
                      <?php foreach($country_list as $con) {?>
                      <option value="<?php echo $con->iso2;?>"><?php echo $con->name;?></option>
                      <?php } ?>
                    </select> -->
                    <?php echo $pass_info['childPPICountry'][$c];?>
                  </div>
                </div>
                <?php } ?>
              </div>
              <?php }?>
              <?php } ?>
              <?php if($flight_result->infants != 0) {?>
              <?php for ($in = 0; $in < $flight_result->infants; $in++) { ?>
              <div class="BkdtrvlrDtls">
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">Infant <?php echo $in + 1; ?></div>
                  <div class="col-md-10 col-sm-9 col-xs-8 form-group">
                    <!-- <select class="form-control required" name="infantTitle[]">
                      <option value="">Title</option>
                      <option value="Mstr">Mstr</option>
                      <option value="Miss">Miss</option>
                    </select> -->
                    <?php echo $pass_info['infantTitle'][$in];?> <?php echo $pass_info['infantFName'][$in];?> <?php echo $pass_info['infantLName'][$in];?>
                  </div>
                  <!-- <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                    <input type="text" name="infantFName[]" id="infantf<?= $in ?>" class="form-control required" placeholder="First Name" data-parsley-trigger="change" data-parsley-pattern="^[A-Za-z]*$" />
                  </div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                    <input type="text" name="infantLName[]" class="form-control required" placeholder="Last Name" data-parsley-notequalto="#infantf<?= $in ?>" data-parsley-trigger="change"  data-parsley-pattern="^[A-Za-z]*$" />
                  </div> -->
                </div>
                <?php if($flight_result->isdomestic=='false' || $dobnationality==1){  ?>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Date of Birth</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <!-- <select class="form-control required" name="infantDOBDate[]">
                      <option value="">Day</option>
                      <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select> -->
                    <?php echo $pass_info['infantDOBDate'][$in].'/'.$pass_info['infantDOBMonth'][$in].'/'.$pass_info['infantDOBYear'][$in];?>
                  </div>
                  <!-- <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="infantDOBMonth[]">
                      <option value="">Month</option>
                      <?php for ($ag = 1; $ag <= 12; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6">
                    <select class="form-control required" name="infantDOBYear[]">
                      <option value="">Year</option>
                      <?php for ($ag = (date('Y') - 2); $ag <= (date('Y')); $ag++) {?>
                      <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                      <?php }?>
                    </select>
                  </div> -->
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Nationality</div>
                  <div class="col-md-4 col-sm-8 col-xs-6 form-group">
                    <!-- <select class="form-control required" name="infantPPNationality[]">
                      <option value="">Nationality</option>
                      <?php foreach($country_list as $con) {?>
                      <option value="<?php echo $con->iso2;?>"><?php echo $con->name;?></option>
                      <?php } ?>
                    </select> -->
                    <?php echo $pass_info['infantPPNationality'][$in];?>
                  </div>
                </div>
                <?php } ?>
                <?php if($flight_result->isdomestic=='false'){  ?>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Passport Number</div>
                  <div class="col-md-4 col-sm-8 col-xs-6 form-group">
                    <!-- <input type="text" name="infantPPNo[]" class="form-control required" placeholder="Passport Number" /> -->
                    <?php echo $pass_info['infantPPNo'][$in];?>
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Passport Issue Date</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <!-- <select class="form-control required" name="infantPPIDate[]">
                      <option value="">Day</option>
                      <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select> -->
                    <?php echo $pass_info['infantPPIDate'][$in].'/'.$pass_info['infantPPIMonth'][$in].'/'.$pass_info['infantPPIYear'][$in];?>
                  </div>
                  <!-- <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="infantPPIMonth[]">
                      <option value="">Month</option>
                      <?php for ($ag = 1; $ag <= 12; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6">
                    <select class="form-control required" name="infantPPIYear[]">
                      <option value="">Year</option>
                      <?php for ($ag = (date('Y') - 2); $ag <= (date('Y')); $ag++) {?>
                      <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                      <?php }?>
                    </select>
                  </div> -->
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Passport Expiry Date</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <!-- <select class="form-control required" name="infantPPEDate[]">
                      <option value="">Day</option>
                      <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select> -->
                    <?php echo $pass_info['infantPPEDate'][$in].'/'.$pass_info['infantPPEMonth'][$in].'/'.$pass_info['infantPPEYear'][$in];?>
                  </div>
                  <!-- <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="infantPPEMonth[]">
                      <option value="">Month</option>
                      <?php for ($ag = 1; $ag <= 12; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="infantPPEYear[]">
                      <option value="">Year</option>
                      <?php for ($ag = date('Y'); $ag <= (date('Y') + 200); $ag++) {?>
                      <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                      <?php }?>
                    </select>
                  </div> -->
                </div>
                <div class="row no-padding form-group">
                  <div class="col-md-2 col-sm-4 col-xs-6">Passport Issue Country</div>
                  <div class="col-md-4 col-sm-8 col-xs-6">
                    <!-- <select class="form-control required" name="infantPPICountry[]">
                      <option value="">Place of Issue</option>
                      <?php foreach ($country_list as $con) {?>
                      <option value="<?php echo $con->iso2; ?>"><?php echo $con->name; ?></option>
                      <?php } ?>
                    </select> -->
                    <?php echo $pass_info['infantPPICountry'][$in];?>
                  </div>
                </div>
                <?php } ?>
              </div>
              <?php }?>
              <?php } ?>

              <div class="row no-padding form-group">
                <div class="col-md-2 col-sm-4 col-xs-6">Mobile Number</div>
                <div class="col-md-4 col-sm-8 col-xs-6">
                  <!-- <input type="text" name="user_mobile" class="form-control required" placeholder="Mobile Number" data-parsley-num="" /> -->
                  <?php echo $pass_info['user_mobile'];?>
                </div>
              </div>

              
              <!-- GST INFORMATION -->
              <!-- GST INFORMATION -->
              <?php if($gstallowed==true){  ?>
              <?php if($gstmandatory==true){$mandatory='required';}else{$mandatory='';}  ?>
              <a href="javascript:;" id="gst_link"><b>GST Information (<?php if($gstmandatory==true) echo 'Required'; else echo 'Optional'; ?>) <i class="mdi mdi-arrow-down-bold-circle-outline"></i></b></a>
              <div class="BkdtrvlrDtls" id="gst_body" style="display: none;">
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">GST Number</div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                    <!-- <input type="text" name="GstNumber" class="form-control <?php echo $mandatory; ?>" value="19AACCF7790F2ZA" placeholder="GST Number" /> -->
                    <?php echo $pass_info['GstNumber'];?>
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">Company Name</div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                    <!-- <input type="text" name="GstCompanyName" class="form-control <?php echo $mandatory; ?>" value="nikhil" placeholder="Comapany Name" /> -->
                    <?php echo $pass_info['GstCompanyName'];?>
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">Comapny Contact Number</div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                    <!-- <input type="text" name="GstContactNumber" class="form-control <?php echo $mandatory; ?>" value="9879879877" placeholder="Contact Number" /> -->
                    <?php echo $pass_info['GstContactNumber'];?>
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">Comapny Email</div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                    <!-- <input type="text" name="GstEmail" class="form-control <?php echo $mandatory; ?>" value="harsh@tbtq.in" placeholder="Company Email" /> -->
                    <?php echo $pass_info['GstEmail'];?>
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">Comapny Address</div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                    <!-- <input type="text" name="GstAddress" class="form-control <?php echo $mandatory; ?>" value="A-fhgjkhsjkfd" placeholder="Company Address" /> -->
                    <?php echo $pass_info['GstAddress'];?>
                  </div>
                </div>
              </div>
              <?php } ?>

              <!-- <div class="row no-padding">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <button type="button" data-id="continuebtn1" class="btn btn-primary continuebtn py-2">Continue <i class="mdi mdi-chevron-double-right"></i></button>
                </div>
              </div> -->
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 box-parent three closed">
          <div class="card">
            <h5 class="mb-0 bdTitle2 three"><span>3</span> Payment &amp; Insurance<i class="mdi mdi-check"></i></h5>
            <div class="card-body itinerary-container middle-container">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-label">
                    <label class="checkbox-custom checkbox-custom-sm">
                      <input name="insurance_check" value="1" type="checkbox" <?php if($pass_info['insurance_check']==1) echo 'checked' ?> disabled><i></i>
                      <span>Safeguard & Secure your trip with Bajaj Allianz General Insurance Company Limited</span>
                    </label>
                    <div class="">
                      <small>View Travel Insurance <a href="#" data-toggle="modal" data-target="#InsuranceBenifits">Benefits</a> and <a target="_blank" href="#">Terms & Conditions</a> <span class="txt-info">(Only for Indian citizen between the age of 6 months to 70 years)</span></small>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <!-- <div class="form-group font14">
                <label>83% of our customers insure their flight trip. </label> See all the <a href="#" data-toggle="modal" data-target="#InsuranceBenifits">benefits</a> you get for just INR <span class="maininsurance" style="text-decoration: line-through;color:#f00;">0</span> <span class="maindiscount" style="color:#36c246;">0</span> per person
              </div> -->
              <div class="row no-padding">
                <div class="col-md-12 col-lg-12">
                  <label class="checkbox-custom checkbox-custom-sm">
                    <input name="terms" type="checkbox" class="required" value="" /><i></i>
                    <span>Yes, I accept the terms and conditions of the policy</span>
                  </label>
                </div>
              </div>
              <hr>
              <?php
              if($this->session->has_userdata('agent_logged_in')){
              $available_balance = $this->Tripjack_Model->get_agent_available_balance();
              // echo $this->db->last_query();
              $tot = $total_amount - $agent_markup;
              if ($available_balance > $tot) {  ?>
              <div class="row no-padding">
                <div class="col-md-12 col-lg-12">
                  <label class="radio-custom checkbox-custom-sm">
                    <input type="radio" name="payment_type" checked="checked" value="Deposit"><i></i>
                    <span>Deposit</span>
                  </label>
                </div>
              </div>
              <div class="row no-padding">
                <div class="col-md-12 col-lg-12"><button type="submit" class="btn btn-primary">CONFIRM</button></div>
              </div>
              <?php } else{ echo '<h5 class="red">Please recharge to continue booking</h5>'; } }else{ ?>
              <div class="row no-padding">
                <div class="col-md-12 col-lg-12">
                  <label class="radio-custom checkbox-custom-sm">
                    <input type="radio" name="payment_type" checked="checked" value="paytm"><i></i>
                    <span>Payment Gateway</span>
                  </label>
                </div>
              </div>
              <div class="row no-padding">
                <div class="col-md-12 col-lg-12"><button type="submit" class="btn btn-primary">CONFIRM</button></div>
              </div>
              <?php } ?>
              
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>

<div id="InsuranceBenifits" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="myModalLabelF2" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabelF2">Travel Insurance Benefits</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="datatable1" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="text-align:center;">S No</th>
                <th>Benefits</th>
                <th class="text-right">Sum Insured</th>
                <th class="text-right">Deductibles</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="text-align:center;">1</td>
                <td>Personal Accident*</td>
                <td style="text-align:right;">USD 15000</td>
                <td style="text-align:right;">NIL</td>
              </tr>
              <tr>
                <td style="text-align:center;">2</td>
                <td>Medical Expenses and Evacuation</td>
                <td style="text-align:right;">USD 50000</td>
                <td style="text-align:right;">USD 100</td>
              </tr>
              <tr>
                <td style="text-align:center;">3</td>
                <td>Emergency Dental Pain Relief included in above limits</td>
                <td style="text-align:right;">USD 500</td>
                <td style="text-align:right;">USD 100</td>
              </tr>
              <tr>
                <td style="text-align:center;">4</td>
                <td>Repatriation</td>
                <td style="text-align:right;">USD 5000</td>
                <td style="text-align:right;">NIL</td>
              </tr>
              <tr>
                <td style="text-align:center;">5</td>
                <td>Loss of Checked Baggage**</td>
                <td style="text-align:right;">USD 500</td>
                <td style="text-align:right;">NIL</td>
              </tr>
              <tr>
                <td style="text-align:center;">6</td>
                <td>Accidental Death &amp; Disability  (Common Carrier)</td>
                <td style="text-align:right;">USD 2500</td>
                <td style="text-align:right;">NIL</td>
              </tr>
              <tr>
                <td style="text-align:center;">7</td>
                <td>Loss of Passport</td>
                <td style="text-align:right;">USD 250</td>
                <td style="text-align:right;">USD 25</td>
              </tr>
              <tr>
                <td style="text-align:center;">8</td>
                <td>Personal Liability</td>
                <td style="text-align:right;">USD 100000</td>
                <td style="text-align:right;">USD 100</td>
              </tr>
              <tr>
                <td style="text-align:center;">9</td>
                <td>Hijack cover</td>
                <td style="text-align:right;">USD 50  per day to maximum  USD 300</td>
                <td style="text-align:right;">NIL</td>
              </tr>
              <tr>
                <td style="text-align:center;">10</td>
                <td>Trip Delay</td>
                <td style="text-align:right;">USD 25  per 12 Hrs to max USD 120</td>
                <td style="text-align:right;">12 Hrs</td>
              </tr>
              <tr>
                <td style="text-align:center;">11</td>
                <td>Hospitalization Daily Allowance</td>
                <td style="text-align:right;">USD 20   per day to max USD 100</td>
                <td style="text-align:right;">NIL</td>
              </tr>
              <tr>
                <td style="text-align:center;">12</td>
                <td>Golfer's Hole-in-one</td>
                <td style="text-align:right;">USD 250</td>
                <td style="text-align:right;">NIL</td>
              </tr>
              <tr>
                <td style="text-align:center;">13</td>
                <td>Trip Cancellation</td>
                <td style="text-align:right;">USD 500</td>
                <td style="text-align:right;">NIL</td>
              </tr>
              <tr>
                <td style="text-align:center;">14</td>
                <td>Trip Curtailment</td>
                <td style="text-align:right;">USD 200</td>
                <td style="text-align:right;">NIL</td>
              </tr>
              <tr>
                <td style="text-align:center;">15</td>
                <td>Delay of Checked Baggage</td>
                <td style="text-align:right;">USD 100</td>
                <td style="text-align:right;">12 hours</td>
              </tr>
              <tr>
                <td style="text-align:center;">16</td>
                <td>Home Burglary Insurance</td>
                <td style="text-align:right;">INR 100000</td>
                <td style="text-align:right;">NIL</td>
              </tr>
              <tr>
                <td style="text-align:center;">17</td>
                <td>Emergency Cash Benefit***</td>
                <td style="text-align:right;">USD 500</td>
                <td style="text-align:right;">NIL</td>
              </tr>
              <tr>
                <td style="text-align:center;">18</td>
                <td>Missed Connection</td>
                <td style="text-align:right;">USD 100</td>
                <td style="text-align:right;">12 hours</td>
              </tr>
              <tr>
                <td style="text-align:center;">19</td>
                <td>Difference in Airfare due to delayed or early return</td>
                <td style="text-align:right;">USD 500</td>
                <td style="text-align:right;">NIL</td>
              </tr>
              <tr>
                <td style="text-align:center;">20</td>
                <td>Bounced Hotel</td>
                <td style="text-align:right;">INR 500</td>
                <td style="text-align:right;">NIL</td>
              </tr>
              <tr>
                <td style="text-align:center;">21</td>
                <td>PA Cover in India</td>
                <td style="text-align:right;">INR 50000</td>
                <td style="text-align:right;">NIL</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- <small style="margin-left:16px;">Age 61 - 70 years, Anyone Illness $12,500 & Anyone Accident $25,000</small> -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalCheckRules" tabindex="-1" role="dialog" aria-labelledby="myModalLabelF" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabelF">Air Fare Rules</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive" id="fare_rules" style="max-height: 400px;">
          <table class="checkRulesCnt table">
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
      </div>
    </div>
  </div>
</div>


<?php $this->load->view('home/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>

<script type="text/javascript">
  $(document).on("click", '.checkRules', function ($e) {
    $searchId = $(this).attr('data-searchId');
    $.ajax({
      url: siteUrl + 'flights/flight_farerules',
      data: 'callBackId=<?php echo base64_encode('tbo'); ?>&searchId=' + $searchId,
      dataType: 'json',
      type: 'POST',
      beforeSend: function () {
        $('#fare_rules').html(
          '<div id="rules_loading" align="center"><img align="top" alt="loading.. Please wait.." src="<?php echo base_url(); ?>public/img/loader.gif"></div>'
        );

      },
      success: function (data) {
        $('#fare_rules').html(data.flight_farerules);
      }
    });
  });
</script>
<script type="text/javascript">
  $('#gst_link').on('click', function(e){
    e.preventDefault();
    $('#gst_body').slideToggle();
  })
</script>

<script type="text/javascript">
  // $(document).on('click', '.bdTitle2.active', function(e) {
  //   var _parents = $(this).parent().parent('.box-parent');
  //   var _input2 = $('.middle-container').find('.required');
  //   _input2.removeAttr('required');
  //   _parents.find('.required').attr('required','true');
    
  //   $(this).parent().parent().parent().find('.box-parent').removeClass('opened');
  //   $(this).parent().parent().parent().find('.box-parent').addClass('closed');
  //   $(this).parent().parent().removeClass('closed');
  //   $(this).parent().parent().addClass('opened');
  //   e.preventDefault();
  //   $(this).parent().parent().parent().find('.middle-container').hide();
  //   $(this).parent().find('.middle-container').show();
  // });
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

  $('.continuebtn').on('click', function() { console.log('123');
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
      console.log($parents);
      validateContainer($parents,$(this))
    } else {
      console.log('dddf');
      return false;
    }
  });
  $('.required').attr('required','true');
  $('#continueform').submit(function(){
    $parents = $(this).find('.box-parent.opened');
    if($(this).parsley().validate()) {
      // var _input = $(this).find('.required');
      // _input.attr('required','true');
      // alert('asdfasfds');
      // console.log($parents)
      if($parents.hasClass('three') && $parents.hasClass('opened')){
        // alert('asdfasfds');
        // validateContainer($parents,$(this));
      } else {
        console.log('224');
        // return false;
      }
    } else {
      console.log('67676');
      return false;
    }
  });
  function validateContainer($parents,_this){
    console.log(11);
    if($parents.hasClass('one')){
      $('.box-parent.two').find('.required').attr('required','true');
      $('.box-parent.one').removeClass('opened');
      $('.box-parent.one').addClass('closed');
      $('.box-parent.two').removeClass('closed');
      $('.box-parent.two').addClass('opened');
    } else if($parents.hasClass('two')){
      $('.box-parent.two').removeClass('opened');
      $('.box-parent.two').addClass('closed');
      $('.box-parent.three').removeClass('closed');
      $('.box-parent.three').addClass('opened');
      $('.box-parent.three').find('.required').attr('required','true');
    } else if($parents.hasClass('three')){
      // $('.box-parent.two').removeClass('opened');
      // $('.box-parent.two').addClass('closed');
      // $('.box-parent.three').addClass('opened');
      // $('.box-parent.four').find('.required').attr('required','true');
    }
    $parents.find('.bdTitle2').addClass('active');
    $parents.find('.middle-container').slideToggle();
    $parents.next('.box-parent').find('.middle-container').slideToggle();
    return false;
  }
</script>
<script type="text/javascript">
window.Parsley.addValidator("notequalto", {
requirementType: "string",
validateString: function(value, element) {
return value !== $(element).val();
}
});
</script>
<script type="text/javascript">
  $('.bdTitle2 ').on('click', function(e){
    e.preventDefault();
    $(this).next('.itinerary-container').slideToggle();
  })
</script>