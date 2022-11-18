<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<?php $this->load->view('home/home_template/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/style.css">

<?php
    $sess_data = unserialize($flight_result->searcharray);
    $session_data = $this->session->search_details;
    // echo '3<pre>'; print_r($session_data);exit;
    $sess_origin = $sess_data['fromCity'];
    $sess_origincity = explode(' -', $sess_origin);
    $sess_desti = $sess_data['toCity'];
    $sess_desticity = explode(' -', $sess_desti);
    $sess_departDate = $sess_data['departDate'];
    $sess_returnDate = $sess_data['returnDate'];
    $service_type = $session_data['service_type'];
    $insurance_amount = $session_data['insurance_amount'];

    $Origin = $flight_result->origin;
    $Destination = $flight_result->destination;
    $isdomestic = $flight_result->isdomestic;
    $this->load->model('Tbo_Model');
    $fromCityName = $this->Tbo_Model->get_airport_cityname($Origin);
    // echo $this->db->last_query();exit;
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
    if ($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true') {
        $baser = $flight_result_r->basefare;
        // $taxr = $flight_result_r->tax+$flight_result_r->admin_markup+$flight_result_r->agent_markup+$flight_result_r->payment_charge;
        $taxr = $flight_result_r->tax+$flight_result_r->admin_markup+$flight_result_r->agent_markup;

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
    // $tax = $flight_result->tax+$flight_result->admin_markup+$flight_result->agent_markup+$flight_result->payment_charge + $taxr;
    $tax = $flight_result->tax+$flight_result->admin_markup+$flight_result->agent_markup + $taxr;

    $convinience_fee = $flight_result->payment_charge + $convinience_feer;
    $total_amount = $flight_result->total_amount + $totalr;
    $currency = $flight_result->currency;
    $agent_markup = $flight_result->agent_markup + $agentmmarkr;
    $promo_discount = $flight_result->promo_discount; 
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
    // echo '3<pre>'; print_r($flight_result);exit;
    $gstallowed=$gstmandatory=false;
    if($flight_result->gstallowed=='1'){
      $gstallowed=true;
    }
    if($flight_result->gstmandatory=='1'){
      $gstmandatory=true;
    }

    if($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true'){
      if($flight_result_r->gstallowed=='1' && $gstallowed==false){
        $gstallowed=true;
      }
      if($flight_result_r->gstmandatory=='1' && $gstmandatory==false){
        $gstmandatory=true;
      }
    }

  /*$user_mobile = '';
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
  }*/
  $dobnationality=0;
  $pass_info = $this->session->userdata('passenger_info');
  //echo '<pre/>';print_r($pass_info['whatsapp']);exit;

  $segment_duration =  explode(',', $flight_result->segment_duration);
  $ground_duration =  explode(',', $flight_result->groundduration);
  $stops = (count($operating_flightno)-1);
  $checkin_baggage = explode(',', $flight_result->baggageinformation);
  $hand_baggage = explode(',', $flight_result->CabinBaggage);


$baggage_price = $flight_result->baggage_price;
$meal_price = $flight_result->meal_price;
$total_cost = $total_amount + $meal_price + $baggage_price + $insurance_amount;
?>
<section class="section-padding pt-0">
  <div class="container">
    <div class="row pt-5 pb-5">
      <div class="col-md-12 col-lg-12">
        <div class="form_wizard wizard_horizontal">
          <ul class="wizard_steps">
            <li class="one active_step">
              <a href="javascript:;">
                <span class="step_no wizard-step"><i class="mdi mdi-check"></i></span>
                <span class="step_descr">Review</span>
              </a>
            </li>
            <li class="two active_step">
              <a href="javascript:;">
                <span class="step_no wizard-step"><i class="mdi mdi-check"></i></span>
                <span class="step_descr">Travellers</span>
              </a>
            </li>
            <li class="three active_step">
              <a href="javascript:;">
                <span class="step_no wizard-step">3</span>
                <span class="step_descr">Payments</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- <form class="booking-form" name="booking" method="POST" action="<?php echo site_url() ?>flights/payment_process/" id="continueform" data-parsley-validate> -->
       <form name="booking" method="POST" 
    action="<?php echo site_url() ?>razorpay/pay.php" id="continueform" data-parsley-validate>
      <input type="hidden" name="callBackId" value="<?php echo base64_encode('tbo'); ?>" />
      <input type="hidden" name="searchId" id="searchId" value="<?php echo $flight_result->search_id; ?>" />
      <input type="hidden" name="segmentkey" id="segmentkey" value="<?php echo $flight_result->segmentkey; ?>" />
        <input type="hidden" name="total_cost" value="<?php echo $total_cost; ?>" />
      <input type="hidden" name="service_type" value="<?php echo $service_type; ?>" />
      <?php if ($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true') { ?>
      <input type="hidden" name="searchId1" id="searchId1" value="<?php echo $flight_result_r->search_id; ?>" />
      <input type="hidden" name="segmentkey1" id="segmentkey1" value="<?php echo $flight_result_r->segmentkey; ?>" />
      <?php } ?>
      <div class="row">
        <div class="col-lg-12 col-md-12 box-parent done one opened">
          <div class="card">
            <h5 class="bdTitle2 active one"><span>1</span> Review Your Booking<!--  <i class="mdi mdi-check"></i> --><i class="mdi mdi-chevron-down float-right"></i> <small class="d-inline-block ml-4" id="detailone" style="font-size: 14px;color: #fa161e;"></small></h5>
            <div class="card-body itinerary-container">
              <div class="row no-gutters">
                <div class="col-lg-8 col-md-8">
                  <small class="badge badge-info px-2 py-1">Departure <i class="mdi mdi-airplane rotateplus90"></i></small>
                  <div class="itinerary-box">
                    <span class="flt-criteria d-block mr-2"> <?php echo current($operating_cityname_o);  ?> →   <?php echo end($operating_cityname_d); ?> ( <?php echo date('j M Y', strtotime($this->Tbo_Model->getDate_TimeFromDateTime($operating_deptime[0], 'date'))); ?>)</span>
                    <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { 
                      if($operating_airlinecode[$j] =='I5'){
                        $dobnationality=1;
                      }
                    ?>
                    <?php if ($segment_indicator[$j] == '1') {
                    ?>
                    <div class="d-flex justify-content-between flex-wrap align-content-around text-center pr-2 itinerary-div mt-3">
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
                      <div class="card-title minwidth1">
                        <span class="flight-dur">
                          <?php //echo $this->Tbo_Model->journeyDuration(str_replace("T", " ", $operating_deptime[$j]),str_replace("T", " ", $operating_arritime[$j])); ?>
                            <?php if(count($segment_duration) > 1 && $stops > 0 && $isdomestic == 'false') {
                                  echo '<i class="mdi mdi-clock d-block"></i> '.floor($segment_duration[$j] / 60).'h:'.($segment_duration[$j] - floor($segment_duration[$j] / 60) * 60).'m';
                              } else {
                                  if($isdomestic == 'true') {
                                      echo '<i class="mdi mdi-clock d-block"></i> '.$this->Tbo_Model->journeyDuration(str_replace("T", " ", $operating_deptime[$j]),str_replace("T", " ", $operating_arritime[$j]));
                                  }
                              }
                            ?>
                        </span>
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
                    <?php if($j != (count($operating_airlinecode)-1)){ ?>
                    <div class="d-flex justify-content-between flex-wrap align-content-around text-center pr-2 itinerary-div mt-3">
                      <div class="layover-title">
                        <div><span>Layover: <?php echo $this->Tbo_Model->journeyDuration(str_replace("T", " ", $operating_arritime[$j]),str_replace("T", " ", $operating_deptime[$j+1])); ?></span></div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    <?php } ?>
                  </div>
                  <!-- international roundtrip -->
                  <?php if ($isdomestic == 'false' && $flight_result->triptype == 'R') { ?>
                  <label class="badge badge-info px-2 py-1 mt-4">Return <i class="mdi mdi-airplane rotateminus90"></i></label>
                  <div class="itinerary-box">
                    <span class="flt-criteria d-block mr-2"> <?php echo current($operating_cityname_o);  ?> →   <?php echo end($operating_cityname_d); ?> ( <?php echo date('j M Y', strtotime($this->Tbo_Model->getDate_TimeFromDateTime($operating_deptime[0], 'date'))); ?>)</span>
                    <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { ?>
                    <?php if ($segment_indicator[$j] == '2') { ?>
                    <div class="d-flex justify-content-between flex-wrap align-content-around text-center pr-2 itinerary-div mt-3">
                      <div class="card-title minwidth1">
                        <img src="<?php echo base_url() . 'public/AirlineLogo/' . $operating_airlinecode[$j]; ?>.gif" alt="flight logo">
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
                        <span class="flight-dur"><?php //echo floor($flight_result->duration / 60).'h:'.($flight_result->duration - floor($flight_result->duration / 60) * 60).'m';
                        echo $this->Tbo_Model->journeyDuration(str_replace("T", " ", $operating_deptime[$j]),str_replace("T", " ", $operating_arritime[$j])); ?></span>
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
                    <?php if($j != (count($operating_airlinecode)-1)){ ?>
                    <div class="d-flex justify-content-between flex-wrap align-content-around text-center pr-2 itinerary-div mt-3">
                      <div class="layover-title">
                        <div><span>Layover: <?php echo $this->Tbo_Model->journeyDuration(str_replace("T", " ", $operating_arritime[$j]),str_replace("T", " ", $operating_deptime[$j+1])); ?></span></div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    <?php } ?>
                  </div>
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
                    $lcc = $result_r->islcc;
                  ?>
                  <label class="badge badge-info px-2 py-1 mt-4">Return <i class="mdi mdi-airplane rotateminus90"></i></label>
                  <div class="itinerary-box">
                    <span class="flt-criteria d-block mr-2"> <?php echo current($operating_cityname_o);  ?> →   <?php echo end($operating_cityname_d); ?> ( <?php echo date('j M Y', strtotime($this->Tbo_Model->getDate_TimeFromDateTime($operating_deptime[0], 'date'))); ?>)</span>
                    <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { 
                      if($operating_airlinecode[$j] =='I5'){
                        $dobnationality=1;
                      }
                    ?>
                    <?php if ($segment_indicator[$j] == '1') { ?>
                    <div class="d-flex justify-content-between flex-wrap align-content-around text-center pr-2 itinerary-div mt-3">
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
                        <span class="flight-dur"><?php //echo floor($flight_result->duration / 60).'h:'.($flight_result->duration - floor($flight_result->duration / 60) * 60).'m';
                        echo $this->Tbo_Model->journeyDuration(str_replace("T", " ", $operating_deptime[$j]),str_replace("T", " ", $operating_arritime[$j])); ?></span>
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
                    <?php if($j != (count($operating_airlinecode)-1)){ ?>
                    <div class="d-flex justify-content-between flex-wrap align-content-around text-center pr-2 itinerary-div mt-3">
                      <div class="layover-title">
                        <div><span>Layover: <?php echo $this->Tbo_Model->journeyDuration(str_replace("T", " ", $operating_arritime[$j]),str_replace("T", " ", $operating_deptime[$j+1])); ?></span></div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    <?php } ?>
                  </div>
                  <?php } ?>
                </div>
                <div class="col-lg-4 col-md-4" id="faremove2">
                  <div class="fare-breakup pl-2">
                    <span class="flt-criteria d-block">Fare Summary</span>
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
                          <td>Sub Total</td>
                          <td>INR <span id="subfinaltot2"><?php echo number_format(round($basefare+$tax)); ?></span></td>
                        </tr>
                        <tr>
                          <td>Promo Discount</td>
                          <td style="color: #28a745">INR <?php echo number_format(round($promo_discount)); ?></b></td>
                        </tr>
                        <tr>
                          <td>Convenience Charge</td>
                          <td>INR <?php echo number_format(round($convinience_fee)); ?></td>
                        </tr>
                        <tr>
                          <td>Insurance Charge</td>
                          <td>INR <?php echo number_format(round($insurance_amount)); ?></td>
                        </tr>
                        <tr>
                          <td style="font-size: 18px;color: #2b2b2f;">Total</td>
                          <td style="font-size: 18px;color: #2b2b2f;">INR <span id="finaltot2"><?php echo number_format(round($total_cost - $promo_discount +$convinience_fee)); ?></span></td>
                           <!-- <td style="font-size: 18px;color: #2b2b2f;">INR <span id="finaltot2"><?php echo number_format(round($totcost_with_discount+$convinience_fee)); ?></span></td> -->
                        </tr>
                        <tr>
                          <td>
                            <a class="checkRules" href="#" data-toggle="modal" data-target="#modalCheckRules" data-searchid=""><strong><i class="mdi mdi-format-list-bulleted"></i> Fare Rules</strong></a>
                          </td>
                          <td><label class="badge badge-success px-2 py-1"><?php if ($nonrefundable == '1') echo 'REFUNDABLE'; else echo 'NON REFUNDABLE'; ?></label></td>
                        </tr>
                        <?php
                              $bag = $hand_baggage[0];
                              $bagg = $checkin_baggage[0];
                          ?>
                          <tr>
                            <td>Cabin Baggage</td>
                            <td><?php if($bagg == 'null' || $bagg == '' || $bagg == '0') echo '<small class="red">Hand Baggage only</small>';
                              else if($bag == 'null' || $bag == '' || $bag == '0') echo '<small class="red">Hand Baggage</small>';
                              else echo 'Weight: '.$bag; ?>
                            </td>
                          </tr>
                          <tr>
                            <td>Check-in Baggage</td>
                            <td>Weight: <?php if($bagg == 'null' || $bagg == '' || $bagg == '0') echo 'No'; else echo $bagg; ?></td>
                          </tr>
                      </tbody>
                    </table>
                    <?php if(($flight_result->meal_desc !='') || ($flight_result->baggage_code !='')) {?>
                    <table>
                      <span class="flt-criteria d-block">Addon specials</span>
                      <?php if($flight_result->meal_desc !=''){?>
                         <tr>
                           <td >Meal</td>
                           <td></td>
                          <td >
                            Rs <?php echo $flight_result->meal_price;?>
                          </td>
                         </tr>
                       <?php }?>
                       <?php if($flight_result->baggage_code !=''){?>
                          <tr>
                            <td >Bagg</td>
                            <td></td>
                            <td>
                              Rs <?php echo $flight_result->baggage_price;?>
                            </td>
                          </tr>
                       <?php }?>
                    </table>
                     <?php }?>
                  </div>
                </div>
              </div>
              <div class="row no-padding mt-4">
                <div class="col-sm-12">
                  <div class="border-line"></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">Your email address</div>
                <div class="col-md-4 col-sm-8 col-xs-6">
                  <input type="hidden"  name="user_email" value="<?php echo $pass_info['user_email'];?>">
                  <?php echo $pass_info['user_email'];?>
                </div>
              </div>
              <!-- <?php if(!$this->session->userdata('agent_logged_in')){ ?>
              <div class="row2">
                <div class="border-line"></div>
                <a href="javascript:;" class="toggle_link"><b>Promo Code (Optional) <i class="mdi mdi-arrow-down-bold-circle-outline"></i></b></a>
                <div class="toggle_body" style="display: none;">
                  <div class="row no-padding">
                    <div class="col-md-2 col-sm-4 col-xs-6">Enter a Promo Code</div>
                    <div class="col-md-4 col-sm-8 col-xs-6">
                      <input type="text" name="user_promo" class="form-control" id="user_promotional" placeholder="Enter your promo">
                      <div id="promo_msg" class="text-info"></div>
                      <input type="hidden" value="<?php echo $total_amount ?>" id="tot_amount">
                    </div>
                    <div class="col-md-4 col-sm-8 col-xs-6">
                      <button class="btn btn-secondary" id="promo_submit" type="button" style="padding: 8px 12px;border-radius: 4px;">Apply</button>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?> -->
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 box-parent two closed">
          <div class="card">
            <h5 class="bdTitle2 two active"><span>2</span> Enter Traveller Details<!--  <i class="mdi mdi-check"></i> --><i class="mdi mdi-chevron-down float-right"></i> <small class="d-inline-block ml-4" id="detailtwo" style="font-size: 14px;color: #fa161e;"></small></h5>
            <div class="card-body itinerary-container middle-container pax-details" >
              <div class="row">
                <div class="control-group col-lg-6 col-md-6">
                  <div class="controls">Make sure the names you enter match the way they appear on your passport.</div>
                </div>
                <div class="control-group col-lg-6 col-md-6 text-right">
                  <div class="controls">
                    <?php $urlstring = base64_encode('tbo/'.$flight_result->search_id.'/'.$flight_result->segmentkey); ?>
                    <?php if ($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true') { ?>
                    <?php $urlstring2 = base64_encode('tbo/'.$flight_result_r->search_id.'/'.$flight_result_r->segmentkey); ?>
                    <a href="<?php echo site_url(); ?>flights/itinerary/<?php echo $urlstring; ?>/<?php echo $urlstring2; ?>">Edit details</a>
                    <?php } else { ?>
                    <a href="<?php echo site_url(); ?>flights/itinerary/<?php echo $urlstring; ?>">Edit details</a>
                    <?php } ?>
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
                    <input type="hidden" name="adultTitle[]" value="<?php echo $pass_info['adultTitle'][$a];?>">
                    <input type="hidden" name="adultFName[]" value="<?php echo $pass_info['adultFName'][$a];?>">
                    <input type="hidden" name="adultLName[]" value="<?php echo $pass_info['adultLName'][$a];?>">
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
              <hr>
              <div class="row no-padding form-group">
                <div class="col-md-2 col-sm-4 col-xs-6">Mobile Number</div>
                <div class="col-md-4 col-sm-8 col-xs-6">
                  <!-- <input type="text" name="user_mobile" class="form-control required" placeholder="Mobile Number" data-parsley-num="" /> -->
                  <input type="hidden"  name="user_mobile" value=" <?php echo $pass_info['user_mobile'];?>">
                  +<?php echo $pass_info['mobile_code'];?> <?php echo $pass_info['user_mobile'];?>
                </div>
              </div>
              <div class="row no-padding form-group">
                <div class="col-md-2 col-sm-4 col-xs-6">WatsApp Itinerary?</div>
                <div class="col-md-4 col-sm-8 col-xs-6">
                  <!-- <?php if($pass_info['whatsapp_itinerary'] == '1') echo 'Yes'; else echo 'No' ?> -->
                   <input type="hidden"  name="whatsapp" value=" <?php echo $pass_info['whatsapp'];?>">
                  <?php if($pass_info['whatsapp'] == 'Yes') echo 'Yes'; else echo 'No' ; ?>
                </div>
              </div>
              
              <!-- GST INFORMATION -->
              <?php if($gstallowed==true){  ?>
              <?php if($gstmandatory==true){$mandatory='required';}else{$mandatory='';}  ?>
              <a href="javascript:;" class="toggle_link" id="gst_link"><b>GST Information (<?php if($gstmandatory==true) echo 'Required'; else echo 'Optional'; ?>) <i class="mdi mdi-arrow-down-bold-circle-outline"></i></b></a>
              <div class="BkdtrvlrDtls toggle_body" id="gst_body" style="display: none;">
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
              <!-- GST INFORMATION -->
              <!-- <div class="row no-padding">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <button type="button" data-id="continuebtn1" class="btn btn-primary continuebtn two py-2">Continue <i class="mdi mdi-chevron-double-right"></i></button>
                </div>
              </div> -->
              <!-- <div class="row no-padding">
                <div class="col-md-2 col-sm-4 col-xs-6"></div>
                <div class="col-md-4 col-sm-8 col-xs-6">
                  <button type="button" data-id="continuebtn1" class="btn btn-primary continuebtn two" style="padding-top: 9px;padding-bottom: 9px;margin-top: 15px;">Continue</button>
                </div>
              </div> -->
            </div>
          </div>
        </div>
        <?php if(($flight_result->meal_desc !='') || ($flight_result->baggage_code !='')) {?>
        <div class="col-lg-12 col-md-12 box-parent three closed">
          <div class="card">
            <h5 class="mb-0 bdTitle2 three"><span>3</span>Special Service Request <i class="mdi mdi-check"></i></h5>
            <div class="card-body itinerary-container middle-container" >
             <?php if($flight_result->meal_desc !=''){?>
              <div class="row no-padding form-group">
                <div class="col-md-2 col-sm-4 col-xs-6">Meal Dynamic</div>
                <div class="col-md-4 col-sm-8 col-xs-6">
                  <?php echo $flight_result->meal_desc;?>
                </div>
              </div>
                <div class="row no-padding form-group">
                  <div class="col-md-2 col-sm-4 col-xs-6">Meal Quantity</div>
                  <div class="col-md-4 col-sm-8 col-xs-6">
                    <?php echo $flight_result->meal_quantity;?>
                  </div>
                </div>
                <div class="row no-padding form-group">
                 <div class="col-md-2 col-sm-4 col-xs-6">Meal Price</div>
                <div class="col-md-4 col-sm-8 col-xs-6">
                  <?php echo $flight_result->meal_price;?>
                </div>
              </div> 
              <?php }?>
              <?php if($flight_result->baggage_code !=''){?>
              <div class="row no-padding form-group">
                <div class="col-md-2 col-sm-4 col-xs-6">Baggage Weight</div>
                <div class="col-md-4 col-sm-8 col-xs-6">
                  <?php echo $flight_result->baggage_weight;?>
          
                </div>
              </div> 
               <div class="row no-padding form-group">
                <div class="col-md-2 col-sm-4 col-xs-6">Baggage Price</div>
                <div class="col-md-4 col-sm-8 col-xs-6">
                  <?php echo $flight_result->baggage_price;?>
                </div>
              </div>
              <?php } ?>          
            </div>
          </div>
        </div>
        <?php }?>
        <div class="col-lg-12 col-md-12 box-parent three closed">
          <div class="card">
            <h5 class="bdTitle2 three "><span>4</span> Payment<!--  <i class="mdi mdi-check"></i> --><i class="mdi mdi-chevron-down float-right"></i></h5>
            <div class="card-body itinerary-container middle-container">
              <div class="row no-padding">
                <div class="col-md-12 col-lg-12 font12">
                  <label class="checkbox-custom checkbox-custom-sm">
                    <input name="terms" type="checkbox" class="required" value="" required /><i></i>
                    <span>Yes, I accept the terms and conditions of the policy</span>
                  </label>
                </div>
              </div>
              <hr>
              <?php
              if($this->session->has_userdata('agent_logged_in')){
              $available_balance = $this->Tbo_Model->get_agent_available_balance();
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
              <hr>
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
              <hr>
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


<div class="modal custom-modal fade" id="modalCheckRules" tabindex="-1" role="dialog" aria-labelledby="myModalLabelF" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabelF">Air Fare Rules</h3>
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


<?php $this->load->view('home/home_template/footer'); ?>
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
  $('.toggle_link').on('click', function(e){
    e.preventDefault();
    $(this).next('.toggle_body').slideToggle();
  })
</script>
<?php if(!$this->session->userdata('agent_logged_in')){ ?>
<!-- <script type="text/javascript">
$(document).ready(function(){
  
  function customValidate(event) {
    // console.log(event);
    event.preventDefault();
    // event.stopPropagation();
    let uemail = $('input[name="user_email"]').val();
    let checkicon = '<i class="mdi mdi-check"></i>';
    if (validateEmail(uemail)) {
      $('.wizard_steps .one .step_no').html(checkicon);
      $('#email_msg').html('');
      if(event.data.type == 'inpt'){
        $('.card-body.middle-container').hide('slide');
        $('.wizard_steps .two').removeClass('active_step');
        $('.wizard_steps .three').removeClass('active_step');
        $('.wizard_steps .one .step_no').html('1');
        $('.wizard_steps .two .step_no').html('2');
        $('.wizard_steps .three .step_no').html('3');
        $('.box-parent.two').removeClass('done');
        $('.box-parent.three').removeClass('done');
        $('.box-parent.one').find('.bdTitle2').removeClass('active');
        $('.box-parent.two').find('.bdTitle2').removeClass('active');
        $('.box-parent.three').find('.bdTitle2').removeClass('active');
        $('.box-parent.one').find('.bdTitle2 i.mdi-check').css('display','none');
        $('.box-parent.two').find('.bdTitle2 i.mdi-check').css('display','none');
        $('.box-parent.three').find('.bdTitle2 i.mdi-check').css('display','none');
        $('.box-parent.one .card-body.itinerary-container').show();
      } else {
        if($(this).hasClass('one')){
          if($('.box-parent.one').find('.card-body').is(":visible")){
            var htmls = $('.box-parent.one').find('.flt-criteria').html()+' | '+$('.box-parent.one').find('input[name="user_email"]').val();
            $('#detailone').html(htmls);
          } else {
            $('#detailone').html('');
          }
          $('.box-parent.two').addClass('done');
          $('.box-parent.one').find('.bdTitle2').addClass('active');
          $('.box-parent.two').find('.bdTitle2').addClass('active');
          $('.box-parent.one').find('.bdTitle2 i.mdi-check').css('display','initial');
          $('.box-parent.two').find('.bdTitle2 i.mdi-check').css('display','none');
          $('.box-parent.one .card-body.itinerary-container').hide('slide');
          $('.box-parent.two .card-body.middle-container').show('slide');
          $('.wizard_steps .two').addClass('active_step');
          $('.wizard_steps .two .step_no').html('2');
        } if($(this).hasClass('two')){
          let $selector = $('.box-parent.two').find('.required');
          let isValid = parsleyValidate($selector);
          if (!isValid) {
             return false;
          }

          if($('.box-parent.two').find('.card-body').is(":visible")){
            var htmls = $('.view_detail1').find('select[name="adultTitle[]"] option:selected').val()+' '+$('.view_detail1').find('input[name="adultFName[]"]').val()+' '+$('.view_detail1').find('input[name="adultLName[]"]').val()+' | '+$('.box-parent.two').find('input[name="user_mobile"]').val();

            $('#detailtwo').html(htmls);
          } else {
            $('#detailtwo').html('');
          }
          $('#farestick').html($('#faremove').html());
          $('.box-parent.three').addClass('done');
          $('.box-parent.two').addClass('done')
          $('.box-parent.three').find('.bdTitle2').addClass('active');
          $('.box-parent.two').find('.bdTitle2').addClass('active');
          $('.box-parent.one').find('.bdTitle2 i.mdi-check').css('display','initial');
          $('.box-parent.two').find('.bdTitle2 i.mdi-check').css('display','initial');
          $('.box-parent.three').find('.bdTitle2 i.mdi-check').css('display','none');
          $('.box-parent.one .card-body.itinerary-container').hide('slide');
          $('.box-parent.two .card-body.middle-container').hide('slide');
          $('.box-parent.three .card-body.middle-container').show('slide');
          $('.wizard_steps .three').addClass('active_step');
          $('.wizard_steps .two .step_no').html(checkicon);
        }
      }
    } else{
      $('.box-parent.two').removeClass('done')
      $('.box-parent.three').removeClass('done')
      $('.box-parent.two').find('.bdTitle2').removeClass('active');
      $('.box-parent.three').find('.bdTitle2').removeClass('active');
      $('.box-parent.one').find('.bdTitle2 i.mdi-check').css('display','none');
      $('.box-parent.two').find('.bdTitle2 i.mdi-check').css('display','none');
      $('.box-parent.three').find('.bdTitle2 i.mdi-check').css('display','none');
      $('.wizard_steps .one .step_no').html('1');
      $('.wizard_steps .two .step_no').html('2');
      $('.wizard_steps .three .step_no').html('3');
      $('.wizard_steps .two').removeClass('active_step');
      $('.wizard_steps .three').removeClass('active_step');
      $('#email_msg').html('Please enter valid email!');
      $('.card-body.middle-container').hide('slide');
    }
    return false;
  }

  function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
  }

  function parsleyValidate($selector) {
    var isValid = true;
    $selector.each( function() {
       if ($(this).parsley().validate() !== true) isValid = false;
    });
    // console.log(isValid)
    return isValid;
  }
  function parsleyValidate2($selector) {
     if ($selector.parsley().validate() !== true){
      $('.wizard_steps .two .step_no').html('2');
      $('.wizard_steps .three').removeClass('active_step');
      $('.wizard_steps .three .step_no').html('3');
      $('.box-parent.two').find('.bdTitle2 i.mdi-check').css('display','none');
      $('.box-parent.two').removeClass('done');
      $('.box-parent.three').removeClass('done');
      $('.box-parent.three').find('.bdTitle2').removeClass('active');
      $('.box-parent.three').find('.bdTitle2 i.mdi-check').css('display','none');
     } else {
      // $('.wizard_steps .two .step_no').html('<i class="mdi mdi-check"></i>');
      // $('.box-parent.two').find('.bdTitle2 i.mdi-check').css('display','initial');
      // $('.box-parent.two').removeClass('done');
      // $('.box-parent.three').addClass('done');
     }
  }

  $(".continuebtn").bind("click", {type: 'btn'}, customValidate);

  $("input[name='user_email']").bind("keyup", {type: 'inpt'}, customValidate);

  $('.box-parent.two').find("input.required").on("keyup", function(e){
    parsleyValidate2($(this));
  });

  $('.bdTitle2').on('click', function(){
    $('#farestick').html($('#faremove').html());
    _parents = $(this).parent().parent();
    if(_parents.hasClass('done')){
      if(_parents.find('.card-body').is(":visible")){
        return false;
      } else{
        _parents.parent().find('.card-body').hide('slide');
        _parents.find('.card-body').show('slide');
      }
    } else {
      // _parents.find('.card-body').hide('slide');
    }
  })
});
$('.required').attr('required','true');
$('#farestick').html($('#faremove').html());

$('#promo_submit').click(function(e) {
  e.preventDefault();
  var promot = $('#user_promotional').val();
  var tot_amnt = $('#tot_amount').val();
  var _this = $(this);
  if(promot.length) {
    $.ajax({
      url: siteUrl+'flights/get_promotional_offer',
      data: 'type=2&promo_code='+$('#user_promotional').val()+'&tot_amnt='+$('#tot_amount').val(),
      dataType: 'json',
      type: 'POST',
      beforeSend: function() {
        $('.show_offers').html('<div id="rules_loading" align="center"><img align="top" alt="loading.. Please wait.." src="<?php echo base_url(); ?>public/img/ajax-circle.gif"></div>');
      },
      success: function(data) {
        if(data.status == 'success'){
          $('#promo_msg').html(data.offer);
          $('#finaltot').html(data.tot_amnt);
          $('#promo_disp').show();
          $('#promo_disc').html(data.disc);
          $('#coupondisp').show();
          $('#applied_coupon').html(data.applied_coupon);
          _this.parent().parent().parent('.toggle_body').hide('slide');
        } else {
          $('#promo_msg').html(data.offer);
          $('#finaltot').html(data.tot_amnt);
          $('#promo_disp').hide();
          $('#promo_disc').html(data.disc);
          $('#coupondisp').hide();
          $('#applied_coupon').html(data.applied_coupon);
        }
      }
    });
  } else {
    $('#promo_msg').html("Please enter the promotional code.");
  }
});
</script> -->
<?php } ?>
<script type="text/javascript">
window.Parsley.addValidator("notequalto", {
  requirementType: "string",
  validateString: function(value, element) {
    return value !== $(element).val();
  }
});
</script>
<?php //if(!$this->session->userdata('user_no')){ ?>
<style type="text/css">
  .closed > .card > .card-body.middle-container {
    /*display: none;*/
  }
  .booking-form .bdTitle2 {
    padding: 4px 10px;
    margin: 0;
    border-radius: 3px 3px 0 0;
    -webkit-box-shadow: 0 2px 4px 0 #c8c8c8;
    -moz-box-shadow: 0 2px 4px 0 #c8c8c8;
    box-shadow: 0 2px 4px 0 #c8c8c8;
  }
</style>
<?php //} ?>