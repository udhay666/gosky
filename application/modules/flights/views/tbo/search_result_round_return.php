<?php (defined('BASEPATH')) or exit('No direct script access allowed'); ?>
<?php if (!empty($result2)) {
    $result = $result2; //echo"<pre>";print_r($result1);exit;
?>

    <?php unset($result); //echo '<pre>';print_r($result);exit;
    $result = $result2;
    for ($i = 0; $i < count($result); $i++) {
        // echo '<pre>';print_r($result);exit;
        $operating_airlinecode = explode(',', $result[$i]->operating_airlinecode);
        $operating_airlinename = explode(',', $result[$i]->operating_airlinename);
        $operating_flightno = explode(',', $result[$i]->operating_flightno);
        $operating_airportname_o = explode(',', $result[$i]->operating_airportname_o);
        $operating_fareclass = $result[$i]->operating_fareclass;
        $operating_deptime = explode(',', $result[$i]->operating_deptime);
        $roperating_deptime = $result[$i]->operating_deptime;
        $deptime22 = explode('T', $operating_deptime[0]);
        $deptime22['1'] = substr($deptime22['1'], 0, -3);
        $stops2 = $result[$i]->stops2;
        //  echo '<pre>';print_r($deptime['1']);exit;
        $operating_arritime = explode(',', $result[$i]->operating_arritime);
        $arrtime22 = explode('T', $operating_arritime[0]);
        $arrtime22['1'] = substr($arrtime22['1'], 0, -3);

        // $arrtime['1']=substr($operating_arritime['1'], 0, -3);
        $operating_cityname_o = explode(',', $result[$i]->operating_cityname_o);
        $operating_cityname_d = explode(',', $result[$i]->operating_cityname_d);
        $operating_airportname_d = explode(',', $result[$i]->operating_airportname_d);
        $operating_terminal_o = explode(',', $result[$i]->operating_terminal_o);
        $operating_terminal_d = explode(',', $result[$i]->operating_terminal_d);
        $baggageinformation2 = explode(',', $result[$i]->baggageinformation);
        $nonrefundable = $result[$i]->nonrefundable;
        $baggageinformation = $result[$i]->baggageinformation;
        //$duration = $dura = $result[$i]->duration;
        //$duration = explode(",",$duration);
        //$duration = $duration[0] * 60 + $duration[1];	

        $duration =    $result[$i]->duration;
        $duration = explode(",", $duration);
        $durationd1 = floor($duration[0] / 60) . 'h:' . ($duration[0] -   floor($duration[0] / 60) * 60) . 'm';
        $durationd2 = floor($duration[1] / 60) . 'h:' . ($duration[1] -   floor($duration[1] / 60) * 60) . 'm';
        $origin = $result[$i]->origin;
        $seats = $result[$i]->seats;
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
        $flightno2 = explode(",", $flightno);
        $aircraftType = $result[$i]->aircraftType;
        $aircraftType = explode(",", $aircraftType);
        // $baggageinformation = $result[$i]->baggageinformation;
        $adt_cabinBaggage = $result[$i]->adt_cabinBaggage;
        $adt_cabinBaggage = explode(",", $adt_cabinBaggage);

        $adt_checkinBaggage = $result[$i]->adt_checkinBaggage;
        $adt_checkinBaggage = explode(",", $adt_checkinBaggage);
        $session_data = $this->session->userdata('flight_search_data');
        $fromCity_arr = explode(',', $session_data['fromCity']);
        $toCity_arr = explode(',', $session_data['toCity']);
        // convert hours to min
        //$str_time = "23:12:95";
        $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $deptime22[1] . ':00');
        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
        $timemin = floor(($hours * 3600 + $minutes * 60 + $seconds) / 60);

        $str_time1 = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $arrtime22[1] . ':00');
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

        // if ($stops==0) { $route = "Direct";}else{$route = "All";}

        // echo '<pre>';print_r($result1);exit;   
        // $deptime[1] = "05:30:12";Wednesday, 19 January 2022
        // echo $operating_deptime[0]."<br>";
        // echo date('l, d F Y', strtotime($operating_deptime[0])); exit;

        $duration3 =    $result[$i]->duration;
    ?>


        <div class="border_card mb-3 card_style r_card searchflight_box1 selectItem2" data-price="<?php echo round($total_amount); ?>">
            <label for="rRadio<?= $i ?>">
                <div class="r_flt_name " data-airlinename="<?php echo $operating_airlinename[0]; ?>" data-airline="<?php echo $operating_airlinecode[0]; ?>" data-airlinecode="<?php echo $operating_airlinecode[0]; ?>" data-departCheck="<?php echo $departCheck1; ?>" data-arrivCheck="<?php echo $arrivCheck1; ?>" data-price="<?php echo round($total_amount); ?>" data-faretype="<?php echo $nonrefundable; ?>" data-stops="<?php echo $stops2; ?>" data-arivaltime="<?php echo $timemin1; ?>" data-departtime="<?php echo $timemin; ?>" data-flightduration="<?php echo $duration3; ?>" data-layover="<?php echo $stops; ?>">

                    <span class="flight_fxR"><span class="flight_name"><?= $operating_airlinename[0]; ?></span><span class="flight_id"><?= $operating_airlinecode[0] . '-' . $operating_flightno[0]; ?></span></span>

                    <div class="seat_left_fx">
                        <span><img src="<?= base_url(); ?>assets_gosky/images/seat_airline.png" style="width:20px;"></span>
                        <span><?= $seats ?> left</span>
                    </div>
                </div>
                <div class="row  ">
                    <div class="col-sm-12 col-md-1">
                        <div class="">
                            <span class="logofx"><span><img src="<?php echo base_url() . 'public/AirlineLogo/' . $operating_airlinecode[0]; ?>.gif" alt="logo"></span>

                            </span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 res_margin">
                        <div class="res_jc">
                            <div class="flight-list-item-btm">
                                <ul class="item-btmR">
                                    <li><?php
                                        $dep = explode('T', $operating_deptime[0]);
                                        echo $dep[1] = substr($dep[1], 0, -3); ?>
                                        <span><?= current($operating_cityname_o); ?></span>
                                    </li>
                                    <li>
                                        <h6 class="lay_time"><?php echo $this->Tbo_Model->journeyDuration(str_replace("T", " ", $operating_deptime[0]), str_replace("T", " ", $operating_arritime[0])); ?></h6>
                                        <div class="flt_1stop">
                                            <span class="line"></span>
                                            <span><i class="fa fa-plane rotate_icon "></i></span>
                                        </div>
                                    </li>
                                    <li class="seat_fx">
                                        <div>
                                            <?php
                                            $arr = explode('T', $operating_arritime[0]);
                                            $arr[1] = substr($arr[1], 0, -3);
                                            echo $arr[1];
                                            ?>
                                            <span><?= end($operating_airportname_d); ?></span>
                                        </div>

                                    </li>


                                </ul>



                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 FlightInfoBox" data-price="<?=round($total_amount); ?>">
                        <input type="radio" id="rRadio<?= $i ?>" name="returnRadio" class="returnRadio" data-searchId="<?php echo $search_id; ?>" style="visibility:hidden;position:absolute">
                    </div>

                    <div class="col-lg-12 col-xl-3">
                        <div class="price_btn_fx_round">
                            <h4 class="price">₹ <?= round($total_amount); ?></h4>

                        </div>
                    </div>


                    <!--  -->
                </div>
            </label>
        </div>


<?php
    }
} ?>