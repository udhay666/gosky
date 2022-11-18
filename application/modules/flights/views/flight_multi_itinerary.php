<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<?php $this->load->view('home/header'); ?>
<?php
    $sess_data = unserialize($flight_result->searcharray);
    $sess_origin = $sess_data['fromCity'];
    // $sess_origincity = explode(' -', $sess_origin);
    $sess_desti = $sess_data['toCity'];
    // $sess_desticity = explode(' -', $sess_desti);
    $sess_departDate = $sess_data['departDate'];
    $sess_returnDate = $sess_data['returnDate'];

    $Origin = $flight_result->origin;
    $Destination = $flight_result->destination;
    $isdomestic = $flight_result->isdomestic;
    $fromCityName = $this->Tbo_Model->get_airport_cityname($Origin);
    $toCityName = $this->Tbo_Model->get_airport_cityname($Destination);
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
    $flightduration = explode(',',$flight_result->duration);

    if ($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true') {
        $baser = $flight_result_r->basefare;
        $taxr = $flight_result_r->tax+$flight_result_r->admin_markup+$flight_result_r->agent_markup+$flight_result_r->payment_charge;
        $totalr = $flight_result_r->total_amount;
    } else {
        $baser = 0;
        $taxr = 0;
        $totalr = 0;
    }
    $basefare = $flight_result->basefare + $baser;
    $tax = $flight_result->tax+$flight_result->admin_markup+$flight_result->agent_markup+$flight_result->payment_charge + $taxr;
    $total_amount = $flight_result->total_amount + $totalr;
    $currency = $flight_result->currency;
    $agent_markup = $flight_result->agent_markup;

    ///Special Request
//    $error_rs = $ssrresponsex->Response->Error->ErrorCode;
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

    // echo '<pre>'; print_r($ssrresponsex->Response->Meal);exit;
    // echo '3<pre>'; print_r($meal_options);exit;

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
    <!-- <form name="booking" method="POST" action="<?php echo site_url() ?>flights/payment_process" id="continueform" data-parsley-validate> -->
     <form name="booking" method="POST" 
      action="<?php echo site_url() ?>flights/confirm_itinerary" id="continueform" data-parsley-validate> 
    <input type="hidden" name="callBackId" value="<?php echo base64_encode('tbo'); ?>" />
    <input type="hidden" name="searchId" id="searchId" value="<?php echo $flight_result->search_id; ?>" />
    <input type="hidden" name="segmentkey" id="segmentkey" value="<?php echo $flight_result->segmentkey; ?>" />
    <?php
    if ($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true') {
        ?>
        <input type="hidden" name="searchId1" id="searchId1" value="<?php echo $flight_result_r->search_id; ?>" />
        <input type="hidden" name="segmentkey1" id="segmentkey1" value="<?php echo $flight_result_r->segmentkey; ?>" />
        <?php
    }
    ?>
      <div class="row">
        <div class="col-lg-12 col-md-12 box-parent one opened">
          <div class="card">
            <h5 class="mb-0 bdTitle2 one"><span>1</span> Itinerary <i class="mdi mdi-check"></i></h5>
            <div class="card-body itinerary-container middle-container">
              <div class="row no-gutters">
                <div class="col-lg-8 col-md-8">
                <label class="badge badge-info px-2 py-1">Onward <i class="mdi mdi-airplane"></i></label>
                  <span class="flt-criteria d-block mr-2"> <?php echo current($operating_cityname_o);  ?> →   <?php echo end($operating_cityname_d); ?> ( <?php echo date('j M Y', strtotime($this->Tbo_Model->getDate_TimeFromDateTime($operating_deptime[0], 'date'))); ?>)</span>
                  <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { ?>
                   <?php if ($segment_indicator[$j] == '1') { 
                     ?>

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
                    <small class="d-block"><?php echo date('j M Y', strtotime($this->Tbo_Model->getDate_TimeFromDateTime($operating_deptime[$j], 'date'))); ?></small><small class="d-block"><?php echo $this->Flights_Model->get_airport_name($operating_airportname_o[$j]); ?>, <?php if ($operating_terminal_o[$j] != '') echo $operating_terminal_d[$j]; ?></small></div>

                    <div class="card-title minwidth1"><i class="mdi mdi-clock d-block"></i> 
                    <?php  //if($j==0){ ?> 
                      <span class="flight-dur"><?php echo floor($flightduration[$j] / 60).'h:'.($flightduration[$j] - floor($flightduration[$j] / 60) * 60).'m';   ?></span>
                      <?php //} ?>
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
                    <small class="d-block"><?php echo date('j M Y', strtotime($this->Tbo_Model->getDate_TimeFromDateTime($operating_arritime[$j], 'date'))); ?></small><small class="d-block"><?php echo $this->Flights_Model->get_airport_name($operating_airportname_d[$j]); ?>,<?php  if ($operating_terminal_o[$j] != '') echo $operating_terminal_d[$j]; ?></small></div>
                  </div>
                  <?php } ?>
                  <?php } ?>


                  <!-- DOMESTIC ROUNDTRIP -->
                  <?php
                  if ($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true') {
                      $result_r = $flight_result_r;
                      $Origin = $result_r->origin;
                      $Destination = $flight_result->destination;
                      $fromCityName = $this->Tbo_Model->get_airport_cityname($Origin);
                      $toCityName = $this->Tbo_Model->get_airport_cityname($Destination);
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
                  <span class="flt-criteria d-block mr-2"> <?php echo current($operating_cityname_o);  ?> →   <?php echo end($operating_cityname_d); ?> ( <?php echo date('j M Y', strtotime($this->Tbo_Model->getDate_TimeFromDateTime($operating_deptime[0], 'date'))); ?>)</span>
                  <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { ?>
                   <?php if ($segment_indicator[$j] == '1') { 
                     ?>

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
                    <small class="d-block"><?php echo date('j M Y', strtotime($this->Tbo_Model->getDate_TimeFromDateTime($operating_deptime[$j], 'date'))); ?></small><small class="d-block"><?php echo $this->Flights_Model->get_airport_name($operating_airportname_o[$j]); ?>, <?php if ($operating_terminal_o[$j] != '') echo $operating_terminal_d[$j]; ?></small></div>

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
                    <small class="d-block"><?php echo date('j M Y', strtotime($this->Tbo_Model->getDate_TimeFromDateTime($operating_arritime[$j], 'date'))); ?></small><small class="d-block"><?php echo $this->Flights_Model->get_airport_name($operating_airportname_d[$j]); ?>,<?php  if ($operating_terminal_o[$j] != '') echo $operating_terminal_d[$j]; ?></small></div>
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
                  <input type="email" name="user_email" class="form-control required" required>
                </div>
                <div class="col-md-4 col-sm-8 col-xs-6">
                  <button type="button" data-id="continuebtn1" class="btn btn-primary continuebtn py-2">Continue <i class="mdi mdi-chevron-double-right"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 box-parent two closed">
          <div class="card">
            <h5 class="mb-0 bdTitle2 two"><span>2</span> Travellers <i class="mdi mdi-check"></i></h5>
            <div class="card-body itinerary-container middle-container pax-details" style="display: none;">
              <div class="row">
                <div class="control-group col-lg-12 col-md-12">
                  <div class="controls">Make sure the names you enter match the way they appear on your passport.</div>
                </div>
              </div>
              <?php for ($a = 0; $a < $flight_result->adults; $a++) { ?>
              <div class="BkdtrvlrDtls">
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-2 col-xs-6">Adult <?php echo $a + 1; ?></div>
                  <div class="col-md-1 col-sm-1 col-xs-6 form-group">
                    <select class="form-control required" name="adultTitle[]">
                      <option value="">Title</option>
                      <option value="Mr">Mr</option>
                      <option value="Mrs">Mrs</option>
                      <option value="Ms">Ms</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-4 form-group">
                    <input type="text" name="adultFName[]" class="form-control required" placeholder="First Name" data-parsley-nametest="" />
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-4 form-group">
                    <input type="text" name="adultLName[]" class="form-control required" placeholder="Last Name" data-parsley-nametest="" />
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Date of Birth</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="adultDOBDate[]">
                      <option value="">Day</option>
                      <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
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
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Passport Number</div>
                  <div class="col-md-4 col-sm-8 col-xs-6 form-group">
                    <input type="text" name="adultPPNo[]" class="form-control required" placeholder="Passport Number" />
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Nationality</div>
                  <div class="col-md-4 col-sm-8 col-xs-6 form-group">
                    <select class="form-control required" name="adultPPNationality[]">
                      <option value="">Nationality</option>
                      <?php foreach($country_list as $con) {?>
                      <option value="<?php echo $con->iso2;?>"><?php echo $con->name;?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Passport Issue Date</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="adultPPIDate[]">
                      <option value="">Day</option>
                      <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
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
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Passport Expiry Date</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="adultPPEDate[]">
                      <option value="">Day</option>
                      <?php for ($ap = 1; $ap <= 31; $ap++) { ?>
                      <option value="<?php echo str_pad($ap, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ap, 2, "0", STR_PAD_LEFT); ?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="adultPPEMonth[]">
                      <option value="">Month</option>
                      <?php for ($ag = 1; $ag <= 12; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6">
                    <select class="form-control required" name="adultPPEYear[]">
                      <option value="">Year</option>
                      <?php for ($ag = date('Y'); $ag <= (date('Y') + 200); $ag++) {?>
                      <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Passport Issue Country</div>
                  <div class="col-md-4 col-sm-8 col-xs-6">
                    <select class="form-control required" name="adultPPICountry[]">
                      <option value="">Place of Issue</option>
                      <?php foreach ($country_list as $con) {?>
                      <option value="<?php echo $con->iso2; ?>"><?php echo $con->name; ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
              </div>
              <?php }?>
              <?php if($flight_result->childs != 0) {?>
              <?php for ($c = 0; $c < $flight_result->childs; $c++) { ?>
              <div class="BkdtrvlrDtls">
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">Child <?php echo $c + 1; ?></div>
                  <div class="col-md-1 col-sm-3 col-xs-8 form-group">
                    <select class="form-control required" name="childTitle[]">
                      <option value="">Title</option>
                      <option value="Mstr">Mstr</option>
                      <option value="Miss">Miss</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                    <input type="text" name="childFName[]" class="form-control required" placeholder="First / Given Name" data-parsley-nametest="" />
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                    <input type="text" name="childLName[]" class="form-control required" placeholder="Last Name" data-parsley-nametest="" />
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Date of Birth</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="childDOBDate[]">
                      <option value="">Day</option>
                      <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
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
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Passport Number</div>
                  <div class="col-md-4 col-sm-8 col-xs-6 form-group">
                    <input type="text" name="childPPNo[]" class="form-control required" placeholder="Passport Number" />
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Nationality</div>
                  <div class="col-md-4 col-sm-8 col-xs-6 form-group">
                    <select class="form-control required" name="childPPNationality[]">
                      <option value="">Nationality</option>
                      <?php foreach($country_list as $con) {?>
                      <option value="<?php echo $con->iso2;?>"><?php echo $con->name;?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Passport Issue Date</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="childPPIDate[]">
                      <option value="">Day</option>
                      <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
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
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Passport Expiry Date</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="childPPEDate[]">
                      <option value="">Day</option>
                      <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="childPPEMonth[]">
                      <option value="">Month</option>
                      <?php for ($ag = 1; $ag <= 12; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6">
                    <select class="form-control required" name="childPPEYear[]">
                      <option value="">Year</option>
                      <?php for ($ag = date('Y'); $ag <= (date('Y') + 200); $ag++) {?>
                      <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Passport Issue Country</div>
                  <div class="col-md-4 col-sm-8 col-xs-6">
                    <select class="form-control required" name="childPPICountry[]">
                      <option value="">Place of Issue</option>
                      <?php foreach($country_list as $con) {?>
                      <option value="<?php echo $con->iso2;?>"><?php echo $con->name;?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <?php }?>
              <?php } ?>
              <?php if($flight_result->infants != 0) {?>
              <?php for ($in = 0; $in < $flight_result->infants; $in++) { ?>
              <div class="BkdtrvlrDtls">
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">Infant <?php echo $in + 1; ?></div>
                  <div class="col-md-1 col-sm-4 col-xs-8 form-group">
                    <select class="form-control required" name="infantTitle[]">
                      <option value="">Title</option>
                      <option value="Mstr">Mstr</option>
                      <option value="Miss">Miss</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                    <input type="text" name="infantFName[]" class="form-control required" placeholder="First / Given Name" data-parsley-nametest="" />
                  </div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                    <input type="text" name="infantLName[]" class="form-control required" placeholder="Last Name" data-parsley-nametest="" />
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Date of Birth</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="infantDOBDate[]">
                      <option value="">Day</option>
                      <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
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
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Passport Number</div>
                  <div class="col-md-4 col-sm-8 col-xs-6 form-group">
                    <input type="text" name="infantPPNo[]" class="form-control required" placeholder="Passport Number" />
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Nationality</div>
                  <div class="col-md-4 col-sm-8 col-xs-6 form-group">
                    <select class="form-control required" name="infantPPNationality[]">
                      <option value="">Nationality</option>
                      <?php foreach($country_list as $con) {?>
                      <option value="<?php echo $con->iso2;?>"><?php echo $con->name;?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Passport Issue Date</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="infantPPIDate[]">
                      <option value="">Day</option>
                      <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
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
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-6">Passport Expiry Date</div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="infantPPEDate[]">
                      <option value="">Day</option>
                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                      <option value="25">25</option>
                      <option value="26">26</option>
                      <option value="27">27</option>
                      <option value="28">28</option>
                      <option value="29">29</option>
                      <option value="30">30</option>
                      <option value="31">31</option>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
                    <select class="form-control required" name="infantPPEMonth[]">
                      <option value="">Month</option>
                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6">
                    <select class="form-control required" name="infantPPEYear[]">
                      <option value="">Year</option>
                      <?php for ($ag = date('Y'); $ag <= (date('Y') + 200); $ag++) {?>
                      <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Passport Issue Country</div>
                  <div class="col-md-4 col-sm-8 col-xs-6">
                    <select class="form-control required" name="infantPPICountry[]">
                      <option value="">Place of Issue</option>
                      <?php foreach ($country_list as $con) {?>
                      <option value="<?php echo $con->iso2; ?>"><?php echo $con->name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <?php }?>
              <?php } ?>

              <div class="row no-padding" style="margin-top: 15px">
                <div class="col-md-2 col-sm-4 col-xs-6">Mobile Number</div>
                <div class="col-md-4 col-sm-8 col-xs-6">
                  <input type="text" name="user_mobile" class="form-control required" placeholder="Mobile Number" data-parsley-num="" />
                </div>
              </div>

              
              <!-- GST INFORMATION -->
           <!--    <div class="BkdtrvlrDtls">
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">GST Number</div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                  <input type="text" name="GstNumber" class="form-control required" value="" placeholder="GST Number" />                    
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">Company Name</div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                  <input type="text" name="GstCompanyName" class="form-control required" value="" placeholder="Comapany Name"/>                    
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">Comapny Contact Number</div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                  <input type="text" name="GstContactNumber" class="form-control required" value="" placeholder="Contact Number" />                    
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">Comapny Email</div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                  <input type="text" name="GstEmail" class="form-control required" value="" placeholder="Company Email" />                    
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">Comapny Address</div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                  <input type="text" name="GstAddress" class="form-control required" value="" placeholder="Company Address" />                    
                  </div>
                </div>
               
              </div> -->
              <!-- GST INFORMATION -->

             <!--  <div class="row no-padding">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <button type="button" data-id="continuebtn1" class="btn btn-primary continuebtn py-2">Continue <i class="mdi mdi-chevron-double-right"></i></button>
                </div>
              </div> -->
                <div class="col-md-4 col-sm-8 col-xs-6">
                  <button type="button" data-id="continuebtn1" class="btn btn-primary continuebtn py-2">Continue <i class="mdi mdi-chevron-double-right"></i></button>
                </div>
            </div>
          </div>
        </div>
      <!--   <div class="col-lg-12 col-md-12 box-parent three closed">
          <div class="card">
            <h5 class="mb-0 bdTitle2 three"><span>4</span>Meal Preference<i class="mdi mdi-check"></i></h5>
            <div class="card-body itinerary-container middle-container" style="display: none;">
              <div class="row no-padding">
                <div class="col-md-2 col-sm-4 col-xs-6">Meal Dynamic</div>
                <div class="col-md-4 col-sm-8 col-xs-6">
                  <select  class="form-control required" name="meal" id="sel" onchange="show(this)">
                    <option value="">-- Select meal option--</option>
                     <?php 
                   $Meal = $ssrresponsex->Response->Meal;
                   //echo '<pre/>';print_r($ssrresponsex);exit;
                      for($i=0;$i<=count($Meal);$i++){
                        $Code = $Meal[$i]->Code;
                        $Description = $Meal[$i]->Description;?>
                        <option value="<?php echo $Code .'@^@'.$Description?>"><?php echo $Description?></option>
                      <?php }?>
                  </select>
                </div>
              </div>
               <div class="row no-padding">
              <div class="col-md-4 col-sm-8 col-xs-6">
                  <button type="button" data-id="continuebtn1" class="btn btn-primary continuebtn py-2">Continue <i class="mdi mdi-chevron-double-right"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div> -->
        <div class="col-lg-12 col-md-12 box-parent three closed">
          <div class="card">
            <h5 class="mb-0 bdTitle2 three"><span>3</span> Payment <i class="mdi mdi-check"></i></h5>
            <div class="card-body itinerary-container middle-container" style="display: none;">
              <div class="row no-padding">
                <div class="col-md-12 col-lg-12 font12">
                  <label> <input name="terms" type="checkbox" class="required" value="" /> Yes, I accept the terms and conditions of the policy </label>
                </div>
              </div>
              <div class="row no-padding">
                <div class="col-md-12 col-lg-12">
                  <label>
                    <input type="radio" name="bookedFls" checked="checked" style="display: none;">
                    <div class="rdtheme"><h4><strong>INR<?php //echo $currency; ?> 12,201<?php //echo $totalPrice; ?></strong></h4></div>
                  </label>
                </div>
              </div>
              <div class="row no-padding">
                <div class="col-md-12 col-lg-12"><button type="submit" class="btn btn-primary">CONTINUE</button></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>


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
               <tr>
                  <td width="150px">RULE APPLICATION AND OTHER CONDITIONS</td>
                  <td width="15px">:</td>
               <td>NOTE - THE FOLLOWING TEXT IS INFORMATIONAL</tr>
               <tr>
                  <td width="150px">TOUR CONDUCTOR DISCOUNTS</td>
                  <td width="15px">:</td>
                  <td>NO DISCOUNTS FOR TOUR CONDUCTORS.</td>
               </tr>
               <tr>
                  <td width="150px">AGENT DISCOUNTS</td>
                  <td width="15px">:</td>
                  <td>NO DISCOUNTS FOR SALE AGENTS.</td>
               </tr>
               <tr>
                  <td width="150px">ALL OTHER DISCOUNTS</td>
                  <td width="15px">:</td>
                  <td>NO DISCOUNTS FOR OTHERS.</td>
               </tr>
               <tr>
                  <td width="150px">MISCELLANEOUS PROVISIONS</td>
                  <td width="15px">:</td>
                  <td>THIS FARE MUST NOT BE USED TO CALCULATE A DIFFERENTIAL.</td>
               </tr>
               <tr>
                  <td width="150px">FARE BY RULE</td>
                  <td width="15px">:</td>
                  <td>NOT APPLICABLE.</td>
               </tr>
               <tr>
                  <td width="150px">GROUPS</td>
                  <td width="15px">:</td>
                  <td>NO GROUP PROVISIONS APPLY.</td>
               </tr>
               <tr>
                  <td width="150px">TOURS</td>
                  <td width="15px">:</td>
                  <td>NO TOUR PROVISIONS APPLY.</td>
               </tr>
               <tr>
                  <td width="150px">VISIT ANOTHER COUNTRY</td>
                  <td width="15px">:</td>
                  <td>NO VISIT ANOTHER COUNTRY PROVISIONS APPLY.</td>
               </tr>
               <tr>
                  <td width="150px">DEPOSITS</td>
                  <td width="15px">:</td>
                  <td>NO DEPOSIT PROVISIONS APPLY.</td>
               </tr>
               <tr>
                  <td width="150px">VOLUNTARY CHANGES</td>
                  <td width="15px">:</td>
                  <td>ENTER RD*31 OR RDLINE NUM*31 FOR VOLUNTARY CHGS.</td>
               </tr>
               <tr>
                  <td width="150px">VOLUNTARY REFUNDS</td>
                  <td width="15px">:</td>
                  <td>CHECK CATEGORY 16 OR CONTACT CARRIER FOR DETAILS.</td>
               </tr>
               <tr>
                  <td width="150px">NEGOTIATED FARES</td>
                  <td width="15px">:</td>
                  <td>NOT APPLICABLE.</td>
               </tr>
               <tr>
                  <td width="150px">INTERNATIONAL CONSTRUCTION</td>
                  <td width="15px">:</td>
                  <td>NOT A CONSTRUCTED FARE</td>
               </tr>
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
  $(document).on('click', '.bdTitle2.active', function(e) {
    var _parents = $(this).parent().parent('.box-parent');
    var _input2 = $('.middle-container').find('.required');
    _input2.removeAttr('required');
    _parents.find('.required').attr('required','true');
    
    $(this).parent().parent().parent().find('.box-parent').removeClass('opened');
    $(this).parent().parent().parent().find('.box-parent').addClass('closed');
    $(this).parent().parent().removeClass('closed');
    $(this).parent().parent().addClass('opened');
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
  $('#continueform').submit(function(){
    $parents = $(this).find('.box-parent.opened');
    if($(this).parsley().validate()) {
      // var _input = $(this).find('.required');
      // _input.attr('required','true');
      // alert('asdfasfds');
      // console.log($parents)
      if($parents.hasClass('three') && $parents.hasClass('opened')){
        // alert('asdfasfds');
        validateContainer($parents);
      } else {
        return false;
      }
    } else {
      return false;
    }
  });
  function validateContainer($parents){
    // console.log(11);
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