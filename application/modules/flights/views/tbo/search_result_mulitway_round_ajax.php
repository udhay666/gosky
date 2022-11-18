<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<?php if (!empty($result1)) { $result = $result1;//echo"<pre>";print_r($result1);exit;?>


<?php for ($i = 0; $i < count($result); $i++) { 
    // echo '<pre>';print_r($result);exit;
    $operating_airlinecode = explode(',', $result[$i]->operating_airlinecode);
    $operating_airlinename = explode(',', $result[$i]->operating_airlinename);
    $operating_flightno = explode(',', $result[$i]->operating_flightno);
    $operating_airportname_o = explode(',', $result[$i]->operating_airportname_o);
    $operating_fareclass = $result[$i]->operating_fareclass;
    // $operating_deptime = explode(',', $result[$i]->operating_deptime);
    $operating_deptime = explode(',', $result[$i]->operating_deptime);
    $roperating_deptime = $result[$i]->operating_deptime;
    // $deptime = explode('T', $operating_deptime[0]);
    
    //  echo '<pre>';print_r($deptime['1']);exit;
    $operating_arritime = explode(',', $result[$i]->operating_arritime);
   
    // $arrtime['1']=substr($operating_arritime['1'], 0, -3);
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
    $adt_cabinBaggage = $result[$i]->adt_cabinBaggage;
    $adt_cabinBaggage = explode(",",$adt_cabinBaggage);

    $adt_checkinBaggage = $result[$i]->adt_checkinBaggage;
    $adt_checkinBaggage = explode(",",$adt_checkinBaggage);
    $session_data = $this->session->userdata('flight_search_data');
    $fromCity_arr = explode(',', $session_data['fromCity']);
    $toCity_arr = explode(',', $session_data['toCity']);
        // convert hours to min
        //$str_time = "23:12:95";
    $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $deptime[1].':00');
    sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
    $timemin = floor(($hours * 3600 + $minutes * 60 + $seconds) / 60);

    $str_time1 = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $arrtime[1].':00');
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
    if ($stops==0) { $route = "Direct";}else{$route = "All";}
        
    // echo '<pre>';print_r($result1);exit;   
    // $deptime[1] = "05:30:12";Wednesday, 19 January 2022
    // echo $operating_deptime[0]."<br>";
    // echo date('l, d F Y', strtotime($operating_deptime[0])); exit;

    
    ?> 
    <style>
        .travel-stops
    .end{right:0;top:-6px;background-image:url("../assets/images/icons/plane-listing.png");background-size:cover;width:15px;height:14px}
    </style>
<!--2nd Content-->
<section class="flight-elem-parent" data-price="<?php echo round($total_amount); ?>">
    <section class="item-result-wrap flight-elem" id="<?php echo 'ticketid0123'.$i.$operating_airlinecode[0].$total_amount; ?>" data-airlinecode="<?php echo $operating_airlinecode[0]; ?>" data-price="<?php echo round($total_amount); ?>" data-faretype="<?php echo $nonrefundable; ?>" data-stops="<?php echo $route; ?>" data-arivaltime="<?php echo $timemin1;//echo $arrtime[1]; ?>" data-departtime="<?php echo $timemin;//echo $deptime[1]; ?>" data-flightduration="<?php echo $duration; ?>" data-layover="<?php echo $stops; ?>" data-outwardnearby="" data-returnnearby="">  
    <article id="<?php echo round($total_amount); ?>" class="item-flight ">
        <p class="ticket-highlight-info hide" id="z-<?php echo round($total_amount); ?>"><i class="fa fa-check"></i> &nbsp; THIS IS THE CHEAPEST FLIGHT FOR THESE DATES!</p>
        <div class="row no-gutter">
            <main class="col-md-9 col-sm-12 item-flight-left">
            <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { ?>
                <div class="row row-trip no-gutter">
                    <aside class="col-md-2 col-sm-2">
                        <div class="info-airline ">
                        <img src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[$j]; ?>.gif" alt="flight logo">
                            <br>
                            <span class="text-dots" data-toggle="tooltip" title="" data-original-title="<?php echo $operating_airlinename[$j]; ?>"><?php echo $operating_airlinename[$j]; ?></span>
                            <br>
                        </div>
                    </aside> <!-- col // -->
                    <aside class="col-md-7 col-sm-6">
                        <div class="info-stops"> <?php $depdate = explode(' ',$operating_deptime[$j]);  $deptime=substr($depdate[1], 0, -3); //echo"<pre>";print_r($deptime);?>
                            <p class="place-wrap"><strong class="city" data-toggle="tooltip" title="" data-original-title="<?php echo $operating_cityname_o[$j]; ?>"><?php echo $operating_cityname_o[$j]; ?> </strong> <span class="code " data-toggle="tooltip" title="" data-original-title="">(<?php echo $operating_airportname_o[$j];?>)</span>
                                <br><?php echo date('dS M',strtotime($depdate[0]));?> <strong><?php echo date('H:i',strtotime($deptime)); ?></strong></p>
                            <p class="way-wrap">
                                <br>
                                <span class="travel-stops">
                                    <span class="start"></span>
                                    <span class="end"></span>
                                </span>
                                <span class="txt-stops txt-green" data-toggle="tooltip" data-placement="bottom" title="" data-original-title=""><?php echo $route; ?></span>
                            </p><?php $arrdate = explode(' ',$operating_arritime[$j]); $arrtime=substr($arrdate[1], 0, -3); //echo"<pre>";print_r($arrdate);?>
                            <p class="place-wrap"><span class="code " data-toggle="tooltip" title="" data-original-title="">(<?php echo $operating_airportname_d[$j];  ?>)</span> <strong class="city" data-toggle="tooltip" title="" data-original-title="<?php echo $operating_cityname_d[$j]; ?>"><?php echo $operating_cityname_d[$j]; ?></strong>  
                            <br> <strong><?php echo date('H:i',strtotime($arrtime)); ?></strong> <?php echo date('dS M',strtotime($arrdate[0]));?> 
                                <span data-toggle="tooltip" title="" class="badge" data-original-title="Arrival next day">+1</span>
                            </p>
                        </div>
                    </aside> <!-- col // -->
                    <aside class="col-md-3  col-sm-4">
                        <div class="info-duration">
                            <i class="material-icons"></i>
                            <span class="time"><?php echo floor($duration[$j] / 60).'h:'.($duration[$j] -   floor($duration[$j] / 60) * 60).'m'; ?></span>
                            <!-- <small class="title">Duration</small> -->
                        </div>
                        <div class="info-icons">
                        <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Baggage"><img src="<?php echo base_url('assets/icons/flights_icon/baggage.png');?>"></span>
                            <?php if($nonrefundable == 1){ ?>
                            <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Refundable"><img src="<?php echo base_url('assets/icons/flights_icon/refund.png');?>"></span>
                            <?php } ?>



                            <!-- <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Night fly"><img src="<?php echo base_url('assets/icons/flights_icon/redeye.png');?>"></span> -->

                        </div> <!-- info icons // -->
                    </aside> <!-- col // -->
                </div> <!-- row-trip //trip=0 -->
                <?php } ?>
               
            </main> <!-- col // -->
            <aside class="col-md-3 col-sm-12">
                <div class="info-buy">
                    <br>

                    <p class="txt-seat"> <?php echo $seats; ?> Seats left </p>


                    <p class="ticket-price-wrap">

                    <span class="price-new"><span class="currency"><?php echo $currency; ?></span> <?php echo $total_amount; ?></span></p>
                    <form name="<?php echo "flight_segmentform_".$i.$operating_airlinecode[0].$total_amount; ?>" id="<?php echo "flight_segmentform_".$i.$operating_airlinecode[0].$total_amount; ?>">
                        <input type="hidden" name="temp_d" value="" required="">
                        <input type="hidden" name="temp_r" value="" required="">
                        <input type="hidden" name="api" value="" required="">
                        <input type="hidden" name="temp_price" value="<?php echo $total_amount; ?>">
                        <p>

                        <?php $urlstring=base64_encode('tbo/'.$search_id.'/'.$segmentkey); ?>
                        </p><p><a href="<?= site_url() ?>flights/itinerary/<?= $urlstring ?>" class="btn btn-block btn-warning">Book Now</a></p>
                    </form>
                    <p><a onclick="ShowItinerary('<?php echo 'ticketid0123'.$i.$operating_airlinecode[0].$total_amount; ?>')" class="btn btn-block btn-info btn-details">Details <b class="caret"></b></a></p>
                </div>
            </aside> <!-- col // -->
        </div> <!-- row // -->
    </article> <!--  item-flight //  -->

    <div class="item-details" style="display: none">
        <nav class="heading-tab-details">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="<?php echo '#flight_menu-'.$i.$operating_airlinecode[0].$total_amount; ?>" aria-controls="flight" data-toggle="tab"><span class="hidden-xs">Flight details</span> <span class="visible-xs">Flight</span></a></li>
                <li><a href="#baggage_menu-<?php echo $i.$operating_airlinecode[0].$total_amount; ?>" aria-controls="fare" data-toggle="tab"><span class="hidden-xs">Baggage information</span> <span class="visible-xs">Baggage</span></a></li>
                <li><a href="#fare_menu-<?php echo $i.$operating_airlinecode[0].$total_amount; ?>" aria-controls="fare" data-toggle="tab"><span class="hidden-xs">Fare Details</span> <span class="visible-xs">Fare</span></a></li>
            </ul>
        </nav><!--  tab-heading//  -->

        <div class="tab-content">
        <section class="tab-pane fade in active" id="<?php echo 'flight_menu-'.$i.$operating_airlinecode[0].$total_amount; ?>">
                <article class="ticket-detail">
                    <header class="heading-ticket">
                        <i class="material-icons rotate-right"></i> <?php $depdate1 = explode(' ',$operating_deptime[0]); ?>
                        <span class="alert-stops"> <i style="color:gray;font-size:large;" class="material-icons"></i> &nbsp; <?php echo $route; ?></span>
                        <h4 class="title">Flight from <strong><?php echo $operating_cityname_o[0]; ?></strong> To <strong><?php echo $operating_cityname_d[0]; ?></strong> On <strong><?php echo date('l, d F Y', strtotime($depdate1[0])); ?></strong></h4>
                    </header>

                    <div class="row row-trip no-gutter">
                        <aside class="col-sm-2 col-xs-12">
                            <div class="info-airline">
                            <img src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[0]; ?>.gif" alt="flight logo">
                            <br> <?php echo $operating_airlinename[0]; ?> <br> <?php echo $operating_airlinecode[0]. '-' .$flightno2[0];?>
                                
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-7 col-xs-12">
                            <div class="info-flight-way"><?php $deptime1 = explode(' ',$operating_deptime[0]); $deptime1=substr($deptime1[1], 0, -3); ?>
                                <p class="place-wrap-from"><strong><?php echo $operating_cityname_o[0]; ?></strong> (<?php echo $operating_cityname_o[0]; ?>)
                                <br><?php echo date('dS M',strtotime($operating_deptime[0]));?> <strong><?php echo date('H:i',strtotime($deptime1)); ?></strong>
                                    <br>Delhi Indira Gandhi international <br>Terminal: <?php echo $operating_terminal_o[0]; ?></p>
                                <p class="way-wrap">
                                <span class="txt-time"><?php echo floor($duration[0] / 60).'h:'.($duration[0] -   floor($duration[0] / 60) * 60).'m'; ?></span>
                                    <span class="travel-stops">
                                        <span class="start"></span>
                                        <span class="end"></span>
                                    </span>
                                </p><?php $arrdate1 = explode(' ',$operating_arritime[0]); $arrtime1=substr($arrdate1[1], 0, -3); ?>
                                <p class="place-wrap-to">(<?php echo $operating_airportname_d[0];?>) <strong><?php echo $operating_cityname_d[0]; ?></strong>
                                    <br><strong><?php echo date('H:i',strtotime($arrtime1)); ?></strong> <?php echo date('dS M',strtotime($operating_arrtime[0]));?> <span data-toggle="tooltip" title="" class="badge" data-original-title="Arrival next day">+1</span>
                                    <br>Chhatrapati Shivaji International Airport <br>Terminal: <?php echo $operating_terminal_d[0]; ?></p>
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-3 col-xs-12 hidden-xs"> 
                            <ul class="list-default">
                                <li>Aircraft Type: <span>Airbus <?php echo $aircraftType[0]; ?></span></li>
                                <li>Booking class: <span>R</span></li>
                                <li>Cabin Class: <span> Economy</span></li>
                            </ul>
                        </aside><!-- col // -->
                    </div> <!-- row-trip // -->
                </article> <!-- ticket-detail// -->   
                
                <span class="divider-ticket"> </span>
                <article class="ticket-detail">
                    <header class="heading-ticket">
                        <i class="material-icons rotate-left"></i> 
                        <span class="alert-stops"><i style="color:gray;font-size:large;" class="material-icons"></i> &nbsp; <?php echo $route; ?></span>
                        <h4 class="title">Flight from <strong><?php echo $operating_cityname_o[1]; ?></strong> To <strong><?php echo $operating_cityname_d[1]; ?></strong> On <strong><?php echo date('l, d F Y', strtotime($operating_deptime[1])); ?></strong></h4>
                    </header>


                    <div class="row row-trip no-gutter">
                        <aside class="col-sm-2 col-xs-12">
                            <div class="info-airline">
                            <img src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[1]; ?>.gif" alt="flight logo">
                            <br> <?php echo $operating_airlinename[1]; ?> <br> <?php echo $operating_airlinecode[1]. '-' .$flightno2[1];?><br>
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-7 col-xs-12">
                            <div class="info-flight-way"><?php $deptime2 = explode(' ',$operating_deptime[1]); $deptime2=substr($deptime2[1], 0, -3); ?>
                                <p class="place-wrap-from"><strong><?php echo $operating_cityname_o[1]; ?></strong> (<?php echo $operating_cityname_o[1]; ?>)
                                <?php echo date('dS M',strtotime($operating_deptime[1]));?> <strong><?php echo date('H:i',strtotime($deptime2)); ?></strong>
                                    <br>Delhi Indira Gandhi international <br>Terminal: <?php echo $operating_terminal_o[1]; ?></p>
                                <p class="way-wrap">
                                    <span class="txt-time"><?php echo $durationd2; ?></span>
                                    <span class="travel-stops">
                                        <span class="start"></span>
                                        <span class="end"></span>
                                    </span>
                                </p><?php $arrdate2 = explode(' ',$operating_arritime[1]); $arrtime2=substr($arrdate2[1], 0, -3); ?>
                                <p class="place-wrap-to">(<?php echo $operating_airportname_d[1];?>) <strong><?php echo $operating_cityname_d[1]; ?></strong>
                                    <br><strong><?php echo date('H:i',strtotime($arrtime2)); ?></strong> <?php echo date('dS M',strtotime($operating_arrtime[1]));?> <span data-toggle="tooltip" title="" class="badge" data-original-title="Arrival next day">+1</span>
                                    <br>Chhatrapati Shivaji International Airport <br>Terminal: <?php echo $operating_terminal_d[1]; ?></p>
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-3 col-xs-12 hidden-xs"> 
                            <ul class="list-default">
                                <li>Aircraft Type: <span>Airbus <?php echo $aircraftType[1]; ?></span></li>
                                <li>Booking class: <span>V</span></li>

                                <li>Cabin Class: <span> Economy</span></li>
                            </ul>
                        </aside><!-- col // -->
                    </div> <!-- row-trip // -->





                </article> <!-- ticket-detail// -->
            </section> <!--  tab-pane //  -->
            
            <section class="tab-pane fade" id="fare_menu-<?php echo $i.$operating_airlinecode[0].$total_amount; ?>">
                <article class="ticket-detail panel-body">

                <table class="table-round">	
                        <tbody><tr class="bg-info">
                            <td>Fare Details     
                                <?php if($nonrefundable == 1){$refuntable = "Refundable";}else{$refuntable="NonRefundable";} ?>                           
                                <span class="label-green pull-right"><?php echo $refuntable; ?></span>

                            </td>
                            <td>Change flight</td>
                            <td>Cancel flight</td>
                        </tr>
                        <tr>
                            <td>
                                <p class="key-val"> <span>Base Fare:</span> <var><?php echo $currency.' '.$basefare; ?></var></p>
                                <p class="key-val"> <span>Taxes &amp; Fees <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip"
                                 title="" data-original-title="Taxes &amp; Fees include service fee, as well as third party taxes and surcharges such as airport tax,
                                 fuel surcharges, and airline fees. For more info, please view our FAQs"></i>:</span> <var><?php echo $currency.' '.$tax; ?></var></p>
                                <p class="key-val"> <span>Total (incl. VAT):</span> <var><?php echo $currency.' '.$total_amount; ?></var></p>

                            </td>
                            <td>
                                <p class="key-val"> <span>Airlines charges <small class="change_penalty_06E2137295" style="color: red;"></small>:</span> <var class="change_06E2137295">INR 0</var></p>
                                <p class="key-val"> <span>Other charges:</span> <var> INR 0</var></p>							  
                            </td>
                            <td>
                                <p class="key-val"> <span>Airlines charges <small class="cancel_penalty_06E2137295" style="color: red;"></small>:</span> <var class="cancel_06E2137295">INR 0</var></p>
                                <p class="key-val"> <span> Other charges:</span> <var>INR 0</var></p>							   
                            </td>
                        </tr>
                    </tbody></table>

                    <p class="alert alert-warning">Note: The airline fee may, at times, be calculated on a per-flight basis. Cancellation/Flight change charges are indicative. Airlines stop accepting cancellation/change requests 4 - 72 hours before departure of the flight, depending on the airline. 
Change and refund fees and charges may change anytime and the price shown is not the final price as the airline has the right to change it anytime.</p>
                    <p class="alert alert-info">Note: travelkitb2b.com applies VAT as per the UAE law. For more info, please view our <a href="/en/faq" target="_blank">FAQs</a></p>
                </article> <!-- ticket-detail// -->
            </section> <!--  tab-pane //  -->



            <section class="tab-pane fade" id="baggage_menu-<?php echo $i.$operating_airlinecode[0].$total_amount; ?>">
                <article class="ticket-detail">
                <header class="heading-ticket">
                        <i class="material-icons rotate-right"></i> 
                        <span class="alert-stops"> <span class="fa fa-clock-o fa-lg"></span> &nbsp; <?php echo $route; ?></span>
                        <h4 class="title">Flight from <strong><?php echo $operating_cityname_o[0]; ?></strong> To <strong><?php echo $operating_cityname_d[0]; ?></strong> On <strong><?php echo date('l, d F Y', strtotime($operating_deptime[0])); ?></strong></h4>
                    </header>

                    <table class="table table-baggage">
                        <tbody><tr>
                            <td class="info-airline"> <img src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[0]; ?>.gif" alt="flight logo"> <br><small><?php echo $operating_airlinename[0]; ?></small></td>

                            <td width="400"><p><strong class="text-primary">Carry-on:</strong> <?php echo $adt_cabinBaggage[0]; ?>/person                                </p>
                                <p><strong class="text-primary">Check-in:</strong><span class="outward_baggage_06E2137295">
                                        <?php if(!empty($adt_checkinBaggage[0])){echo $adt_checkinBaggage[0];}else{
                                        echo "Sorry! Baggage information will be available at the next step";   } ?>                            
                                    </span>
                                </p>
                            </td>
                            <td>  
                                <p class="txt-green">Free</p>
                                <p class="txt-green">Free</p> 
                            </td>
                        </tr>
                    </tbody></table>

                    <header class="heading-ticket">
                        <i class="material-icons rotate-left"></i> 
                        <span class="alert-stops"><span class="fa fa-clock-o fa-lg"></span> &nbsp; <?php echo $route; ?></span>
                        <h4 class="title">Flight from <strong><?php echo $operating_cityname_o[1]; ?></strong> To <strong><?php echo $operating_cityname_d[1]; ?></strong> On <strong><?php echo date('l, d F Y', strtotime($operating_deptime[1])); ?></strong></h4>
                        
                    </header>

                    <table class="table-baggage">
                        <tbody><tr>
                        <td class="info-airline"> <img src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[1]; ?>.gif" alt="flight logo"> <br><small><?php echo $operating_airlinename[1]; ?></small></td>
                            <td width="400"><p><strong class="text-primary">Carry-on:</strong> <?php echo $adt_cabinBaggage[1]; ?>/person                                </p>
                                <!-- <p><strong class="text-primary">Carry-on:</strong> 7 kg/person</p> -->                                
                                <p><strong class="text-primary">Check-in:</strong><span class="return_baggage_100SG8157591">
                                <?php if(!empty($adt_checkinBaggage[1])){echo $adt_checkinBaggage[1];}else{
                                        echo "Sorry! Baggage information will be available at the next step";   } ?>                            
                                    </span>                                   

                                    </span>
                                </p>
                            </td>
                            <td>  
                                <p class="txt-green">Free</p>
                                <p class="txt-green">Free</p> 
                            </td>
                        </tr>
                    </tbody></table>
                    
                    <?php if(empty($adt_checkinBaggage[1])){ ?>
                    <span class="text-center col-sm-12 hide" id="pieces_baggage_icon_06E2137295"><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i></span>
                    <p class="alert alert-warning m15 hide" id="pieces_baggage_06E2137295" style="text-align:center;"> Sorry! Baggage information will be available at the next step.  </p>
                        <?php }?>
                </article> <!-- ticket-detail// -->
            </section> <!--  tab-pane //  -->



        </div> <!-- tab-content // -->	
    </div> <!-- item-details-wrap // -->
</section> <!-- ====== item-result-wrap ====== // -->    </section>
                    <!--2nd Content end-->
                </div>
                <!--Result Content end-->
                
                
                
                
                
               

                <div class="clearfix"></div>



                <div class="loader3"></div>
                <!-- FLIGHT TICKET-->
                <!-- Normal trip-->
                <div id="flights" class="flights">                                
                    <!-- Flights Listing-->
                </div>                
                <!-- Normal trip End-->
                <div class="clearfix"></div>
            </main><!-- col // -->
        </div><!--  row// -->
    </div> <!-- container // -->
    <br><br>
</section>
<!-- ========================= SECTION CONTENT END // ========================= -->



<style>
    .dot {
        height: 12px;
        width: 12px;
        background-color: rgba(255, 255, 255, 0.75);
        border-radius: 50%;
        display: inline-block;
    }
</style>

<!--<p class="alert alert-danger  hide" id="error_footer"> Here i am today </p>-->
<a href="#top" class="topHome"><i class="fa fa-chevron-up fa-2x"></i></a>

<div id="overlay" style="display: none"></div>

<!--Javascripts Loading-->
<?php } ?>
<?php } ?>