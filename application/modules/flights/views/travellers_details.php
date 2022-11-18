<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php //agent_logged_in
// echo '3<pre>'; print_r($this->session->all_userdata());exit;
?>
<?php $this->load->view('home/home_template/header');
// echo "<pre>21";print_r($this->session->all_userdata());
if (empty($flight_result)) {
    redirect('flights/results', 'refresh');
}
$sess_data = unserialize($flight_result->searcharray);
$session_data = $this->session->search_details;
//    echo '3<pre>'; print_r($session_data);exit;
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
$operating_fareclass = explode(',', $flight_result->operating_fareclass);
$nonrefundable = $flight_result->nonrefundable;
$baggageinformation = $flight_result->baggageinformation;
if ($flight_result->triptype == 'round' && $flight_result->isdomestic == 'true') {
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
$basefare = $flight_result->basefare + $baser;
// echo"<pre>"; print_r($flight_result_r);exit;
// $tax = $flight_result->tax+$flight_result->admin_markup+$flight_result->agent_markup+$flight_result->payment_charge + $taxr;
$tax = $flight_result->tax + $flight_result->admin_markup + $flight_result->agent_markup + $taxr;

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

if ($flight_result->triptype == 'round' && $flight_result->isdomestic == 'true') {
    if ($flight_result_r->gstallowed == '1' && $gstallowed == false) {
        $gstallowed = true;
    }
    if ($flight_result_r->gstmandatory == '1' && $gstmandatory == false) {
        $gstmandatory = true;
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
$total_cost = $total_amount + $meal_price + $baggage_price + $insurance_amount;
if ($total_cost == 0) {
    redirect('flights/results', 'refresh');
}
?>
<style>
    .travel-stops .end {
        right: 0;
        top: -6px;
        background-image: url("<?php echo base_url(); ?>/assets/images/icons/plane-listing.png");
        background-size: cover;
        width: 15px;
        height: 14px
    }

    .collapse{
        display: block;
    }
    .jq-tab li{
        cursor: pointer;
    }
</style>
<input type="hidden" id="base_path" value="<?php echo base_url(); ?>">
<!-- ========================= SECTION PAGETOP  ========================= -->
<section class="section-pagetop" oncontextmenu="return false;">
    <div class="container">
        <div class="timer-block pull-right">
            <i class="material-icons">&#xE425;</i>
            <small>Prices may change after booking</small>
            <big class="timer" id="booking-countdown"></big>
        </div>

        <h2 class="title-page">Just three simple steps to book!</h2>

    </div> <!-- container // -->
</section>
<!-- ========================= SECTION PAGETOP END // ========================= -->



<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content" oncontextmenu="return false;">
    <div class="notify-box alert-dismiss" id="error" style="display:none;">
        <a href="" class="pull-right close">&times</a>
        <span id="error1"></span>
        <span id="error2"></span>
    </div>
    <div class="container" oncontextmenu="return false;">
        <div class="row-sm">
            <main class="col-sm-9">

                <section class="panel panel-active panel-booking" id="flight-block">
                    <header class="panel-heading">
                        <span class="num-step">1</span>
                        <h4 class="panel-title">Flight Overview </h4>
                    </header>

                    <!-- <div class="alert-price alert-price-up" id="high_price" style="display:none;">
                         <i class="icon fa fa-exclamation-circle pull-right"></i>
                         <h4 class="title">Confirm your details</h4>
                         <span class="title2">The price of your trip has been increased</span>
                         <p>This usually happens when your seats are selling out. Your trip is now available for <u id="high_price_total">INR 276</u>. <br> Please, review trip details again carefully for any changes</p>
 
                         <a href="javascript:void(0);" onclick="pricealert(this);" class="btn btn-warning"> Continue </a>
                     </div>  alert-price .// -->

                    <div class="alert-price alert-price-down" id="low_price" style="display:none;">
                        <i class="icon fa fa-smile-o pull-right" aria-hidden="true"></i>
                        <h4 class="title">CONGRATULATIONS!!!</h4>
                        <span class="title2">The price of your trip became cheaper!</span>
                        <p class="text-opacity">We have found lower price for your trip. Your trip is now available for <u>INR 276</u>. <br> Please, review trip details again carefully for any changes</p>

                        <a href="javascript:void(0);" onclick="pricealert(this);" class="btn btn-warning"> Continue </a>
                    </div> <!-- alert-price .// -->

                    <!-- ============== (flight) compact view ============== -->
                    <div class="compact-view" data-tooltip="Click for  more detail" style="display: none">
                        <article class="ticket-overview-mini">
                            <div class="row no-gutter">
                                <?php if ($flight_result->triptype) {
                                } ?>

                                <?php for ($s = 0; $s < count($operating_airlinecode); $s++) { ?>
                                    <div class="row row-trip no-gutter">
                                        <aside class="col-md-2 col-sm-2">
                                            <div class="info-airline">
                                                <img src="<?php echo base_url() . 'public/AirlineLogo/' . $operating_airlinecode[$s]; ?>.gif" alt="flight logo">
                                                <br><?php echo $operating_airlinename[$s]; ?>
                                            </div>
                                        </aside> <!-- col // -->
                                        <aside class="col-md-7 col-sm-10">
                                            <div class="info-stops">
                                                <p class="place-wrap"><strong><?php echo $operating_cityname_o[$s];  ?></strong> <span data-toggle="tooltip" class="code " title=""> (<?php echo $operating_airportname_o[$s]; ?>)</span>
                                                    <br> <?php $dep = explode('T', $operating_deptime[$s]);
                                                            $dep[1] = substr($dep[1], 0, -3);
                                                            echo date('dS M', strtotime($dep[0])); ?> <strong><?php echo date('H:i', strtotime($dep[1])); ?></strong>
                                                </p>
                                                <p class="way-wrap">
                                                    <br>
                                                    <span class="travel-stops">
                                                        <span class="start"></span>
                                                        <span class="stop"></span>
                                                        <span class="end"></span>
                                                    </span>
                                                    <span class="txt-stops txt-green" data-toggle="tooltip" data-placement="bottom" title="" data-original-title=""><?php echo $route; ?></span>
                                                </p>
                                                <p class="place-wrap"><span data-toggle="tooltip" class="code " title=""> (<?php echo $operating_airportname_d[$s]; ?>)</span> <strong><?php echo $operating_cityname_d[$s];  ?></strong>
                                                    <br><strong><?php $arr = explode('T', $operating_arritime[$s]);
                                                                $arr[1] = substr($arr[1], 0, -3);
                                                                echo date('H:i', strtotime($arr[1])); ?></strong> <?php echo date('dS M', strtotime($arr[0])); ?>
                                                </p>
                                            </div>
                                        </aside> <!-- col // -->
                                        <aside class="col-md-3  col-sm-12">
                                            <div class="info-duration">
                                                <i class="material-icons">&#xE192;</i>
                                                <span class="time"><?php echo $durationd; ?></span>
                                                <!-- <small class="title">Duration</small> -->
                                            </div>

                                            <div class="info-icons">
                                                <span class="icon icon-layover" data-toggle="tooltip" title="Baggage"><img src="<?php echo base_url('assets/icons/flights_icon/baggage.png'); ?>"></span>
                                                <?php if ($nonrefundable == 1) { ?>
                                                    <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Refundable"><img src="<?php echo base_url('assets/icons/flights_icon/refund.png'); ?>"></span>
                                                <?php } ?>
                                                <!-- <span class="icon icon-layover" data-toggle="tooltip" title="Long Layover"><img src="<?php echo base_url('assets/icons/flights_icon/wait.png'); ?>"></span> -->

                                            </div> <!-- info icons // -->

                                        </aside> <!-- col // -->
                                    </div> <!-- row-trip // -->

                                <?php } ?>

                            </div> <!-- row // -->
                        </article> <!--  item-flight //  -->
                    </div>
                    <!-- ============== (flight) compact view .end// ============== -->

                    <!-- ============== (flight) full view ============== -->
                    <div class="full-view">

                        <div class="clearfix" id="rooms-list">
                            <!-- Rooms rendered List here -->
                            <div class="room-list listing-style3 hotel">

                                <div>

                                    <div class="subheading">
                                        <i class="material-icons rotate-right">&#xE195;</i>
                                        <h4 class="title">Flight from <strong><?php echo current($operating_cityname_o); ?></strong> To <strong><?php echo end($operating_cityname_d); ?></strong> On <strong><?php echo date('l, d F Y', strtotime($this->Tbo_Model->getDate_TimeFromDateTime($operating_deptime[0], 'date'))); ?></strong></h4>
                                    </div>
                                    <article class="ticket-overview">
                                        <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { ?>
                                            <div class="row row-trip no-gutter">
                                                <aside class="col-md-2 col-sm-2">
                                                    <div class="info-airline">
                                                        <img src="<?php echo base_url() . 'public/AirlineLogo/' . $operating_airlinecode[$j]; ?>.gif" alt="flight logo">
                                                        <br /><span data-toggle="tooltip" title="<?php echo $operating_airlinename[$j]; ?>"><?php echo $operating_airlinename[$j]; ?></span> <br /> <?php echo $operating_airlinecode[$j]; ?> - <?php echo $operating_flightno[$j]; ?> <br /> Economy class

                                                    </div>
                                                </aside> <!-- col // -->
                                                <aside class="col-md-7 col-sm-10">
                                                    <div class="info-flight-way">
                                                        <p class="place-wrap-from"><strong><?php echo $operating_cityname_o[$j];  ?></strong> <span class="" data-toggle="tooltip" title="">(<?php echo $operating_airportname_o[$j]; ?>)</span>
                                                            <br /> <?php $dep2 = explode('T', $operating_deptime[$j]);
                                                                    $dep2[1] = substr($dep2[1], 0, -3);

                                                                    echo date('dS M', strtotime($dep2[0])); ?> <strong>
                                                                <?php
                                                                echo $dep2[1];
                                                                ?>
                                                            </strong>
                                                            <!-- <br/><span data-toggle="tooltip" title="Bengaluru International Airport">Bengaluru Internationa...</span> -->
                                                            <br />Terminal: <?php echo $operating_terminal_o[$j]; ?>
                                                        </p>
                                                        <p class="way-wrap">
                                                            <span class="txt-time"><?php echo $durationd; ?></span>
                                                            <span class="travel-stops">
                                                                <span class="start"></span>
                                                                <span class="end"></span>
                                                            </span>
                                                        </p>
                                                        <p class="place-wrap-to"><span class="" data-toggle="tooltip" title="">(<?php echo $operating_airportname_d[$j]; ?>)</span> <strong><?php echo $operating_cityname_d[$j];  ?></strong>
                                                            <br /><strong><?php $arr2 = explode('T', $operating_arritime[$j]);
                                                                            $arr2[1] = substr($arr2[1], 0, -3);

                                                                            echo $arr2[1];

                                                                            ?></strong> <?php echo date('dS M', strtotime($arr2[0])); ?>
                                                            <!-- <br/><span data-toggle="tooltip" title="Rajiv Gandhi international Airport">Rajiv Gandhi internati...</span> -->
                                                            <br />
                                                        </p>
                                                    </div>
                                                </aside> <!-- col // -->
                                                <aside class="col-md-3  col-sm-12 ticket-baggage">
                                                    <ul class="list-default">
                                                        <!-- <li><i class="fa fa-plane"></i> Aircraft Type: <span>Airbus <?php echo $aircraftTypeno; ?></span></li> -->
                                                        <li><i class="fa fa-universal-access"></i> Booking class: <span><?php echo $operating_fareclass[0]; ?></span></li>
                                                        <li><i class="fa fa-shopping-bag"></i> Carry-on: <span> <?php echo "7 kg/person "; ?></span></li>
                                                        <li><i class="fa fa-suitcase"></i> Check-in:
                                                            <span> Adult: <?php echo $baggageinformation; ?> </span>
                                                        </li>
                                                    </ul>
                                                </aside><!-- col // -->
                                            </div> <!-- row-trip // -->


                                            <p class="alert alert-warning hide" style="text-align:center;">
                                                Note: Per Piece bag weight </p>
                                            <hr>
                                        <?php } ?>
                                        <!-- <span class="layover">  <strong><img src="<?php //echo base_url('assets/icons/flights_icon/layover.png');
                                                                                        ?>"> Layover 7H 30m in Hyderabad</strong> </span>   -->



                                    </article> <!-- ticket-overview// -->


                                    <div class="row no-padding">

                                    </div>


                                    </article> <!-- ticket-overview// -->

                                    <div class="clear"></div>
                                    <div class="clear"></div>
                                </div>

                            </div>
                        </div>

                        <!-- Insurance Start -->




                        <!-- Insurance End -->
                        <?php if($flight_result->triptype == 'round'){
                            }else{?>
                        <div class="panel-footer text-right">
                            <a href="javascript:void(0)" class="btn btn-warning btn-lg" onclick="activate_block('flight-block')">Continue</a>
                        </div> <!-- panel-footer  // -->
                        <?php } ?>
                    </div>
                    <!-- ============== (flight) full view .end// ============== -->

                    <?php
                  if ($flight_result->triptype == 'round' && $flight_result->isdomestic == 'true') {
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

                    <!-- ============== (flight_round_return) compact view ============== -->
                    <div class="compact-view" data-tooltip="Click for  more detail" style="display: none">
                        <article class="ticket-overview-mini">
                            <div class="row no-gutter">
                                
                                <?php for ($k = 0; $k < count($operating_airlinecode); $k++) { ?>
                                    <div class="row row-trip no-gutter">
                                        <aside class="col-md-2 col-sm-2">
                                            <div class="info-airline">
                                                <img src="<?php echo base_url() . 'public/AirlineLogo/' . $operating_airlinecode[$k]; ?>.gif" alt="flight logo">
                                                <br><?php echo $operating_airlinename[$k]; ?>
                                            </div>
                                        </aside> <!-- col // -->
                                        <aside class="col-md-7 col-sm-10">
                                            <div class="info-stops">
                                                <p class="place-wrap"><strong><?php echo $operating_cityname_o[$k];  ?></strong> <span data-toggle="tooltip" class="code " title=""> (<?php echo $operating_airportname_o[$k]; ?>)</span>
                                                    <br> <?php $dep = explode('T', $operating_deptime[$k]);
                                                            $dep[1] = substr($dep[1], 0, -3);
                                                            echo date('dS M', strtotime($dep[0])); ?> <strong><?php echo date('H:i', strtotime($dep[1])); ?></strong>
                                                </p>
                                                <p class="way-wrap">
                                                    <br>
                                                    <span class="travel-stops">
                                                        <span class="start"></span>
                                                        <span class="stop"></span>
                                                        <span class="end"></span>
                                                    </span>
                                                    <span class="txt-stops txt-green" data-toggle="tooltip" data-placement="bottom" title="" data-original-title=""><?php echo $route; ?></span>
                                                </p>
                                                <p class="place-wrap"><span data-toggle="tooltip" class="code " title=""> (<?php echo $operating_airportname_d[$k]; ?>)</span> <strong><?php echo $operating_cityname_d[$k];  ?></strong>
                                                    <br><strong><?php $arr = explode('T', $operating_arritime[$k]);
                                                                $arr[1] = substr($arr[1], 0, -3);
                                                                echo date('H:i', strtotime($arr[1])); ?></strong> <?php echo date('dS M', strtotime($arr[0])); ?>
                                                </p>
                                            </div>
                                        </aside> <!-- col // -->
                                        <aside class="col-md-3  col-sm-12">
                                            <div class="info-duration">
                                                <i class="material-icons">&#xE192;</i>
                                                <span class="time"><?php echo $durationd; ?></span>
                                                <!-- <small class="title">Duration</small> -->
                                            </div>

                                            <div class="info-icons">
                                                <span class="icon icon-layover" data-toggle="tooltip" title="Baggage"><img src="<?php echo base_url('assets/icons/flights_icon/baggage.png'); ?>"></span>
                                                <?php if ($nonrefundable == 1) { ?>
                                                    <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Refundable"><img src="<?php echo base_url('assets/icons/flights_icon/refund.png'); ?>"></span>
                                                <?php } ?>
                                                <!-- <span class="icon icon-layover" data-toggle="tooltip" title="Long Layover"><img src="<?php echo base_url('assets/icons/flights_icon/wait.png'); ?>"></span> -->

                                            </div> <!-- info icons // -->

                                        </aside> <!-- col // -->
                                    </div> <!-- row-trip // -->

                                <?php } ?>

                            </div> <!-- row // -->
                        </article> <!--  item-flight //  -->
                    </div>
                    <!-- ============== (flight) compact view .end// ============== -->

                    <!-- ============== (flight_round_return) full view ============== -->
                    <div class="full-view">

                        <div class="clearfix" id="rooms-list">
                            <!-- Rooms rendered List here -->
                            <div class="room-list listing-style3 hotel">

                                <div>

                                    <div class="subheading">
                                        <i class="material-icons rotate-right">&#xE195;</i>
                                        <h4 class="title">Flight from <strong><?php echo current($operating_cityname_o); ?></strong> To <strong><?php echo end($operating_cityname_d); ?></strong> On <strong><?php echo date('l, d F Y', strtotime($this->Tbo_Model->getDate_TimeFromDateTime($operating_deptime[0], 'date'))); ?></strong></h4>
                                    </div>
                                    <article class="ticket-overview">
                                        <?php for ($m = 0; $m < count($operating_airlinecode); $m++) { ?>
                                            <div class="row row-trip no-gutter">
                                                <aside class="col-md-2 col-sm-2">
                                                    <div class="info-airline">
                                                        <img src="<?php echo base_url() . 'public/AirlineLogo/' . $operating_airlinecode[$m]; ?>.gif" alt="flight logo">
                                                        <br /><span data-toggle="tooltip" title="<?php echo $operating_airlinename[$m]; ?>"><?php echo $operating_airlinename[$m]; ?></span> <br /> <?php echo $operating_airlinecode[$m]; ?> - <?php echo $operating_flightno[$m]; ?> <br /> Economy class

                                                    </div>
                                                </aside> <!-- col // -->
                                                <aside class="col-md-7 col-sm-10">
                                                    <div class="info-flight-way">
                                                        <p class="place-wrap-from"><strong><?php echo $operating_cityname_o[$m];  ?></strong> <span class="" data-toggle="tooltip" title="">(<?php echo $operating_airportname_o[$m]; ?>)</span>
                                                            <br /> <?php $dep2 = explode('T', $operating_deptime[$m]);
                                                                    $dep2[1] = substr($dep2[1], 0, -3);

                                                                    echo date('dS M', strtotime($dep2[0])); ?> <strong>
                                                                <?php
                                                                echo $dep2[1];
                                                                ?>
                                                            </strong>
                                                            <!-- <br/><span data-toggle="tooltip" title="Bengaluru International Airport">Bengaluru Internationa...</span> -->
                                                            <br />Terminal: <?php echo $operating_terminal_o[$m]; ?>
                                                        </p>
                                                        <p class="way-wrap">
                                                            <span class="txt-time"><?php echo $durationd; ?></span>
                                                            <span class="travel-stops">
                                                                <span class="start"></span>
                                                                <span class="end"></span>
                                                            </span>
                                                        </p>
                                                        <p class="place-wrap-to"><span class="" data-toggle="tooltip" title="">(<?php echo $operating_airportname_d[$m]; ?>)</span> <strong><?php echo $operating_cityname_d[$m];  ?></strong>
                                                            <br /><strong><?php $arr2 = explode('T', $operating_arritime[$m]);
                                                                            $arr2[1] = substr($arr2[1], 0, -3);

                                                                            echo $arr2[1];

                                                                            ?></strong> <?php echo date('dS M', strtotime($arr2[0])); ?>
                                                            <!-- <br/><span data-toggle="tooltip" title="Rajiv Gandhi international Airport">Rajiv Gandhi internati...</span> -->
                                                            <br />
                                                        </p>
                                                    </div>
                                                </aside> <!-- col // -->
                                                <aside class="col-md-3  col-sm-12 ticket-baggage">
                                                    <ul class="list-default">
                                                        <!-- <li><i class="fa fa-plane"></i> Aircraft Type: <span>Airbus <?php echo $aircraftTypeno; ?></span></li> -->
                                                        <li><i class="fa fa-universal-access"></i> Booking class: <span><?php echo $operating_fareclass[0]; ?></span></li>
                                                        <li><i class="fa fa-shopping-bag"></i> Carry-on: <span> <?php echo "7 kg/person "; ?></span></li>
                                                        <li><i class="fa fa-suitcase"></i> Check-in:
                                                            <span> Adult: <?php echo $baggageinformation; ?> </span>
                                                        </li>
                                                    </ul>
                                                </aside><!-- col // -->
                                            </div> <!-- row-trip // -->


                                            <p class="alert alert-warning hide" style="text-align:center;">
                                                Note: Per Piece bag weight </p>
                                            <hr>
                                        <?php } ?>
                                        <!-- <span class="layover">  <strong><img src="<?php //echo base_url('assets/icons/flights_icon/layover.png');
                                                                                        ?>"> Layover 7H 30m in Hyderabad</strong> </span>   -->



                                    </article> <!-- ticket-overview// -->


                                    <div class="row no-padding">

                                    </div>


                                    </article> <!-- ticket-overview// -->

                                    <div class="clear"></div>
                                    <div class="clear"></div>
                                </div>

                            </div>
                        </div>

                        <!-- Insurance Start -->




                        <!-- Insurance End -->

                        <div class="panel-footer text-right">
                            <a href="javascript:void(0)" class="btn btn-warning btn-lg" onclick="activate_block('flight-block')">Continue</a>
                        </div> <!-- panel-footer  // -->
                    </div>
                    <!-- ============== (flight) full view .end// ============== -->
<?php }?>
                </section> <!-- panel// -->


                <section class="panel panel-disable panel-booking" id="traveller-block">
                    <header class="panel-heading">
                        <span class="num-step">2</span>
                        <h4 class="panel-title">Traveller Details</h4>
                    </header>

                    <!-- ============== (traveller) compact view ============== -->
                    <div class="compact-view" style="display: none" data-tooltip="Click to edit">
                        <article class="panel-body">
                            <div class="row">
                                <div class="col-sm-4 item-user-overview">
                                    <!-- <p><i class="fa fa-user"></i><span  id='traveller_name1'  class = "text-uppercase">Mr. Zeeshan Hyder</span> <br> <span class="text-muted">Date of Birth: <span id='traveller_dob1'>17, 12, 2017</span></span>	</p> -->
                                </div> <!-- col //  -->

                            </div> <!-- row//  -->
                        </article> <!-- panel-body// -->
                    </div>
                    <!-- ============== (traveller) compact view .end// ============== -->
                    <!-- ============== (traveller) full view ============== -->
                    <div class="full-view" style="display: none" id="traveldetail_ans">

                        </article>
                        <article class="alert-passport">
                            <span class="icon-id"></span>
                            <div class="text-wrap p15">
                                <h4 class="title">Double check your personal details</h4>
                                Please make sure your details match your passport or government issued identification.<br>
                                If the details are not correct, the passenger might be denied boarding.
                            </div>
                        </article>
                        <!-- <form name="booking" method="POST" 
    action="<?php //echo site_url() 
            ?>razorpay/pay.php" id="continueform" data-parsley-validate> -->
                        <?php if ($this->session->has_userdata('agent_logged_in')) { ?>
                            <form action="<?php echo site_url(); ?>flights/confirm_itinerary" method="post" class="form">
                            <?php } else { ?>
                                <form action="#" method="post" class="form">
                                <?php } ?>
                                <input type="hidden" name="callBackId" value="<?php echo base64_encode('tbo'); ?>" />
                                <input type="hidden" name="searchId" id="searchId" value="<?php echo $flight_result->search_id; ?>" />
                                <input type="hidden" name="segmentkey" id="segmentkey" value="<?php echo $flight_result->segmentkey; ?>" />
                                <input type="hidden" name="total_cost" value="<?php echo $total_cost; ?>" />
                                <input type="hidden" name="amount" value="<?php echo $total_cost; ?>" />
                                <input type="hidden" name="service_type" value="<?php echo $service_type; ?>" />
                                <?php if ($flight_result->triptype == 'round' && $flight_result->isdomestic == 'true') { ?>
                                    <input type="hidden" name="searchId1" id="searchId1" value="<?php echo $flight_result_r->search_id; ?>" />
                                    <input type="hidden" name="segmentkey1" id="segmentkey1" value="<?php echo $flight_result_r->segmentkey; ?>" />
                                <?php } ?>

                                <!-- passenger count -->
                                <input type="hidden" id="passenger_count" data-childcount="<?php echo $flight_result->childs; ?>" data-adultcount="<?php echo $flight_result->adults; ?>">
                                <?php //$flight_result->adults = 2;
                                for ($a = 0; $a < $flight_result->adults; $a++) { ?>
                                    <div class="subheading">
                                        <h4 class="title"><strong><span id="printtitle"></span> <span id="printfirstname" class="text-capitalize"></span> <span id="printlastname" class="text-capitalize"></span> (Adult <?php echo $a + 1; ?>)</strong></h4>
                                    </div>
                                    <article class="panel-body">
                                        <!-- passenger 1 form start  -->


                                        <div id="traveler-1">
                                            <div class="row-sm">
                                                <label class="col-sm-2 control-label">Full Name</label>
                                                <div class="form-group col-sm-2">
                                                    <select class="selectpicker form-control title traveller_title1" name="selTitle[]" id="selTitle[]" data-error="Please select title" required>
                                                        <option value="">Title</option>
                                                        <option value="Mr">Mr</option>
                                                        <option value="Ms">Ms</option>
                                                        <option value="Mrs">Mrs</option>
                                                    </select>
                                                    <small class="help-block with-errors"></small>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <input type="text" id="fname" class="form-control first_name traveller_firstname1 text-capitalize" value="" name="first_name[]" id="first_name[]" pattern='[a-zA-Z\s]+' placeholder="First Name" data-error="Valid First Name is required" required>
                                                    <small class="help-block with-errors"></small>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <input type="text" class="form-control last_name traveller_lastname1 text-capitalize" value="" placeholder="Last Name" name="last_name[]" id="last_name[]" pattern='[a-zA-Z\s]+' required data-error="Valid Last Name is required">
                                                    <small class="help-block with-errors"></small>
                                                </div>
                                            </div> <!-- form-group// -->

                                            <div class="row-sm selectdate-validate">
                                                <label class="col-sm-2 col-xs-12 control-label">Date of birth</label>
                                                <div class="form-group col-sm-2 col-xs-4">
                                                    <select class="selectpicker form-control traveller_dobD1 day" data-live-search="true" name="txtdobD[]" id="txtdobD[]" required="" data-error="Please select day" onchange="isValidDate(this, 'adult1', 'dob')">
                                                        <option value="">Day</option>
                                                        <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                                                            <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <small class="help-block with-errors"></small>
                                                </div>
                                                <div class="form-group col-sm-2 col-xs-4">
                                                    <select class="selectpicker form-control traveller_dobM1 month" data-live-search="true" name="txtdobM[]" id="txtdobM[]" required="" data-error="Please select month" onchange="isValidDate(this, 'adult1', 'dob')">
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
                                                    </select>
                                                    <small class="help-block with-errors"></small>
                                                </div>
                                                <div class="form-group col-sm-2 col-xs-4">
                                                    <select class="selectpicker form-control traveller_dobY1 year" data-live-search="true" name="txtdobY[]" id="txtdobY[]" required="" data-error="Please select year" onchange="isValidDate(this, 'adult1', 'dob')">
                                                        <option value="">Year</option>
                                                        <?php for ($ag = 1930; $ag <= (date('Y') - 12); $ag++) { ?>
                                                            <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <small class="help-block with-errors"></small>
                                                </div>

                                                <!-- Nationality 1 form start//  -->
                                                <div class="" id="nationality_details_1">
                                                    <div class="row-sm">
                                                        <!-- <label class="col-sm-2 control-label">Nationality</label> -->
                                                        <div class="form-group col-sm-3">
                                                            <select class="selectpicker form-control nationality" data-live-search="true" name="nationality[]" id="nationality[]" required data-error="Please select country">
                                                                <option value="">Select Nationality</option>
                                                                <?php foreach ($country_list as $con) { ?>
                                                                    <option value="<?php echo $con->iso2; ?>"><?php echo $con->name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <small class="help-block with-errors"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Nationality 1 form end//  -->


                                                <!-- form-group// -->
                                                <?php if ($flight_result->isdomestic == 'false') {  ?>
                                                    <div class=" hide" id="passport_details_1">

                                                        <div class="row-sm">
                                                            <label class="col-sm-2 control-label">Passport detail</label>
                                                            <div class="form-group col-sm-3">
                                                                <input type="text" class="form-control passport_no" value="" name="passport_no[]" id="passport_no[]" pattern="[a-zA-Z0-9]+" placeholder="Passport number" data-error="Valid passport number is required">
                                                                <small class="help-block with-errors"></small>
                                                            </div>
                                                            <div class="form-group col-sm-3">
                                                                <select class="selectpicker form-control passport_country" data-live-search="true" name="issued_country[]" id="issued_country[]" data-error="Please select country">
                                                                    <option value="">Select issuing country</option>
                                                                    <?php foreach ($country_list as $con) { ?>
                                                                        <option value="<?php echo $con->iso2; ?>"><?php echo $con->name; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <small class="help-block with-errors"></small>
                                                            </div>
                                                        </div> <!-- row// -->

                                                        <div class="row-sm selectdate-validate">
                                                            <label class="col-sm-2 col-xs-12 control-label">Passport expiry date</label>
                                                            <div class="form-group col-sm-2 col-xs-4">
                                                                <select class="selectpicker form-control day passday" data-live-search="true" name="txtpedD[]" id="txtpedD[]" data-error="Please select day" onchange="isValidDate(this, 'adult<?= $a + 1 ?>', 'passport')">
                                                                    <option value="">Day</option>
                                                                    <?php for ($ap = 1; $ap <= 31; $ap++) { ?>
                                                                        <option value="<?php echo str_pad($ap, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ap, 2, "0", STR_PAD_LEFT); ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <small class="help-block with-errors"></small>
                                                            </div>
                                                            <div class="form-group col-sm-2 col-xs-4">
                                                                <select class="selectpicker form-control month passmonth" data-live-search="true" name="txtpedM[]" id="txtpedM[]" data-error="Please select month" onchange="isValidDate(this, 'adult<?= $a + 1 ?>', 'passport')">
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
                                                                </select>
                                                                <small class="help-block with-errors"></small>
                                                            </div>
                                                            <div class="form-group col-sm-2 col-xs-4">
                                                                <select class="selectpicker form-control year passyear" data-live-search="true" name="txtpedY[]" id="txtpedY[]" data-error="Please select year" onchange="isValidDate(this, 'adult<?= $a + 1 ?>', 'passport')">
                                                                    <option value="">Year</option>
                                                                    <?php for ($ag = date('Y'); $ag <= (date('Y') + 200); $ag++) { ?>
                                                                        <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <small class="help-block with-errors"></small>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p class="text-right relative">
                                                                    <a href="#adults<?= $a + 1 ?>" class="btn btn-normal btn-extra" data-toggle="collapse" aria-expanded="false">More Options <i class="fa fa-chevron-down"></i></a>
                                                                    <span class="alert-baggage alert-dismiss hidden-xs top"><span class="close">&times</span> There are ancillary services for this traveller. Would you like to purchase baggage, meals, or seats?</span>
                                                                </p>
                                                            </div> <!--  form group// -->
                                                        </div> <!-- row// -->

                                                        <div class="row">
                                                            <span class="col-sm-6 col-sm-offset-2 alert-warning text-center hide" style="color: red;" id="errorpas-adult1"></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>



                                            </div>
                                        </div>
                                        <?php if (($ssrresponsex->Response->Baggage != '') or ($ssrresponsex->Response->MealDynamic != '')) { ?>

                                            <div class="collapse" id="adults<?= $a + 1; ?>">
                                                <div class="jq-tab blok-options-tab">
                                                    <ul class="nav nav-pills">

                                                        <li  data-refid="_a<?= $a + 1; ?>" data-target="baggagetab_item_a<?= $a + 1; ?>" id="baggagetab" class="baggagetab active"><a><i class="material-icons">work</i> Baggage</a></li>
                                                        <li  data-refid="_a<?= $a + 1; ?>" data-target="mealtab_item_a<?= $a + 1; ?>" id="mealtab" class="mealtab"><a><i class="material-icons">restaurant</i> MEAL PREFERENCES</a></li>
                                                    </ul>
                                                    <div class="tab-item-wrap">
                                                        <?php if ($ssrresponsex->Response->Baggage != '') { ?>
                                                            <article class="tab-item baggagetab_item_a<?= $a + 1; ?> active">
                                                                <!-- checkin baggage -->
                                                                <div class="row-sm">

                                                                    <div class="subheading" style="background-color:transparent;border: 0px;">
                                                                        <h4 class="title" style="color: #25c2da;"><strong>Onward</strong></h4>
                                                                    </div>
                                                                    <p class="col-xs-12 col-sm-3 booking-opt-flight">
                                                                        <span> <?php echo current($operating_cityname_o); ?> </span> <span><i class="material-icons rotate90">&#xE195;</i></span> <span> <?php echo end($operating_cityname_d); ?> </span>
                                                                    </p>
                                                                    <p class="col-xs-6 col-sm-4">
                                                                        <select class="selectpicker form-control baggageoption ancillarySP" data-target="_a<?= $a ?>" id="baggage<?= $a ?>" name="baggage[]" onchange="show_baggage(this)">
                                                                            <option value="">-- Select baggage option--</option>
                                                                            <?php //echo '<pre/>';print_r($ssrresponsex);exit;
                                                                            $Baggage =  $ssrresponsex->Response->Baggage[0];
                                                                            for ($i = 0; $i <= count($Baggage); $i++) {
                                                                                $Code = $Baggage[$i]->Code;
                                                                                $Weight = $Baggage[$i]->Weight;
                                                                                $Price = $Baggage[$i]->Price;
                                                                                $WayType = $Baggage[$i]->WayType;
                                                                                $AirlineCode = $Baggage[$i]->AirlineCode;
                                                                                $Currency = $Baggage[$i]->Currency;
                                                                                $FlightNumber = $Baggage[$i]->FlightNumber;
                                                                                $Description = $Baggage[$i]->Description;
                                                                                $Origin = $Baggage[$i]->Origin;
                                                                                $Destination = $Baggage[$i]->Destination;

                                                                                // echo '<pre/>';print_r($Code);exit;
                                                                            ?>
                                                                                <?php if ($Weight != '') { ?>
                                                                                    <option value="<?php echo $Code . '@^@' . $Weight . '@^@' . $Price . '@^@' . $WayType . '@^@' . $Currency . '@^@' . $Description . '@^@' . $Origin . '@^@' . $Destination ?>"><?php echo $Weight ?>kg <span>&nbsp;<?php echo '(Rs' . $Price . ')' ?></span></option>
                                                                            <?php  }
                                                                            } ?>

                                                                        </select>
                                                                    </p>

                                                                    <p class="col-xs-6 col-sm-5">
                                                                        <span class="label-normal bagprice" data-price="" id="price_a<?= $a ?>"> + INR 0 </span>
                                                                    </p>

                                                                </div> <!-- row item-option //  -->



                                                                <!-- checkin baggage .end// -->

                                                            </article> <!--  tab-item.// -->
                                                        <?php } ?>

                                                        <?php if ($ssrresponsex->Response->MealDynamic != '') { ?>
                                                            <article class="tab-item mealtab_item_a<?= $a + 1; ?>">
                                                                <!-- meal prefereces -->


                                                                <div class="row-sm">
                                                                    <div class="subheading" style="background-color:transparent;border: 0px;">
                                                                        <h4 class="title" style="color: #25c2da;"><strong>Onward</strong></h4>
                                                                    </div>

                                                                    <p class="col-xs-12 col-sm-3 booking-opt-flight">
                                                                        <span> <?php echo current($operating_cityname_o); ?> </span> <span><i class="material-icons rotate90">&#xE195;</i></span> <span> <?php echo end($operating_cityname_d); ?> </span>
                                                                    </p>

                                                                    <p class="col-xs-7 col-sm-3">
                                                                        <select class="selectpicker form-control mealoption ancillarySP" data-target="_a<?= $a ?>" name="meal[]" id="sel<?= $a ?>" onchange="show(this)">
                                                                            <option value="">-- Select meal option--</option>
                                                                            <?php //echo '<pre/>';print_r($ssrresponsex);exit;
                                                                            $MealDynamic =  $ssrresponsex->Response->MealDynamic[0];
                                                                            for ($i = 0; $i <= count($MealDynamic); $i++) {
                                                                                $Code = $MealDynamic[$i]->Code;
                                                                                $AirlineDescription = $MealDynamic[$i]->AirlineDescription;
                                                                                $Quantity = $MealDynamic[$i]->Quantity;
                                                                                $Price = $MealDynamic[$i]->Price;
                                                                                $WayType = $MealDynamic[$i]->WayType;
                                                                                $Origin_ssr = $MealDynamic[$i]->Origin;
                                                                                $Destination_ssr = $MealDynamic[$i]->Destination;
                                                                                $AirlineCode = $MealDynamic[$i]->AirlineCode;
                                                                                $FlightNumber = $MealDynamic[$i]->FlightNumber;
                                                                                $Currency = $MealDynamic[$i]->Currency;
                                                                                $Description = $MealDynamic[$i]->Description;
                                                                                // echo '<pre/>';print_r($Code);exit;
                                                                            ?>
                                                                                <?php if ($AirlineDescription != '') { ?>
                                                                                    <option value="<?php echo $Code . '@^@' . $AirlineDescription . '@^@' . $Quantity . '@^@' . $Price . '@^@' . $WayType . '@^@' . $Origin_ssr . '@^@' . $Destination_ssr . '@^@' . $Currency . '@^@' . $Description ?>"><?php echo $AirlineDescription ?> <span>&nbsp;<?php echo '(Rs' . $Price . ')' ?></span></option>
                                                                            <?php  }
                                                                            } ?>
                                                                        </select>
                                                                        <!-- <a href="#modal_meal_2519adults1" data-toggle="modal" class="btn btn-default ancillary-btn" data-content="<p><img src=&quot;https://asfartrip.com/public/assets/images/misc/seats.jpg&quot;></p>" data-placement="right">Meals for DEL - BOM </a>                            -->
                                                                    </p>

                                                                    <p class="col-xs-5 col-sm-5">
                                                                        <span class="label-normal mealprice" data-price="" id="msg_a<?= $a ?>">No Meal</span>
                                                                    </p>

                                                                </div> <!-- row item-option //  -->


                                                            </article>
                                                        <?php } ?>

                                                    </div>
                                                </div> <!-- blok-options // -->
                                            </div> <!-- collapse  // -->


                                            <!-- Modal Meal Start -->

                                            <!-- Modal Meal End -->
                                            <?php } ?>
                                    </article> <!-- panel-body// -->
                                <?php } ?>
                                <!-- passenger 1 form end//  -->

                                <!-- childs start -->
                                <?php //$flight_result->childs = 1;
                                if ($flight_result->childs != 0) { ?>
                                    <?php for ($c = 0; $c < $flight_result->childs; $c++) { ?>
                                        <div class="subheading">
                                            <h4 class="title"><strong><span id="printtitle"></span> <span id="printfirstname" class="text-capitalize"></span> <span id="printlastname" class="text-capitalize"></span> (Child <?php echo $c + 1; ?>)</strong></h4>
                                        </div>

                                        <article class="panel-body">
                                            <!-- passenger 1 form start  -->

                                            <div id="traveler-1">
                                                <div class="row-sm">
                                                    <label class="col-sm-2 control-label">Full Name</label>
                                                    <div class="form-group col-sm-2">
                                                        <select class="selectpicker form-control title traveller_title1" name="childTitle[]" id="childTitle[]" data-error="Please select title" required>
                                                            <option value="">Title</option>
                                                            <option value="Mstr">Mstr</option>
                                                            <option value="Miss">Miss</option>
                                                        </select>
                                                        <small class="help-block with-errors"></small>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <input type="text" id="fname" class="form-control first_name traveller_firstname1 text-capitalize" value="" name="childFName[]" id="childFName[]" pattern='[a-zA-Z\s]+' placeholder="First Name" data-error="Valid First Name is required" required>
                                                        <small class="help-block with-errors"></small>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <input type="text" class="form-control last_name traveller_lastname1 text-capitalize" value="" placeholder="Last Name" name="childLName[]" id="childLName[]" pattern='[a-zA-Z\s]+' required data-error="Valid Last Name is required">
                                                        <small class="help-block with-errors"></small>
                                                    </div>
                                                </div> <!-- form-group// -->

                                                <div class="row-sm selectdate-validate">
                                                    <label class="col-sm-2 col-xs-12 control-label">Date of birth</label>
                                                    <div class="form-group col-sm-2 col-xs-4">
                                                        <select class="selectpicker form-control traveller_dobD1 day" data-live-search="true" name="childDOBDate[]" id="childDOBDate[]" required="" data-error="Please select day" onchange="isValidDate(this, 'child<?= $c + 1; ?>', 'dob')">
                                                            <option value="">Day</option>
                                                            <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                                                                <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <small class="help-block with-errors"></small>
                                                    </div>
                                                    <div class="form-group col-sm-2 col-xs-4">
                                                        <select class="selectpicker form-control traveller_dobM1 month" data-live-search="true" name="childDOBMonth[]" id="childDOBMonth[]" required="" data-error="Please select month" onchange="isValidDate(this, 'child<?= $c + 1; ?>', 'dob')">
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
                                                        </select>
                                                        <small class="help-block with-errors"></small>
                                                    </div>
                                                    <div class="form-group col-sm-2 col-xs-4">
                                                        <select class="selectpicker form-control traveller_dobY1 year" data-live-search="true" name="childDOBYear[]" id="childDOBYear[]" required="" data-error="Please select year" onchange="isValidDate(this, 'child<?= $c + 1; ?>', 'dob')">
                                                            <option value="">Year</option>
                                                            <?php for ($ag = (date('Y') - 11); $ag <= (date('Y') - 2); $ag++) { ?>
                                                                <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <small class="help-block with-errors"></small>
                                                    </div>

                                                    <!-- Nationality 1 form start//  -->
                                                    <div class="" id="nationality_details_1">
                                                        <div class="row-sm">
                                                            <!-- <label class="col-sm-2 control-label">Nationality</label> -->
                                                            <div class="form-group col-sm-3">
                                                                <select class="selectpicker form-control nationality" data-live-search="true" name="childPPICountry[]" id="childPPICountry[]" required data-error="Please select country">
                                                                    <option value="">Select Nationality</option>
                                                                    <?php foreach ($country_list as $con) { ?>
                                                                        <option value="<?php echo $con->iso2; ?>"><?php echo $con->name; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <small class="help-block with-errors"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Nationality 1 form end//  -->


                                                    <!-- form-group// -->
                                                    <?php if ($flight_result->isdomestic == 'false') {  ?>
                                                        <div class=" hide" id="passport_details_1">

                                                            <div class="row-sm">
                                                                <label class="col-sm-2 control-label">Passport detail</label>
                                                                <div class="form-group col-sm-3">
                                                                    <input type="text" class="form-control passport_no" value="" name="childPPNo[]" id="childPPNo[]" pattern="[a-zA-Z0-9]+" placeholder="Passport number" data-error="Valid passport number is required">
                                                                    <small class="help-block with-errors"></small>
                                                                </div>
                                                                <div class="form-group col-sm-3">
                                                                    <select class="selectpicker form-control passport_country" data-live-search="true" name="childPPICountry[]" id="childPPICountry[]" data-error="Please select country">
                                                                        <?php foreach ($country_list as $con) { ?>
                                                                            <option value="<?php echo $con->iso2; ?>"><?php echo $con->name; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <small class="help-block with-errors"></small>
                                                                </div>
                                                            </div> <!-- row// -->

                                                            <div class="row-sm selectdate-validate">
                                                                <label class="col-sm-2 col-xs-12 control-label">Passport expiry date</label>
                                                                <div class="form-group col-sm-2 col-xs-4">
                                                                    <select class="selectpicker form-control day passday" data-live-search="true" name="childPPEDate[]" id="childPPEDate[]" data-error="Please select day" onchange="isValidDate(this, 'adult1', 'passport')">
                                                                        <option value="">Day</option>
                                                                        <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                                                                            <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <small class="help-block with-errors"></small>
                                                                </div>
                                                                <div class="form-group col-sm-2 col-xs-4">
                                                                    <select class="selectpicker form-control month passmonth" data-live-search="true" name="childPPEMonth[]" id="childPPEMonth[]" data-error="Please select month" onchange="isValidDate(this, 'adult1', 'passport')">
                                                                        <option value="">Month</option>
                                                                        <?php for ($ag = 1; $ag <= 12; $ag++) { ?>
                                                                            <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <small class="help-block with-errors"></small>
                                                                </div>
                                                                <div class="form-group col-sm-2 col-xs-4">
                                                                    <select class="selectpicker form-control year passyear" data-live-search="true" name="childPPEYear[]" id="childPPEYear[]" data-error="Please select year" onchange="isValidDate(this, 'adult1', 'passport')">
                                                                        <option value="">Year</option>
                                                                        <?php for ($ag = date('Y'); $ag <= (date('Y') + 200); $ag++) { ?>
                                                                            <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <small class="help-block with-errors"></small>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <p class="text-right relative">
                                                                        <a href="#childs<?= $c + 1; ?>" class="btn btn-normal btn-extra" data-toggle="collapse" aria-expanded="false">More Options <i class="fa fa-chevron-down"></i></a>
                                                                        <span class="alert-baggage alert-dismiss hidden-xs top"><span class="close">&times</span> There are ancillary services for this traveller. Would you like to purchase baggage, meals, or seats?</span>
                                                                    </p>
                                                                </div> <!--  form group// -->
                                                            </div> <!-- row// -->

                                                            <div class="row">
                                                                <span class="col-sm-6 col-sm-offset-2 alert-warning text-center hide" style="color: red;" id="errorpas-child<?= $c + 1; ?>"></span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>



                                                </div>
                                            </div>

                                            <?php if (($ssrresponsex->Response->Baggage != '') or ($ssrresponsex->Response->MealDynamic != '')) { ?>
                                                <div class="collapse" id="childs<?= $c + 1; ?>">
                                                    <div class="jq-tab blok-options-tab">
                                                        <ul class="nav nav-pills">                                                        

                                                            <li data-refid="_c<?= $c + 1; ?>" data-target="baggagetab_item_c<?= $c + 1; ?>" id="baggagetab" class="baggagetab active"><a><i class="material-icons">work</i> Baggage</a></li>
                                                            <li data-refid="_c<?= $c + 1; ?>" data-target="mealtab_item_c<?= $c + 1; ?>" id="mealtab" class="mealtab"><a ><i class="material-icons">restaurant</i> MEAL PREFERENCES</a></li>
                                                        </ul>
                                                        <div class="tab-item-wrap">
                                                            <?php if ($ssrresponsex->Response->Baggage != '') { ?>
                                                                <article class="tab-item baggagetab_item_c<?= $c + 1; ?> active">
                                                                    <!-- checkin baggage -->
                                                                    <div class="row-sm">

                                                                        <div class="subheading" style="background-color:transparent;border: 0px;">
                                                                            <h4 class="title" style="color: #25c2da;"><strong>Onward</strong></h4>
                                                                        </div>
                                                                        <p class="col-xs-12 col-sm-3 booking-opt-flight">
                                                                            <span> <?php echo current($operating_cityname_o); ?> </span> <span><i class="material-icons rotate90">&#xE195;</i></span> <span> <?php echo end($operating_cityname_d); ?> </span>
                                                                        </p>
                                                                        <p class="col-xs-6 col-sm-4">
                                                                            <select class="selectpicker form-control ancillarySP" data-target="_c<?= $c ?>" name="cbaggage[]" id="baggage<?= $c ?>" onchange="show_baggage(this)">
                                                                                <option value="">No, thanks</option>
                                                                                <?php //echo '<pre/>';print_r($ssrresponsex);exit;
                                                                                $Baggage =  $ssrresponsex->Response->Baggage[0];
                                                                                for ($i = 0; $i <= count($Baggage); $i++) {
                                                                                    $Code = $Baggage[$i]->Code;
                                                                                    $Weight = $Baggage[$i]->Weight;
                                                                                    $Price = $Baggage[$i]->Price;
                                                                                    $WayType = $Baggage[$i]->WayType;
                                                                                    $AirlineCode = $Baggage[$i]->AirlineCode;
                                                                                    $Currency = $Baggage[$i]->Currency;
                                                                                    $FlightNumber = $Baggage[$i]->FlightNumber;
                                                                                    $Description = $Baggage[$i]->Description;
                                                                                    $Origin = $Baggage[$i]->Origin;
                                                                                    $Destination = $Baggage[$i]->Destination;

                                                                                    // echo '<pre/>';print_r($Code);exit;
                                                                                ?>
                                                                                    <?php if ($Weight != '') { ?>
                                                                                        <option value="<?php echo $Code . '@^@' . $Weight . '@^@' . $Price . '@^@' . $WayType . '@^@' . $AirlineCode . '@^@' . $Currency . '@^@' . $FlightNumber . '@^@' . $Description . '@^@' . $Origin . '@^@' . $Destination ?>"><?php echo $Weight ?>kg <span>&nbsp;<?php echo '(Rs' . $Price . ')' ?></span></option>
                                                                                <?php  }
                                                                                } ?>

                                                                            </select>
                                                                        </p>

                                                                        <p class="col-xs-6 col-sm-5">
                                                                            <span class="label-normal bagprice" data-price="" id="price_c<?= $c ?>"> + INR 0 </span>
                                                                        </p>

                                                                    </div> <!-- row item-option //  -->



                                                                    <!-- checkin baggage .end// -->

                                                                </article> <!--  tab-item.// -->
                                                            <?php } ?>

                                                            <?php if ($ssrresponsex->Response->MealDynamic != '') { ?>
                                                                <article class="tab-item mealtab_item_c<?= $c + 1; ?>">
                                                                    <!-- meal prefereces -->


                                                                    <div class="row-sm">
                                                                        <div class="subheading" style="background-color:transparent;border: 0px;">
                                                                            <h4 class="title" style="color: #25c2da;"><strong>Onward</strong></h4>
                                                                        </div>

                                                                        <p class="col-xs-12 col-sm-3 booking-opt-flight">
                                                                            <span> <?php echo current($operating_cityname_o); ?> </span> <span><svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 28 29" fill="none">
                                                                                    <path fill="#333333" stroke="#333333" stroke-width="0.96"></path>
                                                                                </svg></span> <span> <?php echo end($operating_cityname_d); ?> </span>
                                                                        </p>

                                                                        <p class="col-xs-7 col-sm-3">
                                                                            <select class="selectpicker form-control ancillarySP" data-target="_c<?= $c ?>" name="cmeal[]" id="sel<?= $c ?>" onchange="show(this)">
                                                                                <option value="">-- Select meal option--</option>
                                                                                <?php //echo '<pre/>';print_r($ssrresponsex);exit;
                                                                                $MealDynamic =  $ssrresponsex->Response->MealDynamic[0];
                                                                                for ($i = 0; $i <= count($MealDynamic); $i++) {
                                                                                    $Code = $MealDynamic[$i]->Code;
                                                                                    $AirlineDescription = $MealDynamic[$i]->AirlineDescription;
                                                                                    $Quantity = $MealDynamic[$i]->Quantity;
                                                                                    $Price = $MealDynamic[$i]->Price;
                                                                                    $WayType = $MealDynamic[$i]->WayType;
                                                                                    $Origin_ssr = $MealDynamic[$i]->Origin;
                                                                                    $Destination_ssr = $MealDynamic[$i]->Destination;
                                                                                    $AirlineCode = $MealDynamic[$i]->AirlineCode;
                                                                                    $FlightNumber = $MealDynamic[$i]->FlightNumber;
                                                                                    $Currency = $MealDynamic[$i]->Currency;
                                                                                    $Description = $MealDynamic[$i]->Description;
                                                                                    // echo '<pre/>';print_r($Code);exit;
                                                                                ?>
                                                                                    <?php if ($AirlineDescription != '') { ?>
                                                                                        <option value="<?php echo $Code . '@^@' . $AirlineDescription . '@^@' . $Quantity . '@^@' . $Price . '@^@' . $WayType . '@^@' . $Origin_ssr . '@^@' . $Destination_ssr . '@^@' . $Currency . '@^@' . $Description ?>"><?php echo $AirlineDescription ?> <span>&nbsp;<?php echo '(Rs' . $Price . ')' ?></span></option>
                                                                                <?php  }
                                                                                } ?>
                                                                            </select>
                                                                            <!-- <a href="#modal_meal_2519adults1" data-toggle="modal" class="btn btn-default ancillary-btn" data-content="<p><img src=&quot;https://asfartrip.com/public/assets/images/misc/seats.jpg&quot;></p>" data-placement="right">Meals for DEL - BOM </a>                            -->
                                                                        </p>

                                                                        <p class="col-xs-5 col-sm-5">
                                                                            <span class="label-normal mealprice" data-price="" id="msg_c<?= $c ?>">No Meal</span>
                                                                        </p>

                                                                    </div> <!-- row item-option //  -->


                                                                </article>
                                                            <?php } ?>
                                                        </div>
                                                    </div> <!-- blok-options // -->
                                                </div> <!-- collapse  // -->
                                                <?php } 
                                                ?>

                                                <!-- Modal Meal Start -->

                                                <!-- Modal Meal End -->
                                        </article> <!-- panel-body// -->
                                <?php }
                                } ?>
                                <!-- childs end -->

                                <!-- infant start -->
                                <?php //$flight_result->infants = 1;
                                if ($flight_result->infants != 0) { ?>
                                    <?php for ($in = 0; $in < $flight_result->infants; $in++) { ?>
                                        <div class="subheading">
                                            <h4 class="title"><strong><span id="printtitle"></span> <span id="printfirstname" class="text-capitalize"></span> <span id="printlastname" class="text-capitalize"></span> (Infant <?php echo $in + 1; ?>)</strong></h4>
                                        </div>

                                        <article class="panel-body">
                                            <!-- passenger 1 form start  -->

                                            <div id="traveler-1">
                                                <div class="row-sm">
                                                    <label class="col-sm-2 control-label">Full Name</label>
                                                    <div class="form-group col-sm-2">
                                                        <select class="selectpicker form-control title traveller_title1" name="infantTitle[]" id="infantTitle[]" data-error="Please select title" required>
                                                            <option value="">Title</option>
                                                            <option value="Mstr">Mstr</option>
                                                            <option value="Miss">Miss</option>
                                                        </select>
                                                        <small class="help-block with-errors"></small>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <input type="text" id="fname" class="form-control first_name traveller_firstname1 text-capitalize" value="" name="infantFName[]" id="infantFName[]" pattern='[a-zA-Z\s]+' placeholder="First Name" data-error="Valid First Name is required" required>
                                                        <small class="help-block with-errors"></small>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <input type="text" class="form-control last_name traveller_lastname1 text-capitalize" value="" placeholder="Last Name" name="infantLName[]" id="infantLName[]" pattern='[a-zA-Z\s]+' required data-error="Valid Last Name is required">
                                                        <small class="help-block with-errors"></small>
                                                    </div>
                                                </div> <!-- form-group// -->

                                                <div class="row-sm selectdate-validate">
                                                    <label class="col-sm-2 col-xs-12 control-label">Date of birth</label>
                                                    <div class="form-group col-sm-2 col-xs-4">
                                                        <select class="selectpicker form-control traveller_dobD1 day" data-live-search="true" name="infantDOBDate[]" id="infantDOBDate[]" required="" data-error="Please select day" onchange="isValidDate(this, 'infant<?= $in + 1; ?>', 'dob')">
                                                            <option value="">Day</option>
                                                            <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                                                                <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <small class="help-block with-errors"></small>
                                                    </div>
                                                    <div class="form-group col-sm-2 col-xs-4">
                                                        <select class="selectpicker form-control traveller_dobM1 month" data-live-search="true" name="infantDOBMonth[]" id="infantDOBMonth[]" required="" data-error="Please select month" onchange="isValidDate(this, 'infant<?= $in + 1; ?>', 'dob')">
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
                                                        </select>
                                                        <small class="help-block with-errors"></small>
                                                    </div>
                                                    <div class="form-group col-sm-2 col-xs-4">
                                                        <select class="selectpicker form-control traveller_dobY1 year" data-live-search="true" name="infantDOBYear[]" id="infantDOBYear[]" required="" data-error="Please select year" onchange="isValidDate(this, 'infant<?= $in + 1; ?>', 'dob')">
                                                            <option value="">Year</option>
                                                            <?php for ($ag = (date('Y') - 2); $ag <= (date('Y')); $ag++) { ?>
                                                                <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <small class="help-block with-errors"></small>
                                                    </div>

                                                    <!-- Nationality 1 form start//  -->
                                                    <div class="" id="nationality_details_1">
                                                        <div class="row-sm">
                                                            <!-- <label class="col-sm-2 control-label">Nationality</label> -->
                                                            <div class="form-group col-sm-3">
                                                                <select class="selectpicker form-control nationality" data-live-search="true" name="infantPPNationality[]" id="infantPPNationality[]" required data-error="Please select country">
                                                                    <option value="">Select Nationality</option>
                                                                    <?php foreach ($country_list as $con) { ?>
                                                                        <option value="<?php echo $con->iso2; ?>"><?php echo $con->name; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <small class="help-block with-errors"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Nationality 1 form end//  -->




                                                    <!-- form-group// -->
                                                    <?php if ($flight_result->isdomestic == 'false') {  ?>
                                                        <div class=" hide" id="passport_details_1">

                                                            <div class="row-sm">
                                                                <label class="col-sm-2 control-label">Passport detail</label>
                                                                <div class="form-group col-sm-3">
                                                                    <input type="text" class="form-control passport_no" value="" name="infantPPNo[]" id="infantPPNo[]" pattern="[a-zA-Z0-9]+" placeholder="Passport number" data-error="Valid passport number is required">
                                                                    <small class="help-block with-errors"></small>
                                                                </div>
                                                                <div class="form-group col-sm-3">
                                                                    <select class="selectpicker form-control passport_country" data-live-search="true" name="infantPPICountry[]" id="infantPPICountry[]" data-error="Please select country">
                                                                        <option value="">Select issuing country</option>
                                                                        <?php foreach ($country_list as $con) { ?>
                                                                            <option value="<?php echo $con->iso2; ?>"><?php echo $con->name; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <small class="help-block with-errors"></small>
                                                                </div>
                                                            </div> <!-- row// -->

                                                            <div class="row-sm selectdate-validate">
                                                                <label class="col-sm-2 col-xs-12 control-label">Passport expiry date</label>
                                                                <div class="form-group col-sm-2 col-xs-4">
                                                                    <select class="selectpicker form-control day passday" data-live-search="true" name="infantPPEDate[]" id="infantPPEDate[]" data-error="Please select day" onchange="isValidDate(this, 'infant<?=$in+1;?>', 'passport')">
                                                                        <option value="">Day</option>
                                                                        <?php for ($ag = 1; $ag <= 31; $ag++) { ?>
                                                                            <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <small class="help-block with-errors"></small>
                                                                </div>
                                                                <div class="form-group col-sm-2 col-xs-4">
                                                                    <select class="selectpicker form-control month passmonth" data-live-search="true" name="infantPPEMonth[]" id="infantPPEMonth[]" data-error="Please select month" onchange="isValidDate(this, 'infant<?=$in+1;?>', 'passport')">
                                                                        <option value="">Month</option>
                                                                        <?php for ($ag = 1; $ag <= 12; $ag++) { ?>
                                                                            <option value="<?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($ag, 2, "0", STR_PAD_LEFT); ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <small class="help-block with-errors"></small>
                                                                </div>
                                                                <div class="form-group col-sm-2 col-xs-4">
                                                                    <select class="selectpicker form-control year passyear" data-live-search="true" name="infantPPEYear[]" id="infantPPEYear[]" data-error="Please select year" onchange="isValidDate(this, 'infant<?=$in+1;?>', 'passport')">
                                                                        <option value="">Year</option>
                                                                        <?php for ($ag = date('Y'); $ag <= (date('Y') + 200); $ag++) { ?>
                                                                            <option value="<?php echo $ag; ?>"><?php echo $ag; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <small class="help-block with-errors"></small>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <p class="text-right relative">
                                                                        <a href="#infants<?= $in + 1; ?>" class="btn btn-normal btn-extra" data-toggle="collapse" aria-expanded="false">More Options <i class="fa fa-chevron-down"></i></a>
                                                                        <span class="alert-baggage alert-dismiss hidden-xs top"><span class="close">&times</span> There are ancillary services for this traveller. Would you like to purchase baggage, meals, or seats?</span>
                                                                    </p>
                                                                </div> <!--  form group// -->
                                                            </div> <!-- row// -->

                                                            <div class="row">
                                                                <span class="col-sm-6 col-sm-offset-2 alert-warning text-center hide" style="color: red;" id="errorpas-child<?= $in + 1; ?>"></span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>



                                                </div>
                                            </div>
                                               
                                        </article> <!-- panel-body// -->
                                <?php }
                                } ?>
                                <!-- infant end -->






                                <div class="subheading">
                                    <h4 class="title"><strong>Contact details</strong></h4>
                                </div>
                                <article class="panel-body">
                                    <!-- contact form start  -->

                                    <div class="mb20 row-sm">
                                        <label class="col-sm-2 control-label">Mobile number</label>
                                        <div class="col-sm-2" style="padding-right:0px;">
                                            <div class="input-group">
                                                <div class="form-group">
                                                    <select class="selectpicker form-control" name="country_code" data-live-search="true" style="max-width:100px" required data-error="Please select code">
                                                        <option value="">Code</option>
                                                        <option value="+93">AF (+93)</option>
                                                        <option value="+358">AX (+358)</option>
                                                        <option value="+355">AL (+355)</option>
                                                        <option value="+213">DZ (+213)</option>
                                                        <option value="+1">AS (+1)</option>
                                                        <option value="+376">AD (+376)</option>
                                                        <option value="+244">AO (+244)</option>
                                                        <option value="+1">AI (+1)</option>
                                                        <option value="672">AQ (672)</option>
                                                        <option value="+1268">AG (+1268)</option>
                                                        <option value="+54">AR (+54)</option>
                                                        <option value="+374">AM (+374)</option>
                                                        <option value="+297">AW (+297)</option>
                                                        <option value="+297">AA (+297)</option>
                                                        <option value="+61">AU (+61)</option>
                                                        <option value="+43">AT (+43)</option>
                                                        <option value="+994">AZ (+994)</option>
                                                        <option value="+973">BH (+973)</option>
                                                        <option value="+880">BD (+880)</option>
                                                        <option value="+1">BB (+1)</option>
                                                        <option value="+375">BY (+375)</option>
                                                        <option value="+32">BE (+32)</option>
                                                        <option value="+501">BZ (+501)</option>
                                                        <option value="+229">BJ (+229)</option>
                                                        <option value="+1">BM (+1)</option>
                                                        <option value="+975">BT (+975)</option>
                                                        <option value="+591">BO (+591)</option>
                                                        <option value="+599">BQ (+599)</option>
                                                        <option value="+387">BA (+387)</option>
                                                        <option value="+267">BW (+267)</option>
                                                        <option value="+599">BV (+599)</option>
                                                        <option value="+55">BR (+55)</option>
                                                        <option value="+246">IO (+246)</option>
                                                        <option value="+673">BN (+673)</option>
                                                        <option value="+359">BG (+359)</option>
                                                        <option value="+226">BF (+226)</option>
                                                        <option value="+95">MM (+95)</option>
                                                        <option value="+257">BI (+257)</option>
                                                        <option value="+855">KH (+855)</option>
                                                        <option value="+237">CM (+237)</option>
                                                        <option value="+1">CA (+1)</option>
                                                        <option value="+238">CV (+238)</option>
                                                        <option value="+1">KY (+1)</option>
                                                        <option value="+236">CF (+236)</option>
                                                        <option value="+235">TD (+235)</option>
                                                        <option value="+56">CL (+56)</option>
                                                        <option value="+86">CN (+86)</option>
                                                        <option value="+61">CX (+61)</option>
                                                        <option value="+891">CC (+891)</option>
                                                        <option value="+855">CO (+855)</option>
                                                        <option value="+269">KM (+269)</option>
                                                        <option value="+242">CG (+242)</option>
                                                        <option value="+243">CD (+243)</option>
                                                        <option value="+682">CK (+682)</option>
                                                        <option value="+506">CR (+506)</option>
                                                        <option value="+225">CI (+225)</option>
                                                        <option value="+385">HR (+385)</option>
                                                        <option value="+53">CU (+53)</option>
                                                        <option value="+599">CW (+599)</option>
                                                        <option value="+357">CY (+357)</option>
                                                        <option value="+420">CZ (+420)</option>
                                                        <option value="+45">DK (+45)</option>
                                                        <option value="+253">DJ (+253)</option>
                                                        <option value="+1767">DM (+1767)</option>
                                                        <option value="+1">DO (+1)</option>
                                                        <option value="+670">TL (+670)</option>
                                                        <option value="+593">EC (+593)</option>
                                                        <option value="+20">EG (+20)</option>
                                                        <option value="+503">SV (+503)</option>
                                                        <option value="+240">GQ (+240)</option>
                                                        <option value="+291">ER (+291)</option>
                                                        <option value="+372">EE (+372)</option>
                                                        <option value="+251">ET (+251)</option>
                                                        <option value="+500">FK (+500)</option>
                                                        <option value="+298">FO (+298)</option>
                                                        <option value="+679">FJ (+679)</option>
                                                        <option value="+358">FI (+358)</option>
                                                        <option value="+33">FR (+33)</option>
                                                        <option value="+594">GF (+594)</option>
                                                        <option value="+689">PF (+689)</option>
                                                        <option value="+241">GA (+241)</option>
                                                        <option value="+220">GM (+220)</option>
                                                        <option value="+995">GE (+995)</option>
                                                        <option value="+49">DE (+49)</option>
                                                        <option value="+233">GH (+233)</option>
                                                        <option value="+350">GI (+350)</option>
                                                        <option value="+30">GR (+30)</option>
                                                        <option value="+299">GL (+299)</option>
                                                        <option value="+1473">GD (+1473)</option>
                                                        <option value="+1">GU (+1)</option>
                                                        <option value="+502">GT (+502)</option>
                                                        <option value="+44">GG (+44)</option>
                                                        <option value="+224">GN (+224)</option>
                                                        <option value="+245">GW (+245)</option>
                                                        <option value="+592">GY (+592)</option>
                                                        <option value="+509">HT (+509)</option>
                                                        <option value="+504">HN (+504)</option>
                                                        <option value="+852">HK (+852)</option>
                                                        <option value="+36">HU (+36)</option>
                                                        <option value="+354">IS (+354)</option>
                                                        <option value="+91" selected='selected'>IN (+91)</option>
                                                        <option value="+62">ID (+62)</option>
                                                        <option value="+98">IR (+98)</option>
                                                        <option value="+964">IQ (+964)</option>
                                                        <option value="+353">IE (+353)</option>
                                                        <option value="+44">IM (+44)</option>
                                                        <option value="+972">IL (+972)</option>
                                                        <option value="+39">IT (+39)</option>
                                                        <option value="+1876">JM (+1876)</option>
                                                        <option value="+81">JP (+81)</option>
                                                        <option value="+44">JE (+44)</option>
                                                        <option value="+962">JO (+962)</option>
                                                        <option value="+7">KZ (+7)</option>
                                                        <option value="+254">KE (+254)</option>
                                                        <option value="+686">KI (+686)</option>
                                                        <option value="+965">KW (+965)</option>
                                                        <option value="+996">KG (+996)</option>
                                                        <option value="+856">LA (+856)</option>
                                                        <option value="+371">LV (+371)</option>
                                                        <option value="+961">LB (+961)</option>
                                                        <option value="+266">LS (+266)</option>
                                                        <option value="+231">LR (+231)</option>
                                                        <option value="+218">LY (+218)</option>
                                                        <option value="+423">LI (+423)</option>
                                                        <option value="+370">LT (+370)</option>
                                                        <option value="+352">LU (+352)</option>
                                                        <option value="+853">MO (+853)</option>
                                                        <option value="+389">MK (+389)</option>
                                                        <option value="+261">MG (+261)</option>
                                                        <option value="+265">MW (+265)</option>
                                                        <option value="+60">MY (+60)</option>
                                                        <option value="+960">MV (+960)</option>
                                                        <option value="+223">ML (+223)</option>
                                                        <option value="+356">MT (+356)</option>
                                                        <option value="+692">MH (+692)</option>
                                                        <option value="+222">MR (+222)</option>
                                                        <option value="+230">MU (+230)</option>
                                                        <option value="+262">YT (+262)</option>
                                                        <option value="+52">MX (+52)</option>
                                                        <option value="+691">FM (+691)</option>
                                                        <option value="+373">MD (+373)</option>
                                                        <option value="+377">MC (+377)</option>
                                                        <option value="+976">MN (+976)</option>
                                                        <option value="+1">MS (+1)</option>
                                                        <option value="+212">MA (+212)</option>
                                                        <option value="+258">MZ (+258)</option>
                                                        <option value="+264">NA (+264)</option>
                                                        <option value="+674">NR (+674)</option>
                                                        <option value="+977">NP (+977)</option>
                                                        <option value="+31">NL (+31)</option>
                                                        <option value="+687">NC (+687)</option>
                                                        <option value="+64">NZ (+64)</option>
                                                        <option value="+505">NI (+505)</option>
                                                        <option value="+227">NE (+227)</option>
                                                        <option value="+234">NG (+234)</option>
                                                        <option value="+683">NU (+683)</option>
                                                        <option value="+672">NF (+672)</option>
                                                        <option value="+850">KP (+850)</option>
                                                        <option value="+1">MP (+1)</option>
                                                        <option value="+47">NO (+47)</option>
                                                        <option value="+968">OM (+968)</option>
                                                        <option value="+92">PK (+92)</option>
                                                        <option value="+680">PW (+680)</option>
                                                        <option value="+970">PS (+970)</option>
                                                        <option value="+507">PA (+507)</option>
                                                        <option value="+675">PG (+675)</option>
                                                        <option value="+595">PY (+595)</option>
                                                        <option value="+51">PE (+51)</option>
                                                        <option value="+63">PH (+63)</option>
                                                        <option value="+870">PN (+870)</option>
                                                        <option value="+48">PL (+48)</option>
                                                        <option value="+351">PT (+351)</option>
                                                        <option value="+1">PR (+1)</option>
                                                        <option value="+974">QA (+974)</option>
                                                        <option value="+40">RO (+40)</option>
                                                        <option value="+7">RU (+7)</option>
                                                        <option value="+250">RW (+250)</option>
                                                        <option value="+590">BL (+590)</option>
                                                        <option value="+1">KN (+1)</option>
                                                        <option value="+1">LC (+1)</option>
                                                        <option value="+590">MF (+590)</option>
                                                        <option value="+508">PM (+508)</option>
                                                        <option value="+1">VC (+1)</option>
                                                        <option value="+685">WS (+685)</option>
                                                        <option value="+378">SM (+378)</option>
                                                        <option value="+239">ST (+239)</option>
                                                        <option value="+966">SA (+966)</option>
                                                        <option value="+221">SN (+221)</option>
                                                        <option value="+381">RS (+381)</option>
                                                        <option value="+248">SC (+248)</option>
                                                        <option value="+232">SL (+232)</option>
                                                        <option value="+65">SG (+65)</option>
                                                        <option value="+1">SX (+1)</option>
                                                        <option value="+421">SK (+421)</option>
                                                        <option value="+386">SI (+386)</option>
                                                        <option value="+677">SB (+677)</option>
                                                        <option value="+252">SO (+252)</option>
                                                        <option value="+27">ZA (+27)</option>
                                                        <option value="+82">KR (+82)</option>
                                                        <option value="+34">ES (+34)</option>
                                                        <option value="+94">LK (+94)</option>
                                                        <option value="+249">SD (+249)</option>
                                                        <option value="+597">SR (+597)</option>
                                                        <option value="+47">SJ (+47)</option>
                                                        <option value="+268">SZ (+268)</option>
                                                        <option value="+46">SE (+46)</option>
                                                        <option value="+41">CH (+41)</option>
                                                        <option value="+963">SY (+963)</option>
                                                        <option value="+886">TW (+886)</option>
                                                        <option value="+992">TJ (+992)</option>
                                                        <option value="+255">TZ (+255)</option>
                                                        <option value="+66">TH (+66)</option>
                                                        <option value="+1">BS (+1)</option>
                                                        <option value="+228">TG (+228)</option>
                                                        <option value="+690">TK (+690)</option>
                                                        <option value="+676">TO (+676)</option>
                                                        <option value="+1">TT (+1)</option>
                                                        <option value="+216">TN (+216)</option>
                                                        <option value="+90">TR (+90)</option>
                                                        <option value="+993">TM (+993)</option>
                                                        <option value="+1">TC (+1)</option>
                                                        <option value="+688">TV (+688)</option>
                                                        <option value="+256">UG (+256)</option>
                                                        <option value="+380">UA (+380)</option>
                                                        <option value="+971">AE (+971)</option>
                                                        <option value="+44">GB (+44)</option>
                                                        <option value="+1">US (+1)</option>
                                                        <option value="+598">UY (+598)</option>
                                                        <option value="+998">UZ (+998)</option>
                                                        <option value="+678">VU (+678)</option>
                                                        <option value="+39">VA (+39)</option>
                                                        <option value="+58">VE (+58)</option>
                                                        <option value="+84">VN (+84)</option>
                                                        <option value="+1">VG (+1)</option>
                                                        <option value="+1">VI (+1)</option>
                                                        <option value="+681">WF (+681)</option>
                                                        <option value="+212">EH (+212)</option>
                                                        <option value="+967">YE (+967)</option>
                                                        <option value="+382">ME (+382)</option>
                                                        <option value="+260">ZM (+260)</option>
                                                        <option value="+263">ZW (+263)</option>
                                                    </select>
                                                    <small class="help-block with-errors"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2" style="padding-left:0px;">
                                            <div class="input-group">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Mobile no." value="" name="phone" pattern="[0-9]+" minlength="8" maxlength="11" required data-error="Valid mobile number is required">
                                                    <small class="help-block with-errors"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!--  form group// -->

                                    <div class="row-sm">
                                        <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-4 form-group">
                                            <input class="form-control" type="email" name="email" value="" placeholder="Your e-ticket will be sent to this email" required data-error="Valid email ID is required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                                            <small class="help-block with-errors"></small>
                                        </div>
                                    </div> <!-- form-group// -->

                                    <div class="row-sm">
                                        <label class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-4 form-group">
                                            <input type="text" class="form-control" placeholder="Address" id="street_address" name="street_address" value="" data-error="Valid Address is required" pattern="[a-zA-Z0-9,.\s]+" required>
                                            <small class="help-block with-errors"></small>

                                        </div> <!-- col// -->
                                        
                                    </div> <!-- form-group// -->


                                    <!-- contact form end //  -->
                                </article> <!-- panel-body // -->


                                <!-- ============== (traveller) full view .end// ============== -->

                                <input type="hidden" name="service_type" value="<?php echo "2"; ?>" />
                                <input type="hidden" name="callBackId" value="<?php echo base64_encode('tbo'); ?>" />
                                <input type="hidden" name="searchId" id="searchId" value="<?php echo $flight_result->search_id; ?>" />
                                <input type="hidden" name="segmentkey" id="segmentkey" value="<?php echo $flight_result->segmentkey; ?>" />
                                <?php if ($flight_result->triptype == 'R' && $flight_result->isdomestic == 'true') { ?>
                                    <input type="hidden" name="searchId1" id="searchId1" value="<?php echo $flight_result_r->search_id; ?>" />
                                    <input type="hidden" name="segmentkey1" id="segmentkey1" value="<?php echo $flight_result_r->segmentkey; ?>" />
                                <?php } ?>

                                <input type="hidden" name="date" id="date" value="<?php echo date('Y-m-d'); ?>">


                                <div class="row-sm text-right" style="margin-top: 20px; padding:15px;">
                                    <?php if ($this->session->has_userdata('agent_logged_in')) { ?>
                                        <button class="btn btn-lg btn-primary" type="submit">Continue</button>
                                    <?php } else { ?>
                                        <button class="btn btn-lg btn-primary" id="travellerDetails2">Continue</button>
                                    <?php } ?>
                                </div>
                                </form>
                    </div>
                </section> <!-- panel// -->

                <!-- //2 -->
                
<script>

    $('.mealtab').click(function(){
        var $this = $(this);
        var target = $($this).attr('data-target');
        var refid = $($this).attr('data-refid');       
        

        if(target == 'mealtab_item'+refid){
        console.log('mealtab_selected');
        $('.'+target).addClass('active');
        $('li[data-target="'+target+'"]').addClass('active');
        $('.baggagetab_item'+refid).removeClass('active');
        $('li[data-target="baggagetab_item'+refid+'"').removeClass('active');
        }        

    });

    $('.baggagetab').click(function(){
        var $this = $(this);
        var target = $($this).attr('data-target');
        var refid = $($this).attr('data-refid');       
        

        if(target == 'baggagetab_item'+refid){
        console.log('baggagetab_selected');
        $('.'+target).addClass('active');
        $('li[data-target="'+target+'"]').addClass('active');
        $('.mealtab_item'+refid).removeClass('active');
        $('li[data-target="mealtab_item'+refid+'"').removeClass('active');
        }        

    });

    
</script>

                <script>
                    var site_url = <?php echo site_url(); ?>;
                </script>


                <script type="text/javascript">
                    function datediff(date1, date2) {
                        var y1 = date1.getFullYear(),
                            m1 = date1.getMonth(),
                            d1 = date1.getDate(),
                            y2 = date2.getFullYear(),
                            m2 = date2.getMonth(),
                            d2 = date2.getDate();
                        if (d1 < d2) {
                            m1--;
                        }
                        if (m1 < m2) {
                            y1--;
                            m1 += 12;
                        }
                        return [y1 - y2, m1 - m2, d1 - d2];
                    }

                    function isValidDate(that, key, type) {
                        var trip_date = new Date();
                        var dayEl = $(that).closest('.selectdate-validate').find('select.day');
                        var monthEl = $(that).closest('.selectdate-validate').find('select.month');
                        var yearEl = $(that).closest('.selectdate-validate').find('select.year');
                        var day = Number(dayEl.val()),
                            month = Number(monthEl.val()),
                            year = Number(yearEl.val());
                        if (day > 0 && month > 0 && year > 0) {

                            var date = new Date();
                            month--;
                            date.setFullYear(year, month, day);
                            // month - 1 since the month index is 0-based (0 = January)                   
                            if ((date.getFullYear() === year) && (date.getMonth() === month) && (date.getDate() === day)) {

                                if (key != '' && typeof key !== 'undefined' && type == 'dob') {

                                    var split = trip_date.split('-');
                                    var currDay = Number(split[0]);
                                    var currMonth = Number(split[1]);
                                    var currYear = split[2];
                                    //var age = currYear - year;

                                    var curd = new Date(currYear, currMonth, currDay);
                                    var cald = new Date(year, month + 1, day);
                                    var diff = Date.UTC(currYear, currMonth, currDay, 0, 0, 0) - Date.UTC(year, month, day, 0, 0, 0);
                                    var dife = datediff(curd, cald);
                                    var age = dife[0];
                                    $("#error-" + key).addClass("hide");
                                    if ((key.slice(0, 3) == 'adu') && (age < 12)) {
                                        dayEl.val('').change();
                                        monthEl.val('').change();
                                        yearEl.val('').change();
                                        $("#error-" + key).removeClass("hide");
                                        $("#error-" + key).text('Adult Age should be greater or equal to 12 years');
                                    } else if ((key.slice(0, 3) == 'chi') && ((age >= 12) || (age < 2))) {
                                        dayEl.val('').change();
                                        monthEl.val('').change();
                                        yearEl.val('').change();
                                        $("#error-" + key).removeClass("hide");
                                        $("#error-" + key).text('Child Age should be greater or equal to 2 years and less than 12 years');
                                    } else if ((key.slice(0, 3) == 'inf') && (age >= 2)) {
                                        dayEl.val('').change();
                                        monthEl.val('').change();
                                        yearEl.val('').change();
                                        $("#error-" + key).removeClass("hide");
                                        $("#error-" + key).text('Infant Age should be less than 2 years');
                                    }

                                } else {
                                    //passport expiry			
                                    $("#errorpas-" + key).addClass("hide");
                                    var split = trip_date.split('-');
                                    var currDay = Number(split[0]);
                                    var currMonth = Number(split[1]);
                                    var currYear = split[2];
                                    var d1 = new Date(currYear, (currMonth - 1), currDay);
                                    var d2 = new Date(year, (month), day);
                                    if (d1 > d2) {
                                        dayEl.val('').change();
                                        monthEl.val('').change();
                                        yearEl.val('').change();
                                        $("#errorpas-" + key).removeClass("hide");
                                        $("#errorpas-" + key).text('Passport should be valid till the arrival date of last flight');
                                    }
                                    //passport expiry end
                                }

                                return true;
                            } else {
                                dayEl.val('').change();
                            }
                        }
                    }

                    $(document).ready(function() {
                        $('.modal').on('shown.bs.modal', function(e) {
                            $("img").trigger("unveil");
                        });
                        $("img").unveil(100);
                        $('#traveler-form').validator({
                            disable: true,
                            focus: true,
                        }).on('submit', function(e) {
                            if (e.isDefaultPrevented()) {
                                // handle the invalid form...
                                return false;
                            } else {
                                // everything looks good!
                                saveTravelerInfor();
                                return false;
                            }
                        });
                        $('.bfh-countries').on('click', function() {
                            $(this).toggleClass("open");
                            $(this).parent().find('ul li a').on('click', function() {
                                $('#countryCode').val($(this).attr("data-option"));
                                $('span#country_code_op').html($(this).html());
                                $("#country").val($(this).data('code'));
                            });
                        });
                        var xhr;

                        function saveTravelerInfor() {
                            $(".spin-loader").removeClass("hide");
                            $('#traveler-submit-btn').prop('disabled', true);
                            var total_passanger = '1';
                            for (var t = 1; t <= total_passanger; t++) {
                                $("#traveller_name" + t).text($(".traveller_title" + t).find(":selected").val() + ' ' + $(".traveller_firstname" + t).val() + ' ' + $(".traveller_lastname" + t).val());
                                $("#traveller_dob" + t).text($(".traveller_dobD" + t).find(":selected").val() + '-' + $(".traveller_dobM" + t).find(":selected").val() + '-' + $(".traveller_dobY" + t).find(":selected").val());
                            }

                            if (xhr && xhr.readyState !== 4) {
                                xhr.abort();
                            }
                            xhr = $.ajax({
                                type: 'POST',
                                async: true,
                                dataType: 'json',
                                data: $('form[name="traveler-form"]').serializeArray(),
                                url: site_url + '/flight/booking/checkout',
                                beforeSend: function() {
                                    //$(".loading").fadeIn();
                                },
                                success: function(response) {

                                    if (typeof response.success !== 'undefined' && response.success === 1) {
                                        $("#traveler-collapser-info").removeClass("hide");
                                        activate_block('traveller-block');
                                        //Insurance Start
                                        if (typeof response.super_seniors !== 'undefined' && response.super_seniors > 0) {
                                            $("#error").addClass("show");
                                            $("#error1").text('Sorry insurance cannot be confirmed. Age should be less than 70.');
                                        }
                                        if (typeof response.seniors !== 'undefined' && response.seniors > 0) {
                                            $("#error").addClass("show");
                                            $("#error1").text('The insurance price has been increased as there is traveller more than 64 years.');
                                        }

                                        if (typeof response.insurance_error !== 'undefined' && response.insurance_error != '') {
                                            $("#error").addClass("show");
                                            $("#error1").text(response.insurance_error);
                                        }
                                        //Inurance End

                                        $("#deduct_amount").text('INR ' + response.deposit_amount_new);
                                        var paynow = 'Pay Now INR ' + response.total;
                                        $('#checkin').val(paynow);
                                        $('#payButton').val(paynow);
                                        $('.grandtotal1').text('INR ' + response.deposit_amount);
                                        if (typeof response.ifrurl !== 'undefined') {
                                            //Loading Payment Iframe
                                            //reloadIframeSource(response.ifrurl);
                                            $("#payment_creditcard").removeClass("hide");
                                            $('#paymentFrame').html(response.ifrurl);
                                            if (!$.isEmptyObject(response.html)) {
                                                $("#payment-data").html(response.html);
                                            }


                                            if (typeof response.service_charge !== 'undefined') {
                                                $('#service_charge_rate').removeClass('hide').find('span').text(response.service_charge);
                                            }

                                            if (typeof response.agent_balance !== 'undefined') {
                                                $("#agent_balance").text(response.agent_balance);
                                            }

                                            if (typeof response.price_change !== 'undefined' && response.price_change == 'Yes') {
                                                //$("#error").addClass("show");
                                                //$("#error1").text('Sorry your booking price has been changed by the airline.');

                                                $("#high_price").addClass("show");
                                                $("#high_price_total").text('INR ' + response.deposit_amount);
                                                $('html').animate({
                                                    scrollTop: $('#flight-block').offset().top
                                                }, 700);
                                            }
                                            if (typeof response.less_credit !== 'undefined' && response.less_credit == 'Yes') {
                                                $("#deposit_form").addClass("hide");
                                                $("#msg_deposit").text("There is no sufficient balance in your deposit account. So please use payment gateway method.");
                                            }
                                        }

                                        if (typeof response.qr_code_img !== 'undefined') {
                                            if (navigator.userAgent.toLowerCase().indexOf('payby') !== -1) {
                                                $('#payby_token').val(response.payby_token);
                                                if (typeof ToPayJSBridge === 'undefined') {
                                                    document.addEventListener('ToPayJSBridgeReady', onBridgeReady, false);
                                                } else {
                                                    onBridgeReady();
                                                }
                                                // call PayBy API
                                                window.ToPayJSBridge.invoke(
                                                    'ToPayRequest', {
                                                        appId: '200006765142', // partnerId
                                                        token: response.payby_token, // token
                                                    },
                                                    function(data) {
                                                        const res = JSON.parse(data);
                                                        console.log('ToPayJSBridge:res', res);
                                                        $('#pnr_no').val(response.pnr_no);
                                                        if (res.status === 'success') {
                                                            // Success Callback
                                                            window.location.href = "https://travelfreebuy.com/en/payby/confirm/" + response.pnr_no + "/success";
                                                        } else {
                                                            window.location.href = "https://travelfreebuy.com/en/payby/confirm/" + response.pnr_no + "/failed";
                                                        }
                                                    }
                                                )
                                            }
                                            $("#qr_code_img").html(response.qr_code_img);
                                            $(".payby").removeClass("hide");
                                        } else {
                                            $(".payby").addClass("hide");
                                        }
                                        if (typeof response.holdBooking !== 'undefined' && response.holdBooking == 'Yes') {
                                            $(".holdButton").removeClass('hide');
                                        } else {
                                            $(".holdButton").addClass("hide");
                                        }
                                    } else {
                                        $("#deduct_amount").text('INR ' + response.deposit_amount_new);
                                        $("#customerData").addClass("hide");
                                        $("#error").addClass("show");
                                        $("#error1").text('Sorry your booking cannot be confirmed.');
                                        activate_block('traveller-block');
                                        $("#bookingfailed").text("Please re-search your itinerary. Flight booking cannot be confirmed.");
                                    }

                                    $(".spin-loader").addClass("hide");
                                    //Disable Select buttons
                                    if (parseFloat($('#luggagetotal').text()) > 0) {
                                        $('.ancillarySP').prop('disabled', true);
                                    }

                                },
                                complete: function() {
                                    $('#traveler-submit-btn').prop('disabled', false);
                                    //$(".loading").fadeOut();
                                }
                            });
                        }

                        $('.panel.panel-booking').on('blockActive', function() {
                            if ($(this).hasClass('panel-active') && $(this).attr('id') == 'payment-block') {
                                $("#coupon-block").hide();
                            } else {
                                $("#coupon-block").show();
                            }
                        });
                    }); //onclick="saveTravelerInfor()"

                    function onBridgeReady() {
                        console.log('ToPayJSBridge:start');
                        window.ToPayJSBridge.init(function(message, responseCallback) {})
                    }

                    function paybyRestartJSAPI() {
                        if (navigator.userAgent.toLowerCase().indexOf('payby') !== -1) {
                            // call PayBy API
                            var payby_token = $("#payby_token").val();
                            window.ToPayJSBridge.invoke(
                                'ToPayRequest', {
                                    appId: '200006765142', // partnerId
                                    token: payby_token, // token
                                },
                                function(data) {
                                    const res = JSON.parse(data);
                                    console.log('ToPayJSBridge:res', res);
                                    var pnr_no = $('#pnr_no').val();
                                    if (res.status === 'success') {
                                        // Success Callback
                                        window.location.href = "https://travelfreebuy.com/en/payby/confirm/" + pnr_no + "/success";
                                    } else {
                                        window.location.href = "https://travelfreebuy.com/en/payby/confirm/" + pnr_no + "/failed";
                                    }
                                }
                            )
                        }
                    }
                </script>


                <script type="text/javascript">
                    var inputBox = document.getElementById('first_name176433');
                    var last_name = document.getElementById('last_name176433');
                    var selTitle = document.getElementById('selTitle176433');
                    inputBox.onkeyup = function() {
                        document.getElementById('printfirstname').innerHTML = inputBox.value;
                    }
                    last_name.onkeyup = function() {
                        document.getElementById('printlastname').innerHTML = last_name.value + ' - ';
                    }

                    selTitle.onchange = function() {
                        document.getElementById('printtitle').innerHTML = selTitle.value;
                    }

                    function validateInsurance(cur) {

                        var domestic_insurance = $('input[name=insurance]:checked').val();
                        var quote_id = '4541306';
                        var scheme_id = '292';
                        var insurance_premium = 40;
                        if (domestic_insurance != "Yes") {
                            var domestic_insurance = 'No';
                        }
                        $('#insurance_selected').text(domestic_insurance);
                        var showPassport = 'NO';
                        var site_currency = 'INR';
                        var grandtotal = $('#grandtotal').val();
                        var discountpoints = $('#discountpoints').text();
                        var premium = '40';
                        var luggagetotal = $('#luggagetotal').text();
                        var discountcoupon = $('#discountcoupon').text();
                        var total_passanger_count = '1';
                        $(".errorcoupon2").text('');
                        $.post('https://travelfreebuy.com/en/flight/apt/validateInsurance1', {
                                'insurance': domestic_insurance,
                                'scheme_id': scheme_id,
                                'passanger_count': '1',
                                'cart_id': '56176',
                                'parent_pnr': '176433',
                                'insurance_premium': insurance_premium
                            },
                            function(res) {
                                if (res == "No") {
                                    $(".insurance_details").addClass('hide');
                                    if (showPassport == 'NO') {
                                        for (var i = 0; i < total_passanger_count; i++) {
                                            $("#passport_details_" + (i + 1)).addClass('hide');
                                            $("#more_options_passport_" + (i + 1)).removeClass('hide');
                                            $("#nationality_details_" + (i + 1)).removeClass('hide');
                                        }
                                        $(".passport_no").prop('required', false);
                                        $(".nationality").prop('required', true);
                                    }

                                    $("[name=applied_code]").val('');
                                    $(".errorcoupon2").text('Insurance cannot be added.');
                                    $(".insurance").text('');
                                    var discountpoints1 = parseFloat(discountpoints);
                                    if (discountpoints1 > 0) {} else {
                                        var discountpoints1 = 0;
                                    }

                                    var luggagetotal1 = parseFloat(luggagetotal);
                                    if (luggagetotal1 > 0) {} else {
                                        var luggagetotal1 = 0;
                                    }

                                    var discountcoupon1 = parseFloat(discountcoupon);
                                    if (discountcoupon1 > 0) {} else {
                                        var discountcoupon1 = 0;
                                    }

                                    var www = (parseFloat(grandtotal) + luggagetotal1) - (discountpoints1 + discountcoupon1);
                                    $(".grandtotal1").text(site_currency + " " + www);
                                } else {
                                    $(".insurance_details").removeClass('hide');
                                    $(".insurance").text(insurance_premium);
                                    if (showPassport != 'YES') {
                                        for (var i = 0; i < total_passanger_count; i++) {
                                            $("#passport_details_" + (i + 1)).removeClass('hide');
                                            $("#more_options_passport_" + (i + 1)).addClass('hide');
                                            $("#nationality_details_" + (i + 1)).addClass('hide');
                                        }
                                        $(".passport_no").prop('required', true);
                                        $(".nationality").prop('required', false);
                                    }

                                    var discountpoints1 = parseFloat(discountpoints);
                                    if (discountpoints1 > 0) {} else {
                                        var discountpoints1 = 0;
                                    }

                                    var luggagetotal1 = parseFloat(luggagetotal);
                                    if (luggagetotal1 > 0) {} else {
                                        var luggagetotal1 = 0;
                                    }

                                    var discountcoupon1 = parseFloat(discountcoupon);
                                    if (discountcoupon1 > 0) {} else {
                                        var discountcoupon1 = 0;
                                    }

                                    var www = (parseFloat(grandtotal) + parseFloat(insurance_premium) + luggagetotal1) - (discountpoints1 + discountcoupon1);
                                    $(".grandtotal1").text(site_currency + " " + www);
                                }
                            }, 'json');
                    }

                    function luggage_details(cur) {
                        var total_passanger_count = '1';
                        var trip_type = 'O';
                        var grandtotal = $('#grandtotal').val();
                        var discountpoints = $('#discountpoints').text();
                        var premium = 40;
                        var insurance_selected = $('#insurance_selected').text();
                        var extratotal = $('#extratotal').text();
                        var extra_total = parseFloat(extratotal);
                        if (extra_total > 0) {} else {
                            var extra_total = 0;
                        }


                        var premium = $('.insurance').text();
                        var site_currency = 'INR';
                        var site_currency_rate = '1.000';
                        var i;
                        var outwardluggage_data = new Array();
                        var returnluggage_data = new Array();
                        var outwardmeals_data = new Array();
                        var returnmeals_data = new Array();
                        for (i = 1; i <= total_passanger_count; i++) {
                            var ii = i - 1;
                            var outwardluggage = $('#outwardluggage-' + i).val();
                            outwardluggage_data[ii] = outwardluggage;
                            var outwardluggage_res = outwardluggage.split(",");
                            var outward_total = outwardluggage_res[3];
                            if (Math.round(outward_total * site_currency_rate) == 0 && outwardluggage_res[2] != 'No Luggage') {
                                $("#outward_bag_" + i).text("FREE");
                            } else {
                                $("#outward_bag_" + i).text("+ " + site_currency + " " + Math.round(outward_total * site_currency_rate));
                            }


                            var outwardmeals = $('#outwardmeals-' + i).val();
                            outwardmeals_data[ii] = outwardmeals;
                            if (trip_type == 'R') {
                                var ii = i - 1;
                                var returnluggage = $('#returnluggage-' + i).val();
                                returnluggage_data[ii] = returnluggage;
                                if (returnluggage != '' && typeof returnluggage !== 'undefined') {
                                    var returnluggagee = returnluggage.split(",");
                                    var return_total = returnluggagee[3];
                                    if (Math.round(return_total * site_currency_rate) == 0 && returnluggagee[2] != 'No Luggage') {
                                        $("#return_bag_" + i).text("FREE");
                                    } else {
                                        $("#return_bag_" + i).text("+ " + site_currency + " " + Math.round(return_total * site_currency_rate));
                                    }
                                }


                                var returnmeals = $('#returnmeals-' + i).val();
                                returnmeals_data[ii] = returnmeals;
                            }

                        }
                        $.post('https://travelfreebuy.com/en/flight/apt/travelfusion_luggage', {
                                'outwardluggage': outwardluggage_data,
                                'returnluggage': returnluggage_data,
                                'outwardmeals': outwardmeals_data,
                                'returnmeals': returnmeals_data,
                                'parent_pnr': '176433',
                                'cart_id': '56176'
                            },
                            function(res) {
                                if (res > 0) {
                                    var grandtotal = $('#grandtotal').val();
                                    $(".luggage_details").removeClass('hide');
                                    $('.luggagetotal').text(res);
                                    var discountpoints1 = parseFloat(discountpoints);
                                    if (discountpoints1 > 0) {} else {
                                        var discountpoints1 = 0;
                                    }

                                    var premium1 = parseFloat(premium);
                                    if (premium1 > 0 && insurance_selected == 'Yes') {} else {
                                        var premium1 = 0;
                                    }

                                    var www = (parseFloat(grandtotal) + premium1 + extra_total + parseFloat(res)) - discountpoints1;
                                    $(".grandtotal1").text(site_currency + " " + www);
                                    var outwardluggagee = outwardluggage.split(",");
                                    var outward_total = outwardluggagee[3];
                                    // $("#outward_bag").text("+ " + site_currency + " " + outward_total);
                                    if (trip_type == 'R') {
                                        var returnluggagee = returnluggage.split(",");
                                        var return_total = returnluggagee[3];
                                        // $("#return_bag").text("+ " + site_currency + " " + return_total);
                                    }

                                } else {
                                    var grandtotal = $('#grandtotal').val();
                                    $('.luggage_details').addClass('hide');
                                    var discountpoints1 = parseFloat(discountpoints);
                                    if (discountpoints1 > 0) {} else {
                                        var discountpoints1 = 0;
                                    }

                                    var premium1 = parseFloat(premium);
                                    if (premium1 > 0 && insurance_selected == 'Yes') {} else {
                                        var premium1 = 0;
                                    }

                                    $("#outward_bag").text("+ " + site_currency + " 0");
                                    $("#return_bag").text("+ " + site_currency + " 0");
                                    var www = (parseFloat(grandtotal) + premium1 + extra_total) - discountpoints1;
                                    $(".grandtotal1").text(site_currency + " " + www);
                                }

                            }, 'json');
                    }


                    function validateCoupon(cur) {
                        var coupon_code = $("input[type=text][name=coupon_code]").val();
                        var email = $("input[type=email][name=email]").val();
                        $(".coupon_code").val(coupon_code);
                        var grandtotal = $('#grandtotal').val();
                        var insurance = $('.insurance').text();
                        var insurance_selected = $('#insurance_selected').text();
                        $(".errorcoupon").text('');
                        var site_currency = 'INR';
                        var luggagetotal = $('#luggagetotal').text();
                        var luggagetotal1 = parseFloat(luggagetotal);
                        if (luggagetotal1 > 0) {} else {
                            var luggagetotal1 = 0;
                        }

                        $.post('https://localhost/discount/validateCoupon', {
                                'coupon_code': coupon_code,
                                'email': email,
                                'module': 'FLIGHT',
                                'cart_id': '56176',
                                'parent_pnr': '176433',
                                'site_currency': 'INR'
                            },
                            function(res) {
                                if (res.notapplicable == 1) {
                                    $(".coupon_details").addClass('hide');
                                    $("[name=applied_code]").val('');
                                    $(".errorcoupon").text('Invalid Coupon');
                                    $(".discountcoupontitle").text('');
                                    $(".discountcoupon").text('');
                                    $(".discountpointstitle").text('');
                                    $(".discountpoints").text('');
                                    var insurance1 = parseInt(insurance);
                                    if (insurance1 > 0 && insurance_selected == 'Yes') {} else {
                                        var insurance1 = 0;
                                    }
                                    var grandtotal1 = parseInt(grandtotal);
                                    $(".grandtotal1").text(site_currency + " " + (grandtotal1 + insurance1 + luggagetotal1));
                                } else {
                                    $(".coupon_details").removeClass('hide');
                                    $("[name=applied_code]").val(coupon_code);
                                    $("[name=dynamicvariable]").val(res.dynamicvariable);
                                    $(".errorcoupon").text(site_currency + " " + res.discount + ' will be deduct.');
                                    $(".discountcoupon").text(res.discount);
                                    var insurance1 = parseInt(insurance);
                                    if (insurance1 > 0 && insurance_selected == 'Yes') {} else {
                                        var insurance1 = 0;
                                    }
                                    var grandtotal1 = parseInt(grandtotal);
                                    var www = (grandtotal1 + insurance1 + luggagetotal1) - (res.discount);
                                    $(".grandtotal1").text(site_currency + " " + www);
                                }
                            }, 'json');
                    }



                    function usePoints(cur) {
                        var coupon_code = $("input[type=number][name=redeem_point]").val();
                        $(".coupon_code").val(coupon_code);
                        var grandtotal = $('#grandtotal').val();
                        var insurance = $('.insurance').text();
                        $(".errorcoupon").text('');
                        var site_currency = 'INR';
                        var luggagetotal = $('#luggagetotal').text();
                        var luggagetotal1 = parseFloat(luggagetotal);
                        if (luggagetotal1 > 0) {} else {
                            var luggagetotal1 = 0;
                        }

                        $.post('https://travelfreebuy.com/en/discount/validatePoints', {
                                'points': coupon_code,
                                'cart_id': '56176',
                                'module': 'FLIGHT',
                                'parent_pnr': '176433',
                                'site_currency': 'INR'
                            },
                            function(res) {
                                if (res.notapplicable == 1) {
                                    $(".coupon_details").addClass('hide');
                                    $("[name=applied_code]").val('');
                                    $(".errorcoupon").text('Invalid Coupon');
                                    $(".discountcoupontitle").text('');
                                    $(".discountcoupon").text('');
                                    $(".discountpointstitle").text('');
                                    $(".discountpoints").text('');
                                    var insurance1 = parseInt(insurance);
                                    if (insurance1 > 0) {} else {
                                        var insurance1 = 0;
                                    }
                                    var grandtotal1 = parseInt(grandtotal);
                                    $(".grandtotal1").text(site_currency + " " + (grandtotal1 + insurance1 + luggagetotal1));
                                } else {
                                    $(".coupon_details").removeClass('hide');
                                    $("[name=applied_code]").val(coupon_code);
                                    $("[name=dynamicvariable]").val(res.dynamicvariable);
                                    $(".errorcoupon").text(site_currency + " " + res.discount + ' will be deduct.');
                                    $(".discountcoupon").text(res.discount);
                                    var insurance1 = parseInt(insurance);
                                    if (insurance1 > 0) {} else {
                                        var insurance1 = 0;
                                    }
                                    var grandtotal1 = parseInt(grandtotal);
                                    var www = (grandtotal1 + insurance1 + luggagetotal1) - (res.discount);
                                    $(".grandtotal1").text(site_currency + " " + www);
                                }
                            }, 'json');
                    }




                    function extra_details(cur, type, flight, traveller, mealcode, mealCharge, personID, description) {
                        var total_passanger_count = '1';
                        var trip_type = 'O';
                        var grandtotal = $('#grandtotal').val();
                        var discountpoints = $('#discountpoints').text();
                        var premium = 40;
                        var insurance_selected = $('#insurance_selected').text();
                        var luggagetotal = $('#luggagetotal').text();
                        var luggagetotal1 = parseFloat(luggagetotal);
                        if (luggagetotal1 > 0) {} else {
                            var luggagetotal1 = 0;
                        }

                        var premium = $('.insurance').text();
                        var site_currency = 'INR';
                        var site_currency_rate = '1.000';
                        var api = 'Indigo';
                        var onward_count = 0;
                        var return_count = 0;
                        if (api == 'AirArabia') {
                            var onward_count = '1';
                            var return_count = '';
                        }

                        var i;
                        var outwardmeals_data = new Array();
                        var returnmeals_data = new Array();
                        var total_outwardcount = parseFloat(total_passanger_count);
                        var total_returncount = parseFloat(total_passanger_count);
                        if (type == 'outwardmeals') {

                            outwardmeals_data[0] = cur;
                            outwardmeals_data[1] = type;
                            outwardmeals_data[2] = traveller;
                            outwardmeals_data[3] = mealcode;
                            outwardmeals_data[4] = mealCharge;
                            outwardmeals_data[5] = flight;
                            outwardmeals_data[6] = personID;
                            outwardmeals_data[7] = description;
                            var outward_meal_Selected = 0
                            var selected_quantity = [];
                            $(".food_outward_" + outwardmeals_data[2]).each(function() {
                                selected_quantity.push($(this).val());
                            });
                            for (ik = 0; ik <= selected_quantity.length; ik++) {
                                if (selected_quantity[ik] > 0 && typeof selected_quantity[ik] !== 'undefined') {
                                    outward_meal_Selected += 1;
                                }
                            }

                            $("#choosen_omeal_" + outwardmeals_data[5] + outwardmeals_data[2]).text(outward_meal_Selected + ' Meal Selected');
                        } else {
                            returnmeals_data[0] = cur;
                            returnmeals_data[1] = type;
                            returnmeals_data[2] = traveller;
                            returnmeals_data[3] = mealcode;
                            returnmeals_data[4] = mealCharge;
                            returnmeals_data[5] = flight;
                            returnmeals_data[6] = personID;
                            returnmeals_data[7] = description;
                            var return_meal_Selected = 0
                            var selected_rquantity = [];
                            $(".food_return_" + returnmeals_data[2]).each(function() {
                                selected_rquantity.push($(this).val());
                            });
                            for (ik = 0; ik <= selected_rquantity.length; ik++) {
                                if (selected_rquantity[ik] > 0 && typeof selected_rquantity[ik] !== 'undefined') {
                                    return_meal_Selected += 1;
                                }
                            }

                            $("#choosen_rmeal_" + returnmeals_data[5] + returnmeals_data[2]).text(return_meal_Selected + ' Meal Selected');
                        }

                        $.post('https://travelfreebuy.com/en/flight/apt/seatmeal_Selection', {
                                'outwardmeals': outwardmeals_data,
                                'returnmeals': returnmeals_data,
                                'parent_pnr': '176433',
                                'cart_id': '56176'
                            },
                            function(res) {
                                if (res > 0) {
                                    $(".extra_details").removeClass('hide');
                                    $('.extratotal').text(res);
                                    var discountpoints1 = parseFloat(discountpoints);
                                    if (discountpoints1 > 0) {} else {
                                        var discountpoints1 = 0;
                                    }

                                    var premium1 = parseFloat(premium);
                                    if (premium1 > 0 && insurance_selected == 'Yes') {} else {
                                        var premium1 = 0;
                                    }

                                    var www = (parseFloat(grandtotal) + premium1 + luggagetotal1 + parseFloat(res)) - discountpoints1;
                                    $(".grandtotal1").text(site_currency + " " + www);
                                } else {
                                    $('.extra_details').addClass('hide');
                                    var discountpoints1 = parseFloat(discountpoints);
                                    if (discountpoints1 > 0) {} else {
                                        var discountpoints1 = 0;
                                    }

                                    var premium1 = parseFloat(premium);
                                    if (premium1 > 0 && insurance_selected == 'Yes') {} else {
                                        var premium1 = 0;
                                    }
                                    var www = (parseFloat(grandtotal) + premium1 + luggagetotal1) - discountpoints1;
                                    $(".grandtotal1").text(site_currency + " " + www);
                                }
                            }, 'json');
                    }
                </script>

                <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery.unveil.js"></script>
                <!-- 1112</section>  -->
                <!-- panel// -->

                <section class="panel panel-disable panel-booking" id="payment-block">
                    <header class="panel-heading">
                        <span class="num-step">3</span>
                        <h4 class="panel-title">Payment</h4>
                    </header>
                    <!-- ============== (payment) compact view ============== -->
                    <div class="wrap-disable compact-view" style="display: none">
                        <article class="blok-body">
                            <h2 class="text-center">Thank you for payment. </h2>
                        </article>
                    </div>
                    <!-- ============== (payment) compact view  .end// ============== -->

                    <!-- ============== (payment) full view ============== -->
                    <div class="wrap-active full-view" style="display: none" id="paymentsec">
                        <article class="panel-body">
                            <div class="row-sm">

                                <p class="alert alert-warning"> By completing this booking. I acknowledge and agree to the <a href="/en/booking-policy" target="_blank">booking policy</a>, the <a href="/en/privacy-policy" target="_blank">privacy policy</a> and the <a href="/en/terms-of-service" target="_blank">terms & conditions</a> that are applicable to this itinerary. </p>

                                <aside class="col-sm-3">
                                    <ul class="nav nav-payment-type">
                                        <li class=" active"><a href="#credit" data-toggle="tab" onclick="activepaymenttab(this);"> <i class="fa fa-credit-card"></i> Payment</a></li>

                                        <!-- <li class=" payby"><a href="#payby" data-toggle="tab" style="background-color: #f2f2f2;"> <img src="<?php echo base_url('assets/icons/flights_icon/payby_logo.png'); ?>"></a></li> -->
                                    </ul>
                                </aside><!-- col // -->
                                <div class="col-sm-9 tab-content">
                                    <article class="tab-pane border radius p20 mb15  in active" id="credit">
                                        <div class="row no-padding">
                                            <div class="col-md-12 col-lg-12 font12">
                                                <label class="checkbox-custom checkbox-custom-sm">
                                                    <input name="terms" type="checkbox" class="required" value="" required /><i></i>
                                                    <span>Yes, I accept the terms and conditions of the policy</span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php //echo"<pre>";print_r($this->session->search_details);
                                        $searchdata = $this->session->search_details;
                                        ?>
                                        <form name="booking" method="POST" action="<?php echo site_url() ?>razorpay/pay.php" id="continueform" data-parsley-validate>
                                            <input type="hidden" name="callBackId" value="<?php echo base64_encode('tbo'); ?>" />
                                            <input type="hidden" name="searchId" id="searchId" value="<?php echo $flight_result->search_id; ?>" />
                                            <input type="hidden" name="segmentkey" id="segmentkey" value="<?php echo $flight_result->segmentkey; ?>" />
                                            <input type="hidden" name="total_cost" value="<?php echo $total_cost; ?>" />
                                            <input type="hidden" name="amount" value="<?php echo $total_cost; ?>" />
                                            <input type="hidden" name="service_type" value="2" />
                                            <?php if ($flight_result->triptype == 'round' && $flight_result->isdomestic == 'true') { ?>
                                                <input type="hidden" name="searchId1" id="searchId1" value="<?php echo $flight_result_r->search_id; ?>" />
                                                <input type="hidden" name="segmentkey1" id="segmentkey1" value="<?php echo $flight_result_r->segmentkey; ?>" />
                                            <?php } ?>
                                            <input type="hidden" name="date" id="date" value="<?php echo date('Y-m-d'); ?>">
                                            <input type="hidden" name="user_email" id="user_email" value="<?php echo $searchdata['email']; ?>">
                                            <input type="hidden" name="phone" id="phone" value="<?php echo $searchdata['phone']; ?>">


                                            <div class="panel-footer text-right">
                                                <button type="submit" value="submit" id="traveler-submit-btn" class="btn btn-warning btn-lg"><span class="spin-loader hide"><i class="fa fa-spinner fa-spin"></i></span> Continue to Payment</button>
                                            </div>


                                            <div id="service_charge_rate" class="alert text-warning hide"><i class="fa fa-info-circle"></i> Amount of INR <span> </span> is added as a service charges for card payment booking.</div>
                                            <p style="font-weight:bold;font-size:14px;text-align:center;padding: 0px;" id="bookingfailed"></p>
                                            <br>

                                            <article class="well m0 p0">
                                                <div class="row-sm">
                                                    <aside class="col-sm-4">
                                                        <figure class="iconbox iconbox-center">
                                                            <span class="icon-shape icon-sm round"><i class="fa fa-lock  fa-lg"></i></span>
                                                            <div class="small text-wrap">
                                                                <strong>Trusted</strong>
                                                                <p>We do not store or view your card data.</p>
                                                            </div>
                                                        </figure>
                                                    </aside> <!-- col.// -->
                                                    <aside class="col-sm-4">
                                                        <figure class="iconbox iconbox-center">
                                                            <span class="icon-shape icon-sm round"><i class="fa fa-shield fa-lg"></i></span>
                                                            <div class="small text-wrap">
                                                                <strong>100% Secure</strong>
                                                                <p>We use 128-bit SSL encryption.</p>
                                                            </div>
                                                        </figure>
                                                    </aside> <!-- col.// -->
                                                    <aside class="col-sm-4">
                                                        <figure class="iconbox iconbox-center">
                                                            <span class="icon-shape icon-sm round"><i class="fa fa-credit-card  fa-lg"></i></span>
                                                            <div class="small text-wrap">
                                                                <strong>Various payment</strong>
                                                                <p>We accept all major credit and debit cards.</p>
                                                            </div>
                                                        </figure>
                                                    </aside> <!-- col.// -->
                                                </div> <!-- row.// -->
                                            </article> <!-- well.// -->
                                            <script type="text/javascript">
                                                $(function() {
                                                    /* json object contains
                                                     1) payOptType - Will contain payment options allocated to the merchant. Options may include Credit Card, Net Banking, Debit Card, Cash Cards or Mobile Payments.
                                                     2) cardType - Will contain card type allocated to the merchant. Options may include Credit Card, Net Banking, Debit Card, Cash Cards or Mobile Payments.
                                                     3) cardName - Will contain name of card. E.g. Visa, MasterCard, American Express or and bank name in case of Net banking. 
                                                     4) status - Will help in identifying the status of the payment mode. Options may include Active or Down.
                                                     5) dataAcceptedAt - It tell data accept at CCAvenue or Service provider
                                                     6)error -  This parameter will enable you to troubleshoot any configuration related issues. It will provide error description.
                                                     */
                                                    $('[data-toggle="popover"]').popover();
                                                    $(".payOption").click(function() {
                                                        var paymentOption = "";
                                                        paymentOption = $(this).val();
                                                        $("#card_type").val(paymentOption.replace("OPT", ""));
                                                    });

                                                });

                                                $(document).ready(function() {
                                                    // jQuery code

                                                    $('#customerData').validator({
                                                        disable: true,
                                                        focus: false,
                                                    }).on('submit', function(e) {
                                                        if (e.isDefaultPrevented()) {
                                                            // handle the invalid form...
                                                        } else {
                                                            return true;
                                                        }
                                                    });

                                                });
                                            </script>

                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('.cardNumberC').focusout(function() {
                                                        var c_length = $('.cardNumberC').val().length;
                                                        if (c_length > 0) {
                                                            if (!validAlgorithm) {
                                                                $("span.creditCardError").text("Please enter valid card number.");
                                                                $(".cardfield").hide();
                                                            }
                                                        }
                                                    });
                                                    $('.cardNumberC').bind("keydown", function(event) {
                                                        $('.cardNumberC').validateCreditCard(function(result) {
                                                            if (result.card_type != null) {
                                                                // $('.cardNumberC').removeClass("creditcard");
                                                                cardType = result.card_type.name;
                                                                cardLegnth = result.length_valid;
                                                                $("#card-code").text(cardType);
                                                                $('.cardNumberC').attr("maxlength", result.card_type.valid_length)
                                                                validAlgorithm = result.luhn_valid;
                                                                if ($('.cardNumberC').val().length == result.card_type.valid_length) {
                                                                    //alert(result.card_type.valid_length);
                                                                    if (!validAlgorithm) {
                                                                        $("span.creditCardError").text("Please enter valid card number.");
                                                                        $("#card-code").text('none');
                                                                        $(".cardfield").hide();
                                                                    } else {
                                                                        $("span.creditCardError").text("");
                                                                    }
                                                                }

                                                            } else {
                                                                cardType = "";
                                                                cardLegnth = "";
                                                                validAlgorithm = "";
                                                            }

                                                            if ($('.cardNumberC').val() == "") {
                                                                $("span.cards").find("span").each(function() {
                                                                    $(this).show();
                                                                });

                                                            } else {
                                                                switch (cardType) {
                                                                    case "MasterCard":
                                                                        $(".cvvnumber").attr("maxlength", "3");
                                                                        break;
                                                                    case "Visa":
                                                                        $(".cvvnumber").attr("maxlength", "3");
                                                                        break;

                                                                    case "Amex":
                                                                        $(".cvvnumber").attr("maxlength", "4");
                                                                        // show American Express icon
                                                                        break;
                                                                    case "JCB":
                                                                        $(".cvvnumber").attr("maxlength", "3");
                                                                        // show American Express icon
                                                                        break;
                                                                    case "Diners Club":
                                                                        $(".cvvnumber").attr("maxlength", "3");
                                                                        // show American Express icon
                                                                        break;
                                                                    case "Maestro":
                                                                        break;
                                                                    default:
                                                                        $("#card-code").text('none');
                                                                        $("img.selectCard").removeClass("cardshow");
                                                                }
                                                            }
                                                        });
                                                    });

                                                });

                                                function validCharacters(kbEvent) {
                                                    if (window.event) {
                                                        keyCode = kbEvent.keyCode;
                                                    } else {
                                                        keyCode = kbEvent.which;
                                                    }

                                                    var ch = String.fromCharCode(keyCode);
                                                    numcheck = /^[a-zA-Z ]*$/;
                                                    return numcheck.test(ch);

                                                }

                                                function validNo(input, kbEvent) {
                                                    var keyCode, keyChar;
                                                    keyCode = kbEvent.keyCode;
                                                    if (window.event)
                                                        keyCode = kbEvent.keyCode;
                                                    else
                                                        keyCode = kbEvent.which;
                                                    if (keyCode == null)
                                                        return true;
                                                    keyChar = String.fromCharCode(keyCode);
                                                    var charSet = "0123456789";
                                                    if (charSet.indexOf(keyChar) != -1)
                                                        return true;
                                                    if (keyCode == null || keyCode == 0 || keyCode == 8 || keyCode == 9 || keyCode == 13 || keyCode == 27)
                                                        return true;
                                                    return false;
                                                }
                                            </script>

                                            <script src="<?php echo base_url(); ?>public/assets/js/jquery.jcryption1.js"></script>
                                            <script src="<?php echo base_url(); ?>assets/js/ccavRequestHandler.js"></script>
                                            <script src="<?php echo base_url(); ?>assets/js/jquery.creditCardValidator.js"></script>
                                    </article><!--  tab-pane //  -->
                                    <article class="tab-pane well payby  fade" id="payby">
                                        <h5 class="title"><b>PayBy</b></h5><br>
                                        <form name="payment" method="POST" price="276" action="" onsubmit="document.getElementById('holdButton').disabled = true;document.getElementById('holdButton').value = 'Submitting, please wait...';">
                                            <input type="hidden" name="payment_method" value="HOLD">
                                            <input type="hidden" name="payment_type" value="PayBy">

                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <p>PayBy is a leading contactless and cashless mobile payment provider in UAE. PayBy is available for IOS and Android devices, and also integrated into ToTok and BOTIM.</p>
                                                    <b>To make the payment:</b>
                                                    <ul class="list-mobile list-bullet list-inline cfx">
                                                        <li>Scan the QR code</li>
                                                        <li>Confirm the amount</li>
                                                        <li>Make the payment</li>
                                                    </ul>
                                                    <p><b>Note:</b> The QR Code is valid upto 2 hours</p>
                                                </div>
                                                <div class="col-sm-5">
                                                    <p id='qr_code_img' style="text-align: right;"></p>
                                                </div>
                                                <hr>
                                                <p><br>
                                                    <button type="submit" class="btn btn-warning btn-lg pull-right holdButton hide" id="holdButton" onclick="animation()"><span class="spin-loader hide"><i class="fa fa-spinner fa-spin"></i></span>Reserve Now</button>
                                                </p>
                                            </div>
                                        </form>
                                    </article><!--  tab-pane //  -->

                                    <p class="wrap-secure text-center">
                                        <img src="<?php echo base_url(); ?>assets2/images/misc/secure-pay.png">
                                        <img src="<?php echo base_url(); ?>assets2/images/logos-payment/pay-visa.png">
                                        <img src="<?php echo base_url(); ?>assets2/images/logos-payment/pay-mastercard.png">
                                        <img src="<?php echo base_url(); ?>assets2/images/logos-payment/pay-american-ex.png">
                                    </p>

                                </div><!-- col // -->
                            </div> <!-- row// -->
                        </article> <!-- panel-body// -->
                    </div>
                    <!-- ============== (payment) full view .end// ============== -->

                    <script>
                        function animation() {
                            $(".spin-loader").removeClass("hide");
                        }

                        $(".nav-menu-cash > li").click(function() {
                            $(".nav-menu-cash > li").find('input[type="radio"]').removeAttr('checked');
                            $(this).find('input[type="radio"]').prop('checked', true);
                        });

                        $('input:radio[name="payment_type"]').change(
                            function() {
                                if ($(this).is(':checked') && $(this).val() == 'UAEExchange') {

                                    $(".notes").show();
                                    $(".cbranch").hide();
                                    $(".exchange_row").show();

                                    var finalgrandtotal = $('#finalgrandtotal').val();
                                    var exchangecharges = $('#exchangecharges').val();
                                    var site_currency = 'INR';

                                    var www = (parseFloat(finalgrandtotal) + parseFloat(exchangecharges));
                                    $(".finalgrandtotal1").text(site_currency + " " + www);
                                    $(".exchange_total").text(site_currency + " " + exchangecharges);

                                } else {
                                    $(".notes").hide();
                                    $(".exchange_row").hide();
                                    $(".cbranch").show();

                                    var finalgrandtotal = $('#finalgrandtotal').val();

                                    var site_currency = 'INR';

                                    var www = parseFloat(finalgrandtotal);
                                    $(".finalgrandtotal1").text(site_currency + " " + www);
                                }
                            });

                        function activepaymenttab(cur) {
                            $(".exchange_row").hide();
                            var finalgrandtotal = $('#finalgrandtotal').val();

                            var site_currency = 'INR';

                            var www = parseFloat(finalgrandtotal);
                            $(".finalgrandtotal1").text(site_currency + " " + www);
                        }

                        function check_exchange(cur) {

                            var payment_type_Value = $("input[name='payment_type']:checked").val();
                            if (payment_type_Value == 'UAEExchange') {
                                $(".exchange_row").show();
                                var finalgrandtotal = $('#finalgrandtotal').val();
                                var exchangecharges = $('#exchangecharges').val();
                                var site_currency = 'INR';

                                var www = (parseFloat(finalgrandtotal) + parseFloat(exchangecharges));
                                $(".finalgrandtotal1").text(site_currency + " " + www);
                            }

                        }
                    </script>

                </section> <!-- panel// -->

            </main><!-- col // -->
            <aside class="col-sm-3">



                <!-- <p class="alert alert-info alert-points"> <i class="material-icons">&#xE263;</i>  <span>Complete your order and earn 276 Points for a discount on a future purchase.</span></p> -->

                <article class="panel panel-default" id="sticker">
                    <header class="panel-heading">
                        <h4 class="panel-title">Fare Details </h4>
                    </header> <!-- panel-heading// -->
                    <div class="panel-body price-wrap">

                        <div class="price-passengers"><?php $passengers = $flight_result->adults + $flight_result->childs + $flight_result->infants; ?>
                            <p><strong>Passenger(s)</strong><span class="val"><?php echo $passengers; ?></span></p>
                        </div>

                        <p>Base fare<span class="val">INR <num id="basefare"class="count"><?php echo number_format(round($basefare)); ?></num></span></p>

                        <p>Taxes & Fees <span class="val">INR <num id="taxfee" class="count"><?php echo number_format(round($tax)); ?></num></span></p>

                        <p>Service Charge <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="We are constantly working on improving your booking experience and sourcing the best travel options. Our service fee helps us in providing you a seamless experience for all your travel booking needs."></i><span class="val">INR <num id="servicefee" class="count"><?php echo $flight_result->admin_markup; ?></num></span></p>

                        <p class="insurance_details hide">Insurance<span class="val">INR <num class="count insurance">
                                    40</num></span></p>
                        <p class="luggage_details hide">Extra Baggage<span class="val">INR <num class="count luggagetotal" id="luggagetotal">0</num></span></p>
                        <p class="extra_details hide">Meals<span class="val">INR <num class="count extratotal" id="extratotal">0</num></span></p>
                        <p class="coupon_details txt-green hide">Discount<span class="val txt-green">INR <num class="count discountcoupon txt-green" id="discountcoupon">0</num></span></p>
                        <hr>
                        <p class="total-wrap"> <strong class="h4">Total (incl. VAT) </strong><strong class="h4"><span class="val total-price-value grandtotal1">INR <num class="count" id="tot_amt"><?php echo number_format($total_amount); ?></num></span></strong><br />
                            <input type="hidden" name="tot_amount" id="tot_amount" value="<?php echo $flight_result->net_amount; ?>">
                            <input type="hidden" name="tot_amount2" id="tot_amount2" value="<?php echo $flight_result->net_amount; ?>">
                            <?php if ($nonrefundable == 1) { ?>
                                <small data-placement='bottom' class="txt-green  pull-right">Refundable </small>
                        </p>
                    <?php } else { ?>
                        <small data-placement='bottom' class="txt-red  pull-right">Non-Refundable </small></p>
                    <?php } ?>
                    <input type="hidden" id="grandtotal" value="276">
                    <span class="hide" id="insurance_selected">No</span>
                    </div> <!-- panel-body // -->
                    <div id="coupon-block">
                        <div class="coupon-wrap collapse couponbox" id="coupon">
                            <div class="block-coupon">
                                <article class="panel-tab-places">
                                    <ul class="nav nav-pills nav-justified">
                                        <li class="active"><a href="#place-nearby" data-toggle="pill"><b>Coupon</b></a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <br />
                                        <p class="text-center img-discount-wrap"><img src="<?php echo base_url('assets/icons/discount.png'); ?>"> </p>
                                        <div class="tab-pane fade in active" id="place-nearby">
                                            <div class="input-group" id="couponcode_box">

                                                <input type="text" name="coupon_code" id="user_promotional" placeholder="Enter your coupon code" required class="coupon_code form-control">
                                                <span class="input-group-btn">
                                                    <input class="btn btn-warning promo-btn" type="submit" value="Apply" />
                                                </span>
                                            </div>
                                        </div> <!-- tab-pane// -->


                                    </div> <!-- tab-content// -->
                                </article> <!-- panel-tabs -->

                                <p class="errorcoupon" style="text-align:center;font-weight: bold;"></p>
                            </div>
                        </div> <!-- coupon-wrap.// -->
                        <a href="#coupon" class="btn-coupon" aria-expanded="false" data-toggle="collapse"> I have a coupon <i class="fa fa-chevron-down" aria-hidden="true"></i> </a>
                    </div>
                </article> <!-- panel// -->

                <article class="panel panel-default">
                    <header class="panel-heading">
                        <h4 class="panel-title">Book via phone</h4>
                    </header> <!-- panel-heading// -->
                    <div class="panel-body">
                        <p>Request a call and book your trip over the phone</p>
                        <a class="btn btn-block btn-info" onclick="$(this).hide(); $('#callme').fadeIn();"> <i class="material-icons">&#xE61D;</i> Request a call</a>
                        <form style="display: none" role="form" name="callme" id="callme" data-toggle="validator">
                            <div class="input-group">
                                <input type="hidden" name="cart_id" value="56176">
                                <input type="text" name="phone" pattern="[0-9]+" minlength="8" maxlength="12" placeholder="Phone number" class="form-control" required data-error="Valid mobile number is required">
                                <span class="input-group-btn">
                                    <button class="btn btn-warning" type="submit" id="call_me">
                                        Call me
                                    </button>
                                </span>
                                <small class="help-block with-errors"></small>
                            </div>
                        </form>
                    </div> <!-- panel-body // -->
                </article> <!-- panel// -->


                <article class="panel panel-default">
                    <header class="panel-heading">
                        <h4 class="panel-title">Need a help?</h4>
                    </header> <!-- panel-heading// -->
                    <div class="panel-body">
                        <p>Got any questions or need some help? <br /> Our team is available <strong>24/7</strong> </p>
                        <p>Travelfreebuy</p>
                        <p> info@travelfreebuy.com</p>
                    </div> <!-- panel-body// -->
                </article> <!-- panel// -->


                <script type="text/javascript">
                    function request_a_call() {
                        $('#call_me').prop('disabled', true);
                        $.ajax({
                            type: 'POST',
                            url: 'https://travelfreebuy.com/discount/bookingViaMobile/',
                            data: $('form[name="callme"]').serializeArray(),
                            async: true,
                            dataType: 'json',
                            success: function(data) {
                                if (!$.isEmptyObject(data.sent) && data.sent == 'Yes') {
                                    show_footer_success('Thank You, Our representative will call you.');
                                } else { //Not valid or not applied                   
                                    show_footer_error('Sorry, Something went wrong.');
                                }
                            },
                            complete: function() {
                                $('#call_me').prop('disabled', false);
                            }
                        });
                    }


                    $(document).ready(function() {

                        $('#callme').validator({
                            disable: true,
                            focus: true,
                        }).on('submit', function(e) {
                            if (e.isDefaultPrevented()) {
                                // handle the invalid form...
                                return false;
                            } else {
                                // everything looks good!
                                request_a_call();
                                return false;
                            }
                        });

                    });
                    $("#travellerDetails2").click(function(e) {
                        e.preventDefault();
                        var datas = $('.form').serialize();
                        var url = "<?php echo base_url(); ?>flights/confirm_itinerary";
                        //console.log(datas);
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: $('.form').serialize(),
                            dataType: 'json',
                            cache: false,
                            success: function(data) {
                                console.log(data.name);
                                //$("#detailss").show();
                                $('#traveldetail_ans').css("display", "none");
                                $('#paymentsec').css("display", "block");
                                $('#traveller-block').addClass('panel-disable');
                                $('#traveller-block').removeClass('panel-active');
                                $('#payment-block').removeClass('panel-disable');
                                $('#payment-block').addClass('panel-active');
                                //    $('#hotel_results2').html(data);
                            }
                        });
                        return false;
                    });
                </script>
                <script>
                    $("#travellerDetails").click(function(e) {
                        e.preventDefault();
                        alert('trss');
                        var datas = $('.form').serialize();
                        //var val  = $("#txtEditor").Editor("getText");
                        //var page = "<?php echo $page ?>";
                        var url = "<?php echo base_url(); ?>flights/confirm_itinerary"
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: $('.form').serialize(),
                            dataType: 'json',
                            cache: false,
                            success: function(data) {
                                console.log(data.name);
                                //$("#detailss").show();
                                $('#answer').css("display", "none");
                                $('#hotel_results2').html(data);
                            }
                        });
                        return false;
                    });
                </script>

                <script>
                    //promo
                    $(".promo").click(function() {
                        //alert('123');
                        var promo_code = $(".promo:checked").val();
                        // alert(promo_code);
                        // e.preventDefault();
                        $('#user_promotional').val($(".promo:checked").val());

                    });
                    $('.promo-btn').click(function(e) {
                        e.preventDefault();
                        var promot = $('#user_promotional').val();
                        var tot_amnt = $('#tot_amount').val();
                        console.log(tot_amnt);
                        // alert($('#user_promotional').val());get_promotional_offer
                        // $('#user_promotional').val('');
                        var siteUrl = "<?php echo site_url(); ?>";
                        $.ajax({
                            url: siteUrl + 'flights/get_promotional_offer',
                            data: 'type=2&promo_code=' + $('#user_promotional').val() + '&searchId=' + $('#searchId').val() + '&segmentkey=' + $('#segmentkey').val() + '&date=' + $('#date').val() + '&searchId1=' + $('#searchId1').val() + '&segmentkey1=' + $('#segmentkey1').val() + '&tot_amount=' + tot_amnt,
                            dataType: 'json',
                            type: 'POST',
                            beforeSend: function() {
                                $('.show_offers').html('<div id="rules_loading" align="center"><img align="top" alt="loading.. Please wait.." src="https://sarvtoday.com/public/img/load.gif"></div>');

                            },
                            success: function(data) {
                                console.log(data); //alert(data.offer);alert(data.tot_amnt);alert(data.disc);
                                if (data.offer == 'Promotional Code is not valid') {
                                    $(".errorcoupon").html("Invalid Code");
                                } else {
                                    $("#coupon-block").hide();
                                    $(".coupon_details").removeClass('hide');
                                    $('.show_offers').html(data.offer);
                                    // $('#tot_amt').html(data.offer);
                                    // $('#tot_amount').val(data.tot_amnt);
                                    $('#finaltot,.finaltot').html(data.tot_amnt);
                                    $('#discountcoupon').html(data.disc);
                                    $('#user_promotionals').val(promot);
                                    // $(".displayNone").removeClass("displayNone").addClass("displayHidden");
                                    $('.promo-btn').prop("disabled", true);
                                    // var disc=data.disc;
                                    var net_amt = tot_amnt - data.disc;
                                    $('#tot_amt').html(net_amt);
                                    // console.log(test);
                                }
                            }
                            // $('#user_promotional').val('');
                        });

                    });
                </script>
                <script>
                    function show(ele) {
                        // GET THE SELECTED VALUE FROM <select> ELEMENT AND SHOW IT.
                        var refid = $(ele).attr('data-target');
                        var msg = document.getElementById('msg'+refid);
                        var val = ele.value;                        
                        var vals = val.split('@^@');
                        msg.setAttribute("data-price", vals[3]);
                        // alert(vals[2]);
                        msg.innerHTML = 'Quantity: <b>' + vals[2] + '' + 'Platter' + '</b> </br>' +
                            'Price: <b>' + 'Rs' + vals[3] + '</b>';

                        mealTotal()
                    }

                    function mealTotal(){
                            var arr = document.getElementsByClassName('mealprice');
                            var tot=0;
                            for(var i=0;i<arr.length;i++){
                                if(parseInt(arr[i].getAttribute("data-price")))
                                    tot += parseInt(arr[i].getAttribute("data-price"));
                            }
                            console.log(tot);
                            if(tot>0){
                                $('.extra_details').removeClass("hide");
                                $('#extratotal').text(tot);  
                                
                                updated_fare(); 
                            }                            
                        }
                </script>
                <script>
                    function show_baggage(ele) {
                        // GET THE SELECTED VALUE FROM <select> ELEMENT AND SHOW IT.
                        var refid = $(ele).attr('data-target');
                        var price = document.getElementById('price'+refid);
                        var val = ele.value;
                        var vals = val.split('@^@');
                        // alert(vals);
                        price.setAttribute("data-price", vals[2]);
                        price.innerHTML = 'Price: <b>' + vals[2] + '</b>';                        
                        
                        baggageTotal();
                    }
                    
                    function baggageTotal(){
                            var arr = document.getElementsByClassName('bagprice');
                            var tot=0;
                            for(var i=0;i<arr.length;i++){
                                if(parseInt(arr[i].getAttribute("data-price")))
                                    tot += parseInt(arr[i].getAttribute("data-price"));
                            }
                            console.log(tot);
                            if(tot>0){
                                $('.luggage_details').removeClass("hide");
                                $('#luggagetotal').text(tot);                               
                                updated_fare();
                            }                            
                        }

                </script>

                <script>
                    function updated_fare(){
                    var basefare = $('#basefare').text();
                    var taxfee = $('#taxfee').text();
                    var servicefee = $('#servicefee').text();
                    var luggagetotal = $('#luggagetotal').text();
                    var extratotal = $('#extratotal').text();
                    var discount = $('#discountcoupon').text();
                    var grand_total = parseInt(basefare)+parseInt(taxfee)+parseInt(servicefee)+parseInt(luggagetotal)
                    +parseInt(extratotal)-parseInt(discount);
                    $('#tot_amt').text(grand_total);
                    $('input[name="total_cost"]').val(grand_total);
                    $('input[name="amount"]').val(grand_total);
                    }

                </script>

                <!-- Modal FARE DETAIL -->
                <div id="modal_fare" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content" style="width:120%;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Fare Rules</h4>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Modal FARE DETAILS -->
            </aside><!-- col // -->
        </div><!--  row// -->
    </div> <!-- container // -->

    <br><br>
</section>
<!-- ========================= SECTION CONTENT END // ========================= -->

<?php $this->load->view('home/home_template/footer'); ?>