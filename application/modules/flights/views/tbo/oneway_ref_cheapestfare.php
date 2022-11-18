<?php 
if (!empty($cheapest_flight)) {
    

if ($cheapest_flight['stops']==0) { $ch_route = "Direct";}else{$ch_route = "All";}

$operating_deptime = explode(' ', $cheapest_flight['operating_deptime']);    
$deptime=substr($operating_deptime['1'], 0, -3);

$operating_arritime = explode(' ', $cheapest_flight['operating_arritime']);   
$arrtime=substr($operating_arritime['1'], 0, -3);

$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $deptime.':00');
sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
$ch_timemin = floor(($hours * 3600 + $minutes * 60 + $seconds) / 60);

$str_time1 = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $arrtime.':00');
sscanf($str_time1, "%d:%d:%d", $hours1, $minutes1, $seconds1);
$ch_timemin1 = floor(($hours1 * 3600 + $minutes1 * 60 + $seconds1) / 60);

$ch_durationd =floor($cheapest_flight['duration'] / 60).'h:'.($cheapest_flight['duration'] -   floor($cheapest_flight['duration'] / 60) * 60).'m';
$ch_duration=	$cheapest_flight['duration'];	

$ch_stops = (count($cheapest_flight['operating_flightno'])-1);
?>

    <section class="flight-elem-parent" data-price="<?php echo round($cheapest_flight['total_amount']); ?>">
    <section class="item-result-wrap flight-elem" id="ticketid012306E2137295" data-airlinecode="<?php echo $cheapest_flight['operating_airlinecode']; ?>" data-price="<?php echo round($cheapest_flight['total_amount']); ?>" data-faretype="<?php echo $cheapest_flight['nonrefundable']; ?>" data-stops="<?php echo $ch_route; ?>" data-arivaltime="<?php echo $ch_timemin1;//echo $arrtime[1]; ?>" data-departtime="<?php echo $ch_timemin;//echo $deptime[1]; ?>" data-flightduration="<?php echo $ch_duration; ?>" data-layover="<?php echo $ch_stops; ?>" data-outwardnearby="">
    <article id="<?php echo round($cheapest_flight['total_amount']); ?>" class="item-flight  ticket-highlight">
        <p class="ticket-highlight-info" id="z-<?php echo round($cheapest_flight['total_amount']); ?>"><i class="fa fa-check"></i> &nbsp; THIS IS THE CHEAPEST FLIGHT FOR THESE DATES!</p>
        <div class="row no-gutter">
            <main class="col-md-9 col-sm-12 item-flight-left"><br>              
                <div class="row row-trip no-gutter">
                    <aside class="col-md-2 col-sm-2">
                        <div class="info-airline ">
                            <img src="<?php echo base_url() . 'public/AirlineLogo/' .$cheapest_flight['operating_airlinecode']; ?>.gif" alt="flight logo">
                            <br>
                            <span class="text-dots" data-toggle="tooltip" title="" data-original-title="<?php echo $cheapest_flight['operating_airlinename']; ?>"><?php echo $cheapest_flight['operating_airlinename']; ?></span>
                            <br>
                        </div>
                    </aside> <!-- col // -->
                    <aside class="col-md-7 col-sm-6">
                        <div class="info-stops">
                            <p class="place-wrap">
                                <strong class="city" data-toggle="tooltip" title="" data-original-title="<?php echo $cheapest_flight['operating_cityname_o']; ?>"><?php echo $cheapest_flight['operating_cityname_o']; ?> </strong> <span class="code " data-toggle="tooltip" title="" data-original-title="">(<?php echo $cheapest_flight['operating_airportname_o'];?>)</span>
                                <br><?php echo date('dS M',strtotime($operating_deptime[0]));?> <strong><?php echo date('H:i',strtotime($deptime[1])); ?></strong></p>
                            <p class="way-wrap">
                                <br>
                                <span class="travel-stops">
                                    <span class="start"></span>
                                    <span class="end"></span>
                                </span>
                                <span class="txt-stops txt-green" data-toggle="tooltip" data-placement="bottom" title="" data-original-title=""><?php echo $ch_route; ?></span>
                            </p>
                            <p class="place-wrap"><span class="code " data-toggle="tooltip" title="" data-original-title="">(<?php echo $cheapest_flight['operating_airportname_d'];?>)</span> <strong class="city" data-toggle="tooltip" title="" data-original-title="<?php echo $cheapest_flight['operating_cityname_d']; ?>"><?php echo $cheapest_flight['operating_cityname_d']; ?></strong>  <br>
                             <strong><?php echo date('H:i',strtotime($arrtime[1])); ?></strong> <?php echo date('dS M',strtotime($arrtime[0]));?>
                                <span data-toggle="tooltip" title="" class="badge" data-original-title="Arrival next day">+1</span>
                            </p>
                        </div>
                    </aside> <!-- col // -->
                    <aside class="col-md-3  col-sm-4">
                        <div class="info-duration">
                            <i class="material-icons"></i>
                            <span class="time"><?php echo $ch_durationd; ?></span>
                        </div>
                        <div class="info-icons">
                            <span class="icon icon-layover" data-toggle="tooltip" title="" data-original-title="Baggage"><img src="<?php echo base_url('assets/icons/flights_icon/baggage.png');?>"></span>
                            <?php if($cheapest_flight['nonrefundable'] == 1){ ?>
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

                    <span class="price-new"><span class="currency"><?php echo $cheapest_flight['currency']; ?></span> <?php echo $cheapest_flight['total_amount']; ?></span></p>
                    <form name="flight_segmentform_06E2137295" id="flight_segmentform_06E2137295">
                        <input type="hidden" name="temp_d" value="" required="">
                        <input type="hidden" name="temp_r" value="" required="">
                        <input type="hidden" name="api" value="" required="">
                        <input type="hidden" name="temp_price" value="<?php echo $cheapest_flight['total_amount']; ?>">
                        <p>

                        </p><p><input class="btn btn-block btn-warning" onclick="getAirpricing('06E2137295','<?php echo $cheapest_flight['operating_airportname_o']; ?>','<?php echo $cheapest_flight['operating_airportname_d']; ?>','<?php echo $cheapest_flight['operating_cityname_o']; ?>','<?php echo $cheapest_flight['operating_cityname_d']; ?>','<?php echo date('dS M',strtotime($operating_deptime[0]));?>','<?php echo date('dS M',strtotime($arrtime[0]));?>', 'One-Way')" type="button" id="simple-post_06E2137295" name="button" value="Book Now"></p>
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
                        <span class="alert-stops"> <span class="fa fa-clock-o fa-lg"></span> &nbsp; <?php echo $ch_route; ?></span>
                        <h4 class="title">Flight from <strong><?php echo $cheapest_flight['operating_cityname_o']; ?></strong> To <strong><?php echo $cheapest_flight['operating_cityname_o']; ?></strong> On <strong><?php echo date('l, d F Y', strtotime($operating_deptime[0])); ?></strong></h4>
                    </header>

                    <div class="row row-trip no-gutter">
                        <aside class="col-sm-2 col-xs-12">
                            <div class="info-airline">
                                <img src="<?php echo base_url() . 'public/AirlineLogo/' .$cheapest_flight['operating_airlinecode']; ?>.gif" alt="flight logo">
                                <br> <?php echo $cheapest_flight['operating_airlinename']; ?> <br> <?php echo $cheapest_flight['operating_airlinecode']. '-' .$ch_flightno;?>
                                
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-7 col-xs-12">
                            <div class="info-flight-way">
                                <p class="place-wrap-from"><strong><?php echo $cheapest_flight['operating_cityname_o']; ?></strong> (<?php echo $cheapest_flight['operating_airportname_o']; ?>)
                                    <br><?php echo date('dS M',strtotime($cheapest_flight['operating_deptime']));?> <strong><?php echo date('H:i',strtotime($deptime[1])); ?></strong>
                                    <br>Delhi Indira Gandhi international <br>Terminal: <?php echo $cheapest_flight['operating_terminal_o']; ?></p>
                                <p class="way-wrap">
                                    <span class="txt-time"><?php echo $ch_durationd; ?></span>
                                    <span class="travel-stops">
                                        <span class="start"></span>
                                        <span class="end"></span>
                                    </span>
                                </p>
                                <p class="place-wrap-to">(<?php echo $cheapest_flight['operating_airportname_d'];?>) <strong><?php echo $cheapest_flight['operating_cityname_d']; ?></strong>
                                    <br><strong><?php echo date('H:i',strtotime($arrtime[1])); ?></strong> <?php echo date('dS M',strtotime($cheapest_flight['operating_arrtime']));?> <span data-toggle="tooltip" title="" class="badge" data-original-title="Arrival next day">+1</span>
                                    <br>Chhatrapati Shivaji International Airport <br>Terminal: <?php echo $cheapest_flight['operating_terminal_d']; ?></p>
                            </div>
                        </aside> <!-- col // -->
                        <aside class="col-sm-3 col-xs-12 hidden-xs"> 
                            <ul class="list-default">
                                <li>Aircraft Type: <span>Airbus <?php echo $cheapest_flight['aircraftType']; ?></span></li>
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
                                <?php if($cheapest_flight['nonrefundable'] == 1){$refuntable = "Refundable";}else{$refuntable="NonRefundable";} ?>                           
                                <span class="label-green pull-right"><?php echo $refuntable; ?></span>

                            </td>
                            <td>Change flight</td>
                            <td>Cancel flight</td>
                        </tr>
                        <tr>
                            <td>
                                <p class="key-val"> <span>Base Fare:</span> <var><?php echo $cheapest_flight['currency'].' '.$cheapest_flight['basefare']; ?></var></p>
                                <p class="key-val"> <span>Taxes &amp; Fees <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip"
                                 title="" data-original-title="Taxes &amp; Fees include service fee, as well as third party taxes and surcharges such as airport tax,
                                 fuel surcharges, and airline fees. For more info, please view our FAQs"></i>:</span> <var><?php echo $cheapest_flight['currency'].' '.$cheapest_flight['tax']; ?></var></p>
                                <p class="key-val"> <span>Total (incl. VAT):</span> <var><?php echo $cheapest_flight['currency'].' '.$cheapest_flight['total_amount']; ?></var></p>

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
                        <h4 class="title">Flight from <strong><?php echo $cheapest_flight['operating_cityname_o']; ?></strong> To <strong><?php echo $cheapest_flight['operating_cityname_d']; ?></strong> On <strong><?php echo date('l, d F Y', strtotime($operating_deptime[0])); ?></strong></h4>
                    </header>

                    <table class="table table-baggage">
                        <tbody><tr>
                            <td class="info-airline"> <img src="<?php echo base_url() . 'public/AirlineLogo/' .$cheapest_flight['operating_airlinecode']; ?>.gif" alt="flight logo"> <br><small><?php echo $cheapest_flight['operating_airlinename']; ?></small></td>

                            <td width="400"><p><strong class="text-primary">Carry-on:</strong> <?php echo $cheapest_flight['adt_cabinBaggage']; ?>/person                                </p>
                                <p><strong class="text-primary">Check-in:</strong><span class="outward_baggage_06E2137295">
                                        <?php if(!empty($cheapest_flight['adt_checkinBaggage'])){echo $cheapest_flight['adt_checkinBaggage'];}else{
                                        echo "Sorry! Baggage information will be available at the next step";   } ?>                            
                                    </span>
                                </p>
                            </td>
                            <td>  
                                <p class="txt-green"></p>
                                <p class="txt-green"></p> 
                            </td>
                        </tr>
                    </tbody></table><?php if(empty($cheapest_flight['adt_checkinBaggage'])){ ?>
                    <span class="text-center col-sm-12 hide" id="pieces_baggage_icon_06E2137295"><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i></span>
                    <p class="alert alert-warning m15 hide" id="pieces_baggage_06E2137295" style="text-align:center;"> Sorry! Baggage information will be available at the next step.  </p>
                        <?php }?>

                </article> <!-- ticket-detail// -->
            </section> <!--  tab-pane //  -->


        </div> <!-- tab-content // -->	
    </div> <!-- item-details-wrap // -->
</section> 
<!-- ====== item-result-wrap ====== // udaya-->    
                    <?php } ?>