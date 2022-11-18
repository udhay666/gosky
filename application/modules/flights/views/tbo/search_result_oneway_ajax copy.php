<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<?php if (!empty($result)) { ?>

<?php for ($i = 0; $i < count($result); $i++) { 
    // echo '<pre>';print_r($result);exit;
    $operating_airlinecode = explode(',', $result[$i]->operating_airlinecode);
    $operating_airlinename = explode(',', $result[$i]->operating_airlinename);
    $operating_flightno = explode(',', $result[$i]->operating_flightno);
    $operating_airportname_o = explode(',', $result[$i]->operating_airportname_o);
    $operating_fareclass = $result[$i]->operating_fareclass;
    // $operating_deptime = explode(',', $result[$i]->operating_deptime);
    $operating_deptime = explode(' ', $result[$i]->operating_deptime);
    // $deptime = explode('T', $operating_deptime[0]);
    $deptime['1']=substr($operating_deptime['1'], 0, -3);
    //  echo '<pre>';print_r($deptime['1']);exit;
    $operating_arritime = explode(' ', $result[$i]->operating_arritime);
    // $arrtime = explode('T', $operating_arritime[0]);
    $arrtime['1']=substr($operating_arritime['1'], 0, -3);
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
    $adt_checkinBaggage = $refuntable[$i]->adt_checkinBaggage;
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
        
    // echo '<pre>';print_r($durationd);exit;   
    // $deptime[1] = "05:30:12";Wednesday, 19 January 2022
    // echo $operating_deptime[0]."<br>";
    // echo date('l, d F Y', strtotime($operating_deptime[0])); exit;
    ?>
<section class="flight-elem-parent" data-price="<?php echo round($total_amount); ?>">
    <section class="item-result-wrap flight-elem" id="ticketid012306E2137295" data-airlinecode="<?php echo $operating_airlinecode[0]; ?>" data-price="<?php echo round($total_amount); ?>" data-faretype="<?php echo $nonrefundable; ?>" data-stops="<?php echo $route; ?>" data-arivaltime="<?php echo $timemin1;//echo $arrtime[1]; ?>" data-departtime="<?php echo $timemin;//echo $deptime[1]; ?>" data-flightduration="<?php echo $duration; ?>" data-layover="<?php echo $stops; ?>" data-outwardnearby="">
    <article id="<?php echo round($total_amount); ?>" class="item-flight  ticket-highlight">
        <p class="ticket-highlight-info" id="z-<?php echo round($total_amount); ?>"><i class="fa fa-check"></i> &nbsp; THIS IS THE CHEAPEST FLIGHT FOR THESE DATES!</p>
        <div class="row no-gutter">
            <main class="col-md-9 col-sm-12 item-flight-left"><br>              
                <div class="row row-trip no-gutter">
                    <aside class="col-md-2 col-sm-2">
                        <div class="info-airline ">
                            <img src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[0]; ?>.gif" alt="flight logo">
                            <br>
                            <span class="text-dots" data-toggle="tooltip" title="" data-original-title="<?php echo $operating_airlinename[0]; ?>"><?php echo $operating_airlinename[0]; ?></span>
                            <br>
                        </div>
                    </aside> <!-- col // -->
                    <aside class="col-md-7 col-sm-6">
                        <div class="info-stops">
                            <p class="place-wrap">
                                <strong class="city" data-toggle="tooltip" title="" data-original-title="<?php echo $operating_cityname_o[0]; ?>"><?php echo $operating_cityname_o[0]; ?> </strong> <span class="code " data-toggle="tooltip" title="" data-original-title="">(<?php echo $operating_airportname_o[0];?>)</span>
                                <br><?php echo date('dS M',strtotime($operating_deptime[0]));?> <strong><?php echo date('H:i',strtotime($deptime[1])); ?></strong></p>
                            <p class="way-wrap">
                                <br>
                                <span class="travel-stops">
                                    <span class="start"></span>
                                    <span class="end"></span>
                                </span>
                                <span class="txt-stops txt-green" data-toggle="tooltip" data-placement="bottom" title="" data-original-title=""><?php echo $route; ?></span>
                            </p>
                            <p class="place-wrap"><span class="code " data-toggle="tooltip" title="" data-original-title="">(<?php echo $operating_airportname_d[0];?>)</span> <strong class="city" data-toggle="tooltip" title="" data-original-title="<?php echo $operating_cityname_d[0]; ?>"><?php echo $operating_cityname_d[0]; ?></strong>  <br>
                             <strong><?php echo date('H:i',strtotime($arrtime[1])); ?></strong> <?php echo date('dS M',strtotime($arrtime[0]));?>
                                <span data-toggle="tooltip" title="" class="badge" data-original-title="Arrival next day">+1</span>
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




                            <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Night fly"><img src="<?php echo base_url('assets/icons/flights_icon/redeye.png');?>"></span>
                        </div> <!-- info icons // -->
                    </aside> <!-- col // -->
                </div> <!-- row-trip // -->

            </main> <!-- col // -->
            <aside class="col-md-3">
                <div class="info-buy">

                    <p class="txt-seat"> </p>


                    <p class="ticket-price-wrap">

                    <span class="price-new"><span class="currency"><?php echo $currency; ?></span> <?php echo $total_amount; ?></span></p>
                    <form name="flight_segmentform_06E2137295" id="flight_segmentform_06E2137295">
                        <input type="hidden" name="temp_d" value="" required="">
                        <input type="hidden" name="temp_r" value="" required="">
                        <input type="hidden" name="api" value="" required="">
                        <input type="hidden" name="temp_price" value="<?php echo $total_amount; ?>">
                        <p>

                        </p><p><input class="btn btn-block btn-warning" onclick="getAirpricing('06E2137295','<?php echo $operating_airportname_o[0]; ?>','<?php echo $operating_airportname_d[0]; ?>','<?php echo $operating_cityname_o[0]; ?>','<?php echo $operating_cityname_d[0]; ?>','<?php echo date('dS M',strtotime($operating_deptime[0]));?>','<?php echo date('dS M',strtotime($arrtime[0]));?>', 'One-Way')" type="button" id="simple-post_06E2137295" name="button" value="Book Now"></p>
                    </form>
                    <p><a onclick="ShowItinerary('ticketid012306E2137295')" class="btn btn-block btn-info btn-details">Details <b class="caret"></b></a></p>
                </div>
            </aside> <!-- col // -->


        </div> <!-- row // -->
    </article> <!--  item-flight //  -->

    <div class="item-details" style="display: none">
        <nav class="heading-tab-details">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#flight_menu-06E2137295" aria-controls="flight" data-toggle="tab"><span class="hidden-xs">Flight details</span> <span class="visible-xs">Flight</span></a></li>
                <li><a href="#baggage_menu-06E2137295" aria-controls="fare" data-toggle="tab"><span class="hidden-xs">Baggage information</span> <span class="visible-xs">Baggage</span></a></li>
                <li><a href="#fare_menu-06E2137295" aria-controls="fare" data-toggle="tab"><span class="hidden-xs">Fare Details</span> <span class="visible-xs">Fare</span></a></li>
            </ul>
        </nav><!--  tab-heading//  -->

        <div class="tab-content">
            <section class="tab-pane fade in active" id="flight_menu-06E2137295">
                <article class="ticket-detail">
                    <header class="heading-ticket">
                        <i class="material-icons rotate-right"></i> 
                        <span class="alert-stops"> <span class="fa fa-clock-o fa-lg"></span> &nbsp; <?php echo $route; ?></span>
                        <h4 class="title">Flight from <strong><?php echo $operating_cityname_o[0]; ?></strong> To <strong><?php echo $operating_cityname_o[0]; ?></strong> On <strong><?php echo date('l, d F Y', strtotime($operating_deptime[0])); ?></strong></h4>
                    </header>

                    <div class="row row-trip no-gutter">
                        <aside class="col-sm-2 col-xs-12">
                            <div class="info-airline">
                                <img src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[0]; ?>.gif" alt="flight logo">
                                <br> <?php echo $operating_airlinename[0]; ?> <br> <?php echo $operating_airlinecode[0]. '-' .$flightno;?>
                                
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-7 col-xs-12">
                            <div class="info-flight-way">
                                <p class="place-wrap-from"><strong><?php echo $operating_cityname_o[0]; ?></strong> (<?php echo $operating_airportname_o[0]; ?>)
                                    <br><?php echo date('dS M',strtotime($operating_deptime[0]));?> <strong><?php echo date('H:i',strtotime($deptime[1])); ?></strong>
                                    <br>Delhi Indira Gandhi international <br>Terminal: <?php echo $operating_terminal_o[0]; ?></p>
                                <p class="way-wrap">
                                    <span class="txt-time"><?php echo $durationd; ?></span>
                                    <span class="travel-stops">
                                        <span class="start"></span>
                                        <span class="end"></span>
                                    </span>
                                </p>
                                <p class="place-wrap-to">(<?php echo $operating_airportname_d[0];?>) <strong><?php echo $operating_cityname_d[0]; ?></strong>
                                    <br><strong><?php echo date('H:i',strtotime($arrtime[1])); ?></strong> <?php echo date('dS M',strtotime($operating_arrtime[0]));?> <span data-toggle="tooltip" title="" class="badge" data-original-title="Arrival next day">+1</span>
                                    <br>Chhatrapati Shivaji International Airport <br>Terminal: <?php echo $operating_terminal_d[0]; ?></p>
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





                </article> <!-- ticket-detail// -->                                       
            </section> <!--  tab-pane //  -->
            <section class="tab-pane fade" id="fare_menu-06E2137295">
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
                    <p class="alert alert-info">Note: travelkitb2b.com applies VAT as per the UAE law. For more info, please view our <a href="/en/faq" target="_blank">FAQs</a></p>
                </article> <!-- ticket-detail// -->
            </section> <!--  tab-pane //  -->

            <section class="tab-pane fade" id="baggage_menu-06E2137295">
                <article class="ticket-detail">
                    <header class="heading-ticket">
                        <i class="material-icons rotate-right"></i> 
                        <span class="alert-stops"> <span class="fa fa-clock-o fa-lg"></span> &nbsp; <?php echo $route; ?></span>
                        <h4 class="title">Flight from <strong><?php echo $operating_cityname_o[0]; ?></strong> To <strong><?php echo $operating_cityname_d[0]; ?></strong> On <strong><?php echo date('l, d F Y', strtotime($operating_deptime[0])); ?></strong></h4>
                    </header>

                    <table class="table table-baggage">
                        <tbody><tr>
                            <td class="info-airline"> <img src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[0]; ?>.gif" alt="flight logo"> <br><small><?php echo $operating_airlinename[0]; ?></small></td>

                            <td width="400"><p><strong class="text-primary">Carry-on:</strong> <?php echo $adt_cabinBaggage; ?>/person                                </p>
                                <p><strong class="text-primary">Check-in:</strong><span class="outward_baggage_06E2137295">
                                        <?php if(!empty($adt_checkinBaggage)){echo $adt_checkinBaggage;}else{
                                        echo "Sorry! Baggage information will be available at the next step";   } ?>                            
                                    </span>
                                </p>
                            </td>
                            <td>  
                                <p class="txt-green"></p>
                                <p class="txt-green"></p> 
                            </td>
                        </tr>
                    </tbody></table><?php if(empty($adt_checkinBaggage)){ ?>
                    <span class="text-center col-sm-12 hide" id="pieces_baggage_icon_06E2137295"><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i></span>
                    <p class="alert alert-warning m15 hide" id="pieces_baggage_06E2137295" style="text-align:center;"> Sorry! Baggage information will be available at the next step.  </p>
                        <?php }?>

                </article> <!-- ticket-detail// -->
            </section> <!--  tab-pane //  -->


        </div> <!-- tab-content // -->	
    </div> <!-- item-details-wrap // -->
</section> <!-- ====== item-result-wrap ====== // udaya-->    
<?php } ?>
<?php } ?>
    <div class="tickets-more-wrap" style="display: none;">
        <section class="item-result-wrap flight-elem" id="ticketid012316E6722295" data-airlinecode="6E" data-price="295" data-faretype="Refundable" data-stops="Direct" data-arivaltime="1410" data-departtime="1290" data-flightduration="135" data-layover="0" data-outwardnearby="">
    <article id="295" class="item-flight ">
        <p class="ticket-highlight-info hide" id="z-295"><i class="fa fa-check"></i> &nbsp; THIS IS THE CHEAPEST FLIGHT FOR THESE DATES!</p>
        <div class="row no-gutter">
            <main class="col-md-9 col-sm-12 item-flight-left"><br>              
                <div class="row row-trip no-gutter">
                    <aside class="col-md-2 col-sm-2">
                        <div class="info-airline ">
                            <img src="<?php echo base_url('assets/icons/flights_icon/6E.png');?>">
                            <br>
                            <span class="text-dots" data-toggle="tooltip" title="" data-original-title="Indigo">Indigo</span>
                            <br>
                        </div>
                    </aside> <!-- col // -->
                    <aside class="col-md-7 col-sm-6">
                        <div class="info-stops">
                            <p class="place-wrap">
                                <strong class="city" data-toggle="tooltip" title="" data-original-title="New Delhi">New Delhi </strong> <span class="code " data-toggle="tooltip" title="" data-original-title="">(DEL)</span>
                                <br>12 Jan <strong>21:15</strong></p>
                            <p class="way-wrap">
                                <br>
                                <span class="travel-stops">
                                    <span class="start"></span>
                                    <span class="end"></span>
                                </span>
                                <span class="txt-stops txt-green" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="">Direct</span>
                            </p>
                            <p class="place-wrap"><span class="code " data-toggle="tooltip" title="" data-original-title="">(BOM)</span> <strong class="city" data-toggle="tooltip" title="" data-original-title="Mumbai">Mumbai</strong>  <br> <strong>23:30</strong> 19 Jan
                            </p>
                        </div>
                    </aside> <!-- col // -->
                    <aside class="col-md-3  col-sm-4">
                        <div class="info-duration">
                            <i class="material-icons"></i>
                            <span class="time">2h 15m</span>
                        </div>
                        <div class="info-icons">
                            <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Baggage"><img src="<?php echo base_url('assets/icons/flights_icon/baggage.png');?>"></span>
                            <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Refundable"><img src="<?php echo base_url('assets/icons/flights_icon/refund.png');?>"></span>




                        </div> <!-- info icons // -->
                    </aside> <!-- col // -->
                </div> <!-- row-trip // -->

            </main> <!-- col // -->
            <aside class="col-md-3">
                <div class="info-buy">

                    <p class="txt-seat"> </p>


                    <p class="ticket-price-wrap">

                    <span class="price-new"><span class="currency">INR</span> 295</span></p>
                    <form name="flight_segmentform_16E6722295" id="flight_segmentform_16E6722295">
                        <input type="hidden" name="temp_d" value="" required="">
                        <input type="hidden" name="temp_r" value="" required="">
                        <input type="hidden" name="api" value="" required="">
                        <input type="hidden" name="temp_price" value="295">
                        <p>

                        </p><p><input class="btn btn-block btn-warning" onclick="getAirpricing('16E6722295','DEL','BOM','New Delhi','Mumbai','19 Jan','19 Jan', 'One-Way')" type="button" id="simple-post_16E6722295" name="button" value="Book Now"></p>
                    </form>
                    <p><a onclick="ShowItinerary('ticketid012316E6722295')" class="btn btn-block btn-info btn-details">Details <b class="caret"></b></a></p>
                </div>
            </aside> <!-- col // -->


        </div> <!-- row // -->
    </article> <!--  item-flight //  -->

    <div class="item-details" style="display: none">
        <nav class="heading-tab-details">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#flight_menu-16E6722295" aria-controls="flight" data-toggle="tab"><span class="hidden-xs">Flight details</span> <span class="visible-xs">Flight</span></a></li>
                <li><a href="#baggage_menu-16E6722295" aria-controls="fare" data-toggle="tab"><span class="hidden-xs">Baggage information</span> <span class="visible-xs">Baggage</span></a></li>
                <li><a href="#fare_menu-16E6722295" aria-controls="fare" data-toggle="tab"><span class="hidden-xs">Fare Details</span> <span class="visible-xs">Fare</span></a></li>
            </ul>
        </nav><!--  tab-heading//  -->

        <div class="tab-content">
            <section class="tab-pane fade in active" id="flight_menu-16E6722295">
                <article class="ticket-detail">
                    <header class="heading-ticket">
                        <i class="material-icons rotate-right"></i> 
                        <span class="alert-stops"> <span class="fa fa-clock-o fa-lg"></span> &nbsp; Direct</span>
                        <h4 class="title">Flight from <strong>New Delhi</strong> To <strong>Mumbai</strong> On <strong>Wednesday, 19 January 2022</strong></h4>
                    </header>

                    <div class="row row-trip no-gutter">
                        <aside class="col-sm-2 col-xs-12">
                            <div class="info-airline">
                                <img src="<?php echo base_url('assets/icons/flights_icon/6E.png');?>">
                                <br> Indigo <br> 6E - 6722
                                
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-7 col-xs-12">
                            <div class="info-flight-way">
                                <p class="place-wrap-from"><strong>New Delhi</strong> (DEL)
                                    <br>19 Jan <strong>21:15</strong>
                                    <br>Delhi Indira Gandhi international <br>Terminal: 1</p>
                                <p class="way-wrap">
                                    <span class="txt-time">2h 15m</span>
                                    <span class="travel-stops">
                                        <span class="start"></span>
                                        <span class="end"></span>
                                    </span>
                                </p>
                                <p class="place-wrap-to">(BOM) <strong>Mumbai</strong>
                                    <br><strong>23:30</strong> 19 Jan 
                                    <br>Chhatrapati Shivaji International Airport <br>Terminal: 2</p>
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-3 col-xs-12 hidden-xs"> 
                            <ul class="list-default">
                                <li>Aircraft Type: <span>Airbus 320</span></li>
                                <li>Booking class: <span>R</span></li>
                                <li>Cabin Class: <span> Economy</span></li>
                            </ul>
                        </aside><!-- col // -->
                    </div> <!-- row-trip // -->





                </article> <!-- ticket-detail// -->                                       
            </section> <!--  tab-pane //  -->
            <section class="tab-pane fade" id="fare_menu-16E6722295">
                <article class="ticket-detail panel-body">

                    <table class="table-round">	
                        <tbody><tr class="bg-info">
                            <td>Fare Details                                
                                <span class="label-green pull-right">Refundable</span>

                            </td>
                            <td>Change flight</td>
                            <td>Cancel flight</td>
                        </tr>
                        <tr>
                            <td>
                                <p class="key-val"> <span>Base Fare:</span> <var>INR 257</var></p>
                                <p class="key-val"> <span>Taxes &amp; Fees <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="" data-original-title="Taxes &amp; Fees include service fee, as well as third party taxes and surcharges such as airport tax, fuel surcharges, and airline fees. For more info, please view our FAQs"></i>:</span> <var>INR 38</var></p>
                                <p class="key-val"> <span>Total (incl. VAT):</span> <var>INR 295</var></p>

                            </td>
                            <td>
                                <p class="key-val"> <span>Airlines charges <small class="change_penalty_16E6722295" style="color: red;"></small>:</span> <var class="change_16E6722295">INR 0</var></p>
                                <p class="key-val"> <span>Other charges:</span> <var> INR 20</var></p>							  
                            </td>
                            <td>
                                <p class="key-val"> <span>Airlines charges <small class="cancel_penalty_16E6722295" style="color: red;"></small>:</span> <var class="cancel_16E6722295">INR 0</var></p>
                                <p class="key-val"> <span> Other charges:</span> <var>INR 20</var></p>							   
                            </td>
                        </tr>
                    </tbody></table>

                    <p class="alert alert-warning">Note: The airline fee may, at times, be calculated on a per-flight basis. Cancellation/Flight change charges are indicative. Airlines stop accepting cancellation/change requests 4 - 72 hours before departure of the flight, depending on the airline. 
Change and refund fees and charges may change anytime and the price shown is not the final price as the airline has the right to change it anytime.</p>
                    <p class="alert alert-info">Note: travelkit.com applies VAT as per the UAE law. For more info, please view our <a href="/en/faq" target="_blank">FAQs</a></p>
                </article> <!-- ticket-detail// -->
            </section> <!--  tab-pane //  -->

            <section class="tab-pane fade" id="baggage_menu-16E6722295">
                <article class="ticket-detail">
                    <header class="heading-ticket">
                        <i class="material-icons rotate-right"></i> 
                        <span class="alert-stops"> <span class="fa fa-clock-o fa-lg"></span> &nbsp; Direct</span>
                        <h4 class="title">Flight from <strong>New Delhi</strong> To <strong>Mumbai</strong> On <strong>Wednesday, 19 January 2022</strong></h4>
                    </header>

                    <table class="table table-baggage">
                        <tbody><tr>
                            <td class="info-airline"> <img src="<?php echo base_url('assets/icons/flights_icon/6E.png');?>"> <br><small>Indigo</small></td>

                            <td width="400"><p><strong class="text-primary">Carry-on:</strong> 7 kg/person                                </p>
                                <p><strong class="text-primary">Check-in:</strong><span class="outward_baggage_16E6722295">

                                        Sorry! Baggage information will be available at the next step                                    
                                    </span>
                                </p>
                            </td>
                            <td>  
                                <p class="txt-green"></p>
                                <p class="txt-green"></p> 
                            </td>
                        </tr>
                    </tbody></table>
                    <span class="text-center col-sm-12 hide" id="pieces_baggage_icon_16E6722295"><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i></span>
                    <p class="alert alert-warning m15 hide" id="pieces_baggage_16E6722295" style="text-align:center;"> Sorry! Baggage information will be available at the next step.  </p>


                </article> <!-- ticket-detail// -->
            </section> <!--  tab-pane //  -->


        </div> <!-- tab-content // -->	
    </div> <!-- item-details-wrap // -->
</section> <!-- ====== item-result-wrap ====== // -->        
    </div>
    <button class="btn-ticket-more" onclick="show_hide_similar_flights(this)"><span>+</span> 1 More options at the same price</button>
</section>
                
                <!--2nd content-->
                <section class="flight-elem-parent" data-price="301">
    <section class="item-result-wrap flight-elem" id="ticketid01235SG8169301" data-airlinecode="SG" data-price="301" data-faretype="Refundable" data-stops="Direct" data-arivaltime="1325" data-departtime="1230" data-flightduration="140" data-layover="0" data-outwardnearby="">
    <article id="301" class="item-flight ">
        <p class="ticket-highlight-info hide" id="z-301"><i class="fa fa-check"></i> &nbsp; THIS IS THE CHEAPEST FLIGHT FOR THESE DATES!</p>
        <div class="row no-gutter">
            <main class="col-md-9 col-sm-12 item-flight-left"><br>              
                <div class="row row-trip no-gutter">
                    <aside class="col-md-2 col-sm-2">
                        <div class="info-airline ">
                            <img src="<?php echo base_url('assets/icons/flights_icon/SG.png');?>">
                            <br>
                            <span class="text-dots" data-toggle="tooltip" title="" data-original-title="SpiceJet ">SpiceJet </span>
                            <br>USPV
                        </div>
                    </aside> <!-- col // -->
                    <aside class="col-md-7 col-sm-6">
                        <div class="info-stops">
                            <p class="place-wrap">
                                <strong class="city" data-toggle="tooltip" title="" data-original-title="New Delhi">New Delhi </strong> <span class="code " data-toggle="tooltip" title="" data-original-title="">(DEL)</span>
                                <br>19 Jan <strong>19:45</strong></p>
                            <p class="way-wrap">
                                <br>
                                <span class="travel-stops">
                                    <span class="start"></span>
                                    <span class="end"></span>
                                </span>
                                <span class="txt-stops txt-green" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="">Direct</span>
                            </p>
                            <p class="place-wrap"><span class="code " data-toggle="tooltip" title="" data-original-title="">(BOM)</span> <strong class="city" data-toggle="tooltip" title="" data-original-title="Mumbai">Mumbai</strong>  <br> <strong>22:05</strong> 19 Jan
                            </p>
                        </div>
                    </aside> <!-- col // -->
                    <aside class="col-md-3  col-sm-4">
                        <div class="info-duration">
                            <i class="material-icons"></i>
                            <span class="time">2h 20m</span>
                        </div>
                        <div class="info-icons">
                            <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Baggage"><img src="<?php echo base_url('assets/icons/flights_icon/baggage.png');?>"></span>
                            <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Refundable"><img src="<?php echo base_url('assets/icons/flights_icon/refund.png');?>"></span>




                        </div> <!-- info icons // -->
                    </aside> <!-- col // -->
                </div> <!-- row-trip // -->

            </main> <!-- col // -->
            <aside class="col-md-3">
                <div class="info-buy">

                    <p class="txt-seat"> </p>


                    <p class="ticket-price-wrap">

                    <span class="price-new"><span class="currency">INR</span> 301</span></p>
                    <form name="flight_segmentform_5SG8169301" id="flight_segmentform_5SG8169301">
                        <input type="hidden" name="temp_d" value="" required="">
                        <input type="hidden" name="temp_r" value="" required="">
                        <input type="hidden" name="api" value="" required="">
                        <input type="hidden" name="temp_price" value="301">
                        <p>

                        </p><p><input class="btn btn-block btn-warning" onclick="getAirpricing('5SG8169301','DEL','BOM','New Delhi','Mumbai','19 Jan','19 Jan', 'One-Way')" type="button" id="simple-post_5SG8169301" name="button" value="Book Now"></p>
                    </form>
                    <p><a onclick="ShowItinerary('ticketid01235SG8169301')" class="btn btn-block btn-info btn-details">Details <b class="caret"></b></a></p>
                </div>
            </aside> <!-- col // -->


        </div> <!-- row // -->
    </article> <!--  item-flight //  -->

    <div class="item-details" style="display: none">
        <nav class="heading-tab-details">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#flight_menu-5SG8169301" aria-controls="flight" data-toggle="tab"><span class="hidden-xs">Flight details</span> <span class="visible-xs">Flight</span></a></li>
                <li><a href="#baggage_menu-5SG8169301" aria-controls="fare" data-toggle="tab"><span class="hidden-xs">Baggage information</span> <span class="visible-xs">Baggage</span></a></li>
                <li><a href="#fare_menu-5SG8169301" aria-controls="fare" data-toggle="tab"><span class="hidden-xs">Fare Details</span> <span class="visible-xs">Fare</span></a></li>
            </ul>
        </nav><!--  tab-heading//  -->

        <div class="tab-content">
            <section class="tab-pane fade in active" id="flight_menu-5SG8169301">
                <article class="ticket-detail">
                    <header class="heading-ticket">
                        <i class="material-icons rotate-right"></i> 
                        <span class="alert-stops"> <span class="fa fa-clock-o fa-lg"></span> &nbsp; Direct</span>
                        <h4 class="title">Flight from <strong>New Delhi</strong> To <strong>Mumbai</strong> On <strong>Wednesday, 19 January 2022</strong></h4>
                    </header>

                    <div class="row row-trip no-gutter">
                        <aside class="col-sm-2 col-xs-12">
                            <div class="info-airline">
                                <img src="<?php echo base_url('assets/icons/flights_icon/SG.png');?>">
                                <br> SpiceJet  <br> SG - 8169
                                
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-7 col-xs-12">
                            <div class="info-flight-way">
                                <p class="place-wrap-from"><strong>New Delhi</strong> (DEL)
                                    <br>19 Jan <strong>19:45</strong>
                                    <br>Delhi Indira Gandhi international <br>Terminal: 3</p>
                                <p class="way-wrap">
                                    <span class="txt-time">2h 20m</span>
                                    <span class="travel-stops">
                                        <span class="start"></span>
                                        <span class="end"></span>
                                    </span>
                                </p>
                                <p class="place-wrap-to">(BOM) <strong>Mumbai</strong>
                                    <br><strong>22:05</strong> 19 Jan 
                                    <br>Chhatrapati Shivaji International Airport <br>Terminal: 2</p>
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-3 col-xs-12 hidden-xs"> 
                            <ul class="list-default">
                                <li>Aircraft Type: <span>Boeing 737</span></li>
                                <li>Booking class: <span>U</span></li>
                                <li>Cabin Class: <span> Economy</span></li>
                            </ul>
                        </aside><!-- col // -->
                    </div> <!-- row-trip // -->





                </article> <!-- ticket-detail// -->                                       
            </section> <!--  tab-pane //  -->
            <section class="tab-pane fade" id="fare_menu-5SG8169301">
                <article class="ticket-detail panel-body">

                    <table class="table-round"> 
                        <tbody><tr class="bg-info">
                            <td>Fare Details                                
                                <span class="label-green pull-right">Refundable</span>

                            </td>
                            <td>Change flight</td>
                            <td>Cancel flight</td>
                        </tr>
                        <tr>
                            <td>
                                <p class="key-val"> <span>Base Fare:</span> <var>INR 258</var></p>
                                <p class="key-val"> <span>Taxes &amp; Fees <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="" data-original-title="Taxes &amp; Fees include service fee, as well as third party taxes and surcharges such as airport tax, fuel surcharges, and airline fees. For more info, please view our FAQs"></i>:</span> <var>INR 43</var></p>
                                <p class="key-val"> <span>Total (incl. VAT):</span> <var>INR 301</var></p>

                            </td>
                            <td>
                                <p class="key-val"> <span>Airlines charges <small class="change_penalty_5SG8169301" style="color: red;"></small>:</span> <var class="change_5SG8169301">INR 173</var></p>
                                <p class="key-val"> <span>Other charges:</span> <var> INR 20</var></p>                            
                            </td>
                            <td>
                                <p class="key-val"> <span>Airlines charges <small class="cancel_penalty_5SG8169301" style="color: red;"></small>:</span> <var class="cancel_5SG8169301">INR 173</var></p>
                                <p class="key-val"> <span> Other charges:</span> <var>INR 20</var></p>                             
                            </td>
                        </tr>
                    </tbody></table>

                    <p class="alert alert-warning">Note: The airline fee may, at times, be calculated on a per-flight basis. Cancellation/Flight change charges are indicative. Airlines stop accepting cancellation/change requests 4 - 72 hours before departure of the flight, depending on the airline. 
Change and refund fees and charges may change anytime and the price shown is not the final price as the airline has the right to change it anytime.</p>
                    <p class="alert alert-info">Note: travelkit.com applies VAT as per the UAE law. For more info, please view our <a href="/en/faq" target="_blank">FAQs</a></p>
                </article> <!-- ticket-detail// -->
            </section> <!--  tab-pane //  -->

            <section class="tab-pane fade" id="baggage_menu-5SG8169301">
                <article class="ticket-detail">
                    <header class="heading-ticket">
                        <i class="material-icons rotate-right"></i> 
                        <span class="alert-stops"> <span class="fa fa-clock-o fa-lg"></span> &nbsp; Direct</span>
                        <h4 class="title">Flight from <strong>New Delhi</strong> To <strong>Mumbai</strong> On <strong>Wednesday, 19 January 2022</strong></h4>
                    </header>

                    <table class="table table-baggage">
                        <tbody><tr>
                            <td class="info-airline"> <img src="<?php echo base_url('assets/icons/flights_icon/SG.png');?>"> <br><small>SpiceJet </small></td>

                            <td width="400"><p><strong class="text-primary">Carry-on:</strong> 7 kg/person                                </p>
                                <p><strong class="text-primary">Check-in:</strong><span class="outward_baggage_5SG8169301">
                                        Adult: 15KG                                    

                                    </span>
                                </p>
                            </td>
                            <td>  
                                <p class="txt-green">Free</p>
                                <p class="txt-green">Free</p> 
                            </td>
                        </tr>
                    </tbody></table>
                    <span class="text-center col-sm-12 hide" id="pieces_baggage_icon_5SG8169301"><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i></span>
                    <p class="alert alert-warning m15 hide" id="pieces_baggage_5SG8169301" style="text-align:center;"> Sorry! Baggage information will be available at the next step.  </p>


                </article> <!-- ticket-detail// -->
            </section> <!--  tab-pane //  -->


        </div> <!-- tab-content // -->  
    </div> <!-- item-details-wrap // -->
</section> <!-- ====== item-result-wrap ====== // -->    
    <div class="tickets-more-wrap" style="display: none;">
        <section class="item-result-wrap flight-elem" id="ticketid01236SG8169301" data-airlinecode="SG" data-price="301" data-faretype="Refundable" data-stops="Direct" data-arivaltime="1325" data-departtime="1230" data-flightduration="140" data-layover="0" data-outwardnearby="">
    <article id="301" class="item-flight ">
        <p class="ticket-highlight-info hide" id="z-301"><i class="fa fa-check"></i> &nbsp; THIS IS THE CHEAPEST FLIGHT FOR THESE DATES!</p>
        <div class="row no-gutter">
            <main class="col-md-9 col-sm-12 item-flight-left"><br>              
                <div class="row row-trip no-gutter">
                    <aside class="col-md-2 col-sm-2">
                        <div class="info-airline ">
                            <img src="<?php echo base_url('assets/icons/flights_icon/SG.png');?>">
                            <br>
                            <span class="text-dots" data-toggle="tooltip" title="" data-original-title="SpiceJet ">SpiceJet </span>
                            <br>WCPN0
                        </div>
                    </aside> <!-- col // -->
                    <aside class="col-md-7 col-sm-6">
                        <div class="info-stops">
                            <p class="place-wrap">
                                <strong class="city" data-toggle="tooltip" title="" data-original-title="New Delhi">New Delhi </strong> <span class="code " data-toggle="tooltip" title="" data-original-title="">(DEL)</span>
                                <br>19 Jan <strong>19:45</strong></p>
                            <p class="way-wrap">
                                <br>
                                <span class="travel-stops">
                                    <span class="start"></span>
                                    <span class="end"></span>
                                </span>
                                <span class="txt-stops txt-green" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="">Direct</span>
                            </p>
                            <p class="place-wrap"><span class="code " data-toggle="tooltip" title="" data-original-title="">(BOM)</span> <strong class="city" data-toggle="tooltip" title="" data-original-title="Mumbai">Mumbai</strong>  <br> <strong>22:05</strong> 19 Jan
                            </p>
                        </div>
                    </aside> <!-- col // -->
                    <aside class="col-md-3  col-sm-4">
                        <div class="info-duration">
                            <i class="material-icons"></i>
                            <span class="time">2h 20m</span>
                        </div>
                        <div class="info-icons">
                            <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Baggage"><img src="<?php echo base_url('assets/icons/flights_icon/baggage.png');?>"></span>
                            <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Refundable"><img src="<?php echo base_url('assets/icons/flights_icon/refund.png');?>"></span>




                        </div> <!-- info icons // -->
                    </aside> <!-- col // -->
                </div> <!-- row-trip // -->

            </main> <!-- col // -->
            <aside class="col-md-3">
                <div class="info-buy">

                    <p class="txt-seat"> </p>


                    <p class="ticket-price-wrap">

                    <span class="price-new"><span class="currency">INR</span> 301</span></p>
                    <form name="flight_segmentform_6SG8169301" id="flight_segmentform_6SG8169301">
                        <input type="hidden" name="temp_d" value="" required="">
                        <input type="hidden" name="temp_r" value="" required="">
                        <input type="hidden" name="api" value="" required="">
                        <input type="hidden" name="temp_price" value="301">
                        <p>

                        </p><p><input class="btn btn-block btn-warning" onclick="getAirpricing('6SG8169301','DEL','BOM','New Delhi','Mumbai','19 Jan','19 Jan', 'One-Way')" type="button" id="simple-post_6SG8169301" name="button" value="Book Now"></p>
                    </form>
                    <p><a onclick="ShowItinerary('ticketid01236SG8169301')" class="btn btn-block btn-info btn-details">Details <b class="caret"></b></a></p>
                </div>
            </aside> <!-- col // -->


        </div> <!-- row // -->
    </article> <!--  item-flight //  -->

    <div class="item-details" style="display: none">
        <nav class="heading-tab-details">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#flight_menu-6SG8169301" aria-controls="flight" data-toggle="tab"><span class="hidden-xs">Flight details</span> <span class="visible-xs">Flight</span></a></li>
                <li><a href="#baggage_menu-6SG8169301" aria-controls="fare" data-toggle="tab"><span class="hidden-xs">Baggage information</span> <span class="visible-xs">Baggage</span></a></li>
                <li><a href="#fare_menu-6SG8169301" aria-controls="fare" data-toggle="tab"><span class="hidden-xs">Fare Details</span> <span class="visible-xs">Fare</span></a></li>
            </ul>
        </nav><!--  tab-heading//  -->

        <div class="tab-content">
            <section class="tab-pane fade in active" id="flight_menu-6SG8169301">
                <article class="ticket-detail">
                    <header class="heading-ticket">
                        <i class="material-icons rotate-right"></i> 
                        <span class="alert-stops"> <span class="fa fa-clock-o fa-lg"></span> &nbsp; Direct</span>
                        <h4 class="title">Flight from <strong>New Delhi</strong> To <strong>Mumbai</strong> On <strong>Wednesday, 19 January 2022</strong></h4>
                    </header>

                    <div class="row row-trip no-gutter">
                        <aside class="col-sm-2 col-xs-12">
                            <div class="info-airline">
                                <img src="<?php echo base_url('assets/icons/flights_icon/SG.png');?>">
                                <br> SpiceJet  <br> SG - 8169
                                
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-7 col-xs-12">
                            <div class="info-flight-way">
                                <p class="place-wrap-from"><strong>New Delhi</strong> (DEL)
                                    <br>19 Jan <strong>19:45</strong>
                                    <br>Delhi Indira Gandhi international <br>Terminal: 3</p>
                                <p class="way-wrap">
                                    <span class="txt-time">2h 20m</span>
                                    <span class="travel-stops">
                                        <span class="start"></span>
                                        <span class="end"></span>
                                    </span>
                                </p>
                                <p class="place-wrap-to">(BOM) <strong>Mumbai</strong>
                                    <br><strong>22:05</strong> 19 Jan 
                                    <br>Chhatrapati Shivaji International Airport <br>Terminal: 2</p>
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-3 col-xs-12 hidden-xs"> 
                            <ul class="list-default">
                                <li>Aircraft Type: <span>Boeing 737</span></li>
                                <li>Booking class: <span>W</span></li>
                                <li>Cabin Class: <span> Economy</span></li>
                            </ul>
                        </aside><!-- col // -->
                    </div> <!-- row-trip // -->





                </article> <!-- ticket-detail// -->                                       
            </section> <!--  tab-pane //  -->
            <section class="tab-pane fade" id="fare_menu-6SG8169301">
                <article class="ticket-detail panel-body">

                    <table class="table-round"> 
                        <tbody><tr class="bg-info">
                            <td>Fare Details                                
                                <span class="label-green pull-right">Refundable</span>

                            </td>
                            <td>Change flight</td>
                            <td>Cancel flight</td>
                        </tr>
                        <tr>
                            <td>
                                <p class="key-val"> <span>Base Fare:</span> <var>INR 258</var></p>
                                <p class="key-val"> <span>Taxes &amp; Fees <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="" data-original-title="Taxes &amp; Fees include service fee, as well as third party taxes and surcharges such as airport tax, fuel surcharges, and airline fees. For more info, please view our FAQs"></i>:</span> <var>INR 43</var></p>
                                <p class="key-val"> <span>Total (incl. VAT):</span> <var>INR 301</var></p>

                            </td>
                            <td>
                                <p class="key-val"> <span>Airlines charges <small class="change_penalty_6SG8169301" style="color: red;"></small>:</span> <var class="change_6SG8169301">INR 173</var></p>
                                <p class="key-val"> <span>Other charges:</span> <var> INR 20</var></p>                            
                            </td>
                            <td>
                                <p class="key-val"> <span>Airlines charges <small class="cancel_penalty_6SG8169301" style="color: red;"></small>:</span> <var class="cancel_6SG8169301">INR 173</var></p>
                                <p class="key-val"> <span> Other charges:</span> <var>INR 20</var></p>                             
                            </td>
                        </tr>
                    </tbody></table>

                    <p class="alert alert-warning">Note: The airline fee may, at times, be calculated on a per-flight basis. Cancellation/Flight change charges are indicative. Airlines stop accepting cancellation/change requests 4 - 72 hours before departure of the flight, depending on the airline. 
Change and refund fees and charges may change anytime and the price shown is not the final price as the airline has the right to change it anytime.</p>
                    <p class="alert alert-info">Note: travelkit.com applies VAT as per the UAE law. For more info, please view our <a href="/en/faq" target="_blank">FAQs</a></p>
                </article> <!-- ticket-detail// -->
            </section> <!--  tab-pane //  -->

            <section class="tab-pane fade" id="baggage_menu-6SG8169301">
                <article class="ticket-detail">
                    <header class="heading-ticket">
                        <i class="material-icons rotate-right"></i> 
                        <span class="alert-stops"> <span class="fa fa-clock-o fa-lg"></span> &nbsp; Direct</span>
                        <h4 class="title">Flight from <strong>New Delhi</strong> To <strong>Mumbai</strong> On <strong>Wednesday, 19 January 2022</strong></h4>
                    </header>

                    <table class="table table-baggage">
                        <tbody><tr>
                            <td class="info-airline"> <img src="<?php echo base_url('assets/icons/flights_icon/SG.png');?>"> <br><small>SpiceJet </small></td>

                            <td width="400"><p><strong class="text-primary">Carry-on:</strong> 7 kg/person                                </p>
                                <p><strong class="text-primary">Check-in:</strong><span class="outward_baggage_6SG8169301">
                                        Adult: 15KG                                    

                                    </span>
                                </p>
                            </td>
                            <td>  
                                <p class="txt-green">Free</p>
                                <p class="txt-green">Free</p> 
                            </td>
                        </tr>
                    </tbody></table>
                    <span class="text-center col-sm-12 hide" id="pieces_baggage_icon_6SG8169301"><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i></span>
                    <p class="alert alert-warning m15 hide" id="pieces_baggage_6SG8169301" style="text-align:center;"> Sorry! Baggage information will be available at the next step.  </p>


                </article> <!-- ticket-detail// -->
            </section> <!--  tab-pane //  -->


        </div> <!-- tab-content // -->  
    </div> <!-- item-details-wrap // -->
</section> <!-- ====== item-result-wrap ====== // -->        
    </div>
    <button class="btn-ticket-more" onclick="show_hide_similar_flights(this)"><span>+</span> 1 More options at the same price</button>
</section>
