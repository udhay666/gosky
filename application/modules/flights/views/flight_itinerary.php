<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<?php $this->load->view('home/header'); ?>
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/style.css">-->
 <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/flightLayout.css"> 

 <style type="text/css">
    *,*:before,*:after {
      box-sizing: border-box;
    }
    html {
      font-size: 16px;
    }

    .plane {
      margin: 20px auto;
      max-width: 300px;
    }

    .cockpit {
      height: 250px; 
      position: relative;
      overflow: hidden;
      text-align: center;
      border-bottom: 5px solid #d8d8d8;
      }
      h1 {
        width: 60%;
        margin: 100px auto 35px auto;
      }
      .cockpit:before {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        height: 500px;
        width: 100%;
        border-radius: 50%;
        border-right: 5px solid #d8d8d8;
        border-left: 5px solid #d8d8d8;
      }

    .exit {
      position: relative;
      height: 50px;
    }
    .exit:before,
      .exit:after {
        content: "EXIT";
        font-size: 14px;
        line-height: 18px;
        padding: 0px 2px;
        font-family: "Arial Narrow", Arial, sans-serif;
        display: block;
        position: absolute;
        background: green;
        color: white;
        top: 50%;
        transform: translate(0, -50%);
      }
      .exit:before {
        left: 0;
      }
      .exit:after {
        right: 0;
      }

    .fuselage {
      border-right: 5px solid #d8d8d8;
      border-left: 5px solid #d8d8d8;
    }

    ol {
      list-style :none;
      padding: 0;
      margin: 0;
    }

    .row {
      
    }

    .seats {
      display: flex;
      flex-direction: row;
      flex-wrap: nowrap;
      justify-content: flex-start;  
    }

    .seat {
      display: flex;
      flex: 0 0 14.28571428571429%;
      padding: 5px;
      position: relative;  
    }
      .seat:nth-child(3) {
        margin-right: 14.28571428571429%;
      }
      input[type=checkbox] {
        position: absolute;
        opacity: 0;
      }
      input[type=checkbox]:checked  + label{
          background: #bada55;      
          -webkit-animation-name: rubberBand;
              animation-name: rubberBand;
          animation-duration: 300ms;
          animation-fill-mode: both;
      }
      input[type=checkbox]:disabled + label  {
          background: #dddddd;
          text-indent: -9999px;
          overflow: hidden;
          } 
          .seat .seat input[type=checkbox]:disabled + label:after {
            content: "X";
            text-indent: 0;
            position: absolute;
            top: 4px;
            left: 50%;
            transform: translate(-50%, 0%);
          } 
          .seat:hover {
            box-shadow: none;
            cursor: not-allowed;
          }
          
     .seat label {    
        display: block;
        position: relative;    
        width: 100%;    
        text-align: center;
        font-size: 14px;
        font-weight: bold;
        line-height: 1.5rem;
        padding: 4px 0;
        background: #F42536;
        border-radius: 5px;
        animation-duration: 300ms;
        animation-fill-mode: both;
      }
      
        /*label:before {
          content: "";
          position: absolute;
          width: 75%;
          height: 75%;
          top: 1px;
          left: 50%;
          transform: translate(-50%, 0%);
          background: rgba(255,255,255,.4);
          border-radius: 3px;
        }*/
        label:hover {
          cursor: pointer;
          box-shadow: 0 0 0px 2px #5C6AFF;
        }
    }

    @-webkit-keyframes rubberBand {
      0% {
        -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
      }

      30% {
        -webkit-transform: scale3d(1.25, 0.75, 1);
                transform: scale3d(1.25, 0.75, 1);
      }

      40% {
        -webkit-transform: scale3d(0.75, 1.25, 1);
                transform: scale3d(0.75, 1.25, 1);
      }

      50% {
        -webkit-transform: scale3d(1.15, 0.85, 1);
                transform: scale3d(1.15, 0.85, 1);
      }

      65% {
        -webkit-transform: scale3d(.95, 1.05, 1);
                transform: scale3d(.95, 1.05, 1);
      }

      75% {
        -webkit-transform: scale3d(1.05, .95, 1);
                transform: scale3d(1.05, .95, 1);
      }

      100% {
        -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
      }
    }

    @keyframes rubberBand {
      0% {
        -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
      }

      30% {
        -webkit-transform: scale3d(1.25, 0.75, 1);
                transform: scale3d(1.25, 0.75, 1);
      }

      40% {
        -webkit-transform: scale3d(0.75, 1.25, 1);
                transform: scale3d(0.75, 1.25, 1);
      }

      50% {
        -webkit-transform: scale3d(1.15, 0.85, 1);
                transform: scale3d(1.15, 0.85, 1);
      }

      65% {
        -webkit-transform: scale3d(.95, 1.05, 1);
                transform: scale3d(.95, 1.05, 1);
      }

      75% {
        -webkit-transform: scale3d(1.05, .95, 1);
                transform: scale3d(1.05, .95, 1);
      }

      100% {
        -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
      }
    }

    .rubberBand {
      -webkit-animation-name: rubberBand;
              animation-name: rubberBand;
    }
</style>
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover({
        placement : 'bottom',
        trigger : 'hover'
    });
});
</script>

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
    if ($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true') {
        $baser = $flight_result_r->basefare;
        $taxr = $flight_result_r->tax+$flight_result_r->admin_markup+$flight_result_r->agent_markup+$flight_result_r->payment_charge;
        $totalr = $flight_result_r->total_amount;
        $agentmmarkr = $flight_result_r->agent_markup;
    } else {
        $baser = 0;
        $taxr = 0;
        $totalr = 0;
        $agentmmarkr = 0;
    }
    $basefare = $flight_result->basefare + $baser;
    $tax = $flight_result->tax+$flight_result->admin_markup+$flight_result->agent_markup+$flight_result->payment_charge + $taxr;
    $total_amount = $flight_result->total_amount + $totalr;
    $currency = $flight_result->currency;
    $agent_markup = $flight_result->agent_markup + $agentmmarkr;

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

    // echo '<pre>'; print_r($ssrresponsex->Response->Meal);//exit;
    // echo '3<pre>'; print_r($meal_options);exit;
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

  $pax = $flight_result->adults + $flight_result->childs + $flight_result->infants;
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
  $Seats =array();
 $SeatDynamic = $ssrresponsex->Response->SeatDynamic;
    foreach ($SeatDynamic as  $valuea) {
      $SegmentSeat = $valuea->SegmentSeat;
      foreach ($SegmentSeat as $valueb) {
        $RowSeats = $valueb->RowSeats;
        foreach ($RowSeats as $valuec) {
          $Seats = $valuec->Seats;
        }
      }
    }
?>

<section class="section-padding pt-0">
  <div class="container">
    <div class="row pt-5 pb-5">
      <div class="col-md-12 col-lg-12" style="margin-top: 30px">
        <div class="form_wizard wizard_horizontal">
          <ul class="wizard_steps">
           <!--  <li class="active_step">
              <a href="javascript:;">
                <span class="step_no wizard-step"><i class="mdi mdi-check"></i></span>
                <span class="step_descr">Itinerary</span>
              </a>
            </li> -->
            <li class="active_step">
              <a href="javascript:;">
                <span class="step_no wizard-step">1</span>
                <span class="step_descr">Travellers</span>
              </a>
            </li>
            <li>
              <a href="javascript:;">
                <span class="step_no wizard-step">2</span>
                <span class="step_descr">Secure your booking</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- <form name="booking" method="POST" action="<?php echo site_url() ?>flights/payment_process" id="continueform" data-parsley-validate> -->
      <form name="booking" method="POST" t
      action="<?php echo site_url() ?>flights/confirm_itinerary" id="continueform" data-parsley-validate>
      <input type="hidden" name="callBackId" value="<?php echo base64_encode('tbo'); ?>" />
      <input type="hidden" name="searchId" id="searchId" value="<?php echo $flight_result->search_id; ?>" />
      <input type="hidden" name="segmentkey" id="segmentkey" value="<?php echo $flight_result->segmentkey; ?>" />
      <input type="hidden" name="pax_details" id="pax_details" value="<?php echo $pax; ?>" />
      <?php if ($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true') { ?>
      <input type="hidden" name="searchId1" id="searchId1" value="<?php echo $flight_result_r->search_id; ?>" />
      <input type="hidden" name="segmentkey1" id="segmentkey1" value="<?php echo $flight_result_r->segmentkey; ?>" />
      <input type="hidden" name="pax_details" id="pax_details" value="<?php echo $pax; ?>" />
      <?php } ?>
      <div class="row">
        <div class="col-lg-12 col-md-12 box-parent one opened">
          <div class="card">
            <h5 class="mb-0 bdTitle2 one"><span>1</span> Itinerary <i class="mdi mdi-check"></i></h5>
            <div class="card-body itinerary-container middle-container">
              <div class="row no-gutters">
                <div class="col-lg-8 col-md-8">
                  <label class="badge badge-info px-2 py-1">Onward <i class="mdi mdi-airplane"></i></label>
                  <div class="itinerary-box">
                    <span class="flt-criteria d-block mr-2"> <?php echo current($operating_cityname_o);  ?> →   <?php echo end($operating_cityname_d); ?> ( <?php echo date('j M Y', strtotime($this->Tbo_Model->getDate_TimeFromDateTime($operating_deptime[0], 'date'))); ?>)</span>
                    <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { ?>
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
                  <!-- international roundtrip -->
                  <?php if ($isdomestic == 'false' && $flight_result->triptype == 'R') { ?>
                  <label class="badge badge-info px-2 py-1 mt-4">Return <i class="mdi mdi-airplane"></i></label>
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
                  <label class="badge badge-info px-2 py-1 mt-4">Return <i class="mdi mdi-airplane"></i></label>
                  <div class="itinerary-box">
                    <span class="flt-criteria d-block mr-2"> <?php echo current($operating_cityname_o);  ?> →   <?php echo end($operating_cityname_d); ?> ( <?php echo date('j M Y', strtotime($this->Tbo_Model->getDate_TimeFromDateTime($operating_deptime[0], 'date'))); ?>)</span>
                    <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { ?>
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
                <div class="col-lg-4 col-md-4">
                  <div class="fare-breakup pl-2">
    
                    <!--    <span class="flt-criteria d-block"><input type="radio" name="promo" > Get discount using code <b style="color: red"><?php echo $coupon_code->coupon_code ?></b></span> -->
                    <?php for($i =0;$i<count($coupon);$i++){?>
                      <span class="flt-criteria d-block"><input type="radio" class="promo" name="promo" value="<? echo $coupon[$i]->coupon_code?>" id="promo_code"> <? echo $coupon[$i]->description ?>
                        <?php //echo '<pre>';print_r($coupon); ?>
                     <b style="color: red">
                      <?php echo $coupon[$i]->coupon_code ?></b></span> 
                    <?php }?>
                      <span class="d-block" style="color:red" id="description"> </span>
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
                          <input type="hidden" name="tot_amount" id="tot_amount" value="<?php echo $total_amount; ?>">
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
                    <table>
                        <tr> 
                          <div class="show_offers" style="background-color: #ffe4c4;"></div>     
                        </tr>
                        <tr>
                        <input type="hidden" name="callBackId" value="<?php echo base64_encode('tbo'); ?>" />
                        <input type="hidden" name="searchId" id="searchId" value="<?php echo $flight_result->search_id; ?>" />
                        <input type="hidden" name="segmentkey" id="segmentkey" value="<?php echo $flight_result->segmentkey; ?>" />
                        <?php if ($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true') { ?>
                        <input type="hidden" name="searchId1" id="searchId1" value="<?php echo $flight_result_r->search_id; ?>" />
                        <input type="hidden" name="segmentkey1" id="segmentkey1" value="<?php echo $flight_result_r->segmentkey; ?>" />
                        <?php } ?>
                        
                          <input type="hidden" name="date" id="date" value="<?php echo date('Y-m-d'); ?>">
                         
                          <td style="color: #1b378a !important;font-weight: 600;font-size: 14px !important;"><span style="margin-left: -25px;" >Coupon Code</span></td>
                          <td><span class="clearable"><input type="text" style="width:111px"  name="user_promotional" id="user_promotional"><i class="clearable__clear">&times;</i></span></td>
                          <td><button class="promo-btn btn btn-primary btn-checkout btn-st-checkout-submit btn-st-big" type="button" name="promo-btn" style="background-color:#0d737f;padding: 3px;margin-top: 0px;margin-left: 10px; width: 75px;height: 32px;">Apply</button></td>
                          </tr>
                      </table>
                  </div>
                </div>
              </div>
              <div class="row mt-4" id="itinerary-login" style="<?php if($this->session->userdata('user_no')){ echo 'display: none;'; } else { echo 'display: block;'; } ?>">
                <div class="col-sm-12">
                  <p><b><i class="mdi mdi-hand-pointing-right"></i> Login to book faster</b> <a class="btn border-btn" href="#" data-toggle="modal" data-target="#modalLoginIntinerary" style="background: #fff;color: #4d74e0;border: 1px solid #4d74e0;"><i class="mdi mdi-account"></i> Account Login</a></p>
                  
                </div>
                <div class="col-sm-12">
                  <div class="border-line"></div>
                </div>
              </div>
              <div class="row no-padding mt-1">
                <div class="col-md-2 col-sm-4 col-xs-6">Your email address</div>
                <div class="col-md-4 col-sm-8 col-xs-6">
                  <input type="email" name="user_email" value="<?php echo $user_email ?>" class="form-control required" data-parsley-trigger="change" required>
                </div>
                <!-- <div class="col-md-4 col-sm-8 col-xs-6">
                  <button type="button" data-id="continuebtn1" class="btn btn-primary continuebtn one py-2">Continue <i class="mdi mdi-chevron-double-right"></i></button>
                </div> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 box-parent two closed">
          <div class="card">
            <h5 class="mb-0 bdTitle2 two"><span>2</span> Travellers <i class="mdi mdi-check"></i></h5>
            <div class="card-body itinerary-container middle-container pax-details" >
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
                    <input type="text" name="adultFName[]" class="form-control required" placeholder="First Name" id="adultf<?= $a ?>"  data-parsley-trigger="change" data-parsley-pattern="^[A-Za-z]*$"/>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-4 form-group">
                    <input type="text" name="adultLName[]" class="form-control required" placeholder="Last Name" data-parsley-trigger="change" data-parsley-pattern="^[A-Za-z]*$" data-parsley-notequalto="#adultf<?= $a ?>"/>
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
                <?php if($flight_result->isdomestic=='false'){  ?>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Passport Number</div>
                  <div class="col-md-4 col-sm-8 col-xs-6 form-group">
                    <input type="text" name="adultPPNo[]" class="form-control required" placeholder="Passport Number" />
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
                <?php } ?>
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
                    <input type="text" name="childFName[]" class="form-control required" placeholder="First Name" id="childf<?= $c ?>" data-parsley-trigger="change" data-parsley-pattern="^[A-Za-z]*$" />
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                    <input type="text" name="childLName[]" class="form-control required" placeholder="Last Name" data-parsley-trigger="change" data-parsley-pattern="^[A-Za-z]*$" data-parsley-notequalto="#childf<?= $c ?>" />
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
                <?php if($flight_result->isdomestic=='false'){  ?>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Passport Number</div>
                  <div class="col-md-4 col-sm-8 col-xs-6 form-group">
                    <input type="text" name="childPPNo[]" class="form-control required" placeholder="Passport Number" />
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
                <?php } ?>
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
                    <input type="text" name="infantFName[]" id="infantf<?= $in ?>" class="form-control required" placeholder="First Name" data-parsley-trigger="change" data-parsley-pattern="^[A-Za-z]*$" />
                  </div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                    <input type="text" name="infantLName[]" class="form-control required" placeholder="Last Name" data-parsley-notequalto="#infantf<?= $in ?>" data-parsley-trigger="change"  data-parsley-pattern="^[A-Za-z]*$" />
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
                <?php if($flight_result->isdomestic=='false'){  ?>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-4 col-xs-6">Passport Number</div>
                  <div class="col-md-4 col-sm-8 col-xs-6 form-group">
                    <input type="text" name="infantPPNo[]" class="form-control required" placeholder="Passport Number" />
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
                      <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                      <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6 form-group">
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
                <?php } ?>
              </div>
              <?php }?>
              <?php } ?>
              <div class="row no-padding form-group">
                <div class="col-md-2 col-sm-4 col-xs-6">Mobile Number</div>
                <div class="col-md-4 col-sm-8 col-xs-6">
                  <input type="text" name="user_mobile" value="<?php echo $user_mobile ?>" class="form-control required" placeholder="Mobile Number" data-parsley-num="" />
                </div>
              </div>
                <div class="row no-padding">
                <div class="col-md-12 col-lg-12 font12">
                  <label> <input name="whatsapp" type="checkbox" checked="" value="Yes" style="opacity: 1;position: relative;"/> <span style="color: green;margin-top: 2px;" > Send Booking Details and updates above Phone Number </span></label>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6"> 
              </div>
              <!-- GST INFORMATION -->
              <?php if($gstallowed==true){  ?>
              <?php if($gstmandatory==true){$mandatory='required';}else{$mandatory='';}  ?>
              <a href="javascript:;" id="gst_link"><b>GST Information (Optional) <i class="mdi mdi-arrow-down-bold-circle-outline"></i></b></a>
              <div class="BkdtrvlrDtls" id="gst_body" style="display: none;">
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">GST Number</div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                    <input type="text" name="GstNumber" class="form-control <?php echo $mandatory; ?>" value="19AACCF7790F2ZA" placeholder="GST Number" />
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">Company Name</div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                    <input type="text" name="GstCompanyName" class="form-control <?php echo $mandatory; ?>" value="nikhil" placeholder="Comapany Name" />
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">Comapny Contact Number</div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                    <input type="text" name="GstContactNumber" class="form-control <?php echo $mandatory; ?>" value="9879879877" placeholder="Contact Number" />
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">Comapny Email</div>
                  <div class="col-md-3 col-sm-4 col-xs-6 form-group">
                    <input type="text" name="GstEmail" class="form-control <?php echo $mandatory; ?>" value="harsh@tbtq.in" placeholder="Company Email" />
                  </div>
                </div>
                <div class="row no-padding">
                  <div class="col-md-2 col-sm-3 col-xs-4">Comapny Address</div>
                  <div class="col-md-3 col-sm-4 col-xs-6">
                    <input type="text" name="GstAddress" class="form-control <?php echo $mandatory; ?>" value="A-fhgjkhsjkfd" placeholder="Company Address" />
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
            </div>
          </div>
        </div>
        <?php if(($ssrresponsex->Response->MealDynamic !='') || ($ssrresponsex->Response->Baggage !='')) {?>
        <div class="col-lg-12 col-md-12 box-parent three closed">
          <div class="card">
            <h5 class="mb-0 bdTitle2 three"><span>3</span>Special Service Request <i class="mdi mdi-check"></i></h5>
            <div class="card-body itinerary-container middle-container" >
             <?php if($ssrresponsex->Response->MealDynamic !=''){?>
              <div class="row no-padding form-group">
                <div class="col-md-2 col-sm-4 col-xs-6">Meal Dynamic</div>
                <div class="col-md-4 col-sm-8 col-xs-6">
                   <select  class="form-control " name="meal" id="sel" onchange="show(this)">
                      <option value="">-- Select meal option--</option>
                  <?php //echo '<pre/>';print_r($ssrresponsex);exit;
                   $MealDynamic =  $ssrresponsex->Response->MealDynamic[0];  
                    for($i=0;$i<=count($MealDynamic);$i++){
                      $Code = $MealDynamic[$i]->Code;
                      $AirlineDescription = $MealDynamic[$i]->AirlineDescription;
                      $Quantity= $MealDynamic[$i]->Quantity;
                      $Price = $MealDynamic[$i]->Price;
                      $WayType = $MealDynamic[$i]->WayType;
                      $Origin_ssr = $MealDynamic[$i]->Origin;
                      $Destination_ssr = $MealDynamic[$i]->Destination;
                     // echo '<pre/>';print_r($Code);exit;?>
                     <?php if($AirlineDescription != ''){ ?>
                         <option value="<?php echo $Code .'@^@'.$AirlineDescription.'@^@'.$Quantity.'@^@'.$Price.'@^@'.$WayType.'@^@'.$Origin_ssr.'@^@'.$Destination_ssr?>"><?php echo $AirlineDescription?> <span>&nbsp;<?php echo '(Rs' .$Price.')'?></span></option>
                    <?php  } }?>         
                  </select>
                  <p id="msg"></p>
                </div>
              </div> 
              <?php } ?>
              <?php if($ssrresponsex->Response->Baggage !=''){?>
              <div class="row no-padding form-group">
                <div class="col-md-2 col-sm-4 col-xs-6">Baggage</div>
                <div class="col-md-4 col-sm-8 col-xs-6">
                   <select  class="form-control " name="baggage" id="baggage" onchange="show_baggage(this)">
                      <option value="">-- Select baggage option--</option>
                   <?php //echo '<pre/>';print_r($ssrresponsex);exit;
                   $Baggage =  $ssrresponsex->Response->Baggage[0];  
                    for($i=0;$i<=count($Baggage);$i++){
                      $Code = $Baggage[$i]->Code;
                      $Weight = $Baggage[$i]->Weight;
                      $Price = $Baggage[$i]->Price;
                      $WayType = $Baggage[$i]->WayType;
                      
                     // echo '<pre/>';print_r($Code);exit;?>
                     <?php if($Weight != ''){ ?>
                         <option value="<?php echo $Code .'@^@'.$Weight.'@^@'.$Price.'@^@'.$WayType?>"><?php echo $Weight?>kg <span>&nbsp;<?php echo '(Rs' .$Price.')'?></span></option>
                    <?php  } }?>         
                  </select>
                  <p id="price"></p>
                </div>
              </div> 
              <?php } ?>  
              <?php if($ssrresponsex->Response->SeatDynamic !=''){ ?>
                  <input type="hidden" name="seats" id="selectedseats" value="">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Seat</button> 
              <?php } ?>      
              <!-- Button trigger modal -->
              <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Seat</button> -->
              <?php } ?>      
            </div>
          </div>
        </div>


        <div class="col-lg-12 col-md-12 box-parent three closed">
          <div class="card">
            <h5 class="mb-0 bdTitle2 three"><span>4</span> Payment <i class="mdi mdi-check"></i></h5>
            <div class="card-body itinerary-container middle-container" >
              <div class="row no-padding">
                <div class="col-md-12 col-lg-12 font12">
                  <label> <input name="terms" type="checkbox" class="required" value="" checked="" style="opacity: 1;position: relative;" /> Yes, I accept the terms and conditions of the policy </label>
                </div>
              </div>
              
              <?php
              if($this->session->has_userdata('agent_logged_in')){
              $available_balance = $this->Tbo_Model->get_agent_available_balance();
              // echo $this->db->last_query();
              $tot = $total_amount - $agent_markup;
              if ($available_balance > $tot) {  ?>
              
              <div class="row no-padding">
                <div class="col-md-12 col-lg-12">
                  <label>
                    <input type="radio" name="payment_type" checked="checked" value="Deposit">Deposit
                  </label>
                </div>
              </div>
              <div class="row no-padding">
                <div class="col-md-12 col-lg-12"><button type="submit" class="btn btn-primary">CONTINUE</button></div>
              </div>
              <?php  }else{
              echo 'Please recharge to continue booking';
              }
              }else{ ?>
              <div class="row no-padding">
                <div class="col-md-12 col-lg-12">
                  <label>
                    <?php if($flight_result->isdomestic == 'true'){ ?>
                    <?php $insurance = $this->Tbo_Model->get_insurance();
                    $fare = round($insurance->total_fare + $insurance->tax+$insurance->tds_fare);
                     ?>
                    <input type="checkbox" name="insurance" value="Yes" style="opacity: 1;position: relative;"> <?php echo 'Travell insurance from '. $insurance->plan_name .' available at '.$fare?>
                  <?php } else { ?>
                    <?php $insurance = $this->Tbo_Model->get_international_insurance();
                    $fare = round($insurance->total_fare + $insurance->tax+$insurance->tds_fare);
                     ?>
                    <input type="checkbox" name="insurance" value="Yes" style="opacity: 1;position: relative;"> <?php echo 'Travell insurance from '. $insurance->plan_name .'available at'.$fare?>

                  <?php }?>
                  </label><br>

                  <label>
                    <input type="radio" name="payment_type" checked="checked" value="paytm"> Payment Gateway
                  </label>
                </div>
              </div>
              <div class="row no-padding">
                <div class="col-md-12 col-lg-12"><button type="submit" class="btn btn-primary">CONTINUE</button></div>
              </div>
              <?php } ?>        
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
     <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?php echo current($operating_cityname_o);  ?> →   <?php echo end($operating_cityname_d); ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div class="container-fluid">
            <div class="row">
              <!-- <div class="col-md-4" style="border-right: 2px solid #aaa">
                <div class="card" style="box-shadow: 0 5px 7px #e0e5e8;border: 2px solid #aaa;margin-top: 40px;">
                  <li class="roww row--1">
                    <ol class="seats" type="A">
                      <li class="seat">
                        <input type="checkbox" id="1A" />
                        <label for="1A">Seat </label>
                      </li>
                      <label>Occupied</label>
                    </ol>
                  </li>
                  <li class="roww row--2">
                    <ol class="seats" type="A">
                      <li class="seat">
                        <input type="checkbox" id="1A" checked="" />
                        <label for="1A"></label>
                      </li>
                      <p>Selected seat</p>
                    </ol>
                  </li>
                </div>
              </div> -->
              <!-- <div class="col-md-8"> -->
                <div class="plane">
                      <div class="cockpit">
                        <h1>Please select a seat</h1>
                      </div>
                      <div class="exit exit--front fuselage">
                        
                      </div>
                      <div class="wingRowTop">
                        
                      </div>
                      <ol class="cabin fuselage">
                        <?php $SeatDynamic = $ssrresponsex->Response->SeatDynamic;
                          foreach ($SeatDynamic as  $valuea) {
                            $SegmentSeat = $valuea->SegmentSeat;
                            foreach ($SegmentSeat as $valueb) {
                              $RowSeats = $valueb->RowSeats;
                                 foreach ($RowSeats as $key => $valuec) {
                                $Seats = $valuec->Seats;
                              ?>
                        <li class="roww row--<?php echo $key; ?>">
                          <ol class="seats" type="A">
                            <?php foreach ($Seats as $valued) { ?>
                            <li class="seat">
                              <input type="checkbox" class="single-checkbox" name="seat" id="<?php echo $valued->Code?>" value="<?php echo $valued->AirlineCode .'@^@'.$valued->FlightNumber.'@^@'.$valued->CraftType.'@^@'.$valued->Origin.'@^@'.$valued->Destination.'@^@'.$valued->AvailablityType.'@^@'.$valued->Description.'@^@'.$valued->RowNo.'@^@'.$valued->SeatNo.'@^@'.$valued->SeatType.'@^@'.$valued->SeatWayType.'@^@'.$valued->Compartment.'@^@'.$valued->Deck.'@^@'.$valued->Currency.'@^@'.$valued->Price ?>"   />
                              <label for="<?php echo $valued->Code?>" data-toggle="popover" title="Seat no: <?php echo $valued->Code ?>" data-content="Price: Rs. <?php echo $valued->Price ?>"><?php echo $valued->Code?></label>
                            </li>
                           <?php }  ?>
                          </ol>
                        </li>
                        <?php } } }  ?>
                      </ol>
                      <div class="exit exit--back fuselage">
                        
                      </div>
                    </div>
              <!-- </div> -->
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalCheckRules" tabindex="-1" role="dialog" aria-labelledby="myModalLabelF" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 >Air Fare Rules</h5>
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
  
  $(".promo"). click(function(){
    //alert('123');
    var promo_code=  $(".promo:checked").val();
    // alert(promo_code);
    // e.preventDefault();
    $('#user_promotional').val($(".promo:checked").val());
       
    });
   $('.promo-btn').click(function(e) {
    e.preventDefault();
    var promot = $('#user_promotional').val();
    var tot_amnt=$('#tot_amount').val();
    console.log(tot_amnt)
     // alert($('#user_promotional').val());get_promotional_offer
    // $('#user_promotional').val('');
        $.ajax({
            url: siteUrl+'flights/get_promotional_offer',
            data: 'type=2&promo_code='+$('#user_promotional').val()+'&searchId='+$('#searchId').val()+'&segmentkey='+$('#segmentkey').val()+'&date='+$('#date').val()+'&searchId1='+$('#searchId1').val()+'&segmentkey1='+$('#segmentkey1').val()+'&tot_amount='+tot_amnt,
            dataType: 'json',
            type: 'POST',
            beforeSend: function()
            {
                $('.show_offers').html('<div id="rules_loading" align="center"><img align="top" alt="loading.. Please wait.." src="<?php echo base_url(); ?>public/img/load.gif"></div>');

            },
            success: function(data)
            { //alert(data.offer);alert(data.tot_amnt);alert(data.disc);
                $('.show_offers').html(data.offer);
                //$('#finaltot').html(data.tot_amnt);
                $('#finaltot,.finaltot').html(data.tot_amnt);
                $('#discountval').html(data.disc);
            }
           // $('#user_promotional').val('');
        });
       
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
<script>
  
    function show(ele) {
        // GET THE SELECTED VALUE FROM <select> ELEMENT AND SHOW IT.
        var msg = document.getElementById('msg');
        var val = ele.value;
        var vals = val.split('@^@');
        // alert(vals[2]);
        msg.innerHTML = 'Quantity: <b>' + vals[2] + '' +'Platter'+ '</b> </br>' +
            'Price: <b>' +'Rs'+vals[3] + '</b>';
    }
</script>
<script>
    function show_baggage(ele) {
        // GET THE SELECTED VALUE FROM <select> ELEMENT AND SHOW IT.
        var price = document.getElementById('price');
        var val = ele.value;
        var vals = val.split('@^@');
        // alert(vals);
        price.innerHTML = 'Price: <b>' + vals[2] + '</b>';
    }
</script>
<script type="text/javascript">
  var inputs=document.getElementsByTagName('INPUT');
  var limit=document.getElementById("pax_details").value;
  var count=0;
  for(input of inputs)
   {
      input.addEventListener("change",function(e){
        restrictLimit(e);
      });
   }
  function restrictLimit(e)
  {
    if(e.target.checked==true)
    {
      count++;
      var elements = document.querySelectorAll('input[type="checkbox"]:checked');
      var checkedElements = Array.prototype.map.call(elements, function (el, i) {
          return el.value;
      });
      console.log(checkedElements)
      if(count>limit)
        {
          e.target.checked=false;
          count=limit;
        }
    }
      else
      {
        count--;  
      }
    document.getElementById("selectedseats").value = checkedElements;
  }
  
</script>

<script>
    $(document).ready(function () {
    var _divId = '';
    var noAdCh = parseInt($('#noAltChd').val());
    $('[id^="FlSeat_"]').live('mouseover', function () {
        var _id = this.id;
        if (_divId != '') {
            $('#' + _divId).hide();
            _divId = '';
        }
        var sdata = _id.split('_');
        _divId = _id.replace('FlSeat_', 'FlSeatInfo_');
        $('#' + _divId).show();
    });

    $('[id^="FlSeat_"]').live('mouseout', function () {
        var _id = this.id;
        var divid = _id.replace('FlSeat_', 'FlSeatInfo_');
        $('#' + divid).hide();
    });

    $('#Paxspn_0_Seg_0_paxCount_0').live('mouseover', function () {
        $('#FlSeatclick').show();
    });
    $('#Paxspn_0_Seg_0_paxCount_0').live('mouseout', function () {
        $('#FlSeatclick').hide();
    });

    $('[id^="SegSeatSelect_"]').live('click', function () {
        isSeatChaning = false;
        seatChaingID = '';
        var _id = this.id;
        var spId = _id.split('_');
        var spSt = _id.replace('SegSeatSelect_', 'spnSeat_');
        var spPc = _id.replace('SegSeatSelect_', 'spnPrice_');
        var flBX = _id.replace('SegSeatSelect_', 'FlBox_');
        if (firstSelId.length > 0) {
            firstSelId = [];
            $('[id^="PaxSeat_' + spId[1] + '_Seg_' + spId[3] + '_paxCount_"]').each(function () {
                firstSelId[firstSelId.length] = '#';
            });
        }
        else {
            firstSelId = [];
        }

        $('[id^="Paxspn_"]').each(function () {
            $(this).removeClass('seatactive');
        });
        $('[id^="FlBox_"]').each(function () {
            $(this).hide();
        });
        $('#' + spSt).show();
        $('#' + spPc).show();
        $('#' + flBX).show();
        var cot = 0;
        $('[id^="PaxSeat_' + spId[1] + '_Seg_' + spId[3] + '_paxCount_"]').each(function () {
            var srText = $(this).text();
            $('[id^="FlSeat_' + spId[1] + '_Seg_' + spId[3] + '_Row_"]').each(function () {
                var inrStText = $(this).text();
                if (inrStText == srText) {
                    if ($(this).parent().hasClass('good')) {
                        firstSelId[cot] = this.id;
                    }
                    else if ($(this).parent().hasClass('booked')) {
                        $(this).parent().removeClass('booked');
                        $(this).parent().addClass('good');
                        firstSelId[cot] = this.id;
                    }
                }
            });
            cot++;
        });
        var t = 0;
        var bp = 0;
        var stxt = '';
        var cdId = 'cdPrc_' + spId[1] + '_Seg_' + spId[3];
        for (var ic = 0; ic < firstSelId.length; ic++) {
            if (firstSelId[ic] != '' && firstSelId[ic] == '#') {
                $('#PaxSeat_' + spId[1] + '_Seg_' + spId[3] + '_paxCount_' + ic).html('-');
                $('#PaxSeatCH_' + spId[1] + '_Seg_' + spId[3] + '_paxCount_' + ic).text('0.00');
                stxt += ' - ';
            }
            else {
                $('#PaxSeat_' + spId[1] + '_Seg_' + spId[3] + '_paxCount_' + ic).html($('#' + firstSelId[ic]).text());
                var liid = firstSelId[ic].replace('FlSeat_', 'StPrc_');
                var stprc = $('#' + liid).text().replace('Price : ', '').replace(' (', ' ').replace(')', ' ').split(' ');
                t += parseFloat(stprc[1].replace(',', ''));
                if (stprc.length > 2) {
                    bp += parseFloat(stprc[3].replace(',', ''));
                }
                $('#PaxSeatCH_' + spId[1] + '_Seg_' + spId[3] + '_paxCount_' + ic).text((parseFloat(stprc[1].replace(',', ''))).toFixed(2));
                stxt += $('#' + firstSelId[ic]).text();
            }
            if (ic < (firstSelId.length - 1)) {
                stxt += ',';
            }
        }
        $('#spnSeat_' + spId[1] + '_Seg_' + spId[3]).show().text(stxt);
        $('#spnPrice_' + spId[1] + '_Seg_' + spId[3]).show();
        $('#' + cdId).show().text(t.toFixed(2));
        if (isBaseCheck) {
            $('#cdPrcBase_' + spId[1] + '_Seg_' + spId[3]).show().text(bp.toFixed(2));
        }
    });

    var firstSelId = [];
    var isSeatChaning = false;
    var seatChaingID = '';
    var singlePaxSelection = false;
    var paxNoSelection = 0;
    var isBaseCheck = false;
    $('[id^="FlSeat_"]').live('click', function () {
        var _id = this.id;
        var spId = _id.split('_');
        var cdId = 'cdPrc_' + spId[1] + '_Seg_' + spId[3];
        var prcID = _id.replace('FlSeat_', 'StPrc_');
        var p = $('#' + prcID).text().replace('Price : ', '');
        if (p.indexOf('(') >= 0 && p.indexOf(')') >= 0) {
            isBaseCheck = true;
        }

        if ($(this).parent().hasClass('booked')) {
            alert('This seat is reserved. Please select another seat.');
            return false;
        }
        if ($(this).parent().hasClass('good')) {
            if (isSeatChaning) {
                if (_id == seatChaingID) {
                    // clear selected particular pax seat
                    for (var j = 0; j < firstSelId.length; j++) {
                        if (firstSelId[j] != '' && firstSelId[j] == seatChaingID) {
                            firstSelId[j] = '#';
                            seatChaingID = _id;
                            $(this).parent().removeClass(' good');
                        }
                    }
                }
                else {
                    alert('This seat is reserved for another passenger. Please select another seat.');
                }
            }
            else {
                // remove seat and new seat                
                for (var j = 0; j < firstSelId.length; j++) {
                    if (firstSelId[j] != '' && firstSelId[j] == _id) {
                        firstSelId[j] = '#';
                    }
                }
                $(this).parent().removeClass(' good');
            }
        }
        else {
            if (isSeatChaning) {
                if (seatChaingID == '') {
                    // click  on '-'  case                   
                    firstSelId[paxNoSelection] = _id;
                    seatChaingID = _id;
                    $(this).parent().addClass(' good');

                }
                else {
                    // existing seat changing case
                    for (var a = 0; a < firstSelId.length; a++) {
                        if ((firstSelId[a] != '' && firstSelId[a] == seatChaingID) || (firstSelId[a] == '#' && a == paxNoSelection)) {
                            firstSelId[a] = _id;
                        }
                    }
                    $('#' + seatChaingID).parent().removeClass(' good');
                    seatChaingID = _id;
                    $(this).parent().addClass(' good');
                }
            }
            else {
                // selection of all pax seat randomly
                if (firstSelId.length < noAdCh) {
                    firstSelId[firstSelId.length] = _id;
                }
                else {
                    var hashReplacemt = false;
                    var hashIndex = 0;
                    for (var i = 0; i < firstSelId.length; i++) {
                        if (firstSelId[i] == '#') {
                            hashReplacemt = true;
                            hashIndex = i;
                            break;
                        }
                    }
                    if (hashReplacemt) {
                        if (firstSelId[hashIndex] == '#') {
                            firstSelId[hashIndex] = _id;
                        }
                    }
                    else {
                        $('#' + firstSelId[0]).parent().removeClass(' good');
                        var art = [];
                        for (var i = 1; i < firstSelId.length; i++) {
                            if (firstSelId[i] != '') {
                                art[i - 1] = firstSelId[i];
                            }
                        }
                        art[art.length] = _id;
                        firstSelId = [];
                        firstSelId = art;
                    }
                }
                $(this).parent().addClass(' good');
            }
        }
        // Seat assignment and setting price  start   
        var t = 0;
        var bp = 0;
        var stxt = '';
        for (var ic = 0; ic < firstSelId.length; ic++) {
            if (firstSelId[ic] != '' && firstSelId[ic] == '#') {
                $('#PaxSeat_' + spId[1] + '_Seg_' + spId[3] + '_paxCount_' + ic).html('-');
                $('#PaxSeatCH_' + spId[1] + '_Seg_' + spId[3] + '_paxCount_' + ic).text('0.00');
                if (isBaseCheck) {
                    $('#PaxSeatBaseCH_' + spId[1] + '_Seg_' + spId[3] + '_paxCount_' + ic).text('0.00');
                }
                stxt += ' - ';
            }
            else {
                $('#PaxSeat_' + spId[1] + '_Seg_' + spId[3] + '_paxCount_' + ic).html($('#' + firstSelId[ic]).text());
                var liid = firstSelId[ic].replace('FlSeat_', 'StPrc_');
                var stprc = $('#' + liid).text().replace('Price : ', '').replace(' (', ' ').replace(')', ' ').split(' ');
                t += parseFloat(stprc[1].replace(',', ''));
                if (stprc.length > 2) {
                    bp += parseFloat(stprc[3].replace(',', ''));
                }
                $('#PaxSeatCH_' + spId[1] + '_Seg_' + spId[3] + '_paxCount_' + ic).text((parseFloat(stprc[1].replace(',', ''))).toFixed(2));
                if (isBaseCheck) {
                    $('#PaxSeatBaseCH_' + spId[1] + '_Seg_' + spId[3] + '_paxCount_' + ic).text((parseFloat(stprc[3].replace(',', ''))).toFixed(2));
                }
                stxt += $('#' + firstSelId[ic]).text();
            }
            if (ic < (firstSelId.length - 1)) {
                stxt += ',';
            }
        }
        $('#spnSeat_' + spId[1] + '_Seg_' + spId[3]).show().text(stxt);
        $('#spnPrice_' + spId[1] + '_Seg_' + spId[3]).show();
        $('#' + cdId).show().text(t.toFixed(2));
        if (isBaseCheck) {
            $('#cdPrcBase_' + spId[1] + '_Seg_' + spId[3]).show().text(bp.toFixed(2));
        }
    });

    /*-----------------------------------------particular Pax Seat Selection Change start---------------------------*/
    $('[id^="Paxspn_"]').live('click', function () {
        isSeatChaning = true;
        seatChaingID = '';
        firstSelId = [];
        if ($("#AmendmentStampId").length > 0)
            $("#FlSeatclickmessage").hide();
        $(".seatlayoutbox").show();
        var _id = this.id.split('_');
        $('[id^="Paxspn_"]').each(function () {
            $(this).removeClass('seatactive');
        });
        $(this).addClass('seatactive');
        var stslText = $('#PaxSeat_' + _id[1] + '_Seg_' + _id[3] + '_paxCount_' + _id[5]).text();
        $('[id^="PaxSeat_' + _id[1] + '_Seg_' + _id[3] + '_paxCount_"]').each(function () {
            var psId = parseInt(this.id.split('_')[5]);
            var srText = $(this).text().trim();
            if (srText == '-') {
                firstSelId[psId] = '#';
            }
            else {
                $('[id^="FlSeat_' + _id[1] + '_Seg_' + _id[3] + '_Row_"]').each(function () {
                    var inrStText = $(this).text();
                    if (inrStText == srText) {
                        firstSelId[psId] = this.id;
                        if ($(this).parent().hasClass('good')) {
                            $(this).parent().removeClass('good');
                            $(this).parent().addClass('booked');
                        }
                        else {
                            // do nothing                        
                        }
                    }
                    else {
                        //   do nothing
                    }

                });
            }
        });

        for (var l = 0; l < firstSelId.length; l++) {
            if (firstSelId[l] != '' && firstSelId[l] != '#') {
                if ($('#' + firstSelId[l]).text() == stslText) {
                    //isSeatChaning = true;
                    seatChaingID = firstSelId[l];
                    $('#' + seatChaingID).parent().removeClass('booked');
                    $('#' + seatChaingID).parent().addClass('good');
                }
                else {
                    //   do nothing
                }
            }
            else {
                // do nothing
            }
        }
        paxNoSelection = parseInt(_id[5]);
        $('[id^="FlBox_"]').each(function () {
            $(this).hide();
        });
        $('#FlBox_' + _id[1] + '_Seg_' + _id[3]).show();
    });
    /*-----------------------------------------particular Pax Seat Selection Change end---------------------------*/


    $("#btnContp").live('click', function () {

        SetSelectedSeatInHiddenVariables();

        // $('#SeatMap').hide();
        //$("#bgBlock").css("display", "none");
        if ($('#PassengerDetail').valid()) {
            $('#PassengerDetail').attr("action", "FlightReviewBooking.aspx");
            $('#PassengerDetail').submit();
        }
    });

    $('#seat_close').live('click', function () {
        firstSelId = [];
        isSeatChaning = false;
        seatChaingID = '';
        SetSelectedSeatInHiddenVariables();
        $('#SeatMap').hide();
        $("#bgBlock").css("display", "none");
    });

    function SetSelectedSeatInHiddenVariables() {
        $('[id^="PaxSeat_"]').each(function () {
            if ($(this).text() != '') {
                var _id = this.id.split('_');
                var _selSeat = $.trim($(this).text()).split(',');
                var index = '';
                if (_id[1] == '0') {
                    index = '1';
                }
                else {
                    index = '2';
                }
                for (var i = 0; i < _selSeat.length; i++) {
                    var hseatID = "Seat_" + _id[5] + "_indi_" + index + "_seg_" + parseInt(_id[3]);
                    $('#' + hseatID).val(_selSeat[i]);
                }
            }
        });
    }

});

</script>



 