<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<?php $this->load->view('home/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/result.css">
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
   
   // echo "<pre>";print_r($flight_result);exit;
   // $Origin = $flight_result->origin;
   // $Destination = $flight_result->destination;
   $Origin = $flight_result->operating_airportname_o;
   $Destination = $flight_result->operating_airportname_d;
   $isdomestic = $flight_result->isdomestic;
   $fromCityName = $this->Tripjack_Model->get_airport_cityname($Origin);
   $toCityName = $this->Tripjack_Model->get_airport_cityname($Destination);
   $segment_indicator = explode(',', $flight_result->segment_indicator);
   // print_r($segment_indicator);exit;
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
   // if ($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true') {
   //   $fareinformation = json_decode($flight_result_r->farearray);
   //     // echo '<pre>';print_r($fareinformation);exit;
   
   //     $basefare=$IBaggage=$tax=$classes=$Cbaggage=$fareIdentifier=$id=array();
   //     foreach ($fareinformation as $value) {
   //         $basefare[] = $value->fd->ADULT->fC->BF;
   //         $tax[] = $value->fd->ADULT->fC->TAF;
   //         $IBaggage[] = $value->fd->ADULT->bI->iB;
   //         $Cbaggage[] = $value->fd->ADULT->bI->cB;
   //         $fareIdentifier[] = $value->fareIdentifier;
   //         $id[] = $value->id;
   //         $classes[] = $value->fd->ADULT->cc;
   //     }
   
   //     $basefare=implode(',',$basefare);
   //  // echo '<pre>wqw';print_r($basefare);exit;
   //     $tax=implode(',',$tax);
   //     $IBaggage=implode(',',$IBaggage);
   //     $Cbaggage=implode(',',$Cbaggage);
   //     $fareIdentifier=implode(',',$fareIdentifier);
   //     $classes=implode(',',$classes);
   
   //     $fare = explode(',', $basefare); 
   //     $tax = explode(',', $tax);
   //     $total_amount = $fare[0]+$tax[0];
   //     $Ibag = explode(',', $IBaggage);
   //     $cbag = explode(',', $Cbaggage);
   //     $baggageinformation = $Ibag[0].' ,'. $cbag[0];
   
   //     $baser = $fare[0];
   //     // $taxr = $flight_result_r->tax+$flight_result_r->admin_markup+$flight_result_r->agent_markup+$flight_result_r->payment_charge;
   //     $taxr = $tax[0]+$flight_result_r->admin_markup+$flight_result_r->agent_markup;
   //     $convinience_feer = $flight_result_r->payment_charge;
   //     $totalr = $fare[0]+$tax[0];
   //     $agentmmarkr = $flight_result_r->agent_markup;
   // } else {
   //     $baser = 0;
   //     $taxr = 0;
   //     $totalr = 0;
   //     $agentmmarkr = 0;
   //     $convinience_feer =0;
   // }
   
   $fareinformation = json_decode($flight_result->farearray);
   // echo '<pre>';print_r($fareinformation);exit;
   
   $basefare=$IBaggage=$tax=$classes=$Cbaggage=$fareIdentifier=$id=array();
   foreach ($fareinformation as $value) {
       $basefare[] = $value->fd->ADULT->fC->BF;
       $tax[] = $value->fd->ADULT->fC->TAF;
       $IBaggage[] = $value->fd->ADULT->bI->iB;
       $Cbaggage[] = $value->fd->ADULT->bI->cB;
       $fareIdentifier[] = $value->fareIdentifier;
       $id[] = $value->id;
       $classes[] = $value->fd->ADULT->cc;
   }
   
   $basefare=implode(',',$basefare);
   // echo '<pre>wqw';print_r($basefare);exit;
   $tax=implode(',',$tax);
   $IBaggage=implode(',',$IBaggage);
   $Cbaggage=implode(',',$Cbaggage);
   $fareIdentifier=implode(',',$fareIdentifier);
   $classes=implode(',',$classes);
   
   $fare = explode(',', $basefare); 
   $tax = explode(',', $tax);
   $total_amount = $fare[0]+$tax[0];
   $Ibag = explode(',', $IBaggage);
   $cbag = explode(',', $Cbaggage);
   $baggageinformation = $Ibag[0].' ,'. $cbag[0]; 
   
   $total_amount_o = $fare[0]+$tax[0];
   
   
   $basefare = $fare[0] + $baser;
   // $tax = $flight_result->tax+$flight_result->admin_markup+$flight_result->agent_markup+$flight_result->payment_charge + $taxr;
   $tax = $tax[0]+$flight_result->admin_markup+$flight_result->agent_markup + $taxr;
   $payment_charge = $flight_result->payment_charge + $convinience_feer;
   $total_amount = $total_amount_o + $totalr +$payment_charge;
   $currency = $flight_result->currency;
   $agent_markup = $flight_result->agent_markup + $agentmmarkr;
   
   ///Special Request
   
   $lcc = $flight_result->islcc;
   $meal = $reviewresp->tripInfos;
   $meal = $reviewresp->tripInfos;
   $AirportCode_o = $AirportCode_d = $key = $baggageinformation = $mealinformation =array();
   
   foreach ($meal as $value) {
     $ssr = $value->sI;
     // echo '<pre>'; print_r($ssr);exit;
     foreach ($ssr as $value1) {
       $key[] = $value1->id;
       $AirportCode_o[] = $value->da->code;
       $AirportCode_d[] = $value->aa->code;
       $baggageinformation[] = $value1->ssrInfo->BAGGAGE;
       $mealinformation[] = $value1->ssrInfo->MEAL;
     }
   }
   
   // echo '<pre>'; print_r($mealinformation);exit;
   
   
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
   // $this->load->model('Flight_Model');
   $tripseat = $seatresp->tripSeatMap->tripSeat->$key[0]->sInfo;
   $tripseat1 = $seatresp->tripSeatMap->tripSeat->$key[1]->sInfo;
   
   $key = implode(',', $key1);
   
   // echo '<pre>ewwe';print_r($operating_airlinecode);exit;
   
   ?>
<style type="text/css">
   /* Clearable text inputs */
   .clearable{
   position: relative;
   display: inline-block;
   }
   .clearable input[type=text]{
   padding-right: 24px;
   width: 100%;
   box-sizing: border-box;
   }
   .clearable__clear{
   display: inline-block;
   position: absolute;
   right:0; top:0;
   padding: 0 8px;
   font-style: normal;
   font-size: 1.2em;
   user-select: none;
   cursor: pointer;
   }
   .clearable input::-ms-clear {  /* Remove IE default X */
   display: inline-block;
   }
</style>
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
      <!-- <form name="booking" method="POST" action="<?php echo site_url() ?>Flights-Payment" id="continueform" data-parsley-validate> -->
      <form name="booking" method="POST" 
         action="<?php echo site_url() ?>flights/confirm_itinerary" id="continueform" data-parsley-validate>
         <input type="hidden" name="callBackId" value="<?php echo base64_encode('tripjack'); ?>" />
         <input type="hidden" name="bookingId" value="<?php echo $reviewresp->bookingId; ?>" />
         <input type="hidden" name="Total_fare" value="<?php echo $reviewresp->totalPriceInfo->totalFareDetail->fC->TF; ?>" />
         <input type="hidden" name="searchId" id="searchId" value="<?php echo $flight_result->search_id; ?>" />
         <input type="hidden" name="key" id="key" value="<?php echo $key; ?>" />
         <input type="hidden" name="segmentkey" id="segmentkey" value="<?php echo $flight_result->segmentkey; ?>" />
         <?php if ($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true') { ?>
         <input type="hidden" name="searchId1" id="searchId1" value="<?php echo $flight_result_r->search_id; ?>" />
         <input type="hidden" name="segmentkey1" id="segmentkey1" value="<?php echo $flight_result_r->segmentkey; ?>" />
         <?php } ?>
         <div class="row">
            <div class="col-lg-12 col-md-12 box-parent one opened">
               <div class="card">
                  <h5 class="mb-0 bdTitle2 one">
                     <spantitleItinerary>
                     <i class="mdi mdi-check"></i>
                  </h5>
                  <div class="card-body itinerary-container middle-container">
                     <div class="row no-gutters">
                        <div class="col-lg-8 col-md-8">
                           <label class="badge badge-info px-2 py-1">Onward <i class="mdi mdi-airplane"></i></label>
                           <div class="itinerary-box">
                              <span class="flt-criteria d-block mr-2"> <?php echo current($operating_cityname_o);  ?> →   <?php echo end($operating_cityname_d); ?> ( <?php echo date('j M Y', strtotime($this->Tripjack_Model->getDate_TimeFromDateTime($operating_deptime[0], 'date'))); ?>)</span>
                              <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { 
                                 ?>
                              <?php if ($segment_indicator[$j] == '0') {
                                 ?>
                              <div class="d-flex justify-content-between flex-wrap align-content-around text-center pr-2 itinerary-div mt-3">
                                 <div class="card-Title minwidth1"><img src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[$j]; ?>.gif" alt="flight logo">
                                    <small class="d-block"><?php echo $operating_airlinename[$j]; ?> <?php echo $operating_airlinecode[$j]; ?> - <?php echo $operating_flightno[$j]; ?></small>
                                 </div>
                                 <div class="card-Title minwidth2">
                                    <?php echo $operating_cityname_o[$j];  ?>
                                    <small class="d-block">
                                    <?php
                                       $dep = explode('T', $operating_deptime[$j]);
                                       // $dep[1] = substr($dep[1], 0, -3);
                                       $dep[1]=date('h:i a', strtotime($dep[1]));
                                       echo $dep[1];
                                       ?></small>
                                    <small class="d-block"><?php echo date('j M Y', strtotime($this->Tripjack_Model->getDate_TimeFromDateTime($operating_deptime[$j], 'date'))); ?></small><small class="d-block"><?php echo $this->Flights_Model->get_airport_name($operating_airportname_o[$j]); ?>, <?php if ($operating_terminal_o[$j] != '') echo $operating_terminal_d[$j]; ?></small>
                                 </div>
                                 <div class="card-Title minwidth1"><i class="mdi mdi-clock d-block"></i>
                                    <?php  //if($j==0){ ?>
                                    <span class="flight-dur"><?php 
                                       echo $this->Tripjack_Model->journeyDuration(str_replace("T", " ", $operating_deptime[$j]),str_replace("T", " ", $operating_arritime[$j])); ?></span>
                                    <?php //} ?>
                                 </div>
                                 <div class="card-Title minwidth2">
                                    <?php echo $operating_cityname_d[$j]; ?>
                                    <small class="d-block">
                                    <?php
                                       $dep = explode('T', $operating_arritime[$j]);
                                       // $dep[1] = substr($dep[1], 0, -3);
                                       $dep[1]=date('h:i a', strtotime($dep[1]));
                                       echo $dep[1];
                                       ?>
                                    </small>
                                    <small class="d-block"><?php echo date('j M Y', strtotime($this->Tripjack_Model->getDate_TimeFromDateTime($operating_arritime[$j], 'date'))); ?></small><small class="d-block"><?php echo $this->Flights_Model->get_airport_name($operating_airportname_d[$j]); ?>,<?php  if ($operating_terminal_o[$j] != '') echo $operating_terminal_d[$j]; ?></small>
                                 </div>
                              </div>
                              <?php if($j != (count($operating_airlinecode)-1)){ ?>
                              <div class="d-flex justify-content-between flex-wrap align-content-around text-center pr-2 itinerary-div mt-3">
                                 <div class="layover-Title">
                                    <div><span>Layover: <?php echo $this->Tripjack_Model->journeyDuration(str_replace("T", " ", $operating_arritime[$j]),str_replace("T", " ", $operating_deptime[$j+1])); ?></span></div>
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
                              <span class="flt-criteria d-block mr-2"> <?php echo current($operating_cityname_o);  ?> →   <?php echo end($operating_cityname_d); ?> ( <?php echo date('j M Y', strtotime($this->Tripjack_Model->getDate_TimeFromDateTime($operating_deptime[0], 'date'))); ?>)</span>
                              <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { ?>
                              <?php if ($segment_indicator[$j] == '2') { ?>
                              <div class="d-flex justify-content-between flex-wrap align-content-around text-center pr-2 itinerary-div mt-3">
                                 <div class="card-Title minwidth1">               <img src="<?php echo base_url() . 'public/AirlineLogo/' . $operating_airlinecode[$j]; ?>.gif" alt="flight logo">
                                    <small class="d-block"><?php echo $operating_airlinename[$j]; ?> <?php echo $operating_airlinecode[$j]; ?> - <?php echo $operating_flightno[$j]; ?></small>
                                 </div>
                                 <div class="card-Title minwidth2">               <?php echo $operating_cityname_o[$j];  ?>
                                    <small class="d-block">
                                    <?php
                                       $dep = explode('T', $operating_deptime[$j]);
                                       $dep[1] = substr($dep[1], 0, -3);
                                       echo $dep[1];
                                       ?></small>
                                    <small class="d-block"><?php echo date('j M Y', strtotime($this->Tripjack_Model->getDate_TimeFromDateTime($operating_deptime[$j], 'date'))); ?></small><small class="d-block"><?php echo $this->Flights_Model->get_airport_name($operating_airportname_o[$j]); ?>, <?php if ($operating_terminal_o[$j] != '') echo $operating_terminal_d[$j]; ?></small>
                                 </div>
                                 <div class="card-Title minwidth1"><i class="mdi mdi-clock d-block"></i>
                                    <?php  //if($j==0){ ?>
                                    <span class="flight-dur"><?php //echo floor($flight_result->duration / 60).'h:'.($flight_result->duration - floor($flight_result->duration / 60) * 60).'m';
                                       echo $this->Tripjack_Model->journeyDuration(str_replace("T", " ", $operating_deptime[$j]),str_replace("T", " ", $operating_arritime[$j])); ?></span>
                                    <?php //} ?>
                                 </div>
                                 <div class="card-Title minwidth2">               <?php echo $operating_cityname_d[$j]; ?>
                                    <small class="d-block">
                                    <?php
                                       $dep = explode('T', $operating_arritime[$j]);
                                       $dep[1] = substr($dep[1], 0, -3);
                                       echo $dep[1];
                                       ?>
                                    </small>
                                    <small class="d-block"><?php echo date('j M Y', strtotime($this->Tripjack_Model->getDate_TimeFromDateTime($operating_arritime[$j], 'date'))); ?></small><small class="d-block"><?php echo $this->Flights_Model->get_airport_name($operating_airportname_d[$j]); ?>,<?php  if ($operating_terminal_o[$j] != '') echo $operating_terminal_d[$j]; ?></small>
                                 </div>
                              </div>
                              <?php if($j != (count($operating_airlinecode)-1)){ ?>
                              <div class="d-flex justify-content-between flex-wrap align-content-around text-center pr-2 itinerary-div mt-3">
                                 <div class="layover-Title">
                                    <div><span>Layover: <?php echo $this->Tripjack_Model->journeyDuration(str_replace("T", " ", $operating_arritime[$j]),str_replace("T", " ", $operating_deptime[$j+1])); ?></span></div>
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
                                $lcc = $result_r->islcc;
                              ?>
                           <label class="badge badge-info px-2 py-1 mt-4">Return <i class="mdi mdi-airplane"></i></label>
                           <div class="itinerary-box">
                              <span class="flt-criteria d-block mr-2"> <?php echo current($operating_cityname_o);  ?> →   <?php echo end($operating_cityname_d); ?> ( <?php echo date('j M Y', strtotime($this->Tripjack_Model->getDate_TimeFromDateTime($operating_deptime[0], 'date'))); ?>)</span>
                              <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { ?>
                              <?php if ($segment_indicator[$j] == '1') {
                                 ?>
                              <div class="d-flex justify-content-between flex-wrap align-content-around text-center pr-2 itinerary-div mt-3">
                                 <div class="card-Title minwidth1">               <img src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[$j]; ?>.gif" alt="flight logo">
                                    <small class="d-block"><?php echo $operating_airlinename[$j]; ?> <?php echo $operating_airlinecode[$j]; ?> - <?php echo $operating_flightno[$j]; ?></small>
                                 </div>
                                 <div class="card-Title minwidth2">               <?php echo $operating_cityname_o[$j];  ?>
                                    <small class="d-block">
                                    <?php
                                       $dep = explode('T', $operating_deptime[$j]);
                                       $dep[1] = substr($dep[1], 0, -3);
                                       echo $dep[1];
                                       ?></small>
                                    <small class="d-block"><?php echo date('j M Y', strtotime($this->Tripjack_Model->getDate_TimeFromDateTime($operating_deptime[$j], 'date'))); ?></small><small class="d-block"><?php echo $this->Flights_Model->get_airport_name($operating_airportname_o[$j]); ?>, <?php if ($operating_terminal_o[$j] != '') echo $operating_terminal_d[$j]; ?></small>
                                 </div>
                                 <div class="card-Title minwidth1"><i class="mdi mdi-clock d-block"></i>
                                    <?php  //if($j==0){ ?>
                                    <span class="flight-dur"><?php //echo floor($flight_result->duration / 60).'h:'.($flight_result->duration - floor($flight_result->duration / 60) * 60).'m';
                                       echo $this->Tripjack_Model->journeyDuration(str_replace("T", " ", $operating_deptime[$j]),str_replace("T", " ", $operating_arritime[$j])); ?></span>
                                    <?php //} ?>
                                 </div>
                                 <div class="card-Title minwidth2">               <?php echo $operating_cityname_d[$j]; ?>
                                    <small class="d-block">
                                    <?php
                                       $dep = explode('T', $operating_arritime[$j]);
                                       $dep[1] = substr($dep[1], 0, -3);
                                       echo $dep[1];
                                       ?>
                                    </small>
                                    <small class="d-block"><?php echo date('j M Y', strtotime($this->Tripjack_Model->getDate_TimeFromDateTime($operating_arritime[$j], 'date'))); ?></small><small class="d-block"><?php echo $this->Flights_Model->get_airport_name($operating_airportname_d[$j]); ?>,<?php  if ($operating_terminal_o[$j] != '') echo $operating_terminal_d[$j]; ?></small>
                                 </div>
                              </div>
                              <?php if($j != (count($operating_airlinecode)-1)){ ?>
                              <div class="d-flex justify-content-between flex-wrap align-content-around text-center pr-2 itinerary-div mt-3">
                                 <div class="layover-Title">
                                    <div><span>Layover: <?php echo $this->Tripjack_Model->journeyDuration(str_replace("T", " ", $operating_arritime[$j]),str_replace("T", " ", $operating_deptime[$j+1])); ?></span></div>
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
                              <table>
                                 <tr>
                                    <div class="show_offers" style="background-color: #ffe4c4;"></div>
                                 </tr>
                                 <tr>
                                    <input type="hidden" name="callBackId" value="<?php echo base64_encode('tripjack'); ?>" />
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
                                       <td>Tax</td>
                                       <td>INR <?php echo number_format(round($tax)); ?></td>
                                    </tr>
                                    <tr>
                                       <td>Convenience fees</td>
                                       <td>INR <?php echo number_format(round($payment_charge)); ?></td>
                                    </tr>
                                    <tr>
                                       <td>Promotion &amp; Discount</td>
                                       <td><i class="mdi mdi-currency-inr"></i><span name="discount" id="discountval">0</span></td>
                                    </tr>
                                    <tr>
                                       <td>Total</td>
                                       <td><span class="grand_total" name="finaltot" id="finaltot">INR <?php echo number_format($total_amount); ?></span></td>
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
                                 <tbody>
                                    <span class="flt-criteria d-block">Addon Specials</span>
                                    <tr id="meal"></tr>
                                    <tr id="bagg"></tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="row mt-4" id="itinerary-login" style="<?php if($this->session->userdata('user_no')){ echo 'display: none;'; } else { echo 'display: block;'; } ?>">
                        <div class="col-sm-12">
                           <p><b><i class="mdi mdi-hand-pointing-right"></i> Login to book faster</b> <a class="btn border-btn" href="#" data-toggle="modal" data-target="#modalLoginIntinerary" style="background: #fff;color: #4d74e0;border: 1px solid #4d74e0;"><i class="mdi mdi-account"></i> Account Login</a></p>
                           <?php if ($this->session->userdata('user_logged_in')) { 
                              // $this->load->model('b2c/B2c_Model');
                              // $user_id = $this->session->userdata('user_id');
                              // $guser_info = $this->B2c_Model->getGUserInfo($user_id);
                              // echo "<pre>";print_r($guser_info);
                              ?>
                           <div class="col-sm-4">
                              <select class="form-control required Guest">
                                 <option value="">Guest Details</option>
                                 <?php $this->load->model('b2c/B2c_Model');
                                    $user_id = $this->session->userdata('user_id');
                                    $guser_info = $this->B2c_Model->getGUserInfo($user_id);
                                      foreach ($guser_info as $guser) { ?>
                                 <option value="<?php echo $guser->guest_id; ?>"><?php echo $guser->first_name.' '.$guser->last_name; ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                           <?php }  ?>
                        </div>
                        <div class="col-sm-12">
                           <div class="border-line"></div>
                        </div>
                     </div>
                     <div class="row no-padding mt-1">
                        <div class="col-md-2 col-sm-4 col-xs-6">Your email address</div>
                        <div class="col-md-4 col-sm-8 col-xs-6">
                           <input type="email" name="user_email" value="<?php echo $user_email;?>" class="form-control required" data-parsley-trigger="change" required>
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
                              <input type="text" name="adultFName[]" class="form-control required" placeholder="First Name" id="adultf<?= $a ?>"  value="<?php echo $first_name?>" data-parsley-trigger="change" data-parsley-pattern="^[A-Za-z]*$"/>
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-4 form-group">
                              <input type="text" name="adultLName[]" class="form-control required" placeholder="Last Name" value="<?php echo $last_name?>" data-parsley-trigger="change" data-parsley-pattern="^[A-Za-z]*$" data-parsley-notequalto="#adultf<?= $a ?>"/>
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
                                 <option value="<?php echo $con->iso2;?>" <?php if($con->name == 'India') echo 'selected' ?>><?php echo $con->name;?></option>
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
                                 <option value="Master">Mstr</option>
                                 <option value="Ms">Miss</option>
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
                                 <option value="<?php echo $con->iso2;?>" <?php if($con->name == 'India') echo 'selected' ?>><?php echo $con->name;?></option>
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
                                 <option value="Master">Mstr</option>
                                 <option value="Ms">Miss</option>
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
                                 <?php for ($ag = (date('Y') - 1); $ag <= (date('Y')); $ag++) {?>
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
                           <label> <input name="whatsapp" type="checkbox"  value="Yes" /> <span style="color: green;margin-top: 2px;"> Send Booking Details and updates above Phone Number </span></label>
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
            <?php if($reviewresp != '') {?>
            <div class="col-lg-12 col-md-12 box-parent three closed">
               <div class="card">
                  <h5 class="mb-0 bdTitle2 three"><span>3</span>Special Service Request <i class="mdi mdi-check"></i></h5>
                  <div class="card-body itinerary-container middle-container" >
                     <?php for ($a = 0; $a < $flight_result->adults; $a++) { ?>
                     <?php if($mealinformation !=''){ ?>
                     <div class="row no-padding form-group">
                        <div class="col-md-2 col-sm-4 col-xs-6">Meal Dynamic(<?php echo current($operating_cityname_o);  ?> →   <?php echo end($operating_cityname_d); ?>)</div>
                        <div class="col-md-4 col-sm-8 col-xs-6">
                           <?php  
                              for($i=0;$i<=count($mealinformation);$i++){
                                ?>
                           <select  class="form-control " name="Ameal[]" style="margin-bottom: 10px">
                              <option value="">-- Select meal option--</option>
                              <?php for($j=0;$j<=count($mealinformation[$i]);$j++){
                                 $Code = $mealinformation[$i][$j]->code;
                                 $AirlineDescription = $mealinformation[$i][$j]->desc;
                                 $Price = $mealinformation[$i][$j]->amount;
                                 $key = $mealinformation[$i][$j]->amount;
                                 // echo '<pre/>';print_r($Code);exit;?>
                              <?php if($AirlineDescription != ''){ ?>
                              <option value="<?php echo $Code .'@^@'.$AirlineDescription.'@^@'.$Price?>"><?php echo $AirlineDescription?> <span>&nbsp;<?php echo '(Rs' .$Price.')'?></span></option>
                              <?php  } } ?>       
                           </select>
                           <?php } ?> 
                        </div>
                        <!-- <?php //if($mealinformation[1] != ''){ ?>
                           <div class="col-md-4 col-sm-8 col-xs-6">
                              <select  class="form-control " name="Ameal[]">
                               <option value="">-- Select meal option--</option>
                               <?php  
                              for($i=0;$i<=count($mealinformation[1]);$i++){
                                $Code = $mealinformation[1][$i]->code;
                                $AirlineDescription = $mealinformation[1][$i]->desc;
                                $Price = $mealinformation[1][$i]->amount;
                               // echo '<pre/>';print_r($Code);exit;?>
                                <?php if($AirlineDescription != ''){ ?>
                                    <option value="<?php echo $Code .'@^@'.$AirlineDescription.'@^@'.$Price?>"><?php echo $AirlineDescription?> <span>&nbsp;<?php echo '(Rs' .$Price.')'?></span></option>
                                 <?php  } }?>         
                             </select>
                           </div>
                           <?php //} ?>  -->
                     </div>
                     <?php } ?>
                     <?php if($baggageinformation !=''){?>
                     <div class="row no-padding form-group">
                        <div class="col-md-2 col-sm-4 col-xs-6">Baggage</div>
                        <div class="col-md-4 col-sm-8 col-xs-6">
                           <select  class="form-control " name="baggage[]" >
                              <option value="">-- Select baggage option--</option>
                              <?php  
                                 for($i=0;$i<=count($baggageinformation[0]);$i++){
                                   $Code = $baggageinformation[0][$i]->code;
                                   $key = $key[0];
                                   $Price = $baggageinformation[0][$i]->amount;
                                   
                                  // echo '<pre/>';print_r($Code);exit;?>
                              <?php if($Code != ''){ ?>
                              <option value="<?php echo $Code .'@^@'.$key.'@^@'.$Price?>"><?php echo $Weight?>kg <span>&nbsp;<?php echo '(Rs' .$Price.')'?></span></option>
                              <?php  } }?>         
                           </select>
                        </div>
                        <?php if($baggageinformation[1] != ''){ ?>
                        <div class="col-md-4 col-sm-8 col-xs-6">
                           <select  class="form-control " name="cobaggage[]" >
                              <option value="">-- Select baggage option--</option>
                              <?php  
                                 for($i=0;$i<=count($baggageinformation[1]);$i++){
                                   $Code = $baggageinformation[1][$i]->code;
                                   $key = $key[1];
                                   $Price = $baggageinformation[1][$i]->amount;
                                   
                                  // echo '<pre/>';print_r($Code);exit;?>
                              <?php if($Code != ''){ ?>
                              <option value="<?php echo $Code .'@^@'.$key.'@^@'.$Price?>"><?php echo $Weight?>kg <span>&nbsp;<?php echo '(Rs' .$Price.')'?></span></option>
                              <?php  } }?>         
                           </select>
                        </div>
                     </div>
                     <?php } } ?> 
                     <?php if($tripseat !=''){?>
                     <div class="row no-padding form-group">
                        <div class="col-md-2 col-sm-4 col-xs-6">Seats</div>
                        <div class="col-md-4 col-sm-8 col-xs-6">
                           <select  class="form-control " name="seat[]" >
                              <option value="">-- Select seat option--</option>
                              <?php
                                 for($i=0;$i<=count($tripseat);$i++){
                                   $seatNo = $tripseat[$i]->seatNo;
                                   $Price = $tripseat[$i]->amount;
                                   
                                  // echo '<pre/>';print_r($Code);exit;?>
                              <?php if($tripseat[$i]->isBooked != 1){ ?>
                              <option value="<?php echo $seatNo .'@^@'.$Price?>"><?php echo $seatNo?> <span>&nbsp;<?php echo '(Rs' .$Price.')'?></span></option>
                              <?php  } }?>         
                           </select>
                        </div>
                        <div class="col-md-4 col-sm-8 col-xs-6">
                           <select  class="form-control " name="seat[]" >
                              <option value="">-- Select seat option--</option>
                              <?php
                                 for($i=0;$i<=count($tripseat1);$i++){
                                   $seatNo = $tripseat1[$i]->seatNo;
                                   $Price = $tripseat1[$i]->amount;
                                   
                                  // echo '<pre/>';print_r($Code);exit;?>
                              <?php if($tripseat1[$i]->isBooked != 1){ ?>
                              <option value="<?php echo $seatNo .'@^@'.$Price?>"><?php echo $seatNo?> <span>&nbsp;<?php echo '(Rs' .$Price.')'?></span></option>
                              <?php  } }?>         
                           </select>
                        </div>
                     </div>
                     <?php } ?>
                     <?php } ?> 
                     <!-- Button trigger modal -->
                     <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Seat</button>       -->
                  </div>
               </div>
            </div>
            <?php }?>
            <div class="col-lg-12 col-md-12 box-parent three closed">
               <div class="card">
                  <h5 class="mb-0 bdTitle2 three"><span>4</span> Payment <i class="mdi mdi-check"></i></h5>
                  <div class="card-body itinerary-container middle-container" >
                     <div class="row no-padding">
                        <div class="col-md-12 col-lg-12 font12">
                           <label> <input name="terms" type="checkbox" class="required" value="" /> Yes, I accept the terms and conditions of the policy </label>
                        </div>
                     </div>
                     <?php
                        if($this->session->has_userdata('agent_logged_in')){
                        $available_balance = $this->Tripjack_Model->get_agent_available_balance();
                        // echo $this->db->last_query();
                        $tot = $total_amount - $agent_markup;
                        if ($available_balance > $tot) {  ?>
                     <div class="row no-padding">
                        <div class="col-md-12 col-lg-12">
                           <label>
                           <input type="radio" name="payment_type" checked="checked" value="Deposit">Deposit
                           </label>
                           <label>
                           <input type="radio" name="payment_type" value="paytm">Payment Gateway
                           </label>
                        </div>
                     </div>
                     <div class="row no-padding">
                        <div class="col-md-12 col-lg-12"><button type="submit" class="btn btn-primary">CONTINUE</button></div>
                     </div>
                     <?php  }else{ echo 'Please recharge to continue booking'; ?>
                     <div class="row no-padding">
                        <div class="col-md-12 col-lg-12">
                           <label>
                           <input type="radio" name="payment_type" checked="checked" value="paytm">Payment Gateway
                           </label>
                        </div>
                     </div>
                     <div class="row no-padding">
                        <div class="col-md-12 col-lg-12"><button type="submit" class="btn btn-primary">CONTINUE</button></div>
                     </div>
                     <?php }
                        }else{ ?>
                     <div class="row no-padding">
                        <div class="col-md-12 col-lg-12">
                           <label>
                           <input type="radio" name="payment_type" checked="checked" value="paytm">Payment Gateway
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
                     <!-- <tr id="meal"></tr>
                        <tr id="bagg"></tr> -->
                     <tr>
                        <td width="150px">RULE APPLICATION AND OTHER CONDITIONS</td>
                        <td width="15px">:</td>
                        <td>NOTE - THE FOLLOWING TEXT IS INFORMATIONAL
                     </tr>
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
                           <li class="roww row--1">
                              <ol class="seats" type="A">
                                 <li class="seat">
                                    <input type="checkbox" id="1A" />
                                    <label for="1A" data-toggle="popover" title="Popover title" data-content="Default popover">1A</label>
                                 </li>
                                 <li class="seat">
                                    <input type="checkbox" id="1B" />
                                    <label for="1B">1B</label>
                                 </li>
                                 <li class="seat">
                                    <input type="checkbox" id="1C" />
                                    <label for="1C">1C</label>
                                 </li>
                                 <li class="seat">
                                    <input type="checkbox" disabled id="1D" />
                                    <label for="1D">Occupied</label>
                                 </li>
                                 <li class="seat">
                                    <input type="checkbox" id="1E" />
                                    <label for="1E">1E</label>
                                 </li>
                                 <li class="seat">
                                    <input type="checkbox" id="1F" />
                                    <label for="1F">1F</label>
                                 </li>
                              </ol>
                           </li>
                           <li class="roww row--2">
                              <ol class="seats" type="A">
                                 <li class="seat">
                                    <input type="checkbox" id="2A" />
                                    <label for="2A">2A</label>
                                 </li>
                                 <li class="seat">
                                    <input type="checkbox" id="2B" />
                                    <label for="2B">2B</label>
                                 </li>
                                 <li class="seat">
                                    <input type="checkbox" id="2C" />
                                    <label for="2C">2C</label>
                                 </li>
                                 <li class="seat">
                                    <input type="checkbox" id="2D" />
                                    <label for="2D">2D</label>
                                 </li>
                                 <li class="seat">
                                    <input type="checkbox" id="2E" />
                                    <label for="2E">2E</label>
                                 </li>
                                 <li class="seat">
                                    <input type="checkbox" id="2F" />
                                    <label for="2F">2F</label>
                                 </li>
                              </ol>
                           </li>
                           <li class="roww row--3">
                              <ol class="seats" type="A">
                                 <li class="seat">
                                    <input type="checkbox" id="3A" />
                                    <label for="3A">3A</label>
                                 </li>
                                 <li class="seat">
                                    <input type="checkbox" id="3B" />
                                    <label for="3B">3B</label>
                                 </li>
                                 <li class="seat">
                                    <input type="checkbox" id="3C" />
                                    <label for="3C">3C</label>
                                 </li>
                                 <li class="seat">
                                    <input type="checkbox" id="3D" />
                                    <label for="3D">3D</label>
                                 </li>
                                 <li class="seat">
                                    <input type="checkbox" id="3E" />
                                    <label for="3E">3E</label>
                                 </li>
                                 <li class="seat">
                                    <input type="checkbox" id="3F" />
                                    <label for="3F">3F</label>
                                 </li>
                              </ol>
                           </li>
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
<?php //echo '<pre>';print_r($reviewresp);exit; ?>
<?php $this->load->view('home/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>
<script type="text/javascript">
   $('#gst_link').on('click', function(e){
     e.preventDefault();
     $('#gst_body').slideToggle();
   })
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
       // alert(vals);
       msg.innerHTML = 'Quantity: <b>' + vals[2] + '' +'Platter'+ '</b> </br>' +
           'Price: <b>' +'Rs'+vals[2] + '</b>';
       meal.innerHTML = '<td width="150px">Meal</td><td>Rs '+vals[3]+'</td>';
       // meal.innerHTML = 'Meals :<b>' + vals[1] +'</b> Quantity: <b>' + vals[2] + '' +'Platter'+ '</b> </br>' +'Price: <b>' +'Rs'+vals[3] + '</b>';
       
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
       bagg.innerHTML = '<td width="150px">Baggage</td><td width="15px">:</td><td>'+ vals[1]+', Rs '+vals[2]+'</td>';
   }
   
   function show_seat(ele) {
       // GET THE SELECTED VALUE FROM <select> ELEMENT AND SHOW IT.
       var seat = document.getElementById('seatinfo');
       var val = ele.value;
       var vals = val.split('@^@');
       // alert(vals);
       seat.innerHTML = 'seat: <b>' + vals[0] + '' +
           'Price: <b>' +'Rs'+vals[1] + '</b>';
   }
</script>
<script type="text/javascript">
   /**
   * Clearable text inputs
   */
   $(".clearable").each(function() {
   
   var $inp = $(this).find("input:text"),
       $cle = $(this).find(".clearable__clear");
       
   // $inp.on("input", function(){
   //   $cle.toggle(!!this.value);
   // });
   
   $cle.on("touchstart click", function(e) {
     e.preventDefault();
     $inp.val("").trigger("input");
   });
   
   });
</script>
<script type="text/javascript">
   $(document).ready(function(){
     // $searchId = $(this).attr('data-searchId');
     var limit = document.getElementById("pax_details").value;
     alert(limit)
       $('input.single-checkbox').on('change', function(evt) {
          if($('input.single-checkbox:checked').length > limit) {
              // this.checked = false;
              $(this).prop('checked',false);
              alert('you can select only '+ limit+' seats');
          }
       });
     });
</script>