<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<?php $this->load->view('home/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/style.css">

<!-- voucher start -->
<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script>
function coderHakan() {
  var sayfa = window.open($(this).attr("href"), "popupWindow", "width=800,height=800,scrollbars=yes");
  sayfa.document.open("text/html");
  sayfa.document.write(document.getElementById('printArea').innerHTML);
  //sayfa.document.close();
  sayfa.print();
  //sayfa.close();
}
</script>
<script type = "text/javascript" >
function changeHashOnLoad() {
    window.location.href += "#";
    setTimeout("changeHashAgain()", "50");
}

function changeHashAgain() {
    window.location.href += "1";
}

var storedHash = window.location.hash;
window.setInterval(function () {
    if (window.location.hash != storedHash) {
        window.location.hash = storedHash;
    }
}, 50);
</script>
<style type="text/css">
.btn {
    padding: 4px 12px;
    font-size: 13px;
}
</style>
<section class='travelone-section gray-bg my-4'>
  <div class="container">
    <div class="row">
      <div class="col-md-12 effect-5 effects no-border-img">
        <div class="text-center top-txt-title best-promo">
          <h2 class="theme-color">Voucher</h2>
          <div class="separator">
            <div class="separator-style"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="row">
      <div class="col-md-12 text-center">
        <a class="btn btn-default" id="print" onclick="coderHakan();return false;" href="JavaScript:void(0);"><b>Print</b></a>
      </div>
    </div> -->
    <br>
    <div class="row">
      <div class="col-sm-12">
        <div id="printArea" class="white-container mb-3">
          <style type="text/css">
            .vouchertable,bordertable {
                width: 100%;
                max-width: 100%;
                margin-bottom: 0;
                background-color: transparent;
                border-spacing: 0;
                border-collapse: collapse;
            }
            .vouchertable>tbody>tr>td, .vouchertable>tbody>tr>th, .vouchertable>tfoot>tr>td, .vouchertable>tfoot>tr>th, .vouchertable>thead>tr>td, .vouchertable>thead>tr>th {
                padding: 2px 8px;
                line-height: 1.42857143;
                vertical-align: middle;
                /*border-bottom: 1px solid #ddd;*/
            }
            .vouchertable p,.bordertable p{
              margin: 0;
              font-size: 13px;
              line-height: 1.42857143;
              color: #444;
            }
            .vouchertable h2{
              font-weight: 500;
              font-size: 25px;
              margin: 0;
            }
            .vouchertable p b, .bordertable p b {
              font-weight: 600;
              color: #0c0e69;
            }
            .vouchertable p small, .bordertable p small{
              font-size: 11px;
              /*color: #999;*/
            }

            .bordertable{
              /*border-right:1px solid #ddd;*/
              border-bottom:1px solid #ddd;
            }
            .bordertable tbody tr td, .bordertable thead tr th{
              /*border:1px solid #ddd;*/
              border-left:1px solid #ddd;
              border-top:1px solid #ddd;
              /*text-align: center;*/
              padding: 2px 8px;
              border-collapse: collapse;
            }
            .bordertable tr th:first-child,.bordertable tr td:first-child{
              border-left:0;
            }
            .bordertable tr th:last-child,.bordertable tr td:last-child{
              border-right:0;
            }
            .bordertable th p {
                font-weight: normal;
                font-size: 14px
            }
            .bordertable tr th {
                background: #d1f6ff
            }
            .terms p{
              margin-bottom: 8px
            }
            .terms p:last-child{
              margin-bottom: 0
            }
          </style>
          <?php 
          $websitename='Etripoo';
          $companyname='Etripoo';
          ?>
          <table class="vouchertable headone" cellpadding="0" cellspacing="0" style="width: 100%">
            <tbody>
              <tr>
                <td><img src="<?php echo base_url();?>public/img/Etrippo.png" width="183px;" alt=""></td>
                <td colspan="2" style="text-align: right;">
                  <p><b style="color: red;"><?= $websitename ?></b></p>
                  <p>Address: Ardent Office One, Block-1,</p>
                  <p> Ground floor, Unit No - G, 1016, Sadarmangala Rd, Circle,</p>
                  <p> Hoodi, Bengaluru,</p>
                  <p>Karnataka 560048</p>
                  <p>Phone: 080 4207 2181</p>
                </td>
              </tr>
            </tbody>
          </table>
          <table class="vouchertable" cellpadding="0" cellspacing="0" style="width: 100%">
            <tbody>
              <tr>
                <td>
                  <p style="text-align: center;"><b>Thank you for booking with <?= $websitename ?>. This is your E-ticket.</b></p>
                  <p style="text-align: center;"><b><?= $websitename ?> wishes you a pleasant journey and hopes to serve you again in the future.</b></p>
                </td>
              </tr>
              <tr>
                <td>
                  <p>To fly easy, please present the E-Ticket with a valid photo identification at the airport and check-in counter. The check-in counters are open 2 hours prior to departure and close strictly 45 minutes prior to departure.</p>
                </td>
              </tr>
            </tbody>
          </table>
          <table class="vouchertable" cellpadding="0" cellspacing="0" style="width: 100%;border: 1px solid #ddd;border-collapse:collapse;border-bottom: 0;">
            <thead>
              <tr style="border-bottom: 1px solid #ddd;">
                <th style="background: #d1d2ff"><p style="text-align: left;font-size: 16px;color: #0c0e69;">Passenger(s)</p></th>
              </tr>
            </thead>
            <tbody>
               <?php for ($k = 0; $k < count($passenger_info); $k++) { ?>
              <tr>
                <td><p><?php echo $k+1; ?>. <?php echo strtoupper($passenger_info[$k]->title).' '.strtoupper($passenger_info[$k]->first_name) . ' ' . strtoupper($passenger_info[$k]->last_name); ?></p></td>
              </tr>
              <?php } ?>
              <tr>
                <td style="background: #d1d2ff;text-align: left;"><p style="font-size: 16px;color: #0c0e69;"><b>Flight(s)</b></p></td>
              </tr>
              <tr>
                <td style="padding: 0">
                  <table class="bordertable" cellpadding="0" cellspacing="0" style="width: 100%;border-collapse:collapse;">
                    <thead>
                      <tr>                        
                        <th><p>Flight</p></th>                        
                        <th><p>From</p></th>
                        <th><p>To</p></th>
                        <th><p>Depart Date</p></th>                        
                        <th><p>Depart Time</p></th>                        
                        <th><p>Dep Terminal</p></th>
                        <th><p>Arrival Date</p></th>
                        <th><p>Arrival Time</p></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php //echo '<pre>';print_r($booking_info);exit;
                            $segment_indicator = explode(',', $booking_info->segment_indicator);
                            $Departure_LocationCode = explode(',', $booking_info->Departure_LocationCode);
                            $Arrival_LocationCode = explode(',', $booking_info->Arrival_LocationCode);

                            $MarketingAirline_Code = explode(',', $booking_info->OperatingAirline_Code);
                            $MarketingAirline_Name = explode(',', $booking_info->OperatingAirline_FlightNumber);
                            $FlightNumber = explode(',', $booking_info->FlightNumber);

                            $DepartureDateTime = explode(',', $booking_info->DepartureDateTime);
                            $ArrivalDateTime = explode(',', $booking_info->ArrivalDateTime);
                            $departureterminal = explode(',', $booking_info->departureterminal);
                            ?>
                             <?php //echo count($Departure_LocationCode);exit;
                            for ($j = 0; $j < count($Departure_LocationCode); $j++) {

                                $Ddatetime = preg_replace("/T/", " ", $DepartureDateTime[$j]);
                                list($DDate, $DTime) = explode(" ", $Ddatetime);
                                $Adatetime = preg_replace("/T/", " ", $ArrivalDateTime[$j]);
                                list($ADate, $ATime) = explode(" ", $Adatetime);

                                $Departure_CityName = $Departure_LocationCode[$j];
                                $Arrival_CityName = $Arrival_LocationCode[$j];
                                //if (!isset($segment_indicator[$j]) || $segment_indicator[$j] == '1') {
                                ?>
                      <tr>
                        <td><p><img src="<?php echo site_Url(). 'public/AirlineLogo/'.$MarketingAirline_Code[$j]; ?>.gif" width="32" height="25" alt="<?php echo $MarketingAirline_Name[$j]; ?>" /><br><b><?php echo $MarketingAirline_Code[$j] . ' ' . $FlightNumber[$j]; ?></b></p></td>
                        <td><p><b><?php echo $Departure_CityName; ?></b></p></td>
                        <td><p><b><?php echo $Arrival_CityName; ?></b></p></td>
                        <td><p><b><?php echo date("jS F, Y", strtotime($DDate)); ?></b></p></td>
                        <td><p><b><?php echo date('h:i A', strtotime($DTime)); ?></b></p></td>
                        <td><p><b><?php echo $departureterminal[$j]; ?></b></p></td>
                        <td><p><b><?php echo date("jS F, Y", strtotime($ADate)); ?></b></p></td>
                        <td><p><b><?php echo date('h:i A', strtotime($ATime)); ?></b></p></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </td>
              </tr>


              <!-- FLIGHT INTERNATIONAL ROUNDTRIP START -->
               <?php if ($booking_info->isdomestic == 'false' && $booking_info->Trip_Type == 'R') { ?>
             
                      <?php
                        $segment_indicator = explode(',', $booking_info->segment_indicator);
                        $Departure_LocationCode = explode(',', $booking_info->Departure_LocationCode);
                        $Arrival_LocationCode = explode(',', $booking_info->Arrival_LocationCode);

                        $MarketingAirline_Code = explode(',', $booking_info->OperatingAirline_Code);
                        $MarketingAirline_Name = explode(',', $booking_info->OperatingAirline_FlightNumber);
                        $FlightNumber = explode(',', $booking_info->FlightNumber);

                        $DepartureDateTime = explode(',', $booking_info->DepartureDateTime);
                        $ArrivalDateTime = explode(',', $booking_info->ArrivalDateTime);
                        $departureterminal = explode(',', $booking_info->departureterminal);
                        ?>
                        <?php
                        for ($j = 0; $j < count($Departure_LocationCode); $j++) {

                            $Ddatetime = preg_replace("/T/", " ", $DepartureDateTime[$j]);
                            list($DDate, $DTime) = explode(" ", $Ddatetime);

                            $Adatetime = preg_replace("/T/", " ", $ArrivalDateTime[$j]);
                            list($ADate, $ATime) = explode(" ", $Adatetime);

                            $Departure_CityName = $Departure_LocationCode[$j];
                            $Arrival_CityName = $Arrival_LocationCode[$j];

                            if ($segment_indicator[$j] == '2') {
                                ?>
                      <!-- <tr>
                        <td><p><img src="<?php echo site_Url(). 'public/AirlineLogo/'. $MarketingAirline_Code[$j]; ?>.gif" width="32" height="25" alt="<?php echo $MarketingAirline_Name[$j]; ?>" />&nbsp;<b><?php echo $MarketingAirline_Code[$j] . ' ' . $FlightNumber[$j]; ?></b></p></td>
                        <td><p><b><?php echo $Departure_CityName; ?></b></p></td>
                        <td><p><b><?php echo $Arrival_CityName; ?></b></p></td>
                        <td><p><b><?php echo date("jS F, Y", strtotime($DDate)); ?></b></p></td>
                        <td><p><b><?php echo date('h:i A', strtotime($DTime)); ?></b></p></td>
                        <td><p><b><?php echo $departureterminal[$j]; ?></b></p></td>
                        <td><p><b><?php echo date("jS F, Y", strtotime($ADate)); ?></b></p></td>
                        <td><p><b><?php echo date('h:i A', strtotime($ATime)); ?></b></p></td>
                      </tr> -->
                     <?php }
                            }
                            ?>                
              <?php } ?>
              <!-- FLIGHT INTERNATIONAL ROUNDTRIP END -->
              <tr>
                <td style="padding: 0">
                  <table class="bordertable" cellpadding="0" cellspacing="0" style="width: 100%;border-collapse:collapse;">
                    

                 <?php if ($booking_info_r != '') { ?>
                  <?php
                    $Departure_LocationCode = explode(',', $booking_info_r->Departure_LocationCode);
                    $Arrival_LocationCode = explode(',', $booking_info_r->Arrival_LocationCode);

                    $MarketingAirline_Code = explode(',', $booking_info_r->OperatingAirline_Code);
                    $MarketingAirline_Name = explode(',', $booking_info_r->OperatingAirline_FlightNumber);
                    $FlightNumber = explode(',', $booking_info_r->FlightNumber);

                    $DepartureDateTime = explode(',', $booking_info_r->DepartureDateTime);
                    $ArrivalDateTime = explode(',', $booking_info_r->ArrivalDateTime);
                    ?>
                    <?php
                    for ($j = 0; $j < count($Departure_LocationCode); $j++) {

                        $Ddatetime = preg_replace("/T/", " ", $DepartureDateTime[$j]);
                        list($DDate, $DTime) = explode(" ", $Ddatetime);

                        $Adatetime = preg_replace("/T/", " ", $ArrivalDateTime[$j]);
                        list($ADate, $ATime) = explode(" ", $Adatetime);

                        $Departure_CityName = $Departure_LocationCode[$j];
                        $Arrival_CityName = $Arrival_LocationCode[$j];
                        ?>
                 <tr>
                        <td><p><img src="<?php echo site_Url(). 'public/AirlineLogo/'. $MarketingAirline_Code[$j]; ?>.gif" width="32" height="25" alt="<?php echo $MarketingAirline_Name[$j]; ?>" /><br><b><?php echo $MarketingAirline_Code[$j] . ' ' . $FlightNumber[$j]; ?></b></p></td>
                        <td><p><b><?php echo $Departure_CityName; ?></b></p></td>
                        <td><p><b><?php echo $Arrival_CityName; ?></b></p></td>
                        <td><p><b><?php echo date("jS F, Y", strtotime($DDate)); ?></b></p></td>
                        <td><p><b><?php echo date('h:i A', strtotime($DTime)); ?></b></p></td>
                        <td><p><b><?php echo $departureterminal[$j]; ?></b></p></td>
                        <td><p><b><?php echo date("jS F, Y", strtotime($ADate)); ?></b></p></td>
                        <td><p><b><?php echo date('h:i A', strtotime($ATime)); ?></b></p></td>
                      </tr>
                       <?php } ?>
                        <?php } ?>
                      </table>
                    </td>
                  </tr>

              <tr>
                <td>
                  <p><small>Boarding gate closes 25/45 minutes prior to the scheduled time of departure for domestic/international sectors.</small></p>
                </td>
              </tr>
              <tr>
                <td style="padding: 0">
                  <table class="bordertable" cellpadding="0" cellspacing="0" style="width: 100%;border-collapse:collapse;">
                    <thead>
                      <tr>
                        <th><p>PNR</p></th>
                        <th><p>Booking ID</p></th>
                        <th><p>Status</p></th>
                        <th><p>Date of Booking *</p></th>
                        <th><p>Payment Status</p></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><p><b><?php echo $booking_info->pnr; ?></b></p></td>
                        <td><p><b><?php echo $booking_info->uniqueRefNo; ?></b></p></td>
                        <td><p><b><?php echo $booking_info->BookingStatus; ?></b></p></td>
                        <td><p><b><?php echo $booking_info->Booking_Date; ?></b></p></td>
                        <td><p><b>Approved</b></p></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table> 
          <table class="vouchertable" cellpadding="0" cellspacing="0" style="width: 50%;border-right: 1px solid #ddd;">
            <thead>
              <tr>
                <th style="background: #d1d2ff;text-align: left;" colspan="3"><p style="font-size: 16px;color: #0c0e69;">Price Summary</p></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><p>Airfare Charges</p></td>
                <td><p>INR</p></td>
                <td style="text-align: right;"><p> <?php
                                if (isset($booking_info_r->EquivFare) &&  $booking_info_r->EquivFare != '')
                                    echo number_format($booking_info->EquivFare + $booking_info_r->EquivFare);
                                else
                                    echo number_format($booking_info->EquivFare);
                                ?></p></td>
              </tr>
              <tr>
                <td><p>Taxes & Surcharges</p></td>
                <td><p>INR</p></td>
                <td style="text-align: right;"><p><?php
                                $tax = $booking_info->Tax_Amount + $booking_info->Admin_Markup + $booking_info->Agent_Markup + $booking_info->Payment_Charge;
                                if(isset($booking_info_r->Tax_Amount)) {
                                  $tax_r = $booking_info_r->Tax_Amount + $booking_info_r->Admin_Markup + $booking_info_r->Agent_Markup + $booking_info_r->Payment_Charge;
                              } else { 
                                  $tax_r = 0;
                              }
                              echo number_format($tax + $tax_r);
                              ?></p></td>
              </tr>
               <?php if ($booking_info->meal_desc !=''){?>
                <tr>
                  <td>Meal Charges</td>
                   <td><p>INR</p></td>
                  <td style="text-align: right;"><p><?php echo $booking_info->meal_price?></p>
                  </td>
                </tr>
              <? }?>
               <?php if ($booking_info->baggage_code !=''){?>
                 <tr>
                  <td>Baggage Charges</td>
                   <td><p>INR</p></td>
                  <td style="text-align: right;"><p><?php echo $booking_info->baggage_price?></p>
                  </td>
                </tr>
              <? }?>
              <tr>
                <td><p style="font-size: 16px;"><b>Total Fare</b></p></td>
                <td><p style="font-size: 16px;"><b>INR</b></p></td>
                <td style="text-align: right;"><p style="font-size: 16px;"><b> <?php

                        if(isset($booking_info_r->TotalFare)) {
                          echo number_format($booking_info->TotalFare + $booking_info_r->TotalFare - $Discount);
                      } else {
                          echo number_format($booking_info->TotalFare + $booking_info->Payment_Charge + $booking_info->meal_price + $booking_info->baggage_price - $Discount);
                      }

                      ?></b></p></td>
              </tr>
            </tbody>
          </table>
          <table class="vouchertable" cellpadding="0" cellspacing="0" style="width: 100%;border-right: 1px solid #ddd;">
            <thead>
              <tr>
                <th style="background: #d1d2ff;text-align: left;" colspan="3"><p style="font-size: 16px;color: #0c0e69;">Fare rule</p></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><p><?php echo $flight_result->fare_rule?></p></td>
               
              </tr>
            </tbody>
          </table>
          <table class="vouchertable" cellpadding="0" cellspacing="0" style="width: 100%;margin-top: 15px">
            <thead>
              <tr>
                <th style="background: #ffffa1;"><p style="text-align: center;color: #272be6;font-size: 16px;">Fare Conditions</p></th>
              </tr>
            </thead>
          </table>
          <table class="vouchertable terms" cellpadding="0" cellspacing="0" style="width: 100%">
            <tbody>
              <tr>
                <td>
                  <p><b>1. Free baggage allowance 15kg checked baggage and 10 kg ((including the Laptop), with an additional restriction on maximum dimension - length 55cm + width 35cm + height 25cm respectively is allowed) cabin baggage. This allowance does not apply to infants. No piece system applies. Baggage in excess of 15 kg is subject to a fee to be paid at the airport at check-in.</b></p>
                  <p><b>2. Above allowances will be applicable for Tickets issued on or after 1st June 2013, including re-issuance after that date.</b></p>
                  <p><b>3. Partial cancellations are not allowed for Round-trip Fares</b></p>
                  <p><b>4. For any queries please contact Indigo at (GSM/CDMA) - 8012700800 / 8012500600</b></p>
                  <p><b>5. All Guests, including children and infants, must present valid identification at check-in.</b></p>
                  <p><b>6. Check-in begins 2 hours prior to the flight for seat assignment and closes 45 minutes prior to the scheduled departure.</b></p>
                  <p><b>7. Carriage and other services provided by the carrier are subject to conditions of carriage, which are hereby incorporated by reference. These conditions may be obtained from the issuing carrier.</b></p>
                  <p><b>8. In case of cancellations less than 6 hours before departure please cancel with the airlines directly. We are not responsible for any losses if the request is received less than 6 hours before departure.</b></p>
                </td>
              </tr>
            </tbody>
          </table>
          <table class="vouchertable" cellpadding="0" cellspacing="0" style="width: 100%;">
            <thead>
              <tr>
                <th><p style="text-align: center;color: #272be6;">Thank you for Choosing <?= $websitename ?></p></th>
              </tr>
            </thead>
          </table>
          <div class="row">
      <div class="col-md-12 text-center">
        <a class="btn btn-default" id="print" onclick="coderHakan();return false;" href="JavaScript:void(0);"><b>Print</b></a>
      </div>
    </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $this->load->view('home/footer'); ?>