<!doctype html>
<html lang="en">
  <head><?php //echo"<pre>";print_r($passenger_info);?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
var style = "<style> .text-right{text-align:right}</style>";
  newWin.document.write(divToPrint.outerHTML + style);
</script>

    <title>Flight Voucher</title>
  </head>
  <body>
      <style>
          .first_header{
              background: #e3e6e4;
              padding-top: 15px;
          }
          .impn{
            color:#020d70;
          }
          
          @media print {
  #printPageButton {
    display: none;
  }
}
      </style>
      <div id="printArea">
      <div class="container mt-3 mb-5 border border-secondary">
          <div class="row first_header text-dark">
                <div class="col-md-6">          
                    <h5>Order Details</h5>           
                </div>
                <div class="col-md-6">
                    <h5 class="float-right">Contact Details</h5>
                </div>
          </div>
          <div class="row mt-3">
              <div class="col-md-6 p-2"> Booking Id : <?php echo $booking_info->BookingReferenceId; ?> </div>              
              <div class="col-md-6 p-2"> <div class="float-right"> <?php echo $passenger_info[0]->first_name.' '.$passenger_info[0]->last_name; ?> </div> </div>
              <div class="col-md-6 p-2"> Date of Booking : <?php echo $booking_info->booking_date; ?> </div>
              <div class="col-md-6 p-2"> <div class="float-right"> <?php echo $passenger_info[0]->email; ?> </div> </div>
              <div class="col-md-6 p-2"> Order Id : <?php echo $booking_info->uniqueRefNo; ?> </div>
              <div class="col-md-6 p-2"> <div class="float-right"> <?php echo"(+91) ". $passenger_info[0]->mobile; ?> </div> </div>
              <div class="col-md-6 p-2">Booking Parner : <img src="<?php echo base_url(); ?>assets/images/logo.png" width="150"> </div>
              
              <div class="col-md-8 p-2 float-right"> For any changes/amendment/queries, kindly reach out to TRAVELFREEBY
                Call: 0120 - 123456; <br>Email: flightsupport@travelfreeby.com</div>
              
          </div>
          <?php //echo '<pre>';print_r($booking_info);exit;
                $segment_indicator = explode(',', $booking_info->segment_indicator);
                $Departure_LocationCode = explode(',', $booking_info->Departure_LocationCode);
                $Arrival_LocationCode = explode(',', $booking_info->Arrival_LocationCode);

                $MarketingAirline_Code = explode(',', $booking_info->OperatingAirline_Code);
                $MarketingAirline_Name = explode(',', $booking_info->OperatingAirline_FlightNumber);
                $FlightNumber = explode(',', $booking_info->FlightNumber);

                $DepartureDateTime = explode(',', $booking_info->DepartureDateTime);
                $ArrivalDateTime = explode(',', $booking_info->ArrivalDateTime);
                $departureterminal = explode(',', $booking_info->OriginTerminal);
                ?>
          <div class="row first_header">
            <div class="col-md-5 font-weight-bold"><h5><?php echo $booking_info->Origin; ?> to <?php echo $booking_info->Destination; ?></h5></div>
            <div class="col-md-4"><?php $depart = explode(",",$booking_info->DepartureDateTime); ?></div>
            <div class="col-md-3 font-weight-bold"><h5><?php echo $booking_info->mode; ?> Journey</h5></div>
          </div>
          <?php for ($j = 0; $j < count($Departure_LocationCode); $j++) { 
              $Ddatetime = preg_replace("/T/", " ", $DepartureDateTime[$j]);
              list($DDate, $DTime) = explode(" ", $Ddatetime);
              $Adatetime = preg_replace("/T/", " ", $ArrivalDateTime[$j]);
              list($ADate, $ATime) = explode(" ", $Adatetime);

              $Departure_CityName = $Departure_LocationCode[$j];
              $Arrival_CityName = $Arrival_LocationCode[$j];
              ?>
          <div class="row mt-3">
              <div class="col-md-4"><h6 class="font-weight-bold"><?php echo $MarketingAirline_Name[$j]; ?><h6></div>
              <div class="col-md-2"><h5 class="float-right"><?php echo $Departure_CityName; ?> <b><?php echo date('h:i A', strtotime($DTime)); ?></b></h5></div>
              <div class="col-md-2"></div>
              <div class="col-md-2"><h5 class="float-left"><b><?php echo date('h:i A', strtotime($ATime)); ?></b> <?php echo $Arrival_CityName; ?></h5></div>
              <div class="col-md-2"></div>

              <div class="col-md-4"><small><?php echo $MarketingAirline_Code[$j] . ' ' . $FlightNumber[$j]; ?></small></div>
              <div class="col-md-2"><small class="float-right"><?php echo date("jS F, Y", strtotime($DDate)); ?></small></div>
              <div class="col-md-2 text-center"><small> 
              <?php echo $this->Tbo_Model->journeyDuration(str_replace("T", " ", $DepartureDateTime[$j]),str_replace("T", " ", $ArrivalDateTime[$j]));?>
              </small></div>
              <div class="col-md-4"><small class="float-left"><?php echo date("jS F, Y", strtotime($ADate)); ?> </small></div>

              <div class="col-md-4"><small></small></div>
              <div class="col-md-2"><small class="float-right"><?php echo $this->Flights_Model->get_origin_airport($Departure_CityName); ?></small></div>
              <div class="col-md-2 text-center"><small>Economy </small></div>
              <div class="col-md-4"><small class="float-left"><?php echo $this->Flights_Model->get_desti_airport($Arrival_CityName); ?> </small></div>

              <div class="col-md-4"><small></small></div>
              <div class="col-md-2"><small class="float-right"><?php if(!empty($departureterminal[$j])){echo "Terminal-".$departureterminal[$j];} ?></small></div>
              <div class="col-md-2"><small> </small></div>
              <div class="col-md-4"><small> </small></div>

              <div class="col-md-12"><h5><b>Airline PNR: <?php echo $booking_info->AirlinePNR; ?></b></h5></div>
              <div class="col-md-12"><h5><b>Status: <?php echo $booking_info->BookingStatus; ?></b></h5></div>
              <div class="col-md-12"><h5><b>Ticket No: <?php echo $passenger_info[0]->TicketId; ?></b></h5></div>              
              
          </div><?php } ?>
        <div class="container mt-4">
            <div class="row">            
                <div class="col-md-12 border border-secondary first_header"><h6 class="p-2"><b>TRAVELLERS</b></h6></div>                
                <?php for ($k = 0; $k < count($passenger_info); $k++) { ?>
                <div class="col-md-10 border border-secondary"><h6 class="p-2"><?php echo strtoupper($passenger_info[$k]->title).' '.strtoupper($passenger_info[$k]->first_name) . ' ' . strtoupper($passenger_info[$k]->last_name); ?></h6></div>
                <div class="col-md-2 border border-secondary"><h6 class="p-2"><?php echo $passenger_info[$k]->passenger_type; ?></h6></div>                
                <?php } ?>
            </div>

            <div class="row mt-3">            
                <div class="col-md-12 border border-secondary first_header"><h6 class="p-2"><b>FARE DETAILS</b></h6></div>                
                <div class="col-md-10 border border-secondary"><h6 class="p-2">Basefare</h6></div>
                <div class="col-md-2 border border-secondary"><h6 class="p-2"><?php                 
                    echo"Rs.". number_format($booking_info->BaseFare); ?></h6></div>
                <div class="col-md-10 border border-secondary"><h6 class="p-2">Total Tax & Surcharges</h6></div>
                <div class="col-md-2 border border-secondary"><h6 class="p-2"><?php
                
                 $tax = $booking_info->TotalTax + $booking_info->Admin_Markup + $booking_info->Agent_Markup + $booking_info->Payment_Charge;
                 if(isset($booking_info_r->TotalTax)) {
                   $tax_r = $booking_info_r->TotalTax + $booking_info_r->Admin_Markup + $booking_info_r->Agent_Markup + $booking_info_r->Payment_Charge;
               } else { 
                   $tax_r = 0;
               }
               echo"Rs.". number_format($tax + $tax_r);                 
                    //echo"Rs.". number_format($booking_info->TotalTax); ?>
                    </h6></div>
                <div class="col-md-10 border border-secondary"><h6 class="p-2">Discount</h6></div>
                <div class="col-md-2 border border-secondary"><h6 class="p-2">Rs.0.00</h6></div>
                <div class="col-md-10 border border-secondary"><h6 class="p-2"><b>Sub Total</b></h6></div>
                <div class="col-md-2 border border-secondary"><h6 class="p-2"><b><?php                 
                    echo"Rs.". number_format($booking_info->TotalFare); ?></b></h6></div>
                <?php if ($booking_info->meal_desc !=''){?>
                <div class="col-md-10 border border-secondary"><h6 class="p-2"><b>Meal Charges</b></h6></div>
                <div class="col-md-2 border border-secondary"><h6 class="p-2"><b><?php                 
                    echo"Rs.". number_format($booking_info->meal_price); ?></b></h6></div>
                <?php } ?>

                <?php if ($booking_info->baggage_code !=''){?>
                <div class="col-md-10 border border-secondary"><h6 class="p-2"><b>Baggage Charges</b></h6></div>
                <div class="col-md-2 border border-secondary"><h6 class="p-2"><b><?php                 
                    echo"Rs.". number_format($booking_info->baggage_price); ?></b></h6></div>
                <?php } ?>
                
                <div class="col-md-10 border border-secondary"><h6 class="p-2"><b>Net Pay</b></h6></div>
                <div class="col-md-2 border border-secondary"><h6 class="p-2"><b><?php 
                if(isset($booking_info_r->TotalFare)) {
                    echo"Rs.". number_format($booking_info->TotalFare + $booking_info_r->TotalFare - $Discount);
                } else {
                    echo"Rs.". number_format($booking_info->TotalFare + $booking_info->meal_price + $booking_info->baggage_price - $Discount);
                }                
                    //echo"Rs.". number_format($booking_info->netfare); ?>
                    </b></h6></div>                
                
            </div> 

        </div>

        <div class="col-md-12 mt-5"><h5><b>Baggage Information </b></h5></div>

            <div class="container-fluid border border-secondary">
                <div class="row ">              
                    
                    <div class="col-md-4 first_header"><h6 class="p-2"><b>Sector / Flights </b></h6></div>                
                    <div class="col-md-4 first_header"><h6 class="p-2"><b>Check-in Baggage per person </b></h6></div>                
                    <div class="col-md-4 first_header"><h6 class="p-2"><b>Cabin Baggage per person</b></h6></div>                
                    
                    <div class="col-md-4"><h6 class="p-2"><?php echo $booking_info->Origin; ?>-<?php echo $booking_info->Destination; ?></h6></div>                
                    <div class="col-md-4"><h6 class="p-2"><?php echo $booking_info->Baggage; ?></h6></div>                
                    <div class="col-md-4"><h6 class="p-2"></h6></div>                

                </div>
                
            </div>

            <div class="col-md-12 mt-5"><h5 class="impn"><b>Important Notice </b></h5></div>
            <ol type=1>
                <li> TRAVELFREEBY is the Booking Partner for the above flight booking. For any clarifications concerning rescheduling/modifications, cancellations & refunds, please
                contact the partner directly on: Travelfreeby - 0120 - 123456; flightsupport@travelfreeby.com</li>
                <li> In cases of any rescheduling/modifications & cancellations on account of undue conditions, neither Bank would be held responsible.</li>
                <li> Refunds, if any, will be processed subject to receipt of funds from partner and/or airline.</li>
                <li> In case of any delay in the refunds, neither HDFC Bank nor SmartBuy would be held responsible.</li>
                <li>Carry a print of this itinerary receipt at the time of Check-in.</li>
                <li>Please carry a valid photo identity card (Passport, Voter ID Card, PAN Card, Driving License) at the time of check-in, without which the airline may deny you a
                seat on the flight.</li>
                <li>Your travel on this itinerary is subject to Airline terms and conditions.</li>
                <li>For any assistance on booking please call our concierge 24/7 All Days at 186045011122/ 99862 123465</li>
            </ol>  

            <div class="col-md-12 text-center m-2">
            <a class="btn btn-success" id="printPageButton" onClick="window.print();" href="JavaScript:void(0);"><b>Print</b></a>
            </div>

   </div>
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
  </body>
</html>