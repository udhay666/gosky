<?php (defined('BASEPATH')) or exit('No direct script access allowed'); ?>
<style>
    .travel-stops .end {
        right: 0;
        top: -6px;
        background-image: url("<?php echo base_url(); ?>/assets/images/icons/plane-listing.png");
        background-size: cover;
        width: 15px;
        height: 14px
    }
</style>
<?php if (!empty($result)) { ?>


    <?php for ($i = 0; $i < count($result); $i++) {
        // echo '<pre>';print_r($result);exit;
        $operating_airlinecode = explode(',', $result[$i]->operating_airlinecode);
        $operating_airlinename = explode(',', $result[$i]->operating_airlinename);
        $operating_flightno = explode(',', $result[$i]->operating_flightno);
        $operating_airportname_o = explode(',', $result[$i]->operating_airportname_o);
        $operating_fareclass = $result[$i]->operating_fareclass;
        $operating_deptime = explode(',', $result[$i]->operating_deptime);
        $deptime = explode('T', $operating_deptime[0]);
        $deptime['1'] = substr($deptime['1'], 0, -3);
        //  echo '<pre>';print_r($deptime['1']);exit;
        $operating_arritime = explode(',', $result[$i]->operating_arritime);
        $arrtime = explode('T', $operating_arritime[0]);
        $arrtime['1'] = substr($arrtime['1'], 0, -3);
        $operating_cityname_o = explode(',', $result[$i]->operating_cityname_o);
        $operating_cityname_d = explode(',', $result[$i]->operating_cityname_d);
        $operating_airportname_d = explode(',', $result[$i]->operating_airportname_d);
        $operating_terminal_o = explode(',', $result[$i]->operating_terminal_o);
        $operating_terminal_d = explode(',', $result[$i]->operating_terminal_d);
        $nonrefundable = $result[$i]->nonrefundable;
        $baggageinformation = $result[$i]->baggageinformation;
        //$duration = $dura = $result[$i]->duration;
        //$duration = explode(",",$duration);
        //$duration = $duration[0] * 60 + $duration[1];	
        $durationd = floor($result[$i]->duration / 60) . 'h:' . ($result[$i]->duration -   floor($result[$i]->duration / 60) * 60) . 'm';

        $segment_duration =  explode(',', $result[$i]->segment_duration);
        $ground_duration =  explode(',', $result[$i]->groundduration);

        $duration =    $result[$i]->duration;
        $origin = $result[$i]->origin;
        $Seats = $result[$i]->seats;
        //$stops = $result[$i]->stops;
        $stops = (count($operating_flightno) - 1);
        $destination = $result[$i]->destination;
        $search_id = $result[$i]->search_id;
        $segmentkey = $result[$i]->segmentkey;
        $basefare = $result[$i]->basefare;
        $tax = $result[$i]->tax + $result[$i]->admin_markup + $result[$i]->agent_markup + $result[$i]->payment_charge;
        $total_amount = $result[$i]->total_amount;
        $currency = $result[$i]->currency;
        $flightno = $result[$i]->operating_flightno;
        $stops2 = $result[$i]->stops2;
        $faretype = $result[$i]->faretype;

        $aircraftType = $result[$i]->aircraftType;
        $adt_cabinBaggage = $result[$i]->adt_cabinBaggage;
        // $adt_cabinBaggage = $result[$i]->baggageinformation;
        $adt_checkinBaggage = $result[$i]->adt_checkinBaggage;
        $CabinBaggage = $result[$i]->CabinBaggage;
        $session_data = $this->session->userdata('flight_search_data');
        $fromCity_arr = explode(',', $session_data['fromCity']);
        $toCity_arr = explode(',', $session_data['toCity']);
        
        $searcharray = unserialize($result[$i]->searcharray);
        $cabinClass = $searcharray['class'];
        switch ($cabinClass) {
            case '1':
                $cabinClass = "Economy";
                break;
            case '2':
                $cabinClass = "Premium";
                break;
            case '3':
                $cabinClass = "Business";
                break;
            
            default:
                # code...
                break;
        }
        // convert hours to min
        //$str_time = "23:12:95";
        $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $deptime[1] . ':00');
        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
        $timemin = floor(($hours * 3600 + $minutes * 60 + $seconds) / 60);

        $str_time1 = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $arrtime[1] . ':00');
        sscanf($str_time1, "%d:%d:%d", $hours1, $minutes1, $seconds1);
        $timemin1 = floor(($hours1 * 3600 + $minutes1 * 60 + $seconds1) / 60);

        $departCheck = explode(':', $deptime[1]);
        $departCheck1 = '0-6';
        if ($departCheck[0] >= 0 && $departCheck[0] < 6) {
            $departCheck1 = '0-6';
        } elseif ($departCheck[0] >= 6 && $departCheck[0] < 12) {
            $departCheck1 = '6-12';
        } elseif ($departCheck[0] >= 12 && $departCheck[0] < 18) {
            $departCheck1 = '12-18';
        } elseif ($departCheck[0] >= 18 && $departCheck[0] <= 23) {
            $departCheck1 = '18-0';
        }

        $arrivCheck = explode(':', $arrtime[1]);
        $arrivCheck1 = '0-6';
        if ($arrivCheck[0] >= 0 && $arrivCheck[0] < 6) {
            $arrivCheck1 = '0-6';
        } elseif ($arrivCheck[0] >= 6 && $arrivCheck[0] < 12) {
            $arrivCheck1 = '6-12';
        } elseif ($arrivCheck[0] >= 12 && $arrivCheck[0] < 18) {
            $arrivCheck1 = '12-18';
        } elseif ($arrivCheck[0] >= 18 && $arrivCheck[0] <= 23) {
            $arrivCheck1 = '18-0';
        }
        if ($stops == 0) {
            $route = "Direct";
        } else {
            $route = "Stop 1";
        }

        $isdomestic = $result[$i]->isdomestic;
        $session_id = $result[$i]->session_id;
        $uniquerefno = $result[$i]->uniquerefno;

        // echo '<pre>';print_r($session_data);exit;   
        // $deptime[1] = "05:30:12";Wednesday, 19 January 2022
        // echo $operating_deptime[0]."<br>";
        // echo date('l, d F Y', strtotime($operating_deptime[0])); exit;
    ?>
        <span class="tesla"></span>

        <div class="searchflight_box1" data-price="<?php echo round($total_amount); ?>">
            <div class="row border_card FlightInfoBox mb-3 mainbg_color card_style" id="<?php echo 'ticketid0123' . $i . $operating_airlinecode[0] . round($total_amount); ?>" data-airlinename="<?php echo $operating_airlinename[0]; ?>" data-airline="<?php echo $operating_airlinecode[0]; ?>" data-airlinecode="<?php echo $operating_airlinecode[0]; ?>" data-departCheck="<?php echo $departCheck1; ?>" data-arrivCheck="<?php echo $arrivCheck1; ?>" data-price="<?php echo round($total_amount); ?>" data-faretype="<?php echo $nonrefundable; ?>" data-stops="<?php echo $stops2; ?>" data-arivaltime="<?php echo $timemin1; ?>" data-departtime="<?php echo $timemin; ?>" data-flightduration="<?php echo $duration; ?>" data-layover="<?php echo $stops; ?>">
                <div class="col-sm-12 col-md-3">
                    <div class="">
                        <span class="logofx"><span><img src="<?php echo base_url() . 'public/AirlineLogo/' . $operating_airlinecode[0]; ?>.gif" alt="logo"></span>
                            <span class="flight_fx"><span class="flight_name"><?php echo $operating_airlinename[0]; ?></span><span class="flight_id"><?= $operating_airlinecode[0] . '-' . $operating_flightno[0]; ?></span></span></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5 res_margin">
                    <div class="res_jc">
                        <div class="flight-list-item-btm">
                            <ul>
                                <li><?php echo $deptime[1]; ?>
                                    <span><?php echo current($operating_cityname_o); ?></span>
                                </li>
                                <li>
                                    <h6 class="lay_time"><?php echo $durationd; ?></h6>
                                    <div class="flt_1stop">
                                        <span class="line"></span>
                                        <span><i class="fa fa-plane rotate_icon "></i></span>
                                    </div>
                                    <span class="text-center">Stop <?= $stops2 ?></span>
                                </li>
                                <li class="seat_fx">
                                    <div>
                                        <?php echo $arrtime[1]; ?>
                                        <span><?php echo end($operating_airportname_d);  ?></span>
                                    </div>
                                    <div class="seat_left_fx">
                                        <span><i class="fas fa-ski-lift"></i></span>
                                        <span><?= $Seats ?> left</span>
                                    </div>
                                </li>


                            </ul>



                        </div>
                    </div>
                </div>
                <div class="col-1">
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="price_btn_fx">
                        <h4 class="price">₹ <?php echo round($total_amount); ?></h4>
                        <span class="btn_det_fx">
                            <button class="btn-sm  btn_font">Book Now</button>

                            <a class="flt_det_font" onclick="openFlightDetails(event, '<?= $i ?>')" id="Flight_details<?=$i?>"> +flight Details</a>
                        </span>
                    </div>
                </div>
                <!-- fare details start -->
                <div class="row" id="Flight_details_Desc<?=$i?>" style="display: none;">
                    <div class="row">
                        <div class="tab">
                            <button class="tablinks active" onclick="openCity(event, 'flightd<?= $i ?>')">Fligh Details</button>
                            <button class="tablinks" onclick="openCity(event, 'fared<?= $i ?>')">Fare Details</button>
                            <button class="tablinks" onclick="openCity(event, 'fares<?= $i ?>')">Free Baggage</button>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="stop_details tabcontent1" id="flightd<?= $i ?>" style="display: block;">
                            <div class="flightchange yes">
                                <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { ?>
                                    <div class=" flight1">
                                        <div class="fc_name">
                                            <img src="<?php echo base_url() . 'public/AirlineLogo/' . $operating_airlinecode[$j]; ?>.gif">
                                            <span><?= $operating_airlinename[$j] ?>
                                                (<?= $operating_airlinecode[$j] . '-' . $operating_flightno[$j]; ?>)</span>
                                        </div>
                                        <div class="airport-part">
                                            <div class="airport-name">
                                                <?php $dep = explode('T', $operating_deptime[$j]);
                                                $dep[1] = substr($dep[1], 0, -3); ?>
                                                <h5><?= $dep[1] ?></h5>
                                                <h6><?php echo $operating_cityname_o[$j]; ?></h6>
                                            </div>
                                            <div class="airport-progress">

                                                <i class="fas fa-plane-departure"></i>
                                                <i class="fas fa-plane-arrival "></i>
                                                <span class="fliStopsDisc"></span>


                                            </div>
                                            <div class="airport-name arrival">
                                                <h5><?php
                                                    $arr = explode('T', $operating_arritime[$j]);
                                                    $arr[1] = substr($arr[1], 0, -3);
                                                    echo $arr[1]; ?>
                                                </h5>
                                                <h6><?php echo $operating_airportname_d[$j]; ?></h6>
                                            </div>
                                        </div>
                                        <div class="cabintype" style="width: 120px;">
                                            <p>Aircraft type : Airbus</p>
                                            <p>Cabin Class: <?= $cabinClass ?></p>
                                        </div>
                                    </div>

                                    <?php if ($j != (count($operating_airlinecode) - 1)) { ?>
                                        <div class="fc_layover">
                                            <small><i class="fa fa-clock"></i>Layover</small>
                                            <p><?php echo $this->Tbo_Model->journeyDuration(str_replace("T", " ", $operating_arritime[$j]), str_replace("T", " ", $operating_deptime[$j + 1])) . ' ' . 'in ' . $operating_cityname_o[1]; ?></p>
                                        </div>
                                                                        <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pt-4">
                        <div class="review_box tabcontent1" id="fared<?= $i ?>">
                            <div class="title-top">
                                <h5>Fare details</h5>
                            </div>
                            <div class="flight_detail">
                                <div class="summery_box">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td>Adults (3 X &#8377; 25801)</td>
                                                <td> &#8377; 2590</td>
                                            </tr>
                                            <tr>
                                                <td>Total taxes</td>
                                                <td> &#8377; 2995</td>
                                            </tr>
                                            <tr>
                                                <td>Insurance</td>
                                                <td> &#8377; 1995</td>
                                            </tr>
                                            <tr>
                                                <td>Convenience fee</td>
                                                <td> &#8377; 1888</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="grand_total">
                                        <h5>Grand total: <span> &#8377; 20500</span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pt-2">
                        <div class="review_box tabcontent1" id="fares<?= $i ?>">
                            <div class="title-top">
                                <h5>HYD <span><i class="fas fa-plane-arrival"></i></span> TRI</h5>
                            </div>
                            <div class="flight_detail">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="boxes">
                                            <h6>
                                                Airline Cancellation Fee</h6>
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr class="title">
                                                        <td>Duration*</td>
                                                        <td>Per Passenger</td>
                                                    </tr>
                                                    <tr>
                                                        <td>0 hour to 2 hours</td>
                                                        <td>Non-Refundable</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2 hours to 3 days before</td>
                                                        <td> ₹ 3500</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4 days and above</td>
                                                        <td> ₹ 3000</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="boxes">
                                            <h6>
                                                Airline Date Change Fee</h6>
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr class="title">
                                                        <td>Duration*</td>
                                                        <td>Per Passenger</td>
                                                    </tr>
                                                    <tr>
                                                        <td>0 hour to 2 hours</td>
                                                        <td>Non-Refundable</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2 hours to 3 days before</td>
                                                        <td> ₹ 3250</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4 days and above</td>
                                                        <td> ₹ 2750</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="boxes">
                                            <div class="faresummry_recomendation">
                                                We would recommend that you reschedule/cancel your tickets atleast 72 hours prior to the flight departure
                                            </div>
                                        </div>
                                        <div class="boxes">
                                            <h6>
                                                Gosky Service Fee **
                                            </h6>
                                            <h6>(charged per passenger in addition to airline fee as applicable)</h6>
                                            <table class="table table-borderless w-80">
                                                <tbody>

                                                    <tr>
                                                        <td>Cancellation service fee</td>
                                                        <td>₹ 400</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Reschedule service fee</td>
                                                        <td> ₹ 300</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="boxes">
                                            <div class="faresummry_recomendation">
                                                <span>* Prior to the date/time of departure.</span> <br>
                                                <span>**Please note: Yatra service fee is over and above the airline cancellation fee due to which refund type may vary.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- fare details end -->

            </div>
        </div>

<?php }
} ?>