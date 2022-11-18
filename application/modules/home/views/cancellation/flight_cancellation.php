<?php $this->load->view('home/home_template/header'); ?>
<style>
.searchHdr2 {
  background: #203fb3;
  padding: 7px 10px;
  font-weight: 500;
  color: #ffbf00;
  font-size: 18px;
  line-height: 1;
}
</style>
<section class="section-padding inner-page" style="margin-top: 120px; background: #ffffff url(<?php echo base_url() ?>public/img/bg-cross2.png) repeat; */">
   <div class="container">
      <?php if (validation_errors() && validation_errors() != "") { ?>
      <div class="row mb-2">
         <div class="col-lg-12 col-md-12">
            <div class="alert alert-danger">
               <button class="close" data-dismiss="alert" type="button">X</button>
               <?php echo validation_errors() ?>
            </div>
         </div>
      </div>
      <?php } ?>
      <?php if(!empty($flight_booking_summary)) { ?>
      <div class="row mb-2">
         <div class="col-md-12">
            <div class="itinerary-container box-shadow">
               <div class="searchHdr2">Ticket Summary</div>
               <div class="white-container">
                  <div class="table-responsive">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                               <th>SI.No</th>
                                <th>Unique RefNo</th>
                                <th>PNR #</th>
                                <!-- <th>Ticket Number</th> -->
                                <th>Status</th>
                                <th>Booking Date</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                <th>Airline</th>  
                                <th>Depart DateTime</th>
                                <th>Arrive DateTime</th>                                                   
                                <th>TotalFare</th>
                                <th>Trip Type</th>
                                <th>E-Ticket</th>
                                <th>Cancellation</th>
                           </tr>
                        </thead>
                        <tbody>
            <?php for ($j = 0; $j < count($flight_booking_summary); $j++) { ?>
                           <tr>
                              <td><?php echo $j + 1; ?></td>
                        <td><?php echo $flight_booking_summary[$j]->uniqueRefNo; ?></td>
                        <td><?php echo $flight_booking_summary[$j]->AirlinePNR; ?></td>
                        <!-- <td><?php echo $flight_booking_summary[$j]->Ticket_Number; ?></td> -->
                        <td><?php echo $flight_booking_summary[$j]->BookingStatus; ?></td>
                        <td><?php echo $flight_booking_summary[$j]->updated_datetime; ?></td>
                        <td><?php echo $flight_booking_summary[$j]->Origin; ?></td>
                        <td><?php echo $flight_booking_summary[$j]->Destination; ?></td>
                        <td>
                            <?php
                            $OperatingAirline_Code = explode(',', $flight_booking_summary[$j]->OperatingAirline_Code);
                            $OperatingAirline_FlightNumber = explode(',', $flight_booking_summary[$j]->OperatingAirline_FlightNumber);
                            echo $OperatingAirline_Code[0] . ' - ' . $OperatingAirline_FlightNumber[0];
                            ?>
                        </td>
                        <td>
                            <?php
                            $DepartureDateTime = explode(',', $flight_booking_summary[$j]->DepartureDateTime);
                            echo $DepartureDateTime[0];
                            ?>
                        </td>
                        <td>
                            <?php
                            $ArrivalDateTime = explode(',', $flight_booking_summary[$j]->ArrivalDateTime);
                            echo $ArrivalDateTime[0];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $flight_booking_summary[$j]->TotalFare;
                            ?>
                        </td>
                        <td>
                            <?php if ($flight_booking_summary[$j]->Trip_Type == 'oneway') echo 'OneWay'; else if ($flight_booking_summary[$j]->Trip_Type == 'round') echo 'RoundTrip'; else echo 'MultiCity'; ?>
                        </td>
                       
                        <td>
                            
                            <a target="_blank" href="<?php echo site_url(); ?>flights/eticket/<?php echo $flight_booking_summary[$j]->uniqueRefNo; ?>/">E-Ticket</a>
                        </td>
                        <td>
                            
                            <a target="_blank" href="<?php echo site_url(); ?>flights/flight_cancellation/<?php echo $flight_booking_summary[$j]->uniqueRefNo; ?>/">Cancel your Ticket</a>
                        </td>
                           </tr>
                      <?php } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php } ?>
      <?php if($no_records != '') { ?>
      <div class="row mb-2">
         <div class="col-lg-12 col-md-12 text-center">
            <div class="alert alert-danger">
               <h5>Sorry,No bookings found for this Booking Id.</h5>
            </div>
         </div>
      </div>
      <?php } ?>
      <?php if(empty($flight_booking_summary)) { ?>
      <div class="row">
         <div class="col-lg-5 col-md-5 mx-auto">
            <div class="itinerary-container box-shadow">
               <div class="searchHdr2">Print / Cancel Ticket</div>
               <div class="white-container">
                  <form class="form-signin" action="<?php echo site_url() ?>home/print_ticket" method="post" data-parsley-validate>
                     <div class="row form-group">
                        <div class="col-sm-12 text-center">
                           
                           <label class="radio-custom checkbox-custom-sm">
                              <input type="radio" name="service_type" value="2" checked=""><i></i>
                              <span>Flight</span>
                           </label>
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-sm-12">
                           <label>Booking Id</label>
                           <input type="text" value="<?php if(isset($uniqueRefNo)) echo $uniqueRefNo ?>" class="form-control" name="uniqueRefNo" required>
                           <small class="text-info">Our booking unique reference id</small>
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-sm-12">
                           <label>Email</label>
                           <input type="email" value="<?php if(isset($user_email)) echo $user_email ?>" class="form-control" name="user_email" required>
                           <small class="text-info">Your booking email</small>
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-sm-12">
                           <label>Mobile No</label>
                           <input type="text" value="<?php if(isset($user_mobile)) echo $user_mobile ?>" class="form-control" name="user_mobile" required>
                           <small class="text-info">Your booking mobile no</small>
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-sm-12">
                           <button type="submit" class="btn btn-secondary btn-block">SUBMIT</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <?php } ?>
      
   </div>
</section>
<?php $this->load->view('home/home_template/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>