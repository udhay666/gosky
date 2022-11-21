   <?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
   <?php $this->load->view('home/header');
    // echo "<pre>21";print_r($this->session->all_userdata());

    $sess_data = unserialize($flight_result->searcharray);
    $session_data = $this->session->search_details;
    //   echo '3<pre>'; print_r($sess_data);exit;
    $sess_origin = $sess_data['fromCity'];
    $sess_origincity = explode(' -', $sess_origin);
    $sess_desti = $sess_data['toCity'];
    $sess_desticity = explode(' -', $sess_desti);
    $sess_departDate = $sess_data['departDate'];
    $sess_returnDate = $sess_data['returnDate'];
    $service_type = $session_data['service_type'];
    $class = $session_data['class'];
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
    $operating_fareclass = explode(',', $flight_result->operating_fareclass);
    $nonrefundable = $flight_result->nonrefundable;
    $baggageinformation = $flight_result->baggageinformation;
    $CabinBaggage = $flight_result->CabinBaggage;
    if ($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true') {
        $baser = $flight_result_r->basefare;
        // $taxr = $flight_result_r->tax+$flight_result_r->admin_markup+$flight_result_r->agent_markup+$flight_result_r->payment_charge;
        $taxr = $flight_result_r->tax + $flight_result_r->admin_markup + $flight_result_r->agent_markup;

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

    $durationd = floor($flight_result->duration / 60) . 'h:' . ($flight_result->duration -   floor($flight_result->duration / 60) * 60) . 'm';
    $basefare = $flight_result->basefare + $baser;
    // $tax = $flight_result->tax+$flight_result->admin_markup+$flight_result->agent_markup+$flight_result->payment_charge + $taxr;
    $tax = $flight_result->tax + $flight_result->admin_markup + $flight_result->agent_markup + $taxr;

    $convinience_fee = $flight_result->payment_charge + $convinience_feer;
    $total_amount = $flight_result->total_amount + $totalr;
    $currency = $flight_result->currency;
    //$duration = $flight_result->durationd;
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
        if (!empty($meal_rs)) {
            $meal_options = '<option data-price="0" value=' . $meal_rs[0]->Code . ' selected>No Meal</option>';
            for ($i = 0; $i < (count($meal_rs) - 1); $i++) {
                $meal_options .= '<option data-price="' . $meal_rs[$i + 1]->Price . '" value=' . $meal_rs[$i + 1]->Code . '>' . $meal_rs[$i + 1]->AirlineDescription . ' - INR ' . $meal_rs[$i + 1]->Price . '</option>';
            }
        }
        if (!empty($baggage_rs)) {
            $baggage_options = '<option data-price="0" value=' . $baggage_rs[0]->Code . ' selected>No Baggage</option>';
            for ($i = 0; $i < (count($baggage_rs) - 1); $i++) {
                $baggage_options .= '<option data-price="' . $baggage_rs[$i + 1]->Price . '" value=' . $baggage_rs[$i + 1]->Code . '>' . $baggage_rs[$i + 1]->Weight . ' KG - INR ' . $baggage_rs[$i + 1]->Price . '</option>';
            }
        }
    } else {
        //$baggage_rs = $ssrresponsex->Response->Baggage[0];
        //$meal_rs = $ssrresponsex->Response->MealDynamic[0];
        $meal_rs = $baggage_rs = '';
        if (!empty($meal_rs)) {
            $meal_options = '<option data-price="0" value=' . $meal_rs[0]->Code . ' selected>No Meal</option>';
            for ($i = 0; $i < (count($meal_rs) - 1); $i++) {
                $meal_options .= '<option data-price="' . $meal_rs[$i + 1]->Price . '" value=' . $meal_rs[$i + 1]->Code . '>' . $meal_rs[$i + 1]->AirlineDescription . ' - INR ' . $meal_rs[$i + 1]->Price . '</option>';
            }
        }

        if (!empty($baggage_rs)) {
            $baggage_options = '<option data-price="0" value=' . $baggage_rs[0]->Code . ' selected>No Baggage</option>';
            for ($i = 0; $i < (count($baggage_rs) - 1); $i++) {
                $baggage_options .= '<option data-price="' . $baggage_rs[$i + 1]->Price . '" value=' . $baggage_rs[$i + 1]->Code . '>' . $baggage_rs[$i + 1]->Weight . ' KG - INR ' . $baggage_rs[$i + 1]->Price . '</option>';
            }
        }
    }

    // echo '<pre>'; print_r($ssrresponsex->Response->Meal);//exit;
    // echo '3<pre>'; print_r($flight_result);exit;
    $gstallowed = $gstmandatory = false;
    if ($flight_result->gstallowed == '1') {
        $gstallowed = true;
    }
    if ($flight_result->gstmandatory == '1') {
        $gstmandatory = true;
    }

    if ($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true') {
        if ($flight_result_r->gstallowed == '1' && $gstallowed == false) {
            $gstallowed = true;
        }
        if ($flight_result_r->gstmandatory == '1' && $gstmandatory == false) {
            $gstmandatory = true;
        }
    }


    $dobnationality = 0;
    $pass_info = $this->session->userdata('passenger_info');
    //echo '<pre/>';print_r($pass_info['whatsapp']);exit;

    $segment_duration =  explode(',', $flight_result->segment_duration);
    $ground_duration =  explode(',', $flight_result->groundduration);
    $stops = (count($operating_flightno) - 1);
    $checkin_baggage = explode(',', $flight_result->baggageinformation);
    $hand_baggage = explode(',', $flight_result->CabinBaggage);


    $baggage_price = $flight_result->baggage_price;
    $meal_price = $flight_result->meal_price;
    $total_cost = round($total_amount + $meal_price + $baggage_price + $insurance_amount);
    ?>

   <link rel="stylesheet" href="<?= base_url(); ?>assets_gosky/css/flight/flight_paymentdetails.css">
   <!-- payment start-->
   <style>
       .adultImg,
       .loginUserImg {
           object-fit: cover;
           vertical-align: top;
       }

       .adultImg {
           width: 24px;
           height: 24px;
       }

       .makeFlex.perfectCenter {
           align-items: center;
           justify-content: center;
       }

       .makeFlex.justifyCenter,
       .makeFlex.perfectCenter {
           align-items: center;
           justify-content: center;
       }

       .makeFlex {
           display: flex;
       }

       .adultDetailsHeading {
           margin-bottom: 12px;
       }

       .adultDetailsHeading,
       .travellerLoginSection {
           display: flex;
           flex-direction: row;
           align-items: center;
           justify-content: space-between;
       }

       .appendBottom15 {
           margin-bottom: 15px;
       }

       .adultItemRow {
           display: flex;
       }


       /* new csss */
       .dobSelect_fx {
           display: flex;
           gap: 20px;
       }

       .dob_input select {
           border: 1px solid #bebebe;
           border-radius: 4px;
           font-family: lato;
           font-size: 14px;
           font-weight: 400;
           height: 40px;
           outline: 0;
           padding: 0 10px;
           width: 95px;
       }

       .dobpass_fx {
           display: flex;
           align-items: center;
           margin-top: 20px;
       }

       .dob_width {
           width: 340px;
       }

       .nationlity_margin {
           margin-top: 20px;
           margin-bottom: 20px;
       }

       .pass_input select {
           width: 85%;
           border: 1px solid #bebebe;
           border-radius: 4px;
           font-family: lato;
           font-size: 14px;
           font-weight: 400;
           height: 40px;
           outline: 0;
           padding: 0 10px;
       }

       .nationality_input select {
           width: 40%;
           border: 1px solid #bebebe;
           border-radius: 4px;
           font-family: lato;
           font-size: 14px;
           font-weight: 400;
           height: 40px;
           outline: 0;
           padding: 0 10px;
       }

       .frmSelectCont2,
       .frmSelectCont3 {
           position: relative;
       }

       .frmSelectCont2:after {
           border: solid #898b91;
           border-width: 0 2px 2px 0;
           content: "";
           display: inline-block;
           padding: 3px;
           pointer-events: none;
           position: absolute;
           right: 55px;
           top: 50%;
           transform: translateY(-50%) rotate(45deg);
       }

       .frmSelectCont3:after {
           border: solid #898b91;
           border-width: 0 2px 2px 0;
           content: "";
           display: inline-block;
           padding: 3px;
           pointer-events: none;
           position: absolute;
           right: 62%;
           top: 50%;
           transform: translateY(-50%) rotate(45deg);
       }

       .pass_input input {
           border: 1px solid #bebebe;
           border-radius: 4px;
           font-family: lato;
           font-size: 14px;
           font-weight: 400;
           height: 40px;
           outline: 0;
           padding: 0 10px;
           width: 125%;
       }

       @media only screen and (max-width:568px) {
           .dobpass_fx {
               display: flex;
               flex-direction: column;
               align-items: baseline;
               margin-top: 20px;
               gap: 10px;
           }

           .nationality_input select {
               width: 100%;
               border: 1px solid #bebebe;
               border-radius: 4px;
               font-family: lato;
               font-size: 14px;
               font-weight: 400;
               height: 40px;
               outline: 0;
               padding: 0 10px;
           }

           .frmSelectCont3:after {
               border: solid #898b91;
               border-width: 0 2px 2px 0;
               content: "";
               display: inline-block;
               padding: 3px;
               pointer-events: none;
               position: absolute;
               right: 8%;
               top: 50%;
               transform: translateY(-50%) rotate(45deg);
           }

           .nationlity_margin {
               margin-top: 20px;
               margin-bottom: 15px;
           }

           .pass_input input {
               width: 170%;
           }

           .pass_input select {
               width: 119%;
               border: 1px solid #bebebe;
               border-radius: 4px;
               font-family: lato;
               font-size: 14px;
               font-weight: 400;
               height: 40px;
               outline: 0;
               padding: 0 10px;
           }

           .frmSelectCont2:after {
               border: solid #898b91;
               border-width: 0 2px 2px 0;
               content: "";
               display: inline-block;
               padding: 3px;
               pointer-events: none;
               position: absolute;
               right: -27px;
               top: 50%;
               transform: translateY(-50%) rotate(45deg);
           }


       }
   </style>
   <!-- breadcrumb start -->
   <section class="res_bc">
       <nav aria-label="breadcrumb">
           <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="#">Home</a></li>
               <li class="breadcrumb-item"><a href="#">Flight</a></li>
               <li class="breadcrumb-item"><a href="#">FlightFaredetails</a></li>
           </ol>
       </nav>
   </section>
   <!-- breadcrumb  end -->

   <!-- paymentdetail start -->
   <section class="mt-5">


       <div class="container ">
           <div class="row">
               <div class="col-md-12 col-lg-8 ">
                   <div class="htlInfoContainer appendBottom20">
                       <div class="accordHead">
                           <div>
                               <p class="accordHead__text">
                                   <span class="capText">Flight Information</span>
                               </p>
                           </div>
                           <div>
                               <span class="accordBtn appendLeft20 up"></span>
                           </div>
                       </div>
                       <!--  -->

                       <div class="flightDetailBlk">
                           <div class="flDetailHdr">
                               <div>
                                   <h2 class="blackFont">
                                       <b><?php echo current($operating_cityname_o);  ?> → <?php echo end($operating_cityname_d);  ?></b>
                                   </h2>
                                   <p class="appendTop10 makeFlex gap-x-10">
                                       <span class="scheduleDay" style="background-color: rgb(255, 237, 209)">
                                           <?php echo date('l, M y', strtotime($this->Tbo_Model->getDate_TimeFromDateTime($operating_deptime[0], 'date'))); ?>

                                       </span>
                                       <span class="fontSize14"><?php echo $route; ?></span>
                                   </p>
                               </div>

                               <div class="makeFlex column d_none">
                                   <p class="refundTag" style="background-image: linear-gradient(to right,rgb(45, 193, 140),rgb(33, 147, 147));">
                                       <font color="#ffffff">Cancellation Fees Apply</font>
                                   </p>
                                   <!-- <p class="fontSize14 linkText appendTop10 textRight">
                                       <span data-bs-toggle="modal" data-bs-target="#exampleModal">View Fare
                                           Rules</span>
                                   

                                   </p> -->
                               </div>
                           </div>
                           <?php for ($s = 0; $s < count($operating_airlinecode); $s++) { ?>
                               <div class="flightItenaryWrap">
                                   <div class="flightItenaryHdr">
                                       <div class="makeFlex gap-x-10">
                                           <span class="bgProperties icon24" style="background-image: url()"> <img src="<?php echo base_url() . 'Public/AirlineLogo/' . $operating_airlinecode[$s]; ?>.gif" alt="flight-logo" class="icon30 bgProperties appendRight10 boldFont"></span>
                                           <p class="makeFlex gap-x-10">
                                               <span class="fontSize14 boldFont"><?php echo $operating_airlinename[$s]; ?></span>
                                               <span class="fontSize14"><?= $operating_airlinecode[$s] . '-' . $operating_flightno[$s]; ?></span>
                                           </p>
                                       </div>
                                       <?php
                                        if ($class == 1) {
                                            $classtype = "Economy";
                                        }
                                        if ($class == 2) {
                                            $classtype = "Premium Economy";
                                        }
                                        if ($class == 3) {
                                            $classtype = "Business";
                                        }
                                        if ($class == 4) {
                                            $classtype = "PremiumBusiness";
                                        }
                                        if ($class == 5) {
                                            $classtype = "First";
                                        }
                                        ?>
                                       <div class="makeFlex">
                                           <div class="makeFlex hrtlCenter">
                                               <span class="fontSize14"> &gt;
                                                   <font color="#249995"><b style="text-transform: uppercase;"><?= $classtype; ?></b></font>
                                               </span>
                                               <span class="bgProperties icon16 appendLeft5 appendTop2" style="background-image: url(./images/flight-booking/traveller-info.1aa44be7.png);">
                                               </span>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="flightItenary">
                                       <div class="flexOne">
                                           <div class="itenaryLeft">
                                               <div class="makeFlex gap-x-10">
                                                   <div class="makeFlex time-info-ui">
                                                       <span class="fontSize14 blackFont"><?php if ($apiname == 'tripjack') {
                                                                                                $dep = explode('T', $operating_deptime[$s]);
                                                                                                // $dep[1] = substr($dep[1], 0, -3);
                                                                                                echo date('H:i', strtotime($dep[1]));
                                                                                            } else {
                                                                                                $dep = explode('T', $operating_deptime[$s]);
                                                                                                $dep[1] = substr($dep[1], 0, -3);
                                                                                                echo date('H:i', strtotime($dep[1]));
                                                                                            } ?> </span>
                                                       <span class="layoverCircle"></span>
                                                   </div>
                                                   <div>
                                                       <span class="fontSize14 blackFont"><?php echo $operating_cityname_o[$s];  ?></span>
                                                       <span class="fontSize14">. <?php echo $operating_airportname_o[$s]; ?>, Terminal
                                                           <?= $operating_terminal_o[$s]; ?></span>
                                                   </div>
                                               </div>
                                               <div class="layover">
                                                   <span class="fontSize14"><?php echo $durationd; ?></span>
                                               </div>
                                               <div class="makeFlex gap-x-10 overideBg">
                                                   <div class="makeFlex time-info-ui">
                                                       <span class="fontSize14 blackFont"><?php if ($apiname == 'tripjack') {
                                                                                                $arr = explode('T', $operating_arritime[$s]);
                                                                                                // $dep[1] = substr($dep[1], 0, -3);
                                                                                                echo date('H:i', strtotime($arr[1]));
                                                                                            } else {
                                                                                                $arr = explode('T', $operating_arritime[$s]);
                                                                                                $arr[1] = substr($arr[1], 0, -3);
                                                                                                echo date('H:i', strtotime($arr[1]));
                                                                                            } ?></span>
                                                       <span class="layoverCircle"></span>
                                                   </div>
                                                   <div>
                                                       <span class="fontSize14 blackFont"><?php echo $operating_cityname_d[$s];  ?> </span>
                                                       <span class="fontSize14">. <?php echo $operating_airportname_d[$s]; ?>,
                                                           Terminal <?= $operating_terminal_d[$s]; ?></span>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="itenaryRight">
                                           <ul class="itenaryList">
                                               <li>
                                                   <span class="fontSize12 res_color">Baggage</span><span class="fontSize12 res_color">Check-in</span><span class="fontSize12 res_color">Cabin</span>
                                               </li>
                                               <li>
                                                   <span class="fontSize12 blackFont">ADULT</span><span class="fontSize12 blackFont"><?= $checkin_baggage[$s]; ?></span><span class="fontSize12 blackFont"><?= $hand_baggage[$s]; ?> (1 piece only)</span>
                                               </li>
                                           </ul>
                                       </div>
                                   </div>
                               </div>


                           <?php } ?>
                       </div>
                       <!-- DOMESTIC ROUNDTRIP -->
                       <?php
                        if ($flight_result->triptype == 'round' && $flight_result->isdomestic == 'true') {
                            $result_r = $flight_result_r;
                            // echo"<pre>";print_r($result_r);exit;
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

                           <div class="flightDetailBlk">
                               <div class="flDetailHdr">
                                   <div>
                                       <h2 class="blackFont">
                                           <b><?php echo current($operating_cityname_o);  ?> → <?php echo end($operating_cityname_d); ?></b>
                                       </h2>
                                       <p class="appendTop10 makeFlex gap-x-10">
                                           <span class="scheduleDay" style="background-color: rgb(255, 237, 209)">
                                               <?php echo date('O, M y', strtotime($this->Tbo_Model->getDate_TimeFromDateTime($operating_deptime[0], 'date'))); ?>

                                           </span>
                                           <span class="fontSize14"><?php echo $route . 'bbbbl'; ?></span>
                                       </p>
                                   </div>

                                   <div class="makeFlex column d_none">
                                       <p class="refundTag" style="background-image: linear-gradient(to right,rgb(45, 193, 140),rgb(33, 147, 147));">
                                           <font color="#ffffff">Cancellation Fees Apply</font>
                                       </p>
                                       <!-- <p class="fontSize14 linkText appendTop10 textRight">
                                       <span data-bs-toggle="modal" data-bs-target="#exampleModal">View Fare
                                           Rules</span>
                                   

                                   </p> -->
                                   </div>
                               </div>
                               <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { ?>
                                   <div class="flightItenaryWrap">
                                       <div class="flightItenaryHdr">
                                           <div class="makeFlex gap-x-10">
                                               <span class="bgProperties icon24" style="background-image: url()"> <img src="<?php echo base_url() . 'Public/AirlineLogo/' . $operating_airlinecode[$j]; ?>.gif" alt="flight-logo" class="icon30 bgProperties appendRight10 boldFont"></span>
                                               <p class="makeFlex gap-x-10">
                                                   <span class="fontSize14 boldFont"><?php echo $operating_airlinename[$j]; ?></span>
                                                   <span class="fontSize14"><?= $operating_flightno[$j]; ?></span>
                                               </p>
                                           </div>
                                           <?php
                                            if ($class == 1) {
                                                $classtype = "Economy";
                                            }
                                            if ($class == 2) {
                                                $classtype = "Premium Economy";
                                            }
                                            if ($class == 3) {
                                                $classtype = "Business";
                                            }
                                            if ($class == 4) {
                                                $classtype = "PremiumBusiness";
                                            }
                                            if ($class == 5) {
                                                $classtype = "First";
                                            }
                                            ?>
                                           <div class="makeFlex">
                                               <div class="makeFlex hrtlCenter">
                                                   <span class="fontSize14"> &gt;
                                                       <font color="#249995"><b style="text-transform: uppercase;"><?= $classtype; ?></b></font>
                                                   </span>
                                                   <span class="bgProperties icon16 appendLeft5 appendTop2" style="background-image: url(./images/flight-booking/traveller-info.1aa44be7.png);">
                                                   </span>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="flightItenary">
                                           <div class="flexOne">
                                               <div class="itenaryLeft">
                                                   <div class="makeFlex gap-x-10">
                                                       <div class="makeFlex time-info-ui">
                                                           <span class="fontSize14 blackFont"><?php echo date('H:i', strtotime($dep[1])); ?></span>
                                                           <span class="layoverCircle"></span>
                                                       </div>
                                                       <div>
                                                           <span class="fontSize14 blackFont"><?php echo $operating_cityname_o[$j];  ?></span>
                                                           <span class="fontSize14">. <?php echo $operating_airportname_o[$j]; ?>, Terminal
                                                               <?= $operating_terminal_o[$j]; ?></span>
                                                       </div>
                                                   </div>
                                                   <div class="layover">
                                                       <span class="fontSize14"><?php echo $durationd; ?></span>
                                                   </div>
                                                   <div class="makeFlex gap-x-10 overideBg">
                                                       <div class="makeFlex time-info-ui">
                                                           <span class="fontSize14 blackFont"><?php $arr = explode('T', $operating_arritime[$j]);
                                                                                                $arr[1] = substr($arr[1], 0, -3);
                                                                                                echo date('H:i', strtotime($arr[1])); ?></span>
                                                           <span class="layoverCircle"></span>
                                                       </div>
                                                       <div>
                                                           <span class="fontSize14 blackFont"><?php echo $operating_cityname_d[$j];  ?> </span>
                                                           <span class="fontSize14">. <?php echo $operating_airportname_d[$j]; ?>,
                                                               Terminal <?= $operating_terminal_d[$j]; ?></span>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="itenaryRight">
                                               <ul class="itenaryList">
                                                   <li>
                                                       <span class="fontSize12 res_color">Baggage</span><span class="fontSize12 res_color">Check-in</span><span class="fontSize12 res_color">Cabin</span>
                                                   </li>
                                                   <li>
                                                       <span class="fontSize12 blackFont">ADULT</span><span class="fontSize12 blackFont"><?= $checkin_baggage[$j]; ?></span><span class="fontSize12 blackFont"><?= $hand_baggage[$j] ?> (1 piece only)</span>
                                                   </li>
                                               </ul>
                                           </div>
                                       </div>
                                   </div>
                           </div>

                   <?php }
                            } ?>

                   <!--  -->
                   <!--  -->
                   <div class="appendTop20 d_none">
                       <section class="refundSection">
                           <div>
                               <div class="refundHdr">
                                   <div class="makeFlex hrtlCenter">
                                       <h3 class="fontSize16 blackFont">
                                           <font color="#000000">Cancellation Refund Policy</font>
                                       </h3>
                                   </div>
                                   <div>
                                       <p class="fontSize14 darkText textRight">
                                           <span class="linkText appendLeft3">View Policy</span>
                                       </p>
                                   </div>
                               </div>
                               <div class="flightDetails reviewCanPolicyWrapper">
                                   <div class="cancSecWrap">
                                       <p class="flightDetailsInfo makeFlex hrtlCenter">
                                           <span class="bgProperties icon24" style="background-image: url()"> <img src="../../../images/flight/UK.png" alt="flight-logo" class="icon30 bgProperties appendRight10 boldFont"></span><span class="blackFont darkText appendLeft10">MAA-BOM</span>
                                       </p>
                                       <div class="timeLineDetailsInfo makeFlex">
                                           <div class="cancInfoLeft">
                                               <p class="appendBottom20">Cancellation Penalty :</p>
                                               <p>Cancel Between (IST) :</p>
                                           </div>
                                           <div class="flexOne">
                                               <div class="makeFlex">
                                                   <span class="cancPriceInfo fontSize16">₹ 3,450</span><span class="cancPriceInfo fontSize16">₹ 3,975</span><span class="cancPriceInfo fontSize16">₹ 8,666</span>
                                               </div>
                                               <p class="cancGradline" style="
                              background-image: linear-gradient(
                                to right,
                                rgb(1, 149, 60),
                                rgb(131, 180, 48),
                                rgb(214, 158, 21),
                                rgb(250, 93, 93)
                              );
                            "></p>
                                               <div class="cancTimeline">
                                                   <div class="cancTimeNode">
                                                       <p class="blackFont">Now</p>
                                                   </div>
                                                   <div class="cancTimeNode">
                                                       <p class="blackFont">12 Aug</p>
                                                       <p class="fontSize12 boldFont">07:00</p>
                                                   </div>
                                                   <div class="cancTimeNode">
                                                       <p class="blackFont">13 Aug</p>
                                                       <p class="fontSize12 boldFont">05:00</p>
                                                   </div>
                                                   <div class="cancTimeNode">
                                                       <p class="blackFont">13 Aug</p>
                                                       <p class="fontSize12 boldFont">07:00</p>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </section>
                   </div>

                   <!--  -->

                   <div>
                       <div class="guestDtls appendBottom20">
                           <div class="accordHead">
                               <div>
                                   <p class="accordHead__text">
                                       <span class="capText">TRAVELLER DETAILS</span>
                                   </p>
                               </div>
                               <div>
                                   <span class="accordBtn appendLeft20 up"></span>
                               </div>
                           </div>
                           <div class="guestDtls__content">
                               <div class="guestDtls__login">
                                   <p class="latoBlack font16">
                                       <a class="anchor">Login</a>&nbsp;to prefill traveler details
                                       and get access to secret deals
                                   </p>
                               </div>
                               <?php if ($this->session->has_userdata('agent_logged_in')) { ?>
                                   <form action="<?php echo site_url(); ?>flights/confirm_itinerary" method="post" class="form">
                                   <?php } else { ?>
                                       <form name="traveler-form" method="POST" action="<?php echo site_url() ?>paywitheasebuzz/easebuzz.php?api_name=initiate_payment" id="continueform" data-parsley-validate>

                                       <?php } ?>
                                       <input type="hidden" name="callBackId" value="<?php echo base64_encode($apiname); ?>" />
                                       <input type="hidden" name="searchId" id="searchId" value="<?php echo $flight_result->search_id; ?>" />
                                       <input type="hidden" name="segmentkey" id="segmentkey" value="<?php echo $flight_result->segmentkey; ?>" />
                                       <input type="hidden" name="booking_switch" value="<?= $flight_result->booking_switch ?>">
                                       <input type="hidden" name="total_cost" value="<?php echo $total_cost; ?>" />
                                       <input type="hidden" name="amount" value="<?php echo number_format($total_cost, 2, '.', ''); ?>" />
                                       <input type="hidden" name="service_type" value="2" />
                                       <input type="hidden" name="surl" value="http://localhost/go_wykin/paywitheasebuzz/response.php" placeholder="http://localhost/go_wykin/paywitheasebuzz/response.php">
                                       <input type="hidden" name="furl" value="http://localhost/go_wykin/paywitheasebuzz/response.php" placeholder="http://localhost/go_wykin/paywitheasebuzz/response.php">
                                       <input type="hidden" name="txnid" value="<?php echo $flight_result->uniquerefno; ?>" placeholder="T31Q6JT8HB">
                                       <input type="hidden" name="productinfo" value="flight">
                                       <?php if ($apiname == 'tripjack') { ?>
                                           <input type="hidden" name="bookingId" value="<?php echo $reviewresp->bookingId; ?>" />
                                       <?php } ?>
                                       <?php if ($flight_result->triptype == 'round' && $flight_result->isdomestic == 'true') { ?>
                                           <input type="hidden" name="searchId1" id="searchId1" value="<?php echo $flight_result_r->search_id; ?>" />
                                           <input type="hidden" name="segmentkey1" id="segmentkey1" value="<?php echo $flight_result_r->segmentkey; ?>" />
                                       <?php } ?>

                                       <!-- passenger count -->
                                       <input type="hidden" id="passenger_count" data-childcount="<?php echo $flight_result->childs; ?>" data-adultcount="<?php echo $flight_result->adults; ?>">

                                       <?php for ($a = 0; $a < $flight_result->adults; $a++) { ?>
                                           <div class="adultDetailsHeading">
                                               <div class="makeFlex perfectCenter">
                                                   <div class="appendRight10"><span class="adultImg bgProperties" style="background-image: url(<?= base_url('assets/images/traveller-placeholder2.png') ?>);"></span></div>
                                                   <p class="fontSize14">
                                                       <font class="boldFont">ADULT <?= $a + 1 ?></font>
                                                   </p>
                                               </div>
                                           </div>

                                           <div class="guestDtls__row">
                                               <div class="makeFlex">
                                                   <div class="guestDtls__col width70 appendRight10">
                                                       <p class="font11 capText appendBottom10">Title</p>
                                                       <div class="frmSelectCont">
                                                           <select name="adultTitle[]" id="adultTitle[]" class="frmSelect" require>
                                                               <option value="Mr">Mr</option>
                                                               <option value="Mrs">Mrs</option>
                                                               <option value="Ms">Ms</option>
                                                           </select>
                                                       </div>
                                                   </div>
                                                   <div class="makeFlex column flexOne">
                                                       <div class="makeFlex res_form_flex">
                                                           <div class="guestDtls__col width247 appendRight10">
                                                               <div class="textFieldCol">
                                                                   <p class="font11 appendBottom10 guestDtlsTextLbl">
                                                                       <span class="capText">FULL NAME</span>
                                                                   </p>
                                                                   <input type="text" name="adultFName[]" id="adultFName[]" class="frmTextInput" placeholder="First Name" value="" require />
                                                               </div>
                                                           </div>
                                                           <div class="guestDtls__col width247">
                                                               <div class="textFieldCol">
                                                                   <p class="font11 appendBottom10 guestDtlsTextLbl">
                                                                       <span class="capText"></span>
                                                                   </p>
                                                                   <input type="text" name="adultLName[]" id="adultLName[]" class="frmTextInput" placeholder="Last Name" value="" />
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>

                                           <div class="adultItemRow appendBottom15">
                                               <!--                                            
                                           <div class="adultItem" style="width: 30%;">
                                               <div class="adultItemSelect"><label class="makeFlex hrtlCenter">Date of birth<span class="bgProperties icon16 appendLeft5 appendTop2 pointer" style="background-image: url(&quot;//jsak.mmtcdn.com/flights/assets/media/traveller-info.1aa44be7.png&quot;);"></span></label>
                                                   <div class="selectOptionGroup">
                                                       <div class="selectInner">
                                                           <select class="selectItem relative ">
                                                               <option value="">Day</option>
                                                           </select>
                                                       </div>
                                                       <div class="selectInner">
                                                           <select class="selectItem relative ">
                                                               <option value="">Month</option>
                                                           </select>
                                                       </div>
                                                       <div class="selectInner">
                                                           <select class="selectItem relative ">
                                                               <option value="">Year</option>
                                                           </select>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div> -->
                                           </div>

                                       <?php } ?>

                                       <!-- details  start-->
                                       <div class="">

                                           <div class="dobpass_fx">
                                               <div class="dob_width">
                                                   <p class="font11 appendBottom10 guestDtlsTextLbl">
                                                       <span class="capText">DATE OF BIRTH</span>
                                                   </p>
                                                   <div class="dobSelect_fx">
                                                       <span class="dob_input frmSelectCont">
                                                           <select class="form-control required" name="adultDOBDate[]" id="adultDOBDate[]" data-parsley-id="23" required="required">
                                                               <option value="">Day</option>
                                                               <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                                                                   <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                                                               <?php } ?>
                                                           </select></span>
                                                       <span class="dob_input frmSelectCont">
                                                           <select class="form-control required" name="adultDOBMonth[]" id="adultDOBMonth[]" data-parsley-id="25" required="required">
                                                               <option value="">Month</option>
                                                               <option value="01">January</option>
                                                               <option value="02">February</option>
                                                               <option value="03">March</option>
                                                               <option value="04">April</option>
                                                               <option value="05">May</option>
                                                               <option value="06">June</option>
                                                               <option value="07">July</option>
                                                               <option value="08">August</option>
                                                               <option value="09">September</option>
                                                               <option value="10">October</option>
                                                               <option value="11">November</option>
                                                               <option value="12">December</option>
                                                           </select></span>
                                                       <span class="dob_input frmSelectCont">
                                                           <select class="form-control required" name="adultDOBYear[]" id="adultDOBYear[]" data-parsley-id="27" required="required">
                                                               <option value="">Year</option>
                                                               <?php for ($ag = 1930; $ag <= (date('Y') - 12); $ag++) { ?>
                                                                   <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                                                               <?php } ?>
                                                           </select></span>
                                                   </div>

                                               </div>
                                               <?php if ($flight_result->isdomestic == 'false') {  ?>
                                                   <div class="">
                                                       <p class="font11 appendBottom10 guestDtlsTextLbl">
                                                           <span class="capText">PASSPORT NO</span>
                                                       </p>
                                                       <span class="pass_input"><input type="text" name="adultPPNo[]" id="adultPPNo[]" placeholder="Passport No"></span>
                                                   </div>
                                           </div>

                                       </div>
                                       <div class="">

                                           <div class="dobpass_fx">
                                               <div class="dob_width">
                                                   <p class="font11 appendBottom10 guestDtlsTextLbl">
                                                       <span class="capText">PASSPORT EXPIRY DATE</span>
                                                   </p>
                                                   <div class="dobSelect_fx">
                                                       <span class="dob_input frmSelectCont">
                                                           <select class="form-control required" name="adultPPEDate[]" id="adultPPEDate[]" data-parsley-id="23" required="required">
                                                               <option value="">Day</option>
                                                               <?php for ($ap = 1; $ap <= 31; $ap++) { ?>
                                                                   <option value="<?php echo str_pad($ap, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ap, 2, "0", STR_PAD_LEFT); ?></option>
                                                               <?php } ?>
                                                           </select></span>
                                                       <span class="dob_input frmSelectCont"><select class="form-control required" name="adultPPEMonth[]" id="adultPPEMonth[]" data-parsley-id="25" required="required">
                                                               <option value="">Month</option>
                                                               <option value="01">January</option>
                                                               <option value="02">February</option>
                                                               <option value="03">March</option>
                                                               <option value="04">April</option>
                                                               <option value="05">May</option>
                                                               <option value="06">June</option>
                                                               <option value="07">July</option>
                                                               <option value="08">August</option>
                                                               <option value="09">September</option>
                                                               <option value="10">October</option>
                                                               <option value="11">November</option>
                                                               <option value="12">December</option>
                                                           </select></span>
                                                       <span class="dob_input frmSelectCont">

                                                           <select class="form-control required" name="adultPPEYear[]" id="adultPPEYear[]" data-parsley-id="33" required="required">
                                                               <option value="">Year</option>
                                                               <?php for ($ag = date('Y'); $ag <= (date('Y') + 200); $ag++) { ?>
                                                                   <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                                                               <?php } ?>
                                                           </select>
                                                       </span>
                                                   </div>
                                               </div>
                                               <div class="">
                                                   <p class="font11 appendBottom10 guestDtlsTextLbl">
                                                       <span class="capText">PASSPORT ISSUING COUNTRY</span>
                                                   </p>
                                                   <span class="pass_input"><select class="form-control required" name="adultPPICountry[]" id="adultPPICountry[]" data-parsley-id="35" required="required">
                                                           <option value="">Place of Issue</option>
                                                           <?php foreach ($country_list as $con) { ?>
                                                               <option value="<?php echo $con->iso2; ?>"><?php echo $con->name; ?></option>
                                                           <?php } ?>
                                                       </select>
                                                   </span>
                                               </div>
                                           </div>
                                       <?php } ?>
                                       <div class="nationlity_margin">
                                           <p class="font11 appendBottom10 guestDtlsTextLbl">
                                               <span class="capText">NATIONALITY</span>
                                           </p>
                                           <span class="nationality_input "><select class="form-control required" name="adultPPNationality[]" id="adultPPNationality[]" data-parsley-id="35" required="required">
                                                   <option value="">Nationality</option>
                                                   <?php foreach ($country_list as $con) { ?>
                                                       <option value="<?php echo $con->iso2; ?>"><?php echo $con->name; ?></option>
                                                   <?php } ?>
                                               </select>
                                           </span>
                                       </div>

                                       </div>
                                       <!-- details end -->


                                       <div class="guestDtls__row">
                                           <div class="makeFlex res_form_flex">
                                               <div class="guestDtls__col width327 appendRight10">
                                                   <div class="textFieldCol">
                                                       <p class="font11 appendBottom10 guestDtlsTextLbl">
                                                           <span class="capText">Email Address</span>
                                                           <span class="grayText appendLeft3 font9">(Booking voucher will be
                                                               sent to this email
                                                               ID)</span>
                                                       </p>
                                                       <input type="text" id="email" name="email" class="frmTextInput" placeholder="Email ID" value="" />
                                                   </div>
                                               </div>
                                               <div class="guestDtls__col width327">
                                                   <p class="font11 capText appendBottom10">
                                                       Mobile Number
                                                   </p>
                                                   <div class="makeFlex textLtr">
                                                       <div class="guestDtls__contact">
                                                           <label for="mCode" class="frmSelectCont__contact">
                                                               <select name="mobilecode" id="mCode" class="frmSelect frmSelectContact">
                                                                   <option value="+93">Afghanistan (+93)</option>
                                                                   <option value="+355">Albania (+355)</option>
                                                                   <option value="+213">Algeria (+213)</option>
                                                                   <option value="+1684">
                                                                       American Samoa (+1684)
                                                                   </option>
                                                                   <option value="+376">Andorra (+376)</option>
                                                                   <option value="+244">Angola (+244)</option>
                                                                   <option value="+1264">Anguilla (+1264)</option>
                                                                   <option value="+672">Antarctica (+672)</option>
                                                                   <option value="+1268">
                                                                       Antigua and Barbuda (+1268)
                                                                   </option>
                                                                   <option value="+54">Argentina (+54)</option>
                                                                   <option value="+374">Armenia (+374)</option>
                                                                   <option value="+297">Aruba (+297)</option>
                                                                   <option value="+61">Australia (+61)</option>
                                                                   <option value="+43">Austria (+43)</option>
                                                                   <option value="+994">Azerbaijan (+994)</option>
                                                                   <option value="+1242">Bahamas (+1242)</option>
                                                                   <option value="+973">Bahrain (+973)</option>
                                                                   <option value="+880">Bangladesh (+880)</option>
                                                                   <option value="+1246">Barbados (+1246)</option>
                                                                   <option value="+32">Belgium (+32)</option>
                                                                   <option value="+501">Belize (+501)</option>
                                                                   <option value="+229">Benin (+229)</option>
                                                                   <option value="+1441">Bermuda (+1441)</option>
                                                                   <option value="+975">Bhutan (+975)</option>
                                                                   <option value="+591">Bolivia (+591)</option>
                                                                   <option value="+267">Botswana (+267)</option>
                                                                   <option value="+55">Brazil (+55)</option>
                                                                   <option value="+246">
                                                                       British Indian Ocean Territory (+246)
                                                                   </option>
                                                                   <option value="+1284">
                                                                       British Virgin Islands (+1284)
                                                                   </option>
                                                                   <option value="+673">Brunei (+673)</option>
                                                                   <option value="+226">
                                                                       Burkina Faso (+226)
                                                                   </option>
                                                                   <option value="+257">Burundi (+257)</option>
                                                                   <option value="+855">Cambodia (+855)</option>
                                                                   <option value="+237">Cameroon (+237)</option>
                                                                   <option value="+1">Canada (+1)</option>
                                                                   <option value="+238">Cape Verde (+238)</option>
                                                                   <option value="+1345">
                                                                       Cayman Islands (+1345)
                                                                   </option>
                                                                   <option value="+236">
                                                                       Central African Republic (+236)
                                                                   </option>
                                                                   <option value="+235">Chad (+235)</option>
                                                                   <option value="+56">Chile (+56)</option>
                                                                   <option value="+86">China (+86)</option>
                                                                   <option value="+61">
                                                                       Christmas Island (+61)
                                                                   </option>
                                                                   <option value="+61">Cocos Islands (+61)</option>
                                                                   <option value="+57">Colombia (+57)</option>
                                                                   <option value="+269">Comoros (+269)</option>
                                                                   <option value="+682">
                                                                       Cook Islands (+682)
                                                                   </option>
                                                                   <option value="+506">Costa Rica (+506)</option>
                                                                   <option value="+599">Curacao (+599)</option>
                                                                   <option value="+357">Cyprus (+357)</option>
                                                                   <option value="+420">
                                                                       Czech Republic (+420)
                                                                   </option>
                                                                   <option value="+45">Denmark (+45)</option>
                                                                   <option value="+253">Djibouti (+253)</option>
                                                                   <option value="+1767">Dominica (+1767)</option>
                                                                   <option value="+18">
                                                                       Dominican Republic (+18)
                                                                   </option>
                                                                   <option value="+670">East Timor (+670)</option>
                                                                   <option value="+593">Ecuador (+593)</option>
                                                                   <option value="+20">Egypt (+20)</option>
                                                                   <option value="+503">El Salvador (+503)</option>
                                                                   <option value="+240">
                                                                       Equatorial Guinea (+240)
                                                                   </option>
                                                                   <option value="+291">Eritrea (+291)</option>
                                                                   <option value="+372">Estonia (+372)</option>
                                                                   <option value="+251">Ethiopia (+251)</option>
                                                                   <option value="+500">
                                                                       Falkland Islands (+500)
                                                                   </option>
                                                                   <option value="+298">
                                                                       Faroe Islands (+298)
                                                                   </option>
                                                                   <option value="+679">Fiji (+679)</option>
                                                                   <option value="+358">Finland (+358)</option>
                                                                   <option value="+33">France (+33)</option>
                                                                   <option value="+689">
                                                                       French Polynesia (+689)
                                                                   </option>
                                                                   <option value="+241">Gabon (+241)</option>
                                                                   <option value="+220">Gambia (+220)</option>
                                                                   <option value="+995">Georgia (+995)</option>
                                                                   <option value="+49">Germany (+49)</option>
                                                                   <option value="+233">Ghana (+233)</option>
                                                                   <option value="+350">Gibraltar (+350)</option>
                                                                   <option value="+30">Greece (+30)</option>
                                                                   <option value="+299">Greenland (+299)</option>
                                                                   <option value="+1473">Grenada (+1473)</option>
                                                                   <option value="+1671">Guam (+1671)</option>
                                                                   <option value="+502">Guatemala (+502)</option>
                                                                   <option value="+441481">
                                                                       Guernsey (+441481)
                                                                   </option>
                                                                   <option value="+224">Guinea (+224)</option>
                                                                   <option value="+245">
                                                                       Guinea-Bissau (+245)
                                                                   </option>
                                                                   <option value="+592">Guyana (+592)</option>
                                                                   <option value="+509">Haiti (+509)</option>
                                                                   <option value="+504">Honduras (+504)</option>
                                                                   <option value="+852">Hong Kong (+852)</option>
                                                                   <option value="+36">Hungary (+36)</option>
                                                                   <option value="+354">Iceland (+354)</option>
                                                                   <option value="+91">India (+91)</option>
                                                                   <option value="+62">Indonesia (+62)</option>
                                                                   <option value="+353">Ireland (+353)</option>
                                                                   <option value="+441624">
                                                                       Isle of Man (+441624)
                                                                   </option>
                                                                   <option value="+972">Israel (+972)</option>
                                                                   <option value="+39">Italy (+39)</option>
                                                                   <option value="+1876">Jamaica (+1876)</option>
                                                                   <option value="+81">Japan (+81)</option>
                                                                   <option value="+441534">
                                                                       Jersey (+441534)
                                                                   </option>
                                                                   <option value="+962">Jordan (+962)</option>
                                                                   <option value="+7">Kazakhstan (+7)</option>
                                                                   <option value="+254">Kenya (+254)</option>
                                                                   <option value="+686">Kiribati (+686)</option>
                                                                   <option value="+965">Kuwait (+965)</option>
                                                                   <option value="+996">Kyrgyzstan (+996)</option>
                                                                   <option value="+856">Laos (+856)</option>
                                                                   <option value="+371">Latvia (+371)</option>
                                                                   <option value="+266">Lesotho (+266)</option>
                                                                   <option value="+423">
                                                                       Liechtenstein (+423)
                                                                   </option>
                                                                   <option value="+370">Lithuania (+370)</option>
                                                                   <option value="+352">Luxembourg (+352)</option>
                                                                   <option value="+853">Macau (+853)</option>
                                                                   <option value="+389">Macedonia (+389)</option>
                                                                   <option value="+261">Madagascar (+261)</option>
                                                                   <option value="+265">Malawi (+265)</option>
                                                                   <option value="+60">Malaysia (+60)</option>
                                                                   <option value="+960">Maldives (+960)</option>
                                                                   <option value="+223">Mali (+223)</option>
                                                                   <option value="+356">Malta (+356)</option>
                                                                   <option value="+692">
                                                                       Marshall Islands (+692)
                                                                   </option>
                                                                   <option value="+222">Mauritania (+222)</option>
                                                                   <option value="+230">Mauritius (+230)</option>
                                                                   <option value="+262">Mayotte (+262)</option>
                                                                   <option value="+52">Mexico (+52)</option>
                                                                   <option value="+691">Micronesia (+691)</option>
                                                                   <option value="+377">Monaco (+377)</option>
                                                                   <option value="+976">Mongolia (+976)</option>
                                                                   <option value="+1664">
                                                                       Montserrat (+1664)
                                                                   </option>
                                                                   <option value="+212">Morocco (+212)</option>
                                                                   <option value="+258">Mozambique (+258)</option>
                                                                   <option value="+95">Myanmar (+95)</option>
                                                                   <option value="+264">Namibia (+264)</option>
                                                                   <option value="+674">Nauru (+674)</option>
                                                                   <option value="+977">Nepal (+977)</option>
                                                                   <option value="+31">Netherlands (+31)</option>
                                                                   <option value="+599">
                                                                       Netherlands Antilles (+599)
                                                                   </option>
                                                                   <option value="+687">
                                                                       New Caledonia (+687)
                                                                   </option>
                                                                   <option value="+64">New Zealand (+64)</option>
                                                                   <option value="+505">Nicaragua (+505)</option>
                                                                   <option value="+227">Niger (+227)</option>
                                                                   <option value="+234">Nigeria (+234)</option>
                                                                   <option value="+683">Niue (+683)</option>
                                                                   <option value="+1670">
                                                                       Northern Mariana Islands (+1670)
                                                                   </option>
                                                                   <option value="+47">Norway (+47)</option>
                                                                   <option value="+968">Oman (+968)</option>
                                                                   <option value="+92">Pakistan (+92)</option>
                                                                   <option value="+680">Palau (+680)</option>
                                                                   <option value="+970">Palestine (+970)</option>
                                                                   <option value="+507">Panama (+507)</option>
                                                                   <option value="+675">
                                                                       Papua New Guinea (+675)
                                                                   </option>
                                                                   <option value="+595">Paraguay (+595)</option>
                                                                   <option value="+51">Peru (+51)</option>
                                                                   <option value="+63">Philippines (+63)</option>
                                                                   <option value="+64">Pitcairn (+64)</option>
                                                                   <option value="+48">Poland (+48)</option>
                                                                   <option value="+351">Portugal (+351)</option>
                                                                   <option value="+1">Puerto Rico (+1)</option>
                                                                   <option value="+974">Qatar (+974)</option>
                                                                   <option value="+262">Reunion (+262)</option>
                                                                   <option value="+7">Russia (+7)</option>
                                                                   <option value="+250">Rwanda (+250)</option>
                                                                   <option value="+590">
                                                                       Saint Barthelemy (+590)
                                                                   </option>
                                                                   <option value="+290">
                                                                       Saint Helena (+290)
                                                                   </option>
                                                                   <option value="+1869">
                                                                       Saint Kitts and Nevis (+1869)
                                                                   </option>
                                                                   <option value="+1758">
                                                                       Saint Lucia (+1758)
                                                                   </option>
                                                                   <option value="+590">
                                                                       Saint Martin (+590)
                                                                   </option>
                                                                   <option value="+508">
                                                                       Saint Pierre and Miquelon (+508)
                                                                   </option>
                                                                   <option value="+1784">
                                                                       Saint Vincent and the Grenadines (+1784)
                                                                   </option>
                                                                   <option value="+685">Samoa (+685)</option>
                                                                   <option value="+378">San Marino (+378)</option>
                                                                   <option value="+239">
                                                                       Sao Tome and Principe (+239)
                                                                   </option>
                                                                   <option value="+966">
                                                                       Saudi Arabia (+966)
                                                                   </option>
                                                                   <option value="+221">Senegal (+221)</option>
                                                                   <option value="+248">Seychelles (+248)</option>
                                                                   <option value="+232">
                                                                       Sierra Leone (+232)
                                                                   </option>
                                                                   <option value="+65">Singapore (+65)</option>
                                                                   <option value="+1721">
                                                                       Sint Maarten (+1721)
                                                                   </option>
                                                                   <option value="+421">Slovakia (+421)</option>
                                                                   <option value="+677">
                                                                       Solomon Islands (+677)
                                                                   </option>
                                                                   <option value="+252">Somalia (+252)</option>
                                                                   <option value="+82">South Korea (+82)</option>
                                                                   <option value="+211">South Sudan (+211)</option>
                                                                   <option value="+94">Sri Lanka (+94)</option>
                                                                   <option value="+47">
                                                                       Svalbard and Jan Mayen (+47)
                                                                   </option>
                                                                   <option value="+268">Swaziland (+268)</option>
                                                                   <option value="+46">Sweden (+46)</option>
                                                                   <option value="+41">Switzerland (+41)</option>
                                                                   <option value="+886">Taiwan (+886)</option>
                                                                   <option value="+992">Tajikistan (+992)</option>
                                                                   <option value="+255">Tanzania (+255)</option>
                                                                   <option value="+66">Thailand (+66)</option>
                                                                   <option value="+228">Togo (+228)</option>
                                                                   <option value="+690">Tokelau (+690)</option>
                                                                   <option value="+676">Tonga (+676)</option>
                                                                   <option value="+1868">
                                                                       Trinidad and Tobago (+1868)
                                                                   </option>
                                                                   <option value="+216">Tunisia (+216)</option>
                                                                   <option value="+90">Turkey (+90)</option>
                                                                   <option value="+993">
                                                                       Turkmenistan (+993)
                                                                   </option>
                                                                   <option value="+1649">
                                                                       Turks and Caicos Islands (+1649)
                                                                   </option>
                                                                   <option value="+688">Tuvalu (+688)</option>
                                                                   <option value="+1340">
                                                                       U.S. Virgin Islands (+1340)
                                                                   </option>
                                                                   <option value="+256">Uganda (+256)</option>
                                                                   <option value="+380">Ukraine (+380)</option>
                                                                   <option value="+971">
                                                                       United Arab Emirates (+971)
                                                                   </option>
                                                                   <option value="+44">
                                                                       United Kingdom (+44)
                                                                   </option>
                                                                   <option value="+1">United States (+1)</option>
                                                                   <option value="+598">Uruguay (+598)</option>
                                                                   <option value="+998">Uzbekistan (+998)</option>
                                                                   <option value="+678">Vanuatu (+678)</option>
                                                                   <option value="+379">Vatican (+379)</option>
                                                                   <option value="+58">Venezuela (+58)</option>
                                                                   <option value="+84">Vietnam (+84)</option>
                                                                   <option value="+681">
                                                                       Wallis and Futuna (+681)
                                                                   </option>
                                                                   <option value="+212">
                                                                       Western Sahara (+212)
                                                                   </option>
                                                                   <option value="+967">Yemen (+967)</option>
                                                                   <option value="+260">Zambia (+260)</option>
                                                                   <option value="+387">
                                                                       Bosnia and Herzegovina (+387)
                                                                   </option>
                                                                   <option value="+359">Bulgaria (+359)</option>
                                                                   <option value="+385">Croatia (+385)</option>
                                                                   <option value="+383">Kosovo (+383)</option>
                                                                   <option value="+373">Moldova (+373)</option>
                                                                   <option value="+382">Montenegro (+382)</option>
                                                                   <option value="+389">
                                                                       North Macedonia (+389)
                                                                   </option>
                                                                   <option value="+40">Romania (+40)</option>
                                                                   <option value="+381">Serbia (+381)</option>
                                                                   <option value="+386">Slovenia (+386)</option>
                                                                   <option value="+375">Belarus (+375)</option>
                                                                   <option value="+95">Burma (+95)</option>
                                                                   <option value="+225">
                                                                       Cote D`Ivoire (Ivory Coast) (+225)
                                                                   </option>
                                                                   <option value="+243">
                                                                       Democratic Republic of Congo (+243)
                                                                   </option>
                                                                   <option value="+964">Iraq (+964)</option>
                                                                   <option value="+231">Liberia (+231)</option>
                                                                   <option value="+249">Sudan (+249)</option>
                                                                   <option value="+263">Zimbabwe (+263)</option>
                                                               </select>
                                                           </label>
                                                           <span class="selectedCode">+91</span>
                                                       </div>
                                                       <div class="flexOne">
                                                           <div class="textFieldCol">
                                                               <input type="text" id="mNo" name="phone" class="frmTextInput noLeftBorder" placeholder="Contact Number" value="" />
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="guestDtls__row">
                                           <div class="appendBottom15">
                                               <span class="checkmarkOuter">
                                                   <input type="checkbox" id="gstVisible" />
                                                   <label class="makeFlex hrtlCenter" id="gstVisible2" for="gstVisible">
                                                       <span class="font14 blackText appendRight5">Enter GST Details</span>
                                                       <span class="font11 grayText">(Optional)</span>
                                                   </label>
                                               </span>
                                           </div>
                                           <div class="makeFlex res_gst_visible res_form_flex" style="display: none;">
                                               <div class="guestDtls__col width220 appendRight10">
                                                   <div class="textFieldCol">
                                                       <p class="font11 appendBottom10 guestDtlsTextLbl">
                                                           <span class="capText">Registration Number</span>
                                                       </p>
                                                       <input type="text" id="gstNo" name="GstNumber" class="frmTextInput" placeholder="Enter Registration No." value="" />
                                                   </div>
                                               </div>
                                               <div class="guestDtls__col width220 appendRight10">
                                                   <div class="textFieldCol">
                                                       <p class="font11 appendBottom10 guestDtlsTextLbl">
                                                           <span class="capText">Registered Company name</span>
                                                       </p>
                                                       <input type="text" id="cName" name="GstCompanyName" class="frmTextInput" placeholder="Enter Company Name" value="" />
                                                   </div>
                                               </div>
                                               <div class="guestDtls__col width220 appendRight10">
                                                   <div class="textFieldCol">
                                                       <p class="font11 appendBottom10 guestDtlsTextLbl">
                                                           <span class="capText">Registered Company address</span>
                                                       </p>
                                                       <input type="text" id="cAddr" name="GstAddress" class="frmTextInput" placeholder="Enter Company Address" value="" />
                                                   </div>
                                               </div>
                                           </div>
                                       </div>


                           </div>
                       </div>
                   </div>
                   </div>
               </div>
           </div>

           <!--  -->

           <div class="col-md-12 col-lg-4">
               <div class="makeRelative">
                   <div class="prcBreakup appendBottom30" style="background-repeat-x: no-repeat;">
                       <div class="prcBreakup__hdr">PRICE BREAK-UP</div>
                       <div class="prcBreakup__cont">
                           <div class="prcBreakup__row">
                               <div class="makeFlex flexOne spaceBetween">
                                   <div class="prcBreakup__lft">
                                       <p class="latoBold blackText makeFlex">
                                           <span>Base Price</span>
                                       </p>
                                   </div>
                                   <div class="prcBreakup__rht">
                                       <p class="latoBold">₹ <?php echo number_format(round($basefare)); ?></p>
                                   </div>
                               </div>
                           </div>
                           <div class="prcBreakup__row">
                               <div class="makeFlex flexOne spaceBetween">
                                   <div class="prcBreakup__lft">
                                       <div class="latoBold blackText makeFlex hrtlCenter">
                                           Taxes
                                           <div class="ttlDscTooltip appendLeft5">
                                               <span class="sprite infoIconBlue pointer"><i class="fa fa-exclamation-circle"></i></span>
                                               <div class="ttlDiscount">
                                                   <ul class="ttlDiscount__list">
                                                       <li class="ttlDiscount__listItem">
                                                           <div class="flexOne">
                                                               <div class="makeFlex spaceBetween whiteText">
                                                                   <p class=" ">GST</p>
                                                                   <p class="noShrink">₹ <?php echo number_format(round($tax)); ?></p>
                                                               </div>
                                                           </div>
                                                       </li>
                                                   </ul>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="prcBreakup__rht">
                                       <p class="latoBold">₹ <?php echo number_format(round($tax)); ?></p>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="prcBreakup__total">
                           <div class="makeFlex flexOne spaceBetween">
                               <div class="prcBreakup__lft">
                                   <p class="latoBlack blackText">Total Amount to be paid</p>
                               </div>
                               <div class="prcBreakup__rht">
                                   <p class="latoBlack redText">₹ <?php echo number_format($total_amount); ?></p>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="makeRelative">
                   <div class="dlCodes appendBottom20">
                       <p class="latoBlack font14 capText appendBottom15 blackText">
                           Deal Codes
                       </p>
                       <p class="blackText font12 appendBottom10">
                           No coupon codes applicable for this property.
                       </p>
                       <div class="cpnCont">
                           <div class="cpnInput">
                               <input type="text" placeholder="Have a Coupon Code" value="" /><a class="cpnInput__btn" data-testid="applyCpnBtn"><span class="sprite icWhiteArrow">
                                       <i class="fa fa-arrow-right"></i></span></a>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="whySignIn appendBottom20">
                   <p class="latoBlack font14 capText blackText appendBottom7">
                       Why <a class="anchor">Sign up</a> or <a class="anchor">Login</a>
                   </p>
                   <ul class="whySignIn__list">
                       <li class="whySignIn__listItem">
                           <span class="whySignIn__listIcon"><span class="sprite icGreenTick"></span></span><span>Get access to
                               <span class="latoBold blackText">Secret Deals</span></span>
                       </li>
                       <li class="whySignIn__listItem">
                           <span class="whySignIn__listIcon"><span class="sprite icGreenTick"></span></span><span><span class="latoBold blackText">Book Faster</span> - we’ll
                               save &amp; pre-enter your details</span>
                       </li>
                       <li class="whySignIn__listItem">
                           <span class="whySignIn__listIcon"><span class="sprite icGreenTick"></span></span><span><span class="latoBold blackText">Manage your bookings</span>
                               from one place</span>
                       </li>
                   </ul>
               </div>

               <!-- responsive -->
           </div>
       </div>

       </div>

       <div class="container">
           <div class="row pb-5">
               <div class="tncCard appendBottom15 justify-content-center">
                   <p class="font12 lineHight16">
                       By proceeding, I agree to Gosky’s
                       <a rel="noopener noreferrer" target="_blank" href="#">User Agreement</a>,

                       <a rel="noopener noreferrer" target="_blank" href="#">Terms of Service</a>and

                       <a href="#">Cancellation &amp; Property Booking Policies</a>.
                   </p>
               </div>
               <div class="makeFlex hrtlCenter res_btn justify-content-center">
                   <div class="">
                       <a class="btnContinuePayment primaryBtn capText">Pay Now</a>
                       <div class="cstmTooltip top" style="
                      width: 200px;
                      height: auto;
                      position: absolute;
                      background-color: rgb(0, 0, 0);
                      border-radius: 4px;
                      padding: 16px;
                      border-width: 0px;
                      border-style: initial;
                      border-image: initial;
                      top: 40px;
                      left: 55px;
                      z-index: 2;
                    ">
                           <p class="whiteText lineHeight18">
                               Your organisation does not allow to book out of policy
                               bookings.
                           </p>
                       </div>
                   </div>
               </div>
           </div>
       </div>


       </div>
       </div>
   </section>


   <!--payment end-->

   <script src="<?php echo base_url(); ?>js/flight.js"></script>

   <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
   <script src=" <?php echo base_url(); ?>assets/jquery/jquery.ui.js"></script>

   <script>
       $(function() {
           $(".datepicker").datepicker({
               numberOfMonths: 1,
               minDate: 0
           });
           $("#anim").on("change", function() {
               $(".datepicker").datepicker("option", "showAnim", $(this).val());
           });
       });
   </script>

   <script>
       $(document).ready(function() {
           $("#formbutton").click(function() {
               $("#continueform").submit(); // Submit the form
           });
       });
   </script>
   <script>
       $('#iagreed').click(function() {
           if (this.checked == true) {
               //    $('form[name="traveler-form"]').valid();
               $.ajax({
                   type: 'POST',
                   async: true,
                   dataType: 'json',
                   data: $('form[name="traveler-form"]').serializeArray(),
                   url: '<?= site_url(); ?>flights/checkout',
                   beforeSend: function() {
                       //$(".loading").fadeIn();
                   },
                   success: function(response) {

                   }
               });
           }
       });
   </script>
   </body>

   </html>