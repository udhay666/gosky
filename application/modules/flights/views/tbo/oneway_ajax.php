<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<style>
        .travel-stops
    .end{right:0;top:-6px;background-image:url("<?php echo base_url(); ?>/assets/images/icons/plane-listing.png");background-size:cover;width:15px;height:14px}
    </style>
<?php if (!empty($result)) { ?>


<?php for ($i = 0; $i < count($result); $i++) { 
    // echo '<pre>';print_r($result);exit;
    $operating_airlinecode = explode(',', $result[$i]->operating_airlinecode);
    $operating_airlinename = explode(',', $result[$i]->operating_airlinename);
    $operating_flightno = explode(',', $result[$i]->operating_flightno);
    $operating_airportname_o = explode(',', $result[$i]->operating_airportname_o);
    $operating_fareclass = $result[$i]->operating_fareclass;
    // $operating_deptime = explode(',', $result[$i]->operating_deptime);
    $operating_deptime = explode(',', $result[$i]->operating_deptime);
    $deptime = explode('T', $operating_deptime[0]);
    $deptime['1']=substr($deptime['1'], 0, -3);
    //  echo '<pre>';print_r($deptime['1']);exit;
    $operating_arritime = explode(',', $result[$i]->operating_arritime);
    $arrtime = explode('T', $operating_arritime[0]);
    $arrtime['1']=substr($arrtime['1'], 0, -3);
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
    $durationd =floor($result[$i]->duration / 60).'h:'.($result[$i]->duration -   floor($result[$i]->duration / 60) * 60).'m';

    $segment_duration =  explode(',', $result[$i]->segment_duration);
    $ground_duration =  explode(',', $result[$i]->groundduration);

    $duration=	$result[$i]->duration;				
    $origin = $result[$i]->origin;
    $Seats = $result[$i]->seats;
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
    $aircraftType = $result[$i]->aircraftType;
    $adt_cabinBaggage = $result[$i]->adt_cabinBaggage;
    // $adt_cabinBaggage = $result[$i]->baggageinformation;
    $adt_checkinBaggage = $result[$i]->adt_checkinBaggage;
    $CabinBaggage = $result[$i]->CabinBaggage;
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

    $isdomestic = $result[$i]->isdomestic;
    // echo '<pre>';print_r($result[$i]);exit;   
    // $deptime[1] = "05:30:12";Wednesday, 19 January 2022
    // echo $operating_deptime[0]."<br>";
    // echo date('l, d F Y', strtotime($operating_deptime[0])); exit;
    ?> 

<section class="flight-elem-parent" data-price="<?php echo round($total_amount); ?>">
    <section class="item-result-wrap flight-elem" id="<?php echo 'ticketid0123'.$i.$operating_airlinecode[0].round($total_amount); ?><?php echo round($total_amount); ?>" data-airlinecode="<?php echo $operating_airlinecode[0]; ?>" data-price="<?php echo round($total_amount); ?>" data-faretype="<?php echo $nonrefundable; ?>" data-stops="<?php echo $stops; ?>" data-arivaltime="<?php echo $timemin1;//echo $arrtime[1]; ?>" data-departtime="<?php echo $timemin;//echo $deptime[1]; ?>" data-flightduration="<?php echo $duration; ?>" data-layover="<?php echo $stops; ?>" data-outwardnearby="">
        <article id="<?php echo round($total_amount); ?>" class="item-flight ">
            <p class="ticket-highlight-info hide" id="z-<?php echo round($total_amount); ?>"><i class="fa fa-check"></i> &nbsp; THIS IS THE CHEAPEST FLIGHT FOR THESE DATES!</p>
            <div class="row no-gutter">
                <main class="col-md-9 col-sm-12 item-flight-left"><br>              
                    <div class="row row-trip no-gutter">
                        <aside class="col-md-2 col-sm-2">
                            <div class="info-airline ">
                                <img src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[0]; ?>.gif">
                                <br>
                                <span class="text-dots" data-toggle="tooltip" title="" data-original-title="<?php echo $operating_airlinename[0]; ?>"><?php echo $operating_airlinename[0]; ?></span>
                                <br>
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-md-7 col-sm-6">
                        <div class="info-stops">
                            <p class="place-wrap">
                            <strong class="city" data-toggle="tooltip" title="" data-original-title="<?php echo $operating_cityname_o[0]; ?>"><?php echo $operating_cityname_o[0]; ?> </strong> <span class="code " data-toggle="tooltip" title="" data-original-title="">(<?php echo $operating_airportname_o[0];?>)</span>
                            <br><?php echo date('dS M',strtotime($operating_deptime[0]));?> <strong><?php echo $deptime[1]; ?></strong></p>
                            <p class="way-wrap">
                                <br>
                                <span class="travel-stops">
                                    <span class="start"></span>
                                    <span class="end"></span>
                                </span>
                                <span class="txt-stops txt-green" data-toggle="tooltip" data-placement="bottom" title="" data-original-title=""><?php echo $route; ?></span>
                            </p>
                            <p class="place-wrap"><span class="code " data-toggle="tooltip" title="" data-original-title="">(<?php echo $operating_airportname_d[0];  ?>)</span> <strong class="city" data-toggle="tooltip" title="" data-original-title="<?php echo $operating_cityname_d[0]; ?>"><?php echo $operating_cityname_d[0]; ?></strong>  
                            <br> <strong><?php echo $arrtime[1]; ?></strong> <?php echo date('dS M',strtotime($operating_arritime[0]));?> 
                            </p>
                        </div>
                    </aside> <!-- col // -->
                    <aside class="col-md-3  col-sm-4">
                        <div class="info-duration">
                            <i class="material-icons"></i>
                            <span class="time"><?php echo $durationd; ?></span>
                        </div>
                        <div class="info-icons">
                            <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Baggage"><img src="<?php echo base_url('assets/icons/flights_icon/baggage.png');?>"></span>
                            <?php if($nonrefundable == 1){ ?>
                            <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Refundable"><img src="<?php echo base_url('assets/icons/flights_icon/refund.png');?>"></span>
                            <?php } ?>



                        </div> <!-- info icons // -->
                    </aside> <!-- col // -->
                    </div> <!-- row-trip // -->

                </main> <!-- col // -->
                <aside class="col-md-3">
                <div class="info-buy">

                    <p class="txt-seat"> </p>


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
                    <p><a onclick="ShowItinerary('<?php echo 'ticketid0123'.$i.$operating_airlinecode[0].round($total_amount); ?>')" class="btn btn-block btn-info btn-details">Details <b class="caret"></b></a></p>
                </div>
            </aside> <!-- col // -->


            </div> <!-- row // -->
        </article> <!--  item-flight //  -->

        <div class="item-details" style="display: none">
            <nav class="heading-tab-details">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="<?php echo '#flight_menu-'.$i.$operating_airlinecode[0].round($total_amount); ?>" aria-controls="flight" data-toggle="tab"><span class="hidden-xs">Flight details</span> <span class="visible-xs">Flight</span></a></li>
                    <li><a href="#baggage_menu-<?php echo $i.$operating_airlinecode[0].round($total_amount); ?>" aria-controls="fare" data-toggle="tab"><span class="hidden-xs">Baggage information</span> <span class="visible-xs">Baggage</span></a></li>
                    <li><a href="#fare_menu-<?php echo $i.$operating_airlinecode[0].round($total_amount); ?>" aria-controls="fare" data-toggle="tab"><span class="hidden-xs">Fare Details</span> <span class="visible-xs">Fare</span></a></li>
                </ul>
            </nav><!--  tab-heading//  -->

            <div class="tab-content">
            <section class="tab-pane fade in active" id="<?php echo 'flight_menu-'.$i.$operating_airlinecode[0].round($total_amount); ?>">
                <article class="ticket-detail">
                    <header class="heading-ticket">
                        <i class="material-icons rotate-right"></i> 
                        <span class="alert-stops"> <span class="fa fa-clock-o fa-lg"></span> &nbsp; <?php echo $route; ?></span>
                        <h4 class="title">Flight from <strong><?php echo $operating_cityname_o[0]; ?></strong> To <strong><?php echo $operating_cityname_d[0]; ?></strong> On <strong><?php echo date('l, d F Y', strtotime($operating_deptime[0])); ?></strong></h4>
                    </header>
                    <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { ?>
                    <div class="row row-trip no-gutter">
                        <aside class="col-sm-2 col-xs-12">
                            <div class="info-airline">
                            <img src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[$j]; ?>.gif" alt="flight logo">
                            <br> <?php echo $operating_airlinename[$j]; ?> <br> <?php echo $operating_airlinecode[$j]. '-' .$operating_flightno[$j];?>
                                
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-7 col-xs-12">
                            <div class="info-flight-way">
                                <p class="place-wrap-from"><strong><?php echo $operating_cityname_o[$j]; ?></strong> (<?php echo $operating_airportname_o[$j]; ?>)
                                <br><?php echo date('dS M',strtotime($operating_deptime[$j]));?> <strong><?php //echo date('H:i',strtotime($deptime[1]));
                                
                                $dep = explode('T', $operating_deptime[$j]);
                                $dep[1] = substr($dep[1], 0, -3);
                                echo $dep[1];
                                
                                ?></strong>
                                    <br><?php echo $this->Tbo_Model->airportname($operating_airportname_o[$j]); ?>
                                     <br>Terminal: <?php echo $operating_terminal_o[$j]; ?></p>
                                <p class="way-wrap">
                                <span class="txt-time">
                                    <?php //echo $durationd; ?>
                                    <?php if(count($segment_duration) > 1 && $stops > 0 && $isdomestic == 'false') {
                                            echo floor($segment_duration[$j] / 60).'h:'.($segment_duration[$j] - floor($segment_duration[$j] / 60) * 60).'m';
                                            //echo $this->Tbo_Model->journeyDuration(str_replace("T", " ", $operating_deptime[$j]),str_replace("T", " ", $operating_arritime[$j]));
                                        } else {
                                            if($isdomestic == 'true') {
                                                echo $this->Tbo_Model->journeyDuration(str_replace("T", " ", $operating_deptime[$j]),str_replace("T", " ", $operating_arritime[$j]));
                                            }
                                        }
                                        ?>
                            </span>
                                    <span class="travel-stops">
                                        <span class="start"></span>
                                        <span class="end"></span>
                                    </span>
                                </p>
                                <p class="place-wrap-to">(<?php echo $operating_airportname_d[$j];?>) <strong><?php echo $operating_cityname_d[$j]; ?></strong>
                                    <br><strong><?php //echo date('H:i',strtotime($arrtime[1]));
                                    $arr = explode('T', $operating_arritime[$j]);
                                    $arr[1] = substr($arr[1], 0, -3);
                                    echo $arr[1];
                                    ?></strong> <?php echo date('dS M',strtotime($operating_arritime[$j]));?> <span data-toggle="tooltip" title="" class="badge" data-original-title="Arrival next day">+1</span>
                                    <br><?php echo $this->Tbo_Model->airportname($operating_airportname_d[$j]); ?> <br><?php if ($operating_terminal_o[$j] != '') echo 'Terminal : ' . $operating_terminal_o[$j];  ?></p>
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-3 col-xs-12 hidden-xs"> 
                            <ul class="list-default">
                                <li>Aircraft Type: <span>Airbus <?php echo $aircraftType; ?></span></li>
                                <li>Booking class: <span>R</span></li>
                                <li>Cabin Class: <span> Economy</span></li>
                            </ul>
                        </aside><!-- col // -->
                    </div> <!-- row-trip // -->
                    
                    <?php if($j != (count($operating_airlinecode)-1)){ ?>                    
                    
                        <span class="layover">  <strong><img src="<?php echo base_url(); ?>assets/images/icons/layover.png"> 
                        Layover <?php echo $this->Tbo_Model->journeyDuration(str_replace("T", " ", $operating_arritime[$j]),str_replace("T", " ", $operating_deptime[$j+1])) .' '.'in ' .$operating_cityname_o[1]. '</strong> </span>';  
                         
                        } ?> 

                    
                    
                        <?php } ?>




                </article> <!-- ticket-detail// -->                                       
            </section> <!--  tab-pane //  -->
            <section class="tab-pane fade" id="fare_menu-<?php echo $i.$operating_airlinecode[0].round($total_amount); ?>">
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
                                <p class="key-val"> <span> Other charges:</span> <var>INR 20</var></p>							   
                            </td>
                        </tr>
                    </tbody></table>

                    <p class="alert alert-warning">Note: The airline fee may, at times, be calculated on a per-flight basis. Cancellation/Flight change charges are indicative. Airlines stop accepting cancellation/change requests 4 - 72 hours before departure of the flight, depending on the airline. 
Change and refund fees and charges may change anytime and the price shown is not the final price as the airline has the right to change it anytime.</p>
                    <p class="alert alert-info">Note: travelfreebuy.com applies VAT as per the INDAN law. For more info, please view our <a href="/en/faq" target="_blank">FAQs</a></p>
                </article> <!-- ticket-detail// -->
            </section> <!--  tab-pane //  -->

            <section class="tab-pane fade" id="baggage_menu-<?php echo $i.$operating_airlinecode[0].round($total_amount); ?>">
                <article class="ticket-detail">
                <header class="heading-ticket">
                        <i class="material-icons rotate-right"></i> 
                        <span class="alert-stops"> <span class="fa fa-clock-o fa-lg"></span> &nbsp; <?php echo $route; ?></span>
                        <h4 class="title">Flight from <strong><?php echo $operating_cityname_o[0]; ?></strong> To <strong><?php echo $operating_cityname_d[0]; ?></strong> On <strong><?php echo date('l, d F Y', strtotime($operating_deptime[0])); ?></strong></h4>
                    </header>

                    <table class="table table-baggage">
                        <tbody><tr>
                            <td class="info-airline"> <img src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[0]; ?>.gif" alt="flight logo"> <br><small><?php echo $operating_airlinename[0]; ?></small></td>

                            <td width="400"><p><strong class="text-primary">Carry-on:</strong> <?php //echo "7 KG"; ?>Hand Baggage only                                </p>
                                <p><strong class="text-primary">Check-in:</strong><span class="outward_baggage_06E2137295">
                                        <?php if(!empty($baggageinformation)){echo $baggageinformation;}else{
                                        echo "Sorry! Baggage information will be available at the next step";   } ?>                            
                                    </span>
                                </p>
                            </td>
                            <td>  
                                <p class="txt-green"></p>
                                <p class="txt-green"></p> 
                            </td>
                        </tr>
                    </tbody></table><?php if(empty($baggageinformation)){ ?>
                    <span class="text-center col-sm-12 hide" id="pieces_baggage_icon_06E2137295"><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i></span>
                    <p class="alert alert-warning m15 hide" id="pieces_baggage_06E2137295" style="text-align:center;"> Sorry! Baggage information will be available at the next step.  </p>
                        <?php }?>
                </article> <!-- ticket-detail// -->
            </section> <!--  tab-pane //  -->


            </div> <!-- tab-content // -->	
        </div> <!-- item-details-wrap // -->

        <!--  MORE FARES START//  -->
        <div class="item-morefares-details" style="display: none">
            <nav class="heading-tab-details">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#flight_menu-1<?php echo $operating_airlinecode[0]; ?>6813<?php echo round($total_amount); ?>" aria-controls="flight" data-toggle="tab"><span class="hidden-xs">Select Fare</span> <span class="visible-xs">Select Fare</span></a></li>               
                </ul>
            </nav><!--  tab-heading//  -->

            <div class="tab-content">
                <section class="tab-pane fade in active" id="flight_menu-1<?php echo $operating_airlinecode[0]; ?>6813<?php echo round($total_amount); ?>">
                    <article class="ticket-detail info-buy ">
                        <table class="table-round" style="padding:5px;">	
                            <tbody><tr class="bg-info">
                                <td width="33%" align="center"><strong>Saver Fare</strong></td>
                                <td width="33%" align="center"><strong>SME Fare</strong></td>
                                <td width="33%" align="center"><strong>Flexi Fare</strong></td>
                            </tr>
                            <tr>
                                <td width="33%">
                                    <div class="details" style="height:160px;">
                                        <p class="key-val"></p>
                                        <div class="article">
                                            <ul>
                                                <li>Best deal from our Regular, Return, Family &amp; Online Group fares</li>
                                                <li>Chargeable Snacks/Meal</li>
                                                <li>Chargeable Seat</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="ticket-price-wrap price-new text-center"><span class="currency">INR</span> <?php echo round($total_amount); ?></p>
                                    <form name="flight_segmentform_1<?php echo $operating_airlinecode[0]; ?>6813<?php echo round($total_amount); ?>Saver Fare" id="flight_segmentform_1<?php echo $operating_airlinecode[0]; ?>6813<?php echo round($total_amount); ?>">
                                        <input type="hidden" name="temp_d" value="eyJKb3VybmV5U2VsbEtleSI6IjZFfjY4MTN+IH5+QkxSfjA0XC8xMFwvMjAyMiAyMjowMH5ERUx+MDRcLzExXC8yMDIyIDAwOjQ1fn4iLCJGYXJlSW5kZXgiOjE1LCJBUEkiOiJJbmRpZ28iLCJBUElfQ3VycmVuY3kiOiJBRUQiLCJBUElDdXJyZW5jeVR5cGUiOiJBRUQiLCJTaWduYXR1cmUiOiJZVWQ0UlZvMksyODBVRVU5ZkhkcUwyOXNlQ3RoTWsxdGFHOVlkM2N2T0c5WVQzZzNOMUZpWms5c1QwOUtaM1pqTDNFMFFWTnVkWEUxYUZwdVUxRTRLMXBsWTFKdlRsaFJaRTF1Um5KMFpsUXhiM05XUTFZeFdYSXlURUZUV2tKWk9XUkRZMHhCZDBWVU9EaFFTSGhpVVVnMmFHbHphMGg2VkhsM09IUnFRMjlSZUZwMFR5dHZObmgzTmtWUVdrNTVZVU5tUkd0NmFXNXRPVkZOWmtkVlVHTlBRVDA5IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBheW1lbnRUeXBlIjoiUGF5QnlDYXJkIiwiT3V0d2FyZF9DYWJpbkNsYXNzIjoiRWNvbm9teSIsIkluZm8iOiJTNyIsIkludGVybmF0aW9uYWwiOm51bGwsInNlZ21lbnRzIjpbeyJQbGF0aW5nQ2FycmllciI6IjZFIiwiSm91cm5leVNlbGxLZXkiOiI2RX42ODEzfiB+fkJMUn4wNFwvMTBcLzIwMjIgMjI6MDB+REVMfjA0XC8xMVwvMjAyMiAwMDo0NX5+IiwiU3VwcGxpZXJDbGFzcyI6IiIsIlByb2R1Y3RDbGFzcyI6IlIiLCJGYXJlUnVsZU51bWJlciI6IjEwNjUiLCJGYXJlQmFzaXNDb2RlIjoiUjBJUCIsIkZhcmVTZXF1ZW5jZSI6NTc1LCJGYXJlU2VsbEtleSI6IjB+Un4gfjZFflIwSVB+MTA2NX5+MH41NzV+flgiLCJPcmlnaW5hbENsYXNzT2ZTZXJ2aWNlIjoiUiIsIkJvb2tpbmdDb2RlIjoiUiIsInNlZ21lbnRfYW1vdW50Ijo0MDcsInNlZ21lbnRfYmFzZWFtb3VudCI6MzU0LCJPcmlnaW4iOiJCTFIiLCJEZXN0aW5hdGlvbiI6IkRFTCIsIkNhcnJpZXIiOiI2RSIsIkZsaWdodE51bWJlciI6IjY4MTMiLCJEZXBhcnR1cmVUaW1lIjoiMjAyMi0wNC0xMFQyMjowMDowMCswNTozMCIsIkFycml2YWxUaW1lIjoiMjAyMi0wNC0xMVQwMDo0NTowMCswNTozMCIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiT3JpZ2luVGVybWluYWwiOiIxIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IjEiLCJFcXVpcG1lbnQiOiIzMjAiLCJNYXJrZXRpbmdDb2RlIjoiIiwiU2NoZWR1bGVTZXJ2aWNlVHlwZSI6IkoiLCJQUkJDQ29kZSI6IlkxODYiLCJJbnZlbnRvcnlMZWdJRCI6NTgzNjg3NiwiQWR1bHRBbW91bnQiOjQwNywiQ2hpbGRBbW91bnQiOjAsIkludGVybmF0aW9uYWwiOm51bGwsIk11bHRpTGVnIjoiTm8iLCJTZWdtZW50U2VsbEtleSI6IjZFfjY4MTN+IH5+QkxSfjA0XC8xMFwvMjAyMiAyMjowMH5ERUx+MDRcLzExXC8yMDIyIDAwOjQ1fn4iLCJSdWxlTnVtYmVyIjoiMTA2NSJ9XSwiVG90YWxQcmljZSI6NDA3LCJUb3RhbFByaWNlX0FQSSI6NDA3LCJCYXNlUHJpY2UiOjM1NCwiVGF4ZXMiOjUzLCJTdXBwbGllckNsYXNzIjoiU2F2ZXIgRmFyZSJ9" required="">
                                        <input type="hidden" name="temp_r" value="eyJtZXRob2QiOiJTeW5jaCIsImRheXMiOiIiLCJvcmlnaW4iOiJCTFIiLCJkZXN0aW5hdGlvbiI6IkRFTCIsImRlcGFydF9kYXRlIjoiMTAtMDQtMjAyMiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiRWNvbm9teSIsInByb3ZpZGVyIjoiIiwidHlwZSI6Ik8ifQ==" required="">
                                        <input type="hidden" name="supplier_class" value="Saver Fare" required="">
                                        <input type="hidden" name="bunldedServiceId" value="R0IP" required="">
                                        <input type="hidden" name="api" value="" required="">
                                        <input type="hidden" name="temp_price" value="">
                                        <p>

                                        </p><p><input class="btn btn-block btn-warning" onclick="getAirpricing('1<?php echo $operating_airlinecode[0]; ?>6813<?php echo round($total_amount); ?>Saver Fare','BLR','DEL','Bengaluru','New Delhi','','', 'One-Way')" type="button" id="simple-post_1<?php echo $operating_airlinecode[0]; ?>6813<?php echo round($total_amount); ?>" name="button" value="Book Now"></p>
                                    </form>
                                </td>
                                <td width="33%">
                                    <div class="details" style="height:160px;">
                                        <p class="key-val"></p>
                                        <div class="article">
                                            <ul>
                                                <li>Unlimited Flexibility to Change</li>
                                                <li>Lower Cancellation Charges</li>
                                                <li>Complimentary meal (1 food item &amp; 1 beverage)</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="ticket-price-wrap price-new text-center"><span class="currency">INR</span> <?php echo round($total_amount); ?></p>
                                    <form name="flight_segmentform_1<?php echo $operating_airlinecode[0]; ?>6813<?php echo round($total_amount); ?>SME Fare" id="flight_segmentform_1<?php echo $operating_airlinecode[0]; ?>6813<?php echo round($total_amount); ?>">
                                        <input type="hidden" name="temp_d" value="eyJKb3VybmV5U2VsbEtleSI6IjZFfjY4MTN+IH5+QkxSfjA0XC8xMFwvMjAyMiAyMjowMH5ERUx+MDRcLzExXC8yMDIyIDAwOjQ1fn4iLCJGYXJlSW5kZXgiOjE1LCJBUEkiOiJJbmRpZ28iLCJBUElfQ3VycmVuY3kiOiJBRUQiLCJBUElDdXJyZW5jeVR5cGUiOiJBRUQiLCJTaWduYXR1cmUiOiJZVWQ0UlZvMksyODBVRVU5ZkhkcUwyOXNlQ3RoTWsxdGFHOVlkM2N2T0c5WVQzZzNOMUZpWms5c1QwOUtaM1pqTDNFMFFWTnVkWEUxYUZwdVUxRTRLMXBsWTFKdlRsaFJaRTF1Um5KMFpsUXhiM05XUTFZeFdYSXlURUZUV2tKWk9XUkRZMHhCZDBWVU9EaFFTSGhpVVVnMmFHbHphMGg2VkhsM09IUnFRMjlSZUZwMFR5dHZObmgzTmtWUVdrNTVZVU5tUkd0NmFXNXRPVkZOWmtkVlVHTlBRVDA5IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBheW1lbnRUeXBlIjoiUGF5QnlDYXJkIiwiT3V0d2FyZF9DYWJpbkNsYXNzIjoiRWNvbm9teSIsIkluZm8iOiJTNyIsIkludGVybmF0aW9uYWwiOm51bGwsInNlZ21lbnRzIjpbeyJQbGF0aW5nQ2FycmllciI6IjZFIiwiSm91cm5leVNlbGxLZXkiOiI2RX42ODEzfiB+fkJMUn4wNFwvMTBcLzIwMjIgMjI6MDB+REVMfjA0XC8xMVwvMjAyMiAwMDo0NX5+IiwiU3VwcGxpZXJDbGFzcyI6IiIsIlByb2R1Y3RDbGFzcyI6IlIiLCJGYXJlUnVsZU51bWJlciI6IjEwNjUiLCJGYXJlQmFzaXNDb2RlIjoiUk1JUCIsIkZhcmVTZXF1ZW5jZSI6MTgsIkZhcmVTZWxsS2V5IjoiMH5SfiB+NkV+Uk1JUH4yMTAxfn4wfjE4fn5YIiwiT3JpZ2luYWxDbGFzc09mU2VydmljZSI6IlIiLCJCb29raW5nQ29kZSI6IlIiLCJzZWdtZW50X2Ftb3VudCI6NDA3LCJzZWdtZW50X2Jhc2VhbW91bnQiOjM1NCwiT3JpZ2luIjoiQkxSIiwiRGVzdGluYXRpb24iOiJERUwiLCJDYXJyaWVyIjoiNkUiLCJGbGlnaHROdW1iZXIiOiI2ODEzIiwiRGVwYXJ0dXJlVGltZSI6IjIwMjItMDQtMTBUMjI6MDA6MDArMDU6MzAiLCJBcnJpdmFsVGltZSI6IjIwMjItMDQtMTFUMDA6NDU6MDArMDU6MzAiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIk9yaWdpblRlcm1pbmFsIjoiMSIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIxIiwiRXF1aXBtZW50IjoiMzIwIiwiTWFya2V0aW5nQ29kZSI6IiIsIlNjaGVkdWxlU2VydmljZVR5cGUiOiJKIiwiUFJCQ0NvZGUiOiJZMTg2IiwiSW52ZW50b3J5TGVnSUQiOjU4MzY4NzYsIkFkdWx0QW1vdW50Ijo0MDcsIkNoaWxkQW1vdW50IjowLCJJbnRlcm5hdGlvbmFsIjpudWxsLCJNdWx0aUxlZyI6Ik5vIiwiU2VnbWVudFNlbGxLZXkiOiI2RX42ODEzfiB+fkJMUn4wNFwvMTBcLzIwMjIgMjI6MDB+REVMfjA0XC8xMVwvMjAyMiAwMDo0NX5+IiwiUnVsZU51bWJlciI6IjIxMDEifV0sIlRvdGFsUHJpY2UiOjQwNywiVG90YWxQcmljZV9BUEkiOjQwNywiQmFzZVByaWNlIjozNTQsIlRheGVzIjo1MywiU3VwcGxpZXJDbGFzcyI6IlNNRSBGYXJlIn0=" required="">
                                        <input type="hidden" name="temp_r" value="eyJtZXRob2QiOiJTeW5jaCIsImRheXMiOiIiLCJvcmlnaW4iOiJCTFIiLCJkZXN0aW5hdGlvbiI6IkRFTCIsImRlcGFydF9kYXRlIjoiMTAtMDQtMjAyMiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiRWNvbm9teSIsInByb3ZpZGVyIjoiIiwidHlwZSI6Ik8ifQ==" required="">
                                        <input type="hidden" name="supplier_class" value="SME Fare" required="">
                                        <input type="hidden" name="bunldedServiceId" value="RMIP" required="">
                                        <input type="hidden" name="api" value="" required="">
                                        <input type="hidden" name="temp_price" value="">
                                        <p>

                                        </p><p><input class="btn btn-block btn-warning" onclick="getAirpricing('1<?php echo $operating_airlinecode[0]; ?>6813<?php echo round($total_amount); ?>SME Fare','BLR','DEL','Bengaluru','New Delhi','','', 'One-Way')" type="button" id="simple-post_1<?php echo $operating_airlinecode[0]; ?>6813<?php echo round($total_amount); ?>" name="button" value="Book Now"></p>
                                    </form>
                                </td>
                                <td width="33%">
                                    <div class="details" style="height:160px;">
                                        <p class="key-val"></p>
                                        <div class="article">
                                            <ul>
                                                <li>Complimentary Seat and Snack/meal</li>
                                                <li>No Date Change Fee For 4 Days and Above left for departure</li>
                                                <li>Lower cancellation fee For 4 Days and Above left for departure</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="ticket-price-wrap price-new text-center"><span class="currency">INR</span> 417</p>
                                    <form name="flight_segmentform_1<?php echo $operating_airlinecode[0]; ?>6813<?php echo round($total_amount); ?>Flexi Fare" id="flight_segmentform_1<?php echo $operating_airlinecode[0]; ?>6813<?php echo round($total_amount); ?>">
                                        <input type="hidden" name="temp_d" value="eyJKb3VybmV5U2VsbEtleSI6IjZFfjY4MTN+IH5+QkxSfjA0XC8xMFwvMjAyMiAyMjowMH5ERUx+MDRcLzExXC8yMDIyIDAwOjQ1fn4iLCJGYXJlSW5kZXgiOjE1LCJBUEkiOiJJbmRpZ28iLCJBUElfQ3VycmVuY3kiOiJBRUQiLCJBUElDdXJyZW5jeVR5cGUiOiJBRUQiLCJTaWduYXR1cmUiOiJZVWQ0UlZvMksyODBVRVU5ZkhkcUwyOXNlQ3RoTWsxdGFHOVlkM2N2T0c5WVQzZzNOMUZpWms5c1QwOUtaM1pqTDNFMFFWTnVkWEUxYUZwdVUxRTRLMXBsWTFKdlRsaFJaRTF1Um5KMFpsUXhiM05XUTFZeFdYSXlURUZUV2tKWk9XUkRZMHhCZDBWVU9EaFFTSGhpVVVnMmFHbHphMGg2VkhsM09IUnFRMjlSZUZwMFR5dHZObmgzTmtWUVdrNTVZVU5tUkd0NmFXNXRPVkZOWmtkVlVHTlBRVDA5IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBheW1lbnRUeXBlIjoiUGF5QnlDYXJkIiwiT3V0d2FyZF9DYWJpbkNsYXNzIjoiRWNvbm9teSIsIkluZm8iOiJTNyIsIkludGVybmF0aW9uYWwiOm51bGwsInNlZ21lbnRzIjpbeyJQbGF0aW5nQ2FycmllciI6IjZFIiwiSm91cm5leVNlbGxLZXkiOiI2RX42ODEzfiB+fkJMUn4wNFwvMTBcLzIwMjIgMjI6MDB+REVMfjA0XC8xMVwvMjAyMiAwMDo0NX5+IiwiU3VwcGxpZXJDbGFzcyI6IiIsIlByb2R1Y3RDbGFzcyI6IlIiLCJGYXJlUnVsZU51bWJlciI6IjEwNjUiLCJGYXJlQmFzaXNDb2RlIjoiUlVJUCIsIkZhcmVTZXF1ZW5jZSI6NjgsIkZhcmVTZWxsS2V5IjoiMH5SfiB+NkV+UlVJUH4yMDAyfn4wfjY4fn5YIiwiT3JpZ2luYWxDbGFzc09mU2VydmljZSI6IlIiLCJCb29raW5nQ29kZSI6IlIiLCJzZWdtZW50X2Ftb3VudCI6NDA3LCJzZWdtZW50X2Jhc2VhbW91bnQiOjM1NCwiT3JpZ2luIjoiQkxSIiwiRGVzdGluYXRpb24iOiJERUwiLCJDYXJyaWVyIjoiNkUiLCJGbGlnaHROdW1iZXIiOiI2ODEzIiwiRGVwYXJ0dXJlVGltZSI6IjIwMjItMDQtMTBUMjI6MDA6MDArMDU6MzAiLCJBcnJpdmFsVGltZSI6IjIwMjItMDQtMTFUMDA6NDU6MDArMDU6MzAiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIk9yaWdpblRlcm1pbmFsIjoiMSIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIxIiwiRXF1aXBtZW50IjoiMzIwIiwiTWFya2V0aW5nQ29kZSI6IiIsIlNjaGVkdWxlU2VydmljZVR5cGUiOiJKIiwiUFJCQ0NvZGUiOiJZMTg2IiwiSW52ZW50b3J5TGVnSUQiOjU4MzY4NzYsIkFkdWx0QW1vdW50Ijo0MDcsIkNoaWxkQW1vdW50IjowLCJJbnRlcm5hdGlvbmFsIjpudWxsLCJNdWx0aUxlZyI6Ik5vIiwiU2VnbWVudFNlbGxLZXkiOiI2RX42ODEzfiB+fkJMUn4wNFwvMTBcLzIwMjIgMjI6MDB+REVMfjA0XC8xMVwvMjAyMiAwMDo0NX5+IiwiUnVsZU51bWJlciI6IjIwMDIifV0sIlRvdGFsUHJpY2UiOjQxNywiVG90YWxQcmljZV9BUEkiOjQxNywiQmFzZVByaWNlIjozNjQsIlRheGVzIjo1MywiU3VwcGxpZXJDbGFzcyI6IkZsZXhpIEZhcmUifQ==" required="">
                                        <input type="hidden" name="temp_r" value="eyJtZXRob2QiOiJTeW5jaCIsImRheXMiOiIiLCJvcmlnaW4iOiJCTFIiLCJkZXN0aW5hdGlvbiI6IkRFTCIsImRlcGFydF9kYXRlIjoiMTAtMDQtMjAyMiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiRWNvbm9teSIsInByb3ZpZGVyIjoiIiwidHlwZSI6Ik8ifQ==" required="">
                                        <input type="hidden" name="supplier_class" value="Flexi Fare" required="">
                                        <input type="hidden" name="bunldedServiceId" value="RUIP" required="">
                                        <input type="hidden" name="api" value="" required="">
                                        <input type="hidden" name="temp_price" value="">
                                        <p>

                                        </p><p><input class="btn btn-block btn-warning" onclick="getAirpricing('1<?php echo $operating_airlinecode[0]; ?>6813<?php echo round($total_amount); ?>Flexi Fare','BLR','DEL','Bengaluru','New Delhi','','', 'One-Way')" type="button" id="simple-post_1<?php echo $operating_airlinecode[0]; ?>6813<?php echo round($total_amount); ?>" name="button" value="Book Now"></p>
                                    </form>
                                </td>
                            </tr>
                        </tbody></table>
                    </article> <!-- ticket-detail// -->                                       
                </section> <!--  tab-pane //  -->           
            </div> <!-- tab-content // -->	
        </div> <!-- item-morefares-details-wrap // -->
    </section> <!-- ====== item-result-wrap ====== // -->    
</section>

<?php } 
} ?>