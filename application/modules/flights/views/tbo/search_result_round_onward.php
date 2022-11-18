<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<?php if (!empty($result1)) { $result = $result1;//echo"<pre>";print_r($result1);exit;?>


<?php for ($i = 0; $i < count($result); $i++) { 
    // echo '<pre>';print_r($result);exit;
    $operating_airlinecode = explode(',', $result[$i]->operating_airlinecode);
    $operating_airlinename = explode(',', $result[$i]->operating_airlinename);
    $operating_flightno = explode(',', $result[$i]->operating_flightno);
    $operating_airportname_o = explode(',', $result[$i]->operating_airportname_o);
    $operating_fareclass = $result[$i]->operating_fareclass;
    $operating_deptime = explode(',', $result[$i]->operating_deptime);
    $roperating_deptime = $result[$i]->operating_deptime;
    $deptime22 = explode('T', $operating_deptime[0]);
    $deptime22['1']=substr($deptime22['1'], 0, -3);
    $stops2 = $result[$i]->stops2;
    //  echo '<pre>';print_r($deptime['1']);exit;
    $operating_arritime = explode(',', $result[$i]->operating_arritime);
    $arrtime22 = explode('T', $operating_arritime[0]);
    $arrtime22['1']=substr($arrtime22['1'], 0, -3);
   
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
    
    $duration=	$result[$i]->duration;	
    $duration = explode(",",$duration);	
    $durationd1 =floor($duration[0] / 60).'h:'.($duration[0] -   floor($duration[0] / 60) * 60).'m';
    $durationd2 =floor($duration[1] / 60).'h:'.($duration[1] -   floor($duration[1] / 60) * 60).'m';
    $origin = $result[$i]->origin;
    $seats = $result[$i]->seats;
        //$stops = $result[$i]->stops;
    $stops = (count($operating_flightno)-1);
    $destination = $result[$i]->destination;
    $search_id = $result[$i]->search_id;
    $segmentkey = $result[$i]->segmentkey;
    $basefare = $result[$i]->basefare;
    $tax = $result[$i]->tax+$result[$i]->admin_markup+$result[$i]->agent_markup+$result[$i]->payment_charge;
    $total_amount = $result[$i]->total_amount;
    $currency = $result[$i]->currency;
    $flightno = $result[$i]->operating_flightno;
    $flightno2 = explode(",",$flightno);	
    $aircraftType = $result[$i]->aircraftType;
    $aircraftType = explode(",",$aircraftType);
    // $baggageinformation = $result[$i]->baggageinformation;
    $adt_cabinBaggage = $result[$i]->adt_cabinBaggage;
    $adt_cabinBaggage = explode(",",$adt_cabinBaggage);

    $adt_checkinBaggage = $result[$i]->adt_checkinBaggage;
    $adt_checkinBaggage = explode(",",$adt_checkinBaggage);
    $session_data = $this->session->userdata('flight_search_data');
    $fromCity_arr = explode(',', $session_data['fromCity']);
    $toCity_arr = explode(',', $session_data['toCity']);
        // convert hours to min
        //$str_time = "23:12:95";
    $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $deptime22[1].':00');
    sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
    $timemin = floor(($hours * 3600 + $minutes * 60 + $seconds) / 60);

    $str_time1 = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $arrtime22[1].':00');
    sscanf($str_time1, "%d:%d:%d", $hours1, $minutes1, $seconds1);
    $timemin1 = floor(($hours1 * 3600 + $minutes1 * 60 + $seconds1) / 60);
    
    $departCheck = explode(':', $deptime[1]);
    $departCheck1 = '0-6';
    if($departCheck[0] >= 0 && $departCheck[0] < 6){
        $departCheck1 = '0-6';
    }elseif($departCheck[0] >= 6 && $departCheck[0] < 12 ){
        $departCheck1 = '6-12';
    }elseif($departCheck[0] >= 12 && $departCheck[0] < 18 ){
        $departCheck1 = '12-18';
    }elseif($departCheck[0] >= 18 && $departCheck[0] <= 23 ){
        $departCheck1 = '18-0';
    }

    $arrivCheck = explode(':', $arrtime[1]);
    $arrivCheck1 = '0-6';
    if($arrivCheck[0] >= 0 && $arrivCheck[0] < 6){
        $arrivCheck1 = '0-6';
    }elseif($arrivCheck[0] >= 6 && $arrivCheck[0] < 12 ){
        $arrivCheck1 = '6-12';
    }elseif($arrivCheck[0] >= 12 && $arrivCheck[0] < 18 ){
        $arrivCheck1 = '12-18';
    }elseif($arrivCheck[0] >= 18 && $arrivCheck[0] <= 23 ){
        $arrivCheck1 = '18-0';
    }

    // if ($stops==0) { $route = "Direct";}else{$route = "All";}
        
    // echo '<pre>';print_r($result1);exit;   
    // $deptime[1] = "05:30:12";Wednesday, 19 January 2022
    // echo $operating_deptime[0]."<br>";
    // echo date('l, d F Y', strtotime($operating_deptime[0])); exit;

    $duration3=	$result[$i]->duration;	
    ?> 

<section class="flight-elem-parent searchflight_box1 selectItem" data-price="<?php echo round($total_amount); ?>">
<label for="oRadio<?=$i?>">
        <section class="item-result-wrap flight-elem FlightInfoBox" id="<?php echo 'ticketid0123'.$i.$operating_airlinecode[0].round($total_amount); ?>" data-airlinename="<?php echo $operating_airlinename[0]; ?>" data-airline="<?php echo $operating_airlinecode[0]; ?>" 
            data-airlinecode="<?php echo $operating_airlinecode[0]; ?>" data-departCheck="<?php echo $departCheck1; ?>" data-arrivCheck="<?php echo $arrivCheck1; ?>" data-price="<?php echo round($total_amount); ?>" data-faretype="<?php echo $nonrefundable; ?>" data-stops="<?php echo $stops2; ?>" data-arivaltime="<?php echo $timemin1;//echo $arrtime[1]; ?>" data-departtime="<?php echo $timemin;//echo $deptime[1]; ?>" data-flightduration="<?php echo $duration3; ?>" data-layover="<?php echo $stops; ?>" data-outwardnearby="">
            <article id="<?php echo round($total_amount); ?>" class="item-flight_r ">
                <p class="ticket-highlight-info hide" id="z-<?php echo round($total_amount); ?>"><i class="fa fa-check"></i> &nbsp; THIS IS THE CHEAPEST FLIGHT FOR THESE DATES!</p>
               
                    <main class="main-onward">
                                                <div class="row row-trip no-gutter res_dis_col_6_fx">
                            <aside class="col-md-2 col-sm-2">
                                <div class="info-airline ">
                                <img class="flight_logo" src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[0]; ?>.gif" alt="flight logo">
                                    <br>
                                    <span class="text-dots" data-toggle="tooltip" title="" data-original-title="<?php echo $operating_airlinename[0]; ?>"><?php echo $operating_airlinename[0]; ?></span>
                                    <br>
                                </div>
                            </aside> <!-- col // -->
                            <aside class="col-md-7 col-sm-6 res_width">
                                <div class="info-stops"> 
                                    <p class="place-wrap"><strong class="city" data-toggle="tooltip" title="" data-original-title="<?php echo current($operating_cityname_o); ?>"><?php echo current($operating_cityname_o); ?> </strong> <span class="code " data-toggle="tooltip" title="" data-original-title="">(<?php echo current($operating_airportname_o); ?>)</span>
                                        <br><span class="res_d_none"> <?php 
                                        $dep = explode('T', $operating_deptime[0]); $dep[1] = substr($dep[1], 0, -3); echo date('dS M',strtotime($dep[0]));?> </span><strong class="res_d_none"> <?php //echo date('H:i',strtotime($deptime[1]));
                                
                                        // $dep = explode('T', $operating_deptime[0]);
                                        // $dep[1] = substr($dep[1], 0, -3);
                                        echo $dep[1];                                        
                                        ?>
                                        </strong></p>
                                    <p class="way-wrap">
                                        <br>
                                        <span class="travel-stops">
                                            <span class="start"></span>
                                            <span class="end"></span>
                                        </span>
                                        <span class="txt-stops txt-green" data-toggle="tooltip" data-placement="bottom" title="" data-original-title=""><?php if($stops==0){echo "Direct"; }else{echo "Stop:".$stops;} ?></span>

                                        
                                       <span class="all_hr_fx"><i class="material-icons"></i>
                                        <span class="txt-stops txt-green" data-toggle="tooltip" data-placement="bottom" title="" data-original-title=""><?php echo $this->Tbo_Model->journeyDuration(str_replace("T", " ", $operating_deptime[0]),str_replace("T", " ", $operating_arritime[0])); ?></span>
                                       </span>
                                    </p>
                                    <p class="place-wrap">
                                        
                                        <span class="city_fx">
                                        <span class="code " data-toggle="tooltip" title="" data-original-title="">(<?php echo end($operating_airportname_d);  ?>)</span> <strong class="" data-toggle="tooltip" title="" data-original-title="<?php echo $operating_cityname_d[0]; ?>"><?php echo end($operating_cityname_d); ?></strong> 
                                         
                                     <strong class="res_d_none">
                                    <?php
                                    $arr = explode('T', $operating_arritime[0]); $arr[1] = substr($arr[1], 0, -3);
                                    echo $arr[1];
                                    ?></strong> 
                                   <span class="res_d_none"> <?php echo date('dS M',strtotime($arr[0]));?> </span> 
                                        <!-- <span data-toggle="tooltip" title="" class="badge" data-original-title="Arrival next day">+1</span> -->
                                        </span>
                                    </p>
                                </div>
                            </aside> <!-- col // -->
                            <aside class="col-md-3 col-sm-4">
                                <div class="info-duration">
                                    <span class="ruppe"> ₹ <?= round($total_amount);?></span>
                                    <!-- <small class="title">Duration</small> -->
                                </div>
                                <div class="info-icons res_d_none">
                                    <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Baggage"><img src="<?php echo base_url('assets/icons/flights_icon/baggage.png');?>"></span>
                                <?php if($nonrefundable == 1){ ?>
                                    <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Refundable"><img src="<?php echo base_url('assets/icons/flights_icon/refund.png');?>"></span>
                                    <?php } ?>
                                    


        <input type="radio" id="oRadio<?=$i?>" name="selectflight" class="onwardRadio" name="onwardRadio" data-searchId="<?php echo $search_id; ?>" style="visibility:hidden;position:absolute">
                                    <!-- <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Night fly"><img src="http://localhost/travelfreebuy.com/assets/icons/flights_icon/redeye.png"></span> -->

                                </div> <!-- info icons // -->
                            </aside> <!-- col // -->
                        </div> <!-- row-trip //trip=0 -->

                    </main> <!-- col // -->

                     <!-- col // -->
              <!-- row // -->
            </article> <!--  item-flight //  -->

            
        </section> <!-- ====== item-result-wrap ====== // -->    
        </label>
    </section>

    <?php  
    }
}?>