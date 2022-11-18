<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<?php if (!empty($result1)) { ?>

<?php unset($result); //echo '<pre>';print_r($result);exit;
$result=$result1;
for ($i = 0; $i < count($result); $i++) {

    $operating_airlinecode = explode(',', $result[$i]->operating_airlinecode);
    $operating_airlinename = explode(',', $result[$i]->operating_airlinename);
    $operating_flightno = explode(',', $result[$i]->operating_flightno);
    $operating_airportname_o = explode(',', $result[$i]->operating_airportname_o);
    $operating_fareclass = $result[$i]->operating_fareclass;
    $operating_deptime = explode(',', $result[$i]->operating_deptime);
    $operating_deptime = explode(',', $result[$i]->operating_deptime);
    $deptime = explode('T', $operating_deptime[0]);
    // $deptime['1']=substr($deptime['1'], 0);
    $deptime['1']=date('h:i a', strtotime($deptime['1']));
    $operating_arritime = explode(',', $result[$i]->operating_arritime);
    $arrtime = explode('T', $operating_arritime[0]);
    // $arrtime['1']=substr($arrtime['1'], 0);
    $arrtime['1']=date('h:i a', strtotime($arrtime['1']));
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
        //$stops = $result[$i]->stops;
    $stops = (count($operating_flightno)-1);
    $destination = $result[$i]->destination;
    $search_id = $result[$i]->search_id;
    $segmentkey = $result[$i]->segmentkey;
    $basefare = $result[$i]->basefare;
    $tax = $result[$i]->tax+$result[$i]->admin_markup+$result[$i]->agent_markup+$result[$i]->payment_charge;
    $total_amount = $result[$i]->total_amount;
    $currency = $result[$i]->currency;

    $session_data = $this->session->userdata('flight_search_data');
    $fromCity_arr = explode(',', $session_data['fromCity']);
    $toCity_arr = explode(',', $session_data['toCity']);
        // convert hours to min
        //$str_time = "23:12:95";
    $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $deptime[1].':00');
    sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
    $timemin = floor(($hours * 3600 + $minutes * 60 + $seconds) / 60);

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

    $fareinformation = json_decode($result[$i]->farearray);

    $basefare=$IBaggage=$tax=$classes=$Cbaggage=$fareIdentifier=$id=array();
    foreach ($fareinformation as $value) {
        $basefare[] = $value->fd->ADULT->fC->BF;
        $tax[] = $value->fd->ADULT->fC->TAF;
        $IBaggage[] = $value->fd->ADULT->bI->iB;
        $Cbaggage[] = $value->fd->ADULT->bI->cB;
        $fareIdentifier[] = $value->fareIdentifier;
        $classes[] = $value->fd->ADULT->cc;
        $id[] = $value->id;
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
    // $Cbaggageinformation = $cbag[0];

    $str_time1 = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $arrtime[1].':00');
    sscanf($str_time1, "%d:%d:%d", $hours1, $minutes1, $seconds1);
    $timemin1 = floor(($hours1 * 3600 + $minutes1 * 60 + $seconds1) / 60);

    ?>
  <div class="theme-search-results">
    <div class="theme-search-results-item _mb-10 theme-search-results-item-rounded theme-search-results-item-">
      <div class="theme-search-results-item-preview">
        <a class="theme-search-results-item-mask-link" href="#searchResultsItem-<?php echo $i ?>" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="searchResultsItem-<?php echo $i ?>"></a>
        <div class="row searchflight_box" data-gutter="20" >
          <div class="col-md-10 ">
            <div class="theme-search-results-item-flight-sections FlightInfoBox" data-price="<?php echo round($total_amount); ?>" data-airlinename="<?php echo $operating_airlinename[0]; ?>"  data-airline="<?php echo $operating_airlinecode[0]; ?>" data-duration="<?php echo $duration; ?>" data-departure="<?php echo $timemin;//echo $deptime[1]; ?>" data-arrival="<?php echo $timemin1;//echo $arrtime[1]; ?>" data-stop="<?php echo $stops; ?>" data-faretype="<?php echo $nonrefundable; ?>" data-departCheck="<?php echo $departCheck1; ?>">
              <div class="theme-search-results-item-flight-section">
                <div class="row row-no-gutter row-eq-height">
                  <div class="col-md-2 ">
                    <input type="radio" name="returnRadio" class="returnRadio" data-searchId="<?php echo $search_id; ?>"  style="position:absolute">
                    <div class="theme-search-results-item-flight-section-airline-logo-wrap">
                      <img class="theme-search-results-item-flight-section-airline-logo" src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[0]; ?>.gif" alt="flight logo" class="flight-logo"/>
                    </div>
                  </div>
                  <div class="col-md-10 ">
                    <div class="theme-search-results-item-flight-section-item">
                      <div class="row">
                        <div class="col-md-3 ">
                          <div class="theme-search-results-item-flight-section-meta">
                            <p class="theme-search-results-item-flight-section-meta-time"><?php echo $deptime[1]; ?>
                              <!-- <span>pm</span> -->
                            </p>
                            <p class="theme-search-results-item-flight-section-meta-city">(<?php echo current($operating_airportname_o); ?>)</p>
                            <p class="theme-search-results-item-flight-section-meta-date"><?php echo date('d-m-Y',strtotime($deptime[0])); ?></p>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                          <div class="theme-search-results-item-flight-section-path">
                            <div class="theme-search-results-item-flight-section-path-fly-time">
                              <p><?php echo $durationd; ?></p>
                            </div>
                            <div class="theme-search-results-item-flight-section-path-line"></div>
                            <div class="theme-search-results-item-flight-section-path-line-start">
                              <i class="fa fa-plane theme-search-results-item-flight-section-path-icon"></i>
                              <div class="theme-search-results-item-flight-section-path-line-dot"></div>
                              <div class="theme-search-results-item-flight-section-path-line-title"> (<?php echo current($operating_airportname_o); ?>)</div>
                            </div>
                            <!-- <div class="theme-search-results-item-flight-section-path-line-middle-1">
                              <i class="fa fa-plane theme-search-results-item-flight-section-path-icon"></i>
                              <div class="theme-search-results-item-flight-section-path-line-dot"></div>
                              <div class="theme-search-results-item-flight-section-path-line-title">CDG</div>
                            </div>
                            <div class="theme-search-results-item-flight-section-path-line-middle-2">
                              <i class="fa fa-plane theme-search-results-item-flight-section-path-icon"></i>
                              <div class="theme-search-results-item-flight-section-path-line-dot"></div>
                              <div class="theme-search-results-item-flight-section-path-line-title">WAW</div>
                            </div> -->
                            <div class="theme-search-results-item-flight-section-path-line-end">
                              <i class="fa fa-plane theme-search-results-item-flight-section-path-icon"></i>
                              <div class="theme-search-results-item-flight-section-path-line-dot"></div>
                              <div class="theme-search-results-item-flight-section-path-line-title">(<?php echo end($operating_airportname_d); ?>)</div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 ">
                          <div class="theme-search-results-item-flight-section-meta">
                            <p class="theme-search-results-item-flight-section-meta-time"><?php echo $arrtime[1]; ?>
                            </p>
                            <p class="theme-search-results-item-flight-section-meta-city"><?php echo end($operating_airportname_d); ?></p>
                            <p class="theme-search-results-item-flight-section-meta-date"><?php echo date('d-m-Y',strtotime($arrtime[0])); ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               <button><h3 class="theme-search-results-item-flight-section-airline-title" style="font-size: 14px;font-weight: 600;margin-top: 0;padding: 7px">View Details</h3></button>
                <span>Seats Left : <strong>3</strong></span>
              </div>
              <div class="theme-search-results-item-flight-section">
                <div class="row row-no-gutter row-eq-height">
                  <div class="col-md-12 ">
                    <p style="margin: 0;font-size: 13px">* Travel related advisory is subject to change without notice, for latest update please check state government websites only.</p>
                    <p style="margin: 0;font-size: 13px">* Current Airline Policy for New Bookings in case of Cancellation/Full Refund/Change for your reference:</p>
                    <p style="margin: 0;font-size: 13px">* Normal Cancellation:</p>
                    <p style="margin: 0;font-size: 13px">* Cancellation Charges will be levied and Balance amount will be refunded to the agency wallet instantly.</p>
                    <p style="margin: 0;font-size: 13px">* Flight Cancellation: Due to any reason</p>
                    <p style="margin: 0;font-size: 13px">* Full Refund in the agency wallet after charging the applicable TJ service Fee.</p>
                    <p style="margin: 0;font-size: 13px">* Please Note: Terms and conditions are subject to change without any notice.</p>
                  </div>
                </div>
                <h5 class="theme-search-results-item-flight-section-airline-title">Operated by Virgin Atlantic Airways</h5>
              </div>
            </div>
          </div>
          <div class="col-md-2 ">
            <div class="theme-search-results-item-book">
              <div class="theme-search-results-item-price">
                <p class="theme-search-results-item-price-tag"> <? echo $currency ?> <?php echo number_format($total_amount); ?></p>
                <p class="theme-search-results-item-price-sign">economy</p>
              </div>
              <!-- <input type="radio" name="returnRadio" class="returnRadio" data-searchId="<?php echo $search_id; ?>"  style="position:absolute"> -->
            </div>
          </div>
        </div>
      </div>
      <div class="collapse theme-search-results-item-collapse" id="searchResultsItem-<?php echo $i ?>">
        <div class="theme-search-results-item-extend">
          <a class="theme-search-results-item-extend-close" href="#searchResultsItem-<?php echo $i ?>" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="searchResultsItem-<?php echo $i ?>">&#10005;</a>
          <div class="tabbable theme-search-results-item-tabs">
              <ul class="nav nav-tabs" role="tablist">
                <li class="active" role="presentation">
                  <a role="tab" data-toggle="tab" href="#tab-item--1" aria-controls="tab-item--1">Flight Info</a>
                </li>
                <li role="presentation">
                  <a role="tab" data-toggle="tab" href="#tab-item--2" aria-controls="tab-item--2">Fare Rules</a>
                </li>
                <li role="presentation">
                  <a role="tab" data-toggle="tab" href="#tab-item--3" aria-controls="tab-item--3">CancellationPolicy</a>
                </li>
                <li role="presentation">
                  <a role="tab" data-toggle="tab" href="#tab-item--4" aria-controls="tab-item--4">Baggage Information </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="tab-item--1">
                  <div class="theme-search-results-item-extend-inner">
                      <div class="theme-search-results-item-flight-detail-items">
                        <div class="theme-search-results-item-flight-details">
                          <div class="row">
                            <?php for ($j = 0; $j < count($operating_airlinecode); $j++) { ?>
                            <div class="col-md-9 ">
                              <div class="theme-search-results-item-flight-details-schedule">
                                <ul class="theme-search-results-item-flight-details-schedule-list">
                                  <li>
                                    <i class="fa fa-plane theme-search-results-item-flight-details-schedule-icon"></i>
                                    <div class="theme-search-results-item-flight-details-schedule-dots"></div>
                                    <p class="theme-search-results-item-flight-details-schedule-date"><?php echo date('d-m-Y',strtotime($dep[0])); ?></p>
                                    <div class="theme-search-results-item-flight-details-schedule-time">
                                      <span class="theme-search-results-item-flight-details-schedule-time-item"><?php $dep = explode('T', $operating_deptime[$j]); $dep[1] = substr($dep[1], 0, -3); echo $dep[1]; ?>
                                      </span>
                                      <span class="theme-search-results-item-flight-details-schedule-time-separator">&mdash;</span>
                                      <span class="theme-search-results-item-flight-details-schedule-time-item"><?php $arr = explode('T', $operating_arritime[$j]); $arr[1] = substr($arr[1], 0, -3); echo $arr[1]; ?>
                                      </span>
                                    </div>
                                    <p class="theme-search-results-item-flight-details-schedule-fly-time">
                                    <?php if(count($segment_duration) > 1 && $stops > 0 && $isdomestic == 'false') {
                                        echo '<i class="mdi mdi-clock d-block"></i> '.floor($segment_duration[$j] / 60).'h:'.($segment_duration[$j] - floor($segment_duration[$j] / 60) * 60).'m';
                                    } else {
                                        if($isdomestic == 'true') {
                                            echo '<i class="mdi mdi-clock d-block"></i> '.$this->Tripjack_Model->journeyDuration(str_replace("T", " ", $operating_deptime[$j]),str_replace("T", " ", $operating_arritime[$j]));
                                        }
                                    }
                                    ?></p>
                                    <div class="theme-search-results-item-flight-details-schedule-destination">
                                      <div class="theme-search-results-item-flight-details-schedule-destination-item">
                                        <p class="theme-search-results-item-flight-details-schedule-destination-title">
                                          <b><?php echo $operating_cityname_o[$j]; ?></b>
                                        </p>
                                        <p class="theme-search-results-item-flight-details-schedule-destination-city"><?php echo $operating_airlinecode[$j].' - '.$operating_flightno[$j]; ?></p>
                                      </div>
                                      <div class="theme-search-results-item-flight-details-schedule-destination-separator">
                                        <span>&rarr;</span>
                                      </div>
                                      <div class="theme-search-results-item-flight-details-schedule-destination-item">
                                        <p class="theme-search-results-item-flight-details-schedule-destination-title">
                                          <b><?php echo $operating_cityname_d[$j]; ?></b>
                                        </p>
                                        <p class="theme-search-results-item-flight-details-schedule-destination-city"><?php if ($operating_terminal_d[$j] != '') echo 'Terminal - ' . $operating_terminal_d[$j]; ?></p>
                                      </div>
                                    </div>
                                  </li>
                                </ul>
                              </div>    
                            </div>
                            <?php //} ?>
                            <?php } ?>
                          </div>
                        </div>
                     </div>
                  </div>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab-item--2">
                  <div class="row" data-gutter="20">
                    <div class="col-md-12 ">
                      <div class="row no-gutters">
                            <div class="col-lg-10 col-md-12">
                                <div class="fare-breakup pl-2">
                                    <!-- <span class="flt-criteria d-block">Fare breakup</span> -->
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Base fare</td>
                                                <td><i class="mdi mdi-currency-inr"></i> <?php echo number_format($basefare); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Taxes &amp; Fees</td>
                                                <td><i class="mdi mdi-currency-inr"></i> <?php echo number_format($tax); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td><i class="mdi mdi-currency-inr"></i> <?php echo number_format($total_amount); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab-item--3">
                  <div class="theme-reviews">
                    <div class="theme-reviews-list">
                      
                    </div>
                  </div>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab-item--4">
                  <div class="row" data-gutter="10">
                    <div class="col-md-12">
                        <div class="row no-gutters">
                            <div class="col-lg-10 col-md-12">
                                <div class="fare-breakup pl-2">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a class="checkRules" href="#" data-toggle="modal" data-target="#modalCheckRules" data-searchid="<?php echo $search_id; ?>"><strong><i class="mdi mdi-format-list-bulleted"></i> Fare Rules</strong></a>
                                                </td>
                                                <td><div class="badge badge-success" style="position: static;"><?php if($nonrefundable==1) echo 'Refundable'; else echo 'Non-Refundable'; ?></div></td>
                                            </tr>
                                            <tr>
                                                <td>Cabin Baggage</td>
                                                <td><?php if($CabinBaggage == '') echo '<span class="red">Hand Baggage only<span>';
                                                    else echo 'Weight: '.$CabinBaggage;
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <td>Check-in Baggage</td>
                                                <td>Weight: <?php echo $baggageinformation; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
    </div>
  </div>
<?php } ?>
<?php } ?>