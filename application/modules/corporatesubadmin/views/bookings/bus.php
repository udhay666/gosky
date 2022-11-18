<?php $this->load->view('home/header'); ?>
<section class="section-padding inner-page">
  <div class="container">
    <?php $this->load->view('booking_header'); ?>
    <div class="row">
      <div class="col-lg-12 col-md-12 mx-auto">
        <form action="<?php echo site_url();?>corporatesubadmin/my_bookings/bus" method="get" enctype="multipart/form-data" class="form-horizontal" data-parsley-validate>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2">Filter Reports</div>
            <div class="white-container">
              <div class="row">
                <div class="col-md-3">
                  <label>From Date:</label>
                  <input type="text" value="<?php if(isset($_GET['fromdate'])) echo $_GET['fromdate'] ?>" class="form-control form-group past_dp1" name="fromdate" placeholder="" autocomplete="off">
                </div>
                <div class="col-md-3">
                  <label>To Date:</label>
                  <input type="text" value="<?php if(isset($_GET['todate'])) echo $_GET['todate'] ?>" class="form-control past_dp2" name="todate" placeholder="" autocomplete="off">
                </div>
                <div class="col-md-3">
                  <label>Booking Status:</label>
                  <select name="status" class="form-control">
                    <option value="">Select</option>
                    <option value="Confirmed" <?php if(isset($_GET['status']) && $_GET['status'] == 'Confirmed') echo 'selected' ?>>Confirmed</option>
                    <option value="Failed" <?php if(isset($_GET['status']) && $_GET['status'] == 'Failed') echo 'selected' ?>>Failed</option>
                    <option value="Cancel" <?php if(isset($_GET['status']) && $_GET['status'] == 'Cancel') echo 'selected' ?>>Cancelled</option>
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
          <div class="searchHdr2">Booking Reports</div>
          <div class="white-container">
            <div class="table-responsive">
<table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <th>SI.No</th>
                    <th>Unique RefNo</th>
                    <th>Ticket #</th>
                    <th>Date Of journey</th>
                    <th>Status</th>
                    <th>Booking Date</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Passenger</th>
                    <th>Gender</th>
                    <th>Age</th>                     
                    <th>Depart DateTime</th>
                    <th>Arrive DateTime</th>
                    <th>Bus Id</th>
                    <th>Seat Name</th>
                    <th>Travel Name</th>
                    <th>Bus Type</th>
                    <th>SeaT Fare</th>
                    <th>No of Seats</th>
                    <th>Route Id</th>
                    <th>BCityPointName</th>                    
                    
                    <th>BCityPointTime</th>
                    <th>DCityPointName</th>                    
                    
                    <th>DCityPointTime</th>
                    <th>OfferedPrice</th>
                    <th>admin_markup</th>
                    <th>agent_markup</th>
                    <th>payment_charge</th>

                    <th>TotalFare</th>
                    
                    <th>E-Ticket</th>
                    </thead>
                    <tbody>
                       <?php if (!empty($bus_booking_summary)) { ?>
                        <?php for ($j = 0; $j < count($bus_booking_summary); $j++) { ?>
                       <tr>
                       <td><?php echo $j + 1; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->uniqueRefNo; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->Ticket_no; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->DateOfJourneyy; ?></td>                        
                        <td><?php echo $bus_booking_summary[$j]->booking_status; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->updated_datetime; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->sourcename; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->destiname; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->pass_name; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->gender; ?></td>
                        <td><?php echo $bus_booking_summary[$j]->pass_age; ?></td>
                       
                        <td>
                            <?php
                            $DepartureDateTime = explode(',', $bus_booking_summary[$j]->DepartureTime);
                            echo $DepartureTime[0];
                            ?>
                        </td>
                        <td>
                            <?php
                            $ArrivalDateTime = explode(',', $bus_booking_summary[$j]->ArrivalTime);
                            echo $ArrivalTime[0];
                            ?>
                        </td>
                        <td>
                             <?php
                            echo $bus_booking_summary[$j]->BusId;
                            ?>
                        </td>
                         <td>
                             <?php
                            echo $bus_booking_summary[$j]->SeatName;
                            ?>
                        </td>
                        <td>
                             <?php
                            echo $bus_booking_summary[$j]->TravelName;
                            ?>
                        </td>

                         <td>
                             <?php
                            echo $bus_booking_summary[$j]->BusType;
                            ?>
                        </td>
                        <td>
                             <?php
                            echo $bus_booking_summary[$j]->SeatFare;
                            ?>
                        </td>
                         <td>
                             <?php
                            echo $bus_booking_summary[$j]->NoOfSeats;
                            ?>
                        </td>
                         <td>
                             <?php
                            echo $bus_booking_summary[$j]->RouteId;
                            ?>
                        </td>
                         <td>
                             <?php
                            echo $bus_booking_summary[$j]->BCityPointName;
                            ?>
                        </td>
                          <td>
                             <?php
                            echo $bus_booking_summary[$j]->BCityPointTime;
                            ?>
                        </td>
                          <td>
                             <?php
                            echo $bus_booking_summary[$j]->DCityPointName;
                            ?>
                        </td>
                         <td>
                             <?php
                            echo $bus_booking_summary[$j]->DCityPointTime;
                            ?>
                        </td>
                         <td>
                             <?php
                            echo $bus_booking_summary[$j]->OfferedPrice;
                            ?>
                        </td>
                         <td>
                             <?php
                            echo $bus_booking_summary[$j]->admin_markup;
                            ?>
                        </td>
                         <td>
                             <?php
                            echo $bus_booking_summary[$j]->agent_markup;
                            ?>
                        </td>
                         <td>
                             <?php
                            echo $bus_booking_summary[$j]->payment_charge;
                            ?>
                        </td>

                        <td>
                            <?php
                            echo $bus_booking_summary[$j]->total_fare;
                            ?>
                        </td>
                       
                        <?php $RefIDs = array_filter(explode(',',$bus_booking_summary[$j]->booking_reference_no)); ?>
                        <td>
                            
                            <a class="badge badge-success" target="_blank" href="<?php echo site_url(); ?>bus/bus_eticket/<?php echo $bus_booking_summary[$j]->uniqueRefNo; ?>/<?php  if(!empty($RefIDs)) { echo implode('/',$RefIDs); } else { echo ''; }   ; ?>"><i class="mdi mdi-ticket"></i>E-Ticket</a>
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
<?php $this->load->view('home/footer'); ?>

<!-- Data table strart -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/datatables/datatables.min.css"/>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/datatables/datatablesInit.js"></script>