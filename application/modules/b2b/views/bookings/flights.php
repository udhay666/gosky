<?php $this->load->view('home/home_template/header'); ?>
<section class="section-padding inner-page">
   <div class="container">
    <?php $this->load->view('booking_header'); ?>
    <div class="row">
      <div class="col-lg-12 col-md-12 mx-auto">
        <form action="<?php echo site_url();?>b2b/my_bookings/flights" method="get" enctype="multipart/form-data" class="form-horizontal" data-parsley-validate>
          <div class="itinerary-container box-shadow">
          <hr><div ><h3>Filter Reports</h3></div><hr>
            <div class="white-container">
              <div class="row">
                <div class="col-md-3">
                  <label>From Date:</label>
                  <input type="text" value="<?php if(isset($_GET['fromdate'])) echo $_GET['fromdate'] ?>" class="form-control form-group past_dp1" name="fromdate" placeholder="" autocomplete="off">
                </div>
                <div class="col-md-3">
                  <label>To Date:</label>
                  <input type="text" value="<?php if(isset($_GET['todate'])) echo $_GET['todate'] ?>" class="form-control form-group past_dp2" name="todate" placeholder="" autocomplete="off">
                </div>
                <div class="col-md-3">
                  <label>PNR:</label>
                  <input type="text" value="<?php if(isset($_GET['pnr'])) echo $_GET['pnr'] ?>" class="form-control form-group" name="pnr" placeholder="" >
                </div>
                <div class="col-md-3">
                  <label>Booking Status:</label>
                  <select name="status" class="form-control form-group">
                    <option value="">Select</option>
                    <option value="ticketed" <?php if(isset($_GET['status']) && $_GET['status'] == 'ticketed') echo 'selected' ?>>Ticketed</option>
                    <option value="failed" <?php if(isset($_GET['status']) && $_GET['status'] == 'failed') echo 'selected' ?>>Failed</option>
                    <option value="cancel" <?php if(isset($_GET['status']) && $_GET['status'] == 'cancel') echo 'selected' ?>>Cancelled</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label>Booking ID:</label>
                  <input type="text" value="<?php if(isset($_GET['bookingid'])) echo $_GET['bookingid'] ?>" class="form-control form-group " name="bookingid" placeholder="" >
                </div>
                <div class="col-md-3">
                  <label>Email:</label>
                  <input type="email" value="<?php if(isset($_GET['email'])) echo $_GET['email'] ?>" class="form-control form-group " name="email" placeholder="" >
                </div>
                <div class="col-md-3">
                  <label>Mobile:</label>
                  <input type="text" value="<?php if(isset($_GET['mobile'])) echo $_GET['mobile'] ?>" class="form-control form-group " name="mobile" placeholder="" >
                </div>
                <div class="col-md-3" style="border:0;">
                  <label class="d-block invisible">Submit</label>
                  <button type="submit" class="btn btn-secondary">Filter Search <i class="mdi mdi-filter-outline"></i></button>
                </div>
              </div>
            </div>
          </div>
        </form>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 mx-auto">
          <div class="itinerary-container box-shadow">
          <hr>
          <div ><h4>Booking Reports<h4></div>
          <hr>
            <div class="white-container">
              <div class="table-responsive">
                 <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <th>SI.No</th>
                    <th>Unique RefNo</th>
                    <th>PNR #</th>
                    <!-- <th>Ticket Number</th> -->
                    <th>Status</th>
                    <th>Booking Date</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Adults</th>
                    <th>Childs</th>
                    <th>Infants</th>
                    <th>Airline</th>  
                    <th>Depart DateTime</th>
                    <th>Arrive DateTime</th>                                                   
                    <th>TotalFare</th>
                    <th>Trip Type</th>
                    <th>E-Ticket</th>
                    </thead>
                    <tbody>
                       <?php if (!empty($flight_booking_summary)) { ?>
                        <?php for ($j = 0; $j < count($flight_booking_summary); $j++) { ?>
                       <tr>
                       <td><?php echo $j + 1; ?></td>
                        <td><?php echo $flight_booking_summary[$j]->uniqueRefNo; ?></td>
                        <td><?php echo $flight_booking_summary[$j]->pnr; ?></td>
                        <!-- <td><?php echo $flight_booking_summary[$j]->Ticket_Number; ?></td> -->
                        <td><?php echo $flight_booking_summary[$j]->BookingStatus; ?></td>
                        <td><?php echo $flight_booking_summary[$j]->updated_datetime; ?></td>
                        <td><?php echo $flight_booking_summary[$j]->Origin; ?></td>
                        <td><?php echo $flight_booking_summary[$j]->Destination; ?></td>
                        <td><?php echo $flight_booking_summary[$j]->Adults; ?></td>
                        <td><?php echo $flight_booking_summary[$j]->Childs; ?></td>
                        <td><?php echo $flight_booking_summary[$j]->Infants; ?></td>
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
                            <?php echo $flight_booking_summary[$j]->Trip_Type;
                            //if ($flight_booking_summary[$j]->Trip_Type == 'S') echo 'OneWay'; else if ($flight_booking_summary[$j]->Trip_Type == 'R') echo 'RoundTrip'; else echo 'MultiCity'; 
                            ?>
                        </td>
                        <?php $RefIDs = array_filter(explode(',',$flight_booking_summary[$j]->fr_BookingRefId)); ?>
                        <td>
                            
                            <a target="_blank" href="<?php echo site_url(); ?>flights/flight_eticket1/<?php echo $flight_booking_summary[$j]->fr_uniqueRefNo; ?>/<?php  if(!empty($RefIDs)) { echo implode('/',$RefIDs); } else { echo ''; }   ; ?>">E-Ticket</a>
                        </td>
                       </tr>
                       <?php } ?>
                       <?php } ?>
                    </tbody>
                 </table>
              </div>
            </div>
          </div>
        </div>
      </div>
   </div>
</section>
<?php $this->load->view('home/home_template/footer'); ?>

<!-- Data table strart -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/datatables/datatables.min.css"/>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/datatables/datatablesInit.js"></script>
